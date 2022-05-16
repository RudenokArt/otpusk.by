<?
require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/install/wizard_sol/wizard.php");
require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/simai.special/include.php");

class WelcomeStep extends CWizardStep
{
    function InitStep()
    {
    }  
}

class SelectSiteStep extends CSelectSiteWizardStep
{
	function InitStep()
	{
		parent::InitStep();                                
		$wizard =& $this->GetWizard();
		$wizard->solutionName = "simai:special";   
                $this->SetPrevStep("welcome_step");
                $this->SetPrevCaption(GetMessage("PREVIOUS_BUTTON"));
                $this->SetNextStep("select_template");
                $this->SetNextCaption(GetMessage("NEXT_BUTTON"));
	}
    function ShowStep()
	{
    
		$wizard =& $this->GetWizard();

		$arSites = array(); 
		$arSitesSelect = array(); 
		$db_res = CSite::GetList($by="sort", $order="desc", array("ACTIVE" => "Y"));
		if ($db_res && $res = $db_res->GetNext())
		{
			do 
			{
				$arSites[$res["ID"]] = $res; 
				$arSitesSelect[$res["ID"]] = '['.$res["ID"].'] '.$res["NAME"];
			} while ($res = $db_res->GetNext()); 
		}
		
		$createSite = $wizard->GetVar("createSite"); 
		$createSite = ($createSite == "Y" ? "Y" : "N"); 
		
		
$this->content = 
'<script type="text/javascript">
function SelectCreateSite(element, solutionId)
{
	var container = document.getElementById("solutions-container");
	var nodes = container.childNodes;
	for (var i = 0; i < nodes.length; i++)
	{
		if (!nodes[i].className)
			continue;
		nodes[i].className = "solution-item";
	}
	element.className = "solution-item solution-item-selected";
	var check = document.getElementById("createSite" + solutionId);
	if (check)
		check.checked = true;
}
</script>';
		$this->content .= '<div id="solutions-container">';
			$this->content .= "<div onclick=\"SelectCreateSite(this, 'N');\" ";
				$this->content .= 'class="solution-item'.($createSite != "Y" ? " solution-item-selected" : "").'">'; 
				$this->content .= '<b class="r3"></b><b class="r1"></b><b class="r1"></b>'; 
				$this->content .= '<div class="solution-inner-item">'; 
					$this->content .= $this->ShowRadioField("createSite", "N", (array("id" => "createSiteN", "class" => "solution-radio") + 
						($createSite != "Y" ? array("checked" => "checked") : array()))); 
					$this->content .= '<h4>'.GetMessage("wiz_site_existing").'</h4>'; 
				if (count($arSites) < 2)
					$this->content .= '<p>'.GetMessage("wiz_site_existing_title").' '.implode("", $arSitesSelect).'</p>'; 
				else
				{
					$this->content .= '<p>'.GetMessage("wiz_site_existing_title");
					$this->content .= "<br />". $this->ShowSelectField("siteID", $arSitesSelect)."</p>";
				}
				$this->content .= '</div>'; 
				$this->content .= '<b class="r1"></b><b class="r1"></b><b class="r3"></b>'; 
			$this->content .= '</div>';		
		$this->content .= '</div>';
	}
}

