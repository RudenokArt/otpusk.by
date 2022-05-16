<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?>
<div class="main-wrapper">
			<div class="content-wrapper">
			
				<div class="container">
			
					<div class="row">
					
						<div class="col-sm-12 visible-xs mb-50">

							<div class="price-summary-wrapper">
								
								<h4 class="heading mt-0 text-primary uppercase">Мой заказ</h4>
							
								<ul class="price-summary-list">
								
									<li>
										<h6 class="heading mt-0 mb-0">Croatia Sailing &amp; Cruising</h6>
										<p class="font12 text-light">4 days 3 nights city tour</p>
									</li>
									
									<li>
										<h6 class="heading mt-0 mb-0">Starts in Dubrovnik, Croatia</h6>
										<p class="font12 text-light">Monday, March 7, 2016</p>
									</li>
									
									<li>
										<h6 class="heading mt-0 mb-0">Ends in Hvar, Croatia</h6>
										<p class="font12 text-light">Thursday, March 10, 2016</p>
									</li>
									
									<li>
										<h6 class="heading mt-0 mb-0">What's included</h6>
										<p class="font12 text-light">Accommodation, Guide, Meals, Bus</p>
									</li>
									
									<li class="divider"></li>
									
									<li>
										<h6 class="heading mt-20 mb-5 text-primary uppercase">Price per person</h6>
										<div class="row gap-10 mt-10">
											<div class="col-xs-7 col-sm-7">
												Brochure Price
											</div>
											<div class="col-xs-5 col-sm-5 text-right">
												$1458
											</div>
										</div>
										<div class="row gap-10 mt-10">
											<div class="col-xs-7 col-sm-7">
												Tax &amp; fee
											</div>
											<div class="col-xs-5 col-sm-5 text-right">
												$0
											</div>
										</div>
									</li>
									
									<li class="divider"></li>
									
									<li class="text-right font600 font14">
										$1458
									</li>
									
									<li class="divider"></li>
									
									<li>
									
										<div class="row gap-10 font600 font14">
											<div class="col-xs-9 col-sm-9">
												Number of Travellers
											</div>
											<div class="col-xs-3 col-sm-3 text-right">
												1
											</div>
										</div>
									
									</li>
									
									<li class="total-price">
									
										<div class="row gap-10">
											<div class="col-xs-6 col-sm-6">
												<h5 class="heading mt-0 mb-0 text-white">Amount due</h5>
												<p class="font12">before departure</p>
											</div>
											<div class="col-xs-6 col-sm-6 text-right">
												<span class="block font20 font600 mb-5">$1458</span>
												<span class="font10 line10 block">**Best Price Guarantee </span>
											</div>
										</div>
									
									</li>
									
								</ul>
								
							</div>
							
						</div>

						<div role="main" class="col-sm-8 col-md-9">
	
							<!--div class="section-title text-left">
								
								<h3>Croatia Sailing &amp; Cruising <small> / 4 days 3 nights</small></h3>
								
							</div-->
							
							<div class="payment-container">
							
								<form>	
									
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
													<div class="form-group gap-20">
														<label class="col-sm-3 col-md-2 control-label">Email:</label>
														<div class="col-sm-5 col-md-4">
															<input type="text" value="" class="form-control">
														</div>
														<label class="col-sm-3 col-md-2 control-label">Телефон:</label>
														<div class="col-sm-5 col-md-4">
															<input type="text" value="" class="form-control">
														</div>
													</div>
												</div>
											
										</div>
										
									</div>
									
									<div class="payment-box">
									
										<div class="payment-header clearfix">
										
											<div class="number">
												2
											</div>
											
											<h5 class="heading mt-0">Информация о туристах</h5>
										
										</div>
										
										<div class="payment-content">
											
											<div class="payment-traveller">
											
												<div class="row gap-0">
												
													<div class="col-sm-9 col-sm-offser-3 col-md-10 col-md-offset-2">
														<h6 class="heading">Турист 1</h6>
													</div>
													
												</div>

													
												<div class="form-horizontal">
													<div class="form-group gap-20">
														<label class="col-sm-3 col-md-2 control-label">Имя:</label>
														<div class="col-sm-5 col-md-4">
															<input type="text" value="" class="form-control">
														</div>
													</div>
												</div>
												
												<div class="form-horizontal">
													<div class="form-group gap-20">
														<label class="col-sm-3 col-md-2 control-label">Фамилия:</label>
														<div class="col-sm-5 col-md-4">
															<input type="text" value="" class="form-control">
														</div>
													</div>
												</div>
												
												<div class="form-horizontal">
													<div class="form-group gap-20 select2-input-hide">
														<label class="col-sm-3 col-md-2 control-label">Пол:</label>
														<div class="col-sm-3 col-md-2">
															<select data-placeholder="Gender" class="select2-no-search form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true">
																<option value="">Пол</option>	
																<option value="male">Мужской</option>
																<option value="female">Женский</option>
															</select><span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" style="width: 115px;"><span class="selection"><span aria-expanded="false" aria-haspopup="true" role="combobox" class="select2-selection select2-selection--single" tabindex="0" aria-labelledby="select2-wl00-container"><span class="select2-selection__rendered" id="select2-wl00-container" title="Female."><span class="select2-selection__clear">×</span>Female.</span><span role="presentation" class="select2-selection__arrow"><b role="presentation"></b></span></span></span><span aria-hidden="true" class="dropdown-wrapper"></span></span>

														</div>
													</div>
												</div>
												
												<div class="form-horizontal">
													<div class="form-group gap-20 select2-input-hide">
														<label class="col-sm-3 col-md-2 control-label">Дата рождения:</label>
														<div class="col-sm-8 col-md-6">
															
															<div class="row gap-15">
															
																<div class="col-xs-4 col-sm-4">
																	<select data-placeholder="Date" class="select2-no-search form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true">
																		<option value="">Date</option>	
																		<option value="01">01</option>
																		<option value="02">02</option>
																		<option value="03">03</option>
																		<option value="04">04</option>
																		<option value="05">05</option>
																		<option value="06">06</option>
																		<option value="07">07</option>
																	</select><span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" style="width: 118px;"><span class="selection"><span aria-expanded="false" aria-haspopup="true" role="combobox" class="select2-selection select2-selection--single" tabindex="0" aria-labelledby="select2-0j54-container"><span class="select2-selection__rendered" id="select2-0j54-container" title="03"><span class="select2-selection__clear">×</span>03</span><span role="presentation" class="select2-selection__arrow"><b role="presentation"></b></span></span></span><span aria-hidden="true" class="dropdown-wrapper"></span></span>
																</div>
																
																<div class="col-xs-4 col-sm-4">
																	<select data-placeholder="Month" class="select2-no-search form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true">
																		<option value="">Month</option>	
																		<option value="jan">Jan</option>
																		<option value="feb">Feb</option>
																		<option value="mar">Mar</option>
																		<option value="apr">Apr</option>
																		<option value="may">May</option>
																		<option value="jun">Jun</option>
																		<option value="jul">Jul</option>
																	</select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 118px;"><span class="selection"><span aria-expanded="false" aria-haspopup="true" role="combobox" class="select2-selection select2-selection--single" tabindex="0" aria-labelledby="select2-f5tv-container"><span class="select2-selection__rendered" id="select2-f5tv-container"><span class="select2-selection__placeholder">Month</span></span><span role="presentation" class="select2-selection__arrow"><b role="presentation"></b></span></span></span><span aria-hidden="true" class="dropdown-wrapper"></span></span>
																</div>
																
																<div class="col-xs-4 col-sm-4">
																	<select data-placeholder="Year" class="select2-no-search form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true">
																		<option value="">Year</option>	
																		<option value="1985">1985</option>
																		<option value="1986">1986</option>
																		<option value="1987">1987</option>
																		<option value="1988">1988</option>
																		<option value="1900">1900</option>
																		<option value="1901">1901</option>
																		<option value="1902">1902</option>
																	</select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 118px;"><span class="selection"><span aria-expanded="false" aria-haspopup="true" role="combobox" class="select2-selection select2-selection--single" tabindex="0" aria-labelledby="select2-80rv-container"><span class="select2-selection__rendered" id="select2-80rv-container"><span class="select2-selection__placeholder">Year</span></span><span role="presentation" class="select2-selection__arrow"><b role="presentation"></b></span></span></span><span aria-hidden="true" class="dropdown-wrapper"></span></span>
																</div>
															
															</div>

														</div>
													</div>
												</div>
												
												<div class="form-horizontal">
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
												</div>
												
											</div>
											
											<div class="payment-traveller">
											
												<a class="pull-right font12 traveller-remove" href="#"><i class="fa fa-times-circle"></i></a>
												
												<div class="row gap-0 gap-15">
												
													<div class="col-sm-9 col-sm-offser-3 col-md-10 col-md-offset-2">
														<h6 class="heading">Traveller 2</h6>
													</div>
													
												</div>

												<div class="form-horizontal">
													<div class="form-group gap-20 select2-input-hide">
														<label class="col-sm-3 col-md-2 control-label">Title:</label>
														<div class="col-sm-3 col-md-2">
															<select data-placeholder="Title" class="select2-no-search form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true">
																<option value="">Title</option>	
																<option value="mr">Mr.</option>
																<option value="mrs">Mrs.</option>
																<option value="miss">Miss</option>
															</select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 115px;"><span class="selection"><span aria-expanded="false" aria-haspopup="true" role="combobox" class="select2-selection select2-selection--single" tabindex="0" aria-labelledby="select2-dr08-container"><span class="select2-selection__rendered" id="select2-dr08-container"><span class="select2-selection__placeholder">Title</span></span><span role="presentation" class="select2-selection__arrow"><b role="presentation"></b></span></span></span><span aria-hidden="true" class="dropdown-wrapper"></span></span>

														</div>
													</div>
												</div>
													
												<div class="form-horizontal">
													<div class="form-group gap-20">
														<label class="col-sm-3 col-md-2 control-label">First Name:</label>
														<div class="col-sm-5 col-md-4">
															<input type="text" value="" class="form-control">
														</div>
													</div>
												</div>
												
												<div class="form-horizontal">
													<div class="form-group gap-20">
														<label class="col-sm-3 col-md-2 control-label">Last Name:</label>
														<div class="col-sm-5 col-md-4">
															<input type="text" value="" class="form-control">
														</div>
													</div>
												</div>
												
												<div class="form-horizontal">
													<div class="form-group gap-20 select2-input-hide">
														<label class="col-sm-3 col-md-2 control-label">Gender:</label>
														<div class="col-sm-3 col-md-2">
															<select data-placeholder="Gender" class="select2-no-search form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true">
																<option value="">Gender</option>	
																<option value="male">Male.</option>
																<option value="female">Female.</option>
															</select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 115px;"><span class="selection"><span aria-expanded="false" aria-haspopup="true" role="combobox" class="select2-selection select2-selection--single" tabindex="0" aria-labelledby="select2-i371-container"><span class="select2-selection__rendered" id="select2-i371-container"><span class="select2-selection__placeholder">Gender</span></span><span role="presentation" class="select2-selection__arrow"><b role="presentation"></b></span></span></span><span aria-hidden="true" class="dropdown-wrapper"></span></span>

														</div>
													</div>
												</div>
												
												<div class="form-horizontal">
													<div class="form-group gap-20 select2-input-hide">
														<label class="col-sm-3 col-md-2 control-label">Gender:</label>
														<div class="col-sm-8 col-md-6">
															
															<div class="row gap-15">
															
																<div class="col-xs-4 col-sm-4">
																	<select data-placeholder="Date" class="select2-no-search form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true">
																		<option value="">Date</option>	
																		<option value="01">01</option>
																		<option value="02">02</option>
																		<option value="03">03</option>
																		<option value="04">04</option>
																		<option value="05">05</option>
																		<option value="06">06</option>
																		<option value="07">07</option>
																	</select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 118px;"><span class="selection"><span aria-expanded="false" aria-haspopup="true" role="combobox" class="select2-selection select2-selection--single" tabindex="0" aria-labelledby="select2-xzkr-container"><span class="select2-selection__rendered" id="select2-xzkr-container"><span class="select2-selection__placeholder">Date</span></span><span role="presentation" class="select2-selection__arrow"><b role="presentation"></b></span></span></span><span aria-hidden="true" class="dropdown-wrapper"></span></span>
																</div>
																
																<div class="col-xs-4 col-sm-4">
																	<select data-placeholder="Month" class="select2-no-search form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true">
																		<option value="">Month</option>	
																		<option value="jan">Jan</option>
																		<option value="feb">Feb</option>
																		<option value="mar">Mar</option>
																		<option value="apr">Apr</option>
																		<option value="may">May</option>
																		<option value="jun">Jun</option>
																		<option value="jul">Jul</option>
																	</select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 118px;"><span class="selection"><span aria-expanded="false" aria-haspopup="true" role="combobox" class="select2-selection select2-selection--single" tabindex="0" aria-labelledby="select2-d1qr-container"><span class="select2-selection__rendered" id="select2-d1qr-container"><span class="select2-selection__placeholder">Month</span></span><span role="presentation" class="select2-selection__arrow"><b role="presentation"></b></span></span></span><span aria-hidden="true" class="dropdown-wrapper"></span></span>
																</div>
																
																<div class="col-xs-4 col-sm-4">
																	<select data-placeholder="Year" class="select2-no-search form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true">
																		<option value="">Year</option>	
																		<option value="1985">1985</option>
																		<option value="1986">1986</option>
																		<option value="1987">1987</option>
																		<option value="1988">1988</option>
																		<option value="1900">1900</option>
																		<option value="1901">1901</option>
																		<option value="1902">1902</option>
																	</select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 118px;"><span class="selection"><span aria-expanded="false" aria-haspopup="true" role="combobox" class="select2-selection select2-selection--single" tabindex="0" aria-labelledby="select2-jzd6-container"><span class="select2-selection__rendered" id="select2-jzd6-container"><span class="select2-selection__placeholder">Year</span></span><span role="presentation" class="select2-selection__arrow"><b role="presentation"></b></span></span></span><span aria-hidden="true" class="dropdown-wrapper"></span></span>
																</div>
															
															</div>

														</div>
													</div>
												</div>
												
												<div class="form-horizontal">
													<div class="form-group gap-20">
														<label class="col-sm-3 col-md-2 control-label">Nationality:</label>
														<div class="col-sm-5 col-md-4">
															<select data-placeholder="Nationality" class="select2-single form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true">
																<option value="">Nationality</option>	
																<option value="Thai">Thai</option>
																<option value="Malaysian">Malaysian</option>
																<option value="Indonesian">Indonesian</option>
																<option value="American">American</option>
																<option value="England">England</option>
																<option value="German">German</option>
																<option value="Polish">Polish</option>
															</select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 250px;"><span class="selection"><span aria-expanded="false" aria-haspopup="true" role="combobox" class="select2-selection select2-selection--single" tabindex="0" aria-labelledby="select2-jxpk-container"><span class="select2-selection__rendered" id="select2-jxpk-container"><span class="select2-selection__placeholder">Nationality</span></span><span role="presentation" class="select2-selection__arrow"><b role="presentation"></b></span></span></span><span aria-hidden="true" class="dropdown-wrapper"></span></span>
														</div>
													</div>
												</div>
												
											</div>
											
											<div class="text-center">
												<button class="btn btn-primary btn-sm btn-inverse">Add another traveller</button>
											</div>
											
										</div>
										
									</div>


									
									<div class="checkbox-block">
										<input type="checkbox" value="paymentsCreditCard" class="checkbox" name="accept_booking" id="accept_booking">
										<label for="accept_booking" class="">Я согласен с  <a href="#">договором публичной оферты</a>  и  <a href="#">правилами аннуляции</a> .</label>
									</div>
									
									<div class="row mt-20">
												
										<div class="col-sm-8 col-md-6">
										
											<button class="btn btn-primary">Бронировать</button>
											
											<p class="line18 mt-10"><span class="font600">Prepared is me marianne</span>: pleasure likewise debating. Wonder an unable except better stairs do ye admire.</p>
										
										</div>
										
									</div>
									
								</form>
								
							</div>
							
						</div>

						<div class="col-sm-4 col-md-3 hidden-xs">

							<div class="price-summary-wrapper">
								
								<h4 class="heading mt-0 text-primary uppercase">Мой заказ</h4>
							
								<ul class="price-summary-list">
								
									<li>
										<h6 class="heading mt-0 mb-0">Президент Отель 5*</h6>
										<p class="font12 text-light">4 дня \ 3 ночи</p>
									</li>
									
									<li>
										<h6 class="heading mt-0 mb-0">Starts in Dubrovnik, Croatia</h6>
										<p class="font12 text-light">Monday, March 7, 2016</p>
									</li>
									
									<li>
										<h6 class="heading mt-0 mb-0">Ends in Hvar, Croatia</h6>
										<p class="font12 text-light">Thursday, March 10, 2016</p>
									</li>
									
									<li>
										<h6 class="heading mt-0 mb-0">What's included</h6>
										<p class="font12 text-light">Accommodation, Guide, Meals, Bus</p>
									</li>
									
									<li class="divider"></li>
									
									<li>
										<h6 class="heading mt-20 mb-5 text-primary uppercase">Price per person</h6>
										<div class="row gap-10 mt-10">
											<div class="col-xs-7 col-sm-7">
												Brochure Price
											</div>
											<div class="col-xs-5 col-sm-5 text-right">
												$1458
											</div>
										</div>
										<div class="row gap-10 mt-10">
											<div class="col-xs-7 col-sm-7">
												Tax &amp; fee
											</div>
											<div class="col-xs-5 col-sm-5 text-right">
												$0
											</div>
										</div>
									</li>
									
									<li class="divider"></li>
									
									<li class="text-right font600 font14">
										$1458
									</li>
									
									<li class="divider"></li>
									
									<li>
									
										<div class="row gap-10 font600 font14">
											<div class="col-xs-9 col-sm-9">
												Number of Travellers
											</div>
											<div class="col-xs-3 col-sm-3 text-right">
												1
											</div>
										</div>
									
									</li>
									
									<li class="total-price">
									
										<div class="row gap-10">
											<div class="col-xs-6 col-sm-6">
												<h5 class="heading mt-0 mb-0 text-white">Amount due</h5>
												<p class="font12">before departure</p>
											</div>
											<div class="col-xs-6 col-sm-6 text-right">
												<span class="block font20 font600 mb-5">$1458</span>
												<span class="font10 line10 block">**Best Price Guarantee </span>
											</div>
										</div>
									
									</li>
									
								</ul>
								
							</div>
							
						</div>

					</div>
				
				</div>
					
			</div>

		</div>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>