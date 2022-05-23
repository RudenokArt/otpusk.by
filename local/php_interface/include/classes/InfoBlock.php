<?php CModule::IncludeModule("iblock");
/**
 * 
 */
class InfoBlock {

  function __construct($order=[], $filter=[], $group=false, $nav=false, $select=[])  {
    $this->src = CIBlockElement::GetList($order, $filter, $group, $nav, $select);
    $this->items_arr = $this->getList_fetch($this->src);
    $this->pagination = [
      'page_count' => $this->src->NavPageCount, 
      'page_number' => $this->src->NavPageNomer,
    ];
  }

  function getList_fetch ($src) {
    $arr = [];
    while ($item = $src->Fetch()) {
      array_push($arr, $item);
    }
    return $arr;
  }
}


?>