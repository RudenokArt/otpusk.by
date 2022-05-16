<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
$data = Bitrix\Main\Web\Json::decode($request->getPost('query_data'), true);

// количество элементов на странице
$cnt_on_page = $data["countItemsPage"];

// номер пагинатора
$nav_num = 1;

// текущая страница
$page = intval($data["page"]);

// количество страниц
$cnt_pages = $data["countPage"];

// количество элементов
$cnt_items = $data["countItems"];

// параметры для пагинатора
$navResult = new CDBResult();

$navResult->NavPageCount = $cnt_pages;

$navResult->NavPageNomer = $page;

$navResult->NavNum = $nav_num;

$navResult->NavRecordCount = $cnt_items;

ob_start();
    $APPLICATION->IncludeComponent("bitrix:system.pagenavigation", "modernMT", array(
        "NAV_RESULT" => $navResult,
    ));
    $ar_res["NAV_STRING"] = ob_get_contents();
ob_end_clean();
$APPLICATION->RestartBuffer();
echo str_replace("/ajax/pagenavigation.php", $data["UrlPath"], $ar_res["NAV_STRING"]);
die();