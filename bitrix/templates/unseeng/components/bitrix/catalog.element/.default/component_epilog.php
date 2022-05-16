<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//=====================================================================//
//						ФОРМА заявки на тур							   //
//=====================================================================//

$additional_info['name'] = $arResult['NAME'];

// дни/ночи
if($arResult['PROPERTIES']['DAYS']['VALUE'] > 0)
	$additional_info['duration'] = w($arResult['PROPERTIES']['DAYS']['VALUE']) . "/" . w($arResult['PROPERTIES']['DAYS']['VALUE'],2);

// даты выезда
if(!empty($arResult['PROPERTIES']['DEPARTURE']['VALUE']))
	$additional_info['dates'] = array_map(function($t){ return ConvertDateTime($t, "DD-MM-YYYY", "ru"); }, $arResult['PROPERTIES']['DEPARTURE']['VALUE']);

// питание
if($arResult['PROPERTIES']['FOOD']['VALUE'] > 0)
{
	$food = CIBlockElement::GetByID($arResult['PROPERTIES']['FOOD']['VALUE'])->GetNextElement()->GetFields();
	$additional_info['food'] = $food['NAME'];
}

// стоимость для взрослых
if($arResult['PROPERTIES']['PRICE']['VALUE'] > 0 && $arResult['PROPERTIES']['CURRENCY']['VALUE'] > 0)
{
	$currency = CIBlockElement::GetByID($arResult['PROPERTIES']['CURRENCY']['VALUE'])->GetNextElement()->GetFields();
	$additional_info['price'] = convert_currency($arResult['PROPERTIES']['PRICE']['VALUE'], $arResult['PROPERTIES']['CURRENCY']['VALUE']);
	if($arResult['PROPERTIES']['CURRENCY']['VALUE'] != Set::CURRENCY_BYR_ID)
		$additional_info['source_price'] = number_format($arResult['PROPERTIES']['PRICE']['VALUE'], 0, "", " ") . " " . $currency['NAME'];
}

// стоимость для детей
if($arResult['PROPERTIES']['PRICE_CHILD']['VALUE'] > 0 && $arResult['PROPERTIES']['CURRENCY']['VALUE'] > 0)
{
	$currency = CIBlockElement::GetByID($arResult['PROPERTIES']['CURRENCY']['VALUE'])->GetNextElement()->GetFields();
	$additional_info['price_child'] = convert_currency($arResult['PROPERTIES']['PRICE_CHILD']['VALUE'], $arResult['PROPERTIES']['CURRENCY']['VALUE']);
	if($arResult['PROPERTIES']['CURRENCY']['VALUE'] != Set::CURRENCY_BYR_ID)
		$additional_info['source_price_child'] = number_format($arResult['PROPERTIES']['PRICE_CHILD']['VALUE'], 0, "", " ") . " " . $currency['NAME'];
}

require_once $_SERVER['DOCUMENT_ROOT']. "/include/order_form.php";

