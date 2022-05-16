(function ($) {
	$(document).ready(function () {

		var isPeopleContainerClose = true;

		$('.people-container').click(function(e){

			$('.people-hide-container').show();
			isPeopleContainerClose = false;

			e.preventDefault();
			e.stopPropagation();

		});


		$('body').click(function(e){

			if(!isPeopleContainerClose)
			{
				var ad = Number($('select[name="Adults"]').val()),
					ch = Number($('select[name="Children"]').val());
				$('.adults').text('Взрослых: ' + (ad ? ad : 0));
				$('.children').text('Детей: ' + (ch ? ch : 0));

				$('.people-hide-container').hide();
				isPeopleContainerClose = true;
			}
		});

		$('input[name="CheckIn"').datepicker({
			showOtherMonths: !0,
			selectOtherMonths: !0,
			minDate: new Date(),
			defaultDate: $(this).val(),
			firstDay: "1",
			autoSize: true,
			dateFormat: "dd.mm.yy",
			dayNamesMin: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
			monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
                'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'
            ],
            onSelect: function(date) {
            	date = date.split('.');
            	$('input[name="CheckOut"').datepicker('option', 'minDate', new Date(new Date(date[2], date[1] - 1, date[0]).getTime() + 24*3600*1000));
            }
		});

		$('input[name="CheckOut"').datepicker({
			showOtherMonths: !0,
			selectOtherMonths: !0,
			minDate: new Date( new Date().getTime() + 24*3600*1000 ),
			defaultDate: $(this).val(),
			firstDay: "1",
			autoSize: true,
			dateFormat: "dd.mm.yy",
			dayNamesMin: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
			monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
                'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'
            ]
		});


		$('form.tourindex').submit(function () {

			var links = $(this).data('json-links'), id = $('select[name="id"]').val();
		
			if (typeof links[id] != 'undefined')
				$(this).attr('action', links[id]);  

		});
		
	});

})(jQuery);