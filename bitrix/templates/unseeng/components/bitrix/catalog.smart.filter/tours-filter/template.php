<?$prov=CModule::IncludeModuleEx("simai.special");if($prov==0||$prov==3)return;?><?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//dm($arResult["ITEMS"])?>

<div class="sidebar-header clearfix">
	<h4>Фильтр</h4>
	<?if($arParams['HIDE_RESET_IN_FILTER'] !== 'Y'):?>
		<a href="#" class="sidebar-reset-filter"><i class="fa fa-times"></i> сбросить фильтр</a>
	<?endif?>
</div>

<div class="sidebar-inner">

<form action="<?= $APPLICATION->GetCurDir()?>" id="catalog-form">
<input name="set_filter" value="Y" type="hidden">
<?
// Цена для туров
if(isset($arResult["ITEMS"][230]["VALUES"])):?>
	<div class="sidebar-module">
		<h6 class="sidebar-title">Цена</h6>
		<div class="sidebar-module-inner">
			<input data-from="<?= (int)$arResult["ITEMS"][230]["VALUES"]["MIN"]["VALUE"]?>" data-to="<?= (int)$arResult["ITEMS"][230]["VALUES"]["MAX"]["VALUE"]?>" data-min="<?= (int)$arResult["ITEMS"][230]["VALUES"]["MIN"]["VALUE"]?>" data-max="<?= (int)$arResult["ITEMS"][230]["VALUES"]["MAX"]["VALUE"]?>" id="price_range" />
			<input id="min-filter-price" name="<?= $arResult['ITEMS'][230]['VALUES']['MIN']['CONTROL_NAME']?>" type="hidden">
			<input id="max-filter-price" name="<?= $arResult['ITEMS'][230]['VALUES']['MAX']['CONTROL_NAME']?>" type="hidden">
		</div>
	</div>
<?endif?>
<? ///// ?>

<?
// Продолжительность для туров
if(isset($arResult["ITEMS"][375]["VALUES"])):?>
	<div class="sidebar-module">
		<h6 class="sidebar-title">Продолжительность <small><?if($arParams['DURATION_TITLE'] != ""): echo $arParams['DURATION_TITLE'];else:?>ночей<?endif?></small></h6>
		<div class="sidebar-module-inner">
			<?$max =  $arParams['DURATION_TITLE'] != "" ? (int)$arResult["ITEMS"][375]["VALUES"]["MAX"]["VALUE"] + 1 : (int)$arResult["ITEMS"][375]["VALUES"]["MAX"]["VALUE"]?>
			<?$min =  $arParams['DURATION_TITLE'] != "" ? (int)$arResult["ITEMS"][375]["VALUES"]["MIN"]["VALUE"] + 1 : (int)$arResult["ITEMS"][375]["VALUES"]["MIN"]["VALUE"]?>
			<input data-from="<?= $min?>" data-to="<?= $max?>" data-min="<?= $min?>" data-max="<?= $max?>" id="duration_range" />
			<input id="min-filter-duration" name="<?= $arResult['ITEMS'][375]['VALUES']['MIN']['CONTROL_NAME']?>" type="hidden">
			<input id="max-filter-duration" name="<?= $arResult['ITEMS'][375]['VALUES']['MAX']['CONTROL_NAME']?>" type="hidden">
		</div>
	</div>
<?endif;?>

	<div class="clear"></div>
<?
// св-ва привязки к элементам для отелей, туров и тд.
$a = array(
		array(95, "Страна", ($arParams['HIDE_COUNTRY_IN_FILTER'] === 'Y' ? 1 : 0)),
		array(96, "Город или курорт"),
		array(61, "Страны", ($arParams['HIDE_COUNTRY_IN_FILTER'] === 'Y' ? 1 : 0)),
		array(376, "Область"),
		array(62, "Города"),
		array(204, "Страна"),
		array(167, "Медицинский профиль"),
		array(82, 'Услуга'),
		array(250, 'Страна'),
		array(251, 'Город'),
		array(309, 'Тип достопримечательности'),
		array(56, 'Страна'),
		array(57, 'Город'),
		array(242, 'Тип экскурсии'),
		array(243, 'Тема'),
		array(244, 'Транспорт'),
		array(336, 'Страна'),
		array(335, 'Город'),
        array(182, 'Пункт отправления'),
        array(464, 'Раннее Бронирование'),
        array(465, 'С отдыхом на море'),
        array(214, 'Подразделение'),
	);

$arr = array(96, 62, 251, 57, 335, 376);
$arr_cities = array(96,62,251,57,335);
foreach($a as $v):

	if(isset($arResult["ITEMS"][$v[0]]) && !empty($arResult["ITEMS"][$v[0]]['VALUES'])):?>
	
	<div class="sidebar-module<?if(in_array($v[0], $arr)):?> must-show<?if($v[0] == 376):?> region<?endif?><?if(in_array($v[0], $arr_cities)):?> cities<?endif?><?endif?>" <?if(in_array($v[0], $arr) || $v[2] === 1):?>style="display: none"<?endif?> >
	
		<h6 class="sidebar-title"><?= $v[1]?></h6>
		<div class="sidebar-module-inner">

		<?foreach($arResult["ITEMS"][$v[0]]["VALUES"] as $id => $vv):?>
			
			<?if($id == 69 && $arParams["IBLOCK_ID"] == Set::SPECIAL_OFF_IBLOCK_ID):?>

            <?else:?>

                <div class="checkbox-block<?if($v[0] == $arResult["customs_params"][$arParams["IBLOCK_ID"]][1] || $v[0] == $arResult["customs_params"][$arParams["IBLOCK_ID"]][2] || in_array($v[0], $arr)) echo ' city country-' . $arResult["c_links"][$id]?>">

                    <input <?if($v[0] == $arResult["customs_params"][$arParams["IBLOCK_ID"]][0] || in_array($v[0], array(95, 61, 204, 250, 56, 336))) echo "class='show-city' data-id='". $id ."'"?> id="<?= $vv['CONTROL_ID']?>" name="<?= $vv['CONTROL_NAME']?>" type="checkbox" <?if($vv['CHECKED']):?>checked<?endif?> class="checkbox" value="<?= $vv['HTML_VALUE']?>"/>
                    <label class="" for="<?= $vv['CONTROL_ID']?>"><?if($v[0] == 464 || $v[0] == 465):?>Да<?else:?><?= $vv['VALUE']?><?endif?><span class="checkbox-count"><?if((int)$arResult["GROUPS"][$v[0]][$id]):?>(<?= $arResult["GROUPS"][$v[0]][$id]?>)<?endif?></span></label>

                </div>

            <?endif?>
		
		<?endforeach?>	

		</div>
	
	</div>
	
	<?endif?>
	
	<div class="clear"></div>
