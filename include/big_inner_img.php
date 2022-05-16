<? global $APPLICATION;
$b_i_src = $APPLICATION->GetDirProperty('BIG_IMG');

if($b_i_src != "" && $b_i_src != "N" && NOT_SHOW_BIG_IMG !== true)
{
?>
<div style="padding:80px 0 40px 0;" class="page-title" style="background-image:url('<?= $b_i_src?>');">
					
		<div class="container">
		
			<div class="row">
			
				<div class="col-sm-10 col-sm-offset-1 col-md-6 col-md-offset-3">

					<h1 class="hero-title"><?$APPLICATION->ShowTitle(false);?></h1>

				</div>
				
			</div>

			<?
			$APPLICATION->IncludeComponent("bitrix:main.include","",Array(
			        "AREA_FILE_SHOW" => "page", 
			        "AREA_FILE_SUFFIX" => "big_inner_img_buffer_content", 
			        "AREA_FILE_RECURSIVE" => "N", 
			        "EDIT_TEMPLATE" => "" 
			    )
			);?>

		</div>

		
	</div>
<?}?>