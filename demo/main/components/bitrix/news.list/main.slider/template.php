<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();
?>

<?if(!empty($arResult["ITEMS"])):?>

<!-- inc. Slider -->
<script type="text/javascript" src="<?= SITE_TEMPLATE_PATH?>/js/jquery.flexslider-min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){

		$('#mainFlexSlider').flexslider(
			{
				animation: 'fade',
				slideshow: true,
				pauseOnHover: false,  
				controlNav: true,
				directionNav: true,
				slideshowSpeed: 8000,
				before: function(slider) {
					$(".sl_t-" + slider.currentSlide).hide();
					$(".sl_t-" + slider.animatingTo).fadeIn(1000);
				} 
			}
		);
        $('a.flex-prev, a.flex-next').text('');

	});
</script>
<!-- //inc. -->

<div id="mainFlexSlider">
	<div class="flexslider">
		<ul class="slides">
		
		<?
		$txt = "";
		foreach($arResult["ITEMS"] as $k => $item):

			$this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => "Подтверждение"));?>

			<li id="<?=$this->GetEditAreaId($item['ID']);?>" class="slide">
				<div class="flexslider-image-bg" style="background: url(<?= $item["PREVIEW_PICTURE"]["SRC"]?>) center center no-repeat; background-size:cover"></div>
			</li><!-- slide1 end -->
		<?
					if (!empty($item["PROPERTIES"]["LINK"]["VALUE"])):
					$sl_title="<a href=".$item["PROPERTIES"]["LINK"]["VALUE"].">".$item["NAME"]."</a>";
					else:
					$sl_title=$item["NAME"];
					endif;
		$display = $k == 0 ? "style='display:block'" : "style='display:none'";
		$txt .= "<center><div " . $display . " class=\"sl_t-". $k . " minH-sl_t col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2\">
			
<span class=\"hero-title\">" . $sl_title ."</span>";
		
		if(!empty($item["DISPLAY_PROPERTIES"]["BRIEFLY"]["VALUE"]))
		{	
			foreach($item["DISPLAY_PROPERTIES"]["BRIEFLY"]["VALUE"] as $v)
				$txt .= "<p class=\"lead\">" . $v . "</p>";
		}
					

		$txt .= "</div></center>";


		endforeach?>

		</ul><!-- slides end -->

		<div class="flexslider-overlay"></div>
		
	</div><!-- flexslider end -->
</div>

<?endif?>

<div class="main-search-holder"> 					<!-- ЗАКРЫВАЕТСЯ В /index_inc.php -->
		
	<div class="container">

		<div class="hide-on-small-devices row">
	
			<?= $txt?>
			
		</div>