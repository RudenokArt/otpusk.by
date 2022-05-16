<?
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

// дамп переменных
function dm( $var )
{

	global $USER;

	/*if(!$USER->IsAdmin())
		return;*/
	
	//ob_start();
	echo "<pre>";
		print_r($var);
	echo "</pre>";
	//file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/dm.txt", ob_get_clean());
}

function dmtf($var) {

	ob_start();
	echo "<pre>";
		print_r($var);
	echo "</pre>";
	file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/dm.txt", ob_get_clean());

}


/**
* склонение слов
*/
function w($n, $v = 1)
{
	if($v == 1)
		$n = $n + 1;

	$m = $n % 100;
	if($m > 19)
		$m = $m %10;

	switch($m)
	{
		case 0:
		case ($m >= 5 && $m <= 19): return $v == 2 ? $n . " ночей" : $n . " дней";

		case 1:     				return $v == 2 ? $n . " ночь"  : $n . " день";
		
		case ($m >= 2 && $m <= 4):  return $v == 2 ? $n . " ночи"  : $n . " дня";
	}
}


/**
 * выводит метку тура	
 */
function printTourLabel($p) {
	if($p['DISCOUNT']['VALUE'] != "")
		$img = Set::$labels['discount'];
	else
		if($p['TOUR_TYPE']['VALUE'] != "")
			$img = Set::$labels['hot'];
		else
			if($p['NEW']['VALUE'] != "")
				$img = Set::$labels['new'];
		else
			if($p['FREE']['VALUE'] != "")
				$img = Set::$labels['free'];
		else
		    if($p['TOUR_IN_ARCHIVE']['VALUE'] != "")
		        $img = Set::$labels['archive'];
		else
		    if($p['NIGHT_PLUS']['VALUE'] != "")
				$img = "/bitrix/templates/main/images/status/profitgr.png";
	if($img)
		return 	"<div style=\"background-image: url(" . $img . ")\" class=\"label-tour\"></div>";
			

	return "";

}
/**
* конвертер валюты
*
* $price - цена (число)
*
* $in - id валюты из иб 33
*
* $only_price - показывать конвертированную цену без обознаения валюты (для активации 
* установить в true)
*
*/
function convert_currency($price = null, $in = null, $only_price = false)
{
	static $course, $currency;

	$need_currency = Set::CURRENCY_BYN_ID; $need_iso = 'BYN';

	if(empty($course[$need_iso]))
	{
		\Bitrix\Main\Loader::includeModule('iblock');

		// курс валюты ib = 23
		$c = CIBlockElement::GetList(array('ID' => 'DESC'), array("IBLOCK_ID" => Set::COURSE_CURRENCY_IBLOCK_ID), false, array('nTopCount' => 1), array('ID', 'PROPERTY_USD', 'PROPERTY_EUR', 'PROPERTY_RUB', 'PROPERTY_BYR'))->Fetch();

		$course[$need_iso]['USD'] = (float)$c['PROPERTY_USD_VALUE'];
		$course[$need_iso]['EUR'] = (float)$c['PROPERTY_EUR_VALUE'];
		$course[$need_iso]['RUB'] = (float)$c['PROPERTY_RUB_VALUE'];
		$course[$need_iso]['BYR'] = (float)$c['PROPERTY_BYR_VALUE'];
	}

	if(empty($currency))
	{
	    // валюты ib = 33
		$c = CIBlockElement::GetList(false, array("IBLOCK_ID" => Set::CURRENCY_IBLOCK_ID), false, false, array('ID', 'NAME', 'PROPERTY_ISO', 'PROPERTY_COMMISSION'));

		while($cc = $c->Fetch())
		{
		    $currency[$cc['ID']] = $cc;
			$currency[$cc['ID']]['ISO'] = $cc['PROPERTY_ISO_VALUE'];
			$currency[$cc['ID']]['COMMISSION'] = $cc['PROPERTY_COMMISSION_VALUE'] / 100;
		}
	}

	if($price == null || $price <= 0)
		return "";

	if(!isset($currency[$in]))
		return "";

	$convert_price = ($in == $need_currency) ? $price : $price * ($course[$need_iso][$currency[$in]['ISO']] + ($course[$need_iso][$currency[$in]['ISO']] * $currency[$in]['COMMISSION']));

	if($only_price)
		return $convert_price;

	return number_format($convert_price, 2, ".", " ") . " " . $currency[$need_currency]['NAME']; 
}

/**
* деноминация валюты
*/
function denomination($price = null, $in = null, $dn = 1/10000)
{
	$n = convert_currency($price, $in, true);

	if($n > 0)
	{
		$n = $n / $dn;
		return number_format($n, 0, '', ' ') . " BYR";
	}

	return "";
}

/**
* фильтрует прошедшие даты тура
* array $dates
*/
function dateFilter($dates)
{
	$today = time();

	$new_dates = array();

	foreach($dates as $date)
	{
		$unix = MakeTimeStamp($date);
		if($today <= $unix)
			$new_dates[] = ConvertTimeStamp($unix, "FULL");
	}

	return $new_dates;
}


