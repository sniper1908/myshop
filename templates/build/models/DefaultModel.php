<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/12/4 15:33
 * @name 	网站模型文件-模型 
 */
namespace <%namespace%>;

use classes\Web;
use <%base_class%>;

class RoleModel extends <%baseClassName%>
{
	// 验证规则
	public function rules(){
		return <%rules%>;
	}

	// 字段对应名称
	public function attributeLabels(){
		return <%labels%>;
	}
}