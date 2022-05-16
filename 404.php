<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("ROBOTS", "noindex, nofollow");

$APPLICATION->SetTitle("Страница не найдена");
?>
<style>
	.col-sm-8.col-md-9 {width:100%}
	.map-columns {width:100%}
</style>
<center><div style="top:50px;position: relative ; font-size:220%; line-height:40px; padding-bottom:200px">
<h2>К сожалению, такой страницы не существует.
<br>
Вероятно, она была удалена, или её здесь никогда не было...
<br><br>
<a style="color:#125797" href="/">Вернуться на главную страницу</a>
	</h2></div></center>
<?
$APPLICATION->IncludeComponent(
	"bitrix:main.map", 
	"sitemap", 
	array(
		"LEVEL" => "2",
		"COL_NUM" => "5",
		"SHOW_DESCRIPTION" => "N",
		"SET_TITLE" => "N",
		"CACHE_TIME" => "3600",
		"COMPONENT_TEMPLATE" => "sitemap",
		"CACHE_TYPE" => "A"
	),
	false
);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>