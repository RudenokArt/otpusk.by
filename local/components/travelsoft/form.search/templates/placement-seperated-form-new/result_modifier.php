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

foreach ($arResult['SEARCH'] as $arItem) {
	$hash = "#section-1234522";
	if ($arItem['PROPERTY_MT_HOTELKEY_VALUE'] > 0)
		$arResult['JSON_LINKS_CONTAINER'][$arItem['PROPERTY_MT_HOTELKEY_VALUE']] = $arItem['PROPERTY_TYPE_ID_ENUM_ID'] != Set::SANATORII_PROP_ID ? $arItem['DETAIL_PAGE_URL'] .$hash : Set::SANATORII_SEF_FOLDER . $arItem['CODE'] . "/" . $hash;

}

/*if ($USER->isAdmin())
	dm($arResult['JSON_LINKS_CONTAINER']);*/

if ($arResult['JSON_LINKS_CONTAINER'])
	$arResult['JSON_LINKS_CONTAINER'] = json_encode($arResult['JSON_LINKS_CONTAINER']);

