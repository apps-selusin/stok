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

$t08_beli_list = NULL; // Initialize page object first

class ct08_beli_list extends ct08_beli {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = '{8746EF3F-81FE-4C1C-A7F8-AC191F8DDBB2}';

	// Table name
	var $TableName = 't08_beli';

	// Page object name
	var $PageObjName = 't08_beli_list';

	// Grid form hidden field names
	var $FormName = 'ft08_belilist';
	var $FormActionName = 'k_action';
	var $FormKeyName = 'k_key';
	var $FormOldKeyName = 'k_oldkey';
	var $FormBlankRowName = 'k_blankrow';
	var $FormKeyCountName = 'key_count';

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

	// Page URLs
	var $AddUrl;
	var $EditUrl;
	var $CopyUrl;
	var $DeleteUrl;
	var $ViewUrl;
	var $ListUrl;

	// Export URLs
	var $ExportPrintUrl;
	var $ExportHtmlUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportXmlUrl;
	var $ExportCsvUrl;
	var $ExportPdfUrl;

	// Custom export
	var $ExportExcelCustom = FALSE;
	var $ExportWordCustom = FALSE;
	var $ExportPdfCustom = FALSE;
	var $ExportEmailCustom = FALSE;

	// Update URLs
	var $InlineAddUrl;
	var $InlineCopyUrl;
	var $InlineEditUrl;
	var $GridAddUrl;
	var $GridEditUrl;
	var $MultiDeleteUrl;
	var $MultiUpdateUrl;
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

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "t08_beliadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "t08_belidelete.php";
		$this->MultiUpdateUrl = "t08_beliupdate.php";

		// Table object (t96_employees)
		if (!isset($GLOBALS['t96_employees'])) $GLOBALS['t96_employees'] = new ct96_employees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

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

		// List options
		$this->ListOptions = new cListOptions();
		$this->ListOptions->TableVar = $this->TableVar;

		// Export options
		$this->ExportOptions = new cListOptions();
		$this->ExportOptions->Tag = "div";
		$this->ExportOptions->TagClassName = "ewExportOption";

		// Other options
		$this->OtherOptions['addedit'] = new cListOptions();
		$this->OtherOptions['addedit']->Tag = "div";
		$this->OtherOptions['addedit']->TagClassName = "ewAddEditOption";
		$this->OtherOptions['detail'] = new cListOptions();
		$this->OtherOptions['detail']->Tag = "div";
		$this->OtherOptions['detail']->TagClassName = "ewDetailOption";
		$this->OtherOptions['action'] = new cListOptions();
		$this->OtherOptions['action']->Tag = "div";
		$this->OtherOptions['action']->TagClassName = "ewActionOption";

		// Filter options
		$this->FilterOptions = new cListOptions();
		$this->FilterOptions->Tag = "div";
		$this->FilterOptions->TagClassName = "ewFilterOption ft08_belilistsrch";

