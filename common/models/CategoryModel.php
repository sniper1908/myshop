<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2018/01/08 09:57:12
 * @name 	网站模型文件 - 商品分类模型
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
			'parent_id' 	=> '上级分类',
			'order_num' 	=> '排序数字',
			'keywords' 		=> '关键字',
			'des' 			=> '描述',
			'measure_unit' 	=> '数量单位',
            'recommend'  	=> '设置为首页推荐',
			'show_in_nav' 	=> '导航栏显示',
			'is_show' 		=> '前台显示',
			'price_range' 	=> '价格区间个数',
			'style_url' 	=> '样式路径',
			'filter_attr'	=> '筛选属性'
		];
	}

	public function beforeSave()
	{
		# 入库之前将推荐信息格式化
		if (isset($_POST['recommend']) && $_POST['recommend']) {
			$this->attributes['recommend'] = implode(',', $_POST['recommend']);
		}
	}

	public function getParentName($parent_id=0){
		$parent_name = '根分类';
		if ($parent_id) {
			$parent_name = $this->fetchColumnForPk($parent_id,'cate_name');
		}
		return $parent_name;
	}

	public function getTreeList($parent_id=0,$level=1)
	{
		# 获取父ID=$parent_id的数据
		$data = $this->select(['where'=>"`parent_id`='".$parent_id."'"]);
		if (!empty($data)) {
			foreach ($data as $key => $value) {
				$data[$key]['level'] = $level;
				$this->tree($value['parent_id'],++$level);
			}
		}
		return $data;
	}
}