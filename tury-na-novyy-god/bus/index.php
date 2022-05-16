<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Автобусные туры на новый год 2020 в Европу");
$APPLICATION->SetPageProperty("description", "Европейские автобусные туры на Новый год  рассчитаны на взрослых и детей, так что вы можете отправиться в путешествие всей семьей.");
$APPLICATION->SetTitle("Автобусные туры на Новый год и Рождество 2020");
?><p>
	 Новогодняя Европа похожа на ожившую зимнюю сказку. Средневековые города, засыпанные снегом, с украшенными улицами и рождественскими базарами, напоминают о далеком детстве. Зимние каникулы в Европе пахнут ароматом свежей выпечки и еловой хвои, пряной корицей, свежими апельсинами и нежной ванилью. Попасть в сказку просто – автобусные туры увезут вашу семью навстречу новогодней мечте.
</p>
<p>
	 В путешествии вы увидите европейские города и зимнюю природу, попробуете новые для вас блюда и развлечения, познакомитесь с новыми людьми из разных стран. Главной изюминкой зимних каникул станет встреча Нового Года и Рождества по западным обычаям. Автобусные туры из Минска начинаются в период рождественских распродаж, так что в поездке вы сможете обновить свой гардероб и привезти сувениры для родных и друзей.
</p>
<p>
	 Европейские автобусные туры на Новый год&nbsp; рассчитаны на взрослых и детей, так что вы можете отправиться в путешествие всей семьей. Для детей предусмотрены отдельные развлекательные программы с европейским волшебником – Санта-Клаусом, и его помощниками. Для тех семей, которые любят спокойный отдых, есть спокойные туры с проживанием в санатории, без поездок по многим городам. Выбирая санаторий, вы будете отдыхать в красивом лесу, заниматься зимними видами спорта и посещать лечебные программы.
</p>
<p>
	 Спешите бронировать автобусные туры на Новый год в Европу из Минска 2021. Подарите своей семье незабываемую зимнюю сказку.
</p>
<?
// принудительная установка фильтра по типу тура Новогодние туры
$_GET["set_filter"]="Y";
$_GET["arrFilter_101"]="1465844357";
///////////////////////////////////////////////
define("NEW_YEAR_TOUR_PAGE", true);
?>
<?$APPLICATION->IncludeComponent(
	"travelsoft:catalog.section",
	"tours-list",
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
		"CACHE_TYPE" => "N",
		"COMPONENT_TEMPLATE" => "tours-list",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "SORT",
		"ELEMENT_SORT_FIELD2" => "timestamp_x",
		"ELEMENT_SORT_ORDER" => "ASC",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_NAME" => "arrFilter",
		"IBLOCK_ID" => "18",
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
		"PAGE_ELEMENT_COUNT" => "10",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(),
		"PRICE_VAT_INCLUDE" => "N",
		"PRODUCT_ID_VARIABLE" => "",
		"PRODUCT_PROPERTIES" => array(),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"PROPERTY_CODE" => array(0=>"COUNTRY",1=>"POINT_DEPARTURE",2=>"TOWN",3=>"DEPARTURE",4=>"DEPARTURE_TEXT",5=>"FOOD",6=>"DAYS",7=>"TOURTYPE",8=>"TRANSPORT",9=>"TYPE_EXCURSIONS",10=>"HOTEL",11=>"PRICE",12=>"CURRENCY",13=>"DISCOUNT",14=>"ADDITIONAL",15=>"TOUR_TYPE",16=>"NEW",17=>"MT_ID",18=>"PRICE_INCLUDE",19=>"PRICE_NO_INCLUDE",20=>"MT_KEY",21=>"MEDICINE",22=>"DOCUMENT",23=>"PRICE_FOR",24=>"NDAYS",25=>"DAILY",26=>"ACCOMODATIONS",27=>"",),
		"SECTION_CODE" => "",
		"SECTION_ID" => "295",
		"SECTION_ID_VARIABLE" => "",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(0=>"",1=>"",),
		"SEF_MODE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "N",
		"SHOW_PRICE_COUNT" => "",
		"TEMPLATE_THEME" => "",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>