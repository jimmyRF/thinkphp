/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50631
Source Host           : localhost:3306
Source Database       : thinkphp

Target Server Type    : MYSQL
Target Server Version : 50631
File Encoding         : 65001

Date: 2016-08-09 21:19:39
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `think_administrator`
-- ----------------------------
DROP TABLE IF EXISTS `think_administrator`;
CREATE TABLE `think_administrator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `salt` char(3) DEFAULT NULL,
  `mobile` varchar(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `last_login_ip` varchar(100) DEFAULT NULL,
  `last_login_time` int(11) DEFAULT NULL,
  `expire_time` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_administrator
-- ----------------------------
INSERT INTO `think_administrator` VALUES ('1', 'Admin', 'admin', '8bfa1a68eb8670d1a591ea70373c45b1', '112', '13888888888', '1', '57a99128f2c90_thumb.jpg', '127.0.0.1', '1470748670', '1470777470', '1463362516', '1470748660');
INSERT INTO `think_administrator` VALUES ('2', 'Editor', 'editor', '8bfa1a68eb8670d1a591ea70373c45b1', '519', '13888888888', '1', null, '127.0.0.1', '1470748703', '1470777503', '1463363564', '1470660594');

-- ----------------------------
-- Table structure for `think_posts`
-- ----------------------------
DROP TABLE IF EXISTS `think_posts`;
CREATE TABLE `think_posts` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `post_author` bigint(20) unsigned NOT NULL DEFAULT '0',
  `post_content` longtext,
  `post_title` text NOT NULL,
  `post_excerpt` text,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `comment_status` varchar(20) NOT NULL DEFAULT 'open',
  `post_password` varchar(20) DEFAULT '',
  `comment_count` bigint(20) DEFAULT '0',
  `feature_image` varchar(255) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `type_status_date` (`status`,`create_time`),
  KEY `post_author` (`post_author`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_posts
-- ----------------------------
-- ----------------------------
-- Table structure for `think_member`
-- ----------------------------
DROP TABLE IF EXISTS `think_member`;
CREATE TABLE `think_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_name` varchar(255) NOT NULL,
  `member_password` varchar(255) NOT NULL,
  `member_tel` varchar(255) NOT NULL,
  `member_email` varchar(255) DEFAULT NULL,
  `member_QQ` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of think_member
-- ----------------------------
INSERT INTO `think_member` VALUES ('1', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '123456789','','');
-- ----------------------------
-- Table structure for `think_shop`
-- ----------------------------
DROP TABLE IF EXISTS `think_shop`;
CREATE TABLE `think_shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_aid` varchar(255) NOT NULL,
  `shop_name` varchar(255) NOT NULL,
  `shop_area` varchar(255) NOT NULL,
  `shop_type` varchar(255) NOT NULL,
  `shop_jinbiprice` varchar(255) DEFAULT NULL,
  `shop_price` decimal(10,2) NOT NULL,
  `shop_status` varchar(255) DEFAULT NULL,
  `shop_img` varchar(255) NOT NULL,
  `shop_createtime` varchar(255) NOT NULL,
  `update_time` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

#
# Data for table "think_shop"
#

/*!40000 ALTER TABLE `think_shop` DISABLE KEYS */;
INSERT INTO `think_shop` VALUES (1,'1','地下城与勇士','广东1区','金币','1元=42.86万金币',10.00,'1','dnfshop.png','1486282551','1486282551'),(2,'1','剑灵','电信一区','金币','1元=8.12金',10.00,'1','jianlingshop.png','1486282551','1486282551'),(3,'1','剑侠情缘三','电信一区','金币','1元=592.00金',10.00,'1','jiansanshop.png','1486282551','1486282551'),(4,'1','天涯明月刀','天命风流','金币','1元=9.49金',10.00,'1','tianyashop.png','1486282551','1486282551'),(5,'2','炉石传说','安卓/苹果/全区/全区全服','账号','',750.00,'1','lushi.png','1486282551','1486282551'),(6,'2','阴阳师','阴阳师 苹果/网易(苹果)/中国区-ios(雀之羽)','账号','1',13.00,'','yinyang.png','1486282551','1486282551'),(7,'2','部落冲突','部落战争COC|部落冲突(Clash of Clans) 安卓/百度多酷(安卓)/全区全服','账号','',70.00,'1','coc.png','1486282551','1486282551'),(8,'2','梦幻西游','梦幻西游(手机游戏) 安卓/网易(安卓)/(七区)登科及第','账号','',499.00,'1','menghuan.png','1486282551','1486282551'),(9,'3','三国杀','三国杀 / 游卡桌游（原边锋） / 1区五谷丰登','账号','',300.00,'1','sanguo.png','1486282551','1486282551'),(10,'3','大天使之剑','大天使之剑 / 回归服 / 回归93服','账号','',83.00,'1','datianshi.png','1486282551','1486282551'),(11,'3','传奇霸业','传奇霸业 / 邓超 / 邓超306服','账号','',33.00,'1','chuanqi.png','1486282551','1486282551'),(12,'3','傲剑','傲剑(绿色版) / 哥们网 / 双线11服','账号','',28.00,'1','aojian.png','1486282551','1486282551'),(13,'4','JJ棋牌','全区全服','游戏币','',10.00,'1','JJ.png','1486282551','1486282551'),(14,'4','776游戏','全区全服','游戏币','',10.00,'1','776.png','1486282551','1486282551'),(15,'4','91y游戏','全区全服','游戏币','',10.00,'1','91y.png','1486282551','1486282551'),(16,'4','集结号棋牌','全区全服','游戏币','',10.00,'1','jijiehao.png','1486282551','1486282551'),(17,'1','测试','测试','测试',NULL,10.00,'1','5896e03d24781_thumb.jpg','1486239546','1486282813'),(18,'1','英雄联盟','战争学院','账号',NULL,100.00,'1','58992d2710dd9_thumb.jpg','1486433465','1486433575');
/*!40000 ALTER TABLE `think_shop` ENABLE KEYS */;

-- ----------------------------
-- Table structure for `think_forum`
-- ----------------------------
DROP TABLE IF EXISTS `think_forum`;
CREATE TABLE `think_forum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `forum_aid` varchar(255) NOT NULL,
  `forum_title` varchar(255) NOT NULL,
  `forum_author` varchar(255) NOT NULL,
  `create_time` varchar(255) NOT NULL,
  `forum_reply` varchar(255) NOT NULL,
  `update_time` varchar(255) NOT NULL,
  `forum_content` text  NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of think_forum
-- ----------------------------
/*!40000 ALTER TABLE `think_forum` DISABLE KEYS */;
INSERT INTO `think_forum` VALUES (1,'1','冒险岛2','jimmy','1486454095','0','1486454095','jimmy');
/*!40000 ALTER TABLE `think_forum` ENABLE KEYS */;