class SelectTemplateStep extends CSelectTemplateWizardStep
{
	function InitStep()
	{
                $this->SetStepID("select_template");
                $this->SetTitle(GetMessage("SELECT_TEMPLATE_TITLE"));
		$this->SetSubTitle(GetMessage("SELECT_TEMPLATE_SUBTITLE"));
		$this->SetPrevStep("select_site");
		$this->SetPrevCaption(GetMessage("PREVIOUS_BUTTON"));
                $this->SetNextStep("site_settings");
		$this->SetNextCaption(GetMessage("NEXT_BUTTON"));
	}
    function ShowStep()
	{                
		$wizard =& $this->GetWizard();
                
                $templatesPath = WizardServices::GetTemplatesPath('/bitrix');            
		$arTemplatesAll = WizardServices::GetTemplates($templatesPath);
                $arSiteTemplates = SpecialSite::GetList($wizard->GetVar('siteID'));
                foreach($arSiteTemplates as $arSiteTemplatesItem){
                    $arSiteTemplatesName[] = $arSiteTemplatesItem['TEMPLATE'];
                }
                foreach($arTemplatesAll as $template_name=>$arTemplatesAllItem){
                    if(in_array($template_name, $arSiteTemplatesName)){
                        $arTemplates[$template_name] = $arTemplatesAllItem;
                    }
                }                                
                
		if (empty($arTemplates))
			return;

		$templateID = $wizard->GetVar("templateID");
		if(isset($templateID) && array_key_exists($templateID, $arTemplates)){
		
			$defaultTemplateID = $templateID;
			$wizard->SetDefaultVar("templateID", $templateID);
			
		} else {
		
			$defaultTemplateID = COption::GetOptionString("main", "wizard_template_id", "", $wizard->GetVar("siteID")); 
			if (!(strlen($defaultTemplateID) > 0 && array_key_exists($defaultTemplateID, $arTemplates)))
			{
				if (strlen($defaultTemplateID) > 0 && array_key_exists($defaultTemplateID, $arTemplates))
					$wizard->SetDefaultVar("templateID", $defaultTemplateID);
				else
					$defaultTemplateID = "";
			}
		}

		global $SHOWIMAGEFIRST;
		$SHOWIMAGEFIRST = true;
		
		$this->content .= '<div id="solutions-container" class="inst-template-list-block">';
		foreach ($arTemplates as $templateID => $arTemplate)
		{
			if ($defaultTemplateID == "")
			{
				$defaultTemplateID = $templateID;
				$wizard->SetDefaultVar("templateID", $defaultTemplateID);
			}

			$this->content .= '<div class="inst-template-description">';
			$this->content .= $this->ShowRadioField("templateID[]", $templateID, Array("id" => $templateID, "class" => "inst-template-list-inp"));
			if ($arTemplate["SCREENSHOT"] && $arTemplate["PREVIEW"])
				$this->content .= CFile::Show2Images($arTemplate["PREVIEW"], $arTemplate["SCREENSHOT"], 150, 150, ' class="inst-template-list-img"');
			else
				$this->content .= CFile::ShowImage($arTemplate["SCREENSHOT"], 150, 150, ' class="inst-template-list-img"', "", true);

			$this->content .= '<label for="'.$templateID.'" class="inst-template-list-label">'.$arTemplate["NAME"].'<p>'.$arTemplate["DESCRIPTION"].'</p></label>';
			$this->content .= "</div>";

		}
		
		$this->content .= '</div>'; 
	}
        
        function OnPostForm()
	{
		$wizard =& $this->GetWizard();
                               
		if ($wizard->IsNextButtonClick())
		{
                        $templatesPath = WizardServices::GetTemplatesPath('/bitrix');            
			$arTemplatesAll = WizardServices::GetTemplates($templatesPath);
                        $arSiteTemplates = SpecialSite::GetList($wizard->GetVar('siteID'));
                        foreach($arSiteTemplates as $arSiteTemplatesItem){
                            $arSiteTemplatesName[] = $arSiteTemplatesItem['TEMPLATE'];
                        }
                        foreach($arTemplatesAll as $template_name=>$arTemplatesAllItem){
                            if(in_array($template_name, $arSiteTemplatesName)){
                                $arTemplates[$template_name] = $arTemplatesAllItem;
                            }
                        }
			$templateID = $wizard->GetVar("templateID");                       
                        $bCheckedTemplate = false;
                        foreach($templateID as $templateIDItem){
                            if (array_key_exists($templateIDItem, $arTemplates)){
                                $bCheckedTemplate = true;
                            }
                        }
                        
			if (!$bCheckedTemplate)
				$this->SetError(GetMessage("wiz_template"));
		}
	}
}

