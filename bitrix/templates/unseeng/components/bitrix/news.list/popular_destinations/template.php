<?$prov=CModule::IncludeModuleEx("simai.special");if($prov==0||$prov==3)return;?><?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

$s_p_url = "/strany/";
if(!empty($arResult["ITEMS"]))
?>

<section class="bg-light">
			
	<div class="container">
	
		<div class="row">
			
			<div class="col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
				<? if ($GLOBALS["SCRIPT_NAME"] == "/index.php"):?>
				<div class="section-title mb-20">
					<h3>Популярные направления</h3>
					<div class="sorting-middle-holder  mt-25">
						<ul class="sort-by">
							<li><a href="<?= $s_p_url?>" class="btn_blue_p5">Все направления</a></li>
						</ul>
					</div>
				</div>
				<?endif?>
			</div>
		
		</div>

		
		<div class="grid destination-grid-wrapper">
			<?foreach($arResult["ITEMS"] as $k => $i):

				$this->AddEditAction($i['ID'], $i['EDIT_LINK'], CIBlock::GetArrayByID($i["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($i['ID'], $i['DELETE_LINK'], CIBlock::GetArrayByID($i["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => "Подтверждение"));
//print_r ($_SERVER["REQUEST_URI"]);
//print_r ($_SERVER["PHP_SELF"] );
				if ($_SERVER["PHP_SELF"]=="/index.php"):
					$c_s = ($k % 3 == 0) ? 10 : 5;
				else:
				$c_s = 5;
				endif;
			?>
			<div id="<?=$this->GetEditAreaId($i['ID']);?>" class="grid-item" data-colspan="<?= $c_s?>" data-rowspan="4">
				<a href="<?= $i["DETAIL_PAGE_URL"]?>" class="top-destination-image-bg" style="background-image:url('<?= $i["PREVIEW_PICTURE"]["SRC"]?>');">
					<div class="relative">
						<h4><?= $i["NAME"]?></h4>
						<?if(!empty($i["PREVIEW_TEXT"])):?>
							<span><?= $i["PREVIEW_TEXT"]?></span>
						<?endif?>
					</div>
				</a>
			</div>
			<?endforeach?>
		</div>
		
	</div>
	
</section>