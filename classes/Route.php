<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/10/10 10:21
 * @name 	网站核心文件-路由类
 */
namespace classes;

class Route
{
	private $_aConfig = [];
	private $_module;
	private $_controller;
	private $_action;
	private $_routeVarName = 'r';
	private $_aParam = [];

	public function init(){
		# 获取配置项
		$this->_aConfig = Web::app()->Config->getOne('route','params');
		# 解析URL地址
		$this->_parseURI();
		# 设置路径
		$this->_setPath();
		# 分发
		$this->_dispatch();
	}

	// 获得url上 index.php?r=front/index/index 这个r
    public function getRouteVarName(){
        return $this->_routeVarName;
    }

    // 获得配置中某个变量
    public function getConfig($name){
        return $this->_aConfig[$name];
    }

    // 获得模块名
    public function getModule(){
        return $this->_module;
    }

    // 获得控制器名
    public function getController(){
        return $this->_controller;
    }

    // 获得方法名
    public function getAction(){
        return $this->_action;
    }

    // 获得url参数
    public function getParam(){
        return $this->_aParam;
    }

    // 解析url地址
    private function _parseURI(){
        // urlMode 0- index.php?r=admin/index/index
        if ($this->_aConfig['urlMode']==0) 
        {
            $route = isset($_REQUEST[$this->_routeVarName]) ? trim($_REQUEST[$this->_routeVarName]) : '';
            if ($route) 
            {
                $route = explode('/',$route);
				$route = array_filter($route);
                $_count = count($route);
                if ($_count==1) 
                {
                    $this->_module     = $this->_aConfig['defaultModule'];
                    $this->_controller = $route[0];
                    $this->_action     = $this->_aConfig['defaultAction'];
                }else if($_count==2){
                    $this->_module     = $this->_aConfig['defaultModule'];
                    $this->_controller = $route[0];
                    $this->_action     = $route[1];
                }else if($_count==3){
                    $this->_module     = $route[0];
                    $this->_controller = $route[1];
                    $this->_action     = $route[2];
                }else{
                    // 具有其他参数
                    // for ($i = 3; $i < $_count-1; $i+2) 
                    // {
                         // $this->_aParam[$route[$i]] = $route[$i+1];
                    // }
                }
            }else{
                $this->_module     = $this->_aConfig['defaultModule'];
                $this->_controller = $this->_aConfig['defaultController'];
                $this->_action     = $this->_aConfig['defaultAction'];
            }
        }
    }

    // 设置常量
    protected function _setPath(){
        // configs文件夹
        define('CONFIG_DIR' , ROOT . '/configs/');
        // img js css 模板文件存放文件夹
        // define('STATICS_DIR' , ROOT . '/statics/' );
        define('STATICS_DIR' , CSS_ROOT . '/statics/' );
        // 公用静态文件文件夹，包含CSS/JS文件
        define('STATICS_PUBLIC_DIR' , STATICS_DIR . 'public/' );
        // 公用CSS文件夹
        define('STATICS_PUBLIC_CSS_DIR' , STATICS_PUBLIC_DIR . 'css/' );
        // 公用JS文件夹
        define('STATICS_PUBLIC_JS_DIR' , STATICS_PUBLIC_DIR . 'js/' );
        // 公用avatars文件夹
        define('STATICS_PUBLIC_AVATARS_DIR' , STATICS_PUBLIC_DIR . 'avatars/' );
        // bootstrap文件夹
        define('TEMP_BS_DIR' , STATICS_DIR . 'bootstrap/' );
        // 公共js文件夹
        define('TEMP_JS_DIR' , STATICS_DIR . 'js/' );
        // 公共layout文件夹
        define('TEMP_LAYOUT_DIR' , STATICS_DIR . 'layout/' );
        // statics文件夹中模块文件夹
        define('STATICS_MODULE_DIR' , STATICS_DIR . $this->_module . '/' );
        // statics文件夹中模块文件夹的images文件夹
        define('STATICS_MODULE_IMG' , STATICS_MODULE_DIR . 'images/' );
        // statics文件夹中模块文件夹的js文件夹
        define('STATICS_MODULE_JS' , STATICS_MODULE_DIR . 'js/' );
        // statics文件夹中模块文件夹的js文件夹
        define('STATICS_MODULE_STYLE' , STATICS_MODULE_DIR . 'style/' );
    }

    // 分发
    private function _dispatch(){
        $controllerName = '\\modules\\'.$this->_module.'\\controllers\\'.ucfirst($this->_controller);
        $controller = new $controllerName;
        $actionName = strtolower($this->_action) . 'Action';
        // $actionName = ucfirst($this->_action) . 'Action';
        $controller->$actionName();
    }
}