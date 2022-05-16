<?
/**
* Bitrix component show order detail information
*
* @author dimabresky
*
*/

class TravelSoftOrderDetail extends CBitrixComponent
{	
	/**
	* user is authorized ???
	*/
	public $authUser 			= false;

	public $mtUser 				= null;

	/**
	* request object
	*/
	public $request 			= null;

	/**
	* post form data
	*/
	public $form 				= null;

	/**
	* application errors
	*/
	public $errors 				= array();

	/**
	* data for booking send 
	*/
	public $dataBooking 		= array();

	/**
	* created number of ticket
	*/
	public $ticket 				= array();

	/**
	* array keys of created books
	*/
	public $bookKeys	 		= array();

	/**
	* all keys of tourists of booking
	*/
	public $touristsKeys 		= array();

	/**
	* current currency
	*/
	public $currency 			= "BYN";

	
	/**
	* execution component
	*/
	public function prepareParameters () {

		$arParams = &$this->arParams;

		if ($arParams['QUERY_ADDRESS_BOOKING'] == "")
			$this->errors[] = "Необходимо установить адрес для запроса на бронивание услуги";

		if ($arParams['QUERY_ADDRESS_TICKET'] == "")
			$this->errors[] = "Необходимо установить адрес для запроса на создание путёвки";

		if ($arParams['MAIL_EVENT'] == "")
			$this->errors[] = "Для отправки почты установите почтовое событие";

		if ($arParams['MAIL_USER_TEMPLATE'] == "")
			$this->errors[] = "Установите шаблон письма для пользователя";

		if ($arParams['MAIL_MANAGER_TEMPLATE'] == "")
			$this->errors[] = "Установите шаблон письма для менеджера";

		if ($arParams['MANAGER_EMAIL'] == "")
			$this->errors[] = "Установите email для менеджера";

		if (!empty($this->errors))
			throw new Exception(implode("<br>", $this->errors));
			

	}

	public function executeComponent() {

		try {

			$this->prepareParameters();
		
			$this->cart = new \travelsoft\Cart();

			$this->request = Bitrix\Main\Application::getInstance()->getContext()->getRequest();

			$this->authUser = $GLOBALS['USER']->isAuthorized();

			if ($this->request->isPost() && check_bitrix_sessid()) {

				if ($this->request->getPost('ajaxQuery') == 'Y') {

					$GLOBALS['APPLICATION']->RestartBuffer();

					// ajax check authorize
					if ($this->request->getPost('bxCheckAuth') == "Y") {

						$this->bxCheckAuth($this->request->getPost('email'));

					}

					// ajax do authorize
					if ($this->request->getPost('bxDoAuthorize') == "Y") {
						
						$this->bxDoAuthorize($this->request->getPost('email'), $this->request->getPost('pass'));

					}

					// ajax simple register
					if ($this->request->getPost('bxDoRegister') == "Y") {

						$this->bxDoRegister($this->request->getPost('email'));

					}
				}

				if ($this->request->getPost('submit') != "") {

					if ( $this->setPostData()->check() ) {
						
						$this->setDataBooking();
						
						if ($this->booking() && $this->createTicket()) {

							$this->cart->clear();

							$this->sendMails();

							$_SESSION['BOOKING_IS_DONE'] = true;

							LocalRedirect($this->arParams['PAYMENT_PAGE'] . "?ticket=" . $this->ticket);
								
							
						} else {
							$this->errors[] = "Произошла ошибка сервиса при бронировании. Для дополнительной информации свяжитесь с администрацией сайта.";
						}

					}

				}													

			}

			$this->deletePositionFromCart();

			$this->setResultCartData();

			$this->setUserEmail();

			$this->arResult['ERRORS'] = $this->errors;

			$this->IncludeComponentTemplate();

		} catch (Exception $e) {

			ShowError($e->getMessage());

		}

	}

