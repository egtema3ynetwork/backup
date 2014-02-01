-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 01, 2014 at 10:07 PM
-- Server version: 5.5.34-0ubuntu0.12.04.1
-- PHP Version: 5.3.10-1ubuntu3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `youtube`
--

-- --------------------------------------------------------

--
-- Table structure for table `youtubefeed`
--

CREATE TABLE IF NOT EXISTS `youtubefeed` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `channelname` varchar(50) NOT NULL,
  `channelimageurl` varchar(200) NOT NULL,
  `videoid` varchar(50) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `title` varchar(200) NOT NULL,
  `description` varchar(500) NOT NULL,
  `imageurl` varchar(200) NOT NULL,
  `publicview` tinyint(1) NOT NULL,
  `tags` tinyint(2) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17152 ;

-- --------------------------------------------------------

--
-- Table structure for table `youtubefeed0`
--

CREATE TABLE IF NOT EXISTS `youtubefeed0` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `channelname` varchar(50) NOT NULL,
  `channelimageurl` varchar(200) NOT NULL,
  `videoid` varchar(50) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `title` varchar(200) NOT NULL,
  `description` varchar(500) NOT NULL,
  `imageurl` varchar(200) NOT NULL,
  `publicview` tinyint(1) NOT NULL,
  `tags` tinyint(2) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Triggers `youtubefeed0`
--
DROP TRIGGER IF EXISTS `addyoutubefeed0`;
DELIMITER //
CREATE TRIGGER `addyoutubefeed0` AFTER INSERT ON `youtubefeed0`
 FOR EACH ROW insert into youtubefeed SELECT 
null, new.`channelname`, 
new.`channelimageurl`, new.`videoid`,
new.`time`, new.`title`,
new.`description`, 
new.`imageurl`, new.`publicview`,
new.`tags`
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `youtubefeed1`
--

CREATE TABLE IF NOT EXISTS `youtubefeed1` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `channelname` varchar(50) NOT NULL,
  `channelimageurl` varchar(200) NOT NULL,
  `videoid` varchar(50) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `title` varchar(200) NOT NULL,
  `description` varchar(500) NOT NULL,
  `imageurl` varchar(200) NOT NULL,
  `publicview` tinyint(1) NOT NULL,
  `tags` tinyint(2) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1820 ;

--
-- Triggers `youtubefeed1`
--
DROP TRIGGER IF EXISTS `addyoutubefeed1`;
DELIMITER //
CREATE TRIGGER `addyoutubefeed1` AFTER INSERT ON `youtubefeed1`
 FOR EACH ROW insert into youtubefeed SELECT 
null, new.`channelname`, 
new.`channelimageurl`, new.`videoid`,
new.`time`, new.`title`,
new.`description`, 
new.`imageurl`, new.`publicview`,
new.`tags`
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `youtubefeed2`
--

CREATE TABLE IF NOT EXISTS `youtubefeed2` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `channelname` varchar(50) NOT NULL,
  `channelimageurl` varchar(200) NOT NULL,
  `videoid` varchar(50) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `title` varchar(200) NOT NULL,
  `description` varchar(500) NOT NULL,
  `imageurl` varchar(200) NOT NULL,
  `publicview` tinyint(1) NOT NULL,
  `tags` tinyint(2) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5547 ;

--
-- Triggers `youtubefeed2`
--
DROP TRIGGER IF EXISTS `addyoutubefeed2`;
DELIMITER //
CREATE TRIGGER `addyoutubefeed2` AFTER INSERT ON `youtubefeed2`
 FOR EACH ROW insert into youtubefeed SELECT 
null, new.`channelname`, 
new.`channelimageurl`, new.`videoid`,
new.`time`, new.`title`,
new.`description`, 
new.`imageurl`, new.`publicview`,
new.`tags`
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `youtubefeed3`
--

