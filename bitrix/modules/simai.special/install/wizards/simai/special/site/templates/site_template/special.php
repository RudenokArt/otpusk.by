<script>
	$(function() {
		$(".images-on").on("click",function(){
			  $(".images-on").hide();
			  $(".images-off").show();
		});
		$(".images-off").on("click",function(){
			  $(".images-off").hide();
			  $(".images-on").show();
		});	
	});	
		
		
	$(function () {
	'use strict';
	$(document)
		.on('click', '.special-settings a:not(.link-button)', function (event) {
			event.preventDefault();
			setSpecialVersion($(this).data());
		})
		.on('click', '[data-aa-off]', function(event) {
			event.preventDefault();
			unsetSpecialVersion();
		})
		.on('click', '[data-aa-on]', function(event) {
			event.preventDefault();
			setDefaultsSpecialVersion();
		});

	jQuery(document).ready(function ($) {
		setSpecialVersion();
	});

	function setSpecialVersion(data) {
		console.log("дата: "+data+"\n");
		var
			cookieJson = $.cookie.json,
			$html = $('html'),
			htmlCurrentClass = $html.prop('class'),
			clearSpecialClasses = htmlCurrentClass.replace(/([a-z,A-Z,-]+)/g, ''),
			$aaVersion = {'aaVersion':'on'},
			htmlClass = '';

		$.cookie.json = true;

		if (data) {
			var $newCookies = $.extend($.cookie('aaSet'), data, $aaVersion);
			console.log("new cookie: "+$newCookies+"\n");
			$.cookie('aaSet', $newCookies, {
				expires: 365,
				path: '/',
				secure: false
			});
		}

		$('.a-current').removeClass('a-current');

		if ($.cookie('aaSet')) {		
			$.each($.cookie('aaSet'), function (key, val) {
				htmlClass += ' ' + key + '-' + val;
				if(val=="white")  $("#wpStylesheet").attr("href", "<?=SITE_TEMPLATE_PATH?>/special_styles/special_white.css");
				if(val=="black") $("#wpStylesheet").attr("href", "<?=SITE_TEMPLATE_PATH?>/special_styles/special_black.css");
				if(val=="blue") $("#wpStylesheet").attr("href", "<?=SITE_TEMPLATE_PATH?>/special_styles/special_blue.css");
			   if(val=="yellow") $("#wpStylesheet").attr("href", "<?=SITE_TEMPLATE_PATH?>/special_styles/special_yellow.css");
				
				$('.' + key + '-' + val).addClass('a-current');

			});
			
			$html.prop('class', clearSpecialClasses).addClass(htmlClass);
			$.cookie.json = cookieJson;
		}


		return false;
	}

	function unsetSpecialVersion() {
		var htmlCurrentClass = $('html').prop('class'),
			clearSpecialClasses = htmlCurrentClass.replace(/special-([a-z,A-Z,-]+)/g, '');
		  $('html').prop('class', clearSpecialClasses);
		$.removeCookie('aaSet', {path: '/'});
		$("#wpStylesheet").attr("href", "<?=SITE_TEMPLATE_PATH?>/special_styles/special_white.css");
		$(".image-on").hide();
		$(".image-off").show();
	}

	function setDefaultsSpecialVersion(params) {
		var $specialDefaults = {
			'aaVersion':'on',
			'color': 'white',
			'font': 'small',
			'desktop': 'common',
			'image': 'on'
			
		};

		var $setDefaulParams = $.extend($specialDefaults, params);

		setSpecialVersion($setDefaulParams);
		$(".commonVersion").show();
		$(".mobileVersion").hide();
	}

});
</script>
<div style="border-bottom: 1px solid; border-top: 1px solid;">
	<div class="container">
		<div class="row pt-10 pb-5 f-18" style="padding-top: 20px;padding-bottom: 20px; letter-spacing:normal;">
		<div class="special-settings">
			<div class="span3 text-center">
				<?=GetMessage('COLOR_SHEME')?>:
				<a href="#" class="theme white" style="font-size: 18px;" data-color="white">C</a>
				<a href="#" class="theme black" style="font-size: 18px;" data-color="black">C</a>
				<a href="#" class="theme yellow" style="font-size: 18px;" data-color="yellow">C</a>
				<a href="#" class="theme blue" style="font-size: 18px;" data-color="blue">C</a>
			</div>
			<div class="span3 text-center">
				<?=GetMessage('FONT_SIZE')?>:
					<a href="#" data-font="small" style="font-size: 20px;">A</a>
					<a href="#" data-font="normal" style="font-size: 24px;">A</a>
					<a href="#" data-font="big" style="font-size: 28px;">A</a>
			</div>
			<div class="span3 text-center">
				<?=GetMessage('KERNING')?>:
					<a href="#" data-kerning="small" style="font-size: 20px;">1</a>
					<a href="#" data-kerning="normal" style="font-size: 20px;">2</a>
					<a href="#" data-kerning="big" style="font-size: 20px;">3</a>
			</div>
			<div class="span3 text-center">
				  <?=GetMessage('IMAGE')?>
				  <a class="c-cont images-on a-current" data-image="on" href="#" <?if(strstr ($_COOKIE["aaSet"],"\"image\":\"on\"")|| (!strstr ($_COOKIE["aaSet"],"image"))){?> style="display: none;"<? } ?>> <i class="fa fa-toggle-off" style="font-size: 30px"></i></a>
				  <a class="c-cont images-off" data-image="off" href="#" <?if(strstr ($_COOKIE["aaSet"],"\"image\":\"off\"")){?> style="display: none;"<? } ?> >
				  <i class="fa fa-toggle-on" style="font-size: 30px"></i></a>
			</div>
			 <div class="span3 text-center">
				<a href="<?=$APPLICATION->GetCurPage()?>?special_version=N" class="btn btn-base return-normal link-button f-18"><?=GetMessage('RETURN_USUAL')?></a>
			</div>
	 </div>	
	</div>
	</div>
</div>