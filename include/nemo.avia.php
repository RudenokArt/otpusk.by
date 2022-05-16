<?php
$language = 'ru';
$requestUri = $_SERVER['REQUEST_URI'];
$urlParamPos = strpos($requestUri, 'results');
if (!$urlParamPos) { $urlParamPos = strpos($requestUri, 'search'); }
$urlParamStr = $urlParamPos ? substr($requestUri, $urlParamPos) : '';
$root = str_replace($urlParamStr, '', $requestUri);

$nemoURL = 'https://avia.otpusk.by';
$widgetPartsURL = $nemoURL . '/templates/wurst/f2.0';
?>
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700,500&subset=latin,cyrillic" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo $widgetPartsURL; ?>/css/style.css?a=1123">
<!--[if IE 9]>
<link rel="stylesheet" href="<?php echo $widgetPartsURL; ?>/css/ie9.css?a=1123">
<![endif]-->
<link href="<?php echo $widgetPartsURL; ?>/js/lib/lightslider/dist/css/lightslider.min.css" rel="stylesheet">
<link href="<?php echo $widgetPartsURL; ?>/js/lib/fotorama-4.6.4/fotorama.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<style>
    #js-nemoApp .nemo-flights-form {
        margin-top: 10px !important;
    }
</style>

<div id="js-nemoApp">
    <!-- ko if: component() -->
    <div data-bind="component: { name: component, params: { route: componentRoute(), additional: componentAdditionalParams() } }">
        <div class="nemo-common-appLoader">
        </div>
    </div>
    <!-- /ko --> <!-- ko if: !component() && !globalError() -->
    <div class="nemo-common-appLoader">
    </div>
    <!-- /ko --> <!-- ko if: globalError() -->
    <div class="nemo-common-appError" data-bind="text: globalError">
    </div>
    <!-- /ko -->
</div>
<script src="<?php echo $widgetPartsURL; ?>/js/lib/requirejs/v.2.1.15/require.js"></script> <script src="<?php echo $widgetPartsURL; ?>/js/lib/jquery/v.2.1.3/jquery-2.1.3.min.js"></script> <script src="<?php echo $widgetPartsURL; ?>/js/lib/fotorama-4.6.4/fotorama.min.js"></script> <script>
    var nemoSourceHost = '<?php echo $widgetPartsURL; ?>';

    require.config({
        urlArgs: '',
        paths: {
            async:         nemoSourceHost+'/js/lib/requirejs/async',
            domReady:      nemoSourceHost+'/js/lib/requirejs/domReady',
            text:          nemoSourceHost+'/js/lib/requirejs/text',
            knockout:      nemoSourceHost+'/js/lib/knockout/v.3.2.0/knockout-3.2.0',
            AppController: nemoSourceHost+'/js/NemoFrontEndController',
            jquery:        nemoSourceHost+'/js/lib/jquery/v.2.1.3/jquery-2.1.3.min',
            jqueryUI:      nemoSourceHost+'/js/lib/jqueryUI/v.1.11.4/jquery-ui.min',
            jsCookie:      nemoSourceHost+'/js/lib/js.cookie/v.2.0.0/js.cookie',
            tooltipster:   nemoSourceHost+'/js/lib/tooltipster/jquery.tooltipster.min',
            numeralJS:     nemoSourceHost+'/js/lib/numeral.js/v.1.5.3/numeral.min',
            mousewheel:    nemoSourceHost+'/js/lib/jquery.mousewheel/jquery.mousewheel.min',
            touchpunch:    nemoSourceHost+'/js/lib/jquery.ui.touch-punch/v.0.2.3/jquery.ui.touch-punch.min',
            dotdotdot:     nemoSourceHost+'/js/lib/jquery.dotdotdot-master/jquery.dotdotdot'
        },
        baseUrl: nemoSourceHost,
        enforceDefine: true,
        waitSeconds: 300,
        config: { text: { useXhr: function () { return true; } } }
    });

    require(['AppController'], function (AppController) {
        var controller = new AppController(document.getElementById('js-nemoApp'), {
            controllerSourceURL: nemoSourceHost,
            dataURL: '<?php echo $nemoURL; ?>/api',
            staticInfoURL: '<?php echo $nemoURL; ?>/',
            templateSourceURL: '<?php echo $nemoURL; ?>/frontendStatic/html/wurst/v0/<?php echo $language; ?>/',
            i18nURL: '<?php echo $nemoURL; ?>/frontendStatic/i18n/wurst/v0',
            i18nLanguage: '<?php echo $language; ?>',
            version: 'v0',
            root: '<?php echo $root ?>',
            i18nLanguage: 'ru',
            CORSWithCredentials: true,
            componentsAdditionalInfo: {
                'Flights/SearchForm/Controller': {
                    forceSelfHostNavigation: false // `true` - для отображения результатов поиска на том же домене; `false` - для редиректа на домен связанный с Nemo.
                },
                'Hotels/SearchForm/Controller': {
                    forceSelfHostNavigation: false
                }
            }
        });
    });

    var HWatcher = {
        __prev: null,
            __id: null,
            __parent: null,
            watch: function (object) {
            var __this = this;
            __this.unwatch(object);
            __this.__id = setInterval(function () {

                if (__this.__prev !== object.scrollHeight) {
                    if (__this.__parent) {
                        __this.__parent.style.height = object.scrollHeight + 10 + "px";
                    }
                    __this.__prev = object.scrollHeight;
                }
            }, 100);
        },
        unwatch: function (object) {
            if (this.__id) {
                clearInterval(this.__id);
                this.__id = null;
                this.__prev = null;
                object.style.height = 0;
            }
        }
    }

    setTimeout(function () {
        HWatcher.__parent = window.parent.document.getElementById('nemo-avia');
        HWatcher.watch(document.getElementById('js-nemoApp'));
    }, 1000);


</script>