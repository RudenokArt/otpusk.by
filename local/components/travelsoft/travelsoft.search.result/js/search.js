
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
		renderResult: function (data) {}

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
	checkRequiredInputParameters = function () {

		var allowedSearchObjects = ['placements', 'rooms'], warnings = [];

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
		returnedSearchId: "",
		objectResults: [],

		// methods
		checkQueryParameters: function (params) {
			var warnings = []; dateFormat = /^\d{2}\.\d{2}\.\d{4}$/;

			if (params.searchId == "")
				warnings.push("searchId parameter not setted");

			if ((typeof params.id.length !== 'undefined' && params.id.length <= 0) || 
					(params.id < 0))
				warnings.push("Object id for search not setted");

			if ((typeof params.cid.length !== 'undefined' && params.cid.length <= 0) ||
				(params.cid < 0))
				params.cid = 0;

			if (! dateFormat.test(params.CheckIn))
				warnings.push("CheckIn parameter format must be dd.mm.yyyy");

			if (! dateFormat.test(params.CheckOut))
				warnings.push("CheckOut parameter format must be dd.mm.yyyy");

			if (typeof params.Adults === 'undefined' || typeof params.Adults !== 'number' || params.Adults < 1)
				params.Adults = 1;

			if (typeof params.Children === 'undefined' || typeof params.Children !== 'number' || params.Children < 0)
				params.Children = 0;

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
									params: [options.parameters.cid, options.parameters.id, options.parameters.CheckIn, options.parameters.CheckOut, [], [], [{adults: options.parameters.Adults, children: options.parameters.Children, children_ages: []}], 0],
								};
							this.searchURL = options.queryAddress;
							this.renderResult = options.renderResult;
						};
						Placements.checkState = function () {
							var t = this;
							$.ajax({

								method: "post",
								//url: t.searchURL,
								url: 'https://booking2.otpusk.by/TSSE_TEST/json_handler.ashx',
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
						//url: Placements.searchURL,
						url: 'https://booking2.otpusk.by/TSSE_TEST/json_handler.ashx',
						data: JSON.stringify(Placements.searchParameters),
						dataType: 'json',
						beforeSend: options.beforeStartSearch,
						success: function (data) {

							//console.log(data.result,1);
							/*var res = data.result;
							while(res.indexOf("+") > -1){
                            	res = res.replace("+", "\+");
							}*/
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
                            //console.log(data);
							if (! $.isArray(data.result.hotels) || data.result.hotels.length <= 0) {
								Rooms.renderResult(false);
								return;
							} else 
								Rooms.renderResult(data.result.hotels);

						}

					});

					break;

			}

		} catch (e) {

			showWarnings(e);

		}


	}


})(jQuery);
