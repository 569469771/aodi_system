-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2017-09-07 11:31:24
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `aodi_system`
--

-- --------------------------------------------------------

--
-- 表的结构 `aodi_account`
--

CREATE TABLE IF NOT EXISTS `aodi_account` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `month` varchar(10) CHARACTER SET utf8 NOT NULL DEFAULT '0' COMMENT '月份',
  `customer_id` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '客户表id',
  `order_account` decimal(12,3) NOT NULL DEFAULT '0.000' COMMENT '月份订单总价格',
  `u_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加者id',
  `date` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  KEY `month` (`month`)
) ENGINE=MyISAM DEFAULT CHARSET=armscii8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `aodi_company`
--

CREATE TABLE IF NOT EXISTS `aodi_company` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_name` varchar(100) NOT NULL COMMENT '公司名称',
  `company_adress` varchar(100) NOT NULL COMMENT '公司地址',
  `company_state` enum('0','1','3') NOT NULL DEFAULT '1' COMMENT '状态（0是删除，1存在）',
  `company_area` varchar(50) NOT NULL COMMENT '公司地区',
  `u_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加者',
  `up_date` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='公司表' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `aodi_company`
--

INSERT INTO `aodi_company` (`id`, `company_name`, `company_adress`, `company_state`, `company_area`, `u_id`, `up_date`) VALUES
(1, '宁波奥迪斯丹有限责任公司', '浙江省宁波市北仑区', '1', '浙江省', 2, 1484730471),
(2, '安庆奥迪斯丹有限责任公司', '安徽省安庆市望江县', '1', '安徽省', 2, 1484730481),
(3, '连云港奥迪斯丹有限责任公司', '连云港经济开发区', '1', '连云港', 1, 1484731471);

-- --------------------------------------------------------

--
-- 表的结构 `aodi_cuspaper`
--

CREATE TABLE IF NOT EXISTS `aodi_cuspaper` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `paper_id` int(10) unsigned NOT NULL COMMENT '纸板表id',
  `customer_id` int(10) NOT NULL COMMENT '客户id',
  `sup_id` int(10) NOT NULL DEFAULT '0' COMMENT '供应商表ID',
  `cuspa_price` decimal(8,3) NOT NULL DEFAULT '0.000' COMMENT '客户纸板价格1平方米',
  `cuspa_state` enum('0','1','2') NOT NULL DEFAULT '1' COMMENT '0删除，1可用，2其他',
  `u_id` int(10) NOT NULL DEFAULT '0' COMMENT '添加者id',
  `up_date` int(10) NOT NULL DEFAULT '1' COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  KEY `sup_id` (`sup_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='客户报价表' AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `aodi_cuspaper`
--

INSERT INTO `aodi_cuspaper` (`id`, `paper_id`, `customer_id`, `sup_id`, `cuspa_price`, `cuspa_state`, `u_id`, `up_date`) VALUES
(1, 1, 1, 1, '7.000', '1', 1, 1486646052),
(2, 4, 1, 1, '8.200', '1', 1, 1486646060),
(3, 2, 2, 2, '6.200', '1', 1, 1486646078),
(4, 6, 2, 1, '7.100', '1', 1, 1486646132),
(5, 3, 5, 2, '6.500', '1', 2, 1486796970),
(6, 3, 2, 2, '8.200', '1', 2, 1486967991),
(7, 4, 2, 1, '8.500', '1', 2, 1486968041),
(8, 1, 2, 1, '7.600', '1', 2, 1486968130),
(9, 7, 2, 2, '6.300', '1', 2, 1486968149),
(10, 2, 1, 2, '6.700', '1', 2, 1486977601),
(11, 5, 5, 1, '8.300', '1', 2, 1487149599),
(12, 6, 5, 1, '7.560', '1', 2, 1487149913);

-- --------------------------------------------------------

--
-- 表的结构 `aodi_customer`
--

