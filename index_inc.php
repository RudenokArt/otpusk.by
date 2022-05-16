<script type="text/javascript" src="//tourvisor.ru/module/init.js"></script>
<div class="flexslider-hero-slider" style="height: 520px !important;">
    <? $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "main.slider",
        array(
            "DISPLAY_DATE" => "N",
            "DISPLAY_NAME" => "N",
            "DISPLAY_PICTURE" => "N",
            "DISPLAY_PREVIEW_TEXT" => "N",
            "AJAX_MODE" => "N",
            "IBLOCK_TYPE" => "otpusk",
            "IBLOCK_ID" => "16",
            "NEWS_COUNT" => "20",
            "SORT_BY1" => "ACTIVE_FROM",
            "SORT_ORDER1" => "DESC",
            "SORT_BY2" => "SORT",
            "SORT_ORDER2" => "ASC",
            "FILTER_NAME" => "",
            "FIELD_CODE" => array(
                0 => "ID",
                1 => "NAME",
                2 => "PREVIEW_PICTURE",
                3 => "",
            ),
            "PROPERTY_CODE" => array(
                0 => "BRIEFLY",
                1 => "LINK",
                2 => "DESCRIPTION",
                3 => "",
            ),
            "CHECK_DATES" => "Y",
            "DETAIL_URL" => "",
            "PREVIEW_TRUNCATE_LEN" => "",
            "ACTIVE_DATE_FORMAT" => "d.m.Y",
            "SET_TITLE" => "N",
            "SET_BROWSER_TITLE" => "N",
            "SET_META_KEYWORDS" => "N",
            "SET_META_DESCRIPTION" => "N",
            "SET_LAST_MODIFIED" => "N",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "ADD_SECTIONS_CHAIN" => "N",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "PARENT_SECTION" => "",
            "PARENT_SECTION_CODE" => "",
            "INCLUDE_SUBSECTIONS" => "N",
            "CACHE_TYPE" => "N",
            "CACHE_TIME" => "3600",
            "CACHE_FILTER" => "N",
            "CACHE_GROUPS" => "N",
            "DISPLAY_TOP_PAGER" => "N",
            "DISPLAY_BOTTOM_PAGER" => "N",
            "PAGER_TITLE" => "Новости",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => "",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "SET_STATUS_404" => "N",
            "SHOW_404" => "N",
            "MESSAGE_404" => "",
            "PAGER_BASE_LINK" => "",
            "PAGER_PARAMS_NAME" => "arrPager",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "N",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "COMPONENT_TEMPLATE" => "main.slider"
        ),
        false
    ); ?>
    <div class="main-search-wrapper full-width">
        <div class="inner">

            <? /*if ($GLOBALS['USER']->IsAdmin()):*/ ?>
            <!-- FORM TABS -->
            <div class="form-tabs">
				<div class="tab5"><a class="btn btn-primary active" href="#sanatorium-form-area">Санатории<br>Беларуси</a></div>
                <div class="tab1"><a class="btn btn-primary" href="#mt-sanatorii-form">Санатории<br>за рубежом</a></div>
				<div class="tab1"><a class="btn btn-primary" href="#avia-form">Авиатуры</a></div>
                <!--<div class="tab2"><a class="btn btn-primary" href="#mt-hotels-form">Гостиницы</a></div>-->
                <? //if ($USER->IsAdmin()):?>
                <!--<div class="tab3"><a class="btn btn-primary" href="#ti-form">Туры</a></div>-->
                <? //endif?>
                <!--<div class="tab4"><a class="active btn btn-primary" href="#master-form">Авиатуры</a></div>-->
                <!--<div class="tab6"><a class="btn btn-primary" href="/tury/grafik-turov/">Автобусные туры</a></div>-->
                <?
