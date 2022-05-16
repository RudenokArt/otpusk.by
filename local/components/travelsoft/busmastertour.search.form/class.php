<?
use Bitrix\Main\Loader;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

// форма поиска MasterTour
class BusMasterTourForm extends CBitrixComponent
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
		if(empty($arParams["TYPE_TOUR"]))
			$arParams["TYPE_TOUR"] = 12;

		Loader::includeModule('iblock');

        $this->arResult['city'] = getCityCountry(Set::CITY_IBLOCK_ID, "MT_HOTELKEY", "KEY_SLETAT");
        $this->arResult['country'] = getCityCountry(Set::COUNTRY_IBLOCK_ID, "CN_KEY", "KEY_SLETAT");
        $this->arResult['filter'] = getSearchFilterBusTours($this->arResult['city'], $this->arResult['country']);
        $this->arResult['dates'] = getDatesMT($arParams["TYPE_TOUR"]);

        foreach ($this->arResult['filter'] as $k => $search) {

            $this->arResult['cities'][$k]['name'] = $this->arResult['city'][$k]['NAME'];
            $this->arResult['cities'][$k]['selected'] = $arParams['CITY_FROM'] == $k ? 1 : 0;
            foreach ($search as $p => $search2){
                $this->arResult['countries'][$search2]['name'] = $this->arResult['country'][$search2]['NAME'];
                $this->arResult['countries'][$search2]['selected'] = $arParams['COUNTRY_FROM'] == $search2 ? 1 : 0;
            }

        }

		$this->arResult['action_url'] = $arParams['ACTION_URL'];

        /*$o = array("NAME" => "ASC");
        $f = array('IBLOCK_ID' => $this->config['ct'], '!=PROPERTY_'.$this->config['mt'] => false, "PROPERTY_SHOW_FILTER_MT_VALUE" => "Y");
        $s = array('ID', 'NAME', 'PROPERTY_'. $this->config['mt']);

        $dbRes = CIBlockElement::GetList($o, $f, false, false, $s);
        while($c = $dbRes->Fetch())
        {
            $this->arResult['cities'][$c['PROPERTY_'.$this->config['mt'].'_VALUE']]['name'] = $c['NAME'];

            $this->arResult['cities'][$c['PROPERTY_'.$this->config['mt'].'_VALUE']]['selected'] = $arParams['COUNTRY_FROM'] == $c['PROPERTY_'.$this->config['mt'].'_VALUE'] ? 1 : 0;
        }*/

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
