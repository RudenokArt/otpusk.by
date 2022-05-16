<? //if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
<? $cities = \Bitrix\Main\Web\Json::encode($arResult["city"]);
$countries = \Bitrix\Main\Web\Json::encode($arResult["country"]);
$search = \Bitrix\Main\Web\Json::encode($arResult["filter"]);
$dates = \Bitrix\Main\Web\Json::encode($arResult['dates']); ?>
<div class="form-wrapper">
    <form class="busmaster" method='GET' action="<?= $arResult['action_url'] ?>" autocomplete="off">

        <div class="column-item" style="width: 25% !important;">
            <span class='hide-767 tt'>Откуда</span>
            <div class="form-group">

                <select style="width: 100% !important" name="ct" class="select2-multi form-control"
                        data-placeholder="Откуда" required>
                    <option></option>
                    <? foreach ($arResult['cities'] as $id => $val): ?>
                        <option <? if ($val['selected']): ?>selected<? endif ?>
                                value="<?= $id ?>"><?= $val['name'] ?></option>
                    <? endforeach ?>
                </select>

            </div>

        </div>

        <div class="column-item" style="width: 25% !important;">
            <span class='hide-767 tt'>Куда</span>
            <div class="form-group">

                <select style="width: 100% !important" name="co" class="select2-multi form-control"
                        data-placeholder="Куда" required>
                    <? /*foreach($arResult['countries'] as $id => $val):*/ ?><!--
						<option <? /*if($val['selected']):*/ ?>selected<? /*endif*/ ?> value="<? /*= $id*/ ?>"><? /*= $val['name']*/ ?></option>
					--><? /*endforeach*/ ?>
                </select>

            </div>

        </div>

        <div class="column-item" style="width: 25% !important;">
            <span class='hide-767 tt'>Месяц выезда</span>
            <div class="form-group pos-rel">
                <? $arResult['nameMonth'] = Array(
                    '01' => 'Январь',
                    '02' => 'Февраль',
                    '03' => 'Март',
                    '04' => 'Апрель',
                    '05' => 'Май',
                    '06' => 'Июнь',
                    '07' => 'Июль',
                    '08' => 'Август',
                    '09' => 'Сентябрь',
                    '10' => 'Октябрь',
                    '11' => 'Ноябрь',
                    '12' => 'Декабрь'
                ) ?>
                <? for ($i = date('m'); $i < date('m') + 10; $i++){
                    $selected = false;
                    if($i == date('n')){
                        $selected = true;
                    }
                    $year = date('Y');
                    $month = $i % 13;
                    if(floor($i / 13) > 0){
                        $month += 1;
                        $year += 1;
                    }
                    if($month < 10){
                        $month = '0'.$month;
                    }
                    $arResult['month']['01.'.$month.'.'.$year] = Array('selected' => $selected, 'name' => $arResult['nameMonth'][$month] .' '. $year);
                }?>
                <select style="width: 100% !important" name="df" class="select2-multi form-control"
                        data-placeholder="Выберите месяц" required>
                    <? foreach ($arResult['month'] as $id => $val): ?>
                        <option <? if ($val['selected']): ?>selected<? endif ?>
                                value="<?= $id ?>"><?= $val['name'] ?></option>
                    <? endforeach ?>
                </select>

                <?/*<input type='hidden' name='df' value="<?= $arResult['date_from'] ?>">*/?>
                <input type='hidden' name='dt' value="<?= $arResult['date_to'] ?>">
                <input type='hidden' name='nf' value="1">
                <input type='hidden' name='nt' value="31">

            </div>
        </div>

        <?/*<div class="column-item hide-767">
           <span class='hide-767 tt'>Кто едет</span>
            <div class="form-group">

                <div class="people-container">
                    <div class="adults">Взрослых: 2</div>
                    <div class="children">Детей: 0</div>

                    <div class="people-hide-container">
                        <div class="first"><span>Взрослых </span> <br>
                            <!--input name="ad" value='<?= $arResult['adults'] ?>'-->

                            <select name="ad" class="select2-multi" data-placeholder="Взрослых">
                                <option></option>
                                <? for ($i = 1; $i <= $arResult['adults']; $i++): ?>
                                    <option <? if ($i == 2): ?>selected<? endif ?> value="<?= $i ?>"><?= $i ?></option>
                                <? endfor ?>
                            </select>
                        </div>
                        <div class="second"><span>Детей </span> <br>
                            <!--input name="ch" value='<?= $arResult['children'] ?>'-->
                            <select name="ch" class="select2-multi" data-placeholder="Детей">
                                <option></option>
                                <? for ($i = 0; $i <= $arResult['children']; $i++): ?>
                                    <option <? if ($i == 0): ?>selected<? endif ?> value="<?= $i ?>"><?= $i ?></option>
                                <? endfor ?>
                            </select>
                        </div>
                    </div>
                </div>


            </div>

        </div>*/?>

        <div class="column-item for-btn" style="width: 25% !important;">
            <div class="opacity"></div>
            <div class="form-group">

                <input type='submit' id="busmaster-submit" class="search-ti btn btn-primary btn-block" value="Искать">

            </div>

        </div>
    </form>
</div>

<script type="text/javascript">
    var bx_buscounties = '<?=$countries?>', bx_bussearch = '<?=$search?>', bx_busdates = '<?=$dates?>',
        bx_buscities = '<?=$cities?>';
    bx_bussearch = JSON.parse(bx_bussearch);
    bx_buscounties = JSON.parse(bx_buscounties);
    bx_busdates = JSON.parse(bx_busdates);
    bx_buscities = JSON.parse(bx_buscities);

    //console.log(bx_bussearch);
    //console.log(bx_buscounties);
    //console.log(bx_buscities);

    $("form.busmaster").on("submit", function () {
        if ($(".busmaster select[name='ct']").val() == "") {
            return false;
        } else if ($(".busmaster select[name='co']").val() == "" || $(".busmaster select[name='co']").val() == null) {
            return false;
        }
    });

</script>