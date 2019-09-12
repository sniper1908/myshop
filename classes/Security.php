<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/10/10 15:10
 * @name 	网站核心文件-安全机制
 */
namespace classes;

class Security
{
	public function init(){
		# 防SQL注入
		$this->_sql_addslashes();
	}

	private function _sql_addslashes(){
		$_POST = $this->_addslashes($_POST);
		$_GET = $this->_addslashes($_GET);
		$_REQUEST = $this->_addslashes($_REQUEST);
	}

	private function _addslashes($var){
		if (is_array($var)) {
			foreach ($var as $key => $value) {
				$var[$key] = $this->_addslashes($value);
			}
		} else {
			$var = trim($var);
			if (!get_magic_quotes_gpc()) {
				$var = addslashes($var);
			}
		}

		return $var;
	}

	public static function stripslashes($var){
		if (is_array($var)) {
			foreach ($var as $key => $value) {
				$var[$key] = self::stripslashes($value);
			}
		} else {
			$var = trim($var);
			if (!get_magic_quotes_gpc()) {
				$var = stripslashes($var);
			}
		}
		return $var;
	}
}