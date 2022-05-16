<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?\Bitrix\Main\Loader::includeModule('travelsoft.currency');?>
	<div class="sorting-wrappper">

		<div class="sorting-header">
			<h3 class="sorting-title uppercase">Список экскурсий и туров</h3>
			<p class="sorting-lead"><?= $arResult["NAV_RESULT"]->NavRecordCount?> предложений найдено</p>
		</div>
<?if(!empty($arResult["ITEMS"])):?>	
		<div class="sorting-content">
		
			<div class="row">
			
				<div class="col-sm-12 col-md-8">
					<div class="sort-by-wrapper">
						<label class="sorting-label">Сортировать: </label> 
						<div class="sorting-middle-holder">
							<ul class="sort-by">
								<li <?= $arResult["date_sorting"][1]?>>
									<a class="sort" href="<?= $arResult["date_sorting"][0]?>">Дата <?= $arResult["date_sorting"][2]?></a>
								</li>
								<li <?= $arResult["price_sorting"][1]?>><a class="sort" href="<?= $arResult["price_sorting"][0]?>">Цена <?= $arResult["price_sorting"][2]?></a></li>
							</ul>
						</div>
					</div>
				</div>
				
			</div>
		
		</div>

	</div>
	
	<div class="ajax-preloader package-list-item-wrapper on-page-result-page">

	<?foreach($arResult["ITEMS"] as $i):

		$p = $i["DISPLAY_PROPERTIES"];
		if (!empty($i["PROPERTIES"]["PICTURES"]["VALUE"][0])):
			$file = CFile::ResizeImageGet($i["PROPERTIES"]["PICTURES"]["VALUE"][0], array('width'=>600, 'height'=>400), BX_RESIZE_IMAGE_EXACT, true);
			$src=$file['src'];
		endif;
	?>
	
		<div class="package-list-item clearfix">
			<div class="image" <? if($p['TOUR_IN_ARCHIVE']['VALUE'] != ""): ?>style = "opacity: 0.4"<?endif;?>>
			<?if($i["PREVIEW_PICTURE"]["RESIZE_SRC"]):?>
				<img src="<?= $i["PREVIEW_PICTURE"]["RESIZE_SRC"]?>" alt="<?= $i["NAME"]?>" />
			<?elseif (!empty($i["PROPERTIES"]["PICTURES"]["VALUE"][0])):
			$file = CFile::ResizeImageGet($i["PROPERTIES"]["PICTURES"]["VALUE"][0], array('width'=>600, 'height'=>400), BX_RESIZE_IMAGE_EXACT, true);
			$src=$file['src'];?>
				<a style="color: black;" href="<?= $i['DETAIL_PAGE_URL']?>"><img src="<?= $src?>" alt="<?= $i["NAME"]?>" /></a>
			<?else:?>
				<a style="color: black;" href="<?= $i['DETAIL_PAGE_URL']?>"><img src="<?= Set::NO_PHOTO?>" alt="<?= $i["NAME"]?>" /></a>
			<?endif?>
			<?= printTourLabel($p)?>
			<?if($arResult["duration"][$i["ID"]]):?>
				<div class="absolute-in-image">
					<div class="duration"><span><?= $arResult["duration"][$i["ID"]]?></span></div>
				</div>
			<?endif?>
			</div>
			
			<div class="content">
				<h5><a style="color: black;" href="<?= $i['DETAIL_PAGE_URL']?>"><?= $i["NAME"]?></a></h5>
				<div class="row gap-10">
					<div class="col-sm-12 col-md-9">
						
						<p class="line18"><?= strip_tags($p["TOURTYPE"]["DISPLAY_VALUE"])?> <?if($i['PROPERTIES']['TYPE_EXCURSIONS']['DISPLAY_VAL'] != "") echo strtolower($i['PROPERTIES']['TYPE_EXCURSIONS']['DISPLAY_VAL'])?></p>

						<ul class="list-info">
							<?
							$p["TOWN"]["DISPLAY_VALUE"] = (array)$p["TOWN"]["DISPLAY_VALUE"];
							if(!empty($p["TOWN"]["DISPLAY_VALUE"])):?>
								<li>
									<span class="icon"><i class="fa fa-map-marker"></i></span> <span class="font600">
									<?= implode(" - ", array_map( function($it){ return strip_tags($it); }, $p["TOWN"]["DISPLAY_VALUE"]))?>
									</span>
								</li>
							<?endif?>
                            <?if($p["POINT_DEPARTURE"]["VALUE"]):?>
								<li><span class="icon"><i class="fa fa-flag"></i></span> <span class="font600">из
                                    <?if(is_array($p["POINT_DEPARTURE"]["VALUE"]) && count($p["POINT_DEPARTURE"]["VALUE"]) >= 1):?>
                                        <?$a = 1;?>
                                        <?foreach ($p["POINT_DEPARTURE"]["VALUE"] as $point):?>
                                            <?= $arResult["g"][$point]?><?if(count($p["POINT_DEPARTURE"]["VALUE"]) > $a):?><?echo ", ";?><?endif?>
                                            <?$a++?>
                                        <?endforeach;?>
                                    <?else:?>
                                        <?= $arResult["g"][$p["POINT_DEPARTURE"]["VALUE"]]?>
                                    <?endif?>
								<?if(!empty($p["DEPARTURE"]["VALUE"]))
									echo implode(", ",array_map(function($it){ return ConvertDateTime($it, "DD.MM"); }, dateFilter($p["DEPARTURE"]["VALUE"])));
									elseif($p['DEPARTURE_TEXT']['VALUE'] != '') echo $p['DEPARTURE_TEXT']['VALUE']?></span></li>
							<?elseif($p['DEPARTURE_TEXT']['VALUE'] != ''):?>
								<li><span class="icon"><i class="fa fa-flag"></i></span> <span class="font600"><?= $p['DEPARTURE_TEXT']['VALUE']?></span></li>
							<?endif?>
							<?
							$p["HOTEL"]["DISPLAY_VALUE"] = (array)$p["HOTEL"]["DISPLAY_VALUE"];
							if(!empty($p["HOTEL"]["DISPLAY_VALUE"])):?>
								<li><span class="icon"><i class="fa fa-home"></i></span>Проживание<span class="font600"> <?= implode(", ",array_map(function($it){ return strip_tags($it); }, $p["HOTEL"]["DISPLAY_VALUE"]))?></span></li>
							<?endif?>
							<?
							$p["FOOD"]["DISPLAY_VALUE"] = (array)$p["FOOD"]["DISPLAY_VALUE"];
							if(!empty($p["FOOD"]["DISPLAY_VALUE"])):?>
							<li><span class="icon"><i class="fa fa-cutlery"></i></span> Питание<span class="font600"> <?= implode(", ",array_map(function($it){ return strip_tags($it); }, $p["FOOD"]["DISPLAY_VALUE"]))?></span></li>
							<?endif?>
                            <?if(!empty($p["TOUR_IN_ARCHIVE"]["DISPLAY_VALUE"]) && ($p["TOUR_IN_ARCHIVE"]["DISPLAY_VALUE"] == "Y")):?>
                                <li><!--<span class="icon"><i class="fa fa-cutlery"></i></span>--><span class="font600">Тур добавлен в архив, возможно он скоро поступит в продажу</span></li>
                            <?endif?>
						</ul>
						
					</div>
					<div class="col-sm-12 col-md-3 text-right text-left-sm"><center>
						<?if($p["PRICE"]["DISPLAY_VALUE"] != ""):?>
							<div class="price" style="line-height:16px; border:1px solid"><span>от</span><br>
                                <?= \travelsoft\Currency::getInstance()->convertCurrency(
                                    $p["PRICE"]["VALUE"], $p["CURRENCY"]["VALUE"]
                                );?>
								<?/*= convert_currency($p["PRICE"]["VALUE"], $p["CURRENCY"]["VALUE"])*/?><!--<br>
								<span style="color: #EB5019; font-weight:normal; font-size:12px;"> <?/*= denomination($p["PRICE"]["VALUE"], $p["CURRENCY"]["VALUE"]);*/?></span>
								<?/*if($p["CURRENCY"]["VALUE"] != 62):*/?>
								 <br>
								<span style="color: #EB5019; font-weight:normal; font-size:12px;"> <?/*= number_format($p["PRICE"]["VALUE"], 0, "", " ") .' '. strip_tags($p["CURRENCY"]["DISPLAY_VALUE"])*/?></span>
								--><?/*endif*/?>
                                <br>
								<span><?= $p['PRICE_FOR']['VALUE']?></span>
							</div>
						<?endif?>
						<a href="<?= $i["DETAIL_PAGE_URL"]?>" class="btn btn-primary btn-sm"><?= htmlspecialchars($arParams["MESS_BTN_DETAIL"])?></a>
						</center>
					</div>
				</div>
			</div>
			
		</div>
	<?endforeach?>
	</div>	

	<?echo $arResult["NAV_STRING"];?>
<?else:?>
	</div> <!-- close orting-wrappper -->
<?endif?>

<?if(isset($GLOBALS['arrFilter']['=PROPERTY_101']) && $GLOBALS['arrFilter']['=PROPERTY_101'] == Set::BUS):?>
    <script>
        $(document).ready(function () {
            $("#catalog-form").find("select[name^='arrFilter_101']").closest(".sidebar-module").remove();
            $("#catalog-form").find("select[name^='arrFilter_102']").closest(".sidebar-module").remove();
        });
    </script>
<?endif?>
