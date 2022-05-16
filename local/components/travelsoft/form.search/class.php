<?
use Bitrix\Main\Loader;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

// форма поиска
class SearchForm extends CBitrixComponent
{

	public function prepareParameters()
	{
		$arParams = &$this->arParams;

		if (! Bitrix\Main\Loader::includeModule('iblock'))
			throw new \Bitrix\Main\ArgumentException("Модуль инфоблоков не подключен");

		if ($arParams['IBLOCK_ID'] <= 0)
			throw new \Bitrix\Main\ArgumentException("Не указан ID инфоблока");
			  
		
	}

	public function executeComponent()
	{
		$this->prepareParameters();

		$arParams = &$this->arParams;

		$arOrder = array('SORT' => 'ASC', 'NAME' => 'ASC');

		$arFilter = array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'PROPERTY_NOT_SHOW_MT' => FALSE, "ACTIVE" => "Y");

		if ($arParams['SECTION_ID'] > 0) {
			$arFilter['SECTION_ID'] = $arParams['SECTION_ID'];
			$arFilter['INCLUDE_SUBSECTIONS'] = "Y";
		}

		$arSelect = array('ID', 'NAME', 'CODE', 'DETAIL_PAGE_URL');

		$link_iblocks = $additional_search = null;

		if (!empty($arParams['ADDITIONAL_SEARCH'])) {

			foreach ($arParams['ADDITIONAL_SEARCH'] as $val) {
				$val = explode('_', $val);
				$arSelect[] = 'PROPERTY_' . $val[0];
				$link_iblocks[$val[0]][0] = $val[1];
			}

		}

		if (!empty($arParams['PROPERTY_CODE'])) {

			foreach ($arParams['PROPERTY_CODE'] as $code) {
				$prop_select[] = 'PROPERTY_' . $code;
			}

			$arSelect = array_merge($arSelect, $prop_select);
		}

		$ob_c = new CPHPCache();

		if ($ob_c->InitCache(0, serialize(array_merge($arFilter, $link_iblocks)), "/sf")) {
			$this->arResult = $ob_c->GetVars();
			
		}
		elseif ($ob_c->StartDataCache()) {

			global $CACHE_MANAGER;
			$CACHE_MANAGER->StartTagCache($c_dir); // связываем кеш с дирректорией

			$CACHE_MANAGER->RegisterTag('iblock_id_' . $arParams['IBLOCK_ID']); // вешаем тег

			$CACHE_MANAGER->EndTagCache(); // оканчиваем регистрацию кеша

			$db_res = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);

			while ($res = $db_res->GetNextElement()) {
				
				$fields = $res->GetFields();
				
				$this->arResult['SEARCH'][] = $fields;

				foreach ($link_iblocks as $code => $vals) {
					if ($fields['PROPERTY_' . $code . '_VALUE'] > 0) {
						$link_iblocks[$code][1][] = $fields['PROPERTY_' . $code . "_VALUE"];
					}
				}

			}

			$arOrder = array('NAME' => 'ASC');
			$arSelect = array('ID', 'NAME');

			if ($prop_select)
				$arSelect = array_merge($arSelect, $prop_select);

			foreach ($link_iblocks as $code => $vals) {
				
				$arFilter = array('IBLOCK_ID' => $vals[0], 'ID' => $vals[1]);

				$db_res = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);

				while ($res = $db_res->GetNextElement()) {
					$fields = $res->GetFields();
					$this->arResult['ADDITIONAL_SEARCH'][$code][$fields['ID']] = $fields;
				}
			}

			$ob_c->EndDataCache($this->arResult); // сохраняем выборку в кеш
		}

		$this->arResult['QUERY_ADDRESS'] = $arParams['QUERY_ADDRESS'];

		$this->IncludeComponentTemplate();
	}
}
