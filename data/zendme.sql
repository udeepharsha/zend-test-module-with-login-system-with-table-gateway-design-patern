-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2016 at 11:24 PM
-- Server version: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zendme`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

DROP TABLE IF EXISTS `album`;
CREATE TABLE IF NOT EXISTS `album` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `artist` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id`, `artist`, `title`) VALUES
(2, 'Adele', '21'),
(3, 'Bruce  Springsteen', 'Wrecking Ball (Deluxe)'),
(4, 'Lana  Del  Rey', 'Born  To  Die');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `usr_id` int(11) NOT NULL AUTO_INCREMENT,
  `usr_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `usr_password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `usr_email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `usrl_id` int(11) DEFAULT NULL,
  `lng_id` int(11) DEFAULT NULL,
  `usr_active` tinyint(1) NOT NULL,
  `usr_question` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usr_answer` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usr_picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usr_password_salt` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'dynamicSalt',
  `usr_registration_date` datetime DEFAULT NULL COMMENT 'Registration moment',
  `usr_registration_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'unique id sent by e-mail',
  `usr_email_confirmed` tinyint(1) NOT NULL COMMENT 'e-mail confirmed by user',
  PRIMARY KEY (`usr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`usr_id`, `usr_name`, `usr_password`, `usr_email`, `usrl_id`, `lng_id`, `usr_active`, `usr_question`, `usr_answer`, `usr_picture`, `usr_password_salt`, `usr_registration_date`, `usr_registration_token`, `usr_email_confirmed`) VALUES
(1, 'udeep', '357aafc1abece0acf87242537f6115da', 'udeepharsha@gmail.com', 6, 1, 1, NULL, NULL, NULL, 't>,o"d-q,AM;<J!(,b%ed@K1^)Vv$17tL<mX"a,|<%QPD[o0t+', '2016-10-05 21:19:19', 'bd31f2fa66a24c819d9be56aa705ec87', 0),
(2, 'udeep2', '357aafc1abece0acf87242537f6115da', 'udeepharsh12a@gmail.com', 5, 1, 1, NULL, NULL, NULL, 'B%r}''SYG`$o;f9u%EJ]b2<Fa8$#}/Dr&!ThsF:%wHgV._da#6D', '2016-10-05 21:23:26', '4b8f3b64cdbc25e8bd53b90b748ae59f', 0),
(3, 'udeep223', '357aafc1abece0acf87242537f6115da', 'udeepharsh12322a@gmail.com', 2, 1, 1, NULL, NULL, NULL, '")dj`jFp\\Z%;)I]ckX\\2yx~@9j37|!4OjyP2wH%w+l>jUw8C~,', '2016-10-05 21:25:19', '4c78afea513fed4a7048f5dc8abd8987', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
