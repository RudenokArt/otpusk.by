<?php

$_SERVER["DOCUMENT_ROOT"] = realpath(dirname(__FILE__)."/../../../..");
$DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];

define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS",true);
define("NO_AGENT_STATISTIC",true);
define('NO_AGENT_CHECK', true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
@set_time_limit(0);
@ignore_user_abort(true);

Bitrix\Main\Loader::includeModule("iblock");
$CURDATE = date("d.m.Y");
$COURSES_IBLOCK_ID = 23;
$CURRENCY_IBLOCK_ID = 33;

# попытка получения валюты на текущий день из базы данных
$arCourse = CIBlockElement::GetList(false, array("ACTIVE" => "Y", "IBLOCK_ID" => $COURSES_IBLOCK_ID, "PROPERTY_DATE" => $CURDATE))->Fetch();

if ($arCourse["ID"] > 0) {
    exit;
}

# получение валюты на текущий день из нац.банка
$arImportCurrencyCourses = Bitrix\Main\Web\Json::decode(file_get_contents("http://www.nbrb.by/API/ExRates/Rates?onDate=".date('Y-m-d')."&Periodicity=0"));

$dbCurrency = CIBlockElement::GetList(false, array("ACTIVE" => "Y", "IBLOCK_ID" => $CURRENCY_IBLOCK_ID), false, false, array('ID', 'PROPERTY_ISO'));

while ($arCurrency = $dbCurrency->Fetch()) {

	$arIsoCurrency[] = $arCurrency["PROPERTY_ISO_VALUE"];

}

# фильтрация "нужных" курсов валют
$arCoursesNeeded = array_filter($arImportCurrencyCourses, function ($arItem) use ($arIsoCurrency) {
    return in_array($arItem["Cur_Abbreviation"], $arIsoCurrency);
});

$arSave = array(
    "IBLOCK_ID" =>$COURSES_IBLOCK_ID, 
    "NAME" => $CURDATE,
    "CODE" => date('d-m-Y'),
    "ACTIVE" => "Y",
    "PROPERTY_VALUES" => array(
        "DATE" => $CURDATE
    )
);

foreach ($arCoursesNeeded as $arValue) {
    $arSave["PROPERTY_VALUES"][$arValue["Cur_Abbreviation"]] = $arValue["Cur_OfficialRate"]/$arValue["Cur_Scale"];
}

$ibel = new CIBlockElement;
if (!empty($arCoursesNeeded)) {
    # добавляем
    $ibel->Add($arSave);
}