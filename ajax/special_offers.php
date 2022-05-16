<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
try
{
	$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
	
	if(!$request->isPost())
		die();
	
	$ib_id 	 = (int)$request->getPost("ib_id");
	$objects = $request->getPost("objects");
	$cid 	 = (int)$request->getPost("cid");
	
	$allowed = array(
			array(18),
			array(
				'tours' => array(
						'!PROPERTY_SHOW_ON_MAIN_VALUE' => false,
						"!PROPERTY_TOURTYPE" => 484,
						">=PROPERTY_DEPARTURE" => date('Y-m-d')
						),
				'hotels' => array(
				  				"!PROPERTY_SHOW_ON_MAIN_VALUE" => false,
				  				"PROPERTY_TOURTYPE" => 484
				  			)
			)
		);

	if(!in_array($objects, array_keys($allowed[1])) || !in_array($ib_id, $allowed[0]))
		throw new \Exception();

	\Bitrix\Main\Loader::includeModule("iblock");

	$filter = array("IBLOCK_ID" => $ib_id);
	
	if($cid > 0)
		$filter['PROPERTY_COUNTRY'] = $cid;
	
	$filter = array_merge($filter, $allowed[1][$objects]);

	$els = CIBlockElement::GetList(
			array('SORT' => 'ASC'),
			$filter,
			false,
			array('nTopCount' => 8),
			array(
					"ID",
					"NAME",
					"DETAIL_PICTURE",
					"PROPERTY_DAYS", 
					"PROPERTY_PRICE", 
					"PROPERTY_CURRENCY",
					//"PROPERTY_CURRENCY.NAME",
					"DETAIL_PAGE_URL",
					"PREVIEW_PICTURE",
					"PROPERTY_PICTURES",
					"PROPERTY_COUNTRY",
					"PROPERTY_TOWN",
					"PROPERTY_DEPARTURE",
					"PROPERTY_PRICE_FOR",
					"PROPERTY_TOUR_TYPE",
					"PROPERTY_DISCOUNT",
					"PROPERTY_NEW"
			)
		);

	while($el = $els->GetNext())
	{
		$el['PROPERTY_PICTURES_VALUE'] = (array)$el['PROPERTY_PICTURES_VALUE'];

		if($el['PREVIEW_PICTURE'] > 0)
			$pic = $el['PREVIEW_PICTURE'];
		else
			$pic = $el['PROPERTY_PICTURES_VALUE'][0];

		$f = CFile::ResizeImageGet($pic, array('width'=>600, 'height'=>400), BX_RESIZE_IMAGE_EXACT, true);
	
		if($f["src"] == "")
			$f["src"] = SITE_TEMPLATE_PATH . "/images/nophoto.jpg";

		?>
			
				<div class="filtering-item GridLex-col-3_sm-6_xs-12 mb-30 <?= $d_g?>">
					<div class="package-grid-item"> 
						<a href="<?= $el["DETAIL_PAGE_URL"]?>">
							<div class="image">
								<img src="<?= $f["src"]?>" alt="<?= $el["NAME"]?>">
								<?$p = array(
											"DISCOUNT" => array('VALUE' => $el["PROPERTY_DISCOUNT_VALUE"]),
											"TOUR_TYPE" => array('VALUE' => $el["PROPERTY_TOUR_TYPE_VALUE"]),
											"NEW" => array('VALUE' => $el["PROPERTY_NEW_VALUE"])
										);
								echo printTourLabel($p);
								?>
								<?if($el['PROPERTIES']['DAYS']['VALUE']):?>
								<div class="absolute-in-image">
									<div class="duration"><span><?= w($el['PROPERTIES']['DAYS']['VALUE'])?> / <?= w($el['PROPERTIES']['DAYS']['VALUE'], 2)?></span></div>
								</div>
								<?endif?>
							</div>
							<div class="content clearfix">
								<?$title = $el['NAME'];
								$el['NAME'] = strlen($el['NAME']) > 37 ? substr($el['NAME'], 0, 38) . '...' : $el['NAME'];?>
								<h5 style="min-height: 40px; margin: 0" title="<?= $title?>"><?= $el["NAME"]?></h5>
								<?if((int)$el["PROPERTY_PRICE_VALUE"] > 0):?>

								<!-- content-text -->
								<div class="content-text"><?
									$el["PROPERTY_DEPARTURE_VALUE"] = (array)$el["PROPERTY_DEPARTURE_VALUE"];
									$res = array();
									if(!empty($el["PROPERTY_DEPARTURE_VALUE"]))
									{

										foreach($el["PROPERTY_DEPARTURE_VALUE"] as $k => $t)
										{
											if(($k + 1) > 3) break;
											$res[] = ConvertDateTime($t, "DD.MM.YYYY", "ru");
										}
									}	 
										echo implode(',', $res).'<br>';
									
									$res = array();
									$el["PROPERTY_COUNTRY_VALUE"] = (array)$el["PROPERTY_COUNTRY_VALUE"];
									if(!empty($el["PROPERTY_COUNTRY_VALUE"]))
									{
										$arr = CIBlockElement::GetByID(current($el["PROPERTY_COUNTRY_VALUE"]))->Fetch();
										$res[] = $arr['NAME'];
									}
									$el["PROPERTY_TOWN_VALUE"] = (array)$el["PROPERTY_TOWN_VALUE"];
									if( !empty($el["PROPERTY_TOWN_VALUE"]) )
									{
										$arr = CIBlockElement::GetByID(current($el["PROPERTY_TOWN_VALUE"]))->Fetch();
										$res[] = $arr['NAME'];
									}
									echo implode(", ", array_map(function($it){ return strip_tags($it); }, $res)); ?>
								
								</div>

								<div style='top: -50px' class="absolute-in-content">
									<!--span class="btn"><i class="fa fa-heart-o"></i></span-->
									<div class="price" style="line-height:12px;">
									<span style="font-weight:normal; font-size:12px;">от</span> <?= convert_currency($el["PROPERTY_PRICE_VALUE"], $el["PROPERTY_CURRENCY_VALUE"]);?>
										<?if($el["PROPERTY_CURRENCY_VALUE"] != 62):?>
										<?$currency = CIBlockElement::GetByID($el["PROPERTY_CURRENCY_VALUE"])->Fetch();?>
										<span style="font-weight:normal; font-size:12px;"> (<?= $el["PROPERTY_PRICE_VALUE"] .' '. $currency['NAME']?>)</span>
										<?endif?><br>
										<span style="font-weight:normal; font-size:12px;"><?= $el['PROPERTY_PRICE_FOR_VALUE']?></span>
									</div>
								</div>
								<?endif?>
							</div>
						</a>
					</div>
				</div>
			
		<?
	}

	die();
	
} catch(\Exception $e) {
	die();
}