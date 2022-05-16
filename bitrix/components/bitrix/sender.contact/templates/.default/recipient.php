<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/** @var \CAllMain $APPLICATION*/
/** @var array $arResult*/
/** @var array $arParams*/

global $APPLICATION;
$componentParameters = array(
	'CONTACT_ID' => $arResult['ID'],
	'PATH_TO_LIST' => $arResult['PATH_TO_LIST'],
	'PATH_TO_ADD' => $arResult['PATH_TO_ADD'],
	'PATH_TO_EDIT' => $arResult['PATH_TO_EDIT'],
	'PATH_TO_LETTER_EDIT' => $arResult['PATH_TO_LETTER_EDIT'],
	'SET_TITLE' => 'Y',
);
if ($_REQUEST['IFRAME'] == 'Y')
{
	$APPLICATION->IncludeComponent(
		"bitrix:sender.pageslider.wrapper",
		"",
		array(
			'POPUP_COMPONENT_NAME' => "bitrix:sender.contact.recipient",
			"POPUP_COMPONENT_TEMPLATE_NAME" => "",
			"POPUP_COMPONENT_PARAMS" => $componentParameters,
		)
	);
}
else
{
	$APPLICATION->IncludeComponent(
		"bitrix:sender.contact.recipient",
		"",
		$componentParameters
	);
}