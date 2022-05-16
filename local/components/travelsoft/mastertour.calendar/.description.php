<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => 'Календарь туров',
	"DESCRIPTION" => 'Календарь туров',
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
