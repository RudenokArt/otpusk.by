<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
	<?
	foreach($arResult as $arItem):
	?>	
		<li class="hidden-sm hidden-xs"><a href="<?=$arItem["LINK"]?>" class="user-action<?if($arItem["SELECTED"]):?> selected<?endif?>"><?=$arItem["TEXT"]?></a></li>
	<?endforeach?>
<?endif?>