/**
* получение дополнительных элементов на странице
* array $filter. Фильтр по типу $arFilter в CIBlockElement::GetList
* int $count. Нужное число элементов.
*/
function getAdditionalElementsCountry($filter = null, $count = null, $sort = null)
{
    if($filter == null)
        return false;

    $filter['ACTIVE'] = "Y";

    if($sort == null)
        $sort = array("SORT" => "ASC");

    //if($filter['IBLOCK_ID'] == Set::SPECIAL_OFF_IBLOCK_ID)
    $filter['ACTIVE_DATE'] = "Y";

    \Bitrix\Main\Loader::includeModule('iblock');

    $nav = ($count == null || $count <= 0) ? false : array('nTopCount' => $count);

    $db_res = CIBlockElement::GetList($sort, $filter, false, $nav, array());

    $arr_res = array();
    while($res = $db_res->GetNextElement())
    {
        $arFields = $res->GetFields();
        $arProps = $res->GetProperties();
        $arr_res[$arFields['ID']]['NAME'] = $arFields['NAME'];
        $arr_res[$arFields['ID']]['CODE'] = $arFields['CODE'];
        $arr_res[$arFields['ID']]['PAGE'] = $arFields['DETAIL_PAGE_URL'];

        if($arProps['PRICE_FOR']['VALUE'] != "")
        {
            $arr_res[$arFields['ID']]['PRICE_FOR'] = $arProps['PRICE_FOR']['VALUE'];
        }

        $arr_res[$arFields['ID']]['FOR_LABELS'] = array(
            "DISCOUNT" => array('VALUE' => $arProps["DISCOUNT"]["VALUE"]),
            "TOUR_TYPE" => array('VALUE' => $arProps["TOUR_TYPE"]["VALUE"]),
            "NEW" => array('VALUE' => $arProps["NEW"]["VALUE"]),
            "FREE" => array('VALUE' => $arProps["FREE"]["VALUE"])
        );

        if(!empty($arProps['TYPE_EXCURSIONS']['VALUE']))
        {
            $names = array();
            foreach($arProps['TYPE_EXCURSIONS']['VALUE'] as $vv)
            {
                $ress = CIBlockElement::GetByID($vv)->GetNextElement()->GetFields();
                $names[] = strtolower($ress['NAME']);
            }

            $arr_res[$arFields['ID']]['TYPE_EXCURSIONS'] = implode(', ', $names);
        }

		if(!empty($arProps['OFFER_IN_PROCESS']['VALUE']))
		{
			$arr_res[$arFields['ID']]['OFFER_IN_PROCESS'] = "Y";
		}

        if($arProps['DEPARTURE_TEXT']['VALUE'] != "")
            $arr_res[$arFields['ID']]['DEP_TEXT'] = $arProps['DEPARTURE_TEXT']['VALUE'];


        if(!empty($arProps['PICTURES']['VALUE']))
        {
            $arProps['PICTURES']['VALUE'] = (array)$arProps['PICTURES']['VALUE'];

            $file = CFile::ResizeImageGet($arProps['PICTURES']['VALUE'][0], array('width'=>600, 'height'=>400), BX_RESIZE_IMAGE_EXACT, true);

            $arr_res[$arFields['ID']]['PIC'] = $file['src'];
        }
        else
            if($arFields['PREVIEW_PICTURE'] > 0)
            {
                $file = CFile::ResizeImageGet($arFields['PREVIEW_PICTURE'], array('width'=>600, 'height'=>400), BX_RESIZE_IMAGE_EXACT, true);
                $arr_res[$arFields['ID']]['PIC'] = $file['src'];
            }
            else
                $arr_res[$arFields['ID']]['PIC'] = Set::NO_PHOTO;

        $price = (int)$arProps['PRICE']['VALUE'];
        if($price > 0)
        {
            $arr_res[$arFields['ID']]['PRICE'] = convert_currency($price, (int)$arProps['CURRENCY']['VALUE']);

            $arr_res[$arFields['ID']]['PROPERTY_PRICE_VALUE'] = $arProps['PRICE']['VALUE'];
            $arr_res[$arFields['ID']]['PROPERTY_CURRENCY_VALUE'] = $arProps['CURRENCY']['VALUE'];

            $type_currecy = CIBlockElement::GetByID($arProps['CURRENCY']['VALUE']);
            if($ar_res = $type_currecy->GetNext())
                $arr_res[$arFields['ID']]['PROPERTY_CURRENCY_NAME'] = $ar_res['NAME'];

        }
        else
            $arr_res[$arFields['ID']]['PRICE'] = '';

        $days = (int)$arProps['DAYS']['VALUE'];
        if($days >= 0)
        {
            $arr_res[$arFields['ID']]['DAYS'] = w($days);
            $arr_res[$arFields['ID']]['NIGHT'] = w($days, 2);

            $arr_res[$arFields['ID']]['DURATION'] = w($days) . " " . w($days, 2);
        }

        if(!empty($arProps['CAT_ID']['VALUE']))
            $arr_res[$arFields['ID']]['CATEGORY'] = $arProps['CAT_ID']['VALUE'];

        if(!empty($arProps['TYPE_ID']['VALUE']))
            $arr_res[$arFields['ID']]['TYPE'] = $arProps['TYPE_ID']['VALUE'];

        if(!empty($arProps['TOWN']['VALUE'])){
            $names = array();
            foreach($arProps['TOWN']['VALUE'] as $vv)
            {
                $db_town = CIBlockElement::GetByID($vv)->GetNextElement()->GetFields();
                $names[] = $db_town['NAME'];
            }

            $arr_res[$arFields['ID']]['TOWN'] = implode(' - ', $names);
        }

        if(!empty($arProps['COUNTRY']['VALUE'])){
            foreach ($arProps['COUNTRY']['VALUE'] as $country){
                $db_country =  CIBlockElement::GetByID($country)->GetNextElement()->GetFields();
                $arr_res[$arFields['ID']]['COUNTRY'][$country] = $db_country['NAME'];
                $arr_res[$arFields['ID']]['COUNTRY_PAGE'][$country] = $db_country['DETAIL_PAGE_URL'];
            }
       }

        if(isset($arProps["DEPARTURE']['VALUE"]))
            $arr_res[$arFields['ID']]['DEP_TIME'] = (array)$arProps["DEPARTURE']['VALUE"];

        if($arProps["TOURTYPE"]["VALUE"] != ""){
            $db_tourtype = CIBlockElement::GetByID($arProps["TOURTYPE"]["VALUE"])->fetch();
            $arr_res[$arFields['ID']]['TOURTYPE'] = $db_tourtype["NAME"];
        }

        if($arProps["POINT_DEPARTURE"]["VALUE"] != ""){
            if(is_array($arProps["POINT_DEPARTURE"]["VALUE"]) && count($arProps["POINT_DEPARTURE"]["VALUE"]) >= 1){
                $db_departure = CIBlockElement::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>Set::CITY_IBLOCK_ID, "ID"=>$arProps["POINT_DEPARTURE"]["VALUE"]), false, false, Array("ID","PROPERTY_CN_NAME_CHEGO"));
                while($ar_fields = $db_departure->GetNext())
                {
                    $arr_res[$arFields['ID']]['PDEP'][] = $ar_fields["PROPERTY_CN_NAME_CHEGO_VALUE"];
                }
            }
            else {
                $db_departure = CIBlockElement::GetProperty(Set::CITY_IBLOCK_ID, $arProps["POINT_DEPARTURE"]["VALUE"], array("sort" => "asc"), Array("CODE"=>"CN_NAME_CHEGO"))->fetch();
                $arr_res[$arFields['ID']]['PDEP'] = $db_departure["VALUE"];
            }
        }

        if($arProps["HOTEL"]["VALUE"] != ""){
            foreach ($arProps['HOTEL']['VALUE'] as $hotel){
                $db_hotel = CIBlockElement::GetByID($hotel)->fetch();
                $arr_res[$arFields['ID']][$hotel] = $db_hotel['NAME'];
            }
        }

        if($arProps["FOOD"]["VALUE"] != ""){
            $db_food = CIBlockElement::GetByID($arProps["FOOD"]["VALUE"])->fetch();
            $arr_res[$arFields['ID']]['FOOD'] = $db_food["NAME"];
        }

        if($arFields["DETAIL_TEXT"] != "")
            $arr_res[$arFields['ID']]['DETAIL_TEXT'] = $arFields["DETAIL_TEXT"];

        if ($arProps["URL"]["VALUE"] != "") {
            $arr_res[$arFields['ID']]['PAGE'] = "/aviabilety/?".$arProps["URL"]["VALUE"];
        }
    }

    return (!empty($arr_res)) ? $arr_res : false;
}
function getAdditionalElements($filter = null, $count = null, $sort = null)
{
	if($filter == null)
		return false;

	$filter['ACTIVE'] = "Y";

	if($sort == null)
		$sort = array("SORT" => "ASC");

	//if($filter['IBLOCK_ID'] == Set::SPECIAL_OFF_IBLOCK_ID)
		$filter['ACTIVE_DATE'] = "Y";

	\Bitrix\Main\Loader::includeModule('iblock');

	$nav = ($count == null || $count <= 0) ? false : array('nTopCount' => $count);

	$db_res = CIBlockElement::GetList($sort, $filter, false, $nav, array('ID', 'NAME', 'CODE', 'DETAIL_PAGE_URL', "DETAIL_TEXT",'PREVIEW_PICTURES', 'PROPERTY_PICTURES', 'PROPERTY_PRICE', 'PROPERTY_CURRENCY', 'PROPERTY_CURRENCY.NAME', 'PROPERTY_DAYS', 'PROPERTY_TYPE_ID', 'PROPERTY_TOWN.ID', 'PROPERTY_TOWN.NAME', 'PROPERTY_TOWN.DETAIL_PAGE_URL', 'PROPERTY_COUNTRY.ID', 'PROPERTY_COUNTRY.NAME', 'PROPERTY_COUNTRY.DETAIL_PAGE_URL',"PROPERTY_TOURTYPE.NAME", "PROPERTY_POINT_DEPARTURE.PROPERTY_CN_NAME_chego", "PROPERTY_HOTEL.NAME", "PROPERTY_FOOD.NAME", "PROPERTY_DEPARTURE", 'IBLOCK_SECTION_ID', "PROPERTY_DEPARTURE_TEXT", "PROPERTY_TYPE_EXCURSIONS", "PROPERTY_PRICE_FOR","PROPERTY_DISCOUNT", "PROPERTY_TOUR_TYPE", "PROPERTY_NEW", "PROPERTY_CAT_ID", "PROPERTY_url", "PROPERTY_POSITION", "PROPERTY_OFFICE", "PROPERTY_OFFER_IN_PROCESS"));

	$arr_res = array();
	while($res = $db_res->GetNext())
	{

	    $arr_res[$res['ID']]['NAME'] = $res['NAME'];
		$arr_res[$res['ID']]['CODE'] = $res['CODE'];
		$arr_res[$res['ID']]['PAGE'] = $res['DETAIL_PAGE_URL'];

		if($res['PROPERTY_PRICE_FOR_VALUE'] != "")
		{
			$arr_res[$res['ID']]['PRICE_FOR'] = $res['PROPERTY_PRICE_FOR_VALUE'];
		}

		$arr_res[$res['ID']]['FOR_LABELS'] = array(
								"DISCOUNT" => array('VALUE' => $res["PROPERTY_DISCOUNT_VALUE"]),
								"TOUR_TYPE" => array('VALUE' => $res["PROPERTY_TOUR_TYPE_VALUE"]),
								"NEW" => array('VALUE' => $res["PROPERTY_NEW_VALUE"]),
								"FREE" => array('VALUE' => $res["PROPERTY_FREE_VALUE"])
							);

		if(!empty($res['PROPERTY_TYPE_EXCURSIONS_VALUE']))
		{
			$names = array();
			foreach($res['PROPERTY_TYPE_EXCURSIONS_VALUE'] as $vv)
			{
				$ress = CIBlockElement::GetByID($vv)->GetNextElement()->GetFields();
				$names[] = strtolower($ress['NAME']);
			}

			$arr_res[$res['ID']]['TYPE_EXCURSIONS'] = implode(', ', $names);
		}

		if($res['PROPERTY_DEPARTURE_TEXT_VALUE'] != "")
			$arr_res[$res['ID']]['DEP_TEXT'] = $res['PROPERTY_DEPARTURE_TEXT_VALUE'];

		if($res['PROPERTY_OFFER_IN_PROCESS_VALUE'] != "")
		{
			$arr_res[$res['ID']]['OFFER_IN_PROCESS'] = "Y";
		}

		
		if(!empty($res['PROPERTY_PICTURES_VALUE']))
		{
			$res['PROPERTY_PICTURES_VALUE'] = (array)$res['PROPERTY_PICTURES_VALUE'];

			$size = array('width'=>600, 'height'=>400);

			if($filter["IBLOCK_ID"] == Set::EMPLOYERS_IBLOCK_ID){
			    $size = array('width'=>264, 'height'=>264);
            }
			
			$file = CFile::ResizeImageGet($res['PROPERTY_PICTURES_VALUE'][0], $size, BX_RESIZE_IMAGE_EXACT, true);

			$arr_res[$res['ID']]['PIC'] = $file['src'];
		}
		else
			if($res['PREVIEW_PICTURE'] > 0)
			{
				$file = CFile::ResizeImageGet($res['PREVIEW_PICTURE'], array('width'=>600, 'height'=>400), BX_RESIZE_IMAGE_EXACT, true);
				$arr_res[$res['ID']]['PIC'] = $file['src'];
			}
			else
				$arr_res[$res['ID']]['PIC'] = Set::NO_PHOTO;

		$price = (int)$res['PROPERTY_PRICE_VALUE'];
		if($price > 0)
		{
			$arr_res[$res['ID']]['PRICE'] = convert_currency($price, (int)$res['PROPERTY_CURRENCY_VALUE']);

			$arr_res[$res['ID']]['PROPERTY_PRICE_VALUE'] = $res['PROPERTY_PRICE_VALUE'];
			$arr_res[$res['ID']]['PROPERTY_CURRENCY_VALUE'] = $res['PROPERTY_CURRENCY_VALUE'];
			$arr_res[$res['ID']]['PROPERTY_CURRENCY_NAME'] = $res['PROPERTY_CURRENCY_NAME'];

		}
		else
			$arr_res[$res['ID']]['PRICE'] = '';

		$days = (int)$res['PROPERTY_DAYS_VALUE'];
		if($days >= 0)
		{
			$arr_res[$res['ID']]['DAYS'] = w($days);
			$arr_res[$res['ID']]['NIGHT'] = w($days, 2);

			$arr_res[$res['ID']]['DURATION'] = w($days) . " " . w($days, 2);
		}

		if(!empty($res['PROPERTY_OFFICE_VALUE'])) {
            $arr_res[$res['ID']]['OFFICE'] = $res['PROPERTY_OFFICE_VALUE'];
            $ress = CIBlockElement::GetList(array(), array("IBLOCK_ID"=>Set::DEPARTMENT_IBLOCK_ID, "ID" => $res['PROPERTY_OFFICE_VALUE'], "ACTIVE" => "Y"), false, false, array("IBLOCK_ID", "ID", "PROPERTY_TOWN.NAME"))->GetNextElement()->GetFields();
            $arr_res[$res['ID']]['TOWN'] = $ress["PROPERTY_TOWN_NAME"];
        }
        if(!empty($res['PROPERTY_POSITION_VALUE']))
            $arr_res[$res['ID']]['POSITION'] = $res['PROPERTY_POSITION_VALUE'];

		if(!empty($res['PROPERTY_CAT_ID_VALUE']))
			$arr_res[$res['ID']]['CATEGORY'] = $res['PROPERTY_CAT_ID_VALUE'];

		if(!empty($res['PROPERTY_TYPE_ID_VALUE']))
			$arr_res[$res['ID']]['TYPE'] = $res['PROPERTY_TYPE_ID_VALUE'];

		if(!empty($res['PROPERTY_TOWN_NAME']))
			$arr_res[$res['ID']]['TOWN'] = $res['PROPERTY_TOWN_NAME'];

		if(!empty($res['PROPERTY_TOWN_DETAIL_PAGE_URL']))
			$arr_res[$res['ID']]['TOWN_PAGE'] = $res['PROPERTY_TOWN_DETAIL_PAGE_URL'];

		if(!empty($res['PROPERTY_COUNTRY_NAME']))
			$arr_res[$res['ID']]['COUNTRY'] = $res['PROPERTY_COUNTRY_NAME'];

		if(!empty($res['PROPERTY_COUNTRY_DETAIL_PAGE_URL']))
			$arr_res[$res['ID']]['COUNTRY_PAGE'] = $res['PROPERTY_COUNTRY_DETAIL_PAGE_URL'];

		if(isset($res["PROPERTY_DEPARTURE_VALUE"]))
			$arr_res[$res['ID']]['DEP_TIME'] = (array)$res["PROPERTY_DEPARTURE_VALUE"];

		if($res["PROPERTY_TOURTYPE_NAME"] != "")
			$arr_res[$res['ID']]['TOURTYPE'] = $res["PROPERTY_TOURTYPE_NAME"];

		if($res["PROPERTY_POINT_DEPARTURE_PROPERTY_CN_NAME_CHEGO_VALUE"] != "")
			$arr_res[$res['ID']]['PDEP'] = $res["PROPERTY_POINT_DEPARTURE_PROPERTY_CN_NAME_CHEGO_VALUE"];

		if($res["PROPERTY_HOTEL_NAME"] != "")
			$arr_res[$res['ID']]['HOTEL'] = $res["PROPERTY_HOTEL_NAME"];

		if($res["PROPERTY_FOOD_NAME"] != "")
			$arr_res[$res['ID']]['FOOD'] = $res["PROPERTY_FOOD_NAME"];

		if($res["DETAIL_TEXT"] != "")
			$arr_res[$res['ID']]['DETAIL_TEXT'] = $res["DETAIL_TEXT"];

		if ($res["PROPERTY_URL_VALUE"] != "") {
			$arr_res[$res['ID']]['PAGE'] = "/aviabilety/?".$res["PROPERTY_URL_VALUE"];
		}
	}

	return (!empty($arr_res)) ? $arr_res : false;
}



