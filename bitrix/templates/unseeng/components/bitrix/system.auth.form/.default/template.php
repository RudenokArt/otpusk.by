<?$prov=CModule::IncludeModuleEx("simai.special");if($prov==0||$prov==3)return;?><?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//dm($arResult)?>

<form id="login-form" action="<?=$arResult["AUTH_URL"]?>" method="POST" >
	
	<?if($arResult["BACKURL"] <> ''):?>
		<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
	<?endif?>
	<?foreach ($arResult["POST"] as $key => $value):?>
		<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
	<?endforeach?>
	<input type="hidden" name="AUTH_FORM" value="Y" />
	<input type="hidden" name="TYPE" value="AUTH" />			
	
	<div class="modal-body pb-5">

		<div class="text-center heading mt-10 mb-20" style="font-weight: 700;font-size:21px;">Войти</div>
	
	<?if($arResult["AUTH_SERVICES"]):?>
		<?
		$APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "icons", 
			array(
				"AUTH_SERVICES"=>$arResult["AUTH_SERVICES"],
				"SUFFIX"=>"form",
			), 
			$component, 
			array("HIDE_ICONS"=>"Y")
		);
		?>
	<?endif?>	
	<button class="btn btn-facebook btn-block">Войти через Facebook</button>

		<div class="modal-seperator">
			<span>или</span>
		</div>
		<?
		if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR'])
			ShowMessage($arResult['ERROR_MESSAGE']);
		?>
		<div class="form-group"> 
			<input value="<?=$arResult["USER_LOGIN"]?>" name="USER_LOGIN" id="login_username" class="form-control" placeholder="username" type="text">
		</div>
		<div class="form-group"> 
			<input type="password" name="USER_PASSWORD" id="login_password" class="form-control" placeholder="password" autocomplete="off"> 
		</div>

		<div class="form-group">
			<div class="row gap-5">
			<?if ($arResult["STORE_PASSWORD"] == "Y"):?>
				<div class="col-xs-6 col-sm-6 col-md-6">
					<div class="checkbox-block fa-checkbox"> 
						<input id="remember_me_checkbox" name="USER_REMEMBER" class="checkbox" value="Y" type="checkbox"> 
						<label class="" for="remember_me_checkbox">запомнить</label>
					</div>
				</div>
			<?endif?>
				<div class="col-xs-6 col-sm-6 col-md-6 text-right"> 
					<button id="login_lost_btn" type="button" class="btn btn-link">забыли пароль?</button>
				</div>
			</div>
		</div>
	
	</div>
	
	<div class="modal-footer">
	
		<div class="row gap-10">
			<div class="col-xs-6 col-sm-6 mb-10">
				<button type="submit" class="btn btn-primary btn-block">Войти</button>
			</div>
			<div class="col-xs-6 col-sm-6 mb-10">
				<button type="submit" class="btn btn-primary btn-block btn-inverse" data-dismiss="modal" aria-label="Close">Отмена</button>
			</div>
		</div>
		<?if($arResult["NEW_USER_REGISTRATION"] == "Y"):?>
			<!--div class="text-left">
				Нет аккаунта? 
				<button id="login_register_btn" type="button" class="btn btn-link">Зарегистрироваться</button>
			</div-->
		<?endif?>
	</div>
</form>

<?if($arResult["AUTH_SERVICES"]):?>
<?
$APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "", 
	array(
		"AUTH_SERVICES"=>$arResult["AUTH_SERVICES"],
		"AUTH_URL"=>$arResult["AUTH_URL"],
		"POST"=>$arResult["POST"],
		"POPUP"=>"Y",
		"SUFFIX"=>"form",
	), 
	$component, 
	array("HIDE_ICONS"=>"Y")
);
?>
<?endif?>
