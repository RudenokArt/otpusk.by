<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Раннее бронирование туров в Турцию 2018. Раннее бронирование отдыха из Минска");
$APPLICATION->SetPageProperty("keywords", "Раннее бронирование в Турцию");
$APPLICATION->SetPageProperty("description", "Обращаем Ваше внимание, что бронирование отдыха в Турцию из Минска можно осуществить онлайн на нашем сайте");
$APPLICATION->SetTitle("Раннее бронирование туров в Турцию");
?><br>
 <img alt="турция-min.png" src="/upload/medialibrary/988/турция-min.png" title="турция-min.png"><br>
<p>
	 Турция предлагает путешественникам со всего мира высочайший уровень сервиса, множество достопримечательностей и, конечно же, замечательный пляжный отдых.
</p>
<p>
	 Раннее бронирование туров в Турцию 2018 - это гарантия качественного отдыха. Вы не только сможете спланировать свой отпуск заранее, подойти более взвешенно к выбору отеля, типу питания и курорта, но и существенно сэкономить!
</p>
<p>
	 Обращаем Ваше внимание, что бронирование отдыха в Турцию из Минска можно осуществить, заполнив&nbsp;простую <a href="http://www.otpusk.by/tury/zayavka-na-tur/">форму</a>&nbsp;и дождаться звонка специалиста.
</p>
<p>
 <span style="font-size: 20pt;"> </span>
</p>
 <span style="font-size: 20pt;"> </span><?$APPLICATION->IncludeComponent(
	"travelsoft:catalog.section",
	"seo.tours.list",
	Array(
		"ACTION_VARIABLE" => "action",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_PROPERTY_101" => "90897",
		"ADD_PROPERTY_102" => "-",
		"ADD_PROPERTY_110" => "N",
		"ADD_PROPERTY_182" => "-",
		"ADD_PROPERTY_464" => "N",
		"ADD_PROPERTY_95" => "67",
		"ADD_PROPERTY_96" => "-",
		"ADD_PROPERTY_97_max" => "",
		"ADD_PROPERTY_97_min" => "",
		"ADD_PROPERTY_ID" => array(),
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BACKGROUND_IMAGE" => "-",
		"BASKET_URL" => "/personal/basket.php",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_NAME" => "arrFilter",
		"IBLOCK_ID" => "18",
		"IBLOCK_TYPE" => "otpusk",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LINE_ELEMENT_COUNT" => "3",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"OFFERS_LIMIT" => "5",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "30",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array("DURATION","DURATION_TIME","NMAN","PRICE","PRICE_CHILD","MT_ID","MT_KEY","DURATION_DAYS","BYR_PRICE"),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array("COUNTRY","POINT_DEPARTURE","TOWN","DEPARTURE","FOOD","DAYS","PROVIDER","TOURTYPE","TRANSPORT","TYPE_EXCURSIONS","THEME_TOURS","SIGHTS","EXCURSIONS","HOTEL","CURRENCY","TOUR_TYPE","NEW","FREE","SHOW_ON_MAIN","TYPE_PERMIT","PRICE_FOR","NDAYS"),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PROPERTY_CODE" => array("COUNTRY","POINT_DEPARTURE","TOWN","ROUTE","DEPARTURE","DEPARTURE_TEXT","FOOD","DAYS","PROVIDER","DEPARTURE_EXC_TEXT","DURATION","DURATION_TIME","TOURTYPE","TRANSPORT","TYPE_EXCURSIONS","THEME_TOURS","NMAN","SIGHTS","EXCURSIONS","HOTEL","PRICE","PRICE_CHILD","CURRENCY","DISCOUNT","HD_DESC","ADDITIONAL","TOUR_TYPE","NEW","FREE","MT_ID","PRICE_INCLUDE","PRICE_NO_INCLUDE","DOCUMENT","MT_KEY","DURATION_DAYS","MEDICINE","SHOW_ON_MAIN","TYPE_PERMIT","PRICE_FOR","NDAYS","BYR_PRICE",""),
		"SECTION_CODE" => "",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array("",""),
		"SEF_MODE" => "N",
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "Y",
		"SHOW_PRICE_COUNT" => "1",
		"TEMPLATE_THEME" => "blue",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N"
	)
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>