CREATE TABLE IF NOT EXISTS `youtubefeed3` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `channelname` varchar(50) NOT NULL,
  `channelimageurl` varchar(200) NOT NULL,
  `videoid` varchar(50) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `title` varchar(200) NOT NULL,
  `description` varchar(500) NOT NULL,
  `imageurl` varchar(200) NOT NULL,
  `publicview` tinyint(1) NOT NULL,
  `tags` tinyint(2) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=540 ;

--
-- Triggers `youtubefeed3`
--
DROP TRIGGER IF EXISTS `addyoutubefeed3`;
DELIMITER //
CREATE TRIGGER `addyoutubefeed3` AFTER INSERT ON `youtubefeed3`
 FOR EACH ROW insert into youtubefeed SELECT 
null, new.`channelname`, 
new.`channelimageurl`, new.`videoid`,
new.`time`, new.`title`,
new.`description`, 
new.`imageurl`, new.`publicview`,
new.`tags`
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `youtubefeed4`
--

CREATE TABLE IF NOT EXISTS `youtubefeed4` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `channelname` varchar(50) NOT NULL,
  `channelimageurl` varchar(200) NOT NULL,
  `videoid` varchar(50) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `title` varchar(200) NOT NULL,
  `description` varchar(500) NOT NULL,
  `imageurl` varchar(200) NOT NULL,
  `publicview` tinyint(1) NOT NULL,
  `tags` tinyint(2) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=481 ;

--
-- Triggers `youtubefeed4`
--
DROP TRIGGER IF EXISTS `addyoutubefeed4`;
DELIMITER //
CREATE TRIGGER `addyoutubefeed4` AFTER INSERT ON `youtubefeed4`
 FOR EACH ROW insert into youtubefeed SELECT 
null, new.`channelname`, 
new.`channelimageurl`, new.`videoid`,
new.`time`, new.`title`,
new.`description`, 
new.`imageurl`, new.`publicview`,
new.`tags`
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `youtubefeed5`
--

CREATE TABLE IF NOT EXISTS `youtubefeed5` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `channelname` varchar(50) NOT NULL,
  `channelimageurl` varchar(200) NOT NULL,
  `videoid` varchar(50) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `title` varchar(200) NOT NULL,
  `description` varchar(500) NOT NULL,
  `imageurl` varchar(200) NOT NULL,
  `publicview` tinyint(1) NOT NULL,
  `tags` tinyint(2) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8741 ;

--
-- Triggers `youtubefeed5`
--
DROP TRIGGER IF EXISTS `addyoutubefeed5`;
DELIMITER //
CREATE TRIGGER `addyoutubefeed5` AFTER INSERT ON `youtubefeed5`
 FOR EACH ROW insert into youtubefeed SELECT 
null, new.`channelname`, 
new.`channelimageurl`, new.`videoid`,
new.`time`, new.`title`,
new.`description`, 
new.`imageurl`, new.`publicview`,
new.`tags`
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `youtubefeed6`
--

CREATE TABLE IF NOT EXISTS `youtubefeed6` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `channelname` varchar(50) NOT NULL,
  `channelimageurl` varchar(200) NOT NULL,
  `videoid` varchar(50) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `title` varchar(200) NOT NULL,
  `description` varchar(500) NOT NULL,
  `imageurl` varchar(200) NOT NULL,
  `publicview` tinyint(1) NOT NULL,
  `tags` tinyint(2) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Triggers `youtubefeed6`
--
DROP TRIGGER IF EXISTS `addyoutubefeed6`;
DELIMITER //
CREATE TRIGGER `addyoutubefeed6` AFTER INSERT ON `youtubefeed6`
 FOR EACH ROW insert into youtubefeed SELECT 
null, new.`channelname`, 
new.`channelimageurl`, new.`videoid`,
new.`time`, new.`title`,
new.`description`, 
new.`imageurl`, new.`publicview`,
new.`tags`
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `youtubefeed7`
--

CREATE TABLE IF NOT EXISTS `youtubefeed7` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `channelname` varchar(50) NOT NULL,
  `channelimageurl` varchar(200) NOT NULL,
  `videoid` varchar(50) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `title` varchar(200) NOT NULL,
  `description` varchar(500) NOT NULL,
  `imageurl` varchar(200) NOT NULL,
  `publicview` tinyint(1) NOT NULL,
  `tags` tinyint(2) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Triggers `youtubefeed7`
