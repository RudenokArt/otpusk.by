<?
	function return404()
	{
		die("404 error");
	}

	require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");


	require_once($_SERVER["DOCUMENT_ROOT"]."/aviabilety/bilety/lib.php");

	if(!$_GET["city"])  return404();

	$cityKey = 0;
	$h1_tag = "";
	foreach($citiesLib as $cKey=>$cArray)
	{
		if($_GET["city"] == $cArray["CODE"])
		{
			$cityKey = $cArray["ID"];
			$h1_tag = "<h1 class=\"title_main text-center\">Авиабилеты на рейсы с вылетом из ".$cArray['PROPERTY_CN_NAME_CHEGO_VALUE']."</h1>";
			break;
		}
	}


	global $_CRUMB;


 $_CRUMB = Array(

	 Array("TITLE"=>"Главная","LINK"=>"../.."),
	 Array("TITLE"=>"Авиабилеты","LINK"=>".."),
	 Array("TITLE"=>"Из ".$cArray['PROPERTY_FROM_CITY_VALUE'],"LINK"=>"")

	);



	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
	$APPLICATION->SetTitle($cArray['PROPERTY_TITLE_VALUE']);
$APPLICATION->SetPageProperty("title", $cArray['PROPERTY_TITLE_VALUE']);
$APPLICATION->SetPageProperty("description", $cArray['PROPERTY_DESCRIPTION_VALUE']);
$APPLICATION->SetPageProperty("keywords", $cArray['PROPERTY_KEYWORDS_VALUE']);

	if(!$cityKey)  return404();

	echo $h1_tag;

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

	$arrFilter = Array("IBLOCK_ID"=>49, "PROPERTY_departureCityId" => $cityKey, "ACTIVE" => "Y");


	$res = CIBlockElement::GetList(false, $arrFilter, false, Array("nPageSize"=>100), $arrSelect);

	$ticketsLib = Array();

	while($ob = $res->GetNextElement())
	{
		$arFields = $ob->GetFields();

		if(!isset($ticketsLib[$arFields["PROPERTY_DEPARTURECITYID_VALUE"]]))
			$ticketsLib[$arFields["PROPERTY_DEPARTURECITYID_VALUE"]] = Array();

		$ticketsLib[$arFields["PROPERTY_DEPARTURECITYID_VALUE"]][] = $arFields;
	}


	CModule::IncludeModule("main");



	foreach($citiesLib as $cityKey => $cityFrom)
	{
		if((!isset($ticketsLib[$cityKey])) || (!isset($citiesLib[$cityKey]))) 
			continue;


		//	$cityFrom = $citiesLib[$cityKey];
		$cityTickets = $ticketsLib[$cityKey];

		echo "<div class=\"\">\n";
		//	echo "<span style=\"font-size:24px\">Из ".$cityFrom["PROPERTY_FROM_CITY_VALUE"]."</span> (<a href=\"".$cityFrom["PROPERTY_SLUG_VALUE"]."\">Все варианты</a>)\n";
		echo "  <div class=\"ajax-preloader package-list-item-wrapper on-page-result-page\">\n";
		$limit = 4;

		foreach($cityTickets as $ticket)
			if(drawTicket($ticket, $citiesLib, $currencies))
				if($limit-- == 1) {
					echo "</div>\n<div class=\"\">\n";
					$limit = 4;
				}

		echo "</div>\n</div>\n";
	}

?>
<div class="tickets__header"><?=htmlspecialcharsBack($cArray['PROPERTY_TEXT_VALUE']["TEXT"])?></div>



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