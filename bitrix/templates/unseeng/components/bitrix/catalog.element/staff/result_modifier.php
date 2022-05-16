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


if(!empty($cts))
{
	$db_cts = CIBlockElement::GetList(array(), array("IBLOCK_ID" => 11, "ID" => $cts), false, false, array("ID", "PROPERTY_CN_NAME_CHEGO", 'PROPERTY_MAP', 'NAME'));

	$cts_res = array();
	while($ct = $db_cts->Fetch())
		$cts_res[$ct['ID']] = $ct;

	/* точки для карты */
	if(!empty($cts_res))
	{
		if(isset($cts_res[$pd]))
		{
			$way = $arResult["PROPERTIES"]["TOWN"]['VALUE'];

			$arResult['p_dep'] = $cts_res[$pd]["PROPERTY_CN_NAME_CHEGO_VALUE"];

			$arResult['transfer']['start'] = explode(',',$cts_res[$pd]["PROPERTY_MAP_VALUE"]);
			$arResult['transfer']['start'][] = $cts_res[$pd]["NAME"];
			$end = array_pop($way);
			$arResult['transfer']['end'] = explode(',',$cts_res[$end]["PROPERTY_MAP_VALUE"]);
			$arResult['transfer']['end'][] = $cts_res[$end]["NAME"];
			
			foreach($way as $k => $v)
			{
				$arResult['transfer']['way'][$k] = explode(',',$cts_res[$v]["PROPERTY_MAP_VALUE"]);
				$arResult['transfer']['way'][$k][] = $cts_res[$v]["NAME"];
			}
		
		}
		else
		{
			$current = current($cts_res);	
			$arResult['point'][] = explode(',',$current["PROPERTY_MAP_VALUE"]);
			$arResult['point'][] = $current["NAME"];
		}
	}
}

// Похожие предложения
$arResult["offers"] = getAdditionalElements(array("IBLOCK_ID" => $arParams["IBLOCK_ID"], '!=ID' => $arResult['ID'], "PROPERTY_OFFICE"=>$arResult['PROPERTIES']['OFFICE']['VALUE']), 3);

//Статьи
$arResult["articles"] = getAdditionalElements(array("IBLOCK_ID" => Set::ARTICLE_HOTELS_IBLOCK_ID, "PROPERTY_HOTEL" => $arResult['ID']));

//Экскурсии
if(!empty($arResult["PROPERTIES"]['EXCURCIONS']['VALUE']))
{
	$arResult["excursions"] = getAdditionalElements(array("IBLOCK_ID" => Set::EXCURSIONS_IBLOCK_ID, "ID" => $arResult["PROPERTIES"]['EXCURCIONS']['VALUE']));
}

$arResult['sights'] = getAdditionalElements(array("IBLOCK_ID" => Set::SIGHTS_IBLOCK_ID, "PROPERTY_EXCURCIONS" => $arResult['ID']));

