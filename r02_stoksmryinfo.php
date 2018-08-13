<?php

// Global variable for table object
$r02_stok = NULL;

//
// Table class for r02_stok
//
class crr02_stok extends crTableBase {
	var $ShowGroupHeaderAsRow = FALSE;
	var $ShowCompactSummaryFooter = TRUE;
	var $MainGroup;
	var $SubGroup;
	var $Article;
	var $SumQty;
	var $Satuan;
	var $AvgHarga;
	var $SubTotal;
	var $namaarticle;

	//
	// Table class constructor
	//
	function __construct() {
		global $ReportLanguage, $grLanguage;
		$this->TableVar = 'r02_stok';
		$this->TableName = 'r02_stok';
		$this->TableType = 'REPORT';
		$this->TableReportType = 'summary';
		$this->SourcTableIsCustomView = FALSE;
		$this->DBID = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0;
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)

		// MainGroup
		$this->MainGroup = new crField('r02_stok', 'r02_stok', 'x_MainGroup', 'MainGroup', '`MainGroup`', 200, EWR_DATATYPE_STRING, -1);
		$this->MainGroup->Sortable = TRUE; // Allow sort
		$this->MainGroup->GroupingFieldId = 1;
		$this->MainGroup->ShowGroupHeaderAsRow = $this->ShowGroupHeaderAsRow;
		$this->MainGroup->ShowCompactSummaryFooter = $this->ShowCompactSummaryFooter;
		$this->MainGroup->DateFilter = "";
		$this->MainGroup->SqlSelect = "";
		$this->MainGroup->SqlOrderBy = "";
		$this->MainGroup->FldGroupByType = "";
		$this->MainGroup->FldGroupInt = "0";
		$this->MainGroup->FldGroupSql = "";
		$this->fields['MainGroup'] = &$this->MainGroup;

		// SubGroup
		$this->SubGroup = new crField('r02_stok', 'r02_stok', 'x_SubGroup', 'SubGroup', '`SubGroup`', 200, EWR_DATATYPE_STRING, -1);
		$this->SubGroup->Sortable = TRUE; // Allow sort
		$this->SubGroup->GroupingFieldId = 2;
		$this->SubGroup->ShowGroupHeaderAsRow = $this->ShowGroupHeaderAsRow;
		$this->SubGroup->ShowCompactSummaryFooter = $this->ShowCompactSummaryFooter;
		$this->SubGroup->DateFilter = "";
		$this->SubGroup->SqlSelect = "";
		$this->SubGroup->SqlOrderBy = "";
		$this->SubGroup->FldGroupByType = "";
		$this->SubGroup->FldGroupInt = "0";
		$this->SubGroup->FldGroupSql = "";
		$this->fields['SubGroup'] = &$this->SubGroup;

		// Article
		$this->Article = new crField('r02_stok', 'r02_stok', 'x_Article', 'Article', '`Article`', 200, EWR_DATATYPE_STRING, -1);
		$this->Article->Sortable = TRUE; // Allow sort
		$this->Article->DateFilter = "";
		$this->Article->SqlSelect = "";
		$this->Article->SqlOrderBy = "";
		$this->fields['Article'] = &$this->Article;

		// SumQty
		$this->SumQty = new crField('r02_stok', 'r02_stok', 'x_SumQty', 'SumQty', '`SumQty`', 5, EWR_DATATYPE_NUMBER, -1);
		$this->SumQty->Sortable = TRUE; // Allow sort
		$this->SumQty->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->SumQty->DateFilter = "";
		$this->SumQty->SqlSelect = "";
		$this->SumQty->SqlOrderBy = "";
		$this->fields['SumQty'] = &$this->SumQty;

		// Satuan
		$this->Satuan = new crField('r02_stok', 'r02_stok', 'x_Satuan', 'Satuan', '`Satuan`', 200, EWR_DATATYPE_STRING, -1);
		$this->Satuan->Sortable = TRUE; // Allow sort
		$this->Satuan->DateFilter = "";
		$this->Satuan->SqlSelect = "";
		$this->Satuan->SqlOrderBy = "";
		$this->fields['Satuan'] = &$this->Satuan;

		// AvgHarga
		$this->AvgHarga = new crField('r02_stok', 'r02_stok', 'x_AvgHarga', 'AvgHarga', '`AvgHarga`', 5, EWR_DATATYPE_NUMBER, -1);
		$this->AvgHarga->Sortable = TRUE; // Allow sort
		$this->AvgHarga->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->AvgHarga->DateFilter = "";
		$this->AvgHarga->SqlSelect = "";
		$this->AvgHarga->SqlOrderBy = "";
		$this->fields['AvgHarga'] = &$this->AvgHarga;

		// SubTotal
		$this->SubTotal = new crField('r02_stok', 'r02_stok', 'x_SubTotal', 'SubTotal', '`SubTotal`', 5, EWR_DATATYPE_NUMBER, -1);
		$this->SubTotal->Sortable = TRUE; // Allow sort
		$this->SubTotal->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->SubTotal->DateFilter = "";
		$this->SubTotal->SqlSelect = "";
		$this->SubTotal->SqlOrderBy = "";
		$this->fields['SubTotal'] = &$this->SubTotal;

