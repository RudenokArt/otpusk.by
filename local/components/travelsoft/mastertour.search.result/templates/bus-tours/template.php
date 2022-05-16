<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

$page = 1;
$page = $_GET["PAGEN_1"] ? $_GET["PAGEN_1"] : $page;
$arResult["PAGEN_1"] = $page;
?>
<?\Bitrix\Main\Loader::includeModule('travelsoft.currency');
$currency = \Bitrix\Main\Web\Json::encode(\travelsoft\Currency::getInstance()->get('currency'));
$current_currency = \Bitrix\Main\Web\Json::encode(\travelsoft\Currency::getInstance()->get('current_currency'));
$currency_format_decimals = \Bitrix\Main\Config\Option::get('travelsoft.currency', 'currency_format_decimals');
$currency_format_dec_point = \Bitrix\Main\Config\Option::get('travelsoft.currency', 'currency_format_dec_point');
$currency_format_thousands_sep = \Bitrix\Main\Config\Option::get('travelsoft.currency', 'currency_format_thousands_sep');?>
<?
Bitrix\Main\Loader::includeModule('iblock');
$iblock_typeTour = 28;
$arTypeTours = array();
$arTypeToursId = array();
$db_typeTour = CIBlockElement::GetList(array("SORT"=>"ASC"), Array("IBLOCK_ID"=>$iblock_typeTour,"ACTIVE"=>"Y", "=PROPERTY_MASTERTOUR_ID"=>12), false, false, Array("ID", "NAME", "PROPERTY_MASTERTOUR_ID", "PROPERTY_SHOW_DESC"));
while ($typeTour = $db_typeTour->GetNext()) {
    if(!empty($typeTour["PROPERTY_MASTERTOUR_ID_VALUE"])){
        $arTypeTours[$typeTour["ID"]] = array(
            "id" => $typeTour["ID"],
            "name" => $typeTour["NAME"]
        );
        $arTypeToursId[] = (int)$typeTour["PROPERTY_MASTERTOUR_ID_VALUE"];
    }
}
$type = \Bitrix\Main\Web\Json::encode($arTypeToursId);
$cityFrom = \Bitrix\Main\Web\Json::encode($arResult["cityList"]);
$country = \Bitrix\Main\Web\Json::encode($arResult["countryList"]);
$filter = \Bitrix\Main\Web\Json::encode($arResult["filterListBus"]);

$session = bitrix_sessid_post();
?>
<div class="search_area" data-def-params='<?= \Bitrix\Main\Web\Json::encode($arResult);?>'>
    <div class="col-sm-4 col-md-3">
        <div class="sidebar-header clearfix">
            <h4>Фильтр</h4>
        </div>
        <div class="sidebar-inner">
            <p><?echo "Идет загрузка..."?></p>
        </div>
    </div>
    <div class="col-sm-8 col-md-9">
        <div class="sorting-wrappper">

            <div class="sorting-header">
                <h3 class="sorting-title uppercase">Список туров</h3>
            </div>

        </div>
        <div class="html_null"><img style="margin: 0 auto;width: 100px; height: 100px" src="<?= Set::SMALL_PRELOADER?>"><?/*echo "По Вашему запросу ничего не найдено. Попробуйте изменить параметры поиска."*/?></div>
        <div class="ajax-preloader package-list-item-wrapper on-page-result-page">

        </div>
        <div class="pager-wrappper clearfix">
        </div>
    </div>
</div>


<script type="text/javascript" src="<?= $componentPath?>/js/params.js"></script>
<script type="text/javascript" src="<?= $componentPath?>/js/search.js"></script>
<script type="text/javascript" src="<?= $componentPath?>/js/toursfilter.js"></script>
<script type="text/javascript" src="<?= $componentPath?>/js/utilites.js"></script>

