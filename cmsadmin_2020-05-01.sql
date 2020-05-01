# ************************************************************
# Sequel Pro SQL dump
# Version 5446
#
# https://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 8.0.19)
# Database: cmsadmin
# Generation Time: 2020-05-01 13:15:40 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table ad
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ad`;

CREATE TABLE `ad` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '广告名称- 唯一值',
  `show` tinyint NOT NULL DEFAULT '1' COMMENT '开启 0 关闭 1开启',
  `note` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '备注',
  `createTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='广告';

LOCK TABLES `ad` WRITE;
/*!40000 ALTER TABLE `ad` DISABLE KEYS */;

INSERT INTO `ad` (`id`, `name`, `show`, `note`, `createTime`, `updateTime`)
VALUES
	(2,'222',1,'111','2020-04-29 09:23:01',NULL),
	(4,'333',0,NULL,'2020-04-29 09:25:26',NULL);

/*!40000 ALTER TABLE `ad` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ad_content
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ad_content`;

CREATE TABLE `ad_content` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `img` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '图片文件',
  `aid` int NOT NULL COMMENT '广告名id',
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '广告标题',
  `url` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '广告url',
  `isTarget` tinyint NOT NULL DEFAULT '0' COMMENT '新窗口 0 否  1是',
  `createTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='广告内容关联 ad表';

LOCK TABLES `ad_content` WRITE;
/*!40000 ALTER TABLE `ad_content` DISABLE KEYS */;

INSERT INTO `ad_content` (`id`, `img`, `aid`, `title`, `url`, `isTarget`, `createTime`)
VALUES
	(5,'/upload/images/1588132111.jpeg',2,'3542','543534',0,'2020-04-29 10:48:33');

