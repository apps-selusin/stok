-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2018 at 09:23 PM
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
  `Harga` float(15,2) NOT NULL DEFAULT '0.00',
  `HargaJual` float(15,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `t06_article`
--

INSERT INTO `t06_article` (`id`, `SubGroupID`, `Kode`, `Nama`, `SatuanID`, `Harga`, `HargaJual`) VALUES
(1, 1, '5501001', 'MEAT Has Luar Lokal', 1, 100000.00, 125000.00);

-- --------------------------------------------------------

--
-- Table structure for table `t07_satuan`
--

CREATE TABLE IF NOT EXISTS `t07_satuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nama` varchar(25) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

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
-- Table structure for table `t08_beli`
--

CREATE TABLE IF NOT EXISTS `t08_beli` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `TglPO` date NOT NULL,
  `NoPO` varchar(14) CHARACTER SET latin1 NOT NULL,
  `VendorID` int(11) NOT NULL,
  `ArticleID` int(11) NOT NULL,
  `Harga` float(15,2) NOT NULL DEFAULT '0.00',
  `Qty` float(15,2) NOT NULL DEFAULT '0.00',
  `SubTotal` float(15,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `t08_beli`
--

INSERT INTO `t08_beli` (`id`, `TglPO`, `NoPO`, `VendorID`, `ArticleID`, `Harga`, `Qty`, `SubTotal`) VALUES
(1, '2018-04-16', 'PO201804160001', 1, 1, 100000.00, 2.10, 210000.00),
(2, '2018-04-17', 'PO201804170002', 2, 1, 125000.00, 3.20, 400000.00);

-- --------------------------------------------------------

--
-- Table structure for table `t09_hutang`
--

CREATE TABLE IF NOT EXISTS `t09_hutang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `NoHutang` varchar(8) CHARACTER SET latin1 NOT NULL,
  `BeliID` int(11) NOT NULL,
  `JumlahHutang` float(15,2) NOT NULL DEFAULT '0.00',
  `JumlahBayar` float(15,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `t09_hutang`
--

INSERT INTO `t09_hutang` (`id`, `NoHutang`, `BeliID`, `JumlahHutang`, `JumlahBayar`) VALUES
(1, 'HT000001', 1, 210000.00, 210000.00),
(2, 'HT000002', 2, 400000.00, 100000.00);

-- --------------------------------------------------------

--
-- Table structure for table `t10_hutangdetail`
--

CREATE TABLE IF NOT EXISTS `t10_hutangdetail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `HutangID` int(11) NOT NULL,
  `NoBayar` varchar(8) CHARACTER SET latin1 NOT NULL,
  `Tgl` date NOT NULL,
  `JumlahBayar` float(15,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `t10_hutangdetail`
--

INSERT INTO `t10_hutangdetail` (`id`, `HutangID`, `NoBayar`, `Tgl`, `JumlahBayar`) VALUES
(2, 1, 'HD000002', '2018-04-16', 60000.00),
(3, 1, 'HD000003', '2018-04-16', 75000.00),
(17, 1, 'HD000005', '2018-04-17', 25000.00),
(19, 1, 'HD000006', '2018-04-17', 50000.00),
(21, 2, 'HD000008', '2018-04-17', 100000.00);

-- --------------------------------------------------------

--
-- Table structure for table `t11_jual`
--

CREATE TABLE IF NOT EXISTS `t11_jual` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `TglSO` date NOT NULL,
  `NoSO` varchar(14) CHARACTER SET latin1 NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `CustomerPO` varchar(50) CHARACTER SET latin1 NOT NULL,
  `Total` float(15,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `t11_jual`
--

INSERT INTO `t11_jual` (`id`, `TglSO`, `NoSO`, `CustomerID`, `CustomerPO`, `Total`) VALUES
(1, '2018-04-18', 'SO201804180001', 1, '-', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `t12_jualdetail`
--

CREATE TABLE IF NOT EXISTS `t12_jualdetail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `JualID` int(11) NOT NULL,
  `ArticleID` int(11) NOT NULL,
  `HargaJual` float(15,2) NOT NULL DEFAULT '0.00',
  `Qty` float(15,2) NOT NULL DEFAULT '0.00',
  `SubTotal` float(15,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `t12_jualdetail`
--

INSERT INTO `t12_jualdetail` (`id`, `JualID`, `ArticleID`, `HargaJual`, `Qty`, `SubTotal`) VALUES
(1, 1, 1, 125000.00, 2.20, 275000.00),
(2, 1, 1, 125000.00, 2.00, 250000.00);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=496 ;

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
(114, '2018-04-05 10:08:36', '/stok/t06_articlelist.php', '1', '*** Batch update successful ***', 't06_article', '', '', '', ''),
(115, '2018-04-07 08:48:13', '/stok/login.php', 'admin', 'login', '::1', '', '', '', ''),
(116, '2018-04-07 13:12:17', '/stok/login.php', 'admin', 'login', '::1', '', '', '', ''),
(117, '2018-04-10 10:15:18', '/stok/login.php', 'admin', 'login', '::1', '', '', '', ''),
(118, '2018-04-10 10:42:35', '/stok/login.php', 'admin', 'login', '::1', '', '', '', ''),
(119, '2018-04-11 10:26:06', '/stok/login.php', 'admin', 'login', '::1', '', '', '', ''),
(120, '2018-04-11 11:58:09', '/stok/t06_articleedit.php', '1', 'U', 't06_article', 'Harga', '1', '0.00', '100000'),
(121, '2018-04-11 16:59:33', '/stok/login.php', 'admin', 'login', '::1', '', '', '', ''),
(122, '2018-04-11 17:22:09', '/stok/t08_polist.php', '1', 'A', 't08_po', 'NoPO', '1', '', 'PO201804110001'),
(123, '2018-04-11 17:22:09', '/stok/t08_polist.php', '1', 'A', 't08_po', 'TglPO', '1', '', '2018-04-11'),
(124, '2018-04-11 17:22:09', '/stok/t08_polist.php', '1', 'A', 't08_po', 'VendorID', '1', '', '1'),
(125, '2018-04-11 17:22:09', '/stok/t08_polist.php', '1', 'A', 't08_po', 'ArticleID', '1', '', '1'),
(126, '2018-04-11 17:22:09', '/stok/t08_polist.php', '1', 'A', 't08_po', 'Harga', '1', '', '100000.00'),
(127, '2018-04-11 17:22:09', '/stok/t08_polist.php', '1', 'A', 't08_po', 'Qty', '1', '', '1'),
(128, '2018-04-11 17:22:09', '/stok/t08_polist.php', '1', 'A', 't08_po', 'SatuanID', '1', '', '1'),
(129, '2018-04-11 17:22:09', '/stok/t08_polist.php', '1', 'A', 't08_po', 'id', '1', '', '1'),
(130, '2018-04-11 17:40:50', '/stok/t08_polist.php', '1', 'A', 't08_po', 'NoPO', '2', '', 'PO201804110002'),
(131, '2018-04-11 17:40:50', '/stok/t08_polist.php', '1', 'A', 't08_po', 'TglPO', '2', '', '2018-04-11'),
(132, '2018-04-11 17:40:50', '/stok/t08_polist.php', '1', 'A', 't08_po', 'VendorID', '2', '', '1'),
(133, '2018-04-11 17:40:50', '/stok/t08_polist.php', '1', 'A', 't08_po', 'ArticleID', '2', '', '1'),
(134, '2018-04-11 17:40:50', '/stok/t08_polist.php', '1', 'A', 't08_po', 'Harga', '2', '', '100000.00'),
(135, '2018-04-11 17:40:50', '/stok/t08_polist.php', '1', 'A', 't08_po', 'Qty', '2', '', '2'),
(136, '2018-04-11 17:40:50', '/stok/t08_polist.php', '1', 'A', 't08_po', 'SatuanID', '2', '', '1'),
(137, '2018-04-11 17:40:50', '/stok/t08_polist.php', '1', 'A', 't08_po', 'id', '2', '', '2'),
(138, '2018-04-11 17:44:16', '/stok/t08_polist.php', '1', 'A', 't08_po', 'TglPO', '3', '', '2018-04-11'),
(139, '2018-04-11 17:44:16', '/stok/t08_polist.php', '1', 'A', 't08_po', 'NoPO', '3', '', 'PO201804110003'),
(140, '2018-04-11 17:44:16', '/stok/t08_polist.php', '1', 'A', 't08_po', 'VendorID', '3', '', '2'),
(141, '2018-04-11 17:44:16', '/stok/t08_polist.php', '1', 'A', 't08_po', 'ArticleID', '3', '', '1'),
(142, '2018-04-11 17:44:16', '/stok/t08_polist.php', '1', 'A', 't08_po', 'Harga', '3', '', '100000.00'),
(143, '2018-04-11 17:44:16', '/stok/t08_polist.php', '1', 'A', 't08_po', 'Qty', '3', '', '3'),
(144, '2018-04-11 17:44:16', '/stok/t08_polist.php', '1', 'A', 't08_po', 'SatuanID', '3', '', '1'),
(145, '2018-04-11 17:44:16', '/stok/t08_polist.php', '1', 'A', 't08_po', 'id', '3', '', '3'),
(146, '2018-04-11 19:19:26', '/stok/t08_polist.php', '1', 'U', 't08_po', 'Harga', '1', '100000.00', '50000'),
(147, '2018-04-11 19:19:26', '/stok/t08_polist.php', '1', 'U', 't08_po', 'Qty', '1', '1', '2'),
(148, '2018-04-11 19:19:26', '/stok/t08_polist.php', '1', 'U', 't08_po', 'SubTotal', '1', '0.00', '100000'),
(149, '2018-04-11 19:19:42', '/stok/t08_polist.php', '1', 'U', 't08_po', 'Harga', '2', '100000.00', '75000'),
(150, '2018-04-11 19:19:42', '/stok/t08_polist.php', '1', 'U', 't08_po', 'Qty', '2', '2', '3'),
(151, '2018-04-11 19:19:42', '/stok/t08_polist.php', '1', 'U', 't08_po', 'SubTotal', '2', '0.00', '225000'),
(152, '2018-04-11 19:19:58', '/stok/t08_poedit.php', '1', 'U', 't08_po', 'Harga', '3', '100000.00', '60000'),
(153, '2018-04-11 19:19:58', '/stok/t08_poedit.php', '1', 'U', 't08_po', 'Qty', '3', '3', '4'),
(154, '2018-04-11 19:19:58', '/stok/t08_poedit.php', '1', 'U', 't08_po', 'SubTotal', '3', '0.00', '240000'),
(155, '2018-04-11 19:26:17', '/stok/t08_polist.php', '1', 'U', 't08_po', 'VendorID', '1', '1', '2'),
(156, '2018-04-11 19:26:17', '/stok/t08_polist.php', '1', 'U', 't08_po', 'Qty', '1', '2', '3'),
(157, '2018-04-11 19:26:17', '/stok/t08_polist.php', '1', 'U', 't08_po', 'SubTotal', '1', '100000.00', '150000'),
(158, '2018-04-12 09:01:48', '/stok/login.php', 'admin', 'login', '::1', '', '', '', ''),
(159, '2018-04-12 09:56:17', '/stok/t08_polist.php', '1', 'U', 't08_po', 'Qty', '1', '3.00', '2.1'),
(160, '2018-04-12 09:56:17', '/stok/t08_polist.php', '1', 'U', 't08_po', 'SubTotal', '1', '150000.00', '105000'),
(161, '2018-04-12 14:25:53', '/stok/t08_belilist.php', '1', 'U', 't08_beli', 'Qty', '2', '3.00', '3.2'),
(162, '2018-04-12 14:32:44', '/stok/t08_belilist.php', '1', 'U', 't08_beli', 'Qty', '2', '3.20', '4'),
(163, '2018-04-12 14:32:44', '/stok/t08_belilist.php', '1', 'U', 't08_beli', 'SubTotal', '2', '225000.00', '300000'),
(164, '2018-04-12 14:32:53', '/stok/t08_belilist.php', '1', 'U', 't08_beli', 'Qty', '2', '4.00', '3.2'),
(165, '2018-04-12 14:32:53', '/stok/t08_belilist.php', '1', 'U', 't08_beli', 'SubTotal', '2', '300000.00', '240000'),
(166, '2018-04-12 16:36:30', '/stok/login.php', 'admin', 'login', '::1', '', '', '', ''),
(167, '2018-04-13 12:49:48', '/stok/login.php', 'admin', 'login', '::1', '', '', '', ''),
(168, '2018-04-13 12:52:33', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'TglPO', '1', '', '2018-04-13'),
(169, '2018-04-13 12:52:33', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'NoPO', '1', '', 'PO201804130001'),
(170, '2018-04-13 12:52:33', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'VendorID', '1', '', '1'),
(171, '2018-04-13 12:52:33', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'ArticleID', '1', '', '1'),
(172, '2018-04-13 12:52:33', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'Harga', '1', '', '100000.00'),
(173, '2018-04-13 12:52:33', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'Qty', '1', '', '1.5'),
(174, '2018-04-13 12:52:33', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'SatuanID', '1', '', '1'),
(175, '2018-04-13 12:52:33', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'SubTotal', '1', '', '150000'),
(176, '2018-04-13 12:52:33', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'id', '1', '', '1'),
(177, '2018-04-13 12:56:35', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'TglPO', '1', '', '2018-04-13'),
(178, '2018-04-13 12:56:35', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'NoPO', '1', '', 'PO201804130001'),
(179, '2018-04-13 12:56:35', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'VendorID', '1', '', '1'),
(180, '2018-04-13 12:56:35', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'ArticleID', '1', '', '1'),
(181, '2018-04-13 12:56:35', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'Harga', '1', '', '100000.00'),
(182, '2018-04-13 12:56:35', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'Qty', '1', '', '1.2'),
(183, '2018-04-13 12:56:35', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'SatuanID', '1', '', '1'),
(184, '2018-04-13 12:56:35', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'SubTotal', '1', '', '120000'),
(185, '2018-04-13 12:56:35', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'id', '1', '', '1'),
(186, '2018-04-13 12:59:19', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'TglPO', '1', '', '2018-04-13'),
(187, '2018-04-13 12:59:19', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'NoPO', '1', '', 'PO201804130001'),
(188, '2018-04-13 12:59:19', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'VendorID', '1', '', '1'),
(189, '2018-04-13 12:59:19', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'ArticleID', '1', '', '1'),
(190, '2018-04-13 12:59:19', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'Harga', '1', '', '100000.00'),
(191, '2018-04-13 12:59:19', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'Qty', '1', '', '1.3'),
(192, '2018-04-13 12:59:19', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'SatuanID', '1', '', '1'),
(193, '2018-04-13 12:59:19', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'SubTotal', '1', '', '130000'),
(194, '2018-04-13 12:59:19', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'id', '1', '', '1'),
(195, '2018-04-13 13:04:21', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'TglPO', '2', '', '2018-04-13'),
(196, '2018-04-13 13:04:21', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'NoPO', '2', '', 'PO201804130002'),
(197, '2018-04-13 13:04:21', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'VendorID', '2', '', '2'),
(198, '2018-04-13 13:04:21', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'ArticleID', '2', '', '1'),
(199, '2018-04-13 13:04:21', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'Harga', '2', '', '100000.00'),
(200, '2018-04-13 13:04:21', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'Qty', '2', '', '1.4'),
(201, '2018-04-13 13:04:21', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'SatuanID', '2', '', '1'),
(202, '2018-04-13 13:04:21', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'SubTotal', '2', '', '140000'),
(203, '2018-04-13 13:04:21', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'id', '2', '', '2'),
(204, '2018-04-13 13:08:36', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'TglPO', '1', '', '2018-04-13'),
(205, '2018-04-13 13:08:36', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'NoPO', '1', '', 'PO201804130001'),
(206, '2018-04-13 13:08:36', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'VendorID', '1', '', '1'),
(207, '2018-04-13 13:08:36', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'ArticleID', '1', '', '1'),
(208, '2018-04-13 13:08:36', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'Harga', '1', '', '100000.00'),
(209, '2018-04-13 13:08:36', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'Qty', '1', '', '1.5'),
(210, '2018-04-13 13:08:36', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'SatuanID', '1', '', '1'),
(211, '2018-04-13 13:08:36', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'SubTotal', '1', '', '150000'),
(212, '2018-04-13 13:08:36', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'id', '1', '', '1'),
(213, '2018-04-13 21:37:57', '/stok/login.php', 'admin', 'login', '::1', '', '', '', ''),
(214, '2018-04-15 10:15:10', '/stok/login.php', 'admin', 'login', '::1', '', '', '', ''),
(215, '2018-04-15 10:29:33', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'HutangID', '1', '', '1'),
(216, '2018-04-15 10:29:33', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'NoBayar', '1', '', 'HD000001'),
(217, '2018-04-15 10:29:33', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'Tgl', '1', '', '2018-04-15'),
(218, '2018-04-15 10:29:33', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'JumlahBayar', '1', '', '3000'),
(219, '2018-04-15 10:29:33', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'id', '1', '', '1'),
(220, '2018-04-16 09:38:32', '/stok/login.php', 'admin', 'login', '::1', '', '', '', ''),
(221, '2018-04-16 09:55:57', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'TglPO', '1', '', '2018-04-16'),
(222, '2018-04-16 09:55:57', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'NoPO', '1', '', 'PO201804160001'),
(223, '2018-04-16 09:55:57', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'VendorID', '1', '', '1'),
(224, '2018-04-16 09:55:57', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'ArticleID', '1', '', '1'),
(225, '2018-04-16 09:55:57', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'Harga', '1', '', '100000.00'),
(226, '2018-04-16 09:55:57', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'Qty', '1', '', '2.1'),
(227, '2018-04-16 09:55:57', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'SatuanID', '1', '', '1'),
(228, '2018-04-16 09:55:57', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'SubTotal', '1', '', '210000'),
(229, '2018-04-16 09:55:57', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'id', '1', '', '1'),
(230, '2018-04-16 09:56:13', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'NoBayar', '1', '', 'HD000001'),
(231, '2018-04-16 09:56:13', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'Tgl', '1', '', '2018-04-16'),
(232, '2018-04-16 09:56:13', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'JumlahBayar', '1', '', '50000'),
(233, '2018-04-16 09:56:13', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'HutangID', '1', '', '1'),
(234, '2018-04-16 09:56:13', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'id', '1', '', '1'),
(235, '2018-04-16 09:59:27', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'NoBayar', '2', '', 'HD000002'),
(236, '2018-04-16 09:59:27', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'Tgl', '2', '', '2018-04-16'),
(237, '2018-04-16 09:59:27', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'JumlahBayar', '2', '', '60000'),
(238, '2018-04-16 09:59:27', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'HutangID', '2', '', '1'),
(239, '2018-04-16 09:59:27', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'id', '2', '', '2'),
(240, '2018-04-16 09:59:44', '/stok/t10_hutangdetaillist.php', '1', 'U', 't10_hutangdetail', 'JumlahBayar', '1', '50000.00', '40000.00'),
(241, '2018-04-16 10:04:59', '/stok/t10_hutangdetaildelete.php', '1', '*** Batch delete begin ***', 't10_hutangdetail', '', '', '', ''),
(242, '2018-04-16 10:04:59', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'id', '1', '1', ''),
(243, '2018-04-16 10:04:59', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'HutangID', '1', '1', ''),
(244, '2018-04-16 10:04:59', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'NoBayar', '1', 'HD000001', ''),
(245, '2018-04-16 10:04:59', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'Tgl', '1', '2018-04-16', ''),
(246, '2018-04-16 10:04:59', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'JumlahBayar', '1', '40000.00', ''),
(247, '2018-04-16 10:04:59', '/stok/t10_hutangdetaildelete.php', '1', '*** Batch delete successful ***', 't10_hutangdetail', '', '', '', ''),
(248, '2018-04-16 10:05:16', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'NoBayar', '3', '', 'HD000003'),
(249, '2018-04-16 10:05:16', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'Tgl', '3', '', '2018-04-16'),
(250, '2018-04-16 10:05:16', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'JumlahBayar', '3', '', '75000'),
(251, '2018-04-16 10:05:16', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'HutangID', '3', '', '1'),
(252, '2018-04-16 10:05:16', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'id', '3', '', '3'),
(253, '2018-04-16 10:08:07', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'NoBayar', '4', '', 'HD000004'),
(254, '2018-04-16 10:08:07', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'Tgl', '4', '', '2018-04-16'),
(255, '2018-04-16 10:08:07', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'JumlahBayar', '4', '', '15000'),
(256, '2018-04-16 10:08:07', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'HutangID', '4', '', '1'),
(257, '2018-04-16 10:08:07', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'id', '4', '', '4'),
(258, '2018-04-17 13:57:34', '/stok/login.php', 'admin', 'login', '::1', '', '', '', ''),
(259, '2018-04-17 15:03:24', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'NoBayar', '5', '', 'HD000005'),
(260, '2018-04-17 15:03:24', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'Tgl', '5', '', '2018-04-17'),
(261, '2018-04-17 15:03:24', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'JumlahBayar', '5', '', '25000'),
(262, '2018-04-17 15:03:24', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'HutangID', '5', '', '1'),
(263, '2018-04-17 15:03:24', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'id', '5', '', '5'),
(264, '2018-04-17 15:04:04', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'NoBayar', '6', '', 'HD000006'),
(265, '2018-04-17 15:04:04', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'Tgl', '6', '', '2018-04-17'),
(266, '2018-04-17 15:04:04', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'JumlahBayar', '6', '', '35000'),
(267, '2018-04-17 15:04:04', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'HutangID', '6', '', '1'),
(268, '2018-04-17 15:04:04', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'id', '6', '', '6'),
(269, '2018-04-17 15:04:36', '/stok/t10_hutangdetaillist.php', '1', 'U', 't10_hutangdetail', 'JumlahBayar', '6', '35000.00', '30000'),
(270, '2018-04-17 15:06:06', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'NoBayar', '7', '', 'HD000007'),
(271, '2018-04-17 15:06:06', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'Tgl', '7', '', '2018-04-17'),
(272, '2018-04-17 15:06:06', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'JumlahBayar', '7', '', '5000'),
(273, '2018-04-17 15:06:06', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'HutangID', '7', '', '1'),
(274, '2018-04-17 15:06:06', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'id', '7', '', '7'),
(275, '2018-04-17 15:08:25', '/stok/t10_hutangdetaildelete.php', '1', '*** Batch delete begin ***', 't10_hutangdetail', '', '', '', ''),
(276, '2018-04-17 15:08:25', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'id', '7', '7', ''),
(277, '2018-04-17 15:08:25', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'HutangID', '7', '1', ''),
(278, '2018-04-17 15:08:25', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'NoBayar', '7', 'HD000007', ''),
(279, '2018-04-17 15:08:25', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'Tgl', '7', '2018-04-17', ''),
(280, '2018-04-17 15:08:25', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'JumlahBayar', '7', '5000.00', ''),
(281, '2018-04-17 15:08:25', '/stok/t10_hutangdetaildelete.php', '1', '*** Batch delete successful ***', 't10_hutangdetail', '', '', '', ''),
(282, '2018-04-17 15:08:42', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'NoBayar', '8', '', 'HD000007'),
(283, '2018-04-17 15:08:42', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'Tgl', '8', '', '2018-04-17'),
(284, '2018-04-17 15:08:42', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'JumlahBayar', '8', '', '5000'),
(285, '2018-04-17 15:08:42', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'HutangID', '8', '', '1'),
(286, '2018-04-17 15:08:42', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'id', '8', '', '8'),
(287, '2018-04-17 15:14:48', '/stok/t10_hutangdetaillist.php', '1', 'U', 't10_hutangdetail', 'JumlahBayar', '8', '5000.00', '4000'),
(288, '2018-04-17 15:15:19', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'NoBayar', '9', '', 'HD000008'),
(289, '2018-04-17 15:15:19', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'Tgl', '9', '', '2018-04-17'),
(290, '2018-04-17 15:15:19', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'JumlahBayar', '9', '', '1000'),
(291, '2018-04-17 15:15:19', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'HutangID', '9', '', '1'),
(292, '2018-04-17 15:15:19', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'id', '9', '', '9'),
(293, '2018-04-17 15:18:02', '/stok/t10_hutangdetaillist.php', '1', 'U', 't10_hutangdetail', 'JumlahBayar', '8', '4000.00', '2500'),
(294, '2018-04-17 15:18:12', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'NoBayar', '10', '', 'HD000009'),
(295, '2018-04-17 15:18:12', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'Tgl', '10', '', '2018-04-17'),
(296, '2018-04-17 15:18:12', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'JumlahBayar', '10', '', '1500'),
(297, '2018-04-17 15:18:12', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'HutangID', '10', '', '1'),
(298, '2018-04-17 15:18:12', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'id', '10', '', '10'),
(299, '2018-04-17 15:18:50', '/stok/t10_hutangdetaildelete.php', '1', '*** Batch delete begin ***', 't10_hutangdetail', '', '', '', ''),
(300, '2018-04-17 15:18:50', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'id', '5', '5', ''),
(301, '2018-04-17 15:18:50', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'HutangID', '5', '1', ''),
(302, '2018-04-17 15:18:50', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'NoBayar', '5', 'HD000005', ''),
(303, '2018-04-17 15:18:50', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'Tgl', '5', '2018-04-17', ''),
(304, '2018-04-17 15:18:50', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'JumlahBayar', '5', '25000.00', ''),
(305, '2018-04-17 15:18:50', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'id', '6', '6', ''),
(306, '2018-04-17 15:18:50', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'HutangID', '6', '1', ''),
(307, '2018-04-17 15:18:50', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'NoBayar', '6', 'HD000006', ''),
(308, '2018-04-17 15:18:50', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'Tgl', '6', '2018-04-17', ''),
(309, '2018-04-17 15:18:50', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'JumlahBayar', '6', '30000.00', ''),
(310, '2018-04-17 15:18:50', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'id', '8', '8', ''),
(311, '2018-04-17 15:18:50', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'HutangID', '8', '1', ''),
(312, '2018-04-17 15:18:50', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'NoBayar', '8', 'HD000007', ''),
(313, '2018-04-17 15:18:50', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'Tgl', '8', '2018-04-17', ''),
(314, '2018-04-17 15:18:50', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'JumlahBayar', '8', '2500.00', ''),
(315, '2018-04-17 15:18:50', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'id', '9', '9', ''),
(316, '2018-04-17 15:18:50', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'HutangID', '9', '1', ''),
(317, '2018-04-17 15:18:50', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'NoBayar', '9', 'HD000008', ''),
(318, '2018-04-17 15:18:50', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'Tgl', '9', '2018-04-17', ''),
(319, '2018-04-17 15:18:50', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'JumlahBayar', '9', '1000.00', ''),
(320, '2018-04-17 15:18:50', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'id', '10', '10', ''),
(321, '2018-04-17 15:18:50', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'HutangID', '10', '1', ''),
(322, '2018-04-17 15:18:50', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'NoBayar', '10', 'HD000009', ''),
(323, '2018-04-17 15:18:50', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'Tgl', '10', '2018-04-17', ''),
(324, '2018-04-17 15:18:50', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'JumlahBayar', '10', '1500.00', ''),
(325, '2018-04-17 15:18:50', '/stok/t10_hutangdetaildelete.php', '1', '*** Batch delete successful ***', 't10_hutangdetail', '', '', '', ''),
(326, '2018-04-17 15:20:11', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'NoBayar', '11', '', 'HD000005'),
(327, '2018-04-17 15:20:11', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'Tgl', '11', '', '2018-04-17'),
(328, '2018-04-17 15:20:11', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'JumlahBayar', '11', '', '60000'),
(329, '2018-04-17 15:20:11', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'HutangID', '11', '', '1'),
(330, '2018-04-17 15:20:11', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'id', '11', '', '11'),
(331, '2018-04-17 15:20:36', '/stok/t10_hutangdetaildelete.php', '1', '*** Batch delete begin ***', 't10_hutangdetail', '', '', '', ''),
(332, '2018-04-17 15:20:36', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'id', '11', '11', ''),
(333, '2018-04-17 15:20:36', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'HutangID', '11', '1', ''),
(334, '2018-04-17 15:20:36', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'NoBayar', '11', 'HD000005', ''),
(335, '2018-04-17 15:20:36', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'Tgl', '11', '2018-04-17', ''),
(336, '2018-04-17 15:20:36', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'JumlahBayar', '11', '60000.00', ''),
(337, '2018-04-17 15:20:36', '/stok/t10_hutangdetaildelete.php', '1', '*** Batch delete successful ***', 't10_hutangdetail', '', '', '', ''),
(338, '2018-04-17 15:21:18', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'NoBayar', '12', '', 'HD000005'),
(339, '2018-04-17 15:21:18', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'Tgl', '12', '', '2018-04-17'),
(340, '2018-04-17 15:21:18', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'JumlahBayar', '12', '', '60000'),
(341, '2018-04-17 15:21:18', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'HutangID', '12', '', '1'),
(342, '2018-04-17 15:21:18', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'id', '12', '', '12'),
(343, '2018-04-17 15:21:29', '/stok/t10_hutangdetaildelete.php', '1', '*** Batch delete begin ***', 't10_hutangdetail', '', '', '', ''),
(344, '2018-04-17 15:21:29', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'id', '4', '4', ''),
(345, '2018-04-17 15:21:29', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'HutangID', '4', '1', ''),
(346, '2018-04-17 15:21:29', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'NoBayar', '4', 'HD000004', ''),
(347, '2018-04-17 15:21:29', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'Tgl', '4', '2018-04-16', ''),
(348, '2018-04-17 15:21:29', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'JumlahBayar', '4', '15000.00', ''),
(349, '2018-04-17 15:21:29', '/stok/t10_hutangdetaildelete.php', '1', '*** Batch delete successful ***', 't10_hutangdetail', '', '', '', ''),
(350, '2018-04-17 15:21:45', '/stok/t10_hutangdetaildelete.php', '1', '*** Batch delete begin ***', 't10_hutangdetail', '', '', '', ''),
(351, '2018-04-17 15:21:45', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'id', '12', '12', ''),
(352, '2018-04-17 15:21:45', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'HutangID', '12', '1', ''),
(353, '2018-04-17 15:21:45', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'NoBayar', '12', 'HD000005', ''),
(354, '2018-04-17 15:21:45', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'Tgl', '12', '2018-04-17', ''),
(355, '2018-04-17 15:21:45', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'JumlahBayar', '12', '60000.00', ''),
(356, '2018-04-17 15:21:45', '/stok/t10_hutangdetaildelete.php', '1', '*** Batch delete successful ***', 't10_hutangdetail', '', '', '', ''),
(357, '2018-04-17 15:30:10', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'TglPO', '2', '', '2018-04-17'),
(358, '2018-04-17 15:30:10', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'NoPO', '2', '', 'PO201804170002'),
(359, '2018-04-17 15:30:10', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'VendorID', '2', '', '2'),
(360, '2018-04-17 15:30:10', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'ArticleID', '2', '', '1'),
(361, '2018-04-17 15:30:10', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'Harga', '2', '', '125000'),
(362, '2018-04-17 15:30:10', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'Qty', '2', '', '3.2'),
(363, '2018-04-17 15:30:10', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'SatuanID', '2', '', '1'),
(364, '2018-04-17 15:30:10', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'SubTotal', '2', '', '400000'),
(365, '2018-04-17 15:30:10', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'id', '2', '', '2'),
(366, '2018-04-17 15:54:16', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'NoBayar', '13', '', 'HD000004'),
(367, '2018-04-17 15:54:16', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'Tgl', '13', '', '2018-04-17'),
(368, '2018-04-17 15:54:16', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'JumlahBayar', '13', '', '75000'),
(369, '2018-04-17 15:54:16', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'HutangID', '13', '', '1'),
(370, '2018-04-17 15:54:16', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'id', '13', '', '13'),
(371, '2018-04-17 15:54:32', '/stok/t10_hutangdetaillist.php', '1', 'U', 't10_hutangdetail', 'JumlahBayar', '13', '75000.00', '65000'),
(372, '2018-04-17 15:54:55', '/stok/t10_hutangdetaildelete.php', '1', '*** Batch delete begin ***', 't10_hutangdetail', '', '', '', ''),
(373, '2018-04-17 15:54:55', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'id', '13', '13', ''),
(374, '2018-04-17 15:54:55', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'HutangID', '13', '1', ''),
(375, '2018-04-17 15:54:55', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'NoBayar', '13', 'HD000004', ''),
(376, '2018-04-17 15:54:55', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'Tgl', '13', '2018-04-17', ''),
(377, '2018-04-17 15:54:55', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'JumlahBayar', '13', '65000.00', ''),
(378, '2018-04-17 15:54:55', '/stok/t10_hutangdetaildelete.php', '1', '*** Batch delete successful ***', 't10_hutangdetail', '', '', '', ''),
(379, '2018-04-17 16:09:51', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'NoBayar', '14', '', 'HD000004'),
(380, '2018-04-17 16:09:51', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'Tgl', '14', '', '2018-04-17'),
(381, '2018-04-17 16:09:51', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'JumlahBayar', '14', '', '75000'),
(382, '2018-04-17 16:09:51', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'HutangID', '14', '', '1'),
(383, '2018-04-17 16:09:51', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'id', '14', '', '14'),
(384, '2018-04-17 16:10:01', '/stok/t10_hutangdetaildelete.php', '1', '*** Batch delete begin ***', 't10_hutangdetail', '', '', '', ''),
(385, '2018-04-17 16:10:01', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'id', '14', '14', ''),
(386, '2018-04-17 16:10:01', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'HutangID', '14', '1', ''),
(387, '2018-04-17 16:10:01', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'NoBayar', '14', 'HD000004', ''),
(388, '2018-04-17 16:10:01', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'Tgl', '14', '2018-04-17', ''),
(389, '2018-04-17 16:10:01', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'JumlahBayar', '14', '75000.00', ''),
(390, '2018-04-17 16:10:01', '/stok/t10_hutangdetaildelete.php', '1', '*** Batch delete successful ***', 't10_hutangdetail', '', '', '', ''),
(391, '2018-04-17 16:10:48', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'NoBayar', '15', '', 'HD000004'),
(392, '2018-04-17 16:10:48', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'Tgl', '15', '', '2018-04-17'),
(393, '2018-04-17 16:10:48', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'JumlahBayar', '15', '', '75000'),
(394, '2018-04-17 16:10:48', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'HutangID', '15', '', '1'),
(395, '2018-04-17 16:10:48', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'id', '15', '', '15'),
(396, '2018-04-17 16:10:54', '/stok/t10_hutangdetaildelete.php', '1', '*** Batch delete begin ***', 't10_hutangdetail', '', '', '', ''),
(397, '2018-04-17 16:10:54', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'id', '15', '15', ''),
(398, '2018-04-17 16:10:54', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'HutangID', '15', '1', ''),
(399, '2018-04-17 16:10:54', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'NoBayar', '15', 'HD000004', ''),
(400, '2018-04-17 16:10:54', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'Tgl', '15', '2018-04-17', ''),
(401, '2018-04-17 16:10:54', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'JumlahBayar', '15', '75000.00', ''),
(402, '2018-04-17 16:10:54', '/stok/t10_hutangdetaildelete.php', '1', '*** Batch delete successful ***', 't10_hutangdetail', '', '', '', ''),
(403, '2018-04-17 16:11:08', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'NoBayar', '16', '', 'HD000004'),
(404, '2018-04-17 16:11:08', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'Tgl', '16', '', '2018-04-17'),
(405, '2018-04-17 16:11:08', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'JumlahBayar', '16', '', '50000'),
(406, '2018-04-17 16:11:08', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'HutangID', '16', '', '1'),
(407, '2018-04-17 16:11:08', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'id', '16', '', '16'),
(408, '2018-04-17 16:11:16', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'NoBayar', '17', '', 'HD000005'),
(409, '2018-04-17 16:11:16', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'Tgl', '17', '', '2018-04-17'),
(410, '2018-04-17 16:11:16', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'JumlahBayar', '17', '', '25000'),
(411, '2018-04-17 16:11:16', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'HutangID', '17', '', '1'),
(412, '2018-04-17 16:11:16', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'id', '17', '', '17'),
(413, '2018-04-17 16:11:25', '/stok/t10_hutangdetaildelete.php', '1', '*** Batch delete begin ***', 't10_hutangdetail', '', '', '', ''),
(414, '2018-04-17 16:11:25', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'id', '16', '16', ''),
(415, '2018-04-17 16:11:25', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'HutangID', '16', '1', ''),
(416, '2018-04-17 16:11:25', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'NoBayar', '16', 'HD000004', ''),
(417, '2018-04-17 16:11:25', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'Tgl', '16', '2018-04-17', ''),
(418, '2018-04-17 16:11:25', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'JumlahBayar', '16', '50000.00', ''),
(419, '2018-04-17 16:11:25', '/stok/t10_hutangdetaildelete.php', '1', '*** Batch delete successful ***', 't10_hutangdetail', '', '', '', ''),
(420, '2018-04-17 16:11:43', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'NoBayar', '18', '', 'HD000006'),
(421, '2018-04-17 16:11:43', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'Tgl', '18', '', '2018-04-17'),
(422, '2018-04-17 16:11:43', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'JumlahBayar', '18', '', '400000'),
(423, '2018-04-17 16:11:43', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'HutangID', '18', '', '2'),
(424, '2018-04-17 16:11:43', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'id', '18', '', '18'),
(425, '2018-04-17 16:11:59', '/stok/t10_hutangdetaildelete.php', '1', '*** Batch delete begin ***', 't10_hutangdetail', '', '', '', ''),
(426, '2018-04-17 16:11:59', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'id', '18', '18', ''),
(427, '2018-04-17 16:11:59', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'HutangID', '18', '2', ''),
(428, '2018-04-17 16:11:59', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'NoBayar', '18', 'HD000006', ''),
(429, '2018-04-17 16:11:59', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'Tgl', '18', '2018-04-17', ''),
(430, '2018-04-17 16:11:59', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'JumlahBayar', '18', '400000.00', ''),
(431, '2018-04-17 16:11:59', '/stok/t10_hutangdetaildelete.php', '1', '*** Batch delete successful ***', 't10_hutangdetail', '', '', '', ''),
(432, '2018-04-17 16:12:19', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'NoBayar', '19', '', 'HD000006'),
(433, '2018-04-17 16:12:19', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'Tgl', '19', '', '2018-04-17'),
(434, '2018-04-17 16:12:19', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'JumlahBayar', '19', '', '50000'),
(435, '2018-04-17 16:12:19', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'HutangID', '19', '', '1'),
(436, '2018-04-17 16:12:19', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'id', '19', '', '19'),
(437, '2018-04-17 16:55:21', '/stok/login.php', 'admin', 'login', '::1', '', '', '', ''),
(438, '2018-04-17 16:55:44', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'NoBayar', '20', '', 'HD000007');
INSERT INTO `t99_audittrail` (`id`, `datetime`, `script`, `user`, `action`, `table`, `field`, `keyvalue`, `oldvalue`, `newvalue`) VALUES
(439, '2018-04-17 16:55:44', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'Tgl', '20', '', '2018-04-17'),
(440, '2018-04-17 16:55:44', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'JumlahBayar', '20', '', '400000'),
(441, '2018-04-17 16:55:44', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'HutangID', '20', '', '2'),
(442, '2018-04-17 16:55:44', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'id', '20', '', '20'),
(443, '2018-04-17 16:55:57', '/stok/t10_hutangdetaillist.php', '1', 'U', 't10_hutangdetail', 'JumlahBayar', '20', '400000.00', '300000'),
(444, '2018-04-17 16:56:07', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'NoBayar', '21', '', 'HD000008'),
(445, '2018-04-17 16:56:07', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'Tgl', '21', '', '2018-04-17'),
(446, '2018-04-17 16:56:07', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'JumlahBayar', '21', '', '100000'),
(447, '2018-04-17 16:56:07', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'HutangID', '21', '', '2'),
(448, '2018-04-17 16:56:07', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'id', '21', '', '21'),
(449, '2018-04-17 16:56:15', '/stok/t10_hutangdetaildelete.php', '1', '*** Batch delete begin ***', 't10_hutangdetail', '', '', '', ''),
(450, '2018-04-17 16:56:15', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'id', '20', '20', ''),
(451, '2018-04-17 16:56:15', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'HutangID', '20', '2', ''),
(452, '2018-04-17 16:56:15', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'NoBayar', '20', 'HD000007', ''),
(453, '2018-04-17 16:56:15', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'Tgl', '20', '2018-04-17', ''),
(454, '2018-04-17 16:56:15', '/stok/t10_hutangdetaildelete.php', '1', 'D', 't10_hutangdetail', 'JumlahBayar', '20', '300000.00', ''),
(455, '2018-04-17 16:56:16', '/stok/t10_hutangdetaildelete.php', '1', '*** Batch delete successful ***', 't10_hutangdetail', '', '', '', ''),
(456, '2018-04-17 21:15:45', '/stok/login.php', 'admin', 'login', '::1', '', '', '', ''),
(457, '2018-04-17 23:18:46', '/stok/t06_articleedit.php', '1', 'U', 't06_article', 'HargaJual', '1', '0.00', '125000'),
(458, '2018-04-17 23:58:01', '/stok/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(459, '2018-04-17 23:58:06', '/stok/login.php', 'admin', 'login', '::1', '', '', '', ''),
(460, '2018-04-18 00:51:38', '/stok/t11_jualadd.php', '1', 'A', 't11_jual', 'TglSO', '1', '', '2018-04-18'),
(461, '2018-04-18 00:51:38', '/stok/t11_jualadd.php', '1', 'A', 't11_jual', 'NoSO', '1', '', 'SO201804180001'),
(462, '2018-04-18 00:51:38', '/stok/t11_jualadd.php', '1', 'A', 't11_jual', 'CustomerID', '1', '', '1'),
(463, '2018-04-18 00:51:38', '/stok/t11_jualadd.php', '1', 'A', 't11_jual', 'CustomerPO', '1', '', '-'),
(464, '2018-04-18 00:51:38', '/stok/t11_jualadd.php', '1', 'A', 't11_jual', 'Total', '1', '', '0'),
(465, '2018-04-18 00:51:38', '/stok/t11_jualadd.php', '1', 'A', 't11_jual', 'id', '1', '', '1'),
(466, '2018-04-18 00:51:38', '/stok/t11_jualadd.php', '1', '*** Batch insert begin ***', 't12_jualdetail', '', '', '', ''),
(467, '2018-04-18 00:51:38', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'JualID', '1', '', '1'),
(468, '2018-04-18 00:51:38', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'ArticleID', '1', '', '1'),
(469, '2018-04-18 00:51:38', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'HargaJual', '1', '', '125000.00'),
(470, '2018-04-18 00:51:38', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'Qty', '1', '', '0'),
(471, '2018-04-18 00:51:38', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'SatuanID', '1', '', '1'),
(472, '2018-04-18 00:51:38', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'SubTotal', '1', '', '0'),
(473, '2018-04-18 00:51:38', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'id', '1', '', '1'),
(474, '2018-04-18 00:51:39', '/stok/t11_jualadd.php', '1', '*** Batch insert successful ***', 't12_jualdetail', '', '', '', ''),
(475, '2018-04-18 00:55:00', '/stok/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(476, '2018-04-18 00:55:04', '/stok/login.php', 'admin', 'login', '::1', '', '', '', ''),
(477, '2018-04-18 01:15:02', '/stok/t11_jualedit.php', '1', '*** Batch update begin ***', 't12_jualdetail', '', '', '', ''),
(478, '2018-04-18 01:15:02', '/stok/t11_jualedit.php', '1', 'U', 't12_jualdetail', 'Qty', '1', '0.00', '4'),
(479, '2018-04-18 01:15:02', '/stok/t11_jualedit.php', '1', 'U', 't12_jualdetail', 'SubTotal', '1', '0.00', '500000'),
(480, '2018-04-18 01:15:02', '/stok/t11_jualedit.php', '1', 'A', 't12_jualdetail', 'JualID', '2', '', '1'),
(481, '2018-04-18 01:15:02', '/stok/t11_jualedit.php', '1', 'A', 't12_jualdetail', 'ArticleID', '2', '', '1'),
(482, '2018-04-18 01:15:02', '/stok/t11_jualedit.php', '1', 'A', 't12_jualdetail', 'HargaJual', '2', '', '125000.00'),
(483, '2018-04-18 01:15:02', '/stok/t11_jualedit.php', '1', 'A', 't12_jualdetail', 'Qty', '2', '', '5'),
(484, '2018-04-18 01:15:02', '/stok/t11_jualedit.php', '1', 'A', 't12_jualdetail', 'SatuanID', '2', '', '1'),
(485, '2018-04-18 01:15:02', '/stok/t11_jualedit.php', '1', 'A', 't12_jualdetail', 'SubTotal', '2', '', '625000'),
(486, '2018-04-18 01:15:02', '/stok/t11_jualedit.php', '1', 'A', 't12_jualdetail', 'id', '2', '', '2'),
(487, '2018-04-18 01:15:03', '/stok/t11_jualedit.php', '1', '*** Batch update successful ***', 't12_jualdetail', '', '', '', ''),
(488, '2018-04-18 02:20:04', '/stok/t11_jualedit.php', '1', '*** Batch update begin ***', 't12_jualdetail', '', '', '', ''),
(489, '2018-04-18 02:20:05', '/stok/t11_jualedit.php', '1', 'U', 't12_jualdetail', 'Qty', '1', '4.00', '3.5'),
(490, '2018-04-18 02:20:05', '/stok/t11_jualedit.php', '1', 'U', 't12_jualdetail', 'SubTotal', '1', '500000.00', '437500'),
(491, '2018-04-18 02:20:05', '/stok/t11_jualedit.php', '1', 'U', 't12_jualdetail', 'Qty', '2', '5.00', '2'),
(492, '2018-04-18 02:20:05', '/stok/t11_jualedit.php', '1', 'U', 't12_jualdetail', 'SubTotal', '2', '625000.00', '250000'),
(493, '2018-04-18 02:20:05', '/stok/t11_jualedit.php', '1', '*** Batch update successful ***', 't12_jualdetail', '', '', '', ''),
(494, '2018-04-18 02:20:46', '/stok/t12_jualdetailedit.php', '1', 'U', 't12_jualdetail', 'Qty', '1', '3.50', '2.2'),
(495, '2018-04-18 02:20:46', '/stok/t12_jualdetailedit.php', '1', 'U', 't12_jualdetail', 'SubTotal', '1', '437500.00', '275000');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v01_beli`
--
CREATE TABLE IF NOT EXISTS `v01_beli` (
`articleid` int(11)
,`avgharga` double(19,6)
,`sumqty` double(19,2)
,`subtotal` double(23,6)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v02_stok`
--
CREATE TABLE IF NOT EXISTS `v02_stok` (
`MainGroup` varchar(55)
,`SubGroup` varchar(56)
,`Article` varchar(85)
,`SumQty` double(19,2)
,`Satuan` varchar(25)
,`AvgHarga` double(19,6)
,`SubTotal` double(23,6)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v03_hutang`
--
CREATE TABLE IF NOT EXISTS `v03_hutang` (
`nohutang` varchar(8)
,`tglpo` date
,`nopo` varchar(14)
,`nama` varchar(50)
,`jumlahhutang` float(15,2)
,`jumlahbayar` float(15,2)
,`sisahutang` double(19,2)
);
-- --------------------------------------------------------

--
-- Structure for view `v01_beli`
--
DROP TABLE IF EXISTS `v01_beli`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v01_beli` AS select `t08_beli`.`ArticleID` AS `articleid`,avg(`t08_beli`.`Harga`) AS `avgharga`,sum(`t08_beli`.`Qty`) AS `sumqty`,(avg(`t08_beli`.`Harga`) * sum(`t08_beli`.`Qty`)) AS `subtotal` from `t08_beli` group by `t08_beli`.`ArticleID`;

-- --------------------------------------------------------

--
-- Structure for view `v02_stok`
--
DROP TABLE IF EXISTS `v02_stok`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v02_stok` AS select concat(`a`.`Kode`,' - ',`a`.`Nama`) AS `MainGroup`,concat(`b`.`Kode`,' - ',`b`.`Nama`) AS `SubGroup`,concat(`c`.`Kode`,' - ',`c`.`Nama`) AS `Article`,`e`.`sumqty` AS `SumQty`,`d`.`Nama` AS `Satuan`,`e`.`avgharga` AS `AvgHarga`,`e`.`subtotal` AS `SubTotal` from ((((`t04_maingroup` `a` left join `t05_subgroup` `b` on((`a`.`id` = `b`.`MainGroupID`))) left join `t06_article` `c` on((`b`.`id` = `c`.`SubGroupID`))) left join `t07_satuan` `d` on((`c`.`SatuanID` = `d`.`id`))) left join `v01_beli` `e` on((`c`.`id` = `e`.`articleid`)));

-- --------------------------------------------------------

--
-- Structure for view `v03_hutang`
--
DROP TABLE IF EXISTS `v03_hutang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v03_hutang` AS select `a`.`NoHutang` AS `nohutang`,`b`.`TglPO` AS `tglpo`,`b`.`NoPO` AS `nopo`,`c`.`Nama` AS `nama`,`a`.`JumlahHutang` AS `jumlahhutang`,`a`.`JumlahBayar` AS `jumlahbayar`,(`a`.`JumlahHutang` - `a`.`JumlahBayar`) AS `sisahutang` from ((`t09_hutang` `a` left join `t08_beli` `b` on((`a`.`BeliID` = `b`.`id`))) left join `t02_vendor` `c` on((`b`.`VendorID` = `c`.`id`)));

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
