<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/11/3 9:00
 * @name 	网站模型文件-菜单模型 
 */
namespace common\models;

use classes\ActiveRecord;
use common\models\SysRouteModel;

class SysMenuModel extends ActiveRecord
{
	// 验证规则
	public function rules(){
		return [
			// [['menu_name','menu_route'],'required','message'=>'该项为必填项'],
			['menu_name','required','message'=>'该项为必填项'],
			// ['parent_id','number','message'=>'该项为整数'],
			// ['password','default','value'=>"1234567"],
			// ['password','compare','compareAttribute'=>'chkpassword','operator'=>'=='],
			// ['email','date','format'=>'Y-m-d'],
			// ['password','string','length'=>[2,4]],
		];
	}

	// 字段对应名称
	public function attributeLabels(){
		return [
			'menu_name' 	=> '菜单名称',
			'parent_id' 	=> '父级id',
			'menu_route' 	=> '路由地址',
			'order_num' 	=> '排序数字',
			'json_data'		=> '自定义数据',
			'password' 		=> '密码',
			'chkpassword' 	=> '再次输入密码',
		];
	}

	public function beforeSave(){
		$id = $this->attributes['sys_route_id'];
		$SysRouteModel = new SysRouteModel;
		$routeUrl = $SysRouteModel->fetchColumnForPK($id,'route_url');
		$this->attributes['menu_route'] = $routeUrl;
	}

	public function getRootIdForRoute($route){
		$where = "menu_route='".$route."'";
		$data = $this->findOne($where);
		if (!empty($data)) {
			# 根据id获取根分类id
			$_pk = $this->_pk;
			$pid = $this->getParentId($data[$this->_pk]);
			// $pid = $this->fetchColumnForPK($data['parent_id'],'parent_id');
			return $pid;
		}
		return 0;
	}

	public function getPermissionMenuData($data){
		foreach ($data as $pid => $children) {
			$res[$pid]['menu_name'] = $this->fetchColumnForPK($pid,'menu_name');
			if (!empty($children)) {
				foreach ($children as $cid => $grand) {
					$res[$pid]['children'][$cid]['menu_name'] = $this->fetchColumnForPK($cid,'menu_name');
					if (!empty($grand)) {
						foreach ($grand as $gid) {
							$res[$pid]['children'][$cid]['children'][$gid]['menu_name'] = $this->fetchColumnForPK($gid,'menu_name');
						}
					}
				}
			}
		}
		// print_r($res);
		return $res;
	}
}