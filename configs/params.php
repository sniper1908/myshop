<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/10/11 16:00
 * @name 	网站配置文件-公共配置
 */
return [
	# 初始化的类
	'initClasses' => [
		'security',
		'Session\Session',
		'Db\dbMysqli',
		'route'
	],
	# 设置时区
    'timeZone' => 'Asia/Shanghai',
    # session设置
    'session' => [
	    'saveType' => 'php', // 'php | memcache'
		// 'saveType' => 'memcache',
		// 'memcacheServer' => '192.168.1.1',// memcache服务器ip地址
	],
	# 路由配置
	'route' => [
		'urlMode' => 0 ,                    // url连接地址的形式 
                                        	// 0-传一个r变量 域名/index.php?r=index/index/index
                                        	// 1- 域名/index/index/index 使用url重写功能 
                                        	// 暂时支持第一种写法
	    'defaultModule' => 'index' ,        // 默认的模块
	    'defaultController' => 'index' ,    // 默认的控制器
	    'defaultAction' => 'index' ,        // 默认的方法
	],
	# 错误报告设置
	'errorReport' => [
		'display_errors' => 'on',
		'error_reporting' => E_ALL,
	],
	# 语言
	'language' => 'zh-CN',
	# 是否允许后台验证表单
	'enableBackstageValidation' => 1,
	# 全国地区分布
	'region' => [
		'全国','华南地区','华东地区','华北地区','华中地区','东北地区','西北地区','西南地区','港澳台地区'
	],
	# 密码加密字串
	'passwordValidationKey' => 'myshop',
	# 支付
	'pay' => [
		'tradeStatus' => [
			'WAIT_BUYER_PAY' => '买家未付款',
			'WAIT_SELLER_SEND_GOODS' => '等待卖家发货',
			'WAIT_BUYER_CONFIRM_GOODS' => '等待买家确认收货',
			'TRADE_FINISHED' => '买家确认收货'
		],
		'orderStatus' => [
			'订单已入库','买家未付款','买家已付款'
		],
		'shippingStatus' => [
			'卖家未发货','卖家已发货','确认收货'
		]
	]
];