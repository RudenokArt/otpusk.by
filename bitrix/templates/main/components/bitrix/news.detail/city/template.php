<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$scroll = array();
?>
<?
$h1 = $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] != "" ? $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] : $arResult['NAME'];

$flag = false;
foreach ($arResult['filter'] as $key => $item) {
    if (isset($arResult['filter'][$key][$arResult['PROPERTIES']['COUNTRY']["VALUE"]])){
        $flag = true;
        $cityId = $key;
        break;
    }
}
?>
<div class="col-md-9" role="main">

	<div class="detail-content-wrapper">
		<h1 id="section-0"  style="margin-bottom: 30px"><?= $h1; $scroll[] = array("section-0", $arResult["NAME"])?></h1>
				</div>

<?if($flag && $cityId != "" && !empty($arResult['PROPERTIES']['COUNTRY']["VALUE"])):?>
    <?$res = CIBlockElement::GetList(Array(), Array("IBLOCK_ID"=>$arResult['PROPERTIES']['COUNTRY']["LINK_IBLOCK_ID"], "ACTIVE"=>"Y","ID"=>$arResult['PROPERTIES']['COUNTRY']["VALUE"]), false, false, Array("PROPERTY_KEY_SLETAT", "PROPERTY_CN_KEY"));
    $value = array();
    while($ar = $res->GetNext()) {
        $value[$arResult['PROPERTIES']['COUNTRY']["VALUE"]] = array(
            "KEY_SLETAT" => $ar["PROPERTY_KEY_SLETAT_VALUE"],
            "CN_KEY" => $ar["PROPERTY_CN_KEY_VALUE"]
        );
    }
    ?>
    <?if(!empty($value[$arResult['PROPERTIES']['COUNTRY']["VALUE"]]) && ($value[$arResult['PROPERTIES']['COUNTRY']["VALUE"]]['KEY_SLETAT'] > 0 || $value[$arResult['PROPERTIES']['COUNTRY']["VALUE"]]['CN_KEY'] > 0)):?>
        <div class="section-title text-left">
            <h4>Форма поиска тура</h4>
        </div>
<?//форма поиск для мастертур и слетать
    $APPLICATION->IncludeComponent(
        "travelsoft:mastertour.search.form",
        "search-form-county",
        array(
            "COMPONENT_TEMPLATE" => "search-form",
            "CITY_FROM" => (int)$cityId,
            "COUNTRY_FROM" => (int)$arResult['PROPERTIES']['COUNTRY']["VALUE"],
            "DATE_FROM" => "",
            "DATE_TO" => "",
            "NIGHT_FROM" => "7",
            "NIGHT_TO" => "14",
            "ACTION_URL" => "/tury/avia-tury/"
        ),
        false
    );
/////////////////////////// форма поиска для туриндекса ///////////////////////////////////    
/*$APPLICATION->IncludeComponent(
"travelsoft:tour.index.search.form", 
"inner-search-form", 
array(
"COMPONENT_TEMPLATE" => "search-form",
"CITY_FROM" => "1863",
"COUNTRY_FROM" => $arResult['PROPERTIES']['TI_COKEY']['VALUE'],
"DATE_FROM" => "",
"DATE_TO" => "",
"NIGHT_FROM" => "7",
"NIGHT_TO" => "14",
"ACTION_URL" => "/tury/avia-tury/"
),
false
);*/
///////////////////////////////////////////////////////////////////////////////////////////
?>
<?endif?>
<?endif?>

