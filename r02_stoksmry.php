<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start();
?>
<?php include_once "rcfg11.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "phprptinc/ewmysql.php") ?>
<?php include_once "rphpfn11.php" ?>
<?php include_once "rusrfn11.php" ?>
<?php include_once "r02_stoksmryinfo.php" ?>
<?php

//
// Page class
//

$r02_stok_summary = NULL; // Initialize page object first

class crr02_stok_summary extends crr02_stok {

	// Page ID
	var $PageID = 'summary';

	// Project ID
	var $ProjectID = "{A2EF3792-3541-4459-9D68-D8F1DBA083C2}";

	// Page object name
	var $PageObjName = 'r02_stok_summary';

	// Page headings
	var $Heading = '';
	var $Subheading = '';

	// Page heading
	function PageHeading() {
		global $ReportLanguage;
		if ($this->Heading <> "")
			return $this->Heading;
		if (method_exists($this, "TableCaption"))
			return $this->TableCaption();
		return "";
	}

	// Page subheading
	function PageSubheading() {
		global $ReportLanguage;
		if ($this->Subheading <> "")
			return $this->Subheading;
		return "";
	}

	// Page name
	function PageName() {
		return ewr_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ewr_CurrentPage() . "?";
		if ($this->UseTokenInUrl) $PageUrl .= "t=" . $this->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Export URLs
	var $ExportPrintUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportPdfUrl;
	var $ReportTableClass;
	var $ReportTableStyle = "";

	// Custom export
	var $ExportPrintCustom = FALSE;
	var $ExportExcelCustom = FALSE;
	var $ExportWordCustom = FALSE;
	var $ExportPdfCustom = FALSE;
	var $ExportEmailCustom = FALSE;

	// Message
	function getMessage() {
		return @$_SESSION[EWR_SESSION_MESSAGE];
	}

	function setMessage($v) {
		ewr_AddMessage($_SESSION[EWR_SESSION_MESSAGE], $v);
	}

	function getFailureMessage() {
		return @$_SESSION[EWR_SESSION_FAILURE_MESSAGE];
	}

	function setFailureMessage($v) {
		ewr_AddMessage($_SESSION[EWR_SESSION_FAILURE_MESSAGE], $v);
	}

	function getSuccessMessage() {
		return @$_SESSION[EWR_SESSION_SUCCESS_MESSAGE];
	}

	function setSuccessMessage($v) {
		ewr_AddMessage($_SESSION[EWR_SESSION_SUCCESS_MESSAGE], $v);
	}

	function getWarningMessage() {
		return @$_SESSION[EWR_SESSION_WARNING_MESSAGE];
	}

	function setWarningMessage($v) {
		ewr_AddMessage($_SESSION[EWR_SESSION_WARNING_MESSAGE], $v);
	}

		// Show message
	function ShowMessage() {
		$hidden = FALSE;
		$html = "";

		// Message
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage, "");
		if ($sMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sMessage;
			$html .= "<div class=\"alert alert-info ewInfo\">" . $sMessage . "</div>";
			$_SESSION[EWR_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$sWarningMessage = $this->getWarningMessage();
		$this->Message_Showing($sWarningMessage, "warning");
		if ($sWarningMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sWarningMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sWarningMessage;
			$html .= "<div class=\"alert alert-warning ewWarning\">" . $sWarningMessage . "</div>";
			$_SESSION[EWR_SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		$this->Message_Showing($sSuccessMessage, "success");
		if ($sSuccessMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sSuccessMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sSuccessMessage;
			$html .= "<div class=\"alert alert-success ewSuccess\">" . $sSuccessMessage . "</div>";
			$_SESSION[EWR_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		$this->Message_Showing($sErrorMessage, "failure");
		if ($sErrorMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sErrorMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sErrorMessage;
			$html .= "<div class=\"alert alert-danger ewError\">" . $sErrorMessage . "</div>";
			$_SESSION[EWR_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo "<div class=\"ewMessageDialog\"" . (($hidden) ? " style=\"display: none;\"" : "") . ">" . $html . "</div>";
	}
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") // Header exists, display
			echo $sHeader;
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") // Fotoer exists, display
			echo $sFooter;
	}

	// Validate page request
	function IsPageRequest() {
		if ($this->UseTokenInUrl) {
			if (ewr_IsHttpPost())
				return ($this->TableVar == @$_POST("t"));
			if (@$_GET["t"] <> "")
				return ($this->TableVar == @$_GET["t"]);
		} else {
			return TRUE;
		}
	}
	var $Token = "";
	var $CheckToken = EWR_CHECK_TOKEN;
	var $CheckTokenFn = "ewr_CheckToken";
	var $CreateTokenFn = "ewr_CreateToken";

	// Valid Post
	function ValidPost() {
		if (!$this->CheckToken || !ewr_IsHttpPost())
			return TRUE;
		if (!isset($_POST[EWR_TOKEN_NAME]))
			return FALSE;
		$fn = $this->CheckTokenFn;
		if (is_callable($fn))
			return $fn($_POST[EWR_TOKEN_NAME]);
		return FALSE;
	}

	// Create Token
	function CreateToken() {
		global $grToken;
		if ($this->CheckToken) {
			$fn = $this->CreateTokenFn;
			if ($this->Token == "" && is_callable($fn)) // Create token
				$this->Token = $fn();
			$grToken = $this->Token; // Save to global variable
		}
	}

	//
	// Page class constructor
	//
	function __construct() {
		global $conn, $ReportLanguage;
		global $UserTable, $UserTableConn;

		// Language object
		$ReportLanguage = new crLanguage();

		// Parent constuctor
		parent::__construct();

		// Table object (r02_stok)
		if (!isset($GLOBALS["r02_stok"])) {
			$GLOBALS["r02_stok"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["r02_stok"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";

		// Page ID
		if (!defined("EWR_PAGE_ID"))
			define("EWR_PAGE_ID", 'summary', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EWR_TABLE_NAME"))
			define("EWR_TABLE_NAME", 'r02_stok', TRUE);

		// Start timer
		if (!isset($GLOBALS["grTimer"]))
			$GLOBALS["grTimer"] = new crTimer();

		// Debug message
		ewr_LoadDebugMsg();

		// Open connection
		if (!isset($conn)) $conn = ewr_Connect($this->DBID);

		// User table object (t96_employees)
		if (!isset($UserTable)) {
			$UserTable = new crt96_employees();
			$UserTableConn = ReportConn($UserTable->DBID);
		}

		// Export options
		$this->ExportOptions = new crListOptions();
		$this->ExportOptions->Tag = "div";
		$this->ExportOptions->TagClassName = "ewExportOption";

		// Search options
		$this->SearchOptions = new crListOptions();
		$this->SearchOptions->Tag = "div";
		$this->SearchOptions->TagClassName = "ewSearchOption";

		// Filter options
		$this->FilterOptions = new crListOptions();
		$this->FilterOptions->Tag = "div";
		$this->FilterOptions->TagClassName = "ewFilterOption fr02_stoksummary";

		// Generate report options
		$this->GenerateOptions = new crListOptions();
		$this->GenerateOptions->Tag = "div";
		$this->GenerateOptions->TagClassName = "ewGenerateOption";
	}

	//
	// Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $gsEmailContentType, $ReportLanguage, $Security, $UserProfile;
		global $gsCustomExport;

		// User profile
		$UserProfile = new crUserProfile();

		// Security
		$Security = new crAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin(); // Auto login
		$Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->ProjectID . 'r02_stok');
		$Security->TablePermission_Loaded();
		if (!$Security->CanList()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage(ewr_DeniedMsg()); // Set no permission
			$this->Page_Terminate(ewr_GetUrl("index.php"));
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();
		if ($Security->IsLoggedIn() && strval($Security->CurrentUserID()) == "") {
			$Security->SaveLastUrl();
			$this->setFailureMessage(ewr_DeniedMsg()); // Set no permission
			$this->Page_Terminate(ewr_GetUrl("login.php"));
		}

		// Get export parameters
		if (@$_GET["export"] <> "")
			$this->Export = strtolower($_GET["export"]);
		elseif (@$_POST["export"] <> "")
			$this->Export = strtolower($_POST["export"]);
		$gsExport = $this->Export; // Get export parameter, used in header
		$gsExportFile = $this->TableVar; // Get export file, used in header
		$gsEmailContentType = @$_POST["contenttype"]; // Get email content type

		// Setup placeholder
		// Setup export options

		$this->SetupExportOptions();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->ValidPost()) {
			echo $ReportLanguage->Phrase("InvalidPostRequest");
			$this->Page_Terminate();
			exit();
		}

		// Create Token
		$this->CreateToken();
	}

	// Set up export options
	function SetupExportOptions() {
		global $Security, $ReportLanguage, $ReportOptions;
		$exportid = session_id();
		$ReportTypes = array();

		// Printer friendly
		$item = &$this->ExportOptions->Add("print");
		$item->Body = "<a class=\"ewrExportLink ewPrint\" title=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("PrinterFriendly", TRUE)) . "\" data-caption=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("PrinterFriendly", TRUE)) . "\" href=\"" . $this->ExportPrintUrl . "\">" . $ReportLanguage->Phrase("PrinterFriendly") . "</a>";
		$item->Visible = TRUE;
		$ReportTypes["print"] = $item->Visible ? $ReportLanguage->Phrase("ReportFormPrint") : "";

		// Export to Excel
		$item = &$this->ExportOptions->Add("excel");
		$item->Body = "<a class=\"ewrExportLink ewExcel\" title=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ExportToExcel", TRUE)) . "\" data-caption=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ExportToExcel", TRUE)) . "\" href=\"" . $this->ExportExcelUrl . "\">" . $ReportLanguage->Phrase("ExportToExcel") . "</a>";
		$item->Visible = TRUE;
		$ReportTypes["excel"] = $item->Visible ? $ReportLanguage->Phrase("ReportFormExcel") : "";

		// Export to Word
		$item = &$this->ExportOptions->Add("word");
		$item->Body = "<a class=\"ewrExportLink ewWord\" title=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ExportToWord", TRUE)) . "\" data-caption=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ExportToWord", TRUE)) . "\" href=\"" . $this->ExportWordUrl . "\">" . $ReportLanguage->Phrase("ExportToWord") . "</a>";
		$item->Visible = TRUE;
		$ReportTypes["word"] = $item->Visible ? $ReportLanguage->Phrase("ReportFormWord") : "";

		// Export to Pdf
		$item = &$this->ExportOptions->Add("pdf");
		$item->Body = "<a class=\"ewrExportLink ewPdf\" title=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ExportToPDF", TRUE)) . "\" data-caption=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ExportToPDF", TRUE)) . "\" href=\"" . $this->ExportPdfUrl . "\">" . $ReportLanguage->Phrase("ExportToPDF") . "</a>";
		$item->Visible = FALSE;

		// Uncomment codes below to show export to Pdf link
