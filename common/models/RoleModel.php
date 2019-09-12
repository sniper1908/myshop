<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/12/4 15:33
 * @name 	网站模型文件-角色模型 
 */
namespace common\models;

use classes\Web;
use classes\ActiveRecord;

class RoleModel extends ActiveRecord
{
	// 验证规则
	public function rules(){
		return [
			['role_name','required'],
			['role_name','string','length'=>[2,7]]
		];
	}

	// 字段对应名称
	public function attributeLabels(){
		return [
			'role_name' 	=> '用户名',
			'order_num' 	=> '排序数字'
		];
	}
}