/**
* обработка символьного кода элемента иб
* string $code - символьный код элемента
* array $add_strip_arr - массив дополнительных замен после основной обработки вида:
* "key" - что меняем,
* "value" - на что меняем
*/
function strip_element_code($code, $add_strip_arr = array())
{
	if($code == "")
		return $code;

	$pos = strpos($code, "/", 1);

	if($pos !== false)
		$code = substr($code, 0, $pos);

	$code = str_replace(array("?", "/"), array("", ""), $code);

	if(!empty($add_strip_arr))
	{
		foreach ($add_strip_arr as $k => $v)
		{
			$code = str_replace($k, $v, $code);
		}
	}

	return $code;
}

/**
* Проверка на существование элемента инфоблока по коду или ID
* integer $ib - ID инфоблока
* integer or string - $code_or_id - код или ID элемента
*/
function is_exists($ib, $code_or_id)
{
	$ib = (int)$ib;

	if($ib <= 0 || $code_or_id == "")
		return false;

	\Bitrix\Main\Loader::includeModule('iblock');

	$el = CIBlockElement::GetList(
			false,
			array(
				'IBLOCK_ID' => $ib,
				array(
					"LOGIC" => "OR",
					array("CODE" => $code_or_id),
					array("ID" => $code_or_id)
				)
			),
			false,
			array('nTopCount' => 1),
			array("ID"))->Fetch();

	if((Int)$el['ID'] > 0)
		return true;

	return false;
}

