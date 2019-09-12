<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/10/26 9:30
 * @name 	网站核心文件-模型类
 * @desc 	进行业务逻辑判断或封装其他的方法
 */
namespace modules\admin\classes;

use classes\Controller;
use common\models\SysMenuModel;
use common\models\RuleModel;
use common\models\PermissionModel;
use common\models\AssignmentModel;

class MenuClass extends Controller
{
	protected $SysMenuModel;
	protected $AssignmentModel;
	protected $PermissionModel;
	protected $mrpid = 0;
	protected $mpid = 0;
	protected $mid = 0;
	protected $admin_id = 0;
	protected $permissionOpen = 1;
	protected $adminPermissionData = [];
	protected $permissionController = [];

	public function __construct($admin_id,$permissionOpen=1){
		parent::__construct();
		$this->SysMenuModel = new SysMenuModel;
		$this->AssignmentModel = new AssignmentModel;
		$this->PermissionModel = new PermissionModel;
		$this->admin_id = $admin_id;
		$this->permissionOpen = $permissionOpen==1 ? 1 : 0;
		// 如果开启权限，则查出管理员具有的权限
		if ($this->permissionOpen==1) {
			$this->getAdminMenuData($admin_id);
		}
	}

	// 根据管理员id查出该管理员具有的权限
	protected function getAdminMenuData(){
		// 根据管理员id查出角色id
		$role_id = $this->AssignmentModel->fetchColumn("admin_id='".$this->admin_id."'",'role_id');
		// 根据角色id差权限
		$json_data = $this->PermissionModel->fetchColumn("`role_id`='".$role_id."'",'json_data');
		$this->adminPermissionData = json_decode($json_data,true);
		// print_r($this->adminPermissionData);
		// $permissionMenu = $this->SysMenuModel->getPermissionMenuData($menu_data);
	}

	public function getMrpid(){
		// 获取本控制器的根分类id
		$this->mrpid = $this->SysMenuModel->getRootIdForRoute($this->_module.'/'.$this->_controller.'/index');
		return $this->mrpid;
	}

	public function getCurId($field=''){
		$curRouteData = $this->SysMenuModel->findOne("menu_route='".$this->_module.'/'.$this->_controller.'/index'."'",'id,parent_id');
		return $field ? $curRouteData[$field] : $curRouteData;
	}

	public function getHeader(){
		$cond = $res = [];
		$cond['where'] = "parent_id=0";
		$cond['order'] = "order_num";
		$data = $this->SysMenuModel->select($cond);
		# 如果没有设定权限
		if ($this->permissionOpen!=1) {
			# 返回全部
			foreach ($data as $key => $value) {
				$data[$key]['json_data'] = json_decode($value['json_data'],true);
			}
			return $data;
		}
		if (empty($this->adminPermissionData)) {
			# 如果权限为空，即未设置该管理员的具体权限
			return [];
		}
		if (!empty($data)) {
			$permissionId = array_keys($this->adminPermissionData);
			foreach ($data as $key => $value) {
				if (in_array($value['id'],$permissionId)) {
					$res[$key] = $value;
					$res[$key]['json_data'] = json_decode($value['json_data'],true);
				}
			}
		}
		return $res;
	}

	public function getLeft(){
		$res = [];
		$menuTree = $this->SysMenuModel->getTree();
		// 如果没有设定权限，则返回全部菜单
		if ($this->permissionOpen!=1) {
			return $menuTree;
		}
		// $this->permissionController = [];
		if (empty($this->adminPermissionData)) {
			# 如果权限为空，即未设置该管理员的具体权限
			return [];
		}
		// print_r($this->adminPermissionData);
		if (!empty($menuTree)) {
			// 一级分类id数组
			$pidArr = array_keys($this->adminPermissionData);
			foreach ($menuTree as $key => $row) {
				# 保留权限内的一级菜单
				if (in_array($row['id'],$pidArr) ) {
					$children = $row['children'];
					$res[$key] = $row;
					unset($res[$key]['children']);
					// 如果该管理员具有一级分类下所有的权限
					if (empty($this->adminPermissionData[$row['id']])) {
						$res[$key]['children'] = $children;
					}
					// 一级分类下部分二级分类权限
					/*
						[
							1 => [
								11 => [
									111,112,113...
								]
							],
							2 => [],
						]
					 */
					else{
						// 二级分类id数组
						$cidArr = array_keys($this->adminPermissionData[$row['id']]);
						foreach ($row['children'] as $k => $crow) {
							// 保留管理员具有的二级分类权限
							if (in_array($crow['id'],$cidArr)) {
								$grand = $crow['children'];
									// print_r($grand);
								$res[$key]['children'][$k] = $crow;
								unset($res[$key]['children'][$k]['children']);
								// unset($res[$key]['children'][$crow['id']]['children']);
								// 二级分类下全部权限
								// if (empty($this->adminPermissionData[$row['id']])) {
								if (empty($this->adminPermissionData[$row['id']][$crow['id']])) {
									$res[$key]['children'][$k]['children'] = $grand;
									// $res[$key]['children'][$crow['id']]['children'] = $grand;
								}else{
									// 二级分类下部分三级分类权限
									$gidArr = $this->adminPermissionData[$row['id']][$crow['id']];
									// print_r($gidArr);
									foreach ($grand as $kk => $grow) {
										if (in_array($grow['id'],$gidArr)) {
											$res[$key]['children'][$k]['children'] = $grow;
											// $res[$key]['children'][$crow['id']]['children'] = $grow;
										}
									}
								}
							}
						}
					}
				}
			}
		}
		// print_r($res);
		return $res;
	}

	public function getPermissionController($data){
		// print_r($data);
		$this->permissionController[] = 'index';
		foreach ($data as $row) {
			if ($row['route_controller']) {
				$this->permissionController[] = $row['route_controller'];
			}
			if (isset($row['children']) && !empty($row['children'])) {
				foreach ($row['children'] as $children) {
					if ($children['route_controller']) {
						$this->permissionController[] = $children['route_controller'];
					}
					if (isset($children['children']) && !empty($children['children'])) {
						foreach ($children['children'] as $grand) {
							if ($grand['route_controller']) {
								$this->permissionController[] = $grand['route_controller'];
							}
							if (isset($grand['children']) && !empty($grand['children'])) {
								foreach ($grand['children'] as $grandChildren) {
									if ($grandChildren['route_controller']) {
										$this->permissionController[] = $grandChildren['route_controller'];
									}
								}
							}
						}
					}
				}
			}
		}
		$this->permissionController = array_filter($this->permissionController);
		$this->permissionController = array_unique($this->permissionController);
		// print_r($this->permissionController);
		return $this->permissionController;
	}
}
?>