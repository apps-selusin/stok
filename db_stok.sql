-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2018 at 12:36 PM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_stok`
--

-- --------------------------------------------------------

--
-- Table structure for table `t01_company`
--

CREATE TABLE IF NOT EXISTS `t01_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nama` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `t01_company`
--

INSERT INTO `t01_company` (`id`, `Nama`) VALUES
(1, 'PT. Lembayungpagi Amanah Bhumi');

-- --------------------------------------------------------

--
-- Table structure for table `t02_vendor`
--

CREATE TABLE IF NOT EXISTS `t02_vendor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nama` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `t02_vendor`
--

INSERT INTO `t02_vendor` (`id`, `Nama`) VALUES
(1, 'Grosir A'),
(2, 'Grosir B');

-- --------------------------------------------------------

--
-- Table structure for table `t03_customer`
--

CREATE TABLE IF NOT EXISTS `t03_customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nama` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `t03_customer`
--

INSERT INTO `t03_customer` (`id`, `Nama`) VALUES
(1, 'Aston Bojonegoro City Hotel'),
(2, 'favehotel Sudirman Bojonegoro');

-- --------------------------------------------------------

--
-- Table structure for table `t04_maingroup`
--

CREATE TABLE IF NOT EXISTS `t04_maingroup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Kode` varchar(2) NOT NULL,
  `Nama` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `t04_maingroup`
--

INSERT INTO `t04_maingroup` (`id`, `Kode`, `Nama`) VALUES
(1, '5', 'FOOD'),
(2, '6', 'BEVERAGE'),
(3, '7', 'MATERIAL');

-- --------------------------------------------------------

--
-- Table structure for table `t05_subgroup`
--

CREATE TABLE IF NOT EXISTS `t05_subgroup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `MainGroupID` int(11) NOT NULL,
  `Kode` varchar(3) NOT NULL,
  `Nama` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `t05_subgroup`
--

INSERT INTO `t05_subgroup` (`id`, `MainGroupID`, `Kode`, `Nama`) VALUES
(1, 1, '501', 'MEAT & PRODUCTS'),
(2, 1, '502', 'POULTRY & PRODUCTS'),
(3, 1, '503', 'FISH & SEAFOOD _'),
(4, 2, '601', 'MINERAL WATER _'),
(5, 1, '504', 'FRUIT _'),
(6, 1, '505', 'OIL FOR COOKING'),
(7, 1, '506', 'MILK _'),
(8, 1, '507', 'VEGETABLES, HERBS, & SPICES'),
(9, 1, '508', 'COFFEE & TEA _'),
(10, 2, '602', 'ALCOHOL'),
(11, 2, '603', 'SOFTDRINK _'),
(12, 2, '604', 'JUICE _'),
(13, 2, '605', 'SYRUP _');

-- --------------------------------------------------------

--
-- Table structure for table `t06_article`
--

