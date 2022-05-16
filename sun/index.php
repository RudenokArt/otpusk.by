<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("test");
?>

<div class="flexslider-hero-slider">
    <div class="main-search-wrapper full-width">
        <div class="inner">

            <? /*if ($GLOBALS['USER']->IsAdmin()):*/ ?>
            <!-- FORM TABS -->
            <div class="form-tabs">
                <div class="tab1"><a class="btn btn-primary" href="#mt-sanatorii-form">Санатории</a></div>
            </div>
            <div id="mt-sanatorii-form">
                <!-- mastertour search form -->
                <? $APPLICATION->IncludeComponent(
                    "travelsoft:form.search",
                    "placement-seperated-form",
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
                            2 => "CN_KEY"
                        ),
                        "QUERY_ADDRESS" => "/oteli/search.php",
                        "SECTION_ID" => "167"
                    ),
                    false
                ); ?>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
