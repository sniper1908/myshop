<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/12/28 10:08
 * @name 	网站核心文件-小部件基类
 */
namespace classes\widgets;

use classes\Controller;

class Widgets extends Controller
{
	public static function widget($params){
		self::run($params);
	}

	public static function run($params){
		static::run($params);
	}

	public static function getAttributes($params){
		$model = $params['model'];
		$attributes = $model->attributeLabels();
		if (isset($params['attributes']) && $params['attributes']) {
			$paramsAttr = explode(',', $params['attributes']);
			foreach ($paramsAttr as $key) {
				# code...
				if (isset($attributes[$key])) {
					# 如果$key在labels里
					$_attributes[$key] = $attributes[$key];
				}else if($model->$key){
					$_attributes[$key] = $model->$key;
				}
			}
		} else {
			$_attributes = $attributes;
		}
		return $_attributes;	
	}
}