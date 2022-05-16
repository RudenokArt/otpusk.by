<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Техподдержка");
?><?$APPLICATION->IncludeComponent(
	"bitrix:support.ticket",
	"support",
	Array(
		"MESSAGES_PER_PAGE" => "20",
		"MESSAGE_MAX_LENGTH" => "70",
		"MESSAGE_SORT_ORDER" => "asc",
		"SEF_FOLDER" => "/agentstvam/tekhpodderzhka/",
		"SEF_MODE" => "Y",
		"SEF_URL_TEMPLATES" => Array("ticket_edit"=>"#ID#.php","ticket_list"=>"index.php"),
		"SET_PAGE_TITLE" => "Y",
		"SET_SHOW_USER_FIELD" => array(),
		"SHOW_COUPON_FIELD" => "N",
		"TICKETS_PER_PAGE" => "50"
	)
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>