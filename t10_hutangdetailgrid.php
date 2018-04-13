<?php include_once "t96_employeesinfo.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($t10_hutangdetail_grid)) $t10_hutangdetail_grid = new ct10_hutangdetail_grid();

// Page init
$t10_hutangdetail_grid->Page_Init();

// Page main
$t10_hutangdetail_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t10_hutangdetail_grid->Page_Render();
?>
<?php if ($t10_hutangdetail->Export == "") { ?>
<script type="text/javascript">

// Form object
var ft10_hutangdetailgrid = new ew_Form("ft10_hutangdetailgrid", "grid");
ft10_hutangdetailgrid.FormKeyCountName = '<?php echo $t10_hutangdetail_grid->FormKeyCountName ?>';

// Validate form
ft10_hutangdetailgrid.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_HutangID");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t10_hutangdetail->HutangID->FldCaption(), $t10_hutangdetail->HutangID->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_HutangID");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t10_hutangdetail->HutangID->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_NoBayar");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t10_hutangdetail->NoBayar->FldCaption(), $t10_hutangdetail->NoBayar->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Tgl");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t10_hutangdetail->Tgl->FldCaption(), $t10_hutangdetail->Tgl->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Tgl");
			if (elm && !ew_CheckEuroDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t10_hutangdetail->Tgl->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_JumlahBayar");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t10_hutangdetail->JumlahBayar->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
ft10_hutangdetailgrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "HutangID", false)) return false;
	if (ew_ValueChanged(fobj, infix, "NoBayar", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Tgl", false)) return false;
	if (ew_ValueChanged(fobj, infix, "JumlahBayar", false)) return false;
	return true;
}

// Form_CustomValidate event
ft10_hutangdetailgrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ft10_hutangdetailgrid.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<?php } ?>
<?php
if ($t10_hutangdetail->CurrentAction == "gridadd") {
	if ($t10_hutangdetail->CurrentMode == "copy") {
		$bSelectLimit = $t10_hutangdetail_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$t10_hutangdetail_grid->TotalRecs = $t10_hutangdetail->ListRecordCount();
			$t10_hutangdetail_grid->Recordset = $t10_hutangdetail_grid->LoadRecordset($t10_hutangdetail_grid->StartRec-1, $t10_hutangdetail_grid->DisplayRecs);
		} else {
			if ($t10_hutangdetail_grid->Recordset = $t10_hutangdetail_grid->LoadRecordset())
				$t10_hutangdetail_grid->TotalRecs = $t10_hutangdetail_grid->Recordset->RecordCount();
		}
		$t10_hutangdetail_grid->StartRec = 1;
		$t10_hutangdetail_grid->DisplayRecs = $t10_hutangdetail_grid->TotalRecs;
	} else {
		$t10_hutangdetail->CurrentFilter = "0=1";
		$t10_hutangdetail_grid->StartRec = 1;
		$t10_hutangdetail_grid->DisplayRecs = $t10_hutangdetail->GridAddRowCount;
	}
	$t10_hutangdetail_grid->TotalRecs = $t10_hutangdetail_grid->DisplayRecs;
	$t10_hutangdetail_grid->StopRec = $t10_hutangdetail_grid->DisplayRecs;
} else {
	$bSelectLimit = $t10_hutangdetail_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($t10_hutangdetail_grid->TotalRecs <= 0)
			$t10_hutangdetail_grid->TotalRecs = $t10_hutangdetail->ListRecordCount();
	} else {
		if (!$t10_hutangdetail_grid->Recordset && ($t10_hutangdetail_grid->Recordset = $t10_hutangdetail_grid->LoadRecordset()))
			$t10_hutangdetail_grid->TotalRecs = $t10_hutangdetail_grid->Recordset->RecordCount();
	}
	$t10_hutangdetail_grid->StartRec = 1;
	$t10_hutangdetail_grid->DisplayRecs = $t10_hutangdetail_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$t10_hutangdetail_grid->Recordset = $t10_hutangdetail_grid->LoadRecordset($t10_hutangdetail_grid->StartRec-1, $t10_hutangdetail_grid->DisplayRecs);

	// Set no record found message
	if ($t10_hutangdetail->CurrentAction == "" && $t10_hutangdetail_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$t10_hutangdetail_grid->setWarningMessage(ew_DeniedMsg());
		if ($t10_hutangdetail_grid->SearchWhere == "0=101")
			$t10_hutangdetail_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$t10_hutangdetail_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$t10_hutangdetail_grid->RenderOtherOptions();
?>
<?php $t10_hutangdetail_grid->ShowPageHeader(); ?>
<?php
$t10_hutangdetail_grid->ShowMessage();
?>
<?php if ($t10_hutangdetail_grid->TotalRecs > 0 || $t10_hutangdetail->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($t10_hutangdetail_grid->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> t10_hutangdetail">
<div id="ft10_hutangdetailgrid" class="ewForm ewListForm form-inline">
<?php if ($t10_hutangdetail_grid->ShowOtherOptions) { ?>
<div class="box-header ewGridUpperPanel">
<?php
	foreach ($t10_hutangdetail_grid->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="gmp_t10_hutangdetail" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table id="tbl_t10_hutangdetailgrid" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$t10_hutangdetail_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$t10_hutangdetail_grid->RenderListOptions();

// Render list options (header, left)
$t10_hutangdetail_grid->ListOptions->Render("header", "left");
?>
<?php if ($t10_hutangdetail->HutangID->Visible) { // HutangID ?>
	<?php if ($t10_hutangdetail->SortUrl($t10_hutangdetail->HutangID) == "") { ?>
		<th data-name="HutangID" class="<?php echo $t10_hutangdetail->HutangID->HeaderCellClass() ?>"><div id="elh_t10_hutangdetail_HutangID" class="t10_hutangdetail_HutangID"><div class="ewTableHeaderCaption"><?php echo $t10_hutangdetail->HutangID->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="HutangID" class="<?php echo $t10_hutangdetail->HutangID->HeaderCellClass() ?>"><div><div id="elh_t10_hutangdetail_HutangID" class="t10_hutangdetail_HutangID">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t10_hutangdetail->HutangID->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t10_hutangdetail->HutangID->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t10_hutangdetail->HutangID->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t10_hutangdetail->NoBayar->Visible) { // NoBayar ?>
	<?php if ($t10_hutangdetail->SortUrl($t10_hutangdetail->NoBayar) == "") { ?>
		<th data-name="NoBayar" class="<?php echo $t10_hutangdetail->NoBayar->HeaderCellClass() ?>"><div id="elh_t10_hutangdetail_NoBayar" class="t10_hutangdetail_NoBayar"><div class="ewTableHeaderCaption"><?php echo $t10_hutangdetail->NoBayar->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NoBayar" class="<?php echo $t10_hutangdetail->NoBayar->HeaderCellClass() ?>"><div><div id="elh_t10_hutangdetail_NoBayar" class="t10_hutangdetail_NoBayar">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t10_hutangdetail->NoBayar->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t10_hutangdetail->NoBayar->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t10_hutangdetail->NoBayar->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t10_hutangdetail->Tgl->Visible) { // Tgl ?>
	<?php if ($t10_hutangdetail->SortUrl($t10_hutangdetail->Tgl) == "") { ?>
		<th data-name="Tgl" class="<?php echo $t10_hutangdetail->Tgl->HeaderCellClass() ?>"><div id="elh_t10_hutangdetail_Tgl" class="t10_hutangdetail_Tgl"><div class="ewTableHeaderCaption"><?php echo $t10_hutangdetail->Tgl->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Tgl" class="<?php echo $t10_hutangdetail->Tgl->HeaderCellClass() ?>"><div><div id="elh_t10_hutangdetail_Tgl" class="t10_hutangdetail_Tgl">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t10_hutangdetail->Tgl->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t10_hutangdetail->Tgl->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t10_hutangdetail->Tgl->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t10_hutangdetail->JumlahBayar->Visible) { // JumlahBayar ?>
	<?php if ($t10_hutangdetail->SortUrl($t10_hutangdetail->JumlahBayar) == "") { ?>
		<th data-name="JumlahBayar" class="<?php echo $t10_hutangdetail->JumlahBayar->HeaderCellClass() ?>"><div id="elh_t10_hutangdetail_JumlahBayar" class="t10_hutangdetail_JumlahBayar"><div class="ewTableHeaderCaption"><?php echo $t10_hutangdetail->JumlahBayar->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="JumlahBayar" class="<?php echo $t10_hutangdetail->JumlahBayar->HeaderCellClass() ?>"><div><div id="elh_t10_hutangdetail_JumlahBayar" class="t10_hutangdetail_JumlahBayar">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t10_hutangdetail->JumlahBayar->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t10_hutangdetail->JumlahBayar->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t10_hutangdetail->JumlahBayar->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t10_hutangdetail_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t10_hutangdetail_grid->StartRec = 1;
$t10_hutangdetail_grid->StopRec = $t10_hutangdetail_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($t10_hutangdetail_grid->FormKeyCountName) && ($t10_hutangdetail->CurrentAction == "gridadd" || $t10_hutangdetail->CurrentAction == "gridedit" || $t10_hutangdetail->CurrentAction == "F")) {
		$t10_hutangdetail_grid->KeyCount = $objForm->GetValue($t10_hutangdetail_grid->FormKeyCountName);
		$t10_hutangdetail_grid->StopRec = $t10_hutangdetail_grid->StartRec + $t10_hutangdetail_grid->KeyCount - 1;
	}
}
$t10_hutangdetail_grid->RecCnt = $t10_hutangdetail_grid->StartRec - 1;
if ($t10_hutangdetail_grid->Recordset && !$t10_hutangdetail_grid->Recordset->EOF) {
	$t10_hutangdetail_grid->Recordset->MoveFirst();
	$bSelectLimit = $t10_hutangdetail_grid->UseSelectLimit;
	if (!$bSelectLimit && $t10_hutangdetail_grid->StartRec > 1)
		$t10_hutangdetail_grid->Recordset->Move($t10_hutangdetail_grid->StartRec - 1);
} elseif (!$t10_hutangdetail->AllowAddDeleteRow && $t10_hutangdetail_grid->StopRec == 0) {
	$t10_hutangdetail_grid->StopRec = $t10_hutangdetail->GridAddRowCount;
}

// Initialize aggregate
$t10_hutangdetail->RowType = EW_ROWTYPE_AGGREGATEINIT;
$t10_hutangdetail->ResetAttrs();
$t10_hutangdetail_grid->RenderRow();
if ($t10_hutangdetail->CurrentAction == "gridadd")
	$t10_hutangdetail_grid->RowIndex = 0;
if ($t10_hutangdetail->CurrentAction == "gridedit")
	$t10_hutangdetail_grid->RowIndex = 0;
while ($t10_hutangdetail_grid->RecCnt < $t10_hutangdetail_grid->StopRec) {
	$t10_hutangdetail_grid->RecCnt++;
	if (intval($t10_hutangdetail_grid->RecCnt) >= intval($t10_hutangdetail_grid->StartRec)) {
		$t10_hutangdetail_grid->RowCnt++;
		if ($t10_hutangdetail->CurrentAction == "gridadd" || $t10_hutangdetail->CurrentAction == "gridedit" || $t10_hutangdetail->CurrentAction == "F") {
			$t10_hutangdetail_grid->RowIndex++;
			$objForm->Index = $t10_hutangdetail_grid->RowIndex;
			if ($objForm->HasValue($t10_hutangdetail_grid->FormActionName))
				$t10_hutangdetail_grid->RowAction = strval($objForm->GetValue($t10_hutangdetail_grid->FormActionName));
			elseif ($t10_hutangdetail->CurrentAction == "gridadd")
				$t10_hutangdetail_grid->RowAction = "insert";
			else
				$t10_hutangdetail_grid->RowAction = "";
		}

		// Set up key count
		$t10_hutangdetail_grid->KeyCount = $t10_hutangdetail_grid->RowIndex;

		// Init row class and style
		$t10_hutangdetail->ResetAttrs();
		$t10_hutangdetail->CssClass = "";
		if ($t10_hutangdetail->CurrentAction == "gridadd") {
			if ($t10_hutangdetail->CurrentMode == "copy") {
				$t10_hutangdetail_grid->LoadRowValues($t10_hutangdetail_grid->Recordset); // Load row values
				$t10_hutangdetail_grid->SetRecordKey($t10_hutangdetail_grid->RowOldKey, $t10_hutangdetail_grid->Recordset); // Set old record key
			} else {
				$t10_hutangdetail_grid->LoadRowValues(); // Load default values
				$t10_hutangdetail_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t10_hutangdetail_grid->LoadRowValues($t10_hutangdetail_grid->Recordset); // Load row values
		}
		$t10_hutangdetail->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($t10_hutangdetail->CurrentAction == "gridadd") // Grid add
			$t10_hutangdetail->RowType = EW_ROWTYPE_ADD; // Render add
		if ($t10_hutangdetail->CurrentAction == "gridadd" && $t10_hutangdetail->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$t10_hutangdetail_grid->RestoreCurrentRowFormValues($t10_hutangdetail_grid->RowIndex); // Restore form values
		if ($t10_hutangdetail->CurrentAction == "gridedit") { // Grid edit
			if ($t10_hutangdetail->EventCancelled) {
				$t10_hutangdetail_grid->RestoreCurrentRowFormValues($t10_hutangdetail_grid->RowIndex); // Restore form values
			}
			if ($t10_hutangdetail_grid->RowAction == "insert")
				$t10_hutangdetail->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$t10_hutangdetail->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($t10_hutangdetail->CurrentAction == "gridedit" && ($t10_hutangdetail->RowType == EW_ROWTYPE_EDIT || $t10_hutangdetail->RowType == EW_ROWTYPE_ADD) && $t10_hutangdetail->EventCancelled) // Update failed
			$t10_hutangdetail_grid->RestoreCurrentRowFormValues($t10_hutangdetail_grid->RowIndex); // Restore form values
		if ($t10_hutangdetail->RowType == EW_ROWTYPE_EDIT) // Edit row
			$t10_hutangdetail_grid->EditRowCnt++;
		if ($t10_hutangdetail->CurrentAction == "F") // Confirm row
			$t10_hutangdetail_grid->RestoreCurrentRowFormValues($t10_hutangdetail_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t10_hutangdetail->RowAttrs = array_merge($t10_hutangdetail->RowAttrs, array('data-rowindex'=>$t10_hutangdetail_grid->RowCnt, 'id'=>'r' . $t10_hutangdetail_grid->RowCnt . '_t10_hutangdetail', 'data-rowtype'=>$t10_hutangdetail->RowType));

		// Render row
		$t10_hutangdetail_grid->RenderRow();

		// Render list options
		$t10_hutangdetail_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t10_hutangdetail_grid->RowAction <> "delete" && $t10_hutangdetail_grid->RowAction <> "insertdelete" && !($t10_hutangdetail_grid->RowAction == "insert" && $t10_hutangdetail->CurrentAction == "F" && $t10_hutangdetail_grid->EmptyRow())) {
?>
	<tr<?php echo $t10_hutangdetail->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t10_hutangdetail_grid->ListOptions->Render("body", "left", $t10_hutangdetail_grid->RowCnt);
?>
	<?php if ($t10_hutangdetail->HutangID->Visible) { // HutangID ?>
		<td data-name="HutangID"<?php echo $t10_hutangdetail->HutangID->CellAttributes() ?>>
<?php if ($t10_hutangdetail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($t10_hutangdetail->HutangID->getSessionValue() <> "") { ?>
<span id="el<?php echo $t10_hutangdetail_grid->RowCnt ?>_t10_hutangdetail_HutangID" class="form-group t10_hutangdetail_HutangID">
<span<?php echo $t10_hutangdetail->HutangID->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t10_hutangdetail->HutangID->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t10_hutangdetail_grid->RowIndex ?>_HutangID" name="x<?php echo $t10_hutangdetail_grid->RowIndex ?>_HutangID" value="<?php echo ew_HtmlEncode($t10_hutangdetail->HutangID->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t10_hutangdetail_grid->RowCnt ?>_t10_hutangdetail_HutangID" class="form-group t10_hutangdetail_HutangID">
<input type="text" data-table="t10_hutangdetail" data-field="x_HutangID" name="x<?php echo $t10_hutangdetail_grid->RowIndex ?>_HutangID" id="x<?php echo $t10_hutangdetail_grid->RowIndex ?>_HutangID" size="30" placeholder="<?php echo ew_HtmlEncode($t10_hutangdetail->HutangID->getPlaceHolder()) ?>" value="<?php echo $t10_hutangdetail->HutangID->EditValue ?>"<?php echo $t10_hutangdetail->HutangID->EditAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="t10_hutangdetail" data-field="x_HutangID" name="o<?php echo $t10_hutangdetail_grid->RowIndex ?>_HutangID" id="o<?php echo $t10_hutangdetail_grid->RowIndex ?>_HutangID" value="<?php echo ew_HtmlEncode($t10_hutangdetail->HutangID->OldValue) ?>">
<?php } ?>
<?php if ($t10_hutangdetail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($t10_hutangdetail->HutangID->getSessionValue() <> "") { ?>
<span id="el<?php echo $t10_hutangdetail_grid->RowCnt ?>_t10_hutangdetail_HutangID" class="form-group t10_hutangdetail_HutangID">
<span<?php echo $t10_hutangdetail->HutangID->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t10_hutangdetail->HutangID->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t10_hutangdetail_grid->RowIndex ?>_HutangID" name="x<?php echo $t10_hutangdetail_grid->RowIndex ?>_HutangID" value="<?php echo ew_HtmlEncode($t10_hutangdetail->HutangID->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t10_hutangdetail_grid->RowCnt ?>_t10_hutangdetail_HutangID" class="form-group t10_hutangdetail_HutangID">
<input type="text" data-table="t10_hutangdetail" data-field="x_HutangID" name="x<?php echo $t10_hutangdetail_grid->RowIndex ?>_HutangID" id="x<?php echo $t10_hutangdetail_grid->RowIndex ?>_HutangID" size="30" placeholder="<?php echo ew_HtmlEncode($t10_hutangdetail->HutangID->getPlaceHolder()) ?>" value="<?php echo $t10_hutangdetail->HutangID->EditValue ?>"<?php echo $t10_hutangdetail->HutangID->EditAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($t10_hutangdetail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t10_hutangdetail_grid->RowCnt ?>_t10_hutangdetail_HutangID" class="t10_hutangdetail_HutangID">
<span<?php echo $t10_hutangdetail->HutangID->ViewAttributes() ?>>
<?php echo $t10_hutangdetail->HutangID->ListViewValue() ?></span>
</span>
<?php if ($t10_hutangdetail->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t10_hutangdetail" data-field="x_HutangID" name="x<?php echo $t10_hutangdetail_grid->RowIndex ?>_HutangID" id="x<?php echo $t10_hutangdetail_grid->RowIndex ?>_HutangID" value="<?php echo ew_HtmlEncode($t10_hutangdetail->HutangID->FormValue) ?>">
<input type="hidden" data-table="t10_hutangdetail" data-field="x_HutangID" name="o<?php echo $t10_hutangdetail_grid->RowIndex ?>_HutangID" id="o<?php echo $t10_hutangdetail_grid->RowIndex ?>_HutangID" value="<?php echo ew_HtmlEncode($t10_hutangdetail->HutangID->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t10_hutangdetail" data-field="x_HutangID" name="ft10_hutangdetailgrid$x<?php echo $t10_hutangdetail_grid->RowIndex ?>_HutangID" id="ft10_hutangdetailgrid$x<?php echo $t10_hutangdetail_grid->RowIndex ?>_HutangID" value="<?php echo ew_HtmlEncode($t10_hutangdetail->HutangID->FormValue) ?>">
<input type="hidden" data-table="t10_hutangdetail" data-field="x_HutangID" name="ft10_hutangdetailgrid$o<?php echo $t10_hutangdetail_grid->RowIndex ?>_HutangID" id="ft10_hutangdetailgrid$o<?php echo $t10_hutangdetail_grid->RowIndex ?>_HutangID" value="<?php echo ew_HtmlEncode($t10_hutangdetail->HutangID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($t10_hutangdetail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t10_hutangdetail" data-field="x_id" name="x<?php echo $t10_hutangdetail_grid->RowIndex ?>_id" id="x<?php echo $t10_hutangdetail_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t10_hutangdetail->id->CurrentValue) ?>">
<input type="hidden" data-table="t10_hutangdetail" data-field="x_id" name="o<?php echo $t10_hutangdetail_grid->RowIndex ?>_id" id="o<?php echo $t10_hutangdetail_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t10_hutangdetail->id->OldValue) ?>">
<?php } ?>
<?php if ($t10_hutangdetail->RowType == EW_ROWTYPE_EDIT || $t10_hutangdetail->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t10_hutangdetail" data-field="x_id" name="x<?php echo $t10_hutangdetail_grid->RowIndex ?>_id" id="x<?php echo $t10_hutangdetail_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t10_hutangdetail->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($t10_hutangdetail->NoBayar->Visible) { // NoBayar ?>
		<td data-name="NoBayar"<?php echo $t10_hutangdetail->NoBayar->CellAttributes() ?>>
<?php if ($t10_hutangdetail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t10_hutangdetail_grid->RowCnt ?>_t10_hutangdetail_NoBayar" class="form-group t10_hutangdetail_NoBayar">
<input type="text" data-table="t10_hutangdetail" data-field="x_NoBayar" name="x<?php echo $t10_hutangdetail_grid->RowIndex ?>_NoBayar" id="x<?php echo $t10_hutangdetail_grid->RowIndex ?>_NoBayar" size="30" maxlength="8" placeholder="<?php echo ew_HtmlEncode($t10_hutangdetail->NoBayar->getPlaceHolder()) ?>" value="<?php echo $t10_hutangdetail->NoBayar->EditValue ?>"<?php echo $t10_hutangdetail->NoBayar->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t10_hutangdetail" data-field="x_NoBayar" name="o<?php echo $t10_hutangdetail_grid->RowIndex ?>_NoBayar" id="o<?php echo $t10_hutangdetail_grid->RowIndex ?>_NoBayar" value="<?php echo ew_HtmlEncode($t10_hutangdetail->NoBayar->OldValue) ?>">
<?php } ?>
<?php if ($t10_hutangdetail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t10_hutangdetail_grid->RowCnt ?>_t10_hutangdetail_NoBayar" class="form-group t10_hutangdetail_NoBayar">
<input type="text" data-table="t10_hutangdetail" data-field="x_NoBayar" name="x<?php echo $t10_hutangdetail_grid->RowIndex ?>_NoBayar" id="x<?php echo $t10_hutangdetail_grid->RowIndex ?>_NoBayar" size="30" maxlength="8" placeholder="<?php echo ew_HtmlEncode($t10_hutangdetail->NoBayar->getPlaceHolder()) ?>" value="<?php echo $t10_hutangdetail->NoBayar->EditValue ?>"<?php echo $t10_hutangdetail->NoBayar->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t10_hutangdetail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t10_hutangdetail_grid->RowCnt ?>_t10_hutangdetail_NoBayar" class="t10_hutangdetail_NoBayar">
<span<?php echo $t10_hutangdetail->NoBayar->ViewAttributes() ?>>
<?php echo $t10_hutangdetail->NoBayar->ListViewValue() ?></span>
</span>
<?php if ($t10_hutangdetail->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t10_hutangdetail" data-field="x_NoBayar" name="x<?php echo $t10_hutangdetail_grid->RowIndex ?>_NoBayar" id="x<?php echo $t10_hutangdetail_grid->RowIndex ?>_NoBayar" value="<?php echo ew_HtmlEncode($t10_hutangdetail->NoBayar->FormValue) ?>">
<input type="hidden" data-table="t10_hutangdetail" data-field="x_NoBayar" name="o<?php echo $t10_hutangdetail_grid->RowIndex ?>_NoBayar" id="o<?php echo $t10_hutangdetail_grid->RowIndex ?>_NoBayar" value="<?php echo ew_HtmlEncode($t10_hutangdetail->NoBayar->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t10_hutangdetail" data-field="x_NoBayar" name="ft10_hutangdetailgrid$x<?php echo $t10_hutangdetail_grid->RowIndex ?>_NoBayar" id="ft10_hutangdetailgrid$x<?php echo $t10_hutangdetail_grid->RowIndex ?>_NoBayar" value="<?php echo ew_HtmlEncode($t10_hutangdetail->NoBayar->FormValue) ?>">
<input type="hidden" data-table="t10_hutangdetail" data-field="x_NoBayar" name="ft10_hutangdetailgrid$o<?php echo $t10_hutangdetail_grid->RowIndex ?>_NoBayar" id="ft10_hutangdetailgrid$o<?php echo $t10_hutangdetail_grid->RowIndex ?>_NoBayar" value="<?php echo ew_HtmlEncode($t10_hutangdetail->NoBayar->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t10_hutangdetail->Tgl->Visible) { // Tgl ?>
		<td data-name="Tgl"<?php echo $t10_hutangdetail->Tgl->CellAttributes() ?>>
<?php if ($t10_hutangdetail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t10_hutangdetail_grid->RowCnt ?>_t10_hutangdetail_Tgl" class="form-group t10_hutangdetail_Tgl">
<input type="text" data-table="t10_hutangdetail" data-field="x_Tgl" data-format="7" name="x<?php echo $t10_hutangdetail_grid->RowIndex ?>_Tgl" id="x<?php echo $t10_hutangdetail_grid->RowIndex ?>_Tgl" placeholder="<?php echo ew_HtmlEncode($t10_hutangdetail->Tgl->getPlaceHolder()) ?>" value="<?php echo $t10_hutangdetail->Tgl->EditValue ?>"<?php echo $t10_hutangdetail->Tgl->EditAttributes() ?>>
<?php if (!$t10_hutangdetail->Tgl->ReadOnly && !$t10_hutangdetail->Tgl->Disabled && !isset($t10_hutangdetail->Tgl->EditAttrs["readonly"]) && !isset($t10_hutangdetail->Tgl->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("ft10_hutangdetailgrid", "x<?php echo $t10_hutangdetail_grid->RowIndex ?>_Tgl", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="t10_hutangdetail" data-field="x_Tgl" name="o<?php echo $t10_hutangdetail_grid->RowIndex ?>_Tgl" id="o<?php echo $t10_hutangdetail_grid->RowIndex ?>_Tgl" value="<?php echo ew_HtmlEncode($t10_hutangdetail->Tgl->OldValue) ?>">
<?php } ?>
<?php if ($t10_hutangdetail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t10_hutangdetail_grid->RowCnt ?>_t10_hutangdetail_Tgl" class="form-group t10_hutangdetail_Tgl">
<input type="text" data-table="t10_hutangdetail" data-field="x_Tgl" data-format="7" name="x<?php echo $t10_hutangdetail_grid->RowIndex ?>_Tgl" id="x<?php echo $t10_hutangdetail_grid->RowIndex ?>_Tgl" placeholder="<?php echo ew_HtmlEncode($t10_hutangdetail->Tgl->getPlaceHolder()) ?>" value="<?php echo $t10_hutangdetail->Tgl->EditValue ?>"<?php echo $t10_hutangdetail->Tgl->EditAttributes() ?>>
<?php if (!$t10_hutangdetail->Tgl->ReadOnly && !$t10_hutangdetail->Tgl->Disabled && !isset($t10_hutangdetail->Tgl->EditAttrs["readonly"]) && !isset($t10_hutangdetail->Tgl->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("ft10_hutangdetailgrid", "x<?php echo $t10_hutangdetail_grid->RowIndex ?>_Tgl", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($t10_hutangdetail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t10_hutangdetail_grid->RowCnt ?>_t10_hutangdetail_Tgl" class="t10_hutangdetail_Tgl">
<span<?php echo $t10_hutangdetail->Tgl->ViewAttributes() ?>>
<?php echo $t10_hutangdetail->Tgl->ListViewValue() ?></span>
</span>
<?php if ($t10_hutangdetail->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t10_hutangdetail" data-field="x_Tgl" name="x<?php echo $t10_hutangdetail_grid->RowIndex ?>_Tgl" id="x<?php echo $t10_hutangdetail_grid->RowIndex ?>_Tgl" value="<?php echo ew_HtmlEncode($t10_hutangdetail->Tgl->FormValue) ?>">
<input type="hidden" data-table="t10_hutangdetail" data-field="x_Tgl" name="o<?php echo $t10_hutangdetail_grid->RowIndex ?>_Tgl" id="o<?php echo $t10_hutangdetail_grid->RowIndex ?>_Tgl" value="<?php echo ew_HtmlEncode($t10_hutangdetail->Tgl->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t10_hutangdetail" data-field="x_Tgl" name="ft10_hutangdetailgrid$x<?php echo $t10_hutangdetail_grid->RowIndex ?>_Tgl" id="ft10_hutangdetailgrid$x<?php echo $t10_hutangdetail_grid->RowIndex ?>_Tgl" value="<?php echo ew_HtmlEncode($t10_hutangdetail->Tgl->FormValue) ?>">
<input type="hidden" data-table="t10_hutangdetail" data-field="x_Tgl" name="ft10_hutangdetailgrid$o<?php echo $t10_hutangdetail_grid->RowIndex ?>_Tgl" id="ft10_hutangdetailgrid$o<?php echo $t10_hutangdetail_grid->RowIndex ?>_Tgl" value="<?php echo ew_HtmlEncode($t10_hutangdetail->Tgl->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t10_hutangdetail->JumlahBayar->Visible) { // JumlahBayar ?>
		<td data-name="JumlahBayar"<?php echo $t10_hutangdetail->JumlahBayar->CellAttributes() ?>>
<?php if ($t10_hutangdetail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t10_hutangdetail_grid->RowCnt ?>_t10_hutangdetail_JumlahBayar" class="form-group t10_hutangdetail_JumlahBayar">
<input type="text" data-table="t10_hutangdetail" data-field="x_JumlahBayar" name="x<?php echo $t10_hutangdetail_grid->RowIndex ?>_JumlahBayar" id="x<?php echo $t10_hutangdetail_grid->RowIndex ?>_JumlahBayar" size="30" placeholder="<?php echo ew_HtmlEncode($t10_hutangdetail->JumlahBayar->getPlaceHolder()) ?>" value="<?php echo $t10_hutangdetail->JumlahBayar->EditValue ?>"<?php echo $t10_hutangdetail->JumlahBayar->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t10_hutangdetail" data-field="x_JumlahBayar" name="o<?php echo $t10_hutangdetail_grid->RowIndex ?>_JumlahBayar" id="o<?php echo $t10_hutangdetail_grid->RowIndex ?>_JumlahBayar" value="<?php echo ew_HtmlEncode($t10_hutangdetail->JumlahBayar->OldValue) ?>">
<?php } ?>
<?php if ($t10_hutangdetail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t10_hutangdetail_grid->RowCnt ?>_t10_hutangdetail_JumlahBayar" class="form-group t10_hutangdetail_JumlahBayar">
<input type="text" data-table="t10_hutangdetail" data-field="x_JumlahBayar" name="x<?php echo $t10_hutangdetail_grid->RowIndex ?>_JumlahBayar" id="x<?php echo $t10_hutangdetail_grid->RowIndex ?>_JumlahBayar" size="30" placeholder="<?php echo ew_HtmlEncode($t10_hutangdetail->JumlahBayar->getPlaceHolder()) ?>" value="<?php echo $t10_hutangdetail->JumlahBayar->EditValue ?>"<?php echo $t10_hutangdetail->JumlahBayar->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t10_hutangdetail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t10_hutangdetail_grid->RowCnt ?>_t10_hutangdetail_JumlahBayar" class="t10_hutangdetail_JumlahBayar">
<span<?php echo $t10_hutangdetail->JumlahBayar->ViewAttributes() ?>>
<?php echo $t10_hutangdetail->JumlahBayar->ListViewValue() ?></span>
</span>
<?php if ($t10_hutangdetail->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t10_hutangdetail" data-field="x_JumlahBayar" name="x<?php echo $t10_hutangdetail_grid->RowIndex ?>_JumlahBayar" id="x<?php echo $t10_hutangdetail_grid->RowIndex ?>_JumlahBayar" value="<?php echo ew_HtmlEncode($t10_hutangdetail->JumlahBayar->FormValue) ?>">
<input type="hidden" data-table="t10_hutangdetail" data-field="x_JumlahBayar" name="o<?php echo $t10_hutangdetail_grid->RowIndex ?>_JumlahBayar" id="o<?php echo $t10_hutangdetail_grid->RowIndex ?>_JumlahBayar" value="<?php echo ew_HtmlEncode($t10_hutangdetail->JumlahBayar->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t10_hutangdetail" data-field="x_JumlahBayar" name="ft10_hutangdetailgrid$x<?php echo $t10_hutangdetail_grid->RowIndex ?>_JumlahBayar" id="ft10_hutangdetailgrid$x<?php echo $t10_hutangdetail_grid->RowIndex ?>_JumlahBayar" value="<?php echo ew_HtmlEncode($t10_hutangdetail->JumlahBayar->FormValue) ?>">
<input type="hidden" data-table="t10_hutangdetail" data-field="x_JumlahBayar" name="ft10_hutangdetailgrid$o<?php echo $t10_hutangdetail_grid->RowIndex ?>_JumlahBayar" id="ft10_hutangdetailgrid$o<?php echo $t10_hutangdetail_grid->RowIndex ?>_JumlahBayar" value="<?php echo ew_HtmlEncode($t10_hutangdetail->JumlahBayar->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t10_hutangdetail_grid->ListOptions->Render("body", "right", $t10_hutangdetail_grid->RowCnt);
?>
	</tr>
<?php if ($t10_hutangdetail->RowType == EW_ROWTYPE_ADD || $t10_hutangdetail->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
ft10_hutangdetailgrid.UpdateOpts(<?php echo $t10_hutangdetail_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($t10_hutangdetail->CurrentAction <> "gridadd" || $t10_hutangdetail->CurrentMode == "copy")
		if (!$t10_hutangdetail_grid->Recordset->EOF) $t10_hutangdetail_grid->Recordset->MoveNext();
}
?>
<?php
	if ($t10_hutangdetail->CurrentMode == "add" || $t10_hutangdetail->CurrentMode == "copy" || $t10_hutangdetail->CurrentMode == "edit") {
		$t10_hutangdetail_grid->RowIndex = '$rowindex$';
		$t10_hutangdetail_grid->LoadRowValues();

		// Set row properties
		$t10_hutangdetail->ResetAttrs();
		$t10_hutangdetail->RowAttrs = array_merge($t10_hutangdetail->RowAttrs, array('data-rowindex'=>$t10_hutangdetail_grid->RowIndex, 'id'=>'r0_t10_hutangdetail', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($t10_hutangdetail->RowAttrs["class"], "ewTemplate");
		$t10_hutangdetail->RowType = EW_ROWTYPE_ADD;

		// Render row
		$t10_hutangdetail_grid->RenderRow();

		// Render list options
		$t10_hutangdetail_grid->RenderListOptions();
		$t10_hutangdetail_grid->StartRowCnt = 0;
?>
	<tr<?php echo $t10_hutangdetail->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t10_hutangdetail_grid->ListOptions->Render("body", "left", $t10_hutangdetail_grid->RowIndex);
?>
	<?php if ($t10_hutangdetail->HutangID->Visible) { // HutangID ?>
		<td data-name="HutangID">
<?php if ($t10_hutangdetail->CurrentAction <> "F") { ?>
<?php if ($t10_hutangdetail->HutangID->getSessionValue() <> "") { ?>
<span id="el$rowindex$_t10_hutangdetail_HutangID" class="form-group t10_hutangdetail_HutangID">
<span<?php echo $t10_hutangdetail->HutangID->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t10_hutangdetail->HutangID->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t10_hutangdetail_grid->RowIndex ?>_HutangID" name="x<?php echo $t10_hutangdetail_grid->RowIndex ?>_HutangID" value="<?php echo ew_HtmlEncode($t10_hutangdetail->HutangID->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_t10_hutangdetail_HutangID" class="form-group t10_hutangdetail_HutangID">
<input type="text" data-table="t10_hutangdetail" data-field="x_HutangID" name="x<?php echo $t10_hutangdetail_grid->RowIndex ?>_HutangID" id="x<?php echo $t10_hutangdetail_grid->RowIndex ?>_HutangID" size="30" placeholder="<?php echo ew_HtmlEncode($t10_hutangdetail->HutangID->getPlaceHolder()) ?>" value="<?php echo $t10_hutangdetail->HutangID->EditValue ?>"<?php echo $t10_hutangdetail->HutangID->EditAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_t10_hutangdetail_HutangID" class="form-group t10_hutangdetail_HutangID">
<span<?php echo $t10_hutangdetail->HutangID->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t10_hutangdetail->HutangID->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t10_hutangdetail" data-field="x_HutangID" name="x<?php echo $t10_hutangdetail_grid->RowIndex ?>_HutangID" id="x<?php echo $t10_hutangdetail_grid->RowIndex ?>_HutangID" value="<?php echo ew_HtmlEncode($t10_hutangdetail->HutangID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t10_hutangdetail" data-field="x_HutangID" name="o<?php echo $t10_hutangdetail_grid->RowIndex ?>_HutangID" id="o<?php echo $t10_hutangdetail_grid->RowIndex ?>_HutangID" value="<?php echo ew_HtmlEncode($t10_hutangdetail->HutangID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t10_hutangdetail->NoBayar->Visible) { // NoBayar ?>
		<td data-name="NoBayar">
<?php if ($t10_hutangdetail->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t10_hutangdetail_NoBayar" class="form-group t10_hutangdetail_NoBayar">
<input type="text" data-table="t10_hutangdetail" data-field="x_NoBayar" name="x<?php echo $t10_hutangdetail_grid->RowIndex ?>_NoBayar" id="x<?php echo $t10_hutangdetail_grid->RowIndex ?>_NoBayar" size="30" maxlength="8" placeholder="<?php echo ew_HtmlEncode($t10_hutangdetail->NoBayar->getPlaceHolder()) ?>" value="<?php echo $t10_hutangdetail->NoBayar->EditValue ?>"<?php echo $t10_hutangdetail->NoBayar->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t10_hutangdetail_NoBayar" class="form-group t10_hutangdetail_NoBayar">
<span<?php echo $t10_hutangdetail->NoBayar->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t10_hutangdetail->NoBayar->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t10_hutangdetail" data-field="x_NoBayar" name="x<?php echo $t10_hutangdetail_grid->RowIndex ?>_NoBayar" id="x<?php echo $t10_hutangdetail_grid->RowIndex ?>_NoBayar" value="<?php echo ew_HtmlEncode($t10_hutangdetail->NoBayar->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t10_hutangdetail" data-field="x_NoBayar" name="o<?php echo $t10_hutangdetail_grid->RowIndex ?>_NoBayar" id="o<?php echo $t10_hutangdetail_grid->RowIndex ?>_NoBayar" value="<?php echo ew_HtmlEncode($t10_hutangdetail->NoBayar->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t10_hutangdetail->Tgl->Visible) { // Tgl ?>
		<td data-name="Tgl">
<?php if ($t10_hutangdetail->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t10_hutangdetail_Tgl" class="form-group t10_hutangdetail_Tgl">
<input type="text" data-table="t10_hutangdetail" data-field="x_Tgl" data-format="7" name="x<?php echo $t10_hutangdetail_grid->RowIndex ?>_Tgl" id="x<?php echo $t10_hutangdetail_grid->RowIndex ?>_Tgl" placeholder="<?php echo ew_HtmlEncode($t10_hutangdetail->Tgl->getPlaceHolder()) ?>" value="<?php echo $t10_hutangdetail->Tgl->EditValue ?>"<?php echo $t10_hutangdetail->Tgl->EditAttributes() ?>>
<?php if (!$t10_hutangdetail->Tgl->ReadOnly && !$t10_hutangdetail->Tgl->Disabled && !isset($t10_hutangdetail->Tgl->EditAttrs["readonly"]) && !isset($t10_hutangdetail->Tgl->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("ft10_hutangdetailgrid", "x<?php echo $t10_hutangdetail_grid->RowIndex ?>_Tgl", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t10_hutangdetail_Tgl" class="form-group t10_hutangdetail_Tgl">
<span<?php echo $t10_hutangdetail->Tgl->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t10_hutangdetail->Tgl->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t10_hutangdetail" data-field="x_Tgl" name="x<?php echo $t10_hutangdetail_grid->RowIndex ?>_Tgl" id="x<?php echo $t10_hutangdetail_grid->RowIndex ?>_Tgl" value="<?php echo ew_HtmlEncode($t10_hutangdetail->Tgl->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t10_hutangdetail" data-field="x_Tgl" name="o<?php echo $t10_hutangdetail_grid->RowIndex ?>_Tgl" id="o<?php echo $t10_hutangdetail_grid->RowIndex ?>_Tgl" value="<?php echo ew_HtmlEncode($t10_hutangdetail->Tgl->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t10_hutangdetail->JumlahBayar->Visible) { // JumlahBayar ?>
		<td data-name="JumlahBayar">
<?php if ($t10_hutangdetail->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t10_hutangdetail_JumlahBayar" class="form-group t10_hutangdetail_JumlahBayar">
<input type="text" data-table="t10_hutangdetail" data-field="x_JumlahBayar" name="x<?php echo $t10_hutangdetail_grid->RowIndex ?>_JumlahBayar" id="x<?php echo $t10_hutangdetail_grid->RowIndex ?>_JumlahBayar" size="30" placeholder="<?php echo ew_HtmlEncode($t10_hutangdetail->JumlahBayar->getPlaceHolder()) ?>" value="<?php echo $t10_hutangdetail->JumlahBayar->EditValue ?>"<?php echo $t10_hutangdetail->JumlahBayar->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t10_hutangdetail_JumlahBayar" class="form-group t10_hutangdetail_JumlahBayar">
<span<?php echo $t10_hutangdetail->JumlahBayar->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t10_hutangdetail->JumlahBayar->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t10_hutangdetail" data-field="x_JumlahBayar" name="x<?php echo $t10_hutangdetail_grid->RowIndex ?>_JumlahBayar" id="x<?php echo $t10_hutangdetail_grid->RowIndex ?>_JumlahBayar" value="<?php echo ew_HtmlEncode($t10_hutangdetail->JumlahBayar->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t10_hutangdetail" data-field="x_JumlahBayar" name="o<?php echo $t10_hutangdetail_grid->RowIndex ?>_JumlahBayar" id="o<?php echo $t10_hutangdetail_grid->RowIndex ?>_JumlahBayar" value="<?php echo ew_HtmlEncode($t10_hutangdetail->JumlahBayar->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t10_hutangdetail_grid->ListOptions->Render("body", "right", $t10_hutangdetail_grid->RowIndex);
?>
<script type="text/javascript">
ft10_hutangdetailgrid.UpdateOpts(<?php echo $t10_hutangdetail_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($t10_hutangdetail->CurrentMode == "add" || $t10_hutangdetail->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $t10_hutangdetail_grid->FormKeyCountName ?>" id="<?php echo $t10_hutangdetail_grid->FormKeyCountName ?>" value="<?php echo $t10_hutangdetail_grid->KeyCount ?>">
<?php echo $t10_hutangdetail_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t10_hutangdetail->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $t10_hutangdetail_grid->FormKeyCountName ?>" id="<?php echo $t10_hutangdetail_grid->FormKeyCountName ?>" value="<?php echo $t10_hutangdetail_grid->KeyCount ?>">
<?php echo $t10_hutangdetail_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t10_hutangdetail->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft10_hutangdetailgrid">
</div>
<?php

// Close recordset
if ($t10_hutangdetail_grid->Recordset)
	$t10_hutangdetail_grid->Recordset->Close();
?>
<?php if ($t10_hutangdetail_grid->ShowOtherOptions) { ?>
<div class="box-footer ewGridLowerPanel">
<?php
	foreach ($t10_hutangdetail_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($t10_hutangdetail_grid->TotalRecs == 0 && $t10_hutangdetail->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t10_hutangdetail_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($t10_hutangdetail->Export == "") { ?>
<script type="text/javascript">
ft10_hutangdetailgrid.Init();
</script>
<?php } ?>
<?php
$t10_hutangdetail_grid->Page_Terminate();
?>
