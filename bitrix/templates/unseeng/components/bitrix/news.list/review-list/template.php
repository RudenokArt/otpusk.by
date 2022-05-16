<?$prov=CModule::IncludeModuleEx("simai.special");if($prov==0||$prov==3)return;?><?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

?>
<div class="col-md-9">
<?//dm($arResult)?>
<?if(!empty($arResult['ITEMS'])):
$count = count($arResult['ITEMS']);
?>

<script type="text/javascript">
	function initRatinig(selector)
	{
		$(selector).raty({
			path: '<?= SITE_TEMPLATE_PATH?>/images/raty',
			starHalf: 'star-half-sm.png',
			starOff: 'star-off-sm.png',
			starOn: 'star-on-sm.png',
			readOnly: true,
			round : { down: .2, full: .6, up: .8 },
			half: true,
			space: false,
			score: function() {
				return $(this).attr('data-rating-score');
			}
		});
	}
</script>

<div id="section-7" class="detail-content">

	<div class="section-title text-left">
		<h4>Отзывы</h4>
	</div>

	<div class="review-wrapper">

		<div class="review-content">

			<div class="row gap-20">

				<div class="col-sm-6">
					<h5>Оставлено отзывов: <?= $arResult["NAV_RESULT"]->NavRecordCount?></h5>
				</div>

				<div class="col-sm-6 text-right text-left-xs">
					<a href="#leave-comment" class="anchor btn btn-primary btn-inverse btn-sm">Оставить комментарий</a>
				</div>

			</div>


			<ul class="review-list">

			<?foreach ($arResult['ITEMS'] as $key => $i):?>
				<li class="clearfix">
					<div class="image">
						<img class="img-circle" src="<?= SITE_TEMPLATE_PATH?>/images/04.jpg" alt="Man" />
					</div>
					<div class="content" style="width: 100%">
						<div class="row gap-20">
							<div class="col-sm-9">
								<h6><?= $i['NAME']?></h6>
							</div>
							<div class="col-sm-3">
								<p class="review-date"><?= $i['DISPLAY_ACTIVE_FROM']?></p>
							</div>
						</div>
						<?if($i['PROPERTIES']['RATING']['VALUE'] > 0):?>
							<div class="rating-wrapper">
								<div class="raty-wrapper">
									<div class="star-rating-12px rating-<?= $i['ID']?>" data-rating-score="<?= $i['PROPERTIES']['RATING']['VALUE']?>"></div>
								</div>
							</div>

							<script type="text/javascript">
								// Smaller size star
								initRatinig('.rating-<?= $i['ID']?>');
							</script>

						<?endif?>
						<div style="word-break: break-all;" class="review-text">
							<?= $i['DETAIL_TEXT']?>
						</div>

						<!--div class="review-other">

							<div class="row gap-20 mb-0">

								<div class="col-sm-6">

									<ul class="social-share-sm">

										<li><span><i class="fa fa-share-square"></i> Поделиться</span></li>
										<li class="the-label"><a href="#">Facebook</a></li>
										<li class="the-label"><a href="#">Twitter</a></li>
										<li class="the-label"><a href="#">Google Plus</a></li>

									</ul>

								</div>

								<div class="col-sm-6">

									<ul class="social-share-sm for-useful">
										<li><span>Был ли этот отзыв полезным? </span></li>
										<li class="the-label"><a href="#"><i class="fa fa-thumbs-up"></i></a> 2</li>
										<li class="the-label"><a href="#"><i class="fa fa-thumbs-down"></i></a> 1</li>
									</ul>

								</div>

							</div>

						</div-->
					</div>
				</li>
			<?endforeach?>

			</ul>
			
			<?if($count < $arResult["NAV_RESULT"]->NavRecordCount):?>
			<div class="bt text-center pt-30">
				<a rel="nofollow" href="/ajax/reviews.php" class="show-more btn btn-primary">Показать ещё</a>
			</div>
			<script type="text/javascript">
				(function(){
					// ajax reviews load
					var page = 2,
					max_page = Math.ceil(<?= $arResult["NAV_RESULT"]->NavRecordCount / $arParams['NEWS_COUNT']?>)
					
					$(document).on('click', '.show-more', function(){

						if(page > max_page) return false;

						var $this = $(this);

						$.post(
							$this.attr("href"),

							{
								page: page,
								cnt: '<?= $arParams["NEWS_COUNT"]?>', 
								sort: '<?= $arParams['SORT_BY1']?>', 
								order: '<?= $arParams['SORT_ORDER1']?>',
								element_id: '<?= $GLOBALS['arrFilter']['PROPERTY_ELEMENT_ID'] > 0 ? $GLOBALS['arrFilter']['PROPERTY_ELEMENT_ID'] : 0?>'
							},

							function(data) {

								var tmp, reviews, review;
								console.log(data);
								if(data.resp)
								{
									reviews = data.reviews;

									for(k in reviews)
									{
										review = reviews[k];
										console.log(review);
										tmp = '<li class="clearfix">';
										tmp += '<div class="image">';
										tmp += '<img class="img-circle" src="' + '<?= SITE_TEMPLATE_PATH?>/images/04.jpg' + '" alt="Man" />';
										tmp += '</div>';
										tmp +='<div class="content" style="width: 100%">';
										tmp += '<div class="row gap-20">';
										tmp += '<div class="col-sm-9">';
										tmp += '<h6>' + review.name + '</h6>';
										tmp += '</div>';
										tmp += '<div class="col-sm-3">';
										if(review.date)
											tmp += '<p class="review-date">' + review.date + '</p>';
										tmp += '</div>';
										tmp += '</div>';

										if(review.rating > 0)
										{
											tmp += '<div class="rating-wrapper">';
											tmp += '<div class="raty-wrapper">';
											tmp += '<div class="star-rating-12px rating-' + k + '" data-rating-score="' + review.rating + '"></div>';
											tmp += '</div>';
											tmp += '</div>';
										}

										tmp += '<div style="word-break: break-all;" class="review-text">' + review.text + '</div>';

										tmp += '</div></li>';

										$('.review-list').append(tmp);

										initRatinig('.rating-' + k);

									}
								}

								page++;	

								if(page > max_page) $this.hide();
							}
							);

						return false;
					});
				})(jQuery);
			</script>
			<?endif?>
		</div>

	</div>

</div>

<?endif?>
</div>