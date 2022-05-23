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
<table class="table">
  <thead>
    <tr>
      <th>Дата</th>
      <th>Доллар США</th>
      <th>Евро</th>
      <th>Рос. рубль</th>
    </tr>
  </thead>
  <tbody>
    <?
    $dbCurrency = CIBlockElement::GetList(false, array("IBLOCK_ID" => Set::CURRENCY_IBLOCK_ID), false, false, array('ID', 'PROPERTY_ISO', 'PROPERTY_COMMISSION'));
    $arCurrencies = array();

    while ($arCurrency = $dbCurrency->Fetch()) {

     $arCurrencies[$arCurrency['PROPERTY_ISO_VALUE']] = $arCurrency['PROPERTY_COMMISSION_VALUE'];
   }

   foreach ($arResult["ITEMS"] as $arItem):?>
     <?
     $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
     $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
     ?>
     <tr>
      <td><?print_r ($arItem["NAME"]);?></td>
      <td><?=round($arItem["PROPERTIES"]["USD"]["VALUE"],4)?> бел. руб</td>
      <td><?=round($arItem["PROPERTIES"]["EUR"]["VALUE"],4)?> бел. руб</td>
      <td><?=round($arItem["PROPERTIES"]["RUB"]["VALUE"],4)?> бел. руб</td>
    </tr>
    <?endforeach?>
  </tbody>
</table>
