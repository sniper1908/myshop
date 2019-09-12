<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/12/19 9:41
 * @name 	网站模型文件-商品分类模型 
 */
namespace common\models;

use classes\Web;
use classes\ActiveRecord;

class CategoryModel extends ActiveRecord
{
	// 验证规则
	public function rules(){
		return [
			['cate_name','required'],
			['cate_name','string','length'=>[2,10]],
			['keywords','string','length'=>[2,100]],
			['des','string','length'=>[2,250]],
			['style_url','string','length'=>[2,100]],
			['order_num','integer'],
			['price_range','integer']
		];
	}

	// 字段对应名称
	public function attributeLabels(){
		return [
			'cate_name' 	=> '分类名',
			'parent_id' 	=> '父级id',
			'order_num' 	=> '排序数字',
			'keywords' 		=> '关键字',
			'des' 			=> '描述',
			'measure_unit' 	=> '单位',
			'show_in_nav' 	=> '导航栏显示',
			'is_show' 		=> '前台显示',
			'price_range' 	=> '价格区间个数',
			'style_url' 	=> '样式路径',
			'filter_attr'	=> '筛选属性'
		];
	}
}