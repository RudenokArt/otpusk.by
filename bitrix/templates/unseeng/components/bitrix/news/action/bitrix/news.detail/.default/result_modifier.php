<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
// Размещение
$arResult['hotels'] = getAdditionalElements(array("IBLOCK_ID" => Set::HOTELS_IBLOCK_ID, "PROPERTY_NATIONAL_PARK" => $arResult["ID"]));
