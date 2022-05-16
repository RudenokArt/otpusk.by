(function($){
	
	$(document).ready(function(){

        var arDates = [];

		var isPeopleContainerClose = true;

		$(".busmaster .select2-multi").select2({placeholder: $(this).data('placeholder')});

		////////////////////////////////////////////////////////////////////////////////// 
		//						               CALENDAR									//
		//////////////////////////////////////////////////////////////////////////////////
		
		function tripleToggle()
		{
			$('.busmaster .delta-days').toggle();
			$('.busmaster .nights').toggle();
			$('.busmaster .white').toggle();
		}

		function getDatesMT() {

            var datesMT=[];
            if($(".busmaster select[name='ct']").val() != "" && $(".busmaster select[name='ct']").val() != null && typeof bx_bussearch[$(".busmaster select[name='ct']").val()] !== "undefined"){
                city = $(".busmaster select[name='ct']").val();
                if($(".busmaster select[name='co']").val() != "" && $(".busmaster select[name='co']").val() != null && $.inArray($(".busmaster select[name='co']").val(),bx_bussearch[city])){
                    country = $(".busmaster select[name='co']").val();
                    if(typeof bx_busdates[bx_buscities[city]["MASTERTOUR"]] !== "undefined" && typeof bx_busdates[bx_buscities[city]["MASTERTOUR"]][bx_buscounties[country]["MASTERTOUR"]] !== "undefined"){
                        id_master_city = bx_buscities[city]["MASTERTOUR"];
                        id_master_country = bx_buscounties[country]["MASTERTOUR"];
                        datesMT = bx_busdates[id_master_city][id_master_country][12];
                    }
                }
            }

            return datesMT;

        }

		function initDatePicker(o)
		{
			var startDate = $('.busmaster .days-text').data('def-date');

            arDates = getDatesMT();

			if(arDates.length > 0)
				startDate = arDates[0];

			o.datepicker({
				showOtherMonths: !0,
				selectOtherMonths: !0,
				minDate: new Date(),
				defaultDate: startDate,
				//defaultDate: $('.busmaster .days-text').data('def-date'),
				firstDay: "1",
				autoSize: true,
				dateFormat: "dd.mm.yy",
				dayNamesMin: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
				monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
	                'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'
	            ],
	            onSelect: function(date) {
	            	setDaysValue(dateContainerBus.datepicker('getDate').getTime());
	            },
                beforeShowDay: function (date) {
                    if(!$('.busmaster input[name="days"]').is(':checked'))
                        return [true, 'bus-day'];

                    if(arDates.length > 0) {
                        var formattedDate = date.toLocaleDateString('pl', {
                            day: '2-digit',
                            year: 'numeric',
                            month: '2-digit'
                        });
                        if ($.inArray(formattedDate, arDates) >= 0) {
                            //return {enabled: true, classes: 'active-date', tooltip: ''}
                            return [true, 'active-date bus-day'];
                        }

                    }


                    var dates = getUnixDateInterval( dateContainerBus.datepicker('getDate').getTime() );
                    date = date.getTime();
                    return [true, (dates[0] <= date && date <= dates[1]) ? 'date-select-color bus-day' : 'bus-day'];


                },

	            /*beforeShowDay: function(date){

	            	if(!$('.busmaster input[name="days"]').is(':checked'))
	            		return [true, ''];


	            	var dates = getUnixDateInterval( dateContainerBus.datepicker('getDate').getTime() );
	            		date = date.getTime();
	            	return [true, (dates[0] <= date && date <= dates[1]) ? 'date-select-color' : ''];

	            },*/

			});

			tripleToggle();

			return true;
			
		}

        function addZeros(n, needLength) {
            needLength = needLength || 2;
            n = String(n);
            while (n.length < needLength) {
                n = "0" + n;
            }
            return n
        }

		function datePickerToggle()
		{
			$('.busmaster .ui-widget').toggle();
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
			
			if(!$('.busmaster input[name="days"]').is(":checked"))
			{
				$('.busmaster input[name="df"]').val(date);
				$('.busmaster input[name="dt"]').val(date);
			}
			else
			{
				var maxMin = getUnixDateInterval(dateUnix),
						df = convertDate(new Date(maxMin[0])),
						dt = convertDate(new Date(maxMin[1]));
				
				$('.busmaster input[name="df"]').val(df);
				$('.busmaster input[name="dt"]').val(dt);

				$('.busmaster .days-text').text(df + ' - ' + dt);
			}


			$('.busmaster .days-text').text(date);
		}

		function setNightValues()
		{
			$('.busmaster .night-text').text('Ночей: ' + $('.busmaster select[name="nf"]').val() + ' - ' + $('.busmaster select[name="nt"]').val())
		}

		var isInit = false, isDatePickerClose = true; isPeopleContainerClose = true ;dateContainerBus = $('.busmaster-date-container');
		

		// events

		///////////////////////////////////////////////// all clicks
        dateContainerBus.click(function(e){

        	if(!isInit)
			{
				isInit = initDatePicker($(this));
				isDatePickerClose = false;
			}
			else 
				if(isDatePickerClose)
				{
                    $('.active-date').removeClass('active-date');
					arDates = getDatesMT();
                    if(arDates.length > 0) {
                        $(this).datepicker("setDate", arDates[0]);
                    }

					datePickerToggle();
					isDatePickerClose = false;
				}

			e.preventDefault();
			e.stopPropagation();
		});

		$('.busmaster .closeDatePicker').click(function(e){

			datePickerToggle();
			isDatePickerClose = true;
			e.preventDefault();
			e.stopPropagation();
		});

		$('body').click(function(e){

			if(!isPeopleContainerClose)
			{
				var ad = Number($('.busmaster select[name="ad"]').val()),
					ch = Number($('.busmaster select[name="ch"]').val());
				$('.busmaster .adults').text('Взрослых: ' + (ad ? ad : 0));
				$('.busmaster .children').text('Детей: ' + (ch ? ch : 0));

				$('.busmaster .people-hide-container').hide();
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

		$('.busmaster .days-checker').click(function(){
			$('.busmaster input[name="days"]').trigger('click');
		});

		$('.busmaster input[name="days"]').click(function(e){

            dateContainerBus.datepicker('refresh');
			setDaysValue(dateContainerBus.datepicker('getDate').getTime());

			//e.stopPropagation();

		});

		$('.busmaster .people-container').click(function(e){

			$('.busmaster .people-hide-container').show();
			isPeopleContainerClose = false;

			e.preventDefault();
			e.stopPropagation();

		});

		$('.busmaster .search-ti').click(function(){
			$(this).closest('form').submit();
		})

		///////////////////////////////////////////////////////

		$('.busmaster select[name="nt"]').change(function(e){

			var $this = $(this),
				min = Number($('.busmaster select[name="nf"]').val()),
				curr = Number($this.val());
				

			if(curr < min)
			
				$this.children('.master option[value="' + min + '"]').prop('selected', true);
		
			setNightValues();
		});

		$('.busmaster select[name="nf"]').change(function(e){

			var $this = $(this),
				nt = $('.busmaster select[name="nt"]');
				max = Number(nt.val()),
				curr = Number($this.val());

			if(curr > max)
			
				nt.children('.busmaster option[value="' + curr + '"]').prop('selected', true);

			setNightValues();

		});


		////////////////////////////////////////////////////////////////////////////

        $(".busmaster select[name='ct']").on("change", function(){
            var buscityid = $(this).val(), html = '<option></option>';

            for (var i=0;i<bx_bussearch[buscityid].length;i++){
                html += '<option value="' + bx_bussearch[buscityid][i] + '">' + bx_buscounties[bx_bussearch[buscityid][i]]["NAME"] + '</option>';
            }

            $(".busmaster select[name='co']").html(html);
            $(".busmaster select[name='co']").select2("val", "");

            //dateContainerBus.datepicker('destroy');


        });

        // $(".busmaster select[name='co']").on("change", function(){
         //    dateContainerBus.datepicker('destroy');
        //
		// });

	});
})(jQuery);