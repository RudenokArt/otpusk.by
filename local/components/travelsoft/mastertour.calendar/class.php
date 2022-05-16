<?
use Bitrix\Main\Loader;
\Bitrix\Main\Loader::includeModule('travelsoft.currency');

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

// выдача результатов мастертура
class SearchMasterResult extends CBitrixComponent {

	public function prepare() {

		if ($this->arParams['QUERY_ADDRESS'] == "")
			throw new \Bitrix\Main\ArgumentException("Укажите адрес для запроса в параметрах компонента");
        if (empty($this->arParams['TYPE_TOURS']))
            throw new \Bitrix\Main\ArgumentException("Укажите тивы туров в параметрах компонента");
	}

	public function executeComponent() {

		$this->prepare();

		$request = Bitrix\Main\Application::getInstance()->getContext()->getRequest();

        $defaultTourType = array("12");
        $typetour = !empty($this->arParams['TYPE_TOURS']) ? $this->arParams['TYPE_TOURS'] : $defaultTourType;
        Loader::includeModule('iblock');

        $idtypetour = 0;
        $rsProp = CIBlockElement::GetList(array("SORT" => "ASC"), Array("IBLOCK_ID" => Set::TYPETOURS_IBLOCK_ID, "ACTIVE" => "Y", "PROPERTY_MASTERTOUR_ID" => $typetour), false, false, Array("ID"));
        while ($arr=$rsProp->GetNext()) {
            $idtypetour = $arr["ID"];
        }

        $arTours = array();
        if($idtypetour != 0) {
            $db_Tour = CIBlockElement::GetList(array("SORT" => "ASC"), Array("IBLOCK_ID" => Set::SPECIAL_OFF_IBLOCK_ID, "ACTIVE" => "Y", "!=PROPERTY_MT_KEY_VALUE" => false, "PROPERTY_TOURTYPE" => $idtypetour), false, false,
                Array("ID", "IBLOCK_ID", "NAME", "DETAIL_PAGE_URL", "PROPERTY_COUNTRY.ID", "PROPERTY_COUNTRY.NAME", "PROPERTY_DAYS", "PROPERTY_TOURTYPE.NAME", "PROPERTY_TOWN.NAME", "PROPERTY_POINT_DEPARTURE.NAME", "PROPERTY_MT_KEY", "PROPERTY_BYR_PRICE"));
            while ($Tour = $db_Tour->GetNext()) {
                if (!empty($Tour["PROPERTY_MT_KEY_VALUE"])) {
                    $arTours[$Tour["PROPERTY_MT_KEY_VALUE"]] = array(
                        "id" => $Tour["ID"],
                        "name" => $Tour["NAME"],
                        "detail" => $Tour["DETAIL_PAGE_URL"],
                        "price" => ($Tour["PROPERTY_BYR_PRICE_VALUE"] != "" && $Tour["PROPERTY_BYR_PRICE_VALUE"] > 0) ? round($Tour["PROPERTY_BYR_PRICE_VALUE"],2)." BYN" : "",
                        "property" => array(
                            "country_id" => $Tour["PROPERTY_COUNTRY_ID"],
                            "country" => $Tour["PROPERTY_COUNTRY_NAME"],
                            "city" => $Tour["PROPERTY_TOWN_NAME"],
                            "days" => w($Tour["PROPERTY_DAYS_VALUE"]) . " " . w($Tour["PROPERTY_DAYS_VALUE"], 2),
                            "typetour" => $Tour["PROPERTY_TOURTYPE_NAME"],
                            "point" => $Tour["PROPERTY_POINT_DEPARTURE_NAME"]
                        )
                    );
                }
            }

            global $USER;
            $arTours2 = array(); $arCountries = array(); $arCountriesDop = array();
            $db_Tour = CIBlockElement::GetList(array("SORT" => "ASC"), Array("IBLOCK_ID" => Set::SPECIAL_OFF_IBLOCK_ID, "ACTIVE" => "Y", "!=PROPERTY_MT_KEY_VALUE" => false, "PROPERTY_TOURTYPE" => $idtypetour), false, false,
                Array("ID", "IBLOCK_ID", "NAME", "DETAIL_PAGE_URL"));
            while ($Tour = $db_Tour->GetNextElement()) {
                $arFields = $Tour->GetFields();
                $arProps = $Tour->GetProperties();
                if (!empty($arProps["MT_KEY"]["VALUE"])) {
                    $arTours2[$arProps["MT_KEY"]["VALUE"]] = array(
                        "id" => $arFields["ID"],
                        "name" => $arFields["NAME"],
                        "detail" => $arFields["DETAIL_PAGE_URL"],
                        //"price" => ($arProps["BYR_PRICE"]["VALUE"] != "" && $arProps["BYR_PRICE"]["VALUE"] > 0) ? round($arProps["BYR_PRICE"]["VALUE"],2)." BYN" : "",
                        "price" => ($arProps["PRICE"]["VALUE"] != "" && $arProps["PRICE"]["VALUE"] > 0) ? $arProps["PRICE"]["VALUE"] : "",
                        "currency" => ($arProps["CURRENCY"]["VALUE"] != "" && $arProps["CURRENCY"]["VALUE"] > 0) ? $arProps["CURRENCY"]["VALUE"] : "",
                        "property" => array(
                            //"city" => $Tour["PROPERTY_TOWN_NAME"],
                            "days" => w($arProps["DAYS"]["VALUE"]) . " " . w($arProps["DAYS"]["VALUE"], 2),
                            "typetour" => $arProps["TOURTYPE"]["NAME"],
                            "point" => $arProps["POINT_DEPARTURE"]["NAME"]
                        )
                    );
                    if(!empty($arTours2[$arProps["MT_KEY"]["VALUE"]]['price']) && !empty($arTours2[$arProps["MT_KEY"]["VALUE"]]['currency']))
                        $arTours2[$arProps["MT_KEY"]["VALUE"]]['priceCurrency'] = \travelsoft\Currency::getInstance()->convertCurrency($arTours2[$arProps["MT_KEY"]["VALUE"]]['price'],$arTours2[$arProps["MT_KEY"]["VALUE"]]['currency']);
                    if(!empty($arProps["COUNTRY"]["VALUE"])){
                        foreach ($arProps["COUNTRY"]["VALUE"] as $k=>$country_item){
                            $arTours2[$arProps["MT_KEY"]["VALUE"]]["property"]["country_id"][$k] = $country_item;
                            $db_country = CIBlockElement::GetByID($country_item);
                            if($ar_res = $db_country->GetNext()) {
                                $arTours2[$arProps["MT_KEY"]["VALUE"]]["property"]["country"][$k] = $ar_res['NAME'];
                                $arCountriesDop[$country_item] = $ar_res['NAME'];
                            }
                        }
                    }

                }
            }
            if(!empty($arCountriesDop)){
                asort($arCountriesDop);
                foreach ($arCountriesDop as $key=>$nameCountry){
                    $arCountries[] = array(
                        "id" => $key,
                        "name" => trim($nameCountry)
                    );
                }

            }
        }

       /* $arTours2 = array();
        if($idtypetour != 0) {
            $db_Tour = CIBlockElement::GetList(array("SORT" => "ASC"), Array("IBLOCK_ID" => Set::SPECIAL_OFF_IBLOCK_ID, "ACTIVE" => "Y", "!=PROPERTY_MT_KEY_VALUE" => false, "PROPERTY_TOURTYPE" => $idtypetour), Array("PROPERTY_COUNTRY"), false,
                Array("ID", "IBLOCK_ID", "NAME", "DETAIL_PAGE_URL", "PROPERTY_COUNTRY.ID", "PROPERTY_COUNTRY.NAME", "PROPERTY_DAYS", "PROPERTY_TOURTYPE.NAME", "PROPERTY_TOWN.NAME", "PROPERTY_POINT_DEPARTURE.NAME", "PROPERTY_MT_KEY", "PROPERTY_BYR_PRICE"));
            while ($Tour = $db_Tour->GetNext()) {
                dm($Tour);
                if (!empty($Tour["PROPERTY_MT_KEY_VALUE"])) {
                    $arTours2[$Tour["PROPERTY_MT_KEY_VALUE"]] = array(
                        "id" => $Tour["ID"],
                        "name" => $Tour["NAME"],
                        "detail" => $Tour["DETAIL_PAGE_URL"],
                        "price" => round($Tour["PROPERTY_BYR_PRICE_VALUE"],2)." BYN",
                        "property" => array(
                            "country" => $Tour["PROPERTY_COUNTRY_NAME"],
                            "country_id" => $Tour["PROPERTY_COUNTRY_ID"],
                            "city" => $Tour["PROPERTY_TOWN_NAME"],
                            "days" => w($Tour["PROPERTY_DAYS_VALUE"]) . " " . w($Tour["PROPERTY_DAYS_VALUE"], 2),
                            "typetour" => $Tour["PROPERTY_TOURTYPE_NAME"],
                            "point" => $Tour["PROPERTY_POINT_DEPARTURE_NAME"]
                        )
                    );
                }
            }
        }*/

		$this->arResult = array(
				'tourTypes' => $typetour,
                'bx_tours' => $arTours,
                'bx_tours2' => $arTours2,
                'bx_counties' => $arCountries,
                'searchId' => time() * 1000,
                'queryAddress' => htmlspecialchars($this->arParams['QUERY_ADDRESS']),
			);

        $this->arResult['city'] = getCityCountry(Set::CITY_IBLOCK_ID, "MT_HOTELKEY", "KEY_SLETAT");
        $this->arResult['country'] = getCityCountry(Set::COUNTRY_IBLOCK_ID, "CN_KEY", "KEY_SLETAT");
        $this->arResult['filter'] = getSearchFilterBusTours($this->arResult['city'], $this->arResult['country']);

		$this->IncludeComponentTemplate();

	}

}