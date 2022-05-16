<?
@define("NOT_FLOAT_RIGHT", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?>
<?
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;
CModule::IncludeModule("highloadblock");
$hb = Set::GETDATESFORFILTR;
$entity_table_name = $hlblock['GETDATESFORFILTR'];
$arResultBlock = array();
$hlblock = HL\HighloadBlockTable::getById($hb)->fetch();
$entity = HL\HighloadBlockTable::compileEntity($hlblock);
$entity_data_class = $entity->getDataClass();
dm($entity_data_class);
$sTableID = 'b_'.$entity_table_name;
$rsData = $entity_data_class::getList(array('filter'=>array('UF_TOURTYPE_ID'=>12)));
$rsDataCount = $rsData->getSelectedRowsCount();
echo $rsDataCount;
if($rsDataCount > 0){
    while($arRes = $rsData->fetch()){

        $date = unserialize($arRes["UF_DATES"]);
        if(!isset($arResultBlock[$arRes["UF_CITYFROM_ID"]][$arRes["UF_COUNTRY_ID"]]))
            $arResultBlock[$arRes["UF_COUNTRY_ID"]][$arRes["UF_COUNTRY_ID"]][1000] = array();
        $arResultBlock[$arRes["UF_CITYFROM_ID"]][$arRes["UF_COUNTRY_ID"]][1000] = array_merge($arResultBlock[$arRes["UF_CITYFROM_ID"]][$arRes["UF_COUNTRY_ID"]][1000], $date);
        $gg = array_unique($arResultBlock[$arRes["UF_CITYFROM_ID"]][$arRes["UF_COUNTRY_ID"]][1000]);
        array_walk($gg, function (&$item) {
            $item = MakeTimeStamp((string)$item, "DD.MM.YYYY");
        });
        sort($gg);
        array_walk($gg, function (&$item) {
            $item = date("d.m.Y", $item);
        });
        $arResultBlock[$arRes["UF_CITYFROM_ID"]][$arRes["UF_COUNTRY_ID"]][1000] = $gg;
        $arResultBlock[$arRes["UF_CITYFROM_ID"]][$arRes["UF_COUNTRY_ID"]][$arRes["UF_TOURTYPE_ID"]] = $date;

    }
    $dates_country = \Bitrix\Main\Web\Json::encode($arResultBlock);
}
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>