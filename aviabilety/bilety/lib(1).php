<?
	CModule::IncludeModule("iblock");

	$currencies = Array("EUR"=> "€", "USD" => "$");

	//получить список городов с id, названием, фото
	$arrSelect = Array("ID","NAME", "PREVIEW_PICTURE", "PROPERTY_from_city", "PROPERTY_slug", "PROPERTY_text", "PROPERTY_keywords", "PROPERTY_title", "PROPERTY_description", "PROPERTY_h1");
	$arrFilter = Array("IBLOCK_ID"=>50, "ACTIVE" => "Y");

	$res = CIBlockElement::GetList(Array("PROPERTY_from_city"=>"ASC"), $arrFilter, false, Array("nPageSize"=>1000), $arrSelect);

	$citiesLib = Array();

	//пройтись по городам и записать их в справочник
	while($ob = $res->GetNextElement())
	{
		$arFields = $ob->GetFields();

		$citiesLib[ $arFields["ID"] ] = $arFields;
	}

	function drawTicket($ticket, $citiesLib, $currencies)
	{
		//echo $ticket["NAME"];

		$tpl = "<li class=\"room\">
                         <div class=\"room__thumb\">
							<div  class=\"room__image\" style=\"background:url({photo_url}) center center no-repeat;\"> </div>
							<div  class=\"room__overText\"><b>{city_from}<br>{city_to}</b> <br><small>{dates}</small></div>
                        </div>
                        <div class=\"room__entry\">
						<p>{description}, эконом класс</p>
                        </div>
                        <footer class=\"room__details\">
							<div class=\"room__price\">{currency} {PROPERTY_PRICEADULT_VALUE}</div>
							<a href=\"{PROPERTY_URL_VALUE}\" class=\"btn\">Купить</a>
                        </footer>
                    </li>";


		$ticket["currency"] = $currencies[$ticket["PROPERTY_CURRENCY_VALUE"]];

		$ticket["dates"] = substr($ticket["PROPERTY_DEPARTUREDATE_VALUE"], 0, 5).($ticket["PROPERTY_COMEBACKDATE_VALUE"]?" - ".substr($ticket["PROPERTY_COMEBACKDATE_VALUE"],0,5):"");

		$ticket["description"] = strlen($ticket["dates"])==5? "В одну сторону":"В обе стороны";

		$ticket["city_from"] = $citiesLib[$ticket["PROPERTY_DEPARTURECITYID_VALUE"]]["NAME"];

		$ticket["city_to"] = $citiesLib[$ticket["PROPERTY_DESTINATIONCITYID_VALUE"]]["NAME"];


		if(isset($citiesLib[$ticket["PROPERTY_DESTINATIONCITYID_VALUE"]]))
		{

				$ticket["photo_url"] =  CFile::GetPath($citiesLib[$ticket["PROPERTY_DESTINATIONCITYID_VALUE"]]["PREVIEW_PICTURE"]);
		}
		//else echo "fail1";

		if(isset($ticket["photo_url"]))
		{
			foreach($ticket as $k=>$v)
				$tpl = str_replace("{".$k."}", $v, $tpl);

			echo $tpl;

			return true;
		}
		//else  echo "fail2";

		return false;
	}

?>