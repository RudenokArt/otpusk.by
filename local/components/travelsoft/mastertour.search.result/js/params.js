	
window.selectParams = {

    linkId: 163,

    /**
     * get params cityFrom and country
     */
    getParam: function (city, country) {

        selectParams.linkId = 163;

        var defparam = {city: '', country: ''};
        if (typeof bx_filter[city] === "object" && bx_filter[city][country] !== "") {
            if (Number(selectParams.linkId) !== Number(bx_filter[city][country])) {
                selectParams.linkId = 164;
            }

            if (selectParams.linkId == 163) {
                defparam.city = Number(bx_cityFrom[city]["MASTERTOUR"]);
                defparam.country = Number(bx_country[country]["MASTERTOUR"]);
            } else if (selectParams.linkId == 164) {
                defparam.city = Number(bx_cityFrom[city]["SLETAT"]);
                defparam.country = Number(bx_country[country]["SLETAT"]);
            }
        }
        return defparam;
        
    },

    /**
     * select all params
     */
    selectAllParams: function () {

        var param = JSON.parse($(".search_area").attr("data-def-params"));

        var $var;

        var form = $("#filterForm"), param_filter = null;

        if (form.length) {

            // запись в param_filter
            $var = form.find("select[name='cityFrom']").val() || null;
            if ($var)
                param.cityFrom = Number($var);

            $var = form.find("select[name='country']").val() || null;
            if ($var)
                param.country = Number($var);

            $var = form.find("select[name='cities[]']").val() || null;
            if ($var)
                param.cities = selectParams.paramNumber($var);

            $var = form.find("select[name='tourTypes[]']").val() || null;
            if ($var)
                param.tourTypes = selectParams.paramNumber($var);

            $var = form.find("select[name='tours[]']").val() || null;
            if ($var)
                param.tours = selectParams.paramNumber($var);

            $var = form.find("select[name='hotels[]']").val() || null;
            if ($var)
                param.hotels = selectParams.paramNumber($var);

            $var = form.find("input[name='stars[]']:checked").map(function() {return this.value;}).get() || null;
            if ($var && $var.length > 0)
                param.stars = $var;

            $var = form.find("input[name='meals[]']:checked").map(function() {return this.value;}).get() || null;
            if ($var && $var.length > 0)
                param.meals = selectParams.paramNumber($var);

            $var = form.find("input[name='CheckIn']").val() || null;
            if ($var)
                param.CheckIn = $var;

            $var = form.find("input[name='CheckOut']").val() || null;
            if ($var)
                param.CheckOut = $var;

            $var = form.find("input[name='NightIn']").val() || null;
            if ($var)
                param.NightIn = Number($var);

            $var = form.find("input[name='NightOut']").val() || null;
            if ($var)
                param.NightOut = Number($var);

            $var = form.find("select[name='Adults']").val() || null;
            if ($var)
                param.Adults = Number($var);

            $var = form.find("select[name='Children']").val() || null;
            if ($var)
                param.Children = Number($var);

            if (param.Children > 0) {

                $var = form.find("select[name='age1']").val() || null;
                if ($var)
                    param.age1 = Number($var);

                if(param.Children == 2) {
                    $var = form.find("select[name='age2']").val() || null;
                    if ($var)
                        param.age2 = Number($var);
                }

                if(param.Children == 2) {
                    $var = form.find("select[name='age2']").val() || null;
                    if ($var)
                        param.age2 = Number($var);
                }

                if(param.Children == 3) {
                    $var = form.find("select[name='age3']").val() || null;
                    if ($var)
                        param.age3 = Number($var);
                }

            }


        }

        if (typeof param.Children === 'undefined' || typeof param.Children !== 'number' || param.Children < 0)
            param.Children = 0;

        if (param.Children == 0)
        {
            delete param.age1;
            delete param.age2;
            delete param.age3;
        } else if (param.Children == 1) {
            delete param.age2;
            delete param.age3;
        } else if (param.Children == 2) {
            delete param.age3;
        }

        var values = selectParams.getParam(param.cityFrom, param.country);
        param.cityFrom = values.city;
        param.country = values.country;
        param.linkId = selectParams.linkId;

        return param;

    },

    selectAllBusParams: function () {

        var param = JSON.parse($(".search_area").attr("data-def-params"));

        var $var;

        var form = $("#filterForm"), param_filter = null;

        if (form.length) {

            // запись в param_filter
            $var = form.find("select[name='cityFrom']").val() || null;
            if ($var)
                param.cityFrom = Number($var);

            $var = form.find("select[name='country']").val() || null;
            if ($var)
                param.country = Number($var);

            $var = form.find("select[name='cities[]']").val() || null;
            if ($var)
                param.cities = selectParams.paramNumber($var);

            $var = form.find("select[name='tourTypes[]']").val() || null;
            if ($var)
                param.tourTypes = selectParams.paramNumber($var);

            $var = form.find("select[name='tours[]']").val() || null;
            if ($var)
                param.tours = selectParams.paramNumber($var);

            $var = form.find("select[name='hotels[]']").val() || null;
            if ($var)
                param.hotels = selectParams.paramNumber($var);

            $var = form.find("input[name='stars[]']:checked").map(function() {return this.value;}).get() || null;
            if ($var && $var.length > 0)
                param.stars = $var;

            $var = form.find("input[name='meals[]']:checked").map(function() {return this.value;}).get() || null;
            if ($var && $var.length > 0)
                param.meals = selectParams.paramNumber($var);

            $var = form.find("input[name='CheckIn']").val() || null;
            if ($var)
                param.CheckIn = $var;

            $var = form.find("input[name='CheckOut']").val() || null;
            if ($var)
                param.CheckOut = $var;

            $var = form.find("input[name='NightIn']").val() || null;
            if ($var)
                param.NightIn = Number($var);

            $var = form.find("input[name='NightOut']").val() || null;
            if ($var)
                param.NightOut = Number($var);

            $var = form.find("select[name='Adults']").val() || null;
            if ($var)
                param.Adults = Number($var);

            $var = form.find("select[name='Children']").val() || null;
            if ($var)
                param.Children = Number($var);

        }

        param.cityFrom = Number(bx_cityFrom[param.cityFrom]["MASTERTOUR"]);
        param.country = Number(bx_country[param.country]["MASTERTOUR"]);

        return param;

    },

    /**
     * select params for search MatserTour
     */
    selectSearch: function (item) {

        var paramsSearch = {};
        if(typeof item !== 'undefined'){
            if(typeof item.searchId !== "undefined")
                paramsSearch.searchId = item.searchId;
            if(typeof item.cityFrom !== "undefined")
                paramsSearch.cityFrom = item.cityFrom;
            if(typeof item.country !== "undefined")
                paramsSearch.country = item.country;
            if(typeof item.NightIn !== "undefined")
                paramsSearch.NightIn = item.NightIn;
            if(typeof item.NightOut !== "undefined")
                paramsSearch.NightOut = item.NightOut;
            if(typeof item.Adults !== "undefined")
                paramsSearch.Adults = item.Adults;
            if(typeof item.Children !== "undefined")
                paramsSearch.Children = item.Children;
            if(paramsSearch.Children > 0) {
                if (typeof item.age1 !== "undefined")
                    paramsSearch.age1 = item.age1;
                if (typeof item.age2 !== "undefined")
                    paramsSearch.age2 = item.age2;
                if (typeof item.age3 !== "undefined")
                    paramsSearch.age3 = item.age3;
            }
            if(typeof item.CheckIn !== "undefined")
                paramsSearch.CheckIn = item.CheckIn;
            if(typeof item.CheckOut !== "undefined")
                paramsSearch.CheckOut = item.CheckOut;
            if(typeof item.tours !== "undefined")
                paramsSearch.tours = item.tours;
            if(typeof item.cities !== "undefined")
                paramsSearch.cities = item.cities;
            if(typeof item.hotels !== "undefined")
                paramsSearch.hotels = item.hotels;
            if(typeof item.stars !== "undefined")
                paramsSearch.stars = item.stars;
            if(typeof item.meals !== "undefined")
                paramsSearch.meals = item.meals;
            if(typeof item.prices !== "undefined")
                paramsSearch.prices = item.prices;
        }
        paramsSearch.page = Number(Utilites.currentPage);
        return paramsSearch;

    },

    /**
     * select params for filter MasterTour
     */
    selectFilter: function (item) {
        var paramsFilter = {};
        if(typeof item !== 'undefined'){
            if(typeof item.searchId !== "undefined")
                paramsFilter.filterId = item.searchId;
            if(typeof item.cityFrom !== "undefined")
                paramsFilter.cityFrom = item.cityFrom;
            if(typeof item.country !== "undefined")
                paramsFilter.country = item.country;
            if(typeof item.tourTypes !== "undefined")
                paramsFilter.tourTypes = item.tourTypes;
            if(typeof item.NightIn !== "undefined")
                paramsFilter.NightIn = item.NightIn;
            if(typeof item.NightOut !== "undefined")
                paramsFilter.NightOut = item.NightOut;
            if(typeof item.Adults !== "undefined")
                paramsFilter.Adults = item.Adults;
            if(typeof item.Children !== "undefined")
                paramsFilter.Children = item.Children;
            if(paramsFilter.Children > 0){
                if(typeof item.age1 !== "undefined")
                    paramsFilter.age1 = item.age1;
                if(typeof item.age2 !== "undefined")
                    paramsFilter.age2 = item.age2;
                if(typeof item.age3 !== "undefined")
                    paramsFilter.age3 = item.age3;
            }
            if(typeof item.CheckIn !== "undefined")
                paramsFilter.CheckIn = item.CheckIn;
            if(typeof item.CheckOut !== "undefined")
                paramsFilter.CheckOut = item.CheckOut;
            if(typeof item.tours !== "undefined")
                paramsFilter.tours = item.tours;
            if(typeof item.cities !== "undefined")
                paramsFilter.cities = item.cities;
            if(typeof item.hotels !== "undefined")
                paramsFilter.hotels = item.hotels;
            if(typeof item.stars !== "undefined")
                paramsFilter.stars = item.stars;
            if(typeof item.meals !== "undefined")
                paramsFilter.meals = item.meals;
            if(typeof item.prices !== "undefined")
                paramsFilter.prices = item.prices;
        }
        paramsFilter.page = Number(Utilites.currentPage);
        return paramsFilter;
    },

    /**
     * select params for search Sletat
     */
    selectSearchSletat: function (item) {

        var paramsSearchSletat = {};
        if(typeof item !== 'undefined'){
            if(typeof item.cityFrom !== "undefined")
                paramsSearchSletat.cityFrom = item.cityFrom;
            if(typeof item.country !== "undefined")
                paramsSearchSletat.country = item.country;
            if(typeof item.NightIn !== "undefined")
                paramsSearchSletat.NightIn = item.NightIn;
            if(typeof item.NightOut !== "undefined")
                paramsSearchSletat.NightOut = item.NightOut;
            if(typeof item.Adults !== "undefined")
                paramsSearchSletat.Adults = item.Adults;
            if(typeof item.Children !== "undefined")
                paramsSearchSletat.Children = item.Children;
            if(paramsSearchSletat.Children > 0) {
                if (typeof item.age1 !== "undefined")
                    paramsSearchSletat.age1 = item.age1;
                if (typeof item.age2 !== "undefined")
                    paramsSearchSletat.age2 = item.age2;
                if (typeof item.age3 !== "undefined")
                    paramsSearchSletat.age3 = item.age3;
            }
            if(typeof item.CheckIn !== "undefined")
                paramsSearchSletat.CheckIn = item.CheckIn;
            if(typeof item.CheckOut !== "undefined")
                paramsSearchSletat.CheckOut = item.CheckOut;
            if(typeof item.cities !== "undefined")
                paramsSearchSletat.cities = item.cities;
            if(typeof item.hotels !== "undefined")
                paramsSearchSletat.hotels = item.hotels;
            if(typeof item.stars !== "undefined")
                paramsSearchSletat.stars = selectParams.paramNumber(item.stars);
            if(typeof item.meals !== "undefined")
                paramsSearchSletat.meals = item.meals;
            if(typeof item.prices !== "undefined")
                paramsSearchSletat.prices = item.prices;
        }

        return paramsSearchSletat;

    },

    /**
     * select params for filter Sletat
     */
    selectFilterSletat: function (item) {

        var paramsFilterSletat = {};
        if(typeof item !== 'undefined'){
            if(typeof item.cityFrom !== "undefined")
                paramsFilterSletat.cityFrom = item.cityFrom;
            if(typeof item.country !== "undefined")
                paramsFilterSletat.country = item.country;
            if(typeof item.NightIn !== "undefined")
                paramsFilterSletat.NightIn = item.NightIn;
            if(typeof item.NightOut !== "undefined")
                paramsFilterSletat.NightOut = item.NightOut;
            if(typeof item.Adults !== "undefined")
                paramsFilterSletat.Adults = item.Adults;
            if(typeof item.Children !== "undefined")
                paramsFilterSletat.Children = item.Children;
            if(paramsFilterSletat.Children > 0){
                if(typeof item.age1 !== "undefined")
                    paramsFilterSletat.age1 = item.age1;
                if(typeof item.age2 !== "undefined")
                    paramsFilterSletat.age2 = item.age2;
                if(typeof item.age3 !== "undefined")
                    paramsFilterSletat.age3 = item.age3;
            }
            if(typeof item.CheckIn !== "undefined")
                paramsFilterSletat.CheckIn = item.CheckIn;
            if(typeof item.CheckOut !== "undefined")
                paramsFilterSletat.CheckOut = item.CheckOut;
            if(typeof item.cities !== "undefined")
                paramsFilterSletat.cities = item.cities;
            if(typeof item.hotels !== "undefined")
                paramsFilterSletat.hotels = item.hotels;
            if(typeof item.stars !== "undefined")
                paramsFilterSletat.stars = selectParams.paramNumber(item.stars);
            if(typeof item.meals !== "undefined")
                paramsFilterSletat.meals = item.meals;
            if(typeof item.prices !== "undefined")
                paramsFilterSletat.prices = item.prices;
        }
        return paramsFilterSletat;
    },

    /**
     * update params for filter
     */
    paramNumber: function (item) {

        var number_param = [];

        if ($.isArray(item)) {

            for (var i=0; i < item.length; i++){
                number_param[i] = Number(item[i]);
            }

        }
        return number_param;
    }

}
	
