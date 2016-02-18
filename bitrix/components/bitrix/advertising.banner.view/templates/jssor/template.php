<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$rnd = randString(5);
$arParams['PROPS']['PRESET'] = intval($arParams['PROPS']['PRESET']);
$arParams['PROPS']['OVERLAY_COLOR'] = hexdec(substr($arParams['PROPS']['OVERLAY_COLOR'],0,2)).",".hexdec(substr($arParams['PROPS']['OVERLAY_COLOR'],2,2)).",".hexdec(substr($arParams['PROPS']['OVERLAY_COLOR'],4,2)).",".abs(1 - intval($arParams['PROPS']['OVERLAY_OPACITY'])/100);
$arParams['PROPS']['HEADING_BG_OPACITY'] = isset($arParams['PROPS']['HEADING_BG_OPACITY']) ? intval($arParams['PROPS']['HEADING_BG_OPACITY']) : 100;
$arParams['PROPS']['HEADING_BG_COLOR'] = hexdec(substr($arParams['PROPS']['HEADING_BG_COLOR'],0,2)).",".hexdec(substr($arParams['PROPS']['HEADING_BG_COLOR'],2,2)).",".hexdec(substr($arParams['PROPS']['HEADING_BG_COLOR'],4,2)).",".abs(1 - $arParams['PROPS']['HEADING_BG_OPACITY']/100);
$arParams['PROPS']['ANNOUNCEMENT_BG_COLOR'] = hexdec(substr($arParams['PROPS']['ANNOUNCEMENT_BG_COLOR'],0,2)).",".hexdec(substr($arParams['PROPS']['ANNOUNCEMENT_BG_COLOR'],2,2)).",".hexdec(substr($arParams['PROPS']['ANNOUNCEMENT_BG_COLOR'],4,2)).",".abs(1 - intval($arParams['PROPS']['ANNOUNCEMENT_BG_OPACITY'])/100);
$arParams['PROPS']['BUTTON_BG_COLOR'] = hexdec(substr($arParams['PROPS']['BUTTON_BG_COLOR'],0,2)).",".hexdec(substr($arParams['PROPS']['BUTTON_BG_COLOR'],2,2)).",".hexdec(substr($arParams['PROPS']['BUTTON_BG_COLOR'],4,2));
$arParams['PROPS']['HEADING_FONT_SIZE'] = intval($arParams['PROPS']['HEADING_FONT_SIZE']);
$arParams['PROPS']['ANNOUNCEMENT_FONT_SIZE'] = intval($arParams['PROPS']['ANNOUNCEMENT_FONT_SIZE']);
$arParams['PROPS']['ANIMATION_DELAY'] = intval($arParams['PROPS']['ANIMATION_DELAY']);

if (is_array($arParams['PROPS']['HEADING']))
{
	$headingText = $arParams['PROPS']['HEADING']['CODE'];
}
else
{
	$headingText = $arParams['PROPS']['HEADING'];
	$announcementText = $arParams['PROPS']['ANNOUNCEMENT'];
}
$showLink = $arParams['PROPS']['LINK_URL'] != '' && !isset($arParams['PREVIEW']);