CREATE TABLE IF NOT EXISTS `aodi_customer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `customer_code` varchar(30) NOT NULL COMMENT '客户编号',
  `customer_adress` varchar(255) DEFAULT NULL COMMENT '客户地址',
  `customer_credit` decimal(12,3) NOT NULL DEFAULT '5000.000' COMMENT '客户信用额',
  `customer_name` varchar(50) NOT NULL COMMENT '客户名称',
  `customer_state` enum('0','1','2') NOT NULL DEFAULT '1' COMMENT '客户是否可用，0不存在，1存在',
  `customer_fname` varchar(100) NOT NULL COMMENT '客户全称',
  `company_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '公司id',
  `u_id` int(10) unsigned NOT NULL COMMENT '添加者id',
  `u_cit` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '修改信用额者id',
  `up_date` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加日期',
  PRIMARY KEY (`id`),
  KEY `customer_name` (`customer_name`),
  KEY `company_id` (`company_id`),
  KEY `customer_code` (`customer_code`),
  FULLTEXT KEY `customer_fname` (`customer_fname`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='客户表' AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `aodi_customer`
--

INSERT INTO `aodi_customer` (`id`, `customer_code`, `customer_adress`, `customer_credit`, `customer_name`, `customer_state`, `customer_fname`, `company_id`, `u_id`, `u_cit`, `up_date`) VALUES
(1, 'D1', '安徽省望江县', '123456.000', '亚控', '1', '', 2, 0, 1, 0),
(2, 'D43', '安徽省太湖县', '900000.000', '宏宇', '1', '安徽宏宇五洲医用器械有限公司', 2, 0, 1, 0),
(3, 'D2', '安徽省太湖县', '2222.000', '大山', '1', '大山科技', 2, 2, 1, 1484730471),
(4, 'D3', '望江', '65656.000', '聚达', '1', '聚达电商', 2, 2, 2, 1483345510),
(5, 'D107', '安庆市', '5000.000', '美迪尔', '1', '安庆美迪尔吊顶', 2, 2, 0, 1484894927),
(6, 'D118', '安徽省安庆市', '5000.000', '安心', '1', '安心纸业有限公司', 2, 2, 0, 1484728546);

-- --------------------------------------------------------

--
-- 表的结构 `aodi_delgoods`
--

CREATE TABLE IF NOT EXISTS `aodi_delgoods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `job_num` varchar(20) NOT NULL COMMENT '工单号',
  `del_num` mediumint(8) NOT NULL COMMENT '送货数量',
  `order_id` int(10) NOT NULL COMMENT '订单id',
  `u_id` int(10) NOT NULL COMMENT '添加者id',
  `up_date` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `job_num` (`job_num`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='送货明细表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `aodi_group`
--

CREATE TABLE IF NOT EXISTS `aodi_group` (
  `id` tinyint(4) unsigned NOT NULL AUTO_INCREMENT COMMENT '表id',
  `name` varchar(100) NOT NULL COMMENT '组名',
  `group_state` enum('0','1') NOT NULL DEFAULT '1' COMMENT '删除状态，0删除，1存在',
  `up_date` int(50) NOT NULL DEFAULT '0' COMMENT '创建日期',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户组表' AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `aodi_group`
--

INSERT INTO `aodi_group` (`id`, `name`, `group_state`, `up_date`) VALUES
(1, '系统管理员', '1', 0),
(2, '生产', '1', 0),
(3, '客服', '1', 0),
(4, '美工', '1', 0),
(5, '仓库管理员', '1', 0),
(6, '采购员', '1', 0),
(7, '质检', '1', 0);

-- --------------------------------------------------------

--
-- 表的结构 `aodi_kesu`
--

CREATE TABLE IF NOT EXISTS `aodi_kesu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) unsigned NOT NULL COMMENT '客户id',
  `company_id` int(10) NOT NULL COMMENT '公司id',
  `customer_name` varchar(50) NOT NULL COMMENT '客户名称',
  `mant_num` varchar(20) NOT NULL DEFAULT '0' COMMENT '管理号',
  `com_title` varchar(100) NOT NULL COMMENT '内容标题',
  `com_state` enum('0','1','2') NOT NULL DEFAULT '1' COMMENT '状态，1显示，0不显示',
  `u_id` int(10) unsigned NOT NULL COMMENT '添加者id',
  `up_date` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`,`customer_name`),
  KEY `u_id` (`u_id`),
  KEY `com_title` (`com_title`),
  KEY `company_id` (`company_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='客诉表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `aodi_kesutext`
--

