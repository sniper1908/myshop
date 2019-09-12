<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/12/12 9:18
 * @name 	网站模型文件-路由模型 
 */
namespace modules\build\models;

use classes\Web;
use classes\ActiveRecord;

class FormBuildModel extends ActiveRecord
{
	// 验证规则
	public function rules(){
		return [
			['controller_name','required'],
			['controller_name','string','length'=>[2,15]],
			['controller_class','required'],
			['controller_class','string','length'=>[2,30]],
			['module_name','required'],
			['module_name','string','length'=>[2,20]],
			['model_class','required'],
			['model_class','string','length'=>[2,30]],
			['created_time','time']
		];
	}

	// 字段对应名称
	public function attributeLabels(){
		return [
			'controller_name' 	=> '控制器名',
			'controller_class' 	=> '控制器类名',
			'module_name' 		=> '模块名',
			'model_class' 		=> '模型类名',
			'created_time' 		=> '创建时间',
		];
	}
}