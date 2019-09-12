<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/10/10 10:21
 * @name 	网站框架文件
 */
namespace classes;

class Web
{
	private $_class = [];
	private $_aConfig = [];
	private static $_obj = null;

	private function __construct(){
		# 设置默认时区
		date_default_timezone_set('PRC');
	}

	private function __clone(){}

	public static function app(){
		if (!self::$_obj instanceof self) {
			self::$_obj = new self;
		}

		return self::$_obj;
	}

	public function __get($name){
		$name = strtolower($name);
		if (isset($this->$name)) {
			return $this->$name;
		}

		return null;
	}

	public function __set($key,$value){
		$key = strtolower($key);
		$this->$key = $value;
	}

	public function run(){
		# 初始化config组件给web
		$this->Config = new Config;
		# 获得配置信息
		$this->_aConfig = $this->Config->getAll('params');
		#设置错误报告
		$this->_setErrorReport();
		# 初始化默认的组件
		$this->_init_classes();
	}

	/**
	 * [获取配置信息，如果存在$key并且配置项中存在该配置则返回具体的配置项，不存在该配置项则返回空值，否则返回全部配置数组]
	 * @param  string $key [配置项名]
	 * @return [type]      [string]
	 */
	public function getConfig($key=''){
		if ($key) {
			return isset($this->_aConfig[$key]) ? $this->_aConfig[$key] : '';
		} else {
			# 返回全部配置项
			return $this->_aConfig;
		}
	}

	private function _setErrorReport(){
		# 设置错误报告
		# $aErrSet = $this->Config->getAll('errorset');
		$aErrSet = $this->_aConfig['errorReport'];
		$sDisplayErrors = $aErrSet['display_errors'] ? $aErrSet['display_errors'] : 'off';
		$sErrorReporting = $aErrSet['error_reporting'] ? $aErrSet['error_reporting'] : E_ALL;
		ini_set('display_errors',$sDisplayErrors);
		ini_set('error_reporting',$sErrorReporting);
	}

	private function _init_classes(){
		// $aClasses = $this->Config->get('initClasses' , 'init');
		$aClasses = $this->_aConfig['initClasses'];
		foreach ($aClasses as $c) {
			$rc = 'classes\\'. ucfirst($c);
			if (strpos($c,'\\') != false) {
				$c = strtolower( ltrim(strrchr($c, '\\') , '\\' ) );
			}
			$c = ucfirst($c);
			$this->$c = new $rc;
			if (method_exists($this->$c, 'init')) {
				$this->$c->init();
			}
		}
	}
}