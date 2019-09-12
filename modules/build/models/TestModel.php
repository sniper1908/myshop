<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/12/22 10:01:45
 * @name 	网站模型文件 - 测试模型
 */
namespace modules\build\models;

use classes\Web;
use classes\ActiveRecord;

class TestModel extends ActiveRecord
{
	// 验证规则
	public function rules(){
		return ;
	}

	// 字段对应名称
	public function attributeLabels(){
		return ;
	}
}