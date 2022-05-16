<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$scroll = array();
$i=0;
//dm($arResult['permit']);
?>
<?
$title = $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] != "" ? $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] : $arResult['NAME'];
?>
<div class="col-md-9" role="main">

	<div class="detail-content-wrapper">

		<div style="overflow:auto" id="section-0" class="detail-content pb-0">

			<div class="section-title text-left">
				
				<?
					// must print
					$tag = "h1";
					if(h1Exists())
						$tag = "h3";
				?>

				<<?= $tag?>><?=$title?> <?$scroll[] = array("section-0", $title)?> <?= $arResult["PROPERTIES"]["CAT_ID"]['VALUE']?></<?= $tag?>>
			</div>
			<div class="col-sm-6 mb-30">
				<ul class="list-info no-icon bb-dotted padd-20">
					<?if(!empty($arResult["PROPERTIES"]["COUNTRY"]['VALUE'])):?><li><span class="list-info-name-contact">Страна: </span><div class="list-info-contact"><?= $arResult["DISPLAY_PROPERTIES"]["COUNTRY"]['DISPLAY_VALUE']?></div></li><?endif;?>
					<?if(!empty($arResult["PROPERTIES"]["TOWN"]['VALUE'])):?><li><span class="list-info-name-contact">Город: </span> <div class="list-info-contact"><?= $arResult["DISPLAY_PROPERTIES"]["TOWN"]['DISPLAY_VALUE']?></div></li><?endif;?>
					<?if(!empty($arResult["PROPERTIES"]["TYPE_ID"]['VALUE'])):?><li><span class="list-info-name-contact">Тип размещения:</span> <div class="list-info-contact"><?= $arResult["PROPERTIES"]["TYPE_ID"]['VALUE']?></div></li><?endif;?>
					<?if(!empty($arResult["PROPERTIES"]["CAT_ID"]['VALUE'])):?><li><span class="list-info-name-contact">Категория:</span> <div class="list-info-contact"><?= $arResult["PROPERTIES"]["CAT_ID"]['VALUE']?></div></li><?endif;?>
					<?if(!empty($arResult["PROPERTIES"]["HD_FAX"]['VALUE'])):?><li><span class="list-info-name-contact">Факс:</span> <div class="list-info-contact"><?= $arResult["PROPERTIES"]["HD_FAX"]['VALUE']?></div></li><?endif;?>
					<?if(!empty($arResult["PROPERTIES"]["HD_EMAIL"]['VALUE'])):?><li><span class="list-info-name-contact">E-mail:</span> <div class="list-info-contact"><?= $arResult["PROPERTIES"]["HD_EMAIL"]['VALUE']?></div></li><?endif;?>
					<?if(!empty($arResult["PROPERTIES"]["HD_HTTP"]['VALUE'])):?><li><span class="list-info-name-contact">Сайт:</span> <div class="list-info-contact"><a target="_blank" href="<?= $arResult["PROPERTIES"]["HD_HTTP"]['VALUE']?>" ><?= $arResult["PROPERTIES"]["HD_HTTP"]['VALUE']?></a></div></li><?endif;?>
					<?if(!empty($arResult["PROPERTIES"]["TYPE_EXCURSIONS"]['VALUE'])):?><li><span class="list-info-name-contact">Тип экскурсии:</span> <div class="list-info-contact"><?$type_exc=null; foreach ($arResult["DISPLAY_PROPERTIES"]["TYPE_EXCURSIONS"]["DISPLAY_VALUE"] as $type) {$type_exc .= $type.', ';}  if (isset($type_exc)): echo strip_tags($type_exc); else: print_r (strip_tags($arResult["DISPLAY_PROPERTIES"]["TYPE_EXCURSIONS"]["DISPLAY_VALUE"])); endif;?></div></li><?endif;?>
					<?if(!empty($arResult["PROPERTIES"]["THEME_TOURS"]['VALUE'])):?><li><span class="list-info-name-contact">Тема экскурсии:</span> <div class="list-info-contact"><?$theme_exc=null; foreach ($arResult["DISPLAY_PROPERTIES"]["THEME_TOURS"]["DISPLAY_VALUE"] as $theme) {$theme_exc .= $theme.', ';}  if (isset($theme_exc)): echo strip_tags($theme_exc); else: print_r (strip_tags($arResult["DISPLAY_PROPERTIES"]["THEME_TOURS"]["DISPLAY_VALUE"])); endif;?></div></li><?endif;?>
					<?if(!empty($arResult["PROPERTIES"]["TRANSPORT"]['VALUE'])):?><li><span class="list-info-name-contact">Транспорт:</span> <div class="list-info-contact"><?= strip_tags($arResult["DISPLAY_PROPERTIES"]["TRANSPORT"]['DISPLAY_VALUE'])?></div></li><?endif;?>
					<?if(!empty($arResult["PROPERTIES"]["DURATION_TIME"]['VALUE'])):?><li><span class="list-info-name-contact">Длительность (часов):</span> <div class="list-info-contact"><?= $arResult["PROPERTIES"]["DURATION_TIME"]['VALUE']?></div></li><?endif;?>
					<?if(!empty($arResult["PROPERTIES"]["DEPARTURE_EXC_TEXT"]['VALUE'])):?><li><span class="list-info-name-contact">Время и место начала:</span> <div class="list-info-contact"><?= $arResult["PROPERTIES"]["DEPARTURE_EXC_TEXT"]['VALUE']?></div></li><?endif;?>

					<?if($arResult["medprofiles"]):?><li><span class="list-info-name-contact">Медицинский профиль:</span> <div class="list-info-contact">
						<?foreach($arResult["medprofiles"] as $m)
							echo $m['NAME'] . "<br>"?>

					</div></li><?endif;?>
				</ul>
			</div>
			<div class="map-route" style="width: 400px; height: 300px;">
			
			<?$file_big=CFile::ResizeImageGet($arResult["PROPERTIES"]["PICTURES"]["VALUE"][0], Array('width'=>400, 'height'=>250),BX_RESIZE_IMAGE_EXACT,true);?>
			
			<img src="<?=$file_big["src"];?>" alt="<?= $arResult['NAME']?>" />
			</div>
		</div>
