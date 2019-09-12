<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/12/12 9:18
 * @name 	网站模型文件-路由模型 
 */
namespace modules\build\models;

use classes\Web;
use classes\ActiveRecord;

class ModelBuildModel extends ActiveRecord
{
	// 验证规则
	public function rules(){
		return [
			['module_name','required'],
			['module_name','string','length'=>[2,20]],
			['model_name','required'],
			['model_name','string','length'=>[2,15]],
			['model_class','required'],
			['model_class','string','length'=>[2,30]],
			['namespace','required'],
			['namespace','string','length'=>[5,100]],
			['base_class','required'],
			['base_class','string','length'=>[5,100]],
			['created_time','time']
		];
	}

	// 字段对应名称
	public function attributeLabels(){
		return [
			'module_name' 		=> '模块名',
			'model_name' 		=> '模型名',
			'model_class' 		=> '模型名',
			'namespace' 		=> '命名空间',
			'base_class' 		=> '基类名',
			'rules' 			=> '验证规则',
			'labels' 			=> '字段名称',
			'created_time' 		=> '创建时间',
		];
	}

	public function beforeSave(){
		parent::beforeSave();
		// 序列化验证规则
		if (!empty($this->_attributes['rules'])) {
			$this->attributes['rules'] = base64_encode( serialize($this->_attributes['rules']) );
		}else if (!empty($this->attributes['rules'])) {
			$this->attributes['rules'] = base64_encode( serialize($this->attributes['rules']) );
		}
		// 序列化字段名称
		if (!empty($this->_attributes['labels'])) {
			$this->attributes['labels'] = base64_encode( serialize($this->_attributes['labels']) );
		}else if (!empty($this->attributes['labels'])) {
			$this->attributes['labels'] = base64_encode( serialize($this->attributes['labels']) );
		}
	}

	// public function getList(){
	// 	$res = [];
	// 	$select = [];
	// 	$select['where'] = "`route_action`='*'";
	// 	$data = $this->select($select);
	// 	if (!empty($data)) {
	// 		foreach ($data as $key => $row) {
	// 			# 获取action不为*的数据
	// 			$cond = [];
	// 			$cond['where'] = "`route_controller`='".$row['route_controller']."'";
	// 			$cond['order'] = "`order_num` asc,id asc";
	// 			$children = $this->select($cond);
	// 			// $res[] = $row;
	// 			if (!empty($children)) {
	// 				foreach ($children as $k => $v) {
	// 					$res[] = $v;
	// 				}
	// 			}
	// 		}
	// 	}
	// 	// print_r($res);
	// 	return $res;
	// }
}