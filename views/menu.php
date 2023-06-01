<?php

namespace PHPMaker2021\lpdpdss;

// Menu Language
if ($Language && function_exists(PROJECT_NAMESPACE . "Config") && $Language->LanguageFolder == Config("LANGUAGE_FOLDER")) {
    $MenuRelativePath = "";
    $MenuLanguage = &$Language;
} else { // Compat reports
    $LANGUAGE_FOLDER = "../lang/";
    $MenuRelativePath = "../";
    $MenuLanguage = Container("language");
}

// Navbar menu
$topMenu = new Menu("navbar", true, true);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", true, false);
$sideMenu->addMenuItem(3, "mi_graded", $MenuLanguage->MenuPhrase("3", "MenuText"), $MenuRelativePath . "gradedlist", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(4, "mi_DetailNilai", $MenuLanguage->MenuPhrase("4", "MenuText"), $MenuRelativePath . "detailnilailist", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(1, "mi_awardee", $MenuLanguage->MenuPhrase("1", "MenuText"), $MenuRelativePath . "awardeelist", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(2, "mi_grade", $MenuLanguage->MenuPhrase("2", "MenuText"), $MenuRelativePath . "gradelist", -1, "", true, false, false, "", "", false);
echo $sideMenu->toScript();
