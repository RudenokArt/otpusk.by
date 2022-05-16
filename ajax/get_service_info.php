<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
try {

	$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
	
	$response = array('error' => true);

	if(!$request->isPost())
		throw new Exception();

	Bitrix\Main\Loader::includeModule('iblock');

	$mt_prop_code = "MT_HOTELKEY";
	$mt_room_prop_code = "MT_ROOM_KEY";

	$data = json_decode($request->getPost('query_data'), true);

	if ($data == null)
		throw new \Exception();

	foreach ($data as $key => $value) {

		if( ! $el = CIBlockElement::GetList(false, array("IBLOCK_ID" => Set::CORPUSE_IBLOCK_ID, "PROPERTY_" . $mt_room_prop_code => $value['id']), false, false)->GetNextElement() )
			$el = CIBlockElement::GetList(false, array("IBLOCK_ID" => Set::HOTELS_IBLOCK_ID, "PROPERTY_" . $mt_prop_code => $value['id'] ), false, false)->GetNextElement(); 

		if ($el){

			$f = $el->GetFields();
			$p = $el->GetProperties();
			if ($p['CANCELLATION']['VALUE']['TEXT'] != "") {

				$MT_KEY = $p[$mt_prop_code]['VALUE'] > 0 ? $p[$mt_prop_code]['VALUE'] : $p[$mt_room_prop_code]["VALUE"];
				$response['cancellations'][$MT_KEY] = ARRAY('MT_KEY' => $MT_KEY, 'BX_ID' => $f['ID'], 'CANCELLATION' => $p['CANCELLATION']['VALUE']['TEXT']);
			}

			if ($p[$mt_prop_code]['VALUE'] > 0)
				$mtKeys[$f['ID']] = (int)$p[$mt_prop_code]['VALUE'];
			elseif ($p[$mt_room_prop_code]['VALUE'] > 0)
				$mtKeys[$f['ID']] = (int)$p[$mt_room_prop_code]['VALUE'];

			if ($f['IBLOCK_ID'] == Set::HOTELS_IBLOCK_ID) {		
				$items[$f['ID']] = false; // не корпус

			} else if ($f['IBLOCK_ID'] == Set::CORPUSE_IBLOCK_ID){
				$items[$f['ID']] = $f['NAME']; // корпус
			}

		}
	}

	if ($items) {

		// тянем удобства в размещениях
		$db_res = CIBlockElement::GetList(
			false,
			array('IBLOCK_ID' => Set::ROOM_SERVICES_IBLOCK_ID),
			false,
			false,
			array("ID", "NAME", 'PROPERTY_SERVICE_ICON')
		);

		while ($res = $db_res->Fetch()) {
			$rserv[$res['ID']] = $res;
		}


		// тянем размещения
		$db_res = CIBlockElement::GetList(
			false,
			array('IBLOCK_ID' => Set::ROOMS_IBLOCK_ID, 'PROPERTY_HOTEL' => array_keys($items)),
			false,
			false,
			array("ID", 'PROPERTY_MT_ROOM_KEY', 'PROPERTY_PHOTO', 'PROPERTY_ROOM_SERVICE', "PROPERTY_HOTEL")
		);

		while ($res = $db_res->Fetch()) {

			if ( $mtKeys[$res['PROPERTY_HOTEL_VALUE']] > 0 )
				$response['items'][$res['PROPERTY_MT_ROOM_KEY_VALUE']]['mt_id'] = $mtKeys[$res['PROPERTY_HOTEL_VALUE']];

			if (!empty($res['PROPERTY_PHOTO_VALUE'])) {
				$res['PROPERTY_PHOTO_VALUE'] = (ARRAY)$res['PROPERTY_PHOTO_VALUE'];

				$response['items'][$res['PROPERTY_MT_ROOM_KEY_VALUE']]['picture'] = CFile::ResizeImageGet($res['PROPERTY_PHOTO_VALUE'][0], array('width'=>600, 'height'=>400), BX_RESIZE_IMAGE_EXACT, true);
			}

			foreach ($res['PROPERTY_ROOM_SERVICE_VALUE'] as $key => $value) {
				$serv = $rserv[$value];
				if (isset($serv)) {

					if ($serv['PROPERTY_SERVICE_ICON_VALUE'] != "")

						$response['items'][$res['PROPERTY_MT_ROOM_KEY_VALUE']]['service'][0][] = array('name' => $serv['NAME'], 'class' => $serv['PROPERTY_SERVICE_ICON_VALUE']);
					else

						$response['items'][$res['PROPERTY_MT_ROOM_KEY_VALUE']]['service'][1][] = $serv['NAME'];


				}
					 
			}

			if ($items[$res['PROPERTY_HOTEL_VALUE']]) {
				$response['items'][$res['PROPERTY_MT_ROOM_KEY_VALUE']]['corpuse_name'] = $items[$res['PROPERTY_HOTEL_VALUE']];
			} else
				$response['items'][$res['PROPERTY_MT_ROOM_KEY_VALUE']]['corpuse_name'] = false;

		}		

	}

	if ($response['items'])
		$response['error'] = false;

	throw new \Exception();

} catch(\Exception $e) {
	header('Content-Type: application/json');
	echo json_encode($response);
}