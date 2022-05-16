<?
class SpecialSite{
  
	   static function GetListSites(){
        $arSites = array();
        $dbSite = CSite::GetList($by="sort", $order="desc", Array("ACTIVE" => "Y"));
        while($arSite = $dbSite->Fetch()){
            $arSites[$arSite['ID']] = $arSite;
        }
        return $arSites;
    }    
	   static function GetList($site_id){     
            $arTemplates = array();       
            $dbTemplate = CSite::GetTemplateList($site_id);
            while($arTemplate = $dbTemplate->Fetch()){  
                  $arTemplates[$arTemplate['ID']] = $arTemplate;           
            }
        return $arTemplates;
    }

	    static function CopyFiles($templateName)
		{
			 $pathTemplate= $_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/".$templateName;
			 $pathtarget= $_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/specialsimai_".$templateName;
			 CheckDirPath($pathtarget);
			 CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/simai.special/install/wizards/simai/special/site/templates/site_template", $pathtarget, true, true);  		 
			 CheckDirPath($pathtarget."/components");
			 CopyDirFiles($pathTemplate."/components", $pathtarget."/components", true, true);   
        }  
	  static function siteUpdate($siteId,$templateName)
		{
        $rsTemplates = CSite::GetTemplateList($siteId);
        while($arTemplate = $rsTemplates->Fetch()){
           $arResultTemplate[]  = array('CONDITION' => $arTemplate['CONDITION'], 'SORT' => $arTemplate['SORT'], 'TEMPLATE' => $arTemplate['TEMPLATE']);
        }
        $arResultTemplate[] = array('CONDITION' => '($_GET["special_version"] == "Y" || $_SESSION["special_version"] == "Y")', 'SORT' => '1', 'TEMPLATE' => 'specialsimai_'.$templateName);
        $obSite = new CSite();
        $obSite->Update($siteId, array('ACTIVE' => "Y", 'TEMPLATE'=>$arResultTemplate));
  
        }  
  
}
?>