<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

						////////////////////
						// CORE FUNCTIONS //
						////////////////////

\Bitrix\Main\Loader::includeModule('iblock');

// запрашивам сущности с проставленным id мастертур
function getIBMTEntities ($ib, $mtproperty) {

	$db_res = CIBlockElement::GetList(
			false,
			array('IBLOCK_ID' => $ib, '!PROPERTY_'. $mtproperty => false),
			false,
			flase,
			array('ID', 'PROPERTY_'. $mtproperty)
		);

	while ($res = $db_res->Fetch()) {
		
		// массив сущностей
		$entities[$res['PROPERTY_'. $mtproperty .'_VALUE']] = $res['ID'];

	}

	return $entities ? $entities : flase;

}

// запрашиваем массив ID элементов инфоблока
function getElements ($filter, $select = array('*')) {

	$elements = array();

	$db_res = CIBlockElement::GetList(
			false,
			array($filter),
			false,
			flase,
			$select
		);

	while ($res = $db_res->Fetch()) {
		
		// массив сущностей
		$elements[] = $res['ID'];

	}

	return !empty($elements) ? $elements : false;

}

function update($id, $fields) {

	$el = new CIBlockElement;

	$el->Update($id, $fields);

}

function add ($fields) {

	$el = new CIBlockElement;

	$el->Add($fields);

}

// посылаем запрос на сторонний сервис
function sendRequest ($url, $method, $parameters) {

	return file_get_contents(
					$url,
					false,
					stream_context_create(
						array(
							'http' => array(
								'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
								'method'  => 'POST',
								'content' => json_encode( 
													array(
														"jsonrpc" => "2.0",
														"method"  => $method,
														"params"  =>  $parameters,
														"id" => 0
													)
												),
							),
						)
					)
				);

}

try {
	
	global $USER;
	
	// проверка у пользователя административных прав
	if (!$USER->IsAdmin()) {

		$USER->Logout();

		throw new Exception("");

	}

	// инфоблок отлей
	$ib4hotels = Set::HOTELS_IBLOCK_ID;

	// инфоблок для корпусов 
	$ib4corpuse = Set::CORPUSE_IBLOCK_ID;

	// код свойства id мастертур отеля в инфоблоке
	$mtproperty = "MT_HOTELKEY";
	$mt_room_property = "MT_ROOM_KEY";

	$hotels = getIBMTEntities($ib4hotels, $mtproperty);

	$corpuses = getIBMTEntities($ib4corpuse, $mt_room_property);

	if ($hotels && $corpuses)
		$hotels = $hotels + $corpuses;

	if (! $hotels )
		throw new Exception("");

	// инфоблок для выгрузки
	$ib4import = Set::ROOMS_IBLOCK_ID;

	// получаем раннее загруженные варианты размещения
	$rooms = getIBMTEntities($ib4import, $mt_room_property);

	foreach ($hotels as $mtid => $id) {
		
		$result = json_decode(

					sendRequest(

						"http://booking2.otpusk.by:8080/TSSE/json_handler.ashx",
						"hotel_get_description_rooms",
						array('hotel_id' => $mtid)

					), true

				);
	
		$mt_rooms = $result['result']['roomdesc'] ? $result['result']['roomdesc'] : false;

		if ($mt_rooms) {

			foreach ($mt_rooms as $key => $value) {

				$mtid_room = $value['rt_id'] . "_" . $value['rc_id'] . "_" . $mtid;

				if (isset($rooms[$mtid_room]))

					update(
						$rooms[$mtid_room],
						array(
							"NAME" => $value['rt_name'] . " " . $value['rc_name']
						)
					);

				else

					add(
						array(
							'IBLOCK_ID' => $ib4import,
							'NAME' => $value['rt_name'] . " " . $value['rc_name'],
							'PROPERTY_VALUES' => array(
									$mt_room_property => $mtid_room,
									"HOTEL" => $id
								)
						)
					); 

			}

		}

	}

	throw new Exception("ok");
	
		

} catch (\Exception $e) {

	$message = $e->getMessage();

	if ($message == "")
		LocalRedirect("/bitrix/admin/");

	LocalRedirect("/bitrix/admin/iblock_list_admin.php?IBLOCK_ID=".$ib4import."&type=Reference&lang=ru");

}