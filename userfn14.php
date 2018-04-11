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
	$m_NoPO = ew_ExecuteScalar("select NoPO from t08_po order by NoPO desc");
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
?>
