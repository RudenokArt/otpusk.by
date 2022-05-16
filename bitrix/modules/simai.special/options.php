<?
if(!$USER->IsAdmin())
	return;

IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/options.php");
IncludeModuleLangFile(__FILE__);


$aTabs = array(
	array(
	"DIV" => "edit1", 
	"TAB" => GetMessage("PROPERTY_SITE"),
	"ICON" => "ib_settings", 
	"TITLE" => "",
	"OPTIONS" => Array(
	       array("organization",GetMessage("ORGANIZATION"),"",array("text",40),),
		   array("copyright",GetMessage("COPYRIGHT"),"",array("text",40),),
		   array("address",GetMessage("ADDRESS"),"",array("text",40),),
		   array("phone",GetMessage("TELEPHONE"),"",array("text",40),),
		   array("email",GetMessage("EMAIL"),"",array("text",40),),
		  

	)),
);


$arAllOptions = array();


if(CModule::IncludeModule("iblock"))
{
	$res = CIBlock::GetList(Array(),Array('ACTIVE'=>'Y',"CODE"=>'area'), true);
	$iblock = $res->Fetch();
	$arFilter = array("IBLOCK_ID"=>$iblock['ID'], "CODE" => "center");
	$res = CIBlockElement::GetList(array(), $arFilter, false, array("nPageSize"=>1), array('ID','IBLOCK_TYPE_ID'));
	$element = $res->Fetch();
	$LINK='/bitrix/admin/iblock_element_edit.php?IBLOCK_ID='.$iblock['ID'].'&type='.$element["IBLOCK_TYPE_ID"].'&ID='.$element["ID"];
}

$tabControl = new CAdminTabControl("tabControl", $aTabs);

if($REQUEST_METHOD=="POST" && strlen($Update.$Apply.$RestoreDefaults)>0 && check_bitrix_sessid())
{
	if(strlen($RestoreDefaults)>0)
	{
		COption::RemoveOption("simai.special");
	}
	else
	{
		foreach($aTabs as $i => $aTab)
			{
				foreach($aTab["OPTIONS"] as $name => $arOption)
				{
					$name=$arOption[0];
					$val=$_REQUEST[$name];
					if($arOption[2][0]=="checkbox" && $val!="Y")
						$val="N";
					COption::SetOptionString("simai.special", $name, $val, $arOption[1]);
				}
		}
	}
	if(strlen($Update)>0 && strlen($_REQUEST["back_url_settings"])>0)
		LocalRedirect($_REQUEST["back_url_settings"]);
	else
		LocalRedirect($APPLICATION->GetCurPage()."?mid=".urlencode($mid)."&lang=".urlencode(LANGUAGE_ID)."&back_url_settings=".urlencode($_REQUEST["back_url_settings"])."&".$tabControl->ActiveTabParam());
}

$tabControl->Begin();
?>

<form method="post" name="form1" action="<?echo $APPLICATION->GetCurPage()?>?mid=<?=urlencode($mid)?>&amp;lang=<?echo LANGUAGE_ID?>">
<?$tabControl->BeginNextTab();?>
	<?$val = COption::GetOptionString("simai.special", $aTabs[0]["OPTIONS"][0][0], $aTabs[0]["OPTIONS"][0][2]);?>
	<tr>
		<td width="40%" nowrap>
			<label for="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][0][0])?>"><?echo $aTabs[0]["OPTIONS"][0][1]?>:</label>
		<td width="60%">
	         <input type="text" size="<?echo $aTabs[0]["OPTIONS"][0][3][1]?>" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][0][0])?>" id="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][0][0])?>">
	    </td>
	</tr>
	
    <?$val = COption::GetOptionString("simai.special", $aTabs[0]["OPTIONS"][1][0], $aTabs[0]["OPTIONS"][1][2]);?>
	<tr>
		<td width="40%" nowrap>
			<label for="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][1][0])?>"><?echo $aTabs[0]["OPTIONS"][1][1]?>:</label>
		<td width="60%">
	         <input type="text" size="<?echo $aTabs[0]["OPTIONS"][1][3][1]?>" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][1][0])?>" id="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][1][0])?>">
	    </td>
	</tr>
	
	<?$val = COption::GetOptionString("simai.special", $aTabs[0]["OPTIONS"][2][0], $aTabs[0]["OPTIONS"][2][2]);?>
	<tr>
		<td width="40%" nowrap>
			<label for="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][2][0])?>"><?echo $aTabs[0]["OPTIONS"][2][1]?>:</label>
		<td width="60%">
	         <input type="text" size="<?echo $aTabs[0]["OPTIONS"][2][3][1]?>" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][2][0])?>" id="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][2][0])?>">
	    </td>
	</tr>
			
	<?$val = COption::GetOptionString("simai.special", $aTabs[0]["OPTIONS"][3][0], $aTabs[0]["OPTIONS"][3][2]);?>
	<tr>
		<td width="40%" nowrap>
			<label for="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][3][0])?>"><?echo $aTabs[0]["OPTIONS"][3][1]?>:</label>
		<td width="60%">
	         <input type="text" size="<?echo $aTabs[0]["OPTIONS"][3][1]?>" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][3][0])?>" id="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][3][0])?>">
	    </td>
	</tr>
	
   <?$val = COption::GetOptionString("simai.special", $aTabs[0]["OPTIONS"][4][0], $aTabs[0]["OPTIONS"][4][2]);?>
	<tr>
		<td width="40%" nowrap>
			<label for="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][4][0])?>"><?echo $aTabs[0]["OPTIONS"][4][1]?>:</label>
		<td width="60%">
	         <input type="text" size="<?echo $aTabs[0]["OPTIONS"][4][1]?>" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][4][0])?>" id="<?echo htmlspecialcharsbx($aTabs[0]["OPTIONS"][4][0])?>">
	    </td>
	</tr>

<?$tabControl->Buttons();?>
    <input type="submit" name="Update" id="Update" value="<?=GetMessage("MAIN_SAVE")?>" title="<?=GetMessage("MAIN_OPT_SAVE_TITLE")?>" class="adm-btn-save" onclick="return provColor()">
	<input type="submit" name="Apply" id="Apply" value="<?=GetMessage("MAIN_OPT_APPLY")?>" title="<?=GetMessage("MAIN_OPT_APPLY_TITLE")?>" onclick="return provColor()">
	<?if(strlen($_REQUEST["back_url_settings"])>0):?>
		<input type="button" name="Cancel" value="<?=GetMessage("MAIN_OPT_CANCEL")?>" title="<?=GetMessage("MAIN_OPT_CANCEL_TITLE")?>" onclick="window.location='<?echo htmlspecialcharsbx(CUtil::addslashes($_REQUEST["back_url_settings"]))?>'">
		<input type="hidden" name="back_url_settings" value="<?=htmlspecialcharsbx($_REQUEST["back_url_settings"])?>">
	<?endif?>
	<input type="submit" name="RestoreDefaults" id="Defaults" title="<?echo GetMessage("MAIN_HINT_RESTORE_DEFAULTS")?>" OnClick="return Default()" value="<?echo GetMessage("MAIN_RESTORE_DEFAULTS")?>">
	
	<?=bitrix_sessid_post();?>
<?$tabControl->End();?>
</form>


