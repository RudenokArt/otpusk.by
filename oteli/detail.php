<?define('NOT_FLOAT_RIGHT', true)?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
	//$APPLICATION->SetTitle("Санаторий Боровое");?>
<?
includeFileModifier(
	Set::HOTELS_SEF_FOLDER,
	array(
		"a" => "#CODE#/#CODE2#/#CODE3#/",
		"b" => "#CODE#/#CODE2#/",
		"c" => "#CODE#/"
		),
	"oteli_callback"	
	);
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>