(function ($) {

	$(document).ready(function () {

		//console.log(bx_cities);
		//console.log(bx_counties);

		var isPeopleContainerClose = true;

		$('.mastertour .people-container').click(function(e){

			$('.mastertour .people-hide-container').show();
			isPeopleContainerClose = false;

			e.preventDefault();
			e.stopPropagation();

		});


		$('body').click(function(e){

			if(!isPeopleContainerClose)
			{
				var ad = Number($('.mastertour select[name="Adults"]').val()),
					ch = Number($('.mastertour select[name="Children"]').val());
				$('.mastertour .adults').text('Взрослых: ' + (ad ? ad : 0));
				$('.mastertour .children').text('Детей: ' + (ch ? ch : 0));

				$('.mastertour .people-hide-container').hide();
				isPeopleContainerClose = true;
			}
		});

		$('.mastertour input[name="CheckIn"]').datepicker({
			showOtherMonths: !0,
			selectOtherMonths: !0,
			minDate: new Date(),
			defaultDate: '0+',
			firstDay: "1",
			autoSize: true,
			dateFormat: "dd.mm.yy",
			dayNamesMin: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
			monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
                'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'
            ],
            onSelect: function(date) {
            	
            	date = date.split('.');

            	$('.mastertour input[name="CheckOut"]').datepicker('option', 'minDate', new Date(new Date(date[2], date[1] - 1, date[0]).getTime() + 24*3600*1000));
            }
		});

		$('.mastertour input[name="CheckOut"]').datepicker({
			showOtherMonths: !0,
			selectOtherMonths: !0,
			minDate: new Date( new Date().getTime() + 24*3600*1000 ),
			defaultDate: '0+',
			firstDay: "1",
			autoSize: true,
			dateFormat: "dd.mm.yy",
			dayNamesMin: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
			monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
                'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'
            ]
		});


		$('form.mastertour').submit(function () {

			var links = $(this).data('json-links'), id = $(this).find('select[name="id"]').val();
			var select = $(this).find('select[name="id"]');
			var select_type = $(':selected',select).attr('data-type');

			if (typeof links[id] != 'undefined')
				$(this).attr('action', links[id]);

			if (select_type != null && select_type != "undefined") {

				if(select_type == "country"){

					$(this).append('<input type="hidden" name="cid" value="'+id+'">');

				}
				else if(select_type == "city"){
					$(this).append('<input type="hidden" name="cid" value="0">');
				}

			}

		});
		
	});

})(jQuery);