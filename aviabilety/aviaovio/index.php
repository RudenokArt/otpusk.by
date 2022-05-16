<?define('NOT_FLOAT_RIGHT', true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Билеты на самолет из Минска 2019, стоимость. Купить дешевые авиабилеты в Беларуси онлайн, цены");
$APPLICATION->SetPageProperty("keywords", "Продажа авиабилетов");
$APPLICATION->SetPageProperty("description", "Продажа авиабилетов в Минске и других городах. Звоните!");
$APPLICATION->SetTitle("Авиабилеты");
?>
<span style="font-size: 14pt;">Приобрести билеты Вы можете в </span><a href="https://www.otpusk.by/aviabilety/aviakassy/">
<span style="font-size: 14pt;">авиакассах</span></a>
<span style="font-size: 12pt;"> <span style="font-size: 14pt;"> предприятия</span>.</span>


<div id="waavo-insert-iframe" class="waavo-iframes" data-cookie-agreement="1" data-https="true" data-host="otpuskby.waavo.com" data-language="rus" data-url="/flights_search"></div>
<script type="text/javascript" src="https://www.waavo.com/js/waavo_loader.min.js"></script>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>