//global $USER;
//                if ($USER->IsAdmin()): ?>
                <!--<div class="tab9"><a class="btn btn-primary" href="#busmaster-form">Автобусные<br>туры</a></div>-->
                <!--<div class="tab7"><a class="btn btn-primary" href="#excursions-form-area">Экскурсии<br>по Беларуси</a></div>
                <div class="tab8"><a class="btn btn-primary" href="#placements-form-area">Размещение<br>в Беларуси</a></div>-->
				<?// endif; ?>
            </div>
            <script>
                (function ($) {
                    var formVetliva = ['#sanatorium-form-area', "#excursions-form-area", "#placements-form-area"];
                    var formIDS = ['#mt-sanatorii-form', "#vetliva-form", "#mt-hotels-form", '#ti-form', '#master-form', '#busmaster-form', "", "", "", "#avia-form"];
                    $(document).on('click', 'a[href="' + formIDS[0] + '"], a[href="' + formIDS[1] + '"], a[href="' + formIDS[2] + '"], a[href="' + formIDS[3] + '"], a[href="' + formIDS[4] + '"], a[href="' + formIDS[5] + '"], a[href="' + formIDS[9] + '"], a[href="' + formVetliva[0] + '"], a[href="' + formVetliva[1] + '"], a[href="' + formVetliva[2] + '"]', function (e) {

                        var t = $(this), actClass = "active", id = t.attr('href');

                        if (t.hasClass(actClass)) return false;

                        t.closest('.form-tabs').find('.' + actClass).removeClass(actClass);

                        $(formIDS[0] + ', ' + formIDS[1] + ', ' + formIDS[2] + ', ' + formIDS[3] + ', ' + formIDS[4] + ', ' + formIDS[5] + ', ' + formIDS[9]).hide();
                        $(formVetliva[0] + ', ' + formVetliva[1] + ', ' + formVetliva[2]).hide();

                        $(id).show();

                        t.addClass(actClass);
                        e.preventDefault();
                    });
                })(jQuery);
            </script>
            <!-- END FORM TABS -->
            <? //if ($USER->IsAdmin()):?>
            <div style="display: block" id="sanatorium-form-area">
                <div id="search-forms-iframe-block-920"><span>Идет загрузка формы поиска...</span></div>
                <div class="clear"></div>
            </div>

            <div style="display: none" id="excursions-form-area">
                <div id="search-forms-iframe-block-4"><span>Идет загрузка формы поиска...</span></div>
                <div class="clear"></div>
            </div>

            <div style="display: none" id="placements-form-area">
                <div id="search-forms-iframe-block-693"><span>Идет загрузка формы поиска...</span></div>
                <div class="clear"></div>
            </div>
            <? //endif?>

			<div style="display: none" id="avia-form">
                <!-- Код с Tourvisor -->
				<div class="tv-search-form tv-moduleid-200669"></div>
                <div class="clear"></div>
            </div>

            <div style="display: none" id="mt-sanatorii-form">
                <!-- mastertour search form -->
                <?if($GLOBALS["USER"]->IsAdmin()):?>
                    <? $APPLICATION->IncludeComponent(
                        "travelsoft:form.search",
                        "placement-seperated-form-new",
                        array(
                            "ADDITIONAL_SEARCH" => array(
                                0 => "COUNTRY_12",
                                1 => "TOWN_11",
                                2 => "REGIONS_56",
                            ),
                            "COMPONENT_TEMPLATE" => "placement-seperated-form",
                            "IBLOCK_ID" => "14",
                            "IBLOCK_TYPE" => "otpusk",
                            "PROPERTY_CODE" => array(
                                0 => "TYPE_ID",
                                1 => "MT_HOTELKEY",
                                2 => "CN_KEY"
                            ),
                            "QUERY_ADDRESS" => "/oteli/search.php",
                            "SECTION_ID" => "167"
                        ),
                        false
                    ); ?>
                <?else:?>
                <? $APPLICATION->IncludeComponent(
                    "travelsoft:form.search",
                    "placement-seperated-form",
                    array(
                        "ADDITIONAL_SEARCH" => array(
                            0 => "COUNTRY_12",
                            1 => "TOWN_11",
                            2 => "REGIONS_56",
                        ),
                        "COMPONENT_TEMPLATE" => "placement-seperated-form",
                        "IBLOCK_ID" => "14",
                        "IBLOCK_TYPE" => "otpusk",
                        "PROPERTY_CODE" => array(
                            0 => "TYPE_ID",
                            1 => "MT_HOTELKEY",
                            2 => "CN_KEY"
                        ),
                        "QUERY_ADDRESS" => "/oteli/search.php",
                        "SECTION_ID" => "167"
                    ),
                    false
                ); ?>
                <?endif?>
                <div class="clear"></div>
            </div>

            <div style="display: none" id="mt-hotels-form">
                <!-- mastertour search form -->
                <? $APPLICATION->IncludeComponent(
                    "travelsoft:form.search",
                    "placement-form",
                    array(
                        "ADDITIONAL_SEARCH" => array(
                            0 => "COUNTRY_12",
                            1 => "TOWN_11",
                            2 => "REGIONS_56",
                        ),
                        "COMPONENT_TEMPLATE" => "placement-form",
                        "IBLOCK_ID" => "14",
                        "IBLOCK_TYPE" => "otpusk",
                        "PROPERTY_CODE" => array(
                            0 => "TYPE_ID",
                            1 => "MT_HOTELKEY",
                            2 => "CN_KEY",
                            3 => "CAT_ID"
                        ),
                        "QUERY_ADDRESS" => "/oteli/search.php",
                        "SECTION_ID" => "168"
                    ),
                    false
                ); ?>
                <div class="clear"></div>
            </div>
            <div style="display: none"  id="ti-form">