<script type="text/javascript">

    var currency = JSON.parse('<?=$currency?>'), current_currency = JSON.parse('<?=$current_currency?>'), currency_format_decimals = '<?=$currency_format_decimals?>', currency_format_dec_point = '<?=$currency_format_dec_point?>', currency_format_thousands_sep = '<?=$currency_format_thousands_sep?>';

    function convertCurrency(price=null, in_currency=null, out_currency=null, onlyN=null) {

        if(in_currency == null || in_currency.match(/^\d+$/) === null){
            in_currency = find(in_currency);
        } else {
            in_currency = currency[in_currency]['id'];
        }
        if (out_currency == null) {
            out_currency = Number(current_currency['id']);
        }
        console.log(price, in_currency, out_currency);
        price = price/currency[in_currency]['course'][currency[out_currency]['iso']];
        if (onlyN)
            return price;

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

    function format(price,out_currency) {

        return $.number_format(
                price,
                currency_format_decimals,
                currency_format_dec_point,
                currency_format_thousands_sep == "" ? " " : currency_format_thousands_sep
            ) + " " + out_currency;

    }

	var ajax_state = true, loader = '<img style="margin: 0 auto;width: 100px; height: 100px" src="<?= Set::SMALL_PRELOADER?>">', mapCenter, cache = {tours: {}, hotels: {}}, cacheSletat = [], cityList = {}, bx_session_input = '<?=$session?>', bx_typetours = '<?=$type?>', bx_cityFrom = '<?=$cityFrom?>', bx_country = '<?=$country?>', bx_filter = '<?=$filter?>';

    var arRes = JSON.parse($(".search_area").attr("data-def-params"));
    bx_cityFrom = JSON.parse(bx_cityFrom);
    bx_country = JSON.parse(bx_country);
    bx_filter = JSON.parse(bx_filter);
    bx_typetours = JSON.parse(bx_typetours);

    var $fltr = $(".sidebar-inner"), $srch = $(".package-list-item-wrapper"), $pgn = $(".pager-wrappper"), $htmlnull = $(".html_null");

    if(typeof bx_filter === "object" && typeof bx_cityFrom === "object") {
        for (var Arr_cityFrom in bx_cityFrom) {
            if (typeof bx_filter[Arr_cityFrom] === "object")
                cityList[Arr_cityFrom] = bx_cityFrom[Arr_cityFrom];
        }
    }

    function setItems (arCache, arData) {

        var i, cnt = arData.length, arItems = [], img = "/bitrix/templates/main/images/nophoto.jpg", prop = [];

        for (i = 0; i < cnt; i++) {

            if ($.inArray(arData[i]["tourType"],bx_typetours) != -1) {

                if (typeof arCache["tours"] !== "undefined" && typeof arCache["tours"][arData[i]["tour"]["id"]] !== "undefined"){

                    arItems[i] = {
                        name : arCache["tours"][arData[i]["tour"]["id"]]["name"],
                        detail : arCache["tours"][arData[i]["tour"]["id"]]["detail"],
                        picture : arCache["tours"][arData[i]["tour"]["id"]]["picture"] ? arCache["tours"][arData[i]["tour"]["id"]]["picture"] : img,
                        property_tour : arCache["tours"][arData[i]["tour"]["id"]]["property"]
                    };

                }
                else {
                    arItems[i] = {
                        name : arData[i]["tour"]["name"],
                        picture: img
                    }
                }

            }
            else{
                if (typeof arCache["hotels"] !== "undefined" && typeof arCache["hotels"][arData[i]["hotel"]["id"]] !== "undefined" && arCache["hotels"][arData[i]["hotel"]["id"]] !== false){

                    arItems[i] = {
                        name : arCache["hotels"][arData[i]["hotel"]["id"]]["name"] + ' ' + arData[i]["hotel"]["star"],
                        detail : arCache["hotels"][arData[i]["hotel"]["id"]]["detail"],
                        picture : arCache["hotels"][arData[i]["hotel"]["id"]]["picture"] ? arCache["hotels"][arData[i]["hotel"]["id"]]["picture"] : img,
                        property_hotel : arCache["hotels"][arData[i]["hotel"]["id"]]["property"]
                    };

                }
                else {
                    arItems[i] = {
                        name : arData[i]["hotel"]["name"] + ' ' + arData[i]["hotel"]["star"],
                        picture: img
                    }
                }
            }
            arItems[i]["hotel"] = arData[i]["hotel"]["name"] + ' ' + arData[i]["hotel"]["star"];
            arItems[i]["property"] = {
                    accm: arData[i]["accm"],
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


    function ShowAndHideBlocks () {
        //$srch.html("");
        $pgn.html("");
        //$htmlnull.css("display","block");
    }

    //функция удаления Js фильтра и его Html
    function destroyFilter () {

        var form = $("#filterForm");

        form.find("select").select2('destroy');

        form.find("#date-filter-from, #date-filter-to").datepicker( "destroy" );

        $fltr.html("<p>Идет загрузка...</p>");
        //$htmlnull.css("display", "block");
        //$srch.html();
        $pgn.html();

    }

    //функция инициализации фильтра
    function init_js_filter (dates) {

        // duration Range Slider
        $("#duration_range").ionRangeSlider({
            type: "double",
            grid: true,
            min: $(this).data("min"),
            max: $(this).data("max"),
            from: $(this).data("from"),
            to: $(this).data("to"),
            prefix: "",
            onFinish: function(v){ $("#min-filter-duration").val(v.from), $("#max-filter-duration").val(v.to);
                ShowAndHideBlocks();
                initApp([[mainFilter]]);
            }
        })

        var form = $("#filterForm"),
            iRS = $("#price_range").data("ionRangeSlider"),
            iRSD = $("#duration_range").data("ionRangeSlider");

        form.find("select[name='country']:nth-child(2)").attr("selected", "selected");

        /**
         * submit формы по checkbox
         */
        form.find("input[type='checkbox']").on("change", function(){
            ShowAndHideBlocks();
            initApp([[mainFilter]]);
        });

        /**
         * submit формы по select2
         */
        form.find("select").select2({
            "allowClear": true
        }).on("change", function(){
            if($(this).attr("name") == "cityFrom"){
                var city = $(this).val(), i = 1, tmp_html='';

                tmp_html += '<option value=""></option>';
                for(Arr_country in bx_filter[city]){

                    tmp_html += '<option ' + (i == 1 ? 'selected="selected" ' : '') + ' value="' + Arr_country + '">' + bx_country[Arr_country].NAME + '</option>'
                    i++;

                }
                $("#filterForm select[name='country']").html(tmp_html);

            }
            ShowAndHideBlocks();
            initApp([[mainFilter]]);
        });

        $().append("<>");

        /**
        * datapicker
        */
        if($("#date-filter-from").length || $("#date-filter-to").length)
        {

            $("#date-filter-from").datepicker({
                showOtherMonths: !0,
                selectOtherMonths: !0,
                minDate: "0",
                defaultDate: "+7d",
                firstDay: "1",
                dateFormat: "dd.mm.yy",
                dayNamesMin: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
                beforeShowDay: function(date){
                    if(dates.length > 0) {
                          var formattedDate = date.toLocaleDateString('pl', {
                            day: '2-digit',
                            year: 'numeric',
                            month: '2-digit'
                        });
                        if ($.inArray(formattedDate, dates) != -1) {
                            return [true, 'active-date bus-day'];
                        }

                    }
                    return [true,""];
                },
                onSelect: function( selectedDate ) {
                    $( "#date-filter-to" ).datepicker( "option", "minDate", selectedDate );
                    ShowAndHideBlocks();
                    initApp([[mainFilter]]);
                },
//
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
                    initApp([[mainFilter]]);
                }
            });
        }

    }

    function mainSearch (params) {

        /**
         * searchObject: bustours - поиск туров
         *
         */
        $.Search({
            searchObject: "bustours",
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

                //$srch.html("По Вашему запросу ничего не найдено. Попробуйте изменить параметры поиска.");
                if(data === false) {
                    $htmlnull.css("display","none");
                    $srch.html("По Вашему запросу ничего не найдено. Попробуйте изменить параметры поиска.");
                    return;
                }

                if (data.length > 0) {

                    var request_data = {}, i, cnt = data.length;

                    for (i = 0; i < cnt; i++) {

                        if (typeof cache["tours"][data[i]["tour"]["id"]] === "undefined") {

                            if (typeof request_data["tours"] === "undefined") {
                                request_data["tours"] = {};
                            }

                            if ($.inArray(data[i]["tourType"],bx_typetours) != -1) {
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

                    if(request_data) {
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
                                $htmlnull.css("display","none");
                                $srch.html(Utilites.getHtmlItems(setItems(items,data)));


                            }
                        });

                    } else {
                        $htmlnull.css("display","none");
                        $srch.html(Utilites.getHtmlItems(setItems(cache,data)));
                    }
                    /*setTimeout(function () {
                        $("#introLoader").data("introLoader").stop();
                    }, 1000);*/
                }

            },
            ajaxPagenavigation: function (data, render){

                $pgn.html("");

                if(!render){
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



    function mainFilter (params) {

        /**
         * filterObject: bustoursfilter - отрисовка фильтра
         *
         */
        $.Filter({
            filterObject: "bustoursfilter",
            parameters: selectParams.selectFilter(params),
            queryFilterAddress: "<?= $arResult['queryAddress']?>",
            renderResultFilter: function (data) {

                if (typeof data !== "undefined") {

                    destroyFilter();
                    $fltr.html(Utilites.getHtmlBusFilter(data));
                    init_js_filter(data["dates"]);

                }
            },
            getRequiredParamsFilter: function (data) {

                var ar_required = {cityFrom: {}, country: {}},ar_cityFrom = {}, ar_country = {}, i;
                if(typeof data !== "undefined"){
                    if (bx_cityFrom.length > 0){
                        ar_cityFrom = JSON.parse(bx_cityFrom);
                        for(ArrCityFrom in ar_cityFrom){
                            ar_required["cityFrom"][ArrCityFrom] = {
                                name: ar_cityFrom[ArrCityFrom],
                                selected: (ArrCityFrom == data.cityFrom ? true : false)
                            }
                        }
                    }
                    if (bx_country.length > 0){
                        ar_country = JSON.parse(bx_country);
                        for(ArrCountry in ar_country){
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

    function initApp (arrFn){
        Utilites.currentPage = 1;
        $srch.html();
        $pgn.html();
        var p = selectParams.selectAllBusParams();
        for(var i=0;i < arrFn[0].length; i++){
            arrFn[0][i].call(this,p);
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

    //Для фильтра
    $(document).on("click", "a.submit-filter", function (e) {
        e.preventDefault();
        $srch.html("");
        $htmlnull.css("display", "block");
        initApp ([[mainSearch]]);
    });

    $(document).on("click", ".pagination a", function (e) {
         e.preventDefault();
         Utilites.currentPage = $(this).data('page');
         var p = selectParams.selectAllParams();
         mainSearch(p);
     });

    initApp ([[mainFilter,mainSearch]]);

</script>