function is_exists2($id)
{
	if(!$id) return false;

	\Bitrix\Main\Loader::includeModule('iblock');

	$el = CIBlockElement::GetByID($id)->Fetch();

	return $el['ID'] > 0 ? true : false;
}

/**
* Функция для подключения файлов исходя из URL
* string $sef_folder - корневой раздел по которому работает функция
* array  $path_templates - массив шаблонов путей для разбора URL
* string $callback_func_name - имя функции для дополнительной обработки переменных после разбора URL
*/
function includeFile($sef_folder, $path_templates, $callback_func_name)
{
	global $APPLICATION;

	// 404
	if($sef_folder == "" || empty($path_templates))
	{
		LocalRedirect(Set::PAHT_TO_404, '404 Not Found');
		return;
	}

	// обработка адреса и получение переменных
	$variables = array();
	$template_name = CComponentEngine::ParseComponentPath($sef_folder, $path_templates, $variables);

	
	$path = "";
	//вызов сallback-функции для добработки полученных переменных
	if(function_exists($callback_func_name) && isset($path_templates[$template_name]))
	{
		$variables = array('CODE' => end($variables));
		$path = $callback_func_name($variables, $template_name);
	}

	// 404
	if($path == "" || !file_exists($_SERVER['DOCUMENT_ROOT'] . $path))
	{
		LocalRedirect(Set::PAHT_TO_404, '404 Not Found');
		return;
	}

	$variables['SEF_FOLDER'] = $sef_folder;
	$APPLICATION->IncludeFile($path, $variables, Array(
		    "MODE"      => "html", // будет редактировать в веб-редакторе
		    "NAME"      => "Страница с компонентом", // текст всплывающей подсказки на иконке
		));
}

