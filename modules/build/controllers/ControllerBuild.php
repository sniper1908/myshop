<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/10/13 10:17
 * @name 	网站后台文件-首页
 */
namespace modules\build\controllers;

use modules\build\classes\BaseController;
use modules\build\models\ControllerBuildModel;
use classes\Security;

class ControllerBuild extends BaseController
{
	protected $model = null;

	public function __construct(){
		parent::__construct();
		$this->model = new ControllerBuildModel;
	}
	public function indexAction(){
		$this->params['page_title'] = '控制器生成页';
		$this->have_script = 0;
		$this->params['aList'] = $this->model->select();
		$this->renderInclude();
	}

	public function addAction(){
		$this->params['page_title'] = "新增控制器";
		// print_r($_POST);
		if ($this->model->load($_POST,'ControllerBuild') && $this->model->save()) {
			// 生成模型文件
			$this->build($_POST['ControllerBuild']);
			$this->redirectMsg('添加成功',['index'],-1);
			exit;
		}
		if ($this->model->errors) {
			# 存在错误信息
			Web::app()->Session->setFlash('error',$this->model->errors);
		}
		# 新增页面
		$this->renderInclude();
	}

	public function editAction(){
		$this->have_script = 0;
		$this->params['page_title'] = '编辑控制器';
		$id = (int)$_GET['id'];
		if (!$id) {
			$this->redirectMsg('没有数据ID',['index']);
		}
		$this->model->setModel($id);
		// $this->model->scenario = 'update';
		$this->params['model'] = $this->model;
		
		if ($this->model->load($_POST,'ControllerBuild') && $this->model->save()) {
			// 生成模型文件
			$this->build($_POST['ControllerBuild']);
			$this->redirectMsg('编辑成功',['view','id'=>$id],-1);
			exit;
		}
		if ($this->model->errors) {
			# 存在错误信息
			Web::app()->Session->setFlash('error',$this->model->errors);
		}
		# 新增页面
		$this->renderInclude();
	}

	public function viewAction(){
		$id = (int)$_GET['id'];
		if ($id) {
			$data = $this->model->findOneForPK($id);
			$this->params['data'] = $data;
			$this->renderInclude();
		}else{
			$this->redirectMsg('没有数据ID',['index']);
		}
	}

	public function deleteAction(){
		$id = (int)$_GET['id'];
		if ($id) {
			$data = $this->model->findOneForPK($id);
			$res = $this->model->deleteForPK($id);
			$msg = '删除失败';
			if ($res) {
				$msg = '删除成功';
				@unlink('./'.$data['namespace'].'/'.$data['controller_class'].'.php');
			}
			$this->redirectMsg($msg,['index']);
		}else{
			$this->redirectMsg('没有数据ID',['index']);
		}
	}

	protected function build($data){
		$data = Security::stripslashes($data);
		// print_r($data);
		$namespace = str_replace('\\','/',$data['namespace']);
		$url = './'.$namespace.'/'.$data['controller_class'];
		$url .= '.php';
		if (!file_exists($url)) {
			# 如果文件不存在则创建文件
			$fp = @fopen($url,'w+');
			fclose($fp);
		}
		// $fp = @fopen($url,'w+');
		$from = './templates/build/controllers/defaultController.txt';
		$temp = file_get_contents($from);
		foreach ($data as $key => $value) {
			$str = '';
			$str = '$'.$key.'$';
			$temp = str_replace($str,$value,$temp);
		}
		// 基类名称，不包含命名空间
		$base_class = $this->getClassName($data['base_class']);
		$temp = str_replace('$baseClassName$',$base_class,$temp);
		// 模型类名称，不包含命名空间
		$model_class = $this->getClassName($data['model_class']);
		$temp = str_replace('$modelClassName$',$model_class,$temp);
		// 创建时间
		$temp = str_replace('$created_time$',date('Y/m/d H:i:s',time()),$temp);
		file_put_contents($url, $temp);
	}
}