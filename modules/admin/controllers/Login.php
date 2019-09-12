<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/10/13 10:17
 * @name 	网站后台文件-登陆页
 */
namespace modules\admin\controllers;

use classes\Web;
use classes\Controller;
use modules\admin\classes\BaseController;
use common\models\AdminModel;

class Login extends Controller
{
	protected $model = null;

	public function indexAction(){
		$this->params['page_title'] = '登陆';
		$this->params['module'] = $this->_module;
		$this->params['controller'] = $this->_controller;
		$this->params['action'] = $this->_action;
		$this->have_script = 0;
		$this->model = new AdminModel;
		if ($this->model->load($_POST,'login') && $this->model->login()) {
			$this->redirectMsg('登陆成功',['index/index'],3);
			exit;
		}
		if ($this->model->errors) {
			# 存在错误信息
			Web::app()->Session->setFlash('error',$this->model->errors);
		}
		$this->renderController();
	}

	public function logoutAction(){
		$Session = Web::app()->Session;
		$sessionAdmin = $Session->get('admin');
		$Session->delete('permissionController');
		$Session->delete('admin');
		$this->params['msg'] = '欢迎您下次登陆';
		$this->params['time'] = 3;
		$this->render('logout',$this->_controller);
		// $this->redirectMsg('欢迎您下次登陆',['index'],3);
	}
}