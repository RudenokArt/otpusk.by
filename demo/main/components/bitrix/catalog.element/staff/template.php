<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$scroll = array();
$i=0;
?>
<?
$h1 = $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] != "" ? $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] : $arResult['NAME'];
?>
<div class="col-md-9" role="main">

	<div class="detail-content-wrapper">

	<div style="min-height: 350px" id="section-0" class="detail-content">
		<div class="row">
			<div class="section-title text-left">
				<h1><?=$h1?> <?$scroll[] = array("section-0", $arResult["NAME"])?> <?= $arResult["PROPERTIES"]["CAT_ID"]['VALUE']?></h1>
			</div>
			<div class="col-sm-6 mb-30">
				<ul class="list-info no-icon bb-dotted padd-20">
					<?if(!empty($arResult["PROPERTIES"]["POSITION"]['VALUE'])):?><li><span class="list-info-name-contact">Должность: </span><div class="list-info-contact"><?= $arResult["PROPERTIES"]["POSITION"]['VALUE']?></div></li><?endif;?>
					<?if(!empty($arResult["PROPERTIES"]["OFFICE"]['VALUE'])):?><li><span class="list-info-name-contact">Офис: </span> <div class="list-info-contact"><?= $arResult["DISPLAY_PROPERTIES"]["OFFICE"]['DISPLAY_VALUE']?></div></li><?endif;?>
					<?if(!empty($arResult["PROPERTIES"]["COUNTRY"]['VALUE'])):?><li><span class="list-info-name-contact">Направления:</span> <div class="list-info-contact"><?= $arResult["PROPERTIES"]["COUNTRY"]['VALUE']?></div></li><?endif;?>
					<?if(!empty($arResult["PROPERTIES"]["PHONE"]['VALUE'])):?><li><span class="list-info-name-contact">Телефоны:</span> 
						<div class="list-info-contact"><?if (is_array($arResult["PROPERTIES"]["PHONE"]["VALUE"])):?>
							<?=implode("<br> ", $arResult["PROPERTIES"]["PHONE"]["VALUE"]);?>
						<?else:?>
							<?print_r (strip_tags($arResult["DISPLAY_PROPERTIES"]["PHONE"]["DISPLAY_VALUE"]));?>
							<?endif;?></div></li>
					<?endif;?>
					<?if(!empty($arResult["PROPERTIES"]["EMAIL"]['VALUE'])):?><li><span class="list-info-name-contact">E-mail:</span> <?= $arResult["PROPERTIES"]["EMAIL"]['VALUE']?></li><?endif;?>
					<?if(!empty($arResult["PROPERTIES"]["SKYPE"]['VALUE'])):?><li><span class="list-info-name-contact">Skype:</span> <div class="list-info-contact"><?= $arResult["PROPERTIES"]["SKYPE"]['VALUE']?></div></li><?endif;?>
					<?if(!empty($arResult["PROPERTIES"]["ICQ"]['VALUE'])):?><li><span class="list-info-name-contact">ICQ:</span> <div class="list-info-contact"><?= $arResult["PROPERTIES"]["ICQ"]['VALUE']?></div></li><?endif;?>
					<?if(!empty($arResult["PROPERTIES"]["ICQ"]['VALUE'])):?><li><span class="list-info-name-contact">ICQ:</span> <div class="list-info-contact"><?= $arResult["PROPERTIES"]["ICQ"]['VALUE']?></div></li><?endif;?>
				</ul>
			</div>
			<div class="map-route" style="width: 400px; height: 400px; overflow: hidden;">
			<?$file_big=CFile::ResizeImageGet($arResult["PROPERTIES"]["PICTURES"]["VALUE"][0], Array('width'=>400, 'height'=>400),BX_RESIZE_IMAGE_PROPORTIONAL,true);?>
			<img src="<?=$file_big["src"];?>" alt="<?= $arResult['NAME']?>" />
			</div>
		</div>
	</div>
	<?if(!empty($arResult["PROPERTIES"]["VIDEO"]['VALUE'])):
		$scroll[] = array("section-5", "Видео");
	?>
		<div id="section-5" class="detail-content">

			<div class="section-title text-left">
				<h4>Видео</h4>
			</div>
			<iframe width="560" height="315" src="https://www.youtube.com/embed/<?= $arResult["PROPERTIES"]["VIDEO"]['VALUE']?>" allowfullscreen=""></iframe>
		</div>
	<?endif;?>
	<? if(!empty($arResult["PROPERTIES"]["DEPARTMENT"]['VALUE'])):
         $scroll[] = array("section-6", "Отделы и подразделения");
         			$nd = $arResult["DISPLAY_PROPERTIES"]['DEPARTMENT']["VALUE"];
         			$nd_d = $arResult["DISPLAY_PROPERTIES"]['DEPARTMENT']["DESCRIPTION"];
         			if(!empty($nd)):?>
		<div id="section-6" class="detail-content">
			<div class="section-title text-left">
				<h4>Отделы и подразделения</h4>
			</div>
			<?foreach($nd as $k => $v):?>
				<h5><?= $nd_d[$k]?></h5>
				<p><?= $v["TEXT"]?></p>
			<?endforeach?>
		</div>
	<? endif; endif; ?>

	<?if(!empty($arResult["PROPERTIES"]["HD_ADDINFORMATION"]['VALUE'])):
		$scroll[] = array("section-7", "Дополнительная информация");
	?>
		<div id="section-6" class="detail-content">

			<div class="section-title text-left">
				<h4>Дополнительная информация</h4>
			</div>
			<?=htmlspecialcharsBack($arResult["PROPERTIES"]["HD_ADDINFORMATION"]["~VALUE"]["TEXT"])?>
		</div>
	<?endif;?>

		<?if($arResult['offers']):?>
		<div class="detail-content">

			<div class="section-title text-left">
				<h4>Другие сотрудники</h4>
			</div>

			<div class="GridLex-gap-20-wrappper package-grid-item-wrapper on-page-result-page alt-smaller">

				<div class="GridLex-grid-noGutter-equalHeight">
				<?foreach($arResult['offers'] as $o):?>
					<div class="GridLex-col-4_sm-4_xs-12 mb-20">
						<div class="package-grid-item"> 
							<a href="<?= $o['PAGE']?>">
								<div class="image">
									<img src="<?= $o['PIC']?>" alt="<?= $o['NAME']?>" />
									<?/*if(!empty($o['DAYS'])):?>
										<div class="absolute-in-image">
											<div class="duration"><span><?= $o['DAYS']?> <?= $o['NIGHT']?></span></div>
										</div>
									<?endif*/?>
								</div>
								<div class="content clearfix">
                                    <div class="block-name-city">
                                        <h6><?= $o['NAME']?></h6>
                                        <?if (!empty($o['TOWN'])):?>
                                            <span><?=$o['TOWN']?></span>
                                        <?endif?>
                                    </div>
                                    <?if (!empty($o['COUNTRY'])):?>
                                        <div style="top:-12px; position:relative"><a href="<?= $o['COUNTRY_PAGE']?>"><?=$o["COUNTRY"]?></a><?if (!empty($o["TOWN"])):?><?echo ", <a href='". $o['TOWN_PAGE'] ."'>". $o["TOWN"] . "</a>"?><?endif;?>
                                        </div>
                                    <?endif;?>
                                    <?if (!empty($o['POSITION'])):?>
                                        <span><?=$o["POSITION"]?></span>
                                    <?endif?>
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
		<a href="#orderModal" data-toggle="modal" class="btn order-btn btn-primary">Заявка на подбор тура</a>
		<div style="width: 100%; height: 100px;"></div>
	</div>

