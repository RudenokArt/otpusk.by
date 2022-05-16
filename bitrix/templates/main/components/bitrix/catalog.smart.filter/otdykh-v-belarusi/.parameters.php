<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters["HIDE_RESET_IN_FILTER"] = array(
	'NAME' => "Скрывать возможность сбросить фильтр",
	'TYPE' => 'CHECKBOX',
	'MULTIPLE' => 'N',
	'ADDITIONAL_VALUES' => 'N',
	'REFRESH' => 'N',
	'VALUES' => 'Y',
);

$arTemplateParameters["HIDE_COUNTRY_IN_FILTER"] = array(
	'NAME' => "Скрывать страны в фильтре",
	'TYPE' => 'CHECKBOX',
	'MULTIPLE' => 'N',
	'ADDITIONAL_VALUES' => 'N',
	'REFRESH' => 'N',
	'VALUES' => 'Y',
);

$arTemplateParameters["HIDE_TOURTYPE_IN_FILTER"] = array(
	'NAME' => "Скрывать тип тура в фильтре",
	'TYPE' => 'CHECKBOX',
	'MULTIPLE' => 'N',
	'ADDITIONAL_VALUES' => 'N',
	'REFRESH' => 'N',
	'VALUES' => 'Y',
);

$arTemplateParameters["HIDE_TRANSPORT_IN_FILTER"] = array(
	'NAME' => "Скрывать тип трпнспорта в фильтре",
	'TYPE' => 'CHECKBOX',
	'MULTIPLE' => 'N',
	'ADDITIONAL_VALUES' => 'N',
	'REFRESH' => 'N',
	'VALUES' => 'Y',
);

$arTemplateParameters["SHOW_TYPE_OF_EXCURSIONS"] = array(
	'NAME' => "Показывать тип экскурсий(для фильтра по турам)",
	'TYPE' => 'CHECKBOX',
	'MULTIPLE' => 'N',
	'ADDITIONAL_VALUES' => 'N',
	'REFRESH' => 'N',
	'VALUES' => 'Y',
);

$arTemplateParameters["DURATION_TITLE"] = array(
	'NAME' => "Продолжительность ...",
	'TYPE' => 'TEXT',
	'MULTIPLE' => 'N',
	'ADDITIONAL_VALUES' => 'N',
	'REFRESH' => 'N',
	'DEFAULT' => 'ночей',
);