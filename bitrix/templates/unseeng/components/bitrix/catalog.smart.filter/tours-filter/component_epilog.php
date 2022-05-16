<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<script type="text/javascript">
	//==================================================================================//
	//						          AJAX CATALOG                                      //
	//==================================================================================//

			$(document).ready(function(){

				// duration Range Slider
				$("#duration_range").ionRangeSlider({
					type: "double",
					grid: true,
					min: $(this).data("min"),
					max: $(this).data("max"),
					from: $(this).data("from"),
					to: $(this).data("to"),
					prefix: "",
					onFinish: function(v){ $("#min-filter-duration").val(v.from), $("#max-filter-duration").val(v.to) }
				})

				var marker = "ajax"; 

				if(!$('#' + marker).length)
					return;

				var form = $("#catalog-form"),
					reset = $(".sidebar-reset-filter"),
					iRS = $("#price_range").data("ionRangeSlider"),
					iRSD = $("#duration_range").data("ionRangeSlider"),
					sending = false;

				/* включаем preloader */
				function iPre()
				{
					$(".ajax-preloader").introLoader({
						animation: {
								name: 'gifLoader',
								options: {
										ease: "easeInOutCirc",
										style: 'dark bubble',
										delayBefore: 500,
										delayAfter: 0,
										exitTime: 300
								}
						}
					});	
				}

				/**
				* отправка ajax запроса
				*/
				function s(url, params)
				{
					if(sending)
						return false;

					$.ajax({
						url: url,
						method: "POST",
						data: params,
						dataType: "html",
						beforeSend: function(){
							sending = true;
							iPre();
						},
						success: function(data){ 
							
							$("body").scrollTop($("#" + marker).offset().top -120);

							$("#" + marker).html(data);

							history.pushState(null, null, url);

						},
						complete: function(){
							sending = false;
						},
					});
				}

				/**
				* отмена отправки формы
				*/
				$("#catalog-form").on('submit', function(){ return false; });

				/**
				* очистка значений формы
				*/
				reset.on("click", function(e){

					sending = true;

					form.find("input[type='checkbox']").each(function(){

						var t = $(this);

						t.attr("checked", false);

					});

					form.find("select").each(function(){

						$(this).select2("val", "");

					});

					sending = false;

					s(form.attr("action"), {ajax: 'ajax'});

					e.preventDefault();

				});

				/**
				* submit формы по checkbox
				*/
				form.find("input[type='checkbox']").on("click", function(){

					s(form.attr("action") + "?" + form.serialize(), {ajax: 'ajax'});

				});

				/**
				* submit формы по select2
				*/
				form.find("select").select2({
					"allowClear": true
				}).on("change", function(){

								s(form.attr("action") + "?" + form.serialize(), {ajax: 'ajax'});

							});

				/**
				* submit формы по ionRangeSlider
				*/
				if(iRS)
					iRS.update({"onFinish": function(o){
							$("#min-filter-price").val(o.from);
							$("#max-filter-price").val(o.to);
							s(form.attr("action") + "?" + form.serialize(), {ajax: 'ajax'});
						}
					});

				if(iRSD)
					iRSD.update({"onFinish": function(o){
							$("#min-filter-duration").val(o.from);
							$("#max-filter-duration").val(o.to);
							s(form.attr("action") + "?" + form.serialize(), {ajax: 'ajax'});
						}
					});

				/**
				* submit формы по датам
				*/
				$("#date-filter-from, #date-filter-to").on("change", function(){
					s(form.attr("action") + "?" + form.serialize(), {ajax: 'ajax'});
				})

				/**
				* pager, sorting
				*/
				$(document).on("click", ".pagination a", function(e){
					var get_params = $(this).attr("href"), post_params = {ajax: 'ajax'};
					s(get_params, post_params);
					e.preventDefault();

				});

				/**
				* datapicker
				*/
				if($("#date-filter-from").length || $("#date-filter-to").length)
				{

					$("#date-filter-from").datepicker({
		                showOtherMonths: !0,
		                selectOtherMonths: !0,
						minDate: "0",
						defaultDate: "+7d",
						firstDay: "1",
						dateFormat: "dd.mm.yy",
						dayNamesMin: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
						onClose: function( selectedDate ) {
								$( "#date-filter-to" ).datepicker( "option", "minDate", selectedDate );
						}

		            });
		            $("#date-filter-to").datepicker({
		                showOtherMonths: !0,
		                selectOtherMonths: !0,
						minDate: $("#date-filter-from").val(),
						defaultDate: "+7d",
						firstDay: "1",
						dateFormat: "dd.mm.yy",
						dayNamesMin: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"]
		            });

					$(".click_datepicker_from").on("click", function(){
						$("#date-filter-from").datepicker("show");
					});
					$(".click_datepicker_to").on("click", function(){
						$("#date-filter-to").datepicker("show");
					});
		        }


		        /* устанавливаем стили для городов и регионов */
		        function setCss(o, v)
		        {
		        	var inputs = o.find('.city');

		        	if(v == 1)
		        	{
						o.css({/*'overflow-y': 'scroll', height: '200px', */'margin-bottom': '20px'});
		        		inputs.css({'margin-left': '2px'});
		        	}
		        	else if(v == 2)
		        	{
		        		o.removeProp('overflow-y');
		        		o.removeProp('height');
		        		o.removeProp('margin-bottom');
		        		inputs.removeProp('margin-left');
		        	}
		        }


	            /**
	            * скрываем/показываем города
	            */
	            function showCity()
	            {
	            	var sel = [], c = $(".show-city:checked"), regionMustShow = false, cityMustShow = false; regionsCnt = 0; citiesCnt = 0, tot_cnt = 10;
	            	if(c.length)
	            	{
		            	c.each(function(){
		            		sel.push(".country-" + $(this).data("id"));
		            		
		            		if($('.region').find(".country-" + $(this).data("id")).length > 0)
		            		{
		            			regionsCnt = regionsCnt + $('.region').find(".country-" + $(this).data("id")).length;
		            			regionMustShow = true;
		            		}

		            		if($('.cities').find(".country-" + $(this).data("id")).length > 0)
		            		{
		            			citiesCnt = citiesCnt + $('.cities').find(".country-" + $(this).data("id")).length;
		            			cityMustShow = true;
		            		}
		            		
		            	});

		            	$(".city").hide();

		            	$('.must-show').show();
		            	
		            	if(regionMustShow)
		            	{
		            		if(regionsCnt > tot_cnt)
		            			setCss($('.region'),1);
		            		else
		            			setCss($('.region'),2);
		            		$('.region').show();
		            	}
		            	else
		            		$('.region').hide();
		            	
		            	if(cityMustShow)
		            	{
		            		if(citiesCnt > tot_cnt)
		            			setCss($('.cities'),1);
		            		else
		            			setCss($('.cities'),2);
		            		$('.cities').show();
		            	}
		            	else
		            		$('.cities').hide();

		            	$(sel.join(",")).show();
		            }
		            else
		            {		       
		            	$('.must-show').hide();     	
		            	$(".city").show();
		            }
	            }

	            $(document).on("click", ".show-city", function(){
	            	showCity();	            	
	            });

	            if($(".show-city:checked").length > 0)
	            	showCity();
			});

	//==================================================================================//

