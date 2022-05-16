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

		<div style="min-height: 300px;" id="section-0" class="detail-content">

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
					<?if(!empty($arResult["PROPERTIES"]["HD_HTTP"]['VALUE'])):?><li><span class="list-info-name-contact">Сайт:</span> <div class="list-info-contact"><a target="_blank" href="http://<?= $arResult["PROPERTIES"]["HD_HTTP"]['VALUE']?>" ><?= $arResult["PROPERTIES"]["HD_HTTP"]['VALUE']?></a></div></li><?endif;?>
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
			<div class="map-route" style="width: 250px; height: 200px;">
			
			<?$file_big=CFile::ResizeImageGet($arResult["PROPERTIES"]["PICTURES"]["VALUE"][0], Array('width'=>400, 'height'=>250),BX_RESIZE_IMAGE_EXACT,true);?>
			
			<img src="<?=$file_big["src"];?>" alt="<?= $arResult['NAME']?>" />
			</div>
		</div>
	 <?if($arResult["PROPERTIES"]["MT_KEY"]['VALUE'] > 0 && $arResult["MT_COUNTRY_KEY"] > 0 && $USER->isAdmin()):
         $scroll[] = array("section-12345", "Поиск тура");
         ?>    
         <div id="section-12345" class="detail-content ul-list">
            <div class="section-title text-left">
               <h4>Поиск тура</h4>
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

	<?if(!empty($arResult["PROPERTIES"]["PICTURES"]["VALUE"])):
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
	<?if(!empty($arResult["PROPERTIES"]["VIDEO"]['VALUE'])):
		$scroll[] = array("section-5", "Видео");
	?>
		<div id="section-5" class="detail-content">

			<div class="section-title text-left">
				<h4>Видео</h4>
			</div>
			<div class="video-block">
				<iframe width="560" height="315" src="https://www.youtube.com/embed/<?= $arResult["PROPERTIES"]["VIDEO"]['VALUE']?>" allowfullscreen=""></iframe>
			</div>
		</div>
	<?endif;?>
	<?if(!empty($arResult["PROPERTIES"]["HISTORY"]['VALUE'])):
		$scroll[] = array("section-6", "История");
	?>
		<div id="section-6" class="detail-content">

			<div class="section-title text-left">
				<h4>История</h4>
			</div>
			<?=htmlspecialcharsBack($arResult["PROPERTIES"]["HISTORY"]["~VALUE"]["TEXT"])?>
		</div>
	<?endif;?>
	<?if(!empty($arResult["PROPERTIES"]["NATURAL_FEATURES"]['VALUE'])):
		$scroll[] = array("section-7", "Природные особенности");
	?>
		<div id="section-7" class="detail-content">

			<div class="section-title text-left">
				<h4>Природные особенности</h4>
			</div>
			<?=htmlspecialcharsBack($arResult["PROPERTIES"]["NATURAL_FEATURES"]["~VALUE"]["TEXT"])?>
		</div>
	<?endif;?>
	<?if(!empty($arResult["PROPERTIES"]["HD_DESCROOM"]['VALUE'])):
		$scroll[] = array("section-8", "Номера");
	?>
		<div id="section-8" class="detail-content">

			<div class="section-title text-left">
				<h4>Номера</h4>
			</div>
			<?=$arResult["PROPERTIES"]["HD_DESCROOM"]["~VALUE"]["TEXT"]?>
		</div>
	<?endif;?>
	<?if(!empty($arResult["PROPERTIES"]["HD_DESCMEAL"]['VALUE'])):
		$scroll[] = array("section-9", "Питание");
	?>
		<div id="section-9" class="detail-content">

			<div class="section-title text-left">
				<h4>Питание</h4>
			</div>
			<?=htmlspecialcharsBack($arResult["PROPERTIES"]["HD_DESCMEAL"]["~VALUE"]["TEXT"])?>
		</div>
	<?endif;?>
	<?if(!empty($arResult["PROPERTIES"]["HD_DESCSERVICE"]['VALUE'])):
		$scroll[] = array("section-10", "Услуги");
	?>
		<div id="section-10" class="detail-content">

			<div class="section-title text-left">
				<h4>Услуги</h4>
			</div>
			<?=htmlspecialcharsBack($arResult["PROPERTIES"]["HD_DESCSERVICE"]["~VALUE"]["TEXT"])?>
		</div>
	<?endif;?>
	<?if(!empty($arResult["PROPERTIES"]["HD_DESCSPORT"]['VALUE'])):
		$scroll[] = array("section-11", "Спорт и отдых");
	?>
		<div id="section-11" class="detail-content">

			<div class="section-title text-left">
				<h4>Спорт и отдых</h4>
			</div>
			<?=htmlspecialcharsBack($arResult["PROPERTIES"]["HD_DESCSPORT"]["~VALUE"]["TEXT"])?>
		</div>
	<?endif;?>
	<?if(!empty($arResult["PROPERTIES"]["HD_DESCSHEALTH"]['VALUE'])):
		$scroll[] = array("section-12", "Оздоровление");
	?>
		<div id="section-12" class="detail-content">

			<div class="section-title text-left">
				<h4>Оздоровление</h4>
			</div>
			<?=htmlspecialcharsBack($arResult["PROPERTIES"]["HD_DESCSHEALTH"]["VALUE"]["TEXT"])?>
		</div>
	<?endif;?>
	<?if(!empty($arResult["PROPERTIES"]["HD_DESCCHILD"]['VALUE'])):
		$scroll[] = array("section-13", "Для детей");
	?>
		<div id="section-13" class="detail-content">

			<div class="section-title text-left">
				<h4>Для детей</h4>
			</div>
			<?=htmlspecialcharsBack($arResult["PROPERTIES"]["HD_DESCCHILD"]["~VALUE"]["TEXT"])?>
		</div>
	<?endif;?>
	<?if(!empty($arResult["PROPERTIES"]["HD_DESCBEACH"]['VALUE'])):
		$scroll[] = array("section-14", "Пляж");
	?>
		<div id="section-14" class="detail-content">

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
	<?if(!empty($arResult["PROPERTIES"]["FILE"]['VALUE'])):
		$scroll[] = array("section-17", "Файлы для скачивания");
	?>
		<div id="section-17" class="detail-content">

			<div class="section-title text-left">
				<h4>Файлы для скачивания</h4>
			</div>
			<?=implode(" | ", $arResult["DISPLAY_PROPERTIES"]["FILE"]["DISPLAY_VALUE"]);?>
		</div>
	<?endif;?>
	<?if(!empty($arResult["PROPERTIES"]["HD_ADDRESS"]['VALUE'])):
		$scroll[] = array("section-18", "Адрес");
	?>
		<div id="section-18" class="detail-content">

			<div class="section-title text-left">
				<h4>Адрес</h4>
			</div>
			<?= $arResult["PROPERTIES"]["HD_ADDRESS"]['VALUE']["TEXT"]?>
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
									<?if(!empty($o['DAYS'])):?>
										<div class="absolute-in-image">
											<div class="duration"><span><?= $o['DAYS']?> <?= $o['NIGHT']?></span></div>
										</div>
									<?endif?>
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
<p><a href="<?=$arParams["FOLDER"].$arParams["UT"]?>">Возврат к списку</a></p>
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
		<a href="#orderModal" data-toggle="modal" class="btn order-btn btn-primary">Оставить заявку</a>
		<div style="width: 100%; height: 100px;"></div>
	</div>

</div>
<?endif;
$marker_icon_small = SITE_TEMPLATE_PATH . "/images/map/marker24.png";?>
<?if ($arResult['PROPERTIES']['MAP']['VALUE'] != ""):?>
<script src="//maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
	
$(document).ready(function(){
		/* map point */
		<?
			$latlng = explode(',', $arResult['PROPERTIES']['MAP']['VALUE']);
		?>
		function map_init() {

			if(!document.getElementById('map-area')) return;

			var map = new google.maps.Map(document.getElementById('map-area'),{
				center: {lat: <?=$latlng[0]?>, lng: <?= $latlng[1]?>},
				zoom: 8
			});

			var marker = new google.maps.Marker({
							title: '<?=$arResult['NAME']?>',
							position: {lat: <?=$latlng[0]?>, lng: <?=$latlng[1]?>},
							map: map,
							icon: '<?= $marker_icon_small?>'
						});
			
			marker.addListener('click', function() {
							var infowindow = new google.maps.InfoWindow({
										    content: '<?=$arResult['NAME']?>',
										  });
						    infowindow.open(map, this);
						  });
		}

		map_init();

});
</script>
<?endif?>