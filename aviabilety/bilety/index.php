<?
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("TITLE", "Подбор авиабилетов из Минска. Цены на билеты из Москвы, Киева");
$APPLICATION->SetPageProperty("keywords", "Авиабилеты из Минска");
$APPLICATION->SetPageProperty("description", "Система бронирования авиабилетов онлайн, позволяет бронировать и оплачивать авиабилеты онлайн");
	$APPLICATION->SetTitle("Авиабилеты, специальные тарифы");

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


	CModule::IncludeModule("main");
	foreach($ticketsLib as $cityKey => $cityTickets)
	{
		//echo $cityKey;
		if((!isset($ticketsLib[$cityKey])) || (!isset($citiesLib[$cityKey]))) 
			continue;
		//
		//echo count($ticketsLib[$cityKey]);
		$cityFrom = $citiesLib[$cityKey];

		//$cityTickets = $ticketsLib[$cityKey];

		echo "<div class=\"\">\n";
		echo "<h2 style='font-size: 21px'>Из ".$cityFrom["PROPERTY_CN_NAME_CHEGO_VALUE"]."</h2>\n";
		echo "  <div class=\"ajax-preloader package-list-item-wrapper on-page-result-page\">\n";
		$limit = 4;

		shuffle($cityTickets);

		foreach($cityTickets as $ticket)
			//print_R ($ticket);
			if(drawTicket($ticket, $citiesLib, $currencies))
				if($limit-- == 1) break;

		echo "<a href=\"".$cityFrom["CODE"]."/\">Все предложения с вылетом из ".$cityFrom["PROPERTY_CN_NAME_CHEGO_VALUE"]."</a></div>\n</div>\n";
	}

?><style>
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
</style> <br>
 <br>
 Мы предлагаем перелеты в любую точку земного шара. Наиболее популярные направления:<br>
 <a href="http://www.otpusk.by/strany/bolgariya/aviabilety-v-bolgariyu/">Авиабилеты в Болгарию</a>&nbsp; &nbsp;<a href="http://www.otpusk.by/strany/chernogoriya/aviabilety-v-chernogoriyu/ ">Авиабилеты в Черногорию</a> &nbsp; <a href="http://www.otpusk.by/strany/gruziya/aviabilety-v-gruziyu/ ">Авиабилеты в Грузию</a> &nbsp; <a href="http://www.otpusk.by/strany/italiya/aviabilety-v-italiyu/ ">Авиабилеты в Италию</a> &nbsp; <a href="http://www.otpusk.by/strany/izrail/aviabilety-v-izrail/ ">Авиабилеты в Израиль</a> &nbsp; <a href="http://www.otpusk.by/strany/rossiya/aviabilety-v-simferopol/ ">Авиабилеты в Симферополь</a> &nbsp; <a href="http://www.otpusk.by/strany/rossiya/aviabilety-v-sochi/">Авиабилеты в Сочи</a><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>