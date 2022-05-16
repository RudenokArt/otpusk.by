<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader;

$config = include __DIR__ . "/config.php";

Loader::includeModule('iblock');

$o = array('SORT' => 'ASC');
$f = array('IBLOCK_ID' => $config['ib'], '!=PROPERTY_'. $config['pc'] => false);
$s = array('ID', 'NAME', 'PROPERTY_'. $config['pc']);

$dbRes = CIBlockElement::GetList($o, $f, false, false, $s);

$co = array('0' => 'Выберите');
while($c = $dbRes->Fetch())
	$co[$c['PROPERTY_'.$config['pc'].'_VALUE']] = $c['NAME'];

$arComponentParameters['PARAMETERS'] = array(
		"CITY_FROM" => array(
			"PARENT" => "BASE",
			"NAME" => 'Город отправления',
			"TYPE" => "LIST",
			"VALUES" => $config['ct']
		),

		"COUNTRY_FROM" => array(
			"PARENT" => "BASE",
			"NAME" => 'Страна прибытия',
			"TYPE" => "LIST",
			"VALUES" => $co
		),

		"DATE_FROM" => array(
			"PARENT" => "BASE",
			"NAME" => 'Дата отправления с в формате день.месяц.год (пример 01.01.2016)',
			"TYPE" => "TEXT",
		),

		"NIGHT_FROM" => array(
			"PARENT" => "BASE",
			"NAME" => 'Количетсво ночей от (от 1 до 14)',
			"TYPE" => "TEXT",
			"DEFAULT" => $config['nf']
		),

		"NIGHT_TO" => array(
			"PARENT" => "BASE",
			"NAME" => 'Количетсво ночей по (от 1 до 14)',
			"TYPE" => "TEXT",
			"DEFAULT" => $config['nt']
		),

		"ACTION_URL" => array(
			"PARENT" => "BASE",
			"NAME" => 'URL перенаправления',
			"TYPE" => "TEXT",
		),

	);
