<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/10/26 9:30
 * @name 	网站核心文件-后台基类
 * @desc 	后台基类
 */
namespace modules\build\classes;

use classes\Web;
use classes\Controller;

class BaseController extends Controller
{
	public $bBtnTitle = 1;
	// 登陆，菜单中未出现页面，通过url访问，禁止访问
	protected $admin_id = 0;
	protected $backModule = 'admin';

	public function __construct(){
		parent::__construct();
		// session信息
		$this->Session = Web::app()->Session;
		$sessionAdmin = $this->Session->get('admin');
		// print_r($_SESSION);
		// 登陆情况
		if ($this->_controller != 'login' && empty($sessionAdmin)) {
			# 没有session信息
			$this->params = [];
			$this->redirectMsg('您没有登陆',[$this->backModule.'/login/index'],3);
			exit;
		}
		else if (!$sessionAdmin['status']) {
			# 没有登陆权限
			$this->params = [];
			$this->redirectMsg('您没有登陆权限',['login/index'],3);
			exit;
		}
		$this->admin_id = $sessionAdmin['admin_id'];
		$this->params['module'] = $this->_module;
		$this->params['controller'] = $this->_controller;
		$this->params['action'] = $this->_action;
		$this->params['sessionAdmin'] = $sessionAdmin;
		$this->params['bBtnTitle'] = $this->bBtnTitle;
	}

	protected function getClassName($classStr){
		$classStr = str_replace('\\','/',$classStr);
		$pos = strrpos($classStr,"/");
		$res = substr($classStr,$pos+1);
		return $res;
	}
}