<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
if ($arResult['id'] < 0) return;
?>
<?\Bitrix\Main\Loader::includeModule('travelsoft.currency');
$currency = \Bitrix\Main\Web\Json::encode(\travelsoft\Currency::getInstance()->get('currency'));
$current_currency = \Bitrix\Main\Web\Json::encode(\travelsoft\Currency::getInstance()->get('current_currency'));
$currency_format_decimals = \Bitrix\Main\Config\Option::get('travelsoft.currency', 'currency_format_decimals');
$currency_format_dec_point = \Bitrix\Main\Config\Option::get('travelsoft.currency', 'currency_format_dec_point');
$currency_format_thousands_sep = \Bitrix\Main\Config\Option::get('travelsoft.currency', 'currency_format_thousands_sep');?>
<div class="rooms-txt">
	Результат поиска: заезд с <?= $arResult['CheckIn']?> по <?= $arResult["CheckOut"]?>, взрослых - <?= $arResult['Adults']?>, детей - <?= $arResult['Children']?>
</div>

<div class="rooms"><img style="margin: 0 auto;width: 100px; height: 100px" src="<?= Set::SMALL_PRELOADER?>"></div>

<script type="text/javascript" src="<?= $componentPath?>/js/sort.js"></script>
<script type="text/javascript" src="<?= $componentPath?>/js/search.js"></script>
<script type="text/javascript" src="<?= $componentPath?>/js/filter.js"></script>

<script src="https://cdn.jsdelivr.net/jquery.webui-popover/1.2.1/jquery.webui-popover.min.js"></script>

<?$this->addExternalCSS("https://cdn.jsdelivr.net/jquery.webui-popover/1.2.1/jquery.webui-popover.min.css")?>

