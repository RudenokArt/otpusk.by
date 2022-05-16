<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

\Bitrix\Main\Loader::includeModule('travelsoft.currency');
$currency = \Bitrix\Main\Web\Json::encode(\travelsoft\Currency::getInstance()->get('currency'));
$current_currency = \Bitrix\Main\Web\Json::encode(\travelsoft\Currency::getInstance()->get('current_currency'));
$currency_format_decimals = \Bitrix\Main\Config\Option::get('travelsoft.currency', 'currency_format_decimals');
$currency_format_dec_point = \Bitrix\Main\Config\Option::get('travelsoft.currency', 'currency_format_dec_point');
$currency_format_thousands_sep = \Bitrix\Main\Config\Option::get('travelsoft.currency', 'currency_format_thousands_sep');
$cityFrom = \Bitrix\Main\Web\Json::encode($arResult["cityList"]);
$country = \Bitrix\Main\Web\Json::encode($arResult["countryList"]);
?>

<div class="col-sm-8 col-md-9">

	<div class="sorting-content mb-20 ">
	    <div class="row">
	        <div class="col-sm-12 col-md-8">
	            <div class="sort-by-wrapper">
	                <label class="sorting-label"></label>
	                <div class="sorting-middle-holder">
	                    <ul class="sort-by">
	                        <li><a class="sort" data-sort-order="asc" data-sort-by="price" href="#">По цене <i class=" fa fa-long-arrow-down"></i><i class=" fa fa-long-arrow-up"></i></a></li>
	                        <li><a class="sort" data-sort-order="asc" data-sort-by="name" href="#">По названию <i class=" fa fa-long-arrow-down"></i><i class=" fa fa-long-arrow-up"></i></a></li>
	                    </ul>
	                </div>
	            </div>
	        </div>
	        <div class="col-sm-12 col-md-4">
	            <div class="sort-by-wrapper mt pull-right pull-left-sm mt-10-sm">
	                <label class="sorting-label"> </label>
	                <div class="sorting-middle-holder">
	                    <a data-css-selector=".on-page-result-page" class="btn btn-sorting active tab" href="#"><i class="fs-18 fa fa-th-list"></i> Списком</a>
	                    <a data-css-selector=".map-wrapper" data-todo="cm" class="btn btn-sorting tab" href="#"><i class="fs-18 fa fa-map"></i> На карте</a>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

	<div class="package-list-item-wrapper on-page-result-page"></div>
	<div class="map-wrapper">
		<div id="placements-map"></div>
	</div>
</div>

<div class="col-sm-4 col-md-3 filter"></div>

<script type="text/javascript" src="<?= $componentPath?>/js/search.js"></script>
<script type="text/javascript" src="<?= $componentPath?>/js/filter.js"></script>
<script type="text/javascript" src="<?= $componentPath?>/js/sort.js"></script>
<script src="https://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="<?= $componentPath?>/js/utilites.js"></script>

