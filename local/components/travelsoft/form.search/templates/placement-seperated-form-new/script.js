(function ($) {

    $(document).ready(function () {

        //console.log(bx_cities);
        //console.log(bx_counties);

        var isPeopleContainerClose = true;
        var dateFormat = "DD.MM.YYYY";

        $('.mastertour .people-container').click(function (e) {

            $('.mastertour .people-hide-container').show();
            isPeopleContainerClose = false;

            e.preventDefault();
            e.stopPropagation();

        });


        $('body').click(function (e) {

            if (!isPeopleContainerClose) {
                var ad = Number($('.mastertour select[name="Adults"]').val()),
                    ch = Number($('.mastertour select[name="Children"]').val());
                $('.mastertour .adults').text('Взрослых: ' + (ad ? ad : 0));
                $('.mastertour .children').text('Детей: ' + (ch ? ch : 0));

                $('.mastertour .people-hide-container').hide();
                isPeopleContainerClose = true;
            }
        });

        moment.locale("ru");
        initDatePicker($('.calendar-input'));

        function initDatePicker ($this) {
         var parent = $this.parent(".field-date"),
         date_from = parent.find(".minDate"), date_to = parent.find(".maxDate"), options = {};

         /*options.minDate = '27.11.2017';*/

         if (date_from.length) {
         options.startDate = (function (date_from) {

         var val = date_from.val(), defVal;
         if (!val) {
         defVal = date_from.data("start-date");
         date_from.val(defVal);
         return defVal;
         }

         return val;

         })(date_from);
         }

         if (date_to.length) {
         options.endDate = (function (date_to) {

         var val = date_to.val(), defVal;
         if (!val) {
         defVal = date_to.data("end-date");
         date_to.val(defVal);
         return defVal;
         }

         return val;

         })(date_to);
         }

         options.singleDatePicker = $this.data("single-date-picker") == "Y";
         options.autoApply = true;
         options.locale = {
         format: dateFormat,
         separator: ' - ',
         daysOfWeek: moment.weekdaysMin(),
         monthNames: moment.monthsShort(),
         firstDay: moment.localeData().firstDayOfWeek(),
         };

         var datepicker = $this.daterangepicker(options);

         datepicker.on("apply.daterangepicker", function (ev, picker) {

         var calendars = picker.container.find('.calendars');

         var arVals = $(this).val().split(" - ") || [], parent;

         if (arVals.length) {

         date_from.val(arVals[0]);
         if (date_to.length) {
         date_to.val(arVals[1]);
         }

         }

         }).on("show.daterangepicker", function (ev, picker_) {

         calendars = picker_.container.find('.calendars');
         picker = picker_;

         });

         return datepicker;

         }

        /*отличный календарь*/


        /*$('.mastertour input[name="CheckIn"]').datepicker({
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
            onSelect: function (date) {

                date = date.split('.');

                $('.mastertour input[name="CheckOut"]').datepicker('option', 'minDate', new Date(new Date(date[2], date[1] - 1, date[0]).getTime() + 24 * 3600 * 1000));
            }
        });

        $('.mastertour input[name="CheckOut"]').datepicker({
            showOtherMonths: !0,
            selectOtherMonths: !0,
            minDate: new Date(new Date().getTime() + 24 * 3600 * 1000),
            defaultDate: '0+',
            firstDay: "1",
            autoSize: true,
            dateFormat: "dd.mm.yy",
            dayNamesMin: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
            monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
                'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'
            ]
        });*/


        $('form.mastertour').submit(function () {
            var links = $(this).data('json-links'), id_object = $(this).find('select[name="id-object"]').val(), id = $(this).find('select[name="id"]').val();
            var select = $(this).find('select[name="id"]');
            var select_type = $(':selected', select).attr('data-type');

            if (typeof links[id_object] !== 'undefined') {
                select.val(id_object);
                $(this).attr('action', links[id_object]);
            }

            if (select_type != null && select_type != "undefined") {

                if (select_type == "country") {

                    $(this).append('<input type="hidden" name="cid" value="' + id + '">');

                }
                else if (select_type == "city") {
                    $(this).append('<input type="hidden" name="cid" value="0">');
                }

            }

        });

    });

})(jQuery);