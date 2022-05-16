//{"id":1480495513000,"method":"somehotels_get_rooms","params":{"search_id":"12121812777-0-0-20","hotel_ids":[7222,7223,7222],"tourtip":0}}:
/**
* Поиск объектов из сторонних источников
*/

(function ($) {


	var defaults = {

		
		/**
		* searchObject: placements - поиск размещений по городу, стране и т.д
		*				rooms - поиск размещений по конкретному объекту (отелю, санаторию и т.д.)
		*/
		searchObject: "",

		/**
		* parameters - параметры поиска 
		*/
		parameters: {},

		/**
		* queryAddress - адрес запроса
		*/
		queryAddress: "",

		/**
		* функция, запускаемая перед выполнением инициализации поиска
		*/
		beforeStartSearch: function (data) {},

		/**
		* функция, запускаемая после выполнения поиска
		* object data - все найденные объекты поиска
		*/
		afterFinishSearch: function (data) {}, 

		/**
		* функция отрисовки результата поиска
		*/
		renderResult: function (data) {},

        /**
         * функция отрисовки пагинации поиска
         */
        ajaxPagenavigation: function (data) {}

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
	},

	ajax__ = function (data_params) {

		$.ajax({

			method: "post",
			url: '/ajax/get_xml.php',
			data: {query_data: JSON.stringify(data_params)},
			//dataType: 'json',
			//beforeSend: options.beforeStartSearch,
			error: function () {
                Hotels.afterFinishSearch();
			},
			success: function (xmldata) {

				/*if (!$.isArray(xmldata.search.result.Rows) || xmldata.search.result.Rows.length <= 0) {
				//if (! $.isArray(xmldata.search.result.Rows)) {
					 Hotels.renderResult(false);
                     Hotels.afterFinishSearch(xmldata.search.result.Rows.length);
					 return;
				 }*/

				//console.log(data_params, 1);

                    if (Object.keys(xmldata.search.result).length > 0 > 0 && xmldata.search.result.Rows.length > 0) {
                        Hotels.renderResult(xmldata.search.result);
                    }else if(xmldata.search.result.length == 0 || xmldata.search.result.Rows.length == 0 && xmldata["search"]["state"] === true) {
                        Hotels.renderResult(false);
                    }

					/*if (Hotels.notShowPreloader)
					 {
					 Hotels.afterFinishSearch(xmldata.search.result.Rows.length);
					 Hotels.notShowPreloader = false;
					 //return;
					 }*/

                    if (data_params.params["requestId"] === xmldata["search"]["requestId"] || data_params.params["requestId"] == 0)
                        ajax_state = true;
                    else
                        ajax_state = false;


                    if (ajax_state !== false) {
                        if (typeof xmldata["search"] !== "undefined" && xmldata["search"]["requestId"] !== 0 && xmldata["search"]["state"] === false) {

                            data_params.params.requestId = xmldata["search"]["requestId"];
                            data_params.params.state = xmldata["search"]["state"];
                            data_params.params.listHotels = (typeof xmldata["search"]["result"]["bx_hotels"] !== "undefined") ? xmldata["search"]["result"]["bx_hotels"] : [];

                            //data_params.requestId = xmldata["search"]["requestId"];
                            //data_params.state = xmldata["search"]["state"];
                            //data_params.listHotels = (typeof xmldata["search"]["result"]["bx_hotels"] !== "undefined") ? xmldata["search"]["result"]["bx_hotels"] : [];

                            if($("a.submit-filter").hasClass("disabled") === false)
								$("a.submit-filter").addClass("disabled");

                            setTimeout(ajax__(data_params), 1500);
							//ajax__(data_params);
                        }
                        else {
                            ajax_state = false;
                            if(xmldata["search"]["state"] === true)
                            	$("a.submit-filter").removeClass("disabled");
                        }
                    }



			}

		});

	},

	// check input parameters
	checkRequiredInputParameters = function () {

		var allowedSearchObjects = ['placements', 'rooms', 'tours', 'hotels', 'bustours'], warnings = [];

		if ($.inArray(options.searchObject, allowedSearchObjects) < 0)
			warnings.push("Allowed search object not setted");
		if (options.queryAddress == "")
			warnings.push("Search address not setted");

		if (warnings.length > 0)
			throw new Warnings(warnings);

	},

	/////////////////////////////////////////////////////
	//	         TOTAL SEARCH OBJECT	  			   //
	/////////////////////////////////////////////////////
	SearchObject = {
		// properties
		count: 0,
		searchURL: "",
		initSearchMethod : "",
		searchParameters: {},
		renderResult: function (data) {},
        ajaxPagenavigation: function (data, render) {},
		returnedSearchId: "",
		objectResults: [],

		// methods
		checkQueryParameters: function (params) {

			var warnings = []; dateFormat = /^\d{2}\.\d{2}\.\d{4}$/;

			if (params.searchId == "")
				warnings.push("searchId parameter not setted");

			if ((typeof params.cityFrom !== 'undefined' && params.cityFrom <= 0) ||
					(params.cityFrom <= 0))
				warnings.push("Object idFrom for search not setted");

			if ((typeof params.country.length !== 'undefined' && params.country.length <= 0) ||
				(params.country <= 0))
				warnings.push("Object idTo for search not setted");

			if (! dateFormat.test(params.CheckIn))
				warnings.push("CheckIn parameter format must be dd.mm.yyyy");

			if (! dateFormat.test(params.CheckOut))
				warnings.push("CheckOut parameter format must be dd.mm.yyyy");

			if (typeof params.NightIn === 'undefined' || typeof params.NightIn !== 'number')
				params.NightIn = 7;

			if (typeof params.NightOut === 'undefined' || typeof params.NightOut !== 'number')
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

	$.Search = function (inputParams) {

		try {

			var params = {};

			options = $.extend({}, defaults, inputParams);

			checkRequiredInputParameters();

			switch (options.searchObject) {

				case "placements": 

					/////////////////////////////////////////////////////
					//	      SEARCH PLACEMENT OBJECT BY AREA		   //
					/////////////////////////////////////////////////////
						Placements = SearchObject;
						Placements.initSearchMethod = "hotel_init_search";
						Placements.checkStateMethod = "hotel_get_search_state";
						Placements.processPlacementsMethod = "hotel_get_current_hotels";

						Placements.initObject = function (options) {
							this.checkQueryParameters(options.parameters);
							this.searchParameters = {
									id: options.parameters.searchId,
									method: this.initSearchMethod,
									params: [options.parameters.id, options.parameters.CheckIn, options.parameters.CheckOut, [], [], [{adults: options.parameters.Adults, children: options.parameters.Children, children_ages: []}], 0],
								};
							this.searchURL = options.queryAddress;
							this.renderResult = options.renderResult;
						};
						Placements.checkState = function () {
							var t = this;
							$.ajax({

								method: "post",
								url: t.searchURL,
								data: JSON.stringify({
									id: new Date().getTime(),
									method: t.checkStateMethod,
									params: [t.returnedSearchId, 0]
								}),
								dataType: 'json',
								success: function (data) {

									
									if (data.result.hotels_count > t.count) {

										t.count = data.result.hotels_count;
										Placements.processCurrentPlacements();

									} else if (! data.result.completed ) {

										setTimeout(function() {
											t.checkState();
										}, 1000);

									} else {

										if(t.count == 0)
											alert("Your search did not match");
										else if ( data.result.completed ) {
											options.afterFinishSearch(t.objectResults);
										}

									}
									
								}

							});

						};
						Placements.processCurrentPlacements = function () {
							var t = this;
							$.ajax({

								method: "post",
								url: t.searchURL,
								data: JSON.stringify({
									id: new Date().getTime(),
									method: t.processPlacementsMethod,
									params: [t.returnedSearchId, 0]
								}),
								dataType: 'json',
								success: function (data) {

									t.objectResults.push(data.result.hotels);

									t.count = data.result.search_state.hotels_count;

									t.renderResult(data.result.hotels);

									if(! data.result.search_state.completed )
										setTimeout(function(){
											Placements.checkState();
										}, 1000);
									else if ( data.result.search_state.completed ) 
											options.afterFinishSearch(t.objectResults);
									
								}

							});

						};

					Placements.initObject(options);

					$.ajax({

						method: "post",
						url: Placements.searchURL,
						data: JSON.stringify(Placements.searchParameters),
						dataType: 'json',
						beforeSend: options.beforeStartSearch,
						success: function (data) {

							Placements.returnedSearchId = data.result;

							Placements.checkState();

						}

					});

					break;

				case "rooms":

					/////////////////////////////////////////////////////
					//	      SEARCH ROOMS OBJECT BY PLACEMENT		   //
					/////////////////////////////////////////////////////
					Rooms = SearchObject;
					Rooms.initSearchMethod = "somehotels_get_rooms";//"hotel_get_rooms";

					Rooms.initObject = function (options) {
						this.checkQueryParameters(options.parameters);
						this.searchParameters = {
								id: options.parameters.searchId,
								method: this.initSearchMethod,
						};

						var df = options.parameters.CheckIn.split('.'), dt = options.parameters.CheckOut.split('.'), 
							children = parseInt(options.parameters.Children),
							adults   = parseInt(options.parameters.Adults),
							sId = df[0] + df[1] + dt[0] + dt[1] + '777' + "-0-0-" + adults + children + (children > 0 ? "06".repeat(children) : "");

						this.searchParameters.params = {search_id: sId, hotel_ids: options.parameters.id, tourtip: options.parameters.priceType};

						this.searchURL = options.queryAddress;
						this.renderResult = options.renderResult;
					};

					Rooms.initObject(options);
					$.ajax({

						method: "post",
						url: Rooms.searchURL,
						data: JSON.stringify(Rooms.searchParameters),
						dataType: 'json',
						beforeSend: options.beforeStartSearch,
						success: function (data) {

							if (! $.isArray(data.result.hotels) || data.result.hotels.length <= 0) {
								Rooms.renderResult(false);
								return;
							} else 
								Rooms.renderResult(data.result.hotels);

						}

					});

					break;

				case "tours":

					/////////////////////////////////////////////////////
					//	      SEARCH TOURS OBJECT BY PLACEMENT		   //
					/////////////////////////////////////////////////////
					Tours = SearchObject;
					Tours.initSearchMethod = "SearchTours";

					Tours.initObject = function (options) {
						this.checkQueryParameters(options.parameters);
						this.searchParameters = {
							id: options.parameters.searchId,
							method: this.initSearchMethod,
							params:
								{
									paging: {
										size:20,
										page: options.parameters.page
									},
									where: {
										date: [options.parameters.CheckIn,options.parameters.CheckOut],
										cityFrom: options.parameters.cityFrom,
										countryKey: options.parameters.country,
										nights: [options.parameters.NightIn,options.parameters.NightOut],
										adults: options.parameters.Adults,
										childs: options.parameters.Children,
                                        tourTypes: [0, 1, 2, 3, 4, 5, 8, 9, 10, 11, 13, 14, 15, 27, 28],
										tours: [],
										cities: [],
										hotels: [],
										stars: [],
										meals: []
									},
									sort: {
										price: "asc"
									},
									disablegroup: "true"
								}
						};
                        if(typeof options.parameters.age1 !== "undefined")
                            this.searchParameters.params.where.age1 = options.parameters.age1;
                        if(typeof options.parameters.age2 !== "undefined")
                            this.searchParameters.params.where.age2 = options.parameters.age2;
						if(typeof options.parameters.tours !== "undefined")
                            this.searchParameters.params.where.tours = options.parameters.tours;
                        if(typeof options.parameters.cities !== "undefined")
                            this.searchParameters.params.where.cities = options.parameters.cities;
                        if(typeof options.parameters.hotels !== "undefined")
                            this.searchParameters.params.where.hotels = options.parameters.hotels;
                        if(typeof options.parameters.stars !== "undefined")
                            this.searchParameters.params.where.stars = options.parameters.stars;
                        if(typeof options.parameters.meals !== "undefined")
                            this.searchParameters.params.where.meals = options.parameters.meals;
                        if(typeof options.parameters.prices !== "undefined")
                            this.searchParameters.params.where.prices = options.parameters.prices;

						this.searchURL = options.queryAddress;
						this.renderResult = options.renderResult;
						this.ajaxPagenavigation = options.ajaxPagenavigation;
					};


					Tours.initObject(options);

					//console.log(JSON.stringify(Tours.searchParameters), 333);

					$.ajax({

						method: "post",
						url: Tours.searchURL,
						data: JSON.stringify(Tours.searchParameters),
						dataType: 'json',
						//beforeSend: options.beforeStartSearch,
						error: function () {
							options.afterFinishSearch();
						},
						success: function (data) {

							//alert(data.result.List);
							if (! $.isArray(data.result.List) || data.result.List.length <= 0) {
								Tours.renderResult(false);
								Tours.ajaxPagenavigation("", false);
								options.afterFinishSearch();
								return;
							}

                            //console.log(data.result.List);
							Tours.renderResult(data.result.List);
							Tours.ajaxPagenavigation(JSON.stringify({
								countPage: data.result.pageCount,
								page: options.parameters.page,
								countItems: data.result.rowCount,
								countItemsPage: 20,
								UrlPath: window.location.pathname,
								NavQueryString: window.location.search
							}), data.result.pageCount);


						}

					});

					break;

				case "hotels":

					/////////////////////////////////////////////////////
					//	      SEARCH TOURS OBJECT BY Hotels (Sletat.ru)//
					/////////////////////////////////////////////////////
					Hotels = SearchObject;
					Hotels.initSearchMethod = "Search";

					Hotels.initObject = function (options) {
						this.checkQueryParameters(options.parameters);
						this.searchParameters = {
							//id: options.parameters.searchId,
							method: this.initSearchMethod,
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
								meals: [],
								state: false,
								requestId: 0,
								listHotels: []
							}
						};

                        if(typeof options.parameters.age1 !== "undefined")
                            this.searchParameters.params.kidsAges[0] = options.parameters.age1;
                        if(typeof options.parameters.age2 !== "undefined")
                            this.searchParameters.params.kidsAges[1] = options.parameters.age2;
                        if(typeof options.parameters.age3 !== "undefined")
                            this.searchParameters.params.kidsAges[2] = options.parameters.age3;
						if(typeof options.parameters.cities !== "undefined")
							this.searchParameters.params.cities = options.parameters.cities;
						if(typeof options.parameters.hotels !== "undefined")
							this.searchParameters.params.hotels = options.parameters.hotels;
						if(typeof options.parameters.stars !== "undefined")
							this.searchParameters.params.stars = options.parameters.stars;
						if(typeof options.parameters.meals !== "undefined")
							this.searchParameters.params.meals = options.parameters.meals;
						/*if(typeof options.parameters.prices !== "undefined")
							this.searchParameters.params.where.prices = options.parameters.prices;*/

						this.searchURL = options.queryAddress;
						this.renderResult = options.renderResult;
						this.beforeStartSearch = options.beforeStartSearch;
						this.afterFinishSearch = options.afterFinishSearch;
                        this.notShowPreloader = true;
					};


					Hotels.initObject(options);
					//console.log(JSON.stringify(Hotels.searchParameters), 444);
                    //Hotels.beforeStartSearch();

					ajax__(Hotels.searchParameters);

					break;

                case "bustours":

                    /////////////////////////////////////////////////////
                    //	      SEARCH TOURS OBJECT BY PLACEMENT		   //
                    /////////////////////////////////////////////////////
                    Tours = SearchObject;
                    Tours.initSearchMethod = "SearchTours";

                    Tours.initObject = function (options) {

                        options.parameters.NightIn = options.parameters.NightIn - 1;
                        options.parameters.NightOut = options.parameters.NightOut - 1;

                        this.checkQueryParameters(options.parameters);
                        this.searchParameters = {
                            id: options.parameters.searchId,
                            method: this.initSearchMethod,
                            params:
                                {
                                    paging: {
                                        size:20,
                                        page: options.parameters.page
                                    },
                                    where: {
                                        date: [options.parameters.CheckIn,options.parameters.CheckOut],
                                        cityFrom: options.parameters.cityFrom,
                                        countryKey: options.parameters.country,
                                        nights: [options.parameters.NightIn,options.parameters.NightOut],
                                        adults: options.parameters.Adults,
                                        childs: options.parameters.Children,
                                        tourTypes: [12],
                                        tours: [],
                                        cities: [],
                                        hotels: [],
                                        stars: [],
                                        meals: []
                                    },
                                    sort: {
                                        price: "asc"
                                    },
                                    disablegroup: "true"
                                }
                        };
                        if(typeof options.parameters.tours !== "undefined")
                            this.searchParameters.params.where.tours = options.parameters.tours;
                        if(typeof options.parameters.cities !== "undefined")
                            this.searchParameters.params.where.cities = options.parameters.cities;
                        if(typeof options.parameters.hotels !== "undefined")
                            this.searchParameters.params.where.hotels = options.parameters.hotels;
                        if(typeof options.parameters.stars !== "undefined")
                            this.searchParameters.params.where.stars = options.parameters.stars;
                        if(typeof options.parameters.meals !== "undefined")
                            this.searchParameters.params.where.meals = options.parameters.meals;
                        if(typeof options.parameters.prices !== "undefined")
                            this.searchParameters.params.where.prices = options.parameters.prices;

                        this.searchURL = options.queryAddress;
                        this.renderResult = options.renderResult;
                        this.ajaxPagenavigation = options.ajaxPagenavigation;
                    };


                    Tours.initObject(options);

                    $.ajax({

                        method: "post",
                        url: Tours.searchURL,
                        data: JSON.stringify(Tours.searchParameters),
                        dataType: 'json',
                        //beforeSend: options.beforeStartSearch,
                        error: function () {
                            options.afterFinishSearch();
                        },
                        success: function (data) {

                            //alert(data.result.List);
                            if (! $.isArray(data.result.List) || data.result.List.length <= 0) {
                                Tours.renderResult(false);
                                Tours.ajaxPagenavigation("", false);
                                options.afterFinishSearch();
                                return;
                            }

                            Tours.renderResult(data.result.List);
                            Tours.ajaxPagenavigation(JSON.stringify({
                                countPage: data.result.pageCount,
                                page: options.parameters.page,
                                countItems: data.result.rowCount,
                                countItemsPage: 20,
                                UrlPath: window.location.pathname,
                                NavQueryString: window.location.search
                            }), data.result.pageCount);


                        }

                    });

                    break;

			}

		} catch (e) {

			showWarnings(e);

		}


	}


})(jQuery);
