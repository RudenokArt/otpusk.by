<?define('NOT_FLOAT_RIGHT', true)?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Санаторий Радон");
	//die();
	//$APPLICATION->SetPageProperty("title", "Санатории");?>
<?
includeFileModifier(
	Set::SANATORII_SEF_FOLDER,
	array(
		"a" => "#CODE#/#CODE2#/#CODE3#/",
		"b" => "#CODE#/#CODE2#/",
		"c" => "#CODE#/"
		),
	"sanatorii_callback"	
);
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>