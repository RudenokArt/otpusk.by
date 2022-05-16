	
window.Utilites = {
	/**
	* search min price
	*/
	getMinPrice: function(obj) {

		var k, min = 99999999999999999; minPrice = min;

		for (k in obj) {

			if (obj[k].price.BYN < minPrice)
				minPrice = obj[k].price.BYN;

		} 

		return min == minPrice ? 0 : minPrice;

	},

	/**
	* search max price
	*/
	getMaxPrice: function (obj) {

		var k, max = -1; maxPrice = max;

		for (k in obj) {

			if (obj[k].price.BYN > maxPrice)
				maxPrice = obj[k].price.BYN;

		} 

		return max == maxPrice ? 0 : maxPrice;

	},

	/**
	* get html template of item
	*/
	getHtmlTemplateItem: function () {

		var templ = '<div id="item#id#" class="package-list-item clearfix">';
				templ += '<div class="image">';
					templ += '<a href="#href#">' + '<img src="#img#" alt="#name#">' + "</a>";
				templ += '</div>';
				templ +='<div class="content">';
					templ += '<h5><a style="color: black" href="#href#">#name#</a></h5>';
					templ += '<div class="row gap-10">';
 						templ += '<div class="col-sm-12 col-md-9">';
 							templ += '<ul class="list-info">';
 								templ += '<li><span class="icon"><i class="fa fa-map-marker"></i></span> <span class="font600">#place#</span></li>';
 								templ += '<li>#text#</li>';
 							templ += '</ul>';
 						templ += '</div>';
 						templ += '<div class="col-sm-12 col-md-3 text-right text-left-sm">';
 							templ += '<center>';
     							templ += '<div class="price" style="line-height:16px; border:1px solid"><span>от</span><br>#price# ' + current_currency.iso + '<br><span>за номер</span></div>';
     							templ += '<a href="#href#" class="btn btn-primary btn-sm">Подробнее</a>';
     						templ += '</center>';
     					templ += '</div>';
 					templ += '</div>';
 					
				templ += '</div>';
			templ += '</div>';

		return templ;

	},

	/**
	* get html item
	*/
	getHtmlItem: function (item) {

		var i,

		html = Utilites.getHtmlTemplateItem();

		html = html.replace("#id#", item.id);
		
		for (i = 1; i<= 3; i++)
			html = html.replace("#href#", item.detail_url);
		
		html = html.replace("#img#", item.image);
		
		for (i = 1; i<= 2; i++)
			html = html.replace("#name#", item.name);

		html = html.replace("#place#", item.place);
		html = html.replace("#text#", item.text);
		html = html.replace("#price#", item.price);

		return html;

	},


	/**
	* draw map point
	*/
	map: function (mapCenter, mapContainerID, callback) {

		var t = this;

		t.ready = false;
		
		t.markers = [],

		t.map = new google.maps.Map(document.getElementById(mapContainerID),{
				center: {lat: parseFloat(mapCenter.lat), lng: parseFloat(mapCenter.lng)},
				zoom: 7
			});

		if (typeof callback === 'function') {
			callback();
		}

		t.draw = function (items, callback) {

			var k, item, infowindow = []; t.markers = [];
			for (k in items) {

				item = items[k];

				infowindow.push(new google.maps.InfoWindow({
											    content: '<div><a href="'+item.detail_url+'">'+item.name+'</a></div>',
											  }));

				t.markers.push(new google.maps.Marker({
								title: item.name,
								position: {lat: parseFloat(item.latlng.lat), lng: parseFloat(item.latlng.lng)},
								map: t.map,
								icon: '/bitrix/templates/main/images/map/marker24.png',
								info: infowindow[k]
							}));
				
				

				t.markers[k].addListener('click', function() {
									   this.info.open(t.map, this);
								  });
			}

			t.ready = true;

			if (typeof callback === 'function') {
				callback();
			}

		};

		t.clear = function () {
			var k;
			for (k in t.markers) {
				t.markers[k].setMap(null);
			}
		};

	},

}
	
