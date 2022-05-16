<?define("NOT_FLOAT_RIGHT", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Авиабилеты online");
?>
<style>
	.nemo-flights-form {margin-top: 30px !important;}
	.nemo-flights-form__formContainer__inner {max-width:1172px !important}
</style>
<? $requestUri = $_SERVER['REQUEST_URI'];
$urlParamPos = strpos($requestUri, "results");
if(!$urlParamPos){
	$urlParamPos = strpos($requestUri, "search");
}
If($urlParamPos){
	$urlParamStr = substr($requestUri, $urlParamPos);
}
else{
	$urlParamStr = "";
}
$newRoot = str_replace($urlParamStr, "", $requestUri);?>

<div class="nemo-root nemo-widget nemo-widget_flights js-nemoApp" data-bind="moneyInit: $data">
	<!-- ko if: component() -->
	<div style="display: none;" data-bind="attr:{style: ''}">
		<div class="" data-bind="component: {
				name: component,
				params: {
					route: componentRoute(),
					additional: componentAdditionalParams()
				}
			}">
			<div class="nemo-common-appLoader"></div>
		</div>
	</div>
	<!-- /ko -->
	<!-- ko if: !component() && !globalError() -->
	<div class="nemo-common-appLoader"></div>
	<!-- /ko -->
	<!-- ko if: globalError() -->
	<div class="nemo-common-appError" data-bind="text: globalError"></div>
	<!-- /ko -->
</div>

<?php $host_wurst = 'https://avia.otpusk.by/templates/wurst/f2.0'; ?>
<!-- путь к файлам дефолтной темы wurst, http(s)://domen.ru - домен привязанный к немо, т.е. домен куда будет идти редирект для бронирования--> 

<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="<?php echo $host_wurst; ?>/css/style.css">
<!--[if IE 9]>
	<link rel="stylesheet" href="<?php echo $host_wurst; ?>/css/ie9.css">
<![endif]-->
<script src="<?php echo $host_wurst; ?>/js/lib/requirejs/v.2.1.15/require.js"></script>

<script>
	var nemoSourceHost = '<?php echo $host_wurst; ?>';
	require.config({
		urlArgs: "version=v0",

		// Common libraries
		paths: {
			domReady:      nemoSourceHost+'/js/lib/requirejs/domReady',
			text:          nemoSourceHost+'/js/lib/requirejs/text',
			knockout:      nemoSourceHost+'/js/lib/knockout/v.3.2.0/knockout-3.2.0',
			AppController: nemoSourceHost+'/js/NemoFrontEndController',
			jquery:        nemoSourceHost+'/js/lib/jquery/v.2.1.3/jquery-2.1.3.min',
			jqueryUI:      nemoSourceHost+'/js/lib/jqueryUI/v.1.11.4/jquery-ui.min',
			jsCookie:      nemoSourceHost+'/js/lib/js.cookie/v.2.0.0/js.cookie',
			numeralJS:     nemoSourceHost+'/js/lib/numeral.js/v.1.5.3/numeral.min',
			touchpunch:    nemoSourceHost+'/js/lib/jquery.ui.touch-punch/v.0.2.3/jquery.ui.touch-punch.min'
		},

		baseUrl: nemoSourceHost,
		enforceDefine: true,
		waitSeconds: 300,

		config: {
			text: {
				useXhr: function (url, protocol, hostname, port) {
					return true;
				}
			}
		}
	});

	require (
		['AppController'],
		function (AppController) {
			var options = {
					sourceURL: nemoSourceHost,
					dataURL: 'https://avia.otpusk.by/api',
					staticInfoURL: 'https://avia.otpusk.by/',
					
					hostId: document.location.host,
					root: '<?php echo $newRoot ?>',					                                    postParameters: {},
					templateSourceURL: 'https://avia.otpusk.by/frontendStatic/html/wurst/v0/ru/',
					i18nURL: 'https://avia.otpusk.by/frontendStatic/i18n/wurst/v0',
					i18nLanguage: 'ru'
				},
				controller;

			options.componentsAdditionalInfo = {
				'Flights/SearchForm/Controller': {
					delayed: false, /* false - при поиске загрузчик отображается в небольшом поп-апе, true - стандартно (можно не добавлять и тогда и так будет стандартный загрузчик) */
					init: { /* кастомная инициализация формы поиска */
						direct: true, /* только прямые рейсы */
						serviceClass: 'Economy', /* класс */
						vicinityDates: true, /* окружные даты */
						passengers: {
							ADT: 1, /* взрослые */
							INF: 0, /* младенцы */
							CLD: 0 /* дети */
						},
						segments: [
							[
								'MSQ',
								'MOW',
								'2018-05-10',
								false,
								true /* флаг для города, который одновременно является городом вылета и прилета */
							],
							[
								'MOW',
								'MSQ',
								'2018-06-10',
								true, /* флаг для города, который одновременно является городом вылета и прилета */
								false
							]
						]
					}
				}
			}


			controller = new AppController(document.getElementsByClassName('js-nemoApp')[0], options);
			
			AppController.prototype.extend('Flights/SearchForm/Controller', function () {
				this.forceSelfHostNavigation = true; // true - для отображения результатов поиска на том же домене, false - результаты поиска на домене связанном с немо
			});
		}
	);

</script>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>