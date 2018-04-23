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

$t95_homedetail_add = NULL; // Initialize page object first

class ct95_homedetail_add extends ct95_homedetail {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = '{8746EF3F-81FE-4C1C-A7F8-AC191F8DDBB2}';

	// Table name
	var $TableName = 't95_homedetail';

	// Page object name
	var $PageObjName = 't95_homedetail_add';

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
			define("EW_PAGE_ID", 'add', TRUE);

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

		// Is modal
		$this->IsModal = (@$_GET["modal"] == "1" || @$_POST["modal"] == "1");

		// User profile
		$UserProfile = new cUserProfile();

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName);
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loaded();
		if (!$Security->CanAdd()) {
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
		// Create form object

		$objForm = new cFormObj();
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

		// Process auto fill
		if (@$_POST["ajax"] == "autofill") {
			$results = $this->GetAutoFill(@$_POST["name"], @$_POST["q"]);
			if ($results) {

				// Clean output buffer
				if (!EW_DEBUG_ENABLED && ob_get_length())
					ob_end_clean();
				echo $results;
				$this->Page_Terminate();
				exit();
			}
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

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = array("url" => $url, "modal" => "1");
				$pageName = ew_GetPageName($url);
				if ($pageName != $this->GetListUrl()) { // Not List page
					$row["caption"] = $this->GetModalCaption($pageName);
					if ($pageName == "t95_homedetailview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				header("Content-Type: application/json; charset=utf-8");
				echo ew_ConvertToUtf8(ew_ArrayToJson(array($row)));
			} else {
				ew_SaveDebugMsg();
				header("Location: " . $url);
			}
		}
		exit();
	}
	var $FormClassName = "form-horizontal ewForm ewAddForm";
	var $IsModal = FALSE;
	var $IsMobileOrModal = FALSE;
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $StartRec;
	var $Priv = 0;
	var $OldRecordset;
	var $CopyRecord;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError;
		global $gbSkipHeaderFooter;

		// Check modal
		if ($this->IsModal)
			$gbSkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = ew_IsMobile() || $this->IsModal;
		$this->FormClassName = "ewForm ewAddForm form-horizontal";

		// Set up current action
		if (@$_POST["a_add"] <> "") {
			$this->CurrentAction = $_POST["a_add"]; // Get form action
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["home_id"] != "") {
				$this->home_id->setQueryStringValue($_GET["home_id"]);
				$this->setKey("home_id", $this->home_id->CurrentValue); // Set up key
			} else {
				$this->setKey("home_id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "C"; // Copy record
			} else {
				$this->CurrentAction = "I"; // Display blank record
			}
		}

		// Load old record / default values
		$loaded = $this->LoadOldRecord();

		// Load form values
		if (@$_POST["a_add"] <> "") {
			$this->LoadFormValues(); // Load form values
		}

		// Validate form if post back
		if (@$_POST["a_add"] <> "") {
			if (!$this->ValidateForm()) {
				$this->CurrentAction = "I"; // Form error, reset action
				$this->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "I": // Blank record
				break;
			case "C": // Copy an existing record
				if (!$loaded) { // Record not loaded
					if ($this->getFailureMessage() == "") $this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("t95_homedetaillist.php"); // No matching record, return to list
				}
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "t95_homedetaillist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "t95_homedetailview.php")
						$sReturnUrl = $this->GetViewUrl(); // View page, return to View page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Render row based on row type
		$this->RowType = EW_ROWTYPE_ADD; // Render add type

		// Render row
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $Language;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		$this->home_id->CurrentValue = NULL;
		$this->home_id->OldValue = $this->home_id->CurrentValue;
		$this->tgl->CurrentValue = NULL;
		$this->tgl->OldValue = $this->tgl->CurrentValue;
		$this->kat->CurrentValue = NULL;
		$this->kat->OldValue = $this->kat->CurrentValue;
		$this->no_jdl->CurrentValue = NULL;
		$this->no_jdl->OldValue = $this->no_jdl->CurrentValue;
		$this->jdl->CurrentValue = NULL;
		$this->jdl->OldValue = $this->jdl->CurrentValue;
		$this->no_ket->CurrentValue = NULL;
		$this->no_ket->OldValue = $this->no_ket->CurrentValue;
		$this->ket->CurrentValue = NULL;
		$this->ket->OldValue = $this->ket->CurrentValue;
		$this->done->CurrentValue = 0;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->tgl->FldIsDetailKey) {
			$this->tgl->setFormValue($objForm->GetValue("x_tgl"));
			$this->tgl->CurrentValue = ew_UnFormatDateTime($this->tgl->CurrentValue, 7);
		}
		if (!$this->kat->FldIsDetailKey) {
			$this->kat->setFormValue($objForm->GetValue("x_kat"));
		}
		if (!$this->no_jdl->FldIsDetailKey) {
			$this->no_jdl->setFormValue($objForm->GetValue("x_no_jdl"));
		}
		if (!$this->jdl->FldIsDetailKey) {
			$this->jdl->setFormValue($objForm->GetValue("x_jdl"));
		}
		if (!$this->no_ket->FldIsDetailKey) {
			$this->no_ket->setFormValue($objForm->GetValue("x_no_ket"));
		}
		if (!$this->ket->FldIsDetailKey) {
			$this->ket->setFormValue($objForm->GetValue("x_ket"));
		}
		if (!$this->done->FldIsDetailKey) {
			$this->done->setFormValue($objForm->GetValue("x_done"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->tgl->CurrentValue = $this->tgl->FormValue;
		$this->tgl->CurrentValue = ew_UnFormatDateTime($this->tgl->CurrentValue, 7);
		$this->kat->CurrentValue = $this->kat->FormValue;
		$this->no_jdl->CurrentValue = $this->no_jdl->FormValue;
		$this->jdl->CurrentValue = $this->jdl->FormValue;
		$this->no_ket->CurrentValue = $this->no_ket->FormValue;
		$this->ket->CurrentValue = $this->ket->FormValue;
		$this->done->CurrentValue = $this->done->FormValue;
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
		$this->LoadDefaultValues();
		$row = array();
		$row['home_id'] = $this->home_id->CurrentValue;
		$row['tgl'] = $this->tgl->CurrentValue;
		$row['kat'] = $this->kat->CurrentValue;
		$row['no_jdl'] = $this->no_jdl->CurrentValue;
		$row['jdl'] = $this->jdl->CurrentValue;
		$row['no_ket'] = $this->no_ket->CurrentValue;
		$row['ket'] = $this->ket->CurrentValue;
		$row['done'] = $this->done->CurrentValue;
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

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("home_id")) <> "")
			$this->home_id->CurrentValue = $this->getKey("home_id"); // home_id
		else
			$bValidKey = FALSE;

		// Load old record
		$this->OldRecordset = NULL;
		if ($bValidKey) {
			$this->CurrentFilter = $this->KeyFilter();
			$sSql = $this->SQL();
			$conn = &$this->Connection();
			$this->OldRecordset = ew_LoadRecordset($sSql, $conn);
		}
		$this->LoadRowValues($this->OldRecordset); // Load row values
		return $bValidKey;
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
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// tgl
			$this->tgl->EditAttrs["class"] = "form-control";
			$this->tgl->EditCustomAttributes = "";
			$this->tgl->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->tgl->CurrentValue, 7));
			$this->tgl->PlaceHolder = ew_RemoveHtml($this->tgl->FldCaption());

			// kat
			$this->kat->EditCustomAttributes = "";
			if (trim(strval($this->kat->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`kode`" . ew_SearchString("=", $this->kat->CurrentValue, EW_DATATYPE_STRING, "");
			}
			$sSqlWrk = "SELECT `kode`, `kode` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `t94_home`";
			$sWhereWrk = "";
			$this->kat->LookupFilters = array("dx1" => '`kode`');
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->kat, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
				$this->kat->ViewValue = $this->kat->DisplayValue($arwrk);
			} else {
				$this->kat->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->kat->EditValue = $arwrk;

			// no_jdl
			$this->no_jdl->EditAttrs["class"] = "form-control";
			$this->no_jdl->EditCustomAttributes = "";
			$this->no_jdl->EditValue = ew_HtmlEncode($this->no_jdl->CurrentValue);
			$this->no_jdl->PlaceHolder = ew_RemoveHtml($this->no_jdl->FldCaption());

			// jdl
			$this->jdl->EditAttrs["class"] = "form-control";
			$this->jdl->EditCustomAttributes = "";
			$this->jdl->EditValue = ew_HtmlEncode($this->jdl->CurrentValue);
			$this->jdl->PlaceHolder = ew_RemoveHtml($this->jdl->FldCaption());

			// no_ket
			$this->no_ket->EditAttrs["class"] = "form-control";
			$this->no_ket->EditCustomAttributes = "";
			$this->no_ket->EditValue = ew_HtmlEncode($this->no_ket->CurrentValue);
			$this->no_ket->PlaceHolder = ew_RemoveHtml($this->no_ket->FldCaption());

			// ket
			$this->ket->EditAttrs["class"] = "form-control";
			$this->ket->EditCustomAttributes = "";
			$this->ket->EditValue = ew_HtmlEncode($this->ket->CurrentValue);
			$this->ket->PlaceHolder = ew_RemoveHtml($this->ket->FldCaption());

			// done
			$this->done->EditCustomAttributes = "";
			$this->done->EditValue = $this->done->Options(FALSE);

			// Add refer script
			// tgl

			$this->tgl->LinkCustomAttributes = "";
			$this->tgl->HrefValue = "";

			// kat
			$this->kat->LinkCustomAttributes = "";
			$this->kat->HrefValue = "";

			// no_jdl
			$this->no_jdl->LinkCustomAttributes = "";
			$this->no_jdl->HrefValue = "";

			// jdl
			$this->jdl->LinkCustomAttributes = "";
			$this->jdl->HrefValue = "";

			// no_ket
			$this->no_ket->LinkCustomAttributes = "";
			$this->no_ket->HrefValue = "";

			// ket
			$this->ket->LinkCustomAttributes = "";
			$this->ket->HrefValue = "";

			// done
			$this->done->LinkCustomAttributes = "";
			$this->done->HrefValue = "";
		}
		if ($this->RowType == EW_ROWTYPE_ADD || $this->RowType == EW_ROWTYPE_EDIT || $this->RowType == EW_ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->SetupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ew_CheckEuroDate($this->tgl->FormValue)) {
			ew_AddMessage($gsFormError, $this->tgl->FldErrMsg());
		}
		if (!ew_CheckInteger($this->no_jdl->FormValue)) {
			ew_AddMessage($gsFormError, $this->no_jdl->FldErrMsg());
		}
		if (!ew_CheckInteger($this->no_ket->FormValue)) {
			ew_AddMessage($gsFormError, $this->no_ket->FldErrMsg());
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsFormError, $sFormCustomError);
		}
		return $ValidateForm;
	}

	// Add record
	function AddRow($rsold = NULL) {
		global $Language, $Security;
		$conn = &$this->Connection();

		// Load db values from rsold
		$this->LoadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = array();

		// tgl
		$this->tgl->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->tgl->CurrentValue, 7), NULL, FALSE);

		// kat
		$this->kat->SetDbValueDef($rsnew, $this->kat->CurrentValue, NULL, FALSE);

		// no_jdl
		$this->no_jdl->SetDbValueDef($rsnew, $this->no_jdl->CurrentValue, NULL, FALSE);

		// jdl
		$this->jdl->SetDbValueDef($rsnew, $this->jdl->CurrentValue, NULL, FALSE);

		// no_ket
		$this->no_ket->SetDbValueDef($rsnew, $this->no_ket->CurrentValue, NULL, FALSE);

		// ket
		$this->ket->SetDbValueDef($rsnew, $this->ket->CurrentValue, NULL, FALSE);

		// done
		$this->done->SetDbValueDef($rsnew, $this->done->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $this->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			$AddRow = $this->Insert($rsnew);
			$conn->raiseErrorFn = '';
			if ($AddRow) {
			}
		} else {
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$this->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("t95_homedetaillist.php"), "", $this->TableVar, TRUE);
		$PageId = ($this->CurrentAction == "C") ? "Copy" : "Add";
		$Breadcrumb->Add("add", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_kat":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `kode` AS `LinkFld`, `kode` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t94_home`";
			$sWhereWrk = "{filter}";
			$fld->LookupFilters = array("dx1" => '`kode`');
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`kode` IN ({filter_value})', "t0" => "200", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->kat, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
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

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($t95_homedetail_add)) $t95_homedetail_add = new ct95_homedetail_add();

