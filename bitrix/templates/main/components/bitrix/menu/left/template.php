<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if(!empty($arResult)):?>

	<?if($arParams['FILTER_CONSISTING'] != "Y"):?>
	<div class="col-sm-4 col-md-3">					
		<aside class="sidebar">
	<?endif?>	

		<div class="sidebar-inner no-border for-static-page">
		
			<div class="sidebar-module">
			
				<ul class="static-page-menu">

				<?foreach($arResult as $i):?>

					<li <?if($i["SELECTED"]):?>class="active"<?endif?> ><a <?if (isset($i["PARAMS"]["rel"])):?>rel="nofollow"<?endif?> href="<?= $i["LINK"]?>"><?= $i["TEXT"]?></a></li>
									
				<?endforeach?>

				</ul>

			</div>
		
		</div>

	<?if($arParams['FILTER_CONSISTING'] != "Y"):?>		
		</aside>
        <? if (preg_match("/\/tury\/rannee-bronirovanie\/.*/", $_SERVER["SCRIPT_URL"])): ?>
            <div class="sidebar-box">
                <? $APPLICATION->IncludeComponent("bitrix:advertising.banner", "", Array(
                        "TYPE" => "BOTTOM",
                        "CACHE_TYPE" => "A",
                        "NOINDEX" => "Y",
                        "CACHE_TIME" => "3600"
                    )
                ); ?>
            </div>
        <? endif; ?>
	</div>
	<?endif?>

<?endif?>