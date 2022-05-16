<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

$templateID = $wizard->GetVar("templateID");
$siteID = $wizard->GetVar("siteID");

COption::SetOptionString("simai.special", "organization", $wizard->GetVar("siteName"));
COption::SetOptionString("simai.special", "copyright", $wizard->GetVar("siteCopy"));
COption::SetOptionString("simai.special", "address", $wizard->GetVar("siteAddress"));
COption::SetOptionString("simai.special", "phone", $wizard->GetVar("sitePhone"));
COption::SetOptionString("simai.special", "email", $wizard->GetVar("siteEmail"));



SpecialSite::CopyFiles($templateID[0]);
SpecialSite::siteUpdate($siteID,$templateID[0]);

	Protection("specialsimai_".$templateID[0]);
	set_button($templateID[0]);

function Protection($templatename)
{
	$path=$_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/".$templatename."/";
	if(CModule::IncludeModuleEx("simai.special") != 1) Search($path);
}
	
	
    function Search($file)
    {
		$proverka='<?$prov=CModule::IncludeModuleEx("simai.special");if($prov==0||$prov==3)return;?>';
		$string=basename($file);
		if($string[0]!="_")
		{
			if (is_dir($file)) // dir
			{
				
					$files=array();
					$dir = opendir($file);
					while($item = readdir($dir))
					{
						if ($item == '.' || $item == '..')
							continue;
                        $files[] = $item;
					}
					closedir($dir);
					sort($files);
					foreach ($files as $item) {Search($file.'/'.$item);}
			}
			else 
			{
					 if(is_file ($file)) 
						{
							  if(basename($file)=="template.php")
							  {
                                   file_put_contents($file,$proverka.file_get_contents($file));
							  }
						} 						
			}
		}
    }
	function set_button($templatename)
	{
		 $path=$_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/".$templatename."/";
		 CheckDirPath($path);
		 CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/simai.special/install/wizards/simai/special/site/templates/site_template/font-awesome/", $path."font-awesome/", true, true); 
         $body='<a href="<?=$APPLICATION->GetCurPage()?>?special_version=Y" title="" class="topbutton"><i class="fa fa-eye-slash"></i></a>
			<style>
			.topbutton {
						width:20px;
						border:2px solid #ccc;
						background:#f7f7f7;
						text-align:center;
						padding:10px;
						position:fixed;
						top:50px;
						right:50px;
						cursor:pointer;
						color:#333;
						font-size:14px;
						border-radius: 5px;
						-moz-border-radius: 5px;
						-webkit-border-radius: 5px;
						-khtml-border-radius: 5px;
						}
			</style>';
		$footer=file_get_contents($path."footer.php");
		$footer = str_replace("</body>", $body."</body>", $footer);
		file_put_contents($path."footer.php",$footer);
		$head='<link href="<?=SITE_TEMPLATE_PATH?>/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>';
		$header=file_get_contents($path."header.php");
		$header = str_replace("</head>", $head."</head>", $header);
		file_put_contents($path."header.php",$header);
	}
?>