<?/*if ($USER->IsAdmin()):VETLIVA_KEY*/?>
		<?if($arResult["PROPERTIES"]["VETLIVA_KEY"]['VALUE'] > 0):?>
<div id="search-forms-iframe-block-496"><span>Идет загрузка формы поиска...</span></div>
                        <script src="https://vetliva.ru/travelsoft.pm/assets/js/bundles/init.js"></script>
                        <script>
                            Travelsoft.init({
                                    forms: {
                                        insertion_id: "search-forms-iframe-block-496",
                                        types: ["sanatorium"],
                                        active: "sanatorium",
                                        url: [""],
                                        def_objects: ["<?= $arResult["PROPERTIES"]["VETLIVA_KEY"]['VALUE']?>"],
                                        selectIframeCss: "",
                                        datepickerIframeCss: "",
                                        childrenIframeCss: "",
										mainIframeCss: ".btn-search-area button:hover{background-color: #EB5019 !important;border-color: #EB5019;} .btn-search-area button{border-radius: 0 !important; background: #EB5019;border-color: #EB5019;} .form-control{border-radius: 0} .nav-tabs{display: none !important;} .form-group {margin-bottom: 0px;}.col-md-3, .col-sm-6 {padding-right: 10px;padding-left: 10px;}.tab-content {margin-top: 10px;} .form-control {cursor: pointer;overflow: hidden;display: inline-block;line-height: 27px !important;height: 40px;}.btn-primary{-webkit-transition:all .3s;-o-transition:all .3s;transition:all .3s;text-transform:uppercase;font-size:13px;letter-spacing:2px;line-height:1;padding:11px 20px;border-width:2px}.container{width: 100%;} #span-for-sanatorium-objects{pointer-events: none;}"
                                    }
                            });
                        </script>
		<?if (in_array($arResult["PROPERTIES"]["VETLIVA_KEY"]['VALUE'], $_REQUEST["tpm_params"]["id"])):?>
<div class="form-tabs">
	<div class="tab1"><a class="active btn btn-primary" href="#tab1">Цена для граждан РБ</a></div>
	<div class="tab5"><a class="btn btn-primary" href="#tab2">Цена для граждан РФ</a></div>
	<div class="tab4" style="max-width:380px"><a class="btn btn-primary" href="#tab3">Цена для граждан Европы и др. стран</a></div>
</div>
<script>
                (function ($) {
                    var formIDS = ['#tab1', "#tab2", "#tab3"];
                    $(document).on('click', 'a[href="' + formIDS[0] + '"], a[href="' + formIDS[1] + '"], a[href="' + formIDS[2] + '"]', function (e) {

                        var t = $(this), actClass = "active", id = t.attr('href');

                        if (t.hasClass(actClass)) return false;

                        t.closest('.form-tabs').find('.' + actClass).removeClass(actClass);

                        $(formIDS[0] + ', ' + formIDS[1] + ', ' + formIDS[2]).hide();

                        $(id).show();

                        t.addClass(actClass);
                        e.preventDefault();
                    });
                })(jQuery);
