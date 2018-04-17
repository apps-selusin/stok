<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "t12_jualdetailinfo.php" ?>
<?php include_once "t11_jualinfo.php" ?>
<?php include_once "t96_employeesinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$t12_jualdetail_add = NULL; // Initialize page object first

class ct12_jualdetail_add extends ct12_jualdetail {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = '{8746EF3F-81FE-4C1C-A7F8-AC191F8DDBB2}';

	// Table name
	var $TableName = 't12_jualdetail';

	// Page object name
	var $PageObjName = 't12_jualdetail_add';

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

		// Table object (t12_jualdetail)
		if (!isset($GLOBALS["t12_jualdetail"]) || get_class($GLOBALS["t12_jualdetail"]) == "ct12_jualdetail") {
			$GLOBALS["t12_jualdetail"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t12_jualdetail"];
		}

		// Table object (t11_jual)
		if (!isset($GLOBALS['t11_jual'])) $GLOBALS['t11_jual'] = new ct11_jual();

		// Table object (t96_employees)
		if (!isset($GLOBALS['t96_employees'])) $GLOBALS['t96_employees'] = new ct96_employees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 't12_jualdetail', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("t12_jualdetaillist.php"));
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
		$this->JualID->SetVisibility();
		$this->ArticleID->SetVisibility();
		$this->HargaJual->SetVisibility();
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
		global $EW_EXPORT, $t12_jualdetail;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($t12_jualdetail);
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
					if ($pageName == "t12_jualdetailview.php")
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

		// Set up master/detail parameters
		$this->SetupMasterParms();

