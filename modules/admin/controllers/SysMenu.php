<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/10/18 8:50
 * @name 	网站后台文件-系统管理-菜单页
 */
namespace modules\admin\controllers;

use classes\Web;
// use classes\Controller;
use modules\admin\classes\BaseController;
use common\models\SysMenuModel;
use common\models\SysRouteModel;

class SysMenu extends BaseController
{
	protected $model = null;

	public function __construct(){
		parent::__construct();
		$this->model = new SysMenuModel;
		$this->SysRouteModel = new SysRouteModel;
		$allController = $this->SysRouteModel->getAllController($this->_module);
		$this->params['allController'] = $allController;
		// $this->params['allControllerAction'] = $this->SysRouteModel->getAllControllerAction($allController[0]['route_controller']);
	}

	public function indexAction(){
		$this->params['page_title'] = '系统菜单';
		// $model = new SysMenuModel;
		$this->params['tree'] = $this->model->getTree2(0,'*',0,'menu_name');
		// print_r($this->params['tree']);
		$this->renderInclude();
	}

	public function addAction(){
		$this->have_script = 1;
		$this->params['page_title'] = '新增菜单';
		// $model = new SysMenuModel;
		$tree = $this->model->getTree2();
		$this->params['tree'] = $tree;
		// print_r($tree);
		
		if ($this->model->load($_POST,'menu') && $this->model->save()) {
			$this->redirectMsg('添加成功',['index'],3);
			exit;
			# 处理提交
			# 验证
			//$validateRes = $model->validate($this->_aConfig['enableBackstageValidation']);
			# 添加入库
			//$res = $model->add();
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
		$this->params['page_title'] = '编辑菜单';
		$id = (int)$_GET['id'];
		if (!$id) {
			$this->redirectMsg('没有数据ID',['index']);
		}
		// $model = new SysMenuModel;
		$this->model->setModel($id);
		$this->params['allControllerAction'] = $this->SysRouteModel->getAllControllerAction($this->model->route_controller);
		// 获取该菜单对应路由的控制器名
		// $this->params['sys_route_controller'] = $this->SysRouteModel->fetchColumnForPK($this->model->sys_route_id,'route_controller');
		$tree = $this->model->getTree2();
		$this->params['tree'] = $tree;
		
		$this->params['model'] = $this->model;
		
		if ($this->model->load($_POST,'menu') && $this->model->save()) {
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
		// $model = new SysMenuModel;
		$id = (int)$_GET['id'];
		if ($id) {
			$data = $this->model->findOneForPK($id);
			if ($data['parent_id']) {
				$data['parent_name'] = $this->model->fetchColumnForPK($data['parent_id'],'menu_name');
			}
			// print_r($data);
			$this->params['data'] = $data;
			$this->renderInclude();
		}else{
			$this->redirectMsg('没有数据ID',['index']);
		}
	}

	public function deleteAction(){
		// $model = new SysMenuModel;
		$id = (int)$_GET['id'];
		if ($id) {
			$res = $this->model->deleteForPK($id);
			if ($res) {
				$this->redirectMsg('删除成功',['index'],3);
			} else {
				// $this->renderInclude();
				Url::goBack();
			}
			
		}
		$this->redirectMsg('没有数据ID',['index']);
	}
}