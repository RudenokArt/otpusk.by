<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

$s_p_url = "/aktsii/";
if(!empty($arResult["ITEMS"]))
?>

<section class="bg-light">
	<?// print("<pre>".print_r($arResult["ITEMS"],true)."</pre>");?>
	<div class="container">
		<div class="row">
			
			<div class="col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
				<? if ($GLOBALS["SCRIPT_NAME"] == "/index.php"):?>
				<div class="section-title mb-20">
					<h3>Акции</h3>
					<div class="sorting-middle-holder  mt-25">
						<ul class="sort-by">
							<li><a href="<?= $s_p_url?>" class="btn_blue_p5">Все акции</a></li>
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
						<?if(!empty($i["DISPLAY_PROPERTIES"]["COUNTRY"]["VALUE"][0])):?>
							<?  $res = CIBlockElement::GetByID($i["DISPLAY_PROPERTIES"]["COUNTRY"]["VALUE"][0]);
								$ar_res = $res->GetNext();
							?>
							<span><?= $ar_res["NAME"]?></span>
						<?endif?>
						<?if(!empty($i["DISPLAY_PROPERTIES"]["HOTEL"]["VALUE"][0])):?>
							<?  $res = CIBlockElement::GetByID($i["DISPLAY_PROPERTIES"]["HOTEL"]["VALUE"][0]);
								$ar_res = $res->GetNext();
							?>
							<span style="background: #5A8CC1;"><?= $ar_res["NAME"]?></span>
						<?endif?>
					</div>
				</a>
			</div>
			<?endforeach?>
		</div>
		
	</div>
	
</section>