<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
	IncludeTemplateLangFile(__FILE__);
?>
<?
if($_GET['special_version'] == 'Y'){
	session_start();
	$setval='{"color":"white","font":"normal"}';
	setcookie("aaSet",$setval, time()+3600,'/');
	$_SESSION['special_version'] = true;
}
if($_GET['special_version'] == 'N'){
	session_start();
	$_SESSION['special_version'] = false;
	header('Location: '.$APPLICATION->GetCurPage());
}
?>
 <?$aRstyle=json_decode($_COOKIE["aaSet"]);
   $style="";
   foreach($aRstyle as $key=>$value)
   {
		if($value!=NULL) $style=$style." ".$key.'-'.$value;
   } 
   if(strpos($style, "color")=== false) $style.=" color-white"; 
   if(strpos($style, "font")=== false) $style.=" font-normal";
   if(strpos($style, "image")=== false) $style.=" image-on";
 ?>
<!DOCTYPE html>
<html lang="ru" class="<?=$style?>">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="author" content="">     
		<?
		 CJSCore::Init('jquery');
		 $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.cookie.js", true);
		 $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquerysession.js", true);
		 $APPLICATION->SetAdditionalCss(SITE_TEMPLATE_PATH."/font-awesome/css/font-awesome.min.css", true);

		?>

	
	<?  if(strstr ($_COOKIE["aaSet"],"black"))
		 { 
		 $APPLICATION->AddHeadString('<link href="'.SITE_TEMPLATE_PATH.'/special_styles/special_black.css" type="text/css" data-template-style="true" rel="stylesheet" id="wpStylesheet">');
		  } 
		 else if(strstr ($_COOKIE["aaSet"],"blue"))
		 { 
		 $APPLICATION->AddHeadString('<link href="'.SITE_TEMPLATE_PATH.'/special_styles/special_blue.css" type="text/css" data-template-style="true" rel="stylesheet" id="wpStylesheet">');
		  } 
		   else if(strstr ($_COOKIE["aaSet"],"yellow"))
		 { 
		 $APPLICATION->AddHeadString('<link href="'.SITE_TEMPLATE_PATH.'/special_styles/special_yellow.css" type="text/css" data-template-style="true" rel="stylesheet" id="wpStylesheet">');
		  } 
		  else 
		 {
			 $APPLICATION->AddHeadString('<link href="'.SITE_TEMPLATE_PATH.'/special_styles/special_white.css" type="text/css" data-template-style="true" rel="stylesheet" id="wpStylesheet">');
		 }
				
	?>
		
		<?$APPLICATION->ShowHead();?>
	</head> 
	<body>
	
	<?$APPLICATION->ShowPanel();?>
	<?if(CModule::IncludeModuleEx("simai.special")==3):?>
	  <h3 style="text-align:center"><?=getMessage("EXIST")?><a target="_blank" href="http://marketplace.1c-bitrix.ru/solutions/simai.special/"><?=getMessage("LINK")?></a></h3>
	<?endif;?>
		<div class="container">
		<?include_once "special.php";?>
		 <h1 class="site_name"><a href="<?=SITE_DIR?>"><?=COption::GetOptionString("simai.special", "organization", "")?></a></h1>
<header>

<?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"2level-horizontal", 
	array(
		"ROOT_MENU_TYPE" => "top",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "36000000",
		"MENU_CACHE_USE_GROUPS" => "N",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "2",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"COMPONENT_TEMPLATE" => "2level-horizontal"
	),
	false
);?>
</header>
	<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", ".default", Array(
			"START_FROM" => "0",
			"PATH" => "",
			"SITE_ID" => SITE_ID,
			"MIBOK_SPECIAL_COMPARE" => "N"
			),
			false
	);?>
<div>

