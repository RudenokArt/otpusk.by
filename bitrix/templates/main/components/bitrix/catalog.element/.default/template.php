<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$scroll = array();
$today = date("F j, Y, g:i a");
$spisok = '';
//dm($arResult["DISPLAY_PROPERTIES"]["FOOD"]);
?>

<script type="text/javascript" src="//tourvisor.ru/module/init.js"></script>
<style>
.TVWideForm.TVTheme2 {
    width: 100% !important;
}
</style>

<?
$title = $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] != "" ? $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] : $arResult['NAME'];
?>
<? \Bitrix\Main\Loader::includeModule('travelsoft.currency'); ?>
<div class="col-md-9" role="main">
    <div class="detail-content-wrapper">
		<div id="section-0" class="detail-content pb-0" style="overflow:auto">
        <? if (!empty($arResult["PROPERTIES"]["TOUR_IN_ARCHIVE"]['VALUE'])): ?>
            <div class="section-title tour-archive-detail">Тур добавлен в архив, возможно он скоро поступит в продажу
            </div>
        <? endif; ?>
        <div class="col-sm-6 mb-30">
            <ul class="list-info no-icon bb-dotted padd-20">
                <? if ($arResult["DISPLAY_PROPERTIES"]["COUNTRY"]['DISPLAY_VALUE']): ?>
                    <?
                    $c = (array)$arResult["DISPLAY_PROPERTIES"]["COUNTRY"]['DISPLAY_VALUE'];
                    ?>
                    <li><span class="list-info-name-contact">Страны: </span>
                        <div class="list-info-contact"><?= implode(", ", $c) ?></div>
                    </li>
                <? endif ?>
                <? if (!empty($arResult["PROPERTIES"]["TOWN"]['VALUE'])): ?>
                    <? if (is_array($arResult["PROPERTIES"]["TOWN"]['VALUE']) && count($arResult["PROPERTIES"]["TOWN"]['VALUE']) > 1): ?>
                        <li><span class="list-info-name-contact">Маршрут: </span>
                            <div class="list-info-contact"><?= implode(' - ', (array)$arResult["DISPLAY_PROPERTIES"]["TOWN"]['DISPLAY_VALUE']) ?></div>
                        </li>
                    <? else: ?>
                        <li><span class="list-info-name-contact">Город: </span>
                            <div class="list-info-contact"><?= implode(', ', (array)$arResult["DISPLAY_PROPERTIES"]["TOWN"]['DISPLAY_VALUE']) ?></div>
                        </li>
                    <? endif ?>
                <? endif; ?>
                <? if (!empty($arResult["PROPERTIES"]["DAYS"]['VALUE'])): ?>
                    <li><span class="list-info-name-contact">Длительность: </span>
                        <div class="list-info-contact"><? $spisok_pit = null;
                            foreach ($arResult["DISPLAY_PROPERTIES"]["DAYS"]["DISPLAY_VALUE"] as $pit) {
                                $spisok_pit .= $pit . ', ';
                            }
                            if (isset($spisok_pit)): echo $spisok_pit; else: print_r($arResult["DISPLAY_PROPERTIES"]["DAYS"]["DISPLAY_VALUE"]); endif; ?>
                            ночей
                        </div>
                    </li>
                <? endif; ?>
                <? if (!empty($arResult["PROPERTIES"]["TYPE_ID"]['VALUE'])): ?>
                    <li><span class="list-info-name-contact">Тип размещения:</span>
                        <div class="list-info-contact"><?= $arResult["PROPERTIES"]["TYPE_ID"]['VALUE'] ?></div>
                    </li>
                <? endif; ?>
                <? if ($arResult["DISPLAY_PROPERTIES"]["TRANSPORT"]['DISPLAY_VALUE']): ?>
                    <li><span class="list-info-name-contact">Транспорт:</span>
                        <div class="list-info-contact"><?= strip_tags($arResult["DISPLAY_PROPERTIES"]["TRANSPORT"]['DISPLAY_VALUE']) ?></div>
                    </li>
                <? endif ?>
                <? if ($arResult['DISPLAY_PROPERTIES']['POINT_DEPARTURE']['DISPLAY_VALUE']): ?>
                    <li><span class="list-info-name-contact">Выезд из:</span>
                        <div class="list-info-contact">
                            <? if (is_array($arResult["POINT_DEPARTURE"]) && is_array($arResult['DISPLAY_PROPERTIES']['POINT_DEPARTURE']['DISPLAY_VALUE']) && count($arResult['DISPLAY_PROPERTIES']['POINT_DEPARTURE']['DISPLAY_VALUE']) >= 1): ?>
                                <? $i = 1; ?>
                                <? foreach ($arResult["POINT_DEPARTURE"] as $point): ?>
                                    <?= $point ?><? if (count($arResult["POINT_DEPARTURE"]) > $i): ?><? echo ", "; ?><? endif ?>
                                    <? $i++ ?>
                                <? endforeach ?>
                            <? else: ?>
                                <?= $arResult['p_dep'] ?>
                            <? endif ?>
                        </div>
                    </li>
                <? endif ?>
                <? if (!empty($arResult["PROPERTIES"]["CAT_ID"]['VALUE'])): ?>
                    <li><span class="list-info-name-contact">Даты тура:</span>
                        <div class="list-info-contact"><?= $arResult["PROPERTIES"]["CAT_ID"]['VALUE'] ?></div>
                    </li>
                <? endif; ?>
                <? if (!empty($arResult["PROPERTIES"]["DEPARTURE_TEXT"]["VALUE"])): ?>
                    <li><span class="list-info-name-contact">Даты тура:</span>
                        <div class="list-info-contact"><?= $arResult["PROPERTIES"]["DEPARTURE_TEXT"]["VALUE"] ?></div>
                    </li>
                <? else: ?>
                    <li><span class="list-info-name-contact">Даты тура:</span>
                        <div class="list-info-contact"><? $spisok = '';
                            $arResult["PROPERTIES"]["DEPARTURE"]["VALUE"] = dateFilter($arResult["PROPERTIES"]["DEPARTURE"]["VALUE"]);
                            foreach ($arResult["PROPERTIES"]["DEPARTURE"]["VALUE"] as $dates) {
                                if (strtotime($dates) > strtotime($today)) {
                                    $spisok .= substr($dates, 0, 10) . '; ';
                                }
                            }
                            $string = substr($spisok, 0, 650);
                            if (iconv_strlen($spisok) > 650):
                                echo $string . "… ";
                            else:
                                echo $string;
                            endif;
                            ?></div>
                    </li>
                <? endif; ?>
                <? if (!empty($arResult["PROPERTIES"]["TOURTYPE"]["VALUE"])): ?>
                    <li><span class="list-info-name-contact">Тип тура:</span>
                        <div class="list-info-contact"><?= strip_tags($arResult["DISPLAY_PROPERTIES"]["TOURTYPE"]["DISPLAY_VALUE"]) ?></div>
                    </li>
                <? endif; ?>
                <? if (!empty($arResult["PROPERTIES"]["TYPE_EXCURSIONS"]["VALUE"])): ?>
                    <li><span class="list-info-name-contact">Тип экскурсии:</span>
                        <div class="list-info-contact"><? $spisok_exc = null;
                            foreach ($arResult["DISPLAY_PROPERTIES"]["TYPE_EXCURSIONS"]["DISPLAY_VALUE"] as $exc) {
                                $spisok_exc .= $exc . ', ';
                            }
                            if (isset($spisok_exc)): echo strip_tags($spisok_exc); else: print_r(strip_tags($arResult["DISPLAY_PROPERTIES"]["TYPE_EXCURSIONS"]["DISPLAY_VALUE"])); endif; ?></div>
                    </li>
                <? endif; ?>
                <? if (!empty($arResult["PROPERTIES"]["THEME_TOURS"]["VALUE"])): ?>
                    <li><span class="list-info-name-contact">Темы:</span>
                        <div class="list-info-contact"><? $spisok_theme = null;
                            foreach ($arResult["DISPLAY_PROPERTIES"]["THEME_TOURS"]["DISPLAY_VALUE"] as $theme) {
                                $spisok_theme .= $theme . ', ';
                            }
                            if (isset($spisok_theme)): echo strip_tags($spisok_theme); else: print_r(strip_tags($arResult["DISPLAY_PROPERTIES"]["THEME_TOURS"]["DISPLAY_VALUE"])); endif; ?></div>
                    </li>
                <? endif; ?>
                <? if (!empty($arResult["PROPERTIES"]["NMAN"]["VALUE"])): ?>
                    <li><span class="list-info-name-contact">Человек в группе:</span>
                        <div class="list-info-contact"><?= strip_tags($arResult["PROPERTIES"]["NMAN"]["VALUE"]) ?></div>
                    </li>
                <? endif; ?>
                <? if (!empty($arResult["PROPERTIES"]["DURATION"]["VALUE"])): ?>
                    <li><span class="list-info-name-contact">Протяженность:</span>
                        <div class="list-info-contact"><?= strip_tags($arResult["PROPERTIES"]["DURATION"]["VALUE"]) ?>
                            км
                        </div>
                    </li>
                <? endif; ?>
                <? if (!empty($arResult["PROPERTIES"]["DURATION_TIME"]["VALUE"])): ?>
                    <li><span class="list-info-name-contact">Длительность:</span>
                        <div class="list-info-contact"><?= strip_tags($arResult["PROPERTIES"]["DURATION_TIME"]["VALUE"]) ?>
                            час.
                        </div>
                    </li>
                <? endif; ?>
                <? if (!empty($arResult["PROPERTIES"]["FOOD"]["VALUE"])): ?>
                    <li><span class="list-info-name-contact">Питание:</span>
                        <div class="list-info-contact"><?= strip_tags($arResult["DISPLAY_PROPERTIES"]["FOOD"]["DISPLAY_VALUE"]) ?></div>
                    </li>
                <? endif; ?>
                <? if (!empty($arResult["PROPERTIES"]["TYPE_PERMIT"]['VALUE'])): ?>
                    <li><span class="list-info-name-contact">Тип путевки:</span>
                        <div class="list-info-contact"><?= $arResult["DISPLAY_PROPERTIES"]["TYPE_PERMIT"]['DISPLAY_VALUE'] ?></div>
                    </li>
                <? endif; ?>
                <? if (!empty($arResult["PROPERTIES"]["DEPARTURE_EXC_TEXT"]['VALUE'])): ?>
                    <li><span class="list-info-name-contact">Время и место отправления:</span>
                        <div class="list-info-contact"><?= $arResult["DISPLAY_PROPERTIES"]["DEPARTURE_EXC_TEXT"]['DISPLAY_VALUE'] ?></div>
                    </li>
                <? endif; ?>
            </ul>
        </div>
        <div class="map-route" style="width: 400px; height: 300px;">
            <? $file_big = CFile::ResizeImageGet($arResult["PROPERTIES"]["PICTURES"]["VALUE"][0], Array('width' => 400, 'height' => 250), BX_RESIZE_IMAGE_EXACT, true); ?>
            <img src="<?= $file_big["src"]; ?>" alt="<?= $arResult['NAME'] ?>"/>
        </div>
    </div>
    <? if ($arResult["PROPERTIES"]["MT_KEY"]['VALUE'] > 0 && $arResult["MT_COUNTRY_KEY"] > 0):
        $scroll[] = array("section-12345", "Поиск тура");
        ?>
        <div id="section-12345" class="detail-content ul-list">
            <div class="section-title text-left">
                <h2 style="font-size: 21px">Поиск тура</h2>
            </div>
            <iframe id="frame_block" style="width: 100%;"
                    src="<?= str_replace(array("{mt_id}", "{country_mt_id}"), array($arResult["PROPERTIES"]["MT_KEY"]['VALUE'], $arResult["MT_COUNTRY_KEY"]), Set::IFRAME_URL_TEMPLATE) ?>"></iframe>
            <script>
                document.domain = "otpusk.by";
                var sizeFrame = "0px";

                //alert(document.domain );
                //alert("!");

                var refresh_iframe = function () {

                    //jQuery('#frame_block').attr('height', '0px' );
                    var x = document.getElementById("frame_block");
                    var y = (x.contentWindow || x.contentDocument);

                    if (y.document) y = y.document;

                    //y.body.style.height= "0%";
                    var size = y.body.scrollHeight + 'px';//scrollHeight

                    //alert(sizeFrame + " != " + size + " == " + y.body.scrollHeight);
                    if (sizeFrame != size) {
                        jQuery('#frame_block').attr('height', size);
                        sizeFrame = size;
                    }
                };

                /*jQuery(document).ready(function(){
                alert("!");
                setInterval(refresh_iframe, 50);
                });
                */

                //alert("!");
                setInterval(refresh_iframe, 50);
            </script>
        </div>
        <?
    elseif (!empty($arResult["PROPERTIES"]["PRICE"]['VALUE'])):
        $scroll[] = array("section-1_", "Цены");
        ?>
        <div id="section-1_" class="text-left mb-50">
            <div class="section-title text-left">
				<h2 style="font-size: 21px">Цены</h2>
            </div>

