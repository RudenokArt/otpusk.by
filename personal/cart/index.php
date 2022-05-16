<?define('NOT_FLOAT_RIGHT', true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Детали заказа");
?>
<?$flag = false;
$cart = new travelsoft\Cart();
foreach ($cart->get() as $value){
    if($value["INC_TOUR"]){
        $flag = true;
    }
}
?>
<?if($flag):?>
    <?$APPLICATION->IncludeComponent(
        "travelsoft:mastertour.order.detail",
        "order.detail",
        array(
            "COMPONENT_TEMPLATE" => "order.detail",
            "QUERY_ADDRESS_BOOKING" => "https://booking2.otpusk.by/SearchTour/json_handler.ashx",
            "PAYMENT_PAGE" => "/personal/payment/",
            "PAGE_ORDER_LIST" =>"/personal/",
            "MAIL_EVENT" => "TRAVELSOFT_BOOKING",
            "MAIL_USER_TEMPLATE" => "60",
            "MAIL_MANAGER_TEMPLATE" => "61",
            "EMAIL_MANAGER" => "sale@ck.by",
            "MANAGER_EMAIL" => "sale@ck.by"
        ),
        false
    );?>
<?else:?>
    <?$APPLICATION->IncludeComponent(
        "travelsoft:travelsoft.order.detail",
        "order.detail",
        array(
            "COMPONENT_TEMPLATE" => "order.detail",
            "QUERY_ADDRESS_BOOKING" => "https://booking2.otpusk.by/TSSE/json_handler.ashx",
            "QUERY_ADDRESS_TICKET" => "https://booking2.otpusk.by/TSMO/json_handler.ashx",
            "PAYMENT_PAGE" => "/personal/payment/",
            "MAIL_EVENT" => "TRAVELSOFT_BOOKING",
            "MAIL_USER_TEMPLATE" => "60",
            "MAIL_MANAGER_TEMPLATE" => "61",
            "EMAIL_MANAGER" => "sale@ck.by",
            "MANAGER_EMAIL" => "sale@ck.by"
        ),
        false
    );?>
<?endif?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>