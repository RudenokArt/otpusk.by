<?
/**
* Bitrix component show order list information
*
* @author dimabresky
*
*/

class TravelSoftOrderList extends CBitrixComponent
{	
	/**
	* application errors
	*/
	public $errors 				= array();

	/**
	* current currency
	*/
	public $currency 			= "BYN";

	/**
	* order statuses
	*/
	public $status				= array(
										0  => "В работе",
										1  => "Не определен",
										2  => "Аннулирован",
										3  => "Wait-лист",
										4  => "Не подтвержден",
										5  => "Wait-лист+Не подтв.",
										6  => "Ожидание",
										7  => "Ok",
										11 => "Web-турагент",
										12 => "Web-гость",
										16 => "Выставлен Счет",
										17 => "Подтверждено",
										18 => "Возврат путевки",
									);

	
	/**
	* execution component
	*/
	public function prepareParameters () {

		$arParams = &$this->arParams;

		if ($arParams['QUERY_ADDRESS'] == "")
			$this->errors[] = "Необходимо установить адрес для запроса списка заказов";

		if ($arParams['PAYMENT_ADDRESS'] == "")
			$this->errors[] = "Необходимо указать шаблон страницы для оплаты заказов";

		if (!empty($this->errors))
			throw new Exception(implode("<br>", $this->errors));
			

	}

	public function executeComponent() {

		try {

			$this->prepareParameters();

			

			$email = $GLOBALS['USER']->GetEmail();

			$errNoOrders = "У Вас нет заказов";

			if (!check_email($email)) 
				$this->errors[] = $errNoOrders;

			if (empty($this->errors)) {

				$result = json_decode(
					$this->sendRequest(
						$this->arParams['QUERY_ADDRESS'],
						'get_dogovors_by_user',
						array(
							"user_mail" => $email,
							"user_id" => function_exists("getMTUserKey") ? getMTUserKey($GLOBALS['USER']->GetID()) : ""
						)
					), true
				);

				if ($result['error']) {
					$this->errors[] = "Произошла ошибка сервиса при попытке получить список заказов. Обратитесь к администрации сайта";
				}
				
				$result = $result['result'];

				if (empty($this->errors) && !empty($result) && $result != null) {
					
					foreach ($result as $key => $value) {
						$this->arResult['ORDERS'][$key]['CODE'] = $value['dogovor_code'];
						$this->arResult['ORDERS'][$key]['STATUS'] = $this->status[$value['dogovor_status']];
						$this->arResult['ORDERS'][$key]['CHECK_IN'] = $value['tour_date'];
						$this->arResult['ORDERS'][$key]['TOTAL_PRICE'] = $value['total_price'];

						$this->arResult['ORDERS'][$key]['PAID_SUM'] = $value['paid_sum'];
						
						foreach ($value['services'] as $k => $v) {
							$this->arResult['ORDERS'][$key]['SERVICES'][$k] = array(
									"TITLE" => $v['title'],
									"STATUS" => $v['status'],
									"BOOK_ID" => $v['book_id']
								);
						}

						foreach ($this->arResult['ORDERS'][$key]['TOTAL_PRICE'] as $c => $v) {
							$this->arResult['ORDERS'][$key]['TO_PAY'][$c] = $v - $this->arResult['ORDERS'][$key]['PAID_SUM'][$c];
						}

						$this->arResult['ORDERS'][$key]['BTN_TXT'] = /*$this->arResult['ORDERS'][$key]['TO_PAY'][$this->currency] > 0 ? "Оплатить" : */"Подробнее";



						$this->arResult['ORDERS'][$key]['PAY_ADDRESS'] = str_replace("#ORDER_ID#", $value['dogovor_code'], $this->arParams['PAYMENT_ADDRESS']);
					}
					
				}

			}

			if (!$this->arResult['ORDERS']) 
				$this->errors[] = $errNoOrders;

			$this->arResult['CURRENCY'] = $this->currency;

			$this->arResult['ERRORS'] = $this->errors;

			$this->IncludeComponentTemplate();

		} catch (Exception $e) {

			ShowError($e->getMessage());

		}

	}

	

	/**
	* send request on booking server
	* 
	* @param string $method ('hotel_book' or 'create_new_dogovor')
	* @param array $parameters
	* 
	* @return json
	*/
	public function sendRequest ($url, $method, $parameters) {

		return file_get_contents(
				$url,
				false,
				stream_context_create(
					array(
						'ssl' => array("verify_peer" => false),
						'http' => array(
							'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
							'method'  => 'POST',
							'content' => json_encode( 
												array(
													"jsonrpc" => "2.0",
													"method"  => $method,
													"params"  =>  $parameters,
													"id" => 0
												)
											),
						),
					)
				)
			);

	}

}
