-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 01, 2014 at 10:08 PM
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

--
-- Dumping data for table `youtubetags`
--

INSERT INTO `youtubetags` (`id`, `name`, `description`, `tags`) VALUES
(1, 'قنوات إسلامية', 'أحدث مايتم تداولة على القنوات الاسلامية من فيديوهات', 1),
(2, 'قنوات إخبارية', '', 2),
(3, 'قنوات ترفيهية', '', 3),
(4, 'قنوات تعليمية ووثائقية', '', 4),
(5, 'قنوات فضائية', '', 5);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
