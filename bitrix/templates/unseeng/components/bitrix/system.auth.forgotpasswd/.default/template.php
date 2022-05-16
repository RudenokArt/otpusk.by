<?$prov=CModule::IncludeModuleEx("simai.special");if($prov==0||$prov==3)return;?><?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<form id="lost-form" style="display:none;" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
	<input type="hidden" name="AUTH_FORM" value="Y">
	<input type="hidden" name="TYPE" value="SEND_PWD">
	<div class="modal-body pb-5">
	
		<div class="text-center heading mt-10 mb-20" style="font-weight: 700;font-size:21px;">Восстановление пароля</div>
		<p> Ссылка для восставновления пароля придёт на введённый email </p>
		<div class="form-group mb-10"> 
			<input name="USER_EMAIL" id="lost_email" class="form-control" type="text" placeholder="Введите Ваш Email">
		</div>
		
		<div class="text-center">
			<button id="lost_login_btn" type="button" class="btn btn-link">Войти в систему</button>
			
			<?
				$register = Bitrix\Main\Config\Option::get("main", "new_user_registration", "N") == "Y" ? "Y" : "N";
				if($register == "Y"):
			?>
				<!-- или 
				<button id="lost_register_btn" type="button" class="btn btn-link">Зарегистрироваться</button-->
			<?endif?>
		
		</div>
		
	</div>
	
	<div class="modal-footer mt-10">
		
		<div class="row gap-10">
			<div class="col-xs-6 col-sm-6">
				<button type="submit" name="send_account_info" class="btn btn-primary btn-block">Отправить</button>
			</div>
			<div class="col-xs-6 col-sm-6">
				<button type="submit" class="btn btn-primary btn-inverse btn-block" data-dismiss="modal" aria-label="Close">Отмена</button>
			</div>
		</div>
		
	</div>
	
</form>