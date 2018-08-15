<?php include_once "t96_employeesinfo.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($t15_piutangdetail_grid)) $t15_piutangdetail_grid = new ct15_piutangdetail_grid();

// Page init
$t15_piutangdetail_grid->Page_Init();

// Page main
$t15_piutangdetail_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t15_piutangdetail_grid->Page_Render();
?>
<?php if ($t15_piutangdetail->Export == "") { ?>
<script type="text/javascript">

// Form object
var ft15_piutangdetailgrid = new ew_Form("ft15_piutangdetailgrid", "grid");
ft15_piutangdetailgrid.FormKeyCountName = '<?php echo $t15_piutangdetail_grid->FormKeyCountName ?>';

// Validate form
ft15_piutangdetailgrid.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_NoBayar");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t15_piutangdetail->NoBayar->FldCaption(), $t15_piutangdetail->NoBayar->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Tgl");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t15_piutangdetail->Tgl->FldCaption(), $t15_piutangdetail->Tgl->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Tgl");
			if (elm && !ew_CheckEuroDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t15_piutangdetail->Tgl->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_JumlahBayar");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t15_piutangdetail->JumlahBayar->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
ft15_piutangdetailgrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "NoBayar", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Tgl", false)) return false;
	if (ew_ValueChanged(fobj, infix, "JumlahBayar", false)) return false;
	return true;
}

