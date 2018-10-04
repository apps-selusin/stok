<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php $EW_ROOT_RELATIVE_PATH = ""; ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "t96_employeesinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$cf02_home_php = NULL; // Initialize page object first

class ccf02_home_php {

	// Page ID
	var $PageID = 'custom';

	// Project ID
	var $ProjectID = '{8746EF3F-81FE-4C1C-A7F8-AC191F8DDBB2}';

	// Table name
	var $TableName = 'cf02_home.php';

	// Page object name
	var $PageObjName = 'cf02_home_php';

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
		return "";
	}

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		return $PageUrl;
	}

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

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'custom', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'cf02_home.php', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"]))
			$GLOBALS["gTimer"] = new cTimer();

		// Debug message
		ew_LoadDebugMsg();

		// Open connection
		if (!isset($conn))
			$conn = ew_Connect();

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

		// User profile
		$UserProfile = new cUserProfile();

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName);
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loaded();
		if (!$Security->CanReport()) {
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

		if (@$_GET["export"] <> "")
			$gsExport = $_GET["export"]; // Get export parameter, used in header

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Check token
		if (!$this->ValidPost()) {
			echo $Language->Phrase("InvalidPostRequest");
			$this->Page_Terminate();
			exit();
		}

		// Create Token
		$this->CreateToken();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $gsExportFile, $gTmpImages;

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
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

	//
	// Page main
	//
	function Page_Main() {

		// Set up Breadcrumb
		$this->SetupBreadcrumb();
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("custom", "cf02_home_php", $url, "", "cf02_home_php", TRUE);
		$this->Heading = $Language->TablePhrase("cf02_home_php", "TblCaption"); 
	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($cf02_home_php)) $cf02_home_php = new ccf02_home_php();

// Page init
$cf02_home_php->Page_Init();

// Page main
$cf02_home_php->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();
?>
<?php include_once "header.php" ?>
<?php

$db =& DbHelper(); 

function show_table($r) {
	echo "<table class='table table-striped table-bordered table-hover table-condensed'>";
	echo "<tr><th>No.</th><th colspan='4'>Keterangan</th></tr>";
	while (!$r->EOF) {
		$no = $r->fields["No"];
		echo "<tr><td>".$no.".</td><td colspan='4'>".$r->fields["Keterangan"]."</td></tr>";
		while ($no == $r->fields["No"]) {
			echo "
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>".$r->fields["TanggalJam"]."</td>
				<td>".$r->fields["Status2"]."</td>
				<td>".$r->fields["Keterangan2"]."</td>
			</tr>";
			$r->MoveNext();
		}
		echo "<tr><td colspan='5'>&nbsp;</td></tr>";
	}
	echo "</table>";
}
?>

<style>
.panel-heading a{
  display:block;
}

.panel-heading a.collapsed {
  background: url(http://upload.wikimedia.org/wikipedia/commons/3/36/Vector_skin_right_arrow.png) center right no-repeat;
}

.panel-heading a {
  background: url(http://www.useragentman.com/blog/wp-content/themes/useragentman/images/widgets/downArrow.png) center right no-repeat;
}
</style>


<div class="panel panel-default">
	<div class="panel-heading">Piutang</div>
	<?php
	$sql = "SELECT DISTINCT " .
	"`categories`.`CategoryName` AS `CategoryName`," .
	"`products`.`ProductName` AS `ProductName`," .
	"`products`.`QuantityPerUnit` AS `QuantityPerUnit`" .
	" FROM `categories` JOIN `products` ON (`categories`.`CategoryID` = `products`.`CategoryID`)" .
	" WHERE " .
	"`products`.`UnitsInStock` <= 0";
	$q = "
		select
			nopiutang,
			tglso,
			noso,
			nama,
			customerpo,
			jumlahpiutang,
			jumlahbayar,
			jumlahpiutang - jumlahbayar as saldopiutang
		from
			t14_piutang a
			left join t11_jual b on a.jualid = b.id
			left join t03_customer c on b.customerid = c.id
			";
	echo $db->ExecuteHtml($q, ["fieldcaption" => TRUE, "tablename" => ["t14_piutang", "t11_jual", "t03_customer"]]); // Execute a SQL and show as HTML table
	?>
</div>

<div class="panel panel-default">
	<div class="panel-heading">Hutang</div>
	<?php
	$sql = "SELECT DISTINCT " .
	"`categories`.`CategoryName` AS `CategoryName`," .
	"`products`.`ProductName` AS `ProductName`," .
	"`products`.`QuantityPerUnit` AS `QuantityPerUnit`," .
	"`products`.`UnitsInStock` AS `UnitsInStock`" .
	" FROM `categories` JOIN `products` ON (`categories`.`CategoryID` = `products`.`CategoryID`)" .
	" WHERE " .
	"`products`.`Discontinued` = '1'";
	$q = "
		select
			nohutang,
			tglpo,
			nopo,
			nama,
			jumlahhutang,
			jumlahbayar,
			jumlahhutang - jumlahbayar as saldohutang
		from
			t09_hutang a
			left join t08_beli b on a.beliid = b.id
			left join t02_vendor c on b.vendorid = c.id
			";
	echo $db->ExecuteHtml($q, ["fieldcaption" => TRUE, "tablename" => ["t09_hutang", "t08_beli", "t02_vendor"]]); // Execute a SQL and show as HTML table
?>
</div>

<div class="row">

	<div class="col-lg-12 col-md-12 col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading"><strong><a class='collapsed' data-toggle="collapse" href="#log">Log</a></strong></div>
			<div id="log" class="panel-collapse collapse out">
			<div class="panel-body">
				<?php
				$q = "
					select distinct
						a.No,
						a.Keterangan,
						a.TanggalJam,
						b.Status as Status2,
						a.Keterangan2
					from
						t92_log a
						left join t91_log_status b on a.Status = b.id
					order by
						no desc,
						tanggaljam asc";
				$r = Conn()->Execute($q);
				show_table($r);
				?>
			</div>
			</div>
		</div>
	</div>

</div>
<?php if (EW_DEBUG_ENABLED) echo ew_DebugMsg(); ?>
<?php include_once "footer.php" ?>
<?php
$cf02_home_php->Page_Terminate();
?>
