<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Авиабилеты онлайн");
?>

<div id="waavo-insert-iframe" class="waavo-iframes" data-cookie-agreement="1" data-https="true" data-host="otpuskby.waavo.com" data-language="rus" data-url="/flights_search"></div>
<script type="text/javascript" src="https://www.waavo.com/js/waavo_loader.min.js"></script>


<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>