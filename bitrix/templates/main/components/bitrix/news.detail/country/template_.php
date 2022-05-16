<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$scroll = array();
?>
<div class="col-md-9" role="main">

	<div class="detail-content-wrapper">
		<h4 id="section-0"  style="margin-bottom: 30px"><?= $arResult["NAME"]; $scroll[] = array("section-0", $arResult["NAME"])?></h4>
				</div>
<div class="section-title text-left">
			<?if(!empty($arResult["DETAIL_TEXT"])):?>		
				<div class="detail-content">

					
					
						
						<div class="map-route" style="width: 400px; height: 300px;">
						<?$file_big=CFile::ResizeImageGet($arResult["PROPERTIES"]["PICTURES"]["VALUE"][0], Array('width'=>400, 'height'=>250),BX_RESIZE_IMAGE_PROPORTIONAL,true);?>
						<img src="<?=$file_big["src"];?>" alt="<?= $arResult['NAME']?>" />
						</div>
						
						 <?echo $arResult['DETAIL_TEXT'];?>
					
					
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
							$file_big=CFile::ResizeImageGet($item, Array('width'=>840, 'height'=>460),BX_RESIZE_IMAGE_PROPORTIONAL,true);
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

		<?if(!empty($arResult["PROPERTIES"]["MAP"]['VALUE'])):
			$scroll[] = array("section-19", "Карта");
		?>
			<div id="section-19" class="detail-content" style="height: 400px">

				<div class="section-title text-left">
					<h4>Карта</h4>
				</div>
				<div class="map-route" style="width: 100%; height: 300px;" id="map-area"></div>
			</div>
		<?endif;?>

		<?if($arResult['hotels']):?>
			<div id="section-3" class="detail-content">

				<div class="section-title text-left">
					<h4>Рамещение</h4>
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

		<?if(!empty($arResult['offers'])):?>
		<?
		$scroll[] = array("section-5", "Похожие предложения");
		?>
		<div id="section-5" class="detail-content">

			<div class="section-title text-left">
				<h4>Похожие предложения</h4>
			</div>


			<div class="ajax-preloader package-list-item-wrapper on-page-result-page">

			<?foreach($arResult['offers'] as $i):?>
			
				<div class="package-list-item clearfix">
					<div class="image">
						<?if($i["PIC"]):?>
							<img src="<?= $i["PIC"]?>" alt="<?= $i["NAME"]?>" />
						<?else:?>
							<img src="<?= Set::NO_PHOTO?>" alt="<?= $i["NAME"]?>" />
						<?endif?>
						<?if($i['DAYS']):?>
							<div class="absolute-in-image">
								<div class="duration"><span><?= $i['DAYS']?> <?= $i['NIGHT']?></span></div>
							</div>
						<?endif?>
					</div>
					
					<div class="content">
						<h5><?= $i["NAME"]?></h5>
						<div class="row gap-10">
							<div class="col-sm-12 col-md-9">
								
								<p style="font-size: 14px;margin: 0 0 5px 0"><?= strip_tags($i["TOURTYPE"])?></p>

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
										 <li><span class="icon"><i class="fa fa-flag"></i></span> <span class="font600">из <?= $i['PDEP']?> <?= implode(", ",array_map(function($it){ return ConvertDateTime($it, "DD.MM"); }, $i["DEP_TIME"]))?></span></li>
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
								<?if($i["PRICE"] != ""):?>
									<div class="price"><?= $i["PRICE"]?></div>
								<?endif?>
								<a href="<?= $i["PAGE"]?>" class="btn btn-primary btn-sm">Подробнее</a>
								
							</div>
						</div>
					</div>
					
				</div>
			<?endforeach?>
			</div>
		</div>
		<?endif?>
		
		<?if($arResult['cities']):?>
			<div id="section-7" class="detail-content">

				<div class="section-title text-left">
					<h4>Города</h4>
				</div>
				<?
				$scroll[] = array("section-7", "Города");
				?>
				<div class="hotel-item-wrapper">

					<div class="row gap-1">
					<?foreach($arResult['cities'] as $h):?>
						<div class="col-sm-xss-12 col-xs-6 col-sm-4 col-md-4">

							<div class="hotel-item mb-1">
								<a style="height: 40px;" href="#">
									<!--div s class="image">
										<img src="<?= Set::NO_PHOTO?>" />
									</div-->
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
<script>

/**
*  Sidebar Sticky
*/

!function ($) {

  $(function(){

    var $window = $(window)
    var $body   = $(document.body)

    var navHeight = $('.navbar').outerHeight(true) + 50

    $body.scrollspy({
      target: '.scrollspy-sidebar',
      offset: navHeight
    })

    $window.on('load', function () {
      $body.scrollspy('refresh')
    })

    $('.scrollspy-container [href=#]').click(function (e) {
      e.preventDefault()
    })

    // back to top
    setTimeout(function () {
      var $sideBar = $('.scrollspy-sidebar')

      $sideBar.affix({
        offset: {
          top: function () {
            var offsetTop      = $sideBar.offset().top
            var sideBarMargin  = parseInt($sideBar.children(0).css('margin-top'), 10)
            var navOuterHeight = $('.scrollspy-nav').height()

            return (this.top = offsetTop - navOuterHeight - sideBarMargin)
          }
        , bottom: function () {
            return (this.bottom = $('.scrollspy-footer').outerHeight(true))
          }
        }
      })
    }, 100)
		
  })

}(window.jQuery)

</script>
<script src="https://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
	
$(document).ready(function(){
	<?if($arResult['point']):?>
		
		/* map point */
		var map = new google.maps.Map(document.getElementById('map-area'),{
			center: {lat: <?=$arResult['point'][0][0]?>, lng: <?=$arResult['point'][0][1]?>},
			zoom: 5
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
	<?endif?>
});
</script>