	/**
	* check post data
	* @return boolean
	*/
	public function check () {

		if (!$this->authUser)
			$this->errors[] = 'Авторизуйтесь.';

		if (!check_email($this->form['email']))
			$this->errors[] = "Введите правильный email";


		if ($this->form['phone'] == "")
			$this->errors[] = "Введите телефон";

		$checked = array(
				"name" => false,
				"last_name" => false,
				"gender" => false,
				"birthdate" => false,
				"min_birthdate" => false,
				"passport_number" => false
			);

		$min_date = '01.01.1900';

		$min_birthdate = MakeTimeStamp($min_date);

		$tmplMess = "Поле #FIELD# должно быть уставновлено у всех туристов";

		foreach($this->form['tourists'] as $k => $tourists) {
			foreach ($tourists as $kk => $tourist) {
				
				if ($tourist['name'] == "" && !$checked['name']) {
					$this->errors[] = str_replace("#FIELD#", 'Имя', $tmplMess);
					$checked['name'] = true;
				}
				
				if ($tourist['last_name'] == "" && !$checked['last_name']) {
					$this->errors[] = str_replace("#FIELD#", 'Фамилия', $tmplMess);
					$checked['last_name'] = true;
				}
				
				if ($tourist['gender'] != 0 && $tourist['gender'] != 1 && !$checked['gender']) {
					$this->errors[] = str_replace("#FIELD#", 'Пол', $tmplMess);
					$checked['gender'] = true;
				}
				
				if (preg_match("#^\d{2}\.\d{2}\.\d{4}$#", $tourist['birthdate']) !== 1 &&
						 !$checked['birthdate']) {
					$this->errors[] = "Поле Дата рождения должно быть формата dd.mm.yyyy";
					$checked['birthdate'] = true;
				}

				if (MakeTimeStamp($tourist['birthdate']) < $min_birthdate &&
						 !$checked['min_birthdate']) {
					$this->errors[] = "Минимальная дата рождения должна быть " . $min_date;
					$checked['min_birthdate'] = true;
				}

				if ($tourist['passport_number'] == "" && !$checked['passport_number']) {
					$this->errors[] = str_replace("#FIELD#", 'Номер паспорта', $tmplMess);
					$checked['passport_number'] = true;
				}

			}
			
		}

		if ($this->form['accept_booking'] != "Y")
			$this->errors[] = "Необходимо ознакомится с договором публичной оферты и правилами аннуляции";

		if (!empty($this->errors))
			return false;

		return true;

	}

	/**
	* set post data in $form property
	* @return $this
	*/
	public function setPostData () {

		$this->form['email'] = $this->request->getPost('email');
		$this->form['phone'] = trim( str_replace(array('+', " "), array("",""), $this->request->getPost('phone')) );

		$this->form['tourists'] = $this->request->getPost('tourists');
		$this->form['comment'] = $this->request->getPost('comment');
		$this->form['accept_booking'] = $this->request->getPost('accept_booking');

		$this->form['capt'] = $this->request->getPost('capt');
		$this->form['capt_sid'] = $this->request->getPost('capt_sid');

		$this->arResult['POST'] = $this->form;

		return $this;

	}


	/**
	* delete position in cart
	*/
	public function deletePositionFromCart () {

		// delete position from cart
		if ($this->request->get('delFromCart') >= 0 && 
				$this->cart->checkPosition($this->request->get('delFromCart'))) {
					$this->cart->delete($this->request->get('delFromCart'));
					LocalRedirect($GLOBALS['APPLICATION']->GetCurDir());
				}

	}

	/**
	* set in $arResult cart items
	*/
	public function setResultCartData () {

		$this->arResult['CART'] = $this->cart->get();

        $current_currency = \travelsoft\Currency::getInstance()->get('current_currency');

		/*foreach ($this->arResult['CART'] as $arItem) {
		    if($GLOBALS["USER"]->IsAdmin()) dm($arItem);
			$this->arResult['TOTAL_PRICE'] += $arItem['PRICE'];
			$this->arResult['PEOPLE'] += $arItem['PEOPLE'];
		}*/

        foreach ($this->arResult['CART'] as $arItem) {
            $this->arResult['TOTAL_PRICE'] += str_replace(" ", "", \travelsoft\Currency::getInstance()->convertCurrency(
                $arItem['PRICE'], $arItem["CURRENCY"], $current_currency['iso'], true
            ));
            $this->arResult["CURRENT_CURRENCY"] = $current_currency['iso'];
            $this->arResult['PEOPLE'] += $arItem['PEOPLE'];
        }

		$this->arResult['CURRENCY'] = $this->currency;

	}

	/**
	* set in $arResult authorize user email
	*/
	public function setUserEmail () {

		if ($this->authUser)
			$this->arResult['USER_EMAIL'] = $GLOBALS['USER']->GetEmail();

	}

	/**
	* check user authorize
	* @param string $email
	*/
	public function bxCheckAuth ($email) {

		$res = Bitrix\Main\UserTable::getList(
			array(
				'select' => array('ID'),
				'filter' => array('EMAIL' => $email)
			)
		)->fetch();

		if($res['ID'] <= 0)
			die(json_encode(array('auth' => false)));					

		die(json_encode(array('auth' => true, 'mess' => 'Пользователь с таким email уже существует. Пожалуйста авторизуйтесь.')));

	}

