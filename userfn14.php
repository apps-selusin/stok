<?php

// Global user functions
// Page Loading event
function Page_Loading() {

	//echo "Page Loading";
}

// Page Rendering event
function Page_Rendering() {

	//echo "Page Rendering";
}

// Page Unloaded event
function Page_Unloaded() {

	//echo "Page Unloaded";
}

function f_GetNextNoPO() {
	$m_NextNoPO = "";
	$m_LastNoPO = "";
	$m_NoPO = ew_ExecuteScalar("select NoPO from t08_beli order by NoPO desc");
	if ($m_NoPO != "") { // jika sudah ada, langsung ambil dan proses...
		$m_LastNoPO = intval(substr($m_NoPO, -4)); // ambil 4 digit terakhir
		$m_LastNoPO = intval($m_LastNoPO) + 1; // konversi ke integer, lalu tambahkan satu
		$m_NextNoPO = "PO" . date("Ymd") . sprintf('%04s', $m_LastNoPO); // format hasilnya dan tambahkan prefix
		if (strlen($m_NextNoPO) > 14) {
			$m_NextNoPO = "PO" . date("Ymd") . "0001";
		}
	}
	else { // jika belum ada, gunakan kode yang pertama
		$m_NextNoPO = "PO" . date("Ymd") . "0001";
	}
	return $m_NextNoPO;
}

function f_GetNextNoHutang() {
	$m_NextNo = "";
	$m_LastNo = "";
	$m_No = ew_ExecuteScalar("select NoHutang from t09_hutang order by NoHutang desc");
	if ($m_No != "") { // jika sudah ada, langsung ambil dan proses...
		$m_LastNo = intval(substr($m_No, -6)); // ambil 6 digit terakhir
		$m_LastNo = intval($m_LastNo) + 1; // konversi ke integer, lalu tambahkan satu
		$m_NextNo = "HT" . sprintf('%06s', $m_LastNo); // format hasilnya dan tambahkan prefix
		if (strlen($m_NextNo) > 8) {
			$m_NextNo = "HT" . "000001";
		}
	}
	else { // jika belum ada, gunakan kode yang pertama
		$m_NextNo = "HT" . "000001";
	}
	return $m_NextNo;
}

function f_GetNextNoBayar() {
	$m_NextNo = "";
	$m_LastNo = "";
	$m_No = ew_ExecuteScalar("select NoBayar from t10_hutangdetail order by NoBayar desc");
	if ($m_No != "") { // jika sudah ada, langsung ambil dan proses...
		$m_LastNo = intval(substr($m_No, -6)); // ambil 6 digit terakhir
		$m_LastNo = intval($m_LastNo) + 1; // konversi ke integer, lalu tambahkan satu
		$m_NextNo = "HD" . sprintf('%06s', $m_LastNo); // format hasilnya dan tambahkan prefix
		if (strlen($m_NextNo) > 8) {
			$m_NextNo = "HD" . "000001";
		}
	}
	else { // jika belum ada, gunakan kode yang pertama
		$m_NextNo = "HD" . "000001";
	}
	return $m_NextNo;
}

function f_GetSisaHutang($mparam1) {
	$mSisa = 0;
	$q = "select jumlahhutang - jumlahbayar from t09_hutang where id = ".$mparam1."";
	$mSisa = ew_ExecuteScalar($q);
	return $mSisa;
}

function f_GetNextNoSO() {
	$m_NextNo = "";
	$m_LastNo = "";
	$m_No = ew_ExecuteScalar("select NoSO from t11_jual order by NoSO desc");
	if ($m_No != "") { // jika sudah ada, langsung ambil dan proses...
		$m_LastNo = intval(substr($m_No, -4)); // ambil 4 digit terakhir
		$m_LastNo = intval($m_LastNo) + 1; // konversi ke integer, lalu tambahkan satu
		$m_NextNo = "SO" . date("Ymd") . sprintf('%04s', $m_LastNo); // format hasilnya dan tambahkan prefix
		if (strlen($m_NextNo) > 14) {
			$m_NextNo = "SO" . date("Ymd") . "0001";
		}
	}
	else { // jika belum ada, gunakan kode yang pertama
		$m_NextNo = "SO" . date("Ymd") . "0001";
	}
	return $m_NextNo;
}

