<?define("NOT_FLOAT_RIGHT", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("График туров");
?>
<?$APPLICATION->SetTitle("");?><?$APPLICATION->IncludeComponent(
	"travelsoft:mastertour.calendar", 
	"placement-result", 
	array(
		"QUERY_ADDRESS" => "http://booking2.otpusk.by:8080/SearchTour/json_handler.ashx",
		"COMPONENT_TEMPLATE" => "placement-result",
		"TYPE_TOURS" => array(
			0 => "12",
			1 => "24",
		)
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>