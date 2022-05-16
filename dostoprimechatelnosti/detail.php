<?define('NOT_FLOAT_RIGHT', true)?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?
includeFileModifier(
	Set::SIGHTS_SEF_FOLDER,
	array(
		"a" => "#CODE#/#CODE2#/#CODE3#/",
		"b" => "#CODE#/#CODE2#/",
		"c" => "#CODE#/"
		),
	"sights_callback"	
	);
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>