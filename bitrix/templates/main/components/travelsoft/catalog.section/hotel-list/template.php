<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
	<div class="sorting-wrappper">

		<div class="sorting-header">
			<p class="sorting-lead"><?= $arResult["NAV_RESULT"]->NavRecordCount?> вариантов найдено</p>
		</div>
<?if(!empty($arResult["ITEMS"])):?>	
		<div class="sorting-content">
		
			<div class="row">
			
				<div class="col-sm-12 col-md-8">
					<div class="sort-by-wrapper">
						<label class="sorting-label">Сортировать: </label> 
						<div class="sorting-middle-holder">
							<ul class="sort-by">
								<li <?= $arResult["name_sorting"][1]?>>
									<a class="sort" href="<?= $arResult["name_sorting"][0]?>">По алфавиту <?= $arResult["name_sorting"][2]?></a>
								</li>
								<!--li <?= $arResult["price_sorting"][1]?>><a class="sort" href="<?= $arResult["price_sorting"][0]?>">Цена <?= $arResult["price_sorting"][2]?></a></li-->
							</ul>
						</div>
					</div>
				</div>
				
			</div>
		
		</div>
	</div>
	
	<div class="ajax-preloader GridLex-gap-20-wrappper package-grid-item-wrapper on-page-result-page alt-smaller">
		<div class="GridLex-grid-noGutter-equalHeight">
	<?foreach($arResult["ITEMS"] as $i):
		$p = $i["DISPLAY_PROPERTIES"];
//print_r ($i["PROPERTIES"]["PICTURES"]);
		if (!empty($i["PROPERTIES"]["PICTURES"]["VALUE"][0])):
			$file = CFile::ResizeImageGet($i["PROPERTIES"]["PICTURES"]["VALUE"][0], array('width'=>600, 'height'=>400), BX_RESIZE_IMAGE_EXACT, true);
			$src=$file['src'];
		else:
			$src= Set::NO_PHOTO;
		endif;
	?>
			<div class="GridLex-col-4_sm-6_xs-12 mb-20">
				<div class="package-grid-item"> 
					<a href="<?= $i["DETAIL_PAGE_URL"]?>">
						<div class="image">
							<img alt="<?= $i["NAME"]?>" src="<?=$src?>">
							<?if($i['PRICE_MIN_RU'] || $i['PRICE_MIN_BY']):?>
							<div class="absolute-in-image">
								<div class="hotels-price duration">
									<?if($i['PRICE_MIN_BY']):?>
									<span data-context="Минимальная цена в сутки для граждан РБ" class="show-popuver"><?= $i['PRICE_MIN_BY']?></span>
									<!--<span data-context="Минимальная цена в сутки для граждан РБ" class="show-popuver"><?/*= denomination($i['PROPERTIES']['PRICE_MIN_BY']['VALUE'], $i['PROPERTIES']['CURRENCY_BY']['VALUE'])*/?></span>-->
									<?endif?>
									<?if($i['PRICE_MIN_RU']):?><br><span data-context="Минимальная цена в сутки для иностранных граждан" class="show-popuver"><?= $i['PRICE_MIN_RU']?></span><?endif?>
								</div>
							</div>
							<?endif?>
						</div>
						<div class="content clearfix">
							<span style="display: inline-block; font-size: 14px; color: #333; margin: 0 0 10px;  font-weight: 700"><?= $i["NAME"]?> <?= $i["PROPERTIES"]["CAT_ID"]["VALUE"]?></span>
							<?if (!empty($i["PROPERTIES"]["COUNTRY"]["VALUE"])):?>
								<div style="top:-12px; position:relative"><?= strip_tags($p["COUNTRY"]["DISPLAY_VALUE"])?><?if (!empty($i["PROPERTIES"]["TOWN"]["VALUE"])):?><?echo ", ". strip_tags($p["TOWN"]["DISPLAY_VALUE"])?><?endif;?> 
								</div>
							<?endif;?>
							<?if (!empty($i["PROPERTIES"]["TYPE_ID"]["VALUE"])):?>
								<div class="absolute-in-content">
									<div class="price"><?= $i["PROPERTIES"]["TYPE_ID"]["VALUE"]?></div>
								</div>
							<?endif;?>
						</div>
					</a>
				</div>
			</div>
<?endforeach?>
		</div>
	</div>	

	<?echo $arResult["NAV_STRING"];?>
<?else:?>
	</div> <!-- close orting-wrappper -->
<?endif?>


<?$this->addExternalCSS("https://cdn.jsdelivr.net/jquery.webui-popover/1.2.1/jquery.webui-popover.min.css")?>
<script src="https://cdn.jsdelivr.net/jquery.webui-popover/1.2.1/jquery.webui-popover.min.js"></script>
<script type="text/javascript">
(function($){
	$('.show-popuver').each(function(){
		var context = $(this).data('context');
		$(this).webuiPopover({content: context,trigger:'hover', placement:'right'});
	});
})(jQuery);
	
</script>