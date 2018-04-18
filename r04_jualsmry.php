<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start();
?>
<?php include_once "rcfg11.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "phprptinc/ewmysql.php") ?>
<?php include_once "rphpfn11.php" ?>
<?php include_once "rusrfn11.php" ?>
<?php include_once "r04_jualsmryinfo.php" ?>
<?php

//
// Page class
//

$r04_jual_summary = NULL; // Initialize page object first

class crr04_jual_summary extends crr04_jual {

	// Page ID
	var $PageID = 'summary';

	// Project ID
	var $ProjectID = "{A2EF3792-3541-4459-9D68-D8F1DBA083C2}";

	// Page object name
	var $PageObjName = 'r04_jual_summary';

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

		// Table object (r04_jual)
		if (!isset($GLOBALS["r04_jual"])) {
			$GLOBALS["r04_jual"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["r04_jual"];
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
			define("EWR_TABLE_NAME", 'r04_jual', TRUE);

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
		$this->FilterOptions->TagClassName = "ewFilterOption fr04_jualsummary";

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
		$Security->LoadCurrentUserLevel($this->ProjectID . 'r04_jual');
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
		$this->TglSO->PlaceHolder = $this->TglSO->FldCaption();

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
		$item->Body = "<a class=\"ewrExportLink ewEmail\" title=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ExportToEmail", TRUE)) . "\" data-caption=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ExportToEmail", TRUE)) . "\" id=\"emf_r04_jual\" href=\"javascript:void(0);\" onclick=\"ewr_EmailDialogShow({lnk:'emf_r04_jual',hdr:ewLanguage.Phrase('ExportToEmail'),url:'$url',exportid:'$exportid',el:this});\">" . $ReportLanguage->Phrase("ExportToEmail") . "</a>";
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
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"fr04_jualsummary\" href=\"#\">" . $ReportLanguage->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"fr04_jualsummary\" href=\"#\">" . $ReportLanguage->Phrase("DeleteFilter") . "</a>";
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
		$item->Body = "<button type=\"button\" class=\"btn btn-default ewSearchToggle" . $SearchToggleClass . "\" title=\"" . $ReportLanguage->Phrase("SearchBtn", TRUE) . "\" data-caption=\"" . $ReportLanguage->Phrase("SearchBtn", TRUE) . "\" data-toggle=\"button\" data-form=\"fr04_jualsummary\">" . $ReportLanguage->Phrase("SearchBtn") . "</button>";
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
		$this->ArticleNama->SetVisibility();
		$this->HargaJual->SetVisibility();
		$this->Qty->SetVisibility();
		$this->SatuanNama->SetVisibility();
		$this->SubTotal->SetVisibility();

		// Aggregate variables
		// 1st dimension = no of groups (level 0 used for grand total)
		// 2nd dimension = no of fields

		$nDtls = 6;
		$nGrps = 5;
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
		$this->Col = array(array(FALSE, FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(TRUE,FALSE));

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
			$wrkTglSO = $row["TglSO"];
			$wrkNoSO = $row["NoSO"];
			$wrkCustomerNama = $row["CustomerNama"];
			$wrkCustomerPO = $row["CustomerPO"];
			if ($lvl >= 1) {
				$val = $curValue ? $this->TglSO->CurrentValue : $this->TglSO->OldValue;
				$grpval = $curValue ? $this->TglSO->GroupValue() : $this->TglSO->GroupOldValue();
				if (is_null($val) && !is_null($wrkTglSO) || !is_null($val) && is_null($wrkTglSO) ||
					$grpval <> $this->TglSO->getGroupValueBase($wrkTglSO))
				continue;
			}
			if ($lvl >= 2) {
				$val = $curValue ? $this->NoSO->CurrentValue : $this->NoSO->OldValue;
				$grpval = $curValue ? $this->NoSO->GroupValue() : $this->NoSO->GroupOldValue();
				if (is_null($val) && !is_null($wrkNoSO) || !is_null($val) && is_null($wrkNoSO) ||
					$grpval <> $this->NoSO->getGroupValueBase($wrkNoSO))
				continue;
			}
			if ($lvl >= 3) {
				$val = $curValue ? $this->CustomerNama->CurrentValue : $this->CustomerNama->OldValue;
				$grpval = $curValue ? $this->CustomerNama->GroupValue() : $this->CustomerNama->GroupOldValue();
				if (is_null($val) && !is_null($wrkCustomerNama) || !is_null($val) && is_null($wrkCustomerNama) ||
					$grpval <> $this->CustomerNama->getGroupValueBase($wrkCustomerNama))
				continue;
			}
			if ($lvl >= 4) {
				$val = $curValue ? $this->CustomerPO->CurrentValue : $this->CustomerPO->OldValue;
				$grpval = $curValue ? $this->CustomerPO->GroupValue() : $this->CustomerPO->GroupOldValue();
				if (is_null($val) && !is_null($wrkCustomerPO) || !is_null($val) && is_null($wrkCustomerPO) ||
					$grpval <> $this->CustomerPO->getGroupValueBase($wrkCustomerPO))
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
				return (is_null($this->TglSO->CurrentValue) && !is_null($this->TglSO->OldValue)) ||
					(!is_null($this->TglSO->CurrentValue) && is_null($this->TglSO->OldValue)) ||
					($this->TglSO->GroupValue() <> $this->TglSO->GroupOldValue());
			case 2:
				return (is_null($this->NoSO->CurrentValue) && !is_null($this->NoSO->OldValue)) ||
					(!is_null($this->NoSO->CurrentValue) && is_null($this->NoSO->OldValue)) ||
					($this->NoSO->GroupValue() <> $this->NoSO->GroupOldValue()) || $this->ChkLvlBreak(1); // Recurse upper level
			case 3:
				return (is_null($this->CustomerNama->CurrentValue) && !is_null($this->CustomerNama->OldValue)) ||
					(!is_null($this->CustomerNama->CurrentValue) && is_null($this->CustomerNama->OldValue)) ||
					($this->CustomerNama->GroupValue() <> $this->CustomerNama->GroupOldValue()) || $this->ChkLvlBreak(2); // Recurse upper level
			case 4:
				return (is_null($this->CustomerPO->CurrentValue) && !is_null($this->CustomerPO->OldValue)) ||
					(!is_null($this->CustomerPO->CurrentValue) && is_null($this->CustomerPO->OldValue)) ||
					($this->CustomerPO->GroupValue() <> $this->CustomerPO->GroupOldValue()) || $this->ChkLvlBreak(3); // Recurse upper level
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
			$this->TglSO->setDbValue(""); // Init first value
		} else { // Get next group
			$rsgrp->MoveNext();
		}
		if (!$rsgrp->EOF)
			$this->TglSO->setDbValue($rsgrp->fields[0]);
		if ($rsgrp->EOF) {
			$this->TglSO->setDbValue("");
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
				$this->FirstRowData['TglSO'] = ewr_Conv($rs->fields('TglSO'), 133);
				$this->FirstRowData['NoSO'] = ewr_Conv($rs->fields('NoSO'), 200);
				$this->FirstRowData['CustomerID'] = ewr_Conv($rs->fields('CustomerID'), 3);
				$this->FirstRowData['CustomerNama'] = ewr_Conv($rs->fields('CustomerNama'), 200);
				$this->FirstRowData['CustomerPO'] = ewr_Conv($rs->fields('CustomerPO'), 200);
				$this->FirstRowData['ArticleID'] = ewr_Conv($rs->fields('ArticleID'), 3);
				$this->FirstRowData['ArticleNama'] = ewr_Conv($rs->fields('ArticleNama'), 200);
				$this->FirstRowData['HargaJual'] = ewr_Conv($rs->fields('HargaJual'), 4);
				$this->FirstRowData['Qty'] = ewr_Conv($rs->fields('Qty'), 4);
				$this->FirstRowData['SatuanNama'] = ewr_Conv($rs->fields('SatuanNama'), 200);
				$this->FirstRowData['SubTotal'] = ewr_Conv($rs->fields('SubTotal'), 4);
			}
		} else { // Get next row
			$rs->MoveNext();
		}
		if (!$rs->EOF) {
			if ($opt <> 1) {
				if (is_array($this->TglSO->GroupDbValues))
					$this->TglSO->setDbValue(@$this->TglSO->GroupDbValues[$rs->fields('TglSO')]);
				else
					$this->TglSO->setDbValue(ewr_GroupValue($this->TglSO, $rs->fields('TglSO')));
			}
			$this->NoSO->setDbValue($rs->fields('NoSO'));
			$this->CustomerID->setDbValue($rs->fields('CustomerID'));
			$this->CustomerNama->setDbValue($rs->fields('CustomerNama'));
			$this->CustomerPO->setDbValue($rs->fields('CustomerPO'));
			$this->ArticleID->setDbValue($rs->fields('ArticleID'));
			$this->ArticleNama->setDbValue($rs->fields('ArticleNama'));
			$this->HargaJual->setDbValue($rs->fields('HargaJual'));
			$this->Qty->setDbValue($rs->fields('Qty'));
			$this->SatuanNama->setDbValue($rs->fields('SatuanNama'));
			$this->SubTotal->setDbValue($rs->fields('SubTotal'));
			$this->Val[1] = $this->ArticleNama->CurrentValue;
			$this->Val[2] = $this->HargaJual->CurrentValue;
			$this->Val[3] = $this->Qty->CurrentValue;
			$this->Val[4] = $this->SatuanNama->CurrentValue;
			$this->Val[5] = $this->SubTotal->CurrentValue;
		} else {
			$this->TglSO->setDbValue("");
			$this->NoSO->setDbValue("");
			$this->CustomerID->setDbValue("");
			$this->CustomerNama->setDbValue("");
			$this->CustomerPO->setDbValue("");
			$this->ArticleID->setDbValue("");
			$this->ArticleNama->setDbValue("");
			$this->HargaJual->setDbValue("");
			$this->Qty->setDbValue("");
			$this->SatuanNama->setDbValue("");
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
			if ($this->RowTotalType == EWR_ROWTOTAL_GROUP) $this->RowAttrs["data-group"] = $this->TglSO->GroupOldValue(); // Set up group attribute
			if ($this->RowTotalType == EWR_ROWTOTAL_GROUP && $this->RowGroupLevel >= 2) $this->RowAttrs["data-group-2"] = $this->NoSO->GroupOldValue(); // Set up group attribute 2
			if ($this->RowTotalType == EWR_ROWTOTAL_GROUP && $this->RowGroupLevel >= 3) $this->RowAttrs["data-group-3"] = $this->CustomerNama->GroupOldValue(); // Set up group attribute 3
			if ($this->RowTotalType == EWR_ROWTOTAL_GROUP && $this->RowGroupLevel >= 4) $this->RowAttrs["data-group-4"] = $this->CustomerPO->GroupOldValue(); // Set up group attribute 4

			// TglSO
			$this->TglSO->GroupViewValue = $this->TglSO->GroupOldValue();
			$this->TglSO->GroupViewValue = ewr_FormatDateTime($this->TglSO->GroupViewValue, 7);
			$this->TglSO->CellAttrs["class"] = ($this->RowGroupLevel == 1) ? "ewRptGrpSummary1" : "ewRptGrpField1";
			$this->TglSO->GroupViewValue = ewr_DisplayGroupValue($this->TglSO, $this->TglSO->GroupViewValue);
			$this->TglSO->GroupSummaryOldValue = $this->TglSO->GroupSummaryValue;
			$this->TglSO->GroupSummaryValue = $this->TglSO->GroupViewValue;
			$this->TglSO->GroupSummaryViewValue = ($this->TglSO->GroupSummaryOldValue <> $this->TglSO->GroupSummaryValue) ? $this->TglSO->GroupSummaryValue : "&nbsp;";

			// NoSO
			$this->NoSO->GroupViewValue = $this->NoSO->GroupOldValue();
			$this->NoSO->CellAttrs["class"] = ($this->RowGroupLevel == 2) ? "ewRptGrpSummary2" : "ewRptGrpField2";
			$this->NoSO->GroupViewValue = ewr_DisplayGroupValue($this->NoSO, $this->NoSO->GroupViewValue);
			$this->NoSO->GroupSummaryOldValue = $this->NoSO->GroupSummaryValue;
			$this->NoSO->GroupSummaryValue = $this->NoSO->GroupViewValue;
			$this->NoSO->GroupSummaryViewValue = ($this->NoSO->GroupSummaryOldValue <> $this->NoSO->GroupSummaryValue) ? $this->NoSO->GroupSummaryValue : "&nbsp;";

			// CustomerNama
			$this->CustomerNama->GroupViewValue = $this->CustomerNama->GroupOldValue();
			$this->CustomerNama->CellAttrs["class"] = ($this->RowGroupLevel == 3) ? "ewRptGrpSummary3" : "ewRptGrpField3";
			$this->CustomerNama->GroupViewValue = ewr_DisplayGroupValue($this->CustomerNama, $this->CustomerNama->GroupViewValue);
			$this->CustomerNama->GroupSummaryOldValue = $this->CustomerNama->GroupSummaryValue;
			$this->CustomerNama->GroupSummaryValue = $this->CustomerNama->GroupViewValue;
			$this->CustomerNama->GroupSummaryViewValue = ($this->CustomerNama->GroupSummaryOldValue <> $this->CustomerNama->GroupSummaryValue) ? $this->CustomerNama->GroupSummaryValue : "&nbsp;";

			// CustomerPO
			$this->CustomerPO->GroupViewValue = $this->CustomerPO->GroupOldValue();
			$this->CustomerPO->CellAttrs["class"] = ($this->RowGroupLevel == 4) ? "ewRptGrpSummary4" : "ewRptGrpField4";
			$this->CustomerPO->GroupViewValue = ewr_DisplayGroupValue($this->CustomerPO, $this->CustomerPO->GroupViewValue);
			$this->CustomerPO->GroupSummaryOldValue = $this->CustomerPO->GroupSummaryValue;
			$this->CustomerPO->GroupSummaryValue = $this->CustomerPO->GroupViewValue;
			$this->CustomerPO->GroupSummaryViewValue = ($this->CustomerPO->GroupSummaryOldValue <> $this->CustomerPO->GroupSummaryValue) ? $this->CustomerPO->GroupSummaryValue : "&nbsp;";

			// SubTotal
			$this->SubTotal->SumViewValue = $this->SubTotal->SumValue;
			$this->SubTotal->SumViewValue = ewr_FormatNumber($this->SubTotal->SumViewValue, 2, -2, -2, -2);
			$this->SubTotal->CellAttrs["style"] = "text-align:right;";
			$this->SubTotal->CellAttrs["class"] = ($this->RowTotalType == EWR_ROWTOTAL_PAGE || $this->RowTotalType == EWR_ROWTOTAL_GRAND) ? "ewRptGrpAggregate" : "ewRptGrpSummary" . $this->RowGroupLevel;

			// TglSO
			$this->TglSO->HrefValue = "";

			// NoSO
			$this->NoSO->HrefValue = "";

			// CustomerNama
			$this->CustomerNama->HrefValue = "";

			// CustomerPO
			$this->CustomerPO->HrefValue = "";

			// ArticleNama
			$this->ArticleNama->HrefValue = "";

			// HargaJual
			$this->HargaJual->HrefValue = "";

			// Qty
			$this->Qty->HrefValue = "";

			// SatuanNama
			$this->SatuanNama->HrefValue = "";

			// SubTotal
			$this->SubTotal->HrefValue = "";
		} else {
			if ($this->RowTotalType == EWR_ROWTOTAL_GROUP && $this->RowTotalSubType == EWR_ROWTOTAL_HEADER) {
			$this->RowAttrs["data-group"] = $this->TglSO->GroupValue(); // Set up group attribute
			if ($this->RowGroupLevel >= 2) $this->RowAttrs["data-group-2"] = $this->NoSO->GroupValue(); // Set up group attribute 2
			if ($this->RowGroupLevel >= 3) $this->RowAttrs["data-group-3"] = $this->CustomerNama->GroupValue(); // Set up group attribute 3
			if ($this->RowGroupLevel >= 4) $this->RowAttrs["data-group-4"] = $this->CustomerPO->GroupValue(); // Set up group attribute 4
			} else {
			$this->RowAttrs["data-group"] = $this->TglSO->GroupValue(); // Set up group attribute
			$this->RowAttrs["data-group-2"] = $this->NoSO->GroupValue(); // Set up group attribute 2
			$this->RowAttrs["data-group-3"] = $this->CustomerNama->GroupValue(); // Set up group attribute 3
			$this->RowAttrs["data-group-4"] = $this->CustomerPO->GroupValue(); // Set up group attribute 4
			}

			// TglSO
			$this->TglSO->GroupViewValue = $this->TglSO->GroupValue();
			$this->TglSO->GroupViewValue = ewr_FormatDateTime($this->TglSO->GroupViewValue, 7);
			$this->TglSO->CellAttrs["class"] = "ewRptGrpField1";
			$this->TglSO->GroupViewValue = ewr_DisplayGroupValue($this->TglSO, $this->TglSO->GroupViewValue);
			if ($this->TglSO->GroupValue() == $this->TglSO->GroupOldValue() && !$this->ChkLvlBreak(1))
				$this->TglSO->GroupViewValue = "&nbsp;";

			// NoSO
			$this->NoSO->GroupViewValue = $this->NoSO->GroupValue();
			$this->NoSO->CellAttrs["class"] = "ewRptGrpField2";
			$this->NoSO->GroupViewValue = ewr_DisplayGroupValue($this->NoSO, $this->NoSO->GroupViewValue);
			if ($this->NoSO->GroupValue() == $this->NoSO->GroupOldValue() && !$this->ChkLvlBreak(2))
				$this->NoSO->GroupViewValue = "&nbsp;";

			// CustomerNama
			$this->CustomerNama->GroupViewValue = $this->CustomerNama->GroupValue();
			$this->CustomerNama->CellAttrs["class"] = "ewRptGrpField3";
			$this->CustomerNama->GroupViewValue = ewr_DisplayGroupValue($this->CustomerNama, $this->CustomerNama->GroupViewValue);
			if ($this->CustomerNama->GroupValue() == $this->CustomerNama->GroupOldValue() && !$this->ChkLvlBreak(3))
				$this->CustomerNama->GroupViewValue = "&nbsp;";

			// CustomerPO
			$this->CustomerPO->GroupViewValue = $this->CustomerPO->GroupValue();
			$this->CustomerPO->CellAttrs["class"] = "ewRptGrpField4";
			$this->CustomerPO->GroupViewValue = ewr_DisplayGroupValue($this->CustomerPO, $this->CustomerPO->GroupViewValue);
			if ($this->CustomerPO->GroupValue() == $this->CustomerPO->GroupOldValue() && !$this->ChkLvlBreak(4))
				$this->CustomerPO->GroupViewValue = "&nbsp;";

			// ArticleNama
			$this->ArticleNama->ViewValue = $this->ArticleNama->CurrentValue;
			$this->ArticleNama->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// HargaJual
			$this->HargaJual->ViewValue = $this->HargaJual->CurrentValue;
			$this->HargaJual->ViewValue = ewr_FormatNumber($this->HargaJual->ViewValue, 2, -2, -2, -2);
			$this->HargaJual->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
			$this->HargaJual->CellAttrs["style"] = "text-align:right;";

			// Qty
			$this->Qty->ViewValue = $this->Qty->CurrentValue;
			$this->Qty->ViewValue = ewr_FormatNumber($this->Qty->ViewValue, 2, -2, -2, -2);
			$this->Qty->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
			$this->Qty->CellAttrs["style"] = "text-align:right;";

			// SatuanNama
			$this->SatuanNama->ViewValue = $this->SatuanNama->CurrentValue;
			$this->SatuanNama->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// SubTotal
			$this->SubTotal->ViewValue = $this->SubTotal->CurrentValue;
			$this->SubTotal->ViewValue = ewr_FormatNumber($this->SubTotal->ViewValue, 2, -2, -2, -2);
			$this->SubTotal->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
			$this->SubTotal->CellAttrs["style"] = "text-align:right;";

			// TglSO
			$this->TglSO->HrefValue = "";

			// NoSO
			$this->NoSO->HrefValue = "";

			// CustomerNama
			$this->CustomerNama->HrefValue = "";

			// CustomerPO
			$this->CustomerPO->HrefValue = "";

			// ArticleNama
			$this->ArticleNama->HrefValue = "";

			// HargaJual
			$this->HargaJual->HrefValue = "";

			// Qty
			$this->Qty->HrefValue = "";

			// SatuanNama
			$this->SatuanNama->HrefValue = "";

			// SubTotal
			$this->SubTotal->HrefValue = "";
		}

		// Call Cell_Rendered event
		if ($this->RowType == EWR_ROWTYPE_TOTAL) { // Summary row

			// TglSO
			$CurrentValue = $this->TglSO->GroupViewValue;
			$ViewValue = &$this->TglSO->GroupViewValue;
			$ViewAttrs = &$this->TglSO->ViewAttrs;
			$CellAttrs = &$this->TglSO->CellAttrs;
			$HrefValue = &$this->TglSO->HrefValue;
			$LinkAttrs = &$this->TglSO->LinkAttrs;
			$this->Cell_Rendered($this->TglSO, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// NoSO
			$CurrentValue = $this->NoSO->GroupViewValue;
			$ViewValue = &$this->NoSO->GroupViewValue;
			$ViewAttrs = &$this->NoSO->ViewAttrs;
			$CellAttrs = &$this->NoSO->CellAttrs;
			$HrefValue = &$this->NoSO->HrefValue;
			$LinkAttrs = &$this->NoSO->LinkAttrs;
			$this->Cell_Rendered($this->NoSO, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// CustomerNama
			$CurrentValue = $this->CustomerNama->GroupViewValue;
			$ViewValue = &$this->CustomerNama->GroupViewValue;
			$ViewAttrs = &$this->CustomerNama->ViewAttrs;
			$CellAttrs = &$this->CustomerNama->CellAttrs;
			$HrefValue = &$this->CustomerNama->HrefValue;
			$LinkAttrs = &$this->CustomerNama->LinkAttrs;
			$this->Cell_Rendered($this->CustomerNama, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// CustomerPO
			$CurrentValue = $this->CustomerPO->GroupViewValue;
			$ViewValue = &$this->CustomerPO->GroupViewValue;
			$ViewAttrs = &$this->CustomerPO->ViewAttrs;
			$CellAttrs = &$this->CustomerPO->CellAttrs;
			$HrefValue = &$this->CustomerPO->HrefValue;
			$LinkAttrs = &$this->CustomerPO->LinkAttrs;
			$this->Cell_Rendered($this->CustomerPO, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// SubTotal
			$CurrentValue = $this->SubTotal->SumValue;
			$ViewValue = &$this->SubTotal->SumViewValue;
			$ViewAttrs = &$this->SubTotal->ViewAttrs;
			$CellAttrs = &$this->SubTotal->CellAttrs;
			$HrefValue = &$this->SubTotal->HrefValue;
			$LinkAttrs = &$this->SubTotal->LinkAttrs;
			$this->Cell_Rendered($this->SubTotal, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);
		} else {

			// TglSO
			$CurrentValue = $this->TglSO->GroupValue();
			$ViewValue = &$this->TglSO->GroupViewValue;
			$ViewAttrs = &$this->TglSO->ViewAttrs;
			$CellAttrs = &$this->TglSO->CellAttrs;
			$HrefValue = &$this->TglSO->HrefValue;
			$LinkAttrs = &$this->TglSO->LinkAttrs;
			$this->Cell_Rendered($this->TglSO, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// NoSO
			$CurrentValue = $this->NoSO->GroupValue();
			$ViewValue = &$this->NoSO->GroupViewValue;
			$ViewAttrs = &$this->NoSO->ViewAttrs;
			$CellAttrs = &$this->NoSO->CellAttrs;
			$HrefValue = &$this->NoSO->HrefValue;
			$LinkAttrs = &$this->NoSO->LinkAttrs;
			$this->Cell_Rendered($this->NoSO, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// CustomerNama
			$CurrentValue = $this->CustomerNama->GroupValue();
			$ViewValue = &$this->CustomerNama->GroupViewValue;
			$ViewAttrs = &$this->CustomerNama->ViewAttrs;
			$CellAttrs = &$this->CustomerNama->CellAttrs;
			$HrefValue = &$this->CustomerNama->HrefValue;
			$LinkAttrs = &$this->CustomerNama->LinkAttrs;
			$this->Cell_Rendered($this->CustomerNama, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// CustomerPO
			$CurrentValue = $this->CustomerPO->GroupValue();
			$ViewValue = &$this->CustomerPO->GroupViewValue;
			$ViewAttrs = &$this->CustomerPO->ViewAttrs;
			$CellAttrs = &$this->CustomerPO->CellAttrs;
			$HrefValue = &$this->CustomerPO->HrefValue;
			$LinkAttrs = &$this->CustomerPO->LinkAttrs;
			$this->Cell_Rendered($this->CustomerPO, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// ArticleNama
			$CurrentValue = $this->ArticleNama->CurrentValue;
			$ViewValue = &$this->ArticleNama->ViewValue;
			$ViewAttrs = &$this->ArticleNama->ViewAttrs;
			$CellAttrs = &$this->ArticleNama->CellAttrs;
			$HrefValue = &$this->ArticleNama->HrefValue;
			$LinkAttrs = &$this->ArticleNama->LinkAttrs;
			$this->Cell_Rendered($this->ArticleNama, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// HargaJual
			$CurrentValue = $this->HargaJual->CurrentValue;
			$ViewValue = &$this->HargaJual->ViewValue;
			$ViewAttrs = &$this->HargaJual->ViewAttrs;
			$CellAttrs = &$this->HargaJual->CellAttrs;
			$HrefValue = &$this->HargaJual->HrefValue;
			$LinkAttrs = &$this->HargaJual->LinkAttrs;
			$this->Cell_Rendered($this->HargaJual, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// Qty
			$CurrentValue = $this->Qty->CurrentValue;
			$ViewValue = &$this->Qty->ViewValue;
			$ViewAttrs = &$this->Qty->ViewAttrs;
			$CellAttrs = &$this->Qty->CellAttrs;
			$HrefValue = &$this->Qty->HrefValue;
			$LinkAttrs = &$this->Qty->LinkAttrs;
			$this->Cell_Rendered($this->Qty, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// SatuanNama
			$CurrentValue = $this->SatuanNama->CurrentValue;
			$ViewValue = &$this->SatuanNama->ViewValue;
			$ViewAttrs = &$this->SatuanNama->ViewAttrs;
			$CellAttrs = &$this->SatuanNama->CellAttrs;
			$HrefValue = &$this->SatuanNama->HrefValue;
			$LinkAttrs = &$this->SatuanNama->LinkAttrs;
			$this->Cell_Rendered($this->SatuanNama, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

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
		if ($this->TglSO->Visible) $this->GrpColumnCount += 1;
		if ($this->NoSO->Visible) { $this->GrpColumnCount += 1; $this->SubGrpColumnCount += 1; }
		if ($this->CustomerNama->Visible) { $this->GrpColumnCount += 1; $this->SubGrpColumnCount += 1; }
		if ($this->CustomerPO->Visible) { $this->GrpColumnCount += 1; $this->SubGrpColumnCount += 1; }
		if ($this->ArticleNama->Visible) $this->DtlColumnCount += 1;
		if ($this->HargaJual->Visible) $this->DtlColumnCount += 1;
		if ($this->Qty->Visible) $this->DtlColumnCount += 1;
		if ($this->SatuanNama->Visible) $this->DtlColumnCount += 1;
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
			$this->SetSessionFilterValues($this->TglSO->SearchValue, $this->TglSO->SearchOperator, $this->TglSO->SearchCondition, $this->TglSO->SearchValue2, $this->TglSO->SearchOperator2, 'TglSO'); // Field TglSO
			$this->SetSessionDropDownValue($this->CustomerNama->DropDownValue, $this->CustomerNama->SearchOperator, 'CustomerNama'); // Field CustomerNama
			$this->SetSessionDropDownValue($this->ArticleNama->DropDownValue, $this->ArticleNama->SearchOperator, 'ArticleNama'); // Field ArticleNama

			//$bSetupFilter = TRUE; // No need to set up, just use default
		} else {
			$bRestoreSession = !$this->SearchCommand;

			// Field TglSO
			if ($this->GetFilterValues($this->TglSO)) {
				$bSetupFilter = TRUE;
			}

			// Field CustomerNama
			if ($this->GetDropDownValue($this->CustomerNama)) {
				$bSetupFilter = TRUE;
			} elseif ($this->CustomerNama->DropDownValue <> EWR_INIT_VALUE && !isset($_SESSION['sv_r04_jual_CustomerNama'])) {
				$bSetupFilter = TRUE;
			}

			// Field ArticleNama
			if ($this->GetDropDownValue($this->ArticleNama)) {
				$bSetupFilter = TRUE;
			} elseif ($this->ArticleNama->DropDownValue <> EWR_INIT_VALUE && !isset($_SESSION['sv_r04_jual_ArticleNama'])) {
				$bSetupFilter = TRUE;
			}
			if (!$this->ValidateForm()) {
				$this->setFailureMessage($grFormError);
				return $sFilter;
			}
		}

		// Restore session
		if ($bRestoreSession) {
			$this->GetSessionFilterValues($this->TglSO); // Field TglSO
			$this->GetSessionDropDownValue($this->CustomerNama); // Field CustomerNama
			$this->GetSessionDropDownValue($this->ArticleNama); // Field ArticleNama
		}

		// Call page filter validated event
		$this->Page_FilterValidated();

		// Build SQL
		$this->BuildExtendedFilter($this->TglSO, $sFilter, FALSE, TRUE); // Field TglSO
		$this->BuildDropDownFilter($this->CustomerNama, $sFilter, $this->CustomerNama->SearchOperator, FALSE, TRUE); // Field CustomerNama
		$this->BuildDropDownFilter($this->ArticleNama, $sFilter, $this->ArticleNama->SearchOperator, FALSE, TRUE); // Field ArticleNama

		// Save parms to session
		$this->SetSessionFilterValues($this->TglSO->SearchValue, $this->TglSO->SearchOperator, $this->TglSO->SearchCondition, $this->TglSO->SearchValue2, $this->TglSO->SearchOperator2, 'TglSO'); // Field TglSO
		$this->SetSessionDropDownValue($this->CustomerNama->DropDownValue, $this->CustomerNama->SearchOperator, 'CustomerNama'); // Field CustomerNama
		$this->SetSessionDropDownValue($this->ArticleNama->DropDownValue, $this->ArticleNama->SearchOperator, 'ArticleNama'); // Field ArticleNama

		// Setup filter
		if ($bSetupFilter) {
		}

		// Field CustomerNama
		ewr_LoadDropDownList($this->CustomerNama->DropDownList, $this->CustomerNama->DropDownValue);

		// Field ArticleNama
		ewr_LoadDropDownList($this->ArticleNama->DropDownList, $this->ArticleNama->DropDownValue);
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
		$this->GetSessionValue($fld->DropDownValue, 'sv_r04_jual_' . $parm);
		$this->GetSessionValue($fld->SearchOperator, 'so_r04_jual_' . $parm);
	}

	// Get filter values from session
	function GetSessionFilterValues(&$fld) {
		$parm = substr($fld->FldVar, 2);
		$this->GetSessionValue($fld->SearchValue, 'sv_r04_jual_' . $parm);
		$this->GetSessionValue($fld->SearchOperator, 'so_r04_jual_' . $parm);
		$this->GetSessionValue($fld->SearchCondition, 'sc_r04_jual_' . $parm);
		$this->GetSessionValue($fld->SearchValue2, 'sv2_r04_jual_' . $parm);
		$this->GetSessionValue($fld->SearchOperator2, 'so2_r04_jual_' . $parm);
	}

	// Get value from session
	function GetSessionValue(&$sv, $sn) {
		if (array_key_exists($sn, $_SESSION))
			$sv = $_SESSION[$sn];
	}

	// Set dropdown value to session
	function SetSessionDropDownValue($sv, $so, $parm) {
		$_SESSION['sv_r04_jual_' . $parm] = $sv;
		$_SESSION['so_r04_jual_' . $parm] = $so;
	}

	// Set filter values to session
	function SetSessionFilterValues($sv1, $so1, $sc, $sv2, $so2, $parm) {
		$_SESSION['sv_r04_jual_' . $parm] = $sv1;
		$_SESSION['so_r04_jual_' . $parm] = $so1;
		$_SESSION['sc_r04_jual_' . $parm] = $sc;
		$_SESSION['sv2_r04_jual_' . $parm] = $sv2;
		$_SESSION['so2_r04_jual_' . $parm] = $so2;
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
		if (!ewr_CheckEuroDate($this->TglSO->SearchValue)) {
			if ($grFormError <> "") $grFormError .= "<br>";
			$grFormError .= $this->TglSO->FldErrMsg();
		}
		if (!ewr_CheckEuroDate($this->TglSO->SearchValue2)) {
			if ($grFormError <> "") $grFormError .= "<br>";
			$grFormError .= $this->TglSO->FldErrMsg();
		}

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
		$_SESSION["sel_r04_jual_$parm"] = "";
		$_SESSION["rf_r04_jual_$parm"] = "";
		$_SESSION["rt_r04_jual_$parm"] = "";
	}

	// Load selection from session
	function LoadSelectionFromSession($parm) {
		$fld = &$this->FieldByParm($parm);
		$fld->SelectionList = @$_SESSION["sel_r04_jual_$parm"];
		$fld->RangeFrom = @$_SESSION["rf_r04_jual_$parm"];
		$fld->RangeTo = @$_SESSION["rt_r04_jual_$parm"];
	}

	// Load default value for filters
	function LoadDefaultFilters() {
		/**
		* Set up default values for non Text filters
		*/

		// Field CustomerNama
		$this->CustomerNama->DefaultDropDownValue = EWR_INIT_VALUE;
		if (!$this->SearchCommand) $this->CustomerNama->DropDownValue = $this->CustomerNama->DefaultDropDownValue;

		// Field ArticleNama
		$this->ArticleNama->DefaultDropDownValue = EWR_INIT_VALUE;
		if (!$this->SearchCommand) $this->ArticleNama->DropDownValue = $this->ArticleNama->DefaultDropDownValue;
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

		// Field TglSO
		$this->SetDefaultExtFilter($this->TglSO, "BETWEEN", NULL, 'AND', "=", NULL);
		if (!$this->SearchCommand) $this->ApplyDefaultExtFilter($this->TglSO);
		/**
		* Set up default values for popup filters
		*/
	}

	// Check if filter applied
	function CheckFilter() {

		// Check TglSO text filter
		if ($this->TextFilterApplied($this->TglSO))
			return TRUE;

		// Check CustomerNama extended filter
		if ($this->NonTextFilterApplied($this->CustomerNama))
			return TRUE;

		// Check ArticleNama extended filter
		if ($this->NonTextFilterApplied($this->ArticleNama))
			return TRUE;
		return FALSE;
	}

	// Show list of filters
	function ShowFilterList($showDate = FALSE) {
		global $ReportLanguage;

		// Initialize
		$sFilterList = "";

		// Field TglSO
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($this->TglSO, $sExtWrk);
		$sFilter = "";
		if ($sExtWrk <> "")
			$sFilter .= "<span class=\"ewFilterValue\">$sExtWrk</span>";
		elseif ($sWrk <> "")
			$sFilter .= "<span class=\"ewFilterValue\">$sWrk</span>";
		if ($sFilter <> "")
			$sFilterList .= "<div><span class=\"ewFilterCaption\">" . $this->TglSO->FldCaption() . "</span>" . $sFilter . "</div>";

		// Field CustomerNama
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildDropDownFilter($this->CustomerNama, $sExtWrk, $this->CustomerNama->SearchOperator);
		$sFilter = "";
		if ($sExtWrk <> "")
			$sFilter .= "<span class=\"ewFilterValue\">$sExtWrk</span>";
		elseif ($sWrk <> "")
			$sFilter .= "<span class=\"ewFilterValue\">$sWrk</span>";
		if ($sFilter <> "")
			$sFilterList .= "<div><span class=\"ewFilterCaption\">" . $this->CustomerNama->FldCaption() . "</span>" . $sFilter . "</div>";

		// Field ArticleNama
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildDropDownFilter($this->ArticleNama, $sExtWrk, $this->ArticleNama->SearchOperator);
		$sFilter = "";
		if ($sExtWrk <> "")
			$sFilter .= "<span class=\"ewFilterValue\">$sExtWrk</span>";
		elseif ($sWrk <> "")
			$sFilter .= "<span class=\"ewFilterValue\">$sWrk</span>";
		if ($sFilter <> "")
			$sFilterList .= "<div><span class=\"ewFilterCaption\">" . $this->ArticleNama->FldCaption() . "</span>" . $sFilter . "</div>";
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

		// Field TglSO
		$sWrk = "";
		if ($this->TglSO->SearchValue <> "" || $this->TglSO->SearchValue2 <> "") {
			$sWrk = "\"sv_TglSO\":\"" . ewr_JsEncode2($this->TglSO->SearchValue) . "\"," .
				"\"so_TglSO\":\"" . ewr_JsEncode2($this->TglSO->SearchOperator) . "\"," .
				"\"sc_TglSO\":\"" . ewr_JsEncode2($this->TglSO->SearchCondition) . "\"," .
				"\"sv2_TglSO\":\"" . ewr_JsEncode2($this->TglSO->SearchValue2) . "\"," .
				"\"so2_TglSO\":\"" . ewr_JsEncode2($this->TglSO->SearchOperator2) . "\"";
		}
		if ($sWrk <> "") {
			if ($sFilterList <> "") $sFilterList .= ",";
			$sFilterList .= $sWrk;
		}

		// Field CustomerNama
		$sWrk = "";
		$sWrk = ($this->CustomerNama->DropDownValue <> EWR_INIT_VALUE) ? $this->CustomerNama->DropDownValue : "";
		if (is_array($sWrk))
			$sWrk = implode("||", $sWrk);
		if ($sWrk <> "")
			$sWrk = "\"sv_CustomerNama\":\"" . ewr_JsEncode2($sWrk) . "\"";
		if ($sWrk <> "") {
			if ($sFilterList <> "") $sFilterList .= ",";
			$sFilterList .= $sWrk;
		}

		// Field ArticleNama
		$sWrk = "";
		$sWrk = ($this->ArticleNama->DropDownValue <> EWR_INIT_VALUE) ? $this->ArticleNama->DropDownValue : "";
		if (is_array($sWrk))
			$sWrk = implode("||", $sWrk);
		if ($sWrk <> "")
			$sWrk = "\"sv_ArticleNama\":\"" . ewr_JsEncode2($sWrk) . "\"";
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

		// Field TglSO
		$bRestoreFilter = FALSE;
		if (array_key_exists("sv_TglSO", $filter) || array_key_exists("so_TglSO", $filter) ||
			array_key_exists("sc_TglSO", $filter) ||
			array_key_exists("sv2_TglSO", $filter) || array_key_exists("so2_TglSO", $filter)) {
			$this->SetSessionFilterValues(@$filter["sv_TglSO"], @$filter["so_TglSO"], @$filter["sc_TglSO"], @$filter["sv2_TglSO"], @$filter["so2_TglSO"], "TglSO");
			$bRestoreFilter = TRUE;
		}
		if (!$bRestoreFilter) { // Clear filter
			$this->SetSessionFilterValues("", "=", "AND", "", "=", "TglSO");
		}

		// Field CustomerNama
		$bRestoreFilter = FALSE;
		if (array_key_exists("sv_CustomerNama", $filter)) {
			$sWrk = $filter["sv_CustomerNama"];
			if (strpos($sWrk, "||") !== FALSE)
				$sWrk = explode("||", $sWrk);
			$this->SetSessionDropDownValue($sWrk, @$filter["so_CustomerNama"], "CustomerNama");
			$bRestoreFilter = TRUE;
		}
		if (!$bRestoreFilter) { // Clear filter
			$this->SetSessionDropDownValue(EWR_INIT_VALUE, "", "CustomerNama");
		}

		// Field ArticleNama
		$bRestoreFilter = FALSE;
		if (array_key_exists("sv_ArticleNama", $filter)) {
			$sWrk = $filter["sv_ArticleNama"];
			if (strpos($sWrk, "||") !== FALSE)
				$sWrk = explode("||", $sWrk);
			$this->SetSessionDropDownValue($sWrk, @$filter["so_ArticleNama"], "ArticleNama");
			$bRestoreFilter = TRUE;
		}
		if (!$bRestoreFilter) { // Clear filter
			$this->SetSessionDropDownValue(EWR_INIT_VALUE, "", "ArticleNama");
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
			$this->TglSO->setSort("");
			$this->NoSO->setSort("");
			$this->CustomerNama->setSort("");
			$this->CustomerPO->setSort("");
			$this->ArticleNama->setSort("");
			$this->HargaJual->setSort("");
			$this->Qty->setSort("");
			$this->SatuanNama->setSort("");
			$this->SubTotal->setSort("");

		// Check for an Order parameter
		} elseif ($orderBy <> "") {
			$this->CurrentOrder = $orderBy;
			$this->CurrentOrderType = $orderType;
			$this->UpdateSort($this->TglSO, $bCtrl); // TglSO
			$this->UpdateSort($this->NoSO, $bCtrl); // NoSO
			$this->UpdateSort($this->CustomerNama, $bCtrl); // CustomerNama
			$this->UpdateSort($this->CustomerPO, $bCtrl); // CustomerPO
			$this->UpdateSort($this->ArticleNama, $bCtrl); // ArticleNama
			$this->UpdateSort($this->HargaJual, $bCtrl); // HargaJual
			$this->UpdateSort($this->Qty, $bCtrl); // Qty
			$this->UpdateSort($this->SatuanNama, $bCtrl); // SatuanNama
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
if (!isset($r04_jual_summary)) $r04_jual_summary = new crr04_jual_summary();
if (isset($Page)) $OldPage = $Page;
$Page = &$r04_jual_summary;

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
var r04_jual_summary = new ewr_Page("r04_jual_summary");

// Page properties
r04_jual_summary.PageID = "summary"; // Page ID
var EWR_PAGE_ID = r04_jual_summary.PageID;
</script>
<?php } ?>
<?php if ($Page->Export == "" && !$Page->DrillDown && !$grDashboardReport) { ?>
<script type="text/javascript">

// Form object
var CurrentForm = fr04_jualsummary = new ewr_Form("fr04_jualsummary");

// Validate method
fr04_jualsummary.Validate = function() {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.GetForm(), $fobj = $(fobj);
	var elm = fobj.sv_TglSO;
	if (elm && !ewr_CheckEuroDate(elm.value)) {
		if (!this.OnError(elm, "<?php echo ewr_JsEncode2($Page->TglSO->FldErrMsg()) ?>"))
			return false;
	}
	var elm = fobj.sv2_TglSO;
	if (elm && !ewr_CheckEuroDate(elm.value)) {
		if (!this.OnError(elm, "<?php echo ewr_JsEncode2($Page->TglSO->FldErrMsg()) ?>"))
			return false;
	}

	// Call Form Custom Validate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}

// Form_CustomValidate method
fr04_jualsummary.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }
<?php if (EWR_CLIENT_VALIDATE) { ?>
fr04_jualsummary.ValidateRequired = true; // Uses JavaScript validation
<?php } else { ?>
fr04_jualsummary.ValidateRequired = false; // No JavaScript validation
<?php } ?>

// Use Ajax
fr04_jualsummary.Lists["sv_CustomerNama"] = {"LinkField":"sv_CustomerNama","Ajax":true,"DisplayFields":["sv_CustomerNama","","",""],"ParentFields":[],"FilterFields":[],"Options":[],"Template":""};
fr04_jualsummary.Lists["sv_ArticleNama"] = {"LinkField":"sv_ArticleNama","Ajax":true,"DisplayFields":["sv_ArticleNama","","",""],"ParentFields":[],"FilterFields":[],"Options":[],"Template":""};
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
<form name="fr04_jualsummary" id="fr04_jualsummary" class="form-inline ewForm ewExtFilterForm" action="<?php echo ewr_CurrentPage() ?>">
<?php $SearchPanelClass = ($Page->Filter <> "") ? " in" : " in"; ?>
<div id="fr04_jualsummary_SearchPanel" class="ewSearchPanel collapse<?php echo $SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<div id="r_1" class="ewRow">
<div id="c_TglSO" class="ewCell form-group">
	<label for="sv_TglSO" class="ewSearchCaption ewLabel"><?php echo $Page->TglSO->FldCaption() ?></label>
	<span class="ewSearchOperator"><?php echo $ReportLanguage->Phrase("BETWEEN"); ?><input type="hidden" name="so_TglSO" id="so_TglSO" value="BETWEEN"></span>
	<span class="control-group ewSearchField">
<?php ewr_PrependClass($Page->TglSO->EditAttrs["class"], "form-control"); // PR8 ?>
<input type="text" data-table="r04_jual" data-field="x_TglSO" id="sv_TglSO" name="sv_TglSO" placeholder="<?php echo $Page->TglSO->PlaceHolder ?>" value="<?php echo ewr_HtmlEncode($Page->TglSO->SearchValue) ?>" data-calendar='true' data-options='{"ignoreReadonly":true,"useCurrent":false,"format":7}'<?php echo $Page->TglSO->EditAttributes() ?>>
</span>
	<span class="ewSearchCond btw1_TglSO"><?php echo $ReportLanguage->Phrase("AND") ?></span>
	<span class="ewSearchField btw1_TglSO">
<?php ewr_PrependClass($Page->TglSO->EditAttrs["class"], "form-control"); // PR8 ?>
<input type="text" data-table="r04_jual" data-field="x_TglSO" id="sv2_TglSO" name="sv2_TglSO" placeholder="<?php echo $Page->TglSO->PlaceHolder ?>" value="<?php echo ewr_HtmlEncode($Page->TglSO->SearchValue2) ?>" data-calendar='true' data-options='{"ignoreReadonly":true,"useCurrent":false,"format":7}'<?php echo $Page->TglSO->EditAttributes() ?>>
</span>
</div>
</div>
<div id="r_2" class="ewRow">
<div id="c_CustomerNama" class="ewCell form-group">
	<label for="sv_CustomerNama" class="ewSearchCaption ewLabel"><?php echo $Page->CustomerNama->FldCaption() ?></label>
	<span class="ewSearchField">
<?php ewr_PrependClass($Page->CustomerNama->EditAttrs["class"], "form-control"); ?>
<select data-table="r04_jual" data-field="x_CustomerNama" data-value-separator="<?php echo ewr_HtmlEncode(is_array($Page->CustomerNama->DisplayValueSeparator) ? json_encode($Page->CustomerNama->DisplayValueSeparator) : $Page->CustomerNama->DisplayValueSeparator) ?>" id="sv_CustomerNama" name="sv_CustomerNama"<?php echo $Page->CustomerNama->EditAttributes() ?>>
<option value=""><?php echo $ReportLanguage->Phrase("PleaseSelect") ?></option>
<?php
	$cntf = is_array($Page->CustomerNama->AdvancedFilters) ? count($Page->CustomerNama->AdvancedFilters) : 0;
	$cntd = is_array($Page->CustomerNama->DropDownList) ? count($Page->CustomerNama->DropDownList) : 0;
	$totcnt = $cntf + $cntd;
	$wrkcnt = 0;
	if ($cntf > 0) {
		foreach ($Page->CustomerNama->AdvancedFilters as $filter) {
			if ($filter->Enabled) {
				$selwrk = ewr_MatchedFilterValue($Page->CustomerNama->DropDownValue, $filter->ID) ? " selected" : "";
?>
<option value="<?php echo $filter->ID ?>"<?php echo $selwrk ?>><?php echo $filter->Name ?></option>
<?php
				$wrkcnt += 1;
			}
		}
	}
	for ($i = 0; $i < $cntd; $i++) {
		$selwrk = " selected";
?>
<option value="<?php echo $Page->CustomerNama->DropDownList[$i] ?>"<?php echo $selwrk ?>><?php echo ewr_DropDownDisplayValue($Page->CustomerNama->DropDownList[$i], "", 0) ?></option>
<?php
		$wrkcnt += 1;
	}
?>
</select>
<input type="hidden" name="s_sv_CustomerNama" id="s_sv_CustomerNama" value="<?php echo $Page->CustomerNama->LookupFilterQuery() ?>">
<script type="text/javascript">
fr04_jualsummary.Lists["sv_CustomerNama"].Options = <?php echo ewr_ArrayToJson($Page->CustomerNama->LookupFilterOptions) ?>;
</script>
</span>
</div>
</div>
<div id="r_3" class="ewRow">
<div id="c_ArticleNama" class="ewCell form-group">
	<label for="sv_ArticleNama" class="ewSearchCaption ewLabel"><?php echo $Page->ArticleNama->FldCaption() ?></label>
	<span class="ewSearchField">
<?php ewr_PrependClass($Page->ArticleNama->EditAttrs["class"], "form-control"); ?>
<select data-table="r04_jual" data-field="x_ArticleNama" data-value-separator="<?php echo ewr_HtmlEncode(is_array($Page->ArticleNama->DisplayValueSeparator) ? json_encode($Page->ArticleNama->DisplayValueSeparator) : $Page->ArticleNama->DisplayValueSeparator) ?>" id="sv_ArticleNama" name="sv_ArticleNama"<?php echo $Page->ArticleNama->EditAttributes() ?>>
<option value=""><?php echo $ReportLanguage->Phrase("PleaseSelect") ?></option>
<?php
	$cntf = is_array($Page->ArticleNama->AdvancedFilters) ? count($Page->ArticleNama->AdvancedFilters) : 0;
	$cntd = is_array($Page->ArticleNama->DropDownList) ? count($Page->ArticleNama->DropDownList) : 0;
	$totcnt = $cntf + $cntd;
	$wrkcnt = 0;
	if ($cntf > 0) {
		foreach ($Page->ArticleNama->AdvancedFilters as $filter) {
			if ($filter->Enabled) {
				$selwrk = ewr_MatchedFilterValue($Page->ArticleNama->DropDownValue, $filter->ID) ? " selected" : "";
?>
<option value="<?php echo $filter->ID ?>"<?php echo $selwrk ?>><?php echo $filter->Name ?></option>
<?php
				$wrkcnt += 1;
			}
		}
	}
	for ($i = 0; $i < $cntd; $i++) {
		$selwrk = " selected";
?>
<option value="<?php echo $Page->ArticleNama->DropDownList[$i] ?>"<?php echo $selwrk ?>><?php echo ewr_DropDownDisplayValue($Page->ArticleNama->DropDownList[$i], "", 0) ?></option>
<?php
		$wrkcnt += 1;
	}
?>
</select>
<input type="hidden" name="s_sv_ArticleNama" id="s_sv_ArticleNama" value="<?php echo $Page->ArticleNama->LookupFilterQuery() ?>">
<script type="text/javascript">
fr04_jualsummary.Lists["sv_ArticleNama"].Options = <?php echo ewr_ArrayToJson($Page->ArticleNama->LookupFilterOptions) ?>;
</script>
</span>
</div>
</div>
<div class="ewRow"><input type="submit" name="btnsubmit" id="btnsubmit" class="btn btn-primary" value="<?php echo $ReportLanguage->Phrase("Search") ?>">
<input type="reset" name="btnreset" id="btnreset" class="btn hide" value="<?php echo $ReportLanguage->Phrase("Reset") ?>"></div>
</div>
</form>
<script type="text/javascript">
fr04_jualsummary.Init();
fr04_jualsummary.FilterList = <?php echo $Page->GetFilterList() ?>;
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
	$Page->GrpCounter[1] = 1;
	$Page->GrpCounter[2] = 1;
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
<?php include "r04_jualsmrypager.php" ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
<?php if ($Page->Export <> "pdf") { ?>
</div>
<?php } ?>
<span data-class="tpb<?php echo $Page->GrpCount-1 ?>_r04_jual"><?php echo $Page->PageBreakContent ?></span>
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
<?php include "r04_jualsmrypager.php" ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<!-- Report grid (begin) -->
<?php if ($Page->Export <> "pdf") { ?>
<div id="gmp_r04_jual" class="<?php if (ewr_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<?php } ?>
<table class="<?php echo $Page->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($Page->TglSO->Visible) { ?>
	<?php if ($Page->TglSO->ShowGroupHeaderAsRow) { ?>
	<td data-field="TglSO">&nbsp;</td>
	<?php } else { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="TglSO"><div class="r04_jual_TglSO"><span class="ewTableHeaderCaption"><?php echo $Page->TglSO->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="TglSO">
<?php if ($Page->SortUrl($Page->TglSO) == "") { ?>
		<div class="ewTableHeaderBtn r04_jual_TglSO">
			<span class="ewTableHeaderCaption"><?php echo $Page->TglSO->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r04_jual_TglSO" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->TglSO) ?>',2);">
			<span class="ewTableHeaderCaption"><?php echo $Page->TglSO->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->TglSO->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->TglSO->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($Page->NoSO->Visible) { ?>
	<?php if ($Page->NoSO->ShowGroupHeaderAsRow) { ?>
	<td data-field="NoSO">&nbsp;</td>
	<?php } else { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="NoSO"><div class="r04_jual_NoSO"><span class="ewTableHeaderCaption"><?php echo $Page->NoSO->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="NoSO">
<?php if ($Page->SortUrl($Page->NoSO) == "") { ?>
		<div class="ewTableHeaderBtn r04_jual_NoSO">
			<span class="ewTableHeaderCaption"><?php echo $Page->NoSO->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r04_jual_NoSO" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->NoSO) ?>',2);">
			<span class="ewTableHeaderCaption"><?php echo $Page->NoSO->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->NoSO->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->NoSO->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($Page->CustomerNama->Visible) { ?>
	<?php if ($Page->CustomerNama->ShowGroupHeaderAsRow) { ?>
	<td data-field="CustomerNama">&nbsp;</td>
	<?php } else { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="CustomerNama"><div class="r04_jual_CustomerNama"><span class="ewTableHeaderCaption"><?php echo $Page->CustomerNama->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="CustomerNama">
<?php if ($Page->SortUrl($Page->CustomerNama) == "") { ?>
		<div class="ewTableHeaderBtn r04_jual_CustomerNama">
			<span class="ewTableHeaderCaption"><?php echo $Page->CustomerNama->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r04_jual_CustomerNama" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->CustomerNama) ?>',2);">
			<span class="ewTableHeaderCaption"><?php echo $Page->CustomerNama->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->CustomerNama->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->CustomerNama->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($Page->CustomerPO->Visible) { ?>
	<?php if ($Page->CustomerPO->ShowGroupHeaderAsRow) { ?>
	<td data-field="CustomerPO">&nbsp;</td>
	<?php } else { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="CustomerPO"><div class="r04_jual_CustomerPO"><span class="ewTableHeaderCaption"><?php echo $Page->CustomerPO->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="CustomerPO">
<?php if ($Page->SortUrl($Page->CustomerPO) == "") { ?>
		<div class="ewTableHeaderBtn r04_jual_CustomerPO">
			<span class="ewTableHeaderCaption"><?php echo $Page->CustomerPO->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r04_jual_CustomerPO" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->CustomerPO) ?>',2);">
			<span class="ewTableHeaderCaption"><?php echo $Page->CustomerPO->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->CustomerPO->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->CustomerPO->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($Page->ArticleNama->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="ArticleNama"><div class="r04_jual_ArticleNama"><span class="ewTableHeaderCaption"><?php echo $Page->ArticleNama->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="ArticleNama">
<?php if ($Page->SortUrl($Page->ArticleNama) == "") { ?>
		<div class="ewTableHeaderBtn r04_jual_ArticleNama">
			<span class="ewTableHeaderCaption"><?php echo $Page->ArticleNama->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r04_jual_ArticleNama" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->ArticleNama) ?>',2);">
			<span class="ewTableHeaderCaption"><?php echo $Page->ArticleNama->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->ArticleNama->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->ArticleNama->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->HargaJual->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="HargaJual"><div class="r04_jual_HargaJual" style="text-align: right;"><span class="ewTableHeaderCaption"><?php echo $Page->HargaJual->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="HargaJual">
<?php if ($Page->SortUrl($Page->HargaJual) == "") { ?>
		<div class="ewTableHeaderBtn r04_jual_HargaJual" style="text-align: right;">
			<span class="ewTableHeaderCaption"><?php echo $Page->HargaJual->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r04_jual_HargaJual" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->HargaJual) ?>',2);" style="text-align: right;">
			<span class="ewTableHeaderCaption"><?php echo $Page->HargaJual->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->HargaJual->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->HargaJual->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->Qty->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="Qty"><div class="r04_jual_Qty" style="text-align: right;"><span class="ewTableHeaderCaption"><?php echo $Page->Qty->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="Qty">
<?php if ($Page->SortUrl($Page->Qty) == "") { ?>
		<div class="ewTableHeaderBtn r04_jual_Qty" style="text-align: right;">
			<span class="ewTableHeaderCaption"><?php echo $Page->Qty->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r04_jual_Qty" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->Qty) ?>',2);" style="text-align: right;">
			<span class="ewTableHeaderCaption"><?php echo $Page->Qty->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->Qty->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->Qty->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->SatuanNama->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="SatuanNama"><div class="r04_jual_SatuanNama"><span class="ewTableHeaderCaption"><?php echo $Page->SatuanNama->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="SatuanNama">
<?php if ($Page->SortUrl($Page->SatuanNama) == "") { ?>
		<div class="ewTableHeaderBtn r04_jual_SatuanNama">
			<span class="ewTableHeaderCaption"><?php echo $Page->SatuanNama->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r04_jual_SatuanNama" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->SatuanNama) ?>',2);">
			<span class="ewTableHeaderCaption"><?php echo $Page->SatuanNama->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->SatuanNama->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->SatuanNama->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->SubTotal->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="SubTotal"><div class="r04_jual_SubTotal" style="text-align: right;"><span class="ewTableHeaderCaption"><?php echo $Page->SubTotal->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="SubTotal">
<?php if ($Page->SortUrl($Page->SubTotal) == "") { ?>
		<div class="ewTableHeaderBtn r04_jual_SubTotal" style="text-align: right;">
			<span class="ewTableHeaderCaption"><?php echo $Page->SubTotal->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer r04_jual_SubTotal" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->SubTotal) ?>',2);" style="text-align: right;">
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
	$sWhere = ewr_DetailFilterSql($Page->TglSO, $Page->getSqlFirstGroupField(), $Page->TglSO->GroupValue(), $Page->DBID);
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
	$Page->GrpIdx[$Page->GrpCount][] = array(-1);
	$Page->GrpIdx[$Page->GrpCount][][] = array(-1);
	while ($rs && !$rs->EOF) { // Loop detail records
		$Page->RecCount++;
		$Page->RecIndex++;
?>
<?php if ($Page->TglSO->Visible && $Page->ChkLvlBreak(1) && $Page->TglSO->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$Page->ResetAttrs();
		$Page->RowType = EWR_ROWTYPE_TOTAL;
		$Page->RowTotalType = EWR_ROWTOTAL_GROUP;
		$Page->RowTotalSubType = EWR_ROWTOTAL_HEADER;
		$Page->RowGroupLevel = 1;
		$Page->TglSO->Count = $Page->GetSummaryCount(1);
		$Page->RenderRow();
?>
	<tr<?php echo $Page->RowAttributes(); ?>>
<?php if ($Page->TglSO->Visible) { ?>
		<td data-field="TglSO"<?php echo $Page->TglSO->CellAttributes(); ?>><span class="ewGroupToggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="TglSO" colspan="<?php echo ($Page->GrpColumnCount + $Page->DtlColumnCount - 1) ?>"<?php echo $Page->TglSO->CellAttributes() ?>>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
		<span class="ewSummaryCaption r04_jual_TglSO"><span class="ewTableHeaderCaption"><?php echo $Page->TglSO->FldCaption() ?></span></span>
<?php } else { ?>
	<?php if ($Page->SortUrl($Page->TglSO) == "") { ?>
		<span class="ewSummaryCaption r04_jual_TglSO">
			<span class="ewTableHeaderCaption"><?php echo $Page->TglSO->FldCaption() ?></span>
		</span>
	<?php } else { ?>
		<span class="ewTableHeaderBtn ewPointer ewSummaryCaption r04_jual_TglSO" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->TglSO) ?>',2);">
			<span class="ewTableHeaderCaption"><?php echo $Page->TglSO->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->TglSO->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->TglSO->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</span>
	<?php } ?>
<?php } ?>
		<?php echo $ReportLanguage->Phrase("SummaryColon") ?>
<span data-class="tpx<?php echo $Page->GrpCount ?>_r04_jual_TglSO"<?php echo $Page->TglSO->ViewAttributes() ?>><?php echo $Page->TglSO->GroupViewValue ?></span>
		<span class="ewSummaryCount">(<span class="ewAggregateCaption"><?php echo $ReportLanguage->Phrase("RptCnt") ?></span><?php echo $ReportLanguage->Phrase("AggregateEqual") ?><span class="ewAggregateValue"><?php echo ewr_FormatNumber($Page->TglSO->Count,0,-2,-2,-2) ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php if ($Page->NoSO->Visible && $Page->ChkLvlBreak(2) && $Page->NoSO->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$Page->ResetAttrs();
		$Page->RowType = EWR_ROWTYPE_TOTAL;
		$Page->RowTotalType = EWR_ROWTOTAL_GROUP;
		$Page->RowTotalSubType = EWR_ROWTOTAL_HEADER;
		$Page->RowGroupLevel = 2;
		$Page->NoSO->Count = $Page->GetSummaryCount(2);
		$Page->RenderRow();
?>
	<tr<?php echo $Page->RowAttributes(); ?>>
<?php if ($Page->TglSO->Visible) { ?>
		<td data-field="TglSO"<?php echo $Page->TglSO->CellAttributes(); ?>></td>
<?php } ?>
<?php if ($Page->NoSO->Visible) { ?>
		<td data-field="NoSO"<?php echo $Page->NoSO->CellAttributes(); ?>><span class="ewGroupToggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="NoSO" colspan="<?php echo ($Page->GrpColumnCount + $Page->DtlColumnCount - 2) ?>"<?php echo $Page->NoSO->CellAttributes() ?>>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
		<span class="ewSummaryCaption r04_jual_NoSO"><span class="ewTableHeaderCaption"><?php echo $Page->NoSO->FldCaption() ?></span></span>
<?php } else { ?>
	<?php if ($Page->SortUrl($Page->NoSO) == "") { ?>
		<span class="ewSummaryCaption r04_jual_NoSO">
			<span class="ewTableHeaderCaption"><?php echo $Page->NoSO->FldCaption() ?></span>
		</span>
	<?php } else { ?>
		<span class="ewTableHeaderBtn ewPointer ewSummaryCaption r04_jual_NoSO" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->NoSO) ?>',2);">
			<span class="ewTableHeaderCaption"><?php echo $Page->NoSO->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->NoSO->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->NoSO->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</span>
	<?php } ?>
<?php } ?>
		<?php echo $ReportLanguage->Phrase("SummaryColon") ?>
<span data-class="tpx<?php echo $Page->GrpCount ?>_<?php echo $Page->GrpCounter[0] ?>_r04_jual_NoSO"<?php echo $Page->NoSO->ViewAttributes() ?>><?php echo $Page->NoSO->GroupViewValue ?></span>
		<span class="ewSummaryCount">(<span class="ewAggregateCaption"><?php echo $ReportLanguage->Phrase("RptCnt") ?></span><?php echo $ReportLanguage->Phrase("AggregateEqual") ?><span class="ewAggregateValue"><?php echo ewr_FormatNumber($Page->NoSO->Count,0,-2,-2,-2) ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php if ($Page->CustomerNama->Visible && $Page->ChkLvlBreak(3) && $Page->CustomerNama->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$Page->ResetAttrs();
		$Page->RowType = EWR_ROWTYPE_TOTAL;
		$Page->RowTotalType = EWR_ROWTOTAL_GROUP;
		$Page->RowTotalSubType = EWR_ROWTOTAL_HEADER;
		$Page->RowGroupLevel = 3;
		$Page->CustomerNama->Count = $Page->GetSummaryCount(3);
		$Page->RenderRow();
?>
	<tr<?php echo $Page->RowAttributes(); ?>>
<?php if ($Page->TglSO->Visible) { ?>
		<td data-field="TglSO"<?php echo $Page->TglSO->CellAttributes(); ?>></td>
<?php } ?>
<?php if ($Page->NoSO->Visible) { ?>
		<td data-field="NoSO"<?php echo $Page->NoSO->CellAttributes(); ?>></td>
<?php } ?>
<?php if ($Page->CustomerNama->Visible) { ?>
		<td data-field="CustomerNama"<?php echo $Page->CustomerNama->CellAttributes(); ?>><span class="ewGroupToggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="CustomerNama" colspan="<?php echo ($Page->GrpColumnCount + $Page->DtlColumnCount - 3) ?>"<?php echo $Page->CustomerNama->CellAttributes() ?>>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
		<span class="ewSummaryCaption r04_jual_CustomerNama"><span class="ewTableHeaderCaption"><?php echo $Page->CustomerNama->FldCaption() ?></span></span>
<?php } else { ?>
	<?php if ($Page->SortUrl($Page->CustomerNama) == "") { ?>
		<span class="ewSummaryCaption r04_jual_CustomerNama">
			<span class="ewTableHeaderCaption"><?php echo $Page->CustomerNama->FldCaption() ?></span>
		</span>
	<?php } else { ?>
		<span class="ewTableHeaderBtn ewPointer ewSummaryCaption r04_jual_CustomerNama" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->CustomerNama) ?>',2);">
			<span class="ewTableHeaderCaption"><?php echo $Page->CustomerNama->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->CustomerNama->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->CustomerNama->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</span>
	<?php } ?>
<?php } ?>
		<?php echo $ReportLanguage->Phrase("SummaryColon") ?>
<span data-class="tpx<?php echo $Page->GrpCount ?>_<?php echo $Page->GrpCounter[0] ?>_<?php echo $Page->GrpCounter[1] ?>_r04_jual_CustomerNama"<?php echo $Page->CustomerNama->ViewAttributes() ?>><?php echo $Page->CustomerNama->GroupViewValue ?></span>
		<span class="ewSummaryCount">(<span class="ewAggregateCaption"><?php echo $ReportLanguage->Phrase("RptCnt") ?></span><?php echo $ReportLanguage->Phrase("AggregateEqual") ?><span class="ewAggregateValue"><?php echo ewr_FormatNumber($Page->CustomerNama->Count,0,-2,-2,-2) ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php if ($Page->CustomerPO->Visible && $Page->ChkLvlBreak(4) && $Page->CustomerPO->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$Page->ResetAttrs();
		$Page->RowType = EWR_ROWTYPE_TOTAL;
		$Page->RowTotalType = EWR_ROWTOTAL_GROUP;
		$Page->RowTotalSubType = EWR_ROWTOTAL_HEADER;
		$Page->RowGroupLevel = 4;
		$Page->CustomerPO->Count = $Page->GetSummaryCount(4);
		$Page->RenderRow();
?>
	<tr<?php echo $Page->RowAttributes(); ?>>
<?php if ($Page->TglSO->Visible) { ?>
		<td data-field="TglSO"<?php echo $Page->TglSO->CellAttributes(); ?>></td>
<?php } ?>
<?php if ($Page->NoSO->Visible) { ?>
		<td data-field="NoSO"<?php echo $Page->NoSO->CellAttributes(); ?>></td>
<?php } ?>
<?php if ($Page->CustomerNama->Visible) { ?>
		<td data-field="CustomerNama"<?php echo $Page->CustomerNama->CellAttributes(); ?>></td>
<?php } ?>
<?php if ($Page->CustomerPO->Visible) { ?>
		<td data-field="CustomerPO"<?php echo $Page->CustomerPO->CellAttributes(); ?>><span class="ewGroupToggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="CustomerPO" colspan="<?php echo ($Page->GrpColumnCount + $Page->DtlColumnCount - 4) ?>"<?php echo $Page->CustomerPO->CellAttributes() ?>>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
		<span class="ewSummaryCaption r04_jual_CustomerPO"><span class="ewTableHeaderCaption"><?php echo $Page->CustomerPO->FldCaption() ?></span></span>
<?php } else { ?>
	<?php if ($Page->SortUrl($Page->CustomerPO) == "") { ?>
		<span class="ewSummaryCaption r04_jual_CustomerPO">
			<span class="ewTableHeaderCaption"><?php echo $Page->CustomerPO->FldCaption() ?></span>
		</span>
	<?php } else { ?>
		<span class="ewTableHeaderBtn ewPointer ewSummaryCaption r04_jual_CustomerPO" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->CustomerPO) ?>',2);">
			<span class="ewTableHeaderCaption"><?php echo $Page->CustomerPO->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->CustomerPO->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->CustomerPO->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</span>
	<?php } ?>
<?php } ?>
		<?php echo $ReportLanguage->Phrase("SummaryColon") ?>
<span data-class="tpx<?php echo $Page->GrpCount ?>_<?php echo $Page->GrpCounter[0] ?>_<?php echo $Page->GrpCounter[1] ?>_<?php echo $Page->GrpCounter[2] ?>_r04_jual_CustomerPO"<?php echo $Page->CustomerPO->ViewAttributes() ?>><?php echo $Page->CustomerPO->GroupViewValue ?></span>
		<span class="ewSummaryCount">(<span class="ewAggregateCaption"><?php echo $ReportLanguage->Phrase("RptCnt") ?></span><?php echo $ReportLanguage->Phrase("AggregateEqual") ?><span class="ewAggregateValue"><?php echo ewr_FormatNumber($Page->CustomerPO->Count,0,-2,-2,-2) ?></span>)</span>
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
<?php if ($Page->TglSO->Visible) { ?>
	<?php if ($Page->TglSO->ShowGroupHeaderAsRow) { ?>
		<td data-field="TglSO"<?php echo $Page->TglSO->CellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="TglSO"<?php echo $Page->TglSO->CellAttributes(); ?>>
<span data-class="tpx<?php echo $Page->GrpCount ?>_r04_jual_TglSO"<?php echo $Page->TglSO->ViewAttributes() ?>><?php echo $Page->TglSO->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($Page->NoSO->Visible) { ?>
	<?php if ($Page->NoSO->ShowGroupHeaderAsRow) { ?>
		<td data-field="NoSO"<?php echo $Page->NoSO->CellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="NoSO"<?php echo $Page->NoSO->CellAttributes(); ?>>
<span data-class="tpx<?php echo $Page->GrpCount ?>_<?php echo $Page->GrpCounter[0] ?>_r04_jual_NoSO"<?php echo $Page->NoSO->ViewAttributes() ?>><?php echo $Page->NoSO->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($Page->CustomerNama->Visible) { ?>
	<?php if ($Page->CustomerNama->ShowGroupHeaderAsRow) { ?>
		<td data-field="CustomerNama"<?php echo $Page->CustomerNama->CellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="CustomerNama"<?php echo $Page->CustomerNama->CellAttributes(); ?>>
<span data-class="tpx<?php echo $Page->GrpCount ?>_<?php echo $Page->GrpCounter[0] ?>_<?php echo $Page->GrpCounter[1] ?>_r04_jual_CustomerNama"<?php echo $Page->CustomerNama->ViewAttributes() ?>><?php echo $Page->CustomerNama->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($Page->CustomerPO->Visible) { ?>
	<?php if ($Page->CustomerPO->ShowGroupHeaderAsRow) { ?>
		<td data-field="CustomerPO"<?php echo $Page->CustomerPO->CellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="CustomerPO"<?php echo $Page->CustomerPO->CellAttributes(); ?>>
<span data-class="tpx<?php echo $Page->GrpCount ?>_<?php echo $Page->GrpCounter[0] ?>_<?php echo $Page->GrpCounter[1] ?>_<?php echo $Page->GrpCounter[2] ?>_r04_jual_CustomerPO"<?php echo $Page->CustomerPO->ViewAttributes() ?>><?php echo $Page->CustomerPO->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($Page->ArticleNama->Visible) { ?>
		<td data-field="ArticleNama"<?php echo $Page->ArticleNama->CellAttributes() ?>>
<span<?php echo $Page->ArticleNama->ViewAttributes() ?>><?php echo $Page->ArticleNama->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->HargaJual->Visible) { ?>
		<td data-field="HargaJual"<?php echo $Page->HargaJual->CellAttributes() ?>>
<span<?php echo $Page->HargaJual->ViewAttributes() ?>><?php echo $Page->HargaJual->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->Qty->Visible) { ?>
		<td data-field="Qty"<?php echo $Page->Qty->CellAttributes() ?>>
<span<?php echo $Page->Qty->ViewAttributes() ?>><?php echo $Page->Qty->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->SatuanNama->Visible) { ?>
		<td data-field="SatuanNama"<?php echo $Page->SatuanNama->CellAttributes() ?>>
<span<?php echo $Page->SatuanNama->ViewAttributes() ?>><?php echo $Page->SatuanNama->ListViewValue() ?></span></td>
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
		if ($Page->ChkLvlBreak(4)) {
			$cnt = count(@$Page->GrpIdx[$Page->GrpCount][$Page->GrpCounter[0]][$Page->GrpCounter[1]]);
			$Page->GrpIdx[$Page->GrpCount][$Page->GrpCounter[0]][$Page->GrpCounter[1]][$cnt] = $Page->RecCount;
		}
		if ($Page->ChkLvlBreak(4) && $Page->CustomerPO->Visible) {
?>
<?php
			$Page->TglSO->Count = $Page->GetSummaryCount(1, FALSE);
			$Page->NoSO->Count = $Page->GetSummaryCount(2, FALSE);
			$Page->CustomerNama->Count = $Page->GetSummaryCount(3, FALSE);
			$Page->CustomerPO->Count = $Page->GetSummaryCount(4, FALSE);
			$Page->SubTotal->Count = $Page->Cnt[4][5];
			$Page->SubTotal->SumValue = $Page->Smry[4][5]; // Load SUM
			$Page->ResetAttrs();
			$Page->RowType = EWR_ROWTYPE_TOTAL;
			$Page->RowTotalType = EWR_ROWTOTAL_GROUP;
			$Page->RowTotalSubType = EWR_ROWTOTAL_FOOTER;
			$Page->RowGroupLevel = 4;
			$Page->RenderRow();
?>
<?php if ($Page->CustomerPO->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $Page->RowAttributes(); ?>>
<?php if ($Page->TglSO->Visible) { ?>
		<td data-field="TglSO"<?php echo $Page->TglSO->CellAttributes() ?>>
	<?php if ($Page->TglSO->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Page->RowGroupLevel <> 1) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ewSummaryCount"><span class="ewAggregateCaption"><?php echo $ReportLanguage->Phrase("RptCnt") ?></span><?php echo $ReportLanguage->Phrase("AggregateEqual") ?><span class="ewAggregateValue"><?php echo ewr_FormatNumber($Page->TglSO->Count,0,-2,-2,-2) ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Page->NoSO->Visible) { ?>
		<td data-field="NoSO"<?php echo $Page->NoSO->CellAttributes() ?>>
	<?php if ($Page->NoSO->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Page->RowGroupLevel <> 2) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ewSummaryCount"><span class="ewAggregateCaption"><?php echo $ReportLanguage->Phrase("RptCnt") ?></span><?php echo $ReportLanguage->Phrase("AggregateEqual") ?><span class="ewAggregateValue"><?php echo ewr_FormatNumber($Page->NoSO->Count,0,-2,-2,-2) ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Page->CustomerNama->Visible) { ?>
		<td data-field="CustomerNama"<?php echo $Page->CustomerNama->CellAttributes() ?>>
	<?php if ($Page->CustomerNama->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Page->RowGroupLevel <> 3) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ewSummaryCount"><span class="ewAggregateCaption"><?php echo $ReportLanguage->Phrase("RptCnt") ?></span><?php echo $ReportLanguage->Phrase("AggregateEqual") ?><span class="ewAggregateValue"><?php echo ewr_FormatNumber($Page->CustomerNama->Count,0,-2,-2,-2) ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Page->CustomerPO->Visible) { ?>
		<td data-field="CustomerPO"<?php echo $Page->CustomerPO->CellAttributes() ?>>
	<?php if ($Page->CustomerPO->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Page->RowGroupLevel <> 4) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ewSummaryCount"><span class="ewAggregateCaption"><?php echo $ReportLanguage->Phrase("RptCnt") ?></span><?php echo $ReportLanguage->Phrase("AggregateEqual") ?><span class="ewAggregateValue"><?php echo ewr_FormatNumber($Page->CustomerPO->Count,0,-2,-2,-2) ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Page->ArticleNama->Visible) { ?>
		<td data-field="ArticleNama"<?php echo $Page->CustomerPO->CellAttributes() ?>></td>
<?php } ?>
<?php if ($Page->HargaJual->Visible) { ?>
		<td data-field="HargaJual"<?php echo $Page->CustomerPO->CellAttributes() ?>></td>
<?php } ?>
<?php if ($Page->Qty->Visible) { ?>
		<td data-field="Qty"<?php echo $Page->CustomerPO->CellAttributes() ?>></td>
<?php } ?>
<?php if ($Page->SatuanNama->Visible) { ?>
		<td data-field="SatuanNama"<?php echo $Page->CustomerPO->CellAttributes() ?>></td>
<?php } ?>
<?php if ($Page->SubTotal->Visible) { ?>
		<td data-field="SubTotal"<?php echo $Page->CustomerPO->CellAttributes() ?>><span class="ewAggregateCaption"><?php echo $ReportLanguage->Phrase("RptSum") ?></span><?php echo $ReportLanguage->Phrase("AggregateEqual") ?><span class="ewAggregateValue"><span<?php echo $Page->SubTotal->ViewAttributes() ?>><?php echo $Page->SubTotal->SumViewValue ?></span></span></td>
<?php } ?>
	</tr>
<?php } else { ?>
	<tr<?php echo $Page->RowAttributes(); ?>>
<?php if ($Page->TglSO->Visible) { ?>
		<td data-field="TglSO"<?php echo $Page->TglSO->CellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->NoSO->Visible) { ?>
		<td data-field="NoSO"<?php echo $Page->NoSO->CellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->CustomerNama->Visible) { ?>
		<td data-field="CustomerNama"<?php echo $Page->CustomerNama->CellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->SubGrpColumnCount + $Page->DtlColumnCount - 2 > 0) { ?>
		<td colspan="<?php echo ($Page->SubGrpColumnCount + $Page->DtlColumnCount - 2) ?>"<?php echo $Page->SubTotal->CellAttributes() ?>><?php echo str_replace(array("%v", "%c"), array($Page->CustomerPO->GroupViewValue, $Page->CustomerPO->FldCaption()), $ReportLanguage->Phrase("RptSumHead")) ?> <span class="ewDirLtr">(<?php echo ewr_FormatNumber($Page->Cnt[4][0],0,-2,-2,-2) ?><?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</span></td>
<?php } ?>
	</tr>
	<tr<?php echo $Page->RowAttributes(); ?>>
<?php if ($Page->TglSO->Visible) { ?>
		<td data-field="TglSO"<?php echo $Page->TglSO->CellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->NoSO->Visible) { ?>
		<td data-field="NoSO"<?php echo $Page->NoSO->CellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->CustomerNama->Visible) { ?>
		<td data-field="CustomerNama"<?php echo $Page->CustomerNama->CellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->GrpColumnCount > 0) { ?>
		<td colspan="<?php echo ($Page->GrpColumnCount - 3) ?>"<?php echo $Page->CustomerPO->CellAttributes() ?>><?php echo $ReportLanguage->Phrase("RptSum") ?></td>
<?php } ?>
<?php if ($Page->ArticleNama->Visible) { ?>
		<td data-field="ArticleNama"<?php echo $Page->CustomerPO->CellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->HargaJual->Visible) { ?>
		<td data-field="HargaJual"<?php echo $Page->CustomerPO->CellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->Qty->Visible) { ?>
		<td data-field="Qty"<?php echo $Page->CustomerPO->CellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->SatuanNama->Visible) { ?>
		<td data-field="SatuanNama"<?php echo $Page->CustomerPO->CellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->SubTotal->Visible) { ?>
		<td data-field="SubTotal"<?php echo $Page->SubTotal->CellAttributes() ?>>
<span<?php echo $Page->SubTotal->ViewAttributes() ?>><?php echo $Page->SubTotal->SumViewValue ?></span></td>
<?php } ?>
	</tr>
<?php } ?>
<?php

			// Reset level 4 summary
			$Page->ResetLevelSummary(4);
		} // End show footer check
		if ($Page->ChkLvlBreak(4)) {
			$Page->GrpCounter[2]++;
		}
?>
<?php
		if ($Page->ChkLvlBreak(3) && $Page->CustomerNama->Visible) {
?>
<?php
			$Page->TglSO->Count = $Page->GetSummaryCount(1, FALSE);
			$Page->NoSO->Count = $Page->GetSummaryCount(2, FALSE);
			$Page->CustomerNama->Count = $Page->GetSummaryCount(3, FALSE);
			$Page->CustomerPO->Count = $Page->GetSummaryCount(4, FALSE);
			$Page->SubTotal->Count = $Page->Cnt[3][5];
			$Page->SubTotal->SumValue = $Page->Smry[3][5]; // Load SUM
			$Page->ResetAttrs();
			$Page->RowType = EWR_ROWTYPE_TOTAL;
			$Page->RowTotalType = EWR_ROWTOTAL_GROUP;
			$Page->RowTotalSubType = EWR_ROWTOTAL_FOOTER;
			$Page->RowGroupLevel = 3;
			$Page->RenderRow();
?>
<?php if ($Page->CustomerNama->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $Page->RowAttributes(); ?>>
<?php if ($Page->TglSO->Visible) { ?>
		<td data-field="TglSO"<?php echo $Page->TglSO->CellAttributes() ?>>
	<?php if ($Page->TglSO->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Page->RowGroupLevel <> 1) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ewSummaryCount"><span class="ewAggregateCaption"><?php echo $ReportLanguage->Phrase("RptCnt") ?></span><?php echo $ReportLanguage->Phrase("AggregateEqual") ?><span class="ewAggregateValue"><?php echo ewr_FormatNumber($Page->TglSO->Count,0,-2,-2,-2) ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Page->NoSO->Visible) { ?>
		<td data-field="NoSO"<?php echo $Page->NoSO->CellAttributes() ?>>
	<?php if ($Page->NoSO->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Page->RowGroupLevel <> 2) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ewSummaryCount"><span class="ewAggregateCaption"><?php echo $ReportLanguage->Phrase("RptCnt") ?></span><?php echo $ReportLanguage->Phrase("AggregateEqual") ?><span class="ewAggregateValue"><?php echo ewr_FormatNumber($Page->NoSO->Count,0,-2,-2,-2) ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Page->CustomerNama->Visible) { ?>
		<td data-field="CustomerNama"<?php echo $Page->CustomerNama->CellAttributes() ?>>
	<?php if ($Page->CustomerNama->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Page->RowGroupLevel <> 3) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ewSummaryCount"><span class="ewAggregateCaption"><?php echo $ReportLanguage->Phrase("RptCnt") ?></span><?php echo $ReportLanguage->Phrase("AggregateEqual") ?><span class="ewAggregateValue"><?php echo ewr_FormatNumber($Page->CustomerNama->Count,0,-2,-2,-2) ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Page->CustomerPO->Visible) { ?>
		<td data-field="CustomerPO"<?php echo $Page->CustomerNama->CellAttributes() ?>>
	<?php if ($Page->CustomerPO->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Page->RowGroupLevel <> 4) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ewSummaryCount"><span class="ewAggregateCaption"><?php echo $ReportLanguage->Phrase("RptCnt") ?></span><?php echo $ReportLanguage->Phrase("AggregateEqual") ?><span class="ewAggregateValue"><?php echo ewr_FormatNumber($Page->CustomerPO->Count,0,-2,-2,-2) ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Page->ArticleNama->Visible) { ?>
		<td data-field="ArticleNama"<?php echo $Page->CustomerNama->CellAttributes() ?>></td>
<?php } ?>
<?php if ($Page->HargaJual->Visible) { ?>
		<td data-field="HargaJual"<?php echo $Page->CustomerNama->CellAttributes() ?>></td>
<?php } ?>
<?php if ($Page->Qty->Visible) { ?>
		<td data-field="Qty"<?php echo $Page->CustomerNama->CellAttributes() ?>></td>
<?php } ?>
<?php if ($Page->SatuanNama->Visible) { ?>
		<td data-field="SatuanNama"<?php echo $Page->CustomerNama->CellAttributes() ?>></td>
<?php } ?>
<?php if ($Page->SubTotal->Visible) { ?>
		<td data-field="SubTotal"<?php echo $Page->CustomerNama->CellAttributes() ?>><span class="ewAggregateCaption"><?php echo $ReportLanguage->Phrase("RptSum") ?></span><?php echo $ReportLanguage->Phrase("AggregateEqual") ?><span class="ewAggregateValue"><span<?php echo $Page->SubTotal->ViewAttributes() ?>><?php echo $Page->SubTotal->SumViewValue ?></span></span></td>
<?php } ?>
	</tr>
<?php } else { ?>
	<tr<?php echo $Page->RowAttributes(); ?>>
<?php if ($Page->TglSO->Visible) { ?>
		<td data-field="TglSO"<?php echo $Page->TglSO->CellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->NoSO->Visible) { ?>
		<td data-field="NoSO"<?php echo $Page->NoSO->CellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->SubGrpColumnCount + $Page->DtlColumnCount - 1 > 0) { ?>
		<td colspan="<?php echo ($Page->SubGrpColumnCount + $Page->DtlColumnCount - 1) ?>"<?php echo $Page->SubTotal->CellAttributes() ?>><?php echo str_replace(array("%v", "%c"), array($Page->CustomerNama->GroupViewValue, $Page->CustomerNama->FldCaption()), $ReportLanguage->Phrase("RptSumHead")) ?> <span class="ewDirLtr">(<?php echo ewr_FormatNumber($Page->Cnt[3][0],0,-2,-2,-2) ?><?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</span></td>
<?php } ?>
	</tr>
	<tr<?php echo $Page->RowAttributes(); ?>>
<?php if ($Page->TglSO->Visible) { ?>
		<td data-field="TglSO"<?php echo $Page->TglSO->CellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->NoSO->Visible) { ?>
		<td data-field="NoSO"<?php echo $Page->NoSO->CellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->GrpColumnCount > 0) { ?>
		<td colspan="<?php echo ($Page->GrpColumnCount - 2) ?>"<?php echo $Page->CustomerNama->CellAttributes() ?>><?php echo $ReportLanguage->Phrase("RptSum") ?></td>
<?php } ?>
<?php if ($Page->ArticleNama->Visible) { ?>
		<td data-field="ArticleNama"<?php echo $Page->CustomerNama->CellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->HargaJual->Visible) { ?>
		<td data-field="HargaJual"<?php echo $Page->CustomerNama->CellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->Qty->Visible) { ?>
		<td data-field="Qty"<?php echo $Page->CustomerNama->CellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->SatuanNama->Visible) { ?>
		<td data-field="SatuanNama"<?php echo $Page->CustomerNama->CellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->SubTotal->Visible) { ?>
		<td data-field="SubTotal"<?php echo $Page->SubTotal->CellAttributes() ?>>
<span<?php echo $Page->SubTotal->ViewAttributes() ?>><?php echo $Page->SubTotal->SumViewValue ?></span></td>
<?php } ?>
	</tr>
<?php } ?>
<?php

			// Reset level 3 summary
			$Page->ResetLevelSummary(3);
		} // End show footer check
		if ($Page->ChkLvlBreak(3)) {
			$Page->GrpCounter[1]++;
			if (!$rs->EOF)
				$Page->GrpIdx[$Page->GrpCount][$Page->GrpCounter[1]] = array(-1);
			$Page->GrpCounter[2] = 1;
		}
?>
<?php
	} // End detail records loop
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
	$Page->GrpCounter[2] = 1;
	$Page->GrpCounter[1] = 1;
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
	$Page->SubTotal->Count = $Page->GrandCnt[5];
	$Page->SubTotal->SumValue = $Page->GrandSmry[5]; // Load SUM
	$Page->ResetAttrs();
	$Page->RowType = EWR_ROWTYPE_TOTAL;
	$Page->RowTotalType = EWR_ROWTOTAL_GRAND;
	$Page->RowTotalSubType = EWR_ROWTOTAL_FOOTER;
	$Page->RowAttrs["class"] = "ewRptGrandSummary";
	$Page->RenderRow();
?>
<?php if ($Page->CustomerNama->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $Page->RowAttributes() ?>><td colspan="<?php echo ($Page->GrpColumnCount + $Page->DtlColumnCount) ?>"><?php echo $ReportLanguage->Phrase("RptGrandSummary") ?> (<span class="ewAggregateCaption"><?php echo $ReportLanguage->Phrase("RptCnt") ?></span><?php echo $ReportLanguage->Phrase("AggregateEqual") ?><span class="ewAggregateValue"><?php echo ewr_FormatNumber($Page->TotCount,0,-2,-2,-2) ?></span>)</td></tr>
	<tr<?php echo $Page->RowAttributes() ?>>
<?php if ($Page->GrpColumnCount > 0) { ?>
		<td colspan="<?php echo $Page->GrpColumnCount ?>" class="ewRptGrpAggregate">&nbsp;</td>
<?php } ?>
<?php if ($Page->ArticleNama->Visible) { ?>
		<td data-field="ArticleNama"<?php echo $Page->ArticleNama->CellAttributes() ?>></td>
<?php } ?>
<?php if ($Page->HargaJual->Visible) { ?>
		<td data-field="HargaJual"<?php echo $Page->HargaJual->CellAttributes() ?>></td>
<?php } ?>
<?php if ($Page->Qty->Visible) { ?>
		<td data-field="Qty"<?php echo $Page->Qty->CellAttributes() ?>></td>
<?php } ?>
<?php if ($Page->SatuanNama->Visible) { ?>
		<td data-field="SatuanNama"<?php echo $Page->SatuanNama->CellAttributes() ?>></td>
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
<?php if ($Page->ArticleNama->Visible) { ?>
		<td data-field="ArticleNama"<?php echo $Page->ArticleNama->CellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->HargaJual->Visible) { ?>
		<td data-field="HargaJual"<?php echo $Page->HargaJual->CellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->Qty->Visible) { ?>
		<td data-field="Qty"<?php echo $Page->Qty->CellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Page->SatuanNama->Visible) { ?>
		<td data-field="SatuanNama"<?php echo $Page->SatuanNama->CellAttributes() ?>>&nbsp;</td>
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
<?php include "r04_jualsmrypager.php" ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<!-- Report grid (begin) -->
<?php if ($Page->Export <> "pdf") { ?>
<div id="gmp_r04_jual" class="<?php if (ewr_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
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
<?php include "r04_jualsmrypager.php" ?>
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
