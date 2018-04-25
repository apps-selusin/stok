-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 25, 2018 at 11:26 AM
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
(1, '5', 'FOOD'),
(2, '6', 'BEVERAGE'),
(3, '7', 'MATERIAL');

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
(1, 1, '5501001', 'Meat 1', 19.00, 1, 95000.00, 125000.00),
(2, 4, '6601001', 'MW 1', 24.00, 3, 14500.00, 18000.00),
(3, 5, '5504001', 'Apel', 4.00, 1, 37500.00, 50000.00),
(4, 8, '5507001', 'Veg 1', 13.00, 1, 1500.00, 7500.00),
(5, 10, '6602001', 'Heineken 1', 5.00, 3, 75000.00, 100000.00),
(6, 13, '6605001', 'SYRP 1', 3.00, 3, 75000.00, 200000.00);

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
(4, '2018-04-25', 'PO201804250004', 2, 6, 75000.00, 7.00, 525000.00);

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
(4, 'HT000004', 4, 525000.00, 0.00);

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
(1, '2018-04-25', 'SO201804250001', 2, 'xxx', 625000.00),
(2, '2018-04-25', 'SO201804250002', 2, 'xxx', 1000000.00);

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
(3, 2, 6, 200000.00, 5.00, 1000000.00);

-- --------------------------------------------------------

--
-- Table structure for table `t13_mutasi`
--

CREATE TABLE `t13_mutasi` (
  `id` int(11) NOT NULL,
  `TabelID` int(11) NOT NULL DEFAULT '0',
  `Url` varchar(100) CHARACTER SET latin1 NOT NULL,
  `ArticleID` int(11) NOT NULL,
  `NoUrut` tinyint(4) NOT NULL,
  `Tgl` date NOT NULL,
  `Jam` time NOT NULL DEFAULT '00:00:00',
  `Keterangan` varchar(50) CHARACTER SET latin1 NOT NULL,
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

INSERT INTO `t13_mutasi` (`id`, `TabelID`, `Url`, `ArticleID`, `NoUrut`, `Tgl`, `Jam`, `Keterangan`, `MasukQty`, `MasukHarga`, `KeluarQty`, `KeluarHarga`, `SaldoQty`, `SaldoHarga`) VALUES
(1, 1, 't06_articleview.php?showdetail=&id=1', 1, 0, '2018-04-01', '00:00:00', 'Stok Awal', 19.00, 95000.00, 0.00, 0.00, 19.00, 1805000.00),
(3, 2, 't08_beliview.php?showdetail=&id=2', 1, 2, '2018-04-25', '01:49:00', 'Beli', 6.20, 95000.00, 0.00, 0.00, 25.20, 589000.00),
(5, 2, 't12_jualdetailview.php?showdetail=&id=2', 1, 4, '2018-04-25', '13:15:00', 'Jual', 0.00, 0.00, 5.00, 0.00, 20.20, 0.00),
(6, 2, 't06_articleview.php?showdetail=&id=2', 2, 0, '2018-04-01', '00:00:00', 'Stok Awal', 24.00, 14500.00, 0.00, 0.00, 24.00, 348000.00),
(7, 3, 't06_articleview.php?showdetail=&id=3', 3, 0, '2018-04-01', '00:00:00', 'Stok Awal', 4.00, 37500.00, 0.00, 0.00, 4.00, 150000.00),
(8, 4, 't06_articleview.php?showdetail=&id=4', 4, 0, '2018-04-01', '00:00:00', 'Stok Awal', 13.00, 1500.00, 0.00, 0.00, 13.00, 19500.00),
(9, 5, 't06_articleview.php?showdetail=&id=5', 5, 0, '2018-04-01', '00:00:00', 'Stok Awal', 5.00, 75000.00, 0.00, 0.00, 5.00, 375000.00),
(10, 6, 't06_articleview.php?showdetail=&id=6', 6, 0, '2018-04-01', '00:00:00', 'Stok Awal', 3.00, 75000.00, 0.00, 0.00, 3.00, 225000.00),
(11, 3, 't08_beliview.php?showdetail=&id=3', 6, 1, '2018-04-25', '15:12:00', 'Beli', 1.00, 75000.00, 0.00, 0.00, 4.00, 75000.00),
(12, 4, 't08_beliview.php?showdetail=&id=4', 6, 2, '2018-04-25', '15:13:00', 'Beli', 7.00, 75000.00, 0.00, 0.00, 11.00, 525000.00),
(13, 3, 't12_jualdetailview.php?showdetail=&id=3', 6, 3, '2018-04-25', '15:18:00', 'Jual', 0.00, 0.00, 5.00, 0.00, 6.00, 0.00);

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
(63, '2018-04-25', '5log', 1, 'siapkan laporan mutasi', NULL, NULL, NULL);

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
(1111, '2018-04-25 15:18:53', '/stok/t11_jualadd.php', '1', '*** Batch insert successful ***', 't12_jualdetail', '', '', '', '');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `t06_article`
--
ALTER TABLE `t06_article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `t07_satuan`
--
ALTER TABLE `t07_satuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t08_beli`
--
ALTER TABLE `t08_beli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t09_hutang`
--
ALTER TABLE `t09_hutang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t10_hutangdetail`
--
ALTER TABLE `t10_hutangdetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t11_jual`
--
ALTER TABLE `t11_jual`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t12_jualdetail`
--
ALTER TABLE `t12_jualdetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t13_mutasi`
--
ALTER TABLE `t13_mutasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
  MODIFY `home_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `t96_employees`
--
ALTER TABLE `t96_employees`
  MODIFY `EmployeeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t99_audittrail`
--
ALTER TABLE `t99_audittrail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1112;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
