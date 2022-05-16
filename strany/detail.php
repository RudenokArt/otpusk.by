<?define('NOT_FLOAT_RIGHT', true)?>
 <?define('NOT_SHOW_BIG_IMG', true)?> <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?> <?
includeFileModifier(
	Set::STRANY_SEF_FOLDER,
	array(
		"a" => "#CODE#/#CODE2#/#CODE3#/#CODE4#/",
		"b" => "#CODE#/#CODE2#/#CODE3#/",
		"c" => "#CODE#/#CODE2#/",
		"d" => "#CODE#/"
		),
	"strany_callback"	
	);
?>&nbsp;<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>