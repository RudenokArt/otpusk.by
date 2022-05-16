<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader;

$ib = (int)$arCurrentValues['IBLOCK_ID'];

if($ib)
{
	Loader::includeModule("iblock");

	if($ib == 18) //туры
	{
		$arr = array(
				array(12, 'Страна', 'ADD_PROPERTY_95', 'N'),
				array(11, 'Город или курорт', 'ADD_PROPERTY_96', 'N'),
				array(28 , 'Тип турa', 'ADD_PROPERTY_101', 'N'),
				array(11 , 'Пункт отправления', 'ADD_PROPERTY_182', 'N'),
				array(32 , 'Тип транспорта', 'ADD_PROPERTY_102', 'N'),
				array($ib, 'Название тура', 'ADD_PROPERTY_ID', 'Y')
			);

		foreach($arr as $a)
		{
			$db_c = CIBlockElement::GetList(array("NAME" => "ASC"), array("IBLOCK_ID" => $a[0]), false, false, array("ID", "NAME"));
			
			$cs = array('-' => 'Выберите');
			while($c = $db_c->Fetch())
				$cs[$c['ID']] = $c['NAME'];
			
			if(!empty($cs))
			{
				$arTemplateParameters[$a[2]] = array(
					'NAME' => $a[1],
					'TYPE' => 'LIST',
					'MULTIPLE' => $a[3],
					'ADDITIONAL_VALUES' => 'N',
					'REFRESH' => 'N',
					'DEFAULT' => '-',
					'VALUES' => $cs,
					'PARENT' => 'ADDITIONAL_FILTER'
				);
			}
		}

		
		/* Даты тура */
		$arTemplateParameters['ADD_PROPERTY_97_min'] = array(
				'NAME' => 'Дата тура от',
				'TYPE' => 'CUSTOM',
				'JS_FILE' => Set::JS_PATH_FANCTIONS . "?" . rand(0,9999),
				'JS_EVENT' => 'CsCalendar',
				'JS_DATA' => json_encode(array('name_fld' => 'Выберите дату', 'reset' => 'Сброс')),
				'DEFAULT' => '',
				'MULTIPLE' => 'N',
				'REFRESH' => 'N',
				'ADDITIONAL_VALUES' => 'N',
				'PARENT' => 'ADDITIONAL_FILTER'
			);
		$arTemplateParameters['ADD_PROPERTY_97_max'] = array(
				'NAME' => 'Дата тура по',
				'TYPE' => 'CUSTOM',
				'JS_FILE' => Set::JS_PATH_FANCTIONS . "?" . rand(0,9999),
				'JS_EVENT' => 'CsCalendar',
				'JS_DATA' => json_encode(array('name_fld' => 'Выберите дату', 'reset' => 'Сброс')),
				'DEFAULT' => '',
				'MULTIPLE' => 'N',
				'REFRESH' => 'N',
				'ADDITIONAL_VALUES' => 'N',
				'PARENT' => 'ADDITIONAL_FILTER'
			);

		$arTemplateParameters['ADD_PROPERTY_110'] = array(
				'NAME' => 'Горячий тур',
				'TYPE' => 'CHECKBOX',
				'VALUES' => 'да',
				'DEFAULT' => '',
				'MULTIPLE' => 'N',
				'REFRESH' => 'N',
				'ADDITIONAL_VALUES' => 'N',
				'PARENT' => 'ADDITIONAL_FILTER'
			);
		$arTemplateParameters['ADD_PROPERTY_464'] = array(
				'NAME' => 'Раннее Бронирование',
				'TYPE' => 'LIST',
				'VALUES' => array('0' => 'N','171' => 'Y'),
				'DEFAULT' => '-',
				'MULTIPLE' => 'N',
				'REFRESH' => 'N',
				'ADDITIONAL_VALUES' => 'N',
				'PARENT' => 'ADDITIONAL_FILTER'
			);
	}
	else
		if($ib == 14) //отели
		{
			$arr = array(
				array(12, 'Страна', 'ADD_PROPERTY_61', 'N'),
				array(11, 'Город или курорт', 'ADD_PROPERTY_62', 'N'),
				array(36 , 'Медицинский профиль', 'ADD_PROPERTY_167', 'N'),
				array(24 , 'Категории поиска', 'ADD_PROPERTY_82', 'N'),
			);

			foreach($arr as $a)
			{
				$db_c = CIBlockElement::GetList(array("NAME" => "ASC"), array("IBLOCK_ID" => $a[0]), false, false, array("ID", "NAME"));
				
				$cs = array('-' => 'Выберите');
				while($c = $db_c->Fetch())
					$cs[$c['ID']] = $c['NAME'];
				
				
				$arTemplateParameters[$a[2]] = array(
					'NAME' => $a[1],
					'TYPE' => 'LIST',
					'MULTIPLE' => $a[3],
					'ADDITIONAL_VALUES' => 'N',
					'REFRESH' => 'N',
					'DEFAULT' => '-',
					'VALUES' => $cs,
					'PARENT' => 'ADDITIONAL_FILTER'
				);
				
			}

			$arr = array(
				array('60', 'Тип отеля', 'ADD_PROPERTY_60', 'N'),
				array('63', 'Категория', 'ADD_PROPERTY_63', 'N'),
				
			);

			foreach($arr as $a)
			{
				$db_c = CIBlockPropertyEnum::GetList(array("NAME" => "ASC"), Array("IBLOCK_ID"=> $ib, "PROPERTY_ID"=> $a[0]));
				
				$cs = array('-' => 'Выберите');
					while($c = $db_c->Fetch())
						$cs[$c['ID']] = $c['VALUE'];
			
				
				$arTemplateParameters[$a[2]] = array(
					'NAME' => $a[1],
					'TYPE' => 'LIST',
					'MULTIPLE' => $a[3],
					'ADDITIONAL_VALUES' => 'N',
					'REFRESH' => 'N',
					'DEFAULT' => '-',
					'VALUES' => $cs,
					'PARENT' => 'ADDITIONAL_FILTER'
				);
			}
		}
}


