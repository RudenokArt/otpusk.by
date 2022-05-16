<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
			<input id="min-filter-price" name="<?= $arResult['ITEMS'][230]['VALUES']['MIN']['CONTROL_NAME']?>" type="hidden" value="<?= (int)$arResult["ITEMS"][230]["VALUES"]["MIN"]["VALUE"]?>">
			<input id="max-filter-price" name="<?= $arResult['ITEMS'][230]['VALUES']['MAX']['CONTROL_NAME']?>" type="hidden" value="<?= (int)$arResult["ITEMS"][230]["VALUES"]["MAX"]["VALUE"]?>">
		</div>
	</div>
<? endif;?>
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
			<input id="min-filter-duration" name="<?= $arResult['ITEMS'][375]['VALUES']['MIN']['CONTROL_NAME']?>" type="hidden" value="<?=$min?>">
			<input id="max-filter-duration" name="<?= $arResult['ITEMS'][375]['VALUES']['MAX']['CONTROL_NAME']?>" type="hidden" value="<?=$max?>">
		</div>
	</div>
<? endif;?>

	<div class="sidebar-module">
	
		<h6 class="sidebar-title">Объект</h6>
		<div class="sidebar-module-inner">

		<?//Узнаём id только бел-их отелей
		$arBelHotels = array();
		$arFilter = Array("IBLOCK_ID" => 18, "ACTIVE"=>"Y", "PROPERTY_COUNTRY" => 69);
		$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_HOTEL");
		$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, $arSelect);
		while($ar_fields = $res->GetNext())
		{
			$arBelHotels[] = $ar_fields["PROPERTY_HOTEL_VALUE"][0];
		}

		$arBelHotels = array_unique($arBelHotels);
		?>

		<?foreach($arResult["ITEMS"]["103"]["VALUES"] as $id => $vv):?>

			<? if(in_array($id, $arBelHotels)): ?>
               <div class="checkbox-block">

                    <input id="<?= $vv['CONTROL_ID']?>" name="<?= $vv['CONTROL_NAME']?>" type="checkbox" <?if($vv['CHECKED']):?>checked<?endif?> class="checkbox" value="<?= $vv['HTML_VALUE']?>"/>
                    <label class="" for="<?= $vv['CONTROL_ID']?>"><?= $vv['VALUE']?><span class="checkbox-count"><?if((int)$arResult["GROUPS"]["103"][$id]):?>(<?= $arResult["GROUPS"][$v[0]][$id]?>)<?endif?></span></label>

                </div>
			<? endif; ?>
		<?endforeach?>	

		</div>
	
	</div>


</form>
</div>