</script>
<script src="https://vetliva.ru/travelsoft.pm/assets/js/bundles/init.js"></script>
<div id="tab1">
    <div id="search-result-iframe-block-905"><span>Идет загрузка результатов поиска...</span></div>
    <script>
        Travelsoft.init({
            searchResult: {
                insertion_id: "search-result-iframe-block-905",
                type: "sanatorium",
				citizen_price: "333",
                numberPerPage: 20,
                agent: "1094",
                hash: "1c44b8a5c418ccd52725c222bd11c6c7",
                mainIframeCss: ".btn-primary,.show-offers,.thumbnail{border-radius:0;font-size:13px}.show-offers{opacity:1;background:#EB5019;border-color:#EB5019;color:#FFF!important;padding:8px 12px 7px}.thumbnail{background:#FFF;-webkit-box-shadow:0 0 5px -1px rgba(0,0,0,.2);-moz-box-shadow:0 0 5px -1px rgba(0,0,0,.2);box-shadow:0 0 5px -1px rgba(0,0,0,.2);margin-bottom:30px;o-transition:all .3s ease-out;-ms-transition:all .3s ease-out;-moz-transition:all .3s ease-out;-webkit-transition:all .3s ease-out;line-height:22px;font-family:Arial,sans-serif;color:#3f3f3f}.glyphicon{width:20px;height:20px;line-height:20px;border-radius:50%;background:#EB5019;color:#FFF;text-align:center;font-size:10px}p{font-size:13px}.panel-title{font-size:22px;font-size:17px;color:#333}.panel-group .panel{border-radius:0}.panel-heading{border-top-left-radius:0;border-top-right-radius:0}.container{width: 100%;}"
            }
        });
    </script>
</div>
<div style="display: none" id="tab2">
<div id="search-result-iframe-block-268"><span>Идет загрузка результатов поиска...</span></div>
                    <script>
						$("a[href='#tab2']").one("click", function () {
							setTimeout(function () {

Travelsoft.init({
								afterLoadingPage: false,
								searchResult: {
									insertion_id: "search-result-iframe-block-268",
									type: "sanatorium",
									numberPerPage: 20,
									citizen_price: "332",
									agent: "1094",
									hash: "8384696c49db70a2b490814c0dbd8762",
									mainIframeCss: ".btn-primary,.show-offers,.thumbnail{border-radius:0;font-size:13px}.show-offers{opacity:1;background:#EB5019;border-color:#EB5019;color:#FFF!important;padding:8px 12px 7px}.thumbnail{background:#FFF;-webkit-box-shadow:0 0 5px -1px rgba(0,0,0,.2);-moz-box-shadow:0 0 5px -1px rgba(0,0,0,.2);box-shadow:0 0 5px -1px rgba(0,0,0,.2);margin-bottom:30px;o-transition:all .3s ease-out;-ms-transition:all .3s ease-out;-moz-transition:all .3s ease-out;-webkit-transition:all .3s ease-out;line-height:22px;font-family:Arial,sans-serif;color:#3f3f3f}.glyphicon{width:20px;height:20px;line-height:20px;border-radius:50%;background:#EB5019;color:#FFF;text-align:center;font-size:10px}p{font-size:13px}.panel-title{font-size:22px;font-size:17px;color:#333}.panel-group .panel{border-radius:0}.panel-heading{border-top-left-radius:0;border-top-right-radius:0}.container{width: 100%;}"
	
								}
							});
}, 300);

						});

                    </script>
</div>
<div style="display: none" id="tab3">
<div id="search-result-iframe-block-12"><span>Идет загрузка результатов поиска...</span></div>
    <script>
$("a[href='#tab3']").one("click", function () {
							setTimeout(function () {
        Travelsoft.init({
			afterLoadingPage: false,
            searchResult: {
                insertion_id: "search-result-iframe-block-12",
                type: "sanatorium",
				citizen_price: "356",
                numberPerPage: 20,
                agent: "1094",
                hash: "8384696c49db70a2b490814c0dbd8762",
                mainIframeCss: ".btn-primary,.show-offers,.thumbnail{border-radius:0;font-size:13px}.show-offers{opacity:1;background:#EB5019;border-color:#EB5019;color:#FFF!important;padding:8px 12px 7px}.thumbnail{background:#FFF;-webkit-box-shadow:0 0 5px -1px rgba(0,0,0,.2);-moz-box-shadow:0 0 5px -1px rgba(0,0,0,.2);box-shadow:0 0 5px -1px rgba(0,0,0,.2);margin-bottom:30px;o-transition:all .3s ease-out;-ms-transition:all .3s ease-out;-moz-transition:all .3s ease-out;-webkit-transition:all .3s ease-out;line-height:22px;font-family:Arial,sans-serif;color:#3f3f3f}.glyphicon{width:20px;height:20px;line-height:20px;border-radius:50%;background:#EB5019;color:#FFF;text-align:center;font-size:10px}p{font-size:13px}.panel-title{font-size:22px;font-size:17px;color:#333}.panel-group .panel{border-radius:0}.panel-heading{border-top-left-radius:0;border-top-right-radius:0}.container{width: 100%;}"
            }
        });
}, 100);

						});

    </script>
