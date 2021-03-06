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
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
								<div class="blog-item">
									<?if(!empty($arItem["PROPERTIES"]["PICTURES"]["VALUE"])):?>
									<div class="blog-media">
										<?if (is_array($arItem["PROPERTIES"]["PICTURES"]["VALUE"])):?>
										<div id="bootstrap-carousel-slider" class="carousel slide" data-ride="carousel" data-interval="5000">
											<!-- Wrapper for slides -->
											<div class="carousel-inner" role="listbox">
												<?$active=1;?>
												<?foreach($arItem["PROPERTIES"]["PICTURES"]["VALUE"] as $item):
															$file_big=CFile::ResizeImageGet($item, Array('width'=>833, 'height'=>315),BX_RESIZE_IMAGE_EXACT,true);
															?>
												<!-- First slide -->
												<div class="item <?if ($active=='1'):?>active<?endif;?>">
													<div class="image">
														<img src="<?=$file_big["src"];?>" alt="Image" />
													</div>
													<div class="carousel-caption">
														<p><?$item['DESCRIPTION']?></p>
													</div>
												</div> <!-- /.item -->
												<?$active++;?>
												<?endforeach;?>
											</div><!-- /.carousel-inner -->

											<!-- Controls -->
											<a class="left carousel-control" href="#bootstrap-carousel-slider" role="button" data-slide="prev">
												<span class="carousel-control-left"><i class="pe-7s-angle-left" aria-hidden="true"></i></span>
												<span class="sr-only">????????????????????</span>
											</a>
											<a class="right carousel-control" href="#bootstrap-carousel-slider" role="button" data-slide="next">
												<span class="carousel-control-right"><i class="pe-7s-angle-right" aria-hidden="true"></i></span>
												<span class="sr-only">??????????????????</span>
											</a>
										</div><!-- /.carousel -->
										<?else:?>
										<div class="overlay-box">
											<a class="blog-image" href="<? echo $arItem['DETAIL_PAGE_URL']; ?>">
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
										<?if (!empty($arItem["PROPERTIES"]["VIMEO"]["VALUE"])):?>
											<div class="blog-media">
												<div class="flex-video vimeo"> 
													<iframe src="//player.vimeo.com/video/<?$arItem["PROPERTIES"]["VIMEO"]["VALUE"]?>" allowfullscreen></iframe> 
												</div>
											</div>
										<?endif;?>
									  <?if (!empty($arItem["PROPERTIES"]["VIDEO"]["VALUE"])):?>
									  <h3>??????????</h3>
											<div class="blog-media">
												<div class="flex-video vimeo"> 
											<iframe width="100%" height="340px" src="https://www.youtube.com/embed/<?=$arResult["PROPERTIES"]["VIDEO"]["VALUE"]?>" frameborder="0" allowfullscreen></iframe>
										 </div>
									  </div>
									  <?endif;?>
									<?endif;?>
									<div class="blog-content">
										<h3><a href="<? echo $arItem['DETAIL_PAGE_URL']; ?>" class="inverse"><?echo $arItem["NAME"]?></a></h3>
										<ul class="blog-meta clearfix">
											<?if (!empty($arItem["DISPLAY_PROPERTIES"]["COUNTRY"]["DISPLAY_VALUE"])):?>
											<li>
												<?if (is_array($arItem["DISPLAY_PROPERTIES"]["COUNTRY"]["DISPLAY_VALUE"])):?>
													<?=implode(", ", $arItem["DISPLAY_PROPERTIES"]["COUNTRY"]["DISPLAY_VALUE"]);?>
												<?else:?>
													<?print_r ($arItem["DISPLAY_PROPERTIES"]["COUNTRY"]["DISPLAY_VALUE"]);?>
												<?endif;?>
											</li>
											<?endif;?>
											<?if ($arItem["DISPLAY_PROPERTIES"]["TOWN"]["VALUE"]!=""):?>
											<li>
													<?if (is_array($arItem["DISPLAY_PROPERTIES"]["TOWN"]["DISPLAY_VALUE"])):?>
														<?=substr(implode(" - ", $arItem["DISPLAY_PROPERTIES"]["TOWN"]["DISPLAY_VALUE"]), 0, 680) . '...';?>
													<?else:?>, 
					 									<?print_r ($arItem["DISPLAY_PROPERTIES"]["TOWN"]["DISPLAY_VALUE"]);?>
													<?endif;?>
											</li>
											<?endif;?>
											<?if(!empty($arItem["PROPERTIES"]["DEPARTURE"]["VALUE"])):?>
											<li>
												<?  $spisok='';
													foreach ($arItem["PROPERTIES"]["DEPARTURE"]["VALUE"] as $dates) 
													{ 
														if (strtotime($dates)>strtotime($today))
														{ $spisok .= substr($dates,0,10).'; ';}              
													}  
													$string = substr($spisok, 0, 22);
													if (iconv_strlen ($spisok)>22):
													echo $string."??? ";
													else: 
													echo $string;
													endif;
													?>
											</li>
											<?endif;?>
											<?if(!empty($arItem["PROPERTIES"]["PRICE"]["VALUE"])):?><li><b>??????????????????</b> <? echo $arItem["PROPERTIES"]["PRICE"]["VALUE"];?> <?=strip_tags($arItem["DISPLAY_PROPERTIES"]["CURRENCY"]["DISPLAY_VALUE"])?></li><?endif;?>
										</ul>
										<div class="blog-entry">  
											<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
													<?echo $arItem["PREVIEW_TEXT"];?>
											<?else:?>
													<?echo $arItem["DETAIL_TEXT"];?>
											<?endif;?>
											<?if(!empty($arItem["PROPERTIES"]["FILE"]["VALUE"])):?>
											<br><b>?????????? ?????? ????????????????????</b>
												<p><?if (is_array($arItem["DISPLAY_PROPERTIES"]["FILE"]["DISPLAY_VALUE"])):?><?echo implode(" | ", $arResult["PROPERTIES"]["FILE"]["VALUE"]);?><?else:?><?echo $arResult["DISPLAY_PROPERTIES"]["FILE"]["DISPLAY_VALUE"];?><?endif;?></p>
											<?endif;?>										
										</div>
										<a href="<? echo $arItem['DETAIL_PAGE_URL']; ?>" class="btn-blog">?????????????????? <i class="fa fa-long-arrow-right"></i></a>
									</div>
								
								</div>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
