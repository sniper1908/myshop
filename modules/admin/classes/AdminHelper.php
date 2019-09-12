<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/10/18 9:14
 * @name 	网站后台文件-公共类-帮助文件
 */
namespace modules\admin\classes;

use classes\Route;

class AdminHelper
{
	public static function checkMenu(){
		$oRoute = new Route;
		$controller = $oRoute->getController();
	}

	public static function firstWordToLower($word){
		$first = substr($word, 0,1);
		$last = substr($word,1);
		$res = strtolower($first).$last;
		return $res;
	}
}