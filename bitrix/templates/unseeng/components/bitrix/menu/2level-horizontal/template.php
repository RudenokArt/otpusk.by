<?//$prov=CModule::IncludeModuleEx("simai.special");if($prov==0||$prov==3)return;?><?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>

<style>
	.svg-menu{
		width: 20px;
		margin-top: 5px;
	}

	.mobile-menu__button{
		float: right;
		margin-bottom: 10px;
	}
    .mobile-menu__button:hover > svg{
        fill:white;
    }
</style>


<?
$svg = '<svg class="svg-menu" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 129 129">
  <g>
    <path class="svg-path" d="m121.3,34.6c-1.6-1.6-4.2-1.6-5.8,0l-51,51.1-51.1-51.1c-1.6-1.6-4.2-1.6-5.8,0-1.6,1.6-1.6,4.2 0,5.8l53.9,53.9c0.8,0.8 1.8,1.2 2.9,1.2 1,0 2.1-0.4 2.9-1.2l53.9-53.9c1.7-1.6 1.7-4.2 0.1-5.8z"/>
  </g>
</svg>';

?>

<?if (!empty($arResult)):?>
<a class="btn btn-navbar text-uppercase visible-xs mobile-menu__button link-button" data-toggle="collapse" data-target="mob-menu2">

    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/></svg>

</a>
<nav class="dmr-menu" style="clear: both">
<ul class="menu mob-menu hidden-xs">
<?
$previousLevel = 0;
foreach($arResult as $arItem):?>

	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>

	<?if ($arItem["IS_PARENT"]):?>

		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			<li><a class="is-parent" href="<?=$arItem["LINK"]?>" tabindex="1"><?=$arItem["TEXT"]?> <span class="open-status"><?=$svg?></span></a>
				<ul class="sub-menu">
		<?else:?>
			<li><a href="<?=$arItem["LINK"]?>" tabindex="1"><?=$arItem["TEXT"]?></a>
				<ul class="sub-menu">
		<?endif?>

	<?else:?>

		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			<li><a href="<?=$arItem["LINK"]?>" tabindex="1"><?=$arItem["TEXT"]?></a></li>
		<?else:?>
			<li><a href="<?=$arItem["LINK"]?>" tabindex="1"><?=$arItem["TEXT"]?></a></li>
		<?endif?>

	<?endif?>

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?endforeach?>

<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?endif?>
</ul>
</nav>
<script>
	$(document).ready(function(){
		var isOpen = false;
		$('[data-target="mob-menu2"]').click(function(){
			$('.mob-menu').toggleClass('block');
			isOpen = !isOpen;
			/*if (isOpen){
				$(this).text('<?=GetMessage("HIDE_MENU")?>');
			}
			else{
				$(this).text('<?=GetMessage("SHOW_MENU")?>');
			}*/
		})

		/****************************/

		$('.is-parent').click(function(e){
			e.preventDefault();
			//$(this).toggleClass('sub-visible');
		})

	})
</script>
<?endif?>