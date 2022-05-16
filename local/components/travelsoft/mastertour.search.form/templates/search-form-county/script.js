(function($){
	
	$(document).ready(function(){

		var isPeopleContainerClose = true;
        var arDatesMT = [];

        if($(".master select[name='ct']").val() != "") {
            var cityid = $(".master select[name='ct']").val(), html = '<option></option>';
            for (countryid in bx_search[cityid]){
                var select = '';
                if (countryid == window.id_country) select = "selected";
                html += '<option value="' + countryid + '" ' + select + '>' + bx_counties[countryid]["NAME"] + '</option>';
            }

            $(".master select[name='co']").html(html);
        }

		$(".master .select2-multi").select2({placeholder: $(this).data('placeholder')});




		////////////////////////////////////////////////////////////////////////////////// 
		//						               CALENDAR									//
		//////////////////////////////////////////////////////////////////////////////////
		
		function tripleToggle()
		{
			$('.master .delta-days').toggle();
			$('.master .nights').toggle();
			$('.master .white').toggle();
		}

        function getDatesMT() {

            var datesMT=[];
            if($(".master select[name='ct']").val() != "" && $(".master select[name='ct']").val() != null && typeof bx_search[$(".master select[name='ct']").val()] !== "undefined"){
                city = $(".master select[name='ct']").val();
                if($(".master select[name='co']").val() != "" && $(".master select[name='co']").val() != null && bx_search[city][$(".master select[name='co']").val()] !== "undefined"){
                    country = $(".master select[name='co']").val();
                    if(bx_search[city][$(".master select[name='co']").val()] == 163){
                        //if(typeof bx_dates[bx_cities[city]["MASTERTOUR"]] !== "undefined" && typeof bx_dates[bx_buscities[city]["MASTERTOUR"]][bx_counties[country]["MASTERTOUR"]] !== "undefined"){
                        if(typeof bx_dates[bx_cities[city]["MASTERTOUR"]] !== "undefined"){
                            id_master_city = bx_cities[city]["MASTERTOUR"];
                            id_master_country = bx_counties[country]["MASTERTOUR"];
                            datesMT = (typeof bx_dates[id_master_city][id_master_country] !== "undefined" && typeof bx_dates[id_master_city][id_master_country][1000] !== "undefined") ? bx_dates[id_master_city][id_master_country][1000] : [];
                        }
                    }
                    else if(bx_search[city][$(".master select[name='co']").val()] == 164){
                        //sletat.ru
                    }

                }
            }

            return datesMT;

        }

		function initDatePicker(o)
		{

            var startDateTour = $('.master .days-text').data('def-date');

            arDatesMT = getDatesMT();

            if(arDatesMT.length > 0)
                startDateTour = arDatesMT[0];

			o.datepicker({
				showOtherMonths: !0,
				selectOtherMonths: !0,
				minDate: new Date(),
				defaultDate: startDateTour,
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

                    if(!$('.master input[name="days"]').is(':checked'))
                        return [true, ''];

                    if(arDatesMT.length > 0) {
                        var formattedDate = date.toLocaleDateString('pl', {
                            day: '2-digit',
                            year: 'numeric',
                            month: '2-digit'
                        });
                        if ($.inArray(formattedDate, arDatesMT) >= 0) {
                            //return {enabled: true, classes: 'active-date', tooltip: ''}
                            return [true, 'active-date bus-day'];
                        }

                    }

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
			$('.master .ui-widget').toggle();
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
			
			if(!$('.master input[name="days"]').is(":checked"))
			{
				$('.master input[name="df"]').val(date);
				$('.master input[name="dt"]').val(date);
			}
			else
			{
				var maxMin = getUnixDateInterval(dateUnix),
						df = convertDate(new Date(maxMin[0])),
						dt = convertDate(new Date(maxMin[1]));
				
				$('.master input[name="df"]').val(df);
				$('.master input[name="dt"]').val(dt);

				$('.master .days-text').text(df + ' - ' + dt);
			}


			$('.master .days-text').text(date);
		}

		function setNightValues()
		{
			$('.master .night-text').text('Ночей: ' + $('.master select[name="nf"]').val() + ' - ' + $('.master select[name="nt"]').val())
		}

		var isInit = false, isDatePickerClose = true; isPeopleContainerClose = true ;dateContainer = $('.master-date-container');
		

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
					$('.active-date').removeClass('active-date');
					arDatesMT = getDatesMT();
					if(arDatesMT.length > 0) {
						$(this).datepicker("setDate", arDatesMT[0]);
					}
					else{
						$(this).datepicker("setDate", $('.master .days-text').data('def-date'));
					}

					datePickerToggle();
					isDatePickerClose = false;
				}

			e.preventDefault();
			e.stopPropagation();
		});

		$('.master .closeDatePicker').click(function(e){

			datePickerToggle();
			isDatePickerClose = true;
			e.preventDefault();
			e.stopPropagation();
		});

		$('body').click(function(e){

			if(!isPeopleContainerClose)
			{
				var ad = Number($('.master select[name="ad"]').val()),
					ch = Number($('.master select[name="ch"]').val());
				$('.master .adults').text('Взрослых: ' + (ad ? ad : 0));
				$('.master .children').text('Детей: ' + (ch ? ch : 0));

				$('.master .people-hide-container').hide();
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

		$('.master .days-checker').click(function(){
			$('.master input[name="days"]').trigger('click');
		});

		$('.master input[name="days"]').click(function(e){

			dateContainer.datepicker('refresh');
			setDaysValue(dateContainer.datepicker('getDate').getTime());

			//e.stopPropagation();

		});

		$('.master .people-container').click(function(e){

			$('.master .people-hide-container').show();
			isPeopleContainerClose = false;

			e.preventDefault();
			e.stopPropagation();

		});

		$('.master .search-ti').click(function(){
			$(this).closest('form').submit();
		});

		///////////////////////////////////////////////////////

		$('.master select[name="nt"]').change(function(e){

			var $this = $(this),
				min = Number($('.master select[name="nf"]').val()),
				curr = Number($this.val());
				

			if(curr < min)
			
				$this.children('.master option[value="' + min + '"]').prop('selected', true);
		
			setNightValues();
		});

		$('.master select[name="nf"]').change(function(e){

			var $this = $(this),
				nt = $('.master select[name="nt"]');
				max = Number(nt.val()),
				curr = Number($this.val());

			if(curr > max)
			
				nt.children('.master option[value="' + curr + '"]').prop('selected', true);

			setNightValues();

		});

        $(".master select[name='ct']").on("change", function(){
            var cityid = $(this).val(), html = '<option></option>';

            for (countryid in bx_search[cityid]){
                html += '<option value="' + countryid + '">' + bx_counties[countryid]["NAME"] + '</option>';
            }

            $(".master select[name='co']").html(html);
            $(".master select[name='co']").select2("val", "");

        });

		////////////////////////////////////////////////////////////////////////////


	});
})(jQuery);