<!DOCTYPE html>
<html lang="ru">
<head>
	<title><?= $APPLICATION->ShowTitle()?></title>
	<link rel="shortcut icon" href="/favicon.ico" type="image/png">
	<?$APPLICATION->ShowHead()?>	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?
		$oAsset = \Bitrix\Main\Page\Asset::getInstance();

		//<!-- CSS Plugins -->
		$oAsset->addCSS(SITE_TEMPLATE_PATH . "/css/bootstrap.min.css");
		$oAsset->addCSS(SITE_TEMPLATE_PATH . "/css/animate.css.css");
		$oAsset->addCSS(SITE_TEMPLATE_PATH . "/css/main.css");
		$oAsset->addCSS(SITE_TEMPLATE_PATH . "/css/component.css");
		$oAsset->addCSS(SITE_TEMPLATE_PATH . "/css/jquery-ui.min.css");
		//<!-- CSS Custom -->
		$oAsset->addCSS(SITE_TEMPLATE_PATH . "/css/style(1).css");
	?>

	<style> 
		summary{
			cursor: pointer;
		}

		summary:hover{
			background-color: #636363 !important;
		}
</style>
	<!-- Fav and Touch Icons 
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?= SITE_TEMPLATE_PATH?>/images/ico/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= SITE_TEMPLATE_PATH?>/images/ico/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= SITE_TEMPLATE_PATH?>/images/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="<?= SITE_TEMPLATE_PATH?>/images/ico/apple-touch-icon-57-precomposed.png">
	<link rel="shortcut icon" href="<?= SITE_TEMPLATE_PATH?>/images/ico/favicon.png"-->
	<!-- CSS Font Icons -->
	<link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH?>/css/ionicons.css">
	<link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH?>/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH?>/css/pe-icon-7-stroke.css">
	<!--link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH?>/simple-line-icons.css"-->
	<link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH?>/css/themify-icons.css">
	<!-- Google Fonts -->
	<!--link href="<?= SITE_TEMPLATE_PATH?>/css/css" rel="stylesheet" type="text/css">
	<link href="<?= SITE_TEMPLATE_PATH?>/css/css(1)" rel="stylesheet" type="text/css"-->
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<!-- JS -->
	<?
    /*if($_SERVER["REQUEST_URI"] == "/aviabilety/aviabilety-nemo/"){
        $oAsset->addJS(SITE_TEMPLATE_PATH . "/js/jquery-2.1.3.min.js");
    }*/

    /*if(CSite::InDir('/aviabilety/index.php')) {
        $oAsset->addJS(SITE_TEMPLATE_PATH . "/js/jquery-2.1.3.min.js");
    } else {*/
        $oAsset->addJS(SITE_TEMPLATE_PATH . "/js/jquery-1.11.3.min.js");
   // }
	$oAsset->addJS(SITE_TEMPLATE_PATH . "/js/jquery-migrate-1.2.1.min.js");
	$oAsset->addJS(SITE_TEMPLATE_PATH . "/js/bootstrap.min.js");
	$oAsset->addJS(SITE_TEMPLATE_PATH . "/js/jquery.waypoints.min.js");
	//if(!CSite::InDir('/aviabilety/index.php')) {}
    $oAsset->addJS(SITE_TEMPLATE_PATH . "/js/jquery.easing.1.3.js");
	$oAsset->addJS(SITE_TEMPLATE_PATH . "/js/SmoothScroll.min.js");
	$oAsset->addJS(SITE_TEMPLATE_PATH . "/js/jquery.slicknav.min.js");
	$oAsset->addJS(SITE_TEMPLATE_PATH . "/js/jquery.placeholder.min.js");
	$oAsset->addJS(SITE_TEMPLATE_PATH . "/js/instagram.min.js");
	$oAsset->addJS(SITE_TEMPLATE_PATH . "/js/spin.min.js");
	$oAsset->addJS(SITE_TEMPLATE_PATH . "/js/jquery.introLoader.min.js");
	$oAsset->addJS(SITE_TEMPLATE_PATH . "/js/select2.full.js");
	$oAsset->addJS(SITE_TEMPLATE_PATH . "/js/jquery.introLoader.min.js");
	$oAsset->addJS(SITE_TEMPLATE_PATH . "/js/jquery.responsivegrid.js");
	$oAsset->addJS(SITE_TEMPLATE_PATH . "/js/ion.rangeSlider.min.js");
	$oAsset->addJS(SITE_TEMPLATE_PATH . "/js/readmore.min.js");
	$oAsset->addJS(SITE_TEMPLATE_PATH . "/js/slick.min.js");
	$oAsset->addJS(SITE_TEMPLATE_PATH . "/js/validator.min.js");
	$oAsset->addJS(SITE_TEMPLATE_PATH . "/js/jquery.raty.js");
	$oAsset->addJS(SITE_TEMPLATE_PATH . "/js/jquery-ui.min.js");
	$oAsset->addJS(SITE_TEMPLATE_PATH . "/js/customs.js");
	$oAsset->addJS(SITE_TEMPLATE_PATH . "/js/jquery.maskedinput.min.js");
	$oAsset->addJS(SITE_TEMPLATE_PATH . "/js/MapAdapter.js");
	?>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NNQVKDH');</script>
