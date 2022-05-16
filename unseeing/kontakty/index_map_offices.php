<?
\Bitrix\Main\Loader::includeModule("iblock");

$ib = 39;
$o = array("SORT" => "ASC"); //сортировка 
$f = array("IBLOCK_ID" => $ib); //фильтр
$s = array("ID", "NAME", "PROPERTY_ADDRESS", "PROPERTY_PHONE", "PROPERTY_EMAIL", "PROPERTY_MAP", "PREVIEW_PICTURE", "PREVIEW_TEXT","DETAIL_PAGE_URL", "PROPERTY_PICTURES"); // поля выборки

$c_id = $ib . serialize(array_merge($o, $f, $s)) . date('d.m.Y'); // id кеша
$c_t = 3600; // время кеширования 
$c_dir = "/cm"; // дирректория кеша

$ob_c = new CPHPCache();

if($ob_c->InitCache($c_t, $c_id, $c_dir))
{
	$els = $ob_c->GetVars(); // выборка из кеша
	$els = $els['els'];
}
elseif($ob_c->StartDataCache())
{
	global $CACHE_MANAGER;
	$CACHE_MANAGER->StartTagCache($c_dir); // связываем кеш с дирректорией

	$CACHE_MANAGER->RegisterTag('iblock_id_' . $ib); // вешаем тег

	$CACHE_MANAGER->EndTagCache(); // оканчиваем регистрацию кеша

	$db_e = CIBlockElement::GetList($o, $f, false, false, $s);

	while($el = $db_e->GetNext())
	{
		$els[$el["ID"]] = $el;
	}

	if($ob_c->StartDataCache())
		$ob_c->EndDataCache(array("els" => $els)); // сохраняем выборку в кеш
}

$marker_icon = SITE_TEMPLATE_PATH . "/images/map/marker48.png";
$marker_icon_small = SITE_TEMPLATE_PATH . "/images/map/marker24.png";
?> <!-- контейнер для карты -->
<div id="map" class="mapbox">
</div>
<div class="bg-light section pt-40 pb-20">
	<div class="container">
		<div class="map-contact">
			<div class="top-place-inner">
				<div id="map_list" class="list row gap-0">
					 <?foreach($els as $id => $el): 
						$c = explode(",", $el["PROPERTY_MAP_VALUE"]);
						$pic = CFile::GetFileArray($el["PROPERTY_PICTURES_VALUE"][0]);
						$cnt++;
					?>
					<div class="col-sm-4 minHeight_300" style="height: 300px;">
						<div data-lat="<?= $c[0]?>"  data-lng="<?= $c[1]?>" class="maplocation map-top-destination-item" data-name="<?= $el["NAME"]?>">
							<div class="top-place-item mb-30 maplink">
								<div class="icon">
									<img alt="на карте" src="<?= $marker_icon?>">
								</div>
								<div class="content">
									<h5 class="heading mt-0"><a href="<?=$el["DETAIL_PAGE_URL"]?>" onclick="window.location='<?=$el["DETAIL_PAGE_URL"]?>'"><?= $el["NAME"]?></a></h5>
									<ul class="address-list">
										 <?if(!empty($el["PROPERTY_ADDRESS_VALUE"])):?>
										<li><i class="fa fa-map-marker"></i><?= $el["PROPERTY_ADDRESS_VALUE"]?></li>
										 <?endif?> <?foreach($el["PROPERTY_PHONE_VALUE"] as $ph):?>
										<li><i class="fa fa-phone"></i><?= $ph?></li>
										 <?endforeach?> <?if(!empty($el["PROPERTY_EMAIL_VALUE"])):?>
										<li><i class="fa fa-envelope"></i><?= $el["PROPERTY_EMAIL_VALUE"]?></li>
										 <?endif?>
									</ul>
 									<a href="<?=$el["DETAIL_PAGE_URL"]?>" onclick="window.location='<?=$el["DETAIL_PAGE_URL"]?>'" class="mt-10 btn btn-primary btn-sm">Подробнее</a>
								</div>
							</div>
							<div class="infobox">
								<div class="infobox-inner">
									 <?if(!empty($pic["SRC"])):?>
									<div class="image">
										<?$pic_min = CFile::ResizeImageGet($pic["ID"], array('width'=>210, 'height'=>130), BX_RESIZE_IMAGE_EXACT, true)?>
 										<img src="<?= $pic_min["src"]?>" alt="<?= $el["NAME"]?>">
									</div>
									 <?endif?>
									<div class="content">
										<h6 class="heading"><?= $el["PREVIEW_TEXT"]?></h6>
										<ul class="address-list">
											 <?if(!empty($el["PROPERTY_ADDRESS_VALUE"])):?>
											<li><i class="fa fa-map-marker"></i><?= $el["PROPERTY_ADDRESS_VALUE"]?></li>
											 <?endif?> <?foreach($el["PROPERTY_PHONE_VALUE"] as $ph):?>
											<li><i class="fa fa-phone"></i><?= $ph?></li>
											 <?endforeach?> <?if(!empty($el["PROPERTY_EMAIL_VALUE"])):?>
											<li><i class="fa fa-envelope"></i><?= $el["PROPERTY_EMAIL_VALUE"]?></li>
											 <?endif?>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
					 <?endforeach?>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- ИНИЦИАЛИЗИРУЕМ JS -->
<!--?key=AIzaSyCjhzBZNoQKt3VuD0Zh6I81i3Evy7aQHKA-->
<script src="https://maps.google.com/maps/api/js?key=AIzaSyBuAKs-2Bd-JT_0ugSEmMebtfOgbC-ip5I "></script>
<script type="text/javascript" src="<?= SITE_TEMPLATE_PATH?>/js/MarkerClusterer.js"></script>
<script type="text/javascript" src="<?= SITE_TEMPLATE_PATH?>/js/infobox.js"></script>
<script type="text/javascript" src="<?= SITE_TEMPLATE_PATH?>/js/jquery.mosne.map-for-category.js"></script>
<script>
(function ($) {
		 
	var mapOptions = {
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			panControl: false,
			rotateControl: false,
			streetViewControl: false,
			scrollwheel: false,
			'zoom': 13,
	};

	$("#map").mosne_map({
			elements: '#map_list .maplocation',
			clickedzoom: 15, 	
			infowindows: false,  	
			infobox: true,   			
			map_opt: mapOptions,								
			marker_icon: '<?= $marker_icon_small?>',
			cluster_styles: {
				zoomOnClick: true,
				maxZoom: 2
			}
	});

})(jQuery);
</script>