-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 04, 2012 at 03:18 PM
-- Server version: 5.5.22
-- PHP Version: 5.3.10-1ubuntu3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `social_network`
--
CREATE DATABASE `social_network` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `social_network`;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `content` text NOT NULL,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE IF NOT EXISTS `friends` (
  `IDmy` int(11) NOT NULL,
  `IDfriend` int(11) NOT NULL,
  PRIMARY KEY (`IDmy`,`IDfriend`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hasComment`
--

CREATE TABLE IF NOT EXISTS `hasComment` (
  `IDuser` int(11) NOT NULL,
  `IDcomment` int(11) NOT NULL,
  PRIMARY KEY (`IDuser`,`IDcomment`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hasPhoto`
--

CREATE TABLE IF NOT EXISTS `hasPhoto` (
  `IDuser` int(11) NOT NULL,
  `IDphoto` int(11) NOT NULL,
  PRIMARY KEY (`IDuser`,`IDphoto`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `like`
--

CREATE TABLE IF NOT EXISTS `like` (
  `IDuser` int(11) NOT NULL,
  `IDphoto` int(11) NOT NULL,
  UNIQUE KEY `IDuser` (`IDuser`,`IDphoto`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `photoComment`
--

CREATE TABLE IF NOT EXISTS `photoComment` (
  `IDphoto` int(11) NOT NULL,
  `IDcomment` int(11) NOT NULL,
  PRIMARY KEY (`IDphoto`,`IDcomment`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `photoContent`
--

CREATE TABLE IF NOT EXISTS `photoContent` (
  `ID` int(11) NOT NULL,
  `content` blob NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `photoName`
--

CREATE TABLE IF NOT EXISTS `photoName` (
  `filename` varchar(40) NOT NULL,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IDuser` int(11) NOT NULL,
  PRIMARY KEY (`ID`,`filename`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `photoVisability`
--

CREATE TABLE IF NOT EXISTS `photoVisability` (
  `ID` int(11) NOT NULL,
  `Visibility` tinyint(4) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE IF NOT EXISTS `request` (
  `IDmy` int(11) NOT NULL,
  `IDfriend` int(11) NOT NULL,
  PRIMARY KEY (`IDmy`,`IDfriend`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tagged`
--

CREATE TABLE IF NOT EXISTS `tagged` (
  `IDphoto` int(11) NOT NULL,
  `IDuser` int(11) NOT NULL,
  PRIMARY KEY (`IDphoto`,`IDuser`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `name` varchar(40) NOT NULL,
  `surname` varchar(40) NOT NULL,
  `ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Name` (`name`,`surname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `userLogin`
--

CREATE TABLE IF NOT EXISTS `userLogin` (
  `username` varchar(40) NOT NULL,
  `psswd` text NOT NULL,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
