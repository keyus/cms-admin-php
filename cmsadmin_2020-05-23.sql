# ************************************************************
# Sequel Pro SQL dump
# Version 5446
#
# https://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 8.0.19)
# Database: cmsadmin
# Generation Time: 2020-05-23 16:42:36 +0000
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
	(1,'首页banner',1,'展示首页banner广告\n大小1920 x 720','2020-04-29 09:23:01',NULL),
	(2,'首页广告栏位 x 4',1,'展示banner下方，4个广告位\n大小 506 x 160','2020-05-23 22:54:25',NULL);

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
	(6,'/upload/images/ad/2020/1590249197.jpg',1,'科技引领，金额为本，服务实体经济',NULL,0,'2020-05-23 22:53:59'),
	(7,'/upload/images/ad/2020/1590249476.png',2,'测试',NULL,1,'2020-05-23 22:58:08'),
	(8,'/upload/images/ad/2020/1590249496.png',2,'大熊',NULL,0,'2020-05-23 22:58:26'),
	(9,'/upload/images/ad/2020/1590249517.jpg',2,'新春测试',NULL,0,'2020-05-23 22:58:43'),
	(10,'/upload/images/ad/2020/1590249533.jpeg',2,'不规则图片测试',NULL,1,'2020-05-23 22:59:02');

