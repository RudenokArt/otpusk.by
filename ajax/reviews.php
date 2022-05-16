<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
try
{
	$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
	
	$response = array('resp' => false);

	if(!$request->isPost())
		throw new Exception();

	$page = (int)$request->getPost("page");
	$cnt = (int)$request->getPost("cnt");
	$sort = $request->getPost("sort") ? $request->getPost("sort") : "ACTIVE_FROM";
	$order = $request->getPost("order") ? $request->getPost("order") : "DESC";
	$element_id = (int)$request->getPost("element_id");

	if($page < 2 || $cnt <= 0 || !is_exists2($element_id))
		throw new Exception();
		

	\Bitrix\Main\Loader::includeModule("iblock");

	$filter = array("=IBLOCK_ID" => Set::REVIEWS_IBLOCK_ID);
	
	if($cid > 0)
		$filter['PROPERTY_COUNTRY'] = $cid;
	
	$filter = array_merge($filter, $allowed[1][$objects]);

	$els = CIBlockElement::GetList(
			array($sort => $order),
			array("IBLOCK_ID" => Set::REVIEWS_IBLOCK_ID, "PROPERTY_PROPERTY_ELEMENT_ID" => $element_id, "ACTIVE" => "Y"),
			false,
			array('nPageSize' => $cnt, 'iNumPage' => $page),
			array(
					"ID",
					"NAME",
					"DETAIL_TEXT",
					"DATE_ACTIVE_FROM",
					"PROPERTY_RATING"
			)
		);

	$reviews = array();

	while($el = $els->GetNext())
	{
		$reviews[$el['ID']]['name'] = $el['NAME'];
		
		if($el['DATE_ACTIVE_FROM'] != "")
			$reviews[$el['ID']]['date'] = ConvertDateTime($el['DATE_ACTIVE_FROM'], "DD.MM.YYYY");

		$reviews[$el['ID']]['text'] = $el['DETAIL_TEXT'];

		if($el['PROPERTY_RATING_VALUE'] > 0)
			$reviews[$el['ID']]['rating'] = (int)$el['PROPERTY_RATING_VALUE'];
	}

	if(!empty($reviews))
		$response = array('resp' => true, 'reviews' => $reviews);

	throw new Exception();
	
	
} catch(\Exception $e) {
	header('Content-Type: application/json');
	echo json_encode($response);
}