<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Каталог отелей, который поможет Вам выбрать лучший вариант отдыха.");
$APPLICATION->SetPageProperty("canonical", "https://www.otpusk.by/oteli/");
$APPLICATION->SetTitle("Отели, гостиницы, средства размещения");
?><?$GLOBALS['arrFilter']["!PROPERTY_60"] = 25?>
<?$APPLICATION->IncludeComponent(
	"travelsoft:catalog.section",
	"hotel-list",
	Array(
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
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "SORT",
		"ELEMENT_SORT_FIELD2" => "RAND",
		"ELEMENT_SORT_ORDER" => "ASC",
		"ELEMENT_SORT_ORDER2" => "RAND",
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
		"PAGE_ELEMENT_COUNT" => "24",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(),
		"PRICE_VAT_INCLUDE" => "N",
		"PRODUCT_ID_VARIABLE" => "",
		"PRODUCT_PROPERTIES" => array(""),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"PROPERTY_CODE" => array("COUNTRY","TOWN","TYPE_ID","CAT_ID","HD_ADDRESS","HD_ADDRESS_COUNTRY_LANGUAGE","HD_PHONE","HD_FAX","HD_EMAIL","HD_HTTP","MAP","CURRENCY_BY","PRICE_MIN_BY","PRICE_MIN_RU","CURRENCY_RU","MAP_SCALE","SEARCH","MEDPROFIL","NATIONAL_PARK","HD_DESC","PROEZD","SPORTS_COMPLEX","PRICE_TEXT","HD_DESCROOM","HD_DESCMEAL","HD_DESCSERVICE","HD_DESCSPORT","HD_DESCSHEALTH","HD_DESCCHILD","HD_DESCBEACH","MEDICAL_TREATMENT","TYPE_PERMIT","HD_ADDINFORMATION","VODEO","DEPARTURE","DEPARTURE_TEXT","FOOD","DAYS","TOURTYPE","TRANSPORT","HOTEL","PRICE","CURRENCY","DISCOUNT","ADDITIONAL","TOUR_TYPE","NEW","MT_ID","PRICE_INCLUDE","PRICE_NO_INCLUDE","DAILY","MEDICINE","DOCUMENT","NDAYS","ACCOMODATIONS","POINT_DEPARTURE",""),
		"SECTION_CODE" => "",
		"SECTION_ID" => "168",
		"SECTION_ID_VARIABLE" => "",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array("",""),
		"SEF_MODE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "Y",
		"SHOW_PRICE_COUNT" => "",
		"TEMPLATE_THEME" => "",
		"TITLE_TEXT" => "Отели, гостиницы, средства размещения",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>