<?if(!empty($arResult['offers'])):?>
		<?
		$scroll[] = array("section-5", "Специальные предложения");
		?>
		<div id="section-5" class="detail-content">

			<div class="section-title text-left">
				<?if($arResult['all_offers']):?>
					<a rel="nofollow" href="<?= $arResult['all_offers']?>" class="btn_blue_p5 btn_blue_p5_small" >специальные предложения для <?=$arResult["PROPERTIES"]["CN_NAME_chego"]["VALUE"]?></a>
				<?endif?>
				<h4>Специальные предложения <?=$arResult["PROPERTIES"]["CN_NAME_kuda"]["VALUE"]?> </h4>
			</div>


			<div class="ajax-preloader package-list-item-wrapper on-page-result-page">

			<?foreach($arResult['offers'] as $i):?>
         
            <div class="package-list-item clearfix">
               <div class="image">
                  <?if($i["PIC"]):?>
                     <a href="<?= $i['PAGE']?>"><img src="<?= $i["PIC"]?>" alt="<?= $i["NAME"]?>" /></a>
                  <?else:?>
                     <a href="<?= $i['PAGE']?>"><img src="<?= Set::NO_PHOTO?>" alt="<?= $i["NAME"]?>" /></a>
                  <?endif?>
                  <?= printTourLabel($i['FOR_LABELS'])?>
                  <?if($i['DAYS']):?>
                     <div class="absolute-in-image">
                        <div class="duration"><span><?= $i['DAYS']?> <?= $i['NIGHT']?></span></div>
                     </div>
                  <?endif?>
               </div>
               <div class="content">
                  <h5><a style="color: black" href="<?= $i['PAGE']?>"><?= $i["NAME"]?></a></h5>
                  <div class="row gap-10">
                     <div class="col-sm-12 col-md-9">
                        
                        <p style="font-size: 14px;margin: 0 0 5px 0"><?= strip_tags($i["TOURTYPE"]);?><?if($i['TYPE_EXCURSIONS'] != "") echo " " . $i['TYPE_EXCURSIONS']?></p>

                        <ul class="list-info">
                           <?
                           if(!empty($i["TOWN"])):?>
                              <li>
                                 <span class="icon"><i class="fa fa-map-marker"></i></span> <span class="font600">
                                 <?= $i['TOWN']?>
                                 </span>
                              </li>
                           <?endif?>
                           <?if($i['PDEP']):?>
                               <li><span class="icon"><i class="fa fa-flag"></i></span> <span class="font600">из <?= $i['PDEP']?> 
                               <?if(!empty($i["DEP_TIME"]))
                                    echo implode(", ",array_map(function($it){ return ConvertDateTime($it, "DD.MM"); }, dateFilter($i["DEP_TIME"])));
                                    elseif($i['DEP_TEXT'] != '') echo $i['DEP_TEXT'];
                                 ?></span></li>
                           <?elseif($i['DEP_TEXT'] != ''):?>
                               <li><span class="icon"><i class="fa fa-flag"></i></span> <span class="font600"><?= $i['DEP_TEXT']?></span></li>
                           <?endif?>
                           <?
                           $i["HOTEL"] = (array)$i["HOTEL"];
                           if(!empty($i["HOTEL"])):?>
                              <li><span class="icon"><i class="fa fa-flag"></i></span>Проживание<span class="font600"> <?= implode(", ", $i['HOTEL'])?></span></li>
                           <?endif?>
                           <?
                           $i["FOOD"] = (array)$i["FOOD"];
                           if(!empty($i["FOOD"])):?>
                           <li><span class="icon"><i class="fa fa-flag"></i></span> Питание<span class="font600"> <?= implode(", ",array_map(function($it){ return strip_tags($it); }, $i["FOOD"]))?></span></li>
                           <?endif?>
                        </ul>
                        
                     </div>
                     <div class="col-sm-12 col-md-3 text-right text-left-sm">
                     <center>
                        <?if($i["PRICE"] != ""):?>
                        <div class="price" style="line-height:16px; border:1px solid"><span>от</span><br>
                           <?= $i["PRICE"]?><br>
                           <span style="color: #EB5019; font-weight:normal; font-size:12px;"> <?= denomination($i["PROPERTY_PRICE_VALUE"], $i["PROPERTY_CURRENCY_VALUE"]);?></span>
                           <?if($i["PROPERTY_CURRENCY_VALUE"] != 62):?>
                            <br>
                           <span style="color: #EB5019; font-weight:normal; font-size:12px;"> <?= $i["PROPERTY_PRICE_VALUE"] .' '. $i["PROPERTY_CURRENCY_NAME"]?></span>
                           <?endif?><br>
                           <span><?= $i['PRICE_FOR']?></span>
                        </div>
                        <?endif?>
                        <a href="<?= $i["PAGE"]?>" class="btn btn-primary btn-sm">Подробнее</a>
                     </center>
                     </div>
                  </div>
               </div>
               
            </div>
         <?endforeach?>
			</div>
		</div>
		<?endif?>

