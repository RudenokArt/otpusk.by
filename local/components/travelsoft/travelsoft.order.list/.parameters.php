<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentParameters = array(
	"PARAMETERS" => array(
		"QUERY_ADDRESS" => array(
			"PARENT" => "BASE",
			"NAME" => 'Адрес запроса на получение списка заказов',
			"TYPE" => "STRING",
			"DEFAULT" => "http://booking2.otpusk.by:8080/TSMO/json_handler.ashx"
		),
		"PAYMENT_ADDRESS" => array(
			"PARENT" => "BASE",
			"NAME" => 'Шаблон адреса запроса на страницу оплаты (#ORDER_ID# - будет заменён на номер заказа) ',
			"TYPE" => "STRING",
			"DEFAULT" => "/personal/payment/?ticket=#ORDER_ID#"
		)
	)	
);
