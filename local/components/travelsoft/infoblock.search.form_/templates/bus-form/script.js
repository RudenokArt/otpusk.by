(function ($) {

    $(document).ready(function () {

        var city_id = null;

        var townFromInput = $(".busmaster .select2-multi[name='townForm']");
        townFromInput.select2({
            placeholder: townFromInput.data('placeholder'),
            "language": {
                "noResults": function () {
                    return townFromInput.data('noResult');
                }
            },
            escapeMarkup: function (markup) {
                return markup;
            }
        });

        var countryToInput = $(".busmaster .select2-multi[name='countryTo']");
        countryToInput.select2({
            placeholder: countryToInput.data('placeholder'),
            "language": {
                "noResults": function () {
                    return countryToInput.data('noResult');
                }
            },
            escapeMarkup: function (markup) {
                return markup;
            }
        });

        var monthInput = $(".busmaster .select2-multi[name='arrFilter_97_MIN']");
        monthInput.select2({
            placeholder: monthInput.data('placeholder'),
            "language": {
                "noResults": function () {
                    return monthInput.data('noResult');
                }
            },
            escapeMarkup: function (markup) {
                return markup;
            }
        });

        var setDate = function () {
            var dateFrom = $('select[name="arrFilter_97_MIN"]').val();
            var result = dateFrom.match(/\d+.(\d+).(\d+)/);
            console.log(result);
            var dateTo = new Date(result[2], result[1], 0).getDate();
            console.log(dateTo);
            dateTo += '.' + result[1] + '.' + result[2];
            console.log(dateTo);
            $('input[name="arrFilter_97_MAX"]').val(dateTo);
        };

        $('select[name="arrFilter_97_MIN"]').change(setDate);

        //setDate();

        $('select[name="townForm"]').on('change', function () {
            $('input#city').attr('name', $(this).val());

            city_id = $(this).find(':selected').attr('data-id');

            var city = bx_dates_bus[city_id];

            var option_countries = '<option #selected# data-id="#country_id#" value="#country_code#">#country_name#</option>';

            var htmlCountries = '<option></option>';

            if (typeof city !== "undefined" && city != '') {

                for (city_ in city) {

                    option_countries_ = option_countries;
                    option_countries_ = option_countries_.replace("#country_id#", city_);
                    option_countries_ = option_countries_.replace("#country_code#", bx_countries_bus[city_]["CODE"]);
                    option_countries_ = option_countries_.replace("#country_name#", bx_countries_bus[city_]["NAME"]);
                    option_countries_ = option_countries_.replace("#selected#", '');
                    htmlCountries += option_countries_;


                }

            }

            $(".busmaster select[name='countryTo']").select2('destroy');
            $(".busmaster select[name='countryTo']").html(htmlCountries);
            $(".busmaster select[name='countryTo']").select2({
                placeholder: $(".busmaster select[name='countryTo']").data('placeholder')
            });
        });

        $('select[name=countryTo]').on('change', function () {
            $('input#country').attr('name', $(this).val());

            var country_id = $(this).find(':selected').attr('data-id');

            var dates_filter = bx_dates_bus[city_id][country_id]["dates"];

            var option_dates = '<option #selected# value="#date#">#date_name#</option>';

            var htmlDates = '<option></option>';

            if (typeof dates_filter !== "undefined" && dates_filter != '') {

                for (dates_filter_ in dates_filter) {

                    option_dates_ = option_dates;
                    option_dates_ = option_dates_.replace("#date#", dates_filter_);
                    option_dates_ = option_dates_.replace("#date_name#", dates_filter[dates_filter_]["name"]);
                    option_dates_ = option_dates_.replace("#selected#", dates_filter[dates_filter_]["selected"] ? 'selected' : '');
                    htmlDates += option_dates_;


                }

            }

            $(".busmaster select[name='arrFilter_97_MIN']").select2('destroy');
            $(".busmaster select[name='arrFilter_97_MIN']").html(htmlDates);
            $(".busmaster select[name='arrFilter_97_MIN']").select2({placeholder: $(".busmaster select[name='arrFilter_97_MIN']").data('placeholder')});

        });

        $('.busmaster .days-checker').click(function(){
            $('.busmaster input[name="arrFilter_465_2184750849"]').trigger('click');
        });

        $('form.busmaster').submit(function () {

            $('select[name=townForm]').attr('disabled', 'disabled');
            $('select[name=countryTo]').attr('disabled', 'disabled');

            $(this).closest('form').submit();
        });

    });
})(jQuery);