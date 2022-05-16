<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if(!empty($arResult["ITEMS"])):?>	
	<div class="ajax-preloader GridLex-gap-20-wrappper package-grid-item-wrapper on-page-result-page alt-smaller">
	<div class="GridLex-grid-noGutter-equalHeight">
	<?foreach($arResult["ITEMS"] as $i):
		$p = $i["DISPLAY_PROPERTIES"];
//print_r ($i["PROPERTIES"]);
		if (!empty($i["PROPERTIES"]["PICTURES"]["VALUE"][0])):
			$file = CFile::ResizeImageGet($i["PROPERTIES"]["PICTURES"]["VALUE"][0], array('width'=>600, 'height'=>400), BX_RESIZE_IMAGE_EXACT, true);
			$src=$file['src'];
		else:
			$src= Set::NO_PHOTO;
		endif;
	?>
			<div class="GridLex-col-4_sm-6_xs-12 mb-20">
				<div class="package-grid-item">

				<?if($arParams['SECTION_ID'] == Set::SANATORII_SECTION_ID)
					$i["DETAIL_PAGE_URL"] = str_replace("/oteli/", "/sanatorii/", $i["DETAIL_PAGE_URL"]);
					
					?>
					<a href="<?= $i["DETAIL_PAGE_URL"]?>">
						<div class="image">
							<img alt="<?= $i["NAME"]?>" src="<?=$src?>">
							<?if($i['PRICE_MIN_RU'] || $i['PRICE_MIN_BY']):?>
							<div class="absolute-in-image">
								<div class="duration">
									<?if($i['PRICE_MIN_BY']):?><span data-context="для граждан РБ" class="show-popuver"><?= $i['PRICE_MIN_BY']?></span> <br><?endif?>
									<?if($i['PRICE_MIN_RU']):?><span data-context="для иностранных граждан" class="show-popuver"><?= $i['PRICE_MIN_RU']?></span><?endif?>
								</div>
							</div>
							<?endif?>
						</div>
						<div class="content clearfix">
							<h6><?= $i["NAME"]?> <?= $i["PROPERTIES"]["CAT_ID"]["VALUE"]?></h6>
							<?if (!empty($i["PROPERTIES"]["COUNTRY"]["VALUE"])):?>
								<div style="font-size: 14px; color: #666; top:-12px; position:relative"><?= strip_tags($p["COUNTRY"]["DISPLAY_VALUE"])?><?if (!empty($i["PROPERTIES"]["TOWN"]["VALUE"])):?><?echo ", ". strip_tags($p["TOWN"]["DISPLAY_VALUE"])?><?endif;?> 
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
		<? // формируем ссылку на фильтр
		if(isset($GLOBALS[$arParams['FILTER_NAME']]) && $arResult['NAV_RESULT']->NavRecordCount > $arParams['PAGE_ELEMENT_COUNT'])
		{
			foreach ($GLOBALS[$arParams['FILTER_NAME']] as $key => $val)
			{
				$kp = explode('_', $key);
				$id[] = $kp[1];
				$value[] = $val;
			}

			if($id && $value)
				$filter_url = makeFilterLink($id, $arParams['IBLOCK_ID'], $value, $arParams['SECTION_ID']);
			
			if($filter_url)
			{
				?>
				<div class="center-wrapper">
					<a rel="nofollow" href="<?= $filter_url?>" class="btn btn-primary">Смотреть все</a>
				</div>
				<?
			}
		}?>
	</div>
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