/**
* обёртка для includeFile
* позволяет дополнительно формировать костомные хлебные крошки
*/
function includeFileModifier($sef_folder, $path_templates, $callback_func_name)
{
	includeFile(
		$sef_folder,
		$path_templates,
		$callback_func_name
		);

	if(Set::$element_id_breadcrumb > 0)
	{
		$arr = makeLinks( Set::$element_id_breadcrumb );
		
		Set::$element_id_breadcrumb = 0;

		foreach($arr as &$v)
			$v = str_replace("#SEF_FOLDER#", $sef_folder, $v);

		add2NavChain( $arr );
	}
}


/**
* callbakc функция по странам для includeFIle()
*/
function strany_callback($v, $t_n)
{
	$p = "";

	$s_f = "/include/strany";

	$article = $s_f . "/article.php";
	$country = $s_f . "/country.php";
	$city 	 = $s_f . "/city.php";

	if($t_n == "a" || $t_n == "b")
		$p = $article;

	elseif($t_n == "c")
	{
		if(is_exists(Set::CITY_IBLOCK_ID, $v['CODE']))
			$p = $city;
		else
			$p = $article;
	}
	else
		if($t_n == "d")
			$p = $country;

	return $p;
		
}

/**
* callbakc функция по отелям для includeFIle()
*/
function oteli_callback($v, $t_n)
{

	$p = "";

	$s_f = "/include/oteli";

	$article = $s_f . "/article.php";
	$otel = $s_f . "/otel.php";

	if($t_n == "a" || $t_n == "b")
		$p = $article;

	elseif($t_n == "c")
		$p = $otel;

	return $p;
		
}