		// List actions
		$this->ListActions = new cListActions();
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
		if (!$Security->CanList()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage(ew_DeniedMsg()); // Set no permission
			$this->Page_Terminate(ew_GetUrl("index.php"));
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

		// Get export parameters
		$custom = "";
		if (@$_GET["export"] <> "") {
			$this->Export = $_GET["export"];
			$custom = @$_GET["custom"];
		} elseif (@$_POST["export"] <> "") {
			$this->Export = $_POST["export"];
			$custom = @$_POST["custom"];
		} elseif (ew_IsPost()) {
			if (@$_POST["exporttype"] <> "")
				$this->Export = $_POST["exporttype"];
			$custom = @$_POST["custom"];
		} elseif (@$_GET["cmd"] == "json") {
			$this->Export = $_GET["cmd"];
		} else {
			$this->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExportFile = $this->TableVar; // Get export file, used in header

		// Get custom export parameters
		if ($this->Export <> "" && $custom <> "") {
			$this->CustomExport = $this->Export;
			$this->Export = "print";
		}
		$gsCustomExport = $this->CustomExport;
		$gsExport = $this->Export; // Get export parameter, used in header

		// Update Export URLs
		if (defined("EW_USE_PHPEXCEL"))
			$this->ExportExcelCustom = FALSE;
		if ($this->ExportExcelCustom)
			$this->ExportExcelUrl .= "&amp;custom=1";
		if (defined("EW_USE_PHPWORD"))
			$this->ExportWordCustom = FALSE;
		if ($this->ExportWordCustom)
			$this->ExportWordUrl .= "&amp;custom=1";
		if ($this->ExportPdfCustom)
			$this->ExportPdfUrl .= "&amp;custom=1";
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->SetupListOptions();

		// Setup export options
		$this->SetupExportOptions();
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

		// Setup other options
		$this->SetupOtherOptions();

		// Set up custom action (compatible with old version)
		foreach ($this->CustomActions as $name => $action)
			$this->ListActions->Add($name, $action);

		// Show checkbox column if multiple action
		foreach ($this->ListActions->Items as $listaction) {
			if ($listaction->Select == EW_ACTION_MULTIPLE && $listaction->Allow) {
				$this->ListOptions->Items["checkbox"]->Visible = TRUE;
				break;
			}
		}
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

	// Class variables
	var $ListOptions; // List options
	var $ExportOptions; // Export options
	var $SearchOptions; // Search options
	var $OtherOptions = array(); // Other options
	var $FilterOptions; // Filter options
	var $ListActions; // List actions
	var $SelectedCount = 0;
	var $SelectedIndex = 0;
	var $DisplayRecs = 20;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $Pager;
	var $AutoHidePager = EW_AUTO_HIDE_PAGER;
	var $AutoHidePageSizeSelector = EW_AUTO_HIDE_PAGE_SIZE_SELECTOR;
	var $DefaultSearchWhere = ""; // Default search WHERE clause
	var $SearchWhere = ""; // Search WHERE clause
	var $RecCnt = 0; // Record count
	var $EditRowCnt;
	var $StartRowCnt = 1;
	var $RowCnt = 0;
	var $Attrs = array(); // Row attributes and cell attributes
	var $RowIndex = 0; // Row index
	var $KeyCount = 0; // Key count
	var $RowAction = ""; // Row action
	var $RowOldKey = ""; // Row old key (for copy)
	var $RecPerRow = 0;
	var $MultiColumnClass;
	var $MultiColumnEditClass = "col-sm-12";
	var $MultiColumnCnt = 12;
	var $MultiColumnEditCnt = 12;
	var $GridCnt = 0;
	var $ColCnt = 0;
	var $DbMasterFilter = ""; // Master filter
	var $DbDetailFilter = ""; // Detail filter
	var $MasterRecordExists;
	var $MultiSelectKey;
	var $Command;
	var $RestoreSearch = FALSE;
	var $DetailPages;
	var $Recordset;
	var $OldRecordset;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $EW_EXPORT;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";

		// Get command
		$this->Command = strtolower(@$_GET["cmd"]);
		if ($this->IsPageRequest()) { // Validate request

			// Process list action first
			if ($this->ProcessListAction()) // Ajax request
				$this->Page_Terminate();

			// Set up records per page
			$this->SetupDisplayRecs();

			// Handle reset command
			$this->ResetCmd();

			// Set up Breadcrumb
			if ($this->Export == "")
				$this->SetupBreadcrumb();

			// Check QueryString parameters
			if (@$_GET["a"] <> "") {
				$this->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($this->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to inline edit mode
				if ($this->CurrentAction == "edit")
					$this->InlineEditMode();

				// Switch to inline add mode
				if ($this->CurrentAction == "add" || $this->CurrentAction == "copy")
					$this->InlineAddMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$this->CurrentAction = $_POST["a_list"]; // Get action

					// Inline Update
					if (($this->CurrentAction == "update" || $this->CurrentAction == "overwrite") && @$_SESSION[EW_SESSION_INLINE_MODE] == "edit")
						$this->InlineUpdate();

					// Insert Inline
					if ($this->CurrentAction == "insert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "add")
						$this->InlineInsert();
				}
			}

			// Hide list options
			if ($this->Export <> "") {
				$this->ListOptions->HideAllOptions(array("sequence"));
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			} elseif ($this->CurrentAction == "gridadd" || $this->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			}

			// Hide options
			if ($this->Export <> "" || $this->CurrentAction <> "") {
				$this->ExportOptions->HideAllOptions();
				$this->FilterOptions->HideAllOptions();
			}

			// Hide other options
			if ($this->Export <> "") {
				foreach ($this->OtherOptions as &$option)
					$option->HideAllOptions();
			}

			// Set up sorting order
			$this->SetupSortOrder();
		}

		// Restore display records
		if ($this->Command <> "json" && $this->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $this->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		if ($this->Command <> "json")
			$this->LoadSortOrder();

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter
		if ($this->Command == "json") {
			$this->UseSessionForListSQL = FALSE; // Do not use session for ListSQL
			$this->CurrentFilter = $sFilter;
		} else {
			$this->setSessionWhere($sFilter);
			$this->CurrentFilter = "";
		}

		// Export data only
		if ($this->CustomExport == "" && in_array($this->Export, array_keys($EW_EXPORT))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}

		// Load record count first
		if (!$this->IsAddOrEdit()) {
			$bSelectLimit = $this->UseSelectLimit;
			if ($bSelectLimit) {
				$this->TotalRecs = $this->ListRecordCount();
			} else {
				if ($this->Recordset = $this->LoadRecordset())
					$this->TotalRecs = $this->Recordset->RecordCount();
			}
		}

		// Search options
		$this->SetupSearchOptions();
	}

	// Set up number of records displayed per page
	function SetupDisplayRecs() {
		$sWrk = @$_GET[EW_TABLE_REC_PER_PAGE];
		if ($sWrk <> "") {
			if (is_numeric($sWrk)) {
				$this->DisplayRecs = intval($sWrk);
			} else {
				if (strtolower($sWrk) == "all") { // Display all records
					$this->DisplayRecs = -1;
				} else {
					$this->DisplayRecs = 20; // Non-numeric, load default
				}
			}
			$this->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Exit inline mode
	function ClearInlineMode() {
		$this->setKey("id", ""); // Clear inline edit key
		$this->Harga->FormValue = ""; // Clear form value
		$this->Qty->FormValue = ""; // Clear form value
		$this->SubTotal->FormValue = ""; // Clear form value
		$this->LastAction = $this->CurrentAction; // Save last action
		$this->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Inline Edit mode
	function InlineEditMode() {
		global $Security, $Language;
		if (!$Security->CanEdit())
			$this->Page_Terminate("login.php"); // Go to login page
		$bInlineEdit = TRUE;
		if (isset($_GET["id"])) {
			$this->id->setQueryStringValue($_GET["id"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if ($bInlineEdit) {
			if ($this->LoadRow()) {
				$this->setKey("id", $this->id->CurrentValue); // Set up inline edit key
				$_SESSION[EW_SESSION_INLINE_MODE] = "edit"; // Enable inline edit
			}
		}
	}

	// Perform update to Inline Edit record
	function InlineUpdate() {
		global $Language, $objForm, $gsFormError;
		$objForm->Index = 1;
		$this->LoadFormValues(); // Get form values

		// Validate form
		$bInlineUpdate = TRUE;
		if (!$this->ValidateForm()) {
			$bInlineUpdate = FALSE; // Form error, reset action
			$this->setFailureMessage($gsFormError);
		} else {
			$bInlineUpdate = FALSE;
			$rowkey = strval($objForm->GetValue($this->FormKeyName));
			if ($this->SetupKeyValues($rowkey)) { // Set up key values
				if ($this->CheckInlineEditKey()) { // Check key
					$this->SendEmail = TRUE; // Send email on update success
					$bInlineUpdate = $this->EditRow(); // Update record
				} else {
					$bInlineUpdate = FALSE;
				}
			}
		}
		if ($bInlineUpdate) { // Update success
			if ($this->getSuccessMessage() == "")
				$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Set up success message
			$this->ClearInlineMode(); // Clear inline edit mode
		} else {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("UpdateFailed")); // Set update failed message
			$this->EventCancelled = TRUE; // Cancel event
			$this->CurrentAction = "edit"; // Stay in edit mode
		}
	}

	// Check Inline Edit key
	function CheckInlineEditKey() {

		//CheckInlineEditKey = True
		if (strval($this->getKey("id")) <> strval($this->id->CurrentValue))
			return FALSE;
		return TRUE;
	}

	// Switch to Inline Add mode
	function InlineAddMode() {
		global $Security, $Language;
		if (!$Security->CanAdd())
			$this->Page_Terminate("login.php"); // Return to login page
		$this->CurrentAction = "add";
		$_SESSION[EW_SESSION_INLINE_MODE] = "add"; // Enable inline add
	}

	// Perform update to Inline Add/Copy record
	function InlineInsert() {
		global $Language, $objForm, $gsFormError;
		$this->LoadOldRecord(); // Load old record
		$objForm->Index = 0;
		$this->LoadFormValues(); // Get form values

		// Validate form
		if (!$this->ValidateForm()) {
			$this->setFailureMessage($gsFormError); // Set validation error message
			$this->EventCancelled = TRUE; // Set event cancelled
			$this->CurrentAction = "add"; // Stay in add mode
			return;
		}
		$this->SendEmail = TRUE; // Send email on add success
		if ($this->AddRow($this->OldRecordset)) { // Add record
			if ($this->getSuccessMessage() == "")
				$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up add success message
			$this->ClearInlineMode(); // Clear inline add mode
		} else { // Add failed
			$this->EventCancelled = TRUE; // Set event cancelled
			$this->CurrentAction = "add"; // Stay in add mode
		}
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue($this->FormKeyName));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $this->KeyFilter();
				if ($sWrkFilter <> "") $sWrkFilter .= " OR ";
				$sWrkFilter .= $sFilter;
			} else {
				$sWrkFilter = "0=1";
				break;
			}

			// Update row index and get row key
			$rowindex++; // Next row
			$objForm->Index = $rowindex;
			$sThisKey = strval($objForm->GetValue($this->FormKeyName));
		}
		return $sWrkFilter;
	}

	// Set up key values
	function SetupKeyValues($key) {
		$arrKeyFlds = explode($GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"], $key);
		if (count($arrKeyFlds) >= 1) {
			$this->id->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($this->id->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Set up sort parameters
	function SetupSortOrder() {

		// Check for Ctrl pressed
		$bCtrl = (@$_GET["ctrl"] <> "");

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$this->CurrentOrder = @$_GET["order"];
			$this->CurrentOrderType = @$_GET["ordertype"];
			$this->UpdateSort($this->TglPO, $bCtrl); // TglPO
			$this->UpdateSort($this->NoPO, $bCtrl); // NoPO
			$this->UpdateSort($this->VendorID, $bCtrl); // VendorID
			$this->UpdateSort($this->ArticleID, $bCtrl); // ArticleID
			$this->UpdateSort($this->Harga, $bCtrl); // Harga
			$this->UpdateSort($this->Qty, $bCtrl); // Qty
			$this->UpdateSort($this->SatuanID, $bCtrl); // SatuanID
			$this->UpdateSort($this->SubTotal, $bCtrl); // SubTotal
			$this->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		$sOrderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($this->getSqlOrderBy() <> "") {
				$sOrderBy = $this->getSqlOrderBy();
				$this->setSessionOrderBy($sOrderBy);
				$this->TglPO->setSort("ASC");
				$this->NoPO->setSort("ASC");
			}
		}
	}

	// Reset command
	// - cmd=reset (Reset search parameters)
	// - cmd=resetall (Reset search and master/detail parameters)
	// - cmd=resetsort (Reset sort parameters)
	function ResetCmd() {

		// Check if reset command
		if (substr($this->Command,0,5) == "reset") {

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$sOrderBy = "";
				$this->setSessionOrderBy($sOrderBy);
				$this->setSessionOrderByList($sOrderBy);
				$this->TglPO->setSort("");
				$this->NoPO->setSort("");
				$this->VendorID->setSort("");
				$this->ArticleID->setSort("");
				$this->Harga->setSort("");
				$this->Qty->setSort("");
				$this->SatuanID->setSort("");
				$this->SubTotal->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language;

		// Add group option item
		$item = &$this->ListOptions->Add($this->ListOptions->GroupOptionName);
		$item->Body = "";
		$item->OnLeft = TRUE;
		$item->Visible = FALSE;

		// "view"
		$item = &$this->ListOptions->Add("view");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->CanView();
		$item->OnLeft = TRUE;

		// "edit"
		$item = &$this->ListOptions->Add("edit");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->CanEdit();
		$item->OnLeft = TRUE;

		// "copy"
		$item = &$this->ListOptions->Add("copy");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->CanAdd() && ($this->CurrentAction == "add");
		$item->OnLeft = TRUE;

		// List actions
		$item = &$this->ListOptions->Add("listactions");
		$item->CssClass = "text-nowrap";
		$item->OnLeft = TRUE;
		$item->Visible = FALSE;
		$item->ShowInButtonGroup = FALSE;
		$item->ShowInDropDown = FALSE;

		// "checkbox"
		$item = &$this->ListOptions->Add("checkbox");
		$item->Visible = $Security->CanDelete();
		$item->OnLeft = TRUE;
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" onclick=\"ew_SelectAllKey(this);\">";
		$item->MoveTo(0);
		$item->ShowInDropDown = FALSE;
		$item->ShowInButtonGroup = FALSE;

		// "sequence"
		$item = &$this->ListOptions->Add("sequence");
		$item->CssClass = "text-nowrap";
		$item->Visible = TRUE;
		$item->OnLeft = TRUE; // Always on left
		$item->ShowInDropDown = FALSE;
		$item->ShowInButtonGroup = FALSE;

		// Drop down button for ListOptions
		$this->ListOptions->UseImageAndText = TRUE;
		$this->ListOptions->UseDropDownButton = FALSE;
		$this->ListOptions->DropDownButtonPhrase = $Language->Phrase("ButtonListOptions");
		$this->ListOptions->UseButtonGroup = FALSE;
		if ($this->ListOptions->UseButtonGroup && ew_IsMobile())
			$this->ListOptions->UseDropDownButton = TRUE;
		$this->ListOptions->ButtonClass = "btn-sm"; // Class for button group

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		$this->SetupListOptionsExt();
		$item = &$this->ListOptions->GetItem($this->ListOptions->GroupOptionName);
		$item->Visible = $this->ListOptions->GroupOptionVisible();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $objForm;
		$this->ListOptions->LoadDefault();

		// Call ListOptions_Rendering event
		$this->ListOptions_Rendering();

		// Set up row action and key
		if (is_numeric($this->RowIndex) && $this->CurrentMode <> "view") {
			$objForm->Index = $this->RowIndex;
			$ActionName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormActionName);
			$OldKeyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormOldKeyName);
			$KeyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormKeyName);
			$BlankRowName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormBlankRowName);
			if ($this->RowAction <> "")
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $ActionName . "\" id=\"" . $ActionName . "\" value=\"" . $this->RowAction . "\">";
			if ($this->RowAction == "delete") {
				$rowkey = $objForm->GetValue($this->FormKeyName);
				$this->SetupKeyValues($rowkey);
			}
			if ($this->RowAction == "insert" && $this->CurrentAction == "F" && $this->EmptyRow())
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $BlankRowName . "\" id=\"" . $BlankRowName . "\" value=\"1\">";
		}

		// "sequence"
		$oListOpt = &$this->ListOptions->Items["sequence"];
		$oListOpt->Body = ew_FormatSeqNo($this->RecCnt);

		// "copy"
		$oListOpt = &$this->ListOptions->Items["copy"];
		if (($this->CurrentAction == "add" || $this->CurrentAction == "copy") && $this->RowType == EW_ROWTYPE_ADD) { // Inline Add/Copy
			$this->ListOptions->CustomItem = "copy"; // Show copy column only
			$cancelurl = $this->AddMasterUrl($this->PageUrl() . "a=cancel");
			$oListOpt->Body = "<div" . (($oListOpt->OnLeft) ? " style=\"text-align: right\"" : "") . ">" .
				"<a class=\"ewGridLink ewInlineInsert\" title=\"" . ew_HtmlTitle($Language->Phrase("InsertLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("InsertLink")) . "\" href=\"\" onclick=\"return ewForms(this).Submit('" . $this->PageName() . "');\">" . $Language->Phrase("InsertLink") . "</a>&nbsp;" .
				"<a class=\"ewGridLink ewInlineCancel\" title=\"" . ew_HtmlTitle($Language->Phrase("CancelLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("CancelLink")) . "\" href=\"" . $cancelurl . "\">" . $Language->Phrase("CancelLink") . "</a>" .
				"<input type=\"hidden\" name=\"a_list\" id=\"a_list\" value=\"insert\"></div>";
			return;
		}

		// "edit"
		$oListOpt = &$this->ListOptions->Items["edit"];
		if ($this->CurrentAction == "edit" && $this->RowType == EW_ROWTYPE_EDIT) { // Inline-Edit
			$this->ListOptions->CustomItem = "edit"; // Show edit column only
			$cancelurl = $this->AddMasterUrl($this->PageUrl() . "a=cancel");
				$oListOpt->Body = "<div" . (($oListOpt->OnLeft) ? " style=\"text-align: right\"" : "") . ">" .
					"<a class=\"ewGridLink ewInlineUpdate\" title=\"" . ew_HtmlTitle($Language->Phrase("UpdateLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("UpdateLink")) . "\" href=\"\" onclick=\"return ewForms(this).Submit('" . ew_UrlAddHash($this->PageName(), "r" . $this->RowCnt . "_" . $this->TableVar) . "');\">" . $Language->Phrase("UpdateLink") . "</a>&nbsp;" .
					"<a class=\"ewGridLink ewInlineCancel\" title=\"" . ew_HtmlTitle($Language->Phrase("CancelLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("CancelLink")) . "\" href=\"" . $cancelurl . "\">" . $Language->Phrase("CancelLink") . "</a>" .
					"<input type=\"hidden\" name=\"a_list\" id=\"a_list\" value=\"update\"></div>";
			$oListOpt->Body .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_key\" id=\"k" . $this->RowIndex . "_key\" value=\"" . ew_HtmlEncode($this->id->CurrentValue) . "\">";
			return;
		}

		// "view"
		$oListOpt = &$this->ListOptions->Items["view"];
		$viewcaption = ew_HtmlTitle($Language->Phrase("ViewLink"));
		if ($Security->CanView()) {
			$oListOpt->Body = "<a class=\"ewRowLink ewView\" title=\"" . $viewcaption . "\" data-caption=\"" . $viewcaption . "\" href=\"" . ew_HtmlEncode($this->ViewUrl) . "\">" . $Language->Phrase("ViewLink") . "</a>";
		} else {
			$oListOpt->Body = "";
		}

		// "edit"
		$oListOpt = &$this->ListOptions->Items["edit"];
		$editcaption = ew_HtmlTitle($Language->Phrase("EditLink"));
		if ($Security->CanEdit()) {
			$oListOpt->Body .= "<a class=\"ewRowLink ewInlineEdit\" title=\"" . ew_HtmlTitle($Language->Phrase("InlineEditLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("InlineEditLink")) . "\" href=\"" . ew_HtmlEncode(ew_UrlAddHash($this->InlineEditUrl, "r" . $this->RowCnt . "_" . $this->TableVar)) . "\">" . $Language->Phrase("InlineEditLink") . "</a>";
		} else {
			$oListOpt->Body = "";
		}

		// Set up list action buttons
		$oListOpt = &$this->ListOptions->GetItem("listactions");
		if ($oListOpt && $this->Export == "" && $this->CurrentAction == "") {
			$body = "";
			$links = array();
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == EW_ACTION_SINGLE && $listaction->Allow) {
					$action = $listaction->Action;
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<span class=\"" . ew_HtmlEncode(str_replace(" ewIcon", "", $listaction->Icon)) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\"></span> " : "";
					$links[] = "<li><a class=\"ewAction ewListAction\" data-action=\"" . ew_HtmlEncode($action) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({key:" . $this->KeyToJson() . "}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . $listaction->Caption . "</a></li>";
					if (count($links) == 1) // Single button
						$body = "<a class=\"ewAction ewListAction\" data-action=\"" . ew_HtmlEncode($action) . "\" title=\"" . ew_HtmlTitle($caption) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({key:" . $this->KeyToJson() . "}," . $listaction->ToJson(TRUE) . "));return false;\">" . $Language->Phrase("ListActionButton") . "</a>";
				}
			}
			if (count($links) > 1) { // More than one buttons, use dropdown
				$body = "<button class=\"dropdown-toggle btn btn-default btn-sm ewActions\" title=\"" . ew_HtmlTitle($Language->Phrase("ListActionButton")) . "\" data-toggle=\"dropdown\">" . $Language->Phrase("ListActionButton") . "<b class=\"caret\"></b></button>";
				$content = "";
				foreach ($links as $link)
					$content .= "<li>" . $link . "</li>";
				$body .= "<ul class=\"dropdown-menu" . ($oListOpt->OnLeft ? "" : " dropdown-menu-right") . "\">". $content . "</ul>";
				$body = "<div class=\"btn-group\">" . $body . "</div>";
			}
			if (count($links) > 0) {
				$oListOpt->Body = $body;
				$oListOpt->Visible = TRUE;
			}
		}

		// "checkbox"
		$oListOpt = &$this->ListOptions->Items["checkbox"];
		$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" class=\"ewMultiSelect\" value=\"" . ew_HtmlEncode($this->id->CurrentValue) . "\" onclick=\"ew_ClickMultiCheckbox(event);\">";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set up other options
	function SetupOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = $options["addedit"];

		// Inline Add
		$item = &$option->Add("inlineadd");
		$item->Body = "<a class=\"ewAddEdit ewInlineAdd\" title=\"" . ew_HtmlTitle($Language->Phrase("InlineAddLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("InlineAddLink")) . "\" href=\"" . ew_HtmlEncode($this->InlineAddUrl) . "\">" .$Language->Phrase("InlineAddLink") . "</a>";
		$item->Visible = ($this->InlineAddUrl <> "" && $Security->CanAdd());
		$option = $options["action"];

		// Add multi delete
		$item = &$option->Add("multidelete");
		$item->Body = "<a class=\"ewAction ewMultiDelete\" title=\"" . ew_HtmlTitle($Language->Phrase("DeleteSelectedLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("DeleteSelectedLink")) . "\" href=\"\" onclick=\"ew_SubmitAction(event,{f:document.ft08_belilist,url:'" . $this->MultiDeleteUrl . "'});return false;\">" . $Language->Phrase("DeleteSelectedLink") . "</a>";
		$item->Visible = ($Security->CanDelete());

		// Set up options default
		foreach ($options as &$option) {
			$option->UseImageAndText = TRUE;
			$option->UseDropDownButton = FALSE;
			$option->UseButtonGroup = TRUE;
			$option->ButtonClass = "btn-sm"; // Class for button group
			$item = &$option->Add($option->GroupOptionName);
			$item->Body = "";
			$item->Visible = FALSE;
		}
		$options["addedit"]->DropDownButtonPhrase = $Language->Phrase("ButtonAddEdit");
		$options["detail"]->DropDownButtonPhrase = $Language->Phrase("ButtonDetails");
		$options["action"]->DropDownButtonPhrase = $Language->Phrase("ButtonActions");

		// Filter button
		$item = &$this->FilterOptions->Add("savecurrentfilter");
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"ft08_belilistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = FALSE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"ft08_belilistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
		$item->Visible = FALSE;
		$this->FilterOptions->UseDropDownButton = TRUE;
		$this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
		$this->FilterOptions->DropDownButtonPhrase = $Language->Phrase("Filters");

		// Add group option item
		$item = &$this->FilterOptions->Add($this->FilterOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Render other options
	function RenderOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
			$option = &$options["action"];

			// Set up list action buttons
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == EW_ACTION_MULTIPLE) {
					$item = &$option->Add("custom_" . $listaction->Action);
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<span class=\"" . ew_HtmlEncode($listaction->Icon) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\"></span> " : $caption;
					$item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.ft08_belilist}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
					$item->Visible = $listaction->Allow;
				}
			}

			// Hide grid edit and other options
			if ($this->TotalRecs <= 0) {
				$option = &$options["addedit"];
				$item = &$option->GetItem("gridedit");
				if ($item) $item->Visible = FALSE;
				$option = &$options["action"];
				$option->HideAllOptions();
			}
	}

	// Process list action
	function ProcessListAction() {
		global $Language, $Security;
		$userlist = "";
		$user = "";
		$sFilter = $this->GetKeyFilter();
		$UserAction = @$_POST["useraction"];
		if ($sFilter <> "" && $UserAction <> "") {

			// Check permission first
			$ActionCaption = $UserAction;
			if (array_key_exists($UserAction, $this->ListActions->Items)) {
				$ActionCaption = $this->ListActions->Items[$UserAction]->Caption;
				if (!$this->ListActions->Items[$UserAction]->Allow) {
					$errmsg = str_replace('%s', $ActionCaption, $Language->Phrase("CustomActionNotAllowed"));
					if (@$_POST["ajax"] == $UserAction) // Ajax
						echo "<p class=\"text-danger\">" . $errmsg . "</p>";
					else
						$this->setFailureMessage($errmsg);
					return FALSE;
				}
			}
			$this->CurrentFilter = $sFilter;
			$sSql = $this->SQL();
			$conn = &$this->Connection();
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			$rs = $conn->Execute($sSql);
			$conn->raiseErrorFn = '';
			$this->CurrentAction = $UserAction;

			// Call row action event
			if ($rs && !$rs->EOF) {
				$conn->BeginTrans();
				$this->SelectedCount = $rs->RecordCount();
				$this->SelectedIndex = 0;
				while (!$rs->EOF) {
					$this->SelectedIndex++;
					$row = $rs->fields;
					$Processed = $this->Row_CustomAction($UserAction, $row);
					if (!$Processed) break;
					$rs->MoveNext();
				}
				if ($Processed) {
					$conn->CommitTrans(); // Commit the changes
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage(str_replace('%s', $ActionCaption, $Language->Phrase("CustomActionCompleted"))); // Set up success message
				} else {
					$conn->RollbackTrans(); // Rollback changes

					// Set up error message
					if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

						// Use the message, do nothing
					} elseif ($this->CancelMessage <> "") {
						$this->setFailureMessage($this->CancelMessage);
						$this->CancelMessage = "";
					} else {
						$this->setFailureMessage(str_replace('%s', $ActionCaption, $Language->Phrase("CustomActionFailed")));
					}
				}
			}
			if ($rs)
				$rs->Close();
			$this->CurrentAction = ""; // Clear action
			if (@$_POST["ajax"] == $UserAction) { // Ajax
				if ($this->getSuccessMessage() <> "") {
					echo "<p class=\"text-success\">" . $this->getSuccessMessage() . "</p>";
					$this->ClearSuccessMessage(); // Clear message
				}
				if ($this->getFailureMessage() <> "") {
					echo "<p class=\"text-danger\">" . $this->getFailureMessage() . "</p>";
					$this->ClearFailureMessage(); // Clear message
				}
				return TRUE;
			}
		}
		return FALSE; // Not ajax request
	}

	// Set up search options
	function SetupSearchOptions() {
		global $Language;
		$this->SearchOptions = new cListOptions();
		$this->SearchOptions->Tag = "div";
		$this->SearchOptions->TagClassName = "ewSearchOption";

		// Button group for search
		$this->SearchOptions->UseDropDownButton = FALSE;
		$this->SearchOptions->UseImageAndText = TRUE;
		$this->SearchOptions->UseButtonGroup = TRUE;
		$this->SearchOptions->DropDownButtonPhrase = $Language->Phrase("ButtonSearch");

		// Add group option item
		$item = &$this->SearchOptions->Add($this->SearchOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide search options
		if ($this->Export <> "" || $this->CurrentAction <> "")
			$this->SearchOptions->HideAllOptions();
		global $Security;
		if (!$Security->CanSearch()) {
			$this->SearchOptions->HideAllOptions();
			$this->FilterOptions->HideAllOptions();
		}
	}

	function SetupListOptionsExt() {
		global $Security, $Language;
	}

	function RenderListOptionsExt() {
		global $Security, $Language;
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

	// Load default values
	function LoadDefaultValues() {
		$this->id->CurrentValue = NULL;
		$this->id->OldValue = $this->id->CurrentValue;
		$this->TglPO->CurrentValue = NULL;
		$this->TglPO->OldValue = $this->TglPO->CurrentValue;
		$this->NoPO->CurrentValue = NULL;
		$this->NoPO->OldValue = $this->NoPO->CurrentValue;
		$this->VendorID->CurrentValue = NULL;
		$this->VendorID->OldValue = $this->VendorID->CurrentValue;
		$this->ArticleID->CurrentValue = NULL;
		$this->ArticleID->OldValue = $this->ArticleID->CurrentValue;
		$this->Harga->CurrentValue = 0.00;
		$this->Qty->CurrentValue = 0;
		$this->SatuanID->CurrentValue = NULL;
		$this->SatuanID->OldValue = $this->SatuanID->CurrentValue;
		$this->SubTotal->CurrentValue = 0.00;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->TglPO->FldIsDetailKey) {
			$this->TglPO->setFormValue($objForm->GetValue("x_TglPO"));
			$this->TglPO->CurrentValue = ew_UnFormatDateTime($this->TglPO->CurrentValue, 7);
		}
		if (!$this->NoPO->FldIsDetailKey) {
			$this->NoPO->setFormValue($objForm->GetValue("x_NoPO"));
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
		if (!$this->SubTotal->FldIsDetailKey) {
			$this->SubTotal->setFormValue($objForm->GetValue("x_SubTotal"));
		}
		if (!$this->id->FldIsDetailKey && $this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
			$this->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		if ($this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
			$this->id->CurrentValue = $this->id->FormValue;
		$this->TglPO->CurrentValue = $this->TglPO->FormValue;
		$this->TglPO->CurrentValue = ew_UnFormatDateTime($this->TglPO->CurrentValue, 7);
		$this->NoPO->CurrentValue = $this->NoPO->FormValue;
		$this->VendorID->CurrentValue = $this->VendorID->FormValue;
		$this->ArticleID->CurrentValue = $this->ArticleID->FormValue;
		$this->Harga->CurrentValue = $this->Harga->FormValue;
		$this->Qty->CurrentValue = $this->Qty->FormValue;
		$this->SatuanID->CurrentValue = $this->SatuanID->FormValue;
		$this->SubTotal->CurrentValue = $this->SubTotal->FormValue;
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
		$this->LoadDefaultValues();
		$row = array();
		$row['id'] = $this->id->CurrentValue;
		$row['TglPO'] = $this->TglPO->CurrentValue;
		$row['NoPO'] = $this->NoPO->CurrentValue;
		$row['VendorID'] = $this->VendorID->CurrentValue;
		$row['ArticleID'] = $this->ArticleID->CurrentValue;
		$row['Harga'] = $this->Harga->CurrentValue;
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
		$this->TglPO->DbValue = $row['TglPO'];
		$this->NoPO->DbValue = $row['NoPO'];
		$this->VendorID->DbValue = $row['VendorID'];
		$this->ArticleID->DbValue = $row['ArticleID'];
		$this->Harga->DbValue = $row['Harga'];
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
		$this->ViewUrl = $this->GetViewUrl();
		$this->EditUrl = $this->GetEditUrl();
		$this->InlineEditUrl = $this->GetInlineEditUrl();
		$this->CopyUrl = $this->GetCopyUrl();
		$this->InlineCopyUrl = $this->GetInlineCopyUrl();
		$this->DeleteUrl = $this->GetDeleteUrl();

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
			$this->ArticleID->ViewValue = $this->ArticleID->CurrentValue;
		if (strval($this->ArticleID->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->ArticleID->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `Kode` AS `DispFld`, `Nama` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `v05_article`";
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
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// TglPO
			$this->TglPO->EditAttrs["class"] = "form-control";
			$this->TglPO->EditCustomAttributes = "";
			$this->TglPO->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->TglPO->CurrentValue, 7));
			$this->TglPO->PlaceHolder = ew_RemoveHtml($this->TglPO->FldCaption());

			// NoPO
			$this->NoPO->EditAttrs["class"] = "form-control";
			$this->NoPO->EditCustomAttributes = "";
			$this->NoPO->EditValue = ew_HtmlEncode($this->NoPO->CurrentValue);
			$this->NoPO->PlaceHolder = ew_RemoveHtml($this->NoPO->FldCaption());

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
			$this->ArticleID->EditAttrs["class"] = "form-control";
			$this->ArticleID->EditCustomAttributes = "";
			$this->ArticleID->EditValue = ew_HtmlEncode($this->ArticleID->CurrentValue);
			if (strval($this->ArticleID->CurrentValue) <> "") {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->ArticleID->CurrentValue, EW_DATATYPE_NUMBER, "");
			$sSqlWrk = "SELECT `id`, `Kode` AS `DispFld`, `Nama` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `v05_article`";
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
					$this->ArticleID->EditValue = $this->ArticleID->DisplayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ArticleID->EditValue = ew_HtmlEncode($this->ArticleID->CurrentValue);
				}
			} else {
				$this->ArticleID->EditValue = NULL;
			}
			$this->ArticleID->PlaceHolder = ew_RemoveHtml($this->ArticleID->FldCaption());

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
			// TglPO

			$this->TglPO->LinkCustomAttributes = "";
			$this->TglPO->HrefValue = "";

			// NoPO
			$this->NoPO->LinkCustomAttributes = "";
			$this->NoPO->HrefValue = "";

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

			// SubTotal
			$this->SubTotal->LinkCustomAttributes = "";
			$this->SubTotal->HrefValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// TglPO
			$this->TglPO->EditAttrs["class"] = "form-control";
			$this->TglPO->EditCustomAttributes = "";
			$this->TglPO->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->TglPO->CurrentValue, 7));
			$this->TglPO->PlaceHolder = ew_RemoveHtml($this->TglPO->FldCaption());

			// NoPO
			$this->NoPO->EditAttrs["class"] = "form-control";
			$this->NoPO->EditCustomAttributes = "";
			$this->NoPO->EditValue = ew_HtmlEncode($this->NoPO->CurrentValue);
			$this->NoPO->PlaceHolder = ew_RemoveHtml($this->NoPO->FldCaption());

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
			$this->ArticleID->EditAttrs["class"] = "form-control";
			$this->ArticleID->EditCustomAttributes = "";
			$this->ArticleID->EditValue = ew_HtmlEncode($this->ArticleID->CurrentValue);
			if (strval($this->ArticleID->CurrentValue) <> "") {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->ArticleID->CurrentValue, EW_DATATYPE_NUMBER, "");
			$sSqlWrk = "SELECT `id`, `Kode` AS `DispFld`, `Nama` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `v05_article`";
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
					$this->ArticleID->EditValue = $this->ArticleID->DisplayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ArticleID->EditValue = ew_HtmlEncode($this->ArticleID->CurrentValue);
				}
			} else {
				$this->ArticleID->EditValue = NULL;
			}
			$this->ArticleID->PlaceHolder = ew_RemoveHtml($this->ArticleID->FldCaption());

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

			// Edit refer script
			// TglPO

			$this->TglPO->LinkCustomAttributes = "";
			$this->TglPO->HrefValue = "";

			// NoPO
			$this->NoPO->LinkCustomAttributes = "";
			$this->NoPO->HrefValue = "";

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
		if (!$this->TglPO->FldIsDetailKey && !is_null($this->TglPO->FormValue) && $this->TglPO->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->TglPO->FldCaption(), $this->TglPO->ReqErrMsg));
		}
		if (!ew_CheckEuroDate($this->TglPO->FormValue)) {
			ew_AddMessage($gsFormError, $this->TglPO->FldErrMsg());
		}
		if (!$this->NoPO->FldIsDetailKey && !is_null($this->NoPO->FormValue) && $this->NoPO->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->NoPO->FldCaption(), $this->NoPO->ReqErrMsg));
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

			// TglPO
			$this->TglPO->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->TglPO->CurrentValue, 7), ew_CurrentDate(), $this->TglPO->ReadOnly);

			// NoPO
			$this->NoPO->SetDbValueDef($rsnew, $this->NoPO->CurrentValue, "", $this->NoPO->ReadOnly);

			// VendorID
			$this->VendorID->SetDbValueDef($rsnew, $this->VendorID->CurrentValue, 0, $this->VendorID->ReadOnly);

			// ArticleID
			$this->ArticleID->SetDbValueDef($rsnew, $this->ArticleID->CurrentValue, 0, $this->ArticleID->ReadOnly);

			// Harga
			$this->Harga->SetDbValueDef($rsnew, $this->Harga->CurrentValue, 0, $this->Harga->ReadOnly);

			// Qty
			$this->Qty->SetDbValueDef($rsnew, $this->Qty->CurrentValue, 0, $this->Qty->ReadOnly);

			// SatuanID
			$this->SatuanID->SetDbValueDef($rsnew, $this->SatuanID->CurrentValue, NULL, $this->SatuanID->ReadOnly);

			// SubTotal
			$this->SubTotal->SetDbValueDef($rsnew, $this->SubTotal->CurrentValue, 0, $this->SubTotal->ReadOnly);

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

	// Add record
	function AddRow($rsold = NULL) {
		global $Language, $Security;
		$conn = &$this->Connection();

		// Load db values from rsold
		$this->LoadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = array();

		// TglPO
		$this->TglPO->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->TglPO->CurrentValue, 7), ew_CurrentDate(), FALSE);

		// NoPO
		$this->NoPO->SetDbValueDef($rsnew, $this->NoPO->CurrentValue, "", FALSE);

		// VendorID
		$this->VendorID->SetDbValueDef($rsnew, $this->VendorID->CurrentValue, 0, FALSE);

		// ArticleID
		$this->ArticleID->SetDbValueDef($rsnew, $this->ArticleID->CurrentValue, 0, FALSE);

		// Harga
		$this->Harga->SetDbValueDef($rsnew, $this->Harga->CurrentValue, 0, strval($this->Harga->CurrentValue) == "");

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

	// Set up export options
	function SetupExportOptions() {
		global $Language;

		// Printer friendly
		$item = &$this->ExportOptions->Add("print");
		$item->Body = "<a href=\"" . $this->ExportPrintUrl . "\" class=\"ewExportLink ewPrint\" title=\"" . ew_HtmlEncode($Language->Phrase("PrinterFriendlyText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("PrinterFriendlyText")) . "\">" . $Language->Phrase("PrinterFriendly") . "</a>";
		$item->Visible = TRUE;

		// Export to Excel
		$item = &$this->ExportOptions->Add("excel");
		$item->Body = "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ewExportLink ewExcel\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToExcelText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToExcelText")) . "\">" . $Language->Phrase("ExportToExcel") . "</a>";
		$item->Visible = TRUE;

		// Export to Word
		$item = &$this->ExportOptions->Add("word");
		$item->Body = "<a href=\"" . $this->ExportWordUrl . "\" class=\"ewExportLink ewWord\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToWordText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToWordText")) . "\">" . $Language->Phrase("ExportToWord") . "</a>";
		$item->Visible = TRUE;

		// Export to Html
		$item = &$this->ExportOptions->Add("html");
		$item->Body = "<a href=\"" . $this->ExportHtmlUrl . "\" class=\"ewExportLink ewHtml\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToHtmlText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToHtmlText")) . "\">" . $Language->Phrase("ExportToHtml") . "</a>";
		$item->Visible = TRUE;

		// Export to Xml
		$item = &$this->ExportOptions->Add("xml");
		$item->Body = "<a href=\"" . $this->ExportXmlUrl . "\" class=\"ewExportLink ewXml\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToXmlText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToXmlText")) . "\">" . $Language->Phrase("ExportToXml") . "</a>";
		$item->Visible = TRUE;

		// Export to Csv
		$item = &$this->ExportOptions->Add("csv");
		$item->Body = "<a href=\"" . $this->ExportCsvUrl . "\" class=\"ewExportLink ewCsv\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToCsvText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToCsvText")) . "\">" . $Language->Phrase("ExportToCsv") . "</a>";
		$item->Visible = TRUE;

