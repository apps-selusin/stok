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

$t09_hutang_list = NULL; // Initialize page object first

class ct09_hutang_list extends ct09_hutang {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = '{8746EF3F-81FE-4C1C-A7F8-AC191F8DDBB2}';

	// Table name
	var $TableName = 't09_hutang';

	// Page object name
	var $PageObjName = 't09_hutang_list';

	// Grid form hidden field names
	var $FormName = 'ft09_hutanglist';
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

		// Table object (t09_hutang)
		if (!isset($GLOBALS["t09_hutang"]) || get_class($GLOBALS["t09_hutang"]) == "ct09_hutang") {
			$GLOBALS["t09_hutang"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t09_hutang"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "t09_hutangadd.php?" . EW_TABLE_SHOW_DETAIL . "=";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "t09_hutangdelete.php";
		$this->MultiUpdateUrl = "t09_hutangupdate.php";

		// Table object (t96_employees)
		if (!isset($GLOBALS['t96_employees'])) $GLOBALS['t96_employees'] = new ct96_employees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

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
		$this->FilterOptions->TagClassName = "ewFilterOption ft09_hutanglistsrch";

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

		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->SetupListOptions();
		$this->NoHutang->SetVisibility();
		$this->BeliID->SetVisibility();
		$this->JumlahHutang->SetVisibility();
		$this->JumlahBayar->SetVisibility();
		$this->SaldoHutang->SetVisibility();

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
			$this->UpdateSort($this->NoHutang, $bCtrl); // NoHutang
			$this->UpdateSort($this->BeliID, $bCtrl); // BeliID
			$this->UpdateSort($this->JumlahHutang, $bCtrl); // JumlahHutang
			$this->UpdateSort($this->JumlahBayar, $bCtrl); // JumlahBayar
			$this->UpdateSort($this->SaldoHutang, $bCtrl); // SaldoHutang
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
				$this->NoHutang->setSort("ASC");
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
				$this->NoHutang->setSort("");
				$this->BeliID->setSort("");
				$this->JumlahHutang->setSort("");
				$this->JumlahBayar->setSort("");
				$this->SaldoHutang->setSort("");
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

		// "detail_t10_hutangdetail"
		$item = &$this->ListOptions->Add("detail_t10_hutangdetail");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->AllowList(CurrentProjectID() . 't10_hutangdetail') && !$this->ShowMultipleDetails;
		$item->OnLeft = TRUE;
		$item->ShowInButtonGroup = FALSE;
		if (!isset($GLOBALS["t10_hutangdetail_grid"])) $GLOBALS["t10_hutangdetail_grid"] = new ct10_hutangdetail_grid;

		// Multiple details
		if ($this->ShowMultipleDetails) {
			$item = &$this->ListOptions->Add("details");
			$item->CssClass = "text-nowrap";
			$item->Visible = $this->ShowMultipleDetails;
			$item->OnLeft = TRUE;
			$item->ShowInButtonGroup = FALSE;
		}

		// Set up detail pages
		$pages = new cSubPages();
		$pages->Add("t10_hutangdetail");
		$this->DetailPages = $pages;

		// List actions
		$item = &$this->ListOptions->Add("listactions");
		$item->CssClass = "text-nowrap";
		$item->OnLeft = TRUE;
		$item->Visible = FALSE;
		$item->ShowInButtonGroup = FALSE;
		$item->ShowInDropDown = FALSE;

		// "checkbox"
		$item = &$this->ListOptions->Add("checkbox");
		$item->Visible = FALSE;
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

		// "sequence"
		$oListOpt = &$this->ListOptions->Items["sequence"];
		$oListOpt->Body = ew_FormatSeqNo($this->RecCnt);

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
		$DetailViewTblVar = "";
		$DetailCopyTblVar = "";
		$DetailEditTblVar = "";

		// "detail_t10_hutangdetail"
		$oListOpt = &$this->ListOptions->Items["detail_t10_hutangdetail"];
		if ($Security->AllowList(CurrentProjectID() . 't10_hutangdetail')) {
			$body = $Language->Phrase("DetailLink") . $Language->TablePhrase("t10_hutangdetail", "TblCaption");
			$body = "<a class=\"btn btn-default btn-sm ewRowLink ewDetail\" data-action=\"list\" href=\"" . ew_HtmlEncode("t10_hutangdetaillist.php?" . EW_TABLE_SHOW_MASTER . "=t09_hutang&fk_id=" . urlencode(strval($this->id->CurrentValue)) . "") . "\">" . $body . "</a>";
			$links = "";
			if ($links <> "") {
				$body .= "<button class=\"dropdown-toggle btn btn-default btn-sm ewDetail\" data-toggle=\"dropdown\"><b class=\"caret\"></b></button>";
				$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
			}
			$body = "<div class=\"btn-group\">" . $body . "</div>";
			$oListOpt->Body = $body;
			if ($this->ShowMultipleDetails) $oListOpt->Visible = FALSE;
		}
		if ($this->ShowMultipleDetails) {
			$body = $Language->Phrase("MultipleMasterDetails");
			$body = "<div class=\"btn-group\">";
			$links = "";
			if ($DetailViewTblVar <> "") {
				$links .= "<li><a class=\"ewRowLink ewDetailView\" data-action=\"view\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("MasterDetailViewLink")) . "\" href=\"" . ew_HtmlEncode($this->GetViewUrl(EW_TABLE_SHOW_DETAIL . "=" . $DetailViewTblVar)) . "\">" . ew_HtmlImageAndText($Language->Phrase("MasterDetailViewLink")) . "</a></li>";
			}
			if ($DetailEditTblVar <> "") {
				$links .= "<li><a class=\"ewRowLink ewDetailEdit\" data-action=\"edit\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("MasterDetailEditLink")) . "\" href=\"" . ew_HtmlEncode($this->GetEditUrl(EW_TABLE_SHOW_DETAIL . "=" . $DetailEditTblVar)) . "\">" . ew_HtmlImageAndText($Language->Phrase("MasterDetailEditLink")) . "</a></li>";
			}
			if ($DetailCopyTblVar <> "") {
				$links .= "<li><a class=\"ewRowLink ewDetailCopy\" data-action=\"add\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("MasterDetailCopyLink")) . "\" href=\"" . ew_HtmlEncode($this->GetCopyUrl(EW_TABLE_SHOW_DETAIL . "=" . $DetailCopyTblVar)) . "\">" . ew_HtmlImageAndText($Language->Phrase("MasterDetailCopyLink")) . "</a></li>";
			}
			if ($links <> "") {
				$body .= "<button class=\"dropdown-toggle btn btn-default btn-sm ewMasterDetail\" title=\"" . ew_HtmlTitle($Language->Phrase("MultipleMasterDetails")) . "\" data-toggle=\"dropdown\">" . $Language->Phrase("MultipleMasterDetails") . "<b class=\"caret\"></b></button>";
				$body .= "<ul class=\"dropdown-menu ewMenu\">". $links . "</ul>";
			}
			$body .= "</div>";

			// Multiple details
			$oListOpt = &$this->ListOptions->Items["details"];
			$oListOpt->Body = $body;
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
		$option = $options["action"];

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
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"ft09_hutanglistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = FALSE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"ft09_hutanglistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
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
					$item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.ft09_hutanglist}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
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
		$this->NoHutang->setDbValue($row['NoHutang']);
		$this->BeliID->setDbValue($row['BeliID']);
		if (array_key_exists('EV__BeliID', $rs->fields)) {
			$this->BeliID->VirtualValue = $rs->fields('EV__BeliID'); // Set up virtual field value
		} else {
			$this->BeliID->VirtualValue = ""; // Clear value
		}
		$this->JumlahHutang->setDbValue($row['JumlahHutang']);
		$this->JumlahBayar->setDbValue($row['JumlahBayar']);
		$this->SaldoHutang->setDbValue($row['SaldoHutang']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['id'] = NULL;
		$row['NoHutang'] = NULL;
		$row['BeliID'] = NULL;
		$row['JumlahHutang'] = NULL;
		$row['JumlahBayar'] = NULL;
		$row['SaldoHutang'] = NULL;
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
		$this->SaldoHutang->DbValue = $row['SaldoHutang'];
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
		if ($this->JumlahHutang->FormValue == $this->JumlahHutang->CurrentValue && is_numeric(ew_StrToFloat($this->JumlahHutang->CurrentValue)))
			$this->JumlahHutang->CurrentValue = ew_StrToFloat($this->JumlahHutang->CurrentValue);

		// Convert decimal values if posted back
		if ($this->JumlahBayar->FormValue == $this->JumlahBayar->CurrentValue && is_numeric(ew_StrToFloat($this->JumlahBayar->CurrentValue)))
			$this->JumlahBayar->CurrentValue = ew_StrToFloat($this->JumlahBayar->CurrentValue);

		// Convert decimal values if posted back
		if ($this->SaldoHutang->FormValue == $this->SaldoHutang->CurrentValue && is_numeric(ew_StrToFloat($this->SaldoHutang->CurrentValue)))
			$this->SaldoHutang->CurrentValue = ew_StrToFloat($this->SaldoHutang->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// NoHutang
		// BeliID
		// JumlahHutang
		// JumlahBayar
		// SaldoHutang
		// Accumulate aggregate value

		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT && $this->RowType <> EW_ROWTYPE_AGGREGATE) {
			if (is_numeric($this->JumlahHutang->CurrentValue))
				$this->JumlahHutang->Total += $this->JumlahHutang->CurrentValue; // Accumulate total
			if (is_numeric($this->JumlahBayar->CurrentValue))
				$this->JumlahBayar->Total += $this->JumlahBayar->CurrentValue; // Accumulate total
			if (is_numeric($this->SaldoHutang->CurrentValue))
				$this->SaldoHutang->Total += $this->SaldoHutang->CurrentValue; // Accumulate total
		}
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
		$sSqlWrk = "SELECT `id`, `TglPO` AS `DispFld`, `NoPO` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t08_beli`";
		$sWhereWrk = "";
		$this->BeliID->LookupFilters = array("df1" => "7", "dx1" => ew_CastDateFieldForLike('`TglPO`', 7, "DB"), "dx2" => '`NoPO`');
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->BeliID, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_FormatDateTime($rswrk->fields('DispFld'), 7);
				$arwrk[2] = $rswrk->fields('Disp2Fld');
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
		$this->JumlahHutang->CellCssStyle .= "text-align: left;";
		$this->JumlahHutang->ViewCustomAttributes = "";

		// JumlahBayar
		$this->JumlahBayar->ViewValue = $this->JumlahBayar->CurrentValue;
		$this->JumlahBayar->ViewValue = ew_FormatNumber($this->JumlahBayar->ViewValue, 2, -2, -2, -2);
		$this->JumlahBayar->CellCssStyle .= "text-align: left;";
		$this->JumlahBayar->ViewCustomAttributes = "";

		// SaldoHutang
		$this->SaldoHutang->ViewValue = $this->SaldoHutang->CurrentValue;
		$this->SaldoHutang->ViewValue = ew_FormatNumber($this->SaldoHutang->ViewValue, 2, -2, -2, -2);
		$this->SaldoHutang->CellCssStyle .= "text-align: left;";
		$this->SaldoHutang->ViewCustomAttributes = "";

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

			// SaldoHutang
			$this->SaldoHutang->LinkCustomAttributes = "";
			$this->SaldoHutang->HrefValue = "";
			$this->SaldoHutang->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_AGGREGATEINIT) { // Initialize aggregate row
			$this->JumlahHutang->Total = 0; // Initialize total
			$this->JumlahBayar->Total = 0; // Initialize total
			$this->SaldoHutang->Total = 0; // Initialize total
		} elseif ($this->RowType == EW_ROWTYPE_AGGREGATE) { // Aggregate row
			$this->JumlahHutang->CurrentValue = $this->JumlahHutang->Total;
			$this->JumlahHutang->ViewValue = $this->JumlahHutang->CurrentValue;
			$this->JumlahHutang->ViewValue = ew_FormatNumber($this->JumlahHutang->ViewValue, 2, -2, -2, -2);
			$this->JumlahHutang->CellCssStyle .= "text-align: left;";
			$this->JumlahHutang->ViewCustomAttributes = "";
			$this->JumlahHutang->HrefValue = ""; // Clear href value
			$this->JumlahBayar->CurrentValue = $this->JumlahBayar->Total;
			$this->JumlahBayar->ViewValue = $this->JumlahBayar->CurrentValue;
			$this->JumlahBayar->ViewValue = ew_FormatNumber($this->JumlahBayar->ViewValue, 2, -2, -2, -2);
			$this->JumlahBayar->CellCssStyle .= "text-align: left;";
			$this->JumlahBayar->ViewCustomAttributes = "";
			$this->JumlahBayar->HrefValue = ""; // Clear href value
			$this->SaldoHutang->CurrentValue = $this->SaldoHutang->Total;
			$this->SaldoHutang->ViewValue = $this->SaldoHutang->CurrentValue;
			$this->SaldoHutang->ViewValue = ew_FormatNumber($this->SaldoHutang->ViewValue, 2, -2, -2, -2);
			$this->SaldoHutang->CellCssStyle .= "text-align: left;";
			$this->SaldoHutang->ViewCustomAttributes = "";
			$this->SaldoHutang->HrefValue = ""; // Clear href value
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
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
if (!isset($t09_hutang_list)) $t09_hutang_list = new ct09_hutang_list();

// Page init
$t09_hutang_list->Page_Init();

// Page main
$t09_hutang_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t09_hutang_list->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "list";
var CurrentForm = ft09_hutanglist = new ew_Form("ft09_hutanglist", "list");
ft09_hutanglist.FormKeyCountName = '<?php echo $t09_hutang_list->FormKeyCountName ?>';

// Form_CustomValidate event
ft09_hutanglist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ft09_hutanglist.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ft09_hutanglist.Lists["x_BeliID"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_TglPO","x_NoPO","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t08_beli"};
ft09_hutanglist.Lists["x_BeliID"].Data = "<?php echo $t09_hutang_list->BeliID->LookupFilterQuery(FALSE, "list") ?>";
ft09_hutanglist.AutoSuggests["x_BeliID"] = <?php echo json_encode(array("data" => "ajax=autosuggest&" . $t09_hutang_list->BeliID->LookupFilterQuery(TRUE, "list"))) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<div class="ewToolbar">
<?php if ($t09_hutang_list->TotalRecs > 0 && $t09_hutang_list->ExportOptions->Visible()) { ?>
<?php $t09_hutang_list->ExportOptions->Render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php
	$bSelectLimit = $t09_hutang_list->UseSelectLimit;
	if ($bSelectLimit) {
		if ($t09_hutang_list->TotalRecs <= 0)
			$t09_hutang_list->TotalRecs = $t09_hutang->ListRecordCount();
	} else {
		if (!$t09_hutang_list->Recordset && ($t09_hutang_list->Recordset = $t09_hutang_list->LoadRecordset()))
			$t09_hutang_list->TotalRecs = $t09_hutang_list->Recordset->RecordCount();
	}
	$t09_hutang_list->StartRec = 1;
	if ($t09_hutang_list->DisplayRecs <= 0 || ($t09_hutang->Export <> "" && $t09_hutang->ExportAll)) // Display all records
		$t09_hutang_list->DisplayRecs = $t09_hutang_list->TotalRecs;
	if (!($t09_hutang->Export <> "" && $t09_hutang->ExportAll))
		$t09_hutang_list->SetupStartRec(); // Set up start record position
	if ($bSelectLimit)
		$t09_hutang_list->Recordset = $t09_hutang_list->LoadRecordset($t09_hutang_list->StartRec-1, $t09_hutang_list->DisplayRecs);

	// Set no record found message
	if ($t09_hutang->CurrentAction == "" && $t09_hutang_list->TotalRecs == 0) {
		if (!$Security->CanList())
			$t09_hutang_list->setWarningMessage(ew_DeniedMsg());
		if ($t09_hutang_list->SearchWhere == "0=101")
			$t09_hutang_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$t09_hutang_list->setWarningMessage($Language->Phrase("NoRecord"));
	}
$t09_hutang_list->RenderOtherOptions();
?>
<?php $t09_hutang_list->ShowPageHeader(); ?>
<?php
$t09_hutang_list->ShowMessage();
?>
<?php if ($t09_hutang_list->TotalRecs > 0 || $t09_hutang->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($t09_hutang_list->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> t09_hutang">
<div class="box-header ewGridUpperPanel">
<?php if ($t09_hutang->CurrentAction <> "gridadd" && $t09_hutang->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="form-inline ewForm ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($t09_hutang_list->Pager)) $t09_hutang_list->Pager = new cPrevNextPager($t09_hutang_list->StartRec, $t09_hutang_list->DisplayRecs, $t09_hutang_list->TotalRecs, $t09_hutang_list->AutoHidePager) ?>
<?php if ($t09_hutang_list->Pager->RecordCount > 0 && $t09_hutang_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($t09_hutang_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $t09_hutang_list->PageUrl() ?>start=<?php echo $t09_hutang_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($t09_hutang_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $t09_hutang_list->PageUrl() ?>start=<?php echo $t09_hutang_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $t09_hutang_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($t09_hutang_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $t09_hutang_list->PageUrl() ?>start=<?php echo $t09_hutang_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($t09_hutang_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $t09_hutang_list->PageUrl() ?>start=<?php echo $t09_hutang_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $t09_hutang_list->Pager->PageCount ?></span>
</div>
<?php } ?>
<?php if ($t09_hutang_list->Pager->RecordCount > 0) { ?>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $t09_hutang_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $t09_hutang_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $t09_hutang_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($t09_hutang_list->TotalRecs > 0 && (!$t09_hutang_list->AutoHidePageSizeSelector || $t09_hutang_list->Pager->Visible)) { ?>
<div class="ewPager">
<input type="hidden" name="t" value="t09_hutang">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" class="form-control input-sm ewTooltip" title="<?php echo $Language->Phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($t09_hutang_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($t09_hutang_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($t09_hutang_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($t09_hutang_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($t09_hutang_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="ALL"<?php if ($t09_hutang->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t09_hutang_list->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<form name="ft09_hutanglist" id="ft09_hutanglist" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t09_hutang_list->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t09_hutang_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t09_hutang">
<div id="gmp_t09_hutang" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<?php if ($t09_hutang_list->TotalRecs > 0 || $t09_hutang->CurrentAction == "gridedit") { ?>
<table id="tbl_t09_hutanglist" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$t09_hutang_list->RowType = EW_ROWTYPE_HEADER;

// Render list options
$t09_hutang_list->RenderListOptions();

// Render list options (header, left)
$t09_hutang_list->ListOptions->Render("header", "left");
?>
<?php if ($t09_hutang->NoHutang->Visible) { // NoHutang ?>
	<?php if ($t09_hutang->SortUrl($t09_hutang->NoHutang) == "") { ?>
		<th data-name="NoHutang" class="<?php echo $t09_hutang->NoHutang->HeaderCellClass() ?>"><div id="elh_t09_hutang_NoHutang" class="t09_hutang_NoHutang"><div class="ewTableHeaderCaption"><?php echo $t09_hutang->NoHutang->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NoHutang" class="<?php echo $t09_hutang->NoHutang->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t09_hutang->SortUrl($t09_hutang->NoHutang) ?>',2);"><div id="elh_t09_hutang_NoHutang" class="t09_hutang_NoHutang">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t09_hutang->NoHutang->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t09_hutang->NoHutang->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t09_hutang->NoHutang->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t09_hutang->BeliID->Visible) { // BeliID ?>
	<?php if ($t09_hutang->SortUrl($t09_hutang->BeliID) == "") { ?>
		<th data-name="BeliID" class="<?php echo $t09_hutang->BeliID->HeaderCellClass() ?>"><div id="elh_t09_hutang_BeliID" class="t09_hutang_BeliID"><div class="ewTableHeaderCaption"><?php echo $t09_hutang->BeliID->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BeliID" class="<?php echo $t09_hutang->BeliID->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t09_hutang->SortUrl($t09_hutang->BeliID) ?>',2);"><div id="elh_t09_hutang_BeliID" class="t09_hutang_BeliID">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t09_hutang->BeliID->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t09_hutang->BeliID->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t09_hutang->BeliID->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t09_hutang->JumlahHutang->Visible) { // JumlahHutang ?>
	<?php if ($t09_hutang->SortUrl($t09_hutang->JumlahHutang) == "") { ?>
		<th data-name="JumlahHutang" class="<?php echo $t09_hutang->JumlahHutang->HeaderCellClass() ?>"><div id="elh_t09_hutang_JumlahHutang" class="t09_hutang_JumlahHutang"><div class="ewTableHeaderCaption"><?php echo $t09_hutang->JumlahHutang->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="JumlahHutang" class="<?php echo $t09_hutang->JumlahHutang->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t09_hutang->SortUrl($t09_hutang->JumlahHutang) ?>',2);"><div id="elh_t09_hutang_JumlahHutang" class="t09_hutang_JumlahHutang">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t09_hutang->JumlahHutang->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t09_hutang->JumlahHutang->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t09_hutang->JumlahHutang->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t09_hutang->JumlahBayar->Visible) { // JumlahBayar ?>
	<?php if ($t09_hutang->SortUrl($t09_hutang->JumlahBayar) == "") { ?>
		<th data-name="JumlahBayar" class="<?php echo $t09_hutang->JumlahBayar->HeaderCellClass() ?>"><div id="elh_t09_hutang_JumlahBayar" class="t09_hutang_JumlahBayar"><div class="ewTableHeaderCaption"><?php echo $t09_hutang->JumlahBayar->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="JumlahBayar" class="<?php echo $t09_hutang->JumlahBayar->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t09_hutang->SortUrl($t09_hutang->JumlahBayar) ?>',2);"><div id="elh_t09_hutang_JumlahBayar" class="t09_hutang_JumlahBayar">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t09_hutang->JumlahBayar->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t09_hutang->JumlahBayar->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t09_hutang->JumlahBayar->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t09_hutang->SaldoHutang->Visible) { // SaldoHutang ?>
	<?php if ($t09_hutang->SortUrl($t09_hutang->SaldoHutang) == "") { ?>
		<th data-name="SaldoHutang" class="<?php echo $t09_hutang->SaldoHutang->HeaderCellClass() ?>"><div id="elh_t09_hutang_SaldoHutang" class="t09_hutang_SaldoHutang"><div class="ewTableHeaderCaption"><?php echo $t09_hutang->SaldoHutang->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SaldoHutang" class="<?php echo $t09_hutang->SaldoHutang->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t09_hutang->SortUrl($t09_hutang->SaldoHutang) ?>',2);"><div id="elh_t09_hutang_SaldoHutang" class="t09_hutang_SaldoHutang">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t09_hutang->SaldoHutang->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t09_hutang->SaldoHutang->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t09_hutang->SaldoHutang->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t09_hutang_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t09_hutang->ExportAll && $t09_hutang->Export <> "") {
	$t09_hutang_list->StopRec = $t09_hutang_list->TotalRecs;
} else {

	// Set the last record to display
	if ($t09_hutang_list->TotalRecs > $t09_hutang_list->StartRec + $t09_hutang_list->DisplayRecs - 1)
		$t09_hutang_list->StopRec = $t09_hutang_list->StartRec + $t09_hutang_list->DisplayRecs - 1;
	else
		$t09_hutang_list->StopRec = $t09_hutang_list->TotalRecs;
}
$t09_hutang_list->RecCnt = $t09_hutang_list->StartRec - 1;
if ($t09_hutang_list->Recordset && !$t09_hutang_list->Recordset->EOF) {
	$t09_hutang_list->Recordset->MoveFirst();
	$bSelectLimit = $t09_hutang_list->UseSelectLimit;
	if (!$bSelectLimit && $t09_hutang_list->StartRec > 1)
		$t09_hutang_list->Recordset->Move($t09_hutang_list->StartRec - 1);
} elseif (!$t09_hutang->AllowAddDeleteRow && $t09_hutang_list->StopRec == 0) {
	$t09_hutang_list->StopRec = $t09_hutang->GridAddRowCount;
}

// Initialize aggregate
$t09_hutang->RowType = EW_ROWTYPE_AGGREGATEINIT;
$t09_hutang->ResetAttrs();
$t09_hutang_list->RenderRow();
while ($t09_hutang_list->RecCnt < $t09_hutang_list->StopRec) {
	$t09_hutang_list->RecCnt++;
	if (intval($t09_hutang_list->RecCnt) >= intval($t09_hutang_list->StartRec)) {
		$t09_hutang_list->RowCnt++;

		// Set up key count
		$t09_hutang_list->KeyCount = $t09_hutang_list->RowIndex;

		// Init row class and style
		$t09_hutang->ResetAttrs();
		$t09_hutang->CssClass = "";
		if ($t09_hutang->CurrentAction == "gridadd") {
		} else {
			$t09_hutang_list->LoadRowValues($t09_hutang_list->Recordset); // Load row values
		}
		$t09_hutang->RowType = EW_ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t09_hutang->RowAttrs = array_merge($t09_hutang->RowAttrs, array('data-rowindex'=>$t09_hutang_list->RowCnt, 'id'=>'r' . $t09_hutang_list->RowCnt . '_t09_hutang', 'data-rowtype'=>$t09_hutang->RowType));

		// Render row
		$t09_hutang_list->RenderRow();

		// Render list options
		$t09_hutang_list->RenderListOptions();
?>
	<tr<?php echo $t09_hutang->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t09_hutang_list->ListOptions->Render("body", "left", $t09_hutang_list->RowCnt);
?>
	<?php if ($t09_hutang->NoHutang->Visible) { // NoHutang ?>
		<td data-name="NoHutang"<?php echo $t09_hutang->NoHutang->CellAttributes() ?>>
<span id="el<?php echo $t09_hutang_list->RowCnt ?>_t09_hutang_NoHutang" class="t09_hutang_NoHutang">
<span<?php echo $t09_hutang->NoHutang->ViewAttributes() ?>>
<?php echo $t09_hutang->NoHutang->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t09_hutang->BeliID->Visible) { // BeliID ?>
		<td data-name="BeliID"<?php echo $t09_hutang->BeliID->CellAttributes() ?>>
<span id="el<?php echo $t09_hutang_list->RowCnt ?>_t09_hutang_BeliID" class="t09_hutang_BeliID">
<span<?php echo $t09_hutang->BeliID->ViewAttributes() ?>>
<?php echo $t09_hutang->BeliID->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t09_hutang->JumlahHutang->Visible) { // JumlahHutang ?>
		<td data-name="JumlahHutang"<?php echo $t09_hutang->JumlahHutang->CellAttributes() ?>>
<span id="el<?php echo $t09_hutang_list->RowCnt ?>_t09_hutang_JumlahHutang" class="t09_hutang_JumlahHutang">
<span<?php echo $t09_hutang->JumlahHutang->ViewAttributes() ?>>
<?php echo $t09_hutang->JumlahHutang->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t09_hutang->JumlahBayar->Visible) { // JumlahBayar ?>
		<td data-name="JumlahBayar"<?php echo $t09_hutang->JumlahBayar->CellAttributes() ?>>
<span id="el<?php echo $t09_hutang_list->RowCnt ?>_t09_hutang_JumlahBayar" class="t09_hutang_JumlahBayar">
<span<?php echo $t09_hutang->JumlahBayar->ViewAttributes() ?>>
<?php echo $t09_hutang->JumlahBayar->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t09_hutang->SaldoHutang->Visible) { // SaldoHutang ?>
		<td data-name="SaldoHutang"<?php echo $t09_hutang->SaldoHutang->CellAttributes() ?>>
<span id="el<?php echo $t09_hutang_list->RowCnt ?>_t09_hutang_SaldoHutang" class="t09_hutang_SaldoHutang">
<span<?php echo $t09_hutang->SaldoHutang->ViewAttributes() ?>>
<?php echo $t09_hutang->SaldoHutang->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t09_hutang_list->ListOptions->Render("body", "right", $t09_hutang_list->RowCnt);
?>
	</tr>
<?php
	}
	if ($t09_hutang->CurrentAction <> "gridadd")
		$t09_hutang_list->Recordset->MoveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$t09_hutang->RowType = EW_ROWTYPE_AGGREGATE;
$t09_hutang->ResetAttrs();
$t09_hutang_list->RenderRow();
?>
<?php if ($t09_hutang_list->TotalRecs > 0 && ($t09_hutang->CurrentAction <> "gridadd" && $t09_hutang->CurrentAction <> "gridedit")) { ?>
<tfoot><!-- Table footer -->
	<tr class="ewTableFooter">
<?php

// Render list options
$t09_hutang_list->RenderListOptions();

// Render list options (footer, left)
$t09_hutang_list->ListOptions->Render("footer", "left");
?>
	<?php if ($t09_hutang->NoHutang->Visible) { // NoHutang ?>
		<td data-name="NoHutang" class="<?php echo $t09_hutang->NoHutang->FooterCellClass() ?>"><span id="elf_t09_hutang_NoHutang" class="t09_hutang_NoHutang">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($t09_hutang->BeliID->Visible) { // BeliID ?>
		<td data-name="BeliID" class="<?php echo $t09_hutang->BeliID->FooterCellClass() ?>"><span id="elf_t09_hutang_BeliID" class="t09_hutang_BeliID">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($t09_hutang->JumlahHutang->Visible) { // JumlahHutang ?>
		<td data-name="JumlahHutang" class="<?php echo $t09_hutang->JumlahHutang->FooterCellClass() ?>"><span id="elf_t09_hutang_JumlahHutang" class="t09_hutang_JumlahHutang">
<span class="ewAggregate"><?php echo $Language->Phrase("TOTAL") ?></span><span class="ewAggregateValue">
<?php echo $t09_hutang->JumlahHutang->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($t09_hutang->JumlahBayar->Visible) { // JumlahBayar ?>
		<td data-name="JumlahBayar" class="<?php echo $t09_hutang->JumlahBayar->FooterCellClass() ?>"><span id="elf_t09_hutang_JumlahBayar" class="t09_hutang_JumlahBayar">
<span class="ewAggregate"><?php echo $Language->Phrase("TOTAL") ?></span><span class="ewAggregateValue">
<?php echo $t09_hutang->JumlahBayar->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($t09_hutang->SaldoHutang->Visible) { // SaldoHutang ?>
		<td data-name="SaldoHutang" class="<?php echo $t09_hutang->SaldoHutang->FooterCellClass() ?>"><span id="elf_t09_hutang_SaldoHutang" class="t09_hutang_SaldoHutang">
<span class="ewAggregate"><?php echo $Language->Phrase("TOTAL") ?></span><span class="ewAggregateValue">
<?php echo $t09_hutang->SaldoHutang->ViewValue ?></span>
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$t09_hutang_list->ListOptions->Render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table>
<?php } ?>
<?php if ($t09_hutang->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($t09_hutang_list->Recordset)
	$t09_hutang_list->Recordset->Close();
?>
<div class="box-footer ewGridLowerPanel">
<?php if ($t09_hutang->CurrentAction <> "gridadd" && $t09_hutang->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-inline ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($t09_hutang_list->Pager)) $t09_hutang_list->Pager = new cPrevNextPager($t09_hutang_list->StartRec, $t09_hutang_list->DisplayRecs, $t09_hutang_list->TotalRecs, $t09_hutang_list->AutoHidePager) ?>
<?php if ($t09_hutang_list->Pager->RecordCount > 0 && $t09_hutang_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($t09_hutang_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $t09_hutang_list->PageUrl() ?>start=<?php echo $t09_hutang_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($t09_hutang_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $t09_hutang_list->PageUrl() ?>start=<?php echo $t09_hutang_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $t09_hutang_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($t09_hutang_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $t09_hutang_list->PageUrl() ?>start=<?php echo $t09_hutang_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($t09_hutang_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $t09_hutang_list->PageUrl() ?>start=<?php echo $t09_hutang_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $t09_hutang_list->Pager->PageCount ?></span>
</div>
<?php } ?>
<?php if ($t09_hutang_list->Pager->RecordCount > 0) { ?>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $t09_hutang_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $t09_hutang_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $t09_hutang_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($t09_hutang_list->TotalRecs > 0 && (!$t09_hutang_list->AutoHidePageSizeSelector || $t09_hutang_list->Pager->Visible)) { ?>
<div class="ewPager">
<input type="hidden" name="t" value="t09_hutang">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" class="form-control input-sm ewTooltip" title="<?php echo $Language->Phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($t09_hutang_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($t09_hutang_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($t09_hutang_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($t09_hutang_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($t09_hutang_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="ALL"<?php if ($t09_hutang->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t09_hutang_list->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
</div>
<?php } ?>
<?php if ($t09_hutang_list->TotalRecs == 0 && $t09_hutang->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t09_hutang_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<script type="text/javascript">
ft09_hutanglist.Init();
</script>
<?php
$t09_hutang_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t09_hutang_list->Page_Terminate();
?>
