<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2018/02/04 11:01:33
 * @name 	网站模型文件 - 商品类型属性模型
 */
namespace common\models;

use classes\Web;
use classes\ActiveRecord;
use common\models\GoodsTypeModel;

class AttributeModel extends ActiveRecord
{
	// 验证规则
	public function rules(){
		return [ 
			['attr_name','required'], 
			[
				'attr_name',
				'string',
				'length'=>[2,15]
			]
		];
	}

	// 字段对应名称
	public function attributeLabels(){
		return [
			'attr_name' => '属性名称',
			'cate_id' => '所属商品类型',
			'attr_index' => '能否进行检索',
			'is_linked' => '相同属性值的商品是否关联',
			'attr_type' => '属性是否多选',
			'attr_input_type' => '该属性的录入方式',
			'order_num' => '排序数字',
			'attr_group' => '属性分组',
			'attr_values' => '可选值列表'
		];
	}

	// 根据cate_id获取商品类型名
	public function getCateName($cate_id=0)
	{
		if (!$cate_id) {
			# 商品属性详情页
			$cate_id = $this->cate_id;
			$model = $this;
		}else{
			# 根据cate_id查出商品类型名
			$model = new GoodsTypeModel;
		}
		
		$goods_type_name = $model->fetchColumnForPk($cate_id,'cate_name');
		return $goods_type_name;
	}

	// 获取商品类型列表，id->value键值对
	public function getTypeList()
	{
		$model = new GoodsTypeModel;
		$select = [];
		$select['cols'] = "id,cate_name";
		$list = $model->select($select);
		$res = [];
		if (!empty($list)) {
			foreach ($list as $key => $value) {
				$res[$value['id']] = $value['cate_name'];
			}
		}
		return $res;
	}

	// 提交之前，如果录入方式不是从列表中选择，则清空可选值列表
	public function beforeSave()
	{
		if ($_POST['Attribute']['attr_input_type']!=1) {
			# 清空可选值列表
			$this->_attributes['attr_values'] = '';
		}
	}
}