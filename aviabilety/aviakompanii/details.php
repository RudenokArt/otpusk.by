<?
		function return404()
		{

			die("не найдена авиакомпания");
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

		$APPLICATION->SetTitle("Каталог авиакомпаний мира");

		$slug = htmlspecialcharsbx($_GET["ac"]);

		$ac_object = false;

		if(CModule::IncludeModule('iblock')) {

			$arSort= Array("name"=>"ASC");

			$arSelect = Array("NAME", "PROPERTY_CODE_IATA", "PREVIEW_TEXT");

			$arFilter = Array("IBLOCK_ID"=>52);

			$res =  CIBlockElement :: GetList ($arSort, $arFilter, false,false, $arSelect);

			$apps_lib = Array();

			while($ob = $res->GetNextElement())
			{
				$arFields = $ob->GetFields();

				$current_slug = slug($arFields[NAME]);

				if($current_slug == $slug)
				{


					$ac_object = $arFields; 
				}
			}

		}
echo $slug;

		if(!$ac_object) return404();

		global $_CRUMB;

		$_CRUMB = Array(
			0=>Array("TITLE"=>"Главная", "LINK"=>"../.."),
			1=>Array("TITLE"=>"Авиакомпании", "LINK"=>".."),
			2=>Array("TITLE"=> $ac_object[NAME],  "LINK"=>""),
			);

		require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

		$APPLICATION->SetTitle("Каталог Авиакомпаний. Авиакомпания ".$ac_object[NAME]);

		$apProperties = Array(
	
			"code_iata"=> "Код IATA"
	
		);


?>

					<h1>Авиакомпания <?=$ac_object["NAME"]?> </h1>
					<div style="width:48%; padding:3px 10px">

					  <div style="line-height:16px; margin-left:10px">

						  <img style="width:auto;" src='/images/airline-logos/<?=$ac_object["PROPERTY_CODE_IATA_VALUE"]?>@2x.png'><br><br>
<?
	foreach($apProperties as $k=>$v)
	{
		$key = strtoupper($k);



		if( $ac_object["PROPERTY_".$key."_VALUE"])
			if($key!="SITE")
				echo "<b>$v:</b> <span>".$ac_object["PROPERTY_".$key."_VALUE"]."</span><br> \n";
			else
				echo "<b>$v:</b> <span><a target=_blank href=".$ac_object["PROPERTY_".$key."_VALUE"].">".str_replace("http://","",$ac_object["PROPERTY_".$key."_VALUE"])."</a></span><br> \n";

	}

?>
					  </div> 
					 </div>

<?

	if($ac_object["PREVIEW_TEXT"]):
?>
					<div style="width:100%;border-top:1px solid; padding:3px 10px; margin-top:10px">
					  <h4>Информация об авиакомпании</h3>
					<?=$ac_object["PREVIEW_TEXT"]?>
					</div>

<?
		else:
?>
					<div style="width:100%;border-top:1px solid; padding:3px 10px; margin-top:10px">
					  <h4>Информация об авиакомпании</h3>
					Авиакомпания <?=$ac_object["NAME"]?>. Вы можете выбрать и заказать авиабилеты на нашем сайте при помощи системы онлайн-бронирования.

					</div>
<?

	endif;

$lang = Array(

	"Fleet list" => "Самолеты компании",
	"Aircraft family" => "Название",
	"Quantity" => "Кол-во",
	"Scheduled flights" => "Расписание рейсов",

	"<a"=>"<span",
	"</a>"=>"</span>"
);

/* $text = file_get_contents("http://planefinder.net/data/airline/".$ac_object["PROPERTY_CODE_IATA_VALUE"]);

$index1 = strpos($text,"<div class=\"row content-row\">");
$index2 = strpos($text,"<div class=\"col-md-4\">") ;

$text = substr($text, $index1 , $index2  - $index1 );
foreach($lang as $k=>$v)
$text = str_replace($k ,$v , $text);*/
?>
<style>
	.content-row
	{float:left; width:48%; display:block; padding-top:20px}
</style>
<?

//echo "<begin>";
//echo $text;
//echo "</begin>";
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>