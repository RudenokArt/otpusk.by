<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Visa free (English)");
?><div>
 <img width="23" src="https://www.otpusk.by/upload/medialibrary/8dc/arow.png" height="19" style="width:23px" vspace="5" align="left" hspace="5">
</div>
 &nbsp;&nbsp;<a href="https://www.otpusk.by/otdykh-v-belarusi/viza-free/">Назад</a>
<p>
 <b><br>
 </b>
</p>
<p>
 <b>Information about the procedure of visa free for republic of Belarus </b>
</p>
 <b> </b>
<ul>
	<li><i class="fa fa-check-circle text-primary"></i> Send the application form.</li>
	<li><i class="fa fa-check-circle text-primary"></i> After receiving the application, our specialist will prepare for you the agreement for booked services and the invoice. All the documents will be send for you by mail. To pay the services you can via bank account, credit card, or the system ERIP. &nbsp;</li>
	<li><i class="fa fa-check-circle text-primary"></i> You have to pay the invoice and send us back the signed copy of agreement.</li>
	<li><i class="fa fa-check-circle text-primary"></i> After you will receive you payment, we will send you all the documents:</li>
</ul>
 <br>
 - the document - confirmation to the right to visit free visa zone – you have to print it, and to put your signature, <br>
 - instruction for foreign citizens, coming to free visa zone – you have to read it carefully <br>
 <br>
 <b>In check points of border with the republic of Belarus you must have with you:</b>
<p>
</p>
<ul>
	<li><i class="fa fa-check-circle text-primary"></i> Valid passport </li>
	<li><i class="fa fa-check-circle text-primary"></i> Printed document –confirmation&nbsp; to the right to visit the free visa zone </li>
	<li><i class="fa fa-check-circle text-primary"></i> Medical insurance </li>
	<li><i class="fa fa-check-circle text-primary"></i> Migration card ( will be given by boarder guard)</li>
</ul>
<p>
	 .
</p>
<p>
 <br>
</p>
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
		"NOT_SHOW_FILTER" => array("SIMPLE_QUESTION_508","SIMPLE_QUESTION_757","SIMPLE_QUESTION_974","SIMPLE_QUESTION_881","SIMPLE_QUESTION_680","SIMPLE_QUESTION_877","SIMPLE_QUESTION_719","SIMPLE_QUESTION_124",""),
		"NOT_SHOW_TABLE" => array("",""),
		"RESULT_ID" => $_REQUEST[RESULT_ID],
		"SEF_MODE" => "N",
		"SHOW_ADDITIONAL" => "N",
		"SHOW_ANSWER_VALUE" => "N",
		"SHOW_EDIT_PAGE" => "Y",
		"SHOW_LIST_PAGE" => "N",
		"SHOW_STATUS" => "Y",
		"SHOW_VIEW_PAGE" => "Y",
		"START_PAGE" => "new",
		"SUCCESS_URL" => "",
		"USE_EXTENDED_ERRORS" => "N",
		"VARIABLE_ALIASES" => Array("action"=>"action"),
		"WEB_FORM_ID" => "7"
	)
);?><br>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>