/**
* callbakc функция по санаториям для includeFIle()
*/
function sanatorii_callback($v, $t_n)
{

	$p = "";

	$s_f = "/include/sanatorii";

	$article = $s_f . "/article.php";
	$sanatoriy = $s_f . "/sanatoriy.php";

	if($t_n == "a" || $t_n == "b")
		$p = $article;

	elseif($t_n == "c")
		$p = $sanatoriy;

	return $p;
		
}

/**
* callbakc функция по достопримечательностям для includeFIle()
*/
function sights_callback($v, $t_n)
{

	$p = "";

	$s_f = "/include/dostoprimechatelnosti";

	$article = $s_f . "/article.php";
	$sights = $s_f . "/sights.php";

	if($t_n == "a" || $t_n == "b")
		$p = $article;

	elseif($t_n == "c")
		$p = $sights;

	return $p;
		
}

function make_filter($arr_filter_vars, $prefix = false)
{
	$filter = array();

	if(empty($arr_filter_vars))
		return $filter;

	if($prefix)
	{
		foreach($arr_filter_vars as $code => $v)
		{
			$pref = substr($code, 0, strlen($prefix));
			if($pref == $prefix && !empty($v['VALUE']))
			{
				$code = substr($code, strlen($prefix));
				$filter["PROPERTY_" . $code] = ($v['PROPERTY_TYPE'] == "L" || $v['PROPERTY_TYPE'] == "C") ? $v['VALUE_XML_ID'] : $v['VALUE'];
			}


		}
	}
	else
	{
		foreach($arr_filter_vars as $c => $v)
		{
			if(!empty($v['VALUE'])) 
				$filter["PROPERTY_" . $code] = $v['VALUE'];
		}
	}

	return $filter;
}


/**
* функция - обёртка getAdditionalElements для вывода дополнительных элементов
* (туров, отелей) на детальной странице статей
*/
function getAdditionalElements_for_articles($arr_properties, $prefix, $ib)
{
	$filter = make_filter($arr_properties, $prefix);
	if(!empty($filter))
	{
		$filter["IBLOCK_ID"] = $ib;
		if($ib == 18) { // Фильтрация по актуальности туров
			$filter[] = array(">=PROPERTY_DEPARTURE" => date("Y-m-d"));
			if(!empty($filter["PROPERTY_TOUR_TYPE"])) // Сопостовление "Горящего тура" в статье и в спец. предл.
				$filter["PROPERTY_TOUR_TYPE"] = 93;
			if(!empty($filter["PROPERTY_EARLY_BOOKING"])) // Сопостовление "Раннего бронирования" в статье и в спец. предл.
				$filter["PROPERTY_EARLY_BOOKING"] = 171;
			if(!empty($filter["PROPERTY_HOLIDAY_SEA"])) // Сопостовление "Раннего бронирования" в статье и в спец. предл.
				$filter["PROPERTY_HOLIDAY_SEA"] = 172;
		}
		return getAdditionalElements($filter);
	}
}

/**
* Функция обёртка для $APPLICATION->AddChainItem
*/
function add2NavChain($points)
{
	$points = (array)$points;
	if(empty($points))
		return;

	global $APPLICATION;
	foreach($points as $name => $link)
		$APPLICATION->AddChainItem($name, $link);
}

/**
* Поля и свойства элемента инфоблока
*/
function setALLFieldsAndProps($id, &$f, &$p)
{
	\Bitrix\Main\Loader::includeModule('iblock');
	$db_res = CIBlockElement::GetList(false, array("ID" => $id), flase, false, array("*"))->GetNextElement();
	$f = $db_res->GetFields();
	$p = $db_res->GetProperties();
}

/**
* формирование массива ссылок / или просто ссылки для элемента по определённым правилам
* integer $id - ID элемента иб
* bool $makeArray - { true - вернуть массив ссылок (например для ХК), false - просто ссылку }
*/
function makeLinks($id, $makeArray = true)
{
	if($id <= 0)
		return;

	setALLFieldsAndProps($id, $f, $p);

	switch($f['IBLOCK_ID'])
	{
		case Set::ARTICLE_COUNTRY_IBLOCK_ID: // статья по стране
		case Set::ARTICLE_HOTELS_IBLOCK_ID: // статья по отелям

			if($p['ARTICLE']['VALUE'] > 0)
				$id2 = $p['ARTICLE']['VALUE'];
			else
				if($p['HOTEL']['VALUE'] > 0)
					$id2 = $p['HOTEL']['VALUE'];
				else
					if($p['TOWN']['VALUE'] > 0)
						$id2 = $p['TOWN']['VALUE'];
					else
						if($p['COUNTRY']['VALUE'] > 0)
							$id2 = $p['COUNTRY']['VALUE'];
			break;

		case Set::CITY_IBLOCK_ID: // города
			if($p['COUNTRY']['VALUE'])
				$id2 = $p['COUNTRY']['VALUE'];
			break;
	}

	if(!$makeArray)
	{
		$link = $f['CODE'] . "/";
		return ($id2) ? makeLinks($id2, false) . $link : $link;
	}
	else
	{
		$path_array = array();
		$path_array = ($f['IBLOCK_ID'] == Set::ARTICLE_COUNTRY_IBLOCK_ID || $f['IBLOCK_ID'] == ARTICLE_HOTELS_IBLOCK_ID) ? array($f['NAME'] => "#SEF_FOLDER#".makeLinks($f['ID'], false)) + $path_array : array($f['NAME'] => $f['DETAIL_PAGE_URL']) + $path_array;

		if($id2)
			$path_array = makeLinks($id2) + $path_array;

		return $path_array;
	}
}

