<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$scroll = array();
$i=0;
?>
<?
$title = $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] != "" ? $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] : $arResult['NAME'];
?>
<div class="col-md-9" role="main">

	<div class="detail-content-wrapper">

		<div style="min-height: 350px" id="section-0" class="detail-content">

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
					<?if(!empty($arResult["PROPERTIES"]["ADDRESS"]['VALUE'])):?><li><span class="list-info-name-contact">Адрес:</span> <div class="list-info-contact"><?= $arResult["PROPERTIES"]["ADDRESS"]['VALUE']?></div></li><?endif;?>
					<?if(!empty($arResult["PROPERTIES"]["PHONE"]['VALUE'])):?><li><span class="list-info-name-contact">Телефоны:</span> 
						<div class="list-info-contact"><?if (is_array($arResult["PROPERTIES"]["PHONE"]["VALUE"])):?>
							<?=implode("<br> ", $arResult["PROPERTIES"]["PHONE"]["VALUE"]);?>
						<?else:?>
							<?print_r (strip_tags($arResult["DISPLAY_PROPERTIES"]["PHONE"]["DISPLAY_VALUE"]));?>
							<?endif;?></div></li>
					<?endif;?>
					<?if(!empty($arResult["PROPERTIES"]["EMAIL"]['VALUE'])):?><li><span class="list-info-name-contact">E-mail:</span> <?= $arResult["PROPERTIES"]["EMAIL"]['VALUE']?></li><?endif;?>				</ul>
			</div>
			<div class="map-route" style="width: 400px; height: 300px;">
			<?$file_big=CFile::ResizeImageGet($arResult["PROPERTIES"]["PICTURES"]["VALUE"][0], Array('width'=>400, 'height'=>250),BX_RESIZE_IMAGE_PROPORTIONAL,true);?>
			<img src="<?=$file_big["src"];?>" alt="<?= $arResult['NAME']?>" />
			</div>
		</div>
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
	<?if(!empty($arResult["PROPERTIES"]["HD_ADDINFORMATION"]['VALUE'])):
		$scroll[] = array("section-8", "Информация");
	?>
		<div id="section-7" class="detail-content">

			<div class="section-title text-left">
				<h4>Информация</h4>
			</div>
			<?= $arResult["DETAIL_TEXT"]?>
		</div>
	<?endif;?>
	<?if(!empty($arResult["PROPERTIES"]["HD_ADDRESS"]['VALUE'])):
		$scroll[] = array("section-9", "Адрес");
	?>
		<div id="section-8" class="detail-content">

			<div class="section-title text-left">
				<h4>Адрес</h4>
			</div>
			<?= $arResult["PROPERTIES"]["HD_ADDRESS"]['VALUE']?>
		</div>
	<?endif;?>
	<?if(!empty($arResult["PROPERTIES"]["PROEZD"]['VALUE'])):
		$scroll[] = array("section-10", "Проезд");
	?>
		<div id="section-9" class="detail-content">

			<div class="section-title text-left">
				<h4>Проезд</h4>
			</div>
			<?=htmlspecialcharsBack($arResult["PROPERTIES"]["PROEZD"]["~VALUE"]["TEXT"])?>
		</div>
	<?endif;?>
	<?if(!empty($arResult["PROPERTIES"]["MAP"]['VALUE'])):
		$scroll[] = array("section-20", "Карта");
	?>
		<div id="section-20" class="detail-content" style="height: 400px">

			<div class="section-title text-left">
				<h4>Карта</h4>
			</div>
			<div class="map-route" style="width: 100%; height: 300px;" id="map-area"></div>
		</div>
	<?endif;?>
		<?if($arResult['employers']):
			$scroll[] = array("section-30", "Сотрудники");?>
		<div id="section-30"  class="detail-content">

			<div class="section-title text-left">
				<h4>Сотрудники</h4>
			</div>

			<div class="GridLex-gap-20-wrappper package-grid-item-wrapper on-page-result-page alt-smaller">

				<div class="GridLex-grid-noGutter-equalHeight">
				<?foreach($arResult['employers'] as $o):?>
					<div class="GridLex-col-4_sm-4_xs-12 mb-20">
						<div class="package-grid-item"> 
							<a href="<?= $o['PAGE']?>">
								<div class="image" style="height: 264px;overflow: hidden;">
									<img src="<?= $o['PIC']?>" alt="<?= $o['NAME']?>" />
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

		<?if($arResult['offers']):?>
		<div class="detail-content">

			<div class="section-title text-left">
				<h4>Другие офисы</h4>
			</div>

			<div class="GridLex-gap-20-wrappper package-grid-item-wrapper on-page-result-page alt-smaller">

				<div class="GridLex-grid-noGutter-equalHeight">
				<?foreach($arResult['offers'] as $o):?>
					<div class="GridLex-col-4_sm-4_xs-12 mb-20">
						<div class="package-grid-item"> 
							<a href="<?= $o['PAGE']?>">
								<div class="image">
									<img src="<?= $o['PIC']?>" alt="<?= $o['NAME']?>" />
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
	</div>

</div>
<?endif?>
<script src="https://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">


$(document).ready(function(){
<?if(!empty($arResult["PROPERTIES"]["MAP"]['VALUE'])):
$point = explode(',',$arResult["PROPERTIES"]["MAP"]['VALUE']);
$marker_icon_small = SITE_TEMPLATE_PATH . "/images/map/marker24.png";
?>
		/* map point */
		function map_init() {

			if(!document.getElementById('map-area')) return;

			var map = new google.maps.Map(document.getElementById('map-area'),{
				center: {lat: <?= $point[0]?>, lng: <?= $point[1]?>},
				zoom: 15
			});

			var marker = new google.maps.Marker({
							title: '<?=$arResult["NAME"]?>',
							position: {lat: <?= $point[0]?>, lng: <?= $point[1]?>},
							map: map,
							icon: '<?= $marker_icon_small?>'
						});
			
			marker.addListener('click', function() {
							var infowindow = new google.maps.InfoWindow({
										    content: '<?=$arResult["NAME"]?>',
										  });
						    infowindow.open(map, this);
						  });
		}

		map_init();
<?endif?>
});
</script>

