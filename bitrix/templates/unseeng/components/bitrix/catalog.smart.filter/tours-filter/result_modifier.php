<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/*********** Для отелей, туров ************/
// 104 - цена
// 95  - страна - ib=18
// 61  - страна - ib=14
// 96  - город или курорт ib=18
// 62  - город ib=14
// 101 - тип тура
// 102 - тип транспорта
/*******************************************/

$arResult["customs_params"][14] = array(61, 62, 376);
$arResult["customs_params"][35] = array(250, 251);
$arResult["customs_params"][18] = array(95, 96);
$arResult["customs_params"][17] = array(204);

$arResult["GROUPS"] = array();
\Bitrix\Main\Loader::includeModule("iblock");
foreach($arResult["customs_params"][$arParams["IBLOCK_ID"]] as $p)
{
	if(!isset($arResult["ITEMS"][$p])) continue;

	// группировка элементов по странам и городам
	$db_cg = CIBlockElement::GetList(false, array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "SECTION_ID" => $arParams['SECTION_ID']), array("PROPERTY_" . $p));
	while($gr = $db_cg->Fetch())
		$arResult["GROUPS"][$p][$gr["PROPERTY_". $p ."_VALUE"]] = $gr["CNT"];
}

$arResult["c_links"] = array();
if(!empty($arResult["ITEMS"][$arResult["customs_params"][$arParams["IBLOCK_ID"]][1]]["VALUES"]))
{
	/* город -> страна */
	$c = array_keys($arResult["ITEMS"][$arResult["customs_params"][$arParams["IBLOCK_ID"]][1]]["VALUES"]);
	$db_c = CIBlockElement::GetList(false, array("IBLOCK_ID" => Set::CITY_IBLOCK_ID, "ID" => $c), false, false, array("ID", "PROPERTY_COUNTRY"));
	
	while($ci = $db_c->Fetch())
	{
		$arResult["c_links"][$ci["ID"]] = $ci["PROPERTY_COUNTRY_VALUE"];
	}
}

if(!empty($arResult["ITEMS"][$arResult["customs_params"][$arParams["IBLOCK_ID"]][2]]["VALUES"]))
{
	// ОБЛАСТЬ -> страна 
	$rr = array_keys($arResult["ITEMS"][$arResult["customs_params"][$arParams["IBLOCK_ID"]][2]]["VALUES"]);
	$db_r = CIBlockElement::GetList(false, array("IBLOCK_ID" => Set::REGIONS_IBLOCK_ID, "ID" => $r), false, false, array("ID", "PROPERTY_COUNTRY"));
	while($r = $db_r->Fetch())
	{
		$arResult["c_links"][$r["ID"]] = $r["PROPERTY_COUNTRY_VALUE"];
	}
}

// Исключаем показ определённых туров
foreach ($arResult['ITEMS']['101']['VALUES'] as $key => $value) {
	if ($key == Set::NEW_YEAR)
		unset($arResult['ITEMS']['101']['VALUES'][$key]);
}