<?php include_once "t96_employeesinfo.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($t12_jualdetail_grid)) $t12_jualdetail_grid = new ct12_jualdetail_grid();

// Page init
$t12_jualdetail_grid->Page_Init();

// Page main
$t12_jualdetail_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t12_jualdetail_grid->Page_Render();
?>
<?php if ($t12_jualdetail->Export == "") { ?>
<script type="text/javascript">

// Form object
var ft12_jualdetailgrid = new ew_Form("ft12_jualdetailgrid", "grid");
ft12_jualdetailgrid.FormKeyCountName = '<?php echo $t12_jualdetail_grid->FormKeyCountName ?>';

// Validate form
ft12_jualdetailgrid.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_JualID");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t12_jualdetail->JualID->FldCaption(), $t12_jualdetail->JualID->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_JualID");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t12_jualdetail->JualID->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_ArticleID");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t12_jualdetail->ArticleID->FldCaption(), $t12_jualdetail->ArticleID->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_HargaJual");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t12_jualdetail->HargaJual->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Qty");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t12_jualdetail->Qty->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_SubTotal");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t12_jualdetail->SubTotal->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
ft12_jualdetailgrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "JualID", false)) return false;
	if (ew_ValueChanged(fobj, infix, "ArticleID", false)) return false;
	if (ew_ValueChanged(fobj, infix, "HargaJual", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Qty", false)) return false;
	if (ew_ValueChanged(fobj, infix, "SatuanID", false)) return false;
	if (ew_ValueChanged(fobj, infix, "SubTotal", false)) return false;
	return true;
}

// Form_CustomValidate event
ft12_jualdetailgrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ft12_jualdetailgrid.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ft12_jualdetailgrid.Lists["x_ArticleID"] = {"LinkField":"x_id","Ajax":true,"AutoFill":true,"DisplayFields":["x_Kode","x_Nama","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t06_article"};
ft12_jualdetailgrid.Lists["x_ArticleID"].Data = "<?php echo $t12_jualdetail_grid->ArticleID->LookupFilterQuery(FALSE, "grid") ?>";
ft12_jualdetailgrid.Lists["x_SatuanID"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nama","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t07_satuan"};
ft12_jualdetailgrid.Lists["x_SatuanID"].Data = "<?php echo $t12_jualdetail_grid->SatuanID->LookupFilterQuery(FALSE, "grid") ?>";
ft12_jualdetailgrid.AutoSuggests["x_SatuanID"] = <?php echo json_encode(array("data" => "ajax=autosuggest&" . $t12_jualdetail_grid->SatuanID->LookupFilterQuery(TRUE, "grid"))) ?>;

// Form object for search
</script>
<?php } ?>
<?php
if ($t12_jualdetail->CurrentAction == "gridadd") {
	if ($t12_jualdetail->CurrentMode == "copy") {
		$bSelectLimit = $t12_jualdetail_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$t12_jualdetail_grid->TotalRecs = $t12_jualdetail->ListRecordCount();
			$t12_jualdetail_grid->Recordset = $t12_jualdetail_grid->LoadRecordset($t12_jualdetail_grid->StartRec-1, $t12_jualdetail_grid->DisplayRecs);
		} else {
			if ($t12_jualdetail_grid->Recordset = $t12_jualdetail_grid->LoadRecordset())
				$t12_jualdetail_grid->TotalRecs = $t12_jualdetail_grid->Recordset->RecordCount();
		}
		$t12_jualdetail_grid->StartRec = 1;
		$t12_jualdetail_grid->DisplayRecs = $t12_jualdetail_grid->TotalRecs;
	} else {
		$t12_jualdetail->CurrentFilter = "0=1";
		$t12_jualdetail_grid->StartRec = 1;
		$t12_jualdetail_grid->DisplayRecs = $t12_jualdetail->GridAddRowCount;
	}
	$t12_jualdetail_grid->TotalRecs = $t12_jualdetail_grid->DisplayRecs;
	$t12_jualdetail_grid->StopRec = $t12_jualdetail_grid->DisplayRecs;
} else {
	$bSelectLimit = $t12_jualdetail_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($t12_jualdetail_grid->TotalRecs <= 0)
			$t12_jualdetail_grid->TotalRecs = $t12_jualdetail->ListRecordCount();
	} else {
		if (!$t12_jualdetail_grid->Recordset && ($t12_jualdetail_grid->Recordset = $t12_jualdetail_grid->LoadRecordset()))
			$t12_jualdetail_grid->TotalRecs = $t12_jualdetail_grid->Recordset->RecordCount();
	}
	$t12_jualdetail_grid->StartRec = 1;
	$t12_jualdetail_grid->DisplayRecs = $t12_jualdetail_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$t12_jualdetail_grid->Recordset = $t12_jualdetail_grid->LoadRecordset($t12_jualdetail_grid->StartRec-1, $t12_jualdetail_grid->DisplayRecs);

	// Set no record found message
	if ($t12_jualdetail->CurrentAction == "" && $t12_jualdetail_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$t12_jualdetail_grid->setWarningMessage(ew_DeniedMsg());
		if ($t12_jualdetail_grid->SearchWhere == "0=101")
			$t12_jualdetail_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$t12_jualdetail_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$t12_jualdetail_grid->RenderOtherOptions();
?>
<?php $t12_jualdetail_grid->ShowPageHeader(); ?>
<?php
$t12_jualdetail_grid->ShowMessage();
?>
<?php if ($t12_jualdetail_grid->TotalRecs > 0 || $t12_jualdetail->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($t12_jualdetail_grid->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> t12_jualdetail">
<div id="ft12_jualdetailgrid" class="ewForm ewListForm form-inline">
<?php if ($t12_jualdetail_grid->ShowOtherOptions) { ?>
<div class="box-header ewGridUpperPanel">
<?php
	foreach ($t12_jualdetail_grid->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="gmp_t12_jualdetail" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table id="tbl_t12_jualdetailgrid" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$t12_jualdetail_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$t12_jualdetail_grid->RenderListOptions();

// Render list options (header, left)
$t12_jualdetail_grid->ListOptions->Render("header", "left");
?>
<?php if ($t12_jualdetail->JualID->Visible) { // JualID ?>
	<?php if ($t12_jualdetail->SortUrl($t12_jualdetail->JualID) == "") { ?>
		<th data-name="JualID" class="<?php echo $t12_jualdetail->JualID->HeaderCellClass() ?>"><div id="elh_t12_jualdetail_JualID" class="t12_jualdetail_JualID"><div class="ewTableHeaderCaption"><?php echo $t12_jualdetail->JualID->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="JualID" class="<?php echo $t12_jualdetail->JualID->HeaderCellClass() ?>"><div><div id="elh_t12_jualdetail_JualID" class="t12_jualdetail_JualID">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t12_jualdetail->JualID->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t12_jualdetail->JualID->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t12_jualdetail->JualID->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t12_jualdetail->ArticleID->Visible) { // ArticleID ?>
	<?php if ($t12_jualdetail->SortUrl($t12_jualdetail->ArticleID) == "") { ?>
		<th data-name="ArticleID" class="<?php echo $t12_jualdetail->ArticleID->HeaderCellClass() ?>"><div id="elh_t12_jualdetail_ArticleID" class="t12_jualdetail_ArticleID"><div class="ewTableHeaderCaption"><?php echo $t12_jualdetail->ArticleID->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ArticleID" class="<?php echo $t12_jualdetail->ArticleID->HeaderCellClass() ?>"><div><div id="elh_t12_jualdetail_ArticleID" class="t12_jualdetail_ArticleID">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t12_jualdetail->ArticleID->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t12_jualdetail->ArticleID->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t12_jualdetail->ArticleID->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t12_jualdetail->HargaJual->Visible) { // HargaJual ?>
	<?php if ($t12_jualdetail->SortUrl($t12_jualdetail->HargaJual) == "") { ?>
		<th data-name="HargaJual" class="<?php echo $t12_jualdetail->HargaJual->HeaderCellClass() ?>"><div id="elh_t12_jualdetail_HargaJual" class="t12_jualdetail_HargaJual"><div class="ewTableHeaderCaption"><?php echo $t12_jualdetail->HargaJual->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="HargaJual" class="<?php echo $t12_jualdetail->HargaJual->HeaderCellClass() ?>"><div><div id="elh_t12_jualdetail_HargaJual" class="t12_jualdetail_HargaJual">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t12_jualdetail->HargaJual->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t12_jualdetail->HargaJual->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t12_jualdetail->HargaJual->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t12_jualdetail->Qty->Visible) { // Qty ?>
	<?php if ($t12_jualdetail->SortUrl($t12_jualdetail->Qty) == "") { ?>
		<th data-name="Qty" class="<?php echo $t12_jualdetail->Qty->HeaderCellClass() ?>"><div id="elh_t12_jualdetail_Qty" class="t12_jualdetail_Qty"><div class="ewTableHeaderCaption"><?php echo $t12_jualdetail->Qty->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Qty" class="<?php echo $t12_jualdetail->Qty->HeaderCellClass() ?>"><div><div id="elh_t12_jualdetail_Qty" class="t12_jualdetail_Qty">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t12_jualdetail->Qty->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t12_jualdetail->Qty->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t12_jualdetail->Qty->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t12_jualdetail->SatuanID->Visible) { // SatuanID ?>
	<?php if ($t12_jualdetail->SortUrl($t12_jualdetail->SatuanID) == "") { ?>
		<th data-name="SatuanID" class="<?php echo $t12_jualdetail->SatuanID->HeaderCellClass() ?>"><div id="elh_t12_jualdetail_SatuanID" class="t12_jualdetail_SatuanID"><div class="ewTableHeaderCaption"><?php echo $t12_jualdetail->SatuanID->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SatuanID" class="<?php echo $t12_jualdetail->SatuanID->HeaderCellClass() ?>"><div><div id="elh_t12_jualdetail_SatuanID" class="t12_jualdetail_SatuanID">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t12_jualdetail->SatuanID->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t12_jualdetail->SatuanID->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t12_jualdetail->SatuanID->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t12_jualdetail->SubTotal->Visible) { // SubTotal ?>
	<?php if ($t12_jualdetail->SortUrl($t12_jualdetail->SubTotal) == "") { ?>
		<th data-name="SubTotal" class="<?php echo $t12_jualdetail->SubTotal->HeaderCellClass() ?>"><div id="elh_t12_jualdetail_SubTotal" class="t12_jualdetail_SubTotal"><div class="ewTableHeaderCaption"><?php echo $t12_jualdetail->SubTotal->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SubTotal" class="<?php echo $t12_jualdetail->SubTotal->HeaderCellClass() ?>"><div><div id="elh_t12_jualdetail_SubTotal" class="t12_jualdetail_SubTotal">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t12_jualdetail->SubTotal->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t12_jualdetail->SubTotal->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t12_jualdetail->SubTotal->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t12_jualdetail_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t12_jualdetail_grid->StartRec = 1;
$t12_jualdetail_grid->StopRec = $t12_jualdetail_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($t12_jualdetail_grid->FormKeyCountName) && ($t12_jualdetail->CurrentAction == "gridadd" || $t12_jualdetail->CurrentAction == "gridedit" || $t12_jualdetail->CurrentAction == "F")) {
		$t12_jualdetail_grid->KeyCount = $objForm->GetValue($t12_jualdetail_grid->FormKeyCountName);
		$t12_jualdetail_grid->StopRec = $t12_jualdetail_grid->StartRec + $t12_jualdetail_grid->KeyCount - 1;
	}
}
$t12_jualdetail_grid->RecCnt = $t12_jualdetail_grid->StartRec - 1;
if ($t12_jualdetail_grid->Recordset && !$t12_jualdetail_grid->Recordset->EOF) {
	$t12_jualdetail_grid->Recordset->MoveFirst();
	$bSelectLimit = $t12_jualdetail_grid->UseSelectLimit;
	if (!$bSelectLimit && $t12_jualdetail_grid->StartRec > 1)
		$t12_jualdetail_grid->Recordset->Move($t12_jualdetail_grid->StartRec - 1);
} elseif (!$t12_jualdetail->AllowAddDeleteRow && $t12_jualdetail_grid->StopRec == 0) {
	$t12_jualdetail_grid->StopRec = $t12_jualdetail->GridAddRowCount;
}

// Initialize aggregate
$t12_jualdetail->RowType = EW_ROWTYPE_AGGREGATEINIT;
$t12_jualdetail->ResetAttrs();
$t12_jualdetail_grid->RenderRow();
if ($t12_jualdetail->CurrentAction == "gridadd")
	$t12_jualdetail_grid->RowIndex = 0;
if ($t12_jualdetail->CurrentAction == "gridedit")
	$t12_jualdetail_grid->RowIndex = 0;
while ($t12_jualdetail_grid->RecCnt < $t12_jualdetail_grid->StopRec) {
	$t12_jualdetail_grid->RecCnt++;
	if (intval($t12_jualdetail_grid->RecCnt) >= intval($t12_jualdetail_grid->StartRec)) {
		$t12_jualdetail_grid->RowCnt++;
		if ($t12_jualdetail->CurrentAction == "gridadd" || $t12_jualdetail->CurrentAction == "gridedit" || $t12_jualdetail->CurrentAction == "F") {
			$t12_jualdetail_grid->RowIndex++;
			$objForm->Index = $t12_jualdetail_grid->RowIndex;
			if ($objForm->HasValue($t12_jualdetail_grid->FormActionName))
				$t12_jualdetail_grid->RowAction = strval($objForm->GetValue($t12_jualdetail_grid->FormActionName));
			elseif ($t12_jualdetail->CurrentAction == "gridadd")
				$t12_jualdetail_grid->RowAction = "insert";
			else
				$t12_jualdetail_grid->RowAction = "";
		}

		// Set up key count
		$t12_jualdetail_grid->KeyCount = $t12_jualdetail_grid->RowIndex;

		// Init row class and style
		$t12_jualdetail->ResetAttrs();
		$t12_jualdetail->CssClass = "";
		if ($t12_jualdetail->CurrentAction == "gridadd") {
			if ($t12_jualdetail->CurrentMode == "copy") {
				$t12_jualdetail_grid->LoadRowValues($t12_jualdetail_grid->Recordset); // Load row values
				$t12_jualdetail_grid->SetRecordKey($t12_jualdetail_grid->RowOldKey, $t12_jualdetail_grid->Recordset); // Set old record key
			} else {
				$t12_jualdetail_grid->LoadRowValues(); // Load default values
				$t12_jualdetail_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t12_jualdetail_grid->LoadRowValues($t12_jualdetail_grid->Recordset); // Load row values
		}
		$t12_jualdetail->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($t12_jualdetail->CurrentAction == "gridadd") // Grid add
			$t12_jualdetail->RowType = EW_ROWTYPE_ADD; // Render add
		if ($t12_jualdetail->CurrentAction == "gridadd" && $t12_jualdetail->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$t12_jualdetail_grid->RestoreCurrentRowFormValues($t12_jualdetail_grid->RowIndex); // Restore form values
		if ($t12_jualdetail->CurrentAction == "gridedit") { // Grid edit
			if ($t12_jualdetail->EventCancelled) {
				$t12_jualdetail_grid->RestoreCurrentRowFormValues($t12_jualdetail_grid->RowIndex); // Restore form values
			}
			if ($t12_jualdetail_grid->RowAction == "insert")
				$t12_jualdetail->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$t12_jualdetail->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($t12_jualdetail->CurrentAction == "gridedit" && ($t12_jualdetail->RowType == EW_ROWTYPE_EDIT || $t12_jualdetail->RowType == EW_ROWTYPE_ADD) && $t12_jualdetail->EventCancelled) // Update failed
			$t12_jualdetail_grid->RestoreCurrentRowFormValues($t12_jualdetail_grid->RowIndex); // Restore form values
		if ($t12_jualdetail->RowType == EW_ROWTYPE_EDIT) // Edit row
			$t12_jualdetail_grid->EditRowCnt++;
		if ($t12_jualdetail->CurrentAction == "F") // Confirm row
			$t12_jualdetail_grid->RestoreCurrentRowFormValues($t12_jualdetail_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t12_jualdetail->RowAttrs = array_merge($t12_jualdetail->RowAttrs, array('data-rowindex'=>$t12_jualdetail_grid->RowCnt, 'id'=>'r' . $t12_jualdetail_grid->RowCnt . '_t12_jualdetail', 'data-rowtype'=>$t12_jualdetail->RowType));

		// Render row
		$t12_jualdetail_grid->RenderRow();

		// Render list options
		$t12_jualdetail_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t12_jualdetail_grid->RowAction <> "delete" && $t12_jualdetail_grid->RowAction <> "insertdelete" && !($t12_jualdetail_grid->RowAction == "insert" && $t12_jualdetail->CurrentAction == "F" && $t12_jualdetail_grid->EmptyRow())) {
?>
	<tr<?php echo $t12_jualdetail->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t12_jualdetail_grid->ListOptions->Render("body", "left", $t12_jualdetail_grid->RowCnt);
?>
	<?php if ($t12_jualdetail->JualID->Visible) { // JualID ?>
		<td data-name="JualID"<?php echo $t12_jualdetail->JualID->CellAttributes() ?>>
<?php if ($t12_jualdetail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($t12_jualdetail->JualID->getSessionValue() <> "") { ?>
<span id="el<?php echo $t12_jualdetail_grid->RowCnt ?>_t12_jualdetail_JualID" class="form-group t12_jualdetail_JualID">
<span<?php echo $t12_jualdetail->JualID->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t12_jualdetail->JualID->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t12_jualdetail_grid->RowIndex ?>_JualID" name="x<?php echo $t12_jualdetail_grid->RowIndex ?>_JualID" value="<?php echo ew_HtmlEncode($t12_jualdetail->JualID->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t12_jualdetail_grid->RowCnt ?>_t12_jualdetail_JualID" class="form-group t12_jualdetail_JualID">
<input type="text" data-table="t12_jualdetail" data-field="x_JualID" name="x<?php echo $t12_jualdetail_grid->RowIndex ?>_JualID" id="x<?php echo $t12_jualdetail_grid->RowIndex ?>_JualID" size="30" placeholder="<?php echo ew_HtmlEncode($t12_jualdetail->JualID->getPlaceHolder()) ?>" value="<?php echo $t12_jualdetail->JualID->EditValue ?>"<?php echo $t12_jualdetail->JualID->EditAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="t12_jualdetail" data-field="x_JualID" name="o<?php echo $t12_jualdetail_grid->RowIndex ?>_JualID" id="o<?php echo $t12_jualdetail_grid->RowIndex ?>_JualID" value="<?php echo ew_HtmlEncode($t12_jualdetail->JualID->OldValue) ?>">
<?php } ?>
<?php if ($t12_jualdetail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($t12_jualdetail->JualID->getSessionValue() <> "") { ?>
<span id="el<?php echo $t12_jualdetail_grid->RowCnt ?>_t12_jualdetail_JualID" class="form-group t12_jualdetail_JualID">
<span<?php echo $t12_jualdetail->JualID->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t12_jualdetail->JualID->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t12_jualdetail_grid->RowIndex ?>_JualID" name="x<?php echo $t12_jualdetail_grid->RowIndex ?>_JualID" value="<?php echo ew_HtmlEncode($t12_jualdetail->JualID->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t12_jualdetail_grid->RowCnt ?>_t12_jualdetail_JualID" class="form-group t12_jualdetail_JualID">
<input type="text" data-table="t12_jualdetail" data-field="x_JualID" name="x<?php echo $t12_jualdetail_grid->RowIndex ?>_JualID" id="x<?php echo $t12_jualdetail_grid->RowIndex ?>_JualID" size="30" placeholder="<?php echo ew_HtmlEncode($t12_jualdetail->JualID->getPlaceHolder()) ?>" value="<?php echo $t12_jualdetail->JualID->EditValue ?>"<?php echo $t12_jualdetail->JualID->EditAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($t12_jualdetail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t12_jualdetail_grid->RowCnt ?>_t12_jualdetail_JualID" class="t12_jualdetail_JualID">
<span<?php echo $t12_jualdetail->JualID->ViewAttributes() ?>>
<?php echo $t12_jualdetail->JualID->ListViewValue() ?></span>
</span>
<?php if ($t12_jualdetail->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t12_jualdetail" data-field="x_JualID" name="x<?php echo $t12_jualdetail_grid->RowIndex ?>_JualID" id="x<?php echo $t12_jualdetail_grid->RowIndex ?>_JualID" value="<?php echo ew_HtmlEncode($t12_jualdetail->JualID->FormValue) ?>">
<input type="hidden" data-table="t12_jualdetail" data-field="x_JualID" name="o<?php echo $t12_jualdetail_grid->RowIndex ?>_JualID" id="o<?php echo $t12_jualdetail_grid->RowIndex ?>_JualID" value="<?php echo ew_HtmlEncode($t12_jualdetail->JualID->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t12_jualdetail" data-field="x_JualID" name="ft12_jualdetailgrid$x<?php echo $t12_jualdetail_grid->RowIndex ?>_JualID" id="ft12_jualdetailgrid$x<?php echo $t12_jualdetail_grid->RowIndex ?>_JualID" value="<?php echo ew_HtmlEncode($t12_jualdetail->JualID->FormValue) ?>">
<input type="hidden" data-table="t12_jualdetail" data-field="x_JualID" name="ft12_jualdetailgrid$o<?php echo $t12_jualdetail_grid->RowIndex ?>_JualID" id="ft12_jualdetailgrid$o<?php echo $t12_jualdetail_grid->RowIndex ?>_JualID" value="<?php echo ew_HtmlEncode($t12_jualdetail->JualID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($t12_jualdetail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t12_jualdetail" data-field="x_id" name="x<?php echo $t12_jualdetail_grid->RowIndex ?>_id" id="x<?php echo $t12_jualdetail_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t12_jualdetail->id->CurrentValue) ?>">
<input type="hidden" data-table="t12_jualdetail" data-field="x_id" name="o<?php echo $t12_jualdetail_grid->RowIndex ?>_id" id="o<?php echo $t12_jualdetail_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t12_jualdetail->id->OldValue) ?>">
<?php } ?>
<?php if ($t12_jualdetail->RowType == EW_ROWTYPE_EDIT || $t12_jualdetail->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t12_jualdetail" data-field="x_id" name="x<?php echo $t12_jualdetail_grid->RowIndex ?>_id" id="x<?php echo $t12_jualdetail_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t12_jualdetail->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($t12_jualdetail->ArticleID->Visible) { // ArticleID ?>
		<td data-name="ArticleID"<?php echo $t12_jualdetail->ArticleID->CellAttributes() ?>>
<?php if ($t12_jualdetail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t12_jualdetail_grid->RowCnt ?>_t12_jualdetail_ArticleID" class="form-group t12_jualdetail_ArticleID">
<?php $t12_jualdetail->ArticleID->EditAttrs["onchange"] = "ew_AutoFill(this); " . @$t12_jualdetail->ArticleID->EditAttrs["onchange"]; ?>
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $t12_jualdetail_grid->RowIndex ?>_ArticleID"><?php echo (strval($t12_jualdetail->ArticleID->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t12_jualdetail->ArticleID->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t12_jualdetail->ArticleID->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t12_jualdetail_grid->RowIndex ?>_ArticleID',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($t12_jualdetail->ArticleID->ReadOnly || $t12_jualdetail->ArticleID->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t12_jualdetail" data-field="x_ArticleID" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t12_jualdetail->ArticleID->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t12_jualdetail_grid->RowIndex ?>_ArticleID" id="x<?php echo $t12_jualdetail_grid->RowIndex ?>_ArticleID" value="<?php echo $t12_jualdetail->ArticleID->CurrentValue ?>"<?php echo $t12_jualdetail->ArticleID->EditAttributes() ?>>
<input type="hidden" name="ln_x<?php echo $t12_jualdetail_grid->RowIndex ?>_ArticleID" id="ln_x<?php echo $t12_jualdetail_grid->RowIndex ?>_ArticleID" value="x<?php echo $t12_jualdetail_grid->RowIndex ?>_HargaJual,x<?php echo $t12_jualdetail_grid->RowIndex ?>_SatuanID">
</span>
<input type="hidden" data-table="t12_jualdetail" data-field="x_ArticleID" name="o<?php echo $t12_jualdetail_grid->RowIndex ?>_ArticleID" id="o<?php echo $t12_jualdetail_grid->RowIndex ?>_ArticleID" value="<?php echo ew_HtmlEncode($t12_jualdetail->ArticleID->OldValue) ?>">
<?php } ?>
<?php if ($t12_jualdetail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t12_jualdetail_grid->RowCnt ?>_t12_jualdetail_ArticleID" class="form-group t12_jualdetail_ArticleID">
<?php $t12_jualdetail->ArticleID->EditAttrs["onchange"] = "ew_AutoFill(this); " . @$t12_jualdetail->ArticleID->EditAttrs["onchange"]; ?>
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $t12_jualdetail_grid->RowIndex ?>_ArticleID"><?php echo (strval($t12_jualdetail->ArticleID->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t12_jualdetail->ArticleID->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t12_jualdetail->ArticleID->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t12_jualdetail_grid->RowIndex ?>_ArticleID',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($t12_jualdetail->ArticleID->ReadOnly || $t12_jualdetail->ArticleID->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t12_jualdetail" data-field="x_ArticleID" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t12_jualdetail->ArticleID->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t12_jualdetail_grid->RowIndex ?>_ArticleID" id="x<?php echo $t12_jualdetail_grid->RowIndex ?>_ArticleID" value="<?php echo $t12_jualdetail->ArticleID->CurrentValue ?>"<?php echo $t12_jualdetail->ArticleID->EditAttributes() ?>>
<input type="hidden" name="ln_x<?php echo $t12_jualdetail_grid->RowIndex ?>_ArticleID" id="ln_x<?php echo $t12_jualdetail_grid->RowIndex ?>_ArticleID" value="x<?php echo $t12_jualdetail_grid->RowIndex ?>_HargaJual,x<?php echo $t12_jualdetail_grid->RowIndex ?>_SatuanID">
</span>
<?php } ?>
<?php if ($t12_jualdetail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t12_jualdetail_grid->RowCnt ?>_t12_jualdetail_ArticleID" class="t12_jualdetail_ArticleID">
<span<?php echo $t12_jualdetail->ArticleID->ViewAttributes() ?>>
<?php echo $t12_jualdetail->ArticleID->ListViewValue() ?></span>
</span>
<?php if ($t12_jualdetail->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t12_jualdetail" data-field="x_ArticleID" name="x<?php echo $t12_jualdetail_grid->RowIndex ?>_ArticleID" id="x<?php echo $t12_jualdetail_grid->RowIndex ?>_ArticleID" value="<?php echo ew_HtmlEncode($t12_jualdetail->ArticleID->FormValue) ?>">
<input type="hidden" data-table="t12_jualdetail" data-field="x_ArticleID" name="o<?php echo $t12_jualdetail_grid->RowIndex ?>_ArticleID" id="o<?php echo $t12_jualdetail_grid->RowIndex ?>_ArticleID" value="<?php echo ew_HtmlEncode($t12_jualdetail->ArticleID->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t12_jualdetail" data-field="x_ArticleID" name="ft12_jualdetailgrid$x<?php echo $t12_jualdetail_grid->RowIndex ?>_ArticleID" id="ft12_jualdetailgrid$x<?php echo $t12_jualdetail_grid->RowIndex ?>_ArticleID" value="<?php echo ew_HtmlEncode($t12_jualdetail->ArticleID->FormValue) ?>">
<input type="hidden" data-table="t12_jualdetail" data-field="x_ArticleID" name="ft12_jualdetailgrid$o<?php echo $t12_jualdetail_grid->RowIndex ?>_ArticleID" id="ft12_jualdetailgrid$o<?php echo $t12_jualdetail_grid->RowIndex ?>_ArticleID" value="<?php echo ew_HtmlEncode($t12_jualdetail->ArticleID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t12_jualdetail->HargaJual->Visible) { // HargaJual ?>
		<td data-name="HargaJual"<?php echo $t12_jualdetail->HargaJual->CellAttributes() ?>>
<?php if ($t12_jualdetail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t12_jualdetail_grid->RowCnt ?>_t12_jualdetail_HargaJual" class="form-group t12_jualdetail_HargaJual">
<input type="text" data-table="t12_jualdetail" data-field="x_HargaJual" name="x<?php echo $t12_jualdetail_grid->RowIndex ?>_HargaJual" id="x<?php echo $t12_jualdetail_grid->RowIndex ?>_HargaJual" size="7" placeholder="<?php echo ew_HtmlEncode($t12_jualdetail->HargaJual->getPlaceHolder()) ?>" value="<?php echo $t12_jualdetail->HargaJual->EditValue ?>"<?php echo $t12_jualdetail->HargaJual->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t12_jualdetail" data-field="x_HargaJual" name="o<?php echo $t12_jualdetail_grid->RowIndex ?>_HargaJual" id="o<?php echo $t12_jualdetail_grid->RowIndex ?>_HargaJual" value="<?php echo ew_HtmlEncode($t12_jualdetail->HargaJual->OldValue) ?>">
<?php } ?>
<?php if ($t12_jualdetail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t12_jualdetail_grid->RowCnt ?>_t12_jualdetail_HargaJual" class="form-group t12_jualdetail_HargaJual">
<input type="text" data-table="t12_jualdetail" data-field="x_HargaJual" name="x<?php echo $t12_jualdetail_grid->RowIndex ?>_HargaJual" id="x<?php echo $t12_jualdetail_grid->RowIndex ?>_HargaJual" size="7" placeholder="<?php echo ew_HtmlEncode($t12_jualdetail->HargaJual->getPlaceHolder()) ?>" value="<?php echo $t12_jualdetail->HargaJual->EditValue ?>"<?php echo $t12_jualdetail->HargaJual->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t12_jualdetail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t12_jualdetail_grid->RowCnt ?>_t12_jualdetail_HargaJual" class="t12_jualdetail_HargaJual">
<span<?php echo $t12_jualdetail->HargaJual->ViewAttributes() ?>>
<?php echo $t12_jualdetail->HargaJual->ListViewValue() ?></span>
</span>
<?php if ($t12_jualdetail->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t12_jualdetail" data-field="x_HargaJual" name="x<?php echo $t12_jualdetail_grid->RowIndex ?>_HargaJual" id="x<?php echo $t12_jualdetail_grid->RowIndex ?>_HargaJual" value="<?php echo ew_HtmlEncode($t12_jualdetail->HargaJual->FormValue) ?>">
<input type="hidden" data-table="t12_jualdetail" data-field="x_HargaJual" name="o<?php echo $t12_jualdetail_grid->RowIndex ?>_HargaJual" id="o<?php echo $t12_jualdetail_grid->RowIndex ?>_HargaJual" value="<?php echo ew_HtmlEncode($t12_jualdetail->HargaJual->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t12_jualdetail" data-field="x_HargaJual" name="ft12_jualdetailgrid$x<?php echo $t12_jualdetail_grid->RowIndex ?>_HargaJual" id="ft12_jualdetailgrid$x<?php echo $t12_jualdetail_grid->RowIndex ?>_HargaJual" value="<?php echo ew_HtmlEncode($t12_jualdetail->HargaJual->FormValue) ?>">
<input type="hidden" data-table="t12_jualdetail" data-field="x_HargaJual" name="ft12_jualdetailgrid$o<?php echo $t12_jualdetail_grid->RowIndex ?>_HargaJual" id="ft12_jualdetailgrid$o<?php echo $t12_jualdetail_grid->RowIndex ?>_HargaJual" value="<?php echo ew_HtmlEncode($t12_jualdetail->HargaJual->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t12_jualdetail->Qty->Visible) { // Qty ?>
		<td data-name="Qty"<?php echo $t12_jualdetail->Qty->CellAttributes() ?>>
<?php if ($t12_jualdetail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t12_jualdetail_grid->RowCnt ?>_t12_jualdetail_Qty" class="form-group t12_jualdetail_Qty">
<input type="text" data-table="t12_jualdetail" data-field="x_Qty" name="x<?php echo $t12_jualdetail_grid->RowIndex ?>_Qty" id="x<?php echo $t12_jualdetail_grid->RowIndex ?>_Qty" size="2" placeholder="<?php echo ew_HtmlEncode($t12_jualdetail->Qty->getPlaceHolder()) ?>" value="<?php echo $t12_jualdetail->Qty->EditValue ?>"<?php echo $t12_jualdetail->Qty->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t12_jualdetail" data-field="x_Qty" name="o<?php echo $t12_jualdetail_grid->RowIndex ?>_Qty" id="o<?php echo $t12_jualdetail_grid->RowIndex ?>_Qty" value="<?php echo ew_HtmlEncode($t12_jualdetail->Qty->OldValue) ?>">
<?php } ?>
<?php if ($t12_jualdetail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t12_jualdetail_grid->RowCnt ?>_t12_jualdetail_Qty" class="form-group t12_jualdetail_Qty">
<input type="text" data-table="t12_jualdetail" data-field="x_Qty" name="x<?php echo $t12_jualdetail_grid->RowIndex ?>_Qty" id="x<?php echo $t12_jualdetail_grid->RowIndex ?>_Qty" size="2" placeholder="<?php echo ew_HtmlEncode($t12_jualdetail->Qty->getPlaceHolder()) ?>" value="<?php echo $t12_jualdetail->Qty->EditValue ?>"<?php echo $t12_jualdetail->Qty->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t12_jualdetail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t12_jualdetail_grid->RowCnt ?>_t12_jualdetail_Qty" class="t12_jualdetail_Qty">
<span<?php echo $t12_jualdetail->Qty->ViewAttributes() ?>>
<?php echo $t12_jualdetail->Qty->ListViewValue() ?></span>
</span>
<?php if ($t12_jualdetail->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t12_jualdetail" data-field="x_Qty" name="x<?php echo $t12_jualdetail_grid->RowIndex ?>_Qty" id="x<?php echo $t12_jualdetail_grid->RowIndex ?>_Qty" value="<?php echo ew_HtmlEncode($t12_jualdetail->Qty->FormValue) ?>">
<input type="hidden" data-table="t12_jualdetail" data-field="x_Qty" name="o<?php echo $t12_jualdetail_grid->RowIndex ?>_Qty" id="o<?php echo $t12_jualdetail_grid->RowIndex ?>_Qty" value="<?php echo ew_HtmlEncode($t12_jualdetail->Qty->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t12_jualdetail" data-field="x_Qty" name="ft12_jualdetailgrid$x<?php echo $t12_jualdetail_grid->RowIndex ?>_Qty" id="ft12_jualdetailgrid$x<?php echo $t12_jualdetail_grid->RowIndex ?>_Qty" value="<?php echo ew_HtmlEncode($t12_jualdetail->Qty->FormValue) ?>">
<input type="hidden" data-table="t12_jualdetail" data-field="x_Qty" name="ft12_jualdetailgrid$o<?php echo $t12_jualdetail_grid->RowIndex ?>_Qty" id="ft12_jualdetailgrid$o<?php echo $t12_jualdetail_grid->RowIndex ?>_Qty" value="<?php echo ew_HtmlEncode($t12_jualdetail->Qty->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t12_jualdetail->SatuanID->Visible) { // SatuanID ?>
		<td data-name="SatuanID"<?php echo $t12_jualdetail->SatuanID->CellAttributes() ?>>
<?php if ($t12_jualdetail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t12_jualdetail_grid->RowCnt ?>_t12_jualdetail_SatuanID" class="form-group t12_jualdetail_SatuanID">
<?php
$wrkonchange = trim(" " . @$t12_jualdetail->SatuanID->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$t12_jualdetail->SatuanID->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t12_jualdetail_grid->RowIndex ?>_SatuanID" style="white-space: nowrap; z-index: <?php echo (9000 - $t12_jualdetail_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $t12_jualdetail_grid->RowIndex ?>_SatuanID" id="sv_x<?php echo $t12_jualdetail_grid->RowIndex ?>_SatuanID" value="<?php echo $t12_jualdetail->SatuanID->EditValue ?>" size="3" placeholder="<?php echo ew_HtmlEncode($t12_jualdetail->SatuanID->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($t12_jualdetail->SatuanID->getPlaceHolder()) ?>"<?php echo $t12_jualdetail->SatuanID->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t12_jualdetail" data-field="x_SatuanID" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t12_jualdetail->SatuanID->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t12_jualdetail_grid->RowIndex ?>_SatuanID" id="x<?php echo $t12_jualdetail_grid->RowIndex ?>_SatuanID" value="<?php echo ew_HtmlEncode($t12_jualdetail->SatuanID->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script type="text/javascript">
ft12_jualdetailgrid.CreateAutoSuggest({"id":"x<?php echo $t12_jualdetail_grid->RowIndex ?>_SatuanID","forceSelect":true});
</script>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t12_jualdetail->SatuanID->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t12_jualdetail_grid->RowIndex ?>_SatuanID',m:0,n:10,srch:false});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($t12_jualdetail->SatuanID->ReadOnly || $t12_jualdetail->SatuanID->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
</span>
<input type="hidden" data-table="t12_jualdetail" data-field="x_SatuanID" name="o<?php echo $t12_jualdetail_grid->RowIndex ?>_SatuanID" id="o<?php echo $t12_jualdetail_grid->RowIndex ?>_SatuanID" value="<?php echo ew_HtmlEncode($t12_jualdetail->SatuanID->OldValue) ?>">
<?php } ?>
<?php if ($t12_jualdetail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t12_jualdetail_grid->RowCnt ?>_t12_jualdetail_SatuanID" class="form-group t12_jualdetail_SatuanID">
<?php
$wrkonchange = trim(" " . @$t12_jualdetail->SatuanID->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$t12_jualdetail->SatuanID->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t12_jualdetail_grid->RowIndex ?>_SatuanID" style="white-space: nowrap; z-index: <?php echo (9000 - $t12_jualdetail_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $t12_jualdetail_grid->RowIndex ?>_SatuanID" id="sv_x<?php echo $t12_jualdetail_grid->RowIndex ?>_SatuanID" value="<?php echo $t12_jualdetail->SatuanID->EditValue ?>" size="3" placeholder="<?php echo ew_HtmlEncode($t12_jualdetail->SatuanID->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($t12_jualdetail->SatuanID->getPlaceHolder()) ?>"<?php echo $t12_jualdetail->SatuanID->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t12_jualdetail" data-field="x_SatuanID" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t12_jualdetail->SatuanID->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t12_jualdetail_grid->RowIndex ?>_SatuanID" id="x<?php echo $t12_jualdetail_grid->RowIndex ?>_SatuanID" value="<?php echo ew_HtmlEncode($t12_jualdetail->SatuanID->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script type="text/javascript">
ft12_jualdetailgrid.CreateAutoSuggest({"id":"x<?php echo $t12_jualdetail_grid->RowIndex ?>_SatuanID","forceSelect":true});
</script>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t12_jualdetail->SatuanID->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t12_jualdetail_grid->RowIndex ?>_SatuanID',m:0,n:10,srch:false});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($t12_jualdetail->SatuanID->ReadOnly || $t12_jualdetail->SatuanID->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
</span>
<?php } ?>
<?php if ($t12_jualdetail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t12_jualdetail_grid->RowCnt ?>_t12_jualdetail_SatuanID" class="t12_jualdetail_SatuanID">
<span<?php echo $t12_jualdetail->SatuanID->ViewAttributes() ?>>
<?php echo $t12_jualdetail->SatuanID->ListViewValue() ?></span>
</span>
<?php if ($t12_jualdetail->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t12_jualdetail" data-field="x_SatuanID" name="x<?php echo $t12_jualdetail_grid->RowIndex ?>_SatuanID" id="x<?php echo $t12_jualdetail_grid->RowIndex ?>_SatuanID" value="<?php echo ew_HtmlEncode($t12_jualdetail->SatuanID->FormValue) ?>">
<input type="hidden" data-table="t12_jualdetail" data-field="x_SatuanID" name="o<?php echo $t12_jualdetail_grid->RowIndex ?>_SatuanID" id="o<?php echo $t12_jualdetail_grid->RowIndex ?>_SatuanID" value="<?php echo ew_HtmlEncode($t12_jualdetail->SatuanID->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t12_jualdetail" data-field="x_SatuanID" name="ft12_jualdetailgrid$x<?php echo $t12_jualdetail_grid->RowIndex ?>_SatuanID" id="ft12_jualdetailgrid$x<?php echo $t12_jualdetail_grid->RowIndex ?>_SatuanID" value="<?php echo ew_HtmlEncode($t12_jualdetail->SatuanID->FormValue) ?>">
<input type="hidden" data-table="t12_jualdetail" data-field="x_SatuanID" name="ft12_jualdetailgrid$o<?php echo $t12_jualdetail_grid->RowIndex ?>_SatuanID" id="ft12_jualdetailgrid$o<?php echo $t12_jualdetail_grid->RowIndex ?>_SatuanID" value="<?php echo ew_HtmlEncode($t12_jualdetail->SatuanID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t12_jualdetail->SubTotal->Visible) { // SubTotal ?>
		<td data-name="SubTotal"<?php echo $t12_jualdetail->SubTotal->CellAttributes() ?>>
<?php if ($t12_jualdetail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t12_jualdetail_grid->RowCnt ?>_t12_jualdetail_SubTotal" class="form-group t12_jualdetail_SubTotal">
<input type="text" data-table="t12_jualdetail" data-field="x_SubTotal" name="x<?php echo $t12_jualdetail_grid->RowIndex ?>_SubTotal" id="x<?php echo $t12_jualdetail_grid->RowIndex ?>_SubTotal" size="7" placeholder="<?php echo ew_HtmlEncode($t12_jualdetail->SubTotal->getPlaceHolder()) ?>" value="<?php echo $t12_jualdetail->SubTotal->EditValue ?>"<?php echo $t12_jualdetail->SubTotal->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t12_jualdetail" data-field="x_SubTotal" name="o<?php echo $t12_jualdetail_grid->RowIndex ?>_SubTotal" id="o<?php echo $t12_jualdetail_grid->RowIndex ?>_SubTotal" value="<?php echo ew_HtmlEncode($t12_jualdetail->SubTotal->OldValue) ?>">
<?php } ?>
<?php if ($t12_jualdetail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t12_jualdetail_grid->RowCnt ?>_t12_jualdetail_SubTotal" class="form-group t12_jualdetail_SubTotal">
<input type="text" data-table="t12_jualdetail" data-field="x_SubTotal" name="x<?php echo $t12_jualdetail_grid->RowIndex ?>_SubTotal" id="x<?php echo $t12_jualdetail_grid->RowIndex ?>_SubTotal" size="7" placeholder="<?php echo ew_HtmlEncode($t12_jualdetail->SubTotal->getPlaceHolder()) ?>" value="<?php echo $t12_jualdetail->SubTotal->EditValue ?>"<?php echo $t12_jualdetail->SubTotal->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t12_jualdetail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t12_jualdetail_grid->RowCnt ?>_t12_jualdetail_SubTotal" class="t12_jualdetail_SubTotal">
<span<?php echo $t12_jualdetail->SubTotal->ViewAttributes() ?>>
<?php echo $t12_jualdetail->SubTotal->ListViewValue() ?></span>
</span>
<?php if ($t12_jualdetail->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t12_jualdetail" data-field="x_SubTotal" name="x<?php echo $t12_jualdetail_grid->RowIndex ?>_SubTotal" id="x<?php echo $t12_jualdetail_grid->RowIndex ?>_SubTotal" value="<?php echo ew_HtmlEncode($t12_jualdetail->SubTotal->FormValue) ?>">
<input type="hidden" data-table="t12_jualdetail" data-field="x_SubTotal" name="o<?php echo $t12_jualdetail_grid->RowIndex ?>_SubTotal" id="o<?php echo $t12_jualdetail_grid->RowIndex ?>_SubTotal" value="<?php echo ew_HtmlEncode($t12_jualdetail->SubTotal->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t12_jualdetail" data-field="x_SubTotal" name="ft12_jualdetailgrid$x<?php echo $t12_jualdetail_grid->RowIndex ?>_SubTotal" id="ft12_jualdetailgrid$x<?php echo $t12_jualdetail_grid->RowIndex ?>_SubTotal" value="<?php echo ew_HtmlEncode($t12_jualdetail->SubTotal->FormValue) ?>">
<input type="hidden" data-table="t12_jualdetail" data-field="x_SubTotal" name="ft12_jualdetailgrid$o<?php echo $t12_jualdetail_grid->RowIndex ?>_SubTotal" id="ft12_jualdetailgrid$o<?php echo $t12_jualdetail_grid->RowIndex ?>_SubTotal" value="<?php echo ew_HtmlEncode($t12_jualdetail->SubTotal->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t12_jualdetail_grid->ListOptions->Render("body", "right", $t12_jualdetail_grid->RowCnt);
?>
	</tr>
<?php if ($t12_jualdetail->RowType == EW_ROWTYPE_ADD || $t12_jualdetail->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
ft12_jualdetailgrid.UpdateOpts(<?php echo $t12_jualdetail_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($t12_jualdetail->CurrentAction <> "gridadd" || $t12_jualdetail->CurrentMode == "copy")
		if (!$t12_jualdetail_grid->Recordset->EOF) $t12_jualdetail_grid->Recordset->MoveNext();
}
?>
<?php
	if ($t12_jualdetail->CurrentMode == "add" || $t12_jualdetail->CurrentMode == "copy" || $t12_jualdetail->CurrentMode == "edit") {
		$t12_jualdetail_grid->RowIndex = '$rowindex$';
		$t12_jualdetail_grid->LoadRowValues();

		// Set row properties
		$t12_jualdetail->ResetAttrs();
		$t12_jualdetail->RowAttrs = array_merge($t12_jualdetail->RowAttrs, array('data-rowindex'=>$t12_jualdetail_grid->RowIndex, 'id'=>'r0_t12_jualdetail', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($t12_jualdetail->RowAttrs["class"], "ewTemplate");
		$t12_jualdetail->RowType = EW_ROWTYPE_ADD;

		// Render row
		$t12_jualdetail_grid->RenderRow();

		// Render list options
		$t12_jualdetail_grid->RenderListOptions();
		$t12_jualdetail_grid->StartRowCnt = 0;
?>
	<tr<?php echo $t12_jualdetail->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t12_jualdetail_grid->ListOptions->Render("body", "left", $t12_jualdetail_grid->RowIndex);
?>
	<?php if ($t12_jualdetail->JualID->Visible) { // JualID ?>
		<td data-name="JualID">
<?php if ($t12_jualdetail->CurrentAction <> "F") { ?>
<?php if ($t12_jualdetail->JualID->getSessionValue() <> "") { ?>
<span id="el$rowindex$_t12_jualdetail_JualID" class="form-group t12_jualdetail_JualID">
<span<?php echo $t12_jualdetail->JualID->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t12_jualdetail->JualID->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t12_jualdetail_grid->RowIndex ?>_JualID" name="x<?php echo $t12_jualdetail_grid->RowIndex ?>_JualID" value="<?php echo ew_HtmlEncode($t12_jualdetail->JualID->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_t12_jualdetail_JualID" class="form-group t12_jualdetail_JualID">
<input type="text" data-table="t12_jualdetail" data-field="x_JualID" name="x<?php echo $t12_jualdetail_grid->RowIndex ?>_JualID" id="x<?php echo $t12_jualdetail_grid->RowIndex ?>_JualID" size="30" placeholder="<?php echo ew_HtmlEncode($t12_jualdetail->JualID->getPlaceHolder()) ?>" value="<?php echo $t12_jualdetail->JualID->EditValue ?>"<?php echo $t12_jualdetail->JualID->EditAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_t12_jualdetail_JualID" class="form-group t12_jualdetail_JualID">
<span<?php echo $t12_jualdetail->JualID->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t12_jualdetail->JualID->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t12_jualdetail" data-field="x_JualID" name="x<?php echo $t12_jualdetail_grid->RowIndex ?>_JualID" id="x<?php echo $t12_jualdetail_grid->RowIndex ?>_JualID" value="<?php echo ew_HtmlEncode($t12_jualdetail->JualID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t12_jualdetail" data-field="x_JualID" name="o<?php echo $t12_jualdetail_grid->RowIndex ?>_JualID" id="o<?php echo $t12_jualdetail_grid->RowIndex ?>_JualID" value="<?php echo ew_HtmlEncode($t12_jualdetail->JualID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t12_jualdetail->ArticleID->Visible) { // ArticleID ?>
		<td data-name="ArticleID">
<?php if ($t12_jualdetail->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t12_jualdetail_ArticleID" class="form-group t12_jualdetail_ArticleID">
<?php $t12_jualdetail->ArticleID->EditAttrs["onchange"] = "ew_AutoFill(this); " . @$t12_jualdetail->ArticleID->EditAttrs["onchange"]; ?>
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $t12_jualdetail_grid->RowIndex ?>_ArticleID"><?php echo (strval($t12_jualdetail->ArticleID->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t12_jualdetail->ArticleID->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t12_jualdetail->ArticleID->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t12_jualdetail_grid->RowIndex ?>_ArticleID',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($t12_jualdetail->ArticleID->ReadOnly || $t12_jualdetail->ArticleID->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t12_jualdetail" data-field="x_ArticleID" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t12_jualdetail->ArticleID->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t12_jualdetail_grid->RowIndex ?>_ArticleID" id="x<?php echo $t12_jualdetail_grid->RowIndex ?>_ArticleID" value="<?php echo $t12_jualdetail->ArticleID->CurrentValue ?>"<?php echo $t12_jualdetail->ArticleID->EditAttributes() ?>>
<input type="hidden" name="ln_x<?php echo $t12_jualdetail_grid->RowIndex ?>_ArticleID" id="ln_x<?php echo $t12_jualdetail_grid->RowIndex ?>_ArticleID" value="x<?php echo $t12_jualdetail_grid->RowIndex ?>_HargaJual,x<?php echo $t12_jualdetail_grid->RowIndex ?>_SatuanID">
</span>
<?php } else { ?>
<span id="el$rowindex$_t12_jualdetail_ArticleID" class="form-group t12_jualdetail_ArticleID">
<span<?php echo $t12_jualdetail->ArticleID->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t12_jualdetail->ArticleID->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t12_jualdetail" data-field="x_ArticleID" name="x<?php echo $t12_jualdetail_grid->RowIndex ?>_ArticleID" id="x<?php echo $t12_jualdetail_grid->RowIndex ?>_ArticleID" value="<?php echo ew_HtmlEncode($t12_jualdetail->ArticleID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t12_jualdetail" data-field="x_ArticleID" name="o<?php echo $t12_jualdetail_grid->RowIndex ?>_ArticleID" id="o<?php echo $t12_jualdetail_grid->RowIndex ?>_ArticleID" value="<?php echo ew_HtmlEncode($t12_jualdetail->ArticleID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t12_jualdetail->HargaJual->Visible) { // HargaJual ?>
		<td data-name="HargaJual">
<?php if ($t12_jualdetail->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t12_jualdetail_HargaJual" class="form-group t12_jualdetail_HargaJual">
<input type="text" data-table="t12_jualdetail" data-field="x_HargaJual" name="x<?php echo $t12_jualdetail_grid->RowIndex ?>_HargaJual" id="x<?php echo $t12_jualdetail_grid->RowIndex ?>_HargaJual" size="7" placeholder="<?php echo ew_HtmlEncode($t12_jualdetail->HargaJual->getPlaceHolder()) ?>" value="<?php echo $t12_jualdetail->HargaJual->EditValue ?>"<?php echo $t12_jualdetail->HargaJual->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t12_jualdetail_HargaJual" class="form-group t12_jualdetail_HargaJual">
<span<?php echo $t12_jualdetail->HargaJual->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t12_jualdetail->HargaJual->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t12_jualdetail" data-field="x_HargaJual" name="x<?php echo $t12_jualdetail_grid->RowIndex ?>_HargaJual" id="x<?php echo $t12_jualdetail_grid->RowIndex ?>_HargaJual" value="<?php echo ew_HtmlEncode($t12_jualdetail->HargaJual->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t12_jualdetail" data-field="x_HargaJual" name="o<?php echo $t12_jualdetail_grid->RowIndex ?>_HargaJual" id="o<?php echo $t12_jualdetail_grid->RowIndex ?>_HargaJual" value="<?php echo ew_HtmlEncode($t12_jualdetail->HargaJual->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t12_jualdetail->Qty->Visible) { // Qty ?>
		<td data-name="Qty">
<?php if ($t12_jualdetail->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t12_jualdetail_Qty" class="form-group t12_jualdetail_Qty">
<input type="text" data-table="t12_jualdetail" data-field="x_Qty" name="x<?php echo $t12_jualdetail_grid->RowIndex ?>_Qty" id="x<?php echo $t12_jualdetail_grid->RowIndex ?>_Qty" size="2" placeholder="<?php echo ew_HtmlEncode($t12_jualdetail->Qty->getPlaceHolder()) ?>" value="<?php echo $t12_jualdetail->Qty->EditValue ?>"<?php echo $t12_jualdetail->Qty->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t12_jualdetail_Qty" class="form-group t12_jualdetail_Qty">
<span<?php echo $t12_jualdetail->Qty->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t12_jualdetail->Qty->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t12_jualdetail" data-field="x_Qty" name="x<?php echo $t12_jualdetail_grid->RowIndex ?>_Qty" id="x<?php echo $t12_jualdetail_grid->RowIndex ?>_Qty" value="<?php echo ew_HtmlEncode($t12_jualdetail->Qty->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t12_jualdetail" data-field="x_Qty" name="o<?php echo $t12_jualdetail_grid->RowIndex ?>_Qty" id="o<?php echo $t12_jualdetail_grid->RowIndex ?>_Qty" value="<?php echo ew_HtmlEncode($t12_jualdetail->Qty->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t12_jualdetail->SatuanID->Visible) { // SatuanID ?>
		<td data-name="SatuanID">
<?php if ($t12_jualdetail->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t12_jualdetail_SatuanID" class="form-group t12_jualdetail_SatuanID">
<?php
$wrkonchange = trim(" " . @$t12_jualdetail->SatuanID->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$t12_jualdetail->SatuanID->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t12_jualdetail_grid->RowIndex ?>_SatuanID" style="white-space: nowrap; z-index: <?php echo (9000 - $t12_jualdetail_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $t12_jualdetail_grid->RowIndex ?>_SatuanID" id="sv_x<?php echo $t12_jualdetail_grid->RowIndex ?>_SatuanID" value="<?php echo $t12_jualdetail->SatuanID->EditValue ?>" size="3" placeholder="<?php echo ew_HtmlEncode($t12_jualdetail->SatuanID->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($t12_jualdetail->SatuanID->getPlaceHolder()) ?>"<?php echo $t12_jualdetail->SatuanID->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t12_jualdetail" data-field="x_SatuanID" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t12_jualdetail->SatuanID->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t12_jualdetail_grid->RowIndex ?>_SatuanID" id="x<?php echo $t12_jualdetail_grid->RowIndex ?>_SatuanID" value="<?php echo ew_HtmlEncode($t12_jualdetail->SatuanID->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script type="text/javascript">
ft12_jualdetailgrid.CreateAutoSuggest({"id":"x<?php echo $t12_jualdetail_grid->RowIndex ?>_SatuanID","forceSelect":true});
</script>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t12_jualdetail->SatuanID->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t12_jualdetail_grid->RowIndex ?>_SatuanID',m:0,n:10,srch:false});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($t12_jualdetail->SatuanID->ReadOnly || $t12_jualdetail->SatuanID->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
</span>
<?php } else { ?>
<span id="el$rowindex$_t12_jualdetail_SatuanID" class="form-group t12_jualdetail_SatuanID">
<span<?php echo $t12_jualdetail->SatuanID->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t12_jualdetail->SatuanID->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t12_jualdetail" data-field="x_SatuanID" name="x<?php echo $t12_jualdetail_grid->RowIndex ?>_SatuanID" id="x<?php echo $t12_jualdetail_grid->RowIndex ?>_SatuanID" value="<?php echo ew_HtmlEncode($t12_jualdetail->SatuanID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t12_jualdetail" data-field="x_SatuanID" name="o<?php echo $t12_jualdetail_grid->RowIndex ?>_SatuanID" id="o<?php echo $t12_jualdetail_grid->RowIndex ?>_SatuanID" value="<?php echo ew_HtmlEncode($t12_jualdetail->SatuanID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t12_jualdetail->SubTotal->Visible) { // SubTotal ?>
		<td data-name="SubTotal">
<?php if ($t12_jualdetail->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t12_jualdetail_SubTotal" class="form-group t12_jualdetail_SubTotal">
<input type="text" data-table="t12_jualdetail" data-field="x_SubTotal" name="x<?php echo $t12_jualdetail_grid->RowIndex ?>_SubTotal" id="x<?php echo $t12_jualdetail_grid->RowIndex ?>_SubTotal" size="7" placeholder="<?php echo ew_HtmlEncode($t12_jualdetail->SubTotal->getPlaceHolder()) ?>" value="<?php echo $t12_jualdetail->SubTotal->EditValue ?>"<?php echo $t12_jualdetail->SubTotal->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t12_jualdetail_SubTotal" class="form-group t12_jualdetail_SubTotal">
<span<?php echo $t12_jualdetail->SubTotal->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t12_jualdetail->SubTotal->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t12_jualdetail" data-field="x_SubTotal" name="x<?php echo $t12_jualdetail_grid->RowIndex ?>_SubTotal" id="x<?php echo $t12_jualdetail_grid->RowIndex ?>_SubTotal" value="<?php echo ew_HtmlEncode($t12_jualdetail->SubTotal->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t12_jualdetail" data-field="x_SubTotal" name="o<?php echo $t12_jualdetail_grid->RowIndex ?>_SubTotal" id="o<?php echo $t12_jualdetail_grid->RowIndex ?>_SubTotal" value="<?php echo ew_HtmlEncode($t12_jualdetail->SubTotal->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t12_jualdetail_grid->ListOptions->Render("body", "right", $t12_jualdetail_grid->RowIndex);
?>
<script type="text/javascript">
ft12_jualdetailgrid.UpdateOpts(<?php echo $t12_jualdetail_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($t12_jualdetail->CurrentMode == "add" || $t12_jualdetail->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $t12_jualdetail_grid->FormKeyCountName ?>" id="<?php echo $t12_jualdetail_grid->FormKeyCountName ?>" value="<?php echo $t12_jualdetail_grid->KeyCount ?>">
<?php echo $t12_jualdetail_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t12_jualdetail->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $t12_jualdetail_grid->FormKeyCountName ?>" id="<?php echo $t12_jualdetail_grid->FormKeyCountName ?>" value="<?php echo $t12_jualdetail_grid->KeyCount ?>">
<?php echo $t12_jualdetail_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t12_jualdetail->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft12_jualdetailgrid">
</div>
<?php

// Close recordset
if ($t12_jualdetail_grid->Recordset)
	$t12_jualdetail_grid->Recordset->Close();
?>
<?php if ($t12_jualdetail_grid->ShowOtherOptions) { ?>
<div class="box-footer ewGridLowerPanel">
<?php
	foreach ($t12_jualdetail_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($t12_jualdetail_grid->TotalRecs == 0 && $t12_jualdetail->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t12_jualdetail_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($t12_jualdetail->Export == "") { ?>
<script type="text/javascript">
ft12_jualdetailgrid.Init();
</script>
<?php } ?>
<?php
$t12_jualdetail_grid->Page_Terminate();
?>
