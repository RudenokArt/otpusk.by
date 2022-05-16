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
$arcts = array();
$point_cts = array();

if(!empty($arResult['PROPERTIES']['POINT_DEPARTURE']['VALUE'])) {
    if(is_array($arResult['PROPERTIES']['POINT_DEPARTURE']['VALUE']) && count($arResult['PROPERTIES']['POINT_DEPARTURE']['VALUE']) >= 1) {
        $pd = (int)$arResult['PROPERTIES']['POINT_DEPARTURE']['VALUE'][0];
        $arcts = $arResult['PROPERTIES']['POINT_DEPARTURE']['VALUE'];
        $point_cts = $arResult['PROPERTIES']['POINT_DEPARTURE']['VALUE'];
    } else {
        $pd = (int)$arResult['PROPERTIES']['POINT_DEPARTURE']['VALUE'];
        $arcts = $arResult['PROPERTIES']['POINT_DEPARTURE']['VALUE'];
    }
    if (!empty($pd))
        $cts[] = $pd;
}

if(!empty($arResult["PROPERTIES"]["TOWN"]['VALUE'])) {
    $cts = array_merge($cts, (array)$arResult['PROPERTIES']['TOWN']['VALUE']);
    $arcts = array_merge($arcts, (array)$arResult['PROPERTIES']['TOWN']['VALUE']);
}

if(!empty($cts))
{
	$db_cts = CIBlockElement::GetList(array(), array("IBLOCK_ID" => Set::CITY_IBLOCK_ID, "ID" => $arcts), false, false, array("ID", "PROPERTY_CN_NAME_CHEGO", 'PROPERTY_MAP', 'NAME'));

	$cts_res = array();
	while($ct = $db_cts->Fetch())
		$cts_res[$ct['ID']] = $ct;

	/* точки для карты */
	if(!empty($cts_res))
	{
        if(isset($cts_res[$pd]))
		{

			$way = $arResult["PROPERTIES"]["TOWN"]['VALUE'];

			//dm($way);

			$arResult['p_dep'] = $cts_res[$pd]["PROPERTY_CN_NAME_CHEGO_VALUE"];

			$arResult['transfer']['start'] = explode(',',$cts_res[$pd]["PROPERTY_MAP_VALUE"]);
			$arResult['transfer']['start'][] = $cts_res[$pd]["NAME"];

			if($arResult["PROPERTIES"]["TOURTYPE"]["VALUE"] == Set::BUS || $arResult["PROPERTIES"]["TOURTYPE"]["VALUE"] == Set::EXCURSION)
			{
				$arResult['transfer']['end'] = array($arResult['transfer']['start'][0], $arResult['transfer']['start'][1]);
				$arResult['transfer']['end'][] = $cts_res[$pd]["NAME"];
			}
			else
			{	
				$end = array_pop($way);
				$arResult['transfer']['end'] = explode(',',$cts_res[$end]["PROPERTY_MAP_VALUE"]);
				$arResult['transfer']['end'][] = $cts_res[$end]["NAME"];
			}
			
			
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

		if(!empty($point_cts)){
            $arResult["POINT_DEPARTURE"] = array();
            foreach ($point_cts as $point){
                if(isset($cts_res[$point])){
                    $arResult["POINT_DEPARTURE"][] = $cts_res[$point]["PROPERTY_CN_NAME_CHEGO_VALUE"];
                }
            }
        }

	}
}


// Размещение
if(!empty($arResult["PROPERTIES"]["HOTEL"]["VALUE"]))
	$arResult['hotels'] = getAdditionalElements(array("IBLOCK_ID" => Set::HOTELS_IBLOCK_ID, "ID" => $arResult["PROPERTIES"]["HOTEL"]["VALUE"]), 3);


// Экскурсии
if(!empty($arResult["PROPERTIES"]["EXCURSIONS"]["VALUE"]))
	$arResult['excursions'] = getAdditionalElements(array("IBLOCK_ID" => Set::EXCURSIONS_IBLOCK_ID, "ID" => $arResult["PROPERTIES"]["EXCURSIONS"]["VALUE"]));

// Достопримечательности
if(!empty($arResult["PROPERTIES"]["SIGHTS"]["VALUE"]))
	$arResult['sights'] = getAdditionalElements(array("IBLOCK_ID" => Set::SIGHTS_IBLOCK_ID, "ID" => $arResult["PROPERTIES"]["SIGHTS"]["VALUE"]));

// Похожие предложения
$arResult["offers"] = getAdditionalElements(array("IBLOCK_ID" => $arParams["IBLOCK_ID"], '!=ID' => $arResult['ID'], 'PROPERTY_COUNTRY' => $arResult['PROPERTIES']['COUNTRY']['VALUE'], 'PROPERTY_TOURTYPE' => $arResult['PROPERTIES']['TOURTYPE']['VALUE']), 6);

// питание
if(!empty($arResult["PROPERTIES"]["FOOD"]['VALUE']))
{
	$res = CIBlockElement::GetList(false, array('IBLOCK_ID' => Set::FOOD_IBLOCK_ID, 'ID' => $arResult["PROPERTIES"]["FOOD"]['VALUE']), false, false, array('ID', 'PROPERTY_FULLNAME'))->Fetch();

	if($res['PROPERTY_FULLNAME_VALUE'] != "")
		$arResult['FOOD_DESC'] = $res['PROPERTY_FULLNAME_VALUE'];
}

// MT ID СТРАНЫ ТУРА
if($arResult["PROPERTIES"]["COUNTRY"]['VALUE'][0] > 0)
{
	$el = CIBlockElement::GetByID($arResult["PROPERTIES"]["COUNTRY"]['VALUE'][0])->GetNextElement();
	$p = $el->GetProperties();
	if($p['CN_KEY']['VALUE'] > 0)
		$arResult["MT_COUNTRY_KEY"] = (int)$p['CN_KEY']['VALUE'];
}

if(!empty($arResult["PROPERTIES"]["DEPARTURE"]["VALUE"])){

    $date = array(
        "ITEMS" => array(),
        "DESCRIPTION" => array()
    );

    if(is_array($arResult["PROPERTIES"]["DEPARTURE"]["VALUE"])){
        $date_ = date("d.m.Y");
        foreach($arResult["PROPERTIES"]["DEPARTURE"]["VALUE"] as $t=>$item){

            if(strtotime($date_) < strtotime($item)){
                $date["ITEMS"][$t] = CIBlockFormatProperties::DateFormat("d.m.Y", MakeTimeStamp($item, CSite::GetDateFormat()));
                $date["DESCRIPTION"][$t] = $arResult["PROPERTIES"]["DEPARTURE"]["DESCRIPTION"][$t];
            }

        }
    }

    $arResult["DATES"] = $date;

}