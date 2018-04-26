<?php

// Global variable for table object
$r05_mutasi = NULL;

//
// Table class for r05_mutasi
//
class crr05_mutasi extends crTableBase {
	var $ShowGroupHeaderAsRow = FALSE;
	var $ShowCompactSummaryFooter = TRUE;
	var $id;
	var $TabelID;
	var $Url;
	var $No;
	var $ArticleID;
	var $Kode;
	var $ArticleNama;
	var $NoUrut;
	var $Tgl;
	var $Jam;
	var $Keterangan;
	var $NoRef;
	var $MasukQty;
	var $MasukHarga;
	var $KeluarQty;
	var $KeluarHarga;
	var $SaldoQty;
	var $SaldoHarga;

	//
	// Table class constructor
	//
	function __construct() {
		global $ReportLanguage, $grLanguage;
		$this->TableVar = 'r05_mutasi';
		$this->TableName = 'r05_mutasi';
		$this->TableType = 'REPORT';
		$this->TableReportType = 'summary';
		$this->SourcTableIsCustomView = FALSE;
		$this->DBID = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0;

		// id
		$this->id = new crField('r05_mutasi', 'r05_mutasi', 'x_id', 'id', '`id`', 3, EWR_DATATYPE_NUMBER, -1);
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->id->DateFilter = "";
		$this->id->SqlSelect = "";
		$this->id->SqlOrderBy = "";
		$this->fields['id'] = &$this->id;

		// TabelID
		$this->TabelID = new crField('r05_mutasi', 'r05_mutasi', 'x_TabelID', 'TabelID', '`TabelID`', 3, EWR_DATATYPE_NUMBER, -1);
		$this->TabelID->Sortable = TRUE; // Allow sort
		$this->TabelID->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->TabelID->DateFilter = "";
		$this->TabelID->SqlSelect = "";
		$this->TabelID->SqlOrderBy = "";
		$this->fields['TabelID'] = &$this->TabelID;

		// Url
		$this->Url = new crField('r05_mutasi', 'r05_mutasi', 'x_Url', 'Url', '`Url`', 200, EWR_DATATYPE_STRING, -1);
		$this->Url->Sortable = TRUE; // Allow sort
		$this->Url->DateFilter = "";
		$this->Url->SqlSelect = "";
		$this->Url->SqlOrderBy = "";
		$this->fields['Url'] = &$this->Url;

		// No
		$this->No = new crField('r05_mutasi', 'r05_mutasi', 'x_No', 'No', '`No`', 20, EWR_DATATYPE_NUMBER, -1);
		$this->No->Sortable = TRUE; // Allow sort
		$this->No->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->No->DateFilter = "";
		$this->No->SqlSelect = "";
		$this->No->SqlOrderBy = "";
		$this->fields['No'] = &$this->No;

		// ArticleID
		$this->ArticleID = new crField('r05_mutasi', 'r05_mutasi', 'x_ArticleID', 'ArticleID', '`ArticleID`', 3, EWR_DATATYPE_NUMBER, -1);
		$this->ArticleID->Sortable = TRUE; // Allow sort
		$this->ArticleID->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->ArticleID->DateFilter = "";
		$this->ArticleID->SqlSelect = "";
		$this->ArticleID->SqlOrderBy = "";
		$this->fields['ArticleID'] = &$this->ArticleID;

		// Kode
		$this->Kode = new crField('r05_mutasi', 'r05_mutasi', 'x_Kode', 'Kode', '`Kode`', 200, EWR_DATATYPE_STRING, -1);
		$this->Kode->Sortable = TRUE; // Allow sort
		$this->Kode->GroupingFieldId = 1;
		$this->Kode->ShowGroupHeaderAsRow = $this->ShowGroupHeaderAsRow;
		$this->Kode->ShowCompactSummaryFooter = $this->ShowCompactSummaryFooter;
		$this->Kode->DateFilter = "";
		$this->Kode->SqlSelect = "";
		$this->Kode->SqlOrderBy = "";
		$this->Kode->FldGroupByType = "";
		$this->Kode->FldGroupInt = "0";
		$this->Kode->FldGroupSql = "";
		$this->fields['Kode'] = &$this->Kode;

		// ArticleNama
		$this->ArticleNama = new crField('r05_mutasi', 'r05_mutasi', 'x_ArticleNama', 'ArticleNama', '`ArticleNama`', 200, EWR_DATATYPE_STRING, -1);
		$this->ArticleNama->Sortable = TRUE; // Allow sort
		$this->ArticleNama->GroupingFieldId = 2;
		$this->ArticleNama->ShowGroupHeaderAsRow = $this->ShowGroupHeaderAsRow;
		$this->ArticleNama->ShowCompactSummaryFooter = $this->ShowCompactSummaryFooter;
		$this->ArticleNama->DateFilter = "";
		$this->ArticleNama->SqlSelect = "";
		$this->ArticleNama->SqlOrderBy = "";
		$this->ArticleNama->FldGroupByType = "";
		$this->ArticleNama->FldGroupInt = "0";
		$this->ArticleNama->FldGroupSql = "";
		$this->fields['ArticleNama'] = &$this->ArticleNama;

		// NoUrut
		$this->NoUrut = new crField('r05_mutasi', 'r05_mutasi', 'x_NoUrut', 'NoUrut', '`NoUrut`', 16, EWR_DATATYPE_NUMBER, -1);
		$this->NoUrut->Sortable = TRUE; // Allow sort
		$this->NoUrut->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->NoUrut->DateFilter = "";
		$this->NoUrut->SqlSelect = "";
		$this->NoUrut->SqlOrderBy = "";
		$this->fields['NoUrut'] = &$this->NoUrut;

		// Tgl
		$this->Tgl = new crField('r05_mutasi', 'r05_mutasi', 'x_Tgl', 'Tgl', '`Tgl`', 133, EWR_DATATYPE_DATE, 7);
		$this->Tgl->Sortable = TRUE; // Allow sort
		$this->Tgl->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectField");
		$this->Tgl->DateFilter = "";
		$this->Tgl->SqlSelect = "";
		$this->Tgl->SqlOrderBy = "";
		$this->fields['Tgl'] = &$this->Tgl;

		// Jam
		$this->Jam = new crField('r05_mutasi', 'r05_mutasi', 'x_Jam', 'Jam', '`Jam`', 134, EWR_DATATYPE_TIME, 4);
		$this->Jam->Sortable = TRUE; // Allow sort
		$this->Jam->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectTime");
		$this->Jam->DateFilter = "";
		$this->Jam->SqlSelect = "";
		$this->Jam->SqlOrderBy = "";
		$this->fields['Jam'] = &$this->Jam;

		// Keterangan
		$this->Keterangan = new crField('r05_mutasi', 'r05_mutasi', 'x_Keterangan', 'Keterangan', '`Keterangan`', 200, EWR_DATATYPE_STRING, -1);
		$this->Keterangan->Sortable = TRUE; // Allow sort
		$this->Keterangan->DateFilter = "";
		$this->Keterangan->SqlSelect = "";
		$this->Keterangan->SqlOrderBy = "";
		$this->fields['Keterangan'] = &$this->Keterangan;

		// NoRef
		$this->NoRef = new crField('r05_mutasi', 'r05_mutasi', 'x_NoRef', 'NoRef', '`NoRef`', 200, EWR_DATATYPE_STRING, -1);
		$this->NoRef->Sortable = TRUE; // Allow sort
		$this->NoRef->DateFilter = "";
		$this->NoRef->SqlSelect = "";
		$this->NoRef->SqlOrderBy = "";
		$this->fields['NoRef'] = &$this->NoRef;

		// MasukQty
		$this->MasukQty = new crField('r05_mutasi', 'r05_mutasi', 'x_MasukQty', 'MasukQty', '`MasukQty`', 4, EWR_DATATYPE_NUMBER, -1);
		$this->MasukQty->Sortable = TRUE; // Allow sort
		$this->MasukQty->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->MasukQty->DateFilter = "";
		$this->MasukQty->SqlSelect = "";
		$this->MasukQty->SqlOrderBy = "";
		$this->fields['MasukQty'] = &$this->MasukQty;

		// MasukHarga
		$this->MasukHarga = new crField('r05_mutasi', 'r05_mutasi', 'x_MasukHarga', 'MasukHarga', '`MasukHarga`', 4, EWR_DATATYPE_NUMBER, -1);
		$this->MasukHarga->Sortable = TRUE; // Allow sort
		$this->MasukHarga->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->MasukHarga->DateFilter = "";
		$this->MasukHarga->SqlSelect = "";
		$this->MasukHarga->SqlOrderBy = "";
		$this->fields['MasukHarga'] = &$this->MasukHarga;

		// KeluarQty
		$this->KeluarQty = new crField('r05_mutasi', 'r05_mutasi', 'x_KeluarQty', 'KeluarQty', '`KeluarQty`', 4, EWR_DATATYPE_NUMBER, -1);
		$this->KeluarQty->Sortable = TRUE; // Allow sort
		$this->KeluarQty->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->KeluarQty->DateFilter = "";
		$this->KeluarQty->SqlSelect = "";
		$this->KeluarQty->SqlOrderBy = "";
		$this->fields['KeluarQty'] = &$this->KeluarQty;

		// KeluarHarga
		$this->KeluarHarga = new crField('r05_mutasi', 'r05_mutasi', 'x_KeluarHarga', 'KeluarHarga', '`KeluarHarga`', 4, EWR_DATATYPE_NUMBER, -1);
		$this->KeluarHarga->Sortable = TRUE; // Allow sort
		$this->KeluarHarga->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->KeluarHarga->DateFilter = "";
		$this->KeluarHarga->SqlSelect = "";
		$this->KeluarHarga->SqlOrderBy = "";
		$this->fields['KeluarHarga'] = &$this->KeluarHarga;

		// SaldoQty
		$this->SaldoQty = new crField('r05_mutasi', 'r05_mutasi', 'x_SaldoQty', 'SaldoQty', '`SaldoQty`', 4, EWR_DATATYPE_NUMBER, -1);
		$this->SaldoQty->Sortable = TRUE; // Allow sort
		$this->SaldoQty->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->SaldoQty->DateFilter = "";
		$this->SaldoQty->SqlSelect = "";
		$this->SaldoQty->SqlOrderBy = "";
		$this->fields['SaldoQty'] = &$this->SaldoQty;

		// SaldoHarga
		$this->SaldoHarga = new crField('r05_mutasi', 'r05_mutasi', 'x_SaldoHarga', 'SaldoHarga', '`SaldoHarga`', 4, EWR_DATATYPE_NUMBER, -1);
		$this->SaldoHarga->Sortable = TRUE; // Allow sort
		$this->SaldoHarga->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->SaldoHarga->DateFilter = "";
		$this->SaldoHarga->SqlSelect = "";
		$this->SaldoHarga->SqlOrderBy = "";
		$this->fields['SaldoHarga'] = &$this->SaldoHarga;
	}

