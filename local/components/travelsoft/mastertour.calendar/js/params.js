	
window.selectParams = {

    /**
     * select all params
     */
    selectAllParams: function () {

        var param = JSON.parse($(".availabily-wrapper").attr("data-def-params"));

        return param;

    },

    /**
     * select params for search
     */
    selectSearch: function (item) {

        var paramsSearch = {};
        if(typeof item !== 'undefined'){
            if(typeof item.searchId !== "undefined")
                paramsSearch.searchId = item.searchId;
            if(typeof item.tourTypes !== "undefined")
                paramsSearch.tourTypes = selectParams.paramNumber(item.tourTypes);
            if(typeof item.citiesFrom !== "undefined")
                paramsSearch.citiesFrom = item.citiesFrom;
        }
        return paramsSearch;

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
	
