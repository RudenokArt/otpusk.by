<?

include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/captcha.php");

$arOffices = Array(
	"onlineck2010@yandex.by" => "Выберите ближайший офис",
    "sale@ck.by, onlineck2010@yandex.by" => "Минск, Мясникова, 39",
    "vitebsk@ck.by, onlineck2010@yandex.by" => "Витебск",
    "gomel@ck.by, onlineck2010@yandex.by" => "Гомель",
    "mogilev@ck.by, onlineck2010@yandex.by" => "Могилёв",
);

if (!$form_name)
    $form_name = "Оставить заявку на тур";

if ($_SERVER['REQUEST_METHOD'] == "POST" && check_bitrix_sessid() && $_POST['makeorder'] == 'makeorder') {
    $o_f = $_POST['ORDER'];

    $err = array();

    $in_name = htmlspecialchars($o_f['NAME']);
    $in_phone = htmlspecialchars($o_f['PHONE']);
    $in_email = htmlspecialchars($o_f['EMAIL']);
    $in_text = htmlspecialchars($o_f['TEXT']);
    $in_captcha = htmlspecialchars($o_f['CAPTCHA']);
    $in_antispam = htmlspecialchars($o_f['ARE_YOU_REAL']);
    $in_email_to = htmlspecialchars("reklama@ck.by");

    if ($in_name == "")
        $err[] = "Введите имя";
    if ($in_phone == "")
        $err[] = "Введите телефон";
    if ($in_email == "")
        $err[] = "Введите email";
    if ($in_antispam != "")
        $err[] = "error";
    if (!$APPLICATION->CaptchaCheckCode($in_captcha, $o_f['CAPTCHA_SID']))
        $err[] = "Введите капчу";

	if (empty($err)) {
			if(!empty($additional_info))
				extract($additional_info);
			$queryUrl = 'https://bitrix.vetliva.by/rest/25270/nt6hm7xvb08l79te/crm.lead.add.json'; 
			$queryData = http_build_query(array( 'fields' => array(
				"TITLE" => "Оставлена заявка на " . $name . " на otpusk.by", 
				"NAME" => $in_name, 
				"PHONE" => array(array('VALUE' => $in_phone, 'VALUE_TYPE' => 'HOME')), 
				"EMAIL" => array(array("VALUE" => $in_email, "VALUE_TYPE" => "HOME")), 
				"COMMENTS" => $in_text,
				"UF_CRM_1553606214" => "https://otpusk.by" . $_SERVER['REQUEST_URI'], 
				"OPENED" => "Y", 
				"ASSIGNED_BY_ID" => 287, // ид-ик пользователя в crm
				//"UF_CRM_1562920845" => $arOffices[$in_email_to], 
				'params' => array("REGISTER_SONET_EVENT" => "Y") 
			))); 
			
			//Главное - сформировать данные для запроса.
			$curl = curl_init(); 
			curl_setopt_array($curl, array( 
				CURLOPT_SSL_VERIFYPEER => 1, 
				CURLOPT_POST => 1, 
				CURLOPT_HEADER => 0, 
				CURLOPT_RETURNTRANSFER => 1, 
				CURLOPT_URL => $queryUrl, 
				CURLOPT_POSTFIELDS => $queryData, 
			)); 
			$result = curl_exec($curl);
			curl_close($curl); 
			$result = json_decode($result, 1);  
			if(array_key_exists('error', $result))
				$err[] = "Ошибка при сохранении лида: ".$result['error_description']."";
	}


    if (empty($err)) {
        \Bitrix\Main\Loader::includeModule('iblock');

        $el = new CIBlockElement;

        $res = $el->Add(array(
            "NAME" => $in_name ,
            "CODE" => CUtil::translit($in_name, "ru"),
            "IBLOCK_ID" => Set::ORDER_IBLOCK_ID,
            "PROPERTY_VALUES" => array(
                "125" => $in_phone,
                "126" => $in_email,
                "129" => $_SERVER['HTTP_REFERER'],
                "253" => $in_text,
				//"459" => $arOffices[$in_email_to]
                //"254" => $arResult['ID']
            )
        ));

        if ($res) {
            $_SESSION['ORDER_MAKE_OK'] = true;

            //send mail
            if(empty($in_email_to)){
                $in_email_to = "sale@ck.by";
            }
            CEvent::Send(Set::MAIL_EVENT_ORDER_TEMPLATE, SITE_ID, array("IBLOCK_ID" => Set::ORDER_IBLOCK_ID, "ID" => (int)$res, "LINK" => $_SERVER['HTTP_REFERER'], "NAME" => $in_name, "PHONE" => $in_phone, "COMMENT" => $in_text, "EMAIL_TO" => $in_email_to, "OFFICE" => $arOffices[$in_email_to], "EMAIL" => $in_email), "", Set::MAIL_ORDER_TEMPL_ID);

            LocalRedirect($APPLICATION->GetCurDir());
        } else
            $err[] = "Произошла ошибка при формировании заказа. <br> Error: " . $el->LAST_ERROR . ". <br> Обратитесь к администрации сайта";
    }

}