/*!40000 ALTER TABLE `ad_content` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table admin
# ------------------------------------------------------------

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户名 唯一值',
  `password` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '密码',
  `name` varchar(20) DEFAULT NULL COMMENT '姓名',
  `phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '手机号',
  `role` tinyint NOT NULL DEFAULT '0' COMMENT '0 普通管理  1超级管理',
  `lastLoginTime` datetime DEFAULT NULL COMMENT '最后登陆时间',
  `createTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员';

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;

INSERT INTO `admin` (`id`, `username`, `password`, `name`, `phone`, `role`, `lastLoginTime`, `createTime`, `updateTime`)
VALUES
	(1,'www','hkwooo','111s',NULL,1,NULL,'2020-04-19 16:08:34','2020-04-29 02:15:16'),
	(2,'tests','666666','11','33',0,NULL,'2020-04-23 10:15:32','2020-05-01 13:04:13'),
	(3,'test1','111111','fds','fds',0,NULL,'2020-04-23 12:29:20',NULL);

/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table article
# ------------------------------------------------------------

DROP TABLE IF EXISTS `article`;

CREATE TABLE `article` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '文章标题',
  `channelId` int NOT NULL DEFAULT '0' COMMENT '栏目id 0 所有栏目',
  `show` tinyint NOT NULL DEFAULT '1' COMMENT '是否显示',
  `img` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '缩略图',
  `author` varchar(20) DEFAULT NULL COMMENT '作者',
  `content` longtext COMMENT '内容',
  `readCount` int NOT NULL DEFAULT '0' COMMENT '阅读量',
  `seoTitle` varchar(100) DEFAULT '',
  `seoKey` varchar(100) DEFAULT NULL,
  `seoDesc` varchar(100) DEFAULT NULL,
  `linkUrl` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'isLink时 生效 跳转网址',
  `isTop` tinyint NOT NULL DEFAULT '0' COMMENT '头条',
  `isPush` tinyint NOT NULL DEFAULT '0' COMMENT '推荐 ',
  `isBold` tinyint NOT NULL DEFAULT '0' COMMENT '加粗',
  `isImg` tinyint NOT NULL DEFAULT '0' COMMENT '图片',
  `isLink` tinyint NOT NULL DEFAULT '0' COMMENT '跳转',
  `createTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `title` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文章';

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;

INSERT INTO `article` (`id`, `title`, `channelId`, `show`, `img`, `author`, `content`, `readCount`, `seoTitle`, `seoKey`, `seoDesc`, `linkUrl`, `isTop`, `isPush`, `isBold`, `isImg`, `isLink`, `createTime`, `updateTime`)
VALUES
	(1,'大河向',1,1,'dfsfdsfds','顺枯地','sjfksajkfdlksfkdaljfkdalf\n',50,NULL,NULL,NULL,NULL,0,0,0,0,0,'2020-04-25 13:51:06',NULL),
	(3,'中石油',0,1,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,1,0,0,1,'2020-04-25 13:59:58',NULL),
	(4,'23',4,1,NULL,NULL,NULL,91,NULL,NULL,NULL,NULL,0,0,0,0,0,'2020-04-26 10:31:32',NULL),
	(5,'23',4,1,NULL,NULL,'<p>2432432</p>',91,NULL,NULL,NULL,NULL,0,0,0,0,0,'2020-04-26 10:31:51',NULL),
	(6,'34543543',2,1,NULL,NULL,NULL,41,NULL,NULL,NULL,NULL,0,0,0,0,0,'2020-04-26 10:34:23',NULL),
	(7,'测试',4,1,NULL,NULL,NULL,28,NULL,NULL,NULL,NULL,1,1,1,1,1,'2020-04-26 10:42:36',NULL),
	(8,'测试2',2,1,'/upload/images/1587872636.jpeg','auto','<p>heelo1</p>',28,'heelo','des','fd','kiss',1,1,1,1,1,'2020-04-26 10:46:04','2020-04-26 08:45:45'),
	(9,'543543',4,1,NULL,NULL,NULL,53,NULL,NULL,NULL,NULL,0,0,0,0,0,'2020-04-26 10:53:36',NULL),
	(10,'543543',4,1,NULL,NULL,NULL,53,NULL,NULL,NULL,NULL,0,0,0,0,0,'2020-04-07 10:53:36',NULL),
	(11,'sfdsafd',2,1,NULL,NULL,NULL,107,NULL,NULL,NULL,NULL,0,0,0,0,0,'2020-04-26 10:57:23',NULL),
	(12,'5353',2,1,NULL,NULL,NULL,119,NULL,NULL,NULL,NULL,0,1,0,0,0,'2020-04-26 10:58:00',NULL),
	(13,'sfdsafd',2,1,NULL,NULL,NULL,49,NULL,NULL,NULL,NULL,0,0,0,0,0,'2020-04-26 11:01:23',NULL),
	(14,'54354',1,1,NULL,NULL,NULL,61,NULL,NULL,NULL,NULL,0,0,0,0,0,'2020-04-26 11:01:49',NULL),
	(15,'5353',4,1,NULL,NULL,NULL,114,NULL,NULL,NULL,NULL,0,0,0,0,0,'2020-04-26 11:02:41',NULL),
	(16,'16的内容',2,1,'/upload/images/1587890980.jpeg',NULL,'<p>我是16</p>',75,NULL,NULL,NULL,NULL,0,1,0,1,0,'2020-04-26 11:03:01','2020-04-26 08:49:46'),
	(17,'sfdsafd',3,1,NULL,NULL,NULL,57,NULL,NULL,NULL,NULL,0,0,0,0,0,'2020-04-26 11:03:19',NULL),
	(18,'643654',4,1,NULL,NULL,NULL,98,NULL,NULL,NULL,NULL,0,0,0,0,0,'2020-04-26 11:03:53',NULL),
	(19,'4654',2,1,NULL,NULL,NULL,57,NULL,NULL,NULL,NULL,0,0,0,0,0,'2020-04-26 11:05:09',NULL),
	(20,'5643654',4,1,'/upload/images/1587873993.jpeg','323543','<p>32432432432</p>',87,'3543','43654','654654','233',1,0,0,0,0,'2020-04-26 11:06:23',NULL),
	(21,'5354',4,1,NULL,NULL,'<p>454364654</p>',84,NULL,NULL,NULL,NULL,0,0,0,0,0,'2020-04-26 11:13:16',NULL),
	(22,'sfdsafd',4,1,NULL,NULL,'<p>2432</p>',93,NULL,NULL,NULL,NULL,0,0,0,0,0,'2020-04-26 11:14:00',NULL),
	(23,'sfdsafd',4,1,NULL,NULL,'<p>fds</p>',97,NULL,NULL,NULL,NULL,0,0,0,0,0,'2020-04-26 11:16:39',NULL),
	(25,'sfdsafd',2,1,NULL,NULL,'<p>3453543</p>',75,NULL,NULL,NULL,NULL,1,0,0,0,0,'2020-04-26 11:18:14',NULL),
	(26,'23543',4,1,NULL,NULL,'<p>354543</p>',90,NULL,NULL,NULL,NULL,0,0,0,0,0,'2020-04-26 11:27:46',NULL),
	(27,'23',1,1,NULL,NULL,'<p>trewsgf</p>',60,NULL,NULL,NULL,NULL,0,0,0,0,0,'2020-04-26 11:32:20',NULL),
	(28,'sfdsafd',2,1,NULL,NULL,'<p>wtert</p>',83,NULL,NULL,NULL,NULL,0,0,0,0,0,'2020-04-26 11:32:53','2020-04-26 10:04:58');

/*!40000 ALTER TABLE `article` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table channel
# ------------------------------------------------------------

DROP TABLE IF EXISTS `channel`;

CREATE TABLE `channel` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(20) DEFAULT NULL COMMENT '栏目标题',
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '英文别名 唯一值',
  `model` tinyint NOT NULL DEFAULT '0' COMMENT '栏目模型 0 文章, 1单页, 2下载',
  `content` longtext CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '单页模型 内容',
  `show` tinyint NOT NULL DEFAULT '1' COMMENT '是否显示',
  `sort` int NOT NULL DEFAULT '50' COMMENT '排序',
  `img` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '栏目封面图',
  `seoTitle` varchar(100) DEFAULT NULL,
  `seoKey` varchar(100) DEFAULT NULL,
  `seoDesc` varchar(100) DEFAULT NULL,
  `createTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='栏目';

LOCK TABLES `channel` WRITE;
/*!40000 ALTER TABLE `channel` DISABLE KEYS */;

