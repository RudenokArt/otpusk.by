<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

/* /local/php_interface/include/classes/ajax.php*/
/* подключаем облачть ajax*/
AjaxContent::start("ajax", true);

$arParams = &$this->arParams;

/* Сортировка */
if(isset($_REQUEST["sort"]))
{
	$s = $_REQUEST["sort"];
	if($s == "name")
		$arParams["ELEMENT_SORT_FIELD"] = "NAME";
	/*else
		if($s == "date")
			$arParams["ELEMENT_SORT_FIELD"] = "PROPERTY_DEPARTURE";*/
}

/* Порядок сортировки */
if(isset($_REQUEST["order"]))
	$arParams["ELEMENT_SORT_ORDER"] = strtolower($_REQUEST["order"]) == "asc" ? "ASC" : "DESC";