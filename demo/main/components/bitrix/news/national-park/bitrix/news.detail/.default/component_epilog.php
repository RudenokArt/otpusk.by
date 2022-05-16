<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//=====================================================================//
//						ФОРМА заявки на размещение					   //
//=====================================================================//
$form_name = "Оставить заявку";
$additional_info['name'] = $arResult['NAME'];
require_once $_SERVER['DOCUMENT_ROOT']. "/include/order_form.php";