</div>
<?endif;?>
<?endif;?>
	<?if($arResult["PROPERTIES"]["MT_HOTELKEY"]['VALUE'] >= 0 && $arResult["PROPERTIES"]["NOT_SHOW_MT"]['VALUE'] != "Y"):
	         $scroll[] = array("section-1234522", "Поиск размещения");
	         ?>
		<div id="section-1234522">
		 <div class="section-title text-left">
           <h4>Поиск размещения</h4>
        </div>
        <?$APPLICATION->IncludeComponent(
			"travelsoft:form.search",
			"rooms-form",
			Array(
				"ADDITIONAL_SEARCH" => array(0=>"COUNTRY_12",1=>"TOWN_11",2=>"REGIONS_56",),
				"COMPONENT_TEMPLATE" => "placement-form",
				"IBLOCK_ID" => "14",
				"IBLOCK_TYPE" => "otpusk",
				"PROPERTY_CODE" => array(0=>"TYPE_ID",1=>"MT_HOTELKEY",),
				"QUERY_ADDRESS" => "",
				"SECTION_ID" => "168",
				"MT_KEY" => $arResult["PROPERTIES"]["MT_HOTELKEY"]['VALUE']
			)
		);?>
		<?$APPLICATION->IncludeComponent(
	"travelsoft:travelsoft.search.result", 
	"rooms-result", 
	array(
		"QUERY_ADDRESS" => "https://booking2.otpusk.by/TSSE/json_handler.ashx",
		"MT_KEY" => $arResult["PROPERTIES"]["MT_HOTELKEY"]["VALUE"],
		"PLACEMENT_NAME" => $arResult["NAME"],
		"COMPONENT_TEMPLATE" => "rooms-result",
        "OBJECT_NAME" => $arResult["NAME"].' '.strip_tags($arResult["DISPLAY_PROPERTIES"]["TYPE_ID"]["DISPLAY_VALUE"])
	),
	false
);?>
			
		</div>
	<?endif?>