<!-- Код с Tourvisor -->
<div class="tv-search-form tv-moduleid-200669"></div>
<div class="clear"></div>

            

        </div>

    <? endif; ?>

		<? if (!empty($arResult["transfer"]) || !empty($arResult["point"])):$scroll[] = array("section-2", "Карта"); ?>

		<div id="section-2" style="width: 100%; height: 400px;" class="detail-content ul-list">
            <div class="section-title text-left">
                <h2 style="font-size: 21px">Тур на карте</h2>
            </div>
            <div class="mb-10 map-route" style="width: 100%; height: 300px;" id="map-area"></div>
        </div>
		<? endif ?>
    <? if (!empty($arResult["PROPERTIES"]["HD_DESC"]['VALUE'])):
        $scroll[] = array("section-3", "Описание");
        ?>
        <div id="section-3" class="detail-content ul-list">
            <div class="section-title text-left">
                <h2 style="font-size: 21px">Описание</h2>
            </div>
            <?= htmlspecialcharsBack($arResult["PROPERTIES"]["HD_DESC"]["VALUE"]["TEXT"]) ?>
        </div>
    <? endif; ?>
    <? if (!empty($arResult['b_img'])):
        $img_count = 0;
        $scroll[] = array("section-4", "Фотогалерея");
        ?>
        <div id="section-4" class="detail-content">
            <div class="section-title text-left">
                <h2 style="font-size: 21px">Фотогалерея</h2>
            </div>
            <div class="slick-gallery-slideshow">
                <div class="slider gallery-slideshow">
                    <? foreach ($arResult["PROPERTIES"]["PICTURES"]["VALUE"] as $item):
                        $file_big = CFile::ResizeImageGet($item, Array('width' => 840, 'height' => 460), BX_RESIZE_IMAGE_EXACT, true);
                        $img_count++;
                        ?>
                        <div>
                            <div class="image" style="max-height:460px"><img style="max-height:460px"
                                                                             src="<?= $file_big["src"]; ?>"
                                                                             alt="<?= $arResult['NAME'] ?>"/></div>
                            <div class="content">
                                <div style="color:#fff; padding:0 10px; font-weight:bold"><?= $arResult["PROPERTIES"]["PICTURES"]["DESCRIPTION"][$i] ?></div>
                            </div>
                        </div>
                        <? $i++;
                    endforeach; ?>
                </div>
                <? if ($img_count > 2):?>
                    <div class="slider gallery-nav">
                        <? foreach ($arResult['sm_img'] as $sm):?>
                            <div>
                                <div class="image"><img src="<?= $sm ?>" alt="<?= $arResult['NAME'] ?>"/></div>
                            </div>
                        <? endforeach ?>
                    </div>
                <? endif; ?>
            </div>
        </div>
    <? endif ?>
    <? if (!empty($arResult["PROPERTIES"]["VIDEO"]['VALUE'])):
        $scroll[] = array("section-5", "Видео");
        ?>
        <div id="section-5" class="detail-content ul-list">
            <div class="section-title text-left">
                <h2 style="font-size: 21px">Видео</h2>
            </div>
            <iframe width="560" height="315"
                    src="https://www.youtube.com/embed/<?= $arResult["PROPERTIES"]["VIDEO"]['VALUE'] ?>"
                    allowfullscreen=""></iframe>
        </div>
    <? endif; ?>
    <? if (!empty($arResult["PROPERTIES"]["MEDICINE"]['VALUE'])):
        $scroll[] = array("section-5", "Медицинский профиль");
        ?>
        <div id="section-5" class="detail-content ul-list">
            <div class="section-title text-left">
                <h2 style="font-size: 21px">Медицинский профиль</h2>
            </div>
            <?= htmlspecialcharsBack($arResult["PROPERTIES"]["MEDICINE"]["VALUE"]["TEXT"]) ?>
        </div>
    <? endif; ?>
    <? if (!empty($arResult["PROPERTIES"]["NDAYS"]['VALUE'])):
        $scroll[] = array("section-7", "Программа тура");
        $nd = $arResult["DISPLAY_PROPERTIES"]['NDAYS']["~VALUE"];
        $nd_d = $arResult["DISPLAY_PROPERTIES"]['NDAYS']["DESCRIPTION"];
        if (!empty($nd)):
            ?>
            <div id="section-7" class="detail-content">
                <div class="section-title text-left">
                    <h2 style="font-size: 21px">Программа тура</h2>
                </div>
                <div class="itinerary-wrapper">
                    <div class="itinerary-day-label font600 uppercase"><span>День</span></div>
                    <div class="itinerary-item-wrapper">
                        <div class="panel-group bootstarp-toggle">
                            <? foreach ($nd as $k => $v):?>
                                <div class="panel itinerary-item">
                                    <div class="panel-heading<? if ($k == 0) echo ' active' ?>">
                                        <span class="panel-title">
                                            <a data-toggle="collapse" <? if ($k == 0): ?>aria-expanded="true"<? endif ?>
                                               data-parent="#" href="#bootstarp-toggle-<?= ($k + 1) ?>"><span
                                                        class="absolute-day-number"><?= ($k + 1) ?></span> <?= $nd_d[$k] ?>
                                            </a>
                                        </span>
                                    </div>
                                    <div id="bootstarp-toggle-<?= ($k + 1) ?>"
                                         <? if ($k == 0): ?>aria-expanded="true"<? endif ?>
                                         class="panel-collapse collapse<? if ($k == 0):?> in<? endif ?>">
                                        <div class="panel-body">
                                            <?= $v["TEXT"] ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- end of panel -->
                            <? endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
        <? endif; endif; ?>
    <? if (!empty($arResult["PROPERTIES"]["DOCUMENT"]['VALUE'])):
        $scroll[] = array("section-8", "Необходимые документы");
        ?>
        <div id="section-8" class="detail-content ul-list">
            <div class="section-title text-left">
                <h2 style="font-size: 21px">Необходимые документы</h2>
            </div>
            <?= htmlspecialcharsBack($arResult["PROPERTIES"]["DOCUMENT"]["VALUE"]["TEXT"]) ?>
        </div>
    <? endif; ?>
    <? if (!empty($arResult["PROPERTIES"]["FILE"]['VALUE'])):
        $scroll[] = array("section-9", "Файлы для скачивания");
        foreach ($arResult["PROPERTIES"]["FILE"]['VALUE'] as $file) {
            $arFile = CFile::GetFileArray($file);
            $files[] = "<a target='__blank' href='" . $arFile["SRC"] . "'>" . $arFile["ORIGINAL_NAME"] . "</a>";
        }
        ?>
        <div id="section-9" class="detail-content">
            <div class="section-title text-left">
                <h2 style="font-size: 21px">Файлы для скачивания</h2>
            </div>
            <?= implode("<br>", $files); ?>
        </div>
    <? endif; ?>
    <? if ($arResult["PROPERTIES"]['PRICE_INCLUDE']['VALUE']['TEXT'] != "" || $arResult["PROPERTIES"]['PRICE_NO_INCLUDE']['VALUE']['TEXT'] != ""):
        $scroll[] = array("section-10", "В стоимость входит");

        ?>
        <div id="section-10" class="detail-content ul-list">
            <? if ($arResult["DISPLAY_PROPERTIES"]['PRICE_INCLUDE']['~VALUE']['TEXT'] != ""):?>
				<h3 style="font-size: 17px" class="heading">В стоимость входит</h3>
                <?= $arResult["DISPLAY_PROPERTIES"]['PRICE_INCLUDE']['~VALUE']['TEXT'] ?>
            <? endif ?>
            <? if ($arResult["DISPLAY_PROPERTIES"]['PRICE_NO_INCLUDE']['~VALUE']['TEXT'] != ""):?>
                <h3 style="font-size: 17px" class="heading">В стоимость не входит</h3>
                <?= $arResult["DISPLAY_PROPERTIES"]['PRICE_NO_INCLUDE']['~VALUE']['TEXT'] ?>
            <? endif ?>
        </div>
    <? endif ?>
    <? if (!empty($arResult["PROPERTIES"]["ADDITIONAL"]['VALUE'])):
        $scroll[] = array("section-add", "Дополнительно");
        ?>
        <div id="section-add" class="detail-content ul-list">
            <div class="section-title text-left">
                <h2 style="font-size: 21px">Дополнительно</h2>
            </div>
            <?= htmlspecialcharsBack($arResult["PROPERTIES"]["ADDITIONAL"]["VALUE"]["TEXT"]) ?>
        </div>
    <? endif; ?>
    <? if ($arResult["DISPLAY_PROPERTIES"]["TOURTYPE"]["VALUE"] == Set::BUS || $arResult["DISPLAY_PROPERTIES"]["TOURTYPE"]["VALUE"] == Set::EXCURSION): ?>
        <div id="section-add" class="detail-content ul-list">
            <div class="section-title text-left">
                <h2 style="font-size: 21px">Примечание</h2>
            </div>
            <?
            $APPLICATION->IncludeFile(str_replace("#ELEMENT_CODE#", "", $arParams["SEF_RULE"]) . "index_note.php", Array(), Array(
                "MODE" => "html",        // будет редактировать в веб-редакторе
                "NAME" => "Примечание",      // текст всплывающей подсказки на иконке
            ));
            ?>
        </div>
    <? endif ?>
    <? if ($arResult['excursions']): ?>
        <div id="section-11" class="detail-content">
            <div class="section-title text-left">
                <h2 style="font-size: 21px">Экскурсии</h2>
            </div>
            <?
            $scroll[] = array("section-11", "Экскурсии");
            ?>
            <div class="hotel-item-wrapper">
                <div class="row gap-1">
                    <? foreach ($arResult['excursions'] as $h): ?>
                        <div class="col-sm-xss-12 col-xs-6 col-sm-4 col-md-4">
                            <div class="hotel-item mb-1">
                                <a href="<?= $h['PAGE'] ?>">
                                    <div class="image">
                                        <img src="<?= $h['PIC'] ?>" alt="<?= $h['NAME'] ?>"/>
                                    </div>
                                    <div class="content">
                                        <h6><?= $h['NAME'] ?></h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <? endforeach ?>
                </div>
            </div>
        </div>
    <? endif ?>
    <? if ($arResult['sights']): ?>
        <div id="section-12" class="detail-content">
            <div class="section-title text-left">
                <h2 style="font-size: 21px">Достопримечательности</h2>
            </div>
            <?
            $scroll[] = array("section-12", "Достопримечательности");
            ?>
            <div class="hotel-item-wrapper">
                <div class="row gap-1">
                    <? foreach ($arResult['sights'] as $h): ?>
                        <div class="col-sm-xss-12 col-xs-6 col-sm-4 col-md-4">
                            <div class="hotel-item mb-1">
                                <a href="<?= $h['PAGE'] ?>">
                                    <div class="image">
                                        <img src="<?= $h['PIC'] ?>" alt="<?= $h['NAME'] ?>"/>
                                    </div>
                                    <div class="content">
                                        <h6><?= $h['NAME'] ?></h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <? endforeach ?>
                </div>
            </div>
        </div>
    <? endif ?>
    <? if ($arResult['hotels']): ?>
        <div id="section-11" class="detail-content">
            <div class="section-title text-left">
                <h2 style="font-size: 21px">Размещение</h2>
            </div>
            <?
            $scroll[] = array("section-11", "Размещение");
            ?>
            <div class="hotel-item-wrapper">
                <div class="row gap-1">
                    <? foreach ($arResult['hotels'] as $h): ?>
                        <div class="col-sm-xss-12 col-xs-6 col-sm-4 col-md-4">
                            <div class="hotel-item mb-1">
                                <a target="_blank"
                                   href="<?= $arParams['PLACEMENT_URL'] != '' ? str_replace(array('#SITE_DIR#', '#SEF_FOLDER#', '#ELEMENT_CODE#'), array(SITE_DIR, ($h['TYPE'] == 'Cанаторий' ? 'sanatorii/' : 'oteli/'), $h['CODE']), $arParams['PLACEMENT_URL']) : $h['PAGE'] ?>">
                                    <div class="image">
                                        <img src="<?= $h['PIC'] ?>" alt="<?= $h['NAME'] ?>"/>
                                    </div>
                                    <div class="content">
										<span style="color: #FFF; padding: 10px;"><?= $h['NAME'] ?></span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <? endforeach ?>
                </div>
            </div>
        </div>
    <? endif ?>


    <? if (!empty($arResult['offers'])): ?>

        <div id="section-13" class="detail-content">

            <div class="section-title text-left">
                <h2 style="font-size: 21px">Похожие предложения</h2>
            </div>


            <div class="ajax-preloader package-list-item-wrapper on-page-result-page">

                <? foreach ($arResult['offers'] as $i): ?>

                    <div class="package-list-item clearfix">
                        <div class="image">
                            <? if ($i["PIC"]): ?>
                                <a href="<?= $i['PAGE'] ?>"><img src="<?= $i["PIC"] ?>" alt="<?= $i["NAME"] ?>"/></a>
                            <? else: ?>
                                <a href="<?= $i['PAGE'] ?>"><img src="<?= Set::NO_PHOTO ?>"
                                                                 alt="<?= $i["NAME"] ?>"/></a>
                            <? endif ?>
                            <?= printTourLabel($i['FOR_LABELS']) ?>
                            <? if ($i['DAYS']): ?>
                                <div class="absolute-in-image">
                                    <div class="duration"><span><?= $i['DAYS'] ?> <?= $i['NIGHT'] ?></span></div>
                                </div>
                            <? endif ?>
                        </div>
                        <div class="content">
							<span style="display: inline-block; font-size: 17px; margin: 18px 0 10px;"><a style="color: black" href="<?= $i['PAGE'] ?>"><?= $i["NAME"] ?></a></span>
                            <div class="row gap-10">
                                <div class="col-sm-12 col-md-9">

                                    <p style="font-size: 14px;margin: 0 0 5px 0"><?= strip_tags($i["TOURTYPE"]); ?><? if ($i['TYPE_EXCURSIONS'] != "") echo " " . $i['TYPE_EXCURSIONS'] ?></p>

                                    <ul class="list-info">
                                        <?
                                        if (!empty($i["TOWN"])):?>
                                            <li>
                                                <span class="icon"><i class="fa fa-map-marker"></i></span> <span
                                                        class="font600">
                                 <?= $i['TOWN'] ?>
                                 </span>
                                            </li>
                                        <? endif ?>
                                        <? if ($i['PDEP']): ?>
                                            <li><span class="icon"><i class="fa fa-flag"></i></span> <span
                                                        class="font600">из <?= $i['PDEP'] ?>
                                                    <? if (!empty($i["DEP_TIME"]))
                                                        echo implode(", ", array_map(function ($it) {
                                                            return ConvertDateTime($it, "DD.MM");
                                                        }, dateFilter($i["DEP_TIME"])));
                                                    elseif ($i['DEP_TEXT'] != '') echo $i['DEP_TEXT'];
                                                    ?></span></li>
                                        <? elseif ($i['DEP_TEXT'] != ''): ?>
                                            <li><span class="icon"><i class="fa fa-flag"></i></span> <span
                                                        class="font600"><?= $i['DEP_TEXT'] ?></span></li>
                                        <? endif ?>
                                        <?
                                        $i["HOTEL"] = (array)$i["HOTEL"];
                                        if (!empty($i["HOTEL"])):?>
                                            <li><span class="icon"><i class="fa fa-flag"></i></span>Проживание<span
                                                        class="font600"> <?= implode(", ", $i['HOTEL']) ?></span></li>
                                        <? endif ?>
                                        <?
                                        $i["FOOD"] = (array)$i["FOOD"];
                                        if (!empty($i["FOOD"])):?>
                                            <li><span class="icon"><i class="fa fa-flag"></i></span> Питание<span
                                                        class="font600"> <?= implode(", ", array_map(function ($it) {
                                                        return strip_tags($it);
                                                    }, $i["FOOD"])) ?></span></li>
                                        <? endif ?>
                                    </ul>

                                </div>
                                <div class="col-sm-12 col-md-3 text-right text-left-sm">
                                    <center>
                                        <? if ($i["PRICE"] != ""): ?>
                                            <div class="price" style="line-height:16px; border:1px solid">
                                                <span>от</span><br>
                                                <?= \travelsoft\Currency::getInstance()->convertCurrency(
                                                    $i["PROPERTY_PRICE_VALUE"], $i["PROPERTY_CURRENCY_NAME"]
                                                ); ?>
                                                <? /*= $i["PRICE"]*/ ?><!--<br>
                           <span style="color: #EB5019; font-weight:normal; font-size:12px;"> <? /*= denomination($i["PROPERTY_PRICE_VALUE"], $i["PROPERTY_CURRENCY_VALUE"]);*/ ?></span>
                           <? /*if($i["PROPERTY_CURRENCY_VALUE"] != 62):*/ ?>
                            <br>
                           <span style="color: #EB5019; font-weight:normal; font-size:12px;"> <? /*= $i["PROPERTY_PRICE_VALUE"] .' '. $i["PROPERTY_CURRENCY_NAME"]*/ ?></span>
                           --><? /*endif*/ ?><br>
                                                <span><?= $i['PRICE_FOR'] ?></span>
                                            </div>
                                        <? endif ?>
                                        <a href="<?= $i["PAGE"] ?>" class="btn btn-primary btn-sm">Подробнее</a>
                                    </center>
                                </div>
                            </div>
                        </div>

                    </div>
                <? endforeach ?>
            </div>
        </div>
    <? endif ?>

