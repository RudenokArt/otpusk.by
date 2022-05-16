<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//dm($arResult);

$arResult["sm_img"] = $arResult['b_img'] = array();

foreach ($arResult["PROPERTIES"]["PICTURES"]["VALUE"] as &$i)
{
	 $file = CFile::ResizeImageGet($i, array('width'=>103, 'height'=>57), BX_RESIZE_IMAGE_EXACT, true);

	 $arResult['sm_img'][] = $file['src'];
	
	$file = CFile::ResizeImageGet($i, array('width'=>840, 'height'=>460), BX_RESIZE_IMAGE_EXACT, true);

	 $arResult['b_img'][] = $file['src'];
}

$arResult['point'][] = explode(',',$arResult['PROPERTIES']['MAP']['VALUE']);
$arResult['point'][] = $arResult["NAME"];

// Похожие предложения
$arResult["offers"] = getAdditionalElements(array("IBLOCK_ID" => $arParams["IBLOCK_ID"], 'IBLOCK_SECTION_ID' => $arParams['SECTION_ID'],'!=ID' => $arResult['ID'], 'PROPERTY_COUNTRY' => $arResult['PROPERTIES']['COUNTRY']['VALUE'], 'PROPERTY_TOWN' => $arResult['PROPERTIES']['TOWN']['VALUE'], 'ACTIVE' => 'Y'), 3);

//Статьи
$arResult["articles"] = getAdditionalElements(array("IBLOCK_ID" => Set::ARTICLE_HOTELS_IBLOCK_ID, "PROPERTY_HOTEL" => $arResult['ID']));

//Экскурсии
if(!empty($arResult["PROPERTIES"]['EXCURCIONS']['VALUE']))
{
	$arResult["excursions"] = getAdditionalElements(array("IBLOCK_ID" => Set::EXCURSIONS_IBLOCK_ID, "ID" => $arResult["PROPERTIES"]['EXCURCIONS']['VALUE'], 'ACTIVE' => 'Y'));
}

$arResult['sights'] = getAdditionalElements(array("IBLOCK_ID" => Set::SIGHTS_IBLOCK_ID, "PROPERTY_EXCURCIONS" => $arResult['ID'], 'ACTIVE' => 'Y'));

// мед. профиль
if(!empty($arResult['PROPERTIES']['MEDPROFIL']['VALUE']))
	$arResult['medprofiles'] = getAdditionalElements(array('IBLOCK_ID' => Set::MEDPROFILE_IBLOCK_ID, 'ACTIVE' => 'Y', 'ID' => $arResult['PROPERTIES']['MEDPROFIL']['VALUE']));

// варианты пребывания
if(!empty($arResult['PROPERTIES']['TYPE_PERMIT']['VALUE']))
$arResult['permit'] = getAdditionalElements(array('IBLOCK_ID' => Set::PERMIT_IBLOCK_ID, 'ACTIVE' => 'Y', 'ID' => $arResult['PROPERTIES']['TYPE_PERMIT']['VALUE']));

$res = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => Set :: SHARES_IBLOCK_ID, "PROPERTY_HOTEL" => $arResult["ID"], "ACTIVE" => "Y"), false, false, Array("IBLOCK_ID", "DETAIL_PAGE_URL", "ID", "NAME"));
while ($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
    $arProps = $ob->GetProperties();
	if($arProps["SHOW_ON_HOTEL"]["VALUE"] == "Y"){
		$arResult["SHARES"][$arFields["ID"]] = Array("NAME" => $arFields["NAME"], "LINK" => $arFields["DETAIL_PAGE_URL"]);
	}
}
$this->__component->SetResultCacheKeys($arResult['PROPERTIES']['TYPE_ID']['VALUE_ENUM_ID']);