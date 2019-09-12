-- MySQL dump 10.13  Distrib 5.5.53, for Win32 (AMD64)
--
-- Host: localhost    Database: myshop
-- ------------------------------------------------------
-- Server version	5.5.53

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `myshop_ad`
--

DROP TABLE IF EXISTS `myshop_ad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `myshop_ad` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `adv_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '广告位ID，取自表myshop_advertising',
  `ad_name` varchar(30) NOT NULL DEFAULT '' COMMENT '广告名称',
  `ad_link` varchar(100) NOT NULL DEFAULT '' COMMENT '广告链接地址',
  `ad_img_url` varchar(100) NOT NULL DEFAULT '' COMMENT '广告图片地址',
  `ad_open` tinyint(4) NOT NULL DEFAULT '1' COMMENT '广告是否开启，0-否，1-是',
  `order_num` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序数字',
  `created_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `myshop_ad`
--

LOCK TABLES `myshop_ad` WRITE;
/*!40000 ALTER TABLE `myshop_ad` DISABLE KEYS */;
/*!40000 ALTER TABLE `myshop_ad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `myshop_admin`
--

DROP TABLE IF EXISTS `myshop_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `myshop_admin` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(10) NOT NULL DEFAULT '' COMMENT '管理员账号',
  `admin_pass` char(32) NOT NULL DEFAULT '' COMMENT '管理员密码',
  `email` varchar(20) NOT NULL DEFAULT '' COMMENT '管理员邮箱',
  `admin_level` tinyint(4) NOT NULL DEFAULT '0' COMMENT '管理员等级',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '该管理员是否被激活，0-否，1-是',
  `created_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `myshop_admin`
--

