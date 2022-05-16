<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/captcha.php");
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

if (empty($arResult['CART'])) {?>
	<div role="alert" class="alert alert-danger"><i class="fa fa-info-circle"></i> Ваша корзина пуста</div>
	<?return;
}?>

<div class="col-sm-8 col-md-9" role="main">
	
	<div class="section-title text-left">

		<h3>Информация для бронирования</h3>

	</div>
	
	<?if (!empty($arResult['ERRORS'])):?>
	<div class="row mb-40">
		<div role="alert" class="alert alert-danger">
			<?echo implode("<br>", array_map(function ($it) {

					return '<i class="fa fa-info-circle"></i> ' . $it;

				}, $arResult['ERRORS']));?>
		</div>
	</div>
	<?endif?>

	
	<div class="payment-container">
		

		<form class="booking-form" action="<?= POST_FORM_ACTION_URI?>" method="post">	
			<?= bitrix_sessid_post()?>
			<div class="payment-box">

				<div class="payment-header clearfix">

					<div class="number">
						1
					</div>

					<div class="row gap-10">

						<div class="col-sm-9">
							<h5 class="heading mt-0">Внесите Ваши данные</h5>
						</div>

					</div>

				</div>

				<div class="payment-content">

					<div class="form-horizontal">
						<div class="mb-0 form-group gap-20">
							<label class="col-sm-3 col-md-2 control-label">Email:</label>
							<div class="col-sm-5 col-md-4">
								<input required="" <?if ($arResult['USER_EMAIL'] != ""):?> readonly="" <?endif?> name="email" type="email" value="<?if ($arResult['USER_EMAIL'] != "") echo $arResult['USER_EMAIL'];?>" class="bx-email-auth form-control">
							</div>
							<label class="col-sm-3 col-md-2 control-label">Телефон:</label>
							<div class="col-sm-5 col-md-4">
								<input pattern="^\+?[0-9,\s]{0,}$" placeholder="+375291111111" required="" type="text" value="<?= $arResult['POST']['phone']?>" name="phone" class="form-control">
							</div>
						</div>
						<?if (!$arResult['USER_EMAIL']):?>
							<div style="display: none" class="auth-hidden-block">
								<div class="form-group gap-20">
									<label class="col-sm-3 col-md-2 control-label"></label>
									<div class="messBlock col-sm-5 col-md-4"></div>
								</div>
								<div class="passBlock">
									<div class="form-group gap-20">
										<label class="col-sm-3 col-md-2 control-label">Пароль:</label>
										<div class="col-sm-5 col-md-4">
											<input required="" name="pass" type="password" value="<?= $arResult['POST']['pass']?>" class="form-control">
										</div>
									</div>
									<div class="form-group gap-20">
										<label class="col-sm-3 col-md-2 control-label"></label>
										<div class="pos-rel col-sm-5 col-md-4">
										<a data-toggle="modal" href="#loginModal">Забыли пароль ?</a>
										<script>
											(function ($){
												$('#login-form').hide();
												$('#lost-form').show();
											})(jQuery)
										</script>
											<button class="pos-abs-btn do-auth btn btn-primary">Войти</button>
										</div>
									</div>
								</div>
							</div>
						<?endif?>
					</div>

				</div>

			</div>
			<div class="no-border payment-box">

				<div class="payment-header clearfix">
										
					<div class="number">
						2
					</div>
					
					<h5 class="heading mt-0">Информация о туристах</h5>
				
				</div>
				<? foreach ($arResult['CART'] as $k => $arItem): ?>
					<?for ($i = 1; $i <= $arItem['PEOPLE']; $i++):?>
						<div class="no-border payment-traveller">

							<div class="row gap-0">

								<div class="col-sm-9 col-sm-offser-3 col-md-10 col-md-offset-2">
									<h6 class="heading">Турист <?= $i?></h6>
								</div>

							</div>


							<div class="form-horizontal">
								<div class="form-group gap-20">
									<label class="col-sm-3 col-md-2 control-label">Имя:</label>
									<div class="col-sm-5 col-md-4">
										<input required="" type="text" value="<?= $arResult['POST']['tourists'][$k][$i]['name']?>" name="tourists[<?= $k?>][<?= $i?>][name]" class="form-control">
									</div>
								</div>
							</div>

							<div class="form-horizontal">
								<div class="form-group gap-20">
									<label class="col-sm-3 col-md-2 control-label">Фамилия:</label>
									<div class="col-sm-5 col-md-4">
										<input required="" type="text" value="<?= $arResult['POST']['tourists'][$k][$i]['last_name']?>" name="tourists[<?= $k?>][<?= $i?>][last_name]" class="form-control">
									</div>
								</div>
							</div>

							<div class="form-horizontal">
								<div class="form-group gap-20 select2-input-hide">
									<label class="col-sm-3 col-md-2 control-label">Пол:</label>
									<div class="col-sm-5 col-md-4">
										<select required="" data-placeholder="Пол" name="tourists[<?= $k?>][<?= $i?>][gender]" class="single-select">
											<option <?if ($arResult['POST']['tourists'][$k][$i]['gender'] == 0) echo "selected";?> value="0">Мужской</option>
											<option <?if ($arResult['POST']['tourists'][$k][$i]['gender'] == 1) echo "selected";?> value="1">Женский</option>
										</select>

									</div>
								</div>
							</div>

							<div class="form-horizontal">
								<div class="form-group gap-20 select2-input-hide">
									<label class="col-sm-3 col-md-2 control-label">Дата рождения:</label>
									<div class="col-sm-5 col-md-4">
									
										<input required="" type="text" name="tourists[<?= $k?>][<?= $i?>][birthdate]" class="date form-control" value="<?= $arResult['POST']['tourists'][$k][$i]['birthdate']?>">
									</div>
								</div>
							</div>
							
							<div class="form-horizontal">
								<div class="form-group gap-20">
									<label class="special-label col-sm-3 col-md-2 control-label">Серия и номер паспорта:</label>
									<div class="col-sm-5 col-md-4">
										<input pattern="^[0-9,a-z,A-Z,А-Я,а-я]{1,15}$" required="" placeholder="MC1111111" type="text" value="<?= $arResult['POST']['tourists'][$k][$i]['passport_number']?>" name="tourists[<?= $k?>][<?= $i?>][passport_number]" class="form-control">
									</div>
								</div>
							</div>


							<!--div class="form-horizontal">
								<div class="form-group gap-20">
									<label class="col-sm-3 col-md-2 control-label">Серия и номер паспорта:</label>
									<div class="col-sm-5 col-md-4">
										<input type="email" value="" class="form-control">
									</div>
								</div>
							</div>

							<div class="form-horizontal">
								<div class="form-group gap-20">
									<label class="col-sm-3 col-md-2 control-label">Гражданство:</label>
									<div class="col-sm-5 col-md-4">
										<select data-placeholder="Nationality" class="select2-single form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true">
											<option value="">Гражданство</option>	
											<option value="Thai">Thai</option>
											<option value="Malaysian">Malaysian</option>
											<option value="Indonesian">Indonesian</option>
											<option value="American">American</option>
											<option value="England">England</option>
											<option value="German">German</option>
											<option value="Polish">Polish</option>
										</select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 250px;"><span class="selection"><span aria-expanded="false" aria-haspopup="true" role="combobox" class="select2-selection select2-selection--single" tabindex="0" aria-labelledby="select2-4zg1-container"><span class="select2-selection__rendered" id="select2-4zg1-container"><span class="select2-selection__placeholder">Nationality</span></span><span role="presentation" class="select2-selection__arrow"><b role="presentation"></b></span></span></span><span aria-hidden="true" class="dropdown-wrapper"></span></span>
									</div>
								</div>
							</div-->

						</div>
					<?endfor;?>
				<?endforeach?>
			</div>

			<div class="payment-box">

				<div class="payment-header clearfix">

					<div class="number">
						3
					</div>

					<div class="row gap-10">

						<div class="col-sm-9">
							<h5 class="heading mt-0">Комментарий к заказу</h5>
						</div>

					</div>

				</div>

				<div class="payment-content">

					<div class="form-horizontal">
						<div class="form-group gap-20">
							
							<div class="col-md-12">
								<textarea rows='5' name='comment' class="form-control"><?= $arResult['POST']['comment']?></textarea>
							</div>
							
						</div>
						
					</div>

				</div>

			</div>
		
			<div style="display: none" role="alert" class="trigger-show alert alert-danger"><i class="fa fa-info-circle"></i> Вы не согласились с договором оферты</div>

			<div class="checkbox-block">
				<input type="checkbox" <?if ($arResult['POST']['accept_booking'] == "Y") echo "checked";?> value="Y" class="checkbox" name="accept_booking" id="accept_booking">
				<label for="accept_booking" class="">Я согласен с  <a data-toggle="modal" href="#contractOfferModal">договором публичной оферты</a>  и  <a data-toggle="modal" href="#cancellationСonditionsModal">правилами аннуляции</a> .</label>
			</div>

			<div class="row mt-20">

				<div class="col-sm-8 col-md-6">

					<button value="submit" name="submit" type="submit" class="btn btn-primary">Бронировать</button>

				</div>

			</div>

		</form>

	</div>

