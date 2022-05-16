<?

use Bitrix\Main\Loader;

require($_SERVER["DOCUMENT_ROOT"] . "/ajax/lib/Cache.php");

use \travelsoft\adapters\Cache as Cache;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

// форма поиска в инфоблоках
class infoblockForm extends CBitrixComponent
{

    private function getBusTours()
    {
        $arCountries = Array();
        $arPointDeparture = Array();
        $arDates = Array();
        $arDates_ = Array();
        $d = date("d.m.Y");

        $res = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => 18, "PROPERTY_TOURTYPE" => 515, "ACTIVE" => "Y"), false, false, Array("IBLOCK_ID", "ID", "NAME"));
        while ($ob = $res->GetNextElement()) {
            $arProps = $ob->GetProperties();
            //$arFields = $ob->GetFields();

            /*$arDatesTemporarily = Array();

            $iblockIdDeparture = $arProps["POINT_DEPARTURE"]["LINK_IBLOCK_ID"];
            foreach ($arProps["POINT_DEPARTURE"]["VALUE"] as $idTown) {
                if (!in_array($idTown, $arPointDeparture)) {
                    array_push($arPointDeparture, $idTown);
                }
                if(!isset($arDates[$idTown])) {
                    $arDates[$idTown] = array();
                    $arDatesTemporarily[$idTown] = array();
                }
            }
            $iblockIdCountry = $arProps["COUNTRY"]["LINK_IBLOCK_ID"];
            foreach ($arProps["COUNTRY"]["VALUE"] as $idCountry) {
                if (!in_array($idCountry, $arCountries)) {
                    array_push($arCountries, $idCountry);
                }
                foreach ($arProps["POINT_DEPARTURE"]["VALUE"] as $idTown) {
                    if(!isset($arDates[$idTown][$idCountry])) {
                        $arDates[$idTown][$idCountry] = array();
                        $arDatesTemporarily[$idTown][$idCountry] = array();
                    }
                }
            }*/


            /*$dates_ = array();
            foreach ($arProps["DEPARTURE"]["VALUE"] as $dates) {
                //if(in_array(558, $arProps["POINT_DEPARTURE"]["VALUE"]) && in_array(115,$arProps["COUNTRY"]["VALUE"])) {
                    if (strtotime($dates) > strtotime($d)) {
                        $m = date("m", strtotime($dates));
                        if (!isset($dates_[$m])) {
                            $dates_[$m] = array();
                        }
                        $dates_[$m][] = CIBlockFormatProperties::DateFormat("d.m.Y", MakeTimeStamp($dates, CSite::GetDateFormat()));
                    }

                //}
            }*/

            /*foreach ($arDatesTemporarily as $key=>$datetown){
                foreach ($datetown as $k=>$datecountry) {
                    if (in_array($key, $arProps["POINT_DEPARTURE"]["VALUE"]) && in_array($k, $arProps["COUNTRY"]["VALUE"])){

                        foreach ($dates_ as $mon => $date) {
                            if (isset($arDates[$key][$k][$mon])) {
                                $arDates[$key][$k][$mon] = array_merge($arDates[$key][$k][$mon], $dates_[$mon]);
                            } else {
                                $arDates[$key][$k][$mon] = $dates_[$mon];
                            }
                        }
                    }
                }
            }*/


            $iblockIdDeparture = $arProps["POINT_DEPARTURE"]["LINK_IBLOCK_ID"];
            $iblockIdCountry = $arProps["COUNTRY"]["LINK_IBLOCK_ID"];

            if(!empty($arProps["DEPARTURE"]["VALUE"])) {

                foreach ($arProps["COUNTRY"]["VALUE"] as $idCountry) {
                    if (!in_array($idCountry, $arCountries)) {
                        array_push($arCountries, $idCountry);
                    }
                }

                $dates_ = array();
                foreach ($arProps["POINT_DEPARTURE"]["VALUE"] as $idTown) {

                    if (!in_array($idTown, $arPointDeparture)) {
                        array_push($arPointDeparture, $idTown);
                    }
                    if (!isset($arDates[$idTown])) {
                        $arDates[$idTown] = array();
                    }

                    foreach ($arProps["COUNTRY"]["VALUE"] as $idCountry) {
                        if (!isset($arDates[$idTown][$idCountry])) {
                            $arDates[$idTown][$idCountry] = array();
                        }


                        foreach ($arProps["DEPARTURE"]["VALUE"] as $dates) {
                            if (strtotime($dates) > strtotime($d)) {
                                $m = date("m", strtotime($dates));
                                if (!isset($arDates[$idTown][$idCountry][$m])) {
                                    $arDates[$idTown][$idCountry][$m] = array();
                                }
                                $arDates[$idTown][$idCountry][$m][] = CIBlockFormatProperties::DateFormat("d.m.Y", MakeTimeStamp($dates, CSite::GetDateFormat()));
                            }

                        }

                    }


                }
            }


        }

        $arCitiesResult = Array();
        if (!empty($iblockIdCountry) && !empty($arCountries)) {
            $res = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => $iblockIdCountry, "ID" => $arCountries, "ACTIVE" => "Y"), false, false, Array("IBLOCK_ID", "ID", "NAME"));
            while ($ob = $res->GetNextElement()) {
                $arFields = $ob->GetFields();
                $arCitiesResult[$arFields["ID"]] = Array("NAME" => $arFields["NAME"], "CODE" => "arrFilter_95_" . abs(crc32($arFields["ID"])));
            }
        }

        $arPointDepartureResult = Array();
        if (!empty($iblockIdDeparture) && !empty($arPointDeparture)) {
            $res = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => $iblockIdDeparture, "ID" => $arPointDeparture, "ACTIVE" => "Y"), false, false, Array("IBLOCK_ID", "ID", "NAME"));
            while ($ob = $res->GetNextElement()) {
                $arFields = $ob->GetFields();
                $arPointDepartureResult[$arFields["ID"]] = Array("NAME" => $arFields["NAME"], "CODE" => "arrFilter_182_" . abs(crc32($arFields["ID"])));
            }
        }

        //Работает правильно разницы в 1 год, не больше
        $months['nameMonth'] = Array(
            '01' => 'Январь',
            '02' => 'Февраль',
            '03' => 'Март',
            '04' => 'Апрель',
            '05' => 'Май',
            '06' => 'Июнь',
            '07' => 'Июль',
            '08' => 'Август',
            '09' => 'Сентябрь',
            '10' => 'Октябрь',
            '11' => 'Ноябрь',
            '12' => 'Декабрь'
        );
        /*$resultMonth = array();
        $resultMonth_ = array();
        for ($i = date('m'); $i < date('m') + 10; $i++) {
            $selected = false;
            if ($i == date('n')) {
                $selected = true;
            }
            $year = date('Y');
            $month = $i % 13;
            if (floor($i / 13) > 0) {
                $month += 1;
                $year += 1;
            }
            if ($month < 10) {
                $month = '0' . $month;
            }
            $resultMonth['01.' . $month . '.' . $year] = Array('selected' => $selected, 'name' => $months['nameMonth'][$month] . ' ' . $year);
        }*/

        foreach ($arDates as $key=>$datecountry){
            foreach ($datecountry as $k=>$datetown){
                if(!empty($arDates[$key][$k])) {
                    ksort($datetown);
                    foreach ($datetown as $mon=>$date){
                        $selected = false;
                        /*if ($mon == date('m')) {
                            $selected = true;
                        }*/
                        $year = date('Y');
                        $month = (int)$mon % 13;
                        if (floor((int)$mon / 13) > 0) {
                            $month += 1;
                            $year += 1;
                        }
                        $arDates_[$key][$k]["dates"]['01.' . $mon . '.' . $year] = Array('selected' => $selected, 'name' => $months['nameMonth'][$mon] . ' ' . $year);
                    }
                }
            }
        }

        //dm($arDates_);

        $result = Array(
            "COUNTRIES" => $arCitiesResult,
            "POINT_DEPARTURE" => $arPointDepartureResult,
            //"MONTHS" => $resultMonth,
            "DATES" => $arDates_
        );

        return $result;
    }



    public function executeComponent()
    {

        $this->getBusTours();

        $cacheId = md5('otpusk_get_bus_tours_infoblock');

        $cache = new Cache($cacheId, "/travelsoft/otpusk");
        if (empty($arData = $cache->get())) {

            $_this = $this;
            $arData = $cache->caching(function () use ($_this) { return $_this->getBusTours(); });

        }

        $this->arResult['countries'] = $arData["COUNTRIES"];
        $this->arResult['cities'] = $arData["POINT_DEPARTURE"];
        $this->arResult['month'] = $arData["MONTHS"];
        $this->arResult['dates'] = $arData["DATES"];

        $this->arResult['action_url'] = !empty($this->arParams["ACTION_URL"]) ? $this->arParams["ACTION_URL"] : "/tury/";
        $this->IncludeComponentTemplate();
    }
}
