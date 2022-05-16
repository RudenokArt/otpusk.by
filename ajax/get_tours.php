<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
try {

	$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();

	if(!$request->isPost())
		throw new Exception();



	Bitrix\Main\Loader::includeModule('iblock');

    $data = Bitrix\Main\Web\Json::decode($request->getPost('query_data'), true);

    $idTours = array();
    $idHotels = array();

    if ($data == null) {
        $response = array('error' => true);
        throw new \Exception();
    }

    if(!empty($data)){

        foreach ($data["tours"] as $tour){
            if(!in_array($tour["id"],$idTours)){
                $idTours[] = $tour["id"];
            }
        }
        foreach ($data["hotels"] as $hotel){
            if(!in_array($hotel["id"],$idHotels)){
                $idHotels[] = trim($hotel["id"]);
            }
        }

        $idTypeTours = array_unique($idTypeTours);
    }

    /*$arTypeTours = array();
    $arTypeToursId = array();
    $db_typeTour = CIBlockElement::GetList(array("SORT"=>"ASC"), Array("IBLOCK_ID"=>$iblock_typeTour,"ACTIVE"=>"Y","PROPERTY_MASTERTOUR_ID"=>$idTypeTours, "PROPERTY_SHOW_DESC_VALUE"=>"Y"), false, false, Array("ID", "NAME", "PROPERTY_MASTERTOUR_ID", "PROPERTY_SHOW_DESC"));
    while ($typeTour = $db_typeTour->GetNext()) {
        if(!empty($typeTour["PROPERTY_SHOW_DESC_VALUE"]) && $typeTour["PROPERTY_SHOW_DESC_VALUE"] == "Y" && !empty($typeTour["PROPERTY_MASTERTOUR_ID_VALUE"])){
            $arTypeTours[$typeTour["ID"]] = array(
                "id" => $typeTour["ID"],
                "name" => $typeTour["NAME"]
            );
            $arTypeToursId[] = $typeTour["ID"];
        }
    }*/

    $arTours = array();
    $arHotels = array();


    if(!empty($idTours)) {
        $db_Tour = CIBlockElement::GetList(array("SORT" => "ASC"), Array("IBLOCK_ID" => Set::SPECIAL_OFF_IBLOCK_ID, "ACTIVE" => "Y", "PROPERTY_MT_KEY" => $idTours), false, false,
            Array("ID", "IBLOCK_ID", "NAME", "DETAIL_PAGE_URL", "PROPERTY_COUNTRY.NAME", "PROPERTY_FOOD.NAME", "PROPERTY_DAYS", "PROPERTY_TOURTYPE.NAME", "PROPERTY_TOWN.NAME", "PROPERTY_POINT_DEPARTURE", "PROPERTY_PICTURES", "PROPERTY_TOUR_TYPE", "PROPERTY_NEW", "PROPERTY_FREE", "PROPERTY_MT_KEY"));
        while ($Tour = $db_Tour->GetNextElement()) {
            $arFields = $Tour->GetFields();
            $arProps = $Tour->GetProperties();
            if (!empty($arProps["MT_KEY"]["VALUE"])) {
                if (!empty($arProps['PICTURES']['VALUE'])) {
                    $arProps['PICTURES']['VALUE'] = (ARRAY)$arProps['PICTURES']['VALUE'];

                    $arProps['PICTURES']['VALUE'] = CFile::ResizeImageGet($arProps['PICTURES']['VALUE'][0], array('width' => 297, 'height' => 198), BX_RESIZE_IMAGE_EXACT, true);
                }
                $countries = '';
                if(!empty($arProps['COUNTRY']['VALUE'])){
                    $db_country = CIBlockElement::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>Set::COUNTRY_IBLOCK_ID, "ID"=>$arProps['COUNTRY']['VALUE']), false, false, Array("ID", "NAME"));
                    $j = 1; $n = $db_country->SelectedRowsCount();
                    while($ar_fields = $db_country->GetNext()){
                        $countries .= $ar_fields["NAME"];
                        if($j != $n)
                            $countries .= ', ';
                        $j++;
                    }
                }
                $point_dearture = '';
                if(!empty($arProps['POINT_DEPARTURE']['VALUE'])){
                    $db_departure = CIBlockElement::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>Set::CITY_IBLOCK_ID, "ID"=>$arProps['POINT_DEPARTURE']['VALUE']), false, false, Array("ID", "NAME"));
                    $j = 1; $n = $db_departure->SelectedRowsCount();
                    while($ar_fields = $db_departure->GetNext()){
                        $point_dearture .= $ar_fields["NAME"];
                        if($j != $n)
                            $point_dearture .= ', ';
                        $j++;
                    }
                }
                $cities = '';
                if(!empty($arProps['TOWN']['VALUE'])){
                    $db_city = CIBlockElement::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>Set::CITY_IBLOCK_ID, "ID"=>$arProps['TOWN']['VALUE']), false, false, Array("ID", "NAME"));
                    $j = 1; $n = $db_city->SelectedRowsCount();
                    while($ar_fields = $db_city->GetNext()){
                        $cities .= $ar_fields["NAME"];
                        if($j != $n)
                            $cities .= ' - ';
                        $j++;
                    }
                }
                $arTours[$arProps["MT_KEY"]["VALUE"]] = array(
                    "id" => $arFields["ID"],
                    "name" => $arFields["NAME"],
                    "detail" => $arFields["DETAIL_PAGE_URL"],
                    "picture" => $arProps['PICTURES']['VALUE']["src"],
                    "property" => array(
                        "country" => $countries,
                        "city" => $cities,
                        "food" => $arFields["PROPERTY_FOOD_NAME"],
                        "days" => w($arProps["DAYS"]["VALUE"]) . " " . w($arProps["DAYS"]["VALUE"], 2),
                        "typetour" => $arFields["PROPERTY_TOURTYPE_NAME"],
                        "point" => $point_dearture,
                        "tourtype" => $arProps["TOUR_TYPE"]["VALUE"],
                        "new" => $arProps["NEW"]["VALUE"],
                        "free" => $arProps["FREE"]["VALUE"],
                    )
                );
            }
        }

        /*$db_Tour = CIBlockElement::GetList(array("SORT" => "ASC"), Array("IBLOCK_ID" => Set::SPECIAL_OFF_IBLOCK_ID, "ACTIVE" => "Y", "PROPERTY_MT_KEY" => $idTours), false, false,
            Array("ID", "IBLOCK_ID", "NAME", "DETAIL_PAGE_URL", "PROPERTY_COUNTRY.NAME", "PROPERTY_FOOD.NAME", "PROPERTY_DAYS", "PROPERTY_TOURTYPE.NAME", "PROPERTY_TOWN.NAME", "PROPERTY_POINT_DEPARTURE.NAME", "PROPERTY_PICTURES", "PROPERTY_TOUR_TYPE", "PROPERTY_NEW", "PROPERTY_FREE", "PROPERTY_MT_KEY"));
        while ($Tour = $db_Tour->GetNext()) {
            if (!empty($Tour["PROPERTY_MT_KEY_VALUE"])) {
                if (!empty($Tour['PROPERTY_PICTURES_VALUE'])) {
                    $Tour['PROPERTY_PICTURES_VALUE'] = (ARRAY)$Tour['PROPERTY_PICTURES_VALUE'];

                    $Tour['PROPERTY_PICTURES_VALUE'] = CFile::ResizeImageGet($Tour['PROPERTY_PICTURES_VALUE'][0], array('width' => 297, 'height' => 198), BX_RESIZE_IMAGE_EXACT, true);
                }

                $arTours[$Tour["PROPERTY_MT_KEY_VALUE"]] = array(
                    "id" => $Tour["ID"],
                    "name" => $Tour["NAME"],
                    "detail" => $Tour["DETAIL_PAGE_URL"],
                    "picture" => $Tour['PROPERTY_PICTURES_VALUE']["src"],
                    "property" => array(
                        "country" => $Tour["PROPERTY_COUNTRY_NAME"],
                        "city" => $Tour["PROPERTY_TOWN_NAME"],
                        "food" => $Tour["PROPERTY_FOOD_NAME"],
                        "days" => w($Tour["PROPERTY_DAYS_VALUE"]) . " " . w($Tour["PROPERTY_DAYS_VALUE"], 2),
                        "typetour" => $Tour["PROPERTY_TOURTYPE_NAME"],
                        "point" => $Tour["PROPERTY_POINT_DEPARTURE_NAME"],
                        "tourtype" => $Tour["PROPERTY_TOUR_TYPE_VALUE"],
                        "new" => $Tour["PROPERTY_NEW_VALUE"],
                        "free" => $Tour["PROPERTY_FREE_VALUE"],
                    )
                );
            }
        }*/
    }


    $db_Hotel = CIBlockElement::GetList(array("SORT" => "ASC"), Array("IBLOCK_ID" => Set::HOTELS_IBLOCK_ID, "ACTIVE" => "Y", "PROPERTY_MT_HOTELKEY" => $idHotels), false, false,
        Array("ID", "IBLOCK_ID", "NAME", "DETAIL_PAGE_URL", "PROPERTY_TYPE_ID", "PROPERTY_CAT_ID", "PROPERTY_TOWN.NAME", "PROPERTY_PICTURES", "PROPERTY_MT_HOTELKEY"));
    while ($Hotel = $db_Hotel->GetNext()) {
        if (!empty($Hotel["PROPERTY_MT_HOTELKEY_VALUE"])) {
            if (!empty($Hotel['PROPERTY_PICTURES_VALUE'])) {
                $Hotel['PROPERTY_PICTURES_VALUE'] = (ARRAY)$Hotel['PROPERTY_PICTURES_VALUE'];

                $Hotel['PROPERTY_PICTURES_VALUE'] = CFile::ResizeImageGet($Hotel['PROPERTY_PICTURES_VALUE'][0], array('width' => 297, 'height' => 198), BX_RESIZE_IMAGE_EXACT, true);
            }
            $arHotels[$Hotel["PROPERTY_MT_HOTELKEY_VALUE"]] = array(
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

    if(!empty($arTours))
        $response["tours"] = $arTours;

    if(!empty($arHotels))
        $response["hotels"] = $arHotels;
    else
        $response["hotels"] = array();

    /*if(isset($response["tours"])){
        foreach ($data["tours"] as $tour){
            if(!isset($response["tours"][$tour["id"]]))
                $response["tours"][$tour["id"]] = false;
        }
    }*/

    foreach ($data["hotels"] as $hotel){
        if(!isset($response["hotels"][$hotel["id"]]))
            $response["hotels"][$hotel["id"]] = false;
    }

	if (!empty($response['tours']) || !empty($response["hotels"]))
		$response['error'] = false;

	throw new \Exception();

} catch(\Exception $e) {
	header('Content-Type: application/json');
	echo json_encode($response);
}