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
}
?>