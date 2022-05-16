<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$i["ITEMS"] = $arResult;
$i["NAME"] = "";

if($s = $APPLICATION->GetFileRecursive(".section.php")) 
{ 
   @include($_SERVER['DOCUMENT_ROOT'].$s);
   $i["NAME"] = $sSectionName;
}

$arResult = $i;