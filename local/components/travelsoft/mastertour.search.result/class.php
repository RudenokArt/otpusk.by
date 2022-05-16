<?
use Bitrix\Main\Loader;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

// выдача результатов мастертура
class SearchMasterResult extends CBitrixComponent {

	public function prepare() {

		if ($this->arParams['QUERY_ADDRESS'] == "")
			throw new \Bitrix\Main\ArgumentException("Укажите адрес для запроса в параметрах компонента");
	}

	public function executeComponent() {

		$this->prepare();

		$request = Bitrix\Main\Application::getInstance()->getContext()->getRequest();

        $cityFrom = (int)$request->getQuery('ct');
        $country = (int)$request->getQuery('co');
        $cityList = getCityCountry(Set::CITY_IBLOCK_ID, "MT_HOTELKEY", "KEY_SLETAT");
        $countryList = getCityCountry(Set::COUNTRY_IBLOCK_ID, "CN_KEY", "KEY_SLETAT");
        $filterList = getSearchFilter ($cityList, $countryList);

        /*$ar_def_city = $cityList[key($filterList)];
        $ar_def_country_list = current($filterList);*/

        if(empty($cityFrom) || empty($country)){

            $default_direction = getDefaultDirection();

            if(!empty($default_direction)){

                $cityFrom = $default_direction["cityfrom"];
                $country = $default_direction["country"];

            } else {

                $cityFrom = key($filterList);
                $country = key(current($filterList));

            }


            /*if(!empty($ar_def_city["MASTERTOUR"])){

                $country = (int)$countryList[array_search(163, $ar_def_country_list)]["MASTERTOUR"];

            }else{

                $country = (int)$countryList[array_search(164, $ar_def_country_list)]["SLETAT"];

            }*/

        }

        $date_from = '';

        /*$dates = getDatesMT();
        $arDates = array();
        if(!empty($dates)) {
            if (isset($dates[$cityFrom][$country])) {
                $arDates = $dates[$cityFrom][$country][1000];
                $date_from = $arDates[0];
            } else {
                $arDates = $dates;
            }
        }*/

        /*$check_in = $request->getQuery('df');
        $check_out = $request->getQuery('dt');*/

        if(!empty($request->getQuery('df'))){
            $check_in = $date = $request->getQuery('df');
            $date = new DateTime($check_in);
        }
        else{
            if(!empty($date_from)){
                $date = new DateTime($date_from);
                $check_in = $date->format('d.m.Y');
            }
            else {
                $date = new DateTime(date('d.m.Y'));
                $check_in = $date->format('d.m.Y');
            }
        }
        if(!empty($request->getQuery('dt'))){
            $check_out = $date = $request->getQuery('dt');
        }
        else{
            $check_out = $date->modify('+30 day');
            $check_out = $check_out->format('d.m.Y');
        }

		$unxi_check_in = MakeTimeStamp($check_in);
		$unxi_check_out = MakeTimeStamp($check_out);


        $child_age1 = $request->getQuery('age1');
        $child_age2 = $request->getQuery('age2');
        $child_age3 = $request->getQuery('age3');

		/*if ($check_in != "" &&
				$check_out != "" && 
					$unxi_check_in >= $unxi_check_out) {
			$check_out = date('d.m.Y', MakeTimeStamp($_REQUEST['df']) + 24*3600);
		}*/

        if(isset($this->arParams['BUS_TOURS']) && $this->arParams['BUS_TOURS'] == "Y")
            $filterListBus = getSearchFilterBusTours($cityList,$countryList);

        $link = 163;
        if (isset($filterList[$cityFrom]) && isset($filterList[$cityFrom][$country]))
            $link = (int)$filterList[$cityFrom][$country];

        $nightsFrom = !empty($request->getQuery('nf')) ? (int)$request->getQuery('nf') : 7;
        if(!empty($request->getQuery('nt'))){
            $nightsTo = (int)$request->getQuery('nt');
        }
        elseif(!empty($request->getQuery('nf'))){
            $nightsTo = (int)$request->getQuery('nf');
        }
        else{
            $nightsTo = 14;
        }

		$this->arResult = array(
				//'cityFrom'    => (isset($cityList[$cityFrom]) ? ($link == 164 ? $cityList[$cityFrom]["SLETAT"] : $cityList[$cityFrom]["MASTERTOUR"]) : (int)$request->getQuery('ct')),
				//'country' 	  => (isset($countryList[$country]) ? ($link == 164 ? $countryList[$country]["SLETAT"] : $countryList[$country]["MASTERTOUR"]) : (int)$request->getQuery('co')),
                'cityFrom'  => $cityFrom,
                'country'   => $country,
                'CheckIn' 	=> htmlspecialchars($check_in),
				'CheckOut' 	=> htmlspecialchars($check_out),
                'NightIn' 	=> $nightsFrom,
				'NightOut' 	=> $nightsTo,
				'Adults' 	=> !empty($request->getQuery('ad')) ? (int)$request->getQuery('ad') : 2,
				'Children' 	=> !empty($request->getQuery('ch')) ? (int)$request->getQuery('ch') : 0,
                'searchId' => time() * 1000,
                //'linkId' => $link,
                //'queryAddress' => ($link == 164 ? htmlspecialchars($this->arParams['QUERY_ADDRESS_SLETAT']) : htmlspecialchars($this->arParams['QUERY_ADDRESS'])),
                'queryAddress'  => htmlspecialchars($this->arParams['QUERY_ADDRESS']),
                'queryAddressSletat' => htmlspecialchars($this->arParams['QUERY_ADDRESS_SLETAT']),
                'cityList' => $cityList,
                'countryList' => $countryList,
                'filterList' => $filterList,
				//'price_type' => (int)$request->getQuery('price_type')
			);

        if($child_age1 != "")
            $this->arResult["age1"] = (int)$child_age1;
        if($child_age2 != "")
            $this->arResult["age2"] = (int)$child_age2;
        if($child_age3 != "")
            $this->arResult["age3"] = (int)$child_age3;

        if(!empty($request->getQuery('meals'))){
            $this->arResult["meals"] = $request->getQuery('meals');
            $this->arResult["meals"] = array_map('intval', $this->arResult["meals"]);
        }
        if(!empty($request->getQuery('stars'))){
            $this->arResult["stars"] = $request->getQuery('stars');
        }
        if(!empty($request->getQuery('cities'))){
            $this->arResult["cities"] = $request->getQuery('cities');
            $this->arResult["cities"] = array_map('intval', $this->arResult["cities"]);
        }
        if(!empty($request->getQuery('hotels'))){
            $this->arResult["hotels"] = $request->getQuery('hotels');
            $this->arResult["hotels"] = array_map('intval', $this->arResult["hotels"]);
        }

        if(isset($this->arParams['BUS_TOURS']) && $this->arParams['BUS_TOURS'] == "Y")
            $this->arResult['filterListBus'] = $filterListBus;


		if ($request->isPost() && $request->getPost('baction') === 'add2cart' && check_bitrix_sessid() && !empty($request->getPost('TOUR'))) {

		    $tour = $request->getPost('TOUR');

			$cart = new \travelsoft\Cart;

			$cart->clear();

			$cart->add(array(
					'priceKey' 		=> htmlspecialchars($tour['priceKey']),
					'INC_TOUR' 		=> true,
                    'requestId' 	=> htmlspecialchars($tour['requestId']),
                    'sourceId' 		=> htmlspecialchars($tour['sourceId']),
                    'offerId' 		=> htmlspecialchars($tour['offerId']),
				));

			LocalRedirect("/personal/cart/");

		}

		$this->IncludeComponentTemplate();

	}

}