	/**
	* do user authorization 
	* @param string $email
	* @param string $pass
	*/
	public function bxDoAuthorize ($email, $pass) {

		$login = $GLOBALS['USER']->Login($email, $pass, "Y", "Y");

		if($login !== true)
			die(json_encode(array('auth' => false, 'mess' => $login['MESSAGE'])));

		die(json_encode(array('auth' => true, 'mess' => 'Вы успешно авторизованы. Можно продолжать бронирование')));

	}

	/**
	* do user registration
	* @param string $email
	* @param string $pass
	*/
	public function bxDoRegister ($email) {

		$result = $GLOBALS['USER']->SimpleRegister($email);

		if($result["TYPE"] != "ERROR") {
			$GLOBALS['USER']->Authorize($GLOBALS['USER']->GetID());
			die(json_encode(array('register' => true)));

		} else
			die(json_encode(array('mess' => $result['MESSAGE'], 'register' => false)));	
	}

	/**
	* make data for booking
	*/
	public function setDataBooking () {

		foreach($this->cart->get() as $k => $arItem) {

			$dataBooking = array(

					'ID' => date('dm', MakeTimeStamp($arItem['CHECK_IN'])) . date('dm', MakeTimeStamp($arItem['CHECK_OUT'])) . "274---10",

					'USER_INFO' => array(
							"email" => $this->form['email'],
							"phone" => $this->form["phone"]
						),

					'VARIANT_ID' => $arItem['ID'],

					'PRICE' => str_replace('.', ',', $arItem['PRICE']),

					'RATE' => $this->currency,

				);

			foreach ($this->form['tourists'][$k] as $tourist) {

				$dataBooking['TOURISTS'][] = array(

					'last_name' => $tourist['last_name'],
					'first_name' => $tourist['name'],
					'birth_date' => $tourist['birthdate'],
					'citizenship' => "",
					'passport_num' => strtoupper(str_replace(" ", "", $tourist['passport_number'])),
					'passport_date' => '31.12.2050',
					'gender' => $tourist['gender'] == 1 ? 1 : 0

				);

			}

			$this->dataBooking[] = $dataBooking;

		}
 
	}

	/**
	* make booking
	*
	* @return boolean
	*/
	public function booking () {

		$sc = count($this->dataBooking);

		foreach ($this->dataBooking as $key => $value) {
			
			if (!empty($this->errors)) {
				return false;
			}

			$result = $this->sendRequest(
								$this->arParams['QUERY_ADDRESS_BOOKING'],
								'hotel_book',
								Array(
									'search_Id' => $value['ID'],
									'hotel_id' => 0,
									'user_info' => $value['USER_INFO'], 
									'rooms' => Array(
										Array(
											"variant_id" => $value['VARIANT_ID'],
											"price" => $value['PRICE'],
											"rate"  => $value['RATE'],
											"tourists"	=> $value['TOURISTS'],
										)
									)
								)
							);



			if ($result != "") {
				
				$arrRes = json_decode($result, true);

				if(isset($arrRes["result"]["book_number"])) {
					
					$this->bookKeys[] = $arrRes["result"]["book_number"];

					$this->touristsKeys = array_merge($arrRes['result']['tourists'], $this->touristsKeys);

				} else
					return false;
			} else
				return false;

		}

		if (count($this->bookKeys) == $sc && count($this->bookKeys) > 0) {
			return true;
		}

		return false;

	}

	/**
	* create new ticket
	* @return boolean
	*/
	public function createTicket () {

		$result = json_decode(
			$this->sendRequest(
				$this->arParams['QUERY_ADDRESS_TICKET'],  'create_new_dogovor', 
				array(
					"book_ids" => $this->bookKeys,
					"buyer_info" => array(
							"email" => $this->form['email'],
							"user_id" => function_exists("getMTUserKey") ? getMTUserKey($GLOBALS['USER']->GetID()) : "",
							"phone" => $this->form['phone']
						),
					"info" => $this->form['comment'],
					"login" => "",
					"packettype" => 0

				)
			), true);

		if ($result['result']['dogovor_code'] != "") {
			$this->ticket = $result['result']['dogovor_code'];
			return true;
		}

		return false;

	}

	/**
	* send mails for user and manager
	*/
	public function sendMails () {
		
		// for user
		CEvent::Send($this->arParams['MAIL_EVENT'], SITE_ID, array("EMAIL_TO" => $this->form['email']), "", $this->arParams['MAIL_USER_TEMPLATE']);

		// for manager
		CEvent::Send($this->arParams['MAIL_EVENT'], SITE_ID, array("EMAIL_TO" => $this->arParams['MANAGER_EMAIL'], "ORDER_CODE" => $this->ticket), "", $this->arParams['MAIL_MANAGER_TEMPLATE']);

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

		 $result = file_get_contents(
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

		return $result;

	}

}