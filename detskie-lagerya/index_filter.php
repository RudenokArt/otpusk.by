<div class="col-sm-4 col-md-3">
 <aside class="sidebar with-filter">
	<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.smart.filter",
	"tours-filter",
	Array(
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "N",
		"COMPONENT_TEMPLATE" => "tours-filter",
		"DISPLAY_ELEMENT_COUNT" => "Y",
		"FILTER_NAME" => "arrFilter",
		"FILTER_VIEW_MODE" => "",
		"IBLOCK_ID" => "14",
		"IBLOCK_TYPE" => "otpusk",
		"INSTANT_RELOAD" => "N",
		"PAGER_PARAMS_NAME" => "arrPager",
		"POPUP_POSITION" => "left",
		"SAVE_IN_SESSION" => "N",
		"SECTION_CODE" => "",
		"SECTION_DESCRIPTION" => "-",
		"SECTION_ID" => "167",
		"SECTION_TITLE" => "-",
		"SEF_MODE" => "N",
		"TEMPLATE_THEME" => "",
		"XML_EXPORT" => "N"
	)
);?>
	<div class="sidebar-box">
		 <?$APPLICATION->IncludeComponent(
	"bitrix:advertising.banner",
	"",
	Array(
		"CACHE_TIME" => "0",
		"CACHE_TYPE" => "N",
		"NOINDEX" => "Y",
		"QUANTITY" => "1",
		"TYPE" => "BOTTOM"
	)
);?>
	</div>
 </aside>
</div>
 <br>