		// Export to Pdf
		$item = &$this->ExportOptions->Add("pdf");
		$item->Body = "<a href=\"" . $this->ExportPdfUrl . "\" class=\"ewExportLink ewPdf\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToPDFText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToPDFText")) . "\">" . $Language->Phrase("ExportToPDF") . "</a>";
		$item->Visible = FALSE;

		// Export to Email
		$item = &$this->ExportOptions->Add("email");
		$url = "";
		$item->Body = "<button id=\"emf_t08_beli\" class=\"ewExportLink ewEmail\" title=\"" . $Language->Phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->Phrase("ExportToEmailText") . "\" onclick=\"ew_EmailDialogShow({lnk:'emf_t08_beli',hdr:ewLanguage.Phrase('ExportToEmailText'),f:document.ft08_belilist,sel:false" . $url . "});\">" . $Language->Phrase("ExportToEmail") . "</button>";
		$item->Visible = TRUE;

		// Drop down button for export
		$this->ExportOptions->UseButtonGroup = TRUE;
		$this->ExportOptions->UseImageAndText = TRUE;
		$this->ExportOptions->UseDropDownButton = TRUE;
		if ($this->ExportOptions->UseButtonGroup && ew_IsMobile())
			$this->ExportOptions->UseDropDownButton = TRUE;
		$this->ExportOptions->DropDownButtonPhrase = $Language->Phrase("ButtonExport");

		// Add group option item
		$item = &$this->ExportOptions->Add($this->ExportOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	function ExportData() {
		$utf8 = (strtolower(EW_CHARSET) == "utf-8");
		$bSelectLimit = $this->UseSelectLimit;

		// Load recordset
		if ($bSelectLimit) {
			$this->TotalRecs = $this->ListRecordCount();
		} else {
			if (!$this->Recordset)
				$this->Recordset = $this->LoadRecordset();
			$rs = &$this->Recordset;
			if ($rs)
				$this->TotalRecs = $rs->RecordCount();
		}
		$this->StartRec = 1;

		// Export all
		if ($this->ExportAll) {
			set_time_limit(EW_EXPORT_ALL_TIME_LIMIT);
			$this->DisplayRecs = $this->TotalRecs;
			$this->StopRec = $this->TotalRecs;
		} else { // Export one page only
			$this->SetupStartRec(); // Set up start record position

			// Set the last record to display
			if ($this->DisplayRecs <= 0) {
				$this->StopRec = $this->TotalRecs;
			} else {
				$this->StopRec = $this->StartRec + $this->DisplayRecs - 1;
			}
		}
		if ($bSelectLimit)
			$rs = $this->LoadRecordset($this->StartRec-1, $this->DisplayRecs <= 0 ? $this->TotalRecs : $this->DisplayRecs);
		if (!$rs) {
			header("Content-Type:"); // Remove header
			header("Content-Disposition:");
			$this->ShowMessage();
			return;
		}
		$this->ExportDoc = ew_ExportDocument($this, "h");
		$Doc = &$this->ExportDoc;
		if ($bSelectLimit) {
			$this->StartRec = 1;
			$this->StopRec = $this->DisplayRecs <= 0 ? $this->TotalRecs : $this->DisplayRecs;
		} else {

			//$this->StartRec = $this->StartRec;
			//$this->StopRec = $this->StopRec;

		}

		// Call Page Exporting server event
		$this->ExportDoc->ExportCustom = !$this->Page_Exporting();
		$ParentTable = "";
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		$Doc->Text .= $sHeader;
		$this->ExportDocument($Doc, $rs, $this->StartRec, $this->StopRec, "");
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		$Doc->Text .= $sFooter;

		// Close recordset
		$rs->Close();

		// Call Page Exported server event
		$this->Page_Exported();

		// Export header and footer
		$Doc->ExportHeaderAndFooter();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED && $this->Export <> "pdf")
			echo ew_DebugMsg();

		// Output data
		if ($this->Export == "email") {
			echo $this->ExportEmail($Doc->Text);
		} else {
			$Doc->Export();
		}
	}

	// Export email
	function ExportEmail($EmailContent) {
		global $gTmpImages, $Language;
		$sSender = @$_POST["sender"];
		$sRecipient = @$_POST["recipient"];
		$sCc = @$_POST["cc"];
		$sBcc = @$_POST["bcc"];

		// Subject
		$sSubject = @$_POST["subject"];
		$sEmailSubject = $sSubject;

		// Message
		$sContent = @$_POST["message"];
		$sEmailMessage = $sContent;

		// Check sender
		if ($sSender == "") {
			return "<p class=\"text-danger\">" . $Language->Phrase("EnterSenderEmail") . "</p>";
		}
		if (!ew_CheckEmail($sSender)) {
			return "<p class=\"text-danger\">" . $Language->Phrase("EnterProperSenderEmail") . "</p>";
		}

		// Check recipient
		if (!ew_CheckEmailList($sRecipient, EW_MAX_EMAIL_RECIPIENT)) {
			return "<p class=\"text-danger\">" . $Language->Phrase("EnterProperRecipientEmail") . "</p>";
		}

		// Check cc
		if (!ew_CheckEmailList($sCc, EW_MAX_EMAIL_RECIPIENT)) {
			return "<p class=\"text-danger\">" . $Language->Phrase("EnterProperCcEmail") . "</p>";
		}

		// Check bcc
		if (!ew_CheckEmailList($sBcc, EW_MAX_EMAIL_RECIPIENT)) {
			return "<p class=\"text-danger\">" . $Language->Phrase("EnterProperBccEmail") . "</p>";
		}

		// Check email sent count
		if (!isset($_SESSION[EW_EXPORT_EMAIL_COUNTER]))
			$_SESSION[EW_EXPORT_EMAIL_COUNTER] = 0;
		if (intval($_SESSION[EW_EXPORT_EMAIL_COUNTER]) > EW_MAX_EMAIL_SENT_COUNT) {
			return "<p class=\"text-danger\">" . $Language->Phrase("ExceedMaxEmailExport") . "</p>";
		}

		// Send email
		$Email = new cEmail();
		$Email->Sender = $sSender; // Sender
		$Email->Recipient = $sRecipient; // Recipient
		$Email->Cc = $sCc; // Cc
		$Email->Bcc = $sBcc; // Bcc
		$Email->Subject = $sEmailSubject; // Subject
		$Email->Format = "html";
		if ($sEmailMessage <> "")
			$sEmailMessage = ew_RemoveXSS($sEmailMessage) . "<br><br>";
		foreach ($gTmpImages as $tmpimage)
			$Email->AddEmbeddedImage($tmpimage);
		$Email->Content = $sEmailMessage . ew_CleanEmailContent($EmailContent); // Content
		$EventArgs = array();
		if ($this->Recordset) {
			$this->RecCnt = $this->StartRec - 1;
			$this->Recordset->MoveFirst();
			if ($this->StartRec > 1)
				$this->Recordset->Move($this->StartRec - 1);
			$EventArgs["rs"] = &$this->Recordset;
		}
		$bEmailSent = FALSE;
		if ($this->Email_Sending($Email, $EventArgs))
			$bEmailSent = $Email->Send();

		// Check email sent status
		if ($bEmailSent) {

			// Update email sent count
			$_SESSION[EW_EXPORT_EMAIL_COUNTER]++;

			// Sent email success
			return "<p class=\"text-success\">" . $Language->Phrase("SendEmailSuccess") . "</p>"; // Set up success message
		} else {

			// Sent email failure
			return "<p class=\"text-danger\">" . $Email->SendErrDescription . "</p>";
		}
	}

	// Export QueryString
	function ExportQueryString() {

		// Initialize
		$sQry = "export=html";

		// Build QueryString for search
		// Build QueryString for pager

		$sQry .= "&" . EW_TABLE_REC_PER_PAGE . "=" . urlencode($this->getRecordsPerPage()) . "&" . EW_TABLE_START_REC . "=" . urlencode($this->getStartRecordNumber());
		return $sQry;
	}

	// Add search QueryString
	function AddSearchQueryString(&$Qry, &$Fld) {
		$FldSearchValue = $Fld->AdvancedSearch->getValue("x");
		$FldParm = substr($Fld->FldVar,2);
		if (strval($FldSearchValue) <> "") {
			$Qry .= "&x_" . $FldParm . "=" . urlencode($FldSearchValue) .
				"&z_" . $FldParm . "=" . urlencode($Fld->AdvancedSearch->getValue("z"));
		}
		$FldSearchValue2 = $Fld->AdvancedSearch->getValue("y");
		if (strval($FldSearchValue2) <> "") {
			$Qry .= "&v_" . $FldParm . "=" . urlencode($Fld->AdvancedSearch->getValue("v")) .
				"&y_" . $FldParm . "=" . urlencode($FldSearchValue2) .
				"&w_" . $FldParm . "=" . urlencode($Fld->AdvancedSearch->getValue("w"));
		}
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$Breadcrumb->Add("list", $this->TableVar, $url, "", $this->TableVar, TRUE);
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
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `Kode` AS `DispFld`, `Nama` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `v05_article`";
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
		case "x_ArticleID":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id`, `Kode` AS `DispFld`, `Nama` AS `Disp2Fld` FROM `v05_article`";
			$sWhereWrk = "`Kode` LIKE '{query_value}%' OR CONCAT(COALESCE(`Kode`, ''),'" . ew_ValueSeparator(1, $this->ArticleID) . "',COALESCE(`Nama`,'')) LIKE '{query_value}%'";
			$fld->LookupFilters = array("dx1" => '`Kode`', "dx2" => '`Nama`');
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->ArticleID, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
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

	// ListOptions Load event
	function ListOptions_Load() {

		// Example:
		//$opt = &$this->ListOptions->Add("new");
		//$opt->Header = "xxx";
		//$opt->OnLeft = TRUE; // Link on left
		//$opt->MoveTo(0); // Move to first column

	}

	// ListOptions Rendering event
	function ListOptions_Rendering() {

		//$GLOBALS["xxx_grid"]->DetailAdd = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailEdit = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailView = (...condition...); // Set to TRUE or FALSE conditionally

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example:
		//$this->ListOptions->Items["new"]->Body = "xxx";

	}

	// Row Custom Action event
	function Row_CustomAction($action, $row) {

		// Return FALSE to abort
		return TRUE;
	}

	// Page Exporting event
	// $this->ExportDoc = export document object
	function Page_Exporting() {

		//$this->ExportDoc->Text = "my header"; // Export header
		//return FALSE; // Return FALSE to skip default export and use Row_Export event

		return TRUE; // Return TRUE to use default export and skip Row_Export event
	}

	// Row Export event
	// $this->ExportDoc = export document object
	function Row_Export($rs) {

		//$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
	}

	// Page Exported event
	// $this->ExportDoc = export document object
	function Page_Exported() {

		//$this->ExportDoc->Text .= "my footer"; // Export footer
		//echo $this->ExportDoc->Text;

	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($t08_beli_list)) $t08_beli_list = new ct08_beli_list();

// Page init
$t08_beli_list->Page_Init();

// Page main
$t08_beli_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t08_beli_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($t08_beli->Export == "") { ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "list";
var CurrentForm = ft08_belilist = new ew_Form("ft08_belilist", "list");
ft08_belilist.FormKeyCountName = '<?php echo $t08_beli_list->FormKeyCountName ?>';

// Validate form
ft08_belilist.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_TglPO");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t08_beli->TglPO->FldCaption(), $t08_beli->TglPO->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_TglPO");
			if (elm && !ew_CheckEuroDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t08_beli->TglPO->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_NoPO");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t08_beli->NoPO->FldCaption(), $t08_beli->NoPO->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_VendorID");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t08_beli->VendorID->FldCaption(), $t08_beli->VendorID->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_ArticleID");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t08_beli->ArticleID->FldCaption(), $t08_beli->ArticleID->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Harga");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t08_beli->Harga->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Qty");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t08_beli->Qty->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_SubTotal");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t08_beli->SubTotal->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
ft08_belilist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ft08_belilist.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ft08_belilist.Lists["x_VendorID"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nama","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t02_vendor"};
ft08_belilist.Lists["x_VendorID"].Data = "<?php echo $t08_beli_list->VendorID->LookupFilterQuery(FALSE, "list") ?>";
ft08_belilist.Lists["x_ArticleID"] = {"LinkField":"x_id","Ajax":true,"AutoFill":true,"DisplayFields":["x_Kode","x_Nama","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"v05_article"};
ft08_belilist.Lists["x_ArticleID"].Data = "<?php echo $t08_beli_list->ArticleID->LookupFilterQuery(FALSE, "list") ?>";
ft08_belilist.AutoSuggests["x_ArticleID"] = <?php echo json_encode(array("data" => "ajax=autosuggest&" . $t08_beli_list->ArticleID->LookupFilterQuery(TRUE, "list"))) ?>;
ft08_belilist.Lists["x_SatuanID"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nama","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t07_satuan"};
ft08_belilist.Lists["x_SatuanID"].Data = "<?php echo $t08_beli_list->SatuanID->LookupFilterQuery(FALSE, "list") ?>";
ft08_belilist.AutoSuggests["x_SatuanID"] = <?php echo json_encode(array("data" => "ajax=autosuggest&" . $t08_beli_list->SatuanID->LookupFilterQuery(TRUE, "list"))) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if ($t08_beli->Export == "") { ?>
<div class="ewToolbar">
<?php if ($t08_beli_list->TotalRecs > 0 && $t08_beli_list->ExportOptions->Visible()) { ?>
<?php $t08_beli_list->ExportOptions->Render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
	$bSelectLimit = $t08_beli_list->UseSelectLimit;
	if ($bSelectLimit) {
		if ($t08_beli_list->TotalRecs <= 0)
			$t08_beli_list->TotalRecs = $t08_beli->ListRecordCount();
	} else {
		if (!$t08_beli_list->Recordset && ($t08_beli_list->Recordset = $t08_beli_list->LoadRecordset()))
			$t08_beli_list->TotalRecs = $t08_beli_list->Recordset->RecordCount();
	}
	$t08_beli_list->StartRec = 1;
	if ($t08_beli_list->DisplayRecs <= 0 || ($t08_beli->Export <> "" && $t08_beli->ExportAll)) // Display all records
		$t08_beli_list->DisplayRecs = $t08_beli_list->TotalRecs;
	if (!($t08_beli->Export <> "" && $t08_beli->ExportAll))
		$t08_beli_list->SetupStartRec(); // Set up start record position
	if ($bSelectLimit)
		$t08_beli_list->Recordset = $t08_beli_list->LoadRecordset($t08_beli_list->StartRec-1, $t08_beli_list->DisplayRecs);

	// Set no record found message
	if ($t08_beli->CurrentAction == "" && $t08_beli_list->TotalRecs == 0) {
		if (!$Security->CanList())
			$t08_beli_list->setWarningMessage(ew_DeniedMsg());
		if ($t08_beli_list->SearchWhere == "0=101")
			$t08_beli_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$t08_beli_list->setWarningMessage($Language->Phrase("NoRecord"));
	}
$t08_beli_list->RenderOtherOptions();
?>
<?php $t08_beli_list->ShowPageHeader(); ?>
<?php
$t08_beli_list->ShowMessage();
?>
<?php if ($t08_beli_list->TotalRecs > 0 || $t08_beli->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($t08_beli_list->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> t08_beli">
<?php if ($t08_beli->Export == "") { ?>
<div class="box-header ewGridUpperPanel">
<?php if ($t08_beli->CurrentAction <> "gridadd" && $t08_beli->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="form-inline ewForm ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($t08_beli_list->Pager)) $t08_beli_list->Pager = new cPrevNextPager($t08_beli_list->StartRec, $t08_beli_list->DisplayRecs, $t08_beli_list->TotalRecs, $t08_beli_list->AutoHidePager) ?>
<?php if ($t08_beli_list->Pager->RecordCount > 0 && $t08_beli_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($t08_beli_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $t08_beli_list->PageUrl() ?>start=<?php echo $t08_beli_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($t08_beli_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $t08_beli_list->PageUrl() ?>start=<?php echo $t08_beli_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $t08_beli_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($t08_beli_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $t08_beli_list->PageUrl() ?>start=<?php echo $t08_beli_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($t08_beli_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $t08_beli_list->PageUrl() ?>start=<?php echo $t08_beli_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $t08_beli_list->Pager->PageCount ?></span>
</div>
<?php } ?>
<?php if ($t08_beli_list->Pager->RecordCount > 0) { ?>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $t08_beli_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $t08_beli_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $t08_beli_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($t08_beli_list->TotalRecs > 0 && (!$t08_beli_list->AutoHidePageSizeSelector || $t08_beli_list->Pager->Visible)) { ?>
<div class="ewPager">
<input type="hidden" name="t" value="t08_beli">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" class="form-control input-sm ewTooltip" title="<?php echo $Language->Phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($t08_beli_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($t08_beli_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($t08_beli_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($t08_beli_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($t08_beli_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="ALL"<?php if ($t08_beli->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t08_beli_list->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft08_belilist" id="ft08_belilist" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t08_beli_list->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t08_beli_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t08_beli">
<div id="gmp_t08_beli" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<?php if ($t08_beli_list->TotalRecs > 0 || $t08_beli->CurrentAction == "add" || $t08_beli->CurrentAction == "copy" || $t08_beli->CurrentAction == "gridedit") { ?>
<table id="tbl_t08_belilist" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$t08_beli_list->RowType = EW_ROWTYPE_HEADER;

// Render list options
$t08_beli_list->RenderListOptions();

// Render list options (header, left)
$t08_beli_list->ListOptions->Render("header", "left");
?>
<?php if ($t08_beli->TglPO->Visible) { // TglPO ?>
	<?php if ($t08_beli->SortUrl($t08_beli->TglPO) == "") { ?>
		<th data-name="TglPO" class="<?php echo $t08_beli->TglPO->HeaderCellClass() ?>"><div id="elh_t08_beli_TglPO" class="t08_beli_TglPO"><div class="ewTableHeaderCaption"><?php echo $t08_beli->TglPO->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TglPO" class="<?php echo $t08_beli->TglPO->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t08_beli->SortUrl($t08_beli->TglPO) ?>',2);"><div id="elh_t08_beli_TglPO" class="t08_beli_TglPO">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t08_beli->TglPO->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t08_beli->TglPO->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t08_beli->TglPO->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t08_beli->NoPO->Visible) { // NoPO ?>
	<?php if ($t08_beli->SortUrl($t08_beli->NoPO) == "") { ?>
		<th data-name="NoPO" class="<?php echo $t08_beli->NoPO->HeaderCellClass() ?>"><div id="elh_t08_beli_NoPO" class="t08_beli_NoPO"><div class="ewTableHeaderCaption"><?php echo $t08_beli->NoPO->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NoPO" class="<?php echo $t08_beli->NoPO->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t08_beli->SortUrl($t08_beli->NoPO) ?>',2);"><div id="elh_t08_beli_NoPO" class="t08_beli_NoPO">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t08_beli->NoPO->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t08_beli->NoPO->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t08_beli->NoPO->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t08_beli->VendorID->Visible) { // VendorID ?>
	<?php if ($t08_beli->SortUrl($t08_beli->VendorID) == "") { ?>
		<th data-name="VendorID" class="<?php echo $t08_beli->VendorID->HeaderCellClass() ?>"><div id="elh_t08_beli_VendorID" class="t08_beli_VendorID"><div class="ewTableHeaderCaption"><?php echo $t08_beli->VendorID->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="VendorID" class="<?php echo $t08_beli->VendorID->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t08_beli->SortUrl($t08_beli->VendorID) ?>',2);"><div id="elh_t08_beli_VendorID" class="t08_beli_VendorID">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t08_beli->VendorID->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t08_beli->VendorID->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t08_beli->VendorID->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t08_beli->ArticleID->Visible) { // ArticleID ?>
	<?php if ($t08_beli->SortUrl($t08_beli->ArticleID) == "") { ?>
		<th data-name="ArticleID" class="<?php echo $t08_beli->ArticleID->HeaderCellClass() ?>"><div id="elh_t08_beli_ArticleID" class="t08_beli_ArticleID"><div class="ewTableHeaderCaption"><?php echo $t08_beli->ArticleID->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ArticleID" class="<?php echo $t08_beli->ArticleID->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t08_beli->SortUrl($t08_beli->ArticleID) ?>',2);"><div id="elh_t08_beli_ArticleID" class="t08_beli_ArticleID">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t08_beli->ArticleID->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t08_beli->ArticleID->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t08_beli->ArticleID->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t08_beli->Harga->Visible) { // Harga ?>
	<?php if ($t08_beli->SortUrl($t08_beli->Harga) == "") { ?>
		<th data-name="Harga" class="<?php echo $t08_beli->Harga->HeaderCellClass() ?>"><div id="elh_t08_beli_Harga" class="t08_beli_Harga"><div class="ewTableHeaderCaption"><?php echo $t08_beli->Harga->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Harga" class="<?php echo $t08_beli->Harga->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t08_beli->SortUrl($t08_beli->Harga) ?>',2);"><div id="elh_t08_beli_Harga" class="t08_beli_Harga">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t08_beli->Harga->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t08_beli->Harga->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t08_beli->Harga->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t08_beli->Qty->Visible) { // Qty ?>
	<?php if ($t08_beli->SortUrl($t08_beli->Qty) == "") { ?>
		<th data-name="Qty" class="<?php echo $t08_beli->Qty->HeaderCellClass() ?>"><div id="elh_t08_beli_Qty" class="t08_beli_Qty"><div class="ewTableHeaderCaption"><?php echo $t08_beli->Qty->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Qty" class="<?php echo $t08_beli->Qty->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t08_beli->SortUrl($t08_beli->Qty) ?>',2);"><div id="elh_t08_beli_Qty" class="t08_beli_Qty">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t08_beli->Qty->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t08_beli->Qty->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t08_beli->Qty->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t08_beli->SatuanID->Visible) { // SatuanID ?>
	<?php if ($t08_beli->SortUrl($t08_beli->SatuanID) == "") { ?>
		<th data-name="SatuanID" class="<?php echo $t08_beli->SatuanID->HeaderCellClass() ?>"><div id="elh_t08_beli_SatuanID" class="t08_beli_SatuanID"><div class="ewTableHeaderCaption"><?php echo $t08_beli->SatuanID->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SatuanID" class="<?php echo $t08_beli->SatuanID->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t08_beli->SortUrl($t08_beli->SatuanID) ?>',2);"><div id="elh_t08_beli_SatuanID" class="t08_beli_SatuanID">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t08_beli->SatuanID->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t08_beli->SatuanID->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t08_beli->SatuanID->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t08_beli->SubTotal->Visible) { // SubTotal ?>
	<?php if ($t08_beli->SortUrl($t08_beli->SubTotal) == "") { ?>
		<th data-name="SubTotal" class="<?php echo $t08_beli->SubTotal->HeaderCellClass() ?>"><div id="elh_t08_beli_SubTotal" class="t08_beli_SubTotal"><div class="ewTableHeaderCaption"><?php echo $t08_beli->SubTotal->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SubTotal" class="<?php echo $t08_beli->SubTotal->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t08_beli->SortUrl($t08_beli->SubTotal) ?>',2);"><div id="elh_t08_beli_SubTotal" class="t08_beli_SubTotal">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t08_beli->SubTotal->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t08_beli->SubTotal->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t08_beli->SubTotal->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t08_beli_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($t08_beli->CurrentAction == "add" || $t08_beli->CurrentAction == "copy") {
		$t08_beli_list->RowIndex = 0;
		$t08_beli_list->KeyCount = $t08_beli_list->RowIndex;
		if ($t08_beli->CurrentAction == "add")
			$t08_beli_list->LoadRowValues();
		if ($t08_beli->EventCancelled) // Insert failed
			$t08_beli_list->RestoreFormValues(); // Restore form values

		// Set row properties
		$t08_beli->ResetAttrs();
		$t08_beli->RowAttrs = array_merge($t08_beli->RowAttrs, array('data-rowindex'=>0, 'id'=>'r0_t08_beli', 'data-rowtype'=>EW_ROWTYPE_ADD));
		$t08_beli->RowType = EW_ROWTYPE_ADD;

		// Render row
		$t08_beli_list->RenderRow();

		// Render list options
		$t08_beli_list->RenderListOptions();
		$t08_beli_list->StartRowCnt = 0;
?>
	<tr<?php echo $t08_beli->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t08_beli_list->ListOptions->Render("body", "left", $t08_beli_list->RowCnt);
?>
	<?php if ($t08_beli->TglPO->Visible) { // TglPO ?>
		<td data-name="TglPO">
<span id="el<?php echo $t08_beli_list->RowCnt ?>_t08_beli_TglPO" class="form-group t08_beli_TglPO">
<input type="text" data-table="t08_beli" data-field="x_TglPO" data-format="7" name="x<?php echo $t08_beli_list->RowIndex ?>_TglPO" id="x<?php echo $t08_beli_list->RowIndex ?>_TglPO" size="7" placeholder="<?php echo ew_HtmlEncode($t08_beli->TglPO->getPlaceHolder()) ?>" value="<?php echo $t08_beli->TglPO->EditValue ?>"<?php echo $t08_beli->TglPO->EditAttributes() ?>>
<?php if (!$t08_beli->TglPO->ReadOnly && !$t08_beli->TglPO->Disabled && !isset($t08_beli->TglPO->EditAttrs["readonly"]) && !isset($t08_beli->TglPO->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("ft08_belilist", "x<?php echo $t08_beli_list->RowIndex ?>_TglPO", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="t08_beli" data-field="x_TglPO" name="o<?php echo $t08_beli_list->RowIndex ?>_TglPO" id="o<?php echo $t08_beli_list->RowIndex ?>_TglPO" value="<?php echo ew_HtmlEncode($t08_beli->TglPO->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t08_beli->NoPO->Visible) { // NoPO ?>
		<td data-name="NoPO">
<span id="el<?php echo $t08_beli_list->RowCnt ?>_t08_beli_NoPO" class="form-group t08_beli_NoPO">
<input type="text" data-table="t08_beli" data-field="x_NoPO" name="x<?php echo $t08_beli_list->RowIndex ?>_NoPO" id="x<?php echo $t08_beli_list->RowIndex ?>_NoPO" size="15" maxlength="14" placeholder="<?php echo ew_HtmlEncode($t08_beli->NoPO->getPlaceHolder()) ?>" value="<?php echo $t08_beli->NoPO->EditValue ?>"<?php echo $t08_beli->NoPO->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t08_beli" data-field="x_NoPO" name="o<?php echo $t08_beli_list->RowIndex ?>_NoPO" id="o<?php echo $t08_beli_list->RowIndex ?>_NoPO" value="<?php echo ew_HtmlEncode($t08_beli->NoPO->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t08_beli->VendorID->Visible) { // VendorID ?>
		<td data-name="VendorID">
<span id="el<?php echo $t08_beli_list->RowCnt ?>_t08_beli_VendorID" class="form-group t08_beli_VendorID">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $t08_beli_list->RowIndex ?>_VendorID"><?php echo (strval($t08_beli->VendorID->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t08_beli->VendorID->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t08_beli->VendorID->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t08_beli_list->RowIndex ?>_VendorID',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($t08_beli->VendorID->ReadOnly || $t08_beli->VendorID->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t08_beli" data-field="x_VendorID" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t08_beli->VendorID->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t08_beli_list->RowIndex ?>_VendorID" id="x<?php echo $t08_beli_list->RowIndex ?>_VendorID" value="<?php echo $t08_beli->VendorID->CurrentValue ?>"<?php echo $t08_beli->VendorID->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t08_beli" data-field="x_VendorID" name="o<?php echo $t08_beli_list->RowIndex ?>_VendorID" id="o<?php echo $t08_beli_list->RowIndex ?>_VendorID" value="<?php echo ew_HtmlEncode($t08_beli->VendorID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t08_beli->ArticleID->Visible) { // ArticleID ?>
		<td data-name="ArticleID">
<span id="el<?php echo $t08_beli_list->RowCnt ?>_t08_beli_ArticleID" class="form-group t08_beli_ArticleID">
<?php
$wrkonchange = trim("ew_AutoFill(this); " . @$t08_beli->ArticleID->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$t08_beli->ArticleID->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t08_beli_list->RowIndex ?>_ArticleID" style="white-space: nowrap; z-index: <?php echo (9000 - $t08_beli_list->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $t08_beli_list->RowIndex ?>_ArticleID" id="sv_x<?php echo $t08_beli_list->RowIndex ?>_ArticleID" value="<?php echo $t08_beli->ArticleID->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($t08_beli->ArticleID->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($t08_beli->ArticleID->getPlaceHolder()) ?>"<?php echo $t08_beli->ArticleID->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t08_beli" data-field="x_ArticleID" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t08_beli->ArticleID->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t08_beli_list->RowIndex ?>_ArticleID" id="x<?php echo $t08_beli_list->RowIndex ?>_ArticleID" value="<?php echo ew_HtmlEncode($t08_beli->ArticleID->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script type="text/javascript">
ft08_belilist.CreateAutoSuggest({"id":"x<?php echo $t08_beli_list->RowIndex ?>_ArticleID","forceSelect":true});
</script>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t08_beli->ArticleID->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t08_beli_list->RowIndex ?>_ArticleID',m:0,n:10,srch:false});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($t08_beli->ArticleID->ReadOnly || $t08_beli->ArticleID->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" name="ln_x<?php echo $t08_beli_list->RowIndex ?>_ArticleID" id="ln_x<?php echo $t08_beli_list->RowIndex ?>_ArticleID" value="x<?php echo $t08_beli_list->RowIndex ?>_Harga,x<?php echo $t08_beli_list->RowIndex ?>_SatuanID">
</span>
<input type="hidden" data-table="t08_beli" data-field="x_ArticleID" name="o<?php echo $t08_beli_list->RowIndex ?>_ArticleID" id="o<?php echo $t08_beli_list->RowIndex ?>_ArticleID" value="<?php echo ew_HtmlEncode($t08_beli->ArticleID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t08_beli->Harga->Visible) { // Harga ?>
		<td data-name="Harga">
<span id="el<?php echo $t08_beli_list->RowCnt ?>_t08_beli_Harga" class="form-group t08_beli_Harga">
<input type="text" data-table="t08_beli" data-field="x_Harga" name="x<?php echo $t08_beli_list->RowIndex ?>_Harga" id="x<?php echo $t08_beli_list->RowIndex ?>_Harga" size="7" placeholder="<?php echo ew_HtmlEncode($t08_beli->Harga->getPlaceHolder()) ?>" value="<?php echo $t08_beli->Harga->EditValue ?>"<?php echo $t08_beli->Harga->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t08_beli" data-field="x_Harga" name="o<?php echo $t08_beli_list->RowIndex ?>_Harga" id="o<?php echo $t08_beli_list->RowIndex ?>_Harga" value="<?php echo ew_HtmlEncode($t08_beli->Harga->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t08_beli->Qty->Visible) { // Qty ?>
		<td data-name="Qty">
<span id="el<?php echo $t08_beli_list->RowCnt ?>_t08_beli_Qty" class="form-group t08_beli_Qty">
<input type="text" data-table="t08_beli" data-field="x_Qty" name="x<?php echo $t08_beli_list->RowIndex ?>_Qty" id="x<?php echo $t08_beli_list->RowIndex ?>_Qty" size="2" placeholder="<?php echo ew_HtmlEncode($t08_beli->Qty->getPlaceHolder()) ?>" value="<?php echo $t08_beli->Qty->EditValue ?>"<?php echo $t08_beli->Qty->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t08_beli" data-field="x_Qty" name="o<?php echo $t08_beli_list->RowIndex ?>_Qty" id="o<?php echo $t08_beli_list->RowIndex ?>_Qty" value="<?php echo ew_HtmlEncode($t08_beli->Qty->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t08_beli->SatuanID->Visible) { // SatuanID ?>
		<td data-name="SatuanID">
<span id="el<?php echo $t08_beli_list->RowCnt ?>_t08_beli_SatuanID" class="form-group t08_beli_SatuanID">
<?php
$wrkonchange = trim(" " . @$t08_beli->SatuanID->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$t08_beli->SatuanID->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t08_beli_list->RowIndex ?>_SatuanID" style="white-space: nowrap; z-index: <?php echo (9000 - $t08_beli_list->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $t08_beli_list->RowIndex ?>_SatuanID" id="sv_x<?php echo $t08_beli_list->RowIndex ?>_SatuanID" value="<?php echo $t08_beli->SatuanID->EditValue ?>" size="3" placeholder="<?php echo ew_HtmlEncode($t08_beli->SatuanID->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($t08_beli->SatuanID->getPlaceHolder()) ?>"<?php echo $t08_beli->SatuanID->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t08_beli" data-field="x_SatuanID" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t08_beli->SatuanID->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t08_beli_list->RowIndex ?>_SatuanID" id="x<?php echo $t08_beli_list->RowIndex ?>_SatuanID" value="<?php echo ew_HtmlEncode($t08_beli->SatuanID->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script type="text/javascript">
ft08_belilist.CreateAutoSuggest({"id":"x<?php echo $t08_beli_list->RowIndex ?>_SatuanID","forceSelect":true});
</script>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t08_beli->SatuanID->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t08_beli_list->RowIndex ?>_SatuanID',m:0,n:10,srch:false});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($t08_beli->SatuanID->ReadOnly || $t08_beli->SatuanID->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
</span>
<input type="hidden" data-table="t08_beli" data-field="x_SatuanID" name="o<?php echo $t08_beli_list->RowIndex ?>_SatuanID" id="o<?php echo $t08_beli_list->RowIndex ?>_SatuanID" value="<?php echo ew_HtmlEncode($t08_beli->SatuanID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t08_beli->SubTotal->Visible) { // SubTotal ?>
		<td data-name="SubTotal">
<span id="el<?php echo $t08_beli_list->RowCnt ?>_t08_beli_SubTotal" class="form-group t08_beli_SubTotal">
<input type="text" data-table="t08_beli" data-field="x_SubTotal" name="x<?php echo $t08_beli_list->RowIndex ?>_SubTotal" id="x<?php echo $t08_beli_list->RowIndex ?>_SubTotal" size="10" placeholder="<?php echo ew_HtmlEncode($t08_beli->SubTotal->getPlaceHolder()) ?>" value="<?php echo $t08_beli->SubTotal->EditValue ?>"<?php echo $t08_beli->SubTotal->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t08_beli" data-field="x_SubTotal" name="o<?php echo $t08_beli_list->RowIndex ?>_SubTotal" id="o<?php echo $t08_beli_list->RowIndex ?>_SubTotal" value="<?php echo ew_HtmlEncode($t08_beli->SubTotal->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t08_beli_list->ListOptions->Render("body", "right", $t08_beli_list->RowCnt);
?>
<script type="text/javascript">
ft08_belilist.UpdateOpts(<?php echo $t08_beli_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
<?php
if ($t08_beli->ExportAll && $t08_beli->Export <> "") {
	$t08_beli_list->StopRec = $t08_beli_list->TotalRecs;
} else {

	// Set the last record to display
	if ($t08_beli_list->TotalRecs > $t08_beli_list->StartRec + $t08_beli_list->DisplayRecs - 1)
		$t08_beli_list->StopRec = $t08_beli_list->StartRec + $t08_beli_list->DisplayRecs - 1;
	else
		$t08_beli_list->StopRec = $t08_beli_list->TotalRecs;
}

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($t08_beli_list->FormKeyCountName) && ($t08_beli->CurrentAction == "gridadd" || $t08_beli->CurrentAction == "gridedit" || $t08_beli->CurrentAction == "F")) {
		$t08_beli_list->KeyCount = $objForm->GetValue($t08_beli_list->FormKeyCountName);
		$t08_beli_list->StopRec = $t08_beli_list->StartRec + $t08_beli_list->KeyCount - 1;
	}
}
$t08_beli_list->RecCnt = $t08_beli_list->StartRec - 1;
if ($t08_beli_list->Recordset && !$t08_beli_list->Recordset->EOF) {
	$t08_beli_list->Recordset->MoveFirst();
	$bSelectLimit = $t08_beli_list->UseSelectLimit;
	if (!$bSelectLimit && $t08_beli_list->StartRec > 1)
		$t08_beli_list->Recordset->Move($t08_beli_list->StartRec - 1);
} elseif (!$t08_beli->AllowAddDeleteRow && $t08_beli_list->StopRec == 0) {
	$t08_beli_list->StopRec = $t08_beli->GridAddRowCount;
}

// Initialize aggregate
$t08_beli->RowType = EW_ROWTYPE_AGGREGATEINIT;
$t08_beli->ResetAttrs();
$t08_beli_list->RenderRow();
$t08_beli_list->EditRowCnt = 0;
if ($t08_beli->CurrentAction == "edit")
	$t08_beli_list->RowIndex = 1;
while ($t08_beli_list->RecCnt < $t08_beli_list->StopRec) {
	$t08_beli_list->RecCnt++;
	if (intval($t08_beli_list->RecCnt) >= intval($t08_beli_list->StartRec)) {
		$t08_beli_list->RowCnt++;

		// Set up key count
		$t08_beli_list->KeyCount = $t08_beli_list->RowIndex;

		// Init row class and style
		$t08_beli->ResetAttrs();
		$t08_beli->CssClass = "";
		if ($t08_beli->CurrentAction == "gridadd") {
			$t08_beli_list->LoadRowValues(); // Load default values
		} else {
			$t08_beli_list->LoadRowValues($t08_beli_list->Recordset); // Load row values
		}
		$t08_beli->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($t08_beli->CurrentAction == "edit") {
			if ($t08_beli_list->CheckInlineEditKey() && $t08_beli_list->EditRowCnt == 0) { // Inline edit
				$t08_beli->RowType = EW_ROWTYPE_EDIT; // Render edit
			}
		}
		if ($t08_beli->CurrentAction == "edit" && $t08_beli->RowType == EW_ROWTYPE_EDIT && $t08_beli->EventCancelled) { // Update failed
			$objForm->Index = 1;
			$t08_beli_list->RestoreFormValues(); // Restore form values
		}
		if ($t08_beli->RowType == EW_ROWTYPE_EDIT) // Edit row
			$t08_beli_list->EditRowCnt++;

		// Set up row id / data-rowindex
		$t08_beli->RowAttrs = array_merge($t08_beli->RowAttrs, array('data-rowindex'=>$t08_beli_list->RowCnt, 'id'=>'r' . $t08_beli_list->RowCnt . '_t08_beli', 'data-rowtype'=>$t08_beli->RowType));

		// Render row
		$t08_beli_list->RenderRow();

		// Render list options
		$t08_beli_list->RenderListOptions();
?>
	<tr<?php echo $t08_beli->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t08_beli_list->ListOptions->Render("body", "left", $t08_beli_list->RowCnt);
?>
	<?php if ($t08_beli->TglPO->Visible) { // TglPO ?>
		<td data-name="TglPO"<?php echo $t08_beli->TglPO->CellAttributes() ?>>
<?php if ($t08_beli->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t08_beli_list->RowCnt ?>_t08_beli_TglPO" class="form-group t08_beli_TglPO">
<input type="text" data-table="t08_beli" data-field="x_TglPO" data-format="7" name="x<?php echo $t08_beli_list->RowIndex ?>_TglPO" id="x<?php echo $t08_beli_list->RowIndex ?>_TglPO" size="7" placeholder="<?php echo ew_HtmlEncode($t08_beli->TglPO->getPlaceHolder()) ?>" value="<?php echo $t08_beli->TglPO->EditValue ?>"<?php echo $t08_beli->TglPO->EditAttributes() ?>>
<?php if (!$t08_beli->TglPO->ReadOnly && !$t08_beli->TglPO->Disabled && !isset($t08_beli->TglPO->EditAttrs["readonly"]) && !isset($t08_beli->TglPO->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("ft08_belilist", "x<?php echo $t08_beli_list->RowIndex ?>_TglPO", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($t08_beli->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t08_beli_list->RowCnt ?>_t08_beli_TglPO" class="t08_beli_TglPO">
<span<?php echo $t08_beli->TglPO->ViewAttributes() ?>>
<?php echo $t08_beli->TglPO->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php if ($t08_beli->RowType == EW_ROWTYPE_EDIT || $t08_beli->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t08_beli" data-field="x_id" name="x<?php echo $t08_beli_list->RowIndex ?>_id" id="x<?php echo $t08_beli_list->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t08_beli->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($t08_beli->NoPO->Visible) { // NoPO ?>
		<td data-name="NoPO"<?php echo $t08_beli->NoPO->CellAttributes() ?>>
<?php if ($t08_beli->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t08_beli_list->RowCnt ?>_t08_beli_NoPO" class="form-group t08_beli_NoPO">
<input type="text" data-table="t08_beli" data-field="x_NoPO" name="x<?php echo $t08_beli_list->RowIndex ?>_NoPO" id="x<?php echo $t08_beli_list->RowIndex ?>_NoPO" size="15" maxlength="14" placeholder="<?php echo ew_HtmlEncode($t08_beli->NoPO->getPlaceHolder()) ?>" value="<?php echo $t08_beli->NoPO->EditValue ?>"<?php echo $t08_beli->NoPO->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t08_beli->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t08_beli_list->RowCnt ?>_t08_beli_NoPO" class="t08_beli_NoPO">
<span<?php echo $t08_beli->NoPO->ViewAttributes() ?>>
<?php echo $t08_beli->NoPO->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t08_beli->VendorID->Visible) { // VendorID ?>
		<td data-name="VendorID"<?php echo $t08_beli->VendorID->CellAttributes() ?>>
<?php if ($t08_beli->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t08_beli_list->RowCnt ?>_t08_beli_VendorID" class="form-group t08_beli_VendorID">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $t08_beli_list->RowIndex ?>_VendorID"><?php echo (strval($t08_beli->VendorID->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t08_beli->VendorID->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t08_beli->VendorID->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t08_beli_list->RowIndex ?>_VendorID',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($t08_beli->VendorID->ReadOnly || $t08_beli->VendorID->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t08_beli" data-field="x_VendorID" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t08_beli->VendorID->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t08_beli_list->RowIndex ?>_VendorID" id="x<?php echo $t08_beli_list->RowIndex ?>_VendorID" value="<?php echo $t08_beli->VendorID->CurrentValue ?>"<?php echo $t08_beli->VendorID->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t08_beli->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t08_beli_list->RowCnt ?>_t08_beli_VendorID" class="t08_beli_VendorID">
<span<?php echo $t08_beli->VendorID->ViewAttributes() ?>>
<?php echo $t08_beli->VendorID->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t08_beli->ArticleID->Visible) { // ArticleID ?>
		<td data-name="ArticleID"<?php echo $t08_beli->ArticleID->CellAttributes() ?>>
<?php if ($t08_beli->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t08_beli_list->RowCnt ?>_t08_beli_ArticleID" class="form-group t08_beli_ArticleID">
<?php
$wrkonchange = trim("ew_AutoFill(this); " . @$t08_beli->ArticleID->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$t08_beli->ArticleID->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t08_beli_list->RowIndex ?>_ArticleID" style="white-space: nowrap; z-index: <?php echo (9000 - $t08_beli_list->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $t08_beli_list->RowIndex ?>_ArticleID" id="sv_x<?php echo $t08_beli_list->RowIndex ?>_ArticleID" value="<?php echo $t08_beli->ArticleID->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($t08_beli->ArticleID->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($t08_beli->ArticleID->getPlaceHolder()) ?>"<?php echo $t08_beli->ArticleID->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t08_beli" data-field="x_ArticleID" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t08_beli->ArticleID->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t08_beli_list->RowIndex ?>_ArticleID" id="x<?php echo $t08_beli_list->RowIndex ?>_ArticleID" value="<?php echo ew_HtmlEncode($t08_beli->ArticleID->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script type="text/javascript">
ft08_belilist.CreateAutoSuggest({"id":"x<?php echo $t08_beli_list->RowIndex ?>_ArticleID","forceSelect":true});
</script>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t08_beli->ArticleID->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t08_beli_list->RowIndex ?>_ArticleID',m:0,n:10,srch:false});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($t08_beli->ArticleID->ReadOnly || $t08_beli->ArticleID->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" name="ln_x<?php echo $t08_beli_list->RowIndex ?>_ArticleID" id="ln_x<?php echo $t08_beli_list->RowIndex ?>_ArticleID" value="x<?php echo $t08_beli_list->RowIndex ?>_Harga,x<?php echo $t08_beli_list->RowIndex ?>_SatuanID">
</span>
<?php } ?>
<?php if ($t08_beli->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t08_beli_list->RowCnt ?>_t08_beli_ArticleID" class="t08_beli_ArticleID">
<span<?php echo $t08_beli->ArticleID->ViewAttributes() ?>>
<?php echo $t08_beli->ArticleID->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t08_beli->Harga->Visible) { // Harga ?>
		<td data-name="Harga"<?php echo $t08_beli->Harga->CellAttributes() ?>>
<?php if ($t08_beli->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t08_beli_list->RowCnt ?>_t08_beli_Harga" class="form-group t08_beli_Harga">
<input type="text" data-table="t08_beli" data-field="x_Harga" name="x<?php echo $t08_beli_list->RowIndex ?>_Harga" id="x<?php echo $t08_beli_list->RowIndex ?>_Harga" size="7" placeholder="<?php echo ew_HtmlEncode($t08_beli->Harga->getPlaceHolder()) ?>" value="<?php echo $t08_beli->Harga->EditValue ?>"<?php echo $t08_beli->Harga->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t08_beli->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t08_beli_list->RowCnt ?>_t08_beli_Harga" class="t08_beli_Harga">
<span<?php echo $t08_beli->Harga->ViewAttributes() ?>>
<?php echo $t08_beli->Harga->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t08_beli->Qty->Visible) { // Qty ?>
		<td data-name="Qty"<?php echo $t08_beli->Qty->CellAttributes() ?>>
<?php if ($t08_beli->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t08_beli_list->RowCnt ?>_t08_beli_Qty" class="form-group t08_beli_Qty">
<input type="text" data-table="t08_beli" data-field="x_Qty" name="x<?php echo $t08_beli_list->RowIndex ?>_Qty" id="x<?php echo $t08_beli_list->RowIndex ?>_Qty" size="2" placeholder="<?php echo ew_HtmlEncode($t08_beli->Qty->getPlaceHolder()) ?>" value="<?php echo $t08_beli->Qty->EditValue ?>"<?php echo $t08_beli->Qty->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t08_beli->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t08_beli_list->RowCnt ?>_t08_beli_Qty" class="t08_beli_Qty">
<span<?php echo $t08_beli->Qty->ViewAttributes() ?>>
<?php echo $t08_beli->Qty->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t08_beli->SatuanID->Visible) { // SatuanID ?>
		<td data-name="SatuanID"<?php echo $t08_beli->SatuanID->CellAttributes() ?>>
<?php if ($t08_beli->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t08_beli_list->RowCnt ?>_t08_beli_SatuanID" class="form-group t08_beli_SatuanID">
<?php
$wrkonchange = trim(" " . @$t08_beli->SatuanID->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$t08_beli->SatuanID->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t08_beli_list->RowIndex ?>_SatuanID" style="white-space: nowrap; z-index: <?php echo (9000 - $t08_beli_list->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $t08_beli_list->RowIndex ?>_SatuanID" id="sv_x<?php echo $t08_beli_list->RowIndex ?>_SatuanID" value="<?php echo $t08_beli->SatuanID->EditValue ?>" size="3" placeholder="<?php echo ew_HtmlEncode($t08_beli->SatuanID->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($t08_beli->SatuanID->getPlaceHolder()) ?>"<?php echo $t08_beli->SatuanID->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t08_beli" data-field="x_SatuanID" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t08_beli->SatuanID->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t08_beli_list->RowIndex ?>_SatuanID" id="x<?php echo $t08_beli_list->RowIndex ?>_SatuanID" value="<?php echo ew_HtmlEncode($t08_beli->SatuanID->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script type="text/javascript">
ft08_belilist.CreateAutoSuggest({"id":"x<?php echo $t08_beli_list->RowIndex ?>_SatuanID","forceSelect":true});
</script>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t08_beli->SatuanID->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t08_beli_list->RowIndex ?>_SatuanID',m:0,n:10,srch:false});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($t08_beli->SatuanID->ReadOnly || $t08_beli->SatuanID->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
</span>
<?php } ?>
<?php if ($t08_beli->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t08_beli_list->RowCnt ?>_t08_beli_SatuanID" class="t08_beli_SatuanID">
<span<?php echo $t08_beli->SatuanID->ViewAttributes() ?>>
<?php echo $t08_beli->SatuanID->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t08_beli->SubTotal->Visible) { // SubTotal ?>
		<td data-name="SubTotal"<?php echo $t08_beli->SubTotal->CellAttributes() ?>>
<?php if ($t08_beli->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t08_beli_list->RowCnt ?>_t08_beli_SubTotal" class="form-group t08_beli_SubTotal">
<input type="text" data-table="t08_beli" data-field="x_SubTotal" name="x<?php echo $t08_beli_list->RowIndex ?>_SubTotal" id="x<?php echo $t08_beli_list->RowIndex ?>_SubTotal" size="10" placeholder="<?php echo ew_HtmlEncode($t08_beli->SubTotal->getPlaceHolder()) ?>" value="<?php echo $t08_beli->SubTotal->EditValue ?>"<?php echo $t08_beli->SubTotal->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t08_beli->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t08_beli_list->RowCnt ?>_t08_beli_SubTotal" class="t08_beli_SubTotal">
<span<?php echo $t08_beli->SubTotal->ViewAttributes() ?>>
<?php echo $t08_beli->SubTotal->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t08_beli_list->ListOptions->Render("body", "right", $t08_beli_list->RowCnt);
?>
	</tr>
<?php if ($t08_beli->RowType == EW_ROWTYPE_ADD || $t08_beli->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
ft08_belilist.UpdateOpts(<?php echo $t08_beli_list->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	if ($t08_beli->CurrentAction <> "gridadd")
		$t08_beli_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($t08_beli->CurrentAction == "add" || $t08_beli->CurrentAction == "copy") { ?>
<input type="hidden" name="<?php echo $t08_beli_list->FormKeyCountName ?>" id="<?php echo $t08_beli_list->FormKeyCountName ?>" value="<?php echo $t08_beli_list->KeyCount ?>">
<?php } ?>
<?php if ($t08_beli->CurrentAction == "edit") { ?>
<input type="hidden" name="<?php echo $t08_beli_list->FormKeyCountName ?>" id="<?php echo $t08_beli_list->FormKeyCountName ?>" value="<?php echo $t08_beli_list->KeyCount ?>">
<?php } ?>
<?php if ($t08_beli->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($t08_beli_list->Recordset)
	$t08_beli_list->Recordset->Close();
?>
<?php if ($t08_beli->Export == "") { ?>
<div class="box-footer ewGridLowerPanel">
<?php if ($t08_beli->CurrentAction <> "gridadd" && $t08_beli->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-inline ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($t08_beli_list->Pager)) $t08_beli_list->Pager = new cPrevNextPager($t08_beli_list->StartRec, $t08_beli_list->DisplayRecs, $t08_beli_list->TotalRecs, $t08_beli_list->AutoHidePager) ?>
<?php if ($t08_beli_list->Pager->RecordCount > 0 && $t08_beli_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($t08_beli_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $t08_beli_list->PageUrl() ?>start=<?php echo $t08_beli_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($t08_beli_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $t08_beli_list->PageUrl() ?>start=<?php echo $t08_beli_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $t08_beli_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($t08_beli_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $t08_beli_list->PageUrl() ?>start=<?php echo $t08_beli_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($t08_beli_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $t08_beli_list->PageUrl() ?>start=<?php echo $t08_beli_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $t08_beli_list->Pager->PageCount ?></span>
</div>
<?php } ?>
<?php if ($t08_beli_list->Pager->RecordCount > 0) { ?>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $t08_beli_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $t08_beli_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $t08_beli_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($t08_beli_list->TotalRecs > 0 && (!$t08_beli_list->AutoHidePageSizeSelector || $t08_beli_list->Pager->Visible)) { ?>
<div class="ewPager">
<input type="hidden" name="t" value="t08_beli">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" class="form-control input-sm ewTooltip" title="<?php echo $Language->Phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($t08_beli_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($t08_beli_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($t08_beli_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($t08_beli_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($t08_beli_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="ALL"<?php if ($t08_beli->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t08_beli_list->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div>
<?php } ?>
<?php if ($t08_beli_list->TotalRecs == 0 && $t08_beli->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t08_beli_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($t08_beli->Export == "") { ?>
<script type="text/javascript">
ft08_belilist.Init();
</script>
<?php } ?>
<?php
$t08_beli_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($t08_beli->Export == "") { ?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

$("#x0_NoPO").val("<?php echo f_GetNextNoPO();?>");
$("#x0_TglPO").val("<?php echo date('d-m-Y');?>");
</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$t08_beli_list->Page_Terminate();
?>