<script type="text/javascript">

	var loadedPlacements = [], mapCenter;
    var currency = JSON.parse('<?=$currency?>'), current_currency = JSON.parse('<?=$current_currency?>'), currency_format_decimals = '<?=$currency_format_decimals?>', currency_format_dec_point = '<?=$currency_format_dec_point?>', currency_format_thousands_sep = '<?=$currency_format_thousands_sep?>';
    var bx_cityFrom = JSON.parse('<?=$cityFrom?>'), bx_country = JSON.parse('<?=$country?>');

    //console.log(bx_cityFrom,1);
    //console.log(bx_country,2);

    function convertCurrency(price=null, in_currency=null, out_currency=null, onlyN=null) {

        if(in_currency == null || in_currency.match(/^\d+$/) === null){
            in_currency = find(in_currency);
        } else {
            in_currency = currency[in_currency]['id'];
        }
        if (out_currency == null) {
            out_currency = Number(current_currency['id']);
        } else if(out_currency.match(/^\d+$/) === null) {
            out_currency = find(out_currency);
        }

        price = price/currency[in_currency]['course'][currency[out_currency]['iso']];
        if (onlyN)
            return format(price);

        //console.log(price,1);
        return format(price, currency[out_currency]['iso']);
    }

    function find(find) {

        if (typeof currency[find] !== "undefined") {
            return true;
        } else {
            for (var val in currency) {
                if (currency[val]['iso'] == find) {
                    find = currency[val]['id'];
                    return Number(find);
                }
            }
        }

        return false;
    }

    function format(price,out_currency) {

        //console.log(out_currency,3);
        new_currency_format_thousands_sep = currency_format_thousands_sep == "" ? " " : currency_format_thousands_sep;
        //console.log(new_currency_format_thousands_sep, 2);
        /*if(typeof out_currency !== "undefined")
            new_currency_format_thousands_sep += ' ' + out_currency;*/
        return $.number_format(
            price,
            currency_format_decimals,
            currency_format_dec_point,
            new_currency_format_thousands_sep);

    }

	/**
	* searchObject: placements - поиск размещений по городу, стране и т.д
	*				rooms - поиск размещений по конкретному объекту
	*/
	$.Search({
		searchObject: "placements",
		parameters: {
			searchId: <?= $arResult['searchId']?>,
			id: <?= $arResult['id']?>,
			cid: <?= $arResult['cid']?>,
			CheckIn: "<?= $arResult['CheckIn']?>",
			CheckOut: "<?= $arResult['CheckOut']?>",
			Adults: <?= $arResult['Adults']?>,
			Children: <?= $arResult['Children']?>
		},
		queryAddress: "<?= $arResult['queryAddress']?>",
		beforeStartSearch: function () {
			/**
			 * introLoader - Preloader
			 */
			$("#introLoader").introLoader({
				animation: {
						name: 'gifLoader',
						options: {
								ease: "easeInOutCirc",
								style: 'dark bubble',
								delayBefore: 4000,
								delayAfter: 0,
								exitTime: 1000
						}
				}
			});	
		},
		afterFinishSearch: function (data) { 

			setTimeout(function () {

				if (data.length > 0) {

					var k, k2, cnt, ids = [], minPrice, keys = [],

					priceFilter = {
						type : 'range',
						title : 'Цена',
						name : 'price',
						values : [],
						contain : []
					},

					sortData = [], i = 0;

					for (k in data) {
						for (k2 in data[k]){
							
							ids.push(data[k][k2].id);
							
							// make price filter data
							minPrice = Utilites.getMinPrice(data[k][k2].rooms[0].variants);

							priceFilter.values.push({price: {BYN: minPrice}});

							priceFilter.contain[minPrice] = data[k][k2].id;

							// make sort data
							sortData.push({id: data[k][k2].id, price: minPrice, name: "", html: ""});
							keys[data[k][k2].id] = i;
							i++;
						}
					}

					priceFilter.minVal = Utilites.getMinPrice(priceFilter.values);
					priceFilter.maxVal = Utilites.getMaxPrice(priceFilter.values);

					if (ids.length > 0) {
						
						$.ajax({

							method: 'post',
							url: '/ajax/get_placements_filter.php',
							data: {id: ids},
							dataType: 'json',
							success: function (filter) {
								
								if (filter.error)
									return;
								
								filter.filter.price = priceFilter;

								///////////////////////////////////////////////
								// 		 MAKE JS FILTRATION OF ELEMENTS 	 //
								///////////////////////////////////////////////
								$('.filter').drawFilter({
									filter: filter.filter,
									afterDraw: function () {
										var t = $("#price_range");
										t.ionRangeSlider({
											type: "double",
											grid: true,
											min: parseInt(t.data("min")) - 1,
											max: parseInt(t.data("max")) + 1,
											from: parseInt(t.data("from")) - 1,
											to: parseInt(t.data("to")) + 1,
											prefix: "",
											onFinish: function(v){ 
												
												$("#max-filter-price").val(v.to);
												$("#min-filter-price").val(v.from).trigger('change');

											}
										});

									},

									afterFiltration: function (itemsID) {

										map.clear();

										if (itemsID === null)
											return;

										var k, items = [], item;

										if (!itemsID.length) {
											map.draw(loadedPlacements);
											
										} else {

											for (k in loadedPlacements) {
												item = loadedPlacements[k];
												if ($.inArray(item.id, itemsID) > -1)
													items.push(item);
											}

											map.draw(items);

										}

										return;

									}
								});
							}

						});

						///////////////////////////////////////////////
						// 		  MAKE JS SORTING OF ELEMENTS 		 //
						///////////////////////////////////////////////
						var sort = new TSSorter(sortData);

						for (k in loadedPlacements) {

							item = loadedPlacements[k];

							// add info for sort array
							sortData[keys[item.id]].name = item.name;
							sortData[keys[item.id]].html = Utilites.getHtmlItem(item);
						}

						$(document).on('click', '.sort', function (e) {

							var sortBy = $(this).data('sort-by'),
								order = $(this).data('sort-order'),
								sortBySel = $(this).closest('.sort-by'),
								t = $(this);
								sorted = sort.cSort(sortBy, order),

								html = "";

								for (k in sorted) {
									html += sorted[k].html;
								}

								sortBySel.find('.fa-long-arrow-up').hide();
								sortBySel.find('.fa-long-arrow-down').hide();
								sortBySel.find('li.active').removeClass('active');
								$(this).parent().addClass('active');

								if (order == 'desc') {
									t.data('sort-order', 'asc');
									
									t.find('.fa-long-arrow-down').show();
								} else {
									t.data('sort-order', 'desc');

									t.find('.fa-long-arrow-up').show();
								}

								$('.on-page-result-page').html(html);

								return false;
						});
						

						///////////////////////////////////////////////
						// MAKE JS MAP OF ELEMENTS, LIST/MAP CHECKER //
						///////////////////////////////////////////////

                        if(typeof mapCenter ==='undefined'){
                            mapCenter = loadedPlacements[0].latlng;
                        }
						// init map
						var map = new Utilites.map(mapCenter, "placements-map");

						// draw placements
						map.draw(loadedPlacements, function () {

							// hide map wrapper, hack for right display after show/hide
							setTimeout(function () {
								$('.map-wrapper').hide();
							}, 2200);

						});

						$(document).on('click', '.tab', function () {

							var t = $(this); actClass = "active";

							if (t.hasClass(actClass))
								return false;

							$('.tab').each(function () {

								var tt = $(this);
								tt.removeClass(actClass);

								$(tt.data('css-selector')).hide();

							});

							t.addClass(actClass);

							$(t.data('css-selector')).show();

							return false;

						});
					}

				}
			}, 1000);		

		}, 
		renderResult: function (data) {

			if (data.length > 0) {

				var k, ids = [], keys = {}, minPrice, item, nf_mess = "not received any data";

				for (k in data) {

					ids.push(data[k].id);
					keys[data[k].id] = k;
				}

				if (ids.length > 0) {

					var placeId = <?= $arResult['id']?>, params = {'id': ids, 'pid': placeId};

					$.ajax({

						method: 'post',
						url: '/ajax/get_placements.php',
						data: params,
						dataType: 'json',
						success: function (placements) {

							if (!placements.error) {

								var templ, i;

								for (k in placements.items) {

									item = placements.items[k];

									item.price = Utilites.getMinPrice(data[ keys[item.id] ].rooms[0].variants);
                                    item.price = convertCurrency(item.price,"BYN",current_currency.iso);
                                    //console.log(item.price);
									item.detail_url += "?id=" + item.id + '&CheckIn=<?= $arResult['CheckIn']?>&CheckOut=<?= $arResult['CheckOut']?>&Adults=<?= $arResult['Adults']?>&Children=<?= $arResult['Children']?>#section-1234522';

									$('.on-page-result-page').append(Utilites.getHtmlItem(item));

									if (typeof placements.latlng !== 'undefined') {
										params = {'id': ids};
										mapCenter = {lat: 53.907423, lng: 27.436724};//placements.latlng;
									}

									loadedPlacements.push(item);
								}

							} else
								alert(nf_mess);

							return;
						}
					});
					return;
				}
				alert(nf_mess);
				return;
			}
			alert(nf_mess);
		}
	});

</script>