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
<?$cities = \Bitrix\Main\Web\Json::encode($arResult["city"]);
$countries = \Bitrix\Main\Web\Json::encode($arResult["country"]);
$search = \Bitrix\Main\Web\Json::encode($arResult["filter"]);
$dates = \Bitrix\Main\Web\Json::encode($arResult['dates']);?>
<div class="form-wrapper">
	<form class="master" method='GET' action="<?= $arResult['action_url']?>" autocomplete="off">

		<div class="column-item">
		<span class='hide-767 tt'>Откуда</span>
			<div class="form-group">
			
				<select style="width: 100% !important" name="ct" class="select2-multi form-control" data-placeholder="Откуда" required>
					<option></option>
					<?foreach($arResult['cities'] as $id => $val):?>
						<option <?if($val['selected']):?>selected<?endif?> value="<?= $id?>"><?= $val['name']?></option>
					<?endforeach?>
				</select>

			</div>
		
		</div>

		<div class="column-item">
		<span class='hide-767 tt'>Куда</span>
			<div class="form-group">
			
				<select style="width: 100% !important" name="co" class="select2-multi form-control" data-placeholder="Куда" data-no-result="Введите город вылета." required>
					<?/*foreach($arResult['countries'] as $id => $val):*/?><!--
						<option <?/*if($val['selected']):*/?>selected<?/*endif*/?> value="<?/*= $id*/?>"><?/*= $val['name']*/?></option>
					--><?/*endforeach*/?>
				</select>

			</div>
		
		</div>

		<div class="column-item">
		<span class='hide-767 tt'>Дата вылета</span>
			<div class="form-group pos-rel">
				<input name='days' checked type="checkbox" value="Y"/><label class="days-checker" for="days">+/-3 дня</label>
				<div class='master-date-container'>

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
		
		<div class="column-item hide-767">
		<span class='hide-767 tt'>Кто едет</span>
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

                            <div style="clear: both"></div>
                            <div class="kids-block">
                                <span>Возраст детей </span> <br>
                                <div class="kids-item">
                                    <select name="age1" class="select2-multi" data-placeholder="(1)" disabled>
                                        <option></option>
                                        <?for($i = 0; $i<=17; $i++):?>
                                            <option value="<?= $i?>"><?= $i?></option>
                                        <?endfor?>
                                    </select>
                                </div>
                                <div class="kids-item">
                                    <select name="age2" class="select2-multi" data-placeholder="(2)" disabled>
                                        <option></option>
                                        <?for($i = 0; $i<=17; $i++):?>
                                            <option value="<?= $i?>"><?= $i?></option>
                                        <?endfor?>
                                    </select>
                                </div>
                                <div class="kids-item">
                                    <select name="age3" class="select2-multi" data-placeholder="(3)" disabled>
                                        <option></option>
                                        <?for($i = 0; $i<=17; $i++):?>
                                            <option value="<?= $i?>"><?= $i?></option>
                                        <?endfor?>
                                    </select>
                                </div>
                            </div>

					</div>
				</div>

				
				
			</div>
		
		</div>

		<div class="column-item for-btn">
		<div class="opacity"></div>
			<div class="form-group">
			
				<input type='submit' id="master-submit" class="search-ti btn btn-primary btn-block" value="Искать">
				
			</div>
		
		</div>
	</form>
</div>

<script type="text/javascript">
    var bx_counties = '<?=$countries?>', bx_search = '<?=$search?>', bx_dates = '<?=$dates?>', bx_cities = '<?=$cities?>';
    bx_search = JSON.parse(bx_search);
    bx_counties = JSON.parse(bx_counties);
    bx_cities = JSON.parse(bx_cities);
    bx_dates = JSON.parse(bx_dates);

    $('select[name="ch"]').on("change", function () {
        var ch = $("select[name='ch']").val();

        if(ch > 0) {

            for (var i = 1; i <= ch; i++) {
                $('select[name="age' + i + '"]').prop('disabled', false);
            }

        } else {

            $('select[name^="age"]').prop('disabled', true);

        }
    });

    $("form.master").on("submit", function () {
        if($(".master select[name='ct']").val() == ""){
            return false;
        }else if($(".master select[name='co']").val() == "" || $(".master select[name='co']").val() == null){
            return false;
        }
    });

</script>