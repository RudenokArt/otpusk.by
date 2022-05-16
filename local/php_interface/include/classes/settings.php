<?
/**
* Дополнительные настройки сайта
*/

class Set
{
	const CORPUSE_IBLOCK_ID				= 63; // иб корпусов
	const HOTELS_IBLOCK_ID 				= 14; // иб отелей
	const EXCURSIONS_IBLOCK_ID 			= 13; // иб экскурсий
	const SIGHTS_IBLOCK_ID 	 			= 35; // иб достопримечательностей
	const SPECIAL_OFF_IBLOCK_ID 		= 18; // иб спец. предложений
	const CITY_IBLOCK_ID 				= 11; // иб городов
	const ORDER_IBLOCK_ID 				= 21; // иб заказа тура
	const ARTICLE_COUNTRY_IBLOCK_ID 	= 53; // иб статей по странам
	const ARTICLE_HOTELS_IBLOCK_ID 		= 54; // иб статей по странам
	const PHONEBOOK_IBLOCK_ID 			= 58; // иб телефонный справочник
	const COUNTRY_IBLOCK_ID 			= 12; // иб страны
	const REVIEWS_IBLOCK_ID 			= 59; // иб отзывы
	const EMPLOYERS_IBLOCK_ID			= 43; // иб сотрудников
	const FOOD_IBLOCK_ID				= 31; // иб питания
	const MEDPROFILE_IBLOCK_ID			= 36; // иб мед. профиль
	const PERMIT_IBLOCK_ID				= 37; // иб типы путёвок
	const CURRENCY_IBLOCK_ID			= 33; // иб валюты
	const COURSE_CURRENCY_IBLOCK_ID		= 23; // иб курс валюты
	const REGIONS_IBLOCK_ID				= 56; // иб областей
	const ROOMS_IBLOCK_ID				= 62; // иб размещений из мастертур
	const ROOM_SERVICES_IBLOCK_ID		= 61; // иб услуг в номере
	const AVIA_IBLOCK_ID		= 49; // иб авиабилеты
	const SEARCHFILTER_IBLOCK_ID		= 65; // иб поиск город-страна
	const TYPETOURS_IBLOCK_ID		= 28; // иб поиск город-страна
	const BUSTOURS_IBLOCK_ID		= 66; // иб поиск город-страна для автобусных туров
	const SHARES_IBLOCK_ID		= 17; // иб акций
	const DEPARTMENT_IBLOCK_ID		= 39; // иб офисов

	const GETDATESFORFILTR = 1; //HB фильтр по жатам МТ

	const HOTELS_SECTION_ID 	= 168; // раздел отелей 
	const SANATORII_SECTION_ID  = 167; // раздел санаториев

	const SANATORII_PROP_ID		= 25;  // id свойства санатория

	const CURRENCY_BYR_ID = 62; // ID белорусской валюты в системе bitrix
	const CURRENCY_BYN_ID = 62740  ; // ID новой белорусской валюты в системе bitrix

	const JS_PATH_FANCTIONS = '/local/php_interface/include/functions.js'; // вспомогательные javascript-функции
	
	const NO_PHOTO = "/bitrix/templates/main/images/nophoto.jpg"; // путь к "картинке-заглушке"

	const SMALL_PRELOADER = "/bitrix/templates/main/images/preloader.gif"; // путь к preloader

	const PAHT_TO_404 = "/404.php"; // путь до 404 стр.

	const MAIL_ORDER_TEMPL_ID = 58;  // ID почтового шаблона для заказа тура с детальной страницы тура
	const MAIL_REVIEWS_TEMPL_ID = 59; // ID почтового шаблона для отзыва с детальной страницы тура

	const MAIL_EVENT_ORDER_TEMPLATE = "ORDER_MAILS"; 	 // тип почтового события для заявки
	const MAIL_EVENT_REVIEWS_TEMPLATE = "REVIEWS_MAILS"; // тип почтового события для отзыва

	static public $element_id_breadcrumb = 0; // содержит ID элемента инфоблока для построения костомных хлебных крошек

	const HOTELS_SEF_FOLDER 	= "/oteli/"; 	 // корень для отелей
	const SANATORII_SEF_FOLDER  = "/sanatorii/"; // корень для санаториев
	const STRANY_SEF_FOLDER		= "/strany/"; 	 // корень для стран
	const TURY_SEF_FOLDER 		= "/tury/"; 	 // корень для туров
	const SIGHTS_SEF_FOLDER 	= "/dostoprimechatelnosti/"; 	 // корень для достопримечательностей
	const EXCURSIONS_SEF_FOLDER = "/ekskursii/"; 	 // корень для экскурсий


	// типы туров
	const BUS = 515;
	const AIR = 483;
	const HEALS = 484;
	const EXCURSION = 514;
	const EARLY = 10465;
	const NEW_YEAR = 63557;
	const EARLY_BOOKING = 90897;
	const EXCURSION_AIR = 82191;

	const IFRAME_URL_TEMPLATE = 'https://booking2.otpusk.by/mw_search/Extra/QuotedDynamic.aspx?country={country_mt_id}&departFrom=448&tourlistkey={mt_id}'; // ссылка для фрейма


	static public $labels = array(
		'discount' => '/bitrix/templates/main/images/status/sale.png',
		'hot' => '/bitrix/templates/main/images/status/hot.png',
		'new' => '/bitrix/templates/main/images/status/new.png',
		'free' => '/bitrix/templates/main/images/status/free.png',
        'archive' => '/bitrix/templates/main/images/status/archive.png'
	); // картинки по типам меток
}