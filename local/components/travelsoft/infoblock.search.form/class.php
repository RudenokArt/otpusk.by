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

        $res = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => 18, "PROPERTY_TOURTYPE" => 515, "ACTIVE" => "Y"), false, false, Array("IBLOCK_ID", "ID", "NAME"));
        while ($ob = $res->GetNextElement()) {
            $arProps = $ob->GetProperties();

            $iblockIdDeparture = $arProps["POINT_DEPARTURE"]["LINK_IBLOCK_ID"];
            foreach ($arProps["POINT_DEPARTURE"]["VALUE"] as $idTown) {
                if (!in_array($idTown, $arPointDeparture)) {
                    array_push($arPointDeparture, $idTown);
                }
            }
            $iblockIdCountry = $arProps["COUNTRY"]["LINK_IBLOCK_ID"];
            foreach ($arProps["COUNTRY"]["VALUE"] as $idCountry) {
                if (!in_array($idCountry, $arCountries)) {
                    array_push($arCountries, $idCountry);
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
        $resultMonth = array();
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

        }

        $result = Array(
            "COUNTRIES" => $arCitiesResult,
            "POINT_DEPARTURE" => $arPointDepartureResult,
            "MONTHS" => $resultMonth
        );

        return $result;
    }



    public function executeComponent()
    {
        $cacheId = md5('otpusk_get_bus_tours_infoblock');

        $cache = new Cache($cacheId, "/travelsoft/otpusk");
        if (empty($arData = $cache->get())) {

            $_this = $this;
            $arData = $cache->caching(function () use ($_this) { return $_this->getBusTours(); });

        }

        $this->arResult['countries'] = $arData["COUNTRIES"];
        $this->arResult['cities'] = $arData["POINT_DEPARTURE"];
        $this->arResult['month'] = $arData["MONTHS"];

        $this->arResult['action_url'] = !empty($this->arParams["ACTION_URL"]) ? $this->arParams["ACTION_URL"] : "/tury/";
        $this->IncludeComponentTemplate();
    }
}
