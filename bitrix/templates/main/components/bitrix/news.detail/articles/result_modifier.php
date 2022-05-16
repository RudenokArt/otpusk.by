<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//dm($arResult['PROPERTIES']);

$props = $arResult['DISPLAY_PROPERTIES'];

if(!empty($props['ARTICLE']['LINK_ELEMENT_VALUE']))
{
	$arResult['articles'] = array();
	foreach($props['ARTICLE']['LINK_ELEMENT_VALUE'] as $a)
		$arResult['articles'][] = array('NAME' => $a['NAME'], "CODE" => $a['CODE']);
}

$arResult['right_menu'] = array();
if($arResult['PROPERTIES']['COUNTRY']['VALUE'] > 0)
	$p_n = "COUNTRY";
else
	if($arResult['PROPERTIES']['TOWN']['VALUE'] > 0)
		$p_n = "TOWN";

if($p_n)
{
	$val = (int)$arResult['PROPERTIES'][$p_n]['VALUE'];
	$res = setALLFieldsAndProps($arResult['PROPERTIES'][$p_n]['VALUE'], $f, $p);;
	$arResult['right_menu'][] = array('NAME' => $f['NAME'], "PAGE" => $f['DETAIL_PAGE_URL']);

	// ещё статьи по родителю
	$articles = getAdditionalElements(array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "!=ID" => $arResult['ID'], "PROPERTY_COUNTRY" => $val));

	if($articles)
	{
		$sef_folder = substr(__DIR__, strlen($_SERVER['DOCUMENT_ROOT']), strlen(__DIR__));
		foreach($articles as $id => $a)
		{
			$arResult['right_menu'][] = array('NAME' => $a['NAME'], "PAGE" => $arParams['SEF_FOLDER'] . makeLinks($id, false));
		}
	}
}

// Туры
$arResult['offers'] = getAdditionalElements_for_articles($arResult['PROPERTIES'], "TF_", Set::SPECIAL_OFF_IBLOCK_ID);

// Размещения
$arResult['hotels'] = getAdditionalElements_for_articles($arResult['PROPERTIES'], "OF_", Set::HOTELS_IBLOCK_ID);

// Авиабилеты
$arResult['avia'] = getAdditionalElements_for_articles($arResult['PROPERTIES'], "AF_", Set::AVIA_IBLOCK_ID);


// id для формы поиска
if ($arResult['PROPERTIES']['COUNTRY']['VALUE'] > 0) {
	$db = CIBlockElement::GetByID($arResult['PROPERTIES']['COUNTRY']['VALUE'])->GetNextElement();
	$p = $db->GetProperties();
	//if ($p['TI_KEY']['VALUE'] > 0)
		$arResult['TI_KEY'] = $p['TI_KEY']['VALUE'];
}

$arResult['city'] = array();
$db_res = CIBlockElement::GetList(array(), array("IBLOCK_ID" => Set::CITY_IBLOCK_ID, "ACTIVE" => "Y", "!=PROPERTY_TI_KEY" => false), false, false, array("ID", "NAME", "PROPERTY_TI_KEY"));
while($ob = $db_res->GetNext()){
    $arResult['city'][$ob["ID"]] = array(
        "ID" => $ob["ID"],
        "NAME" => $ob["NAME"],
        "TOURINDEX" => $ob["PROPERTY_TI_KEY_VALUE"]
    );
}
$arResult['city_'] = null;

    $db_res = CIBlockElement::GetList(false, array("IBLOCK_ID" => Set::SEARCHFILTER_IBLOCK_ID, "ACTIVE" => "Y", "PROPERTY_COUNTRY" => (int)$arResult['PROPERTIES']['COUNTRY']['VALUE']), false, false, array("ID","PROPERTY_CITYFROM"));
    while ($ob = $db_res->GetNext()) {
        if (isset($arResult['city'][$ob["PROPERTY_CITYFROM_VALUE"]]) && !empty($arResult['city'][$ob["PROPERTY_CITYFROM_VALUE"]]["TOURINDEX"])) {
            $arResult['city_'] = $arResult['city'][$ob["PROPERTY_CITYFROM_VALUE"]]["TOURINDEX"];
            break;
        }
    }

$this->__component->SetResultCacheKeys($arResult["DISPLAY_PROPERTIES"]["CANONICAL"]["DISPLAY_VALUE"]);