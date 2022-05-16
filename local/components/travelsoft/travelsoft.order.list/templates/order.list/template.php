<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
<?if (!empty($arResult['ERRORS'])):?>
<div class="row mb-40">
	<div role="alert" class="alert alert-danger">
		<?echo implode("<br>", array_map(function ($it) {

				return '<i class="fa fa-info-circle"></i> ' . $it;

			}, $arResult['ERRORS']));?>
	</div>
</div>
<?return; endif; ?>
<div class="col-sm-8 col-md-9">
<?foreach ($arResult['ORDERS'] as $order) :?>

	<div class="package-list-item-wrapper on-page-result-page">
		<div class="package-list-item clearfix">
			<div class="content orderBlock">
				<h4>Номер заказа: <?= $order['CODE']?></h4>
				<div class="row gap-10">
					<div class="col-sm-12 col-md-12">


						<ul class="list-info dotted mb-20">
							<li>Статус: <span class="font600"><?= $order['STATUS']?></span></li>
							<li>Заезд: <span class="font600"><?= $order['CHECK_IN']?></span></li>
							<li>Услуги:
								<?foreach ($order['SERVICES'] as $val):?>
									<span class="font600"><?= $val['TITLE']?></span><br>
								<?endforeach;?>
							</li>
						</ul>

					</div>

				</div>
			</div>
			<div class="image payBlock">
				<div class="payed">Оплачено <br> <span class="font600"><?= $order['PAID_SUM'][$arResult['CURRENCY']]?> <?= $arResult['CURRENCY']?></span></div>
				<div class="toPay mb-20">К оплате <br> <span class="font600"><?= $order['TO_PAY'][$arResult['CURRENCY']]?> <?= $arResult['CURRENCY']?></span></div>
				<a href="<?= $order['PAY_ADDRESS']?>" class="btn btn-primary btn-sm"><?= $order['BTN_TXT']?></a>
			</div>

		</div>
	</div>

<?endforeach?>
</div>
<div class="col-sm-4 col-md-3 mt-50-xs">

	<aside class="sidebar with-filter">

		<div class="sidebar-inner"></div>

	</aside>

</div>
