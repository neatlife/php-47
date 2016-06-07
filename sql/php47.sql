-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-06-07 08:34:13
-- 服务器版本： 5.7.9
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php47`
--

-- --------------------------------------------------------

--
-- 表的结构 `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL DEFAULT '0',
  `author_id` int(11) NOT NULL,
  `title` varchar(25) NOT NULL,
  `published_date` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `content` text,
  `top` tinyint(4) NOT NULL DEFAULT '2',
  `read` int(11) NOT NULL DEFAULT '0',
  `praise` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `article`
--

INSERT INTO `article` (`id`, `category_id`, `author_id`, `title`, `published_date`, `status`, `content`, `top`, `read`, `praise`) VALUES
(1, 2, 2, 'php是世界上最好的语言', 1464766075, 1, '<p>今天天气很好</p>\r\n', 1, 0, 0),
(2, 3, 2, 'javascript从入门到放弃', 1448008399, 2, '<p>1.。。。</p>\r\n', 2, 0, 0),
(3, 4, 1, '数据库从入门到跑路', 1448008399, 2, '<p>1.mysql</p>\r\n\r\n<p>2.....</p>\r\n', 2, 0, 0),
(4, 2, 2, '1', 1448008399, 2, '<p>1</p>\r\n', 2, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sort` int(11) NOT NULL DEFAULT '0',
  `name` varchar(10) NOT NULL,
  `nickname` varchar(30) NOT NULL DEFAULT '',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `category`
--

INSERT INTO `category` (`id`, `sort`, `name`, `nickname`, `parent_id`) VALUES
(1, 50, '科技', '', 0),
(2, 50, '武侠', '', 0),
(3, 50, '旅游', '', 0),
(4, 50, '美食', '', 0),
(5, 50, 'IT', '', 1),
(6, 50, '生物', '', 1),
(7, 50, '鸟类', '', 6),
(8, 50, '湘菜', '', 4),
(9, 50, '粤菜', '', 4),
(10, 50, '川菜', '', 4),
(11, 50, '跳跳蛙', '', 8),
(12, 50, '口味虾', '', 8),
(13, 50, '臭豆腐', '', 8),
(14, 50, '白切鸡', '', 9),
(15, 50, '隆江猪脚', '', 9);

-- --------------------------------------------------------

--
-- 表的结构 `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `content` varchar(500) NOT NULL,
  `publish_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `comment`
--

INSERT INTO `comment` (`id`, `user_id`, `article_id`, `parent_id`, `content`, `publish_time`) VALUES
(1, 1, 1, 0, '么么哒', 1464936963),
(2, 3, 2, 1, '么么哒2', 1464936963),
(3, 2, 3, 0, '么么哒3', 1464936963),
(4, 1, 1, 0, '么么哒4', 1464936963),
(5, 2, 1, 0, '么么哒5', 1464936963);

-- --------------------------------------------------------

--
-- 表的结构 `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `pro_id` int(11) NOT NULL AUTO_INCREMENT,
  `pro_name` varchar(100) NOT NULL,
  `protype_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `pinpai` varchar(25) NOT NULL,
  `chandi` varchar(25) NOT NULL,
  PRIMARY KEY (`pro_id`),
  KEY `pro_name` (`pro_name`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COMMENT='商品信息表';

--
-- 转存表中的数据 `product`
--

INSERT INTO `product` (`pro_id`, `pro_name`, `protype_id`, `price`, `pinpai`, `chandi`) VALUES
(3, '海信（Hisense）55英寸智能电视', 1, '4199.00', '海信', '青岛'),
(4, '联想（Lenovo）14.0英寸笔记本电脑', 3, '5499.00', '联想', '北京'),
(5, '索尼（SONY）13.3英寸触控超极本', 3, '11499.00', '索尼', '天津'),
(11, '索尼（SONY）60英寸全高清液晶电视', 1, '6999.00', '索尼', '北京'),
(12, '联想（Lenovo）14.0英寸笔记本电脑', 3, '2999.00', '联想', '北京'),
(17, '索尼z5 premium', 1, '5699.00', '索尼', '日本'),
(18, '小埋抱枕', 1, '39.00', '无', '广州'),
(19, '戴尔xps', 15, '6999.00', '戴尔', '美国'),
(20, 'surface book pro', 13, '12999.00', '微软', '美国'),
(21, 'iphone se', 4, '3299.00', '苹果', '美国'),
(23, '2', 30, '2.00', '2', '2');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(16) NOT NULL,
  `nickname` varchar(16) DEFAULT '',
  `email` varchar(1000) NOT NULL,
  `created_at` int(11) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `username`, `nickname`, `email`, `created_at`, `password`) VALUES
(1, '张飞', '翼德', 'zf@qq.com', 1464506918, '101a6ec9f938885df0a44f20458d2eb4'),
(2, '刘大大', '玄德', '666@qq.com', 1464510636, '101a6ec9f938885df0a44f20458d2eb4'),
(4, '2', '1', 'var img = new Image(); img.src=', 1464666878, '101a6ec9f938885df0a44f20458d2eb4');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
