<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("canonical", "https://www.otpusk.by/tury/");
$APPLICATION->SetPageProperty("title", "Онлайн поиск, подбор и бронирование туров. Купить тур в Минске");
$APPLICATION->SetPageProperty("keywords", "купить тур в минске");
$APPLICATION->SetPageProperty("description", "Чтобы купить тур в Минске, достаточно открыть страницу с приглянувшимся вариантом и оставить свою заявку");
$APPLICATION->SetTitle("Туры в Турцию");
?><?if(isset($GLOBALS["arrFilter"]) && !empty($GLOBALS["arrFilter"])){
    $GLOBALS["arrFilter"] = array_merge($GLOBALS["arrFilter"],array("!PROPERTY_TYPE_EXCURSIONS" => "673", "!PROPERTY_COUNTRY" => "69", "!PROPERTY_OFFER_IN_PROCESS" => "178"));
	$GLOBALS["arrFilter"]["PROPERTY_COUNTRY"] = 67;
} else {
    $GLOBALS["arrFilter"] = array("!PROPERTY_TYPE_EXCURSIONS" => "673", "!PROPERTY_COUNTRY" => "69", "!PROPERTY_OFFER_IN_PROCESS" => "178");
	$GLOBALS["arrFilter"]["PROPERTY_COUNTRY"] = 67;
}
/*$GLOBALS["arrFilter"] = array("!PROPERTY_TYPE_EXCURSIONS" => "673", "!PROPERTY_COUNTRY" => "69");*/?> <?$APPLICATION->IncludeComponent(
	"travelsoft:catalog.section",
	"tours-list",
	Array(
		"ACTION_VARIABLE" => "",
		"ADD_PICT_PROP" => "-",
		"ADD_PROPERTIES_TO_BASKET" => "N",
		"ADD_PROPERTY_101" => "483",
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
		"AJAX_OPTION_STYLE" => "N",
		"BACKGROUND_IMAGE" => "-",
		"BASKET_URL" => "",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "N",
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
		"PRODUCT_PROPERTIES" => array(""),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"PROPERTY_CODE" => array("COUNTRY","POINT_DEPARTURE","TOWN","DEPARTURE","DEPARTURE_TEXT","FOOD","DAYS","TOURTYPE","TRANSPORT","TYPE_EXCURSIONS","HOTEL","PRICE","CURRENCY","DISCOUNT","ADDITIONAL","TOUR_TYPE","NEW","FREE","MT_ID","PRICE_INCLUDE","PRICE_NO_INCLUDE","DOCUMENT","MT_KEY","MEDICINE","PRICE_FOR","NDAYS","DAILY","ACCOMODATIONS","FILE","TOUR_IN_ARCHIVE",""),
		"SECTION_CODE" => "",
		"SECTION_ID" => "",
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
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N"
	)
);?><br>
 <br>
<p>
	 Хотите отправиться на отдых в 2020 году? На официальном сайте компании «ЦЕНТРКУРОРТ» Вы найдете актуальные предложения о путешествиях в различных направлениях. Мы осуществляем реализацию туров в самые разные курортные и исторически привлекательные уголки планеты, а значит, Вы сможете выбрать подходящее место для отдыха, отталкиваясь от своих предпочтений и предполагаемого бюджета.
</p>
<h2>
Куда поехать? </h2>
<p>
	 В данном разделе сайта Вы можете осуществить онлайн-бронирование туров следующих категорий:
</p>
<p>
</p>
<ul style="list-style-type: circle">
	<li>Пляжный;</li>
	<li>Горнолыжный;</li>
	<li>Экскурсионный;</li>
	<li>Оздоровительный.</li>
</ul>
<p>
</p>
<p>
	 А искателям нетривиальных приключений и влюбленным парам мы можем предложить туры, подразумевающие посещение различных тематических мероприятий и фестивалей в разных странах.
</p>
<p>
	 В нашем ассортименте имеются путевки более чем в 25 стран, среди которых как государства, состоящие в безвизовых отношениях с Беларусью, так и направления, требующие оформления визы.
</p>
<p>
	 Среди самых популярных направлений:
</p>
<p>
</p>
<ul style="list-style-type: circle">
	<li><a href="/strany/albaniya/tury/">Албания</a>;</li>
	<li><a href="/strany/bolgariya/tury-v-bolgariyu/">Болгария</a>;</li>
	<li><a href="/strany/chekhiya/tury-v-chekhiyu/">Чехия</a>;</li>
	<li><a href="/strany/chernogoriya/tury-v-chernogoriyu/">Черногория</a>;</li>
	<li><a href="/strany/gretsiya/tury-v-gretsiyu/">Греция</a>;</li>
	<li><a href="/strany/ispaniya/tury-v-ispaniyu/">Испания</a>;</li>
	<li><a href="/strany/italiya/tury-v-italiyu/">Италия</a>;</li>
	<li><a href="/strany/kipr/tury-na-kipr/">Кипр</a>;</li>
	<li><a href="/strany/turtsiya/tury-v-turtsiyu/">Турция</a> и многое другое.</li>
</ul>
<p>
</p>
<h2>
Как выбрать? </h2>
<p>
	 Для Вашего удобства мы предусмотрели функциональную систему сортировки предложений по множеству критериев. Ускорьте свой поиск туров онлайн, задав интересующие Вас параметры: например, ценовой диапазон, продолжительность, дату начала и окончания отпуска, тип тура, тип транспорта и желаемую страну.
</p>
<h2>
Как забронировать? </h2>
<p>
	 Чтобы купить тур в Минске, достаточно открыть страницу с приглянувшимся вариантом и оставить свою заявку. Для этого необходимо заполнить простую онлайн-форму: указать контактные данные и ожидать звонка нашего менеджера.
</p>
<p>
	 Если же Вам требуется дополнительная информация, мы непременно Вас проконсультируем по всем интересующим вопросам – от общих особенностей тура до мельчайших нюансов пребывания в конкретной стране.
</p>
<h2>
Преимущества сотрудничества с «ЦЕНТРКУРОРТ» </h2>
<p>
	 Наша компания является одним из ведущих туроператоров в РБ и пользуется доверием у белорусских путешественников. Мы предлагаем клиентам:
</p>
<p>
</p>
<ul style="list-style-type: circle">
	<li>Выгодные цены и регулярные акции;</li>
	<li>Помощь квалифицированных специалистов;</li>
	<li>Широкий ассортимент путевок;</li>
	<li>Быстрый онлайн-подбор тура из Минска;</li>
	<li>Возможность раннего бронирования и регулярное появление горящих путевок.</li>
</ul>
<p>
</p><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>