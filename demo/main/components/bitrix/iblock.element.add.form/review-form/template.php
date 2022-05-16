<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
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
$this->setFrameMode(false);

//dm($arResult);
if($arParams['LINK_ELEMENT_ID'] <= 0)
{
	ShowError("В настройках компонента не указана (или указана неправильно, должно быть число) привязка к элементу для которого нужно оставить отзыв");
	return;
}
?>
<div class="col-md-9">

	<?if (is_array($arResult["PROPERTY_LIST"]) && !empty($arResult["PROPERTY_LIST"])):?>

		<div id="leave-comment" class="detail-content">

			<div class="section-title text-left">
				<h4>Оставьте Ваш отзыв</h4>
			</div>

			<div class="review-form">

				<?if (!empty($arResult["ERRORS"])):?>
				<?ShowError(implode("<br />", $arResult["ERRORS"]))?>
				<?endif;
				if (strlen($arResult["MESSAGE"]) > 0):?>
				<?ShowNote($arResult["MESSAGE"])?>
				<?endif?>

				<form action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
					<?=bitrix_sessid_post()?>
					
					<div class="row">
			
			<?foreach ($arResult["PROPERTY_LIST"] as $propertyID):?>
				
				<?
					$req = "";
					if(in_array($propertyID, $arResult['PROPERTY_REQUIRED']))
						$req = "required";
				?>
				
				<?if($arResult['PROPERTY_LIST_FULL'][$propertyID]['CODE'] == "ELEMENT_ID"):?>
					
					<input <?=$req?> name="PROPERTY[<?=$propertyID?>][0]" value="<?= (int)$arParams["LINK_ELEMENT_ID"]?>" type="hidden">

				<?elseif($propertyID == "NAME"):?>

						<div class="col-sm-6 col-md-4">

							<div class="form-group">
								<label><?if (intval($propertyID) > 0):?><?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"]?><?else:?><?=!empty($arParams["CUSTOM_TITLE_".$propertyID]) ? $arParams["CUSTOM_TITLE_".$propertyID] : GetMessage("IBLOCK_FIELD_".$propertyID)?><?endif?></label>
								<input <?=$req?> type="text" name="PROPERTY[<?=$propertyID?>][0]" class="form-control" />
							</div>

						</div>
						<div class="clear"></div>

				<?elseif($arResult['PROPERTY_LIST_FULL'][$propertyID]['CODE'] == "EMAIL"):?>
															
															
						<div class="col-sm-6 col-md-4">

							<div class="form-group">
								<label><?if (intval($propertyID) > 0):?><?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"]?><?else:?><?=!empty($arParams["CUSTOM_TITLE_".$propertyID]) ? $arParams["CUSTOM_TITLE_".$propertyID] : GetMessage("IBLOCK_FIELD_".$propertyID)?><?endif?></label>
								<input <?=$req?> type="email" name="PROPERTY[<?=$propertyID?>][0]" class="form-control" />
							</div>

						</div>

						<div class="clear"></div>

				<?elseif($arResult['PROPERTY_LIST_FULL'][$propertyID]['CODE'] == "RATING"):?>			

						<div class="col-sm-6 col-md-4">

							<div class="form-group">
								<label><?if (intval($propertyID) > 0):?><?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"]?><?else:?><?=!empty($arParams["CUSTOM_TITLE_".$propertyID]) ? $arParams["CUSTOM_TITLE_".$propertyID] : GetMessage("IBLOCK_FIELD_".$propertyID)?><?endif?></label>
								<div class="rating-wrapper">
									<div class="raty-wrapper">
										<div class="star-rating" data-rating-score="0"></div>
									</div>
								</div>
							</div>

							<script type="text/javascript">
								// Default size star 
								$.fn.raty.defaults.path = '/bitrix/templates/main/images/raty';
								$('.star-rating').raty({
									round : { down: .2, full: .6, up: .8 },
									half: true,
									space: false,
									scoreName: "PROPERTY[<?=$propertyID?>][0]",
									score: function() {
										return $(this).attr('data-rating-score');
									}
								});
							</script>

						</div>
						<div class="clear"></div>

				<?/*elseif($arResult['PROPERTY_LIST_FULL'][$propertyID]['CODE'] == "MORE_PHOTO"):?>

					<?$iN = $arResult['PROPERTY_LIST_FULL'][$propertyID]['MULTIPLE_CNT'];?>
					
					<div class="col-sm-6 col-md-4">

							<div class="form-group">
								<label><?if (intval($propertyID) > 0):?><?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"]?><?else:?><?=!empty($arParams["CUSTOM_TITLE_".$propertyID]) ? $arParams["CUSTOM_TITLE_".$propertyID] : GetMessage("IBLOCK_FIELD_".$propertyID)?><?endif?></label>


					<?for ($i = 0; $i < $iN; $i++):?>
						<input type="hidden" name="PROPERTY[<?=$propertyID?>][<?= $i?>]" value="" />
						<input <?=$req?> type="file" name="PROPERTY_FILE_<?=$propertyID?>_<?= $i?>" class="form-control" /> <br>
					<?endfor?>

							</div>

					</div>
					<div class="clear"></div>
				*/?>
				<?elseif($propertyID == "DETAIL_TEXT"):?>

						<div class="col-sm-12 col-md-8">

							<div class="form-group">
								<label><?if (intval($propertyID) > 0):?><?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"]?><?else:?><?=!empty($arParams["CUSTOM_TITLE_".$propertyID]) ? $arParams["CUSTOM_TITLE_".$propertyID] : GetMessage("IBLOCK_FIELD_".$propertyID)?><?endif?></label>
								<textarea name="PROPERTY[<?=$propertyID?>][0]" class="form-control form-control-sm" rows="5"></textarea>
							</div>
						</div>

						<div class="clear"></div>

						<div class="col-sm-12 col-md-8 mt-10">
						<input class="btn btn-primary" type="submit" name="iblock_submit" value="Отправить" />
						</div>

				<?endif?>	

			<?endforeach?>

					</div>
			
				</form>

			</div>

		</div>
	<?endif?>

</div>
