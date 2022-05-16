<?
	CModule::IncludeModule("iblock");

	$currencies = Array("€" => "EUR" , "$" => "USD", "EUR" => "EUR", "USD" => "USD");

	//получить список городов с id, названием, фото
	$arrSelect = Array("ID","NAME", "PROPERTY_PICTURES", "PROPERTY_CN_NAME_chego", "CODE");
	$arrFilter = Array("IBLOCK_ID"=>11, "ACTIVE" => "Y", '!PROPERTY_IATA'=>false);

	$res = CIBlockElement::GetList(Array("PROPERTY_CN_NAME_chego"=>"ASC"), $arrFilter, false, Array("nPageSize"=>1000), $arrSelect);

	$citiesLib = Array();

	//пройтись по городам и записать их в справочник
	while($ob = $res->GetNextElement())
	{
		$arFields = $ob->GetFields();

		$citiesLib[ $arFields["ID"] ] = $arFields;
		//print_r ($citiesLib);
	}


	function drawTicket($ticket, $citiesLib, $currencies)
	{
		//echo $ticket["NAME"];

		$tpl = "<div class=\"package-list-item clearfix\">
			<div class=\"image\">
				<img src=\"{photo_url}\" alt=\"авиа билет из {city_from} в {city_to}\">
			</div>
			
			<div class=\"content\">
				<span style=\"font-size: 17px; color: #333; margin: 18px 0 10px; font-weight: 700; display: inline-block\">{city_from} - {city_to} </span>
				<div class=\"row gap-10\">
					<div class=\"col-sm-12 col-md-9\">
						
						<p class=\"line18\">{description}, эконом класс</p>

						<ul class=\"list-info\">
							<li><span class=\"icon\"><i class=\"fa fa-map-marker\"></i></span> <span class=\"font600\">{city_from}, вылет {dates}</span></li>
							<li><span class=\"icon\"><i class=\"fa fa-flag\"></i></span> <span class=\"font600\">{city_to}</span></li>
						</ul>
						
					</div>
					<div class=\"col-sm-12 col-md-3 text-right text-left-sm\">
						<div class=\"price\">{PROPERTY_PRICEADULT_VALUE} {currency}</div>
						<a href=\"\aviabilety\?{PROPERTY_URL_VALUE}\" class=\"btn btn-primary btn-sm\">Подробнее</a>
						
					</div>
				</div>
			</div>
			
		</div>";

		$ticket["currency"] = $currencies[$ticket["PROPERTY_CURRENCY_VALUE"]];

		$ticket["dates"] = substr($ticket["PROPERTY_DEPARTUREDATE_VALUE"], 0, 5).($ticket["PROPERTY_COMEBACKDATE_VALUE"]?" - ".substr($ticket["PROPERTY_COMEBACKDATE_VALUE"],0,5):"");

		$ticket["description"] = strlen($ticket["dates"])==5? "В одну сторону":"В обе стороны";

		$ticket["city_from"] = $citiesLib[$ticket["PROPERTY_DEPARTURECITYID_VALUE"]]["NAME"];

		$ticket["city_to"] = $citiesLib[$ticket["PROPERTY_DESTINATIONCITYID_VALUE"]]["NAME"];


		if(isset($citiesLib[$ticket["PROPERTY_DESTINATIONCITYID_VALUE"]]))
		{

				$ticket["photo_url"] =  CFile::GetPath($citiesLib[$ticket["PROPERTY_DESTINATIONCITYID_VALUE"]]["PROPERTY_PICTURES_VALUE"][0]);
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