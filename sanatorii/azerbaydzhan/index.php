<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Цены на путевки в санатории Азербайджана на 2020 от официального сайта ЦЕНТРКУРОРТ ✅ Для выбора необходимого профиля лечения и получения скидки в одном из санаториев Азербайджана звоните +375 (17) 215-49-49.");
$APPLICATION->SetPageProperty("canonical", "https://www.otpusk.by/sanatorii/");
$APPLICATION->SetPageProperty("title", "Санатории Азербайджана цены на 2020 - официальный сайт ЦЕНТРКУРОРТ");
$APPLICATION->SetTitle("Санатории Азербайджана");
?><?
$GLOBALS['arrFilter']["PROPERTY_61"] = 150;
$GLOBALS['arrFilter']["PROPERTY_60"] = 25;
?>
<?
$APPLICATION->IncludeComponent(
	"travelsoft:catalog.section", 
	"hotel-list", 
	array(
		"ACTION_VARIABLE" => "",
		"ADD_PICT_PROP" => "-",
		"ADD_PROPERTIES_TO_BASKET" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"BACKGROUND_IMAGE" => "-",
		"BASKET_URL" => "",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"DETAIL_URL" => "#SITE_DIR#sanatorii/#ELEMENT_CODE#/",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "SORT",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "ASC",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_NAME" => "arrFilter",
		"IBLOCK_ID" => "14",
		"IBLOCK_TYPE" => "otpusk",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LABEL_PROP" => "-",
		"LINE_ELEMENT_COUNT" => "",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "",
		"MESS_BTN_BUY" => "",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_SUBSCRIBE" => "",
		"MESS_NOT_AVAILABLE" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"OFFERS_LIMIT" => "0",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "modern",
		"PAGER_TITLE" => "",
		"PAGE_ELEMENT_COUNT" => "100",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(
		),
		"PRICE_VAT_INCLUDE" => "N",
		"PRODUCT_ID_VARIABLE" => "",
		"PRODUCT_PROPERTIES" => array(
		),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"PROPERTY_CODE" => array(
			0 => "COUNTRY",
			1 => "TOWN",
			2 => "TYPE_ID",
			3 => "CAT_ID",
			4 => "HD_ADDRESS",
			5 => "HD_ADDRESS_COUNTRY_LANGUAGE",
			6 => "HD_PHONE",
			7 => "HD_FAX",
			8 => "HD_EMAIL",
			9 => "HD_HTTP",
			10 => "MAP",
			11 => "CURRENCY_BY",
			12 => "PRICE_MIN_BY",
			13 => "PRICE_MIN_RU",
			14 => "CURRENCY_RU",
			15 => "MAP_SCALE",
			16 => "SEARCH",
			17 => "MEDPROFIL",
			18 => "NATIONAL_PARK",
			19 => "HD_DESC",
			20 => "PROEZD",
			21 => "SPORTS_COMPLEX",
			22 => "HD_DESCROOM",
			23 => "HD_DESCMEAL",
			24 => "HD_DESCSERVICE",
			25 => "HD_DESCSPORT",
			26 => "HD_DESCSHEALTH",
			27 => "HD_DESCCHILD",
			28 => "HD_DESCBEACH",
			29 => "MEDICAL_TREATMENT",
			30 => "TYPE_PERMIT",
			31 => "HD_ADDINFORMATION",
			32 => "VODEO",
			33 => "DEPARTURE",
			34 => "DEPARTURE_TEXT",
			35 => "FOOD",
			36 => "DAYS",
			37 => "TOURTYPE",
			38 => "TRANSPORT",
			39 => "HOTEL",
			40 => "PRICE",
			41 => "CURRENCY",
			42 => "DISCOUNT",
			43 => "ADDITIONAL",
			44 => "TOUR_TYPE",
			45 => "NEW",
			46 => "MT_ID",
			47 => "PRICE_INCLUDE",
			48 => "PRICE_NO_INCLUDE",
			49 => "DAILY",
			50 => "MEDICINE",
			51 => "DOCUMENT",
			52 => "NDAYS",
			53 => "ACCOMODATIONS",
			54 => "POINT_DEPARTURE",
			55 => "",
		),
		"SECTION_CODE" => "",
		"SECTION_ID" => "167",
		"SECTION_ID_VARIABLE" => "",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SEF_MODE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "Y",
		"SET_TITLE" => "N",
		"SHOW_404" => "Y",
		"SHOW_ALL_WO_SECTION" => "Y",
		"SHOW_PRICE_COUNT" => "",
		"TEMPLATE_THEME" => "",
		"TITLE_TEXT" => "Санатории",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"COMPONENT_TEMPLATE" => "hotel-list",
		"FILE_404" => ""
	),
	false
);
?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>