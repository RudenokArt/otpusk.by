<?
define("NOT_CENTERED", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddHeadString('<meta name="google-site-verification" content="tynr4LySjAeWcqX5fNI86VbUkSvTGC9vQ6aK4Q7ue6Y" />');
$APPLICATION->AddHeadString('<meta name="yandex-verification" content="5dfb2804e34d108e" />');
$APPLICATION->AddHeadString('<meta name="yandex" content="noyaca"/>');
$APPLICATION->SetPageProperty("keywords", "центркурорт, туроператор, официальный сайт туроператора");
$APPLICATION->SetPageProperty("description", "Сегодня, государственный туроператор «ЦЕНТРКУРОРТ» предлагает разнообразный отдых по многим направлениям и, для удобства наших клиентов - сопутствующие услуги (оформление виз, авиа и ж/д билеты, страхование и трансфер). Все это позволяет организовать отпуск максимально быстро и в одном месте.");
$APPLICATION->SetPageProperty("title", "«ЦЕНТРКУРОРТ» - сайт официального туроператора");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
$APPLICATION->SetTitle("ЦЕНТРКУРОРТ");
?><?
//unset($GLOBALS["tours"]["!PROPERTY_TOURTYPE"]);
//unset($GLOBALS["tours"][">=PROPERTY_DEPARTURE"]);
?> <?/*$GLOBALS["tours"] = array("!PROPERTY_SHOW_ON_MAIN" => false, ">=PROPERTY_DEPARTURE" => date('Y-m-d'))?>&nbsp;<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"special_offers_new",
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
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array("NAME","PREVIEW_PICTURE",""),
		"FILTER_NAME" => "tours",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "18",
		"IBLOCK_TYPE" => "otpusk",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"INC_ISOTOPE" => "N",
		"MARKER_AJAX" => "tours",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "8",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array("ROUTE","DEPARTURE","DEPARTURE_TEXT","DAYS","DEPARTURE_EXC_TEXT","DURATION","DURATION_TIME","NMAN","PRICE","PRICE_CHILD","DISCOUNT","ADDITIONAL","TOUR_TYPE","NEW","MT_ID","PRICE_INCLUDE","PRICE_NO_INCLUDE","DOCUMENT","MEDICINE","SHOW_ON_MAIN","PRICE_FOR","NDAYS","BYR_PRICE","COUNTRY","CURRENCY","TOWN","TOURTYPE",""),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "ID",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "ASC",
		"SO_TITLE" => "Специальные предложения",
		"STRICT_SECTION_CHECK" => "N"
	)
);*/?> <?
unset($GLOBALS["tours"]["!PROPERTY_TOURTYPE"]);
unset($GLOBALS["tours"][">=PROPERTY_DEPARTURE"]);
?> <? $GLOBALS["tours"]["PROPERTY_TOURTYPE"] = 484; ?> <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"special_offers",
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
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array("NAME","PREVIEW_PICTURE",""),
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
		"PROPERTY_CODE" => array("DEPARTURE","DEPARTURE_TEXT","DAYS","PRICE","DISCOUNT","ADDITIONAL","TOUR_TYPE","NEW","FREE","MT_ID","PRICE_INCLUDE","PRICE_NO_INCLUDE","DOCUMENT","MEDICINE","SHOW_ON_MAIN","PRICE_FOR","NDAYS","COUNTRY","CURRENCY",""),
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
		"SO_TITLE" => "Санатории и гостиницы",
		"STRICT_SECTION_CHECK" => "N"
	),