<div class="text-left">
			<?if(!empty($arResult["DETAIL_TEXT"])):?>		
				<div class="detail-content">

					
					

						<?$file_big=CFile::ResizeImageGet($arResult["PROPERTIES"]["PICTURES"]["VALUE"][0], Array('width'=>400, 'height'=>250),BX_RESIZE_IMAGE_PROPORTIONAL,true);?>
						<?if($file_big['src'] != ''):?>
							<div class="map-route" style="width: 400px; height: 300px;">
	
							<img src="<?=$file_big["src"];?>" alt="<?= $arResult['NAME']?>" />
							</div>
						<?endif?>
						 <?echo $arResult['DETAIL_TEXT'];?>
					
					
				</div>
			<?endif?>

		<?if($arResult['hotels']):?>
			<div id="section-3" class="detail-content">

				<div class="section-title text-left">
					<?if($arResult['all_hotels']):?>
						<a rel="nofollow" href="<?= $arResult['all_hotels']?>" class="btn_blue_p5 btn_blue_p5_small" >Все отели <?=$arResult["PROPERTIES"]["CN_NAME_chego"]["VALUE"]?></a>
					<?endif?>
					<h4>Размещение</h4>
				</div>
				<?
				$scroll[] = array("section-3", "Размещение");
				?>
				<div class="hotel-item-wrapper">

					<div class="row gap-1">
					<?foreach($arResult['hotels'] as $h):?>
						<div class="col-sm-xss-12 col-xs-6 col-sm-4 col-md-4">

							<div class="hotel-item mb-1">
							<?if($h['TYPE'] == 'Cанаторий')
								$h['PAGE'] = str_replace("/oteli/", "/sanatorii/", $h['PAGE']);?>
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

		<?if($arResult['sanatorii']):?>
			<div id="section-3" class="detail-content">

				<div class="section-title text-left">
					<?if($arResult['all_sanatorii']):?>
						<a rel="nofollow" href="<?= $arResult['all_sanatorii']?>" class="btn_blue_p5 btn_blue_p5_small" >Все санатории <?=$arResult["PROPERTIES"]["CN_NAME_chego"]["VALUE"]?></a>
					<?endif?>
					<h4>Санатории</h4>
				</div>
				<?
				$scroll[] = array("section-3", "Санатории");
				?>
				<div class="hotel-item-wrapper">

					<div class="row gap-1">
					<?foreach($arResult['sanatorii'] as $h):?>
						<div class="col-sm-xss-12 col-xs-6 col-sm-4 col-md-4">
							<div class="hotel-item mb-1">
							<?$h['PAGE'] = str_replace("/oteli/", "/sanatorii/", $h['PAGE']);?>
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



		<?if(!empty($arResult["PROPERTIES"]["VIDEO"]["VALUE"])):
			$scroll[] = array("section-2", "Видео");
		?>
		<div id="section-4" class="detail-content">

				<div class="section-title text-left">
					<h4>Видео</h4>
				</div>
				<p>
					 <iframe src="//www.youtube.com/embed/<?=$arResult["PROPERTIES"]["VIDEO"]["VALUE"]?>" width="100%" height="600" style="display: block; margin-left: auto; margin-right: auto;" frameborder="0"></iframe>
				</p>
		</div>
		<?endif?>
		<?if(!empty($arResult['b_img'])):
			$scroll[] = array("section-4", "Фотогалерея");
		?>
			<div id="section-4" class="detail-content">

				<div class="section-title text-left">
					<h4>Фотогалерея</h4>
				</div>

				<div class="slick-gallery-slideshow">

					<div class="slider gallery-slideshow">
						 <?foreach($arResult["PROPERTIES"]["PICTURES"]["VALUE"] as $item):
							$file_big=CFile::ResizeImageGet($item, Array('width'=>840, 'height'=>460),BX_RESIZE_IMAGE_EXACT,true);
							?>
							<div><div class="image"><img src="<?=$file_big["src"];?>" alt="<?= $arResult['NAME']?>" /></div></div>
				 		<?endforeach;?>

					</div>
					<div class="slider gallery-nav">
					<?foreach($arResult['sm_img'] as $sm):?>
						<div><div class="image"><img src="<?= $sm?>" alt="<?= $arResult['NAME']?>" /></div></div>
					<?endforeach?>	
					</div>

				</div>

			</div>
		<?endif?>

		<?if(!empty($arResult["PROPERTIES"]["MAP"]['VALUE']) && !empty($arResult["point"])):
			$scroll[] = array("section-19", "Карта");
		?>
			<div id="section-19" class="detail-content" style="height: 400px">

				<div class="section-title text-left">
					<h4>Карта <?=$arResult["PROPERTIES"]["CN_NAME_chego"]["VALUE"]?></h4>
				</div>
				<div class="map-route" style="width: 100%; height: 300px;" id="map-area"></div>
			</div>
		<?endif;?>

		

		<?if($arResult['sights']):?>
		<div id="section-10" class="detail-content">
			<div class="section-title text-left">
				<?if($arResult['all_sights']):?>
					<a rel="nofollow" href="<?= $arResult['all_sights']?>" class="btn_blue_p5 btn_blue_p5_small" >Все достопримечательности для <?=$arResult["PROPERTIES"]["CN_NAME_chego"]["VALUE"]?></a>
				<?endif?>
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
			
			<div id="section-8" class="detail-content">
				<div class="section-title text-left">
					<h4>Дополнительная информация</h4>
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
		
		<div style="width: 100%; height: 20px;"></div>
		
	</div>

</div>
<?endif?>
<?
$marker_icon_small = SITE_TEMPLATE_PATH . "/images/map/marker24.png";
?>
<script src="https://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
	
$(document).ready(function(){
    let mapAdapter = new MapAdapter({
        map_id: "map-area",
        center: {
            lat: <?=$arResult['point'][0][0];?>,
            lng: <?=$arResult['point'][0][1];?>
        },
        object: "ymaps",
        zoom: 10
    });

    mapAdapter.addMarker({
        title: '<?=$arResult['point'][1]?>',
        lat: '<?= $arResult['point'][0][0]?>',
        lng: '<?= $arResult['point'][0][1]?>',
        content: "<?= $arResult['point'][1]?>",
        icon: "<?= $marker_icon_small; ?>"
    });
});
</script>