</script>

<?
// формируем фильтр для туров с непроставленными датами
if(!empty($GLOBALS['arrFilter']['>=PROPERTY_97']))
{
	$filter[] = array(
					"LOGIC" => "OR",
					array('>=PROPERTY_97' => $GLOBALS['arrFilter']['>=PROPERTY_97']),
					array('=PROPERTY_97' => false)
				);
	unset($GLOBALS['arrFilter']['>=PROPERTY_97']);
}
else
	if(!empty($GLOBALS['arrFilter']['<=PROPERTY_97']))
	{
		$filter[] = array(
					"LOGIC" => "OR",
					array('<=PROPERTY_97' => $GLOBALS['arrFilter']['<=PROPERTY_97']),
					array('=PROPERTY_97' => false)
				);
		unset($GLOBALS['arrFilter']['<=PROPERTY_97']);
	}
	else
		if(!empty($GLOBALS['arrFilter']['><PROPERTY_97']))
		{
			$filter[] = array(
					"LOGIC" => "OR",
					array('><PROPERTY_97' => $GLOBALS['arrFilter']['><PROPERTY_97']),
					array('=PROPERTY_97' => false)
				);
			unset($GLOBALS['arrFilter']['><PROPERTY_97']);
		}

if($filter)
	$GLOBALS['arrFilter'] = array_merge($GLOBALS['arrFilter'], $filter);

if($arParams['DURATION_TITLE'] != "" && $GLOBALS['arrFilter']["><PROPERTY_375"][1] > 0)
{
	$GLOBALS['arrFilter']["><PROPERTY_375"][1]--;
	$GLOBALS['arrFilter']["><PROPERTY_375"][0]--;
}