<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/10/11 10:41
 * @name 	网站核心文件-视图类
 */
namespace classes;

use classes\Security;

class View
{
	protected $_url;
	protected $_msg;
	protected $_param;
	protected $_time = 3;

	public function __construct(){
		$this->_Route = Web::app()->Route;
		$this->_module = $this->_Route->getModule();
	}

	public function msg($msg,$url,$time=3,$params=[]){
		$this->params = $params;
		// echo $msg.'==='.$url.'==='.$time;
		$this->params['page_title'] = $msg.' -- 跳转提示';
		$this->params['have_script'] = 0;
		$this->params['bBtnTitle'] = 0;
		$this->params['url'] = $url;
		$this->params['msg'] = $msg;
		$this->params['time'] = $time ? $time : $this->_time;
		include_once ROOT . '/modules/'.$this->_module . '/views/layout/message.php';
	}

	public function getFlashPage($msg){
		return include_once ROOT . '/modules/'.$this->_module . '/views/layout/flash.php';
	}

	public static function unserializeData($data){
		echo Security::stripslashes( unserialize( base64_decode($data) ) );
	}

	// header方式跳转
	// public function redirect($url){
	// 	Helper::header('Location:'.$url);
	// 	exit;
	// }

	// public function render($tpl,$data=[],$layout=''){
		
	// }
}