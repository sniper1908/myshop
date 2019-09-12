<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2018/01/08 09:41:56
 * @name 	网站后台文件 - 控制器 - 商品品牌
 */
namespace modules\admin\controllers;

use classes\Web;
use modules\admin\classes\BaseController;
use common\models\BrandModel;
use classes\Uploads;

class Brand extends BaseController
{
	protected $model = null;

	public function __construct(){
		parent::__construct();
		$this->model = new BrandModel;
	}

	public function indexAction(){
		$this->bBtnTitle = 0;
		// $this->params['bBtnTitle'] = $this->bBtnTitle;
		$this->params['page_title'] = '商品品牌';
		$this->have_script = 1;
		$aList = $this->model->select();
		$this->params['aList'] = $aList;
		$this->params['model'] = $this->model;
		$this->renderInclude();
	}

	public function ajaxUploadAction(){
		$ajax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']==='XMLHttpRequest';
		if ($ajax) {
			$Uploads = new Uploads('uploads');
			$upload_file = $Uploads->upload($_FILES['logo'],'test_');
			$file = $_FILES['logo'];
			$result['status'] = 'OK';
			$result['message'] = 'Logo changed successfully!';
			$result['file'] = json_encode($file);
			$result['url'] = $upload_file;
			$res[] = $result;
			echo json_encode($res);
			exit;
		}
	}

	public function addAction(){
		$this->params['page_title'] = "新增数据";
		$this->have_script = 0;		
		$this->model->scenario = 'insert';
		
		if ($this->model->load($_POST) && $this->model->save()) {
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

		// if ($_POST) {
		// 	print_r($_POST);
		// 	print_r($_FILES);
		// 	exit;
		// }
		
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
			$this->params['page_title'] = '商品品牌';
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
			$data = $this->model->findOneForPK($id);
			$res = $this->model->deleteForPK($id);
			$msg = '删除失败';
			if ($res) {
				$msg = '删除成功';
			}
			@unlink($data['logo']);
			$this->redirectMsg($msg,['index']);
		}else{
			$this->redirectMsg('没有数据ID',['index']);
		}
	}

	public function testAction(){
		$this->params['page_title'] = "test";
		$this->have_script = 1;

		// if ($this->model->load($_POST) && $this->model->save()) {
		// 	$this->redirectMsg('添加成功',['index'],3);
		// 	exit;
		// }
		if ($this->model->errors) {
			# 存在错误信息
			//Web::app()->Session->setFlash('error',$this->model->errors);
		}
		# 新增页面
		$this->render('test','brand');
		// $this->renderInclude();
	}

	public function test2Action(){
		// if ($_POST) {
			$Uploads = new Uploads('uploads');
			$Uploads->upload($_FILES['avatar'],'test_');
			$file = $_FILES['avatar'];
			$result['status'] = 'OK';
			$result['message'] = 'Avatar changed successfully!';
			$result['file'] = json_encode($file);
			echo json_encode($result);
			exit;
		// }
	}
}
