<a href="/turistam/courses/" title="Курсы валют">
	<div class="header-courses">    
<?CModule::IncludeModule("iblock");
$dbCurrency = CIBlockElement::GetList(false, array("IBLOCK_ID" => Set::CURRENCY_IBLOCK_ID), false, false, array('ID', 'PROPERTY_ISO', 'PROPERTY_COMMISSION'));
$arCurrencies = array();

while ($arCurrency = $dbCurrency->Fetch()) {

    $arCurrencies[$arCurrency['PROPERTY_ISO_VALUE']] = $arCurrency['PROPERTY_COMMISSION_VALUE'];
}
$arSelect = Array("ID", "IBLOCK_ID", "NAME", "TIMESTAMP_X","PROPERTY_USD","PROPERTY_EUR","PROPERTY_RUR");//IBLOCK_ID и ID обязательно должны быть указаны, см. описание arSelectFields выше
$arFilter = Array("IBLOCK_ID"=>23, "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array("TIMESTAMP_X"=>"DESC"), $arFilter, false, Array("nPageSize"=>1), $arSelect);
while($ob = $res->GetNextElement()){ 
	//$arFields = $ob->GetFields();  
	//print_r($arFields);
 $arProps = $ob->GetProperties();
?>
		  USD............. <?=round($arProps["USD"]["VALUE"] + ($arProps["USD"]["VALUE"]*($arCurrencies["USD"]/100)),4)?> <br>
		  EUR............. <?=round($arProps["EUR"]["VALUE"] + ($arProps["EUR"]["VALUE"]*($arCurrencies["EUR"]/100)),4)?> <br>
		  RUB............. <?=round($arProps["RUB"]["VALUE"] + ($arProps["RUB"]["VALUE"]*($arCurrencies["RUB"]/100)),4)?>
<?

	//print_r($arProps);
}
?> 

	  </div>
</a>