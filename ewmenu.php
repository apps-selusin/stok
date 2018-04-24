<?php

// Menu
$RootMenu = new cMenu("RootMenu", TRUE);
$RootMenu->AddMenuItem(1, "mi_cf01_home_php", $Language->MenuPhrase("1", "MenuText"), "cf01_home.php", -1, "", AllowListMenu('{8746EF3F-81FE-4C1C-A7F8-AC191F8DDBB2}cf01_home.php'), FALSE, TRUE, "");
$RootMenu->AddMenuItem(19, "mi_t08_beli", $Language->MenuPhrase("19", "MenuText"), "t08_belilist.php", -1, "", AllowListMenu('{8746EF3F-81FE-4C1C-A7F8-AC191F8DDBB2}t08_beli'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(10021, "mi_t09_hutang", $Language->MenuPhrase("10021", "MenuText"), "t09_hutanglist.php", -1, "", AllowListMenu('{8746EF3F-81FE-4C1C-A7F8-AC191F8DDBB2}t09_hutang'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(10027, "mi_t11_jual", $Language->MenuPhrase("10027", "MenuText"), "t11_juallist.php", -1, "", AllowListMenu('{8746EF3F-81FE-4C1C-A7F8-AC191F8DDBB2}t11_jual'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(10013, "mci_Laporan", $Language->MenuPhrase("10013", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "");
$RootMenu->AddMenuItem(10017, "mri_r025fstok", $Language->MenuPhrase("10017", "MenuText"), "r02_stoksmry.php", 10013, "{A2EF3792-3541-4459-9D68-D8F1DBA083C2}", AllowListMenu('{A2EF3792-3541-4459-9D68-D8F1DBA083C2}r02_stok'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(10014, "mri_r015fbeli", $Language->MenuPhrase("10014", "MenuText"), "r01_belismry.php", 10013, "{A2EF3792-3541-4459-9D68-D8F1DBA083C2}", AllowListMenu('{A2EF3792-3541-4459-9D68-D8F1DBA083C2}r01_beli'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(10020, "mri_r035fhutang", $Language->MenuPhrase("10020", "MenuText"), "r03_hutangsmry.php", 10013, "{A2EF3792-3541-4459-9D68-D8F1DBA083C2}", AllowListMenu('{A2EF3792-3541-4459-9D68-D8F1DBA083C2}r03_hutang'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(10032, "mri_r045fjual", $Language->MenuPhrase("10032", "MenuText"), "r04_jualsmry.php", 10013, "{A2EF3792-3541-4459-9D68-D8F1DBA083C2}", AllowListMenu('{A2EF3792-3541-4459-9D68-D8F1DBA083C2}r04_jual'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(6, "mci_Setup", $Language->MenuPhrase("6", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "");
$RootMenu->AddMenuItem(10085, "mci_Home", $Language->MenuPhrase("10085", "MenuText"), "", 6, "", TRUE, FALSE, TRUE, "");
$RootMenu->AddMenuItem(10036, "mi_t94_home", $Language->MenuPhrase("10036", "MenuText"), "t94_homelist.php", 10085, "", AllowListMenu('{8746EF3F-81FE-4C1C-A7F8-AC191F8DDBB2}t94_home'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(10037, "mi_t95_homedetail", $Language->MenuPhrase("10037", "MenuText"), "t95_homedetaillist.php", 10085, "", AllowListMenu('{8746EF3F-81FE-4C1C-A7F8-AC191F8DDBB2}t95_homedetail'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(10086, "mi_t93_parameter", $Language->MenuPhrase("10086", "MenuText"), "t93_parameterlist.php", 6, "", AllowListMenu('{8746EF3F-81FE-4C1C-A7F8-AC191F8DDBB2}t93_parameter'), FALSE, FALSE, "");
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
