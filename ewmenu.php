<?php

// Menu
$RootMenu = new cMenu("RootMenu", TRUE);
$RootMenu->AddMenuItem(1, "mi_cf01_home_php", $Language->MenuPhrase("1", "MenuText"), "cf01_home.php", -1, "", AllowListMenu('{8746EF3F-81FE-4C1C-A7F8-AC191F8DDBB2}cf01_home.php'), FALSE, TRUE, "");
$RootMenu->AddMenuItem(6, "mci_Setup", $Language->MenuPhrase("6", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "");
$RootMenu->AddMenuItem(7, "mi_t01_company", $Language->MenuPhrase("7", "MenuText"), "t01_companylist.php", 6, "", AllowListMenu('{8746EF3F-81FE-4C1C-A7F8-AC191F8DDBB2}t01_company'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(8, "mi_t02_vendor", $Language->MenuPhrase("8", "MenuText"), "t02_vendorlist.php", 6, "", AllowListMenu('{8746EF3F-81FE-4C1C-A7F8-AC191F8DDBB2}t02_vendor'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(9, "mi_t03_customer", $Language->MenuPhrase("9", "MenuText"), "t03_customerlist.php", 6, "", AllowListMenu('{8746EF3F-81FE-4C1C-A7F8-AC191F8DDBB2}t03_customer'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(17, "mci_Stock_Article", $Language->MenuPhrase("17", "MenuText"), "", 6, "", TRUE, FALSE, TRUE, "");
$RootMenu->AddMenuItem(10, "mi_t04_maingroup", $Language->MenuPhrase("10", "MenuText"), "t04_maingrouplist.php", 17, "", AllowListMenu('{8746EF3F-81FE-4C1C-A7F8-AC191F8DDBB2}t04_maingroup'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(11, "mi_t05_subgroup", $Language->MenuPhrase("11", "MenuText"), "t05_subgrouplist.php", 17, "", AllowListMenu('{8746EF3F-81FE-4C1C-A7F8-AC191F8DDBB2}t05_subgroup'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(12, "mi_t06_article", $Language->MenuPhrase("12", "MenuText"), "t06_articlelist.php", 17, "", AllowListMenu('{8746EF3F-81FE-4C1C-A7F8-AC191F8DDBB2}t06_article'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(18, "mi_t07_satuan", $Language->MenuPhrase("18", "MenuText"), "t07_satuanlist.php", 17, "", AllowListMenu('{8746EF3F-81FE-4C1C-A7F8-AC191F8DDBB2}t07_satuan'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(2, "mi_t96_employees", $Language->MenuPhrase("2", "MenuText"), "t96_employeeslist.php", 6, "", AllowListMenu('{8746EF3F-81FE-4C1C-A7F8-AC191F8DDBB2}t96_employees'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(3, "mi_t97_userlevels", $Language->MenuPhrase("3", "MenuText"), "t97_userlevelslist.php", 6, "", IsAdmin(), FALSE, FALSE, "");
$RootMenu->AddMenuItem(5, "mi_t99_audittrail", $Language->MenuPhrase("5", "MenuText"), "t99_audittraillist.php", 6, "", AllowListMenu('{8746EF3F-81FE-4C1C-A7F8-AC191F8DDBB2}t99_audittrail'), FALSE, FALSE, "");
echo $RootMenu->ToScript();
?>
<div class="ewVertical" id="ewMenu"></div>