<? $APPLICATION->IncludeComponent(
	"travelsoft:tour.index.search.form_",
	"search-form",
	array(
		"COMPONENT_TEMPLATE" => "search-form",
		"CITY_FROM" => "",
		"COUNTRY_FROM" => "",
		"DATE_FROM" => "",
		"DATE_TO" => "",
		"NIGHT_FROM" => "7",
		"NIGHT_TO" => "14",
		"ACTION_URL" => "/tury/avia-tury/"
	),
	false
); ?>
	<div class="clear"></div>
	</div>
            <!-- MasterTour search form -->
            <div id="master-form" style="display: none">
                <? $APPLICATION->IncludeComponent(
                    "travelsoft:mastertour.search.form",
                    "search-form",
                    array(
                        "COMPONENT_TEMPLATE" => "search-form",
                        "CITY_FROM" => "1863",
                        "COUNTRY_FROM" => "12",
                        "DATE_FROM" => "",
                        "DATE_TO" => "",
                        "NIGHT_FROM" => "7",
                        "NIGHT_TO" => "14",
                        "ACTION_URL" => "/tury/avia-tury/"
                    ),
                    false
                ); ?>
                <div class="clear"></div>
            </div>
            <? /*else:?>
<!-- форма для происка по tourIndex -->
<?$APPLICATION->IncludeComponent(
"travelsoft:tour.index.search.form",
"search-form",
array(
"COMPONENT_TEMPLATE" => "search-form",
"CITY_FROM" => "668",
"COUNTRY_FROM" => "25",
"DATE_FROM" => "",
"DATE_TO" => "",
"NIGHT_FROM" => "7",
"NIGHT_TO" => "14",
"ACTION_URL" => "/tury/avia-tury/"
),
false
);?>
<?endif*/ ?>

                <div style="display: none" id="busmaster-form">
                        <?$APPLICATION->IncludeComponent(
                            "travelsoft:infoblock.search.form_",
                            "bus-form",
                            Array(

                            )
                        );?>
                        <?/*$APPLICATION->IncludeComponent(
                            "travelsoft:infoblock.search.form",
                            "bus-form",
                            Array(

                            )
                        );*/?>

                    <?/* $APPLICATION->IncludeComponent(
                        "travelsoft:busmastertour.search.form",
                        "search-form-new",
                        array(
                            "COMPONENT_TEMPLATE" => "search-form-new",
                            "CITY_FROM" => "0",
                            "COUNTRY_FROM" => "0",
                            "DATE_FROM" => "",
                            "DATE_TO" => "",
                            "NIGHT_FROM" => "1",
                            "NIGHT_TO" => "21",
                            "TYPE_TOUR" => "12",
                            "ACTION_URL" => "/tury/avtobusnye-tury-result/"
                        ),
                        false
                    ); */?>
                    <div class="clear"></div>
                </div>

            <div class="clear"></div>
        </div>
    </div>

</div>

</div>

</div> <!-- ОТКРЫВАЕТСЯ В /bitrix/templates/main/components/bitrix/news.list/main.slider/template.php -->

