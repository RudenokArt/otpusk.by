<?
@define("NOT_FLOAT_RIGHT", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?>
   <?$APPLICATION->IncludeComponent(
    "travelsoft:mastertour.search.result",
    "bus-tours",
    array(
        "QUERY_ADDRESS" => "http://booking2.otpusk.by:8080/SearchTour/json_handler.ashx",
        "COMPONENT_TEMPLATE" => "bus-tours",
        "BUS_TOURS" => "Y"
    ),
    false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>