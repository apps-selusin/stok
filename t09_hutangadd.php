<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "t09_hutanginfo.php" ?>
<?php include_once "t96_employeesinfo.php" ?>
<?php include_once "t10_hutangdetailgridcls.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$t09_hutang_add = NULL; // Initialize page object first

class ct09_hutang_add extends ct09_hutang {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = '{8746EF3F-81FE-4C1C-A7F8-AC191F8DDBB2}';

	// Table name
	var $TableName = 't09_hutang';

	// Page object name
	var $PageObjName = 't09_hutang_add';

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
			define("EW_PAGE_ID", 'add', TRUE);

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
		// Create form object

		$objForm = new cFormObj();
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

		// Process auto fill
		if (@$_POST["ajax"] == "autofill") {

			// Get the keys for master table
			$sDetailTblVar = $this->getCurrentDetailTable();
			if ($sDetailTblVar <> "") {
				$DetailTblVar = explode(",", $sDetailTblVar);
				if (in_array("t10_hutangdetail", $DetailTblVar)) {

					// Process auto fill for detail table 't10_hutangdetail'
					if (preg_match('/^ft10_hutangdetail(grid|add|addopt|edit|update|search)$/', @$_POST["form"])) {
						if (!isset($GLOBALS["t10_hutangdetail_grid"])) $GLOBALS["t10_hutangdetail_grid"] = new ct10_hutangdetail_grid;
						$GLOBALS["t10_hutangdetail_grid"]->Page_Init();
						$this->Page_Terminate();
						exit();
					}
				}
			}
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

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = array("url" => $url, "modal" => "1");
				$pageName = ew_GetPageName($url);
				if ($pageName != $this->GetListUrl()) { // Not List page
					$row["caption"] = $this->GetModalCaption($pageName);
					if ($pageName == "t09_hutangview.php")
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

		// Set up detail parameters
		$this->SetupDetailParms();

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
					$this->Page_Terminate("t09_hutanglist.php"); // No matching record, return to list
				}

				// Set up detail parameters
				$this->SetupDetailParms();
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					if ($this->getCurrentDetailTable() <> "") // Master/detail add
						$sReturnUrl = $this->GetDetailUrl();
					else
						$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "t09_hutanglist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "t09_hutangview.php")
						$sReturnUrl = $this->GetViewUrl(); // View page, return to View page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values

					// Set up detail parameters
					$this->SetupDetailParms();
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
		$this->NoHutang->CurrentValue = NULL;
		$this->NoHutang->OldValue = $this->NoHutang->CurrentValue;
		$this->BeliID->CurrentValue = NULL;
		$this->BeliID->OldValue = $this->BeliID->CurrentValue;
		$this->JumlahHutang->CurrentValue = 0.00;
		$this->JumlahBayar->CurrentValue = 0.00;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->NoHutang->FldIsDetailKey) {
			$this->NoHutang->setFormValue($objForm->GetValue("x_NoHutang"));
		}
		if (!$this->BeliID->FldIsDetailKey) {
			$this->BeliID->setFormValue($objForm->GetValue("x_BeliID"));
		}
		if (!$this->JumlahHutang->FldIsDetailKey) {
			$this->JumlahHutang->setFormValue($objForm->GetValue("x_JumlahHutang"));
		}
		if (!$this->JumlahBayar->FldIsDetailKey) {
			$this->JumlahBayar->setFormValue($objForm->GetValue("x_JumlahBayar"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->NoHutang->CurrentValue = $this->NoHutang->FormValue;
		$this->BeliID->CurrentValue = $this->BeliID->FormValue;
		$this->JumlahHutang->CurrentValue = $this->JumlahHutang->FormValue;
		$this->JumlahBayar->CurrentValue = $this->JumlahBayar->FormValue;
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
		$this->LoadDefaultValues();
		$row = array();
		$row['id'] = $this->id->CurrentValue;
		$row['NoHutang'] = $this->NoHutang->CurrentValue;
		$row['BeliID'] = $this->BeliID->CurrentValue;
		$row['JumlahHutang'] = $this->JumlahHutang->CurrentValue;
		$row['JumlahBayar'] = $this->JumlahBayar->CurrentValue;
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
		$sSqlWrk = "SELECT `id`, `TglPO` AS `DispFld`, `NoPO` AS `Disp2Fld`, `SubTotal` AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t08_beli`";
		$sWhereWrk = "";
		$this->BeliID->LookupFilters = array("df1" => "7", "dx1" => ew_CastDateFieldForLike('`TglPO`', 7, "DB"), "dx2" => '`NoPO`', "dx3" => '`SubTotal`');
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->BeliID, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_FormatDateTime($rswrk->fields('DispFld'), 7);
				$arwrk[2] = $rswrk->fields('Disp2Fld');
				$arwrk[3] = ew_FormatNumber($rswrk->fields('Disp3Fld'), 2, -2, -2, -2);
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
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// NoHutang
			$this->NoHutang->EditAttrs["class"] = "form-control";
			$this->NoHutang->EditCustomAttributes = "";
			$this->NoHutang->EditValue = ew_HtmlEncode($this->NoHutang->CurrentValue);
			$this->NoHutang->PlaceHolder = ew_RemoveHtml($this->NoHutang->FldCaption());

			// BeliID
			$this->BeliID->EditAttrs["class"] = "form-control";
			$this->BeliID->EditCustomAttributes = "";
			$this->BeliID->EditValue = ew_HtmlEncode($this->BeliID->CurrentValue);
			if (strval($this->BeliID->CurrentValue) <> "") {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->BeliID->CurrentValue, EW_DATATYPE_NUMBER, "");
			$sSqlWrk = "SELECT `id`, `TglPO` AS `DispFld`, `NoPO` AS `Disp2Fld`, `SubTotal` AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t08_beli`";
			$sWhereWrk = "";
			$this->BeliID->LookupFilters = array("df1" => "7", "dx1" => ew_CastDateFieldForLike('`TglPO`', 7, "DB"), "dx2" => '`NoPO`', "dx3" => '`SubTotal`');
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->BeliID, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = Conn()->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = ew_HtmlEncode(ew_FormatDateTime($rswrk->fields('DispFld'), 7));
					$arwrk[2] = ew_HtmlEncode($rswrk->fields('Disp2Fld'));
					$arwrk[3] = ew_HtmlEncode(ew_FormatNumber($rswrk->fields('Disp3Fld'), 2, -2, -2, -2));
					$this->BeliID->EditValue = $this->BeliID->DisplayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->BeliID->EditValue = ew_HtmlEncode($this->BeliID->CurrentValue);
				}
			} else {
				$this->BeliID->EditValue = NULL;
			}
			$this->BeliID->PlaceHolder = ew_RemoveHtml($this->BeliID->FldCaption());

			// JumlahHutang
			$this->JumlahHutang->EditAttrs["class"] = "form-control";
			$this->JumlahHutang->EditCustomAttributes = "";
			$this->JumlahHutang->EditValue = ew_HtmlEncode($this->JumlahHutang->CurrentValue);
			$this->JumlahHutang->PlaceHolder = ew_RemoveHtml($this->JumlahHutang->FldCaption());
			if (strval($this->JumlahHutang->EditValue) <> "" && is_numeric($this->JumlahHutang->EditValue)) $this->JumlahHutang->EditValue = ew_FormatNumber($this->JumlahHutang->EditValue, -2, -2, -2, -2);

			// JumlahBayar
			$this->JumlahBayar->EditAttrs["class"] = "form-control";
			$this->JumlahBayar->EditCustomAttributes = "";
			$this->JumlahBayar->EditValue = ew_HtmlEncode($this->JumlahBayar->CurrentValue);
			$this->JumlahBayar->PlaceHolder = ew_RemoveHtml($this->JumlahBayar->FldCaption());
			if (strval($this->JumlahBayar->EditValue) <> "" && is_numeric($this->JumlahBayar->EditValue)) $this->JumlahBayar->EditValue = ew_FormatNumber($this->JumlahBayar->EditValue, -2, -2, -2, -2);

			// Add refer script
			// NoHutang

			$this->NoHutang->LinkCustomAttributes = "";
			$this->NoHutang->HrefValue = "";

			// BeliID
			$this->BeliID->LinkCustomAttributes = "";
			$this->BeliID->HrefValue = "";

			// JumlahHutang
			$this->JumlahHutang->LinkCustomAttributes = "";
			$this->JumlahHutang->HrefValue = "";

			// JumlahBayar
			$this->JumlahBayar->LinkCustomAttributes = "";
			$this->JumlahBayar->HrefValue = "";
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
		if (!$this->NoHutang->FldIsDetailKey && !is_null($this->NoHutang->FormValue) && $this->NoHutang->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->NoHutang->FldCaption(), $this->NoHutang->ReqErrMsg));
		}
		if (!$this->BeliID->FldIsDetailKey && !is_null($this->BeliID->FormValue) && $this->BeliID->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->BeliID->FldCaption(), $this->BeliID->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->JumlahHutang->FormValue)) {
			ew_AddMessage($gsFormError, $this->JumlahHutang->FldErrMsg());
		}
		if (!ew_CheckNumber($this->JumlahBayar->FormValue)) {
			ew_AddMessage($gsFormError, $this->JumlahBayar->FldErrMsg());
		}

		// Validate detail grid
		$DetailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("t10_hutangdetail", $DetailTblVar) && $GLOBALS["t10_hutangdetail"]->DetailAdd) {
			if (!isset($GLOBALS["t10_hutangdetail_grid"])) $GLOBALS["t10_hutangdetail_grid"] = new ct10_hutangdetail_grid(); // get detail page object
			$GLOBALS["t10_hutangdetail_grid"]->ValidateGridForm();
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

		// Begin transaction
		if ($this->getCurrentDetailTable() <> "")
			$conn->BeginTrans();

		// Load db values from rsold
		$this->LoadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = array();

		// NoHutang
		$this->NoHutang->SetDbValueDef($rsnew, $this->NoHutang->CurrentValue, "", FALSE);

		// BeliID
		$this->BeliID->SetDbValueDef($rsnew, $this->BeliID->CurrentValue, 0, FALSE);

		// JumlahHutang
		$this->JumlahHutang->SetDbValueDef($rsnew, $this->JumlahHutang->CurrentValue, 0, strval($this->JumlahHutang->CurrentValue) == "");

		// JumlahBayar
		$this->JumlahBayar->SetDbValueDef($rsnew, $this->JumlahBayar->CurrentValue, 0, strval($this->JumlahBayar->CurrentValue) == "");

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

		// Add detail records
		if ($AddRow) {
			$DetailTblVar = explode(",", $this->getCurrentDetailTable());
			if (in_array("t10_hutangdetail", $DetailTblVar) && $GLOBALS["t10_hutangdetail"]->DetailAdd) {
				$GLOBALS["t10_hutangdetail"]->HutangID->setSessionValue($this->id->CurrentValue); // Set master key
				if (!isset($GLOBALS["t10_hutangdetail_grid"])) $GLOBALS["t10_hutangdetail_grid"] = new ct10_hutangdetail_grid(); // Get detail page object
				$Security->LoadCurrentUserLevel($this->ProjectID . "t10_hutangdetail"); // Load user level of detail table
				$AddRow = $GLOBALS["t10_hutangdetail_grid"]->GridInsert();
				$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$AddRow)
					$GLOBALS["t10_hutangdetail"]->HutangID->setSessionValue(""); // Clear master key if insert failed
			}
		}

		// Commit/Rollback transaction
		if ($this->getCurrentDetailTable() <> "") {
			if ($AddRow) {
				$conn->CommitTrans(); // Commit transaction
			} else {
				$conn->RollbackTrans(); // Rollback transaction
			}
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$this->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
	}

	// Set up detail parms based on QueryString
	function SetupDetailParms() {

		// Get the keys for master table
		if (isset($_GET[EW_TABLE_SHOW_DETAIL])) {
			$sDetailTblVar = $_GET[EW_TABLE_SHOW_DETAIL];
			$this->setCurrentDetailTable($sDetailTblVar);
		} else {
			$sDetailTblVar = $this->getCurrentDetailTable();
		}
		if ($sDetailTblVar <> "") {
			$DetailTblVar = explode(",", $sDetailTblVar);
			if (in_array("t10_hutangdetail", $DetailTblVar)) {
				if (!isset($GLOBALS["t10_hutangdetail_grid"]))
					$GLOBALS["t10_hutangdetail_grid"] = new ct10_hutangdetail_grid;
				if ($GLOBALS["t10_hutangdetail_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["t10_hutangdetail_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["t10_hutangdetail_grid"]->CurrentMode = "add";
					$GLOBALS["t10_hutangdetail_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["t10_hutangdetail_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["t10_hutangdetail_grid"]->setStartRecordNumber(1);
					$GLOBALS["t10_hutangdetail_grid"]->HutangID->FldIsDetailKey = TRUE;
					$GLOBALS["t10_hutangdetail_grid"]->HutangID->CurrentValue = $this->id->CurrentValue;
					$GLOBALS["t10_hutangdetail_grid"]->HutangID->setSessionValue($GLOBALS["t10_hutangdetail_grid"]->HutangID->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("t09_hutanglist.php"), "", $this->TableVar, TRUE);
		$PageId = ($this->CurrentAction == "C") ? "Copy" : "Add";
		$Breadcrumb->Add("add", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_BeliID":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `TglPO` AS `DispFld`, `NoPO` AS `Disp2Fld`, `SubTotal` AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t08_beli`";
			$sWhereWrk = "{filter}";
			$fld->LookupFilters = array("df1" => "7", "dx1" => ew_CastDateFieldForLike('`TglPO`', 7, "DB"), "dx2" => '`NoPO`', "dx3" => '`SubTotal`');
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->BeliID, $sWhereWrk); // Call Lookup Selecting
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
		case "x_BeliID":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id`, `TglPO` AS `DispFld`, `NoPO` AS `Disp2Fld`, `SubTotal` AS `Disp3Fld` FROM `t08_beli`";
			$sWhereWrk = "" . ew_CastDateFieldForLike('`TglPO`', 7, "DB") . " LIKE '{query_value}%' OR CONCAT(COALESCE(" . ew_CastDateFieldForLike('`TglPO`', 7, "DB") . ", ''),'" . ew_ValueSeparator(1, $this->BeliID) . "',COALESCE(`NoPO`,''),'" . ew_ValueSeparator(2, $this->BeliID) . "',COALESCE(`SubTotal`,'')) LIKE '{query_value}%'";
			$fld->LookupFilters = array("df1" => "7", "dx1" => ew_CastDateFieldForLike('`TglPO`', 7, "DB"), "dx2" => '`NoPO`', "dx3" => '`SubTotal`');
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->BeliID, $sWhereWrk); // Call Lookup Selecting
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
if (!isset($t09_hutang_add)) $t09_hutang_add = new ct09_hutang_add();

// Page init
$t09_hutang_add->Page_Init();

// Page main
$t09_hutang_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t09_hutang_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = ft09_hutangadd = new ew_Form("ft09_hutangadd", "add");

// Validate form
ft09_hutangadd.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_NoHutang");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t09_hutang->NoHutang->FldCaption(), $t09_hutang->NoHutang->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_BeliID");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t09_hutang->BeliID->FldCaption(), $t09_hutang->BeliID->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_JumlahHutang");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t09_hutang->JumlahHutang->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_JumlahBayar");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t09_hutang->JumlahBayar->FldErrMsg()) ?>");

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
ft09_hutangadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ft09_hutangadd.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ft09_hutangadd.Lists["x_BeliID"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_TglPO","x_NoPO","x_SubTotal",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t08_beli"};
ft09_hutangadd.Lists["x_BeliID"].Data = "<?php echo $t09_hutang_add->BeliID->LookupFilterQuery(FALSE, "add") ?>";
ft09_hutangadd.AutoSuggests["x_BeliID"] = <?php echo json_encode(array("data" => "ajax=autosuggest&" . $t09_hutang_add->BeliID->LookupFilterQuery(TRUE, "add"))) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $t09_hutang_add->ShowPageHeader(); ?>
<?php
$t09_hutang_add->ShowMessage();
?>
<form name="ft09_hutangadd" id="ft09_hutangadd" class="<?php echo $t09_hutang_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t09_hutang_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t09_hutang_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t09_hutang">
<input type="hidden" name="a_add" id="a_add" value="A">
<input type="hidden" name="modal" value="<?php echo intval($t09_hutang_add->IsModal) ?>">
<div class="ewAddDiv"><!-- page* -->
<?php if ($t09_hutang->NoHutang->Visible) { // NoHutang ?>
	<div id="r_NoHutang" class="form-group">
		<label id="elh_t09_hutang_NoHutang" for="x_NoHutang" class="<?php echo $t09_hutang_add->LeftColumnClass ?>"><?php echo $t09_hutang->NoHutang->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $t09_hutang_add->RightColumnClass ?>"><div<?php echo $t09_hutang->NoHutang->CellAttributes() ?>>
<span id="el_t09_hutang_NoHutang">
<input type="text" data-table="t09_hutang" data-field="x_NoHutang" name="x_NoHutang" id="x_NoHutang" size="30" maxlength="8" placeholder="<?php echo ew_HtmlEncode($t09_hutang->NoHutang->getPlaceHolder()) ?>" value="<?php echo $t09_hutang->NoHutang->EditValue ?>"<?php echo $t09_hutang->NoHutang->EditAttributes() ?>>
</span>
<?php echo $t09_hutang->NoHutang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t09_hutang->BeliID->Visible) { // BeliID ?>
	<div id="r_BeliID" class="form-group">
		<label id="elh_t09_hutang_BeliID" class="<?php echo $t09_hutang_add->LeftColumnClass ?>"><?php echo $t09_hutang->BeliID->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $t09_hutang_add->RightColumnClass ?>"><div<?php echo $t09_hutang->BeliID->CellAttributes() ?>>
<span id="el_t09_hutang_BeliID">
<?php
$wrkonchange = trim(" " . @$t09_hutang->BeliID->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$t09_hutang->BeliID->EditAttrs["onchange"] = "";
?>
<span id="as_x_BeliID" style="white-space: nowrap; z-index: 8970">
	<input type="text" name="sv_x_BeliID" id="sv_x_BeliID" value="<?php echo $t09_hutang->BeliID->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($t09_hutang->BeliID->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($t09_hutang->BeliID->getPlaceHolder()) ?>"<?php echo $t09_hutang->BeliID->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t09_hutang" data-field="x_BeliID" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t09_hutang->BeliID->DisplayValueSeparatorAttribute() ?>" name="x_BeliID" id="x_BeliID" value="<?php echo ew_HtmlEncode($t09_hutang->BeliID->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script type="text/javascript">
ft09_hutangadd.CreateAutoSuggest({"id":"x_BeliID","forceSelect":true});
</script>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t09_hutang->BeliID->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_BeliID',m:0,n:10,srch:false});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($t09_hutang->BeliID->ReadOnly || $t09_hutang->BeliID->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
</span>
<?php echo $t09_hutang->BeliID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t09_hutang->JumlahHutang->Visible) { // JumlahHutang ?>
	<div id="r_JumlahHutang" class="form-group">
		<label id="elh_t09_hutang_JumlahHutang" for="x_JumlahHutang" class="<?php echo $t09_hutang_add->LeftColumnClass ?>"><?php echo $t09_hutang->JumlahHutang->FldCaption() ?></label>
		<div class="<?php echo $t09_hutang_add->RightColumnClass ?>"><div<?php echo $t09_hutang->JumlahHutang->CellAttributes() ?>>
<span id="el_t09_hutang_JumlahHutang">
<input type="text" data-table="t09_hutang" data-field="x_JumlahHutang" name="x_JumlahHutang" id="x_JumlahHutang" size="30" placeholder="<?php echo ew_HtmlEncode($t09_hutang->JumlahHutang->getPlaceHolder()) ?>" value="<?php echo $t09_hutang->JumlahHutang->EditValue ?>"<?php echo $t09_hutang->JumlahHutang->EditAttributes() ?>>
</span>
<?php echo $t09_hutang->JumlahHutang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t09_hutang->JumlahBayar->Visible) { // JumlahBayar ?>
	<div id="r_JumlahBayar" class="form-group">
		<label id="elh_t09_hutang_JumlahBayar" for="x_JumlahBayar" class="<?php echo $t09_hutang_add->LeftColumnClass ?>"><?php echo $t09_hutang->JumlahBayar->FldCaption() ?></label>
		<div class="<?php echo $t09_hutang_add->RightColumnClass ?>"><div<?php echo $t09_hutang->JumlahBayar->CellAttributes() ?>>
<span id="el_t09_hutang_JumlahBayar">
<input type="text" data-table="t09_hutang" data-field="x_JumlahBayar" name="x_JumlahBayar" id="x_JumlahBayar" size="30" placeholder="<?php echo ew_HtmlEncode($t09_hutang->JumlahBayar->getPlaceHolder()) ?>" value="<?php echo $t09_hutang->JumlahBayar->EditValue ?>"<?php echo $t09_hutang->JumlahBayar->EditAttributes() ?>>
</span>
<?php echo $t09_hutang->JumlahBayar->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("t10_hutangdetail", explode(",", $t09_hutang->getCurrentDetailTable())) && $t10_hutangdetail->DetailAdd) {
?>
<?php if ($t09_hutang->getCurrentDetailTable() <> "") { ?>
<h4 class="ewDetailCaption"><?php echo $Language->TablePhrase("t10_hutangdetail", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "t10_hutangdetailgrid.php" ?>
<?php } ?>
<?php if (!$t09_hutang_add->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $t09_hutang_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $t09_hutang_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
ft09_hutangadd.Init();
</script>
<?php
$t09_hutang_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t09_hutang_add->Page_Terminate();
?>