/**
* формирует URL для страницы с фильтром
* если $prop_code - массив, то $value тоже должен быть массивоми ключи соответствуют ключам из $prop_code
*/
function makeFilterLink($prop_code, $ib_id, $value, $section_id, $prefix = "arrFilter")
{
	if($prop_code == "" || $ib_id <= 0)
		return "";
	
	if($ib_id == Set::HOTELS_IBLOCK_ID)
	{
		if($section_id == Set::SANATORII_SECTION_ID)
			$s_f = Set::SANATORII_SEF_FOLDER;
		else
			$s_f = Set::HOTELS_SEF_FOLDER;
		
	}
	else
		if($ib_id == Set::SPECIAL_OFF_IBLOCK_ID) $s_f = Set::TURY_SEF_FOLDER;

	if($s_f)
	{
		if(is_array($prop_code) && !empty($prop_code) )
		{
			foreach($prop_code as $p)
				$prop[] = CIBlockProperty::GetByID($p, $ib_id)->Fetch();
		}
		else
			$prop[] = CIBlockProperty::GetByID($prop_code, $ib_id)->Fetch();
	}

	
	$value = (array)$value;
	
	if(!empty($prop))
	{
		foreach ($prop as $k => $p)
		{
			if($p['CODE'] == "COUNTRY" || $p['CODE'] == "TOWN" || $p['CODE'] == "MEDPROFIL" || $p['CODE'] == "SEARCH")
				$filter_param[] = $prefix .'_'. $p['ID'] .'_'. (($value[$k] != "") ? abs(crc32($value[$k])) : "") .'=Y';
			else
				$filter_param[] = $prefix .'_'. $p['ID'] .'='. (($value[$k] != "") ? abs(crc32($value[$k])) : "");
		}
		
	}

	if($filter_param)
		return $s_f . "?set_filter=Y&" .implode("&",$filter_param);
}


/* проверка на присутствие h1 на странице (алгоритм поиска h1 основан на выводе его в файле /include/big_inner_img.php) */

function h1Exists()
{
	global $APPLICATION;

	$b_i_src = $APPLICATION->GetDirProperty('BIG_IMG');
	if($b_i_src != "" && $b_i_src != "N" && NOT_SHOW_BIG_IMG !== true)
		return true;

	return false;

}

// получаем ID пользователя в системе мастертур
function getMTUserKey ($user_id) {

	if ($user_id > 0) {
		
		$rsUser = CUser::GetList(($by="ID"), ($order="desc"), array("ID"=>$user_id),array("SELECT"=>array("UF_MT_KEY")))->Fetch();

		// получаем ключ пользователя в mastertour
		if ($rsUser['UF_MT_KEY'] != "")
			return $rsUser['UF_MT_KEY'];
	}

	return false;

}

//нахождение ключа МТ/sletat города/страны
function getKeyItem ($iblock, $id, $key) {

    $k = 0;
    $db_props = CIBlockElement::GetProperty($iblock, $id, array("sort" => "asc"), Array("CODE"=>"$key"));
    if($ar_props = $db_props->Fetch())
        $k = IntVal($ar_props["VALUE"]);

    return $k;

}

//выборка городов/стран с непустыми значениями свойств
function getCityCountry ($iblock, $master, $sletat) {
    $value = array();
    \Bitrix\Main\Loader::includeModule('iblock');
    $db_res = CIBlockElement::GetList(array(), array("IBLOCK_ID" => $iblock, "ACTIVE" => "Y", array("LOGIC" => "OR", array("!=PROPERTY_".$master => false), array("!=PROPERTY_".$sletat => false))), false, false, array("ID", "NAME", "PROPERTY_".$master, "PROPERTY_".$sletat));
    while($ob = $db_res->GetNext()){
        $value[$ob["ID"]] = array(
            "NAME" => $ob["NAME"],
            "MASTERTOUR" => $ob["PROPERTY_".$master."_VALUE"],
            "SLETAT" => $ob["PROPERTY_".$sletat."_VALUE"],
        );
    }
    return $value;
}

//выборка всех связок поиска город-страна
function getSearchFilter ($valuesCity, $valuesCountry) {

    $value = array();
    \Bitrix\Main\Loader::includeModule('iblock');
    if(!empty($valuesCity) && !empty($valuesCountry)) {
        $city = array();$country = array();
        foreach($valuesCity as $key=>$val){
            if(!empty($val["MASTERTOUR"]) || !empty($val["SLETAT"]))
                $city[] = $key;
        }
        foreach($valuesCountry as $key=>$val){
            if(!empty($val["SLETAT"]) || !empty($val["MASTERTOUR"]))
                $country[] = $key;
        }

        $db_res = CIBlockElement::GetList(false, array("IBLOCK_ID" => Set::SEARCHFILTER_IBLOCK_ID, "ACTIVE" => "Y", "PROPERTY_CITYFROM_VALUE" => $city, "PROPERTY_COUNTRY_VALUE" => $country, "!=PROPERTY_FILTER_LINK" => false), false, false, array("*"));
        while ($ob = $db_res->GetNextElement()) {
            $p = $ob->GetProperties();
            if (isset($valuesCity[$p["CITYFROM"]["VALUE"]]) && isset($valuesCountry[$p["COUNTRY"]["VALUE"]]))
                $value[$p["CITYFROM"]["VALUE"]][$p["COUNTRY"]["VALUE"]] = $p["FILTER_LINK"]["VALUE_ENUM_ID"];
        }

    }

    return $value;
}
// список валют
function getCurrenty () {

    $idCurrenty = array();
    \Bitrix\Main\Loader::includeModule('iblock');
    $res = CIBlockElement::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID" => Set::CURRENCY_IBLOCK_ID, "ACTIVE" => "Y"), false, false, Array("ID", "PROPERTY_ISO"));
    while($ar_fields = $res->GetNext())
    {
        $idCurrenty[$ar_fields["PROPERTY_ISO_VALUE"]] = $ar_fields["ID"];
    }
    return $idCurrenty;

}

