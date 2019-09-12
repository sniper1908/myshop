<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/12/27 14:41:13
 * @name 	网站后台文件 - 控制器 - 分类
 */
namespace modules\admin\controllers;

use classes\Web;
use modules\admin\classes\BaseController;
use common\models\CategoryModel;

class Category extends BaseController
{
	protected $model = null;

	public function __construct(){
		parent::__construct();
		$this->model = new CategoryModel;
	}

	public function indexAction(){
		$this->bBtnTitle = 0;
		// $this->params['bBtnTitle'] = $this->bBtnTitle;
		$this->params['page_title'] = '分类';
		$this->have_script = 1;
		$aList = $this->model->select();
		$this->params['aList'] = $aList;
		$this->params['model'] = $this->model;
		$this->renderInclude();
	}

	public function addAction(){
		$this->params['page_title'] = "新增数据";
		$this->have_script = 1;
		$this->params['tree'] = $this->model->getTree2();
		// print_r($this->params['tree']);
		$this->model->scenario = 'insert';
		if ($this->model->load($_POST) && $this->model->save()) {
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
		$this->have_script = 1;
		$this->params['page_title'] = '编辑数据';
		$id = (int)$_GET['id'];
		if (!$id) {
			$this->redirectMsg('没有数据ID',['index']);
		}
		$this->model->setModel($id);
		// $this->params['id'] = $id;
		// $this->model->scenario = 'update';
		$this->params['model'] = $this->model;
		
		if ($this->model->load($_POST) && $this->model->save()) {
			$this->redirectMsg('编辑成功',['view','id'=>$id],3);
			exit;
		}
		if ($this->model->errors) {
			# 存在错误信息
			Web::app()->Session->setFlash('error',$this->model->errors);
		}
		# 显示页面
		$this->renderInclude();
	}

	public function viewAction(){
		$id = (int)$_GET['id'];
		if ($id) {
			$this->params['page_title'] = '分类';
			$this->model->setModel($id);
			$this->params['model'] = $this->model;
			$data = $this->model->findOneForPK($id);
			if (empty($data)) {
				$this->redirectMsg('没有数据',['index']);
				exit;
			}
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
