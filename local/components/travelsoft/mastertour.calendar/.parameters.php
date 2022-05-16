<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
    return;

$arProperty = array();
$rsProp = CIBlockElement::GetList(array("SORT" => "ASC"), Array("IBLOCK_ID" => Set::TYPETOURS_IBLOCK_ID, "ACTIVE" => "Y", "!=PROPERTY_MASTERTOUR_ID_VALUE" => false), false, false,
    Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_MASTERTOUR_ID"));
while ($arr=$rsProp->GetNext()) {
    $arProperty[$arr["PROPERTY_MASTERTOUR_ID_VALUE"]] = $arr["NAME"];
}

$arComponentParameters = array(
	"PARAMETERS" => array(
		"QUERY_ADDRESS" => array(
			"PARENT" => "BASE",
			"NAME" => 'Адрес запроса',
			"TYPE" => "STRING"
		),
        "TYPE_TOURS" => array(
            "PARENT" => "BASE",
            "NAME" => 'Типы выводимых туров',
            "TYPE" => "LIST",
            "MULTIPLE" => "Y",
            "VALUES" => $arProperty
        ),
	)
);