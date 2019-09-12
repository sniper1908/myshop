<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2018/02/03 11:52:34
 * @name 	网站模型文件 - 商品类型模型
 */
namespace common\models;

use classes\Web;
use classes\ActiveRecord;

class GoodsTypeModel extends ActiveRecord
{
	// 验证规则
	public function rules(){
		return [ ['cate_name','required'], ['cate_name','string','length'=>[2,30]], ['attr_group','string','length'=>[2,200]],['enabled','number'] ];
	}

	// 字段对应名称
	public function attributeLabels(){
		return [ 'cate_name' => '类型名', 'enabled' => '类型状态', 'attr_group' => '属性分组' ];
	}

	public function beforeValidate()
	{
		# 验证之前格式化属性分组
		parent::beforeValidate();
		if ($_POST['GoodsType']['attr_group']) {
			$attr_group = $_POST['GoodsType']['attr_group'];
			$attr_group = trim($attr_group);
			// 如果存在全角的逗号，替换成半角的逗号
			$attr_group = str_replace('，', ',', $attr_group);
			$this->attributes['attr_group'] = $attr_group;
		}
		if (isset($_POST['GoodsType']['enabled']) && $_POST['GoodsType']['enabled']=='on') {
			$this->attributes['enabled'] = 1;			
		} else {
			$this->attributes['enabled'] = 0;
		}
	}
}