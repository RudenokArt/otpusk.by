<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

	$SITE_ID = "s1";
	$EVEN_TYPE = "FEEDBACK_UNSEEING_ADD";

	if(isset($_POST["feedback_san"]) || isset($_POST["feedback_avia"])){

		$arError = "";

		if(isset($_POST["feedback_san"])) {

			$arFeedForm = array(
				"FIO" => trim($_POST['fio']),
				"SAN" => trim($_POST['sanatorium']),
				"PERIOD" => trim($_POST['calendar_start'] . "-" . $_POST['calendar_end']),
				"TEL" => trim($_POST['number']),
				"TEXT" => trim($_POST['comment']),
			);

			$arError = validate($arFeedForm);
			$idMsgTemplate = 78;
		}

		if(isset($_POST["feedback_avia"])) {

			$arFeedForm = array(
				"FIO" => trim($_POST['fio']),
				"COUNTRY" => trim($_POST['country']),
				"PERIOD" => trim($_POST['calendar_start'] . "-" . $_POST['calendar_end']),
				"TEL" => trim($_POST['number']),
				"TEXT" => trim($_POST['comment']),
			);

			$arError = validate($arFeedForm);
			$idMsgTemplate = 79;
		}


		if($arError == "")
		{
			CEvent::Send($EVEN_TYPE, $SITE_ID, $arFeedForm, "N", $idMsgTemplate);
		}

	}

function validate($arVals) {
	foreach($arVals as $key => $value) {
		if(empty($value) || $value == "-") { $arError = $key; break; }
	}

	switch($arError) {
		case "FIO": echo "Заполните поле 'ФИО'."; return "err";
		case "SAN": echo "Заполните поле 'Санаторий'."; return "err";
		case "PERIOD": echo "Заполните поле 'Период'."; return "err";
		case "TEL": echo "Заполните поле 'Телефон для связи'."; return "err";
		case "COUNTRY": echo "Заполните поле 'Страна'."; return "err";
		default: return "";
	}
}
?>