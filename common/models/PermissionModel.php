<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/12/4 15:33
 * @name 	网站模型文件-权限模型 
 */
namespace common\models;

use classes\Web;
use classes\ActiveRecord;

class PermissionModel extends ActiveRecord
{
	// 验证规则
	public function rules(){
		return [
			['permission_name','required'],
			['permission_name','string','length'=>[2,7]]
		];
	}

	// 字段对应名称
	public function attributeLabels(){
		return [
			'permission_name' 	=> '权限名称',
			'order_num' 		=> '排序数字'
		];
	}

	protected function beforeSave(){
		parent::beforeSave();
		// print_r($_POST);
		/**
		 * 如果只选择了一级权限
		 * 	则二级权限三级权限默认全选
		 * 如果选择了一级权限和二级权限
		 * 	则三级权限默认全选
		 * 如果选择了一级权限和三级权限
		 * 	则需要把二级权限选择
		 * 如果只选择了二级权限
		 * 	则需要把一级权限选择并默认三级权限全选
		 * 如果选择了二级权限和三级权限
		 * 	则需要把一级权限选择
		 * 如果只选择了三级权限
		 * 	则需要把一级二级权限选择
		 * 如果一级二级三级权限都选择了
		 */
		// 一二三级权限都没有选择
		$parent 	= isset($_POST['parent']) ? $_POST['parent'] : [];
		$children 	= isset($_POST['children']) ? $_POST['children'] : [];
		$grand 		= isset($_POST['grand']) ? $_POST['grand'] : [];
		$data 		= [];
		if (empty($parent) && empty($children) && empty($grand)) {
			# 什么都不做
			# 如果parent为null，表示没有选择权限，菜单不显示
			$data = null;
		}
		else{
			$data = $grand;

			if(!empty($children)){
				foreach ($children as $pid => $row) {
					foreach ($row as $cid) {
						if (!isset($data[$pid][$cid])) {
							$data[$pid][$cid] = [];
						}
					}
				}				
			}

			if (!empty($parent)) {
				foreach ($parent as $pid) {
					if (!isset($data[$pid])) {
						$data[$pid] = [];
					}
				}
			}
		}
		$this->attributes['json_data'] = json_encode($data);
	}

	public function getList($model){
		$select = [];
		$select['order'] = "order_num asc,id asc";
		$list = $this->select($select);
		if (!empty($list)) {
			foreach ($list as $key => $value) {
				$list[$key]['role_name'] = $model->fetchColumnForPK($value['role_id'],'role_name');
			}
		}
		return $list;
	}
}