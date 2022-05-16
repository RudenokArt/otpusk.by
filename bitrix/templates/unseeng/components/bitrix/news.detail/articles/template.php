<?$prov=CModule::IncludeModuleEx("simai.special");if($prov==0||$prov==3)return;?><?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="col-md-9" role="main">
<?
$h1 = $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] != "" ? $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] : $arResult['NAME'];
?>
	<div class="detail-content-wrapper">
		<h1 id="section-0"  style="margin-bottom: 30px"><?= $h1;?></h1>
	</div>

   <?if($arResult['TI_COKEY']> 0):?>
        <div class="section-title text-left">
            <h4>Форма поиска тура</h4>
        </div>
<?
/////////////////////////// форма поиска для туриндекса ///////////////////////////////////    
$APPLICATION->IncludeComponent(
"travelsoft:tour.index.search.form", 
"inner-search-form", 
array(
"COMPONENT_TEMPLATE" => "search-form",
"CITY_FROM" => "1863",
"COUNTRY_FROM" => $arResult['TI_COKEY'],
"DATE_FROM" => "",
"DATE_TO" => "",
"NIGHT_FROM" => "7",
"NIGHT_TO" => "14",
"ACTION_URL" => "/tury/avia-tury/"
),
false
);
///////////////////////////////////////////////////////////////////////////////////////////
?>
<?endif?>
   
   <?if($arResult['avia']):?>
      <div class="detail-content">
         <div class="section-title text-left">
            <h4>Авиабилеты</h4>
         </div>
         <div class="GridLex-gap-20-wrappper package-grid-item-wrapper on-page-result-page alt-smaller">
            <div class="GridLex-grid-noGutter-equalHeight">
            <ul>
            <?foreach($arResult['avia'] as $av):?>
               <li><a target="__blank" href="<?= $av["PAGE"]?>"><?= $av['NAME']?></a></li>
            <?endforeach?>
            </ul>
            </div>
         </div>
      </div>
    <?endif?>

   <?if($arResult['offers']):?>
      <div class="detail-content">
         <div class="section-title text-left">
            <h4>Предложения</h4>
         </div>
         <div class="GridLex-gap-20-wrappper package-grid-item-wrapper on-page-result-page alt-smaller">
            <div class="GridLex-grid-noGutter-equalHeight">
               <?foreach($arResult['offers'] as $o):?>
               <div class="GridLex-col-4_sm-4_xs-12 mb-20">
                  <div class="package-grid-item">
                     <a href="<?= $o['PAGE']?>">
                        <div class="image">
                           <img src="<?= $o['PIC']?>" alt="<?= $o['NAME']?>" />
                           <?if($o['DAYS'] > 0):?>
                              <div class="absolute-in-image">
                                 <div class="duration"><span><?= $o['DAYS']?> <?= $o['NIGHT']?></span></div>
                              </div>
                           <?endif?>
                        </div>
                        <div class="content clearfix">
                           <h6><?= $o['NAME']?></h6>
                           <?if($o['PRICE']!=""):?>
                              <div class="absolute-in-content">
                                 <div class="price"><?= $o['PRICE']?></div>
                              </div>
                           <?endif?>
                        </div>
                     </a>
                  </div>
               </div>
               <?endforeach?>
            </div>
         </div>
      </div>
    <?endif?>

   <?if(!empty($arResult['DISPLAY_PROPERTIES']['TOP_TEXT']["DISPLAY_VALUE"])):?>
      <div class="text-left">            
         <div class="detail-content">
            <?echo $arResult['DISPLAY_PROPERTIES']['TOP_TEXT']["DISPLAY_VALUE"];?>
         </div>      
      </div>
   <?endif?>

    <?if($arResult['hotels']):?>
      <div id="section-10" class="detail-content">
         <div class="section-title text-left">
            <h4>Размещение</h4>
         </div>
         <?
            $scroll[] = array("section-10", "Размещение");
            ?>
         <div class="hotel-item-wrapper">
            <div class="row gap-1">
               <?foreach($arResult['hotels'] as $h):?>
               <div class="col-sm-xss-12 col-xs-6 col-sm-4 col-md-4">
                  <div class="hotel-item mb-1">
                  <?if($h['TYPE'] == 'Cанаторий')
                        $h['PAGE'] = str_replace("/oteli/", "/sanatorii/", $h['PAGE']);?>
                     <a href="<?= $h['PAGE']?>">
                        <div class="image">
                           <img src="<?= $h['PIC']?>" alt="<?= $h['NAME']?>" />
                        </div>
                        <div class="content">
                           <h6><?= $h['NAME'] ." ". $h['CATEGORY'] . "<br><span class='city-in-h6'>". $h['TOWN'] ."</span>"?></h6>
                        </div>
                     </a>
                  </div>
               </div>
               <?endforeach?>
            </div>
         </div>
      </div>
    <?endif?>



	<div class="text-left">
		<?if(!empty($arResult["DETAIL_TEXT"])):?>		
		<div class="detail-content">
			<?echo $arResult['DETAIL_TEXT'];?>
		</div>
		<?endif?>
	</div>

	<?if(!empty($arResult['articles'])):?>

	<div id="section-8" class="detail-content">
		<div class="section-title text-left">
			<h4>Дополнительная информация</h4>
		</div>
		<?$str = array();
		foreach($arResult['articles'] as $a)
			$str[] = "<a href='" . $a['CODE'] . "/'>" .$a['NAME'] . "</a>";
		echo implode(", ", $str);?>
	</div>

	<?endif?>
</div>
<?if(!empty($arResult['right_menu'])):?>
<div class="col-sm-3 hidden-sm hidden-xs">

	<div class="scrolly scrollspy-sidebar sidebar-detail" role="complementary">

		<ul class="scrollspy-sidenav">

			<li>
				<ul class="nav">
					<?foreach($arResult['right_menu'] as $s):?>
					<li><a href="<?= $s['PAGE']?>"><?= $s['NAME']?></a></li>
					<?endforeach?>
				</ul>
			</li>

		</ul>
		
		<div style="width: 100%; height: 20px;"></div>
		
	</div>

</div>
<?endif?>
