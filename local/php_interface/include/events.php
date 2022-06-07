<?
/**
* обработчики событий
*/

/* модификация элемента после добавления в иб */
AddEventHandler("iblock", "OnAfterIBlockElementAdd", "change_element");


/* модификация элемента перед обновлением в иб */
AddEventHandler("iblock", "OnAfterIBlockElementUpdate", "change_element");


/* модификация полей пользователя перед регистрацией SimpleRegister */
AddEventHandler("main", "OnBeforeUserSimpleRegister", "beforeUserRegister");

/* модификация писем перед отправкой */
AddEventHandler('main', 'OnBeforeEventSend', "onBeforeEventSend");

/* модификация полей пользователя перед CUser::Add */
AddEventHandler('main', 'OnBeforeUserAdd', "onBeforeUserAdd");

/* модификация полей пользователя перед CUser::Update */
AddEventHandler('main', 'OnBeforeUserUpdate', "onBeforeUserUpdate");

/* Запрет на смену пароля через админку */
AddEventHandler('main', 'OnBeforeUserUpdate', "bxOnBeforeUserChangePassword");

/**
* модификация полей элемента после сохранения/добавления
*/
function change_element(&$fields)
{

	if($fields['RESULT_MESSAGE'] != "")
		return;

	\Bitrix\Main\Loader::includeModule('iblock');
	
	switch($fields['IBLOCK_ID'])
	{
		case Set::SPECIAL_OFF_IBLOCK_ID: // специальные предложения

   $price_prop = current($fields['PROPERTY_VALUES'][104]);
   $currency_prop = current($fields['PROPERTY_VALUES'][105]);
   $days_prop = current($fields['PROPERTY_VALUES'][100]);

   if($price_prop['VALUE'] > 0)
   {
				// обновляем/добавляем BYR цену для фильтра
    $price = convert_currency($price_prop['VALUE'], $currency_prop['VALUE'], true);
    if($price != "")
    {
     CIBlockElement::SetPropertyValuesEx($fields['ID'], $fields['IBLOCK_ID'], array(230 => $price));
   }
 }

 if($days_prop['VALUE'])
 {
  $day_prop = CIBlockProperty::GetPropertyEnum(100, Array(), Array("IBLOCK_ID"=>$fields['IBLOCK_ID'], "ID"=>$days_prop['VALUE']))->Fetch();

  if($day_prop['VALUE'] != "")
  {
   CIBlockElement::SetPropertyValuesEx($fields['ID'], $fields['IBLOCK_ID'], array(375 => $day_prop['VALUE']));
 }
}

break;

		case Set::COURSE_CURRENCY_IBLOCK_ID: // курсы валют

   $db_res = CIBlockElement::GetList(false, array('IBLOCK_ID' => Set::SPECIAL_OFF_IBLOCK_ID), false, false, array('ID', 'PROPERTY_PRICE', 'PROPERTY_CURRENCY'));

   while($el = $db_res->Fetch())
   {

    /* пересчёт BYR цены для фильтра в спец. предложениях */

    $p = $el['PROPERTY_PRICE_VALUE'];
    $c = $el['PROPERTY_CURRENCY_VALUE'];

    $price = convert_currency($p, $c, true);
    CIBlockElement::SetPropertyValuesEx($el['ID'], 18, array(230 => $price));
  }

  \Bitrix\Main\Config\Option::set("travelsoft.currency", "base_courses_id", $fields["ID"]);

  break;

		case Set::REVIEWS_IBLOCK_ID: // отзывы

   if($fields['ACTIVE'] != "N")
    return;

  $el = CIBlockElement::GetByID($fields['PROPERTY_VALUES'][331])->GetNext();

  Bitrix\Main\Mail\Event::send(array( 
   "EVENT_NAME" => Set::MAIL_EVENT_REVIEWS_TEMPLATE, 
   "LID" => SITE_ID, 
   "C_FIELDS" => array( 
     "IBLOCK_ID" => $fields['IBLOCK_ID'],
     'ID' => $fields['ID'],
     'LINK' => $el['DETAIL_PAGE_URL']
   ),
   "DUPLICATE" => "Y",
   "MESSAGE_ID" => Set::MAIL_REVIEWS_TEMPL_ID
 ));

  CIBlockElement::SetPropertyValuesEx($fields['ID'], $fields['IBLOCK_ID'], array(371 => 'http://' . $_SERVER['SERVER_NAME'] . $el['DETAIL_PAGE_URL']));

  break;

        /*case Set::COURSE_CURRENCY_IBLOCK_ID:

            \Bitrix\Main\Config\Option::set("travelsoft.currency", "base_courses_id", $fields["ID"]);

            break;*/
          }
        }

        function onBeforeUserAdd (&$arFields) {

         if ($arFields['PASSWORD'] != "")
		// УСТАНАВЛИВАЕМ ПАРОЛЬ ДЛЯ ИСПОЛЬЗОВАНИЯ В ПИСЬМЕ С РЕГИСТРАЦИОННОЙ ИНФОРМАЦИЕЙ
          $GLOBALS['USER_PASSWORD'] = $arFields['PASSWORD'];

      }

      function beforeUserRegister (&$fields) {


       $fields['LOGIN'] = $fields['EMAIL'];

	// отправляем данные по пользователю в мастертур
	// получаем id пользователя в системе мастертур 
       $resp = mtUser(array(
         "user_info" => array(
          "email" => $fields['EMAIL'],
          'login' => $fields['LOGIN'],
          'password' => $fields['PASSWORD']
        ),
         "update" => 0
       ));

       $resp = json_decode($resp, true);
       $result = $resp['result'];

       if ($result['user_id'] == "") {
        $GLOBALS['APPLICATION']->ThrowException('Возникла ошибка сервиса при попытке регистрации пользователя. Проверьте правильность введённого email и обратитесь к администрации сайта');
        return false;
      }

      $fields['UF_MT_KEY'] = $result['user_id'];

      return true;

    }

    function onBeforeEventSend(&$arFields, &$arTemplate) {

	// 2 - ID ШАБЛОНА ПИСЬМА С РЕГИСТРАЦИОННОЙ ИНФОРМАЦИЕЙ
	// ДОБАВЛЯЕМ В НЕЁ ПАРОЛЬ
     if ($arTemplate['ID'] == 2 && $GLOBALS['USER_PASSWORD'] != "") {
      $arFields['PASSWORD'] = $GLOBALS['USER_PASSWORD'];
      unset($GLOBALS['USER_PASSWORD']);
    }
  }


  function onBeforeUserUpdate (&$arFields) {

   global $USER;
   if ($arFields['ID']) {

    $parameters = array(

     "update" => 1
   );

    if (check_email($arFields['EMAIL'])) {
     $parameters['user_info']['email'] = $arFields['EMAIL'];
     $arFields['LOGIN'] = $arFields['EMAIL'];
   }

   if ($arFields['PASSWORD']) {
     $parameters['user_info']['password'] = $arFields['PASSWORD'];
   }

   if ($parameters['user_info']) {
     $parameters['user_info']['user_id'] = getMTUserKey($arFields['ID']);
     $resp = mtUser($parameters);

     dmtf($resp);
   }


 }

 return true;

}

