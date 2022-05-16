<?
		function return404()
		{
			die("не найдена страна");
		}

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

		require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

		$APPLICATION->SetTitle("Каталог аэропортов");

		$slug_cn = $_GET["country"];

		$iso_cn = false;

		$name_cn = false;

		if(CModule::IncludeModule('iblock')) {

			$arSort= Array("PROPERTY_country_english"=>"ASC");

			$arSelect = Array("PROPERTY_ISO", "PROPERTY_country_russian" , "PROPERTY_country_english");

			$arFilter = Array("IBLOCK_ID"=>51);

			$res =  CIBlockElement :: GetList ($arSort, $arFilter, false,false, $arSelect);

			//Ищем выбранную страну
			while($ob = $res->GetNextElement())
			{
				$arFields = $ob->GetFields();

				$current_slug = slug($arFields[PROPERTY_COUNTRY_ENGLISH_VALUE]);

				if($current_slug == $slug_cn)
				{
					 $iso_cn = $arFields[PROPERTY_ISO_VALUE];
					 $name_cn = $arFields[PROPERTY_COUNTRY_RUSSIAN_VALUE];
					 break;
				}
			}
		}

	if(!$iso_cn) return404(); //если не нашлась страна

	$APPLICATION->SetTitle("Каталог аэропортов. ".$name_cn. " - список городов");


		global $_CRUMB;

		$_CRUMB = Array(
			0=>Array("TITLE"=>"Главная", "LINK"=>"../.."),
			1=>Array("TITLE"=>"Аэропорты", "LINK"=>".."),
			2=>Array("TITLE"=>$name_cn, "LINK"=>""),
			//	3=>Array("TITLE"=>"Три", "LINK"=>"")
			);

		require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");



			//сортировка!!!
			$arSort= Array("PROPERTY_city_russian"=>"ASC", "PROPERTY_city_english"=>"ASC","name"=>"ASC");

			$arSelect = Array("NAME", "PROPERTY_IATA", "PROPERTY_city_russian", "PROPERTY_city_english", "PROPERTY_airport_russian" , "PROPERTY_airport_english");

			$arFilter = Array("IBLOCK_ID"=>51,"PROPERTY_ISO"=> $iso_cn);

			$res =  CIBlockElement :: GetList ($arSort, $arFilter, false,false, $arSelect);

			$cities_lib = Array();

			while($ob = $res->GetNextElement())
			{
				$arFields = $ob->GetFields();

				$key = $arFields[PROPERTY_CITY_ENGLISH_VALUE];

				if(!isset($cities_lib[$key]))
					$cities_lib[$key] = Array(
												"ct_name"=> strlen($arFields[PROPERTY_CITY_RUSSIAN_VALUE]) >0?$arFields[PROPERTY_CITY_RUSSIAN_VALUE]:$key,
												"aps"=>Array()
										);

				$cities_lib[$key]["aps"][ $arFields[PROPERTY_IATA_VALUE]] = strlen($arFields[PROPERTY_AIRPORT_RUSSIAN_VALUE])>0?$arFields[PROPERTY_AIRPORT_RUSSIAN_VALUE] :$arFields[NAME] ;
			}

	$indexLetters = Array();

	foreach($cities_lib as $key=>$value)
	{
		$indexLetters[strtoupper(substr($value[ct_name],0,1))] = "";
	}


	$current_letter = "";

	//вывод результата
?>

<h1 class="title_main text-center"><? echo $name_cn; ?> - каталог аэропортов</h1>
<div> 
    <ul>
<?
	foreach($indexLetters as $key=>$value)
		echo "<li class=\"catalog_letter_top\"><a href=\"#$key\">$key</a> |</li>";
?>
	</ul>
</div>
<?
	foreach($cities_lib as $key=>$value)
	{   
		$ct_slug = slug($key);
		if($current_letter != strtoupper(substr($value[ct_name],0,1)))
		{
			if($current_letter != "") echo "</ul></div>";
			$current_letter = strtoupper(substr($value[ct_name],0,1));
			//echo "<div style='float:left'><div class='catalog_letter'>$current_letter</div><hr style='margin:5px 0px'>\n";
			echo "<div style='float:left'><div class='catalog_letter'><a name=\"$current_letter\">$current_letter</a></div>\n";
			echo "<hr style=\"margin:5px 0px\">";
		}	echo "<ul style='min-width:960px'>\n";


		//echo "<li class='catalog_country'><a style='color: #00468c;' href='$ap_slug/'>$value[ct_name], $ap_ru ($ap_slug)</a></li>\n";

		foreach($value[aps] as $ap_en=>$ap_ru)
		{
			$ap_slug = slug($ap_en);
			echo "<li class='catalog_country'><a style='color: #00468c;' href='$ap_slug/'>$value[ct_name], <span style='font-weight:normal;'>$ap_ru ($ap_slug)</span></a></li>\n";
		}

		//echo "</ul>\n\n";
}
//echo "</div>\n";
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>