CREATE TABLE IF NOT EXISTS `t06_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `SubGroupID` int(11) NOT NULL,
  `Kode` varchar(7) NOT NULL,
  `Nama` varchar(75) NOT NULL,
  `SatuanID` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `t06_article`
--

INSERT INTO `t06_article` (`id`, `SubGroupID`, `Kode`, `Nama`, `SatuanID`) VALUES
(1, 1, '5501001', 'MEAT Has Luar Lokal', 1);

-- --------------------------------------------------------

--
-- Table structure for table `t07_satuan`
--

CREATE TABLE IF NOT EXISTS `t07_satuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nama` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `t07_satuan`
--

INSERT INTO `t07_satuan` (`id`, `Nama`) VALUES
(1, 'Kg'),
(2, 'Set'),
(3, 'Pcs'),
(4, 'Unit');

-- --------------------------------------------------------

--
-- Table structure for table `t96_employees`
--

CREATE TABLE IF NOT EXISTS `t96_employees` (
  `EmployeeID` int(11) NOT NULL AUTO_INCREMENT,
  `LastName` varchar(20) DEFAULT NULL,
  `FirstName` varchar(10) DEFAULT NULL,
  `Title` varchar(30) DEFAULT NULL,
  `TitleOfCourtesy` varchar(25) DEFAULT NULL,
  `BirthDate` datetime DEFAULT NULL,
  `HireDate` datetime DEFAULT NULL,
  `Address` varchar(60) DEFAULT NULL,
  `City` varchar(15) DEFAULT NULL,
  `Region` varchar(15) DEFAULT NULL,
  `PostalCode` varchar(10) DEFAULT NULL,
  `Country` varchar(15) DEFAULT NULL,
  `HomePhone` varchar(24) DEFAULT NULL,
  `Extension` varchar(4) DEFAULT NULL,
  `Email` varchar(30) DEFAULT NULL,
  `Photo` varchar(255) DEFAULT NULL,
  `Notes` longtext,
  `ReportsTo` int(11) DEFAULT NULL,
  `Password` varchar(50) NOT NULL DEFAULT '',
  `UserLevel` int(11) DEFAULT NULL,
  `Username` varchar(20) NOT NULL DEFAULT '',
  `Activated` enum('Y','N') NOT NULL DEFAULT 'N',
  `Profile` longtext,
  PRIMARY KEY (`EmployeeID`),
  UNIQUE KEY `Username` (`Username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `t96_employees`
--

