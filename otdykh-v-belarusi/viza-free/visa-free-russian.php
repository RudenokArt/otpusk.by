<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Visa free (Russian)");
?><div>
 <img width="23" src="https://www.otpusk.by/upload/medialibrary/8dc/arow.png" style="width:23px" vspace="5" align="left" hspace="5">
</div>
 &nbsp;&nbsp;<a href="https://www.otpusk.by/otdykh-v-belarusi/viza-free/">Назад</a>
<p>
 <b><br>
 </b>
</p>
<p>
 <b>ПОРЯДОК ОФОРМЛЕНИЯ&nbsp; БЕЗВИЗОВОГО ВЪЕЗДА В РЕСПУБЛИКУ БЕЛАРУСЬ</b><br>
</p>
 <b> </b>
<p>
	 1.Оформить заявку на безвизовый въезд.&nbsp;
</p>
<p>
	 2.После получения заявки, специалист нашей компании подготовит&nbsp; договор на забронированные услуги, оформит счет фактуру на оплату услуг. Все документы будут вам отправлены по электронной почте.&nbsp;
</p>
<p>
	 3.Оплатить наши услуги вы можете банковской карточкой,&nbsp; банковским перечислением, системой ERIP, наличными деньгами у нас в офисе.&nbsp;
</p>
<div>
	 Вам нужно оплатить услуги и выслать нам обратно подписанную копию договора. <br>
	 4.После получения оплаты, мы отправим Вам по электронной почте все необходимые документы:<br>
	<ul>
		<li>документ установленного образца, который нужно распечатать и поставить в нем вашу подпись,</li>
		<li>памятка для туристов, приезжающих в Республику Беларусь по безвизовому режиму, с которой вам нужно внимательно ознакомиться. </li>
	</ul>
 <br>
	 5.В пункте пересечения границы Республики Беларусь, Вам необходимо будет предъявить: действительный паспорт, распечатанный документ на право посещения безвизовой зоны, медицинскую страховку, миграционную карту (выдается при пересечении границы).
</div>
 <br>
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
		"NOT_SHOW_FILTER" => array("SIMPLE_QUESTION_827","SIMPLE_QUESTION_418","SIMPLE_QUESTION_912","SIMPLE_QUESTION_225","SIMPLE_QUESTION_457","SIMPLE_QUESTION_916","SIMPLE_QUESTION_661","SIMPLE_QUESTION_688","SIMPLE_QUESTION_792",""),
		"NOT_SHOW_TABLE" => array("","SIMPLE_QUESTION_749",""),
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
		"WEB_FORM_ID" => "6"
	)
);?><br>
 <br>
<p>
</p>
<p>
</p><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>