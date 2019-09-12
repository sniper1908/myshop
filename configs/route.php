<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/10/10 10:21
 * @name 	网站配置文件-路由配置
 */
return [
    'urlMode' => 0 ,                    // url连接地址的形式 
                                        // 0-传一个r变量 域名/index.php?r=index/index/index
                                        // 1- 域名/index/index/index 使用url重写功能 
                                        // 暂时支持第一种写法
    'defaultModule' => 'index' ,        // 默认的模块
    'defaultController' => 'index' ,    // 默认的控制器
    'defaultAction' => 'index' ,        // 默认的方法
];