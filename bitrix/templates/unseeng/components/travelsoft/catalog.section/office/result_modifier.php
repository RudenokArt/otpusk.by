<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//dm($arResult);

$arResult["town"] = array();
$arResult['duration'] = array(); // продолжительность тура
$p_d = array(); $ib = -1;
foreach($arResult["ITEMS"] as &$v)
{
	$i = $file = CFile::ResizeImageGet($v["PREVIEW_PICTURE"], array('width'=>600, 'height'=>400), BX_RESIZE_IMAGE_EXACT, true);

	$v["PREVIEW_PICTURE"]["RESIZE_SRC"] = $i["src"] != "" ? $i["src"] : "";

	if($v["DISPLAY_PROPERTIES"]["POINT_DEPARTURE"]["VALUE"] > 0)
	{
		$p_d[] = $v["DISPLAY_PROPERTIES"]["POINT_DEPARTURE"]["VALUE"];
	}

	if($v["DISPLAY_PROPERTIES"]["DAYS"]["VALUE"] != "")
		$arResult['duration'][$v['ID']] = w($v["DISPLAY_PROPERTIES"]["DAYS"]["VALUE"] + 1) . " " . w($v["DISPLAY_PROPERTIES"]["DAYS"]["VALUE"], 2);

	if(!empty($v["PROPERTIES"]["OFFICE"]["VALUE"])) {
        $ress = CIBlockElement::GetList(array(), array("IBLOCK_ID"=>Set::DEPARTMENT_IBLOCK_ID, "ID" => $v["PROPERTIES"]["OFFICE"]["VALUE"], "ACTIVE" => "Y"), false, false, array("IBLOCK_ID", "ID", "PROPERTY_TOWN.NAME"))->GetNextElement()->GetFields();
        $arResult["town"][$v['ID']] = $ress["PROPERTY_TOWN_NAME"];
    }

}

// получаем количество по странам и городам
if($p_d)
{
	$arResult["g"] = array();
	$dv_c = CIBlockElement::GetList(false, array("IBLOCK_ID" => 11, "ID" => $p_d), false, false, array("ID", "PROPERTY_CN_NAME_chego"));
	while($c = $dv_c->Fetch())
		$arResult["g"][$c["ID"]] = $c["PROPERTY_CN_NAME_CHEGO_VALUE"];
}


// url сортировок
$o = strtolower($_REQUEST["order"]) == "asc" ? "desc" : "asc";

$arResult["name_sorting"][0] = $APPLICATION->GetCurPageParam("sort=name&order=" . $o, array("sort", "order"));
/*$arResult["date_sorting"][0] = $APPLICATION->GetCurPageParam("sort=date&order=" . $o, array("sort", "order"));*/

if($_REQUEST["sort"] == "name")
	$sort = "name";
/*else
	if($_REQUEST["sort"] == "date")
		$sort = "date";*/

if($sort)
{
	$arResult[$sort . "_sorting"][1] = "class='active'";
	$arResult[$sort . "_sorting"][2] = strtolower($_REQUEST["order"]) == "asc" ? "<i class='fa fa-long-arrow-up'></i>" : "<i class='fa fa-long-arrow-down'></i>";
}