	// Set Field Visibility
	function SetFieldVisibility($fldparm) {
		global $Security;
		return $this->$fldparm->Visible; // Returns original value
	}

	// Multiple column sort
	function UpdateSort(&$ofld, $ctrl) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			if ($ofld->GroupingFieldId == 0) {
				if ($ctrl) {
					$sOrderBy = $this->getDetailOrderBy();
					if (strpos($sOrderBy, $sSortField . " " . $sLastSort) !== FALSE) {
						$sOrderBy = str_replace($sSortField . " " . $sLastSort, $sSortField . " " . $sThisSort, $sOrderBy);
					} else {
						if ($sOrderBy <> "") $sOrderBy .= ", ";
						$sOrderBy .= $sSortField . " " . $sThisSort;
					}
					$this->setDetailOrderBy($sOrderBy); // Save to Session
				} else {
					$this->setDetailOrderBy($sSortField . " " . $sThisSort); // Save to Session
				}
			}
		} else {
			if ($ofld->GroupingFieldId == 0 && !$ctrl) $ofld->setSort("");
		}
	}

	// Get Sort SQL
	function SortSql() {
		$sDtlSortSql = $this->getDetailOrderBy(); // Get ORDER BY for detail fields from session
		$argrps = array();
		foreach ($this->fields as $fld) {
			if ($fld->getSort() <> "") {
				$fldsql = $fld->FldExpression;
				if ($fld->GroupingFieldId > 0) {
					if ($fld->FldGroupSql <> "")
						$argrps[$fld->GroupingFieldId] = str_replace("%s", $fldsql, $fld->FldGroupSql) . " " . $fld->getSort();
					else
						$argrps[$fld->GroupingFieldId] = $fldsql . " " . $fld->getSort();
				}
			}
		}
		$sSortSql = "";
		foreach ($argrps as $grp) {
			if ($sSortSql <> "") $sSortSql .= ", ";
			$sSortSql .= $grp;
		}
		if ($sDtlSortSql <> "") {
			if ($sSortSql <> "") $sSortSql .= ", ";
			$sSortSql .= $sDtlSortSql;
		}
		return $sSortSql;
	}

	// Table level SQL
	// From

	var $_SqlFrom = "";

	function getSqlFrom() {
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`t13_mutasi`";
	}

	function SqlFrom() { // For backward compatibility
		return $this->getSqlFrom();
	}

	function setSqlFrom($v) {
		$this->_SqlFrom = $v;
	}

	// Select
	var $_SqlSelect = "";

	function getSqlSelect() {
		return ($this->_SqlSelect <> "") ? $this->_SqlSelect : "SELECT *, (select nama from t06_article where id = articleid) AS `ArticleNama`, 0 AS `No` FROM " . $this->getSqlFrom();
	}

	function SqlSelect() { // For backward compatibility
		return $this->getSqlSelect();
	}

	function setSqlSelect($v) {
		$this->_SqlSelect = $v;
	}

	// Where
	var $_SqlWhere = "";

	function getSqlWhere() {
		$sWhere = ($this->_SqlWhere <> "") ? $this->_SqlWhere : "";
		return $sWhere;
	}

	function SqlWhere() { // For backward compatibility
		return $this->getSqlWhere();
	}

	function setSqlWhere($v) {
		$this->_SqlWhere = $v;
	}

	// Group By
	var $_SqlGroupBy = "";

	function getSqlGroupBy() {
		return ($this->_SqlGroupBy <> "") ? $this->_SqlGroupBy : "";
	}

	function SqlGroupBy() { // For backward compatibility
		return $this->getSqlGroupBy();
	}

	function setSqlGroupBy($v) {
		$this->_SqlGroupBy = $v;
	}

	// Having
	var $_SqlHaving = "";

	function getSqlHaving() {
		return ($this->_SqlHaving <> "") ? $this->_SqlHaving : "";
	}

	function SqlHaving() { // For backward compatibility
		return $this->getSqlHaving();
	}

	function setSqlHaving($v) {
		$this->_SqlHaving = $v;
	}

	// Order By
	var $_SqlOrderBy = "";

	function getSqlOrderBy() {
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "`Kode` ASC, `ArticleNama` ASC";
	}

	function SqlOrderBy() { // For backward compatibility
		return $this->getSqlOrderBy();
	}

	function setSqlOrderBy($v) {
		$this->_SqlOrderBy = $v;
	}

	// Table Level Group SQL
	// First Group Field

	var $_SqlFirstGroupField = "";

	function getSqlFirstGroupField() {
		return ($this->_SqlFirstGroupField <> "") ? $this->_SqlFirstGroupField : "`Kode`";
	}

	function SqlFirstGroupField() { // For backward compatibility
		return $this->getSqlFirstGroupField();
	}

	function setSqlFirstGroupField($v) {
		$this->_SqlFirstGroupField = $v;
	}

	// Select Group
	var $_SqlSelectGroup = "";

	function getSqlSelectGroup() {
		return ($this->_SqlSelectGroup <> "") ? $this->_SqlSelectGroup : "SELECT DISTINCT " . $this->getSqlFirstGroupField() . " FROM " . $this->getSqlFrom();
	}

	function SqlSelectGroup() { // For backward compatibility
		return $this->getSqlSelectGroup();
	}

	function setSqlSelectGroup($v) {
		$this->_SqlSelectGroup = $v;
	}

	// Order By Group
	var $_SqlOrderByGroup = "";

	function getSqlOrderByGroup() {
		return ($this->_SqlOrderByGroup <> "") ? $this->_SqlOrderByGroup : "`Kode` ASC";
	}

	function SqlOrderByGroup() { // For backward compatibility
		return $this->getSqlOrderByGroup();
	}

	function setSqlOrderByGroup($v) {
		$this->_SqlOrderByGroup = $v;
	}

	// Select Aggregate
	var $_SqlSelectAgg = "";

	function getSqlSelectAgg() {
		return ($this->_SqlSelectAgg <> "") ? $this->_SqlSelectAgg : "SELECT SUM(`MasukQty`) AS `sum_masukqty`, SUM(`KeluarQty`) AS `sum_keluarqty` FROM " . $this->getSqlFrom();
	}

	function SqlSelectAgg() { // For backward compatibility
		return $this->getSqlSelectAgg();
	}

	function setSqlSelectAgg($v) {
		$this->_SqlSelectAgg = $v;
	}

	// Aggregate Prefix
	var $_SqlAggPfx = "";

	function getSqlAggPfx() {
		return ($this->_SqlAggPfx <> "") ? $this->_SqlAggPfx : "";
	}

	function SqlAggPfx() { // For backward compatibility
		return $this->getSqlAggPfx();
	}

	function setSqlAggPfx($v) {
		$this->_SqlAggPfx = $v;
	}

	// Aggregate Suffix
	var $_SqlAggSfx = "";

	function getSqlAggSfx() {
		return ($this->_SqlAggSfx <> "") ? $this->_SqlAggSfx : "";
	}

	function SqlAggSfx() { // For backward compatibility
		return $this->getSqlAggSfx();
	}

	function setSqlAggSfx($v) {
		$this->_SqlAggSfx = $v;
	}

	// Select Count
	var $_SqlSelectCount = "";

	function getSqlSelectCount() {
		return ($this->_SqlSelectCount <> "") ? $this->_SqlSelectCount : "SELECT COUNT(*) FROM " . $this->getSqlFrom();
	}

	function SqlSelectCount() { // For backward compatibility
		return $this->getSqlSelectCount();
	}

	function setSqlSelectCount($v) {
		$this->_SqlSelectCount = $v;
	}

	// Sort URL
	function SortUrl(&$fld) {
		global $grDashboardReport;
		if ($this->Export <> "" || $grDashboardReport ||
			in_array($fld->FldType, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {

			//$sUrlParm = "order=" . urlencode($fld->FldName) . "&ordertype=" . $fld->ReverseSort();
			$sUrlParm = "order=" . urlencode($fld->FldName) . "&amp;ordertype=" . $fld->ReverseSort();
			return ewr_CurrentPage() . "?" . $sUrlParm;
		} else {
			return "";
		}
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld) {
		global $grLanguage;
		switch ($fld->FldVar) {
		case "x_Kode":
			$fld->LookupFilters = array("d" => "DB", "f0" => '`Kode` = {filter_value}', "t0" => "200", "fn0" => "", "dlm" => ewr_Encrypt($fld->FldDelimiter), "af" => json_encode($fld->AdvancedFilters));
		$sWhereWrk = "";
		$fld->LookupFilters += array(
			"select" => "SELECT DISTINCT `Kode`, `Kode` AS `DispFld`, '' AS `DispFld2`, '' AS `DispFld3`, '' AS `DispFld4` FROM `t13_mutasi`",
			"where" => $sWhereWrk,
			"orderby" => "`Kode` ASC"
		);
		$this->Lookup_Selecting($fld, $fld->LookupFilters["where"]); // Call Lookup selecting
		$fld->LookupFilters["s"] = ewr_BuildReportSql($fld->LookupFilters["select"], $fld->LookupFilters["where"], "", "", $fld->LookupFilters["orderby"], "", "");
			break;
		}
	}

	// Setup AutoSuggest filters of a field
	function SetupAutoSuggestFilters($fld) {
		global $grLanguage;
		switch ($fld->FldVar) {
		}
	}

	// Table level events
	// Page Selecting event
	function Page_Selecting(&$filter) {

		// Enter your code here
	}

	// Page Breaking event
	function Page_Breaking(&$break, &$content) {

		// Example:
		//$break = FALSE; // Skip page break, or
		//$content = "<div style=\"page-break-after:always;\">&nbsp;</div>"; // Modify page break content

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
		/*if ($_SESSION["r05_Flag"] == 0) {
			$_SESSION["r05_Flag"] = 1;
			$_SESSION["r05_ArticleID"] = $this->ArticleID->DbValue;
			$mPertama = 1;
		}

		// $_SESSION["r05_No"] = "";
		if ($_SESSION["r05_ArticleID"] != $this->ArticleID->DbValue and $this->ArticleID->DbValue != "") {
			$_SESSION["r05_ArticleID"] = $this->ArticleID->DbValue;

			//$_SESSION["r05_No"]++;
			$mPertama = 1;
		}
		if ($_SESSION["r05_ArticleID"] == $this->ArticleID->DbValue and $this->ArticleID->DbValue != "") {

			//$_SESSION["r05_No"] = "";
			if ($mPertama == 1) {
				$mPertama = 0;
				$_SESSION["r05_No"] = ++$_SESSION["r05_No_Simpan"];
			}

			//$_SESSION["r05_ArticleID"] = $this->ArticleID->DbValue;
			//$_SESSION["r05_No"] = "";

		}*/
	}

	// Cell Rendered event
	function Cell_Rendered(&$Field, $CurrentValue, &$ViewValue, &$ViewAttrs, &$CellAttrs, &$HrefValue, &$LinkAttrs) {

		//$ViewValue = "xxx";
		//$ViewAttrs["style"] = "xxx";

	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

		if ($this->MasukQty->CurrentValue == 0) {
			$this->MasukQty->ViewValue = "";
		}
		if ($this->KeluarQty->CurrentValue == 0) {
			$this->KeluarQty->ViewValue = "";
		}

		// $this->Keterangan->ViewValue = "<a href='./".$this->Url->CurrentValue."'>".$this->Keterangan->CurrentValue."</a>";
		$this->NoRef->ViewValue = "<a href='./".$this->Url->CurrentValue."'>".$this->NoRef->CurrentValue."</a>";

		// $this->No->ViewValue = $_SESSION["r05_No"] . "." . $this->RecCount . ".";
		$this->No->ViewValue = $this->RecCount . ".";
	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}

	// Load Filters event
	function Page_FilterLoad() {

		// Enter your code here
		// Example: Register/Unregister Custom Extended Filter
		//ewr_RegisterFilter($this-><Field>, 'StartsWithA', 'Starts With A', 'GetStartsWithAFilter'); // With function, or
		//ewr_RegisterFilter($this-><Field>, 'StartsWithA', 'Starts With A'); // No function, use Page_Filtering event
		//ewr_UnregisterFilter($this-><Field>, 'StartsWithA');

	}

	// Page Filter Validated event
	function Page_FilterValidated() {

		// Example:
		//$this->MyField1->SearchValue = "your search criteria"; // Search value

	}

	// Page Filtering event
	function Page_Filtering(&$fld, &$filter, $typ, $opr = "", $val = "", $cond = "", $opr2 = "", $val2 = "") {

		// Note: ALWAYS CHECK THE FILTER TYPE ($typ)! Example:
		//if ($typ == "dropdown" && $fld->FldName == "MyField") // Dropdown filter
		//	$filter = "..."; // Modify the filter
		//if ($typ == "extended" && $fld->FldName == "MyField") // Extended filter
		//	$filter = "..."; // Modify the filter
		//if ($typ == "popup" && $fld->FldName == "MyField") // Popup filter
		//	$filter = "..."; // Modify the filter
		//if ($typ == "custom" && $opr == "..." && $fld->FldName == "MyField") // Custom filter, $opr is the custom filter ID
		//	$filter = "..."; // Modify the filter

	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		// Enter your code here
	}
}
?>
