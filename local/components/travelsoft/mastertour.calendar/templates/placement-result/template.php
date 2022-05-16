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

/*if($GLOBALS["USER"]->IsAdmin()){
    dm($arResult);
    die();
}*/
?>
<?
Bitrix\Main\Loader::includeModule('iblock');
$tours = \Bitrix\Main\Web\Json::encode($arResult["bx_tours"]);
$tours2 = \Bitrix\Main\Web\Json::encode($arResult["bx_tours2"]);
$counties = \Bitrix\Main\Web\Json::encode($arResult["bx_counties"]);
$cities = \Bitrix\Main\Web\Json::encode($arResult["city"]);
$countries = \Bitrix\Main\Web\Json::encode($arResult["country"]);
$search = \Bitrix\Main\Web\Json::encode($arResult["filter"]);
//dm($arResult["bx_tours"]); die();
?>
<div class="country-list">
</div>
<div class="cityfrom-list">
</div>
<div class="availabily-wrapper" data-def-params='<?= \Bitrix\Main\Web\Json::encode($arResult);?>'>

</div>

<link rel="stylesheet" href="/local/components/travelsoft/mastertour.calendar/templates/placement-result/style.css">
<script type="text/javascript" src="<?= $componentPath?>/js/params.js"></script>
<script type="text/javascript" src="<?= $componentPath?>/js/search.js"></script>
<script type="text/javascript" src="<?= $componentPath?>/js/utilites.js"></script>

