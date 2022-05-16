<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters['INC_ISOTOPE'] = array(
	'PARENT' => 'VISUAL',
	'NAME' => "Подключать isotope.js",
	'TYPE' => 'CHECKBOX',
	'VALUES' => 'Y'
);


$arTemplateParameters['SO_TITLE'] = array(
	'PARENT' => 'VISUAL',
	'NAME' => "Заголовок блока",
	'TYPE' => 'TEXT'
);

$arTemplateParameters['MARKER_AJAX'] = array(
	'PARENT' => 'VISUAL',
	'NAME' => "Объект для запроса ajax",
	'TYPE' => 'TEXT'
);