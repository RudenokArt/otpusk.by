
/**
* jQuery custom filter plugin
*/

(function ($) {

	// container function and objects

	var c = {

		// current wrapper container
		t: {},

		// active filter
		active: false,

		// all search items
		asi: [],

		// parts of filter
		parts: {

			select: {

				event: "change",

				evHandler: function (e) {

					c.utils.proccess();

				},

				tag: 'select',

				getHTML: function (info) {

					var k, html = ""; templ = "<select name='#name#' class='select2-single form-control'>#options#</select>";

					html += "<option value=''>Выберите</option>";

					for (k in info.values) {

						html += "<option value='" + c.sC[info.name][k] + "'>" + info.values[k] + "</option>";
					}

					if (html != "") {

						html = templ.replace("#options#", html);
						html = html.replace("#name#", info.name);

					}

					return c.utils.wrapItemBody(html).replace("#title#", info.title);

				},

				searchItems: function (items, val) {

					var k2;
						
					c.active = true;

					val = val.split(',');

					for (k2 in val)
						items.push(val[k2]);

					return items;

				}

			},

			checkbox: {

				event: "change",

				evHandler: function (e) {

					c.utils.proccess();

				},

				tag: 'input',

				getHTML: function (info) {

					var k, html = "",
					templ = "<div class='checkbox-block'>" +
								"<input id='#id#' name='#name#' type='checkbox' class='checkbox' value='#value#'>" +
								"<label for='#value-for#'>#title#<span class='checkbox-count'></span></label>" +
							"</div>";

					for (k in info.values) {

						html += templ.replace('#name#', info.name);
						html = html.replace('#title#', info.values[k]);
						html = html.replace('#value#', c.sC[info.name][k]);
						html = html.replace('#id#', k);
						html = html.replace('#value-for#', k);

					}

					return c.utils.wrapItemBody(html).replace("#title#", info.title);

				},

				searchItems: function (items, val) {

					var k2;

					c.active = true;

					val = val.split(',');

					for (k2 in val)
						if ($.inArray(val[k2], items) == -1)
							items.push(val[k2]);

					return items;

				}
			},

			text: {

				event: ['keydown', 'change'],

				evHandler: function (e) {
										
					c.utils.proccess();

				},

				tag: 'input',

				getHTML: function (info) {

					var html = "",
					templ = "<input type='text' class='form-control' name='#name#'>";

					html += templ.replace("#name#", info.name);
					
					return c.utils.wrapItemBody(html).replace("#title#", info.title);

				},

				searchItems: function (items, val, name) {

					var k2, n;
						
					c.active = true;

					if ( typeof c.sC[name] !== 'undefined') {

							for (n in c.sC[name]) {

							 	if (n.toString().toLowerCase().indexOf(val.toString().toLowerCase()) > -1 && c.sC[name][n].length > 0 )

									for (k2 in c.sC[name][n]) {

										if ($.inArray(c.sC[name][n][k2], items) < 0) {
											
											items.push(c.sC[name][n][k2]);

										}

									}
							}
					}

					return items;

				}
			},

			range:	{
				event: ['change'],

				evHandler: function (e) {

					c.utils.proccess();

				},

				tag: 'input',

				getHTML: function (info) {

					var html = "",
					templ = "<input data-from='"+info.minVal+"' data-to='"+info.maxVal+"' data-min='"+info.minVal+"' data-max='"+info.maxVal+"' id=\"price_range\" />" +
							"<input id=\"min-filter-price\" name=\"#name#\" type=\"hidden\">" + 
							"<input id=\"max-filter-price\" name=\"#name_max#_max\" type=\"hidden\">";

					html += templ.replace("#name#", info.name);
					html = html.replace("#name_max#", info.name);
					
					return c.utils.wrapItemBody(html).replace("#title#", info.title);

				},

				searchItems: function (items, val, name, t) {

					var k2, n;

					c.active = true;

					max = Number($("#max-filter-price").val());


					if ( typeof c.sC[name] !== 'undefined' && max >= val) {

						for (n in c.sC[name]) {
							//console.log('-');
							//console.log(val +' <= '+ n+' && '+n+' <= '+max);
							//console.log(Number(val) <= Number(n) && Number(n) <= max);

							if (Number(val) <= Number(n) && Number(n) <= max) {	
								items.push(c.sC[name][n].toString());
							}
						}

					}

					return items;
				}
			},		



		},

		// search container
		sC: {},

		// input filter
		inFilter: {},

		// utilites of filter
		utils: {

			proccess: function () {
				
				console.log('filter proccess begin...');

				var result = c.utils.search(), soai = ['div[id^="item"'];

				if (c.active) {

					c.utils.hide(soai);
					console.log('	show items');

					var items = c.utils.inspectation(result);

					if (items.length) {

						var selectors = $.map(items, function(item) {return "#item" + item;} );

						c.utils.show(selectors);

						c.afterFiltration(items);
					} else {
						c.afterFiltration(null);
					}

				} else {
					c.utils.show(soai);
					c.afterFiltration([]);
				}

				console.log('filter proccess completed');

			},

			wrapItemBody: function (html) {

				if (html == "")
					return "";

				return "<div class='sidebar-module'>" +
						"<h6 class='sidebar-title'>#title#</h6>" +
							"<div class='sidebar-module-inner'>" + html + "</div></div>";

			},

			wrapFilterBody: function (html) {

				if (html == "")
					return "";

				return "<aside class='sidebar with-filter'>" +
						"<div class='sidebar-header clearfix'>" +
							"<h4>Фильтр</h4>" +
						"</div>" +
						"<div class='sidebar-inner'>" + html + "</div></aside>";

			},

			afterDraw: {}, 
			afterFiltration: {},

			inspectation: function (results) {

				if (!results.length)
					return [];

				var result = results.shift(), ins = [], i, k, have = false;

				if (!results.length)
					return result;

				var cnt1 = results.length, cnt2 = result.length;

				for (i = 0; i < cnt2; i++) {

					have = false;

					for (k = 0; k < cnt1; k++) {

						if ($.inArray(result[i], results[k]) > -1) {
							have = true;
							break;
						}

					}

					if (have)
						ins.push(result[i]);

				}

				return ins;

			},

			search: function () {

				console.log('	search initialize....');

				var f = c.inFilter, k, items = [], result = [], jQitem;

				c.active = false;

				for (k in f) {

					items = [];

					pseudo = "";
					if (f[k].type == "checkbox")
						var pseudo = ":checked"

					jQitem = $(c.parts[f[k].type].tag + "[name='"+f[k].name+"']" + pseudo);

					jQitem.each(function () {
						
						var val = $(this).val();

						if ( val != "" ) {
							result.push(c.parts[f[k].type].searchItems(items, val, f[k].name, jQitem));
						} 

					});
					
				}

				console.log('	search completed');

				return result;

			},

			hide: function (selectors) {

				if (typeof selectors === 'undefined')
				return false;

				// must be array
				if (typeof selectors.length === 'undefined')
					selectors = [selectors];

				var k;

				for (k in selectors)
					$(selectors[k]).hide();
			},

			show: function (selectors) {

				if (typeof selectors === 'undefined')
				return false;

				// must be array
				if (typeof selectors.length === 'undefined')
					selectors = [selectors];

				var k;

				for (k in selectors)
					$(selectors[k]).show(); 

			},
		}


	}

	$.fn.drawFilter = function (parameters) {
		
		//try {

			// empty filter ?
			c.inFilter = parameters.filter;
			if ( $.isEmptyObject(c.inFilter) )
				throw new Error('Empty filter');

			c.t = this;

			var k, html = "", i, events;

			for (k in c.inFilter) {

				// init search container
				c.sC[c.inFilter[k].name] = c.inFilter[k].contain;

				// make html parts
				html += c.parts[c.inFilter[k].type].getHTML(c.inFilter[k]);

				// set callback after draw filter
				c.afterDraw = parameters.afterDraw;

				// set callback after filtration
				c.afterFiltration = parameters.afterFiltration;

				// draw filter
				$(c.t).html(c.utils.wrapFilterBody(html));
				
				// callback after draw filter
				if (typeof c.afterDraw === 'function') 
					c.afterDraw();
					
				// bind events
				if (!$.isArray(c.parts[c.inFilter[k].type].event))
					c.parts[c.inFilter[k].type].event = [c.parts[c.inFilter[k].type].event];

				events = c.parts[c.inFilter[k].type].event;

				for (i in events) {

					$(document).on(events[i], c.parts[c.inFilter[k].type].tag + "[name='"+c.inFilter[k].name+"']" , c.parts[c.inFilter[k].type].evHandler);
				}

			}
			
		/*} catch (e)  {

			console.warn(e.message);
			return false;

		}
*/
	}
	
})(jQuery)