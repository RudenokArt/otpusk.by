<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div class="blog-wrapper">
	<div class="blog-item blog-single">
	<?if(!empty($arResult["PROPERTIES"]["PICTURES"]["VALUE"])):?>
		<?//print_r ($arResult["PROPERTIES"]["PICTURES"]);?>
									<div class="blog-media">
										<?if (!empty($arResult["PROPERTIES"]["PICTURES"]["VALUE"])):?>
										<div id="bootstrap-carousel-slider" class="carousel slide" data-ride="carousel" data-interval="5000">
											<!-- Wrapper for slides -->
											<div class="carousel-inner" role="listbox">
												<?$active=1;?>
												<?foreach($arResult["PROPERTIES"]["PICTURES"]["VALUE"] as $item):
															$file_big=CFile::ResizeImageGet($item, Array('width'=>833, 'height'=>315),BX_RESIZE_IMAGE_EXACT,true);
															?>
												<!-- First slide -->
												<div class="item <?if ($active=='1'):?>active<?endif;?>">
													<div class="image">
														<img src="<?=$file_big["src"];?>" alt="<?=$arResult['NAME']?>" />
													</div>
													<div class="carousel-caption">
														<p><?=$arResult['DESCRIPTION']?></p>
													</div>
												</div> <!-- /.item -->
												<?$active++;?>
												<?endforeach;?>
											</div><!-- /.carousel-inner -->
<?if (!empty($arResult["PROPERTIES"]["PICTURES"]["VALUE"][1])):?>
											<!-- Controls -->
											<a class="left carousel-control" href="#bootstrap-carousel-slider" role="button" data-slide="prev">
												<span class="carousel-control-left"><i class="pe-7s-angle-left" aria-hidden="true"></i></span>
												<span class="sr-only">Предыдущий</span>
											</a>
											<a class="right carousel-control" href="#bootstrap-carousel-slider" role="button" data-slide="next">
												<span class="carousel-control-right"><i class="pe-7s-angle-right" aria-hidden="true"></i></span>
												<span class="sr-only">Следующий</span>
											</a>
										</div><!-- /.carousel -->
