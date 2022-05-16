<?
		function slug($text)
		{
		  // replace non letter or digits by -
		  $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
		
		  // trim
		  $text = trim($text, '-');
		
		  // transliterate
		  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
		
		  // lowercase
		  $text = strtolower($text);
		
		  // remove unwanted characters
		  $text = preg_replace('~[^-\w]+~', '', $text);
		
		  if (empty($text))
		  {
			return 'n-a';
		  }

		  return $text;
		}

		require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
		$APPLICATION->SetTitle("Каталог аэропортов");
		if(CModule::IncludeModule('iblock')) {

			//сортировка!!!
			$arSort= Array("PROPERTY_country_russian"=>"ASC","PROPERTY_city_russian"=>"ASC", "PROPERTY_city_english"=>"ASC","name"=>"ASC");

			$arSelect = Array("PROPERTY_ISO","PROPERTY_IATA", "PROPERTY_city_russian","PROPERTY_airport_russian" , "PROPERTY_airport_english", "PROPERTY_city_english", "PROPERTY_country_russian" , "PROPERTY_country_english");
	
			$arFilter = Array("IBLOCK_ID"=>51);

			$res =  CIBlockElement :: GetList ($arSort, $arFilter, false,false, $arSelect);

			$countries_lib = Array();

			while($ob = $res->GetNextElement())
			{
					$arFields = $ob->GetFields();

				if(!isset($countries_lib[$arFields[PROPERTY_ISO_VALUE]]))
					$countries_lib[$arFields[PROPERTY_ISO_VALUE]] = Array(
																						"cn_name"=>$arFields[PROPERTY_COUNTRY_RUSSIAN_VALUE],
																						"cn_name_en"=>$arFields[PROPERTY_COUNTRY_ENGLISH_VALUE],
																						"cities"=>Array()
																				);

				if(!isset($countries_lib[$arFields[PROPERTY_ISO_VALUE]][cities][$arFields[PROPERTY_CITY_ENGLISH_VALUE]]))
					$countries_lib[$arFields[PROPERTY_ISO_VALUE]][cities][$arFields[PROPERTY_IATA_VALUE]] = (strlen( $arFields[PROPERTY_CITY_RUSSIAN_VALUE]) >0?$arFields[PROPERTY_CITY_RUSSIAN_VALUE]:$arFields[PROPERTY_CITY_ENGLISH_VALUE])." - ".(strlen( $arFields[PROPERTY_AIRPORT_RUSSIAN_VALUE]) >0?$arFields[PROPERTY_AIRPORT_RUSSIAN_VALUE]:$arFields[NAME]);
			}
		}

	$indexLetters = Array();

	foreach($countries_lib as $key=>$value)
	{
		$indexLetters[strtoupper(substr($value[cn_name],0,1))] = "";
	}

	$current_letter = "";

	//вывод результата
?><div>
	<ul><span style="float:left">Быстрый переход:</span>
		 <?
	foreach($indexLetters as $key=>$value)
		echo "<li class=\"catalog_letter_top\"><a href=\"#$key\">$key</a> |</li>";
?>
	</ul>
</div>
<br><?
	foreach($countries_lib as $key=>$value)
	{
		$cn_slug = slug($value[cn_name_en]);

		if($current_letter != strtoupper(substr($value[cn_name],0,1)))
		{
			if($current_letter != "") echo "</ul></div>";

			$current_letter = strtoupper(substr($value[cn_name],0,1));
			echo "<div style='float:left'><div class='catalog_letter'><a name=\"$current_letter\">$current_letter</a></div>\n";
			echo "<hr style='margin:5px 0px'>";
			echo "<ul style='min-width:960px'>\n";
		}
		$ct_slug = slug($ct_en);
		echo "<li class='catalog_country'><a style='color: #00468c;' href='$cn_slug/'>".$value[cn_name]." </a></li>\n";

		/*echo "<ul>\n";

		foreach($value[cities] as $ct_en=>$ct_ru)
		{
			$ct_slug = slug($ct_en);
			//echo "<li><a href='$cn_slug/$ct_slug/'>$ct_ru ($ct_slug)</a></li>\n";
		}

echo "</ul>\n\n";*/
		//echo "</div>\n";
	}

	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>