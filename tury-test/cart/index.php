<?define('NOT_FLOAT_RIGHT', true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Детали заказа");
?>
<?$APPLICATION->IncludeComponent(
	"travelsoft:mastertour.order.detail",
	"order.detail", 
	array(
		"COMPONENT_TEMPLATE" => "order.detail",
		"QUERY_ADDRESS_BOOKING" => "http://booking2.otpusk.by:8080/SearchTour/json_handler.ashx",
		"PAYMENT_PAGE" => "/personal/payment/",
		"MAIL_EVENT" => "TRAVELSOFT_BOOKING",
		"MAIL_USER_TEMPLATE" => "60",
		"MAIL_MANAGER_TEMPLATE" => "61",
		"EMAIL_MANAGER" => "sale@ck.by",
		"MANAGER_EMAIL" => "sale@ck.by"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>