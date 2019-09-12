<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/10/25 16:00
 * @name 	网站核心文件-接收信息处理类
 */
namespace classes;

class Request
{
	protected $_queryParams;

	/**
     * Returns the method of the current request (e.g. GET, POST, HEAD, PUT, PATCH, DELETE).
     * @return string request method, such as GET, POST, HEAD, PUT, PATCH, DELETE.
     * The value returned is turned into upper case.
     */
    public function getMethod()
    {
        if (isset($_POST[$this->methodParam])) {
            return strtoupper($_POST[$this->methodParam]);
        }

        if (isset($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE'])) {
            return strtoupper($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE']);
        }

        if (isset($_SERVER['REQUEST_METHOD'])) {
            return strtoupper($_SERVER['REQUEST_METHOD']);
        }

        return 'GET';
    }

    /* 
     * 判断是否是Ajax请求
     * HTTP_X_REQUESTED_WITH 不是系统变量 而是header传过来的变量 可以任意设置
     * 前台 xhr.setRequestHeader('X_REQUESTED_WITH','任意字符');
     * 后台 通过$_SERVER['HTTP_X_REQUESTED_WITH']来接收变量，然后做判断
     * 前台通过header发送过来的变量与 HTTP_连接 在后台进行接收
     * 譬如
     * xhr.setRequestHeader('test','just a test');
     * 后台就可以用$_SERVER['HTTP_TEST']获取test的值
     * 前台test不固定大小写
     * 后台使用$_SERVER获取时必须大写$_SERVER['HTTP_TEST']
     *
     * */
    public function isAjax(){
        return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest');
    }

    // 判断是否是post请求
    public function isPost(){
    	return $this->getMethod() === 'POST';
        // return ($_SERVER['REQUEST_METHOD']=='POST');
    }

    // 判断是否是get请求
    public function isGet(){
    	return $this->getMethod() === 'GET';
        // return ($_SERVER['REQUEST_METHOD']=='GET');
    }

    // 判断请求方法是否是HEAD
    public function isHead(){
    	return $this->getMethod() === 'HEAD';
        // return ($_SERVER['REQUEST_METHOD']=='HEAD');
    }

    // 判断请求方法是否是PUT
    public function isPut(){
    	return $this->getMethod() === 'PUT';
        // return ($_SERVER['REQUEST_METHOD']=='PUT');
    }

    // 获取表单提交的全部内容
    public function getFormContents(){
    	$method = $this->getMethod();
    	switch ($method) {
    		case 'POST':
    			# code...
    			$res = $_POST;
    			break;
    		case 'GET':
    			$res = $_GET;
    			break;
    		
    		default:
    			# code...
    			break;
    	}

    	return $res;
    }

    /**
     * 获取表单项中给定的内容
     * @param  [string] $name    [表单项name]
     * @param  string $default [要获取的表单项的默认值]
     * @return [mixed]          [表单项内容]
     */
    public function getFormContent($name,$default=''){
    	$content = $this->getFormContents();
    	return isset($content[$name]) ? $content[$name] : $default;
    }

    /**
     * 获取通过post提交的表单内容
     * @param  string $name    [表单项name]
     * @param  string $default [要获取的表单项默认值]
     * @return [mixed]          [post提交的表单内容]
     */
    public function post($name='',$default=''){
    	if ($name===null) {
    		return $this->getFormContents();
    	} else {
    		return $this->getFormContent($name,$default);
    	}
    	
    }

    public function setQueryParams($values){
    	$this->_queryParams = $values;
    }

    public function getQueryParams(){
    	if ($this->_queryParams===null) {
    		return $_GET;
    	}
    	return $this->_queryParams;
    }

    public function getQueryParam($name,$default=''){
    	$content = $this->getQueryParams();
    	return isset($content[$name]) ? $content[$name] : $default;
    }

    public function get($name='',$default=''){
    	if ($name===null) {
    		return $this->getQueryParams();
    	} else {
    		return $this->getQueryParam($name,$default);
    	}
    }

    /**
     *
     * 获取用户ip地址
     *
     * */
    public static function getIP() { 
        if (@$_SERVER["HTTP_X_FORWARDED_FOR"]) 
            $ip = $_SERVER["HTTP_X_FORWARDED_FOR"]; 
        else if (@$_SERVER["HTTP_CLIENT_IP"]) 
            $ip = $_SERVER["HTTP_CLIENT_IP"]; 
        else if (@$_SERVER["REMOTE_ADDR"]) 
            $ip = $_SERVER["REMOTE_ADDR"]; 
        else if (@getenv("HTTP_X_FORWARDED_FOR"))
            $ip = getenv("HTTP_X_FORWARDED_FOR"); 
        else if (@getenv("HTTP_CLIENT_IP")) 
            $ip = getenv("HTTP_CLIENT_IP"); 
        else if (@getenv("REMOTE_ADDR")) 
            $ip = getenv("REMOTE_ADDR"); 
        else 
            $ip = "Unknown"; 
        $int_ip = $ip=='Unknown' ? 0 : ip2long($ip);
        return $int_ip; 
    }

	// 设置header
    public static function header($header){
        header($header);
    }

}