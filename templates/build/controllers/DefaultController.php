<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/12/6 16:09
 * @name 	网站后台文件-权限分配页
 */
namespace modules\admin\controllers;

use modules\admin\classes\BaseController;
use common\models\AssignmentModel;
use common\models\AdminModel;
use common\models\RoleModel;
use common\models\PermissionModel;

class Assignment extends BaseController
{
	protected $model = null;

	public function __construct(){
		parent::__construct();
		$this->model = new AssignmentModel;
		$this->adminModel = new AdminModel;
		$this->roleModel = new RoleModel;
	}

	public function indexAction(){
		$this->bBtnTitle = 0;
		$this->params['bBtnTitle'] = $this->bBtnTitle;
		$this->params['page_title'] = '权限分配';
		$this->have_script = 1;
		$aList = $this->adminModel->select();
		if (!empty($aList)) {
			foreach ($aList as $key => $value) {
				$roleId = $this->model->fetchColumn("`admin_id`='".$value['id']."'",'role_id');
				$aList[$key]['role_name'] = $this->roleModel->fetchColumnForPK($roleId,'role_name');
			}
		}
		$this->params['aList'] = $aList;
		$this->renderInclude();
	}

	public function editAction(){
		$this->have_script = 0;
		$this->params['page_title'] = '编辑数据';
		$id = (int)$_GET['id'];
		if (!$id) {
			$this->redirectMsg('没有数据ID',['index']);
		}
		$this->adminModel->setModel($id);
		$this->params['adminModel'] = $this->adminModel;
		// $this->params['id'] = $id;
		// $this->params['username'] = $this->adminModel->fetchColumnForPK($id,'username');
		// 查出表主键id值
		$primaryKey = $this->model->fetchColumn("`admin_id`='".$id."'",'id');
		if ($primaryKey) {
			$this->model->setModel($primaryKey);
		}
		// $this->model->scenario = 'update';
		$this->params['model'] = $this->model;
		$this->params['roles'] = $this->roleModel->select();
		
		if ($this->model->load($_POST) && $this->model->save()) {
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
			$this->params['page_title'] = '用户角色';
			$this->adminModel->setModel($id);
			$this->params['adminModel'] = $this->adminModel;
			$primaryKey = $this->model->fetchColumn("`admin_id`='".$id."'",'id');
			$data = $this->model->findOneForPK($primaryKey);
			if (empty($data)) {
				$this->redirectMsg('没有数据',['index']);
				exit;
			}
			// $this->params['data'] = $data;
			$this->roleModel->setModel($data['role_id']);
			$this->params['roleModel'] = $this->roleModel;
			$this->renderInclude();
		}else{
			$this->redirectMsg('没有数据ID',['index']);
		}
	}

	public function deleteAction(){
		$id = (int)$_GET['id'];
		if ($id) {
			$primaryKey = $this->model->fetchColumn("`admin_id`='".$id."'",'id');
			$res = $this->model->deleteForPK($primaryKey);
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
