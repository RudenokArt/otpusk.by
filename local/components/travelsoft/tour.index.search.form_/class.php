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
		/*$o = array("NAME" => "ASC");
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
		}*/

        $this->arResult['city'] = array();
        $this->arResult['city_'] = array();
        $db_res = CIBlockElement::GetList(array(), array("IBLOCK_ID" => $this->config['ct'], "ACTIVE" => "Y", "!=PROPERTY_".$this->config['pc'] => false), false, false, array("ID", "NAME", "PROPERTY_".$this->config['pc']));
        while($ob = $db_res->GetNext()){
            $this->arResult['city'][$ob["ID"]] = array(
                "ID" => $ob["ID"],
                "NAME" => $ob["NAME"],
                "TOURINDEX" => $ob["PROPERTY_".$this->config['pc']."_VALUE"]
            );
            $this->arResult['city_'][$ob["PROPERTY_".$this->config['pc']."_VALUE"]] = array(
                "ID" => $ob["ID"],
                "NAME" => $ob["NAME"],
                "TOURINDEX" => $ob["PROPERTY_".$this->config['pc']."_VALUE"]
            );
        }
        $this->arResult['country'] = array();
        $this->arResult['country_'] = array();
        $db_res = CIBlockElement::GetList(array(), array("IBLOCK_ID" => $this->config['ib'], "ACTIVE" => "Y", "!=PROPERTY_".$this->config['pc'] => false), false, false, array("ID", "NAME", "PROPERTY_".$this->config['pc']));
        while($ob = $db_res->GetNext()){
            $this->arResult['country'][$ob["ID"]] = array(
                "ID" => $ob["ID"],
                "NAME" => $ob["NAME"],
                "TOURINDEX" => $ob["PROPERTY_".$this->config['pc']."_VALUE"]
            );
            $this->arResult['country_'][$ob["PROPERTY_".$this->config['pc']."_VALUE"]] = array(
                "ID" => $ob["ID"],
                "NAME" => $ob["NAME"],
                "TOURINDEX" => $ob["PROPERTY_".$this->config['pc']."_VALUE"]
            );
        }
        $this->arResult['filter'] = array();
        if(!empty($this->arResult['city']) && !empty($this->arResult['country'])) {
            $city = array();$country = array();
            foreach($this->arResult['city'] as $key=>$val){
                if(!empty($val["TOURINDEX"]))
                    $city[$key] = $val["ID"];
            }
            foreach($this->arResult['country'] as $key=>$val){
                if(!empty($val["TOURINDEX"]))
                    $country[$key] = $val["ID"];
            }
            $db_res = CIBlockElement::GetList(Array("SORT"=>"ASC"), array("IBLOCK_ID" => Set::SEARCHFILTER_IBLOCK_ID, "ACTIVE" => "Y", "PROPERTY_CITYFROM_VALUE" => $city, "PROPERTY_COUNTRY_VALUE" => $country), false, false, array("*"));
            while ($ob = $db_res->GetNextElement()) {
                $p = $ob->GetProperties();
                if (isset($this->arResult['city'][$p["CITYFROM"]["VALUE"]]) && isset($this->arResult['country'][$p["COUNTRY"]["VALUE"]]) && !empty($this->arResult['city'][$p["CITYFROM"]["VALUE"]]["TOURINDEX"]) && !empty($this->arResult['country'][$p["COUNTRY"]["VALUE"]]["TOURINDEX"]))
                    $this->arResult['filter'][$this->arResult['city'][$p["CITYFROM"]["VALUE"]]["TOURINDEX"]][$this->arResult['country'][$p["COUNTRY"]["VALUE"]]["TOURINDEX"]] = $this->arResult['country'][$p["COUNTRY"]["VALUE"]]["TOURINDEX"];
            }
        }
        if(!empty($arParams['COUNTRY_FROM'])){
            foreach ($this->arResult['filter'] as $key=>$item_country){
                if(!isset($this->arResult['filter'][$key][$arParams['COUNTRY_FROM']])){
                    unset($this->arResult['filter'][$key]);
                }
            }
        }
        foreach ($this->arResult['filter'] as $k => $search) {

            $this->arResult['cities'][$k]['id'] = $this->arResult['city_'][$k]['TOURINDEX'];
            $this->arResult['cities'][$k]['name'] = $this->arResult['city_'][$k]['NAME'];
            $this->arResult['cities'][$k]['selected'] = $arParams['CITY_FROM'] == $k ? 1 : 0;
            //$this->arResult['cities'][$k]['selected'] = 0;
            foreach ($search as $p => $search2){
                $this->arResult['countries'][$p]['id'] = $this->arResult['country_'][$p]['TOURINDEX'];
                $this->arResult['countries'][$p]['name'] = $this->arResult['country_'][$p]['NAME'];
                $this->arResult['countries'][$p]['selected'] = $arParams['COUNTRY_FROM'] == $p ? 1 : 0;
                //$this->arResult['countries'][$p]['selected'] = 0;
            }

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
