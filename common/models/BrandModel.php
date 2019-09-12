<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2018/01/08 10:18:32
 * @name 	网站模型文件 - 商品品牌模型
 */
namespace common\models;

use classes\Web;
use classes\ActiveRecord;
use classes\Uploads;

class BrandModel extends ActiveRecord
{
	// 验证规则
	public function rules(){
		return [
			['brand_name','required'],
			['brand_name','string','length'=>[2,20]],
			['site_url','url'],
			['logo','string','length'=>[2,100]],
			['brand_des','string','length'=>[2,200]],
			['order_num','integer'],
			['is_show','integer']
		];
	}

	// 字段对应名称
	public function attributeLabels(){
		return [
			'brand_name' 	=> '品牌名',
			'site_url' 	        => '品牌网址',
			'logo' 	        => '品牌logo',
			'brand_des' 	=> '品牌描述',
			'order_num' 	=> '排序数字',
			'is_show' 		=> '是否显示'
		];
	}

	public function beforeSave(){		
		parent::beforeSave();
		if (!empty($_FILES) && $_FILES['logo']['error']==0) {
			if ($this->logo) {
				# 原图片
				$old_logo = $this->logo;
			}
			# 处理上传图片
			$Uploads = new Uploads('uploads');
			$upload_file = $Uploads->upload($_FILES['logo'],'logo_');
			$this->attributes['logo'] = $upload_file;
			if (isset($old_logo)) {
				# 删除原图
				@unlink($old_logo);
			}
		}
	}
}