</div>
</div>
<? if (!empty($scroll)): ?>
    <div class="col-sm-3 hidden-sm hidden-xs">
        <div class="scrolly scrollspy-sidebar sidebar-detail" role="complementary">
            <ul class="scrollspy-sidenav">
                <li>
                    <ul class="nav">
                        <?
                        foreach ($scroll as $s): ?>
                            <li><a href="#<?= $s[0] ?>" class="anchor"><?= $s[1] ?></a></li>
                        <?endforeach ?>
                    </ul>
                </li>
            </ul>
            <!--<a href="#orderModal" data-toggle="modal" class="btn order-btn btn-primary"
               onclick="ga('send', 'event', 'button', 'click', 'BookTours'); yaCounter1028882.reachGoal('BookTours'); return true;">Оставить
                заявку</a>-->
			<a href="#orderModal" data-toggle="modal" class="btn order-btn btn-primary" 
			onclick="ga('send','event','button','click','BookTours');yaCounter1028882.reachGoal('BookTours');yaCounter1028882.reachGoal('ostavit-zayavku-na-tur',{URL: document.location.href});return true;">
				Оставить заявку
			</a>
            <div style="width: 100%; height: 20px;"></div>
            Поделиться туром
            <script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
            <script src="//yastatic.net/share2/share.js"></script>
            <div class="ya-share2"
                 data-services="vkontakte,facebook,odnoklassniki,moimir,gplus,twitter,viber,skype,telegram"></div>
            <div style="width: 100%; height: 20px;"></div>
        </div>
    </div>
