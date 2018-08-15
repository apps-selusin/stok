<?php

// NoPiutang
// JualID
// JumlahPiutang
// JumlahBayar
// SaldoPiutang

?>
<?php if ($t14_piutang->Visible) { ?>
<div class="ewMasterDiv">
<table id="tbl_t14_piutangmaster" class="table ewViewTable ewMasterTable ewVertical">
	<tbody>
<?php if ($t14_piutang->NoPiutang->Visible) { // NoPiutang ?>
		<tr id="r_NoPiutang">
			<td class="col-sm-2"><?php echo $t14_piutang->NoPiutang->FldCaption() ?></td>
			<td<?php echo $t14_piutang->NoPiutang->CellAttributes() ?>>
<span id="el_t14_piutang_NoPiutang">
<span<?php echo $t14_piutang->NoPiutang->ViewAttributes() ?>>
<?php echo $t14_piutang->NoPiutang->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t14_piutang->JualID->Visible) { // JualID ?>
		<tr id="r_JualID">
			<td class="col-sm-2"><?php echo $t14_piutang->JualID->FldCaption() ?></td>
			<td<?php echo $t14_piutang->JualID->CellAttributes() ?>>
<span id="el_t14_piutang_JualID">
<span<?php echo $t14_piutang->JualID->ViewAttributes() ?>>
<?php echo $t14_piutang->JualID->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t14_piutang->JumlahPiutang->Visible) { // JumlahPiutang ?>
		<tr id="r_JumlahPiutang">
			<td class="col-sm-2"><?php echo $t14_piutang->JumlahPiutang->FldCaption() ?></td>
			<td<?php echo $t14_piutang->JumlahPiutang->CellAttributes() ?>>
<span id="el_t14_piutang_JumlahPiutang">
<span<?php echo $t14_piutang->JumlahPiutang->ViewAttributes() ?>>
<?php echo $t14_piutang->JumlahPiutang->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t14_piutang->JumlahBayar->Visible) { // JumlahBayar ?>
		<tr id="r_JumlahBayar">
			<td class="col-sm-2"><?php echo $t14_piutang->JumlahBayar->FldCaption() ?></td>
			<td<?php echo $t14_piutang->JumlahBayar->CellAttributes() ?>>
<span id="el_t14_piutang_JumlahBayar">
<span<?php echo $t14_piutang->JumlahBayar->ViewAttributes() ?>>
<?php echo $t14_piutang->JumlahBayar->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t14_piutang->SaldoPiutang->Visible) { // SaldoPiutang ?>
		<tr id="r_SaldoPiutang">
			<td class="col-sm-2"><?php echo $t14_piutang->SaldoPiutang->FldCaption() ?></td>
			<td<?php echo $t14_piutang->SaldoPiutang->CellAttributes() ?>>
<span id="el_t14_piutang_SaldoPiutang">
<span<?php echo $t14_piutang->SaldoPiutang->ViewAttributes() ?>>
<?php echo $t14_piutang->SaldoPiutang->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>
