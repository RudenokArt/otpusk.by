<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

/* /local/php_interface/include/classes/ajax.php*/
/* подключаем облаcть ajax*/
AjaxContent::start("ajax", true);

$arParams = &$this->arParams;

/* Сортировка */
if(isset($_REQUEST["sort"]))
{
	$s = $_REQUEST["sort"];
	if($s == "price")
		$arParams["ELEMENT_SORT_FIELD"] = "PROPERTY_BYR_PRICE";
	else
		if($s == "date")
			$arParams["ELEMENT_SORT_FIELD"] = "PROPERTY_DEPARTURE";
}

/* Порядок сортировки */
if(isset($_REQUEST["order"]))
	$arParams["ELEMENT_SORT_ORDER"] = strtolower($_REQUEST["order"]) == "asc" ? "ASC" : "DESC";

// Отключаем показ новогодних туров

if ((!isset($GLOBALS['arrFilter']['=PROPERTY_101']) ||
		$GLOBALS['arrFilter']['=PROPERTY_101'][0] == Set::NEW_YEAR) && !defined("NEW_YEAR_TOUR_PAGE"))
	$GLOBALS['arrFilter']['!PROPERTY_101'] = Set::NEW_YEAR;

////////////////////