(function ($) {

    $(document).ready(function () {

        $(".busmaster .select2-multi").select2({placeholder: $(this).data('placeholder')});

        var setDate = function () {
            var dateFrom = $('select[name="arrFilter_97_MIN"]').val();
            var result = dateFrom.match(/\d+.(\d+).(\d+)/);
            var dateTo = new Date(result[2], result[1], 0).getDate();
            dateTo += '.' + result[1] + '.' + result[2];
            $('input[name="arrFilter_97_MAX"]').val(dateTo);
        };

        $('select[name="arrFilter_97_MIN"]').change(setDate);

        setDate();

        $('select[name=townForm]').change(function () {
            $('input#city').attr('name', $(this).val());
        });

        $('select[name=countryTo]').change(function () {
            $('input#country').attr('name', $(this).val());
        });

        $('form.busmaster').submit(function () {

            $('select[name=townForm]').attr('disabled', 'disabled');
            $('select[name=countryTo]').attr('disabled', 'disabled');

            $(this).closest('form').submit();
        });

    });
})(jQuery);