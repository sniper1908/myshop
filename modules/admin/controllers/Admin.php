<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/11/29 10:12
 * @name 	网站后台文件- 管理员
 */
namespace modules\admin\controllers;

use classes\Web;
use modules\admin\classes\BaseController;
use common\models\AdminModel;

class Admin extends BaseController
{
	protected $model = null;

	public function __construct(){
		parent::__construct();
		$this->model = new AdminModel;
	}

	public function indexAction(){
		$this->params['page_title'] = '管理员';
		$this->have_script = 0;
		$this->params['aList'] = $this->model->select();
		$this->renderInclude();
	}

	public function addAction(){
		$this->params['page_title'] = "新增数据";
		$this->have_script = 1;
		$this->model->scenario = 'insert';
		if ($this->model->load($_POST,'admin') && $this->model->save()) {
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
		$this->model->scenario = 'update';
		$this->params['model'] = $this->model;
		
		if ($this->model->load($_POST,'admin') && $this->model->save()) {
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

	public function editPwdAction(){
		$this->have_script = 0;
		$this->params['page_title'] = '编辑数据';
		$id = (int)$_GET['id'];
		if (!$id) {
			$this->redirectMsg('没有数据ID',['index']);
		}
		$this->model->setModel($id);
		$this->model->scenario = 'editPwd';
		$this->params['model'] = $this->model;
		
		if ($this->model->load($_POST,'admin') && $this->model->save()) {
		// if ($this->model->load($_POST,'admin')) {
			// $this->model->chkpassword = $_POST['chkpassword'];
			// $msg = '编辑失败';
			// if ($this->model->save()) {
			// 	$msg = "编辑成功";
			// }
			$msg = '编辑成功';
			$this->redirectMsg($msg,'index',3);
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