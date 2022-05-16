<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if (is_array($arResult["PROPERTY_LIST"]) && !empty($arResult["PROPERTY_LIST"]))
{
	// resort PROPERTY_LIST
	$resort = array();
	if(in_array(331, $arResult["PROPERTY_LIST"]))
		$resort[] = 331; // привязка к элементу иб
	if(in_array("NAME", $arResult["PROPERTY_LIST"]))
		$resort[] = "NAME"; // имя
	if(in_array(334, $arResult['PROPERTY_LIST']))
		$resort[] = 334; // email
	if(in_array(332, $arResult['PROPERTY_LIST']))
		$resort[] = 332; // оценка
	if(in_array(333, $arResult['PROPERTY_LIST']))
		$resort[] = 333; // фотографии
	if(in_array("DETAIL_TEXT", $arResult['PROPERTY_LIST']))
		$resort[] = "DETAIL_TEXT"; // текст

	$arResult['PROPERTY_LIST'] = $resort;

}