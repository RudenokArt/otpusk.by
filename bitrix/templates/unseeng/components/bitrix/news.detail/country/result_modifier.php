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
	
	$file = CFile::ResizeImageGet($i, array('width'=>840, 'height'=>306), BX_RESIZE_IMAGE_EXACT, true);

	 $arResult['b_img'][] = $file['src'];
}

// карта 
$arResult['point'][] = explode(',',$arResult["PROPERTIES"]["MAP"]['VALUE']);
$arResult['point'][] = $arResult["NAME"];

// Все подразделы раздела санатории
$rsParentSection = CIBlockSection::GetByID(Set::SANATORII_SECTION_ID);
if ($arParentSection = $rsParentSection->GetNext())
{
   $arFilter = array('IBLOCK_ID' => $arParentSection['IBLOCK_ID'],'>LEFT_MARGIN' => $arParentSection['LEFT_MARGIN'],'<RIGHT_MARGIN' => $arParentSection['RIGHT_MARGIN'],'>DEPTH_LEVEL' => $arParentSection['DEPTH_LEVEL']); // выберет потомков без учета активности
   $rsSect = CIBlockSection::GetList(array('left_margin' => 'asc'),$arFilter, false, array("ID"));
   while ($arSect = $rsSect->GetNext())
   {
       $sectIDS[] = $arSect["ID"];
   }
}

// Размещение
$arResult['hotels'] = getAdditionalElements(array("ACTIVE" => "Y", "IBLOCK_ID" => Set::HOTELS_IBLOCK_ID, "!SECTION_ID" => $sectIDS, '!=PROPERTY_TYPE_ID' => 25, "PROPERTY_COUNTRY" => $arResult['ID']), 4);

if(count($arResult['hotels']) > 3)
{
	// ссылка на фильтр отелей по стране
	$arResult['all_hotels'] = makeFilterLink("COUNTRY", Set::HOTELS_IBLOCK_ID, $arResult['ID']);
	array_pop($arResult['hotels']);
}

// Санатории
$arResult['sanatorii'] = getAdditionalElements(array("ACTIVE" => "Y", "IBLOCK_ID" => Set::HOTELS_IBLOCK_ID, 'PROPERTY_TYPE_ID' => 25, "PROPERTY_COUNTRY" => $arResult['ID']), 4);

if(count($arResult['sanatorii']) > 3)
{
	// ссылка на фильтр отелей по стране
	$arResult['all_sanatorii'] = makeFilterLink("COUNTRY", Set::HOTELS_IBLOCK_ID, $arResult['ID'], Set::SANATORII_SECTION_ID);
	array_pop($arResult['sanatorii']);
}


// Специальные предложения
$arResult["offers"] = getAdditionalElementsCountry(array("ACTIVE" => "Y", "IBLOCK_ID" => Set::SPECIAL_OFF_IBLOCK_ID, "PROPERTY_COUNTRY" => $arResult['ID']), 4);

if(count($arResult['offers']) > 7)
{
	// ссылка на фильтр туров по стране
	$arResult['all_offers'] = makeFilterLink("COUNTRY", Set::SPECIAL_OFF_IBLOCK_ID, $arResult['ID']);
	array_pop($arResult['offers']);
}

// города
$arResult["cities"] = getAdditionalElements(array("ACTIVE" => "Y", "IBLOCK_ID" => Set::CITY_IBLOCK_ID, "PROPERTY_COUNTRY" => $arResult['ID']), null, array('NAME' => 'ASC'));


//Статьи
$arResult["articles"] = getAdditionalElements(array("ACTIVE" => "Y", "IBLOCK_ID" => Set::ARTICLE_COUNTRY_IBLOCK_ID, "PROPERTY_COUNTRY" => $arResult['ID'], 'PROPERTY_SHOW_IN_RIGHT_MENU' => false));

//Визы, документы и памятка
$arResult["articles2"] = getAdditionalElements(array("ACTIVE" => "Y", "IBLOCK_ID" => Set::ARTICLE_COUNTRY_IBLOCK_ID, "PROPERTY_COUNTRY" => $arResult['ID'], '!PROPERTY_SHOW_IN_RIGHT_MENU' => false));


$res = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => Set :: SHARES_IBLOCK_ID, "PROPERTY_COUNTRY" => $arResult["ID"], "ACTIVE" => "Y"), false, false, Array("IBLOCK_ID", "DETAIL_PAGE_URL", "ID", "NAME"));
while ($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
    $arProps = $ob->GetProperties();
	if($arProps["SHOW_ON_COUNTRY"]["VALUE"] == "Y"){
		$arResult["SHARES"][$arFields["ID"]] = Array("NAME" => $arFields["NAME"], "LINK" => $arFields["DETAIL_PAGE_URL"]);
	}
}



