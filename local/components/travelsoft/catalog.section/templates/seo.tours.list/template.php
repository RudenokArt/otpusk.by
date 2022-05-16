<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if(!empty($arResult["ITEMS"])):?>
    <?\Bitrix\Main\Loader::includeModule('travelsoft.currency');?>
	<div class="ajax-preloader package-list-item-wrapper on-page-result-page">


	<?  //Определяем, был ли выбран объект в фильтре
		$arGET = explode("&", $_SERVER['QUERY_STRING']); 
		$isObjExist = (strpos(end($arGET), "MAX") !== FALSE || !isset($_GET["set_filter"]))?0:1;
	?>

	<?foreach($arResult["ITEMS"] as $i):
		$p = $i["DISPLAY_PROPERTIES"];
		if (!empty($i["PROPERTIES"]["PICTURES"]["VALUE"][0])):
			$file = CFile::ResizeImageGet($i["PROPERTIES"]["PICTURES"]["VALUE"][0], array('width'=>600, 'height'=>400), BX_RESIZE_IMAGE_EXACT, true);
			$src=$file['src'];
		endif;
	?>
		<? /*if( 
			((isset($_GET["set_filter"]) && 
			 $i["PROPERTIES"]["BYR_PRICE"]["VALUE"] >= $_GET["arrFilter_230_MIN"] &&  
			 $i["PROPERTIES"]["BYR_PRICE"]["VALUE"] <= $_GET["arrFilter_230_MAX"] &&
			 $i["PROPERTIES"]["DURATION_DAYS"]["VALUE"] >= $_GET["arrFilter_375_MIN"] && 
			 $i["PROPERTIES"]["DURATION_DAYS"]["VALUE"] <= $_GET["arrFilter_375_MAX"] &&
			 ($isObjExist == false || in_array($i["PROPERTIES"]["HOTEL"]["VALUE"][0]."=Y", $arGET))
				) || !isset($_GET["set_filter"])) && $i["PROPERTIES"]["COUNTRY"]["VALUE"][0] == 69): */?>
		<div class="package-list-item clearfix">
			<div class="image">
			<?if($i["PREVIEW_PICTURE"]["RESIZE_SRC"]):?>
				<img src="<?= $i["PREVIEW_PICTURE"]["RESIZE_SRC"]?>" alt="<?= $i["NAME"]?>" />
			<?elseif (!empty($i["PROPERTIES"]["PICTURES"]["VALUE"][0])):
			$file = CFile::ResizeImageGet($i["PROPERTIES"]["PICTURES"]["VALUE"][0], array('width'=>600, 'height'=>400), BX_RESIZE_IMAGE_EXACT, true);
			$src=$file['src'];?>
				<img src="<?= $src?>" alt="<?= $i["NAME"]?>" />
			<?else:?>
				<img src="<?= Set::NO_PHOTO?>" alt="<?= $i["NAME"]?>" />
			<?endif?>
			<?if($i["PROPERTIES"]["TOUR_IN_ARCHIVE"]['VALUE']):?>
				<div class="absolute-in-image">
					<div class="duration"><span><? echo "Тур перенесен в архив"; ?></span></div>
				</div>
			<?elseif(!empty($i["PROPERTIES"]["OFFER_IN_PROCESS"]["VALUE"])):?>
				<div class="absolute-in-image">
					<div class="duration"><span style="font-size: 15px; background: #004f95"><?="Предложение формируется"?></span></div>
				</div>
			<?elseif ($arResult["duration"][$i["ID"]]):?>
				<div class="absolute-in-image">
					<div class="duration"><span><?= $arResult["duration"][$i["ID"]]?></span></div>
				</div>
			<?endif?>
			</div>
			
			<div class="content">
				<span style="font-size: 17px; color: #333; margin: 18px 0 10px; font-weight: 700; display: inline-block"><?= $i["NAME"]?> </span>
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
							<?if($arResult["g"][$p["POINT_DEPARTURE"]["VALUE"]]):?>
								 <li><span class="icon"><i class="fa fa-flag"></i></span> <span class="font600">из <?= $arResult["g"][$p["POINT_DEPARTURE"]["VALUE"]]?> <?= implode(", ",array_map(function($it){ return ConvertDateTime($it, "DD.MM"); }, $p["DEPARTURE"]["VALUE"]))?></span></li>
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
								--><?/*endif*/?><br>
								<span><?= $p['PRICE_FOR']['VALUE']?></span>
							</div>
						<?endif?>
						<a href="<?= $i["DETAIL_PAGE_URL"]?>" class="btn btn-primary btn-sm"><?= htmlspecialchars($arParams["MESS_BTN_DETAIL"])?></a>
						</center>
					</div>
				</div>
			</div>

		</div>
		<? /*endif;*/ ?>
	<?endforeach?>
	</div>	

	<?echo $arResult["NAV_STRING"];?>
<?endif?>	

