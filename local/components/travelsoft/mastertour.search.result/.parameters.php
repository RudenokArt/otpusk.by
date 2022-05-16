<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentParameters = array(
	"GROUPS" => array(
	),
	"PARAMETERS" => array(
		"QUERY_ADDRESS" => array(
			"PARENT" => "BASE",
			"NAME" => 'Адрес запроса на МастерТур',
			"TYPE" => "STRING"
		),
        "QUERY_ADDRESS_SLETAT" => array(
            "PARENT" => "BASE",
            "NAME" => 'Адрес запроса на sletat.ru',
            "TYPE" => "STRING"
        ),
	)
);