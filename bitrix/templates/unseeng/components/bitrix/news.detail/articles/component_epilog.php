<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
// /local/php_interface/inlclude/classes/settings.php
Set::$element_id_breadcrumb = $arResult['ID'];

if(!empty($arResult["DISPLAY_PROPERTIES"]["CANONICAL"]["DISPLAY_VALUE"])){
    $APPLICATION->AddHeadString('<link rel="canonical" href="' . "https://" . $_SERVER['SERVER_NAME'] . $arResult["DISPLAY_PROPERTIES"]["CANONICAL"]["DISPLAY_VALUE"] . '"/>');
}
?>