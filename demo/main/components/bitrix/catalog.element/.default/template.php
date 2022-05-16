<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
   $scroll = array();
	$today = date("F j, Y, g:i a");
	$spisok = '';
//dm($arResult["DISPLAY_PROPERTIES"]["FOOD"]);
   ?>
<?
$title = $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] != "" ? $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] : $arResult['NAME'];
?>
<?\Bitrix\Main\Loader::includeModule('travelsoft.currency');?>
<div class="col-md-9" role="main">
   <div class="detail-content-wrapper">
	   <div id="section-0" class="detail-content pb-0" style="overflow:auto">
         <div class="section-title text-left">
            <?
               // must print
               $tag = "h1";
               if(h1Exists())
                  $tag = "h3";
            ?>

            <<?= $tag?>><?=$title?> <?$scroll[] = array("section-0", $title)?> <?= $arResult["PROPERTIES"]["CAT_ID"]['VALUE']?></<?= $tag?>>
         </div>
         <?if(!empty($arResult["PROPERTIES"]["TOUR_IN_ARCHIVE"]['VALUE'])):?>
            <div class="section-title tour-archive-detail">Тур добавлен в архив, возможно он скоро поступит в продажу</div>
         <?endif;?>
         <div class="col-sm-6 mb-30">
            <ul class="list-info no-icon bb-dotted padd-20">
               <?if($arResult["DISPLAY_PROPERTIES"]["COUNTRY"]['DISPLAY_VALUE']):?>
               <?
                  $c = (array)$arResult["DISPLAY_PROPERTIES"]["COUNTRY"]['DISPLAY_VALUE'];
                  ?>
				<li><span class="list-info-name-contact">Страны: </span> <div class="list-info-contact"><?= implode(", ", $c)?></div></li>
               <?endif?>
               <?if(!empty($arResult["PROPERTIES"]["TOWN"]['VALUE'])):?>
                  <?if(is_array($arResult["PROPERTIES"]["TOWN"]['VALUE']) && count($arResult["PROPERTIES"]["TOWN"]['VALUE']) > 1):?>
            <li><span class="list-info-name-contact">Маршрут: </span> <div class="list-info-contact"><?= implode(' - ', (array)$arResult["DISPLAY_PROPERTIES"]["TOWN"]['DISPLAY_VALUE'])?></div></li>
                  <?else:?>
				<li><span class="list-info-name-contact">Город: </span> <div class="list-info-contact"><?= implode(', ', (array)$arResult["DISPLAY_PROPERTIES"]["TOWN"]['DISPLAY_VALUE'])?></div></li>
                  <?endif?>
               <?endif;?>
               <?if(!empty($arResult["PROPERTIES"]["DAYS"]['VALUE'])):?>
               <li><span class="list-info-name-contact">Длительность: </span>
				   <div class="list-info-contact"><?$spisok_pit=null; foreach ($arResult["DISPLAY_PROPERTIES"]["DAYS"]["DISPLAY_VALUE"] as $pit) {$spisok_pit .= $pit.', ';}  if (isset($spisok_pit)): echo $spisok_pit; else: print_r ($arResult["DISPLAY_PROPERTIES"]["DAYS"]["DISPLAY_VALUE"]); endif;?> ночей</div>
               </li>
               <?endif;?>
               <?if(!empty($arResult["PROPERTIES"]["TYPE_ID"]['VALUE'])):?>
				<li><span class="list-info-name-contact">Тип размещения:</span> <div class="list-info-contact"><?= $arResult["PROPERTIES"]["TYPE_ID"]['VALUE']?></div></li>
               <?endif;?>
               <?if($arResult["DISPLAY_PROPERTIES"]["TRANSPORT"]['DISPLAY_VALUE']):?>
				<li><span class="list-info-name-contact">Транспорт:</span> <div class="list-info-contact"><?= strip_tags($arResult["DISPLAY_PROPERTIES"]["TRANSPORT"]['DISPLAY_VALUE'])?></div></li>
               <?endif?>
               <?if($arResult['DISPLAY_PROPERTIES']['POINT_DEPARTURE']['DISPLAY_VALUE']):?>
                   <li><span class="list-info-name-contact">Выезд из:</span> <div class="list-info-contact">
                       <?if(is_array($arResult["POINT_DEPARTURE"]) && is_array($arResult['DISPLAY_PROPERTIES']['POINT_DEPARTURE']['DISPLAY_VALUE']) && count($arResult['DISPLAY_PROPERTIES']['POINT_DEPARTURE']['DISPLAY_VALUE']) >= 1):?>
                           <?$i = 1;?>
                           <?foreach ($arResult["POINT_DEPARTURE"] as $point):?>
                               <?= $point?><?if(count($arResult["POINT_DEPARTURE"]) > $i):?><?echo ", ";?><?endif?>
                               <?$i++?>
                           <?endforeach?>
                       <?else:?>
                           <?= $arResult['p_dep']?>
                       <?endif?>
                   </div></li>
               <?endif?>
               <?if(!empty($arResult["PROPERTIES"]["CAT_ID"]['VALUE'])):?>
				<li><span class="list-info-name-contact">Даты тура:</span> <div class="list-info-contact"><?= $arResult["PROPERTIES"]["CAT_ID"]['VALUE']?></div></li>
               <?endif;?>
               <?if(!empty($arResult["PROPERTIES"]["DEPARTURE_TEXT"]["VALUE"])):?>
				<li><span class="list-info-name-contact">Даты тура:</span> <div class="list-info-contact"><?=$arResult["PROPERTIES"]["DEPARTURE_TEXT"]["VALUE"]?></div></li>
               <?else:?>
               <li><span class="list-info-name-contact">Даты тура:</span> <div class="list-info-contact"><?  $spisok='';
                  $arResult["PROPERTIES"]["DEPARTURE"]["VALUE"] = dateFilter($arResult["PROPERTIES"]["DEPARTURE"]["VALUE"]);
                  foreach ($arResult["PROPERTIES"]["DEPARTURE"]["VALUE"] as $dates)
                  {
                  	if (strtotime($dates)>strtotime($today))
                  	{ $spisok .= substr($dates,0,10).'; ';}
                  }
                  $string = substr($spisok, 0, 650);
                  if (iconv_strlen ($spisok)>650):
                  echo $string."… ";
                  else:
                  echo $string;
                  endif;
				   ?></div>
               </li>
               <?endif;?>
               <?if (!empty($arResult["PROPERTIES"]["TOURTYPE"]["VALUE"])):?>
		   <li><span class="list-info-name-contact">Тип тура:</span> <div class="list-info-contact"><?=strip_tags($arResult["DISPLAY_PROPERTIES"]["TOURTYPE"]["DISPLAY_VALUE"])?></div></li>
               <?endif;?>
               <?if (!empty($arResult["PROPERTIES"]["TYPE_EXCURSIONS"]["VALUE"])):?>
				<li><span class="list-info-name-contact">Тип экскурсии:</span>
					<div class="list-info-contact"><?$spisok_exc=null; foreach ($arResult["DISPLAY_PROPERTIES"]["TYPE_EXCURSIONS"]["DISPLAY_VALUE"] as $exc) {$spisok_exc .= $exc.', ';}  if (isset($spisok_exc)): echo strip_tags($spisok_exc); else: print_r (strip_tags($arResult["DISPLAY_PROPERTIES"]["TYPE_EXCURSIONS"]["DISPLAY_VALUE"])); endif;?></div>
					</li>
               <?endif;?>
               <?if (!empty($arResult["PROPERTIES"]["THEME_TOURS"]["VALUE"])):?>
               <li><span class="list-info-name-contact">Темы:</span>
				   <div class="list-info-contact"><?$spisok_theme=null; foreach ($arResult["DISPLAY_PROPERTIES"]["THEME_TOURS"]["DISPLAY_VALUE"] as $theme) {$spisok_theme .= $theme.', ';}  if (isset($spisok_theme)): echo strip_tags($spisok_theme); else: print_r (strip_tags($arResult["DISPLAY_PROPERTIES"]["THEME_TOURS"]["DISPLAY_VALUE"])); endif;?></div>
					</li>
               <?endif;?>
               <?if (!empty($arResult["PROPERTIES"]["NMAN"]["VALUE"])):?>
		   <li><span class="list-info-name-contact">Человек в группе:</span> <div class="list-info-contact"><?=strip_tags($arResult["PROPERTIES"]["NMAN"]["VALUE"])?></div></li>
               <?endif;?>
               <?if (!empty($arResult["PROPERTIES"]["DURATION"]["VALUE"])):?>
		   <li><span class="list-info-name-contact">Протяженность:</span> <div class="list-info-contact"><?=strip_tags($arResult["PROPERTIES"]["DURATION"]["VALUE"])?> км</div></li>
               <?endif;?>
               <?if (!empty($arResult["PROPERTIES"]["DURATION_TIME"]["VALUE"])):?>
		   <li><span class="list-info-name-contact">Длительность:</span> <div class="list-info-contact"><?=strip_tags($arResult["PROPERTIES"]["DURATION_TIME"]["VALUE"])?> час.</div></li>
               <?endif;?>
               <?if (!empty($arResult["PROPERTIES"]["FOOD"]["VALUE"])):?>
		   <li><span class="list-info-name-contact">Питание:</span> <div class="list-info-contact"><?=strip_tags ($arResult["DISPLAY_PROPERTIES"]["FOOD"]["DISPLAY_VALUE"])?></div></li>
               <?endif;?>
               <?if(!empty($arResult["PROPERTIES"]["TYPE_PERMIT"]['VALUE'])):?>
		   <li><span class="list-info-name-contact">Тип путевки:</span> <div class="list-info-contact"><?= $arResult["DISPLAY_PROPERTIES"]["TYPE_PERMIT"]['DISPLAY_VALUE']?></div></li>
               <?endif;?>
               <?if(!empty($arResult["PROPERTIES"]["DEPARTURE_EXC_TEXT"]['VALUE'])):?>
		   <li><span class="list-info-name-contact">Время и место отправления:</span> <div class="list-info-contact"><?= $arResult["DISPLAY_PROPERTIES"]["DEPARTURE_EXC_TEXT"]['DISPLAY_VALUE']?></div></li>
               <?endif;?>
            </ul>
         </div>
         <div class="map-route" style="width: 400px; height: 300px;">
            <?$file_big=CFile::ResizeImageGet($arResult["PROPERTIES"]["PICTURES"]["VALUE"][0], Array('width'=>400, 'height'=>250),BX_RESIZE_IMAGE_EXACT,true);?>
            <img src="<?=$file_big["src"];?>" alt="<?= $arResult['NAME']?>" />
         </div>
      </div>
      <?if($arResult["PROPERTIES"]["MT_KEY"]['VALUE'] > 0 && $arResult["MT_COUNTRY_KEY"] > 0):
         $scroll[] = array("section-12345", "Поиск тура");
         ?>
         <div id="section-12345" class="detail-content ul-list">
            <div class="section-title text-left">
               <h4>Поиск тура</h4>
            </div>
            <iframe id="frame_block" style="width: 100%;" src="<?= str_replace(array("{mt_id}", "{country_mt_id}"), array($arResult["PROPERTIES"]["MT_KEY"]['VALUE'], $arResult["MT_COUNTRY_KEY"]), Set::IFRAME_URL_TEMPLATE)?>"></iframe>
            <script>
               document.domain = "otpusk.by";
               var sizeFrame = "0px";

               //alert(document.domain );
               //alert("!");

               var refresh_iframe = function(){

               //jQuery('#frame_block').attr('height', '0px' );
               var x = document.getElementById("frame_block");
               var y = (x.contentWindow || x.contentDocument);

               if (y.document) y = y.document;

               //y.body.style.height= "0%";
               var size = y.body.scrollHeight+ 'px';//scrollHeight

               //alert(sizeFrame + " != " + size + " == " + y.body.scrollHeight);
               if (sizeFrame != size)
               {
               jQuery('#frame_block').attr('height', size );
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
		elseif(!empty($arResult["PROPERTIES"]["PRICE"]['VALUE'])):
      $scroll[] = array("section-1_", "Цены");
      ?>
      <div id="section-1_" class="text-left mb-50">
         <div class="section-title text-left">
            <h4>Цены</h4>
         </div>

			<div class="availabily-wrapper">
				<ul class="availabily-list">
					<li class="availabily-heading clearfix">
						<?if(iconv_strlen ($spisok)>=10):?>
                            <div class="date-from">
                                дата
                            </div>
						<?endif;?>
						<?if(!empty($arResult["PROPERTIES"]["DAYS"]['VALUE'])):?>
						<div class="date-to">
							ночей
						</div>
						<?endif?>
						<?if(!empty($arResult["PROPERTIES"]["FOOD"]['VALUE'])):?>
                            <div class="price">
                                питание
                            </div>
						<?endif?>
						<div class="status">
							цена
						</div>
						<!--<div class="status">
							цена для ребенка
						</div>-->
						<div class="action">
							&nbsp;
						</div>
					</li>
					<?if(iconv_strlen ($spisok)>=10):
$k=0;
					?>
                        <?foreach ($arResult["DATES"]["ITEMS"] as $key=>$dates) {?>

                            <?if (strtotime($dates)>strtotime($today)):?>

                                <li class="availabily-content clearfix">
                                    <div class="date-from">
                                        <span class="availabily-heading-label">начало:</span>
                                        <span><?=substr($dates,0,10);?></span>
                                    </div>
                                    <?if(!empty($arResult["PROPERTIES"]["DAYS"]['VALUE'])):?>
                                    <div class="date-to">
                                        <span class="availabily-heading-label">дней:</span>
                                        <span><?=$arResult["DISPLAY_PROPERTIES"]["DAYS"]["DISPLAY_VALUE"]?> ночей</span>
                                    </div>
                                    <?endif?>
                                    <?if(!empty($arResult["PROPERTIES"]["FOOD"]['VALUE'])):?>
                                    <div class="price">
                                        <span class="availabily-heading-label">питание:</span>
                                        <span ><?= strip_tags($arResult["DISPLAY_PROPERTIES"]["FOOD"]['DISPLAY_VALUE'])?><i <?if($arResult['FOOD_DESC'] != ''):?>data-context="<?= $arResult['FOOD_DESC']['TEXT']?>"<?endif?> class="show-popuver fa fa-question-circle" style="color:#EB5019;"></i></span>
                                    </div>
                                    <?endif?>
                                    <div class="status">
                                        <span class="availabily-heading-label">цена:</span>
                                        <?$price = !empty($arResult["DATES"]["DESCRIPTION"][$key]) ? $arResult["DATES"]["DESCRIPTION"][$key] : $arResult["PROPERTIES"]["PRICE"]['VALUE'];?>
                                        <span> <?= \travelsoft\Currency::getInstance()->convertCurrency(
                                                $price, $arResult["PROPERTIES"]["CURRENCY"]["VALUE"]
                                            );?>
                                        </span>
                                 <?/*if($arResult["PROPERTIES"]["CURRENCY"]["VALUE"] != Set::CURRENCY_BYR_ID)
                                    echo number_format($arResult["PROPERTIES"]["PRICE"]['VALUE'], 0 ,"", " ") .' '. strip_tags($arResult["DISPLAY_PROPERTIES"]["CURRENCY"]["DISPLAY_VALUE"]);
                                 */?><!--
                                 <?/*= "<br>" . denomination($arResult["PROPERTIES"]["PRICE"]['VALUE'], $arResult["PROPERTIES"]["CURRENCY"]["VALUE"])*/?>
                                        <span><?/*= convert_currency($arResult["PROPERTIES"]["PRICE"]['VALUE'], $arResult["PROPERTIES"]["CURRENCY"]["VALUE"])*/?></span>-->
                                    </div>
                                    <div class="status">
                                        <span class="availabily-heading-label">цена:</span>



                                 <?if($arResult["PROPERTIES"]["PRICE_CHILD"]['VALUE'] > 0):?>
                                    <span>
                                        <?= \travelsoft\Currency::getInstance()->convertCurrency(
                                            $arResult["PROPERTIES"]["PRICE_CHILD"]['VALUE'], $arResult["PROPERTIES"]["CURRENCY"]["VALUE"]
                                        );?>
                                    </span>

                                 <?endif?>
                                    </div>
                                    <div class="action">
                                        <a class="btn btn-primary btn-sm btn-inverse"  data-toggle="modal" href="#orderModal"
                                        onclick="ga('send', 'event', 'button', 'click', 'BookTours'); yaCounter1028882.reachGoal('BookTours'); return true;" >Оставить заявку</a>
                                    </div>
                                </li>
                            <?else:

        $k++;?>
                            <?endif;?>
    <?$k++;?>
                        <?}?>
					<?else:?>
                        <li class="availabily-content clearfix">
                            <?if(!empty($arResult["PROPERTIES"]["DAYS"]['VALUE'])):?>
                            <div class="date-to">
                                <span class="availabily-heading-label">дней:</span>
                                <span><?=$arResult["DISPLAY_PROPERTIES"]["DAYS"]["DISPLAY_VALUE"]?> ночей</span>
                            </div>
                            <?endif?>
                            <?if(!empty($arResult["PROPERTIES"]["FOOD"]['VALUE'])):?>
                            <div class="price">
                                <span class="availabily-heading-label">питание:</span>
                                <span ><?= strip_tags($arResult["DISPLAY_PROPERTIES"]["FOOD"]['DISPLAY_VALUE'])?><i <?if($arResult['FOOD_DESC'] != ''):?>data-context="<?= $arResult['FOOD_DESC']['TEXT']?>"<?endif?> class="show-popuver fa fa-question-circle" style="color:#EB5019;"></i></span>
                            </div>
                            <?endif?>
                            <div class="status">
                                <span class="availabily-heading-label">цена:</span>

                                <span>
                                    <?= \travelsoft\Currency::getInstance()->convertCurrency(
                                        $arResult["PROPERTIES"]["PRICE"]['VALUE'], $arResult["PROPERTIES"]["CURRENCY"]["VALUE"]
                                    );?>
                                </span>
                                <?/*if($arResult["PROPERTIES"]["CURRENCY"]["VALUE"] != Set::CURRENCY_BYR_ID)
                            echo number_format($arResult["PROPERTIES"]["PRICE"]['VALUE'], 0 ,"", "") .' '. strip_tags($arResult["DISPLAY_PROPERTIES"]["CURRENCY"]["DISPLAY_VALUE"]);
                         */?><!--
                         <?/*= "<br>" . denomination($arResult["PROPERTIES"]["PRICE"]['VALUE'], $arResult["PROPERTIES"]["CURRENCY"]["VALUE"])*/?>
                                <span><?/*= convert_currency($arResult["PROPERTIES"]["PRICE"]['VALUE'], $arResult["PROPERTIES"]["CURRENCY"]["VALUE"])*/?></span>-->
                            </div>
                            <div class="action">
                                <a class="btn btn-primary btn-sm btn-inverse"  data-toggle="modal" href="#orderModal"
                                onclick="ga('send', 'event', 'button', 'click', 'BookTours'); yaCounter1028882.reachGoal('BookTours'); return true;">Бронировать</a>
                            </div>
                        </li>
					<?endif;?>
				</ul>
			</div>

      </div>
      <?endif;?>

      <?if(!empty($arResult["transfer"]) || !empty($arResult["point"])):$scroll[] = array("section-2", "Карта");?>

         <div id="section-2" style="width: 100%; height: 400px;" class="detail-content ul-list">
            <div class="section-title text-left">
               <h4>Тур на карте</h4>
            </div>
            <div class="mb-10 map-route" style="width: 100%; height: 300px;" id="map-area"></div>
   	   </div>
       <?endif?>
      <?if(!empty($arResult["PROPERTIES"]["HD_DESC"]['VALUE'])):
         $scroll[] = array("section-3", "Описание");
         ?>
      <div id="section-3" class="detail-content ul-list">
         <div class="section-title text-left">
            <h4>Описание</h4>
         </div>
         <?=htmlspecialcharsBack($arResult["PROPERTIES"]["HD_DESC"]["VALUE"]["TEXT"])?>
      </div>
      <?endif;?>
      <?if(!empty($arResult['b_img'])):
			$img_count=0;
         $scroll[] = array("section-4", "Фотогалерея");
         ?>
      <div id="section-4" class="detail-content">
         <div class="section-title text-left">
            <h4>Фотогалерея</h4>
         </div>
         <div class="slick-gallery-slideshow">
            <div class="slider gallery-slideshow">
               <?foreach($arResult["PROPERTIES"]["PICTURES"]["VALUE"] as $item):
                  $file_big=CFile::ResizeImageGet($item, Array('width'=>840, 'height'=>460),BX_RESIZE_IMAGE_EXACT,true);
					$img_count++;
                  ?>
						<div><div class="image" style="max-height:460px"><img style="max-height:460px" src="<?=$file_big["src"];?>" alt="<?= $arResult['NAME']?>" /></div>
							<div class="content"><div style="color:#fff; padding:0 10px; font-weight:bold"><?=$arResult["PROPERTIES"]["PICTURES"]["DESCRIPTION"][$i]?></div></div>
						</div>
					<? $i++;
					endforeach;?>
            </div>
			 <?if ($img_count>2):?>
            <div class="slider gallery-nav">
               <?foreach($arResult['sm_img'] as $sm):?>
               <div>
                  <div class="image"><img src="<?= $sm?>" alt="<?= $arResult['NAME']?>" /></div>
               </div>
               <?endforeach?>
            </div>
			<?endif;?>
         </div>
      </div>
      <?endif?>
      <?if(!empty($arResult["PROPERTIES"]["VIDEO"]['VALUE'])):
         $scroll[] = array("section-5", "Видео");
         ?>
      <div id="section-5" class="detail-content ul-list">
         <div class="section-title text-left">
            <h4>Видео</h4>
         </div>
         <iframe width="560" height="315" src="https://www.youtube.com/embed/<?= $arResult["PROPERTIES"]["VIDEO"]['VALUE']?>" allowfullscreen=""></iframe>
      </div>
      <?endif;?>
      <?if(!empty($arResult["PROPERTIES"]["MEDICINE"]['VALUE'])):
         $scroll[] = array("section-5", "Медицинский профиль");
         ?>
      <div id="section-5" class="detail-content ul-list">
         <div class="section-title text-left">
            <h4>Медицинский профиль</h4>
         </div>
         <?=htmlspecialcharsBack($arResult["PROPERTIES"]["MEDICINE"]["VALUE"]["TEXT"])?>
      </div>
      <?endif;?>
      <? if(!empty($arResult["PROPERTIES"]["NDAYS"]['VALUE'])):
         $scroll[] = array("section-7", "Программа тура");
         			$nd = $arResult["DISPLAY_PROPERTIES"]['NDAYS']["~VALUE"];
         			$nd_d = $arResult["DISPLAY_PROPERTIES"]['NDAYS']["DESCRIPTION"];
         			if(!empty($nd)):
         			?>
      <div id="section-7" class="detail-content">
         <div class="section-title text-left">
            <h4>Программа тура</h4>
         </div>
         <div class="itinerary-wrapper">
            <div class="itinerary-day-label font600 uppercase"><span>День</span></div>
            <div class="itinerary-item-wrapper">
               <div class="panel-group bootstarp-toggle">
                  <?foreach($nd as $k => $v):?>
                  <div class="panel itinerary-item">
                     <div class="panel-heading<?if($k == 0) echo ' active'?>">
                        <h5 class="panel-title">
                           <a data-toggle="collapse" <?if($k == 0):?>aria-expanded="true"<?endif?> data-parent="#" href="#bootstarp-toggle-<?= ($k + 1)?>"><span class="absolute-day-number"><?= ($k + 1)?></span> <?= $nd_d[$k]?></a>
                        </h5>
                     </div>
                     <div id="bootstarp-toggle-<?= ($k + 1)?>"  <?if($k == 0):?>aria-expanded="true"<?endif?> class="panel-collapse collapse<?if($k == 0):?> in<?endif?>">
                        <div class="panel-body">
                           <?= $v["TEXT"]?>
                        </div>
                     </div>
                  </div>
                  <!-- end of panel -->
                  <?endforeach?>
               </div>
            </div>
         </div>
      </div>
      <? endif; endif; ?>
      <?if(!empty($arResult["PROPERTIES"]["DOCUMENT"]['VALUE'])):
         $scroll[] = array("section-8", "Необходимые документы");
         ?>
      <div id="section-8" class="detail-content ul-list">
         <div class="section-title text-left">
            <h4>Необходимые документы</h4>
         </div>
         <?=htmlspecialcharsBack($arResult["PROPERTIES"]["DOCUMENT"]["VALUE"]["TEXT"])?>
      </div>
      <?endif;?>
      <?if(!empty($arResult["PROPERTIES"]["FILE"]['VALUE'])):
         $scroll[] = array("section-9", "Файлы для скачивания");
         foreach ($arResult["PROPERTIES"]["FILE"]['VALUE'] as $file) {
            $arFile = CFile::GetFileArray($file);
            $files[] = "<a target='__blank' href='".$arFile["SRC"]."'>".$arFile["ORIGINAL_NAME"]."</a>";
         }
         ?>
      <div id="section-9" class="detail-content">
         <div class="section-title text-left">
            <h4>Файлы для скачивания</h4>
         </div>
         <?=implode("<br>", $files);?>
      </div>
      <?endif;?>
      <?if($arResult["PROPERTIES"]['PRICE_INCLUDE']['VALUE']['TEXT'] != "" || $arResult["PROPERTIES"]['PRICE_NO_INCLUDE']['VALUE']['TEXT'] != ""):
         $scroll[] = array("section-10", "В стоимость входит");

         ?>
      <div id="section-10" class="detail-content ul-list">
         <?if($arResult["DISPLAY_PROPERTIES"]['PRICE_INCLUDE']['~VALUE']['TEXT'] != ""):?>
         <h5 class="heading">В стоимость входит</h5>
         <?= $arResult["DISPLAY_PROPERTIES"]['PRICE_INCLUDE']['~VALUE']['TEXT']?>
         <?endif?>
         <?if($arResult["DISPLAY_PROPERTIES"]['PRICE_NO_INCLUDE']['~VALUE']['TEXT'] != ""):?>
         <h5 class="heading">В стоимость не входит</h5>
         <?= $arResult["DISPLAY_PROPERTIES"]['PRICE_NO_INCLUDE']['~VALUE']['TEXT']?>
         <?endif?>
      </div>
      <?endif?>
      <?if(!empty($arResult["PROPERTIES"]["ADDITIONAL"]['VALUE'])):
         $scroll[] = array("section-add", "Дополнительно");
         ?>
      <div id="section-add" class="detail-content ul-list">
         <div class="section-title text-left">
            <h4>Дополнительно</h4>
         </div>
         <?=htmlspecialcharsBack($arResult["PROPERTIES"]["ADDITIONAL"]["VALUE"]["TEXT"])?>
      </div>
      <?endif;?>
        <?if($arResult["DISPLAY_PROPERTIES"]["TOURTYPE"]["VALUE"] == Set::BUS || $arResult["DISPLAY_PROPERTIES"]["TOURTYPE"]["VALUE"] == Set::EXCURSION):?>
            <div id="section-add" class="detail-content ul-list">
             <div class="section-title text-left">
                <h4>Примечание</h4>
             </div>
                <?
                $APPLICATION->IncludeFile(str_replace("#ELEMENT_CODE#", "", $arParams["SEF_RULE"])."index_note.php", Array(), Array(
                    "MODE"      => "html",        // будет редактировать в веб-редакторе
                    "NAME"      => "Примечание",      // текст всплывающей подсказки на иконке
                ));
                ?>
           </div>
        <?endif?>
      <?if($arResult['excursions']):?>
      <div id="section-11" class="detail-content">
         <div class="section-title text-left">
            <h4>Экскурсии</h4>
         </div>
         <?
            $scroll[] = array("section-11", "Экскурсии");
            ?>
         <div class="hotel-item-wrapper">
            <div class="row gap-1">
               <?foreach($arResult['excursions'] as $h):?>
               <div class="col-sm-xss-12 col-xs-6 col-sm-4 col-md-4">
                  <div class="hotel-item mb-1">
                     <a href="<?= $h['PAGE']?>">
                        <div class="image">
                           <img src="<?= $h['PIC']?>" alt="<?= $h['NAME']?>" />
                        </div>
                        <div class="content">
                           <h6><?= $h['NAME']?></h6>
                        </div>
                     </a>
                  </div>
               </div>
               <?endforeach?>
            </div>
         </div>
      </div>
      <?endif?>
      <?if($arResult['sights']):?>
      <div id="section-12" class="detail-content">
         <div class="section-title text-left">
            <h4>Достопримечательности</h4>
         </div>
         <?
            $scroll[] = array("section-12", "Достопримечательности");
            ?>
         <div class="hotel-item-wrapper">
            <div class="row gap-1">
               <?foreach($arResult['sights'] as $h):?>
               <div class="col-sm-xss-12 col-xs-6 col-sm-4 col-md-4">
                  <div class="hotel-item mb-1">
                     <a href="<?= $h['PAGE']?>">
                        <div class="image">
                           <img src="<?= $h['PIC']?>" alt="<?= $h['NAME']?>" />
                        </div>
                        <div class="content">
                           <h6><?= $h['NAME']?></h6>
                        </div>
                     </a>
                  </div>
               </div>
               <?endforeach?>
            </div>
         </div>
      </div>
      <?endif?>
      <?if($arResult['hotels']):?>
      <div id="section-11" class="detail-content">
         <div class="section-title text-left">
            <h4>Размещение</h4>
         </div>
         <?
            $scroll[] = array("section-11", "Размещение");
            ?>
         <div class="hotel-item-wrapper">
            <div class="row gap-1">
               <?foreach($arResult['hotels'] as $h):?>
               <div class="col-sm-xss-12 col-xs-6 col-sm-4 col-md-4">
                  <div class="hotel-item mb-1">
                     <a target="_blank" href="<?= $arParams['PLACEMENT_URL'] != '' ? str_replace(array('#SITE_DIR#', '#SEF_FOLDER#', '#ELEMENT_CODE#'), array(SITE_DIR, ($h['TYPE'] == 'Cанаторий' ? 'sanatorii/' : 'oteli/'), $h['CODE']), $arParams['PLACEMENT_URL']) : $h['PAGE']?>">
                        <div class="image">
                           <img src="<?= $h['PIC']?>" alt="<?= $h['NAME']?>" />
                        </div>
                        <div class="content">
                           <h6><?= $h['NAME']?></h6>
                        </div>
                     </a>
                  </div>
               </div>
               <?endforeach?>
            </div>
         </div>
      </div>
      <?endif?>


      <?if(!empty($arResult['offers'])):?>

      <div id="section-13" class="detail-content">

        <div class="section-title text-left">
            <h4>Похожие предложения</h4>
         </div>


         <div class="ajax-preloader package-list-item-wrapper on-page-result-page">

         <?foreach($arResult['offers'] as $i):?>

            <div class="package-list-item clearfix">
               <div class="image">
                  <?if($i["PIC"]):?>
                     <a href="<?= $i['PAGE']?>"><img src="<?= $i["PIC"]?>" alt="<?= $i["NAME"]?>" /></a>
                  <?else:?>
                     <a href="<?= $i['PAGE']?>"><img src="<?= Set::NO_PHOTO?>" alt="<?= $i["NAME"]?>" /></a>
                  <?endif?>
                  <?= printTourLabel($i['FOR_LABELS'])?>
                  <?if($i['DAYS']):?>
                     <div class="absolute-in-image">
                        <div class="duration"><span><?= $i['DAYS']?> <?= $i['NIGHT']?></span></div>
                     </div>
                  <?endif?>
               </div>
               <div class="content">
                  <h5><a style="color: black" href="<?= $i['PAGE']?>"><?= $i["NAME"]?></a></h5>
                  <div class="row gap-10">
                     <div class="col-sm-12 col-md-9">

                        <p style="font-size: 14px;margin: 0 0 5px 0"><?= strip_tags($i["TOURTYPE"]);?><?if($i['TYPE_EXCURSIONS'] != "") echo " " . $i['TYPE_EXCURSIONS']?></p>

                        <ul class="list-info">
                           <?
                           if(!empty($i["TOWN"])):?>
                              <li>
                                 <span class="icon"><i class="fa fa-map-marker"></i></span> <span class="font600">
                                 <?= $i['TOWN']?>
                                 </span>
                              </li>
                           <?endif?>
                           <?if($i['PDEP']):?>
                               <li><span class="icon"><i class="fa fa-flag"></i></span> <span class="font600">из <?= $i['PDEP']?>
                               <?if(!empty($i["DEP_TIME"]))
                                    echo implode(", ",array_map(function($it){ return ConvertDateTime($it, "DD.MM"); }, dateFilter($i["DEP_TIME"])));
                                    elseif($i['DEP_TEXT'] != '') echo $i['DEP_TEXT'];
                                 ?></span></li>
                           <?elseif($i['DEP_TEXT'] != ''):?>
                               <li><span class="icon"><i class="fa fa-flag"></i></span> <span class="font600"><?= $i['DEP_TEXT']?></span></li>
                           <?endif?>
                           <?
                           $i["HOTEL"] = (array)$i["HOTEL"];
                           if(!empty($i["HOTEL"])):?>
                              <li><span class="icon"><i class="fa fa-flag"></i></span>Проживание<span class="font600"> <?= implode(", ", $i['HOTEL'])?></span></li>
                           <?endif?>
                           <?
                           $i["FOOD"] = (array)$i["FOOD"];
                           if(!empty($i["FOOD"])):?>
                           <li><span class="icon"><i class="fa fa-flag"></i></span> Питание<span class="font600"> <?= implode(", ",array_map(function($it){ return strip_tags($it); }, $i["FOOD"]))?></span></li>
                           <?endif?>
                        </ul>

                     </div>
                     <div class="col-sm-12 col-md-3 text-right text-left-sm">
                     <center>
                        <?if($i["PRICE"] != ""):?>
                        <div class="price" style="line-height:16px; border:1px solid"><span>от</span><br>
                            <?= \travelsoft\Currency::getInstance()->convertCurrency(
                                $i["PROPERTY_PRICE_VALUE"], $i["PROPERTY_CURRENCY_NAME"]
                            );?>
                           <?/*= $i["PRICE"]*/?><!--<br>
                           <span style="color: #EB5019; font-weight:normal; font-size:12px;"> <?/*= denomination($i["PROPERTY_PRICE_VALUE"], $i["PROPERTY_CURRENCY_VALUE"]);*/?></span>
                           <?/*if($i["PROPERTY_CURRENCY_VALUE"] != 62):*/?>
                            <br>
                           <span style="color: #EB5019; font-weight:normal; font-size:12px;"> <?/*= $i["PROPERTY_PRICE_VALUE"] .' '. $i["PROPERTY_CURRENCY_NAME"]*/?></span>
                           --><?/*endif*/?><br>
                           <span><?= $i['PRICE_FOR']?></span>
                        </div>
                        <?endif?>
                        <a href="<?= $i["PAGE"]?>" class="btn btn-primary btn-sm">Подробнее</a>
                     </center>
                     </div>
                  </div>
               </div>

            </div>
         <?endforeach?>
         </div>
      </div>
      <?endif?>

   </div>
</div>
<?if(!empty($scroll)):?>
<div class="col-sm-3 hidden-sm hidden-xs">
   <div class="scrolly scrollspy-sidebar sidebar-detail" role="complementary">
      <ul class="scrollspy-sidenav">
         <li>
            <ul class="nav">
               <?foreach($scroll as $s):?>
               <li><a href="#<?= $s[0]?>" class="anchor"><?= $s[1]?></a></li>
               <?endforeach?>
            </ul>
         </li>
      </ul>
      <a href="#orderModal" data-toggle="modal" class="btn order-btn btn-primary" onclick="ga('send', 'event', 'button', 'click', 'BookTours'); yaCounter1028882.reachGoal('BookTours'); return true;" >Оставить заявку</a>
      <div style="width: 100%; height: 20px;"></div>
		Поделиться туром
		<script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
		<script src="//yastatic.net/share2/share.js"></script>
		<div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,moimir,gplus,twitter,viber,skype,telegram"></div>
      <div style="width: 100%; height: 20px;"></div>
   </div>
</div>
<?endif;
$marker_icon_small = SITE_TEMPLATE_PATH . "/images/map/marker24.png";
?>
<script src="https://maps.google.com/maps/api/js?key=AIzaSyAv847WoGtqUZmTXOakiQFZxOtzGp8oGw8"></script>
<script type="text/javascript">
   $(document).ready(function(){
   	<?if($arResult['transfer']):?>
   		/* map transfer */

         <?if($arResult["PROPERTIES"]["TOURTYPE"]["VALUE"] == Set::AIR || $arResult["PROPERTIES"]["TOURTYPE"]["VALUE"] == Set::EXCURSION_AIR || $arResult["PROPERTIES"]["TOURTYPE"]["VALUE"] == Set::EARLY_BOOKING):?>

            function map_init() {

               if(!document.getElementById('map-area')) return;

               var lat_s = Number('<?=$arResult['transfer']['start'][0]?>'),
                   lan_s = Number('<?=$arResult['transfer']['start'][1]?>'),
                   lat_e = Number('<?=$arResult['transfer']['end'][0]?>'),
                   lan_e = Number('<?=$arResult['transfer']['end'][1]?>'),
               map = new google.maps.Map(document.getElementById('map-area'),{
                  center: {lat: (lat_s + lat_e)/2, lng: (lan_s + lan_e)/2},
                  zoom: 3
               }),
               start = new google.maps.LatLng(lat_s, lan_s),
               end = new google.maps.LatLng(lat_e, lan_e);

               marker = new google.maps.Marker({
                        title: '<?=$arResult['transfer']['start'][2]?>',
                        position: start,
                        map: map,
                        icon: '<?= $marker_icon_small?>'
                     });

               marker.addListener('click', function() {
                           var infowindow = new google.maps.InfoWindow({
                                        content: '<?=$arResult['transfer']['start'][2]?>',
                                      });
                            infowindow.open(map, this);
                          });

               marker = new google.maps.Marker({
                        title: '<?=$arResult['transfer']['end'][2]?>',
                        position: end,
                        map: map,
                        icon: '<?= $marker_icon_small?>'
                     });

               marker.addListener('click', function() {
                  var infowindow = new google.maps.InfoWindow({
                               content: '<?=$arResult['transfer']['end'][2]?>'
                             });
                   infowindow.open(map, this);
                 });

               route = new google.maps.Polyline({
                    path: [start, end],
                    geodesic: true,
                    map: map //устанавливаем на карту
                });

            }

            google.maps.event.addDomListener(window, 'load', map_init);

         <?else:?>

      		function map_init()
      		{
               if(!document.getElementById('map-area')) return;
      			var map = new google.maps.Map(document.getElementById('map-area')),
      				direction_display = new google.maps.DirectionsRenderer(),
      				direction_service = new google.maps.DirectionsService(),
      				start = new google.maps.LatLng(<?=$arResult['transfer']['start'][0]?>, <?=$arResult['transfer']['start'][1]?>),
      				end = new google.maps.LatLng(<?=$arResult['transfer']['end'][0]?>, <?=$arResult['transfer']['end'][1]?>),
      				way = [],
      				marker;

      				direction_display.setMap(map);
      				direction_display.setOptions( { suppressMarkers: true, suppressInfoWindows: true } );

      				<?if($arResult['transfer']['way']):?>
      					<?foreach($arResult['transfer']['way'] as $k => $way):?>

      						way.push({location: new google.maps.LatLng(Number('<?=$way[0]?>'), Number('<?=$way[1]?>'))});
      						marker = new google.maps.Marker({
      								title: '<?=$way[2]?>',
      								position: new google.maps.LatLng(Number('<?=$way[0]?>'), Number('<?=$way[1]?>')),
      								map: map,
                              icon: '<?= $marker_icon_small?>'
      							});


      						 marker.addListener('click', function() {
      						 	var infowindow = new google.maps.InfoWindow({
      									    content: '<?=$way[2]?>'
      									  });
      						    infowindow.open(map, this);
      						  });


      					<?endforeach?>
      				<?endif?>

      					marker = new google.maps.Marker({
      						title: '<?=$arResult['transfer']['start'][2]?>',
      						position: start,
      						map: map,
                        icon: '<?= $marker_icon_small?>'
      					});


      					marker.addListener('click', function() {
      						var infowindow = new google.maps.InfoWindow({
      									    content: '<?=$arResult['transfer']['start'][2]?>'
      									  });
      					    infowindow.open(map, this);
      					  });

      					marker = new google.maps.Marker({
      						title: '<?=$arResult['transfer']['end'][2]?>',
      						position: end,
      						map: map,
                        icon: '<?= $marker_icon_small?>'
      					});


      					marker.addListener('click', function() {
      						var infowindow = new google.maps.InfoWindow({
      									    content: '<?=$arResult['transfer']['end'][2]?>'
      									  });
      					    infowindow.open(map, this);
      					  });

                function calcRoute(start, end, points, startIndex) {
                    var start;
                    var destinationIndex;
                    var destination;

                    if(startIndex + 14 > points.length){
                        start = start;
                        destinationIndex = points.length;
                        destination = end;
                    }
                    else{
                        start = points[startIndex];
                        destinationIndex = startIndex + 14;
                        destination = points[destinationIndex];
                    }

                    var waypoints = [];
                    for (var waypointIndex = startIndex; waypointIndex < destinationIndex; waypointIndex++) {
                        waypoints.push({location: points[waypointIndex]});
                    }

                    direction_service.route(
                        {
                            origin: start,
                            waypoints: waypoints,
                            destination: destination,
                            travelMode: google.maps.TravelMode.DRIVING,
                            unitSystem: google.maps.UnitSystem.METRIC,
                            provideRouteAlternatives: true,
                            avoidHighways: false,
                            avoidTolls: true
                        },
                        function(result, status)
                        {
                            if (status == google.maps.DirectionsStatus.OK)
                            {
                                direction_display.setDirections(result);
                            }
                        }
                    );
                }

                for (var i = 0; i < way.length; i += 14) {
                    calcRoute(start, end, way, i);
                }

                /*function calcRoute(start, end, points, startIndex) {
                 var start;
                 var destinationIndex;
                 var destination;

                 if(startIndex + 14 > points.length - 1){
                 start = start;
                 destinationIndex = points.length - 1;
                 destination = end;
                 }
                 else{
                 start = points[startIndex];
                 destinationIndex = startIndex + 14;
                 destination = points[destinationIndex];
                 }

                 var waypoints = [];
                 for (var waypointIndex = startIndex; waypointIndex < destinationIndex - 1; waypointIndex++) {
                 waypoints.push({location: points[waypointIndex]});
                 }

                 direction_service.route(
                 {
                 origin: start,
                 waypoints: waypoints,
                 destination: destination,
                 travelMode: google.maps.TravelMode.DRIVING,
                 unitSystem: google.maps.UnitSystem.METRIC,
                 provideRouteAlternatives: true,
                 avoidHighways: false,
                 avoidTolls: true
                 },
                 function(result, status)
                 {
                 if (status == google.maps.DirectionsStatus.OK)
                 {
                 direction_display.setDirections(result);
                 }
                 }
                 );
                 }*/

                /*for (var i = 0; i < way.length - 1; i += 14) {
                    calcRoute(start, end, way, i);
                }*/
      		}

      		google.maps.event.addDomListener(window, 'load', map_init);

         <?endif;?>

   	<?elseif(!empty($arResult['point'])):?>
   		/* map point */

         function map_init() {

            if(!document.getElementById('map-area')) return;

      		var map = new google.maps.Map(document.getElementById('map-area'),{
      			center: {lat: <?=$arResult['point'][0][0]?>, lng: <?=$arResult['point'][0][1]?>},
      			zoom: 5
      		});

      		var marker = new google.maps.Marker({
      						title: '<?=$arResult['point'][1]?>',
      						position: {lat: <?=$arResult['point'][0][0]?>, lng: <?=$arResult['point'][0][1]?>},
      						map: map,
                        icon: '<?= $marker_icon_small?>'
      					});

      		marker.addListener('click', function() {
      						var infowindow = new google.maps.InfoWindow({
      									    content: '<?=$arResult['point'][1]?>',
      									  });
      					    infowindow.open(map, this);
      					  });
         }

         map_init();
   	<?endif?>
   });
</script>

<?if($arResult['FOOD_DESC']):?>
<?$this->addExternalCSS("https://cdn.jsdelivr.net/jquery.webui-popover/1.2.1/jquery.webui-popover.min.css")?>
<script src="https://cdn.jsdelivr.net/jquery.webui-popover/1.2.1/jquery.webui-popover.min.js"></script>
<script type="text/javascript">
(function($){
   $('.show-popuver').each(function(){
      var context = $(this).data('context');
      $(this).webuiPopover({content: context,trigger:'hover', placement:'right', width: '300px'});
   });
})(jQuery);

</script>
<?endif?>
