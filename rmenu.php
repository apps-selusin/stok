<?php

// Menu
$RootMenu = new crMenu("RootMenu", TRUE);
$RootMenu->AddMenuItem(8, "mi_t08_po", $ReportLanguage->Phrase("SimpleReportMenuItemPrefix") . $ReportLanguage->MenuPhrase("8", "MenuText") . $ReportLanguage->Phrase("SimpleReportMenuItemSuffix"), "t08_porpt.php", -1, "", AllowList("{A2EF3792-3541-4459-9D68-D8F1DBA083C2}t08_po"), FALSE, FALSE, "");
echo $RootMenu->ToScript();
?>
<div class="ewVertical" id="ewMenu"></div>
