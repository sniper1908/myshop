<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/10/11 16:31
 * @name 	网站配置文件-模块admin的配置文件
 */
// $commonConfig = include_once '../../../configs/params.php';
// $commonConfig = include_once ROOT . '/configs/params.php';

$params = [
	# 密码加密字串
	'passwordValidationKey' => 'myshopbackend',
	# 图片保存设置
	'images' => [
		'saveType' => 'local' , // local | remote
	    'saveDir'  => 'uploads' , // 存放路径
	    // 'saveType' => 'remote' , // 存放在服务器
	    // 'imageServer' => '192.168.1.1' , // 图片服务器地址
	],
	# 系统设置
	'rootSet' => [
		'msg_stay_time' => '3',
		'md5_str' => 'myshop',
		'page_size' => '12',
		'if_static' => '0',
		'if_img_thumb' => '1',
		'if_waterstring' => '0',
		'water_string' => '',
		'if_watermark' => '0',
		'watermark_pos' => '1',
		'watermark_alpha' => '50',
		'watermark_padding' => '10',
	],
];

return $params;

// return array_merge($commonConfig,$params);