		// namaarticle
		$this->namaarticle = new crField('r02_stok', 'r02_stok', 'x_namaarticle', 'namaarticle', '`namaarticle`', 200, EWR_DATATYPE_STRING, -1);
		$this->namaarticle->Sortable = TRUE; // Allow sort
		$this->namaarticle->DateFilter = "";
		$this->namaarticle->SqlSelect = "";
		$this->namaarticle->SqlOrderBy = "";
		$this->fields['namaarticle'] = &$this->namaarticle;
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
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`v02_stok`";
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
		return ($this->_SqlSelect <> "") ? $this->_SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
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
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "`MainGroup` ASC, `SubGroup` ASC";
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
		return ($this->_SqlFirstGroupField <> "") ? $this->_SqlFirstGroupField : "`MainGroup`";
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
		return ($this->_SqlOrderByGroup <> "") ? $this->_SqlOrderByGroup : "`MainGroup` ASC";
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
		return ($this->_SqlSelectAgg <> "") ? $this->_SqlSelectAgg : "SELECT SUM(`SumQty`) AS `sum_sumqty`, SUM(`SubTotal`) AS `sum_subtotal` FROM " . $this->getSqlFrom();
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

	// Get record count
	public function getRecordCount($sql)
	{
		$cnt = -1;
		$rs = NULL;
		$sql = preg_replace('/\/\*BeginOrderBy\*\/[\s\S]+\/\*EndOrderBy\*\//', "", $sql); // Remove ORDER BY clause (MSSQL)
		$pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';

		// Skip Custom View / SubQuery and SELECT DISTINCT
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
			preg_match($pattern, $sql) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sql) && !preg_match('/^\s*select\s+distinct\s+/i', $sql)) {
			$sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sql);
		} else {
			$sqlwrk = "SELECT COUNT(*) FROM (" . $sql . ") COUNT_TABLE";
		}
		$conn = &$this->Connection();
		if ($rs = $conn->execute($sqlwrk)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->close();
			}
			return (int)$cnt;
		}

		// Unable to get count, get record count directly
		if ($rs = $conn->execute($sql)) {
			$cnt = $rs->RecordCount();
			$rs->close();
			return (int)$cnt;
		}
		return $cnt;
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
		case "x_MainGroup":
			$fld->LookupFilters = array("d" => "DB", "f0" => '`MainGroup` = {filter_value}', "t0" => "200", "fn0" => "", "dlm" => ewr_Encrypt($fld->FldDelimiter), "af" => json_encode($fld->AdvancedFilters));
		$sWhereWrk = "";
		$fld->LookupFilters += array(
			"select" => "SELECT DISTINCT `MainGroup`, `MainGroup` AS `DispFld`, '' AS `DispFld2`, '' AS `DispFld3`, '' AS `DispFld4` FROM `v02_stok`",
			"where" => $sWhereWrk,
			"orderby" => "`MainGroup` ASC"
		);
		$this->Lookup_Selecting($fld, $fld->LookupFilters["where"]); // Call Lookup selecting
		$fld->LookupFilters["s"] = ewr_BuildReportSql($fld->LookupFilters["select"], $fld->LookupFilters["where"], "", "", $fld->LookupFilters["orderby"], "", "");
			break;
		case "x_SubGroup":
			$fld->LookupFilters = array("d" => "DB", "f0" => '`SubGroup` = {filter_value}', "t0" => "200", "fn0" => "", "dlm" => ewr_Encrypt($fld->FldDelimiter), "f1" => '`MainGroup` = {filter_value}', "t1" => "200", "fn1" => "", "af" => json_encode($fld->AdvancedFilters));
		$sWhereWrk = "{filter}";
		$fld->LookupFilters += array(
			"select" => "SELECT DISTINCT `SubGroup`, `SubGroup` AS `DispFld`, '' AS `DispFld2`, '' AS `DispFld3`, '' AS `DispFld4` FROM `v02_stok`",
			"where" => $sWhereWrk,
			"orderby" => "`SubGroup` ASC"
		);
		$this->Lookup_Selecting($fld, $fld->LookupFilters["where"]); // Call Lookup selecting
		$fld->LookupFilters["s"] = ewr_BuildReportSql($fld->LookupFilters["select"], $fld->LookupFilters["where"], "", "", $fld->LookupFilters["orderby"], "", "");
			break;
		case "x_Article":
			$fld->LookupFilters = array("d" => "DB", "f0" => '`Article` = {filter_value}', "t0" => "200", "fn0" => "", "dlm" => ewr_Encrypt($fld->FldDelimiter), "f1" => '`MainGroup` = {filter_value}', "t1" => "200", "fn1" => "", "f2" => '`SubGroup` = {filter_value}', "t2" => "200", "fn2" => "", "af" => json_encode($fld->AdvancedFilters));
		$sWhereWrk = "{filter}";
		$fld->LookupFilters += array(
			"select" => "SELECT DISTINCT `Article`, `Article` AS `DispFld`, '' AS `DispFld2`, '' AS `DispFld3`, '' AS `DispFld4` FROM `v02_stok`",
			"where" => $sWhereWrk,
			"orderby" => "`Article` ASC"
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