false,
Array(
	'ACTIVE_COMPONENT' => 'N'
)
);?> <?/* <section> 
<div class="container">
	<div class="row">
		<div class="section-title">
			<h3>Горящие туры</h3>
			<div class="sorting-middle-holder mt-25">
				<ul class="sort-by">
					<li><a href="/tury/goryashchie-tury/" class="btn_blue_p5">Все предложения</a></li>
				</ul>
			</div>
		</div>
		 <script type="text/javascript" src="//ui.sletat.ru/module-4.0/core.js" charset="utf-8"></script> <script type="text/javascript">sletat.FrameHot.$create({
  resorts           : [35, 426, 454, 867, 1003, 1125, 1182, 1301, 1305, 1349, 1351],
  city              : 1311,
  country           : [19, 40, 119, 117, 19, 50, 127, 58],
  toursCount        : 12,
  tourAgentCountry  : "belarus",
  useCard           : false,
  enabledCurrencies : ["BYN"],
  currency          : "BYN",
  customStyles      : ".browser-webkit form {display: none;}"
});</script> <span class="sletat-copyright">Идет загрузка модуля <a href="http://sletat.ru/" title="поиск туров" target="_blank">поиска туров</a> …</span>
	</div>
</div>
<section> */?> <?/*$GLOBALS["pd"] = array("!PROPERTY_POPULAR_DESTINATION" => false)?>&nbsp;<?$APPLICATION->IncludeComponent(
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
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array("NAME","PREVIEW_TEXT","PREVIEW_PICTURE",""),
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
		"PROPERTY_CODE" => array("",""),
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
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N"
	)
);*/?> <?$GLOBALS["action_filter"] = array("!PROPERTY_POPULAR_DESTINATION" => false)?>&nbsp;<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"special_offers_index",
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
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array("NAME","PREVIEW_TEXT","PREVIEW_PICTURE",""),
		"FILTER_NAME" => "action_filter",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "17",
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
		"PROPERTY_CODE" => array("COUNTRY","HOTEL"),
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
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N"
	)
);?>
<div class="container">
	<div class="row">
		<div class="col-sm-8 col-md-12">
			<h1>Отдых в Беларуси и за рубежом от туроператора ЦЕНТРКУРОРТ<br>
 </h1>
		</div>
		<div style="float: left;" class="GridLex-gap-30">
			<p style="text-align: justify;">
				 Сегодня, <b>государственный туроператор «ЦЕНТРКУРОРТ»</b> предлагает разнообразный отдых по многим направлениям и, для удобства наших клиентов - сопутствующие услуги (оформление виз, авиа и ж/д билеты, страхование и трансфер). Все это позволяет организовать отпуск максимально быстро и в одном месте.
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
 <b>Государственный туроператор «ЦЕНТРКУРОРТ»</b> сопровождает как индивидуальные туры, так и отдых для организованных групп, предлагает программы для корпоративного отдыха. А также доступные цены на отдых в Беларуси с детьми! Сотрудники нашей компании сделают Ваш отдых комфортным и увлекательным!
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
 <a href="/sanatorii/sanatoriy-belaya-rus/"></a>
			<ul style="text-align: justify;">
				<li><a href="/sanatorii/sanatoriy-belaya-rus/">санаторий «Белая Русь»</a> 450 м. от моря (собственный пляж), недалеко от Туапсе;</li>
				<li><a href="/sanatorii/sanatoriy-belarus/">санаторий «Беларусь»</a> в 150-300 м. от моря (собственный пляж), Сочи;</li>
				<li>Знаменитый <a href="/sanatorii/belarus/">комплекс отдыха «Беларусь»</a> на уникальном горнолыжном курорте Красная Поляна вблизи от Сочи.</li>
			</ul>
			 Отдых в Сочи актуален и интересен, так как здесь проходит всем известный международный музыкальный конкурс «Новая волна», собирающий тысячи туристов и сопровождающийся незабываемым шоу. «ЦЕНТРКУРОРТ» предлагает множество объектов для размещения и возможность приобрести авиабилеты до г. Сочи по приятным тарифам. <a href="https://www.otpusk.by/turistam/novosti/vsenarodnoe-obsuzhdenie-proekta-izmeneniy-i-dopolneniy-konstitutsii-respubliki-belarus/"></a>
		</div>
	</div>
</div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>