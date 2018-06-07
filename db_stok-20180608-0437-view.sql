

--
-- Structure for view `v01_beli`
--
CREATE VIEW `v01_beli` AS select `t08_beli`.`ArticleID` AS `articleid`,avg(`t08_beli`.`Harga`) AS `avgharga`,sum(`t08_beli`.`Qty`) AS `sumqty`,(avg(`t08_beli`.`Harga`) * sum(`t08_beli`.`Qty`)) AS `subtotal` from `t08_beli` group by `t08_beli`.`ArticleID`;

-- --------------------------------------------------------

--
-- Structure for view `v02_stok`
--
CREATE VIEW `v02_stok` AS select concat(`a`.`Kode`,' - ',`a`.`Nama`) AS `MainGroup`,concat(`b`.`Kode`,' - ',`b`.`Nama`) AS `SubGroup`,concat(`c`.`Kode`,' - ',`c`.`Nama`) AS `Article`,`e`.`sumqty` AS `SumQty`,`d`.`Nama` AS `Satuan`,`e`.`avgharga` AS `AvgHarga`,`e`.`subtotal` AS `SubTotal`,`c`.`Nama` AS `namaarticle` from ((((`t04_maingroup` `a` left join `t05_subgroup` `b` on((`a`.`id` = `b`.`MainGroupID`))) left join `t06_article` `c` on((`b`.`id` = `c`.`SubGroupID`))) left join `t07_satuan` `d` on((`c`.`SatuanID` = `d`.`id`))) left join `v01_beli` `e` on((`c`.`id` = `e`.`articleid`))) order by `a`.`Kode`,`b`.`Kode`,`c`.`Nama`;

-- --------------------------------------------------------

--
-- Structure for view `v03_hutang`
--
CREATE VIEW `v03_hutang` AS select `a`.`NoHutang` AS `nohutang`,`b`.`TglPO` AS `tglpo`,`b`.`NoPO` AS `nopo`,`c`.`Nama` AS `nama`,`a`.`JumlahHutang` AS `jumlahhutang`,`a`.`JumlahBayar` AS `jumlahbayar`,(`a`.`JumlahHutang` - `a`.`JumlahBayar`) AS `sisahutang` from ((`t09_hutang` `a` left join `t08_beli` `b` on((`a`.`BeliID` = `b`.`id`))) left join `t02_vendor` `c` on((`b`.`VendorID` = `c`.`id`)));

-- --------------------------------------------------------

--
-- Structure for view `v04_jual`
--
CREATE VIEW `v04_jual` AS select `a`.`TglSO` AS `TglSO`,`a`.`NoSO` AS `NoSO`,`c`.`Nama` AS `CustomerNama`,`a`.`CustomerPO` AS `CustomerPO`,concat(`d`.`Kode`,' - ',`d`.`Nama`) AS `ArticleNama`,`b`.`HargaJual` AS `HargaJual`,`b`.`Qty` AS `Qty`,`e`.`Nama` AS `SatuanNama`,`b`.`SubTotal` AS `SubTotal` from ((((`t11_jual` `a` left join `t12_jualdetail` `b` on((`a`.`id` = `b`.`JualID`))) left join `t03_customer` `c` on((`a`.`CustomerID` = `c`.`id`))) left join `t06_article` `d` on((`b`.`ArticleID` = `d`.`id`))) left join `t07_satuan` `e` on((`d`.`SatuanID` = `e`.`id`)));

-- --------------------------------------------------------

--
-- Structure for view `v05_article`
--
CREATE VIEW `v05_article` AS select `t06_article`.`id` AS `id`,`t06_article`.`SubGroupID` AS `SubGroupID`,`t06_article`.`Kode` AS `Kode`,`t06_article`.`Nama` AS `Nama`,`t06_article`.`Qty` AS `Qty`,`t06_article`.`SatuanID` AS `SatuanID`,`t06_article`.`Harga` AS `Harga`,`t06_article`.`HargaJual` AS `HargaJual` from `t06_article` order by `t06_article`.`SubGroupID`,`t06_article`.`Nama`;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
