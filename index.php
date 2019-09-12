<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/10/10 10:13
 * @name 	网站入口文件
 */
# 自定义常量
define( 'CSS_ROOT', '.' );
define( 'ROOT' , '.' );
define( 'ROOT_DIR' , dirname(__FILE__) );

# 运行
classes\Web::app()->run();

# 自动加载类
function __autoload($className){
	# echo $className.'<br/>';
	require_once ROOT . '/' . str_replace( '\\' , '/' , $className ) . '.php';
}
