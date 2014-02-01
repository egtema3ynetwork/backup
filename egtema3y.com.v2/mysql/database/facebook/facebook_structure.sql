-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 01, 2014 at 10:04 PM
-- Server version: 5.5.34-0ubuntu0.12.04.1
-- PHP Version: 5.3.10-1ubuntu3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `facebook`
--

-- --------------------------------------------------------

--
-- Table structure for table `facebookfeed`
--

CREATE TABLE IF NOT EXISTS `facebookfeed` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `wallid` varchar(50) NOT NULL,
  `wallname` varchar(100) NOT NULL,
  `wallimageurl` varchar(200) NOT NULL,
  `postid` varchar(50) NOT NULL,
  `postmessage` varchar(4000) NOT NULL,
  `postmessage2` varchar(500) NOT NULL,
  `postlinkname` varchar(200) NOT NULL,
  `postlinkurl` varchar(200) NOT NULL,
  `postcaption` varchar(2000) NOT NULL,
  `postdescription` varchar(4000) NOT NULL,
  `postimage` varchar(200) NOT NULL,
  `tags` int(2) NOT NULL,
  `publicview` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `postid_2` (`postid`),
  KEY `time` (`time`),
  KEY `wallid` (`wallid`),
  KEY `time_2` (`time`),
  KEY `time_3` (`time`,`wallid`),
  KEY `postmessage` (`postmessage`(255)),
  KEY `publicview` (`publicview`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='all feeds from all servers' AUTO_INCREMENT=3940284 ;

-- --------------------------------------------------------

--
-- Table structure for table `facebookfeed0`
--

CREATE TABLE IF NOT EXISTS `facebookfeed0` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `wallid` varchar(50) NOT NULL,
  `wallname` varchar(100) NOT NULL,
  `wallimageurl` varchar(200) NOT NULL,
  `postid` varchar(50) NOT NULL,
  `postmessage` varchar(4000) NOT NULL,
  `postmessage2` varchar(500) NOT NULL,
  `postlinkname` varchar(200) NOT NULL,
  `postlinkurl` varchar(200) NOT NULL,
  `postcaption` varchar(2000) NOT NULL,
  `postdescription` varchar(4000) NOT NULL,
  `postimage` varchar(200) NOT NULL,
  `tags` int(2) DEFAULT NULL,
  `publicview` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `time` (`time`),
  KEY `wallid` (`wallid`),
  KEY `postid` (`postid`),
  KEY `time_2` (`time`),
  KEY `time_3` (`time`,`wallid`),
  KEY `postmessage` (`postmessage`(255)),
  KEY `publicview` (`publicview`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='all feeds from all servers' AUTO_INCREMENT=1 ;

--
-- Triggers `facebookfeed0`
--
DROP TRIGGER IF EXISTS `afteraddnewfeed0`;
DELIMITER //
CREATE TRIGGER `afteraddnewfeed0` AFTER INSERT ON `facebookfeed0`
 FOR EACH ROW INSERT INTO facebookfeed values( null, new.time, new.wallid, 
new.wallname, new.wallimageurl, new.postid,
new.postmessage, new.postmessage2, 
new.postlinkname, new.postlinkurl, 
new.postcaption, new.postdescription,
new.postimage,new.tags,new.publicview)
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `facebookfeed1`
--

CREATE TABLE IF NOT EXISTS `facebookfeed1` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `wallid` varchar(50) NOT NULL,
  `wallname` varchar(100) NOT NULL,
  `wallimageurl` varchar(200) NOT NULL,
  `postid` varchar(50) NOT NULL,
  `postmessage` varchar(4000) NOT NULL,
  `postmessage2` varchar(500) NOT NULL,
  `postlinkname` varchar(200) NOT NULL,
  `postlinkurl` varchar(200) NOT NULL,
  `postcaption` varchar(2000) NOT NULL,
  `postdescription` varchar(4000) NOT NULL,
  `postimage` varchar(200) NOT NULL,
  `tags` int(2) DEFAULT NULL,
  `publicview` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `time` (`time`),
  KEY `wallid` (`wallid`),
  KEY `postid` (`postid`),
  KEY `time_3` (`time`,`wallid`),
  KEY `postmessage` (`postmessage`(255)),
  KEY `publicview` (`publicview`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='all feeds from all servers' AUTO_INCREMENT=589956 ;

--
-- Triggers `facebookfeed1`
--
DROP TRIGGER IF EXISTS `afteraddnewfeed1`;
DELIMITER //
CREATE TRIGGER `afteraddnewfeed1` AFTER INSERT ON `facebookfeed1`
 FOR EACH ROW INSERT INTO facebookfeed values( null, new.time, new.wallid, 
new.wallname, new.wallimageurl, new.postid,
new.postmessage, new.postmessage2, 
new.postlinkname, new.postlinkurl, 
new.postcaption, new.postdescription,
new.postimage,new.tags,new.publicview)
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `facebookfeed2`
--

CREATE TABLE IF NOT EXISTS `facebookfeed2` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `wallid` varchar(50) NOT NULL,
  `wallname` varchar(100) NOT NULL,
  `wallimageurl` varchar(200) NOT NULL,
  `postid` varchar(50) NOT NULL,
  `postmessage` varchar(4000) NOT NULL,
  `postmessage2` varchar(500) NOT NULL,
  `postlinkname` varchar(200) NOT NULL,
  `postlinkurl` varchar(200) NOT NULL,
  `postcaption` varchar(2000) NOT NULL,
  `postdescription` varchar(4000) NOT NULL,
  `postimage` varchar(200) NOT NULL,
  `tags` int(2) DEFAULT NULL,
  `publicview` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `time` (`time`),
  KEY `wallid` (`wallid`),
  KEY `postid` (`postid`),
  KEY `time_2` (`time`),
  KEY `time_3` (`time`,`wallid`),
  KEY `postmessage` (`postmessage`(255)),
  KEY `publicview` (`publicview`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='all feeds from all servers' AUTO_INCREMENT=760712 ;

--
-- Triggers `facebookfeed2`
--
DROP TRIGGER IF EXISTS `afteraddnewfeed2`;
DELIMITER //
CREATE TRIGGER `afteraddnewfeed2` AFTER INSERT ON `facebookfeed2`
 FOR EACH ROW INSERT INTO facebookfeed values( null, new.time, new.wallid, 
new.wallname, new.wallimageurl, new.postid,
new.postmessage, new.postmessage2, 
new.postlinkname, new.postlinkurl, 
new.postcaption, new.postdescription,
new.postimage,new.tags,new.publicview)
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `facebookfeed3`
--

CREATE TABLE IF NOT EXISTS `facebookfeed3` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `wallid` varchar(50) NOT NULL,
  `wallname` varchar(100) NOT NULL,
  `wallimageurl` varchar(200) NOT NULL,
  `postid` varchar(50) NOT NULL,
  `postmessage` varchar(4000) NOT NULL,
  `postmessage2` varchar(500) NOT NULL,
  `postlinkname` varchar(200) NOT NULL,
  `postlinkurl` varchar(200) NOT NULL,
  `postcaption` varchar(2000) NOT NULL,
  `postdescription` varchar(4000) NOT NULL,
  `postimage` varchar(200) NOT NULL,
  `tags` int(2) DEFAULT NULL,
  `publicview` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `time` (`time`),
  KEY `wallid` (`wallid`),
  KEY `postid` (`postid`),
  KEY `time_2` (`time`),
  KEY `time_3` (`time`,`wallid`),
  KEY `postmessage` (`postmessage`(255)),
  KEY `publicview` (`publicview`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='all feeds from all servers' AUTO_INCREMENT=480661 ;

--
-- Triggers `facebookfeed3`
--
DROP TRIGGER IF EXISTS `addfeedafterinsert3`;
DELIMITER //
CREATE TRIGGER `addfeedafterinsert3` AFTER INSERT ON `facebookfeed3`
 FOR EACH ROW INSERT INTO facebookfeed values( null, new.time, new.wallid, 
new.wallname, new.wallimageurl, new.postid,
new.postmessage, new.postmessage2, 
new.postlinkname, new.postlinkurl, 
new.postcaption, new.postdescription,
new.postimage,new.tags,new.publicview)
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `facebookfeed4`
--

CREATE TABLE IF NOT EXISTS `facebookfeed4` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `wallid` varchar(50) NOT NULL,
  `wallname` varchar(100) NOT NULL,
  `wallimageurl` varchar(200) NOT NULL,
  `postid` varchar(50) NOT NULL,
  `postmessage` varchar(4000) NOT NULL,
  `postmessage2` varchar(500) NOT NULL,
  `postlinkname` varchar(200) NOT NULL,
  `postlinkurl` varchar(200) NOT NULL,
  `postcaption` varchar(2000) NOT NULL,
  `postdescription` varchar(4000) NOT NULL,
  `postimage` varchar(200) NOT NULL,
  `tags` int(2) DEFAULT NULL,
  `publicview` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `time` (`time`),
  KEY `wallid` (`wallid`),
  KEY `postid` (`postid`),
  KEY `time_2` (`time`),
  KEY `time_3` (`time`,`wallid`),
  KEY `postmessage` (`postmessage`(255)),
  KEY `publicview` (`publicview`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='all feeds from all servers' AUTO_INCREMENT=295462 ;

--
-- Triggers `facebookfeed4`
--
DROP TRIGGER IF EXISTS `addfeedafterinsert4`;
DELIMITER //
CREATE TRIGGER `addfeedafterinsert4` AFTER INSERT ON `facebookfeed4`
 FOR EACH ROW INSERT INTO facebookfeed values( null, new.time, new.wallid, 
new.wallname, new.wallimageurl, new.postid,
new.postmessage, new.postmessage2, 
new.postlinkname, new.postlinkurl, 
new.postcaption, new.postdescription,
new.postimage,new.tags,new.publicview)
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `facebookfeed5`
--

CREATE TABLE IF NOT EXISTS `facebookfeed5` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `wallid` varchar(50) NOT NULL,
  `wallname` varchar(100) NOT NULL,
  `wallimageurl` varchar(200) NOT NULL,
  `postid` varchar(50) NOT NULL,
  `postmessage` varchar(4000) NOT NULL,
  `postmessage2` varchar(500) NOT NULL,
  `postlinkname` varchar(200) NOT NULL,
  `postlinkurl` varchar(200) NOT NULL,
  `postcaption` varchar(2000) NOT NULL,
  `postdescription` varchar(4000) NOT NULL,
  `postimage` varchar(200) NOT NULL,
  `tags` int(2) DEFAULT NULL,
  `publicview` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `time` (`time`),
  KEY `wallid` (`wallid`),
  KEY `postid` (`postid`),
  KEY `time_2` (`time`),
  KEY `time_3` (`time`,`wallid`),
  KEY `postmessage` (`postmessage`(255)),
  KEY `publicview` (`publicview`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='all feeds from all servers' AUTO_INCREMENT=94458 ;

--
-- Triggers `facebookfeed5`
--
DROP TRIGGER IF EXISTS `addfeedafterinsert5`;
DELIMITER //
CREATE TRIGGER `addfeedafterinsert5` AFTER INSERT ON `facebookfeed5`
 FOR EACH ROW INSERT INTO facebookfeed values( null, new.time, new.wallid, 
new.wallname, new.wallimageurl, new.postid,
new.postmessage, new.postmessage2, 
new.postlinkname, new.postlinkurl, 
new.postcaption, new.postdescription,
new.postimage,new.tags,new.publicview)
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `facebookfeed6`
--

CREATE TABLE IF NOT EXISTS `facebookfeed6` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `wallid` varchar(50) NOT NULL,
  `wallname` varchar(100) NOT NULL,
  `wallimageurl` varchar(200) NOT NULL,
  `postid` varchar(50) NOT NULL,
  `postmessage` varchar(4000) NOT NULL,
  `postmessage2` varchar(500) NOT NULL,
  `postlinkname` varchar(200) NOT NULL,
  `postlinkurl` varchar(200) NOT NULL,
  `postcaption` varchar(2000) NOT NULL,
  `postdescription` varchar(4000) NOT NULL,
  `postimage` varchar(200) NOT NULL,
  `tags` int(2) DEFAULT NULL,
  `publicview` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `time` (`time`),
  KEY `wallid` (`wallid`),
  KEY `postid` (`postid`),
  KEY `time_2` (`time`),
  KEY `time_3` (`time`,`wallid`),
  KEY `postmessage` (`postmessage`(255)),
  KEY `publicview` (`publicview`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='all feeds from all servers' AUTO_INCREMENT=18007 ;

--
-- Triggers `facebookfeed6`
--
DROP TRIGGER IF EXISTS `addfeedafterinsert6`;
DELIMITER //
CREATE TRIGGER `addfeedafterinsert6` AFTER INSERT ON `facebookfeed6`
 FOR EACH ROW INSERT INTO facebookfeed values( null, new.time, new.wallid, 
new.wallname, new.wallimageurl, new.postid,
new.postmessage, new.postmessage2, 
new.postlinkname, new.postlinkurl, 
new.postcaption, new.postdescription,
new.postimage,new.tags,new.publicview)
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `facebookfeed7`
--

CREATE TABLE IF NOT EXISTS `facebookfeed7` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `wallid` varchar(50) NOT NULL,
  `wallname` varchar(100) NOT NULL,
  `wallimageurl` varchar(200) NOT NULL,
  `postid` varchar(50) NOT NULL,
  `postmessage` varchar(4000) NOT NULL,
  `postmessage2` varchar(500) NOT NULL,
  `postlinkname` varchar(200) NOT NULL,
  `postlinkurl` varchar(200) NOT NULL,
  `postcaption` varchar(2000) NOT NULL,
  `postdescription` varchar(4000) NOT NULL,
  `postimage` varchar(200) NOT NULL,
  `tags` int(2) DEFAULT NULL,
  `publicview` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `time` (`time`),
  KEY `wallid` (`wallid`),
  KEY `postid` (`postid`),
  KEY `time_2` (`time`),
  KEY `time_3` (`time`,`wallid`),
  KEY `postmessage` (`postmessage`(255)),
  KEY `publicview` (`publicview`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='all feeds from all servers' AUTO_INCREMENT=183624 ;

--
-- Triggers `facebookfeed7`
--
DROP TRIGGER IF EXISTS `addfeedafterinsert7`;
DELIMITER //
CREATE TRIGGER `addfeedafterinsert7` AFTER INSERT ON `facebookfeed7`
 FOR EACH ROW INSERT INTO facebookfeed values( null, new.time, new.wallid, 
new.wallname, new.wallimageurl, new.postid,
new.postmessage, new.postmessage2, 
new.postlinkname, new.postlinkurl, 
new.postcaption, new.postdescription,
new.postimage,new.tags,new.publicview)
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `facebookfeed8`
--

CREATE TABLE IF NOT EXISTS `facebookfeed8` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `wallid` varchar(50) NOT NULL,
  `wallname` varchar(100) NOT NULL,
  `wallimageurl` varchar(200) NOT NULL,
  `postid` varchar(50) NOT NULL,
  `postmessage` varchar(4000) NOT NULL,
  `postmessage2` varchar(500) NOT NULL,
  `postlinkname` varchar(200) NOT NULL,
  `postlinkurl` varchar(200) NOT NULL,
  `postcaption` varchar(2000) NOT NULL,
  `postdescription` varchar(4000) NOT NULL,
  `postimage` varchar(200) NOT NULL,
  `tags` int(2) DEFAULT NULL,
  `publicview` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `time` (`time`),
  KEY `wallid` (`wallid`),
  KEY `postid` (`postid`),
  KEY `time_2` (`time`),
  KEY `time_3` (`time`,`wallid`),
  KEY `postmessage` (`postmessage`(255)),
  KEY `publicview` (`publicview`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='all feeds from all servers' AUTO_INCREMENT=44240 ;

--
-- Triggers `facebookfeed8`
--
DROP TRIGGER IF EXISTS `addfeedafterinsert8`;
DELIMITER //
CREATE TRIGGER `addfeedafterinsert8` AFTER INSERT ON `facebookfeed8`
 FOR EACH ROW INSERT INTO facebookfeed values( null, new.time, new.wallid, 
new.wallname, new.wallimageurl, new.postid,
new.postmessage, new.postmessage2, 
new.postlinkname, new.postlinkurl, 
new.postcaption, new.postdescription,
new.postimage,new.tags,new.publicview)
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `facebookfeed9`
--

CREATE TABLE IF NOT EXISTS `facebookfeed9` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `wallid` varchar(50) NOT NULL,
  `wallname` varchar(100) NOT NULL,
  `wallimageurl` varchar(200) NOT NULL,
  `postid` varchar(50) NOT NULL,
  `postmessage` varchar(4000) NOT NULL,
  `postmessage2` varchar(500) NOT NULL,
  `postlinkname` varchar(200) NOT NULL,
  `postlinkurl` varchar(200) NOT NULL,
  `postcaption` varchar(2000) NOT NULL,
  `postdescription` varchar(4000) NOT NULL,
  `postimage` varchar(200) NOT NULL,
  `tags` int(2) DEFAULT NULL,
  `publicview` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `time` (`time`),
  KEY `wallid` (`wallid`),
  KEY `postid` (`postid`),
  KEY `time_2` (`time`),
  KEY `time_3` (`time`,`wallid`),
  KEY `postmessage` (`postmessage`(255)),
  KEY `publicview` (`publicview`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='all feeds from all servers' AUTO_INCREMENT=179614 ;

--
-- Triggers `facebookfeed9`
--
DROP TRIGGER IF EXISTS `addfeedafterinsert9`;
DELIMITER //
CREATE TRIGGER `addfeedafterinsert9` AFTER INSERT ON `facebookfeed9`
 FOR EACH ROW INSERT INTO facebookfeed values( null, new.time, new.wallid, 
new.wallname, new.wallimageurl, new.postid,
new.postmessage, new.postmessage2, 
new.postlinkname, new.postlinkurl, 
new.postcaption, new.postdescription,
new.postimage,new.tags,new.publicview)
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `facebookfeed10`
--

CREATE TABLE IF NOT EXISTS `facebookfeed10` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `wallid` varchar(50) NOT NULL,
  `wallname` varchar(100) NOT NULL,
  `wallimageurl` varchar(200) NOT NULL,
  `postid` varchar(50) NOT NULL,
  `postmessage` varchar(4000) NOT NULL,
  `postmessage2` varchar(500) NOT NULL,
  `postlinkname` varchar(200) NOT NULL,
  `postlinkurl` varchar(200) NOT NULL,
  `postcaption` varchar(2000) NOT NULL,
  `postdescription` varchar(4000) NOT NULL,
  `postimage` varchar(200) NOT NULL,
  `tags` int(2) DEFAULT NULL,
  `publicview` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `time` (`time`),
  KEY `wallid` (`wallid`),
  KEY `postid` (`postid`),
  KEY `time_2` (`time`),
  KEY `time_3` (`time`,`wallid`),
  KEY `postmessage` (`postmessage`(255)),
  KEY `publicview` (`publicview`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='all feeds from all servers' AUTO_INCREMENT=40492 ;

--
-- Triggers `facebookfeed10`
--
DROP TRIGGER IF EXISTS `afterfeedinsert10`;
DELIMITER //
CREATE TRIGGER `afterfeedinsert10` AFTER INSERT ON `facebookfeed10`
 FOR EACH ROW INSERT INTO facebookfeed values( null, new.time, new.wallid, 
new.wallname, new.wallimageurl, new.postid,
new.postmessage, new.postmessage2, 
new.postlinkname, new.postlinkurl, 
new.postcaption, new.postdescription,
new.postimage,new.tags,new.publicview)
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `facebookfeed11`
--

CREATE TABLE IF NOT EXISTS `facebookfeed11` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `wallid` varchar(50) NOT NULL,
  `wallname` varchar(100) NOT NULL,
  `wallimageurl` varchar(200) NOT NULL,
  `postid` varchar(50) NOT NULL,
  `postmessage` varchar(4000) NOT NULL,
  `postmessage2` varchar(500) NOT NULL,
  `postlinkname` varchar(200) NOT NULL,
  `postlinkurl` varchar(200) NOT NULL,
  `postcaption` varchar(2000) NOT NULL,
  `postdescription` varchar(4000) NOT NULL,
  `postimage` varchar(200) NOT NULL,
  `tags` int(2) DEFAULT NULL,
  `publicview` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `time` (`time`),
  KEY `wallid` (`wallid`),
  KEY `postid` (`postid`),
  KEY `time_2` (`time`),
  KEY `time_3` (`time`,`wallid`),
  KEY `postmessage` (`postmessage`(255)),
  KEY `publicview` (`publicview`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='all feeds from all servers' AUTO_INCREMENT=12712 ;

--
-- Triggers `facebookfeed11`
--
DROP TRIGGER IF EXISTS `afteraddnewfeed11`;
DELIMITER //
CREATE TRIGGER `afteraddnewfeed11` AFTER INSERT ON `facebookfeed11`
 FOR EACH ROW INSERT INTO facebookfeed values( null, new.time, new.wallid, 
new.wallname, new.wallimageurl, new.postid,
new.postmessage, new.postmessage2, 
new.postlinkname, new.postlinkurl, 
new.postcaption, new.postdescription,
new.postimage,new.tags,new.publicview)
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `facebookfeed12`
--

CREATE TABLE IF NOT EXISTS `facebookfeed12` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `wallid` varchar(50) NOT NULL,
  `wallname` varchar(100) NOT NULL,
  `wallimageurl` varchar(200) NOT NULL,
  `postid` varchar(50) NOT NULL,
  `postmessage` varchar(4000) NOT NULL,
  `postmessage2` varchar(500) NOT NULL,
  `postlinkname` varchar(200) NOT NULL,
  `postlinkurl` varchar(200) NOT NULL,
  `postcaption` varchar(2000) NOT NULL,
  `postdescription` varchar(4000) NOT NULL,
  `postimage` varchar(200) NOT NULL,
  `tags` int(2) DEFAULT NULL,
  `publicview` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `time` (`time`),
  KEY `wallid` (`wallid`),
  KEY `postid` (`postid`),
  KEY `time_2` (`time`),
  KEY `time_3` (`time`,`wallid`),
  KEY `postmessage` (`postmessage`(255)),
  KEY `publicview` (`publicview`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='all feeds from all servers' AUTO_INCREMENT=336110 ;

--
-- Triggers `facebookfeed12`
--
DROP TRIGGER IF EXISTS `afterfeedinsert12`;
DELIMITER //
CREATE TRIGGER `afterfeedinsert12` AFTER INSERT ON `facebookfeed12`
 FOR EACH ROW INSERT INTO facebookfeed values( null, new.time, new.wallid, 
new.wallname, new.wallimageurl, new.postid,
new.postmessage, new.postmessage2, 
new.postlinkname, new.postlinkurl, 
new.postcaption, new.postdescription,
new.postimage,new.tags,new.publicview)
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `facebookfeed666`
--

CREATE TABLE IF NOT EXISTS `facebookfeed666` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `wallid` varchar(50) NOT NULL,
  `wallname` varchar(100) NOT NULL,
  `wallimageurl` varchar(200) NOT NULL,
  `postid` varchar(50) NOT NULL,
  `postmessage` varchar(4000) NOT NULL,
  `postmessage2` varchar(500) NOT NULL,
  `postlinkname` varchar(200) NOT NULL,
  `postlinkurl` varchar(200) NOT NULL,
  `postcaption` varchar(2000) NOT NULL,
  `postdescription` varchar(4000) NOT NULL,
  `postimage` varchar(200) NOT NULL,
  `tags` int(2) DEFAULT NULL,
  `publicview` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `time` (`time`),
  KEY `wallid` (`wallid`),
  KEY `postid` (`postid`),
  KEY `time_2` (`time`),
  KEY `time_3` (`time`,`wallid`),
  KEY `postmessage` (`postmessage`(255)),
  KEY `publicview` (`publicview`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='all feeds from all servers' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `facebooktags`
--

CREATE TABLE IF NOT EXISTS `facebooktags` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `value` int(2) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

-- --------------------------------------------------------

--
-- Table structure for table `facebookuser`
--

CREATE TABLE IF NOT EXISTS `facebookuser` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `wallid` varchar(50) NOT NULL,
  `wallname` varchar(50) NOT NULL,
  `walltype` varchar(200) NOT NULL,
  `wallusername` varchar(50) NOT NULL,
  `wallautoupdate` tinyint(1) NOT NULL DEFAULT '1',
  `wallpublicview` tinyint(1) NOT NULL,
  `wallaccesstoken` varchar(200) NOT NULL,
  `wallimageurl` varchar(200) NOT NULL,
  `wallcoverurl` varchar(200) NOT NULL,
  `wallactive` tinyint(1) NOT NULL,
  `walluser_id` varchar(50) NOT NULL,
  `walluser_username` varchar(50) NOT NULL,
  `walluser_name` varchar(100) NOT NULL,
  `walluser_email` varchar(50) NOT NULL,
  `walluser_appid` varchar(50) NOT NULL,
  `walluser_appname` varchar(50) NOT NULL,
  `walluser_accesstoken` varchar(200) NOT NULL,
  `tags` int(2) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY `id` (`id`),
  KEY `tags` (`tags`),
  KEY `wallid` (`wallid`),
  KEY `wallname` (`wallname`),
  KEY `walltype` (`walltype`),
  KEY `wallusername` (`wallusername`),
  KEY `wallactive` (`wallactive`),
  KEY `wallautoupdate` (`wallautoupdate`),
  KEY `wallsearchshow` (`wallpublicview`),
  KEY `tags_2` (`tags`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='facebook pages information' AUTO_INCREMENT=358 ;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`egypt`@`localhost` EVENT `delete feed1` ON SCHEDULE EVERY 1 DAY STARTS '2013-09-13 00:55:47' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM facebook.`facebookfeed1` WHERE 1 and  datediff(now(), `time`) > 5$$

CREATE DEFINER=`egypt`@`localhost` EVENT `delete feed2` ON SCHEDULE EVERY 1 DAY STARTS '2013-09-13 00:56:09' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM facebook.`facebookfeed2` WHERE 1 and  datediff(now(), `time`) > 5$$

CREATE DEFINER=`egypt`@`localhost` EVENT `delete feed3` ON SCHEDULE EVERY 1 DAY STARTS '2013-09-13 00:57:28' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM facebook.`facebookfeed3` WHERE 1 and  datediff(now(), `time`) > 5$$

CREATE DEFINER=`egypt`@`localhost` EVENT `delete feed more than 5 days` ON SCHEDULE EVERY 1 DAY STARTS '2013-09-13 00:54:50' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM facebook.`facebookfeed` WHERE 1 and  datediff(now(), `time`) > 5$$

CREATE DEFINER=`egypt`@`localhost` EVENT `delete feed 12` ON SCHEDULE EVERY 1 DAY STARTS '2013-10-26 23:28:39' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM facebook.`facebookfeed12` WHERE 1 and  datediff(now(), `time`) > 5$$

CREATE DEFINER=`egypt`@`localhost` EVENT `delete feed 4` ON SCHEDULE EVERY 1 DAY STARTS '2013-11-26 16:21:33' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM facebook.`facebookfeed4` WHERE 1 and  datediff(now(), `time`) > 5$$

CREATE DEFINER=`egypt`@`localhost` EVENT `delete feed 5` ON SCHEDULE EVERY 1 DAY STARTS '2013-11-26 16:22:01' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM facebook.`facebookfeed5` WHERE 1 and  datediff(now(), `time`) > 5$$

CREATE DEFINER=`egypt`@`localhost` EVENT `delete feed 6` ON SCHEDULE EVERY 1 DAY STARTS '2013-11-26 16:22:26' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM facebook.`facebookfeed6` WHERE 1 and  datediff(now(), `time`) > 5$$

CREATE DEFINER=`egypt`@`localhost` EVENT `delete feed 7` ON SCHEDULE EVERY 1 DAY STARTS '2013-11-26 16:22:48' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM facebook.`facebookfeed7` WHERE 1 and  datediff(now(), `time`) > 5$$

CREATE DEFINER=`egypt`@`localhost` EVENT `delete feed 8` ON SCHEDULE EVERY 1 DAY STARTS '2013-11-26 16:23:11' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM facebook.`facebookfeed8` WHERE 1 and  datediff(now(), `time`) > 5$$

CREATE DEFINER=`egypt`@`localhost` EVENT `delete feed 9` ON SCHEDULE EVERY 1 DAY STARTS '2013-11-26 16:23:40' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM facebook.`facebookfeed9` WHERE 1 and  datediff(now(), `time`) > 5$$

CREATE DEFINER=`egypt`@`localhost` EVENT `delete feed 10` ON SCHEDULE EVERY 1 DAY STARTS '2013-11-26 16:24:00' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM facebook.`facebookfeed10` WHERE 1 and  datediff(now(), `time`) > 5$$

CREATE DEFINER=`egypt`@`localhost` EVENT `delete feed 11` ON SCHEDULE EVERY 1 DAY STARTS '2013-11-26 16:24:26' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM facebook.`facebookfeed11` WHERE 1 and  datediff(now(), `time`) > 5$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