<?endforeach?>



<?
// Тип тура, тип трпнспорта для туров
$a = array();

if($arParams['HIDE_TOURTYPE_IN_FILTER'] != "Y")
	$a[] = array(101, "Тип тура");

if($arParams['HIDE_TRANSPORT_IN_FILTER'] != "Y")
	$a[] = array(102, "Тип транспорта");

if($arParams['SHOW_TYPE_OF_EXCURSIONS'] == "Y")
	$a[] = array(233, "Тип экскурсии");

$a[] = array(63, 'Категория');

foreach($a as $v):

	if(isset($arResult["ITEMS"][$v[0]]) && !empty($arResult["ITEMS"][$v[0]]['VALUES'])):?>
	<div class="sidebar-module">
	
		<h6 class="sidebar-title"><?= $v[1]?></h6>
		<div class="sidebar-module-inner">
		<?$f = true;// dm($arResult["ITEMS"][$v[0]]['VALUES']);
		foreach($arResult["ITEMS"][$v[0]]["VALUES"] as $vv):?>
			<?if($f):?>

			<select name="<?= $vv["CONTROL_NAME_ALT"]?>" class="select2-single form-control" data-placeholder="Выберите">
				<option value=""></option>
			<?endif;$f = false;?>
			
				<option <?if($vv['CHECKED']):?>selected<?endif?> value="<?= $vv["HTML_VALUE_ALT"]?>"><?= $vv["VALUE"]?></option>

		<?endforeach?>
		<?if(!$f):?>
			
			</select>
			
		<?endif;?>
		</div>

	</div>
<?
	endif;
endforeach?>
<?


// даты для туров
if($arResult["ITEMS"][97]["VALUES"]):?>
	<div class="sidebar-module">
	
		<h6 class="sidebar-title">Дата начала:</h6>
		<div class="sidebar-module-inner">
		<?$d = date("d.m.Y", time())?>
			<i class="calendar-icon filter-calendar-icon filter-calendar-icon click_datepicker_from"></i>
			<input class="form-control" id="date-filter-from" value="<?= (isset($arResult["ITEMS"][97]["VALUES"]["MIN"]['HTML_VALUE'])) ? $arResult["ITEMS"][97]["VALUES"]["MIN"]['HTML_VALUE'] : $d?>" <?if(isset($arResult["ITEMS"][97]["VALUES"]["MIN"]['HTML_VALUE'])):?>value="<?= $arResult["ITEMS"][97]["VALUES"]["MIN"]['HTML_VALUE']?>"<?endif?> name="<?= $arResult["ITEMS"][97]["VALUES"]["MIN"]["CONTROL_NAME"]?>">
		</div>
		
	</div>
	<div class="clear"></div>

	<div class="sidebar-module">
		<h6 class="sidebar-title">Дата окончания:</h6>
		<div class="sidebar-module-inner">
		<?$d = date("d.m.Y", (int)$arResult["ITEMS"][97]["VALUES"]["MAX"]["VALUE"])?>
			<i class="calendar-icon filter-calendar-icon filter-calendar-icon click_datepicker_to"></i>
			<input class="form-control" id="date-filter-to" <?if(isset($arResult["ITEMS"][97]["VALUES"]["MAX"]['HTML_VALUE'])):?>value="<?= $arResult["ITEMS"][97]["VALUES"]["MAX"]['HTML_VALUE']?>"<?endif?> name="<?= $arResult["ITEMS"][97]["VALUES"]["MAX"]["CONTROL_NAME"]?>">
		</div>
		
	</div>
	<div class="clear"></div>
<?endif?>

 <?
 // Типы акций
 if(isset($arResult["ITEMS"][207]["VALUES"])):?>
	<div class="sidebar-module">
	
		<h6 class="sidebar-title">Тип акции</h6>
		<div class="sidebar-module-inner">
		<?$f = true;
		foreach($arResult["ITEMS"][207]["VALUES"] as $vv):?>
			<?if($f):?>

			<select name="<?= $vv["CONTROL_NAME_ALT"]?>" class="select2-single form-control" data-placeholder="Выберите">
				<option value=""></option>
			<?endif;$f = false;?>
			
				<option <?if($vv['CHECKED']):?>selected<?endif?> value="<?= $vv["HTML_VALUE_ALT"]?>"><?= $vv["VALUE"]?></option>

		<?endforeach?>
		<?if(!$f):?>
			
			</select>
			
		<?endif;?>
		</div>

	</div>
<?endif?>

</form>
</div>
