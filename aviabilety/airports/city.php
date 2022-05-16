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

		require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

		$APPLICATION->SetTitle("Каталог аэропортов");

		$slug_cn = $_GET["country"];

		$slug_ct = $_GET["city"];

		$iso_cn = false;

		$name_cn = false;

		if(CModule::IncludeModule('iblock')) {

			$arSort= Array("PROPERTY_country_english"=>"ASC");

			$arSelect = Array("PROPERTY_ISO", "PROPERTY_country_russian" , "PROPERTY_country_english");

			$arFilter = Array("IBLOCK_ID"=>52);

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

			//сортировка!!!
			$arSort= Array("PROPERTY_city_russian"=>"ASC", "PROPERTY_city_english"=>"ASC","name"=>"ASC");

			$arSelect = Array("NAME", "PROPERTY_IATA", "PROPERTY_city_russian", "PROPERTY_city_english", "PROPERTY_airport_russian" , "PROPERTY_airport_english");

			$arFilter = Array("IBLOCK_ID"=>52,"PROPERTY_ISO"=> $iso_cn);

			$res =  CIBlockElement :: GetList ($arSort, $arFilter, false,false, $arSelect);

			$apps_lib = Array();

			while($ob = $res->GetNextElement())
			{
				$arFields = $ob->GetFields();

				$current_city_slug = slug($arFields[PROPERTY_CITY_ENGLISH_VALUE]);

				if($slug_ct == $current_city_slug)
					$apps_lib[] = $arFields ;
			}


	if(count($apps_lib)==0) return404(); //если не нашлась страна

	$city_ru_name = strlen($apps_lib[0][PROPERTY_CITY_RUSSIAN_VALUE])>0?  $apps_lib[0][PROPERTY_CITY_RUSSIAN_VALUE]: $apps_lib[0][PROPERTY_CITY_ENGLISH_VALUE];

	$APPLICATION->SetTitle("Каталог аэропортов. $name_cn, $city_ru_name");

	$current_letter = "";

	//вывод результата
	foreach($apps_lib as $key=>$value)
	{
		$ap_slug = slug($value[PROPERTY_IATA_VALUE]);
		$name = strlen($value[PROPERTY_AIRPORT_RUSSIAN_VALUE])>0?$value[PROPERTY_AIRPORT_RUSSIAN_VALUE] :$value[NAME] ;

		if($current_letter != strtoupper(substr($name,0,1)))
		{
			$current_letter = strtoupper(substr($name,0,1));
			echo "<h1 style='padding-top:50px'>$current_letter</h1>\n";
		}

		echo "<hr><h3><a href='$ap_slug/'>".$name." (".$ap_slug.")</a></h3>\n";
	}

	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>