</div>
<?endif?>
<script src="https://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
	
$(document).ready(function(){
	<?if($arResult['transfer']):?>
		/* map transfer */

		function map_init()
		{
			if(!document.getElementById('map-area')) return;
			var map = new google.maps.Map(document.getElementById('map-area')),
				direction_display = new google.maps.DirectionsRenderer(),
				direction_service = new google.maps.DirectionsService(),
				start = new google.maps.LatLng(<?=$arResult['transfer']['start'][0]?>, <?=$arResult['transfer']['start'][1]?>),
				end = new google.maps.LatLng(<?=$arResult['transfer']['end'][0]?>, <?=$arResult['transfer']['end'][1]?>),
				way = [],
				marker;

				direction_display.setMap(map);
				direction_display.setOptions( { suppressMarkers: true, suppressInfoWindows: true } );

				<?if($arResult['transfer']['way']):?>
					<?foreach($arResult['transfer']['way'] as $k => $way):?>
						way.push({location: new google.maps.LatLng(<?=$way[0]?>, <?=$way[1]?>)});
						marker = new google.maps.Marker({
								title: '<?=$way[2]?>',
								position: new google.maps.LatLng(<?=$way[0]?>, <?=$way[1]?>),
								map: map
							});
						
						 
						 marker.addListener('click', function() {
						 	var infowindow = new google.maps.InfoWindow({
									    content: '<?=$way[2]?>'
									  });
						    infowindow.open(map, this);
						  });
					
					<?endforeach?>
				<?endif?>

					marker = new google.maps.Marker({
						title: '<?=$arResult['transfer']['start'][2]?>',
						position: start,
						map: map
					});

					
					marker.addListener('click', function() {
						var infowindow = new google.maps.InfoWindow({
									    content: '<?=$arResult['transfer']['start'][2]?>'
									  });
					    infowindow.open(map, this);
					  });

					marker = new google.maps.Marker({
						title: '<?=$arResult['transfer']['end'][2]?>',
						position: end,
						map: map
					});

					
					marker.addListener('click', function() {
						var infowindow = new google.maps.InfoWindow({
									    content: '<?=$arResult['transfer']['end'][2]?>'
									  });
					    infowindow.open(map, this);
					  });

				direction_service.route(
					{
						origin: start,
						waypoints: way,
						destination: end,
						travelMode: google.maps.TravelMode.DRIVING,
						unitSystem: google.maps.UnitSystem.METRIC,
						provideRouteAlternatives: true,
						avoidHighways: false,
						avoidTolls: true
					}, 
					function(result, status) 
					{
						if (status == google.maps.DirectionsStatus.OK) 
						{
							direction_display.setDirections(result);
						}
					}
				);
		}

		google.maps.event.addDomListener(window, 'load', map_init);

	<?else:?>
		/* map point */
		function map_init() {

			if(!document.getElementById('map-area')) return;

			var map = new google.maps.Map(document.getElementById('map-area'),{
				center: {lat: <?=$arResult['point'][0][0]?>, lng: <?=$arResult['point'][0][1]?>},
				zoom: 15
			});

			var marker = new google.maps.Marker({
							title: '<?=$arResult['point'][1]?>',
							position: {lat: <?=$arResult['point'][0][0]?>, lng: <?=$arResult['point'][0][1]?>},
							map: map
						});
			
			marker.addListener('click', function() {
							var infowindow = new google.maps.InfoWindow({
										    content: '<?=$arResult['point'][1]?>',
										  });
						    infowindow.open(map, this);
						  });
		}

		map_init();
	<?endif?>
});
</script>

