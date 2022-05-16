//{"id":1480495513000,"method":"somehotels_get_rooms","params":{"search_id":"12121812777-0-0-20","hotel_ids":[7222,7223,7222],"tourtip":0}}:
/**
* Поиск объектов из сторонних источников
*/

(function ($) {


	var c = {

		filterObject: "",

		/**
		* parameters - параметры поиска
		*/
        parameters: {},

		/**
		* queryAddress - адрес запроса
		*/
        queryFilterAddress: "",

		/**
		* функция отрисовки результата фильтра
		*/
		renderResultFilter: function (data) {},

        /**
         * функция сбора массива обязатльных полей фильтра
         */
		getRequiredParamsFilter: function (data) {}
	},

	Warnings = function (warnings) {

		this.name = 'Warnings';

		if (!Array.isArray(warnings))
			warnings = [warnings];

		this.warnings = warnings;

	},

	showWarnings = function (e) {
		var k;

		if (e.name == "Warnings") {

			for (k in e.warnings) {
				console.warn(e.warnings[k]);
			}

		} else
			throw e;
	}

	// check input parameters
	checkRequiredInputParametersFilter = function () {

		var allowedFilterObjects = ['toursfilter', 'hotelsfilter', 'bustoursfilter'], warnings = [];

		if ($.inArray(optionsFilter.filterObject, allowedFilterObjects) < 0)
			warnings.push("Allowed filter object not setted");
		if (optionsFilter.queryFilterAddress == "")
			warnings.push("Search address not setted");

		if (warnings.length > 0)
			throw new Warnings(warnings);

	},

	///////////////////////////////////////////
	//	         FILTER OBJECT	  			//
	/////////////////////////////////////////
	FilterObject = {
		// properties
		filterURL: "",
		initFilterMethod : "",
		filterParameters: {},
		renderResultFilter: function (data) {},
        getRequiredParamsFilter: function (data) {},
        selectedparams: {},
		objectResults: [],

		// methods
		checkQueryParametersFilter: function (params) {
			var warnings = []; dateFormat = /^\d{2}\.\d{2}\.\d{4}$/;

            if (params.filterId == "")
                warnings.push("filterId parameter not setted");

			if ((typeof params.cityFrom !== 'undefined' && params.cityFrom <= 0) ||
					(params.cityFrom <= 0))
				warnings.push("Object cityFrom for search not setted");

			if ((typeof params.country !== 'undefined' && params.country <= 0) ||
				(params.country <= 0))
				warnings.push("Object country for search not setted");

			if (! dateFormat.test(params.CheckIn))
				warnings.push("CheckIn parameter format must be dd.mm.yyyy");

			if (! dateFormat.test(params.CheckOut))
				warnings.push("CheckOut parameter format must be dd.mm.yyyy");

			if (typeof params.NightIn === 'undefined' || typeof params.NightIn !== 'number' || params.NightIn < 1)
				params.NightIn = 7;

			if (typeof params.NightOut === 'undefined' || typeof params.NightOut !== 'number' || params.NightOut < 1)
				params.NightOut = 14;

			if (typeof params.Adults === 'undefined' || typeof params.Adults !== 'number' || params.Adults < 1)
				params.Adults = 1;

			if (typeof params.Children === 'undefined' || typeof params.Children !== 'number' || params.Children < 0)
				params.Children = 0;

			if (typeof params.page === 'undefined' || typeof params.page !== 'number' || params.page < 0)
				params.page = 1;

			if (warnings.length > 0)
				throw new Warnings(warnings);
		}

	}

	$.Filter = function (inputParamsFilter) {

		try {

			var params = {};

			optionsFilter = $.extend({}, c, inputParamsFilter);

            checkRequiredInputParametersFilter();

			switch (optionsFilter.filterObject) {

				case "toursfilter":

					/////////////////////////////////////////////////////
					//	      SEARCH TOURS OBJECT BY PLACEMENT		   //
					/////////////////////////////////////////////////////
					ToursFilter = FilterObject;
                    ToursFilter.initFilterMethod = "GetFiltrForTour";

                    ToursFilter.initObject = function (optionsFilter) {
						this.checkQueryParametersFilter(optionsFilter.parameters);
						this.filterParameters = {
							id: optionsFilter.parameters.filterId,
							method: this.initFilterMethod,
							params:
								{
                                    date: [optionsFilter.parameters.CheckIn,optionsFilter.parameters.CheckOut],
                                    cityFrom: optionsFilter.parameters.cityFrom,
                                    country: optionsFilter.parameters.country,
                                    nights: [optionsFilter.parameters.NightIn,optionsFilter.parameters.NightOut],
                                    adults: optionsFilter.parameters.Adults,
                                    childs: optionsFilter.parameters.Children,
                                    tourTypes: [0, 1, 2, 3, 4, 5, 8, 9, 10, 11, 13, 14, 15, 27, 28],
                                    tours: [],
                                    cities: [],
                                    hotels: [],
                                    stars: [],
                                    meals: []
								}
						};
						
                        if(typeof optionsFilter.parameters.age1 !== "undefined")
                            this.filterParameters.params.age1 = optionsFilter.parameters.age1;
                        if(typeof optionsFilter.parameters.age2 !== "undefined")
                            this.filterParameters.params.age2 = optionsFilter.parameters.age2;
                        if(typeof optionsFilter.parameters.age3 !== "undefined")
                            this.filterParameters.params.age3 = optionsFilter.parameters.age3;
                        if(typeof optionsFilter.parameters.tours !== "undefined")
                            this.filterParameters.params.tours = optionsFilter.parameters.tours;
                        if(typeof optionsFilter.parameters.cities !== "undefined")
                            this.filterParameters.params.cities = optionsFilter.parameters.cities;
                        if(typeof optionsFilter.parameters.hotels !== "undefined")
                            this.filterParameters.params.hotels = optionsFilter.parameters.hotels;
                        if(typeof optionsFilter.parameters.stars !== "undefined")
                            this.filterParameters.params.stars = optionsFilter.parameters.stars;
                        if(typeof optionsFilter.parameters.meals !== "undefined")
                            this.filterParameters.params.meals = optionsFilter.parameters.meals;
                        if(typeof optionsFilter.parameters.prices !== "undefined")
                            this.filterParameters.params.prices = optionsFilter.parameters.prices;

                        //console.log(JSON.stringify(ToursFilter.filterParameters));
						this.filterURL = optionsFilter.queryFilterAddress;
						this.renderResultFilter = optionsFilter.renderResultFilter;

                        this.selectedparams = {
                            cityFrom: optionsFilter.parameters.cityFrom,
                            country: optionsFilter.parameters.country
                        };
                        this.getRequiredParamsFilter = optionsFilter.getRequiredParamsFilter;
					};


                    ToursFilter.initObject(optionsFilter);

					$.ajax({

						method: "post",
						url: ToursFilter.filterURL,
						data: JSON.stringify(ToursFilter.filterParameters),
						dataType: 'json',
						success: function (data) {

							var params = null;
							if (typeof data.result === "undefined") {
								params = {};
							} else {
								 params = data.result;
								 params.cityFrom = (typeof cityList === "object" ? cityList : bx_cityFrom);

                                for (cityId in params.cityFrom){
                                    params.cityFrom[cityId].ID = Number(params.cityFrom[cityId].MASTERTOUR);
                                    if (params.cityFrom[cityId].MASTERTOUR == ToursFilter.filterParameters.params.cityFrom)
                                        var city = cityId;
                                }
                                if (typeof bx_country === "object" && typeof bx_filter[city] === "object") {
                                    var countryList = {};
                                    for (Arr_country in bx_filter[city]) {
                                        countryList[Arr_country] = bx_country[Arr_country];
                                        countryList[Arr_country].ID = Number(bx_country[Arr_country].MASTERTOUR);
                                    }

                                }

								 params.country = (typeof countryList === "object" ? countryList : bx_country);
								 params.default = ToursFilter.filterParameters.params;
								 //params.ar_required = ToursFilter.getRequiredParamsFilter(ToursFilter.selectedparams);
								 //params.date = [optionsFilter.parameters.CheckIn,optionsFilter.parameters.CheckOut],
								 //params.nights = [optionsFilter.parameters.NightIn,options.parameters.NightOut],
								 //params.adults = optionsFilter.parameters.Adults,
								 //params.childs = optionsFilter.parameters.Children
                            }

							ToursFilter.renderResultFilter(params);

						}

					});

					break;

                case "hotelsfilter":

                    /////////////////////////////////////////////////////
                    //	      SEARCH TOURS OBJECT BY PLACEMENT		   //
                    /////////////////////////////////////////////////////
                    HotelFilter = FilterObject;
                    HotelFilter.initFilterMethod = "Filter";

                    HotelFilter.initObject = function (optionsFilter) {
                        this.checkQueryParametersFilter(optionsFilter.parameters);
                        this.filterURL = optionsFilter.queryFilterAddress;
                        this.filterParameters = {
                            //id: optionsFilter.parameters.filterId,
                            method: this.initFilterMethod,
                            params:
                            {
								departFrom: optionsFilter.parameters.CheckIn,
								departTo: optionsFilter.parameters.CheckOut,
								cityFromId: optionsFilter.parameters.cityFrom,
								countryId: optionsFilter.parameters.country,
								nightsMin: optionsFilter.parameters.NightIn,
								nightsMax: optionsFilter.parameters.NightOut,
                                adults: optionsFilter.parameters.Adults,
								kids: optionsFilter.parameters.Children,
                                kidsAges: [],
								includeDescriptions: true,
								cities: [],
								hotels: [],
								stars: [],
								meals: []
                            }
                        };
                        if(typeof optionsFilter.parameters.age1 !== "undefined") {
                            this.filterParameters.params.kidsAges[0] = optionsFilter.parameters.age1;
                            this.filterParameters.params.age1 = optionsFilter.parameters.age1;
                        }
                        if(typeof optionsFilter.parameters.age2 !== "undefined") {
                            this.filterParameters.params.kidsAges[1] = optionsFilter.parameters.age2;
                            this.filterParameters.params.age2 = optionsFilter.parameters.age2;
                        }
                        if(typeof optionsFilter.parameters.age3 !== "undefined") {
                            this.filterParameters.params.kidsAges[2] = optionsFilter.parameters.age3;
                            this.filterParameters.params.age3 = optionsFilter.parameters.age3;
                        }
                        if(typeof optionsFilter.parameters.cities !== "undefined")
                            this.filterParameters.params.cities = optionsFilter.parameters.cities;
                        if(typeof optionsFilter.parameters.hotels !== "undefined")
                            this.filterParameters.params.hotels = optionsFilter.parameters.hotels;
                        if(typeof optionsFilter.parameters.stars !== "undefined")
                            this.filterParameters.params.stars = optionsFilter.parameters.stars;
                        if(typeof optionsFilter.parameters.meals !== "undefined")
                            this.filterParameters.params.meals = optionsFilter.parameters.meals;
                        /*if(typeof optionsFilter.parameters.prices !== "undefined")
                            this.filterParameters.params.prices = optionsFilter.parameters.prices;*/

                        this.renderResultFilter = optionsFilter.renderResultFilter;

                    };

					HotelFilter.initObject(optionsFilter);

					//console.log(JSON.stringify(HotelFilter.filterParameters),111);

					$.ajax({
						method: 'post',
						url: '/ajax/get_xml.php',
						data: {query_data: JSON.stringify(HotelFilter.filterParameters)},
						success: function (xmldata) {

							//console.log(xmldata, 000);
							var params = null;
							if (typeof xmldata["filter"] === "undefined") {
								params = false;
							} else {
								params = xmldata["filter"];

								params.cityFrom = (typeof cityList === "object" ? cityList : bx_cityFrom);

								for (cityId in params.cityFrom) {
									params.cityFrom[cityId].ID = Number(params.cityFrom[cityId].SLETAT);
									if (params.cityFrom[cityId].SLETAT == HotelFilter.filterParameters.params.cityFromId)
										var city = cityId;
								}
								if (typeof bx_country === "object" && typeof bx_filter[city] === "object") {
									var countryList = {};
									for (Arr_country in bx_filter[city]) {
										countryList[Arr_country] = bx_country[Arr_country];
										countryList[Arr_country].ID = Number(bx_country[Arr_country].SLETAT);
									}

								}
								params.country = (typeof countryList === "object" ? countryList : bx_country);
								params.default = HotelFilter.filterParameters.params;

							}
							HotelFilter.renderResultFilter(params);
						}
					});

                    break;

                case "bustoursfilter":

                    /////////////////////////////////////////////////////
                    //	      SEARCH TOURS OBJECT BY PLACEMENT		   //
                    /////////////////////////////////////////////////////
                    ToursFilter = FilterObject;
                    ToursFilter.initFilterMethod = "GetFiltrForTour";

                    ToursFilter.initObject = function (optionsFilter) {
                        this.checkQueryParametersFilter(optionsFilter.parameters);
                        this.filterParameters = {
                            id: optionsFilter.parameters.filterId,
                            method: this.initFilterMethod,
                            params:
                                {
                                    date: [optionsFilter.parameters.CheckIn,optionsFilter.parameters.CheckOut],
                                    cityFrom: optionsFilter.parameters.cityFrom,
                                    country: optionsFilter.parameters.country,
                                    nights: [optionsFilter.parameters.NightIn,optionsFilter.parameters.NightOut],
                                    adults: optionsFilter.parameters.Adults,
                                    childs: optionsFilter.parameters.Children,
                                    tourTypes: [12],
                                    tours: [],
                                    cities: [],
                                    hotels: [],
                                    stars: [],
                                    meals: []
                                }
                        };
                        if(typeof optionsFilter.parameters.tours !== "undefined")
                            this.filterParameters.params.tours = optionsFilter.parameters.tours;
                        if(typeof optionsFilter.parameters.cities !== "undefined")
                            this.filterParameters.params.cities = optionsFilter.parameters.cities;
                        if(typeof optionsFilter.parameters.hotels !== "undefined")
                            this.filterParameters.params.hotels = optionsFilter.parameters.hotels;
                        if(typeof optionsFilter.parameters.stars !== "undefined")
                            this.filterParameters.params.stars = optionsFilter.parameters.stars;
                        if(typeof optionsFilter.parameters.meals !== "undefined")
                            this.filterParameters.params.meals = optionsFilter.parameters.meals;
                        if(typeof optionsFilter.parameters.prices !== "undefined")
                            this.filterParameters.params.prices = optionsFilter.parameters.prices;

                        //console.log(JSON.stringify(ToursFilter.filterParameters));
                        this.filterURL = optionsFilter.queryFilterAddress;
                        this.renderResultFilter = optionsFilter.renderResultFilter;

                        this.selectedparams = {
                            cityFrom: optionsFilter.parameters.cityFrom,
                            country: optionsFilter.parameters.country
                        };
                        this.getRequiredParamsFilter = optionsFilter.getRequiredParamsFilter;
                    };


                    ToursFilter.initObject(optionsFilter);

                    $.ajax({

                        method: "post",
                        url: ToursFilter.filterURL,
                        data: JSON.stringify(ToursFilter.filterParameters),
                        dataType: 'json',
                        success: function (data) {

                            var params = null;
                            if (typeof data.result === "undefined") {
                                params = {};
                            } else {
                                params = data.result;
                                params.cityFrom = (typeof cityList === "object" ? cityList : bx_cityFrom);

                                for (cityId in params.cityFrom){
                                    params.cityFrom[cityId].ID = Number(params.cityFrom[cityId].MASTERTOUR);
                                    if (params.cityFrom[cityId].MASTERTOUR == ToursFilter.filterParameters.params.cityFrom)
                                        var city = cityId;
                                }
                                if (typeof bx_country === "object" && typeof bx_filter[city] === "object") {
                                    var countryList = {};
                                    for (var i=0;i<bx_filter[city].length;i++) {
                                        countryList[bx_filter[city][i]] = bx_country[bx_filter[city][i]];
                                        countryList[bx_filter[city][i]].ID = Number(bx_country[bx_filter[city][i]].MASTERTOUR);
                                    }

                                }

                                params.country = (typeof countryList === "object" ? countryList : bx_country);
                                params.default = ToursFilter.filterParameters.params;

                            }

                            ToursFilter.renderResultFilter(params);

                        }

                    });

                    break;

			}

		} catch (e) {

			showWarnings(e);

		}


	}


})(jQuery);
