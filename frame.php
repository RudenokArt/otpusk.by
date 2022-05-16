<?define("NOT_FLOAT_RIGHT", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("frame");
?>
<div id="search-forms-iframe-block"><span>Идет загрузка формы поиска...</span></div>
<div id="search-result-iframe-block"><span>Идет загрузка результатов поиска...</span></div>
<script src="https://vetliva.ru/travelsoft.pm/assets/js/module/namespace.js?155"></script>
                    <script src="https://vetliva.ru/travelsoft.pm/assets/js/module/const.js?156"></script>
                    <script src="https://vetliva.ru/travelsoft.pm/assets/js/module/frames.js?216"></script>
                    <script src="https://vetliva.ru/travelsoft.pm/assets/js/module/init.js?164"></script>

<script>
                        
						Travelsoft.init({
							afterLoadingPage: false,
                            display: {

                                forms: {
                                    types: ["placements", "sanatorium"],
									active: "placements",
                                    url: ["https://www.otpusk.by/frame.php"]
                                },
								searchResult: {

                                    type: "placements",
                                    numberPerPage: 10
								}
                            }
});
                    </script>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>