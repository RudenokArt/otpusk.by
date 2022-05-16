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
$cities = \Bitrix\Main\Web\Json::encode($arResult["city"]);
$countries = \Bitrix\Main\Web\Json::encode($arResult["country"]);
$countries_ = \Bitrix\Main\Web\Json::encode($arResult["country_"]);
$search = \Bitrix\Main\Web\Json::encode($arResult["filter"]);

?>
<div class="form-wrapper">
	<form class="tourindex" method='GET' action="<?= $arResult['action_url']?>">
	
			<input type="hidden" value="<?= isset($arResult['countries'][$arParams['COUNTRY_FROM']]) ? $arResult['countries'][$arParams['COUNTRY_FROM']]['ti'] : -1?>" name="ti">
		
		<div class="column-item">
		<span class='tt'>Откуда</span>
			<div class="form-group">
			
				<select name="ct" class="select2-multi form-control" data-placeholder="Откуда">
					<option></option>
					<?foreach($arResult['cities'] as $id => $val):?>
						<option <?if($val['selected']):?>selected<?endif?> value="<?= $id?>"><?= $val['name']?></option>
					<?endforeach?>
				</select>

			</div>
		
		</div>

		<div class="column-item">
		<span class='tt'>Куда</span>
			<div class="form-group">
			
				<select name="co" class="select2-multi form-control" data-placeholder="Куда">
					<option></option>
					<?foreach($arResult['filter'][$arParams["CITY_FROM"]] as $id => $val):?>
						<option <?if($arResult["countries"][$id]['selected']):?>selected<?endif?> value="<?= $id?>"><?= $arResult["countries"][$id]['name']?></option>
					<?endforeach?>
				</select>

			</div>
		
		</div>

		<div class="column-item">
		<span class='tt'>Дата вылета</span>
			<div class="form-group pos-rel">
				<input name='days' checked type="checkbox" value="Y"/><label class="days-checker" for="days">+/-3</label>
				<div class='date-container'>

					<div data-def-date="<?= ($arParams['DATE_FROM'] != "") ? $arResult['date'] : '+7d'?>" class="days-text"><?= $arResult['date']?></div>
					<div class="night-text">Ночей: <?= $arResult['night']['from']?> - <?= $arResult['night']['to']?></div>

					<input type='hidden' name='df' value="<?= $arResult['date_from']?>">
					<input type='hidden' name='dt' value="<?= $arResult['date_to']?>">
					
					<div class="white"></div>
					<div class="nights">
						<span>Ночей с</span>
						<select class="select2-multi" name='nf'>
							<?for($i = 1; $i <= $arResult['night']['max']; $i++):?>
								<option <?if($i == $arResult['night']['from']):?>selected<?endif?> value="<?= $i?>"><?= $i?></option>
							<?endfor?>
						</select>
						<span>по</span>
						<select class="select2-multi" name='nt'>
							<?for($i = 1; $i <= $arResult['night']['max']; $i++):?>
								<option <?if($i == $arResult['night']['to']):?>selected<?endif?> value="<?= $i?>"><?= $i?></option>
							<?endfor?>
						</select>
						<button class='btn-primary closeDatePicker'>OK</button>
					</div>
				</div>
			</div>
		
		</div>
		
		<div class="column-item">
		<span class='tt'>Кто едет</span>
			<div class="form-group">
			
				<div class="people-container">
					<div class="adults">Взрослых: 2</div>
					<div class="children">Детей: 0</div>

					<div class="people-hide-container">
						<div class="first"><span>Взрослых </span> <br> <!--input name="ad" value='<?= $arResult['adults']?>'-->

						<select name="ad" class="select2-multi" data-placeholder="Взрослых">
							<option></option>
							<?for($i = 1; $i<=$arResult['adults']; $i++):?>
								<option <?if($i==2):?>selected<?endif?> value="<?= $i?>"><?= $i?></option>
							<?endfor?>
						</select>
					</div>
						<div class="second"><span>Детей </span> <br> <!--input name="ch" value='<?= $arResult['children']?>'-->
							<select name="ch" class="select2-multi" data-placeholder="Детей">
							<option></option>
							<?for($i = 0; $i<=$arResult['children']; $i++):?>
								<option <?if($i==0):?>selected<?endif?> value="<?= $i?>"><?= $i?></option>
							<?endfor?>
						</select>
						</div>
					</div>
				</div>

				
				
			</div>
		
		</div>

		<div class="column-item for-btn">
		<div class="opacity"></div>
			<div class="form-group">
			
				<button type='submit' class="search-ti btn btn-primary btn-block" onclick="ga('send', 'event', 'button', 'click', 'FindMainPage'); yaCounter1028882.reachGoal('FindMainPage'); return true;"
>Искать</button>
				
			</div>
		
		</div>
	</form>
</div>

<script type="text/javascript">
    var bx_counties_ti = '<?=$countries_?>', bx_search_ti = '<?=$search?>', bx_cities_ti = '<?=$cities?>';
    bx_search_ti = JSON.parse(bx_search_ti);
    bx_counties_ti = JSON.parse(bx_counties_ti);
    bx_cities_ti = JSON.parse(bx_cities_ti);

    $("form.tourindex").on("submit", function () {
        if($(".tourindex select[name='ct']").val() == ""){
            return false;
        }else if($(".tourindex select[name='co']").val() == "" || $(".tourindex select[name='co']").val() == null){
            return false;
        }
    });

</script>