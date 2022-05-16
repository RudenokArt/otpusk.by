<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentParameters = array(
	"GROUPS" => array(
		"OPT_PAYMENT" => array(
			"NAME" => "Дополнительные настройки для оплаты"
		) 	
	),
	"PARAMETERS" => array(
		"QUERY_ADDRESS" => array(
			"PARENT" => "BASE",
			"NAME" => 'Адрес запроса для получения информации по заказу',
			"TYPE" => "STRING",
			"DEFAULT" => "http://booking2.otpusk.by:8080/TSMO/json_handler.ashx"
		),
		"ORDER_LIST_PAGE" => array(
			"PARENT" => "BASE",
			"NAME" => 'Страница списка заказов',
			"TYPE" => "STRING",
			"DEFAULT" => "/personal/"
		),
		"PAYMENTS" => array(
			"PARENT" => "PAYMENTS",
			"NAME" => 'Варианты оплаты',
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"VALUES" => array(
					'CARD' => "Оплата картой",
					'ERIP' => "Оплата Ерип",
					'CASH' => "Оплата наличными",
					
				)
		),
		"CARD_PAYMENT_ADDRESS" => array(
			"PARENT" => "OPT_PAYMENT",
			"NAME" => 'Шаблон адреса запроса на страницу сервиса оплаты Картой(#ORDER_ID# - будет заменён на номер заказа) ',
			"TYPE" => "STRING",
			"DEFAULT" => "http://booking2.otpusk.by:8080/Assist/Payment/Pay?orderCode=#ORDER_ID#&method=login"
		),
		"ERIP_PAYMENT_ADDRESS" => array(
			"PARENT" => "OPT_PAYMENT",
			"NAME" => 'Шаблон адреса запроса на страницу сервиса оплаты Ерип(#ORDER_ID# - будет заменён на номер заказа) ',
			"TYPE" => "STRING",
			"DEFAULT" => "http://booking2.otpusk.by:8080/Assist/Payment/Pay?orderCode=#ORDER_ID#&method=login&typePayment=erip"
		)
	)	
);