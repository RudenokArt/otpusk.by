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

        <div class="column-item" style="width: 25% !important;">
            <span class='hide-767 tt'>Откуда</span>
            <div class="form-group">
                <select title="Откуда" style="width: 100% !important" name="townForm" class="select2-multi form-control" data-placeholder="Откуда" required>
                    <option></option>
                    <? foreach ($arResult['cities'] as $id => $val): ?>
                        <option value="<?= $val['CODE'] ?>"><?= $val['NAME'] ?></option>
                    <? endforeach ?>
                </select>
            </div>
        </div>

        <div class="column-item" style="width: 25% !important;">
            <span class='hide-767 tt'>Куда</span>
            <div class="form-group">
                <select title="Куда" style="width: 100% !important" name="countryTo" class="select2-multi form-control" data-placeholder="Куда" required>
                    <option></option>
                    <? foreach ($arResult['countries'] as $id => $val): ?>
                        <option value="<?= $val["CODE"] ?>"><?= $val['NAME'] ?></option>
                    <? endforeach ?>
                </select>
            </div>
        </div>

        <div class="column-item" style="width: 25% !important;">
            <span class='hide-767 tt'>Месяц выезда</span>
            <div class="form-group pos-rel">
                <select title="Месяц выезда" style="width: 100% !important" name="arrFilter_97_MIN" class="select2-multi form-control" data-placeholder="Выберите месяц" required>
                    <? foreach ($arResult['month'] as $id => $val): ?>
                        <option <? if ($val['selected']): ?>selected<? endif ?> value="<?= $id ?>"><?= $val['name'] ?></option>
                    <? endforeach ?>
                </select>
            </div>
        </div>

        <input type='hidden' id="city" value="Y"/>
        <input type='hidden' id="country" value="Y"/>

        <input type='hidden' name='arrFilter_97_MAX' value="<?= $arResult['date_to'] ?>"/>

        <input type="hidden" name="set_filter" value="Y"/>
        <!-- Автобусный тур -->
        <input type="hidden" name="arrFilter_101" value="1292844536"/>

        <div class="column-item for-btn" style="width: 25% !important;">
            <div class="opacity"></div>
            <div class="form-group">
                <input type='submit' id="busmaster-submit" class="search-ti btn btn-primary btn-block" value="Искать">
            </div>
        </div>

    </form>
</div>