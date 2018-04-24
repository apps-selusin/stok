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
$_SESSION["Periode"] = f_GetParameter('Periode');

function f_GetParameter($mparam1) {
	$q = "select Nilai from t93_parameter where Nama = '".$mparam1."'";
	$mNilai = ew_ExecuteScalar($q);
	return $mNilai;
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
?>