<!-- End Google Tag Manager -->

<link href="<?=SITE_TEMPLATE_PATH?>/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(1028882, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true,
        ecommerce:"dataLayer"
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/1028882" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->


</head>
<body>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NNQVKDH"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	<div id="introLoader" class="introLoading introLoader gifLoader theme-dark bubble" style="display: none;"><div id="introLoaderSpinner" class="gifLoaderInner" style=""></div></div>
	<!--noindex--><?
	// Авторизация/Регистрация пользователей (формы)
	$APPLICATION->IncludeFile($SERVER["DOCUMENT_ROOT"]."/include/modal_auth_register_forms.php", Array(), Array(
	    "MODE"      => "html",                // будет редактировать в веб-редакторе
	    "NAME"      => "Auth/Register",      // текст всплывающей подсказки на иконке
	    ));
	?><!--/noindex-->	

	<!-- start Container Wrapper -->

	<div class="container-wrapper">

		<!-- start Header -->
		<header id="header">
	  
			<!-- start Navbar (Header) -->

			<nav class="navbar navbar-primary navbar-fixed-top navbar-sticky-function">
                <div class="bad-see">
                    <a href="/unseeing/">
                       <i class="fa fa-eye"></i>
                        версия для слабовидящих
                    </a>
                </div>
				<div class="navbar-top">
					<div class="container">
						
						<div class="flex-row flex-align-middle">
							<div class="flex-shrink flex-columns ts-width-sm__100">
								<a class="navbar-logo" href="/">
								<?
								// Включаемый файл для логотипа	
								$APPLICATION->IncludeFile($SERVER["DOCUMENT_ROOT"]."/include/logo.php", Array(), Array(
								    "MODE"      => "html",        // будет редактировать в веб-редакторе
								    "NAME"      => "Логотип",      // текст всплывающей подсказки на иконке
								    ));
								?>
								</a>
							</div>
							<div class="flex-columns ts-width-sm__100">
							<? if(!$USER->IsAdmin()) {
								$APPLICATION->IncludeFile($SERVER["DOCUMENT_ROOT"]."/include/courses.php", Array(), Array(
								    "MODE"      => "html",        // будет редактировать в веб-редакторе
								    "NAME"      => "Курсы валют",      // текст всплывающей подсказки на иконке
								    ));
								} ?>
								<?/*if ($USER->IsAdmin()):?>
<a href="<?=$APPLICATION->GetCurPage()?>?special_version=Y">версия для слабовидящих</a>
<?endif;*/?>
								<div class="pull-right">
									<div class="navbar-mini">
										<ul class="clearfix">
                                            <?

                                            //Верхнее правое меню сайта
                                            $APPLICATION->IncludeComponent(
	"bitrix:menu", 
	".default", 
	array(
		"ROOT_MENU_TYPE" => "top",
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
); ?>
                                            <li class="user-action" >
                                            <? // Ссылки на ЛК, авторизацию, регистрацию
												$APPLICATION->IncludeFile($SERVER["DOCUMENT_ROOT"]."/include/auth_mechanizm.php", Array(), Array(
											    "MODE"      => "html",                // будет редактировать в веб-редакторе
											    "NAME"      => "Auth/Register",      // текст всплывающей подсказки на иконке
											    ));
											?>	
											</li>
											<li style="margin-right:10px"><a href="/search/" title="Поиск по сайту"><i class="fa fa-search-plus"></i></a></li>
                                            <li><?$APPLICATION->IncludeComponent(
                                                "travelsoft:travelsoft.switch.currency", "new", Array()
                                            );?></li>
                                        </ul>
									</div>
						
								</div>
							</div>
						</div>

					</div>
					
				</div>
				
				<div class="navbar-bottom">
				
					<div class="container">
					
						<div class="row">
						
							<div style="width:77% !important" class="col-sm-10 hidden-sm hidden-xs">
								
								<?  //Верхнее среднее меню сайта
									$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"top2", 
	array(
		"ROOT_MENU_TYPE" => "top2",
		"MAX_LEVEL" => "2",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"COMPONENT_TEMPLATE" => "top2"
	),
	false
);?>
								
							</div>

							<div style="width:23% !important; font-size: 90%; padding-left: 0px !important; padding-right: 0px !important;" class="col-sm-2">
							
