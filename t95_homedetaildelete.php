<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "t95_homedetailinfo.php" ?>
<?php include_once "t96_employeesinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$t95_homedetail_delete = NULL; // Initialize page object first

class ct95_homedetail_delete extends ct95_homedetail {

	// Page ID
	var $PageID = 'delete';

	// Project ID
	var $ProjectID = '{8746EF3F-81FE-4C1C-A7F8-AC191F8DDBB2}';

	// Table name
	var $TableName = 't95_homedetail';

	// Page object name
	var $PageObjName = 't95_homedetail_delete';

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

		// Table object (t95_homedetail)
		if (!isset($GLOBALS["t95_homedetail"]) || get_class($GLOBALS["t95_homedetail"]) == "ct95_homedetail") {
			$GLOBALS["t95_homedetail"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t95_homedetail"];
		}

		// Table object (t96_employees)
		if (!isset($GLOBALS['t96_employees'])) $GLOBALS['t96_employees'] = new ct96_employees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 't95_homedetail', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("t95_homedetaillist.php"));
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
		$this->tgl->SetVisibility();
		$this->kat->SetVisibility();
		$this->no_jdl->SetVisibility();
		$this->jdl->SetVisibility();
		$this->no_ket->SetVisibility();
		$this->ket->SetVisibility();
		$this->done->SetVisibility();

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
		global $EW_EXPORT, $t95_homedetail;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($t95_homedetail);
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
			$this->Page_Terminate("t95_homedetaillist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in t95_homedetail class, t95_homedetailinfo.php

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
				$this->Page_Terminate("t95_homedetaillist.php"); // Return to list
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
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset, array("_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())));
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
		$this->home_id->setDbValue($row['home_id']);
		$this->tgl->setDbValue($row['tgl']);
		$this->kat->setDbValue($row['kat']);
		$this->no_jdl->setDbValue($row['no_jdl']);
		$this->jdl->setDbValue($row['jdl']);
		$this->no_ket->setDbValue($row['no_ket']);
		$this->ket->setDbValue($row['ket']);
		$this->done->setDbValue($row['done']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['home_id'] = NULL;
		$row['tgl'] = NULL;
		$row['kat'] = NULL;
		$row['no_jdl'] = NULL;
		$row['jdl'] = NULL;
		$row['no_ket'] = NULL;
		$row['ket'] = NULL;
		$row['done'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->home_id->DbValue = $row['home_id'];
		$this->tgl->DbValue = $row['tgl'];
		$this->kat->DbValue = $row['kat'];
		$this->no_jdl->DbValue = $row['no_jdl'];
		$this->jdl->DbValue = $row['jdl'];
		$this->no_ket->DbValue = $row['no_ket'];
		$this->ket->DbValue = $row['ket'];
		$this->done->DbValue = $row['done'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// home_id
		// tgl
		// kat
		// no_jdl
		// jdl
		// no_ket
		// ket
		// done

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// home_id
		$this->home_id->ViewValue = $this->home_id->CurrentValue;
		$this->home_id->ViewCustomAttributes = "";

		// tgl
		$this->tgl->ViewValue = $this->tgl->CurrentValue;
		$this->tgl->ViewValue = ew_FormatDateTime($this->tgl->ViewValue, 7);
		$this->tgl->ViewCustomAttributes = "";

		// kat
		if (strval($this->kat->CurrentValue) <> "") {
			$sFilterWrk = "`kode`" . ew_SearchString("=", $this->kat->CurrentValue, EW_DATATYPE_STRING, "");
		$sSqlWrk = "SELECT `kode`, `kode` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t94_home`";
		$sWhereWrk = "";
		$this->kat->LookupFilters = array("dx1" => '`kode`');
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->kat, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->kat->ViewValue = $this->kat->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->kat->ViewValue = $this->kat->CurrentValue;
			}
		} else {
			$this->kat->ViewValue = NULL;
		}
		$this->kat->ViewCustomAttributes = "";

		// no_jdl
		$this->no_jdl->ViewValue = $this->no_jdl->CurrentValue;
		$this->no_jdl->ViewCustomAttributes = "";

		// jdl
		$this->jdl->ViewValue = $this->jdl->CurrentValue;
		$this->jdl->ViewCustomAttributes = "";

		// no_ket
		$this->no_ket->ViewValue = $this->no_ket->CurrentValue;
		$this->no_ket->ViewCustomAttributes = "";

		// ket
		$this->ket->ViewValue = $this->ket->CurrentValue;
		$this->ket->ViewCustomAttributes = "";

		// done
		if (strval($this->done->CurrentValue) <> "") {
			$this->done->ViewValue = "";
			$arwrk = explode(",", strval($this->done->CurrentValue));
			$cnt = count($arwrk);
			for ($ari = 0; $ari < $cnt; $ari++) {
				$this->done->ViewValue .= $this->done->OptionCaption(trim($arwrk[$ari]));
				if ($ari < $cnt-1) $this->done->ViewValue .= ew_ViewOptionSeparator($ari);
			}
		} else {
			$this->done->ViewValue = NULL;
		}
		$this->done->ViewCustomAttributes = "";

			// tgl
			$this->tgl->LinkCustomAttributes = "";
			$this->tgl->HrefValue = "";
			$this->tgl->TooltipValue = "";

			// kat
			$this->kat->LinkCustomAttributes = "";
			$this->kat->HrefValue = "";
			$this->kat->TooltipValue = "";

			// no_jdl
			$this->no_jdl->LinkCustomAttributes = "";
			$this->no_jdl->HrefValue = "";
			$this->no_jdl->TooltipValue = "";

			// jdl
			$this->jdl->LinkCustomAttributes = "";
			$this->jdl->HrefValue = "";
			$this->jdl->TooltipValue = "";

			// no_ket
			$this->no_ket->LinkCustomAttributes = "";
			$this->no_ket->HrefValue = "";
			$this->no_ket->TooltipValue = "";

			// ket
			$this->ket->LinkCustomAttributes = "";
			$this->ket->HrefValue = "";
			$this->ket->TooltipValue = "";

			// done
			$this->done->LinkCustomAttributes = "";
			$this->done->HrefValue = "";
			$this->done->TooltipValue = "";
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
				$sThisKey .= $row['home_id'];
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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("t95_homedetaillist.php"), "", $this->TableVar, TRUE);
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
if (!isset($t95_homedetail_delete)) $t95_homedetail_delete = new ct95_homedetail_delete();

// Page init
$t95_homedetail_delete->Page_Init();

// Page main
$t95_homedetail_delete->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t95_homedetail_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "delete";
var CurrentForm = ft95_homedetaildelete = new ew_Form("ft95_homedetaildelete", "delete");

// Form_CustomValidate event
ft95_homedetaildelete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ft95_homedetaildelete.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ft95_homedetaildelete.Lists["x_kat"] = {"LinkField":"x_kode","Ajax":true,"AutoFill":false,"DisplayFields":["x_kode","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t94_home"};
ft95_homedetaildelete.Lists["x_kat"].Data = "<?php echo $t95_homedetail_delete->kat->LookupFilterQuery(FALSE, "delete") ?>";
ft95_homedetaildelete.Lists["x_done[]"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ft95_homedetaildelete.Lists["x_done[]"].Options = <?php echo json_encode($t95_homedetail_delete->done->Options()) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $t95_homedetail_delete->ShowPageHeader(); ?>
<?php
$t95_homedetail_delete->ShowMessage();
?>
<form name="ft95_homedetaildelete" id="ft95_homedetaildelete" class="form-inline ewForm ewDeleteForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t95_homedetail_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t95_homedetail_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t95_homedetail">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($t95_homedetail_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="box ewBox ewGrid">
<div class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table class="table ewTable">
	<thead>
	<tr class="ewTableHeader">
<?php if ($t95_homedetail->tgl->Visible) { // tgl ?>
		<th class="<?php echo $t95_homedetail->tgl->HeaderCellClass() ?>"><span id="elh_t95_homedetail_tgl" class="t95_homedetail_tgl"><?php echo $t95_homedetail->tgl->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t95_homedetail->kat->Visible) { // kat ?>
		<th class="<?php echo $t95_homedetail->kat->HeaderCellClass() ?>"><span id="elh_t95_homedetail_kat" class="t95_homedetail_kat"><?php echo $t95_homedetail->kat->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t95_homedetail->no_jdl->Visible) { // no_jdl ?>
		<th class="<?php echo $t95_homedetail->no_jdl->HeaderCellClass() ?>"><span id="elh_t95_homedetail_no_jdl" class="t95_homedetail_no_jdl"><?php echo $t95_homedetail->no_jdl->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t95_homedetail->jdl->Visible) { // jdl ?>
		<th class="<?php echo $t95_homedetail->jdl->HeaderCellClass() ?>"><span id="elh_t95_homedetail_jdl" class="t95_homedetail_jdl"><?php echo $t95_homedetail->jdl->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t95_homedetail->no_ket->Visible) { // no_ket ?>
		<th class="<?php echo $t95_homedetail->no_ket->HeaderCellClass() ?>"><span id="elh_t95_homedetail_no_ket" class="t95_homedetail_no_ket"><?php echo $t95_homedetail->no_ket->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t95_homedetail->ket->Visible) { // ket ?>
		<th class="<?php echo $t95_homedetail->ket->HeaderCellClass() ?>"><span id="elh_t95_homedetail_ket" class="t95_homedetail_ket"><?php echo $t95_homedetail->ket->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t95_homedetail->done->Visible) { // done ?>
		<th class="<?php echo $t95_homedetail->done->HeaderCellClass() ?>"><span id="elh_t95_homedetail_done" class="t95_homedetail_done"><?php echo $t95_homedetail->done->FldCaption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t95_homedetail_delete->RecCnt = 0;
$i = 0;
while (!$t95_homedetail_delete->Recordset->EOF) {
	$t95_homedetail_delete->RecCnt++;
	$t95_homedetail_delete->RowCnt++;

	// Set row properties
	$t95_homedetail->ResetAttrs();
	$t95_homedetail->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$t95_homedetail_delete->LoadRowValues($t95_homedetail_delete->Recordset);

	// Render row
	$t95_homedetail_delete->RenderRow();
?>
	<tr<?php echo $t95_homedetail->RowAttributes() ?>>
<?php if ($t95_homedetail->tgl->Visible) { // tgl ?>
		<td<?php echo $t95_homedetail->tgl->CellAttributes() ?>>
<span id="el<?php echo $t95_homedetail_delete->RowCnt ?>_t95_homedetail_tgl" class="t95_homedetail_tgl">
<span<?php echo $t95_homedetail->tgl->ViewAttributes() ?>>
<?php echo $t95_homedetail->tgl->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t95_homedetail->kat->Visible) { // kat ?>
		<td<?php echo $t95_homedetail->kat->CellAttributes() ?>>
<span id="el<?php echo $t95_homedetail_delete->RowCnt ?>_t95_homedetail_kat" class="t95_homedetail_kat">
<span<?php echo $t95_homedetail->kat->ViewAttributes() ?>>
<?php echo $t95_homedetail->kat->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t95_homedetail->no_jdl->Visible) { // no_jdl ?>
		<td<?php echo $t95_homedetail->no_jdl->CellAttributes() ?>>
<span id="el<?php echo $t95_homedetail_delete->RowCnt ?>_t95_homedetail_no_jdl" class="t95_homedetail_no_jdl">
<span<?php echo $t95_homedetail->no_jdl->ViewAttributes() ?>>
<?php echo $t95_homedetail->no_jdl->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t95_homedetail->jdl->Visible) { // jdl ?>
		<td<?php echo $t95_homedetail->jdl->CellAttributes() ?>>
<span id="el<?php echo $t95_homedetail_delete->RowCnt ?>_t95_homedetail_jdl" class="t95_homedetail_jdl">
<span<?php echo $t95_homedetail->jdl->ViewAttributes() ?>>
<?php echo $t95_homedetail->jdl->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t95_homedetail->no_ket->Visible) { // no_ket ?>
		<td<?php echo $t95_homedetail->no_ket->CellAttributes() ?>>
<span id="el<?php echo $t95_homedetail_delete->RowCnt ?>_t95_homedetail_no_ket" class="t95_homedetail_no_ket">
<span<?php echo $t95_homedetail->no_ket->ViewAttributes() ?>>
<?php echo $t95_homedetail->no_ket->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t95_homedetail->ket->Visible) { // ket ?>
		<td<?php echo $t95_homedetail->ket->CellAttributes() ?>>
<span id="el<?php echo $t95_homedetail_delete->RowCnt ?>_t95_homedetail_ket" class="t95_homedetail_ket">
<span<?php echo $t95_homedetail->ket->ViewAttributes() ?>>
<?php echo $t95_homedetail->ket->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t95_homedetail->done->Visible) { // done ?>
		<td<?php echo $t95_homedetail->done->CellAttributes() ?>>
<span id="el<?php echo $t95_homedetail_delete->RowCnt ?>_t95_homedetail_done" class="t95_homedetail_done">
<span<?php echo $t95_homedetail->done->ViewAttributes() ?>>
<?php echo $t95_homedetail->done->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t95_homedetail_delete->Recordset->MoveNext();
}
$t95_homedetail_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $t95_homedetail_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<script type="text/javascript">
ft95_homedetaildelete.Init();
</script>
<?php
$t95_homedetail_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t95_homedetail_delete->Page_Terminate();
?>
