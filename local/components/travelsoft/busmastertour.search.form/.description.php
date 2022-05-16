<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => 'Форма поиска для МастерТур',
	"DESCRIPTION" => 'Форма поиска для МастерТур',
	"ICON" => "/images/form.gif",
	"COMPLEX" => "N",
	"PATH" => array(
		"ID" => "service",
		"CHILD" => array(
			"ID" => "mastertour_form",
			"NAME" => "Формы МастерТур'a",
		),
	),
);
?>