<?
// phonebook
$path = $_SERVER['DOCUMENT_ROOT']. "/include/phonebook.php";
if(file_exists( $path ))
	require_once $path;
?>
							
							</div>

						</div>
						
					</div>
				
				</div>
				<div id="slicknav-mobile"></div>

				
			</nav>
			<!-- end Navbar (Header) -->

		</header>

		<div class="clear"></div>

		<div class="main-wrapper <?if (CSite::InDir('/tury-na-novyy-god/')){?>ny-2019<?}?>">
<?
// слайдер на главной
$APPLICATION->IncludeComponent("bitrix:main.include","",Array(
        "AREA_FILE_SHOW" => "page", 
        "AREA_FILE_SUFFIX" => "inc", 
        "AREA_FILE_RECURSIVE" => "N", 
        "EDIT_TEMPLATE" => "" 
    )
);?>


		<div class="clear"></div>

			<?/*
// блок с "достоинствами" на главной
$APPLICATION->IncludeComponent("bitrix:main.include","",Array(
        "AREA_FILE_SHOW" => "page", 
        "AREA_FILE_SUFFIX" => "inc2", 
        "AREA_FILE_RECURSIVE" => "N", 
        "EDIT_TEMPLATE" => "" 
    )
);*/?>

<?
// Большая картинка для раздела сайта (для вывода задать свойство для раздела BIG_IMG)
if(file_exists($_SERVER["DOCUMENT_ROOT"] . "/include/big_inner_img.php"))
	require_once $_SERVER["DOCUMENT_ROOT"] . "/include/big_inner_img.php"?>


<?
// центрирование контента, боковое меню, хлебные крошки // начало
// NO_CENTERED задаётся перед подключением header.php на странице (index.php) 
if(NOT_CENTERED !== true):?>

	<?// breadcrumb
	$APPLICATION->IncludeComponent("bitrix:breadcrumb","",Array(
	        "START_FROM" => "0", 
	        "PATH" => "", 
	        "SITE_ID" => "" 
	    )
	);?>


	<div class="container"> <!-- start .container -->
		<div class="row"> <!-- start .row -->

	<?$GLOBALS['NEED_CLOSE_FOOTER_TAGS'][] = "</div>";
	$GLOBALS['NEED_CLOSE_FOOTER_TAGS'][] = "</div>";?>

	<?if($APPLICATION->GetDirProperty("NOT_SHOW_LEFT_MENU") != "Y"):?>

		<?// Боковое меню внутренних страниц
			$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"left", 
	array(
		"ROOT_MENU_TYPE" => "left",
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"COMPONENT_TEMPLATE" => "left",
		"FILTER_CONSISTING" => "N"
	),
	false
);
		?>
	
	<?endif;?>


	<? //Хак для выключения левой боковины (уcтанавливается для страниц в urlrewrite.php, можно использовать для комплексных компонентов)
	if($_REQUEST['not_show_right_side'] != 'Y'):?>
		<?
		// Фильтр и баннер
		$APPLICATION->IncludeComponent("bitrix:main.include","",Array(
		        "AREA_FILE_SHOW" => "page", 
		        "AREA_FILE_SUFFIX" => "filter", 
		        "AREA_FILE_RECURSIVE" => "N", 
		        "EDIT_TEMPLATE" => "" 
		    )
		);?>
		
		<?if(NOT_FLOAT_RIGHT !== true):?>
			<div class="col-sm-8 col-md-9">
			<?$GLOBALS['NEED_CLOSE_FOOTER_TAGS'][] = "</div>";?>
		<?endif?>
	<?endif?>

<?endif;?>

