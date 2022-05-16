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
		$APPLICATION->SetTitle("Каталог авиакомпаний");
		if(CModule::IncludeModule('iblock')) {

			//сортировка!!!
			$arSort= Array("name"=>"ASC");

			$arSelect = Array("PROPERTY_code_iata");
	
			$arFilter = Array("IBLOCK_ID"=>52);

			$res =  CIBlockElement :: GetList ($arSort, $arFilter, false,false, $arSelect);

			$ac_lib = Array();
			$letters_lib = Array();

			while($ob = $res->GetNextElement())
			{
					$arFields = $ob->GetFields();
					$ac_lib[] = $arFields; 

					$letters_lib[strtoupper(substr($arFields["NAME"],0,1))] = 1;
			}
		}

?><div>
	<ul><span style="float:left">Быстрый переход:</span>
		 <?
	foreach($letters_lib as $key=>$value)
		echo "<li class=\"catalog_letter_top\"><a href=\"#$key\">$key</a> |</li>";
?>
	</ul>
</div>
<br><?

	$current_letter = "";

	//вывод результата
	foreach($ac_lib as $value)
	{
		$slug = slug($value[NAME]);

		if($current_letter != strtoupper(substr($value[NAME],0,1)))
		{
			if($current_letter != "") echo "</ul></div>";

			$current_letter = strtoupper(substr($value[NAME],0,1));
			echo "<div style='float:left'><div class='catalog_letter'><a name=\"$current_letter\">$current_letter</a></div>\n";
			echo "<hr style='margin:5px 0px'>";
			echo "<ul style='min-width:960px'>\n";
		}

		//echo "<h3><a href='$slug/'>".$value[NAME]."</a></h3>\n";
		echo "<li class='catalog_country'><a style='color: #00468c;' href='$slug/'>".$value[NAME]." </a></li>\n";

	}

	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>