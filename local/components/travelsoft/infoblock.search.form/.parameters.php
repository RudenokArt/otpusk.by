<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader;

$config = include __DIR__ . "/config.php";

Loader::includeModule('iblock');

$o = array('SORT' => 'ASC');
$f = array('IBLOCK_ID' => $config['ib'], '!=PROPERTY_'. $config['pc'] => false);
$s = array('ID', 'NAME', 'PROPERTY_'. $config['pc']);

$arComponentParameters['PARAMETERS'] = array(
		"ACTION_URL" => array(
			"PARENT" => "BASE",
			"NAME" => 'URL перенаправления',
			"TYPE" => "TEXT",
		),
	);
