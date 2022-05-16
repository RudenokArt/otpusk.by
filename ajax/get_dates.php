<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

$result = file_get_contents(
    "http://booking2.otpusk.by:8080/SearchTour/json_handler.ashx",
    false,
    stream_context_create(
        array(
            'ssl' => array("verify_peer" => false),
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => json_encode(
                    array(
                        "jsonrpc" => "2.0",
                        "method"  => "GetDatesForFiltr",
                        "params"  =>  array(),
                        "id" => 0
                    )
                ),
            ),
        )
    )
);
$result = json_decode($result, true);
//dm($result);
if(!empty($result["result"])){
    //dm($result["result"]);
    CModule::IncludeModule("highloadblock");
    $hlbl = 1;
    $entity_table_name = $hlblock['GETDATESFORFILTR'];
    $arResultBlock = array();
    $hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch();
    // get entity
    $entity = HL\HighloadBlockTable::compileEntity($hlblock);
    $entity_data_class = $entity->getDataClass();

    $sTableID = 'b_'.$entity_table_name;
    $rsData = $entity_data_class::getList();

    $rsDataCount = $rsData->getSelectedRowsCount();

    if($rsDataCount > 0){
        while($arRes = $rsData->fetch()){
            $arResultBlock[$arRes["UF_CITYFROM_ID"]][$arRes["UF_COUNTRY_ID"]][$arRes["UF_TOURTYPE_ID"]] = $arRes;
        }
        //dm($arResultBlock);
        foreach ($result["result"] as $item){
            if (isset($arResultBlock[$item["cityfrom_id"]]) && isset($arResultBlock[$item["cityfrom_id"]][$item["country_id"]]) && isset($arResultBlock[$item["cityfrom_id"]][$item["country_id"]][$item["tourtype_id"]])){
                //update
                $data = array(
                    "UF_DATES"=>serialize($item["dates"]),
                );
                $id = $arResultBlock[$item["cityfrom_id"]][$item["country_id"]][$item["tourtype_id"]]["ID"];
                $result = $entity_data_class::update($id, $data);
                if($result->isSuccess())
                {
                    echo 'В справочнике изменена запись '.$id.'<br />';
                }
                else {
                    echo 'Ошибка изменения записи';
                }
                unset($arResultBlock[$item["cityfrom_id"]][$item["country_id"]][$item["tourtype_id"]]);
            }
            else {
                //add
                $data = array(
                    "UF_COUNTRY_ID"=>$item["country_id"],
                    "UF_CITYFROM_ID"=>$item["cityfrom_id"],
                    "UF_TOURTYPE_ID"=>$item["tourtype_id"],
                    "UF_DATES"=>serialize($item["dates"]),
                );
                $result = $entity_data_class::add($data);
                $ID = $result->getId();
                if($result->isSuccess())
                {
                    echo 'В справочник добавлена запись '.$ID.'<br />';
                }
                else {
                    echo 'Ошибка добавления записи';
                }
            }
        }
        if(!empty($arResultBlock)){
            foreach ($arResultBlock as $value){
                foreach ($value as $val) {
                    foreach ($val as $v) {
                        //delete
                        $entity_data_class::Delete($v["ID"]);
                    }
                }
            }
        }
    }
    else {
        $data = array();
        foreach ($result["result"] as $item){
            $data = array(
                "UF_COUNTRY_ID"=>$item["country_id"],
                "UF_CITYFROM_ID"=>$item["cityfrom_id"],
                "UF_TOURTYPE_ID"=>$item["tourtype_id"],
                "UF_DATES"=>serialize($item["dates"]),
            );
            $result = $entity_data_class::add($data);
            $ID = $result->getId();
            if($result->isSuccess())
            {
                echo 'В справочник добавлена запись '.$ID.'<br />';
            }
            else {
                echo 'Ошибка добавления записи';
            }
        }
    }
}
else {
    echo "Возникла ошибка выгрузки дат из МастерТур!";
}