class SiteSettingsStep extends CSiteSettingsWizardStep
{
	function InitStep()
	{
		$wizard =& $this->GetWizard();
		$wizard->solutionName = "simai:special";
		parent::InitStep();
                
                $this->SetNextStep("data_install");
		$this->SetPrevStep("select_template");
		$this->SetNextCaption(GetMessage("NEXT_BUTTON"));
		$this->SetPrevCaption(GetMessage("PREVIOUS_BUTTON"));

		$templateID = $wizard->GetVar("templateID");
		$themeID = $wizard->GetVar($templateID."_themeID");
		$wizard->SetDefaultVars(
			Array(
				"siteName" => COption::GetOptionString("simai.special", "siteName", GetMessage("WIZ_COMPANY_SLOGAN_DEF")),
                "siteAddress" =>COption::GetOptionString("simai.special", "address", GetMessage("WIZ_COMPANY_ADDRESS_DEF")),
                "siteEmail" => COption::GetOptionString("simai.special", "email", GetMessage("WIZ_COMPANY_EMAIL_DEF")),
                "sitePhone" => COption::GetOptionString("simai.special", "phone", GetMessage("WIZ_COMPANY_TELEPHONE_DEF")),
				"siteCopy" => COption::GetOptionString("simai.special", "copyright", GetMessage("WIZ_COMPANY_COPY_DEF")),
			)
		);	
	}

	function ShowStep()
	{
		$wizard =& $this->GetWizard();							
		$this->content .= '<div class="wizard-input-form">';
        $this->content .= '
		<div class="wizard-input-form-block">
			<label for="siteName" class="wizard-input-title">'.GetMessage("WIZ_COMPANY_SLOGAN").'</label><br>
			'.$this->ShowInputField('text', 'siteName', array("id" => "siteName", "class" => "wizard-field")).'
		</div>';
		
		$this->content .= '
		<div class="wizard-input-form-block">
			<label for="sitePhone" class="wizard-input-title">'.GetMessage("WIZ_COMPANY_TELEPHONE").'</label><br>
			'.$this->ShowInputField('text', 'sitePhone', array("id" => "sitePhone", "class" => "wizard-field")).'
		</div>';
		$this->content .= '
		<div class="wizard-input-form-block">
			<label for="siteEmail" class="wizard-input-title">'.GetMessage("WIZ_COMPANY_EMAIL").'</label><br>
			'.$this->ShowInputField('text', 'siteEmail', array("id" => "siteEmail", "class" => "wizard-field")).'
		</div>';	
		$this->content .= '
		<div class="wizard-input-form-block">
			<label for="siteAddress" class="wizard-input-title">'.GetMessage("WIZ_COMPANY_ADDRESS").'</label><br>
			'.$this->ShowInputField('text', 'siteAddress', array("id" => "siteAddress", "class" => "wizard-field")).'
		</div>';		
		$this->content .= '
		<div class="wizard-input-form-block">
			<label for="siteCopy" class="wizard-input-title">'.GetMessage("WIZ_COMPANY_COPY").'</label><br>
			'.$this->ShowInputField('textarea', 'siteCopy', array("rows"=>"3", "id" => "siteCopy", "class" => "wizard-field")).'
		</div>';
		        
               
			   
			   
			   

		$formName = $wizard->GetFormName();
		$installCaption = $this->GetNextCaption();
		$nextCaption = GetMessage("NEXT_BUTTON");
	}

	function OnPostForm()
	{
		$wizard =& $this->GetWizard();

 	}
}

	





class DataInstallStep extends CDataInstallWizardStep
{
	function CorrectServices(&$arServices)
	{
		$wizard =& $this->GetWizard();
	}
}

class FinishStep extends CFinishWizardStep
{
    function CreateNewIndex()
    {

    }
    
    function ShowStep()
	{
		$wizard =& $this->GetWizard();
		
		$siteID = WizardServices::GetCurrentSiteID($wizard->GetVar("siteID"));
		$rsSites = CSite::GetByID($siteID);
		$siteDir = "/"; 
		if ($arSite = $rsSites->Fetch())
			$siteDir = $arSite["DIR"]; 

		$wizard->SetFormActionScript(str_replace("//", "/", $siteDir."/?special_version=Y"));

		$this->CreateNewIndex();
		
		COption::SetOptionString("main", "wizard_solution", $wizard->solutionName, false, $siteID); 
		
		$this->content .= GetMessage("FINISH_STEP_CONTENT");
		
		if ($wizard->GetVar("installDemoData") == "Y")
			$this->content .= GetMessage("FINISH_STEP_REINDEX");		
		
	}
}
?>