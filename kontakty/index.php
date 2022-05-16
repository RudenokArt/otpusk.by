<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords", "контакты центркурорт, контакты отпускбай контакты туроператор рб");
$APPLICATION->SetPageProperty("description", "Контактная информация туроператора ЦЕНТРКУРОРТ - офисы, телефоны, карта проезда.");
$APPLICATION->SetPageProperty("title", "Контакты - как с нами связаться");
$APPLICATION->SetTitle("Контакты ЦЕНТРКУРОРТ, туроператор");
?><?/*
<div class="col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3 pb-20">
							
	<div class="section-title">
	
		<h3><?
			// Заголовок
			$APPLICATION->IncludeFile($SERVER["DOCUMENT_ROOT"]."/include/contact_title.php", Array(), Array(
			    "MODE"      => "html",        // будет редактировать в веб-редакторе
			    "NAME"      => "Заголовок",      // текст всплывающей подсказки на иконке
			    ));
		?>
		</h3>
		
		<p><?
			// Статический текст
			$APPLICATION->IncludeFile($SERVER["DOCUMENT_ROOT"]."/include/contact_static_txt.php", Array(), Array(
			    "MODE"      => "html",        // будет редактировать в веб-редакторе
			    "NAME"      => "Статический текст",      // текст всплывающей подсказки на иконке
			    ));
		?></p>
		
	</div>
	
</div>
*/?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>