<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/12/7 15:33
 * @name 	网站模型文件-权限分配模型 
 */
namespace common\models;

use classes\Web;
use classes\ActiveRecord;

class AssignmentModel extends ActiveRecord
{
	// 验证规则
	public function rules(){
		return [
			['admin_id','required'],
			['role_id','required'],
		];
	}

	// 字段对应名称
	public function attributeLabels(){
		return [
			'admin_id' 	=> '用户名',
			'role_id' 	=> '角色'
		];
	}
}