		// Set up current action
		if (@$_POST["a_add"] <> "") {
			$this->CurrentAction = $_POST["a_add"]; // Get form action
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["id"] != "") {
				$this->id->setQueryStringValue($_GET["id"]);
				$this->setKey("id", $this->id->CurrentValue); // Set up key
			} else {
				$this->setKey("id", ""); // Clear key
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
					$this->Page_Terminate("t12_jualdetaillist.php"); // No matching record, return to list
				}
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "t12_jualdetaillist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "t12_jualdetailview.php")
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
		$this->id->CurrentValue = NULL;
		$this->id->OldValue = $this->id->CurrentValue;
		$this->JualID->CurrentValue = NULL;
		$this->JualID->OldValue = $this->JualID->CurrentValue;
		$this->ArticleID->CurrentValue = NULL;
		$this->ArticleID->OldValue = $this->ArticleID->CurrentValue;
		$this->HargaJual->CurrentValue = 0.00;
		$this->Qty->CurrentValue = 0.00;
		$this->SatuanID->CurrentValue = NULL;
		$this->SatuanID->OldValue = $this->SatuanID->CurrentValue;
		$this->SubTotal->CurrentValue = 0.00;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->JualID->FldIsDetailKey) {
			$this->JualID->setFormValue($objForm->GetValue("x_JualID"));
		}
		if (!$this->ArticleID->FldIsDetailKey) {
			$this->ArticleID->setFormValue($objForm->GetValue("x_ArticleID"));
		}
		if (!$this->HargaJual->FldIsDetailKey) {
			$this->HargaJual->setFormValue($objForm->GetValue("x_HargaJual"));
		}
		if (!$this->Qty->FldIsDetailKey) {
			$this->Qty->setFormValue($objForm->GetValue("x_Qty"));
		}
		if (!$this->SatuanID->FldIsDetailKey) {
			$this->SatuanID->setFormValue($objForm->GetValue("x_SatuanID"));
		}
		if (!$this->SubTotal->FldIsDetailKey) {
			$this->SubTotal->setFormValue($objForm->GetValue("x_SubTotal"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->JualID->CurrentValue = $this->JualID->FormValue;
		$this->ArticleID->CurrentValue = $this->ArticleID->FormValue;
		$this->HargaJual->CurrentValue = $this->HargaJual->FormValue;
		$this->Qty->CurrentValue = $this->Qty->FormValue;
		$this->SatuanID->CurrentValue = $this->SatuanID->FormValue;
		$this->SubTotal->CurrentValue = $this->SubTotal->FormValue;
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
		$this->JualID->setDbValue($row['JualID']);
		$this->ArticleID->setDbValue($row['ArticleID']);
		if (array_key_exists('EV__ArticleID', $rs->fields)) {
			$this->ArticleID->VirtualValue = $rs->fields('EV__ArticleID'); // Set up virtual field value
		} else {
			$this->ArticleID->VirtualValue = ""; // Clear value
		}
		$this->HargaJual->setDbValue($row['HargaJual']);
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
		$this->LoadDefaultValues();
		$row = array();
		$row['id'] = $this->id->CurrentValue;
		$row['JualID'] = $this->JualID->CurrentValue;
		$row['ArticleID'] = $this->ArticleID->CurrentValue;
		$row['HargaJual'] = $this->HargaJual->CurrentValue;
		$row['Qty'] = $this->Qty->CurrentValue;
		$row['SatuanID'] = $this->SatuanID->CurrentValue;
		$row['SubTotal'] = $this->SubTotal->CurrentValue;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->JualID->DbValue = $row['JualID'];
		$this->ArticleID->DbValue = $row['ArticleID'];
		$this->HargaJual->DbValue = $row['HargaJual'];
		$this->Qty->DbValue = $row['Qty'];
		$this->SatuanID->DbValue = $row['SatuanID'];
		$this->SubTotal->DbValue = $row['SubTotal'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("id")) <> "")
			$this->id->CurrentValue = $this->getKey("id"); // id
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
		// Convert decimal values if posted back

		if ($this->HargaJual->FormValue == $this->HargaJual->CurrentValue && is_numeric(ew_StrToFloat($this->HargaJual->CurrentValue)))
			$this->HargaJual->CurrentValue = ew_StrToFloat($this->HargaJual->CurrentValue);

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
		// JualID
		// ArticleID
		// HargaJual
		// Qty
		// SatuanID
		// SubTotal

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// JualID
		$this->JualID->ViewValue = $this->JualID->CurrentValue;
		$this->JualID->ViewCustomAttributes = "";

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

		// HargaJual
		$this->HargaJual->ViewValue = $this->HargaJual->CurrentValue;
		$this->HargaJual->ViewValue = ew_FormatNumber($this->HargaJual->ViewValue, 2, -2, -2, -2);
		$this->HargaJual->CellCssStyle .= "text-align: right;";
		$this->HargaJual->ViewCustomAttributes = "";

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

			// JualID
			$this->JualID->LinkCustomAttributes = "";
			$this->JualID->HrefValue = "";
			$this->JualID->TooltipValue = "";

			// ArticleID
			$this->ArticleID->LinkCustomAttributes = "";
			$this->ArticleID->HrefValue = "";
			$this->ArticleID->TooltipValue = "";

			// HargaJual
			$this->HargaJual->LinkCustomAttributes = "";
			$this->HargaJual->HrefValue = "";
			$this->HargaJual->TooltipValue = "";

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
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// JualID
			$this->JualID->EditAttrs["class"] = "form-control";
			$this->JualID->EditCustomAttributes = "";
			if ($this->JualID->getSessionValue() <> "") {
				$this->JualID->CurrentValue = $this->JualID->getSessionValue();
			$this->JualID->ViewValue = $this->JualID->CurrentValue;
			$this->JualID->ViewCustomAttributes = "";
			} else {
			$this->JualID->EditValue = ew_HtmlEncode($this->JualID->CurrentValue);
			$this->JualID->PlaceHolder = ew_RemoveHtml($this->JualID->FldCaption());
			}

			// ArticleID
			$this->ArticleID->EditCustomAttributes = "";
			if (trim(strval($this->ArticleID->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->ArticleID->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `id`, `Kode` AS `DispFld`, `Nama` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `t06_article`";
			$sWhereWrk = "";
			$this->ArticleID->LookupFilters = array("dx1" => '`Kode`', "dx2" => '`Nama`');
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->ArticleID, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
				$arwrk[2] = ew_HtmlEncode($rswrk->fields('Disp2Fld'));
				$this->ArticleID->ViewValue = $this->ArticleID->DisplayValue($arwrk);
			} else {
				$this->ArticleID->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->ArticleID->EditValue = $arwrk;

			// HargaJual
			$this->HargaJual->EditAttrs["class"] = "form-control";
			$this->HargaJual->EditCustomAttributes = "";
			$this->HargaJual->EditValue = ew_HtmlEncode($this->HargaJual->CurrentValue);
			$this->HargaJual->PlaceHolder = ew_RemoveHtml($this->HargaJual->FldCaption());
			if (strval($this->HargaJual->EditValue) <> "" && is_numeric($this->HargaJual->EditValue)) $this->HargaJual->EditValue = ew_FormatNumber($this->HargaJual->EditValue, -2, -2, -2, -2);

			// Qty
			$this->Qty->EditAttrs["class"] = "form-control";
			$this->Qty->EditCustomAttributes = "";
			$this->Qty->EditValue = ew_HtmlEncode($this->Qty->CurrentValue);
			$this->Qty->PlaceHolder = ew_RemoveHtml($this->Qty->FldCaption());
			if (strval($this->Qty->EditValue) <> "" && is_numeric($this->Qty->EditValue)) $this->Qty->EditValue = ew_FormatNumber($this->Qty->EditValue, -2, -2, -2, -2);

			// SatuanID
			$this->SatuanID->EditAttrs["class"] = "form-control";
			$this->SatuanID->EditCustomAttributes = "";
			$this->SatuanID->EditValue = ew_HtmlEncode($this->SatuanID->CurrentValue);
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
					$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
					$this->SatuanID->EditValue = $this->SatuanID->DisplayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->SatuanID->EditValue = ew_HtmlEncode($this->SatuanID->CurrentValue);
				}
			} else {
				$this->SatuanID->EditValue = NULL;
			}
			$this->SatuanID->PlaceHolder = ew_RemoveHtml($this->SatuanID->FldCaption());

			// SubTotal
			$this->SubTotal->EditAttrs["class"] = "form-control";
			$this->SubTotal->EditCustomAttributes = "";
			$this->SubTotal->EditValue = ew_HtmlEncode($this->SubTotal->CurrentValue);
			$this->SubTotal->PlaceHolder = ew_RemoveHtml($this->SubTotal->FldCaption());
			if (strval($this->SubTotal->EditValue) <> "" && is_numeric($this->SubTotal->EditValue)) $this->SubTotal->EditValue = ew_FormatNumber($this->SubTotal->EditValue, -2, -2, -2, -2);

			// Add refer script
			// JualID

			$this->JualID->LinkCustomAttributes = "";
			$this->JualID->HrefValue = "";

			// ArticleID
			$this->ArticleID->LinkCustomAttributes = "";
			$this->ArticleID->HrefValue = "";

			// HargaJual
			$this->HargaJual->LinkCustomAttributes = "";
			$this->HargaJual->HrefValue = "";

			// Qty
			$this->Qty->LinkCustomAttributes = "";
			$this->Qty->HrefValue = "";

			// SatuanID
			$this->SatuanID->LinkCustomAttributes = "";
			$this->SatuanID->HrefValue = "";

			// SubTotal
			$this->SubTotal->LinkCustomAttributes = "";
			$this->SubTotal->HrefValue = "";
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
		if (!$this->JualID->FldIsDetailKey && !is_null($this->JualID->FormValue) && $this->JualID->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->JualID->FldCaption(), $this->JualID->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->JualID->FormValue)) {
			ew_AddMessage($gsFormError, $this->JualID->FldErrMsg());
		}
		if (!$this->ArticleID->FldIsDetailKey && !is_null($this->ArticleID->FormValue) && $this->ArticleID->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->ArticleID->FldCaption(), $this->ArticleID->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->HargaJual->FormValue)) {
			ew_AddMessage($gsFormError, $this->HargaJual->FldErrMsg());
		}
		if (!ew_CheckNumber($this->Qty->FormValue)) {
			ew_AddMessage($gsFormError, $this->Qty->FldErrMsg());
		}
		if (!ew_CheckNumber($this->SubTotal->FormValue)) {
			ew_AddMessage($gsFormError, $this->SubTotal->FldErrMsg());
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

		// JualID
		$this->JualID->SetDbValueDef($rsnew, $this->JualID->CurrentValue, 0, FALSE);

		// ArticleID
		$this->ArticleID->SetDbValueDef($rsnew, $this->ArticleID->CurrentValue, 0, FALSE);

		// HargaJual
		$this->HargaJual->SetDbValueDef($rsnew, $this->HargaJual->CurrentValue, 0, strval($this->HargaJual->CurrentValue) == "");

		// Qty
		$this->Qty->SetDbValueDef($rsnew, $this->Qty->CurrentValue, 0, strval($this->Qty->CurrentValue) == "");

		// SatuanID
		$this->SatuanID->SetDbValueDef($rsnew, $this->SatuanID->CurrentValue, NULL, FALSE);

		// SubTotal
		$this->SubTotal->SetDbValueDef($rsnew, $this->SubTotal->CurrentValue, 0, strval($this->SubTotal->CurrentValue) == "");

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

	// Set up master/detail based on QueryString
	function SetupMasterParms() {
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (isset($_GET[EW_TABLE_SHOW_MASTER])) {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "t11_jual") {
				$bValidMaster = TRUE;
				if (@$_GET["fk_id"] <> "") {
					$GLOBALS["t11_jual"]->id->setQueryStringValue($_GET["fk_id"]);
					$this->JualID->setQueryStringValue($GLOBALS["t11_jual"]->id->QueryStringValue);
					$this->JualID->setSessionValue($this->JualID->QueryStringValue);
					if (!is_numeric($GLOBALS["t11_jual"]->id->QueryStringValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		} elseif (isset($_POST[EW_TABLE_SHOW_MASTER])) {
			$sMasterTblVar = $_POST[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "t11_jual") {
				$bValidMaster = TRUE;
				if (@$_POST["fk_id"] <> "") {
					$GLOBALS["t11_jual"]->id->setFormValue($_POST["fk_id"]);
					$this->JualID->setFormValue($GLOBALS["t11_jual"]->id->FormValue);
					$this->JualID->setSessionValue($this->JualID->FormValue);
					if (!is_numeric($GLOBALS["t11_jual"]->id->FormValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$this->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			if (!$this->IsAddOrEdit()) {
				$this->StartRec = 1;
				$this->setStartRecordNumber($this->StartRec);
			}

			// Clear previous master key from Session
			if ($sMasterTblVar <> "t11_jual") {
				if ($this->JualID->CurrentValue == "") $this->JualID->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->GetMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->GetDetailFilter(); // Get detail filter
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("t12_jualdetaillist.php"), "", $this->TableVar, TRUE);
		$PageId = ($this->CurrentAction == "C") ? "Copy" : "Add";
		$Breadcrumb->Add("add", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_ArticleID":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `Kode` AS `DispFld`, `Nama` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t06_article`";
			$sWhereWrk = "{filter}";
			$fld->LookupFilters = array("dx1" => '`Kode`', "dx2" => '`Nama`');
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->ArticleID, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_SatuanID":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `Nama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t07_satuan`";
			$sWhereWrk = "{filter}";
			$fld->LookupFilters = array("dx1" => '`Nama`');
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->SatuanID, $sWhereWrk); // Call Lookup Selecting
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
		case "x_SatuanID":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id`, `Nama` AS `DispFld` FROM `t07_satuan`";
			$sWhereWrk = "`Nama` LIKE '{query_value}%'";
			$fld->LookupFilters = array("dx1" => '`Nama`');
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->SatuanID, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
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
if (!isset($t12_jualdetail_add)) $t12_jualdetail_add = new ct12_jualdetail_add();

// Page init
$t12_jualdetail_add->Page_Init();

// Page main
$t12_jualdetail_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t12_jualdetail_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = ft12_jualdetailadd = new ew_Form("ft12_jualdetailadd", "add");

// Validate form
ft12_jualdetailadd.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_JualID");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t12_jualdetail->JualID->FldCaption(), $t12_jualdetail->JualID->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_JualID");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t12_jualdetail->JualID->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_ArticleID");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t12_jualdetail->ArticleID->FldCaption(), $t12_jualdetail->ArticleID->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_HargaJual");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t12_jualdetail->HargaJual->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Qty");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t12_jualdetail->Qty->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_SubTotal");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t12_jualdetail->SubTotal->FldErrMsg()) ?>");

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
ft12_jualdetailadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ft12_jualdetailadd.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ft12_jualdetailadd.Lists["x_ArticleID"] = {"LinkField":"x_id","Ajax":true,"AutoFill":true,"DisplayFields":["x_Kode","x_Nama","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t06_article"};
ft12_jualdetailadd.Lists["x_ArticleID"].Data = "<?php echo $t12_jualdetail_add->ArticleID->LookupFilterQuery(FALSE, "add") ?>";
ft12_jualdetailadd.Lists["x_SatuanID"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nama","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t07_satuan"};
ft12_jualdetailadd.Lists["x_SatuanID"].Data = "<?php echo $t12_jualdetail_add->SatuanID->LookupFilterQuery(FALSE, "add") ?>";
ft12_jualdetailadd.AutoSuggests["x_SatuanID"] = <?php echo json_encode(array("data" => "ajax=autosuggest&" . $t12_jualdetail_add->SatuanID->LookupFilterQuery(TRUE, "add"))) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $t12_jualdetail_add->ShowPageHeader(); ?>
<?php
$t12_jualdetail_add->ShowMessage();
?>
<form name="ft12_jualdetailadd" id="ft12_jualdetailadd" class="<?php echo $t12_jualdetail_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t12_jualdetail_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t12_jualdetail_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t12_jualdetail">
<input type="hidden" name="a_add" id="a_add" value="A">
<input type="hidden" name="modal" value="<?php echo intval($t12_jualdetail_add->IsModal) ?>">
<?php if ($t12_jualdetail->getCurrentMasterTable() == "t11_jual") { ?>
<input type="hidden" name="<?php echo EW_TABLE_SHOW_MASTER ?>" value="t11_jual">
<input type="hidden" name="fk_id" value="<?php echo $t12_jualdetail->JualID->getSessionValue() ?>">
<?php } ?>
<div class="ewAddDiv"><!-- page* -->
<?php if ($t12_jualdetail->JualID->Visible) { // JualID ?>
	<div id="r_JualID" class="form-group">
		<label id="elh_t12_jualdetail_JualID" for="x_JualID" class="<?php echo $t12_jualdetail_add->LeftColumnClass ?>"><?php echo $t12_jualdetail->JualID->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $t12_jualdetail_add->RightColumnClass ?>"><div<?php echo $t12_jualdetail->JualID->CellAttributes() ?>>
<?php if ($t12_jualdetail->JualID->getSessionValue() <> "") { ?>
<span id="el_t12_jualdetail_JualID">
<span<?php echo $t12_jualdetail->JualID->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t12_jualdetail->JualID->ViewValue ?></p></span>
</span>
<input type="hidden" id="x_JualID" name="x_JualID" value="<?php echo ew_HtmlEncode($t12_jualdetail->JualID->CurrentValue) ?>">
<?php } else { ?>
<span id="el_t12_jualdetail_JualID">
<input type="text" data-table="t12_jualdetail" data-field="x_JualID" name="x_JualID" id="x_JualID" size="30" placeholder="<?php echo ew_HtmlEncode($t12_jualdetail->JualID->getPlaceHolder()) ?>" value="<?php echo $t12_jualdetail->JualID->EditValue ?>"<?php echo $t12_jualdetail->JualID->EditAttributes() ?>>
</span>
<?php } ?>
<?php echo $t12_jualdetail->JualID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t12_jualdetail->ArticleID->Visible) { // ArticleID ?>
	<div id="r_ArticleID" class="form-group">
		<label id="elh_t12_jualdetail_ArticleID" for="x_ArticleID" class="<?php echo $t12_jualdetail_add->LeftColumnClass ?>"><?php echo $t12_jualdetail->ArticleID->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $t12_jualdetail_add->RightColumnClass ?>"><div<?php echo $t12_jualdetail->ArticleID->CellAttributes() ?>>
<span id="el_t12_jualdetail_ArticleID">
<?php $t12_jualdetail->ArticleID->EditAttrs["onchange"] = "ew_AutoFill(this); " . @$t12_jualdetail->ArticleID->EditAttrs["onchange"]; ?>
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_ArticleID"><?php echo (strval($t12_jualdetail->ArticleID->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t12_jualdetail->ArticleID->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t12_jualdetail->ArticleID->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_ArticleID',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($t12_jualdetail->ArticleID->ReadOnly || $t12_jualdetail->ArticleID->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t12_jualdetail" data-field="x_ArticleID" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t12_jualdetail->ArticleID->DisplayValueSeparatorAttribute() ?>" name="x_ArticleID" id="x_ArticleID" value="<?php echo $t12_jualdetail->ArticleID->CurrentValue ?>"<?php echo $t12_jualdetail->ArticleID->EditAttributes() ?>>
<input type="hidden" name="ln_x_ArticleID" id="ln_x_ArticleID" value="x_HargaJual,x_SatuanID">
</span>
<?php echo $t12_jualdetail->ArticleID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t12_jualdetail->HargaJual->Visible) { // HargaJual ?>
	<div id="r_HargaJual" class="form-group">
		<label id="elh_t12_jualdetail_HargaJual" for="x_HargaJual" class="<?php echo $t12_jualdetail_add->LeftColumnClass ?>"><?php echo $t12_jualdetail->HargaJual->FldCaption() ?></label>
		<div class="<?php echo $t12_jualdetail_add->RightColumnClass ?>"><div<?php echo $t12_jualdetail->HargaJual->CellAttributes() ?>>
<span id="el_t12_jualdetail_HargaJual">
<input type="text" data-table="t12_jualdetail" data-field="x_HargaJual" name="x_HargaJual" id="x_HargaJual" size="7" placeholder="<?php echo ew_HtmlEncode($t12_jualdetail->HargaJual->getPlaceHolder()) ?>" value="<?php echo $t12_jualdetail->HargaJual->EditValue ?>"<?php echo $t12_jualdetail->HargaJual->EditAttributes() ?>>
</span>
<?php echo $t12_jualdetail->HargaJual->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t12_jualdetail->Qty->Visible) { // Qty ?>
	<div id="r_Qty" class="form-group">
		<label id="elh_t12_jualdetail_Qty" for="x_Qty" class="<?php echo $t12_jualdetail_add->LeftColumnClass ?>"><?php echo $t12_jualdetail->Qty->FldCaption() ?></label>
		<div class="<?php echo $t12_jualdetail_add->RightColumnClass ?>"><div<?php echo $t12_jualdetail->Qty->CellAttributes() ?>>
<span id="el_t12_jualdetail_Qty">
<input type="text" data-table="t12_jualdetail" data-field="x_Qty" name="x_Qty" id="x_Qty" size="2" placeholder="<?php echo ew_HtmlEncode($t12_jualdetail->Qty->getPlaceHolder()) ?>" value="<?php echo $t12_jualdetail->Qty->EditValue ?>"<?php echo $t12_jualdetail->Qty->EditAttributes() ?>>
</span>
<?php echo $t12_jualdetail->Qty->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t12_jualdetail->SatuanID->Visible) { // SatuanID ?>
	<div id="r_SatuanID" class="form-group">
		<label id="elh_t12_jualdetail_SatuanID" class="<?php echo $t12_jualdetail_add->LeftColumnClass ?>"><?php echo $t12_jualdetail->SatuanID->FldCaption() ?></label>
		<div class="<?php echo $t12_jualdetail_add->RightColumnClass ?>"><div<?php echo $t12_jualdetail->SatuanID->CellAttributes() ?>>
<span id="el_t12_jualdetail_SatuanID">
<?php
$wrkonchange = trim(" " . @$t12_jualdetail->SatuanID->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$t12_jualdetail->SatuanID->EditAttrs["onchange"] = "";
?>
<span id="as_x_SatuanID" style="white-space: nowrap; z-index: 8940">
	<input type="text" name="sv_x_SatuanID" id="sv_x_SatuanID" value="<?php echo $t12_jualdetail->SatuanID->EditValue ?>" size="3" placeholder="<?php echo ew_HtmlEncode($t12_jualdetail->SatuanID->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($t12_jualdetail->SatuanID->getPlaceHolder()) ?>"<?php echo $t12_jualdetail->SatuanID->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t12_jualdetail" data-field="x_SatuanID" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t12_jualdetail->SatuanID->DisplayValueSeparatorAttribute() ?>" name="x_SatuanID" id="x_SatuanID" value="<?php echo ew_HtmlEncode($t12_jualdetail->SatuanID->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script type="text/javascript">
ft12_jualdetailadd.CreateAutoSuggest({"id":"x_SatuanID","forceSelect":true});
</script>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t12_jualdetail->SatuanID->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_SatuanID',m:0,n:10,srch:false});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($t12_jualdetail->SatuanID->ReadOnly || $t12_jualdetail->SatuanID->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
</span>
<?php echo $t12_jualdetail->SatuanID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t12_jualdetail->SubTotal->Visible) { // SubTotal ?>
	<div id="r_SubTotal" class="form-group">
		<label id="elh_t12_jualdetail_SubTotal" for="x_SubTotal" class="<?php echo $t12_jualdetail_add->LeftColumnClass ?>"><?php echo $t12_jualdetail->SubTotal->FldCaption() ?></label>
		<div class="<?php echo $t12_jualdetail_add->RightColumnClass ?>"><div<?php echo $t12_jualdetail->SubTotal->CellAttributes() ?>>
<span id="el_t12_jualdetail_SubTotal">
<input type="text" data-table="t12_jualdetail" data-field="x_SubTotal" name="x_SubTotal" id="x_SubTotal" size="7" placeholder="<?php echo ew_HtmlEncode($t12_jualdetail->SubTotal->getPlaceHolder()) ?>" value="<?php echo $t12_jualdetail->SubTotal->EditValue ?>"<?php echo $t12_jualdetail->SubTotal->EditAttributes() ?>>
</span>
<?php echo $t12_jualdetail->SubTotal->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$t12_jualdetail_add->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $t12_jualdetail_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $t12_jualdetail_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
ft12_jualdetailadd.Init();
</script>
<?php
$t12_jualdetail_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t12_jualdetail_add->Page_Terminate();
?>
