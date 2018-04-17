<?php

// TglSO
// NoSO
// CustomerID
// CustomerPO
// Total

?>
<?php if ($t11_jual->Visible) { ?>
<div class="ewMasterDiv">
<table id="tbl_t11_jualmaster" class="table ewViewTable ewMasterTable ewVertical">
	<tbody>
<?php if ($t11_jual->TglSO->Visible) { // TglSO ?>
		<tr id="r_TglSO">
			<td class="col-sm-2"><?php echo $t11_jual->TglSO->FldCaption() ?></td>
			<td<?php echo $t11_jual->TglSO->CellAttributes() ?>>
<span id="el_t11_jual_TglSO">
<span<?php echo $t11_jual->TglSO->ViewAttributes() ?>>
<?php echo $t11_jual->TglSO->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t11_jual->NoSO->Visible) { // NoSO ?>
		<tr id="r_NoSO">
			<td class="col-sm-2"><?php echo $t11_jual->NoSO->FldCaption() ?></td>
			<td<?php echo $t11_jual->NoSO->CellAttributes() ?>>
<span id="el_t11_jual_NoSO">
<span<?php echo $t11_jual->NoSO->ViewAttributes() ?>>
<?php echo $t11_jual->NoSO->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t11_jual->CustomerID->Visible) { // CustomerID ?>
		<tr id="r_CustomerID">
			<td class="col-sm-2"><?php echo $t11_jual->CustomerID->FldCaption() ?></td>
			<td<?php echo $t11_jual->CustomerID->CellAttributes() ?>>
<span id="el_t11_jual_CustomerID">
<span<?php echo $t11_jual->CustomerID->ViewAttributes() ?>>
<?php echo $t11_jual->CustomerID->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t11_jual->CustomerPO->Visible) { // CustomerPO ?>
		<tr id="r_CustomerPO">
			<td class="col-sm-2"><?php echo $t11_jual->CustomerPO->FldCaption() ?></td>
			<td<?php echo $t11_jual->CustomerPO->CellAttributes() ?>>
<span id="el_t11_jual_CustomerPO">
<span<?php echo $t11_jual->CustomerPO->ViewAttributes() ?>>
<?php echo $t11_jual->CustomerPO->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t11_jual->Total->Visible) { // Total ?>
		<tr id="r_Total">
			<td class="col-sm-2"><?php echo $t11_jual->Total->FldCaption() ?></td>
			<td<?php echo $t11_jual->Total->CellAttributes() ?>>
<span id="el_t11_jual_Total">
<span<?php echo $t11_jual->Total->ViewAttributes() ?>>
<?php echo $t11_jual->Total->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>
