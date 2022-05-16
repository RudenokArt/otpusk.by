<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader;

Loader::includeModule('iblock');

$arTypesEx = CIBlockParameters::GetIBlockTypes(array("-"=>" "));

$arIBlocks=array();
$db_iblock = CIBlock::GetList(array("SORT"=>"ASC"), array("SITE_ID"=>$_REQUEST["site"], "TYPE" => ($arCurrentValues["IBLOCK_TYPE"]!="-"?$arCurrentValues["IBLOCK_TYPE"]:"")));
while($arRes = $db_iblock->Fetch())
	$arIBlocks[$arRes["ID"]] = $arRes["NAME"];


$arProperty_LNS = $arProperty = array();
$rsProp = CIBlockProperty::GetList(array("sort"=>"asc", "name"=>"asc"), array("ACTIVE"=>"Y", "IBLOCK_ID"=>(isset($arCurrentValues["IBLOCK_ID"])?$arCurrentValues["IBLOCK_ID"]:$arCurrentValues["ID"])));

while ($arr=$rsProp->Fetch()) {
	if ($arr["PROPERTY_TYPE"] == "E") 
		$arProperty_LNS[$arr["CODE"] . "_" . $arr['LINK_IBLOCK_ID']] = $arr["NAME"];
	else
		$arProperty[$arr["CODE"]] = $arr["NAME"];
}

$arComponentParameters = array(
	"GROUPS" => array(
	),
	"PARAMETERS" => array(
		"IBLOCK_TYPE" => array(
			"PARENT" => "BASE",
			"NAME" => "Тип инфоблока",
			"TYPE" => "LIST",
			"VALUES" => $arTypesEx,
			"DEFAULT" => "",
			"REFRESH" => "Y",
		),
		"IBLOCK_ID" => array(
			"PARENT" => "BASE",
			"NAME" => 'Инфоблок',
			"TYPE" => "LIST",
			"VALUES" => $arIBlocks,
			"DEFAULT" => '',
			"ADDITIONAL_VALUES" => "Y",
			"REFRESH" => "Y",
		),
		"ADDITIONAL_SEARCH" => array(
			"PARENT" => "BASE",
			"NAME" => 'В поиске также учавствуют',
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"VALUES" => $arProperty_LNS
		),
		"PROPERTY_CODE" => array(
			"PARENT" => "BASE",
			"NAME" => 'Также получить',
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"VALUES" => $arProperty
		),
		"SECTION_ID" => array(
			"PARENT" => "BASE",
			"NAME" => 'Раздел инфоблока',
			"TYPE" => "STRING",
			"MULTIPLE" => "N",
			"VALUES" => ""
		),
		"QUERY_ADDRESS" => array(
			"PARENT" => "BASE",
			"NAME" => 'Страница поиска по-умолчанию',
			"TYPE" => "STRING"
		),
	)
);