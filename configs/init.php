<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/10/10 15:03
 * @name 	网站配置文件，初始化的类
 */
return [
	# 初始化的类
	'initClasses' => [
		'config',
		'security',
		'Session\Session',
		'dbMysqli',
		'route',
		'request'
	]
];