function mtUser ($parameters) {

	return file_get_contents(
    "https://booking2.otpusk.by/TSMO/json_handler.ashx",
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
         "method"  => "create_new_user",
         "params"  =>  $parameters,
         "id" => 0
       )
      ),
     ),
    )
   )
  );

}
//Функция запрета смены пароля для польз-ей через админку
function bxOnBeforeUserChangePassword($arFields) {
  $iUserID = 0;
  if(array_key_exists("ID", $arFields))
  {
    $iUserID = $arFields['ID'];
  } 
  else if(array_key_exists("LOGIN", $arFields)) 
  {
   $objUser = CUser::GetByLogin($arFields);
   if(is_object($objUser) && $arUser = $objUser->Fetch()) {
    $iUserID = $arUser['ID'];
  }
}

		$arIntersect = array(1, 8, 13, 14); // Список групп, которым нельзя менять пороль

        // Если пользователь принадлежит какой либо из групп, то заблочить изменение
    if($iUserID > 0 && count(array_intersect(CUser::GetUserGroup($iUserID), $arIntersect)) > 0) 
    {
      global $APPLICATION;
      if(is_object($APPLICATION)) 
      {
        $APPLICATION->ThrowException("Can't change the password.");
      }

      return false;
    }

  }


// ===== СИНХРОНИЗАЦИЯ КУРСОВ ВАЛЮТ =====

  AddEventHandler("iblock", "OnAfterIBlockElementAdd", function ($arFields) {
    if ($arFields['ID']>0 and $arFields['IBLOCK_ID']==23) {
      $exchange_rates = new InfoBlock(['ID'=>'DESC'], ['IBLOCK_ID'=>23], false, ['nTopCount'=>2],[
        'ID',
        'IBLOCK_ID',
        'CODE',
        'CREATED_DATE',
        'PROPERTY_USD',
        'PROPERTY_EUR',
        'PROPERTY_RUB',
        'NAME',
      ]);
      CIBlockElement::SetPropertyValuesEx($arFields['ID'],23, [
        'USD'=>$exchange_rates->items_arr[1]['PROPERTY_USD_VALUE'],
        'EUR'=>$exchange_rates->items_arr[1]['PROPERTY_EUR_VALUE'],
        'RUB'=>$exchange_rates->items_arr[1]['PROPERTY_RUB_VALUE'],
      ]); 
    }
  });

  AddEventHandler("iblock", "OnAfterIBlockElementSetPropertyValuesEx", function ($item_id, $iblock_id) {
    if ($iblock_id==23) {
      $exchange_rates = new InfoBlock([], ['ID'=>$item_id], false, false,[
        'ID',
        'IBLOCK_ID',
        'CODE',
        'CREATED_DATE',
        'PROPERTY_USD',
        'PROPERTY_EUR',
        'PROPERTY_RUB',
        'NAME',
      ]);
      $arr = $exchange_rates->items_arr[0];
      $url = 'https://vetliva.ru/rest/otpusk-by/?EXCHANGE_RATES=UPDATE&CODE='
      .$arr['CODE'].'&USD='.$arr['PROPERTY_USD_VALUE'].'&EUR='.$arr['PROPERTY_EUR_VALUE'].'&RUB='.$arr['PROPERTY_RUB_VALUE'];
      file_get_contents($url);
    }
  });
