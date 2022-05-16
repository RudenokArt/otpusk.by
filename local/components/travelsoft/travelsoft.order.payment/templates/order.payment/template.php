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
$this->setFrameMode(true);?>

<?if (!empty($arResult['ERRORS'])):?>
<div class="row mb-40">
	<div role="alert" class="alert alert-danger">
		<?echo implode("<br>", array_map(function ($it) {

				return '<i class="fa fa-info-circle"></i> ' . $it;

			}, $arResult['ERRORS']));?>
	</div>
</div>
<?return; endif; ?>

<div class="container">

	<div class="row">

		<div class="col-sm-8 col-md-9">

			<div class="confirmation-wrapper">

				<div class="payment-success">
<?if ($_SESSION['BOOKING_IS_DONE']):?>
					<div class="icon">
						<i class="pe-7s-check text-success"></i>
					</div>
					<div class="content">
						<h2 class="heading uppercase mt-0 text-success">Спасибо, заказ оформлен</h2>
						<p>Ваш номер заказа: <span class="text-primary font700"><?= $arResult['TICKET']?></span></p>
					</div>
					<?unset($_SESSION['BOOKING_IS_DONE'])?>
<?else:?>
						<h1><?= $arResult['ORDER_TITLE']?> <?= $arResult['TICKET']?></h1>
