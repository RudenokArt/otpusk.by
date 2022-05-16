<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Техническая поддержка агентств");
$APPLICATION->SetPageProperty("ROBOTS", "noindex, nofollow");
$APPLICATION->SetTitle("Техподдержка");
?><?$APPLICATION->IncludeComponent(
	"bitrix:support.ticket", 
	"support", 
	array(
		"MESSAGES_PER_PAGE" => "20",
		"MESSAGE_MAX_LENGTH" => "70",
		"MESSAGE_SORT_ORDER" => "asc",
		"SEF_FOLDER" => "/agentstvam/tekhpodderzhka/",
		"SEF_MODE" => "N",
		"SET_PAGE_TITLE" => "Y",
		"SET_SHOW_USER_FIELD" => array(
		),
		"SHOW_COUPON_FIELD" => "N",
		"TICKETS_PER_PAGE" => "50",
		"COMPONENT_TEMPLATE" => "support",
		"VARIABLE_ALIASES" => array(
			"ID" => "ID",
		)
	),
	false
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>