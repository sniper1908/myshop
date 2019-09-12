<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/12/4 16:15
 * @name 	网站后台文件-权限页-为角色赋予权限功能
 */
namespace modules\admin\controllers;

use modules\admin\classes\BaseController;
use common\models\PermissionModel;
use common\models\SysMenuModel;
use common\models\RoleModel;

class Permission extends BaseController
{
	protected $model = null;

	public function __construct(){
		parent::__construct();
		$this->model = new PermissionModel;
		$this->roleModel = new RoleModel;
		$roles = $this->roleModel->select();
		$this->params['roles'] = $roles;
	}

	public function indexAction(){
		$this->params['page_title'] = '权限';
		$this->have_script = 1;
		// $select = [];
		// $select['order'] = "order_num asc,id asc";
		// $this->params['aList'] = $this->model->select($select);
		$this->params['aList'] = $this->model->getList($this->roleModel);
		$this->renderInclude();
	}

	public function addAction(){
		$this->params['page_title'] = "新增数据";
		$this->have_script = 0;
		$sysMenuModel = new SysMenuModel;
		$this->params['tree'] = $sysMenuModel->getTree(0,'*',0,'menu_name');
		// print_r($this->params['tree']);
		// $this->model->scenario = 'insert';
		if ($this->model->load($_POST,'permission') && $this->model->save()) {
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
		$sysMenuModel = new SysMenuModel;
		$this->params['tree'] = $sysMenuModel->getTree(0,'*',0,'menu_name');
		$this->model->setModel($id);
		// $this->model->scenario = 'update';
		$this->params['model'] = $this->model;
		$this->model->json_data = json_decode($this->model->json_data,true);
		// print_r($this->model->json_data);
		
		if ($this->model->load($_POST,'permission') && $this->model->save()) {
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
			$sysMenuModel = new SysMenuModel;
			$this->params['tree'] = $sysMenuModel->getTree(0,'*',0,'menu_name');
			$data = $this->model->findOneForPK($id);
			$data['json_data'] = json_decode($data['json_data'],true);
			$data['menu_data'] = $sysMenuModel->getPermissionMenuData($data['json_data']);
			$data['role_name'] = $this->roleModel->fetchColumnForPK($data['role_id'],'role_name');
			$this->params['data'] = $data;
			// print_r($data);
			$this->params['page_title'] = $data['role_name'];
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