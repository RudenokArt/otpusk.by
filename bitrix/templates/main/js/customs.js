!function ($) {

    $.number_format = function (number, decimals, decPoint, thousandsSep) {
        //   example 1: number_format(1234.56)
        //   returns 1: '1,235'
        //   example 2: number_format(1234.56, 2, ',', ' ')
        //   returns 2: '1 234,56'
        //   example 3: number_format(1234.5678, 2, '.', '')
        //   returns 3: '1234.57'
        //   example 4: number_format(67, 2, ',', '.')
        //   returns 4: '67,00'
        //   example 5: number_format(1000)
        //   returns 5: '1,000'
        //   example 6: number_format(67.311, 2)
        //   returns 6: '67.31'
        //   example 7: number_format(1000.55, 1)
        //   returns 7: '1,000.6'
        //   example 8: number_format(67000, 5, ',', '.')
        //   returns 8: '67.000,00000'
        //   example 9: number_format(0.9, 0)
        //   returns 9: '1'
        //  example 10: number_format('1.20', 2)
        //  returns 10: '1.20'
        //  example 11: number_format('1.20', 4)
        //  returns 11: '1.2000'
        //  example 12: number_format('1.2000', 3)
        //  returns 12: '1.200'
        //  example 13: number_format('1 000,50', 2, '.', ' ')
        //  returns 13: '100 050.00'
        //  example 14: number_format(1e-8, 8, '.', '')
        //  returns 14: '0.00000001'
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number;
        var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals);
        var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep;
        var dec = (typeof decPoint === 'undefined') ? '.' : decPoint;
        var s = '';
        var toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + (Math.round(n * k) / k)
                    .toFixed(prec);
        };
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    };

	$(function() {

		"use strict";

			
			
			/**
			 * introLoader - Preloader
			 */
			/*$("#introLoader").introLoader({
				animation: {
						name: 'gifLoader',
						options: {
								ease: "easeInOutCirc",
								style: 'dark bubble',
								delayBefore: 500,
								delayAfter: 0,
								exitTime: 300
						}
				}
			});	*/

			
			
			/**
			 * Sticky Header
			 */
			$(".container-wrapper").waypoint(function() {
				$(".navbar").toggleClass("navbar-sticky-function");
				$(".navbar").toggleClass("navbar-sticky");
				return false;
			}, { offset: "-20px" });
			
			
			
			/**
			 * Main Menu Slide Down Effect
			 */
			 
			// Mouse-enter dropdown
			$('#navbar li').on("mouseenter", function() {
					$(this).find('ul').first().stop(true, true).delay(350).slideDown(500, 'easeInOutQuad');
			});

			// Mouse-leave dropdown
			$('#navbar li').on("mouseleave", function() {
					$(this).find('ul').first().stop(true, true).delay(100).slideUp(150, 'easeInOutQuad');
			});
			
			
			
			/**
			 * Effect to Bootstrap Dropdown
			 */
			$('.bt-dropdown-click').on('show.bs.dropdown', function(e) {   
				$(this).find('.dropdown-menu').first().stop(true, true).slideDown(500, 'easeInOutQuad'); 
			}); 
			$('.bt-dropdown-click').on('hide.bs.dropdown', function(e) { 
				$(this).find('.dropdown-menu').first().stop(true, true).slideUp(250, 'easeInOutQuad'); 
			});
			
			
			
			/**
			 * Icon Change on Collapse
			 */
			$('.collapse.in').prev('.panel-heading').addClass('active');
			$('.bootstarp-accordion, .bootstarp-toggle').on('show.bs.collapse', function(a) {
				$(a.target).prev('.panel-heading').addClass('active');
			})
			.on('hide.bs.collapse', function(a) {
				$(a.target).prev('.panel-heading').removeClass('active');
			});
			
			
			
			/**
			 * Slicknav - a Mobile Menu
			 */
			$('#responsive-menu').slicknav({
				duration: 300,
				easingOpen: 'easeInExpo',
				easingClose: 'easeOutExpo',
				closedSymbol: '<i class="fa fa-plus"></i>',
				openedSymbol: '<i class="fa fa-minus"></i>',
				prependTo: '#slicknav-mobile',
				allowParentLinks: true,
				label:"" 
			});
			
			
			
			/**
			 * Smooth scroll to anchor
			 */
			$('a.anchor[href*=#]:not([href=#])').on("click",function() {
				if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
					var target = $(this.hash);
					target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
					if (target.length) {
						$('html,body').animate({
							scrollTop: (target.offset().top - 120) // 70px offset for navbar menu
						}, 1000);
						return false;
					}
				}
			});
			
			
			
			/**
			 * Sign-in Modal
			 */
			var $formLogin = $('#login-form');
			var $formLost = $('#lost-form');
			var $formRegister = $('#register-form');
			var $divForms = $('#modal-login-form-wrapper');
			var $modalAnimateTime = 300;
			
			$('#login_register_btn').on("click", function () { modalAnimate($formLogin, $formRegister) });
			$('#register_login_btn').on("click", function () { modalAnimate($formRegister, $formLogin); });
			$('#login_lost_btn').on("click", function () { modalAnimate($formLogin, $formLost); });
			$('#lost_login_btn').on("click", function () { modalAnimate($formLost, $formLogin); });
			$('#lost_register_btn').on("click", function () { modalAnimate($formLost, $formRegister); });
			
			function modalAnimate ($oldForm, $newForm) {
				var $oldH = $oldForm.height();
				var $newH = $newForm.height();
				$divForms.css("height",$oldH);
				$oldForm.fadeToggle($modalAnimateTime, function(){
					$divForms.animate({height: $newH}, $modalAnimateTime, function(){
						$newForm.fadeToggle($modalAnimateTime);
					});
				});
			}

			
			
			/**
			 * select2 - custom select
			 */
			$(".select2-single").select2({allowClear: true});
			$(".select2-no-search").select2({dropdownCssClass : 'select2-no-search',allowClear: true});

			/**
			 * Show more-less button
			 */
			$('.btn-more-less').on("click",function(){
				$(this).text(function(i,old){
					return old=='Свернуть' ?  'Показать ещё' : 'Свернуть';
				});
			});

			
			
			/**
			 *  Arrow for Menu has sub-menu
			 */
			$(".navbar-arrow > ul > li").has("ul").children("a").append("<i class='arrow-indicator fa fa-angle-down'></i>");
			$(".navbar-arrow ul ul > li").has("ul").children("a").append("<i class='arrow-indicator fa fa-angle-right'></i>");
			
			
			
			/**
			 *  Placeholder
			 */
			$("input, textarea").placeholder();

		
		
			/**
			 * Bootstrap tooltips
			 */
			 $('[data-toggle="tooltip"]').tooltip();
			 
			 
			 
			/**
			 * responsivegrid - layout grid
			 */
			$('.grid').responsivegrid({
				gutter : '0',
				itemSelector : '.grid-item',
				'breakpoints': {
					'desktop' : {
						'range' : '1200-',
						'options' : {
							'column' : 20,
						}
					},
					'tablet-landscape' : {
						'range' : '1000-1200',
						'options' : {
							'column' : 20,
						}
					},
					'tablet-portrate' : {
						'range' : '767-1000',
						'options' : {
							'column' : 20,
						}
					},
					'mobile-landscape' : {
						'range' : '-767',
						'options' : {
							'column' : 10,
						}
					},
					'mobile-portrate' : {
						'range' : '-479',
						'options' : {
							'column' : 10,
						}
					},
				}
			});
			
			
			
			/**
			 * Payment Option
			 */
			$("div.payment-option-form").hide();
			$("input[name$='payments']").on("click",function() {
					var test = $(this).val();
					$("div.payment-option-form").hide();
					$("#" + test).show();
			});
			
			
			
			/**
			 * Raty - Rating Star
			 */
			$.fn.raty.defaults.path = '/bitrix/templates/main/images/raty';
			
			// Read onlu default size star
			$('.star-rating-read-only').raty({
				readOnly: true,
				round : { down: .2, full: .6, up: .8 },
				half: true,
				space: false,
				score: function() {
					return $(this).attr('data-rating-score');
				}
			});
			
			// Smaller size star
			/*$('.star-rating-12px').raty({
				path: '/bitrix/templates/main/images/raty',
				starHalf: 'star-half-sm.png',
				starOff: 'star-off-sm.png',
				starOn: 'star-on-sm.png',
				readOnly: true,
				round : { down: .2, full: .6, up: .8 },
				half: true,
				space: false,
				score: function() {
					return $(this).attr('data-rating-score');
				}
			});*/
			
			// White color default size star
			$('.star-rating-white').raty({
				path: '/bitrix/templates/main/images/raty',
				starHalf: 'star-half-white.png',
				starOff: 'star-off-white.png',
				starOn: 'star-on-white.png',
				readOnly: true,
				round : { down: .2, full: .6, up: .8 },
				half: true,
				space: false,
				score: function() {
					return $(this).attr('data-rating-score');
				}
			});
			
			
			
			/**
			 * readmore - read more/less
			 */
			$('.read-more-div').readmore({
				speed: 220,
				moreLink: '<a href="#" class="read-more-div-open">Read More</a>',
				lessLink: '<a href="#" class="read-more-div-close">Read less</a>',
				collapsedHeight: 45,
				heightMargin: 25
			});

			
			
			/**
			 * ionRangeSlider - range slider
			 */
			 
			 // Price Range Slider
			$("#price_range").ionRangeSlider({
				type: "double",
				grid: true,
				min: $(this).data("min"),
				max: $(this).data("max"),
				from: $(this).data("from"),
				to: $(this).data("to"),
				prefix: "",
				onFinish: function(v){ $("#min-filter-price").val(v.from), $("#max-filter-price").val(v.to) }
			})
			
			// Star Range Slider
			$("#star_range").ionRangeSlider({
				type: "double",
				grid: false,
				from: 1,
				to: 2,
				values: [
					"<i class='fa fa-star'></i>", 
					"<i class='fa fa-star'></i> <i class='fa fa-star'></i>",
					"<i class='fa fa-star'></i> <i class='fa fa-star'></i> <i class='fa fa-star'></i>", 
					"<i class='fa fa-star'></i> <i class='fa fa-star'></i> <i class='fa fa-star'></i> <i class='fa fa-star'></i>",
					"<i class='fa fa-star'></i> <i class='fa fa-star'></i> <i class='fa fa-star'></i> <i class='fa fa-star'></i> <i class='fa fa-star'></i>" 
				]
			});

			

			/**
			 * slick
			 */
			$('.gallery-slideshow').slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				speed: 500,
				arrows: true,
				fade: true,
				asNavFor: '.gallery-nav'
			});
			$('.gallery-nav').slick({
				slidesToShow: 7,
				slidesToScroll: 1,
				speed: 500,
				asNavFor: '.gallery-slideshow',
				dots: false,
				centerMode: false,
				focusOnSelect: true,
				infinite: true,
				responsive: [
					{
					breakpoint: 1199,
					settings: {
						slidesToShow: 7,
						}
					}, 
					{
					breakpoint: 991,
					settings: {
						slidesToShow: 5,
						}
					}, 
					{
					breakpoint: 767,
					settings: {
						slidesToShow: 5,
						}
					}, 
					{
					breakpoint: 480,
					settings: {
						slidesToShow: 3,
						}
					}
				]
			});


			
			/**
			 * Back To Top
			 */
			$(window).scroll(function(){
				if($(window).scrollTop() > 500){
					$("#back-to-top").fadeIn(200);
				} else{
					$("#back-to-top").fadeOut(200);
				}
			});
			$('#back-to-top').on("click",function() {
				  $('html, body').animate({ scrollTop:0 }, '800');
				  return false;
			});
			
			
			
			/**
			 * Instagram
			 */
			function createPhotoElement(photo) {
				var innerHtml = $('<img>')
				.addClass('instagram-image')
				.attr('src', photo.images.thumbnail.url);

				innerHtml = $('<a>')
				.attr('target', '_blank')
				.attr('href', photo.link)
				.append(innerHtml);

				return $('<div>')
				.addClass('instagram-placeholder')
				.attr('id', photo.id)
				.append(innerHtml);
			}

			function didLoadInstagram(event, response) {
				var that = this;
				$.each(response.data, function(i, photo) {
				$(that).append(createPhotoElement(photo));
				});
			}

			$(document).ready(function() {
				
				$('#instagram').on('didLoadInstagram', didLoadInstagram);
				$('#instagram').instagram({
				count: 20,
				userId: 302604202,
				accessToken: '735306460.4814dd1.03c1d131c1df4bfea491b3d7006be5e0'
				});

			});


	})
}(jQuery);