$frame = $this->createFrame()->begin("");
?>
<div>
<?if($arParams['CASUAL_PROPERTIES']['TYPE'] == 'template'):?>
	<?if(isset($arParams['FILES']['IMG']['SRC'])):?>
		<?if($showLink):?>
			<a u="image" href="<?=$arParams['PROPS']['LINK_URL']?>" target="<?=$arParams['PROPS']['LINK_TARGET']?>" title="<?=$arParams['PROPS']['LINK_TITLE']?>">
				<img src="<?=$arParams['FILES']['IMG']['SRC']?>" alt="<?=$arParams['FILES']['IMG']['DESCRIPTION']?>" title="<?=$arParams['FILES']['IMG']['DESCRIPTION']?>" />
			</a>
		<?else:?>
			<img u="image" src="<?=$arParams['FILES']['IMG']['SRC']?>"  alt="<?=$arParams['FILES']['IMG']['DESCRIPTION']?>" title="<?=$arParams['FILES']['IMG']['DESCRIPTION']?>" />
		<?endif;?>
	<?endif;?>
	<?if($arParams['EXT_MODE'] == 'N'):?>
		<?if($arParams['PROPS']['OVERLAY'] == 'Y'):?>
			<div class="bx-advertisingbanner-pattern" style="background:rgba(<?=$arParams['PROPS']['OVERLAY_COLOR']?>)"></div>
		<?endif;?>
		<?if($arParams['PROPS']['HEADING_SHOW'] == 'Y' || $arParams['PROPS']['ANNOUNCEMENT_SHOW'] == 'Y' || $arParams['PROPS']['BUTTON'] == 'Y'):?>
			<div class="bx-slider-preset-<?=$arParams['PROPS']['PRESET']?>">
				<div class="bx-advertisingbanner-content" u="caption" t="<?=$arParams['PROPS']['ANIMATION_EFFECT']?>" d="<?=$arParams['PROPS']['ANIMATION_DELAY']?>" <?if($arParams['PROPS']['PRESET']==2 || $arParams['PROPS']['PRESET']==3){echo 'style="background:rgba('.$arParams['PROPS']['HEADING_BG_COLOR'].');"';}?>>
				<?if ($arParams['PROPS']['HEADING_SHOW'] == 'Y'):?>
					<?if($showLink):?>
						<a href="<?=$arParams['PROPS']['LINK_URL']?>" target="<?=$arParams['PROPS']['LINK_TARGET']?>" title="<?=$arParams['PROPS']['LINK_TITLE']?>">
							<div id="text<?=$rnd?>" class="bx-advertisingbanner-text-title" style="font-size:<?=$arParams['PROPS']['HEADING_FONT_SIZE']?>px;color:#<?=$arParams['PROPS']['HEADING_FONT_COLOR']?>;<?if($arParams['PROPS']['PRESET']==1 || $arParams['PROPS']['PRESET']==4){echo 'background:rgba('.$arParams['PROPS']['HEADING_BG_COLOR'].');';}?>">
								<?=$headingText?>
							</div>
						</a>
					<?else:?>
						<div id="text<?=$rnd?>" class="bx-advertisingbanner-text-title" style="font-size:<?=$arParams['PROPS']['HEADING_FONT_SIZE']?>px;color:#<?=$arParams['PROPS']['HEADING_FONT_COLOR']?>;<?if($arParams['PROPS']['PRESET']==1 || $arParams['PROPS']['PRESET']==4){echo 'background:rgba('.$arParams['PROPS']['HEADING_BG_COLOR'].');';}?>">
							<?=$headingText?>
						</div>
					<?endif;?>
				<?endif;?>
				<?if ($arParams['PROPS']['ANNOUNCEMENT_SHOW'] == 'Y'):?>
					<?if($showLink):?>
						<a href="<?=$arParams['PROPS']['LINK_URL']?>" target="<?=$arParams['PROPS']['LINK_TARGET']?>" title="<?=$arParams['PROPS']['LINK_TITLE']?>">
							<div id="announce<?=$rnd?>" class="bx-advertisingbanner-text-block" style="font-size:<?=$arParams['PROPS']['ANNOUNCEMENT_FONT_SIZE']?>px;color:#<?=$arParams['PROPS']['ANNOUNCEMENT_FONT_COLOR']?>;background:rgba(<?=$arParams['PROPS']['ANNOUNCEMENT_BG_COLOR']?>);">
								<?=$announcementText?>
							</div>
						</a>
					<?else:?>
						<div id="announce<?=$rnd?>" class="bx-advertisingbanner-text-block" style="font-size:<?=$arParams['PROPS']['ANNOUNCEMENT_FONT_SIZE']?>px;color:#<?=$arParams['PROPS']['ANNOUNCEMENT_FONT_COLOR']?>;background:rgba(<?=$arParams['PROPS']['ANNOUNCEMENT_BG_COLOR']?>);">
							<?=$announcementText?>
						</div>
					<?endif;?>
				<?endif;?>
				<?if($arParams['PROPS']['BUTTON'] == 'Y'):?>
					<?if(isset($arParams['PREVIEW'])):?>
						<button  class="bx-advertisingbanner-btn" style="background-color: rgb(<?=$arParams['PROPS']['BUTTON_BG_COLOR']?>);color:#<?=$arParams['PROPS']['BUTTON_FONT_COLOR']?>;border: 0;"><?=$arParams['PROPS']['BUTTON_TEXT']?></button>
					<?else:?>
						<a class="bx-advertisingbanner-btn" href="<?=$arParams['PROPS']['BUTTON_LINK_URL']?>" title="<?=$arParams['PROPS']['BUTTON_LINK_TITLE']?>" target="<?=$arParams['PROPS']['BUTTON_LINK_TARGET']?>" style="background-color: rgb(<?=$arParams['PROPS']['BUTTON_BG_COLOR']?>);color:#<?=$arParams['PROPS']['BUTTON_FONT_COLOR']?>">
							<?=$arParams['PROPS']['BUTTON_TEXT']?>
						</a>
					<?endif;?>
				<?endif;?>
				</div>
			</div>
		<?endif;?>
	<?elseif($arParams['EXT_MODE'] == 'Y'):?>
		<?=$headingText?>
	<?endif;?>
<?else:?>
	<?if(isset($arParams['FILES']['CASUAL_IMG']['SRC'])):?>
		<?if($showLink):?>
			<a u="image" href="<?=$arParams['CASUAL_PROPERTIES']['URL']?>" target="<?=$arParams['CASUAL_PROPERTIES']['URL_TARGET']?>" title="<?=$arParams['CASUAL_PROPERTIES']['ALT']?>">
				<img src="<?=$arParams['FILES']['CASUAL_IMG']['SRC']?>" />
			</a>
		<?else:?>
			<img u="image" src="<?=$arParams['FILES']['CASUAL_IMG']['SRC']?>">
		<?endif;?>
	<?endif;?>
<?endif;?>
</div>

<?$frame->end();?>