<script type="text/javascript">

    var currency = JSON.parse('<?=$currency?>'), current_currency = JSON.parse('<?=$current_currency?>'), currency_format_decimals = '<?=$currency_format_decimals?>', currency_format_dec_point = '<?=$currency_format_dec_point?>', currency_format_thousands_sep = '<?=$currency_format_thousands_sep?>';

    function convertCurrency(price=null, in_currency=null, out_currency=null, onlyN=null) {

        if(in_currency == null || in_currency.match(/^\d+$/) === null){
            in_currency = find(in_currency);
        } else {
            in_currency = currency[in_currency]['id'];
        }
        if (out_currency == null) {
            out_currency = Number(current_currency['id']);
        }
        console.log(price, in_currency, out_currency);
        price = price/currency[in_currency]['course'][currency[out_currency]['iso']];
        if (onlyN)
            return price;

        return format(price, currency[out_currency]['iso']);
    }

    function find(find) {

        if (typeof currency[find] !== "undefined") {
            return true;
        } else {
            for (var val in currency) {
                if (currency[val]['iso'] == find) {
                    find = currency[val]['id'];
                    return Number(find);
                }
            }
        }

        return false;
    }

    function format(price,out_currency) {

        return $.number_format(
            price,
            currency_format_decimals,
            currency_format_dec_point,
            currency_format_thousands_sep == "" ? " " : currency_format_thousands_sep
        ) + " " + out_currency;

    }

	/**
	* searchObject: placements - поиск размещений по городу, стране и т.д
	*				rooms - поиск размещений по конкретному объекту
	*/
	<?
	if($arResult['CORPUSES'])
		$mtids = array_keys($arResult['CORPUSES']);
	$mtids[] = (int)$arResult['id'];
	$arCorpuses = \Bitrix\Main\Web\Json::encode($arResult['CORPUSES']);
	?>
	var mtids = <?echo \Bitrix\Main\Web\Json::encode($mtids);?>;
	$.Search({
		searchObject: "rooms",
		parameters: {
			searchId: <?= $arResult['searchId']?>,
			id: mtids,
			cid: 0,
			CheckIn: "<?= $arResult['CheckIn']?>",
			CheckOut: "<?= $arResult['CheckOut']?>",
			Adults: <?= $arResult['Adults']?>,
			Children: <?= $arResult['Children']?>,
			priceType: <?= $arResult['price_type'] ?>
		},
		queryAddress: "<?= $arResult['queryAddress']?>",
		renderResult: function (data) {

			if (data === false){
                $('.rooms').html('Не удалось найти доступные варианты по заданным Вами параметрам. Вы можете <a href="#orderModal" data-toggle="modal" class="order-btn">оставить заявку на подбор тура</a>.');
                /*$('.rooms').text('Не удалось найти доступные варианты по заданным Вами параметрам. Вы можете <a href="#orderModal" data-toggle="modal" class="btn order-btn btn-primary">оставить заявку на подбор тура</a>');*/
				/*$('.rooms').text('Ничего не найдено');*/
				return;
			}

			
			$.ajax({
				method: "post",
				url: "/ajax/get_service_info.php",
				data: {query_data: JSON.stringify(data)},
				dataType: 'json',
				success: function (services) {
					//console.log(services);
					if (typeof services['items'] === 'undefined')
						services['items'] = [];

					var i, k, k2, templ = "", men = 0, menHtml = "", serv1Html = serv2Html = "", rid = 0, img = '', cancellation, variants = [], dataCnt = 0, mt_id, variantsCnt = 0, sortData = [], cancellations = {};

					dataCnt = data.length;

					if (typeof services.cancellations !== 'undefined')
						cancellations = services.cancellations;

					// prepare sort data
					for(i = 0; i < dataCnt; i++) {

						cancellation = "";
						if (typeof cancellations[data[i].id] !== "undefined") {
							cancellation = cancellations[data[i].id].CANCELLATION;
						}

						variants = data[i].rooms[0].variants;

						variantsCnt = variants.length;

						for(k = 0; k < variantsCnt; k++) {

                            var order_info = '';
                            order_info += 'Заезд с ' + '<?= $arResult['CheckIn']?>' + ' по ' + '<?= $arResult['CheckOut']?>' + '; ';
                            order_info += 'Взрослых: ' + '<?= $arResult['Adults']?>' + ' Детей: ' + '<?= $arResult['Children']?>' + '; ';
                            order_info += 'Размещение: ' + variants[k].room_title + ' ' + variants[k].room_category + '; ';
                            order_info += 'Питание: ' + variants[k].pansion_title + '; ';
                            order_info += 'Стоимость: ' + variants[k].price.BYN + ' BYN;';

							men = variants[k].adult + variants[k].child;
							
							menHtml = "";
							for (var v = 1; v <= men; v++) {
								menHtml += '<i class="fa fa-user"></i>';
							}
							
							if (men > 4)
								menHtml += '<i class="fa fa-user-plus"></i>';

							rid = variants[k].room_title_id + "_" + variants[k].room_category_id + '_' + data[i].id;

							img = '/bitrix/templates/main/images/nophoto.jpg';

							serv1Html = ""; serv2Html = "", corpName = "";

							mt_id = <?= $arResult['id']?>;

							if (typeof services['items'][rid] !== 'undefined') {
								
								cServ = services['items'][rid];
								if (typeof cServ.picture !== 'undefined')
									img = cServ.picture.src;

								
								if (typeof cServ.service !== 'undefined') {
									for (k2 in cServ.service[0]) {
										serv1Html += '<span><i class="fa '+ cServ.service[0][k2].class +'"></i> '+cServ.service[0][k2].name+'</span>';
									}
									for (k2 in cServ.service[1]) {
										serv2Html += '<span><i class="fa fa-check"></i> '+cServ.service[1][k2]+'</span>';
									}
								}

								if (typeof cServ.mt_id !== "undefined" && cServ.mt_id > 0) {
									mt_id = cServ.mt_id;
								}
								
								if (cServ.corpuse_name)
									corpName = '<span class="corpuse-name">' +  cServ.corpuse_name + "</span>";

							}

							sortData.push({
								img: img,
								corpName: corpName,
								roomTitle: variants[k].room_title + ' ' + variants[k].room_category,
								accommodation: (typeof variants[k].accommodation !== 'undefined') ? ("<span class='accommodation'>" + variants[k].accommodation + "</span>") : "",
								serv1Html: serv1Html,
								serv2Html: serv2Html,
								menHtml: menHtml,
								cancellation: cancellation,
								pansion_title: variants[k].pansion_title,
								price: variants[k].price.BYN,
								prices: variants[k].price,
								mtIDValue: mt_id +'_'+variants[k].variant_id,
                                name: '<?=$arParams["OBJECT_NAME"]?>',
                                order_info: order_info
							});
						}
					}

					///////////////////////////////////////////////
					// 		  MAKE JS SORTING OF ELEMENTS 		 //
					///////////////////////////////////////////////
					var sortData = new TSSorter(sortData).cSort('price', 'asc');

					dataCnt = sortData.length;

					for(k = 0; k < dataCnt; k++) {
						data = sortData[k];
						templ += '<li class="availabily-content clearfix">' +  
									'<div class="nomer-photo">' + 
										'<span class="availabily-heading-label">Фото:</span>' +  
										'<img src="'+ data.img +'">' +  
									'</div>' +
									'<div class="nomer-desc">' +
										'<span class="availabily-heading-label">Тип размещения:</span> ' + data.corpName +
										'<span class="room-name">' + data.roomTitle + '</span>' + data.accommodation + 
										'<div class="room-primary-serv">' + data.serv1Html +
										'</div> ' +
										'<hr>' +
										'<div class="room-secondary-serv">' + data.serv2Html +
										'</div> '+

									'</div> '+
									'<div class="capacity"> '+
										'<span class="availabily-heading-label">Вместимость:</span> '+
										'<span class="max-room-people">'+data.menHtml+'</span> '+
									'</div> '+
									'<div class="additional"> '+
										'<span class="availabily-heading-label">Примечания:</span> '+
										'<div class="content"> '+
											'<span><i class="fa fa-hand-o-right" style="font-size:1em"></i> <a data-context=\''+data.cancellation+'\' href="#" class="cancellation">'+ 'Условия отмены</a> </span> '+
											'<span><i class="fa fa-hand-o-right" style="font-size:1em"></i> Питание: '+ data.pansion_title +'</span> '+
										'</div> '+
									'</div> '+

									'<div class="book"> '+
										'<center>' +
											'<div class="pricing"> '+
                                                '<span class="amount">' + data.prices[current_currency['iso']] + ' <span class="iso">' + current_currency['iso'] + '</span></span>' +
												//'<span class="amount">' + data.price + ' <span class="iso">BYN</span></span>' +
												'<p>за номер</p> '+
											'</div> '+
                                            '<div class="block-order-form"><a data-name="'+ data.name +'" data-info="' + data.order_info + '" href="#orderModalNew" data-toggle="modal" class="order-btn order-link">Оставить заявку</a></div><br>' +
											'<form action="<?= POST_FORM_ACTION_URI?>" method="post">' +
											'<?= bitrix_sessid_post()?>' +
											'<input type="hidden" name="PRODUCT[ID]" value="'+ data.mtIDValue+'">' + 
											'<input type="hidden" name="PRODUCT[NAME]" value="<?= $arParams['PLACEMENT_NAME']?>">' + 
											'<input type="hidden" name="PRODUCT[ROOM_NAME]" value="'+data.roomTitle+'">' +
											'<input type="hidden" name="PRODUCT[CHECK_IN]" value="<?= $arResult['CheckIn']?>">' + 
											'<input type="hidden" name="PRODUCT[CHECK_OUT]" value="<?= $arResult['CheckOut']?>">' + 
											'<input type="hidden" name="PRODUCT[PEOPLE]" value="<?= $arResult['Adults'] + $arResult['Children']?>">' + 
											'<input type="hidden" name="PRODUCT[PRICE]" value="'+data.price+'">' + 
											'<input type="hidden" name="PRODUCT[CURRENCY]" value="BYN">' +
											'<button type="submit" name="baction" value="add2cart" class="btn btn-primary btn-sm btn-inverse">Бронировать</button>' +
											'</form>' +
										'</center> ' +
									'</div> '+
								'</li>';

					}
					
					if (templ != "") {

						templ = '<ul class="availabily-list"> ' +
									'<li class="availabily-heading clearfix"> '+
										'<div class="nomer-photo">Тип размещения</div> '+
										'<div class="nomer-desc"></div> '+
										'<div class="capacity"> '+
											'<center>Max</center> '+
										'</div> '+
										'<div class="additional">Примечания</div> '+
										'<div class="book"> '+
											'<center>Цена <img style="width:60px" src="/bitrix/templates/main/images/pay_card.png"></center> '+
										'</div> '+
									'</li> '+ templ + '</ul>';


						$('.rooms').html(templ);

						$('.cancellation').each(function(){
						      var context = $(this).data('context');

						      $(this).webuiPopover({content: context,trigger:'click', placement:'top'});
						   });

					}

				}

			});

		}

			
	});

</script>