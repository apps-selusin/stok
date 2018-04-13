<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "t09_hutanginfo.php" ?>
<?php include_once "t96_employeesinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$t09_hutang_delete = NULL; // Initialize page object first

class ct09_hutang_delete extends ct09_hutang {

	// Page ID
	var $PageID = 'delete';

	// Project ID
	var $ProjectID = '{8746EF3F-81FE-4C1C-A7F8-AC191F8DDBB2}';

	// Table name
	var $TableName = 't09_hutang';

	// Page object name
	var $PageObjName = 't09_hutang_delete';

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

		// Table object (t09_hutang)
		if (!isset($GLOBALS["t09_hutang"]) || get_class($GLOBALS["t09_hutang"]) == "ct09_hutang") {
			$GLOBALS["t09_hutang"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t09_hutang"];
		}

		// Table object (t96_employees)
		if (!isset($GLOBALS['t96_employees'])) $GLOBALS['t96_employees'] = new ct96_employees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 't09_hutang', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("t09_hutanglist.php"));
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
		$this->NoHutang->SetVisibility();
		$this->BeliID->SetVisibility();
		$this->JumlahHutang->SetVisibility();
		$this->JumlahBayar->SetVisibility();

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
		global $EW_EXPORT, $t09_hutang;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($t09_hutang);
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
			$this->Page_Terminate("t09_hutanglist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in t09_hutang class, t09_hutanginfo.php

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
				$this->Page_Terminate("t09_hutanglist.php"); // Return to list
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
		$this->NoHutang->setDbValue($row['NoHutang']);
		$this->BeliID->setDbValue($row['BeliID']);
		if (array_key_exists('EV__BeliID', $rs->fields)) {
			$this->BeliID->VirtualValue = $rs->fields('EV__BeliID'); // Set up virtual field value
		} else {
			$this->BeliID->VirtualValue = ""; // Clear value
		}
		$this->JumlahHutang->setDbValue($row['JumlahHutang']);
		$this->JumlahBayar->setDbValue($row['JumlahBayar']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['id'] = NULL;
		$row['NoHutang'] = NULL;
		$row['BeliID'] = NULL;
		$row['JumlahHutang'] = NULL;
		$row['JumlahBayar'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->NoHutang->DbValue = $row['NoHutang'];
		$this->BeliID->DbValue = $row['BeliID'];
		$this->JumlahHutang->DbValue = $row['JumlahHutang'];
		$this->JumlahBayar->DbValue = $row['JumlahBayar'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->JumlahHutang->FormValue == $this->JumlahHutang->CurrentValue && is_numeric(ew_StrToFloat($this->JumlahHutang->CurrentValue)))
			$this->JumlahHutang->CurrentValue = ew_StrToFloat($this->JumlahHutang->CurrentValue);

		// Convert decimal values if posted back
		if ($this->JumlahBayar->FormValue == $this->JumlahBayar->CurrentValue && is_numeric(ew_StrToFloat($this->JumlahBayar->CurrentValue)))
			$this->JumlahBayar->CurrentValue = ew_StrToFloat($this->JumlahBayar->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// NoHutang
		// BeliID
		// JumlahHutang
		// JumlahBayar

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// NoHutang
		$this->NoHutang->ViewValue = $this->NoHutang->CurrentValue;
		$this->NoHutang->ViewCustomAttributes = "";

		// BeliID
		if ($this->BeliID->VirtualValue <> "") {
			$this->BeliID->ViewValue = $this->BeliID->VirtualValue;
		} else {
			$this->BeliID->ViewValue = $this->BeliID->CurrentValue;
		if (strval($this->BeliID->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->BeliID->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `TglPO` AS `DispFld`, `NoPO` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t08_beli`";
		$sWhereWrk = "";
		$this->BeliID->LookupFilters = array("df1" => "7", "dx1" => ew_CastDateFieldForLike('`TglPO`', 7, "DB"), "dx2" => '`NoPO`');
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->BeliID, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_FormatDateTime($rswrk->fields('DispFld'), 7);
				$arwrk[2] = $rswrk->fields('Disp2Fld');
				$this->BeliID->ViewValue = $this->BeliID->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->BeliID->ViewValue = $this->BeliID->CurrentValue;
			}
		} else {
			$this->BeliID->ViewValue = NULL;
		}
		}
		$this->BeliID->ViewCustomAttributes = "";

		// JumlahHutang
		$this->JumlahHutang->ViewValue = $this->JumlahHutang->CurrentValue;
		$this->JumlahHutang->ViewValue = ew_FormatNumber($this->JumlahHutang->ViewValue, 2, -2, -2, -2);
		$this->JumlahHutang->CellCssStyle .= "text-align: right;";
		$this->JumlahHutang->ViewCustomAttributes = "";

		// JumlahBayar
		$this->JumlahBayar->ViewValue = $this->JumlahBayar->CurrentValue;
		$this->JumlahBayar->ViewValue = ew_FormatNumber($this->JumlahBayar->ViewValue, 2, -2, -2, -2);
		$this->JumlahBayar->CellCssStyle .= "text-align: right;";
		$this->JumlahBayar->ViewCustomAttributes = "";

			// NoHutang
			$this->NoHutang->LinkCustomAttributes = "";
			$this->NoHutang->HrefValue = "";
			$this->NoHutang->TooltipValue = "";

			// BeliID
			$this->BeliID->LinkCustomAttributes = "";
			$this->BeliID->HrefValue = "";
			$this->BeliID->TooltipValue = "";

			// JumlahHutang
			$this->JumlahHutang->LinkCustomAttributes = "";
			$this->JumlahHutang->HrefValue = "";
			$this->JumlahHutang->TooltipValue = "";

			// JumlahBayar
			$this->JumlahBayar->LinkCustomAttributes = "";
			$this->JumlahBayar->HrefValue = "";
			$this->JumlahBayar->TooltipValue = "";
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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("t09_hutanglist.php"), "", $this->TableVar, TRUE);
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
if (!isset($t09_hutang_delete)) $t09_hutang_delete = new ct09_hutang_delete();

// Page init
$t09_hutang_delete->Page_Init();

// Page main
$t09_hutang_delete->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t09_hutang_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "delete";
var CurrentForm = ft09_hutangdelete = new ew_Form("ft09_hutangdelete", "delete");

// Form_CustomValidate event
ft09_hutangdelete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ft09_hutangdelete.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ft09_hutangdelete.Lists["x_BeliID"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_TglPO","x_NoPO","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t08_beli"};
ft09_hutangdelete.Lists["x_BeliID"].Data = "<?php echo $t09_hutang_delete->BeliID->LookupFilterQuery(FALSE, "delete") ?>";
ft09_hutangdelete.AutoSuggests["x_BeliID"] = <?php echo json_encode(array("data" => "ajax=autosuggest&" . $t09_hutang_delete->BeliID->LookupFilterQuery(TRUE, "delete"))) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $t09_hutang_delete->ShowPageHeader(); ?>
<?php
$t09_hutang_delete->ShowMessage();
?>
<form name="ft09_hutangdelete" id="ft09_hutangdelete" class="form-inline ewForm ewDeleteForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t09_hutang_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t09_hutang_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t09_hutang">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($t09_hutang_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="box ewBox ewGrid">
<div class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table class="table ewTable">
	<thead>
	<tr class="ewTableHeader">
<?php if ($t09_hutang->NoHutang->Visible) { // NoHutang ?>
		<th class="<?php echo $t09_hutang->NoHutang->HeaderCellClass() ?>"><span id="elh_t09_hutang_NoHutang" class="t09_hutang_NoHutang"><?php echo $t09_hutang->NoHutang->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t09_hutang->BeliID->Visible) { // BeliID ?>
		<th class="<?php echo $t09_hutang->BeliID->HeaderCellClass() ?>"><span id="elh_t09_hutang_BeliID" class="t09_hutang_BeliID"><?php echo $t09_hutang->BeliID->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t09_hutang->JumlahHutang->Visible) { // JumlahHutang ?>
		<th class="<?php echo $t09_hutang->JumlahHutang->HeaderCellClass() ?>"><span id="elh_t09_hutang_JumlahHutang" class="t09_hutang_JumlahHutang"><?php echo $t09_hutang->JumlahHutang->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t09_hutang->JumlahBayar->Visible) { // JumlahBayar ?>
		<th class="<?php echo $t09_hutang->JumlahBayar->HeaderCellClass() ?>"><span id="elh_t09_hutang_JumlahBayar" class="t09_hutang_JumlahBayar"><?php echo $t09_hutang->JumlahBayar->FldCaption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t09_hutang_delete->RecCnt = 0;
$i = 0;
while (!$t09_hutang_delete->Recordset->EOF) {
	$t09_hutang_delete->RecCnt++;
	$t09_hutang_delete->RowCnt++;

	// Set row properties
	$t09_hutang->ResetAttrs();
	$t09_hutang->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$t09_hutang_delete->LoadRowValues($t09_hutang_delete->Recordset);

	// Render row
	$t09_hutang_delete->RenderRow();
?>
	<tr<?php echo $t09_hutang->RowAttributes() ?>>
<?php if ($t09_hutang->NoHutang->Visible) { // NoHutang ?>
		<td<?php echo $t09_hutang->NoHutang->CellAttributes() ?>>
<span id="el<?php echo $t09_hutang_delete->RowCnt ?>_t09_hutang_NoHutang" class="t09_hutang_NoHutang">
<span<?php echo $t09_hutang->NoHutang->ViewAttributes() ?>>
<?php echo $t09_hutang->NoHutang->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t09_hutang->BeliID->Visible) { // BeliID ?>
		<td<?php echo $t09_hutang->BeliID->CellAttributes() ?>>
<span id="el<?php echo $t09_hutang_delete->RowCnt ?>_t09_hutang_BeliID" class="t09_hutang_BeliID">
<span<?php echo $t09_hutang->BeliID->ViewAttributes() ?>>
<?php echo $t09_hutang->BeliID->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t09_hutang->JumlahHutang->Visible) { // JumlahHutang ?>
		<td<?php echo $t09_hutang->JumlahHutang->CellAttributes() ?>>
<span id="el<?php echo $t09_hutang_delete->RowCnt ?>_t09_hutang_JumlahHutang" class="t09_hutang_JumlahHutang">
<span<?php echo $t09_hutang->JumlahHutang->ViewAttributes() ?>>
<?php echo $t09_hutang->JumlahHutang->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t09_hutang->JumlahBayar->Visible) { // JumlahBayar ?>
		<td<?php echo $t09_hutang->JumlahBayar->CellAttributes() ?>>
<span id="el<?php echo $t09_hutang_delete->RowCnt ?>_t09_hutang_JumlahBayar" class="t09_hutang_JumlahBayar">
<span<?php echo $t09_hutang->JumlahBayar->ViewAttributes() ?>>
<?php echo $t09_hutang->JumlahBayar->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t09_hutang_delete->Recordset->MoveNext();
}
$t09_hutang_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $t09_hutang_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<script type="text/javascript">
ft09_hutangdelete.Init();
</script>
<?php
$t09_hutang_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t09_hutang_delete->Page_Terminate();
?>
