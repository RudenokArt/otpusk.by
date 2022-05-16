<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Экскурсии в Гомель, описание, цены на туры");
$APPLICATION->SetTitle("Экскурсии в Гомель");
?><p>
	 Компания «Центркурорт» приглашает любителей путешествий посетить город Гомель – один из древнейших городов Беларуси, изучить его историю, архитектуру и культурные памятники!
</p>
<h4>Перечень экскурсий в Гомель от Центркурорт:</h4>
 <?$APPLICATION->IncludeComponent(
	"travelsoft:catalog.section",
	"seo.tours.list",
	Array(
		"ACTION_VARIABLE" => "action",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_PROPERTY_101" => "514",
		"ADD_PROPERTY_102" => "-",
		"ADD_PROPERTY_110" => "N",
		"ADD_PROPERTY_182" => "-",
		"ADD_PROPERTY_95" => "69",
		"ADD_PROPERTY_96" => "61385",
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
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"PROPERTY_CODE" => array(0=>"COUNTRY",1=>"POINT_DEPARTURE",2=>"TOWN",3=>"ROUTE",4=>"DEPARTURE",5=>"DEPARTURE_TEXT",6=>"FOOD",7=>"DAYS",8=>"PROVIDER",9=>"DEPARTURE_EXC_TEXT",10=>"DURATION",11=>"DURATION_TIME",12=>"TOURTYPE",13=>"TRANSPORT",14=>"TYPE_EXCURSIONS",15=>"THEME_TOURS",16=>"NMAN",17=>"SIGHTS",18=>"EXCURSIONS",19=>"HOTEL",20=>"PRICE",21=>"PRICE_CHILD",22=>"CURRENCY",23=>"DISCOUNT",24=>"HD_DESC",25=>"ADDITIONAL",26=>"TOUR_TYPE",27=>"NEW",28=>"FREE",29=>"MT_ID",30=>"PRICE_INCLUDE",31=>"PRICE_NO_INCLUDE",32=>"DOCUMENT",33=>"MT_KEY",34=>"DURATION_DAYS",35=>"MEDICINE",36=>"SHOW_ON_MAIN",37=>"TYPE_PERMIT",38=>"PRICE_FOR",39=>"NDAYS",40=>"BYR_PRICE",41=>"",),
		"SECTION_CODE" => "",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
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
		"SHOW_ALL_WO_SECTION" => "Y",
		"SHOW_PRICE_COUNT" => "1",
		"TEMPLATE_THEME" => "blue",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N"
	)
);?>
<h2 style="text-align: justify;">Экскурсии в Гомель – на родину радимичей</h2>
<p style="text-align: justify;">
</p>
<p style="text-align: justify;">
	 Экскурсии в Гомель – это посещение города, история которого началась еще в начале первого тысячелетия нашей эры на землях, которые считаются родиной славянского племени радимичей. Упоминание о городе появляется в древнерусских летописях от 1142 года (Ипатьевская летопись) – во времена борьбы за черниговский и киевский княжеский престол. Уже в Х веке у излучины Случи вырос большой славянский город, богатый рудным, железоделательным и ювелирным ремеслом, купеческой торговлей по Днепру между Киевом, Черниговом и Смоленском. Неудивительно, что Гомель богат историческими памятниками и уникальной архитектурой.
</p>
<p style="text-align: justify;">
</p>
<p style="text-align: justify;">
	 Сегодня экскурсии в Гомель – это также посещение почти сотни исторических достопримечательностей города, среди которых особое внимание обычно привлекает дворцово-парковый ансамбль Румянцевых-Паскевичей (список всемирного наследия ЮНЕСКО), знаменитый кафедральный собор Святых Петра и Павла в стиле классицизма, посещение парков и выставочных комплексов, Зимнего сада, краеведческого музея, санаториев Гомельской области и достопримечательностей Северного Полесья.
</p>
<p style="text-align: justify;">
</p>
<p style="text-align: justify;">
	 В рамках экскурсий в Гомеле, вам также предложат автобусно-пешеходные путешествия по древним достопримечательностям города, катание на городском речном трамвае по Сожу, поездку в город Ветку – бывший центр раскольничьей культуры края, посещение старых и действующих монастырей Гомеля и Мозыря.
</p>
<p style="text-align: justify;">
</p>
<p style="text-align: justify;">
	 Экскурсии по Гомелю от компании «Центркурорт» - это увлекательное путешествие продолжительностью в несколько дней, в рамках которого вы получите возможность познакомиться с культурой, архитектурой и природой Полесья, с которыми вам раньше не доводилось встречаться!
</p>
<p style="text-align: justify;">
</p>
<p style="text-align: justify;">
	 Мы предлагаем предварительный заказ экскурсий в Гомель для туристических групп. Доставку туристов в Гомель из Минска компания полностью берет на себя, мы также предоставляем группам опытных экскурсоводов и обеспечиваем доступ в ведомственные учреждения Гомеля, куда свободный доступ не осуществляется.
</p><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>