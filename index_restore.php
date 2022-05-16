<?
define("NOT_CENTERED", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords", "отдых в беларуси, отдохнуть в беларуси");
$APPLICATION->SetPageProperty("description", "Государственный туристический оператор «ЦЕНТРКУРОРТ» предлагает различные варианты семейного отдыха в Беларуси в 2018 и за рубежом");
$APPLICATION->SetPageProperty("title", "Отдых в Беларуси 2018. Отдохнуть в Беларуси недорого");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
$APPLICATION->SetTitle("Отдых в Беларуси");
?>
<?$APPLICATION->AddHeadString('<meta name="yandex-verification" content="6f17706c0b1d084e" />',true)?>

<?
//unset($GLOBALS["tours"]["!PROPERTY_TOURTYPE"]);
//unset($GLOBALS["tours"][">=PROPERTY_DEPARTURE"]);
?> <?$GLOBALS["tours"] = array("!PROPERTY_SHOW_ON_MAIN" => false, "!PROPERTY_TOURTYPE" => 484, ">=PROPERTY_DEPARTURE" => date('Y-m-d'))?>&nbsp;<?$APPLICATION->IncludeComponent("bitrix:news.list", "special_offers_new", Array(
	"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
		"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"AJAX_MODE" => "N",	// Включить режим AJAX
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "N",	// Включить подгрузку стилей
		"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_TYPE" => "N",	// Тип кеширования
		"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
		"COMPONENT_TEMPLATE" => "special_offers",
		"DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
		"DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
		"FIELD_CODE" => array(	// Поля
			0 => "NAME",
			1 => "PREVIEW_PICTURE",
			2 => "",
		),
		"FILTER_NAME" => "tours",	// Фильтр
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
		"IBLOCK_ID" => "18",	// Код информационного блока
		"IBLOCK_TYPE" => "otpusk",	// Тип информационного блока (используется только для проверки)
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
		"INCLUDE_SUBSECTIONS" => "N",	// Показывать элементы подразделов раздела
		"INC_ISOTOPE" => "N",	// Подключать isotope.js
		"MARKER_AJAX" => "tours",	// Объект для запроса ajax
		"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
		"NEWS_COUNT" => "8",	// Количество новостей на странице
		"PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
		"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
		"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
		"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
		"PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
		"PAGER_TITLE" => "",	// Название категорий
		"PARENT_SECTION" => "",	// ID раздела
		"PARENT_SECTION_CODE" => "",	// Код раздела
		"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
		"PROPERTY_CODE" => array(	// Свойства
			0 => "ROUTE",
			1 => "DEPARTURE",
			2 => "DEPARTURE_TEXT",
			3 => "DAYS",
			4 => "DEPARTURE_EXC_TEXT",
			5 => "DURATION",
			6 => "DURATION_TIME",
			7 => "NMAN",
			8 => "PRICE",
			9 => "PRICE_CHILD",
			10 => "DISCOUNT",
			11 => "ADDITIONAL",
			12 => "TOUR_TYPE",
			13 => "NEW",
			14 => "MT_ID",
			15 => "PRICE_INCLUDE",
			16 => "PRICE_NO_INCLUDE",
			17 => "MEDICINE",
			18 => "DOCUMENT",
			19 => "SHOW_ON_MAIN",
			20 => "PRICE_FOR",
			21 => "NDAYS",
			22 => "BYR_PRICE",
			23 => "COUNTRY",
			24 => "CURRENCY",
			25 => "TOWN",
			26 => "TOURTYPE",
		),
		"SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
		"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
		"SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
		"SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
		"SET_STATUS_404" => "N",	// Устанавливать статус 404
		"SET_TITLE" => "N",	// Устанавливать заголовок страницы
		"SHOW_404" => "N",	// Показ специальной страницы
		"SORT_BY1" => "SORT",	// Поле для первой сортировки новостей
		"SORT_BY2" => "ID",	// Поле для второй сортировки новостей
		"SORT_ORDER1" => "ASC",	// Направление для первой сортировки новостей
		"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
		"SO_TITLE" => "Специальные предложения",	// Заголовок блока
	),
	false
);?> <?
unset($GLOBALS["tours"]["!PROPERTY_TOURTYPE"]);
unset($GLOBALS["tours"][">=PROPERTY_DEPARTURE"]);
?> <? $GLOBALS["tours"]["PROPERTY_TOURTYPE"] = 484; ?> <?$APPLICATION->IncludeComponent("bitrix:news.list", "special_offers", array(
	"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "N",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "special_offers",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_PICTURE",
			2 => "",
		),
		"FILTER_NAME" => "tours",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "18",
		"IBLOCK_TYPE" => "otpusk",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"INC_ISOTOPE" => "N",
		"MARKER_AJAX" => "hotels",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "8",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "DEPARTURE",
			1 => "DEPARTURE_TEXT",
			2 => "DAYS",
			3 => "PRICE",
			4 => "DISCOUNT",
			5 => "ADDITIONAL",
			6 => "TOUR_TYPE",
			7 => "NEW",
			8 => "FREE",
			9 => "MT_ID",
			10 => "PRICE_INCLUDE",
			11 => "PRICE_NO_INCLUDE",
			12 => "MEDICINE",
			13 => "DOCUMENT",
			14 => "SHOW_ON_MAIN",
			15 => "PRICE_FOR",
			16 => "NDAYS",
			17 => "COUNTRY",
			18 => "CURRENCY",
			19 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "RAND",
		"SORT_BY2" => "ID",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"SO_TITLE" => "Санатории и гостиницы"
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "N"
	)
);?> <?$GLOBALS["pd"] = array("!PROPERTY_POPULAR_DESTINATION" => false)?>&nbsp;<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"popular_destinations",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "N",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "popular_destinations",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(0=>"NAME",1=>"PREVIEW_TEXT",2=>"PREVIEW_PICTURE",3=>"",),
		"FILTER_NAME" => "pd",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "12",
		"IBLOCK_TYPE" => "otpusk",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "6",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(0=>"",1=>"",),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC"
	)
);?> <section class="bg-light"> <section>
<div class="container">
	<div class="row">
		<div class="col-sm-8 col-md-12">
			<h1>Отдых в Беларуси и за рубежом от ЦЕНТРКУРОРТ<br>
 </h1>
		</div>
		<div style="float: left;" class="GridLex-gap-30">
			<p style="text-align: justify;">
				 Сегодня, государственный туристический оператор «ЦЕНТРКУРОРТ» предлагает разнообразный отдых по многим направлениям и, для удобства наших клиентов - сопутствующие услуги (оформление виз, авиа и ж/д билеты, страхование и трансфер). Все это позволяет организовать отпуск максимально быстро и в одном месте.
			</p>
			<p>
			</p>
			<p style="text-align: justify;">
 <b>Для оздоровления и отдыха</b> – более 50 санаториев в Беларуси и за рубежом. Заслуженное признание получила многолетняя работа санаториев – «Боровое», «Приозерный», «Сосны», «Юность» Управления делами Президента. Востребованы наши санатории в Друскининкай и Юрмале. Здесь удивительным образом сочетаются природные богатства и высококлассный сервис. Приятный климат, минеральные воды, лечебные грязи, современная медицинская аппаратура, профессиональный подход, высокая квалификация врачей и обслуживающего персонала поможет Вам укрепить свое здоровье и насладиться отдыхом.
			</p>
			<p>
			</p>
			<p>
			</p>
			<p style="text-align: justify;">
				 Беларусь – природная и историческая жемчужина центра Европы. Первозданная природа, комфортное проживание и сбалансированное питание, организованное на территории гостиниц, баз отдыха и в туристических комплексах, рыбалка и охота, развлекательные мероприятия – все это создает отличные условия для семейного отдыха в Беларуси с детьми и активного туризма. Горнолыжный центр "Силичи", составляет конкуренцию для европейских объектов зимнего отдыха. В целях экономии Вашего времени и средств мы также предлагаем услугу по раннему бронированию.
			</p>
			<p>
			</p>
			<p style="text-align: justify;">
 <b>Компания «ЦЕНТРКУРОРТ»</b> сопровождает как индивидуальные туры, так и отдых для организованных групп, предлагает программы для корпоративного отдыха. А также доступные цены на отдых в Беларуси с детьми! Сотрудники нашей компании сделают Ваш отдых комфортным и увлекательным!
			</p>
			<p>
			</p>
			<p>
			</p>
		</div>
		<div class="col-sm-8 col-md-12">
			<div class="section-title">
				<h3>Отдых на Черном море: туры в Сочи и Туапсе!</h3>
			</div>
		</div>
		<div style="float: left;" class="GridLex-gap-30 static-wrapper">
			<p style="text-align: justify;">
				 Ежегодно неизменным спросом пользуется отдых, предлагаемый компанией «ЦЕНТРКУРОРТ», на Черноморском побережье Краснодарского края России. Выбор есть на любой вкус: для тех, кто предпочитает поближе к морю и за городом – Туапсе, для любителей городской атмосферы – отдых в Сочи, курортной столице России, для поклонников экстрима – горнолыжный курорт Красная Поляна рядом с Сочи.
			</p>
			<p>
				 Мы выбрали для Вашего отдыха самые лучшие туристические объекты данного региона:
			</p>
			<ul style="text-align: justify;">
				<li><a href="/sanatorii/sanatoriy-belaya-rus/">санаторий «Белая Русь»</a> 450 м. от моря (собственный пляж), недалеко от Туапсе;</li>
				<li><a href="/sanatorii/sanatoriy-belarus/">санаторий «Беларусь»</a> в 150-300 м. от моря (собственный пляж), Сочи;</li>
				<li>Знаменитый <a href="/sanatorii/belarus/">комплекс отдыха «Беларусь»</a> на уникальном горнолыжном курорте Красная Поляна вблизи от Сочи.</li>
				<p style="text-align: justify;">
					 Отдых в Сочи актуален и интересен, так как здесь проходит всем известный международный музыкальный конкурс «Новая волна», собирающий тысячи туристов и сопровождающийся незабываемым шоу. «ЦЕНТРКУРОРТ» предлагает множество объектов для размещения и возможность приобрести авиабилеты до г. Сочи по приятным тарифам.
				</p>
			</ul>
		</div>
	</div>
</div>
 </section> </section><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>