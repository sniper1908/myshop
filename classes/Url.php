<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/11/17 10:34
 * @name 	网站核心文件-Url类
 */
namespace classes;

class Url
{
	public static function to($url){
		if (is_string($url) || (is_array($url) && count($url)==1) ) {
			if (is_array($url)) {
				$url = $url[0];
			}
			# 如果url是字符串，site/index
			$goUrl = self::makeUrl($url);
			self::goHeader($goUrl);
			return false;
		}else if( is_array($url) ){
			// 数组 ['site/index','param1'=>'value1','param2'=>'value2',...]
			$url = array_filter($url);
			$count = count($url);
			if ($count<2) {
				# 只有一个或是个空数组
				return;
			}
			$params = $url;
			array_shift($params);
			$paramStr = '';
			foreach ($params as $key => $value) {
				# 连接参数，组成&param1=value1&param2=value2的形式
				$paramStr .= '&'.$key.'='.$value;
			}
			$goUrl = self::makeUrl($url[0]);
			$goUrl .= $paramStr;
			// echo $goUrl;exit;
			self::goHeader($goUrl);
			return false;
		}
	}

	public static function makeUrl($url){
		$oRoute = Web::app()->Route;
		$module = $oRoute->getModule();
		$controller = $oRoute->getController();
		$action = $oRoute->getAction();
		$varName = $oRoute->getRouteVarName();

		$goUrl = 'index.php?'.$varName.'=';

		$str = $mStr = '';
		if ($module) {
			$mStr = $module.'/';
		}

		if (!$url) {
			# 空字符串，则返回本页面
			$goUrl .= $mStr . $controller . '/' . $action;
			return $goUrl;
		}

		$urlArr = explode('/',$url);
		$count = count($urlArr);
		switch ($count) {
			case 1:
				# 1个字符串，则跳转本控制器下的指定页面
				$action = $urlArr[0] ? $urlArr[0] : $action;
				$str = $mStr . $controller . '/' . $action;
				break;
			case 2:
				# 2个字符串，则跳转指定控制器下的指定页面
				$action = $urlArr[1] ? $urlArr[1] : $action;
				$str = $mStr . $urlArr[0].'/'.$action;
				break;
			case 3:
				# 3个字符串，则跳转指定模块下指定控制器的指定页面
				$controller = $urlArr[1] ? $urlArr[1] : $controller;
				$action = $urlArr[2] ? $urlArr[2] : $action;
				$str = $urlArr[0].'/'.$controller.'/'.$action;
				break;
			default:
				# 1个字符串都没有，则为本页面
				$str = $mStr . $controller.'/'.$action;
		}
		$goUrl .= $str;

		return $goUrl;
	}

	public static function makeUrlParams($data){
		$url = self::makeUrl($data[0]);
		$params = $data;
		array_shift($params);
		$paramStr = '';
		foreach ($params as $key => $value) {
			# 连接参数，组成&param1=value1&param2=value2的形式
			$paramStr .= '&'.$key.'='.$value;
		}
		return $url.$paramStr;
	}

	public static function makeUrlParams2($data,$var){
		$url = self::makeUrl($data[0]);
		$expArr = explode('&',$data[1]);
		foreach ($expArr as $key => $value) {
			$expValue = explode('=',$value);
			# 将param中没有值的变量赋值给$var
			if (!$expValue[1]) {
				$expArr[$key] = $expValue[0].'='.$var;
			}
		}
		$impArr = implode('&', $expArr);
		$paramStr = '&'.$impArr;
		return $url.$paramStr;
	}

	public static function goBack(){
		echo "<script>location.go(-1);</script>";
		exit;
	}

	protected static function goHeader($url){
		Header("Location:".$url);
		return false;
	}

	/**
     * 获取url地址
     * @param $url   string 模块/类名/方法名
     * @param $paras array  键值对 id=1,cate_id=1
     * @return string 完整的url地址
     *
     * */
	public static function U($url,$params=[]){
		if (strpos($url, 'http') !== false) {
			return $url;
		}

		$oApp = Web::app();
		$oRoute = $oApp->Route;
		if ($oRoute->getConfig('urlMode')==0) {
			$pstr = '';
			if (!empty($params)) {
				foreach ($params as $key => $value) {
					$pstr .= '&'.$key.'='.$value;
				}
			}

			return $_SERVER['SCRIPT_NAME'].'?'.$oRoute->getRouteVarName().'='.$url.$pstr;
		}
	}
}