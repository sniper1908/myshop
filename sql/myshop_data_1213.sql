-- MySQL dump 10.16  Distrib 10.1.21-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: localhost
-- ------------------------------------------------------
-- Server version	10.1.21-MariaDB

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `myshop_permission`
--

LOCK TABLES `myshop_permission` WRITE;
/*!40000 ALTER TABLE `myshop_permission` DISABLE KEYS */;
INSERT INTO `myshop_permission` VALUES (1,1,'管理员','',0,1,'{\"1\":[],\"2\":[],\"28\":[],\"29\":[]}'),(2,2,'','',0,2,'{\"1\":[],\"28\":[]}'),(3,3,'','',0,3,'{\"2\":{\"23\":[]}}');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `myshop_role`
--

LOCK TABLES `myshop_role` WRITE;
/*!40000 ALTER TABLE `myshop_role` DISABLE KEYS */;
INSERT INTO `myshop_role` VALUES (1,'站长',1),(2,'超级管理员',2),(3,'文档管理员',3);
/*!40000 ALTER TABLE `myshop_role` ENABLE KEYS */;
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
  `menu_route` varchar(50) NOT NULL DEFAULT '' COMMENT '菜单对应路由地址，形如admin/index/index',
  `order_num` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序数字',
  `json_data` varchar(255) NOT NULL DEFAULT '' COMMENT '自定义数据，JSON格式',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `myshop_sys_menu`
--

LOCK TABLES `myshop_sys_menu` WRITE;
/*!40000 ALTER TABLE `myshop_sys_menu` DISABLE KEYS */;
INSERT INTO `myshop_sys_menu` VALUES (1,'系统',0,0,'','',1,'{\"icon\":\"fa fa-cogs\",\"bar_color\":\"grey\"}'),(2,'站点',0,0,'','',2,'{\"icon\":\"fa fa-anchor\",\"bar_color\":\"green\"}'),(3,'系统管理',1,0,'','',1,'{\"icon\":\"fa fa-bars\"}'),(4,'权限管理',1,0,'','',2,'{\"icon\":\"fa fa-cog\"}'),(5,'账户管理',1,0,'','',3,'{\"icon\":\"fa fa-user\"}'),(6,'模板管理',1,0,'','',4,''),(7,'菜单',3,2,'sysMenu','admin/sysMenu/index',1,''),(8,'路由',3,8,'sysRoute','admin/sysRoute/index',2,''),(18,'权限',4,14,'permission','admin/permission/index',1,''),(19,'角色',4,20,'role','admin/role/index',2,''),(20,'授权',4,26,'assignment','admin/assignment/index',3,''),(21,'管理员',5,32,'admin','admin/admin/index',1,''),(22,'模板',6,39,'theme','admin/theme/index',1,''),(23,'文档管理',2,0,'','',1,''),(24,'统计',2,0,'','',2,''),(25,'文档',23,0,'','admin/doc/index',1,''),(26,'文章',23,45,'article','admin/article/index',2,''),(27,'访问统计',24,51,'statistics','admin/statistics/index',1,''),(28,'扩展组件',0,0,'','',3,'{\"icon\":\"fa fa-calendar-o\",\"bar_color\":\"blue\"}'),(29,'内容管理',0,0,'','',4,'{\"icon\":\"fa fa-server\",\"bar_color\":\"red\"}');
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
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `myshop_sys_route`
--

LOCK TABLES `myshop_sys_route` WRITE;
/*!40000 ALTER TABLE `myshop_sys_route` DISABLE KEYS */;
INSERT INTO `myshop_sys_route` VALUES (1,'admin','sysMenu','*','admin/sysMenu',1),(2,'admin','sysMenu','index','admin/sysMenu/index',2),(3,'admin','sysMenu','add','admin/sysMenu/add',3),(4,'admin','sysMenu','edit','admin/sysMenu/edit',4),(5,'admin','sysMenu','delete','admin/sysMenu/delete',5),(6,'admin','sysMenu','view','admin/sysMenu/view',6),(7,'admin','sysRoute','*','admin/sysRoute',1),(8,'admin','sysRoute','index','admin/sysRoute/index',2),(9,'admin','sysRoute','add','admin/sysRoute/add',3),(10,'admin','sysRoute','edit','admin/sysRoute/edit',4),(11,'admin','sysRoute','delete','admin/sysRoute/delete',5),(12,'admin','sysRoute','view','admin/sysRoute/view',6),(13,'admin','permission','*','admin/permission',1),(14,'admin','permission','index','admin/permission/index',2),(15,'admin','permission','add','admin/permission/add',3),(16,'admin','permission','edit','admin/permission/edit',4),(17,'admin','permission','delete','admin/permission/delete',5),(18,'admin','permission','view','admin/permission/view',6),(19,'admin','role','*','admin/role',1),(20,'admin','role','index','admin/role/index',2),(21,'admin','role','add','admin/role/add',3),(22,'admin','role','edit','admin/role/edit',4),(23,'admin','role','delete','admin/role/delete',5),(24,'admin','role','view','admin/role/view',6),(25,'admin','assignment','*','admin/assignment',1),(26,'admin','assignment','index','admin/assignment/index',2),(27,'admin','assignment','add','admin/assignment/add',3),(28,'admin','assignment','edit','admin/assignment/edit',4),(29,'admin','assignment','delete','admin/assignment/delete',5),(30,'admin','assignment','view','admin/assignment/view',6),(31,'admin','admin','*','admin/admin',1),(32,'admin','admin','index','admin/admin/index',2),(33,'admin','admin','add','admin/admin/add',3),(34,'admin','admin','edit','admin/admin/edit',4),(35,'admin','admin','delete','admin/admin/delete',5),(36,'admin','admin','view','admin/admin/view',6),(37,'admin','admin','editPwd','admin/admin/editPwd',7),(38,'admin','theme','*','admin/theme',1),(39,'admin','theme','index','admin/theme/index',2),(40,'admin','theme','add','admin/theme/add',3),(41,'admin','theme','edit','admin/theme/edit',4),(42,'admin','theme','delete','admin/theme/delete',5),(43,'admin','theme','view','admin/theme/view',6),(44,'admin','article','*','admin/article',1),(45,'admin','article','index','admin/article/index',2),(46,'admin','article','add','admin/article/add',3),(47,'admin','article','edit','admin/article/edit',4),(48,'admin','article','delete','admin/article/delete',5),(49,'admin','article','view','admin/article/view',6),(50,'admin','statistics','*','admin/statistics',1),(51,'admin','statistics','index','admin/statistics/index',2),(52,'admin','statistics','add','admin/statistics/add',3),(53,'admin','statistics','edit','admin/statistics/edit',4),(54,'admin','statistics','delete','admin/statistics/delete',5),(55,'admin','statistics','view','admin/statistics/view',6);
/*!40000 ALTER TABLE `myshop_sys_route` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-13 15:17:51
