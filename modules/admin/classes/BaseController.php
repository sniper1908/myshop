<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/10/26 9:30
 * @name 	网站核心文件-后台基类
 * @desc 	后台基类
 */
namespace modules\admin\classes;

use classes\Web;
use classes\Controller;
use modules\admin\classes\MenuClass;
use modules\admin\classes\AdminHelper;
use common\models\SysMenuModel;
use common\models\RuleModel;
use common\models\PermissionModel;
use common\models\AssignmentModel;

class BaseController extends Controller
{
	public $bBtnTitle = 1;
	// 登陆，菜单中未出现页面，通过url访问，禁止访问
	protected $admin_id = 0;

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
			$this->redirectMsg('您没有登陆',['login/index'],3);
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
		$this->SysMenuModel = new SysMenuModel;
		// 返回列表中的params字符串
		$this->params['urlParamsStr'] = '';
		// 菜单类
		$MenuClass = new MenuClass($sessionAdmin['admin_id']);
		// 获取头部菜单
		$menuHeader = $MenuClass->getHeader();
		$this->params['menuHeader'] = $menuHeader;
		// 获取左侧菜单
		$menuLeft = $MenuClass->getLeft();
		$this->params['menuLeft'] = $menuLeft;
		$this->params['menuTree'] = $this->SysMenuModel->getTree();
		// 获取本控制器的根分类id
		$this->params['mrpid'] = $MenuClass->getMrpid();
		// $this->params['mrpid'] = $this->SysMenuModel->getRootIdForRoute($this->_module.'/'.$this->_controller.'/index');
		// $curRouteData = $this->SysMenuModel->findOne("menu_route='".$this->_module.'/'.$this->_controller.'/index'."'",'id,parent_id');
		$curRouteData = $MenuClass->getCurId();
		$this->params['mpid'] = $curRouteData['parent_id'];
		$this->params['mid'] = $curRouteData['id'];
		$this->params['bBtnTitle'] = $this->bBtnTitle;
		// 如果该页面不是该后台登陆用户具有的权限页面，则跳转到首页
		$sessionPermission = $this->Session->get('permissionController');
		if (empty($sessionPermission)) {
			# 获取该用户具有的权限控制器名
			$permissionController = $MenuClass->getPermissionController($menuLeft);
			$this->Session->set('permissionController',$permissionController);
			$sessionPermission = $permissionController;
		}
		// 如果该页面控制器不在权限范围内
		// print_r($sessionPermission);
		if (empty($sessionPermission) || !in_array(AdminHelper::firstWordToLower($this->_controller),$sessionPermission)) {
			$this->redirectMsg('您没有该权限',['index/index'],3);
			exit;
		}
	}
}