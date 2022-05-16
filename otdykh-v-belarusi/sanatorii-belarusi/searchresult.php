<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Отдых в санаториях Беларуси 2021");
?>
<div class="form-tabs">
	<div class="tab1"><a class="active btn btn-primary" href="#tab1">Цена для граждан РБ</a></div>
	<div class="tab5"><a class="btn btn-primary" href="#tab2">Цена для граждан РФ</a></div>
	<div class="tab4" style="min-width:380px;"><a class="btn btn-primary" href="#tab3">Цена для граждан Европы и др. стран</a></div>
</div>
<script>
                (function ($) {
                    var formIDS = ['#tab1', "#tab2", "#tab3"];
                    $(document).on('click', 'a[href="' + formIDS[0] + '"], a[href="' + formIDS[1] + '"], a[href="' + formIDS[2] + '"]', function (e) {

                        var t = $(this), actClass = "active", id = t.attr('href');

                        if (t.hasClass(actClass)) return false;

                        t.closest('.form-tabs').find('.' + actClass).removeClass(actClass);

                        $(formIDS[0] + ', ' + formIDS[1] + ', ' + formIDS[2]).hide();

                        $(id).show();

                        t.addClass(actClass);
                        e.preventDefault();
                    });
                })(jQuery);
</script>
<script src="https://vetliva.ru/travelsoft.pm/assets/js/bundles/init.js"></script>
<div id="tab1">
    <div id="search-result-iframe-block-905"><span>Идет загрузка результатов поиска...</span></div>
    <script>
        Travelsoft.init({
            searchResult: {
                insertion_id: "search-result-iframe-block-905",
                type: "sanatorium",
				citizen_price: "333",
                numberPerPage: 20,
                agent: "1094",
                hash: "1c44b8a5c418ccd52725c222bd11c6c7",
                mainIframeCss: ".btn-primary,.show-offers,.thumbnail{border-radius:0;font-size:13px}.show-offers{opacity:1;background:#EB5019;border-color:#EB5019;color:#FFF!important;padding:8px 12px 7px}.thumbnail{background:#FFF;-webkit-box-shadow:0 0 5px -1px rgba(0,0,0,.2);-moz-box-shadow:0 0 5px -1px rgba(0,0,0,.2);box-shadow:0 0 5px -1px rgba(0,0,0,.2);margin-bottom:30px;o-transition:all .3s ease-out;-ms-transition:all .3s ease-out;-moz-transition:all .3s ease-out;-webkit-transition:all .3s ease-out;line-height:22px;font-family:Arial,sans-serif;color:#3f3f3f}.glyphicon{width:20px;height:20px;line-height:20px;border-radius:50%;background:#EB5019;color:#FFF;text-align:center;font-size:10px}p{font-size:13px}.panel-title{font-size:22px;font-size:17px;color:#333}.panel-group .panel{border-radius:0}.panel-heading{border-top-left-radius:0;border-top-right-radius:0}.container{width: 100%;}"
            }
        });
    </script>
</div>
<div style="display: none" id="tab2">
<div id="search-result-iframe-block-268"><span>Идет загрузка результатов поиска...</span></div>
                    <script>
						$("a[href='#tab2']").one("click", function () {
							setTimeout(function () {

Travelsoft.init({
								afterLoadingPage: false,
								searchResult: {
									insertion_id: "search-result-iframe-block-268",
									type: "sanatorium",
									numberPerPage: 20,
									citizen_price: "332",
									agent: "1094",
									hash: "1c44b8a5c418ccd52725c222bd11c6c7",
									mainIframeCss: ".btn-primary,.show-offers,.thumbnail{border-radius:0;font-size:13px}.show-offers{opacity:1;background:#EB5019;border-color:#EB5019;color:#FFF!important;padding:8px 12px 7px}.thumbnail{background:#FFF;-webkit-box-shadow:0 0 5px -1px rgba(0,0,0,.2);-moz-box-shadow:0 0 5px -1px rgba(0,0,0,.2);box-shadow:0 0 5px -1px rgba(0,0,0,.2);margin-bottom:30px;o-transition:all .3s ease-out;-ms-transition:all .3s ease-out;-moz-transition:all .3s ease-out;-webkit-transition:all .3s ease-out;line-height:22px;font-family:Arial,sans-serif;color:#3f3f3f}.glyphicon{width:20px;height:20px;line-height:20px;border-radius:50%;background:#EB5019;color:#FFF;text-align:center;font-size:10px}p{font-size:13px}.panel-title{font-size:22px;font-size:17px;color:#333}.panel-group .panel{border-radius:0}.panel-heading{border-top-left-radius:0;border-top-right-radius:0}.container{width: 100%;}"
	
								}
							});
}, 300);

						});

                    </script>
</div>
<div style="display: none" id="tab3">
<div id="search-result-iframe-block-12"><span>Идет загрузка результатов поиска...</span></div>
    <script>
$("a[href='#tab3']").one("click", function () {
							setTimeout(function () {
        Travelsoft.init({
			afterLoadingPage: false,
            searchResult: {
                insertion_id: "search-result-iframe-block-12",
                type: "sanatorium",
				citizen_price: "356",
                numberPerPage: 20,
                agent: "1094",
                hash: "1c44b8a5c418ccd52725c222bd11c6c7",
                mainIframeCss: ".btn-primary,.show-offers,.thumbnail{border-radius:0;font-size:13px}.show-offers{opacity:1;background:#EB5019;border-color:#EB5019;color:#FFF!important;padding:8px 12px 7px}.thumbnail{background:#FFF;-webkit-box-shadow:0 0 5px -1px rgba(0,0,0,.2);-moz-box-shadow:0 0 5px -1px rgba(0,0,0,.2);box-shadow:0 0 5px -1px rgba(0,0,0,.2);margin-bottom:30px;o-transition:all .3s ease-out;-ms-transition:all .3s ease-out;-moz-transition:all .3s ease-out;-webkit-transition:all .3s ease-out;line-height:22px;font-family:Arial,sans-serif;color:#3f3f3f}.glyphicon{width:20px;height:20px;line-height:20px;border-radius:50%;background:#EB5019;color:#FFF;text-align:center;font-size:10px}p{font-size:13px}.panel-title{font-size:22px;font-size:17px;color:#333}.panel-group .panel{border-radius:0}.panel-heading{border-top-left-radius:0;border-top-right-radius:0}.container{width: 100%;}"
            }
        });
}, 100);

						});

    </script>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>