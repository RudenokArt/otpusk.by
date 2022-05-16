<?define("NOT_FLOAT_RIGHT", true);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Персональный раздел");
?><?$APPLICATION->IncludeComponent(
	"travelsoft:travelsoft.order.list",
	"order.list",
	Array(
		"PAYMENT_ADDRESS" => "/personal/payment/?ticket=#ORDER_ID#",
		"QUERY_ADDRESS" => "http://booking2.otpusk.by:8080/TSMO/json_handler.ashx"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>