<script src="https://vetliva.ru/travelsoft.pm/assets/js/bundles/init.js"></script>
<script>
    var formVetliva = ['#sanatorium-form-area', "#excursions-form-area", "#placements-form-area"];
    $("a[href=" + formVetliva[0] + "]").one("click", function () {
        Travelsoft.init({
            afterLoadingPage: false,
            forms: {
                insertion_id: "search-forms-iframe-block-920",
                types: ["sanatorium"],
                active: "sanatorium",
				country: ["6"],
                url: ["https://www.otpusk.by/otdykh-v-belarusi/sanatorii-belarusi/searchresult.php"],
                selectIframeCss: "",
                datepickerIframeCss: "",
                childrenIframeCss: "",
                mainIframeCss: ".btn-search-area button:hover{background-color: #EB5019 !important;border-color: #EB5019;} .btn-search-area button{border-radius: 0 !important; background: #EB5019;border-color: #EB5019;} label{color: #fff;} .form-control{border-radius: 0} .nav-tabs{display: none !important;} body{ background-color:#286090 !important}\t.form-group {margin-bottom: 0px;}.col-md-3, .col-sm-6 {padding-right: 10px;padding-left: 10px;}.tab-content {margin-top: 10px;}label {color: #fff;font-size: 11px;font-weight: normal;}.form-control {cursor: pointer;overflow: hidden;display: inline-block;line-height: 27px !important;height: 40px;border: 0px solid #ccc;}.btn-primary{-webkit-transition:all .3s;-o-transition:all .3s;transition:all .3s;text-transform:uppercase;font-size:13px;letter-spacing:2px;line-height:1;padding:11px 20px;border-width:2px}.container{width: 100%;}"
            }
        });
    });
    $("a[href=" + formVetliva[1] + "]").one("click", function () {
        Travelsoft.init({
            afterLoadingPage: false,
            forms: {
                insertion_id: "search-forms-iframe-block-4",
                types: ["excursions"],
                active: "excursions",
                url: ["https://www.otpusk.by/otdykh-v-belarusi/tury-i-ekskursii/searchresult.php"],
                selectIframeCss: "",
                datepickerIframeCss: "",
                childrenIframeCss: "",
                mainIframeCss: ".btn-search-area button:hover{background-color: #EB5019 !important;border-color: #EB5019;} .btn-search-area button{border-radius: 0 !important; background: #EB5019;border-color: #EB5019;} label{color: #fff;} .form-control{border-radius: 0} .nav-tabs{display: none !important;} body{ background-color:#286090 !important}\t.form-group {margin-bottom: 0px;}.col-md-3, .col-sm-6 {padding-right: 10px;padding-left: 10px;}.tab-content {margin-top: 10px;}label {color: #fff;font-size: 11px;font-weight: normal;}.form-control {cursor: pointer;overflow: hidden;display: inline-block;line-height: 27px !important;height: 40px;border: 0px solid #ccc;}.btn-primary{-webkit-transition:all .3s;-o-transition:all .3s;transition:all .3s;text-transform:uppercase;font-size:13px;letter-spacing:2px;line-height:1;padding:11px 20px;border-width:2px}.container{width: 100%;}"
            }
        });
    });
    $("a[href=" + formVetliva[2] + "]").one("click", function () {
        Travelsoft.init({
            afterLoadingPage: false,
            forms: {
                insertion_id: "search-forms-iframe-block-693",
                types: ["placements"],
                active: "placements",
                url: ["https://www.otpusk.by/otdykh-v-belarusi/gostinnitsy/searchresult.php"],
                selectIframeCss: "",
                datepickerIframeCss: "",
                childrenIframeCss: "",
                mainIframeCss: ".btn-search-area button:hover{background-color: #EB5019 !important;border-color: #EB5019;} .btn-search-area button{border-radius: 0 !important; background: #EB5019;border-color: #EB5019;} label{color: #fff;} .form-control{border-radius: 0} .nav-tabs{display: none !important;} body{ background-color:#286090 !important}\t.form-group {margin-bottom: 0px;}.col-md-3, .col-sm-6 {padding-right: 10px;padding-left: 10px;}.tab-content {margin-top: 10px;}label {color: #fff;font-size: 11px;font-weight: normal;}.form-control {cursor: pointer;overflow: hidden;display: inline-block;line-height: 27px !important;height: 40px;border: 0px solid #ccc;}.btn-primary{-webkit-transition:all .3s;-o-transition:all .3s;transition:all .3s;text-transform:uppercase;font-size:13px;letter-spacing:2px;line-height:1;padding:11px 20px;border-width:2px}.container{width: 100%;}"
            }
        });
    });
    $('a[href=#sanatorium-form-area]').trigger('click');
</script>