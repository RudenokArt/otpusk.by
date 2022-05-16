<?define("NOT_FLOAT_RIGHT", true);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");?><?$APPLICATION->IncludeComponent(
	"travelsoft:travelsoft.search.result", 
	"placement-result", 
	array(
		"QUERY_ADDRESS" => "https://booking2.otpusk.by/TSSE/json_handler.ashx",
		"COMPONENT_TEMPLATE" => "placement-result"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>