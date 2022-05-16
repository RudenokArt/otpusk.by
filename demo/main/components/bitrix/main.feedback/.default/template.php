<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
?>

<div class="section pt-60 pb-0 m-bott_50">

	<div class="container">
	
		<div class="row">

			<div class="col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
				
				<div class="section-title">
				
					<h3>Форма обратной связи</h3>
					
				</div>
				
			</div>
		
		</div>
		
		<form action="<?=POST_FORM_ACTION_URI?>" method="POST" class="contact-form-wrapper" data-toggle="validator" novalidate="true">
		<?=bitrix_sessid_post()?>
		<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
			<div class="row">
			
				<div class="col-sm-4">

					<?
					// текст формы обратной связи
					$APPLICATION->IncludeFile($SERVER["DOCUMENT_ROOT"]."/include/feedback_text.php", Array(), Array(
					    "MODE"      => "html",                // будет редактировать в веб-редакторе
					    "NAME"      => "текст формы обратной связи",      // текст всплывающей подсказки на иконке
					    ));
					?>
					
				</div>
				
				<div class="col-sm-8">

				<?if(!empty($arResult["ERROR_MESSAGE"]))
				{
					foreach($arResult["ERROR_MESSAGE"] as $v)
						ShowError($v);
				}
				if(strlen($arResult["OK_MESSAGE"]) > 0)
				{
					?><div class="mf-ok-text"><?=$arResult["OK_MESSAGE"]?></div><?
				}
				?>

				
					<div class="row">
					
						<div class="col-sm-6">
						
							<div class="form-group">
								<label for="inputName"><?=GetMessage("MFT_NAME"); if(empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"])):?>&nbsp;<span class="font10 text-danger">*</span><?endif?></label>
								<input  id="inputName" type="text" class="form-control" data-error="<?=GetMessage("MF_REQ_NAME")?>" required="" name="user_name" value="<?=$arResult["AUTHOR_NAME"]?>">
								<div class="help-block with-errors"></div>
							</div>
							
							<div class="form-group">
								<label for="inputEmail"><?=GetMessage("MFT_EMAIL"); if(empty($arParams["REQUIRED_FIELDS"]) || in_array("EMAIL", $arParams["REQUIRED_FIELDS"])):?>&nbsp;<span class="font10 text-danger">*</span><?endif?></label>
								<input id="inputEmail" type="email" class="form-control" data-error="<?=GetMessage("MF_REQ_EMAIL")?>" required="" name="user_email" value="<?=$arResult["AUTHOR_EMAIL"]?>">
								<div class="help-block with-errors"></div>
							</div>
						
						</div>
						
						<div class="col-sm-6">
						
							<div class="form-group">
								<label for="inputMessage"><?=GetMessage("MFT_MESSAGE"); if(empty($arParams["REQUIRED_FIELDS"]) || in_array("MESSAGE", $arParams["REQUIRED_FIELDS"])):?>&nbsp;<span class="font10 text-danger">*</span><?endif?></label>
								<textarea id="inputMessage" class="form-control" rows="9" data-minlength="50" data-error="<?=GetMessage("MF_REQ_MESSAGE")?>" required="" name="MESSAGE"><?=$arResult["MESSAGE"]?></textarea>
								<div class="help-block with-errors"></div>
							</div>
						
						</div>
						
						<div class="col-sm-12 text-right text-left-sm">
							<button name="submit" value="<?=GetMessage("MFT_SUBMIT")?>" type="submit" class="btn btn-primary mt-5" onclick="ga('send', 'event', 'button', 'click', 'SendContact'); yaCounter1028882.reachGoal('SendContact'); return true;" ><?=GetMessage("MFT_SUBMIT")?></button>
						</div>
						
					</div>

				</div>
			
			</div>
		
		</form>
		
	</div>
	
</div>
