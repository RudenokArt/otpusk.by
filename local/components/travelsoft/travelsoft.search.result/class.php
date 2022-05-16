<?
use Bitrix\Main\Loader;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

// выдача результатов мастертура
class SearchResult extends CBitrixComponent {

	public function prepare() {

		if ($this->arParams['QUERY_ADDRESS'] == "")
			throw new \Bitrix\Main\ArgumentException("Укажите адрес для запроса в параметрах компонента");
	}

	public function executeComponent() {

		$this->prepare();

		$request = Bitrix\Main\Application::getInstance()->getContext()->getRequest();

		$check_in = $request->getQuery('CheckIn');
		$check_out = $request->getQuery('CheckOut');

		$unxi_check_in = MakeTimeStamp($check_in);
		$unxi_check_out = MakeTimeStamp($check_out);

		if ($check_in != "" && 
				$check_out != "" && 
					$unxi_check_in >= $unxi_check_out) {
			$check_out = date('d.m.Y', MakeTimeStamp($_REQUEST['CheckIn']) + 24*3600);
		}

		$this->arResult = array(
				'id' 		=> (int)$request->getQuery('id'),
				'CheckIn' 	=> htmlspecialchars($check_in),
				'CheckOut' 	=> htmlspecialchars($check_out),
				'Adults' 	=> (int)$request->getQuery('Adults'),
				'Children' 	=> (int)$request->getQuery('Children'),
				'queryAddress' => htmlspecialchars($this->arParams['QUERY_ADDRESS']),
				'searchId' => time() * 1000,
				'price_type' => (int)$request->getQuery('price_type')
			);

		if(!empty($request->getQuery('cid'))) {
			$this->arResult["cid"] = (int)$request->getQuery('cid');
			$this->arResult["id"] = 0;
		}

        $this->arResult["cityList"] = getCityCountryMT(Set::CITY_IBLOCK_ID, "MT_HOTELKEY");
        $this->arResult["countryList"] = getCityCountryMT(Set::COUNTRY_IBLOCK_ID, "CN_KEY");

		if ($request->isPost() && $request->getPost('baction') === 'add2cart' && check_bitrix_sessid() && !empty($request->getPost('PRODUCT'))) {

			$product = $request->getPost('PRODUCT');

			$cart = new \travelsoft\Cart;

			$cart->clear();

			$cart->add(array(
					'ID' 		=> htmlspecialchars($product['ID']),
					'NAME' 		=> htmlspecialchars($product['NAME']),
					'ROOM_NAME' => htmlspecialchars($product['ROOM_NAME']),
					'CHECK_IN' 	=> htmlspecialchars($product['CHECK_IN']),
					'CHECK_OUT' => htmlspecialchars($product['CHECK_OUT']),
					'PEOPLE' 	=> (int)$product['PEOPLE'],
					'PRICE'		=> htmlspecialchars($product['PRICE']),
					'CURRENCY' 	=> htmlspecialchars($product['CURRENCY'])
				));

			LocalRedirect("/personal/cart/");

		} 

		$this->IncludeComponentTemplate();

	}

}