<?/*endif*/?>

		<?if($arResult["PROPERTIES"]["MT_KEY"]['VALUE'] > 0 && $arResult["MT_COUNTRY_KEY"] > 0):
         $scroll[] = array("section-12345", "Поиск размещения");
         ?>

         <div id="section-12345" class="detail-content ul-list">
            <div class="section-title text-left">
               <h4>Поиск размещения</h4>
            </div>
            <iframe id="frame_block" style="width: 100%;" src="<?= str_replace(array("{mt_id}", "{country_mt_id}"), array($arResult["PROPERTIES"]["MT_KEY"]['VALUE'], $arResult["MT_COUNTRY_KEY"]), Set::IFRAME_URL_TEMPLATE)?>"></iframe>
            <script>
               document.domain = "otpusk.by";
               var sizeFrame = "0px";

               //alert(document.domain );
               //alert("!");

               var refresh_iframe = function(){

               //jQuery('#frame_block').attr('height', '0px' );
               var x = document.getElementById("frame_block");
               var y = (x.contentWindow || x.contentDocument);

               if (y.document) y = y.document;

               //y.body.style.height= "0%";
               var size = y.body.scrollHeight+ 'px';//scrollHeight

               //alert(sizeFrame + " != " + size + " == " + y.body.scrollHeight);
               if (sizeFrame != size)
               {
               jQuery('#frame_block').attr('height', size );
               sizeFrame = size;
               }
               };

               /*jQuery(document).ready(function(){
               alert("!");
               setInterval(refresh_iframe, 50);
               });
               */

               //alert("!");
               setInterval(refresh_iframe, 50);
            </script>
         </div>
		<?endif;?>
	<?if(!empty($arResult['b_img'])):
		$scroll[] = array("section-4", "Фотогалерея");
	?>
		<div id="section-4" class="detail-content">

			<div class="section-title text-left">
				<h4>Фотогалерея</h4>
			</div>
			<?//print_r ($arResult["PROPERTIES"]["PICTURES"]);?>
			<div class="slick-gallery-slideshow">

				<div class="slider gallery-slideshow">
					<?foreach($arResult["PROPERTIES"]["PICTURES"]["VALUE"] as $item):
						$file_big=CFile::ResizeImageGet($item, Array('width'=>840, 'height'=>460),BX_RESIZE_IMAGE_EXACT,true);
						?>
						<div><div class="image" style="max-height:460px"><img style="max-height:460px" src="<?=$file_big["src"];?>" alt="<?= $arResult['NAME']?>" /></div>
							<div class="content"><div style="color:#fff; padding:0 10px; font-weight:bold"><?=$arResult["PROPERTIES"]["PICTURES"]["DESCRIPTION"][$i]?></div></div>
						</div>
			 		<? $i++;
					endforeach;?>

				</div>
				<div class="slider gallery-nav">
				<?foreach($arResult['sm_img'] as $sm):?>
					<div><div class="image"><img src="<?= $sm?>" alt="<?= $arResult['NAME']?>" /></div></div>
				<?endforeach?>	
				</div>

			</div>

		</div>
	<?endif?>
	<?if(!empty($arResult["PROPERTIES"]["HD_DESC"]['VALUE'])):
		$scroll[] = array("section-3", "Описание");
	?>
		<div id="section-3" class="detail-content">

			<div class="section-title text-left">
				<h4>Описание</h4>
			</div>
			<?=htmlspecialcharsBack($arResult["PROPERTIES"]["HD_DESC"]["~VALUE"]["TEXT"])?>
		</div>
	<?endif;?>
		<?if(!empty($arResult["SHARES"])):
            $scroll[] = array("section-55", "Акции");
            ?>
            <div class="section-title text-left">
                <h4>Акции</h4>
            </div>
            <div id="section-55" class="detail-content">
            <?foreach ($arResult["SHARES"] as $itemShare):?>
                <div class="section-title text-left">
					<a href="<?= $itemShare['LINK']?>" class="btn_blue_p5 btn_blue_p5_small" >Подробнее</a>
                    <h5><?=$itemShare["NAME"];?></h5>
                </div>
            <?endforeach;?>
            </div>
        <?endif;?>
	<?if($arResult['permit']):?>
	<div id="section-777" class="detail-content">
	<?$scroll[] = array("section-777", "Варианты пребывания");?>
         <div class="section-title text-left">
            <h4>Варианты пребывания</h4>
         </div>
         <div class="itinerary-wrapper">
            <div class="itinerary-item-wrapper">
               <div class="panel-group bootstarp-toggle">
                  <?$k = 0; foreach($arResult['permit'] as $id => $v):?>
                  <div class="panel itinerary-item">
                     <div class="panel-heading<?if($k == 0) echo ' active'?>">
                        <h5 class="panel-title">
                           <a data-toggle="collapse" <?if($k == 0):?>aria-expanded="true"<?endif?> data-parent="#" href="#bootstarp-toggle-<?= ($k + 1)?>"><span class="absolute-day-number"><?= ($k + 1)?></span> <?= $v['NAME']?></a>
                        </h5>
                     </div>
                     <div id="bootstarp-toggle-<?= ($k + 1)?>"  <?if($k == 0):?>aria-expanded="true"<?endif?> class="panel-collapse collapse<?if($k == 0):?> in<?endif?>">
                        <div class="panel-body">
                           <?= $v["DETAIL_TEXT"]?>
                        </div>
                     </div>
                  </div>
                  <!-- end of panel -->
                  <?$k++; endforeach?>
               </div>
            </div>
         </div>
    </div>
	<?endif?>
	<?if(!empty($arResult["PROPERTIES"]["VIDEO"]['VALUE'])):
		$scroll[] = array("section-5", "Видео");
	?>
		<div id="section5" class="detail-content">

			<div class="section-title text-left">
				<h4>Видео</h4>
			</div>
			<div class="video-block">
				<iframe width="560" height="315" src="https://www.youtube.com/embed/<?= $arResult["PROPERTIES"]["VIDEO"]['VALUE']?>" allowfullscreen=""></iframe>
			</div>
		</div>
	<?endif;?>
	<?if(!empty($arResult["PROPERTIES"]["HD_DESCROOM"]['VALUE'])):
		$scroll[] = array("section-7", "Номера");
	?>
		<div id="section-7" class="detail-content">

			<div class="section-title text-left">
				<h4>Номера</h4>
			</div>
			<?=$arResult["PROPERTIES"]["HD_DESCROOM"]["~VALUE"]["TEXT"]?>
		</div>
	<?endif;?>
	<?if(!empty($arResult["PROPERTIES"]["HD_DESCMEAL"]['VALUE'])):
		$scroll[] = array("section-8", "Питание");
	?>
		<div id="section-8" class="detail-content">

			<div class="section-title text-left">
				<h4>Питание</h4>
			</div>
			<?=htmlspecialcharsBack($arResult["PROPERTIES"]["HD_DESCMEAL"]["~VALUE"]["TEXT"])?>
		</div>
	<?endif;?>
	<?if(!empty($arResult["PROPERTIES"]["HD_DESCSERVICE"]['VALUE'])):
		$scroll[] = array("section-9", "Услуги");
	?>
		<div id="section-9" class="detail-content">

			<div class="section-title text-left">
				<h4>Услуги</h4>
			</div>
			<?=htmlspecialcharsBack($arResult["PROPERTIES"]["HD_DESCSERVICE"]["~VALUE"]["TEXT"])?>
		</div>
	<?endif;?>
	<?if(!empty($arResult["PROPERTIES"]["HD_DESCSPORT"]['VALUE'])):
		$scroll[] = array("section-10", "Спорт и отдых");
	?>
		<div id="section-10" class="detail-content">

			<div class="section-title text-left">
				<h4>Спорт и отдых</h4>
			</div>
			<?=htmlspecialcharsBack($arResult["PROPERTIES"]["HD_DESCSPORT"]["~VALUE"]["TEXT"])?>
		</div>
	<?endif;?>
	<?if(!empty($arResult["PROPERTIES"]["HD_DESCSHEALTH"]['VALUE'])):
		$scroll[] = array("section-11", "Оздоровление");
	?>
		<div id="section-11" class="detail-content">

			<div class="section-title text-left">
				<h4>Оздоровление</h4>
			</div>
			<?=htmlspecialcharsBack($arResult["PROPERTIES"]["HD_DESCSHEALTH"]["VALUE"]["TEXT"])?>
		</div>
	<?endif;?>
	<?if(!empty($arResult["PROPERTIES"]["HD_DESCCHILD"]['VALUE'])):
		$scroll[] = array("section-12", "Для детей");
	?>
		<div id="section-12" class="detail-content">

			<div class="section-title text-left">
				<h4>Для детей</h4>
			</div>
			<?=htmlspecialcharsBack($arResult["PROPERTIES"]["HD_DESCCHILD"]["~VALUE"]["TEXT"])?>
		</div>
	<?endif;?>
	<?if(!empty($arResult["PROPERTIES"]["HD_DESCBEACH"]['VALUE'])):
		$scroll[] = array("section-13", "Пляж");
	?>
		<div id="section-13" class="detail-content">

			<div class="section-title text-left">
				<h4>Пляж</h4>
			</div>
			<?=htmlspecialcharsBack($arResult["PROPERTIES"]["HD_DESCBEACH"]["VALUE"]["TEXT"])?>
		</div>
	<?endif;?>
	<?if(!empty($arResult["PROPERTIES"]["MEDICAL_TREATMENT"]['VALUE'])):
		$scroll[] = array("section-14", "Лечебная база");
	?>
		<div id="section-14" class="detail-content">

			<div class="section-title text-left">
				<h4>Лечебная база</h4>
			</div>
			<?=htmlspecialcharsBack($arResult["PROPERTIES"]["MEDICAL_TREATMENT"]["~VALUE"]["TEXT"])?>
		</div>
	<?endif;?>
	<?if(!empty($arResult["PROPERTIES"]["CONFERENCE_HALL"]['VALUE'])):
		$scroll[] = array("section-09", "Конференц-зал");
	?>
		<div id="section-09" class="detail-content">

			<div class="section-title text-left">
				<h4>Конференц-зал</h4>
			</div>
			<?= $arResult["PROPERTIES"]["CONFERENCE_HALL"]["VALUE"]["TEXT"]?>
		</div>
	<?endif;?>
	<?if(!empty($arResult["PROPERTIES"]["HD_ADDINFORMATION"]['VALUE'])):
		$scroll[] = array("section-15", "Дополнительная информация");
	?>
		<div id="section-15" class="detail-content">

			<div class="section-title text-left">
				<h4>Дополнительная информация</h4>
			</div>
			<?=htmlspecialcharsBack($arResult["PROPERTIES"]["HD_ADDINFORMATION"]["~VALUE"]["TEXT"])?>
		</div>
	<?endif;?>
	<?if(!empty($arResult['DETAIL_TEXT'])):
		$scroll[] = array("section-16", "Информация");
	?>
		<div id="section-16" class="detail-content">

			<div class="section-title text-left">
				<h4>Информация</h4>
			</div>
			<?= $arResult["DETAIL_TEXT"]?>
		</div>
	<?endif;?>
	<?if(!empty($arResult["PROPERTIES"]["FILE"]['VALUE'])):
		$scroll[] = array("section-17", "Файлы для скачивания");
	?>
		<div id="section-17" class="detail-content">

			<div class="section-title text-left">
				<h4>Файлы для скачивания</h4>
			</div>
			<?$arResult["DISPLAY_PROPERTIES"]["FILE"]["DISPLAY_VALUE"] = (array)$arResult["DISPLAY_PROPERTIES"]["FILE"]["DISPLAY_VALUE"];
			echo implode(" | ", $arResult["DISPLAY_PROPERTIES"]["FILE"]["DISPLAY_VALUE"]);?>
		</div>
	<?endif;?>
	<?if(!empty($arResult["PROPERTIES"]["HD_ADDRESS"]['VALUE'])):
		$scroll[] = array("section-18", "Адрес");
	?>
		<div id="section-18" class="detail-content">

			<div class="section-title text-left">
				<h4>Адрес</h4>
			</div>
			<?= $arResult["PROPERTIES"]["HD_ADDRESS"]['VALUE']?>
		</div>
		<?if(!empty($arResult["PROPERTIES"]["HD_ADDRESS_COUNTRY_LANGUAGE"]['VALUE'])):?>
			<div class="detail-content">
	
				<div class="section-title text-left">
					<h4>Адрес на языке страны пребывания</h4>
				</div>
				<?= $arResult["PROPERTIES"]["HD_ADDRESS_COUNTRY_LANGUAGE"]['VALUE']?>
			</div>
		<?endif;?>
	<?endif;?>
	<?if(!empty($arResult["PROPERTIES"]["PROEZD"]['VALUE'])):
		$scroll[] = array("section-30", "Проезд");
	?>
		<div id="section-30" class="detail-content">

			<div class="section-title text-left">
				<h4>Проезд</h4>
			</div>
			<?=htmlspecialcharsBack($arResult["PROPERTIES"]["PROEZD"]["~VALUE"]["TEXT"])?>
		</div>
	<?endif;?>
	<?if(!empty($arResult["PROPERTIES"]["PRICE_TEXT"]['VALUE'])):
		$scroll[] = array("section-38", "Цена");
	?>
		<div id="section-38" class="detail-content">

			<div class="section-title text-left">
				<h4>Цена</h4>
			</div>
			<?= $arResult["PROPERTIES"]["PRICE_TEXT"]["~VALUE"]["TEXT"]?>
		</div>
	<?endif;?>
	<?if(!empty($arResult["PROPERTIES"]["MAP"]['VALUE'])):
		$scroll[] = array("section-31", "Карта");
	?>
		<div id="section-31" class="detail-content" style="height: 400px">

			<div class="section-title text-left">
				<h4>Карта</h4>
			</div>
			<div class="map-route" style="width: 100%; height: 300px;" id="map-area"></div>
		</div>
	<?endif;?>

		<?/*div class="detail-content">

        <div class="section-title text-left">
            <h4>Внимание !</h4>
        </div>
        Самая актуальная и достоверная информация указана на официальном сайте отеля (если не указан сайт – обращайтесь за консультацией к менеджерам компании Центркурорт)
		</div*/?>
    <div class="detail-content">

        <div class="section-title text-left">
            <h4>Примечание</h4>
        </div>
        <?
        $APPLICATION->IncludeFile(str_replace("#ELEMENT_CODE#", "", $arParams["SEF_RULE"])."index_note.php", Array(), Array(
            "MODE"      => "html",        // будет редактировать в веб-редакторе
            "NAME"      => "Примечание",      // текст всплывающей подсказки на иконке
        ));
        ?>
    </div>

	<?if($arResult['hotels']):?>
		<div id="section-3" class="detail-content">

			<div class="section-title text-left">
				<h4>Туры</h4>
			</div>
			<?
			$scroll[] = array("section-3", "Размещение");
			?>
			<div class="hotel-item-wrapper">

				<div class="row gap-1">
				<?foreach($arResult['hotels'] as $h):?>
					<div class="col-sm-xss-12 col-xs-6 col-sm-4 col-md-4">

						<div class="hotel-item mb-1">
							<a href="<?= $h['PAGE']?>">
								<div class="image">
									<img src="<?= $h['PIC']?>" alt="<?= $h['NAME']?>" />
								</div>
								<div class="content">
									<h6><?= $h['NAME']?></h6>
								</div>
							</a>
						</div>

					</div>
				<?endforeach?>
				</div>

			</div>
		</div>
	<?endif?>

		<?if($arResult['offers']):?>
		<div class="detail-content">

			<div class="section-title text-left">
				<h4>Смотрите также</h4>
			</div>

			<div class="GridLex-gap-20-wrappper package-grid-item-wrapper on-page-result-page alt-smaller">

				<div class="GridLex-grid-noGutter-equalHeight">
				<?foreach($arResult['offers'] as $o):?>
					<div class="GridLex-col-4_sm-4_xs-12 mb-20">
						<div class="package-grid-item"> 
							<a href="<?= (($arParams['PLACEMENT_URL'] != "") ? str_replace(array('#SITE_DIR#', "#ELEMENT_CODE#"), array(SITE_DIR, $o['CODE']), $arParams['PLACEMENT_URL']) : $o['PAGE'])?>">
								<div class="image">
									<img src="<?= $o['PIC']?>" alt="<?= $o['NAME']?>" />
									<?/*if(!empty($o['DAYS'])):?>
										<div class="absolute-in-image">
											<div class="duration"><span><?= $o['DAYS']?> <?= $o['NIGHT']?></span></div>
										</div>
									<?endif */?>
								</div>
								<div class="content clearfix">
									<h6><?= $o['NAME']?></h6>
									<?if (!empty($o['COUNTRY'])):?>
										<div style="top:-12px; position:relative"><a href="<?= $o['COUNTRY_PAGE']?>"><?=$o["COUNTRY"]?></a><?if (!empty($o["TOWN"])):?><?echo ", <a href='". $o['TOWN_PAGE'] ."'>". $o["TOWN"] . "</a>"?><?endif;?> 
										</div>
									<?endif;?>
									<?if($o['TYPE']!=""):?>
										<div class="absolute-in-content">
											<div class="price"><?= $o['TYPE']?></div>
										</div>
									<?endif?>
								</div>
							</a>
						</div>
					</div>
				<?endforeach?>
				</div>

			</div>

		</div>
		<?endif?>

		<?if($arResult['excursions']):?>
		      <div id="section-20" class="detail-content">
		         <div class="section-title text-left">
		            <h4>Экскурсии</h4>
		         </div>
		         <?
		            $scroll[] = array("section-20", "Экскурсии");
		            ?>
		         <div class="hotel-item-wrapper">
		            <div class="row gap-1">
		               <?foreach($arResult['excursions'] as $h):?>
		               <div class="col-sm-xss-12 col-xs-6 col-sm-4 col-md-4">
		                  <div class="hotel-item mb-1">
		                     <a href="<?= $h['PAGE']?>">
		                        <div class="image">
		                           <img src="<?= $h['PIC']?>" alt="<?= $h['NAME']?>" />
		                        </div>
		                        <div class="content">
		                           <h6><?= $h['NAME']?></h6>
		                        </div>
		                     </a>
		                  </div>
		               </div>
		               <?endforeach?>
		            </div>
		         </div>
		      </div>
     	<?endif?>

		<?if($arResult['sights']):?>
	      <div id="section-10" class="detail-content">
	         <div class="section-title text-left">
	            <h4>Достопримечательности</h4>
	         </div>
	         <?
	            $scroll[] = array("section-10", "Достопримечательности");
	            ?>
	         <div class="hotel-item-wrapper">
	            <div class="row gap-1">
	               <?foreach($arResult['sights'] as $h):?>
	               <div class="col-sm-xss-12 col-xs-6 col-sm-4 col-md-4">
	                  <div class="hotel-item mb-1">
	                     <a href="<?= $h['PAGE']?>">
	                        <div class="image">
	                           <img src="<?= $h['PIC']?>" alt="<?= $h['NAME']?>" />
	                        </div>
	                        <div class="content">
	                           <h6><?= $h['NAME']?></h6>
	                        </div>
	                     </a>
	                  </div>
	               </div>
	               <?endforeach?>
	            </div>
	         </div>
	      </div>
      <?endif?>

		<?if(!empty($arResult['articles'])):?>
			
			<div class="detail-content">
				<div class="section-title text-left">
					<h4>Статьи</h4>
				</div>
				<?$str = array();
					foreach($arResult['articles'] as $a)
						$str[] = "<a href='" . $a['CODE'] . "/'>" .$a['NAME'] . "</a>";
					echo implode(", ", $str);?>
			</div>

		<?endif?>


	</div>