if ($_SESSION['ORDER_MAKE_OK']) {
    $message_ok = "Спасибо! Ваша заявка принята и будет рассмотрена.";
    unset($_SESSION['ORDER_MAKE_OK']);
}
?>
<? if(!empty($message_ok) || !empty($err)): ?>
    <script type="text/javascript">
        window.onload = function() {
			$('#orderModal').modal('show');
			var curUrl = document.location.toString();
			if(curUrl.indexOf("/sanatorii/") != -1) {
				yaCounter1028882.reachGoal('ostavit-zayavku-v-sanatorij-forma',{URL: document.location.href});
			} else if(curUrl.indexOf("/tury/") != -1) {
				yaCounter1028882.reachGoal('ostavit-zayavku-na-tur-forma',{URL: document.location.href});
			} else if(curUrl.indexOf("/oteli/") != -1) {
				yaCounter1028882.reachGoal('ostavit-zayavku-v-otel-forma',{URL: document.location.href});
			}
		}
    </script>
<? endif; ?>

<style>
    .are-you-real {
        display: none;
    }
</style>
<!-- BEGIN # MODAL LOGIN -->
<div class="modal fade modal-login modal-border-transparent" id="orderModal" tabindex="-1" role="dialog"
     aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">

            <button type="button" class="btn btn-close close" data-dismiss="modal" aria-label="Close">
                <i class="fa fa-close fa-fw" aria-hidden="true"></i>
            </button>

            <div class="clear"></div>

            <!-- Begin # DIV Form -->
            <div id="modal-order-form-wrapper">

                <form method="post" action="<?= POST_FORM_ACTION_URI ?>">
                    <?= bitrix_sessid_post() ?>
                    <input type="text" name="ORDER[ARE_YOU_REAL]" class="are-you-real">
                    <div class="modal-body pb-5">

                        <? if (!empty($additional_info)): extract($additional_info); ?>
                            <div class="text-center heading mt-10"
                                 style="font-weight: 700;font-size:25px; margin-bottom:15px"><?= $form_name ?></div>
                            <ul class="tour-info mb-20">
                                <li style="text-align: center; font-size: 16px;"><strong><?= $name ?></strong></li>
                                <? if ($duration): ?>
                                    <li><strong>Продолжительность</strong>: <?= $duration ?></li><? endif ?>
                                <? if ($dates): ?>
                                    <li><strong>Дата выезда</strong>: <?= implode(', ', $dates) ?></li><? endif ?>
                                <? if ($food): ?>
                                    <li><strong>Питание</strong>: <?= $food ?></li><? endif ?>
                                <? if ($price): ?>
                                    <li><strong>Стоимость(взр.)</strong>
                                    : <?= $price ?><? if ($source_price != ""): ?> (<?= $source_price ?>)<? endif ?>
                                    </li><? endif ?>
                                <? if ($price_child): ?>
                                    <li><strong>Стоимость(реб.)</strong>
                                    : <?= $price_child ?><? if ($source_price_child != ""): ?> (<?= $source_price_child ?>)<? endif ?>
                                    </li><? endif ?>
                            </ul>
                        <? else: ?>
                            <div class="text-center heading mt-10 mt-20"
                                 style="font-weight: 700;font-size:25px; margin-bottom:15px"><?= $form_name ?></div>
                        <? endif ?>

                        <? if (!empty($err))
                            ShowError(implode("<br />", $err)); ?>

                        <? if ($message_ok)
                            ShowMessage(array("TYPE" => "OK", "MESSAGE" => $message_ok)); ?>

                        <div class="form-group">
                            <input <? if ($in_name): ?>value="<?= $in_name ?>"<? endif ?> required name="ORDER[NAME]"
                                   class="form-control" type="text" placeholder="Имя">
                        </div>

                        <div class="form-group">
                            <input <? if ($in_phone): ?>value="<?= $in_phone ?>"<? endif ?> required name="ORDER[PHONE]"
                                   class="form-control" type="text" placeholder="Телефон">
                        </div>

                        <div class="form-group">
                            <input <? if ($in_email): ?>value="<?= $in_email ?>"<? endif ?> required name="ORDER[EMAIL]"
                                   class="form-control" type="email" placeholder="Email">
                        </div>

                        <div class="form-group">
                            <textarea rows="5" placeholder="Комментарий" class="form-control"
                                      name="ORDER[TEXT]"><? if ($in_text): ?><?= $in_text ?><? endif ?></textarea>
                        </div>


                        <div class="form-group">
							<? $cpt = new CCaptcha();
								$cpt->SetCodeLength(6);  //устанавливаем длину кода на картинке
								$cpt->SetCode();
								$code=$cpt->GetSID();
							/*$code = $APPLICATION->CaptchaGetCode();*/ ?>
                            <img src="/bitrix/tools/captcha.php?captcha_sid=<?= $code; ?>" alt="CAPTCHA"
                                 style="margin-b"/>
                            <? // Скрытое поле капчи?>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="ORDER[CAPTCHA_SID]" value="<?= $code; ?>"/>
                            <? // Поле для ввода капчи пользователем?>
                            <input <? if ($in_captcha): ?>value="<?= $in_captcha ?>"<? endif ?> required type="text"
                                   class="form-control" placeholder="Капча" name="ORDER[CAPTCHA]"/>
                        </div>

                    </div>

                    <div style='border: none; padding-top: 0' class="modal-footer mt-10">

                        <div class="row gap-10">
                            <div style='margin-left: 25%' class="col-xs-6 col-sm-6 mb-10">
                                <button type="submit" name="makeorder" value="makeorder"
                                        class="btn btn-primary btn-block">Заказать
                                </button>
                            </div>
                        </div>

                    </div>

                </form>


            </div>
            <!-- End # DIV Form -->
        </div>
    </div>
</div>
<!-- END # MODAL LOGIN -->