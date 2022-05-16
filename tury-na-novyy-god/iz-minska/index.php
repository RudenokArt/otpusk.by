<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Новогодние туры 2021 из Минска");
$APPLICATION->SetPageProperty("description", "Во время отпуска вы будете жить в комфортном санатории, где есть все необходимое для отдыха детей и взрослых. Новогодние туры из Минска 2019 длятся от 8 до 11 дней. В это время вы будете жить в комфортном доме посреди зимнего леса.");
$APPLICATION->SetTitle("Новогодние туры за рубеж");
?><p>
	 Зимние каникулы – отличное время для путешествий. Встретив новый год за рубежом, вы хорошо отдохнете в семейном санатории и получите новые впечатления от поездки в другую страну. Мы предлагаем встретить новый год 2020 за границей и отправиться в Словакию, Литву, Украину. Путешествие происходит на автобусе, во время поездки вы сможете любоваться красотой зимней природы.
</p>
<p>
	 Во время отпуска вы будете жить в комфортном санатории, где есть все необходимое для отдыха детей и взрослых. Новогодние туры 2020 из Минска длятся от 8 до 11 дней. В это время вы будете жить в комфортном доме посреди зимнего леса. Вас ждет насыщенная программа развлечений и фееричный новогодний банкет с Дед Морозом, Снегурочкой, музыкантами и дискотекой до утра. В большинстве санаториев можно взять напрокат снаряжение для активного отдыха и проводить время с семьей на свежем воздухе.
</p>
<p>
	 В новогодние туры включена стоимость питания, которое будет происходить 3 раза в день. Санатории в городах Трускавец и Друскиникае расположены на минеральных водах. На зимних каникулах вы сможете улучшить свое здоровье, посещая лечебные сеансы в СПА-комплексах или традиционных банях.
</p>
<p>
	 Спешите бронировать новогодний тур 2020, с каждым днем остается меньше свободных мест. Вы можете забронировать тур на сайте или сделать это через менеджера, позвонив по нашему телефону.
</p>
<?$APPLICATION->IncludeComponent(
	"travelsoft:catalog.section",
	"seo.tours.list",
	Array(
		"ACTION_VARIABLE" => "action",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_PROPERTY_101" => "-",
		"ADD_PROPERTY_102" => "-",
		"ADD_PROPERTY_110" => "N",
		"ADD_PROPERTY_182" => "-",
		"ADD_PROPERTY_95" => "-",
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
		"COMPONENT_TEMPLATE" => "seo.tours.list",
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
		"PRICE_CODE" => array(),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array(),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PROPERTY_CODE" => array(0=>"COUNTRY",1=>"POINT_DEPARTURE",2=>"TOWN",3=>"ROUTE",4=>"DEPARTURE",5=>"DEPARTURE_TEXT",6=>"FOOD",7=>"DAYS",8=>"PROVIDER",9=>"DEPARTURE_EXC_TEXT",10=>"DURATION",11=>"DURATION_TIME",12=>"TOURTYPE",13=>"HOLIDAY_SEA",14=>"EARLY_BOOKING",15=>"TRANSPORT",16=>"TYPE_EXCURSIONS",17=>"THEME_TOURS",18=>"NMAN",19=>"SIGHTS",20=>"EXCURSIONS",21=>"HOTEL",22=>"PRICE",23=>"PRICE_CHILD",24=>"CURRENCY",25=>"DISCOUNT",26=>"HD_DESC",27=>"ADDITIONAL",28=>"TOUR_TYPE",29=>"NEW",30=>"FREE",31=>"MT_ID",32=>"PRICE_INCLUDE",33=>"PRICE_NO_INCLUDE",34=>"DOCUMENT",35=>"MT_KEY",36=>"DURATION_DAYS",37=>"MEDICINE",38=>"NIGHT_PLUS",39=>"SHOW_ON_MAIN",40=>"SALE",41=>"TYPE_PERMIT",42=>"PRICE_FOR",43=>"TOUR_IN_ARCHIVE",44=>"NDAYS",45=>"BYR_PRICE",46=>"",),
		"SECTION_CODE" => "",
		"SECTION_ID" => "469",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(0=>"",1=>"",),
		"SEF_MODE" => "N",
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"TEMPLATE_THEME" => "blue",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>