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
use modules\build\models\ViewBuildModel;
use classes\Security;

class ViewBuild extends BaseController
{
	protected $model = null;

	public function __construct(){
		parent::__construct();
		$this->model = new ViewBuildModel;
	}
	public function indexAction(){
		$this->params['page_title'] = '视图生成页';
		$this->have_script = 0;
		$this->params['aList'] = $this->model->select();
		$this->renderInclude();
	}

	public function addAction(){
		$this->params['page_title'] = "新增视图";
		// print_r($_POST);
		if ($this->model->load($_POST,'ViewBuild') && $this->model->save()) {
			// 生成模型文件
			$this->build($_POST['ViewBuild']);
			$this->redirectMsg('添加成功',['index'],3);
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
		$this->params['page_title'] = '编辑视图';
		$id = (int)$_GET['id'];
		if (!$id) {
			$this->redirectMsg('没有数据ID',['index']);
		}
		$this->model->setModel($id);
		// $this->model->scenario = 'update';
		$this->params['model'] = $this->model;
		
		if ($this->model->load($_POST,'ViewBuild') && $this->model->save()) {
			// 生成模型文件
			$this->build($_POST['ViewBuild']);
			$this->redirectMsg('编辑成功',['view','id'=>$id],3);
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
				$dir = './modules/'.$data['module_name'].'/views/'.strtolower($data['controller_class']).'/';
				@unlink($dir.'index.php');
				@unlink($dir.'add.php');
				@unlink($dir.'edit.php');
			}
			$this->redirectMsg($msg,['index']);
		}else{
			$this->redirectMsg('没有数据ID',['index']);
		}
	}

	protected function build($data){
		$data = Security::stripslashes($data);
		$this->buildAdd($data);
		$this->buildAdd($data,'edit');
		$this->buildView($data);
		$this->buildIndex($data);
	}

	protected function buildIndex($data){
		# 列表页
		// $data = Security::stripslashes($data);
		// $model_class = str_replace('\\','/',$data['model_class']);
		$file = $this->createFile($data,'index');
		$from = $file['from'];
		$url = $file['url'];
		$model = new $data['model_class'];
		$data['labels'] = $model->attributeLabels();
		$temp = file_get_contents($from);
		$temp = str_replace('$created_time$',date('Y/m/d H:i:s',time()),$temp);
		$temp = str_replace('$attributes$',$data['list_attr'],$temp);
		$listAttr = explode(',',$data['list_attr']);
		$listCount = count($listAttr);
		$temp = str_replace('$nullStr$',str_repeat('null,',$listCount),$temp);
		file_put_contents($url, $temp);
	}

	protected function buildAdd($data,$type='add'){
		$file = $this->createFile($data,$type);
		$from = $file['from'];
		$url = $file['url'];
		// $model = new $data['model_class'];
		// $data['labels'] = $model->attributeLabels();
		$temp = file_get_contents($from);
		$temp = str_replace('$created_time$',date('Y/m/d H:i:s',time()),$temp);
		file_put_contents($url, $temp);
	}

	protected function buildView($data){
		// $data = Security::stripslashes($data);
		// $model_class = str_replace('\\','/',$data['model_class']);
		$file = $this->createFile($data,'view');
		$from = $file['from'];
		$url = $file['url'];
		$model = new $data['model_class'];
		$data['labels'] = $model->attributeLabels();
		$temp = file_get_contents($from);
		$temp = str_replace('$created_time$',date('Y/m/d H:i:s',time()),$temp);
		$temp = str_replace('$attributes$',$data['view_attr'],$temp);
		file_put_contents($url, $temp);
	}

	protected function createFile($data,$fileName){
		$dir = './modules/'.strtolower($data['module_name']).'/views/'.strtolower($data['controller_class']);
		$url = $dir.'/'.$fileName.'.php';
		$from = './templates/build/views/defaultViews/'.$fileName.'.php';
		if (!file_exists($dir)) {
			# 文件夹不存在则创建
			mkdir($dir);
			chmod($dir, 0777);
		}
		if (!file_exists($from)) {
			# 如果文件不存在则创建文件
			$fp = fopen($from,'w');
			@fclose($fp);
		}
		$res = [];
		$res['from'] = $from;
		$res['url'] = $url;
		return $res;
	}

	public function testAction(){
		$data = [];
		$data['module_name'] = 'admin';
		$data['controller_class'] = 'Category';
		$data['model_class'] = 'common\models\CategoryModel';
		$data['list_attr'] = 'cate_name,parent_id,order_num,keywords,des';
		$data['view_attr'] = 'cate_name,parent_id,order_num,keywords,des';
		$this->buildAdd($data);
		$this->buildAdd($data,'edit');
		$this->buildView($data);
		$this->buildIndex($data);
	}
}