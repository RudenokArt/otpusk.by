(function($){
	
	$(document).ready(function(){



		$(".select2-multi").select2({placeholder: $(this).data('placeholder')}).change(function(e){
			var val = $(this).val(),
				ti = $('select[name="co"]').find('option[value="' + val + '"]').data('ti');

				$('input[name="ti"]').val(ti);
				

		});


		////////////////////////////////////////////////////////////////////////////////// 
		//						               CALENDAR									//
		//////////////////////////////////////////////////////////////////////////////////
		
		function tripleToggle()
		{
			$('.delta-days').toggle();
			$('.nights').toggle();
			$('.white').toggle();
		}

		function initDatePicker(o)
		{
			o.datepicker({
				showOtherMonths: !0,
				selectOtherMonths: !0,
				minDate: new Date(),
				defaultDate: $('.days-text').data('def-date'),
				firstDay: "1",
				autoSize: true,
				dateFormat: "dd.mm.yy",
				dayNamesMin: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
				monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
	                'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'
	            ],
	            onSelect: function(date) {
	            	setDaysValue(dateContainer.datepicker('getDate').getTime());
	            },
	            beforeShowDay: function(date){
	            	
	            	if(!$('input[name="days"]').is(':checked'))
	            		return [true, ''];
	            	

	            	var dates = getUnixDateInterval( dateContainer.datepicker('getDate').getTime() );
	            		date = date.getTime();
	            	return [true, (dates[0] <= date && date <= dates[1]) ? 'date-select-color' : ''];
	            
	            },

			});

			tripleToggle();

			return true;
			
		}

		function datePickerToggle()
		{
			$('.ui-widget').toggle();
			tripleToggle();
		}

		function getUnixDateInterval(unixDate)
		{
			var unixRange = 3*24*3600*1000,
				unixMinDate = unixDate - unixRange,
				unixMaxDate = unixDate + unixRange,
				minDate, maxDate;

				unixMinDate = (unixMinDate < new Date().getTime()) ? new Date().getTime() : unixMinDate;

				return [unixMinDate, unixMaxDate];
		}

		function convertDate(date) // input date object
		{
			var day = date.getDate(),
				month = date.getMonth() + 1,
				year = date.getFullYear();

				return (day < 10 ? '0' + day : day ) + '.' + (month < 10 ? '0' + month : month) + '.' + year;

		}

		function setDaysValue(dateUnix)
		{
			var date = convertDate(new Date(dateUnix));
			
			if(!$('input[name="days"]').is(":checked"))
			{
				$('input[name="df"]').val(date);
				$('input[name="dt"]').val(date);
			}
			else
			{
				var maxMin = getUnixDateInterval(dateUnix),
						df = convertDate(new Date(maxMin[0])),
						dt = convertDate(new Date(maxMin[1]));
				
				$('input[name="df"]').val(df);
				$('input[name="dt"]').val(dt);

				$('.days-text').text(df + ' - ' + dt);
			}


			$('.days-text').text(date);
		}

		function setNightValues()
		{
			$('.night-text').text('Ночей: ' + $('select[name="nf"]').val() + ' - ' + $('select[name="nt"]').val())
		}

		var isInit = false, isDatePickerClose = true; isPeopleContainerClose = true ;dateContainer = $('.date-container');
		

		// events

		///////////////////////////////////////////////// all clicks
		dateContainer.click(function(e){

			if(!isInit)
			{
				isInit = initDatePicker($(this));
				isDatePickerClose = false;
			}
			else 
				if(isDatePickerClose)
				{
					datePickerToggle();
					isDatePickerClose = false;
				}

			e.preventDefault();
			e.stopPropagation();
		});

		$('.closeDatePicker').click(function(e){

			datePickerToggle();
			isDatePickerClose = true;
			e.preventDefault();
			e.stopPropagation();
		});

		$('body').click(function(e){

			if(!isPeopleContainerClose)
			{
				var ad = Number($('select[name="ad"]').val()),
					ch = Number($('select[name="ch"]').val());
				$('.adults').text('Взрослых: ' + (ad ? ad : 0));
				$('.children').text('Детей: ' + (ch ? ch : 0));

				$('.people-hide-container').hide();
				isPeopleContainerClose = true;
			}

			if(!isDatePickerClose)
			{
				datePickerToggle();
				isDatePickerClose = true;
			}

			//e.preventDefault();
			//e.stopPropagation();

		});

		$('.days-checker').click(function(){
			$('input[name="days"]').trigger('click');
		});

		$('input[name="days"]').click(function(e){

			dateContainer.datepicker('refresh');
			setDaysValue(dateContainer.datepicker('getDate').getTime());

			e.stopPropagation();

		});

		$('.people-container').click(function(e){

			$('.people-hide-container').show();
			isPeopleContainerClose = false;

			e.preventDefault();
			e.stopPropagation();

		});

		$('.search-ti').click(function(){
			$(this).closest('form').submit();
		})

		///////////////////////////////////////////////////////

		$('select[name="nt"]').change(function(e){

			var $this = $(this),
				min = Number($('select[name="nf"]').val()),
				curr = Number($this.val());
				

			if(curr < min)
			
				$this.children('option[value="' + min + '"]').prop('selected', true);
		
			setNightValues();
		});

		$('select[name="nf"]').change(function(e){

			var $this = $(this),
				nt = $('select[name="nt"]');
				max = Number(nt.val()),
				curr = Number($this.val());

			if(curr > max)
			
				nt.children('option[value="' + curr + '"]').prop('selected', true);

			setNightValues();

		});

		////////////////////////////////////////////////////////////////////////////


	});
})(jQuery);