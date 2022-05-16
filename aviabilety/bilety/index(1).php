<?
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("TITLE", "aviabilet.by: подбор авиабилетов из Минска. Цены на билеты из Москвы, Киева");
$APPLICATION->SetPageProperty("keywords", "Авиабилеты из Варшавы");
$APPLICATION->SetPageProperty("description", "Система бронирования авиабилетов онлайн, позволяет бронировать и оплачивать авиабилеты онлайн");
	$APPLICATION->SetTitle("Lowcost перелеты");

	require_once($_SERVER["DOCUMENT_ROOT"]."/aviabilety/bilety/lib.php");

	//выгружаем билеты
	$arrSelect = Array("ID","NAME", 
						"PROPERTY_priceAdult",  
						"PROPERTY_currency",
						"PROPERTY_url",
						"PROPERTY_departureCityId",
						"PROPERTY_destinationCityId", 
						"PROPERTY_departureDate", 
						"PROPERTY_comebackDate"
					 );

	$arrFilter = Array("IBLOCK_ID"=>49, "ACTIVE" => "Y");


	$res = CIBlockElement::GetList(false, $arrFilter, false, Array("nPageSize"=>200), $arrSelect);

	$ticketsLib = Array();

	while($ob = $res->GetNextElement())
	{
		$arFields = $ob->GetFields();

		if(!isset($ticketsLib[$arFields["PROPERTY_DEPARTURECITYID_VALUE"]]))
			$ticketsLib[$arFields["PROPERTY_DEPARTURECITYID_VALUE"]] = Array();


		$ticketsLib[$arFields["PROPERTY_DEPARTURECITYID_VALUE"]][] = $arFields;
	}


//print_r($ticketsLib);
?><h1 class="title_main text-center">Спецпредложения</h1>
<?
	CModule::IncludeModule("main");


	foreach($ticketsLib as $cityKey => $cityTickets)
	{
		//echo $cityKey;
		if((!isset($ticketsLib[$cityKey])) || (!isset($citiesLib[$cityKey]))) 
			continue;

		//echo count($ticketsLib[$cityKey]);
		$cityFrom = $citiesLib[$cityKey];

		//$cityTickets = $ticketsLib[$cityKey];

		echo "<div class=\"container cf tickets__header\">\n";
		echo "<span style=\"font-size:24px\">Из ".$cityFrom["PROPERTY_FROM_CITY_VALUE"]."</span> (<a href=\"".$cityFrom["PROPERTY_SLUG_VALUE"]."/\">Все варианты</a>)\n";
		echo "  <ul class=\"rooms\">\n";
		$limit = 4;

		shuffle($cityTickets);

		foreach($cityTickets as $ticket)
			if(drawTicket($ticket, $citiesLib, $currencies))
				if($limit-- == 1) break;

		echo "</ul>\n</div>\n";
	}

?>
<style>
	div.room__image{
						box-shadow: 0pt 1px 4px rgb(159, 161, 162);
						height:213px;
						oferflow:hidden;
	}

	div.room__overText{
		background-color:#686767;
		opacity:0.8
	}

	div.tickets__header{
		padding-bottom:10px; border-bottom:1px solid; margin-top:20px
	}
</style>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>