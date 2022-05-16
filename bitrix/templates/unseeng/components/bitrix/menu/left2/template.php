<?$prov=CModule::IncludeModuleEx("simai.special");if($prov==0||$prov==3)return;?><?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="container" style="margin-bottom: 15px">
	<div class="row">
<?if(!empty($arResult)):?>
<h5>Смотрите также:</h5>
			<ul class="static-page-menu-2">
				<?foreach($arResult as $i):?>

					<li <?if($i["SELECTED"]):?>class="active"<?endif?> ><a href="<?= $i["LINK"]?>"><?= $i["TEXT"]?></a><li>
									
				<?endforeach?>
			</ul>
<?endif?>
	</div>
</div>