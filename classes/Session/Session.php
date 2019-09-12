<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/10/10 15:14
 * @name 	网站核心文件-session机制
 */
namespace classes\Session;

use classes\View;

class Session
{
	private $_aConfig = [];

	public function init(){
		$this->_aConfig = \classes\Web::app()->Config->getOne('session','params');
		if ($this->_aConfig['saveType'] == 'php') {
			session_start();
		}
	}

	public function get($name){
		if ($this->_aConfig['saveType'] == 'php') {
			if (isset($_SESSION[$name])) {
				return $_SESSION[$name];
			}

			return null;
		}
	}

	public function set($name,$value){
        if ($this->_aConfig['saveType']=='php') 
        {
            $_SESSION[$name] = $value;
        }
    }

    public function delete($name){
        if ($this->_aConfig['saveType']=='php') 
        {
            unset($_SESSION[$name]);
        }
    }

    public function clear(){
        if ($this->_aConfig['saveType']=='php') 
        {
            $_SESSION = array();
            // 如果有cookie
            if (isset($_COOKIE[session_name()])) 
            {
                setCookie(session_name() , '' , 0);
            }
            // 销毁session
            session_destroy();
        }
    }

    public function setFlash($key,$message,$default=null){
        $this->set($key,$message);
    }

    public function getFlash($key,$default=null,$delete=true){
        $msg = $this->get($key);
        if ($delete) {
            # 如果要删除错误提示
            $this->delete($key);
        }
        $oView = new View;
        $oView->getFlashPage($msg);
    }

    public function hasFlash($key){
        $msg = $this->get($key);
        return $msg ? true : false;
    }
}