//выборка всех связок поиска город-страна для автобусных туров
function getSearchFilterBusTours ($valuesCity, $valuesCountry) {

    $value = array();
    \Bitrix\Main\Loader::includeModule('iblock');
    if(!empty($valuesCity) && !empty($valuesCountry)) {
        $city = array();$country = array();
        foreach($valuesCity as $key=>$val){
            if(!empty($val["MASTERTOUR"]))
                $city[] = $key;
        }
        foreach($valuesCountry as $key=>$val){
            if(!empty($val["MASTERTOUR"]))
                $country[] = $key;
        }

        $db_res = CIBlockElement::GetList(false, array("IBLOCK_ID" => Set::BUSTOURS_IBLOCK_ID, "ACTIVE" => "Y", "PROPERTY_CITYFROM_VALUE" => $city, "PROPERTY_COUNTRY_VALUE" => $country), false, false, array("*"));
        while ($ob = $db_res->GetNextElement()) {
            $p = $ob->GetProperties();
            if (isset($valuesCity[$p["CITYFROM"]["VALUE"]])){
                foreach ($p["COUNTRY"]["VALUE"] as $cntr){
                    if(array_key_exists($cntr,$valuesCountry))
                        $value[$p["CITYFROM"]["VALUE"]][] = $cntr;
                }
            }
        }

    }
    return $value;
}

function getDatesMT($typetour, $nottypetour) {

    $filter = '';
    if($typetour != null || !empty($typetour)){
        $filter = array('filter'=>array('UF_TOURTYPE_ID'=>$typetour));
    }
    elseif($nottypetour != null || !empty($nottypetour)){
        $filter = array('filter'=>array('!=UF_TOURTYPE_ID'=>$nottypetour));
    }
	CModule::IncludeModule("highloadblock");
	$hlbl = Set::GETDATESFORFILTR;
	$entity_table_name = $hlblock['GETDATESFORFILTR'];
	$arResultBlock = array();
	$hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch();
	$entity = HL\HighloadBlockTable::compileEntity($hlblock);
	$entity_data_class = $entity->getDataClass();
	$sTableID = 'b_'.$entity_table_name;
	$rsData = $entity_data_class::getList($filter);
	$rsDataCount = $rsData->getSelectedRowsCount();
	if($rsDataCount > 0){
		while($arRes = $rsData->fetch()){

			$date = unserialize($arRes["UF_DATES"]);
			if(!isset($arResultBlock[$arRes["UF_CITYFROM_ID"]][$arRes["UF_COUNTRY_ID"]]))
				$arResultBlock[$arRes["UF_CITYFROM_ID"]][$arRes["UF_COUNTRY_ID"]][1000] = array();
			$arResultBlock[$arRes["UF_CITYFROM_ID"]][$arRes["UF_COUNTRY_ID"]][1000] = array_merge($arResultBlock[$arRes["UF_CITYFROM_ID"]][$arRes["UF_COUNTRY_ID"]][1000], $date);
			$gg = array_unique($arResultBlock[$arRes["UF_CITYFROM_ID"]][$arRes["UF_COUNTRY_ID"]][1000]);
			array_walk($gg, function (&$item) {
				$item = MakeTimeStamp((string)$item, "DD.MM.YYYY");
			});
			sort($gg);
			array_walk($gg, function (&$item) {
				$item = date("d.m.Y", $item);
			});
			$arResultBlock[$arRes["UF_CITYFROM_ID"]][$arRes["UF_COUNTRY_ID"]][1000] = $gg;
			$arResultBlock[$arRes["UF_CITYFROM_ID"]][$arRes["UF_COUNTRY_ID"]][$arRes["UF_TOURTYPE_ID"]] = $date;

		}
	}

	return $arResultBlock;
}

//выборка городов/стран с непустыми значениями свойств
function getCityCountryMT ($iblock, $master) {
    $value = array();
    \Bitrix\Main\Loader::includeModule('iblock');
    $db_res = CIBlockElement::GetList(array(), array("IBLOCK_ID" => $iblock, "ACTIVE" => "Y", "!=PROPERTY_".$master => false), false, false, array("ID", "NAME", "PROPERTY_".$master));
    while($ob = $db_res->GetNext()){
        $value[$ob["PROPERTY_".$master."_VALUE"]] = array(
            "ID" => $ob["ID"],
            "NAME" => $ob["NAME"],
        );
    }
    return $value;
}

/**
 * Сортируем многомерный массив по значению вложенного массива
 * @param $array array многомерный массив который сортируем
 * @param $field string название поля вложенного массива по которому необходимо отсортировать
 * @param $id флаг необходимости подставлять id элемента в ключ
 * @return array отсортированный многомерный массив
 */
function customMultiSort($array,$field,$id = false) {

    $sortArr = array();
    foreach($array as $key=>$val){
        $sortArr[$key] = $val[$field];
    }

    array_multisort($sortArr,$array);

    if($id) {
        $arValues = array();
        foreach ($array as $val) {
            $arValues[$val["id"]] = $val;
        }
        $array = $arValues;
    }

    return $array;
}


function mysort($a,$b,$code) { return $a[$code] > $b[$code];}

function getDefaultDirection () {

    $value = array();
    $db_res = CIBlockElement::GetList(false, array("IBLOCK_ID" => Set::SEARCHFILTER_IBLOCK_ID, "ACTIVE" => "Y", "PROPERTY_DEFAULT_VALUE" => "Y", "!=PROPERTY_FILTER_LINK" => false), false, false, array("*"));
    while ($ob = $db_res->GetNextElement()) {
        $p = $ob->GetProperties();
        $value["cityfrom"] = $p["CITYFROM"]["VALUE"];
        $value["country"] = $p["COUNTRY"]["VALUE"];
    }

    return $value;

}
