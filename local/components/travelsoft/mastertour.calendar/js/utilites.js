	
window.Utilites = {

    /**
     * get date
     */
    getDate: function (item, date) {
        /*console.log(item);
        console.log(date);*/

        if (date.length > 0) {

            var cntYears = date.length, i, j, cntYearsItems = item.years.length, tmpl = '';

            for (i=0;i<cntYears;i++) {

                for (j=0;j<cntYearsItems;j++) {

                    if (date[i].year == item.years[j].year) {

                        var cntMonthDate = date[i].months.length, k, cntMonthItems = item.years[j].months.length, p;

                        for (k = 0; k < cntMonthDate; k++) {
                            tmpl += '<div style="width: 80px; text-align: center;">';
                            var flag = false;

                            for (p = 0; p < cntMonthItems; p++) {

                                if (item.years[j].months[p]["id"] == date[i].months[k]["id"] && item.years[j].months[p].dates.length > 0) {

                                    var d, cntDatesMonth = item.years[j].months[p].dates.length;

                                    for (d=0;d<cntDatesMonth;d++) {
                                        tmpl += '<span>' + item.years[j].months[p].dates[d].date + '</span>';
                                        if (d !== (cntDatesMonth-1))
                                            tmpl += '<br>';
                                    }
                                    flag = true;

                                }
                                /*if (item.years[j].months[p]["id"] !== date[i].months[k]["id"]) {

                                    tmpl += '<span> - </span>';

                                }*/


                            }
                            if (flag === false) {
                                tmpl += '<span> - </span>';
                            }
                            tmpl += '</div>';


                        }

                    }

                }

            }

            return tmpl;

        }
    },

    /**
     * get night
     */
    getDetail: function (item) {

        if (typeof  item["detail"] !== "undefined")
            return '<a target="_blank" href="' + item["detail"] + '"><img src="' + item["picture"] + '" alt="' + item["name"] + '"></a>';
        else
            return '<a><img src="' + item["picture"] + '" alt="' + item["name"] + '"></a>';

    },

    /**
     * get name
     */
    getName: function (item) {

        templ = '<div style="width: 367px">';
        if (typeof  item["detail"] !== "undefined")
            templ += '<a target="_blank" href="' + item["detail"] + '"><span>' + item["name"] + '</span></a>';
        else
            templ += '<span>' + item["name"] + '</span>';

        templ += '</div>';

        return templ;

    },
    getNameCountry: function (item) {

        templ = '<div style="width: 100%;text-align: center">';

        if (typeof  item !== "undefined")
            templ += '<span>' + item + '</span>';

        templ += '</div>';

        return templ;

    },

    /**
     * get night text
     */
    getNightText: function (n, v) {

        var m = 1;
        if(v == 1)
            n = n + 1;

        m = (n % 100);
        if(m > 19)
            m = (m % 10);

        if(m == 0 || (m >= 5 && m <= 19))
            return v == 2 ? n + " ночей" : n + " дней";
        else if(m == 1) return v == 2 ? n + " ночь"  : n + " день";
        else if(m >= 2 && m <= 4) return v == 2 ? n + " ночи"  : n + " дня";

    },

    /**
     * get night
     */
    getNight: function (item) {

        var night = '';

        if(typeof item["property_tour"] !== "undefined" && typeof item["property_tour"]["days"] !== "undefined") {
            night = item["property_tour"]["days"];
        }
        else{
            if(typeof item["property"]["night"] !== "undefined"){
                night = Utilites.getNightText(item["property"]["night"],1) + ' ' + Utilites.getNightText(item["property"]["night"],2);
            }
        }
        if (typeof night !== "")
            return '<div class="absolute-in-image"><div class="duration"><span>' + night + '</span></div></div>';
        else
            return '';
    },

    /**
     * get type tour
     */
    getTypeTour: function (item) {

        if (typeof item["property_tour"] !== "undefined" && typeof item["property_tour"]["typetour"] !== "undefined")
            return '<p class="line18">' + item["property_tour"]["typetour"] + '</p>';
        else return '';
    },

    /**
     * get price
     */
    getPrice: function (item) {

        temp = '<div style="width: 80px;text-align: center;"><span>';
        if(typeof item["price"] !== "undefined" && item["price"] != "") {
            temp += item["price"];
        }
        else
        {
            temp += ' - ';
        }
        temp += '</span></div>';
        return temp;
    },

    /**
     * get property tour
     */
    getTourProp: function (item) {

        temp = '';

        if(typeof item["property_tour"] !== "undefined") {

            if(typeof item["property_tour"]["city"] !== "undefined") {
                temp += '<li><span class="icon"><i class="fa fa-map-marker"></i></span><span class="font600">' + item["property_tour"]["city"] + '</span></li>';
            }
            if(typeof item["property_tour"]["point"] !== "undefined") {
                temp += '<li><span class="icon"><i class="fa fa-flag"></i></span><span class="font600"> из ' + item["property_tour"]["point"] + '</span></li>';
            }
            if(typeof item["property"]["accm"] !== "undefined") {
                temp += '<li><span class="icon"><i class="fa fa-home"></i></span><span class="font600"> Размещение ' + item["property"]["accm"] + '</span></li>';
                window.Utilites.accmPrinted = true;
            }
            if(typeof item["property_tour"]["food"] !== "undefined") {
                temp += '<li><span class="icon"><i class="fa fa-cutlery"></i></span><span class="font600"> Питание ' + item["property_tour"]["food"] + '</span></li>';
            }
            else{
                if(typeof item["property"]["meal"] !== "undefined") {
                    temp += '<li><span class="icon"><i class="fa fa-cutlery"></i></span><span class="font600"> Питание ' + item["property"]["meal"] + '</span></li>';
                    window.Utilites.foodPrinted = true;
                }
            }

        }
        /*else{
            if(typeof item["property"]["accm"] !== "undefined" && window.Utilites.accmPrinted === false) {
                temp += '<li><span class="icon"><i class="fa fa-home"></i></span><span class="font600"> Размещение ' + item["property"]["accm"] + '</span></li>';
            }
            if(typeof item["property"]["meal"] !== "undefined" && window.Utilites.foodPrinted === false) {
                temp += '<li><span class="icon"><i class="fa fa-cutlery"></i></span><span class="font600"> Питание ' + item["property"]["meal"] + '</span></li>';
                window.Utilites.foodPrinted = true;
            }
        }*/
        return temp;


    },

    /**
     * get html head
     */
    getHtmlHead: function (item) {

        if (item.length > 0) {

            var i, j, cnt = item.length, templ = '<li class="availabily-heading clearfix">';

            templ += '<div style="width: 367px; text-align: center">Название</div>';
            templ += '<div style="width: 80px; text-align: center">Цена от</div>';
            for (i = 0; i < cnt; i++){

                var month = item[i].months.length;

                for (j=0; j < month; j++) {

                    templ += '<div style="width: 80px; text-align: center;">' + item[i].months[j].name + '<br>' + item[i].year + '</div>';

                }

            }
            templ += '</li>';

            return templ;
        }

    },


	/**
	* get html item
	*/

	getHtmlItems: function (items, head) {

        if (items.length > 0) {

            var i, cnt = items.length, templ = '<ul class="availabily-list">';

            templ += Utilites.getHtmlHead(head);

            for (i = 0; i < cnt; i++){

                templ += '<li class="availabily-content clearfix">';

                    templ += Utilites.getName(items[i]);
                    templ += Utilites.getPrice(items[i]);
                    templ += Utilites.getDate(items[i], head);

                templ += '</li>';

            }
            templ += '</ul>';

            return templ;
        }

	},

    getHtmlItemsNew: function (items, head) {

        if (typeof items !== "undefined") {
            var templ = '<ul class="availabily-list">';
            templ += Utilites.getHtmlHead(head);

            for (countryId in items) {

                if (typeof items[countryId]["items"] !== "undefined") {


                    templ += '<li id="country-' + countryId + '" class="availabily-content clearfix" style="padding-top: 10px; background-color: #f6b198">';
                        templ += Utilites.getNameCountry(items[countryId]["name"]);
                    templ += '</li>';

                    for (item in items[countryId]["items"]) {

                        templ += '<li class="availabily-content clearfix">';

                            templ += Utilites.getName(items[countryId]["items"][item]);
                            templ += Utilites.getPrice(items[countryId]["items"][item]);
                            templ += Utilites.getDate(items[countryId]["items"][item], head);

                        templ += '</li>';

                    }
                }
            }

            templ += '</ul>';

            return templ;
        }

    }

}
	