INSERT INTO `channel` (`id`, `title`, `name`, `model`, `content`, `show`, `sort`, `img`, `seoTitle`, `seoKey`, `seoDesc`, `createTime`, `updateTime`)
VALUES
	(1,'关于我们111','kissabc',1,'<p><strong><em>333</em></strong></p><p><strong><em><span class=\"ql-cursor\">﻿</span></em></strong><img src=\"/upload/images/1587961141.jpeg\"></p>',0,501,'/upload/images/1587961126.jpeg','333','222','111','2020-04-23 19:15:33','2020-04-27 04:19:03'),
	(2,'新闻中心','',0,NULL,1,100,NULL,NULL,NULL,NULL,'2020-04-24 09:45:28',NULL),
	(3,'原油资讯','',0,NULL,1,50,NULL,NULL,NULL,NULL,'2020-04-25 13:34:26',NULL),
	(4,'新闻中心1',NULL,0,NULL,1,120,NULL,NULL,NULL,NULL,'2020-04-25 13:34:49','2020-04-28 15:26:11');

/*!40000 ALTER TABLE `channel` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table links
# ------------------------------------------------------------

DROP TABLE IF EXISTS `links`;

CREATE TABLE `links` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '网站名称',
  `url` varchar(100) DEFAULT NULL COMMENT '链接地址',
  `show` tinyint NOT NULL DEFAULT '1' COMMENT '是否显示 0 不显示，1显示',
  `img` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '链接图片',
  `type` tinyint NOT NULL DEFAULT '0' COMMENT '链接类型 0文字，1图片',
  `sort` int NOT NULL DEFAULT '50' COMMENT '排序',
  `createTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='友情链接';

LOCK TABLES `links` WRITE;
/*!40000 ALTER TABLE `links` DISABLE KEYS */;

INSERT INTO `links` (`id`, `name`, `url`, `show`, `img`, `type`, `sort`, `createTime`, `updateTime`)
VALUES
	(1,'百度','http://www.baidu.com',1,NULL,0,50,'2020-04-26 16:42:22',NULL),
	(3,'3543543','hello',1,NULL,0,50,'2020-04-26 16:49:49',NULL),
	(4,'53','fdsfds',0,'/upload/images/1587895102.jpeg',1,45,'2020-04-26 16:50:42','2020-04-26 10:01:28');

/*!40000 ALTER TABLE `links` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table member
# ------------------------------------------------------------

DROP TABLE IF EXISTS `member`;

CREATE TABLE `member` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '会员账号6-20',
  `password` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '会员密码6-20',
  `name` varchar(20) DEFAULT NULL COMMENT '会员姓名',
  `phone` varchar(11) DEFAULT NULL COMMENT '会员手机号',
  `email` varchar(50) DEFAULT NULL COMMENT '会员邮箱',
  `nickname` varchar(20) DEFAULT NULL COMMENT '会员昵称',
  `level` tinyint NOT NULL DEFAULT '0' COMMENT '会员等级 0 注册会员 1交易会员  2 普通代理 3高级代理',
  `createTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `member` WRITE;
/*!40000 ALTER TABLE `member` DISABLE KEYS */;

