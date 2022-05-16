<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");
?><span yle="">

<script type="text/javascript" src="//tourvisor.ru/module/init.js"></script> <style>
.TVWideForm.TVTheme2 {
    width: 100% !important;
}
</style>

<!-- Код с Tourvisor -->
<div class="tv-search-form tv-moduleid-200669">
</div>
<div class="clear">
</div>
 <?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("canonical", "https://www.otpusk.by/tury/");
$APPLICATION->SetPageProperty("title", "Онлайн поиск, подбор и бронирование туров. Купить тур в Минске");
$APPLICATION->SetPageProperty("keywords", "купить тур в минске");
$APPLICATION->SetPageProperty("description", "Чтобы купить тур в Минске, достаточно открыть страницу с приглянувшимся вариантом и оставить свою заявку");
$APPLICATION->SetTitle("Туры в Грузию");
?><?if(isset($GLOBALS["arrFilter"]) && !empty($GLOBALS["arrFilter"])){
    $GLOBALS["arrFilter"] = array_merge($GLOBALS["arrFilter"],array("!PROPERTY_TYPE_EXCURSIONS" => "673", "!PROPERTY_COUNTRY" => "69", "!PROPERTY_OFFER_IN_PROCESS" => "178"));
	$GLOBALS["arrFilter"]["PROPERTY_COUNTRY"] = 151;
} else {
    $GLOBALS["arrFilter"] = array("!PROPERTY_TYPE_EXCURSIONS" => "673", "!PROPERTY_COUNTRY" => "69", "!PROPERTY_OFFER_IN_PROCESS" => "178");
	$GLOBALS["arrFilter"]["PROPERTY_COUNTRY"] = 151;
}
/*$GLOBALS["arrFilter"] = array("!PROPERTY_TYPE_EXCURSIONS" => "673", "!PROPERTY_COUNTRY" => "69");*/?> <?$APPLICATION->IncludeComponent(
	"travelsoft:catalog.section",
	"tours-list",
	array(
	"ACTION_VARIABLE" => "",	// Название переменной, в которой передается действие
		"ADD_PICT_PROP" => "-",
		"ADD_PROPERTIES_TO_BASKET" => "N",	// Добавлять в корзину свойства товаров и предложений
		"ADD_PROPERTY_101" => "483",
		"ADD_PROPERTY_102" => "-",
		"ADD_PROPERTY_110" => "N",
		"ADD_PROPERTY_182" => "-",
		"ADD_PROPERTY_95" => "-",
		"ADD_PROPERTY_96" => "-",
		"ADD_PROPERTY_97_max" => "",
		"ADD_PROPERTY_97_min" => "",
		"ADD_PROPERTY_ID" => "",
		"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"AJAX_MODE" => "N",	// Включить режим AJAX
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "N",	// Включить подгрузку стилей
		"BACKGROUND_IMAGE" => "-",	// Установить фоновую картинку для шаблона из свойства
		"BASKET_URL" => "",	// URL, ведущий на страницу с корзиной покупателя
		"BROWSER_TITLE" => "-",	// Установить заголовок окна браузера из свойства
		"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_TYPE" => "N",	// Тип кеширования
		"DETAIL_URL" => "#SITE_DIR#/aktsii/albaniya/#ELEMENT_CODE#/?s_country=71",	// URL, ведущий на страницу с содержимым элемента раздела
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",	// Не подключать js-библиотеки в компоненте
		"DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
		"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
		"ELEMENT_SORT_FIELD" => "SORT",	// По какому полю сортируем элементы
		"ELEMENT_SORT_FIELD2" => "timestamp_x",	// Поле для второй сортировки элементов
		"ELEMENT_SORT_ORDER" => "ASC",	// Порядок сортировки элементов
		"ELEMENT_SORT_ORDER2" => "desc",	// Порядок второй сортировки элементов
		"FILTER_NAME" => "arrFilter",	// Имя массива со значениями фильтра для фильтрации элементов
		"IBLOCK_ID" => "18",	// Инфоблок
		"IBLOCK_TYPE" => "otpusk",	// Тип инфоблока
		"INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
		"LABEL_PROP" => "-",
		"LINE_ELEMENT_COUNT" => "",	// Количество элементов выводимых в одной строке таблицы
		"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
		"MESS_BTN_ADD_TO_BASKET" => "",
		"MESS_BTN_BUY" => "",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_SUBSCRIBE" => "",
		"MESS_NOT_AVAILABLE" => "",
		"META_DESCRIPTION" => "-",	// Установить описание страницы из свойства
		"META_KEYWORDS" => "-",	// Установить ключевые слова страницы из свойства
		"OFFERS_LIMIT" => "0",	// Максимальное количество предложений для показа (0 - все)
		"PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
		"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
		"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
		"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
		"PAGER_TEMPLATE" => "modern",	// Шаблон постраничной навигации
		"PAGER_TITLE" => "",	// Название категорий
		"PAGE_ELEMENT_COUNT" => "10",	// Количество элементов на странице
		"PARTIAL_PRODUCT_PROPERTIES" => "N",	// Разрешить добавлять в корзину товары, у которых заполнены не все характеристики
		"PRICE_CODE" => "",	// Тип цены
		"PRICE_VAT_INCLUDE" => "N",	// Включать НДС в цену
		"PRODUCT_ID_VARIABLE" => "",	// Название переменной, в которой передается код товара для покупки
		"PRODUCT_PROPERTIES" => "",	// Характеристики товара
		"PRODUCT_PROPS_VARIABLE" => "prop",	// Название переменной, в которой передаются характеристики товара
		"PRODUCT_QUANTITY_VARIABLE" => "",	// Название переменной, в которой передается количество товара
		"PROPERTY_CODE" => array(	// Свойства
			0 => "COUNTRY",
			1 => "POINT_DEPARTURE",
			2 => "TOWN",
			3 => "DEPARTURE",
			4 => "DEPARTURE_TEXT",
			5 => "FOOD",
			6 => "DAYS",
			7 => "TOURTYPE",
			8 => "TRANSPORT",
			9 => "TYPE_EXCURSIONS",
			10 => "HOTEL",
			11 => "PRICE",
			12 => "CURRENCY",
			13 => "DISCOUNT",
			14 => "ADDITIONAL",
			15 => "TOUR_TYPE",
			16 => "NEW",
			17 => "FREE",
			18 => "MT_ID",
			19 => "PRICE_INCLUDE",
			20 => "PRICE_NO_INCLUDE",
			21 => "DOCUMENT",
			22 => "MT_KEY",
			23 => "MEDICINE",
			24 => "PRICE_FOR",
			25 => "NDAYS",
			26 => "DAILY",
			27 => "ACCOMODATIONS",
			28 => "FILE",
			29 => "TOUR_IN_ARCHIVE",
		),
		"SECTION_CODE" => "",	// Код раздела
		"SECTION_ID" => "",	// ID раздела
		"SECTION_ID_VARIABLE" => "",	// Название переменной, в которой передается код группы
		"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
		"SECTION_USER_FIELDS" => array(	// Свойства раздела
			0 => "",
		),
		"SEF_MODE" => "N",	// Включить поддержку ЧПУ
		"SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
		"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
		"SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
		"SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
		"SET_STATUS_404" => "N",	// Устанавливать статус 404
		"SET_TITLE" => "N",	// Устанавливать заголовок страницы
		"SHOW_404" => "N",	// Показ специальной страницы
		"SHOW_ALL_WO_SECTION" => "Y",	// Показывать все элементы, если не указан раздел
		"SHOW_PRICE_COUNT" => "",	// Выводить цены для количества
		"TEMPLATE_THEME" => "",
		"USE_MAIN_ELEMENT_SECTION" => "N",	// Использовать основной раздел для показа элемента
		"USE_PRICE_COUNT" => "N",	// Использовать вывод цен с диапазонами
		"USE_PRODUCT_QUANTITY" => "N",	// Разрешить указание количества товара
	)
);?><br>
 <br>
<p>
	 Хотите отправиться на отдых в 2021 году? На официальном сайте компании «ЦЕНТРКУРОРТ» Вы найдете актуальные предложения о путешествиях в различных направлениях. Мы осуществляем реализацию туров в самые разные курортные и исторически привлекательные уголки планеты, а значит, Вы сможете выбрать подходящее место для отдыха, отталкиваясь от своих предпочтений и предполагаемого бюджета.
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
<ul style="list-style-type: circle">
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
</p>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?></span><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>