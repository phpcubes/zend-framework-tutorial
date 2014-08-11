-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2014 at 08:52 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `zf_tutorial`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE IF NOT EXISTS `albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `artist` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `artist`, `title`) VALUES
(3, 'amit', 'Designer'),
(5, 'Pradeep', 'Software Engg');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`) VALUES
(1, 0, 'Computers'),
(2, 0, 'Mobile'),
(3, 0, 'Laptops'),
(4, 0, 'Camera'),
(5, 0, 'Tablets'),
(6, 0, 'Television'),
(7, 1, 'Apple'),
(8, 1, 'sony'),
(9, 1, 'lenevo'),
(10, 1, 'dell'),
(11, 7, ''),
(12, 9, 'len-12345'),
(13, 1, 'aaaaaaa'),
(14, 1, 'dinesh'),
(15, 2, 'one'),
(16, 2, 'one'),
(17, 2, 'two'),
(18, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `added_date` datetime NOT NULL,
  `status` enum('0','1') NOT NULL COMMENT '"0"=>Inactive, "1"=>Active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `added_date`, `status`) VALUES
(8, 'zeev@andi.com', '6c3513b5d8b7208cfa2501d4673d4272', 'qeqweqwe', '2013-10-06 10:32:12', '0'),
(9, 'asdasd', '7555051b6d8a2dca27a29f9cb0d2e3a6', 'assdasd', '2013-10-06 10:41:49', '0'),
(11, 'asdasd', '7555051b6d8a2dca27a29f9cb0d2e3a6', 'assdasd', '2013-10-06 10:43:50', '0'),
(12, 'sasd', 'a8f5f167f44f4964e6c998dee827110c', 'asdasd', '2013-10-06 10:45:44', '0'),
(13, 'sasd', 'a8f5f167f44f4964e6c998dee827110c', 'asdasd', '2013-10-06 10:46:40', '0'),
(14, 'sasd', 'a8f5f167f44f4964e6c998dee827110c', 'asdasd', '2013-10-06 10:47:43', '0'),
(15, 'vikas.nice@gmail.com', '886e0579be9bb7a57a18a916feb27c8a', 'vikas dwivedi', '2013-10-12 09:18:02', '1'),
(16, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Vikas', '2014-05-14 12:09:17', '1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
