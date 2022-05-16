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
<div class="form-wrapper">
    <form class="busmaster" method='GET' action="<?= $arResult['action_url'] ?>" autocomplete="off">

        <div class="column-item">
            <span class='hide-767 tt'>Откуда</span>
            <div class="form-group">
                <select title="Откуда" style="width: 100% !important" name="townForm" class="select2-multi form-control" data-placeholder="Откуда" data-no-result=""  required>
                    <option></option>
                    <? foreach ($arResult['dates'] as $id => $val): ?>
                        <option data-id="<?=$id?>" value="<?= $arResult['cities'][$id]['CODE'] ?>"><?= $arResult['cities'][$id]['NAME'] ?></option>
                    <? endforeach ?>
                </select>
            </div>
        </div>

        <div class="column-item">
            <span class='hide-767 tt'>Куда</span>
            <div class="form-group">
                <select title="Куда" style="width: 100% !important" name="countryTo" class="select2-multi form-control" data-placeholder="Куда" data-no-result="Выберите город отправления." required>
                    <option></option>
                    <?/* foreach ($arResult['countries'] as $id => $val): */?><!--
                        <option value="<?/*= $val["CODE"] */?>"><?/*= $val['NAME'] */?></option>
                    --><?/* endforeach */?>
                </select>
            </div>
        </div>

        <div class="column-item">
            <span class='hide-767 tt'>Месяц выезда</span>
            <div class="form-group pos-rel">
                <select title="Месяц выезда" style="width: 100% !important" name="arrFilter_97_MIN" class="select2-multi form-control" data-placeholder="Выберите месяц" data-no-result="Выберите город оправления и страну прибытия." required>
                    <?/* foreach ($arResult['month'] as $id => $val): */?><!--
                        <option <?/* if ($val['selected']): */?>selected<?/* endif */?> value="<?/*= $id */?>"><?/*= $val['name'] */?></option>
                    --><?/* endforeach */?>
                </select>
            </div>
        </div>

        <div class="column-item holiday">
            <span class='hide-767 tt'></span>
            <div class="form-group pos-rel">
                <input name="arrFilter_465_2184750849" type="checkbox" value="Y">
                <label class="days-checker text" for="arrFilter_465_2184750849">с отдыхом на море</label>
            </div>
        </div>

        <input type='hidden' id="city" value="Y"/>
        <input type='hidden' id="country" value="Y"/>

        <input type='hidden' name='arrFilter_97_MAX' value="<?= $arResult['date_to'] ?>"/>

        <input type="hidden" name="set_filter" value="Y"/>
        <!-- Автобусный тур -->
        <input type="hidden" name="arrFilter_101" value="1292844536"/>

        <div class="column-item for-btn">
            <div class="opacity"></div>
            <div class="form-group">
                <input type='submit' id="busmaster-submit" class="search-ti btn btn-primary btn-block" value="Искать">
            </div>
        </div>

    </form>
</div>
<script>
    var bx_dates_bus = <?=\Bitrix\Main\Web\Json::encode($arResult['dates'])?>;
    var bx_cities_bus = <?=\Bitrix\Main\Web\Json::encode($arResult['cities'])?>;
    var bx_countries_bus = <?=\Bitrix\Main\Web\Json::encode($arResult['countries'])?>;
</script>