<?endif;
$marker_icon_small = SITE_TEMPLATE_PATH . "/images/map/marker24.png";
?>
<script src="https://maps.google.com/maps/api/js?key=AIzaSyAv847WoGtqUZmTXOakiQFZxOtzGp8oGw8"></script>
<script type="text/javascript">
    $(document).ready(function () {
        <?if($arResult['transfer']):?>
        /* map transfer */

        <?if($arResult["PROPERTIES"]["TOURTYPE"]["VALUE"] == Set::AIR || $arResult["PROPERTIES"]["TOURTYPE"]["VALUE"] == Set::EXCURSION_AIR || $arResult["PROPERTIES"]["TOURTYPE"]["VALUE"] == Set::EARLY_BOOKING):?>

        $(document).ready(function () {

            let mapAdapter = new MapAdapter({
                map_id: "map-area",
                center: {
                    lat: <?=$arResult['transfer']['start'][0];?>,
                    lng: <?=$arResult['transfer']['start'][1];?>
                },
                object: "ymaps",
                zoom: 5
            });

            let way = [];

            way.push({
                title: '<?=$arResult['transfer']['start'][2]?>',
                lat: '<?= $arResult['transfer']['start'][0]?>',
                lng: '<?= $arResult['transfer']['start'][1]?>',
                content: "<?= $arResult['transfer']['start'][2]?>",
                icon: "<?= $marker_icon_small; ?>"
            });

            way.push({
                title: '<?=$arResult['transfer']['end'][2]?>',
                lat: '<?= $arResult['transfer']['end'][0]?>',
                lng: '<?= $arResult['transfer']['end'][1]?>',
                content: "<?= $arResult['transfer']['end'][2]?>",
                icon: "<?= $marker_icon_small; ?>"
            });

            mapAdapter.drawRoute(way);
        });

        <?else:?>

        $(document).ready(function () {

            let mapAdapter = new MapAdapter({
                map_id: "map-area",
                center: {
                    lat: <?=$arResult['transfer']['start'][0];?>,
                    lng: <?=$arResult['transfer']['start'][1];?>
                },
                object: "ymaps",
                zoom: 5
            });

            let way = [];

            <?if($arResult['transfer']['way']):?>
                <?foreach($arResult['transfer']['way'] as $k => $way):?>

                    way.push({
                        title: '<?=$way[2]?>',
                        lat: '<?= $way[0]?>',
                        lng: '<?= $way[1]?>',
                        content: "<?= $way[2]?>",
                        icon: "<?= $marker_icon_small; ?>"
                    });

                <?endforeach?>
            <?endif?>

            way.push({
                title: '<?=$arResult['transfer']['start'][2]?>',
                lat: '<?= $arResult['transfer']['start'][0]?>',
                lng: '<?= $arResult['transfer']['start'][1]?>',
                content: "<?= $arResult['transfer']['start'][2]?>",
                icon: "<?= $marker_icon_small; ?>"
            });

            way.push({
                title: '<?=$arResult['transfer']['end'][2]?>',
                lat: '<?= $arResult['transfer']['end'][0]?>',
                lng: '<?= $arResult['transfer']['end'][1]?>',
                content: "<?= $arResult['transfer']['end'][2]?>",
                icon: "<?= $marker_icon_small; ?>"
            });

            mapAdapter.drawRoute(way);
        });

        <?endif;?>

        <?elseif(!empty($arResult['point'])):?>
        /* map point */

        $(document).ready(function () {

            let mapAdapter = new MapAdapter({
                map_id: "map-area",
                center: {
                    lat: <?=$arResult['point'][0][0];?>,
                    lng: <?=$arResult['point'][0][1];?>
                },
                object: "ymaps",
                zoom: 5
            });

            mapAdapter.addMarker({
                title: '<?=$arResult['point'][1]?>',
                lat: '<?= $arResult['point'][0][0]?>',
                lng: '<?= $arResult['point'][0][1]?>',
                content: "<?= $arResult['point'][1]?>",
                icon: "<?= $marker_icon_small; ?>"
            });
        });
        <?endif?>
    });
</script>

<? if ($arResult['FOOD_DESC']): ?>
    <? $this->addExternalCSS("https://cdn.jsdelivr.net/jquery.webui-popover/1.2.1/jquery.webui-popover.min.css") ?>
    <script src="https://cdn.jsdelivr.net/jquery.webui-popover/1.2.1/jquery.webui-popover.min.js"></script>
    <script type="text/javascript">
        (function ($) {
            $('.show-popuver').each(function () {
                var context = $(this).data('context');
                $(this).webuiPopover({content: context, trigger: 'hover', placement: 'right', width: '300px'});
            });
        })(jQuery);

    </script>
<? endif ?>