// Form_CustomValidate event
ft15_piutangdetailgrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ft15_piutangdetailgrid.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<?php } ?>
<?php
if ($t15_piutangdetail->CurrentAction == "gridadd") {
	if ($t15_piutangdetail->CurrentMode == "copy") {
		$bSelectLimit = $t15_piutangdetail_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$t15_piutangdetail_grid->TotalRecs = $t15_piutangdetail->ListRecordCount();
			$t15_piutangdetail_grid->Recordset = $t15_piutangdetail_grid->LoadRecordset($t15_piutangdetail_grid->StartRec-1, $t15_piutangdetail_grid->DisplayRecs);
		} else {
			if ($t15_piutangdetail_grid->Recordset = $t15_piutangdetail_grid->LoadRecordset())
				$t15_piutangdetail_grid->TotalRecs = $t15_piutangdetail_grid->Recordset->RecordCount();
		}
		$t15_piutangdetail_grid->StartRec = 1;
		$t15_piutangdetail_grid->DisplayRecs = $t15_piutangdetail_grid->TotalRecs;
	} else {
		$t15_piutangdetail->CurrentFilter = "0=1";
		$t15_piutangdetail_grid->StartRec = 1;
		$t15_piutangdetail_grid->DisplayRecs = $t15_piutangdetail->GridAddRowCount;
	}
	$t15_piutangdetail_grid->TotalRecs = $t15_piutangdetail_grid->DisplayRecs;
	$t15_piutangdetail_grid->StopRec = $t15_piutangdetail_grid->DisplayRecs;
} else {
	$bSelectLimit = $t15_piutangdetail_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($t15_piutangdetail_grid->TotalRecs <= 0)
			$t15_piutangdetail_grid->TotalRecs = $t15_piutangdetail->ListRecordCount();
	} else {
		if (!$t15_piutangdetail_grid->Recordset && ($t15_piutangdetail_grid->Recordset = $t15_piutangdetail_grid->LoadRecordset()))
			$t15_piutangdetail_grid->TotalRecs = $t15_piutangdetail_grid->Recordset->RecordCount();
	}
	$t15_piutangdetail_grid->StartRec = 1;
	$t15_piutangdetail_grid->DisplayRecs = $t15_piutangdetail_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$t15_piutangdetail_grid->Recordset = $t15_piutangdetail_grid->LoadRecordset($t15_piutangdetail_grid->StartRec-1, $t15_piutangdetail_grid->DisplayRecs);

	// Set no record found message
	if ($t15_piutangdetail->CurrentAction == "" && $t15_piutangdetail_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$t15_piutangdetail_grid->setWarningMessage(ew_DeniedMsg());
		if ($t15_piutangdetail_grid->SearchWhere == "0=101")
			$t15_piutangdetail_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$t15_piutangdetail_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$t15_piutangdetail_grid->RenderOtherOptions();
?>
<?php $t15_piutangdetail_grid->ShowPageHeader(); ?>
<?php
$t15_piutangdetail_grid->ShowMessage();
?>
<?php if ($t15_piutangdetail_grid->TotalRecs > 0 || $t15_piutangdetail->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($t15_piutangdetail_grid->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> t15_piutangdetail">
<div id="ft15_piutangdetailgrid" class="ewForm ewListForm form-inline">
<?php if ($t15_piutangdetail_grid->ShowOtherOptions) { ?>
<div class="box-header ewGridUpperPanel">
<?php
	foreach ($t15_piutangdetail_grid->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="gmp_t15_piutangdetail" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table id="tbl_t15_piutangdetailgrid" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$t15_piutangdetail_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$t15_piutangdetail_grid->RenderListOptions();

// Render list options (header, left)
$t15_piutangdetail_grid->ListOptions->Render("header", "left");
?>
<?php if ($t15_piutangdetail->NoBayar->Visible) { // NoBayar ?>
	<?php if ($t15_piutangdetail->SortUrl($t15_piutangdetail->NoBayar) == "") { ?>
		<th data-name="NoBayar" class="<?php echo $t15_piutangdetail->NoBayar->HeaderCellClass() ?>"><div id="elh_t15_piutangdetail_NoBayar" class="t15_piutangdetail_NoBayar"><div class="ewTableHeaderCaption"><?php echo $t15_piutangdetail->NoBayar->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NoBayar" class="<?php echo $t15_piutangdetail->NoBayar->HeaderCellClass() ?>"><div><div id="elh_t15_piutangdetail_NoBayar" class="t15_piutangdetail_NoBayar">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t15_piutangdetail->NoBayar->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t15_piutangdetail->NoBayar->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t15_piutangdetail->NoBayar->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t15_piutangdetail->Tgl->Visible) { // Tgl ?>
	<?php if ($t15_piutangdetail->SortUrl($t15_piutangdetail->Tgl) == "") { ?>
		<th data-name="Tgl" class="<?php echo $t15_piutangdetail->Tgl->HeaderCellClass() ?>"><div id="elh_t15_piutangdetail_Tgl" class="t15_piutangdetail_Tgl"><div class="ewTableHeaderCaption"><?php echo $t15_piutangdetail->Tgl->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Tgl" class="<?php echo $t15_piutangdetail->Tgl->HeaderCellClass() ?>"><div><div id="elh_t15_piutangdetail_Tgl" class="t15_piutangdetail_Tgl">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t15_piutangdetail->Tgl->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t15_piutangdetail->Tgl->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t15_piutangdetail->Tgl->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t15_piutangdetail->JumlahBayar->Visible) { // JumlahBayar ?>
	<?php if ($t15_piutangdetail->SortUrl($t15_piutangdetail->JumlahBayar) == "") { ?>
		<th data-name="JumlahBayar" class="<?php echo $t15_piutangdetail->JumlahBayar->HeaderCellClass() ?>"><div id="elh_t15_piutangdetail_JumlahBayar" class="t15_piutangdetail_JumlahBayar"><div class="ewTableHeaderCaption"><?php echo $t15_piutangdetail->JumlahBayar->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="JumlahBayar" class="<?php echo $t15_piutangdetail->JumlahBayar->HeaderCellClass() ?>"><div><div id="elh_t15_piutangdetail_JumlahBayar" class="t15_piutangdetail_JumlahBayar">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t15_piutangdetail->JumlahBayar->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t15_piutangdetail->JumlahBayar->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t15_piutangdetail->JumlahBayar->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t15_piutangdetail_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t15_piutangdetail_grid->StartRec = 1;
$t15_piutangdetail_grid->StopRec = $t15_piutangdetail_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($t15_piutangdetail_grid->FormKeyCountName) && ($t15_piutangdetail->CurrentAction == "gridadd" || $t15_piutangdetail->CurrentAction == "gridedit" || $t15_piutangdetail->CurrentAction == "F")) {
		$t15_piutangdetail_grid->KeyCount = $objForm->GetValue($t15_piutangdetail_grid->FormKeyCountName);
		$t15_piutangdetail_grid->StopRec = $t15_piutangdetail_grid->StartRec + $t15_piutangdetail_grid->KeyCount - 1;
	}
}
$t15_piutangdetail_grid->RecCnt = $t15_piutangdetail_grid->StartRec - 1;
if ($t15_piutangdetail_grid->Recordset && !$t15_piutangdetail_grid->Recordset->EOF) {
	$t15_piutangdetail_grid->Recordset->MoveFirst();
	$bSelectLimit = $t15_piutangdetail_grid->UseSelectLimit;
	if (!$bSelectLimit && $t15_piutangdetail_grid->StartRec > 1)
		$t15_piutangdetail_grid->Recordset->Move($t15_piutangdetail_grid->StartRec - 1);
} elseif (!$t15_piutangdetail->AllowAddDeleteRow && $t15_piutangdetail_grid->StopRec == 0) {
	$t15_piutangdetail_grid->StopRec = $t15_piutangdetail->GridAddRowCount;
}

// Initialize aggregate
$t15_piutangdetail->RowType = EW_ROWTYPE_AGGREGATEINIT;
$t15_piutangdetail->ResetAttrs();
$t15_piutangdetail_grid->RenderRow();
if ($t15_piutangdetail->CurrentAction == "gridadd")
	$t15_piutangdetail_grid->RowIndex = 0;
if ($t15_piutangdetail->CurrentAction == "gridedit")
	$t15_piutangdetail_grid->RowIndex = 0;
while ($t15_piutangdetail_grid->RecCnt < $t15_piutangdetail_grid->StopRec) {
	$t15_piutangdetail_grid->RecCnt++;
	if (intval($t15_piutangdetail_grid->RecCnt) >= intval($t15_piutangdetail_grid->StartRec)) {
		$t15_piutangdetail_grid->RowCnt++;
		if ($t15_piutangdetail->CurrentAction == "gridadd" || $t15_piutangdetail->CurrentAction == "gridedit" || $t15_piutangdetail->CurrentAction == "F") {
			$t15_piutangdetail_grid->RowIndex++;
			$objForm->Index = $t15_piutangdetail_grid->RowIndex;
			if ($objForm->HasValue($t15_piutangdetail_grid->FormActionName))
				$t15_piutangdetail_grid->RowAction = strval($objForm->GetValue($t15_piutangdetail_grid->FormActionName));
			elseif ($t15_piutangdetail->CurrentAction == "gridadd")
				$t15_piutangdetail_grid->RowAction = "insert";
			else
				$t15_piutangdetail_grid->RowAction = "";
		}

		// Set up key count
		$t15_piutangdetail_grid->KeyCount = $t15_piutangdetail_grid->RowIndex;

		// Init row class and style
		$t15_piutangdetail->ResetAttrs();
		$t15_piutangdetail->CssClass = "";
		if ($t15_piutangdetail->CurrentAction == "gridadd") {
			if ($t15_piutangdetail->CurrentMode == "copy") {
				$t15_piutangdetail_grid->LoadRowValues($t15_piutangdetail_grid->Recordset); // Load row values
				$t15_piutangdetail_grid->SetRecordKey($t15_piutangdetail_grid->RowOldKey, $t15_piutangdetail_grid->Recordset); // Set old record key
			} else {
				$t15_piutangdetail_grid->LoadRowValues(); // Load default values
				$t15_piutangdetail_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t15_piutangdetail_grid->LoadRowValues($t15_piutangdetail_grid->Recordset); // Load row values
		}
		$t15_piutangdetail->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($t15_piutangdetail->CurrentAction == "gridadd") // Grid add
			$t15_piutangdetail->RowType = EW_ROWTYPE_ADD; // Render add
		if ($t15_piutangdetail->CurrentAction == "gridadd" && $t15_piutangdetail->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$t15_piutangdetail_grid->RestoreCurrentRowFormValues($t15_piutangdetail_grid->RowIndex); // Restore form values
		if ($t15_piutangdetail->CurrentAction == "gridedit") { // Grid edit
			if ($t15_piutangdetail->EventCancelled) {
				$t15_piutangdetail_grid->RestoreCurrentRowFormValues($t15_piutangdetail_grid->RowIndex); // Restore form values
			}
			if ($t15_piutangdetail_grid->RowAction == "insert")
				$t15_piutangdetail->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$t15_piutangdetail->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($t15_piutangdetail->CurrentAction == "gridedit" && ($t15_piutangdetail->RowType == EW_ROWTYPE_EDIT || $t15_piutangdetail->RowType == EW_ROWTYPE_ADD) && $t15_piutangdetail->EventCancelled) // Update failed
			$t15_piutangdetail_grid->RestoreCurrentRowFormValues($t15_piutangdetail_grid->RowIndex); // Restore form values
		if ($t15_piutangdetail->RowType == EW_ROWTYPE_EDIT) // Edit row
			$t15_piutangdetail_grid->EditRowCnt++;
		if ($t15_piutangdetail->CurrentAction == "F") // Confirm row
			$t15_piutangdetail_grid->RestoreCurrentRowFormValues($t15_piutangdetail_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t15_piutangdetail->RowAttrs = array_merge($t15_piutangdetail->RowAttrs, array('data-rowindex'=>$t15_piutangdetail_grid->RowCnt, 'id'=>'r' . $t15_piutangdetail_grid->RowCnt . '_t15_piutangdetail', 'data-rowtype'=>$t15_piutangdetail->RowType));

		// Render row
		$t15_piutangdetail_grid->RenderRow();

		// Render list options
		$t15_piutangdetail_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t15_piutangdetail_grid->RowAction <> "delete" && $t15_piutangdetail_grid->RowAction <> "insertdelete" && !($t15_piutangdetail_grid->RowAction == "insert" && $t15_piutangdetail->CurrentAction == "F" && $t15_piutangdetail_grid->EmptyRow())) {
?>
	<tr<?php echo $t15_piutangdetail->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t15_piutangdetail_grid->ListOptions->Render("body", "left", $t15_piutangdetail_grid->RowCnt);
?>
	<?php if ($t15_piutangdetail->NoBayar->Visible) { // NoBayar ?>
		<td data-name="NoBayar"<?php echo $t15_piutangdetail->NoBayar->CellAttributes() ?>>
<?php if ($t15_piutangdetail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t15_piutangdetail_grid->RowCnt ?>_t15_piutangdetail_NoBayar" class="form-group t15_piutangdetail_NoBayar">
<input type="text" data-table="t15_piutangdetail" data-field="x_NoBayar" name="x<?php echo $t15_piutangdetail_grid->RowIndex ?>_NoBayar" id="x<?php echo $t15_piutangdetail_grid->RowIndex ?>_NoBayar" size="30" maxlength="8" placeholder="<?php echo ew_HtmlEncode($t15_piutangdetail->NoBayar->getPlaceHolder()) ?>" value="<?php echo $t15_piutangdetail->NoBayar->EditValue ?>"<?php echo $t15_piutangdetail->NoBayar->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t15_piutangdetail" data-field="x_NoBayar" name="o<?php echo $t15_piutangdetail_grid->RowIndex ?>_NoBayar" id="o<?php echo $t15_piutangdetail_grid->RowIndex ?>_NoBayar" value="<?php echo ew_HtmlEncode($t15_piutangdetail->NoBayar->OldValue) ?>">
<?php } ?>
<?php if ($t15_piutangdetail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t15_piutangdetail_grid->RowCnt ?>_t15_piutangdetail_NoBayar" class="form-group t15_piutangdetail_NoBayar">
<input type="text" data-table="t15_piutangdetail" data-field="x_NoBayar" name="x<?php echo $t15_piutangdetail_grid->RowIndex ?>_NoBayar" id="x<?php echo $t15_piutangdetail_grid->RowIndex ?>_NoBayar" size="30" maxlength="8" placeholder="<?php echo ew_HtmlEncode($t15_piutangdetail->NoBayar->getPlaceHolder()) ?>" value="<?php echo $t15_piutangdetail->NoBayar->EditValue ?>"<?php echo $t15_piutangdetail->NoBayar->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t15_piutangdetail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t15_piutangdetail_grid->RowCnt ?>_t15_piutangdetail_NoBayar" class="t15_piutangdetail_NoBayar">
<span<?php echo $t15_piutangdetail->NoBayar->ViewAttributes() ?>>
<?php echo $t15_piutangdetail->NoBayar->ListViewValue() ?></span>
</span>
<?php if ($t15_piutangdetail->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t15_piutangdetail" data-field="x_NoBayar" name="x<?php echo $t15_piutangdetail_grid->RowIndex ?>_NoBayar" id="x<?php echo $t15_piutangdetail_grid->RowIndex ?>_NoBayar" value="<?php echo ew_HtmlEncode($t15_piutangdetail->NoBayar->FormValue) ?>">
<input type="hidden" data-table="t15_piutangdetail" data-field="x_NoBayar" name="o<?php echo $t15_piutangdetail_grid->RowIndex ?>_NoBayar" id="o<?php echo $t15_piutangdetail_grid->RowIndex ?>_NoBayar" value="<?php echo ew_HtmlEncode($t15_piutangdetail->NoBayar->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t15_piutangdetail" data-field="x_NoBayar" name="ft15_piutangdetailgrid$x<?php echo $t15_piutangdetail_grid->RowIndex ?>_NoBayar" id="ft15_piutangdetailgrid$x<?php echo $t15_piutangdetail_grid->RowIndex ?>_NoBayar" value="<?php echo ew_HtmlEncode($t15_piutangdetail->NoBayar->FormValue) ?>">
<input type="hidden" data-table="t15_piutangdetail" data-field="x_NoBayar" name="ft15_piutangdetailgrid$o<?php echo $t15_piutangdetail_grid->RowIndex ?>_NoBayar" id="ft15_piutangdetailgrid$o<?php echo $t15_piutangdetail_grid->RowIndex ?>_NoBayar" value="<?php echo ew_HtmlEncode($t15_piutangdetail->NoBayar->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($t15_piutangdetail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t15_piutangdetail" data-field="x_id" name="x<?php echo $t15_piutangdetail_grid->RowIndex ?>_id" id="x<?php echo $t15_piutangdetail_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t15_piutangdetail->id->CurrentValue) ?>">
<input type="hidden" data-table="t15_piutangdetail" data-field="x_id" name="o<?php echo $t15_piutangdetail_grid->RowIndex ?>_id" id="o<?php echo $t15_piutangdetail_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t15_piutangdetail->id->OldValue) ?>">
<?php } ?>
<?php if ($t15_piutangdetail->RowType == EW_ROWTYPE_EDIT || $t15_piutangdetail->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t15_piutangdetail" data-field="x_id" name="x<?php echo $t15_piutangdetail_grid->RowIndex ?>_id" id="x<?php echo $t15_piutangdetail_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t15_piutangdetail->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($t15_piutangdetail->Tgl->Visible) { // Tgl ?>
		<td data-name="Tgl"<?php echo $t15_piutangdetail->Tgl->CellAttributes() ?>>
<?php if ($t15_piutangdetail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t15_piutangdetail_grid->RowCnt ?>_t15_piutangdetail_Tgl" class="form-group t15_piutangdetail_Tgl">
<input type="text" data-table="t15_piutangdetail" data-field="x_Tgl" data-format="7" name="x<?php echo $t15_piutangdetail_grid->RowIndex ?>_Tgl" id="x<?php echo $t15_piutangdetail_grid->RowIndex ?>_Tgl" placeholder="<?php echo ew_HtmlEncode($t15_piutangdetail->Tgl->getPlaceHolder()) ?>" value="<?php echo $t15_piutangdetail->Tgl->EditValue ?>"<?php echo $t15_piutangdetail->Tgl->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t15_piutangdetail" data-field="x_Tgl" name="o<?php echo $t15_piutangdetail_grid->RowIndex ?>_Tgl" id="o<?php echo $t15_piutangdetail_grid->RowIndex ?>_Tgl" value="<?php echo ew_HtmlEncode($t15_piutangdetail->Tgl->OldValue) ?>">
<?php } ?>
<?php if ($t15_piutangdetail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t15_piutangdetail_grid->RowCnt ?>_t15_piutangdetail_Tgl" class="form-group t15_piutangdetail_Tgl">
<input type="text" data-table="t15_piutangdetail" data-field="x_Tgl" data-format="7" name="x<?php echo $t15_piutangdetail_grid->RowIndex ?>_Tgl" id="x<?php echo $t15_piutangdetail_grid->RowIndex ?>_Tgl" placeholder="<?php echo ew_HtmlEncode($t15_piutangdetail->Tgl->getPlaceHolder()) ?>" value="<?php echo $t15_piutangdetail->Tgl->EditValue ?>"<?php echo $t15_piutangdetail->Tgl->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t15_piutangdetail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t15_piutangdetail_grid->RowCnt ?>_t15_piutangdetail_Tgl" class="t15_piutangdetail_Tgl">
<span<?php echo $t15_piutangdetail->Tgl->ViewAttributes() ?>>
<?php echo $t15_piutangdetail->Tgl->ListViewValue() ?></span>
</span>
<?php if ($t15_piutangdetail->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t15_piutangdetail" data-field="x_Tgl" name="x<?php echo $t15_piutangdetail_grid->RowIndex ?>_Tgl" id="x<?php echo $t15_piutangdetail_grid->RowIndex ?>_Tgl" value="<?php echo ew_HtmlEncode($t15_piutangdetail->Tgl->FormValue) ?>">
<input type="hidden" data-table="t15_piutangdetail" data-field="x_Tgl" name="o<?php echo $t15_piutangdetail_grid->RowIndex ?>_Tgl" id="o<?php echo $t15_piutangdetail_grid->RowIndex ?>_Tgl" value="<?php echo ew_HtmlEncode($t15_piutangdetail->Tgl->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t15_piutangdetail" data-field="x_Tgl" name="ft15_piutangdetailgrid$x<?php echo $t15_piutangdetail_grid->RowIndex ?>_Tgl" id="ft15_piutangdetailgrid$x<?php echo $t15_piutangdetail_grid->RowIndex ?>_Tgl" value="<?php echo ew_HtmlEncode($t15_piutangdetail->Tgl->FormValue) ?>">
<input type="hidden" data-table="t15_piutangdetail" data-field="x_Tgl" name="ft15_piutangdetailgrid$o<?php echo $t15_piutangdetail_grid->RowIndex ?>_Tgl" id="ft15_piutangdetailgrid$o<?php echo $t15_piutangdetail_grid->RowIndex ?>_Tgl" value="<?php echo ew_HtmlEncode($t15_piutangdetail->Tgl->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t15_piutangdetail->JumlahBayar->Visible) { // JumlahBayar ?>
		<td data-name="JumlahBayar"<?php echo $t15_piutangdetail->JumlahBayar->CellAttributes() ?>>
<?php if ($t15_piutangdetail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t15_piutangdetail_grid->RowCnt ?>_t15_piutangdetail_JumlahBayar" class="form-group t15_piutangdetail_JumlahBayar">
<input type="text" data-table="t15_piutangdetail" data-field="x_JumlahBayar" name="x<?php echo $t15_piutangdetail_grid->RowIndex ?>_JumlahBayar" id="x<?php echo $t15_piutangdetail_grid->RowIndex ?>_JumlahBayar" size="30" placeholder="<?php echo ew_HtmlEncode($t15_piutangdetail->JumlahBayar->getPlaceHolder()) ?>" value="<?php echo $t15_piutangdetail->JumlahBayar->EditValue ?>"<?php echo $t15_piutangdetail->JumlahBayar->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t15_piutangdetail" data-field="x_JumlahBayar" name="o<?php echo $t15_piutangdetail_grid->RowIndex ?>_JumlahBayar" id="o<?php echo $t15_piutangdetail_grid->RowIndex ?>_JumlahBayar" value="<?php echo ew_HtmlEncode($t15_piutangdetail->JumlahBayar->OldValue) ?>">
<?php } ?>
<?php if ($t15_piutangdetail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t15_piutangdetail_grid->RowCnt ?>_t15_piutangdetail_JumlahBayar" class="form-group t15_piutangdetail_JumlahBayar">
<input type="text" data-table="t15_piutangdetail" data-field="x_JumlahBayar" name="x<?php echo $t15_piutangdetail_grid->RowIndex ?>_JumlahBayar" id="x<?php echo $t15_piutangdetail_grid->RowIndex ?>_JumlahBayar" size="30" placeholder="<?php echo ew_HtmlEncode($t15_piutangdetail->JumlahBayar->getPlaceHolder()) ?>" value="<?php echo $t15_piutangdetail->JumlahBayar->EditValue ?>"<?php echo $t15_piutangdetail->JumlahBayar->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t15_piutangdetail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t15_piutangdetail_grid->RowCnt ?>_t15_piutangdetail_JumlahBayar" class="t15_piutangdetail_JumlahBayar">
<span<?php echo $t15_piutangdetail->JumlahBayar->ViewAttributes() ?>>
<?php echo $t15_piutangdetail->JumlahBayar->ListViewValue() ?></span>
</span>
<?php if ($t15_piutangdetail->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t15_piutangdetail" data-field="x_JumlahBayar" name="x<?php echo $t15_piutangdetail_grid->RowIndex ?>_JumlahBayar" id="x<?php echo $t15_piutangdetail_grid->RowIndex ?>_JumlahBayar" value="<?php echo ew_HtmlEncode($t15_piutangdetail->JumlahBayar->FormValue) ?>">
<input type="hidden" data-table="t15_piutangdetail" data-field="x_JumlahBayar" name="o<?php echo $t15_piutangdetail_grid->RowIndex ?>_JumlahBayar" id="o<?php echo $t15_piutangdetail_grid->RowIndex ?>_JumlahBayar" value="<?php echo ew_HtmlEncode($t15_piutangdetail->JumlahBayar->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t15_piutangdetail" data-field="x_JumlahBayar" name="ft15_piutangdetailgrid$x<?php echo $t15_piutangdetail_grid->RowIndex ?>_JumlahBayar" id="ft15_piutangdetailgrid$x<?php echo $t15_piutangdetail_grid->RowIndex ?>_JumlahBayar" value="<?php echo ew_HtmlEncode($t15_piutangdetail->JumlahBayar->FormValue) ?>">
<input type="hidden" data-table="t15_piutangdetail" data-field="x_JumlahBayar" name="ft15_piutangdetailgrid$o<?php echo $t15_piutangdetail_grid->RowIndex ?>_JumlahBayar" id="ft15_piutangdetailgrid$o<?php echo $t15_piutangdetail_grid->RowIndex ?>_JumlahBayar" value="<?php echo ew_HtmlEncode($t15_piutangdetail->JumlahBayar->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t15_piutangdetail_grid->ListOptions->Render("body", "right", $t15_piutangdetail_grid->RowCnt);
?>
	</tr>
<?php if ($t15_piutangdetail->RowType == EW_ROWTYPE_ADD || $t15_piutangdetail->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
ft15_piutangdetailgrid.UpdateOpts(<?php echo $t15_piutangdetail_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($t15_piutangdetail->CurrentAction <> "gridadd" || $t15_piutangdetail->CurrentMode == "copy")
		if (!$t15_piutangdetail_grid->Recordset->EOF) $t15_piutangdetail_grid->Recordset->MoveNext();
}
?>
<?php
	if ($t15_piutangdetail->CurrentMode == "add" || $t15_piutangdetail->CurrentMode == "copy" || $t15_piutangdetail->CurrentMode == "edit") {
		$t15_piutangdetail_grid->RowIndex = '$rowindex$';
		$t15_piutangdetail_grid->LoadRowValues();

		// Set row properties
		$t15_piutangdetail->ResetAttrs();
		$t15_piutangdetail->RowAttrs = array_merge($t15_piutangdetail->RowAttrs, array('data-rowindex'=>$t15_piutangdetail_grid->RowIndex, 'id'=>'r0_t15_piutangdetail', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($t15_piutangdetail->RowAttrs["class"], "ewTemplate");
		$t15_piutangdetail->RowType = EW_ROWTYPE_ADD;

		// Render row
		$t15_piutangdetail_grid->RenderRow();

		// Render list options
		$t15_piutangdetail_grid->RenderListOptions();
		$t15_piutangdetail_grid->StartRowCnt = 0;
?>
	<tr<?php echo $t15_piutangdetail->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t15_piutangdetail_grid->ListOptions->Render("body", "left", $t15_piutangdetail_grid->RowIndex);
?>
	<?php if ($t15_piutangdetail->NoBayar->Visible) { // NoBayar ?>
		<td data-name="NoBayar">
<?php if ($t15_piutangdetail->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t15_piutangdetail_NoBayar" class="form-group t15_piutangdetail_NoBayar">
<input type="text" data-table="t15_piutangdetail" data-field="x_NoBayar" name="x<?php echo $t15_piutangdetail_grid->RowIndex ?>_NoBayar" id="x<?php echo $t15_piutangdetail_grid->RowIndex ?>_NoBayar" size="30" maxlength="8" placeholder="<?php echo ew_HtmlEncode($t15_piutangdetail->NoBayar->getPlaceHolder()) ?>" value="<?php echo $t15_piutangdetail->NoBayar->EditValue ?>"<?php echo $t15_piutangdetail->NoBayar->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t15_piutangdetail_NoBayar" class="form-group t15_piutangdetail_NoBayar">
<span<?php echo $t15_piutangdetail->NoBayar->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t15_piutangdetail->NoBayar->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t15_piutangdetail" data-field="x_NoBayar" name="x<?php echo $t15_piutangdetail_grid->RowIndex ?>_NoBayar" id="x<?php echo $t15_piutangdetail_grid->RowIndex ?>_NoBayar" value="<?php echo ew_HtmlEncode($t15_piutangdetail->NoBayar->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t15_piutangdetail" data-field="x_NoBayar" name="o<?php echo $t15_piutangdetail_grid->RowIndex ?>_NoBayar" id="o<?php echo $t15_piutangdetail_grid->RowIndex ?>_NoBayar" value="<?php echo ew_HtmlEncode($t15_piutangdetail->NoBayar->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t15_piutangdetail->Tgl->Visible) { // Tgl ?>
		<td data-name="Tgl">
<?php if ($t15_piutangdetail->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t15_piutangdetail_Tgl" class="form-group t15_piutangdetail_Tgl">
<input type="text" data-table="t15_piutangdetail" data-field="x_Tgl" data-format="7" name="x<?php echo $t15_piutangdetail_grid->RowIndex ?>_Tgl" id="x<?php echo $t15_piutangdetail_grid->RowIndex ?>_Tgl" placeholder="<?php echo ew_HtmlEncode($t15_piutangdetail->Tgl->getPlaceHolder()) ?>" value="<?php echo $t15_piutangdetail->Tgl->EditValue ?>"<?php echo $t15_piutangdetail->Tgl->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t15_piutangdetail_Tgl" class="form-group t15_piutangdetail_Tgl">
<span<?php echo $t15_piutangdetail->Tgl->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t15_piutangdetail->Tgl->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t15_piutangdetail" data-field="x_Tgl" name="x<?php echo $t15_piutangdetail_grid->RowIndex ?>_Tgl" id="x<?php echo $t15_piutangdetail_grid->RowIndex ?>_Tgl" value="<?php echo ew_HtmlEncode($t15_piutangdetail->Tgl->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t15_piutangdetail" data-field="x_Tgl" name="o<?php echo $t15_piutangdetail_grid->RowIndex ?>_Tgl" id="o<?php echo $t15_piutangdetail_grid->RowIndex ?>_Tgl" value="<?php echo ew_HtmlEncode($t15_piutangdetail->Tgl->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t15_piutangdetail->JumlahBayar->Visible) { // JumlahBayar ?>
		<td data-name="JumlahBayar">
<?php if ($t15_piutangdetail->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t15_piutangdetail_JumlahBayar" class="form-group t15_piutangdetail_JumlahBayar">
<input type="text" data-table="t15_piutangdetail" data-field="x_JumlahBayar" name="x<?php echo $t15_piutangdetail_grid->RowIndex ?>_JumlahBayar" id="x<?php echo $t15_piutangdetail_grid->RowIndex ?>_JumlahBayar" size="30" placeholder="<?php echo ew_HtmlEncode($t15_piutangdetail->JumlahBayar->getPlaceHolder()) ?>" value="<?php echo $t15_piutangdetail->JumlahBayar->EditValue ?>"<?php echo $t15_piutangdetail->JumlahBayar->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t15_piutangdetail_JumlahBayar" class="form-group t15_piutangdetail_JumlahBayar">
<span<?php echo $t15_piutangdetail->JumlahBayar->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t15_piutangdetail->JumlahBayar->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t15_piutangdetail" data-field="x_JumlahBayar" name="x<?php echo $t15_piutangdetail_grid->RowIndex ?>_JumlahBayar" id="x<?php echo $t15_piutangdetail_grid->RowIndex ?>_JumlahBayar" value="<?php echo ew_HtmlEncode($t15_piutangdetail->JumlahBayar->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t15_piutangdetail" data-field="x_JumlahBayar" name="o<?php echo $t15_piutangdetail_grid->RowIndex ?>_JumlahBayar" id="o<?php echo $t15_piutangdetail_grid->RowIndex ?>_JumlahBayar" value="<?php echo ew_HtmlEncode($t15_piutangdetail->JumlahBayar->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t15_piutangdetail_grid->ListOptions->Render("body", "right", $t15_piutangdetail_grid->RowIndex);
?>
<script type="text/javascript">
ft15_piutangdetailgrid.UpdateOpts(<?php echo $t15_piutangdetail_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($t15_piutangdetail->CurrentMode == "add" || $t15_piutangdetail->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $t15_piutangdetail_grid->FormKeyCountName ?>" id="<?php echo $t15_piutangdetail_grid->FormKeyCountName ?>" value="<?php echo $t15_piutangdetail_grid->KeyCount ?>">
<?php echo $t15_piutangdetail_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t15_piutangdetail->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $t15_piutangdetail_grid->FormKeyCountName ?>" id="<?php echo $t15_piutangdetail_grid->FormKeyCountName ?>" value="<?php echo $t15_piutangdetail_grid->KeyCount ?>">
<?php echo $t15_piutangdetail_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t15_piutangdetail->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft15_piutangdetailgrid">
</div>
<?php

// Close recordset
if ($t15_piutangdetail_grid->Recordset)
	$t15_piutangdetail_grid->Recordset->Close();
?>
<?php if ($t15_piutangdetail_grid->ShowOtherOptions) { ?>
<div class="box-footer ewGridLowerPanel">
<?php
	foreach ($t15_piutangdetail_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($t15_piutangdetail_grid->TotalRecs == 0 && $t15_piutangdetail->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t15_piutangdetail_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($t15_piutangdetail->Export == "") { ?>
<script type="text/javascript">
ft15_piutangdetailgrid.Init();
</script>
<?php } ?>
<?php
$t15_piutangdetail_grid->Page_Terminate();
?>
