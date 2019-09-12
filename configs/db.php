<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/10/10 10:21
 * @name 	网站配置文件-数据库配置信息
 */
return [
	// 数据库连接信息
    'host'      => 'localhost',
    'dbname'    => 'myshop',
    'user'      => 'root',
    'pass'      => '190839',
    'dbcharset' => 'utf8',
    'dbprefix'  => 'myshop_',
    'dbclass'   => 'dbMysqli',
    // 表单名与数据库映射
    'maps' 		=> [
        // 表名->表单名
    	'sys_menu' => 'menu',
        'model_build' => 'model',
    ],
];
?>