</div>
<?if(!empty($scroll)):?>
<div class="col-sm-3 hidden-sm hidden-xs">
						
	<div class="scrolly scrollspy-sidebar sidebar-detail" role="complementary">
	
		<ul class="scrollspy-sidenav">
		
			<li>
				<ul class="nav">
				<?foreach($scroll as $s):?>
					<li><a href="#<?= $s[0]?>" class="anchor"><?= $s[1]?></a></li>
				<?endforeach?>
				</ul>
			</li>

		</ul>
		<a href="#orderModal" data-toggle="modal" class="btn order-btn btn-primary" onclick="ga('send', 'event', 'button', 'click', 'OrderSanat'); yaCounter1028882.reachGoal('OrderSanat'); return true;">Оставить заявку</a>
		<div style="width: 100%; height: 100px;"></div>
	</div>

</div>
<?endif;
$marker_icon_small = SITE_TEMPLATE_PATH . "/images/map/marker24.png";?>
<script src="https://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">

    $(document).ready(function () {
        /* map point */
        function map_init() {

            if (!document.getElementById('map-area')) return;

            var map = new google.maps.Map(document.getElementById('map-area'), {
                center: {lat: <?=$arResult['point'][0][0]?>, lng: <?=$arResult['point'][0][1]?>},
                zoom: 17
            });

            var marker = new google.maps.Marker({
                title: '<?=$arResult['point'][1]?>',
                position: {lat: <?=$arResult['point'][0][0]?>, lng: <?=$arResult['point'][0][1]?>},
                map: map,
                icon: '<?= $marker_icon_small?>'
            });

            marker.addListener('click', function () {
                var infowindow = new google.maps.InfoWindow({
                    content: '<?=$arResult['point'][1]?>',
                });
                infowindow.open(map, this);
            });
        }

        map_init();

    });
</script>