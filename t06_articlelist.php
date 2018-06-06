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

$t06_article_list = NULL; // Initialize page object first

class ct06_article_list extends ct06_article {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = '{8746EF3F-81FE-4C1C-A7F8-AC191F8DDBB2}';

	// Table name
	var $TableName = 't06_article';

	// Page object name
	var $PageObjName = 't06_article_list';

	// Grid form hidden field names
	var $FormName = 'ft06_articlelist';
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

		// Table object (t06_article)
		if (!isset($GLOBALS["t06_article"]) || get_class($GLOBALS["t06_article"]) == "ct06_article") {
			$GLOBALS["t06_article"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t06_article"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "t06_articleadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "t06_articledelete.php";
		$this->MultiUpdateUrl = "t06_articleupdate.php";

		// Table object (t96_employees)
		if (!isset($GLOBALS['t96_employees'])) $GLOBALS['t96_employees'] = new ct96_employees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

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
		$this->FilterOptions->TagClassName = "ewFilterOption ft06_articlelistsrch";

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
		$this->MainGroupID->SetVisibility();
		$this->SubGroupID->SetVisibility();
		$this->Kode->SetVisibility();
		$this->Nama->SetVisibility();
		$this->Qty->SetVisibility();
		$this->SatuanID->SetVisibility();
		$this->Harga->SetVisibility();
		$this->HargaJual->SetVisibility();

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

			// Get default search criteria
			ew_AddFilter($this->DefaultSearchWhere, $this->BasicSearchWhere(TRUE));

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Process filter list
			$this->ProcessFilterList();

			// Restore search parms from Session if not searching / reset / export
			if (($this->Export <> "" || $this->Command <> "search" && $this->Command <> "reset" && $this->Command <> "resetall") && $this->Command <> "json" && $this->CheckSearchParms())
				$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$this->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetupSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
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

		// Load search default if no existing search criteria
		if (!$this->CheckSearchParms()) {

			// Load basic search from default
			$this->BasicSearch->LoadDefault();
			if ($this->BasicSearch->Keyword != "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$this->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->Command == "search" && !$this->RestoreSearch) {
			$this->setSearchWhere($this->SearchWhere); // Save to Session
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} elseif ($this->Command <> "json") {
			$this->SearchWhere = $this->getSearchWhere();
		}

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
		$this->Qty->FormValue = ""; // Clear form value
		$this->Harga->FormValue = ""; // Clear form value
		$this->HargaJual->FormValue = ""; // Clear form value
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

	// Get list of filters
	function GetFilterList() {
		global $UserProfile;

		// Initialize
		$sFilterList = "";
		$sSavedFilterList = "";
		$sFilterList = ew_Concat($sFilterList, $this->id->AdvancedSearch->ToJson(), ","); // Field id
		$sFilterList = ew_Concat($sFilterList, $this->MainGroupID->AdvancedSearch->ToJson(), ","); // Field MainGroupID
		$sFilterList = ew_Concat($sFilterList, $this->SubGroupID->AdvancedSearch->ToJson(), ","); // Field SubGroupID
		$sFilterList = ew_Concat($sFilterList, $this->Kode->AdvancedSearch->ToJson(), ","); // Field Kode
		$sFilterList = ew_Concat($sFilterList, $this->Nama->AdvancedSearch->ToJson(), ","); // Field Nama
		$sFilterList = ew_Concat($sFilterList, $this->Qty->AdvancedSearch->ToJson(), ","); // Field Qty
		$sFilterList = ew_Concat($sFilterList, $this->SatuanID->AdvancedSearch->ToJson(), ","); // Field SatuanID
		$sFilterList = ew_Concat($sFilterList, $this->Harga->AdvancedSearch->ToJson(), ","); // Field Harga
		$sFilterList = ew_Concat($sFilterList, $this->HargaJual->AdvancedSearch->ToJson(), ","); // Field HargaJual
		if ($this->BasicSearch->Keyword <> "") {
			$sWrk = "\"" . EW_TABLE_BASIC_SEARCH . "\":\"" . ew_JsEncode2($this->BasicSearch->Keyword) . "\",\"" . EW_TABLE_BASIC_SEARCH_TYPE . "\":\"" . ew_JsEncode2($this->BasicSearch->Type) . "\"";
			$sFilterList = ew_Concat($sFilterList, $sWrk, ",");
		}
		$sFilterList = preg_replace('/,$/', "", $sFilterList);

		// Return filter list in json
		if ($sFilterList <> "")
			$sFilterList = "\"data\":{" . $sFilterList . "}";
		if ($sSavedFilterList <> "") {
			if ($sFilterList <> "")
				$sFilterList .= ",";
			$sFilterList .= "\"filters\":" . $sSavedFilterList;
		}
		return ($sFilterList <> "") ? "{" . $sFilterList . "}" : "null";
	}

	// Process filter list
	function ProcessFilterList() {
		global $UserProfile;
		if (@$_POST["ajax"] == "savefilters") { // Save filter request (Ajax)
			$filters = @$_POST["filters"];
			$UserProfile->SetSearchFilters(CurrentUserName(), "ft06_articlelistsrch", $filters);

			// Clean output buffer
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			echo ew_ArrayToJson(array(array("success" => TRUE))); // Success
			$this->Page_Terminate();
			exit();
		} elseif (@$_POST["cmd"] == "resetfilter") {
			$this->RestoreFilterList();
		}
	}

	// Restore list of filters
	function RestoreFilterList() {

		// Return if not reset filter
		if (@$_POST["cmd"] <> "resetfilter")
			return FALSE;
		$filter = json_decode(@$_POST["filter"], TRUE);
		$this->Command = "search";

		// Field id
		$this->id->AdvancedSearch->SearchValue = @$filter["x_id"];
		$this->id->AdvancedSearch->SearchOperator = @$filter["z_id"];
		$this->id->AdvancedSearch->SearchCondition = @$filter["v_id"];
		$this->id->AdvancedSearch->SearchValue2 = @$filter["y_id"];
		$this->id->AdvancedSearch->SearchOperator2 = @$filter["w_id"];
		$this->id->AdvancedSearch->Save();

		// Field MainGroupID
		$this->MainGroupID->AdvancedSearch->SearchValue = @$filter["x_MainGroupID"];
		$this->MainGroupID->AdvancedSearch->SearchOperator = @$filter["z_MainGroupID"];
		$this->MainGroupID->AdvancedSearch->SearchCondition = @$filter["v_MainGroupID"];
		$this->MainGroupID->AdvancedSearch->SearchValue2 = @$filter["y_MainGroupID"];
		$this->MainGroupID->AdvancedSearch->SearchOperator2 = @$filter["w_MainGroupID"];
		$this->MainGroupID->AdvancedSearch->Save();

		// Field SubGroupID
		$this->SubGroupID->AdvancedSearch->SearchValue = @$filter["x_SubGroupID"];
		$this->SubGroupID->AdvancedSearch->SearchOperator = @$filter["z_SubGroupID"];
		$this->SubGroupID->AdvancedSearch->SearchCondition = @$filter["v_SubGroupID"];
		$this->SubGroupID->AdvancedSearch->SearchValue2 = @$filter["y_SubGroupID"];
		$this->SubGroupID->AdvancedSearch->SearchOperator2 = @$filter["w_SubGroupID"];
		$this->SubGroupID->AdvancedSearch->Save();

		// Field Kode
		$this->Kode->AdvancedSearch->SearchValue = @$filter["x_Kode"];
		$this->Kode->AdvancedSearch->SearchOperator = @$filter["z_Kode"];
		$this->Kode->AdvancedSearch->SearchCondition = @$filter["v_Kode"];
		$this->Kode->AdvancedSearch->SearchValue2 = @$filter["y_Kode"];
		$this->Kode->AdvancedSearch->SearchOperator2 = @$filter["w_Kode"];
		$this->Kode->AdvancedSearch->Save();

		// Field Nama
		$this->Nama->AdvancedSearch->SearchValue = @$filter["x_Nama"];
		$this->Nama->AdvancedSearch->SearchOperator = @$filter["z_Nama"];
		$this->Nama->AdvancedSearch->SearchCondition = @$filter["v_Nama"];
		$this->Nama->AdvancedSearch->SearchValue2 = @$filter["y_Nama"];
		$this->Nama->AdvancedSearch->SearchOperator2 = @$filter["w_Nama"];
		$this->Nama->AdvancedSearch->Save();

		// Field Qty
		$this->Qty->AdvancedSearch->SearchValue = @$filter["x_Qty"];
		$this->Qty->AdvancedSearch->SearchOperator = @$filter["z_Qty"];
		$this->Qty->AdvancedSearch->SearchCondition = @$filter["v_Qty"];
		$this->Qty->AdvancedSearch->SearchValue2 = @$filter["y_Qty"];
		$this->Qty->AdvancedSearch->SearchOperator2 = @$filter["w_Qty"];
		$this->Qty->AdvancedSearch->Save();

		// Field SatuanID
		$this->SatuanID->AdvancedSearch->SearchValue = @$filter["x_SatuanID"];
		$this->SatuanID->AdvancedSearch->SearchOperator = @$filter["z_SatuanID"];
		$this->SatuanID->AdvancedSearch->SearchCondition = @$filter["v_SatuanID"];
		$this->SatuanID->AdvancedSearch->SearchValue2 = @$filter["y_SatuanID"];
		$this->SatuanID->AdvancedSearch->SearchOperator2 = @$filter["w_SatuanID"];
		$this->SatuanID->AdvancedSearch->Save();

		// Field Harga
		$this->Harga->AdvancedSearch->SearchValue = @$filter["x_Harga"];
		$this->Harga->AdvancedSearch->SearchOperator = @$filter["z_Harga"];
		$this->Harga->AdvancedSearch->SearchCondition = @$filter["v_Harga"];
		$this->Harga->AdvancedSearch->SearchValue2 = @$filter["y_Harga"];
		$this->Harga->AdvancedSearch->SearchOperator2 = @$filter["w_Harga"];
		$this->Harga->AdvancedSearch->Save();

		// Field HargaJual
		$this->HargaJual->AdvancedSearch->SearchValue = @$filter["x_HargaJual"];
		$this->HargaJual->AdvancedSearch->SearchOperator = @$filter["z_HargaJual"];
		$this->HargaJual->AdvancedSearch->SearchCondition = @$filter["v_HargaJual"];
		$this->HargaJual->AdvancedSearch->SearchValue2 = @$filter["y_HargaJual"];
		$this->HargaJual->AdvancedSearch->SearchOperator2 = @$filter["w_HargaJual"];
		$this->HargaJual->AdvancedSearch->Save();
		$this->BasicSearch->setKeyword(@$filter[EW_TABLE_BASIC_SEARCH]);
		$this->BasicSearch->setType(@$filter[EW_TABLE_BASIC_SEARCH_TYPE]);
	}

	// Return basic search SQL
	function BasicSearchSQL($arKeywords, $type) {
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $this->Kode, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->Nama, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->SatuanID, $arKeywords, $type);
		return $sWhere;
	}

	// Build basic search SQL
	function BuildBasicSearchSQL(&$Where, &$Fld, $arKeywords, $type) {
		global $EW_BASIC_SEARCH_IGNORE_PATTERN;
		$sDefCond = ($type == "OR") ? "OR" : "AND";
		$arSQL = array(); // Array for SQL parts
		$arCond = array(); // Array for search conditions
		$cnt = count($arKeywords);
		$j = 0; // Number of SQL parts
		for ($i = 0; $i < $cnt; $i++) {
			$Keyword = $arKeywords[$i];
			$Keyword = trim($Keyword);
			if ($EW_BASIC_SEARCH_IGNORE_PATTERN <> "") {
				$Keyword = preg_replace($EW_BASIC_SEARCH_IGNORE_PATTERN, "\\", $Keyword);
				$ar = explode("\\", $Keyword);
			} else {
				$ar = array($Keyword);
			}
			foreach ($ar as $Keyword) {
				if ($Keyword <> "") {
					$sWrk = "";
					if ($Keyword == "OR" && $type == "") {
						if ($j > 0)
							$arCond[$j-1] = "OR";
					} elseif ($Keyword == EW_NULL_VALUE) {
						$sWrk = $Fld->FldExpression . " IS NULL";
					} elseif ($Keyword == EW_NOT_NULL_VALUE) {
						$sWrk = $Fld->FldExpression . " IS NOT NULL";
					} elseif ($Fld->FldIsVirtual) {
						$sWrk = $Fld->FldVirtualExpression . ew_Like(ew_QuotedValue("%" . $Keyword . "%", EW_DATATYPE_STRING, $this->DBID), $this->DBID);
					} elseif ($Fld->FldDataType != EW_DATATYPE_NUMBER || is_numeric($Keyword)) {
						$sWrk = $Fld->FldBasicSearchExpression . ew_Like(ew_QuotedValue("%" . $Keyword . "%", EW_DATATYPE_STRING, $this->DBID), $this->DBID);
					}
					if ($sWrk <> "") {
						$arSQL[$j] = $sWrk;
						$arCond[$j] = $sDefCond;
						$j += 1;
					}
				}
			}
		}
		$cnt = count($arSQL);
		$bQuoted = FALSE;
		$sSql = "";
		if ($cnt > 0) {
			for ($i = 0; $i < $cnt-1; $i++) {
				if ($arCond[$i] == "OR") {
					if (!$bQuoted) $sSql .= "(";
					$bQuoted = TRUE;
				}
				$sSql .= $arSQL[$i];
				if ($bQuoted && $arCond[$i] <> "OR") {
					$sSql .= ")";
					$bQuoted = FALSE;
				}
				$sSql .= " " . $arCond[$i] . " ";
			}
			$sSql .= $arSQL[$cnt-1];
			if ($bQuoted)
				$sSql .= ")";
		}
		if ($sSql <> "") {
			if ($Where <> "") $Where .= " OR ";
			$Where .= "(" . $sSql . ")";
		}
	}

	// Return basic search WHERE clause based on search keyword and type
	function BasicSearchWhere($Default = FALSE) {
		global $Security;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = ($Default) ? $this->BasicSearch->KeywordDefault : $this->BasicSearch->Keyword;
		$sSearchType = ($Default) ? $this->BasicSearch->TypeDefault : $this->BasicSearch->Type;

		// Get search SQL
		if ($sSearchKeyword <> "") {
			$ar = $this->BasicSearch->KeywordList($Default);

			// Search keyword in any fields
			if (($sSearchType == "OR" || $sSearchType == "AND") && $this->BasicSearch->BasicSearchAnyFields) {
				foreach ($ar as $sKeyword) {
					if ($sKeyword <> "") {
						if ($sSearchStr <> "") $sSearchStr .= " " . $sSearchType . " ";
						$sSearchStr .= "(" . $this->BasicSearchSQL(array($sKeyword), $sSearchType) . ")";
					}
				}
			} else {
				$sSearchStr = $this->BasicSearchSQL($ar, $sSearchType);
			}
			if (!$Default && in_array($this->Command, array("", "reset", "resetall"))) $this->Command = "search";
		}
		if (!$Default && $this->Command == "search") {
			$this->BasicSearch->setKeyword($sSearchKeyword);
			$this->BasicSearch->setType($sSearchType);
		}
		return $sSearchStr;
	}

	// Check if search parm exists
	function CheckSearchParms() {

		// Check basic search
		if ($this->BasicSearch->IssetSession())
			return TRUE;
		return FALSE;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$this->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Load advanced search default values
	function LoadAdvancedSearchDefault() {
		return FALSE;
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		$this->BasicSearch->UnsetSession();
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->Load();
	}

	// Set up sort parameters
	function SetupSortOrder() {

		// Check for Ctrl pressed
		$bCtrl = (@$_GET["ctrl"] <> "");

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$this->CurrentOrder = @$_GET["order"];
			$this->CurrentOrderType = @$_GET["ordertype"];
			$this->UpdateSort($this->MainGroupID, $bCtrl); // MainGroupID
			$this->UpdateSort($this->SubGroupID, $bCtrl); // SubGroupID
			$this->UpdateSort($this->Kode, $bCtrl); // Kode
			$this->UpdateSort($this->Nama, $bCtrl); // Nama
			$this->UpdateSort($this->Qty, $bCtrl); // Qty
			$this->UpdateSort($this->SatuanID, $bCtrl); // SatuanID
			$this->UpdateSort($this->Harga, $bCtrl); // Harga
			$this->UpdateSort($this->HargaJual, $bCtrl); // HargaJual
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
				$this->SubGroupID->setSort("ASC");
				$this->Nama->setSort("ASC");
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

			// Reset search criteria
			if ($this->Command == "reset" || $this->Command == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$sOrderBy = "";
				$this->setSessionOrderBy($sOrderBy);
				$this->setSessionOrderByList($sOrderBy);
				$this->MainGroupID->setSort("");
				$this->SubGroupID->setSort("");
				$this->Kode->setSort("");
				$this->Nama->setSort("");
				$this->Qty->setSort("");
				$this->SatuanID->setSort("");
				$this->Harga->setSort("");
				$this->HargaJual->setSort("");
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
		$item->Body = "<a class=\"ewAction ewMultiDelete\" title=\"" . ew_HtmlTitle($Language->Phrase("DeleteSelectedLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("DeleteSelectedLink")) . "\" href=\"\" onclick=\"ew_SubmitAction(event,{f:document.ft06_articlelist,url:'" . $this->MultiDeleteUrl . "'});return false;\">" . $Language->Phrase("DeleteSelectedLink") . "</a>";
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
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"ft06_articlelistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"ft06_articlelistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
		$item->Visible = TRUE;
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
					$item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.ft06_articlelist}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
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

		// Search button
		$item = &$this->SearchOptions->Add("searchtoggle");
		$SearchToggleClass = ($this->SearchWhere <> "") ? " active" : " active";
		$item->Body = "<button type=\"button\" class=\"btn btn-default ewSearchToggle" . $SearchToggleClass . "\" title=\"" . $Language->Phrase("SearchPanel") . "\" data-caption=\"" . $Language->Phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"ft06_articlelistsrch\">" . $Language->Phrase("SearchLink") . "</button>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->Add("showall");
		$item->Body = "<a class=\"btn btn-default ewShowAll\" title=\"" . $Language->Phrase("ShowAll") . "\" data-caption=\"" . $Language->Phrase("ShowAll") . "\" href=\"" . $this->PageUrl() . "cmd=reset\">" . $Language->Phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere <> $this->DefaultSearchWhere && $this->SearchWhere <> "0=101");

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
		$this->MainGroupID->CurrentValue = NULL;
		$this->MainGroupID->OldValue = $this->MainGroupID->CurrentValue;
		$this->SubGroupID->CurrentValue = NULL;
		$this->SubGroupID->OldValue = $this->SubGroupID->CurrentValue;
		$this->Kode->CurrentValue = NULL;
		$this->Kode->OldValue = $this->Kode->CurrentValue;
		$this->Nama->CurrentValue = NULL;
		$this->Nama->OldValue = $this->Nama->CurrentValue;
		$this->Qty->CurrentValue = 0.00;
		$this->SatuanID->CurrentValue = NULL;
		$this->SatuanID->OldValue = $this->SatuanID->CurrentValue;
		$this->Harga->CurrentValue = 0.00;
		$this->HargaJual->CurrentValue = 0.00;
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		$this->BasicSearch->Keyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		if ($this->BasicSearch->Keyword <> "" && $this->Command == "") $this->Command = "search";
		$this->BasicSearch->Type = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
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
		if (!$this->Qty->FldIsDetailKey) {
			$this->Qty->setFormValue($objForm->GetValue("x_Qty"));
		}
		if (!$this->SatuanID->FldIsDetailKey) {
			$this->SatuanID->setFormValue($objForm->GetValue("x_SatuanID"));
		}
		if (!$this->Harga->FldIsDetailKey) {
			$this->Harga->setFormValue($objForm->GetValue("x_Harga"));
		}
		if (!$this->HargaJual->FldIsDetailKey) {
			$this->HargaJual->setFormValue($objForm->GetValue("x_HargaJual"));
		}
		if (!$this->id->FldIsDetailKey && $this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
			$this->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		if ($this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
			$this->id->CurrentValue = $this->id->FormValue;
		$this->MainGroupID->CurrentValue = $this->MainGroupID->FormValue;
		$this->SubGroupID->CurrentValue = $this->SubGroupID->FormValue;
		$this->Kode->CurrentValue = $this->Kode->FormValue;
		$this->Nama->CurrentValue = $this->Nama->FormValue;
		$this->Qty->CurrentValue = $this->Qty->FormValue;
		$this->SatuanID->CurrentValue = $this->SatuanID->FormValue;
		$this->Harga->CurrentValue = $this->Harga->FormValue;
		$this->HargaJual->CurrentValue = $this->HargaJual->FormValue;
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
		$this->Qty->setDbValue($row['Qty']);
		$this->SatuanID->setDbValue($row['SatuanID']);
		if (array_key_exists('EV__SatuanID', $rs->fields)) {
			$this->SatuanID->VirtualValue = $rs->fields('EV__SatuanID'); // Set up virtual field value
		} else {
			$this->SatuanID->VirtualValue = ""; // Clear value
		}
		$this->Harga->setDbValue($row['Harga']);
		$this->HargaJual->setDbValue($row['HargaJual']);
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
		$row['Qty'] = $this->Qty->CurrentValue;
		$row['SatuanID'] = $this->SatuanID->CurrentValue;
		$row['Harga'] = $this->Harga->CurrentValue;
		$row['HargaJual'] = $this->HargaJual->CurrentValue;
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
		$this->Qty->DbValue = $row['Qty'];
		$this->SatuanID->DbValue = $row['SatuanID'];
		$this->Harga->DbValue = $row['Harga'];
		$this->HargaJual->DbValue = $row['HargaJual'];
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
		if ($this->Qty->FormValue == $this->Qty->CurrentValue && is_numeric(ew_StrToFloat($this->Qty->CurrentValue)))
			$this->Qty->CurrentValue = ew_StrToFloat($this->Qty->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Harga->FormValue == $this->Harga->CurrentValue && is_numeric(ew_StrToFloat($this->Harga->CurrentValue)))
			$this->Harga->CurrentValue = ew_StrToFloat($this->Harga->CurrentValue);

		// Convert decimal values if posted back
		if ($this->HargaJual->FormValue == $this->HargaJual->CurrentValue && is_numeric(ew_StrToFloat($this->HargaJual->CurrentValue)))
			$this->HargaJual->CurrentValue = ew_StrToFloat($this->HargaJual->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// MainGroupID
		// SubGroupID
		// Kode
		// Nama
		// Qty
		// SatuanID
		// Harga
		// HargaJual

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

		// Qty
		$this->Qty->ViewValue = $this->Qty->CurrentValue;
		$this->Qty->ViewValue = ew_FormatNumber($this->Qty->ViewValue, 2, -2, -2, -2);
		$this->Qty->CellCssStyle .= "text-align: right;";
		$this->Qty->ViewCustomAttributes = "";

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

		// Harga
		$this->Harga->ViewValue = $this->Harga->CurrentValue;
		$this->Harga->ViewValue = ew_FormatNumber($this->Harga->ViewValue, 2, -2, -2, -2);
		$this->Harga->CellCssStyle .= "text-align: right;";
		$this->Harga->ViewCustomAttributes = "";

		// HargaJual
		$this->HargaJual->ViewValue = $this->HargaJual->CurrentValue;
		$this->HargaJual->ViewValue = ew_FormatNumber($this->HargaJual->ViewValue, 2, -2, -2, -2);
		$this->HargaJual->CellCssStyle .= "text-align: right;";
		$this->HargaJual->ViewCustomAttributes = "";

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

			// Qty
			$this->Qty->LinkCustomAttributes = "";
			$this->Qty->HrefValue = "";
			$this->Qty->TooltipValue = "";

			// SatuanID
			$this->SatuanID->LinkCustomAttributes = "";
			$this->SatuanID->HrefValue = "";
			$this->SatuanID->TooltipValue = "";

			// Harga
			$this->Harga->LinkCustomAttributes = "";
			$this->Harga->HrefValue = "";
			$this->Harga->TooltipValue = "";

			// HargaJual
			$this->HargaJual->LinkCustomAttributes = "";
			$this->HargaJual->HrefValue = "";
			$this->HargaJual->TooltipValue = "";
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

			// Qty
			$this->Qty->EditAttrs["class"] = "form-control";
			$this->Qty->EditCustomAttributes = "";
			$this->Qty->EditValue = ew_HtmlEncode($this->Qty->CurrentValue);
			$this->Qty->PlaceHolder = ew_RemoveHtml($this->Qty->FldCaption());
			if (strval($this->Qty->EditValue) <> "" && is_numeric($this->Qty->EditValue)) $this->Qty->EditValue = ew_FormatNumber($this->Qty->EditValue, -2, -2, -2, -2);

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

			// Harga
			$this->Harga->EditAttrs["class"] = "form-control";
			$this->Harga->EditCustomAttributes = "";
			$this->Harga->EditValue = ew_HtmlEncode($this->Harga->CurrentValue);
			$this->Harga->PlaceHolder = ew_RemoveHtml($this->Harga->FldCaption());
			if (strval($this->Harga->EditValue) <> "" && is_numeric($this->Harga->EditValue)) $this->Harga->EditValue = ew_FormatNumber($this->Harga->EditValue, -2, -2, -2, -2);

			// HargaJual
			$this->HargaJual->EditAttrs["class"] = "form-control";
			$this->HargaJual->EditCustomAttributes = "";
			$this->HargaJual->EditValue = ew_HtmlEncode($this->HargaJual->CurrentValue);
			$this->HargaJual->PlaceHolder = ew_RemoveHtml($this->HargaJual->FldCaption());
			if (strval($this->HargaJual->EditValue) <> "" && is_numeric($this->HargaJual->EditValue)) $this->HargaJual->EditValue = ew_FormatNumber($this->HargaJual->EditValue, -2, -2, -2, -2);

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

			// Qty
			$this->Qty->LinkCustomAttributes = "";
			$this->Qty->HrefValue = "";

			// SatuanID
			$this->SatuanID->LinkCustomAttributes = "";
			$this->SatuanID->HrefValue = "";

			// Harga
			$this->Harga->LinkCustomAttributes = "";
			$this->Harga->HrefValue = "";

			// HargaJual
			$this->HargaJual->LinkCustomAttributes = "";
			$this->HargaJual->HrefValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

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

			// Qty
			$this->Qty->EditAttrs["class"] = "form-control";
			$this->Qty->EditCustomAttributes = "";
			$this->Qty->EditValue = ew_HtmlEncode($this->Qty->CurrentValue);
			$this->Qty->PlaceHolder = ew_RemoveHtml($this->Qty->FldCaption());
			if (strval($this->Qty->EditValue) <> "" && is_numeric($this->Qty->EditValue)) $this->Qty->EditValue = ew_FormatNumber($this->Qty->EditValue, -2, -2, -2, -2);

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

			// Harga
			$this->Harga->EditAttrs["class"] = "form-control";
			$this->Harga->EditCustomAttributes = "";
			$this->Harga->EditValue = ew_HtmlEncode($this->Harga->CurrentValue);
			$this->Harga->PlaceHolder = ew_RemoveHtml($this->Harga->FldCaption());
			if (strval($this->Harga->EditValue) <> "" && is_numeric($this->Harga->EditValue)) $this->Harga->EditValue = ew_FormatNumber($this->Harga->EditValue, -2, -2, -2, -2);

			// HargaJual
			$this->HargaJual->EditAttrs["class"] = "form-control";
			$this->HargaJual->EditCustomAttributes = "";
			$this->HargaJual->EditValue = ew_HtmlEncode($this->HargaJual->CurrentValue);
			$this->HargaJual->PlaceHolder = ew_RemoveHtml($this->HargaJual->FldCaption());
			if (strval($this->HargaJual->EditValue) <> "" && is_numeric($this->HargaJual->EditValue)) $this->HargaJual->EditValue = ew_FormatNumber($this->HargaJual->EditValue, -2, -2, -2, -2);

			// Edit refer script
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

			// Qty
			$this->Qty->LinkCustomAttributes = "";
			$this->Qty->HrefValue = "";

			// SatuanID
			$this->SatuanID->LinkCustomAttributes = "";
			$this->SatuanID->HrefValue = "";

			// Harga
			$this->Harga->LinkCustomAttributes = "";
			$this->Harga->HrefValue = "";

			// HargaJual
			$this->HargaJual->LinkCustomAttributes = "";
			$this->HargaJual->HrefValue = "";
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
		if (!ew_CheckNumber($this->Qty->FormValue)) {
			ew_AddMessage($gsFormError, $this->Qty->FldErrMsg());
		}
		if (!$this->SatuanID->FldIsDetailKey && !is_null($this->SatuanID->FormValue) && $this->SatuanID->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->SatuanID->FldCaption(), $this->SatuanID->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->Harga->FormValue)) {
			ew_AddMessage($gsFormError, $this->Harga->FldErrMsg());
		}
		if (!ew_CheckNumber($this->HargaJual->FormValue)) {
			ew_AddMessage($gsFormError, $this->HargaJual->FldErrMsg());
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
		if ($this->Kode->CurrentValue <> "") { // Check field with unique index
			$sFilterChk = "(`Kode` = '" . ew_AdjustSql($this->Kode->CurrentValue, $this->DBID) . "')";
			$sFilterChk .= " AND NOT (" . $sFilter . ")";
			$this->CurrentFilter = $sFilterChk;
			$sSqlChk = $this->SQL();
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			$rsChk = $conn->Execute($sSqlChk);
			$conn->raiseErrorFn = '';
			if ($rsChk === FALSE) {
				return FALSE;
			} elseif (!$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", $this->Kode->FldCaption(), $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $this->Kode->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
			$rsChk->Close();
		}
		if ($this->Nama->CurrentValue <> "") { // Check field with unique index
			$sFilterChk = "(`Nama` = '" . ew_AdjustSql($this->Nama->CurrentValue, $this->DBID) . "')";
			$sFilterChk .= " AND NOT (" . $sFilter . ")";
			$this->CurrentFilter = $sFilterChk;
			$sSqlChk = $this->SQL();
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			$rsChk = $conn->Execute($sSqlChk);
			$conn->raiseErrorFn = '';
			if ($rsChk === FALSE) {
				return FALSE;
			} elseif (!$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", $this->Nama->FldCaption(), $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $this->Nama->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
			$rsChk->Close();
		}
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

			// MainGroupID
			$this->MainGroupID->SetDbValueDef($rsnew, $this->MainGroupID->CurrentValue, NULL, $this->MainGroupID->ReadOnly);

			// SubGroupID
			$this->SubGroupID->SetDbValueDef($rsnew, $this->SubGroupID->CurrentValue, 0, $this->SubGroupID->ReadOnly);

			// Kode
			$this->Kode->SetDbValueDef($rsnew, $this->Kode->CurrentValue, "", $this->Kode->ReadOnly);

			// Nama
			$this->Nama->SetDbValueDef($rsnew, $this->Nama->CurrentValue, "", $this->Nama->ReadOnly);

			// Qty
			$this->Qty->SetDbValueDef($rsnew, $this->Qty->CurrentValue, 0, $this->Qty->ReadOnly);

			// SatuanID
			$this->SatuanID->SetDbValueDef($rsnew, $this->SatuanID->CurrentValue, 0, $this->SatuanID->ReadOnly);

			// Harga
			$this->Harga->SetDbValueDef($rsnew, $this->Harga->CurrentValue, 0, $this->Harga->ReadOnly);

			// HargaJual
			$this->HargaJual->SetDbValueDef($rsnew, $this->HargaJual->CurrentValue, 0, $this->HargaJual->ReadOnly);

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

		// Qty
		$this->Qty->SetDbValueDef($rsnew, $this->Qty->CurrentValue, 0, strval($this->Qty->CurrentValue) == "");

		// SatuanID
		$this->SatuanID->SetDbValueDef($rsnew, $this->SatuanID->CurrentValue, 0, FALSE);

		// Harga
		$this->Harga->SetDbValueDef($rsnew, $this->Harga->CurrentValue, 0, strval($this->Harga->CurrentValue) == "");

		// HargaJual
		$this->HargaJual->SetDbValueDef($rsnew, $this->HargaJual->CurrentValue, 0, strval($this->HargaJual->CurrentValue) == "");

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
		$item->Body = "<button id=\"emf_t06_article\" class=\"ewExportLink ewEmail\" title=\"" . $Language->Phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->Phrase("ExportToEmailText") . "\" onclick=\"ew_EmailDialogShow({lnk:'emf_t06_article',hdr:ewLanguage.Phrase('ExportToEmailText'),f:document.ft06_articlelist,sel:false" . $url . "});\">" . $Language->Phrase("ExportToEmail") . "</button>";
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
		if ($this->BasicSearch->getKeyword() <> "") {
			$sQry .= "&" . EW_TABLE_BASIC_SEARCH . "=" . urlencode($this->BasicSearch->getKeyword()) . "&" . EW_TABLE_BASIC_SEARCH_TYPE . "=" . urlencode($this->BasicSearch->getType());
		}

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
if (!isset($t06_article_list)) $t06_article_list = new ct06_article_list();

// Page init
$t06_article_list->Page_Init();

// Page main
$t06_article_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t06_article_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($t06_article->Export == "") { ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "list";
var CurrentForm = ft06_articlelist = new ew_Form("ft06_articlelist", "list");
ft06_articlelist.FormKeyCountName = '<?php echo $t06_article_list->FormKeyCountName ?>';

// Validate form
ft06_articlelist.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_Qty");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t06_article->Qty->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_SatuanID");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t06_article->SatuanID->FldCaption(), $t06_article->SatuanID->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Harga");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t06_article->Harga->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_HargaJual");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t06_article->HargaJual->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
ft06_articlelist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ft06_articlelist.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ft06_articlelist.Lists["x_MainGroupID"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Kode","x_Nama","",""],"ParentFields":[],"ChildFields":["x_SubGroupID"],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t04_maingroup"};
ft06_articlelist.Lists["x_MainGroupID"].Data = "<?php echo $t06_article_list->MainGroupID->LookupFilterQuery(FALSE, "list") ?>";
ft06_articlelist.Lists["x_SubGroupID"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Kode","x_Nama","",""],"ParentFields":["x_MainGroupID"],"ChildFields":[],"FilterFields":["x_MainGroupID"],"Options":[],"Template":"","LinkTable":"t05_subgroup"};
ft06_articlelist.Lists["x_SubGroupID"].Data = "<?php echo $t06_article_list->SubGroupID->LookupFilterQuery(FALSE, "list") ?>";
ft06_articlelist.Lists["x_SatuanID"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nama","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t07_satuan"};
ft06_articlelist.Lists["x_SatuanID"].Data = "<?php echo $t06_article_list->SatuanID->LookupFilterQuery(FALSE, "list") ?>";

// Form object for search
var CurrentSearchForm = ft06_articlelistsrch = new ew_Form("ft06_articlelistsrch");
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if ($t06_article->Export == "") { ?>
<div class="ewToolbar">
<?php if ($t06_article_list->TotalRecs > 0 && $t06_article_list->ExportOptions->Visible()) { ?>
<?php $t06_article_list->ExportOptions->Render("body") ?>
<?php } ?>
<?php if ($t06_article_list->SearchOptions->Visible()) { ?>
<?php $t06_article_list->SearchOptions->Render("body") ?>
<?php } ?>
<?php if ($t06_article_list->FilterOptions->Visible()) { ?>
<?php $t06_article_list->FilterOptions->Render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
	$bSelectLimit = $t06_article_list->UseSelectLimit;
	if ($bSelectLimit) {
		if ($t06_article_list->TotalRecs <= 0)
			$t06_article_list->TotalRecs = $t06_article->ListRecordCount();
	} else {
		if (!$t06_article_list->Recordset && ($t06_article_list->Recordset = $t06_article_list->LoadRecordset()))
			$t06_article_list->TotalRecs = $t06_article_list->Recordset->RecordCount();
	}
	$t06_article_list->StartRec = 1;
	if ($t06_article_list->DisplayRecs <= 0 || ($t06_article->Export <> "" && $t06_article->ExportAll)) // Display all records
		$t06_article_list->DisplayRecs = $t06_article_list->TotalRecs;
	if (!($t06_article->Export <> "" && $t06_article->ExportAll))
		$t06_article_list->SetupStartRec(); // Set up start record position
	if ($bSelectLimit)
		$t06_article_list->Recordset = $t06_article_list->LoadRecordset($t06_article_list->StartRec-1, $t06_article_list->DisplayRecs);

	// Set no record found message
	if ($t06_article->CurrentAction == "" && $t06_article_list->TotalRecs == 0) {
		if (!$Security->CanList())
			$t06_article_list->setWarningMessage(ew_DeniedMsg());
		if ($t06_article_list->SearchWhere == "0=101")
			$t06_article_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$t06_article_list->setWarningMessage($Language->Phrase("NoRecord"));
	}

	// Audit trail on search
	if ($t06_article_list->AuditTrailOnSearch && $t06_article_list->Command == "search" && !$t06_article_list->RestoreSearch) {
		$searchparm = ew_ServerVar("QUERY_STRING");
		$searchsql = $t06_article_list->getSessionWhere();
		$t06_article_list->WriteAuditTrailOnSearch($searchparm, $searchsql);
	}
$t06_article_list->RenderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if ($t06_article->Export == "" && $t06_article->CurrentAction == "") { ?>
<form name="ft06_articlelistsrch" id="ft06_articlelistsrch" class="form-inline ewForm ewExtSearchForm" action="<?php echo ew_CurrentPage() ?>">
<?php $SearchPanelClass = ($t06_article_list->SearchWhere <> "") ? " in" : " in"; ?>
<div id="ft06_articlelistsrch_SearchPanel" class="ewSearchPanel collapse<?php echo $SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="t06_article">
	<div class="ewBasicSearch">
<div id="xsr_1" class="ewRow">
	<div class="ewQuickSearch input-group">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo ew_HtmlEncode($t06_article_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo ew_HtmlEncode($Language->Phrase("Search")) ?>">
	<input type="hidden" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo ew_HtmlEncode($t06_article_list->BasicSearch->getType()) ?>">
	<div class="input-group-btn">
		<button type="button" data-toggle="dropdown" class="btn btn-default"><span id="searchtype"><?php echo $t06_article_list->BasicSearch->getTypeNameShort() ?></span><span class="caret"></span></button>
		<ul class="dropdown-menu pull-right" role="menu">
			<li<?php if ($t06_article_list->BasicSearch->getType() == "") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this)"><?php echo $Language->Phrase("QuickSearchAuto") ?></a></li>
			<li<?php if ($t06_article_list->BasicSearch->getType() == "=") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'=')"><?php echo $Language->Phrase("QuickSearchExact") ?></a></li>
			<li<?php if ($t06_article_list->BasicSearch->getType() == "AND") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'AND')"><?php echo $Language->Phrase("QuickSearchAll") ?></a></li>
			<li<?php if ($t06_article_list->BasicSearch->getType() == "OR") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'OR')"><?php echo $Language->Phrase("QuickSearchAny") ?></a></li>
		</ul>
	<button class="btn btn-primary ewButton" name="btnsubmit" id="btnsubmit" type="submit"><?php echo $Language->Phrase("SearchBtn") ?></button>
	</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $t06_article_list->ShowPageHeader(); ?>
<?php
$t06_article_list->ShowMessage();
?>
<?php if ($t06_article_list->TotalRecs > 0 || $t06_article->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($t06_article_list->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> t06_article">
<?php if ($t06_article->Export == "") { ?>
<div class="box-header ewGridUpperPanel">
<?php if ($t06_article->CurrentAction <> "gridadd" && $t06_article->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="form-inline ewForm ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($t06_article_list->Pager)) $t06_article_list->Pager = new cPrevNextPager($t06_article_list->StartRec, $t06_article_list->DisplayRecs, $t06_article_list->TotalRecs, $t06_article_list->AutoHidePager) ?>
<?php if ($t06_article_list->Pager->RecordCount > 0 && $t06_article_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($t06_article_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $t06_article_list->PageUrl() ?>start=<?php echo $t06_article_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($t06_article_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $t06_article_list->PageUrl() ?>start=<?php echo $t06_article_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $t06_article_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($t06_article_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $t06_article_list->PageUrl() ?>start=<?php echo $t06_article_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($t06_article_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $t06_article_list->PageUrl() ?>start=<?php echo $t06_article_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $t06_article_list->Pager->PageCount ?></span>
</div>
<?php } ?>
<?php if ($t06_article_list->Pager->RecordCount > 0) { ?>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $t06_article_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $t06_article_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $t06_article_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($t06_article_list->TotalRecs > 0 && (!$t06_article_list->AutoHidePageSizeSelector || $t06_article_list->Pager->Visible)) { ?>
<div class="ewPager">
<input type="hidden" name="t" value="t06_article">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" class="form-control input-sm ewTooltip" title="<?php echo $Language->Phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($t06_article_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($t06_article_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($t06_article_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($t06_article_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($t06_article_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="ALL"<?php if ($t06_article->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t06_article_list->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ft06_articlelist" id="ft06_articlelist" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t06_article_list->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t06_article_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t06_article">
<div id="gmp_t06_article" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<?php if ($t06_article_list->TotalRecs > 0 || $t06_article->CurrentAction == "add" || $t06_article->CurrentAction == "copy" || $t06_article->CurrentAction == "gridedit") { ?>
<table id="tbl_t06_articlelist" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$t06_article_list->RowType = EW_ROWTYPE_HEADER;

// Render list options
$t06_article_list->RenderListOptions();

// Render list options (header, left)
$t06_article_list->ListOptions->Render("header", "left");
?>
<?php if ($t06_article->MainGroupID->Visible) { // MainGroupID ?>
	<?php if ($t06_article->SortUrl($t06_article->MainGroupID) == "") { ?>
		<th data-name="MainGroupID" class="<?php echo $t06_article->MainGroupID->HeaderCellClass() ?>"><div id="elh_t06_article_MainGroupID" class="t06_article_MainGroupID"><div class="ewTableHeaderCaption"><?php echo $t06_article->MainGroupID->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MainGroupID" class="<?php echo $t06_article->MainGroupID->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t06_article->SortUrl($t06_article->MainGroupID) ?>',2);"><div id="elh_t06_article_MainGroupID" class="t06_article_MainGroupID">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t06_article->MainGroupID->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t06_article->MainGroupID->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t06_article->MainGroupID->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t06_article->SubGroupID->Visible) { // SubGroupID ?>
	<?php if ($t06_article->SortUrl($t06_article->SubGroupID) == "") { ?>
		<th data-name="SubGroupID" class="<?php echo $t06_article->SubGroupID->HeaderCellClass() ?>"><div id="elh_t06_article_SubGroupID" class="t06_article_SubGroupID"><div class="ewTableHeaderCaption"><?php echo $t06_article->SubGroupID->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SubGroupID" class="<?php echo $t06_article->SubGroupID->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t06_article->SortUrl($t06_article->SubGroupID) ?>',2);"><div id="elh_t06_article_SubGroupID" class="t06_article_SubGroupID">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t06_article->SubGroupID->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t06_article->SubGroupID->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t06_article->SubGroupID->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t06_article->Kode->Visible) { // Kode ?>
	<?php if ($t06_article->SortUrl($t06_article->Kode) == "") { ?>
		<th data-name="Kode" class="<?php echo $t06_article->Kode->HeaderCellClass() ?>"><div id="elh_t06_article_Kode" class="t06_article_Kode"><div class="ewTableHeaderCaption"><?php echo $t06_article->Kode->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Kode" class="<?php echo $t06_article->Kode->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t06_article->SortUrl($t06_article->Kode) ?>',2);"><div id="elh_t06_article_Kode" class="t06_article_Kode">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t06_article->Kode->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($t06_article->Kode->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t06_article->Kode->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t06_article->Nama->Visible) { // Nama ?>
	<?php if ($t06_article->SortUrl($t06_article->Nama) == "") { ?>
		<th data-name="Nama" class="<?php echo $t06_article->Nama->HeaderCellClass() ?>"><div id="elh_t06_article_Nama" class="t06_article_Nama"><div class="ewTableHeaderCaption"><?php echo $t06_article->Nama->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Nama" class="<?php echo $t06_article->Nama->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t06_article->SortUrl($t06_article->Nama) ?>',2);"><div id="elh_t06_article_Nama" class="t06_article_Nama">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t06_article->Nama->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($t06_article->Nama->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t06_article->Nama->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t06_article->Qty->Visible) { // Qty ?>
	<?php if ($t06_article->SortUrl($t06_article->Qty) == "") { ?>
		<th data-name="Qty" class="<?php echo $t06_article->Qty->HeaderCellClass() ?>"><div id="elh_t06_article_Qty" class="t06_article_Qty"><div class="ewTableHeaderCaption"><?php echo $t06_article->Qty->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Qty" class="<?php echo $t06_article->Qty->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t06_article->SortUrl($t06_article->Qty) ?>',2);"><div id="elh_t06_article_Qty" class="t06_article_Qty">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t06_article->Qty->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t06_article->Qty->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t06_article->Qty->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t06_article->SatuanID->Visible) { // SatuanID ?>
	<?php if ($t06_article->SortUrl($t06_article->SatuanID) == "") { ?>
		<th data-name="SatuanID" class="<?php echo $t06_article->SatuanID->HeaderCellClass() ?>"><div id="elh_t06_article_SatuanID" class="t06_article_SatuanID"><div class="ewTableHeaderCaption"><?php echo $t06_article->SatuanID->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SatuanID" class="<?php echo $t06_article->SatuanID->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t06_article->SortUrl($t06_article->SatuanID) ?>',2);"><div id="elh_t06_article_SatuanID" class="t06_article_SatuanID">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t06_article->SatuanID->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t06_article->SatuanID->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t06_article->SatuanID->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t06_article->Harga->Visible) { // Harga ?>
	<?php if ($t06_article->SortUrl($t06_article->Harga) == "") { ?>
		<th data-name="Harga" class="<?php echo $t06_article->Harga->HeaderCellClass() ?>"><div id="elh_t06_article_Harga" class="t06_article_Harga"><div class="ewTableHeaderCaption"><?php echo $t06_article->Harga->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Harga" class="<?php echo $t06_article->Harga->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t06_article->SortUrl($t06_article->Harga) ?>',2);"><div id="elh_t06_article_Harga" class="t06_article_Harga">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t06_article->Harga->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t06_article->Harga->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t06_article->Harga->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t06_article->HargaJual->Visible) { // HargaJual ?>
	<?php if ($t06_article->SortUrl($t06_article->HargaJual) == "") { ?>
		<th data-name="HargaJual" class="<?php echo $t06_article->HargaJual->HeaderCellClass() ?>"><div id="elh_t06_article_HargaJual" class="t06_article_HargaJual"><div class="ewTableHeaderCaption"><?php echo $t06_article->HargaJual->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="HargaJual" class="<?php echo $t06_article->HargaJual->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t06_article->SortUrl($t06_article->HargaJual) ?>',2);"><div id="elh_t06_article_HargaJual" class="t06_article_HargaJual">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t06_article->HargaJual->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t06_article->HargaJual->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t06_article->HargaJual->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t06_article_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($t06_article->CurrentAction == "add" || $t06_article->CurrentAction == "copy") {
		$t06_article_list->RowIndex = 0;
		$t06_article_list->KeyCount = $t06_article_list->RowIndex;
		if ($t06_article->CurrentAction == "add")
			$t06_article_list->LoadRowValues();
		if ($t06_article->EventCancelled) // Insert failed
			$t06_article_list->RestoreFormValues(); // Restore form values

		// Set row properties
		$t06_article->ResetAttrs();
		$t06_article->RowAttrs = array_merge($t06_article->RowAttrs, array('data-rowindex'=>0, 'id'=>'r0_t06_article', 'data-rowtype'=>EW_ROWTYPE_ADD));
		$t06_article->RowType = EW_ROWTYPE_ADD;

		// Render row
		$t06_article_list->RenderRow();

		// Render list options
		$t06_article_list->RenderListOptions();
		$t06_article_list->StartRowCnt = 0;
?>
	<tr<?php echo $t06_article->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t06_article_list->ListOptions->Render("body", "left", $t06_article_list->RowCnt);
?>
	<?php if ($t06_article->MainGroupID->Visible) { // MainGroupID ?>
		<td data-name="MainGroupID">
<span id="el<?php echo $t06_article_list->RowCnt ?>_t06_article_MainGroupID" class="form-group t06_article_MainGroupID">
<?php $t06_article->MainGroupID->EditAttrs["onchange"] = "ew_UpdateOpt.call(this); " . @$t06_article->MainGroupID->EditAttrs["onchange"]; ?>
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $t06_article_list->RowIndex ?>_MainGroupID"><?php echo (strval($t06_article->MainGroupID->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t06_article->MainGroupID->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t06_article->MainGroupID->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t06_article_list->RowIndex ?>_MainGroupID',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($t06_article->MainGroupID->ReadOnly || $t06_article->MainGroupID->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t06_article" data-field="x_MainGroupID" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t06_article->MainGroupID->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t06_article_list->RowIndex ?>_MainGroupID" id="x<?php echo $t06_article_list->RowIndex ?>_MainGroupID" value="<?php echo $t06_article->MainGroupID->CurrentValue ?>"<?php echo $t06_article->MainGroupID->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t06_article" data-field="x_MainGroupID" name="o<?php echo $t06_article_list->RowIndex ?>_MainGroupID" id="o<?php echo $t06_article_list->RowIndex ?>_MainGroupID" value="<?php echo ew_HtmlEncode($t06_article->MainGroupID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t06_article->SubGroupID->Visible) { // SubGroupID ?>
		<td data-name="SubGroupID">
<span id="el<?php echo $t06_article_list->RowCnt ?>_t06_article_SubGroupID" class="form-group t06_article_SubGroupID">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $t06_article_list->RowIndex ?>_SubGroupID"><?php echo (strval($t06_article->SubGroupID->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t06_article->SubGroupID->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t06_article->SubGroupID->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t06_article_list->RowIndex ?>_SubGroupID',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($t06_article->SubGroupID->ReadOnly || $t06_article->SubGroupID->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t06_article" data-field="x_SubGroupID" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t06_article->SubGroupID->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t06_article_list->RowIndex ?>_SubGroupID" id="x<?php echo $t06_article_list->RowIndex ?>_SubGroupID" value="<?php echo $t06_article->SubGroupID->CurrentValue ?>"<?php echo $t06_article->SubGroupID->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t06_article" data-field="x_SubGroupID" name="o<?php echo $t06_article_list->RowIndex ?>_SubGroupID" id="o<?php echo $t06_article_list->RowIndex ?>_SubGroupID" value="<?php echo ew_HtmlEncode($t06_article->SubGroupID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t06_article->Kode->Visible) { // Kode ?>
		<td data-name="Kode">
<span id="el<?php echo $t06_article_list->RowCnt ?>_t06_article_Kode" class="form-group t06_article_Kode">
<input type="text" data-table="t06_article" data-field="x_Kode" name="x<?php echo $t06_article_list->RowIndex ?>_Kode" id="x<?php echo $t06_article_list->RowIndex ?>_Kode" size="5" maxlength="7" placeholder="<?php echo ew_HtmlEncode($t06_article->Kode->getPlaceHolder()) ?>" value="<?php echo $t06_article->Kode->EditValue ?>"<?php echo $t06_article->Kode->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t06_article" data-field="x_Kode" name="o<?php echo $t06_article_list->RowIndex ?>_Kode" id="o<?php echo $t06_article_list->RowIndex ?>_Kode" value="<?php echo ew_HtmlEncode($t06_article->Kode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t06_article->Nama->Visible) { // Nama ?>
		<td data-name="Nama">
<span id="el<?php echo $t06_article_list->RowCnt ?>_t06_article_Nama" class="form-group t06_article_Nama">
<input type="text" data-table="t06_article" data-field="x_Nama" name="x<?php echo $t06_article_list->RowIndex ?>_Nama" id="x<?php echo $t06_article_list->RowIndex ?>_Nama" size="15" maxlength="75" placeholder="<?php echo ew_HtmlEncode($t06_article->Nama->getPlaceHolder()) ?>" value="<?php echo $t06_article->Nama->EditValue ?>"<?php echo $t06_article->Nama->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t06_article" data-field="x_Nama" name="o<?php echo $t06_article_list->RowIndex ?>_Nama" id="o<?php echo $t06_article_list->RowIndex ?>_Nama" value="<?php echo ew_HtmlEncode($t06_article->Nama->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t06_article->Qty->Visible) { // Qty ?>
		<td data-name="Qty">
<span id="el<?php echo $t06_article_list->RowCnt ?>_t06_article_Qty" class="form-group t06_article_Qty">
<input type="text" data-table="t06_article" data-field="x_Qty" name="x<?php echo $t06_article_list->RowIndex ?>_Qty" id="x<?php echo $t06_article_list->RowIndex ?>_Qty" size="4" placeholder="<?php echo ew_HtmlEncode($t06_article->Qty->getPlaceHolder()) ?>" value="<?php echo $t06_article->Qty->EditValue ?>"<?php echo $t06_article->Qty->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t06_article" data-field="x_Qty" name="o<?php echo $t06_article_list->RowIndex ?>_Qty" id="o<?php echo $t06_article_list->RowIndex ?>_Qty" value="<?php echo ew_HtmlEncode($t06_article->Qty->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t06_article->SatuanID->Visible) { // SatuanID ?>
		<td data-name="SatuanID">
<span id="el<?php echo $t06_article_list->RowCnt ?>_t06_article_SatuanID" class="form-group t06_article_SatuanID">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $t06_article_list->RowIndex ?>_SatuanID"><?php echo (strval($t06_article->SatuanID->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t06_article->SatuanID->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t06_article->SatuanID->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t06_article_list->RowIndex ?>_SatuanID',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($t06_article->SatuanID->ReadOnly || $t06_article->SatuanID->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t06_article" data-field="x_SatuanID" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t06_article->SatuanID->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t06_article_list->RowIndex ?>_SatuanID" id="x<?php echo $t06_article_list->RowIndex ?>_SatuanID" value="<?php echo $t06_article->SatuanID->CurrentValue ?>"<?php echo $t06_article->SatuanID->EditAttributes() ?>>
<?php if (AllowAdd(CurrentProjectID() . "t07_satuan") && !$t06_article->SatuanID->ReadOnly) { ?>
<button type="button" title="<?php echo ew_HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $t06_article->SatuanID->FldCaption() ?>" onclick="ew_AddOptDialogShow({lnk:this,el:'x<?php echo $t06_article_list->RowIndex ?>_SatuanID',url:'t07_satuanaddopt.php'});" class="ewAddOptBtn btn btn-default btn-sm" id="aol_x<?php echo $t06_article_list->RowIndex ?>_SatuanID"><span class="glyphicon glyphicon-plus ewIcon"></span><span class="hide"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $t06_article->SatuanID->FldCaption() ?></span></button>
<?php } ?>
</span>
<input type="hidden" data-table="t06_article" data-field="x_SatuanID" name="o<?php echo $t06_article_list->RowIndex ?>_SatuanID" id="o<?php echo $t06_article_list->RowIndex ?>_SatuanID" value="<?php echo ew_HtmlEncode($t06_article->SatuanID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t06_article->Harga->Visible) { // Harga ?>
		<td data-name="Harga">
<span id="el<?php echo $t06_article_list->RowCnt ?>_t06_article_Harga" class="form-group t06_article_Harga">
<input type="text" data-table="t06_article" data-field="x_Harga" name="x<?php echo $t06_article_list->RowIndex ?>_Harga" id="x<?php echo $t06_article_list->RowIndex ?>_Harga" size="7" placeholder="<?php echo ew_HtmlEncode($t06_article->Harga->getPlaceHolder()) ?>" value="<?php echo $t06_article->Harga->EditValue ?>"<?php echo $t06_article->Harga->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t06_article" data-field="x_Harga" name="o<?php echo $t06_article_list->RowIndex ?>_Harga" id="o<?php echo $t06_article_list->RowIndex ?>_Harga" value="<?php echo ew_HtmlEncode($t06_article->Harga->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t06_article->HargaJual->Visible) { // HargaJual ?>
		<td data-name="HargaJual">
<span id="el<?php echo $t06_article_list->RowCnt ?>_t06_article_HargaJual" class="form-group t06_article_HargaJual">
<input type="text" data-table="t06_article" data-field="x_HargaJual" name="x<?php echo $t06_article_list->RowIndex ?>_HargaJual" id="x<?php echo $t06_article_list->RowIndex ?>_HargaJual" size="7" placeholder="<?php echo ew_HtmlEncode($t06_article->HargaJual->getPlaceHolder()) ?>" value="<?php echo $t06_article->HargaJual->EditValue ?>"<?php echo $t06_article->HargaJual->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t06_article" data-field="x_HargaJual" name="o<?php echo $t06_article_list->RowIndex ?>_HargaJual" id="o<?php echo $t06_article_list->RowIndex ?>_HargaJual" value="<?php echo ew_HtmlEncode($t06_article->HargaJual->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t06_article_list->ListOptions->Render("body", "right", $t06_article_list->RowCnt);
?>
<script type="text/javascript">
ft06_articlelist.UpdateOpts(<?php echo $t06_article_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
<?php
if ($t06_article->ExportAll && $t06_article->Export <> "") {
	$t06_article_list->StopRec = $t06_article_list->TotalRecs;
} else {

	// Set the last record to display
	if ($t06_article_list->TotalRecs > $t06_article_list->StartRec + $t06_article_list->DisplayRecs - 1)
		$t06_article_list->StopRec = $t06_article_list->StartRec + $t06_article_list->DisplayRecs - 1;
	else
		$t06_article_list->StopRec = $t06_article_list->TotalRecs;
}

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($t06_article_list->FormKeyCountName) && ($t06_article->CurrentAction == "gridadd" || $t06_article->CurrentAction == "gridedit" || $t06_article->CurrentAction == "F")) {
		$t06_article_list->KeyCount = $objForm->GetValue($t06_article_list->FormKeyCountName);
		$t06_article_list->StopRec = $t06_article_list->StartRec + $t06_article_list->KeyCount - 1;
	}
}
$t06_article_list->RecCnt = $t06_article_list->StartRec - 1;
if ($t06_article_list->Recordset && !$t06_article_list->Recordset->EOF) {
	$t06_article_list->Recordset->MoveFirst();
	$bSelectLimit = $t06_article_list->UseSelectLimit;
	if (!$bSelectLimit && $t06_article_list->StartRec > 1)
		$t06_article_list->Recordset->Move($t06_article_list->StartRec - 1);
} elseif (!$t06_article->AllowAddDeleteRow && $t06_article_list->StopRec == 0) {
	$t06_article_list->StopRec = $t06_article->GridAddRowCount;
}

// Initialize aggregate
$t06_article->RowType = EW_ROWTYPE_AGGREGATEINIT;
$t06_article->ResetAttrs();
$t06_article_list->RenderRow();
$t06_article_list->EditRowCnt = 0;
if ($t06_article->CurrentAction == "edit")
	$t06_article_list->RowIndex = 1;
while ($t06_article_list->RecCnt < $t06_article_list->StopRec) {
	$t06_article_list->RecCnt++;
	if (intval($t06_article_list->RecCnt) >= intval($t06_article_list->StartRec)) {
		$t06_article_list->RowCnt++;

		// Set up key count
		$t06_article_list->KeyCount = $t06_article_list->RowIndex;

		// Init row class and style
		$t06_article->ResetAttrs();
		$t06_article->CssClass = "";
		if ($t06_article->CurrentAction == "gridadd") {
			$t06_article_list->LoadRowValues(); // Load default values
		} else {
			$t06_article_list->LoadRowValues($t06_article_list->Recordset); // Load row values
		}
		$t06_article->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($t06_article->CurrentAction == "edit") {
			if ($t06_article_list->CheckInlineEditKey() && $t06_article_list->EditRowCnt == 0) { // Inline edit
				$t06_article->RowType = EW_ROWTYPE_EDIT; // Render edit
			}
		}
		if ($t06_article->CurrentAction == "edit" && $t06_article->RowType == EW_ROWTYPE_EDIT && $t06_article->EventCancelled) { // Update failed
			$objForm->Index = 1;
			$t06_article_list->RestoreFormValues(); // Restore form values
		}
		if ($t06_article->RowType == EW_ROWTYPE_EDIT) // Edit row
			$t06_article_list->EditRowCnt++;

		// Set up row id / data-rowindex
		$t06_article->RowAttrs = array_merge($t06_article->RowAttrs, array('data-rowindex'=>$t06_article_list->RowCnt, 'id'=>'r' . $t06_article_list->RowCnt . '_t06_article', 'data-rowtype'=>$t06_article->RowType));

		// Render row
		$t06_article_list->RenderRow();

		// Render list options
		$t06_article_list->RenderListOptions();
?>
	<tr<?php echo $t06_article->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t06_article_list->ListOptions->Render("body", "left", $t06_article_list->RowCnt);
?>
	<?php if ($t06_article->MainGroupID->Visible) { // MainGroupID ?>
		<td data-name="MainGroupID"<?php echo $t06_article->MainGroupID->CellAttributes() ?>>
<?php if ($t06_article->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t06_article_list->RowCnt ?>_t06_article_MainGroupID" class="form-group t06_article_MainGroupID">
<?php $t06_article->MainGroupID->EditAttrs["onchange"] = "ew_UpdateOpt.call(this); " . @$t06_article->MainGroupID->EditAttrs["onchange"]; ?>
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $t06_article_list->RowIndex ?>_MainGroupID"><?php echo (strval($t06_article->MainGroupID->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t06_article->MainGroupID->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t06_article->MainGroupID->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t06_article_list->RowIndex ?>_MainGroupID',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($t06_article->MainGroupID->ReadOnly || $t06_article->MainGroupID->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t06_article" data-field="x_MainGroupID" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t06_article->MainGroupID->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t06_article_list->RowIndex ?>_MainGroupID" id="x<?php echo $t06_article_list->RowIndex ?>_MainGroupID" value="<?php echo $t06_article->MainGroupID->CurrentValue ?>"<?php echo $t06_article->MainGroupID->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t06_article->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t06_article_list->RowCnt ?>_t06_article_MainGroupID" class="t06_article_MainGroupID">
<span<?php echo $t06_article->MainGroupID->ViewAttributes() ?>>
<?php echo $t06_article->MainGroupID->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php if ($t06_article->RowType == EW_ROWTYPE_EDIT || $t06_article->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t06_article" data-field="x_id" name="x<?php echo $t06_article_list->RowIndex ?>_id" id="x<?php echo $t06_article_list->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t06_article->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($t06_article->SubGroupID->Visible) { // SubGroupID ?>
		<td data-name="SubGroupID"<?php echo $t06_article->SubGroupID->CellAttributes() ?>>
<?php if ($t06_article->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t06_article_list->RowCnt ?>_t06_article_SubGroupID" class="form-group t06_article_SubGroupID">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $t06_article_list->RowIndex ?>_SubGroupID"><?php echo (strval($t06_article->SubGroupID->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t06_article->SubGroupID->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t06_article->SubGroupID->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t06_article_list->RowIndex ?>_SubGroupID',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($t06_article->SubGroupID->ReadOnly || $t06_article->SubGroupID->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t06_article" data-field="x_SubGroupID" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t06_article->SubGroupID->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t06_article_list->RowIndex ?>_SubGroupID" id="x<?php echo $t06_article_list->RowIndex ?>_SubGroupID" value="<?php echo $t06_article->SubGroupID->CurrentValue ?>"<?php echo $t06_article->SubGroupID->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t06_article->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t06_article_list->RowCnt ?>_t06_article_SubGroupID" class="t06_article_SubGroupID">
<span<?php echo $t06_article->SubGroupID->ViewAttributes() ?>>
<?php echo $t06_article->SubGroupID->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t06_article->Kode->Visible) { // Kode ?>
		<td data-name="Kode"<?php echo $t06_article->Kode->CellAttributes() ?>>
<?php if ($t06_article->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t06_article_list->RowCnt ?>_t06_article_Kode" class="form-group t06_article_Kode">
<input type="text" data-table="t06_article" data-field="x_Kode" name="x<?php echo $t06_article_list->RowIndex ?>_Kode" id="x<?php echo $t06_article_list->RowIndex ?>_Kode" size="5" maxlength="7" placeholder="<?php echo ew_HtmlEncode($t06_article->Kode->getPlaceHolder()) ?>" value="<?php echo $t06_article->Kode->EditValue ?>"<?php echo $t06_article->Kode->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t06_article->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t06_article_list->RowCnt ?>_t06_article_Kode" class="t06_article_Kode">
<span<?php echo $t06_article->Kode->ViewAttributes() ?>>
<?php echo $t06_article->Kode->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t06_article->Nama->Visible) { // Nama ?>
		<td data-name="Nama"<?php echo $t06_article->Nama->CellAttributes() ?>>
<?php if ($t06_article->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t06_article_list->RowCnt ?>_t06_article_Nama" class="form-group t06_article_Nama">
<input type="text" data-table="t06_article" data-field="x_Nama" name="x<?php echo $t06_article_list->RowIndex ?>_Nama" id="x<?php echo $t06_article_list->RowIndex ?>_Nama" size="15" maxlength="75" placeholder="<?php echo ew_HtmlEncode($t06_article->Nama->getPlaceHolder()) ?>" value="<?php echo $t06_article->Nama->EditValue ?>"<?php echo $t06_article->Nama->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t06_article->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t06_article_list->RowCnt ?>_t06_article_Nama" class="t06_article_Nama">
<span<?php echo $t06_article->Nama->ViewAttributes() ?>>
<?php echo $t06_article->Nama->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t06_article->Qty->Visible) { // Qty ?>
		<td data-name="Qty"<?php echo $t06_article->Qty->CellAttributes() ?>>
<?php if ($t06_article->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t06_article_list->RowCnt ?>_t06_article_Qty" class="form-group t06_article_Qty">
<input type="text" data-table="t06_article" data-field="x_Qty" name="x<?php echo $t06_article_list->RowIndex ?>_Qty" id="x<?php echo $t06_article_list->RowIndex ?>_Qty" size="4" placeholder="<?php echo ew_HtmlEncode($t06_article->Qty->getPlaceHolder()) ?>" value="<?php echo $t06_article->Qty->EditValue ?>"<?php echo $t06_article->Qty->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t06_article->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t06_article_list->RowCnt ?>_t06_article_Qty" class="t06_article_Qty">
<span<?php echo $t06_article->Qty->ViewAttributes() ?>>
<?php echo $t06_article->Qty->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t06_article->SatuanID->Visible) { // SatuanID ?>
		<td data-name="SatuanID"<?php echo $t06_article->SatuanID->CellAttributes() ?>>
<?php if ($t06_article->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t06_article_list->RowCnt ?>_t06_article_SatuanID" class="form-group t06_article_SatuanID">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $t06_article_list->RowIndex ?>_SatuanID"><?php echo (strval($t06_article->SatuanID->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t06_article->SatuanID->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t06_article->SatuanID->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t06_article_list->RowIndex ?>_SatuanID',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($t06_article->SatuanID->ReadOnly || $t06_article->SatuanID->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t06_article" data-field="x_SatuanID" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t06_article->SatuanID->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t06_article_list->RowIndex ?>_SatuanID" id="x<?php echo $t06_article_list->RowIndex ?>_SatuanID" value="<?php echo $t06_article->SatuanID->CurrentValue ?>"<?php echo $t06_article->SatuanID->EditAttributes() ?>>
<?php if (AllowAdd(CurrentProjectID() . "t07_satuan") && !$t06_article->SatuanID->ReadOnly) { ?>
<button type="button" title="<?php echo ew_HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $t06_article->SatuanID->FldCaption() ?>" onclick="ew_AddOptDialogShow({lnk:this,el:'x<?php echo $t06_article_list->RowIndex ?>_SatuanID',url:'t07_satuanaddopt.php'});" class="ewAddOptBtn btn btn-default btn-sm" id="aol_x<?php echo $t06_article_list->RowIndex ?>_SatuanID"><span class="glyphicon glyphicon-plus ewIcon"></span><span class="hide"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $t06_article->SatuanID->FldCaption() ?></span></button>
<?php } ?>
</span>
<?php } ?>
<?php if ($t06_article->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t06_article_list->RowCnt ?>_t06_article_SatuanID" class="t06_article_SatuanID">
<span<?php echo $t06_article->SatuanID->ViewAttributes() ?>>
<?php echo $t06_article->SatuanID->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t06_article->Harga->Visible) { // Harga ?>
		<td data-name="Harga"<?php echo $t06_article->Harga->CellAttributes() ?>>
<?php if ($t06_article->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t06_article_list->RowCnt ?>_t06_article_Harga" class="form-group t06_article_Harga">
<input type="text" data-table="t06_article" data-field="x_Harga" name="x<?php echo $t06_article_list->RowIndex ?>_Harga" id="x<?php echo $t06_article_list->RowIndex ?>_Harga" size="7" placeholder="<?php echo ew_HtmlEncode($t06_article->Harga->getPlaceHolder()) ?>" value="<?php echo $t06_article->Harga->EditValue ?>"<?php echo $t06_article->Harga->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t06_article->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t06_article_list->RowCnt ?>_t06_article_Harga" class="t06_article_Harga">
<span<?php echo $t06_article->Harga->ViewAttributes() ?>>
<?php echo $t06_article->Harga->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t06_article->HargaJual->Visible) { // HargaJual ?>
		<td data-name="HargaJual"<?php echo $t06_article->HargaJual->CellAttributes() ?>>
<?php if ($t06_article->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t06_article_list->RowCnt ?>_t06_article_HargaJual" class="form-group t06_article_HargaJual">
<input type="text" data-table="t06_article" data-field="x_HargaJual" name="x<?php echo $t06_article_list->RowIndex ?>_HargaJual" id="x<?php echo $t06_article_list->RowIndex ?>_HargaJual" size="7" placeholder="<?php echo ew_HtmlEncode($t06_article->HargaJual->getPlaceHolder()) ?>" value="<?php echo $t06_article->HargaJual->EditValue ?>"<?php echo $t06_article->HargaJual->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t06_article->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t06_article_list->RowCnt ?>_t06_article_HargaJual" class="t06_article_HargaJual">
<span<?php echo $t06_article->HargaJual->ViewAttributes() ?>>
<?php echo $t06_article->HargaJual->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t06_article_list->ListOptions->Render("body", "right", $t06_article_list->RowCnt);
?>
	</tr>
<?php if ($t06_article->RowType == EW_ROWTYPE_ADD || $t06_article->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
ft06_articlelist.UpdateOpts(<?php echo $t06_article_list->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	if ($t06_article->CurrentAction <> "gridadd")
		$t06_article_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($t06_article->CurrentAction == "add" || $t06_article->CurrentAction == "copy") { ?>
<input type="hidden" name="<?php echo $t06_article_list->FormKeyCountName ?>" id="<?php echo $t06_article_list->FormKeyCountName ?>" value="<?php echo $t06_article_list->KeyCount ?>">
<?php } ?>
<?php if ($t06_article->CurrentAction == "edit") { ?>
<input type="hidden" name="<?php echo $t06_article_list->FormKeyCountName ?>" id="<?php echo $t06_article_list->FormKeyCountName ?>" value="<?php echo $t06_article_list->KeyCount ?>">
<?php } ?>
<?php if ($t06_article->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($t06_article_list->Recordset)
	$t06_article_list->Recordset->Close();
?>
<?php if ($t06_article->Export == "") { ?>
<div class="box-footer ewGridLowerPanel">
<?php if ($t06_article->CurrentAction <> "gridadd" && $t06_article->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-inline ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($t06_article_list->Pager)) $t06_article_list->Pager = new cPrevNextPager($t06_article_list->StartRec, $t06_article_list->DisplayRecs, $t06_article_list->TotalRecs, $t06_article_list->AutoHidePager) ?>
<?php if ($t06_article_list->Pager->RecordCount > 0 && $t06_article_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($t06_article_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $t06_article_list->PageUrl() ?>start=<?php echo $t06_article_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($t06_article_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $t06_article_list->PageUrl() ?>start=<?php echo $t06_article_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $t06_article_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($t06_article_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $t06_article_list->PageUrl() ?>start=<?php echo $t06_article_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($t06_article_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $t06_article_list->PageUrl() ?>start=<?php echo $t06_article_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $t06_article_list->Pager->PageCount ?></span>
</div>
<?php } ?>
<?php if ($t06_article_list->Pager->RecordCount > 0) { ?>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $t06_article_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $t06_article_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $t06_article_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($t06_article_list->TotalRecs > 0 && (!$t06_article_list->AutoHidePageSizeSelector || $t06_article_list->Pager->Visible)) { ?>
<div class="ewPager">
<input type="hidden" name="t" value="t06_article">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" class="form-control input-sm ewTooltip" title="<?php echo $Language->Phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($t06_article_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($t06_article_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($t06_article_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($t06_article_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($t06_article_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="ALL"<?php if ($t06_article->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t06_article_list->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div>
<?php } ?>
<?php if ($t06_article_list->TotalRecs == 0 && $t06_article->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t06_article_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($t06_article->Export == "") { ?>
<script type="text/javascript">
ft06_articlelistsrch.FilterList = <?php echo $t06_article_list->GetFilterList() ?>;
ft06_articlelistsrch.Init();
ft06_articlelist.Init();
</script>
<?php } ?>
<?php
$t06_article_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($t06_article->Export == "") { ?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$t06_article_list->Page_Terminate();
?>
