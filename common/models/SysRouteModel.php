<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/12/12 9:18
 * @name 	网站模型文件-路由模型 
 */
namespace common\models;

use classes\Web;
use classes\ActiveRecord;

class SysRouteModel extends ActiveRecord
{
	// 验证规则
	public function rules(){
		return [
			['route_module','required'],
			['route_controll','required'],
			// ['route_action','required'],
			['route_module','string','length'=>[2,12]],
			['route_controll','string','length'=>[2,12]],
			['route_action','string','length'=>[2,12],'default'=>'*']
		];
	}

	// 字段对应名称
	public function attributeLabels(){
		return [
			'route_module' 		=> '模块',
			'route_controll' 	=> '控制器',
			'route_action' 		=> '方法',
			'order_num' 		=> '排序数字'
		];
	}

	public function beforeSave(){
		// 组合模块/控制器/方法
		$this->attributes['route_url'] = $this->attributes['route_module'].'/'.$this->attributes['route_controller'];
		$this->attributes['route_url'] .= $this->attributes['route_action']=='*' ? '' : '/'.$this->attributes['route_action'];
	}

	public function getList(){
		$res = [];
		$select = [];
		$select['where'] = "`route_action`='*'";
		$data = $this->select($select);
		if (!empty($data)) {
			foreach ($data as $key => $row) {
				# 获取action不为*的数据
				$cond = [];
				$cond['where'] = "`route_controller`='".$row['route_controller']."'";
				$cond['order'] = "`order_num` asc,id asc";
				$children = $this->select($cond);
				// $res[] = $row;
				if (!empty($children)) {
					foreach ($children as $k => $v) {
						$res[] = $v;
					}
				}
			}
		}
		// print_r($res);
		return $res;
	}

	public function getAllController($module){
		$cond = [];
		$cond['select'] = "`id`,`route_controller`";
		$cond['where'] = "`route_module`='".$module."'";
		$cond['group'] = "`route_controller`";
		$res = $this->select($cond);
		return $res;
	}

	public function getAllControllerAction($controller){
		$cond = [];
		$cond['select'] = "`id`,`route_url`";
		$cond['where'] = "`route_controller`='".$controller."'";
		$res = $this->select($cond);
		return $res;
	}
}