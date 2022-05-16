<div class="col-sm-4 col-md-3">
 <aside class="sidebar with-filter">
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.smart.filter", 
	"tours-filter", 
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
		"SECTION_ID" => "295",
		"SECTION_TITLE" => "-",
		"SEF_MODE" => "N",
		"TEMPLATE_THEME" => "",
		"XML_EXPORT" => "N",
		"COMPONENT_TEMPLATE" => "tours-filter",
		"SEF_RULE" => "",
		"SECTION_CODE_PATH" => "",
		"SMART_FILTER_PATH" => "",
		"HIDE_RESET_IN_FILTER" => "Y",
		"HIDE_COUNTRY_IN_FILTER" => "N",
		"SHOW_TYPE_OF_EXCURSIONS" => "N",
		"HIDE_TOURTYPE_IN_FILTER" => "Y",
		"HIDE_TRANSPORT_IN_FILTER" => "N",
		"DURATION_TITLE" => "дней"
	),
	false
);?>
<div class="sidebar-box">
<?$APPLICATION->IncludeComponent("bitrix:advertising.banner","",Array(
"TYPE" => "BOTTOM", 
"CACHE_TYPE" => "A",
"NOINDEX" => "Y", 
"CACHE_TIME" => "3600" 
    )
);?>
</div>
 </aside>
</div>
