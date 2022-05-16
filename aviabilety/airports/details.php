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

		$iata_code = $_GET["amp;app"];

		$name_cn = false;

		$city_ru_name = "";

		$ap_object = false;


		if(CModule::IncludeModule('iblock')) {

			$arSort= Array("PROPERTY_city_russian"=>"ASC", "PROPERTY_city_english"=>"ASC","name"=>"ASC");

			$arSelect = Array("NAME", "PROPERTY_IATA",
										"PROPERTY_country_russian", 
										"PROPERTY_country_english",
										 "PROPERTY_city_russian", 
										"PROPERTY_city_english", 
										"PROPERTY_airport_russian" ,
									   "PROPERTY_airport_english",
										"PROPERTY_height",
										"PROPERTY_length",
										"PROPERTY_time_zone",
										"PROPERTY_email", 
										"PROPERTY_phone", 
										"PROPERTY_longitude", 
										"PROPERTY_latitude",
										"PROPERTY_coordinates",  
										"PROPERTY_site","PREVIEW_TEXT");

			$arFilter = Array("IBLOCK_ID"=>51,"PROPERTY_IATA"=> strtoupper($iata_code));

			$res =  CIBlockElement :: GetList ($arSort, $arFilter, false,false, $arSelect);

			$apps_lib = Array();

			if($ob = $res->GetNextElement())
			{

				$arFields = $ob->GetFields();

				$current_city_slug = slug($arFields[PROPERTY_CITY_ENGLISH_VALUE]);
				$current_cn_slug = slug($arFields[PROPERTY_COUNTRY_ENGLISH_VALUE]);

				$city_name =  strlen( $arFields[PROPERTY_CITY_RUSSIAN_VALUE]) >0?$arFields[PROPERTY_CITY_RUSSIAN_VALUE]:$arFields[PROPERTY_CITY_ENGLISH_VALUE];
				//print_r ($city_name);
				if(($current_cn_slug == $slug_cn))
				{
					$APPLICATION->SetTitle("Каталог аэропортов. Аэропорт $arFields[NAME], $city_name ($arFields[PROPERTY_COUNTRY_RUSSIAN_VALUE])");

					$ap_object = $arFields; 
				}
				else
					return404();
			}
			else
				return404();
		}

		global $_CRUMB;

		$_CRUMB = Array(
			0=>Array("TITLE"=>"Главная", "LINK"=>"../../.."),
			1=>Array("TITLE"=>"Аэропорты", "LINK"=>"../.."),
			2=>Array("TITLE"=>$ap_object[PROPERTY_COUNTRY_RUSSIAN_VALUE], "LINK"=>".."),
			3=>Array("TITLE"=> strlen($ap_object[PROPERTY_AIRPORT_RUSSIAN_VALUE]) > 0 ? $ap_object[PROPERTY_AIRPORT_RUSSIAN_VALUE] : $ap_object[NAME] , "LINK"=>""),
			);

		require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");


	$apProperties = Array(

		"country_russian"=> "Страна",
		"city_russian"=> "Город",
		"time_zone"=> "Часовой пояс города",
		"airport_english"=> "Английское название",
		"airport_russian"=> "Русское название",
		"iata"=> "Код IATA (ИАТА)",
		"icao"=> "Код ICAO (ИКАО)",
		"coordinates"=> "Географические координаты аэропорта",
		"length"=> "Длина взлетно-посадочной полосы",
		"height"=> "Высота над уровнем моря, метров",
		"site"=> "Адрес сайта",
		"phone"=> "Телефон",
		"email"=> "Контактный email",
		"longitude"=> "Долгота",
		"latitude"=> "Широта"

	);


?>

					<h1>Аэропорт <?=(strlen($ap_object[PROPERTY_AIRPORT_RUSSIAN_VALUE]) > 0 ? $ap_object[PROPERTY_AIRPORT_RUSSIAN_VALUE] : $ap_object[NAME])." - ".$ap_object[PROPERTY_COUNTRY_RUSSIAN_VALUE]?></h1>
					<div style="width:100%; padding:3px 10px">
					  <h4>Характеристики</h4>
					  <div style="line-height:16px; margin-left:10px">
<?
	foreach($apProperties as $k=>$v)
	{
		$key = strtoupper($k);



		if( $ap_object["PROPERTY_".$key."_VALUE"])
			if($key!="SITE")
				echo "<b>$v:</b> <span>".$ap_object["PROPERTY_".$key."_VALUE"]."</span><br> \n";
			else
				echo "<b>$v:</b> <span>".str_replace("http://","",$ap_object["PROPERTY_".$key."_VALUE"])."</span><br> \n";

	}

?>
					  </div> 
					 </div>

<?
	if($ap_object["PROPERTY_LONGITUDE_VALUE"]):

?>
					<div style="width:100%; min-height:300px; padding:3px 10px; border:0px solid">
					  <h4 style="margin-left:10px; position:relative">Карта</h4>
						<iframe 



src='https://maps.google.com/maps?f=q&source=s_q&hl=ru&aq=1&oq=333&q=<?=$ap_object["PROPERTY_LATITUDE_VALUE"]?>,<?=$ap_object["PROPERTY_LONGITUDE_VALUE"]?>&amp;&sll=<?=$ap_object["PROPERTY_LATITUDE_VALUE"]?>,<?=$ap_object["PROPERTY_LONGITUDE_VALUE"]?>&t=m&z=10&ll=<?=$ap_object["PROPERTY_LATITUDE_VALUE"]?>,<?=$ap_object["PROPERTY_LONGITUDE_VALUE"]?>&output=embed'

 style='border: 1px solid black; height:260px; width:100%'>

						</iframe>
					</div>

<?
	endif;

	if($ap_object["PREVIEW_TEXT"]):
?>
					<div style="width:100%;border-top:1px solid; padding:3px 10px; margin-top:10px">
					  <h4 style="margin-top:10px">Подробнее о аэропорте</h4>
					<?=$ap_object["PREVIEW_TEXT"]?>
					</div>

<?
	endif;
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>