<div class="main-search-wrapper full-width">
	<div class="inner">
<style>
	.main-search-wrapper .for-btn .opacity {
		height: 21px;
	}
</style>
	<!-- mastertour search form -->
<?$APPLICATION->IncludeComponent(
	"travelsoft:form.search", 
	"placement-form", 
	array(
		"ADDITIONAL_SEARCH" => array(
			0 => "COUNTRY_12",
			1 => "TOWN_11",
			2 => "REGIONS_56",
		),
		"COMPONENT_TEMPLATE" => "placement-form",
		"IBLOCK_ID" => "14",
		"IBLOCK_TYPE" => "otpusk",
		"PROPERTY_CODE" => array(
			0 => "TYPE_ID",
			1 => "MT_HOTELKEY",
		),
		"QUERY_ADDRESS" => "/oteli/search/",
		"SECTION_ID" => "167"
	),
	false
);?>
		<div class="clear"></div>
	</div>
</div>