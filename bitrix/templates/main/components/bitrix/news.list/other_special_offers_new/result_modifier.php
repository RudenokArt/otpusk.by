<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

// собираем страны, ресайзим картинки
$arResult["COUNTRIES"] = array();
foreach($arResult["ITEMS"] as &$i)
{
	$f = CFile::ResizeImageGet($i['PREVIEW_PICTURE'], array('width'=>600, 'height'=>400), BX_RESIZE_IMAGE_EXACT, true);
	
	$i["PREVIEW_PICTURE"]["SRC"] = $f['src'];

	if($i["PREVIEW_PICTURE"]["SRC"] == "")
		$i["PREVIEW_PICTURE"]["SRC"] = SITE_TEMPLATE_PATH . "/images/nophoto.jpg";

	foreach ($i["DISPLAY_PROPERTIES"]["COUNTRY"]["VALUE"] as $v)
	{
		$arResult["COUNTRIES"][$v] = $i["DISPLAY_PROPERTIES"]["COUNTRY"]["LINK_ELEMENT_VALUE"][$v]["NAME"];
	}

	$IBLOCK_ID_TYPES_TOURS = $i["DISPLAY_PROPERTIES"]["TOURTYPE"]["LINK_IBLOCK_ID"];
}

if(!empty($IBLOCK_ID_TYPES_TOURS)) {
    $res = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => $IBLOCK_ID_TYPES_TOURS, "!ID" => 484, "ACTIVE" => "Y"), false, false, Array("IBLOCK_ID", "ID", "NAME"));
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $cnt = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => $arResult["ID"], "PROPERTY_TOURTYPE" => $arFields["ID"], '!PROPERTY_SHOW_ON_MAIN_VALUE' => false, ">=PROPERTY_DEPARTURE" => date('Y-m-d'), "ACTIVE" => "Y"), Array(), Array(), Array());
        if($cnt > 0){
            $arResult["TYPE_TOURS"][$arFields["ID"]] = $arFields["NAME"];
		}
    }
}
?>
