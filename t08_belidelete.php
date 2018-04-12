<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "t08_beliinfo.php" ?>
<?php include_once "t96_employeesinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$t08_beli_delete = NULL; // Initialize page object first

class ct08_beli_delete extends ct08_beli {

	// Page ID
	var $PageID = 'delete';

	// Project ID
	var $ProjectID = '{8746EF3F-81FE-4C1C-A7F8-AC191F8DDBB2}';

	// Table name
	var $TableName = 't08_beli';

	// Page object name
	var $PageObjName = 't08_beli_delete';

	// Page headings
	var $Heading = '';
	var $Subheading = '';

	// Page heading
	function PageHeading() {
		global $Language;
		if ($this->Heading <> "")
			return $this->Heading;
		if (method_exists($this, "TableCaption"))
			return $this->TableCaption();
		return "";
	}

	// Page subheading
	function PageSubheading() {
		global $Language;
		if ($this->Subheading <> "")
			return $this->Subheading;
		if ($this->TableName)
			return $Language->Phrase($this->PageID);
		return "";
	}

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		if ($this->UseTokenInUrl) $PageUrl .= "t=" . $this->TableVar . "&"; // Add page token
		return $PageUrl;
	}
	var $AuditTrailOnAdd = TRUE;
	var $AuditTrailOnEdit = TRUE;
	var $AuditTrailOnDelete = TRUE;
	var $AuditTrailOnView = FALSE;
	var $AuditTrailOnViewData = FALSE;
	var $AuditTrailOnSearch = FALSE;

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_MESSAGE], $v);
	}

	function getFailureMessage() {
		return @$_SESSION[EW_SESSION_FAILURE_MESSAGE];
	}

	function setFailureMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_FAILURE_MESSAGE], $v);
	}

	function getSuccessMessage() {
		return @$_SESSION[EW_SESSION_SUCCESS_MESSAGE];
	}

	function setSuccessMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_SUCCESS_MESSAGE], $v);
	}

	function getWarningMessage() {
		return @$_SESSION[EW_SESSION_WARNING_MESSAGE];
	}

	function setWarningMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_WARNING_MESSAGE], $v);
	}

	// Methods to clear message
	function ClearMessage() {
		$_SESSION[EW_SESSION_MESSAGE] = "";
	}

	function ClearFailureMessage() {
		$_SESSION[EW_SESSION_FAILURE_MESSAGE] = "";
	}

	function ClearSuccessMessage() {
		$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = "";
	}

	function ClearWarningMessage() {
		$_SESSION[EW_SESSION_WARNING_MESSAGE] = "";
	}

	function ClearMessages() {
		$_SESSION[EW_SESSION_MESSAGE] = "";
		$_SESSION[EW_SESSION_FAILURE_MESSAGE] = "";
		$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = "";
		$_SESSION[EW_SESSION_WARNING_MESSAGE] = "";
	}

	// Show message
	function ShowMessage() {
		$hidden = FALSE;
		$html = "";

		// Message
		$sMessage = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sMessage, "");
		if ($sMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sMessage;
			$html .= "<div class=\"alert alert-info ewInfo\">" . $sMessage . "</div>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$sWarningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sWarningMessage, "warning");
		if ($sWarningMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sWarningMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sWarningMessage;
			$html .= "<div class=\"alert alert-warning ewWarning\">" . $sWarningMessage . "</div>";
			$_SESSION[EW_SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sSuccessMessage, "success");
		if ($sSuccessMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sSuccessMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sSuccessMessage;
			$html .= "<div class=\"alert alert-success ewSuccess\">" . $sSuccessMessage . "</div>";
			$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sErrorMessage, "failure");
		if ($sErrorMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sErrorMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sErrorMessage;
			$html .= "<div class=\"alert alert-danger ewError\">" . $sErrorMessage . "</div>";
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo "<div class=\"ewMessageDialog\"" . (($hidden) ? " style=\"display: none;\"" : "") . ">" . $html . "</div>";
	}
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") { // Header exists, display
			echo "<p>" . $sHeader . "</p>";
		}
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") { // Footer exists, display
			echo "<p>" . $sFooter . "</p>";
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm;
		if ($this->UseTokenInUrl) {
			if ($objForm)
				return ($this->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($this->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}
	var $Token = "";
	var $TokenTimeout = 0;
	var $CheckToken = EW_CHECK_TOKEN;
	var $CheckTokenFn = "ew_CheckToken";
	var $CreateTokenFn = "ew_CreateToken";

	// Valid Post
	function ValidPost() {
		if (!$this->CheckToken || !ew_IsPost())
			return TRUE;
		if (!isset($_POST[EW_TOKEN_NAME]))
			return FALSE;
		$fn = $this->CheckTokenFn;
		if (is_callable($fn))
			return $fn($_POST[EW_TOKEN_NAME], $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	function CreateToken() {
		global $gsToken;
		if ($this->CheckToken) {
			$fn = $this->CreateTokenFn;
			if ($this->Token == "" && is_callable($fn)) // Create token
				$this->Token = $fn();
			$gsToken = $this->Token; // Save to global variable
		}
	}

	//
	// Page class constructor
	//
	function __construct() {
		global $conn, $Language;
		global $UserTable, $UserTableConn;
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = ew_SessionTimeoutTime();

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Parent constuctor
		parent::__construct();

		// Table object (t08_beli)
		if (!isset($GLOBALS["t08_beli"]) || get_class($GLOBALS["t08_beli"]) == "ct08_beli") {
			$GLOBALS["t08_beli"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t08_beli"];
		}

		// Table object (t96_employees)
		if (!isset($GLOBALS['t96_employees'])) $GLOBALS['t96_employees'] = new ct96_employees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 't08_beli', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"]))
			$GLOBALS["gTimer"] = new cTimer();

		// Debug message
		ew_LoadDebugMsg();

		// Open connection
		if (!isset($conn))
			$conn = ew_Connect($this->DBID);

		// User table object (t96_employees)
		if (!isset($UserTable)) {
			$UserTable = new ct96_employees();
			$UserTableConn = Conn($UserTable->DBID);
		}
	}

	//
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsCustomExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;

		// User profile
		$UserProfile = new cUserProfile();

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName);
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loaded();
		if (!$Security->CanDelete()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage(ew_DeniedMsg()); // Set no permission
			if ($Security->CanList())
				$this->Page_Terminate(ew_GetUrl("t08_belilist.php"));
			else
				$this->Page_Terminate(ew_GetUrl("login.php"));
		}
		if ($Security->IsLoggedIn()) {
			$Security->UserID_Loading();
			$Security->LoadUserID();
			$Security->UserID_Loaded();
		}

		// NOTE: Security object may be needed in other part of the script, skip set to Nothing
		// 
		// Security = null;
		// 

		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action
		$this->TglPO->SetVisibility();
		$this->NoPO->SetVisibility();
		$this->VendorID->SetVisibility();
		$this->ArticleID->SetVisibility();
		$this->Harga->SetVisibility();
		$this->Qty->SetVisibility();
		$this->SatuanID->SetVisibility();
		$this->SubTotal->SetVisibility();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->ValidPost()) {
			echo $Language->Phrase("InvalidPostRequest");
			$this->Page_Terminate();
			exit();
		}

		// Create Token
		$this->CreateToken();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $gsExportFile, $gTmpImages;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $EW_EXPORT, $t08_beli;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($t08_beli);
				$doc->Text = $sContent;
				if ($this->Export == "email")
					echo $this->ExportEmail($doc->Text);
				else
					$doc->Export();
				ew_DeleteTmpImages(); // Delete temp images
				exit();
			}
		}
		$this->Page_Redirecting($url);

		// Close connection
		ew_CloseConn();

		// Go to URL if specified
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			ew_SaveDebugMsg();
			header("Location: " . $url);
		}
		exit();
	}
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $StartRec;
	var $TotalRecs = 0;
	var $RecCnt;
	var $RecKeys = array();
	var $Recordset;
	var $StartRowCnt = 1;
	var $RowCnt = 0;

	//
	// Page main
	//
	function Page_Main() {
		global $Language;

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Load key parameters
		$this->RecKeys = $this->GetRecordKeys(); // Load record keys
		$sFilter = $this->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("t08_belilist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in t08_beli class, t08_beliinfo.php

		$this->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$this->CurrentAction = $_POST["a_delete"];
		} elseif (@$_GET["a_delete"] == "1") {
			$this->CurrentAction = "D"; // Delete record directly
		} else {
			$this->CurrentAction = "I"; // Display record
		}
		if ($this->CurrentAction == "D") {
			$this->SendEmail = TRUE; // Send email on delete success
			if ($this->DeleteRows()) { // Delete rows
				if ($this->getSuccessMessage() == "")
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
				$this->Page_Terminate($this->getReturnUrl()); // Return to caller
			} else { // Delete failed
				$this->CurrentAction = "I"; // Display record
			}
		}
		if ($this->CurrentAction == "I") { // Load records for display
			if ($this->Recordset = $this->LoadRecordset())
				$this->TotalRecs = $this->Recordset->RecordCount(); // Get record count
			if ($this->TotalRecs <= 0) { // No record found, exit
				if ($this->Recordset)
					$this->Recordset->Close();
				$this->Page_Terminate("t08_belilist.php"); // Return to list
			}
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {

		// Load List page SQL
		$sSql = $this->ListSQL();
		$conn = &$this->Connection();

		// Load recordset
		$dbtype = ew_GetConnectionType($this->DBID);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			if ($dbtype == "MSSQL") {
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset, array("_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderByList())));
			} else {
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = '';
		} else {
			$rs = ew_LoadRecordset($sSql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $Security, $Language;
		$sFilter = $this->KeyFilter();

		// Call Row Selecting event
		$this->Row_Selecting($sFilter);

		// Load SQL based on filter
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues($rs = NULL) {
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->NewRow(); 

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->id->setDbValue($row['id']);
		$this->TglPO->setDbValue($row['TglPO']);
		$this->NoPO->setDbValue($row['NoPO']);
		$this->VendorID->setDbValue($row['VendorID']);
		$this->ArticleID->setDbValue($row['ArticleID']);
		if (array_key_exists('EV__ArticleID', $rs->fields)) {
			$this->ArticleID->VirtualValue = $rs->fields('EV__ArticleID'); // Set up virtual field value
		} else {
			$this->ArticleID->VirtualValue = ""; // Clear value
		}
		$this->Harga->setDbValue($row['Harga']);
		$this->Qty->setDbValue($row['Qty']);
		$this->SatuanID->setDbValue($row['SatuanID']);
		if (array_key_exists('EV__SatuanID', $rs->fields)) {
			$this->SatuanID->VirtualValue = $rs->fields('EV__SatuanID'); // Set up virtual field value
		} else {
			$this->SatuanID->VirtualValue = ""; // Clear value
		}
		$this->SubTotal->setDbValue($row['SubTotal']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['id'] = NULL;
		$row['TglPO'] = NULL;
		$row['NoPO'] = NULL;
		$row['VendorID'] = NULL;
		$row['ArticleID'] = NULL;
		$row['Harga'] = NULL;
		$row['Qty'] = NULL;
		$row['SatuanID'] = NULL;
		$row['SubTotal'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->TglPO->DbValue = $row['TglPO'];
		$this->NoPO->DbValue = $row['NoPO'];
		$this->VendorID->DbValue = $row['VendorID'];
		$this->ArticleID->DbValue = $row['ArticleID'];
		$this->Harga->DbValue = $row['Harga'];
		$this->Qty->DbValue = $row['Qty'];
		$this->SatuanID->DbValue = $row['SatuanID'];
		$this->SubTotal->DbValue = $row['SubTotal'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->Harga->FormValue == $this->Harga->CurrentValue && is_numeric(ew_StrToFloat($this->Harga->CurrentValue)))
			$this->Harga->CurrentValue = ew_StrToFloat($this->Harga->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Qty->FormValue == $this->Qty->CurrentValue && is_numeric(ew_StrToFloat($this->Qty->CurrentValue)))
			$this->Qty->CurrentValue = ew_StrToFloat($this->Qty->CurrentValue);

		// Convert decimal values if posted back
		if ($this->SubTotal->FormValue == $this->SubTotal->CurrentValue && is_numeric(ew_StrToFloat($this->SubTotal->CurrentValue)))
			$this->SubTotal->CurrentValue = ew_StrToFloat($this->SubTotal->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// TglPO
		// NoPO
		// VendorID
		// ArticleID
		// Harga
		// Qty
		// SatuanID
		// SubTotal

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// TglPO
		$this->TglPO->ViewValue = $this->TglPO->CurrentValue;
		$this->TglPO->ViewValue = ew_FormatDateTime($this->TglPO->ViewValue, 7);
		$this->TglPO->ViewCustomAttributes = "";

		// NoPO
		$this->NoPO->ViewValue = $this->NoPO->CurrentValue;
		$this->NoPO->ViewCustomAttributes = "";

		// VendorID
		if (strval($this->VendorID->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->VendorID->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `Nama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t02_vendor`";
		$sWhereWrk = "";
		$this->VendorID->LookupFilters = array("dx1" => '`Nama`');
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->VendorID, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->VendorID->ViewValue = $this->VendorID->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->VendorID->ViewValue = $this->VendorID->CurrentValue;
			}
		} else {
			$this->VendorID->ViewValue = NULL;
		}
		$this->VendorID->ViewCustomAttributes = "";

		// ArticleID
		if ($this->ArticleID->VirtualValue <> "") {
			$this->ArticleID->ViewValue = $this->ArticleID->VirtualValue;
		} else {
		if (strval($this->ArticleID->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->ArticleID->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `Kode` AS `DispFld`, `Nama` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t06_article`";
		$sWhereWrk = "";
		$this->ArticleID->LookupFilters = array("dx1" => '`Kode`', "dx2" => '`Nama`');
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->ArticleID, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$arwrk[2] = $rswrk->fields('Disp2Fld');
				$this->ArticleID->ViewValue = $this->ArticleID->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->ArticleID->ViewValue = $this->ArticleID->CurrentValue;
			}
		} else {
			$this->ArticleID->ViewValue = NULL;
		}
		}
		$this->ArticleID->ViewCustomAttributes = "";

		// Harga
		$this->Harga->ViewValue = $this->Harga->CurrentValue;
		$this->Harga->ViewValue = ew_FormatNumber($this->Harga->ViewValue, 2, -2, -2, -2);
		$this->Harga->CellCssStyle .= "text-align: right;";
		$this->Harga->ViewCustomAttributes = "";

		// Qty
		$this->Qty->ViewValue = $this->Qty->CurrentValue;
		$this->Qty->ViewValue = ew_FormatNumber($this->Qty->ViewValue, 2, -2, -2, -2);
		$this->Qty->CellCssStyle .= "text-align: right;";
		$this->Qty->ViewCustomAttributes = "";

		// SatuanID
		if ($this->SatuanID->VirtualValue <> "") {
			$this->SatuanID->ViewValue = $this->SatuanID->VirtualValue;
		} else {
			$this->SatuanID->ViewValue = $this->SatuanID->CurrentValue;
		if (strval($this->SatuanID->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->SatuanID->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `Nama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t07_satuan`";
		$sWhereWrk = "";
		$this->SatuanID->LookupFilters = array("dx1" => '`Nama`');
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->SatuanID, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->SatuanID->ViewValue = $this->SatuanID->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->SatuanID->ViewValue = $this->SatuanID->CurrentValue;
			}
		} else {
			$this->SatuanID->ViewValue = NULL;
		}
		}
		$this->SatuanID->ViewCustomAttributes = "";

		// SubTotal
		$this->SubTotal->ViewValue = $this->SubTotal->CurrentValue;
		$this->SubTotal->ViewValue = ew_FormatNumber($this->SubTotal->ViewValue, 2, -2, -2, -2);
		$this->SubTotal->CellCssStyle .= "text-align: right;";
		$this->SubTotal->ViewCustomAttributes = "";

			// TglPO
			$this->TglPO->LinkCustomAttributes = "";
			$this->TglPO->HrefValue = "";
			$this->TglPO->TooltipValue = "";

			// NoPO
			$this->NoPO->LinkCustomAttributes = "";
			$this->NoPO->HrefValue = "";
			$this->NoPO->TooltipValue = "";

			// VendorID
			$this->VendorID->LinkCustomAttributes = "";
			$this->VendorID->HrefValue = "";
			$this->VendorID->TooltipValue = "";

			// ArticleID
			$this->ArticleID->LinkCustomAttributes = "";
			$this->ArticleID->HrefValue = "";
			$this->ArticleID->TooltipValue = "";

			// Harga
			$this->Harga->LinkCustomAttributes = "";
			$this->Harga->HrefValue = "";
			$this->Harga->TooltipValue = "";

			// Qty
			$this->Qty->LinkCustomAttributes = "";
			$this->Qty->HrefValue = "";
			$this->Qty->TooltipValue = "";

			// SatuanID
			$this->SatuanID->LinkCustomAttributes = "";
			$this->SatuanID->HrefValue = "";
			$this->SatuanID->TooltipValue = "";

			// SubTotal
			$this->SubTotal->LinkCustomAttributes = "";
			$this->SubTotal->HrefValue = "";
			$this->SubTotal->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $Language, $Security;
		if (!$Security->CanDelete()) {
			$this->setFailureMessage($Language->Phrase("NoDeletePermission")); // No delete permission
			return FALSE;
		}
		$DeleteRows = TRUE;
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;
		}
		$rows = ($rs) ? $rs->GetRows() : array();
		$conn->BeginTrans();
		if ($this->AuditTrailOnDelete) $this->WriteAuditTrailDummy($Language->Phrase("BatchDeleteBegin")); // Batch delete begin

		// Clone old rows
		$rsold = $rows;
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $this->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
				$sThisKey .= $row['id'];
				$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
				$DeleteRows = $this->Delete($row); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		}
		if (!$DeleteRows) {

			// Set up error message
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
			if ($this->AuditTrailOnDelete) $this->WriteAuditTrailDummy($Language->Phrase("BatchDeleteSuccess")); // Batch delete success
		} else {
			$conn->RollbackTrans(); // Rollback changes
			if ($this->AuditTrailOnDelete) $this->WriteAuditTrailDummy($Language->Phrase("BatchDeleteRollback")); // Batch delete rollback
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$this->Row_Deleted($row);
			}
		}
		return $DeleteRows;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("t08_belilist.php"), "", $this->TableVar, TRUE);
		$PageId = "delete";
		$Breadcrumb->Add("delete", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		}
	}

	// Setup AutoSuggest filters of a field
	function SetupAutoSuggestFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($t08_beli_delete)) $t08_beli_delete = new ct08_beli_delete();

// Page init
$t08_beli_delete->Page_Init();

// Page main
$t08_beli_delete->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t08_beli_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "delete";
var CurrentForm = ft08_belidelete = new ew_Form("ft08_belidelete", "delete");

// Form_CustomValidate event
ft08_belidelete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ft08_belidelete.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ft08_belidelete.Lists["x_VendorID"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nama","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t02_vendor"};
ft08_belidelete.Lists["x_VendorID"].Data = "<?php echo $t08_beli_delete->VendorID->LookupFilterQuery(FALSE, "delete") ?>";
ft08_belidelete.Lists["x_ArticleID"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Kode","x_Nama","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t06_article"};
ft08_belidelete.Lists["x_ArticleID"].Data = "<?php echo $t08_beli_delete->ArticleID->LookupFilterQuery(FALSE, "delete") ?>";
ft08_belidelete.Lists["x_SatuanID"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nama","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t07_satuan"};
ft08_belidelete.Lists["x_SatuanID"].Data = "<?php echo $t08_beli_delete->SatuanID->LookupFilterQuery(FALSE, "delete") ?>";
ft08_belidelete.AutoSuggests["x_SatuanID"] = <?php echo json_encode(array("data" => "ajax=autosuggest&" . $t08_beli_delete->SatuanID->LookupFilterQuery(TRUE, "delete"))) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $t08_beli_delete->ShowPageHeader(); ?>
<?php
$t08_beli_delete->ShowMessage();
?>
<form name="ft08_belidelete" id="ft08_belidelete" class="form-inline ewForm ewDeleteForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t08_beli_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t08_beli_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t08_beli">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($t08_beli_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="box ewBox ewGrid">
<div class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table class="table ewTable">
	<thead>
	<tr class="ewTableHeader">
<?php if ($t08_beli->TglPO->Visible) { // TglPO ?>
		<th class="<?php echo $t08_beli->TglPO->HeaderCellClass() ?>"><span id="elh_t08_beli_TglPO" class="t08_beli_TglPO"><?php echo $t08_beli->TglPO->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t08_beli->NoPO->Visible) { // NoPO ?>
		<th class="<?php echo $t08_beli->NoPO->HeaderCellClass() ?>"><span id="elh_t08_beli_NoPO" class="t08_beli_NoPO"><?php echo $t08_beli->NoPO->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t08_beli->VendorID->Visible) { // VendorID ?>
		<th class="<?php echo $t08_beli->VendorID->HeaderCellClass() ?>"><span id="elh_t08_beli_VendorID" class="t08_beli_VendorID"><?php echo $t08_beli->VendorID->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t08_beli->ArticleID->Visible) { // ArticleID ?>
		<th class="<?php echo $t08_beli->ArticleID->HeaderCellClass() ?>"><span id="elh_t08_beli_ArticleID" class="t08_beli_ArticleID"><?php echo $t08_beli->ArticleID->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t08_beli->Harga->Visible) { // Harga ?>
		<th class="<?php echo $t08_beli->Harga->HeaderCellClass() ?>"><span id="elh_t08_beli_Harga" class="t08_beli_Harga"><?php echo $t08_beli->Harga->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t08_beli->Qty->Visible) { // Qty ?>
		<th class="<?php echo $t08_beli->Qty->HeaderCellClass() ?>"><span id="elh_t08_beli_Qty" class="t08_beli_Qty"><?php echo $t08_beli->Qty->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t08_beli->SatuanID->Visible) { // SatuanID ?>
		<th class="<?php echo $t08_beli->SatuanID->HeaderCellClass() ?>"><span id="elh_t08_beli_SatuanID" class="t08_beli_SatuanID"><?php echo $t08_beli->SatuanID->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t08_beli->SubTotal->Visible) { // SubTotal ?>
		<th class="<?php echo $t08_beli->SubTotal->HeaderCellClass() ?>"><span id="elh_t08_beli_SubTotal" class="t08_beli_SubTotal"><?php echo $t08_beli->SubTotal->FldCaption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t08_beli_delete->RecCnt = 0;
$i = 0;
while (!$t08_beli_delete->Recordset->EOF) {
	$t08_beli_delete->RecCnt++;
	$t08_beli_delete->RowCnt++;

	// Set row properties
	$t08_beli->ResetAttrs();
	$t08_beli->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$t08_beli_delete->LoadRowValues($t08_beli_delete->Recordset);

	// Render row
	$t08_beli_delete->RenderRow();
?>
	<tr<?php echo $t08_beli->RowAttributes() ?>>
<?php if ($t08_beli->TglPO->Visible) { // TglPO ?>
		<td<?php echo $t08_beli->TglPO->CellAttributes() ?>>
<span id="el<?php echo $t08_beli_delete->RowCnt ?>_t08_beli_TglPO" class="t08_beli_TglPO">
<span<?php echo $t08_beli->TglPO->ViewAttributes() ?>>
<?php echo $t08_beli->TglPO->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t08_beli->NoPO->Visible) { // NoPO ?>
		<td<?php echo $t08_beli->NoPO->CellAttributes() ?>>
<span id="el<?php echo $t08_beli_delete->RowCnt ?>_t08_beli_NoPO" class="t08_beli_NoPO">
<span<?php echo $t08_beli->NoPO->ViewAttributes() ?>>
<?php echo $t08_beli->NoPO->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t08_beli->VendorID->Visible) { // VendorID ?>
		<td<?php echo $t08_beli->VendorID->CellAttributes() ?>>
<span id="el<?php echo $t08_beli_delete->RowCnt ?>_t08_beli_VendorID" class="t08_beli_VendorID">
<span<?php echo $t08_beli->VendorID->ViewAttributes() ?>>
<?php echo $t08_beli->VendorID->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t08_beli->ArticleID->Visible) { // ArticleID ?>
		<td<?php echo $t08_beli->ArticleID->CellAttributes() ?>>
<span id="el<?php echo $t08_beli_delete->RowCnt ?>_t08_beli_ArticleID" class="t08_beli_ArticleID">
<span<?php echo $t08_beli->ArticleID->ViewAttributes() ?>>
<?php echo $t08_beli->ArticleID->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t08_beli->Harga->Visible) { // Harga ?>
		<td<?php echo $t08_beli->Harga->CellAttributes() ?>>
<span id="el<?php echo $t08_beli_delete->RowCnt ?>_t08_beli_Harga" class="t08_beli_Harga">
<span<?php echo $t08_beli->Harga->ViewAttributes() ?>>
<?php echo $t08_beli->Harga->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t08_beli->Qty->Visible) { // Qty ?>
		<td<?php echo $t08_beli->Qty->CellAttributes() ?>>
<span id="el<?php echo $t08_beli_delete->RowCnt ?>_t08_beli_Qty" class="t08_beli_Qty">
<span<?php echo $t08_beli->Qty->ViewAttributes() ?>>
<?php echo $t08_beli->Qty->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t08_beli->SatuanID->Visible) { // SatuanID ?>
		<td<?php echo $t08_beli->SatuanID->CellAttributes() ?>>
<span id="el<?php echo $t08_beli_delete->RowCnt ?>_t08_beli_SatuanID" class="t08_beli_SatuanID">
<span<?php echo $t08_beli->SatuanID->ViewAttributes() ?>>
<?php echo $t08_beli->SatuanID->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t08_beli->SubTotal->Visible) { // SubTotal ?>
		<td<?php echo $t08_beli->SubTotal->CellAttributes() ?>>
<span id="el<?php echo $t08_beli_delete->RowCnt ?>_t08_beli_SubTotal" class="t08_beli_SubTotal">
<span<?php echo $t08_beli->SubTotal->ViewAttributes() ?>>
<?php echo $t08_beli->SubTotal->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t08_beli_delete->Recordset->MoveNext();
}
$t08_beli_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $t08_beli_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<script type="text/javascript">
ft08_belidelete.Init();
</script>
<?php
$t08_beli_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t08_beli_delete->Page_Terminate();
?>
