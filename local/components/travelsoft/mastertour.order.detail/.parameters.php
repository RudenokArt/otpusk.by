<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$rsET = CEventType::GetList(array('LID' => 'ru'));
while ($arET = $rsET->Fetch()) {
   $mailEv[$arET['EVENT_NAME']] = "[" . $arET['EVENT_NAME'] . "]" . $arET['NAME'];
}

$arComponentParameters = array(
	"PARAMETERS" => array(
		"QUERY_ADDRESS_BOOKING" => array(
			"PARENT" => "BASE",
			"NAME" => 'Адрес запроса для бронирования услуги',
			"TYPE" => "STRING",
			"DEFAULT" => "http://booking2.otpusk.by:8080/SearchTour/json_handler.ashx"
		),
		"PAYMENT_PAGE" => array(
			"PARENT" => "BASE",
			"NAME" => 'Страница оплаты',
			"TYPE" => "STRING",
			"DEFAULT" => "/personal/payment/"
		),
        "PAGE_ORDER_LIST" => array(
            "PARENT" => "BASE",
            "NAME" => 'Страница списка заказов',
            "TYPE" => "STRING",
            "DEFAULT" => "/personal/"
        ),
		"MAIL_EVENT" => array(
			"PARENT" => "BASE",
			"TYPE" => "LIST",
			"NAME" => 'Тип почтового события для отправки письма',
			"VALUES" => $mailEv,
			"REFRESH" => "Y"
		),
	)	
);

if ($arCurrentValues['MAIL_EVENT'] != "") {
	$resMT = CEventMessage::GetList($by="site_id", $order="desc", array('TYPE_ID' => $arCurrentValues['MAIL_EVENT']));

	while ($arMT = $resMT->Fetch()) {
	   $mailTmpl[$arMT['ID']] = "[" . $arMT['ID'] . "]" . $arMT['SUBJECT'];
	}

	if ($mailTmpl) {
		$arComponentParameters['PARAMETERS']['MAIL_USER_TEMPLATE'] = array(
				"PARENT" => "BASE",
				"TYPE" => "LIST",
				"NAME" => 'Шаблон письма для пользователя',
				"VALUES" => $mailTmpl
			);
		$arComponentParameters['PARAMETERS']['MAIL_MANAGER_TEMPLATE'] = array(
				"PARENT" => "BASE",
				"TYPE" => "LIST",
				"NAME" => 'Шаблон письма для менеджера',
				"VALUES" => $mailTmpl
			);

		$arComponentParameters['PARAMETERS']['MANAGER_EMAIL'] = array(
				"PARENT" => "BASE",
				"TYPE" => "STRING",
				"NAME" => 'Email менеджера',
			);
	} 
}