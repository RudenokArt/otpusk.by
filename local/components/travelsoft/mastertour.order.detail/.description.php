<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => 'Детальная информация по заказу',
	"DESCRIPTION" => 'Детальная информация по заказу',
	"ICON" => "",
	"COMPLEX" => "N",
	"PATH" => array(
		"ID" => "service",
		"CHILD" => array(
			"ID" => "matsertour_form",
			"NAME" => "Формы МастерТур'a",
		),
	),
);
?>