/*!40000 ALTER TABLE `ad_content` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table admin
# ------------------------------------------------------------

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户名 唯一值',
  `password` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '密码',
  `name` varchar(20) DEFAULT NULL COMMENT '姓名',
  `phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '手机号',
  `role` tinyint NOT NULL DEFAULT '0' COMMENT '0 普通管理  1超级管理',
  `lastLoginTime` datetime DEFAULT NULL COMMENT '最后登陆时间',
  `createTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间',
  `api_token` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `remember_token` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员';

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;

INSERT INTO `admin` (`id`, `username`, `password`, `name`, `phone`, `role`, `lastLoginTime`, `createTime`, `updateTime`, `api_token`, `remember_token`)
VALUES
	(1,'www','$2y$10$QlIdbBlChzdDHyXiyJZFOeVEVZl.pI6g6kwE3zzhZtOhlNW40vxsG','111s',NULL,1,NULL,'2020-04-19 16:08:34','2020-04-29 02:15:16','123456',NULL),
	(2,'test','$2y$10$QlIdbBlChzdDHyXiyJZFOeVEVZl.pI6g6kwE3zzhZtOhlNW40vxsG','11','33',0,NULL,'2020-04-23 10:15:32','2020-05-01 13:04:13',NULL,NULL),
	(3,'test1','111111','fds','fds',0,NULL,'2020-04-23 12:29:20',NULL,NULL,NULL);

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
  `desc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '文章简介',
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

INSERT INTO `article` (`id`, `title`, `channelId`, `show`, `img`, `author`, `desc`, `content`, `readCount`, `seoTitle`, `seoKey`, `seoDesc`, `linkUrl`, `isTop`, `isPush`, `isBold`, `isImg`, `isLink`, `createTime`, `updateTime`)
VALUES
	(1,'大河向',1,1,'dfsfdsfds','顺枯地',NULL,'sjfksajkfdlksfkdaljfkdalf\n',50,NULL,NULL,NULL,NULL,0,0,0,0,0,'2020-04-25 13:51:06',NULL),
	(3,'中石油',0,1,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,1,0,0,1,'2020-04-25 13:59:58',NULL),
	(4,'23',4,1,NULL,NULL,NULL,NULL,91,NULL,NULL,NULL,NULL,0,0,0,0,0,'2020-04-26 10:31:32',NULL),
	(5,'23',4,1,NULL,NULL,NULL,'<p>2432432</p>',91,NULL,NULL,NULL,NULL,0,0,0,0,0,'2020-04-26 10:31:51',NULL),
	(6,'34543543',2,1,NULL,NULL,NULL,NULL,41,NULL,NULL,NULL,NULL,0,0,0,0,0,'2020-04-26 10:34:23',NULL),
	(7,'测试',4,1,NULL,NULL,NULL,NULL,28,NULL,NULL,NULL,NULL,1,1,1,1,1,'2020-04-26 10:42:36',NULL),
	(8,'测试2',2,1,'/upload/images/1587872636.jpeg','auto',NULL,'<p>heelo1</p>',28,'heelo','des','fd','kiss',1,1,1,1,1,'2020-04-26 10:46:04','2020-04-26 08:45:45'),
	(9,'543543',4,1,NULL,NULL,NULL,NULL,53,NULL,NULL,NULL,NULL,0,0,0,0,0,'2020-04-26 10:53:36',NULL),
	(10,'543543',4,1,NULL,NULL,NULL,NULL,53,NULL,NULL,NULL,NULL,0,0,0,0,0,'2020-04-07 10:53:36',NULL),
	(11,'sfdsafd',2,1,NULL,NULL,NULL,NULL,107,NULL,NULL,NULL,NULL,0,0,0,0,0,'2020-04-26 10:57:23',NULL),
	(12,'5353',2,1,NULL,NULL,NULL,NULL,119,NULL,NULL,NULL,NULL,0,1,0,0,0,'2020-04-26 10:58:00',NULL),
	(13,'sfdsafd',2,1,NULL,NULL,NULL,NULL,49,NULL,NULL,NULL,NULL,0,0,0,0,0,'2020-04-26 11:01:23',NULL),
	(16,'16的内容',2,1,'/upload/images/1587890980.jpeg',NULL,NULL,'<p>我是16</p>',75,NULL,NULL,NULL,NULL,0,1,0,1,0,'2020-04-26 11:03:01','2020-04-26 08:49:46'),
	(17,'sfdsafd',3,1,NULL,NULL,NULL,NULL,57,NULL,NULL,NULL,NULL,0,0,0,0,0,'2020-04-26 11:03:19',NULL),
	(18,'643654',4,1,NULL,NULL,NULL,NULL,98,NULL,NULL,NULL,NULL,0,0,0,0,0,'2020-04-26 11:03:53',NULL),
	(20,'5643654',4,1,'/upload/images/1587873993.jpeg','323543',NULL,'<p>32432432432</p>',87,'3543','43654','654654','233',1,0,0,0,0,'2020-04-26 11:06:23',NULL),
	(21,'5354',4,1,NULL,NULL,NULL,'<p>454364654</p>',84,NULL,NULL,NULL,NULL,0,0,0,0,0,'2020-04-26 11:13:16',NULL),
	(22,'sfdsafd',4,1,NULL,NULL,NULL,'<p>2432</p>',93,NULL,NULL,NULL,NULL,0,0,0,0,0,'2020-04-26 11:14:00',NULL),
	(23,'sfdsafd',4,1,NULL,NULL,NULL,'<p>fds</p>',97,NULL,NULL,NULL,NULL,0,0,0,0,0,'2020-04-26 11:16:39',NULL),
	(25,'sfdsafd',2,1,NULL,NULL,NULL,'<p>3453543</p>',75,NULL,NULL,NULL,NULL,1,0,0,0,0,'2020-04-26 11:18:14',NULL),
	(26,'23543',4,1,NULL,NULL,NULL,'<p>354543</p>',90,NULL,NULL,NULL,NULL,0,0,0,0,0,'2020-04-26 11:27:46',NULL),
	(27,'23',1,1,NULL,NULL,NULL,'<p>trewsgf</p>',60,NULL,NULL,NULL,NULL,0,0,0,0,0,'2020-04-26 11:32:20',NULL),
	(28,'sfdsafd',2,1,NULL,NULL,NULL,'<p>wtert</p>',83,NULL,NULL,NULL,NULL,0,0,0,0,0,'2020-04-26 11:32:53','2020-04-26 10:04:58'),
	(29,'IX Securities 为交易者接入最具流动性的商品交易市场',6,1,NULL,NULL,'这是一段描述','<p>尊敬的客户：</p>\n            <p>西德萨斯原油期货（CL-OIL）、恐慌指数期货（VIX）与富时中国A50指数（CHINA50）将于对应日期开盘自动展期。展期后的新合约最终呈现的差价已包含点差的成本并将以Balance形式体现，请持仓交易的客户按需及时调整仓位。\n            </p>\n            <p>具体展期时间如下图所示，以下均为平台时间，GMT(格林威治标准时间)+3。日期可能会有所变更，请依实际盘面为准。</p>\n            <p><img class=\"alignnone size-full wp-image-5895 aligncenter lazy-loaded\"\n                    src=\"https://cn.ixsecurities.com/wp-content/uploads/2020/05/20200512.png\" data-lazy-type=\"image\"\n                    data-src=\"https://cn.ixsecurities.com/wp-content/uploads/2020/05/20200512.png\" alt=\"\" width=\"662\"\n                    height=\"216\"\n                    srcset=\"https://cn.ixsecurities.com/wp-content/uploads/2020/05/20200512.png 662w, https://cn.ixsecurities.com/wp-content/uploads/2020/05/20200512-300x98.png 300w\"\n                    data-srcset=\"\" sizes=\"(max-width: 662px) 100vw, 662px\"><noscript><img\n                        class=\"alignnone size-full wp-image-5895 aligncenter\"\n                        src=\"https://cn.ixsecurities.com/wp-content/uploads/2020/05/20200512.png\" alt=\"\" width=\"662\"\n                        height=\"216\"\n                        srcset=\"https://cn.ixsecurities.com/wp-content/uploads/2020/05/20200512.png 662w, https://cn.ixsecurities.com/wp-content/uploads/2020/05/20200512-300x98.png 300w\"\n                        sizes=\"(max-width: 662px) 100vw, 662px\" /></noscript></p>\n            <p><strong>请注意：<br>\n                    ．系统将自动进行展期，当前所有仓位仍将维持开放状态。<br>\n                    ．合约到期日当天，新开仓位将会通过反映到期合约和新合约之间价差的展期费用、或信用金的形式进行调整。<br>\n                    ．客户可在到期日之前关闭所有所持仓位，以避开差价合约展期。<br>\n                    ．客户需确保在该次合约展期前进行止盈和止损调整。</strong></p>\n            <p>IX Securities将持续为客户提供优质且专业的服务，若您有任何疑问或需要协助，请与我们联系，感谢您的理解和支持。</p>',104,NULL,NULL,NULL,NULL,0,0,0,0,0,'2020-05-22 21:14:15',NULL),
	(30,'提供灵活的交易杠杆来交易黄金、白银和原油等世界上流行的商品',6,1,NULL,NULL,'这是一段描述','<p>尊敬的客户：</p>\n            <p>西德萨斯原油期货（CL-OIL）、恐慌指数期货（VIX）与富时中国A50指数（CHINA50）将于对应日期开盘自动展期。展期后的新合约最终呈现的差价已包含点差的成本并将以Balance形式体现，请持仓交易的客户按需及时调整仓位。\n            </p>\n            <p>具体展期时间如下图所示，以下均为平台时间，GMT(格林威治标准时间)+3。日期可能会有所变更，请依实际盘面为准。</p>\n            <p><img class=\"alignnone size-full wp-image-5895 aligncenter lazy-loaded\"\n                    src=\"https://cn.ixsecurities.com/wp-content/uploads/2020/05/20200512.png\" data-lazy-type=\"image\"\n                    data-src=\"https://cn.ixsecurities.com/wp-content/uploads/2020/05/20200512.png\" alt=\"\" width=\"662\"\n                    height=\"216\"\n                    srcset=\"https://cn.ixsecurities.com/wp-content/uploads/2020/05/20200512.png 662w, https://cn.ixsecurities.com/wp-content/uploads/2020/05/20200512-300x98.png 300w\"\n                    data-srcset=\"\" sizes=\"(max-width: 662px) 100vw, 662px\"><noscript><img\n                        class=\"alignnone size-full wp-image-5895 aligncenter\"\n                        src=\"https://cn.ixsecurities.com/wp-content/uploads/2020/05/20200512.png\" alt=\"\" width=\"662\"\n                        height=\"216\"\n                        srcset=\"https://cn.ixsecurities.com/wp-content/uploads/2020/05/20200512.png 662w, https://cn.ixsecurities.com/wp-content/uploads/2020/05/20200512-300x98.png 300w\"\n                        sizes=\"(max-width: 662px) 100vw, 662px\" /></noscript></p>\n            <p><strong>请注意：<br>\n                    ．系统将自动进行展期，当前所有仓位仍将维持开放状态。<br>\n                    ．合约到期日当天，新开仓位将会通过反映到期合约和新合约之间价差的展期费用、或信用金的形式进行调整。<br>\n                    ．客户可在到期日之前关闭所有所持仓位，以避开差价合约展期。<br>\n                    ．客户需确保在该次合约展期前进行止盈和止损调整。</strong></p>\n            <p>IX Securities将持续为客户提供优质且专业的服务，若您有任何疑问或需要协助，请与我们联系，感谢您的理解和支持。</p>',37,NULL,NULL,NULL,NULL,0,0,0,0,0,'2020-05-22 21:14:25',NULL),
	(31,'kifdsklfkslfds',6,1,NULL,NULL,'这是一段描述','<p>436543653654</p>',84,NULL,NULL,NULL,NULL,0,0,0,0,0,'2020-05-23 23:18:03',NULL),
	(32,'五月展期通知',6,1,NULL,NULL,'这是一段描述112','<p><span style=\"background-color: rgb(255, 255, 255); color: rgb(96, 96, 96);\">尊敬的客户：</span></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(96, 96, 96);\">由于2020年5月1日星期五为劳动节(Labor Day)，2020年5月8日星期五为英国五月初银行公休日(Early May Bank Holiday)，2020年5月25日星期一为阵亡将士纪念日(Memorial Day)，请参阅以下交易时间变更详情。此外，</span><strong style=\"background-color: rgb(255, 255, 255); color: rgb(96, 96, 96);\">五一假期期间，平台所有业务照常开展，开户、出入金与客户咨询服务都正常进行，仅需留意银行于假期中并无营业，款项到账时间可能有所延迟，在此特提醒您按需安排出入金申请。</strong></p><p><strong style=\"background-color: rgb(255, 255, 255); color: rgb(96, 96, 96);\">请注意，市场最初可能经历假期后流动性降低的时期，这可能会影响交易执行。您有责任持续监控您可能拥有的任何未结头寸。请注意以下时间表：</strong></p><p><span style=\"background-color: rgb(255, 255, 255); color: rgb(96, 96, 96);\">以下所有时间均为平台时间，GMT(格林威治标准时间)+3。日期和时间可能会有所变更，请以实盘为准.</span></p><p><br></p>',94,NULL,NULL,NULL,NULL,0,0,0,0,0,'2020-05-23 23:18:43',NULL);

/*!40000 ALTER TABLE `article` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table channel
# ------------------------------------------------------------

DROP TABLE IF EXISTS `channel`;

CREATE TABLE `channel` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(20) DEFAULT NULL COMMENT '栏目标题',
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '英文别名 唯一值 路由名称  /channel/???',
  `model` tinyint NOT NULL DEFAULT '0' COMMENT '栏目模型 0 文章, 1单页, 2下载',
  `desc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '栏目描述',
  `isNav` tinyint NOT NULL DEFAULT '0' COMMENT '是否导航',
  `content` longtext CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '单页模型 内容',
  `template` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '模板名称,默认提供',
  `aritcleTemplate` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '所属栏目文章模板',
  `show` tinyint NOT NULL DEFAULT '1' COMMENT '是否显示',
  `sort` int NOT NULL DEFAULT '50' COMMENT '排序',
  `img` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '栏目内容封面',
  `banner` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '栏目banner图',
  `seoTitle` varchar(100) DEFAULT NULL,
  `seoKey` varchar(100) DEFAULT NULL,
  `seoDesc` varchar(100) DEFAULT NULL,
  `createTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='栏目';

LOCK TABLES `channel` WRITE;
/*!40000 ALTER TABLE `channel` DISABLE KEYS */;

