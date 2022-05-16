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

		var allowedSearchObjects = ['tours'], warnings = [];

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
			var warnings = [];

			if (params.searchId == "")
				warnings.push("searchId parameter not setted");

			if ((typeof params.tourTypes !== 'undefined' && params.tourTypes.length <= 0) ||
					(params.tourTypes <= 0))
				warnings.push("Object idFrom for search not setted");

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

				case "tours":

					/////////////////////////////////////////////////////
					//	      SEARCH TOURS OBJECT BY PLACEMENT		   //
					/////////////////////////////////////////////////////
					Tours = SearchObject;
					Tours.initSearchMethod = "GetCalendarOfTour";

					Tours.initObject = function (options) {
						this.checkQueryParameters(options.parameters);
						this.searchParameters = {
							id: options.parameters.searchId,
							method: this.initSearchMethod,
							params:
								{
									tourTypes: options.parameters.tourTypes,
									citiesFrom: []
								}
						};

						if(typeof options.parameters.citiesFrom !== "undefined")
                            this.searchParameters.params.citiesFrom = options.parameters.citiesFrom;

						this.searchURL = options.queryAddress;
						this.renderResult = options.renderResult;
					};

					Tours.initObject(options);

					$.ajax({

						method: "post",
						url: Tours.searchURL,
						data: JSON.stringify(Tours.searchParameters),
						dataType: 'json',
						beforeSend: options.beforeStartSearch,
						error: function () {
							options.afterFinishSearch();
						},
						success: function (data) {

							//console.log(data);

							//alert(data.result.List);
							if ((! $.isArray(data.result.tours) && !$.isArray(data.result.years)) || data.result.length <= 0) {
								Tours.renderResult(false);
								options.afterFinishSearch();
								return;
							}

							Tours.renderResult(data.result);

						}

					});

					break;

			}

		} catch (e) {

			showWarnings(e);

		}


	}


})(jQuery);