</div>
<div class="col-sm-4 col-md-3 hidden-xs">

	<h4 class="heading mt-0 text-primary uppercase">Ваш заказ</h4>

		<ul class="price-summary-list price-summary-wrapper ">
		<?foreach ($arResult['CART'] as $k=>$arItem): ?>
			<li class="pos-rel">
				<a class="pull-right font12 traveller-remove" href="?delFromCart=<?= $k?>"><i class="fa fa-times-circle"></i></a>
				<h6 class="heading mt-0 mb-0"><?= $arItem['NAME']?></h6>
				<p class="font12 text-light">
				Номер: <?= $arItem['ROOM_NAME']?><br>
				Заезд: <?= $arItem['CHECK_IN']?><br>
				Выезд: <?= $arItem['CHECK_OUT']?><br>
				Туристов: <?= $arItem['PEOPLE']?><br>
				Цена: <?= $arItem['PRICE']?> <?= $arItem['CURRENCY']?><br>
				</p>
			
			</li>
		<?endforeach?>

			<li class="total-price">

				<div class="row gap-10">
					<div class="col-xs-6 col-sm-6">
						<h5 class="heading mt-0 mb-0 text-white">Итого</h5>
					</div>
					<div class="col-xs-6 col-sm-6 text-right">
						<span class="block font20 font600 mb-5"><?= $arResult['TOTAL_PRICE']?> <?= $arResult['CURRENT_CURRENCY']?><?/*= $arResult['CURRENCY']*/?></span>
						
					</div>
				</div>

			</li>

		</ul>


