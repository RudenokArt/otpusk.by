<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Туры и экскурсии 2018");
?>

    <div id="search-result-iframe-block-963"><span>Идет загрузка результатов поиска...</span></div>
    <script src="https://vetliva.ru/travelsoft.pm/assets/js/bundles/init.js"></script>
    <script>
        Travelsoft.init({
            searchResult: {
                insertion_id: "search-result-iframe-block-963",
                type: "excursions",
                numberPerPage: 10,
                agent: "1094",
                hash: "1c44b8a5c418ccd52725c222bd11c6c7",
                mainIframeCss: ".btn-primary,.show-offers,.thumbnail{border-radius:0;font-size:13px}.show-offers{opacity:1;background:#EB5019;border-color:#EB5019;color:#FFF!important;padding:8px 12px 7px}.thumbnail{background:#FFF;-webkit-box-shadow:0 0 5px -1px rgba(0,0,0,.2);-moz-box-shadow:0 0 5px -1px rgba(0,0,0,.2);box-shadow:0 0 5px -1px rgba(0,0,0,.2);margin-bottom:30px;o-transition:all .3s ease-out;-ms-transition:all .3s ease-out;-moz-transition:all .3s ease-out;-webkit-transition:all .3s ease-out;line-height:22px;font-family:Arial,sans-serif;color:#3f3f3f}.glyphicon{width:20px;height:20px;line-height:20px;border-radius:50%;background:#EB5019;color:#FFF;text-align:center;font-size:10px}p{font-size:13px}.panel-title{font-size:22px;font-size:17px;color:#333}.panel-group .panel{border-radius:0}.panel-heading{border-top-left-radius:0;border-top-right-radius:0}.container{width: 100%;}"
            }
        });
    </script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>