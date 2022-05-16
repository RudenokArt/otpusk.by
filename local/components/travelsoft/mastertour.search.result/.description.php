<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => 'Выдача результата поиска матертур (туры)',
	"DESCRIPTION" => 'Выдача результата поиска матертур (туры)',
	"ICON" => "/images/form.gif",
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
