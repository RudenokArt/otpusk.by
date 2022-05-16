<div class="container"> <!-- start .container -->
	<div class="row"> <!-- start .row -->

<?  // Боковое меню статических страниц
$APPLICATION->IncludeComponent("bitrix:menu","left",Array(
        "ROOT_MENU_TYPE" => "left", 
        "MAX_LEVEL" => "2", 
        "CHILD_MENU_TYPE" => "", 
        "USE_EXT" => "N",
        "DELAY" => "N",
        "ALLOW_MULTI_SELECT" => "N",
        "MENU_CACHE_TYPE" => "N", 
        "MENU_CACHE_TIME" => "3600", 
        "MENU_CACHE_USE_GROUPS" => "Y", 
        "MENU_CACHE_GET_VARS" => "" 
    )
);?>
