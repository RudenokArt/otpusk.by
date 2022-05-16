<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}
?>
<div class="pager-wrappper clearfix">
	<div class="pager-innner">
		<div class="flex-row flex-align-middle">
<?

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
?>
	<div class="flex-column flex-sm-12"><?=GetMessage("pages", array("#f#" => $arResult["NavFirstRecordShow"], "#t#" => $arResult["NavLastRecordShow"], "#tt#" => $arResult["NavRecordCount"]))?></div>
		<div class="flex-column flex-sm-12">
			<nav class="pager-right">
				<ul class="pagination">
<?
	$bFirst = true;

	if ($arResult["NavPageNomer"] > 1):
		if($arResult["bSavePage"]):
?>
			<li>
				<a data-page="<?=($arResult["NavPageNomer"]-1)?>" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>" aria-label="Previous">
					<span aria-hidden="true"><?=GetMessage("nav_prev")?></span>
				</a>
			</li>
<?
		else:
			if ($arResult["NavPageNomer"] > 2):
?>
			<li>
				<a data-page="<?=($arResult["NavPageNomer"]-1)?>" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>" aria-label="Previous">
					<span aria-hidden="true"><?=GetMessage("nav_prev")?></span>
				</a>
			</li>
<?
			else:
?>
			<li>
				<a data-page="" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>" aria-label="Previous">
					<span aria-hidden="true"><?=GetMessage("nav_prev")?></span>
				</a>
			</li>
<?
			endif;
		
		endif;
		
		if ($arResult["nStartPage"] > 1):
			$bFirst = false;
			if($arResult["bSavePage"]):
?>
			<li><a data-page="1" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1">1</a></li>
<?
			else:
?>
			<li><a data-page="1" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>">1</a></li>
<?
			endif;
			if ($arResult["nStartPage"] > 2):
/*?>
			<span class="modern-page-dots">...</span>
<?*/
?>
			<li><span>...</span></li>
<?
			endif;
		endif;
	endif;

	do
	{
		if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):
?>
		<li class="active"><a><?=$arResult["nStartPage"]?></a></li>
<?
		elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):
?>
		<li><a data-page="1" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$arResult["nStartPage"]?></a></li>
<?
		else:
?>
		<li><a data-page="<?=$arResult["nStartPage"]?>" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$arResult["nStartPage"]?></a></li>
<?
		endif;
		$arResult["nStartPage"]++;
		$bFirst = false;
	} while($arResult["nStartPage"] <= $arResult["nEndPage"]);
	
	if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):
		if ($arResult["nEndPage"] < $arResult["NavPageCount"]):
			if ($arResult["nEndPage"] < ($arResult["NavPageCount"] - 1)):
/*?>
		<span class="modern-page-dots">...</span>
<?*/
?>
		<li><span>...</span></li>
<?
			endif;
?>
		<li><a data-page="<?=$arResult["NavPageCount"]?>" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>"><?=$arResult["NavPageCount"]?></a></li>
<?
		endif;
?>
		<li>
			<a data-page="<?=($arResult["NavPageNomer"]+1)?>" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>" aria-label="Next">
				<span aria-hidden="true"><?=GetMessage("nav_next")?></span>
			</a>
		</li>
<?
	endif;
?>
		
					</ul>
				</nav>
			</div>
		</div>
	</div>
</div>
