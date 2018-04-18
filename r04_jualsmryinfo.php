<?php

// Global variable for table object
$r04_jual = NULL;

//
// Table class for r04_jual
//
class crr04_jual extends crTableBase {
	var $ShowGroupHeaderAsRow = FALSE;
	var $ShowCompactSummaryFooter = TRUE;
	var $TglSO;
	var $NoSO;
	var $CustomerID;
	var $CustomerNama;
	var $CustomerPO;
	var $ArticleID;
	var $ArticleNama;
	var $HargaJual;
	var $Qty;
	var $SatuanNama;
	var $SubTotal;

	//
	// Table class constructor
	//
	function __construct() {
		global $ReportLanguage, $grLanguage;
		$this->TableVar = 'r04_jual';
		$this->TableName = 'r04_jual';
		$this->TableType = 'REPORT';
		$this->TableReportType = 'summary';
		$this->SourcTableIsCustomView = FALSE;
		$this->DBID = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0;

		// TglSO
		$this->TglSO = new crField('r04_jual', 'r04_jual', 'x_TglSO', 'TglSO', '`TglSO`', 133, EWR_DATATYPE_DATE, 7);
		$this->TglSO->Sortable = TRUE; // Allow sort
		$this->TglSO->GroupingFieldId = 1;
		$this->TglSO->ShowGroupHeaderAsRow = $this->ShowGroupHeaderAsRow;
		$this->TglSO->ShowCompactSummaryFooter = $this->ShowCompactSummaryFooter;
		$this->TglSO->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EWR_DATE_SEPARATOR"], $ReportLanguage->Phrase("IncorrectDateDMY"));
		$this->TglSO->DateFilter = "";
		$this->TglSO->SqlSelect = "";
		$this->TglSO->SqlOrderBy = "";
		$this->TglSO->FldGroupByType = "";
		$this->TglSO->FldGroupInt = "0";
		$this->TglSO->FldGroupSql = "";
		$this->fields['TglSO'] = &$this->TglSO;

		// NoSO
		$this->NoSO = new crField('r04_jual', 'r04_jual', 'x_NoSO', 'NoSO', '`NoSO`', 200, EWR_DATATYPE_STRING, -1);
		$this->NoSO->Sortable = TRUE; // Allow sort
		$this->NoSO->GroupingFieldId = 2;
		$this->NoSO->ShowGroupHeaderAsRow = $this->ShowGroupHeaderAsRow;
		$this->NoSO->ShowCompactSummaryFooter = $this->ShowCompactSummaryFooter;
		$this->NoSO->DateFilter = "";
		$this->NoSO->SqlSelect = "";
		$this->NoSO->SqlOrderBy = "";
		$this->NoSO->FldGroupByType = "";
		$this->NoSO->FldGroupInt = "0";
		$this->NoSO->FldGroupSql = "";
		$this->fields['NoSO'] = &$this->NoSO;

		// CustomerID
		$this->CustomerID = new crField('r04_jual', 'r04_jual', 'x_CustomerID', 'CustomerID', '`CustomerID`', 3, EWR_DATATYPE_NUMBER, -1);
		$this->CustomerID->Sortable = TRUE; // Allow sort
		$this->CustomerID->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->CustomerID->DateFilter = "";
		$this->CustomerID->SqlSelect = "";
		$this->CustomerID->SqlOrderBy = "";
		$this->fields['CustomerID'] = &$this->CustomerID;

		// CustomerNama
		$this->CustomerNama = new crField('r04_jual', 'r04_jual', 'x_CustomerNama', 'CustomerNama', '`CustomerNama`', 200, EWR_DATATYPE_STRING, -1);
		$this->CustomerNama->Sortable = TRUE; // Allow sort
		$this->CustomerNama->GroupingFieldId = 3;
		$this->CustomerNama->ShowGroupHeaderAsRow = $this->ShowGroupHeaderAsRow;
		$this->CustomerNama->ShowCompactSummaryFooter = $this->ShowCompactSummaryFooter;
		$this->CustomerNama->DateFilter = "";
		$this->CustomerNama->SqlSelect = "";
		$this->CustomerNama->SqlOrderBy = "";
		$this->CustomerNama->FldGroupByType = "";
		$this->CustomerNama->FldGroupInt = "0";
		$this->CustomerNama->FldGroupSql = "";
		$this->fields['CustomerNama'] = &$this->CustomerNama;

		// CustomerPO
		$this->CustomerPO = new crField('r04_jual', 'r04_jual', 'x_CustomerPO', 'CustomerPO', '`CustomerPO`', 200, EWR_DATATYPE_STRING, -1);
		$this->CustomerPO->Sortable = TRUE; // Allow sort
		$this->CustomerPO->GroupingFieldId = 4;
		$this->CustomerPO->ShowGroupHeaderAsRow = $this->ShowGroupHeaderAsRow;
		$this->CustomerPO->ShowCompactSummaryFooter = $this->ShowCompactSummaryFooter;
		$this->CustomerPO->DateFilter = "";
		$this->CustomerPO->SqlSelect = "";
		$this->CustomerPO->SqlOrderBy = "";
		$this->CustomerPO->FldGroupByType = "";
		$this->CustomerPO->FldGroupInt = "0";
		$this->CustomerPO->FldGroupSql = "";
		$this->fields['CustomerPO'] = &$this->CustomerPO;

		// ArticleID
		$this->ArticleID = new crField('r04_jual', 'r04_jual', 'x_ArticleID', 'ArticleID', '`ArticleID`', 3, EWR_DATATYPE_NUMBER, -1);
		$this->ArticleID->Sortable = TRUE; // Allow sort
		$this->ArticleID->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->ArticleID->DateFilter = "";
		$this->ArticleID->SqlSelect = "";
		$this->ArticleID->SqlOrderBy = "";
		$this->fields['ArticleID'] = &$this->ArticleID;

		// ArticleNama
		$this->ArticleNama = new crField('r04_jual', 'r04_jual', 'x_ArticleNama', 'ArticleNama', '`ArticleNama`', 200, EWR_DATATYPE_STRING, -1);
		$this->ArticleNama->Sortable = TRUE; // Allow sort
		$this->ArticleNama->DateFilter = "";
		$this->ArticleNama->SqlSelect = "";
		$this->ArticleNama->SqlOrderBy = "";
		$this->fields['ArticleNama'] = &$this->ArticleNama;

		// HargaJual
		$this->HargaJual = new crField('r04_jual', 'r04_jual', 'x_HargaJual', 'HargaJual', '`HargaJual`', 4, EWR_DATATYPE_NUMBER, -1);
		$this->HargaJual->Sortable = TRUE; // Allow sort
		$this->HargaJual->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->HargaJual->DateFilter = "";
		$this->HargaJual->SqlSelect = "";
		$this->HargaJual->SqlOrderBy = "";
		$this->fields['HargaJual'] = &$this->HargaJual;

		// Qty
		$this->Qty = new crField('r04_jual', 'r04_jual', 'x_Qty', 'Qty', '`Qty`', 4, EWR_DATATYPE_NUMBER, -1);
		$this->Qty->Sortable = TRUE; // Allow sort
		$this->Qty->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->Qty->DateFilter = "";
		$this->Qty->SqlSelect = "";
		$this->Qty->SqlOrderBy = "";
		$this->fields['Qty'] = &$this->Qty;

		// SatuanNama
		$this->SatuanNama = new crField('r04_jual', 'r04_jual', 'x_SatuanNama', 'SatuanNama', '`SatuanNama`', 200, EWR_DATATYPE_STRING, -1);
		$this->SatuanNama->Sortable = TRUE; // Allow sort
		$this->SatuanNama->DateFilter = "";
		$this->SatuanNama->SqlSelect = "";
		$this->SatuanNama->SqlOrderBy = "";
		$this->fields['SatuanNama'] = &$this->SatuanNama;

		// SubTotal
		$this->SubTotal = new crField('r04_jual', 'r04_jual', 'x_SubTotal', 'SubTotal', '`SubTotal`', 4, EWR_DATATYPE_NUMBER, -1);
		$this->SubTotal->Sortable = TRUE; // Allow sort
		$this->SubTotal->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->SubTotal->DateFilter = "";
		$this->SubTotal->SqlSelect = "";
		$this->SubTotal->SqlOrderBy = "";
		$this->fields['SubTotal'] = &$this->SubTotal;
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
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`v04_jual`";
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
		return ($this->_SqlSelect <> "") ? $this->_SqlSelect : "SELECT *, (select nama from t03_customer where id = customerid) AS `CustomerNama`, (select concat(kode, ' - ', nama) from t06_article where id = articleid) AS `ArticleNama`, (SELECT b.nama FROM t06_article a, t07_satuan b where articleid = a.id and a.satuanid = b.id) AS `SatuanNama` FROM " . $this->getSqlFrom();
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
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "`TglSO` ASC, `NoSO` ASC, `CustomerNama` ASC, `CustomerPO` ASC";
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
		return ($this->_SqlFirstGroupField <> "") ? $this->_SqlFirstGroupField : "`TglSO`";
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
		return ($this->_SqlOrderByGroup <> "") ? $this->_SqlOrderByGroup : "`TglSO` ASC";
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
		return ($this->_SqlSelectAgg <> "") ? $this->_SqlSelectAgg : "SELECT SUM(`SubTotal`) AS `sum_subtotal` FROM " . $this->getSqlFrom();
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
		case "x_CustomerNama":
			$fld->LookupFilters = array("d" => "DB", "f0" => '`CustomerNama` = {filter_value}', "t0" => "200", "fn0" => "", "dlm" => ewr_Encrypt($fld->FldDelimiter), "af" => json_encode($fld->AdvancedFilters));
		$sWhereWrk = "";
		$fld->LookupFilters += array(
			"select" => "SELECT DISTINCT `CustomerNama`, `CustomerNama` AS `DispFld`, '' AS `DispFld2`, '' AS `DispFld3`, '' AS `DispFld4` FROM `v04_jual`",
			"where" => $sWhereWrk,
			"orderby" => "`CustomerNama` ASC"
		);
		$this->Lookup_Selecting($fld, $fld->LookupFilters["where"]); // Call Lookup selecting
		$fld->LookupFilters["s"] = ewr_BuildReportSql($fld->LookupFilters["select"], $fld->LookupFilters["where"], "", "", $fld->LookupFilters["orderby"], "", "");
			break;
		case "x_ArticleNama":
			$fld->LookupFilters = array("d" => "DB", "f0" => '`ArticleNama` = {filter_value}', "t0" => "200", "fn0" => "", "dlm" => ewr_Encrypt($fld->FldDelimiter), "af" => json_encode($fld->AdvancedFilters));
		$sWhereWrk = "";
		$fld->LookupFilters += array(
			"select" => "SELECT DISTINCT `ArticleNama`, `ArticleNama` AS `DispFld`, '' AS `DispFld2`, '' AS `DispFld3`, '' AS `DispFld4` FROM `v04_jual`",
			"where" => $sWhereWrk,
			"orderby" => "`ArticleNama` ASC"
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
