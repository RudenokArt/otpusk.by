<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?>
<div id="search-result-iframe-block"><span>Идет загрузка результатов поиска...</span></div>
<script src="https://vetliva.ru/travelsoft.pm/assets/js/bundles/init.js?3"></script>

<script>
	Travelsoft.init({

					searchResult: {
						type: "sanatorium",
						numberPerPage: 10,
						mainIframeCss: ""
					}
		});
</script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>