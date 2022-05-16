<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
//echo "Приносим свои извинения, но в настоящее время раздел закрыт";
//die();
$this->addExternalCss(SITE_TEMPLATE_PATH . "/magnific-popup/magnific-popup.css", true);
$this->addExternalJS(SITE_TEMPLATE_PATH . "/magnific-popup/jquery.magnific-popup.js", true);
$this->addExternalJS("https://maps.google.com/maps/api/js?sensor=false", true);

$page = 1;
$page = $_GET["PAGEN_1"] ? $_GET["PAGEN_1"] : $page;
$arResult["PAGEN_1"] = $page;
?>
<? \Bitrix\Main\Loader::includeModule('travelsoft.currency');
$currency = \Bitrix\Main\Web\Json::encode(\travelsoft\Currency::getInstance()->get('currency'));
$current_currency = \Bitrix\Main\Web\Json::encode(\travelsoft\Currency::getInstance()->get('current_currency'));
$currency_format_decimals = \Bitrix\Main\Config\Option::get('travelsoft.currency', 'currency_format_decimals');
$currency_format_dec_point = \Bitrix\Main\Config\Option::get('travelsoft.currency', 'currency_format_dec_point');
$currency_format_thousands_sep = \Bitrix\Main\Config\Option::get('travelsoft.currency', 'currency_format_thousands_sep'); ?>
<?
Bitrix\Main\Loader::includeModule('iblock');
$iblock_typeTour = 28;
$arTypeTours = array();
$arTypeToursId = array();
$db_typeTour = CIBlockElement::GetList(array("SORT" => "ASC"), Array("IBLOCK_ID" => $iblock_typeTour, "ACTIVE" => "Y", "PROPERTY_SHOW_DESC_VALUE" => "Y"), false, false, Array("ID", "NAME", "PROPERTY_MASTERTOUR_ID", "PROPERTY_SHOW_DESC"));
while ($typeTour = $db_typeTour->GetNext()) {
    if (!empty($typeTour["PROPERTY_MASTERTOUR_ID_VALUE"])) {
        $arTypeTours[$typeTour["ID"]] = array(
            "id" => $typeTour["ID"],
            "name" => $typeTour["NAME"]
        );
        $arTypeToursId[] = (int)$typeTour["PROPERTY_MASTERTOUR_ID_VALUE"];
    }
}
$type = \Bitrix\Main\Web\Json::encode($arTypeToursId);
/*$cityFrom = array();
$dbCity = CIBlockElement::GetList(array("NAME" => "ASC"), array('IBLOCK_ID' => set::CITY_IBLOCK_ID, '!=PROPERTY_MT_HOTELKEY' => false, "PROPERTY_SHOW_FILTER_MT_VALUE" => "Y"), false, false, array('ID', 'NAME', 'PROPERTY_MT_HOTELKEY'));
while($c = $dbCity->Fetch())
{
    $cityFrom[$c["PROPERTY_MT_HOTELKEY_VALUE"]] = $c["NAME"];
}*/
$cityFrom = \Bitrix\Main\Web\Json::encode($arResult["cityList"]);

/*$country = array();
$dbCountry = CIBlockElement::GetList(array("NAME" => "ASC"), array('IBLOCK_ID' => set::COUNTRY_IBLOCK_ID, '!=PROPERTY_CN_KEY' => false, "PROPERTY_SHOW_FILTER_MT_VALUE" => "Y"), false, false, array('ID', 'NAME', 'PROPERTY_CN_KEY'));
while($c = $dbCountry->Fetch())
{
    $country[$c["PROPERTY_CN_KEY_VALUE"]] = $c["NAME"];
}*/
$country = \Bitrix\Main\Web\Json::encode($arResult["countryList"]);
$filter = \Bitrix\Main\Web\Json::encode($arResult["filterList"]);


$session = bitrix_sessid_post();
?>
<div class="container mfp-hide white-popup-block" id="hotel-detail">
    <div class="popup-content"></div>
