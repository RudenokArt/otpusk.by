<?$prov=CModule::IncludeModuleEx("simai.special");if($prov==0||$prov==3)return;?><?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

$s = "<div class=\"breadcrumb-wrapper bg-light-2 mb-20\">
				
		<div class=\"container\">
	
			<ol class=\"breadcrumb-list\">";

$m_k = count($arResult) - 1;
foreach($arResult as $k => $i)
{
	if($i["LINK"] != "" && $k < $m_k)
		$s .= "<li><a href=\"" . $i["LINK"] . "\">" . $i["TITLE"] . "</a></li>";
	else
		$s .= "<li><span>" . $i["TITLE"] . "</span></li>";
}

$s .= "</ol></div></div>";

return $s;