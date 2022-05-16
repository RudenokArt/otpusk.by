<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
//ini_set('memory_limit', '-1');
require($_SERVER["DOCUMENT_ROOT"] . "/local/components/travelsoft/mastertour.search.result/lib/Autoloader.php");

require($_SERVER["DOCUMENT_ROOT"] . "/ajax/lib/Cache.php");


try {

    $request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();

    if (!$request->isPost())
        throw new Exception();

    $response = array();

    Bitrix\Main\Loader::includeModule('iblock');
    $hotelId = Bitrix\Main\Web\Json::decode($request->getPost('query_data'), true);


    if ($hotelId == null) {
        $response = array('error' => true);
        throw new \Exception();
    }

    if (!empty($hotelId)) {

        $getHotel = function () use ($hotelId) {

            $login = 'support@ck.by';
            $pass = 'ck2010%^#qmvh';

            $marker_icon_small = SITE_TEMPLATE_PATH . "/images/map/marker24.png";

            $xml = new sletatru\XmlGate([
                'login' => $login,
                'password' => $pass,
            ]);
            //section-0
            $dataHotels = $xml->GetHotelInformation($hotelId);

            $dataHotels["Description"] = str_replace("http://", "https://", $dataHotels["Description"]);

            $information["TOP_DETAIL"] = Array(
                "Адрес отеля" => $dataHotels["Address"],
                "Расстояние до аэропорта" => $dataHotels["AirportDistance"],
                "Регион, в котором расположен отель" => $dataHotels["Area"],
                "Дата постройки" => $dataHotels["BuildingDate"],
                "Расстояние от центра" => $dataHotels["CityCenterDistance"],
                "Страна" => $dataHotels["CountryName"],
                "Расстояние до подъемников" => $dataHotels["DistanceToLifts"],
                "Район" => $dataHotels["District"],
                "E-mail" => $dataHotels["Email"],
                "Номер факса" => $dataHotels["Fax"],
                "Рейтинг отеля" => $dataHotels["HotelRate"],
                "Номер дома" => $dataHotels["HouseNumber"],
                //"Адрес отеля на языке страны" => $dataHotels["NativeAddress"],
                "Номер телефона" => $dataHotels["Phone"],
                "Почтовый индекс" => $dataHotels["PostIndex"],
                "Область" => $dataHotels["Region"],
                "Дата реконструкции" => $dataHotels["Renovation"],
                "Название курорта" => $dataHotels["Resort"],
                "Количество номеров в отеле" => $dataHotels["RoomsCount"],
                "Адрес вебсайта отеля" => $dataHotels["Site"],
                "Площадь" => $dataHotels["Square"],
                "Название улицы" => $dataHotels["Street"]
            );

            $information["BOTTOM_DETAIL"] = Array(
                "section-1" => Array("TYPE" => "GALLERY", "NAME" => "Фотогалерея", "VALUE" => $dataHotels["ImageCount"]),
                "section-2" => Array("TYPE" => "ARRAY", "NAME" => "Услуги", "VALUE" => $dataHotels["HotelFacilities"]),
                "section-3" => Array("TYPE" => "MAP", "NAME" => "Карта", "VALUE" => Array("LAT" => $dataHotels["Latitude"], "LNG" => $dataHotels["Longitude"])),
                "section-4" => Array("TYPE" => "TEXT", "NAME" => "Описание", "VALUE" => $dataHotels["Description"]),
                "section-5" => Array("TYPE" => "VIDEO", "NAME" => "Видео", "VALUE" => $dataHotels["Video"]),
            );

            /*
            RatingMeal;
            RatingOverall;
            RatingPlace;
            RatingService;
            StarId;
            StarName;
            */

            $scroll = Array();
            $html = '';
            $html .= '<div class="row">
                    <div class="col-md-9" role="main">
                        <div class="detail-content-wrapper">';

            $html .= '<div style="overflow:auto" id="section-0" class="detail-content pb-0">
                    <div class="section-title text-left">
                        <h3>' . $dataHotels["Name"] . '</h3>
                    </div>
                    <div class="col-sm-6 mb-30">
                        <ul class="list-info no-icon bb-dotted padd-20">';

            if (!empty($information["TOP_DETAIL"]) && is_array($information["TOP_DETAIL"])) {
                $scroll[] = array("section-0", $dataHotels["Name"]);
                foreach ($information["TOP_DETAIL"] as $NAME => $value) {
                    if (!empty($value)) {
                        $html .= '<li class="liFlex">
                            <span class="list-info-name-contact">' . $NAME . ':</span>
                            <div class="list-info-contact">
                                ' . $value . '
                            </div>
                        </li>';
                    }
                }
            }
            $html .= '</ul></div><div class="col-sm-6 mb-30" style="width: 400px; height: 300px;">
                    <img src="https://hotels.sletat.ru/i/f/' . $hotelId . '_0_400_250_1.jpg" alt="' . $dataHotels["Name"] . '"/>
                </div></div>';

            if (!empty($information["BOTTOM_DETAIL"]) && is_array($information["BOTTOM_DETAIL"])) {
                foreach ($information["BOTTOM_DETAIL"] as $id => $element) {
                    if (!empty($element["VALUE"])) {
                        $scroll[] = array($id, $element["NAME"]);
                        $html .= '<div id="' . $id . '" class="detail-content">
                                <div class="section-title text-left">
                                    <h4>' . $element["NAME"] . '</h4>
                                </div>';
                        switch ($element["TYPE"]) {
                            case "TEXT":

                                $html .= $element["VALUE"];

                                break;
                            case "GALLERY":

                                $html .= '<div class="slick-gallery-slideshow"><div class="slider gallery-slideshow">';
                                for ($i = 0; $i < $element["VALUE"]; $i++) {
                                    $html .= '<div><div class="image" style="max-height:460px">
                                            <img style="max-height:460px" src="https://hotels.sletat.ru/i/f/' . $hotelId . '_' . $i . '_840_460_1.jpg" alt="' . $dataHotels["Name"] . '"/>
                                            </div><div class="content"><div style="color:#fff; padding:0 10px; font-weight:bold">' . $dataHotels["Name"] . '</div></div></div>';
                                }
                                $html .= '</div><div class="slider gallery-nav">';
                                for ($i = 0; $i < $element["VALUE"]; $i++) {
                                    $html .= '<div><div class="image"><img src="https://hotels.sletat.ru/i/p/' . $hotelId . '_' . $i . '_57_103_1.jpg" alt="' . $dataHotels["Name"] . '"/></div></div>';
                                }
                                $html .= '</div></div><script type="text/javascript">
                                    $(\'.gallery-slideshow\').slick({slidesToShow: 1,slidesToScroll: 1,speed: 500,arrows: true,fade: true,asNavFor: \'.gallery-nav\'});
                                    $(\'.gallery-nav\').slick({
                                        slidesToShow: 7,slidesToScroll: 1,speed: 500,asNavFor: \'.gallery-slideshow\',dots: false,
                                        centerMode: false,focusOnSelect: true,infinite: true,responsive: [
                                            {breakpoint: 1199,settings: {slidesToShow: 7,}}, 
                                            {breakpoint: 991,settings: {slidesToShow: 5,}}, 
                                            {breakpoint: 767,settings: {slidesToShow: 5,}}, 
                                            {breakpoint: 480,settings: {slidesToShow: 3,}}
                                        ]
                                    });</script>';

                                break;
                            case "VIDEO":

                                $html .= '<div class="video-block"><iframe width="560" height="315" src="' . $element["VALUE"] . '" allowfullscreen=""></iframe></div>';

                                break;
                            case "MAP":

                                $html .= '<div class="map-route" style="width: 100%; height: 300px;" id="map-area"></div>
                                    <script type="text/javascript">
                                        $(document).ready(function(){
                                            function map_init() {
                                                if(!document.getElementById(\'map-area\')) return;
                                                var map = new google.maps.Map(document.getElementById(\'map-area\'),{
                                                    center: {lat: ' . $element["VALUE"]["LAT"] . ', lng: ' . $element["VALUE"]["LNG"] . '},
                                                    zoom: 17
                                                });
                                                var marker = new google.maps.Marker({
                                                    title: "' . $dataHotels["Name"] . '",
                                                    position: {lat: ' . $element["VALUE"]["LAT"] . ', lng: ' . $element["VALUE"]["LNG"] . '},
                                                    map: map,
                                                    icon: "' . $marker_icon_small . '"
                                                });
                                                marker.addListener(\'click\', function () {
                                                    var infowindow = new google.maps.InfoWindow({
                                                        content: "' . $dataHotels["Name"] . '",
                                                    });
                                                    infowindow.open(map, this);
                                                });
                                            }
                                            map_init();
                                        });
                                    </script>';

                                break;
                            case "ARRAY":

                                $html .= '<p style="text-align: justify;">';
                                foreach ($element["VALUE"] as $value) {
                                    $html .= '<h6>' . $value["Name"] . '</h6>';
                                    foreach ($value["Facilities"] as $facility) {
                                        $html .= '- ' . $facility["Name"] . '<br/>';
                                    }
                                }
                                $html .= '</p>';

                                break;
                            default:
                                break;
                        }

                        $html .= '</div>';
                    }
                }
            }

            $html .= '</div></div>';


            if (!empty($scroll)) {
                $html .= '<div class="col-sm-3 hidden-sm hidden-xs"><div class="scrolly scrollspy-sidebar sidebar-detail" role="complementary"><ul class="scrollspy-sidenav"><li><ul class="nav">';
                foreach ($scroll as $s) {
                    $html .= '<li><a href="#' . $s[0] . '" class="anchor">' . $s[1] . '</a></li>';
                }
                $html .= '</ul></li></ul><div style="width: 100%; height: 100px;"></div></div></div>
            <script type="text/javascript">
                $(\'a.anchor[href*=#]:not([href=#])\').on("click",function() {
                    var elementClick = $(this).attr("href");
                    var destination = $(elementClick).position().top;
                    $(\'.mfp-wrap\').animate({ scrollTop: destination}, 1100);
                    return false;
                });
            </script>';
            }
            $html .= '</div>';

            return $html;
        };

        $html = '';

        $cacheId = md5('otpusk_get_one_hotel_' . $hotelId);

        $cache = new \travelsoft\adapters\Cache($cacheId, "/travelsoft/otpusk");

        if (empty($html = $cache->get())) {
            $html = $cache->caching($getHotel);
        }

        $response["html"] = $html;
    }

    throw new \Exception(json_encode($response));

} catch (\Exception $e) {
    header('Content-Type: application/json');
    echo $e->getMessage();
}

?>