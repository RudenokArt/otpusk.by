<?$prov=CModule::IncludeModuleEx("simai.special");if($prov==0||$prov==3)return;?><?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();
//dm($arResult['ITEMS']);
$s_p_url = "/tury/";
$s_id = rand(0, 9999999999999999);
?>
<?\Bitrix\Main\Loader::includeModule('travelsoft.currency');?>
<section class="bg-light">
			
	<div class="container">
	
		<div class="row">
			
			<div class="col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
				
				<div class="section-title">

					<h3><?= $arParams["SO_TITLE"]?></h3>
						<p></p>
						
						<div class="sorting-middle-holder">
							<ul class="sort-by s-id-<?= $s_id?>">
								<?if(count($arResult["COUNTRIES"]) > 1):?>
									<?foreach($arResult["COUNTRIES"] as $id => $n):?>
										<li><a data-cid="<?= $id?>" class="sof-<?= $s_id?>" data-group=".gc-<?= $s_id?>-<?= $id?>" href="#"><?= $n?></a></li>
									<?endforeach?>
								<?endif?>
								<li><a href="<?= $s_p_url?>" class="btn_blue_p5">Все предложения</a></li>
							</ul>
						</div>
						
						<p></p>
				</div>
				
			</div>
		
		</div>
		
		<div class="GridLex-gap-30-wrappper package-grid-item-wrapper">
			
			<div id="grid-<?= $s_id?>" class="GridLex-grid-noGutter-equalHeight  ajax-<?= $s_id?>">
			<?foreach($arResult["ITEMS"] as $i):

				$this->AddEditAction($i['ID'], $i['EDIT_LINK'], CIBlock::GetArrayByID($i["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($i['ID'], $i['DELETE_LINK'], CIBlock::GetArrayByID($i["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => "Подтверждение"));

				$d_g = array();
				foreach($i["DISPLAY_PROPERTIES"]["COUNTRY"]["VALUE"] as $v)
				{
					$d_g[] = "gc-" . $s_id . "-" .$v;
				}
				$d_g[] = "all-" . $s_id;
				$d_g = implode(" ", $d_g);
			?>
				<div id="<?=$this->GetEditAreaId($i['ID']);?>" class="filtering-item GridLex-col-3_sm-6_xs-12 mb-30 <?= $d_g?>">
					<div class="package-grid-item"> 
						<a href="<?= $i["DETAIL_PAGE_URL"]?>">
							<div class="image">
								<?if($i["PREVIEW_PICTURE"]["RESIZE_SRC"]):?>
									<img src="<?= $i["PREVIEW_PICTURE"]["RESIZE_SRC"]?>" alt="<?= $i["NAME"]?>" />
								<?elseif (!empty($i["PROPERTIES"]["PICTURES"]["VALUE"][0])):
								$file = CFile::ResizeImageGet($i["PROPERTIES"]["PICTURES"]["VALUE"][0], array('width'=>600, 'height'=>400), BX_RESIZE_IMAGE_EXACT, true);
								$src=$file['src'];?>
									<img src="<?= $src?>" alt="<?= $i["NAME"]?>" />
								<?else:?>
									<img src="<?= Set::NO_PHOTO?>" alt="<?= $i["NAME"]?>" />
								<?endif?>
								<?= printTourLabel($i['PROPERTIES'])?>
								<?if($i['PROPERTIES']['DAYS']['VALUE']):?>
								<div class="absolute-in-image">
									<div class="duration"><span><?= w($i['PROPERTIES']['DAYS']['VALUE'])?> / <?= w($i['PROPERTIES']['DAYS']['VALUE'], 2)?></span></div>
								</div>
								<?endif?>
							</div>
							<div class="content clearfix">
								<?$title = $i['NAME'];
								$i['NAME'] = strlen($i['NAME']) > 37 ? substr($i['NAME'], 0, 38) . '...' : $i['NAME'];?>
								<h5 style="min-height: 40px; margin: 0" title="<?= $title?>"><?= $i["NAME"]?></h5>
								<div class="content-text"><?
									$i['DISPLAY_PROPERTIES']["DEPARTURE"]["DISPLAY_VALUE"] = (array)$i['DISPLAY_PROPERTIES']["DEPARTURE"]["DISPLAY_VALUE"];
									$res = array();
									if(!empty($i['DISPLAY_PROPERTIES']["DEPARTURE"]["DISPLAY_VALUE"]))
									{

										foreach($i['DISPLAY_PROPERTIES']["DEPARTURE"]["DISPLAY_VALUE"] as $k => $t)
										{
											if(($k + 1) > 3) break;
											$res[] = ConvertDateTime($t, "DD.MM.YYYY", "ru");
										}
									}	 
										echo implode(',', $res).'<br>';
									$res = array();
									$i['DISPLAY_PROPERTIES']["COUNTRY"]["DISPLAY_VALUE"] = (array)$i['DISPLAY_PROPERTIES']["COUNTRY"]["DISPLAY_VALUE"];
									if(!empty($i['DISPLAY_PROPERTIES']["COUNTRY"]["DISPLAY_VALUE"]))
										$res[] = current($i['DISPLAY_PROPERTIES']["COUNTRY"]["DISPLAY_VALUE"]);
									$i['DISPLAY_PROPERTIES']["TOWN"]["DISPLAY_VALUE"] = (array)$i['DISPLAY_PROPERTIES']["TOWN"]["DISPLAY_VALUE"];
									if( !empty($i['DISPLAY_PROPERTIES']["TOWN"]["DISPLAY_VALUE"]) )
										$res[] = current($i['DISPLAY_PROPERTIES']["TOWN"]["DISPLAY_VALUE"]);
									echo implode(", ", array_map(function($it){ return strip_tags($it); }, $res)); ?>
								</div>
								<a href="<?= $i["DETAIL_PAGE_URL"]?>" class="btn_blue_p6" style="float: right;">Заказать тур</a>
								<?if((int)$i["DISPLAY_PROPERTIES"]["PRICE"]["VALUE"] > 0):?>
								<div style='top: -50px' class="absolute-in-content">
									<!--span class="btn"><i class="fa fa-heart-o"></i></span-->
									<div class="price" style="line-height:12px;">
									<span style="font-weight:normal; font-size:12px;">от</span>
                                        <?= \travelsoft\Currency::getInstance()->convertCurrency(
                                            $i["DISPLAY_PROPERTIES"]["PRICE"]["VALUE"], $i["DISPLAY_PROPERTIES"]["CURRENCY"]['VALUE']
                                        );?>
                                        <?/*= convert_currency($i["DISPLAY_PROPERTIES"]["PRICE"]["VALUE"], $i["DISPLAY_PROPERTIES"]["CURRENCY"]['VALUE']);*/?><!--
										<?/*if($i["DISPLAY_PROPERTIES"]["CURRENCY"]['VALUE'] != 62):*/?>
										<span style="font-weight:normal; font-size:12px;"> (<?/*= $i["DISPLAY_PROPERTIES"]["PRICE"]["VALUE"] .' '. strip_tags($i["DISPLAY_PROPERTIES"]["CURRENCY"]['DISPLAY_VALUE'])*/?>)</span>
										--><?/*endif*/?><br>
										<span style="font-weight:normal; font-size:12px;"><?= $i['DISPLAY_PROPERTIES']['PRICE_FOR']['VALUE']?></span>
									</div>
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
</section>


<?if($arParams["INC_ISOTOPE"] == "Y"):?>
	
	<script type="text/javascript" src="<?= SITE_TEMPLATE_PATH?>/js/isotope.min.js"></script>

<?endif?>


<script type="text/javascript">
	
	$(document).ready(function(){

		<?if($arParams["INC_ISOTOPE"] == "Y"):?>
			
			var g = $("#grid-<?= $s_id?>").isotope({
					    itemSelector: '.filtering-item',
					    layoutMode: 'fitRows'
					 });
		
		<?endif?>
		
		$(document).on("click", ".sof-<?= $s_id?>", function(e){

			var $this = $(this),
				is_act = $this.closest("li").hasClass("active");

				<?if($arParams["INC_ISOTOPE"] == "Y"):?>
					var gr = is_act ? '.all-<?= $s_id?>' : $this.data('group');
					g.isotope({ filter: gr});
				
				<?else:?>
					//ajax
					var params = {
					 		ib_id: '<?= $arParams['IBLOCK_ID']?>',
					 		objects: '<?= $arParams['MARKER_AJAX']?>'
					 	},

					 	ajax_area = $('.ajax-<?= $s_id?>');
					
					if(!is_act)
					 	params.cid = $(this).data('cid');

						$.ajax({
							url: '/ajax/special_offers.php',
							method: 'POST',
							data: params,
							success: function(data){
								
								ajax_area.fadeOut('500');

								setTimeout(function(){
									ajax_area.html(data);
									ajax_area.fadeIn('500');
								}, 500);
								
								
							}

						});
					
				<?endif?>
				
				$(".s-id-<?= $s_id?> li.active").removeClass("active");

				if(!is_act)
					$this.closest("li").addClass("active");

				e.preventDefault();

		});

	});

</script>
