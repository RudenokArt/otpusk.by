<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//=====================================================================//
//						ФОРМА заявки на размещение					   //
//=====================================================================//
$form_name = "Оставить заявку на размещение";
$additional_info['name'] = $arResult['NAME'];
require_once $_SERVER['DOCUMENT_ROOT']. "/include/order_form.php";
/*
$res = CIBlockElement::GetByID($arResult['ID'])->GetNextElement()->GetFields();
// КОСТЫЛЬ ДЛЯ КАНОНИЧЕСКИХ URL =((
if ( ($arResult['PROPERTIES']['TYPE_ID']['VALUE_ENUM_ID'] == 25)) {
    $APPLICATION->AddHeadString('<link rel="canonical" href="' . "https://" . $_SERVER['SERVER_NAME'] . Set::SANATORII_SEF_FOLDER . $res['CODE'] . "/" . '"/>');
}else {
    $APPLICATION->AddHeadString('<link rel="canonical" href="' . "https://" . $_SERVER['SERVER_NAME'] . Set::HOTELS_SEF_FOLDER . $res['CODE'] . "/" . '"/>');
}
*/