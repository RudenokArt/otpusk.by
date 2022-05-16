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
$cur = getCurrenty();
if (empty($arResult['SEARCH'])) return;
//dm($arResult);
?>
<div class="form-wrapper">
	<form data-json-links='<?= $arResult['JSON_LINKS_CONTAINER']?>' class="tourindex" method='GET' action="<?= $arResult['ACTION_FORM']?>">
	<input type="hidden" value="<?= $arParams['MT_KEY']?>" name="id">	
	<div class="row">
		
		<div class="column-item col-md-3">
		<span class='tt'>Заезд</span>
		
			<input required type="text" name="CheckIn" <?if ($arResult['DEFAULT']['CHECKIN'] != ""):?>value="<?= htmlspecialchars($arResult['DEFAULT']['CHECKIN'])?>"<?endif?>>	
		
		</div>

		<div class="column-item col-md-3">
		<span class='tt'>Выезд</span>
			
			<input required type="text" name="CheckOut" <?if ($arResult['DEFAULT']['CHECKOUT'] != ""):?>value="<?= htmlspecialchars($arResult['DEFAULT']['CHECKOUT'])?>"<?endif?>>
		
		</div>
		
		<div class="column-item col-md-3">
		<span class='tt'>Кто едет</span>
			<div class="form-group">
			
				<div class="people-container">
					<div class="adults">Взрослых: <?= $arResult['DEFAULT']['ADULTS']?></div>
					<div class="children">Детей: <?= $arResult['DEFAULT']['CHILDREN']?></div>

					<div class="people-hide-container">
						<div class="first"><span>Взрослых </span> <br> <!--input name="ad" value='<?= $arResult['adults']?>'-->

						<select name="Adults" class="select2-single" data-placeholder="Взрослых">
							<option></option>
							<?for($i = 1; $i<=6; $i++):?>
								<option <?if($i == $arResult['DEFAULT']['ADULTS']):?>selected<?endif?> value="<?= $i?>"><?= $i?></option>
							<?endfor?>
						</select>
					</div>
						<div class="second"><span>Детей </span> <br> <!--input name="ch" value='<?= $arResult['children']?>'-->
							<select name="Children" class="select2-single" data-placeholder="Детей">
							<option></option>
							<?for($i = 0; $i<=4; $i++):?>
								<option <?if($i == $arResult['DEFAULT']['CHILDREN']):?>selected<?endif?> value="<?= $i?>"><?= $i?></option>
							<?endfor?>
							</select>
						</div>
					</div>
				</div>

				
				
			</div>
		
		</div>

		<div class="column-item for-btn col-md-3">
		<div class="opacity"></div>
			<div class="form-group">
			
				<button type='submit' class="search-ti btn btn-primary btn-block">Искать</button>
				
			</div>
		
		</div>

		<? $priceTypeName = "price_type"; $submitFormClass = "submit-form"?>
		<?if (count($arResult['PRICE_FOR_THE_CITIZENS']) >1):?>
			<div class="column-item col-md-3" style="margin-bottom: 30px">
			<span class='tt'>Тип цены</span>
                <?if(isset($_SESSION["current_currency"]) && $_SESSION["current_currency"] == $cur["RUB"] && !isset($_GET["price_type"])){
                    $arResult['DEFAULT']['PRICE_TYPE'] = 1;
                } elseif(isset($_GET["price_type"])) {
                    $arResult['DEFAULT']['PRICE_TYPE'] = $_GET["price_type"];
                } ?>
			<select style="font-size: 12px" name="<?= $priceTypeName?>" class="<?= $submitFormClass?> form-control" data-placeholder="Тип цены">
				<?foreach ($arResult['PRICE_FOR_THE_CITIZENS'] as $val => $title):?>
                    <??>
					<option <?if ($val == $arResult['DEFAULT']['PRICE_TYPE']):?>selected<?endif?> value="<?= $val?>"><?= $title?></option>
				<?endforeach?>
			</select>
			</div>
			<div class="clear"></div>
			<script>
			(function ($) {
				$(document).on('change', '.<?= $submitFormClass?>', function () {
					$(this).closest('form').submit();
				});
			})(jQuery);
			</script>
		<?else:?>
			<input type="hidden" name="<?= $priceTypeName?>" value="0">
		<?endif?>

	</div>	
	</form>
</div>
