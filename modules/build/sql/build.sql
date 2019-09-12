-- 生成模型，控制器，视图表

-- 模型表
create table `myshop_model_build` (
	`id` smallint unsigned not null auto_increment,
	`module_name` varchar(20) not null default '' comment '模块名',
	`model_name` varchar(20) not null default '' comment '模型名',
	`model_class` varchar(30) not null default '' comment '模型类名',
	`namespace` varchar(100) not null default '' comment '命名空间名',
	`base_class` varchar(100) not null default '' comment '继承的基类名',
	`rules` text comment '验证规则，序列化',
	`labels` text comment '字段对应名称，序列化',
	`created_time` int unsigned not null default 0 comment '文件创建时间',
	primary key (`id`)
) engine=innodb default charset=utf8;

-- 控制器表
create table `myshop_controller_build` (
	`id` smallint unsigned not null auto_increment,
	`module_name` varchar(20) not null default '' comment '模块名',
	`controller_name` varchar(20) not null default '' comment '控制器名',
	`controller_class` varchar(30) not null default '' comment '控制器类名',
	`model_class` varchar(30) not null default '' comment '模型类名',
	`namespace` varchar(100) not null default '' comment '命名空间名',
	`base_class` varchar(100) not null default '' comment '继承的基类名',
	`page_title` varchar(30) not null default '' comment '页面标题',
	`created_time` int unsigned not null default 0 comment '文件创建时间',
	primary key (`id`)
) engine=innodb default charset=utf8;

-- 表单表
create table `myshop_form_build` (
	`id` smallint unsigned not null auto_increment,
	`controller_name` varchar(20) not null default '' comment '控制器名',
	`controller_class` varchar(30) not null default '' comment '控制器类名',
	`module_name` varchar(20) not null default '' comment '模块名',
	`model_class` varchar(30) not null default '' comment '模型类名',
	`created_time` int unsigned not null default 0 comment '文件创建时间',
	primary key (`id`)
) engine=innodb default charset=utf8;

-- 视图表
create table `myshop_view_build` (
	`id` smallint unsigned not null auto_increment,
	`controller_name` varchar(20) not null default '' comment '控制器名',
	`controller_class` varchar(30) not null default '' comment '控制器类名',
	`module_name` varchar(20) not null default '' comment '模块名',
	`model_class` varchar(30) not null default '' comment '模型类名',
	`list_attr` varchar(200) not null default '' comment '首页显示字段',
	`view_attr` varchar(200) not null default '' comment '详情页显示字段',
	`created_time` int unsigned not null default 0 comment '文件创建时间',
	primary key (`id`)
) engine=innodb default charset=utf8;

