<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

	$SITE_ID = "s1";
	$EVEN_TYPE = "ORDER_CORP_SEND";

	if(isset($_POST["order_corp_chk"])){

		$arError = "";

		$arFeedForm = array(
			"FIO" => trim($_POST['FIO']),
			"ORGANIZATION" => trim($_POST['ORGANIZATION']),
			"NUMBER" => trim($_POST['NUMBER']),
			"DIR" => trim($_POST['DIR']),
			"COMMENT" => trim($_POST['COMMENT']),
		);

		$arError = validate($arFeedForm);
		$idMsgTemplate = 81;

		if($arError == "")
		{
			CEvent::Send($EVEN_TYPE, $SITE_ID, $arFeedForm, "N", $idMsgTemplate);
		}

	}

function validate($arVals) {
	foreach($arVals as $key => $value) {
		if(empty($value)) { $arError = $key; break; }
	}

	switch($arError) {
		case "FIO": echo "Заполните поле 'ФИО'."; return "err";
		case "ORGANIZATION": echo "Заполните поле 'Организация'."; return "err";
		case "NUMBER": echo "Заполните поле 'Телефон'."; return "err";
		case "DIR": echo "Выберите направление."; return "err";
		default: return "";
	}
}
?>