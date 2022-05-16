<?
/**
* Bitrix component show order detail information
*
* @author dimabresky
*
*/

class TravelSoftOrderPayment extends CBitrixComponent
{	

	/**
	* request object
	*/
	public $request 			= null;

	/**
	* application errors
	*/
	public $errors 				= array();

	/**
	* currenct currency
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
			$this->errors[] = "Укажите Адрес запроса для получения информации по заказу";

		if ($arParams['ORDER_LIST_PAGE'] == "")
			$this->errors[] = "Укажите Страницу списка заказов";

		if (empty($arParams['PAYMENTS']))
			$this->errors[] = "Не указаны способы оплаты";

		if (!empty($arParams['PAYMENTS']) && $arParams['CARD_PAYMENT_ADDRESS'] == "")
			$this->errors[] = "Укажите Шаблон адреса запроса на страницу сервиса оплаты (оплата картой)";
		if (!empty($arParams['PAYMENTS']) && $arParams['ERIP_PAYMENT_ADDRESS'] == "")
			$this->errors[] = "Укажите Шаблон адреса запроса на страницу сервиса оплаты (оплата ерип)";

		if (!empty($this->errors))
			throw new Exception(implode("<br>", $this->errors));
			

	}

	public function executeComponent() {

		try {

			$this->prepareParameters();
		
			$this->request = Bitrix\Main\Application::getInstance()->getContext()->getRequest();

			$email = $GLOBALS['USER']->GetEmail();

			$this->arResult['TICKET'] = $this->request->get('ticket');

			if ( $this->arResult['TICKET'] == "" || !check_email($email) ) 
				LocalRedirect($this->arParams['ORDER_LIST_PAGE']);

			$result = json_decode(
				$this->sendRequest(
					$this->arParams['QUERY_ADDRESS'],
					'get_dogovor_info',
					array (
						"user_mail" => $email,
						"user_id" => function_exists("getMTUserKey") ? getMTUserKey($GLOBALS['USER']->GetID()) : "",
						"dogovor_code" => $this->arResult['TICKET']
					)
				), true
			);

			$result = $result['result'];

			if (!isset($result['turists'])) 
				$this->errors[] = "Произошла ошибка сервиса при попытке получить информацию по путёвке #" . $this->arResult['TICKET'] . ". Обратитесь к администрации сайта.";

			if (empty($this->errors)) {

				// set order info

				foreach($result['turists'] as $tourist) {

					$this->arResult['ORDER']["TOURISTS"][] = array(

							"NAME" => $tourist['first_name'],
							"LAST_NAME" =>$tourist['last_name'],
							"BIRTHDATE" => $tourist['birth_date'],
							"GENDER" => $tourist['gender'] == 1 ? 'мужской' : 'женский', 
							"PASSPORT_NUMBER" => $tourist['passport_num']
						);

				}

				foreach($result['services'] as $service) {

					$this->arResult['ORDER']["SERVICES"][] = array(

							"NAME" => $service['title'],
							"PRICE" => $service['price'][$this->currency],
							"LONG" => $service['days_long'],
							"CHECK_IN" => $result['tour_date'] 

						);

				}


				$this->arResult['ORDER']["DATE_TOUR"] = $result['tour_date'];

				$this->arResult['ORDER']["TOTAL_PRICE"] = $result['total_price'][$this->currency];

				$this->arResult['ORDER']["CURRENCY"] = $this->currency;

				$this->arResult['ORDER']["PAID_SUM"] = $result['total_price'][$this->currency] - $result['paid_sum'][$this->currency];
				$this->arResult['ALLOW_STATUSES_FOR_PAYMENT'] = array(7, 17);
				$this->arResult['ORDER']["STATUS"] = array('ID' => $result['dogovor_status'], 'NAME' => $this->status[$result['dogovor_status']]);

				$this->arResult['ORDER_TITLE'] = "Номер заказа:";

				if (!empty($result['documents'])) {
					$this->arResult['ORDER']["DOCUMENTS"] = $result['documents'];
				}

				if ($this->arResult['ORDER']["PAID_SUM"] > 0) { 
					$prefix = 'payments';
					foreach ($this->arParams['PAYMENTS'] as $key => $value) {
						
						$TITLES = ARRAY('CARD' => 'Оплата картой', 'ERIP' => 'Оплата ЕРИП');

						switch ($value) {
							case 'CARD':
							case 'ERIP':
								$this->arResult['PAYMENTS'][] = array(
									'TITLE' => $TITLES[$value],
									'ID' => $prefix . $value,
									'FILE_TXT' => $prefix . $value,
									'IMG' => $value == 'CARD' ? $this->__path . '/images/payment-credit-cards.jpg' : "",
									'ADDRESS_TEMPLATE' => str_replace("#ORDER_ID#", $this->arResult['TICKET'], $this->arParams[$value.'_PAYMENT_ADDRESS'])
								);
								break;

							case 'CASH':
								$this->arResult['PAYMENTS'][] = array(
									'TITLE' => "Оплата наличными",
									'ID' => $prefix . $value,
									'FILE_TXT' => $prefix . $value,
								);
								break;
						}

					}
				}

			}

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

		$data = json_encode( 
					array(
						"jsonrpc" =>  "2.0",
						"method"  =>  $method,
						"params"  =>  $parameters,
						"id" 	  =>  0
					)
				);

		return file_get_contents(
				$url,
				false,
				stream_context_create(
					array(
						'ssl' => array('verify_peer' => false),
						'http' => array(
							'header'  => "Content-type: application/x-www-form-urlencoded\r\n". "Content-Length: " . strlen($data) . "\r\n",
							'method'  => 'POST',
							'content' => $data,
						),
					)
				)
			);

	}

}