// Page init
$t95_homedetail_add->Page_Init();

// Page main
$t95_homedetail_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t95_homedetail_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = ft95_homedetailadd = new ew_Form("ft95_homedetailadd", "add");

// Validate form
ft95_homedetailadd.Validate = function() {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.GetForm(), $fobj = $(fobj);
	if ($fobj.find("#a_confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.FormKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = $fobj.find("#a_list").val() == "gridinsert";
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
			elm = this.GetElements("x" + infix + "_tgl");
			if (elm && !ew_CheckEuroDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t95_homedetail->tgl->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_no_jdl");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t95_homedetail->no_jdl->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_no_ket");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t95_homedetail->no_ket->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}

	// Process detail forms
	var dfs = $fobj.find("input[name='detailpage']").get();
	for (var i = 0; i < dfs.length; i++) {
		var df = dfs[i], val = df.value;
		if (val && ewForms[val])
			if (!ewForms[val].Validate())
				return false;
	}
	return true;
}

// Form_CustomValidate event
ft95_homedetailadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ft95_homedetailadd.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ft95_homedetailadd.Lists["x_kat"] = {"LinkField":"x_kode","Ajax":true,"AutoFill":false,"DisplayFields":["x_kode","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t94_home"};
ft95_homedetailadd.Lists["x_kat"].Data = "<?php echo $t95_homedetail_add->kat->LookupFilterQuery(FALSE, "add") ?>";
ft95_homedetailadd.Lists["x_done[]"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ft95_homedetailadd.Lists["x_done[]"].Options = <?php echo json_encode($t95_homedetail_add->done->Options()) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $t95_homedetail_add->ShowPageHeader(); ?>
<?php
$t95_homedetail_add->ShowMessage();
?>
<form name="ft95_homedetailadd" id="ft95_homedetailadd" class="<?php echo $t95_homedetail_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t95_homedetail_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t95_homedetail_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t95_homedetail">
<input type="hidden" name="a_add" id="a_add" value="A">
<input type="hidden" name="modal" value="<?php echo intval($t95_homedetail_add->IsModal) ?>">
<div class="ewAddDiv"><!-- page* -->
<?php if ($t95_homedetail->tgl->Visible) { // tgl ?>
	<div id="r_tgl" class="form-group">
		<label id="elh_t95_homedetail_tgl" for="x_tgl" class="<?php echo $t95_homedetail_add->LeftColumnClass ?>"><?php echo $t95_homedetail->tgl->FldCaption() ?></label>
		<div class="<?php echo $t95_homedetail_add->RightColumnClass ?>"><div<?php echo $t95_homedetail->tgl->CellAttributes() ?>>
<span id="el_t95_homedetail_tgl">
<input type="text" data-table="t95_homedetail" data-field="x_tgl" data-format="7" name="x_tgl" id="x_tgl" size="7" placeholder="<?php echo ew_HtmlEncode($t95_homedetail->tgl->getPlaceHolder()) ?>" value="<?php echo $t95_homedetail->tgl->EditValue ?>"<?php echo $t95_homedetail->tgl->EditAttributes() ?>>
<?php if (!$t95_homedetail->tgl->ReadOnly && !$t95_homedetail->tgl->Disabled && !isset($t95_homedetail->tgl->EditAttrs["readonly"]) && !isset($t95_homedetail->tgl->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("ft95_homedetailadd", "x_tgl", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<?php echo $t95_homedetail->tgl->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t95_homedetail->kat->Visible) { // kat ?>
	<div id="r_kat" class="form-group">
		<label id="elh_t95_homedetail_kat" for="x_kat" class="<?php echo $t95_homedetail_add->LeftColumnClass ?>"><?php echo $t95_homedetail->kat->FldCaption() ?></label>
		<div class="<?php echo $t95_homedetail_add->RightColumnClass ?>"><div<?php echo $t95_homedetail->kat->CellAttributes() ?>>
<span id="el_t95_homedetail_kat">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_kat"><?php echo (strval($t95_homedetail->kat->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t95_homedetail->kat->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t95_homedetail->kat->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_kat',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($t95_homedetail->kat->ReadOnly || $t95_homedetail->kat->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t95_homedetail" data-field="x_kat" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t95_homedetail->kat->DisplayValueSeparatorAttribute() ?>" name="x_kat" id="x_kat" value="<?php echo $t95_homedetail->kat->CurrentValue ?>"<?php echo $t95_homedetail->kat->EditAttributes() ?>>
</span>
<?php echo $t95_homedetail->kat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t95_homedetail->no_jdl->Visible) { // no_jdl ?>
	<div id="r_no_jdl" class="form-group">
		<label id="elh_t95_homedetail_no_jdl" for="x_no_jdl" class="<?php echo $t95_homedetail_add->LeftColumnClass ?>"><?php echo $t95_homedetail->no_jdl->FldCaption() ?></label>
		<div class="<?php echo $t95_homedetail_add->RightColumnClass ?>"><div<?php echo $t95_homedetail->no_jdl->CellAttributes() ?>>
<span id="el_t95_homedetail_no_jdl">
<input type="text" data-table="t95_homedetail" data-field="x_no_jdl" name="x_no_jdl" id="x_no_jdl" size="1" placeholder="<?php echo ew_HtmlEncode($t95_homedetail->no_jdl->getPlaceHolder()) ?>" value="<?php echo $t95_homedetail->no_jdl->EditValue ?>"<?php echo $t95_homedetail->no_jdl->EditAttributes() ?>>
</span>
<?php echo $t95_homedetail->no_jdl->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t95_homedetail->jdl->Visible) { // jdl ?>
	<div id="r_jdl" class="form-group">
		<label id="elh_t95_homedetail_jdl" for="x_jdl" class="<?php echo $t95_homedetail_add->LeftColumnClass ?>"><?php echo $t95_homedetail->jdl->FldCaption() ?></label>
		<div class="<?php echo $t95_homedetail_add->RightColumnClass ?>"><div<?php echo $t95_homedetail->jdl->CellAttributes() ?>>
<span id="el_t95_homedetail_jdl">
<input type="text" data-table="t95_homedetail" data-field="x_jdl" name="x_jdl" id="x_jdl" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t95_homedetail->jdl->getPlaceHolder()) ?>" value="<?php echo $t95_homedetail->jdl->EditValue ?>"<?php echo $t95_homedetail->jdl->EditAttributes() ?>>
</span>
<?php echo $t95_homedetail->jdl->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t95_homedetail->no_ket->Visible) { // no_ket ?>
	<div id="r_no_ket" class="form-group">
		<label id="elh_t95_homedetail_no_ket" for="x_no_ket" class="<?php echo $t95_homedetail_add->LeftColumnClass ?>"><?php echo $t95_homedetail->no_ket->FldCaption() ?></label>
		<div class="<?php echo $t95_homedetail_add->RightColumnClass ?>"><div<?php echo $t95_homedetail->no_ket->CellAttributes() ?>>
<span id="el_t95_homedetail_no_ket">
<input type="text" data-table="t95_homedetail" data-field="x_no_ket" name="x_no_ket" id="x_no_ket" size="1" placeholder="<?php echo ew_HtmlEncode($t95_homedetail->no_ket->getPlaceHolder()) ?>" value="<?php echo $t95_homedetail->no_ket->EditValue ?>"<?php echo $t95_homedetail->no_ket->EditAttributes() ?>>
</span>
<?php echo $t95_homedetail->no_ket->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t95_homedetail->ket->Visible) { // ket ?>
	<div id="r_ket" class="form-group">
		<label id="elh_t95_homedetail_ket" for="x_ket" class="<?php echo $t95_homedetail_add->LeftColumnClass ?>"><?php echo $t95_homedetail->ket->FldCaption() ?></label>
		<div class="<?php echo $t95_homedetail_add->RightColumnClass ?>"><div<?php echo $t95_homedetail->ket->CellAttributes() ?>>
<span id="el_t95_homedetail_ket">
<textarea data-table="t95_homedetail" data-field="x_ket" name="x_ket" id="x_ket" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($t95_homedetail->ket->getPlaceHolder()) ?>"<?php echo $t95_homedetail->ket->EditAttributes() ?>><?php echo $t95_homedetail->ket->EditValue ?></textarea>
</span>
<?php echo $t95_homedetail->ket->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t95_homedetail->done->Visible) { // done ?>
	<div id="r_done" class="form-group">
		<label id="elh_t95_homedetail_done" class="<?php echo $t95_homedetail_add->LeftColumnClass ?>"><?php echo $t95_homedetail->done->FldCaption() ?></label>
		<div class="<?php echo $t95_homedetail_add->RightColumnClass ?>"><div<?php echo $t95_homedetail->done->CellAttributes() ?>>
<span id="el_t95_homedetail_done">
<div id="tp_x_done" class="ewTemplate"><input type="checkbox" data-table="t95_homedetail" data-field="x_done" data-value-separator="<?php echo $t95_homedetail->done->DisplayValueSeparatorAttribute() ?>" name="x_done[]" id="x_done[]" value="{value}"<?php echo $t95_homedetail->done->EditAttributes() ?>></div>
<div id="dsl_x_done" data-repeatcolumn="5" class="ewItemList" style="display: none;"><div>
<?php echo $t95_homedetail->done->CheckBoxListHtml(FALSE, "x_done[]") ?>
</div></div>
</span>
<?php echo $t95_homedetail->done->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$t95_homedetail_add->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $t95_homedetail_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $t95_homedetail_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
ft95_homedetailadd.Init();
</script>
<?php
$t95_homedetail_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t95_homedetail_add->Page_Terminate();
?>