</div>
<div class="search_area" data-def-params='<?= \Bitrix\Main\Web\Json::encode($arResult); ?>'>
    <div class="col-sm-4 col-md-3">
        <div class="sidebar-header clearfix">
            <h4>Фильтр</h4>
        </div>
        <div class="sidebar-inner">
            <p><? echo "Идет загрузка..." ?></p>
        </div>
    </div>
    <div class="col-sm-8 col-md-9">
        <div class="sorting-wrappper">

            <div class="sorting-header">
                <h3 class="sorting-title uppercase">Список туров</h3>
            </div>

        </div>
        <div class="html_null"><img style="margin: 0 auto;width: 100px; height: 100px"
                                    src="<?= Set::SMALL_PRELOADER ?>"><? /*echo "По Вашему запросу ничего не найдено. Попробуйте изменить параметры поиска."*/ ?>
        </div>
        <div class="ajax-preloader package-list-item-wrapper on-page-result-page">

        </div>
        <div class="pager-wrappper clearfix">
        </div>
    </div>
</div>


<script type="text/javascript" src="<?= $componentPath ?>/js/params.js"></script>
<script type="text/javascript" src="<?= $componentPath ?>/js/search.js"></script>
<script type="text/javascript" src="<?= $componentPath ?>/js/toursfilter.js"></script>
<script type="text/javascript" src="<?= $componentPath ?>/js/utilites.js"></script>

<script>
    var is_admin = false;
</script>

<?if($GLOBALS["USER"]->IsAuthorized() && $GLOBALS["USER"]->IsAdmin()):?>
    <script>
        var is_admin = true;
    </script>
<?endif?>

