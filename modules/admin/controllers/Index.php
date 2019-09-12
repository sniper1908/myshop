<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/10/13 10:17
 * @name 	网站后台文件-首页
 */
namespace modules\admin\controllers;

use modules\admin\classes\BaseController;

class Index extends BaseController
{
	public function indexAction(){
		$this->params['page_title'] = '网站后台首页';
		$this->have_script = 1;
		$this->renderInclude();
	}
}