</div>


<div class="modal fade modal-login modal-border-transparent" id="contractOfferModal" tabindex="-1" role="dialog" aria-hidden="true">

	<div class="modal-dialog" style="width: 80%">
		<div class="modal-content"  style="width: auto">

			<button type="button" class="btn btn-close close" data-dismiss="modal" aria-label="Close">
				<i class="fa fa-close fa-fw" aria-hidden="true"></i>
			</button>

			<div class="clear"></div>

		
						
						<?$APPLICATION->IncludeFile($SERVER["DOCUMENT_ROOT"]."/include/contract_offer.php", Array(), Array(
								    "MODE"      => "html",        // будет редактировать в веб-редакторе
								    "NAME"      => "Договор оферта",      // текст всплывающей подсказки на иконке
								    ));?>							

					</div>

							
			</div>
				
				


				
		</div>
	</div>
</div>

<div class="modal fade modal-login modal-border-transparent" id="cancellationСonditionsModal" tabindex="-1" role="dialog" aria-hidden="true">

	<div class="modal-dialog" style="width: 80%">
		<div class="modal-content"  style="width: auto">

			<button type="button" class="btn btn-close close" data-dismiss="modal" aria-label="Close">
				<i class="fa fa-close fa-fw" aria-hidden="true"></i>
			</button>

			<div class="clear"></div>

			
				<?$APPLICATION->IncludeFile($SERVER["DOCUMENT_ROOT"]."/include/cancellation_сonditions.php", Array(), Array(
								    "MODE"      => "html",        // будет редактировать в веб-редакторе
								    "NAME"      => "Условия отмены",      // текст всплывающей подсказки на иконке
								    ));?>
			 
				
		</div>
	</div>
</div>
