<?php 
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
global $USER;
// $USER->Authorize(1);
// $USER->Authorize(14116);
// $arGroups = CUser::GetUserGroup(14116);
// $arGroups[] = 17;
// CUser::SetUserGroup(14116, $arGroups);
include_once 'header.php';
global $USER;
if (isset($_POST['login']) and isset($_POST['password'])) {
  $login_try = $USER->Login($_POST['login'], $_POST['password'], 'Y');
  if ($login_try['TYPE'] == 'ERROR') {
    $alert_message = $login_try['MESSAGE'];
    $alert_color = 'danger';
  } else {
    $alert_message = 'Авторизация прошла успешно.';
    $alert_color = 'success';
  }
  include_once 'alert_page.php';
  echo '<script>setTimeout(function(){document.location.href="index.php";},2000);</script>';
}elseif (!$USER->IsAuthorized()) {
  include_once 'login_form.php';
} elseif (in_array(CGroup::GetList(($by="id"), ($order="asc"),['STRING_ID'=>'exchange_rates'])->Fetch()['ID'], 
  $USER->GetUserGroupArray())){
  if (isset($_POST['exchange_rates_add'])) {
    $check_date = new InfoBlock([],[
      'NAME'=> $_POST['DATE'],
      'IBLOCK_ID'=>23,
    ],false,false, ['ID','NAME']);
    $exchange_rates = new CIBlockElement;
    print_r($check_date->items_arr);
    if (count($check_date->items_arr) > 0) {
      $alert_color = 'danger';
      $alert_message = 'Запись на указанную дату уже существует!';
    } elseif (
      $exchange_rates->Add([
        'IBLOCK_ID'=>23,
        'NAME' => $_POST['DATE'],
        'CODE' => itemCodeGenerate($_POST['DATE']),
        'ACTIVE_FROM'=> $_POST['DATE'],
        'PROPERTY_VALUES'=>[
          'USD' => $_POST['USD'],
          'EUR' => $_POST['EUR'],
          'RUB' => $_POST['RUB'],
          'DATE' =>  $_POST['DATE']
        ]])) {
      $alert_color = 'success';
      $alert_message = 'Запись добавлена в базу данных.';
    } else {
      $alert_color = 'danger';
      $alert_message = 'Error: '.$exchange_rates->LAST_ERROR;
    }
    include_once 'alert_page.php';
    echo '<script>setTimeout(function(){document.location.href="index.php";},2000);</script>';
  }  elseif (isset($_GET['add'])) {
    include_once ('add_form.php');
  }  elseif (isset($_GET['update'])) {
    $exchange_rates = new InfoBlock([],['ID'=>$_GET['update']], false, false, [
      'ID',
      'IBLOCK_ID',
      'CODE',
      'CREATED_DATE',
      'PROPERTY_USD',
      'PROPERTY_EUR',
      'PROPERTY_RUB',
      'NAME',
    ]); ?>

    <?php if (isset($_POST['update'])){
      CIBlockElement::SetPropertyValuesEx($_POST['update'],23, [
        'USD'=>$_POST['USD'],
        'EUR'=>$_POST['EUR'],
        'RUB'=>$_POST['RUB'],
      ]); 
      $alert_message = 'Данные сохранены в базу.';
      $alert_color = 'success';
      include_once 'alert_page.php'; 
      echo '<script>setTimeout(function(){document.location.href="index.php";},2000);</script>';
    } else {
      include_once ('update_form.php');
    }
    
  } else {
    $exchange_rates = new InfoBlock(['ACTIVE_FROM'=>'DESC', 'CREATED_DATE'=>'DESC'],['IBLOCK_ID'=>23], false, [
      'nPageSize'=>10,
      'iNumPage'=>$_GET['page_number'],
    ], [
      'ID',
      'IBLOCK_ID',
      'CODE',
      'NAME',
      'CREATED_DATE',
      'ACTIVE_FROM',
      'PROPERTY_USD',
      'PROPERTY_EUR',
      'PROPERTY_RUB',
      'PROPERTY_DATE',
    ]);
    include_once ('items_list.php');
  }
} else {
  $alert_message = 'Не достаточно прав для доступа к разделу.';
  $alert_color = 'danger';
  include_once 'alert_page.php';
}


function itemCodeGenerate ($date) {
  $arr = explode('.', $date);
  return $arr[0].'-'.$arr[1].'-'.$arr[2];
}
