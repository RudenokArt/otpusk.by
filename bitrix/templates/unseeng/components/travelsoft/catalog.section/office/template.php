<?$prov=CModule::IncludeModuleEx("simai.special");if($prov==0||$prov==3)return;?><?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
	<div class="sorting-wrappper">
<?if(!empty($arResult["ITEMS"])):?>	
		<div class="sorting-content">
		
			<div class="row">
			
				<div class="col-sm-12 col-md-8">
					<div class="sort-by-wrapper">
						<label class="sorting-label">Сортировать: </label> 
						<div class="sorting-middle-holder">
							<ul class="sort-by">
								<li <?= $arResult["name_sorting"][1]?>>
									<a class="sort" href="<?= $arResult["name_sorting"][0]?>">Имя <?= $arResult["name_sorting"][2]?></a>
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
			$file = CFile::ResizeImageGet($i["PROPERTIES"]["PICTURES"]["VALUE"][0], array('width'=>290, 'height'=>290), BX_RESIZE_IMAGE_EXACT, true);
			$src=$file['src'];
		else:
			$src= SITE_TEMPLATE_PATH . "/images/nophoto.jpg";
		endif;
	?>
			<div class="GridLex-col-4_sm-6_xs-12 mb-20">
				<div class="package-grid-item"> 
					<a href="<?= $i["DETAIL_PAGE_URL"]?>">
						<div class="image">
							<img alt="<?= $i["NAME"]?>" src="<?=$src?>">
						</div>
						<div class="content clearfix">
							<div class="block-name-city">
								<h6><?= $i["NAME"]?> <?= $i["PROPERTIES"]["CAT_ID"]["VALUE"]?></h6>
								<?if (!empty($arResult['town'][$i["ID"]])):?>
									<span><?=$arResult['town'][$i["ID"]]?></span>
								<?endif?>
							</div>
							<?if (!empty($i["PROPERTIES"]["COUNTRY"]["VALUE"])):?>
								<div style="top:-12px; position:relative"><?=$p["COUNTRY"]["DISPLAY_VALUE"]?><?if (!empty($i["PROPERTIES"]["TOWN"]["VALUE"])):?><?echo ", ". $p["TOWN"]["DISPLAY_VALUE"]?><?endif;?> 
								</div>
							<?endif;?>
							<?if (!empty($i["PROPERTIES"]["POSITION"]["VALUE"])):?>
								<span><?=$i["PROPERTIES"]["POSITION"]["VALUE"]?></span>
							<?endif?>
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

