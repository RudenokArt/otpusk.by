<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

if (empty($arResult['SEARCH'])) return;

if ($_REQUEST['CheckIn'] != "" && 
		$_REQUEST['CheckOut'] != "" && 
			MakeTimeStamp($_REQUEST['CheckIn']) >= MakeTimeStamp($_REQUEST['CheckOut'])) {
	$_REQUEST['CheckOut'] = date('d.m.Y', MakeTimeStamp($_REQUEST['CheckIn']) + 24*3600);
}

$arResult['DEFAULT']['CHECKIN'] = $_REQUEST['CheckIn'] != "" ? $_REQUEST['CheckIn'] : date('d.m.Y', time());
$arResult['DEFAULT']['CHECKOUT'] = $_REQUEST['CheckOut'] != "" ? $_REQUEST['CheckOut'] : date('d.m.Y', time() + 24*7*3600);

$arResult['DEFAULT']['ADULTS'] = $_REQUEST['Adults'] != "" ? $_REQUEST['Adults'] : 2;
$arResult['DEFAULT']['CHILDREN'] = $_REQUEST['Children'] != "" ? $_REQUEST['Children'] : 0;
$arResult['DEFAULT']['PRICE_TYPE'] = $_REQUEST['price_type'] > 0 ? (int)$_REQUEST['price_type'] : 0;
$arResult['ACTION_FORM'] = $APPLICATION->GetCurPage() . "/#section-1234522";

if ($arParams['MT_KEY']) {
	$arResult['PRICE_FOR_THE_CITIZENS'][0] = "Цена для граждан РБ";
	$el = CIBlockElement::GetList(false, array("IBLOCK_ID" => Set::HOTELS_IBLOCK_ID, "PROPERTY_MT_HOTELKEY" => $arParams['MT_KEY']), false, false)->GetNextElement();
	if ($el) {
		$p = $el->GetProperties();

		if ($p['RF_PRICE_TYPE']['VALUE'] == "Y") {
			$arResult['PRICE_FOR_THE_CITIZENS'][1] = $p['RF_PRICE_TYPE']['NAME'];
		}
		if ($p['FOREIGN_PRICE_TYPE']['VALUE'] == "Y") {
			$arResult['PRICE_FOR_THE_CITIZENS'][2] = $p['FOREIGN_PRICE_TYPE']['NAME'];
		}
	}
}