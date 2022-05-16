<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arResult['id'] = $arParams['MT_KEY'];
if ($arResult['CheckIn'] == "")
	$arResult['CheckIn'] = date('d.m.Y', time());
if ($arResult['CheckOut'] == "")
	$arResult['CheckOut'] = date('d.m.Y', time() + 7*24*3600);
if ($arResult['CheckOut'] == "")
	$arResult['CheckOut'] = date('d.m.Y', time() + 7*24*3600);

$arResult['Adults'] = (int)$arResult['Adults'];
$arResult['Children'] = (int)$arResult['Children'];

if ($arResult['Adults'] <= 0)
	$arResult['Adults'] = 2;

if ($arResult['Children'] < 0)
	$arResult['Children'] = 0;

$htl = CIBlockElement::GetList(
		false,
		array("IBLOCK_ID" => Set::HOTELS_IBLOCK_ID, "PROPERTY_MT_HOTELKEY" => $arResult['id']),
		false,
		false,
		array('ID'))->Fetch();

	
if ($htl['ID'] >0) {
	// КОРПУСА
	$db_res = CIBlockElement::GetList(
			false,
			array("IBLOCK_ID" => Set::CORPUSE_IBLOCK_ID, "=PROPERTY_HOTEL" => $htl['ID']),
			false,
			false,
			array('ID', "PROPERTY_MT_ROOM_KEY", "NAME")
		);

	while ($res = $db_res->Fetch()) {
		$arResult['CORPUSES'][$res['PROPERTY_MT_ROOM_KEY_VALUE']] = $res;
	}
}
