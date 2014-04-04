-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2014 at 08:29 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `femqueenold`
--

-- --------------------------------------------------------

--
-- Table structure for table `fqfm_master`
--

CREATE TABLE IF NOT EXISTS `fqfm_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `master_type` varchar(255) NOT NULL,
  `status` tinyint(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fqfm_user`
--

CREATE TABLE IF NOT EXISTS `fqfm_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `usertype` varchar(25) NOT NULL,
  `block` tinyint(4) NOT NULL,
  `activation_code` varchar(10) NOT NULL,
  `activation` tinyint(4) NOT NULL,
  `registerDate` datetime NOT NULL,
  `lastvisitDate` datetime NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `profile_image` text NOT NULL,
  `cover_image` text NOT NULL,
  `height` int(5) NOT NULL,
  `weight` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `fqfm_user`
--

INSERT INTO `fqfm_user` (`id`, `name`, `email`, `password`, `usertype`, `block`, `activation_code`, `activation`, `registerDate`, `lastvisitDate`, `firstname`, `lastname`, `dob`, `profile_image`, `cover_image`, `height`, `weight`) VALUES
(5, 'dharmalingam', 'dharma_inin@yahoo.co.in', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'user', 0, 'YdWVVzmOkt', 1, '2013-07-13 05:05:07', '2014-04-04 07:44:44', 'dharmalingam', 'arumugam', '', '', '', 0, 0),
(6, 'sankar', 'sankar@gmail.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'user', 0, 'IuQigNLTmu', 0, '2014-03-29 08:22:04', '0000-00-00 00:00:00', '', '', '', '', '', 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
