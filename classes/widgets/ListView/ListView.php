<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/12/27 9:33
 * @name 	网站核心文件-widgets类 - 详情页
 */
namespace classes\widgets\ListView;

use classes\Web;
use classes\Url;
use classes\widgets\Widgets;

class ListView extends Widgets
{
	protected $_model = null;
	protected $_attributes = [];

	// public function __construct($params){
	// 	parent::__construct();
	// }
	
	public static function run($params) {
		// print_r($params);
		$params['cols_attr'] = isset($params['cols_attr']) ? $params['cols_attr'] : [];
		$params['relation'] = isset($params['relation']) ? $params['relation'] : [];
		$params['menu'] = isset($params['menu']) ? $params['menu'] : [];
		$model = $params['model'];
		$_attributes = self::getAttributes($params);
		$aList = $params['aList'];
		self::renderWidgetView(
			'classes\widgets\ListView',
			[
				'model' => $model,
				'_attributes'=>$_attributes,
				'aList'=>$aList,
				'cols_attr'=>$params['cols_attr'],
				'relation'=>$params['relation'],
				'menu' => $params['menu']
			]
		);
	}
}