LOCK TABLES `myshop_admin` WRITE;
/*!40000 ALTER TABLE `myshop_admin` DISABLE KEYS */;
INSERT INTO `myshop_admin` VALUES (1,'admin','b390484028ced2e227d4a6ae019271b9','1908838632@qq.com',0,1,1512029033),(2,'山鹰','a07c5ed50da235e067667d5c46c185d7','shanying@qq.com',0,1,1512094353),(3,'老七','a5e74715d88dde01a5593a7e1350a604','laoqi@qq.com',0,1,1512116894),(8,'test','22e22727b021824dc2fd6db4a2dfc305','test@qq.com',0,0,1512351279),(9,'test2','5618b86d704415f549b9aa45c8c15c8b','test@qq.com',0,1,1512353469),(10,'test3','f1f1354e01279bd7d21d15b93b9532cb','test3@qq.com',0,0,1512959869);
/*!40000 ALTER TABLE `myshop_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `myshop_admin_role`
--

DROP TABLE IF EXISTS `myshop_admin_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `myshop_admin_role` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'myshop_admin表主键id',
  `role_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'myshop_role表主键id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `myshop_admin_role`
--

LOCK TABLES `myshop_admin_role` WRITE;
/*!40000 ALTER TABLE `myshop_admin_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `myshop_admin_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `myshop_assignment`
--

DROP TABLE IF EXISTS `myshop_assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `myshop_assignment` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'myshop_admin表主键id',
  `role_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'myshop_role表主键id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `myshop_assignment`
--

LOCK TABLES `myshop_assignment` WRITE;
/*!40000 ALTER TABLE `myshop_assignment` DISABLE KEYS */;
INSERT INTO `myshop_assignment` VALUES (1,1,1),(2,4,2),(3,2,2),(6,3,3);
/*!40000 ALTER TABLE `myshop_assignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `myshop_attribute`
--

DROP TABLE IF EXISTS `myshop_attribute`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `myshop_attribute` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `cate_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '商品类型id，myshop_goods_type主键id',
  `attr_name` varchar(15) NOT NULL DEFAULT '' COMMENT '属性名称',
  `attr_input_type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '属性的添加类别，0-手工录入，1-列表选择，2-多行文本输入',
  `attr_type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '属性是否是多选，0-否，1-是。如果多选，则可以自定义属性，并可以根据值不同定不同价格',
  `attr_values` text COMMENT '当attr_input_type=1时，attr_name对应的值，如attr_name=颜色，则attr_values=蓝色、绿色、红色...',
  `attr_index` tinyint(4) NOT NULL DEFAULT '0' COMMENT '该属性是否可以检索，0-不需要检索，1-关键字检索，2-范围检索，该属性如果可以检索，则可以通过该属性找到有该属性的商品',
  `order_num` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序数字',
  `is_linked` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否关联，0-否，1-是，为1时，把与该属性值相同的商品推荐给用户',
  `attr_group` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '属性分组，相同的为一个属性组，该值取自于表myshop_goods_type的attr_group的值的顺序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `myshop_attribute`
--

LOCK TABLES `myshop_attribute` WRITE;
/*!40000 ALTER TABLE `myshop_attribute` DISABLE KEYS */;
/*!40000 ALTER TABLE `myshop_attribute` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `myshop_brand`
--

DROP TABLE IF EXISTS `myshop_brand`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `myshop_brand` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(20) NOT NULL DEFAULT '' COMMENT '品牌名称',
  `logo` varchar(100) NOT NULL DEFAULT '' COMMENT '品牌logo',
  `brand_des` varchar(200) NOT NULL DEFAULT '' COMMENT '品牌描述',
  `site_url` varchar(100) NOT NULL DEFAULT '' COMMENT '品牌网址',
  `order_num` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序数字',
  `is_show` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否显示，0-不，1-是',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `myshop_brand`
--

LOCK TABLES `myshop_brand` WRITE;
/*!40000 ALTER TABLE `myshop_brand` DISABLE KEYS */;
INSERT INTO `myshop_brand` VALUES (1,'测试品牌','uploads/20180112/test_5a581f1a25e8920180112103610.jpg','test','www.baidu.com',1,1),(2,'test2','uploads/20180115/logo_5a5c58770131220180115152959.png','test2','www.baidu.com',1,0),(3,'test3','uploads/20180115/logo_5a5c5629db1b420180115152009.jpg','test3','www.baidu.com',3,1),(4,'test4','uploads/20180115/logo_5a5c5605e2bc620180115151933.png','test4','www.baidu.com',4,1);
/*!40000 ALTER TABLE `myshop_brand` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `myshop_cate_recommend`
--

DROP TABLE IF EXISTS `myshop_cate_recommend`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `myshop_cate_recommend` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `rec_type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '推荐类型',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `myshop_cate_recommend`
--

LOCK TABLES `myshop_cate_recommend` WRITE;
/*!40000 ALTER TABLE `myshop_cate_recommend` DISABLE KEYS */;
/*!40000 ALTER TABLE `myshop_cate_recommend` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `myshop_category`
--

DROP TABLE IF EXISTS `myshop_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `myshop_category` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(15) NOT NULL DEFAULT '' COMMENT '分类名称',
  `parent_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '父id',
  `order_num` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序数字',
  `keywords` varchar(100) NOT NULL DEFAULT '' COMMENT '关键字',
  `des` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `measure_unit` varchar(10) NOT NULL DEFAULT '' COMMENT '计量单位',
  `recommend` varchar(10) NOT NULL DEFAULT '' COMMENT '设置首页推荐，1-精品，2-最新，3-热门',
  `show_in_nav` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否显示在导航栏，0-不，1-是',
  `is_show` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否在前台显示，0-不，1-是',
  `price_range` tinyint(4) NOT NULL DEFAULT '0' COMMENT '价格区间个数',
  `style_url` varchar(100) NOT NULL DEFAULT '' COMMENT '该分类单独的样式表文件路径',
  `filter_attr` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `myshop_category`
--

LOCK TABLES `myshop_category` WRITE;
/*!40000 ALTER TABLE `myshop_category` DISABLE KEYS */;
INSERT INTO `myshop_category` VALUES (1,'测试2',0,0,'test','天天天天','台','',1,1,3,'test','filter-attr test');
/*!40000 ALTER TABLE `myshop_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `myshop_collect_goods`
--

DROP TABLE IF EXISTS `myshop_collect_goods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `myshop_collect_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id，取自表myshop_users的主键id',
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品id，取自表myshop_goods的主键id',
  `created_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '收藏时间',
  `is_attention` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否关注该收藏商品，0-否，1-是',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `myshop_collect_goods`
--

LOCK TABLES `myshop_collect_goods` WRITE;
/*!40000 ALTER TABLE `myshop_collect_goods` DISABLE KEYS */;
/*!40000 ALTER TABLE `myshop_collect_goods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `myshop_controller_build`
--

DROP TABLE IF EXISTS `myshop_controller_build`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `myshop_controller_build` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `module_name` varchar(20) NOT NULL DEFAULT '' COMMENT '模块名',
  `controller_name` varchar(20) NOT NULL DEFAULT '' COMMENT '控制器名',
  `controller_class` varchar(30) NOT NULL DEFAULT '' COMMENT '控制器类名',
  `model_class` varchar(30) NOT NULL DEFAULT '' COMMENT '模型类名',
  `namespace` varchar(100) NOT NULL DEFAULT '' COMMENT '命名空间名',
  `base_class` varchar(100) NOT NULL DEFAULT '' COMMENT '继承的基类名',
  `page_title` varchar(30) NOT NULL DEFAULT '' COMMENT '页面标题',
  `created_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文件创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `myshop_controller_build`
--

LOCK TABLES `myshop_controller_build` WRITE;
/*!40000 ALTER TABLE `myshop_controller_build` DISABLE KEYS */;
INSERT INTO `myshop_controller_build` VALUES (1,'admin','控制器 - 分类','Category','common\\models\\CategoryModel','modules\\admin\\controllers','modules\\admin\\classes\\BaseController','分类',1514356873),(2,'admin','控制器 - 商品品牌','Brand','common\\models\\BrandModel','modules\\admin\\controllers','modules\\admin\\classes\\BaseController','商品品牌',1515375716);
/*!40000 ALTER TABLE `myshop_controller_build` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `myshop_form_build`
--

DROP TABLE IF EXISTS `myshop_form_build`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `myshop_form_build` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `controller_name` varchar(20) NOT NULL DEFAULT '' COMMENT '控制器名',
  `controller_class` varchar(30) NOT NULL DEFAULT '' COMMENT '控制器类名',
  `module_name` varchar(20) NOT NULL DEFAULT '' COMMENT '模块名',
  `model_class` varchar(30) NOT NULL DEFAULT '' COMMENT '模型类名',
  `created_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文件创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `myshop_form_build`
--

LOCK TABLES `myshop_form_build` WRITE;
/*!40000 ALTER TABLE `myshop_form_build` DISABLE KEYS */;
INSERT INTO `myshop_form_build` VALUES (1,'分类','Category','admin','common\\models\\CategoryModel',1515029422),(2,'商品品牌','Brand','admin','common\\models\\BrandModel',1515376842);
/*!40000 ALTER TABLE `myshop_form_build` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `myshop_goods`
--

DROP TABLE IF EXISTS `myshop_goods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `myshop_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cate_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '分类id，myshop_category主键id',
  `goods_name` varchar(100) NOT NULL DEFAULT '' COMMENT '商品名称',
  `short_name` varchar(20) NOT NULL DEFAULT '' COMMENT '商品短名称',
  `name_style` varchar(50) NOT NULL DEFAULT '' COMMENT '商品名称显示的样式，包括颜色和字体样式，格式如#ff00ff+strong',
  `sn` varchar(50) NOT NULL DEFAULT '' COMMENT '商品唯一货号',
  `brand_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '品牌id，myshop_brand主键id',
  `goods_num` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '库存量',
  `warn_num` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '报警库存量',
  `weight` decimal(10,3) NOT NULL DEFAULT '0.000' COMMENT '商品重量，以千克为单位',
  `market_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '市场价',
  `shop_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '本店价',
  `promote_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '促销价',
  `promote_start_date` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '促销开始时间',
  `promote_end_date` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '促销结束时间',
  `keywords` varchar(100) NOT NULL DEFAULT '' COMMENT '关键字',
  `click_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '点击量',
  `des` varchar(255) NOT NULL DEFAULT '' COMMENT '商品简介',
  `goods_thumb` varchar(100) NOT NULL DEFAULT '' COMMENT '缩略图',
  `goods_img` varchar(100) NOT NULL DEFAULT '' COMMENT '大图',
  `original_img` varchar(100) NOT NULL DEFAULT '' COMMENT '原图',
  `is_real` tinyint(4) NOT NULL DEFAULT '1' COMMENT '商品是否为实物，0-否，1-是',
  `extension_code` varchar(30) NOT NULL DEFAULT '' COMMENT '商品扩展属性，比如虚拟卡',
  `is_on_sale` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否在销售，0-否，1-是',
  `is_alone_sale` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否单独销售，0-否，1-是，不单独销售则只能作为配件或赠品销售',
  `is_shipping` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否配送，0-否，1-是',
  `is_delete` tinyint(4) NOT NULL DEFAULT '0' COMMENT '该商品是否已删除，0-否，1-是',
  `is_best` tinyint(4) NOT NULL DEFAULT '0' COMMENT '该商品是否是精品，0-否，1-是',
  `is_new` tinyint(4) NOT NULL DEFAULT '0' COMMENT '该商品是否是新品，0-否，1-是',
  `is_hot` tinyint(4) NOT NULL DEFAULT '0' COMMENT '该商品是否是热销，0-否，1-是',
  `is_promote` tinyint(4) NOT NULL DEFAULT '0' COMMENT '该商品是否是特价销售，0-否，1-是',
  `bonus_type_id` tinyint(4) NOT NULL DEFAULT '0' COMMENT '购买该商品能领到的红包类型',
  `integral` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '购买商品可以使用的积分数量',
  `goods_type` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '商品所属类型id,取自表myshop_goods_type的主键id',
  `give_integral` smallint(6) NOT NULL DEFAULT '-1' COMMENT '赠送的消费积分数',
  `rank_integral` smallint(6) NOT NULL DEFAULT '-1' COMMENT '赠送的等级积分数',
  `seller_note` varchar(255) NOT NULL DEFAULT '' COMMENT '商家备注信息，仅商家可见',
  `order_num` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序数字',
  `created_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品添加时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品更新时间',
  `suppliers_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '供应商编号',
  `provider_name` varchar(50) NOT NULL DEFAULT '' COMMENT '供货人的名称',
  `is_check` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否检查',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `myshop_goods`
--

LOCK TABLES `myshop_goods` WRITE;
/*!40000 ALTER TABLE `myshop_goods` DISABLE KEYS */;
/*!40000 ALTER TABLE `myshop_goods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `myshop_goods_activity`
--

DROP TABLE IF EXISTS `myshop_goods_activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `myshop_goods_activity` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `act_name` varchar(100) NOT NULL DEFAULT '' COMMENT '活动名称',
  `des` text COMMENT '活动描述',
  `act_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '活动类型，0-夺宝，1-团购，2-拍卖，4-礼包',
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品id，取自表myshop_goods的主键id',
  `goods_name` varchar(100) NOT NULL DEFAULT '' COMMENT '商品名称',
  `start_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '活动开始时间',
  `end_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '活动结束时间',
  `is_finished` tinyint(4) NOT NULL DEFAULT '0' COMMENT '活动是否结束，0-结束，1-未结束',
  `ext_info` text COMMENT '序列化后的促销活动的配置信息，包括最低价，最高价，出价幅度，保证金等',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `myshop_goods_activity`
--

LOCK TABLES `myshop_goods_activity` WRITE;
/*!40000 ALTER TABLE `myshop_goods_activity` DISABLE KEYS */;
/*!40000 ALTER TABLE `myshop_goods_activity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `myshop_goods_article`
--

DROP TABLE IF EXISTS `myshop_goods_article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `myshop_goods_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品id，取自表myshop_goods的主键id',
  `art_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品id，取自表myshop_article的主键id',
  `admin_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '管理员编号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `myshop_goods_article`
--

LOCK TABLES `myshop_goods_article` WRITE;
/*!40000 ALTER TABLE `myshop_goods_article` DISABLE KEYS */;
/*!40000 ALTER TABLE `myshop_goods_article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `myshop_goods_attr`
--

DROP TABLE IF EXISTS `myshop_goods_attr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `myshop_goods_attr` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品id，取自表myshop_goods的主键id',
  `attr_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '属性类型id，取自表myshop_attribute的主键id',
  `attr_value` text COMMENT '该属性的值',
  `attr_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '该属性对应在商品原价格上要加的价格',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `myshop_goods_attr`
--

LOCK TABLES `myshop_goods_attr` WRITE;
/*!40000 ALTER TABLE `myshop_goods_attr` DISABLE KEYS */;
/*!40000 ALTER TABLE `myshop_goods_attr` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `myshop_goods_cate`
--

DROP TABLE IF EXISTS `myshop_goods_cate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `myshop_goods_cate` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品id，取自表myshop_goods的主键id',
  `cate_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '商品类型id，取自表myshop_category的主键id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `myshop_goods_cate`
--

LOCK TABLES `myshop_goods_cate` WRITE;
/*!40000 ALTER TABLE `myshop_goods_cate` DISABLE KEYS */;
/*!40000 ALTER TABLE `myshop_goods_cate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `myshop_goods_gallery`
--

DROP TABLE IF EXISTS `myshop_goods_gallery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `myshop_goods_gallery` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品id，取自表myshop_goods的主键id',
  `img_url` varchar(100) NOT NULL DEFAULT '' COMMENT '图片地址',
  `des` varchar(100) NOT NULL DEFAULT '' COMMENT '图片描述',
  `thumb_url` varchar(100) NOT NULL DEFAULT '' COMMENT '缩略图地址',
  `img_original` varchar(100) NOT NULL DEFAULT '' COMMENT '原始图片地址',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `myshop_goods_gallery`
--

LOCK TABLES `myshop_goods_gallery` WRITE;
/*!40000 ALTER TABLE `myshop_goods_gallery` DISABLE KEYS */;
/*!40000 ALTER TABLE `myshop_goods_gallery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `myshop_goods_type`
--

DROP TABLE IF EXISTS `myshop_goods_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `myshop_goods_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(50) NOT NULL DEFAULT '' COMMENT '类型名称',
  `enabled` tinyint(4) NOT NULL DEFAULT '1' COMMENT '类型状态，0-不可用，1-可用。不可用类型，在添加商品时选择商品属性将不可选',
  `attr_group` varchar(255) NOT NULL DEFAULT '' COMMENT '商品属性分组.将一个商品类型的属性分成组，显示的时候也是按组显示。该字段的值显示在属性的前一行，类似于标题的作用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `myshop_goods_type`
--

LOCK TABLES `myshop_goods_type` WRITE;
/*!40000 ALTER TABLE `myshop_goods_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `myshop_goods_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `myshop_group_goods`
--

DROP TABLE IF EXISTS `myshop_group_goods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `myshop_group_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品id，取自表myshop_goods的主键id',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '配件商品的价格',
  `admin_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '添加该配件的管理员编号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `myshop_group_goods`
--

LOCK TABLES `myshop_group_goods` WRITE;
/*!40000 ALTER TABLE `myshop_group_goods` DISABLE KEYS */;
/*!40000 ALTER TABLE `myshop_group_goods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `myshop_keywords`
--

DROP TABLE IF EXISTS `myshop_keywords`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `myshop_keywords` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `keyword` varchar(50) NOT NULL DEFAULT '' COMMENT '搜索的关键字',
  `search_count` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '搜索的次数，按天累加',
  `search_date` date NOT NULL DEFAULT '0000-00-00' COMMENT '搜索日期',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `myshop_keywords`
--

LOCK TABLES `myshop_keywords` WRITE;
/*!40000 ALTER TABLE `myshop_keywords` DISABLE KEYS */;
/*!40000 ALTER TABLE `myshop_keywords` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `myshop_link_goods`
--

DROP TABLE IF EXISTS `myshop_link_goods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `myshop_link_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品id，取自表myshop_goods的主键id',
  `link_goods_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '被关联的商品id，取自表myshop_goods的主键id',
  `is_double` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否是双向关联，0-否，1-是',
  `admin_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '添加该配件的管理员编号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `myshop_link_goods`
--

LOCK TABLES `myshop_link_goods` WRITE;
/*!40000 ALTER TABLE `myshop_link_goods` DISABLE KEYS */;
/*!40000 ALTER TABLE `myshop_link_goods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `myshop_model_build`
--

DROP TABLE IF EXISTS `myshop_model_build`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `myshop_model_build` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `module_name` varchar(20) NOT NULL DEFAULT '' COMMENT '模块名',
  `model_name` varchar(20) NOT NULL DEFAULT '' COMMENT '模型中文名称',
  `model_class` varchar(30) NOT NULL DEFAULT '' COMMENT '模型类名',
  `namespace` varchar(100) NOT NULL DEFAULT '' COMMENT '命名空间名',
  `base_class` varchar(100) NOT NULL DEFAULT '' COMMENT '继承的基类名',
  `rules` text COMMENT '验证规则，序列化',
  `labels` text COMMENT '字段对应名称，序列化',
  `created_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文件创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `myshop_model_build`
--

LOCK TABLES `myshop_model_build` WRITE;
/*!40000 ALTER TABLE `myshop_model_build` DISABLE KEYS */;
INSERT INTO `myshop_model_build` VALUES (1,'admin','商品分类模型','CategoryModel','common\\models','classes\\ActiveRecord','czozMDc6IlsNCgkJCVtcJ2NhdGVfbmFtZVwnLFwncmVxdWlyZWRcJ10sDQoJCQlbXCdjYXRlX25hbWVcJyxcJ3N0cmluZ1wnLFwnbGVuZ3RoXCc9PlsyLDEwXV0sDQoJCQlbXCdrZXl3b3Jkc1wnLFwnc3RyaW5nXCcsXCdsZW5ndGhcJz0+WzIsMTAwXV0sDQoJCQlbXCdkZXNcJyxcJ3N0cmluZ1wnLFwnbGVuZ3RoXCc9PlsyLDI1MF1dLA0KCQkJW1wnc3R5bGVfdXJsXCcsXCdzdHJpbmdcJyxcJ2xlbmd0aFwnPT5bMiwxMDBdXSwNCgkJCVtcJ29yZGVyX251bVwnLFwnaW50ZWdlclwnXSwNCgkJCVtcJ3ByaWNlX3JhbmdlXCcsXCdpbnRlZ2VyXCddDQoJCV0iOw==','czo1MTU6IlsNCgkJCVwnY2F0ZV9uYW1lXCcgCT0+IFwn5YiG57G75ZCNXCcsDQoJCQlcJ3BhcmVudF9pZFwnIAk9PiBcJ+S4iue6p+WIhuexu1wnLA0KCQkJXCdvcmRlcl9udW1cJyAJPT4gXCfmjpLluo/mlbDlrZdcJywNCgkJCVwna2V5d29yZHNcJyAJCT0+IFwn5YWz6ZSu5a2XXCcsDQoJCQlcJ2Rlc1wnIAkJCT0+IFwn5o+P6L+wXCcsDQoJCQlcJ21lYXN1cmVfdW5pdFwnIAk9PiBcJ+aVsOmHj+WNleS9jVwnLA0KICAgICAgICAgICAgICAgICAgICAgICAgXCdyZWNvbW1lbmRcJyAgPT4gXCforr7nva7kuLrpppbpobXmjqjojZBcJywNCgkJCVwnc2hvd19pbl9uYXZcJyAJPT4gXCflr7zoiKrmoI/mmL7npLpcJywNCgkJCVwnaXNfc2hvd1wnIAkJPT4gXCfliY3lj7DmmL7npLpcJywNCgkJCVwncHJpY2VfcmFuZ2VcJyAJPT4gXCfku7fmoLzljLrpl7TkuKrmlbBcJywNCgkJCVwnc3R5bGVfdXJsXCcgCT0+IFwn5qC35byP6Lev5b6EXCcsDQoJCQlcJ2ZpbHRlcl9hdHRyXCcJPT4gXCfnrZvpgInlsZ7mgKdcJw0KCQldIjs=',1515376632),(11,'admin','商品品牌模型','BrandModel','common\\models','classes\\ActiveRecord','czoyODM6IlsNCgkJCVtcJ2JyYW5kX25hbWVcJyxcJ3JlcXVpcmVkXCddLA0KCQkJW1wnYnJhbmRfbmFtZVwnLFwnc3RyaW5nXCcsXCdsZW5ndGhcJz0+WzIsMjBdXSwNCgkJCVtcJ3NpdGVfdXJsXCcsXCd1cmxcJ10sDQoJCQlbXCdsb2dvXCcsXCdzdHJpbmdcJyxcJ2xlbmd0aFwnPT5bMiwxMDBdXSwNCgkJCVtcJ2JyYW5kX2Rlc1wnLFwnc3RyaW5nXCcsXCdsZW5ndGhcJz0+WzIsMjAwXV0sDQoJCQlbXCdvcmRlcl9udW1cJyxcJ2ludGVnZXJcJ10sDQoJCQlbXCdpc19zaG93XCcsXCdpbnRlZ2VyXCddDQoJCV0iOw==','czoyNTA6IlsNCgkJCVwnYnJhbmRfbmFtZVwnIAk9PiBcJ+WTgeeJjOWQjVwnLA0KCQkJXCdzaXRlX3VybFwnIAkgICAgICAgID0+IFwn5ZOB54mM572R5Z2AXCcsDQoJCQlcJ2xvZ29cJyAJICAgICAgICA9PiBcJ+WTgeeJjGxvZ29cJywNCgkJCVwnYnJhbmRfZGVzXCcgCT0+IFwn5ZOB54mM5o+P6L+wXCcsDQoJCQlcJ29yZGVyX251bVwnIAk9PiBcJ+aOkuW6j+aVsOWtl1wnLA0KCQkJXCdpc19zaG93XCcgCQk9PiBcJ+aYr+WQpuaYvuekulwnDQoJCV0iOw==',1515377912);
/*!40000 ALTER TABLE `myshop_model_build` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `myshop_permission`
--

DROP TABLE IF EXISTS `myshop_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `myshop_permission` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'myshop_role表主键id',
  `permission_name` varchar(10) NOT NULL DEFAULT '' COMMENT '权限名称',
  `permission_type` varchar(20) NOT NULL DEFAULT '' COMMENT '权限类型,menu-权限菜单，page-权限页面元素，file-权限文件',
  `data_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '权限类型对应的表主键id',
  `order_num` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序数字',
  `json_data` varchar(255) NOT NULL DEFAULT '' COMMENT '自定义数据，JSON格式',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `myshop_permission`
--

LOCK TABLES `myshop_permission` WRITE;
/*!40000 ALTER TABLE `myshop_permission` DISABLE KEYS */;
INSERT INTO `myshop_permission` VALUES (1,1,'管理员','',0,1,'{\"1\":[],\"30\":[],\"2\":[],\"28\":[],\"29\":[]}'),(2,2,'','',0,2,'{\"1\":[],\"28\":[]}'),(3,3,'','',0,3,'{\"2\":{\"23\":[]}}'),(4,5,'','',0,4,'{\"30\":[]}'),(5,6,'','',0,5,'{\"30\":{\"31\":[\"34\"]}}');
/*!40000 ALTER TABLE `myshop_permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `myshop_role`
--

DROP TABLE IF EXISTS `myshop_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `myshop_role` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(10) NOT NULL DEFAULT '' COMMENT '角色名称',
  `order_num` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序数字',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `myshop_role`
--

LOCK TABLES `myshop_role` WRITE;
/*!40000 ALTER TABLE `myshop_role` DISABLE KEYS */;
INSERT INTO `myshop_role` VALUES (1,'站长',1),(2,'超级管理员',2),(3,'文档管理员',3),(4,'组件管理员',4),(5,'产品管理员',5),(6,'产品相册管理员',5);
/*!40000 ALTER TABLE `myshop_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `myshop_suppliers`
--

DROP TABLE IF EXISTS `myshop_suppliers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `myshop_suppliers` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `sup_name` varchar(50) NOT NULL DEFAULT '' COMMENT '供应商名称',
  `des` text COMMENT '供应商描述',
  `is_check` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态，0-无效，1-有效',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `myshop_suppliers`
--

LOCK TABLES `myshop_suppliers` WRITE;
/*!40000 ALTER TABLE `myshop_suppliers` DISABLE KEYS */;
/*!40000 ALTER TABLE `myshop_suppliers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `myshop_sys_menu`
--

DROP TABLE IF EXISTS `myshop_sys_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `myshop_sys_menu` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(10) NOT NULL DEFAULT '' COMMENT '菜单名称',
  `parent_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '父级id',
  `sys_route_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `route_controller` varchar(15) NOT NULL DEFAULT '',
  `menu_route` varchar(30) NOT NULL DEFAULT '' COMMENT '菜单对应路由地址，形如admin/index/index',
  `order_num` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序数字',
  `json_data` varchar(255) NOT NULL DEFAULT '' COMMENT '自定义数据，JSON格式',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `myshop_sys_menu`
--

LOCK TABLES `myshop_sys_menu` WRITE;
/*!40000 ALTER TABLE `myshop_sys_menu` DISABLE KEYS */;
INSERT INTO `myshop_sys_menu` VALUES (1,'系统',0,0,'','',1,'{\"icon\":\"fa fa-cogs\",\"bar_color\":\"grey\"}'),(2,'站点',0,0,'','',2,'{\"icon\":\"fa fa-anchor\",\"bar_color\":\"green\"}'),(3,'系统管理',1,0,'','',1,'{\"icon\":\"fa fa-bars\"}'),(4,'权限管理',1,0,'','',2,'{\"icon\":\"fa fa-cog\"}'),(5,'账户管理',1,0,'','',3,'{\"icon\":\"fa fa-user\"}'),(6,'模板管理',1,0,'','',4,''),(7,'菜单',3,2,'sysMenu','admin/sysMenu/index',1,''),(8,'路由',3,8,'sysRoute','admin/sysRoute/index',2,''),(18,'权限',4,14,'permission','admin/permission/index',1,''),(19,'角色',4,20,'role','admin/role/index',2,''),(20,'授权',4,26,'assignment','admin/assignment/index',3,''),(21,'管理员',5,32,'admin','admin/admin/index',1,''),(22,'模板',6,39,'theme','admin/theme/index',1,''),(23,'文档管理',2,0,'','',1,''),(24,'统计',2,0,'','',2,''),(25,'文档',23,0,'','admin/doc/index',1,''),(26,'文章',23,45,'article','admin/article/index',2,''),(27,'访问统计',24,51,'statistics','admin/statistics/index',1,''),(28,'扩展组件',0,0,'','',3,'{\"icon\":\"fa fa-calendar-o\",\"bar_color\":\"blue\"}'),(29,'内容管理',0,0,'','',4,'{\"icon\":\"fa fa-server\",\"bar_color\":\"red\"}'),(30,'商品',0,0,'0','',3,'{\"icon\":\"fa fa-product-hunt\",\"bar_color\":\"purple\"}'),(31,'商品管理',30,0,'0','',1,''),(32,'商品列表',31,57,'goods','admin/goods/index',2,''),(33,'商品分类',31,63,'category','admin/category/index',1,''),(34,'商品相册',31,69,'gallery','admin/gallery/index',4,''),(35,'添加商品',31,58,'goods','admin/goods/add',3,''),(36,'商品品牌',31,75,'brand','admin/brand/index',5,'');
/*!40000 ALTER TABLE `myshop_sys_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `myshop_sys_route`
--

DROP TABLE IF EXISTS `myshop_sys_route`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `myshop_sys_route` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `route_module` varchar(15) NOT NULL DEFAULT '' COMMENT '所属模块',
  `route_controller` varchar(15) NOT NULL DEFAULT '' COMMENT '所属控制器',
  `route_action` varchar(15) NOT NULL DEFAULT '' COMMENT '所属方法',
  `route_url` varchar(50) NOT NULL DEFAULT '' COMMENT '路由地址',
  `order_num` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序数字',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `myshop_sys_route`
--

LOCK TABLES `myshop_sys_route` WRITE;
/*!40000 ALTER TABLE `myshop_sys_route` DISABLE KEYS */;
INSERT INTO `myshop_sys_route` VALUES (1,'admin','sysMenu','*','admin/sysMenu',1),(2,'admin','sysMenu','index','admin/sysMenu/index',2),(3,'admin','sysMenu','add','admin/sysMenu/add',3),(4,'admin','sysMenu','edit','admin/sysMenu/edit',4),(5,'admin','sysMenu','delete','admin/sysMenu/delete',5),(6,'admin','sysMenu','view','admin/sysMenu/view',6),(7,'admin','sysRoute','*','admin/sysRoute',1),(8,'admin','sysRoute','index','admin/sysRoute/index',2),(9,'admin','sysRoute','add','admin/sysRoute/add',3),(10,'admin','sysRoute','edit','admin/sysRoute/edit',4),(11,'admin','sysRoute','delete','admin/sysRoute/delete',5),(12,'admin','sysRoute','view','admin/sysRoute/view',6),(13,'admin','permission','*','admin/permission',1),(14,'admin','permission','index','admin/permission/index',2),(15,'admin','permission','add','admin/permission/add',3),(16,'admin','permission','edit','admin/permission/edit',4),(17,'admin','permission','delete','admin/permission/delete',5),(18,'admin','permission','view','admin/permission/view',6),(19,'admin','role','*','admin/role',1),(20,'admin','role','index','admin/role/index',2),(21,'admin','role','add','admin/role/add',3),(22,'admin','role','edit','admin/role/edit',4),(23,'admin','role','delete','admin/role/delete',5),(24,'admin','role','view','admin/role/view',6),(25,'admin','assignment','*','admin/assignment',1),(26,'admin','assignment','index','admin/assignment/index',2),(27,'admin','assignment','add','admin/assignment/add',3),(28,'admin','assignment','edit','admin/assignment/edit',4),(29,'admin','assignment','delete','admin/assignment/delete',5),(30,'admin','assignment','view','admin/assignment/view',6),(31,'admin','admin','*','admin/admin',1),(32,'admin','admin','index','admin/admin/index',2),(33,'admin','admin','add','admin/admin/add',3),(34,'admin','admin','edit','admin/admin/edit',4),(35,'admin','admin','delete','admin/admin/delete',5),(36,'admin','admin','view','admin/admin/view',6),(37,'admin','admin','editPwd','admin/admin/editPwd',7),(38,'admin','theme','*','admin/theme',1),(39,'admin','theme','index','admin/theme/index',2),(40,'admin','theme','add','admin/theme/add',3),(41,'admin','theme','edit','admin/theme/edit',4),(42,'admin','theme','delete','admin/theme/delete',5),(43,'admin','theme','view','admin/theme/view',6),(44,'admin','article','*','admin/article',1),(45,'admin','article','index','admin/article/index',2),(46,'admin','article','add','admin/article/add',3),(47,'admin','article','edit','admin/article/edit',4),(48,'admin','article','delete','admin/article/delete',5),(49,'admin','article','view','admin/article/view',6),(50,'admin','statistics','*','admin/statistics',1),(51,'admin','statistics','index','admin/statistics/index',2),(52,'admin','statistics','add','admin/statistics/add',3),(53,'admin','statistics','edit','admin/statistics/edit',4),(54,'admin','statistics','delete','admin/statistics/delete',5),(55,'admin','statistics','view','admin/statistics/view',6),(56,'admin','goods','*','admin/goods',1),(57,'admin','goods','index','admin/goods/index',2),(58,'admin','goods','add','admin/goods/add',3),(59,'admin','goods','edit','admin/goods/edit',4),(60,'admin','goods','delete','admin/goods/delete',5),(61,'admin','goods','view','admin/goods/view',6),(62,'admin','category','*','admin/category',1),(63,'admin','category','index','admin/category/index',2),(64,'admin','category','add','admin/category/add',3),(65,'admin','category','edit','admin/category/edit',4),(66,'admin','category','delete','admin/category/delete',5),(67,'admin','category','view','admin/category/view',6),(68,'admin','gallery','*','admin/gallery',1),(69,'admin','gallery','index','admin/gallery/index',2),(70,'admin','gallery','add','admin/gallery/add',3),(71,'admin','gallery','edit','admin/gallery/edit',4),(72,'admin','gallery','delete','admin/gallery/delete',5),(73,'admin','gallery','view','admin/gallery/view',6),(74,'admin','brand','*','admin/brand',1),(75,'admin','brand','index','admin/brand/index',2),(76,'admin','brand','add','admin/brand/add',3),(77,'admin','brand','edit','admin/brand/edit',4),(78,'admin','brand','delete','admin/brand/delete',5),(79,'admin','brand','view','admin/brand/view',6);
/*!40000 ALTER TABLE `myshop_sys_route` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `myshop_view_build`
--

DROP TABLE IF EXISTS `myshop_view_build`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `myshop_view_build` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `controller_name` varchar(20) NOT NULL DEFAULT '' COMMENT '控制器名',
  `controller_class` varchar(30) NOT NULL DEFAULT '' COMMENT '控制器类名',
  `module_name` varchar(20) NOT NULL DEFAULT '' COMMENT '模块名',
  `model_class` varchar(30) NOT NULL DEFAULT '' COMMENT '模型类名',
  `list_attr` varchar(200) NOT NULL DEFAULT '' COMMENT '首页显示字段',
  `view_attr` varchar(200) NOT NULL DEFAULT '' COMMENT '详情页显示字段',
  `created_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文件创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `myshop_view_build`
--

LOCK TABLES `myshop_view_build` WRITE;
/*!40000 ALTER TABLE `myshop_view_build` DISABLE KEYS */;
INSERT INTO `myshop_view_build` VALUES (1,'商品分类','Category','admin','common\\models\\CategoryModel','cate_name,parent_id,order_num,is_show','',1514427901),(2,'商品品牌','Brand','admin','common\\models\\BrandModel','','',1515376944);
/*!40000 ALTER TABLE `myshop_view_build` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-01-30 20:39:27