INSERT INTO `t96_employees` (`EmployeeID`, `LastName`, `FirstName`, `Title`, `TitleOfCourtesy`, `BirthDate`, `HireDate`, `Address`, `City`, `Region`, `PostalCode`, `Country`, `HomePhone`, `Extension`, `Email`, `Photo`, `Notes`, `ReportsTo`, `Password`, `UserLevel`, `Username`, `Activated`, `Profile`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '21232f297a57a5a743894a0e4a801fc3', -1, 'admin', 'Y', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t97_userlevels`
--

CREATE TABLE IF NOT EXISTS `t97_userlevels` (
  `userlevelid` int(11) NOT NULL,
  `userlevelname` varchar(255) NOT NULL,
  PRIMARY KEY (`userlevelid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t97_userlevels`
--

INSERT INTO `t97_userlevels` (`userlevelid`, `userlevelname`) VALUES
(-2, 'Anonymous'),
(-1, 'Administrator'),
(0, 'Default');

-- --------------------------------------------------------

--
-- Table structure for table `t98_userlevelpermissions`
--

CREATE TABLE IF NOT EXISTS `t98_userlevelpermissions` (
  `userlevelid` int(11) NOT NULL,
  `tablename` varchar(255) NOT NULL,
  `permission` int(11) NOT NULL,
  PRIMARY KEY (`userlevelid`,`tablename`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t98_userlevelpermissions`
--

INSERT INTO `t98_userlevelpermissions` (`userlevelid`, `tablename`, `permission`) VALUES
(-2, '{8746EF3F-81FE-4C1C-A7F8-AC191F8DDBB2}t96_employees', 0),
(-2, '{8746EF3F-81FE-4C1C-A7F8-AC191F8DDBB2}t97_userlevels', 0),
(-2, '{8746EF3F-81FE-4C1C-A7F8-AC191F8DDBB2}t98_userlevelpermissions', 0),
(-2, '{8746EF3F-81FE-4C1C-A7F8-AC191F8DDBB2}t99_audittrail', 0),
(-2, '{EC8C353E-21D9-43CE-9845-66794CB3C5CD}cf01_home.php', 111),
(-2, '{EC8C353E-21D9-43CE-9845-66794CB3C5CD}t01_master_sekolah', 0),
(-2, '{EC8C353E-21D9-43CE-9845-66794CB3C5CD}t96_employees', 0),
(-2, '{EC8C353E-21D9-43CE-9845-66794CB3C5CD}t97_userlevels', 0),
(-2, '{EC8C353E-21D9-43CE-9845-66794CB3C5CD}t98_userlevelpermissions', 0),
(-2, '{EC8C353E-21D9-43CE-9845-66794CB3C5CD}t99_audit_trail', 0),
(0, '{8746EF3F-81FE-4C1C-A7F8-AC191F8DDBB2}t96_employees', 0),
(0, '{8746EF3F-81FE-4C1C-A7F8-AC191F8DDBB2}t97_userlevels', 0),
(0, '{8746EF3F-81FE-4C1C-A7F8-AC191F8DDBB2}t98_userlevelpermissions', 0),
(0, '{8746EF3F-81FE-4C1C-A7F8-AC191F8DDBB2}t99_audittrail', 0),
(0, '{EC8C353E-21D9-43CE-9845-66794CB3C5CD}t01_master_sekolah', 0),
(0, '{EC8C353E-21D9-43CE-9845-66794CB3C5CD}t96_employees', 0),
(0, '{EC8C353E-21D9-43CE-9845-66794CB3C5CD}t97_userlevels', 0),
(0, '{EC8C353E-21D9-43CE-9845-66794CB3C5CD}t98_userlevelpermissions', 0),
(0, '{EC8C353E-21D9-43CE-9845-66794CB3C5CD}t99_audit_trail', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t99_audittrail`
--

CREATE TABLE IF NOT EXISTS `t99_audittrail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datetime` datetime NOT NULL,
  `script` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `user` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `action` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `table` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `field` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `keyvalue` longtext CHARACTER SET latin1,
  `oldvalue` longtext CHARACTER SET latin1,
  `newvalue` longtext CHARACTER SET latin1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=115 ;

--
-- Dumping data for table `t99_audittrail`
--

INSERT INTO `t99_audittrail` (`id`, `datetime`, `script`, `user`, `action`, `table`, `field`, `keyvalue`, `oldvalue`, `newvalue`) VALUES
(1, '2018-04-04 21:38:55', '/stok/login.php', 'admin', 'login', '::1', '', '', '', ''),
(2, '2018-04-04 21:44:56', '/stok/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(3, '2018-04-04 21:45:01', '/stok/login.php', 'admin', 'login', '::1', '', '', '', ''),
(4, '2018-04-04 21:47:47', '/stok/login.php', 'admin', 'login', '::1', '', '', '', ''),
(5, '2018-04-04 22:37:50', '/stok/t01_companyadd.php', '1', 'A', 't01_company', 'Nama', '1', '', 'PT. Lembayungpagi Amanah Bhumi'),
(6, '2018-04-04 22:37:50', '/stok/t01_companyadd.php', '1', 'A', 't01_company', 'id', '1', '', '1'),
(7, '2018-04-04 22:55:32', '/stok/t02_vendoradd.php', '1', 'A', 't02_vendor', 'Nama', '1', '', 'Grosir A'),
(8, '2018-04-04 22:55:32', '/stok/t02_vendoradd.php', '1', 'A', 't02_vendor', 'id', '1', '', '1'),
(9, '2018-04-04 22:55:50', '/stok/t02_vendoradd.php', '1', 'A', 't02_vendor', 'Nama', '2', '', 'Grosir B'),
(10, '2018-04-04 22:55:50', '/stok/t02_vendoradd.php', '1', 'A', 't02_vendor', 'id', '2', '', '2'),
(11, '2018-04-04 22:56:21', '/stok/t03_customeradd.php', '1', 'A', 't03_customer', 'Nama', '1', '', 'Aston Bojonegoro City Hotel'),
(12, '2018-04-04 22:56:21', '/stok/t03_customeradd.php', '1', 'A', 't03_customer', 'id', '1', '', '1'),
(13, '2018-04-04 22:56:51', '/stok/t03_customeradd.php', '1', 'A', 't03_customer', 'Nama', '2', '', 'favehotel Sudirman Bojonegoro'),
(14, '2018-04-04 22:56:51', '/stok/t03_customeradd.php', '1', 'A', 't03_customer', 'id', '2', '', '2'),
(15, '2018-04-05 09:03:00', '/stok/login.php', 'admin', 'login', '::1', '', '', '', ''),
(16, '2018-04-05 09:13:10', '/stok/t04_maingrouplist.php', '1', 'A', 't04_maingroup', 'Kode', '1', '', '5'),
(17, '2018-04-05 09:13:10', '/stok/t04_maingrouplist.php', '1', 'A', 't04_maingroup', 'Nama', '1', '', 'Food'),
(18, '2018-04-05 09:13:10', '/stok/t04_maingrouplist.php', '1', 'A', 't04_maingroup', 'id', '1', '', '1'),
(19, '2018-04-05 09:13:28', '/stok/t04_maingrouplist.php', '1', '*** Batch insert begin ***', 't04_maingroup', '', '', '', ''),
(20, '2018-04-05 09:13:28', '/stok/t04_maingrouplist.php', '1', 'A', 't04_maingroup', 'Kode', '2', '', '6'),
(21, '2018-04-05 09:13:28', '/stok/t04_maingrouplist.php', '1', 'A', 't04_maingroup', 'Nama', '2', '', 'Beverage'),
(22, '2018-04-05 09:13:28', '/stok/t04_maingrouplist.php', '1', 'A', 't04_maingroup', 'id', '2', '', '2'),
(23, '2018-04-05 09:13:28', '/stok/t04_maingrouplist.php', '1', 'A', 't04_maingroup', 'Kode', '3', '', '7'),
(24, '2018-04-05 09:13:28', '/stok/t04_maingrouplist.php', '1', 'A', 't04_maingroup', 'Nama', '3', '', 'Material'),
(25, '2018-04-05 09:13:28', '/stok/t04_maingrouplist.php', '1', 'A', 't04_maingroup', 'id', '3', '', '3'),
(26, '2018-04-05 09:13:29', '/stok/t04_maingrouplist.php', '1', '*** Batch insert successful ***', 't04_maingroup', '', '', '', ''),
(27, '2018-04-05 09:25:09', '/stok/t05_subgrouplist.php', '1', '*** Batch insert begin ***', 't05_subgroup', '', '', '', ''),
(28, '2018-04-05 09:25:09', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'MainGroupID', '1', '', '1'),
(29, '2018-04-05 09:25:09', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'Kode', '1', '', '501'),
(30, '2018-04-05 09:25:09', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'Nama', '1', '', 'MEAT & PRODUCTS'),
(31, '2018-04-05 09:25:09', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'id', '1', '', '1'),
(32, '2018-04-05 09:25:09', '/stok/t05_subgrouplist.php', '1', '*** Batch insert successful ***', 't05_subgroup', '', '', '', ''),
(33, '2018-04-05 09:25:29', '/stok/t04_maingrouplist.php', '1', '*** Batch update begin ***', 't04_maingroup', '', '', '', ''),
(34, '2018-04-05 09:25:30', '/stok/t04_maingrouplist.php', '1', 'U', 't04_maingroup', 'Nama', '1', 'Food', 'FOOD'),
(35, '2018-04-05 09:25:30', '/stok/t04_maingrouplist.php', '1', 'U', 't04_maingroup', 'Nama', '2', 'Beverage', 'BEVERAGE'),
(36, '2018-04-05 09:25:30', '/stok/t04_maingrouplist.php', '1', 'U', 't04_maingroup', 'Nama', '3', 'Material', 'MATERIAL'),
(37, '2018-04-05 09:25:30', '/stok/t04_maingrouplist.php', '1', '*** Batch update successful ***', 't04_maingroup', '', '', '', ''),
(38, '2018-04-05 09:28:41', '/stok/t05_subgrouplist.php', '1', '*** Batch insert begin ***', 't05_subgroup', '', '', '', ''),
(39, '2018-04-05 09:28:41', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'MainGroupID', '2', '', '1'),
(40, '2018-04-05 09:28:41', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'Kode', '2', '', '502'),
(41, '2018-04-05 09:28:41', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'Nama', '2', '', 'POULTRY & PRODUCTS'),
(42, '2018-04-05 09:28:41', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'id', '2', '', '2'),
(43, '2018-04-05 09:28:41', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'MainGroupID', '3', '', '1'),
(44, '2018-04-05 09:28:41', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'Kode', '3', '', '503'),
(45, '2018-04-05 09:28:41', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'Nama', '3', '', 'FISH & SEAFOOD _'),
(46, '2018-04-05 09:28:41', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'id', '3', '', '3'),
(47, '2018-04-05 09:28:41', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'MainGroupID', '4', '', '2'),
(48, '2018-04-05 09:28:41', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'Kode', '4', '', '601'),
(49, '2018-04-05 09:28:41', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'Nama', '4', '', 'MINERAL WATER _'),
(50, '2018-04-05 09:28:41', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'id', '4', '', '4'),
(51, '2018-04-05 09:28:41', '/stok/t05_subgrouplist.php', '1', '*** Batch insert successful ***', 't05_subgroup', '', '', '', ''),
(53, '2018-04-05 09:34:56', '/stok/t05_subgrouplist.php', '1', '*** Batch insert rollback ***', 't05_subgroup', '', '', '', ''),
(55, '2018-04-05 09:35:07', '/stok/t05_subgrouplist.php', '1', '*** Batch insert rollback ***', 't05_subgroup', '', '', '', ''),
(56, '2018-04-05 09:54:42', '/stok/t05_subgrouplist.php', '1', '*** Batch insert begin ***', 't05_subgroup', '', '', '', ''),
(57, '2018-04-05 09:54:42', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'MainGroupID', '5', '', '1'),
(58, '2018-04-05 09:54:42', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'Kode', '5', '', '504'),
(59, '2018-04-05 09:54:42', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'Nama', '5', '', 'FRUIT _'),
(60, '2018-04-05 09:54:42', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'id', '5', '', '5'),
(61, '2018-04-05 09:54:42', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'MainGroupID', '6', '', '1'),
(62, '2018-04-05 09:54:42', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'Kode', '6', '', '505'),
(63, '2018-04-05 09:54:42', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'Nama', '6', '', 'OIL FOR COOKING'),
(64, '2018-04-05 09:54:42', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'id', '6', '', '6'),
(65, '2018-04-05 09:54:43', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'MainGroupID', '7', '', '1'),
(66, '2018-04-05 09:54:43', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'Kode', '7', '', '506'),
(67, '2018-04-05 09:54:43', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'Nama', '7', '', 'MILK _'),
(68, '2018-04-05 09:54:43', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'id', '7', '', '7'),
(69, '2018-04-05 09:54:43', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'MainGroupID', '8', '', '1'),
(70, '2018-04-05 09:54:43', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'Kode', '8', '', '507'),
(71, '2018-04-05 09:54:43', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'Nama', '8', '', 'VEGETABLES, HERBS, & SPICES'),
(72, '2018-04-05 09:54:43', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'id', '8', '', '8'),
(73, '2018-04-05 09:54:43', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'MainGroupID', '9', '', '1'),
(74, '2018-04-05 09:54:43', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'Kode', '9', '', '508'),
(75, '2018-04-05 09:54:43', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'Nama', '9', '', 'COFFEE & TEA _'),
(76, '2018-04-05 09:54:43', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'id', '9', '', '9'),
(77, '2018-04-05 09:54:43', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'MainGroupID', '10', '', '2'),
(78, '2018-04-05 09:54:43', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'Kode', '10', '', '602'),
(79, '2018-04-05 09:54:43', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'Nama', '10', '', 'ALCOHOL'),
(80, '2018-04-05 09:54:43', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'id', '10', '', '10'),
(81, '2018-04-05 09:54:43', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'MainGroupID', '11', '', '2'),
(82, '2018-04-05 09:54:43', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'Kode', '11', '', '603'),
(83, '2018-04-05 09:54:43', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'Nama', '11', '', 'SOFTDRINK _'),
(84, '2018-04-05 09:54:43', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'id', '11', '', '11'),
(85, '2018-04-05 09:54:43', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'MainGroupID', '12', '', '2'),
(86, '2018-04-05 09:54:43', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'Kode', '12', '', '604'),
(87, '2018-04-05 09:54:43', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'Nama', '12', '', 'JUICE _'),
(88, '2018-04-05 09:54:43', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'id', '12', '', '12'),
(89, '2018-04-05 09:54:43', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'MainGroupID', '13', '', '2'),
(90, '2018-04-05 09:54:43', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'Kode', '13', '', '605'),
(91, '2018-04-05 09:54:43', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'Nama', '13', '', 'SYRUP _'),
(92, '2018-04-05 09:54:43', '/stok/t05_subgrouplist.php', '1', 'A', 't05_subgroup', 'id', '13', '', '13'),
(93, '2018-04-05 09:54:43', '/stok/t05_subgrouplist.php', '1', '*** Batch insert successful ***', 't05_subgroup', '', '', '', ''),
(94, '2018-04-05 09:58:23', '/stok/t06_articlelist.php', '1', '*** Batch insert begin ***', 't06_article', '', '', '', ''),
(95, '2018-04-05 09:58:23', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'MainGroupID', '1', '', '1'),
(96, '2018-04-05 09:58:23', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'SubGroupID', '1', '', '1'),
(97, '2018-04-05 09:58:23', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'Kode', '1', '', '5501001'),
(98, '2018-04-05 09:58:23', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'Nama', '1', '', 'MEAT Has Luar Lokal'),
(99, '2018-04-05 09:58:23', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'Satuan', '1', '', 'Kg'),
(100, '2018-04-05 09:58:23', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'id', '1', '', '1'),
(101, '2018-04-05 09:58:23', '/stok/t06_articlelist.php', '1', '*** Batch insert successful ***', 't06_article', '', '', '', ''),
(102, '2018-04-05 10:08:15', '/stok/t07_satuanlist.php', '1', '*** Batch insert begin ***', 't07_satuan', '', '', '', ''),
(103, '2018-04-05 10:08:15', '/stok/t07_satuanlist.php', '1', 'A', 't07_satuan', 'Nama', '1', '', 'Kg'),
(104, '2018-04-05 10:08:15', '/stok/t07_satuanlist.php', '1', 'A', 't07_satuan', 'id', '1', '', '1'),
(105, '2018-04-05 10:08:15', '/stok/t07_satuanlist.php', '1', 'A', 't07_satuan', 'Nama', '2', '', 'Set'),
(106, '2018-04-05 10:08:15', '/stok/t07_satuanlist.php', '1', 'A', 't07_satuan', 'id', '2', '', '2'),
(107, '2018-04-05 10:08:16', '/stok/t07_satuanlist.php', '1', 'A', 't07_satuan', 'Nama', '3', '', 'Pcs'),
(108, '2018-04-05 10:08:16', '/stok/t07_satuanlist.php', '1', 'A', 't07_satuan', 'id', '3', '', '3'),
(109, '2018-04-05 10:08:16', '/stok/t07_satuanlist.php', '1', 'A', 't07_satuan', 'Nama', '4', '', 'Unit'),
(110, '2018-04-05 10:08:16', '/stok/t07_satuanlist.php', '1', 'A', 't07_satuan', 'id', '4', '', '4'),
(111, '2018-04-05 10:08:16', '/stok/t07_satuanlist.php', '1', '*** Batch insert successful ***', 't07_satuan', '', '', '', ''),
(112, '2018-04-05 10:08:36', '/stok/t06_articlelist.php', '1', '*** Batch update begin ***', 't06_article', '', '', '', ''),
(113, '2018-04-05 10:08:36', '/stok/t06_articlelist.php', '1', 'U', 't06_article', 'SatuanID', '1', '0', '1'),
(114, '2018-04-05 10:08:36', '/stok/t06_articlelist.php', '1', '*** Batch update successful ***', 't06_article', '', '', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;