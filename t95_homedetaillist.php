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

$t95_homedetail_list = NULL; // Initialize page object first

class ct95_homedetail_list extends ct95_homedetail {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = '{8746EF3F-81FE-4C1C-A7F8-AC191F8DDBB2}';

	// Table name
	var $TableName = 't95_homedetail';

	// Page object name
	var $PageObjName = 't95_homedetail_list';

	// Grid form hidden field names
	var $FormName = 'ft95_homedetaillist';
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

		// Table object (t95_homedetail)
		if (!isset($GLOBALS["t95_homedetail"]) || get_class($GLOBALS["t95_homedetail"]) == "ct95_homedetail") {
			$GLOBALS["t95_homedetail"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t95_homedetail"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "t95_homedetailadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "t95_homedetaildelete.php";
		$this->MultiUpdateUrl = "t95_homedetailupdate.php";

		// Table object (t96_employees)
		if (!isset($GLOBALS['t96_employees'])) $GLOBALS['t96_employees'] = new ct96_employees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

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
		$this->FilterOptions->TagClassName = "ewFilterOption ft95_homedetaillistsrch";

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
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->SetupListOptions();
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

				// Switch to grid edit mode
				if ($this->CurrentAction == "gridedit")
					$this->GridEditMode();

				// Switch to inline edit mode
				if ($this->CurrentAction == "edit")
					$this->InlineEditMode();

				// Switch to inline add mode
				if ($this->CurrentAction == "add" || $this->CurrentAction == "copy")
					$this->InlineAddMode();

				// Switch to grid add mode
				if ($this->CurrentAction == "gridadd")
					$this->GridAddMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$this->CurrentAction = $_POST["a_list"]; // Get action

					// Grid Update
					if (($this->CurrentAction == "gridupdate" || $this->CurrentAction == "gridoverwrite") && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridedit") {
						if ($this->ValidateGridForm()) {
							$bGridUpdate = $this->GridUpdate();
						} else {
							$bGridUpdate = FALSE;
							$this->setFailureMessage($gsFormError);
						}
						if (!$bGridUpdate) {
							$this->EventCancelled = TRUE;
							$this->CurrentAction = "gridedit"; // Stay in Grid Edit mode
						}
					}

					// Inline Update
					if (($this->CurrentAction == "update" || $this->CurrentAction == "overwrite") && @$_SESSION[EW_SESSION_INLINE_MODE] == "edit")
						$this->InlineUpdate();

					// Insert Inline
					if ($this->CurrentAction == "insert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "add")
						$this->InlineInsert();

					// Grid Insert
					if ($this->CurrentAction == "gridinsert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridadd") {
						if ($this->ValidateGridForm()) {
							$bGridInsert = $this->GridInsert();
						} else {
							$bGridInsert = FALSE;
							$this->setFailureMessage($gsFormError);
						}
						if (!$bGridInsert) {
							$this->EventCancelled = TRUE;
							$this->CurrentAction = "gridadd"; // Stay in Grid Add mode
						}
					}
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

			// Show grid delete link for grid add / grid edit
			if ($this->AllowAddDeleteRow) {
				if ($this->CurrentAction == "gridadd" || $this->CurrentAction == "gridedit") {
					$item = $this->ListOptions->GetItem("griddelete");
					if ($item) $item->Visible = TRUE;
				}
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

	// Exit inline mode
	function ClearInlineMode() {
		$this->setKey("home_id", ""); // Clear inline edit key
		$this->LastAction = $this->CurrentAction; // Save last action
		$this->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Grid Add mode
	function GridAddMode() {
		$_SESSION[EW_SESSION_INLINE_MODE] = "gridadd"; // Enabled grid add
	}

	// Switch to Grid Edit mode
	function GridEditMode() {
		$_SESSION[EW_SESSION_INLINE_MODE] = "gridedit"; // Enable grid edit
	}

	// Switch to Inline Edit mode
	function InlineEditMode() {
		global $Security, $Language;
		if (!$Security->CanEdit())
			$this->Page_Terminate("login.php"); // Go to login page
		$bInlineEdit = TRUE;
		if (isset($_GET["home_id"])) {
			$this->home_id->setQueryStringValue($_GET["home_id"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if ($bInlineEdit) {
			if ($this->LoadRow()) {
				$this->setKey("home_id", $this->home_id->CurrentValue); // Set up inline edit key
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
		if (strval($this->getKey("home_id")) <> strval($this->home_id->CurrentValue))
			return FALSE;
		return TRUE;
	}

	// Switch to Inline Add mode
	function InlineAddMode() {
		global $Security, $Language;
		if (!$Security->CanAdd())
			$this->Page_Terminate("login.php"); // Return to login page
		if ($this->CurrentAction == "copy") {
			if (@$_GET["home_id"] <> "") {
				$this->home_id->setQueryStringValue($_GET["home_id"]);
				$this->setKey("home_id", $this->home_id->CurrentValue); // Set up key
			} else {
				$this->setKey("home_id", ""); // Clear key
				$this->CurrentAction = "add";
			}
		}
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

	// Perform update to grid
	function GridUpdate() {
		global $Language, $objForm, $gsFormError;
		$bGridUpdate = TRUE;

		// Get old recordset
		$this->CurrentFilter = $this->BuildKeyFilter();
		if ($this->CurrentFilter == "")
			$this->CurrentFilter = "0=1";
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		if ($rs = $conn->Execute($sSql)) {
			$rsold = $rs->GetRows();
			$rs->Close();
		}

		// Call Grid Updating event
		if (!$this->Grid_Updating($rsold)) {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("GridEditCancelled")); // Set grid edit cancelled message
			return FALSE;
		}

		// Begin transaction
		$conn->BeginTrans();
		if ($this->AuditTrailOnEdit) $this->WriteAuditTrailDummy($Language->Phrase("BatchUpdateBegin")); // Batch update begin
		$sKey = "";

		// Update row index and get row key
		$objForm->Index = -1;
		$rowcnt = strval($objForm->GetValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Update all rows based on key
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {
			$objForm->Index = $rowindex;
			$rowkey = strval($objForm->GetValue($this->FormKeyName));
			$rowaction = strval($objForm->GetValue($this->FormActionName));

			// Load all values and keys
			if ($rowaction <> "insertdelete") { // Skip insert then deleted rows
				$this->LoadFormValues(); // Get form values
				if ($rowaction == "" || $rowaction == "edit" || $rowaction == "delete") {
					$bGridUpdate = $this->SetupKeyValues($rowkey); // Set up key values
				} else {
					$bGridUpdate = TRUE;
				}

				// Skip empty row
				if ($rowaction == "insert" && $this->EmptyRow()) {

					// No action required
				// Validate form and insert/update/delete record

				} elseif ($bGridUpdate) {
					if ($rowaction == "delete") {
						$this->CurrentFilter = $this->KeyFilter();
						$bGridUpdate = $this->DeleteRows(); // Delete this row
					} else if (!$this->ValidateForm()) {
						$bGridUpdate = FALSE; // Form error, reset action
						$this->setFailureMessage($gsFormError);
					} else {
						if ($rowaction == "insert") {
							$bGridUpdate = $this->AddRow(); // Insert this row
						} else {
							if ($rowkey <> "") {
								$this->SendEmail = FALSE; // Do not send email on update success
								$bGridUpdate = $this->EditRow(); // Update this row
							}
						} // End update
					}
				}
				if ($bGridUpdate) {
					if ($sKey <> "") $sKey .= ", ";
					$sKey .= $rowkey;
				} else {
					break;
				}
			}
		}
		if ($bGridUpdate) {
			$conn->CommitTrans(); // Commit transaction

			// Get new recordset
			if ($rs = $conn->Execute($sSql)) {
				$rsnew = $rs->GetRows();
				$rs->Close();
			}

			// Call Grid_Updated event
			$this->Grid_Updated($rsold, $rsnew);
			if ($this->AuditTrailOnEdit) $this->WriteAuditTrailDummy($Language->Phrase("BatchUpdateSuccess")); // Batch update success
			if ($this->getSuccessMessage() == "")
				$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Set up update success message
			$this->ClearInlineMode(); // Clear inline edit mode
		} else {
			$conn->RollbackTrans(); // Rollback transaction
			if ($this->AuditTrailOnEdit) $this->WriteAuditTrailDummy($Language->Phrase("BatchUpdateRollback")); // Batch update rollback
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("UpdateFailed")); // Set update failed message
		}
		return $bGridUpdate;
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
			$this->home_id->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($this->home_id->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Perform Grid Add
	function GridInsert() {
		global $Language, $objForm, $gsFormError;
		$rowindex = 1;
		$bGridInsert = FALSE;
		$conn = &$this->Connection();

		// Call Grid Inserting event
		if (!$this->Grid_Inserting()) {
			if ($this->getFailureMessage() == "") {
				$this->setFailureMessage($Language->Phrase("GridAddCancelled")); // Set grid add cancelled message
			}
			return FALSE;
		}

		// Begin transaction
		$conn->BeginTrans();

		// Init key filter
		$sWrkFilter = "";
		$addcnt = 0;
		if ($this->AuditTrailOnAdd) $this->WriteAuditTrailDummy($Language->Phrase("BatchInsertBegin")); // Batch insert begin
		$sKey = "";

		// Get row count
		$objForm->Index = -1;
		$rowcnt = strval($objForm->GetValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Insert all rows
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$objForm->Index = $rowindex;
			$rowaction = strval($objForm->GetValue($this->FormActionName));
			if ($rowaction <> "" && $rowaction <> "insert")
				continue; // Skip
			$this->LoadFormValues(); // Get form values
			if (!$this->EmptyRow()) {
				$addcnt++;
				$this->SendEmail = FALSE; // Do not send email on insert success

				// Validate form
				if (!$this->ValidateForm()) {
					$bGridInsert = FALSE; // Form error, reset action
					$this->setFailureMessage($gsFormError);
				} else {
					$bGridInsert = $this->AddRow($this->OldRecordset); // Insert this row
				}
				if ($bGridInsert) {
					if ($sKey <> "") $sKey .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
					$sKey .= $this->home_id->CurrentValue;

					// Add filter for this record
					$sFilter = $this->KeyFilter();
					if ($sWrkFilter <> "") $sWrkFilter .= " OR ";
					$sWrkFilter .= $sFilter;
				} else {
					break;
				}
			}
		}
		if ($addcnt == 0) { // No record inserted
			$this->setFailureMessage($Language->Phrase("NoAddRecord"));
			$bGridInsert = FALSE;
		}
		if ($bGridInsert) {
			$conn->CommitTrans(); // Commit transaction

			// Get new recordset
			$this->CurrentFilter = $sWrkFilter;
			$sSql = $this->SQL();
			if ($rs = $conn->Execute($sSql)) {
				$rsnew = $rs->GetRows();
				$rs->Close();
			}

			// Call Grid_Inserted event
			$this->Grid_Inserted($rsnew);
			if ($this->AuditTrailOnAdd) $this->WriteAuditTrailDummy($Language->Phrase("BatchInsertSuccess")); // Batch insert success
			if ($this->getSuccessMessage() == "")
				$this->setSuccessMessage($Language->Phrase("InsertSuccess")); // Set up insert success message
			$this->ClearInlineMode(); // Clear grid add mode
		} else {
			$conn->RollbackTrans(); // Rollback transaction
			if ($this->AuditTrailOnAdd) $this->WriteAuditTrailDummy($Language->Phrase("BatchInsertRollback")); // Batch insert rollback
			if ($this->getFailureMessage() == "") {
				$this->setFailureMessage($Language->Phrase("InsertFailed")); // Set insert failed message
			}
		}
		return $bGridInsert;
	}

	// Check if empty row
	function EmptyRow() {
		global $objForm;
		if ($objForm->HasValue("x_tgl") && $objForm->HasValue("o_tgl") && $this->tgl->CurrentValue <> $this->tgl->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_kat") && $objForm->HasValue("o_kat") && $this->kat->CurrentValue <> $this->kat->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_no_jdl") && $objForm->HasValue("o_no_jdl") && $this->no_jdl->CurrentValue <> $this->no_jdl->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_jdl") && $objForm->HasValue("o_jdl") && $this->jdl->CurrentValue <> $this->jdl->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_no_ket") && $objForm->HasValue("o_no_ket") && $this->no_ket->CurrentValue <> $this->no_ket->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_ket") && $objForm->HasValue("o_ket") && $this->ket->CurrentValue <> $this->ket->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_done") && $objForm->HasValue("o_done") && $this->done->CurrentValue <> $this->done->OldValue)
			return FALSE;
		return TRUE;
	}

	// Validate grid form
	function ValidateGridForm() {
		global $objForm;

		// Get row count
		$objForm->Index = -1;
		$rowcnt = strval($objForm->GetValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Validate all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$objForm->Index = $rowindex;
			$rowaction = strval($objForm->GetValue($this->FormActionName));
			if ($rowaction <> "delete" && $rowaction <> "insertdelete") {
				$this->LoadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->EmptyRow()) {

					// Ignore
				} else if (!$this->ValidateForm()) {
					return FALSE;
				}
			}
		}
		return TRUE;
	}

	// Get all form values of the grid
	function GetGridFormValues() {
		global $objForm;

		// Get row count
		$objForm->Index = -1;
		$rowcnt = strval($objForm->GetValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;
		$rows = array();

		// Loop through all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$objForm->Index = $rowindex;
			$rowaction = strval($objForm->GetValue($this->FormActionName));
			if ($rowaction <> "delete" && $rowaction <> "insertdelete") {
				$this->LoadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->EmptyRow()) {

					// Ignore
				} else {
					$rows[] = $this->GetFieldValues("FormValue"); // Return row as array
				}
			}
		}
		return $rows; // Return as array of array
	}

	// Restore form values for current row
	function RestoreCurrentRowFormValues($idx) {
		global $objForm;

		// Get row based on current index
		$objForm->Index = $idx;
		$this->LoadFormValues(); // Load form values
	}

	// Set up sort parameters
	function SetupSortOrder() {

		// Check for Ctrl pressed
		$bCtrl = (@$_GET["ctrl"] <> "");

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$this->CurrentOrder = @$_GET["order"];
			$this->CurrentOrderType = @$_GET["ordertype"];
			$this->UpdateSort($this->tgl, $bCtrl); // tgl
			$this->UpdateSort($this->kat, $bCtrl); // kat
			$this->UpdateSort($this->no_jdl, $bCtrl); // no_jdl
			$this->UpdateSort($this->jdl, $bCtrl); // jdl
			$this->UpdateSort($this->no_ket, $bCtrl); // no_ket
			$this->UpdateSort($this->ket, $bCtrl); // ket
			$this->UpdateSort($this->done, $bCtrl); // done
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
				$this->tgl->setSort("ASC");
				$this->kat->setSort("ASC");
				$this->no_jdl->setSort("ASC");
				$this->no_ket->setSort("ASC");
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
				$this->tgl->setSort("");
				$this->kat->setSort("");
				$this->no_jdl->setSort("");
				$this->jdl->setSort("");
				$this->no_ket->setSort("");
				$this->ket->setSort("");
				$this->done->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language;

		// "griddelete"
		if ($this->AllowAddDeleteRow) {
			$item = &$this->ListOptions->Add("griddelete");
			$item->CssClass = "text-nowrap";
			$item->OnLeft = TRUE;
			$item->Visible = FALSE; // Default hidden
		}

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
		$item->Visible = $Security->CanAdd();
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

		// "delete"
		if ($this->AllowAddDeleteRow) {
			if ($this->CurrentAction == "gridadd" || $this->CurrentAction == "gridedit") {
				$option = &$this->ListOptions;
				$option->UseButtonGroup = TRUE; // Use button group for grid delete button
				$option->UseImageAndText = TRUE; // Use image and text for grid delete button
				$oListOpt = &$option->Items["griddelete"];
				if (!$Security->CanDelete() && is_numeric($this->RowIndex) && ($this->RowAction == "" || $this->RowAction == "edit")) { // Do not allow delete existing record
					$oListOpt->Body = "&nbsp;";
				} else {
					$oListOpt->Body = "<a class=\"ewGridLink ewGridDelete\" title=\"" . ew_HtmlTitle($Language->Phrase("DeleteLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("DeleteLink")) . "\" onclick=\"return ew_DeleteGridRow(this, " . $this->RowIndex . ");\">" . $Language->Phrase("DeleteLink") . "</a>";
				}
			}
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
			$oListOpt->Body .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_key\" id=\"k" . $this->RowIndex . "_key\" value=\"" . ew_HtmlEncode($this->home_id->CurrentValue) . "\">";
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
			$oListOpt->Body = "<a class=\"ewRowLink ewEdit\" title=\"" . ew_HtmlTitle($Language->Phrase("EditLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("EditLink")) . "\" href=\"" . ew_HtmlEncode($this->EditUrl) . "\">" . $Language->Phrase("EditLink") . "</a>";
			$oListOpt->Body .= "<a class=\"ewRowLink ewInlineEdit\" title=\"" . ew_HtmlTitle($Language->Phrase("InlineEditLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("InlineEditLink")) . "\" href=\"" . ew_HtmlEncode(ew_UrlAddHash($this->InlineEditUrl, "r" . $this->RowCnt . "_" . $this->TableVar)) . "\">" . $Language->Phrase("InlineEditLink") . "</a>";
		} else {
			$oListOpt->Body = "";
		}

		// "copy"
		$oListOpt = &$this->ListOptions->Items["copy"];
		$copycaption = ew_HtmlTitle($Language->Phrase("CopyLink"));
		if ($Security->CanAdd()) {
			$oListOpt->Body = "<a class=\"ewRowLink ewCopy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"" . ew_HtmlEncode($this->CopyUrl) . "\">" . $Language->Phrase("CopyLink") . "</a>";
			$oListOpt->Body .= "<a class=\"ewRowLink ewInlineCopy\" title=\"" . ew_HtmlTitle($Language->Phrase("InlineCopyLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("InlineCopyLink")) . "\" href=\"" . ew_HtmlEncode($this->InlineCopyUrl) . "\">" . $Language->Phrase("InlineCopyLink") . "</a>";
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
		$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" class=\"ewMultiSelect\" value=\"" . ew_HtmlEncode($this->home_id->CurrentValue) . "\" onclick=\"ew_ClickMultiCheckbox(event);\">";
		if ($this->CurrentAction == "gridedit" && is_numeric($this->RowIndex)) {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $KeyName . "\" id=\"" . $KeyName . "\" value=\"" . $this->home_id->CurrentValue . "\">";
		}
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set up other options
	function SetupOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = $options["addedit"];

		// Add
		$item = &$option->Add("add");
		$addcaption = ew_HtmlTitle($Language->Phrase("AddLink"));
		$item->Body = "<a class=\"ewAddEdit ewAdd\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . ew_HtmlEncode($this->AddUrl) . "\">" . $Language->Phrase("AddLink") . "</a>";
		$item->Visible = ($this->AddUrl <> "" && $Security->CanAdd());

		// Inline Add
		$item = &$option->Add("inlineadd");
		$item->Body = "<a class=\"ewAddEdit ewInlineAdd\" title=\"" . ew_HtmlTitle($Language->Phrase("InlineAddLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("InlineAddLink")) . "\" href=\"" . ew_HtmlEncode($this->InlineAddUrl) . "\">" .$Language->Phrase("InlineAddLink") . "</a>";
		$item->Visible = ($this->InlineAddUrl <> "" && $Security->CanAdd());
		$item = &$option->Add("gridadd");
		$item->Body = "<a class=\"ewAddEdit ewGridAdd\" title=\"" . ew_HtmlTitle($Language->Phrase("GridAddLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("GridAddLink")) . "\" href=\"" . ew_HtmlEncode($this->GridAddUrl) . "\">" . $Language->Phrase("GridAddLink") . "</a>";
		$item->Visible = ($this->GridAddUrl <> "" && $Security->CanAdd());

		// Add grid edit
		$option = $options["addedit"];
		$item = &$option->Add("gridedit");
		$item->Body = "<a class=\"ewAddEdit ewGridEdit\" title=\"" . ew_HtmlTitle($Language->Phrase("GridEditLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("GridEditLink")) . "\" href=\"" . ew_HtmlEncode($this->GridEditUrl) . "\">" . $Language->Phrase("GridEditLink") . "</a>";
		$item->Visible = ($this->GridEditUrl <> "" && $Security->CanEdit());
		$option = $options["action"];

		// Add multi delete
		$item = &$option->Add("multidelete");
		$item->Body = "<a class=\"ewAction ewMultiDelete\" title=\"" . ew_HtmlTitle($Language->Phrase("DeleteSelectedLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("DeleteSelectedLink")) . "\" href=\"\" onclick=\"ew_SubmitAction(event,{f:document.ft95_homedetaillist,url:'" . $this->MultiDeleteUrl . "'});return false;\">" . $Language->Phrase("DeleteSelectedLink") . "</a>";
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
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"ft95_homedetaillistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = FALSE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"ft95_homedetaillistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
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
		if ($this->CurrentAction <> "gridadd" && $this->CurrentAction <> "gridedit") { // Not grid add/edit mode
			$option = &$options["action"];

			// Set up list action buttons
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == EW_ACTION_MULTIPLE) {
					$item = &$option->Add("custom_" . $listaction->Action);
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<span class=\"" . ew_HtmlEncode($listaction->Icon) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\"></span> " : $caption;
					$item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.ft95_homedetaillist}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
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
		} else { // Grid add/edit mode

			// Hide all options first
			foreach ($options as &$option)
				$option->HideAllOptions();
			if ($this->CurrentAction == "gridadd") {
				if ($this->AllowAddDeleteRow) {

					// Add add blank row
					$option = &$options["addedit"];
					$option->UseDropDownButton = FALSE;
					$option->UseImageAndText = TRUE;
					$item = &$option->Add("addblankrow");
					$item->Body = "<a class=\"ewAddEdit ewAddBlankRow\" title=\"" . ew_HtmlTitle($Language->Phrase("AddBlankRow")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("AddBlankRow")) . "\" href=\"javascript:void(0);\" onclick=\"ew_AddGridRow(this);\">" . $Language->Phrase("AddBlankRow") . "</a>";
					$item->Visible = $Security->CanAdd();
				}
				$option = &$options["action"];
				$option->UseDropDownButton = FALSE;
				$option->UseImageAndText = TRUE;

				// Add grid insert
				$item = &$option->Add("gridinsert");
				$item->Body = "<a class=\"ewAction ewGridInsert\" title=\"" . ew_HtmlTitle($Language->Phrase("GridInsertLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("GridInsertLink")) . "\" href=\"\" onclick=\"return ewForms(this).Submit('" . $this->PageName() . "');\">" . $Language->Phrase("GridInsertLink") . "</a>";

				// Add grid cancel
				$item = &$option->Add("gridcancel");
				$cancelurl = $this->AddMasterUrl($this->PageUrl() . "a=cancel");
				$item->Body = "<a class=\"ewAction ewGridCancel\" title=\"" . ew_HtmlTitle($Language->Phrase("GridCancelLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("GridCancelLink")) . "\" href=\"" . $cancelurl . "\">" . $Language->Phrase("GridCancelLink") . "</a>";
			}
			if ($this->CurrentAction == "gridedit") {
				if ($this->AllowAddDeleteRow) {

					// Add add blank row
					$option = &$options["addedit"];
					$option->UseDropDownButton = FALSE;
					$option->UseImageAndText = TRUE;
					$item = &$option->Add("addblankrow");
					$item->Body = "<a class=\"ewAddEdit ewAddBlankRow\" title=\"" . ew_HtmlTitle($Language->Phrase("AddBlankRow")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("AddBlankRow")) . "\" href=\"javascript:void(0);\" onclick=\"ew_AddGridRow(this);\">" . $Language->Phrase("AddBlankRow") . "</a>";
					$item->Visible = $Security->CanAdd();
				}
				$option = &$options["action"];
				$option->UseDropDownButton = FALSE;
				$option->UseImageAndText = TRUE;
					$item = &$option->Add("gridsave");
					$item->Body = "<a class=\"ewAction ewGridSave\" title=\"" . ew_HtmlTitle($Language->Phrase("GridSaveLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("GridSaveLink")) . "\" href=\"\" onclick=\"return ewForms(this).Submit('" . $this->PageName() . "');\">" . $Language->Phrase("GridSaveLink") . "</a>";
					$item = &$option->Add("gridcancel");
					$cancelurl = $this->AddMasterUrl($this->PageUrl() . "a=cancel");
					$item->Body = "<a class=\"ewAction ewGridCancel\" title=\"" . ew_HtmlTitle($Language->Phrase("GridCancelLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("GridCancelLink")) . "\" href=\"" . $cancelurl . "\">" . $Language->Phrase("GridCancelLink") . "</a>";
			}
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
		$this->done->OldValue = $this->done->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->tgl->FldIsDetailKey) {
			$this->tgl->setFormValue($objForm->GetValue("x_tgl"));
			$this->tgl->CurrentValue = ew_UnFormatDateTime($this->tgl->CurrentValue, 7);
		}
		$this->tgl->setOldValue($objForm->GetValue("o_tgl"));
		if (!$this->kat->FldIsDetailKey) {
			$this->kat->setFormValue($objForm->GetValue("x_kat"));
		}
		$this->kat->setOldValue($objForm->GetValue("o_kat"));
		if (!$this->no_jdl->FldIsDetailKey) {
			$this->no_jdl->setFormValue($objForm->GetValue("x_no_jdl"));
		}
		$this->no_jdl->setOldValue($objForm->GetValue("o_no_jdl"));
		if (!$this->jdl->FldIsDetailKey) {
			$this->jdl->setFormValue($objForm->GetValue("x_jdl"));
		}
		$this->jdl->setOldValue($objForm->GetValue("o_jdl"));
		if (!$this->no_ket->FldIsDetailKey) {
			$this->no_ket->setFormValue($objForm->GetValue("x_no_ket"));
		}
		$this->no_ket->setOldValue($objForm->GetValue("o_no_ket"));
		if (!$this->ket->FldIsDetailKey) {
			$this->ket->setFormValue($objForm->GetValue("x_ket"));
		}
		$this->ket->setOldValue($objForm->GetValue("o_ket"));
		if (!$this->done->FldIsDetailKey) {
			$this->done->setFormValue($objForm->GetValue("x_done"));
		}
		$this->done->setOldValue($objForm->GetValue("o_done"));
		if (!$this->home_id->FldIsDetailKey && $this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
			$this->home_id->setFormValue($objForm->GetValue("x_home_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		if ($this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
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
		$this->ViewUrl = $this->GetViewUrl();
		$this->EditUrl = $this->GetEditUrl();
		$this->InlineEditUrl = $this->GetInlineEditUrl();
		$this->CopyUrl = $this->GetCopyUrl();
		$this->InlineCopyUrl = $this->GetInlineCopyUrl();
		$this->DeleteUrl = $this->GetDeleteUrl();

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

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $Language, $Security;
		if (!$Security->CanDelete()) {
			$this->setFailureMessage($Language->Phrase("NoDeletePermission")); // No delete permission
			return FALSE;
		}
		$DeleteRows = TRUE;
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;
		}
		$rows = ($rs) ? $rs->GetRows() : array();
		if ($this->AuditTrailOnDelete) $this->WriteAuditTrailDummy($Language->Phrase("BatchDeleteBegin")); // Batch delete begin

		// Clone old rows
		$rsold = $rows;
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $this->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
				$sThisKey .= $row['home_id'];
				$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
				$DeleteRows = $this->Delete($row); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		}
		if (!$DeleteRows) {

			// Set up error message
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			if ($this->AuditTrailOnDelete) $this->WriteAuditTrailDummy($Language->Phrase("BatchDeleteSuccess")); // Batch delete success
		} else {
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$this->Row_Deleted($row);
			}
		}
		return $DeleteRows;
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
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$Breadcrumb->Add("list", $this->TableVar, $url, "", $this->TableVar, TRUE);
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
if (!isset($t95_homedetail_list)) $t95_homedetail_list = new ct95_homedetail_list();

// Page init
$t95_homedetail_list->Page_Init();

// Page main
$t95_homedetail_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t95_homedetail_list->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "list";
var CurrentForm = ft95_homedetaillist = new ew_Form("ft95_homedetaillist", "list");
ft95_homedetaillist.FormKeyCountName = '<?php echo $t95_homedetail_list->FormKeyCountName ?>';

// Validate form
ft95_homedetaillist.Validate = function() {
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
		var checkrow = (gridinsert) ? !this.EmptyRow(infix) : true;
		if (checkrow) {
			addcnt++;
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
		} // End Grid Add checking
	}
	if (gridinsert && addcnt == 0) { // No row added
		ew_Alert(ewLanguage.Phrase("NoAddRecord"));
		return false;
	}
	return true;
}

// Check empty row
ft95_homedetaillist.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "tgl", false)) return false;
	if (ew_ValueChanged(fobj, infix, "kat", false)) return false;
	if (ew_ValueChanged(fobj, infix, "no_jdl", false)) return false;
	if (ew_ValueChanged(fobj, infix, "jdl", false)) return false;
	if (ew_ValueChanged(fobj, infix, "no_ket", false)) return false;
	if (ew_ValueChanged(fobj, infix, "ket", false)) return false;
	if (ew_ValueChanged(fobj, infix, "done[]", false)) return false;
	return true;
}

// Form_CustomValidate event
ft95_homedetaillist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ft95_homedetaillist.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ft95_homedetaillist.Lists["x_kat"] = {"LinkField":"x_kode","Ajax":true,"AutoFill":false,"DisplayFields":["x_kode","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t94_home"};
ft95_homedetaillist.Lists["x_kat"].Data = "<?php echo $t95_homedetail_list->kat->LookupFilterQuery(FALSE, "list") ?>";
ft95_homedetaillist.Lists["x_done[]"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ft95_homedetaillist.Lists["x_done[]"].Options = <?php echo json_encode($t95_homedetail_list->done->Options()) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<div class="ewToolbar">
<?php if ($t95_homedetail_list->TotalRecs > 0 && $t95_homedetail_list->ExportOptions->Visible()) { ?>
<?php $t95_homedetail_list->ExportOptions->Render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php
if ($t95_homedetail->CurrentAction == "gridadd") {
	$t95_homedetail->CurrentFilter = "0=1";
	$t95_homedetail_list->StartRec = 1;
	$t95_homedetail_list->DisplayRecs = $t95_homedetail->GridAddRowCount;
	$t95_homedetail_list->TotalRecs = $t95_homedetail_list->DisplayRecs;
	$t95_homedetail_list->StopRec = $t95_homedetail_list->DisplayRecs;
} else {
	$bSelectLimit = $t95_homedetail_list->UseSelectLimit;
	if ($bSelectLimit) {
		if ($t95_homedetail_list->TotalRecs <= 0)
			$t95_homedetail_list->TotalRecs = $t95_homedetail->ListRecordCount();
	} else {
		if (!$t95_homedetail_list->Recordset && ($t95_homedetail_list->Recordset = $t95_homedetail_list->LoadRecordset()))
			$t95_homedetail_list->TotalRecs = $t95_homedetail_list->Recordset->RecordCount();
	}
	$t95_homedetail_list->StartRec = 1;
	if ($t95_homedetail_list->DisplayRecs <= 0 || ($t95_homedetail->Export <> "" && $t95_homedetail->ExportAll)) // Display all records
		$t95_homedetail_list->DisplayRecs = $t95_homedetail_list->TotalRecs;
	if (!($t95_homedetail->Export <> "" && $t95_homedetail->ExportAll))
		$t95_homedetail_list->SetupStartRec(); // Set up start record position
	if ($bSelectLimit)
		$t95_homedetail_list->Recordset = $t95_homedetail_list->LoadRecordset($t95_homedetail_list->StartRec-1, $t95_homedetail_list->DisplayRecs);

	// Set no record found message
	if ($t95_homedetail->CurrentAction == "" && $t95_homedetail_list->TotalRecs == 0) {
		if (!$Security->CanList())
			$t95_homedetail_list->setWarningMessage(ew_DeniedMsg());
		if ($t95_homedetail_list->SearchWhere == "0=101")
			$t95_homedetail_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$t95_homedetail_list->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$t95_homedetail_list->RenderOtherOptions();
?>
<?php $t95_homedetail_list->ShowPageHeader(); ?>
<?php
$t95_homedetail_list->ShowMessage();
?>
<?php if ($t95_homedetail_list->TotalRecs > 0 || $t95_homedetail->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($t95_homedetail_list->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> t95_homedetail">
<div class="box-header ewGridUpperPanel">
<?php if ($t95_homedetail->CurrentAction <> "gridadd" && $t95_homedetail->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="form-inline ewForm ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($t95_homedetail_list->Pager)) $t95_homedetail_list->Pager = new cPrevNextPager($t95_homedetail_list->StartRec, $t95_homedetail_list->DisplayRecs, $t95_homedetail_list->TotalRecs, $t95_homedetail_list->AutoHidePager) ?>
<?php if ($t95_homedetail_list->Pager->RecordCount > 0 && $t95_homedetail_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($t95_homedetail_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $t95_homedetail_list->PageUrl() ?>start=<?php echo $t95_homedetail_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($t95_homedetail_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $t95_homedetail_list->PageUrl() ?>start=<?php echo $t95_homedetail_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $t95_homedetail_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($t95_homedetail_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $t95_homedetail_list->PageUrl() ?>start=<?php echo $t95_homedetail_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($t95_homedetail_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $t95_homedetail_list->PageUrl() ?>start=<?php echo $t95_homedetail_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $t95_homedetail_list->Pager->PageCount ?></span>
</div>
<?php } ?>
<?php if ($t95_homedetail_list->Pager->RecordCount > 0) { ?>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $t95_homedetail_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $t95_homedetail_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $t95_homedetail_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($t95_homedetail_list->TotalRecs > 0 && (!$t95_homedetail_list->AutoHidePageSizeSelector || $t95_homedetail_list->Pager->Visible)) { ?>
<div class="ewPager">
<input type="hidden" name="t" value="t95_homedetail">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" class="form-control input-sm ewTooltip" title="<?php echo $Language->Phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($t95_homedetail_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($t95_homedetail_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($t95_homedetail_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($t95_homedetail_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($t95_homedetail_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="ALL"<?php if ($t95_homedetail->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t95_homedetail_list->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<form name="ft95_homedetaillist" id="ft95_homedetaillist" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t95_homedetail_list->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t95_homedetail_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t95_homedetail">
<div id="gmp_t95_homedetail" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<?php if ($t95_homedetail_list->TotalRecs > 0 || $t95_homedetail->CurrentAction == "add" || $t95_homedetail->CurrentAction == "copy" || $t95_homedetail->CurrentAction == "gridedit") { ?>
<table id="tbl_t95_homedetaillist" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$t95_homedetail_list->RowType = EW_ROWTYPE_HEADER;

// Render list options
$t95_homedetail_list->RenderListOptions();

// Render list options (header, left)
$t95_homedetail_list->ListOptions->Render("header", "left");
?>
<?php if ($t95_homedetail->tgl->Visible) { // tgl ?>
	<?php if ($t95_homedetail->SortUrl($t95_homedetail->tgl) == "") { ?>
		<th data-name="tgl" class="<?php echo $t95_homedetail->tgl->HeaderCellClass() ?>"><div id="elh_t95_homedetail_tgl" class="t95_homedetail_tgl"><div class="ewTableHeaderCaption"><?php echo $t95_homedetail->tgl->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl" class="<?php echo $t95_homedetail->tgl->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t95_homedetail->SortUrl($t95_homedetail->tgl) ?>',2);"><div id="elh_t95_homedetail_tgl" class="t95_homedetail_tgl">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t95_homedetail->tgl->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t95_homedetail->tgl->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t95_homedetail->tgl->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t95_homedetail->kat->Visible) { // kat ?>
	<?php if ($t95_homedetail->SortUrl($t95_homedetail->kat) == "") { ?>
		<th data-name="kat" class="<?php echo $t95_homedetail->kat->HeaderCellClass() ?>"><div id="elh_t95_homedetail_kat" class="t95_homedetail_kat"><div class="ewTableHeaderCaption"><?php echo $t95_homedetail->kat->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kat" class="<?php echo $t95_homedetail->kat->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t95_homedetail->SortUrl($t95_homedetail->kat) ?>',2);"><div id="elh_t95_homedetail_kat" class="t95_homedetail_kat">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t95_homedetail->kat->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t95_homedetail->kat->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t95_homedetail->kat->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t95_homedetail->no_jdl->Visible) { // no_jdl ?>
	<?php if ($t95_homedetail->SortUrl($t95_homedetail->no_jdl) == "") { ?>
		<th data-name="no_jdl" class="<?php echo $t95_homedetail->no_jdl->HeaderCellClass() ?>"><div id="elh_t95_homedetail_no_jdl" class="t95_homedetail_no_jdl"><div class="ewTableHeaderCaption"><?php echo $t95_homedetail->no_jdl->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="no_jdl" class="<?php echo $t95_homedetail->no_jdl->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t95_homedetail->SortUrl($t95_homedetail->no_jdl) ?>',2);"><div id="elh_t95_homedetail_no_jdl" class="t95_homedetail_no_jdl">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t95_homedetail->no_jdl->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t95_homedetail->no_jdl->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t95_homedetail->no_jdl->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t95_homedetail->jdl->Visible) { // jdl ?>
	<?php if ($t95_homedetail->SortUrl($t95_homedetail->jdl) == "") { ?>
		<th data-name="jdl" class="<?php echo $t95_homedetail->jdl->HeaderCellClass() ?>"><div id="elh_t95_homedetail_jdl" class="t95_homedetail_jdl"><div class="ewTableHeaderCaption"><?php echo $t95_homedetail->jdl->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jdl" class="<?php echo $t95_homedetail->jdl->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t95_homedetail->SortUrl($t95_homedetail->jdl) ?>',2);"><div id="elh_t95_homedetail_jdl" class="t95_homedetail_jdl">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t95_homedetail->jdl->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t95_homedetail->jdl->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t95_homedetail->jdl->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t95_homedetail->no_ket->Visible) { // no_ket ?>
	<?php if ($t95_homedetail->SortUrl($t95_homedetail->no_ket) == "") { ?>
		<th data-name="no_ket" class="<?php echo $t95_homedetail->no_ket->HeaderCellClass() ?>"><div id="elh_t95_homedetail_no_ket" class="t95_homedetail_no_ket"><div class="ewTableHeaderCaption"><?php echo $t95_homedetail->no_ket->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="no_ket" class="<?php echo $t95_homedetail->no_ket->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t95_homedetail->SortUrl($t95_homedetail->no_ket) ?>',2);"><div id="elh_t95_homedetail_no_ket" class="t95_homedetail_no_ket">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t95_homedetail->no_ket->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t95_homedetail->no_ket->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t95_homedetail->no_ket->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t95_homedetail->ket->Visible) { // ket ?>
	<?php if ($t95_homedetail->SortUrl($t95_homedetail->ket) == "") { ?>
		<th data-name="ket" class="<?php echo $t95_homedetail->ket->HeaderCellClass() ?>"><div id="elh_t95_homedetail_ket" class="t95_homedetail_ket"><div class="ewTableHeaderCaption"><?php echo $t95_homedetail->ket->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ket" class="<?php echo $t95_homedetail->ket->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t95_homedetail->SortUrl($t95_homedetail->ket) ?>',2);"><div id="elh_t95_homedetail_ket" class="t95_homedetail_ket">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t95_homedetail->ket->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t95_homedetail->ket->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t95_homedetail->ket->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t95_homedetail->done->Visible) { // done ?>
	<?php if ($t95_homedetail->SortUrl($t95_homedetail->done) == "") { ?>
		<th data-name="done" class="<?php echo $t95_homedetail->done->HeaderCellClass() ?>"><div id="elh_t95_homedetail_done" class="t95_homedetail_done"><div class="ewTableHeaderCaption"><?php echo $t95_homedetail->done->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="done" class="<?php echo $t95_homedetail->done->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t95_homedetail->SortUrl($t95_homedetail->done) ?>',2);"><div id="elh_t95_homedetail_done" class="t95_homedetail_done">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t95_homedetail->done->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t95_homedetail->done->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t95_homedetail->done->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t95_homedetail_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($t95_homedetail->CurrentAction == "add" || $t95_homedetail->CurrentAction == "copy") {
		$t95_homedetail_list->RowIndex = 0;
		$t95_homedetail_list->KeyCount = $t95_homedetail_list->RowIndex;
		if ($t95_homedetail->CurrentAction == "copy" && !$t95_homedetail_list->LoadRow())
			$t95_homedetail->CurrentAction = "add";
		if ($t95_homedetail->CurrentAction == "add")
			$t95_homedetail_list->LoadRowValues();
		if ($t95_homedetail->EventCancelled) // Insert failed
			$t95_homedetail_list->RestoreFormValues(); // Restore form values

		// Set row properties
		$t95_homedetail->ResetAttrs();
		$t95_homedetail->RowAttrs = array_merge($t95_homedetail->RowAttrs, array('data-rowindex'=>0, 'id'=>'r0_t95_homedetail', 'data-rowtype'=>EW_ROWTYPE_ADD));
		$t95_homedetail->RowType = EW_ROWTYPE_ADD;

		// Render row
		$t95_homedetail_list->RenderRow();

		// Render list options
		$t95_homedetail_list->RenderListOptions();
		$t95_homedetail_list->StartRowCnt = 0;
?>
	<tr<?php echo $t95_homedetail->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t95_homedetail_list->ListOptions->Render("body", "left", $t95_homedetail_list->RowCnt);
?>
	<?php if ($t95_homedetail->tgl->Visible) { // tgl ?>
		<td data-name="tgl">
<span id="el<?php echo $t95_homedetail_list->RowCnt ?>_t95_homedetail_tgl" class="form-group t95_homedetail_tgl">
<input type="text" data-table="t95_homedetail" data-field="x_tgl" data-format="7" name="x<?php echo $t95_homedetail_list->RowIndex ?>_tgl" id="x<?php echo $t95_homedetail_list->RowIndex ?>_tgl" size="7" placeholder="<?php echo ew_HtmlEncode($t95_homedetail->tgl->getPlaceHolder()) ?>" value="<?php echo $t95_homedetail->tgl->EditValue ?>"<?php echo $t95_homedetail->tgl->EditAttributes() ?>>
<?php if (!$t95_homedetail->tgl->ReadOnly && !$t95_homedetail->tgl->Disabled && !isset($t95_homedetail->tgl->EditAttrs["readonly"]) && !isset($t95_homedetail->tgl->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("ft95_homedetaillist", "x<?php echo $t95_homedetail_list->RowIndex ?>_tgl", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="t95_homedetail" data-field="x_tgl" name="o<?php echo $t95_homedetail_list->RowIndex ?>_tgl" id="o<?php echo $t95_homedetail_list->RowIndex ?>_tgl" value="<?php echo ew_HtmlEncode($t95_homedetail->tgl->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t95_homedetail->kat->Visible) { // kat ?>
		<td data-name="kat">
<span id="el<?php echo $t95_homedetail_list->RowCnt ?>_t95_homedetail_kat" class="form-group t95_homedetail_kat">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $t95_homedetail_list->RowIndex ?>_kat"><?php echo (strval($t95_homedetail->kat->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t95_homedetail->kat->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t95_homedetail->kat->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t95_homedetail_list->RowIndex ?>_kat',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($t95_homedetail->kat->ReadOnly || $t95_homedetail->kat->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t95_homedetail" data-field="x_kat" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t95_homedetail->kat->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t95_homedetail_list->RowIndex ?>_kat" id="x<?php echo $t95_homedetail_list->RowIndex ?>_kat" value="<?php echo $t95_homedetail->kat->CurrentValue ?>"<?php echo $t95_homedetail->kat->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t95_homedetail" data-field="x_kat" name="o<?php echo $t95_homedetail_list->RowIndex ?>_kat" id="o<?php echo $t95_homedetail_list->RowIndex ?>_kat" value="<?php echo ew_HtmlEncode($t95_homedetail->kat->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t95_homedetail->no_jdl->Visible) { // no_jdl ?>
		<td data-name="no_jdl">
<span id="el<?php echo $t95_homedetail_list->RowCnt ?>_t95_homedetail_no_jdl" class="form-group t95_homedetail_no_jdl">
<input type="text" data-table="t95_homedetail" data-field="x_no_jdl" name="x<?php echo $t95_homedetail_list->RowIndex ?>_no_jdl" id="x<?php echo $t95_homedetail_list->RowIndex ?>_no_jdl" size="1" placeholder="<?php echo ew_HtmlEncode($t95_homedetail->no_jdl->getPlaceHolder()) ?>" value="<?php echo $t95_homedetail->no_jdl->EditValue ?>"<?php echo $t95_homedetail->no_jdl->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t95_homedetail" data-field="x_no_jdl" name="o<?php echo $t95_homedetail_list->RowIndex ?>_no_jdl" id="o<?php echo $t95_homedetail_list->RowIndex ?>_no_jdl" value="<?php echo ew_HtmlEncode($t95_homedetail->no_jdl->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t95_homedetail->jdl->Visible) { // jdl ?>
		<td data-name="jdl">
<span id="el<?php echo $t95_homedetail_list->RowCnt ?>_t95_homedetail_jdl" class="form-group t95_homedetail_jdl">
<input type="text" data-table="t95_homedetail" data-field="x_jdl" name="x<?php echo $t95_homedetail_list->RowIndex ?>_jdl" id="x<?php echo $t95_homedetail_list->RowIndex ?>_jdl" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t95_homedetail->jdl->getPlaceHolder()) ?>" value="<?php echo $t95_homedetail->jdl->EditValue ?>"<?php echo $t95_homedetail->jdl->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t95_homedetail" data-field="x_jdl" name="o<?php echo $t95_homedetail_list->RowIndex ?>_jdl" id="o<?php echo $t95_homedetail_list->RowIndex ?>_jdl" value="<?php echo ew_HtmlEncode($t95_homedetail->jdl->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t95_homedetail->no_ket->Visible) { // no_ket ?>
		<td data-name="no_ket">
<span id="el<?php echo $t95_homedetail_list->RowCnt ?>_t95_homedetail_no_ket" class="form-group t95_homedetail_no_ket">
<input type="text" data-table="t95_homedetail" data-field="x_no_ket" name="x<?php echo $t95_homedetail_list->RowIndex ?>_no_ket" id="x<?php echo $t95_homedetail_list->RowIndex ?>_no_ket" size="1" placeholder="<?php echo ew_HtmlEncode($t95_homedetail->no_ket->getPlaceHolder()) ?>" value="<?php echo $t95_homedetail->no_ket->EditValue ?>"<?php echo $t95_homedetail->no_ket->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t95_homedetail" data-field="x_no_ket" name="o<?php echo $t95_homedetail_list->RowIndex ?>_no_ket" id="o<?php echo $t95_homedetail_list->RowIndex ?>_no_ket" value="<?php echo ew_HtmlEncode($t95_homedetail->no_ket->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t95_homedetail->ket->Visible) { // ket ?>
		<td data-name="ket">
<span id="el<?php echo $t95_homedetail_list->RowCnt ?>_t95_homedetail_ket" class="form-group t95_homedetail_ket">
<textarea data-table="t95_homedetail" data-field="x_ket" name="x<?php echo $t95_homedetail_list->RowIndex ?>_ket" id="x<?php echo $t95_homedetail_list->RowIndex ?>_ket" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($t95_homedetail->ket->getPlaceHolder()) ?>"<?php echo $t95_homedetail->ket->EditAttributes() ?>><?php echo $t95_homedetail->ket->EditValue ?></textarea>
</span>
<input type="hidden" data-table="t95_homedetail" data-field="x_ket" name="o<?php echo $t95_homedetail_list->RowIndex ?>_ket" id="o<?php echo $t95_homedetail_list->RowIndex ?>_ket" value="<?php echo ew_HtmlEncode($t95_homedetail->ket->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t95_homedetail->done->Visible) { // done ?>
		<td data-name="done">
<span id="el<?php echo $t95_homedetail_list->RowCnt ?>_t95_homedetail_done" class="form-group t95_homedetail_done">
<div id="tp_x<?php echo $t95_homedetail_list->RowIndex ?>_done" class="ewTemplate"><input type="checkbox" data-table="t95_homedetail" data-field="x_done" data-value-separator="<?php echo $t95_homedetail->done->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t95_homedetail_list->RowIndex ?>_done[]" id="x<?php echo $t95_homedetail_list->RowIndex ?>_done[]" value="{value}"<?php echo $t95_homedetail->done->EditAttributes() ?>></div>
<div id="dsl_x<?php echo $t95_homedetail_list->RowIndex ?>_done" data-repeatcolumn="5" class="ewItemList" style="display: none;"><div>
<?php echo $t95_homedetail->done->CheckBoxListHtml(FALSE, "x{$t95_homedetail_list->RowIndex}_done[]") ?>
</div></div>
</span>
<input type="hidden" data-table="t95_homedetail" data-field="x_done" name="o<?php echo $t95_homedetail_list->RowIndex ?>_done[]" id="o<?php echo $t95_homedetail_list->RowIndex ?>_done[]" value="<?php echo ew_HtmlEncode($t95_homedetail->done->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t95_homedetail_list->ListOptions->Render("body", "right", $t95_homedetail_list->RowCnt);
?>
<script type="text/javascript">
ft95_homedetaillist.UpdateOpts(<?php echo $t95_homedetail_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
<?php
if ($t95_homedetail->ExportAll && $t95_homedetail->Export <> "") {
	$t95_homedetail_list->StopRec = $t95_homedetail_list->TotalRecs;
} else {

	// Set the last record to display
	if ($t95_homedetail_list->TotalRecs > $t95_homedetail_list->StartRec + $t95_homedetail_list->DisplayRecs - 1)
		$t95_homedetail_list->StopRec = $t95_homedetail_list->StartRec + $t95_homedetail_list->DisplayRecs - 1;
	else
		$t95_homedetail_list->StopRec = $t95_homedetail_list->TotalRecs;
}

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($t95_homedetail_list->FormKeyCountName) && ($t95_homedetail->CurrentAction == "gridadd" || $t95_homedetail->CurrentAction == "gridedit" || $t95_homedetail->CurrentAction == "F")) {
		$t95_homedetail_list->KeyCount = $objForm->GetValue($t95_homedetail_list->FormKeyCountName);
		$t95_homedetail_list->StopRec = $t95_homedetail_list->StartRec + $t95_homedetail_list->KeyCount - 1;
	}
}
$t95_homedetail_list->RecCnt = $t95_homedetail_list->StartRec - 1;
if ($t95_homedetail_list->Recordset && !$t95_homedetail_list->Recordset->EOF) {
	$t95_homedetail_list->Recordset->MoveFirst();
	$bSelectLimit = $t95_homedetail_list->UseSelectLimit;
	if (!$bSelectLimit && $t95_homedetail_list->StartRec > 1)
		$t95_homedetail_list->Recordset->Move($t95_homedetail_list->StartRec - 1);
} elseif (!$t95_homedetail->AllowAddDeleteRow && $t95_homedetail_list->StopRec == 0) {
	$t95_homedetail_list->StopRec = $t95_homedetail->GridAddRowCount;
}

// Initialize aggregate
$t95_homedetail->RowType = EW_ROWTYPE_AGGREGATEINIT;
$t95_homedetail->ResetAttrs();
$t95_homedetail_list->RenderRow();
$t95_homedetail_list->EditRowCnt = 0;
if ($t95_homedetail->CurrentAction == "edit")
	$t95_homedetail_list->RowIndex = 1;
if ($t95_homedetail->CurrentAction == "gridadd")
	$t95_homedetail_list->RowIndex = 0;
if ($t95_homedetail->CurrentAction == "gridedit")
	$t95_homedetail_list->RowIndex = 0;
while ($t95_homedetail_list->RecCnt < $t95_homedetail_list->StopRec) {
	$t95_homedetail_list->RecCnt++;
	if (intval($t95_homedetail_list->RecCnt) >= intval($t95_homedetail_list->StartRec)) {
		$t95_homedetail_list->RowCnt++;
		if ($t95_homedetail->CurrentAction == "gridadd" || $t95_homedetail->CurrentAction == "gridedit" || $t95_homedetail->CurrentAction == "F") {
			$t95_homedetail_list->RowIndex++;
			$objForm->Index = $t95_homedetail_list->RowIndex;
			if ($objForm->HasValue($t95_homedetail_list->FormActionName))
				$t95_homedetail_list->RowAction = strval($objForm->GetValue($t95_homedetail_list->FormActionName));
			elseif ($t95_homedetail->CurrentAction == "gridadd")
				$t95_homedetail_list->RowAction = "insert";
			else
				$t95_homedetail_list->RowAction = "";
		}

		// Set up key count
		$t95_homedetail_list->KeyCount = $t95_homedetail_list->RowIndex;

		// Init row class and style
		$t95_homedetail->ResetAttrs();
		$t95_homedetail->CssClass = "";
		if ($t95_homedetail->CurrentAction == "gridadd") {
			$t95_homedetail_list->LoadRowValues(); // Load default values
		} else {
			$t95_homedetail_list->LoadRowValues($t95_homedetail_list->Recordset); // Load row values
		}
		$t95_homedetail->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($t95_homedetail->CurrentAction == "gridadd") // Grid add
			$t95_homedetail->RowType = EW_ROWTYPE_ADD; // Render add
		if ($t95_homedetail->CurrentAction == "gridadd" && $t95_homedetail->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$t95_homedetail_list->RestoreCurrentRowFormValues($t95_homedetail_list->RowIndex); // Restore form values
		if ($t95_homedetail->CurrentAction == "edit") {
			if ($t95_homedetail_list->CheckInlineEditKey() && $t95_homedetail_list->EditRowCnt == 0) { // Inline edit
				$t95_homedetail->RowType = EW_ROWTYPE_EDIT; // Render edit
			}
		}
		if ($t95_homedetail->CurrentAction == "gridedit") { // Grid edit
			if ($t95_homedetail->EventCancelled) {
				$t95_homedetail_list->RestoreCurrentRowFormValues($t95_homedetail_list->RowIndex); // Restore form values
			}
			if ($t95_homedetail_list->RowAction == "insert")
				$t95_homedetail->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$t95_homedetail->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($t95_homedetail->CurrentAction == "edit" && $t95_homedetail->RowType == EW_ROWTYPE_EDIT && $t95_homedetail->EventCancelled) { // Update failed
			$objForm->Index = 1;
			$t95_homedetail_list->RestoreFormValues(); // Restore form values
		}
		if ($t95_homedetail->CurrentAction == "gridedit" && ($t95_homedetail->RowType == EW_ROWTYPE_EDIT || $t95_homedetail->RowType == EW_ROWTYPE_ADD) && $t95_homedetail->EventCancelled) // Update failed
			$t95_homedetail_list->RestoreCurrentRowFormValues($t95_homedetail_list->RowIndex); // Restore form values
		if ($t95_homedetail->RowType == EW_ROWTYPE_EDIT) // Edit row
			$t95_homedetail_list->EditRowCnt++;

		// Set up row id / data-rowindex
		$t95_homedetail->RowAttrs = array_merge($t95_homedetail->RowAttrs, array('data-rowindex'=>$t95_homedetail_list->RowCnt, 'id'=>'r' . $t95_homedetail_list->RowCnt . '_t95_homedetail', 'data-rowtype'=>$t95_homedetail->RowType));

		// Render row
		$t95_homedetail_list->RenderRow();

		// Render list options
		$t95_homedetail_list->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t95_homedetail_list->RowAction <> "delete" && $t95_homedetail_list->RowAction <> "insertdelete" && !($t95_homedetail_list->RowAction == "insert" && $t95_homedetail->CurrentAction == "F" && $t95_homedetail_list->EmptyRow())) {
?>
	<tr<?php echo $t95_homedetail->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t95_homedetail_list->ListOptions->Render("body", "left", $t95_homedetail_list->RowCnt);
?>
	<?php if ($t95_homedetail->tgl->Visible) { // tgl ?>
		<td data-name="tgl"<?php echo $t95_homedetail->tgl->CellAttributes() ?>>
<?php if ($t95_homedetail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t95_homedetail_list->RowCnt ?>_t95_homedetail_tgl" class="form-group t95_homedetail_tgl">
<input type="text" data-table="t95_homedetail" data-field="x_tgl" data-format="7" name="x<?php echo $t95_homedetail_list->RowIndex ?>_tgl" id="x<?php echo $t95_homedetail_list->RowIndex ?>_tgl" size="7" placeholder="<?php echo ew_HtmlEncode($t95_homedetail->tgl->getPlaceHolder()) ?>" value="<?php echo $t95_homedetail->tgl->EditValue ?>"<?php echo $t95_homedetail->tgl->EditAttributes() ?>>
<?php if (!$t95_homedetail->tgl->ReadOnly && !$t95_homedetail->tgl->Disabled && !isset($t95_homedetail->tgl->EditAttrs["readonly"]) && !isset($t95_homedetail->tgl->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("ft95_homedetaillist", "x<?php echo $t95_homedetail_list->RowIndex ?>_tgl", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="t95_homedetail" data-field="x_tgl" name="o<?php echo $t95_homedetail_list->RowIndex ?>_tgl" id="o<?php echo $t95_homedetail_list->RowIndex ?>_tgl" value="<?php echo ew_HtmlEncode($t95_homedetail->tgl->OldValue) ?>">
<?php } ?>
<?php if ($t95_homedetail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t95_homedetail_list->RowCnt ?>_t95_homedetail_tgl" class="form-group t95_homedetail_tgl">
<input type="text" data-table="t95_homedetail" data-field="x_tgl" data-format="7" name="x<?php echo $t95_homedetail_list->RowIndex ?>_tgl" id="x<?php echo $t95_homedetail_list->RowIndex ?>_tgl" size="7" placeholder="<?php echo ew_HtmlEncode($t95_homedetail->tgl->getPlaceHolder()) ?>" value="<?php echo $t95_homedetail->tgl->EditValue ?>"<?php echo $t95_homedetail->tgl->EditAttributes() ?>>
<?php if (!$t95_homedetail->tgl->ReadOnly && !$t95_homedetail->tgl->Disabled && !isset($t95_homedetail->tgl->EditAttrs["readonly"]) && !isset($t95_homedetail->tgl->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("ft95_homedetaillist", "x<?php echo $t95_homedetail_list->RowIndex ?>_tgl", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($t95_homedetail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t95_homedetail_list->RowCnt ?>_t95_homedetail_tgl" class="t95_homedetail_tgl">
<span<?php echo $t95_homedetail->tgl->ViewAttributes() ?>>
<?php echo $t95_homedetail->tgl->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php if ($t95_homedetail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t95_homedetail" data-field="x_home_id" name="x<?php echo $t95_homedetail_list->RowIndex ?>_home_id" id="x<?php echo $t95_homedetail_list->RowIndex ?>_home_id" value="<?php echo ew_HtmlEncode($t95_homedetail->home_id->CurrentValue) ?>">
<input type="hidden" data-table="t95_homedetail" data-field="x_home_id" name="o<?php echo $t95_homedetail_list->RowIndex ?>_home_id" id="o<?php echo $t95_homedetail_list->RowIndex ?>_home_id" value="<?php echo ew_HtmlEncode($t95_homedetail->home_id->OldValue) ?>">
<?php } ?>
<?php if ($t95_homedetail->RowType == EW_ROWTYPE_EDIT || $t95_homedetail->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t95_homedetail" data-field="x_home_id" name="x<?php echo $t95_homedetail_list->RowIndex ?>_home_id" id="x<?php echo $t95_homedetail_list->RowIndex ?>_home_id" value="<?php echo ew_HtmlEncode($t95_homedetail->home_id->CurrentValue) ?>">
<?php } ?>
	<?php if ($t95_homedetail->kat->Visible) { // kat ?>
		<td data-name="kat"<?php echo $t95_homedetail->kat->CellAttributes() ?>>
<?php if ($t95_homedetail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t95_homedetail_list->RowCnt ?>_t95_homedetail_kat" class="form-group t95_homedetail_kat">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $t95_homedetail_list->RowIndex ?>_kat"><?php echo (strval($t95_homedetail->kat->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t95_homedetail->kat->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t95_homedetail->kat->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t95_homedetail_list->RowIndex ?>_kat',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($t95_homedetail->kat->ReadOnly || $t95_homedetail->kat->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t95_homedetail" data-field="x_kat" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t95_homedetail->kat->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t95_homedetail_list->RowIndex ?>_kat" id="x<?php echo $t95_homedetail_list->RowIndex ?>_kat" value="<?php echo $t95_homedetail->kat->CurrentValue ?>"<?php echo $t95_homedetail->kat->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t95_homedetail" data-field="x_kat" name="o<?php echo $t95_homedetail_list->RowIndex ?>_kat" id="o<?php echo $t95_homedetail_list->RowIndex ?>_kat" value="<?php echo ew_HtmlEncode($t95_homedetail->kat->OldValue) ?>">
<?php } ?>
<?php if ($t95_homedetail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t95_homedetail_list->RowCnt ?>_t95_homedetail_kat" class="form-group t95_homedetail_kat">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $t95_homedetail_list->RowIndex ?>_kat"><?php echo (strval($t95_homedetail->kat->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t95_homedetail->kat->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t95_homedetail->kat->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t95_homedetail_list->RowIndex ?>_kat',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($t95_homedetail->kat->ReadOnly || $t95_homedetail->kat->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t95_homedetail" data-field="x_kat" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t95_homedetail->kat->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t95_homedetail_list->RowIndex ?>_kat" id="x<?php echo $t95_homedetail_list->RowIndex ?>_kat" value="<?php echo $t95_homedetail->kat->CurrentValue ?>"<?php echo $t95_homedetail->kat->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t95_homedetail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t95_homedetail_list->RowCnt ?>_t95_homedetail_kat" class="t95_homedetail_kat">
<span<?php echo $t95_homedetail->kat->ViewAttributes() ?>>
<?php echo $t95_homedetail->kat->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t95_homedetail->no_jdl->Visible) { // no_jdl ?>
		<td data-name="no_jdl"<?php echo $t95_homedetail->no_jdl->CellAttributes() ?>>
<?php if ($t95_homedetail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t95_homedetail_list->RowCnt ?>_t95_homedetail_no_jdl" class="form-group t95_homedetail_no_jdl">
<input type="text" data-table="t95_homedetail" data-field="x_no_jdl" name="x<?php echo $t95_homedetail_list->RowIndex ?>_no_jdl" id="x<?php echo $t95_homedetail_list->RowIndex ?>_no_jdl" size="1" placeholder="<?php echo ew_HtmlEncode($t95_homedetail->no_jdl->getPlaceHolder()) ?>" value="<?php echo $t95_homedetail->no_jdl->EditValue ?>"<?php echo $t95_homedetail->no_jdl->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t95_homedetail" data-field="x_no_jdl" name="o<?php echo $t95_homedetail_list->RowIndex ?>_no_jdl" id="o<?php echo $t95_homedetail_list->RowIndex ?>_no_jdl" value="<?php echo ew_HtmlEncode($t95_homedetail->no_jdl->OldValue) ?>">
<?php } ?>
<?php if ($t95_homedetail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t95_homedetail_list->RowCnt ?>_t95_homedetail_no_jdl" class="form-group t95_homedetail_no_jdl">
<input type="text" data-table="t95_homedetail" data-field="x_no_jdl" name="x<?php echo $t95_homedetail_list->RowIndex ?>_no_jdl" id="x<?php echo $t95_homedetail_list->RowIndex ?>_no_jdl" size="1" placeholder="<?php echo ew_HtmlEncode($t95_homedetail->no_jdl->getPlaceHolder()) ?>" value="<?php echo $t95_homedetail->no_jdl->EditValue ?>"<?php echo $t95_homedetail->no_jdl->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t95_homedetail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t95_homedetail_list->RowCnt ?>_t95_homedetail_no_jdl" class="t95_homedetail_no_jdl">
<span<?php echo $t95_homedetail->no_jdl->ViewAttributes() ?>>
<?php echo $t95_homedetail->no_jdl->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t95_homedetail->jdl->Visible) { // jdl ?>
		<td data-name="jdl"<?php echo $t95_homedetail->jdl->CellAttributes() ?>>
<?php if ($t95_homedetail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t95_homedetail_list->RowCnt ?>_t95_homedetail_jdl" class="form-group t95_homedetail_jdl">
<input type="text" data-table="t95_homedetail" data-field="x_jdl" name="x<?php echo $t95_homedetail_list->RowIndex ?>_jdl" id="x<?php echo $t95_homedetail_list->RowIndex ?>_jdl" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t95_homedetail->jdl->getPlaceHolder()) ?>" value="<?php echo $t95_homedetail->jdl->EditValue ?>"<?php echo $t95_homedetail->jdl->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t95_homedetail" data-field="x_jdl" name="o<?php echo $t95_homedetail_list->RowIndex ?>_jdl" id="o<?php echo $t95_homedetail_list->RowIndex ?>_jdl" value="<?php echo ew_HtmlEncode($t95_homedetail->jdl->OldValue) ?>">
<?php } ?>
<?php if ($t95_homedetail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t95_homedetail_list->RowCnt ?>_t95_homedetail_jdl" class="form-group t95_homedetail_jdl">
<input type="text" data-table="t95_homedetail" data-field="x_jdl" name="x<?php echo $t95_homedetail_list->RowIndex ?>_jdl" id="x<?php echo $t95_homedetail_list->RowIndex ?>_jdl" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t95_homedetail->jdl->getPlaceHolder()) ?>" value="<?php echo $t95_homedetail->jdl->EditValue ?>"<?php echo $t95_homedetail->jdl->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t95_homedetail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t95_homedetail_list->RowCnt ?>_t95_homedetail_jdl" class="t95_homedetail_jdl">
<span<?php echo $t95_homedetail->jdl->ViewAttributes() ?>>
<?php echo $t95_homedetail->jdl->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t95_homedetail->no_ket->Visible) { // no_ket ?>
		<td data-name="no_ket"<?php echo $t95_homedetail->no_ket->CellAttributes() ?>>
<?php if ($t95_homedetail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t95_homedetail_list->RowCnt ?>_t95_homedetail_no_ket" class="form-group t95_homedetail_no_ket">
<input type="text" data-table="t95_homedetail" data-field="x_no_ket" name="x<?php echo $t95_homedetail_list->RowIndex ?>_no_ket" id="x<?php echo $t95_homedetail_list->RowIndex ?>_no_ket" size="1" placeholder="<?php echo ew_HtmlEncode($t95_homedetail->no_ket->getPlaceHolder()) ?>" value="<?php echo $t95_homedetail->no_ket->EditValue ?>"<?php echo $t95_homedetail->no_ket->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t95_homedetail" data-field="x_no_ket" name="o<?php echo $t95_homedetail_list->RowIndex ?>_no_ket" id="o<?php echo $t95_homedetail_list->RowIndex ?>_no_ket" value="<?php echo ew_HtmlEncode($t95_homedetail->no_ket->OldValue) ?>">
<?php } ?>
<?php if ($t95_homedetail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t95_homedetail_list->RowCnt ?>_t95_homedetail_no_ket" class="form-group t95_homedetail_no_ket">
<input type="text" data-table="t95_homedetail" data-field="x_no_ket" name="x<?php echo $t95_homedetail_list->RowIndex ?>_no_ket" id="x<?php echo $t95_homedetail_list->RowIndex ?>_no_ket" size="1" placeholder="<?php echo ew_HtmlEncode($t95_homedetail->no_ket->getPlaceHolder()) ?>" value="<?php echo $t95_homedetail->no_ket->EditValue ?>"<?php echo $t95_homedetail->no_ket->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t95_homedetail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t95_homedetail_list->RowCnt ?>_t95_homedetail_no_ket" class="t95_homedetail_no_ket">
<span<?php echo $t95_homedetail->no_ket->ViewAttributes() ?>>
<?php echo $t95_homedetail->no_ket->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t95_homedetail->ket->Visible) { // ket ?>
		<td data-name="ket"<?php echo $t95_homedetail->ket->CellAttributes() ?>>
<?php if ($t95_homedetail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t95_homedetail_list->RowCnt ?>_t95_homedetail_ket" class="form-group t95_homedetail_ket">
<textarea data-table="t95_homedetail" data-field="x_ket" name="x<?php echo $t95_homedetail_list->RowIndex ?>_ket" id="x<?php echo $t95_homedetail_list->RowIndex ?>_ket" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($t95_homedetail->ket->getPlaceHolder()) ?>"<?php echo $t95_homedetail->ket->EditAttributes() ?>><?php echo $t95_homedetail->ket->EditValue ?></textarea>
</span>
<input type="hidden" data-table="t95_homedetail" data-field="x_ket" name="o<?php echo $t95_homedetail_list->RowIndex ?>_ket" id="o<?php echo $t95_homedetail_list->RowIndex ?>_ket" value="<?php echo ew_HtmlEncode($t95_homedetail->ket->OldValue) ?>">
<?php } ?>
<?php if ($t95_homedetail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t95_homedetail_list->RowCnt ?>_t95_homedetail_ket" class="form-group t95_homedetail_ket">
<textarea data-table="t95_homedetail" data-field="x_ket" name="x<?php echo $t95_homedetail_list->RowIndex ?>_ket" id="x<?php echo $t95_homedetail_list->RowIndex ?>_ket" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($t95_homedetail->ket->getPlaceHolder()) ?>"<?php echo $t95_homedetail->ket->EditAttributes() ?>><?php echo $t95_homedetail->ket->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($t95_homedetail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t95_homedetail_list->RowCnt ?>_t95_homedetail_ket" class="t95_homedetail_ket">
<span<?php echo $t95_homedetail->ket->ViewAttributes() ?>>
<?php echo $t95_homedetail->ket->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t95_homedetail->done->Visible) { // done ?>
		<td data-name="done"<?php echo $t95_homedetail->done->CellAttributes() ?>>
<?php if ($t95_homedetail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t95_homedetail_list->RowCnt ?>_t95_homedetail_done" class="form-group t95_homedetail_done">
<div id="tp_x<?php echo $t95_homedetail_list->RowIndex ?>_done" class="ewTemplate"><input type="checkbox" data-table="t95_homedetail" data-field="x_done" data-value-separator="<?php echo $t95_homedetail->done->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t95_homedetail_list->RowIndex ?>_done[]" id="x<?php echo $t95_homedetail_list->RowIndex ?>_done[]" value="{value}"<?php echo $t95_homedetail->done->EditAttributes() ?>></div>
<div id="dsl_x<?php echo $t95_homedetail_list->RowIndex ?>_done" data-repeatcolumn="5" class="ewItemList" style="display: none;"><div>
<?php echo $t95_homedetail->done->CheckBoxListHtml(FALSE, "x{$t95_homedetail_list->RowIndex}_done[]") ?>
</div></div>
</span>
<input type="hidden" data-table="t95_homedetail" data-field="x_done" name="o<?php echo $t95_homedetail_list->RowIndex ?>_done[]" id="o<?php echo $t95_homedetail_list->RowIndex ?>_done[]" value="<?php echo ew_HtmlEncode($t95_homedetail->done->OldValue) ?>">
<?php } ?>
<?php if ($t95_homedetail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t95_homedetail_list->RowCnt ?>_t95_homedetail_done" class="form-group t95_homedetail_done">
<div id="tp_x<?php echo $t95_homedetail_list->RowIndex ?>_done" class="ewTemplate"><input type="checkbox" data-table="t95_homedetail" data-field="x_done" data-value-separator="<?php echo $t95_homedetail->done->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t95_homedetail_list->RowIndex ?>_done[]" id="x<?php echo $t95_homedetail_list->RowIndex ?>_done[]" value="{value}"<?php echo $t95_homedetail->done->EditAttributes() ?>></div>
<div id="dsl_x<?php echo $t95_homedetail_list->RowIndex ?>_done" data-repeatcolumn="5" class="ewItemList" style="display: none;"><div>
<?php echo $t95_homedetail->done->CheckBoxListHtml(FALSE, "x{$t95_homedetail_list->RowIndex}_done[]") ?>
</div></div>
</span>
<?php } ?>
<?php if ($t95_homedetail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t95_homedetail_list->RowCnt ?>_t95_homedetail_done" class="t95_homedetail_done">
<span<?php echo $t95_homedetail->done->ViewAttributes() ?>>
<?php echo $t95_homedetail->done->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t95_homedetail_list->ListOptions->Render("body", "right", $t95_homedetail_list->RowCnt);
?>
	</tr>
<?php if ($t95_homedetail->RowType == EW_ROWTYPE_ADD || $t95_homedetail->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
ft95_homedetaillist.UpdateOpts(<?php echo $t95_homedetail_list->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($t95_homedetail->CurrentAction <> "gridadd")
		if (!$t95_homedetail_list->Recordset->EOF) $t95_homedetail_list->Recordset->MoveNext();
}
?>
<?php
	if ($t95_homedetail->CurrentAction == "gridadd" || $t95_homedetail->CurrentAction == "gridedit") {
		$t95_homedetail_list->RowIndex = '$rowindex$';
		$t95_homedetail_list->LoadRowValues();

		// Set row properties
		$t95_homedetail->ResetAttrs();
		$t95_homedetail->RowAttrs = array_merge($t95_homedetail->RowAttrs, array('data-rowindex'=>$t95_homedetail_list->RowIndex, 'id'=>'r0_t95_homedetail', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($t95_homedetail->RowAttrs["class"], "ewTemplate");
		$t95_homedetail->RowType = EW_ROWTYPE_ADD;

		// Render row
		$t95_homedetail_list->RenderRow();

		// Render list options
		$t95_homedetail_list->RenderListOptions();
		$t95_homedetail_list->StartRowCnt = 0;
?>
	<tr<?php echo $t95_homedetail->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t95_homedetail_list->ListOptions->Render("body", "left", $t95_homedetail_list->RowIndex);
?>
	<?php if ($t95_homedetail->tgl->Visible) { // tgl ?>
		<td data-name="tgl">
<span id="el$rowindex$_t95_homedetail_tgl" class="form-group t95_homedetail_tgl">
<input type="text" data-table="t95_homedetail" data-field="x_tgl" data-format="7" name="x<?php echo $t95_homedetail_list->RowIndex ?>_tgl" id="x<?php echo $t95_homedetail_list->RowIndex ?>_tgl" size="7" placeholder="<?php echo ew_HtmlEncode($t95_homedetail->tgl->getPlaceHolder()) ?>" value="<?php echo $t95_homedetail->tgl->EditValue ?>"<?php echo $t95_homedetail->tgl->EditAttributes() ?>>
<?php if (!$t95_homedetail->tgl->ReadOnly && !$t95_homedetail->tgl->Disabled && !isset($t95_homedetail->tgl->EditAttrs["readonly"]) && !isset($t95_homedetail->tgl->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("ft95_homedetaillist", "x<?php echo $t95_homedetail_list->RowIndex ?>_tgl", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="t95_homedetail" data-field="x_tgl" name="o<?php echo $t95_homedetail_list->RowIndex ?>_tgl" id="o<?php echo $t95_homedetail_list->RowIndex ?>_tgl" value="<?php echo ew_HtmlEncode($t95_homedetail->tgl->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t95_homedetail->kat->Visible) { // kat ?>
		<td data-name="kat">
<span id="el$rowindex$_t95_homedetail_kat" class="form-group t95_homedetail_kat">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $t95_homedetail_list->RowIndex ?>_kat"><?php echo (strval($t95_homedetail->kat->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t95_homedetail->kat->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t95_homedetail->kat->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t95_homedetail_list->RowIndex ?>_kat',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($t95_homedetail->kat->ReadOnly || $t95_homedetail->kat->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t95_homedetail" data-field="x_kat" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t95_homedetail->kat->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t95_homedetail_list->RowIndex ?>_kat" id="x<?php echo $t95_homedetail_list->RowIndex ?>_kat" value="<?php echo $t95_homedetail->kat->CurrentValue ?>"<?php echo $t95_homedetail->kat->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t95_homedetail" data-field="x_kat" name="o<?php echo $t95_homedetail_list->RowIndex ?>_kat" id="o<?php echo $t95_homedetail_list->RowIndex ?>_kat" value="<?php echo ew_HtmlEncode($t95_homedetail->kat->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t95_homedetail->no_jdl->Visible) { // no_jdl ?>
		<td data-name="no_jdl">
<span id="el$rowindex$_t95_homedetail_no_jdl" class="form-group t95_homedetail_no_jdl">
<input type="text" data-table="t95_homedetail" data-field="x_no_jdl" name="x<?php echo $t95_homedetail_list->RowIndex ?>_no_jdl" id="x<?php echo $t95_homedetail_list->RowIndex ?>_no_jdl" size="1" placeholder="<?php echo ew_HtmlEncode($t95_homedetail->no_jdl->getPlaceHolder()) ?>" value="<?php echo $t95_homedetail->no_jdl->EditValue ?>"<?php echo $t95_homedetail->no_jdl->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t95_homedetail" data-field="x_no_jdl" name="o<?php echo $t95_homedetail_list->RowIndex ?>_no_jdl" id="o<?php echo $t95_homedetail_list->RowIndex ?>_no_jdl" value="<?php echo ew_HtmlEncode($t95_homedetail->no_jdl->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t95_homedetail->jdl->Visible) { // jdl ?>
		<td data-name="jdl">
<span id="el$rowindex$_t95_homedetail_jdl" class="form-group t95_homedetail_jdl">
<input type="text" data-table="t95_homedetail" data-field="x_jdl" name="x<?php echo $t95_homedetail_list->RowIndex ?>_jdl" id="x<?php echo $t95_homedetail_list->RowIndex ?>_jdl" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t95_homedetail->jdl->getPlaceHolder()) ?>" value="<?php echo $t95_homedetail->jdl->EditValue ?>"<?php echo $t95_homedetail->jdl->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t95_homedetail" data-field="x_jdl" name="o<?php echo $t95_homedetail_list->RowIndex ?>_jdl" id="o<?php echo $t95_homedetail_list->RowIndex ?>_jdl" value="<?php echo ew_HtmlEncode($t95_homedetail->jdl->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t95_homedetail->no_ket->Visible) { // no_ket ?>
		<td data-name="no_ket">
<span id="el$rowindex$_t95_homedetail_no_ket" class="form-group t95_homedetail_no_ket">
<input type="text" data-table="t95_homedetail" data-field="x_no_ket" name="x<?php echo $t95_homedetail_list->RowIndex ?>_no_ket" id="x<?php echo $t95_homedetail_list->RowIndex ?>_no_ket" size="1" placeholder="<?php echo ew_HtmlEncode($t95_homedetail->no_ket->getPlaceHolder()) ?>" value="<?php echo $t95_homedetail->no_ket->EditValue ?>"<?php echo $t95_homedetail->no_ket->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t95_homedetail" data-field="x_no_ket" name="o<?php echo $t95_homedetail_list->RowIndex ?>_no_ket" id="o<?php echo $t95_homedetail_list->RowIndex ?>_no_ket" value="<?php echo ew_HtmlEncode($t95_homedetail->no_ket->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t95_homedetail->ket->Visible) { // ket ?>
		<td data-name="ket">
<span id="el$rowindex$_t95_homedetail_ket" class="form-group t95_homedetail_ket">
<textarea data-table="t95_homedetail" data-field="x_ket" name="x<?php echo $t95_homedetail_list->RowIndex ?>_ket" id="x<?php echo $t95_homedetail_list->RowIndex ?>_ket" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($t95_homedetail->ket->getPlaceHolder()) ?>"<?php echo $t95_homedetail->ket->EditAttributes() ?>><?php echo $t95_homedetail->ket->EditValue ?></textarea>
</span>
<input type="hidden" data-table="t95_homedetail" data-field="x_ket" name="o<?php echo $t95_homedetail_list->RowIndex ?>_ket" id="o<?php echo $t95_homedetail_list->RowIndex ?>_ket" value="<?php echo ew_HtmlEncode($t95_homedetail->ket->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t95_homedetail->done->Visible) { // done ?>
		<td data-name="done">
<span id="el$rowindex$_t95_homedetail_done" class="form-group t95_homedetail_done">
<div id="tp_x<?php echo $t95_homedetail_list->RowIndex ?>_done" class="ewTemplate"><input type="checkbox" data-table="t95_homedetail" data-field="x_done" data-value-separator="<?php echo $t95_homedetail->done->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t95_homedetail_list->RowIndex ?>_done[]" id="x<?php echo $t95_homedetail_list->RowIndex ?>_done[]" value="{value}"<?php echo $t95_homedetail->done->EditAttributes() ?>></div>
<div id="dsl_x<?php echo $t95_homedetail_list->RowIndex ?>_done" data-repeatcolumn="5" class="ewItemList" style="display: none;"><div>
<?php echo $t95_homedetail->done->CheckBoxListHtml(FALSE, "x{$t95_homedetail_list->RowIndex}_done[]") ?>
</div></div>
</span>
<input type="hidden" data-table="t95_homedetail" data-field="x_done" name="o<?php echo $t95_homedetail_list->RowIndex ?>_done[]" id="o<?php echo $t95_homedetail_list->RowIndex ?>_done[]" value="<?php echo ew_HtmlEncode($t95_homedetail->done->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t95_homedetail_list->ListOptions->Render("body", "right", $t95_homedetail_list->RowIndex);
?>
<script type="text/javascript">
ft95_homedetaillist.UpdateOpts(<?php echo $t95_homedetail_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($t95_homedetail->CurrentAction == "add" || $t95_homedetail->CurrentAction == "copy") { ?>
<input type="hidden" name="<?php echo $t95_homedetail_list->FormKeyCountName ?>" id="<?php echo $t95_homedetail_list->FormKeyCountName ?>" value="<?php echo $t95_homedetail_list->KeyCount ?>">
<?php } ?>
<?php if ($t95_homedetail->CurrentAction == "gridadd") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $t95_homedetail_list->FormKeyCountName ?>" id="<?php echo $t95_homedetail_list->FormKeyCountName ?>" value="<?php echo $t95_homedetail_list->KeyCount ?>">
<?php echo $t95_homedetail_list->MultiSelectKey ?>
<?php } ?>
<?php if ($t95_homedetail->CurrentAction == "edit") { ?>
<input type="hidden" name="<?php echo $t95_homedetail_list->FormKeyCountName ?>" id="<?php echo $t95_homedetail_list->FormKeyCountName ?>" value="<?php echo $t95_homedetail_list->KeyCount ?>">
<?php } ?>
<?php if ($t95_homedetail->CurrentAction == "gridedit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $t95_homedetail_list->FormKeyCountName ?>" id="<?php echo $t95_homedetail_list->FormKeyCountName ?>" value="<?php echo $t95_homedetail_list->KeyCount ?>">
<?php echo $t95_homedetail_list->MultiSelectKey ?>
<?php } ?>
<?php if ($t95_homedetail->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($t95_homedetail_list->Recordset)
	$t95_homedetail_list->Recordset->Close();
?>
<div class="box-footer ewGridLowerPanel">
<?php if ($t95_homedetail->CurrentAction <> "gridadd" && $t95_homedetail->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-inline ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($t95_homedetail_list->Pager)) $t95_homedetail_list->Pager = new cPrevNextPager($t95_homedetail_list->StartRec, $t95_homedetail_list->DisplayRecs, $t95_homedetail_list->TotalRecs, $t95_homedetail_list->AutoHidePager) ?>
<?php if ($t95_homedetail_list->Pager->RecordCount > 0 && $t95_homedetail_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($t95_homedetail_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $t95_homedetail_list->PageUrl() ?>start=<?php echo $t95_homedetail_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($t95_homedetail_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $t95_homedetail_list->PageUrl() ?>start=<?php echo $t95_homedetail_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $t95_homedetail_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($t95_homedetail_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $t95_homedetail_list->PageUrl() ?>start=<?php echo $t95_homedetail_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($t95_homedetail_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $t95_homedetail_list->PageUrl() ?>start=<?php echo $t95_homedetail_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $t95_homedetail_list->Pager->PageCount ?></span>
</div>
<?php } ?>
<?php if ($t95_homedetail_list->Pager->RecordCount > 0) { ?>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $t95_homedetail_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $t95_homedetail_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $t95_homedetail_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($t95_homedetail_list->TotalRecs > 0 && (!$t95_homedetail_list->AutoHidePageSizeSelector || $t95_homedetail_list->Pager->Visible)) { ?>
<div class="ewPager">
<input type="hidden" name="t" value="t95_homedetail">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" class="form-control input-sm ewTooltip" title="<?php echo $Language->Phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($t95_homedetail_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($t95_homedetail_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($t95_homedetail_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($t95_homedetail_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($t95_homedetail_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="ALL"<?php if ($t95_homedetail->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t95_homedetail_list->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
</div>
<?php } ?>
<?php if ($t95_homedetail_list->TotalRecs == 0 && $t95_homedetail->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t95_homedetail_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<script type="text/javascript">
ft95_homedetaillist.Init();
</script>
<?php
$t95_homedetail_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t95_homedetail_list->Page_Terminate();
?>