<script type="text/javascript">

	var loadedTours = [], mapCenter, bx_tours = '<?=$tours?>', bx_tours2 = '<?=$tours2?>', bx_counties = '<?=$counties?>', bx_cities = JSON.parse('<?=$cities?>'), bx_search = JSON.parse('<?=$search?>');
    bx_tours = JSON.parse(bx_tours);
    bx_tours2 = JSON.parse(bx_tours2);
    bx_counties = JSON.parse(bx_counties);

    var cityBusFrom = '';

    function setItems (arData) {

        var i, cnt = arData.length, arItems = {}, prop = [];

        for (i = 0; i < cnt; i++) {

            /*if (typeof bx_tours[arData[i]["tour"]["id"]] !== "undefined") {

                arItems[i] = {
                    name : bx_tours[arData[i]["tour"]["id"]]["name"],
                    detail : bx_tours[arData[i]["tour"]["id"]]["detail"],
                    price : bx_tours[arData[i]["tour"]["id"]]["price"],
                    property_tour : bx_tours[arData[i]["tour"]["id"]]["property"]
                };

            }
            else{
                arItems[i] = {
                    name : arData[i]["tour"]["name"]
                }
            }
            arItems[i]["years"] = arData[i]["years"];*/

            //изменить тип arItems!!! (на объект)
            if (typeof bx_tours[arData[i]["tour"]["id"]] !== "undefined" && bx_tours[arData[i]["tour"]["id"]]["property"]["country_id"] !== "") {
                if(typeof arItems[bx_tours[arData[i]["tour"]["id"]]["property"]["country_id"]] == "undefined") {
                    arItems[bx_tours[arData[i]["tour"]["id"]]["property"]["country_id"]] = {};
                }
                if(typeof arItems[bx_tours[arData[i]["tour"]["id"]]["property"]["country_id"]]["items"] == "undefined") {
                    arItems[bx_tours[arData[i]["tour"]["id"]]["property"]["country_id"]]["items"] = {};
                }
                if(typeof arItems[bx_tours[arData[i]["tour"]["id"]]["property"]["country_id"]]["items"][i] == "undefined") {
                    //arItems[bx_tours[arData[i]["tour"]["id"]]["property"]["country_id"]]["items"][i] = {};
                    arItems[bx_tours[arData[i]["tour"]["id"]]["property"]["country_id"]]["items"][i] = {
                        name : bx_tours[arData[i]["tour"]["id"]]["name"],
                        detail : bx_tours[arData[i]["tour"]["id"]]["detail"],
                        price : bx_tours[arData[i]["tour"]["id"]]["price"],
                        property_tour : bx_tours[arData[i]["tour"]["id"]]["property"],
                        years: arData[i]["years"]
                    };
                }

                if(typeof arItems[bx_tours[arData[i]["tour"]["id"]]["property"]["country_id"]]["name"] == "undefined") {
                    arItems[bx_tours[arData[i]["tour"]["id"]]["property"]["country_id"]]["name"] = bx_tours[arData[i]["tour"]["id"]]["property"]["country"];
                }

            }


        }

        return arItems;


    }

    function setItemsNew (arData) {

        var i, cnt = arData.length, arItems = {}, prop = [];

        for (i = 0; i < cnt; i++) {


            if (typeof bx_tours2[arData[i]["tour"]["id"]] !== "undefined" && bx_tours2[arData[i]["tour"]["id"]]["property"]["country_id"] !== "") {

                var j, cnt_j = bx_tours2[arData[i]["tour"]["id"]]["property"]["country_id"].length;
                for(j = 0; j < cnt_j; j++) {
                    if (typeof arItems[bx_tours2[arData[i]["tour"]["id"]]["property"]["country_id"][j]] == "undefined") {
                        arItems[bx_tours2[arData[i]["tour"]["id"]]["property"]["country_id"][j]] = {};
                    }
                    if (typeof arItems[bx_tours2[arData[i]["tour"]["id"]]["property"]["country_id"][j]]["items"] == "undefined") {
                        arItems[bx_tours2[arData[i]["tour"]["id"]]["property"]["country_id"][j]]["items"] = {};
                    }
                    if (typeof arItems[bx_tours2[arData[i]["tour"]["id"]]["property"]["country_id"][j]]["items"][i] == "undefined") {
                        //arItems[bx_tours[arData[i]["tour"]["id"]]["property"]["country_id"]]["items"][i] = {};
                        arItems[bx_tours2[arData[i]["tour"]["id"]]["property"]["country_id"][j]]["items"][i] = {
                            name: bx_tours2[arData[i]["tour"]["id"]]["name"],
                            detail: bx_tours2[arData[i]["tour"]["id"]]["detail"],
                            //price: bx_tours2[arData[i]["tour"]["id"]]["price"],
                            price: bx_tours2[arData[i]["tour"]["id"]]["priceCurrency"],
                            property_tour: bx_tours2[arData[i]["tour"]["id"]]["property"],
                            years: arData[i]["years"]
                        };
                    }

                    if (typeof arItems[bx_tours2[arData[i]["tour"]["id"]]["property"]["country_id"][j]]["name"] == "undefined") {
                        arItems[bx_tours2[arData[i]["tour"]["id"]]["property"]["country_id"][j]]["name"] = bx_tours2[arData[i]["tour"]["id"]]["property"]["country"][j];
                    }
                }
            }


        }
        return arItems;


    }

    function mainSearch (params) {

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

                setTimeout(function () {
                    $("#introLoader").data("introLoader").stop();

                }, 1000);

            },
            renderResult: function (data) {

                var tours = data.tours, head = data.years;

                $(".availabily-wrapper").html("По Вашему запросу ничего не найдено");

                if (typeof tours !== "undefined") {

                    var templ = '', country_list = {}, tmp = '';

                    country_list = setItemsNew(tours);

                    $(".country-list").css({"border-bottom":"1px solid #E3E3E3","margin-bottom":"15px","padding-bottom":"15px","display":"block"});

                    for (countryId in bx_counties) {

                        if (typeof country_list[bx_counties[countryId]["id"]] !== "undefined" && typeof country_list[bx_counties[countryId]["id"]]["items"] !== "undefined") {

                            templ += '<span>';
                                templ += '<a href="#country-' + bx_counties[countryId]["id"] + '" class="anchor">' + bx_counties[countryId]["name"] + '</a>';
                            templ += '</span>';
                        }
                    }

                    if(typeof bx_search !== "undefined"){

                        $(".cityfrom-list").css({"margin-bottom":"30px","padding-bottom":"15px"});
                        //$(".cityfrom-list select").css({"min-width: 180px;"});

                        var flag = '';

                        tmp += '<span>Город отправления: </span>';
                        tmp += '<select name="cityFrom" data-placeholder="Откуда">';
                            tmp += '<option value="">Все</option>';
                            for (cityBusId in bx_search) {
                                if(cityBusFrom == bx_cities[cityBusId].MASTERTOUR)
                                    flag = 'selected';
                                tmp += '<option value="' + bx_cities[cityBusId].MASTERTOUR + '" ' + flag +  '>' + bx_cities[cityBusId].NAME + '</option>';
                            }

                    }

                    /*for (countryId in country_list) {

                        if (typeof country_list[countryId]["items"] !== "undefined") {

                            templ += '<span>';
                                templ += '<a href="#country-' + countryId + '" class="anchor">' + country_list[countryId]["name"] + '</a>';
                            templ += '</span>';
                        }
                    }*/

                    $(".country-list").html(templ);
                    $(".cityfrom-list").html(tmp);

                    //var request_data = {}, i, cnt = data.tours.length;

                    $(".availabily-wrapper").html(Utilites.getHtmlItemsNew(country_list, head)); //версия 3
                    //$(".availabily-wrapper").html(Utilites.getHtmlItemsNew(setItems(tours), head)); //версия 2
                    //$(".availabily-wrapper").html(Utilites.getHtmlItems(setItems(tours), head)); //версия 1

                    setTimeout(function () {
                        $("#introLoader").data("introLoader").stop();
                    }, 3000);
                }

            }
        });

    }

    function initApp (){
        var p = selectParams.selectAllParams();
        mainSearch(p);
    }

    initApp();

    $(document).on("change", "select[name='cityFrom']", function () {
        p = selectParams.selectAllParams();
        cityBusFrom = Number($(this).val());
        if(cityBusFrom !== 0 && cityBusFrom !== "" && cityBusFrom !== null) {
            p.citiesFrom = [cityBusFrom];
        }
        mainSearch(p);
    });

    $(document).on("click", 'a.anchor[href*=#]:not([href=#])', function () {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
            var target = $(this.hash);

            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
            if (target.length) {
                $('html,body').animate({
                    scrollTop: (target.offset().top - 120) // 70px offset for navbar menu
                }, 1000);
                return false;
            }
        }
    });


</script>