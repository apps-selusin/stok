<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "t11_jualinfo.php" ?>
<?php include_once "t96_employeesinfo.php" ?>
<?php include_once "t12_jualdetailgridcls.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$t11_jual_edit = NULL; // Initialize page object first

class ct11_jual_edit extends ct11_jual {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = '{8746EF3F-81FE-4C1C-A7F8-AC191F8DDBB2}';

	// Table name
	var $TableName = 't11_jual';

	// Page object name
	var $PageObjName = 't11_jual_edit';

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

		// Table object (t11_jual)
		if (!isset($GLOBALS["t11_jual"]) || get_class($GLOBALS["t11_jual"]) == "ct11_jual") {
			$GLOBALS["t11_jual"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t11_jual"];
		}

		// Table object (t96_employees)
		if (!isset($GLOBALS['t96_employees'])) $GLOBALS['t96_employees'] = new ct96_employees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 't11_jual', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("t11_juallist.php"));
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
		$this->TglSO->SetVisibility();
		$this->NoSO->SetVisibility();
		$this->CustomerID->SetVisibility();
		$this->CustomerPO->SetVisibility();
		$this->Total->SetVisibility();

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
				if (in_array("t12_jualdetail", $DetailTblVar)) {

					// Process auto fill for detail table 't12_jualdetail'
					if (preg_match('/^ft12_jualdetail(grid|add|addopt|edit|update|search)$/', @$_POST["form"])) {
						if (!isset($GLOBALS["t12_jualdetail_grid"])) $GLOBALS["t12_jualdetail_grid"] = new ct12_jualdetail_grid;
						$GLOBALS["t12_jualdetail_grid"]->Page_Init();
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
		global $EW_EXPORT, $t11_jual;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($t11_jual);
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
					if ($pageName == "t11_jualview.php")
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
			if ($objForm->HasValue("x_id")) {
				$this->id->setFormValue($objForm->GetValue("x_id"));
			}
		} else {
			$this->CurrentAction = "I"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (isset($_GET["id"])) {
				$this->id->setQueryStringValue($_GET["id"]);
				$loadByQuery = TRUE;
			} else {
				$this->id->CurrentValue = NULL;
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
			$this->Page_Terminate("t11_juallist.php"); // Return to list page
		} elseif ($loadByPosition) { // Load record by position
			$this->SetupStartRec(); // Set up start record position

			// Point to current record
			if (intval($this->StartRec) <= intval($this->TotalRecs)) {
				$this->Recordset->Move($this->StartRec-1);
				$loaded = TRUE;
			}
		} else { // Match key values
			if (!is_null($this->id->CurrentValue)) {
				while (!$this->Recordset->EOF) {
					if (strval($this->id->CurrentValue) == strval($this->Recordset->fields('id'))) {
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

			// Set up detail parameters
			$this->SetupDetailParms();
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
					$this->Page_Terminate("t11_juallist.php"); // Return to list page
				} else {
				}

				// Set up detail parameters
				$this->SetupDetailParms();
				break;
			Case "U": // Update
				if ($this->getCurrentDetailTable() <> "") // Master/detail edit
					$sReturnUrl = $this->GetViewUrl(EW_TABLE_SHOW_DETAIL . "=" . $this->getCurrentDetailTable()); // Master/Detail view page
				else
					$sReturnUrl = $this->getReturnUrl();
				if (ew_GetPageName($sReturnUrl) == "t11_juallist.php")
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

					// Set up detail parameters
					$this->SetupDetailParms();
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
		if (!$this->TglSO->FldIsDetailKey) {
			$this->TglSO->setFormValue($objForm->GetValue("x_TglSO"));
			$this->TglSO->CurrentValue = ew_UnFormatDateTime($this->TglSO->CurrentValue, 7);
		}
		if (!$this->NoSO->FldIsDetailKey) {
			$this->NoSO->setFormValue($objForm->GetValue("x_NoSO"));
		}
		if (!$this->CustomerID->FldIsDetailKey) {
			$this->CustomerID->setFormValue($objForm->GetValue("x_CustomerID"));
		}
		if (!$this->CustomerPO->FldIsDetailKey) {
			$this->CustomerPO->setFormValue($objForm->GetValue("x_CustomerPO"));
		}
		if (!$this->Total->FldIsDetailKey) {
			$this->Total->setFormValue($objForm->GetValue("x_Total"));
		}
		if (!$this->id->FldIsDetailKey)
			$this->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->id->CurrentValue = $this->id->FormValue;
		$this->TglSO->CurrentValue = $this->TglSO->FormValue;
		$this->TglSO->CurrentValue = ew_UnFormatDateTime($this->TglSO->CurrentValue, 7);
		$this->NoSO->CurrentValue = $this->NoSO->FormValue;
		$this->CustomerID->CurrentValue = $this->CustomerID->FormValue;
		$this->CustomerPO->CurrentValue = $this->CustomerPO->FormValue;
		$this->Total->CurrentValue = $this->Total->FormValue;
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
		$this->TglSO->setDbValue($row['TglSO']);
		$this->NoSO->setDbValue($row['NoSO']);
		$this->CustomerID->setDbValue($row['CustomerID']);
		if (array_key_exists('EV__CustomerID', $rs->fields)) {
			$this->CustomerID->VirtualValue = $rs->fields('EV__CustomerID'); // Set up virtual field value
		} else {
			$this->CustomerID->VirtualValue = ""; // Clear value
		}
		$this->CustomerPO->setDbValue($row['CustomerPO']);
		$this->Total->setDbValue($row['Total']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['id'] = NULL;
		$row['TglSO'] = NULL;
		$row['NoSO'] = NULL;
		$row['CustomerID'] = NULL;
		$row['CustomerPO'] = NULL;
		$row['Total'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->TglSO->DbValue = $row['TglSO'];
		$this->NoSO->DbValue = $row['NoSO'];
		$this->CustomerID->DbValue = $row['CustomerID'];
		$this->CustomerPO->DbValue = $row['CustomerPO'];
		$this->Total->DbValue = $row['Total'];
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

		if ($this->Total->FormValue == $this->Total->CurrentValue && is_numeric(ew_StrToFloat($this->Total->CurrentValue)))
			$this->Total->CurrentValue = ew_StrToFloat($this->Total->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// TglSO
		// NoSO
		// CustomerID
		// CustomerPO
		// Total

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// TglSO
		$this->TglSO->ViewValue = $this->TglSO->CurrentValue;
		$this->TglSO->ViewValue = ew_FormatDateTime($this->TglSO->ViewValue, 7);
		$this->TglSO->ViewCustomAttributes = "";

		// NoSO
		$this->NoSO->ViewValue = $this->NoSO->CurrentValue;
		$this->NoSO->ViewCustomAttributes = "";

		// CustomerID
		if ($this->CustomerID->VirtualValue <> "") {
			$this->CustomerID->ViewValue = $this->CustomerID->VirtualValue;
		} else {
		if (strval($this->CustomerID->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->CustomerID->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `Nama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t03_customer`";
		$sWhereWrk = "";
		$this->CustomerID->LookupFilters = array("dx1" => '`Nama`');
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->CustomerID, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->CustomerID->ViewValue = $this->CustomerID->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->CustomerID->ViewValue = $this->CustomerID->CurrentValue;
			}
		} else {
			$this->CustomerID->ViewValue = NULL;
		}
		}
		$this->CustomerID->ViewCustomAttributes = "";

		// CustomerPO
		$this->CustomerPO->ViewValue = $this->CustomerPO->CurrentValue;
		$this->CustomerPO->ViewCustomAttributes = "";

		// Total
		$this->Total->ViewValue = $this->Total->CurrentValue;
		$this->Total->ViewValue = ew_FormatNumber($this->Total->ViewValue, 2, -2, -2, -2);
		$this->Total->CellCssStyle .= "text-align: left;";
		$this->Total->ViewCustomAttributes = "";

			// TglSO
			$this->TglSO->LinkCustomAttributes = "";
			$this->TglSO->HrefValue = "";
			$this->TglSO->TooltipValue = "";

			// NoSO
			$this->NoSO->LinkCustomAttributes = "";
			$this->NoSO->HrefValue = "";
			$this->NoSO->TooltipValue = "";

			// CustomerID
			$this->CustomerID->LinkCustomAttributes = "";
			$this->CustomerID->HrefValue = "";
			$this->CustomerID->TooltipValue = "";

			// CustomerPO
			$this->CustomerPO->LinkCustomAttributes = "";
			$this->CustomerPO->HrefValue = "";
			$this->CustomerPO->TooltipValue = "";

			// Total
			$this->Total->LinkCustomAttributes = "";
			$this->Total->HrefValue = "";
			$this->Total->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// TglSO
			$this->TglSO->EditAttrs["class"] = "form-control";
			$this->TglSO->EditCustomAttributes = "";
			$this->TglSO->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->TglSO->CurrentValue, 7));
			$this->TglSO->PlaceHolder = ew_RemoveHtml($this->TglSO->FldCaption());

			// NoSO
			$this->NoSO->EditAttrs["class"] = "form-control";
			$this->NoSO->EditCustomAttributes = "";
			$this->NoSO->EditValue = ew_HtmlEncode($this->NoSO->CurrentValue);
			$this->NoSO->PlaceHolder = ew_RemoveHtml($this->NoSO->FldCaption());

			// CustomerID
			$this->CustomerID->EditCustomAttributes = "";
			if (trim(strval($this->CustomerID->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->CustomerID->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `id`, `Nama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `t03_customer`";
			$sWhereWrk = "";
			$this->CustomerID->LookupFilters = array("dx1" => '`Nama`');
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->CustomerID, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
				$this->CustomerID->ViewValue = $this->CustomerID->DisplayValue($arwrk);
			} else {
				$this->CustomerID->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->CustomerID->EditValue = $arwrk;

			// CustomerPO
			$this->CustomerPO->EditAttrs["class"] = "form-control";
			$this->CustomerPO->EditCustomAttributes = "";
			$this->CustomerPO->EditValue = ew_HtmlEncode($this->CustomerPO->CurrentValue);
			$this->CustomerPO->PlaceHolder = ew_RemoveHtml($this->CustomerPO->FldCaption());

			// Total
			$this->Total->EditAttrs["class"] = "form-control";
			$this->Total->EditCustomAttributes = "";
			$this->Total->EditValue = ew_HtmlEncode($this->Total->CurrentValue);
			$this->Total->PlaceHolder = ew_RemoveHtml($this->Total->FldCaption());
			if (strval($this->Total->EditValue) <> "" && is_numeric($this->Total->EditValue)) $this->Total->EditValue = ew_FormatNumber($this->Total->EditValue, -2, -2, -2, -2);

			// Edit refer script
			// TglSO

			$this->TglSO->LinkCustomAttributes = "";
			$this->TglSO->HrefValue = "";

			// NoSO
			$this->NoSO->LinkCustomAttributes = "";
			$this->NoSO->HrefValue = "";

			// CustomerID
			$this->CustomerID->LinkCustomAttributes = "";
			$this->CustomerID->HrefValue = "";

			// CustomerPO
			$this->CustomerPO->LinkCustomAttributes = "";
			$this->CustomerPO->HrefValue = "";

			// Total
			$this->Total->LinkCustomAttributes = "";
			$this->Total->HrefValue = "";
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
		if (!$this->TglSO->FldIsDetailKey && !is_null($this->TglSO->FormValue) && $this->TglSO->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->TglSO->FldCaption(), $this->TglSO->ReqErrMsg));
		}
		if (!ew_CheckEuroDate($this->TglSO->FormValue)) {
			ew_AddMessage($gsFormError, $this->TglSO->FldErrMsg());
		}
		if (!$this->NoSO->FldIsDetailKey && !is_null($this->NoSO->FormValue) && $this->NoSO->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->NoSO->FldCaption(), $this->NoSO->ReqErrMsg));
		}
		if (!$this->CustomerID->FldIsDetailKey && !is_null($this->CustomerID->FormValue) && $this->CustomerID->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->CustomerID->FldCaption(), $this->CustomerID->ReqErrMsg));
		}
		if (!$this->CustomerPO->FldIsDetailKey && !is_null($this->CustomerPO->FormValue) && $this->CustomerPO->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->CustomerPO->FldCaption(), $this->CustomerPO->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->Total->FormValue)) {
			ew_AddMessage($gsFormError, $this->Total->FldErrMsg());
		}

		// Validate detail grid
		$DetailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("t12_jualdetail", $DetailTblVar) && $GLOBALS["t12_jualdetail"]->DetailEdit) {
			if (!isset($GLOBALS["t12_jualdetail_grid"])) $GLOBALS["t12_jualdetail_grid"] = new ct12_jualdetail_grid(); // get detail page object
			$GLOBALS["t12_jualdetail_grid"]->ValidateGridForm();
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

			// Begin transaction
			if ($this->getCurrentDetailTable() <> "")
				$conn->BeginTrans();

			// Save old values
			$rsold = &$rs->fields;
			$this->LoadDbValues($rsold);
			$rsnew = array();

			// TglSO
			$this->TglSO->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->TglSO->CurrentValue, 7), ew_CurrentDate(), $this->TglSO->ReadOnly);

			// NoSO
			$this->NoSO->SetDbValueDef($rsnew, $this->NoSO->CurrentValue, "", $this->NoSO->ReadOnly);

			// CustomerID
			$this->CustomerID->SetDbValueDef($rsnew, $this->CustomerID->CurrentValue, 0, $this->CustomerID->ReadOnly);

			// CustomerPO
			$this->CustomerPO->SetDbValueDef($rsnew, $this->CustomerPO->CurrentValue, "", $this->CustomerPO->ReadOnly);

			// Total
			$this->Total->SetDbValueDef($rsnew, $this->Total->CurrentValue, 0, $this->Total->ReadOnly);

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

				// Update detail records
				$DetailTblVar = explode(",", $this->getCurrentDetailTable());
				if ($EditRow) {
					if (in_array("t12_jualdetail", $DetailTblVar) && $GLOBALS["t12_jualdetail"]->DetailEdit) {
						if (!isset($GLOBALS["t12_jualdetail_grid"])) $GLOBALS["t12_jualdetail_grid"] = new ct12_jualdetail_grid(); // Get detail page object
						$Security->LoadCurrentUserLevel($this->ProjectID . "t12_jualdetail"); // Load user level of detail table
						$EditRow = $GLOBALS["t12_jualdetail_grid"]->GridUpdate();
						$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}

				// Commit/Rollback transaction
				if ($this->getCurrentDetailTable() <> "") {
					if ($EditRow) {
						$conn->CommitTrans(); // Commit transaction
					} else {
						$conn->RollbackTrans(); // Rollback transaction
					}
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
			if (in_array("t12_jualdetail", $DetailTblVar)) {
				if (!isset($GLOBALS["t12_jualdetail_grid"]))
					$GLOBALS["t12_jualdetail_grid"] = new ct12_jualdetail_grid;
				if ($GLOBALS["t12_jualdetail_grid"]->DetailEdit) {
					$GLOBALS["t12_jualdetail_grid"]->CurrentMode = "edit";
					$GLOBALS["t12_jualdetail_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["t12_jualdetail_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["t12_jualdetail_grid"]->setStartRecordNumber(1);
					$GLOBALS["t12_jualdetail_grid"]->JualID->FldIsDetailKey = TRUE;
					$GLOBALS["t12_jualdetail_grid"]->JualID->CurrentValue = $this->id->CurrentValue;
					$GLOBALS["t12_jualdetail_grid"]->JualID->setSessionValue($GLOBALS["t12_jualdetail_grid"]->JualID->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("t11_juallist.php"), "", $this->TableVar, TRUE);
		$PageId = "edit";
		$Breadcrumb->Add("edit", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_CustomerID":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `Nama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t03_customer`";
			$sWhereWrk = "{filter}";
			$fld->LookupFilters = array("dx1" => '`Nama`');
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->CustomerID, $sWhereWrk); // Call Lookup Selecting
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
if (!isset($t11_jual_edit)) $t11_jual_edit = new ct11_jual_edit();

// Page init
$t11_jual_edit->Page_Init();

// Page main
$t11_jual_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t11_jual_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = ft11_jualedit = new ew_Form("ft11_jualedit", "edit");

// Validate form
ft11_jualedit.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_TglSO");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t11_jual->TglSO->FldCaption(), $t11_jual->TglSO->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_TglSO");
			if (elm && !ew_CheckEuroDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t11_jual->TglSO->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_NoSO");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t11_jual->NoSO->FldCaption(), $t11_jual->NoSO->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_CustomerID");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t11_jual->CustomerID->FldCaption(), $t11_jual->CustomerID->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_CustomerPO");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t11_jual->CustomerPO->FldCaption(), $t11_jual->CustomerPO->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Total");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t11_jual->Total->FldErrMsg()) ?>");

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
ft11_jualedit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ft11_jualedit.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ft11_jualedit.Lists["x_CustomerID"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nama","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t03_customer"};
ft11_jualedit.Lists["x_CustomerID"].Data = "<?php echo $t11_jual_edit->CustomerID->LookupFilterQuery(FALSE, "edit") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $t11_jual_edit->ShowPageHeader(); ?>
<?php
$t11_jual_edit->ShowMessage();
?>
<?php if (!$t11_jual_edit->IsModal) { ?>
<form name="ewPagerForm" class="form-horizontal ewForm ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($t11_jual_edit->Pager)) $t11_jual_edit->Pager = new cPrevNextPager($t11_jual_edit->StartRec, $t11_jual_edit->DisplayRecs, $t11_jual_edit->TotalRecs, $t11_jual_edit->AutoHidePager) ?>
<?php if ($t11_jual_edit->Pager->RecordCount > 0 && $t11_jual_edit->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($t11_jual_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $t11_jual_edit->PageUrl() ?>start=<?php echo $t11_jual_edit->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($t11_jual_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $t11_jual_edit->PageUrl() ?>start=<?php echo $t11_jual_edit->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $t11_jual_edit->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($t11_jual_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $t11_jual_edit->PageUrl() ?>start=<?php echo $t11_jual_edit->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($t11_jual_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $t11_jual_edit->PageUrl() ?>start=<?php echo $t11_jual_edit->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $t11_jual_edit->Pager->PageCount ?></span>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="ft11_jualedit" id="ft11_jualedit" class="<?php echo $t11_jual_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t11_jual_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t11_jual_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t11_jual">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<input type="hidden" name="modal" value="<?php echo intval($t11_jual_edit->IsModal) ?>">
<div class="ewEditDiv"><!-- page* -->
<?php if ($t11_jual->TglSO->Visible) { // TglSO ?>
	<div id="r_TglSO" class="form-group">
		<label id="elh_t11_jual_TglSO" for="x_TglSO" class="<?php echo $t11_jual_edit->LeftColumnClass ?>"><?php echo $t11_jual->TglSO->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $t11_jual_edit->RightColumnClass ?>"><div<?php echo $t11_jual->TglSO->CellAttributes() ?>>
<span id="el_t11_jual_TglSO">
<input type="text" data-table="t11_jual" data-field="x_TglSO" data-format="7" name="x_TglSO" id="x_TglSO" placeholder="<?php echo ew_HtmlEncode($t11_jual->TglSO->getPlaceHolder()) ?>" value="<?php echo $t11_jual->TglSO->EditValue ?>"<?php echo $t11_jual->TglSO->EditAttributes() ?>>
<?php if (!$t11_jual->TglSO->ReadOnly && !$t11_jual->TglSO->Disabled && !isset($t11_jual->TglSO->EditAttrs["readonly"]) && !isset($t11_jual->TglSO->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("ft11_jualedit", "x_TglSO", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<?php echo $t11_jual->TglSO->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t11_jual->NoSO->Visible) { // NoSO ?>
	<div id="r_NoSO" class="form-group">
		<label id="elh_t11_jual_NoSO" for="x_NoSO" class="<?php echo $t11_jual_edit->LeftColumnClass ?>"><?php echo $t11_jual->NoSO->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $t11_jual_edit->RightColumnClass ?>"><div<?php echo $t11_jual->NoSO->CellAttributes() ?>>
<span id="el_t11_jual_NoSO">
<input type="text" data-table="t11_jual" data-field="x_NoSO" name="x_NoSO" id="x_NoSO" size="30" maxlength="14" placeholder="<?php echo ew_HtmlEncode($t11_jual->NoSO->getPlaceHolder()) ?>" value="<?php echo $t11_jual->NoSO->EditValue ?>"<?php echo $t11_jual->NoSO->EditAttributes() ?>>
</span>
<?php echo $t11_jual->NoSO->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t11_jual->CustomerID->Visible) { // CustomerID ?>
	<div id="r_CustomerID" class="form-group">
		<label id="elh_t11_jual_CustomerID" for="x_CustomerID" class="<?php echo $t11_jual_edit->LeftColumnClass ?>"><?php echo $t11_jual->CustomerID->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $t11_jual_edit->RightColumnClass ?>"><div<?php echo $t11_jual->CustomerID->CellAttributes() ?>>
<span id="el_t11_jual_CustomerID">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_CustomerID"><?php echo (strval($t11_jual->CustomerID->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t11_jual->CustomerID->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t11_jual->CustomerID->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_CustomerID',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($t11_jual->CustomerID->ReadOnly || $t11_jual->CustomerID->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t11_jual" data-field="x_CustomerID" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t11_jual->CustomerID->DisplayValueSeparatorAttribute() ?>" name="x_CustomerID" id="x_CustomerID" value="<?php echo $t11_jual->CustomerID->CurrentValue ?>"<?php echo $t11_jual->CustomerID->EditAttributes() ?>>
</span>
<?php echo $t11_jual->CustomerID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t11_jual->CustomerPO->Visible) { // CustomerPO ?>
	<div id="r_CustomerPO" class="form-group">
		<label id="elh_t11_jual_CustomerPO" for="x_CustomerPO" class="<?php echo $t11_jual_edit->LeftColumnClass ?>"><?php echo $t11_jual->CustomerPO->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $t11_jual_edit->RightColumnClass ?>"><div<?php echo $t11_jual->CustomerPO->CellAttributes() ?>>
<span id="el_t11_jual_CustomerPO">
<input type="text" data-table="t11_jual" data-field="x_CustomerPO" name="x_CustomerPO" id="x_CustomerPO" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($t11_jual->CustomerPO->getPlaceHolder()) ?>" value="<?php echo $t11_jual->CustomerPO->EditValue ?>"<?php echo $t11_jual->CustomerPO->EditAttributes() ?>>
</span>
<?php echo $t11_jual->CustomerPO->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t11_jual->Total->Visible) { // Total ?>
	<div id="r_Total" class="form-group">
		<label id="elh_t11_jual_Total" for="x_Total" class="<?php echo $t11_jual_edit->LeftColumnClass ?>"><?php echo $t11_jual->Total->FldCaption() ?></label>
		<div class="<?php echo $t11_jual_edit->RightColumnClass ?>"><div<?php echo $t11_jual->Total->CellAttributes() ?>>
<span id="el_t11_jual_Total">
<input type="text" data-table="t11_jual" data-field="x_Total" name="x_Total" id="x_Total" size="30" placeholder="<?php echo ew_HtmlEncode($t11_jual->Total->getPlaceHolder()) ?>" value="<?php echo $t11_jual->Total->EditValue ?>"<?php echo $t11_jual->Total->EditAttributes() ?>>
</span>
<?php echo $t11_jual->Total->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<input type="hidden" data-table="t11_jual" data-field="x_id" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($t11_jual->id->CurrentValue) ?>">
<?php
	if (in_array("t12_jualdetail", explode(",", $t11_jual->getCurrentDetailTable())) && $t12_jualdetail->DetailEdit) {
?>
<?php if ($t11_jual->getCurrentDetailTable() <> "") { ?>
<h4 class="ewDetailCaption"><?php echo $Language->TablePhrase("t12_jualdetail", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "t12_jualdetailgrid.php" ?>
<?php } ?>
<?php if (!$t11_jual_edit->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $t11_jual_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $t11_jual_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$t11_jual_edit->IsModal) { ?>
<?php if (!isset($t11_jual_edit->Pager)) $t11_jual_edit->Pager = new cPrevNextPager($t11_jual_edit->StartRec, $t11_jual_edit->DisplayRecs, $t11_jual_edit->TotalRecs, $t11_jual_edit->AutoHidePager) ?>
<?php if ($t11_jual_edit->Pager->RecordCount > 0 && $t11_jual_edit->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($t11_jual_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $t11_jual_edit->PageUrl() ?>start=<?php echo $t11_jual_edit->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($t11_jual_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $t11_jual_edit->PageUrl() ?>start=<?php echo $t11_jual_edit->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $t11_jual_edit->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($t11_jual_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $t11_jual_edit->PageUrl() ?>start=<?php echo $t11_jual_edit->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($t11_jual_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $t11_jual_edit->PageUrl() ?>start=<?php echo $t11_jual_edit->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $t11_jual_edit->Pager->PageCount ?></span>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<script type="text/javascript">
ft11_jualedit.Init();
</script>
<?php
$t11_jual_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t11_jual_edit->Page_Terminate();
?>
