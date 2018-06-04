-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 04, 2018 at 09:47 AM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_stok`
--

-- --------------------------------------------------------

--
-- Table structure for table `t01_company`
--

CREATE TABLE `t01_company` (
  `id` int(11) NOT NULL,
  `Nama` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t01_company`
--

INSERT INTO `t01_company` (`id`, `Nama`) VALUES
(1, 'PT. Lembayungpagi Amanah Bhumi');

-- --------------------------------------------------------

--
-- Table structure for table `t02_vendor`
--

CREATE TABLE `t02_vendor` (
  `id` int(11) NOT NULL,
  `Nama` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `t03_customer` (
  `id` int(11) NOT NULL,
  `Nama` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `t04_maingroup` (
  `id` int(11) NOT NULL,
  `Kode` varchar(2) NOT NULL,
  `Nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t04_maingroup`
--

INSERT INTO `t04_maingroup` (`id`, `Kode`, `Nama`) VALUES
(1, '1', 'FOOD'),
(2, '2', 'BEVERAGE'),
(3, '3', 'MATERIAL');

-- --------------------------------------------------------

--
-- Table structure for table `t05_subgroup`
--

CREATE TABLE `t05_subgroup` (
  `id` int(11) NOT NULL,
  `MainGroupID` int(11) NOT NULL,
  `Kode` varchar(3) NOT NULL,
  `Nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t05_subgroup`
--

INSERT INTO `t05_subgroup` (`id`, `MainGroupID`, `Kode`, `Nama`) VALUES
(1, 1, '501', 'MEAT & PRODUCTS'),
(2, 1, '502', 'POULTRY & PRODUCTS'),
(3, 1, '503', 'FISH & SEAFOOD _'),
(4, 1, '504', 'FRUIT _'),
(5, 1, '505', 'OIL FOR COOKING'),
(6, 1, '506', 'MILK _'),
(7, 1, '507', 'VEGETABLES'),
(8, 1, '508', 'COFFEE & TEA _'),
(9, 1, '509', 'DAIRY & PASTRY'),
(10, 1, '510', 'GROCERIES _'),
(11, 1, '511', 'SAUCE & SEASONING'),
(12, 1, '512', 'HERBS & SPICES'),
(13, 1, '513', 'NOODLE & PASTA'),
(14, 1, '514', 'RICE & FLOUR _'),
(15, 1, '515', 'INDONESIAN FOOD'),
(16, 2, '601', 'MINERAL WATER _'),
(17, 2, '602', 'ALCOHOL'),
(18, 2, '603', 'SOFTDRINK _'),
(19, 2, '604', 'JUICE _'),
(20, 2, '605', 'SYRUP _'),
(21, 2, '606', 'LOCAL DRINK');

-- --------------------------------------------------------

--
-- Table structure for table `t06_article`
--

CREATE TABLE `t06_article` (
  `id` int(11) NOT NULL,
  `SubGroupID` int(11) NOT NULL,
  `Kode` varchar(7) NOT NULL,
  `Nama` varchar(75) NOT NULL,
  `Qty` float(15,2) NOT NULL DEFAULT '0.00',
  `SatuanID` int(11) NOT NULL,
  `Harga` float(15,2) NOT NULL DEFAULT '0.00',
  `HargaJual` float(15,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t06_article`
--

INSERT INTO `t06_article` (`id`, `SubGroupID`, `Kode`, `Nama`, `Qty`, `SatuanID`, `Harga`, `HargaJual`) VALUES
(1, 1, '1501001', 'MEAT Has Luar Lokal', 0.00, 0, 0.00, 0.00),
(2, 1, '1501002', 'MEAT Sirloin Steak Lokal', 0.00, 0, 0.00, 0.00),
(3, 1, '1501003', 'MEAT Sirloin Wagyu Lokal', 0.00, 0, 0.00, 0.00),
(4, 1, '1501004', 'MEAT Striploin Steak AUS', 0.00, 0, 0.00, 0.00),
(5, 1, '1501005', 'MEAT Striploin Black Angus AUS', 0.00, 0, 0.00, 0.00),
(6, 1, '1501006', 'MEAT Striploin Meltique AUS', 0.00, 0, 0.00, 0.00),
(7, 1, '1501007', 'MEAT Has Dalam Lokal', 0.00, 0, 0.00, 0.00),
(8, 1, '1501008', 'MEAT Tenderloin Steak Lokal', 0.00, 0, 0.00, 0.00),
(9, 1, '1501009', 'MEAT Tenderloin Wagyu Lokal', 0.00, 0, 0.00, 0.00),
(10, 1, '1501010', 'MEAT Tenderloin Steak AUS', 0.00, 0, 0.00, 0.00),
(11, 1, '1501011', 'MEAT Tenderloin Black Angus AUS', 0.00, 0, 0.00, 0.00),
(12, 1, '1501012', 'MEAT Iga Sapi Lokal', 0.00, 0, 0.00, 0.00),
(13, 1, '1501013', 'MEAT Back Ribs Lokal', 0.00, 0, 0.00, 0.00),
(14, 1, '1501014', 'MEAT Short Ribs Lokal', 0.00, 0, 0.00, 0.00),
(15, 1, '1501015', 'MEAT Rib Eye AUS', 0.00, 0, 0.00, 0.00),
(16, 1, '1501016', 'MEAT Rib Eye Black Angus AUS', 0.00, 0, 0.00, 0.00),
(17, 1, '1501017', 'MEAT Short Ribs AUS', 0.00, 0, 0.00, 0.00),
(18, 1, '1501018', 'MEAT Topside Lokal', 0.00, 0, 0.00, 0.00),
(19, 1, '1501019', 'MEAT Topside AUS', 0.00, 0, 0.00, 0.00),
(20, 1, '1501020', 'MEAT Rump Lokal', 0.00, 0, 0.00, 0.00),
(21, 1, '1501021', 'MEAT Rump AUS', 0.00, 0, 0.00, 0.00),
(22, 1, '1501022', 'MEAT Blade Lokal', 0.00, 0, 0.00, 0.00),
(23, 1, '1501023', 'MEAT Blade AUS', 0.00, 0, 0.00, 0.00),
(24, 1, '1501024', 'MEAT Brisket Lokal', 0.00, 0, 0.00, 0.00),
(25, 1, '1501025', 'MEAT Ribs Bone/Tulang Iga Lokal', 0.00, 0, 0.00, 0.00),
(26, 1, '1501026', 'MEAT Ribs Bone AUS', 0.00, 0, 0.00, 0.00),
(27, 1, '1501027', 'MEAT Outside Lokal', 0.00, 0, 0.00, 0.00),
(28, 1, '1501028', 'MEAT Chuck Tender Lokal', 0.00, 0, 0.00, 0.00),
(29, 1, '1501029', 'MEAT Chuck Roll Lokal', 0.00, 0, 0.00, 0.00),
(30, 1, '1501030', 'MEAT Knuckle Lokal', 0.00, 0, 0.00, 0.00),
(31, 1, '1501031', 'MEAT Shank Lokal', 0.00, 0, 0.00, 0.00),
(32, 1, '1501032', 'MEAT Dengkul Sapi Lokal', 0.00, 0, 0.00, 0.00),
(33, 1, '1501033', 'MEAT Shank Bone AUS', 0.00, 0, 0.00, 0.00),
(34, 1, '1501034', 'MEAT Shank Boneless AUS', 0.00, 0, 0.00, 0.00),
(35, 1, '1501035', 'MEAT Veal Bone Hindshank Cut AUS', 0.00, 0, 0.00, 0.00),
(36, 1, '1501036', 'MEAT Kikil Sapi Lokal', 0.00, 0, 0.00, 0.00),
(37, 1, '1501037', 'MEAT Sumsum Tulang Sapi Lokal', 0.00, 0, 0.00, 0.00),
(38, 1, '1501038', 'MEAT Oxtail Cut Lokal', 0.00, 0, 0.00, 0.00),
(39, 1, '1501039', 'MEAT Oxtail Cut Import', 0.00, 0, 0.00, 0.00),
(40, 1, '1501040', 'MEAT Daging Rawon Lokal', 0.00, 0, 0.00, 0.00),
(41, 1, '1501041', 'MEAT Daging Tetelan Lokal', 0.00, 0, 0.00, 0.00),
(42, 1, '1501042', 'MEAT Hati Sapi Lokal', 0.00, 0, 0.00, 0.00),
(43, 1, '1501043', 'MEAT Paru Sapi Lokal', 0.00, 0, 0.00, 0.00),
(44, 1, '1501044', 'MEAT Limpa Sapi Lokal', 0.00, 0, 0.00, 0.00),
(45, 1, '1501045', 'MEAT Usus Sapi Lokal', 0.00, 0, 0.00, 0.00),
(46, 1, '1501046', 'MEAT Babat Sapi Lokal', 0.00, 0, 0.00, 0.00),
(47, 1, '1501047', 'MEAT Cingur Sapi Lokal', 0.00, 0, 0.00, 0.00),
(48, 1, '1501048', 'MEAT Cecek Sapi Lokal', 0.00, 0, 0.00, 0.00),
(49, 1, '1501049', 'MEAT Daging Giling Lokal', 0.00, 0, 0.00, 0.00),
(50, 1, '1501050', 'MEAT Beef Bacon Rasher (brand) (bera', 0.00, 0, 0.00, 0.00),
(51, 1, '1501051', 'MEAT Smoked Beef Cuts Lokal (brand)', 0.00, 0, 0.00, 0.00),
(52, 1, '1501052', 'MEAT Smoked Beef Whole (brand) (bera', 0.00, 0, 0.00, 0.00),
(53, 1, '1501053', 'MEAT Beef Pastrami (brand) (berat)', 0.00, 0, 0.00, 0.00),
(54, 1, '1501054', 'MEAT Beef Salami (brand) (berat)', 0.00, 0, 0.00, 0.00),
(55, 1, '1501055', 'MEAT Beef Pepperoni Soejasch Nikmat', 0.00, 0, 0.00, 0.00),
(56, 1, '1501056', 'MEAT Beef Patties Whole (brand) (ber', 0.00, 0, 0.00, 0.00),
(57, 1, '1501057', 'MEAT Beef Lyoner Whole (brand) (bera', 0.00, 0, 0.00, 0.00),
(58, 1, '1501058', 'MEAT Sosis Sapi Bernardi 180 gr', 0.00, 0, 0.00, 0.00),
(59, 1, '1501059', 'MEAT Sosis Sapi Bernardi 500 gr', 0.00, 0, 0.00, 0.00),
(60, 1, '1501060', 'MEAT Beef Franks (brand) (berat)', 0.00, 0, 0.00, 0.00),
(61, 1, '1501061', 'MEAT Beef Quarter Frank US (brand) 1', 0.00, 0, 0.00, 0.00),
(62, 1, '1501062', 'MEAT Swiss Bratwurst Sausage (brand)', 0.00, 0, 0.00, 0.00),
(63, 1, '1501063', 'MEAT German Bratwurst Sausage (brand', 0.00, 0, 0.00, 0.00),
(64, 1, '1501064', 'MEAT Beef Nurnberger (brand) (berat)', 0.00, 0, 0.00, 0.00),
(65, 1, '1501065', 'MEAT Veil Nurnberger (brand) (berat)', 0.00, 0, 0.00, 0.00),
(66, 1, '1501066', 'MEAT Beef Jagdwurst (brand) (berat)', 0.00, 0, 0.00, 0.00),
(67, 1, '1501067', 'MEAT Beef Mortadella (brand) (berat)', 0.00, 0, 0.00, 0.00),
(68, 1, '1501068', 'MEAT Australian BBQ Sausage (brand)', 0.00, 0, 0.00, 0.00),
(69, 1, '1501069', 'MEAT Sosis Sapi Cater 1 Kg', 0.00, 0, 0.00, 0.00),
(70, 1, '1501070', 'MEAT Bakso Sapi Halus (brand) (berat', 0.00, 0, 0.00, 0.00),
(71, 1, '1501071', 'MEAT Bakso Sapi Kasar (brand) (berat', 0.00, 0, 0.00, 0.00),
(72, 1, '1501072', 'MEAT Daging Kambing Lokal', 0.00, 0, 0.00, 0.00),
(73, 1, '1501073', 'MEAT Paha Kambing Lokal', 0.00, 0, 0.00, 0.00),
(74, 1, '1501074', 'MEAT Iga Kambing Lokal', 0.00, 0, 0.00, 0.00),
(75, 1, '1501075', 'MEAT Kepala Kambing Lokal', 0.00, 0, 0.00, 0.00),
(76, 1, '1501076', 'MEAT Jeroan Kambing Lokal', 0.00, 0, 0.00, 0.00),
(77, 1, '1501077', 'MEAT Tengkleng Kambing Lokal', 0.00, 0, 0.00, 0.00),
(78, 1, '1501078', 'MEAT Lamb Shank AUS', 0.00, 0, 0.00, 0.00),
(79, 1, '1501079', 'MEAT Lamb Rack AUS', 0.00, 0, 0.00, 0.00),
(80, 1, '1501080', 'MEAT Lamb Chop AUS', 0.00, 0, 0.00, 0.00),
(81, 1, '1501081', 'MEAT Lidah Sapi Lokal', 0.00, 0, 0.00, 0.00),
(82, 1, '1501082', 'MEAT Beef Breakfast Whole Soejasch N', 0.00, 0, 0.00, 0.00),
(83, 1, '1501083', 'MEAT Sosis Sapi SOEJASCH 25gr/pcs 50', 0.00, 0, 0.00, 0.00),
(84, 2, '1502001', 'POUL Ayam Whole', 0.00, 0, 0.00, 0.00),
(85, 2, '1502002', 'POUL Ayam Broiler 1,7-1,8 kg', 0.00, 0, 0.00, 0.00),
(86, 2, '1502003', 'POUL Ayam Muda', 0.00, 0, 0.00, 0.00),
(87, 2, '1502004', 'POUL Dada Ayam', 0.00, 0, 0.00, 0.00),
(88, 2, '1502005', 'POUL Sayap Ayam', 0.00, 0, 0.00, 0.00),
(89, 2, '1502006', 'POUL Paha Ayam', 0.00, 0, 0.00, 0.00),
(90, 2, '1502007', 'POUL Cakar Ayam', 0.00, 0, 0.00, 0.00),
(91, 2, '1502008', 'POUL Kepala Ayam', 0.00, 0, 0.00, 0.00),
(92, 2, '1502009', 'POUL Jerohan Ayam', 0.00, 0, 0.00, 0.00),
(93, 2, '1502010', 'POUL Hati Ayam', 0.00, 0, 0.00, 0.00),
(94, 2, '1502011', 'POUL Ampela Ayam', 0.00, 0, 0.00, 0.00),
(95, 2, '1502012', 'POUL Hati Ampela Ayam', 0.00, 0, 0.00, 0.00),
(96, 2, '1502013', 'POUL Usus Ayam', 0.00, 0, 0.00, 0.00),
(97, 2, '1502014', 'POUL Daging Ayam Giling', 0.00, 0, 0.00, 0.00),
(98, 2, '1502015', 'POUL Ayam Kampung', 0.00, 0, 0.00, 0.00),
(99, 2, '1502016', 'POUL Bebek Lokal', 0.00, 0, 0.00, 0.00),
(100, 2, '1502017', 'POUL Bebek Peking', 0.00, 0, 0.00, 0.00),
(101, 2, '1502018', 'POUL Kalkun', 0.00, 0, 0.00, 0.00),
(102, 2, '1502019', 'POUL Dada Kalkun', 0.00, 0, 0.00, 0.00),
(103, 2, '1502020', 'POUL Burung Dara', 0.00, 0, 0.00, 0.00),
(104, 2, '1502021', 'POUL Sosis Ayam Champ 1 Kg', 0.00, 0, 0.00, 0.00),
(105, 2, '1502022', 'POUL Sosis Ayam Cater 1 Kg', 0.00, 0, 0.00, 0.00),
(106, 2, '1502023', 'POUL Sosis Ayam Bernardi 500 Gr', 0.00, 0, 0.00, 0.00),
(107, 2, '1502024', 'POUL Breakfast Chicken Sausage (bran', 0.00, 0, 0.00, 0.00),
(108, 2, '1502025', 'POUL Chicken Chipolata Sausage (bran', 0.00, 0, 0.00, 0.00),
(109, 2, '1502026', 'POUL Chicken Lyoner Whole (brand) (b', 0.00, 0, 0.00, 0.00),
(110, 2, '1502027', 'POUL Chicken Bratwurst Sausage (bran', 0.00, 0, 0.00, 0.00),
(111, 2, '1502028', 'POUL Chicken Pastrami (brand) (berat', 0.00, 0, 0.00, 0.00),
(112, 2, '1502029', 'POUL Chicken Mushroom Lyoner (brand)', 0.00, 0, 0.00, 0.00),
(113, 2, '1502030', 'POUL Bakso Ayam (brand) (berat)', 0.00, 0, 0.00, 0.00),
(114, 2, '1502031', 'POUL Chicken Drumstick (brand) (bera', 0.00, 0, 0.00, 0.00),
(115, 2, '1502032', 'POUL Telur Ayam', 0.00, 0, 0.00, 0.00),
(116, 2, '1502033', 'POUL Telur Ayam Kampung', 0.00, 0, 0.00, 0.00),
(117, 2, '1502034', 'POUL Telur Puyuh Matang', 0.00, 0, 0.00, 0.00),
(118, 2, '1502035', 'POUL Telur Puyuh Mentah', 0.00, 0, 0.00, 0.00),
(119, 2, '1502036', 'POUL Telur Bebek', 0.00, 0, 0.00, 0.00),
(120, 2, '1502037', 'POUL Telur Bebek Asin Matang', 0.00, 0, 0.00, 0.00),
(121, 2, '1502038', 'POUL Telur Bebek Asin Mentah', 0.00, 0, 0.00, 0.00),
(122, 2, '1502039', 'POUL Sate Ayam', 0.00, 0, 0.00, 0.00),
(123, 2, '1502040', 'POUL Sate Telur Puyuh', 0.00, 0, 0.00, 0.00),
(124, 2, '1502041', 'POUL Sosis Ayam Soejasch 25gr/pcs 50', 0.00, 0, 0.00, 0.00),
(125, 3, '1503001', 'FS Frozen Norwegian Salmon', 0.00, 0, 0.00, 0.00),
(126, 3, '1503002', 'FS Frozen Salmon', 0.00, 0, 0.00, 0.00),
(127, 3, '1503003', 'FS Fresh Salmon', 0.00, 0, 0.00, 0.00),
(128, 3, '1503004', 'FS Smoked Salmon', 0.00, 0, 0.00, 0.00),
(129, 3, '1503005', 'FS Frozen Smoked Salmon', 0.00, 0, 0.00, 0.00),
(130, 3, '1503006', 'FS Gindara Fillet', 0.00, 0, 0.00, 0.00),
(131, 3, '1503007', 'FS Kakap Merah', 0.00, 0, 0.00, 0.00),
(132, 3, '1503008', 'FS Kakap Putih', 0.00, 0, 0.00, 0.00),
(133, 3, '1503009', 'FS Kakap Merah Fillet', 0.00, 0, 0.00, 0.00),
(134, 3, '1503010', 'FS Kakap Putih Fillet', 0.00, 0, 0.00, 0.00),
(135, 3, '1503011', 'FS Tuna Whole', 0.00, 0, 0.00, 0.00),
(136, 3, '1503012', 'FS Tuna Loin', 0.00, 0, 0.00, 0.00),
(137, 3, '1503013', 'FS Tuna Fillet', 0.00, 0, 0.00, 0.00),
(138, 3, '1503014', 'FS Tongkol', 0.00, 0, 0.00, 0.00),
(139, 3, '1503015', 'FS Bawal Laut Hitam', 0.00, 0, 0.00, 0.00),
(140, 3, '1503016', 'FS Bawal Laut Putih', 0.00, 0, 0.00, 0.00),
(141, 3, '1503017', 'FS Bawal Fillet', 0.00, 0, 0.00, 0.00),
(142, 3, '1503018', 'FS Ikan Ekor Kuning', 0.00, 0, 0.00, 0.00),
(143, 3, '1503019', 'FS Tenggiri Whole', 0.00, 0, 0.00, 0.00),
(144, 3, '1503020', 'FS Tenggiri Fillet', 0.00, 0, 0.00, 0.00),
(145, 3, '1503021', 'FS Dori Fillet', 0.00, 0, 0.00, 0.00),
(146, 3, '1503022', 'FS Skinless Dori Fillet', 0.00, 0, 0.00, 0.00),
(147, 3, '1503023', 'FS John Dory Fillet', 0.00, 0, 0.00, 0.00),
(148, 3, '1503024', 'FS Barakuda Fillet', 0.00, 0, 0.00, 0.00),
(149, 3, '1503025', 'FS Lemadang Fillet', 0.00, 0, 0.00, 0.00),
(150, 3, '1503026', 'FS Kerapu', 0.00, 0, 0.00, 0.00),
(151, 3, '1503027', 'FS Ikan Talang', 0.00, 0, 0.00, 0.00),
(152, 3, '1503028', 'FS Ikan Layang', 0.00, 0, 0.00, 0.00),
(153, 3, '1503029', 'FS Ikan Layar', 0.00, 0, 0.00, 0.00),
(154, 3, '1503030', 'FS Ikan Kembung', 0.00, 0, 0.00, 0.00),
(155, 3, '1503031', 'FS Ikan Kuwe', 0.00, 0, 0.00, 0.00),
(156, 3, '1503032', 'FS Ikan Manyung', 0.00, 0, 0.00, 0.00),
(157, 3, '1503033', 'FS Ikan Sebelah', 0.00, 0, 0.00, 0.00),
(158, 3, '1503034', 'FS Ikan Belanak', 0.00, 0, 0.00, 0.00),
(159, 3, '1503035', 'FS Giant Trevally', 0.00, 0, 0.00, 0.00),
(160, 3, '1503036', 'FS Ikan Cucut', 0.00, 0, 0.00, 0.00),
(161, 3, '1503037', 'FS Ikan Keting', 0.00, 0, 0.00, 0.00),
(162, 3, '1503038', 'FS Gurami', 0.00, 0, 0.00, 0.00),
(163, 3, '1503039', 'FS Bawal Air Tawar', 0.00, 0, 0.00, 0.00),
(164, 3, '1503040', 'FS Nila Merah', 0.00, 0, 0.00, 0.00),
(165, 3, '1503041', 'FS Nila Hitam', 0.00, 0, 0.00, 0.00),
(166, 3, '1503042', 'FS Bandeng Besar', 0.00, 0, 0.00, 0.00),
(167, 3, '1503043', 'FS Bandeng Kecil', 0.00, 0, 0.00, 0.00),
(168, 3, '1503044', 'FS Bandeng Presto', 0.00, 0, 0.00, 0.00),
(169, 3, '1503045', 'FS Patin', 0.00, 0, 0.00, 0.00),
(170, 3, '1503046', 'FS Lele', 0.00, 0, 0.00, 0.00),
(171, 3, '1503047', 'FS Mujair', 0.00, 0, 0.00, 0.00),
(172, 3, '1503048', 'FS Belut', 0.00, 0, 0.00, 0.00),
(173, 3, '1503049', 'FS Gabus', 0.00, 0, 0.00, 0.00),
(174, 3, '1503050', 'FS Wader', 0.00, 0, 0.00, 0.00),
(175, 3, '1503051', 'FS Ikan Mas', 0.00, 0, 0.00, 0.00),
(176, 3, '1503052', 'FS Udang 10-15', 0.00, 0, 0.00, 0.00),
(177, 3, '1503053', 'FS Udang 20-25', 0.00, 0, 0.00, 0.00),
(178, 3, '1503054', 'FS Udang 30-35', 0.00, 0, 0.00, 0.00),
(179, 3, '1503055', 'FS Udang 40-45', 0.00, 0, 0.00, 0.00),
(180, 3, '1503056', 'FS Udang 50-55', 0.00, 0, 0.00, 0.00),
(181, 3, '1503057', 'FS Udang 60-65', 0.00, 0, 0.00, 0.00),
(182, 3, '1503058', 'FS Udang Windu', 0.00, 0, 0.00, 0.00),
(183, 3, '1503059', 'FS Udang Kupas', 0.00, 0, 0.00, 0.00),
(184, 3, '1503060', 'FS Lobster', 0.00, 0, 0.00, 0.00),
(185, 3, '1503061', 'FS Baby Lobster', 0.00, 0, 0.00, 0.00),
(186, 3, '1503062', 'FS Cumi Kupas Bersih', 0.00, 0, 0.00, 0.00),
(187, 3, '1503063', 'FS Cumi Batok', 0.00, 0, 0.00, 0.00),
(188, 3, '1503064', 'FS Cumi Sotong', 0.00, 0, 0.00, 0.00),
(189, 3, '1503065', 'FS Kepiting', 0.00, 0, 0.00, 0.00),
(190, 3, '1503066', 'FS Kepiting Soka', 0.00, 0, 0.00, 0.00),
(191, 3, '1503067', 'FS Crab Meat', 0.00, 0, 0.00, 0.00),
(192, 3, '1503068', 'FS Crab Claw', 0.00, 0, 0.00, 0.00),
(193, 3, '1503069', 'FS Rajungan', 0.00, 0, 0.00, 0.00),
(194, 3, '1503070', 'FS Kerang Putih', 0.00, 0, 0.00, 0.00),
(195, 3, '1503071', 'FS Kerang Hijau', 0.00, 0, 0.00, 0.00),
(196, 3, '1503072', 'FS Kerang Hijau Kupas', 0.00, 0, 0.00, 0.00),
(197, 3, '1503073', 'FS Kerang Kipas', 0.00, 0, 0.00, 0.00),
(198, 3, '1503074', 'FS Kerang Dara', 0.00, 0, 0.00, 0.00),
(199, 3, '1503075', 'FS Kerang Dara Kupas', 0.00, 0, 0.00, 0.00),
(200, 3, '1503076', 'FS Scallop', 0.00, 0, 0.00, 0.00),
(201, 3, '1503077', 'FS Gurita Besar', 0.00, 0, 0.00, 0.00),
(202, 3, '1503078', 'FS Gurita Kecil', 0.00, 0, 0.00, 0.00),
(203, 3, '1503079', 'FS Ubur Ubur', 0.00, 0, 0.00, 0.00),
(204, 3, '1503080', 'FS Ikan Asin Jambal', 0.00, 0, 0.00, 0.00),
(205, 3, '1503081', 'FS Ikan Asin Gereh', 0.00, 0, 0.00, 0.00),
(206, 3, '1503082', 'FS Ikan Asin Peda', 0.00, 0, 0.00, 0.00),
(207, 3, '1503083', 'FS Ikan Asin Petek', 0.00, 0, 0.00, 0.00),
(208, 3, '1503084', 'FS Ikan Asin Jambrong', 0.00, 0, 0.00, 0.00),
(209, 3, '1503085', 'FS Ikan Asin Bulu Ayam', 0.00, 0, 0.00, 0.00),
(210, 3, '1503086', 'FS Ikan Asin Gabus', 0.00, 0, 0.00, 0.00),
(211, 3, '1503087', 'FS Ikan Asin Cumi', 0.00, 0, 0.00, 0.00),
(212, 3, '1503088', 'FS Ikan Pindang', 0.00, 0, 0.00, 0.00),
(213, 3, '1503089', 'FS Ikan Pe Panggang', 0.00, 0, 0.00, 0.00),
(214, 3, '1503090', 'FS Wader Goreng Crispy', 0.00, 0, 0.00, 0.00),
(215, 3, '1503091', 'FS Bakso Cumi (brand) (berat)', 0.00, 0, 0.00, 0.00),
(216, 3, '1503092', 'FS Bakso Ikan (brand) (berat)', 0.00, 0, 0.00, 0.00),
(217, 3, '1503093', 'FS Bakso Udang (brand) (berat)', 0.00, 0, 0.00, 0.00),
(218, 3, '1503094', 'FS Crab Stick (brand) (berat)', 0.00, 0, 0.00, 0.00),
(219, 3, '1503095', 'FS Canned Crab Meat (brand) (berat)', 0.00, 0, 0.00, 0.00),
(220, 3, '1503096', 'FS Tuna Chunk (brand) (berat)', 0.00, 0, 0.00, 0.00),
(221, 3, '1503097', 'FS Tail on Shrimp (brand) (berat)', 0.00, 0, 0.00, 0.00),
(222, 3, '1503098', 'FS Anchovy', 0.00, 0, 0.00, 0.00),
(223, 3, '1503099', 'FS Scallop Mitraku 500gr', 0.00, 0, 0.00, 0.00),
(224, 3, '1503100', 'FS Ikan Teri Putih', 0.00, 0, 0.00, 0.00),
(225, 3, '1503101', 'FS Ebi', 0.00, 0, 0.00, 0.00),
(226, 4, '1504001', 'FRUIT Alpukat', 0.00, 0, 0.00, 0.00),
(227, 4, '1504002', 'FRUIT Anggur Hijau', 0.00, 0, 0.00, 0.00),
(228, 4, '1504003', 'FRUIT Anggur Merah', 0.00, 0, 0.00, 0.00),
(229, 4, '1504004', 'FRUIT Apel Hijau Granny Smith', 0.00, 0, 0.00, 0.00),
(230, 4, '1504005', 'FRUIT Apel Hijau Manalagi', 0.00, 0, 0.00, 0.00),
(231, 4, '1504006', 'FRUIT Apel Merah Fuji', 0.00, 0, 0.00, 0.00),
(232, 4, '1504007', 'FRUIT Belimbing', 0.00, 0, 0.00, 0.00),
(233, 4, '1504008', 'FRUIT Bengkoang', 0.00, 0, 0.00, 0.00),
(234, 4, '1504009', 'FRUIT Blewah', 0.00, 0, 0.00, 0.00),
(235, 4, '1504010', 'FRUIT Buah Naga', 0.00, 0, 0.00, 0.00),
(236, 4, '1504011', 'FRUIT Duku', 0.00, 0, 0.00, 0.00),
(237, 4, '1504012', 'FRUIT Durian Kupas', 0.00, 0, 0.00, 0.00),
(238, 4, '1504013', 'FRUIT Jambu Air Hijau', 0.00, 0, 0.00, 0.00),
(239, 4, '1504014', 'FRUIT Jambu Air Merah', 0.00, 0, 0.00, 0.00),
(240, 4, '1504015', 'FRUIT Jambu Biji', 0.00, 0, 0.00, 0.00),
(241, 4, '1504016', 'FRUIT Jeruk Kino', 0.00, 0, 0.00, 0.00),
(242, 4, '1504017', 'FRUIT Jeruk Lemon Lokal', 0.00, 0, 0.00, 0.00),
(243, 4, '1504018', 'FRUIT Jeruk Lokal', 0.00, 0, 0.00, 0.00),
(244, 4, '1504019', 'FRUIT Jeruk Mandarin', 0.00, 0, 0.00, 0.00),
(245, 4, '1504020', 'FRUIT Jeruk Santang', 0.00, 0, 0.00, 0.00),
(246, 4, '1504021', 'FRUIT Jeruk Sunkis', 0.00, 0, 0.00, 0.00),
(247, 4, '1504022', 'FRUIT Kedondong', 0.00, 0, 0.00, 0.00),
(248, 4, '1504023', 'FRUIT Kelengkeng', 0.00, 0, 0.00, 0.00),
(249, 4, '1504024', 'FRUIT Kismis', 0.00, 0, 0.00, 0.00),
(250, 4, '1504025', 'FRUIT Kiwi', 0.00, 0, 0.00, 0.00),
(251, 4, '1504026', 'FRUIT Kurma', 0.00, 0, 0.00, 0.00),
(252, 4, '1504027', 'FRUIT Labu', 0.00, 0, 0.00, 0.00),
(253, 4, '1504028', 'FRUIT Mangga', 0.00, 0, 0.00, 0.00),
(254, 4, '1504029', 'FRUIT Mangga Muda', 0.00, 0, 0.00, 0.00),
(255, 4, '1504030', 'FRUIT Manggis', 0.00, 0, 0.00, 0.00),
(256, 4, '1504031', 'FRUIT Melon', 0.00, 0, 0.00, 0.00),
(257, 4, '1504032', 'FRUIT Melon Merah', 0.00, 0, 0.00, 0.00),
(258, 4, '1504033', 'FRUIT Nanas', 0.00, 0, 0.00, 0.00),
(259, 4, '1504034', 'FRUIT Nangka Kupas', 0.00, 0, 0.00, 0.00),
(260, 4, '1504035', 'FRUIT Pear Kuning', 0.00, 0, 0.00, 0.00),
(261, 4, '1504036', 'FRUIT Pear Xiang Lie', 0.00, 0, 0.00, 0.00),
(262, 4, '1504037', 'FRUIT Pepaya', 0.00, 0, 0.00, 0.00),
(263, 4, '1504038', 'FRUIT Pisang Batu', 0.00, 0, 0.00, 0.00),
(264, 4, '1504039', 'FRUIT Pisang Cavendish', 0.00, 0, 0.00, 0.00),
(265, 4, '1504040', 'FRUIT Pisang Kepok', 0.00, 0, 0.00, 0.00),
(266, 4, '1504041', 'FRUIT Pisang Mas', 0.00, 0, 0.00, 0.00),
(267, 4, '1504042', 'FRUIT Pisang Raja', 0.00, 0, 0.00, 0.00),
(268, 4, '1504043', 'FRUIT Pisang Susu', 0.00, 0, 0.00, 0.00),
(269, 4, '1504044', 'FRUIT Pisang Ulin', 0.00, 0, 0.00, 0.00),
(270, 4, '1504045', 'FRUIT Rambutan', 0.00, 0, 0.00, 0.00),
(271, 4, '1504046', 'FRUIT Salak', 0.00, 0, 0.00, 0.00),
(272, 4, '1504047', 'FRUIT Sawo', 0.00, 0, 0.00, 0.00),
(273, 4, '1504048', 'FRUIT Semangka Merah', 0.00, 0, 0.00, 0.00),
(274, 4, '1504049', 'FRUIT Sirsat', 0.00, 0, 0.00, 0.00),
(275, 4, '1504050', 'FRUIT Strawberry', 0.00, 0, 0.00, 0.00),
(276, 4, '1504051', 'FRUIT Sukun', 0.00, 0, 0.00, 0.00),
(277, 4, '1504052', 'FRUIT Anggur Merah Tanpa Biji', 0.00, 0, 0.00, 0.00),
(278, 4, '1504053', 'FRUIT Delima Merah', 0.00, 0, 0.00, 0.00),
(279, 4, '1504054', 'FRUIT Semangka Kuning', 0.00, 0, 0.00, 0.00),
(280, 4, '1504055', 'FRUIT Manisan Mangga Kering', 0.00, 0, 0.00, 0.00),
(281, 4, '1504056', 'FRUIT Manisan Plum Kering', 0.00, 0, 0.00, 0.00),
(282, 4, '1504057', 'FRUIT Manisan Kiwi Kering', 0.00, 0, 0.00, 0.00),
(283, 5, '1505001', 'OIL Minyak Goreng Bimoli 18L', 0.00, 0, 0.00, 0.00),
(284, 5, '1505002', 'OIL Soya Oil Happy 5L', 0.00, 0, 0.00, 0.00),
(285, 5, '1505003', 'OIL Soya Oil Misoya 5L', 0.00, 0, 0.00, 0.00),
(286, 5, '1505004', 'OIL Salad Oil Lily Flower 3L', 0.00, 0, 0.00, 0.00),
(287, 5, '1505005', 'OIL Corn Oil Mazola 3.5L', 0.00, 0, 0.00, 0.00),
(288, 5, '1505006', 'OIL Sun Flower Mazola 3.5L', 0.00, 0, 0.00, 0.00),
(289, 5, '1505007', 'OIL Canola Oil Mazola 1.5L', 0.00, 0, 0.00, 0.00),
(290, 5, '1505008', 'OIL Extra Virgin Olive Mueloliva 1L', 0.00, 0, 0.00, 0.00),
(291, 5, '1505009', 'OIL Extra Virgin Olive Bertolli 1L', 0.00, 0, 0.00, 0.00),
(292, 5, '1505010', 'OIL Extra Virgin Olive Filippo Berio', 0.00, 0, 0.00, 0.00),
(293, 5, '1505011', 'OIL Extra Virgin Olive La Rambla 5L', 0.00, 0, 0.00, 0.00),
(294, 5, '1505012', 'OIL Sesame Oil KIE Guang Hing 600 mL', 0.00, 0, 0.00, 0.00),
(295, 5, '1505013', 'OIL Sesame Oil SENG Guang Hing 600 m', 0.00, 0, 0.00, 0.00),
(296, 5, '1505014', 'OIL Sesame Oil Lee Kum Kee 1.75L', 0.00, 0, 0.00, 0.00),
(297, 5, '1505015', 'OIL Minyak Samin Cap Onta 2 kg', 0.00, 0, 0.00, 0.00),
(298, 5, '1505016', 'OIL Minyak Samin Bin Juber 250gr', 0.00, 0, 0.00, 0.00),
(299, 5, '1505017', 'OIL White Truffle Oil Urbani 250ml', 0.00, 0, 0.00, 0.00),
(300, 5, '1505018', 'OIL White Truffle Oil Casa Rinaldi 2', 0.00, 0, 0.00, 0.00),
(301, 5, '1505019', 'OIL Deep Fry Fat Palmia 15Kg', 0.00, 0, 0.00, 0.00),
(302, 6, '1506001', 'MILK UHT Diamond Full Cream 1L', 0.00, 0, 0.00, 0.00),
(303, 6, '1506002', 'MILK Fresh Diamond Plain 1L', 0.00, 0, 0.00, 0.00),
(304, 6, '1506003', 'MILK Fresh Greenfield  Plain  1L', 0.00, 0, 0.00, 0.00),
(305, 6, '1506004', 'MILK UHT Diamond Low Fat 1L', 0.00, 0, 0.00, 0.00),
(306, 6, '1506005', 'MILK Carnation Nestle Putih 380 gr', 0.00, 0, 0.00, 0.00),
(307, 6, '1506006', 'MILK Carnation Nestle Coklat 380 gr', 0.00, 0, 0.00, 0.00),
(308, 6, '1506007', 'MILK SKM Frisian Flag Putih 370 gr', 0.00, 0, 0.00, 0.00),
(309, 6, '1506008', 'MILK SKM Frisian Flag Coklat 370 gr', 0.00, 0, 0.00, 0.00),
(310, 6, '1506009', 'MILK SKM Frisian Flag Gold  370 gr', 0.00, 0, 0.00, 0.00),
(311, 6, '1506010', 'MILK Susu Sapi Segar', 0.00, 0, 0.00, 0.00),
(312, 6, '1506011', 'MILK Susu Bubuk', 0.00, 0, 0.00, 0.00),
(313, 6, '1506012', 'MILK Coklat Bubuk Ovaltine Classic 6', 0.00, 0, 0.00, 0.00),
(314, 6, '1506013', 'MILK Full Cream Powder (brand) 5 Kg', 0.00, 0, 0.00, 0.00),
(315, 6, '1506014', 'MILK Full Cream Powder Dancow 800 gr', 0.00, 0, 0.00, 0.00),
(316, 6, '1506015', 'MILK [?]', 0.00, 0, 0.00, 0.00),
(317, 7, '1507001', 'VEG Ale Sayur', 0.00, 0, 0.00, 0.00),
(318, 7, '1507002', 'VEG Arugula', 0.00, 0, 0.00, 0.00),
(319, 7, '1507003', 'VEG Asparagus Fresh', 0.00, 0, 0.00, 0.00),
(320, 7, '1507004', 'VEG Baby Kailan', 0.00, 0, 0.00, 0.00),
(321, 7, '1507005', 'VEG Bawang Bombay', 0.00, 0, 0.00, 0.00),
(322, 7, '1507006', 'VEG Bawang Merah Kupas', 0.00, 0, 0.00, 0.00),
(323, 7, '1507007', 'VEG Bawang Putih Kupas', 0.00, 0, 0.00, 0.00),
(324, 7, '1507008', 'VEG Bayam', 0.00, 0, 0.00, 0.00),
(325, 7, '1507009', 'VEG Bayam Merah', 0.00, 0, 0.00, 0.00),
(326, 7, '1507010', 'VEG Belimbing Wuluh', 0.00, 0, 0.00, 0.00),
(327, 7, '1507011', 'VEG Tempe', 0.00, 0, 0.00, 0.00),
(328, 7, '1507012', 'VEG Brokoli', 0.00, 0, 0.00, 0.00),
(329, 7, '1507013', 'VEG Buncis', 0.00, 0, 0.00, 0.00),
(330, 7, '1507014', 'VEG Baby Buncis', 0.00, 0, 0.00, 0.00),
(331, 7, '1507015', 'VEG Bunga Kol', 0.00, 0, 0.00, 0.00),
(332, 7, '1507016', 'VEG Bunga Sedap Malam-Kimlo', 0.00, 0, 0.00, 0.00),
(333, 7, '1507017', 'VEG Bunga Turi', 0.00, 0, 0.00, 0.00),
(334, 7, '1507018', 'VEG Cabai Hijau Besar', 0.00, 0, 0.00, 0.00),
(335, 7, '1507019', 'VEG Cabe Merah Besar', 0.00, 0, 0.00, 0.00),
(336, 7, '1507020', 'VEG Cabe Merah Keriting', 0.00, 0, 0.00, 0.00),
(337, 7, '1507021', 'VEG Cabe Rawit', 0.00, 0, 0.00, 0.00),
(338, 7, '1507022', 'VEG Cabe Rawit Merah', 0.00, 0, 0.00, 0.00),
(339, 7, '1507023', 'VEG Cabai Rawit Hijau', 0.00, 0, 0.00, 0.00),
(340, 7, '1507024', 'VEG Cuciwis', 0.00, 0, 0.00, 0.00),
(341, 7, '1507025', 'VEG Labu Siam', 0.00, 0, 0.00, 0.00),
(342, 7, '1507026', 'VEG Daun Bawang', 0.00, 0, 0.00, 0.00),
(343, 7, '1507027', 'VEG Daun Bawang Prei', 0.00, 0, 0.00, 0.00),
(344, 7, '1507028', 'VEG Daun Jati', 0.00, 0, 0.00, 0.00),
(345, 7, '1507029', 'VEG Daun Kedondong', 0.00, 0, 0.00, 0.00),
(346, 7, '1507030', 'VEG Daun Kucai', 0.00, 0, 0.00, 0.00),
(347, 7, '1507031', 'VEG Daun Melinjo', 0.00, 0, 0.00, 0.00),
(348, 7, '1507032', 'VEG Daun Pakis', 0.00, 0, 0.00, 0.00),
(349, 7, '1507033', 'VEG Daun Pandan', 0.00, 0, 0.00, 0.00),
(350, 7, '1507034', 'VEG Daun Pepaya', 0.00, 0, 0.00, 0.00),
(351, 7, '1507035', 'VEG Daun Pisang', 0.00, 0, 0.00, 0.00),
(352, 7, '1507036', 'VEG Daun Semanggi', 0.00, 0, 0.00, 0.00),
(353, 7, '1507037', 'VEG Daun Singkong', 0.00, 0, 0.00, 0.00),
(354, 7, '1507038', 'VEG Daun Wortel', 0.00, 0, 0.00, 0.00),
(355, 7, '1507039', 'VEG Gembili', 0.00, 0, 0.00, 0.00),
(356, 7, '1507040', 'VEG Ham Choy/Sawi Asin', 0.00, 0, 0.00, 0.00),
(357, 7, '1507041', 'VEG Jagung Manis', 0.00, 0, 0.00, 0.00),
(358, 7, '1507042', 'VEG Jagung Muda', 0.00, 0, 0.00, 0.00),
(359, 7, '1507043', 'VEG Jagung Pipil Kering', 0.00, 0, 0.00, 0.00),
(360, 7, '1507044', 'VEG Jalapeno Fresh', 0.00, 0, 0.00, 0.00),
(361, 7, '1507045', 'VEG Jamur Es', 0.00, 0, 0.00, 0.00),
(362, 7, '1507046', 'VEG Jamur Kancing Fresh', 0.00, 0, 0.00, 0.00),
(363, 7, '1507047', 'VEG Jamur Kuping', 0.00, 0, 0.00, 0.00),
(364, 7, '1507048', 'VEG Jamur Merang', 0.00, 0, 0.00, 0.00),
(365, 7, '1507049', 'VEG Jamur Putih', 0.00, 0, 0.00, 0.00),
(366, 7, '1507050', 'VEG Jamur Salju', 0.00, 0, 0.00, 0.00),
(367, 7, '1507051', 'VEG Jamur Shiitake', 0.00, 0, 0.00, 0.00),
(368, 7, '1507052', 'VEG Jamur Tiram', 0.00, 0, 0.00, 0.00),
(369, 7, '1507053', 'VEG Jantung Pisang', 0.00, 0, 0.00, 0.00),
(370, 7, '1507054', 'VEG Jengkol', 0.00, 0, 0.00, 0.00),
(371, 7, '1507055', 'VEG Jeruk Limau', 0.00, 0, 0.00, 0.00),
(372, 7, '1507056', 'VEG Jeruk Nipis', 0.00, 0, 0.00, 0.00),
(373, 7, '1507057', 'VEG Kailan', 0.00, 0, 0.00, 0.00),
(374, 7, '1507058', 'VEG Kacang Panjang', 0.00, 0, 0.00, 0.00),
(375, 7, '1507059', 'VEG Kangkung', 0.00, 0, 0.00, 0.00),
(376, 7, '1507060', 'VEG Kacang Polong Fresh', 0.00, 0, 0.00, 0.00),
(377, 7, '1507061', 'VEG Kelapa Muda', 0.00, 0, 0.00, 0.00),
(378, 7, '1507062', 'VEG Kelapa Muda Parut', 0.00, 0, 0.00, 0.00),
(379, 7, '1507063', 'VEG Kelapa Parut', 0.00, 0, 0.00, 0.00),
(380, 7, '1507064', 'VEG Kentang', 0.00, 0, 0.00, 0.00),
(381, 7, '1507065', 'VEG Kentang Baby', 0.00, 0, 0.00, 0.00),
(382, 7, '1507066', 'VEG Kol', 0.00, 0, 0.00, 0.00),
(383, 7, '1507067', 'VEG Kol Merah', 0.00, 0, 0.00, 0.00),
(384, 7, '1507068', 'VEG Timun Jepang', 0.00, 0, 0.00, 0.00),
(385, 7, '1507069', 'VEG Lencak', 0.00, 0, 0.00, 0.00),
(386, 7, '1507070', 'VEG Nangka Muda', 0.00, 0, 0.00, 0.00),
(387, 7, '1507071', 'VEG Lettuce Romaine', 0.00, 0, 0.00, 0.00),
(388, 7, '1507072', 'VEG Selada Keriting', 0.00, 0, 0.00, 0.00),
(389, 7, '1507073', 'VEG Lettuce Head Ice Berg', 0.00, 0, 0.00, 0.00),
(390, 7, '1507074', 'VEG Selada Keriting Merah', 0.00, 0, 0.00, 0.00),
(391, 7, '1507075', 'VEG Lettuce Siomak', 0.00, 0, 0.00, 0.00),
(392, 7, '1507076', 'VEG Melinjo', 0.00, 0, 0.00, 0.00),
(393, 7, '1507077', 'VEG Kacang Kulit Mentah', 0.00, 0, 0.00, 0.00),
(394, 7, '1507078', 'VEG Okra', 0.00, 0, 0.00, 0.00),
(395, 7, '1507079', 'VEG Gambas', 0.00, 0, 0.00, 0.00),
(396, 7, '1507080', 'VEG Paprika Hijau', 0.00, 0, 0.00, 0.00),
(397, 7, '1507081', 'VEG Paprika Kuning', 0.00, 0, 0.00, 0.00),
(398, 7, '1507082', 'VEG Paprika Merah', 0.00, 0, 0.00, 0.00),
(399, 7, '1507083', 'VEG Pare', 0.00, 0, 0.00, 0.00),
(400, 7, '1507084', 'VEG Petai Kupas', 0.00, 0, 0.00, 0.00),
(401, 7, '1507085', 'VEG Petai Whole', 0.00, 0, 0.00, 0.00),
(402, 7, '1507086', 'VEG Petai Cina', 0.00, 0, 0.00, 0.00),
(403, 7, '1507087', 'VEG Pokcoy', 0.00, 0, 0.00, 0.00),
(404, 7, '1507088', 'VEG Labu kuning', 0.00, 0, 0.00, 0.00),
(405, 7, '1507089', 'VEG Rebung', 0.00, 0, 0.00, 0.00),
(406, 7, '1507090', 'VEG Bit Merah', 0.00, 0, 0.00, 0.00),
(407, 7, '1507091', 'VEG Rumput Laut', 0.00, 0, 0.00, 0.00),
(408, 7, '1507092', 'VEG Sawi Hijau', 0.00, 0, 0.00, 0.00),
(409, 7, '1507093', 'VEG Sawi Putih', 0.00, 0, 0.00, 0.00),
(410, 7, '1507094', 'VEG Selada Air', 0.00, 0, 0.00, 0.00),
(411, 7, '1507095', 'VEG Singkong', 0.00, 0, 0.00, 0.00),
(412, 7, '1507096', 'VEG Singkong Parut', 0.00, 0, 0.00, 0.00),
(413, 7, '1507097', 'VEG Tahu Mentah Besar', 0.00, 0, 0.00, 0.00),
(414, 7, '1507098', 'VEG Taoge Panjang', 0.00, 0, 0.00, 0.00),
(415, 7, '1507099', 'VEG Taoge Pendek', 0.00, 0, 0.00, 0.00),
(416, 7, '1507100', 'VEG Tempe Gembus', 0.00, 0, 0.00, 0.00),
(417, 7, '1507101', 'VEG Terong Bulat Kecil', 0.00, 0, 0.00, 0.00),
(418, 7, '1507102', 'VEG Terong', 0.00, 0, 0.00, 0.00),
(419, 7, '1507103', 'VEG Timun', 0.00, 0, 0.00, 0.00),
(420, 7, '1507104', 'VEG Tofu Telur Ayam Kong Kee 140 gr', 0.00, 0, 0.00, 0.00),
(421, 7, '1507105', 'VEG Tomat', 0.00, 0, 0.00, 0.00),
(422, 7, '1507106', 'VEG Tomat Cherry', 0.00, 0, 0.00, 0.00),
(423, 7, '1507107', 'VEG Tomat Hijau', 0.00, 0, 0.00, 0.00),
(424, 7, '1507108', 'VEG Lobak Putih', 0.00, 0, 0.00, 0.00),
(425, 7, '1507109', 'VEG Ubi Putih', 0.00, 0, 0.00, 0.00),
(426, 7, '1507110', 'VEG Ubi Ungu', 0.00, 0, 0.00, 0.00),
(427, 7, '1507111', 'VEG Ubi Oranye', 0.00, 0, 0.00, 0.00),
(428, 7, '1507112', 'VEG Ubi Cilembu', 0.00, 0, 0.00, 0.00),
(429, 7, '1507113', 'VEG Uwi', 0.00, 0, 0.00, 0.00),
(430, 7, '1507114', 'VEG Wortel Local', 0.00, 0, 0.00, 0.00),
(431, 7, '1507115', 'VEG Wortel Baby', 0.00, 0, 0.00, 0.00),
(432, 7, '1507116', 'VEG Zucchini', 0.00, 0, 0.00, 0.00),
(433, 7, '1507117', 'VEG Batang Talas', 0.00, 0, 0.00, 0.00),
(434, 8, '1508001', 'COFT Coffee Sachet Logo', 0.00, 0, 0.00, 0.00),
(435, 8, '1508002', 'COFT Creamer Sachet Logo', 0.00, 0, 0.00, 0.00),
(436, 8, '1508003', 'COFT Coffee Bean Illy 3 Kg', 0.00, 0, 0.00, 0.00),
(437, 8, '1508004', 'COFT Coffee Meglio Viktory Powder 50', 0.00, 0, 0.00, 0.00),
(438, 8, '1508005', 'COFT Coffee (brand) 1 Kg', 0.00, 0, 0.00, 0.00),
(439, 8, '1508006', 'COFT Luwak White Koffie 400gr', 0.00, 0, 0.00, 0.00),
(440, 8, '1508007', 'COFT Coffee Maleo Classic Ground 1 K', 0.00, 0, 0.00, 0.00),
(441, 8, '1508008', 'COFT Coffee Merah Putih Ground', 0.00, 0, 0.00, 0.00),
(442, 8, '1508009', 'COFT Coffee Mayang Blend Beans', 0.00, 0, 0.00, 0.00),
(443, 8, '1508010', 'COFT Tea Logo', 0.00, 0, 0.00, 0.00),
(444, 8, '1508011', 'COFT Teh Celup Sariwangi 100 sachet', 0.00, 0, 0.00, 0.00),
(445, 8, '1508012', 'COFT Teh Celup Sariwangi 50 sachet', 0.00, 0, 0.00, 0.00),
(446, 8, '1508013', 'COFT Tea Dilmah Commomile 100 sachet', 0.00, 0, 0.00, 0.00),
(447, 8, '1508014', 'COFT Tea Dilmah Darjeeling 100 sache', 0.00, 0, 0.00, 0.00),
(448, 8, '1508015', 'COFT Tea Dilmah Earl Grey 100 sachet', 0.00, 0, 0.00, 0.00),
(449, 8, '1508016', 'COFT Tea Dilmah English B\'Fast 100 s', 0.00, 0, 0.00, 0.00),
(450, 8, '1508017', 'COFT Tea Dilmah Jasmin 100 sachet', 0.00, 0, 0.00, 0.00),
(451, 8, '1508018', 'COFT Tea Dilmah Oolong 100 sachet', 0.00, 0, 0.00, 0.00),
(452, 8, '1508019', 'COFT Tea Dilmah Peppermint 100 sache', 0.00, 0, 0.00, 0.00),
(453, 8, '1508020', 'COFT Teh Bubuk Tong Tji Super 40gr', 0.00, 0, 0.00, 0.00),
(454, 8, '1508021', 'COFT Teh Bubuk Tong Tji Super 80gr', 0.00, 0, 0.00, 0.00),
(455, 8, '1508022', 'COFT Teh Celup Tong Tji Asli 25 sach', 0.00, 0, 0.00, 0.00),
(456, 8, '1508023', 'COFT Teh Celup Tong Tji Jasmine 25 s', 0.00, 0, 0.00, 0.00),
(457, 8, '1508024', 'COFT Thai Tea Red Tea 400gr', 0.00, 0, 0.00, 0.00),
(458, 8, '1508025', 'COFT Thai Tea Green Tea 400gr', 0.00, 0, 0.00, 0.00),
(459, 8, '1508026', 'COFT Nescafe Classic 120gr', 0.00, 0, 0.00, 0.00),
(460, 8, '1508027', 'COFT Teh Tarik Max Tea 125gr', 0.00, 0, 0.00, 0.00),
(461, 9, '1509001', 'DP Ice Cream Diamond Chocolate 8L', 0.00, 0, 0.00, 0.00),
(462, 9, '1509002', 'DP Ice Cream Diamond Coconut 8L', 0.00, 0, 0.00, 0.00),
(463, 9, '1509003', 'DP Ice Cream Diamond Durian 8L', 0.00, 0, 0.00, 0.00),
(464, 9, '1509004', 'DP Ice Cream Diamond Mocca 8L', 0.00, 0, 0.00, 0.00),
(465, 9, '1509005', 'DP Ice Cream Diamond Rum Raisin 8L', 0.00, 0, 0.00, 0.00),
(466, 9, '1509006', 'DP Ice Cream Diamond Strawberry 8L', 0.00, 0, 0.00, 0.00),
(467, 9, '1509007', 'DP Ice Cream Diamond Vanilla 8L', 0.00, 0, 0.00, 0.00),
(468, 9, '1509008', 'DP Ice Cream Campina Chocolate 5L', 0.00, 0, 0.00, 0.00),
(469, 9, '1509009', 'DP Ice Cream Campina Strawberry 5L', 0.00, 0, 0.00, 0.00),
(470, 9, '1509010', 'DP Ice Cream Campina Vanilla 5L', 0.00, 0, 0.00, 0.00),
(471, 9, '1509011', 'DP Almond Ground Blanched (brand) (b', 0.00, 0, 0.00, 0.00),
(472, 9, '1509012', 'DP Baking Powder Hercules', 0.00, 0, 0.00, 0.00),
(473, 9, '1509013', 'DP Baking Soda 1 Kg', 0.00, 0, 0.00, 0.00),
(474, 9, '1509014', 'DP Baking Soda 100gr', 0.00, 0, 0.00, 0.00),
(475, 9, '1509015', 'DP Bread Improver Alpaga Puratos Sof', 0.00, 0, 0.00, 0.00),
(476, 9, '1509016', 'DP Bread Mix Ireks Sovital 12.5Kg', 0.00, 0, 0.00, 0.00),
(477, 9, '1509017', 'DP Bread Mix Ireks Rex Milano 12.5Kg', 0.00, 0, 0.00, 0.00),
(478, 9, '1509018', 'DP Bread Mix Ireks Rex Bavarian Dark', 0.00, 0, 0.00, 0.00),
(479, 9, '1509019', 'DP Bread Mix Ireks Pumpernickel 12.5', 0.00, 0, 0.00, 0.00),
(480, 9, '1509020', 'DP Bread Mix Ireks Avena 12.5Kg', 0.00, 0, 0.00, 0.00),
(481, 9, '1509021', 'DP Burger Bun Small', 0.00, 0, 0.00, 0.00),
(482, 9, '1509022', 'DP Butter Cream', 0.00, 0, 0.00, 0.00),
(483, 9, '1509023', 'DP Butter Margarine Palmia 200gr', 0.00, 0, 0.00, 0.00),
(484, 9, '1509024', 'DP Butter Portion Anchor Salted 10gr', 0.00, 0, 0.00, 0.00),
(485, 9, '1509025', 'DP Butter Portion Anchor Unsalted  1', 0.00, 0, 0.00, 0.00),
(486, 9, '1509026', 'DP Butter Unsalted Bulk 25 Kg', 0.00, 0, 0.00, 0.00),
(487, 9, '1509027', 'DP Butter Wisman Salted  1Kg', 0.00, 0, 0.00, 0.00),
(488, 9, '1509028', 'DP Cheese Brie (brand) (berat)', 0.00, 0, 0.00, 0.00),
(489, 9, '1509029', 'DP Cheese Camembert (brand) (berat)', 0.00, 0, 0.00, 0.00),
(490, 9, '1509030', 'DP Cheese Cream Tatura 1Kg', 0.00, 0, 0.00, 0.00),
(491, 9, '1509031', 'DP Cheese Edam (brand) (berat)', 0.00, 0, 0.00, 0.00),
(492, 9, '1509032', 'DP Cheese Emmenthal (brand) (berat)', 0.00, 0, 0.00, 0.00),
(493, 9, '1509033', 'DP Cheese Fetta Dodoni (berat)', 0.00, 0, 0.00, 0.00),
(494, 9, '1509034', 'DP Cheese Fetta Lemnos 180gr', 0.00, 0, 0.00, 0.00),
(495, 9, '1509035', 'DP Cheese Grated Parmesan (brand) (b', 0.00, 0, 0.00, 0.00),
(496, 9, '1509036', 'DP Cheese Hard Grana Padano Wheel', 0.00, 0, 0.00, 0.00),
(497, 9, '1509037', 'DP Cheese Low Moist Mozzarella (bran', 0.00, 0, 0.00, 0.00),
(498, 9, '1509038', 'DP Cheese Mayo Japanese Kewpie 1Kg', 0.00, 0, 0.00, 0.00),
(499, 9, '1509039', 'DP Cheese Mozzarella Block Arla 2.3K', 0.00, 0, 0.00, 0.00),
(500, 9, '1509040', 'DP Cheese Parmesan (brand) (berat)', 0.00, 0, 0.00, 0.00),
(501, 9, '1509041', 'DP Cheese Parmesan Block Grana Padan', 0.00, 0, 0.00, 0.00),
(502, 9, '1509042', 'DP Cheese Processed Block Koji Std (', 0.00, 0, 0.00, 0.00),
(503, 9, '1509043', 'DP Cheese Processed Cheddar Prochiz', 0.00, 0, 0.00, 0.00),
(504, 9, '1509044', 'DP Cheese Red Cheddar (brand) (berat', 0.00, 0, 0.00, 0.00),
(505, 9, '1509045', 'DP Cheese Sandwich Sliced Bega (bera', 0.00, 0, 0.00, 0.00),
(506, 9, '1509046', 'DP Cheese Slice Kraft Single 10 Slic', 0.00, 0, 0.00, 0.00),
(507, 9, '1509047', 'DP Cheese Slice Prochiz 10 Slices', 0.00, 0, 0.00, 0.00),
(508, 9, '1509048', 'DP Cheese Yellow Cheddar (brand) (be', 0.00, 0, 0.00, 0.00),
(509, 9, '1509049', 'DP Choco Chips', 0.00, 0, 0.00, 0.00),
(510, 9, '1509050', 'DP Choco Chips 400gr', 0.00, 0, 0.00, 0.00),
(511, 9, '1509051', 'DP Choco Chips Colatta 5Kg', 0.00, 0, 0.00, 0.00),
(512, 9, '1509052', 'DP Choco Chips Rainbow', 0.00, 0, 0.00, 0.00),
(513, 9, '1509053', 'DP Cocoa Powder Alkalized Bensdrop (', 0.00, 0, 0.00, 0.00),
(514, 9, '1509054', 'DP Cokelat Block (brand) (berat)', 0.00, 0, 0.00, 0.00),
(515, 9, '1509055', 'DP Cokelat Cha Cha Delfi 80gr', 0.00, 0, 0.00, 0.00),
(516, 9, '1509056', 'DP Cokelat Compound Baking Stick (be', 0.00, 0, 0.00, 0.00),
(517, 9, '1509057', 'DP Cokelat Compound Dark 1Kg', 0.00, 0, 0.00, 0.00),
(518, 9, '1509058', 'DP Cokelat Compound Dark 5Kg', 0.00, 0, 0.00, 0.00),
(519, 9, '1509059', 'DP Cokelat Compound White 1Kg', 0.00, 0, 0.00, 0.00),
(520, 9, '1509060', 'DP Cokelat Compound White 5Kg', 0.00, 0, 0.00, 0.00),
(521, 9, '1509061', 'DP Cokelat Powder Van Houten 180gr', 0.00, 0, 0.00, 0.00),
(522, 9, '1509062', 'DP Cooking Cream Elle & Vire 1L', 0.00, 0, 0.00, 0.00),
(523, 9, '1509063', 'DP Cream Cheese American (brand) (be', 0.00, 0, 0.00, 0.00),
(524, 9, '1509064', 'DP Cream Cheese Processed Koji 1Kg', 0.00, 0, 0.00, 0.00),
(525, 9, '1509065', 'DP Croissant B&P 160 x 30gr', 0.00, 0, 0.00, 0.00),
(526, 9, '1509066', 'DP Danish Chocolate B&P 200 x 30gr', 0.00, 0, 0.00, 0.00),
(527, 9, '1509067', 'DP Danish Pastry Sheet B&P 15 x 500g', 0.00, 0, 0.00, 0.00),
(528, 9, '1509068', 'DP Danish Raisin B&P 160 x 35gr', 0.00, 0, 0.00, 0.00),
(529, 9, '1509069', 'DP Donut Dusting (brand) 5Kg', 0.00, 0, 0.00, 0.00),
(530, 9, '1509070', 'DP Donuts Glaze Strawberry (brand) 5', 0.00, 0, 0.00, 0.00),
(531, 9, '1509071', 'DP Donuts Glaze Vanilla (brand) 5Kg', 0.00, 0, 0.00, 0.00),
(532, 9, '1509072', 'DP Donutz Glaze Mocca (brand) 5Kg', 0.00, 0, 0.00, 0.00),
(533, 9, '1509073', 'DP Perasa Red Bell Cokelat 55ml', 0.00, 0, 0.00, 0.00),
(534, 9, '1509074', 'DP Perasa Red Bell Durian 55ml', 0.00, 0, 0.00, 0.00),
(535, 9, '1509075', 'DP Perasa Red Bell Jeruk  55ml', 0.00, 0, 0.00, 0.00),
(536, 9, '1509076', 'DP Perasa Red Bell Melon 55ml', 0.00, 0, 0.00, 0.00),
(537, 9, '1509077', 'DP Perasa Red Bell Mocca 55ml', 0.00, 0, 0.00, 0.00),
(538, 9, '1509078', 'DP Perasa Red Bell Nangka 55ml', 0.00, 0, 0.00, 0.00),
(539, 9, '1509079', 'DP Perasa Red Bell Pandan 55ml', 0.00, 0, 0.00, 0.00),
(540, 9, '1509080', 'DP Perasa Red Bell Strawbery 55ml', 0.00, 0, 0.00, 0.00),
(541, 9, '1509081', 'DP Perasa Red Bell Vanilla 55ml', 0.00, 0, 0.00, 0.00),
(542, 9, '1509082', 'DP Vanilla Extrax Jansen Flavour 1Kg', 0.00, 0, 0.00, 0.00),
(543, 9, '1509083', 'DP Perasa Green Tea Golden Brown 100', 0.00, 0, 0.00, 0.00),
(544, 9, '1509084', 'DP Fruit Filling Fruitanera Apple 3K', 0.00, 0, 0.00, 0.00),
(545, 9, '1509085', 'DP Fruit Filling Fruitanera Blueberr', 0.00, 0, 0.00, 0.00),
(546, 9, '1509086', 'DP Frz Blueberry', 0.00, 0, 0.00, 0.00),
(547, 9, '1509087', 'DP Frz Raspberry', 0.00, 0, 0.00, 0.00),
(548, 9, '1509088', 'DP Gelatin Leaf Sheet (brand) (berat', 0.00, 0, 0.00, 0.00),
(549, 9, '1509089', 'DP Gelatin Powder (brand) (berat)', 0.00, 0, 0.00, 0.00),
(550, 9, '1509090', 'DP Glaze Apricot Frutaneira 7Kg', 0.00, 0, 0.00, 0.00),
(551, 9, '1509091', 'DP Glukosa Powder (brand) (berat)', 0.00, 0, 0.00, 0.00),
(552, 9, '1509092', 'DP Gula Halus', 0.00, 0, 0.00, 0.00),
(553, 9, '1509093', 'DP Icing Sugar Fiesta 15Kg', 0.00, 0, 0.00, 0.00),
(554, 9, '1509094', 'DP Icing Sugar 500gr', 0.00, 0, 0.00, 0.00),
(555, 9, '1509095', 'DP Japanese Cranberry', 0.00, 0, 0.00, 0.00),
(556, 9, '1509096', 'DP Margarine Blue Band Serbaguna 200', 0.00, 0, 0.00, 0.00),
(557, 9, '1509097', 'DP Margarine Palmia Special 15Kg', 0.00, 0, 0.00, 0.00),
(558, 9, '1509098', 'DP Margarine Palmia Supercake 15Kg', 0.00, 0, 0.00, 0.00),
(559, 9, '1509099', 'DP Mayonnaise Bestfoods 3L', 0.00, 0, 0.00, 0.00),
(560, 9, '1509100', 'DP Mayonnaise Maestro 1Kg', 0.00, 0, 0.00, 0.00),
(561, 9, '1509101', 'DP Meises Coklat', 0.00, 0, 0.00, 0.00),
(562, 9, '1509102', 'DP Meises Rainbow', 0.00, 0, 0.00, 0.00),
(563, 9, '1509103', 'DP Mentega Putih', 0.00, 0, 0.00, 0.00),
(564, 9, '1509104', 'DP Mentega Putih Peerless (berat)', 0.00, 0, 0.00, 0.00),
(565, 9, '1509105', 'DP Ovalett Koepoe 30gr', 0.00, 0, 0.00, 0.00),
(566, 9, '1509106', 'DP Ovalett (brand) 1Kg', 0.00, 0, 0.00, 0.00),
(567, 9, '1509107', 'DP Pasta Pandan Flavour Diamond (ber', 0.00, 0, 0.00, 0.00),
(568, 9, '1509108', 'DP Pasta Panda Fill Yu Ai 1Kg', 0.00, 0, 0.00, 0.00),
(569, 9, '1509109', 'DP Pasta Tiramisu Flavour Jansen 1Kg', 0.00, 0, 0.00, 0.00),
(570, 9, '1509110', 'DP Pewarna Makanan Koepoe Biru 30ml', 0.00, 0, 0.00, 0.00),
(571, 9, '1509111', 'DP Pewarna Makanan Koepoe Cokelat 30', 0.00, 0, 0.00, 0.00),
(572, 9, '1509112', 'DP Pewarna Makanan Koepoe Hijau Muda', 0.00, 0, 0.00, 0.00),
(573, 9, '1509113', 'DP Pewarna Makanan Koepoe Kuning Mud', 0.00, 0, 0.00, 0.00),
(574, 9, '1509114', 'DP Pewarna Makanan Koepoe Kuning Tua', 0.00, 0, 0.00, 0.00),
(575, 9, '1509115', 'DP Pewarna Makanan Koepoe Merah Cabe', 0.00, 0, 0.00, 0.00),
(576, 9, '1509116', 'DP Pewarna Makanan Koepoe Merah Rose', 0.00, 0, 0.00, 0.00),
(577, 9, '1509117', 'DP Pewarna Makanan Koepoe Merah Tua', 0.00, 0, 0.00, 0.00),
(578, 9, '1509118', 'DP Pewarna Makanan Koepoe Orange 30m', 0.00, 0, 0.00, 0.00),
(579, 9, '1509119', 'DP Pewarna Makanan Koepoe Ungu 30ml', 0.00, 0, 0.00, 0.00),
(580, 9, '1509120', 'DP Praline Mix (brand) (berat)', 0.00, 0, 0.00, 0.00),
(581, 9, '1509121', 'DP Puff Pastry Mix Butter Bon chef (', 0.00, 0, 0.00, 0.00),
(582, 9, '1509122', 'DP Puff Pastry Sheet (brand) (berat)', 0.00, 0, 0.00, 0.00),
(583, 9, '1509123', 'DP Ragi Instant Fermipan Brown 500gr', 0.00, 0, 0.00, 0.00),
(584, 9, '1509124', 'DP Ragi Instant Angel Brown 500gr', 0.00, 0, 0.00, 0.00),
(585, 9, '1509125', 'DP RAP Instant Custard Pwdr Zeelandi', 0.00, 0, 0.00, 0.00),
(586, 9, '1509126', 'DP Red Cherry Diana Maraschino (bera', 0.00, 0, 0.00, 0.00),
(587, 9, '1509127', 'DP Selai Blueberry Edna', 0.00, 0, 0.00, 0.00),
(588, 9, '1509128', 'DP Selai Blueberry Palletta Excellen', 0.00, 0, 0.00, 0.00),
(589, 9, '1509129', 'DP Selai Kacang Morin', 0.00, 0, 0.00, 0.00),
(590, 9, '1509130', 'DP Selai Kacang Welco 275gr', 0.00, 0, 0.00, 0.00),
(591, 9, '1509131', 'DP Selai Lemon Paletta Excellent 5Kg', 0.00, 0, 0.00, 0.00),
(592, 9, '1509132', 'DP Selai Nanas Edna', 0.00, 0, 0.00, 0.00),
(593, 9, '1509133', 'DP Selai Strawberry Edna', 0.00, 0, 0.00, 0.00),
(594, 9, '1509134', 'DP Selai Strawberry Palletta Excelle', 0.00, 0, 0.00, 0.00),
(595, 9, '1509135', 'DP Selai Topp\'g Mariza Bluebry 200gr', 0.00, 0, 0.00, 0.00),
(596, 9, '1509136', 'DP Selai Topp\'g Mariza Cokelat 200gr', 0.00, 0, 0.00, 0.00),
(597, 9, '1509137', 'DP Selai Topp\'g Mariza Cokelat 350gr', 0.00, 0, 0.00, 0.00),
(598, 9, '1509138', 'DP Selai Topp\'g Mariza Strwbry 200gr', 0.00, 0, 0.00, 0.00),
(599, 9, '1509139', 'DP Selai Topp\'g Mariza Strwbry 350gr', 0.00, 0, 0.00, 0.00),
(600, 9, '1509140', 'DP Sukade', 0.00, 0, 0.00, 0.00),
(601, 9, '1509141', 'DP Sweet Banana Filling Prosperich (', 0.00, 0, 0.00, 0.00),
(602, 9, '1509142', 'DP Sweet Cherries Dark Blue Pacific', 0.00, 0, 0.00, 0.00),
(603, 9, '1509143', 'DP Swiss Line Dark Coins Carma', 0.00, 0, 0.00, 0.00),
(604, 9, '1509144', 'DP Swiss Line White Coins Carma', 0.00, 0, 0.00, 0.00),
(605, 9, '1509145', 'DP Tepung Custard Hercules 300gr', 0.00, 0, 0.00, 0.00),
(606, 9, '1509146', 'DP Tepung Custard Hercules', 0.00, 0, 0.00, 0.00),
(607, 9, '1509147', 'DP Trimits Rainbow', 0.00, 0, 0.00, 0.00),
(608, 9, '1509148', 'DP Wafer Stick (brand) (berat)', 0.00, 0, 0.00, 0.00),
(609, 9, '1509149', 'DP Whip Cream Non Dairy Shine Road 1', 0.00, 0, 0.00, 0.00),
(610, 9, '1509150', 'DP White Fondant', 0.00, 0, 0.00, 0.00),
(611, 9, '1509151', 'DP Yoghurt  Stirred Plain Biokul 1L', 0.00, 0, 0.00, 0.00),
(612, 9, '1509152', 'DP Yoghurt Biokul 100ml', 0.00, 0, 0.00, 0.00),
(613, 9, '1509153', 'DP Kulit Lumpia Besar', 0.00, 0, 0.00, 0.00),
(614, 9, '1509154', 'DP Kulit Lumpia Medium', 0.00, 0, 0.00, 0.00),
(615, 9, '1509155', 'DP Kulit Lumpia TYJ Spring Home 5\" 2', 0.00, 0, 0.00, 0.00),
(616, 9, '1509156', 'DP Kulit Lumpia TYJ Spring Home 8.5\"', 0.00, 0, 0.00, 0.00),
(617, 9, '1509157', 'DP Kulit Pangsit Ye Yen', 0.00, 0, 0.00, 0.00),
(618, 9, '1509158', 'DP Samosa Curry Beef (brand) (berat)', 0.00, 0, 0.00, 0.00),
(619, 9, '1509159', 'DP Samosa Curry Chicken (brand) (ber', 0.00, 0, 0.00, 0.00),
(620, 9, '1509160', 'DP Samosa Curry Lamb (brand) (berat)', 0.00, 0, 0.00, 0.00),
(621, 9, '1509161', 'DP Rice Paper Round 16cm', 0.00, 0, 0.00, 0.00),
(622, 9, '1509162', 'DP Tortilla Flour Mission 6\"', 0.00, 0, 0.00, 0.00),
(623, 9, '1509163', 'DP Tortilla Flour Mission 8\"', 0.00, 0, 0.00, 0.00),
(624, 9, '1509164', 'DP Tortila Corn Mission 6\'\'', 0.00, 0, 0.00, 0.00),
(625, 9, '1509165', 'DP Toast Bread \"ASTON\"', 0.00, 0, 0.00, 0.00),
(626, 9, '1509166', 'DP Red Cherry', 0.00, 0, 0.00, 0.00),
(627, 9, '1509167', 'DP Cokelat Powder', 0.00, 0, 0.00, 0.00),
(628, 10, '1510001', 'GROC Abon Ayam', 0.00, 0, 0.00, 0.00),
(629, 10, '1510002', 'GROC Abon Sapi', 0.00, 0, 0.00, 0.00),
(630, 10, '1510003', 'GROC Bawang Merah Goreng', 0.00, 0, 0.00, 0.00),
(631, 10, '1510004', 'GROC Bawang Putih Goreng', 0.00, 0, 0.00, 0.00),
(632, 10, '1510005', 'GROC Agar-Agar Swallow Globe 12x7gr', 0.00, 0, 0.00, 0.00),
(633, 10, '1510006', 'GROC Jelly Nutrijel Plain 12x15gr', 0.00, 0, 0.00, 0.00),
(634, 10, '1510007', 'GROC Jelly Nutrijell Coklat 12x15gr', 0.00, 0, 0.00, 0.00),
(635, 10, '1510008', 'GROC Kembang Tahu 200gr', 0.00, 0, 0.00, 0.00),
(636, 10, '1510009', 'GROC Almond Ground', 0.00, 0, 0.00, 0.00),
(637, 10, '1510010', 'GROC Meat Tenderizer (brand) (berat)', 0.00, 0, 0.00, 0.00),
(638, 10, '1510011', 'GROC Petis Udang', 0.00, 0, 0.00, 0.00),
(639, 10, '1510012', 'GROC Petis Tahu/Bumbu 250gr', 0.00, 0, 0.00, 0.00),
(640, 10, '1510013', 'GROC Sagu Mutiara Kucing 100gr', 0.00, 0, 0.00, 0.00),
(641, 10, '1510014', 'GROC Santan Sun Kara 1000ml', 0.00, 0, 0.00, 0.00),
(642, 10, '1510015', 'GROC Santan Sun Kara 200ml', 0.00, 0, 0.00, 0.00),
(643, 10, '1510016', 'GROC Santan KARA 1000ml', 0.00, 0, 0.00, 0.00),
(644, 10, '1510017', 'GROC Serbuk Arang Hitam', 0.00, 0, 0.00, 0.00),
(645, 10, '1510018', 'GROC Sushi Nori Takaokaya  50sheets', 0.00, 0, 0.00, 0.00),
(646, 10, '1510019', 'GROC Tong Cay TTS 300gr', 0.00, 0, 0.00, 0.00),
(647, 10, '1510020', 'GROC Wijen', 0.00, 0, 0.00, 0.00),
(648, 10, '1510021', 'GROC Candy (logo) Pack', 0.00, 0, 0.00, 0.00),
(649, 10, '1510022', 'GROC Candy Ricola 25gr', 0.00, 0, 0.00, 0.00),
(650, 10, '1510023', 'GROC Gula Batu 400gr', 0.00, 0, 0.00, 0.00),
(651, 10, '1510024', 'GROC Gula Lokal Kristal 50 Kg', 0.00, 0, 0.00, 0.00),
(652, 10, '1510025', 'GROC Gula Merah', 0.00, 0, 0.00, 0.00),
(653, 10, '1510026', 'GROC Gula Palm', 0.00, 0, 0.00, 0.00),
(654, 10, '1510027', 'GROC Gulaku Indolampung 1 Kg', 0.00, 0, 0.00, 0.00),
(655, 10, '1510028', 'GROC Madu Murni Nusantara 650ml', 0.00, 0, 0.00, 0.00),
(656, 10, '1510029', 'GROC Sweetener Stick (logo)', 0.00, 0, 0.00, 0.00),
(657, 10, '1510030', 'GROC White Sugar Stick (logo)', 0.00, 0, 0.00, 0.00),
(658, 10, '1510031', 'GROC Brown Sugar Stick (logo)', 0.00, 0, 0.00, 0.00),
(659, 10, '1510032', 'GROC Asparagus Cut Narcissus 430gr', 0.00, 0, 0.00, 0.00),
(660, 10, '1510033', 'GROC Fruit Cocktail (brand) 822gr', 0.00, 0, 0.00, 0.00),
(661, 10, '1510034', 'GROC Lychee Kaleng Narcissus 567gr', 0.00, 0, 0.00, 0.00),
(662, 10, '1510035', 'GROC Longan In Syrup Narcissus 567gr', 0.00, 0, 0.00, 0.00),
(663, 10, '1510036', 'GROC Mushroom Champignon (brand) 425', 0.00, 0, 0.00, 0.00),
(664, 10, '1510037', 'GROC Sweet Corn Cream (brand) 418gr', 0.00, 0, 0.00, 0.00),
(665, 10, '1510038', 'GROC Whole Kernel Corn  Delmonte  43', 0.00, 0, 0.00, 0.00),
(666, 10, '1510039', 'GROC Whole Peeled Tomato Ciao 2.5Kg', 0.00, 0, 0.00, 0.00),
(667, 10, '1510040', 'GROC Whole Kernel Sweet Corn Pronas', 0.00, 0, 0.00, 0.00),
(668, 10, '1510041', 'GROC Fava Bean (brand) 450gr', 0.00, 0, 0.00, 0.00),
(669, 10, '1510042', 'GROC Black Bean Tausi 180gr', 0.00, 0, 0.00, 0.00),
(670, 10, '1510043', 'GROC Black Olive (brand) (berat)', 0.00, 0, 0.00, 0.00),
(671, 10, '1510044', 'GROC Black Olive Pitted (brand) 5Kg', 0.00, 0, 0.00, 0.00),
(672, 10, '1510045', 'GROC Kacang Polong Kaleng Ma Ling 39', 0.00, 0, 0.00, 0.00),
(673, 10, '1510046', 'GROC Cereal Kellog\'s Coco Loops 330g', 0.00, 0, 0.00, 0.00),
(674, 10, '1510047', 'GROC Cereal Kellog\'s Corn Flk Honey', 0.00, 0, 0.00, 0.00),
(675, 10, '1510048', 'GROC Cereal Kellog\'s Corn Flk Jumbo', 0.00, 0, 0.00, 0.00),
(676, 10, '1510049', 'GROC Cereal Nestle Cornflake 275gr', 0.00, 0, 0.00, 0.00),
(677, 10, '1510050', 'GROC Cereal Nestle Honeystar 300gr', 0.00, 0, 0.00, 0.00),
(678, 10, '1510051', 'GROC Cereal Nestle Koko Krunch 330gr', 0.00, 0, 0.00, 0.00),
(679, 10, '1510052', 'GROC Oatmeal Instan Quaker 800gr', 0.00, 0, 0.00, 0.00),
(680, 10, '1510053', 'GROC Biskuit Oreo 170gr', 0.00, 0, 0.00, 0.00),
(681, 10, '1510054', 'GROC Biskuit Oreo Double Delight 137', 0.00, 0, 0.00, 0.00),
(682, 10, '1510055', 'GROC Biskuit Oreo Golden Vanilla 137', 0.00, 0, 0.00, 0.00),
(683, 10, '1510056', 'GROC Biskuit Oreo Straw Cream 137gr', 0.00, 0, 0.00, 0.00),
(684, 10, '1510057', 'GROC Cokelat Silver Quen Dark 68gr', 0.00, 0, 0.00, 0.00),
(685, 10, '1510058', 'GROC Wafer Tim Tam 77.5gr', 0.00, 0, 0.00, 0.00),
(686, 10, '1510059', 'GROC Cokelat Astor Stick', 0.00, 0, 0.00, 0.00),
(687, 10, '1510060', 'GROC Kacang Almond', 0.00, 0, 0.00, 0.00),
(688, 10, '1510061', 'GROC Kacang Almond Slice 2 Kg', 0.00, 0, 0.00, 0.00),
(689, 10, '1510062', 'GROC Kacang Arab 250gr', 0.00, 0, 0.00, 0.00),
(690, 10, '1510063', 'GROC Kacang Atom Sukro', 0.00, 0, 0.00, 0.00),
(691, 10, '1510064', 'GROC Kacang Atom Pack Kecil', 0.00, 0, 0.00, 0.00),
(692, 10, '1510065', 'GROC Kacang Hijau Kupas', 0.00, 0, 0.00, 0.00),
(693, 10, '1510066', 'GROC Kacang Polong Snack', 0.00, 0, 0.00, 0.00),
(694, 10, '1510067', 'GROC Kacang Kedelai', 0.00, 0, 0.00, 0.00),
(695, 10, '1510068', 'GROC Kacang Kenari', 0.00, 0, 0.00, 0.00),
(696, 10, '1510069', 'GROC Kacang Koro', 0.00, 0, 0.00, 0.00),
(697, 10, '1510070', 'GROC Kacang Koro Balado', 0.00, 0, 0.00, 0.00),
(698, 10, '1510071', 'GROC Kacang Merah', 0.00, 0, 0.00, 0.00),
(699, 10, '1510072', 'GROC Kacang Mete Mentah', 0.00, 0, 0.00, 0.00),
(700, 10, '1510073', 'GROC Kacang Tanah Kupas Ari', 0.00, 0, 0.00, 0.00),
(701, 10, '1510074', 'GROC Kacang Tanah Kupas Bersih', 0.00, 0, 0.00, 0.00),
(702, 10, '1510075', 'GROC Kacang Telur Garuda 250gr', 0.00, 0, 0.00, 0.00),
(703, 10, '1510076', 'GROC Kacang Telur Halus', 0.00, 0, 0.00, 0.00),
(704, 10, '1510077', 'GROC Kacang Telur Pack Kecil', 0.00, 0, 0.00, 0.00),
(705, 10, '1510078', 'GROC Kacang Telur Medan (Kasar)', 0.00, 0, 0.00, 0.00),
(706, 10, '1510079', 'GROC Kacang Mr. P 40gr', 0.00, 0, 0.00, 0.00),
(707, 10, '1510080', 'GROC Emping Melinjo', 0.00, 0, 0.00, 0.00),
(708, 10, '1510081', 'GROC Keripik Jagung Happy Tos Corn 1', 0.00, 0, 0.00, 0.00),
(709, 10, '1510082', 'GROC Keripik Jamur', 0.00, 0, 0.00, 0.00),
(710, 10, '1510083', 'GROC Keripik Kentang BBQ', 0.00, 0, 0.00, 0.00),
(711, 10, '1510084', 'GROC Keripik Pisang', 0.00, 0, 0.00, 0.00),
(712, 10, '1510085', 'GROC Keripik Singkong', 0.00, 0, 0.00, 0.00),
(713, 10, '1510086', 'GROC Keripik Sukun', 0.00, 0, 0.00, 0.00),
(714, 10, '1510087', 'GROC Lentil Kuning', 0.00, 0, 0.00, 0.00),
(715, 10, '1510088', 'GROC Potato Snack Chitato', 0.00, 0, 0.00, 0.00),
(716, 10, '1510089', 'GROC Keripik Tempe', 0.00, 0, 0.00, 0.00),
(717, 10, '1510090', 'GROC Keripik Ubi Ungu', 0.00, 0, 0.00, 0.00),
(718, 10, '1510091', 'GROC Kerupuk Bawang', 0.00, 0, 0.00, 0.00),
(719, 10, '1510092', 'GROC Kerupuk Bintang', 0.00, 0, 0.00, 0.00),
(720, 10, '1510093', 'GROC Kerupuk Gendar', 0.00, 0, 0.00, 0.00),
(721, 10, '1510094', 'GROC Kerupuk Gendar/Puli', 0.00, 0, 0.00, 0.00),
(722, 10, '1510095', 'GROC Kerupuk Ikan 500gr', 0.00, 0, 0.00, 0.00),
(723, 10, '1510096', 'GROC Kerupuk Ikan Tengiri', 0.00, 0, 0.00, 0.00),
(724, 10, '1510097', 'GROC Kerupuk Kedelai', 0.00, 0, 0.00, 0.00),
(725, 10, '1510098', 'GROC Kerupuk Kelenteng Mentah', 0.00, 0, 0.00, 0.00),
(726, 10, '1510099', 'GROC Kerupuk Mawar', 0.00, 0, 0.00, 0.00),
(727, 10, '1510100', 'GROC Kerupuk Palembang', 0.00, 0, 0.00, 0.00),
(728, 10, '1510101', 'GROC Kerupuk Putih Kaleng', 0.00, 0, 0.00, 0.00),
(729, 10, '1510102', 'GROC Kerupuk Rambak', 0.00, 0, 0.00, 0.00),
(730, 10, '1510103', 'GROC Kerupuk Udang Besar 500gr', 0.00, 0, 0.00, 0.00),
(731, 10, '1510104', 'GROC Kerupuk Udang Kecil Finna 380 G', 0.00, 0, 0.00, 0.00),
(732, 10, '1510105', 'GROC Kerupuk Unyil', 0.00, 0, 0.00, 0.00),
(733, 10, '1510106', 'GROC Kerupuk Warna', 0.00, 0, 0.00, 0.00),
(734, 10, '1510107', 'GROC Potato Mashed Knorr 4Kg', 0.00, 0, 0.00, 0.00),
(735, 10, '1510108', 'GROC Potatoes Mini Pyramid 2.27Kg', 0.00, 0, 0.00, 0.00),
(736, 10, '1510109', 'GROC Potato Pom pom Yorksign Puff', 0.00, 0, 0.00, 0.00),
(737, 10, '1510110', 'GROC Potato Straight Cut YorkSign 2.', 0.00, 0, 0.00, 0.00),
(738, 10, '1510111', 'GROC Potato Supercrips Wedges Spicy', 0.00, 0, 0.00, 0.00),
(739, 10, '1510112', 'GROC Potato Triangle Patties Hash Br', 0.00, 0, 0.00, 0.00);
INSERT INTO `t06_article` (`id`, `SubGroupID`, `Kode`, `Nama`, `Qty`, `SatuanID`, `Harga`, `HargaJual`) VALUES
(740, 10, '1510113', 'GROC Potato Wedges Country', 0.00, 0, 0.00, 0.00),
(741, 10, '1510114', 'GROC Frz Baby Carrots (brand) (berat', 0.00, 0, 0.00, 0.00),
(742, 10, '1510115', 'GROC Frz Brussle Sprouts (brand) (be', 0.00, 0, 0.00, 0.00),
(743, 10, '1510116', 'GROC Frz Edamame 500gr', 0.00, 0, 0.00, 0.00),
(744, 10, '1510117', 'GROC Frz Green Peas (brand) 500gr', 0.00, 0, 0.00, 0.00),
(745, 10, '1510118', 'GROC Frz Kernel Corn Golden Farm 1Kg', 0.00, 0, 0.00, 0.00),
(746, 10, '1510119', 'GROC Frz Mixed Vegetable Golden Farm', 0.00, 0, 0.00, 0.00),
(747, 10, '1510120', 'GROC Acar Gherkins Koleman 670gr', 0.00, 0, 0.00, 0.00),
(748, 10, '1510121', 'GROC Acar Kaper Mezzetta  Capers 118', 0.00, 0, 0.00, 0.00),
(749, 10, '1510122', 'GROC Cendol 1Kg', 0.00, 0, 0.00, 0.00),
(750, 10, '1510123', 'GROC Cincau Hitam', 0.00, 0, 0.00, 0.00),
(751, 10, '1510124', 'GROC Cincau Hijau', 0.00, 0, 0.00, 0.00),
(752, 10, '1510125', 'GROC Kolang Kaling', 0.00, 0, 0.00, 0.00),
(753, 10, '1510126', 'GROC Nata De Coco Inaco 1Kg', 0.00, 0, 0.00, 0.00),
(754, 10, '1510127', 'GROC Nata De Coco Kara 1Kg', 0.00, 0, 0.00, 0.00),
(755, 10, '1510128', 'GROC Kapur Sirih', 0.00, 0, 0.00, 0.00),
(756, 10, '1510129', 'GROC Permen Cokelat Warna M&M (berat', 0.00, 0, 0.00, 0.00),
(757, 10, '1510130', 'GROC Permen Lolipop (berat)', 0.00, 0, 0.00, 0.00),
(758, 10, '1510131', 'GROC Kacang Atom Macan 375gr', 0.00, 0, 0.00, 0.00),
(759, 10, '1510132', 'GROC Manisan Buah Kering', 0.00, 0, 0.00, 0.00),
(760, 10, '1510133', 'GROC Potato Shoestring 2,5Kg', 0.00, 0, 0.00, 0.00),
(761, 11, '1511001', 'SAUSEA Kecap Asin ABC 5.7Kg', 0.00, 0, 0.00, 0.00),
(762, 11, '1511002', 'SAUSEA Kecap Asin ABC 650ml', 0.00, 0, 0.00, 0.00),
(763, 11, '1511003', 'SAUSEA Kecap Manis ABC 5.7Kg', 0.00, 0, 0.00, 0.00),
(764, 11, '1511004', 'SAUSEA Kecap Ikan Fish Gravi 620ml', 0.00, 0, 0.00, 0.00),
(765, 11, '1511005', 'SAUSEA Kecap Ikan Cap Oyster Finna 6', 0.00, 0, 0.00, 0.00),
(766, 11, '1511006', 'SAUSEA BBQ Sauce Knorr 1Kg', 0.00, 0, 0.00, 0.00),
(767, 11, '1511007', 'SAUSEA BBQ Sauce McLewis 1Kg', 0.00, 0, 0.00, 0.00),
(768, 11, '1511008', 'SAUSEA Char Siu Sauce Lee Kum Kee 2.', 0.00, 0, 0.00, 0.00),
(769, 11, '1511009', 'SAUSEA Cheese Sauce Mix Knorr  750gr', 0.00, 0, 0.00, 0.00),
(770, 11, '1511010', 'SAUSEA Chili Garlic Sauce Lee Kum Ke', 0.00, 0, 0.00, 0.00),
(771, 11, '1511011', 'SAUSEA Dark Soy Sauce Lee Kum Kee 50', 0.00, 0, 0.00, 0.00),
(772, 11, '1511012', 'SAUSEA Mushroom Sauce Pearl Bridge 6', 0.00, 0, 0.00, 0.00),
(773, 11, '1511013', 'SAUSEA Demiglace Brown Sauce Knorr 1', 0.00, 0, 0.00, 0.00),
(774, 11, '1511014', 'SAUSEA Japan Grill Teriyaki Kikkoman', 0.00, 0, 0.00, 0.00),
(775, 11, '1511015', 'SAUSEA Japan Spicy Teriyaki Kikkoman', 0.00, 0, 0.00, 0.00),
(776, 11, '1511016', 'SAUSEA Saus Tiram LKK Panda 2.27Kg', 0.00, 0, 0.00, 0.00),
(777, 11, '1511017', 'SAUSEA Saus Tiram ABC 425ml', 0.00, 0, 0.00, 0.00),
(778, 11, '1511018', 'SAUSEA Pepper Sauce Tabasco 150ml', 0.00, 0, 0.00, 0.00),
(779, 11, '1511019', 'SAUSEA Pepper Sauce Tabasco 60ml', 0.00, 0, 0.00, 0.00),
(780, 11, '1511020', 'SAUSEA Saus A1 240gr', 0.00, 0, 0.00, 0.00),
(781, 11, '1511021', 'SAUSEA Saus Hoisin Lee Kum Kee 2.27K', 0.00, 0, 0.00, 0.00),
(782, 11, '1511022', 'SAUSEA Saus HP Original 255gr', 0.00, 0, 0.00, 0.00),
(783, 11, '1511023', 'SAUSEA Saus L&P 284ml', 0.00, 0, 0.00, 0.00),
(784, 11, '1511024', 'SAUSEA Saus Raja Rasa 600ml', 0.00, 0, 0.00, 0.00),
(785, 11, '1511025', 'SAUSEA Saus Sambal ABC 5.7Kg', 0.00, 0, 0.00, 0.00),
(786, 11, '1511026', 'SAUSEA Saus Sambal ABC Sachet', 0.00, 0, 0.00, 0.00),
(787, 11, '1511027', 'SAUSEA Saus Sambal Delmonte 5.7Kg', 0.00, 0, 0.00, 0.00),
(788, 11, '1511028', 'SAUSEA Saus Tomat ABC 5.7Kg', 0.00, 0, 0.00, 0.00),
(789, 11, '1511029', 'SAUSEA Saus Tomat ABC Sachet', 0.00, 0, 0.00, 0.00),
(790, 11, '1511030', 'SAUSEA Saus Tomat Delmonte 5.7Kg', 0.00, 0, 0.00, 0.00),
(791, 11, '1511031', 'SAUSEA Saus Inggris Sedap Wangi 600m', 0.00, 0, 0.00, 0.00),
(792, 11, '1511032', 'SAUSEA Soy Sauce/Shoyu Kikkoman 1.6L', 0.00, 0, 0.00, 0.00),
(793, 11, '1511033', 'SAUSEA Soy Sauce/Shoyu Kikkoman 250m', 0.00, 0, 0.00, 0.00),
(794, 11, '1511034', 'SAUSEA Sushi&Sashimi Sauce Kikkoman', 0.00, 0, 0.00, 0.00),
(795, 11, '1511035', 'SAUSEA Sambal Bajak Hot Kokita 5Kg', 0.00, 0, 0.00, 0.00),
(796, 11, '1511036', 'SAUSEA Sambal Balado Kokita 5Kg', 0.00, 0, 0.00, 0.00),
(797, 11, '1511037', 'SAUSEA Sambal Bangkok Kokita 400gr', 0.00, 0, 0.00, 0.00),
(798, 11, '1511038', 'SAUSEA Sambal Bangkok Kokita 5Kg', 0.00, 0, 0.00, 0.00),
(799, 11, '1511039', 'SAUSEA Sambal Tauco Cap Ibu 260gr', 0.00, 0, 0.00, 0.00),
(800, 11, '1511040', 'SAUSEA Sambal Tauco Korea Daesang 50', 0.00, 0, 0.00, 0.00),
(801, 11, '1511041', 'SAUSEA Sambal Terasi Kokita 5Kg', 0.00, 0, 0.00, 0.00),
(802, 11, '1511042', 'SAUSEA Bumbu Kacang', 0.00, 0, 0.00, 0.00),
(803, 11, '1511043', 'SAUSEA Bumbu Pecel', 0.00, 0, 0.00, 0.00),
(804, 11, '1511044', 'SAUSEA Beef Seasoning Pwdr Knorr 1Kg', 0.00, 0, 0.00, 0.00),
(805, 11, '1511045', 'SAUSEA Chicken Seasoning Pwdr Knorr', 0.00, 0, 0.00, 0.00),
(806, 11, '1511046', 'SAUSEA Chicken Seasoning Pwdr Knorr', 0.00, 0, 0.00, 0.00),
(807, 11, '1511047', 'SAUSEA Kaldu Ayam Royco 230gr', 0.00, 0, 0.00, 0.00),
(808, 11, '1511048', 'SAUSEA Seasoning Maggie 200ml', 0.00, 0, 0.00, 0.00),
(809, 11, '1511049', 'SAUSEA Penyedap Rasa Ajinomoto 1Kg', 0.00, 0, 0.00, 0.00),
(810, 11, '1511050', 'SAUSEA Penyedap Rasa Miwon 1Kg', 0.00, 0, 0.00, 0.00),
(811, 11, '1511051', 'SAUSEA Penyedap Rasa Sapi Royco 1Kg', 0.00, 0, 0.00, 0.00),
(812, 11, '1511052', 'SAUSEA Kaldu Sapi Royco 230gr', 0.00, 0, 0.00, 0.00),
(813, 11, '1511053', 'SAUSEA Kaldu Ikan Hon Dashi Ajinomot', 0.00, 0, 0.00, 0.00),
(814, 11, '1511054', 'SAUSEA Arak Masak Pek Bie Tjoe 600ml', 0.00, 0, 0.00, 0.00),
(815, 11, '1511055', 'SAUSEA Arak Masak Shao Hsing Pagoda', 0.00, 0, 0.00, 0.00),
(816, 11, '1511056', 'SAUSEA Arak Merah Angciu Lonceng 600', 0.00, 0, 0.00, 0.00),
(817, 11, '1511057', 'SAUSEA Arak Masak Hinode Mirin (bran', 0.00, 0, 0.00, 0.00),
(818, 11, '1511058', 'SAUSEA Cuka Masak Dixi 150ml', 0.00, 0, 0.00, 0.00),
(819, 11, '1511059', 'SAUSEA Cuka Masak Dixi 650ml', 0.00, 0, 0.00, 0.00),
(820, 11, '1511060', 'SAUSEA Cuka Mizkan Suehiro Su 1.8L', 0.00, 0, 0.00, 0.00),
(821, 11, '1511061', 'SAUSEA Cuka Mizkan Sushi Su 500ml', 0.00, 0, 0.00, 0.00),
(822, 11, '1511062', 'SAUSEA Balsamic Vinegar Bertolli 500', 0.00, 0, 0.00, 0.00),
(823, 11, '1511063', 'SAUSEA Black Vinegar Narcissus 640ml', 0.00, 0, 0.00, 0.00),
(824, 11, '1511064', 'SAUSEA Red Wine Vinegar Varvello 1L', 0.00, 0, 0.00, 0.00),
(825, 11, '1511065', 'SAUSEA Rice Vinegar Narcissus 600ml', 0.00, 0, 0.00, 0.00),
(826, 11, '1511066', 'SAUSEA White Wine Vinegar Varvello 1', 0.00, 0, 0.00, 0.00),
(827, 11, '1511067', 'SAUSEA Tauco Yeo\'s 450gr', 0.00, 0, 0.00, 0.00),
(828, 11, '1511068', 'SAUSEA Tauco Kokita 400gr', 0.00, 0, 0.00, 0.00),
(829, 11, '1511069', 'SAUSEA Miso Shinshuichi Mikochan 300', 0.00, 0, 0.00, 0.00),
(830, 11, '1511070', 'SAUSEA Garam Cap Kapal', 0.00, 0, 0.00, 0.00),
(831, 11, '1511071', 'SAUSEA Bumbu Inti A Kokita 5Kg', 0.00, 0, 0.00, 0.00),
(832, 11, '1511072', 'SAUSEA Bumbu Inti B Kokita 5Kg', 0.00, 0, 0.00, 0.00),
(833, 11, '1511073', 'SAUSEA Bumbu Inti C Kokita 5Kg', 0.00, 0, 0.00, 0.00),
(834, 11, '1511074', 'SAUSEA Bumbu Inti D Kokita 5Kg', 0.00, 0, 0.00, 0.00),
(835, 11, '1511075', 'SAUSEA Dijon Mustard Maestro 865gr', 0.00, 0, 0.00, 0.00),
(836, 11, '1511076', 'SAUSEA Dijon Mustard Vilux 5kg', 0.00, 0, 0.00, 0.00),
(837, 11, '1511077', 'SAUSEA Mustard Maestro 245gr', 0.00, 0, 0.00, 0.00),
(838, 11, '1511078', 'SAUSEA Acar Jalapeno Slice (brand) (', 0.00, 0, 0.00, 0.00),
(839, 11, '1511079', 'SAUSEA Acar Jalapeno Slice Saporito', 0.00, 0, 0.00, 0.00),
(840, 11, '1511080', 'SAUSEA Acar Takuan Taro 450gr', 0.00, 0, 0.00, 0.00),
(841, 11, '1511081', 'SAUSEA Terasi Udang Puger 250gr', 0.00, 0, 0.00, 0.00),
(842, 11, '1511082', 'SAUSEA Carbonara Mix Knorr 750gr', 0.00, 0, 0.00, 0.00),
(843, 11, '1511083', 'SAUSEA Tom Yam Paste Knorr 1.5Kg', 0.00, 0, 0.00, 0.00),
(844, 11, '1511084', 'SAUSEA Tomato Paste Metelliana 2.55K', 0.00, 0, 0.00, 0.00),
(845, 11, '1511085', 'SAUSEA Tomato Pronto Knorr  2Kg', 0.00, 0, 0.00, 0.00),
(846, 11, '1511086', 'SAUSEA Tomato Paste Delmonte 170gr', 0.00, 0, 0.00, 0.00),
(847, 12, '1512001', 'HERSP Asam Matang', 0.00, 0, 0.00, 0.00),
(848, 12, '1512002', 'HERSP Asam Mentah', 0.00, 0, 0.00, 0.00),
(849, 12, '1512003', 'HERSP Basil Dried', 0.00, 0, 0.00, 0.00),
(850, 12, '1512004', 'HERSP Basil Dry Jay\'s 20 gr', 0.00, 0, 0.00, 0.00),
(851, 12, '1512005', 'HERSP Basil Fresh', 0.00, 0, 0.00, 0.00),
(852, 12, '1512006', 'HERSP Basil Rubbed & Dry', 0.00, 0, 0.00, 0.00),
(853, 12, '1512007', 'HERSP Bay Dried', 0.00, 0, 0.00, 0.00),
(854, 12, '1512008', 'HERSP Bay Dry Jay\'s 8 gr', 0.00, 0, 0.00, 0.00),
(855, 12, '1512009', 'HERSP Bay Fresh', 0.00, 0, 0.00, 0.00),
(856, 12, '1512010', 'HERSP Biji Teratai', 0.00, 0, 0.00, 0.00),
(857, 12, '1512011', 'HERSP Bubuk Bunga Pekak', 0.00, 0, 0.00, 0.00),
(858, 12, '1512012', 'HERSP Bunga Pekak', 0.00, 0, 0.00, 0.00),
(859, 12, '1512013', 'HERSP Cabai Bubuk', 0.00, 0, 0.00, 0.00),
(860, 12, '1512014', 'HERSP Caper (brand) (berat)', 0.00, 0, 0.00, 0.00),
(861, 12, '1512015', 'HERSP Cengkeh Bubuk', 0.00, 0, 0.00, 0.00),
(862, 12, '1512016', 'HERSP Cengkeh Bubuk (brand) (berat)', 0.00, 0, 0.00, 0.00),
(863, 12, '1512017', 'HERSP Chili Pwdr Ichimi Togarashi (b', 0.00, 0, 0.00, 0.00),
(864, 12, '1512018', 'HERSP Chilli Flakes Jay\'s', 0.00, 0, 0.00, 0.00),
(865, 12, '1512019', 'HERSP Chinese Five Spices Jay\'s 50 g', 0.00, 0, 0.00, 0.00),
(866, 12, '1512020', 'HERSP Curry Powder S&B 400gr', 0.00, 0, 0.00, 0.00),
(867, 12, '1512021', 'HERSP Daun Dill/Adas Sowa', 0.00, 0, 0.00, 0.00),
(868, 12, '1512022', 'HERSP Daun Jeruk', 0.00, 0, 0.00, 0.00),
(869, 12, '1512023', 'HERSP Daun Kari', 0.00, 0, 0.00, 0.00),
(870, 12, '1512024', 'HERSP Daun Kemangi', 0.00, 0, 0.00, 0.00),
(871, 12, '1512025', 'HERSP Daun Kenikir', 0.00, 0, 0.00, 0.00),
(872, 12, '1512026', 'HERSP Daun Ketumbar', 0.00, 0, 0.00, 0.00),
(873, 12, '1512027', 'HERSP Daun Mint', 0.00, 0, 0.00, 0.00),
(874, 12, '1512028', 'HERSP Daun Salam', 0.00, 0, 0.00, 0.00),
(875, 12, '1512029', 'HERSP Dills Whole', 0.00, 0, 0.00, 0.00),
(876, 12, '1512030', 'HERSP Garam Masalah Jay\'s 70 gr', 0.00, 0, 0.00, 0.00),
(877, 12, '1512031', 'HERSP Ginseng Akar', 0.00, 0, 0.00, 0.00),
(878, 12, '1512032', 'HERSP Jahe', 0.00, 0, 0.00, 0.00),
(879, 12, '1512033', 'HERSP Jahe Bubuk Jay\'s Ginger 55gr', 0.00, 0, 0.00, 0.00),
(880, 12, '1512034', 'HERSP Jahe Merah', 0.00, 0, 0.00, 0.00),
(881, 12, '1512035', 'HERSP Jahe Merah Powder', 0.00, 0, 0.00, 0.00),
(882, 12, '1512036', 'HERSP Kencur', 0.00, 0, 0.00, 0.00),
(883, 12, '1512037', 'HERSP Jahe Powder', 0.00, 0, 0.00, 0.00),
(884, 12, '1512038', 'HERSP Jahe Rawit', 0.00, 0, 0.00, 0.00),
(885, 12, '1512039', 'HERSP Japan Ginger Pickle 1Kg', 0.00, 0, 0.00, 0.00),
(886, 12, '1512040', 'HERSP Jinten', 0.00, 0, 0.00, 0.00),
(887, 12, '1512041', 'HERSP Jinten Bubuk Jay\'s Cumin 65gr', 0.00, 0, 0.00, 0.00),
(888, 12, '1512042', 'HERSP Kapulaga', 0.00, 0, 0.00, 0.00),
(889, 12, '1512043', 'HERSP Kapulaga Jay\'s Cardamom 40gr', 0.00, 0, 0.00, 0.00),
(890, 12, '1512044', 'HERSP Kayumanis Bubuk', 0.00, 0, 0.00, 0.00),
(891, 12, '1512045', 'HERSP Kayumanis Bubuk Jay\'s Cinnamon', 0.00, 0, 0.00, 0.00),
(892, 12, '1512046', 'HERSP Keluwak', 0.00, 0, 0.00, 0.00),
(893, 12, '1512047', 'HERSP Kemiri', 0.00, 0, 0.00, 0.00),
(894, 12, '1512048', 'HERSP Kenikir', 0.00, 0, 0.00, 0.00),
(895, 12, '1512049', 'HERSP Ketumbar', 0.00, 0, 0.00, 0.00),
(896, 12, '1512050', 'HERSP Kunci Masak', 0.00, 0, 0.00, 0.00),
(897, 12, '1512051', 'HERSP Kunyit', 0.00, 0, 0.00, 0.00),
(898, 12, '1512052', 'HERSP Kunyit Bubuk Jay\'s Turmeric 55', 0.00, 0, 0.00, 0.00),
(899, 12, '1512053', 'HERSP Kunyit Powder', 0.00, 0, 0.00, 0.00),
(900, 12, '1512054', 'HERSP Lada Hitam Bubuk', 0.00, 0, 0.00, 0.00),
(901, 12, '1512055', 'HERSP Lada Hitam Butir', 0.00, 0, 0.00, 0.00),
(902, 12, '1512056', 'HERSP Lada Putih Bubuk', 0.00, 0, 0.00, 0.00),
(903, 12, '1512057', 'HERSP Lada Putih Butir', 0.00, 0, 0.00, 0.00),
(904, 12, '1512058', 'HERSP Lengkuas', 0.00, 0, 0.00, 0.00),
(905, 12, '1512059', 'HERSP Mustard Ground Jay\'s 50gr', 0.00, 0, 0.00, 0.00),
(906, 12, '1512060', 'HERSP Oregano Chopped', 0.00, 0, 0.00, 0.00),
(907, 12, '1512061', 'HERSP Oregano Dried', 0.00, 0, 0.00, 0.00),
(908, 12, '1512062', 'HERSP Oregano Fresh', 0.00, 0, 0.00, 0.00),
(909, 12, '1512063', 'HERSP Oregano Dry Jay\'s 25gr', 0.00, 0, 0.00, 0.00),
(910, 12, '1512064', 'HERSP Pala Bubuk', 0.00, 0, 0.00, 0.00),
(911, 12, '1512065', 'HERSP Pala Butir', 0.00, 0, 0.00, 0.00),
(912, 12, '1512066', 'HERSP Paprika Powder', 0.00, 0, 0.00, 0.00),
(913, 12, '1512067', 'HERSP Parsley', 0.00, 0, 0.00, 0.00),
(914, 12, '1512068', 'HERSP Rosemary Dried', 0.00, 0, 0.00, 0.00),
(915, 12, '1512069', 'HERSP Rosemary Fresh', 0.00, 0, 0.00, 0.00),
(916, 12, '1512070', 'HERSP Secang', 0.00, 0, 0.00, 0.00),
(917, 12, '1512071', 'HERSP Selasih', 0.00, 0, 0.00, 0.00),
(918, 12, '1512072', 'HERSP Seledri', 0.00, 0, 0.00, 0.00),
(919, 12, '1512073', 'HERSP Sereh', 0.00, 0, 0.00, 0.00),
(920, 12, '1512074', 'HERSP Tarragon Dry Jay\'s 20gr', 0.00, 0, 0.00, 0.00),
(921, 12, '1512075', 'HERSP Thyme Dried/Kering', 0.00, 0, 0.00, 0.00),
(922, 12, '1512076', 'HERSP Thyme Dry Jay\'s 27gr', 0.00, 0, 0.00, 0.00),
(923, 12, '1512077', 'HERSP Thyme Fresh', 0.00, 0, 0.00, 0.00),
(924, 12, '1512078', 'HERSP Wasabi Powder (brand) 1 Kg', 0.00, 0, 0.00, 0.00),
(925, 13, '1513001', 'P&N Mie Telor Atom Bulan 200gr', 0.00, 0, 0.00, 0.00),
(926, 13, '1513002', 'P&N Kwetiau Bahagia Kering 150gr', 0.00, 0, 0.00, 0.00),
(927, 13, '1513003', 'P&N Kwetiau FYF Kering 220gr', 0.00, 0, 0.00, 0.00),
(928, 13, '1513004', 'P&N Super Bihun AAA 450gr', 0.00, 0, 0.00, 0.00),
(929, 13, '1513005', 'P&N Soun RRT', 0.00, 0, 0.00, 0.00),
(930, 13, '1513006', 'P&N Mie Kuning Basah', 0.00, 0, 0.00, 0.00),
(931, 13, '1513007', 'P&N Misoa (brand) (berat)', 0.00, 0, 0.00, 0.00),
(932, 13, '1513008', 'P&N Spaghetti San Remo 500gr', 0.00, 0, 0.00, 0.00),
(933, 13, '1513009', 'P&N Fettucini San Remo 500gr', 0.00, 0, 0.00, 0.00),
(934, 13, '1513010', 'P&N Penne Rigatte San Remo 500gr', 0.00, 0, 0.00, 0.00),
(935, 13, '1513011', 'P&N Fusilli San Remo 500gr', 0.00, 0, 0.00, 0.00),
(936, 13, '1513012', 'P&N Spaghetti La Fonte 500gr', 0.00, 0, 0.00, 0.00),
(937, 13, '1513013', 'P&N Fettucini La Fonte 500gr', 0.00, 0, 0.00, 0.00),
(938, 13, '1513014', 'P&N Penne Rigatte La Fonte 500gr', 0.00, 0, 0.00, 0.00),
(939, 13, '1513015', 'P&N Fusilli La Fonte 500gr', 0.00, 0, 0.00, 0.00),
(940, 13, '1513016', 'P&N Lasagna Lafonte230gr', 0.00, 0, 0.00, 0.00),
(941, 13, '1513017', 'P&N Japan Udon (brand) 200gr', 0.00, 0, 0.00, 0.00),
(942, 13, '1513018', 'P&N Ramen Noodle (brand)(berat)', 0.00, 0, 0.00, 0.00),
(943, 13, '1513019', 'P&N Makaroniku 200gr', 0.00, 0, 0.00, 0.00),
(944, 13, '1513020', 'P&N Maccaroni', 0.00, 0, 0.00, 0.00),
(945, 13, '1513021', 'P&N Mie Instant Sedap Kari Ayam', 0.00, 0, 0.00, 0.00),
(946, 13, '1513022', 'P&N Mie Instant Sedap Goreng', 0.00, 0, 0.00, 0.00),
(947, 14, '1514001', 'RF Beras Angkak', 0.00, 0, 0.00, 0.00),
(948, 14, '1514002', 'RF Beras Basmati', 0.00, 0, 0.00, 0.00),
(949, 14, '1514003', 'RF Beras Guci 25 Kg', 0.00, 0, 0.00, 0.00),
(950, 14, '1514004', 'RF Beras Italia Carnaroli (berat)', 0.00, 0, 0.00, 0.00),
(951, 14, '1514005', 'RF Beras Jagung', 0.00, 0, 0.00, 0.00),
(952, 14, '1514006', 'RF Beras Ketan Hitam', 0.00, 0, 0.00, 0.00),
(953, 14, '1514007', 'RF Beras Ketan Putih', 0.00, 0, 0.00, 0.00),
(954, 14, '1514008', 'RF Beras Rosita 25 Kg', 0.00, 0, 0.00, 0.00),
(955, 14, '1514009', 'RF Beras Teratai 25 Kg', 0.00, 0, 0.00, 0.00),
(956, 14, '1514010', 'RF Hungkwe Kura kura Mahkota Putih', 0.00, 0, 0.00, 0.00),
(957, 14, '1514011', 'RF Japan Kokuho Rice 6.8 Kg', 0.00, 0, 0.00, 0.00),
(958, 14, '1514012', 'RF Japan Sasanishiki Rice 10 Kg', 0.00, 0, 0.00, 0.00),
(959, 14, '1514013', 'RF Tepung  Pao Blue Key 1 Kg', 0.00, 0, 0.00, 0.00),
(960, 14, '1514014', 'RF Tepung Beras Rosebrand 500gr', 0.00, 0, 0.00, 0.00),
(961, 14, '1514015', 'RF Tepung Cakra Kembar 25 Kg', 0.00, 0, 0.00, 0.00),
(962, 14, '1514016', 'RF Tepung Cepat Saji Chesa 200gr', 0.00, 0, 0.00, 0.00),
(963, 14, '1514017', 'RF Tepung Gandum Capitol Mill Whole', 0.00, 0, 0.00, 0.00),
(964, 14, '1514018', 'RF Tepung Jagung', 0.00, 0, 0.00, 0.00),
(965, 14, '1514019', 'RF Tepung Ketan Putih Rosebrand 500g', 0.00, 0, 0.00, 0.00),
(966, 14, '1514020', 'RF Tepung Maizena Maizenaku 300gr', 0.00, 0, 0.00, 0.00),
(967, 14, '1514021', 'RF Tepung Maizena Maizenaku 750gr', 0.00, 0, 0.00, 0.00),
(968, 14, '1514022', 'RF Tepung Roti Putih', 0.00, 0, 0.00, 0.00),
(969, 14, '1514023', 'RF Tepung Roti Putih Primera Panko', 0.00, 0, 0.00, 0.00),
(970, 14, '1514024', 'RF Tepung Sagu', 0.00, 0, 0.00, 0.00),
(971, 14, '1514025', 'RF Tepung Sagu Tani', 0.00, 0, 0.00, 0.00),
(972, 14, '1514026', 'RF Tepung Sang Fen/Potato Starch', 0.00, 0, 0.00, 0.00),
(973, 14, '1514027', 'RF Tepung Segitiga Biru 25 Kg', 0.00, 0, 0.00, 0.00),
(974, 14, '1514028', 'RF Tepung Tang Mien/Wheat Starch', 0.00, 0, 0.00, 0.00),
(975, 14, '1514029', 'RF Tepung Tapioka Gunung Agung 500gr', 0.00, 0, 0.00, 0.00),
(976, 14, '1514030', 'RF Tepung Tempura Nissin 600gr', 0.00, 0, 0.00, 0.00),
(977, 15, '1515001', 'INDO Arem Arem', 0.00, 0, 0.00, 0.00),
(978, 15, '1515002', 'INDO Bakpao', 0.00, 0, 0.00, 0.00),
(979, 15, '1515003', 'INDO Bakpia', 0.00, 0, 0.00, 0.00),
(980, 15, '1515004', 'INDO Bidaran', 0.00, 0, 0.00, 0.00),
(981, 15, '1515005', 'INDO Blackforest', 0.00, 0, 0.00, 0.00),
(982, 15, '1515006', 'INDO Botok Jendil', 0.00, 0, 0.00, 0.00),
(983, 15, '1515007', 'INDO Botok Mlandingan', 0.00, 0, 0.00, 0.00),
(984, 15, '1515008', 'INDO Brownies', 0.00, 0, 0.00, 0.00),
(985, 15, '1515009', 'INDO Bubur', 0.00, 0, 0.00, 0.00),
(986, 15, '1515010', 'INDO Cakue', 0.00, 0, 0.00, 0.00),
(987, 15, '1515011', 'INDO Carrot Cake', 0.00, 0, 0.00, 0.00),
(988, 15, '1515012', 'INDO Cheese Cake', 0.00, 0, 0.00, 0.00),
(989, 15, '1515013', 'INDO Dadar Gulung', 0.00, 0, 0.00, 0.00),
(990, 15, '1515014', 'INDO Donat', 0.00, 0, 0.00, 0.00),
(991, 15, '1515015', 'INDO Gethuk', 0.00, 0, 0.00, 0.00),
(992, 15, '1515016', 'INDO Gethuk Lindri', 0.00, 0, 0.00, 0.00),
(993, 15, '1515017', 'INDO Jadah', 0.00, 0, 0.00, 0.00),
(994, 15, '1515018', 'INDO Jajan Pasar', 0.00, 0, 0.00, 0.00),
(995, 15, '1515019', 'INDO Jajan Pasar Mini', 0.00, 0, 0.00, 0.00),
(996, 15, '1515020', 'INDO Jembret', 0.00, 0, 0.00, 0.00),
(997, 15, '1515021', 'INDO Kacang Kulit Rebus', 0.00, 0, 0.00, 0.00),
(998, 15, '1515022', 'INDO Ketupat', 0.00, 0, 0.00, 0.00),
(999, 15, '1515023', 'INDO Klepon', 0.00, 0, 0.00, 0.00),
(1000, 15, '1515024', 'INDO Kroket', 0.00, 0, 0.00, 0.00),
(1001, 15, '1515025', 'INDO Kue Cake Keju', 0.00, 0, 0.00, 0.00),
(1002, 15, '1515026', 'INDO Kue Cantik Manis', 0.00, 0, 0.00, 0.00),
(1003, 15, '1515027', 'INDO Kue Coklat', 0.00, 0, 0.00, 0.00),
(1004, 15, '1515028', 'INDO Kue Donat Chicken', 0.00, 0, 0.00, 0.00),
(1005, 15, '1515029', 'INDO Kue Gulung Mawar', 0.00, 0, 0.00, 0.00),
(1006, 15, '1515030', 'INDO Kue Jari', 0.00, 0, 0.00, 0.00),
(1007, 15, '1515031', 'INDO Kue Jipang', 0.00, 0, 0.00, 0.00),
(1008, 15, '1515032', 'INDO Kue Karamel', 0.00, 0, 0.00, 0.00),
(1009, 15, '1515033', 'INDO Kue Keranjang', 0.00, 0, 0.00, 0.00),
(1010, 15, '1515034', 'INDO Bolu Kukus', 0.00, 0, 0.00, 0.00),
(1011, 15, '1515035', 'INDO Kue Lapindo', 0.00, 0, 0.00, 0.00),
(1012, 15, '1515036', 'INDO Kue Lapis', 0.00, 0, 0.00, 0.00),
(1013, 15, '1515037', 'INDO Kue Lumpur', 0.00, 0, 0.00, 0.00),
(1014, 15, '1515038', 'INDO Kue Martabak', 0.00, 0, 0.00, 0.00),
(1015, 15, '1515039', 'INDO Kue Mini Roll', 0.00, 0, 0.00, 0.00),
(1016, 15, '1515040', 'INDO Kue Mocci', 0.00, 0, 0.00, 0.00),
(1017, 15, '1515041', 'INDO Kue Molen', 0.00, 0, 0.00, 0.00),
(1018, 15, '1515042', 'INDO Kue Pie Buah', 0.00, 0, 0.00, 0.00),
(1019, 15, '1515043', 'INDO Kue Putu Ayu', 0.00, 0, 0.00, 0.00),
(1020, 15, '1515044', 'INDO Kue Sosis Solo', 0.00, 0, 0.00, 0.00),
(1021, 15, '1515045', 'INDO Kue Sus', 0.00, 0, 0.00, 0.00),
(1022, 15, '1515046', 'INDO Kue Teratai', 0.00, 0, 0.00, 0.00),
(1023, 15, '1515047', 'INDO Kue Zebra', 0.00, 0, 0.00, 0.00),
(1024, 15, '1515048', 'INDO Lemper', 0.00, 0, 0.00, 0.00),
(1025, 15, '1515049', 'INDO Lontong', 0.00, 0, 0.00, 0.00),
(1026, 15, '1515050', 'INDO Lumpia', 0.00, 0, 0.00, 0.00),
(1027, 15, '1515051', 'INDO Lumpia Basah', 0.00, 0, 0.00, 0.00),
(1028, 15, '1515052', 'INDO Nagasari', 0.00, 0, 0.00, 0.00),
(1029, 15, '1515053', 'INDO Onde Onde', 0.00, 0, 0.00, 0.00),
(1030, 15, '1515054', 'INDO Pangsit Basah Bakwan', 0.00, 0, 0.00, 0.00),
(1031, 15, '1515055', 'INDO Pangsit Goreng Bakwan', 0.00, 0, 0.00, 0.00),
(1032, 15, '1515056', 'INDO Pastel', 0.00, 0, 0.00, 0.00),
(1033, 15, '1515057', 'INDO Pedho Godong Lumbu', 0.00, 0, 0.00, 0.00),
(1034, 15, '1515058', 'INDO Pempek Adaan', 0.00, 0, 0.00, 0.00),
(1035, 15, '1515059', 'INDO Pempek Kapal Selam Besar', 0.00, 0, 0.00, 0.00),
(1036, 15, '1515060', 'INDO Pempek Kapal Selam Sedang', 0.00, 0, 0.00, 0.00),
(1037, 15, '1515061', 'INDO Pempek Keju', 0.00, 0, 0.00, 0.00),
(1038, 15, '1515062', 'INDO Pempek Kulit', 0.00, 0, 0.00, 0.00),
(1039, 15, '1515063', 'INDO Pempek Lenjer Besar', 0.00, 0, 0.00, 0.00),
(1040, 15, '1515064', 'INDO Pempek Lenjer Sedang', 0.00, 0, 0.00, 0.00),
(1041, 15, '1515065', 'INDO Pempek Sosis', 0.00, 0, 0.00, 0.00),
(1042, 15, '1515066', 'INDO Pempek Tahu', 0.00, 0, 0.00, 0.00),
(1043, 15, '1515067', 'INDO Pie Basah', 0.00, 0, 0.00, 0.00),
(1044, 15, '1515068', 'INDO Pisang Keju', 0.00, 0, 0.00, 0.00),
(1045, 15, '1515069', 'INDO Rempeyek Kacang', 0.00, 0, 0.00, 0.00),
(1046, 15, '1515070', 'INDO Rempeyek Kedelai', 0.00, 0, 0.00, 0.00),
(1047, 15, '1515071', 'INDO Rempeyek Teri', 0.00, 0, 0.00, 0.00),
(1048, 15, '1515072', 'INDO Risoles', 0.00, 0, 0.00, 0.00),
(1049, 15, '1515073', 'INDO Roll Tart', 0.00, 0, 0.00, 0.00),
(1050, 15, '1515074', 'INDO Roti Canai 10 sheets', 0.00, 0, 0.00, 0.00),
(1051, 15, '1515075', 'INDO Roti Rasa', 0.00, 0, 0.00, 0.00),
(1052, 15, '1515076', 'INDO Serabi', 0.00, 0, 0.00, 0.00),
(1053, 15, '1515077', 'INDO Serabi Ketan', 0.00, 0, 0.00, 0.00),
(1054, 15, '1515078', 'INDO Siomay Bandung', 0.00, 0, 0.00, 0.00),
(1055, 15, '1515079', 'INDO Siomay Goreng', 0.00, 0, 0.00, 0.00),
(1056, 15, '1515080', 'INDO Spiku', 0.00, 0, 0.00, 0.00),
(1057, 15, '1515081', 'INDO Stik Balado', 0.00, 0, 0.00, 0.00),
(1058, 15, '1515082', 'INDO Tahu Bakso Bakwan', 0.00, 0, 0.00, 0.00),
(1059, 15, '1515083', 'INDO Tahu Fantasi', 0.00, 0, 0.00, 0.00),
(1060, 15, '1515084', 'INDO Tahu Isi', 0.00, 0, 0.00, 0.00),
(1061, 15, '1515085', 'INDO Tahu Matang', 0.00, 0, 0.00, 0.00),
(1062, 15, '1515086', 'INDO Tape Ketan', 0.00, 0, 0.00, 0.00),
(1063, 15, '1515087', 'INDO Tape Ketan Hijau', 0.00, 0, 0.00, 0.00),
(1064, 15, '1515088', 'INDO Tape Singkong', 0.00, 0, 0.00, 0.00),
(1065, 15, '1515089', 'INDO Tiramisu', 0.00, 0, 0.00, 0.00),
(1066, 15, '1515090', 'INDO Tiwul', 0.00, 0, 0.00, 0.00),
(1067, 15, '1515091', 'INDO Wingko', 0.00, 0, 0.00, 0.00),
(1068, 16, '2601001', 'MW Mineral Water Cleo 550 ml w/logo', 0.00, 0, 0.00, 0.00),
(1069, 16, '2601002', 'MW Mineral Water Cleo 330 ml w/logo', 0.00, 0, 0.00, 0.00),
(1070, 16, '2601003', 'MW Mineral Water Cleo 1500 ml w/logo', 0.00, 0, 0.00, 0.00),
(1071, 16, '2601004', 'MW Mineral Water Cleo Galon', 0.00, 0, 0.00, 0.00),
(1072, 16, '2601005', 'MW Mineral Water Cleo Gelas 240 ml', 0.00, 0, 0.00, 0.00),
(1073, 16, '2601006', 'MW Mineral Water Equil Sparkling 380', 0.00, 0, 0.00, 0.00),
(1074, 16, '2601007', 'MW Mineral Water Equil Natural 380 m', 0.00, 0, 0.00, 0.00),
(1075, 16, '2601008', 'MW Mineral Water Nestle 330ml', 0.00, 0, 0.00, 0.00),
(1076, 16, '2601009', 'MW Mineral Water Cleo 550 ml w/o log', 0.00, 0, 0.00, 0.00),
(1077, 16, '2601010', 'MW Mineral Water Cleo 330 ml w/o log', 0.00, 0, 0.00, 0.00),
(1078, 16, '2601011', 'MW Mineral Water Cleo 1500 ml w/o lo', 0.00, 0, 0.00, 0.00),
(1079, 17, '2602001', 'ALCO Beer Bintang Can 330ml', 0.00, 0, 0.00, 0.00),
(1080, 17, '2602002', 'ALCO Beer Bintang Bottle 330ml', 0.00, 0, 0.00, 0.00),
(1081, 17, '2602003', 'ALCO Beer Heineken Can 330ml', 0.00, 0, 0.00, 0.00),
(1082, 17, '2602004', 'ALCO Draught Beer Heineken 20L', 0.00, 0, 0.00, 0.00),
(1083, 17, '2602005', 'ALCO Beer Guinness Can 330ml', 0.00, 0, 0.00, 0.00),
(1084, 17, '2602006', 'ALCO Beer Heineken Bottle 640 ml', 0.00, 0, 0.00, 0.00),
(1085, 17, '2602007', 'ALCO Beer Heineken Bottle 330 ml', 0.00, 0, 0.00, 0.00),
(1086, 17, '2602008', 'ALCO Beer Bali Hai Premium Can 330 m', 0.00, 0, 0.00, 0.00),
(1087, 17, '2602009', 'ALCO Liqueur Cointreau 700ml', 0.00, 0, 0.00, 0.00),
(1088, 17, '2602010', 'ALCO Liqueur Kahlua 700ml', 0.00, 0, 0.00, 0.00),
(1089, 17, '2602011', 'ALCO Liqueur Amaretto Disarono 700 m', 0.00, 0, 0.00, 0.00),
(1090, 17, '2602012', 'ALCO Liqueur Sambuca Vaccari 700 ml', 0.00, 0, 0.00, 0.00),
(1091, 17, '2602013', 'ALCO Liqueur Benedictine Dom 750ml', 0.00, 0, 0.00, 0.00),
(1092, 17, '2602014', 'ALCO Liqueur Midori 700ml', 0.00, 0, 0.00, 0.00),
(1093, 17, '2602015', 'ALCO Liqueur Bols Triple Sec 700ml', 0.00, 0, 0.00, 0.00),
(1094, 17, '2602016', 'ALCO Liqueur Cherry Brandy 700ml', 0.00, 0, 0.00, 0.00),
(1095, 17, '2602017', 'ALCO Cognac Martell VSOP @ 700 ml', 0.00, 0, 0.00, 0.00),
(1096, 17, '2602018', 'ALCO Tequila Jose Cuervo 750ml', 0.00, 0, 0.00, 0.00),
(1097, 17, '2602019', 'ALCO Rum Myer\'s Rum 750ml', 0.00, 0, 0.00, 0.00),
(1098, 17, '2602020', 'ALCO Rum Captain Morgan 750ml', 0.00, 0, 0.00, 0.00),
(1099, 17, '2602021', 'ALCO Whisky Chivas Regal 12 Years 75', 0.00, 0, 0.00, 0.00),
(1100, 17, '2602022', 'ALCO Whisky Black Label 750 ml', 0.00, 0, 0.00, 0.00),
(1101, 17, '2602023', 'ALCO Whisky Jack Daniel\'s 700ml', 0.00, 0, 0.00, 0.00),
(1102, 17, '2602024', 'ALCO Whisky Glen Fiddich 700ml', 0.00, 0, 0.00, 0.00),
(1103, 17, '2602025', 'ALCO Whisky Jim Beam 750ml', 0.00, 0, 0.00, 0.00),
(1104, 17, '2602026', 'ALCO Whisky Canadian Club 750ml', 0.00, 0, 0.00, 0.00),
(1105, 17, '2602027', 'ALCO Whisky Old Bushmill 700ml', 0.00, 0, 0.00, 0.00),
(1106, 17, '2602028', 'ALCO Whisky Red Label 750ml', 0.00, 0, 0.00, 0.00),
(1107, 17, '2602029', 'ALCO Whisky Jameson 700ml', 0.00, 0, 0.00, 0.00),
(1108, 17, '2602030', 'ALCO Vodka Absolut Vodka Blue 750ml', 0.00, 0, 0.00, 0.00),
(1109, 17, '2602031', 'ALCO Wine Two Ocean Cab. Sav. Merlot', 0.00, 0, 0.00, 0.00),
(1110, 17, '2602032', 'ALCO Wine Ocean Sauvignon Blanc WW', 0.00, 0, 0.00, 0.00),
(1111, 17, '2602033', 'ALCO Wine Ocean Shiraz RW', 0.00, 0, 0.00, 0.00),
(1112, 17, '2602034', 'ALCO Wine Concha y Toro Front. Cab.', 0.00, 0, 0.00, 0.00),
(1113, 17, '2602035', 'ALCO Wine Concha y Toro Front. Merlo', 0.00, 0, 0.00, 0.00),
(1114, 17, '2602036', 'ALCO J&W Sparkling Red Cocktail 750m', 0.00, 0, 0.00, 0.00),
(1115, 18, '2603001', 'SD Coca Cola Btl 250ml', 0.00, 0, 0.00, 0.00),
(1116, 18, '2603002', 'SD Coca Cola Btl 425ml', 0.00, 0, 0.00, 0.00),
(1117, 18, '2603003', 'SD Coca Cola Btl 1.5L', 0.00, 0, 0.00, 0.00),
(1118, 18, '2603004', 'SD Coca Cola Can 250 ml', 0.00, 0, 0.00, 0.00),
(1119, 18, '2603005', 'SD Coca Cola Can 330 ml', 0.00, 0, 0.00, 0.00),
(1120, 18, '2603006', 'SD Diet Coke Can 330 ml', 0.00, 0, 0.00, 0.00),
(1121, 18, '2603007', 'SD Fanta Strwbry Btl 250ml', 0.00, 0, 0.00, 0.00),
(1122, 18, '2603008', 'SD Fanta Strwbry Btl 425ml', 0.00, 0, 0.00, 0.00),
(1123, 18, '2603009', 'SD Fanta Strwbry Btl 1.5L', 0.00, 0, 0.00, 0.00),
(1124, 18, '2603010', 'SD Fanta Strwbry Can 250 ml', 0.00, 0, 0.00, 0.00),
(1125, 18, '2603011', 'SD Fanta Strwbry Can 330 ml', 0.00, 0, 0.00, 0.00),
(1126, 18, '2603012', 'SD Fanta Orange Btl 250ml', 0.00, 0, 0.00, 0.00),
(1127, 18, '2603013', 'SD Fanta Orange Btl 425ml', 0.00, 0, 0.00, 0.00),
(1128, 18, '2603014', 'SD Fanta Orange Btl 1.5L', 0.00, 0, 0.00, 0.00),
(1129, 18, '2603015', 'SD Fanta Orange Can 250 ml', 0.00, 0, 0.00, 0.00),
(1130, 18, '2603016', 'SD Fanta Orange Can 330 ml', 0.00, 0, 0.00, 0.00),
(1131, 18, '2603017', 'SD Sprite Btl 250ml', 0.00, 0, 0.00, 0.00),
(1132, 18, '2603018', 'SD Sprite Btl 425ml', 0.00, 0, 0.00, 0.00),
(1133, 18, '2603019', 'SD Sprite Btl 1.5L', 0.00, 0, 0.00, 0.00),
(1134, 18, '2603020', 'SD Sprite Can 250 ml', 0.00, 0, 0.00, 0.00),
(1135, 18, '2603021', 'SD Sprite Can 330 ml', 0.00, 0, 0.00, 0.00),
(1136, 18, '2603022', 'SD Pepsi Blue 450ml', 0.00, 0, 0.00, 0.00),
(1137, 18, '2603023', 'SD Pepsi Blue 1.5L', 0.00, 0, 0.00, 0.00),
(1138, 18, '2603024', 'SD Pocari Sweat Btl 350 ml', 0.00, 0, 0.00, 0.00),
(1139, 18, '2603025', 'SD Pocari Sweat Btl 500 ml', 0.00, 0, 0.00, 0.00),
(1140, 18, '2603026', 'SD Pocari Sweat Can 330 ml', 0.00, 0, 0.00, 0.00),
(1141, 18, '2603027', 'SD Orange Water You C-1000  500ml', 0.00, 0, 0.00, 0.00),
(1142, 18, '2603028', 'SD Lemon Water You C-1000  500ml', 0.00, 0, 0.00, 0.00),
(1143, 18, '2603029', 'SD Vitamin Orange You C-1000  140ml', 0.00, 0, 0.00, 0.00),
(1144, 18, '2603030', 'SD Vitamin Lemon You C-1000  140ml', 0.00, 0, 0.00, 0.00),
(1145, 18, '2603031', 'SD Orange Juice Sunkist 300ml', 0.00, 0, 0.00, 0.00),
(1146, 18, '2603032', 'SD Tonic Water Schweppes 330ml', 0.00, 0, 0.00, 0.00),
(1147, 18, '2603033', 'SD Soda Water Schweppes 330ml', 0.00, 0, 0.00, 0.00),
(1148, 18, '2603034', 'SD Ginger Ale Schweppes 330ml', 0.00, 0, 0.00, 0.00),
(1149, 18, '2603035', 'SD Nutrisari Orange Sachet 14gr', 0.00, 0, 0.00, 0.00),
(1150, 18, '2603036', 'SD Segar Dingin Sachet 7gr', 0.00, 0, 0.00, 0.00),
(1151, 18, '2603037', 'SD Jas Jus Sachet 8gr', 0.00, 0, 0.00, 0.00),
(1152, 18, '2603038', 'SD Milk Jus Sachet 25gr', 0.00, 0, 0.00, 0.00),
(1153, 18, '2603039', 'SD Tea Jus Sachet 8 gr', 0.00, 0, 0.00, 0.00),
(1154, 18, '2603040', 'SD Orange Pouch Nestle 560gr', 0.00, 0, 0.00, 0.00),
(1155, 18, '2603041', 'SD Lemon Tea Nestea 1 Kg', 0.00, 0, 0.00, 0.00),
(1156, 18, '2603042', 'SD Capuccino Nescafe 500gr', 0.00, 0, 0.00, 0.00),
(1157, 18, '2603043', 'SD Dark Cocoa Nestle 1 Kg', 0.00, 0, 0.00, 0.00),
(1158, 18, '2603044', 'SD Kopi ABC Sachet', 0.00, 0, 0.00, 0.00),
(1159, 18, '2603045', 'SD Luwak White Koffie Sachet', 0.00, 0, 0.00, 0.00),
(1160, 18, '2603046', 'SD Kopi TOP Sachet', 0.00, 0, 0.00, 0.00),
(1161, 18, '2603047', 'SD Coklat Bubuk  Milo 18 gr', 0.00, 0, 0.00, 0.00),
(1162, 18, '2603048', 'SD Nutrisari W\'dank Jahe 175gr', 0.00, 0, 0.00, 0.00),
(1163, 19, '2604001', 'JUICE Apple Toza RTD 5L', 0.00, 0, 0.00, 0.00),
(1164, 19, '2604002', 'JUICE Grape Toza RTD 5L', 0.00, 0, 0.00, 0.00),
(1165, 19, '2604003', 'JUICE Guava Toza RTD 5L', 0.00, 0, 0.00, 0.00),
(1166, 19, '2604004', 'JUICE Mango Toza RTD 5L', 0.00, 0, 0.00, 0.00),
(1167, 19, '2604005', 'JUICE Orange Toza RTD 5L', 0.00, 0, 0.00, 0.00),
(1168, 19, '2604006', 'JUICE Pineapple Toza RTD 5L', 0.00, 0, 0.00, 0.00),
(1169, 19, '2604007', 'JUICE Soursoup Toza RTD 5L', 0.00, 0, 0.00, 0.00),
(1170, 19, '2604008', 'JUICE Starfruit Toza RTD 5L', 0.00, 0, 0.00, 0.00),
(1171, 19, '2604009', 'JUICE Cranberry (brand) (vol)', 0.00, 0, 0.00, 0.00),
(1172, 19, '2604010', 'JUICE Orange Sun Quick 2L', 0.00, 0, 0.00, 0.00),
(1173, 19, '2604011', 'JUICE Apple Toza Concentrate 5L', 0.00, 0, 0.00, 0.00),
(1174, 19, '2604012', 'JUICE Grape Toza Concentrate 5L', 0.00, 0, 0.00, 0.00),
(1175, 19, '2604013', 'JUICE Guava Toza Concentrate 5L', 0.00, 0, 0.00, 0.00),
(1176, 19, '2604014', 'JUICE Mango Toza Concentrate 5L', 0.00, 0, 0.00, 0.00),
(1177, 19, '2604015', 'JUICE Orange Toza Concentrate 5L', 0.00, 0, 0.00, 0.00),
(1178, 19, '2604016', 'JUICE Pineapple Toza Concentrate 5L', 0.00, 0, 0.00, 0.00),
(1179, 19, '2604017', 'JUICE Soursoup Toza Concentrate 5L', 0.00, 0, 0.00, 0.00),
(1180, 19, '2604018', 'JUICE Starfruit Toza Concentrate 5L', 0.00, 0, 0.00, 0.00),
(1181, 19, '2604019', 'JUICE Apple Toza Concentrate 1L', 0.00, 0, 0.00, 0.00),
(1182, 19, '2604020', 'JUICE Grape Toza Concentrate 1L', 0.00, 0, 0.00, 0.00),
(1183, 19, '2604021', 'JUICE Guava Toza Concentrate 1L', 0.00, 0, 0.00, 0.00),
(1184, 19, '2604022', 'JUICE Lemon Toza Concentrate 1L', 0.00, 0, 0.00, 0.00),
(1185, 19, '2604023', 'JUICE Mango Toza Concentrate 1L', 0.00, 0, 0.00, 0.00),
(1186, 19, '2604024', 'JUICE Orange Toza Concentrate 1L', 0.00, 0, 0.00, 0.00),
(1187, 19, '2604025', 'JUICE Pineapple Toza Concentrate 1L', 0.00, 0, 0.00, 0.00),
(1188, 19, '2604026', 'JUICE Soursoup Toza Concentrate 1L', 0.00, 0, 0.00, 0.00),
(1189, 19, '2604027', 'JUICE Starfruit Toza Concentrate 1L', 0.00, 0, 0.00, 0.00),
(1190, 19, '2604028', 'JUICE Strawberry Toza Concentrate 1L', 0.00, 0, 0.00, 0.00),
(1191, 20, '2605001', 'SYRP Maple Green\'s 375gr', 0.00, 0, 0.00, 0.00),
(1192, 20, '2605002', 'SYRP Blue Curacao Monin 700ml', 0.00, 0, 0.00, 0.00),
(1193, 20, '2605003', 'SYRP Green Mint Monin 700ml', 0.00, 0, 0.00, 0.00),
(1194, 20, '2605004', 'SYRP Grenadine Monin 700ml', 0.00, 0, 0.00, 0.00),
(1195, 20, '2605005', 'SYRP Raspberry Monin 700ml', 0.00, 0, 0.00, 0.00),
(1196, 20, '2605006', 'SYRP Blueberry Mixtura Liquid 2.1 Kg', 0.00, 0, 0.00, 0.00),
(1197, 20, '2605007', 'SYRP Ginger Mixtura Liquid 2.1 Kg', 0.00, 0, 0.00, 0.00),
(1198, 20, '2605008', 'SYRP Mint Mixtura Liquid 2.1 Kg', 0.00, 0, 0.00, 0.00),
(1199, 20, '2605009', 'SYRP Raspberry Mixtura Liquid 2.1 Kg', 0.00, 0, 0.00, 0.00),
(1200, 20, '2605010', 'SYRP Red Apple Mixtura Liquid 2.1 Kg', 0.00, 0, 0.00, 0.00),
(1201, 20, '2605011', 'SYRP Strawberry Mixtura Liquid 2.1 K', 0.00, 0, 0.00, 0.00),
(1202, 20, '2605012', 'SYRP Cinamon Mixtura Powder 1 Kg', 0.00, 0, 0.00, 0.00),
(1203, 20, '2605013', 'SYRP Green Tea Mixtura Powder 1 Kg', 0.00, 0, 0.00, 0.00),
(1204, 20, '2605014', 'SYRP Chocolate Mixtura Powder 1 Kg', 0.00, 0, 0.00, 0.00),
(1205, 20, '2605015', 'SYRP Cocopandan Marjan 450ml', 0.00, 0, 0.00, 0.00),
(1206, 20, '2605016', 'SYRP Leci Marjan 450ml', 0.00, 0, 0.00, 0.00),
(1207, 20, '2605017', 'SYRP Melon Marjan 450ml', 0.00, 0, 0.00, 0.00),
(1208, 20, '2605018', 'SYRP Mocca Marjan 450ml', 0.00, 0, 0.00, 0.00),
(1209, 20, '2605019', 'SYRP Strawberry Marjan 450ml', 0.00, 0, 0.00, 0.00),
(1210, 20, '2605020', 'SYRP Vanilla Marjan 450ml', 0.00, 0, 0.00, 0.00),
(1211, 20, '2605021', 'SYRP Grenadine Marjan 450ml', 0.00, 0, 0.00, 0.00),
(1212, 20, '2605022', 'SYRP Leci ABC 525ml', 0.00, 0, 0.00, 0.00),
(1213, 20, '2605023', 'SYRP Sirsak ABC 525ml', 0.00, 0, 0.00, 0.00),
(1214, 20, '2605024', 'SYRP Frappe Red Velvet Toffin Pwdr 8', 0.00, 0, 0.00, 0.00),
(1215, 20, '2605025', 'SYRP Blueberry Fountain Toffin Pwdr', 0.00, 0, 0.00, 0.00),
(1216, 20, '2605026', 'SYRP Bubble Gum Toffin Pwdr 800gr', 0.00, 0, 0.00, 0.00),
(1217, 20, '2605027', 'SYRP Green Tea Toffin 1 Kg', 0.00, 0, 0.00, 0.00),
(1218, 21, '2606001', 'LOCD Jamu Asem', 0.00, 0, 0.00, 0.00),
(1219, 21, '2606002', 'LOCD Jamu Beras Kencur', 0.00, 0, 0.00, 0.00),
(1220, 21, '2606003', 'LOCD Jamu Brotowali-Irengan', 0.00, 0, 0.00, 0.00),
(1221, 21, '2606004', 'LOCD Jamu Cabe Puyang', 0.00, 0, 0.00, 0.00),
(1222, 21, '2606005', 'LOCD Jamu Kunci Suruh', 0.00, 0, 0.00, 0.00),
(1223, 21, '2606006', 'LOCD Jamu Kunir Asem', 0.00, 0, 0.00, 0.00),
(1224, 21, '2606007', 'LOCD Jamu Kunyit Asam', 0.00, 0, 0.00, 0.00),
(1225, 21, '2606008', 'LOCD Jamu Sinom', 0.00, 0, 0.00, 0.00),
(1226, 21, '2606009', 'LOCD Minuman STMJ Sachet', 0.00, 0, 0.00, 0.00),
(1227, 21, '2606010', 'LOCD Wedang Jenggelek', 0.00, 0, 0.00, 0.00),
(1228, 21, '2606011', 'LOCD Wedang Purwoceng', 0.00, 0, 0.00, 0.00),
(1229, 21, '2606012', 'LOCD Wedang Secang', 0.00, 0, 0.00, 0.00),
(1230, 21, '2606013', 'LOCD Wedang Wuh', 0.00, 0, 0.00, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `t07_satuan`
--

CREATE TABLE `t07_satuan` (
  `id` int(11) NOT NULL,
  `Nama` varchar(25) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `t08_beli` (
  `id` int(11) NOT NULL,
  `TglPO` date NOT NULL,
  `NoPO` varchar(14) CHARACTER SET latin1 NOT NULL,
  `VendorID` int(11) NOT NULL,
  `ArticleID` int(11) NOT NULL,
  `Harga` float(15,2) NOT NULL DEFAULT '0.00',
  `Qty` float(15,2) NOT NULL DEFAULT '0.00',
  `SubTotal` float(15,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t08_beli`
--

INSERT INTO `t08_beli` (`id`, `TglPO`, `NoPO`, `VendorID`, `ArticleID`, `Harga`, `Qty`, `SubTotal`) VALUES
(2, '2018-04-25', 'PO201804250002', 2, 1, 95000.00, 6.20, 589000.00),
(3, '2018-04-25', 'PO201804250003', 2, 6, 75000.00, 1.00, 75000.00),
(4, '2018-04-25', 'PO201804250004', 2, 6, 75000.00, 7.00, 525000.00),
(5, '2018-04-25', 'PO201804250005', 1, 1, 95000.00, 1.00, 95000.00);

-- --------------------------------------------------------

--
-- Table structure for table `t09_hutang`
--

CREATE TABLE `t09_hutang` (
  `id` int(11) NOT NULL,
  `NoHutang` varchar(8) CHARACTER SET latin1 NOT NULL,
  `BeliID` int(11) NOT NULL,
  `JumlahHutang` float(15,2) NOT NULL DEFAULT '0.00',
  `JumlahBayar` float(15,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t09_hutang`
--

INSERT INTO `t09_hutang` (`id`, `NoHutang`, `BeliID`, `JumlahHutang`, `JumlahBayar`) VALUES
(2, 'HT000002', 2, 589000.00, 0.00),
(3, 'HT000003', 3, 75000.00, 0.00),
(4, 'HT000004', 4, 525000.00, 0.00),
(5, 'HT000005', 5, 95000.00, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `t10_hutangdetail`
--

CREATE TABLE `t10_hutangdetail` (
  `id` int(11) NOT NULL,
  `HutangID` int(11) NOT NULL,
  `NoBayar` varchar(8) CHARACTER SET latin1 NOT NULL,
  `Tgl` date NOT NULL,
  `JumlahBayar` float(15,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `t11_jual`
--

CREATE TABLE `t11_jual` (
  `id` int(11) NOT NULL,
  `TglSO` date NOT NULL,
  `NoSO` varchar(14) CHARACTER SET latin1 NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `CustomerPO` varchar(50) CHARACTER SET latin1 NOT NULL,
  `Total` float(15,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t11_jual`
--

INSERT INTO `t11_jual` (`id`, `TglSO`, `NoSO`, `CustomerID`, `CustomerPO`, `Total`) VALUES
(1, '2018-04-25', 'SO201804250001', 2, 'xxx', 661000.00),
(2, '2018-04-25', 'SO201804250002', 2, 'xxx', 1000000.00),
(3, '2018-04-25', 'SO201804250003', 2, 'xxx', 500000.00);

-- --------------------------------------------------------

--
-- Table structure for table `t11_jual_old`
--

CREATE TABLE `t11_jual_old` (
  `id` int(11) NOT NULL,
  `TglSO` date NOT NULL,
  `NoSO` varchar(14) CHARACTER SET latin1 NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `CustomerPO` varchar(50) CHARACTER SET latin1 NOT NULL,
  `Total` float(15,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `t12_jualdetail`
--

CREATE TABLE `t12_jualdetail` (
  `id` int(11) NOT NULL,
  `JualID` int(11) NOT NULL,
  `ArticleID` int(11) NOT NULL,
  `HargaJual` float(15,2) NOT NULL DEFAULT '0.00',
  `Qty` float(15,2) NOT NULL DEFAULT '0.00',
  `SubTotal` float(15,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t12_jualdetail`
--

INSERT INTO `t12_jualdetail` (`id`, `JualID`, `ArticleID`, `HargaJual`, `Qty`, `SubTotal`) VALUES
(2, 1, 1, 125000.00, 5.00, 625000.00),
(3, 2, 6, 200000.00, 5.00, 1000000.00),
(4, 3, 5, 100000.00, 5.00, 500000.00),
(5, 1, 2, 18000.00, 2.00, 36000.00);

-- --------------------------------------------------------

--
-- Table structure for table `t13_mutasi`
--

CREATE TABLE `t13_mutasi` (
  `id` int(11) NOT NULL,
  `TabelID` int(11) NOT NULL DEFAULT '0',
  `Url` varchar(100) CHARACTER SET latin1 NOT NULL,
  `ArticleID` int(11) NOT NULL,
  `Kode` varchar(7) NOT NULL,
  `NoUrut` tinyint(4) NOT NULL,
  `Tgl` date NOT NULL,
  `Jam` time NOT NULL DEFAULT '00:00:00',
  `Keterangan` varchar(50) CHARACTER SET latin1 NOT NULL,
  `NoRef` varchar(25) NOT NULL,
  `MasukQty` float(15,2) NOT NULL DEFAULT '0.00',
  `MasukHarga` float(15,2) NOT NULL DEFAULT '0.00',
  `KeluarQty` float(15,2) NOT NULL DEFAULT '0.00',
  `KeluarHarga` float(15,2) NOT NULL DEFAULT '0.00',
  `SaldoQty` float(15,2) NOT NULL DEFAULT '0.00',
  `SaldoHarga` float(15,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t13_mutasi`
--

INSERT INTO `t13_mutasi` (`id`, `TabelID`, `Url`, `ArticleID`, `Kode`, `NoUrut`, `Tgl`, `Jam`, `Keterangan`, `NoRef`, `MasukQty`, `MasukHarga`, `KeluarQty`, `KeluarHarga`, `SaldoQty`, `SaldoHarga`) VALUES
(1, 1, 't06_articleview.php?showdetail=&id=1', 1, '1501001', 0, '2018-04-01', '00:00:00', 'Stok Awal', '', 19.00, 95000.00, 0.00, 0.00, 19.00, 1805000.00),
(3, 2, 't08_beliview.php?showdetail=&id=2', 1, '1501001', 2, '2018-04-25', '01:49:00', 'Beli', '', 6.20, 95000.00, 0.00, 0.00, 25.20, 589000.00),
(5, 2, 't12_jualdetailview.php?showdetail=&id=2', 1, '1501001', 4, '2018-04-25', '13:15:00', 'Jual', '', 0.00, 0.00, 5.00, 0.00, 20.20, 0.00),
(6, 2, 't06_articleview.php?showdetail=&id=2', 2, '6601001', 0, '2018-04-01', '00:00:00', 'Stok Awal', '', 24.00, 14500.00, 0.00, 0.00, 24.00, 348000.00),
(7, 3, 't06_articleview.php?showdetail=&id=3', 3, '1504001', 0, '2018-04-01', '00:00:00', 'Stok Awal', '', 4.00, 37500.00, 0.00, 0.00, 4.00, 150000.00),
(8, 4, 't06_articleview.php?showdetail=&id=4', 4, '1507001', 0, '2018-04-01', '00:00:00', 'Stok Awal', '', 13.00, 1500.00, 0.00, 0.00, 13.00, 19500.00),
(9, 5, 't06_articleview.php?showdetail=&id=5', 5, '6602001', 0, '2018-04-01', '00:00:00', 'Stok Awal', '', 5.00, 75000.00, 0.00, 0.00, 5.00, 375000.00),
(10, 6, 't06_articleview.php?showdetail=&id=6', 6, '6605001', 0, '2018-04-01', '00:00:00', 'Stok Awal', '', 3.00, 75000.00, 0.00, 0.00, 3.00, 225000.00),
(11, 3, 't08_beliview.php?showdetail=&id=3', 6, '6605001', 1, '2018-04-25', '15:12:00', 'Beli', '', 1.00, 75000.00, 0.00, 0.00, 4.00, 75000.00),
(12, 4, 't08_beliview.php?showdetail=&id=4', 6, '6605001', 2, '2018-04-25', '15:13:00', 'Beli', '', 7.00, 75000.00, 0.00, 0.00, 11.00, 525000.00),
(13, 3, 't12_jualdetailview.php?showdetail=&id=3', 6, '6605001', 3, '2018-04-25', '15:18:00', 'Jual', '', 0.00, 0.00, 5.00, 0.00, 6.00, 0.00),
(14, 5, 't08_beliview.php?showdetail=&id=5', 1, '1501001', 5, '2018-04-25', '18:55:00', 'Beli', 'PO201804250005', 1.00, 95000.00, 0.00, 0.00, 21.20, 95000.00),
(15, 4, 't12_jualdetailview.php?showdetail=&id=4', 5, '6602001', 1, '2018-04-25', '19:18:00', 'Jual', 'SO201804250003', 0.00, 0.00, 5.00, 0.00, 0.00, 0.00),
(16, 5, 't12_jualdetailview.php?showdetail=&id=5', 2, '6601001', 1, '2018-04-26', '11:13:00', 'Jual', 'SO201804250001', 0.00, 0.00, 2.00, 0.00, 22.00, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `t93_parameter`
--

CREATE TABLE `t93_parameter` (
  `id` int(11) NOT NULL,
  `Nama` varchar(50) CHARACTER SET latin1 NOT NULL,
  `Nilai` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t93_parameter`
--

INSERT INTO `t93_parameter` (`id`, `Nama`, `Nilai`) VALUES
(1, 'Periode', '2018-04-01');

-- --------------------------------------------------------

--
-- Table structure for table `t94_home`
--

CREATE TABLE `t94_home` (
  `id` int(11) NOT NULL,
  `kode` varchar(25) CHARACTER SET latin1 NOT NULL,
  `flag` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t94_home`
--

INSERT INTO `t94_home` (`id`, `kode`, `flag`) VALUES
(1, '0whats_new', 0),
(2, '1on_progress', 0),
(3, '2update', 0),
(4, '3pending', 0),
(5, '4todo', 1),
(6, '5log', 1);

-- --------------------------------------------------------

--
-- Table structure for table `t95_homedetail`
--

CREATE TABLE `t95_homedetail` (
  `home_id` int(11) NOT NULL,
  `tgl` date DEFAULT NULL,
  `kat` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `no_jdl` int(11) DEFAULT NULL,
  `jdl` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `no_ket` int(11) DEFAULT NULL,
  `ket` text CHARACTER SET latin1,
  `done` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t95_homedetail`
--

INSERT INTO `t95_homedetail` (`home_id`, `tgl`, `kat`, `no_jdl`, `jdl`, `no_ket`, `ket`, `done`) VALUES
(1, '2017-10-15', '2update', 1, 'Transaksi - Retur Penjualan', NULL, NULL, NULL),
(2, '2017-10-11', '2update', 1, 'Laporan - Dead Stok', NULL, NULL, NULL),
(3, '2017-10-11', '2update', 2, 'Laporan - Mutasi Detail', NULL, NULL, NULL),
(4, '2017-10-07', '2update', 1, 'revisi Laporan - Stok: ditambah data dari transaksi \"Dead Stock\"', NULL, NULL, NULL),
(5, '2017-10-07', '2update', 2, 'revisi Laporan - Nilai Stok: ditambah data dari transaksi \"Dead Stock\"', NULL, NULL, NULL),
(6, '2017-10-07', '2update', 3, 'revisi Laporan - Mutasi: ditambah data dari transaksi \"Dead Stock\"', NULL, NULL, NULL),
(7, '2017-10-07', '2update', 4, 'revisi Laporan - Laba / Rugi Kotor: ditambah data dari transaksi \"Dead Stock\"', NULL, NULL, NULL),
(8, '2017-10-05', '2update', 1, 'Laporan - Laba / Rugi Kotor', NULL, NULL, NULL),
(9, '2017-10-04', '2update', 1, 'Laporan - Nilai Stok sudah benar', NULL, NULL, NULL),
(11, '2017-10-04', '2update', 2, 'alias nama item :', 1, 'nama item urutan pertama => untuk internal, urutan selanjutnya untuk eksternal', NULL),
(12, '2017-10-04', '2update', 2, 'alias nama item :', 2, 'antar-urutan dipisahkan dengan tanda koma', NULL),
(13, '2017-10-03', '2update', 1, 'Master - Customer', 1, 'by default : Customer menggunakan pilihan Nama Item urutan pertama, kecuali ada perubahan', NULL),
(14, '2017-10-03', '2update', 2, 'Master - Item', 1, 'pemisahan urutan : dengan tanda koma', NULL),
(15, '2017-09-28', '4todo', 1, '<strike>dead stok</strike>', NULL, NULL, NULL),
(16, '2017-09-28', '4todo', 2, '<strike>retur penjualan</strike>', NULL, NULL, NULL),
(17, '2017-09-28', '4todo', 3, '<strike>hak akses</strike>', NULL, NULL, NULL),
(18, '2017-09-28', '4todo', 4, '<strike>invoice</strike>', NULL, NULL, NULL),
(19, '2017-09-28', '4todo', 5, 'margin :: total per month, perlu menyertakan quantity', NULL, NULL, NULL),
(20, '2017-09-28', '4todo', 6, 'konversi satuan', NULL, NULL, NULL),
(21, '2017-09-28', '4todo', 7, 'stok opname', NULL, NULL, NULL),
(22, '2017-09-28', '4todo', 8, 'closing', NULL, NULL, NULL),
(23, '2017-09-28', '4todo', 9, 'backup', NULL, NULL, NULL),
(24, '2017-09-28', '4todo', 10, 'restore', NULL, NULL, NULL),
(25, '2017-10-19', '2update', 2, 'Laporan - Retur Penjualan', NULL, NULL, NULL),
(26, '2017-10-19', '2update', 1, 'revisi Laporan - Stok: ditambah data dari transaksi \"Retur Penjualan\"', NULL, NULL, NULL),
(28, '2017-10-20', '4todo', 1, 'history harga', NULL, NULL, NULL),
(29, '2017-10-20', '4todo', 2, '<strike>history hutang (internal)</strike>', NULL, NULL, NULL),
(30, '2017-10-20', '4todo', 3, '<strike>grouping kategori item</strike>', NULL, NULL, NULL),
(31, '2017-10-20', '4todo', 4, '<strike>perhitungan piutang berdasarkan total invoice</strike>', NULL, NULL, NULL),
(32, '2017-10-20', '4todo', 5, '<strike>harga jual otomatis tampil</strike>', NULL, NULL, NULL),
(33, '2017-10-25', '2update', 2, '<a href=\"t_13kategorilist.php\">Master - Item Kategori</a>', NULL, NULL, NULL),
(34, '2017-10-25', '2update', 1, '<a href=\"t_02itemlist.php\">Master - Item<a>', 1, 'menambahkan kolom KATEGORI;', NULL),
(35, '2017-10-25', '2update', 1, '<a href=\"t_02itemlist.php\">Master - Item<a>', 2, 'menambahkan kolom satuan dan kolom harga jual;', NULL),
(36, '2017-10-27', '2update', 1, 'Transaksi - Penjualan', 1, 'harga jual otomatis tampil;', NULL),
(37, '2017-11-09', '2update', 1, 'Master - Hak Akses', NULL, NULL, NULL),
(38, '2017-11-09', '2update', 2, 'Cetak - Invoice', NULL, NULL, NULL),
(39, '2017-11-10', '2update', 1, 'Revisi Laporan Mutasi', 1, 'menambahkan perhitungan dari proses retur penjualan', NULL),
(40, '2017-11-10', '2update', 2, 'Revisi Laporan Mutasi Detail', 1, 'menambahkan perhitungan dari proses retur penjualan', NULL),
(41, '2017-11-10', '3pending', 1, 'input pembelian (branch assign)', 1, 'apakah perlu dibuatkan assign branch untuk proses pembelian ? mengingat branch bisa melakukan proses pembelian', NULL),
(42, '2017-11-11', '2update', 1, 'Laporan - Drop Cash', NULL, NULL, NULL),
(43, '2017-11-15', '2update', 1, 'update kolom SISA di proses drop cash', NULL, NULL, NULL),
(44, '2017-11-11', '2update', 2, 'Laporan - Hutang Internal', NULL, NULL, NULL),
(45, '2017-11-11', '3pending', 2, 'hutang internal -> branch-based', 1, 'apakah perlu di-assign untuk setiap proses yang memerlukan pengelompokkan berdasarkan branch ? misal :: hutang internal', NULL),
(46, '2017-11-11', '3pending', 2, 'hutang internal -> branch-based', 2, 'misal :: hutang internal Bojonegoro akan beda dengan hutang internal Surabaya', NULL),
(47, '2017-11-15', '1on_progress', 1, 'perhitungan piutang berdasarkan total invoice', NULL, NULL, NULL),
(48, '2017-11-15', '3pending', 1, 'nilai invoice', 1, 'apakah nilai invoice pasti sama dengan nilai PO ?', NULL),
(49, '2018-04-23', '4todo', 1, 'data tabel <b>beli</b> vs data tabel <b>hutang</b>', 2, 'setiap pembelian ostosmastis menjadi hutang, maka setiap perubahan pada tabel pembelian juga harus disesuaikan pada tabel hutang', NULL),
(51, '2018-04-23', '5log', 1, 'update after-proses di tabel beli', 1, NULL, 1),
(52, '2018-04-23', '5log', 2, 'hapus trigger di database', 2, 'hapus trigger di database untuk tabel beli, agar tidak ostosmastis mengupdate nilai stok di tabel article (master barang)', NULL),
(53, '2018-04-23', '5log', 2, 'hapus trigger di database', 3, 'CREATE TRIGGER `tg_updateqty_beli` AFTER INSERT ON `t08_beli`\r\n FOR EACH ROW BEGIN\r\nupdate t06_article set qty = qty + new.qty where id = new.articleid;\r\nEND', NULL),
(54, '2018-04-23', '5log', 2, 'hapus trigger di database', 4, 'CREATE TRIGGER `tg_updateqty_jual` AFTER INSERT ON `t12_jualdetail`\r\n FOR EACH ROW BEGIN\r\nupdate t06_article set qty = qty - new.qty where id = new.articleid;\r\nEND', NULL),
(55, '2018-04-23', '5log', 3, 'siapkan tabel mutasi', 1, NULL, NULL),
(56, '2018-04-23', '5log', 4, 'siapkan tanggal periode aktif', NULL, NULL, 1),
(57, '2018-04-23', '5log', 2, 'hapus trigger di database', 1, NULL, 1),
(58, '2018-04-23', '4todo', 1, 'data tabel <b>beli</b> vs data tabel <b>hutang</b>', 1, NULL, 1),
(59, '2018-04-23', '5log', 1, 'update after-proses di tabel beli', 2, 'update after-proses di tabel beli agar setiap perubahan data di tabel beli juga berpengaruh di tabel hutang', NULL),
(60, '2018-04-23', '5log', 3, 'siapkan tabel mutasi', 2, 'auto insert - update - delete dari tabel article (master barang)', 1),
(61, '2018-04-23', '5log', 3, 'siapkan tabel mutasi', 3, 'auto insert - update - delete dari tabel beli', 1),
(62, '2018-04-23', '5log', 3, 'siapkan tabel mutasi', 4, 'auto insert - update - delete dari tabel jual', 1),
(63, '2018-04-25', '5log', 1, 'siapkan laporan mutasi', NULL, NULL, 1),
(64, '2018-04-25', '5log', 1, 'tabel mutasi; tambah field noref;', NULL, NULL, 1),
(65, '2018-04-26', '5log', 1, 'tabel mutasi', NULL, NULL, 1),
(66, '2018-04-26', '5log', 1, 'tabel mutasi', 1, 'harus simpan kode article agar bisa sort by kode', NULL),
(67, '2018-04-26', '4todo', 1, 'transaksi piutang', NULL, NULL, NULL),
(68, '2018-04-26', '4todo', 2, 'laporan piutang', NULL, NULL, NULL),
(69, '2018-04-26', '4todo', 3, 'cetak surat jalan', NULL, NULL, NULL),
(70, '2018-04-26', '4todo', 4, 'cetak invoice', NULL, NULL, NULL),
(71, '2018-04-26', '4todo', 5, 'laporan stok masih salah', NULL, NULL, NULL),
(72, '2018-04-26', '4todo', 6, 'laporan nilai stok', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t96_employees`
--

CREATE TABLE `t96_employees` (
  `EmployeeID` int(11) NOT NULL,
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
  `Profile` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t96_employees`
--

INSERT INTO `t96_employees` (`EmployeeID`, `LastName`, `FirstName`, `Title`, `TitleOfCourtesy`, `BirthDate`, `HireDate`, `Address`, `City`, `Region`, `PostalCode`, `Country`, `HomePhone`, `Extension`, `Email`, `Photo`, `Notes`, `ReportsTo`, `Password`, `UserLevel`, `Username`, `Activated`, `Profile`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '21232f297a57a5a743894a0e4a801fc3', -1, 'admin', 'Y', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t97_userlevels`
--

CREATE TABLE `t97_userlevels` (
  `userlevelid` int(11) NOT NULL,
  `userlevelname` varchar(255) NOT NULL
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

CREATE TABLE `t98_userlevelpermissions` (
  `userlevelid` int(11) NOT NULL,
  `tablename` varchar(255) NOT NULL,
  `permission` int(11) NOT NULL
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

CREATE TABLE `t99_audittrail` (
  `id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `script` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `user` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `action` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `table` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `field` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `keyvalue` longtext CHARACTER SET latin1,
  `oldvalue` longtext CHARACTER SET latin1,
  `newvalue` longtext CHARACTER SET latin1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(495, '2018-04-18 02:20:46', '/stok/t12_jualdetailedit.php', '1', 'U', 't12_jualdetail', 'SubTotal', '1', '437500.00', '275000'),
(496, '2018-04-18 09:42:39', '/stok/login.php', 'admin', 'login', '::1', '', '', '', ''),
(497, '2018-04-18 11:28:20', '/stok/login.php', 'admin', 'login', '::1', '', '', '', ''),
(498, '2018-04-18 11:52:37', '/stok/t11_jualedit.php', '1', '*** Batch update begin ***', 't12_jualdetail', '', '', '', ''),
(499, '2018-04-18 11:52:37', '/stok/t11_jualedit.php', '1', 'U', 't12_jualdetail', 'Qty', '1', '2.20', '2.3'),
(500, '2018-04-18 11:52:37', '/stok/t11_jualedit.php', '1', 'U', 't12_jualdetail', 'SubTotal', '1', '275000.00', '287500'),
(501, '2018-04-18 11:52:37', '/stok/t11_jualedit.php', '1', '*** Batch update successful ***', 't12_jualdetail', '', '', '', ''),
(502, '2018-04-18 11:57:48', '/stok/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(503, '2018-04-18 12:25:31', '/stok/login.php', 'admin', 'login', '::1', '', '', '', ''),
(504, '2018-04-18 12:29:49', '/stok/t11_jualedit.php', '1', '*** Batch update begin ***', 't12_jualdetail', '', '', '', ''),
(505, '2018-04-18 12:29:49', '/stok/t11_jualedit.php', '1', 'U', 't12_jualdetail', 'Qty', '1', '2.30', '3'),
(506, '2018-04-18 12:29:49', '/stok/t11_jualedit.php', '1', 'U', 't12_jualdetail', 'SubTotal', '1', '287500.00', '375000'),
(507, '2018-04-18 12:29:49', '/stok/t11_jualedit.php', '1', 'U', 't12_jualdetail', 'Qty', '2', '2.00', '4'),
(508, '2018-04-18 12:29:49', '/stok/t11_jualedit.php', '1', 'U', 't12_jualdetail', 'SubTotal', '2', '250000.00', '500000'),
(509, '2018-04-18 12:29:49', '/stok/t11_jualedit.php', '1', '*** Batch update successful ***', 't12_jualdetail', '', '', '', ''),
(510, '2018-04-18 17:18:17', '/stok/login.php', 'admin', 'login', '::1', '', '', '', ''),
(511, '2018-04-18 18:09:54', '/stok/t11_jualedit.php', '1', '*** Batch update begin ***', 't12_jualdetail', '', '', '', ''),
(512, '2018-04-18 18:09:54', '/stok/t11_jualedit.php', '1', 'A', 't12_jualdetail', 'JualID', '3', '', '1'),
(513, '2018-04-18 18:09:54', '/stok/t11_jualedit.php', '1', 'A', 't12_jualdetail', 'ArticleID', '3', '', '1'),
(514, '2018-04-18 18:09:54', '/stok/t11_jualedit.php', '1', 'A', 't12_jualdetail', 'HargaJual', '3', '', '125000.00'),
(515, '2018-04-18 18:09:54', '/stok/t11_jualedit.php', '1', 'A', 't12_jualdetail', 'Qty', '3', '', '5'),
(516, '2018-04-18 18:09:54', '/stok/t11_jualedit.php', '1', 'A', 't12_jualdetail', 'SatuanID', '3', '', '1'),
(517, '2018-04-18 18:09:54', '/stok/t11_jualedit.php', '1', 'A', 't12_jualdetail', 'SubTotal', '3', '', '625000'),
(518, '2018-04-18 18:09:54', '/stok/t11_jualedit.php', '1', 'A', 't12_jualdetail', 'id', '3', '', '3'),
(519, '2018-04-18 18:09:55', '/stok/t11_jualedit.php', '1', '*** Batch update successful ***', 't12_jualdetail', '', '', '', ''),
(520, '2018-04-18 18:11:01', '/stok/t11_jualadd.php', '1', 'A', 't11_jual', 'TglSO', '2', '', '2018-04-18'),
(521, '2018-04-18 18:11:01', '/stok/t11_jualadd.php', '1', 'A', 't11_jual', 'NoSO', '2', '', 'SO201804180002'),
(522, '2018-04-18 18:11:01', '/stok/t11_jualadd.php', '1', 'A', 't11_jual', 'CustomerID', '2', '', '1'),
(523, '2018-04-18 18:11:01', '/stok/t11_jualadd.php', '1', 'A', 't11_jual', 'CustomerPO', '2', '', '-'),
(524, '2018-04-18 18:11:01', '/stok/t11_jualadd.php', '1', 'A', 't11_jual', 'Total', '2', '', '0'),
(525, '2018-04-18 18:11:01', '/stok/t11_jualadd.php', '1', 'A', 't11_jual', 'id', '2', '', '2'),
(526, '2018-04-18 18:11:01', '/stok/t11_jualadd.php', '1', '*** Batch insert begin ***', 't12_jualdetail', '', '', '', ''),
(527, '2018-04-18 18:11:01', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'JualID', '4', '', '2'),
(528, '2018-04-18 18:11:01', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'ArticleID', '4', '', '1'),
(529, '2018-04-18 18:11:01', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'HargaJual', '4', '', '125000.00'),
(530, '2018-04-18 18:11:01', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'Qty', '4', '', '.65'),
(531, '2018-04-18 18:11:01', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'SatuanID', '4', '', '1'),
(532, '2018-04-18 18:11:01', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'SubTotal', '4', '', '81250'),
(533, '2018-04-18 18:11:01', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'id', '4', '', '4'),
(534, '2018-04-18 18:11:01', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'JualID', '5', '', '2'),
(535, '2018-04-18 18:11:01', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'ArticleID', '5', '', '1'),
(536, '2018-04-18 18:11:01', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'HargaJual', '5', '', '125000.00'),
(537, '2018-04-18 18:11:01', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'Qty', '5', '', '2.25'),
(538, '2018-04-18 18:11:01', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'SatuanID', '5', '', '1'),
(539, '2018-04-18 18:11:01', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'SubTotal', '5', '', '281250'),
(540, '2018-04-18 18:11:01', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'id', '5', '', '5'),
(541, '2018-04-18 18:11:02', '/stok/t11_jualadd.php', '1', '*** Batch insert successful ***', 't12_jualdetail', '', '', '', ''),
(542, '2018-04-18 22:42:37', '/stok/login.php', 'admin', 'login', '::1', '', '', '', ''),
(543, '2018-04-19 21:56:22', '/stok/t11_jualadd.php', '3', 'A', 't11_jual', 'TglSO', '3', '', '2018-04-19'),
(544, '2018-04-19 21:56:22', '/stok/t11_jualadd.php', '3', 'A', 't11_jual', 'NoSO', '3', '', 'SO201804190001'),
(545, '2018-04-19 21:56:22', '/stok/t11_jualadd.php', '3', 'A', 't11_jual', 'CustomerID', '3', '', '1'),
(546, '2018-04-19 21:56:22', '/stok/t11_jualadd.php', '3', 'A', 't11_jual', 'CustomerPO', '3', '', '--'),
(547, '2018-04-19 21:56:22', '/stok/t11_jualadd.php', '3', 'A', 't11_jual', 'Total', '3', '', '0'),
(548, '2018-04-19 21:56:22', '/stok/t11_jualadd.php', '3', 'A', 't11_jual', 'id', '3', '', '3'),
(549, '2018-04-19 21:56:22', '/stok/t11_jualadd.php', '3', '*** Batch insert begin ***', 't12_jualdetail', '', '', '', ''),
(550, '2018-04-19 21:56:22', '/stok/t11_jualadd.php', '3', 'A', 't12_jualdetail', 'JualID', '6', '', '3'),
(551, '2018-04-19 21:56:22', '/stok/t11_jualadd.php', '3', 'A', 't12_jualdetail', 'ArticleID', '6', '', '1'),
(552, '2018-04-19 21:56:22', '/stok/t11_jualadd.php', '3', 'A', 't12_jualdetail', 'HargaJual', '6', '', '125000.00'),
(553, '2018-04-19 21:56:22', '/stok/t11_jualadd.php', '3', 'A', 't12_jualdetail', 'Qty', '6', '', '2'),
(554, '2018-04-19 21:56:22', '/stok/t11_jualadd.php', '3', 'A', 't12_jualdetail', 'SatuanID', '6', '', '1'),
(555, '2018-04-19 21:56:22', '/stok/t11_jualadd.php', '3', 'A', 't12_jualdetail', 'SubTotal', '6', '', '250000'),
(556, '2018-04-19 21:56:22', '/stok/t11_jualadd.php', '3', 'A', 't12_jualdetail', 'id', '6', '', '6'),
(557, '2018-04-19 21:56:23', '/stok/t11_jualadd.php', '3', '*** Batch insert successful ***', 't12_jualdetail', '', '', '', ''),
(558, '2018-04-20 12:58:38', '/stok/login.php', 'admin', 'login', '::1', '', '', '', ''),
(559, '2018-04-20 13:07:03', '/stok/t06_articlelist.php', '1', 'U', 't06_article', 'Qty', '1', '0.00', '100'),
(560, '2018-04-20 13:07:24', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'TglPO', '1', '', '2018-04-20'),
(561, '2018-04-20 13:07:24', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'NoPO', '1', '', 'PO201804200001'),
(562, '2018-04-20 13:07:24', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'VendorID', '1', '', '1'),
(563, '2018-04-20 13:07:24', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'ArticleID', '1', '', '1'),
(564, '2018-04-20 13:07:24', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'Harga', '1', '', '100000.00'),
(565, '2018-04-20 13:07:24', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'Qty', '1', '', '2'),
(566, '2018-04-20 13:07:24', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'SatuanID', '1', '', '1'),
(567, '2018-04-20 13:07:24', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'SubTotal', '1', '', '200000'),
(568, '2018-04-20 13:07:24', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'id', '1', '', '1'),
(569, '2018-04-20 13:08:10', '/stok/t11_jualadd.php', '1', 'A', 't11_jual', 'TglSO', '1', '', '2018-04-20'),
(570, '2018-04-20 13:08:10', '/stok/t11_jualadd.php', '1', 'A', 't11_jual', 'NoSO', '1', '', 'SO201804200001'),
(571, '2018-04-20 13:08:10', '/stok/t11_jualadd.php', '1', 'A', 't11_jual', 'CustomerID', '1', '', '1'),
(572, '2018-04-20 13:08:10', '/stok/t11_jualadd.php', '1', 'A', 't11_jual', 'CustomerPO', '1', '', '-'),
(573, '2018-04-20 13:08:10', '/stok/t11_jualadd.php', '1', 'A', 't11_jual', 'Total', '1', '', '0'),
(574, '2018-04-20 13:08:10', '/stok/t11_jualadd.php', '1', 'A', 't11_jual', 'id', '1', '', '1'),
(575, '2018-04-20 13:08:11', '/stok/t11_jualadd.php', '1', '*** Batch insert begin ***', 't12_jualdetail', '', '', '', ''),
(576, '2018-04-20 13:08:11', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'JualID', '1', '', '1'),
(577, '2018-04-20 13:08:11', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'ArticleID', '1', '', '1'),
(578, '2018-04-20 13:08:11', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'HargaJual', '1', '', '125000.00'),
(579, '2018-04-20 13:08:11', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'Qty', '1', '', '3.75'),
(580, '2018-04-20 13:08:11', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'SatuanID', '1', '', '1'),
(581, '2018-04-20 13:08:11', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'SubTotal', '1', '', '468750'),
(582, '2018-04-20 13:08:11', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'id', '1', '', '1'),
(583, '2018-04-20 13:08:11', '/stok/t11_jualadd.php', '1', '*** Batch insert successful ***', 't12_jualdetail', '', '', '', ''),
(584, '2018-04-23 16:50:22', '/stok/login.php', 'admin', 'login', '::1', '', '', '', ''),
(585, '2018-04-23 16:50:49', '/stok/t08_belidelete.php', '1', '*** Batch delete begin ***', 't08_beli', '', '', '', ''),
(586, '2018-04-23 16:50:49', '/stok/t08_belidelete.php', '1', 'D', 't08_beli', 'id', '1', '1', ''),
(587, '2018-04-23 16:50:49', '/stok/t08_belidelete.php', '1', 'D', 't08_beli', 'TglPO', '1', '2018-04-20', ''),
(588, '2018-04-23 16:50:49', '/stok/t08_belidelete.php', '1', 'D', 't08_beli', 'NoPO', '1', 'PO201804200001', ''),
(589, '2018-04-23 16:50:49', '/stok/t08_belidelete.php', '1', 'D', 't08_beli', 'VendorID', '1', '1', ''),
(590, '2018-04-23 16:50:49', '/stok/t08_belidelete.php', '1', 'D', 't08_beli', 'ArticleID', '1', '1', ''),
(591, '2018-04-23 16:50:49', '/stok/t08_belidelete.php', '1', 'D', 't08_beli', 'Harga', '1', '100000.00', ''),
(592, '2018-04-23 16:50:49', '/stok/t08_belidelete.php', '1', 'D', 't08_beli', 'Qty', '1', '2.00', ''),
(593, '2018-04-23 16:50:49', '/stok/t08_belidelete.php', '1', 'D', 't08_beli', 'SubTotal', '1', '200000.00', ''),
(594, '2018-04-23 16:50:49', '/stok/t08_belidelete.php', '1', 'D', 't08_beli', 'SatuanID', '1', '1', ''),
(595, '2018-04-23 16:50:49', '/stok/t08_belidelete.php', '1', '*** Batch delete successful ***', 't08_beli', '', '', '', ''),
(596, '2018-04-23 18:01:40', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'tgl', '49', '', '2018-04-23'),
(597, '2018-04-23 18:01:40', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'kat', '49', '', '4todo'),
(598, '2018-04-23 18:01:40', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'no_jdl', '49', '', '1'),
(599, '2018-04-23 18:01:40', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'jdl', '49', '', 'insert - update - delete'),
(600, '2018-04-23 18:01:40', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'no_ket', '49', '', NULL),
(601, '2018-04-23 18:01:40', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'home_id', '49', '', '49'),
(602, '2018-04-23 18:08:37', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'jdl', '49', 'insert - update - delete', '<b>beli</b> insert - update - delete'),
(603, '2018-04-23 18:08:37', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'no_ket', '49', NULL, '1'),
(604, '2018-04-23 18:22:15', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'jdl', '49', '<b>beli</b> insert - update - delete', 'data <b>beli</b> insert - update - delete harus sama dengan data tabel <b>hutang</b>'),
(605, '2018-04-23 18:31:22', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'jdl', '49', 'data <b>beli</b> insert - update - delete harus sama dengan data tabel <b>hutang</b>', 'data tabel <b>beli</b> insert - update - delete harus sama dengan data tabel <b>hutang</b>'),
(606, '2018-04-23 18:34:14', '/stok/t94_homelist.php', '1', '*** Batch update begin ***', 't94_home', '', '', '', ''),
(607, '2018-04-23 18:34:14', '/stok/t94_homelist.php', '1', 'U', 't94_home', 'flag', '2', '1', '0'),
(608, '2018-04-23 18:34:14', '/stok/t94_homelist.php', '1', 'U', 't94_home', 'flag', '3', '1', '0'),
(609, '2018-04-23 18:34:14', '/stok/t94_homelist.php', '1', 'U', 't94_home', 'flag', '4', '1', '0'),
(610, '2018-04-23 18:34:14', '/stok/t94_homelist.php', '1', '*** Batch update successful ***', 't94_home', '', '', '', ''),
(611, '2018-04-23 18:37:13', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'jdl', '49', 'data tabel <b>beli</b> insert - update - delete harus sama dengan data tabel <b>hutang</b>', 'data tabel <b>beli</b> vs data tabel <b>hutang</b>'),
(612, '2018-04-23 18:37:13', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'ket', '49', NULL, 'setiap entry pembelian ostosmastis menjadi hutang, maka ::'),
(613, '2018-04-23 18:38:20', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'tgl', '50', '', '2018-04-23'),
(614, '2018-04-23 18:38:20', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'kat', '50', '', '4todo'),
(615, '2018-04-23 18:38:20', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'no_jdl', '50', '', '1'),
(616, '2018-04-23 18:38:20', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'jdl', '50', '', NULL),
(617, '2018-04-23 18:38:20', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'no_ket', '50', '', '2'),
(618, '2018-04-23 18:38:20', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'ket', '50', '', 'setiap insert - update - delete data tabel pembelian maka data tabel hutang juga harus disesuaikan'),
(619, '2018-04-23 18:38:20', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'home_id', '50', '', '50'),
(620, '2018-04-23 18:38:56', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'jdl', '50', NULL, 'data tabel beli vs data tabel hutang'),
(621, '2018-04-23 18:39:54', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'jdl', '50', 'data tabel beli vs data tabel hutang', 'data tabel <b>beli</b> vs data tabel <b>hutang</b>'),
(622, '2018-04-23 18:45:35', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'ket', '50', 'setiap insert - update - delete data tabel pembelian maka data tabel hutang juga harus disesuaikan', 'perubahan pada tabel pembelian juga harus disesuaikan pada tabel hutang'),
(623, '2018-04-23 18:56:24', '/stok/t94_homelist.php', '1', 'A', 't94_home', 'kode', '6', '', '5log'),
(624, '2018-04-23 18:56:24', '/stok/t94_homelist.php', '1', 'A', 't94_home', 'flag', '6', '', '1'),
(625, '2018-04-23 18:56:24', '/stok/t94_homelist.php', '1', 'A', 't94_home', 'id', '6', '', '6'),
(626, '2018-04-23 19:02:04', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'tgl', '51', '', '2018-04-23'),
(627, '2018-04-23 19:02:04', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'kat', '51', '', '5log'),
(628, '2018-04-23 19:02:04', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'no_jdl', '51', '', '1'),
(629, '2018-04-23 19:02:04', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'jdl', '51', '', 'update after-proses di tabel beli'),
(630, '2018-04-23 19:02:04', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'no_ket', '51', '', '1'),
(631, '2018-04-23 19:02:04', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'ket', '51', '', 'update after-proses di tabel beli agar perubahan data juga berpengaruh di tabel hutang'),
(632, '2018-04-23 19:02:04', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'home_id', '51', '', '51'),
(633, '2018-04-23 19:11:35', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'TglPO', '1', '', '2018-04-23'),
(634, '2018-04-23 19:11:35', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'NoPO', '1', '', 'PO201804230001'),
(635, '2018-04-23 19:11:35', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'VendorID', '1', '', '1'),
(636, '2018-04-23 19:11:35', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'ArticleID', '1', '', '1'),
(637, '2018-04-23 19:11:35', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'Harga', '1', '', '100000.00'),
(638, '2018-04-23 19:11:35', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'Qty', '1', '', '35'),
(639, '2018-04-23 19:11:35', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'SatuanID', '1', '', '1'),
(640, '2018-04-23 19:11:35', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'SubTotal', '1', '', '3500000'),
(641, '2018-04-23 19:11:35', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'id', '1', '', '1'),
(642, '2018-04-23 19:18:13', '/stok/t08_belilist.php', '1', 'U', 't08_beli', 'Qty', '1', '35.00', '34'),
(643, '2018-04-23 19:18:13', '/stok/t08_belilist.php', '1', 'U', 't08_beli', 'SubTotal', '1', '3500000.00', '3400000'),
(644, '2018-04-23 19:20:15', '/stok/t08_belilist.php', '1', 'U', 't08_beli', 'Qty', '1', '34.00', '36'),
(645, '2018-04-23 19:20:15', '/stok/t08_belilist.php', '1', 'U', 't08_beli', 'SubTotal', '1', '3400000.00', '3600000'),
(646, '2018-04-23 19:21:36', '/stok/t08_belilist.php', '1', 'U', 't08_beli', 'Qty', '1', '36.00', '37'),
(647, '2018-04-23 19:21:36', '/stok/t08_belilist.php', '1', 'U', 't08_beli', 'SubTotal', '1', '3600000.00', '3700000'),
(648, '2018-04-23 19:22:58', '/stok/t08_belilist.php', '1', 'U', 't08_beli', 'Qty', '1', '37.00', '34'),
(649, '2018-04-23 19:22:58', '/stok/t08_belilist.php', '1', 'U', 't08_beli', 'SubTotal', '1', '3700000.00', '3400000'),
(650, '2018-04-23 19:24:33', '/stok/t08_belilist.php', '1', 'U', 't08_beli', 'Qty', '1', '34.00', '33'),
(651, '2018-04-23 19:24:33', '/stok/t08_belilist.php', '1', 'U', 't08_beli', 'SubTotal', '1', '3400000.00', '3300000'),
(652, '2018-04-23 19:49:45', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'NoBayar', '1', '', 'HD000001'),
(653, '2018-04-23 19:49:45', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'Tgl', '1', '', '2018-04-23'),
(654, '2018-04-23 19:49:45', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'JumlahBayar', '1', '', '1000000'),
(655, '2018-04-23 19:49:45', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'HutangID', '1', '', '1'),
(656, '2018-04-23 19:49:45', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'id', '1', '', '1'),
(657, '2018-04-23 19:50:16', '/stok/t08_belilist.php', '1', 'U', 't08_beli', 'Qty', '1', '33.00', '32'),
(658, '2018-04-23 19:50:16', '/stok/t08_belilist.php', '1', 'U', 't08_beli', 'SubTotal', '1', '3300000.00', '3200000'),
(659, '2018-04-23 19:50:53', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'NoBayar', '2', '', 'HD000002'),
(660, '2018-04-23 19:50:53', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'Tgl', '2', '', '2018-04-23'),
(661, '2018-04-23 19:50:53', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'JumlahBayar', '2', '', '500000'),
(662, '2018-04-23 19:50:53', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'HutangID', '2', '', '1'),
(663, '2018-04-23 19:50:53', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'id', '2', '', '2'),
(664, '2018-04-23 20:19:49', '/stok/t08_belidelete.php', '1', '*** Batch delete begin ***', 't08_beli', '', '', '', ''),
(665, '2018-04-23 20:19:49', '/stok/t08_belidelete.php', '1', 'D', 't08_beli', 'id', '1', '1', ''),
(666, '2018-04-23 20:19:49', '/stok/t08_belidelete.php', '1', 'D', 't08_beli', 'TglPO', '1', '2018-04-23', ''),
(667, '2018-04-23 20:19:49', '/stok/t08_belidelete.php', '1', 'D', 't08_beli', 'NoPO', '1', 'PO201804230001', ''),
(668, '2018-04-23 20:19:49', '/stok/t08_belidelete.php', '1', 'D', 't08_beli', 'VendorID', '1', '1', ''),
(669, '2018-04-23 20:19:49', '/stok/t08_belidelete.php', '1', 'D', 't08_beli', 'ArticleID', '1', '1', ''),
(670, '2018-04-23 20:19:49', '/stok/t08_belidelete.php', '1', 'D', 't08_beli', 'Harga', '1', '100000.00', ''),
(671, '2018-04-23 20:19:49', '/stok/t08_belidelete.php', '1', 'D', 't08_beli', 'Qty', '1', '32.00', ''),
(672, '2018-04-23 20:19:49', '/stok/t08_belidelete.php', '1', 'D', 't08_beli', 'SubTotal', '1', '3200000.00', ''),
(673, '2018-04-23 20:19:49', '/stok/t08_belidelete.php', '1', 'D', 't08_beli', 'SatuanID', '1', '1', ''),
(674, '2018-04-23 20:19:50', '/stok/t08_belidelete.php', '1', '*** Batch delete successful ***', 't08_beli', '', '', '', ''),
(675, '2018-04-23 20:23:45', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'TglPO', '2', '', '2018-04-23'),
(676, '2018-04-23 20:23:45', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'NoPO', '2', '', 'PO201804230001'),
(677, '2018-04-23 20:23:45', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'VendorID', '2', '', '1'),
(678, '2018-04-23 20:23:45', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'ArticleID', '2', '', '1'),
(679, '2018-04-23 20:23:45', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'Harga', '2', '', '100000.00'),
(680, '2018-04-23 20:23:45', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'Qty', '2', '', '31'),
(681, '2018-04-23 20:23:45', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'SatuanID', '2', '', '1'),
(682, '2018-04-23 20:23:45', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'SubTotal', '2', '', '3100000'),
(683, '2018-04-23 20:23:45', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'id', '2', '', '2'),
(684, '2018-04-23 20:24:04', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'NoBayar', '1', '', 'HD000001'),
(685, '2018-04-23 20:24:04', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'Tgl', '1', '', '2018-04-23'),
(686, '2018-04-23 20:24:04', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'JumlahBayar', '1', '', '500000'),
(687, '2018-04-23 20:24:04', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'HutangID', '1', '', '1'),
(688, '2018-04-23 20:24:04', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'id', '1', '', '1'),
(689, '2018-04-23 20:24:23', '/stok/t08_belilist.php', '1', 'U', 't08_beli', 'Qty', '2', '31.00', '30'),
(690, '2018-04-23 20:24:23', '/stok/t08_belilist.php', '1', 'U', 't08_beli', 'SubTotal', '2', '3100000.00', '3000000'),
(691, '2018-04-23 20:24:41', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'NoBayar', '2', '', 'HD000002'),
(692, '2018-04-23 20:24:41', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'Tgl', '2', '', '2018-04-23'),
(693, '2018-04-23 20:24:41', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'JumlahBayar', '2', '', '750000'),
(694, '2018-04-23 20:24:41', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'HutangID', '2', '', '1'),
(695, '2018-04-23 20:24:41', '/stok/t10_hutangdetaillist.php', '1', 'A', 't10_hutangdetail', 'id', '2', '', '2'),
(696, '2018-04-23 20:24:52', '/stok/t08_belidelete.php', '1', '*** Batch delete begin ***', 't08_beli', '', '', '', ''),
(697, '2018-04-23 20:24:52', '/stok/t08_belidelete.php', '1', 'D', 't08_beli', 'id', '2', '2', ''),
(698, '2018-04-23 20:24:52', '/stok/t08_belidelete.php', '1', 'D', 't08_beli', 'TglPO', '2', '2018-04-23', ''),
(699, '2018-04-23 20:24:52', '/stok/t08_belidelete.php', '1', 'D', 't08_beli', 'NoPO', '2', 'PO201804230001', ''),
(700, '2018-04-23 20:24:52', '/stok/t08_belidelete.php', '1', 'D', 't08_beli', 'VendorID', '2', '1', ''),
(701, '2018-04-23 20:24:52', '/stok/t08_belidelete.php', '1', 'D', 't08_beli', 'ArticleID', '2', '1', ''),
(702, '2018-04-23 20:24:52', '/stok/t08_belidelete.php', '1', 'D', 't08_beli', 'Harga', '2', '100000.00', ''),
(703, '2018-04-23 20:24:52', '/stok/t08_belidelete.php', '1', 'D', 't08_beli', 'Qty', '2', '30.00', ''),
(704, '2018-04-23 20:24:52', '/stok/t08_belidelete.php', '1', 'D', 't08_beli', 'SubTotal', '2', '3000000.00', ''),
(705, '2018-04-23 20:24:52', '/stok/t08_belidelete.php', '1', 'D', 't08_beli', 'SatuanID', '2', '1', ''),
(706, '2018-04-23 20:24:53', '/stok/t08_belidelete.php', '1', '*** Batch delete successful ***', 't08_beli', '', '', '', ''),
(707, '2018-04-23 20:28:45', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'jdl', '49', 'data tabel <b>beli</b> vs data tabel <b>hutang</b>', '<font color=red><b>done</b></font> data tabel <b>beli</b> vs data tabel <b>hutang</b>'),
(708, '2018-04-23 20:28:57', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'jdl', '50', 'data tabel <b>beli</b> vs data tabel <b>hutang</b>', '<font color=red><b>done</b></font> data tabel <b>beli</b> vs data tabel <b>hutang</b>'),
(709, '2018-04-23 20:34:27', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'tgl', '52', '', '2018-04-23'),
(710, '2018-04-23 20:34:27', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'kat', '52', '', '5log'),
(711, '2018-04-23 20:34:27', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'no_jdl', '52', '', '2'),
(712, '2018-04-23 20:34:27', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'jdl', '52', '', 'hapus trigger di database'),
(713, '2018-04-23 20:34:27', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'no_ket', '52', '', '1'),
(714, '2018-04-23 20:34:27', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'ket', '52', '', 'hapus trigger di database untuk tabel beli, agar tidak ostosmastis mengupdate nilai stok di tabel article (master barang)'),
(715, '2018-04-23 20:34:27', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'home_id', '52', '', '52'),
(716, '2018-04-23 20:46:30', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'tgl', '53', '', '2018-04-23'),
(717, '2018-04-23 20:46:30', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'kat', '53', '', '5log'),
(718, '2018-04-23 20:46:30', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'no_jdl', '53', '', '2'),
(719, '2018-04-23 20:46:30', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'jdl', '53', '', 'hapus trigger di database'),
(720, '2018-04-23 20:46:30', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'no_ket', '53', '', '2'),
(721, '2018-04-23 20:46:30', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'ket', '53', '', 'CREATE TRIGGER `tg_updateqty_beli` AFTER INSERT ON `t08_beli`\r\n FOR EACH ROW BEGIN\r\nupdate t06_article set qty = qty + new.qty where id = new.articleid;\r\nEND'),
(722, '2018-04-23 20:46:30', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'home_id', '53', '', '53'),
(723, '2018-04-23 20:47:15', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'tgl', '54', '', '2018-04-23'),
(724, '2018-04-23 20:47:15', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'kat', '54', '', '5log'),
(725, '2018-04-23 20:47:15', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'no_jdl', '54', '', '2'),
(726, '2018-04-23 20:47:15', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'jdl', '54', '', 'hapus trigger di database'),
(727, '2018-04-23 20:47:15', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'no_ket', '54', '', '2'),
(728, '2018-04-23 20:47:15', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'ket', '54', '', 'CREATE TRIGGER `tg_updateqty_jual` AFTER INSERT ON `t12_jualdetail`\r\n FOR EACH ROW BEGIN\r\nupdate t06_article set qty = qty - new.qty where id = new.articleid;\r\nEND'),
(729, '2018-04-23 20:47:15', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'home_id', '54', '', '54'),
(730, '2018-04-23 21:31:27', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'tgl', '55', '', '2018-04-23'),
(731, '2018-04-23 21:31:27', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'kat', '55', '', '5log'),
(732, '2018-04-23 21:31:27', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'no_jdl', '55', '', '3'),
(733, '2018-04-23 21:31:27', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'jdl', '55', '', 'siapkan tabel mutasi'),
(734, '2018-04-23 21:31:27', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'no_ket', '55', '', '1'),
(735, '2018-04-23 21:31:27', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'ket', '55', '', 'siapkan tabel mutasi, auto insert dari tabel article (master barang), auto insert dari tabel beli, dan auto insert dari tabel jual'),
(736, '2018-04-23 21:31:27', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'home_id', '55', '', '55'),
(737, '2018-04-23 21:33:49', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'tgl', '56', '', '2018-04-23'),
(738, '2018-04-23 21:33:49', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'kat', '56', '', '5log'),
(739, '2018-04-23 21:33:49', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'no_jdl', '56', '', '4'),
(740, '2018-04-23 21:33:49', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'jdl', '56', '', 'siapkan tanggal periode aktif'),
(741, '2018-04-23 21:33:49', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'no_ket', '56', '', NULL),
(742, '2018-04-23 21:33:49', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'ket', '56', '', NULL),
(743, '2018-04-23 21:33:49', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'home_id', '56', '', '56'),
(744, '2018-04-23 21:43:15', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'done', '56', '0', '1'),
(745, '2018-04-23 22:05:36', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'done', '56', '1', '0'),
(746, '2018-04-23 22:08:51', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'done', '56', '0', '1'),
(747, '2018-04-23 22:10:00', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'jdl', '49', '<font color=red><b>done</b></font> data tabel <b>beli</b> vs data tabel <b>hutang</b>', 'data tabel <b>beli</b> vs data tabel <b>hutang</b>'),
(748, '2018-04-23 22:10:00', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'done', '49', '0', '1'),
(749, '2018-04-23 22:10:17', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'jdl', '50', '<font color=red><b>done</b></font> data tabel <b>beli</b> vs data tabel <b>hutang</b>', 'data tabel <b>beli</b> vs data tabel <b>hutang</b>'),
(750, '2018-04-23 22:10:17', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'done', '50', '0', '1'),
(751, '2018-04-23 22:11:02', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'done', '50', '1', '0'),
(752, '2018-04-23 22:12:29', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'done', '56', '1', '0'),
(753, '2018-04-23 22:13:47', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'done', '56', '0', '1'),
(754, '2018-04-23 22:17:35', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'done', '56', '1', '0'),
(755, '2018-04-23 22:43:59', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'done', '56', '0', '1'),
(756, '2018-04-23 22:45:05', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'done', '56', '1', '0'),
(757, '2018-04-23 22:45:19', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'done', '56', '0', '1'),
(758, '2018-04-23 22:47:14', '/stok/t95_homedetailedit.php', '1', 'U', 't95_homedetail', 'done', '56', '1', '0'),
(759, '2018-04-23 22:47:25', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'done', '56', '0', '1'),
(760, '2018-04-23 22:47:48', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'done', '56', '1', '0'),
(761, '2018-04-23 22:53:44', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'done', '53', '0', '1'),
(762, '2018-04-23 22:54:23', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'done', '53', '1', '0'),
(763, '2018-04-23 22:54:47', '/stok/t95_homedetaillist.php', '1', '*** Batch update begin ***', 't95_homedetail', '', '', '', ''),
(764, '2018-04-23 22:54:47', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'done', '52', '0', '1'),
(765, '2018-04-23 22:54:47', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'done', '54', '0', '1'),
(766, '2018-04-23 22:54:48', '/stok/t95_homedetaillist.php', '1', '*** Batch update successful ***', 't95_homedetail', '', '', '', ''),
(767, '2018-04-23 22:55:31', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'done', '53', '0', '1'),
(768, '2018-04-23 22:58:31', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'done', '56', NULL, '1'),
(769, '2018-04-23 22:58:50', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'done', '56', '1', NULL),
(770, '2018-04-23 23:00:53', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'done', '53', NULL, '1'),
(771, '2018-04-23 23:01:17', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'done', '53', '1', NULL),
(772, '2018-04-23 23:01:29', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'done', '52', NULL, '1'),
(773, '2018-04-23 23:02:26', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'done', '52', '1', NULL),
(774, '2018-04-23 23:48:38', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'tgl', '57', '', '2018-04-23'),
(775, '2018-04-23 23:48:38', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'kat', '57', '', '5log'),
(776, '2018-04-23 23:48:38', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'no_jdl', '57', '', '2'),
(777, '2018-04-23 23:48:38', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'jdl', '57', '', 'hapus trigger di database'),
(778, '2018-04-23 23:48:38', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'no_ket', '57', '', '1'),
(779, '2018-04-23 23:48:38', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'ket', '57', '', NULL),
(780, '2018-04-23 23:48:38', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'done', '57', '', NULL),
(781, '2018-04-23 23:48:38', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'home_id', '57', '', '57'),
(782, '2018-04-23 23:49:03', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'no_ket', '54', '2', '4'),
(783, '2018-04-23 23:49:24', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'no_ket', '53', '2', '3'),
(784, '2018-04-23 23:49:37', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'no_ket', '52', '1', '2'),
(785, '2018-04-23 23:50:16', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'done', '57', NULL, '1'),
(786, '2018-04-23 23:56:58', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'tgl', '58', '', '2018-04-23'),
(787, '2018-04-23 23:56:58', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'kat', '58', '', '4todo'),
(788, '2018-04-23 23:56:58', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'no_jdl', '58', '', '1'),
(789, '2018-04-23 23:56:58', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'jdl', '58', '', 'data tabel <b>beli</b> vs data tabel <b>hutang</b>'),
(790, '2018-04-23 23:56:58', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'no_ket', '58', '', '1'),
(791, '2018-04-23 23:56:58', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'ket', '58', '', NULL),
(792, '2018-04-23 23:56:58', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'done', '58', '', '1'),
(793, '2018-04-23 23:56:58', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'home_id', '58', '', '58'),
(794, '2018-04-23 23:57:13', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'no_ket', '50', '2', '3'),
(795, '2018-04-23 23:57:28', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'no_ket', '49', '1', '2'),
(796, '2018-04-24 00:05:06', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'done', '51', NULL, '1'),
(797, '2018-04-24 00:05:49', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'tgl', '59', '', '2018-04-23'),
(798, '2018-04-24 00:05:49', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'kat', '59', '', '5log'),
(799, '2018-04-24 00:05:49', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'no_jdl', '59', '', '1'),
(800, '2018-04-24 00:05:49', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'jdl', '59', '', 'update after-proses di tabel beli'),
(801, '2018-04-24 00:05:49', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'no_ket', '59', '', '2'),
(802, '2018-04-24 00:05:49', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'ket', '59', '', 'update after-proses di tabel beli agar perubahan data juga berpengaruh di tabel hutang'),
(803, '2018-04-24 00:05:49', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'done', '59', '', NULL),
(804, '2018-04-24 00:05:49', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'DoneAll', '59', '', NULL),
(805, '2018-04-24 00:05:49', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'home_id', '59', '', '59'),
(806, '2018-04-24 00:06:07', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'ket', '51', 'update after-proses di tabel beli agar perubahan data juga berpengaruh di tabel hutang', NULL),
(807, '2018-04-24 00:11:19', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'ket', '49', 'setiap entry pembelian ostosmastis menjadi hutang, maka ::', 'setiap entry pembelian ostosmastis menjadi hutang, maka ::\r\n- perubahan pada tabel pembelian juga harus disesuaikan pada tabel hutang'),
(808, '2018-04-24 00:11:36', '/stok/t95_homedetaildelete.php', '1', '*** Batch delete begin ***', 't95_homedetail', '', '', '', ''),
(809, '2018-04-24 00:11:36', '/stok/t95_homedetaildelete.php', '1', 'D', 't95_homedetail', 'home_id', '50', '50', ''),
(810, '2018-04-24 00:11:36', '/stok/t95_homedetaildelete.php', '1', 'D', 't95_homedetail', 'tgl', '50', '2018-04-23', ''),
(811, '2018-04-24 00:11:36', '/stok/t95_homedetaildelete.php', '1', 'D', 't95_homedetail', 'kat', '50', '4todo', ''),
(812, '2018-04-24 00:11:36', '/stok/t95_homedetaildelete.php', '1', 'D', 't95_homedetail', 'no_jdl', '50', '1', ''),
(813, '2018-04-24 00:11:36', '/stok/t95_homedetaildelete.php', '1', 'D', 't95_homedetail', 'jdl', '50', 'data tabel <b>beli</b> vs data tabel <b>hutang</b>', ''),
(814, '2018-04-24 00:11:36', '/stok/t95_homedetaildelete.php', '1', 'D', 't95_homedetail', 'no_ket', '50', '3', ''),
(815, '2018-04-24 00:11:36', '/stok/t95_homedetaildelete.php', '1', 'D', 't95_homedetail', 'ket', '50', 'perubahan pada tabel pembelian juga harus disesuaikan pada tabel hutang', ''),
(816, '2018-04-24 00:11:36', '/stok/t95_homedetaildelete.php', '1', 'D', 't95_homedetail', 'done', '50', NULL, ''),
(817, '2018-04-24 00:11:37', '/stok/t95_homedetaildelete.php', '1', '*** Batch delete successful ***', 't95_homedetail', '', '', '', ''),
(818, '2018-04-24 00:14:04', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'ket', '49', 'setiap entry pembelian ostosmastis menjadi hutang, maka ::\r\n- perubahan pada tabel pembelian juga harus disesuaikan pada tabel hutang', 'setiap pembelian ostosmastis menjadi hutang, maka setiap perubahan pada tabel pembelian juga harus disesuaikan pada tabel hutang'),
(819, '2018-04-24 00:15:08', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'ket', '59', 'update after-proses di tabel beli agar perubahan data juga berpengaruh di tabel hutang', 'update after-proses di tabel beli agar setiap perubahan data di tabel beli juga berpengaruh di tabel hutang'),
(820, '2018-04-24 01:20:03', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'done', '49', NULL, '1'),
(821, '2018-04-24 01:20:37', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'done', '58', '1', NULL),
(822, '2018-04-24 01:21:03', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'done', '58', NULL, '1'),
(823, '2018-04-24 01:21:20', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'done', '49', '1', NULL),
(824, '2018-04-24 11:02:42', '/stok/login.php', 'admin', 'login', '::1', '', '', '', ''),
(825, '2018-04-24 11:21:46', '/stok/t93_parameterlist.php', '1', 'A', 't93_parameter', 'Nama', '1', '', 'Periode'),
(826, '2018-04-24 11:21:46', '/stok/t93_parameterlist.php', '1', 'A', 't93_parameter', 'Nilai', '1', '', '01-04-2018'),
(827, '2018-04-24 11:21:46', '/stok/t93_parameterlist.php', '1', 'A', 't93_parameter', 'id', '1', '', '1'),
(828, '2018-04-24 11:23:53', '/stok/t06_articlelist.php', '1', 'U', 't06_article', 'Qty', '1', '164.25', '100'),
(829, '2018-04-24 11:24:31', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'TglPO', '3', '', '2018-04-24'),
(830, '2018-04-24 11:24:31', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'NoPO', '3', '', 'PO201804240001'),
(831, '2018-04-24 11:24:31', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'VendorID', '3', '', '1'),
(832, '2018-04-24 11:24:31', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'ArticleID', '3', '', '1'),
(833, '2018-04-24 11:24:31', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'Harga', '3', '', '100000.00'),
(834, '2018-04-24 11:24:31', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'Qty', '3', '', '3.5'),
(835, '2018-04-24 11:24:31', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'SatuanID', '3', '', '1'),
(836, '2018-04-24 11:24:31', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'SubTotal', '3', '', '350000'),
(837, '2018-04-24 11:24:31', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'id', '3', '', '3'),
(838, '2018-04-24 11:25:35', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'done', '56', NULL, '1'),
(839, '2018-04-24 12:25:14', '/stok/login.php', 'admin', 'login', '::1', '', '', '', ''),
(840, '2018-04-24 13:17:42', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'tgl', '60', '', '2018-04-23'),
(841, '2018-04-24 13:17:42', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'kat', '60', '', '5log'),
(842, '2018-04-24 13:17:42', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'no_jdl', '60', '', '3'),
(843, '2018-04-24 13:17:42', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'jdl', '60', '', 'siapkan tabel mutasi'),
(844, '2018-04-24 13:17:42', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'no_ket', '60', '', '2'),
(845, '2018-04-24 13:17:42', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'ket', '60', '', 'auto insert dari tabel article (master barang), auto insert dari tabel beli, dan auto insert dari tabel jual'),
(846, '2018-04-24 13:17:42', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'done', '60', '', NULL),
(847, '2018-04-24 13:17:42', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'home_id', '60', '', '60'),
(848, '2018-04-24 13:18:05', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'tgl', '61', '', '2018-04-23'),
(849, '2018-04-24 13:18:05', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'kat', '61', '', '5log'),
(850, '2018-04-24 13:18:05', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'no_jdl', '61', '', '3'),
(851, '2018-04-24 13:18:05', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'jdl', '61', '', 'siapkan tabel mutasi'),
(852, '2018-04-24 13:18:05', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'no_ket', '61', '', '3'),
(853, '2018-04-24 13:18:05', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'ket', '61', '', 'auto insert dari tabel beli, dan auto insert dari tabel jual'),
(854, '2018-04-24 13:18:05', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'done', '61', '', NULL);
INSERT INTO `t99_audittrail` (`id`, `datetime`, `script`, `user`, `action`, `table`, `field`, `keyvalue`, `oldvalue`, `newvalue`) VALUES
(855, '2018-04-24 13:18:05', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'home_id', '61', '', '61'),
(856, '2018-04-24 13:18:23', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'tgl', '62', '', '2018-04-23'),
(857, '2018-04-24 13:18:23', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'kat', '62', '', '5log'),
(858, '2018-04-24 13:18:23', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'no_jdl', '62', '', '3'),
(859, '2018-04-24 13:18:23', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'jdl', '62', '', 'siapkan tabel mutasi'),
(860, '2018-04-24 13:18:23', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'no_ket', '62', '', '4'),
(861, '2018-04-24 13:18:23', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'ket', '62', '', 'auto insert dari tabel jual'),
(862, '2018-04-24 13:18:23', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'done', '62', '', NULL),
(863, '2018-04-24 13:18:23', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'home_id', '62', '', '62'),
(864, '2018-04-24 13:18:38', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'ket', '55', 'siapkan tabel mutasi, auto insert dari tabel article (master barang), auto insert dari tabel beli, dan auto insert dari tabel jual', NULL),
(865, '2018-04-24 13:19:05', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'ket', '60', 'auto insert dari tabel article (master barang), auto insert dari tabel beli, dan auto insert dari tabel jual', 'auto insert dari tabel article (master barang)'),
(866, '2018-04-24 13:19:23', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'ket', '61', 'auto insert dari tabel beli, dan auto insert dari tabel jual', 'auto insert dari tabel beli'),
(867, '2018-04-24 18:04:30', '/stok/login.php', 'admin', 'login', '::1', '', '', '', ''),
(868, '2018-04-24 20:08:21', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'MainGroupID', '2', '', '1'),
(869, '2018-04-24 20:08:21', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'SubGroupID', '2', '', '1'),
(870, '2018-04-24 20:08:21', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'Kode', '2', '', '5501002'),
(871, '2018-04-24 20:08:21', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'Nama', '2', '', 'MEAT Has Dalam Lokal'),
(872, '2018-04-24 20:08:21', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'Qty', '2', '', '50'),
(873, '2018-04-24 20:08:21', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'SatuanID', '2', '', '1'),
(874, '2018-04-24 20:08:21', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'Harga', '2', '', '75000'),
(875, '2018-04-24 20:08:21', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'HargaJual', '2', '', '85000'),
(876, '2018-04-24 20:08:21', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'id', '2', '', '2'),
(877, '2018-04-24 20:15:12', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'MainGroupID', '3', '', '1'),
(878, '2018-04-24 20:15:12', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'SubGroupID', '3', '', '1'),
(879, '2018-04-24 20:15:12', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'Kode', '3', '', '5501003'),
(880, '2018-04-24 20:15:12', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'Nama', '3', '', 'MEAT Has Luar AUS'),
(881, '2018-04-24 20:15:12', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'Qty', '3', '', '25'),
(882, '2018-04-24 20:15:12', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'SatuanID', '3', '', '1'),
(883, '2018-04-24 20:15:12', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'Harga', '3', '', '125000'),
(884, '2018-04-24 20:15:12', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'HargaJual', '3', '', '135000'),
(885, '2018-04-24 20:15:12', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'id', '3', '', '3'),
(886, '2018-04-24 20:38:17', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'MainGroupID', '4', '', '1'),
(887, '2018-04-24 20:38:17', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'SubGroupID', '4', '', '1'),
(888, '2018-04-24 20:38:17', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'Kode', '4', '', '5501004'),
(889, '2018-04-24 20:38:17', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'Nama', '4', '', 'MEAT Has Dalam AUS'),
(890, '2018-04-24 20:38:17', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'Qty', '4', '', '15'),
(891, '2018-04-24 20:38:17', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'SatuanID', '4', '', '1'),
(892, '2018-04-24 20:38:17', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'Harga', '4', '', '179000'),
(893, '2018-04-24 20:38:17', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'HargaJual', '4', '', '200000'),
(894, '2018-04-24 20:38:17', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'id', '4', '', '4'),
(895, '2018-04-24 21:46:49', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'MainGroupID', '5', '', '1'),
(896, '2018-04-24 21:46:49', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'SubGroupID', '5', '', '5'),
(897, '2018-04-24 21:46:49', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'Kode', '5', '', '5504001'),
(898, '2018-04-24 21:46:49', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'Nama', '5', '', 'Nanas'),
(899, '2018-04-24 21:46:49', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'Qty', '5', '', '5'),
(900, '2018-04-24 21:46:49', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'SatuanID', '5', '', '1'),
(901, '2018-04-24 21:46:49', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'Harga', '5', '', '5000'),
(902, '2018-04-24 21:46:49', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'HargaJual', '5', '', '6000'),
(903, '2018-04-24 21:46:49', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'id', '5', '', '5'),
(904, '2018-04-24 21:55:44', '/stok/t06_articlelist.php', '1', 'U', 't06_article', 'Qty', '5', '5.00', '6'),
(905, '2018-04-24 21:59:48', '/stok/t06_articledelete.php', '1', '*** Batch delete begin ***', 't06_article', '', '', '', ''),
(906, '2018-04-24 21:59:48', '/stok/t06_articledelete.php', '1', 'D', 't06_article', 'id', '5', '5', ''),
(907, '2018-04-24 21:59:48', '/stok/t06_articledelete.php', '1', 'D', 't06_article', 'SubGroupID', '5', '5', ''),
(908, '2018-04-24 21:59:48', '/stok/t06_articledelete.php', '1', 'D', 't06_article', 'Kode', '5', '5504001', ''),
(909, '2018-04-24 21:59:48', '/stok/t06_articledelete.php', '1', 'D', 't06_article', 'Nama', '5', 'Nanas', ''),
(910, '2018-04-24 21:59:48', '/stok/t06_articledelete.php', '1', 'D', 't06_article', 'Qty', '5', '6.00', ''),
(911, '2018-04-24 21:59:48', '/stok/t06_articledelete.php', '1', 'D', 't06_article', 'SatuanID', '5', '1', ''),
(912, '2018-04-24 21:59:48', '/stok/t06_articledelete.php', '1', 'D', 't06_article', 'Harga', '5', '5000.00', ''),
(913, '2018-04-24 21:59:48', '/stok/t06_articledelete.php', '1', 'D', 't06_article', 'HargaJual', '5', '6000.00', ''),
(914, '2018-04-24 21:59:48', '/stok/t06_articledelete.php', '1', 'D', 't06_article', 'MainGroupID', '5', '1', ''),
(915, '2018-04-24 21:59:48', '/stok/t06_articledelete.php', '1', '*** Batch delete successful ***', 't06_article', '', '', '', ''),
(916, '2018-04-24 22:02:16', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'ket', '60', 'auto insert dari tabel article (master barang)', 'auto insert - update - delete dari tabel article (master barang)'),
(917, '2018-04-24 22:02:16', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'done', '60', NULL, '1'),
(918, '2018-04-25 01:14:34', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'TglPO', '4', '', '2018-04-25'),
(919, '2018-04-25 01:14:34', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'NoPO', '4', '', 'PO201804250002'),
(920, '2018-04-25 01:14:34', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'VendorID', '4', '', '2'),
(921, '2018-04-25 01:14:34', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'ArticleID', '4', '', '4'),
(922, '2018-04-25 01:14:34', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'Harga', '4', '', '179000.00'),
(923, '2018-04-25 01:14:34', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'Qty', '4', '', '1.2'),
(924, '2018-04-25 01:14:34', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'SatuanID', '4', '', '1'),
(925, '2018-04-25 01:14:34', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'SubTotal', '4', '', '214800'),
(926, '2018-04-25 01:14:34', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'id', '4', '', '4'),
(927, '2018-04-25 01:46:26', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'MainGroupID', '1', '', '1'),
(928, '2018-04-25 01:46:26', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'SubGroupID', '1', '', '1'),
(929, '2018-04-25 01:46:26', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'Kode', '1', '', '5501001'),
(930, '2018-04-25 01:46:26', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'Nama', '1', '', 'Meat 1'),
(931, '2018-04-25 01:46:26', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'Qty', '1', '', '20'),
(932, '2018-04-25 01:46:26', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'SatuanID', '1', '', '1'),
(933, '2018-04-25 01:46:26', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'Harga', '1', '', '95000'),
(934, '2018-04-25 01:46:26', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'HargaJual', '1', '', '125000'),
(935, '2018-04-25 01:46:26', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'id', '1', '', '1'),
(936, '2018-04-25 01:47:36', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'TglPO', '1', '', '2018-04-25'),
(937, '2018-04-25 01:47:36', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'NoPO', '1', '', 'PO201804250001'),
(938, '2018-04-25 01:47:36', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'VendorID', '1', '', '1'),
(939, '2018-04-25 01:47:36', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'ArticleID', '1', '', '1'),
(940, '2018-04-25 01:47:36', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'Harga', '1', '', '95000.00'),
(941, '2018-04-25 01:47:36', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'Qty', '1', '', '3'),
(942, '2018-04-25 01:47:36', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'SatuanID', '1', '', '1'),
(943, '2018-04-25 01:47:36', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'SubTotal', '1', '', '285000'),
(944, '2018-04-25 01:47:36', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'id', '1', '', '1'),
(945, '2018-04-25 01:49:09', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'TglPO', '2', '', '2018-04-25'),
(946, '2018-04-25 01:49:09', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'NoPO', '2', '', 'PO201804250002'),
(947, '2018-04-25 01:49:09', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'VendorID', '2', '', '2'),
(948, '2018-04-25 01:49:09', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'ArticleID', '2', '', '1'),
(949, '2018-04-25 01:49:09', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'Harga', '2', '', '95000.00'),
(950, '2018-04-25 01:49:09', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'Qty', '2', '', '6'),
(951, '2018-04-25 01:49:09', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'SatuanID', '2', '', '1'),
(952, '2018-04-25 01:49:09', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'SubTotal', '2', '', '570000'),
(953, '2018-04-25 01:49:09', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'id', '2', '', '2'),
(954, '2018-04-25 01:49:53', '/stok/t08_belidelete.php', '1', '*** Batch delete begin ***', 't08_beli', '', '', '', ''),
(955, '2018-04-25 01:49:53', '/stok/t08_belidelete.php', '1', 'D', 't08_beli', 'id', '1', '1', ''),
(956, '2018-04-25 01:49:53', '/stok/t08_belidelete.php', '1', 'D', 't08_beli', 'TglPO', '1', '2018-04-25', ''),
(957, '2018-04-25 01:49:53', '/stok/t08_belidelete.php', '1', 'D', 't08_beli', 'NoPO', '1', 'PO201804250001', ''),
(958, '2018-04-25 01:49:53', '/stok/t08_belidelete.php', '1', 'D', 't08_beli', 'VendorID', '1', '1', ''),
(959, '2018-04-25 01:49:53', '/stok/t08_belidelete.php', '1', 'D', 't08_beli', 'ArticleID', '1', '1', ''),
(960, '2018-04-25 01:49:53', '/stok/t08_belidelete.php', '1', 'D', 't08_beli', 'Harga', '1', '95000.00', ''),
(961, '2018-04-25 01:49:53', '/stok/t08_belidelete.php', '1', 'D', 't08_beli', 'Qty', '1', '3.00', ''),
(962, '2018-04-25 01:49:53', '/stok/t08_belidelete.php', '1', 'D', 't08_beli', 'SubTotal', '1', '285000.00', ''),
(963, '2018-04-25 01:49:53', '/stok/t08_belidelete.php', '1', 'D', 't08_beli', 'SatuanID', '1', '1', ''),
(964, '2018-04-25 01:49:54', '/stok/t08_belidelete.php', '1', '*** Batch delete successful ***', 't08_beli', '', '', '', ''),
(965, '2018-04-25 01:50:25', '/stok/t08_belilist.php', '1', 'U', 't08_beli', 'Qty', '2', '6.00', '6.1'),
(966, '2018-04-25 01:50:25', '/stok/t08_belilist.php', '1', 'U', 't08_beli', 'SubTotal', '2', '570000.00', '579500'),
(967, '2018-04-25 01:52:53', '/stok/t08_belilist.php', '1', 'U', 't08_beli', 'Qty', '2', '6.10', '6.2'),
(968, '2018-04-25 01:52:53', '/stok/t08_belilist.php', '1', 'U', 't08_beli', 'SubTotal', '2', '579500.00', '589000'),
(969, '2018-04-25 01:56:01', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'ket', '61', 'auto insert dari tabel beli', 'auto insert - update - delete dari tabel beli'),
(970, '2018-04-25 01:56:01', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'done', '61', NULL, '1'),
(971, '2018-04-25 01:56:48', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'tgl', '63', '', '2018-04-25'),
(972, '2018-04-25 01:56:48', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'kat', '63', '', '5log'),
(973, '2018-04-25 01:56:48', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'no_jdl', '63', '', '1'),
(974, '2018-04-25 01:56:48', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'jdl', '63', '', 'siapkan laporan mutasi'),
(975, '2018-04-25 01:56:48', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'no_ket', '63', '', NULL),
(976, '2018-04-25 01:56:48', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'ket', '63', '', NULL),
(977, '2018-04-25 01:56:48', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'done', '63', '', NULL),
(978, '2018-04-25 01:56:48', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'home_id', '63', '', '63'),
(979, '2018-04-25 12:48:40', '/stok/login.php', 'admin', 'login', '::1', '', '', '', ''),
(980, '2018-04-25 13:03:23', '/stok/t11_jualadd.php', '1', 'A', 't11_jual', 'TglSO', '1', '', '2018-04-25'),
(981, '2018-04-25 13:03:23', '/stok/t11_jualadd.php', '1', 'A', 't11_jual', 'NoSO', '1', '', 'SO201804250001'),
(982, '2018-04-25 13:03:23', '/stok/t11_jualadd.php', '1', 'A', 't11_jual', 'CustomerID', '1', '', '1'),
(983, '2018-04-25 13:03:23', '/stok/t11_jualadd.php', '1', 'A', 't11_jual', 'CustomerPO', '1', '', 'PO99'),
(984, '2018-04-25 13:03:23', '/stok/t11_jualadd.php', '1', 'A', 't11_jual', 'Total', '1', '', '0'),
(985, '2018-04-25 13:03:23', '/stok/t11_jualadd.php', '1', 'A', 't11_jual', 'id', '1', '', '1'),
(986, '2018-04-25 13:03:24', '/stok/t11_jualadd.php', '1', '*** Batch insert begin ***', 't12_jualdetail', '', '', '', ''),
(987, '2018-04-25 13:03:24', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'JualID', '1', '', '1'),
(988, '2018-04-25 13:03:24', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'ArticleID', '1', '', '1'),
(989, '2018-04-25 13:03:24', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'HargaJual', '1', '', '125000.00'),
(990, '2018-04-25 13:03:24', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'Qty', '1', '', '3'),
(991, '2018-04-25 13:03:24', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'SatuanID', '1', '', '1'),
(992, '2018-04-25 13:03:24', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'SubTotal', '1', '', '375000'),
(993, '2018-04-25 13:03:24', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'id', '1', '', '1'),
(994, '2018-04-25 13:03:24', '/stok/t11_jualadd.php', '1', '*** Batch insert successful ***', 't12_jualdetail', '', '', '', ''),
(995, '2018-04-25 13:13:40', '/stok/t11_jualadd.php', '1', 'A', 't11_jual', 'TglSO', '1', '', '2018-04-25'),
(996, '2018-04-25 13:13:40', '/stok/t11_jualadd.php', '1', 'A', 't11_jual', 'NoSO', '1', '', 'SO201804250001'),
(997, '2018-04-25 13:13:40', '/stok/t11_jualadd.php', '1', 'A', 't11_jual', 'CustomerID', '1', '', '2'),
(998, '2018-04-25 13:13:40', '/stok/t11_jualadd.php', '1', 'A', 't11_jual', 'CustomerPO', '1', '', 'xxx'),
(999, '2018-04-25 13:13:40', '/stok/t11_jualadd.php', '1', 'A', 't11_jual', 'Total', '1', '', '0'),
(1000, '2018-04-25 13:13:40', '/stok/t11_jualadd.php', '1', 'A', 't11_jual', 'id', '1', '', '1'),
(1001, '2018-04-25 13:13:40', '/stok/t11_jualadd.php', '1', '*** Batch insert begin ***', 't12_jualdetail', '', '', '', ''),
(1002, '2018-04-25 13:13:40', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'JualID', '1', '', '1'),
(1003, '2018-04-25 13:13:40', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'ArticleID', '1', '', '1'),
(1004, '2018-04-25 13:13:40', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'HargaJual', '1', '', '125000.00'),
(1005, '2018-04-25 13:13:40', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'Qty', '1', '', '4'),
(1006, '2018-04-25 13:13:40', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'SatuanID', '1', '', '1'),
(1007, '2018-04-25 13:13:40', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'SubTotal', '1', '', '500000'),
(1008, '2018-04-25 13:13:40', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'id', '1', '', '1'),
(1009, '2018-04-25 13:13:40', '/stok/t11_jualadd.php', '1', '*** Batch insert successful ***', 't12_jualdetail', '', '', '', ''),
(1010, '2018-04-25 13:15:10', '/stok/t12_jualdetailedit.php', '1', 'U', 't12_jualdetail', 'Qty', '1', '4.00', '4.5'),
(1011, '2018-04-25 13:15:10', '/stok/t12_jualdetailedit.php', '1', 'U', 't12_jualdetail', 'SubTotal', '1', '500000.00', '562500'),
(1012, '2018-04-25 13:15:36', '/stok/t12_jualdetailadd.php', '1', 'A', 't12_jualdetail', 'JualID', '2', '', '1'),
(1013, '2018-04-25 13:15:36', '/stok/t12_jualdetailadd.php', '1', 'A', 't12_jualdetail', 'ArticleID', '2', '', '1'),
(1014, '2018-04-25 13:15:36', '/stok/t12_jualdetailadd.php', '1', 'A', 't12_jualdetail', 'HargaJual', '2', '', '125000.00'),
(1015, '2018-04-25 13:15:36', '/stok/t12_jualdetailadd.php', '1', 'A', 't12_jualdetail', 'Qty', '2', '', '5'),
(1016, '2018-04-25 13:15:36', '/stok/t12_jualdetailadd.php', '1', 'A', 't12_jualdetail', 'SatuanID', '2', '', '1'),
(1017, '2018-04-25 13:15:36', '/stok/t12_jualdetailadd.php', '1', 'A', 't12_jualdetail', 'SubTotal', '2', '', '625000'),
(1018, '2018-04-25 13:15:36', '/stok/t12_jualdetailadd.php', '1', 'A', 't12_jualdetail', 'id', '2', '', '2'),
(1019, '2018-04-25 13:16:44', '/stok/t12_jualdetailedit.php', '1', 'U', 't12_jualdetail', 'Qty', '1', '4.50', '4.75'),
(1020, '2018-04-25 13:16:44', '/stok/t12_jualdetailedit.php', '1', 'U', 't12_jualdetail', 'SubTotal', '1', '562500.00', '593750'),
(1021, '2018-04-25 13:17:18', '/stok/t12_jualdetaildelete.php', '1', '*** Batch delete begin ***', 't12_jualdetail', '', '', '', ''),
(1022, '2018-04-25 13:17:19', '/stok/t12_jualdetaildelete.php', '1', 'D', 't12_jualdetail', 'id', '1', '1', ''),
(1023, '2018-04-25 13:17:19', '/stok/t12_jualdetaildelete.php', '1', 'D', 't12_jualdetail', 'JualID', '1', '1', ''),
(1024, '2018-04-25 13:17:19', '/stok/t12_jualdetaildelete.php', '1', 'D', 't12_jualdetail', 'ArticleID', '1', '1', ''),
(1025, '2018-04-25 13:17:19', '/stok/t12_jualdetaildelete.php', '1', 'D', 't12_jualdetail', 'HargaJual', '1', '125000.00', ''),
(1026, '2018-04-25 13:17:19', '/stok/t12_jualdetaildelete.php', '1', 'D', 't12_jualdetail', 'Qty', '1', '4.75', ''),
(1027, '2018-04-25 13:17:19', '/stok/t12_jualdetaildelete.php', '1', 'D', 't12_jualdetail', 'SubTotal', '1', '593750.00', ''),
(1028, '2018-04-25 13:17:19', '/stok/t12_jualdetaildelete.php', '1', 'D', 't12_jualdetail', 'SatuanID', '1', '1', ''),
(1029, '2018-04-25 13:17:19', '/stok/t12_jualdetaildelete.php', '1', '*** Batch delete successful ***', 't12_jualdetail', '', '', '', ''),
(1030, '2018-04-25 13:18:37', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'ket', '62', 'auto insert dari tabel jual', 'auto insert - update - delete dari tabel jual'),
(1031, '2018-04-25 13:18:37', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'done', '62', NULL, '1'),
(1032, '2018-04-25 13:49:39', '/stok/login.php', 'admin', 'login', '::1', '', '', '', ''),
(1033, '2018-04-25 14:52:09', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'MainGroupID', '2', '', '2'),
(1034, '2018-04-25 14:52:09', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'SubGroupID', '2', '', '4'),
(1035, '2018-04-25 14:52:09', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'Kode', '2', '', '6601001'),
(1036, '2018-04-25 14:52:09', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'Nama', '2', '', 'MW 1'),
(1037, '2018-04-25 14:52:09', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'Qty', '2', '', '24'),
(1038, '2018-04-25 14:52:09', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'SatuanID', '2', '', '3'),
(1039, '2018-04-25 14:52:09', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'Harga', '2', '', '14500'),
(1040, '2018-04-25 14:52:09', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'HargaJual', '2', '', '18000'),
(1041, '2018-04-25 14:52:09', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'id', '2', '', '2'),
(1042, '2018-04-25 14:54:21', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'MainGroupID', '3', '', '1'),
(1043, '2018-04-25 14:54:21', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'SubGroupID', '3', '', '5'),
(1044, '2018-04-25 14:54:21', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'Kode', '3', '', '5504001'),
(1045, '2018-04-25 14:54:21', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'Nama', '3', '', 'Apel'),
(1046, '2018-04-25 14:54:21', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'Qty', '3', '', '4'),
(1047, '2018-04-25 14:54:21', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'SatuanID', '3', '', '1'),
(1048, '2018-04-25 14:54:21', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'Harga', '3', '', '37500'),
(1049, '2018-04-25 14:54:21', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'HargaJual', '3', '', '50000'),
(1050, '2018-04-25 14:54:21', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'id', '3', '', '3'),
(1051, '2018-04-25 14:57:58', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'MainGroupID', '4', '', '1'),
(1052, '2018-04-25 14:57:58', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'SubGroupID', '4', '', '8'),
(1053, '2018-04-25 14:57:58', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'Kode', '4', '', '5507001'),
(1054, '2018-04-25 14:57:58', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'Nama', '4', '', 'Veg 1'),
(1055, '2018-04-25 14:57:58', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'Qty', '4', '', '13'),
(1056, '2018-04-25 14:57:58', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'SatuanID', '4', '', '1'),
(1057, '2018-04-25 14:57:58', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'Harga', '4', '', '1500'),
(1058, '2018-04-25 14:57:58', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'HargaJual', '4', '', '7500'),
(1059, '2018-04-25 14:57:58', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'id', '4', '', '4'),
(1060, '2018-04-25 15:06:39', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'MainGroupID', '5', '', '2'),
(1061, '2018-04-25 15:06:39', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'SubGroupID', '5', '', '10'),
(1062, '2018-04-25 15:06:39', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'Kode', '5', '', '6602001'),
(1063, '2018-04-25 15:06:39', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'Nama', '5', '', 'Heineken 1'),
(1064, '2018-04-25 15:06:39', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'Qty', '5', '', '5'),
(1065, '2018-04-25 15:06:39', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'SatuanID', '5', '', '3'),
(1066, '2018-04-25 15:06:39', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'Harga', '5', '', '75000'),
(1067, '2018-04-25 15:06:39', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'HargaJual', '5', '', '100000'),
(1068, '2018-04-25 15:06:39', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'id', '5', '', '5'),
(1069, '2018-04-25 15:11:54', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'MainGroupID', '6', '', '2'),
(1070, '2018-04-25 15:11:54', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'SubGroupID', '6', '', '13'),
(1071, '2018-04-25 15:11:54', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'Kode', '6', '', '6605001'),
(1072, '2018-04-25 15:11:54', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'Nama', '6', '', 'SYRP 1'),
(1073, '2018-04-25 15:11:54', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'Qty', '6', '', '3'),
(1074, '2018-04-25 15:11:54', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'SatuanID', '6', '', '3'),
(1075, '2018-04-25 15:11:54', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'Harga', '6', '', '75000'),
(1076, '2018-04-25 15:11:54', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'HargaJual', '6', '', '200000'),
(1077, '2018-04-25 15:11:54', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'id', '6', '', '6'),
(1078, '2018-04-25 15:12:50', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'TglPO', '3', '', '2018-04-25'),
(1079, '2018-04-25 15:12:50', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'NoPO', '3', '', 'PO201804250003'),
(1080, '2018-04-25 15:12:50', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'VendorID', '3', '', '2'),
(1081, '2018-04-25 15:12:50', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'ArticleID', '3', '', '6'),
(1082, '2018-04-25 15:12:50', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'Harga', '3', '', '75000.00'),
(1083, '2018-04-25 15:12:50', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'Qty', '3', '', '1'),
(1084, '2018-04-25 15:12:50', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'SatuanID', '3', '', '3'),
(1085, '2018-04-25 15:12:50', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'SubTotal', '3', '', '75000'),
(1086, '2018-04-25 15:12:50', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'id', '3', '', '3'),
(1087, '2018-04-25 15:13:48', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'TglPO', '4', '', '2018-04-25'),
(1088, '2018-04-25 15:13:48', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'NoPO', '4', '', 'PO201804250004'),
(1089, '2018-04-25 15:13:48', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'VendorID', '4', '', '2'),
(1090, '2018-04-25 15:13:48', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'ArticleID', '4', '', '6'),
(1091, '2018-04-25 15:13:48', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'Harga', '4', '', '75000.00'),
(1092, '2018-04-25 15:13:48', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'Qty', '4', '', '7'),
(1093, '2018-04-25 15:13:48', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'SatuanID', '4', '', '3'),
(1094, '2018-04-25 15:13:48', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'SubTotal', '4', '', '525000'),
(1095, '2018-04-25 15:13:48', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'id', '4', '', '4'),
(1096, '2018-04-25 15:14:47', '/stok/t06_articlelist.php', '1', 'U', 't06_article', 'Qty', '1', '20.00', '19'),
(1097, '2018-04-25 15:18:53', '/stok/t11_jualadd.php', '1', 'A', 't11_jual', 'TglSO', '2', '', '2018-04-25'),
(1098, '2018-04-25 15:18:53', '/stok/t11_jualadd.php', '1', 'A', 't11_jual', 'NoSO', '2', '', 'SO201804250002'),
(1099, '2018-04-25 15:18:53', '/stok/t11_jualadd.php', '1', 'A', 't11_jual', 'CustomerID', '2', '', '2'),
(1100, '2018-04-25 15:18:53', '/stok/t11_jualadd.php', '1', 'A', 't11_jual', 'CustomerPO', '2', '', 'xxx'),
(1101, '2018-04-25 15:18:53', '/stok/t11_jualadd.php', '1', 'A', 't11_jual', 'Total', '2', '', '0'),
(1102, '2018-04-25 15:18:53', '/stok/t11_jualadd.php', '1', 'A', 't11_jual', 'id', '2', '', '2'),
(1103, '2018-04-25 15:18:53', '/stok/t11_jualadd.php', '1', '*** Batch insert begin ***', 't12_jualdetail', '', '', '', ''),
(1104, '2018-04-25 15:18:53', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'JualID', '3', '', '2'),
(1105, '2018-04-25 15:18:53', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'ArticleID', '3', '', '6'),
(1106, '2018-04-25 15:18:53', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'HargaJual', '3', '', '200000.00'),
(1107, '2018-04-25 15:18:53', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'Qty', '3', '', '5'),
(1108, '2018-04-25 15:18:53', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'SatuanID', '3', '', '3'),
(1109, '2018-04-25 15:18:53', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'SubTotal', '3', '', '1000000'),
(1110, '2018-04-25 15:18:53', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'id', '3', '', '3'),
(1111, '2018-04-25 15:18:53', '/stok/t11_jualadd.php', '1', '*** Batch insert successful ***', 't12_jualdetail', '', '', '', ''),
(1112, '2018-04-25 17:55:23', '/stok/login.php', 'admin', 'login', '::1', '', '', '', ''),
(1113, '2018-04-25 18:03:10', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'done', '63', NULL, '1'),
(1114, '2018-04-25 18:40:43', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'tgl', '64', '', '2018-04-25'),
(1115, '2018-04-25 18:40:43', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'kat', '64', '', '5log'),
(1116, '2018-04-25 18:40:43', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'no_jdl', '64', '', '1'),
(1117, '2018-04-25 18:40:43', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'jdl', '64', '', 'tabel mutasi; tambah field noref;'),
(1118, '2018-04-25 18:40:43', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'no_ket', '64', '', NULL),
(1119, '2018-04-25 18:40:43', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'ket', '64', '', NULL),
(1120, '2018-04-25 18:40:43', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'done', '64', '', NULL),
(1121, '2018-04-25 18:40:43', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'home_id', '64', '', '64'),
(1122, '2018-04-25 18:55:52', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'TglPO', '5', '', '2018-04-25'),
(1123, '2018-04-25 18:55:52', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'NoPO', '5', '', 'PO201804250005'),
(1124, '2018-04-25 18:55:52', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'VendorID', '5', '', '1'),
(1125, '2018-04-25 18:55:52', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'ArticleID', '5', '', '1'),
(1126, '2018-04-25 18:55:52', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'Harga', '5', '', '95000.00'),
(1127, '2018-04-25 18:55:52', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'Qty', '5', '', '1'),
(1128, '2018-04-25 18:55:52', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'SatuanID', '5', '', '1'),
(1129, '2018-04-25 18:55:52', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'SubTotal', '5', '', '95000'),
(1130, '2018-04-25 18:55:52', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'id', '5', '', '5'),
(1131, '2018-04-25 19:18:36', '/stok/t11_jualadd.php', '1', 'A', 't11_jual', 'TglSO', '3', '', '2018-04-25'),
(1132, '2018-04-25 19:18:36', '/stok/t11_jualadd.php', '1', 'A', 't11_jual', 'NoSO', '3', '', 'SO201804250003'),
(1133, '2018-04-25 19:18:36', '/stok/t11_jualadd.php', '1', 'A', 't11_jual', 'CustomerID', '3', '', '2'),
(1134, '2018-04-25 19:18:36', '/stok/t11_jualadd.php', '1', 'A', 't11_jual', 'CustomerPO', '3', '', 'xxx'),
(1135, '2018-04-25 19:18:36', '/stok/t11_jualadd.php', '1', 'A', 't11_jual', 'Total', '3', '', '0'),
(1136, '2018-04-25 19:18:36', '/stok/t11_jualadd.php', '1', 'A', 't11_jual', 'id', '3', '', '3'),
(1137, '2018-04-25 19:18:36', '/stok/t11_jualadd.php', '1', '*** Batch insert begin ***', 't12_jualdetail', '', '', '', ''),
(1138, '2018-04-25 19:18:36', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'JualID', '4', '', '3'),
(1139, '2018-04-25 19:18:36', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'ArticleID', '4', '', '5'),
(1140, '2018-04-25 19:18:36', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'HargaJual', '4', '', '100000.00'),
(1141, '2018-04-25 19:18:36', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'Qty', '4', '', '5'),
(1142, '2018-04-25 19:18:36', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'SatuanID', '4', '', '3'),
(1143, '2018-04-25 19:18:36', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'SubTotal', '4', '', '500000'),
(1144, '2018-04-25 19:18:36', '/stok/t11_jualadd.php', '1', 'A', 't12_jualdetail', 'id', '4', '', '4'),
(1145, '2018-04-25 19:18:37', '/stok/t11_jualadd.php', '1', '*** Batch insert successful ***', 't12_jualdetail', '', '', '', ''),
(1146, '2018-04-25 22:46:56', '/stok/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(1147, '2018-04-25 22:47:01', '/stok/login.php', 'admin', 'login', '::1', '', '', '', ''),
(1148, '2018-04-26 02:23:43', '/stok/t95_homedetaillist.php', '1', '*** Batch insert begin ***', 't95_homedetail', '', '', '', ''),
(1149, '2018-04-26 02:23:43', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'tgl', '65', '', '2018-04-26'),
(1150, '2018-04-26 02:23:43', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'kat', '65', '', '5log'),
(1151, '2018-04-26 02:23:43', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'no_jdl', '65', '', '1'),
(1152, '2018-04-26 02:23:43', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'jdl', '65', '', 'tabel mutasi'),
(1153, '2018-04-26 02:23:43', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'no_ket', '65', '', NULL),
(1154, '2018-04-26 02:23:43', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'ket', '65', '', NULL),
(1155, '2018-04-26 02:23:43', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'done', '65', '', NULL),
(1156, '2018-04-26 02:23:43', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'home_id', '65', '', '65'),
(1157, '2018-04-26 02:23:44', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'tgl', '66', '', '2018-04-26'),
(1158, '2018-04-26 02:23:44', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'kat', '66', '', '5log'),
(1159, '2018-04-26 02:23:44', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'no_jdl', '66', '', '1'),
(1160, '2018-04-26 02:23:44', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'jdl', '66', '', 'tabel mutasi'),
(1161, '2018-04-26 02:23:44', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'no_ket', '66', '', '1'),
(1162, '2018-04-26 02:23:44', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'ket', '66', '', 'harus simpan kode article agar bisa sor by kode'),
(1163, '2018-04-26 02:23:44', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'done', '66', '', NULL),
(1164, '2018-04-26 02:23:44', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'home_id', '66', '', '66'),
(1165, '2018-04-26 02:23:44', '/stok/t95_homedetaillist.php', '1', '*** Batch insert successful ***', 't95_homedetail', '', '', '', ''),
(1166, '2018-04-26 08:37:56', '/stok/login.php', 'admin', 'login', '::1', '', '', '', ''),
(1167, '2018-04-26 08:38:29', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'ket', '66', 'harus simpan kode article agar bisa sor by kode', 'harus simpan kode article agar bisa sort by kode'),
(1168, '2018-04-26 08:54:01', '/stok/t06_articlelist.php', '1', 'U', 't06_article', 'Nama', '1', 'Meat 1', 'Meat 1x'),
(1169, '2018-04-26 08:55:57', '/stok/t06_articlelist.php', '1', 'U', 't06_article', 'Nama', '1', 'Meat 1x', 'Meat 1xy'),
(1170, '2018-04-26 08:57:54', '/stok/t06_articlelist.php', '1', 'U', 't06_article', 'Nama', '1', 'Meat 1xy', 'Meat 1xyz'),
(1171, '2018-04-26 09:11:11', '/stok/t06_articlelist.php', '1', 'U', 't06_article', 'Nama', '3', 'Apel', 'Apel x'),
(1172, '2018-04-26 09:11:18', '/stok/t06_articlelist.php', '1', 'U', 't06_article', 'Nama', '4', 'Veg 1', 'Veg 1x'),
(1173, '2018-04-26 09:11:25', '/stok/t06_articlelist.php', '1', 'U', 't06_article', 'Nama', '2', 'MW 1', 'MW 1x'),
(1174, '2018-04-26 09:11:31', '/stok/t06_articlelist.php', '1', 'U', 't06_article', 'Nama', '5', 'Heineken 1', 'Heineken 1x'),
(1175, '2018-04-26 09:11:38', '/stok/t06_articlelist.php', '1', 'U', 't06_article', 'Nama', '6', 'SYRP 1', 'SYRP 1x'),
(1176, '2018-04-26 09:19:06', '/stok/t95_homedetaillist.php', '1', '*** Batch update begin ***', 't95_homedetail', '', '', '', ''),
(1177, '2018-04-26 09:19:06', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'done', '64', NULL, '1'),
(1178, '2018-04-26 09:19:06', '/stok/t95_homedetaillist.php', '1', 'U', 't95_homedetail', 'done', '65', NULL, '1'),
(1179, '2018-04-26 09:19:06', '/stok/t95_homedetaillist.php', '1', '*** Batch update successful ***', 't95_homedetail', '', '', '', ''),
(1180, '2018-04-26 09:50:16', '/stok/t06_articlelist.php', '1', 'U', 't06_article', 'Nama', '1', 'Meat 1xyz', 'Meat'),
(1181, '2018-04-26 09:50:24', '/stok/t06_articlelist.php', '1', 'U', 't06_article', 'Nama', '3', 'Apel x', 'Apel'),
(1182, '2018-04-26 09:50:31', '/stok/t06_articlelist.php', '1', 'U', 't06_article', 'Nama', '4', 'Veg 1x', 'Veg'),
(1183, '2018-04-26 09:50:39', '/stok/t06_articlelist.php', '1', 'U', 't06_article', 'Nama', '2', 'MW 1x', 'MW'),
(1184, '2018-04-26 09:51:02', '/stok/t06_articlelist.php', '1', 'U', 't06_article', 'Nama', '5', 'Heineken 1x', 'Heineken'),
(1185, '2018-04-26 09:52:48', '/stok/t06_articlelist.php', '1', 'U', 't06_article', 'Nama', '6', 'SYRP 1x', 'SYRP'),
(1186, '2018-04-26 11:13:46', '/stok/t11_jualedit.php', '1', '*** Batch update begin ***', 't12_jualdetail', '', '', '', ''),
(1187, '2018-04-26 11:13:46', '/stok/t11_jualedit.php', '1', 'A', 't12_jualdetail', 'JualID', '5', '', '1'),
(1188, '2018-04-26 11:13:46', '/stok/t11_jualedit.php', '1', 'A', 't12_jualdetail', 'ArticleID', '5', '', '2'),
(1189, '2018-04-26 11:13:46', '/stok/t11_jualedit.php', '1', 'A', 't12_jualdetail', 'HargaJual', '5', '', '18000.00'),
(1190, '2018-04-26 11:13:46', '/stok/t11_jualedit.php', '1', 'A', 't12_jualdetail', 'Qty', '5', '', '2'),
(1191, '2018-04-26 11:13:46', '/stok/t11_jualedit.php', '1', 'A', 't12_jualdetail', 'SatuanID', '5', '', '3'),
(1192, '2018-04-26 11:13:46', '/stok/t11_jualedit.php', '1', 'A', 't12_jualdetail', 'SubTotal', '5', '', '36000'),
(1193, '2018-04-26 11:13:46', '/stok/t11_jualedit.php', '1', 'A', 't12_jualdetail', 'id', '5', '', '5'),
(1194, '2018-04-26 11:13:46', '/stok/t11_jualedit.php', '1', '*** Batch update successful ***', 't12_jualdetail', '', '', '', ''),
(1195, '2018-04-26 11:15:51', '/stok/t95_homedetaillist.php', '1', '*** Batch insert begin ***', 't95_homedetail', '', '', '', ''),
(1196, '2018-04-26 11:15:51', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'tgl', '67', '', '2018-04-26'),
(1197, '2018-04-26 11:15:51', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'kat', '67', '', '4todo'),
(1198, '2018-04-26 11:15:51', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'no_jdl', '67', '', '1'),
(1199, '2018-04-26 11:15:51', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'jdl', '67', '', 'transaksi piutang'),
(1200, '2018-04-26 11:15:51', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'no_ket', '67', '', NULL),
(1201, '2018-04-26 11:15:51', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'ket', '67', '', NULL),
(1202, '2018-04-26 11:15:51', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'done', '67', '', NULL),
(1203, '2018-04-26 11:15:51', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'home_id', '67', '', '67'),
(1204, '2018-04-26 11:15:51', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'tgl', '68', '', '2018-04-26'),
(1205, '2018-04-26 11:15:51', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'kat', '68', '', '4todo'),
(1206, '2018-04-26 11:15:51', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'no_jdl', '68', '', '2'),
(1207, '2018-04-26 11:15:51', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'jdl', '68', '', 'laporan piutang'),
(1208, '2018-04-26 11:15:51', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'no_ket', '68', '', NULL),
(1209, '2018-04-26 11:15:51', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'ket', '68', '', NULL),
(1210, '2018-04-26 11:15:51', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'done', '68', '', NULL),
(1211, '2018-04-26 11:15:51', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'home_id', '68', '', '68'),
(1212, '2018-04-26 11:15:51', '/stok/t95_homedetaillist.php', '1', '*** Batch insert successful ***', 't95_homedetail', '', '', '', ''),
(1213, '2018-04-26 11:22:08', '/stok/t95_homedetaillist.php', '1', '*** Batch insert begin ***', 't95_homedetail', '', '', '', ''),
(1214, '2018-04-26 11:22:08', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'tgl', '69', '', '2018-04-26'),
(1215, '2018-04-26 11:22:08', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'kat', '69', '', '4todo'),
(1216, '2018-04-26 11:22:08', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'no_jdl', '69', '', '3'),
(1217, '2018-04-26 11:22:08', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'jdl', '69', '', 'cetak surat jalan'),
(1218, '2018-04-26 11:22:08', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'no_ket', '69', '', NULL),
(1219, '2018-04-26 11:22:08', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'ket', '69', '', NULL),
(1220, '2018-04-26 11:22:08', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'done', '69', '', NULL),
(1221, '2018-04-26 11:22:08', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'home_id', '69', '', '69'),
(1222, '2018-04-26 11:22:08', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'tgl', '70', '', '2018-04-26'),
(1223, '2018-04-26 11:22:08', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'kat', '70', '', '4todo'),
(1224, '2018-04-26 11:22:08', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'no_jdl', '70', '', '4'),
(1225, '2018-04-26 11:22:08', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'jdl', '70', '', 'cetak invoice'),
(1226, '2018-04-26 11:22:08', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'no_ket', '70', '', NULL),
(1227, '2018-04-26 11:22:08', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'ket', '70', '', NULL),
(1228, '2018-04-26 11:22:08', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'done', '70', '', NULL),
(1229, '2018-04-26 11:22:08', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'home_id', '70', '', '70'),
(1230, '2018-04-26 11:22:09', '/stok/t95_homedetaillist.php', '1', '*** Batch insert successful ***', 't95_homedetail', '', '', '', ''),
(1231, '2018-04-26 11:26:29', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'tgl', '71', '', '2018-04-26'),
(1232, '2018-04-26 11:26:29', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'kat', '71', '', '4todo'),
(1233, '2018-04-26 11:26:29', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'no_jdl', '71', '', '5'),
(1234, '2018-04-26 11:26:29', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'jdl', '71', '', 'laporan stok masih salah'),
(1235, '2018-04-26 11:26:29', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'no_ket', '71', '', NULL),
(1236, '2018-04-26 11:26:29', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'ket', '71', '', NULL),
(1237, '2018-04-26 11:26:29', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'done', '71', '', NULL),
(1238, '2018-04-26 11:26:29', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'home_id', '71', '', '71'),
(1239, '2018-04-26 11:27:00', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'tgl', '72', '', '2018-04-26'),
(1240, '2018-04-26 11:27:00', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'kat', '72', '', '4todo'),
(1241, '2018-04-26 11:27:00', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'no_jdl', '72', '', '6'),
(1242, '2018-04-26 11:27:00', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'jdl', '72', '', 'laporan nilai stok'),
(1243, '2018-04-26 11:27:00', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'no_ket', '72', '', NULL),
(1244, '2018-04-26 11:27:00', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'ket', '72', '', NULL),
(1245, '2018-04-26 11:27:00', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'done', '72', '', NULL),
(1246, '2018-04-26 11:27:00', '/stok/t95_homedetaillist.php', '1', 'A', 't95_homedetail', 'home_id', '72', '', '72'),
(1247, '2018-05-30 12:07:38', '/stok/login.php', 'admin', 'login', '::1', '', '', '', ''),
(1248, '2018-05-30 15:18:40', '/stok/t04_maingrouplist.php', '1', '*** Batch update begin ***', 't04_maingroup', '', '', '', ''),
(1249, '2018-05-30 15:18:41', '/stok/t04_maingrouplist.php', '1', 'U', 't04_maingroup', 'Kode', '1', '5', '1'),
(1250, '2018-05-30 15:18:41', '/stok/t04_maingrouplist.php', '1', 'U', 't04_maingroup', 'Kode', '2', '6', '2'),
(1251, '2018-05-30 15:18:41', '/stok/t04_maingrouplist.php', '1', 'U', 't04_maingroup', 'Kode', '3', '7', '3'),
(1252, '2018-05-30 15:18:41', '/stok/t04_maingrouplist.php', '1', '*** Batch update successful ***', 't04_maingroup', '', '', '', ''),
(1253, '2018-05-30 15:21:39', '/stok/t06_articlelist.php', '1', 'U', 't06_article', 'Kode', '1', '5501001', '5501002'),
(1254, '2018-05-30 15:45:28', '/stok/t06_articlelist.php', '1', 'U', 't06_article', 'SubGroupID', '1', '1', '2'),
(1255, '2018-05-30 15:45:28', '/stok/t06_articlelist.php', '1', 'U', 't06_article', 'Kode', '1', '5501002', '1502001'),
(1256, '2018-05-30 15:45:37', '/stok/t06_articlelist.php', '1', 'U', 't06_article', 'SubGroupID', '1', '2', '1'),
(1257, '2018-05-30 15:45:37', '/stok/t06_articlelist.php', '1', 'U', 't06_article', 'Kode', '1', '1502001', '1501001'),
(1258, '2018-05-30 15:46:38', '/stok/t06_articlelist.php', '1', 'U', 't06_article', 'SubGroupID', '3', '5', '3'),
(1259, '2018-05-30 15:46:38', '/stok/t06_articlelist.php', '1', 'U', 't06_article', 'Kode', '3', '5504001', '1503001'),
(1260, '2018-05-30 15:46:49', '/stok/t06_articlelist.php', '1', 'U', 't06_article', 'SubGroupID', '3', '3', '5'),
(1261, '2018-05-30 15:46:49', '/stok/t06_articlelist.php', '1', 'U', 't06_article', 'Kode', '3', '1503001', '1504001'),
(1262, '2018-05-30 15:47:03', '/stok/t06_articlelist.php', '1', 'U', 't06_article', 'SubGroupID', '4', '8', '7'),
(1263, '2018-05-30 15:47:03', '/stok/t06_articlelist.php', '1', 'U', 't06_article', 'Kode', '4', '5507001', '1506001'),
(1264, '2018-05-30 15:47:12', '/stok/t06_articlelist.php', '1', 'U', 't06_article', 'SubGroupID', '4', '7', '8'),
(1265, '2018-05-30 15:47:12', '/stok/t06_articlelist.php', '1', 'U', 't06_article', 'Kode', '4', '1506001', '1507001'),
(1266, '2018-06-04 10:52:54', '/stok/login.php', 'admin', 'login', '::1', '', '', '', ''),
(1267, '2018-06-04 10:54:18', '/stok/login.php', 'admin', 'login', '::1', '', '', '', '');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v01_beli`
-- (See below for the actual view)
--
CREATE TABLE `v01_beli` (
`articleid` int(11)
,`avgharga` double(19,6)
,`sumqty` double(19,2)
,`subtotal` double(23,6)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v02_stok`
-- (See below for the actual view)
--
CREATE TABLE `v02_stok` (
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
-- (See below for the actual view)
--
CREATE TABLE `v03_hutang` (
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
-- Stand-in structure for view `v04_jual`
-- (See below for the actual view)
--
CREATE TABLE `v04_jual` (
`TglSO` date
,`NoSO` varchar(14)
,`CustomerNama` varchar(50)
,`CustomerPO` varchar(50)
,`ArticleNama` varchar(85)
,`HargaJual` float(15,2)
,`Qty` float(15,2)
,`SatuanNama` varchar(25)
,`SubTotal` float(15,2)
);

-- --------------------------------------------------------

--
-- Structure for view `v01_beli`
--
DROP TABLE IF EXISTS `v01_beli`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v01_beli`  AS  select `t08_beli`.`ArticleID` AS `articleid`,avg(`t08_beli`.`Harga`) AS `avgharga`,sum(`t08_beli`.`Qty`) AS `sumqty`,(avg(`t08_beli`.`Harga`) * sum(`t08_beli`.`Qty`)) AS `subtotal` from `t08_beli` group by `t08_beli`.`ArticleID` ;

-- --------------------------------------------------------

--
-- Structure for view `v02_stok`
--
DROP TABLE IF EXISTS `v02_stok`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v02_stok`  AS  select concat(`a`.`Kode`,' - ',`a`.`Nama`) AS `MainGroup`,concat(`b`.`Kode`,' - ',`b`.`Nama`) AS `SubGroup`,concat(`c`.`Kode`,' - ',`c`.`Nama`) AS `Article`,`e`.`sumqty` AS `SumQty`,`d`.`Nama` AS `Satuan`,`e`.`avgharga` AS `AvgHarga`,`e`.`subtotal` AS `SubTotal` from ((((`t04_maingroup` `a` left join `t05_subgroup` `b` on((`a`.`id` = `b`.`MainGroupID`))) left join `t06_article` `c` on((`b`.`id` = `c`.`SubGroupID`))) left join `t07_satuan` `d` on((`c`.`SatuanID` = `d`.`id`))) left join `v01_beli` `e` on((`c`.`id` = `e`.`articleid`))) ;

-- --------------------------------------------------------

--
-- Structure for view `v03_hutang`
--
DROP TABLE IF EXISTS `v03_hutang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v03_hutang`  AS  select `a`.`NoHutang` AS `nohutang`,`b`.`TglPO` AS `tglpo`,`b`.`NoPO` AS `nopo`,`c`.`Nama` AS `nama`,`a`.`JumlahHutang` AS `jumlahhutang`,`a`.`JumlahBayar` AS `jumlahbayar`,(`a`.`JumlahHutang` - `a`.`JumlahBayar`) AS `sisahutang` from ((`t09_hutang` `a` left join `t08_beli` `b` on((`a`.`BeliID` = `b`.`id`))) left join `t02_vendor` `c` on((`b`.`VendorID` = `c`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `v04_jual`
--
DROP TABLE IF EXISTS `v04_jual`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v04_jual`  AS  select `a`.`TglSO` AS `TglSO`,`a`.`NoSO` AS `NoSO`,`c`.`Nama` AS `CustomerNama`,`a`.`CustomerPO` AS `CustomerPO`,concat(`d`.`Kode`,' - ',`d`.`Nama`) AS `ArticleNama`,`b`.`HargaJual` AS `HargaJual`,`b`.`Qty` AS `Qty`,`e`.`Nama` AS `SatuanNama`,`b`.`SubTotal` AS `SubTotal` from ((((`t11_jual` `a` left join `t12_jualdetail` `b` on((`a`.`id` = `b`.`JualID`))) left join `t03_customer` `c` on((`a`.`CustomerID` = `c`.`id`))) left join `t06_article` `d` on((`b`.`ArticleID` = `d`.`id`))) left join `t07_satuan` `e` on((`d`.`SatuanID` = `e`.`id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t01_company`
--
ALTER TABLE `t01_company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t02_vendor`
--
ALTER TABLE `t02_vendor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t03_customer`
--
ALTER TABLE `t03_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t04_maingroup`
--
ALTER TABLE `t04_maingroup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t05_subgroup`
--
ALTER TABLE `t05_subgroup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t06_article`
--
ALTER TABLE `t06_article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t07_satuan`
--
ALTER TABLE `t07_satuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t08_beli`
--
ALTER TABLE `t08_beli`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t09_hutang`
--
ALTER TABLE `t09_hutang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t10_hutangdetail`
--
ALTER TABLE `t10_hutangdetail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t11_jual`
--
ALTER TABLE `t11_jual`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t12_jualdetail`
--
ALTER TABLE `t12_jualdetail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t13_mutasi`
--
ALTER TABLE `t13_mutasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t93_parameter`
--
ALTER TABLE `t93_parameter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t94_home`
--
ALTER TABLE `t94_home`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t95_homedetail`
--
ALTER TABLE `t95_homedetail`
  ADD PRIMARY KEY (`home_id`);

--
-- Indexes for table `t96_employees`
--
ALTER TABLE `t96_employees`
  ADD PRIMARY KEY (`EmployeeID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `t97_userlevels`
--
ALTER TABLE `t97_userlevels`
  ADD PRIMARY KEY (`userlevelid`);

--
-- Indexes for table `t98_userlevelpermissions`
--
ALTER TABLE `t98_userlevelpermissions`
  ADD PRIMARY KEY (`userlevelid`,`tablename`);

--
-- Indexes for table `t99_audittrail`
--
ALTER TABLE `t99_audittrail`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t01_company`
--
ALTER TABLE `t01_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t02_vendor`
--
ALTER TABLE `t02_vendor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t03_customer`
--
ALTER TABLE `t03_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t04_maingroup`
--
ALTER TABLE `t04_maingroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t05_subgroup`
--
ALTER TABLE `t05_subgroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `t06_article`
--
ALTER TABLE `t06_article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1231;

--
-- AUTO_INCREMENT for table `t07_satuan`
--
ALTER TABLE `t07_satuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t08_beli`
--
ALTER TABLE `t08_beli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t09_hutang`
--
ALTER TABLE `t09_hutang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t10_hutangdetail`
--
ALTER TABLE `t10_hutangdetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t11_jual`
--
ALTER TABLE `t11_jual`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t12_jualdetail`
--
ALTER TABLE `t12_jualdetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t13_mutasi`
--
ALTER TABLE `t13_mutasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `t93_parameter`
--
ALTER TABLE `t93_parameter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t94_home`
--
ALTER TABLE `t94_home`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `t95_homedetail`
--
ALTER TABLE `t95_homedetail`
  MODIFY `home_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `t96_employees`
--
ALTER TABLE `t96_employees`
  MODIFY `EmployeeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t99_audittrail`
--
ALTER TABLE `t99_audittrail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1268;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
