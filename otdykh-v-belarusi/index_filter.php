<div class="col-sm-4 col-md-3">
 <aside class="sidebar with-filter">
<?	$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"left", 
	array(
		"ROOT_MENU_TYPE" => "left",
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"FILTER_CONSISTING" => "Y",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"COMPONENT_TEMPLATE" => "left"
	),
	false
	);
?>

<?
	$APPLICATION->IncludeComponent(
	"bitrix:catalog.smart.filter", 
	"otdykh-v-belarusi", 
	array(
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "N",
		"DISPLAY_ELEMENT_COUNT" => "Y",
		"FILTER_NAME" => "arrFilter",
		"FILTER_VIEW_MODE" => "",
		"IBLOCK_ID" => "18",
		"IBLOCK_TYPE" => "otpusk",
		"INSTANT_RELOAD" => "N",
		"PAGER_PARAMS_NAME" => "arrPager",
		"POPUP_POSITION" => "left",
		"SAVE_IN_SESSION" => "N",
		"SECTION_CODE" => "",
		"SECTION_DESCRIPTION" => "-",
		"SECTION_ID" => "",
		"SECTION_TITLE" => "-",
		"SEF_MODE" => "N",
		"TEMPLATE_THEME" => "",
		"XML_EXPORT" => "N",
		"COMPONENT_TEMPLATE" => "otdykh-v-belarusi",
		"SEF_RULE" => "",
		"SECTION_CODE_PATH" => "",
		"SMART_FILTER_PATH" => "",
		"HIDE_RESET_IN_FILTER" => "Y",
		"HIDE_COUNTRY_IN_FILTER" => "Y",
	),
	false
	);
?>
	</aside>
</div>