<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.element", 
	"hotels", 
	array(
		"TEMPLATE_THEME" => "blue",
		"DISPLAY_NAME" => "Y",
		"DETAIL_PICTURE_MODE" => "IMG",
		"ADD_DETAIL_TO_SLIDER" => "Y",
		"ADD_PICT_PROP" => "-",
		"LABEL_PROP" => "-",
		"DISPLAY_PREVIEW_TEXT_MODE" => "E",
		"PRODUCT_SUBSCRIPTION" => "Y",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_MAX_QUANTITY" => "N",
		"SHOW_CLOSE_POPUP" => "Y",
		"DISPLAY_COMPARE" => "N",
		"COMPARE_PATH" => "",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_BTN_COMPARE" => "Сравнить",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"USE_VOTE_RATING" => "N",
		"USE_COMMENTS" => "N",
		"BRAND_USE" => "N",
		"IBLOCK_TYPE" => "otpusk",
		"IBLOCK_ID" => "14",
		"ELEMENT_ID" => "",
		"ELEMENT_CODE" => $_REQUEST["ELEMENT_CODE"],
		"SECTION_ID" => "167",
		"SECTION_CODE" => "",
		"SECTION_URL" => "",
		"BASKET_URL" => "",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"ADD_PROPERTIES_TO_BASKET" => "N",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"CHECK_SECTION_ID_VARIABLE" => "N",
		"SEF_MODE" => "Y",
		"SET_TITLE" => "Y",
		"SET_CANONICAL_URL" => "Y",
		"SHOW_DEACTIVATED" => "N",
		"SET_BROWSER_TITLE" => "Y",
		"BROWSER_TITLE" => "-",
		"SET_META_KEYWORDS" => "Y",
		"META_KEYWORDS" => "-",
		"SET_META_DESCRIPTION" => "Y",
		"META_DESCRIPTION" => "-",
		"SET_LAST_MODIFIED" => "Y",
		"USE_MAIN_ELEMENT_SECTION" => "Y",
		"SET_STATUS_404" => "Y",
		"SHOW_404" => "Y",
		"MESSAGE_404" => "",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_ELEMENT_CHAIN" => "Y",
		"PROPERTY_CODE" => array(
			0 => "COUNTRY",
			1 => "TOWN",
			2 => "TYPE_ID",
			3 => "MT_KEY",
			4 => "PRICE_TEXT",
			5 => "DEPARTURE",
			6 => "DEPARTURE_TEXT",
			7 => "FOOD",
			8 => "DAYS",
			9 => "TOURTYPE",
			10 => "TRANSPORT",
			11 => "HOTEL",
			12 => "PRICE",
			13 => "CURRENCY",
			14 => "DISCOUNT",
			15 => "ADDITIONAL",
			16 => "TOUR_TYPE",
			17 => "NEW",
			18 => "MT_ID",
			19 => "PRICE_INCLUDE",
			20 => "PRICE_NO_INCLUDE",
			21 => "MEDICINE",
			22 => "DOCUMENT",
			23 => "SHOW_ON_MAIN",
			24 => "POINT_DEPARTURE",
			25 => "NDAYS",
			26 => "MT_COUNTRY_KEY",
			27 => "FILE",
			28 => "",
		),
		"OFFERS_FIELD_CODE" => "",
		"OFFERS_PROPERTY_CODE" => "",
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_FIELD2" => "name",
		"OFFERS_SORT_ORDER2" => "desc",
		"OFFERS_LIMIT" => "0",
		"BACKGROUND_IMAGE" => "-",
		"PRICE_CODE" => array(
		),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "N",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"PRODUCT_PROPERTIES" => array(
		),
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"USE_PRODUCT_QUANTITY" => "Y",
		"LINK_IBLOCK_TYPE" => "",
		"LINK_IBLOCK_ID" => "",
		"LINK_PROPERTY_SID" => "",
		"LINK_ELEMENTS_URL" => "",
		"SET_VIEWED_IN_COMPONENT" => "N",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_NOTES" => "",
		"CACHE_GROUPS" => "Y",
		"USE_ELEMENT_COUNTER" => "Y",
		"HIDE_NOT_AVAILABLE" => "N",
		"GIFTS_DETAIL_BLOCK_TITLE" => "Выберите один из подарков",
		"GIFTS_DETAIL_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_DETAIL_PAGE_ELEMENT_COUNT" => "3",
		"GIFTS_DETAIL_TEXT_LABEL_GIFT" => "Подарок",
		"GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE" => "Выберите один из товаров, чтобы получить подарок",
		"GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT" => "3",
		"GIFTS_MESS_BTN_BUY" => "Выбрать",
		"GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
		"GIFTS_SHOW_IMAGE" => "Y",
		"GIFTS_SHOW_NAME" => "Y",
		"GIFTS_SHOW_OLD_PRICE" => "Y",
		"USE_GIFTS_DETAIL" => "Y",
		"USE_GIFTS_MAIN_PR_SECTION_LIST" => "Y",
		"OFFERS_CART_PROPERTIES" => "",
		"ADD_TO_BASKET_ACTION" => array(
			0 => "BUY",
			1 => "ADD",
		),
		"SHOW_BASIS_PRICE" => "N",
		"CONVERT_CURRENCY" => "Y",
		"CURRENCY_ID" => "RUB",
		"QUANTITY_FLOAT" => "N",
		"COMPONENT_TEMPLATE" => "hotels",
		"FILE_404" => "/404.php",
		"SEF_RULE" => "/sanatorii/#ELEMENT_CODE#/",
		"SECTION_CODE_PATH" => "",
		"PLACEMENT_URL" => "#SITE_DIR#sanatorii/#ELEMENT_CODE#/",
		"DETAIL_URL" => "",
		"STRICT_SECTION_CHECK" => "N",
		"COMPATIBLE_MODE" => "Y"
	),
	false
);?>
<?
$APPLICATION->IncludeFile($SERVER["DOCUMENT_ROOT"]."/include/online_order_form.php", Array(), Array(
    "MODE"      => "html",        // будет редактировать в веб-редакторе
    "NAME"      => "Оставить заявку",      // текст всплывающей подсказки на иконке
));
?>