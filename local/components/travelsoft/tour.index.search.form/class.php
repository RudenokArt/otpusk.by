<?
use Bitrix\Main\Loader;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

// форма поиска tourindex
class TourIndexForm extends CBitrixComponent
{

	protected $config = null;
	protected $today;
	protected $date_from;

	public function prepareParameters()
	{
		$arParams = &$this->arParams;

		$arParams['NIGHT_FROM'] = $arParams['NIGHT_FROM'] > 0 ? (int)$arParams['NIGHT_FROM'] : $this->config['nf'];
		$arParams['NIGHT_TO']   = $arParams['NIGHT_TO'] > 0 ? (int)$arParams['NIGHT_TO'] : $this->config['nt'];

		$this->today = time() + $this->config['today+'];

		$this->date_from  = $arParams['DATE_FROM'] == "" ? date('d.m.Y', $this->today) : $arParams['DATE_FROM'];

		$arParams['ACTION_URL'] = htmlspecialchars($arParams['ACTION_URL']);
		
	}

	public function executeComponent()
	{

		$this->config = include __DIR__ . "/config.php"; 

		$this->prepareParameters();

		$arParams = &$this->arParams;

		Loader::includeModule('iblock');
		$o = array("NAME" => "ASC");
		$f = array('IBLOCK_ID' => $this->config['ib'], '!=PROPERTY_'.$this->config['pc'] => false);
		$s = array('ID', 'NAME', 'PROPERTY_'. $this->config['pc'], 'PROPERTY_' . $this->config['ti']);

		$dbRes = CIBlockElement::GetList($o, $f, false, false, $s);

		$co = array();
		while($c = $dbRes->Fetch())
		{
			$this->arResult['countries'][$c['PROPERTY_'.$this->config['pc'].'_VALUE']]['name'] = $c['NAME'];
			//if($arParams['COUNTRY_FROM'] == $c['PROPERTY_'.$this->config['pc'].'_VALUE'])
				//$this->arResult['ti_prop_value'] = (int)$c['PROPERTY_'.$this->config['ti'].'_ENUM_ID'];
			$arProp = CIBlockPropertyEnum::GetByID((int)$c['PROPERTY_'.$this->config['ti'].'_ENUM_ID']);
			
			$this->arResult['countries'][$c['PROPERTY_'.$this->config['pc'].'_VALUE']]['ti'] = $arProp['ID'] > 0 ? $arProp['XML_ID'] : -1;

			if($this->arResult['countries'][$c['PROPERTY_'.$this->config['pc'].'_VALUE']]['ti'] == "01")
				$this->arResult['countries'][$c['PROPERTY_'.$this->config['pc'].'_VALUE']]['ti'] = 0;

			$this->arResult['countries'][$c['PROPERTY_'.$this->config['pc'].'_VALUE']]['selected'] = $arParams['COUNTRY_FROM'] == $c['PROPERTY_'.$this->config['pc'].'_VALUE'] ? 1 : 0;
		}

		$this->arResult['action_url'] = $arParams['ACTION_URL'];

		foreach($this->config['ct'] as $id => $name)
		{
			$this->arResult['cities'][$id]['name'] = $name; 
			$this->arResult['cities'][$id]['selected'] = $arParams['CITY_FROM'] == $id ? 1 : 0;
		}

		$this->arResult['night'] = array(
					'max' => $this->config['nt'], 
					'from' => $arParams['NIGHT_FROM'], 
					'to' => $arParams['NIGHT_TO']
				);

		$this->arResult['date'] = $this->date_from;
		
		$df = MakeTimeStamp($this->date_from);

		$df_unix = $df - $this->config['delta'];
		$dt_unix = $df + $this->config['delta'];

		$this->arResult['date_from'] = ConvertTimeStamp($df_unix, "SHORT", "ru");
		$this->arResult['date_to'] 	 = ConvertTimeStamp($dt_unix, "SHORT", "ru");
		$this->arResult['adults'] 	 = $this->config['ad'];
		$this->arResult['children']  = $this->config['ch'];
		
		$this->IncludeComponentTemplate();
	}
}
