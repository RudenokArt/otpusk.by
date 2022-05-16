<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
try {

	$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();

	$response = array('error' => true);

	if(!$request->isPost())
		throw new Exception();

	Bitrix\Main\Loader::includeModule('iblock');

	$mt_prop_code = "MT_HOTELKEY";



	$id = $request->getPost('id');
	if (!is_array($id) || empty($id))
		$id = -1;

	$db_res = CIBlockElement::GetList(
			false,
			array(
				'IBLOCK_ID' => Set::HOTELS_IBLOCK_ID,
				'PROPERTY_' . $mt_prop_code => $id
			),
			false,
			false,
			array('NAME', 'PROPERTY_SEARCH.ID', 'PROPERTY_CAT_ID', 'PROPERTY_' . $mt_prop_code)
		);

	$cache = $filter = array();

	while ($res = $db_res->GetNext()) {

		if (!isset($filter['name'])) {
			
			$filter['name'] = array(
					'type' => 'text',
					'title' => 'Имя',
					'name' => 'name',
					'values' => array(),
					'contain' => array()
				);
		}

		$filter['name']['values'][$res['NAME']] = $res['NAME'];
		$filter['name']['contain'][$res['NAME']][] = $res['PROPERTY_' . $mt_prop_code . '_VALUE'];

		setFilterByLinkElement($res, $filter, "PROPERTY_SEARCH_ID",  $cache, "services", "Услуги", "checkbox", $mt_prop_code);
		setFilterByList($res, $filter, "PROPERTY_CAT_ID_ENUM_ID", "PROPERTY_CAT_ID_VALUE", "category", "Категория", "select", $mt_prop_code);

	}

	if (!empty($filter))
		$response['error'] = false;

	$response['filter'] = $filter;

	throw new \Exception();


} catch (\Exception $e) {
	header('Content-Type: application/json');
	echo json_encode($response);
}



function setFilterByLinkElement (&$el, &$filter, $property,  &$cache, $f_name, $f_title, $f_type, $mt_prop_code) {

	if ($el[$property] > 0) {

		if (!$cache[$el[$property]]) {

			$val = CIBlockElement::GetByID($el[$property])->GetNextElement()->GetFields();

			$cache[$el[$property]] = $val['NAME'];

		}

		if (!isset($filter[$f_name])) {
		
			$filter[$f_name] = array(
					'type' => $f_type,
					'title' => $f_title,
					'name' => $f_name,
					'values' => array(),
					'contain' => array()
				);
		}

		$filter[$f_name]['values'][$el[$property]] = $cache[$el[$property]];
		if (!in_array($el['PROPERTY_' . $mt_prop_code . '_VALUE'], $filter[$f_name]['contain'][$el[$property]]))
			$filter[$f_name]['contain'][$el[$property]][] = $el['PROPERTY_' . $mt_prop_code . '_VALUE'];

	}

}

function setFilterByList (&$el, &$filter, $property, $property_val, $f_name, $f_title, $f_type, $mt_prop_code) {

	if ($el[$property] > 0) {

		if (!isset($filter[$f_name])) {
		
			$filter[$f_name] = array(
					'type' => $f_type,
					'title' => $f_title,
					'name' => $f_name,
					'values' => array(),
					'contain' => array()
				);
		}

		$filter[$f_name]['values'][$el[$property]] = $el[$property_val];
		if (!in_array($el['PROPERTY_' . $mt_prop_code . '_VALUE'], $filter[$f_name]['contain'][$el[$property]]))
			$filter[$f_name]['contain'][$el[$property]][] = $el['PROPERTY_' . $mt_prop_code . '_VALUE'];

	}

}