//		$item->Visible = TRUE;

		$ReportTypes["pdf"] = $item->Visible ? $ReportLanguage->Phrase("ReportFormPdf") : "";

		// Export to Email
		$item = &$this->ExportOptions->Add("email");
		$url = $this->PageUrl() . "export=email";
		$item->Body = "<a class=\"ewrExportLink ewEmail\" title=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ExportToEmail", TRUE)) . "\" data-caption=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ExportToEmail", TRUE)) . "\" id=\"emf_r02_stok\" href=\"javascript:void(0);\" onclick=\"ewr_EmailDialogShow({lnk:'emf_r02_stok',hdr:ewLanguage.Phrase('ExportToEmail'),url:'$url',exportid:'$exportid',el:this});\">" . $ReportLanguage->Phrase("ExportToEmail") . "</a>";
		$item->Visible = TRUE;
		$ReportTypes["email"] = $item->Visible ? $ReportLanguage->Phrase("ReportFormEmail") : "";
		$ReportOptions["ReportTypes"] = $ReportTypes;

		// Drop down button for export
		$this->ExportOptions->UseDropDownButton = TRUE;
		$this->ExportOptions->UseButtonGroup = TRUE;
		$this->ExportOptions->UseImageAndText = $this->ExportOptions->UseDropDownButton;
		$this->ExportOptions->DropDownButtonPhrase = $ReportLanguage->Phrase("ButtonExport");

		// Add group option item
		$item = &$this->ExportOptions->Add($this->ExportOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Filter button
		$item = &$this->FilterOptions->Add("savecurrentfilter");
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"fr02_stoksummary\" href=\"#\">" . $ReportLanguage->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"fr02_stoksummary\" href=\"#\">" . $ReportLanguage->Phrase("DeleteFilter") . "</a>";
		$item->Visible = TRUE;
		$this->FilterOptions->UseDropDownButton = TRUE;
		$this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton; // v8
		$this->FilterOptions->DropDownButtonPhrase = $ReportLanguage->Phrase("Filters");

		// Add group option item
		$item = &$this->FilterOptions->Add($this->FilterOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Set up options (extended)
		$this->SetupExportOptionsExt();

		// Hide options for export
		if ($this->Export <> "") {
			$this->ExportOptions->HideAllOptions();
			$this->FilterOptions->HideAllOptions();
		}

		// Set up table class
		if ($this->Export == "word" || $this->Export == "excel" || $this->Export == "pdf")
			$this->ReportTableClass = "ewTable";
		else
			$this->ReportTableClass = "table ewTable";
	}

	// Set up search options
	function SetupSearchOptions() {
		global $ReportLanguage;

		// Filter panel button
		$item = &$this->SearchOptions->Add("searchtoggle");
		$SearchToggleClass = $this->FilterApplied ? " active" : " active";
		$item->Body = "<button type=\"button\" class=\"btn btn-default ewSearchToggle" . $SearchToggleClass . "\" title=\"" . $ReportLanguage->Phrase("SearchBtn", TRUE) . "\" data-caption=\"" . $ReportLanguage->Phrase("SearchBtn", TRUE) . "\" data-toggle=\"button\" data-form=\"fr02_stoksummary\">" . $ReportLanguage->Phrase("SearchBtn") . "</button>";
		$item->Visible = TRUE;

		// Reset filter
		$item = &$this->SearchOptions->Add("resetfilter");
		$item->Body = "<button type=\"button\" class=\"btn btn-default\" title=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ResetAllFilter", TRUE)) . "\" data-caption=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ResetAllFilter", TRUE)) . "\" onclick=\"location='" . ewr_CurrentPage() . "?cmd=reset'\">" . $ReportLanguage->Phrase("ResetAllFilter") . "</button>";
		$item->Visible = TRUE && $this->FilterApplied;

		// Button group for reset filter
		$this->SearchOptions->UseButtonGroup = TRUE;

		// Add group option item
		$item = &$this->SearchOptions->Add($this->SearchOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide options for export
		if ($this->Export <> "")
			$this->SearchOptions->HideAllOptions();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $ReportLanguage, $EWR_EXPORT, $gsExportFile;
		global $grDashboardReport;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		if ($this->Export <> "" && array_key_exists($this->Export, $EWR_EXPORT)) {
			$sContent = ob_get_contents();
			if (ob_get_length())
				ob_end_clean();

			// Remove all <div data-tagid="..." id="orig..." class="hide">...</div> (for customviewtag export, except "googlemaps")
			if (preg_match_all('/<div\s+data-tagid=[\'"]([\s\S]*?)[\'"]\s+id=[\'"]orig([\s\S]*?)[\'"]\s+class\s*=\s*[\'"]hide[\'"]>([\s\S]*?)<\/div\s*>/i', $sContent, $divmatches, PREG_SET_ORDER)) {
				foreach ($divmatches as $divmatch) {
					if ($divmatch[1] <> "googlemaps")
						$sContent = str_replace($divmatch[0], '', $sContent);
				}
			}
			$fn = $EWR_EXPORT[$this->Export];
			if ($this->Export == "email") { // Email
				if (@$this->GenOptions["reporttype"] == "email") {
					$saveResponse = $this->$fn($sContent, $this->GenOptions);
					$this->WriteGenResponse($saveResponse);
				} else {
					echo $this->$fn($sContent, array());
				}
				$url = ""; // Avoid redirect
			} else {
				$saveToFile = $this->$fn($sContent, $this->GenOptions);
				if (@$this->GenOptions["reporttype"] <> "") {
					$saveUrl = ($saveToFile <> "") ? ewr_FullUrl($saveToFile, "genurl") : $ReportLanguage->Phrase("GenerateSuccess");
					$this->WriteGenResponse($saveUrl);
					$url = ""; // Avoid redirect
				}
			}
		}

		// Close connection if not in dashboard
		if (!$grDashboardReport)
			ewr_CloseConn();

		// Go to URL if specified
		if ($url <> "") {
			if (!EWR_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			ewr_SaveDebugMsg();
			header("Location: " . $url);
		}
		if (!$grDashboardReport)
			exit();
	}

	// Initialize common variables
	var $ExportOptions; // Export options
	var $SearchOptions; // Search options
	var $FilterOptions; // Filter options

	// Paging variables
	var $RecIndex = 0; // Record index
	var $RecCount = 0; // Record count
	var $StartGrp = 0; // Start group
	var $StopGrp = 0; // Stop group
	var $TotalGrps = 0; // Total groups
	var $GrpCount = 0; // Group count
	var $GrpCounter = array(); // Group counter
	var $DisplayGrps = 10; // Groups per page
	var $GrpRange = 10;
	var $Sort = "";
	var $Filter = "";
	var $PageFirstGroupFilter = "";
	var $UserIDFilter = "";
	var $DrillDown = FALSE;
	var $DrillDownInPanel = FALSE;
	var $DrillDownList = "";

	// Clear field for ext filter
	var $ClearExtFilter = "";
	var $PopupName = "";
	var $PopupValue = "";
	var $FilterApplied;
	var $SearchCommand = FALSE;
	var $ShowHeader;
	var $GrpColumnCount = 0;
	var $SubGrpColumnCount = 0;
	var $DtlColumnCount = 0;
	var $Cnt, $Col, $Val, $Smry, $Mn, $Mx, $GrandCnt, $GrandSmry, $GrandMn, $GrandMx;
	var $TotCount;
	var $GrandSummarySetup = FALSE;
	var $GrpIdx;
	var $DetailRows = array();
	var $TopContentClass = "col-sm-12 ewTop";
	var $LeftContentClass = "ewLeft";
	var $CenterContentClass = "col-sm-12 ewCenter";
	var $RightContentClass = "ewRight";
	var $BottomContentClass = "col-sm-12 ewBottom";

	//
	// Page main
	//
	function Page_Main() {
		global $rs;
		global $rsgrp;
		global $Security;
		global $grFormError;
		global $grDrillDownInPanel;
		global $ReportBreadcrumb;
		global $ReportLanguage;
		global $grDashboardReport;

		// Set field visibility for detail fields
		$this->Article->SetVisibility();
		$this->SumQty->SetVisibility();
		$this->Satuan->SetVisibility();
		$this->AvgHarga->SetVisibility();
		$this->SubTotal->SetVisibility();

		// Aggregate variables
		// 1st dimension = no of groups (level 0 used for grand total)
		// 2nd dimension = no of fields

		$nDtls = 6;
		$nGrps = 3;
		$this->Val = &ewr_InitArray($nDtls, 0);
		$this->Cnt = &ewr_Init2DArray($nGrps, $nDtls, 0);
		$this->Smry = &ewr_Init2DArray($nGrps, $nDtls, 0);
		$this->Mn = &ewr_Init2DArray($nGrps, $nDtls, NULL);
		$this->Mx = &ewr_Init2DArray($nGrps, $nDtls, NULL);
		$this->GrandCnt = &ewr_InitArray($nDtls, 0);
		$this->GrandSmry = &ewr_InitArray($nDtls, 0);
		$this->GrandMn = &ewr_InitArray($nDtls, NULL);
		$this->GrandMx = &ewr_InitArray($nDtls, NULL);

		// Set up array if accumulation required: array(Accum, SkipNullOrZero)
		$this->Col = array(array(FALSE, FALSE), array(FALSE,FALSE), array(TRUE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(TRUE,FALSE));

		// Set up groups per page dynamically
		$this->SetUpDisplayGrps();

		// Set up Breadcrumb
		if ($this->Export == "")
			$this->SetupBreadcrumb();

		// Check if search command
		$this->SearchCommand = (@$_GET["cmd"] == "search");

		// Load default filter values
		$this->LoadDefaultFilters();

		// Load custom filters
		$this->Page_FilterLoad();

		// Set up popup filter
		$this->SetupPopup();

		// Load group db values if necessary
		$this->LoadGroupDbValues();

		// Handle Ajax popup
		$this->ProcessAjaxPopup();

		// Extended filter
		$sExtendedFilter = "";

		// Restore filter list
		$this->RestoreFilterList();

		// Build extended filter
		$sExtendedFilter = $this->GetExtendedFilter();
		ewr_AddFilter($this->Filter, $sExtendedFilter);

		// Build popup filter
		$sPopupFilter = $this->GetPopupFilter();

		//ewr_SetDebugMsg("popup filter: " . $sPopupFilter);
		ewr_AddFilter($this->Filter, $sPopupFilter);

		// Check if filter applied
		$this->FilterApplied = $this->CheckFilter();

		// Call Page Selecting event
		$this->Page_Selecting($this->Filter);

		// Search options
		$this->SetupSearchOptions();

		// Get sort
		$this->Sort = $this->GetSort($this->GenOptions);

		// Get total group count
		$sGrpSort = ewr_UpdateSortFields($this->getSqlOrderByGroup(), $this->Sort, 2); // Get grouping field only
		$sSql = ewr_BuildReportSql($this->getSqlSelectGroup(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderByGroup(), $this->Filter, $sGrpSort);
		$this->TotalGrps = $this->GetGrpCnt($sSql);
		if ($this->DisplayGrps <= 0 || $this->DrillDown || $grDashboardReport) // Display all groups
			$this->DisplayGrps = $this->TotalGrps;
		$this->StartGrp = 1;

		// Show header
		$this->ShowHeader = ($this->TotalGrps > 0);

		// Set up start position if not export all
		if ($this->ExportAll && $this->Export <> "")
			$this->DisplayGrps = $this->TotalGrps;
		else
			$this->SetUpStartGroup($this->GenOptions);

		// Set no record found message
		if ($this->TotalGrps == 0) {
			if ($Security->CanList()) {
				if ($this->Filter == "0=101") {
					$this->setWarningMessage($ReportLanguage->Phrase("EnterSearchCriteria"));
				} else {
					$this->setWarningMessage($ReportLanguage->Phrase("NoRecord"));
				}
			} else {
				$this->setWarningMessage(ewr_DeniedMsg());
			}
		}

		// Hide export options if export/dashboard report
		if ($this->Export <> "" || $grDashboardReport)
			$this->ExportOptions->HideAllOptions();

		// Hide search/filter options if export/drilldown/dashboard report
		if ($this->Export <> "" || $this->DrillDown || $grDashboardReport) {
			$this->SearchOptions->HideAllOptions();
			$this->FilterOptions->HideAllOptions();
			$this->GenerateOptions->HideAllOptions();
		}

		// Get current page groups
		$rsgrp = $this->GetGrpRs($sSql, $this->StartGrp, $this->DisplayGrps);

		// Init detail recordset
		$rs = NULL;
		$this->SetupFieldCount();
	}

	// Get summary count
	function GetSummaryCount($lvl, $curValue = TRUE) {
		$cnt = 0;
		foreach ($this->DetailRows as $row) {
			$wrkMainGroup = $row["MainGroup"];
			$wrkSubGroup = $row["SubGroup"];
			if ($lvl >= 1) {
				$val = $curValue ? $this->MainGroup->CurrentValue : $this->MainGroup->OldValue;
				$grpval = $curValue ? $this->MainGroup->GroupValue() : $this->MainGroup->GroupOldValue();
				if (is_null($val) && !is_null($wrkMainGroup) || !is_null($val) && is_null($wrkMainGroup) ||
					$grpval <> $this->MainGroup->getGroupValueBase($wrkMainGroup))
				continue;
			}
			if ($lvl >= 2) {
				$val = $curValue ? $this->SubGroup->CurrentValue : $this->SubGroup->OldValue;
				$grpval = $curValue ? $this->SubGroup->GroupValue() : $this->SubGroup->GroupOldValue();
				if (is_null($val) && !is_null($wrkSubGroup) || !is_null($val) && is_null($wrkSubGroup) ||
					$grpval <> $this->SubGroup->getGroupValueBase($wrkSubGroup))
				continue;
			}
			$cnt++;
		}
		return $cnt;
	}

	// Check level break
	function ChkLvlBreak($lvl) {
		switch ($lvl) {
			case 1:
				return (is_null($this->MainGroup->CurrentValue) && !is_null($this->MainGroup->OldValue)) ||
					(!is_null($this->MainGroup->CurrentValue) && is_null($this->MainGroup->OldValue)) ||
					($this->MainGroup->GroupValue() <> $this->MainGroup->GroupOldValue());
			case 2:
				return (is_null($this->SubGroup->CurrentValue) && !is_null($this->SubGroup->OldValue)) ||
					(!is_null($this->SubGroup->CurrentValue) && is_null($this->SubGroup->OldValue)) ||
					($this->SubGroup->GroupValue() <> $this->SubGroup->GroupOldValue()) || $this->ChkLvlBreak(1); // Recurse upper level
		}
	}

	// Accummulate summary
	function AccumulateSummary() {
		$cntx = count($this->Smry);
		for ($ix = 0; $ix < $cntx; $ix++) {
			$cnty = count($this->Smry[$ix]);
			for ($iy = 1; $iy < $cnty; $iy++) {
				if ($this->Col[$iy][0]) { // Accumulate required
					$valwrk = $this->Val[$iy];
					if (is_null($valwrk)) {
						if (!$this->Col[$iy][1])
							$this->Cnt[$ix][$iy]++;
					} else {
						$accum = (!$this->Col[$iy][1] || !is_numeric($valwrk) || $valwrk <> 0);
						if ($accum) {
							$this->Cnt[$ix][$iy]++;
							if (is_numeric($valwrk)) {
								$this->Smry[$ix][$iy] += $valwrk;
								if (is_null($this->Mn[$ix][$iy])) {
									$this->Mn[$ix][$iy] = $valwrk;
									$this->Mx[$ix][$iy] = $valwrk;
								} else {
									if ($this->Mn[$ix][$iy] > $valwrk) $this->Mn[$ix][$iy] = $valwrk;
									if ($this->Mx[$ix][$iy] < $valwrk) $this->Mx[$ix][$iy] = $valwrk;
								}
							}
						}
					}
				}
			}
		}
		$cntx = count($this->Smry);
		for ($ix = 0; $ix < $cntx; $ix++) {
			$this->Cnt[$ix][0]++;
		}
	}

	// Reset level summary
	function ResetLevelSummary($lvl) {

		// Clear summary values
		$cntx = count($this->Smry);
		for ($ix = $lvl; $ix < $cntx; $ix++) {
			$cnty = count($this->Smry[$ix]);
			for ($iy = 1; $iy < $cnty; $iy++) {
				$this->Cnt[$ix][$iy] = 0;
				if ($this->Col[$iy][0]) {
					$this->Smry[$ix][$iy] = 0;
					$this->Mn[$ix][$iy] = NULL;
					$this->Mx[$ix][$iy] = NULL;
				}
			}
		}
		$cntx = count($this->Smry);
		for ($ix = $lvl; $ix < $cntx; $ix++) {
			$this->Cnt[$ix][0] = 0;
		}

		// Reset record count
		$this->RecCount = 0;
	}

	// Accummulate grand summary
	function AccumulateGrandSummary() {
		$this->TotCount++;
		$cntgs = count($this->GrandSmry);
		for ($iy = 1; $iy < $cntgs; $iy++) {
			if ($this->Col[$iy][0]) {
				$valwrk = $this->Val[$iy];
				if (is_null($valwrk) || !is_numeric($valwrk)) {
					if (!$this->Col[$iy][1])
						$this->GrandCnt[$iy]++;
				} else {
					if (!$this->Col[$iy][1] || $valwrk <> 0) {
						$this->GrandCnt[$iy]++;
						$this->GrandSmry[$iy] += $valwrk;
						if (is_null($this->GrandMn[$iy])) {
							$this->GrandMn[$iy] = $valwrk;
							$this->GrandMx[$iy] = $valwrk;
						} else {
							if ($this->GrandMn[$iy] > $valwrk) $this->GrandMn[$iy] = $valwrk;
							if ($this->GrandMx[$iy] < $valwrk) $this->GrandMx[$iy] = $valwrk;
						}
					}
				}
			}
		}
	}

	// Get group count
	function GetGrpCnt($sql) {
		$conn = &$this->Connection();
		$rsgrpcnt = $conn->Execute($sql);
		$grpcnt = ($rsgrpcnt) ? $rsgrpcnt->RecordCount() : 0;
		if ($rsgrpcnt) $rsgrpcnt->Close();
		return $grpcnt;
	}

	// Get group recordset
	function GetGrpRs($wrksql, $start = -1, $grps = -1) {
		$conn = &$this->Connection();
		$conn->raiseErrorFn = $GLOBALS["EWR_ERROR_FN"];
		$rswrk = $conn->SelectLimit($wrksql, $grps, $start - 1);
		$conn->raiseErrorFn = '';
		return $rswrk;
	}

	// Get group row values
	function GetGrpRow($opt) {
		global $rsgrp;
		if (!$rsgrp)
			return;
		if ($opt == 1) { // Get first group

			//$rsgrp->MoveFirst(); // NOTE: no need to move position
			$this->MainGroup->setDbValue(""); // Init first value
		} else { // Get next group
			$rsgrp->MoveNext();
		}
		if (!$rsgrp->EOF)
			$this->MainGroup->setDbValue($rsgrp->fields[0]);
		if ($rsgrp->EOF) {
			$this->MainGroup->setDbValue("");
		}
	}

	// Get detail recordset
	function GetDetailRs($wrksql) {
		$conn = &$this->Connection();
		$conn->raiseErrorFn = $GLOBALS["EWR_ERROR_FN"];
		$rswrk = $conn->Execute($wrksql);
		$dbtype = ewr_GetConnectionType($this->DBID);
		if ($dbtype == "MYSQL" || $dbtype == "POSTGRESQL") {
			$this->DetailRows = ($rswrk) ? $rswrk->GetRows() : array();
		} else { // Cannot MoveFirst, use another recordset
			$rstmp = $conn->Execute($wrksql);
			$this->DetailRows = ($rstmp) ? $rstmp->GetRows() : array();
			$rstmp->Close();
		}
		$conn->raiseErrorFn = "";
		return $rswrk;
	}

	// Get row values
	function GetRow($opt) {
		global $rs;
		if (!$rs)
			return;
		if ($opt == 1) { // Get first row
			$rs->MoveFirst(); // Move first
			if ($this->GrpCount == 1) {
				$this->FirstRowData = array();
				$this->FirstRowData['MainGroup'] = ewr_Conv($rs->fields('MainGroup'), 200);
				$this->FirstRowData['SubGroup'] = ewr_Conv($rs->fields('SubGroup'), 200);
				$this->FirstRowData['Article'] = ewr_Conv($rs->fields('Article'), 200);
				$this->FirstRowData['SumQty'] = ewr_Conv($rs->fields('SumQty'), 5);
				$this->FirstRowData['Satuan'] = ewr_Conv($rs->fields('Satuan'), 200);
				$this->FirstRowData['AvgHarga'] = ewr_Conv($rs->fields('AvgHarga'), 5);
				$this->FirstRowData['SubTotal'] = ewr_Conv($rs->fields('SubTotal'), 5);
			}
		} else { // Get next row
			$rs->MoveNext();
		}
		if (!$rs->EOF) {
			if ($opt <> 1) {
				if (is_array($this->MainGroup->GroupDbValues))
					$this->MainGroup->setDbValue(@$this->MainGroup->GroupDbValues[$rs->fields('MainGroup')]);
				else
					$this->MainGroup->setDbValue(ewr_GroupValue($this->MainGroup, $rs->fields('MainGroup')));
			}
			$this->SubGroup->setDbValue($rs->fields('SubGroup'));
			$this->Article->setDbValue($rs->fields('Article'));
			$this->SumQty->setDbValue($rs->fields('SumQty'));
			$this->Satuan->setDbValue($rs->fields('Satuan'));
			$this->AvgHarga->setDbValue($rs->fields('AvgHarga'));
			$this->SubTotal->setDbValue($rs->fields('SubTotal'));
			$this->Val[1] = $this->Article->CurrentValue;
			$this->Val[2] = $this->SumQty->CurrentValue;
			$this->Val[3] = $this->Satuan->CurrentValue;
			$this->Val[4] = $this->AvgHarga->CurrentValue;
			$this->Val[5] = $this->SubTotal->CurrentValue;
		} else {
			$this->MainGroup->setDbValue("");
			$this->SubGroup->setDbValue("");
			$this->Article->setDbValue("");
			$this->SumQty->setDbValue("");
			$this->Satuan->setDbValue("");
			$this->AvgHarga->setDbValue("");
			$this->SubTotal->setDbValue("");
		}
	}

	// Set up starting group
	function SetUpStartGroup($options = array()) {

		// Exit if no groups
		if ($this->DisplayGrps == 0)
			return;
		$startGrp = (@$options["start"] <> "") ? $options["start"] : @$_GET[EWR_TABLE_START_GROUP];
		$pageNo = (@$options["pageno"] <> "") ? $options["pageno"] : @$_GET["pageno"];

		// Check for a 'start' parameter
		if ($startGrp != "") {
			$this->StartGrp = $startGrp;
			$this->setStartGroup($this->StartGrp);
		} elseif ($pageNo != "") {
			$nPageNo = $pageNo;
			if (is_numeric($nPageNo)) {
				$this->StartGrp = ($nPageNo-1)*$this->DisplayGrps+1;
				if ($this->StartGrp <= 0) {
					$this->StartGrp = 1;
				} elseif ($this->StartGrp >= intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1) {
					$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1;
				}
				$this->setStartGroup($this->StartGrp);
			} else {
				$this->StartGrp = $this->getStartGroup();
			}
		} else {
			$this->StartGrp = $this->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGrp) || $this->StartGrp == "") { // Avoid invalid start group counter
			$this->StartGrp = 1; // Reset start group counter
			$this->setStartGroup($this->StartGrp);
		} elseif (intval($this->StartGrp) > intval($this->TotalGrps)) { // Avoid starting group > total groups
			$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to last page first group
			$this->setStartGroup($this->StartGrp);
		} elseif (($this->StartGrp-1) % $this->DisplayGrps <> 0) {
			$this->StartGrp = intval(($this->StartGrp-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to page boundary
			$this->setStartGroup($this->StartGrp);
		}
	}

	// Load group db values if necessary
	function LoadGroupDbValues() {
		$conn = &$this->Connection();
	}

	// Process Ajax popup
	function ProcessAjaxPopup() {
		global $ReportLanguage;
		$conn = &$this->Connection();
		$fld = NULL;
		if (@$_GET["popup"] <> "") {
			$popupname = $_GET["popup"];

			// Check popup name
			// Output data as Json

			if (!is_null($fld)) {
				$jsdb = ewr_GetJsDb($fld, $fld->FldType);
				if (ob_get_length())
					ob_end_clean();
				echo $jsdb;
				exit();
			}
		}
	}

	// Set up popup
	function SetupPopup() {
		global $ReportLanguage;
		$conn = &$this->Connection();
		if ($this->DrillDown)
			return;

		// Process post back form
		if (ewr_IsHttpPost()) {
			$sName = @$_POST["popup"]; // Get popup form name
			if ($sName <> "") {
				$cntValues = (is_array(@$_POST["sel_$sName"])) ? count($_POST["sel_$sName"]) : 0;
				if ($cntValues > 0) {
					$arValues = $_POST["sel_$sName"];
					if (trim($arValues[0]) == "") // Select all
						$arValues = EWR_INIT_VALUE;
					$this->PopupName = $sName;
					if (ewr_IsAdvancedFilterValue($arValues) || $arValues == EWR_INIT_VALUE)
						$this->PopupValue = $arValues;
					if (!ewr_MatchedArray($arValues, $_SESSION["sel_$sName"])) {
						if ($this->HasSessionFilterValues($sName))
							$this->ClearExtFilter = $sName; // Clear extended filter for this field
					}
					$_SESSION["sel_$sName"] = $arValues;
					$_SESSION["rf_$sName"] = @$_POST["rf_$sName"];
					$_SESSION["rt_$sName"] = @$_POST["rt_$sName"];
					$this->ResetPager();
				}
			}

		// Get 'reset' command
		} elseif (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];
			if (strtolower($sCmd) == "reset") {
				$this->ResetPager();
			}
		}

		// Load selection criteria to array
	}

	// Reset pager
	function ResetPager() {

		// Reset start position (reset command)
		$this->StartGrp = 1;
		$this->setStartGroup($this->StartGrp);
	}

	// Set up number of groups displayed per page
	function SetUpDisplayGrps() {
		$sWrk = @$_GET[EWR_TABLE_GROUP_PER_PAGE];
		if ($sWrk <> "") {
			if (is_numeric($sWrk)) {
				$this->DisplayGrps = intval($sWrk);
			} else {
				if (strtoupper($sWrk) == "ALL") { // Display all groups
					$this->DisplayGrps = -1;
				} else {
					$this->DisplayGrps = 10; // Non-numeric, load default
				}
			}
			$this->setGroupPerPage($this->DisplayGrps); // Save to session

			// Reset start position (reset command)
			$this->StartGrp = 1;
			$this->setStartGroup($this->StartGrp);
		} else {
			if ($this->getGroupPerPage() <> "") {
				$this->DisplayGrps = $this->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGrps = 10; // Load default
			}
		}
	}

	// Render row
	function RenderRow() {
		global $rs, $Security, $ReportLanguage;
		$conn = &$this->Connection();
		if (!$this->GrandSummarySetup) { // Get Grand total
			$bGotCount = FALSE;
			$bGotSummary = FALSE;

			// Get total count from sql directly
			$sSql = ewr_BuildReportSql($this->getSqlSelectCount(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, "");
			$rstot = $conn->Execute($sSql);
			if ($rstot) {
				$this->TotCount = ($rstot->RecordCount()>1) ? $rstot->RecordCount() : $rstot->fields[0];
				$rstot->Close();
				$bGotCount = TRUE;
			} else {
				$this->TotCount = 0;
			}

			// Get total from sql directly
			$sSql = ewr_BuildReportSql($this->getSqlSelectAgg(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, "");
			$sSql = $this->getSqlAggPfx() . $sSql . $this->getSqlAggSfx();
			$rsagg = $conn->Execute($sSql);
			if ($rsagg) {
				$this->GrandCnt[1] = $this->TotCount;
				$this->GrandCnt[2] = $this->TotCount;
				$this->GrandSmry[2] = $rsagg->fields("sum_sumqty");
				$this->GrandCnt[3] = $this->TotCount;
				$this->GrandCnt[4] = $this->TotCount;
				$this->GrandCnt[5] = $this->TotCount;
				$this->GrandSmry[5] = $rsagg->fields("sum_subtotal");
				$rsagg->Close();
				$bGotSummary = TRUE;
			}

			// Accumulate grand summary from detail records
			if (!$bGotCount || !$bGotSummary) {
				$sSql = ewr_BuildReportSql($this->getSqlSelect(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, "");
				$rs = $conn->Execute($sSql);
				if ($rs) {
					$this->GetRow(1);
					while (!$rs->EOF) {
						$this->AccumulateGrandSummary();
						$this->GetRow(2);
					}
					$rs->Close();
				}
			}
			$this->GrandSummarySetup = TRUE; // No need to set up again
		}

		// Call Row_Rendering event
		$this->Row_Rendering();

		//
		// Render view codes
		//

		if ($this->RowType == EWR_ROWTYPE_TOTAL && !($this->RowTotalType == EWR_ROWTOTAL_GROUP && $this->RowTotalSubType == EWR_ROWTOTAL_HEADER)) { // Summary row
			ewr_PrependClass($this->RowAttrs["class"], ($this->RowTotalType == EWR_ROWTOTAL_PAGE || $this->RowTotalType == EWR_ROWTOTAL_GRAND) ? "ewRptGrpAggregate" : ""); // Set up row class
			if ($this->RowTotalType == EWR_ROWTOTAL_GROUP) $this->RowAttrs["data-group"] = $this->MainGroup->GroupOldValue(); // Set up group attribute
			if ($this->RowTotalType == EWR_ROWTOTAL_GROUP && $this->RowGroupLevel >= 2) $this->RowAttrs["data-group-2"] = $this->SubGroup->GroupOldValue(); // Set up group attribute 2

			// MainGroup
			$this->MainGroup->GroupViewValue = $this->MainGroup->GroupOldValue();
			$this->MainGroup->CellAttrs["class"] = ($this->RowGroupLevel == 1) ? "ewRptGrpSummary1" : "ewRptGrpField1";
			$this->MainGroup->GroupViewValue = ewr_DisplayGroupValue($this->MainGroup, $this->MainGroup->GroupViewValue);
			$this->MainGroup->GroupSummaryOldValue = $this->MainGroup->GroupSummaryValue;
			$this->MainGroup->GroupSummaryValue = $this->MainGroup->GroupViewValue;
			$this->MainGroup->GroupSummaryViewValue = ($this->MainGroup->GroupSummaryOldValue <> $this->MainGroup->GroupSummaryValue) ? $this->MainGroup->GroupSummaryValue : "&nbsp;";

			// SubGroup
			$this->SubGroup->GroupViewValue = $this->SubGroup->GroupOldValue();
			$this->SubGroup->CellAttrs["class"] = ($this->RowGroupLevel == 2) ? "ewRptGrpSummary2" : "ewRptGrpField2";
			$this->SubGroup->GroupViewValue = ewr_DisplayGroupValue($this->SubGroup, $this->SubGroup->GroupViewValue);
			$this->SubGroup->GroupSummaryOldValue = $this->SubGroup->GroupSummaryValue;
			$this->SubGroup->GroupSummaryValue = $this->SubGroup->GroupViewValue;
			$this->SubGroup->GroupSummaryViewValue = ($this->SubGroup->GroupSummaryOldValue <> $this->SubGroup->GroupSummaryValue) ? $this->SubGroup->GroupSummaryValue : "&nbsp;";

			// SumQty
			$this->SumQty->SumViewValue = $this->SumQty->SumValue;
			$this->SumQty->SumViewValue = ewr_FormatNumber($this->SumQty->SumViewValue, 2, -2, -2, -2);
			$this->SumQty->CellAttrs["style"] = "text-align:right;";
			$this->SumQty->CellAttrs["class"] = ($this->RowTotalType == EWR_ROWTOTAL_PAGE || $this->RowTotalType == EWR_ROWTOTAL_GRAND) ? "ewRptGrpAggregate" : "ewRptGrpSummary" . $this->RowGroupLevel;

			// SubTotal
			$this->SubTotal->SumViewValue = $this->SubTotal->SumValue;
			$this->SubTotal->SumViewValue = ewr_FormatNumber($this->SubTotal->SumViewValue, 2, -2, -2, -2);
			$this->SubTotal->CellAttrs["style"] = "text-align:right;";
			$this->SubTotal->CellAttrs["class"] = ($this->RowTotalType == EWR_ROWTOTAL_PAGE || $this->RowTotalType == EWR_ROWTOTAL_GRAND) ? "ewRptGrpAggregate" : "ewRptGrpSummary" . $this->RowGroupLevel;

			// MainGroup
			$this->MainGroup->HrefValue = "";

			// SubGroup
			$this->SubGroup->HrefValue = "";

			// Article
			$this->Article->HrefValue = "";

			// SumQty
			$this->SumQty->HrefValue = "";

			// Satuan
			$this->Satuan->HrefValue = "";

			// AvgHarga
			$this->AvgHarga->HrefValue = "";

			// SubTotal
			$this->SubTotal->HrefValue = "";
		} else {
			if ($this->RowTotalType == EWR_ROWTOTAL_GROUP && $this->RowTotalSubType == EWR_ROWTOTAL_HEADER) {
			$this->RowAttrs["data-group"] = $this->MainGroup->GroupValue(); // Set up group attribute
			if ($this->RowGroupLevel >= 2) $this->RowAttrs["data-group-2"] = $this->SubGroup->GroupValue(); // Set up group attribute 2
			} else {
			$this->RowAttrs["data-group"] = $this->MainGroup->GroupValue(); // Set up group attribute
			$this->RowAttrs["data-group-2"] = $this->SubGroup->GroupValue(); // Set up group attribute 2
			}

			// MainGroup
			$this->MainGroup->GroupViewValue = $this->MainGroup->GroupValue();
			$this->MainGroup->CellAttrs["class"] = "ewRptGrpField1";
			$this->MainGroup->GroupViewValue = ewr_DisplayGroupValue($this->MainGroup, $this->MainGroup->GroupViewValue);
			if ($this->MainGroup->GroupValue() == $this->MainGroup->GroupOldValue() && !$this->ChkLvlBreak(1))
				$this->MainGroup->GroupViewValue = "&nbsp;";

			// SubGroup
			$this->SubGroup->GroupViewValue = $this->SubGroup->GroupValue();
			$this->SubGroup->CellAttrs["class"] = "ewRptGrpField2";
			$this->SubGroup->GroupViewValue = ewr_DisplayGroupValue($this->SubGroup, $this->SubGroup->GroupViewValue);
			if ($this->SubGroup->GroupValue() == $this->SubGroup->GroupOldValue() && !$this->ChkLvlBreak(2))
				$this->SubGroup->GroupViewValue = "&nbsp;";

			// Article
			$this->Article->ViewValue = $this->Article->CurrentValue;
			$this->Article->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// SumQty
			$this->SumQty->ViewValue = $this->SumQty->CurrentValue;
			$this->SumQty->ViewValue = ewr_FormatNumber($this->SumQty->ViewValue, 2, -2, -2, -2);
			$this->SumQty->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
			$this->SumQty->CellAttrs["style"] = "text-align:right;";

			// Satuan
			$this->Satuan->ViewValue = $this->Satuan->CurrentValue;
			$this->Satuan->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// AvgHarga
			$this->AvgHarga->ViewValue = $this->AvgHarga->CurrentValue;
			$this->AvgHarga->ViewValue = ewr_FormatNumber($this->AvgHarga->ViewValue, 2, -2, -2, -2);
			$this->AvgHarga->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
			$this->AvgHarga->CellAttrs["style"] = "text-align:right;";

			// SubTotal
			$this->SubTotal->ViewValue = $this->SubTotal->CurrentValue;
			$this->SubTotal->ViewValue = ewr_FormatNumber($this->SubTotal->ViewValue, 2, -2, -2, -2);
			$this->SubTotal->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
			$this->SubTotal->CellAttrs["style"] = "text-align:right;";

			// MainGroup
			$this->MainGroup->HrefValue = "";

			// SubGroup
			$this->SubGroup->HrefValue = "";

			// Article
			$this->Article->HrefValue = "";

			// SumQty
			$this->SumQty->HrefValue = "";

			// Satuan
			$this->Satuan->HrefValue = "";

			// AvgHarga
			$this->AvgHarga->HrefValue = "";

			// SubTotal
			$this->SubTotal->HrefValue = "";
		}

		// Call Cell_Rendered event
		if ($this->RowType == EWR_ROWTYPE_TOTAL) { // Summary row

			// MainGroup
			$CurrentValue = $this->MainGroup->GroupViewValue;
			$ViewValue = &$this->MainGroup->GroupViewValue;
			$ViewAttrs = &$this->MainGroup->ViewAttrs;
			$CellAttrs = &$this->MainGroup->CellAttrs;
			$HrefValue = &$this->MainGroup->HrefValue;
			$LinkAttrs = &$this->MainGroup->LinkAttrs;
			$this->Cell_Rendered($this->MainGroup, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// SubGroup
			$CurrentValue = $this->SubGroup->GroupViewValue;
			$ViewValue = &$this->SubGroup->GroupViewValue;
			$ViewAttrs = &$this->SubGroup->ViewAttrs;
			$CellAttrs = &$this->SubGroup->CellAttrs;
			$HrefValue = &$this->SubGroup->HrefValue;
			$LinkAttrs = &$this->SubGroup->LinkAttrs;
			$this->Cell_Rendered($this->SubGroup, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// SumQty
			$CurrentValue = $this->SumQty->SumValue;
			$ViewValue = &$this->SumQty->SumViewValue;
			$ViewAttrs = &$this->SumQty->ViewAttrs;
			$CellAttrs = &$this->SumQty->CellAttrs;
			$HrefValue = &$this->SumQty->HrefValue;
			$LinkAttrs = &$this->SumQty->LinkAttrs;
			$this->Cell_Rendered($this->SumQty, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// SubTotal
			$CurrentValue = $this->SubTotal->SumValue;
			$ViewValue = &$this->SubTotal->SumViewValue;
			$ViewAttrs = &$this->SubTotal->ViewAttrs;
			$CellAttrs = &$this->SubTotal->CellAttrs;
			$HrefValue = &$this->SubTotal->HrefValue;
			$LinkAttrs = &$this->SubTotal->LinkAttrs;
			$this->Cell_Rendered($this->SubTotal, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);
		} else {

			// MainGroup
			$CurrentValue = $this->MainGroup->GroupValue();
			$ViewValue = &$this->MainGroup->GroupViewValue;
			$ViewAttrs = &$this->MainGroup->ViewAttrs;
			$CellAttrs = &$this->MainGroup->CellAttrs;
			$HrefValue = &$this->MainGroup->HrefValue;
			$LinkAttrs = &$this->MainGroup->LinkAttrs;
			$this->Cell_Rendered($this->MainGroup, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// SubGroup
			$CurrentValue = $this->SubGroup->GroupValue();
			$ViewValue = &$this->SubGroup->GroupViewValue;
			$ViewAttrs = &$this->SubGroup->ViewAttrs;
			$CellAttrs = &$this->SubGroup->CellAttrs;
			$HrefValue = &$this->SubGroup->HrefValue;
			$LinkAttrs = &$this->SubGroup->LinkAttrs;
			$this->Cell_Rendered($this->SubGroup, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// Article
			$CurrentValue = $this->Article->CurrentValue;
			$ViewValue = &$this->Article->ViewValue;
			$ViewAttrs = &$this->Article->ViewAttrs;
			$CellAttrs = &$this->Article->CellAttrs;
			$HrefValue = &$this->Article->HrefValue;
			$LinkAttrs = &$this->Article->LinkAttrs;
			$this->Cell_Rendered($this->Article, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// SumQty
			$CurrentValue = $this->SumQty->CurrentValue;
			$ViewValue = &$this->SumQty->ViewValue;
			$ViewAttrs = &$this->SumQty->ViewAttrs;
			$CellAttrs = &$this->SumQty->CellAttrs;
			$HrefValue = &$this->SumQty->HrefValue;
			$LinkAttrs = &$this->SumQty->LinkAttrs;
			$this->Cell_Rendered($this->SumQty, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// Satuan
			$CurrentValue = $this->Satuan->CurrentValue;
			$ViewValue = &$this->Satuan->ViewValue;
			$ViewAttrs = &$this->Satuan->ViewAttrs;
			$CellAttrs = &$this->Satuan->CellAttrs;
			$HrefValue = &$this->Satuan->HrefValue;
			$LinkAttrs = &$this->Satuan->LinkAttrs;
			$this->Cell_Rendered($this->Satuan, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// AvgHarga
			$CurrentValue = $this->AvgHarga->CurrentValue;
			$ViewValue = &$this->AvgHarga->ViewValue;
			$ViewAttrs = &$this->AvgHarga->ViewAttrs;
			$CellAttrs = &$this->AvgHarga->CellAttrs;
			$HrefValue = &$this->AvgHarga->HrefValue;
			$LinkAttrs = &$this->AvgHarga->LinkAttrs;
			$this->Cell_Rendered($this->AvgHarga, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// SubTotal
			$CurrentValue = $this->SubTotal->CurrentValue;
			$ViewValue = &$this->SubTotal->ViewValue;
			$ViewAttrs = &$this->SubTotal->ViewAttrs;
			$CellAttrs = &$this->SubTotal->CellAttrs;
			$HrefValue = &$this->SubTotal->HrefValue;
			$LinkAttrs = &$this->SubTotal->LinkAttrs;
			$this->Cell_Rendered($this->SubTotal, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);
		}

		// Call Row_Rendered event
		$this->Row_Rendered();
		$this->SetupFieldCount();
	}

	// Setup field count
	function SetupFieldCount() {
		$this->GrpColumnCount = 0;
		$this->SubGrpColumnCount = 0;
		$this->DtlColumnCount = 0;
		if ($this->MainGroup->Visible) $this->GrpColumnCount += 1;
		if ($this->SubGroup->Visible) { $this->GrpColumnCount += 1; $this->SubGrpColumnCount += 1; }
		if ($this->Article->Visible) $this->DtlColumnCount += 1;
		if ($this->SumQty->Visible) $this->DtlColumnCount += 1;
		if ($this->Satuan->Visible) $this->DtlColumnCount += 1;
		if ($this->AvgHarga->Visible) $this->DtlColumnCount += 1;
		if ($this->SubTotal->Visible) $this->DtlColumnCount += 1;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $ReportBreadcrumb;
		$ReportBreadcrumb = new crBreadcrumb();
		$url = substr(ewr_CurrentUrl(), strrpos(ewr_CurrentUrl(), "/")+1);
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$ReportBreadcrumb->Add("summary", $this->TableVar, $url, "", $this->TableVar, TRUE);
	}

	function SetupExportOptionsExt() {
		global $ReportLanguage, $ReportOptions;
		$ReportTypes = $ReportOptions["ReportTypes"];
		$item =& $this->ExportOptions->GetItem("pdf");
		$item->Visible = TRUE;
		if ($item->Visible)
			$ReportTypes["pdf"] = $ReportLanguage->Phrase("ReportFormPdf");
		$exportid = session_id();
		$url = $this->ExportPdfUrl;
		$item->Body = "<a class=\"ewrExportLink ewPdf\" title=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ExportToPDF", TRUE)) . "\" data-caption=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ExportToPDF", TRUE)) . "\" href=\"javascript:void(0);\" onclick=\"ewr_ExportCharts(this, '" . $url . "', '" . $exportid . "');\">" . $ReportLanguage->Phrase("ExportToPDF") . "</a>";
		$ReportOptions["ReportTypes"] = $ReportTypes;
	}

	// Return extended filter
	function GetExtendedFilter() {
		global $grFormError;
		$sFilter = "";
		if ($this->DrillDown)
			return "";
		$bPostBack = ewr_IsHttpPost();
		$bRestoreSession = TRUE;
		$bSetupFilter = FALSE;

		// Reset extended filter if filter changed
		if ($bPostBack) {

		// Reset search command
		} elseif (@$_GET["cmd"] == "reset") {

			// Load default values
			$this->SetSessionDropDownValue($this->MainGroup->DropDownValue, $this->MainGroup->SearchOperator, 'MainGroup'); // Field MainGroup
			$this->SetSessionDropDownValue($this->SubGroup->DropDownValue, $this->SubGroup->SearchOperator, 'SubGroup'); // Field SubGroup
			$this->SetSessionDropDownValue($this->Article->DropDownValue, $this->Article->SearchOperator, 'Article'); // Field Article

			//$bSetupFilter = TRUE; // No need to set up, just use default
		} else {
			$bRestoreSession = !$this->SearchCommand;

			// Field MainGroup
			if ($this->GetDropDownValue($this->MainGroup)) {
				$bSetupFilter = TRUE;
			} elseif ($this->MainGroup->DropDownValue <> EWR_INIT_VALUE && !isset($_SESSION['sv_r02_stok_MainGroup'])) {
				$bSetupFilter = TRUE;
			}

			// Field SubGroup
			if ($this->GetDropDownValue($this->SubGroup)) {
				$bSetupFilter = TRUE;
			} elseif ($this->SubGroup->DropDownValue <> EWR_INIT_VALUE && !isset($_SESSION['sv_r02_stok_SubGroup'])) {
				$bSetupFilter = TRUE;
			}

			// Field Article
			if ($this->GetDropDownValue($this->Article)) {
				$bSetupFilter = TRUE;
			} elseif ($this->Article->DropDownValue <> EWR_INIT_VALUE && !isset($_SESSION['sv_r02_stok_Article'])) {
				$bSetupFilter = TRUE;
			}
			if (!$this->ValidateForm()) {
				$this->setFailureMessage($grFormError);
				return $sFilter;
			}
		}

		// Restore session
		if ($bRestoreSession) {
			$this->GetSessionDropDownValue($this->MainGroup); // Field MainGroup
			$this->GetSessionDropDownValue($this->SubGroup); // Field SubGroup
			$this->GetSessionDropDownValue($this->Article); // Field Article
		}

		// Call page filter validated event
		$this->Page_FilterValidated();

		// Build SQL
		$this->BuildDropDownFilter($this->MainGroup, $sFilter, $this->MainGroup->SearchOperator, FALSE, TRUE); // Field MainGroup
		$this->BuildDropDownFilter($this->SubGroup, $sFilter, $this->SubGroup->SearchOperator, FALSE, TRUE); // Field SubGroup
		$this->BuildDropDownFilter($this->Article, $sFilter, $this->Article->SearchOperator, FALSE, TRUE); // Field Article

		// Save parms to session
		$this->SetSessionDropDownValue($this->MainGroup->DropDownValue, $this->MainGroup->SearchOperator, 'MainGroup'); // Field MainGroup
		$this->SetSessionDropDownValue($this->SubGroup->DropDownValue, $this->SubGroup->SearchOperator, 'SubGroup'); // Field SubGroup
		$this->SetSessionDropDownValue($this->Article->DropDownValue, $this->Article->SearchOperator, 'Article'); // Field Article

		// Setup filter
		if ($bSetupFilter) {
		}

		// Field MainGroup
		ewr_LoadDropDownList($this->MainGroup->DropDownList, $this->MainGroup->DropDownValue);

		// Field SubGroup
		ewr_LoadDropDownList($this->SubGroup->DropDownList, $this->SubGroup->DropDownValue);

		// Field Article
		ewr_LoadDropDownList($this->Article->DropDownList, $this->Article->DropDownValue);
		return $sFilter;
	}

	// Build dropdown filter
	function BuildDropDownFilter(&$fld, &$FilterClause, $FldOpr, $Default = FALSE, $SaveFilter = FALSE) {
		$FldVal = ($Default) ? $fld->DefaultDropDownValue : $fld->DropDownValue;
		$sSql = "";
		if (is_array($FldVal)) {
			foreach ($FldVal as $val) {
				$sWrk = $this->GetDropDownFilter($fld, $val, $FldOpr);

				// Call Page Filtering event
				if (substr($val, 0, 2) <> "@@")
					$this->Page_Filtering($fld, $sWrk, "dropdown", $FldOpr, $val);
				if ($sWrk <> "") {
					if ($sSql <> "")
						$sSql .= " OR " . $sWrk;
					else
						$sSql = $sWrk;
				}
			}
		} else {
			$sSql = $this->GetDropDownFilter($fld, $FldVal, $FldOpr);

			// Call Page Filtering event
			if (substr($FldVal, 0, 2) <> "@@")
				$this->Page_Filtering($fld, $sSql, "dropdown", $FldOpr, $FldVal);
		}
		if ($sSql <> "") {
			ewr_AddFilter($FilterClause, $sSql);
			if ($SaveFilter) $fld->CurrentFilter = $sSql;
		}
	}

	function GetDropDownFilter(&$fld, $FldVal, $FldOpr) {
		$FldName = $fld->FldName;
		$FldExpression = $fld->FldExpression;
		$FldDataType = $fld->FldDataType;
		$FldDelimiter = $fld->FldDelimiter;
		$FldVal = strval($FldVal);
		if ($FldOpr == "") $FldOpr = "=";
		$sWrk = "";
		if (ewr_SameStr($FldVal, EWR_NULL_VALUE)) {
			$sWrk = $FldExpression . " IS NULL";
		} elseif (ewr_SameStr($FldVal, EWR_NOT_NULL_VALUE)) {
			$sWrk = $FldExpression . " IS NOT NULL";
		} elseif (ewr_SameStr($FldVal, EWR_EMPTY_VALUE)) {
			$sWrk = $FldExpression . " = ''";
		} elseif (ewr_SameStr($FldVal, EWR_ALL_VALUE)) {
			$sWrk = "1 = 1";
		} else {
			if (substr($FldVal, 0, 2) == "@@") {
				$sWrk = $this->GetCustomFilter($fld, $FldVal, $this->DBID);
			} elseif ($FldDelimiter <> "" && trim($FldVal) <> "" && ($FldDataType == EWR_DATATYPE_STRING || $FldDataType == EWR_DATATYPE_MEMO)) {
				$sWrk = ewr_GetMultiSearchSql($FldExpression, trim($FldVal), $this->DBID);
			} else {
				if ($FldVal <> "" && $FldVal <> EWR_INIT_VALUE) {
					if ($FldDataType == EWR_DATATYPE_DATE && $FldOpr <> "") {
						$sWrk = ewr_DateFilterString($FldExpression, $FldOpr, $FldVal, $FldDataType, $this->DBID);
					} else {
						$sWrk = ewr_FilterString($FldOpr, $FldVal, $FldDataType, $this->DBID);
						if ($sWrk <> "") $sWrk = $FldExpression . $sWrk;
					}
				}
			}
		}
		return $sWrk;
	}

	// Get custom filter
	function GetCustomFilter(&$fld, $FldVal, $dbid = 0) {
		$sWrk = "";
		if (is_array($fld->AdvancedFilters)) {
			foreach ($fld->AdvancedFilters as $filter) {
				if ($filter->ID == $FldVal && $filter->Enabled) {
					$sFld = $fld->FldExpression;
					$sFn = $filter->FunctionName;
					$wrkid = (substr($filter->ID, 0, 2) == "@@") ? substr($filter->ID,2) : $filter->ID;
					if ($sFn <> "")
						$sWrk = $sFn($sFld, $dbid);
					else
						$sWrk = "";
					$this->Page_Filtering($fld, $sWrk, "custom", $wrkid);
					break;
				}
			}
		}
		return $sWrk;
	}

	// Build extended filter
	function BuildExtendedFilter(&$fld, &$FilterClause, $Default = FALSE, $SaveFilter = FALSE) {
		$sWrk = ewr_GetExtendedFilter($fld, $Default, $this->DBID);
		if (!$Default)
			$this->Page_Filtering($fld, $sWrk, "extended", $fld->SearchOperator, $fld->SearchValue, $fld->SearchCondition, $fld->SearchOperator2, $fld->SearchValue2);
		if ($sWrk <> "") {
			ewr_AddFilter($FilterClause, $sWrk);
			if ($SaveFilter) $fld->CurrentFilter = $sWrk;
		}
	}

	// Get drop down value from querystring
	function GetDropDownValue(&$fld) {
		$parm = substr($fld->FldVar, 2);
		if (ewr_IsHttpPost())
			return FALSE; // Skip post back
		if (isset($_GET["so_$parm"]))
			$fld->SearchOperator = @$_GET["so_$parm"];
		if (isset($_GET["sv_$parm"])) {
			$fld->DropDownValue = @$_GET["sv_$parm"];
			return TRUE;
		}
		return FALSE;
	}

	// Get filter values from querystring
	function GetFilterValues(&$fld) {
		$parm = substr($fld->FldVar, 2);
		if (ewr_IsHttpPost())
			return; // Skip post back
		$got = FALSE;
		if (isset($_GET["sv_$parm"])) {
			$fld->SearchValue = @$_GET["sv_$parm"];
			$got = TRUE;
		}
		if (isset($_GET["so_$parm"])) {
			$fld->SearchOperator = @$_GET["so_$parm"];
			$got = TRUE;
		}
		if (isset($_GET["sc_$parm"])) {
			$fld->SearchCondition = @$_GET["sc_$parm"];
			$got = TRUE;
		}
		if (isset($_GET["sv2_$parm"])) {
			$fld->SearchValue2 = @$_GET["sv2_$parm"];
			$got = TRUE;
		}
		if (isset($_GET["so2_$parm"])) {
			$fld->SearchOperator2 = $_GET["so2_$parm"];
			$got = TRUE;
		}
		return $got;
	}

	// Set default ext filter
	function SetDefaultExtFilter(&$fld, $so1, $sv1, $sc, $so2, $sv2) {
		$fld->DefaultSearchValue = $sv1; // Default ext filter value 1
		$fld->DefaultSearchValue2 = $sv2; // Default ext filter value 2 (if operator 2 is enabled)
		$fld->DefaultSearchOperator = $so1; // Default search operator 1
		$fld->DefaultSearchOperator2 = $so2; // Default search operator 2 (if operator 2 is enabled)
		$fld->DefaultSearchCondition = $sc; // Default search condition (if operator 2 is enabled)
	}

	// Apply default ext filter
	function ApplyDefaultExtFilter(&$fld) {
		$fld->SearchValue = $fld->DefaultSearchValue;
		$fld->SearchValue2 = $fld->DefaultSearchValue2;
		$fld->SearchOperator = $fld->DefaultSearchOperator;
		$fld->SearchOperator2 = $fld->DefaultSearchOperator2;
		$fld->SearchCondition = $fld->DefaultSearchCondition;
	}

	// Check if Text Filter applied
	function TextFilterApplied(&$fld) {
		return (strval($fld->SearchValue) <> strval($fld->DefaultSearchValue) ||
			strval($fld->SearchValue2) <> strval($fld->DefaultSearchValue2) ||
			(strval($fld->SearchValue) <> "" &&
				strval($fld->SearchOperator) <> strval($fld->DefaultSearchOperator)) ||
			(strval($fld->SearchValue2) <> "" &&
				strval($fld->SearchOperator2) <> strval($fld->DefaultSearchOperator2)) ||
			strval($fld->SearchCondition) <> strval($fld->DefaultSearchCondition));
	}

	// Check if Non-Text Filter applied
	function NonTextFilterApplied(&$fld) {
		if (is_array($fld->DropDownValue)) {
			if (is_array($fld->DefaultDropDownValue)) {
				if (count($fld->DefaultDropDownValue) <> count($fld->DropDownValue))
					return TRUE;
				else
					return (count(array_diff($fld->DefaultDropDownValue, $fld->DropDownValue)) <> 0);
			} else {
				return TRUE;
			}
		} else {
			if (is_array($fld->DefaultDropDownValue))
				return TRUE;
			else
				$v1 = strval($fld->DefaultDropDownValue);
			if ($v1 == EWR_INIT_VALUE)
				$v1 = "";
			$v2 = strval($fld->DropDownValue);
			if ($v2 == EWR_INIT_VALUE || $v2 == EWR_ALL_VALUE)
				$v2 = "";
			return ($v1 <> $v2);
		}
	}

	// Get dropdown value from session
	function GetSessionDropDownValue(&$fld) {
		$parm = substr($fld->FldVar, 2);
		$this->GetSessionValue($fld->DropDownValue, 'sv_r02_stok_' . $parm);
		$this->GetSessionValue($fld->SearchOperator, 'so_r02_stok_' . $parm);
	}

	// Get filter values from session
	function GetSessionFilterValues(&$fld) {
		$parm = substr($fld->FldVar, 2);
		$this->GetSessionValue($fld->SearchValue, 'sv_r02_stok_' . $parm);
		$this->GetSessionValue($fld->SearchOperator, 'so_r02_stok_' . $parm);
		$this->GetSessionValue($fld->SearchCondition, 'sc_r02_stok_' . $parm);
		$this->GetSessionValue($fld->SearchValue2, 'sv2_r02_stok_' . $parm);
		$this->GetSessionValue($fld->SearchOperator2, 'so2_r02_stok_' . $parm);
	}

	// Get value from session
	function GetSessionValue(&$sv, $sn) {
		if (array_key_exists($sn, $_SESSION))
			$sv = $_SESSION[$sn];
	}

	// Set dropdown value to session
	function SetSessionDropDownValue($sv, $so, $parm) {
		$_SESSION['sv_r02_stok_' . $parm] = $sv;
		$_SESSION['so_r02_stok_' . $parm] = $so;
	}

	// Set filter values to session
	function SetSessionFilterValues($sv1, $so1, $sc, $sv2, $so2, $parm) {
		$_SESSION['sv_r02_stok_' . $parm] = $sv1;
		$_SESSION['so_r02_stok_' . $parm] = $so1;
		$_SESSION['sc_r02_stok_' . $parm] = $sc;
		$_SESSION['sv2_r02_stok_' . $parm] = $sv2;
		$_SESSION['so2_r02_stok_' . $parm] = $so2;
	}

	// Check if has Session filter values
	function HasSessionFilterValues($parm) {
		return ((@$_SESSION['sv_' . $parm] <> "" && @$_SESSION['sv_' . $parm] <> EWR_INIT_VALUE) ||
			(@$_SESSION['sv_' . $parm] <> "" && @$_SESSION['sv_' . $parm] <> EWR_INIT_VALUE) ||
			(@$_SESSION['sv2_' . $parm] <> "" && @$_SESSION['sv2_' . $parm] <> EWR_INIT_VALUE));
	}

	// Dropdown filter exist
	function DropDownFilterExist(&$fld, $FldOpr) {
		$sWrk = "";
		$this->BuildDropDownFilter($fld, $sWrk, $FldOpr);
		return ($sWrk <> "");
	}

	// Extended filter exist
	function ExtendedFilterExist(&$fld) {
		$sExtWrk = "";
		$this->BuildExtendedFilter($fld, $sExtWrk);
		return ($sExtWrk <> "");
	}

	// Validate form
	function ValidateForm() {
		global $ReportLanguage, $grFormError;

		// Initialize form error message
		$grFormError = "";

		// Check if validation required
		if (!EWR_SERVER_VALIDATE)
			return ($grFormError == "");

		// Return validate result
		$ValidateForm = ($grFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			$grFormError .= ($grFormError <> "") ? "<p>&nbsp;</p>" : "";
			$grFormError .= $sFormCustomError;
		}
		return $ValidateForm;
	}

	// Clear selection stored in session
	function ClearSessionSelection($parm) {
		$_SESSION["sel_r02_stok_$parm"] = "";
		$_SESSION["rf_r02_stok_$parm"] = "";
		$_SESSION["rt_r02_stok_$parm"] = "";
	}

	// Load selection from session
	function LoadSelectionFromSession($parm) {
		$fld = &$this->FieldByParm($parm);
		$fld->SelectionList = @$_SESSION["sel_r02_stok_$parm"];
		$fld->RangeFrom = @$_SESSION["rf_r02_stok_$parm"];
		$fld->RangeTo = @$_SESSION["rt_r02_stok_$parm"];
	}

	// Load default value for filters
	function LoadDefaultFilters() {
		/**
		* Set up default values for non Text filters
		*/

		// Field MainGroup
		$this->MainGroup->DefaultDropDownValue = EWR_INIT_VALUE;
		if (!$this->SearchCommand) $this->MainGroup->DropDownValue = $this->MainGroup->DefaultDropDownValue;

		// Field SubGroup
		$this->SubGroup->DefaultDropDownValue = EWR_INIT_VALUE;
		if (!$this->SearchCommand) $this->SubGroup->DropDownValue = $this->SubGroup->DefaultDropDownValue;

		// Field Article
		$this->Article->DefaultDropDownValue = EWR_INIT_VALUE;
		if (!$this->SearchCommand) $this->Article->DropDownValue = $this->Article->DefaultDropDownValue;
		/**
		* Set up default values for extended filters
		* function SetDefaultExtFilter(&$fld, $so1, $sv1, $sc, $so2, $sv2)
		* Parameters:
		* $fld - Field object
		* $so1 - Default search operator 1
		* $sv1 - Default ext filter value 1
		* $sc - Default search condition (if operator 2 is enabled)
		* $so2 - Default search operator 2 (if operator 2 is enabled)
		* $sv2 - Default ext filter value 2 (if operator 2 is enabled)
		*/
		/**
		* Set up default values for popup filters
		*/
	}

	// Check if filter applied
	function CheckFilter() {

		// Check MainGroup extended filter
		if ($this->NonTextFilterApplied($this->MainGroup))
			return TRUE;

		// Check SubGroup extended filter
		if ($this->NonTextFilterApplied($this->SubGroup))
			return TRUE;

		// Check Article extended filter
		if ($this->NonTextFilterApplied($this->Article))
			return TRUE;
		return FALSE;
	}

	// Show list of filters
	function ShowFilterList($showDate = FALSE) {
		global $ReportLanguage;

		// Initialize
		$sFilterList = "";

		// Field MainGroup
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildDropDownFilter($this->MainGroup, $sExtWrk, $this->MainGroup->SearchOperator);
		$sFilter = "";
		if ($sExtWrk <> "")
			$sFilter .= "<span class=\"ewFilterValue\">$sExtWrk</span>";
		elseif ($sWrk <> "")
			$sFilter .= "<span class=\"ewFilterValue\">$sWrk</span>";
		if ($sFilter <> "")
			$sFilterList .= "<div><span class=\"ewFilterCaption\">" . $this->MainGroup->FldCaption() . "</span>" . $sFilter . "</div>";

		// Field SubGroup
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildDropDownFilter($this->SubGroup, $sExtWrk, $this->SubGroup->SearchOperator);
		$sFilter = "";
		if ($sExtWrk <> "")
			$sFilter .= "<span class=\"ewFilterValue\">$sExtWrk</span>";
		elseif ($sWrk <> "")
			$sFilter .= "<span class=\"ewFilterValue\">$sWrk</span>";
		if ($sFilter <> "")
			$sFilterList .= "<div><span class=\"ewFilterCaption\">" . $this->SubGroup->FldCaption() . "</span>" . $sFilter . "</div>";

		// Field Article
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildDropDownFilter($this->Article, $sExtWrk, $this->Article->SearchOperator);
		$sFilter = "";
		if ($sExtWrk <> "")
			$sFilter .= "<span class=\"ewFilterValue\">$sExtWrk</span>";
		elseif ($sWrk <> "")
			$sFilter .= "<span class=\"ewFilterValue\">$sWrk</span>";
		if ($sFilter <> "")
			$sFilterList .= "<div><span class=\"ewFilterCaption\">" . $this->Article->FldCaption() . "</span>" . $sFilter . "</div>";
		$divstyle = "";
		$divdataclass = "";

		// Show Filters
		if ($sFilterList <> "" || $showDate) {
			$sMessage = "<div" . $divstyle . $divdataclass . "><div id=\"ewrFilterList\" class=\"alert alert-info\">";
			if ($showDate)
				$sMessage .= "<div id=\"ewrCurrentDate\">" . $ReportLanguage->Phrase("ReportGeneratedDate") . ewr_FormatDateTime(date("Y-m-d H:i:s"), 1) . "</div>";
			if ($sFilterList <> "")
				$sMessage .= "<div id=\"ewrCurrentFilters\">" . $ReportLanguage->Phrase("CurrentFilters") . "</div>" . $sFilterList;
			$sMessage .= "</div></div>";
			$this->Message_Showing($sMessage, "");
			echo $sMessage;
		}
	}

	// Get list of filters
	function GetFilterList() {

		// Initialize
		$sFilterList = "";

		// Field MainGroup
		$sWrk = "";
		$sWrk = ($this->MainGroup->DropDownValue <> EWR_INIT_VALUE) ? $this->MainGroup->DropDownValue : "";
		if (is_array($sWrk))
			$sWrk = implode("||", $sWrk);
		if ($sWrk <> "")
			$sWrk = "\"sv_MainGroup\":\"" . ewr_JsEncode2($sWrk) . "\"";
		if ($sWrk <> "") {
			if ($sFilterList <> "") $sFilterList .= ",";
			$sFilterList .= $sWrk;
		}

		// Field SubGroup
		$sWrk = "";
		$sWrk = ($this->SubGroup->DropDownValue <> EWR_INIT_VALUE) ? $this->SubGroup->DropDownValue : "";
		if (is_array($sWrk))
			$sWrk = implode("||", $sWrk);
		if ($sWrk <> "")
			$sWrk = "\"sv_SubGroup\":\"" . ewr_JsEncode2($sWrk) . "\"";
		if ($sWrk <> "") {
			if ($sFilterList <> "") $sFilterList .= ",";
			$sFilterList .= $sWrk;
		}

		// Field Article
		$sWrk = "";
		$sWrk = ($this->Article->DropDownValue <> EWR_INIT_VALUE) ? $this->Article->DropDownValue : "";
		if (is_array($sWrk))
			$sWrk = implode("||", $sWrk);
		if ($sWrk <> "")
			$sWrk = "\"sv_Article\":\"" . ewr_JsEncode2($sWrk) . "\"";
		if ($sWrk <> "") {
			if ($sFilterList <> "") $sFilterList .= ",";
			$sFilterList .= $sWrk;
		}

		// Return filter list in json
		if ($sFilterList <> "")
			return "{" . $sFilterList . "}";
		else
			return "null";
	}

	// Restore list of filters
	function RestoreFilterList() {

		// Return if not reset filter
		if (@$_POST["cmd"] <> "resetfilter")
			return FALSE;
		$filter = json_decode(@$_POST["filter"], TRUE);
		return $this->SetupFilterList($filter);
	}

	// Setup list of filters
	function SetupFilterList($filter) {
		if (!is_array($filter))
			return FALSE;

		// Field MainGroup
		$bRestoreFilter = FALSE;
		if (array_key_exists("sv_MainGroup", $filter)) {
			$sWrk = $filter["sv_MainGroup"];
			if (strpos($sWrk, "||") !== FALSE)
				$sWrk = explode("||", $sWrk);
			$this->SetSessionDropDownValue($sWrk, @$filter["so_MainGroup"], "MainGroup");
			$bRestoreFilter = TRUE;
		}
		if (!$bRestoreFilter) { // Clear filter
			$this->SetSessionDropDownValue(EWR_INIT_VALUE, "", "MainGroup");
		}

		// Field SubGroup
		$bRestoreFilter = FALSE;
		if (array_key_exists("sv_SubGroup", $filter)) {
			$sWrk = $filter["sv_SubGroup"];
			if (strpos($sWrk, "||") !== FALSE)
				$sWrk = explode("||", $sWrk);
			$this->SetSessionDropDownValue($sWrk, @$filter["so_SubGroup"], "SubGroup");
			$bRestoreFilter = TRUE;
		}
		if (!$bRestoreFilter) { // Clear filter
			$this->SetSessionDropDownValue(EWR_INIT_VALUE, "", "SubGroup");
		}

		// Field Article
		$bRestoreFilter = FALSE;
		if (array_key_exists("sv_Article", $filter)) {
			$sWrk = $filter["sv_Article"];
			if (strpos($sWrk, "||") !== FALSE)
				$sWrk = explode("||", $sWrk);
			$this->SetSessionDropDownValue($sWrk, @$filter["so_Article"], "Article");
			$bRestoreFilter = TRUE;
		}
		if (!$bRestoreFilter) { // Clear filter
			$this->SetSessionDropDownValue(EWR_INIT_VALUE, "", "Article");
		}
		return TRUE;
	}

	// Return popup filter
	function GetPopupFilter() {
		$sWrk = "";
		if ($this->DrillDown)
			return "";
		return $sWrk;
	}

	// Get sort parameters based on sort links clicked
	function GetSort($options = array()) {
		if ($this->DrillDown)
			return "";
		$bResetSort = @$options["resetsort"] == "1" || @$_GET["cmd"] == "resetsort";
		$orderBy = (@$options["order"] <> "") ? @$options["order"] : @$_GET["order"];
		$orderType = (@$options["ordertype"] <> "") ? @$options["ordertype"] : @$_GET["ordertype"];

		// Check for Ctrl pressed
		$bCtrl = (@$_GET["ctrl"] <> "");

		// Check for a resetsort command
		if ($bResetSort) {
			$this->setOrderBy("");
			$this->setStartGroup(1);
			$this->MainGroup->setSort("");
			$this->SubGroup->setSort("");
			$this->Article->setSort("");
			$this->SumQty->setSort("");
			$this->Satuan->setSort("");
			$this->AvgHarga->setSort("");
			$this->SubTotal->setSort("");

		// Check for an Order parameter
		} elseif ($orderBy <> "") {
			$this->CurrentOrder = $orderBy;
			$this->CurrentOrderType = $orderType;
			$this->UpdateSort($this->MainGroup, $bCtrl); // MainGroup
			$this->UpdateSort($this->SubGroup, $bCtrl); // SubGroup
			$this->UpdateSort($this->Article, $bCtrl); // Article
			$this->UpdateSort($this->SumQty, $bCtrl); // SumQty
			$this->UpdateSort($this->Satuan, $bCtrl); // Satuan
			$this->UpdateSort($this->AvgHarga, $bCtrl); // AvgHarga
			$this->UpdateSort($this->SubTotal, $bCtrl); // SubTotal
			$sSortSql = $this->SortSql();
			$this->setOrderBy($sSortSql);
			$this->setStartGroup(1);
		}
		return $this->getOrderBy();
	}

	// Export email
	function ExportEmail($EmailContent, $options = array()) {
		global $grTmpImages, $ReportLanguage;
		$bGenRequest = @$options["reporttype"] == "email";
		$sFailRespPfx = $bGenRequest ? "" : "<p class=\"text-error\">";
		$sSuccessRespPfx = $bGenRequest ? "" : "<p class=\"text-success\">";
		$sRespPfx = $bGenRequest ? "" : "</p>";
		$sContentType = (@$options["contenttype"] <> "") ? $options["contenttype"] : @$_POST["contenttype"];
		$sSender = (@$options["sender"] <> "") ? $options["sender"] : @$_POST["sender"];
		$sRecipient = (@$options["recipient"] <> "") ? $options["recipient"] : @$_POST["recipient"];
		$sCc = (@$options["cc"] <> "") ? $options["cc"] : @$_POST["cc"];
		$sBcc = (@$options["bcc"] <> "") ? $options["bcc"] : @$_POST["bcc"];

		// Subject
		$sEmailSubject = (@$options["subject"] <> "") ? $options["subject"] : @$_POST["subject"];

		// Message
		$sEmailMessage = (@$options["message"] <> "") ? $options["message"] : @$_POST["message"];

		// Check sender
		if ($sSender == "")
			return $sFailRespPfx . $ReportLanguage->Phrase("EnterSenderEmail") . $sRespPfx;
		if (!ewr_CheckEmail($sSender))
			return $sFailRespPfx . $ReportLanguage->Phrase("EnterProperSenderEmail") . $sRespPfx;

		// Check recipient
		if (!ewr_CheckEmailList($sRecipient, EWR_MAX_EMAIL_RECIPIENT))
			return $sFailRespPfx . $ReportLanguage->Phrase("EnterProperRecipientEmail") . $sRespPfx;

		// Check cc
		if (!ewr_CheckEmailList($sCc, EWR_MAX_EMAIL_RECIPIENT))
			return $sFailRespPfx . $ReportLanguage->Phrase("EnterProperCcEmail") . $sRespPfx;

		// Check bcc
		if (!ewr_CheckEmailList($sBcc, EWR_MAX_EMAIL_RECIPIENT))
			return $sFailRespPfx . $ReportLanguage->Phrase("EnterProperBccEmail") . $sRespPfx;

		// Check email sent count
		$emailcount = $bGenRequest ? 0 : ewr_LoadEmailCount();
		if (intval($emailcount) >= EWR_MAX_EMAIL_SENT_COUNT)
			return $sFailRespPfx . $ReportLanguage->Phrase("ExceedMaxEmailExport") . $sRespPfx;
		if ($sEmailMessage <> "") {
			if (EWR_REMOVE_XSS) $sEmailMessage = ewr_RemoveXSS($sEmailMessage);
			$sEmailMessage .= ($sContentType == "url") ? "\r\n\r\n" : "<br><br>";
		}
		$sAttachmentContent = ewr_AdjustEmailContent($EmailContent);
		$sAppPath = ewr_FullUrl();
		$sAppPath = substr($sAppPath, 0, strrpos($sAppPath, "/")+1);
		if (strpos($sAttachmentContent, "<head>") !== FALSE)
			$sAttachmentContent = str_replace("<head>", "<head><base href=\"" . $sAppPath . "\">", $sAttachmentContent); // Add <base href> statement inside the header
		else
			$sAttachmentContent = "<base href=\"" . $sAppPath . "\">" . $sAttachmentContent; // Add <base href> statement as the first statement

		//$sAttachmentFile = $this->TableVar . "_" . Date("YmdHis") . ".html";
		$sAttachmentFile = $this->TableVar . "_" . Date("YmdHis") . "_" . ewr_Random() . ".html";
		if ($sContentType == "url") {
			ewr_SaveFile(EWR_UPLOAD_DEST_PATH, $sAttachmentFile, $sAttachmentContent);
			$sAttachmentFile = EWR_UPLOAD_DEST_PATH . $sAttachmentFile;
			$sUrl = $sAppPath . $sAttachmentFile;
			$sEmailMessage .= $sUrl; // Send URL only
			$sAttachmentFile = "";
			$sAttachmentContent = "";
		} else {
			$sEmailMessage .= $sAttachmentContent;
			$sAttachmentFile = "";
			$sAttachmentContent = "";
		}

		// Send email
		$Email = new crEmail();
		$Email->Sender = $sSender; // Sender
		$Email->Recipient = $sRecipient; // Recipient
		$Email->Cc = $sCc; // Cc
		$Email->Bcc = $sBcc; // Bcc
		$Email->Subject = $sEmailSubject; // Subject
		$Email->Content = $sEmailMessage; // Content
		if ($sAttachmentFile <> "")
			$Email->AddAttachment($sAttachmentFile, $sAttachmentContent);
		if ($sContentType <> "url") {
			foreach ($grTmpImages as $tmpimage)
				$Email->AddEmbeddedImage($tmpimage);
		}
		$Email->Format = ($sContentType == "url") ? "text" : "html";
		$Email->Charset = EWR_EMAIL_CHARSET;
		$EventArgs = array();
		$bEmailSent = FALSE;
		if ($this->Email_Sending($Email, $EventArgs))
			$bEmailSent = $Email->Send();
		ewr_DeleteTmpImages($EmailContent);

		// Check email sent status
		if ($bEmailSent) {

			// Update email sent count and write log
			ewr_AddEmailLog($sSender, $sRecipient, $sEmailSubject, $sEmailMessage);

			// Sent email success
			return $sSuccessRespPfx . $ReportLanguage->Phrase("SendEmailSuccess") . $sRespPfx; // Set up success message
		} else {

			// Sent email failure
			return $sFailRespPfx . $Email->SendErrDescription . $sRespPfx;
		}
	}

	// Export to HTML
	function ExportHtml($html, $options = array()) {

		//global $gsExportFile;
		//header('Content-Type: text/html' . (EWR_CHARSET <> '' ? ';charset=' . EWR_CHARSET : ''));
		//header('Content-Disposition: attachment; filename=' . $gsExportFile . '.html');

		$folder = @$this->GenOptions["folder"];
		$fileName = @$this->GenOptions["filename"];
		$responseType = @$options["responsetype"];
		$saveToFile = "";

		// Save generate file for print
		if ($folder <> "" && $fileName <> "" && ($responseType == "json" || $responseType == "file" && EWR_REPORT_SAVE_OUTPUT_ON_SERVER)) {
			$baseTag = "<base href=\"" . ewr_BaseUrl() . "\">";
			$html = preg_replace('/<head>/', '<head>' . $baseTag, $html);
			ewr_SaveFile($folder, $fileName, $html);
			$saveToFile = ewr_UploadPathEx(FALSE, $folder) . $fileName;
		}
		if ($saveToFile == "" || $responseType == "file")
			echo $html;
		return $saveToFile;
	}

	// Export to WORD
	function ExportWord($html, $options = array()) {
		global $gsExportFile;
		$folder = @$options["folder"];
		$fileName = @$options["filename"];
		$responseType = @$options["responsetype"];
		$saveToFile = "";
		if ($folder <> "" && $fileName <> "" && ($responseType == "json" || $responseType == "file" && EWR_REPORT_SAVE_OUTPUT_ON_SERVER)) {
		 	ewr_SaveFile(ewr_PathCombine(ewr_AppRoot(), $folder, TRUE), $fileName, $html);
			$saveToFile = ewr_UploadPathEx(FALSE, $folder) . $fileName;
		}
		if ($saveToFile == "" || $responseType == "file") {
			header('Set-Cookie: fileDownload=true; path=/');
			header('Content-Type: application/vnd.ms-word' . (EWR_CHARSET <> '' ? ';charset=' . EWR_CHARSET : ''));
			header('Content-Disposition: attachment; filename=' . $gsExportFile . '.doc');
			echo $html;
		}
		return $saveToFile;
	}

	// Export to EXCEL
	function ExportExcel($html, $options = array()) {
		global $gsExportFile;
		$folder = @$options["folder"];
		$fileName = @$options["filename"];
		$responseType = @$options["responsetype"];
		$saveToFile = "";
		if ($folder <> "" && $fileName <> "" && ($responseType == "json" || $responseType == "file" && EWR_REPORT_SAVE_OUTPUT_ON_SERVER)) {
		 	ewr_SaveFile(ewr_PathCombine(ewr_AppRoot(), $folder, TRUE), $fileName, $html);
			$saveToFile = ewr_UploadPathEx(FALSE, $folder) . $fileName;
		}
		if ($saveToFile == "" || $responseType == "file") {
			header('Set-Cookie: fileDownload=true; path=/');
			header('Content-Type: application/vnd.ms-excel' . (EWR_CHARSET <> '' ? ';charset=' . EWR_CHARSET : ''));
			header('Content-Disposition: attachment; filename=' . $gsExportFile . '.xls');
			echo $html;
		}
		return $saveToFile;
	}

	// Export PDF
	function ExportPdf($html, $options = array()) {
		global $gsExportFile;
		@ini_set("memory_limit", EWR_PDF_MEMORY_LIMIT);
		set_time_limit(EWR_PDF_TIME_LIMIT);
		if (EWR_DEBUG_ENABLED) // Add debug message
			$html = str_replace("</body>", ewr_DebugMsg() . "</body>", $html);
		$dompdf = new \Dompdf\Dompdf(array("pdf_backend" => "Cpdf"));
		$doc = new DOMDocument();
		@$doc->loadHTML('<?xml encoding="uft-8">' . ewr_ConvertToUtf8($html)); // Convert to utf-8
		$spans = $doc->getElementsByTagName("span");
		foreach ($spans as $span) {
			if ($span->getAttribute("class") == "ewFilterCaption")
				$span->parentNode->insertBefore($doc->createElement("span", ":&nbsp;"), $span->nextSibling);
		}
		$images = $doc->getElementsByTagName("img");
		$pageSize = "a4";
		$pageOrientation = "portrait";
		foreach ($images as $image) {
			$imagefn = $image->getAttribute("src");
			if (file_exists($imagefn)) {
				$imagefn = realpath($imagefn);
				$size = getimagesize($imagefn); // Get image size
				if ($size[0] <> 0) {
					if (ewr_SameText($pageSize, "letter")) { // Letter paper (8.5 in. by 11 in.)
						$w = ewr_SameText($pageOrientation, "portrait") ? 216 : 279;
					} elseif (ewr_SameText($pageSize, "legal")) { // Legal paper (8.5 in. by 14 in.)
						$w = ewr_SameText($pageOrientation, "portrait") ? 216 : 356;
					} else {
						$w = ewr_SameText($pageOrientation, "portrait") ? 210 : 297; // A4 paper (210 mm by 297 mm)
					}
					$w = min($size[0], ($w - 20 * 2) / 25.4 * 72); // Resize image, adjust the multiplying factor if necessary
					$h = $w / $size[0] * $size[1];
					$image->setAttribute("width", $w);
					$image->setAttribute("height", $h);
				}
			}
		}
		$html = $doc->saveHTML();
		$html = ewr_ConvertFromUtf8($html);
		$dompdf->load_html($html);
		$dompdf->set_paper($pageSize, $pageOrientation);
		$dompdf->render();
		$folder = @$options["folder"];
		$fileName = @$options["filename"];
		$responseType = @$options["responsetype"];
		$saveToFile = "";
		if ($folder <> "" && $fileName <> "" && ($responseType == "json" || $responseType == "file" && EWR_REPORT_SAVE_OUTPUT_ON_SERVER)) {
			ewr_SaveFile(ewr_PathCombine(ewr_AppRoot(), $folder, TRUE), $fileName, $dompdf->output());
			$saveToFile = ewr_UploadPathEx(FALSE, $folder) . $fileName;
		}
		if ($saveToFile == "" || $responseType == "file") {
			header('Set-Cookie: fileDownload=true; path=/');
			$sExportFile = strtolower(substr($gsExportFile, -4)) == ".pdf" ? $gsExportFile : $gsExportFile . ".pdf";
			$dompdf->stream($sExportFile, array("Attachment" => 1)); // 0 to open in browser, 1 to download
		}
		ewr_DeleteTmpImages($html);
		return $saveToFile;
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
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
<?php

// Create page object
if (!isset($r02_stok_summary)) $r02_stok_summary = new crr02_stok_summary();
if (isset($Page)) $OldPage = $Page;
$Page = &$r02_stok_summary;

// Page init
$Page->Page_Init();

// Page main
$Page->Page_Main();
if (!$grDashboardReport)
	ewr_Header(FALSE);

// Global Page Rendering event (in ewrusrfn*.php)
Page_Rendering();

// Page Rendering event
$Page->Page_Render();
?>
<?php if (!$grDashboardReport) { ?>
<?php include_once "header.php" ?>
<?php include_once "phprptinc/header.php" ?>
<?php } ?>
<?php if ($Page->Export == "" || $Page->Export == "print" || $Page->Export == "email" && @$gsEmailContentType == "url") { ?>
<script type="text/javascript">

// Create page object
var r02_stok_summary = new ewr_Page("r02_stok_summary");

// Page properties
r02_stok_summary.PageID = "summary"; // Page ID
var EWR_PAGE_ID = r02_stok_summary.PageID;
</script>
<?php } ?>
<?php if ($Page->Export == "" && !$Page->DrillDown && !$grDashboardReport) { ?>
<script type="text/javascript">

// Form object
var CurrentForm = fr02_stoksummary = new ewr_Form("fr02_stoksummary");

// Validate method
fr02_stoksummary.Validate = function() {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.GetForm(), $fobj = $(fobj);

	// Call Form Custom Validate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}

// Form_CustomValidate method
fr02_stoksummary.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }
<?php if (EWR_CLIENT_VALIDATE) { ?>
fr02_stoksummary.ValidateRequired = true; // Uses JavaScript validation
<?php } else { ?>
fr02_stoksummary.ValidateRequired = false; // No JavaScript validation
<?php } ?>

// Use Ajax
fr02_stoksummary.Lists["sv_MainGroup"] = {"LinkField":"sv_MainGroup","Ajax":true,"DisplayFields":["sv_MainGroup","","",""],"ParentFields":[],"FilterFields":[],"Options":[],"Template":""};
fr02_stoksummary.Lists["sv_SubGroup"] = {"LinkField":"sv_SubGroup","Ajax":true,"DisplayFields":["sv_SubGroup","","",""],"ParentFields":["sv_MainGroup"],"FilterFields":["sv_MainGroup"],"Options":[],"Template":""};
fr02_stoksummary.Lists["sv_Article"] = {"LinkField":"sv_Article","Ajax":true,"DisplayFields":["sv_Article","","",""],"ParentFields":["sv_MainGroup","sv_SubGroup"],"FilterFields":["sv_MainGroup","sv_SubGroup"],"Options":[],"Template":""};
</script>
<?php } ?>
<?php if ($Page->Export == "" && !$Page->DrillDown && !$grDashboardReport) { ?>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<a id="top"></a>
<?php if ($Page->Export == "" && !$grDashboardReport) { ?>
<!-- Content Container -->
<div id="ewContainer" class="container-fluid ewContainer">
<?php } ?>
<?php if (@$Page->GenOptions["showfilter"] == "1") { ?>
<?php $Page->ShowFilterList(TRUE) ?>
<?php } ?>
<div class="ewToolbar">
<?php
if (!$Page->DrillDownInPanel) {
	$Page->ExportOptions->Render("body");
	$Page->SearchOptions->Render("body");
	$Page->FilterOptions->Render("body");
	$Page->GenerateOptions->Render("body");
}
?>
</div>
<?php $Page->ShowPageHeader(); ?>
<?php $Page->ShowMessage(); ?>
<?php if ($Page->Export == "" && !$grDashboardReport) { ?>
<div class="row">
<?php } ?>
<?php if ($Page->Export == "" && !$grDashboardReport) { ?>
<!-- Center Container - Report -->
<div id="ewCenter" class="col-sm-12 ewCenter">
<?php } ?>
<!-- Summary Report begins -->
<?php if ($Page->Export <> "pdf") { ?>
<div id="report_summary">
<?php } ?>
<?php if ($Page->Export == "" && !$Page->DrillDown && !$grDashboardReport) { ?>
<!-- Search form (begin) -->
<form name="fr02_stoksummary" id="fr02_stoksummary" class="form-inline ewForm ewExtFilterForm" action="<?php echo ewr_CurrentPage() ?>">
<?php $SearchPanelClass = ($Page->Filter <> "") ? " in" : " in"; ?>
<div id="fr02_stoksummary_SearchPanel" class="ewSearchPanel collapse<?php echo $SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<div id="r_1" class="ewRow">
<div id="c_MainGroup" class="ewCell form-group">
	<label for="sv_MainGroup" class="ewSearchCaption ewLabel"><?php echo $Page->MainGroup->FldCaption() ?></label>
	<span class="ewSearchField">
<?php $Page->MainGroup->EditAttrs["onchange"] = "ewr_UpdateOpt.call(this, ['sv_SubGroup','sv_Article']); " . @$Page->MainGroup->EditAttrs["onchange"]; ?>
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_sv_MainGroup"><?php echo $ReportLanguage->Phrase("PleaseSelect") ?></span>
</span>
<button type="button" title="<?php echo ewr_HtmlEncode(str_replace("%s", ewr_RemoveHtml($Page->MainGroup->FldCaption()), $ReportLanguage->Phrase("LookupLink", TRUE))) ?>" onclick="ewr_ModalLookupShow({lnk:this,el:'sv_MainGroup',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="r02_stok" data-field="x_MainGroup" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $Page->MainGroup->DisplayValueSeparatorAttribute() ?>" name="sv_MainGroup" id="sv_MainGroup" value="<?php echo ewr_FilterCurrentValue($Page->MainGroup, ",") ?>"<?php echo $Page->MainGroup->EditAttributes() ?>>
<input type="hidden" name="s_sv_MainGroup" id="s_sv_MainGroup" value="<?php echo $Page->MainGroup->LookupFilterQuery() ?>">
<script type="text/javascript">
fr02_stoksummary.Lists["sv_MainGroup"].Options = <?php echo ewr_ArrayToJson($Page->MainGroup->LookupFilterOptions) ?>;
</script>
</span>
</div>
</div>
<div id="r_2" class="ewRow">
<div id="c_SubGroup" class="ewCell form-group">
	<label for="sv_SubGroup" class="ewSearchCaption ewLabel"><?php echo $Page->SubGroup->FldCaption() ?></label>
	<span class="ewSearchField">
<?php $Page->SubGroup->EditAttrs["onchange"] = "ewr_UpdateOpt.call(this, ['sv_Article']); " . @$Page->SubGroup->EditAttrs["onchange"]; ?>
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_sv_SubGroup"><?php echo $ReportLanguage->Phrase("PleaseSelect") ?></span>
</span>
<button type="button" title="<?php echo ewr_HtmlEncode(str_replace("%s", ewr_RemoveHtml($Page->SubGroup->FldCaption()), $ReportLanguage->Phrase("LookupLink", TRUE))) ?>" onclick="ewr_ModalLookupShow({lnk:this,el:'sv_SubGroup',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="r02_stok" data-field="x_SubGroup" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $Page->SubGroup->DisplayValueSeparatorAttribute() ?>" name="sv_SubGroup" id="sv_SubGroup" value="<?php echo ewr_FilterCurrentValue($Page->SubGroup, ",") ?>"<?php echo $Page->SubGroup->EditAttributes() ?>>
<input type="hidden" name="s_sv_SubGroup" id="s_sv_SubGroup" value="<?php echo $Page->SubGroup->LookupFilterQuery() ?>">
<script type="text/javascript">
fr02_stoksummary.Lists["sv_SubGroup"].Options = <?php echo ewr_ArrayToJson($Page->SubGroup->LookupFilterOptions) ?>;
</script>
</span>
</div>
</div>
<div id="r_3" class="ewRow">
<div id="c_Article" class="ewCell form-group">
	<label for="sv_Article" class="ewSearchCaption ewLabel"><?php echo $Page->Article->FldCaption() ?></label>
	<span class="ewSearchField">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_sv_Article"><?php echo $ReportLanguage->Phrase("PleaseSelect") ?></span>
</span>
<button type="button" title="<?php echo ewr_HtmlEncode(str_replace("%s", ewr_RemoveHtml($Page->Article->FldCaption()), $ReportLanguage->Phrase("LookupLink", TRUE))) ?>" onclick="ewr_ModalLookupShow({lnk:this,el:'sv_Article',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="r02_stok" data-field="x_Article" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $Page->Article->DisplayValueSeparatorAttribute() ?>" name="sv_Article" id="sv_Article" value="<?php echo ewr_FilterCurrentValue($Page->Article, ",") ?>"<?php echo $Page->Article->EditAttributes() ?>>
<input type="hidden" name="s_sv_Article" id="s_sv_Article" value="<?php echo $Page->Article->LookupFilterQuery() ?>">
<script type="text/javascript">
fr02_stoksummary.Lists["sv_Article"].Options = <?php echo ewr_ArrayToJson($Page->Article->LookupFilterOptions) ?>;
</script>
</span>
</div>
</div>
<div class="ewRow"><input type="submit" name="btnsubmit" id="btnsubmit" class="btn btn-primary" value="<?php echo $ReportLanguage->Phrase("Search") ?>">
<input type="reset" name="btnreset" id="btnreset" class="btn hide" value="<?php echo $ReportLanguage->Phrase("Reset") ?>"></div>
</div>
</form>
<script type="text/javascript">
fr02_stoksummary.Init();
fr02_stoksummary.FilterList = <?php echo $Page->GetFilterList() ?>;
</script>
<!-- Search form (end) -->
<?php } ?>
<?php if ($Page->ShowCurrentFilter) { ?>
<?php $Page->ShowFilterList() ?>
<?php } ?>
<?php

// Set the last group to display if not export all
if ($Page->ExportAll && $Page->Export <> "") {
	$Page->StopGrp = $Page->TotalGrps;
} else {
	$Page->StopGrp = $Page->StartGrp + $Page->DisplayGrps - 1;
}

// Stop group <= total number of groups
if (intval($Page->StopGrp) > intval($Page->TotalGrps))
	$Page->StopGrp = $Page->TotalGrps;
$Page->RecCount = 0;
$Page->RecIndex = 0;

// Get first row
if ($Page->TotalGrps > 0) {
	$Page->GetGrpRow(1);
	$Page->GrpCounter[0] = 1;
	$Page->GrpCount = 1;
}
$Page->GrpIdx = ewr_InitArray($Page->StopGrp - $Page->StartGrp + 1, -1);
while ($rsgrp && !$rsgrp->EOF && $Page->GrpCount <= $Page->DisplayGrps || $Page->ShowHeader) {

	// Show dummy header for custom template
	// Show header

	if ($Page->ShowHeader) {
?>
<?php if ($Page->GrpCount > 1) { ?>
</tbody>
</table>
<?php if ($Page->Export <> "pdf") { ?>
</div>
<?php } ?>
<?php if ($Page->TotalGrps > 0) { ?>
<?php if ($Page->Export == "" && !($Page->DrillDown && $Page->TotalGrps > 0)) { ?>
<div class="box-footer ewGridLowerPanel">
<?php include "r02_stoksmrypager.php" ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
<?php if ($Page->Export <> "pdf") { ?>
</div>
<?php } ?>
<span data-class="tpb<?php echo $Page->GrpCount-1 ?>_r02_stok"><?php echo $Page->PageBreakContent ?></span>
<?php } ?>
<?php if ($Page->Export <> "pdf") { ?>
<?php if ($Page->Export == "word" || $Page->Export == "excel") { ?>
<div class="ewGrid"<?php echo $Page->ReportTableStyle ?>>
<?php } else { ?>
<div class="box ewBox ewGrid"<?php echo $Page->ReportTableStyle ?>>
<?php } ?>
<?php } ?>
<?php if ($Page->Export == "" && !($Page->DrillDown && $Page->TotalGrps > 0)) { ?>
<div class="box-header ewGridUpperPanel">
<?php include "r02_stoksmrypager.php" ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<!-- Report grid (begin) -->
<?php if ($Page->Export <> "pdf") { ?>
<div id="gmp_r02_stok" class="<?php if (ewr_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<?php } ?>
<table class="<?php echo $Page->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($Page->MainGroup->Visible) { ?>
	<?php if ($Page->MainGroup->ShowGroupHeaderAsRow) { ?>
	<td data-field="MainGroup">&nbsp;</td>
	<?php } else { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="MainGroup"><div class="r02_stok_MainGroup"><span class="ewTableHeaderCaption"><?php echo $Page->MainGroup->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="MainGroup">
<?php if ($Page->SortUrl($Page->MainGroup) == "") { ?>
		<div class="ewTableHeaderBtn r02_stok_MainGroup">
			<span class="ewTableHeaderCaption"><?php echo $Page->MainGroup->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r02_stok_MainGroup" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->MainGroup) ?>',2);">
			<span class="ewTableHeaderCaption"><?php echo $Page->MainGroup->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->MainGroup->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->MainGroup->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($Page->SubGroup->Visible) { ?>
	<?php if ($Page->SubGroup->ShowGroupHeaderAsRow) { ?>
	<td data-field="SubGroup">&nbsp;</td>
	<?php } else { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="SubGroup"><div class="r02_stok_SubGroup"><span class="ewTableHeaderCaption"><?php echo $Page->SubGroup->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="SubGroup">
<?php if ($Page->SortUrl($Page->SubGroup) == "") { ?>
		<div class="ewTableHeaderBtn r02_stok_SubGroup">
			<span class="ewTableHeaderCaption"><?php echo $Page->SubGroup->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r02_stok_SubGroup" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->SubGroup) ?>',2);">
			<span class="ewTableHeaderCaption"><?php echo $Page->SubGroup->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->SubGroup->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->SubGroup->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($Page->Article->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="Article"><div class="r02_stok_Article"><span class="ewTableHeaderCaption"><?php echo $Page->Article->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="Article">
<?php if ($Page->SortUrl($Page->Article) == "") { ?>
		<div class="ewTableHeaderBtn r02_stok_Article">
			<span class="ewTableHeaderCaption"><?php echo $Page->Article->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r02_stok_Article" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->Article) ?>',2);">
			<span class="ewTableHeaderCaption"><?php echo $Page->Article->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->Article->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->Article->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->SumQty->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="SumQty"><div class="r02_stok_SumQty" style="text-align: right;"><span class="ewTableHeaderCaption"><?php echo $Page->SumQty->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="SumQty">
<?php if ($Page->SortUrl($Page->SumQty) == "") { ?>
		<div class="ewTableHeaderBtn r02_stok_SumQty" style="text-align: right;">
			<span class="ewTableHeaderCaption"><?php echo $Page->SumQty->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r02_stok_SumQty" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->SumQty) ?>',2);" style="text-align: right;">
			<span class="ewTableHeaderCaption"><?php echo $Page->SumQty->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->SumQty->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->SumQty->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->Satuan->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="Satuan"><div class="r02_stok_Satuan"><span class="ewTableHeaderCaption"><?php echo $Page->Satuan->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="Satuan">
<?php if ($Page->SortUrl($Page->Satuan) == "") { ?>
		<div class="ewTableHeaderBtn r02_stok_Satuan">
			<span class="ewTableHeaderCaption"><?php echo $Page->Satuan->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r02_stok_Satuan" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->Satuan) ?>',2);">
			<span class="ewTableHeaderCaption"><?php echo $Page->Satuan->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->Satuan->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->Satuan->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->AvgHarga->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="AvgHarga"><div class="r02_stok_AvgHarga" style="text-align: right;"><span class="ewTableHeaderCaption"><?php echo $Page->AvgHarga->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="AvgHarga">
<?php if ($Page->SortUrl($Page->AvgHarga) == "") { ?>
		<div class="ewTableHeaderBtn r02_stok_AvgHarga" style="text-align: right;">
			<span class="ewTableHeaderCaption"><?php echo $Page->AvgHarga->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r02_stok_AvgHarga" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->AvgHarga) ?>',2);" style="text-align: right;">
			<span class="ewTableHeaderCaption"><?php echo $Page->AvgHarga->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->AvgHarga->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->AvgHarga->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->SubTotal->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="SubTotal"><div class="r02_stok_SubTotal" style="text-align: right;"><span class="ewTableHeaderCaption"><?php echo $Page->SubTotal->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="SubTotal">
<?php if ($Page->SortUrl($Page->SubTotal) == "") { ?>
		<div class="ewTableHeaderBtn r02_stok_SubTotal" style="text-align: right;">
			<span class="ewTableHeaderCaption"><?php echo $Page->SubTotal->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r02_stok_SubTotal" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->SubTotal) ?>',2);" style="text-align: right;">
			<span class="ewTableHeaderCaption"><?php echo $Page->SubTotal->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->SubTotal->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->SubTotal->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
	</tr>
</thead>
<tbody>
<?php
		if ($Page->TotalGrps == 0) break; // Show header only
		$Page->ShowHeader = FALSE;
	}

	// Build detail SQL
	$sWhere = ewr_DetailFilterSql($Page->MainGroup, $Page->getSqlFirstGroupField(), $Page->MainGroup->GroupValue(), $Page->DBID);
	if ($Page->PageFirstGroupFilter <> "") $Page->PageFirstGroupFilter .= " OR ";
	$Page->PageFirstGroupFilter .= $sWhere;
	if ($Page->Filter != "")
		$sWhere = "($Page->Filter) AND ($sWhere)";
	$sSql = ewr_BuildReportSql($Page->getSqlSelect(), $Page->getSqlWhere(), $Page->getSqlGroupBy(), $Page->getSqlHaving(), $Page->getSqlOrderBy(), $sWhere, $Page->Sort);
	$rs = $Page->GetDetailRs($sSql);
	$rsdtlcnt = ($rs) ? $rs->RecordCount() : 0;
	if ($rsdtlcnt > 0)
		$Page->GetRow(1);
	$Page->GrpIdx[$Page->GrpCount] = array(-1);
	while ($rs && !$rs->EOF) { // Loop detail records
		$Page->RecCount++;
		$Page->RecIndex++;
?>
<?php if ($Page->MainGroup->Visible && $Page->ChkLvlBreak(1) && $Page->MainGroup->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$Page->ResetAttrs();
		$Page->RowType = EWR_ROWTYPE_TOTAL;
		$Page->RowTotalType = EWR_ROWTOTAL_GROUP;
		$Page->RowTotalSubType = EWR_ROWTOTAL_HEADER;
		$Page->RowGroupLevel = 1;
		$Page->MainGroup->Count = $Page->GetSummaryCount(1);
		$Page->RenderRow();
?>
	<tr<?php echo $Page->RowAttributes(); ?>>
<?php if ($Page->MainGroup->Visible) { ?>
		<td data-field="MainGroup"<?php echo $Page->MainGroup->CellAttributes(); ?>><span class="ewGroupToggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="MainGroup" colspan="<?php echo ($Page->GrpColumnCount + $Page->DtlColumnCount - 1) ?>"<?php echo $Page->MainGroup->CellAttributes() ?>>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
		<span class="ewSummaryCaption r02_stok_MainGroup"><span class="ewTableHeaderCaption"><?php echo $Page->MainGroup->FldCaption() ?></span></span>
<?php } else { ?>
	<?php if ($Page->SortUrl($Page->MainGroup) == "") { ?>
		<span class="ewSummaryCaption r02_stok_MainGroup">
			<span class="ewTableHeaderCaption"><?php echo $Page->MainGroup->FldCaption() ?></span>
		</span>
	<?php } else { ?>
		<span class="ewTableHeaderBtn ewPointer ewSummaryCaption r02_stok_MainGroup" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->MainGroup) ?>',2);">
			<span class="ewTableHeaderCaption"><?php echo $Page->MainGroup->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->MainGroup->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->MainGroup->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</span>
	<?php } ?>
<?php } ?>
		<?php echo $ReportLanguage->Phrase("SummaryColon") ?>
<span data-class="tpx<?php echo $Page->GrpCount ?>_r02_stok_MainGroup"<?php echo $Page->MainGroup->ViewAttributes() ?>><?php echo $Page->MainGroup->GroupViewValue ?></span>
		<span class="ewSummaryCount">(<span class="ewAggregateCaption"><?php echo $ReportLanguage->Phrase("RptCnt") ?></span><?php echo $ReportLanguage->Phrase("AggregateEqual") ?><span class="ewAggregateValue"><?php echo ewr_FormatNumber($Page->MainGroup->Count,0,-2,-2,-2) ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php if ($Page->SubGroup->Visible && $Page->ChkLvlBreak(2) && $Page->SubGroup->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$Page->ResetAttrs();
		$Page->RowType = EWR_ROWTYPE_TOTAL;
		$Page->RowTotalType = EWR_ROWTOTAL_GROUP;
		$Page->RowTotalSubType = EWR_ROWTOTAL_HEADER;
		$Page->RowGroupLevel = 2;
		$Page->SubGroup->Count = $Page->GetSummaryCount(2);
		$Page->RenderRow();
?>
	<tr<?php echo $Page->RowAttributes(); ?>>
<?php if ($Page->MainGroup->Visible) { ?>
		<td data-field="MainGroup"<?php echo $Page->MainGroup->CellAttributes(); ?>></td>
<?php } ?>
<?php if ($Page->SubGroup->Visible) { ?>
		<td data-field="SubGroup"<?php echo $Page->SubGroup->CellAttributes(); ?>><span class="ewGroupToggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="SubGroup" colspan="<?php echo ($Page->GrpColumnCount + $Page->DtlColumnCount - 2) ?>"<?php echo $Page->SubGroup->CellAttributes() ?>>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
		<span class="ewSummaryCaption r02_stok_SubGroup"><span class="ewTableHeaderCaption"><?php echo $Page->SubGroup->FldCaption() ?></span></span>
<?php } else { ?>
	<?php if ($Page->SortUrl($Page->SubGroup) == "") { ?>
		<span class="ewSummaryCaption r02_stok_SubGroup">
			<span class="ewTableHeaderCaption"><?php echo $Page->SubGroup->FldCaption() ?></span>
		</span>
	<?php } else { ?>
		<span class="ewTableHeaderBtn ewPointer ewSummaryCaption r02_stok_SubGroup" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->SubGroup) ?>',2);">
			<span class="ewTableHeaderCaption"><?php echo $Page->SubGroup->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->SubGroup->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->SubGroup->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</span>
	<?php } ?>
<?php } ?>
		<?php echo $ReportLanguage->Phrase("SummaryColon") ?>
<span data-class="tpx<?php echo $Page->GrpCount ?>_<?php echo $Page->GrpCounter[0] ?>_r02_stok_SubGroup"<?php echo $Page->SubGroup->ViewAttributes() ?>><?php echo $Page->SubGroup->GroupViewValue ?></span>
		<span class="ewSummaryCount">(<span class="ewAggregateCaption"><?php echo $ReportLanguage->Phrase("RptCnt") ?></span><?php echo $ReportLanguage->Phrase("AggregateEqual") ?><span class="ewAggregateValue"><?php echo ewr_FormatNumber($Page->SubGroup->Count,0,-2,-2,-2) ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php

		// Render detail row
		$Page->ResetAttrs();
		$Page->RowType = EWR_ROWTYPE_DETAIL;
		$Page->RenderRow();
?>
	<tr<?php echo $Page->RowAttributes(); ?>>
<?php if ($Page->MainGroup->Visible) { ?>
	<?php if ($Page->MainGroup->ShowGroupHeaderAsRow) { ?>
		<td data-field="MainGroup"<?php echo $Page->MainGroup->CellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="MainGroup"<?php echo $Page->MainGroup->CellAttributes(); ?>>
<span data-class="tpx<?php echo $Page->GrpCount ?>_r02_stok_MainGroup"<?php echo $Page->MainGroup->ViewAttributes() ?>><?php echo $Page->MainGroup->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($Page->SubGroup->Visible) { ?>
	<?php if ($Page->SubGroup->ShowGroupHeaderAsRow) { ?>
		<td data-field="SubGroup"<?php echo $Page->SubGroup->CellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="SubGroup"<?php echo $Page->SubGroup->CellAttributes(); ?>>
<span data-class="tpx<?php echo $Page->GrpCount ?>_<?php echo $Page->GrpCounter[0] ?>_r02_stok_SubGroup"<?php echo $Page->SubGroup->ViewAttributes() ?>><?php echo $Page->SubGroup->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($Page->Article->Visible) { ?>
		<td data-field="Article"<?php echo $Page->Article->CellAttributes() ?>>
<span<?php echo $Page->Article->ViewAttributes() ?>><?php echo $Page->Article->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->SumQty->Visible) { ?>
		<td data-field="SumQty"<?php echo $Page->SumQty->CellAttributes() ?>>
<span<?php echo $Page->SumQty->ViewAttributes() ?>><?php echo $Page->SumQty->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->Satuan->Visible) { ?>
		<td data-field="Satuan"<?php echo $Page->Satuan->CellAttributes() ?>>
<span<?php echo $Page->Satuan->ViewAttributes() ?>><?php echo $Page->Satuan->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->AvgHarga->Visible) { ?>
		<td data-field="AvgHarga"<?php echo $Page->AvgHarga->CellAttributes() ?>>
<span<?php echo $Page->AvgHarga->ViewAttributes() ?>><?php echo $Page->AvgHarga->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->SubTotal->Visible) { ?>
		<td data-field="SubTotal"<?php echo $Page->SubTotal->CellAttributes() ?>>
<span<?php echo $Page->SubTotal->ViewAttributes() ?>><?php echo $Page->SubTotal->ListViewValue() ?></span></td>
<?php } ?>
	</tr>
<?php

		// Accumulate page summary
		$Page->AccumulateSummary();

		// Get next record
		$Page->GetRow(2);

		// Show Footers
?>
<?php
		if ($Page->ChkLvlBreak(2)) {
			$cnt = count(@$Page->GrpIdx[$Page->GrpCount]);
			$Page->GrpIdx[$Page->GrpCount][$cnt] = $Page->RecCount;
		}
		if ($Page->ChkLvlBreak(2) && $Page->SubGroup->Visible) {
?>
<?php
			$Page->MainGroup->Count = $Page->GetSummaryCount(1, FALSE);
			$Page->SubGroup->Count = $Page->GetSummaryCount(2, FALSE);
			$Page->SumQty->Count = $Page->Cnt[2][2];
			$Page->SumQty->SumValue = $Page->Smry[2][2]; // Load SUM
			$Page->SubTotal->Count = $Page->Cnt[2][5];
			$Page->SubTotal->SumValue = $Page->Smry[2][5]; // Load SUM
			$Page->ResetAttrs();
			$Page->RowType = EWR_ROWTYPE_TOTAL;
			$Page->RowTotalType = EWR_ROWTOTAL_GROUP;
			$Page->RowTotalSubType = EWR_ROWTOTAL_FOOTER;
			$Page->RowGroupLevel = 2;
			$Page->RenderRow();
?>
<?php if ($Page->SubGroup->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $Page->RowAttributes(); ?>>
<?php if ($Page->MainGroup->Visible) { ?>
		<td data-field="MainGroup"<?php echo $Page->MainGroup->CellAttributes() ?>>
	<?php if ($Page->MainGroup->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Page->RowGroupLevel <> 1) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ewSummaryCount"><span class="ewAggregateCaption"><?php echo $ReportLanguage->Phrase("RptCnt") ?></span><?php echo $ReportLanguage->Phrase("AggregateEqual") ?><span class="ewAggregateValue"><?php echo ewr_FormatNumber($Page->MainGroup->Count,0,-2,-2,-2) ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Page->SubGroup->Visible) { ?>
		<td data-field="SubGroup"<?php echo $Page->SubGroup->CellAttributes() ?>>
	<?php if ($Page->SubGroup->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Page->RowGroupLevel <> 2) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ewSummaryCount"><span class="ewAggregateCaption"><?php echo $ReportLanguage->Phrase("RptCnt") ?></span><?php echo $ReportLanguage->Phrase("AggregateEqual") ?><span class="ewAggregateValue"><?php echo ewr_FormatNumber($Page->SubGroup->Count,0,-2,-2,-2) ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Page->Article->Visible) { ?>
		<td data-field="Article"<?php echo $Page->SubGroup->CellAttributes() ?>></td>
<?php } ?>
<?php if ($Page->SumQty->Visible) { ?>
		<td data-field="SumQty"<?php echo $Page->SubGroup->CellAttributes() ?>><span class="ewAggregateCaption"><?php echo $ReportLanguage->Phrase("RptSum") ?></span><?php echo $ReportLanguage->Phrase("AggregateEqual") ?><span class="ewAggregateValue"><span<?php echo $Page->SumQty->ViewAttributes() ?>><?php echo $Page->SumQty->SumViewValue ?></span></span></td>
<?php } ?>
<?php if ($Page->Satuan->Visible) { ?>
		<td data-field="Satuan"<?php echo $Page->SubGroup->CellAttributes() ?>></td>
<?php } ?>
<?php if ($Page->AvgHarga->Visible) { ?>
		<td data-field="AvgHarga"<?php echo $Page->SubGroup->CellAttributes() ?>></td>
<?php } ?>
<?php if ($Page->SubTotal->Visible) { ?>
		<td data-field="SubTotal"<?php echo $Page->SubGroup->CellAttributes() ?>><span class="ewAggregateCaption"><?php echo $ReportLanguage->Phrase("RptSum") ?></span><?php echo $ReportLanguage->Phrase("AggregateEqual") ?><span class="ewAggregateValue"><span<?php echo $Page->SubTotal->ViewAttributes() ?>><?php echo $Page->SubTotal->SumViewValue ?></span></span></td>
<?php } ?>
	</tr>
<?php } else { ?>
	<tr<?php echo $Page->RowAttributes(); ?>>
<?php if ($Page->MainGroup->Visible) { ?>
		<td data-field="MainGroup"<?php echo $Page->MainGroup->CellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->SubGrpColumnCount + $Page->DtlColumnCount > 0) { ?>
		<td colspan="<?php echo ($Page->SubGrpColumnCount + $Page->DtlColumnCount) ?>"<?php echo $Page->SubTotal->CellAttributes() ?>><?php echo str_replace(array("%v", "%c"), array($Page->SubGroup->GroupViewValue, $Page->SubGroup->FldCaption()), $ReportLanguage->Phrase("RptSumHead")) ?> <span class="ewDirLtr">(<?php echo ewr_FormatNumber($Page->Cnt[2][0],0,-2,-2,-2) ?><?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</span></td>
<?php } ?>
	</tr>
	<tr<?php echo $Page->RowAttributes(); ?>>
<?php if ($Page->MainGroup->Visible) { ?>
		<td data-field="MainGroup"<?php echo $Page->MainGroup->CellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->GrpColumnCount > 0) { ?>
		<td colspan="<?php echo ($Page->GrpColumnCount - 1) ?>"<?php echo $Page->SubGroup->CellAttributes() ?>><?php echo $ReportLanguage->Phrase("RptSum") ?></td>
<?php } ?>
<?php if ($Page->Article->Visible) { ?>
		<td data-field="Article"<?php echo $Page->SubGroup->CellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->SumQty->Visible) { ?>
		<td data-field="SumQty"<?php echo $Page->SubTotal->CellAttributes() ?>>
<span<?php echo $Page->SumQty->ViewAttributes() ?>><?php echo $Page->SumQty->SumViewValue ?></span></td>
<?php } ?>
<?php if ($Page->Satuan->Visible) { ?>
		<td data-field="Satuan"<?php echo $Page->SubGroup->CellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->AvgHarga->Visible) { ?>
		<td data-field="AvgHarga"<?php echo $Page->SubGroup->CellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->SubTotal->Visible) { ?>
		<td data-field="SubTotal"<?php echo $Page->SubTotal->CellAttributes() ?>>
<span<?php echo $Page->SubTotal->ViewAttributes() ?>><?php echo $Page->SubTotal->SumViewValue ?></span></td>
<?php } ?>
	</tr>
<?php } ?>
<?php

			// Reset level 2 summary
			$Page->ResetLevelSummary(2);
		} // End show footer check
		if ($Page->ChkLvlBreak(2)) {
			$Page->GrpCounter[0]++;
		}
?>
<?php
	} // End detail records loop
?>
<?php
		if ($Page->MainGroup->Visible) {
?>
<?php
			$Page->MainGroup->Count = $Page->GetSummaryCount(1, FALSE);
			$Page->SubGroup->Count = $Page->GetSummaryCount(2, FALSE);
			$Page->SumQty->Count = $Page->Cnt[1][2];
			$Page->SumQty->SumValue = $Page->Smry[1][2]; // Load SUM
			$Page->SubTotal->Count = $Page->Cnt[1][5];
			$Page->SubTotal->SumValue = $Page->Smry[1][5]; // Load SUM
			$Page->ResetAttrs();
			$Page->RowType = EWR_ROWTYPE_TOTAL;
			$Page->RowTotalType = EWR_ROWTOTAL_GROUP;
			$Page->RowTotalSubType = EWR_ROWTOTAL_FOOTER;
			$Page->RowGroupLevel = 1;
			$Page->RenderRow();
?>
<?php if ($Page->MainGroup->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $Page->RowAttributes(); ?>>
<?php if ($Page->MainGroup->Visible) { ?>
		<td data-field="MainGroup"<?php echo $Page->MainGroup->CellAttributes() ?>>
	<?php if ($Page->MainGroup->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Page->RowGroupLevel <> 1) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ewSummaryCount"><span class="ewAggregateCaption"><?php echo $ReportLanguage->Phrase("RptCnt") ?></span><?php echo $ReportLanguage->Phrase("AggregateEqual") ?><span class="ewAggregateValue"><?php echo ewr_FormatNumber($Page->MainGroup->Count,0,-2,-2,-2) ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Page->SubGroup->Visible) { ?>
		<td data-field="SubGroup"<?php echo $Page->MainGroup->CellAttributes() ?>>
	<?php if ($Page->SubGroup->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Page->RowGroupLevel <> 2) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ewSummaryCount"><span class="ewAggregateCaption"><?php echo $ReportLanguage->Phrase("RptCnt") ?></span><?php echo $ReportLanguage->Phrase("AggregateEqual") ?><span class="ewAggregateValue"><?php echo ewr_FormatNumber($Page->SubGroup->Count,0,-2,-2,-2) ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Page->Article->Visible) { ?>
		<td data-field="Article"<?php echo $Page->MainGroup->CellAttributes() ?>></td>
<?php } ?>
<?php if ($Page->SumQty->Visible) { ?>
		<td data-field="SumQty"<?php echo $Page->MainGroup->CellAttributes() ?>><span class="ewAggregateCaption"><?php echo $ReportLanguage->Phrase("RptSum") ?></span><?php echo $ReportLanguage->Phrase("AggregateEqual") ?><span class="ewAggregateValue"><span<?php echo $Page->SumQty->ViewAttributes() ?>><?php echo $Page->SumQty->SumViewValue ?></span></span></td>
<?php } ?>
<?php if ($Page->Satuan->Visible) { ?>
		<td data-field="Satuan"<?php echo $Page->MainGroup->CellAttributes() ?>></td>
<?php } ?>
<?php if ($Page->AvgHarga->Visible) { ?>
		<td data-field="AvgHarga"<?php echo $Page->MainGroup->CellAttributes() ?>></td>
<?php } ?>
<?php if ($Page->SubTotal->Visible) { ?>
		<td data-field="SubTotal"<?php echo $Page->MainGroup->CellAttributes() ?>><span class="ewAggregateCaption"><?php echo $ReportLanguage->Phrase("RptSum") ?></span><?php echo $ReportLanguage->Phrase("AggregateEqual") ?><span class="ewAggregateValue"><span<?php echo $Page->SubTotal->ViewAttributes() ?>><?php echo $Page->SubTotal->SumViewValue ?></span></span></td>
<?php } ?>
	</tr>
<?php } else { ?>
	<tr<?php echo $Page->RowAttributes(); ?>>
<?php if ($Page->GrpColumnCount + $Page->DtlColumnCount > 0) { ?>
		<td colspan="<?php echo ($Page->GrpColumnCount + $Page->DtlColumnCount) ?>"<?php echo $Page->SubTotal->CellAttributes() ?>><?php echo str_replace(array("%v", "%c"), array($Page->MainGroup->GroupViewValue, $Page->MainGroup->FldCaption()), $ReportLanguage->Phrase("RptSumHead")) ?> <span class="ewDirLtr">(<?php echo ewr_FormatNumber($Page->Cnt[1][0],0,-2,-2,-2) ?><?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</span></td>
<?php } ?>
	</tr>
	<tr<?php echo $Page->RowAttributes(); ?>>
<?php if ($Page->GrpColumnCount > 0) { ?>
		<td colspan="<?php echo ($Page->GrpColumnCount - 0) ?>"<?php echo $Page->MainGroup->CellAttributes() ?>><?php echo $ReportLanguage->Phrase("RptSum") ?></td>
<?php } ?>
<?php if ($Page->Article->Visible) { ?>
		<td data-field="Article"<?php echo $Page->MainGroup->CellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->SumQty->Visible) { ?>
		<td data-field="SumQty"<?php echo $Page->SubTotal->CellAttributes() ?>>
<span<?php echo $Page->SumQty->ViewAttributes() ?>><?php echo $Page->SumQty->SumViewValue ?></span></td>
<?php } ?>
<?php if ($Page->Satuan->Visible) { ?>
		<td data-field="Satuan"<?php echo $Page->MainGroup->CellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->AvgHarga->Visible) { ?>
		<td data-field="AvgHarga"<?php echo $Page->MainGroup->CellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->SubTotal->Visible) { ?>
		<td data-field="SubTotal"<?php echo $Page->SubTotal->CellAttributes() ?>>
<span<?php echo $Page->SubTotal->ViewAttributes() ?>><?php echo $Page->SubTotal->SumViewValue ?></span></td>
<?php } ?>
	</tr>
<?php } ?>
<?php

			// Reset level 1 summary
			$Page->ResetLevelSummary(1);
		} // End show footer check
?>
<?php

	// Next group
	$Page->GetGrpRow(2);

	// Show header if page break
	if ($Page->Export <> "")
		$Page->ShowHeader = ($Page->ExportPageBreakCount == 0) ? FALSE : ($Page->GrpCount % $Page->ExportPageBreakCount == 0);

	// Page_Breaking server event
	if ($Page->ShowHeader)
		$Page->Page_Breaking($Page->ShowHeader, $Page->PageBreakContent);
	$Page->GrpCount++;
	$Page->GrpCounter[0] = 1;

	// Handle EOF
	if (!$rsgrp || $rsgrp->EOF)
		$Page->ShowHeader = FALSE;
} // End while
?>
<?php if ($Page->TotalGrps > 0) { ?>
</tbody>
<tfoot>
<?php
	$Page->SumQty->Count = $Page->GrandCnt[2];
	$Page->SumQty->SumValue = $Page->GrandSmry[2]; // Load SUM
	$Page->SubTotal->Count = $Page->GrandCnt[5];
	$Page->SubTotal->SumValue = $Page->GrandSmry[5]; // Load SUM
	$Page->ResetAttrs();
	$Page->RowType = EWR_ROWTYPE_TOTAL;
	$Page->RowTotalType = EWR_ROWTOTAL_GRAND;
	$Page->RowTotalSubType = EWR_ROWTOTAL_FOOTER;
	$Page->RowAttrs["class"] = "ewRptGrandSummary";
	$Page->RenderRow();
?>
<?php if ($Page->MainGroup->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $Page->RowAttributes() ?>><td colspan="<?php echo ($Page->GrpColumnCount + $Page->DtlColumnCount) ?>"><?php echo $ReportLanguage->Phrase("RptGrandSummary") ?> (<span class="ewAggregateCaption"><?php echo $ReportLanguage->Phrase("RptCnt") ?></span><?php echo $ReportLanguage->Phrase("AggregateEqual") ?><span class="ewAggregateValue"><?php echo ewr_FormatNumber($Page->TotCount,0,-2,-2,-2) ?></span>)</td></tr>
	<tr<?php echo $Page->RowAttributes() ?>>
<?php if ($Page->GrpColumnCount > 0) { ?>
		<td colspan="<?php echo $Page->GrpColumnCount ?>" class="ewRptGrpAggregate">&nbsp;</td>
<?php } ?>
<?php if ($Page->Article->Visible) { ?>
		<td data-field="Article"<?php echo $Page->Article->CellAttributes() ?>></td>
<?php } ?>
<?php if ($Page->SumQty->Visible) { ?>
		<td data-field="SumQty"<?php echo $Page->SumQty->CellAttributes() ?>><?php echo $ReportLanguage->Phrase("RptSum") ?><?php echo $ReportLanguage->Phrase("AggregateEqual") ?><span<?php echo $Page->SumQty->ViewAttributes() ?>><?php echo $Page->SumQty->SumViewValue ?></span></td>
<?php } ?>
<?php if ($Page->Satuan->Visible) { ?>
		<td data-field="Satuan"<?php echo $Page->Satuan->CellAttributes() ?>></td>
<?php } ?>
<?php if ($Page->AvgHarga->Visible) { ?>
		<td data-field="AvgHarga"<?php echo $Page->AvgHarga->CellAttributes() ?>></td>
<?php } ?>
<?php if ($Page->SubTotal->Visible) { ?>
		<td data-field="SubTotal"<?php echo $Page->SubTotal->CellAttributes() ?>><?php echo $ReportLanguage->Phrase("RptSum") ?><?php echo $ReportLanguage->Phrase("AggregateEqual") ?><span<?php echo $Page->SubTotal->ViewAttributes() ?>><?php echo $Page->SubTotal->SumViewValue ?></span></td>
<?php } ?>
	</tr>
<?php } else { ?>
	<tr<?php echo $Page->RowAttributes() ?>><td colspan="<?php echo ($Page->GrpColumnCount + $Page->DtlColumnCount) ?>"><?php echo $ReportLanguage->Phrase("RptGrandSummary") ?> <span class="ewDirLtr">(<?php echo ewr_FormatNumber($Page->TotCount,0,-2,-2,-2); ?><?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</span></td></tr>
	<tr<?php echo $Page->RowAttributes() ?>>
<?php if ($Page->GrpColumnCount > 0) { ?>
		<td colspan="<?php echo $Page->GrpColumnCount ?>" class="ewRptGrpAggregate"><?php echo $ReportLanguage->Phrase("RptSum") ?></td>
<?php } ?>
<?php if ($Page->Article->Visible) { ?>
		<td data-field="Article"<?php echo $Page->Article->CellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->SumQty->Visible) { ?>
		<td data-field="SumQty"<?php echo $Page->SumQty->CellAttributes() ?>>
<span<?php echo $Page->SumQty->ViewAttributes() ?>><?php echo $Page->SumQty->SumViewValue ?></span></td>
<?php } ?>
<?php if ($Page->Satuan->Visible) { ?>
		<td data-field="Satuan"<?php echo $Page->Satuan->CellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->AvgHarga->Visible) { ?>
		<td data-field="AvgHarga"<?php echo $Page->AvgHarga->CellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->SubTotal->Visible) { ?>
		<td data-field="SubTotal"<?php echo $Page->SubTotal->CellAttributes() ?>>
<span<?php echo $Page->SubTotal->ViewAttributes() ?>><?php echo $Page->SubTotal->SumViewValue ?></span></td>
<?php } ?>
	</tr>
<?php } ?>
	</tfoot>
<?php } elseif (!$Page->ShowHeader && FALSE) { // No header displayed ?>
<?php if ($Page->Export <> "pdf") { ?>
<?php if ($Page->Export == "word" || $Page->Export == "excel") { ?>
<div class="ewGrid"<?php echo $Page->ReportTableStyle ?>>
<?php } else { ?>
<div class="box ewBox ewGrid"<?php echo $Page->ReportTableStyle ?>>
<?php } ?>
<?php } ?>
<?php if ($Page->Export == "" && !($Page->DrillDown && $Page->TotalGrps > 0)) { ?>
<div class="box-header ewGridUpperPanel">
<?php include "r02_stoksmrypager.php" ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<!-- Report grid (begin) -->
<?php if ($Page->Export <> "pdf") { ?>
<div id="gmp_r02_stok" class="<?php if (ewr_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<?php } ?>
<table class="<?php echo $Page->ReportTableClass ?>">
<?php } ?>
<?php if ($Page->TotalGrps > 0 || FALSE) { // Show footer ?>
</table>
<?php if ($Page->Export <> "pdf") { ?>
</div>
<?php } ?>
<?php if ($Page->TotalGrps > 0) { ?>
<?php if ($Page->Export == "" && !($Page->DrillDown && $Page->TotalGrps > 0)) { ?>
<div class="box-footer ewGridLowerPanel">
<?php include "r02_stoksmrypager.php" ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
<?php if ($Page->Export <> "pdf") { ?>
</div>
<?php } ?>
<?php } ?>
<?php if ($Page->Export <> "pdf") { ?>
</div>
<?php } ?>
<!-- Summary Report Ends -->
<?php if ($Page->Export == "" && !$grDashboardReport) { ?>
</div>
<!-- /#ewCenter -->
<?php } ?>
<?php if ($Page->Export == "" && !$grDashboardReport) { ?>
</div>
<!-- /.row -->
<?php } ?>
<?php if ($Page->Export == "" && !$grDashboardReport) { ?>
</div>
<!-- /.ewContainer -->
<?php } ?>
<?php
$Page->ShowPageFooter();
if (EWR_DEBUG_ENABLED)
	echo ewr_DebugMsg();
?>
<?php

// Close recordsets
if ($rsgrp) $rsgrp->Close();
if ($rs) $rs->Close();
?>
<?php if ($Page->Export == "" && !$Page->DrillDown && !$grDashboardReport) { ?>
<script type="text/javascript">

// Write your table-specific startup script here
// console.log("page loaded");

</script>
<?php } ?>
<?php if (!$grDashboardReport) { ?>
<?php include_once "phprptinc/footer.php" ?>
<?php include_once "footer.php" ?>
<?php } ?>
<?php
$Page->Page_Terminate();
if (isset($OldPage)) $Page = $OldPage;
?>
