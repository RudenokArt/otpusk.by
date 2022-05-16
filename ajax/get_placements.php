<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
try {

	$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
	
	$response = array('error' => true);

	if(!$request->isPost())
		throw new Exception();

	$mt_prop_code = "MT_HOTELKEY";

	Bitrix\Main\Loader::includeModule('iblock');

	$id = $request->getPost('id');
	if (!is_array($id) || empty($id))
		$id = -1; 

	$db_res = CIBlockElement::GetList(
			array('SORT' => 'DESC'),
			array(
				'IBLOCK_ID' => Set::HOTELS_IBLOCK_ID,
				'PROPERTY_' . $mt_prop_code => $id
			),
			false,
			false,
			array('NAME', 'IBLOCK_SECTION_ID', 'PROPERTY_' . $mt_prop_code, 'PREVIEW_TEXT', 'DETAIL_PAGE_URL', 'PROPERTY_CAT_ID', 'PROPERTY_PICTURES', 'PROPERTY_COUNTRY.NAME', 'PROPERTY_TOWN.NAME', 'PROPERTY_HD_DESC', 'CODE', 'PROPERTY_TYPE_ID', 'PROPERTY_MAP')
		);

	while ($res = $db_res->GetNext()) {

		$sections = array();
		$db_sec = CIBlockElement::GetElementGroups($res['ID'], true);
		while ($sec = $db_sec->Fetch()) 
			$sections[] = $sec['ID'];

		$NAME = $res['NAME'];
		if (in_array($res['IBLOCK_SECTION_ID'], $sections) && $res['PROPERTY_CAT_ID_VALUE'] != "")
			$NAME .= " " . $res['PROPERTY_CAT_ID_VALUE'];

		$img = CFile::GetFileArray($res['PROPERTY_PICTURES_VALUE'][0]);
		$latlng = explode(',', $res['PROPERTY_MAP_VALUE']);
		$response['items'][] = array(
				'id' => $res['PROPERTY_' . $mt_prop_code . '_VALUE'],
				'name' => $NAME,
				'detail_url' => $res['PROPERTY_TYPE_ID_ENUM_ID'] != Set::SANATORII_PROP_ID ? $res['DETAIL_PAGE_URL'] : Set::SANATORII_SEF_FOLDER . $res['CODE'] . "/",
				'text' => $res['PROPERTY_HD_DESC_VALUE']['TEXT'] == "" ? "" : substr(strip_tags($res['~PROPERTY_HD_DESC_VALUE']['TEXT']), 0, 200) . "...",
				'image' => $img['SRC'],
				'place' => implode(', ', array($res['PROPERTY_COUNTRY_NAME'], $res['PROPERTY_TOWN_NAME'])),
				'latlng' => array('lat' => $latlng[0], 'lng' => $latlng[1])
			);

	}

	$pid = (int)$request->getPost('pid');
	if ($pid > 0) {

		
		$prop = CIBlockElement::GetList(
				array('SORT' => 'DESC'),
				array(
					'IBLOCK_ID' => Set::COUNTRY_IBLOCK_ID,
					'PROPERTY_' . $mt_prop_code => $pid
				),
				false,
				false,
				array('PROPERTY_MAP')
			)->Fetch();

		if ($prop['PROPERTY_MAP_VALUE'] == "") {

			$prop = CIBlockElement::GetList(
				array('SORT' => 'DESC'),
				array(
					'IBLOCK_ID' => Set::CITY_IBLOCK_ID,
					'PROPERTY_' . $mt_prop_code => $pid
				),
				false,
				false,
				array('PROPERTY_MAP')
			)->Fetch();

		}

		if ($prop['PROPERTY_MAP_VALUE'] != "") {
			$latlan = explode(',', $prop['PROPERTY_MAP_VALUE']);
			$response['latlng'] = array('lat' => $latlan[0], 'lng' => $latlan[1]);
		}

	}

	if (!empty($response['items']))
		$response['error'] = false;

	throw new \Exception();

} catch(\Exception $e) {
	header('Content-Type: application/json');
	echo json_encode($response);
}