INSERT INTO `channel` (`id`, `title`, `name`, `model`, `desc`, `isNav`, `content`, `template`, `aritcleTemplate`, `show`, `sort`, `img`, `banner`, `seoTitle`, `seoKey`, `seoDesc`, `createTime`, `updateTime`)
VALUES
	(1,'上市品种','product',1,'IX Securities 为交易者接入最具流动性的商品交易市场\n提供灵活的交易杠杆来交易黄金、白银和原油等世界上流行的商品',1,'<div class=\"post-content\">\n                    <p>随着金融市场的对外开放和人民币国际化的推进，国内外汇衍生品市场从封闭走向开放，各类境外机构有序进入境内市场，外汇市场与债券市场、股票市场对外开放形成积极互动。2018年5月，国家外汇管理局国际收支司司长王春英在《中国外汇》撰文指出，外汇局将以拓宽交易范围、丰富交易工具、扩大市场主体、推动对外开放、健全基础设施、完善市场监管为重点，继续推动外汇市场深化发展，为经济社会平稳健康发展提供有力的支撑。今天小编就和大家一起聊一聊我国的外汇衍生品市场。\n                    </p>\n                    <p class=\"ql-align-center\">\n                        <img\n                            src=\"http://5b0988e595225.cdn.sohucs.com/images/20190304/aad0a4e4120a439dae02a9952985eb88.jpeg\" />\n                    </p>\n                    <p><strong>外汇衍生品市场的演进</strong></p>\n                    <p>1、2005年开始的汇改</p>\n                    <p>全球外汇衍生品市场演进的实践充分表明汇率制度改革是外汇衍生品市场的核心动力，因此我国外汇衍生品市场实际就是在人民币汇率改革推动下不断向前发展的。改革开放以来人民币汇率制度经历多次重大变革，由传统计划体制下的固定汇率制度逐步演变为实行以市场供求为基础的、参考一篮子货币进行调节、有管理的浮动汇率制度，而其中2005年7月的汇改是重要的一环。\n                    </p>\n                    <p>从2005年汇改以后，人民币从固定汇率制向浮动汇率制过渡，市场化定价机制日渐成型，国内外金融资产价格体系逐步接轨，人民币汇率作为一种基础性的经济资源和金融资产价格，正成为广泛影响金融市场运行的关键因素以及全球金融市场的重要因子。\n                    </p>\n                    <p>2、外汇衍生品市场的实践</p>\n                    <p>推出远期外汇合约</p>\n                    <p>2005年8月8日，中国人民银行发布《关于加快发展外汇市场有关问题的通知》，据此银行间外汇市场推出了远期外汇合约，从而诞生了首款人民币外汇衍生品合约。远期外汇合约是指交易双方以约定的外汇币种、金额、汇率，在约定的未来某一日期交割的人民币对外汇的一种金融合约。\n                    </p>\n                    <p>批准开展人民币与外币掉期</p>\n                    <p>2005年8月10日，允许银行间外汇市场开展人民币外币掉期交易，人民币外汇掉期是指交易双方约定一前一后两个不同的交割日、方向相反的两次本外币交换，在前一次的交换中，一方外汇按照约定汇率从另一方换入人民币；在后一次的交换中，该方再用人民币按照另一方约定汇率从另一方换回币种相同的等额外汇。然而由于技术上的问题，直到2006年4月才正式推出人民币外汇掉期交易。由于在风险管理成本上具有比较优势，人民币与外汇掉期一经推出便受到了普遍欢迎。\n                    </p>\n                    <p>开放人民币对外汇期权</p>\n                    <p>2011年外汇管理局在银行间外汇市场历史性地推出了人民币对外汇的期权产品。人民币对外汇期权是指在未来某一交易日以约定汇率买卖一定数量外汇资产的权利。合约分为看涨期权与看跌期权，期权交易以人民币作为期权费币种，并且要求行权以约定的执行价格对期权合约本金全额交割，原则上实行全额交割而不得进行差额交割。\n                    </p>\n                    <p><strong>外汇衍生品监管</strong></p>\n                    <p>我国在探索外汇衍生品市场的过程中，始终秉持有管理的市场发展理念和思路，逐步形成适合我国国情和市场发展实际的监管体系和构架。</p>\n                    <p>1. 监管机构</p>\n                    <p>随着外汇衍生品市场的建立和发展，我国形成了中国人民银行（包括外汇管理局）、中国证监会、中国银保监会共同组成的“一行两会”的外汇衍生品市场的监管组织架构，其中又以中国人民银行和中国银保监会为主导。中国人民银行承担着宏观审慎监管的职责，以保持金融体系和金融市场的稳定为己任，国家外汇管理局负责全国外汇市场的监督管理工作，而中国银保监会实施对银行业金融机构的微观审慎监管。\n                    </p>\n                    <p>根据上述监管分工，当市场推出各种外汇衍生品之际，中国人民银行会有针对性地提前出台相关管理政策，从市场准入、架构、运行机制、信息披露等方面加以制度规范。国家外汇管理局会根据银行间外汇市场的变化，出台有关外汇衍生品市场的具体监督政策，比如2014年12月发布的《关于调整金融机构进入银行间外汇市场有关管理政策的通知》\n                    </p>\n                    <p>2、自律管理</p>\n                    <p>中国银行间交易商协会（NAFMII）于2007年9月3日正式成立，该协会是由包括银行间债券市场、同业拆借市场、外汇市场、票据市场和黄金市场等在内的市场参与者自愿组成的自律性组织，交易商协会的成立弥补了我国外汇衍生品市场的自律组织的空白，先后发布了《中国银行间市场金融衍生品交易主协会》（2007年）、《中国银行间市场交易商协会会员管理规则》（2008年）、《银行间金融衍生品产品交易内部风险管理指引》（2010年）等文件。通过交易商协会组织市场成员将强制度规范和产品创新，可以说是我国外汇衍生品市场监管的一种新探索。\n                    </p>\n                    <p>3、一线监控</p>\n                    <p>作为中国人民银行总行直属的事业单位，中国外汇交易中心（以下简称交易中心）是我国外汇衍生品市场的具体组织者和运行者，承担着对市场的一线监控职责，具体集中在以下三个方面：</p>\n                    <p>一是提供交易平台。交易中心提供外汇衍生品的电子交易系统，该交易系统拥有集中竞价和双边询价两种交易模式，并提供单银行平台、交易分析、做市接口和即时通讯工具等系统服务。</p>\n                    <p>二是制定交易规则。交易中心根据中国人民银行颁布的单个外汇衍生品管理办法，制定了配套的、操作性强的交易规则，从而引导交易者规范有序地开展外汇衍生品交易。</p>\n                    <p>三是开展动态监测。交易中心对外汇衍生品市场的异常交易和风险指标等进行实时监测同时也开展数据统计和对外披露工作。</p>\n                    <p>4、交易清算</p>\n                    <p>2007年国际金融危机爆发后，国际社会对场外衍生品市场建立集中清算制度安排以降低交易对手风险并实施有效监管达成了普遍共识。在这样的背景下，2009年上海清算所成立，为包括外汇衍生品在内的各类银行间产品提供以中央对手方净额清算为主的直接和间接的本外币清算服务，从而有效降低场外金融产品参与者开展交易的资金成本，提高衍生品市场整体的效率和流动性。\n                    </p>\n                    <p><strong>小结</strong></p>\n                    <p>随着我国汇率市场化程度不断提高，各类市场主体面临的汇率风险不断加大，如果缺乏有效的风险管理工具，那么市场主体将无法有效的管理风险敞口，而外汇衍生品市场则为管理汇率风险提供了便捷有效的金融工具，满足实体经济日益多样化、个性化的需求。\n                    </p>\n                    <blockquote>\n                        <p>本文转自：数汇财经</p>\n                    </blockquote>\n                </div>',NULL,NULL,1,50,NULL,NULL,NULL,NULL,NULL,'2020-05-19 17:01:23',NULL),
	(2,'资金与费用','cost',1,NULL,1,NULL,NULL,NULL,1,50,NULL,NULL,NULL,NULL,NULL,'2020-05-19 17:02:34',NULL),
	(3,'市场简介','market',1,NULL,1,NULL,NULL,NULL,1,50,NULL,NULL,NULL,NULL,NULL,'2020-05-19 17:03:04',NULL),
	(4,'行业新闻','news',0,NULL,1,NULL,NULL,NULL,1,50,NULL,NULL,NULL,NULL,NULL,'2020-05-19 17:03:39',NULL),
	(5,'增训中心','train',0,NULL,1,NULL,NULL,NULL,1,50,NULL,NULL,NULL,NULL,NULL,'2020-05-19 17:03:56',NULL),
	(6,'交易商公告','market-notice',0,'关于 IX Securities 的各类通知',1,NULL,'notice','notice-content',1,50,NULL,NULL,NULL,NULL,NULL,'2020-05-19 17:04:29','2020-05-21 13:52:10'),
	(7,'下载','download',2,'交易商软件下载，及一些重要文件下载',1,NULL,NULL,NULL,1,50,NULL,NULL,NULL,NULL,NULL,'2020-05-19 17:05:10','2020-05-21 14:07:19'),
	(8,'市场研究','report',0,NULL,0,NULL,NULL,NULL,1,50,NULL,NULL,NULL,NULL,NULL,'2020-05-19 17:05:41',NULL),
	(9,'网站公告','notice',0,NULL,0,NULL,'notice',NULL,1,50,NULL,NULL,NULL,NULL,NULL,'2020-05-19 17:06:35','2020-05-21 14:16:38'),
	(10,'财经日历','calendar',1,'全球最新财经大事件的实时通道',0,NULL,'calendar',NULL,1,50,NULL,NULL,NULL,NULL,NULL,'2020-05-21 14:42:34','2020-05-21 13:44:25');

