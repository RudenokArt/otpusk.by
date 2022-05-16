<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

try {

    $request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();

    if(!$request->isPost())
        throw new Exception();

    Bitrix\Main\Loader::includeModule('iblock');

    $data = Bitrix\Main\Web\Json::decode($request->getPost('query_data'), true);

    if ($data == null) {
        $response = array('error' => true);
        throw new \Exception();
    }

    $arCurrenty = getCurrenty();

    $response = number_format(convert_currency($data["price"], $arCurrenty[$data["currency"]], true), 2, ".", "");

    throw new \Exception();

} catch(\Exception $e) {
    header('Content-Type: application/json');
    echo json_encode($response);
}