CREATE TABLE IF NOT EXISTS `aodi_kesutext` (
  `complain_id` int(10) unsigned NOT NULL COMMENT '客诉表id',
  `com_text` text NOT NULL COMMENT '客诉内容',
  `com_result` text NOT NULL COMMENT '处理结果',
  PRIMARY KEY (`complain_id`),
  FULLTEXT KEY `com_text` (`com_text`,`com_result`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='客诉内容表';

-- --------------------------------------------------------

--
-- 表的结构 `aodi_log`
--

CREATE TABLE IF NOT EXISTS `aodi_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `log_name` varchar(50) NOT NULL COMMENT '登陆者名称',
  `u_id` int(10) NOT NULL COMMENT '用户表id',
  `log_ip` char(15) NOT NULL COMMENT '登陆者ip',
  `up_date` int(10) NOT NULL DEFAULT '0' COMMENT '登陆时间',
  PRIMARY KEY (`id`),
  KEY `u_id` (`u_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户登陆信息表' AUTO_INCREMENT=152 ;

--
-- 转存表中的数据 `aodi_log`
--

INSERT INTO `aodi_log` (`id`, `log_name`, `u_id`, `log_ip`, `up_date`) VALUES
(1, '王', 0, '127.0.0.1', 1483160532),
(2, '李', 0, '192.168.1.205', 1483160676),
(3, '王', 0, '127.0.0.1', 1483160854),
(4, '王', 0, '127.0.0.1', 1483160875),
(5, '李', 0, '127.0.0.1', 1483160943),
(6, '李', 2, '127.0.0.1', 1483161762),
(7, '李', 2, '127.0.0.1', 1483162288),
(8, '李', 2, '127.0.0.1', 1483164915),
(9, '李', 2, '127.0.0.1', 1483164974),
(10, '李', 2, '127.0.0.1', 1483169310),
(11, '李', 2, '127.0.0.1', 1483173155),
(12, '李', 2, '127.0.0.1', 1483332881),
(13, '李', 2, '127.0.0.1', 1483336862),
(14, '李', 2, '127.0.0.1', 1483338701),
(15, '李', 2, '127.0.0.1', 1483343227),
(16, '李', 2, '127.0.0.1', 1483491490),
(17, '李', 2, '127.0.0.1', 1483495340),
(18, '李', 2, '127.0.0.1', 1483500372),
(19, '李', 2, '127.0.0.1', 1483516206),
(20, '李', 2, '127.0.0.1', 1483689712),
(21, '李', 2, '127.0.0.1', 1484100724),
(22, '李', 2, '127.0.0.1', 1484728399),
(23, '李', 2, '127.0.0.1', 1484876316),
(24, '李', 2, '127.0.0.1', 1484880057),
(25, '李', 2, '127.0.0.1', 1484885493),
(26, '李', 2, '127.0.0.1', 1484889233),
(27, '李', 2, '127.0.0.1', 1484892862),
(28, '李', 2, '127.0.0.1', 1484896242),
(29, '王是是是', 6, '127.0.0.1', 1484896278),
(30, '李', 2, '127.0.0.1', 1484896299),
(31, '李', 2, '127.0.0.1', 1484901029),
(32, '李', 2, '127.0.0.1', 1484971675),
(33, '李', 2, '127.0.0.1', 1484975122),
(34, '李', 2, '127.0.0.1', 1484979541),
(35, '李', 2, '127.0.0.1', 1484984160),
(36, '李', 2, '127.0.0.1', 1485133255),
(37, '李', 2, '127.0.0.1', 1485137997),
(38, '李', 2, '127.0.0.1', 1485144685),
(39, '李', 2, '127.0.0.1', 1485149326),
(40, '李', 2, '127.0.0.1', 1485153594),
(41, '李', 2, '127.0.0.1', 1485157242),
(42, '李', 2, '127.0.0.1', 1485157766),
(43, '李', 2, '127.0.0.1', 1485157844),
(44, '李', 2, '127.0.0.1', 1485219518),
(45, '李', 2, '127.0.0.1', 1485222867),
(46, '李', 2, '127.0.0.1', 1485226484),
(47, '李', 2, '127.0.0.1', 1485230695),
(48, '李', 2, '127.0.0.1', 1485234687),
(49, '李', 2, '127.0.0.1', 1485238382),
(50, '李', 2, '127.0.0.1', 1485239607),
(51, '李', 2, '127.0.0.1', 1485243380),
(52, '李', 2, '127.0.0.1', 1485247170),
(53, '李', 2, '127.0.0.1', 1486166765),
(54, '李', 2, '127.0.0.1', 1486171033),
(55, '李', 2, '127.0.0.1', 1486172529),
(56, '李', 2, '127.0.0.1', 1486172557),
(57, '李', 2, '127.0.0.1', 1486176533),
(58, '李', 2, '127.0.0.1', 1486180802),
(59, '李', 2, '127.0.0.1', 1486184624),
(60, '李', 2, '127.0.0.1', 1486188680),
(61, '李', 2, '127.0.0.1', 1486192524),
(62, '李', 2, '127.0.0.1', 1486196157),
(63, '李', 2, '127.0.0.1', 1486252987),
(64, '李', 2, '127.0.0.1', 1486256627),
(65, '李', 2, '127.0.0.1', 1486260393),
(66, '李', 2, '127.0.0.1', 1486264186),
(67, '李', 2, '127.0.0.1', 1486267845),
(68, '李', 2, '127.0.0.1', 1486269427),
(69, '李', 2, '127.0.0.1', 1486273053),
(70, '李', 2, '127.0.0.1', 1486274397),
(71, '李', 2, '127.0.0.1', 1486274416),
(72, '李', 2, '127.0.0.1', 1486278393),
(73, '李', 2, '127.0.0.1', 1486284935),
(74, '李', 2, '127.0.0.1', 1486356460),
(75, '李', 2, '127.0.0.1', 1486356492),
(76, '李', 2, '127.0.0.1', 1486362267),
(77, '李', 2, '127.0.0.1', 1486367115),
(78, '李', 2, '127.0.0.1', 1486370780),
(79, '李', 2, '127.0.0.1', 1486374451),
(80, '李', 2, '127.0.0.1', 1486433070),
(81, '李', 2, '127.0.0.1', 1486440086),
(82, '李', 2, '127.0.0.1', 1486444734),
(83, '李', 2, '127.0.0.1', 1486448520),
(84, '李', 2, '127.0.0.1', 1486452166),
(85, '王', 1, '127.0.0.1', 1486460936),
(86, '王', 1, '127.0.0.1', 1486465363),
(87, '王', 1, '127.0.0.1', 1486469504),
(88, '王', 1, '127.0.0.1', 1486473263),
(89, '王', 1, '127.0.0.1', 1486477315),
(90, '王', 1, '127.0.0.1', 1486553102),
(91, '王', 1, '127.0.0.1', 1486557219),
(92, '王', 1, '127.0.0.1', 1486639462),
(93, '王', 1, '127.0.0.1', 1486643511),
(94, '王', 1, '127.0.0.1', 1486647259),
(95, '李', 2, '127.0.0.1', 1486796947),
(96, '李', 2, '127.0.0.1', 1486950033),
(97, '李', 2, '127.0.0.1', 1486954280),
(98, '李', 2, '127.0.0.1', 1486959843),
(99, '李', 2, '127.0.0.1', 1486960649),
(100, '李', 2, '127.0.0.1', 1486960669),
(101, '李', 2, '127.0.0.1', 1486964356),
(102, '李', 2, '127.0.0.1', 1486967972),
(103, '李', 2, '127.0.0.1', 1486977548),
(104, '李', 2, '127.0.0.1', 1487052469),
(105, '李', 2, '127.0.0.1', 1487128962),
(106, '李', 2, '127.0.0.1', 1487137995),
(107, '李', 2, '127.0.0.1', 1487146707),
(108, '李', 2, '127.0.0.1', 1487212314),
(109, '李', 2, '127.0.0.1', 1487658085),
(110, '李', 2, '127.0.0.1', 1489383076),
(111, '李', 2, '127.0.0.1', 1489459423),
(112, '李', 2, '127.0.0.1', 1489466163),
(113, '王', 1, '127.0.0.1', 1489727103),
(114, '王', 1, '127.0.0.1', 1489727798),
(115, '王', 1, '127.0.0.1', 1489812729),
(116, '王', 1, '127.0.0.1', 1489821845),
(117, '王', 1, '127.0.0.1', 1490675608),
(118, '王', 1, '127.0.0.1', 1490679268),
(119, '王', 1, '127.0.0.1', 1490683268),
(120, '王', 1, '127.0.0.1', 1490761223),
(121, '王', 1, '127.0.0.1', 1490770339),
(122, '王', 1, '127.0.0.1', 1490776789),
(123, '王', 1, '127.0.0.1', 1491293627),
(124, '王', 1, '127.0.0.1', 1492847526),
(125, '王', 1, '127.0.0.1', 1493429906),
(126, '王', 1, '127.0.0.1', 1494461584),
(127, '王', 1, '127.0.0.1', 1494577643),
(128, '王', 1, '127.0.0.1', 1495000942),
(129, '王', 1, '127.0.0.1', 1495001762),
(130, '王', 1, '127.0.0.1', 1495001844),
(131, '王', 1, '127.0.0.1', 1495005533),
(132, '王', 1, '127.0.0.1', 1495011218),
(133, '王', 1, '127.0.0.1', 1495074114),
(134, '王', 1, '127.0.0.1', 1495074782),
(135, '王', 1, '127.0.0.1', 1495081828),
(136, '王', 1, '127.0.0.1', 1495095395),
(137, '王', 1, '127.0.0.1', 1497235595),
(138, '王', 1, '127.0.0.1', 1497256380),
(139, '王', 1, '127.0.0.1', 1497400082),
(140, '王', 1, '127.0.0.1', 1497594153),
(141, '王', 1, '127.0.0.1', 1497595776),
(142, '王', 1, '127.0.0.1', 1498548737),
(143, '王', 1, '127.0.0.1', 1498549015),
(144, '王', 1, '127.0.0.1', 1498552628),
(145, '王', 1, '127.0.0.1', 1500102415),
(146, '王', 1, '127.0.0.1', 1500107100),
(147, '王', 1, '127.0.0.1', 1504596606),
(148, '王', 1, '127.0.0.1', 1504681202),
(149, '王22', 11, '127.0.0.1', 1504681772),
(150, '王', 1, '127.0.0.1', 1504689523),
(151, '王', 1, '127.0.0.1', 1504775591);

-- --------------------------------------------------------

--
-- 表的结构 `aodi_machine`
--

CREATE TABLE IF NOT EXISTS `aodi_machine` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `machine_name` varchar(50) NOT NULL COMMENT '机器名称',
  `print_color` tinyint(3) NOT NULL DEFAULT '1' COMMENT '几色',
  `u_id` int(10) NOT NULL COMMENT '添加者id',
  `company_id` int(10) NOT NULL COMMENT '所属公司id',
  `up_date` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `company_id` (`company_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='生产机器表' AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `aodi_machine`
--

INSERT INTO `aodi_machine` (`id`, `machine_name`, `print_color`, `u_id`, `company_id`, `up_date`) VALUES
(1, '单A', 1, 2, 2, 454546345),
(2, '单B', 1, 2, 2, 1222222222),
(3, '双色机', 2, 2, 2, 1233322525),
(4, '三色机', 3, 2, 2, 4564656),
(5, '四色机', 4, 2, 2, 45646585);

-- --------------------------------------------------------

--
-- 表的结构 `aodi_notlog`
--

CREATE TABLE IF NOT EXISTS `aodi_notlog` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `log_ip` char(15) NOT NULL COMMENT '登陆者id',
  `up_date` int(10) NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `log_ip` (`log_ip`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='禁用的用户表' AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `aodi_notlog`
--

INSERT INTO `aodi_notlog` (`id`, `log_ip`, `up_date`) VALUES
(3, '192.168.1.25', 1483169505),
(4, '127.0.0.10', 1483169549),
(5, '192.168.70.3', 1483170691);

-- --------------------------------------------------------

--
-- 表的结构 `aodi_orderone`
--

CREATE TABLE IF NOT EXISTS `aodi_orderone` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `customer_id` int(10) unsigned NOT NULL COMMENT '客户id',
  `customer_name` varchar(50) NOT NULL COMMENT '客户名称',
  `company_id` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '公司id （1是总部）',
  `mant_num` varchar(50) NOT NULL COMMENT '管理号',
  `job_num` varchar(20) NOT NULL COMMENT '工单号',
  `order_urgent` enum('0','1') NOT NULL DEFAULT '0' COMMENT '加急与否（0不加急）',
  `order_state` enum('0','1') NOT NULL DEFAULT '1' COMMENT '取消与否',
  `order_num` int(10) unsigned NOT NULL COMMENT '订单数量',
  `order_price` decimal(8,3) unsigned NOT NULL COMMENT '订单单个纸箱价格',
  `order_otherprice` decimal(8,3) unsigned NOT NULL DEFAULT '0.000' COMMENT '版费+模具费',
  `is_paper` enum('0','1') NOT NULL DEFAULT '0' COMMENT '是否是用统板，0不是',
  `up_uid` int(10) unsigned NOT NULL COMMENT '修改者id',
  `del_date` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '送货日期',
  PRIMARY KEY (`id`),
  KEY `mant_num` (`mant_num`),
  KEY `job_num` (`job_num`),
  KEY `del_date` (`del_date`),
  KEY `customer_name` (`customer_name`),
  KEY `company_id` (`company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='订单信息表' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `aodi_orderone`
--

INSERT INTO `aodi_orderone` (`id`, `customer_id`, `customer_name`, `company_id`, `mant_num`, `job_num`, `order_urgent`, `order_state`, `order_num`, `order_price`, `order_otherprice`, `is_paper`, `up_uid`, `del_date`) VALUES
(1, 2, '宏宇', 2, 'D43-226-550', '22222222222222222', '1', '1', 300, '10.000', '500.000', '0', 0, 455545455),
(2, 2, '宏宇', 2, 'D43-88', '1232353236121408', '0', '1', 100, '10.000', '560.000', '0', 0, 2121335454);

-- --------------------------------------------------------

--
-- 表的结构 `aodi_ordertwo`
--

CREATE TABLE IF NOT EXISTS `aodi_ordertwo` (
  `orderone_id` int(10) unsigned NOT NULL COMMENT '订单表一id',
  `order_product` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '是否已加入排程0没加入，1已加入，2其他',
  `paper_oder` enum('0','1','3') NOT NULL DEFAULT '0' COMMENT '纸板是否已订购，0没订购',
  `shg_name` varchar(100) NOT NULL COMMENT '品名',
  `today_price` decimal(6,3) NOT NULL DEFAULT '0.000' COMMENT '实时1平方价格',
  `box_long` smallint(5) unsigned NOT NULL COMMENT '纸箱长',
  `box_width` smallint(5) NOT NULL COMMENT '纸箱宽',
  `box_height` smallint(5) unsigned NOT NULL COMMENT '箱高',
  `paper_property` varchar(50) NOT NULL COMMENT '材质',
  `box_prop` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '0是普通箱，1上公差',
  `box_volume` decimal(5,3) NOT NULL DEFAULT '0.000' COMMENT '纸箱成形单个体积㎥',
  `order_map` enum('0','1') CHARACTER SET armscii8 NOT NULL DEFAULT '0' COMMENT '是否需要制图（0不需要）',
  `map_color` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '几色印刷',
  `in_uid` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '添加者id',
  `up_date` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`orderone_id`),
  KEY `shg_name` (`shg_name`),
  KEY `up_date` (`up_date`),
  KEY `orderone_id` (`orderone_id`),
  KEY `order_map` (`order_map`),
  KEY `order_product` (`order_product`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单表2';

--
-- 转存表中的数据 `aodi_ordertwo`
--

INSERT INTO `aodi_ordertwo` (`orderone_id`, `order_product`, `paper_oder`, `shg_name`, `today_price`, `box_long`, `box_width`, `box_height`, `paper_property`, `box_prop`, `box_volume`, `order_map`, `map_color`, `in_uid`, `up_date`) VALUES
(1, '0', '0', '50ml注射器', '0.000', 650, 380, 450, 'Ntf313', '0', '0.000', '0', 1, 1, 1245637891),
(2, '0', '0', '针头', '3.000', 580, 480, 380, 'ntf321', '0', '0.000', '0', 4, 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `aodi_paper`
--

CREATE TABLE IF NOT EXISTS `aodi_paper` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `sup_id` int(10) unsigned NOT NULL COMMENT '工厂id',
  `paper_property` varchar(50) NOT NULL COMMENT '纸板材质名称',
  `gram_weight` smallint(4) unsigned NOT NULL DEFAULT '0' COMMENT '克重（g/㎡）',
  `paper_name` varchar(50) NOT NULL COMMENT '纸板瓦楞类型',
  `paper_price` decimal(8,3) unsigned NOT NULL COMMENT '纸板价格（㎡/元）',
  `paper_state` enum('0','1','2') NOT NULL DEFAULT '1' COMMENT '1存在，0不存在',
  `up_date` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `paper_name` (`paper_property`),
  KEY `sup_id` (`sup_id`),
  KEY `paper_property` (`paper_property`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='纸板价格表' AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `aodi_paper`
--

INSERT INTO `aodi_paper` (`id`, `sup_id`, `paper_property`, `gram_weight`, `paper_name`, `paper_price`, `paper_state`, `up_date`) VALUES
(1, 1, 'N3N5Q', 620, 'AB', '4.120', '1', 1498550340),
(2, 2, 'N3Q3N', 600, 'AB', '3.200', '1', 1486980881),
(3, 2, 'F3N1T4Q', 1000, 'ABC', '8.350', '1', 1498550490),
(4, 1, 'N3N5T', 580, 'AB', '4.100', '1', 1498550441),
(5, 1, 'N3N5W', 610, 'AB', '3.200', '1', 1498550422),
(6, 1, 'N5T3T', 580, 'AB', '5.200', '1', 0),
(7, 2, 'N3N5T', 580, 'AB', '4.850', '1', 0),
(8, 3, 'N3N5T', 580, 'AB', '4.250', '1', 1498549832),
(9, 4, 'N3N5T', 580, 'AB', '4.650', '1', 1486195324),
(10, 5, 'N3N5T', 580, 'AB', '5.320', '1', 1486195348),
(11, 3, 'N3N5W', 610, 'AB', '4.560', '1', 1486195450),
(12, 1, 'N315Q', 610, 'AB', '4.250', '1', 1498550189);

--
-- 触发器 `aodi_paper`
--
DROP TRIGGER IF EXISTS `paper_state`;
DELIMITER //
CREATE TRIGGER `paper_state` AFTER UPDATE ON `aodi_paper`
 FOR EACH ROW begin  
if new.paper_state!=old.paper_state then  
update aodi_cuspaper set aodi_cuspaper.cuspa_state=new.paper_state where aodi_cuspaper.paper_id=old.id;  
end if;  
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- 表的结构 `aodi_payment`
--

CREATE TABLE IF NOT EXISTS `aodi_payment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) unsigned NOT NULL COMMENT '客户表id',
  `payment` decimal(12,3) NOT NULL DEFAULT '0.000' COMMENT '付款金额',
  `payment_method` enum('1','2','3') NOT NULL DEFAULT '1' COMMENT '支付方式:1汇款，2现金，3其他',
  `in_uid` int(10) unsigned NOT NULL COMMENT '添加者id',
  `up_uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '修改者id',
  `u_date` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COMMENT='客户付款表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `aodi_produce`
--

CREATE TABLE IF NOT EXISTS `aodi_produce` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `orderone_id` int(10) unsigned NOT NULL COMMENT '订单表一id',
  `customer_id` int(10) unsigned NOT NULL COMMENT '客户id',
  `u_id` int(10) unsigned NOT NULL COMMENT '添加排程者id',
  `map_color` tinyint(3) unsigned NOT NULL COMMENT '几色印刷',
  `machine_id` tinyint(3) NOT NULL COMMENT '机器id',
  `is_produce` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '机台是否已生产',
  `paper_yes` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '纸板到与否',
  `up_date` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `orderone_id` (`orderone_id`),
  KEY `customer_id` (`customer_id`),
  KEY `is_produce` (`is_produce`),
  KEY `up_date` (`up_date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `aodi_purchaseone`
--

CREATE TABLE IF NOT EXISTS `aodi_purchaseone` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `paper_long` smallint(5) unsigned NOT NULL COMMENT '纸板长',
  `paper_width` smallint(5) unsigned NOT NULL COMMENT '纸板宽',
  `paper_num` int(10) unsigned NOT NULL COMMENT '数量',
  `paper_supid` int(10) unsigned NOT NULL COMMENT '纸板厂id',
  `paper_property` varchar(50) NOT NULL COMMENT '纸板材质',
  `paper_price` decimal(8,3) NOT NULL COMMENT '单个纸板价格',
  `paper_allprice` decimal(13,3) NOT NULL COMMENT '纸板总价',
  `is_paperline` enum('0','1','2') NOT NULL DEFAULT '1' COMMENT '纸板是否有压线',
  `paper_online` smallint(5) NOT NULL DEFAULT '0' COMMENT '上压线宽',
  `paper_downline` smallint(5) NOT NULL DEFAULT '0' COMMENT '下压线宽',
  `purchase_state` enum('0','1','2') NOT NULL DEFAULT '1' COMMENT '是否是取消的订单',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='纸板订购表1' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `aodi_purchasetwo`
--

CREATE TABLE IF NOT EXISTS `aodi_purchasetwo` (
  `purone_id` int(10) unsigned NOT NULL COMMENT '采购表1id',
  `paper_urgent` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '是否加急',
  `u_id` int(10) NOT NULL COMMENT '添加者id',
  `job_num` varchar(20) NOT NULL COMMENT '工单号',
  `other_paper` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '是否是统板',
  `company_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '公司id',
  `up_date` int(10) unsigned NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`purone_id`),
  UNIQUE KEY `job_num` (`job_num`),
  KEY `up_date` (`up_date`),
  KEY `paper_urgent` (`paper_urgent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `aodi_qxian`
--

CREATE TABLE IF NOT EXISTS `aodi_qxian` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `qx_name` varchar(50) NOT NULL COMMENT '权限名称',
  `p_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '父id',
  `action` varchar(50) NOT NULL COMMENT '动作（方法）',
  `group_id` set('1','2','3','4','5','6','7','8','9','10') NOT NULL DEFAULT '1' COMMENT 'group表id',
  `state` enum('0','1','2') NOT NULL DEFAULT '1' COMMENT '状态标记0不显示，1显示',
  `u_id` int(10) NOT NULL DEFAULT '1' COMMENT '用户id',
  `up_date` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加日期',
  PRIMARY KEY (`id`),
  UNIQUE KEY `action` (`action`),
  KEY `p_id` (`p_id`),
  KEY `group_id` (`group_id`),
  KEY `state` (`state`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='权限表' AUTO_INCREMENT=43 ;

--
-- 转存表中的数据 `aodi_qxian`
--

INSERT INTO `aodi_qxian` (`id`, `qx_name`, `p_id`, `action`, `group_id`, `state`, `u_id`, `up_date`) VALUES
(1, '权限管理', 0, 'Home/Qxian/index/', '1', '1', 1, 0),
(2, '登陆信息', 0, 'Home/Log/index/', '1,2,3,5', '1', 1, 0),
(3, '客户管理', 0, 'Home/Customer/index/', '1,2,3,4,5,6,7', '1', 1, 0),
(4, '管理员', 0, 'Home/User/index/', '1', '1', 1, 0),
(5, '供应商管理', 0, 'Home/Supplier/index/', '1,3,5', '1', 1, 0),
(6, '纸板管理', 0, 'Home/Paper/index/', '1', '1', 1, 0),
(7, '订单管理', 0, 'Home/Order/index/', '1,2,3,4,5,6', '1', 1, 0),
(8, '客诉管理', 0, 'Home/Kesu/index/', '1', '1', 1, 0),
(9, '生产管理', 0, 'Home/Produce/index/', '3,4,7', '1', 1, 0),
(10, '制图管理', 0, 'Home/Artwork/index/', '1', '1', 1, 0),
(11, '仓库管理', 0, 'Home/Store/index/', '1,2,3,4,5,6,7,8,9', '1', 1, 0),
(12, '纸板采购管理', 0, 'Home/Purchase/index/', '1', '1', 1, 0),
(13, '账目管理', 0, 'Home/Money/index/', '1', '1', 1, 0),
(14, '添加用户', 4, 'Home/User/uadd/', '1', '1', 1, 0),
(15, '添加控制器', 1, 'Home/Qxian/qxadd/', '1', '1', 2, 1483171373),
(22, '禁用ip地址', 2, 'Home/Log/addLog/', '1', '1', 2, 1483163784),
(23, '修改组权限', 1, 'Home/Qxian/modify/', '1', '1', 2, 1483338085),
(24, '修改用户', 4, 'Home/User/uedit/', '1', '1', 2, 1484897318),
(25, '添加客户', 3, 'Home/Customer/addCus/', '1', '1', 2, 1483339029),
(26, '修改控制器', 1, 'Home/Qxian/qxedit/', '1', '1', 2, 1484880224),
(27, '添加禁用ip地址', 2, 'Home/Log/logedit/', '1', '1', 2, 1484887984),
(28, '修改客户', 3, 'Home/Customer/editCus/', '1', '1', 2, 1484893884),
(29, '删除用户', 4, 'Home/User/udel/', '1', '0', 2, 1484898819),
(30, '添加供应商', 5, 'Home/Supplier/addsup/', '1', '1', 2, 1485138344),
(31, '修改供应商', 5, 'Home/Supplier/editsup/', '1', '0', 2, 1485153939),
(33, '修改信用额', 3, 'Home/Customer/addcit/', '1', '1', 1, 1498548988),
(34, '添加纸板', 6, 'Home/Paper/addPaper/', '1', '1', 2, 1486171363),
(35, '修改纸板', 6, 'Home/Paper/editPaper/', '1', '0', 2, 1486172365),
(36, '搜索纸板', 6, 'Home/Paper/schPaper/', '1', '0', 2, 1486254010),
(37, '添加订单', 7, 'Home/Order/addOrder/', '1', '1', 2, 1486362452),
(38, '修改订单', 7, 'Home/Order/editOrder/', '1', '0', 2, 1486362500),
(39, '搜索订单', 7, 'Home/Order/schOrder/', '1', '0', 2, 1486433149),
(40, '添加客户纸板', 3, 'Home/Customer/addCusPaper/', '1', '1', 2, 1486960752),
(41, '客户纸板', 3, 'Home/Customer/cusPaper/', '1', '1', 1, 1486640080),
(42, '添加客诉', 8, 'Home/Kesu/addKs/', '1', '1', 1, 1495001668);

-- --------------------------------------------------------

--
-- 表的结构 `aodi_storefuliao`
--

CREATE TABLE IF NOT EXISTS `aodi_storefuliao` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fl_name` varchar(5) NOT NULL COMMENT '辅料名称',
  `fl_position` varchar(50) NOT NULL COMMENT '存储位置',
  `fl_num` int(10) NOT NULL COMMENT '1个单位的数量',
  `fl_unit` varchar(10) NOT NULL COMMENT '单位',
  `fl_allnum` int(10) NOT NULL COMMENT '总数',
  `u_id` int(10) NOT NULL COMMENT '添加者id',
  `company_id` tinyint(3) NOT NULL COMMENT '公司名称',
  `up_date` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fl_name` (`fl_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='辅料表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `aodi_storeout`
--

CREATE TABLE IF NOT EXISTS `aodi_storeout` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `job_num` varchar(20) NOT NULL COMMENT '工单号',
  `box_long` smallint(5) unsigned NOT NULL COMMENT '长',
  `box_width` smallint(5) unsigned NOT NULL COMMENT '宽',
  `box_height` smallint(5) unsigned NOT NULL COMMENT '高',
  `customer_id` int(10) NOT NULL DEFAULT '0' COMMENT '客户表id',
  `order_oneprice` decimal(8,3) NOT NULL DEFAULT '0.000' COMMENT '订单单价',
  `order_allprice` decimal(12,3) NOT NULL DEFAULT '0.000' COMMENT '订单总价',
  `order_num` int(10) NOT NULL DEFAULT '0' COMMENT '订单总数',
  `out_oneprice` decimal(8,3) NOT NULL DEFAULT '0.000' COMMENT '外发纸箱单价',
  `out_num` int(10) NOT NULL COMMENT '外发订单数量',
  `out_allprice` decimal(12,3) NOT NULL DEFAULT '0.000' COMMENT '外发总价',
  `u_id` int(10) NOT NULL COMMENT '添加者id',
  `up_date` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `job_num` (`job_num`),
  KEY `up_date` (`up_date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='外发纸箱入库' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `aodi_storepaper`
--

CREATE TABLE IF NOT EXISTS `aodi_storepaper` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `purch_id` int(10) unsigned NOT NULL COMMENT '订购纸板id',
  `store_position` varchar(50) NOT NULL COMMENT '存放纸板位置',
  `store_num` mediumint(8) unsigned NOT NULL COMMENT '入库纸板数量',
  `u_id` int(10) NOT NULL COMMENT '添加者id',
  `up_date` int(10) NOT NULL DEFAULT '0' COMMENT '入库时间',
  PRIMARY KEY (`id`),
  KEY `purch_id` (`purch_id`),
  KEY `up_date` (`up_date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `aodi_storeshg`
--

CREATE TABLE IF NOT EXISTS `aodi_storeshg` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `produce_id` int(10) NOT NULL COMMENT '生产表id',
  `order_id` int(11) NOT NULL COMMENT '订单表id',
  `shg_position` varchar(50) NOT NULL COMMENT '入库位置',
  `u_id` int(10) NOT NULL COMMENT '添加者id',
  `shg_num` mediumint(8) unsigned NOT NULL COMMENT '成品数量',
  `is_out` enum('0','1','2','3') NOT NULL DEFAULT '0' COMMENT '是否已出库，0没出库，1出库',
  `up_date` int(10) NOT NULL DEFAULT '0' COMMENT '入库时间',
  PRIMARY KEY (`id`),
  KEY `up_date` (`up_date`),
  KEY `order_id` (`order_id`),
  KEY `produce_id` (`produce_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='成品表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `aodi_supplier`
--

CREATE TABLE IF NOT EXISTS `aodi_supplier` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sup_name` varchar(50) NOT NULL COMMENT '供应商名称',
  `sup_adress` varchar(100) NOT NULL COMMENT '供应商地址',
  `sup_des` varchar(100) NOT NULL DEFAULT '0' COMMENT '供应商描述',
  `sup_state` enum('0','1','2') NOT NULL DEFAULT '1' COMMENT '供应商状态',
  `u_id` int(10) NOT NULL DEFAULT '0' COMMENT '添加者id',
  `up_date` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `sup_name` (`sup_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='供应商表' AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `aodi_supplier`
--

INSERT INTO `aodi_supplier` (`id`, `sup_name`, `sup_adress`, `sup_des`, `sup_state`, `u_id`, `up_date`) VALUES
(1, '大群', '合肥', 'good', '1', 0, 0),
(2, '龙发', '安徽省', '...330...', '1', 1, 1498554837),
(3, '隆昌', '安庆市怀宁县', '........', '1', 1, 1498554870),
(4, '奥迪', '安庆市', '......', '0', 1, 1498554817),
(5, '大龙', '安徽安庆市', '宜秀区xx路', '1', 2, 1485159890);

-- --------------------------------------------------------

--
-- 表的结构 `aodi_user`
--

CREATE TABLE IF NOT EXISTS `aodi_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `u_name` varchar(50) NOT NULL COMMENT '用户名',
  `u_passward` varchar(100) NOT NULL COMMENT '密码',
  `full_name` varchar(50) NOT NULL COMMENT '名称',
  `group_id` int(10) NOT NULL COMMENT '组id',
  `company_id` int(10) unsigned NOT NULL COMMENT '所属公司id',
  `user_state` enum('0','1') NOT NULL DEFAULT '1' COMMENT '用户状态',
  `u_id` int(10) NOT NULL DEFAULT '1' COMMENT '添加者id',
  `up_date` int(50) DEFAULT '0' COMMENT '创建日期',
  PRIMARY KEY (`id`),
  KEY `company_id` (`company_id`),
  KEY `u_name` (`u_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COMMENT='用户表' AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `aodi_user`
--

INSERT INTO `aodi_user` (`id`, `u_name`, `u_passward`, `full_name`, `group_id`, `company_id`, `user_state`, `u_id`, `up_date`) VALUES
(1, 'ww1985', '6dcb51872b685a3b2a75746ae986187d', '王', 1, 1, '1', 2, 1483067239),
(2, 'qq1985', '6dcb51872b685a3b2a75746ae986187d', '李', 2, 2, '1', 2, 1484877903),
(3, 'sss123', '6dcb51872b685a3b2a75746ae986187d', '方', 5, 2, '1', 2, 1484895626),
(4, 'fddfd', '6dcb51872b685a3b2a75746ae986187d', '周一', 7, 2, '1', 2, 1484901730),
(11, '王先生', '6dcb51872b685a3b2a75746ae986187d', '王22', 1, 3, '1', 1, 1504681743);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