/*!40000 ALTER TABLE `channel` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table config_content
# ------------------------------------------------------------

DROP TABLE IF EXISTS `config_content`;

CREATE TABLE `config_content` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `ad` int DEFAULT NULL,
  `link1_title` varchar(10) DEFAULT NULL,
  `link1_url` varchar(200) DEFAULT NULL,
  `link1_img` varchar(200) DEFAULT NULL,
  `link2_title` varchar(10) DEFAULT NULL,
  `link2_url` varchar(200) DEFAULT NULL,
  `link2_img` varchar(200) DEFAULT NULL,
  `link3_title` varchar(10) DEFAULT NULL,
  `link3_url` varchar(200) DEFAULT '',
  `link3_img` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='内容页配置';

LOCK TABLES `config_content` WRITE;
/*!40000 ALTER TABLE `config_content` DISABLE KEYS */;

INSERT INTO `config_content` (`id`, `ad`, `link1_title`, `link1_url`, `link1_img`, `link2_title`, `link2_url`, `link2_img`, `link3_title`, `link3_url`, `link3_img`)
VALUES
	(1,2,'财经日历',NULL,'/upload/images/config/2020/1590241553.jpeg','网上开户',NULL,NULL,'保证金计算',NULL,NULL);

/*!40000 ALTER TABLE `config_content` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table config_index
# ------------------------------------------------------------

DROP TABLE IF EXISTS `config_index`;

CREATE TABLE `config_index` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `banner` int DEFAULT NULL,
  `notice` int DEFAULT NULL,
  `ad` int DEFAULT NULL,
  `m1` int DEFAULT NULL,
  `m2` int DEFAULT NULL,
  `m_title` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `m3` int DEFAULT NULL,
  `m4` int DEFAULT NULL,
  `m5` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='首页配置';

LOCK TABLES `config_index` WRITE;
/*!40000 ALTER TABLE `config_index` DISABLE KEYS */;

