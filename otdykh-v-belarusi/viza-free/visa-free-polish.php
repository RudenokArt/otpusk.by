<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Visa free (Polish)");
?><div>
 <img width="23" src="https://www.otpusk.by/upload/medialibrary/8dc/arow.png" style="width:23px" vspace="5" align="left" hspace="5">
</div>
 &nbsp;&nbsp;<a href="https://www.otpusk.by/otdykh-v-belarusi/viza-free/">Назад</a>
<p>
 <b><br>
 </b>
</p>
<p>
</p>
<p>
 <b>Tryb sporządzenia dokumentu umożliwiającego bezwizowy wjazd </b>
</p>
 <b> </b>
<ul type="disc">
	<li><i class="fa fa-check-circle text-primary"></i> wypełnić wniosek obezwizowy wjazd;</li>
	<li><i class="fa fa-check-circle text-primary"></i> pootrzymaniu wniosku wystawimy fakturę&nbsp; płatniczą na opłatę usługi. Wyślemy pocztą elektroniczną; Zapłacić można przez Internet, zapomocą karty bankowej, lub gotówką w biurze naszej firmy;</li>
	<li><i class="fa fa-check-circle text-primary"></i> pozapłaceniu kosztów usług wyśli do naszego biura pocztą elektroniczną podpisaną&nbsp; kopię umowy;</li>
	<li><i class="fa fa-check-circle text-primary"></i> pootzymaniu opłaty wystawimy pocztą elektroniczną potrzebne dokumenty;</li>
	<li><i class="fa fa-check-circle text-primary"></i> pootrzymaniu «Dokumenty ustalonego wzorca»,wydrukuj ten dokument, zapoznajsi ęz Poradnikiem dla turystywjeżdżającego n aBiałoruś I postaw swój podpis w przepustce;</li>
	<li><i class="fa fa-check-circle text-primary"></i> Przy przekroczeniu granicy okaż ważny paszport, przepustkę, orazpolisę medyczną;</li>
</ul>
 <?$APPLICATION->IncludeComponent(
	"bitrix:form",
	"form-application",
	Array(
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CHAIN_ITEM_LINK" => "",
		"CHAIN_ITEM_TEXT" => "",
		"EDIT_ADDITIONAL" => "N",
		"EDIT_STATUS" => "Y",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"NOT_SHOW_FILTER" => array("SIMPLE_QUESTION_979","SIMPLE_QUESTION_449","SIMPLE_QUESTION_283","SIMPLE_QUESTION_665","SIMPLE_QUESTION_528","SIMPLE_QUESTION_861","SIMPLE_QUESTION_274","SIMPLE_QUESTION_585",""),
		"NOT_SHOW_TABLE" => array("",""),
		"RESULT_ID" => $_REQUEST[RESULT_ID],
		"SEF_MODE" => "N",
		"SHOW_ADDITIONAL" => "N",
		"SHOW_ANSWER_VALUE" => "N",
		"SHOW_EDIT_PAGE" => "N",
		"SHOW_LIST_PAGE" => "N",
		"SHOW_STATUS" => "Y",
		"SHOW_VIEW_PAGE" => "Y",
		"START_PAGE" => "new",
		"SUCCESS_URL" => "",
		"USE_EXTENDED_ERRORS" => "N",
		"VARIABLE_ALIASES" => Array("action"=>"action"),
		"WEB_FORM_ID" => "8"
	)
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>