<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/12/4 15:33
 * @name 	网站模型文件-模型 
 */
namespace common\models;

use classes\Web;
use classes\ActiveRecord;

class testModel extends $baseClassName$
{
	// 验证规则
	public function rules(){
		return [[
			['module_name','required'],
			['module_name','string','length'=>[2,20]],
			['model_class','required'],
			['model_class','string','length'=>[2,30]],
			['namespace','required'],
			['namespace','string','length'=>[5,100]],
			['base_class','required'],
			['base_class','string','length'=>[5,100]]
		]];
	}

	// 字段对应名称
	public function attributeLabels(){
		return [[
			'module_name' 		=> '模块名',
			'model_class' 		=> '模型名',
			'namespace' 		=> '命名空间',
			'base_class' 		=> '基类名',
			'rules' 			=> '验证规则',
			'labels' 			=> '字段名称',
		]];
	}
}