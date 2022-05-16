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
<div class="team-wrapper">
	<div class="row">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
								<div class="col-xss-12 col-xs-6 col-sm-4 mv-15">
									<div class="team-item">
										<div class="image">
											<?$file_big=CFile::ResizeImageGet($arItem["PROPERTIES"]["PICTURES"]["VALUE"][0], Array('width'=>150, 'height'=>150),BX_RESIZE_IMAGE_EXACT,true);?>
											<img src="<?=$file_big["src"];?>" alt="<?echo $arItem["NAME"]?>" class="img-circle">
										</div>
										<div class="content">
											<h5 class="uppercase"><?echo $arItem["NAME"]?></h5>
											<?if (!empty($arItem["DISPLAY_PROPERTIES"]["POSITION"]["DISPLAY_VALUE"])):?><p><?=$arItem["PROPERTIES"]["POSITION"]["VALUE"]?></p><?endif;?>
											<?if (!empty($arItem["DISPLAY_PROPERTIES"]["COUNTRY"]["DISPLAY_VALUE"])):?>
											<p>
												<?if (is_array($arItem["DISPLAY_PROPERTIES"]["COUNTRY"]["DISPLAY_VALUE"])):?>
													<?=implode(", ", $arItem["DISPLAY_PROPERTIES"]["COUNTRY"]["DISPLAY_VALUE"]);?>
												<?else:?>
													<?print_r ($arItem["DISPLAY_PROPERTIES"]["COUNTRY"]["DISPLAY_VALUE"]);?>
												<?endif;?>
											</p>
											<?endif;?>
											<?if (!empty($arItem["PROPERTIES"]["PHONE"]["VALUE"])):?><p><?=$arItem["PROPERTIES"]["PHONE"]["VALUE"]?></p><?endif;?>
											<?if (!empty($arItem["PROPERTIES"]["SKYPE"]["VALUE"])):?><p><?=$arItem["PROPERTIES"]["SKYPE"]["VALUE"]?></p><?endif;?>
											<?if (!empty($arItem["PROPERTIES"]["ICQ"]["VALUE"])):?><p><?=$arItem["PROPERTIES"]["ICQ"]["VALUE"]?></p><?endif;?>
											<?if (!empty($arItem["PROPERTIES"]["EMAIL"]["VALUE"])):?><p><?=$arItem["PROPERTIES"]["EMAIL"]["VALUE"]?></p><?endif;?>
											<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>" class="btn btn-primary btn-gallery">Подробнее</a>
										</div>
									</div>
								</div>
<?endforeach;?>

							</div>
						<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
						</div>