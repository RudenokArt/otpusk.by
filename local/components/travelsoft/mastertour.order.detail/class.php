<?
\Bitrix\Main\Loader::includeModule('travelsoft.currency');
/**
* Bitrix component show order detail information
*
* @author dimabresky
*
*/

require($_SERVER["DOCUMENT_ROOT"]."/local/components/travelsoft/mastertour.search.result/lib/Autoloader.php");

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
	* key of price tour
	*/
	public $priceKeys	 		= array();

	/**
	* all keys of tourists of booking
	*/
	public $touristsKeys 		= array();

	/**
	* current currency
	*/
	public $currency 			= "BYN";

    /**
	* login for sletat.ru
	*/
	public $login 			    = 'support@ck.by';

    /**
	* pass for sletat.ru
	*/
	public $pass 			    = 'ck2010%^#qmvh';

    /**
	* array currency bx
	*/
	public $arCurrenty          = array();

    /**
	* xml for sletat.ru
	*/
	public $xml                 = null;


	/**
	* execution component
	*/
	public function prepareParameters () {

		$arParams = &$this->arParams;

		if ($arParams['QUERY_ADDRESS_BOOKING'] == "")
			$this->errors[] = "Необходимо установить адрес для запроса на бронивание услуги";

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

            $this->setResultCartData();

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

						if ($this->booking()) {

							$this->cart->clear();

							$this->sendMails();

							$_SESSION['BOOKING_IS_DONE'] = true;

							LocalRedirect($this->arParams['PAYMENT_PAGE'] . "?ticket=" .$this->ticket);
								
							
						} else {
							$this->errors[] = "Произошла ошибка сервиса при бронировании. Для дополнительной информации свяжитесь с администрацией сайта.";
						}

					}

				}

			}

			$this->deletePositionFromCart();

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
        $this->arResult['TOTAL_PRICE'] = 0;
        $this->arResult['PEOPLE'] = 0;
        $current_currency = \travelsoft\Currency::getInstance()->get('current_currency');

        foreach ($this->arResult['CART'] as $k=>$arItem) {
            if(!empty($arItem["priceKey"])) {
                $result = json_decode(
                    $this->sendRequest(
                        $this->arParams['QUERY_ADDRESS_BOOKING'], 'GetInfoServices',
                        array(
                            "priceKey" => $arItem["priceKey"]
                        )
                    ), true);

                if (!empty($result["result"])) {

                    $this->arResult['CART'][$k] = array(
                        "CHECK_IN" => htmlspecialchars(strip_tags($result["result"]["dateFrom"])),
                        "CHECK_OUT" => htmlspecialchars(strip_tags($result["result"]["dateTo"])),
                        "DEFAULT_PRICE_RATE" => htmlspecialchars(strip_tags($result["result"]["prices"][$result["result"]["defaultRate"]])) . ' ' . htmlspecialchars(strip_tags($result["result"]["defaultRate"])),
                        "DEFAULT_PRICE" => htmlspecialchars(strip_tags($result["result"]["prices"][$result["result"]["defaultRate"]])),
                        "DEFAULT_RATE" => htmlspecialchars(strip_tags($result["result"]["defaultRate"])),
                        "PRICE" => htmlspecialchars(strip_tags($result["result"]["prices"][$current_currency['iso']])).' '.$current_currency['iso'],
                        "PEOPLE" => htmlspecialchars(strip_tags($result["result"]["countTurist"]))
                    );
                    if ($result["result"]["hotels"]) {
                        $hotel = array(
                            "CITY" => htmlspecialchars(strip_tags($result["result"]["hotels"][0]["city"]["name"])),
                            "NAME" => htmlspecialchars(strip_tags($result["result"]["hotels"][0]["hotel"]["name"])) . ' ' . htmlspecialchars(strip_tags($result["result"]["hotels"][0]["hotel"]["star"])),
                            "MEAL" => htmlspecialchars(strip_tags($result["result"]["hotels"][0]["meal"]["name"])),
                            "NIGHT" => htmlspecialchars(strip_tags($result["result"]["hotels"][0]["night"])),
                            "ROOM_TYPE" => htmlspecialchars(strip_tags($result["result"]["hotels"][0]["roomType"])),
                            "ROOM_CAT" => htmlspecialchars(strip_tags($result["result"]["hotels"][0]["roomCat"])),
                            "ACCM" => htmlspecialchars(strip_tags($result["result"]["hotels"][0]["accm"]))
                        );
                        $this->arResult['CART'][$k] = array_merge($this->arResult['CART'][$k], $hotel);
                    } elseif ($result["result"]["services"]) {
                        $cnt_serv = count($result["result"]["services"]);
                        $i = 0;
                        foreach ($result["result"]["services"] as $serv) {

                            $this->arResult['CART'][$k]["SERVICES"] = '';
                            $this->arResult['CART'][$k]["SERVICES"] += htmlspecialchars(strip_tags($serv));
                            $this->arResult['CART'][$k]["SERVICES"] += $i < $cnt_serv ? ', ' : '';
                        }
                    }

                    $this->arResult['TOTAL_PRICE'] += htmlspecialchars(strip_tags($result["result"]["prices"][$current_currency['iso']]));
                    $this->arResult["CURRENT_CURRENCY"] = $current_currency['iso'];
                    $this->arResult['PEOPLE'] += htmlspecialchars(strip_tags($result["result"]["countTurist"]));

                }
            }
            elseif (!empty($arItem["requestId"]) && !empty($arItem["sourceId"]) && !empty($arItem["offerId"])){

                $this->arCurrenty = getCurrenty();
                $this->xml = new sletatru\XmlGate([
                    'login' => $this->login,
                    'password' => $this->pass,
                ]);
                $people = 0;
                $result["result"] = $this->xml->ActualizePrice($arItem["sourceId"], $arItem["offerId"], $arItem["requestId"]);
                if (!empty($result["result"]["TourInfo"])) {
                    //if($GLOBALS["USER"]->IsAdmin())dm($result["result"]["TourInfo"]);
                    if (isset($result["result"]["TourInfo"]["Adults"]) && !empty($result["result"]["TourInfo"]["Adults"]) && isset($result["result"]["TourInfo"]["Kids"])) {
                        $people = (int)$result["result"]["TourInfo"]["Adults"] + (int)$result["result"]["TourInfo"]["Kids"];
                    }
                    if (!empty($result["result"]["TourInfo"]["OriginalPriceCurrency"]) && $result["result"]["TourInfo"]["OriginalPriceCurrency"] == "RUR")
                        $result["result"]["TourInfo"]["OriginalPriceCurrency"] = "RUB";
                    $this->arResult['CART'][$k] = array(
                        "CHECK_IN" => htmlspecialchars(strip_tags($result["result"]["TourInfo"]["CheckIn"])),
                        "CHECK_OUT" => htmlspecialchars(strip_tags($result["result"]["TourInfo"]["CheckOut"])),
                        "DEFAULT_PRICE_RATE" => htmlspecialchars(strip_tags($result["result"]["TourInfo"]["Price"])) . ' ' . htmlspecialchars(strip_tags($result["result"]["TourInfo"]["PriceCurrency"])),
                        "DEFAULT_PRICE" => htmlspecialchars(strip_tags($result["result"]["TourInfo"]["Price"])),
                        "DEFAULT_RATE" => htmlspecialchars(strip_tags($result["result"]["TourInfo"]["PriceCurrency"])),
                        "ORIGIN_PRICE" => htmlspecialchars(strip_tags($result["result"]["TourInfo"]["OriginalPrice"])),
                        "ORIGIN_CURRENCY" => htmlspecialchars(strip_tags($result["result"]["TourInfo"]["OriginalPriceCurrency"])),
                        //"PRICE" => htmlspecialchars(strip_tags(number_format(convert_currency($result["result"]["TourInfo"]["Price"], $this->arCurrenty[$result["result"]["TourInfo"]["PriceCurrency"]], true), 2, ".", ""))),
                        "PRICE" => htmlspecialchars(strip_tags(\travelsoft\Currency::getInstance()->convertCurrency(
                            $result["result"]["TourInfo"]["Price"], $result["result"]["TourInfo"]["PriceCurrency"]
                        ))),
                        "PRICE_" => str_replace(" ", "", htmlspecialchars(strip_tags(\travelsoft\Currency::getInstance()->convertCurrency(
                            $result["result"]["TourInfo"]["Price"], $result["result"]["TourInfo"]["PriceCurrency"],$current_currency['iso'], true
                        )))),
                        "PEOPLE" => htmlspecialchars(strip_tags($people)),
                        "CITY" => htmlspecialchars(strip_tags($result["result"]["TourInfo"]["ResortName"])),
                        "NAME" => htmlspecialchars(strip_tags($result["result"]["TourInfo"]["HotelName"])) . ' ' . htmlspecialchars(strip_tags($result["result"]["TourInfo"]["StarName"])),
                        "MEAL" => htmlspecialchars(strip_tags($result["result"]["TourInfo"]["SysMealName"])),
                        "NIGHT" => htmlspecialchars(strip_tags($result["result"]["TourInfo"]["Nights"])),
                        "ROOM_TYPE" => htmlspecialchars(strip_tags($result["result"]["TourInfo"]["HtPlaceName"])),
                        "ROOM_CAT" => htmlspecialchars(strip_tags($result["result"]["TourInfo"]["RoomName"])),
                        "ACCM" => htmlspecialchars(strip_tags($result["result"]["TourInfo"]["HtPlaceName"])),
                        "SERVICES" => htmlspecialchars(strip_tags($result["result"]["TourInfo"]["TicketsIncluded"]))
                    );
                    //$this->arResult['TOTAL_PRICE'] += htmlspecialchars(strip_tags(number_format(convert_currency($result["result"]["TourInfo"]["Price"], $this->arCurrenty[$result["result"]["TourInfo"]["PriceCurrency"]], true), 2, ".", "")));
                    $this->arResult['TOTAL_PRICE'] += str_replace(" ", "", \travelsoft\Currency::getInstance()->convertCurrency(
                        $result["result"]["TourInfo"]["Price"], $result["result"]["TourInfo"]["PriceCurrency"], $current_currency['iso'], true
                    ));
                    $this->arResult["CURRENT_CURRENCY"] = $current_currency['iso'];
                    $this->arResult['PEOPLE'] += htmlspecialchars(strip_tags($people));

                }
                //dm($result["result"]);

            }
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

		    if (!empty($arItem["priceKey"])) {
                $dataBooking["priceKey"] = $arItem["priceKey"];
            }
            elseif(!empty($arItem["requestId"]) && !empty($arItem["sourceId"]) && !empty($arItem["offerId"])) {
                $dataBooking["requestId"] = $arItem["requestId"];
                $dataBooking["sourceId"] = $arItem["sourceId"];
                $dataBooking["offerId"] = $arItem["offerId"];
            }

			foreach ($this->form['tourists'][$k] as $tourist) {

				$dataBooking['TOURISTS'][] = array(

					'last_name' => $tourist['last_name'],
					'first_name' => $tourist['name'],
					'birth_date' => $tourist['birthdate'],
					'citizenship' => "",
					'passport_num' => strtoupper(str_replace(" ", "", $tourist['passport_number'])),
					'passport_date' => '31.12.2050',
					'sex' => $tourist['gender'] == 1 ? 1 : 0

				);

			}

			$this->dataBooking[$k] = $dataBooking;

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

            if (!empty($value["priceKey"])) {
                $result = json_decode($this->sendRequest(
                    $this->arParams['QUERY_ADDRESS_BOOKING'],
                    'CreateNewDogovor',
                    Array(
                        "userId" => function_exists("getMTUserKey") ? getMTUserKey($GLOBALS['USER']->GetID()) : "",
                        "priceKey" => $value["priceKey"],
                        "turists" => $value['TOURISTS'],
                        "comment" => $this->form['comment'],
                        "addParameter" => array("phone" => $this->form['phone'])
                    )
                ), true);
            }
            elseif(!empty($value["requestId"]) && !empty($value["sourceId"]) && !empty($value["offerId"])) {

                $xml2 = new \sletatru\XmlGate([
                    'login' => $this->login,
                    'password' => $this->pass,
                ]);

                $tourOrder = $xml2->SaveTourOrder($value["requestId"], $value["offerId"], $value["sourceId"], $value["TOURISTS"][0]["first_name"].' '.$value["TOURISTS"][0]["last_name"], $this->arResult['POST']["email"], $this->arResult['POST']["phone"], $this->arResult['POST']["comment"]);

                $hotel = "HOTEL::".$this->arResult["CART"][0]["CITY"]."/".$this->arResult["CART"][0]["NAME"]."/".$this->arResult["CART"][0]["ROOM_TYPE"]."(".$this->arResult["CART"][0]["ROOM_CAT"]."),".$this->arResult["CART"][0]["ACCM"]."/".$this->arResult["CART"][0]["MEAL"]."/";
                if ($tourOrder) {
                    $this->arResult['POST']['comment'] = $this->arResult['POST']['comment'].' Заявка не была отправлена в сиситему Sletat.ru';
                }

                //в мастер ложим
                $result = json_decode($this->sendRequest(
                    $this->arParams['QUERY_ADDRESS_BOOKING'],
                    'CreateNewDogovorSletat',
                    Array(
                        "userId" => function_exists("getMTUserKey") ? getMTUserKey($GLOBALS['USER']->GetID()) : "",
                        "services" => Array(Array(
                            "dateBegin" => $this->arResult["CART"][0]["CHECK_IN"],
                            "dateEnd" => $this->arResult["CART"][0]["CHECK_OUT"],
                            "brutto" => $this->arResult["CART"][0]["PRICE_"],
                            "currency" => 'BYN',
                            "comment" => $this->arResult["CART"][0]["ORIGIN_PRICE"].' '.$this->arResult["CART"][0]["ORIGIN_CURRENCY"],
                            "name" => $hotel,
                        )),
                        "turists" => $value['TOURISTS'],
                        "comment" => $this->arResult['POST']['comment'],
                        "addParameter" => array("phone" => $this->arResult['POST']['phone'])
                    )
                ), true);

            }

			if (!empty($result)) {

                if ($result["result"]['dogovor_code'] != "") {
                    $this->ticket = $result["result"]['dogovor_code'];
                    return true;
                }

			} else{

                return false;
            }



		}

	}

	/**
	* create new ticket
	* @return boolean
	*/
/*	public function createTicket () {

		$result = json_decode(
			$this->sendRequest(
				$this->arParams['QUERY_ADDRESS_BOOKING'],  'CreateNewDogovor',
				array(
					"userId" => function_exists("getMTUserKey") ? getMTUserKey($GLOBALS['USER']->GetID()) : "",
                    "priceKey" => $this->priceKeys,
					"turists" => $this->dataBooking,
					"comment" => $this->form['comment']

				)
			), true);

		if ($result['result']['dogovor_code'] != "") {
			$this->ticket = $result['result']['dogovor_code'];
			return true;
		}

		return false;

	}*/

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