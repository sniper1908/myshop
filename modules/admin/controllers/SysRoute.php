<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/10/23 14:22
 * @name 	网站后台文件-系统管理-路由设置页
 */
namespace modules\admin\controllers;

use classes\Web;
use modules\admin\classes\BaseController;
use common\models\SysRouteModel;

class SysRoute extends BaseController
{
	protected $model = null;

	public function __construct(){
		parent::__construct();
		$this->model = new SysRouteModel;
	}

	public function indexAction(){
		$this->params['page_title'] = '路由';
		$this->have_script = 1;
		// $select = [];
		// $select['order'] = "route_module asc,order_num asc,id asc";
		// $this->params['aList'] = $this->model->select($select);
		$this->params['aList'] = $this->model->getList();
		$this->renderInclude();
	}

	public function getActionsForControllerAction(){
		$controller = $_POST['routeController'];
		// $controller = $_GET['routeController'];
		// $controller = 'permission';
		$actions = $this->model->getAllControllerAction($controller);
		// print_r($actions);
		echo json_encode($actions);
		exit;
	}

	public function addAction(){
		$this->params['page_title'] = "新增数据";
		$this->have_script = 0;		
		$this->model->scenario = 'insert';
		if ($this->model->load($_POST,'route') && $this->model->save()) {
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
		$this->params['page_title'] = '编辑数据';
		$id = (int)$_GET['id'];
		if (!$id) {
			$this->redirectMsg('没有数据ID',['index']);
		}
		$this->model->setModel($id);
		// $this->model->scenario = 'update';
		$this->params['model'] = $this->model;
		
		if ($this->model->load($_POST,'route') && $this->model->save()) {
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
			// $this->params['page_title'] = '详情';
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
			$res = $this->model->deleteForPK($id);
			$msg = '删除失败';
			if ($res) {
				$msg = '删除成功';
			}
			$this->redirectMsg($msg,['index']);
		}else{
			$this->redirectMsg('没有数据ID',['index']);
		}
	}
}