INSERT INTO `config_index` (`id`, `banner`, `notice`, `ad`, `m1`, `m2`, `m_title`, `m3`, `m4`, `m5`)
VALUES
	(1,1,6,2,6,3,'行业动态',5,4,8);

/*!40000 ALTER TABLE `config_index` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table download
# ------------------------------------------------------------

DROP TABLE IF EXISTS `download`;

CREATE TABLE `download` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `channelId` int DEFAULT NULL COMMENT '栏目id',
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '下载名称',
  `img` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '图片标识',
  `filename` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '文件名',
  `size` bigint DEFAULT NULL COMMENT '文件大小',
  `ext` varchar(50) DEFAULT NULL COMMENT '文件类型',
  `file` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '文件地址',
  `desc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '下载描述',
  `createTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '上传时间',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `channelId` (`channelId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `download` WRITE;
/*!40000 ALTER TABLE `download` DISABLE KEYS */;

INSERT INTO `download` (`id`, `channelId`, `name`, `img`, `filename`, `size`, `ext`, `file`, `desc`, `createTime`, `updateTime`)
VALUES
	(1,7,'pc软件下载',NULL,NULL,2432432,'jpe',NULL,'fkdsfdsfds','2020-05-22 13:13:29',NULL),
	(2,7,'2432',NULL,NULL,NULL,NULL,NULL,NULL,'2020-05-22 14:39:07',NULL),
	(3,7,'535',NULL,'service-worker.js',1181,'js','/upload/download/1590134192.js',NULL,'2020-05-22 14:56:32',NULL),
	(6,7,'金财神软件下载','/upload/images/2020/1590150138.jpg','2.jpeg',7213,'jpeg','/upload/download/2020/1590150170.jpeg','软件版本1.2021.21','2020-05-22 19:22:50',NULL);

