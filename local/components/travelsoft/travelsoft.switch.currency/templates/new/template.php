<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if (empty($arResult['CURRENCY'])) return;
?>

<form id="<?= $arResult['CURRENCY_FORM_ID'] ?>"
      action="<?= $APPLICATION->GetCurPageParam("", array("currency"), false) ?>" method="get">
    <select name="currency">
        <? foreach ($arResult['CURRENCY'] as $id => $arCurrency) : ?>
            <? if ($arCurrency['iso'] == "RUB" && isset($_SESSION["current_currency"])) $price_type = '1'; else $price_type = htmlspecialchars($_GET["price_type"]); ?>
            <? /*<option data-url="<?= $APPLICATION->GetCurPageParam("currency=" . $arCurrency['iso'] . $price_type , array("currency","price_type"), false)?>" <?if ($id == $arResult['CURRENT_CURRENCY']['id']):?><? echo "selected";?> class="select_currency" <?endif?> value="<?= $arCurrency['iso']?>"><?= $arCurrency['iso']?></option>*/ ?>
            <option data-currency="<?= $arCurrency['iso'] ?>"
                    data-price_type="<?= $price_type ?>" <? if ($id == $arResult['CURRENT_CURRENCY']['id']): ?><? echo "selected"; ?> class="select_currency" <? endif ?>
                    value="<?= $arCurrency['iso'] ?>"><?= $arCurrency['iso'] ?></option>
        <? endforeach; ?>
    </select>
</form>
<script>
    function updateQueryStringParam(key, value) {
        baseUrl = [location.protocol, '//', location.host, location.pathname].join('');
        urlQueryString = document.location.search;
        var newParam = key + '=' + value,
            params = '?' + newParam;

        // If the "search" string exists, then build params from it
        if (urlQueryString) {
            keyRegex = new RegExp('([\?&])' + key + '[^&]*');
            // If param exists already, update it
            if (urlQueryString.match(keyRegex) !== null) {
                params = urlQueryString.replace(keyRegex, "$1" + newParam);
            } else { // Otherwise, add it to end of query string
                params = urlQueryString + '&' + newParam;
            }
        }
        window.history.replaceState({}, "", baseUrl + params);
    }

    $("#<?= $arResult['CURRENCY_FORM_ID']?> select").on("change", function () {
        var option = $(this).find("option[value='" + $(this).val() + "']");

        updateQueryStringParam("currency", option.data("currency"));
        updateQueryStringParam("price_type", option.data("price_type"));
        window.location.href = document.location;

        //window.location.href = $(this).find("option[value='"+$(this).val()+"']").data("url");
    })
</script>
<style>
    select {
        border: 2px solid #004991;
        background-color: white;
        color: #004991;
    }

    .select_currency {
        background-color: #EB5019;
        color: white;
    }
</style>
