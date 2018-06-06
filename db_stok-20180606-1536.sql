-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 06, 2018 at 10:36 AM
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
(1, 1, '1501001', 'MEAT Has Luar Lokal', 0.00, 17, 0.00, 115000.00),
(2, 1, '1501002', 'MEAT Sirloin Steak Lokal', 0.00, 17, 0.00, 0.00),
(3, 1, '1501003', 'MEAT Sirloin Wagyu Lokal', 0.00, 17, 0.00, 0.00),
(4, 1, '1501004', 'MEAT Striploin Steak AUS', 0.00, 17, 0.00, 0.00),
(5, 1, '1501005', 'MEAT Striploin Black Angus AUS', 0.00, 17, 0.00, 0.00),
(6, 1, '1501006', 'MEAT Striploin Meltique AUS', 0.00, 17, 0.00, 0.00),
(7, 1, '1501007', 'MEAT Has Dalam Lokal', 0.00, 17, 0.00, 0.00),
(8, 1, '1501008', 'MEAT Tenderloin Steak Lokal', 0.00, 17, 0.00, 0.00),
(9, 1, '1501009', 'MEAT Tenderloin Wagyu Lokal', 0.00, 17, 0.00, 0.00),
(10, 1, '1501010', 'MEAT Tenderloin Steak AUS', 0.00, 17, 0.00, 0.00),
(11, 1, '1501011', 'MEAT Tenderloin Black Angus AUS', 0.00, 17, 0.00, 0.00),
(12, 1, '1501012', 'MEAT Iga Sapi Lokal', 0.00, 17, 0.00, 0.00),
(13, 1, '1501013', 'MEAT Back Ribs Lokal', 0.00, 17, 0.00, 0.00),
(14, 1, '1501014', 'MEAT Short Ribs Lokal', 0.00, 17, 0.00, 0.00),
(15, 1, '1501015', 'MEAT Rib Eye AUS', 0.00, 17, 0.00, 0.00),
(16, 1, '1501016', 'MEAT Rib Eye Black Angus AUS', 0.00, 17, 0.00, 0.00),
(17, 1, '1501017', 'MEAT Short Ribs AUS', 0.00, 17, 0.00, 0.00),
(18, 1, '1501018', 'MEAT Topside Lokal', 0.00, 17, 0.00, 0.00),
(19, 1, '1501019', 'MEAT Topside AUS', 0.00, 17, 0.00, 0.00),
(20, 1, '1501020', 'MEAT Rump Lokal', 0.00, 17, 0.00, 0.00),
(21, 1, '1501021', 'MEAT Rump AUS', 0.00, 17, 0.00, 0.00),
(22, 1, '1501022', 'MEAT Blade Lokal', 0.00, 17, 0.00, 0.00),
(23, 1, '1501023', 'MEAT Blade AUS', 0.00, 17, 0.00, 0.00),
(24, 1, '1501024', 'MEAT Brisket Lokal', 0.00, 17, 0.00, 0.00),
(25, 1, '1501025', 'MEAT Ribs Bone/Tulang Iga Lokal', 0.00, 17, 0.00, 0.00),
(26, 1, '1501026', 'MEAT Ribs Bone AUS', 0.00, 17, 0.00, 0.00),
(27, 1, '1501027', 'MEAT Outside Lokal', 0.00, 17, 0.00, 0.00),
(28, 1, '1501028', 'MEAT Chuck Tender Lokal', 0.00, 17, 0.00, 0.00),
(29, 1, '1501029', 'MEAT Chuck Roll Lokal', 0.00, 17, 0.00, 0.00),
(30, 1, '1501030', 'MEAT Knuckle Lokal', 0.00, 17, 0.00, 0.00),
(31, 1, '1501031', 'MEAT Shank Lokal', 0.00, 17, 0.00, 0.00),
(32, 1, '1501032', 'MEAT Dengkul Sapi Lokal', 0.00, 17, 0.00, 0.00),
(33, 1, '1501033', 'MEAT Shank Bone AUS', 0.00, 17, 0.00, 0.00),
(34, 1, '1501034', 'MEAT Shank Boneless AUS', 0.00, 17, 0.00, 0.00),
(35, 1, '1501035', 'MEAT Veal Bone Hindshank Cut AUS', 0.00, 17, 0.00, 0.00),
(36, 1, '1501036', 'MEAT Kikil Sapi Lokal', 0.00, 17, 0.00, 0.00),
(37, 1, '1501037', 'MEAT Sumsum Tulang Sapi Lokal', 0.00, 17, 0.00, 0.00),
(38, 1, '1501038', 'MEAT Oxtail Cut Lokal', 0.00, 17, 0.00, 0.00),
(39, 1, '1501039', 'MEAT Oxtail Cut Import', 0.00, 17, 0.00, 0.00),
(40, 1, '1501040', 'MEAT Daging Rawon Lokal', 0.00, 17, 0.00, 0.00),
(41, 1, '1501041', 'MEAT Daging Tetelan Lokal', 0.00, 17, 0.00, 0.00),
(42, 1, '1501042', 'MEAT Hati Sapi Lokal', 0.00, 17, 0.00, 0.00),
(43, 1, '1501043', 'MEAT Paru Sapi Lokal', 0.00, 17, 0.00, 0.00),
(44, 1, '1501044', 'MEAT Limpa Sapi Lokal', 0.00, 17, 0.00, 0.00),
(45, 1, '1501045', 'MEAT Usus Sapi Lokal', 0.00, 17, 0.00, 0.00),
(46, 1, '1501046', 'MEAT Babat Sapi Lokal', 0.00, 17, 0.00, 0.00),
(47, 1, '1501047', 'MEAT Cingur Sapi Lokal', 0.00, 17, 0.00, 0.00),
(48, 1, '1501048', 'MEAT Cecek Sapi Lokal', 0.00, 17, 0.00, 0.00),
(49, 1, '1501049', 'MEAT Daging Giling Lokal', 0.00, 17, 0.00, 0.00),
(50, 1, '1501050', 'MEAT Beef Bacon Rasher (brand) (bera', 0.00, 17, 0.00, 0.00),
(51, 1, '1501051', 'MEAT Smoked Beef Cuts Lokal (brand)', 0.00, 17, 0.00, 0.00),
(52, 1, '1501052', 'MEAT Smoked Beef Whole (brand) (bera', 0.00, 17, 0.00, 0.00),
(53, 1, '1501053', 'MEAT Beef Pastrami (brand) (berat)', 0.00, 17, 0.00, 0.00),
(54, 1, '1501054', 'MEAT Beef Salami (brand) (berat)', 0.00, 17, 0.00, 0.00),
(55, 1, '1501055', 'MEAT Beef Pepperoni Soejasch Nikmat', 0.00, 20, 0.00, 0.00),
(56, 1, '1501056', 'MEAT Beef Patties Whole (brand) (ber', 0.00, 17, 0.00, 0.00),
(57, 1, '1501057', 'MEAT Beef Lyoner Whole (brand) (bera', 0.00, 17, 0.00, 0.00),
(58, 1, '1501058', 'MEAT Sosis Sapi Bernardi 180 gr', 0.00, 17, 0.00, 0.00),
(59, 1, '1501059', 'MEAT Sosis Sapi Bernardi 500 gr', 0.00, 17, 0.00, 0.00),
(60, 1, '1501060', 'MEAT Beef Franks (brand) (berat)', 0.00, 17, 0.00, 0.00),
(61, 1, '1501061', 'MEAT Beef Quarter Frank US (brand) 1', 0.00, 17, 0.00, 0.00),
(62, 1, '1501062', 'MEAT Swiss Bratwurst Sausage (brand)', 0.00, 17, 0.00, 0.00),
(63, 1, '1501063', 'MEAT German Bratwurst Sausage (brand', 0.00, 17, 0.00, 0.00),
(64, 1, '1501064', 'MEAT Beef Nurnberger (brand) (berat)', 0.00, 17, 0.00, 0.00),
(65, 1, '1501065', 'MEAT Veil Nurnberger (brand) (berat)', 0.00, 17, 0.00, 0.00),
(66, 1, '1501066', 'MEAT Beef Jagdwurst (brand) (berat)', 0.00, 17, 0.00, 0.00),
(67, 1, '1501067', 'MEAT Beef Mortadella (brand) (berat)', 0.00, 17, 0.00, 0.00),
(68, 1, '1501068', 'MEAT Australian BBQ Sausage (brand)', 0.00, 17, 0.00, 0.00),
(69, 1, '1501069', 'MEAT Sosis Sapi Cater 1 Kg', 0.00, 17, 0.00, 0.00),
(70, 1, '1501070', 'MEAT Bakso Sapi Halus (brand) (berat', 0.00, 17, 0.00, 0.00),
(71, 1, '1501071', 'MEAT Bakso Sapi Kasar (brand) (berat', 0.00, 17, 0.00, 0.00),
(72, 1, '1501072', 'MEAT Daging Kambing Lokal', 0.00, 17, 0.00, 0.00),
(73, 1, '1501073', 'MEAT Paha Kambing Lokal', 0.00, 17, 0.00, 0.00),
(74, 1, '1501074', 'MEAT Iga Kambing Lokal', 0.00, 17, 0.00, 0.00),
(75, 1, '1501075', 'MEAT Kepala Kambing Lokal', 0.00, 17, 0.00, 0.00),
(76, 1, '1501076', 'MEAT Jeroan Kambing Lokal', 0.00, 17, 0.00, 0.00),
(77, 1, '1501077', 'MEAT Tengkleng Kambing Lokal', 0.00, 17, 0.00, 0.00),
(78, 1, '1501078', 'MEAT Lamb Shank AUS', 0.00, 17, 0.00, 0.00),
(79, 1, '1501079', 'MEAT Lamb Rack AUS', 0.00, 17, 0.00, 0.00),
(80, 1, '1501080', 'MEAT Lamb Chop AUS', 0.00, 17, 0.00, 0.00),
(81, 1, '1501081', 'MEAT Lidah Sapi Lokal', 0.00, 17, 0.00, 0.00),
(82, 1, '1501082', 'MEAT Beef Breakfast Whole Soejasch N', 0.00, 20, 0.00, 0.00),
(83, 1, '1501083', 'MEAT Sosis Sapi SOEJASCH 25gr/pcs 50', 0.00, 20, 0.00, 0.00),
(84, 2, '1502001', 'POUL Ayam Whole', 0.00, 17, 0.00, 0.00),
(85, 2, '1502002', 'POUL Ayam Broiler 1,7-1,8 kg', 0.00, 17, 0.00, 0.00),
(86, 2, '1502003', 'POUL Ayam Muda', 0.00, 17, 0.00, 0.00),
(87, 2, '1502004', 'POUL Dada Ayam', 0.00, 17, 0.00, 0.00),
(88, 2, '1502005', 'POUL Sayap Ayam', 0.00, 17, 0.00, 0.00),
(89, 2, '1502006', 'POUL Paha Ayam', 0.00, 17, 0.00, 0.00),
(90, 2, '1502007', 'POUL Cakar Ayam', 0.00, 17, 0.00, 0.00),
(91, 2, '1502008', 'POUL Kepala Ayam', 0.00, 17, 0.00, 0.00),
(92, 2, '1502009', 'POUL Jerohan Ayam', 0.00, 17, 0.00, 0.00),
(93, 2, '1502010', 'POUL Hati Ayam', 0.00, 17, 0.00, 0.00),
(94, 2, '1502011', 'POUL Ampela Ayam', 0.00, 17, 0.00, 0.00),
(95, 2, '1502012', 'POUL Hati Ampela Ayam', 0.00, 17, 0.00, 0.00),
(96, 2, '1502013', 'POUL Usus Ayam', 0.00, 17, 0.00, 0.00),
(97, 2, '1502014', 'POUL Daging Ayam Giling', 0.00, 17, 0.00, 0.00),
(98, 2, '1502015', 'POUL Ayam Kampung', 0.00, 17, 0.00, 0.00),
(99, 2, '1502016', 'POUL Bebek Lokal', 0.00, 13, 0.00, 0.00),
(100, 2, '1502017', 'POUL Bebek Peking', 0.00, 17, 0.00, 0.00),
(101, 2, '1502018', 'POUL Kalkun', 0.00, 17, 0.00, 0.00),
(102, 2, '1502019', 'POUL Dada Kalkun', 0.00, 17, 0.00, 0.00),
(103, 2, '1502020', 'POUL Burung Dara', 0.00, 17, 0.00, 0.00),
(104, 2, '1502021', 'POUL Sosis Ayam Champ 1 Kg', 0.00, 17, 0.00, 0.00),
(105, 2, '1502022', 'POUL Sosis Ayam Cater 1 Kg', 0.00, 17, 0.00, 0.00),
(106, 2, '1502023', 'POUL Sosis Ayam Bernardi 500 Gr', 0.00, 17, 0.00, 0.00),
(107, 2, '1502024', 'POUL Breakfast Chicken Sausage (bran', 0.00, 17, 0.00, 0.00),
(108, 2, '1502025', 'POUL Chicken Chipolata Sausage (bran', 0.00, 17, 0.00, 0.00),
(109, 2, '1502026', 'POUL Chicken Lyoner Whole (brand) (b', 0.00, 17, 0.00, 0.00),
(110, 2, '1502027', 'POUL Chicken Bratwurst Sausage (bran', 0.00, 17, 0.00, 0.00),
(111, 2, '1502028', 'POUL Chicken Pastrami (brand) (berat', 0.00, 17, 0.00, 0.00),
(112, 2, '1502029', 'POUL Chicken Mushroom Lyoner (brand)', 0.00, 17, 0.00, 0.00),
(113, 2, '1502030', 'POUL Bakso Ayam (brand) (berat)', 0.00, 17, 0.00, 0.00),
(114, 2, '1502031', 'POUL Chicken Drumstick (brand) (bera', 0.00, 17, 0.00, 0.00),
(115, 2, '1502032', 'POUL Telur Ayam', 0.00, 17, 0.00, 0.00),
(116, 2, '1502033', 'POUL Telur Ayam Kampung', 0.00, 17, 0.00, 0.00),
(117, 2, '1502034', 'POUL Telur Puyuh Matang', 0.00, 17, 0.00, 0.00),
(118, 2, '1502035', 'POUL Telur Puyuh Mentah', 0.00, 17, 0.00, 0.00),
(119, 2, '1502036', 'POUL Telur Bebek', 0.00, 17, 0.00, 0.00),
(120, 2, '1502037', 'POUL Telur Bebek Asin Matang', 0.00, 17, 0.00, 0.00),
(121, 2, '1502038', 'POUL Telur Bebek Asin Mentah', 0.00, 17, 0.00, 0.00),
(122, 2, '1502039', 'POUL Sate Ayam', 0.00, 17, 0.00, 0.00),
(123, 2, '1502040', 'POUL Sate Telur Puyuh', 0.00, 17, 0.00, 0.00),
(124, 2, '1502041', 'POUL Sosis Ayam Soejasch 25gr/pcs 50', 0.00, 20, 0.00, 0.00),
(125, 3, '1503001', 'FS Frozen Norwegian Salmon', 0.00, 17, 0.00, 0.00),
(126, 3, '1503002', 'FS Frozen Salmon', 0.00, 17, 0.00, 0.00),
(127, 3, '1503003', 'FS Fresh Salmon', 0.00, 17, 0.00, 0.00),
(128, 3, '1503004', 'FS Smoked Salmon', 0.00, 17, 0.00, 0.00),
(129, 3, '1503005', 'FS Frozen Smoked Salmon', 0.00, 17, 0.00, 0.00),
(130, 3, '1503006', 'FS Gindara Fillet', 0.00, 17, 0.00, 0.00),
(131, 3, '1503007', 'FS Kakap Merah', 0.00, 17, 0.00, 0.00),
(132, 3, '1503008', 'FS Kakap Putih', 0.00, 17, 0.00, 0.00),
(133, 3, '1503009', 'FS Kakap Merah Fillet', 0.00, 17, 0.00, 0.00),
(134, 3, '1503010', 'FS Kakap Putih Fillet', 0.00, 17, 0.00, 0.00),
(135, 3, '1503011', 'FS Tuna Whole', 0.00, 17, 0.00, 0.00),
(136, 3, '1503012', 'FS Tuna Loin', 0.00, 17, 0.00, 0.00),
(137, 3, '1503013', 'FS Tuna Fillet', 0.00, 17, 0.00, 0.00),
(138, 3, '1503014', 'FS Tongkol', 0.00, 17, 0.00, 0.00),
(139, 3, '1503015', 'FS Bawal Laut Hitam', 0.00, 17, 0.00, 0.00),
(140, 3, '1503016', 'FS Bawal Laut Putih', 0.00, 17, 0.00, 0.00),
(141, 3, '1503017', 'FS Bawal Fillet', 0.00, 17, 0.00, 0.00),
(142, 3, '1503018', 'FS Ikan Ekor Kuning', 0.00, 17, 0.00, 0.00),
(143, 3, '1503019', 'FS Tenggiri Whole', 0.00, 17, 0.00, 0.00),
(144, 3, '1503020', 'FS Tenggiri Fillet', 0.00, 17, 0.00, 0.00),
(145, 3, '1503021', 'FS Dori Fillet', 0.00, 17, 0.00, 0.00),
(146, 3, '1503022', 'FS Skinless Dori Fillet', 0.00, 17, 0.00, 0.00),
(147, 3, '1503023', 'FS John Dory Fillet', 0.00, 17, 0.00, 0.00),
(148, 3, '1503024', 'FS Barakuda Fillet', 0.00, 17, 0.00, 0.00),
(149, 3, '1503025', 'FS Lemadang Fillet', 0.00, 17, 0.00, 0.00),
(150, 3, '1503026', 'FS Kerapu', 0.00, 17, 0.00, 0.00),
(151, 3, '1503027', 'FS Ikan Talang', 0.00, 17, 0.00, 0.00),
(152, 3, '1503028', 'FS Ikan Layang', 0.00, 17, 0.00, 0.00),
(153, 3, '1503029', 'FS Ikan Layar', 0.00, 17, 0.00, 0.00),
(154, 3, '1503030', 'FS Ikan Kembung', 0.00, 17, 0.00, 0.00),
(155, 3, '1503031', 'FS Ikan Kuwe', 0.00, 17, 0.00, 0.00),
(156, 3, '1503032', 'FS Ikan Manyung', 0.00, 17, 0.00, 0.00),
(157, 3, '1503033', 'FS Ikan Sebelah', 0.00, 17, 0.00, 0.00),
(158, 3, '1503034', 'FS Ikan Belanak', 0.00, 17, 0.00, 0.00),
(159, 3, '1503035', 'FS Giant Trevally', 0.00, 17, 0.00, 0.00),
(160, 3, '1503036', 'FS Ikan Cucut', 0.00, 17, 0.00, 0.00),
(161, 3, '1503037', 'FS Ikan Keting', 0.00, 17, 0.00, 0.00),
(162, 3, '1503038', 'FS Gurami', 0.00, 17, 0.00, 0.00),
(163, 3, '1503039', 'FS Bawal Air Tawar', 0.00, 17, 0.00, 0.00),
(164, 3, '1503040', 'FS Nila Merah', 0.00, 17, 0.00, 0.00),
(165, 3, '1503041', 'FS Nila Hitam', 0.00, 17, 0.00, 0.00),
(166, 3, '1503042', 'FS Bandeng Besar', 0.00, 17, 0.00, 0.00),
(167, 3, '1503043', 'FS Bandeng Kecil', 0.00, 17, 0.00, 0.00),
(168, 3, '1503044', 'FS Bandeng Presto', 0.00, 17, 0.00, 0.00),
(169, 3, '1503045', 'FS Patin', 0.00, 17, 0.00, 0.00),
(170, 3, '1503046', 'FS Lele', 0.00, 17, 0.00, 0.00),
(171, 3, '1503047', 'FS Mujair', 0.00, 17, 0.00, 0.00),
(172, 3, '1503048', 'FS Belut', 0.00, 17, 0.00, 0.00),
(173, 3, '1503049', 'FS Gabus', 0.00, 17, 0.00, 0.00),
(174, 3, '1503050', 'FS Wader', 0.00, 17, 0.00, 0.00),
(175, 3, '1503051', 'FS Ikan Mas', 0.00, 17, 0.00, 0.00),
(176, 3, '1503052', 'FS Udang 10-15', 0.00, 17, 0.00, 0.00),
(177, 3, '1503053', 'FS Udang 20-25', 0.00, 17, 0.00, 0.00),
(178, 3, '1503054', 'FS Udang 30-35', 0.00, 17, 0.00, 0.00),
(179, 3, '1503055', 'FS Udang 40-45', 0.00, 17, 0.00, 0.00),
(180, 3, '1503056', 'FS Udang 50-55', 0.00, 17, 0.00, 0.00),
(181, 3, '1503057', 'FS Udang 60-65', 0.00, 17, 0.00, 0.00),
(182, 3, '1503058', 'FS Udang Windu', 0.00, 17, 0.00, 0.00),
(183, 3, '1503059', 'FS Udang Kupas', 0.00, 17, 0.00, 0.00),
(184, 3, '1503060', 'FS Lobster', 0.00, 17, 0.00, 0.00),
(185, 3, '1503061', 'FS Baby Lobster', 0.00, 17, 0.00, 0.00),
(186, 3, '1503062', 'FS Cumi Kupas Bersih', 0.00, 17, 0.00, 0.00),
(187, 3, '1503063', 'FS Cumi Batok', 0.00, 17, 0.00, 0.00),
(188, 3, '1503064', 'FS Cumi Sotong', 0.00, 17, 0.00, 0.00),
(189, 3, '1503065', 'FS Kepiting', 0.00, 17, 0.00, 0.00),
(190, 3, '1503066', 'FS Kepiting Soka', 0.00, 17, 0.00, 0.00),
(191, 3, '1503067', 'FS Crab Meat', 0.00, 17, 0.00, 0.00),
(192, 3, '1503068', 'FS Crab Claw', 0.00, 17, 0.00, 0.00),
(193, 3, '1503069', 'FS Rajungan', 0.00, 17, 0.00, 0.00),
(194, 3, '1503070', 'FS Kerang Putih', 0.00, 17, 0.00, 0.00),
(195, 3, '1503071', 'FS Kerang Hijau', 0.00, 17, 0.00, 0.00),
(196, 3, '1503072', 'FS Kerang Hijau Kupas', 0.00, 17, 0.00, 0.00),
(197, 3, '1503073', 'FS Kerang Kipas', 0.00, 17, 0.00, 0.00),
(198, 3, '1503074', 'FS Kerang Dara', 0.00, 17, 0.00, 0.00),
(199, 3, '1503075', 'FS Kerang Dara Kupas', 0.00, 17, 0.00, 0.00),
(200, 3, '1503076', 'FS Scallop', 0.00, 17, 0.00, 0.00),
(201, 3, '1503077', 'FS Gurita Besar', 0.00, 17, 0.00, 0.00),
(202, 3, '1503078', 'FS Gurita Kecil', 0.00, 17, 0.00, 0.00),
(203, 3, '1503079', 'FS Ubur Ubur', 0.00, 17, 0.00, 0.00),
(204, 3, '1503080', 'FS Ikan Asin Jambal', 0.00, 17, 0.00, 0.00),
(205, 3, '1503081', 'FS Ikan Asin Gereh', 0.00, 17, 0.00, 0.00),
(206, 3, '1503082', 'FS Ikan Asin Peda', 0.00, 17, 0.00, 0.00),
(207, 3, '1503083', 'FS Ikan Asin Petek', 0.00, 17, 0.00, 0.00),
(208, 3, '1503084', 'FS Ikan Asin Jambrong', 0.00, 17, 0.00, 0.00),
(209, 3, '1503085', 'FS Ikan Asin Bulu Ayam', 0.00, 17, 0.00, 0.00),
(210, 3, '1503086', 'FS Ikan Asin Gabus', 0.00, 17, 0.00, 0.00),
(211, 3, '1503087', 'FS Ikan Asin Cumi', 0.00, 17, 0.00, 0.00),
(212, 3, '1503088', 'FS Ikan Pindang', 0.00, 17, 0.00, 0.00),
(213, 3, '1503089', 'FS Ikan Pe Panggang', 0.00, 17, 0.00, 0.00),
(214, 3, '1503090', 'FS Wader Goreng Crispy', 0.00, 17, 0.00, 0.00),
(215, 3, '1503091', 'FS Bakso Cumi (brand) (berat)', 0.00, 17, 0.00, 0.00),
(216, 3, '1503092', 'FS Bakso Ikan (brand) (berat)', 0.00, 17, 0.00, 0.00),
(217, 3, '1503093', 'FS Bakso Udang (brand) (berat)', 0.00, 17, 0.00, 0.00),
(218, 3, '1503094', 'FS Crab Stick (brand) (berat)', 0.00, 17, 0.00, 0.00),
(219, 3, '1503095', 'FS Canned Crab Meat (brand) (berat)', 0.00, 17, 0.00, 0.00),
(220, 3, '1503096', 'FS Tuna Chunk (brand) (berat)', 0.00, 17, 0.00, 0.00),
(221, 3, '1503097', 'FS Tail on Shrimp (brand) (berat)', 0.00, 17, 0.00, 0.00),
(222, 3, '1503098', 'FS Anchovy', 0.00, 17, 0.00, 0.00),
(223, 3, '1503099', 'FS Scallop Mitraku 500gr', 0.00, 20, 0.00, 0.00),
(224, 3, '1503100', 'FS Ikan Teri Putih', 0.00, 17, 0.00, 0.00),
(225, 3, '1503101', 'FS Ebi', 0.00, 17, 0.00, 0.00),
(226, 4, '1504001', 'FRUIT Alpukat', 0.00, 17, 0.00, 0.00),
(227, 4, '1504002', 'FRUIT Anggur Hijau', 0.00, 17, 0.00, 0.00),
(228, 4, '1504003', 'FRUIT Anggur Merah', 0.00, 17, 0.00, 0.00),
(229, 4, '1504004', 'FRUIT Apel Hijau Granny Smith', 0.00, 17, 0.00, 0.00),
(230, 4, '1504005', 'FRUIT Apel Hijau Manalagi', 0.00, 17, 0.00, 0.00),
(231, 4, '1504006', 'FRUIT Apel Merah Fuji', 0.00, 17, 0.00, 0.00),
(232, 4, '1504007', 'FRUIT Belimbing', 0.00, 17, 0.00, 0.00),
(233, 4, '1504008', 'FRUIT Bengkoang', 0.00, 17, 0.00, 0.00),
(234, 4, '1504009', 'FRUIT Blewah', 0.00, 17, 0.00, 0.00),
(235, 4, '1504010', 'FRUIT Buah Naga', 0.00, 17, 0.00, 0.00),
(236, 4, '1504011', 'FRUIT Duku', 0.00, 17, 0.00, 0.00),
(237, 4, '1504012', 'FRUIT Durian Kupas', 0.00, 17, 0.00, 0.00),
(238, 4, '1504013', 'FRUIT Jambu Air Hijau', 0.00, 17, 0.00, 0.00),
(239, 4, '1504014', 'FRUIT Jambu Air Merah', 0.00, 17, 0.00, 0.00),
(240, 4, '1504015', 'FRUIT Jambu Biji', 0.00, 17, 0.00, 0.00),
(241, 4, '1504016', 'FRUIT Jeruk Kino', 0.00, 17, 0.00, 0.00),
(242, 4, '1504017', 'FRUIT Jeruk Lemon Lokal', 0.00, 17, 0.00, 0.00),
(243, 4, '1504018', 'FRUIT Jeruk Lokal', 0.00, 17, 0.00, 0.00),
(244, 4, '1504019', 'FRUIT Jeruk Mandarin', 0.00, 17, 0.00, 0.00),
(245, 4, '1504020', 'FRUIT Jeruk Santang', 0.00, 17, 0.00, 0.00),
(246, 4, '1504021', 'FRUIT Jeruk Sunkis', 0.00, 17, 0.00, 0.00),
(247, 4, '1504022', 'FRUIT Kedondong', 0.00, 17, 0.00, 0.00),
(248, 4, '1504023', 'FRUIT Kelengkeng', 0.00, 17, 0.00, 0.00),
(249, 4, '1504024', 'FRUIT Kismis', 0.00, 17, 0.00, 0.00),
(250, 4, '1504025', 'FRUIT Kiwi', 0.00, 17, 0.00, 0.00),
(251, 4, '1504026', 'FRUIT Kurma', 0.00, 17, 0.00, 0.00),
(252, 4, '1504027', 'FRUIT Labu', 0.00, 17, 0.00, 0.00),
(253, 4, '1504028', 'FRUIT Mangga', 0.00, 17, 0.00, 0.00),
(254, 4, '1504029', 'FRUIT Mangga Muda', 0.00, 17, 0.00, 0.00),
(255, 4, '1504030', 'FRUIT Manggis', 0.00, 17, 0.00, 0.00),
(256, 4, '1504031', 'FRUIT Melon', 0.00, 17, 0.00, 0.00),
(257, 4, '1504032', 'FRUIT Melon Merah', 0.00, 17, 0.00, 0.00),
(258, 4, '1504033', 'FRUIT Nanas', 0.00, 17, 0.00, 0.00),
(259, 4, '1504034', 'FRUIT Nangka Kupas', 0.00, 17, 0.00, 0.00),
(260, 4, '1504035', 'FRUIT Pear Kuning', 0.00, 17, 0.00, 0.00),
(261, 4, '1504036', 'FRUIT Pear Xiang Lie', 0.00, 17, 0.00, 0.00),
(262, 4, '1504037', 'FRUIT Pepaya', 0.00, 17, 0.00, 0.00),
(263, 4, '1504038', 'FRUIT Pisang Batu', 0.00, 17, 0.00, 0.00),
(264, 4, '1504039', 'FRUIT Pisang Cavendish', 0.00, 17, 0.00, 0.00),
(265, 4, '1504040', 'FRUIT Pisang Kepok', 0.00, 17, 0.00, 0.00),
(266, 4, '1504041', 'FRUIT Pisang Mas', 0.00, 17, 0.00, 0.00),
(267, 4, '1504042', 'FRUIT Pisang Raja', 0.00, 17, 0.00, 0.00),
(268, 4, '1504043', 'FRUIT Pisang Susu', 0.00, 17, 0.00, 0.00),
(269, 4, '1504044', 'FRUIT Pisang Ulin', 0.00, 17, 0.00, 0.00),
(270, 4, '1504045', 'FRUIT Rambutan', 0.00, 17, 0.00, 0.00),
(271, 4, '1504046', 'FRUIT Salak', 0.00, 17, 0.00, 0.00),
(272, 4, '1504047', 'FRUIT Sawo', 0.00, 17, 0.00, 0.00),
(273, 4, '1504048', 'FRUIT Semangka Merah', 0.00, 17, 0.00, 0.00),
(274, 4, '1504049', 'FRUIT Sirsat', 0.00, 17, 0.00, 0.00),
(275, 4, '1504050', 'FRUIT Strawberry', 0.00, 20, 0.00, 0.00),
(276, 4, '1504051', 'FRUIT Sukun', 0.00, 17, 0.00, 0.00),
(277, 4, '1504052', 'FRUIT Anggur Merah Tanpa Biji', 0.00, 17, 0.00, 0.00),
(278, 4, '1504053', 'FRUIT Delima Merah', 0.00, 17, 0.00, 0.00),
(279, 4, '1504054', 'FRUIT Semangka Kuning', 0.00, 17, 0.00, 0.00),
(280, 4, '1504055', 'FRUIT Manisan Mangga Kering', 0.00, 17, 0.00, 0.00),
(281, 4, '1504056', 'FRUIT Manisan Plum Kering', 0.00, 17, 0.00, 0.00),
(282, 4, '1504057', 'FRUIT Manisan Kiwi Kering', 0.00, 17, 0.00, 0.00),
(283, 5, '1505001', 'OIL Minyak Goreng Bimoli 18L', 0.00, 16, 0.00, 0.00),
(284, 5, '1505002', 'OIL Soya Oil Happy 5L', 0.00, 16, 0.00, 0.00),
(285, 5, '1505003', 'OIL Soya Oil Misoya 5L', 0.00, 16, 0.00, 0.00),
(286, 5, '1505004', 'OIL Salad Oil Lily Flower 3L', 0.00, 16, 0.00, 0.00),
(287, 5, '1505005', 'OIL Corn Oil Mazola 3.5L', 0.00, 16, 0.00, 0.00),
(288, 5, '1505006', 'OIL Sun Flower Mazola 3.5L', 0.00, 16, 0.00, 0.00),
(289, 5, '1505007', 'OIL Canola Oil Mazola 1.5L', 0.00, 8, 0.00, 0.00),
(290, 5, '1505008', 'OIL Extra Virgin Olive Mueloliva 1L', 0.00, 8, 0.00, 0.00),
(291, 5, '1505009', 'OIL Extra Virgin Olive Bertolli 1L', 0.00, 8, 0.00, 0.00),
(292, 5, '1505010', 'OIL Extra Virgin Olive Filippo Berio', 0.00, 8, 0.00, 0.00),
(293, 5, '1505011', 'OIL Extra Virgin Olive La Rambla 5L', 0.00, 16, 0.00, 0.00),
(294, 5, '1505012', 'OIL Sesame Oil KIE Guang Hing 600 mL', 0.00, 8, 0.00, 0.00),
(295, 5, '1505013', 'OIL Sesame Oil SENG Guang Hing 600 m', 0.00, 8, 0.00, 0.00),
(296, 5, '1505014', 'OIL Sesame Oil Lee Kum Kee 1.75L', 0.00, 8, 0.00, 0.00),
(297, 5, '1505015', 'OIL Minyak Samin Cap Onta 2 kg', 0.00, 9, 0.00, 0.00),
(298, 5, '1505016', 'OIL Minyak Samin Bin Juber 250gr', 0.00, 8, 0.00, 0.00),
(299, 5, '1505017', 'OIL White Truffle Oil Urbani 250ml', 0.00, 8, 0.00, 0.00),
(300, 5, '1505018', 'OIL White Truffle Oil Casa Rinaldi 2', 0.00, 8, 0.00, 0.00),
(301, 5, '1505019', 'OIL Deep Fry Fat Palmia 15Kg', 0.00, 16, 0.00, 0.00),
(302, 6, '1506001', 'MILK UHT Diamond Full Cream 1L', 0.00, 20, 0.00, 0.00),
(303, 6, '1506002', 'MILK Fresh Diamond Plain 1L', 0.00, 20, 0.00, 0.00),
(304, 6, '1506003', 'MILK Fresh Greenfield  Plain  1L', 0.00, 20, 0.00, 0.00),
(305, 6, '1506004', 'MILK UHT Diamond Low Fat 1L', 0.00, 20, 0.00, 0.00),
(306, 6, '1506005', 'MILK Carnation Nestle Putih 380 gr', 0.00, 20, 0.00, 0.00),
(307, 6, '1506006', 'MILK Carnation Nestle Coklat 380 gr', 0.00, 20, 0.00, 0.00),
(308, 6, '1506007', 'MILK SKM Frisian Flag Putih 370 gr', 0.00, 20, 0.00, 0.00),
(309, 6, '1506008', 'MILK SKM Frisian Flag Coklat 370 gr', 0.00, 20, 0.00, 0.00),
(310, 6, '1506009', 'MILK SKM Frisian Flag Gold  370 gr', 0.00, 20, 0.00, 0.00),
(311, 6, '1506010', 'MILK Susu Sapi Segar', 0.00, 20, 0.00, 0.00),
(312, 6, '1506011', 'MILK Susu Bubuk', 0.00, 17, 0.00, 0.00),
(313, 6, '1506012', 'MILK Coklat Bubuk Ovaltine Classic 6', 0.00, 20, 0.00, 0.00),
(314, 6, '1506013', 'MILK Full Cream Powder (brand) 5 Kg', 0.00, 20, 0.00, 0.00),
(315, 6, '1506014', 'MILK Full Cream Powder Dancow 800 gr', 0.00, 20, 0.00, 0.00),
(316, 6, '1506015', 'MILK [?]', 0.00, 20, 0.00, 0.00),
(317, 7, '1507001', 'VEG Ale Sayur', 0.00, 17, 0.00, 0.00),
(318, 7, '1507002', 'VEG Arugula', 0.00, 17, 0.00, 0.00),
(319, 7, '1507003', 'VEG Asparagus Fresh', 0.00, 17, 0.00, 0.00),
(320, 7, '1507004', 'VEG Baby Kailan', 0.00, 17, 0.00, 0.00),
(321, 7, '1507005', 'VEG Bawang Bombay', 0.00, 17, 0.00, 0.00),
(322, 7, '1507006', 'VEG Bawang Merah Kupas', 0.00, 17, 0.00, 0.00),
(323, 7, '1507007', 'VEG Bawang Putih Kupas', 0.00, 17, 0.00, 0.00),
(324, 7, '1507008', 'VEG Bayam', 0.00, 17, 0.00, 0.00),
(325, 7, '1507009', 'VEG Bayam Merah', 0.00, 17, 0.00, 0.00),
(326, 7, '1507010', 'VEG Belimbing Wuluh', 0.00, 17, 0.00, 0.00),
(327, 7, '1507011', 'VEG Tempe', 0.00, 7, 0.00, 0.00),
(328, 7, '1507012', 'VEG Brokoli', 0.00, 17, 0.00, 0.00),
(329, 7, '1507013', 'VEG Buncis', 0.00, 17, 0.00, 0.00),
(330, 7, '1507014', 'VEG Baby Buncis', 0.00, 17, 0.00, 0.00),
(331, 7, '1507015', 'VEG Bunga Kol', 0.00, 17, 0.00, 0.00),
(332, 7, '1507016', 'VEG Bunga Sedap Malam-Kimlo', 0.00, 17, 0.00, 0.00),
(333, 7, '1507017', 'VEG Bunga Turi', 0.00, 17, 0.00, 0.00),
(334, 7, '1507018', 'VEG Cabai Hijau Besar', 0.00, 17, 0.00, 0.00),
(335, 7, '1507019', 'VEG Cabe Merah Besar', 0.00, 17, 0.00, 0.00),
(336, 7, '1507020', 'VEG Cabe Merah Keriting', 0.00, 17, 0.00, 0.00),
(337, 7, '1507021', 'VEG Cabe Rawit', 0.00, 17, 0.00, 0.00),
(338, 7, '1507022', 'VEG Cabe Rawit Merah', 0.00, 17, 0.00, 0.00),
(339, 7, '1507023', 'VEG Cabai Rawit Hijau', 0.00, 17, 0.00, 0.00),
(340, 7, '1507024', 'VEG Cuciwis', 0.00, 17, 0.00, 0.00),
(341, 7, '1507025', 'VEG Labu Siam', 0.00, 17, 0.00, 0.00),
(342, 7, '1507026', 'VEG Daun Bawang', 0.00, 15, 0.00, 0.00),
(343, 7, '1507027', 'VEG Daun Bawang Prei', 0.00, 15, 0.00, 0.00),
(344, 7, '1507028', 'VEG Daun Jati', 0.00, 15, 0.00, 0.00),
(345, 7, '1507029', 'VEG Daun Kedondong', 0.00, 15, 0.00, 0.00),
(346, 7, '1507030', 'VEG Daun Kucai', 0.00, 15, 0.00, 0.00),
(347, 7, '1507031', 'VEG Daun Melinjo', 0.00, 15, 0.00, 0.00),
(348, 7, '1507032', 'VEG Daun Pakis', 0.00, 15, 0.00, 0.00),
(349, 7, '1507033', 'VEG Daun Pandan', 0.00, 15, 0.00, 0.00),
(350, 7, '1507034', 'VEG Daun Pepaya', 0.00, 15, 0.00, 0.00),
(351, 7, '1507035', 'VEG Daun Pisang', 0.00, 15, 0.00, 0.00),
(352, 7, '1507036', 'VEG Daun Semanggi', 0.00, 15, 0.00, 0.00),
(353, 7, '1507037', 'VEG Daun Singkong', 0.00, 15, 0.00, 0.00),
(354, 7, '1507038', 'VEG Daun Wortel', 0.00, 17, 0.00, 0.00),
(355, 7, '1507039', 'VEG Gembili', 0.00, 17, 0.00, 0.00),
(356, 7, '1507040', 'VEG Ham Choy/Sawi Asin', 0.00, 17, 0.00, 0.00),
(357, 7, '1507041', 'VEG Jagung Manis', 0.00, 17, 0.00, 0.00),
(358, 7, '1507042', 'VEG Jagung Muda', 0.00, 17, 0.00, 0.00),
(359, 7, '1507043', 'VEG Jagung Pipil Kering', 0.00, 17, 0.00, 0.00),
(360, 7, '1507044', 'VEG Jalapeno Fresh', 0.00, 17, 0.00, 0.00),
(361, 7, '1507045', 'VEG Jamur Es', 0.00, 4, 0.00, 0.00),
(362, 7, '1507046', 'VEG Jamur Kancing Fresh', 0.00, 17, 0.00, 0.00),
(363, 7, '1507047', 'VEG Jamur Kuping', 0.00, 17, 0.00, 0.00),
(364, 7, '1507048', 'VEG Jamur Merang', 0.00, 17, 0.00, 0.00),
(365, 7, '1507049', 'VEG Jamur Putih', 0.00, 17, 0.00, 0.00),
(366, 7, '1507050', 'VEG Jamur Salju', 0.00, 17, 0.00, 0.00),
(367, 7, '1507051', 'VEG Jamur Shiitake', 0.00, 17, 0.00, 0.00),
(368, 7, '1507052', 'VEG Jamur Tiram', 0.00, 17, 0.00, 0.00),
(369, 7, '1507053', 'VEG Jantung Pisang', 0.00, 17, 0.00, 0.00),
(370, 7, '1507054', 'VEG Jengkol', 0.00, 17, 0.00, 0.00),
(371, 7, '1507055', 'VEG Jeruk Limau', 0.00, 17, 0.00, 0.00),
(372, 7, '1507056', 'VEG Jeruk Nipis', 0.00, 17, 0.00, 0.00),
(373, 7, '1507057', 'VEG Kailan', 0.00, 17, 0.00, 0.00),
(374, 7, '1507058', 'VEG Kacang Panjang', 0.00, 17, 0.00, 0.00),
(375, 7, '1507059', 'VEG Kangkung', 0.00, 15, 0.00, 0.00),
(376, 7, '1507060', 'VEG Kacang Polong Fresh', 0.00, 17, 0.00, 0.00),
(377, 7, '1507061', 'VEG Kelapa Muda', 0.00, 2, 0.00, 0.00),
(378, 7, '1507062', 'VEG Kelapa Muda Parut', 0.00, 17, 0.00, 0.00),
(379, 7, '1507063', 'VEG Kelapa Parut', 0.00, 17, 0.00, 0.00),
(380, 7, '1507064', 'VEG Kentang', 0.00, 17, 0.00, 0.00),
(381, 7, '1507065', 'VEG Kentang Baby', 0.00, 17, 0.00, 0.00),
(382, 7, '1507066', 'VEG Kol', 0.00, 17, 0.00, 0.00),
(383, 7, '1507067', 'VEG Kol Merah', 0.00, 17, 0.00, 0.00),
(384, 7, '1507068', 'VEG Timun Jepang', 0.00, 17, 0.00, 0.00),
(385, 7, '1507069', 'VEG Lencak', 0.00, 17, 0.00, 0.00),
(386, 7, '1507070', 'VEG Nangka Muda', 0.00, 17, 0.00, 0.00),
(387, 7, '1507071', 'VEG Lettuce Romaine', 0.00, 17, 0.00, 0.00),
(388, 7, '1507072', 'VEG Selada Keriting', 0.00, 17, 0.00, 0.00),
(389, 7, '1507073', 'VEG Lettuce Head Ice Berg', 0.00, 17, 0.00, 0.00),
(390, 7, '1507074', 'VEG Selada Keriting Merah', 0.00, 17, 0.00, 0.00),
(391, 7, '1507075', 'VEG Lettuce Siomak', 0.00, 17, 0.00, 0.00),
(392, 7, '1507076', 'VEG Melinjo', 0.00, 17, 0.00, 0.00),
(393, 7, '1507077', 'VEG Kacang Kulit Mentah', 0.00, 17, 0.00, 0.00),
(394, 7, '1507078', 'VEG Okra', 0.00, 17, 0.00, 0.00),
(395, 7, '1507079', 'VEG Gambas', 0.00, 17, 0.00, 0.00),
(396, 7, '1507080', 'VEG Paprika Hijau', 0.00, 17, 0.00, 0.00),
(397, 7, '1507081', 'VEG Paprika Kuning', 0.00, 17, 0.00, 0.00),
(398, 7, '1507082', 'VEG Paprika Merah', 0.00, 17, 0.00, 0.00),
(399, 7, '1507083', 'VEG Pare', 0.00, 17, 0.00, 0.00),
(400, 7, '1507084', 'VEG Petai Kupas', 0.00, 17, 0.00, 0.00),
(401, 7, '1507085', 'VEG Petai Whole', 0.00, 17, 0.00, 0.00),
(402, 7, '1507086', 'VEG Petai Cina', 0.00, 17, 0.00, 0.00),
(403, 7, '1507087', 'VEG Pokcoy', 0.00, 17, 0.00, 0.00),
(404, 7, '1507088', 'VEG Labu kuning', 0.00, 17, 0.00, 0.00),
(405, 7, '1507089', 'VEG Rebung', 0.00, 17, 0.00, 0.00),
(406, 7, '1507090', 'VEG Bit Merah', 0.00, 17, 0.00, 0.00),
(407, 7, '1507091', 'VEG Rumput Laut', 0.00, 17, 0.00, 0.00),
(408, 7, '1507092', 'VEG Sawi Hijau', 0.00, 17, 0.00, 0.00),
(409, 7, '1507093', 'VEG Sawi Putih', 0.00, 17, 0.00, 0.00),
(410, 7, '1507094', 'VEG Selada Air', 0.00, 15, 0.00, 0.00),
(411, 7, '1507095', 'VEG Singkong', 0.00, 17, 0.00, 0.00),
(412, 7, '1507096', 'VEG Singkong Parut', 0.00, 17, 0.00, 0.00),
(413, 7, '1507097', 'VEG Tahu Mentah Besar', 0.00, 22, 0.00, 0.00),
(414, 7, '1507098', 'VEG Taoge Panjang', 0.00, 17, 0.00, 0.00),
(415, 7, '1507099', 'VEG Taoge Pendek', 0.00, 17, 0.00, 0.00),
(416, 7, '1507100', 'VEG Tempe Gembus', 0.00, 4, 0.00, 0.00),
(417, 7, '1507101', 'VEG Terong Bulat Kecil', 0.00, 17, 0.00, 0.00),
(418, 7, '1507102', 'VEG Terong', 0.00, 17, 0.00, 0.00),
(419, 7, '1507103', 'VEG Timun', 0.00, 17, 0.00, 0.00),
(420, 7, '1507104', 'VEG Tofu Telur Ayam Kong Kee 140 gr', 0.00, 20, 0.00, 0.00),
(421, 7, '1507105', 'VEG Tomat', 0.00, 17, 0.00, 0.00),
(422, 7, '1507106', 'VEG Tomat Cherry', 0.00, 17, 0.00, 0.00),
(423, 7, '1507107', 'VEG Tomat Hijau', 0.00, 17, 0.00, 0.00),
(424, 7, '1507108', 'VEG Lobak Putih', 0.00, 17, 0.00, 0.00),
(425, 7, '1507109', 'VEG Ubi Putih', 0.00, 17, 0.00, 0.00),
(426, 7, '1507110', 'VEG Ubi Ungu', 0.00, 17, 0.00, 0.00),
(427, 7, '1507111', 'VEG Ubi Oranye', 0.00, 17, 0.00, 0.00),
(428, 7, '1507112', 'VEG Ubi Cilembu', 0.00, 17, 0.00, 0.00),
(429, 7, '1507113', 'VEG Uwi', 0.00, 17, 0.00, 0.00),
(430, 7, '1507114', 'VEG Wortel Local', 0.00, 17, 0.00, 0.00),
(431, 7, '1507115', 'VEG Wortel Baby', 0.00, 17, 0.00, 0.00),
(432, 7, '1507116', 'VEG Zucchini', 0.00, 17, 0.00, 0.00),
(433, 7, '1507117', 'VEG Batang Talas', 0.00, 17, 0.00, 0.00),
(434, 8, '1508001', 'COFT Coffee Sachet Logo', 0.00, 20, 0.00, 0.00),
(435, 8, '1508002', 'COFT Creamer Sachet Logo', 0.00, 20, 0.00, 0.00),
(436, 8, '1508003', 'COFT Coffee Bean Illy 3 Kg', 0.00, 20, 0.00, 0.00),
(437, 8, '1508004', 'COFT Coffee Meglio Viktory Powder 50', 0.00, 20, 0.00, 0.00),
(438, 8, '1508005', 'COFT Coffee (brand) 1 Kg', 0.00, 20, 0.00, 0.00),
(439, 8, '1508006', 'COFT Luwak White Koffie 400gr', 0.00, 20, 0.00, 0.00),
(440, 8, '1508007', 'COFT Coffee Maleo Classic Ground 1 K', 0.00, 20, 0.00, 0.00),
(441, 8, '1508008', 'COFT Coffee Merah Putih Ground', 0.00, 17, 0.00, 0.00),
(442, 8, '1508009', 'COFT Coffee Mayang Blend Beans', 0.00, 17, 0.00, 0.00),
(443, 8, '1508010', 'COFT Tea Logo', 0.00, 22, 0.00, 0.00),
(444, 8, '1508011', 'COFT Teh Celup Sariwangi 100 sachet', 0.00, 20, 0.00, 0.00),
(445, 8, '1508012', 'COFT Teh Celup Sariwangi 50 sachet', 0.00, 20, 0.00, 0.00),
(446, 8, '1508013', 'COFT Tea Dilmah Commomile 100 sachet', 0.00, 20, 0.00, 0.00),
(447, 8, '1508014', 'COFT Tea Dilmah Darjeeling 100 sache', 0.00, 20, 0.00, 0.00),
(448, 8, '1508015', 'COFT Tea Dilmah Earl Grey 100 sachet', 0.00, 20, 0.00, 0.00),
(449, 8, '1508016', 'COFT Tea Dilmah English B\'Fast 100 s', 0.00, 20, 0.00, 0.00),
(450, 8, '1508017', 'COFT Tea Dilmah Jasmin 100 sachet', 0.00, 20, 0.00, 0.00),
(451, 8, '1508018', 'COFT Tea Dilmah Oolong 100 sachet', 0.00, 20, 0.00, 0.00),
(452, 8, '1508019', 'COFT Tea Dilmah Peppermint 100 sache', 0.00, 20, 0.00, 0.00),
(453, 8, '1508020', 'COFT Teh Bubuk Tong Tji Super 40gr', 0.00, 20, 0.00, 0.00),
(454, 8, '1508021', 'COFT Teh Bubuk Tong Tji Super 80gr', 0.00, 20, 0.00, 0.00),
(455, 8, '1508022', 'COFT Teh Celup Tong Tji Asli 25 sach', 0.00, 20, 0.00, 0.00),
(456, 8, '1508023', 'COFT Teh Celup Tong Tji Jasmine 25 s', 0.00, 20, 0.00, 0.00),
(457, 8, '1508024', 'COFT Thai Tea Red Tea 400gr', 0.00, 20, 0.00, 0.00),
(458, 8, '1508025', 'COFT Thai Tea Green Tea 400gr', 0.00, 20, 0.00, 0.00),
(459, 8, '1508026', 'COFT Nescafe Classic 120gr', 0.00, 22, 0.00, 0.00),
(460, 8, '1508027', 'COFT Teh Tarik Max Tea 125gr', 0.00, 20, 0.00, 0.00),
(461, 9, '1509001', 'DP Ice Cream Diamond Chocolate 8L', 0.00, 21, 0.00, 0.00),
(462, 9, '1509002', 'DP Ice Cream Diamond Coconut 8L', 0.00, 21, 0.00, 0.00),
(463, 9, '1509003', 'DP Ice Cream Diamond Durian 8L', 0.00, 21, 0.00, 0.00),
(464, 9, '1509004', 'DP Ice Cream Diamond Mocca 8L', 0.00, 21, 0.00, 0.00),
(465, 9, '1509005', 'DP Ice Cream Diamond Rum Raisin 8L', 0.00, 21, 0.00, 0.00),
(466, 9, '1509006', 'DP Ice Cream Diamond Strawberry 8L', 0.00, 21, 0.00, 0.00),
(467, 9, '1509007', 'DP Ice Cream Diamond Vanilla 8L', 0.00, 21, 0.00, 0.00),
(468, 9, '1509008', 'DP Ice Cream Campina Chocolate 5L', 0.00, 21, 0.00, 0.00),
(469, 9, '1509009', 'DP Ice Cream Campina Strawberry 5L', 0.00, 21, 0.00, 0.00),
(470, 9, '1509010', 'DP Ice Cream Campina Vanilla 5L', 0.00, 21, 0.00, 0.00),
(471, 9, '1509011', 'DP Almond Ground Blanched (brand) (b', 0.00, 20, 0.00, 0.00),
(472, 9, '1509012', 'DP Baking Powder Hercules', 0.00, 17, 0.00, 0.00),
(473, 9, '1509013', 'DP Baking Soda 1 Kg', 0.00, 20, 0.00, 0.00),
(474, 9, '1509014', 'DP Baking Soda 100gr', 0.00, 20, 0.00, 0.00),
(475, 9, '1509015', 'DP Bread Improver Alpaga Puratos Sof', 0.00, 17, 0.00, 0.00),
(476, 9, '1509016', 'DP Bread Mix Ireks Sovital 12.5Kg', 0.00, 1, 0.00, 0.00),
(477, 9, '1509017', 'DP Bread Mix Ireks Rex Milano 12.5Kg', 0.00, 1, 0.00, 0.00),
(478, 9, '1509018', 'DP Bread Mix Ireks Rex Bavarian Dark', 0.00, 1, 0.00, 0.00),
(479, 9, '1509019', 'DP Bread Mix Ireks Pumpernickel 12.5', 0.00, 1, 0.00, 0.00),
(480, 9, '1509020', 'DP Bread Mix Ireks Avena 12.5Kg', 0.00, 1, 0.00, 0.00),
(481, 9, '1509021', 'DP Burger Bun Small', 0.00, 22, 0.00, 0.00),
(482, 9, '1509022', 'DP Butter Cream', 0.00, 17, 0.00, 0.00),
(483, 9, '1509023', 'DP Butter Margarine Palmia 200gr', 0.00, 20, 0.00, 0.00),
(484, 9, '1509024', 'DP Butter Portion Anchor Salted 10gr', 0.00, 22, 0.00, 0.00),
(485, 9, '1509025', 'DP Butter Portion Anchor Unsalted  1', 0.00, 22, 0.00, 0.00),
(486, 9, '1509026', 'DP Butter Unsalted Bulk 25 Kg', 0.00, 17, 0.00, 0.00),
(487, 9, '1509027', 'DP Butter Wisman Salted  1Kg', 0.00, 9, 0.00, 0.00),
(488, 9, '1509028', 'DP Cheese Brie (brand) (berat)', 0.00, 20, 0.00, 0.00),
(489, 9, '1509029', 'DP Cheese Camembert (brand) (berat)', 0.00, 20, 0.00, 0.00),
(490, 9, '1509030', 'DP Cheese Cream Tatura 1Kg', 0.00, 17, 0.00, 0.00),
(491, 9, '1509031', 'DP Cheese Edam (brand) (berat)', 0.00, 17, 0.00, 0.00),
(492, 9, '1509032', 'DP Cheese Emmenthal (brand) (berat)', 0.00, 17, 0.00, 0.00),
(493, 9, '1509033', 'DP Cheese Fetta Dodoni (berat)', 0.00, 20, 0.00, 0.00),
(494, 9, '1509034', 'DP Cheese Fetta Lemnos 180gr', 0.00, 20, 0.00, 0.00),
(495, 9, '1509035', 'DP Cheese Grated Parmesan (brand) (b', 0.00, 17, 0.00, 0.00),
(496, 9, '1509036', 'DP Cheese Hard Grana Padano Wheel', 0.00, 17, 0.00, 0.00),
(497, 9, '1509037', 'DP Cheese Low Moist Mozzarella (bran', 0.00, 17, 0.00, 0.00),
(498, 9, '1509038', 'DP Cheese Mayo Japanese Kewpie 1Kg', 0.00, 17, 0.00, 0.00),
(499, 9, '1509039', 'DP Cheese Mozzarella Block Arla 2.3K', 0.00, 20, 0.00, 0.00),
(500, 9, '1509040', 'DP Cheese Parmesan (brand) (berat)', 0.00, 17, 0.00, 0.00),
(501, 9, '1509041', 'DP Cheese Parmesan Block Grana Padan', 0.00, 17, 0.00, 0.00),
(502, 9, '1509042', 'DP Cheese Processed Block Koji Std (', 0.00, 20, 0.00, 0.00),
(503, 9, '1509043', 'DP Cheese Processed Cheddar Prochiz', 0.00, 20, 0.00, 0.00),
(504, 9, '1509044', 'DP Cheese Red Cheddar (brand) (berat', 0.00, 20, 0.00, 0.00),
(505, 9, '1509045', 'DP Cheese Sandwich Sliced Bega (bera', 0.00, 17, 0.00, 0.00),
(506, 9, '1509046', 'DP Cheese Slice Kraft Single 10 Slic', 0.00, 20, 0.00, 0.00),
(507, 9, '1509047', 'DP Cheese Slice Prochiz 10 Slices', 0.00, 20, 0.00, 0.00),
(508, 9, '1509048', 'DP Cheese Yellow Cheddar (brand) (be', 0.00, 17, 0.00, 0.00),
(509, 9, '1509049', 'DP Choco Chips', 0.00, 17, 0.00, 0.00),
(510, 9, '1509050', 'DP Choco Chips 400gr', 0.00, 20, 0.00, 0.00),
(511, 9, '1509051', 'DP Choco Chips Colatta 5Kg', 0.00, 11, 0.00, 0.00),
(512, 9, '1509052', 'DP Choco Chips Rainbow', 0.00, 17, 0.00, 0.00),
(513, 9, '1509053', 'DP Cocoa Powder Alkalized Bensdrop (', 0.00, 1, 0.00, 0.00),
(514, 9, '1509054', 'DP Cokelat Block (brand) (berat)', 0.00, 20, 0.00, 0.00),
(515, 9, '1509055', 'DP Cokelat Cha Cha Delfi 80gr', 0.00, 20, 0.00, 0.00),
(516, 9, '1509056', 'DP Cokelat Compound Baking Stick (be', 0.00, 20, 0.00, 0.00),
(517, 9, '1509057', 'DP Cokelat Compound Dark 1Kg', 0.00, 20, 0.00, 0.00),
(518, 9, '1509058', 'DP Cokelat Compound Dark 5Kg', 0.00, 20, 0.00, 0.00),
(519, 9, '1509059', 'DP Cokelat Compound White 1Kg', 0.00, 20, 0.00, 0.00),
(520, 9, '1509060', 'DP Cokelat Compound White 5Kg', 0.00, 20, 0.00, 0.00),
(521, 9, '1509061', 'DP Cokelat Powder Van Houten 180gr', 0.00, 20, 0.00, 0.00),
(522, 9, '1509062', 'DP Cooking Cream Elle & Vire 1L', 0.00, 20, 0.00, 0.00),
(523, 9, '1509063', 'DP Cream Cheese American (brand) (be', 0.00, 17, 0.00, 0.00),
(524, 9, '1509064', 'DP Cream Cheese Processed Koji 1Kg', 0.00, 20, 0.00, 0.00),
(525, 9, '1509065', 'DP Croissant B&P 160 x 30gr', 0.00, 11, 0.00, 0.00),
(526, 9, '1509066', 'DP Danish Chocolate B&P 200 x 30gr', 0.00, 11, 0.00, 0.00),
(527, 9, '1509067', 'DP Danish Pastry Sheet B&P 15 x 500g', 0.00, 11, 0.00, 0.00),
(528, 9, '1509068', 'DP Danish Raisin B&P 160 x 35gr', 0.00, 6, 0.00, 0.00),
(529, 9, '1509069', 'DP Donut Dusting (brand) 5Kg', 0.00, 11, 0.00, 0.00),
(530, 9, '1509070', 'DP Donuts Glaze Strawberry (brand) 5', 0.00, 21, 0.00, 0.00),
(531, 9, '1509071', 'DP Donuts Glaze Vanilla (brand) 5Kg', 0.00, 21, 0.00, 0.00),
(532, 9, '1509072', 'DP Donutz Glaze Mocca (brand) 5Kg', 0.00, 21, 0.00, 0.00),
(533, 9, '1509073', 'DP Perasa Red Bell Cokelat 55ml', 0.00, 8, 0.00, 0.00),
(534, 9, '1509074', 'DP Perasa Red Bell Durian 55ml', 0.00, 8, 0.00, 0.00),
(535, 9, '1509075', 'DP Perasa Red Bell Jeruk  55ml', 0.00, 8, 0.00, 0.00),
(536, 9, '1509076', 'DP Perasa Red Bell Melon 55ml', 0.00, 8, 0.00, 0.00),
(537, 9, '1509077', 'DP Perasa Red Bell Mocca 55ml', 0.00, 8, 0.00, 0.00),
(538, 9, '1509078', 'DP Perasa Red Bell Nangka 55ml', 0.00, 8, 0.00, 0.00),
(539, 9, '1509079', 'DP Perasa Red Bell Pandan 55ml', 0.00, 8, 0.00, 0.00),
(540, 9, '1509080', 'DP Perasa Red Bell Strawbery 55ml', 0.00, 8, 0.00, 0.00),
(541, 9, '1509081', 'DP Perasa Red Bell Vanilla 55ml', 0.00, 8, 0.00, 0.00),
(542, 9, '1509082', 'DP Vanilla Extrax Jansen Flavour 1Kg', 0.00, 8, 0.00, 0.00),
(543, 9, '1509083', 'DP Perasa Green Tea Golden Brown 100', 0.00, 8, 0.00, 0.00),
(544, 9, '1509084', 'DP Fruit Filling Fruitanera Apple 3K', 0.00, 9, 0.00, 0.00),
(545, 9, '1509085', 'DP Fruit Filling Fruitanera Blueberr', 0.00, 9, 0.00, 0.00),
(546, 9, '1509086', 'DP Frz Blueberry', 0.00, 17, 0.00, 0.00),
(547, 9, '1509087', 'DP Frz Raspberry', 0.00, 17, 0.00, 0.00),
(548, 9, '1509088', 'DP Gelatin Leaf Sheet (brand) (berat', 0.00, 6, 0.00, 0.00),
(549, 9, '1509089', 'DP Gelatin Powder (brand) (berat)', 0.00, 20, 0.00, 0.00),
(550, 9, '1509090', 'DP Glaze Apricot Frutaneira 7Kg', 0.00, 21, 0.00, 0.00),
(551, 9, '1509091', 'DP Glukosa Powder (brand) (berat)', 0.00, 9, 0.00, 0.00),
(552, 9, '1509092', 'DP Gula Halus', 0.00, 17, 0.00, 0.00),
(553, 9, '1509093', 'DP Icing Sugar Fiesta 15Kg', 0.00, 21, 0.00, 0.00),
(554, 9, '1509094', 'DP Icing Sugar 500gr', 0.00, 20, 0.00, 0.00),
(555, 9, '1509095', 'DP Japanese Cranberry', 0.00, 17, 0.00, 0.00),
(556, 9, '1509096', 'DP Margarine Blue Band Serbaguna 200', 0.00, 20, 0.00, 0.00),
(557, 9, '1509097', 'DP Margarine Palmia Special 15Kg', 0.00, 9, 0.00, 0.00),
(558, 9, '1509098', 'DP Margarine Palmia Supercake 15Kg', 0.00, 9, 0.00, 0.00),
(559, 9, '1509099', 'DP Mayonnaise Bestfoods 3L', 0.00, 21, 0.00, 0.00),
(560, 9, '1509100', 'DP Mayonnaise Maestro 1Kg', 0.00, 20, 0.00, 0.00),
(561, 9, '1509101', 'DP Meises Coklat', 0.00, 17, 0.00, 0.00),
(562, 9, '1509102', 'DP Meises Rainbow', 0.00, 17, 0.00, 0.00),
(563, 9, '1509103', 'DP Mentega Putih', 0.00, 17, 0.00, 0.00),
(564, 9, '1509104', 'DP Mentega Putih Peerless (berat)', 0.00, 10, 0.00, 0.00),
(565, 9, '1509105', 'DP Ovalett Koepoe 30gr', 0.00, 20, 0.00, 0.00),
(566, 9, '1509106', 'DP Ovalett (brand) 1Kg', 0.00, 17, 0.00, 0.00),
(567, 9, '1509107', 'DP Pasta Pandan Flavour Diamond (ber', 0.00, 8, 0.00, 0.00),
(568, 9, '1509108', 'DP Pasta Panda Fill Yu Ai 1Kg', 0.00, 20, 0.00, 0.00),
(569, 9, '1509109', 'DP Pasta Tiramisu Flavour Jansen 1Kg', 0.00, 16, 0.00, 0.00),
(570, 9, '1509110', 'DP Pewarna Makanan Koepoe Biru 30ml', 0.00, 8, 0.00, 0.00),
(571, 9, '1509111', 'DP Pewarna Makanan Koepoe Cokelat 30', 0.00, 8, 0.00, 0.00),
(572, 9, '1509112', 'DP Pewarna Makanan Koepoe Hijau Muda', 0.00, 8, 0.00, 0.00),
(573, 9, '1509113', 'DP Pewarna Makanan Koepoe Kuning Mud', 0.00, 8, 0.00, 0.00),
(574, 9, '1509114', 'DP Pewarna Makanan Koepoe Kuning Tua', 0.00, 8, 0.00, 0.00),
(575, 9, '1509115', 'DP Pewarna Makanan Koepoe Merah Cabe', 0.00, 8, 0.00, 0.00),
(576, 9, '1509116', 'DP Pewarna Makanan Koepoe Merah Rose', 0.00, 8, 0.00, 0.00),
(577, 9, '1509117', 'DP Pewarna Makanan Koepoe Merah Tua', 0.00, 8, 0.00, 0.00),
(578, 9, '1509118', 'DP Pewarna Makanan Koepoe Orange 30m', 0.00, 8, 0.00, 0.00),
(579, 9, '1509119', 'DP Pewarna Makanan Koepoe Ungu 30ml', 0.00, 8, 0.00, 0.00),
(580, 9, '1509120', 'DP Praline Mix (brand) (berat)', 0.00, 22, 0.00, 0.00),
(581, 9, '1509121', 'DP Puff Pastry Mix Butter Bon chef (', 0.00, 11, 0.00, 0.00),
(582, 9, '1509122', 'DP Puff Pastry Sheet (brand) (berat)', 0.00, 6, 0.00, 0.00),
(583, 9, '1509123', 'DP Ragi Instant Fermipan Brown 500gr', 0.00, 20, 0.00, 0.00),
(584, 9, '1509124', 'DP Ragi Instant Angel Brown 500gr', 0.00, 20, 0.00, 0.00),
(585, 9, '1509125', 'DP RAP Instant Custard Pwdr Zeelandi', 0.00, 11, 0.00, 0.00),
(586, 9, '1509126', 'DP Red Cherry Diana Maraschino (bera', 0.00, 14, 0.00, 0.00),
(587, 9, '1509127', 'DP Selai Blueberry Edna', 0.00, 17, 0.00, 0.00),
(588, 9, '1509128', 'DP Selai Blueberry Palletta Excellen', 0.00, 21, 0.00, 0.00),
(589, 9, '1509129', 'DP Selai Kacang Morin', 0.00, 17, 0.00, 0.00),
(590, 9, '1509130', 'DP Selai Kacang Welco 275gr', 0.00, 8, 0.00, 0.00),
(591, 9, '1509131', 'DP Selai Lemon Paletta Excellent 5Kg', 0.00, 21, 0.00, 0.00),
(592, 9, '1509132', 'DP Selai Nanas Edna', 0.00, 17, 0.00, 0.00),
(593, 9, '1509133', 'DP Selai Strawberry Edna', 0.00, 17, 0.00, 0.00),
(594, 9, '1509134', 'DP Selai Strawberry Palletta Excelle', 0.00, 21, 0.00, 0.00),
(595, 9, '1509135', 'DP Selai Topp\'g Mariza Bluebry 200gr', 0.00, 8, 0.00, 0.00),
(596, 9, '1509136', 'DP Selai Topp\'g Mariza Cokelat 200gr', 0.00, 8, 0.00, 0.00),
(597, 9, '1509137', 'DP Selai Topp\'g Mariza Cokelat 350gr', 0.00, 22, 0.00, 0.00),
(598, 9, '1509138', 'DP Selai Topp\'g Mariza Strwbry 200gr', 0.00, 8, 0.00, 0.00),
(599, 9, '1509139', 'DP Selai Topp\'g Mariza Strwbry 350gr', 0.00, 22, 0.00, 0.00),
(600, 9, '1509140', 'DP Sukade', 0.00, 17, 0.00, 0.00),
(601, 9, '1509141', 'DP Sweet Banana Filling Prosperich (', 0.00, 22, 0.00, 0.00),
(602, 9, '1509142', 'DP Sweet Cherries Dark Blue Pacific', 0.00, 9, 0.00, 0.00),
(603, 9, '1509143', 'DP Swiss Line Dark Coins Carma', 0.00, 5, 0.00, 0.00),
(604, 9, '1509144', 'DP Swiss Line White Coins Carma', 0.00, 5, 0.00, 0.00),
(605, 9, '1509145', 'DP Tepung Custard Hercules 300gr', 0.00, 9, 0.00, 0.00),
(606, 9, '1509146', 'DP Tepung Custard Hercules', 0.00, 17, 0.00, 0.00),
(607, 9, '1509147', 'DP Trimits Rainbow', 0.00, 17, 0.00, 0.00),
(608, 9, '1509148', 'DP Wafer Stick (brand) (berat)', 0.00, 20, 0.00, 0.00),
(609, 9, '1509149', 'DP Whip Cream Non Dairy Shine Road 1', 0.00, 20, 0.00, 0.00),
(610, 9, '1509150', 'DP White Fondant', 0.00, 17, 0.00, 0.00),
(611, 9, '1509151', 'DP Yoghurt  Stirred Plain Biokul 1L', 0.00, 22, 0.00, 0.00),
(612, 9, '1509152', 'DP Yoghurt Biokul 100ml', 0.00, 22, 0.00, 0.00),
(613, 9, '1509153', 'DP Kulit Lumpia Besar', 0.00, 22, 0.00, 0.00),
(614, 9, '1509154', 'DP Kulit Lumpia Medium', 0.00, 22, 0.00, 0.00),
(615, 9, '1509155', 'DP Kulit Lumpia TYJ Spring Home 5\" 2', 0.00, 20, 0.00, 0.00),
(616, 9, '1509156', 'DP Kulit Lumpia TYJ Spring Home 8.5\"', 0.00, 20, 0.00, 0.00),
(617, 9, '1509157', 'DP Kulit Pangsit Ye Yen', 0.00, 20, 0.00, 0.00),
(618, 9, '1509158', 'DP Samosa Curry Beef (brand) (berat)', 0.00, 20, 0.00, 0.00),
(619, 9, '1509159', 'DP Samosa Curry Chicken (brand) (ber', 0.00, 20, 0.00, 0.00),
(620, 9, '1509160', 'DP Samosa Curry Lamb (brand) (berat)', 0.00, 20, 0.00, 0.00),
(621, 9, '1509161', 'DP Rice Paper Round 16cm', 0.00, 22, 0.00, 0.00),
(622, 9, '1509162', 'DP Tortilla Flour Mission 6\"', 0.00, 20, 0.00, 0.00),
(623, 9, '1509163', 'DP Tortilla Flour Mission 8\"', 0.00, 20, 0.00, 0.00),
(624, 9, '1509164', 'DP Tortila Corn Mission 6\'\'', 0.00, 20, 0.00, 0.00),
(625, 9, '1509165', 'DP Toast Bread \"ASTON\"', 0.00, 18, 0.00, 0.00),
(626, 9, '1509166', 'DP Red Cherry', 0.00, 17, 0.00, 0.00),
(627, 9, '1509167', 'DP Cokelat Powder', 0.00, 17, 0.00, 0.00),
(628, 10, '1510001', 'GROC Abon Ayam', 0.00, 17, 0.00, 0.00),
(629, 10, '1510002', 'GROC Abon Sapi', 0.00, 17, 0.00, 0.00),
(630, 10, '1510003', 'GROC Bawang Merah Goreng', 0.00, 17, 0.00, 0.00),
(631, 10, '1510004', 'GROC Bawang Putih Goreng', 0.00, 17, 0.00, 0.00),
(632, 10, '1510005', 'GROC Agar-Agar Swallow Globe 12x7gr', 0.00, 20, 0.00, 0.00),
(633, 10, '1510006', 'GROC Jelly Nutrijel Plain 12x15gr', 0.00, 20, 0.00, 0.00),
(634, 10, '1510007', 'GROC Jelly Nutrijell Coklat 12x15gr', 0.00, 20, 0.00, 0.00),
(635, 10, '1510008', 'GROC Kembang Tahu 200gr', 0.00, 20, 0.00, 0.00),
(636, 10, '1510009', 'GROC Almond Ground', 0.00, 17, 0.00, 0.00),
(637, 10, '1510010', 'GROC Meat Tenderizer (brand) (berat)', 0.00, 22, 0.00, 0.00),
(638, 10, '1510011', 'GROC Petis Udang', 0.00, 17, 0.00, 0.00),
(639, 10, '1510012', 'GROC Petis Tahu/Bumbu 250gr', 0.00, 20, 0.00, 0.00),
(640, 10, '1510013', 'GROC Sagu Mutiara Kucing 100gr', 0.00, 4, 0.00, 0.00),
(641, 10, '1510014', 'GROC Santan Sun Kara 1000ml', 0.00, 20, 0.00, 0.00),
(642, 10, '1510015', 'GROC Santan Sun Kara 200ml', 0.00, 20, 0.00, 0.00),
(643, 10, '1510016', 'GROC Santan KARA 1000ml', 0.00, 22, 0.00, 0.00),
(644, 10, '1510017', 'GROC Serbuk Arang Hitam', 0.00, 20, 0.00, 0.00),
(645, 10, '1510018', 'GROC Sushi Nori Takaokaya  50sheets', 0.00, 20, 0.00, 0.00),
(646, 10, '1510019', 'GROC Tong Cay TTS 300gr', 0.00, 20, 0.00, 0.00),
(647, 10, '1510020', 'GROC Wijen', 0.00, 17, 0.00, 0.00),
(648, 10, '1510021', 'GROC Candy (logo) Pack', 0.00, 20, 0.00, 0.00),
(649, 10, '1510022', 'GROC Candy Ricola 25gr', 0.00, 20, 0.00, 0.00),
(650, 10, '1510023', 'GROC Gula Batu 400gr', 0.00, 20, 0.00, 0.00),
(651, 10, '1510024', 'GROC Gula Lokal Kristal 50 Kg', 0.00, 17, 0.00, 0.00),
(652, 10, '1510025', 'GROC Gula Merah', 0.00, 17, 0.00, 0.00),
(653, 10, '1510026', 'GROC Gula Palm', 0.00, 17, 0.00, 0.00),
(654, 10, '1510027', 'GROC Gulaku Indolampung 1 Kg', 0.00, 20, 0.00, 0.00),
(655, 10, '1510028', 'GROC Madu Murni Nusantara 650ml', 0.00, 8, 0.00, 0.00),
(656, 10, '1510029', 'GROC Sweetener Stick (logo)', 0.00, 20, 0.00, 0.00),
(657, 10, '1510030', 'GROC White Sugar Stick (logo)', 0.00, 20, 0.00, 0.00),
(658, 10, '1510031', 'GROC Brown Sugar Stick (logo)', 0.00, 20, 0.00, 0.00),
(659, 10, '1510032', 'GROC Asparagus Cut Narcissus 430gr', 0.00, 9, 0.00, 0.00),
(660, 10, '1510033', 'GROC Fruit Cocktail (brand) 822gr', 0.00, 9, 0.00, 0.00),
(661, 10, '1510034', 'GROC Lychee Kaleng Narcissus 567gr', 0.00, 9, 0.00, 0.00),
(662, 10, '1510035', 'GROC Longan In Syrup Narcissus 567gr', 0.00, 9, 0.00, 0.00),
(663, 10, '1510036', 'GROC Mushroom Champignon (brand) 425', 0.00, 9, 0.00, 0.00),
(664, 10, '1510037', 'GROC Sweet Corn Cream (brand) 418gr', 0.00, 9, 0.00, 0.00),
(665, 10, '1510038', 'GROC Whole Kernel Corn  Delmonte  43', 0.00, 9, 0.00, 0.00),
(666, 10, '1510039', 'GROC Whole Peeled Tomato Ciao 2.5Kg', 0.00, 9, 0.00, 0.00),
(667, 10, '1510040', 'GROC Whole Kernel Sweet Corn Pronas', 0.00, 9, 0.00, 0.00),
(668, 10, '1510041', 'GROC Fava Bean (brand) 450gr', 0.00, 9, 0.00, 0.00),
(669, 10, '1510042', 'GROC Black Bean Tausi 180gr', 0.00, 9, 0.00, 0.00),
(670, 10, '1510043', 'GROC Black Olive (brand) (berat)', 0.00, 9, 0.00, 0.00),
(671, 10, '1510044', 'GROC Black Olive Pitted (brand) 5Kg', 0.00, 23, 0.00, 0.00),
(672, 10, '1510045', 'GROC Kacang Polong Kaleng Ma Ling 39', 0.00, 9, 0.00, 0.00),
(673, 10, '1510046', 'GROC Cereal Kellog\'s Coco Loops 330g', 0.00, 20, 0.00, 0.00),
(674, 10, '1510047', 'GROC Cereal Kellog\'s Corn Flk Honey', 0.00, 20, 0.00, 0.00),
(675, 10, '1510048', 'GROC Cereal Kellog\'s Corn Flk Jumbo', 0.00, 20, 0.00, 0.00),
(676, 10, '1510049', 'GROC Cereal Nestle Cornflake 275gr', 0.00, 20, 0.00, 0.00),
(677, 10, '1510050', 'GROC Cereal Nestle Honeystar 300gr', 0.00, 20, 0.00, 0.00),
(678, 10, '1510051', 'GROC Cereal Nestle Koko Krunch 330gr', 0.00, 20, 0.00, 0.00),
(679, 10, '1510052', 'GROC Oatmeal Instan Quaker 800gr', 0.00, 20, 0.00, 0.00),
(680, 10, '1510053', 'GROC Biskuit Oreo 170gr', 0.00, 20, 0.00, 0.00),
(681, 10, '1510054', 'GROC Biskuit Oreo Double Delight 137', 0.00, 20, 0.00, 0.00),
(682, 10, '1510055', 'GROC Biskuit Oreo Golden Vanilla 137', 0.00, 20, 0.00, 0.00),
(683, 10, '1510056', 'GROC Biskuit Oreo Straw Cream 137gr', 0.00, 20, 0.00, 0.00),
(684, 10, '1510057', 'GROC Cokelat Silver Quen Dark 68gr', 0.00, 20, 0.00, 0.00),
(685, 10, '1510058', 'GROC Wafer Tim Tam 77.5gr', 0.00, 20, 0.00, 0.00),
(686, 10, '1510059', 'GROC Cokelat Astor Stick', 0.00, 24, 0.00, 0.00),
(687, 10, '1510060', 'GROC Kacang Almond', 0.00, 17, 0.00, 0.00),
(688, 10, '1510061', 'GROC Kacang Almond Slice 2 Kg', 0.00, 20, 0.00, 0.00),
(689, 10, '1510062', 'GROC Kacang Arab 250gr', 0.00, 20, 0.00, 0.00),
(690, 10, '1510063', 'GROC Kacang Atom Sukro', 0.00, 17, 0.00, 0.00),
(691, 10, '1510064', 'GROC Kacang Atom Pack Kecil', 0.00, 20, 0.00, 0.00),
(692, 10, '1510065', 'GROC Kacang Hijau Kupas', 0.00, 17, 0.00, 0.00),
(693, 10, '1510066', 'GROC Kacang Polong Snack', 0.00, 17, 0.00, 0.00),
(694, 10, '1510067', 'GROC Kacang Kedelai', 0.00, 17, 0.00, 0.00),
(695, 10, '1510068', 'GROC Kacang Kenari', 0.00, 17, 0.00, 0.00),
(696, 10, '1510069', 'GROC Kacang Koro', 0.00, 17, 0.00, 0.00),
(697, 10, '1510070', 'GROC Kacang Koro Balado', 0.00, 17, 0.00, 0.00),
(698, 10, '1510071', 'GROC Kacang Merah', 0.00, 17, 0.00, 0.00),
(699, 10, '1510072', 'GROC Kacang Mete Mentah', 0.00, 17, 0.00, 0.00),
(700, 10, '1510073', 'GROC Kacang Tanah Kupas Ari', 0.00, 17, 0.00, 0.00),
(701, 10, '1510074', 'GROC Kacang Tanah Kupas Bersih', 0.00, 17, 0.00, 0.00),
(702, 10, '1510075', 'GROC Kacang Telur Garuda 250gr', 0.00, 20, 0.00, 0.00),
(703, 10, '1510076', 'GROC Kacang Telur Halus', 0.00, 17, 0.00, 0.00),
(704, 10, '1510077', 'GROC Kacang Telur Pack Kecil', 0.00, 20, 0.00, 0.00),
(705, 10, '1510078', 'GROC Kacang Telur Medan (Kasar)', 0.00, 17, 0.00, 0.00),
(706, 10, '1510079', 'GROC Kacang Mr. P 40gr', 0.00, 20, 0.00, 0.00),
(707, 10, '1510080', 'GROC Emping Melinjo', 0.00, 17, 0.00, 0.00),
(708, 10, '1510081', 'GROC Keripik Jagung Happy Tos Corn 1', 0.00, 20, 0.00, 0.00),
(709, 10, '1510082', 'GROC Keripik Jamur', 0.00, 17, 0.00, 0.00),
(710, 10, '1510083', 'GROC Keripik Kentang BBQ', 0.00, 20, 0.00, 0.00),
(711, 10, '1510084', 'GROC Keripik Pisang', 0.00, 17, 0.00, 0.00),
(712, 10, '1510085', 'GROC Keripik Singkong', 0.00, 17, 0.00, 0.00),
(713, 10, '1510086', 'GROC Keripik Sukun', 0.00, 17, 0.00, 0.00),
(714, 10, '1510087', 'GROC Lentil Kuning', 0.00, 20, 0.00, 0.00),
(715, 10, '1510088', 'GROC Potato Snack Chitato', 0.00, 20, 0.00, 0.00),
(716, 10, '1510089', 'GROC Keripik Tempe', 0.00, 20, 0.00, 0.00),
(717, 10, '1510090', 'GROC Keripik Ubi Ungu', 0.00, 17, 0.00, 0.00),
(718, 10, '1510091', 'GROC Kerupuk Bawang', 0.00, 17, 0.00, 0.00),
(719, 10, '1510092', 'GROC Kerupuk Bintang', 0.00, 17, 0.00, 0.00),
(720, 10, '1510093', 'GROC Kerupuk Gendar', 0.00, 17, 0.00, 0.00),
(721, 10, '1510094', 'GROC Kerupuk Gendar/Puli', 0.00, 17, 0.00, 0.00),
(722, 10, '1510095', 'GROC Kerupuk Ikan 500gr', 0.00, 20, 0.00, 0.00),
(723, 10, '1510096', 'GROC Kerupuk Ikan Tengiri', 0.00, 17, 0.00, 0.00),
(724, 10, '1510097', 'GROC Kerupuk Kedelai', 0.00, 17, 0.00, 0.00),
(725, 10, '1510098', 'GROC Kerupuk Kelenteng Mentah', 0.00, 17, 0.00, 0.00),
(726, 10, '1510099', 'GROC Kerupuk Mawar', 0.00, 20, 0.00, 0.00),
(727, 10, '1510100', 'GROC Kerupuk Palembang', 0.00, 20, 0.00, 0.00),
(728, 10, '1510101', 'GROC Kerupuk Putih Kaleng', 0.00, 22, 0.00, 0.00),
(729, 10, '1510102', 'GROC Kerupuk Rambak', 0.00, 17, 0.00, 0.00),
(730, 10, '1510103', 'GROC Kerupuk Udang Besar 500gr', 0.00, 20, 0.00, 0.00);
INSERT INTO `t06_article` (`id`, `SubGroupID`, `Kode`, `Nama`, `Qty`, `SatuanID`, `Harga`, `HargaJual`) VALUES
(731, 10, '1510104', 'GROC Kerupuk Udang Kecil Finna 380 G', 0.00, 20, 0.00, 0.00),
(732, 10, '1510105', 'GROC Kerupuk Unyil', 0.00, 17, 0.00, 0.00),
(733, 10, '1510106', 'GROC Kerupuk Warna', 0.00, 20, 0.00, 0.00),
(734, 10, '1510107', 'GROC Potato Mashed Knorr 4Kg', 0.00, 11, 0.00, 0.00),
(735, 10, '1510108', 'GROC Potatoes Mini Pyramid 2.27Kg', 0.00, 20, 0.00, 0.00),
(736, 10, '1510109', 'GROC Potato Pom pom Yorksign Puff', 0.00, 20, 0.00, 0.00),
(737, 10, '1510110', 'GROC Potato Straight Cut YorkSign 2.', 0.00, 20, 0.00, 0.00),
(738, 10, '1510111', 'GROC Potato Supercrips Wedges Spicy', 0.00, 17, 0.00, 0.00),
(739, 10, '1510112', 'GROC Potato Triangle Patties Hash Br', 0.00, 20, 0.00, 0.00),
(740, 10, '1510113', 'GROC Potato Wedges Country', 0.00, 17, 0.00, 0.00),
(741, 10, '1510114', 'GROC Frz Baby Carrots (brand) (berat', 0.00, 20, 0.00, 0.00),
(742, 10, '1510115', 'GROC Frz Brussle Sprouts (brand) (be', 0.00, 20, 0.00, 0.00),
(743, 10, '1510116', 'GROC Frz Edamame 500gr', 0.00, 20, 0.00, 0.00),
(744, 10, '1510117', 'GROC Frz Green Peas (brand) 500gr', 0.00, 20, 0.00, 0.00),
(745, 10, '1510118', 'GROC Frz Kernel Corn Golden Farm 1Kg', 0.00, 20, 0.00, 0.00),
(746, 10, '1510119', 'GROC Frz Mixed Vegetable Golden Farm', 0.00, 20, 0.00, 0.00),
(747, 10, '1510120', 'GROC Acar Gherkins Koleman 670gr', 0.00, 8, 0.00, 0.00),
(748, 10, '1510121', 'GROC Acar Kaper Mezzetta  Capers 118', 0.00, 8, 0.00, 0.00),
(749, 10, '1510122', 'GROC Cendol 1Kg', 0.00, 20, 0.00, 0.00),
(750, 10, '1510123', 'GROC Cincau Hitam', 0.00, 17, 0.00, 0.00),
(751, 10, '1510124', 'GROC Cincau Hijau', 0.00, 17, 0.00, 0.00),
(752, 10, '1510125', 'GROC Kolang Kaling', 0.00, 17, 0.00, 0.00),
(753, 10, '1510126', 'GROC Nata De Coco Inaco 1Kg', 0.00, 20, 0.00, 0.00),
(754, 10, '1510127', 'GROC Nata De Coco Kara 1Kg', 0.00, 20, 0.00, 0.00),
(755, 10, '1510128', 'GROC Kapur Sirih', 0.00, 17, 0.00, 0.00),
(756, 10, '1510129', 'GROC Permen Cokelat Warna M&M (berat', 0.00, 17, 0.00, 0.00),
(757, 10, '1510130', 'GROC Permen Lolipop (berat)', 0.00, 22, 0.00, 0.00),
(758, 10, '1510131', 'GROC Kacang Atom Macan 375gr', 0.00, 22, 0.00, 0.00),
(759, 10, '1510132', 'GROC Manisan Buah Kering', 0.00, 17, 0.00, 0.00),
(760, 10, '1510133', 'GROC Potato Shoestring 2,5Kg', 0.00, 20, 0.00, 0.00),
(761, 11, '1511001', 'SAUSEA Kecap Asin ABC 5.7Kg', 0.00, 16, 0.00, 0.00),
(762, 11, '1511002', 'SAUSEA Kecap Asin ABC 650ml', 0.00, 8, 0.00, 0.00),
(763, 11, '1511003', 'SAUSEA Kecap Manis ABC 5.7Kg', 0.00, 16, 0.00, 0.00),
(764, 11, '1511004', 'SAUSEA Kecap Ikan Fish Gravi 620ml', 0.00, 8, 0.00, 0.00),
(765, 11, '1511005', 'SAUSEA Kecap Ikan Cap Oyster Finna 6', 0.00, 8, 0.00, 0.00),
(766, 11, '1511006', 'SAUSEA BBQ Sauce Knorr 1Kg', 0.00, 9, 0.00, 0.00),
(767, 11, '1511007', 'SAUSEA BBQ Sauce McLewis 1Kg', 0.00, 20, 0.00, 0.00),
(768, 11, '1511008', 'SAUSEA Char Siu Sauce Lee Kum Kee 2.', 0.00, 9, 0.00, 0.00),
(769, 11, '1511009', 'SAUSEA Cheese Sauce Mix Knorr  750gr', 0.00, 21, 0.00, 0.00),
(770, 11, '1511010', 'SAUSEA Chili Garlic Sauce Lee Kum Ke', 0.00, 8, 0.00, 0.00),
(771, 11, '1511011', 'SAUSEA Dark Soy Sauce Lee Kum Kee 50', 0.00, 8, 0.00, 0.00),
(772, 11, '1511012', 'SAUSEA Mushroom Sauce Pearl Bridge 6', 0.00, 8, 0.00, 0.00),
(773, 11, '1511013', 'SAUSEA Demiglace Brown Sauce Knorr 1', 0.00, 9, 0.00, 0.00),
(774, 11, '1511014', 'SAUSEA Japan Grill Teriyaki Kikkoman', 0.00, 8, 0.00, 0.00),
(775, 11, '1511015', 'SAUSEA Japan Spicy Teriyaki Kikkoman', 0.00, 8, 0.00, 0.00),
(776, 11, '1511016', 'SAUSEA Saus Tiram LKK Panda 2.27Kg', 0.00, 9, 0.00, 0.00),
(777, 11, '1511017', 'SAUSEA Saus Tiram ABC 425ml', 0.00, 8, 0.00, 0.00),
(778, 11, '1511018', 'SAUSEA Pepper Sauce Tabasco 150ml', 0.00, 8, 0.00, 0.00),
(779, 11, '1511019', 'SAUSEA Pepper Sauce Tabasco 60ml', 0.00, 8, 0.00, 0.00),
(780, 11, '1511020', 'SAUSEA Saus A1 240gr', 0.00, 8, 0.00, 0.00),
(781, 11, '1511021', 'SAUSEA Saus Hoisin Lee Kum Kee 2.27K', 0.00, 9, 0.00, 0.00),
(782, 11, '1511022', 'SAUSEA Saus HP Original 255gr', 0.00, 8, 0.00, 0.00),
(783, 11, '1511023', 'SAUSEA Saus L&P 284ml', 0.00, 8, 0.00, 0.00),
(784, 11, '1511024', 'SAUSEA Saus Raja Rasa 600ml', 0.00, 8, 0.00, 0.00),
(785, 11, '1511025', 'SAUSEA Saus Sambal ABC 5.7Kg', 0.00, 16, 0.00, 0.00),
(786, 11, '1511026', 'SAUSEA Saus Sambal ABC Sachet', 0.00, 20, 0.00, 0.00),
(787, 11, '1511027', 'SAUSEA Saus Sambal Delmonte 5.7Kg', 0.00, 16, 0.00, 0.00),
(788, 11, '1511028', 'SAUSEA Saus Tomat ABC 5.7Kg', 0.00, 16, 0.00, 0.00),
(789, 11, '1511029', 'SAUSEA Saus Tomat ABC Sachet', 0.00, 20, 0.00, 0.00),
(790, 11, '1511030', 'SAUSEA Saus Tomat Delmonte 5.7Kg', 0.00, 16, 0.00, 0.00),
(791, 11, '1511031', 'SAUSEA Saus Inggris Sedap Wangi 600m', 0.00, 8, 0.00, 0.00),
(792, 11, '1511032', 'SAUSEA Soy Sauce/Shoyu Kikkoman 1.6L', 0.00, 8, 0.00, 0.00),
(793, 11, '1511033', 'SAUSEA Soy Sauce/Shoyu Kikkoman 250m', 0.00, 8, 0.00, 0.00),
(794, 11, '1511034', 'SAUSEA Sushi&Sashimi Sauce Kikkoman', 0.00, 8, 0.00, 0.00),
(795, 11, '1511035', 'SAUSEA Sambal Bajak Hot Kokita 5Kg', 0.00, 16, 0.00, 0.00),
(796, 11, '1511036', 'SAUSEA Sambal Balado Kokita 5Kg', 0.00, 16, 0.00, 0.00),
(797, 11, '1511037', 'SAUSEA Sambal Bangkok Kokita 400gr', 0.00, 8, 0.00, 0.00),
(798, 11, '1511038', 'SAUSEA Sambal Bangkok Kokita 5Kg', 0.00, 16, 0.00, 0.00),
(799, 11, '1511039', 'SAUSEA Sambal Tauco Cap Ibu 260gr', 0.00, 8, 0.00, 0.00),
(800, 11, '1511040', 'SAUSEA Sambal Tauco Korea Daesang 50', 0.00, 21, 0.00, 0.00),
(801, 11, '1511041', 'SAUSEA Sambal Terasi Kokita 5Kg', 0.00, 16, 0.00, 0.00),
(802, 11, '1511042', 'SAUSEA Bumbu Kacang', 0.00, 17, 0.00, 0.00),
(803, 11, '1511043', 'SAUSEA Bumbu Pecel', 0.00, 20, 0.00, 0.00),
(804, 11, '1511044', 'SAUSEA Beef Seasoning Pwdr Knorr 1Kg', 0.00, 9, 0.00, 0.00),
(805, 11, '1511045', 'SAUSEA Chicken Seasoning Pwdr Knorr', 0.00, 20, 0.00, 0.00),
(806, 11, '1511046', 'SAUSEA Chicken Seasoning Pwdr Knorr', 0.00, 20, 0.00, 0.00),
(807, 11, '1511047', 'SAUSEA Kaldu Ayam Royco 230gr', 0.00, 20, 0.00, 0.00),
(808, 11, '1511048', 'SAUSEA Seasoning Maggie 200ml', 0.00, 8, 0.00, 0.00),
(809, 11, '1511049', 'SAUSEA Penyedap Rasa Ajinomoto 1Kg', 0.00, 20, 0.00, 0.00),
(810, 11, '1511050', 'SAUSEA Penyedap Rasa Miwon 1Kg', 0.00, 20, 0.00, 0.00),
(811, 11, '1511051', 'SAUSEA Penyedap Rasa Sapi Royco 1Kg', 0.00, 20, 0.00, 0.00),
(812, 11, '1511052', 'SAUSEA Kaldu Sapi Royco 230gr', 0.00, 20, 0.00, 0.00),
(813, 11, '1511053', 'SAUSEA Kaldu Ikan Hon Dashi Ajinomot', 0.00, 20, 0.00, 0.00),
(814, 11, '1511054', 'SAUSEA Arak Masak Pek Bie Tjoe 600ml', 0.00, 8, 0.00, 0.00),
(815, 11, '1511055', 'SAUSEA Arak Masak Shao Hsing Pagoda', 0.00, 8, 0.00, 0.00),
(816, 11, '1511056', 'SAUSEA Arak Merah Angciu Lonceng 600', 0.00, 8, 0.00, 0.00),
(817, 11, '1511057', 'SAUSEA Arak Masak Hinode Mirin (bran', 0.00, 8, 0.00, 0.00),
(818, 11, '1511058', 'SAUSEA Cuka Masak Dixi 150ml', 0.00, 8, 0.00, 0.00),
(819, 11, '1511059', 'SAUSEA Cuka Masak Dixi 650ml', 0.00, 8, 0.00, 0.00),
(820, 11, '1511060', 'SAUSEA Cuka Mizkan Suehiro Su 1.8L', 0.00, 8, 0.00, 0.00),
(821, 11, '1511061', 'SAUSEA Cuka Mizkan Sushi Su 500ml', 0.00, 8, 0.00, 0.00),
(822, 11, '1511062', 'SAUSEA Balsamic Vinegar Bertolli 500', 0.00, 8, 0.00, 0.00),
(823, 11, '1511063', 'SAUSEA Black Vinegar Narcissus 640ml', 0.00, 8, 0.00, 0.00),
(824, 11, '1511064', 'SAUSEA Red Wine Vinegar Varvello 1L', 0.00, 8, 0.00, 0.00),
(825, 11, '1511065', 'SAUSEA Rice Vinegar Narcissus 600ml', 0.00, 8, 0.00, 0.00),
(826, 11, '1511066', 'SAUSEA White Wine Vinegar Varvello 1', 0.00, 8, 0.00, 0.00),
(827, 11, '1511067', 'SAUSEA Tauco Yeo\'s 450gr', 0.00, 8, 0.00, 0.00),
(828, 11, '1511068', 'SAUSEA Tauco Kokita 400gr', 0.00, 8, 0.00, 0.00),
(829, 11, '1511069', 'SAUSEA Miso Shinshuichi Mikochan 300', 0.00, 20, 0.00, 0.00),
(830, 11, '1511070', 'SAUSEA Garam Cap Kapal', 0.00, 17, 0.00, 0.00),
(831, 11, '1511071', 'SAUSEA Bumbu Inti A Kokita 5Kg', 0.00, 16, 0.00, 0.00),
(832, 11, '1511072', 'SAUSEA Bumbu Inti B Kokita 5Kg', 0.00, 16, 0.00, 0.00),
(833, 11, '1511073', 'SAUSEA Bumbu Inti C Kokita 5Kg', 0.00, 16, 0.00, 0.00),
(834, 11, '1511074', 'SAUSEA Bumbu Inti D Kokita 5Kg', 0.00, 16, 0.00, 0.00),
(835, 11, '1511075', 'SAUSEA Dijon Mustard Maestro 865gr', 0.00, 8, 0.00, 0.00),
(836, 11, '1511076', 'SAUSEA Dijon Mustard Vilux 5kg', 0.00, 16, 0.00, 0.00),
(837, 11, '1511077', 'SAUSEA Mustard Maestro 245gr', 0.00, 8, 0.00, 0.00),
(838, 11, '1511078', 'SAUSEA Acar Jalapeno Slice (brand) (', 0.00, 8, 0.00, 0.00),
(839, 11, '1511079', 'SAUSEA Acar Jalapeno Slice Saporito', 0.00, 9, 0.00, 0.00),
(840, 11, '1511080', 'SAUSEA Acar Takuan Taro 450gr', 0.00, 20, 0.00, 0.00),
(841, 11, '1511081', 'SAUSEA Terasi Udang Puger 250gr', 0.00, 22, 0.00, 0.00),
(842, 11, '1511082', 'SAUSEA Carbonara Mix Knorr 750gr', 0.00, 21, 0.00, 0.00),
(843, 11, '1511083', 'SAUSEA Tom Yam Paste Knorr 1.5Kg', 0.00, 9, 0.00, 0.00),
(844, 11, '1511084', 'SAUSEA Tomato Paste Metelliana 2.55K', 0.00, 9, 0.00, 0.00),
(845, 11, '1511085', 'SAUSEA Tomato Pronto Knorr  2Kg', 0.00, 9, 0.00, 0.00),
(846, 11, '1511086', 'SAUSEA Tomato Paste Delmonte 170gr', 0.00, 9, 0.00, 0.00),
(847, 12, '1512001', 'HERSP Asam Matang', 0.00, 17, 0.00, 0.00),
(848, 12, '1512002', 'HERSP Asam Mentah', 0.00, 17, 0.00, 0.00),
(849, 12, '1512003', 'HERSP Basil Dried', 0.00, 17, 0.00, 0.00),
(850, 12, '1512004', 'HERSP Basil Dry Jay\'s 20 gr', 0.00, 8, 0.00, 0.00),
(851, 12, '1512005', 'HERSP Basil Fresh', 0.00, 17, 0.00, 0.00),
(852, 12, '1512006', 'HERSP Basil Rubbed & Dry', 0.00, 17, 0.00, 0.00),
(853, 12, '1512007', 'HERSP Bay Dried', 0.00, 17, 0.00, 0.00),
(854, 12, '1512008', 'HERSP Bay Dry Jay\'s 8 gr', 0.00, 8, 0.00, 0.00),
(855, 12, '1512009', 'HERSP Bay Fresh', 0.00, 17, 0.00, 0.00),
(856, 12, '1512010', 'HERSP Biji Teratai', 0.00, 17, 0.00, 0.00),
(857, 12, '1512011', 'HERSP Bubuk Bunga Pekak', 0.00, 17, 0.00, 0.00),
(858, 12, '1512012', 'HERSP Bunga Pekak', 0.00, 17, 0.00, 0.00),
(859, 12, '1512013', 'HERSP Cabai Bubuk', 0.00, 17, 0.00, 0.00),
(860, 12, '1512014', 'HERSP Caper (brand) (berat)', 0.00, 17, 0.00, 0.00),
(861, 12, '1512015', 'HERSP Cengkeh Bubuk', 0.00, 17, 0.00, 0.00),
(862, 12, '1512016', 'HERSP Cengkeh Bubuk (brand) (berat)', 0.00, 8, 0.00, 0.00),
(863, 12, '1512017', 'HERSP Chili Pwdr Ichimi Togarashi (b', 0.00, 20, 0.00, 0.00),
(864, 12, '1512018', 'HERSP Chilli Flakes Jay\'s', 0.00, 8, 0.00, 0.00),
(865, 12, '1512019', 'HERSP Chinese Five Spices Jay\'s 50 g', 0.00, 8, 0.00, 0.00),
(866, 12, '1512020', 'HERSP Curry Powder S&B 400gr', 0.00, 9, 0.00, 0.00),
(867, 12, '1512021', 'HERSP Daun Dill/Adas Sowa', 0.00, 17, 0.00, 0.00),
(868, 12, '1512022', 'HERSP Daun Jeruk', 0.00, 17, 0.00, 0.00),
(869, 12, '1512023', 'HERSP Daun Kari', 0.00, 17, 0.00, 0.00),
(870, 12, '1512024', 'HERSP Daun Kemangi', 0.00, 15, 0.00, 0.00),
(871, 12, '1512025', 'HERSP Daun Kenikir', 0.00, 15, 0.00, 0.00),
(872, 12, '1512026', 'HERSP Daun Ketumbar', 0.00, 17, 0.00, 0.00),
(873, 12, '1512027', 'HERSP Daun Mint', 0.00, 17, 0.00, 0.00),
(874, 12, '1512028', 'HERSP Daun Salam', 0.00, 15, 0.00, 0.00),
(875, 12, '1512029', 'HERSP Dills Whole', 0.00, 22, 0.00, 0.00),
(876, 12, '1512030', 'HERSP Garam Masalah Jay\'s 70 gr', 0.00, 8, 0.00, 0.00),
(877, 12, '1512031', 'HERSP Ginseng Akar', 0.00, 19, 0.00, 0.00),
(878, 12, '1512032', 'HERSP Jahe', 0.00, 17, 0.00, 0.00),
(879, 12, '1512033', 'HERSP Jahe Bubuk Jay\'s Ginger 55gr', 0.00, 17, 0.00, 0.00),
(880, 12, '1512034', 'HERSP Jahe Merah', 0.00, 17, 0.00, 0.00),
(881, 12, '1512035', 'HERSP Jahe Merah Powder', 0.00, 17, 0.00, 0.00),
(882, 12, '1512036', 'HERSP Kencur', 0.00, 17, 0.00, 0.00),
(883, 12, '1512037', 'HERSP Jahe Powder', 0.00, 17, 0.00, 0.00),
(884, 12, '1512038', 'HERSP Jahe Rawit', 0.00, 17, 0.00, 0.00),
(885, 12, '1512039', 'HERSP Japan Ginger Pickle 1Kg', 0.00, 20, 0.00, 0.00),
(886, 12, '1512040', 'HERSP Jinten', 0.00, 17, 0.00, 0.00),
(887, 12, '1512041', 'HERSP Jinten Bubuk Jay\'s Cumin 65gr', 0.00, 8, 0.00, 0.00),
(888, 12, '1512042', 'HERSP Kapulaga', 0.00, 17, 0.00, 0.00),
(889, 12, '1512043', 'HERSP Kapulaga Jay\'s Cardamom 40gr', 0.00, 8, 0.00, 0.00),
(890, 12, '1512044', 'HERSP Kayumanis Bubuk', 0.00, 17, 0.00, 0.00),
(891, 12, '1512045', 'HERSP Kayumanis Bubuk Jay\'s Cinnamon', 0.00, 8, 0.00, 0.00),
(892, 12, '1512046', 'HERSP Keluwak', 0.00, 17, 0.00, 0.00),
(893, 12, '1512047', 'HERSP Kemiri', 0.00, 17, 0.00, 0.00),
(894, 12, '1512048', 'HERSP Kenikir', 0.00, 15, 0.00, 0.00),
(895, 12, '1512049', 'HERSP Ketumbar', 0.00, 17, 0.00, 0.00),
(896, 12, '1512050', 'HERSP Kunci Masak', 0.00, 17, 0.00, 0.00),
(897, 12, '1512051', 'HERSP Kunyit', 0.00, 17, 0.00, 0.00),
(898, 12, '1512052', 'HERSP Kunyit Bubuk Jay\'s Turmeric 55', 0.00, 8, 0.00, 0.00),
(899, 12, '1512053', 'HERSP Kunyit Powder', 0.00, 17, 0.00, 0.00),
(900, 12, '1512054', 'HERSP Lada Hitam Bubuk', 0.00, 17, 0.00, 0.00),
(901, 12, '1512055', 'HERSP Lada Hitam Butir', 0.00, 8, 0.00, 0.00),
(902, 12, '1512056', 'HERSP Lada Putih Bubuk', 0.00, 17, 0.00, 0.00),
(903, 12, '1512057', 'HERSP Lada Putih Butir', 0.00, 17, 0.00, 0.00),
(904, 12, '1512058', 'HERSP Lengkuas', 0.00, 17, 0.00, 0.00),
(905, 12, '1512059', 'HERSP Mustard Ground Jay\'s 50gr', 0.00, 8, 0.00, 0.00),
(906, 12, '1512060', 'HERSP Oregano Chopped', 0.00, 17, 0.00, 0.00),
(907, 12, '1512061', 'HERSP Oregano Dried', 0.00, 17, 0.00, 0.00),
(908, 12, '1512062', 'HERSP Oregano Fresh', 0.00, 17, 0.00, 0.00),
(909, 12, '1512063', 'HERSP Oregano Dry Jay\'s 25gr', 0.00, 8, 0.00, 0.00),
(910, 12, '1512064', 'HERSP Pala Bubuk', 0.00, 17, 0.00, 0.00),
(911, 12, '1512065', 'HERSP Pala Butir', 0.00, 17, 0.00, 0.00),
(912, 12, '1512066', 'HERSP Paprika Powder', 0.00, 17, 0.00, 0.00),
(913, 12, '1512067', 'HERSP Parsley', 0.00, 17, 0.00, 0.00),
(914, 12, '1512068', 'HERSP Rosemary Dried', 0.00, 17, 0.00, 0.00),
(915, 12, '1512069', 'HERSP Rosemary Fresh', 0.00, 17, 0.00, 0.00),
(916, 12, '1512070', 'HERSP Secang', 0.00, 17, 0.00, 0.00),
(917, 12, '1512071', 'HERSP Selasih', 0.00, 17, 0.00, 0.00),
(918, 12, '1512072', 'HERSP Seledri', 0.00, 17, 0.00, 0.00),
(919, 12, '1512073', 'HERSP Sereh', 0.00, 17, 0.00, 0.00),
(920, 12, '1512074', 'HERSP Tarragon Dry Jay\'s 20gr', 0.00, 8, 0.00, 0.00),
(921, 12, '1512075', 'HERSP Thyme Dried/Kering', 0.00, 17, 0.00, 0.00),
(922, 12, '1512076', 'HERSP Thyme Dry Jay\'s 27gr', 0.00, 8, 0.00, 0.00),
(923, 12, '1512077', 'HERSP Thyme Fresh', 0.00, 22, 0.00, 0.00),
(924, 12, '1512078', 'HERSP Wasabi Powder (brand) 1 Kg', 0.00, 20, 0.00, 0.00),
(925, 13, '1513001', 'P&N Mie Telor Atom Bulan 200gr', 0.00, 22, 0.00, 0.00),
(926, 13, '1513002', 'P&N Kwetiau Bahagia Kering 150gr', 0.00, 20, 0.00, 0.00),
(927, 13, '1513003', 'P&N Kwetiau FYF Kering 220gr', 0.00, 20, 0.00, 0.00),
(928, 13, '1513004', 'P&N Super Bihun AAA 450gr', 0.00, 20, 0.00, 0.00),
(929, 13, '1513005', 'P&N Soun RRT', 0.00, 22, 0.00, 0.00),
(930, 13, '1513006', 'P&N Mie Kuning Basah', 0.00, 17, 0.00, 0.00),
(931, 13, '1513007', 'P&N Misoa (brand) (berat)', 0.00, 20, 0.00, 0.00),
(932, 13, '1513008', 'P&N Spaghetti San Remo 500gr', 0.00, 20, 0.00, 0.00),
(933, 13, '1513009', 'P&N Fettucini San Remo 500gr', 0.00, 20, 0.00, 0.00),
(934, 13, '1513010', 'P&N Penne Rigatte San Remo 500gr', 0.00, 20, 0.00, 0.00),
(935, 13, '1513011', 'P&N Fusilli San Remo 500gr', 0.00, 20, 0.00, 0.00),
(936, 13, '1513012', 'P&N Spaghetti La Fonte 500gr', 0.00, 20, 0.00, 0.00),
(937, 13, '1513013', 'P&N Fettucini La Fonte 500gr', 0.00, 20, 0.00, 0.00),
(938, 13, '1513014', 'P&N Penne Rigatte La Fonte 500gr', 0.00, 20, 0.00, 0.00),
(939, 13, '1513015', 'P&N Fusilli La Fonte 500gr', 0.00, 20, 0.00, 0.00),
(940, 13, '1513016', 'P&N Lasagna Lafonte230gr', 0.00, 20, 0.00, 0.00),
(941, 13, '1513017', 'P&N Japan Udon (brand) 200gr', 0.00, 20, 0.00, 0.00),
(942, 13, '1513018', 'P&N Ramen Noodle (brand)(berat)', 0.00, 20, 0.00, 0.00),
(943, 13, '1513019', 'P&N Makaroniku 200gr', 0.00, 20, 0.00, 0.00),
(944, 13, '1513020', 'P&N Maccaroni', 0.00, 17, 0.00, 0.00),
(945, 13, '1513021', 'P&N Mie Instant Sedap Kari Ayam', 0.00, 22, 0.00, 0.00),
(946, 13, '1513022', 'P&N Mie Instant Sedap Goreng', 0.00, 22, 0.00, 0.00),
(947, 14, '1514001', 'RF Beras Angkak', 0.00, 20, 0.00, 0.00),
(948, 14, '1514002', 'RF Beras Basmati', 0.00, 17, 0.00, 0.00),
(949, 14, '1514003', 'RF Beras Guci 25 Kg', 0.00, 17, 0.00, 0.00),
(950, 14, '1514004', 'RF Beras Italia Carnaroli (berat)', 0.00, 20, 0.00, 0.00),
(951, 14, '1514005', 'RF Beras Jagung', 0.00, 17, 0.00, 0.00),
(952, 14, '1514006', 'RF Beras Ketan Hitam', 0.00, 17, 0.00, 0.00),
(953, 14, '1514007', 'RF Beras Ketan Putih', 0.00, 17, 0.00, 0.00),
(954, 14, '1514008', 'RF Beras Rosita 25 Kg', 0.00, 17, 0.00, 0.00),
(955, 14, '1514009', 'RF Beras Teratai 25 Kg', 0.00, 17, 0.00, 0.00),
(956, 14, '1514010', 'RF Hungkwe Kura kura Mahkota Putih', 0.00, 20, 0.00, 0.00),
(957, 14, '1514011', 'RF Japan Kokuho Rice 6.8 Kg', 0.00, 20, 0.00, 0.00),
(958, 14, '1514012', 'RF Japan Sasanishiki Rice 10 Kg', 0.00, 17, 0.00, 0.00),
(959, 14, '1514013', 'RF Tepung  Pao Blue Key 1 Kg', 0.00, 20, 0.00, 0.00),
(960, 14, '1514014', 'RF Tepung Beras Rosebrand 500gr', 0.00, 20, 0.00, 0.00),
(961, 14, '1514015', 'RF Tepung Cakra Kembar 25 Kg', 0.00, 17, 0.00, 0.00),
(962, 14, '1514016', 'RF Tepung Cepat Saji Chesa 200gr', 0.00, 20, 0.00, 0.00),
(963, 14, '1514017', 'RF Tepung Gandum Capitol Mill Whole', 0.00, 1, 0.00, 0.00),
(964, 14, '1514018', 'RF Tepung Jagung', 0.00, 17, 0.00, 0.00),
(965, 14, '1514019', 'RF Tepung Ketan Putih Rosebrand 500g', 0.00, 20, 0.00, 0.00),
(966, 14, '1514020', 'RF Tepung Maizena Maizenaku 300gr', 0.00, 20, 0.00, 0.00),
(967, 14, '1514021', 'RF Tepung Maizena Maizenaku 750gr', 0.00, 20, 0.00, 0.00),
(968, 14, '1514022', 'RF Tepung Roti Putih', 0.00, 17, 0.00, 0.00),
(969, 14, '1514023', 'RF Tepung Roti Putih Primera Panko', 0.00, 17, 0.00, 0.00),
(970, 14, '1514024', 'RF Tepung Sagu', 0.00, 17, 0.00, 0.00),
(971, 14, '1514025', 'RF Tepung Sagu Tani', 0.00, 17, 0.00, 0.00),
(972, 14, '1514026', 'RF Tepung Sang Fen/Potato Starch', 0.00, 17, 0.00, 0.00),
(973, 14, '1514027', 'RF Tepung Segitiga Biru 25 Kg', 0.00, 17, 0.00, 0.00),
(974, 14, '1514028', 'RF Tepung Tang Mien/Wheat Starch', 0.00, 17, 0.00, 0.00),
(975, 14, '1514029', 'RF Tepung Tapioka Gunung Agung 500gr', 0.00, 20, 0.00, 0.00),
(976, 14, '1514030', 'RF Tepung Tempura Nissin 600gr', 0.00, 20, 0.00, 0.00),
(977, 15, '1515001', 'INDO Arem Arem', 0.00, 22, 0.00, 0.00),
(978, 15, '1515002', 'INDO Bakpao', 0.00, 22, 0.00, 0.00),
(979, 15, '1515003', 'INDO Bakpia', 0.00, 20, 0.00, 0.00),
(980, 15, '1515004', 'INDO Bidaran', 0.00, 22, 0.00, 0.00),
(981, 15, '1515005', 'INDO Blackforest', 0.00, 22, 0.00, 0.00),
(982, 15, '1515006', 'INDO Botok Jendil', 0.00, 22, 0.00, 0.00),
(983, 15, '1515007', 'INDO Botok Mlandingan', 0.00, 22, 0.00, 0.00),
(984, 15, '1515008', 'INDO Brownies', 0.00, 22, 0.00, 0.00),
(985, 15, '1515009', 'INDO Bubur', 0.00, 22, 0.00, 0.00),
(986, 15, '1515010', 'INDO Cakue', 0.00, 22, 0.00, 0.00),
(987, 15, '1515011', 'INDO Carrot Cake', 0.00, 22, 0.00, 0.00),
(988, 15, '1515012', 'INDO Cheese Cake', 0.00, 22, 0.00, 0.00),
(989, 15, '1515013', 'INDO Dadar Gulung', 0.00, 22, 0.00, 0.00),
(990, 15, '1515014', 'INDO Donat', 0.00, 22, 0.00, 0.00),
(991, 15, '1515015', 'INDO Gethuk', 0.00, 22, 0.00, 0.00),
(992, 15, '1515016', 'INDO Gethuk Lindri', 0.00, 22, 0.00, 0.00),
(993, 15, '1515017', 'INDO Jadah', 0.00, 22, 0.00, 0.00),
(994, 15, '1515018', 'INDO Jajan Pasar', 0.00, 22, 0.00, 0.00),
(995, 15, '1515019', 'INDO Jajan Pasar Mini', 0.00, 22, 0.00, 0.00),
(996, 15, '1515020', 'INDO Jembret', 0.00, 22, 0.00, 0.00),
(997, 15, '1515021', 'INDO Kacang Kulit Rebus', 0.00, 17, 0.00, 0.00),
(998, 15, '1515022', 'INDO Ketupat', 0.00, 22, 0.00, 0.00),
(999, 15, '1515023', 'INDO Klepon', 0.00, 22, 0.00, 0.00),
(1000, 15, '1515024', 'INDO Kroket', 0.00, 22, 0.00, 0.00),
(1001, 15, '1515025', 'INDO Kue Cake Keju', 0.00, 22, 0.00, 0.00),
(1002, 15, '1515026', 'INDO Kue Cantik Manis', 0.00, 22, 0.00, 0.00),
(1003, 15, '1515027', 'INDO Kue Coklat', 0.00, 22, 0.00, 0.00),
(1004, 15, '1515028', 'INDO Kue Donat Chicken', 0.00, 22, 0.00, 0.00),
(1005, 15, '1515029', 'INDO Kue Gulung Mawar', 0.00, 22, 0.00, 0.00),
(1006, 15, '1515030', 'INDO Kue Jari', 0.00, 22, 0.00, 0.00),
(1007, 15, '1515031', 'INDO Kue Jipang', 0.00, 17, 0.00, 0.00),
(1008, 15, '1515032', 'INDO Kue Karamel', 0.00, 22, 0.00, 0.00),
(1009, 15, '1515033', 'INDO Kue Keranjang', 0.00, 22, 0.00, 0.00),
(1010, 15, '1515034', 'INDO Bolu Kukus', 0.00, 22, 0.00, 0.00),
(1011, 15, '1515035', 'INDO Kue Lapindo', 0.00, 22, 0.00, 0.00),
(1012, 15, '1515036', 'INDO Kue Lapis', 0.00, 22, 0.00, 0.00),
(1013, 15, '1515037', 'INDO Kue Lumpur', 0.00, 22, 0.00, 0.00),
(1014, 15, '1515038', 'INDO Kue Martabak', 0.00, 22, 0.00, 0.00),
(1015, 15, '1515039', 'INDO Kue Mini Roll', 0.00, 22, 0.00, 0.00),
(1016, 15, '1515040', 'INDO Kue Mocci', 0.00, 22, 0.00, 0.00),
(1017, 15, '1515041', 'INDO Kue Molen', 0.00, 22, 0.00, 0.00),
(1018, 15, '1515042', 'INDO Kue Pie Buah', 0.00, 22, 0.00, 0.00),
(1019, 15, '1515043', 'INDO Kue Putu Ayu', 0.00, 22, 0.00, 0.00),
(1020, 15, '1515044', 'INDO Kue Sosis Solo', 0.00, 22, 0.00, 0.00),
(1021, 15, '1515045', 'INDO Kue Sus', 0.00, 22, 0.00, 0.00),
(1022, 15, '1515046', 'INDO Kue Teratai', 0.00, 22, 0.00, 0.00),
(1023, 15, '1515047', 'INDO Kue Zebra', 0.00, 22, 0.00, 0.00),
(1024, 15, '1515048', 'INDO Lemper', 0.00, 22, 0.00, 0.00),
(1025, 15, '1515049', 'INDO Lontong', 0.00, 22, 0.00, 0.00),
(1026, 15, '1515050', 'INDO Lumpia', 0.00, 22, 0.00, 0.00),
(1027, 15, '1515051', 'INDO Lumpia Basah', 0.00, 22, 0.00, 0.00),
(1028, 15, '1515052', 'INDO Nagasari', 0.00, 22, 0.00, 0.00),
(1029, 15, '1515053', 'INDO Onde Onde', 0.00, 22, 0.00, 0.00),
(1030, 15, '1515054', 'INDO Pangsit Basah Bakwan', 0.00, 22, 0.00, 0.00),
(1031, 15, '1515055', 'INDO Pangsit Goreng Bakwan', 0.00, 22, 0.00, 0.00),
(1032, 15, '1515056', 'INDO Pastel', 0.00, 22, 0.00, 0.00),
(1033, 15, '1515057', 'INDO Pedho Godong Lumbu', 0.00, 22, 0.00, 0.00),
(1034, 15, '1515058', 'INDO Pempek Adaan', 0.00, 22, 0.00, 0.00),
(1035, 15, '1515059', 'INDO Pempek Kapal Selam Besar', 0.00, 22, 0.00, 0.00),
(1036, 15, '1515060', 'INDO Pempek Kapal Selam Sedang', 0.00, 22, 0.00, 0.00),
(1037, 15, '1515061', 'INDO Pempek Keju', 0.00, 22, 0.00, 0.00),
(1038, 15, '1515062', 'INDO Pempek Kulit', 0.00, 22, 0.00, 0.00),
(1039, 15, '1515063', 'INDO Pempek Lenjer Besar', 0.00, 22, 0.00, 0.00),
(1040, 15, '1515064', 'INDO Pempek Lenjer Sedang', 0.00, 22, 0.00, 0.00),
(1041, 15, '1515065', 'INDO Pempek Sosis', 0.00, 22, 0.00, 0.00),
(1042, 15, '1515066', 'INDO Pempek Tahu', 0.00, 22, 0.00, 0.00),
(1043, 15, '1515067', 'INDO Pie Basah', 0.00, 22, 0.00, 0.00),
(1044, 15, '1515068', 'INDO Pisang Keju', 0.00, 22, 0.00, 0.00),
(1045, 15, '1515069', 'INDO Rempeyek Kacang', 0.00, 20, 0.00, 0.00),
(1046, 15, '1515070', 'INDO Rempeyek Kedelai', 0.00, 20, 0.00, 0.00),
(1047, 15, '1515071', 'INDO Rempeyek Teri', 0.00, 20, 0.00, 0.00),
(1048, 15, '1515072', 'INDO Risoles', 0.00, 22, 0.00, 0.00),
(1049, 15, '1515073', 'INDO Roll Tart', 0.00, 22, 0.00, 0.00),
(1050, 15, '1515074', 'INDO Roti Canai 10 sheets', 0.00, 20, 0.00, 0.00),
(1051, 15, '1515075', 'INDO Roti Rasa', 0.00, 22, 0.00, 0.00),
(1052, 15, '1515076', 'INDO Serabi', 0.00, 22, 0.00, 0.00),
(1053, 15, '1515077', 'INDO Serabi Ketan', 0.00, 22, 0.00, 0.00),
(1054, 15, '1515078', 'INDO Siomay Bandung', 0.00, 22, 0.00, 0.00),
(1055, 15, '1515079', 'INDO Siomay Goreng', 0.00, 22, 0.00, 0.00),
(1056, 15, '1515080', 'INDO Spiku', 0.00, 22, 0.00, 0.00),
(1057, 15, '1515081', 'INDO Stik Balado', 0.00, 22, 0.00, 0.00),
(1058, 15, '1515082', 'INDO Tahu Bakso Bakwan', 0.00, 22, 0.00, 0.00),
(1059, 15, '1515083', 'INDO Tahu Fantasi', 0.00, 22, 0.00, 0.00),
(1060, 15, '1515084', 'INDO Tahu Isi', 0.00, 22, 0.00, 0.00),
(1061, 15, '1515085', 'INDO Tahu Matang', 0.00, 22, 0.00, 0.00),
(1062, 15, '1515086', 'INDO Tape Ketan', 0.00, 20, 0.00, 0.00),
(1063, 15, '1515087', 'INDO Tape Ketan Hijau', 0.00, 17, 0.00, 0.00),
(1064, 15, '1515088', 'INDO Tape Singkong', 0.00, 17, 0.00, 0.00),
(1065, 15, '1515089', 'INDO Tiramisu', 0.00, 22, 0.00, 0.00),
(1066, 15, '1515090', 'INDO Tiwul', 0.00, 22, 0.00, 0.00),
(1067, 15, '1515091', 'INDO Wingko', 0.00, 22, 0.00, 0.00),
(1068, 16, '2601001', 'MW Mineral Water Cleo 550 ml w/logo', 0.00, 8, 0.00, 0.00),
(1069, 16, '2601002', 'MW Mineral Water Cleo 330 ml w/logo', 0.00, 8, 0.00, 0.00),
(1070, 16, '2601003', 'MW Mineral Water Cleo 1500 ml w/logo', 0.00, 8, 0.00, 0.00),
(1071, 16, '2601004', 'MW Mineral Water Cleo Galon', 0.00, 14, 0.00, 0.00),
(1072, 16, '2601005', 'MW Mineral Water Cleo Gelas 240 ml', 0.00, 12, 0.00, 0.00),
(1073, 16, '2601006', 'MW Mineral Water Equil Sparkling 380', 0.00, 8, 0.00, 0.00),
(1074, 16, '2601007', 'MW Mineral Water Equil Natural 380 m', 0.00, 8, 0.00, 0.00),
(1075, 16, '2601008', 'MW Mineral Water Nestle 330ml', 0.00, 8, 0.00, 0.00),
(1076, 16, '2601009', 'MW Mineral Water Cleo 550 ml w/o log', 0.00, 8, 0.00, 0.00),
(1077, 16, '2601010', 'MW Mineral Water Cleo 330 ml w/o log', 0.00, 8, 0.00, 0.00),
(1078, 16, '2601011', 'MW Mineral Water Cleo 1500 ml w/o lo', 0.00, 8, 0.00, 0.00),
(1079, 17, '2602001', 'ALCO Beer Bintang Can 330ml', 0.00, 9, 0.00, 0.00),
(1080, 17, '2602002', 'ALCO Beer Bintang Bottle 330ml', 0.00, 8, 0.00, 0.00),
(1081, 17, '2602003', 'ALCO Beer Heineken Can 330ml', 0.00, 9, 0.00, 0.00),
(1082, 17, '2602004', 'ALCO Draught Beer Heineken 20L', 0.00, 3, 0.00, 0.00),
(1083, 17, '2602005', 'ALCO Beer Guinness Can 330ml', 0.00, 9, 0.00, 0.00),
(1084, 17, '2602006', 'ALCO Beer Heineken Bottle 640 ml', 0.00, 8, 0.00, 0.00),
(1085, 17, '2602007', 'ALCO Beer Heineken Bottle 330 ml', 0.00, 8, 0.00, 0.00),
(1086, 17, '2602008', 'ALCO Beer Bali Hai Premium Can 330 m', 0.00, 9, 0.00, 0.00),
(1087, 17, '2602009', 'ALCO Liqueur Cointreau 700ml', 0.00, 8, 0.00, 0.00),
(1088, 17, '2602010', 'ALCO Liqueur Kahlua 700ml', 0.00, 8, 0.00, 0.00),
(1089, 17, '2602011', 'ALCO Liqueur Amaretto Disarono 700 m', 0.00, 8, 0.00, 0.00),
(1090, 17, '2602012', 'ALCO Liqueur Sambuca Vaccari 700 ml', 0.00, 8, 0.00, 0.00),
(1091, 17, '2602013', 'ALCO Liqueur Benedictine Dom 750ml', 0.00, 8, 0.00, 0.00),
(1092, 17, '2602014', 'ALCO Liqueur Midori 700ml', 0.00, 8, 0.00, 0.00),
(1093, 17, '2602015', 'ALCO Liqueur Bols Triple Sec 700ml', 0.00, 8, 0.00, 0.00),
(1094, 17, '2602016', 'ALCO Liqueur Cherry Brandy 700ml', 0.00, 8, 0.00, 0.00),
(1095, 17, '2602017', 'ALCO Cognac Martell VSOP @ 700 ml', 0.00, 8, 0.00, 0.00),
(1096, 17, '2602018', 'ALCO Tequila Jose Cuervo 750ml', 0.00, 8, 0.00, 0.00),
(1097, 17, '2602019', 'ALCO Rum Myer\'s Rum 750ml', 0.00, 8, 0.00, 0.00),
(1098, 17, '2602020', 'ALCO Rum Captain Morgan 750ml', 0.00, 8, 0.00, 0.00),
(1099, 17, '2602021', 'ALCO Whisky Chivas Regal 12 Years 75', 0.00, 8, 0.00, 0.00),
(1100, 17, '2602022', 'ALCO Whisky Black Label 750 ml', 0.00, 8, 0.00, 0.00),
(1101, 17, '2602023', 'ALCO Whisky Jack Daniel\'s 700ml', 0.00, 8, 0.00, 0.00),
(1102, 17, '2602024', 'ALCO Whisky Glen Fiddich 700ml', 0.00, 8, 0.00, 0.00),
(1103, 17, '2602025', 'ALCO Whisky Jim Beam 750ml', 0.00, 8, 0.00, 0.00),
(1104, 17, '2602026', 'ALCO Whisky Canadian Club 750ml', 0.00, 8, 0.00, 0.00),
(1105, 17, '2602027', 'ALCO Whisky Old Bushmill 700ml', 0.00, 8, 0.00, 0.00),
(1106, 17, '2602028', 'ALCO Whisky Red Label 750ml', 0.00, 8, 0.00, 0.00),
(1107, 17, '2602029', 'ALCO Whisky Jameson 700ml', 0.00, 8, 0.00, 0.00),
(1108, 17, '2602030', 'ALCO Vodka Absolut Vodka Blue 750ml', 0.00, 8, 0.00, 0.00),
(1109, 17, '2602031', 'ALCO Wine Two Ocean Cab. Sav. Merlot', 0.00, 8, 0.00, 0.00),
(1110, 17, '2602032', 'ALCO Wine Ocean Sauvignon Blanc WW', 0.00, 8, 0.00, 0.00),
(1111, 17, '2602033', 'ALCO Wine Ocean Shiraz RW', 0.00, 8, 0.00, 0.00),
(1112, 17, '2602034', 'ALCO Wine Concha y Toro Front. Cab.', 0.00, 8, 0.00, 0.00),
(1113, 17, '2602035', 'ALCO Wine Concha y Toro Front. Merlo', 0.00, 8, 0.00, 0.00),
(1114, 17, '2602036', 'ALCO J&W Sparkling Red Cocktail 750m', 0.00, 8, 0.00, 0.00),
(1115, 18, '2603001', 'SD Coca Cola Btl 250ml', 0.00, 8, 0.00, 0.00),
(1116, 18, '2603002', 'SD Coca Cola Btl 425ml', 0.00, 8, 0.00, 0.00),
(1117, 18, '2603003', 'SD Coca Cola Btl 1.5L', 0.00, 8, 0.00, 0.00),
(1118, 18, '2603004', 'SD Coca Cola Can 250 ml', 0.00, 9, 0.00, 0.00),
(1119, 18, '2603005', 'SD Coca Cola Can 330 ml', 0.00, 9, 0.00, 0.00),
(1120, 18, '2603006', 'SD Diet Coke Can 330 ml', 0.00, 9, 0.00, 0.00),
(1121, 18, '2603007', 'SD Fanta Strwbry Btl 250ml', 0.00, 8, 0.00, 0.00),
(1122, 18, '2603008', 'SD Fanta Strwbry Btl 425ml', 0.00, 8, 0.00, 0.00),
(1123, 18, '2603009', 'SD Fanta Strwbry Btl 1.5L', 0.00, 8, 0.00, 0.00),
(1124, 18, '2603010', 'SD Fanta Strwbry Can 250 ml', 0.00, 9, 0.00, 0.00),
(1125, 18, '2603011', 'SD Fanta Strwbry Can 330 ml', 0.00, 9, 0.00, 0.00),
(1126, 18, '2603012', 'SD Fanta Orange Btl 250ml', 0.00, 8, 0.00, 0.00),
(1127, 18, '2603013', 'SD Fanta Orange Btl 425ml', 0.00, 8, 0.00, 0.00),
(1128, 18, '2603014', 'SD Fanta Orange Btl 1.5L', 0.00, 8, 0.00, 0.00),
(1129, 18, '2603015', 'SD Fanta Orange Can 250 ml', 0.00, 9, 0.00, 0.00),
(1130, 18, '2603016', 'SD Fanta Orange Can 330 ml', 0.00, 9, 0.00, 0.00),
(1131, 18, '2603017', 'SD Sprite Btl 250ml', 0.00, 8, 0.00, 0.00),
(1132, 18, '2603018', 'SD Sprite Btl 425ml', 0.00, 8, 0.00, 0.00),
(1133, 18, '2603019', 'SD Sprite Btl 1.5L', 0.00, 8, 0.00, 0.00),
(1134, 18, '2603020', 'SD Sprite Can 250 ml', 0.00, 9, 0.00, 0.00),
(1135, 18, '2603021', 'SD Sprite Can 330 ml', 0.00, 9, 0.00, 0.00),
(1136, 18, '2603022', 'SD Pepsi Blue 450ml', 0.00, 8, 0.00, 0.00),
(1137, 18, '2603023', 'SD Pepsi Blue 1.5L', 0.00, 8, 0.00, 0.00),
(1138, 18, '2603024', 'SD Pocari Sweat Btl 350 ml', 0.00, 8, 0.00, 0.00),
(1139, 18, '2603025', 'SD Pocari Sweat Btl 500 ml', 0.00, 8, 0.00, 0.00),
(1140, 18, '2603026', 'SD Pocari Sweat Can 330 ml', 0.00, 9, 0.00, 0.00),
(1141, 18, '2603027', 'SD Orange Water You C-1000  500ml', 0.00, 8, 0.00, 0.00),
(1142, 18, '2603028', 'SD Lemon Water You C-1000  500ml', 0.00, 8, 0.00, 0.00),
(1143, 18, '2603029', 'SD Vitamin Orange You C-1000  140ml', 0.00, 8, 0.00, 0.00),
(1144, 18, '2603030', 'SD Vitamin Lemon You C-1000  140ml', 0.00, 8, 0.00, 0.00),
(1145, 18, '2603031', 'SD Orange Juice Sunkist 300ml', 0.00, 9, 0.00, 0.00),
(1146, 18, '2603032', 'SD Tonic Water Schweppes 330ml', 0.00, 9, 0.00, 0.00),
(1147, 18, '2603033', 'SD Soda Water Schweppes 330ml', 0.00, 9, 0.00, 0.00),
(1148, 18, '2603034', 'SD Ginger Ale Schweppes 330ml', 0.00, 9, 0.00, 0.00),
(1149, 18, '2603035', 'SD Nutrisari Orange Sachet 14gr', 0.00, 22, 0.00, 0.00),
(1150, 18, '2603036', 'SD Segar Dingin Sachet 7gr', 0.00, 22, 0.00, 0.00),
(1151, 18, '2603037', 'SD Jas Jus Sachet 8gr', 0.00, 22, 0.00, 0.00),
(1152, 18, '2603038', 'SD Milk Jus Sachet 25gr', 0.00, 22, 0.00, 0.00),
(1153, 18, '2603039', 'SD Tea Jus Sachet 8 gr', 0.00, 22, 0.00, 0.00),
(1154, 18, '2603040', 'SD Orange Pouch Nestle 560gr', 0.00, 20, 0.00, 0.00),
(1155, 18, '2603041', 'SD Lemon Tea Nestea 1 Kg', 0.00, 20, 0.00, 0.00),
(1156, 18, '2603042', 'SD Capuccino Nescafe 500gr', 0.00, 20, 0.00, 0.00),
(1157, 18, '2603043', 'SD Dark Cocoa Nestle 1 Kg', 0.00, 20, 0.00, 0.00),
(1158, 18, '2603044', 'SD Kopi ABC Sachet', 0.00, 22, 0.00, 0.00),
(1159, 18, '2603045', 'SD Luwak White Koffie Sachet', 0.00, 22, 0.00, 0.00),
(1160, 18, '2603046', 'SD Kopi TOP Sachet', 0.00, 22, 0.00, 0.00),
(1161, 18, '2603047', 'SD Coklat Bubuk  Milo 18 gr', 0.00, 22, 0.00, 0.00),
(1162, 18, '2603048', 'SD Nutrisari W\'dank Jahe 175gr', 0.00, 20, 0.00, 0.00),
(1163, 19, '2604001', 'JUICE Apple Toza RTD 5L', 0.00, 14, 0.00, 0.00),
(1164, 19, '2604002', 'JUICE Grape Toza RTD 5L', 0.00, 14, 0.00, 0.00),
(1165, 19, '2604003', 'JUICE Guava Toza RTD 5L', 0.00, 14, 0.00, 0.00),
(1166, 19, '2604004', 'JUICE Mango Toza RTD 5L', 0.00, 14, 0.00, 0.00),
(1167, 19, '2604005', 'JUICE Orange Toza RTD 5L', 0.00, 14, 0.00, 0.00),
(1168, 19, '2604006', 'JUICE Pineapple Toza RTD 5L', 0.00, 14, 0.00, 0.00),
(1169, 19, '2604007', 'JUICE Soursoup Toza RTD 5L', 0.00, 14, 0.00, 0.00),
(1170, 19, '2604008', 'JUICE Starfruit Toza RTD 5L', 0.00, 14, 0.00, 0.00),
(1171, 19, '2604009', 'JUICE Cranberry (brand) (vol)', 0.00, 22, 0.00, 0.00),
(1172, 19, '2604010', 'JUICE Orange Sun Quick 2L', 0.00, 8, 0.00, 0.00),
(1173, 19, '2604011', 'JUICE Apple Toza Concentrate 5L', 0.00, 14, 0.00, 0.00),
(1174, 19, '2604012', 'JUICE Grape Toza Concentrate 5L', 0.00, 14, 0.00, 0.00),
(1175, 19, '2604013', 'JUICE Guava Toza Concentrate 5L', 0.00, 14, 0.00, 0.00),
(1176, 19, '2604014', 'JUICE Mango Toza Concentrate 5L', 0.00, 14, 0.00, 0.00),
(1177, 19, '2604015', 'JUICE Orange Toza Concentrate 5L', 0.00, 14, 0.00, 0.00),
(1178, 19, '2604016', 'JUICE Pineapple Toza Concentrate 5L', 0.00, 14, 0.00, 0.00),
(1179, 19, '2604017', 'JUICE Soursoup Toza Concentrate 5L', 0.00, 14, 0.00, 0.00),
(1180, 19, '2604018', 'JUICE Starfruit Toza Concentrate 5L', 0.00, 14, 0.00, 0.00),
(1181, 19, '2604019', 'JUICE Apple Toza Concentrate 1L', 0.00, 8, 0.00, 0.00),
(1182, 19, '2604020', 'JUICE Grape Toza Concentrate 1L', 0.00, 8, 0.00, 0.00),
(1183, 19, '2604021', 'JUICE Guava Toza Concentrate 1L', 0.00, 8, 0.00, 0.00),
(1184, 19, '2604022', 'JUICE Lemon Toza Concentrate 1L', 0.00, 8, 0.00, 0.00),
(1185, 19, '2604023', 'JUICE Mango Toza Concentrate 1L', 0.00, 8, 0.00, 0.00),
(1186, 19, '2604024', 'JUICE Orange Toza Concentrate 1L', 0.00, 8, 0.00, 0.00),
(1187, 19, '2604025', 'JUICE Pineapple Toza Concentrate 1L', 0.00, 8, 0.00, 0.00),
(1188, 19, '2604026', 'JUICE Soursoup Toza Concentrate 1L', 0.00, 8, 0.00, 0.00),
(1189, 19, '2604027', 'JUICE Starfruit Toza Concentrate 1L', 0.00, 8, 0.00, 0.00),
(1190, 19, '2604028', 'JUICE Strawberry Toza Concentrate 1L', 0.00, 8, 0.00, 0.00),
(1191, 20, '2605001', 'SYRP Maple Green\'s 375gr', 0.00, 8, 0.00, 0.00),
(1192, 20, '2605002', 'SYRP Blue Curacao Monin 700ml', 0.00, 8, 0.00, 0.00),
(1193, 20, '2605003', 'SYRP Green Mint Monin 700ml', 0.00, 8, 0.00, 0.00),
(1194, 20, '2605004', 'SYRP Grenadine Monin 700ml', 0.00, 8, 0.00, 0.00),
(1195, 20, '2605005', 'SYRP Raspberry Monin 700ml', 0.00, 8, 0.00, 0.00),
(1196, 20, '2605006', 'SYRP Blueberry Mixtura Liquid 2.1 Kg', 0.00, 16, 0.00, 0.00),
(1197, 20, '2605007', 'SYRP Ginger Mixtura Liquid 2.1 Kg', 0.00, 16, 0.00, 0.00),
(1198, 20, '2605008', 'SYRP Mint Mixtura Liquid 2.1 Kg', 0.00, 16, 0.00, 0.00),
(1199, 20, '2605009', 'SYRP Raspberry Mixtura Liquid 2.1 Kg', 0.00, 16, 0.00, 0.00),
(1200, 20, '2605010', 'SYRP Red Apple Mixtura Liquid 2.1 Kg', 0.00, 16, 0.00, 0.00),
(1201, 20, '2605011', 'SYRP Strawberry Mixtura Liquid 2.1 K', 0.00, 16, 0.00, 0.00),
(1202, 20, '2605012', 'SYRP Cinamon Mixtura Powder 1 Kg', 0.00, 20, 0.00, 0.00),
(1203, 20, '2605013', 'SYRP Green Tea Mixtura Powder 1 Kg', 0.00, 20, 0.00, 0.00),
(1204, 20, '2605014', 'SYRP Chocolate Mixtura Powder 1 Kg', 0.00, 20, 0.00, 0.00),
(1205, 20, '2605015', 'SYRP Cocopandan Marjan 450ml', 0.00, 8, 0.00, 0.00),
(1206, 20, '2605016', 'SYRP Leci Marjan 450ml', 0.00, 8, 0.00, 0.00),
(1207, 20, '2605017', 'SYRP Melon Marjan 450ml', 0.00, 8, 0.00, 0.00),
(1208, 20, '2605018', 'SYRP Mocca Marjan 450ml', 0.00, 8, 0.00, 0.00),
(1209, 20, '2605019', 'SYRP Strawberry Marjan 450ml', 0.00, 8, 0.00, 0.00),
(1210, 20, '2605020', 'SYRP Vanilla Marjan 450ml', 0.00, 8, 0.00, 0.00),
(1211, 20, '2605021', 'SYRP Grenadine Marjan 450ml', 0.00, 8, 0.00, 0.00),
(1212, 20, '2605022', 'SYRP Leci ABC 525ml', 0.00, 8, 0.00, 0.00),
(1213, 20, '2605023', 'SYRP Sirsak ABC 525ml', 0.00, 8, 0.00, 0.00),
(1214, 20, '2605024', 'SYRP Frappe Red Velvet Toffin Pwdr 8', 0.00, 20, 0.00, 0.00),
(1215, 20, '2605025', 'SYRP Blueberry Fountain Toffin Pwdr', 0.00, 20, 0.00, 0.00),
(1216, 20, '2605026', 'SYRP Bubble Gum Toffin Pwdr 800gr', 0.00, 20, 0.00, 0.00),
(1217, 20, '2605027', 'SYRP Green Tea Toffin 1 Kg', 0.00, 20, 0.00, 0.00),
(1218, 21, '2606001', 'LOCD Jamu Asem', 0.00, 8, 0.00, 0.00),
(1219, 21, '2606002', 'LOCD Jamu Beras Kencur', 0.00, 8, 0.00, 0.00),
(1220, 21, '2606003', 'LOCD Jamu Brotowali-Irengan', 0.00, 8, 0.00, 0.00),
(1221, 21, '2606004', 'LOCD Jamu Cabe Puyang', 0.00, 8, 0.00, 0.00),
(1222, 21, '2606005', 'LOCD Jamu Kunci Suruh', 0.00, 8, 0.00, 0.00),
(1223, 21, '2606006', 'LOCD Jamu Kunir Asem', 0.00, 8, 0.00, 0.00),
(1224, 21, '2606007', 'LOCD Jamu Kunyit Asam', 0.00, 8, 0.00, 0.00),
(1225, 21, '2606008', 'LOCD Jamu Sinom', 0.00, 8, 0.00, 0.00),
(1226, 21, '2606009', 'LOCD Minuman STMJ Sachet', 0.00, 22, 0.00, 0.00),
(1227, 21, '2606010', 'LOCD Wedang Jenggelek', 0.00, 22, 0.00, 0.00),
(1228, 21, '2606011', 'LOCD Wedang Purwoceng', 0.00, 22, 0.00, 0.00),
(1229, 21, '2606012', 'LOCD Wedang Secang', 0.00, 22, 0.00, 0.00),
(1230, 21, '2606013', 'LOCD Wedang Wuh', 0.00, 22, 0.00, 0.00),
(1231, 2, '1502042', 'POULT Chicken Nugget Champ 1Kg', 0.00, 20, 0.00, 0.00);

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
(1, 'Bag'),
(2, 'Biji'),
(3, 'Barel'),
(4, 'Bks'),
(5, 'Block'),
(6, 'Box'),
(7, 'Btg'),
(8, 'Btl'),
(9, 'Can'),
(10, 'Crtn'),
(11, 'Ctn'),
(12, 'Cup'),
(13, 'Ekor'),
(14, 'Gln'),
(15, 'Ikat'),
(16, 'Jar'),
(17, 'Kg'),
(18, 'Loaf'),
(19, 'Ons'),
(20, 'Pack'),
(21, 'Pail'),
(22, 'Pcs'),
(23, 'Tin'),
(24, 'Top');

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
(1, '2018-06-05', 'PO201806050001', 1, 1, 100000.00, 3.00, 300000.00);

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
(1, 'HT000001', 1, 300000.00, 0.00);

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
  `NoRef` varchar(25) NOT NULL DEFAULT '.',
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
(1, 1, 't06_articleview.php?showdetail=&id=1', 1, '1501001', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(2, 2, 't06_articleview.php?showdetail=&id=2', 2, '1501002', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(3, 3, 't06_articleview.php?showdetail=&id=3', 3, '1501003', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(4, 4, 't06_articleview.php?showdetail=&id=4', 4, '1501004', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(5, 5, 't06_articleview.php?showdetail=&id=5', 5, '1501005', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(6, 6, 't06_articleview.php?showdetail=&id=6', 6, '1501006', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(7, 7, 't06_articleview.php?showdetail=&id=7', 7, '1501007', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(8, 8, 't06_articleview.php?showdetail=&id=8', 8, '1501008', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(9, 9, 't06_articleview.php?showdetail=&id=9', 9, '1501009', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(10, 10, 't06_articleview.php?showdetail=&id=10', 10, '1501010', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(11, 11, 't06_articleview.php?showdetail=&id=11', 11, '1501011', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(12, 12, 't06_articleview.php?showdetail=&id=12', 12, '1501012', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(13, 13, 't06_articleview.php?showdetail=&id=13', 13, '1501013', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(14, 14, 't06_articleview.php?showdetail=&id=14', 14, '1501014', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(15, 15, 't06_articleview.php?showdetail=&id=15', 15, '1501015', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(16, 16, 't06_articleview.php?showdetail=&id=16', 16, '1501016', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(17, 17, 't06_articleview.php?showdetail=&id=17', 17, '1501017', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(18, 18, 't06_articleview.php?showdetail=&id=18', 18, '1501018', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(19, 19, 't06_articleview.php?showdetail=&id=19', 19, '1501019', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(20, 20, 't06_articleview.php?showdetail=&id=20', 20, '1501020', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(21, 21, 't06_articleview.php?showdetail=&id=21', 21, '1501021', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(22, 22, 't06_articleview.php?showdetail=&id=22', 22, '1501022', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(23, 23, 't06_articleview.php?showdetail=&id=23', 23, '1501023', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(24, 24, 't06_articleview.php?showdetail=&id=24', 24, '1501024', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(25, 25, 't06_articleview.php?showdetail=&id=25', 25, '1501025', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(26, 26, 't06_articleview.php?showdetail=&id=26', 26, '1501026', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(27, 27, 't06_articleview.php?showdetail=&id=27', 27, '1501027', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(28, 28, 't06_articleview.php?showdetail=&id=28', 28, '1501028', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(29, 29, 't06_articleview.php?showdetail=&id=29', 29, '1501029', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(30, 30, 't06_articleview.php?showdetail=&id=30', 30, '1501030', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(31, 31, 't06_articleview.php?showdetail=&id=31', 31, '1501031', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(32, 32, 't06_articleview.php?showdetail=&id=32', 32, '1501032', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(33, 33, 't06_articleview.php?showdetail=&id=33', 33, '1501033', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(34, 34, 't06_articleview.php?showdetail=&id=34', 34, '1501034', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(35, 35, 't06_articleview.php?showdetail=&id=35', 35, '1501035', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(36, 36, 't06_articleview.php?showdetail=&id=36', 36, '1501036', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(37, 37, 't06_articleview.php?showdetail=&id=37', 37, '1501037', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(38, 38, 't06_articleview.php?showdetail=&id=38', 38, '1501038', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(39, 39, 't06_articleview.php?showdetail=&id=39', 39, '1501039', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(40, 40, 't06_articleview.php?showdetail=&id=40', 40, '1501040', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(41, 41, 't06_articleview.php?showdetail=&id=41', 41, '1501041', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(42, 42, 't06_articleview.php?showdetail=&id=42', 42, '1501042', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(43, 43, 't06_articleview.php?showdetail=&id=43', 43, '1501043', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(44, 44, 't06_articleview.php?showdetail=&id=44', 44, '1501044', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(45, 45, 't06_articleview.php?showdetail=&id=45', 45, '1501045', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(46, 46, 't06_articleview.php?showdetail=&id=46', 46, '1501046', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(47, 47, 't06_articleview.php?showdetail=&id=47', 47, '1501047', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(48, 48, 't06_articleview.php?showdetail=&id=48', 48, '1501048', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(49, 49, 't06_articleview.php?showdetail=&id=49', 49, '1501049', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(50, 50, 't06_articleview.php?showdetail=&id=50', 50, '1501050', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(51, 51, 't06_articleview.php?showdetail=&id=51', 51, '1501051', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(52, 52, 't06_articleview.php?showdetail=&id=52', 52, '1501052', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(53, 53, 't06_articleview.php?showdetail=&id=53', 53, '1501053', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(54, 54, 't06_articleview.php?showdetail=&id=54', 54, '1501054', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(55, 55, 't06_articleview.php?showdetail=&id=55', 55, '1501055', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(56, 56, 't06_articleview.php?showdetail=&id=56', 56, '1501056', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(57, 57, 't06_articleview.php?showdetail=&id=57', 57, '1501057', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(58, 58, 't06_articleview.php?showdetail=&id=58', 58, '1501058', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(59, 59, 't06_articleview.php?showdetail=&id=59', 59, '1501059', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(60, 60, 't06_articleview.php?showdetail=&id=60', 60, '1501060', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(61, 61, 't06_articleview.php?showdetail=&id=61', 61, '1501061', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(62, 62, 't06_articleview.php?showdetail=&id=62', 62, '1501062', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(63, 63, 't06_articleview.php?showdetail=&id=63', 63, '1501063', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(64, 64, 't06_articleview.php?showdetail=&id=64', 64, '1501064', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(65, 65, 't06_articleview.php?showdetail=&id=65', 65, '1501065', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(66, 66, 't06_articleview.php?showdetail=&id=66', 66, '1501066', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(67, 67, 't06_articleview.php?showdetail=&id=67', 67, '1501067', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(68, 68, 't06_articleview.php?showdetail=&id=68', 68, '1501068', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(69, 69, 't06_articleview.php?showdetail=&id=69', 69, '1501069', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(70, 70, 't06_articleview.php?showdetail=&id=70', 70, '1501070', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(71, 71, 't06_articleview.php?showdetail=&id=71', 71, '1501071', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(72, 72, 't06_articleview.php?showdetail=&id=72', 72, '1501072', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(73, 73, 't06_articleview.php?showdetail=&id=73', 73, '1501073', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(74, 74, 't06_articleview.php?showdetail=&id=74', 74, '1501074', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(75, 75, 't06_articleview.php?showdetail=&id=75', 75, '1501075', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(76, 76, 't06_articleview.php?showdetail=&id=76', 76, '1501076', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(77, 77, 't06_articleview.php?showdetail=&id=77', 77, '1501077', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(78, 78, 't06_articleview.php?showdetail=&id=78', 78, '1501078', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(79, 79, 't06_articleview.php?showdetail=&id=79', 79, '1501079', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(80, 80, 't06_articleview.php?showdetail=&id=80', 80, '1501080', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(81, 81, 't06_articleview.php?showdetail=&id=81', 81, '1501081', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(82, 82, 't06_articleview.php?showdetail=&id=82', 82, '1501082', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(83, 83, 't06_articleview.php?showdetail=&id=83', 83, '1501083', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(84, 84, 't06_articleview.php?showdetail=&id=84', 84, '1502001', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(85, 85, 't06_articleview.php?showdetail=&id=85', 85, '1502002', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(86, 86, 't06_articleview.php?showdetail=&id=86', 86, '1502003', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(87, 87, 't06_articleview.php?showdetail=&id=87', 87, '1502004', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(88, 88, 't06_articleview.php?showdetail=&id=88', 88, '1502005', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(89, 89, 't06_articleview.php?showdetail=&id=89', 89, '1502006', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(90, 90, 't06_articleview.php?showdetail=&id=90', 90, '1502007', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(91, 91, 't06_articleview.php?showdetail=&id=91', 91, '1502008', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(92, 92, 't06_articleview.php?showdetail=&id=92', 92, '1502009', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(93, 93, 't06_articleview.php?showdetail=&id=93', 93, '1502010', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(94, 94, 't06_articleview.php?showdetail=&id=94', 94, '1502011', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(95, 95, 't06_articleview.php?showdetail=&id=95', 95, '1502012', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(96, 96, 't06_articleview.php?showdetail=&id=96', 96, '1502013', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(97, 97, 't06_articleview.php?showdetail=&id=97', 97, '1502014', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(98, 98, 't06_articleview.php?showdetail=&id=98', 98, '1502015', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(99, 99, 't06_articleview.php?showdetail=&id=99', 99, '1502016', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(100, 100, 't06_articleview.php?showdetail=&id=100', 100, '1502017', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(101, 101, 't06_articleview.php?showdetail=&id=101', 101, '1502018', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(102, 102, 't06_articleview.php?showdetail=&id=102', 102, '1502019', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(103, 103, 't06_articleview.php?showdetail=&id=103', 103, '1502020', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(104, 104, 't06_articleview.php?showdetail=&id=104', 104, '1502021', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(105, 105, 't06_articleview.php?showdetail=&id=105', 105, '1502022', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(106, 106, 't06_articleview.php?showdetail=&id=106', 106, '1502023', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(107, 107, 't06_articleview.php?showdetail=&id=107', 107, '1502024', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(108, 108, 't06_articleview.php?showdetail=&id=108', 108, '1502025', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(109, 109, 't06_articleview.php?showdetail=&id=109', 109, '1502026', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(110, 110, 't06_articleview.php?showdetail=&id=110', 110, '1502027', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(111, 111, 't06_articleview.php?showdetail=&id=111', 111, '1502028', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(112, 112, 't06_articleview.php?showdetail=&id=112', 112, '1502029', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(113, 113, 't06_articleview.php?showdetail=&id=113', 113, '1502030', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(114, 114, 't06_articleview.php?showdetail=&id=114', 114, '1502031', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(115, 115, 't06_articleview.php?showdetail=&id=115', 115, '1502032', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(116, 116, 't06_articleview.php?showdetail=&id=116', 116, '1502033', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(117, 117, 't06_articleview.php?showdetail=&id=117', 117, '1502034', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(118, 118, 't06_articleview.php?showdetail=&id=118', 118, '1502035', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(119, 119, 't06_articleview.php?showdetail=&id=119', 119, '1502036', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(120, 120, 't06_articleview.php?showdetail=&id=120', 120, '1502037', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(121, 121, 't06_articleview.php?showdetail=&id=121', 121, '1502038', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(122, 122, 't06_articleview.php?showdetail=&id=122', 122, '1502039', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(123, 123, 't06_articleview.php?showdetail=&id=123', 123, '1502040', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(124, 124, 't06_articleview.php?showdetail=&id=124', 124, '1502041', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(125, 125, 't06_articleview.php?showdetail=&id=125', 125, '1503001', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(126, 126, 't06_articleview.php?showdetail=&id=126', 126, '1503002', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(127, 127, 't06_articleview.php?showdetail=&id=127', 127, '1503003', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(128, 128, 't06_articleview.php?showdetail=&id=128', 128, '1503004', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(129, 129, 't06_articleview.php?showdetail=&id=129', 129, '1503005', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(130, 130, 't06_articleview.php?showdetail=&id=130', 130, '1503006', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(131, 131, 't06_articleview.php?showdetail=&id=131', 131, '1503007', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(132, 132, 't06_articleview.php?showdetail=&id=132', 132, '1503008', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(133, 133, 't06_articleview.php?showdetail=&id=133', 133, '1503009', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(134, 134, 't06_articleview.php?showdetail=&id=134', 134, '1503010', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(135, 135, 't06_articleview.php?showdetail=&id=135', 135, '1503011', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(136, 136, 't06_articleview.php?showdetail=&id=136', 136, '1503012', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(137, 137, 't06_articleview.php?showdetail=&id=137', 137, '1503013', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(138, 138, 't06_articleview.php?showdetail=&id=138', 138, '1503014', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(139, 139, 't06_articleview.php?showdetail=&id=139', 139, '1503015', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(140, 140, 't06_articleview.php?showdetail=&id=140', 140, '1503016', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(141, 141, 't06_articleview.php?showdetail=&id=141', 141, '1503017', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(142, 142, 't06_articleview.php?showdetail=&id=142', 142, '1503018', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(143, 143, 't06_articleview.php?showdetail=&id=143', 143, '1503019', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(144, 144, 't06_articleview.php?showdetail=&id=144', 144, '1503020', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(145, 145, 't06_articleview.php?showdetail=&id=145', 145, '1503021', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(146, 146, 't06_articleview.php?showdetail=&id=146', 146, '1503022', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(147, 147, 't06_articleview.php?showdetail=&id=147', 147, '1503023', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(148, 148, 't06_articleview.php?showdetail=&id=148', 148, '1503024', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(149, 149, 't06_articleview.php?showdetail=&id=149', 149, '1503025', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(150, 150, 't06_articleview.php?showdetail=&id=150', 150, '1503026', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(151, 151, 't06_articleview.php?showdetail=&id=151', 151, '1503027', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(152, 152, 't06_articleview.php?showdetail=&id=152', 152, '1503028', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(153, 153, 't06_articleview.php?showdetail=&id=153', 153, '1503029', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(154, 154, 't06_articleview.php?showdetail=&id=154', 154, '1503030', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(155, 155, 't06_articleview.php?showdetail=&id=155', 155, '1503031', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(156, 156, 't06_articleview.php?showdetail=&id=156', 156, '1503032', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(157, 157, 't06_articleview.php?showdetail=&id=157', 157, '1503033', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(158, 158, 't06_articleview.php?showdetail=&id=158', 158, '1503034', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(159, 159, 't06_articleview.php?showdetail=&id=159', 159, '1503035', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(160, 160, 't06_articleview.php?showdetail=&id=160', 160, '1503036', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(161, 161, 't06_articleview.php?showdetail=&id=161', 161, '1503037', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(162, 162, 't06_articleview.php?showdetail=&id=162', 162, '1503038', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(163, 163, 't06_articleview.php?showdetail=&id=163', 163, '1503039', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(164, 164, 't06_articleview.php?showdetail=&id=164', 164, '1503040', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(165, 165, 't06_articleview.php?showdetail=&id=165', 165, '1503041', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(166, 166, 't06_articleview.php?showdetail=&id=166', 166, '1503042', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(167, 167, 't06_articleview.php?showdetail=&id=167', 167, '1503043', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(168, 168, 't06_articleview.php?showdetail=&id=168', 168, '1503044', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(169, 169, 't06_articleview.php?showdetail=&id=169', 169, '1503045', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(170, 170, 't06_articleview.php?showdetail=&id=170', 170, '1503046', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(171, 171, 't06_articleview.php?showdetail=&id=171', 171, '1503047', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(172, 172, 't06_articleview.php?showdetail=&id=172', 172, '1503048', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(173, 173, 't06_articleview.php?showdetail=&id=173', 173, '1503049', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(174, 174, 't06_articleview.php?showdetail=&id=174', 174, '1503050', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(175, 175, 't06_articleview.php?showdetail=&id=175', 175, '1503051', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(176, 176, 't06_articleview.php?showdetail=&id=176', 176, '1503052', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(177, 177, 't06_articleview.php?showdetail=&id=177', 177, '1503053', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(178, 178, 't06_articleview.php?showdetail=&id=178', 178, '1503054', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(179, 179, 't06_articleview.php?showdetail=&id=179', 179, '1503055', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(180, 180, 't06_articleview.php?showdetail=&id=180', 180, '1503056', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(181, 181, 't06_articleview.php?showdetail=&id=181', 181, '1503057', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(182, 182, 't06_articleview.php?showdetail=&id=182', 182, '1503058', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(183, 183, 't06_articleview.php?showdetail=&id=183', 183, '1503059', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(184, 184, 't06_articleview.php?showdetail=&id=184', 184, '1503060', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(185, 185, 't06_articleview.php?showdetail=&id=185', 185, '1503061', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(186, 186, 't06_articleview.php?showdetail=&id=186', 186, '1503062', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(187, 187, 't06_articleview.php?showdetail=&id=187', 187, '1503063', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(188, 188, 't06_articleview.php?showdetail=&id=188', 188, '1503064', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(189, 189, 't06_articleview.php?showdetail=&id=189', 189, '1503065', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(190, 190, 't06_articleview.php?showdetail=&id=190', 190, '1503066', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(191, 191, 't06_articleview.php?showdetail=&id=191', 191, '1503067', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(192, 192, 't06_articleview.php?showdetail=&id=192', 192, '1503068', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(193, 193, 't06_articleview.php?showdetail=&id=193', 193, '1503069', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(194, 194, 't06_articleview.php?showdetail=&id=194', 194, '1503070', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(195, 195, 't06_articleview.php?showdetail=&id=195', 195, '1503071', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(196, 196, 't06_articleview.php?showdetail=&id=196', 196, '1503072', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(197, 197, 't06_articleview.php?showdetail=&id=197', 197, '1503073', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(198, 198, 't06_articleview.php?showdetail=&id=198', 198, '1503074', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(199, 199, 't06_articleview.php?showdetail=&id=199', 199, '1503075', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(200, 200, 't06_articleview.php?showdetail=&id=200', 200, '1503076', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(201, 201, 't06_articleview.php?showdetail=&id=201', 201, '1503077', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(202, 202, 't06_articleview.php?showdetail=&id=202', 202, '1503078', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(203, 203, 't06_articleview.php?showdetail=&id=203', 203, '1503079', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(204, 204, 't06_articleview.php?showdetail=&id=204', 204, '1503080', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(205, 205, 't06_articleview.php?showdetail=&id=205', 205, '1503081', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(206, 206, 't06_articleview.php?showdetail=&id=206', 206, '1503082', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(207, 207, 't06_articleview.php?showdetail=&id=207', 207, '1503083', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(208, 208, 't06_articleview.php?showdetail=&id=208', 208, '1503084', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(209, 209, 't06_articleview.php?showdetail=&id=209', 209, '1503085', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(210, 210, 't06_articleview.php?showdetail=&id=210', 210, '1503086', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(211, 211, 't06_articleview.php?showdetail=&id=211', 211, '1503087', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(212, 212, 't06_articleview.php?showdetail=&id=212', 212, '1503088', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(213, 213, 't06_articleview.php?showdetail=&id=213', 213, '1503089', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(214, 214, 't06_articleview.php?showdetail=&id=214', 214, '1503090', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(215, 215, 't06_articleview.php?showdetail=&id=215', 215, '1503091', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(216, 216, 't06_articleview.php?showdetail=&id=216', 216, '1503092', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(217, 217, 't06_articleview.php?showdetail=&id=217', 217, '1503093', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(218, 218, 't06_articleview.php?showdetail=&id=218', 218, '1503094', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(219, 219, 't06_articleview.php?showdetail=&id=219', 219, '1503095', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(220, 220, 't06_articleview.php?showdetail=&id=220', 220, '1503096', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(221, 221, 't06_articleview.php?showdetail=&id=221', 221, '1503097', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(222, 222, 't06_articleview.php?showdetail=&id=222', 222, '1503098', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(223, 223, 't06_articleview.php?showdetail=&id=223', 223, '1503099', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(224, 224, 't06_articleview.php?showdetail=&id=224', 224, '1503100', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(225, 225, 't06_articleview.php?showdetail=&id=225', 225, '1503101', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(226, 226, 't06_articleview.php?showdetail=&id=226', 226, '1504001', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(227, 227, 't06_articleview.php?showdetail=&id=227', 227, '1504002', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(228, 228, 't06_articleview.php?showdetail=&id=228', 228, '1504003', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(229, 229, 't06_articleview.php?showdetail=&id=229', 229, '1504004', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(230, 230, 't06_articleview.php?showdetail=&id=230', 230, '1504005', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(231, 231, 't06_articleview.php?showdetail=&id=231', 231, '1504006', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(232, 232, 't06_articleview.php?showdetail=&id=232', 232, '1504007', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(233, 233, 't06_articleview.php?showdetail=&id=233', 233, '1504008', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(234, 234, 't06_articleview.php?showdetail=&id=234', 234, '1504009', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(235, 235, 't06_articleview.php?showdetail=&id=235', 235, '1504010', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(236, 236, 't06_articleview.php?showdetail=&id=236', 236, '1504011', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(237, 237, 't06_articleview.php?showdetail=&id=237', 237, '1504012', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(238, 238, 't06_articleview.php?showdetail=&id=238', 238, '1504013', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(239, 239, 't06_articleview.php?showdetail=&id=239', 239, '1504014', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(240, 240, 't06_articleview.php?showdetail=&id=240', 240, '1504015', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(241, 241, 't06_articleview.php?showdetail=&id=241', 241, '1504016', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(242, 242, 't06_articleview.php?showdetail=&id=242', 242, '1504017', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(243, 243, 't06_articleview.php?showdetail=&id=243', 243, '1504018', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(244, 244, 't06_articleview.php?showdetail=&id=244', 244, '1504019', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(245, 245, 't06_articleview.php?showdetail=&id=245', 245, '1504020', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(246, 246, 't06_articleview.php?showdetail=&id=246', 246, '1504021', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(247, 247, 't06_articleview.php?showdetail=&id=247', 247, '1504022', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(248, 248, 't06_articleview.php?showdetail=&id=248', 248, '1504023', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(249, 249, 't06_articleview.php?showdetail=&id=249', 249, '1504024', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(250, 250, 't06_articleview.php?showdetail=&id=250', 250, '1504025', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(251, 251, 't06_articleview.php?showdetail=&id=251', 251, '1504026', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(252, 252, 't06_articleview.php?showdetail=&id=252', 252, '1504027', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(253, 253, 't06_articleview.php?showdetail=&id=253', 253, '1504028', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(254, 254, 't06_articleview.php?showdetail=&id=254', 254, '1504029', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(255, 255, 't06_articleview.php?showdetail=&id=255', 255, '1504030', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(256, 256, 't06_articleview.php?showdetail=&id=256', 256, '1504031', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(257, 257, 't06_articleview.php?showdetail=&id=257', 257, '1504032', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(258, 258, 't06_articleview.php?showdetail=&id=258', 258, '1504033', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(259, 259, 't06_articleview.php?showdetail=&id=259', 259, '1504034', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(260, 260, 't06_articleview.php?showdetail=&id=260', 260, '1504035', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(261, 261, 't06_articleview.php?showdetail=&id=261', 261, '1504036', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(262, 262, 't06_articleview.php?showdetail=&id=262', 262, '1504037', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(263, 263, 't06_articleview.php?showdetail=&id=263', 263, '1504038', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(264, 264, 't06_articleview.php?showdetail=&id=264', 264, '1504039', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(265, 265, 't06_articleview.php?showdetail=&id=265', 265, '1504040', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(266, 266, 't06_articleview.php?showdetail=&id=266', 266, '1504041', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(267, 267, 't06_articleview.php?showdetail=&id=267', 267, '1504042', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(268, 268, 't06_articleview.php?showdetail=&id=268', 268, '1504043', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(269, 269, 't06_articleview.php?showdetail=&id=269', 269, '1504044', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(270, 270, 't06_articleview.php?showdetail=&id=270', 270, '1504045', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(271, 271, 't06_articleview.php?showdetail=&id=271', 271, '1504046', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(272, 272, 't06_articleview.php?showdetail=&id=272', 272, '1504047', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(273, 273, 't06_articleview.php?showdetail=&id=273', 273, '1504048', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(274, 274, 't06_articleview.php?showdetail=&id=274', 274, '1504049', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(275, 275, 't06_articleview.php?showdetail=&id=275', 275, '1504050', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(276, 276, 't06_articleview.php?showdetail=&id=276', 276, '1504051', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(277, 277, 't06_articleview.php?showdetail=&id=277', 277, '1504052', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(278, 278, 't06_articleview.php?showdetail=&id=278', 278, '1504053', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(279, 279, 't06_articleview.php?showdetail=&id=279', 279, '1504054', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(280, 280, 't06_articleview.php?showdetail=&id=280', 280, '1504055', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(281, 281, 't06_articleview.php?showdetail=&id=281', 281, '1504056', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(282, 282, 't06_articleview.php?showdetail=&id=282', 282, '1504057', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(283, 283, 't06_articleview.php?showdetail=&id=283', 283, '1505001', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(284, 284, 't06_articleview.php?showdetail=&id=284', 284, '1505002', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(285, 285, 't06_articleview.php?showdetail=&id=285', 285, '1505003', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(286, 286, 't06_articleview.php?showdetail=&id=286', 286, '1505004', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(287, 287, 't06_articleview.php?showdetail=&id=287', 287, '1505005', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(288, 288, 't06_articleview.php?showdetail=&id=288', 288, '1505006', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(289, 289, 't06_articleview.php?showdetail=&id=289', 289, '1505007', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(290, 290, 't06_articleview.php?showdetail=&id=290', 290, '1505008', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(291, 291, 't06_articleview.php?showdetail=&id=291', 291, '1505009', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(292, 292, 't06_articleview.php?showdetail=&id=292', 292, '1505010', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(293, 293, 't06_articleview.php?showdetail=&id=293', 293, '1505011', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(294, 294, 't06_articleview.php?showdetail=&id=294', 294, '1505012', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(295, 295, 't06_articleview.php?showdetail=&id=295', 295, '1505013', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(296, 296, 't06_articleview.php?showdetail=&id=296', 296, '1505014', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(297, 297, 't06_articleview.php?showdetail=&id=297', 297, '1505015', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(298, 298, 't06_articleview.php?showdetail=&id=298', 298, '1505016', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(299, 299, 't06_articleview.php?showdetail=&id=299', 299, '1505017', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(300, 300, 't06_articleview.php?showdetail=&id=300', 300, '1505018', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(301, 301, 't06_articleview.php?showdetail=&id=301', 301, '1505019', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(302, 302, 't06_articleview.php?showdetail=&id=302', 302, '1506001', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(303, 303, 't06_articleview.php?showdetail=&id=303', 303, '1506002', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(304, 304, 't06_articleview.php?showdetail=&id=304', 304, '1506003', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(305, 305, 't06_articleview.php?showdetail=&id=305', 305, '1506004', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(306, 306, 't06_articleview.php?showdetail=&id=306', 306, '1506005', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(307, 307, 't06_articleview.php?showdetail=&id=307', 307, '1506006', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(308, 308, 't06_articleview.php?showdetail=&id=308', 308, '1506007', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(309, 309, 't06_articleview.php?showdetail=&id=309', 309, '1506008', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(310, 310, 't06_articleview.php?showdetail=&id=310', 310, '1506009', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(311, 311, 't06_articleview.php?showdetail=&id=311', 311, '1506010', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(312, 312, 't06_articleview.php?showdetail=&id=312', 312, '1506011', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(313, 313, 't06_articleview.php?showdetail=&id=313', 313, '1506012', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(314, 314, 't06_articleview.php?showdetail=&id=314', 314, '1506013', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(315, 315, 't06_articleview.php?showdetail=&id=315', 315, '1506014', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(316, 316, 't06_articleview.php?showdetail=&id=316', 316, '1506015', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(317, 317, 't06_articleview.php?showdetail=&id=317', 317, '1507001', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(318, 318, 't06_articleview.php?showdetail=&id=318', 318, '1507002', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(319, 319, 't06_articleview.php?showdetail=&id=319', 319, '1507003', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(320, 320, 't06_articleview.php?showdetail=&id=320', 320, '1507004', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(321, 321, 't06_articleview.php?showdetail=&id=321', 321, '1507005', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(322, 322, 't06_articleview.php?showdetail=&id=322', 322, '1507006', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(323, 323, 't06_articleview.php?showdetail=&id=323', 323, '1507007', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(324, 324, 't06_articleview.php?showdetail=&id=324', 324, '1507008', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(325, 325, 't06_articleview.php?showdetail=&id=325', 325, '1507009', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(326, 326, 't06_articleview.php?showdetail=&id=326', 326, '1507010', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(327, 327, 't06_articleview.php?showdetail=&id=327', 327, '1507011', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(328, 328, 't06_articleview.php?showdetail=&id=328', 328, '1507012', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(329, 329, 't06_articleview.php?showdetail=&id=329', 329, '1507013', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(330, 330, 't06_articleview.php?showdetail=&id=330', 330, '1507014', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(331, 331, 't06_articleview.php?showdetail=&id=331', 331, '1507015', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(332, 332, 't06_articleview.php?showdetail=&id=332', 332, '1507016', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00);
INSERT INTO `t13_mutasi` (`id`, `TabelID`, `Url`, `ArticleID`, `Kode`, `NoUrut`, `Tgl`, `Jam`, `Keterangan`, `NoRef`, `MasukQty`, `MasukHarga`, `KeluarQty`, `KeluarHarga`, `SaldoQty`, `SaldoHarga`) VALUES
(333, 333, 't06_articleview.php?showdetail=&id=333', 333, '1507017', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(334, 334, 't06_articleview.php?showdetail=&id=334', 334, '1507018', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(335, 335, 't06_articleview.php?showdetail=&id=335', 335, '1507019', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(336, 336, 't06_articleview.php?showdetail=&id=336', 336, '1507020', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(337, 337, 't06_articleview.php?showdetail=&id=337', 337, '1507021', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(338, 338, 't06_articleview.php?showdetail=&id=338', 338, '1507022', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(339, 339, 't06_articleview.php?showdetail=&id=339', 339, '1507023', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(340, 340, 't06_articleview.php?showdetail=&id=340', 340, '1507024', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(341, 341, 't06_articleview.php?showdetail=&id=341', 341, '1507025', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(342, 342, 't06_articleview.php?showdetail=&id=342', 342, '1507026', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(343, 343, 't06_articleview.php?showdetail=&id=343', 343, '1507027', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(344, 344, 't06_articleview.php?showdetail=&id=344', 344, '1507028', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(345, 345, 't06_articleview.php?showdetail=&id=345', 345, '1507029', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(346, 346, 't06_articleview.php?showdetail=&id=346', 346, '1507030', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(347, 347, 't06_articleview.php?showdetail=&id=347', 347, '1507031', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(348, 348, 't06_articleview.php?showdetail=&id=348', 348, '1507032', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(349, 349, 't06_articleview.php?showdetail=&id=349', 349, '1507033', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(350, 350, 't06_articleview.php?showdetail=&id=350', 350, '1507034', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(351, 351, 't06_articleview.php?showdetail=&id=351', 351, '1507035', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(352, 352, 't06_articleview.php?showdetail=&id=352', 352, '1507036', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(353, 353, 't06_articleview.php?showdetail=&id=353', 353, '1507037', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(354, 354, 't06_articleview.php?showdetail=&id=354', 354, '1507038', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(355, 355, 't06_articleview.php?showdetail=&id=355', 355, '1507039', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(356, 356, 't06_articleview.php?showdetail=&id=356', 356, '1507040', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(357, 357, 't06_articleview.php?showdetail=&id=357', 357, '1507041', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(358, 358, 't06_articleview.php?showdetail=&id=358', 358, '1507042', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(359, 359, 't06_articleview.php?showdetail=&id=359', 359, '1507043', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(360, 360, 't06_articleview.php?showdetail=&id=360', 360, '1507044', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(361, 361, 't06_articleview.php?showdetail=&id=361', 361, '1507045', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(362, 362, 't06_articleview.php?showdetail=&id=362', 362, '1507046', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(363, 363, 't06_articleview.php?showdetail=&id=363', 363, '1507047', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(364, 364, 't06_articleview.php?showdetail=&id=364', 364, '1507048', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(365, 365, 't06_articleview.php?showdetail=&id=365', 365, '1507049', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(366, 366, 't06_articleview.php?showdetail=&id=366', 366, '1507050', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(367, 367, 't06_articleview.php?showdetail=&id=367', 367, '1507051', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(368, 368, 't06_articleview.php?showdetail=&id=368', 368, '1507052', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(369, 369, 't06_articleview.php?showdetail=&id=369', 369, '1507053', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(370, 370, 't06_articleview.php?showdetail=&id=370', 370, '1507054', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(371, 371, 't06_articleview.php?showdetail=&id=371', 371, '1507055', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(372, 372, 't06_articleview.php?showdetail=&id=372', 372, '1507056', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(373, 373, 't06_articleview.php?showdetail=&id=373', 373, '1507057', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(374, 374, 't06_articleview.php?showdetail=&id=374', 374, '1507058', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(375, 375, 't06_articleview.php?showdetail=&id=375', 375, '1507059', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(376, 376, 't06_articleview.php?showdetail=&id=376', 376, '1507060', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(377, 377, 't06_articleview.php?showdetail=&id=377', 377, '1507061', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(378, 378, 't06_articleview.php?showdetail=&id=378', 378, '1507062', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(379, 379, 't06_articleview.php?showdetail=&id=379', 379, '1507063', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(380, 380, 't06_articleview.php?showdetail=&id=380', 380, '1507064', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(381, 381, 't06_articleview.php?showdetail=&id=381', 381, '1507065', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(382, 382, 't06_articleview.php?showdetail=&id=382', 382, '1507066', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(383, 383, 't06_articleview.php?showdetail=&id=383', 383, '1507067', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(384, 384, 't06_articleview.php?showdetail=&id=384', 384, '1507068', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(385, 385, 't06_articleview.php?showdetail=&id=385', 385, '1507069', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(386, 386, 't06_articleview.php?showdetail=&id=386', 386, '1507070', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(387, 387, 't06_articleview.php?showdetail=&id=387', 387, '1507071', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(388, 388, 't06_articleview.php?showdetail=&id=388', 388, '1507072', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(389, 389, 't06_articleview.php?showdetail=&id=389', 389, '1507073', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(390, 390, 't06_articleview.php?showdetail=&id=390', 390, '1507074', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(391, 391, 't06_articleview.php?showdetail=&id=391', 391, '1507075', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(392, 392, 't06_articleview.php?showdetail=&id=392', 392, '1507076', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(393, 393, 't06_articleview.php?showdetail=&id=393', 393, '1507077', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(394, 394, 't06_articleview.php?showdetail=&id=394', 394, '1507078', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(395, 395, 't06_articleview.php?showdetail=&id=395', 395, '1507079', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(396, 396, 't06_articleview.php?showdetail=&id=396', 396, '1507080', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(397, 397, 't06_articleview.php?showdetail=&id=397', 397, '1507081', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(398, 398, 't06_articleview.php?showdetail=&id=398', 398, '1507082', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(399, 399, 't06_articleview.php?showdetail=&id=399', 399, '1507083', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(400, 400, 't06_articleview.php?showdetail=&id=400', 400, '1507084', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(401, 401, 't06_articleview.php?showdetail=&id=401', 401, '1507085', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(402, 402, 't06_articleview.php?showdetail=&id=402', 402, '1507086', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(403, 403, 't06_articleview.php?showdetail=&id=403', 403, '1507087', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(404, 404, 't06_articleview.php?showdetail=&id=404', 404, '1507088', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(405, 405, 't06_articleview.php?showdetail=&id=405', 405, '1507089', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(406, 406, 't06_articleview.php?showdetail=&id=406', 406, '1507090', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(407, 407, 't06_articleview.php?showdetail=&id=407', 407, '1507091', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(408, 408, 't06_articleview.php?showdetail=&id=408', 408, '1507092', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(409, 409, 't06_articleview.php?showdetail=&id=409', 409, '1507093', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(410, 410, 't06_articleview.php?showdetail=&id=410', 410, '1507094', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(411, 411, 't06_articleview.php?showdetail=&id=411', 411, '1507095', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(412, 412, 't06_articleview.php?showdetail=&id=412', 412, '1507096', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(413, 413, 't06_articleview.php?showdetail=&id=413', 413, '1507097', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(414, 414, 't06_articleview.php?showdetail=&id=414', 414, '1507098', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(415, 415, 't06_articleview.php?showdetail=&id=415', 415, '1507099', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(416, 416, 't06_articleview.php?showdetail=&id=416', 416, '1507100', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(417, 417, 't06_articleview.php?showdetail=&id=417', 417, '1507101', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(418, 418, 't06_articleview.php?showdetail=&id=418', 418, '1507102', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(419, 419, 't06_articleview.php?showdetail=&id=419', 419, '1507103', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(420, 420, 't06_articleview.php?showdetail=&id=420', 420, '1507104', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(421, 421, 't06_articleview.php?showdetail=&id=421', 421, '1507105', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(422, 422, 't06_articleview.php?showdetail=&id=422', 422, '1507106', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(423, 423, 't06_articleview.php?showdetail=&id=423', 423, '1507107', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(424, 424, 't06_articleview.php?showdetail=&id=424', 424, '1507108', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(425, 425, 't06_articleview.php?showdetail=&id=425', 425, '1507109', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(426, 426, 't06_articleview.php?showdetail=&id=426', 426, '1507110', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(427, 427, 't06_articleview.php?showdetail=&id=427', 427, '1507111', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(428, 428, 't06_articleview.php?showdetail=&id=428', 428, '1507112', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(429, 429, 't06_articleview.php?showdetail=&id=429', 429, '1507113', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(430, 430, 't06_articleview.php?showdetail=&id=430', 430, '1507114', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(431, 431, 't06_articleview.php?showdetail=&id=431', 431, '1507115', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(432, 432, 't06_articleview.php?showdetail=&id=432', 432, '1507116', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(433, 433, 't06_articleview.php?showdetail=&id=433', 433, '1507117', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(434, 434, 't06_articleview.php?showdetail=&id=434', 434, '1508001', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(435, 435, 't06_articleview.php?showdetail=&id=435', 435, '1508002', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(436, 436, 't06_articleview.php?showdetail=&id=436', 436, '1508003', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(437, 437, 't06_articleview.php?showdetail=&id=437', 437, '1508004', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(438, 438, 't06_articleview.php?showdetail=&id=438', 438, '1508005', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(439, 439, 't06_articleview.php?showdetail=&id=439', 439, '1508006', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(440, 440, 't06_articleview.php?showdetail=&id=440', 440, '1508007', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(441, 441, 't06_articleview.php?showdetail=&id=441', 441, '1508008', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(442, 442, 't06_articleview.php?showdetail=&id=442', 442, '1508009', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(443, 443, 't06_articleview.php?showdetail=&id=443', 443, '1508010', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(444, 444, 't06_articleview.php?showdetail=&id=444', 444, '1508011', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(445, 445, 't06_articleview.php?showdetail=&id=445', 445, '1508012', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(446, 446, 't06_articleview.php?showdetail=&id=446', 446, '1508013', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(447, 447, 't06_articleview.php?showdetail=&id=447', 447, '1508014', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(448, 448, 't06_articleview.php?showdetail=&id=448', 448, '1508015', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(449, 449, 't06_articleview.php?showdetail=&id=449', 449, '1508016', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(450, 450, 't06_articleview.php?showdetail=&id=450', 450, '1508017', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(451, 451, 't06_articleview.php?showdetail=&id=451', 451, '1508018', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(452, 452, 't06_articleview.php?showdetail=&id=452', 452, '1508019', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(453, 453, 't06_articleview.php?showdetail=&id=453', 453, '1508020', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(454, 454, 't06_articleview.php?showdetail=&id=454', 454, '1508021', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(455, 455, 't06_articleview.php?showdetail=&id=455', 455, '1508022', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(456, 456, 't06_articleview.php?showdetail=&id=456', 456, '1508023', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(457, 457, 't06_articleview.php?showdetail=&id=457', 457, '1508024', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(458, 458, 't06_articleview.php?showdetail=&id=458', 458, '1508025', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(459, 459, 't06_articleview.php?showdetail=&id=459', 459, '1508026', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(460, 460, 't06_articleview.php?showdetail=&id=460', 460, '1508027', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(461, 461, 't06_articleview.php?showdetail=&id=461', 461, '1509001', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(462, 462, 't06_articleview.php?showdetail=&id=462', 462, '1509002', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(463, 463, 't06_articleview.php?showdetail=&id=463', 463, '1509003', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(464, 464, 't06_articleview.php?showdetail=&id=464', 464, '1509004', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(465, 465, 't06_articleview.php?showdetail=&id=465', 465, '1509005', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(466, 466, 't06_articleview.php?showdetail=&id=466', 466, '1509006', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(467, 467, 't06_articleview.php?showdetail=&id=467', 467, '1509007', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(468, 468, 't06_articleview.php?showdetail=&id=468', 468, '1509008', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(469, 469, 't06_articleview.php?showdetail=&id=469', 469, '1509009', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(470, 470, 't06_articleview.php?showdetail=&id=470', 470, '1509010', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(471, 471, 't06_articleview.php?showdetail=&id=471', 471, '1509011', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(472, 472, 't06_articleview.php?showdetail=&id=472', 472, '1509012', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(473, 473, 't06_articleview.php?showdetail=&id=473', 473, '1509013', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(474, 474, 't06_articleview.php?showdetail=&id=474', 474, '1509014', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(475, 475, 't06_articleview.php?showdetail=&id=475', 475, '1509015', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(476, 476, 't06_articleview.php?showdetail=&id=476', 476, '1509016', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(477, 477, 't06_articleview.php?showdetail=&id=477', 477, '1509017', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(478, 478, 't06_articleview.php?showdetail=&id=478', 478, '1509018', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(479, 479, 't06_articleview.php?showdetail=&id=479', 479, '1509019', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(480, 480, 't06_articleview.php?showdetail=&id=480', 480, '1509020', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(481, 481, 't06_articleview.php?showdetail=&id=481', 481, '1509021', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(482, 482, 't06_articleview.php?showdetail=&id=482', 482, '1509022', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(483, 483, 't06_articleview.php?showdetail=&id=483', 483, '1509023', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(484, 484, 't06_articleview.php?showdetail=&id=484', 484, '1509024', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(485, 485, 't06_articleview.php?showdetail=&id=485', 485, '1509025', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(486, 486, 't06_articleview.php?showdetail=&id=486', 486, '1509026', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(487, 487, 't06_articleview.php?showdetail=&id=487', 487, '1509027', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(488, 488, 't06_articleview.php?showdetail=&id=488', 488, '1509028', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(489, 489, 't06_articleview.php?showdetail=&id=489', 489, '1509029', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(490, 490, 't06_articleview.php?showdetail=&id=490', 490, '1509030', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(491, 491, 't06_articleview.php?showdetail=&id=491', 491, '1509031', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(492, 492, 't06_articleview.php?showdetail=&id=492', 492, '1509032', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(493, 493, 't06_articleview.php?showdetail=&id=493', 493, '1509033', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(494, 494, 't06_articleview.php?showdetail=&id=494', 494, '1509034', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(495, 495, 't06_articleview.php?showdetail=&id=495', 495, '1509035', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(496, 496, 't06_articleview.php?showdetail=&id=496', 496, '1509036', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(497, 497, 't06_articleview.php?showdetail=&id=497', 497, '1509037', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(498, 498, 't06_articleview.php?showdetail=&id=498', 498, '1509038', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(499, 499, 't06_articleview.php?showdetail=&id=499', 499, '1509039', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(500, 500, 't06_articleview.php?showdetail=&id=500', 500, '1509040', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(501, 501, 't06_articleview.php?showdetail=&id=501', 501, '1509041', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(502, 502, 't06_articleview.php?showdetail=&id=502', 502, '1509042', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(503, 503, 't06_articleview.php?showdetail=&id=503', 503, '1509043', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(504, 504, 't06_articleview.php?showdetail=&id=504', 504, '1509044', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(505, 505, 't06_articleview.php?showdetail=&id=505', 505, '1509045', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(506, 506, 't06_articleview.php?showdetail=&id=506', 506, '1509046', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(507, 507, 't06_articleview.php?showdetail=&id=507', 507, '1509047', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(508, 508, 't06_articleview.php?showdetail=&id=508', 508, '1509048', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(509, 509, 't06_articleview.php?showdetail=&id=509', 509, '1509049', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(510, 510, 't06_articleview.php?showdetail=&id=510', 510, '1509050', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(511, 511, 't06_articleview.php?showdetail=&id=511', 511, '1509051', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(512, 512, 't06_articleview.php?showdetail=&id=512', 512, '1509052', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(513, 513, 't06_articleview.php?showdetail=&id=513', 513, '1509053', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(514, 514, 't06_articleview.php?showdetail=&id=514', 514, '1509054', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(515, 515, 't06_articleview.php?showdetail=&id=515', 515, '1509055', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(516, 516, 't06_articleview.php?showdetail=&id=516', 516, '1509056', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(517, 517, 't06_articleview.php?showdetail=&id=517', 517, '1509057', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(518, 518, 't06_articleview.php?showdetail=&id=518', 518, '1509058', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(519, 519, 't06_articleview.php?showdetail=&id=519', 519, '1509059', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(520, 520, 't06_articleview.php?showdetail=&id=520', 520, '1509060', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(521, 521, 't06_articleview.php?showdetail=&id=521', 521, '1509061', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(522, 522, 't06_articleview.php?showdetail=&id=522', 522, '1509062', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(523, 523, 't06_articleview.php?showdetail=&id=523', 523, '1509063', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(524, 524, 't06_articleview.php?showdetail=&id=524', 524, '1509064', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(525, 525, 't06_articleview.php?showdetail=&id=525', 525, '1509065', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(526, 526, 't06_articleview.php?showdetail=&id=526', 526, '1509066', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(527, 527, 't06_articleview.php?showdetail=&id=527', 527, '1509067', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(528, 528, 't06_articleview.php?showdetail=&id=528', 528, '1509068', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(529, 529, 't06_articleview.php?showdetail=&id=529', 529, '1509069', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(530, 530, 't06_articleview.php?showdetail=&id=530', 530, '1509070', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(531, 531, 't06_articleview.php?showdetail=&id=531', 531, '1509071', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(532, 532, 't06_articleview.php?showdetail=&id=532', 532, '1509072', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(533, 533, 't06_articleview.php?showdetail=&id=533', 533, '1509073', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(534, 534, 't06_articleview.php?showdetail=&id=534', 534, '1509074', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(535, 535, 't06_articleview.php?showdetail=&id=535', 535, '1509075', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(536, 536, 't06_articleview.php?showdetail=&id=536', 536, '1509076', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(537, 537, 't06_articleview.php?showdetail=&id=537', 537, '1509077', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(538, 538, 't06_articleview.php?showdetail=&id=538', 538, '1509078', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(539, 539, 't06_articleview.php?showdetail=&id=539', 539, '1509079', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(540, 540, 't06_articleview.php?showdetail=&id=540', 540, '1509080', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(541, 541, 't06_articleview.php?showdetail=&id=541', 541, '1509081', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(542, 542, 't06_articleview.php?showdetail=&id=542', 542, '1509082', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(543, 543, 't06_articleview.php?showdetail=&id=543', 543, '1509083', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(544, 544, 't06_articleview.php?showdetail=&id=544', 544, '1509084', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(545, 545, 't06_articleview.php?showdetail=&id=545', 545, '1509085', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(546, 546, 't06_articleview.php?showdetail=&id=546', 546, '1509086', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(547, 547, 't06_articleview.php?showdetail=&id=547', 547, '1509087', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(548, 548, 't06_articleview.php?showdetail=&id=548', 548, '1509088', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(549, 549, 't06_articleview.php?showdetail=&id=549', 549, '1509089', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(550, 550, 't06_articleview.php?showdetail=&id=550', 550, '1509090', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(551, 551, 't06_articleview.php?showdetail=&id=551', 551, '1509091', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(552, 552, 't06_articleview.php?showdetail=&id=552', 552, '1509092', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(553, 553, 't06_articleview.php?showdetail=&id=553', 553, '1509093', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(554, 554, 't06_articleview.php?showdetail=&id=554', 554, '1509094', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(555, 555, 't06_articleview.php?showdetail=&id=555', 555, '1509095', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(556, 556, 't06_articleview.php?showdetail=&id=556', 556, '1509096', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(557, 557, 't06_articleview.php?showdetail=&id=557', 557, '1509097', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(558, 558, 't06_articleview.php?showdetail=&id=558', 558, '1509098', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(559, 559, 't06_articleview.php?showdetail=&id=559', 559, '1509099', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(560, 560, 't06_articleview.php?showdetail=&id=560', 560, '1509100', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(561, 561, 't06_articleview.php?showdetail=&id=561', 561, '1509101', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(562, 562, 't06_articleview.php?showdetail=&id=562', 562, '1509102', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(563, 563, 't06_articleview.php?showdetail=&id=563', 563, '1509103', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(564, 564, 't06_articleview.php?showdetail=&id=564', 564, '1509104', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(565, 565, 't06_articleview.php?showdetail=&id=565', 565, '1509105', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(566, 566, 't06_articleview.php?showdetail=&id=566', 566, '1509106', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(567, 567, 't06_articleview.php?showdetail=&id=567', 567, '1509107', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(568, 568, 't06_articleview.php?showdetail=&id=568', 568, '1509108', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(569, 569, 't06_articleview.php?showdetail=&id=569', 569, '1509109', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(570, 570, 't06_articleview.php?showdetail=&id=570', 570, '1509110', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(571, 571, 't06_articleview.php?showdetail=&id=571', 571, '1509111', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(572, 572, 't06_articleview.php?showdetail=&id=572', 572, '1509112', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(573, 573, 't06_articleview.php?showdetail=&id=573', 573, '1509113', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(574, 574, 't06_articleview.php?showdetail=&id=574', 574, '1509114', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(575, 575, 't06_articleview.php?showdetail=&id=575', 575, '1509115', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(576, 576, 't06_articleview.php?showdetail=&id=576', 576, '1509116', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(577, 577, 't06_articleview.php?showdetail=&id=577', 577, '1509117', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(578, 578, 't06_articleview.php?showdetail=&id=578', 578, '1509118', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(579, 579, 't06_articleview.php?showdetail=&id=579', 579, '1509119', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(580, 580, 't06_articleview.php?showdetail=&id=580', 580, '1509120', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(581, 581, 't06_articleview.php?showdetail=&id=581', 581, '1509121', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(582, 582, 't06_articleview.php?showdetail=&id=582', 582, '1509122', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(583, 583, 't06_articleview.php?showdetail=&id=583', 583, '1509123', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(584, 584, 't06_articleview.php?showdetail=&id=584', 584, '1509124', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(585, 585, 't06_articleview.php?showdetail=&id=585', 585, '1509125', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(586, 586, 't06_articleview.php?showdetail=&id=586', 586, '1509126', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(587, 587, 't06_articleview.php?showdetail=&id=587', 587, '1509127', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(588, 588, 't06_articleview.php?showdetail=&id=588', 588, '1509128', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(589, 589, 't06_articleview.php?showdetail=&id=589', 589, '1509129', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(590, 590, 't06_articleview.php?showdetail=&id=590', 590, '1509130', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(591, 591, 't06_articleview.php?showdetail=&id=591', 591, '1509131', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(592, 592, 't06_articleview.php?showdetail=&id=592', 592, '1509132', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(593, 593, 't06_articleview.php?showdetail=&id=593', 593, '1509133', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(594, 594, 't06_articleview.php?showdetail=&id=594', 594, '1509134', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(595, 595, 't06_articleview.php?showdetail=&id=595', 595, '1509135', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(596, 596, 't06_articleview.php?showdetail=&id=596', 596, '1509136', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(597, 597, 't06_articleview.php?showdetail=&id=597', 597, '1509137', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(598, 598, 't06_articleview.php?showdetail=&id=598', 598, '1509138', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(599, 599, 't06_articleview.php?showdetail=&id=599', 599, '1509139', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(600, 600, 't06_articleview.php?showdetail=&id=600', 600, '1509140', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(601, 601, 't06_articleview.php?showdetail=&id=601', 601, '1509141', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(602, 602, 't06_articleview.php?showdetail=&id=602', 602, '1509142', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(603, 603, 't06_articleview.php?showdetail=&id=603', 603, '1509143', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(604, 604, 't06_articleview.php?showdetail=&id=604', 604, '1509144', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(605, 605, 't06_articleview.php?showdetail=&id=605', 605, '1509145', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(606, 606, 't06_articleview.php?showdetail=&id=606', 606, '1509146', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(607, 607, 't06_articleview.php?showdetail=&id=607', 607, '1509147', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(608, 608, 't06_articleview.php?showdetail=&id=608', 608, '1509148', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(609, 609, 't06_articleview.php?showdetail=&id=609', 609, '1509149', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(610, 610, 't06_articleview.php?showdetail=&id=610', 610, '1509150', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(611, 611, 't06_articleview.php?showdetail=&id=611', 611, '1509151', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(612, 612, 't06_articleview.php?showdetail=&id=612', 612, '1509152', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(613, 613, 't06_articleview.php?showdetail=&id=613', 613, '1509153', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(614, 614, 't06_articleview.php?showdetail=&id=614', 614, '1509154', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(615, 615, 't06_articleview.php?showdetail=&id=615', 615, '1509155', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(616, 616, 't06_articleview.php?showdetail=&id=616', 616, '1509156', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(617, 617, 't06_articleview.php?showdetail=&id=617', 617, '1509157', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(618, 618, 't06_articleview.php?showdetail=&id=618', 618, '1509158', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(619, 619, 't06_articleview.php?showdetail=&id=619', 619, '1509159', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(620, 620, 't06_articleview.php?showdetail=&id=620', 620, '1509160', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(621, 621, 't06_articleview.php?showdetail=&id=621', 621, '1509161', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(622, 622, 't06_articleview.php?showdetail=&id=622', 622, '1509162', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(623, 623, 't06_articleview.php?showdetail=&id=623', 623, '1509163', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(624, 624, 't06_articleview.php?showdetail=&id=624', 624, '1509164', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(625, 625, 't06_articleview.php?showdetail=&id=625', 625, '1509165', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(626, 626, 't06_articleview.php?showdetail=&id=626', 626, '1509166', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(627, 627, 't06_articleview.php?showdetail=&id=627', 627, '1509167', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(628, 628, 't06_articleview.php?showdetail=&id=628', 628, '1510001', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(629, 629, 't06_articleview.php?showdetail=&id=629', 629, '1510002', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(630, 630, 't06_articleview.php?showdetail=&id=630', 630, '1510003', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(631, 631, 't06_articleview.php?showdetail=&id=631', 631, '1510004', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(632, 632, 't06_articleview.php?showdetail=&id=632', 632, '1510005', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(633, 633, 't06_articleview.php?showdetail=&id=633', 633, '1510006', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(634, 634, 't06_articleview.php?showdetail=&id=634', 634, '1510007', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(635, 635, 't06_articleview.php?showdetail=&id=635', 635, '1510008', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(636, 636, 't06_articleview.php?showdetail=&id=636', 636, '1510009', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(637, 637, 't06_articleview.php?showdetail=&id=637', 637, '1510010', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(638, 638, 't06_articleview.php?showdetail=&id=638', 638, '1510011', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(639, 639, 't06_articleview.php?showdetail=&id=639', 639, '1510012', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(640, 640, 't06_articleview.php?showdetail=&id=640', 640, '1510013', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(641, 641, 't06_articleview.php?showdetail=&id=641', 641, '1510014', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(642, 642, 't06_articleview.php?showdetail=&id=642', 642, '1510015', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(643, 643, 't06_articleview.php?showdetail=&id=643', 643, '1510016', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(644, 644, 't06_articleview.php?showdetail=&id=644', 644, '1510017', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(645, 645, 't06_articleview.php?showdetail=&id=645', 645, '1510018', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(646, 646, 't06_articleview.php?showdetail=&id=646', 646, '1510019', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(647, 647, 't06_articleview.php?showdetail=&id=647', 647, '1510020', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(648, 648, 't06_articleview.php?showdetail=&id=648', 648, '1510021', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(649, 649, 't06_articleview.php?showdetail=&id=649', 649, '1510022', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(650, 650, 't06_articleview.php?showdetail=&id=650', 650, '1510023', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(651, 651, 't06_articleview.php?showdetail=&id=651', 651, '1510024', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(652, 652, 't06_articleview.php?showdetail=&id=652', 652, '1510025', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(653, 653, 't06_articleview.php?showdetail=&id=653', 653, '1510026', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(654, 654, 't06_articleview.php?showdetail=&id=654', 654, '1510027', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(655, 655, 't06_articleview.php?showdetail=&id=655', 655, '1510028', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(656, 656, 't06_articleview.php?showdetail=&id=656', 656, '1510029', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(657, 657, 't06_articleview.php?showdetail=&id=657', 657, '1510030', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(658, 658, 't06_articleview.php?showdetail=&id=658', 658, '1510031', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(659, 659, 't06_articleview.php?showdetail=&id=659', 659, '1510032', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(660, 660, 't06_articleview.php?showdetail=&id=660', 660, '1510033', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(661, 661, 't06_articleview.php?showdetail=&id=661', 661, '1510034', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00);
INSERT INTO `t13_mutasi` (`id`, `TabelID`, `Url`, `ArticleID`, `Kode`, `NoUrut`, `Tgl`, `Jam`, `Keterangan`, `NoRef`, `MasukQty`, `MasukHarga`, `KeluarQty`, `KeluarHarga`, `SaldoQty`, `SaldoHarga`) VALUES
(662, 662, 't06_articleview.php?showdetail=&id=662', 662, '1510035', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(663, 663, 't06_articleview.php?showdetail=&id=663', 663, '1510036', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(664, 664, 't06_articleview.php?showdetail=&id=664', 664, '1510037', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(665, 665, 't06_articleview.php?showdetail=&id=665', 665, '1510038', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(666, 666, 't06_articleview.php?showdetail=&id=666', 666, '1510039', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(667, 667, 't06_articleview.php?showdetail=&id=667', 667, '1510040', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(668, 668, 't06_articleview.php?showdetail=&id=668', 668, '1510041', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(669, 669, 't06_articleview.php?showdetail=&id=669', 669, '1510042', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(670, 670, 't06_articleview.php?showdetail=&id=670', 670, '1510043', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(671, 671, 't06_articleview.php?showdetail=&id=671', 671, '1510044', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(672, 672, 't06_articleview.php?showdetail=&id=672', 672, '1510045', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(673, 673, 't06_articleview.php?showdetail=&id=673', 673, '1510046', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(674, 674, 't06_articleview.php?showdetail=&id=674', 674, '1510047', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(675, 675, 't06_articleview.php?showdetail=&id=675', 675, '1510048', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(676, 676, 't06_articleview.php?showdetail=&id=676', 676, '1510049', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(677, 677, 't06_articleview.php?showdetail=&id=677', 677, '1510050', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(678, 678, 't06_articleview.php?showdetail=&id=678', 678, '1510051', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(679, 679, 't06_articleview.php?showdetail=&id=679', 679, '1510052', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(680, 680, 't06_articleview.php?showdetail=&id=680', 680, '1510053', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(681, 681, 't06_articleview.php?showdetail=&id=681', 681, '1510054', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(682, 682, 't06_articleview.php?showdetail=&id=682', 682, '1510055', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(683, 683, 't06_articleview.php?showdetail=&id=683', 683, '1510056', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(684, 684, 't06_articleview.php?showdetail=&id=684', 684, '1510057', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(685, 685, 't06_articleview.php?showdetail=&id=685', 685, '1510058', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(686, 686, 't06_articleview.php?showdetail=&id=686', 686, '1510059', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(687, 687, 't06_articleview.php?showdetail=&id=687', 687, '1510060', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(688, 688, 't06_articleview.php?showdetail=&id=688', 688, '1510061', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(689, 689, 't06_articleview.php?showdetail=&id=689', 689, '1510062', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(690, 690, 't06_articleview.php?showdetail=&id=690', 690, '1510063', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(691, 691, 't06_articleview.php?showdetail=&id=691', 691, '1510064', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(692, 692, 't06_articleview.php?showdetail=&id=692', 692, '1510065', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(693, 693, 't06_articleview.php?showdetail=&id=693', 693, '1510066', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(694, 694, 't06_articleview.php?showdetail=&id=694', 694, '1510067', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(695, 695, 't06_articleview.php?showdetail=&id=695', 695, '1510068', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(696, 696, 't06_articleview.php?showdetail=&id=696', 696, '1510069', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(697, 697, 't06_articleview.php?showdetail=&id=697', 697, '1510070', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(698, 698, 't06_articleview.php?showdetail=&id=698', 698, '1510071', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(699, 699, 't06_articleview.php?showdetail=&id=699', 699, '1510072', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(700, 700, 't06_articleview.php?showdetail=&id=700', 700, '1510073', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(701, 701, 't06_articleview.php?showdetail=&id=701', 701, '1510074', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(702, 702, 't06_articleview.php?showdetail=&id=702', 702, '1510075', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(703, 703, 't06_articleview.php?showdetail=&id=703', 703, '1510076', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(704, 704, 't06_articleview.php?showdetail=&id=704', 704, '1510077', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(705, 705, 't06_articleview.php?showdetail=&id=705', 705, '1510078', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(706, 706, 't06_articleview.php?showdetail=&id=706', 706, '1510079', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(707, 707, 't06_articleview.php?showdetail=&id=707', 707, '1510080', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(708, 708, 't06_articleview.php?showdetail=&id=708', 708, '1510081', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(709, 709, 't06_articleview.php?showdetail=&id=709', 709, '1510082', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(710, 710, 't06_articleview.php?showdetail=&id=710', 710, '1510083', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(711, 711, 't06_articleview.php?showdetail=&id=711', 711, '1510084', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(712, 712, 't06_articleview.php?showdetail=&id=712', 712, '1510085', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(713, 713, 't06_articleview.php?showdetail=&id=713', 713, '1510086', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(714, 714, 't06_articleview.php?showdetail=&id=714', 714, '1510087', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(715, 715, 't06_articleview.php?showdetail=&id=715', 715, '1510088', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(716, 716, 't06_articleview.php?showdetail=&id=716', 716, '1510089', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(717, 717, 't06_articleview.php?showdetail=&id=717', 717, '1510090', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(718, 718, 't06_articleview.php?showdetail=&id=718', 718, '1510091', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(719, 719, 't06_articleview.php?showdetail=&id=719', 719, '1510092', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(720, 720, 't06_articleview.php?showdetail=&id=720', 720, '1510093', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(721, 721, 't06_articleview.php?showdetail=&id=721', 721, '1510094', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(722, 722, 't06_articleview.php?showdetail=&id=722', 722, '1510095', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(723, 723, 't06_articleview.php?showdetail=&id=723', 723, '1510096', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(724, 724, 't06_articleview.php?showdetail=&id=724', 724, '1510097', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(725, 725, 't06_articleview.php?showdetail=&id=725', 725, '1510098', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(726, 726, 't06_articleview.php?showdetail=&id=726', 726, '1510099', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(727, 727, 't06_articleview.php?showdetail=&id=727', 727, '1510100', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(728, 728, 't06_articleview.php?showdetail=&id=728', 728, '1510101', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(729, 729, 't06_articleview.php?showdetail=&id=729', 729, '1510102', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(730, 730, 't06_articleview.php?showdetail=&id=730', 730, '1510103', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(731, 731, 't06_articleview.php?showdetail=&id=731', 731, '1510104', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(732, 732, 't06_articleview.php?showdetail=&id=732', 732, '1510105', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(733, 733, 't06_articleview.php?showdetail=&id=733', 733, '1510106', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(734, 734, 't06_articleview.php?showdetail=&id=734', 734, '1510107', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(735, 735, 't06_articleview.php?showdetail=&id=735', 735, '1510108', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(736, 736, 't06_articleview.php?showdetail=&id=736', 736, '1510109', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(737, 737, 't06_articleview.php?showdetail=&id=737', 737, '1510110', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(738, 738, 't06_articleview.php?showdetail=&id=738', 738, '1510111', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(739, 739, 't06_articleview.php?showdetail=&id=739', 739, '1510112', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(740, 740, 't06_articleview.php?showdetail=&id=740', 740, '1510113', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(741, 741, 't06_articleview.php?showdetail=&id=741', 741, '1510114', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(742, 742, 't06_articleview.php?showdetail=&id=742', 742, '1510115', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(743, 743, 't06_articleview.php?showdetail=&id=743', 743, '1510116', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(744, 744, 't06_articleview.php?showdetail=&id=744', 744, '1510117', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(745, 745, 't06_articleview.php?showdetail=&id=745', 745, '1510118', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(746, 746, 't06_articleview.php?showdetail=&id=746', 746, '1510119', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(747, 747, 't06_articleview.php?showdetail=&id=747', 747, '1510120', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(748, 748, 't06_articleview.php?showdetail=&id=748', 748, '1510121', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(749, 749, 't06_articleview.php?showdetail=&id=749', 749, '1510122', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(750, 750, 't06_articleview.php?showdetail=&id=750', 750, '1510123', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(751, 751, 't06_articleview.php?showdetail=&id=751', 751, '1510124', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(752, 752, 't06_articleview.php?showdetail=&id=752', 752, '1510125', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(753, 753, 't06_articleview.php?showdetail=&id=753', 753, '1510126', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(754, 754, 't06_articleview.php?showdetail=&id=754', 754, '1510127', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(755, 755, 't06_articleview.php?showdetail=&id=755', 755, '1510128', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(756, 756, 't06_articleview.php?showdetail=&id=756', 756, '1510129', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(757, 757, 't06_articleview.php?showdetail=&id=757', 757, '1510130', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(758, 758, 't06_articleview.php?showdetail=&id=758', 758, '1510131', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(759, 759, 't06_articleview.php?showdetail=&id=759', 759, '1510132', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(760, 760, 't06_articleview.php?showdetail=&id=760', 760, '1510133', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(761, 761, 't06_articleview.php?showdetail=&id=761', 761, '1511001', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(762, 762, 't06_articleview.php?showdetail=&id=762', 762, '1511002', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(763, 763, 't06_articleview.php?showdetail=&id=763', 763, '1511003', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(764, 764, 't06_articleview.php?showdetail=&id=764', 764, '1511004', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(765, 765, 't06_articleview.php?showdetail=&id=765', 765, '1511005', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(766, 766, 't06_articleview.php?showdetail=&id=766', 766, '1511006', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(767, 767, 't06_articleview.php?showdetail=&id=767', 767, '1511007', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(768, 768, 't06_articleview.php?showdetail=&id=768', 768, '1511008', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(769, 769, 't06_articleview.php?showdetail=&id=769', 769, '1511009', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(770, 770, 't06_articleview.php?showdetail=&id=770', 770, '1511010', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(771, 771, 't06_articleview.php?showdetail=&id=771', 771, '1511011', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(772, 772, 't06_articleview.php?showdetail=&id=772', 772, '1511012', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(773, 773, 't06_articleview.php?showdetail=&id=773', 773, '1511013', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(774, 774, 't06_articleview.php?showdetail=&id=774', 774, '1511014', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(775, 775, 't06_articleview.php?showdetail=&id=775', 775, '1511015', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(776, 776, 't06_articleview.php?showdetail=&id=776', 776, '1511016', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(777, 777, 't06_articleview.php?showdetail=&id=777', 777, '1511017', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(778, 778, 't06_articleview.php?showdetail=&id=778', 778, '1511018', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(779, 779, 't06_articleview.php?showdetail=&id=779', 779, '1511019', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(780, 780, 't06_articleview.php?showdetail=&id=780', 780, '1511020', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(781, 781, 't06_articleview.php?showdetail=&id=781', 781, '1511021', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(782, 782, 't06_articleview.php?showdetail=&id=782', 782, '1511022', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(783, 783, 't06_articleview.php?showdetail=&id=783', 783, '1511023', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(784, 784, 't06_articleview.php?showdetail=&id=784', 784, '1511024', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(785, 785, 't06_articleview.php?showdetail=&id=785', 785, '1511025', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(786, 786, 't06_articleview.php?showdetail=&id=786', 786, '1511026', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(787, 787, 't06_articleview.php?showdetail=&id=787', 787, '1511027', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(788, 788, 't06_articleview.php?showdetail=&id=788', 788, '1511028', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(789, 789, 't06_articleview.php?showdetail=&id=789', 789, '1511029', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(790, 790, 't06_articleview.php?showdetail=&id=790', 790, '1511030', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(791, 791, 't06_articleview.php?showdetail=&id=791', 791, '1511031', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(792, 792, 't06_articleview.php?showdetail=&id=792', 792, '1511032', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(793, 793, 't06_articleview.php?showdetail=&id=793', 793, '1511033', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(794, 794, 't06_articleview.php?showdetail=&id=794', 794, '1511034', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(795, 795, 't06_articleview.php?showdetail=&id=795', 795, '1511035', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(796, 796, 't06_articleview.php?showdetail=&id=796', 796, '1511036', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(797, 797, 't06_articleview.php?showdetail=&id=797', 797, '1511037', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(798, 798, 't06_articleview.php?showdetail=&id=798', 798, '1511038', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(799, 799, 't06_articleview.php?showdetail=&id=799', 799, '1511039', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(800, 800, 't06_articleview.php?showdetail=&id=800', 800, '1511040', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(801, 801, 't06_articleview.php?showdetail=&id=801', 801, '1511041', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(802, 802, 't06_articleview.php?showdetail=&id=802', 802, '1511042', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(803, 803, 't06_articleview.php?showdetail=&id=803', 803, '1511043', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(804, 804, 't06_articleview.php?showdetail=&id=804', 804, '1511044', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(805, 805, 't06_articleview.php?showdetail=&id=805', 805, '1511045', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(806, 806, 't06_articleview.php?showdetail=&id=806', 806, '1511046', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(807, 807, 't06_articleview.php?showdetail=&id=807', 807, '1511047', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(808, 808, 't06_articleview.php?showdetail=&id=808', 808, '1511048', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(809, 809, 't06_articleview.php?showdetail=&id=809', 809, '1511049', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(810, 810, 't06_articleview.php?showdetail=&id=810', 810, '1511050', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(811, 811, 't06_articleview.php?showdetail=&id=811', 811, '1511051', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(812, 812, 't06_articleview.php?showdetail=&id=812', 812, '1511052', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(813, 813, 't06_articleview.php?showdetail=&id=813', 813, '1511053', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(814, 814, 't06_articleview.php?showdetail=&id=814', 814, '1511054', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(815, 815, 't06_articleview.php?showdetail=&id=815', 815, '1511055', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(816, 816, 't06_articleview.php?showdetail=&id=816', 816, '1511056', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(817, 817, 't06_articleview.php?showdetail=&id=817', 817, '1511057', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(818, 818, 't06_articleview.php?showdetail=&id=818', 818, '1511058', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(819, 819, 't06_articleview.php?showdetail=&id=819', 819, '1511059', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(820, 820, 't06_articleview.php?showdetail=&id=820', 820, '1511060', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(821, 821, 't06_articleview.php?showdetail=&id=821', 821, '1511061', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(822, 822, 't06_articleview.php?showdetail=&id=822', 822, '1511062', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(823, 823, 't06_articleview.php?showdetail=&id=823', 823, '1511063', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(824, 824, 't06_articleview.php?showdetail=&id=824', 824, '1511064', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(825, 825, 't06_articleview.php?showdetail=&id=825', 825, '1511065', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(826, 826, 't06_articleview.php?showdetail=&id=826', 826, '1511066', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(827, 827, 't06_articleview.php?showdetail=&id=827', 827, '1511067', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(828, 828, 't06_articleview.php?showdetail=&id=828', 828, '1511068', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(829, 829, 't06_articleview.php?showdetail=&id=829', 829, '1511069', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(830, 830, 't06_articleview.php?showdetail=&id=830', 830, '1511070', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(831, 831, 't06_articleview.php?showdetail=&id=831', 831, '1511071', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(832, 832, 't06_articleview.php?showdetail=&id=832', 832, '1511072', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(833, 833, 't06_articleview.php?showdetail=&id=833', 833, '1511073', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(834, 834, 't06_articleview.php?showdetail=&id=834', 834, '1511074', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(835, 835, 't06_articleview.php?showdetail=&id=835', 835, '1511075', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(836, 836, 't06_articleview.php?showdetail=&id=836', 836, '1511076', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(837, 837, 't06_articleview.php?showdetail=&id=837', 837, '1511077', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(838, 838, 't06_articleview.php?showdetail=&id=838', 838, '1511078', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(839, 839, 't06_articleview.php?showdetail=&id=839', 839, '1511079', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(840, 840, 't06_articleview.php?showdetail=&id=840', 840, '1511080', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(841, 841, 't06_articleview.php?showdetail=&id=841', 841, '1511081', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(842, 842, 't06_articleview.php?showdetail=&id=842', 842, '1511082', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(843, 843, 't06_articleview.php?showdetail=&id=843', 843, '1511083', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(844, 844, 't06_articleview.php?showdetail=&id=844', 844, '1511084', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(845, 845, 't06_articleview.php?showdetail=&id=845', 845, '1511085', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(846, 846, 't06_articleview.php?showdetail=&id=846', 846, '1511086', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(847, 847, 't06_articleview.php?showdetail=&id=847', 847, '1512001', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(848, 848, 't06_articleview.php?showdetail=&id=848', 848, '1512002', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(849, 849, 't06_articleview.php?showdetail=&id=849', 849, '1512003', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(850, 850, 't06_articleview.php?showdetail=&id=850', 850, '1512004', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(851, 851, 't06_articleview.php?showdetail=&id=851', 851, '1512005', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(852, 852, 't06_articleview.php?showdetail=&id=852', 852, '1512006', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(853, 853, 't06_articleview.php?showdetail=&id=853', 853, '1512007', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(854, 854, 't06_articleview.php?showdetail=&id=854', 854, '1512008', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(855, 855, 't06_articleview.php?showdetail=&id=855', 855, '1512009', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(856, 856, 't06_articleview.php?showdetail=&id=856', 856, '1512010', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(857, 857, 't06_articleview.php?showdetail=&id=857', 857, '1512011', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(858, 858, 't06_articleview.php?showdetail=&id=858', 858, '1512012', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(859, 859, 't06_articleview.php?showdetail=&id=859', 859, '1512013', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(860, 860, 't06_articleview.php?showdetail=&id=860', 860, '1512014', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(861, 861, 't06_articleview.php?showdetail=&id=861', 861, '1512015', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(862, 862, 't06_articleview.php?showdetail=&id=862', 862, '1512016', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(863, 863, 't06_articleview.php?showdetail=&id=863', 863, '1512017', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(864, 864, 't06_articleview.php?showdetail=&id=864', 864, '1512018', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(865, 865, 't06_articleview.php?showdetail=&id=865', 865, '1512019', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(866, 866, 't06_articleview.php?showdetail=&id=866', 866, '1512020', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(867, 867, 't06_articleview.php?showdetail=&id=867', 867, '1512021', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(868, 868, 't06_articleview.php?showdetail=&id=868', 868, '1512022', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(869, 869, 't06_articleview.php?showdetail=&id=869', 869, '1512023', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(870, 870, 't06_articleview.php?showdetail=&id=870', 870, '1512024', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(871, 871, 't06_articleview.php?showdetail=&id=871', 871, '1512025', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(872, 872, 't06_articleview.php?showdetail=&id=872', 872, '1512026', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(873, 873, 't06_articleview.php?showdetail=&id=873', 873, '1512027', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(874, 874, 't06_articleview.php?showdetail=&id=874', 874, '1512028', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(875, 875, 't06_articleview.php?showdetail=&id=875', 875, '1512029', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(876, 876, 't06_articleview.php?showdetail=&id=876', 876, '1512030', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(877, 877, 't06_articleview.php?showdetail=&id=877', 877, '1512031', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(878, 878, 't06_articleview.php?showdetail=&id=878', 878, '1512032', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(879, 879, 't06_articleview.php?showdetail=&id=879', 879, '1512033', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(880, 880, 't06_articleview.php?showdetail=&id=880', 880, '1512034', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(881, 881, 't06_articleview.php?showdetail=&id=881', 881, '1512035', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(882, 882, 't06_articleview.php?showdetail=&id=882', 882, '1512036', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(883, 883, 't06_articleview.php?showdetail=&id=883', 883, '1512037', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(884, 884, 't06_articleview.php?showdetail=&id=884', 884, '1512038', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(885, 885, 't06_articleview.php?showdetail=&id=885', 885, '1512039', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(886, 886, 't06_articleview.php?showdetail=&id=886', 886, '1512040', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(887, 887, 't06_articleview.php?showdetail=&id=887', 887, '1512041', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(888, 888, 't06_articleview.php?showdetail=&id=888', 888, '1512042', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(889, 889, 't06_articleview.php?showdetail=&id=889', 889, '1512043', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(890, 890, 't06_articleview.php?showdetail=&id=890', 890, '1512044', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(891, 891, 't06_articleview.php?showdetail=&id=891', 891, '1512045', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(892, 892, 't06_articleview.php?showdetail=&id=892', 892, '1512046', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(893, 893, 't06_articleview.php?showdetail=&id=893', 893, '1512047', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(894, 894, 't06_articleview.php?showdetail=&id=894', 894, '1512048', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(895, 895, 't06_articleview.php?showdetail=&id=895', 895, '1512049', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(896, 896, 't06_articleview.php?showdetail=&id=896', 896, '1512050', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(897, 897, 't06_articleview.php?showdetail=&id=897', 897, '1512051', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(898, 898, 't06_articleview.php?showdetail=&id=898', 898, '1512052', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(899, 899, 't06_articleview.php?showdetail=&id=899', 899, '1512053', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(900, 900, 't06_articleview.php?showdetail=&id=900', 900, '1512054', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(901, 901, 't06_articleview.php?showdetail=&id=901', 901, '1512055', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(902, 902, 't06_articleview.php?showdetail=&id=902', 902, '1512056', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(903, 903, 't06_articleview.php?showdetail=&id=903', 903, '1512057', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(904, 904, 't06_articleview.php?showdetail=&id=904', 904, '1512058', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(905, 905, 't06_articleview.php?showdetail=&id=905', 905, '1512059', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(906, 906, 't06_articleview.php?showdetail=&id=906', 906, '1512060', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(907, 907, 't06_articleview.php?showdetail=&id=907', 907, '1512061', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(908, 908, 't06_articleview.php?showdetail=&id=908', 908, '1512062', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(909, 909, 't06_articleview.php?showdetail=&id=909', 909, '1512063', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(910, 910, 't06_articleview.php?showdetail=&id=910', 910, '1512064', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(911, 911, 't06_articleview.php?showdetail=&id=911', 911, '1512065', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(912, 912, 't06_articleview.php?showdetail=&id=912', 912, '1512066', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(913, 913, 't06_articleview.php?showdetail=&id=913', 913, '1512067', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(914, 914, 't06_articleview.php?showdetail=&id=914', 914, '1512068', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(915, 915, 't06_articleview.php?showdetail=&id=915', 915, '1512069', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(916, 916, 't06_articleview.php?showdetail=&id=916', 916, '1512070', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(917, 917, 't06_articleview.php?showdetail=&id=917', 917, '1512071', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(918, 918, 't06_articleview.php?showdetail=&id=918', 918, '1512072', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(919, 919, 't06_articleview.php?showdetail=&id=919', 919, '1512073', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(920, 920, 't06_articleview.php?showdetail=&id=920', 920, '1512074', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(921, 921, 't06_articleview.php?showdetail=&id=921', 921, '1512075', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(922, 922, 't06_articleview.php?showdetail=&id=922', 922, '1512076', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(923, 923, 't06_articleview.php?showdetail=&id=923', 923, '1512077', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(924, 924, 't06_articleview.php?showdetail=&id=924', 924, '1512078', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(925, 925, 't06_articleview.php?showdetail=&id=925', 925, '1513001', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(926, 926, 't06_articleview.php?showdetail=&id=926', 926, '1513002', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(927, 927, 't06_articleview.php?showdetail=&id=927', 927, '1513003', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(928, 928, 't06_articleview.php?showdetail=&id=928', 928, '1513004', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(929, 929, 't06_articleview.php?showdetail=&id=929', 929, '1513005', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(930, 930, 't06_articleview.php?showdetail=&id=930', 930, '1513006', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(931, 931, 't06_articleview.php?showdetail=&id=931', 931, '1513007', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(932, 932, 't06_articleview.php?showdetail=&id=932', 932, '1513008', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(933, 933, 't06_articleview.php?showdetail=&id=933', 933, '1513009', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(934, 934, 't06_articleview.php?showdetail=&id=934', 934, '1513010', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(935, 935, 't06_articleview.php?showdetail=&id=935', 935, '1513011', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(936, 936, 't06_articleview.php?showdetail=&id=936', 936, '1513012', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(937, 937, 't06_articleview.php?showdetail=&id=937', 937, '1513013', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(938, 938, 't06_articleview.php?showdetail=&id=938', 938, '1513014', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(939, 939, 't06_articleview.php?showdetail=&id=939', 939, '1513015', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(940, 940, 't06_articleview.php?showdetail=&id=940', 940, '1513016', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(941, 941, 't06_articleview.php?showdetail=&id=941', 941, '1513017', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(942, 942, 't06_articleview.php?showdetail=&id=942', 942, '1513018', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(943, 943, 't06_articleview.php?showdetail=&id=943', 943, '1513019', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(944, 944, 't06_articleview.php?showdetail=&id=944', 944, '1513020', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(945, 945, 't06_articleview.php?showdetail=&id=945', 945, '1513021', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(946, 946, 't06_articleview.php?showdetail=&id=946', 946, '1513022', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(947, 947, 't06_articleview.php?showdetail=&id=947', 947, '1514001', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(948, 948, 't06_articleview.php?showdetail=&id=948', 948, '1514002', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(949, 949, 't06_articleview.php?showdetail=&id=949', 949, '1514003', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(950, 950, 't06_articleview.php?showdetail=&id=950', 950, '1514004', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(951, 951, 't06_articleview.php?showdetail=&id=951', 951, '1514005', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(952, 952, 't06_articleview.php?showdetail=&id=952', 952, '1514006', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(953, 953, 't06_articleview.php?showdetail=&id=953', 953, '1514007', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(954, 954, 't06_articleview.php?showdetail=&id=954', 954, '1514008', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(955, 955, 't06_articleview.php?showdetail=&id=955', 955, '1514009', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(956, 956, 't06_articleview.php?showdetail=&id=956', 956, '1514010', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(957, 957, 't06_articleview.php?showdetail=&id=957', 957, '1514011', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(958, 958, 't06_articleview.php?showdetail=&id=958', 958, '1514012', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(959, 959, 't06_articleview.php?showdetail=&id=959', 959, '1514013', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(960, 960, 't06_articleview.php?showdetail=&id=960', 960, '1514014', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(961, 961, 't06_articleview.php?showdetail=&id=961', 961, '1514015', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(962, 962, 't06_articleview.php?showdetail=&id=962', 962, '1514016', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(963, 963, 't06_articleview.php?showdetail=&id=963', 963, '1514017', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(964, 964, 't06_articleview.php?showdetail=&id=964', 964, '1514018', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(965, 965, 't06_articleview.php?showdetail=&id=965', 965, '1514019', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(966, 966, 't06_articleview.php?showdetail=&id=966', 966, '1514020', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(967, 967, 't06_articleview.php?showdetail=&id=967', 967, '1514021', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(968, 968, 't06_articleview.php?showdetail=&id=968', 968, '1514022', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(969, 969, 't06_articleview.php?showdetail=&id=969', 969, '1514023', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(970, 970, 't06_articleview.php?showdetail=&id=970', 970, '1514024', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(971, 971, 't06_articleview.php?showdetail=&id=971', 971, '1514025', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(972, 972, 't06_articleview.php?showdetail=&id=972', 972, '1514026', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(973, 973, 't06_articleview.php?showdetail=&id=973', 973, '1514027', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(974, 974, 't06_articleview.php?showdetail=&id=974', 974, '1514028', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(975, 975, 't06_articleview.php?showdetail=&id=975', 975, '1514029', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(976, 976, 't06_articleview.php?showdetail=&id=976', 976, '1514030', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(977, 977, 't06_articleview.php?showdetail=&id=977', 977, '1515001', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(978, 978, 't06_articleview.php?showdetail=&id=978', 978, '1515002', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(979, 979, 't06_articleview.php?showdetail=&id=979', 979, '1515003', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(980, 980, 't06_articleview.php?showdetail=&id=980', 980, '1515004', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(981, 981, 't06_articleview.php?showdetail=&id=981', 981, '1515005', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(982, 982, 't06_articleview.php?showdetail=&id=982', 982, '1515006', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(983, 983, 't06_articleview.php?showdetail=&id=983', 983, '1515007', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(984, 984, 't06_articleview.php?showdetail=&id=984', 984, '1515008', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(985, 985, 't06_articleview.php?showdetail=&id=985', 985, '1515009', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(986, 986, 't06_articleview.php?showdetail=&id=986', 986, '1515010', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(987, 987, 't06_articleview.php?showdetail=&id=987', 987, '1515011', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(988, 988, 't06_articleview.php?showdetail=&id=988', 988, '1515012', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(989, 989, 't06_articleview.php?showdetail=&id=989', 989, '1515013', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(990, 990, 't06_articleview.php?showdetail=&id=990', 990, '1515014', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00);
INSERT INTO `t13_mutasi` (`id`, `TabelID`, `Url`, `ArticleID`, `Kode`, `NoUrut`, `Tgl`, `Jam`, `Keterangan`, `NoRef`, `MasukQty`, `MasukHarga`, `KeluarQty`, `KeluarHarga`, `SaldoQty`, `SaldoHarga`) VALUES
(991, 991, 't06_articleview.php?showdetail=&id=991', 991, '1515015', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(992, 992, 't06_articleview.php?showdetail=&id=992', 992, '1515016', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(993, 993, 't06_articleview.php?showdetail=&id=993', 993, '1515017', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(994, 994, 't06_articleview.php?showdetail=&id=994', 994, '1515018', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(995, 995, 't06_articleview.php?showdetail=&id=995', 995, '1515019', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(996, 996, 't06_articleview.php?showdetail=&id=996', 996, '1515020', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(997, 997, 't06_articleview.php?showdetail=&id=997', 997, '1515021', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(998, 998, 't06_articleview.php?showdetail=&id=998', 998, '1515022', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(999, 999, 't06_articleview.php?showdetail=&id=999', 999, '1515023', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1000, 1000, 't06_articleview.php?showdetail=&id=1000', 1000, '1515024', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1001, 1001, 't06_articleview.php?showdetail=&id=1001', 1001, '1515025', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1002, 1002, 't06_articleview.php?showdetail=&id=1002', 1002, '1515026', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1003, 1003, 't06_articleview.php?showdetail=&id=1003', 1003, '1515027', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1004, 1004, 't06_articleview.php?showdetail=&id=1004', 1004, '1515028', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1005, 1005, 't06_articleview.php?showdetail=&id=1005', 1005, '1515029', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1006, 1006, 't06_articleview.php?showdetail=&id=1006', 1006, '1515030', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1007, 1007, 't06_articleview.php?showdetail=&id=1007', 1007, '1515031', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1008, 1008, 't06_articleview.php?showdetail=&id=1008', 1008, '1515032', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1009, 1009, 't06_articleview.php?showdetail=&id=1009', 1009, '1515033', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1010, 1010, 't06_articleview.php?showdetail=&id=1010', 1010, '1515034', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1011, 1011, 't06_articleview.php?showdetail=&id=1011', 1011, '1515035', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1012, 1012, 't06_articleview.php?showdetail=&id=1012', 1012, '1515036', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1013, 1013, 't06_articleview.php?showdetail=&id=1013', 1013, '1515037', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1014, 1014, 't06_articleview.php?showdetail=&id=1014', 1014, '1515038', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1015, 1015, 't06_articleview.php?showdetail=&id=1015', 1015, '1515039', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1016, 1016, 't06_articleview.php?showdetail=&id=1016', 1016, '1515040', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1017, 1017, 't06_articleview.php?showdetail=&id=1017', 1017, '1515041', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1018, 1018, 't06_articleview.php?showdetail=&id=1018', 1018, '1515042', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1019, 1019, 't06_articleview.php?showdetail=&id=1019', 1019, '1515043', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1020, 1020, 't06_articleview.php?showdetail=&id=1020', 1020, '1515044', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1021, 1021, 't06_articleview.php?showdetail=&id=1021', 1021, '1515045', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1022, 1022, 't06_articleview.php?showdetail=&id=1022', 1022, '1515046', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1023, 1023, 't06_articleview.php?showdetail=&id=1023', 1023, '1515047', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1024, 1024, 't06_articleview.php?showdetail=&id=1024', 1024, '1515048', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1025, 1025, 't06_articleview.php?showdetail=&id=1025', 1025, '1515049', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1026, 1026, 't06_articleview.php?showdetail=&id=1026', 1026, '1515050', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1027, 1027, 't06_articleview.php?showdetail=&id=1027', 1027, '1515051', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1028, 1028, 't06_articleview.php?showdetail=&id=1028', 1028, '1515052', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1029, 1029, 't06_articleview.php?showdetail=&id=1029', 1029, '1515053', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1030, 1030, 't06_articleview.php?showdetail=&id=1030', 1030, '1515054', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1031, 1031, 't06_articleview.php?showdetail=&id=1031', 1031, '1515055', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1032, 1032, 't06_articleview.php?showdetail=&id=1032', 1032, '1515056', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1033, 1033, 't06_articleview.php?showdetail=&id=1033', 1033, '1515057', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1034, 1034, 't06_articleview.php?showdetail=&id=1034', 1034, '1515058', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1035, 1035, 't06_articleview.php?showdetail=&id=1035', 1035, '1515059', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1036, 1036, 't06_articleview.php?showdetail=&id=1036', 1036, '1515060', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1037, 1037, 't06_articleview.php?showdetail=&id=1037', 1037, '1515061', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1038, 1038, 't06_articleview.php?showdetail=&id=1038', 1038, '1515062', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1039, 1039, 't06_articleview.php?showdetail=&id=1039', 1039, '1515063', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1040, 1040, 't06_articleview.php?showdetail=&id=1040', 1040, '1515064', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1041, 1041, 't06_articleview.php?showdetail=&id=1041', 1041, '1515065', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1042, 1042, 't06_articleview.php?showdetail=&id=1042', 1042, '1515066', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1043, 1043, 't06_articleview.php?showdetail=&id=1043', 1043, '1515067', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1044, 1044, 't06_articleview.php?showdetail=&id=1044', 1044, '1515068', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1045, 1045, 't06_articleview.php?showdetail=&id=1045', 1045, '1515069', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1046, 1046, 't06_articleview.php?showdetail=&id=1046', 1046, '1515070', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1047, 1047, 't06_articleview.php?showdetail=&id=1047', 1047, '1515071', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1048, 1048, 't06_articleview.php?showdetail=&id=1048', 1048, '1515072', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1049, 1049, 't06_articleview.php?showdetail=&id=1049', 1049, '1515073', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1050, 1050, 't06_articleview.php?showdetail=&id=1050', 1050, '1515074', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1051, 1051, 't06_articleview.php?showdetail=&id=1051', 1051, '1515075', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1052, 1052, 't06_articleview.php?showdetail=&id=1052', 1052, '1515076', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1053, 1053, 't06_articleview.php?showdetail=&id=1053', 1053, '1515077', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1054, 1054, 't06_articleview.php?showdetail=&id=1054', 1054, '1515078', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1055, 1055, 't06_articleview.php?showdetail=&id=1055', 1055, '1515079', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1056, 1056, 't06_articleview.php?showdetail=&id=1056', 1056, '1515080', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1057, 1057, 't06_articleview.php?showdetail=&id=1057', 1057, '1515081', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1058, 1058, 't06_articleview.php?showdetail=&id=1058', 1058, '1515082', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1059, 1059, 't06_articleview.php?showdetail=&id=1059', 1059, '1515083', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1060, 1060, 't06_articleview.php?showdetail=&id=1060', 1060, '1515084', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1061, 1061, 't06_articleview.php?showdetail=&id=1061', 1061, '1515085', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1062, 1062, 't06_articleview.php?showdetail=&id=1062', 1062, '1515086', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1063, 1063, 't06_articleview.php?showdetail=&id=1063', 1063, '1515087', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1064, 1064, 't06_articleview.php?showdetail=&id=1064', 1064, '1515088', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1065, 1065, 't06_articleview.php?showdetail=&id=1065', 1065, '1515089', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1066, 1066, 't06_articleview.php?showdetail=&id=1066', 1066, '1515090', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1067, 1067, 't06_articleview.php?showdetail=&id=1067', 1067, '1515091', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1068, 1068, 't06_articleview.php?showdetail=&id=1068', 1068, '2601001', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1069, 1069, 't06_articleview.php?showdetail=&id=1069', 1069, '2601002', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1070, 1070, 't06_articleview.php?showdetail=&id=1070', 1070, '2601003', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1071, 1071, 't06_articleview.php?showdetail=&id=1071', 1071, '2601004', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1072, 1072, 't06_articleview.php?showdetail=&id=1072', 1072, '2601005', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1073, 1073, 't06_articleview.php?showdetail=&id=1073', 1073, '2601006', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1074, 1074, 't06_articleview.php?showdetail=&id=1074', 1074, '2601007', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1075, 1075, 't06_articleview.php?showdetail=&id=1075', 1075, '2601008', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1076, 1076, 't06_articleview.php?showdetail=&id=1076', 1076, '2601009', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1077, 1077, 't06_articleview.php?showdetail=&id=1077', 1077, '2601010', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1078, 1078, 't06_articleview.php?showdetail=&id=1078', 1078, '2601011', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1079, 1079, 't06_articleview.php?showdetail=&id=1079', 1079, '2602001', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1080, 1080, 't06_articleview.php?showdetail=&id=1080', 1080, '2602002', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1081, 1081, 't06_articleview.php?showdetail=&id=1081', 1081, '2602003', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1082, 1082, 't06_articleview.php?showdetail=&id=1082', 1082, '2602004', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1083, 1083, 't06_articleview.php?showdetail=&id=1083', 1083, '2602005', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1084, 1084, 't06_articleview.php?showdetail=&id=1084', 1084, '2602006', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1085, 1085, 't06_articleview.php?showdetail=&id=1085', 1085, '2602007', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1086, 1086, 't06_articleview.php?showdetail=&id=1086', 1086, '2602008', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1087, 1087, 't06_articleview.php?showdetail=&id=1087', 1087, '2602009', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1088, 1088, 't06_articleview.php?showdetail=&id=1088', 1088, '2602010', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1089, 1089, 't06_articleview.php?showdetail=&id=1089', 1089, '2602011', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1090, 1090, 't06_articleview.php?showdetail=&id=1090', 1090, '2602012', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1091, 1091, 't06_articleview.php?showdetail=&id=1091', 1091, '2602013', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1092, 1092, 't06_articleview.php?showdetail=&id=1092', 1092, '2602014', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1093, 1093, 't06_articleview.php?showdetail=&id=1093', 1093, '2602015', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1094, 1094, 't06_articleview.php?showdetail=&id=1094', 1094, '2602016', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1095, 1095, 't06_articleview.php?showdetail=&id=1095', 1095, '2602017', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1096, 1096, 't06_articleview.php?showdetail=&id=1096', 1096, '2602018', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1097, 1097, 't06_articleview.php?showdetail=&id=1097', 1097, '2602019', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1098, 1098, 't06_articleview.php?showdetail=&id=1098', 1098, '2602020', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1099, 1099, 't06_articleview.php?showdetail=&id=1099', 1099, '2602021', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1100, 1100, 't06_articleview.php?showdetail=&id=1100', 1100, '2602022', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1101, 1101, 't06_articleview.php?showdetail=&id=1101', 1101, '2602023', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1102, 1102, 't06_articleview.php?showdetail=&id=1102', 1102, '2602024', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1103, 1103, 't06_articleview.php?showdetail=&id=1103', 1103, '2602025', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1104, 1104, 't06_articleview.php?showdetail=&id=1104', 1104, '2602026', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1105, 1105, 't06_articleview.php?showdetail=&id=1105', 1105, '2602027', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1106, 1106, 't06_articleview.php?showdetail=&id=1106', 1106, '2602028', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1107, 1107, 't06_articleview.php?showdetail=&id=1107', 1107, '2602029', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1108, 1108, 't06_articleview.php?showdetail=&id=1108', 1108, '2602030', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1109, 1109, 't06_articleview.php?showdetail=&id=1109', 1109, '2602031', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1110, 1110, 't06_articleview.php?showdetail=&id=1110', 1110, '2602032', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1111, 1111, 't06_articleview.php?showdetail=&id=1111', 1111, '2602033', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1112, 1112, 't06_articleview.php?showdetail=&id=1112', 1112, '2602034', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1113, 1113, 't06_articleview.php?showdetail=&id=1113', 1113, '2602035', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1114, 1114, 't06_articleview.php?showdetail=&id=1114', 1114, '2602036', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1115, 1115, 't06_articleview.php?showdetail=&id=1115', 1115, '2603001', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1116, 1116, 't06_articleview.php?showdetail=&id=1116', 1116, '2603002', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1117, 1117, 't06_articleview.php?showdetail=&id=1117', 1117, '2603003', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1118, 1118, 't06_articleview.php?showdetail=&id=1118', 1118, '2603004', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1119, 1119, 't06_articleview.php?showdetail=&id=1119', 1119, '2603005', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1120, 1120, 't06_articleview.php?showdetail=&id=1120', 1120, '2603006', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1121, 1121, 't06_articleview.php?showdetail=&id=1121', 1121, '2603007', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1122, 1122, 't06_articleview.php?showdetail=&id=1122', 1122, '2603008', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1123, 1123, 't06_articleview.php?showdetail=&id=1123', 1123, '2603009', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1124, 1124, 't06_articleview.php?showdetail=&id=1124', 1124, '2603010', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1125, 1125, 't06_articleview.php?showdetail=&id=1125', 1125, '2603011', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1126, 1126, 't06_articleview.php?showdetail=&id=1126', 1126, '2603012', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1127, 1127, 't06_articleview.php?showdetail=&id=1127', 1127, '2603013', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1128, 1128, 't06_articleview.php?showdetail=&id=1128', 1128, '2603014', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1129, 1129, 't06_articleview.php?showdetail=&id=1129', 1129, '2603015', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1130, 1130, 't06_articleview.php?showdetail=&id=1130', 1130, '2603016', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1131, 1131, 't06_articleview.php?showdetail=&id=1131', 1131, '2603017', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1132, 1132, 't06_articleview.php?showdetail=&id=1132', 1132, '2603018', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1133, 1133, 't06_articleview.php?showdetail=&id=1133', 1133, '2603019', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1134, 1134, 't06_articleview.php?showdetail=&id=1134', 1134, '2603020', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1135, 1135, 't06_articleview.php?showdetail=&id=1135', 1135, '2603021', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1136, 1136, 't06_articleview.php?showdetail=&id=1136', 1136, '2603022', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1137, 1137, 't06_articleview.php?showdetail=&id=1137', 1137, '2603023', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1138, 1138, 't06_articleview.php?showdetail=&id=1138', 1138, '2603024', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1139, 1139, 't06_articleview.php?showdetail=&id=1139', 1139, '2603025', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1140, 1140, 't06_articleview.php?showdetail=&id=1140', 1140, '2603026', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1141, 1141, 't06_articleview.php?showdetail=&id=1141', 1141, '2603027', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1142, 1142, 't06_articleview.php?showdetail=&id=1142', 1142, '2603028', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1143, 1143, 't06_articleview.php?showdetail=&id=1143', 1143, '2603029', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1144, 1144, 't06_articleview.php?showdetail=&id=1144', 1144, '2603030', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1145, 1145, 't06_articleview.php?showdetail=&id=1145', 1145, '2603031', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1146, 1146, 't06_articleview.php?showdetail=&id=1146', 1146, '2603032', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1147, 1147, 't06_articleview.php?showdetail=&id=1147', 1147, '2603033', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1148, 1148, 't06_articleview.php?showdetail=&id=1148', 1148, '2603034', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1149, 1149, 't06_articleview.php?showdetail=&id=1149', 1149, '2603035', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1150, 1150, 't06_articleview.php?showdetail=&id=1150', 1150, '2603036', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1151, 1151, 't06_articleview.php?showdetail=&id=1151', 1151, '2603037', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1152, 1152, 't06_articleview.php?showdetail=&id=1152', 1152, '2603038', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1153, 1153, 't06_articleview.php?showdetail=&id=1153', 1153, '2603039', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1154, 1154, 't06_articleview.php?showdetail=&id=1154', 1154, '2603040', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1155, 1155, 't06_articleview.php?showdetail=&id=1155', 1155, '2603041', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1156, 1156, 't06_articleview.php?showdetail=&id=1156', 1156, '2603042', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1157, 1157, 't06_articleview.php?showdetail=&id=1157', 1157, '2603043', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1158, 1158, 't06_articleview.php?showdetail=&id=1158', 1158, '2603044', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1159, 1159, 't06_articleview.php?showdetail=&id=1159', 1159, '2603045', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1160, 1160, 't06_articleview.php?showdetail=&id=1160', 1160, '2603046', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1161, 1161, 't06_articleview.php?showdetail=&id=1161', 1161, '2603047', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1162, 1162, 't06_articleview.php?showdetail=&id=1162', 1162, '2603048', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1163, 1163, 't06_articleview.php?showdetail=&id=1163', 1163, '2604001', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1164, 1164, 't06_articleview.php?showdetail=&id=1164', 1164, '2604002', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1165, 1165, 't06_articleview.php?showdetail=&id=1165', 1165, '2604003', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1166, 1166, 't06_articleview.php?showdetail=&id=1166', 1166, '2604004', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1167, 1167, 't06_articleview.php?showdetail=&id=1167', 1167, '2604005', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1168, 1168, 't06_articleview.php?showdetail=&id=1168', 1168, '2604006', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1169, 1169, 't06_articleview.php?showdetail=&id=1169', 1169, '2604007', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1170, 1170, 't06_articleview.php?showdetail=&id=1170', 1170, '2604008', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1171, 1171, 't06_articleview.php?showdetail=&id=1171', 1171, '2604009', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1172, 1172, 't06_articleview.php?showdetail=&id=1172', 1172, '2604010', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1173, 1173, 't06_articleview.php?showdetail=&id=1173', 1173, '2604011', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1174, 1174, 't06_articleview.php?showdetail=&id=1174', 1174, '2604012', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1175, 1175, 't06_articleview.php?showdetail=&id=1175', 1175, '2604013', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1176, 1176, 't06_articleview.php?showdetail=&id=1176', 1176, '2604014', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1177, 1177, 't06_articleview.php?showdetail=&id=1177', 1177, '2604015', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1178, 1178, 't06_articleview.php?showdetail=&id=1178', 1178, '2604016', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1179, 1179, 't06_articleview.php?showdetail=&id=1179', 1179, '2604017', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1180, 1180, 't06_articleview.php?showdetail=&id=1180', 1180, '2604018', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1181, 1181, 't06_articleview.php?showdetail=&id=1181', 1181, '2604019', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1182, 1182, 't06_articleview.php?showdetail=&id=1182', 1182, '2604020', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1183, 1183, 't06_articleview.php?showdetail=&id=1183', 1183, '2604021', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1184, 1184, 't06_articleview.php?showdetail=&id=1184', 1184, '2604022', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1185, 1185, 't06_articleview.php?showdetail=&id=1185', 1185, '2604023', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1186, 1186, 't06_articleview.php?showdetail=&id=1186', 1186, '2604024', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1187, 1187, 't06_articleview.php?showdetail=&id=1187', 1187, '2604025', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1188, 1188, 't06_articleview.php?showdetail=&id=1188', 1188, '2604026', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1189, 1189, 't06_articleview.php?showdetail=&id=1189', 1189, '2604027', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1190, 1190, 't06_articleview.php?showdetail=&id=1190', 1190, '2604028', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1191, 1191, 't06_articleview.php?showdetail=&id=1191', 1191, '2605001', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1192, 1192, 't06_articleview.php?showdetail=&id=1192', 1192, '2605002', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1193, 1193, 't06_articleview.php?showdetail=&id=1193', 1193, '2605003', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1194, 1194, 't06_articleview.php?showdetail=&id=1194', 1194, '2605004', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1195, 1195, 't06_articleview.php?showdetail=&id=1195', 1195, '2605005', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1196, 1196, 't06_articleview.php?showdetail=&id=1196', 1196, '2605006', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1197, 1197, 't06_articleview.php?showdetail=&id=1197', 1197, '2605007', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1198, 1198, 't06_articleview.php?showdetail=&id=1198', 1198, '2605008', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1199, 1199, 't06_articleview.php?showdetail=&id=1199', 1199, '2605009', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1200, 1200, 't06_articleview.php?showdetail=&id=1200', 1200, '2605010', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1201, 1201, 't06_articleview.php?showdetail=&id=1201', 1201, '2605011', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1202, 1202, 't06_articleview.php?showdetail=&id=1202', 1202, '2605012', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1203, 1203, 't06_articleview.php?showdetail=&id=1203', 1203, '2605013', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1204, 1204, 't06_articleview.php?showdetail=&id=1204', 1204, '2605014', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1205, 1205, 't06_articleview.php?showdetail=&id=1205', 1205, '2605015', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1206, 1206, 't06_articleview.php?showdetail=&id=1206', 1206, '2605016', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1207, 1207, 't06_articleview.php?showdetail=&id=1207', 1207, '2605017', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1208, 1208, 't06_articleview.php?showdetail=&id=1208', 1208, '2605018', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1209, 1209, 't06_articleview.php?showdetail=&id=1209', 1209, '2605019', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1210, 1210, 't06_articleview.php?showdetail=&id=1210', 1210, '2605020', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1211, 1211, 't06_articleview.php?showdetail=&id=1211', 1211, '2605021', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1212, 1212, 't06_articleview.php?showdetail=&id=1212', 1212, '2605022', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1213, 1213, 't06_articleview.php?showdetail=&id=1213', 1213, '2605023', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1214, 1214, 't06_articleview.php?showdetail=&id=1214', 1214, '2605024', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1215, 1215, 't06_articleview.php?showdetail=&id=1215', 1215, '2605025', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1216, 1216, 't06_articleview.php?showdetail=&id=1216', 1216, '2605026', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1217, 1217, 't06_articleview.php?showdetail=&id=1217', 1217, '2605027', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1218, 1218, 't06_articleview.php?showdetail=&id=1218', 1218, '2606001', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1219, 1219, 't06_articleview.php?showdetail=&id=1219', 1219, '2606002', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1220, 1220, 't06_articleview.php?showdetail=&id=1220', 1220, '2606003', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1221, 1221, 't06_articleview.php?showdetail=&id=1221', 1221, '2606004', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1222, 1222, 't06_articleview.php?showdetail=&id=1222', 1222, '2606005', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1223, 1223, 't06_articleview.php?showdetail=&id=1223', 1223, '2606006', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1224, 1224, 't06_articleview.php?showdetail=&id=1224', 1224, '2606007', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1225, 1225, 't06_articleview.php?showdetail=&id=1225', 1225, '2606008', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1226, 1226, 't06_articleview.php?showdetail=&id=1226', 1226, '2606009', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1227, 1227, 't06_articleview.php?showdetail=&id=1227', 1227, '2606010', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1228, 1228, 't06_articleview.php?showdetail=&id=1228', 1228, '2606011', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1229, 1229, 't06_articleview.php?showdetail=&id=1229', 1229, '2606012', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1230, 1230, 't06_articleview.php?showdetail=&id=1230', 1230, '2606013', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(1231, 1231, 't06_articleview.php?showdetail=&id=1231', 1231, '1502042', 0, '2018-06-01', '00:00:00', 'Stok Awal', '.', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00);

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
(1, '2018-06-05 21:47:14', '/stok/login.php', 'admin', 'login', '::1', '', '', '', ''),
(2, '2018-06-05 22:02:36', '/stok/t07_satuanlist.php', '1', '*** Batch update begin ***', 't07_satuan', '', '', '', ''),
(3, '2018-06-05 22:02:36', '/stok/t07_satuanlist.php', '1', 'U', 't07_satuan', 'Nama', '1', 'Kg', 'Bag'),
(4, '2018-06-05 22:02:36', '/stok/t07_satuanlist.php', '1', 'U', 't07_satuan', 'Nama', '3', 'Pcs', 'Barel'),
(5, '2018-06-05 22:02:36', '/stok/t07_satuanlist.php', '1', 'U', 't07_satuan', 'Nama', '2', 'Set', 'Biji'),
(6, '2018-06-05 22:02:36', '/stok/t07_satuanlist.php', '1', 'U', 't07_satuan', 'Nama', '4', 'Unit', 'Bks'),
(7, '2018-06-05 22:02:36', '/stok/t07_satuanlist.php', '1', '*** Batch update successful ***', 't07_satuan', '', '', '', ''),
(8, '2018-06-05 22:04:34', '/stok/t07_satuanlist.php', '1', '*** Batch insert begin ***', 't07_satuan', '', '', '', ''),
(9, '2018-06-05 22:04:34', '/stok/t07_satuanlist.php', '1', 'A', 't07_satuan', 'Nama', '5', '', 'Block'),
(10, '2018-06-05 22:04:34', '/stok/t07_satuanlist.php', '1', 'A', 't07_satuan', 'id', '5', '', '5'),
(11, '2018-06-05 22:04:34', '/stok/t07_satuanlist.php', '1', 'A', 't07_satuan', 'Nama', '6', '', 'Box'),
(12, '2018-06-05 22:04:34', '/stok/t07_satuanlist.php', '1', 'A', 't07_satuan', 'id', '6', '', '6'),
(13, '2018-06-05 22:04:34', '/stok/t07_satuanlist.php', '1', 'A', 't07_satuan', 'Nama', '7', '', 'Btg'),
(14, '2018-06-05 22:04:34', '/stok/t07_satuanlist.php', '1', 'A', 't07_satuan', 'id', '7', '', '7'),
(15, '2018-06-05 22:04:34', '/stok/t07_satuanlist.php', '1', 'A', 't07_satuan', 'Nama', '8', '', 'Btl'),
(16, '2018-06-05 22:04:34', '/stok/t07_satuanlist.php', '1', 'A', 't07_satuan', 'id', '8', '', '8'),
(17, '2018-06-05 22:04:34', '/stok/t07_satuanlist.php', '1', 'A', 't07_satuan', 'Nama', '9', '', 'Can'),
(18, '2018-06-05 22:04:34', '/stok/t07_satuanlist.php', '1', 'A', 't07_satuan', 'id', '9', '', '9'),
(19, '2018-06-05 22:04:34', '/stok/t07_satuanlist.php', '1', 'A', 't07_satuan', 'Nama', '10', '', 'Crtn'),
(20, '2018-06-05 22:04:34', '/stok/t07_satuanlist.php', '1', 'A', 't07_satuan', 'id', '10', '', '10'),
(21, '2018-06-05 22:04:34', '/stok/t07_satuanlist.php', '1', 'A', 't07_satuan', 'Nama', '11', '', 'Ctn'),
(22, '2018-06-05 22:04:34', '/stok/t07_satuanlist.php', '1', 'A', 't07_satuan', 'id', '11', '', '11'),
(23, '2018-06-05 22:04:34', '/stok/t07_satuanlist.php', '1', 'A', 't07_satuan', 'Nama', '12', '', 'Cup'),
(24, '2018-06-05 22:04:34', '/stok/t07_satuanlist.php', '1', 'A', 't07_satuan', 'id', '12', '', '12'),
(25, '2018-06-05 22:04:34', '/stok/t07_satuanlist.php', '1', 'A', 't07_satuan', 'Nama', '13', '', 'Ekor'),
(26, '2018-06-05 22:04:34', '/stok/t07_satuanlist.php', '1', 'A', 't07_satuan', 'id', '13', '', '13'),
(27, '2018-06-05 22:04:34', '/stok/t07_satuanlist.php', '1', 'A', 't07_satuan', 'Nama', '14', '', 'Gln'),
(28, '2018-06-05 22:04:34', '/stok/t07_satuanlist.php', '1', 'A', 't07_satuan', 'id', '14', '', '14'),
(29, '2018-06-05 22:04:34', '/stok/t07_satuanlist.php', '1', 'A', 't07_satuan', 'Nama', '15', '', 'Ikat'),
(30, '2018-06-05 22:04:34', '/stok/t07_satuanlist.php', '1', 'A', 't07_satuan', 'id', '15', '', '15'),
(31, '2018-06-05 22:04:34', '/stok/t07_satuanlist.php', '1', '*** Batch insert successful ***', 't07_satuan', '', '', '', ''),
(32, '2018-06-05 22:05:52', '/stok/t07_satuanlist.php', '1', '*** Batch insert begin ***', 't07_satuan', '', '', '', ''),
(33, '2018-06-05 22:05:52', '/stok/t07_satuanlist.php', '1', 'A', 't07_satuan', 'Nama', '16', '', 'Jar'),
(34, '2018-06-05 22:05:52', '/stok/t07_satuanlist.php', '1', 'A', 't07_satuan', 'id', '16', '', '16'),
(35, '2018-06-05 22:05:52', '/stok/t07_satuanlist.php', '1', 'A', 't07_satuan', 'Nama', '17', '', 'Kg'),
(36, '2018-06-05 22:05:52', '/stok/t07_satuanlist.php', '1', 'A', 't07_satuan', 'id', '17', '', '17'),
(37, '2018-06-05 22:05:52', '/stok/t07_satuanlist.php', '1', 'A', 't07_satuan', 'Nama', '18', '', 'Loaf'),
(38, '2018-06-05 22:05:52', '/stok/t07_satuanlist.php', '1', 'A', 't07_satuan', 'id', '18', '', '18'),
(39, '2018-06-05 22:05:52', '/stok/t07_satuanlist.php', '1', 'A', 't07_satuan', 'Nama', '19', '', 'Ons'),
(40, '2018-06-05 22:05:52', '/stok/t07_satuanlist.php', '1', 'A', 't07_satuan', 'id', '19', '', '19'),
(41, '2018-06-05 22:05:52', '/stok/t07_satuanlist.php', '1', 'A', 't07_satuan', 'Nama', '20', '', 'Pack'),
(42, '2018-06-05 22:05:52', '/stok/t07_satuanlist.php', '1', 'A', 't07_satuan', 'id', '20', '', '20'),
(43, '2018-06-05 22:05:52', '/stok/t07_satuanlist.php', '1', 'A', 't07_satuan', 'Nama', '21', '', 'Pail'),
(44, '2018-06-05 22:05:52', '/stok/t07_satuanlist.php', '1', 'A', 't07_satuan', 'id', '21', '', '21'),
(45, '2018-06-05 22:05:52', '/stok/t07_satuanlist.php', '1', 'A', 't07_satuan', 'Nama', '22', '', 'Pcs'),
(46, '2018-06-05 22:05:52', '/stok/t07_satuanlist.php', '1', 'A', 't07_satuan', 'id', '22', '', '22'),
(47, '2018-06-05 22:05:52', '/stok/t07_satuanlist.php', '1', 'A', 't07_satuan', 'Nama', '23', '', 'Tin'),
(48, '2018-06-05 22:05:52', '/stok/t07_satuanlist.php', '1', 'A', 't07_satuan', 'id', '23', '', '23'),
(49, '2018-06-05 22:05:52', '/stok/t07_satuanlist.php', '1', 'A', 't07_satuan', 'Nama', '24', '', 'Top'),
(50, '2018-06-05 22:05:52', '/stok/t07_satuanlist.php', '1', 'A', 't07_satuan', 'id', '24', '', '24'),
(51, '2018-06-05 22:05:52', '/stok/t07_satuanlist.php', '1', '*** Batch insert successful ***', 't07_satuan', '', '', '', ''),
(52, '2018-06-05 22:20:18', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'TglPO', '1', '', '2018-06-05'),
(53, '2018-06-05 22:20:18', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'NoPO', '1', '', 'PO201806050001'),
(54, '2018-06-05 22:20:18', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'VendorID', '1', '', '1'),
(55, '2018-06-05 22:20:18', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'ArticleID', '1', '', '1'),
(56, '2018-06-05 22:20:18', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'Harga', '1', '', '100000'),
(57, '2018-06-05 22:20:18', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'Qty', '1', '', '3'),
(58, '2018-06-05 22:20:18', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'SatuanID', '1', '', '17'),
(59, '2018-06-05 22:20:18', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'SubTotal', '1', '', '300000'),
(60, '2018-06-05 22:20:18', '/stok/t08_belilist.php', '1', 'A', 't08_beli', 'id', '1', '', '1'),
(61, '2018-06-05 22:25:33', '/stok/t06_articlelist.php', '1', 'U', 't06_article', 'HargaJual', '1', '0.00', '115000'),
(62, '2018-06-05 23:08:47', '/stok/login.php', 'admin', 'login', '::1', '', '', '', ''),
(63, '2018-06-05 23:16:54', '/stok/login.php', 'admin', 'login', '::1', '', '', '', ''),
(64, '2018-06-05 23:18:32', '/stok/login.php', 'admin', 'login', '::1', '', '', '', ''),
(65, '2018-06-06 08:58:35', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'MainGroupID', '1231', '', '1'),
(66, '2018-06-06 08:58:35', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'SubGroupID', '1231', '', '2'),
(67, '2018-06-06 08:58:35', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'Kode', '1231', '', '1502042'),
(68, '2018-06-06 08:58:35', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'Nama', '1231', '', 'POULT Chicken Nugget Champ 1Kg'),
(69, '2018-06-06 08:58:35', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'Qty', '1231', '', '0'),
(70, '2018-06-06 08:58:35', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'SatuanID', '1231', '', '20'),
(71, '2018-06-06 08:58:35', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'Harga', '1231', '', '0'),
(72, '2018-06-06 08:58:35', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'HargaJual', '1231', '', '0'),
(73, '2018-06-06 08:58:35', '/stok/t06_articlelist.php', '1', 'A', 't06_article', 'id', '1231', '', '1231'),
(74, '2018-06-06 10:28:11', '/stok/login.php', 'admin', 'login', '::1', '', '', '', ''),
(75, '2018-06-06 10:39:08', '/stok/login.php', 'admin', 'login', '::1', '', '', '', ''),
(76, '2018-06-06 11:43:39', '/stok/login.php', 'admin', 'login', '::1', '', '', '', '');

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
,`namaarticle` varchar(75)
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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v02_stok`  AS  select concat(`a`.`Kode`,' - ',`a`.`Nama`) AS `MainGroup`,concat(`b`.`Kode`,' - ',`b`.`Nama`) AS `SubGroup`,concat(`c`.`Kode`,' - ',`c`.`Nama`) AS `Article`,`e`.`sumqty` AS `SumQty`,`d`.`Nama` AS `Satuan`,`e`.`avgharga` AS `AvgHarga`,`e`.`subtotal` AS `SubTotal`,`c`.`Nama` AS `namaarticle` from ((((`t04_maingroup` `a` left join `t05_subgroup` `b` on((`a`.`id` = `b`.`MainGroupID`))) left join `t06_article` `c` on((`b`.`id` = `c`.`SubGroupID`))) left join `t07_satuan` `d` on((`c`.`SatuanID` = `d`.`id`))) left join `v01_beli` `e` on((`c`.`id` = `e`.`articleid`))) order by `a`.`Kode`,`b`.`Kode`,`c`.`Nama` ;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1232;

--
-- AUTO_INCREMENT for table `t07_satuan`
--
ALTER TABLE `t07_satuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `t08_beli`
--
ALTER TABLE `t08_beli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t09_hutang`
--
ALTER TABLE `t09_hutang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t10_hutangdetail`
--
ALTER TABLE `t10_hutangdetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t11_jual`
--
ALTER TABLE `t11_jual`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t12_jualdetail`
--
ALTER TABLE `t12_jualdetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t13_mutasi`
--
ALTER TABLE `t13_mutasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2048;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
