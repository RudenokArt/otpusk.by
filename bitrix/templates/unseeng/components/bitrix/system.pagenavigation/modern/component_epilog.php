<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$APPLICATION->SetPageProperty("robots", ($_REQUEST['PAGEN_1'] > 0 && $_REQUEST['PAGEN_1'] != 1) ? "noindex, follow" : "index, follow");