<script type="text/javascript">

    var currency = JSON.parse('<?=$currency?>'), current_currency = JSON.parse('<?=$current_currency?>'),
        currency_format_decimals = '<?=$currency_format_decimals?>',
        currency_format_dec_point = '<?=$currency_format_dec_point?>',
        currency_format_thousands_sep = '<?=$currency_format_thousands_sep?>';

    function convertCurrency(price=null, in_currency=null, out_currency=null, onlyN=null) {

        if (in_currency == null || in_currency.match(/^\d+$/) === null) {
            in_currency = find(in_currency);
        } else {
            in_currency = currency[in_currency]['id'];
        }
        if (out_currency == null) {
            out_currency = Number(current_currency['id']);
        } else if (out_currency.match(/^\d+$/) === null) {
            out_currency = find(out_currency);
        }

        price = price / currency[in_currency]['course'][currency[out_currency]['iso']];
        if (onlyN)
            return format(price);

        return format(price, currency[out_currency]['iso']);
    }

    function find(find) {

        if (typeof currency[find] !== "undefined") {
            return true;
        } else {
            for (var val in currency) {
                if (currency[val]['iso'] == find) {
                    find = currency[val]['id'];
                    return Number(find);
                }
            }
        }

        return false;
    }

    function format(price, out_currency) {

        new_currency_format_thousands_sep = currency_format_thousands_sep == "" ? " " : currency_format_thousands_sep;
        if (typeof out_currency !== "undefined")
            new_currency_format_thousands_sep += ' ' + out_currency;
        return $.number_format(
            price,
            currency_format_decimals,
            currency_format_dec_point,
            new_currency_format_thousands_sep);

    }

    var ajax_state = true,
        loader = '<img style="margin: 0 auto;width: 100px; height: 100px" src="<?= Set::SMALL_PRELOADER?>">', mapCenter,
        cache = {tours: {}, hotels: {}}, cacheSletat = [], cityList = {}, bx_session_input = '<?=$session?>',
        bx_typetours = '<?=$type?>', bx_cityFrom = '<?=$cityFrom?>', bx_country = '<?=$country?>',
        bx_filter = '<?=$filter?>';

    var arRes = JSON.parse($(".search_area").attr("data-def-params"));
    bx_cityFrom = JSON.parse(bx_cityFrom);
    bx_country = JSON.parse(bx_country);
    bx_filter = JSON.parse(bx_filter);
    bx_typetours = JSON.parse(bx_typetours);

    var $fltr = $(".sidebar-inner"), $srch = $(".package-list-item-wrapper"), $pgn = $(".pager-wrappper"),
        $htmlnull = $(".html_null");

    if (typeof bx_filter === "object" && typeof bx_cityFrom === "object") {
        for (var Arr_cityFrom in bx_cityFrom) {
            if (typeof bx_filter[Arr_cityFrom] === "object")
                cityList[Arr_cityFrom] = bx_cityFrom[Arr_cityFrom];
        }
    }

    function countries_id(params) {

        for (countryid in bx_country){
            if(params.linkId == 163) {
                if(bx_country[countryid].MASTERTOUR == params["country"]){
                    return bx_country[countryid].NAME;
                }
            } else if(params.linkId == 164) {
                if(bx_country[countryid].SLETAT == params["country"]){
                    return bx_country[countryid].NAME;
                }
            }
        }

    }

    function setItems(arCache, arData, country) {

        var i, cnt = arData.length, arItems = [], img = "/bitrix/templates/main/images/nophoto.jpg", prop = [];

        for (i = 0; i < cnt; i++) {

            if ($.inArray(arData[i]["tourType"], bx_typetours) != -1) {

                if (typeof arCache["tours"] !== "undefined" && typeof arCache["tours"][arData[i]["tour"]["id"]] !== "undefined") {

                    arItems[i] = {
                        name: arCache["tours"][arData[i]["tour"]["id"]]["name"],
                        detail: arCache["tours"][arData[i]["tour"]["id"]]["detail"],
                        picture: arCache["tours"][arData[i]["tour"]["id"]]["picture"] ? arCache["tours"][arData[i]["tour"]["id"]]["picture"] : img,
                        property_tour: arCache["tours"][arData[i]["tour"]["id"]]["property"]
                    };

                }
                else {
                    arItems[i] = {
                        name: arData[i]["tour"]["name"],
                        picture: img
                    }
                }

            }
            else {
                if (typeof arCache["hotels"] !== "undefined" && typeof arCache["hotels"][arData[i]["hotel"]["id"]] !== "undefined" && arCache["hotels"][arData[i]["hotel"]["id"]] !== false) {

                    arItems[i] = {
                        name: arCache["hotels"][arData[i]["hotel"]["id"]]["name"] + ' ' + arData[i]["hotel"]["star"],
                        detail: arCache["hotels"][arData[i]["hotel"]["id"]]["detail"],
                        picture: arCache["hotels"][arData[i]["hotel"]["id"]]["picture"] ? arCache["hotels"][arData[i]["hotel"]["id"]]["picture"] : img,
                        property_hotel: arCache["hotels"][arData[i]["hotel"]["id"]]["property"]
                    };

                }
                else {
                    arItems[i] = {
                        name: arData[i]["hotel"]["name"] + ' ' + arData[i]["hotel"]["star"],
                        picture: img
                    }
                }
            }
            arItems[i]["property"] = {
                accm: arData[i]["accm"],
                country: country,
                city: arData[i]["city"]["name"],
                meal: arData[i]["meal"]["name"],
                night: arData[i]["night"],
                roomCat: arData[i]["roomCat"],
                roomType: arData[i]["roomType"],
            };
            arItems[i]["date"] = arData[i]["tourDate"];
            //arItems[i]["prices"] = arData[i]["prices"]["BYN"];
            arItems[i]["prices"] = arData[i]["prices"][current_currency['iso']];
            arItems[i]["defaultRate"] = arData[i]["defaultRate"];
            arItems[i]["defaultCurrenty"] = arData[i]["prices"][arData[i]["defaultRate"]];
            arItems[i]["priceKey"] = arData[i]["priceKey"];

        }
        return arItems;


    }

    function setItemsSletat(arData, arHotels, country) {

        var i, cnt = arData.length, arItems = [], img = "/bitrix/templates/main/images/nophoto.jpg", prop = [];
        for (i = 0; i < cnt; i++) {

            if (typeof arHotels !== "undefined" && typeof arHotels[arData[i]["OfferId"]] !== "undefined") {

                arItems[i] = {
                    name: arHotels[arData[i]["OfferId"]]["name"],
                    detail: arHotels[arData[i]["OfferId"]]["detail"],
                    picture: arHotels[arData[i]["OfferId"]]["picture"] ? arHotels[arData[i]["OfferId"]]["picture"] : img,
                    property_hotel: arHotels[arData[i]["OfferId"]]["property"],
                    sletat: 1
                };

            }
            else {
                arItems[i] = {
                    name: arData[i]["OriginalHotelName"] + ' ' + arData[i]["StarName"],
                    picture: arData[i]["HotelTitleImageUrl"] ? arData[i]["HotelTitleImageUrl"] : img,
                    HotelId: arData[i]["HotelId"],
                    sletat: 1
                }
            }

            arItems[i]["property"] = {
                accm: arData[i]["OriginalHtPlaceName"],
                country: country,
                city: arData[i]["OriginalTownName"],
                meal: arData[i]["MealName"],
                night: arData[i]["Nights"],
                roomType: arData[i]["OriginalRoomName"],
                ticket: arData[i]["TicketsIncluded"],
                hotelisinstop: arData[i]["HotelIsInStop"],
                economticketsdpt: arData[i]["EconomTicketsDpt"],
                economticketsrtn: arData[i]["EconomTicketsRtn"],
                businessticketsdpt: arData[i]["BusinessTicketsDpt"],
                businessticketsrtn: arData[i]["BusinessTicketsRtn"],
                /*roomCat: arData[i]["RoomName"],
                roomType: arData[i]["HtPlaceName"],*/
            };
            arItems[i]["date"] = arData[i]["CheckInDate"];
            //arItems[i]["prices"] = arData[i]["PriceBYN"];
            arItems[i]["prices"] = convertCurrency(arData[i]["Price"], arData[i]["Currency"], current_currency.iso, true);
            arItems[i]["defaultRate"] = arData[i]["Currency"];
            arItems[i]["defaultCurrenty"] = arData[i]["Price"];
            arItems[i]["requestId"] = arData[i]["RequestId"];
            arItems[i]["sourceId"] = arData[i]["SourceId"];
            arItems[i]["offerId"] = arData[i]["OfferId"];

        }
        return arItems;


    }

    function ShowAndHideBlocks() {
        //$srch.html("");
        $pgn.html("");
        //$htmlnull.css("display","block");
    }

    //функция удаления Js фильтра и его Html
    function destroyFilter() {

        var form = $("#filterForm");

        form.find("select").select2('destroy');

        form.find("#date-filter-from, #date-filter-to").datepicker("destroy");

        $fltr.html("<p>Идет загрузка...</p>");
        //$htmlnull.css("display", "block");
        //$srch.html();
        $pgn.html();

    }

    //функция инициализации фильтра
    function init_js_filter(dates) {

        // duration Range Slider
        $("#duration_range").ionRangeSlider({
            type: "double",
            grid: true,
            min: $(this).data("min"),
            max: $(this).data("max"),
            from: $(this).data("from"),
            to: $(this).data("to"),
            prefix: "",
            onFinish: function (v) {
                $("#min-filter-duration").val(v.from), $("#max-filter-duration").val(v.to);
                ShowAndHideBlocks();
                initApp([[mainFilter], [mainFilterSletat]]);
            }
        })

        var form = $("#filterForm"),
            iRS = $("#price_range").data("ionRangeSlider"),
            iRSD = $("#duration_range").data("ionRangeSlider");

        form.find("select[name='country']:nth-child(2)").attr("selected", "selected");

        /**
         * submit формы по checkbox
         */
        form.find("input[type='checkbox']").on("change", function () {
            ShowAndHideBlocks();
            initApp([[mainFilter], [mainFilterSletat]]);
        });

        /**
         * submit формы по select2
         */
        form.find("select").select2({
            "allowClear": true
        }).on("change", function () {
            if ($(this).attr("name") == "cityFrom") {
                var city = $(this).val(), i = 1, tmp_html = '';

                tmp_html += '<option value=""></option>';

                for (Arr_country in bx_filter[city]) {

                    tmp_html += '<option ' + (i == 1 ? 'selected="selected" ' : '') + ' value="' + Arr_country + '">' + bx_country[Arr_country].NAME + '</option>'
                    i++;

                }
                $("#filterForm select[name='country']").html(tmp_html);

            }
            ShowAndHideBlocks();
            initApp([[mainFilter], [mainFilterSletat]]);
        });

        $().append("<>");

        /**
         * datapicker
         */
        if ($("#date-filter-from").length || $("#date-filter-to").length) {
            $("#date-filter-from").datepicker({
                showOtherMonths: !0,
                selectOtherMonths: !0,
                minDate: "0",
                defaultDate: "+7d",
                firstDay: "1",
                dateFormat: "dd.mm.yy",
                dayNamesMin: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
                beforeShowDay: function (date) {
                    if ($.isArray(dates) && dates.length > 0) {
                        var formattedDate = date.toLocaleDateString('pl', {
                            day: '2-digit',
                            year: 'numeric',
                            month: '2-digit'
                        });
                        if ($.inArray(formattedDate, dates) != -1) {
                            return [true, 'active-date bus-day'];
                        }

                    }
                    return [true, ""];
                },
                onSelect: function (selectedDate) {
                    $("#date-filter-to").datepicker("option", "minDate", selectedDate);
                    ShowAndHideBlocks();
                    initApp([[mainFilter], [mainFilterSletat]]);
                }

            });
            $("#date-filter-to").datepicker({
                showOtherMonths: !0,
                selectOtherMonths: !0,
                minDate: $("#date-filter-from").val(),
                defaultDate: "+7d",
                firstDay: "1",
                dateFormat: "dd.mm.yy",
                dayNamesMin: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
                onSelect: function () {
                    ShowAndHideBlocks();
                    initApp([[mainFilter], [mainFilterSletat]]);
                }
            });
        }

    }

    function mainSearch(params) {

        /**
         * searchObject: tours - поиск туров
         *
         */
        $.Search({
            searchObject: "tours",
            parameters: selectParams.selectSearch(params),
            queryAddress: "<?= $arResult['queryAddress']?>",
            beforeStartSearch: function () {
                /**
                 * introLoader - Preloader
                 */
                $("#introLoader").introLoader({
                    animation: {
                        name: 'gifLoader',
                        options: {
                            ease: "easeInOutCirc",
                            style: 'dark bubble',
                            delayBefore: 1000,
                            delayAfter: 0,
                            exitTime: 1000
                        }
                    }
                });
            },
            afterFinishSearch: function () {

                /*setTimeout(function () {
                    $("#introLoader").data("introLoader").stop();

                }, 1000);*/

            },
            renderResult: function (data) {

                //console.log(data);
                //$srch.html("По Вашему запросу ничего не найдено. Попробуйте изменить параметры поиска.");
                if (data === false) {
                    $htmlnull.css("display", "none");
                    $srch.html("По Вашему запросу ничего не найдено. Попробуйте изменить параметры поиска.");
                    return;
                }

                if (typeof cache["tours"] === "undefined") {
                    cache["tours"] = {};
                }
                if (typeof cache["hotels"] === "undefined") {
                    cache["hotels"] = {};
                }

                if (data.length > 0) {

                    var request_data = {}, i, cnt = data.length;

                    for (i = 0; i < cnt; i++) {

                        if (typeof cache["tours"][data[i]["tour"]["id"]] === "undefined") {

                            if (typeof request_data["tours"] === "undefined") {
                                request_data["tours"] = {};
                            }

                            if ($.inArray(data[i]["tourType"], bx_typetours) != -1) {
                                request_data["tours"][data[i]["tour"]["id"]] = data[i]["tour"];
                            }
                        }

                        if (typeof cache["hotels"][data[i]["hotel"]["id"]] === "undefined") {

                            if (typeof request_data["hotels"] === "undefined") {
                                request_data["hotels"] = {};
                            }

                            request_data["hotels"][data[i]["hotel"]["id"]] = data[i]["hotel"];
                        }

                    }

                    var search_country_id = countries_id(selectParams.selectAllParams());

                    if (request_data) {
                        //ajax

                        $.ajax({
                            method: "post",
                            url: "/ajax/get_tours.php",
                            data: {query_data: JSON.stringify(request_data)},
                            dataType: 'json',
                            success: function (items) {

                                // заполнение кеша
                                for (i = 0; i < cnt; i++) {
                                    if (typeof items["tours"] !== "undefined") {
                                        if (typeof cache["tours"][data[i]["tour"]["id"]] === "undefined" && typeof items["tours"][data[i]["tour"]["id"]] !== "undefined") {
                                            cache["tours"][data[i]["tour"]["id"]] = items["tours"][data[i]["tour"]["id"]];
                                        }
                                    }
                                    if (typeof items["hotels"] !== "undefined") {
                                        if (typeof cache["hotels"][data[i]["hotel"]["id"]] === "undefined" && typeof items["hotels"][data[i]["hotel"]["id"]] !== "undefined") {
                                            cache["hotels"][data[i]["hotel"]["id"]] = items["hotels"][data[i]["hotel"]["id"]];
                                        }
                                    }
                                }

                                // отрисовка
                                $htmlnull.css("display", "none");
                                $srch.html(Utilites.getHtmlItems(setItems(items, data, search_country_id)));


                            }
                        });

                    } else {
                        $htmlnull.css("display", "none");
                        $srch.html(Utilites.getHtmlItems(setItems(cache, data, search_country_id)));
                    }
                    /*setTimeout(function () {
                        $("#introLoader").data("introLoader").stop();
                    }, 1000);*/
                }

            },
            ajaxPagenavigation: function (data, render) {

                $pgn.html("");
                if (!render) {
                    return false;
                }

                $.ajax({
                    method: "post",
                    url: "/ajax/pagenavigation.php" + window.location.search,
                    data: {query_data: data},
                    dataType: 'html',
                    success: function (html_paging) {
                        // отрисовка
                        $pgn.html(html_paging);

                    }
                });

            }
        });

    }


    function mainFilter(params) {

        /**
         * filterObject: toursfilter - отрисовка фильтра
         *
         */
        $.Filter({
            filterObject: "toursfilter",
            parameters: selectParams.selectFilter(params),
            queryFilterAddress: "<?= $arResult['queryAddress']?>",
            renderResultFilter: function (data) {

                if (typeof data !== "undefined") {

                    destroyFilter();
                    $fltr.html(Utilites.getHtmlFilter(data));
                    init_js_filter(data["dates"]);

                }
            },
            getRequiredParamsFilter: function (data) {

                var ar_required = {cityFrom: {}, country: {}}, ar_cityFrom = {}, ar_country = {}, i;
                if (typeof data !== "undefined") {
                    if (bx_cityFrom.length > 0) {
                        ar_cityFrom = JSON.parse(bx_cityFrom);
                        for (ArrCityFrom in ar_cityFrom) {
                            ar_required["cityFrom"][ArrCityFrom] = {
                                name: ar_cityFrom[ArrCityFrom],
                                selected: (ArrCityFrom == data.cityFrom ? true : false)
                            }
                        }
                    }
                    if (bx_country.length > 0) {
                        ar_country = JSON.parse(bx_country);
                        for (ArrCountry in ar_country) {
                            ar_required["country"][ArrCountry] = {
                                name: ar_country[ArrCountry],
                                selected: (ArrCountry == data.country ? true : false)
                            }
                        }
                    }

                    return ar_required;

                }

            }
        });

    }

    function mainFilterSletat(params) {

        /**
         * filterObject: hotelsfilter - отрисовка фильтра
         *
         */
        $.Filter({
            filterObject: "hotelsfilter",
            parameters: selectParams.selectFilterSletat(params),
            queryFilterAddress: "<?= $arResult['queryAddressSletat']?>",
            renderResultFilter: function (data) {
                $srch.html();
                $pgn.html();
                if (data == false) {
                    $fltr.html("Произошла ошибка! Приносим свои извинения.");
                } else if (typeof data !== "undefined") {
                    destroyFilter();
                    $fltr.html(Utilites.getHtmlFilterSletat(data));
                    init_js_filter();
                    //init_js_filter(data["dates"]);

                }

            }
        });

    }

    function mainSearchSletat(params) {

        /**
         * searchObject: hotels - поиск туров
         *
         */

        $.Search({
            searchObject: "hotels",
            parameters: selectParams.selectSearchSletat(params),
            queryAddress: "<?= $arResult['queryAddress']?>",
            beforeStartSearch: function () {
                /**
                 * introLoader - Preloader
                 */
                $("#introLoader").introLoader({
                    animation: {
                        name: 'gifLoader',
                        options: {
                            ease: "easeInOutCirc",
                            style: 'dark bubble',
                            delayBefore: 4000,
                            delayAfter: 0,
                            exitTime: 6000
                        }
                    }
                });
            },
            afterFinishSearch: function (item) {

                if (item <= 0) {
                    $htmlnull.css("display", "none");
                    $srch.html("По Вашему запросу ничего не найдено. Попробуйте изменить параметры поиска.");
                }
                /*setTimeout(function () {

                    $("#introLoader").data("introLoader").stop();

                }, 6000);*/

            },
            renderResult: function (data) {

                $pgn.html();

                if (data === false) {
                    $htmlnull.css("display", "none");
                    $srch.html("По Вашему запросу ничего не найдено. Попробуйте изменить параметры поиска.");
                    return;
                }

                if (data.Rows.length > 0) {

                    var cnt = data.Rows.length, rows = [], request_data = [];
                    rows.push(data.RowsCount);

                    for (var i = 0; i < cnt; i++) {

                        if ($.inArray(data.Rows[i]["OfferId"], cacheSletat) === -1) {

                            cacheSletat.push(data.Rows[i]["OfferId"]);
                            request_data.push(data.Rows[i]);

                        }

                    }

                    if (request_data) {

                        var search_country_id = countries_id(selectParams.selectAllParams());

                        for (var j = 0; j < request_data.length; j += 5) {
                            //var req_data = [request_data[j]];
                            var req_data = request_data.slice(j, j + 5);
                            $htmlnull.css("display", "none");
                            $srch.append(Utilites.getHtmlItems(setItemsSletat(req_data, data.bx_hotels, search_country_id)));
                        }

                    }
                }

            }
        });

    }

    function initApp(arrFn) {
        Utilites.currentPage = 1;
        $srch.html();
        $pgn.html();
        var p = selectParams.selectAllParams();

        if (p.linkId == 163) {
            for (var i = 0; i < arrFn[0].length; i++) {
                arrFn[0][i].call(this, p);
            }
            /*mainFilter(p);
            mainSearch(p);*/
        }
        else if (p.linkId == 164) {
            ajax_state = false;
            for (var i = 0; i < arrFn[1].length; i++) {
                arrFn[1][i].call(this, p);
            }
            /* mainFilterSletat(p);
             mainSearchSletat(p);*/
        }


    }

    $(document).on("click", "i.date-filter-to", function (e) {
        e.preventDefault();
        $("#date-filter-to").datepicker("show");
    });
    $(document).on("click", "i.date-filter-from", function (e) {
        e.preventDefault();
        $("#date-filter-from").datepicker("show");
    });

    function updateQueryStringParam(key, value) {
        var baseUrl = [location.protocol, '//', location.host, location.pathname].join('');
        var urlQueryString = document.location.search;
        var newParam = key + '=' + value,
            params = '?' + newParam;

        // If the "search" string exists, then build params from it
        if (urlQueryString) {
            var keyRegex = new RegExp('([\?&])' + key + '[^&]*');
            // If param exists already, update it
            if (urlQueryString.match(keyRegex) !== null) {
                params = urlQueryString.replace(keyRegex, "$1" + newParam);
            } else { // Otherwise, add it to end of query string
                params = urlQueryString + '&' + newParam;
            }
        }
        window.history.replaceState({}, "", baseUrl + params);
    }

    function setUrl(parameters) {
        var baseUrl = [location.protocol, '//', location.host, location.pathname].join('');

        var ct = 558;
        var co = 74;

        var key;

        if (parameters.linkId === 163) {
            for (key in parameters.cityList){
                if(parameters.cityList[key].MASTERTOUR == parameters.cityFrom){
                    ct = key;
                }
            }
            for (key in parameters.countryList){
                if(parameters.countryList[key].MASTERTOUR == parameters.country){
                    co = key;
                }
            }
        }
        else if (parameters.linkId === 164) {
            for (key in parameters.cityList){
                if(parameters.cityList[key].SLETAT == parameters.cityFrom){
                    ct = key;
                }
            }
            for (key in parameters.countryList){
                if(parameters.countryList[key].SLETAT == parameters.country){
                    co = key;
                }
            }
        }

        updateQueryStringParam("ct", ct);
        updateQueryStringParam("co", co);

        if (typeof parameters.stars !== "undefined") {
            parameters.stars.forEach(function(item, i, arr) {
                updateQueryStringParam("stars[]", item);
            });
        }

        if (typeof parameters.meals !== "undefined") {
            parameters.meals.forEach(function(item, i, arr) {
                updateQueryStringParam("meals[]", item);
            });
        }

        if (typeof parameters.CheckIn !== "undefined") {
            updateQueryStringParam("df", parameters.CheckIn);
        }
        if (typeof parameters.CheckOut !== "undefined") {
            updateQueryStringParam("dt", parameters.CheckOut);
        }
        if (typeof parameters.Children !== "undefined") {
            updateQueryStringParam("ch", parameters.Children);
        }
        if (typeof parameters.Adults !== "undefined") {
            updateQueryStringParam("ad", parameters.Adults);
        }
        if (typeof parameters.NightIn !== "undefined") {
            updateQueryStringParam("nf", parameters.NightIn);
        }
        if (typeof parameters.NightOut !== "undefined") {
            updateQueryStringParam("nt", parameters.NightOut);
        }
        if (typeof parameters.age1 !== "undefined") {
            updateQueryStringParam("age1", parameters.age1);
        }
        if (typeof parameters.age2 !== "undefined") {
            updateQueryStringParam("age2", parameters.age2);
        }
        if (typeof parameters.age3 !== "undefined") {
            updateQueryStringParam("age3", parameters.age3);
        }
    }

    //Для фильтра
    $(document).on("click", "a.submit-filter", function (e) {
        e.preventDefault();
        $srch.html("");
        $htmlnull.css("display", "block");
        initApp([[mainSearch], [mainSearchSletat]]);
        var p = selectParams.selectAllParams();
        setUrl(p);
    });

    $(document).on("click", ".pagination a", function (e) {
        e.preventDefault();
        Utilites.currentPage = $(this).data('page');
        var p = selectParams.selectAllParams();
        mainSearch(p);
    });

    initApp([[mainFilter, mainSearch], [mainFilterSletat, mainSearchSletat]]);

</script>
<script>

    var showMagnific = function () {
        $.magnificPopup.open({
            items: {
                src: '#hotel-detail'
            },
            type: 'inline'

            // You may add options here, they're exactly the same as for $.fn.magnificPopup call
            // Note that some settings that rely on click event (like disableOn or midClick) will not work here
        }, 0);

    };

    var cache = {};
    $('.package-list-item-wrapper').on('click', 'a[href*=#hotel-detail]', function (e) {

        var element = $(this);

        var hotelId = element.data("hotelId");

        if (typeof cache[hotelId] === 'string') {
            showMagnific();
            $('.popup-content').html(cache[hotelId]);
        } else {
            // magnific show
            $.ajax({
                method: 'post',
                url: '/ajax/get_one_hotel.php',
                data: {query_data: JSON.stringify(hotelId)},
                success: function (data) {
                    cache[hotelId] = data['html'];
                    showMagnific();
                    $('.popup-content').html(cache[hotelId]);
                }
            });
        }


    });
</script>
<style>
    .white-popup-block {
        background: #FFF;
        padding: 20px 30px;
        text-align: left;
        margin: 40px auto;
        position: relative;
    }
</style>