/*!40000 ALTER TABLE `download` ENABLE KEYS */;
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
	(4,'53','fdsfds',0,'/upload/images/1588389987.jpeg',1,45,'2020-04-26 16:50:42','2020-05-02 03:26:29'),
	(5,'中国','21231',1,'/upload/images/1588389973.jpeg',1,50,'2020-05-02 10:26:15',NULL);

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
  `level` tinyint NOT NULL DEFAULT '0' COMMENT '会员等级 0 注册会员 1交易会员  2 普通代理 3高级代理  4 内部会员',
  `createTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `member` WRITE;
/*!40000 ALTER TABLE `member` DISABLE KEYS */;

INSERT INTO `member` (`id`, `username`, `password`, `name`, `phone`, `email`, `nickname`, `level`, `createTime`, `updateTime`)
VALUES
	(1,'001','1bbd886460827015e5d605ed44252251','系统内置','','','',4,'2020-05-01 19:54:57','2020-05-01 13:10:02'),
	(3,'tests11','1bbd886460827015e5d605ed44252251',NULL,NULL,NULL,NULL,0,'2020-05-02 10:50:17',NULL);

/*!40000 ALTER TABLE `member` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table member_account
# ------------------------------------------------------------

DROP TABLE IF EXISTS `member_account`;

CREATE TABLE `member_account` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `account` varchar(50) NOT NULL DEFAULT '' COMMENT '交易账号',
  `username` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '001' COMMENT '会员账号 001 为系统，如果不填写则为系统内部交易账号',
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '姓名',
  `active` tinyint NOT NULL DEFAULT '0' COMMENT '是否激活 0未激活  1激活',
  `idCard` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '交易账户对应的身份证号',
  `platform` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '网站平台' COMMENT '平台名称',
  `img1` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '照片资料 多张用逗号 隔开 ,',
  `img2` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '照片资料 多张用逗号 隔开 ,',
  `img3` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '照片资料 多张用逗号 隔开 ,',
  `img4` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '照片资料 多张用逗号 隔开 ,',
  `bankImg1` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '照片资料 ',
  `bankImg2` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '照片资料',
  `createTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `account` (`account`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员交易账户';

LOCK TABLES `member_account` WRITE;
/*!40000 ALTER TABLE `member_account` DISABLE KEYS */;

INSERT INTO `member_account` (`id`, `account`, `username`, `name`, `active`, `idCard`, `platform`, `img1`, `img2`, `img3`, `img4`, `bankImg1`, `bankImg2`, `createTime`, `updateTime`)
VALUES
	(1,'32342432','001','rwrewrew',0,NULL,'网站平台','','','','','','','2020-05-02 09:32:16',NULL),
	(2,'232342432','001','中国',0,NULL,'网站平台',NULL,'','','','','','2020-05-02 09:37:16',NULL),
	(3,'001','001','kissabc',1,NULL,'网站平台','/upload/images/1588388712.jpeg',NULL,NULL,NULL,NULL,NULL,'2020-05-02 10:05:28','2020-05-02 03:48:08');

/*!40000 ALTER TABLE `member_account` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table member_money
# ------------------------------------------------------------

DROP TABLE IF EXISTS `member_money`;

CREATE TABLE `member_money` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL COMMENT '产生佣金 归属日期',
  `account` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '会员id',
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '交易账户id',
  `money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '佣金 元',
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '结算状态 0 未结算 1已结算',
  `createTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updateTime` datetime DEFAULT NULL COMMENT '更新日期',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员资金记录';

LOCK TABLES `member_money` WRITE;
/*!40000 ALTER TABLE `member_money` DISABLE KEYS */;

INSERT INTO `member_money` (`id`, `date`, `account`, `username`, `money`, `status`, `createTime`, `updateTime`)
VALUES
	(1,'2020-01-20 00:00:00','001','001',1532.00,0,'2020-05-02 16:21:38',NULL),
	(3,'2020-05-05 16:55:41','001','001',12.00,1,'2020-05-02 16:55:48',NULL),
	(4,'2020-05-12 00:00:00','001','001',-324324.00,0,'2020-05-02 16:56:48',NULL);

/*!40000 ALTER TABLE `member_money` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table member_open
# ------------------------------------------------------------

DROP TABLE IF EXISTS `member_open`;

CREATE TABLE `member_open` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '姓名',
  `idCard` varchar(20) NOT NULL DEFAULT '' COMMENT '身份证号',
  `username` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '会员账号',
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '状态： 0未处理  1开户成功  2开户失败',
  `issue` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '失败原因',
  `platform` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '网站平台' COMMENT '平台名称',
  `img1` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '照片资料1',
  `img2` varchar(100) DEFAULT NULL COMMENT '照片资料2',
  `img3` varchar(100) DEFAULT NULL COMMENT '照片资料3',
  `img4` varchar(100) DEFAULT NULL COMMENT '照片资料4',
  `bankImg1` varchar(100) DEFAULT NULL COMMENT '银行卡资料1',
  `bankImg2` varchar(100) DEFAULT NULL COMMENT '银行卡资料2',
  `createTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员开户资料提交';

LOCK TABLES `member_open` WRITE;
/*!40000 ALTER TABLE `member_open` DISABLE KEYS */;

INSERT INTO `member_open` (`id`, `name`, `idCard`, `username`, `status`, `issue`, `platform`, `img1`, `img2`, `img3`, `img4`, `bankImg1`, `bankImg2`, `createTime`, `updateTime`)
VALUES
	(2,'323','513822198901110193','323432',2,'资料填写错误','网站平台',NULL,NULL,NULL,NULL,NULL,NULL,'2020-04-19 16:03:38',NULL),
	(3,'323','513822198901110193','323432',0,NULL,'网站平台',NULL,NULL,NULL,NULL,NULL,NULL,'2020-04-19 16:03:38','2020-05-03 03:49:21'),
	(4,'东哥','51382219890111023X','001',2,'32423','网站平台','/upload/images/1587961126.jpeg','/upload/images/1587961126.jpeg','/upload/images/1587961126.jpeg','/upload/images/1587961126.jpeg','/upload/images/1587961126.jpeg','/upload/images/1587961126.jpeg','2020-05-02 22:08:46','2020-05-03 03:52:22');

/*!40000 ALTER TABLE `member_open` ENABLE KEYS */;
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
  `footer_title` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '页脚标题',
  `footer_desc` longtext CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '页脚介绍',
  `caseNumber` varchar(50) DEFAULT NULL COMMENT '备案号',
  `pcCode` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '第三方代码 pc',
  `mobileCode` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '第三方代码 mobile',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='站点配置';

LOCK TABLES `site` WRITE;
/*!40000 ALTER TABLE `site` DISABLE KEYS */;

INSERT INTO `site` (`id`, `name`, `logo`, `net`, `seoTitle`, `seoKey`, `seoDesc`, `copyright`, `phone`, `mobileLogo`, `footer_title`, `footer_desc`, `caseNumber`, `pcCode`, `mobileCode`)
VALUES
	(1,'中国大宗商品交易协会','/upload/images/1588389824.jpeg','www.baidu.com',NULL,'13','14','© COPY RIGHTS - 2020 ALL RIGHTS RESERVED','028-28382932','/upload/images/1587961126.jpeg','风险警告','风险警告:所有投资都存在风险，都可能带来收益和损失，尤其是交易如外汇和差价合约等杠杆衍生品，会给您的投资带来高风险。这些衍生产品中许多都是杠杆产品，可能不适合所有投资者。杠杆在能够放大盈利的同时，也会将损失放大。杠杆衍生品的价格可能会快速的转向于您不利的局面，您的损失或超出您的投资额，并可能需要进一步支付您的亏损。在投资时，您必须了解您的资金所面临的风险。过去的表现并不能作为未来表现的参考。对决定是否投资做出再三考量是您的责任。在决定投资任何金融产品之前，您应认真考虑自己的投资目标、交易知识和经验以及承受损失的能力。如您对产品相关风险有任何疑问，请咨询独立专业人士。本公司不承担任何依照建议进行交易导致的损失。且本公司网站仅为会员客户提供第三方指导开户，并不参于任何金融衍生品的制定与交易.','kfdsirew','<dkfdsj>','<kiwere>');

/*!40000 ALTER TABLE `site` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
