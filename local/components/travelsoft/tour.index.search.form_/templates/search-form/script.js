(function($){
	
	$(document).ready(function(){

		$(".tourindex .select2-multi").select2({placeholder: $(this).data('placeholder')}).change(function(e){

			var val = $(this).val(),
				ti = $(".tourindexselect[name='co']").find('option[value="' + val + '"]').data('ti');

				$('.tourindexinput[name="ti"]').val(ti);
				

		});

		$(".tourindex .select2-multi.country").select2(
			{
				placeholder: $(this).data('placeholder'),
				formatNoMatches: function () {
				  return "Выберите город отправления";
				  },
				language: {
					   noResults: function(){
						   return "Выберите город отправления";
					   }
				   }
			});




		////////////////////////////////////////////////////////////////////////////////// 
		//						               CALENDAR									//
		//////////////////////////////////////////////////////////////////////////////////
		
		function tripleToggle()
		{
			$('.tourindex .delta-days').toggle();
			$('.tourindex .nights').toggle();
			$('.tourindex .white').toggle();
		}

		function initDatePicker(o)
		{
			o.datepicker({
				showOtherMonths: !0,
				selectOtherMonths: !0,
				minDate: new Date(),
				defaultDate: $('.tourindex .days-text').data('def-date'),
				firstDay: "1",
				autoSize: true,
				dateFormat: "dd.mm.yy",
				dayNamesMin: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
				monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
	                'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'
	            ],
	            onSelect: function(date) {
	            	setDaysValue(dateContainer_ti.datepicker('getDate').getTime());
	            },
	            beforeShowDay: function(date){
	            	
	            	if(!$('.tourindex input[name="days"]').is(':checked'))
	            		return [true, ''];
	            	

	            	var dates = getUnixDateInterval( dateContainer_ti.datepicker('getDate').getTime() );
	            		date = date.getTime();
	            	return [true, (dates[0] <= date && date <= dates[1]) ? 'date-select-color' : ''];
	            
	            },

			});

			tripleToggle();

			return true;
			
		}

		function datePickerToggle()
		{
			$('.tourindex .ui-widget').toggle();
			tripleToggle();
		}

		function getUnixDateInterval(unixDate)
		{
			var unixRange = 3*24*3600*1000,
				unixMinDate = unixDate - unixRange,
				unixMaxDate = unixDate + unixRange,
				minDate, maxDate;

				unixMinDate = (unixMinDate < (new Date()).getTime()) ? (new Date()).getTime() : unixMinDate;

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
			
			if(!$('.tourindex input[name="days"]').is(":checked"))
			{
				$('.tourindex input[name="df"]').val(date);
				$('.tourindex input[name="dt"]').val(date);
			}
			else
			{
				var maxMin = getUnixDateInterval(dateUnix),
						df = convertDate(new Date(maxMin[0])),
						dt = convertDate(new Date(maxMin[1]));
				
				$('.tourindex input[name="df"]').val(df);
				$('.tourindex input[name="dt"]').val(dt);

				$('.tourindex .days-text').text(df + ' - ' + dt);
			}


			$('.tourindex .days-text').text(date);
		}

		function setNightValues()
		{
			$('.tourindex .night-text').text('Ночей: ' + $('.tourindex select[name="nf"]').val() + ' - ' + $('.tourindex select[name="nt"]').val())
		}

		var isInit = false, isDatePickerClose = true; isPeopleContainerClose = true ;dateContainer_ti = $('.date-container');
		

		// events

		///////////////////////////////////////////////// all clicks
		dateContainer_ti.click(function(e){

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

		$('.tourindex .closeDatePicker').click(function(e){

			datePickerToggle();
			isDatePickerClose = true;
			e.preventDefault();
			e.stopPropagation();
		});

		$('body').click(function(e){

			if(!isPeopleContainerClose)
			{
				var ad = Number($('.tourindex select[name="ad"]').val()),
					ch = Number($('.tourindex select[name="ch"]').val());
				$('.tourindex .adults').text('Взрослых: ' + (ad ? ad : 0));
				$('.tourindex .children').text('Детей: ' + (ch ? ch : 0));

				$('.tourindex .people-hide-container').hide();
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

		$('.tourindex .days-checker').click(function(){
			$('.tourindex input[name="days"]').trigger('click');
		});

		$('.tourindex input[name="days"]').click(function(e){

			dateContainer_ti.datepicker('refresh');
			setDaysValue(dateContainer_ti.datepicker('getDate').getTime());

			//e.stopPropagation();

		});

		$('.tourindex .people-container').click(function(e){

			$('.tourindex .people-hide-container').show();
			isPeopleContainerClose = false;

			e.preventDefault();
			e.stopPropagation();

		});

		$('.tourindex .search-ti').click(function(){
			$(this).closest('form').submit();
		})

		///////////////////////////////////////////////////////

		$('.tourindex select[name="nt"]').change(function(e){

			var $this = $(this),
				min = Number($('.tourindex select[name="nf"]').val()),
				curr = Number($this.val());
				

			if(curr < min)
			
				$this.children('.tourindex option[value="' + min + '"]').prop('selected', true);
		
			setNightValues();
		});

		$('.tourindex select[name="nf"]').change(function(e){

			var $this = $(this),
				nt = $('.tourindex select[name="nt"]');
				max = Number(nt.val()),
				curr = Number($this.val());

			if(curr > max)
			
				nt.children('.tourindex option[value="' + curr + '"]').prop('selected', true);

			setNightValues();

		});

		$(".tourindex select[name='ct']").on("change", function(){
			var cityid = $(this).val(), html = '<option></option>';

			console.log(bx_search_ti[cityid]);

			for (countryid in bx_search_ti[cityid]){
				html += '<option value="' + countryid + '">' + bx_counties_ti[countryid]["NAME"] + '</option>';
			}

			$(".tourindex select[name='co']").html(html);
			$(".tourindex select[name='co']").select2("val", "");

			//Сортировка стран прибытия
			var $target = $('.tourindex select[name="co"]');
			var $elements = $('.tourindex select[name="co"] option');

			$elements.sort(function (a, b) {
				var an = $(a).text(),
					bn = $(b).text();
				 
				if (an && bn) {
					return an.toUpperCase().localeCompare(bn.toUpperCase());
				}

				return 0;
			});
    		$elements.detach().appendTo($target);


		});

		////////////////////////////////////////////////////////////////////////////

		//Сортировка городов отправления
		$target = $('select.select2-multi.form-control.select2-hidden-accessible');
		$elements = $('select.select2-multi.form-control.select2-hidden-accessible option');

		$elements.sort(function (a, b) {
			var an = $(a).text(),
				bn = $(b).text();

			if (an && bn) {
				return an.toUpperCase().localeCompare(bn.toUpperCase());
			}

			return 0;
		});
    	$elements.detach().appendTo($target);

	});
})(jQuery);