<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/10/11 10:00
 * @name 	网站核心文件-控制器类
 */
namespace classes;

use classes\Url;

class Controller
{
	protected $_oApp = null;
	protected $_module;
	protected $_controller;
	protected $_action;
	protected $_aConfig = [];
	protected $_oView = null;
	protected $have_script = 0;

	public function __construct(){
		$this->_oApp = Web::app();
		$this->_oView = new View;
		$this->_module = $this->_oApp->Route->getModule();
		$this->_controller = $this->_oApp->Route->getController();
		$this->_action = $this->_oApp->Route->getAction();
		$this->_aConfig = $this->_oApp->getConfig();
		if ($this->_module) {
			# 获取包含该模块的配置信息
			$this->_aConfig = $this->_oApp->Config->getAll('params',$this->_module);
		}
	}

	public function redirect($url){
		Url::to($url);
	}

	public function redirectMsg($msg,$url,$time=3){
		$this->_oView->msg($msg,$url,$time,$this->params);
	}

	public function display(){

	}

	public function render($tpl,$dir='layout'){
		$module = strtolower($this->_module);
		$dir = $dir ? $dir : $this->layout;
		include_once ROOT . '/modules/'.$module . '/views/'.$dir.'/'.$tpl.'.php';
	}

	public function renderController($tpl='index'){
		$module = strtolower($this->_module);
		$controller = strtolower($this->_controller);
		include_once ROOT . '/modules/'.$module . '/views/'.$controller.'/'.$tpl.'.php';
	}

	public function renderInclude($viewName='',$controller=''){
		// $module = strtolower($this->_module);
		$this->params['module'] = $this->_module;
		// $this->controller = strtolower($this->_controller);
		$controller = $controller ? $controller : $this->_controller;
		$this->params['controller'] = $controller;
		// $this->params['action'] = strtolower($this->_action);
		$this->params['action'] = $this->_action;
		$this->params['have_script'] = $this->have_script;
		$viewName = $viewName ? $viewName : strtolower($this->_action);
		$viewName = $viewName ? $viewName : 'right';
		$module = strtolower($this->_module);
		$controller = strtolower($this->_controller);
		$action = strtolower($this->_action);
		include_once ROOT . '/modules/'.$module . '/views/layout/header.php';
		include_once ROOT . '/modules/'.$module . '/views/layout/left.php';
		include_once ROOT . '/modules/'.$module . '/views/layout/right.php';
		include_once ROOT . '/modules/'.$module . '/views/' . $controller . '/'.$viewName.'.php';
		include_once ROOT . '/modules/'.$module . '/views/layout/footer.php';
	}

	public static function renderWidgetView($namespace,$data=[],$tpl='index',$suffix='.php'){
		// print_r($data);
		$namespace = str_replace('\\','/',$namespace);
		include_once ROOT . '/' . $namespace . '/views/'.$tpl.$suffix;
	}
}