INSERT INTO `member` (`id`, `username`, `password`, `name`, `phone`, `email`, `nickname`, `level`, `createTime`, `updateTime`)
VALUES
	(2,'m012345','1bbd886460827015e5d605ed44252251','11','22','32','42',0,'2020-05-01 19:54:57','2020-05-01 13:10:02');

/*!40000 ALTER TABLE `member` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table member_account
# ------------------------------------------------------------

DROP TABLE IF EXISTS `member_account`;

CREATE TABLE `member_account` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL DEFAULT '' COMMENT '交易账户',
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '平台名称',
  `idCard` varchar(20) DEFAULT NULL COMMENT '交易账户对应的身份证号',
  `img1` varchar(100) DEFAULT '' COMMENT '照片资料1',
  `img2` varchar(100) DEFAULT NULL COMMENT '照片资料2',
  `img3` varchar(100) DEFAULT NULL COMMENT '照片资料3',
  `img4` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '照片资料4',
  `bankImg1` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '银行卡资料1',
  `bankImg2` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '银行卡资料2',
  `createTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员交易账户';



# Dump of table member_money
# ------------------------------------------------------------

DROP TABLE IF EXISTS `member_money`;

CREATE TABLE `member_money` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `memberId` int NOT NULL COMMENT '会员id',
  `accountId` int NOT NULL COMMENT '交易账户id',
  `money` int NOT NULL DEFAULT '0' COMMENT '佣金',
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '结算状态 0 未结算 1已结算',
  `date` datetime NOT NULL COMMENT '产生佣金 归属日期',
  `createTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员资金记录';



# Dump of table member_open_account
# ------------------------------------------------------------

DROP TABLE IF EXISTS `member_open_account`;

CREATE TABLE `member_open_account` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `memberId` int NOT NULL COMMENT '会员号',
  `idCard` int NOT NULL COMMENT '身份证号',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '姓名',
  `img1` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '照片资料1',
  `img2` varchar(100) DEFAULT NULL COMMENT '照片资料2',
  `img3` varchar(100) DEFAULT NULL COMMENT '照片资料3',
  `img4` varchar(100) DEFAULT NULL COMMENT '照片资料4',
  `bankImg1` varchar(100) DEFAULT NULL COMMENT '银行卡资料1',
  `bankImg2` varchar(100) DEFAULT NULL COMMENT '银行卡资料2',
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '状态： 0未处理  1开户成功  2开户失败',
  `createTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员开户资料提交';

LOCK TABLES `member_open_account` WRITE;
/*!40000 ALTER TABLE `member_open_account` DISABLE KEYS */;

INSERT INTO `member_open_account` (`id`, `memberId`, `idCard`, `name`, `img1`, `img2`, `img3`, `img4`, `bankImg1`, `bankImg2`, `status`, `createTime`)
VALUES
	(1,2,1,'343',NULL,NULL,NULL,NULL,NULL,NULL,0,'2020-04-19 16:03:38');

/*!40000 ALTER TABLE `member_open_account` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table site
# ------------------------------------------------------------

DROP TABLE IF EXISTS `site`;

CREATE TABLE `site` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '网站名称',
  `logo` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '网站Logo',
  `net` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '网址',
  `seoTitle` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '首页标题',
  `seoKey` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '首页关键字',
  `seoDesc` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '首页描述',
  `copyright` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '版权信息',
  `phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '服务电话',
  `mobileLogo` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '手机logo',
  `caseNumber` varchar(50) DEFAULT NULL COMMENT '备案号',
  `pcCode` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '第三方代码 pc',
  `mobileCode` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '第三方代码 mobile',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='站点配置';

LOCK TABLES `site` WRITE;
/*!40000 ALTER TABLE `site` DISABLE KEYS */;

INSERT INTO `site` (`id`, `name`, `logo`, `net`, `seoTitle`, `seoKey`, `seoDesc`, `copyright`, `phone`, `mobileLogo`, `caseNumber`, `pcCode`, `mobileCode`)
VALUES
	(1,'中国','/upload/images/1587961126.jpeg','www.baidu.com',NULL,'13','14','15','028-28382932','/upload/images/1587961126.jpeg','kfdsirew','<dkfdsj>','<kiwere>');

/*!40000 ALTER TABLE `site` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
