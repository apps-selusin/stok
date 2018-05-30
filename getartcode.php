<?php
include("conn.php");
mysql_connect($hostname_conn, $username_conn, $password_conn) or die ("Tidak bisa terkoneksi ke Database server");
mysql_select_db($database_conn) or die ("Database tidak ditemukan");
$SubGroupID = $_GET['q'];
//$hasil = $kode.date("Ym")."001";
$hasil = "";
$maingroup = "";
$subgroup = "";
if ($SubGroupID) {
	
	// ambil data di tabel sub group terlebih dahulu
	$q = mysql_query("select * from t05_subgroup where id = ".$SubGroupID."");
	while ($rs = mysql_fetch_array($q)) {
		//$maingroup = substr($rs["Kode"], 0, 1);
		$MainGroupID = $rs["MainGroupID"];
		$qMainGroup = mysql_query("select Kode from t04_maingroup where id = ".$MainGroupID."");
		$rsMainGroup = mysql_fetch_array($qMainGroup);
		$maingroup = $rsMainGroup["Kode"];
		$subgroup = $rs["Kode"];
	}
	
	// article code awal
	$hasil = $maingroup . $subgroup . "001";
	
	// ambil data di tabel article
	$q = mysql_query("select * from t06_article where SubGroupID = ".$SubGroupID." order by Kode desc");
	while($rs = mysql_fetch_array($q)){
		//echo $d['alamat'];
		$sLastKode = intval(substr($rs["Kode"], -3)); // ambil 3 digit terakhir
		$sLastKode = intval($sLastKode) + 1; // konversi ke integer, lalu tambahkan satu
		$hasil = substr($rs["Kode"], 0, 4).sprintf('%03s', $sLastKode);
		//$hasil = $rs["jurnal_kode"];
		break;
	}
}
echo $hasil;
?>