function f_GetNextNoUrut($ArticleID) {
	$m_NextNo = "";
	$m_LastNo = "";
	$m_No = ew_ExecuteScalar("select NoUrut from t13_mutasi where ArticleID = ".$ArticleID." order by NoUrut desc");
	if ($m_No != "") { // jika sudah ada, langsung ambil dan proses...
		$m_LastNo = intval($m_No); // ambil 4 digit terakhir
		$m_LastNo = intval($m_LastNo) + 1; // konversi ke integer, lalu tambahkan satu
		$m_NextNo = $m_LastNo; // format hasilnya dan tambahkan prefix
	}
	else { // jika belum ada, gunakan kode yang pertama
		$m_NextNo = 1;
	}
	return $m_NextNo;
}
$_SESSION["Periode"] = f_GetParameter('Periode');

function f_GetParameter($mparam1) {
	$q = "select Nilai from t93_parameter where Nama = '".$mparam1."'";
	$mNilai = ew_ExecuteScalar($q);
	return $mNilai;
}

function f_UpdateSaldo($ArticleID) {
	$q = "select * from t13_mutasi where ArticleID = ".$ArticleID." order by
		Tgl, Jam, NoUrut";
	$rs = Conn()->Execute($q);
	$mSaldo = 0;
	while (!$rs->EOF) {
		$mSaldo += $rs->fields["MasukQty"] - $rs->fields["KeluarQty"];
		$q = "update t13_mutasi set SaldoQty = ".$mSaldo." where id = ".$rs->fields["id"]."";
		ew_Execute($q);
		$rs->MoveNext();
	}

	// update field kode
	f_UpdateKode($ArticleID);
}

function f_GetNoSO($JualID) {
	$q = "select NoSO from t11_jual where id = '".$JualID."'";
	$mNilai = ew_ExecuteScalar($q);
	return $mNilai;
}

function f_UpdateKode($ArticleID) {

	// cari nilai Kode berdasarkan $ArticleID
	// $q = "select Kode from t06_article where id = ".$ArticleID."";
	// $mKode = ew_ExecuteScalar($q);
	// $q = "update t13_mutasi set Kode = '".$mKode."' where ArticleID = ".$ArticleID."";

	$q = "
		update
			t13_mutasi a
			left join t06_article b on b.id = a.articleid
			left join t05_subgroup c on c.id = b.SubGroupID
			left join t04_maingroup d on d.id = c.MainGroupID
		set
			a.kode = b.kode,
			a.maingroup = CONCAT(d.Kode, ' - ', d.Nama),
			a.subgroup = CONCAT(c.Kode, ' - ', c.Nama),
			a.article = CONCAT(b.Kode, ' - ', b.Nama)
		where
			a.ArticleID = ".$ArticleID."";
	ew_Execute($q);
}

function f_GetNextNoPiutang() {
	$m_NextNo = "";
	$m_LastNo = "";
	$m_No = ew_ExecuteScalar("select NoPiutang from t14_piutang order by NoPiutang desc");
	if ($m_No != "") { // jika sudah ada, langsung ambil dan proses...
		$m_LastNo = intval(substr($m_No, -6)); // ambil 6 digit terakhir
		$m_LastNo = intval($m_LastNo) + 1; // konversi ke integer, lalu tambahkan satu
		$m_NextNo = "PT" . sprintf('%06s', $m_LastNo); // format hasilnya dan tambahkan prefix
		if (strlen($m_NextNo) > 8) {
			$m_NextNo = "PT" . "000001";
		}
	}
	else { // jika belum ada, gunakan kode yang pertama
		$m_NextNo = "PT" . "000001";
	}
	return $m_NextNo;
}

function f_GetNextNoBayarPiutang() {
	$m_NextNo = "";
	$m_LastNo = "";
	$m_No = ew_ExecuteScalar("select NoBayar from t15_piutangdetail order by NoBayar desc");
	if ($m_No != "") { // jika sudah ada, langsung ambil dan proses...
		$m_LastNo = intval(substr($m_No, -6)); // ambil 6 digit terakhir
		$m_LastNo = intval($m_LastNo) + 1; // konversi ke integer, lalu tambahkan satu
		$m_NextNo = "PD" . sprintf('%06s', $m_LastNo); // format hasilnya dan tambahkan prefix
		if (strlen($m_NextNo) > 8) {
			$m_NextNo = "PD" . "000001";
		}
	}
	else { // jika belum ada, gunakan kode yang pertama
		$m_NextNo = "PD" . "000001";
	}
	return $m_NextNo;
}

function f_GetSisaPiutang($mparam1) {
	$mSisa = 0;
	$q = "select jumlahpiutang - jumlahbayar from t14_piutang where id = ".$mparam1."";
	$mSisa = ew_ExecuteScalar($q);
	return $mSisa;
}
?>
