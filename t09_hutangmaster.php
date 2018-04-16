<?php

// NoHutang
// BeliID
// JumlahHutang
// JumlahBayar
// SaldoHutang

?>
<?php if ($t09_hutang->Visible) { ?>
<div class="ewMasterDiv">
<table id="tbl_t09_hutangmaster" class="table ewViewTable ewMasterTable ewVertical">
	<tbody>
<?php if ($t09_hutang->NoHutang->Visible) { // NoHutang ?>
		<tr id="r_NoHutang">
			<td class="col-sm-2"><?php echo $t09_hutang->NoHutang->FldCaption() ?></td>
			<td<?php echo $t09_hutang->NoHutang->CellAttributes() ?>>
<span id="el_t09_hutang_NoHutang">
<span<?php echo $t09_hutang->NoHutang->ViewAttributes() ?>>
<?php echo $t09_hutang->NoHutang->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t09_hutang->BeliID->Visible) { // BeliID ?>
		<tr id="r_BeliID">
			<td class="col-sm-2"><?php echo $t09_hutang->BeliID->FldCaption() ?></td>
			<td<?php echo $t09_hutang->BeliID->CellAttributes() ?>>
<span id="el_t09_hutang_BeliID">
<span<?php echo $t09_hutang->BeliID->ViewAttributes() ?>>
<?php echo $t09_hutang->BeliID->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t09_hutang->JumlahHutang->Visible) { // JumlahHutang ?>
		<tr id="r_JumlahHutang">
			<td class="col-sm-2"><?php echo $t09_hutang->JumlahHutang->FldCaption() ?></td>
			<td<?php echo $t09_hutang->JumlahHutang->CellAttributes() ?>>
<span id="el_t09_hutang_JumlahHutang">
<span<?php echo $t09_hutang->JumlahHutang->ViewAttributes() ?>>
<?php echo $t09_hutang->JumlahHutang->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t09_hutang->JumlahBayar->Visible) { // JumlahBayar ?>
		<tr id="r_JumlahBayar">
			<td class="col-sm-2"><?php echo $t09_hutang->JumlahBayar->FldCaption() ?></td>
			<td<?php echo $t09_hutang->JumlahBayar->CellAttributes() ?>>
<span id="el_t09_hutang_JumlahBayar">
<span<?php echo $t09_hutang->JumlahBayar->ViewAttributes() ?>>
<?php echo $t09_hutang->JumlahBayar->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t09_hutang->SaldoHutang->Visible) { // SaldoHutang ?>
		<tr id="r_SaldoHutang">
			<td class="col-sm-2"><?php echo $t09_hutang->SaldoHutang->FldCaption() ?></td>
			<td<?php echo $t09_hutang->SaldoHutang->CellAttributes() ?>>
<span id="el_t09_hutang_SaldoHutang">
<span<?php echo $t09_hutang->SaldoHutang->ViewAttributes() ?>>
<?php echo $t09_hutang->SaldoHutang->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>
