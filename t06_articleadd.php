<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "t06_articleinfo.php" ?>
<?php include_once "t96_employeesinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$t06_article_add = NULL; // Initialize page object first

class ct06_article_add extends ct06_article {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = '{8746EF3F-81FE-4C1C-A7F8-AC191F8DDBB2}';

	// Table name
	var $TableName = 't06_article';

	// Page object name
	var $PageObjName = 't06_article_add';

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

		// Table object (t06_article)
		if (!isset($GLOBALS["t06_article"]) || get_class($GLOBALS["t06_article"]) == "ct06_article") {
			$GLOBALS["t06_article"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t06_article"];
		}

		// Table object (t96_employees)
		if (!isset($GLOBALS['t96_employees'])) $GLOBALS['t96_employees'] = new ct96_employees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 't06_article', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("t06_articlelist.php"));
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
		$this->MainGroupID->SetVisibility();
		$this->SubGroupID->SetVisibility();
		$this->Kode->SetVisibility();
		$this->Nama->SetVisibility();
		$this->SatuanID->SetVisibility();

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
		global $EW_EXPORT, $t06_article;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($t06_article);
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
					if ($pageName == "t06_articleview.php")
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
					$this->Page_Terminate("t06_articlelist.php"); // No matching record, return to list
				}
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "t06_articlelist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "t06_articleview.php")
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
		$this->MainGroupID->CurrentValue = NULL;
		$this->MainGroupID->OldValue = $this->MainGroupID->CurrentValue;
		$this->SubGroupID->CurrentValue = NULL;
		$this->SubGroupID->OldValue = $this->SubGroupID->CurrentValue;
		$this->Kode->CurrentValue = NULL;
		$this->Kode->OldValue = $this->Kode->CurrentValue;
		$this->Nama->CurrentValue = NULL;
		$this->Nama->OldValue = $this->Nama->CurrentValue;
		$this->SatuanID->CurrentValue = NULL;
		$this->SatuanID->OldValue = $this->SatuanID->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->MainGroupID->FldIsDetailKey) {
			$this->MainGroupID->setFormValue($objForm->GetValue("x_MainGroupID"));
		}
		if (!$this->SubGroupID->FldIsDetailKey) {
			$this->SubGroupID->setFormValue($objForm->GetValue("x_SubGroupID"));
		}
		if (!$this->Kode->FldIsDetailKey) {
			$this->Kode->setFormValue($objForm->GetValue("x_Kode"));
		}
		if (!$this->Nama->FldIsDetailKey) {
			$this->Nama->setFormValue($objForm->GetValue("x_Nama"));
		}
		if (!$this->SatuanID->FldIsDetailKey) {
			$this->SatuanID->setFormValue($objForm->GetValue("x_SatuanID"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->MainGroupID->CurrentValue = $this->MainGroupID->FormValue;
		$this->SubGroupID->CurrentValue = $this->SubGroupID->FormValue;
		$this->Kode->CurrentValue = $this->Kode->FormValue;
		$this->Nama->CurrentValue = $this->Nama->FormValue;
		$this->SatuanID->CurrentValue = $this->SatuanID->FormValue;
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
		$this->MainGroupID->setDbValue($row['MainGroupID']);
		if (array_key_exists('EV__MainGroupID', $rs->fields)) {
			$this->MainGroupID->VirtualValue = $rs->fields('EV__MainGroupID'); // Set up virtual field value
		} else {
			$this->MainGroupID->VirtualValue = ""; // Clear value
		}
		$this->SubGroupID->setDbValue($row['SubGroupID']);
		if (array_key_exists('EV__SubGroupID', $rs->fields)) {
			$this->SubGroupID->VirtualValue = $rs->fields('EV__SubGroupID'); // Set up virtual field value
		} else {
			$this->SubGroupID->VirtualValue = ""; // Clear value
		}
		$this->Kode->setDbValue($row['Kode']);
		$this->Nama->setDbValue($row['Nama']);
		$this->SatuanID->setDbValue($row['SatuanID']);
		if (array_key_exists('EV__SatuanID', $rs->fields)) {
			$this->SatuanID->VirtualValue = $rs->fields('EV__SatuanID'); // Set up virtual field value
		} else {
			$this->SatuanID->VirtualValue = ""; // Clear value
		}
	}

	// Return a row with default values
	function NewRow() {
		$this->LoadDefaultValues();
		$row = array();
		$row['id'] = $this->id->CurrentValue;
		$row['MainGroupID'] = $this->MainGroupID->CurrentValue;
		$row['SubGroupID'] = $this->SubGroupID->CurrentValue;
		$row['Kode'] = $this->Kode->CurrentValue;
		$row['Nama'] = $this->Nama->CurrentValue;
		$row['SatuanID'] = $this->SatuanID->CurrentValue;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->MainGroupID->DbValue = $row['MainGroupID'];
		$this->SubGroupID->DbValue = $row['SubGroupID'];
		$this->Kode->DbValue = $row['Kode'];
		$this->Nama->DbValue = $row['Nama'];
		$this->SatuanID->DbValue = $row['SatuanID'];
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
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// MainGroupID
		// SubGroupID
		// Kode
		// Nama
		// SatuanID

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// MainGroupID
		if ($this->MainGroupID->VirtualValue <> "") {
			$this->MainGroupID->ViewValue = $this->MainGroupID->VirtualValue;
		} else {
		if (strval($this->MainGroupID->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->MainGroupID->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `Kode` AS `DispFld`, `Nama` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t04_maingroup`";
		$sWhereWrk = "";
		$this->MainGroupID->LookupFilters = array("dx1" => '`Kode`', "dx2" => '`Nama`');
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->MainGroupID, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$arwrk[2] = $rswrk->fields('Disp2Fld');
				$this->MainGroupID->ViewValue = $this->MainGroupID->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->MainGroupID->ViewValue = $this->MainGroupID->CurrentValue;
			}
		} else {
			$this->MainGroupID->ViewValue = NULL;
		}
		}
		$this->MainGroupID->ViewCustomAttributes = "";

		// SubGroupID
		if ($this->SubGroupID->VirtualValue <> "") {
			$this->SubGroupID->ViewValue = $this->SubGroupID->VirtualValue;
		} else {
		if (strval($this->SubGroupID->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->SubGroupID->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `Kode` AS `DispFld`, `Nama` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t05_subgroup`";
		$sWhereWrk = "";
		$this->SubGroupID->LookupFilters = array("dx1" => '`Kode`', "dx2" => '`Nama`');
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->SubGroupID, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$arwrk[2] = $rswrk->fields('Disp2Fld');
				$this->SubGroupID->ViewValue = $this->SubGroupID->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->SubGroupID->ViewValue = $this->SubGroupID->CurrentValue;
			}
		} else {
			$this->SubGroupID->ViewValue = NULL;
		}
		}
		$this->SubGroupID->ViewCustomAttributes = "";

		// Kode
		$this->Kode->ViewValue = $this->Kode->CurrentValue;
		$this->Kode->ViewCustomAttributes = "";

		// Nama
		$this->Nama->ViewValue = $this->Nama->CurrentValue;
		$this->Nama->ViewCustomAttributes = "";

		// SatuanID
		if ($this->SatuanID->VirtualValue <> "") {
			$this->SatuanID->ViewValue = $this->SatuanID->VirtualValue;
		} else {
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

			// MainGroupID
			$this->MainGroupID->LinkCustomAttributes = "";
			$this->MainGroupID->HrefValue = "";
			$this->MainGroupID->TooltipValue = "";

			// SubGroupID
			$this->SubGroupID->LinkCustomAttributes = "";
			$this->SubGroupID->HrefValue = "";
			$this->SubGroupID->TooltipValue = "";

			// Kode
			$this->Kode->LinkCustomAttributes = "";
			$this->Kode->HrefValue = "";
			$this->Kode->TooltipValue = "";

			// Nama
			$this->Nama->LinkCustomAttributes = "";
			$this->Nama->HrefValue = "";
			$this->Nama->TooltipValue = "";

			// SatuanID
			$this->SatuanID->LinkCustomAttributes = "";
			$this->SatuanID->HrefValue = "";
			$this->SatuanID->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// MainGroupID
			$this->MainGroupID->EditCustomAttributes = "";
			if (trim(strval($this->MainGroupID->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->MainGroupID->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `id`, `Kode` AS `DispFld`, `Nama` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `t04_maingroup`";
			$sWhereWrk = "";
			$this->MainGroupID->LookupFilters = array("dx1" => '`Kode`', "dx2" => '`Nama`');
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->MainGroupID, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
				$arwrk[2] = ew_HtmlEncode($rswrk->fields('Disp2Fld'));
				$this->MainGroupID->ViewValue = $this->MainGroupID->DisplayValue($arwrk);
			} else {
				$this->MainGroupID->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->MainGroupID->EditValue = $arwrk;

			// SubGroupID
			$this->SubGroupID->EditCustomAttributes = "";
			if (trim(strval($this->SubGroupID->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->SubGroupID->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `id`, `Kode` AS `DispFld`, `Nama` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, `MainGroupID` AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `t05_subgroup`";
			$sWhereWrk = "";
			$this->SubGroupID->LookupFilters = array("dx1" => '`Kode`', "dx2" => '`Nama`');
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->SubGroupID, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
				$arwrk[2] = ew_HtmlEncode($rswrk->fields('Disp2Fld'));
				$this->SubGroupID->ViewValue = $this->SubGroupID->DisplayValue($arwrk);
			} else {
				$this->SubGroupID->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->SubGroupID->EditValue = $arwrk;

			// Kode
			$this->Kode->EditAttrs["class"] = "form-control";
			$this->Kode->EditCustomAttributes = "";
			$this->Kode->EditValue = ew_HtmlEncode($this->Kode->CurrentValue);
			$this->Kode->PlaceHolder = ew_RemoveHtml($this->Kode->FldCaption());

			// Nama
			$this->Nama->EditAttrs["class"] = "form-control";
			$this->Nama->EditCustomAttributes = "";
			$this->Nama->EditValue = ew_HtmlEncode($this->Nama->CurrentValue);
			$this->Nama->PlaceHolder = ew_RemoveHtml($this->Nama->FldCaption());

			// SatuanID
			$this->SatuanID->EditCustomAttributes = "";
			if (trim(strval($this->SatuanID->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->SatuanID->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `id`, `Nama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `t07_satuan`";
			$sWhereWrk = "";
			$this->SatuanID->LookupFilters = array("dx1" => '`Nama`');
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->SatuanID, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
				$this->SatuanID->ViewValue = $this->SatuanID->DisplayValue($arwrk);
			} else {
				$this->SatuanID->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->SatuanID->EditValue = $arwrk;

			// Add refer script
			// MainGroupID

			$this->MainGroupID->LinkCustomAttributes = "";
			$this->MainGroupID->HrefValue = "";

			// SubGroupID
			$this->SubGroupID->LinkCustomAttributes = "";
			$this->SubGroupID->HrefValue = "";

			// Kode
			$this->Kode->LinkCustomAttributes = "";
			$this->Kode->HrefValue = "";

			// Nama
			$this->Nama->LinkCustomAttributes = "";
			$this->Nama->HrefValue = "";

			// SatuanID
			$this->SatuanID->LinkCustomAttributes = "";
			$this->SatuanID->HrefValue = "";
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
		if (!$this->SubGroupID->FldIsDetailKey && !is_null($this->SubGroupID->FormValue) && $this->SubGroupID->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->SubGroupID->FldCaption(), $this->SubGroupID->ReqErrMsg));
		}
		if (!$this->Kode->FldIsDetailKey && !is_null($this->Kode->FormValue) && $this->Kode->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Kode->FldCaption(), $this->Kode->ReqErrMsg));
		}
		if (!$this->Nama->FldIsDetailKey && !is_null($this->Nama->FormValue) && $this->Nama->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Nama->FldCaption(), $this->Nama->ReqErrMsg));
		}
		if (!$this->SatuanID->FldIsDetailKey && !is_null($this->SatuanID->FormValue) && $this->SatuanID->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->SatuanID->FldCaption(), $this->SatuanID->ReqErrMsg));
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
		if ($this->Kode->CurrentValue <> "") { // Check field with unique index
			$sFilter = "(Kode = '" . ew_AdjustSql($this->Kode->CurrentValue, $this->DBID) . "')";
			$rsChk = $this->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", $this->Kode->FldCaption(), $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $this->Kode->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		if ($this->Nama->CurrentValue <> "") { // Check field with unique index
			$sFilter = "(Nama = '" . ew_AdjustSql($this->Nama->CurrentValue, $this->DBID) . "')";
			$rsChk = $this->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", $this->Nama->FldCaption(), $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $this->Nama->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$conn = &$this->Connection();

		// Load db values from rsold
		$this->LoadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = array();

		// MainGroupID
		$this->MainGroupID->SetDbValueDef($rsnew, $this->MainGroupID->CurrentValue, NULL, FALSE);

		// SubGroupID
		$this->SubGroupID->SetDbValueDef($rsnew, $this->SubGroupID->CurrentValue, 0, FALSE);

		// Kode
		$this->Kode->SetDbValueDef($rsnew, $this->Kode->CurrentValue, "", FALSE);

		// Nama
		$this->Nama->SetDbValueDef($rsnew, $this->Nama->CurrentValue, "", FALSE);

		// SatuanID
		$this->SatuanID->SetDbValueDef($rsnew, $this->SatuanID->CurrentValue, 0, FALSE);

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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("t06_articlelist.php"), "", $this->TableVar, TRUE);
		$PageId = ($this->CurrentAction == "C") ? "Copy" : "Add";
		$Breadcrumb->Add("add", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_MainGroupID":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `Kode` AS `DispFld`, `Nama` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t04_maingroup`";
			$sWhereWrk = "{filter}";
			$fld->LookupFilters = array("dx1" => '`Kode`', "dx2" => '`Nama`');
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->MainGroupID, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_SubGroupID":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `Kode` AS `DispFld`, `Nama` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t05_subgroup`";
			$sWhereWrk = "{filter}";
			$fld->LookupFilters = array("dx1" => '`Kode`', "dx2" => '`Nama`');
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` IN ({filter_value})', "t0" => "3", "fn0" => "", "f1" => '`MainGroupID` IN ({filter_value})', "t1" => "3", "fn1" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->SubGroupID, $sWhereWrk); // Call Lookup Selecting
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
if (!isset($t06_article_add)) $t06_article_add = new ct06_article_add();

// Page init
$t06_article_add->Page_Init();

// Page main
$t06_article_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t06_article_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = ft06_articleadd = new ew_Form("ft06_articleadd", "add");

// Validate form
ft06_articleadd.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_SubGroupID");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t06_article->SubGroupID->FldCaption(), $t06_article->SubGroupID->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Kode");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t06_article->Kode->FldCaption(), $t06_article->Kode->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Nama");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t06_article->Nama->FldCaption(), $t06_article->Nama->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_SatuanID");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t06_article->SatuanID->FldCaption(), $t06_article->SatuanID->ReqErrMsg)) ?>");

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
ft06_articleadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ft06_articleadd.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ft06_articleadd.Lists["x_MainGroupID"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Kode","x_Nama","",""],"ParentFields":[],"ChildFields":["x_SubGroupID"],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t04_maingroup"};
ft06_articleadd.Lists["x_MainGroupID"].Data = "<?php echo $t06_article_add->MainGroupID->LookupFilterQuery(FALSE, "add") ?>";
ft06_articleadd.Lists["x_SubGroupID"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Kode","x_Nama","",""],"ParentFields":["x_MainGroupID"],"ChildFields":[],"FilterFields":["x_MainGroupID"],"Options":[],"Template":"","LinkTable":"t05_subgroup"};
ft06_articleadd.Lists["x_SubGroupID"].Data = "<?php echo $t06_article_add->SubGroupID->LookupFilterQuery(FALSE, "add") ?>";
ft06_articleadd.Lists["x_SatuanID"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nama","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t07_satuan"};
ft06_articleadd.Lists["x_SatuanID"].Data = "<?php echo $t06_article_add->SatuanID->LookupFilterQuery(FALSE, "add") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $t06_article_add->ShowPageHeader(); ?>
<?php
$t06_article_add->ShowMessage();
?>
<form name="ft06_articleadd" id="ft06_articleadd" class="<?php echo $t06_article_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t06_article_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t06_article_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t06_article">
<input type="hidden" name="a_add" id="a_add" value="A">
<input type="hidden" name="modal" value="<?php echo intval($t06_article_add->IsModal) ?>">
<div class="ewAddDiv"><!-- page* -->
<?php if ($t06_article->MainGroupID->Visible) { // MainGroupID ?>
	<div id="r_MainGroupID" class="form-group">
		<label id="elh_t06_article_MainGroupID" for="x_MainGroupID" class="<?php echo $t06_article_add->LeftColumnClass ?>"><?php echo $t06_article->MainGroupID->FldCaption() ?></label>
		<div class="<?php echo $t06_article_add->RightColumnClass ?>"><div<?php echo $t06_article->MainGroupID->CellAttributes() ?>>
<span id="el_t06_article_MainGroupID">
<?php $t06_article->MainGroupID->EditAttrs["onchange"] = "ew_UpdateOpt.call(this); " . @$t06_article->MainGroupID->EditAttrs["onchange"]; ?>
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_MainGroupID"><?php echo (strval($t06_article->MainGroupID->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t06_article->MainGroupID->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t06_article->MainGroupID->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_MainGroupID',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($t06_article->MainGroupID->ReadOnly || $t06_article->MainGroupID->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t06_article" data-field="x_MainGroupID" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t06_article->MainGroupID->DisplayValueSeparatorAttribute() ?>" name="x_MainGroupID" id="x_MainGroupID" value="<?php echo $t06_article->MainGroupID->CurrentValue ?>"<?php echo $t06_article->MainGroupID->EditAttributes() ?>>
</span>
<?php echo $t06_article->MainGroupID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t06_article->SubGroupID->Visible) { // SubGroupID ?>
	<div id="r_SubGroupID" class="form-group">
		<label id="elh_t06_article_SubGroupID" for="x_SubGroupID" class="<?php echo $t06_article_add->LeftColumnClass ?>"><?php echo $t06_article->SubGroupID->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $t06_article_add->RightColumnClass ?>"><div<?php echo $t06_article->SubGroupID->CellAttributes() ?>>
<span id="el_t06_article_SubGroupID">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_SubGroupID"><?php echo (strval($t06_article->SubGroupID->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t06_article->SubGroupID->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t06_article->SubGroupID->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_SubGroupID',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($t06_article->SubGroupID->ReadOnly || $t06_article->SubGroupID->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t06_article" data-field="x_SubGroupID" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t06_article->SubGroupID->DisplayValueSeparatorAttribute() ?>" name="x_SubGroupID" id="x_SubGroupID" value="<?php echo $t06_article->SubGroupID->CurrentValue ?>"<?php echo $t06_article->SubGroupID->EditAttributes() ?>>
</span>
<?php echo $t06_article->SubGroupID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t06_article->Kode->Visible) { // Kode ?>
	<div id="r_Kode" class="form-group">
		<label id="elh_t06_article_Kode" for="x_Kode" class="<?php echo $t06_article_add->LeftColumnClass ?>"><?php echo $t06_article->Kode->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $t06_article_add->RightColumnClass ?>"><div<?php echo $t06_article->Kode->CellAttributes() ?>>
<span id="el_t06_article_Kode">
<input type="text" data-table="t06_article" data-field="x_Kode" name="x_Kode" id="x_Kode" size="30" maxlength="7" placeholder="<?php echo ew_HtmlEncode($t06_article->Kode->getPlaceHolder()) ?>" value="<?php echo $t06_article->Kode->EditValue ?>"<?php echo $t06_article->Kode->EditAttributes() ?>>
</span>
<?php echo $t06_article->Kode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t06_article->Nama->Visible) { // Nama ?>
	<div id="r_Nama" class="form-group">
		<label id="elh_t06_article_Nama" for="x_Nama" class="<?php echo $t06_article_add->LeftColumnClass ?>"><?php echo $t06_article->Nama->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $t06_article_add->RightColumnClass ?>"><div<?php echo $t06_article->Nama->CellAttributes() ?>>
<span id="el_t06_article_Nama">
<input type="text" data-table="t06_article" data-field="x_Nama" name="x_Nama" id="x_Nama" size="30" maxlength="75" placeholder="<?php echo ew_HtmlEncode($t06_article->Nama->getPlaceHolder()) ?>" value="<?php echo $t06_article->Nama->EditValue ?>"<?php echo $t06_article->Nama->EditAttributes() ?>>
</span>
<?php echo $t06_article->Nama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t06_article->SatuanID->Visible) { // SatuanID ?>
	<div id="r_SatuanID" class="form-group">
		<label id="elh_t06_article_SatuanID" for="x_SatuanID" class="<?php echo $t06_article_add->LeftColumnClass ?>"><?php echo $t06_article->SatuanID->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $t06_article_add->RightColumnClass ?>"><div<?php echo $t06_article->SatuanID->CellAttributes() ?>>
<span id="el_t06_article_SatuanID">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_SatuanID"><?php echo (strval($t06_article->SatuanID->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t06_article->SatuanID->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t06_article->SatuanID->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_SatuanID',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($t06_article->SatuanID->ReadOnly || $t06_article->SatuanID->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t06_article" data-field="x_SatuanID" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t06_article->SatuanID->DisplayValueSeparatorAttribute() ?>" name="x_SatuanID" id="x_SatuanID" value="<?php echo $t06_article->SatuanID->CurrentValue ?>"<?php echo $t06_article->SatuanID->EditAttributes() ?>>
<?php if (AllowAdd(CurrentProjectID() . "t07_satuan") && !$t06_article->SatuanID->ReadOnly) { ?>
<button type="button" title="<?php echo ew_HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $t06_article->SatuanID->FldCaption() ?>" onclick="ew_AddOptDialogShow({lnk:this,el:'x_SatuanID',url:'t07_satuanaddopt.php'});" class="ewAddOptBtn btn btn-default btn-sm" id="aol_x_SatuanID"><span class="glyphicon glyphicon-plus ewIcon"></span><span class="hide"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $t06_article->SatuanID->FldCaption() ?></span></button>
<?php } ?>
</span>
<?php echo $t06_article->SatuanID->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$t06_article_add->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $t06_article_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $t06_article_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
ft06_articleadd.Init();
</script>
<?php
$t06_article_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");
function f_BuatAjax() {
	if (window.XMLHttpRequest) {
		return new XMLHttpRequest();
	}
	if (window.ActiveXObject) {
		return new ActiveXObject("Microsoft.XMLHTTP");
	}
	return null;
}
$("#x_MainGroupID").change(

	function () {
		article_SubGroupID = "";
		if (this.value != "") {

			//alert(this.value);
		}
	}
);
</script>
<?php include_once "footer.php" ?>
<?php
$t06_article_add->Page_Terminate();
?>
