
/**
*
* Make order JQuery handlers
*
* @author dimabresky
*
*/

$(document).ready(function () {

	// INIT PLUGINS
	$('.single-select').select2();

	
	// VARS
	var Vars = {form: $('.booking-form')};
		Vars.sessid =  $('#sessid').val();
		Vars.authBlock = $('.auth-hidden-block');
		Vars.messBlock = Vars.authBlock.find('.messBlock');
		Vars.passBlock = Vars.authBlock.find('.passBlock');
		Vars.isAuth = Vars.authBlock.length > 0 ? false : true;


	// INIT HANDLERS
	if (!Vars.isAuth) {

		// functions
		Vars.ms = function () {

			// show message block

			Vars.messBlock.show();

			Vars.passBlock.hide();

			Vars.authBlock.slideDown();

		}

		Vars.mps = function () {

			// show message & password blocks

			Vars.messBlock.show();

			Vars.passBlock.show();

			Vars.authBlock.slideDown();
		}

		$('.bx-email-auth').focusout(function (e) {

			var t = $(this), p = $('input[name="pass"]');
				email = t.val();

			Vars.authBlock.hide();

			// check authorize
			$.post(Vars.form.attr('action'), {ajaxQuery: 'Y', bxCheckAuth: 'Y', email: email, sessid: Vars.sessid}, function(data){

				if (data.auth) {

					Vars.messBlock.addClass('red').html(data.mess);

					Vars.mps();

					p.focus();

					// set handler for authorize button
					$('.do-auth').click (function (e) {

						var pass = p.val();

						Vars.authBlock.hide();

						$.post(Vars.form.attr('action'), {ajaxQuery: 'Y', bxDoAuthorize: 'Y', email: email, pass: pass, sessid: Vars.sessid}, function(data) {
							
							if (data.auth) {

								Vars.messBlock
									.removeClass('red')
										.addClass('green')
											.html(data.mess);

								Vars.ms();

								Vars.passBlock.remove();

							} else {

								Vars.messBlock.addClass('red').html(data.mess);

								Vars.mps();

								p.focus();
							}

						}, 'json');

						e.preventDefault();

					}) ;

				} else {

					// simple register
					$.post(Vars.form.attr('action'), {ajaxQuery: 'Y', bxDoRegister: 'Y', email: email, sessid: Vars.sessid}, function(data){

						Vars.authBlock.hide();

						if (!data.register) {

							Vars.messBlock.addClass('red').html(data.mess);

							Vars.ms();

						} else {
							Vars.authBlock.remove();
						}

					}, 'json');

				}

			}, 'json');

		});

	}

	// date mask input
	$('.date').each(function () {
		$(this).mask('99.99.9999');
	});

	// phone mask input
	// $('input[name="phone"]').each(function () {
	// 	$(this).mask('+999 99 9999999');
	// });

	// validate contract offer checkbox
	$(".booking-form").submit(function () {

		var isActive = $('#accept_booking:checked').length > 0;

		if (!isActive) {
			$('.trigger-show').slideDown();
			return false;
		}

		

	});

});