<?define("NOT_FLOAT_RIGHT", true);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оплата");
?><?$APPLICATION->IncludeComponent(
	"travelsoft:travelsoft.order.payment", 
	"order.payment", 
	array(
		"CARD_PAYMENT_ADDRESS" => "https://booking2.otpusk.by/Assist/Payment/Pay?orderCode=#ORDER_ID#&method=login",
		"ORDER_LIST_PAGE" => "/personal/",
		"PAYMENTS" => array(
			0 => "CARD",
			1 => "ERIP",
			2 => "CASH",
		),
		"QUERY_ADDRESS" => "https://booking2.otpusk.by/TSMO/json_handler.ashx",
		"COMPONENT_TEMPLATE" => "order.payment",
		"ERIP_PAYMENT_ADDRESS" => "https://booking2.otpusk.by/Assist/Payment/Pay?orderCode=#ORDER_ID#&method=login&typePayment=erip"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>