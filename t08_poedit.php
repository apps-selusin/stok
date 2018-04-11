<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "t08_poinfo.php" ?>
<?php include_once "t96_employeesinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$t08_po_edit = NULL; // Initialize page object first

class ct08_po_edit extends ct08_po {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = '{8746EF3F-81FE-4C1C-A7F8-AC191F8DDBB2}';

	// Table name
	var $TableName = 't08_po';

	// Page object name
	var $PageObjName = 't08_po_edit';

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

		// Table object (t08_po)
		if (!isset($GLOBALS["t08_po"]) || get_class($GLOBALS["t08_po"]) == "ct08_po") {
			$GLOBALS["t08_po"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t08_po"];
		}

		// Table object (t96_employees)
		if (!isset($GLOBALS['t96_employees'])) $GLOBALS['t96_employees'] = new ct96_employees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 't08_po', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("t08_polist.php"));
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
		$this->NoPO->SetVisibility();
		$this->TglPO->SetVisibility();
		$this->VendorID->SetVisibility();
		$this->ArticleID->SetVisibility();
		$this->Harga->SetVisibility();
		$this->Qty->SetVisibility();
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
		global $EW_EXPORT, $t08_po;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($t08_po);
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
					if ($pageName == "t08_poview.php")
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
			$this->Page_Terminate("t08_polist.php"); // Return to list page
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
					$this->Page_Terminate("t08_polist.php"); // Return to list page
				} else {
				}
				break;
			Case "U": // Update
				$sReturnUrl = $this->getReturnUrl();
				if (ew_GetPageName($sReturnUrl) == "t08_polist.php")
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
		if (!$this->NoPO->FldIsDetailKey) {
			$this->NoPO->setFormValue($objForm->GetValue("x_NoPO"));
		}
		if (!$this->TglPO->FldIsDetailKey) {
			$this->TglPO->setFormValue($objForm->GetValue("x_TglPO"));
			$this->TglPO->CurrentValue = ew_UnFormatDateTime($this->TglPO->CurrentValue, 7);
		}
		if (!$this->VendorID->FldIsDetailKey) {
			$this->VendorID->setFormValue($objForm->GetValue("x_VendorID"));
		}
		if (!$this->ArticleID->FldIsDetailKey) {
			$this->ArticleID->setFormValue($objForm->GetValue("x_ArticleID"));
		}
		if (!$this->Harga->FldIsDetailKey) {
			$this->Harga->setFormValue($objForm->GetValue("x_Harga"));
		}
		if (!$this->Qty->FldIsDetailKey) {
			$this->Qty->setFormValue($objForm->GetValue("x_Qty"));
		}
		if (!$this->SatuanID->FldIsDetailKey) {
			$this->SatuanID->setFormValue($objForm->GetValue("x_SatuanID"));
		}
		if (!$this->id->FldIsDetailKey)
			$this->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->id->CurrentValue = $this->id->FormValue;
		$this->NoPO->CurrentValue = $this->NoPO->FormValue;
		$this->TglPO->CurrentValue = $this->TglPO->FormValue;
		$this->TglPO->CurrentValue = ew_UnFormatDateTime($this->TglPO->CurrentValue, 7);
		$this->VendorID->CurrentValue = $this->VendorID->FormValue;
		$this->ArticleID->CurrentValue = $this->ArticleID->FormValue;
		$this->Harga->CurrentValue = $this->Harga->FormValue;
		$this->Qty->CurrentValue = $this->Qty->FormValue;
		$this->SatuanID->CurrentValue = $this->SatuanID->FormValue;
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
		$this->NoPO->setDbValue($row['NoPO']);
		$this->TglPO->setDbValue($row['TglPO']);
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
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['id'] = NULL;
		$row['NoPO'] = NULL;
		$row['TglPO'] = NULL;
		$row['VendorID'] = NULL;
		$row['ArticleID'] = NULL;
		$row['Harga'] = NULL;
		$row['Qty'] = NULL;
		$row['SatuanID'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->NoPO->DbValue = $row['NoPO'];
		$this->TglPO->DbValue = $row['TglPO'];
		$this->VendorID->DbValue = $row['VendorID'];
		$this->ArticleID->DbValue = $row['ArticleID'];
		$this->Harga->DbValue = $row['Harga'];
		$this->Qty->DbValue = $row['Qty'];
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
		// Convert decimal values if posted back

		if ($this->Harga->FormValue == $this->Harga->CurrentValue && is_numeric(ew_StrToFloat($this->Harga->CurrentValue)))
			$this->Harga->CurrentValue = ew_StrToFloat($this->Harga->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// NoPO
		// TglPO
		// VendorID
		// ArticleID
		// Harga
		// Qty
		// SatuanID

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// NoPO
		$this->NoPO->ViewValue = $this->NoPO->CurrentValue;
		$this->NoPO->ViewCustomAttributes = "";

		// TglPO
		$this->TglPO->ViewValue = $this->TglPO->CurrentValue;
		$this->TglPO->ViewValue = ew_FormatDateTime($this->TglPO->ViewValue, 7);
		$this->TglPO->ViewCustomAttributes = "";

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

			// NoPO
			$this->NoPO->LinkCustomAttributes = "";
			$this->NoPO->HrefValue = "";
			$this->NoPO->TooltipValue = "";

			// TglPO
			$this->TglPO->LinkCustomAttributes = "";
			$this->TglPO->HrefValue = "";
			$this->TglPO->TooltipValue = "";

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
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// NoPO
			$this->NoPO->EditAttrs["class"] = "form-control";
			$this->NoPO->EditCustomAttributes = "";
			$this->NoPO->EditValue = ew_HtmlEncode($this->NoPO->CurrentValue);
			$this->NoPO->PlaceHolder = ew_RemoveHtml($this->NoPO->FldCaption());

			// TglPO
			$this->TglPO->EditAttrs["class"] = "form-control";
			$this->TglPO->EditCustomAttributes = "";
			$this->TglPO->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->TglPO->CurrentValue, 7));
			$this->TglPO->PlaceHolder = ew_RemoveHtml($this->TglPO->FldCaption());

			// VendorID
			$this->VendorID->EditCustomAttributes = "";
			if (trim(strval($this->VendorID->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->VendorID->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `id`, `Nama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `t02_vendor`";
			$sWhereWrk = "";
			$this->VendorID->LookupFilters = array("dx1" => '`Nama`');
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->VendorID, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
				$this->VendorID->ViewValue = $this->VendorID->DisplayValue($arwrk);
			} else {
				$this->VendorID->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->VendorID->EditValue = $arwrk;

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

			// Harga
			$this->Harga->EditAttrs["class"] = "form-control";
			$this->Harga->EditCustomAttributes = "";
			$this->Harga->EditValue = ew_HtmlEncode($this->Harga->CurrentValue);
			$this->Harga->PlaceHolder = ew_RemoveHtml($this->Harga->FldCaption());
			if (strval($this->Harga->EditValue) <> "" && is_numeric($this->Harga->EditValue)) $this->Harga->EditValue = ew_FormatNumber($this->Harga->EditValue, -2, -2, -2, -2);

			// Qty
			$this->Qty->EditAttrs["class"] = "form-control";
			$this->Qty->EditCustomAttributes = "";
			$this->Qty->EditValue = ew_HtmlEncode($this->Qty->CurrentValue);
			$this->Qty->PlaceHolder = ew_RemoveHtml($this->Qty->FldCaption());

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

			// Edit refer script
			// NoPO

			$this->NoPO->LinkCustomAttributes = "";
			$this->NoPO->HrefValue = "";

			// TglPO
			$this->TglPO->LinkCustomAttributes = "";
			$this->TglPO->HrefValue = "";

			// VendorID
			$this->VendorID->LinkCustomAttributes = "";
			$this->VendorID->HrefValue = "";

			// ArticleID
			$this->ArticleID->LinkCustomAttributes = "";
			$this->ArticleID->HrefValue = "";

			// Harga
			$this->Harga->LinkCustomAttributes = "";
			$this->Harga->HrefValue = "";

			// Qty
			$this->Qty->LinkCustomAttributes = "";
			$this->Qty->HrefValue = "";

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
		if (!$this->NoPO->FldIsDetailKey && !is_null($this->NoPO->FormValue) && $this->NoPO->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->NoPO->FldCaption(), $this->NoPO->ReqErrMsg));
		}
		if (!$this->TglPO->FldIsDetailKey && !is_null($this->TglPO->FormValue) && $this->TglPO->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->TglPO->FldCaption(), $this->TglPO->ReqErrMsg));
		}
		if (!ew_CheckEuroDate($this->TglPO->FormValue)) {
			ew_AddMessage($gsFormError, $this->TglPO->FldErrMsg());
		}
		if (!$this->VendorID->FldIsDetailKey && !is_null($this->VendorID->FormValue) && $this->VendorID->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->VendorID->FldCaption(), $this->VendorID->ReqErrMsg));
		}
		if (!$this->ArticleID->FldIsDetailKey && !is_null($this->ArticleID->FormValue) && $this->ArticleID->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->ArticleID->FldCaption(), $this->ArticleID->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->Harga->FormValue)) {
			ew_AddMessage($gsFormError, $this->Harga->FldErrMsg());
		}
		if (!ew_CheckInteger($this->Qty->FormValue)) {
			ew_AddMessage($gsFormError, $this->Qty->FldErrMsg());
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

			// NoPO
			$this->NoPO->SetDbValueDef($rsnew, $this->NoPO->CurrentValue, "", $this->NoPO->ReadOnly);

			// TglPO
			$this->TglPO->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->TglPO->CurrentValue, 7), ew_CurrentDate(), $this->TglPO->ReadOnly);

			// VendorID
			$this->VendorID->SetDbValueDef($rsnew, $this->VendorID->CurrentValue, 0, $this->VendorID->ReadOnly);

			// ArticleID
			$this->ArticleID->SetDbValueDef($rsnew, $this->ArticleID->CurrentValue, 0, $this->ArticleID->ReadOnly);

			// Harga
			$this->Harga->SetDbValueDef($rsnew, $this->Harga->CurrentValue, 0, $this->Harga->ReadOnly);

			// Qty
			$this->Qty->SetDbValueDef($rsnew, $this->Qty->CurrentValue, 0, $this->Qty->ReadOnly);

			// SatuanID
			$this->SatuanID->SetDbValueDef($rsnew, $this->SatuanID->CurrentValue, 0, $this->SatuanID->ReadOnly);

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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("t08_polist.php"), "", $this->TableVar, TRUE);
		$PageId = "edit";
		$Breadcrumb->Add("edit", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_VendorID":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `Nama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t02_vendor`";
			$sWhereWrk = "{filter}";
			$fld->LookupFilters = array("dx1" => '`Nama`');
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->VendorID, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
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
if (!isset($t08_po_edit)) $t08_po_edit = new ct08_po_edit();

// Page init
$t08_po_edit->Page_Init();

// Page main
$t08_po_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t08_po_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = ft08_poedit = new ew_Form("ft08_poedit", "edit");

// Validate form
ft08_poedit.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_NoPO");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t08_po->NoPO->FldCaption(), $t08_po->NoPO->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_TglPO");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t08_po->TglPO->FldCaption(), $t08_po->TglPO->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_TglPO");
			if (elm && !ew_CheckEuroDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t08_po->TglPO->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_VendorID");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t08_po->VendorID->FldCaption(), $t08_po->VendorID->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_ArticleID");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t08_po->ArticleID->FldCaption(), $t08_po->ArticleID->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Harga");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t08_po->Harga->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Qty");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t08_po->Qty->FldErrMsg()) ?>");

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
ft08_poedit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ft08_poedit.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ft08_poedit.Lists["x_VendorID"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nama","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t02_vendor"};
ft08_poedit.Lists["x_VendorID"].Data = "<?php echo $t08_po_edit->VendorID->LookupFilterQuery(FALSE, "edit") ?>";
ft08_poedit.Lists["x_ArticleID"] = {"LinkField":"x_id","Ajax":true,"AutoFill":true,"DisplayFields":["x_Kode","x_Nama","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t06_article"};
ft08_poedit.Lists["x_ArticleID"].Data = "<?php echo $t08_po_edit->ArticleID->LookupFilterQuery(FALSE, "edit") ?>";
ft08_poedit.Lists["x_SatuanID"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nama","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t07_satuan"};
ft08_poedit.Lists["x_SatuanID"].Data = "<?php echo $t08_po_edit->SatuanID->LookupFilterQuery(FALSE, "edit") ?>";
ft08_poedit.AutoSuggests["x_SatuanID"] = <?php echo json_encode(array("data" => "ajax=autosuggest&" . $t08_po_edit->SatuanID->LookupFilterQuery(TRUE, "edit"))) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $t08_po_edit->ShowPageHeader(); ?>
<?php
$t08_po_edit->ShowMessage();
?>
<?php if (!$t08_po_edit->IsModal) { ?>
<form name="ewPagerForm" class="form-horizontal ewForm ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($t08_po_edit->Pager)) $t08_po_edit->Pager = new cPrevNextPager($t08_po_edit->StartRec, $t08_po_edit->DisplayRecs, $t08_po_edit->TotalRecs, $t08_po_edit->AutoHidePager) ?>
<?php if ($t08_po_edit->Pager->RecordCount > 0 && $t08_po_edit->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($t08_po_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $t08_po_edit->PageUrl() ?>start=<?php echo $t08_po_edit->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($t08_po_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $t08_po_edit->PageUrl() ?>start=<?php echo $t08_po_edit->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $t08_po_edit->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($t08_po_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $t08_po_edit->PageUrl() ?>start=<?php echo $t08_po_edit->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($t08_po_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $t08_po_edit->PageUrl() ?>start=<?php echo $t08_po_edit->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $t08_po_edit->Pager->PageCount ?></span>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="ft08_poedit" id="ft08_poedit" class="<?php echo $t08_po_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t08_po_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t08_po_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t08_po">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<input type="hidden" name="modal" value="<?php echo intval($t08_po_edit->IsModal) ?>">
<div class="ewEditDiv"><!-- page* -->
<?php if ($t08_po->NoPO->Visible) { // NoPO ?>
	<div id="r_NoPO" class="form-group">
		<label id="elh_t08_po_NoPO" for="x_NoPO" class="<?php echo $t08_po_edit->LeftColumnClass ?>"><?php echo $t08_po->NoPO->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $t08_po_edit->RightColumnClass ?>"><div<?php echo $t08_po->NoPO->CellAttributes() ?>>
<span id="el_t08_po_NoPO">
<input type="text" data-table="t08_po" data-field="x_NoPO" name="x_NoPO" id="x_NoPO" size="15" maxlength="14" placeholder="<?php echo ew_HtmlEncode($t08_po->NoPO->getPlaceHolder()) ?>" value="<?php echo $t08_po->NoPO->EditValue ?>"<?php echo $t08_po->NoPO->EditAttributes() ?>>
</span>
<?php echo $t08_po->NoPO->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t08_po->TglPO->Visible) { // TglPO ?>
	<div id="r_TglPO" class="form-group">
		<label id="elh_t08_po_TglPO" for="x_TglPO" class="<?php echo $t08_po_edit->LeftColumnClass ?>"><?php echo $t08_po->TglPO->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $t08_po_edit->RightColumnClass ?>"><div<?php echo $t08_po->TglPO->CellAttributes() ?>>
<span id="el_t08_po_TglPO">
<input type="text" data-table="t08_po" data-field="x_TglPO" data-format="7" name="x_TglPO" id="x_TglPO" size="10" placeholder="<?php echo ew_HtmlEncode($t08_po->TglPO->getPlaceHolder()) ?>" value="<?php echo $t08_po->TglPO->EditValue ?>"<?php echo $t08_po->TglPO->EditAttributes() ?>>
<?php if (!$t08_po->TglPO->ReadOnly && !$t08_po->TglPO->Disabled && !isset($t08_po->TglPO->EditAttrs["readonly"]) && !isset($t08_po->TglPO->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("ft08_poedit", "x_TglPO", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<?php echo $t08_po->TglPO->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t08_po->VendorID->Visible) { // VendorID ?>
	<div id="r_VendorID" class="form-group">
		<label id="elh_t08_po_VendorID" for="x_VendorID" class="<?php echo $t08_po_edit->LeftColumnClass ?>"><?php echo $t08_po->VendorID->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $t08_po_edit->RightColumnClass ?>"><div<?php echo $t08_po->VendorID->CellAttributes() ?>>
<span id="el_t08_po_VendorID">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_VendorID"><?php echo (strval($t08_po->VendorID->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t08_po->VendorID->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t08_po->VendorID->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_VendorID',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($t08_po->VendorID->ReadOnly || $t08_po->VendorID->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t08_po" data-field="x_VendorID" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t08_po->VendorID->DisplayValueSeparatorAttribute() ?>" name="x_VendorID" id="x_VendorID" value="<?php echo $t08_po->VendorID->CurrentValue ?>"<?php echo $t08_po->VendorID->EditAttributes() ?>>
</span>
<?php echo $t08_po->VendorID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t08_po->ArticleID->Visible) { // ArticleID ?>
	<div id="r_ArticleID" class="form-group">
		<label id="elh_t08_po_ArticleID" for="x_ArticleID" class="<?php echo $t08_po_edit->LeftColumnClass ?>"><?php echo $t08_po->ArticleID->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $t08_po_edit->RightColumnClass ?>"><div<?php echo $t08_po->ArticleID->CellAttributes() ?>>
<span id="el_t08_po_ArticleID">
<?php $t08_po->ArticleID->EditAttrs["onchange"] = "ew_AutoFill(this); " . @$t08_po->ArticleID->EditAttrs["onchange"]; ?>
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_ArticleID"><?php echo (strval($t08_po->ArticleID->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t08_po->ArticleID->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t08_po->ArticleID->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_ArticleID',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($t08_po->ArticleID->ReadOnly || $t08_po->ArticleID->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t08_po" data-field="x_ArticleID" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t08_po->ArticleID->DisplayValueSeparatorAttribute() ?>" name="x_ArticleID" id="x_ArticleID" value="<?php echo $t08_po->ArticleID->CurrentValue ?>"<?php echo $t08_po->ArticleID->EditAttributes() ?>>
<input type="hidden" name="ln_x_ArticleID" id="ln_x_ArticleID" value="x_Harga,x_SatuanID">
</span>
<?php echo $t08_po->ArticleID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t08_po->Harga->Visible) { // Harga ?>
	<div id="r_Harga" class="form-group">
		<label id="elh_t08_po_Harga" for="x_Harga" class="<?php echo $t08_po_edit->LeftColumnClass ?>"><?php echo $t08_po->Harga->FldCaption() ?></label>
		<div class="<?php echo $t08_po_edit->RightColumnClass ?>"><div<?php echo $t08_po->Harga->CellAttributes() ?>>
<span id="el_t08_po_Harga">
<input type="text" data-table="t08_po" data-field="x_Harga" name="x_Harga" id="x_Harga" size="10" placeholder="<?php echo ew_HtmlEncode($t08_po->Harga->getPlaceHolder()) ?>" value="<?php echo $t08_po->Harga->EditValue ?>"<?php echo $t08_po->Harga->EditAttributes() ?>>
</span>
<?php echo $t08_po->Harga->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t08_po->Qty->Visible) { // Qty ?>
	<div id="r_Qty" class="form-group">
		<label id="elh_t08_po_Qty" for="x_Qty" class="<?php echo $t08_po_edit->LeftColumnClass ?>"><?php echo $t08_po->Qty->FldCaption() ?></label>
		<div class="<?php echo $t08_po_edit->RightColumnClass ?>"><div<?php echo $t08_po->Qty->CellAttributes() ?>>
<span id="el_t08_po_Qty">
<input type="text" data-table="t08_po" data-field="x_Qty" name="x_Qty" id="x_Qty" size="5" placeholder="<?php echo ew_HtmlEncode($t08_po->Qty->getPlaceHolder()) ?>" value="<?php echo $t08_po->Qty->EditValue ?>"<?php echo $t08_po->Qty->EditAttributes() ?>>
</span>
<?php echo $t08_po->Qty->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t08_po->SatuanID->Visible) { // SatuanID ?>
	<div id="r_SatuanID" class="form-group">
		<label id="elh_t08_po_SatuanID" class="<?php echo $t08_po_edit->LeftColumnClass ?>"><?php echo $t08_po->SatuanID->FldCaption() ?></label>
		<div class="<?php echo $t08_po_edit->RightColumnClass ?>"><div<?php echo $t08_po->SatuanID->CellAttributes() ?>>
<span id="el_t08_po_SatuanID">
<?php
$wrkonchange = trim(" " . @$t08_po->SatuanID->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$t08_po->SatuanID->EditAttrs["onchange"] = "";
?>
<span id="as_x_SatuanID" style="white-space: nowrap; z-index: 8920">
	<input type="text" name="sv_x_SatuanID" id="sv_x_SatuanID" value="<?php echo $t08_po->SatuanID->EditValue ?>" size="5" placeholder="<?php echo ew_HtmlEncode($t08_po->SatuanID->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($t08_po->SatuanID->getPlaceHolder()) ?>"<?php echo $t08_po->SatuanID->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t08_po" data-field="x_SatuanID" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t08_po->SatuanID->DisplayValueSeparatorAttribute() ?>" name="x_SatuanID" id="x_SatuanID" value="<?php echo ew_HtmlEncode($t08_po->SatuanID->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script type="text/javascript">
ft08_poedit.CreateAutoSuggest({"id":"x_SatuanID","forceSelect":true});
</script>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t08_po->SatuanID->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_SatuanID',m:0,n:10,srch:false});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($t08_po->SatuanID->ReadOnly || $t08_po->SatuanID->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
</span>
<?php echo $t08_po->SatuanID->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<input type="hidden" data-table="t08_po" data-field="x_id" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($t08_po->id->CurrentValue) ?>">
<?php if (!$t08_po_edit->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $t08_po_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $t08_po_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$t08_po_edit->IsModal) { ?>
<?php if (!isset($t08_po_edit->Pager)) $t08_po_edit->Pager = new cPrevNextPager($t08_po_edit->StartRec, $t08_po_edit->DisplayRecs, $t08_po_edit->TotalRecs, $t08_po_edit->AutoHidePager) ?>
<?php if ($t08_po_edit->Pager->RecordCount > 0 && $t08_po_edit->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($t08_po_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $t08_po_edit->PageUrl() ?>start=<?php echo $t08_po_edit->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($t08_po_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $t08_po_edit->PageUrl() ?>start=<?php echo $t08_po_edit->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $t08_po_edit->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($t08_po_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $t08_po_edit->PageUrl() ?>start=<?php echo $t08_po_edit->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($t08_po_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $t08_po_edit->PageUrl() ?>start=<?php echo $t08_po_edit->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $t08_po_edit->Pager->PageCount ?></span>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<script type="text/javascript">
ft08_poedit.Init();
</script>
<?php
$t08_po_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t08_po_edit->Page_Terminate();
?>
