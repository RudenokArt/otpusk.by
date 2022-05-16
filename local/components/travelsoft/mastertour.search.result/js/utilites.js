	
window.Utilites = {

    foodPrinted: false, accmPrinted: false, mealPrinted: false, cityPrinted: false, roomtypePrinted: false, roomcatPrinted: false, currentPage: 1,

    getTicket: function (item) {

        if (item == "Stop")
            return 'нет билетов';
        if (item == "Available")
            return 'есть билеты';
        if (item == "Request")
            return 'под запрос';

    },

    getTicketHotel: function (item) {

        if (item == "Stop")
            return 'нет мест';
        if (item == "Available")
            return 'есть места';
        if (item == "Request")
            return 'под запрос';

    },

    /**
     * get date
     */
    getDate: function (item) {

        if (typeof item["date"] !== "undefined")
            return '<span style="color: #EB5019; font-weight:normal; font-size:12px;"><b>Дата вылета: </b>' + item["date"] + '</span>';
        else
            return '';
    },

    /**
     * get night
     */
    getDetail: function (item) {
        var data_attr = '';
        if(item["sletat"]){
            data_attr = 'href="#hotel-detail" class="show-popup" data-hotel-id=' + item['HotelId'];
        }
        if (typeof  item["detail"] !== "undefined")
            return '<a target="_blank" href="' + item["detail"] + '" ' + data_attr + '><img src="' + item["picture"] + '" alt="' + item["name"] + '"></a>';
        else
            return '<a ' + data_attr + '><img src="' + item["picture"] + '" alt="' + item["name"] + '"></a>';

    },

    /**
     * get name
     */
    getName: function (item) {
        var data_attr = '';
        if(item["sletat"]){
            data_attr = 'href="#hotel-detail" class="show-popup" data-hotel-id=' + item['HotelId'];
        }
        if (typeof  item["detail"] !== "undefined")
            return '<h5><a target="_blank" href="' + item["detail"] + '" ' + data_attr + '>' + item["name"] + '</a></h5>';
        else
            return '<h5><a style="color: black"' + data_attr + '>' + item["name"] + '</a></h5>';

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

        temp = '';
        if(typeof item["prices"] !== "undefined" || (typeof item["defaultCurrenty"] !== "undefined" && typeof item["defaultRate"] !== "undefined")) {
            temp += '<div class="price" style="line-height:16px; border:1px solid;margin-bottom: 8px;">';
            if(typeof item["prices"] !== "undefined")
                temp += item["prices"] + ' BYN<br>';
            if(typeof item["defaultCurrenty"] !== "undefined" && typeof item["defaultRate"] !== "undefined") {
                temp += '<span style="color: #EB5019; font-weight:normal; font-size:12px;">' + item["defaultCurrenty"] + ' ' + item["defaultRate"] + '</span>';
            }
            temp += '</div>';
        }
        return temp;
    },
    getPriceNew: function (item) {

        temp = '';
        if(typeof item["prices"] !== "undefined") {
            temp += '<div class="price" style="line-height:16px; border:1px solid;margin-bottom: 8px;">';
            if(typeof item["prices"] !== "undefined")
                temp += item["prices"] + ' ' + current_currency['iso'] + '<br>';
            temp += '</div>';
        }
        return temp;
    },

    /**
     * get booking tour
     */
    getBooking: function (item) {

        temp = '';
        if(typeof item["priceKey"] !== "undefined") {
            temp += '<form action="' + window.location.pathname + '" method="post">';
                temp += bx_session_input;
                temp += '<input type="hidden" name="TOUR[priceKey]" value="'+ item["priceKey"]+'">';
                temp += '<button type="submit" name="baction" value="add2cart" class="btn btn-primary btn-sm">Бронировать</button>';
            temp += '</form>';
        }
        if(typeof item["requestId"] !== "undefined" && typeof item["sourceId"] !== "undefined" && typeof item["offerId"] !== "undefined") {
            temp += '<form action="' + window.location.pathname + '" method="post">';
                temp += bx_session_input;
                temp += '<input type="hidden" name="TOUR[requestId]" value="'+ item["requestId"]+'">';
                temp += '<input type="hidden" name="TOUR[sourceId]" value="'+ item["sourceId"]+'">';
                temp += '<input type="hidden" name="TOUR[offerId]" value="'+ item["offerId"]+'">';
                temp += '<button type="submit" name="baction" value="add2cart" class="btn btn-primary btn-sm">Бронировать</button>';
            temp += '</form>';
        }
        return temp;
    },

    /**
     * get order form tour
     */
    getOrderForm: function (item) {

        //console.log(item);

        var order_info = '', tickethotel_ = '', ticketsdpt_ = '', ticketsrtn_ = '', night_ = '';

        if (typeof item["date"] !== "undefined") {
            order_info += 'Дата вылета: ' + item["date"] + '; ';
        }

        if(typeof item["property_tour"] !== "undefined" && typeof item["property_tour"]["days"] !== "undefined") {
            night_ = 'Продолжительность: ' + item["property_tour"]["days"] + '; ';
        }
        else{
            if(typeof item["property"]["night"] !== "undefined"){
                night_ ='Продолжительность: ' + Utilites.getNightText(item["property"]["night"],1) + ' ' + Utilites.getNightText(item["property"]["night"],2) + '; ';
            }
        }
        order_info += night_;

        if(typeof item["property"]["country"] !== "undefined" || typeof item["property"]["city"] !== "undefined") {
            order_info += 'Страна/Курорт: ' + item["property"]["country"] + " " + item["property"]["city"] + "; ";
        }

        if(typeof item["property_tour"] !== "undefined") {

            if(typeof item["property_tour"]["city"] !== "undefined") {
                window.Utilites.cityPrinted = true;
            }
            if(typeof item["property_tour"]["point"] !== "undefined") {
                order_info += 'Выезд: ' + item["property_tour"]["point"] + "; ";
            }
            if(typeof item["property"]["accm"] !== "undefined") {
                order_info += 'Размещение ';
                if(typeof item["property_hotel"] === "undefined" && typeof item["hotel"] !== "undefined"){
                    order_info += item["hotel"] + ', ';
                }
                order_info += item["property"]["accm"];
                if(typeof item["property"]["roomType"] !== "undefined" || typeof item["property"]["roomCat"] !== "undefined" && item["property"]["roomCat"] !== "Not defined") {
                    order_info += ', ';
                    if (typeof item["property"]["roomType"] !== "undefined") {
                        order_info += item["property"]["roomType"] + '; ';
                        window.Utilites.roomtypePrinted = true;
                    }
                    if (typeof item["property"]["roomCat"] !== "undefined" && item["property"]["roomCat"] !== "Not defined") {
                        order_info += ', ' + item["property"]["roomCat"] + '; ';
                        window.Utilites.roomcatPrinted = true;
                    }
                }
                window.Utilites.accmPrinted = true;
            }
            if(typeof item["property_tour"]["food"] !== "undefined" && item["property_tour"]["food"] != null) {
                order_info += 'Питание ' + item["property_tour"]["food"] + '; ';
                window.Utilites.foodPrinted = true;
            }
            else{
                if(typeof item["property"]["meal"] !== "undefined" && item["property"]["meal"] != null) {
                    order_info += 'Питание ' + item["property"]["meal"] + '; ';
                    window.Utilites.foodPrinted = true;
                }
            }

        }

        if(typeof item["property"]["hotelisinstop"] !== "undefined" && item["property"]["hotelisinstop"] != "Unknown"){
            tickethotel_ = 'наличие мест в отеле: ' + Utilites.getTicketHotel(item["property"]["hotelisinstop"]) + '; ';
        }

        if(typeof item["property"]["economticketsdpt"] !== "undefined" && item["property"]["economticketsdpt"] != "Unknown"){
            if (item["property"]["economticketsdpt"] == "Available" || item["property"]["economticketsdpt"] == "Request")
                ticketsdpt_ += 'Эконом (' + Utilites.getTicket(item["property"]["economticketsdpt"]) + '); ';
            else if(typeof item["property"]["businessticketsdpt"] !== "undefined" && item["property"]["businessticketsdpt"] != "Unknown"){
                ticketsdpt_ += 'Бизнес (' + Utilites.getTicket(item["property"]["businessticketsdpt"]) + '); ';
            }
        }
        else if(typeof item["property"]["businessticketsdpt"] !== "undefined" && item["property"]["businessticketsdpt"] != "Unknown"){
            ticketsdpt_ += 'Бизнес (' + Utilites.getTicket(item["property"]["businessticketsdpt"]) + '); ';
        }


        if(typeof item["property"]["economticketsrtn"] !== "undefined" && item["property"]["economticketsrtn"] != "Unknown"){
            if (item["property"]["economticketsrtn"] == "Available" || item["property"]["economticketsrtn"] == "Request")
                ticketsrtn_ += 'Эконом (' + Utilites.getTicket(item["property"]["economticketsrtn"]) + '); ';
            else if(typeof item["property"]["businessticketsrtn"] !== "undefined" && item["property"]["businessticketsrtn"] != "Unknown"){
                ticketsrtn_ += 'Бизнес (' + Utilites.getTicket(item["property"]["businessticketsrtn"]) + '); ';
            }
        }
        else if(typeof item["property"]["businessticketsrtn"] !== "undefined" && item["property"]["businessticketsrtn"] != "Unknown"){
            ticketsrtn_ += 'Бизнес (' + Utilites.getTicket(item["property"]["businessticketsrtn"]) + '); ';
        }


        if(typeof item["property_hotel"] !== "undefined") {

            if(typeof item["property_hotel"]["typehotel"] !== "undefined") {
                order_info += item["property_hotel"]["typehotel"] + '; ';
            }

        }
        if(window.Utilites.accmPrinted === false || window.Utilites.roomtypePrinted === false || window.Utilites.roomcatPrinted === false){
            if(typeof item["property"]["accm"] !== "undefined" || typeof item["property"]["roomCat"] !== "undefined"  || typeof item["property"]["roomType"] !== "undefined") {
                order_info += 'Размещение ';
                if(typeof item["property"]["accm"] !== "undefined" && window.Utilites.accmPrinted === false)
                    order_info += item["property"]["accm"] + ', ';
                if(typeof item["property"]["roomType"] !== "undefined" && window.Utilites.roomtypePrinted === false)
                    order_info += item["property"]["roomType"];
                if(typeof item["property"]["roomCat"] !== "undefined" && item["property"]["roomCat"] !== "Not defined" &&  window.Utilites.roomcatPrinted === false)
                    order_info += ', ' + item["property"]["roomCat"] + '; ';
                if(tickethotel_ != '')
                    order_info += ', ' + tickethotel_ + '; ';
            }
        }
        if(typeof item["property"]["meal"] !== "undefined" && item["property"]["meal"] !== null && window.Utilites.foodPrinted === false) {
            order_info += 'Питание ' + item["property"]["meal"] + '; ';
        }
        if(ticketsdpt_ != '' || ticketsrtn_ != '') {
            if (ticketsdpt_ != '')
                order_info += 'Туда: ' + ticketsdpt_;
            if (ticketsrtn_ != '')
                order_info += 'Обратно: ' + ticketsrtn_;
        }

        if(typeof item["prices"] !== "undefined") {
            order_info += 'Стоимость тура: ' + item["prices"] + ' ' + current_currency['iso'] + ';';
        }

        temp = '';
        temp += '<div class="block-order-form"><a data-name="'+ item["name"] +'" data-info="' + order_info + '" href="#orderModalNew" data-toggle="modal" class="order-btn order-link">Оставить заявку</a></div>';
        return temp;

    },

    /**
     * get read more
     */
    getReadMore: function (item) {

        if(typeof item["detail"] !== "undefined") {
            return '<a href="' + item["detail"] + '" class="btn btn-primary btn-sm">Подробнее</a>';
        }
        else return '';
    },

    /**
     * get property tour
     */
    getTourProp: function (item) {

        temp = '';

        if(typeof item["property_tour"] !== "undefined") {

            if(typeof item["property_tour"]["city"] !== "undefined") {
                temp += '<li><span class="icon"><i class="fa fa-map-marker"></i></span><span class="font600">' + item["property_tour"]["city"] + '</span></li>';
                window.Utilites.cityPrinted = true;
            }
            if(typeof item["property_tour"]["point"] !== "undefined") {
                temp += '<li><span class="icon"><i class="fa fa-flag"></i></span><span class="font600"> Выезд: ' + item["property_tour"]["point"] + '</span></li>';
            }
            if(typeof item["property"]["accm"] !== "undefined") {
                temp += '<li><span class="icon"><i class="fa fa-home"></i></span><span class="font600"> Размещение ';
                if(typeof item["property_hotel"] === "undefined" && typeof item["hotel"] !== "undefined"){
                    temp += item["hotel"] + ', ';
                }
                temp += item["property"]["accm"];
                if(typeof item["property"]["roomType"] !== "undefined" || typeof item["property"]["roomCat"] !== "undefined" && item["property"]["roomCat"] !== "Not defined") {
                    temp += ', ';
                    if (typeof item["property"]["roomType"] !== "undefined") {
                        temp += item["property"]["roomType"];
                        window.Utilites.roomtypePrinted = true;
                    }
                    if (typeof item["property"]["roomCat"] !== "undefined" && item["property"]["roomCat"] !== "Not defined") {
                        temp += ', ' + item["property"]["roomCat"];
                        window.Utilites.roomcatPrinted = true;
                    }
                }
                temp += '</span></li>';
                window.Utilites.accmPrinted = true;
            }
            if(typeof item["property_tour"]["food"] !== "undefined" && item["property_tour"]["food"] != null) {
                temp += '<li><span class="icon"><i class="fa fa-cutlery"></i></span><span class="font600"> Питание ' + item["property_tour"]["food"] + '</span></li>';
                window.Utilites.foodPrinted = true;
            }
            else{
                if(typeof item["property"]["meal"] !== "undefined" && item["property"]["meal"] != null) {
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
     * get property hotel
     */
    getHotelProp: function (item) {

        temp = '', ticket = '', tickethotel = '', ticketsdpt = '', ticketsrtn = '';

        /*if(typeof item["property"]["ticket"] !== "undefined" && item["property"]["ticket"] != "Unknown"){
            if (item["property"]["ticket"] == "NotIncluded")
                ticket = "(авиаперелёт не включён в стоимость тура)";
            if (item["property"]["ticket"] == "Included")
                ticket = "(авиаперелёт включён в стоимость тура)";
        }*/

        if(typeof item["property"]["hotelisinstop"] !== "undefined" && item["property"]["hotelisinstop"] != "Unknown"){
            tickethotel = 'наличие мест в отеле: <span class="font600">' + Utilites.getTicketHotel(item["property"]["hotelisinstop"]) + '</span>';
        }

        if(typeof item["property"]["economticketsdpt"] !== "undefined" && item["property"]["economticketsdpt"] != "Unknown"){
            if (item["property"]["economticketsdpt"] == "Available" || item["property"]["economticketsdpt"] == "Request")
                ticketsdpt += 'Эконом (' + Utilites.getTicket(item["property"]["economticketsdpt"]) + '); ';
            else if(typeof item["property"]["businessticketsdpt"] !== "undefined" && item["property"]["businessticketsdpt"] != "Unknown"){
                ticketsdpt += 'Бизнес (' + Utilites.getTicket(item["property"]["businessticketsdpt"]) + '); ';
            }
        }
        else if(typeof item["property"]["businessticketsdpt"] !== "undefined" && item["property"]["businessticketsdpt"] != "Unknown"){
            ticketsdpt += 'Бизнес (' + Utilites.getTicket(item["property"]["businessticketsdpt"]) + '); ';
        }


        if(typeof item["property"]["economticketsrtn"] !== "undefined" && item["property"]["economticketsrtn"] != "Unknown"){
            if (item["property"]["economticketsrtn"] == "Available" || item["property"]["economticketsrtn"] == "Request")
                ticketsrtn += 'Эконом (' + Utilites.getTicket(item["property"]["economticketsrtn"]) + '); ';
            else if(typeof item["property"]["businessticketsrtn"] !== "undefined" && item["property"]["businessticketsrtn"] != "Unknown"){
                ticketsrtn += 'Бизнес (' + Utilites.getTicket(item["property"]["businessticketsrtn"]) + '); ';
            }
        }
        else if(typeof item["property"]["businessticketsrtn"] !== "undefined" && item["property"]["businessticketsrtn"] != "Unknown"){
            ticketsrtn += 'Бизнес (' + Utilites.getTicket(item["property"]["businessticketsrtn"]) + '); ';
        }


        if(typeof item["property_hotel"] !== "undefined") {

            if(typeof item["property_hotel"]["city"] !== "undefined") {
                temp += '<li><span class="icon"><i class="fa fa-map-marker"></i></span><span class="font600">' + item["property_hotel"]["city"] + '</span></li>';
            }
            if(typeof item["property_hotel"]["typehotel"] !== "undefined") {
                temp += '<li><span class="icon"><i class="fa fa-flag"></i></span><span class="font600">' + item["property_hotel"]["typehotel"] + '</span></li>';
            }

        } else if(typeof item["property"]["city"] !== "undefined" && window.Utilites.cityPrinted === false) {
            temp += '<li><span class="icon"><i class="fa fa-map-marker"></i></span><span class="font600">' + item["property"]["city"] + '</span> ' + ticket + '</li>';
        }
        if(window.Utilites.accmPrinted === false || window.Utilites.roomtypePrinted === false || window.Utilites.roomcatPrinted === false){
            if(typeof item["property"]["accm"] !== "undefined" || typeof item["property"]["roomCat"] !== "undefined"  || typeof item["property"]["roomType"] !== "undefined") {
                temp += '<li><span class="icon"><i class="fa fa-home"></i></span><span class="font600">Размещение ';
                if(typeof item["property"]["accm"] !== "undefined" && window.Utilites.accmPrinted === false)
                    temp += item["property"]["accm"] + ', ';
                if(typeof item["property"]["roomType"] !== "undefined" && window.Utilites.roomtypePrinted === false)
                    temp += item["property"]["roomType"];
                if(typeof item["property"]["roomCat"] !== "undefined" && item["property"]["roomCat"] !== "Not defined" &&  window.Utilites.roomcatPrinted === false)
                    temp += ', ' + item["property"]["roomCat"];
                temp += '</span>';
                if(tickethotel != '')
                    temp += ', ' + tickethotel;
                temp += '</li>';
            }
        }
        if(typeof item["property"]["meal"] !== "undefined" && item["property"]["meal"] !== null && window.Utilites.foodPrinted === false) {
            temp += '<li><span class="icon"><i class="fa fa-cutlery"></i></span><span class="font600"> Питание ' + item["property"]["meal"] + '</span></li>';
        }
        if(ticketsdpt != '' || ticketsrtn != '') {
            temp += '<li><span class="icon"><i class="fa fa-plane"></i></span>';
            if (ticketsdpt != '')
                temp += '<span class="font600">Туда: </span>' + ticketsdpt;
            if (ticketsrtn != '')
                temp += '<span class="font600">Обратно: </span>' + ticketsrtn;
            temp += '</li>';
        }
        return temp;

    },

	/**
	* get html item
	*/

	getHtmlItems: function (items) {

	    //console.log(items);

        if (items.length > 0) {

            var i, cnt = items.length, templ = '', night = '';

            for (i = 0; i < cnt; i++){

                templ += '<div class="package-list-item clearfix">';
                    templ += '<div class="image">';

                        templ += Utilites.getDetail(items[i]);
                        templ += Utilites.getNight(items[i]);


                    templ += '</div>';

                    templ +='<div class="content">';

                        templ += Utilites.getName(items[i]);

                        templ += '<div class="row gap-10">';
                            templ += '<div class="col-sm-12 col-md-9">';

                                templ += Utilites.getTypeTour(items[i]);

                                templ += '<ul class="list-info">';
                                    templ += Utilites.getTourProp(items[i]);
                                    templ += Utilites.getHotelProp(items[i]);
                                templ += '</ul>';

                            templ += '</div>';
                            templ += '<div class="col-sm-12 col-md-3 text-right text-left-sm">';
                                templ += '<center>';
                                    templ += Utilites.getDate(items[i]);
                                    templ += Utilites.getPriceNew(items[i]);
                                    //templ += Utilites.getPrice(items[i]);
                                    //if(is_admin) {
                                        templ += Utilites.getOrderForm(items[i]);
                                    //}
                                    templ += Utilites.getBooking(items[i]);
                                    //templ += Utilites.getReadMore(items[i]);
                                templ += '</center>';
                            templ += '</div>';
                        templ += '</div>';

                    templ += '</div>';

                templ += '</div>';

            }

            return templ;
        }

	},

	getHtmlFilter: function (params) {

	    var html = '', tmp_param, tmp_html; HTML = {
            cityFrom: "",
            country: "",
            cities: "",
            tourTypes: "",
            tours: "",
            hotels: "",
            stars: "",
            meals: "",
            date: "",
            nights: "",
            adults: "",
            childs: "",
            age1: "",
            age2: "",
            age3: "",
            submit: ""
        };

        for (property in params) {

            tmp_param = params[property];
            tmp_html = "";

            if (property == "cityFrom") {

                tmp_html += '<div class="sidebar-module">';
                    tmp_html += '<h6 class="sidebar-title">Откуда</h6>';

                    tmp_html += '<div class="sidebar-module-inner">';
                        tmp_html += '<select name="' + property + '" class="select2-multi form-control" data-placeholder="Выберите" tabindex="-1" aria-hidden="true">';
                            tmp_html += '<option value=""></option>';
                            for (Arr_cityFrom in tmp_param) {
                                tmp_html += '<option ' + (Number(tmp_param[Arr_cityFrom].ID) == params.default.cityFrom ? 'selected="selected" ' : '') + 'value="' + Arr_cityFrom + '">' + tmp_param[Arr_cityFrom].NAME + '</option>'
                            }
                        tmp_html += '</select>';
                    tmp_html += '</div>';

                tmp_html += '</div>';

            } else if (property == "country"){

                tmp_html += '<div class="sidebar-module">';
                    tmp_html += '<h6 class="sidebar-title">Куда</h6>';

                    tmp_html += '<div class="sidebar-module-inner">';
                        tmp_html += '<select name="' + property + '" class="select2-multi form-control" data-placeholder="Выберите" tabindex="-1" aria-hidden="true">';
                            tmp_html += '<option value=""></option>';
                            for(Arr_country in tmp_param){
                                tmp_html += '<option ' + (Number(tmp_param[Arr_country].ID) == params.default.country ? 'selected="selected" ' : '') + 'value="' + Arr_country + '">' + tmp_param[Arr_country].NAME + '</option>'
                            }
                        tmp_html += '</select>';
                    tmp_html += '</div>';

                tmp_html += '</div>';

            } else if (property == "cities") {

                cnt = tmp_param.length;

                tmp_html += '<div class="sidebar-module">';
                    tmp_html += '<h6 class="sidebar-title">Курорт</h6>';

                    tmp_html += '<div class="sidebar-module-inner">';
                        tmp_html += '<select name="' + property + '[]" class="select2-multi form-control" data-placeholder="Выберите" tabindex="-1" aria-hidden="true" multiple="multiple">';
                            tmp_html += '<option value="">Любой</option>';
                            for (var i = 0; i < cnt; i++){
                                tmp_html += '<option ' + ($.inArray(tmp_param[i].id, params.default.cities) !== -1 ? 'selected ' : '') + 'value="' + tmp_param[i]["id"] + '">' + tmp_param[i]["name"] + '</option>'
                            }
                        tmp_html += '</select>';
                    tmp_html += '</div>';

                tmp_html += '</div>';

            } /*else if (property == "tourTypes") {

                cnt = tmp_param.length;

                tmp_html += '<div class="sidebar-module">';
                    tmp_html += '<h6 class="sidebar-title">Тип тура</h6>';

                    tmp_html += '<div class="sidebar-module-inner">';
                        tmp_html += '<select name="' + property + '[]" class="select2-multi form-control" data-placeholder="Выберите" tabindex="-1" aria-hidden="true" multiple>';
                            tmp_html += '<option value="">Любой</option>';
                            for (var i = 0; i < cnt; i++){
                                tmp_html += '<option ' + ($.inArray(tmp_param[i].id, params.default.tourTypes) !== -1 ? 'selected ' : '') + 'value="' + tmp_param[i]["id"] + '">' + tmp_param[i]["name"] + '</option>'
                            }
                        tmp_html += '</select>';
                    tmp_html += '</div>';

                tmp_html += '</div>';

            }*/ /*else if (property == "tours") {

                cnt = tmp_param.length;

                tmp_html += '<div class="sidebar-module">';
                    tmp_html += '<h6 class="sidebar-title">Туры</h6>';

                    tmp_html += '<div class="sidebar-module-inner">';
                        tmp_html += '<select name="' + property + '[]" class="select2-multi form-control" data-placeholder="Выберите" tabindex="-1" aria-hidden="true" multiple>';
                            tmp_html += '<option value="">Любой</option>';
                            for (var i = 0; i < cnt; i++){
                                tmp_html += '<option ' + ($.inArray(tmp_param[i].id, params.default.tours) !== -1 ? 'selected ' : '') + 'value="' + tmp_param[i]["id"] + '">' + tmp_param[i]["name"] + '</option>'
                            }
                        tmp_html += '</select>';
                    tmp_html += '</div>';

                tmp_html += '</div>';

            }*/ else if (property == "hotels") {

                cnt = tmp_param.length;

                tmp_html += '<div class="sidebar-module">';
                    tmp_html += '<h6 class="sidebar-title">Отели</h6>';

                    tmp_html += '<div class="sidebar-module-inner">';
                        tmp_html += '<select name="' + property + '[]" class="select2-multi form-control" data-placeholder="Выберите" tabindex="-1" aria-hidden="true" multiple>';
                            tmp_html += '<option value="">Любой</option>';
                            for (var i = 0; i < cnt; i++){
                                tmp_html += '<option ' + ($.inArray(tmp_param[i].id, params.default.hotels) !== -1 ? 'selected ' : '') + 'value="' + tmp_param[i]["id"] + '">' + tmp_param[i]["name"] + ' ' + tmp_param[i]["star"] + '</option>'
                            }
                        tmp_html += '</select>';
                    tmp_html += '</div>';

                tmp_html += '</div>';

            } else if (property == "stars") {

                cnt = tmp_param.length;

                tmp_html += '<div class="sidebar-module">';
                    tmp_html += '<h6 class="sidebar-title">Категория отеля</h6>';

                    tmp_html += '<div class="sidebar-module-inner">';
                        tmp_html += '<div class="checkbox-block">';
                            for (var i = 0; i < cnt; i++){
                                tmp_html += '<input name="' + property + '[]" id="' + property + '_' + tmp_param[i] + '" type="checkbox" ' + ($.inArray(tmp_param[i], params.default.stars) !== -1 ? 'checked ' : '') + 'class="checkbox" value="' + tmp_param[i] + '"/>';
                                tmp_html += '<label for="' + property + '_' + tmp_param[i] + '">' + tmp_param[i] + '</label>';
                            }
                        tmp_html += '</div>';
                    tmp_html += '</div>';

                tmp_html += '</div>';

            } else if (property == "meals") {

                cnt = tmp_param.length;

                tmp_html += '<div class="sidebar-module">';
                    tmp_html += '<h6 class="sidebar-title">Питание</h6>';

                    tmp_html += '<div class="sidebar-module-inner">';
                        tmp_html += '<div class="checkbox-block">';
                            for (var i = 0; i < cnt; i++){
                                tmp_html += '<input name="' + property + '[]" id="' + tmp_param[i].id + '" type="checkbox" ' + ($.inArray(tmp_param[i].id, params.default.meals) !== -1 ? 'checked ' : '') + 'class="checkbox" value="' + tmp_param[i]["id"] + '"/>';
                                tmp_html += '<label for="' + tmp_param[i].id + '">' + tmp_param[i]["name"] + '</label>';
                            }
                        tmp_html += '</div>';
                    tmp_html += '</div>';

                tmp_html += '</div>';

            } else if (property == "default") {

                //вывод даты
                now = new Date();
                var today = new Date(now.getFullYear(), now.getMonth(), now.getDate());
                dateFormat = /^\d{2}\.\d{2}\.\d{4}$/;
                HTML["date"] += '<div class="sidebar-module">';
                    HTML["date"] += '<h6 class="sidebar-title">Дата начала вылета</h6>';

                    HTML["date"] += '<div class="sidebar-module-inner">';
                        HTML["date"] += '<i class="calendar-icon filter-calendar-icon filter-calendar-icon date-filter-from"></i>';
                        HTML["date"] += '<input class="form-control" id="date-filter-from" value="' + (params.default.date[0] !== "undefined" && dateFormat.test(params.default.date[0]) ? params.default.date[0] : today) + '" name="CheckIn">';
                    HTML["date"] += '</div>';

                HTML["date"] += '</div>';
                HTML["date"] += '<div class="clear"></div>';
                HTML["date"] += '<div class="sidebar-module">';
                    HTML["date"] += '<h6 class="sidebar-title">Дата окончания вылета</h6>';

                    HTML["date"] += '<div class="sidebar-module-inner">';
                        HTML["date"] += '<i class="calendar-icon filter-calendar-icon filter-calendar-icon date-filter-to"></i>';
                        HTML["date"] += '<input class="form-control" id="date-filter-to" value="' + (params.default.date[1] !== "undefined" && dateFormat.test(params.default.date[1]) ? params.default.date[1] : today) + '" name="CheckOut">';
                    HTML["date"] += '</div>';

                HTML["date"] += '</div>';

                //вывод ночей
                HTML["nights"] += '<div class="sidebar-module">';
                    HTML["nights"] += '<h6 class="sidebar-title">Продолжительность ночей</h6>';

                    HTML["nights"] += '<div class="sidebar-module-inner">';
                        HTML["nights"] += '<input data-from="' + (typeof params.default.nights[0] !== 'undefined' || typeof params.default.nights[0] !== 'number' || params.default.nights[0] < 1 ? params.default.nights[0] : 7) + '" data-to="' + (typeof params.default.nights[1] !== 'undefined' || typeof params.default.nights[1] !== 'number' || params.default.nights[1] < 1 ? params.default.nights[1] : 14) + '" data-min="1" data-max="14" id="duration_range" />';
                        HTML["nights"] += '<input id="min-filter-duration" name="NightIn" type="hidden" value="' + (typeof params.default.nights[0] !== 'undefined' || typeof params.default.nights[0] !== 'number' || params.default.nights[0] < 1 ? params.default.nights[0] : 7) + '">';
                        HTML["nights"] += '<input id="max-filter-duration" name="NightOut" type="hidden" value="' + (typeof params.default.nights[1] !== 'undefined' || typeof params.default.nights[1] !== 'number' || params.default.nights[1] < 1 ? params.default.nights[1] : 14) + '">';
                    HTML["nights"] += '</div>';

                HTML["nights"] += '</div>';

                //вывод кол-ва взрослых
                HTML["adults"] += '<div class="sidebar-module">';
                    HTML["adults"] += '<h6 class="sidebar-title">Взрослых</h6>';

                    HTML["adults"] += '<div class="sidebar-module-inner">';
                        HTML["adults"] += '<select name="Adults" class="select2-multi form-control" data-placeholder="Выберите" tabindex="-1" aria-hidden="true">';
                            for (var i = 1; i <= 6; i++){
                                HTML["adults"] += '<option ' + (i === params.default.adults ? 'selected ' : '') + 'value="' + i + '">' + i + '</option>'
                            }
                        HTML["adults"] += '</select>';
                    HTML["adults"] += '</div>';

                HTML["adults"] += '</div>';

                //вывод кол-ва детей
                HTML["childs"] += '<div class="sidebar-module">';
                    HTML["childs"] += '<h6 class="sidebar-title">Детей</h6>';

                    HTML["childs"] += '<div class="sidebar-module-inner">';
                        HTML["childs"] += '<select name="Children" class="select2-multi form-control" data-placeholder="Выберите" tabindex="-1" aria-hidden="true">';
                            for (var i = 0; i <= 3; i++){
                                HTML["childs"] += '<option ' + (i === params.default.childs ? 'selected ' : '') + 'value="' + i + '">' + i + '</option>'
                            }
                        HTML["childs"] += '</select>';
                    HTML["childs"] += '</div>';

                HTML["childs"] += '</div>';

                //вывод возраста детей
                if((params.default.age1 != "" && typeof params.default.age1 !== "undefined") || params.default.childs > 0){

                    HTML["age1"] += '<div class="sidebar-module">';
                        HTML["age1"] += '<h6 class="sidebar-title">Возраст ребенка (1)</h6>';

                        HTML["age1"] += '<div class="sidebar-module-inner">';
                            HTML["age1"] += '<select name="age1" class="select2-multi form-control" data-placeholder="Выберите" tabindex="-1" aria-hidden="true">';
                                for (var i = 0; i < 18; i++){
                                    HTML["age1"] += '<option ' + (i === params.default.age1 ? 'selected ' : '') + 'value="' + i + '">' + i + '</option>'
                                }
                            HTML["age1"] += '</select>';
                        HTML["age1"] += '</div>';

                    HTML["age1"] += '</div>';

                }
                if((params.default.age2 != "" && typeof params.default.age2 !== "undefined") || params.default.childs > 1){

                    HTML["age2"] += '<div class="sidebar-module">';
                        HTML["age2"] += '<h6 class="sidebar-title">Возраст ребенка (2)</h6>';

                        HTML["age2"] += '<div class="sidebar-module-inner">';
                            HTML["age2"] += '<select name="age2" class="select2-multi form-control" data-placeholder="Выберите" tabindex="-1" aria-hidden="true">';
                                for (var i = 0; i < 18; i++){
                                    HTML["age2"] += '<option ' + (i === params.default.age2 ? 'selected ' : '') + 'value="' + i + '">' + i + '</option>'
                                }
                            HTML["age2"] += '</select>';
                        HTML["age2"] += '</div>';

                    HTML["age2"] += '</div>';

                }
                if((params.default.age3 != "" && typeof params.default.age3 !== "undefined") || params.default.childs > 2){

                    HTML["age3"] += '<div class="sidebar-module">';
                        HTML["age3"] += '<h6 class="sidebar-title">Возраст ребенка (3)</h6>';

                        HTML["age3"] += '<div class="sidebar-module-inner">';
                            HTML["age3"] += '<select name="age3" class="select2-multi form-control" data-placeholder="Выберите" tabindex="-1" aria-hidden="true">';
                                for (var i = 0; i < 18; i++){
                                    HTML["age3"] += '<option ' + (i === params.default.age3 ? 'selected ' : '') + 'value="' + i + '">' + i + '</option>'
                                }
                            HTML["age3"] += '</select>';
                        HTML["age3"] += '</div>';

                    HTML["age3"] += '</div>';

                }

            }


            HTML[property] = tmp_html;

        }

        if(typeof params !== "undefined") {

            HTML["submit"] = '<div class="sidebar-module" style="text-align: center;"><a class="btn btn-primary btn-sm submit-filter">Подобрать</a></div>';
        }

        return '<form id="filterForm" class="filter-form">' + HTML["cityFrom"] + HTML["country"] + HTML["cities"] + HTML["tourTypes"] + HTML["tours"] + HTML["hotels"] + HTML["stars"] + HTML["meals"] + HTML["date"] + HTML["nights"] + HTML["adults"] + HTML["childs"] + HTML["age1"] + HTML["age2"] + HTML["age3"] + HTML["submit"] + '</form>';

    },

    getHtmlFilterSletat: function (params) {
	    //console.log(params, 123);

        var html = '', tmp_param, tmp_html; HTML = {
            cityFrom: "",
            country: "",
            cities: "",
            hotels: "",
            stars: "",
            meals: "",
            date: "",
            nights: "",
            adults: "",
            childs: "",
            age1: "",
            age2: "",
            age3: "",
            submit: ""
        };

        for (property in params) {

            tmp_param = params[property];
            tmp_html = "";

            if (property == "cityFrom") {

                tmp_html += '<div class="sidebar-module">';
                    tmp_html += '<h6 class="sidebar-title">Откуда</h6>';

                    tmp_html += '<div class="sidebar-module-inner">';
                        tmp_html += '<select name="' + property + '" class="select2-multi form-control" data-placeholder="Выберите" tabindex="-1" aria-hidden="true">';
                        tmp_html += '<option value=""></option>';
                        for (Arr_cityFrom in tmp_param) {
                            tmp_html += '<option ' + (Number(tmp_param[Arr_cityFrom].ID) == params.default.cityFromId ? 'selected="selected" ' : '') + 'value="' + Arr_cityFrom + '">' + tmp_param[Arr_cityFrom].NAME + '</option>'
                        }
                        tmp_html += '</select>';
                    tmp_html += '</div>';

                tmp_html += '</div>';

            } else if (property == "country"){

                tmp_html += '<div class="sidebar-module">';
                    tmp_html += '<h6 class="sidebar-title">Куда</h6>';

                    tmp_html += '<div class="sidebar-module-inner">';
                        tmp_html += '<select name="' + property + '" class="select2-multi form-control" data-placeholder="Выберите" tabindex="-1" aria-hidden="true">';
                            tmp_html += '<option value=""></option>';
                            for(Arr_country in tmp_param){
                                tmp_html += '<option ' + (Number(tmp_param[Arr_country].ID) == params.default.countryId ? 'selected="selected" ' : '') + 'value="' + Arr_country + '">' + tmp_param[Arr_country].NAME + '</option>'
                            }
                        tmp_html += '</select>';
                    tmp_html += '</div>';

                tmp_html += '</div>';

            } else if (property == "cities") {

                cnt = tmp_param.length;

                tmp_html += '<div class="sidebar-module">';
                    tmp_html += '<h6 class="sidebar-title">Курорт</h6>';

                    tmp_html += '<div class="sidebar-module-inner">';
                        tmp_html += '<select name="' + property + '[]" class="select2-multi form-control" data-placeholder="Выберите" tabindex="-1" aria-hidden="true" multiple="multiple">';
                            tmp_html += '<option value="">Любой</option>';
                            for (var i = 0; i < cnt; i++){
                                tmp_html += '<option ' + ($.inArray(tmp_param[i].Id, params.default.cities) !== -1 ? 'selected ' : '') + 'value="' + tmp_param[i]["Id"] + '">' + tmp_param[i]["Name"] + '</option>'
                            }
                        tmp_html += '</select>';
                    tmp_html += '</div>';

                tmp_html += '</div>';

            } else if (property == "hotels") {

                cnt = tmp_param.length;

                tmp_html += '<div class="sidebar-module">';
                    tmp_html += '<h6 class="sidebar-title">Отели</h6>';

                    tmp_html += '<div class="sidebar-module-inner">';
                        tmp_html += '<select name="' + property + '[]" class="select2-multi form-control" data-placeholder="Выберите" tabindex="-1" aria-hidden="true" multiple>';
                            tmp_html += '<option value="">Любой</option>';
                            for (var i = 0; i < cnt; i++){
                                tmp_html += '<option ' + ($.inArray(tmp_param[i].Id, params.default.hotels) !== -1 ? 'selected ' : '') + 'value="' + tmp_param[i]["Id"] + '">' + tmp_param[i]["Name"] + ' ' + tmp_param[i]["StarName"] + '</option>'
                            }
                        tmp_html += '</select>';
                    tmp_html += '</div>';

                tmp_html += '</div>';

            } else if (property == "stars") {

                cnt = tmp_param.length;

                tmp_html += '<div class="sidebar-module">';
                    tmp_html += '<h6 class="sidebar-title">Категория отеля</h6>';

                    tmp_html += '<div class="sidebar-module-inner">';
                        tmp_html += '<div class="checkbox-block">';
                            for (var i = 0; i < cnt; i++){
                                tmp_html += '<input name="' + property + '[]" id="' + property + '_' + tmp_param[i].Id + '" type="checkbox" ' + ($.inArray(tmp_param[i].Id, params.default.stars) !== -1 ? 'checked ' : '') + 'class="checkbox" value="' + tmp_param[i]["Id"] + '"/>';
                                tmp_html += '<label for="' + property + '_' + tmp_param[i].Id + '">' + tmp_param[i]["Name"] + '</label>';
                            }
                        tmp_html += '</div>';
                    tmp_html += '</div>';

                tmp_html += '</div>';

            } else if (property == "meals") {

                cnt = tmp_param.length;

                tmp_html += '<div class="sidebar-module">';
                    tmp_html += '<h6 class="sidebar-title">Питание</h6>';

                    tmp_html += '<div class="sidebar-module-inner">';
                        tmp_html += '<div class="checkbox-block">';
                            for (var i = 0; i < cnt; i++){
                                tmp_html += '<input name="' + property + '[]" id="' + tmp_param[i].Id + '" type="checkbox" ' + ($.inArray(tmp_param[i].Id, params.default.meals) !== -1 ? 'checked ' : '') + 'class="checkbox" value="' + tmp_param[i]["Id"] + '"/>';
                                tmp_html += '<label for="' + tmp_param[i].Id + '">' + tmp_param[i]["Name"] + '</label>';
                            }
                        tmp_html += '</div>';
                    tmp_html += '</div>';

                tmp_html += '</div>';

            } else if (property == "default") {

                //вывод даты
                now = new Date();
                var today = new Date(now.getFullYear(), now.getMonth(), now.getDate());
                dateFormat = /^\d{2}\.\d{2}\.\d{4}$/;
                HTML["date"] += '<div class="sidebar-module">';
                    HTML["date"] += '<h6 class="sidebar-title">Дата начала вылета</h6>';

                    HTML["date"] += '<div class="sidebar-module-inner">';
                        HTML["date"] += '<i class="calendar-icon filter-calendar-icon filter-calendar-icon date-filter-from"></i>';
                        HTML["date"] += '<input class="form-control" id="date-filter-from" value="' + (params.default.departFrom !== "undefined" && dateFormat.test(params.default.departFrom) ? params.default.departFrom : today) + '" name="CheckIn">';
                    HTML["date"] += '</div>';

                HTML["date"] += '</div>';
                HTML["date"] += '<div class="clear"></div>';
                HTML["date"] += '<div class="sidebar-module">';
                    HTML["date"] += '<h6 class="sidebar-title">Дата окончания вылета</h6>';

                    HTML["date"] += '<div class="sidebar-module-inner">';
                        HTML["date"] += '<i class="calendar-icon filter-calendar-icon filter-calendar-icon date-filter-to"></i>';
                        HTML["date"] += '<input class="form-control" id="date-filter-to" value="' + (params.default.departTo !== "undefined" && dateFormat.test(params.default.departTo) ? params.default.departTo : today) + '" name="CheckOut">';
                    HTML["date"] += '</div>';

                HTML["date"] += '</div>';

                        //вывод ночей
                HTML["nights"] += '<div class="sidebar-module">';
                    HTML["nights"] += '<h6 class="sidebar-title">Продолжительность ночей</h6>';

                    HTML["nights"] += '<div class="sidebar-module-inner">';
                        HTML["nights"] += '<input data-from="' + (typeof params.default.nightsMin !== 'undefined' || typeof params.default.nightsMin !== 'number' || params.default.nightsMin < 1 ? params.default.nightsMin : 7) + '" data-to="' + (typeof params.default.nightsMax !== 'undefined' || typeof params.default.nightsMax !== 'number' || params.default.nightsMax < 1 ? params.default.nightsMax : 14) + '" data-min="1" data-max="14" id="duration_range" />';
                        HTML["nights"] += '<input id="min-filter-duration" name="NightIn" type="hidden" value="' + (typeof params.default.nightsMin !== 'undefined' || typeof params.default.nightsMin !== 'number' || params.default.nightsMin < 1 ? params.default.nightsMin : 7) + '">';
                        HTML["nights"] += '<input id="max-filter-duration" name="NightOut" type="hidden" value="' + (typeof params.default.nightsMax !== 'undefined' || typeof params.default.nightsMax !== 'number' || params.default.nightsMax < 1 ? params.default.nightsMax : 14) + '">';
                    HTML["nights"] += '</div>';

                HTML["nights"] += '</div>';

                //вывод кол-ва взрослых
                HTML["adults"] += '<div class="sidebar-module">';
                    HTML["adults"] += '<h6 class="sidebar-title">Взрослых</h6>';

                    HTML["adults"] += '<div class="sidebar-module-inner">';
                        HTML["adults"] += '<select name="Adults" class="select2-multi form-control" data-placeholder="Выберите" tabindex="-1" aria-hidden="true">';
                            for (var i = 1; i <= 6; i++){
                                HTML["adults"] += '<option ' + (i === params.default.adults ? 'selected ' : '') + 'value="' + i + '">' + i + '</option>'
                            }
                        HTML["adults"] += '</select>';
                    HTML["adults"] += '</div>';

                HTML["adults"] += '</div>';

                //вывод кол-ва детей
                HTML["childs"] += '<div class="sidebar-module">';
                    HTML["childs"] += '<h6 class="sidebar-title">Детей</h6>';

                    HTML["childs"] += '<div class="sidebar-module-inner">';
                        HTML["childs"] += '<select name="Children" class="select2-multi form-control" data-placeholder="Выберите" tabindex="-1" aria-hidden="true">';
                            for (var i = 0; i <= 3; i++){
                                HTML["childs"] += '<option ' + (i === params.default.kids ? 'selected ' : '') + 'value="' + i + '">' + i + '</option>'
                            }
                        HTML["childs"] += '</select>';
                    HTML["childs"] += '</div>';

                HTML["childs"] += '</div>';

                //вывод возраста детей
                if((params.default.age1 != "" && typeof params.default.age1 !== "undefined") || params.default.kids > 0){

                    HTML["age1"] += '<div class="sidebar-module">';
                    HTML["age1"] += '<h6 class="sidebar-title">Возраст ребенка (1)</h6>';

                        HTML["age1"] += '<div class="sidebar-module-inner">';
                            HTML["age1"] += '<select name="age1" class="select2-multi form-control" data-placeholder="Выберите" tabindex="-1" aria-hidden="true">';
                                for (var i = 0; i < 18; i++){
                                    HTML["age1"] += '<option ' + (i === params.default.age1 ? 'selected ' : '') + 'value="' + i + '">' + i + '</option>'
                                }
                            HTML["age1"] += '</select>';
                        HTML["age1"] += '</div>';

                    HTML["age1"] += '</div>';

                }
                if((params.default.age2 != "" && typeof params.default.age2 !== "undefined") || params.default.kids == 2){

                    HTML["age2"] += '<div class="sidebar-module">';
                        HTML["age2"] += '<h6 class="sidebar-title">Возраст ребенка (2)</h6>';

                        HTML["age2"] += '<div class="sidebar-module-inner">';
                            HTML["age2"] += '<select name="age2" class="select2-multi form-control" data-placeholder="Выберите" tabindex="-1" aria-hidden="true">';
                                for (var i = 0; i < 18; i++){
                                    HTML["age2"] += '<option ' + (i === params.default.age2 ? 'selected ' : '') + 'value="' + i + '">' + i + '</option>'
                                }
                            HTML["age2"] += '</select>';
                        HTML["age2"] += '</div>';

                    HTML["age2"] += '</div>';

                }
                if((params.default.age3 != "" && typeof params.default.age3 !== "undefined") || params.default.kids > 2){

                    HTML["age3"] += '<div class="sidebar-module">';
                        HTML["age3"] += '<h6 class="sidebar-title">Возраст ребенка (3)</h6>';

                        HTML["age3"] += '<div class="sidebar-module-inner">';
                            HTML["age3"] += '<select name="age3" class="select2-multi form-control" data-placeholder="Выберите" tabindex="-1" aria-hidden="true">';
                                for (var i = 0; i < 18; i++){
                                    HTML["age3"] += '<option ' + (i === params.default.age3 ? 'selected ' : '') + 'value="' + i + '">' + i + '</option>'
                                }
                            HTML["age3"] += '</select>';
                        HTML["age3"] += '</div>';

                    HTML["age3"] += '</div>';

                }


            }


            HTML[property] = tmp_html;

        }

        if(typeof params !== "undefined") {

            HTML["submit"] = '<div class="sidebar-module" style="text-align: center;"><a class="btn btn-primary btn-sm submit-filter ">Подобрать</a></div>';
        }

        return '<form id="filterForm" class="filter-form">' + HTML["cityFrom"] + HTML["country"] + HTML["cities"] + HTML["hotels"] + HTML["stars"] + HTML["meals"] + HTML["date"] + HTML["nights"] + HTML["adults"] + HTML["childs"] + HTML["age1"] + HTML["age2"] + HTML["age3"] + HTML["submit"] + '</form>';

    },

    getHtmlBusFilter: function (params) {

        var html = '', tmp_param, tmp_html; HTML = {
            cityFrom: "",
            country: "",
            cities: "",
            tourTypes: "",
            tours: "",
            hotels: "",
            stars: "",
            meals: "",
            date: "",
            nights: "",
            adults: "",
            childs: "",
            submit: ""
        };

        for (property in params) {

            tmp_param = params[property];
            tmp_html = "";

            if (property == "cityFrom") {

                tmp_html += '<div class="sidebar-module">';
                    tmp_html += '<h6 class="sidebar-title">Откуда</h6>';

                    tmp_html += '<div class="sidebar-module-inner">';
                        tmp_html += '<select name="' + property + '" class="select2-multi form-control" data-placeholder="Выберите" tabindex="-1" aria-hidden="true">';
                            tmp_html += '<option value=""></option>';
                            for (Arr_cityFrom in tmp_param) {
                                tmp_html += '<option ' + (Number(tmp_param[Arr_cityFrom].ID) == params.default.cityFrom ? 'selected="selected" ' : '') + 'value="' + Arr_cityFrom + '">' + tmp_param[Arr_cityFrom].NAME + '</option>'
                            }
                        tmp_html += '</select>';
                    tmp_html += '</div>';

                tmp_html += '</div>';

            } else if (property == "country"){

                tmp_html += '<div class="sidebar-module">';
                    tmp_html += '<h6 class="sidebar-title">Куда</h6>';

                    tmp_html += '<div class="sidebar-module-inner">';
                        tmp_html += '<select name="' + property + '" class="select2-multi form-control" data-placeholder="Выберите" tabindex="-1" aria-hidden="true">';
                            tmp_html += '<option value=""></option>';
                            for(Arr_country in tmp_param){
                                tmp_html += '<option ' + (Number(tmp_param[Arr_country].ID) == params.default.country ? 'selected="selected" ' : '') + 'value="' + Arr_country + '">' + tmp_param[Arr_country].NAME + '</option>'
                            }
                        tmp_html += '</select>';
                    tmp_html += '</div>';

                tmp_html += '</div>';

            } /*else if (property == "cities") {

                cnt = tmp_param.length;

                tmp_html += '<div class="sidebar-module">';
                tmp_html += '<h6 class="sidebar-title">Курорт</h6>';

                tmp_html += '<div class="sidebar-module-inner">';
                tmp_html += '<select name="' + property + '[]" class="select2-multi form-control" data-placeholder="Выберите" tabindex="-1" aria-hidden="true" multiple="multiple">';
                tmp_html += '<option value="">Любой</option>';
                for (var i = 0; i < cnt; i++){
                    tmp_html += '<option ' + ($.inArray(tmp_param[i].id, params.default.cities) !== -1 ? 'selected ' : '') + 'value="' + tmp_param[i]["id"] + '">' + tmp_param[i]["name"] + '</option>'
                }
                tmp_html += '</select>';
                tmp_html += '</div>';

                tmp_html += '</div>';

            } else if (property == "tourTypes") {

             cnt = tmp_param.length;

             tmp_html += '<div class="sidebar-module">';
             tmp_html += '<h6 class="sidebar-title">Тип тура</h6>';

             tmp_html += '<div class="sidebar-module-inner">';
             tmp_html += '<select name="' + property + '[]" class="select2-multi form-control" data-placeholder="Выберите" tabindex="-1" aria-hidden="true" multiple>';
             tmp_html += '<option value="">Любой</option>';
             for (var i = 0; i < cnt; i++){
             tmp_html += '<option ' + ($.inArray(tmp_param[i].id, params.default.tourTypes) !== -1 ? 'selected ' : '') + 'value="' + tmp_param[i]["id"] + '">' + tmp_param[i]["name"] + '</option>'
             }
             tmp_html += '</select>';
             tmp_html += '</div>';

             tmp_html += '</div>';

             }*/ /*else if (property == "tours") {

             cnt = tmp_param.length;

             tmp_html += '<div class="sidebar-module">';
             tmp_html += '<h6 class="sidebar-title">Туры</h6>';

             tmp_html += '<div class="sidebar-module-inner">';
             tmp_html += '<select name="' + property + '[]" class="select2-multi form-control" data-placeholder="Выберите" tabindex="-1" aria-hidden="true" multiple>';
             tmp_html += '<option value="">Любой</option>';
             for (var i = 0; i < cnt; i++){
             tmp_html += '<option ' + ($.inArray(tmp_param[i].id, params.default.tours) !== -1 ? 'selected ' : '') + 'value="' + tmp_param[i]["id"] + '">' + tmp_param[i]["name"] + '</option>'
             }
             tmp_html += '</select>';
             tmp_html += '</div>';

             tmp_html += '</div>';

             }*/ else if (property == "hotels") {

                cnt = tmp_param.length;

                tmp_html += '<div class="sidebar-module">';
                    tmp_html += '<h6 class="sidebar-title">Отели</h6>';

                    tmp_html += '<div class="sidebar-module-inner">';
                        tmp_html += '<select name="' + property + '[]" class="select2-multi form-control" data-placeholder="Выберите" tabindex="-1" aria-hidden="true" multiple>';
                            tmp_html += '<option value="">Любой</option>';
                            for (var i = 0; i < cnt; i++){
                                tmp_html += '<option ' + ($.inArray(tmp_param[i].id, params.default.hotels) !== -1 ? 'selected ' : '') + 'value="' + tmp_param[i]["id"] + '">' + tmp_param[i]["name"] + ' ' + tmp_param[i]["star"] + '</option>'
                            }
                        tmp_html += '</select>';
                    tmp_html += '</div>';

                tmp_html += '</div>';

            } else if (property == "stars") {

                cnt = tmp_param.length;

                tmp_html += '<div class="sidebar-module">';
                    tmp_html += '<h6 class="sidebar-title">Категория отеля</h6>';

                    tmp_html += '<div class="sidebar-module-inner">';
                        tmp_html += '<div class="checkbox-block">';
                            for (var i = 0; i < cnt; i++){
                                tmp_html += '<input name="' + property + '[]" id="' + property + '_' + tmp_param[i] + '" type="checkbox" ' + ($.inArray(tmp_param[i], params.default.stars) !== -1 ? 'checked ' : '') + 'class="checkbox" value="' + tmp_param[i] + '"/>';
                                tmp_html += '<label for="' + property + '_' + tmp_param[i] + '">' + tmp_param[i] + '</label>';
                            }
                        tmp_html += '</div>';
                    tmp_html += '</div>';

                tmp_html += '</div>';

            } else if (property == "meals") {

                cnt = tmp_param.length;

                tmp_html += '<div class="sidebar-module">';
                    tmp_html += '<h6 class="sidebar-title">Питание</h6>';

                    tmp_html += '<div class="sidebar-module-inner">';
                        tmp_html += '<div class="checkbox-block">';
                            for (var i = 0; i < cnt; i++){
                                tmp_html += '<input name="' + property + '[]" id="' + tmp_param[i].id + '" type="checkbox" ' + ($.inArray(tmp_param[i].id, params.default.meals) !== -1 ? 'checked ' : '') + 'class="checkbox" value="' + tmp_param[i]["id"] + '"/>';
                                tmp_html += '<label for="' + tmp_param[i].id + '">' + tmp_param[i]["name"] + '</label>';
                            }
                        tmp_html += '</div>';
                    tmp_html += '</div>';

                tmp_html += '</div>';

            } else if (property == "default") {

                //вывод даты
                now = new Date();
                var today = new Date(now.getFullYear(), now.getMonth(), now.getDate());
                dateFormat = /^\d{2}\.\d{2}\.\d{4}$/;
                HTML["date"] += '<div class="sidebar-module">';
                    HTML["date"] += '<h6 class="sidebar-title">Дата начала выезда</h6>';

                    HTML["date"] += '<div class="sidebar-module-inner">';
                        HTML["date"] += '<i class="calendar-icon filter-calendar-icon filter-calendar-icon date-filter-from"></i>';
                        HTML["date"] += '<input class="form-control" id="date-filter-from" value="' + (params.default.date[0] !== "undefined" && dateFormat.test(params.default.date[0]) ? params.default.date[0] : today) + '" name="CheckIn">';
                    HTML["date"] += '</div>';

                HTML["date"] += '</div>';
                HTML["date"] += '<div class="clear"></div>';
                HTML["date"] += '<div class="sidebar-module">';
                    HTML["date"] += '<h6 class="sidebar-title">Дата окончания выезда</h6>';

                    HTML["date"] += '<div class="sidebar-module-inner">';
                        HTML["date"] += '<i class="calendar-icon filter-calendar-icon filter-calendar-icon date-filter-to"></i>';
                        HTML["date"] += '<input class="form-control" id="date-filter-to" value="' + (params.default.date[1] !== "undefined" && dateFormat.test(params.default.date[1]) ? params.default.date[1] : today) + '" name="CheckOut">';
                    HTML["date"] += '</div>';

                HTML["date"] += '</div>';

                //вывод ночей
                HTML["nights"] += '<div class="sidebar-module">';
                    HTML["nights"] += '<h6 class="sidebar-title">Продолжительность дней</h6>';

                    HTML["nights"] += '<div class="sidebar-module-inner">';
                        HTML["nights"] += '<input data-from="' + (typeof params.default.nights[0] !== 'undefined' || typeof params.default.nights[0] !== 'number' || params.default.nights[0] < 1 ? params.default.nights[0] : 1) + '" data-to="' + (typeof params.default.nights[1] !== 'undefined' || typeof params.default.nights[1] !== 'number' || params.default.nights[1] < 1 ? params.default.nights[1] : 21) + '" data-min="1" data-max="21" id="duration_range" />';
                        HTML["nights"] += '<input id="min-filter-duration" name="NightIn" type="hidden" value="' + (typeof params.default.nights[0] !== 'undefined' || typeof params.default.nights[0] !== 'number' || params.default.nights[0] < 1 ? params.default.nights[0] : 1) + '">';
                        HTML["nights"] += '<input id="max-filter-duration" name="NightOut" type="hidden" value="' + (typeof params.default.nights[1] !== 'undefined' || typeof params.default.nights[1] !== 'number' || params.default.nights[1] < 1 ? params.default.nights[1] : 21) + '">';
                    HTML["nights"] += '</div>';

                HTML["nights"] += '</div>';

                //вывод кол-ва взрослых
                HTML["adults"] += '<div class="sidebar-module">';
                    HTML["adults"] += '<h6 class="sidebar-title">Взрослых</h6>';

                    HTML["adults"] += '<div class="sidebar-module-inner">';
                        HTML["adults"] += '<select name="Adults" class="select2-multi form-control" data-placeholder="Выберите" tabindex="-1" aria-hidden="true">';
                            for (var i = 1; i <= 6; i++){
                                HTML["adults"] += '<option ' + (i === params.default.adults ? 'selected ' : '') + 'value="' + i + '">' + i + '</option>'
                            }
                        HTML["adults"] += '</select>';
                    HTML["adults"] += '</div>';

                HTML["adults"] += '</div>';

                //вывод кол-ва детей
                HTML["childs"] += '<div class="sidebar-module">';
                    HTML["childs"] += '<h6 class="sidebar-title">Детей</h6>';

                    HTML["childs"] += '<div class="sidebar-module-inner">';
                        HTML["childs"] += '<select name="Children" class="select2-multi form-control" data-placeholder="Выберите" tabindex="-1" aria-hidden="true">';
                            for (var i = 0; i <= 3; i++){
                                HTML["childs"] += '<option ' + (i === params.default.childs ? 'selected ' : '') + 'value="' + i + '">' + i + '</option>'
                            }
                        HTML["childs"] += '</select>';
                    HTML["childs"] += '</div>';

                HTML["childs"] += '</div>';

            }


            HTML[property] = tmp_html;

        }

        if(typeof params !== "undefined") {

            HTML["submit"] = '<div class="sidebar-module" style="text-align: center;"><a class="btn btn-primary btn-sm submit-filter">Подобрать</a></div>';
        }

        return '<form id="filterForm" class="filter-form">' + HTML["cityFrom"] + HTML["country"] + HTML["cities"] + HTML["tourTypes"] + HTML["tours"] + HTML["hotels"] + HTML["stars"] + HTML["meals"] + HTML["date"] + HTML["nights"] + HTML["adults"] + HTML["childs"] + HTML["submit"] + '</form>';

    },

}
	
