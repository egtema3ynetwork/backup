-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 01, 2014 at 10:01 PM
-- Server version: 5.5.34-0ubuntu0.12.04.1
-- PHP Version: 5.3.10-1ubuntu3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `egtema3y`
--

-- --------------------------------------------------------

--
-- Table structure for table `addons`
--

CREATE TABLE IF NOT EXISTS `addons` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `url` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `logo` varchar(30) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `app_users`
--

CREATE TABLE IF NOT EXISTS `app_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `userid` varchar(50) NOT NULL,
  `code` varchar(300) NOT NULL,
  `accesstoken` varchar(300) NOT NULL,
  `appid` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birthday` varchar(30) NOT NULL,
  `location` varchar(50) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `id` (`id`),
  KEY `accesstoken` (`accesstoken`(255)),
  KEY `userid` (`userid`),
  KEY `userid_2` (`userid`,`accesstoken`(255))
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `facebookaccesstoken`
--

CREATE TABLE IF NOT EXISTS `facebookaccesstoken` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `userid` varchar(50) NOT NULL,
  `code` varchar(300) NOT NULL,
  `accesstoken` varchar(300) NOT NULL,
  `appid` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `location` varchar(50) NOT NULL,
  `guid` varchar(20) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `member` int(4) NOT NULL DEFAULT '0',
  `password` varchar(50) NOT NULL,
  `latest_ip` varchar(20) NOT NULL,
  `role` varchar(20) NOT NULL,
  `created_ip` varchar(20) NOT NULL,
  `error` varchar(200) NOT NULL,
  `haserror` tinyint(2) NOT NULL,
  `me` varchar(1000) NOT NULL,
  `birthday` varchar(30) NOT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `guid` (`guid`),
  KEY `accesstoken` (`accesstoken`(255)),
  KEY `userid` (`userid`),
  KEY `userid_2` (`userid`,`accesstoken`(255))
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=156 ;

-- --------------------------------------------------------

--
-- Table structure for table `facebookloginuser`
--

CREATE TABLE IF NOT EXISTS `facebookloginuser` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `userid` varchar(50) NOT NULL,
  `code` varchar(300) NOT NULL,
  `accesstoken` varchar(300) NOT NULL,
  `appid` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birthday` varchar(30) NOT NULL,
  `location` varchar(50) NOT NULL,
  `guid` varchar(20) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `me` text NOT NULL,
  `haserror` int(2) NOT NULL DEFAULT '0',
  `error` varchar(200) NOT NULL,
  `member` tinyint(4) NOT NULL DEFAULT '0',
  `password` varchar(30) NOT NULL,
  `latest_ip` varchar(20) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'Member',
  `created_ip` varchar(20) NOT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `guid` (`guid`),
  KEY `accesstoken` (`accesstoken`(255)),
  KEY `userid` (`userid`),
  KEY `userid_2` (`userid`,`accesstoken`(255))
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3347 ;

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE IF NOT EXISTS `service` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `actionname` varchar(50) NOT NULL,
  `starttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `loop` tinyint(1) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `value` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `userpassword` varchar(50) NOT NULL,
  `useremail` varchar(50) NOT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `useremail` (`useremail`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='egtema3y users info' AUTO_INCREMENT=3 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
