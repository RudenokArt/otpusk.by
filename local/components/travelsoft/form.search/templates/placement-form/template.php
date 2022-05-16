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

if (empty($arResult['SEARCH'])) return;
if ($USER->isAdmin() && $arParams['SECTION_ID'] == "167")
	dmtf($arResult);
?>
<div class="form-wrapper">
    <?/*if ($USER->isAdmin())
	dm($arResult["ADDITIONAL_SEARCH"]);*/?>
	<form data-json-links='<?= $arResult['JSON_LINKS_CONTAINER']?>' class="mastertour" method='GET' action="<?= $arResult['QUERY_ADDRESS']?>">

		<div class="column-item">
			<span class='tt hide-767'>Куда</span>
			<div class="form-group">
			
				<select required name="id" class="select2-single form-control" data-placeholder="Введите название, город">
					<option></option>
                    <?foreach($arResult['ADDITIONAL_SEARCH'] as $code => $val):?>
                        <?$arr = array('COUNTRY' => "Страна", "TOWN" => "Город")?>
                        <?foreach($val as $id => $vv):?>
                            <option <?if($code == "TOWN"):?>data-type="city"<?elseif($code == "COUNTRY"):?>data-type="country"<?endif?> value="<? if(!empty($vv['PROPERTY_MT_HOTELKEY_VALUE'])){ echo $vv['PROPERTY_MT_HOTELKEY_VALUE'];} else {echo $vv['PROPERTY_CN_KEY_VALUE'];}?>"><?= $vv['NAME'] . ((!empty($arr[$code])) ? " (" . $arr[$code] . ")" : "" )?></option>
                        <?endforeach?>
                    <?endforeach?>
					<?foreach($arResult['SEARCH'] as $id => $val):?>
						<?/*option value="<?= urlencode($val['PROPERTY_MT_HOTELKEY_VALUE'])?>"><?= $val['NAME'] . "(" . $val['PROPERTY_TYPE_ID_VALUE'] . ($arResult['ADDITIONAL_SEARCH']['TOWN'][$val['PROPERTY_TOWN_VALUE']]['NAME'] != "" ? ", " . $arResult['ADDITIONAL_SEARCH']['TOWN'][$val['PROPERTY_TOWN_VALUE']]['NAME'] : "") . ")"?></option */?>
						<option value="<?= urlencode($val['PROPERTY_MT_HOTELKEY_VALUE'])?>"><?= $val['NAME']?><? if(!empty($val['PROPERTY_CAT_ID_VALUE'])) {echo " ".$val['PROPERTY_CAT_ID_VALUE'];}?><? echo ", " . ($arResult['ADDITIONAL_SEARCH']['TOWN'][$val['PROPERTY_TOWN_VALUE']]['NAME'] != "" ? $arResult['ADDITIONAL_SEARCH']['TOWN'][$val['PROPERTY_TOWN_VALUE']]['NAME'] : "") . ", " . ($arResult['ADDITIONAL_SEARCH']['COUNTRY'][$val['PROPERTY_COUNTRY_VALUE']]['NAME'] != "" ? $arResult['ADDITIONAL_SEARCH']['COUNTRY'][$val['PROPERTY_COUNTRY_VALUE']]['NAME'] : "") . ""?></option>
					<?endforeach?>
				</select>

			</div>
		
		</div>

		<div class="column-item">
		<span class='tt hide-767'>Заезд</span>
		
			<input required placeholder="Дата заезда" type="text" name="CheckIn">	
		
		</div>
		
		<div class="column-item dcc">
		<span class='tt hide-767'>Выезд</span>
			
			<input required placeholder="Дата выезда" type="text" name="CheckOut">
		
		</div>
		
		<div class="column-item">
		<span class='tt hide-767'>Кто едет</span>
			<div class="form-group">
			
				<div class="people-container">
					<div class="adults">Взрослых: 2</div>
					<div class="children">Детей: 0</div>

					<div class="people-hide-container">
						<div class="first"><span>Взрослых </span> <br> <!--input name="ad" value='<?= $arResult['adults']?>'-->

						<select name="Adults" class="select2-single" data-placeholder="Взрослых">
							<option></option>
							<?for($i = 1; $i<=6; $i++):?>
								<option <?if($i==2):?>selected<?endif?> value="<?= $i?>"><?= $i?></option>
							<?endfor?>
						</select>
					</div>
						<div class="second"><span>Детей </span> <br> <!--input name="ch" value='<?= $arResult['children']?>'-->
							<select name="Children" class="select2-single" data-placeholder="Детей">
							<option></option>
							<?for($i = 0; $i<=4; $i++):?>
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
			
				<button type='submit' class="search-ti btn btn-primary btn-block" onclick="ga('send', 'event', 'button', 'click', 'FindMainPage'); yaCounter1028882.reachGoal('FindMainPage'); return true;" >Искать</button>
				
			</div>
		
		</div>
	
	</form>
</div>