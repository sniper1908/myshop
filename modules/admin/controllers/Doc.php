<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/10/23 14:22
 * @name 	网站后台文件-系统管理-路由设置页
 */
namespace modules\admin\controllers;

use classes\Web;
use modules\admin\classes\BaseController;

class Doc extends BaseController
{
	public function indexAction(){
		$this->renderInclude();
	}
}