--
DROP TRIGGER IF EXISTS `addyoutubefeed7`;
DELIMITER //
CREATE TRIGGER `addyoutubefeed7` AFTER INSERT ON `youtubefeed7`
 FOR EACH ROW insert into youtubefeed SELECT 
null, new.`channelname`, 
new.`channelimageurl`, new.`videoid`,
new.`time`, new.`title`,
new.`description`, 
new.`imageurl`, new.`publicview`,
new.`tags`
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `youtubefeed8`
--

CREATE TABLE IF NOT EXISTS `youtubefeed8` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `channelname` varchar(50) NOT NULL,
  `channelimageurl` varchar(200) NOT NULL,
  `videoid` varchar(50) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `title` varchar(200) NOT NULL,
  `description` varchar(500) NOT NULL,
  `imageurl` varchar(200) NOT NULL,
  `publicview` tinyint(1) NOT NULL,
  `tags` tinyint(2) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Triggers `youtubefeed8`
--
DROP TRIGGER IF EXISTS `addyoutubefeed8`;
DELIMITER //
CREATE TRIGGER `addyoutubefeed8` AFTER INSERT ON `youtubefeed8`
 FOR EACH ROW insert into youtubefeed SELECT 
null, new.`channelname`, 
new.`channelimageurl`, new.`videoid`,
new.`time`, new.`title`,
new.`description`, 
new.`imageurl`, new.`publicview`,
new.`tags`
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `youtubefeed9`
--

CREATE TABLE IF NOT EXISTS `youtubefeed9` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `channelname` varchar(50) NOT NULL,
  `channelimageurl` varchar(200) NOT NULL,
  `videoid` varchar(50) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `title` varchar(200) NOT NULL,
  `description` varchar(500) NOT NULL,
  `imageurl` varchar(200) NOT NULL,
  `publicview` tinyint(1) NOT NULL,
  `tags` tinyint(2) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Triggers `youtubefeed9`
--
DROP TRIGGER IF EXISTS `addyoutubefeed9`;
DELIMITER //
CREATE TRIGGER `addyoutubefeed9` AFTER INSERT ON `youtubefeed9`
 FOR EACH ROW insert into youtubefeed SELECT 
null, new.`channelname`, 
new.`channelimageurl`, new.`videoid`,
new.`time`, new.`title`,
new.`description`, 
new.`imageurl`, new.`publicview`,
new.`tags`
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `youtubefeed10`
--

CREATE TABLE IF NOT EXISTS `youtubefeed10` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `channelname` varchar(50) NOT NULL,
  `channelimageurl` varchar(200) NOT NULL,
  `videoid` varchar(50) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `title` varchar(200) NOT NULL,
  `description` varchar(500) NOT NULL,
  `imageurl` varchar(200) NOT NULL,
  `publicview` tinyint(1) NOT NULL,
  `tags` tinyint(2) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Triggers `youtubefeed10`
--
DROP TRIGGER IF EXISTS `addyoutubefeed10`;
DELIMITER //
CREATE TRIGGER `addyoutubefeed10` AFTER INSERT ON `youtubefeed10`
 FOR EACH ROW insert into youtubefeed SELECT 
null, new.`channelname`, 
new.`channelimageurl`, new.`videoid`,
new.`time`, new.`title`,
new.`description`, 
new.`imageurl`, new.`publicview`,
new.`tags`
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `youtubetags`
--

CREATE TABLE IF NOT EXISTS `youtubetags` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `tags` tinyint(2) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `youtubeuser`
--

CREATE TABLE IF NOT EXISTS `youtubeuser` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `channelname` varchar(50) NOT NULL,
  `youtubeimageurl` varchar(200) NOT NULL,
  `tags` tinyint(2) NOT NULL,
  `publicview` tinyint(1) NOT NULL,
  `autoupdate` tinyint(1) NOT NULL DEFAULT '1',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
