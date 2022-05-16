<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
//ini_set('memory_limit', '-1');
require($_SERVER["DOCUMENT_ROOT"]."/local/components/travelsoft/mastertour.search.result/lib/Autoloader.php");

function getListHotels ($idHotels) {

    $arHotels = array();
    $db_Hotel = CIBlockElement::GetList(array("SORT" => "ASC"), Array("IBLOCK_ID" => Set::HOTELS_IBLOCK_ID, "ACTIVE" => "Y", "PROPERTY_SLETAT_HOTELKEY" => $idHotels), false, false,
        Array("ID", "IBLOCK_ID", "NAME", "DETAIL_PAGE_URL", "PROPERTY_TYPE_ID", "PROPERTY_CAT_ID", "PROPERTY_TOWN.NAME", "PROPERTY_PICTURES", "PROPERTY_SLETAT_HOTELKEY"));
    if ($db_Hotel->SelectedRowsCount() > 0) {
        while ($Hotel = $db_Hotel->GetNext()) {
            if (!empty($Hotel["PROPERTY_SLETAT_HOTELKEY_VALUE"])) {
                if (!empty($Hotel['PROPERTY_PICTURES_VALUE'])) {
                    $Hotel['PROPERTY_PICTURES_VALUE'] = (ARRAY)$Hotel['PROPERTY_PICTURES_VALUE'];

                    $Hotel['PROPERTY_PICTURES_VALUE'] = CFile::ResizeImageGet($Hotel['PROPERTY_PICTURES_VALUE'][0], array('width' => 297, 'height' => 198), BX_RESIZE_IMAGE_EXACT, true);
                }
                $arHotels[$Hotel["PROPERTY_SLETAT_HOTELKEY_VALUE"]] = array(
                    "id" => $Hotel["ID"],
                    "name" => $Hotel["NAME"],
                    "detail" => $Hotel["DETAIL_PAGE_URL"],
                    "picture" => $Hotel['PROPERTY_PICTURES_VALUE']["src"],
                    "property" => array(
                        "city" => $Hotel["PROPERTY_TOWN_NAME"],
                        "typehotel" => $Hotel["PROPERTY_TYPE_ID_VALUE"],
                        "category" => $Hotel["PROPERTY_CAT_ID_VALUE"]
                    )
                );
            }
        }
    }
    return $arHotels;

}

try {

    $request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();

    if(!$request->isPost())
        throw new Exception();

    $response = array();

    Bitrix\Main\Loader::includeModule('iblock');
    $data = Bitrix\Main\Web\Json::decode($request->getPost('query_data'), true);

    if ($data == null) {
        $response = array('error' => true);
        throw new \Exception();
    }


    if(!empty($data)) {

        $login = 'support@ck.by';
        $pass = 'ck2010%^#qmvh';

        //if ($data["params"]["requestId"] == 0) {
            //инициируем новый объект xml сервиса
            $xml = new sletatru\XmlGate([
                'login' => $login,
                'password' => $pass,
            ]);
       /* }
        else {
            $xml->config([
                'login' => $login,
                'password' => $pass,
            ]);
        }*/

        $arFilter = array();
        $arSearch = array();
        $arCurrenty = getCurrenty();
        //$arHotels = array();

        if (!empty($data["method"]) && $data["method"] == "Filter") {


            $arFilter["cities"] = $xml->GetCities($data["params"]["countryId"]);
            $arFilter["stars"] = $xml->GetHotelStars($data["params"]["countryId"], $data["params"]["cities"]);
            $arFilter["meals"] = $xml->GetMeals();
            $arFilter["hotels"] = $xml->GetHotels($data["params"]["countryId"], $data["params"]["cities"], $data["params"]["stars"], '', -1);
            //$arFilter["dates"] = $xml->GetTourDates($data["params"]["cityFromId"], $data["params"]["countryId"], $data["params"]["cities"]);


        }

        elseif (!empty($data["method"]) && $data["method"] == "Search") {

            //$arSearch["requestId"] = 0;
            if ($data["params"]["requestId"] == 0)
                $arSearch["requestId"] = $xml->CreateRequest($data["params"]["countryId"], $data["params"]["cityFromId"], $data["params"]["cities"], $data["params"]["meals"], $data["params"]["stars"], $data["params"]["hotels"], $data["params"]["adults"], $data["params"]["kids"], $data["params"]["kidsAges"], $data["params"]["nightsMin"], $data["params"]["nightsMax"], $data["params"]["priceMin"], $data["params"]["priceMax"], null, $data["params"]["departFrom"], $data["params"]["departTo"], false, true, true, false, null, $data["params"]["includeDescriptions"]);
            else
                $arSearch["requestId"] = $data["params"]["requestId"];

            $arHotels = $data["params"]["listHotels"];

            $done = true;
            $result = $xml->GetRequestState($arSearch["requestId"]);
            foreach ($result as $item) {

                if($item["IsProcessed"] == false) {
                    $done = false;
                    break;
                }
             }

            $arSearch["result"] = $xml->GetRequestResult($arSearch["requestId"]);

            if ($arSearch["result"]["RowsCount"] > 0){
                $id_hotels = array();
                foreach ($arSearch["result"]["Rows"] as $key=>$row) {
                    $arSearch["result"]["Rows"][$key]["RequestId"] = $arSearch["requestId"];
                    if ($row["HotelTitleImageUrl"] != "")
                        $arSearch["result"]["Rows"][$key]["HotelTitleImageUrl"] = $xml->getHotelImageUrl($row["HotelId"], 0, 297, 198, 1);
                    if ($row["Price"] > 0 && isset($arCurrenty[$row["Currency"]]))
                        $arSearch["result"]["Rows"][$key]["PriceBYN"] = number_format(convert_currency($row["Price"], $arCurrenty[$row["Currency"]], true), 2, ".", "");
                    if (!in_array($row["HotelId"], $arHotels) && $row["HotelId"] != 0)
                        $id_hotels[] = $row["HotelId"];

                }
                if (!empty($id_hotels) && !empty(getListHotels($id_hotels)))
                    array_push($arHotels, getListHotels($id_hotels));

            }


            if (!empty($arHotels))
                $arSearch["result"]["bx_hotels"] = $arHotels;

            $arSearch["state"] = $done;
        }

        if(!empty($arFilter))
            $response["filter"] = $arFilter;
        if(!empty($arSearch))
            $response["search"] = $arSearch;

    }

	throw new \Exception();

} catch(\Exception $e) {
	header('Content-Type: application/json');
    echo json_encode($response);
}