<?endif?>
						<h5><span style="color: #3f3f3f">Статус:</span> <?= $arResult['ORDER']['STATUS']['NAME']?></h5>
				</div>

				<div class="confirmation-content">

					<div class="section-title text-left">
						<h4>Информация по заказу</h4>
					</div>
					<?$count_services = count($arResult['ORDER']['SERVICES']);?>
					<?if($count_services > 1):?>
						<ul class="book-sum-list">
							<li><span class="font600">Дата заезда: </span><?= $arResult['ORDER']["DATE_TOUR"]?></li>
							<li><span class="font600">Услуги: </span>
								<?foreach ($arResult['ORDER']['SERVICES'] as $service) :?>

									<?= $service['NAME']?><br>

								<?endforeach?>
							</li>
							<li><span class="font600">Цена: </span><?= $arResult['ORDER']["TOTAL_PRICE"] ." ". $arResult['ORDER']['CURRENCY']?></li>
							<?foreach ($arResult['ORDER']["TOURISTS"] as $k => $tourist) :?>
							<li><span class="font600">Турист <?= $k + 1?></span>
								<ul class="tourist-info-block">
									<li><b>Имя:</b> <?= $tourist['NAME']?></li>
									<li><b>Фамилия:</b> <?= $tourist['LAST_NAME']?></li>
									<li><b>Пол:</b> <?= $tourist['GENDER']?></li>
									<li><b>Дата рождения:</b> <?= $tourist['BIRTHDATE']?></li>
									<li><b>Номер паспорта:</b> <?= $tourist['PASSPORT_NUMBER']?></li>
								</ul>
								<?endforeach?>
							</li>
						</ul>
					<?else:?>
						<?foreach ($arResult['ORDER']['SERVICES'] as $service) :?>
							<ul class="book-sum-list">
								<li><span class="font600">Услуга: </span><?= $service['NAME']?></li>
								<li><span class="font600">Дата заезда: </span><?= $service['CHECK_IN']?></li>
								<li><span class="font600">Пребывание(дней): </span><?= $service['LONG']?></li>
								<li><span class="font600">Цена: </span><?= $service['PRICE'] ." ". $arResult['ORDER']['CURRENCY']?></li>

								<?foreach ($arResult['ORDER']["TOURISTS"] as $k => $tourist) :?>
								<li><span class="font600">Турист <?= $k + 1?></span>
									<ul class="tourist-info-block">
										<li><b>Имя:</b> <?= $tourist['NAME']?></li>
										<li><b>Фамилия:</b> <?= $tourist['LAST_NAME']?></li>
										<li><b>Пол:</b> <?= $tourist['GENDER']?></li>
										<li><b>Дата рождения:</b> <?= $tourist['BIRTHDATE']?></li>
										<li><b>Номер паспорта:</b> <?= $tourist['PASSPORT_NUMBER']?></li>
									</ul>
								<?endforeach?>
								</li>


							</ul>
						<?endforeach?>
					<?endif?>
				</div>
				<?if ($arResult['ORDER']['DOCUMENTS']):?>
					<div class="confirmation-content">
						<div class="section-title text-left">
							<h4>Документы по заказу</h4>
						</div>
						<ul>
							<?foreach ($arResult['ORDER']['DOCUMENTS'] as $doc): ?>
								<li><a target="__blank" href="<?= htmlspecialchars($doc['url'])?>"><?= $doc['title']?></a></li>
							<?endforeach?>
						</ul>
						
					</div>
				<?endif?>
				<?if (in_array($arResult['ORDER']['STATUS']['ID'], $arResult['ALLOW_STATUSES_FOR_PAYMENT'])) :?>
					<?if ($arResult['PAYMENTS']):?>
					<div class="confirmation-content no-border">

						<div class="section-title text-left">
							<h4>Оплата</h4>

						</div>

						<div id="paymentOption" class="payment-option-wrapper">
							<div class="row">

								<?foreach ($arResult['PAYMENTS'] as $k => $payment) :?>
							
									<div class="col-sm-12">
									
										<div class="radio-block">
											<input id="payments<?= $k?>" name="payments" type="radio" class="radio" value="<?= $payment['ID']?>">
											<label class="" for="payments<?= $k?>"><span><?= $payment['TITLE']?></span> 
											<?if ($payment['IMG']):?><img src="<?= $payment['IMG']?>" alt="Image"><?endif?></label>
										</div>
										
									</div>
									<div class="clear"></div>
								<?endforeach?>
								
							</div>
							<?foreach ($arResult['PAYMENTS'] as $k => $payment) :?>
							<div id="<?= $payment['ID']?>" class="payment-option-form" style="display: block;">
							
								<div class="inner">
								
									<h5 class="mb-15">Общая стоимость заказа: <?= $arResult['ORDER']['TOTAL_PRICE'] . " " . $arResult['ORDER']['CURRENCY']?></h5>
									<h5 class="mb-15">К оплате: <?= $arResult['ORDER']['PAID_SUM'] . " " . $arResult['ORDER']['CURRENCY']?></h5>
									
									<?if ($payment['FILE_TXT']) :?>
										<p><?$APPLICATION->IncludeFile($SERVER["DOCUMENT_ROOT"]."/include/".$payment['FILE_TXT'].".php", Array(), Array(
									    "MODE"      => "html",        // будет редактировать в веб-редакторе
									    "NAME"      => "Текст способа оплаты",      // текст всплывающей подсказки на иконке
									    ));?></p>
									<?endif?>

									<?if ($payment['ADDRESS_TEMPLATE']) :?>
										<a target="_blank" href="<?= $payment['ADDRESS_TEMPLATE']?>" class="btn btn-primary">Оплатить</a>
									<?endif?>
								</div>
								
							</div>
							<?endforeach?>
						</div>

					</div>
					<?endif?>
				<?else:?>
					<div class="confirmation-content no-border">
						<div class="row">
							<div role="alert" class="alert alert-danger">
							<?$APPLICATION->IncludeFile($SERVER["DOCUMENT_ROOT"]."/include/allow_payment_text.php", Array(), Array(
										    "MODE"      => "html",        // будет редактировать в веб-редакторе
										    "NAME"      => "Текст пояснения по доступу к оплате",      // текст всплывающей подсказки на иконке
										    ));?>
						    </div>
					    </div>
					</div>
				<?endif?>
			</div>

		</div>

		<div class="col-sm-4 col-md-3 mt-50-xs">

			<aside class="sidebar with-filter">
				<div class="sidebar-inner">
									<div class="sidebar-module">
										<h4 class="heading mt-0">Нужна помощь?</h4>
										<div class="sidebar-module-inner">
											<ul class="help-list">
												<li><span class="font600">Телефон</span>: +375 (17) 215-49-49</li>
												<li><span class="font600">Email</span>: <a href="mailto:sale@ck.by">sale@ck.by</a></li>
												<!--li><span class="font600">Livechat</span>: Otpusk.by (Skype)</li-->
											</ul>
										</div>
									</div>
									
									
									<div class="sidebar-module">
										<h4 class="heading mt-0">Почему мы?</h4>
										<div class="sidebar-module-inner">
											<ul class="featured-list-sm">
												<li>
													<span class="icon"><i class="fa fa-thumbs-up"></i></span>
													<h6 class="heading mt-0">Отличный продукт</h6>
													У нас пямые контракты с поставщиками. У нас нет дополнительных сборов и скрытых платежей.
												</li>
												<li>
													<span class="icon"><i class="fa fa-credit-card"></i></span>
													<h6 class="heading mt-0">Способы оплаты</h6>
													Можно оплатить услуги любым удобным способом: банковская карта, ЕРИП, наличные деньги.
												</li>
												<li>
													<span class="icon"><i class="fa fa-inbox"></i></span>
													<h6 class="heading mt-0">Быстрое подтверждение</h6>
													Многие услуги подтверждаются моментально. Вы получите извещение на почту или по телефону
												</li>
											</ul>
										</div>
									</div>
									
								</div>

			</aside>

		</div>

	</div>

</div>