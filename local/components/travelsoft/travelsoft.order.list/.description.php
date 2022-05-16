<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => 'Список заказов пользователя',
	"DESCRIPTION" => 'Список заказов пользователя',
	"ICON" => "",
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
