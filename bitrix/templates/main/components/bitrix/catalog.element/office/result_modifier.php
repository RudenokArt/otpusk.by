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

// тянем города
$cts = array();

$pd = (int)$arResult['PROPERTIES']['POINT_DEPARTURE']['VALUE'];
if(!empty($pd))
	$cts[] = $pd;

if(!empty($arResult["PROPERTIES"]["TOWN"]['VALUE']))
	$cts = array_merge($cts, (array)$arResult['PROPERTIES']['TOWN']['VALUE']);


// Похожие предложения
$arResult["offers"] = getAdditionalElements(array("IBLOCK_ID" => $arParams["IBLOCK_ID"], '!=ID' => $arResult['ID']));


//Сотрудники 
$arResult['employers'] = getAdditionalElements(array("IBLOCK_ID" => Set::EMPLOYERS_IBLOCK_ID, 'PROPERTY_OFFICE' => $arResult['ID']));
