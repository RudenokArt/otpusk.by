<?$prov=CModule::IncludeModuleEx("simai.special");if($prov==0||$prov==3)return;?><?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
									<div class="blog-media">
											<?$file_big=CFile::ResizeImageGet($arResult["PROPERTIES"]["PICTURES"]["VALUE"][0], Array('width'=>800, 'height'=>800),BX_RESIZE_IMAGE_EXACT,true);?>
											<img src="<?=$file_big["src"];?>" alt="<?echo $arResult["NAME"]?>" class="">
									</div>
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
													<?else:?>, 
					 									<?print_r ($arResult["DISPLAY_PROPERTIES"]["TOWN"]["DISPLAY_VALUE"]);?>
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
										</ul>
										<div class="blog-entry">  
											<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["PREVIEW_TEXT"]):?>
													<?echo $arResult["PREVIEW_TEXT"];?>
											<?else:?>
													<?echo $arResult["DETAIL_TEXT"];?>
											<?endif;?>
											<?if(!empty($arResult["PROPERTIES"]["FILE"]["VALUE"])):?>
											<h5>Файлы для скачивания</h5>
												<p><?if (is_array($arResult["DISPLAY_PROPERTIES"]["FILE"]["DISPLAY_VALUE"])):?><?echo implode(" | ", $arResult["PROPERTIES"]["FILE"]["VALUE"]);?><?else:?><?echo $arResult["DISPLAY_PROPERTIES"]["FILE"]["DESCRIPTION"];?> <?echo $arResult["DISPLAY_PROPERTIES"]["FILE"]["DISPLAY_VALUE"];?><?endif;?></p>
											<?endif;?>	
											<?if (!empty($arResult["PROPERTIES"]["PRICE_INCLUDE"]["VALUE"])):?>
												<h5>В стоимость входит</h5>
												<div class="blockquote">
													<?=htmlspecialcharsBack($arResult["PROPERTIES"]["PRICE_INCLUDE"]["VALUE"]["TEXT"])?>
												</div>		
											<?endif;?>
											<?if (!empty($arResult["PROPERTIES"]["PRICE_NO_INCLUDE"]["VALUE"])):?>
												<h5>В стоимость не входит</h5>
												<div class="blockquote">
													<?=htmlspecialcharsBack($arResult["PROPERTIES"]["PRICE_NO_INCLUDE"]["VALUE"]["TEXT"])?>
												</div>		
											<?endif;?>								
										</div>
									</div>
	</div>
</div>