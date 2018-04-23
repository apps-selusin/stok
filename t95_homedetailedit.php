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

$t95_homedetail_edit = NULL; // Initialize page object first

class ct95_homedetail_edit extends ct95_homedetail {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = '{8746EF3F-81FE-4C1C-A7F8-AC191F8DDBB2}';

	// Table name
	var $TableName = 't95_homedetail';

	// Page object name
	var $PageObjName = 't95_homedetail_edit';

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
			define("EW_PAGE_ID", 'edit', TRUE);

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
		if (!$Security->CanEdit()) {
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
	var $FormClassName = "form-horizontal ewForm ewEditForm";
	var $IsModal = FALSE;
	var $IsMobileOrModal = FALSE;
	var $DbMasterFilter;
	var $DbDetailFilter;
	var $DisplayRecs = 1;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $Pager;
	var $AutoHidePager = EW_AUTO_HIDE_PAGER;
	var $RecCnt;
	var $Recordset;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $gbSkipHeaderFooter;

		// Check modal
		if ($this->IsModal)
			$gbSkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = ew_IsMobile() || $this->IsModal;
		$this->FormClassName = "ewForm ewEditForm form-horizontal";

		// Load record by position
		$loadByPosition = FALSE;
		$sReturnUrl = "";
		$loaded = FALSE;
		$postBack = FALSE;

		// Set up current action and primary key
		if (@$_POST["a_edit"] <> "") {
			$this->CurrentAction = $_POST["a_edit"]; // Get action code
			if ($this->CurrentAction <> "I") // Not reload record, handle as postback
				$postBack = TRUE;

			// Load key from Form
			if ($objForm->HasValue("x_home_id")) {
				$this->home_id->setFormValue($objForm->GetValue("x_home_id"));
			}
		} else {
			$this->CurrentAction = "I"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (isset($_GET["home_id"])) {
				$this->home_id->setQueryStringValue($_GET["home_id"]);
				$loadByQuery = TRUE;
			} else {
				$this->home_id->CurrentValue = NULL;
			}
			if (!$loadByQuery)
				$loadByPosition = TRUE;
		}

		// Load recordset
		$this->StartRec = 1; // Initialize start position
		if ($this->Recordset = $this->LoadRecordset()) // Load records
			$this->TotalRecs = $this->Recordset->RecordCount(); // Get record count
		if ($this->TotalRecs <= 0) { // No record found
			if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
			$this->Page_Terminate("t95_homedetaillist.php"); // Return to list page
		} elseif ($loadByPosition) { // Load record by position
			$this->SetupStartRec(); // Set up start record position

			// Point to current record
			if (intval($this->StartRec) <= intval($this->TotalRecs)) {
				$this->Recordset->Move($this->StartRec-1);
				$loaded = TRUE;
			}
		} else { // Match key values
			if (!is_null($this->home_id->CurrentValue)) {
				while (!$this->Recordset->EOF) {
					if (strval($this->home_id->CurrentValue) == strval($this->Recordset->fields('home_id'))) {
						$this->setStartRecordNumber($this->StartRec); // Save record position
						$loaded = TRUE;
						break;
					} else {
						$this->StartRec++;
						$this->Recordset->MoveNext();
					}
				}
			}
		}

		// Load current row values
		if ($loaded)
			$this->LoadRowValues($this->Recordset);

		// Process form if post back
		if ($postBack) {
			$this->LoadFormValues(); // Get form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->ValidateForm()) {
				$this->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "I": // Get a record to display
				if (!$loaded) {
					if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
						$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
					$this->Page_Terminate("t95_homedetaillist.php"); // Return to list page
				} else {
				}
				break;
			Case "U": // Update
				$sReturnUrl = $this->getReturnUrl();
				if (ew_GetPageName($sReturnUrl) == "t95_homedetaillist.php")
					$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} elseif ($this->getFailureMessage() == $Language->Phrase("NoRecord")) {
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Render the record
		$this->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetupStartRec() {
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$this->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$this->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $Language;

		// Get upload data
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
		if (!$this->home_id->FldIsDetailKey)
			$this->home_id->setFormValue($objForm->GetValue("x_home_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->home_id->CurrentValue = $this->home_id->FormValue;
		$this->tgl->CurrentValue = $this->tgl->FormValue;
		$this->tgl->CurrentValue = ew_UnFormatDateTime($this->tgl->CurrentValue, 7);
		$this->kat->CurrentValue = $this->kat->FormValue;
		$this->no_jdl->CurrentValue = $this->no_jdl->FormValue;
		$this->jdl->CurrentValue = $this->jdl->FormValue;
		$this->no_ket->CurrentValue = $this->no_ket->FormValue;
		$this->ket->CurrentValue = $this->ket->FormValue;
		$this->done->CurrentValue = $this->done->FormValue;
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
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

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

			// Edit refer script
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

	// Update record based on key values
	function EditRow() {
		global $Security, $Language;
		$sFilter = $this->KeyFilter();
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$conn = &$this->Connection();
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold = &$rs->fields;
			$this->LoadDbValues($rsold);
			$rsnew = array();

			// tgl
			$this->tgl->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->tgl->CurrentValue, 7), NULL, $this->tgl->ReadOnly);

			// kat
			$this->kat->SetDbValueDef($rsnew, $this->kat->CurrentValue, NULL, $this->kat->ReadOnly);

			// no_jdl
			$this->no_jdl->SetDbValueDef($rsnew, $this->no_jdl->CurrentValue, NULL, $this->no_jdl->ReadOnly);

			// jdl
			$this->jdl->SetDbValueDef($rsnew, $this->jdl->CurrentValue, NULL, $this->jdl->ReadOnly);

			// no_ket
			$this->no_ket->SetDbValueDef($rsnew, $this->no_ket->CurrentValue, NULL, $this->no_ket->ReadOnly);

			// ket
			$this->ket->SetDbValueDef($rsnew, $this->ket->CurrentValue, NULL, $this->ket->ReadOnly);

			// done
			$this->done->SetDbValueDef($rsnew, $this->done->CurrentValue, NULL, $this->done->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $this->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
				if (count($rsnew) > 0)
					$EditRow = $this->Update($rsnew, "", $rsold);
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
				if ($EditRow) {
				}
			} else {
				if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage <> "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("t95_homedetaillist.php"), "", $this->TableVar, TRUE);
		$PageId = "edit";
		$Breadcrumb->Add("edit", $PageId, $url);
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
if (!isset($t95_homedetail_edit)) $t95_homedetail_edit = new ct95_homedetail_edit();

// Page init
$t95_homedetail_edit->Page_Init();

// Page main
$t95_homedetail_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t95_homedetail_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = ft95_homedetailedit = new ew_Form("ft95_homedetailedit", "edit");

// Validate form
ft95_homedetailedit.Validate = function() {
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
ft95_homedetailedit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ft95_homedetailedit.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ft95_homedetailedit.Lists["x_kat"] = {"LinkField":"x_kode","Ajax":true,"AutoFill":false,"DisplayFields":["x_kode","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t94_home"};
ft95_homedetailedit.Lists["x_kat"].Data = "<?php echo $t95_homedetail_edit->kat->LookupFilterQuery(FALSE, "edit") ?>";
ft95_homedetailedit.Lists["x_done[]"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ft95_homedetailedit.Lists["x_done[]"].Options = <?php echo json_encode($t95_homedetail_edit->done->Options()) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $t95_homedetail_edit->ShowPageHeader(); ?>
<?php
$t95_homedetail_edit->ShowMessage();
?>
<?php if (!$t95_homedetail_edit->IsModal) { ?>
<form name="ewPagerForm" class="form-horizontal ewForm ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($t95_homedetail_edit->Pager)) $t95_homedetail_edit->Pager = new cPrevNextPager($t95_homedetail_edit->StartRec, $t95_homedetail_edit->DisplayRecs, $t95_homedetail_edit->TotalRecs, $t95_homedetail_edit->AutoHidePager) ?>
<?php if ($t95_homedetail_edit->Pager->RecordCount > 0 && $t95_homedetail_edit->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($t95_homedetail_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $t95_homedetail_edit->PageUrl() ?>start=<?php echo $t95_homedetail_edit->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($t95_homedetail_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $t95_homedetail_edit->PageUrl() ?>start=<?php echo $t95_homedetail_edit->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $t95_homedetail_edit->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($t95_homedetail_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $t95_homedetail_edit->PageUrl() ?>start=<?php echo $t95_homedetail_edit->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($t95_homedetail_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $t95_homedetail_edit->PageUrl() ?>start=<?php echo $t95_homedetail_edit->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $t95_homedetail_edit->Pager->PageCount ?></span>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="ft95_homedetailedit" id="ft95_homedetailedit" class="<?php echo $t95_homedetail_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t95_homedetail_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t95_homedetail_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t95_homedetail">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<input type="hidden" name="modal" value="<?php echo intval($t95_homedetail_edit->IsModal) ?>">
<div class="ewEditDiv"><!-- page* -->
<?php if ($t95_homedetail->tgl->Visible) { // tgl ?>
	<div id="r_tgl" class="form-group">
		<label id="elh_t95_homedetail_tgl" for="x_tgl" class="<?php echo $t95_homedetail_edit->LeftColumnClass ?>"><?php echo $t95_homedetail->tgl->FldCaption() ?></label>
		<div class="<?php echo $t95_homedetail_edit->RightColumnClass ?>"><div<?php echo $t95_homedetail->tgl->CellAttributes() ?>>
<span id="el_t95_homedetail_tgl">
<input type="text" data-table="t95_homedetail" data-field="x_tgl" data-format="7" name="x_tgl" id="x_tgl" size="7" placeholder="<?php echo ew_HtmlEncode($t95_homedetail->tgl->getPlaceHolder()) ?>" value="<?php echo $t95_homedetail->tgl->EditValue ?>"<?php echo $t95_homedetail->tgl->EditAttributes() ?>>
<?php if (!$t95_homedetail->tgl->ReadOnly && !$t95_homedetail->tgl->Disabled && !isset($t95_homedetail->tgl->EditAttrs["readonly"]) && !isset($t95_homedetail->tgl->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("ft95_homedetailedit", "x_tgl", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<?php echo $t95_homedetail->tgl->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t95_homedetail->kat->Visible) { // kat ?>
	<div id="r_kat" class="form-group">
		<label id="elh_t95_homedetail_kat" for="x_kat" class="<?php echo $t95_homedetail_edit->LeftColumnClass ?>"><?php echo $t95_homedetail->kat->FldCaption() ?></label>
		<div class="<?php echo $t95_homedetail_edit->RightColumnClass ?>"><div<?php echo $t95_homedetail->kat->CellAttributes() ?>>
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
		<label id="elh_t95_homedetail_no_jdl" for="x_no_jdl" class="<?php echo $t95_homedetail_edit->LeftColumnClass ?>"><?php echo $t95_homedetail->no_jdl->FldCaption() ?></label>
		<div class="<?php echo $t95_homedetail_edit->RightColumnClass ?>"><div<?php echo $t95_homedetail->no_jdl->CellAttributes() ?>>
<span id="el_t95_homedetail_no_jdl">
<input type="text" data-table="t95_homedetail" data-field="x_no_jdl" name="x_no_jdl" id="x_no_jdl" size="1" placeholder="<?php echo ew_HtmlEncode($t95_homedetail->no_jdl->getPlaceHolder()) ?>" value="<?php echo $t95_homedetail->no_jdl->EditValue ?>"<?php echo $t95_homedetail->no_jdl->EditAttributes() ?>>
</span>
<?php echo $t95_homedetail->no_jdl->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t95_homedetail->jdl->Visible) { // jdl ?>
	<div id="r_jdl" class="form-group">
		<label id="elh_t95_homedetail_jdl" for="x_jdl" class="<?php echo $t95_homedetail_edit->LeftColumnClass ?>"><?php echo $t95_homedetail->jdl->FldCaption() ?></label>
		<div class="<?php echo $t95_homedetail_edit->RightColumnClass ?>"><div<?php echo $t95_homedetail->jdl->CellAttributes() ?>>
<span id="el_t95_homedetail_jdl">
<input type="text" data-table="t95_homedetail" data-field="x_jdl" name="x_jdl" id="x_jdl" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t95_homedetail->jdl->getPlaceHolder()) ?>" value="<?php echo $t95_homedetail->jdl->EditValue ?>"<?php echo $t95_homedetail->jdl->EditAttributes() ?>>
</span>
<?php echo $t95_homedetail->jdl->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t95_homedetail->no_ket->Visible) { // no_ket ?>
	<div id="r_no_ket" class="form-group">
		<label id="elh_t95_homedetail_no_ket" for="x_no_ket" class="<?php echo $t95_homedetail_edit->LeftColumnClass ?>"><?php echo $t95_homedetail->no_ket->FldCaption() ?></label>
		<div class="<?php echo $t95_homedetail_edit->RightColumnClass ?>"><div<?php echo $t95_homedetail->no_ket->CellAttributes() ?>>
<span id="el_t95_homedetail_no_ket">
<input type="text" data-table="t95_homedetail" data-field="x_no_ket" name="x_no_ket" id="x_no_ket" size="1" placeholder="<?php echo ew_HtmlEncode($t95_homedetail->no_ket->getPlaceHolder()) ?>" value="<?php echo $t95_homedetail->no_ket->EditValue ?>"<?php echo $t95_homedetail->no_ket->EditAttributes() ?>>
</span>
<?php echo $t95_homedetail->no_ket->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t95_homedetail->ket->Visible) { // ket ?>
	<div id="r_ket" class="form-group">
		<label id="elh_t95_homedetail_ket" for="x_ket" class="<?php echo $t95_homedetail_edit->LeftColumnClass ?>"><?php echo $t95_homedetail->ket->FldCaption() ?></label>
		<div class="<?php echo $t95_homedetail_edit->RightColumnClass ?>"><div<?php echo $t95_homedetail->ket->CellAttributes() ?>>
<span id="el_t95_homedetail_ket">
<textarea data-table="t95_homedetail" data-field="x_ket" name="x_ket" id="x_ket" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($t95_homedetail->ket->getPlaceHolder()) ?>"<?php echo $t95_homedetail->ket->EditAttributes() ?>><?php echo $t95_homedetail->ket->EditValue ?></textarea>
</span>
<?php echo $t95_homedetail->ket->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t95_homedetail->done->Visible) { // done ?>
	<div id="r_done" class="form-group">
		<label id="elh_t95_homedetail_done" class="<?php echo $t95_homedetail_edit->LeftColumnClass ?>"><?php echo $t95_homedetail->done->FldCaption() ?></label>
		<div class="<?php echo $t95_homedetail_edit->RightColumnClass ?>"><div<?php echo $t95_homedetail->done->CellAttributes() ?>>
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
<input type="hidden" data-table="t95_homedetail" data-field="x_home_id" name="x_home_id" id="x_home_id" value="<?php echo ew_HtmlEncode($t95_homedetail->home_id->CurrentValue) ?>">
<?php if (!$t95_homedetail_edit->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $t95_homedetail_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $t95_homedetail_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$t95_homedetail_edit->IsModal) { ?>
<?php if (!isset($t95_homedetail_edit->Pager)) $t95_homedetail_edit->Pager = new cPrevNextPager($t95_homedetail_edit->StartRec, $t95_homedetail_edit->DisplayRecs, $t95_homedetail_edit->TotalRecs, $t95_homedetail_edit->AutoHidePager) ?>
<?php if ($t95_homedetail_edit->Pager->RecordCount > 0 && $t95_homedetail_edit->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($t95_homedetail_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $t95_homedetail_edit->PageUrl() ?>start=<?php echo $t95_homedetail_edit->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($t95_homedetail_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $t95_homedetail_edit->PageUrl() ?>start=<?php echo $t95_homedetail_edit->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $t95_homedetail_edit->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($t95_homedetail_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $t95_homedetail_edit->PageUrl() ?>start=<?php echo $t95_homedetail_edit->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($t95_homedetail_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $t95_homedetail_edit->PageUrl() ?>start=<?php echo $t95_homedetail_edit->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $t95_homedetail_edit->Pager->PageCount ?></span>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<script type="text/javascript">
ft95_homedetailedit.Init();
</script>
<?php
$t95_homedetail_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t95_homedetail_edit->Page_Terminate();
?>