<?endif;?> 
										<?else:?>
										<div class="overlay-box">
											<a class="blog-image" href="<? echo $arResult['DETAIL_PAGE_URL']; ?>">
												<?$file_big=CFile::ResizeImageGet($item, Array('width'=>833, 'height'=>315),BX_RESIZE_IMAGE_EXACT,true);?>
												<img src="<?=$file_big["src"];?>" alt="" />
												<div class="image-overlay">
													<div class="overlay-content">
														<div class="overlay-icon"><i class="pe-7s-link"></i></div>
													</div>
												</div>
											</a>
										</div>
										<?endif;?>

									</div>
									<?else:?>
										<?if (!empty($arResult["PROPERTIES"]["VIMEO"]["VALUE"])):?>
											<div class="blog-media">
												<div class="flex-video vimeo"> 
													<iframe src="http://player.vimeo.com/video/<?$arItem["PROPERTIES"]["VIMEO"]["VALUE"]?>" allowfullscreen></iframe> 
												</div>
											</div>
										<?endif;?>
									  <?if (!empty($arResult["PROPERTIES"]["VIDEO"]["VALUE"])):?>
									  <h3>Видео</h3>
											<div class="blog-media">
												<div class="flex-video vimeo"> 
											<iframe width="100%" height="340px" src="https://www.youtube.com/embed/<?=$arResult["PROPERTIES"]["VIDEO"]["VALUE"]?>" frameborder="0" allowfullscreen></iframe>
										 </div>
									  </div>
									  <?endif;?>
									<?endif;?>
									<div class="blog-content">
										<h3><a href="<? echo $arResult['DETAIL_PAGE_URL']; ?>" class="inverse"><?echo $arItem["NAME"]?></a></h3>
										<ul class="blog-meta clearfix">
											<?if (!empty($arResult["DISPLAY_PROPERTIES"]["COUNTRY"]["DISPLAY_VALUE"])):?>
											<li>
												<?if (is_array($arResult["DISPLAY_PROPERTIES"]["COUNTRY"]["DISPLAY_VALUE"])):?>
													<?=implode(", ", $arResult["DISPLAY_PROPERTIES"]["COUNTRY"]["DISPLAY_VALUE"]);?>
												<?else:?>
													<?print_r ($arResult["DISPLAY_PROPERTIES"]["COUNTRY"]["DISPLAY_VALUE"]);?>
												<?endif;?>
											</li>
											<?endif;?>
											<?if ($arResult["DISPLAY_PROPERTIES"]["TOWN"]["VALUE"]!=""):?>
											<li>
													<?if (is_array($arResult["DISPLAY_PROPERTIES"]["TOWN"]["DISPLAY_VALUE"])):?>
														<?=substr(implode(" - ", $arResult["DISPLAY_PROPERTIES"]["TOWN"]["DISPLAY_VALUE"]), 0, 680) . '...';?>
													<?else:?>
					 									<?print_r ($arResult["DISPLAY_PROPERTIES"]["TOWN"]["DISPLAY_VALUE"]);?>
													<?endif;?>
											</li>
											<?endif;?>
											<?if ($arResult["DISPLAY_PROPERTIES"]["HOTEL"]["VALUE"]!=""):?>
											<li>
													<?if (is_array($arResult["DISPLAY_PROPERTIES"]["HOTEL"]["DISPLAY_VALUE"])):?>
														<?=substr(implode(" - ", $arResult["DISPLAY_PROPERTIES"]["HOTEL"]["DISPLAY_VALUE"]), 0, 680) . '...';?>
													<?else:?>
					 									<?print_r ($arResult["DISPLAY_PROPERTIES"]["HOTEL"]["DISPLAY_VALUE"]);?>
													<?endif;?>
											</li>
											<?endif;?>
											<?if(!empty($arResult["PROPERTIES"]["DEPARTURE"]["VALUE"])):?>
											<li>
												<?  $spisok='';
													foreach ($arResult["PROPERTIES"]["DEPARTURE"]["VALUE"] as $dates) 
													{ 
														if (strtotime($dates)>strtotime($today))
														{ $spisok .= substr($dates,0,10).'; ';}              
													}  
													$string = substr($spisok, 0, 22);
													if (iconv_strlen ($spisok)>22):
													echo $string."… ";
													else: 
													echo $string;
													endif;
													?>
											</li>
											<?endif;?>
											<?if(!empty($arResult["PROPERTIES"]["CITY_TRIP"]["VALUE"])):?>
												<li><b>Город начала поездки</b> <?=substr($arResult["DISPLAY_PROPERTIES"]["CITY_TRIP"]["DISPLAY_VALUE"]);?></li>
											<?endif;?>
											<?if(!empty($arResult["PROPERTIES"]["DISCOUNT"]["VALUE"])):?>
												<li><b>Скидка</b> <?=$arResult["PROPERTIES"]["DISCOUNT"]["VALUE"];?> %</li>
											<?elseif(!empty($arItem["PROPERTIES"]["PRICE"]["VALUE"])):?>
												<li><b>Стоимость</b> <? echo $arResult["PROPERTIES"]["PRICE"]["VALUE"];?> <?=strip_tags($arResult["DISPLAY_PROPERTIES"]["CURRENCY"]["DISPLAY_VALUE"])?></li>
											<?endif;?>										</ul>
										<div class="blog-entry">  
											<?if (!empty($arResult["PROPERTIES"]["HTML"]["VALUE"])):?><?=$arResult['DETAIL_TEXT']?><?else:?><?= $arResult['DETAIL_TEXT']?><?endif;?>
											<?if(!empty($arResult["PROPERTIES"]["FILE"]["VALUE"])):?>
											<h5>Файлы для скачивания</h5>
												<p><?if (is_array($arResult["DISPLAY_PROPERTIES"]["FILE"]["DISPLAY_VALUE"])):?><?echo implode(" | ", $arResult["PROPERTIES"]["FILE"]["VALUE"]);?><?else:?><?echo $arResult["DISPLAY_PROPERTIES"]["FILE"]["DESCRIPTION"];?> <?echo $arResult["DISPLAY_PROPERTIES"]["FILE"]["DISPLAY_VALUE"];?><?endif;?></p>
											<?endif;?>	

											<?if (!empty($arResult["PROPERTIES"]["ABOUT_OFFER"]["VALUE"])):?>
												<h5>О предложении</h5>
												<div class="">
													<?=htmlspecialcharsBack($arResult["PROPERTIES"]["ABOUT_OFFER"]["VALUE"]["TEXT"])?>
												</div>		
											<?endif;?>									
											<?if (!empty($arResult["PROPERTIES"]["FEATURES"]["VALUE"])):?>
												<h5>Особенности</h5>
												<div class="">
													<?=htmlspecialcharsBack($arResult["PROPERTIES"]["FEATURES"]["VALUE"]["TEXT"])?>
												</div>		
											<?endif;?>
											<?if (!empty($arResult["PROPERTIES"]["PRICE_INCLUDE"]["VALUE"])):?>
												<h5>В стоимость входит</h5>
												<div class="">
													<?=htmlspecialcharsBack($arResult["PROPERTIES"]["PRICE_INCLUDE"]["VALUE"]["TEXT"])?>
												</div>		
											<?endif;?>
											<?if (!empty($arResult["PROPERTIES"]["PRICE_NO_INCLUDE"]["VALUE"])):?>
												<h5>В стоимость не входит</h5>
												<div class="">
													<?=htmlspecialcharsBack($arResult["PROPERTIES"]["PRICE_NO_INCLUDE"]["VALUE"]["TEXT"])?>
												</div>		
											<?endif;?>	

										</div>
									</div>
	</div>
</div>