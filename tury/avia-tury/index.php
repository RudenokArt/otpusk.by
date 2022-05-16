<?
//@define("NOT_FLOAT_RIGHT", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords", "Авиа туры");
$APPLICATION->SetPageProperty("description", "Большой выбор авиатуров от  компании ЦЕНТРКУРОРТ. Множество направлений. Гарантия государственного туроператора. +375 (17) 215-49-49");
$APPLICATION->SetPageProperty("title", "Авиатуры из Минска 2020 | Подбор авиатура | Список, цены");
$APPLICATION->SetTitle("Авиатуры");
?>
<!-- Код с Tourvisor -->
<script type="text/javascript" src="//tourvisor.ru/module/init.js"></script>
<div class="tv-search-form tv-moduleid-200669"></div>
<div class="clear"></div>


<?/*?>   <script type="text/javascript" language="JavaScript" src="//tourclient.ru/f/jsboot/crm125660/find_tour_form?style=default&conf=default"></script><br>
    <script type="text/javascript" language="JavaScript" src="//tourclient.ru/f/jsboot/crm125660/find_tour_offers?style=default&conf=default"></script>
*/?>

<!--<?/*$APPLICATION->IncludeComponent(
    "travelsoft:mastertour.search.result",
    "placement-result",
    array(
        "QUERY_ADDRESS" => "https://booking2.otpusk.by/SearchTour/json_handler.ashx",
        "QUERY_ADDRESS_SLETAT" => "https://module.sletat.ru/XmlGate.svc?singlewsdl",
        "COMPONENT_TEMPLATE" => "placement-result"
    ),
    false
);*/?>

--><?/*
$APPLICATION->IncludeFile($SERVER["DOCUMENT_ROOT"]."/include/online_order_form.php", Array(), Array(
    "MODE"      => "html",        // будет редактировать в веб-редакторе
    "NAME"      => "Оставить заявку",      // текст всплывающей подсказки на иконке
));
*/?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>