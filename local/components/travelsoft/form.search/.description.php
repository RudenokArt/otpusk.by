<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => 'Форма поиска travelsoft',
	"DESCRIPTION" => 'Форма поиска travelsoft',
	"ICON" => "/images/form.gif",
	"COMPLEX" => "N",
	"PATH" => array(
		"ID" => "service",
		"CHILD" => array(
			"ID" => "tourIndex_form",
			"NAME" => "Формы tourIndex'a",
		),
	),
);
?>
