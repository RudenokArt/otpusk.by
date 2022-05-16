<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//dm($arResult);

$arResult['city'] = getCityCountry(Set::CITY_IBLOCK_ID, "MT_HOTELKEY", "KEY_SLETAT");
$arResult['country'] = getCityCountry(Set::COUNTRY_IBLOCK_ID, "CN_KEY", "KEY_SLETAT");
$arResult['filter'] = getSearchFilter ($arResult['city'], $arResult['country']);

$arResult["sm_img"] = $arResult['b_img'] = array();

foreach ($arResult["PROPERTIES"]["PICTURES"]["VALUE"] as &$i)
{
	 $file = CFile::ResizeImageGet($i, array('width'=>103, 'height'=>57), BX_RESIZE_IMAGE_EXACT, true);

	 $arResult['sm_img'][] = $file['src'];
	
	$file = CFile::ResizeImageGet($i, array('width'=>840, 'height'=>460), BX_RESIZE_IMAGE_EXACT, true);

	 $arResult['b_img'][] = $file['src'];
}

// карта 
$arResult['point'][] = explode(',',$arResult["PROPERTIES"]["MAP"]['VALUE']);
$arResult['point'][] = $arResult["NAME"];

// Размещение
$arResult['hotels'] = getAdditionalElements(array("IBLOCK_ID" => Set::HOTELS_IBLOCK_ID, '!=PROPERTY_TYPE_ID' => 25, "PROPERTY_TOWN" => $arResult['ID']), 4);
if(count($arResult['hotels']) > 3)
{
	// ссылка на фильтр отелей по стране
	$arResult['all_hotels'] = makeFilterLink("TOWN", Set::HOTELS_IBLOCK_ID, $arResult['ID']);
	array_pop($arResult['hotels']);
}
// Санатории
$arResult['sanatorii'] = getAdditionalElements(array("ACTIVE" => "Y", "IBLOCK_ID" => Set::HOTELS_IBLOCK_ID, 'PROPERTY_TYPE_ID' => 25, "PROPERTY_TOWN" => $arResult['ID']), 4);

if(count($arResult['sanatorii']) > 3)
{
	// ссылка на фильтр отелей по стране
	$arResult['all_sanatorii'] = makeFilterLink("TOWN", Set::HOTELS_IBLOCK_ID, $arResult['ID'], Set::SANATORII_SECTION_ID);
	array_pop($arResult['sanatorii']);
}

// Специальные предложения
$arResult['offers'] = getAdditionalElements(array("IBLOCK_ID" => Set::SPECIAL_OFF_IBLOCK_ID, "PROPERTY_TOWN" => $arResult['ID']), 4);
//dm($arResult['offers']);
if(count($arResult['offers']) > 3)
{
	// ссылка на фильтр туров по стране
	$arResult['all_offers'] = makeFilterLink("TOWN", Set::SPECIAL_OFF_IBLOCK_ID, $arResult['ID']);
	array_pop($arResult['offers']);
}

// Достопримечательности
$arResult['sights'] = getAdditionalElements(array("IBLOCK_ID" => Set::SIGHTS_IBLOCK_ID, "PROPERTY_TOWN" => $arResult["ID"]), 4);
if(count($arResult['sights']) > 3)
{
	// ссылка на фильтр туров по стране
	$arResult['all_sights'] = makeFilterLink("TOWN", Set::SIGHTS_IBLOCK_ID, $arResult['ID']);
	array_pop($arResult['sights']);
}


//Статьи
$arResult["articles"] = getAdditionalElements(array("IBLOCK_ID" => Set::ARTICLE_COUNTRY_IBLOCK_ID, "PROPERTY_TOWN" => $arResult['ID']));


if ($arResult['PROPERTIES']['COUNTRY']['VALUE'] > 0) {


	$p = CIBlockElement::GetByID($arResult['PROPERTIES']['COUNTRY']['VALUE'])->GetNextElement()->GetProperties();

	if ($p['TI_COKEY']['VALUE'] >0) 
		$arResult['PROPERTIES']['TI_COKEY']['VALUE'] = $p['TI_COKEY']['VALUE'];

} 

$res = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => Set :: SHARES_IBLOCK_ID, "PROPERTY_TOWN" => $arResult["ID"], "ACTIVE" => "Y"), false, false, Array("IBLOCK_ID", "DETAIL_PAGE_URL", "ID", "NAME"));
while ($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
    $arProps = $ob->GetProperties();
	if($arProps["SHOW_ON_TOWN"]["VALUE"] == "Y"){
		$arResult["SHARES"][$arFields["ID"]] = Array("NAME" => $arFields["NAME"], "LINK" => $arFields["DETAIL_PAGE_URL"]);
	}
}
