<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("canonical", "https://www.otpusk.by/o-kompanii/elektronnaya-priemnaya/");
$APPLICATION->SetTitle("Электронная приемная");
?><button><a href="https://www.otpusk.by/ab-kampanii/elektronnaya-pryyemnaya.php">БЕЛАРУСКАЯ МОВА</a></button>&nbsp; <br>
 <br>
<p>
</p>
<h4>График личного приема граждан, в том числе индивидуальных&nbsp;предпринимателей, представителей юридических лиц,&nbsp;директором республиканского унитарного предприятия&nbsp;«ЦЕНТРКУРОРТ» и его заместителями.</h4>
<p>
</p>
<p>
	 &nbsp;
</p>
<table border="1" cellspacing="0" cellpadding="0" class="table">
<tbody>
<tr>
	<td>
 <span style="color: #004a80;"> </span><b><span style="color: #004a80;">
		Фамилия, имя, отчество, должность руководителя </span></b><span style="color: #004a80;"> </span>
	</td>
	<td>
 <span style="color: #004a80;"> </span><b><span style="color: #004a80;">
		Время приема </span></b><span style="color: #004a80;"> </span>
	</td>
	<td>
 <span style="color: #004a80;"> </span><b><span style="color: #004a80;">
		Место приема</span></b>
	</td>
</tr>
<tr>
	<td colspan="1">
		 КОНЧИЦ Светлана Николаевна, директор
	</td>
	<td colspan="1">
		 Первая среда месяца –&nbsp;с 9:00 до 13:00
	</td>
	<td colspan="1">
		 г. Минск, ул. Мясникова, д.39
	</td>
</tr>
</tbody>
</table>
<p>
	 Примечание: Прием осуществляется только по записи. Запись на прием ведется с 9.00 до 18.00&nbsp;по тел. 200-76-73
</p>
<h4>Порядок обращения граждан посредством электронной приемной:</h4>
<ol>
	 1. «Электронная приемная» РУП «ЦЕНТРКУРОРТ» (далее – «Электронная приемная») является средством взаимодействия граждан и юридических лиц с РУП «ЦЕНТРКУРОРТ» (далее – учреждение), основанным на обмене информацией в специальной рубрике на официальном интернет-сайте учреждения <a href="https://www.otpusk.by" target="_blank">www.otpusk.by</a>. «Электронной приемной» принимаются электронные обращения граждан и юридических лиц, направленные в адрес предприятия. Письменные обращения граждан, должны содержать:
	<ul class="ml-20">
		<li><i class="fa fa-check-circle text-primary"></i> наименование и (или) адрес организации либо должность лица, которым направляется обращение;</li>
		<li><i class="fa fa-check-circle text-primary"></i> фамилию, собственное имя, отчество (если таковое имеется) либо инициалы гражданина, адрес его места жительства (места пребывания) и (или) места работы (учебы);</li>
		<li><i class="fa fa-check-circle text-primary"></i> изложение сути обращения;</li>
		<li><i class="fa fa-check-circle text-primary"></i> адрес электронной почты заявителя.</li>
	</ul>
	 2. Письменные обращения юридических лиц должны содержать:
	<ul class="ml-20">
		<li><i class="fa fa-check-circle text-primary"></i> наименование и (или) адрес организации либо должность лица, которым направляется обращение;</li>
		<li><i class="fa fa-check-circle text-primary"></i> полное наименование юридического лица и его место нахождения;</li>
		<li><i class="fa fa-check-circle text-primary"></i> изложение сути обращения;</li>
		<li><i class="fa fa-check-circle text-primary"></i> фамилию, собственное имя, отчество (если таковое имеется) руководителя или лица, уполномоченного в установленном порядке подписывать обращения;</li>
		<li><i class="fa fa-check-circle text-primary"></i> адрес электронной почты заявителя.</li>
	</ul>
	 3. Тексты электронных обращений должны поддаваться прочтению. Запрещается употребление нецензурных, либо оскорбительных слов или выражений Отзыв электронного обращения осуществляется путем подачи письменного заявления либо направления заявления в электронном виде в «Электронную приемную». Предприятие имеет право по решению директора предприятия размещать в «Электронной приемной» тексты наиболее часто поднимаемых в обращениях вопросов, а также ответы на них без согласия обратившихся граждан или юридических лиц. При этом не подлежит размещению на сайте информация о персональных данных граждан и юридических лиц.
</ol>
<h4>Для того, чтобы оставить обращение в нашей электронной приемной, заполните данную форму:</h4>
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
		"COMPONENT_TEMPLATE" => "form-application",
		"EDIT_ADDITIONAL" => "N",
		"EDIT_STATUS" => "N",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"NOT_SHOW_FILTER" => array(0=>"",1=>"",),
		"NOT_SHOW_TABLE" => array(0=>"",1=>"",),
		"RESULT_ID" => $_REQUEST[RESULT_ID],
		"SEF_MODE" => "N",
		"SHOW_ADDITIONAL" => "N",
		"SHOW_ANSWER_VALUE" => "N",
		"SHOW_EDIT_PAGE" => "N",
		"SHOW_LIST_PAGE" => "N",
		"SHOW_STATUS" => "N",
		"SHOW_VIEW_PAGE" => "N",
		"START_PAGE" => "new",
		"SUCCESS_URL" => "",
		"USE_EXTENDED_ERRORS" => "N",
		"VARIABLE_ALIASES" => array("action"=>"action",),
		"WEB_FORM_ID" => "4"
	)
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>