-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2018 at 05:45 PM
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `t06_article`
--

CREATE TABLE IF NOT EXISTS `t06_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `SubGroupID` int(11) NOT NULL,
  `Kode` varchar(7) NOT NULL,
  `Nama` varchar(75) NOT NULL,
  `Qty` float(15,2) NOT NULL DEFAULT '0.00',
  `SatuanID` int(11) NOT NULL,
  `Harga` float(15,2) NOT NULL DEFAULT '0.00',
  `HargaJual` float(15,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `t11_jual_old`
--

CREATE TABLE IF NOT EXISTS `t11_jual_old` (
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

CREATE TABLE IF NOT EXISTS `t12_jualdetail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `JualID` int(11) NOT NULL,
  `ArticleID` int(11) NOT NULL,
  `HargaJual` float(15,2) NOT NULL DEFAULT '0.00',
  `Qty` float(15,2) NOT NULL DEFAULT '0.00',
  `SubTotal` float(15,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `t13_mutasi`
--

CREATE TABLE IF NOT EXISTS `t13_mutasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `SaldoHarga` float(15,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `t93_parameter`
--

CREATE TABLE IF NOT EXISTS `t93_parameter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nama` varchar(50) CHARACTER SET latin1 NOT NULL,
  `Nilai` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `t93_parameter`
--

INSERT INTO `t93_parameter` (`id`, `Nama`, `Nilai`) VALUES
(1, 'Periode', '2018-04-01');

-- --------------------------------------------------------

--
-- Table structure for table `t94_home`
--

CREATE TABLE IF NOT EXISTS `t94_home` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(25) CHARACTER SET latin1 NOT NULL,
  `flag` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

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

CREATE TABLE IF NOT EXISTS `t95_homedetail` (
  `home_id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl` date DEFAULT NULL,
  `kat` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `no_jdl` int(11) DEFAULT NULL,
  `jdl` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `no_ket` int(11) DEFAULT NULL,
  `ket` text CHARACTER SET latin1,
  `done` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`home_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=73 ;

--
-- Dumping data for table `t95_homedetail`
--

INSERT INTO `t95_homedetail` (`home_id`, `tgl`, `kat`, `no_jdl`, `jdl`, `no_ket`, `ket`, `done`) VALUES
(1, '2017-10-15', '2update', 1, 'Transaksi - Retur Penjualan', NULL, NULL, NULL),
(2, '2017-10-11', '2update', 1, 'Laporan - Dead Stok', NULL, NULL, NULL),
(3, '2017-10-11', '2update', 2, 'Laporan - Mutasi Detail', NULL, NULL, NULL),
(4, '2017-10-07', '2update', 1, 'revisi Laporan - Stok: ditambah data dari transaksi "Dead Stock"', NULL, NULL, NULL),
(5, '2017-10-07', '2update', 2, 'revisi Laporan - Nilai Stok: ditambah data dari transaksi "Dead Stock"', NULL, NULL, NULL),
(6, '2017-10-07', '2update', 3, 'revisi Laporan - Mutasi: ditambah data dari transaksi "Dead Stock"', NULL, NULL, NULL),
(7, '2017-10-07', '2update', 4, 'revisi Laporan - Laba / Rugi Kotor: ditambah data dari transaksi "Dead Stock"', NULL, NULL, NULL),
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
(26, '2017-10-19', '2update', 1, 'revisi Laporan - Stok: ditambah data dari transaksi "Retur Penjualan"', NULL, NULL, NULL),
(28, '2017-10-20', '4todo', 1, 'history harga', NULL, NULL, NULL),
(29, '2017-10-20', '4todo', 2, '<strike>history hutang (internal)</strike>', NULL, NULL, NULL),
(30, '2017-10-20', '4todo', 3, '<strike>grouping kategori item</strike>', NULL, NULL, NULL),
(31, '2017-10-20', '4todo', 4, '<strike>perhitungan piutang berdasarkan total invoice</strike>', NULL, NULL, NULL),
(32, '2017-10-20', '4todo', 5, '<strike>harga jual otomatis tampil</strike>', NULL, NULL, NULL),
(33, '2017-10-25', '2update', 2, '<a href="t_13kategorilist.php">Master - Item Kategori</a>', NULL, NULL, NULL),
(34, '2017-10-25', '2update', 1, '<a href="t_02itemlist.php">Master - Item<a>', 1, 'menambahkan kolom KATEGORI;', NULL),
(35, '2017-10-25', '2update', 1, '<a href="t_02itemlist.php">Master - Item<a>', 2, 'menambahkan kolom satuan dan kolom harga jual;', NULL),
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
-- Stand-in structure for view `v04_jual`
--
CREATE TABLE IF NOT EXISTS `v04_jual` (
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

-- --------------------------------------------------------

--
-- Structure for view `v04_jual`
--
DROP TABLE IF EXISTS `v04_jual`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v04_jual` AS select `a`.`TglSO` AS `TglSO`,`a`.`NoSO` AS `NoSO`,`c`.`Nama` AS `CustomerNama`,`a`.`CustomerPO` AS `CustomerPO`,concat(`d`.`Kode`,' - ',`d`.`Nama`) AS `ArticleNama`,`b`.`HargaJual` AS `HargaJual`,`b`.`Qty` AS `Qty`,`e`.`Nama` AS `SatuanNama`,`b`.`SubTotal` AS `SubTotal` from ((((`t11_jual` `a` left join `t12_jualdetail` `b` on((`a`.`id` = `b`.`JualID`))) left join `t03_customer` `c` on((`a`.`CustomerID` = `c`.`id`))) left join `t06_article` `d` on((`b`.`ArticleID` = `d`.`id`))) left join `t07_satuan` `e` on((`d`.`SatuanID` = `e`.`id`)));

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
