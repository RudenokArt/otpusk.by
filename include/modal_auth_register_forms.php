<?if($USER->IsAuthorized()) return?>

<!-- BEGIN # MODAL LOGIN -->
<div class="modal fade modal-login modal-border-transparent" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true">

	<div class="modal-dialog">
		<div class="modal-content">
			
			<button type="button" class="btn btn-close close" data-dismiss="modal" aria-label="Close">
				<i class="fa fa-close fa-fw" aria-hidden="true"></i>
			</button>
			
			<div class="clear"></div>
			
			<!-- Begin # DIV Form -->
			<div id="modal-login-form-wrapper">
	
				<!-- Begin # Login Form -->
				<?$APPLICATION->IncludeComponent("bitrix:system.auth.form","",Array(
				     "REGISTER_URL" => "",
				     "FORGOT_PASSWORD_URL" => "",
				     "PROFILE_URL" => "",
				     "SHOW_ERRORS" => "Y" 
				     )
				);?>
				<!-- End # Login Form -->
							
				<!-- Begin | Lost Password Form -->
				<?$APPLICATION->IncludeComponent("bitrix:system.auth.forgotpasswd","",Array());?>
				<!-- End | Lost Password Form -->
							
				<!-- Begin | Register Form -->
				<?
				if($_REQUEST["REGISTER"]["EMAIL"] != "")
					$_REQUEST["REGISTER"]["LOGIN"] = $_REQUEST["REGISTER"]["EMAIL"]; // делаем логин = email

				   $APPLICATION->IncludeComponent( 
				   "bitrix:main.register", 
				   "", 
				   Array( 
				      "USER_PROPERTY_NAME" => "", 
				      "SEF_MODE" => "N", 
				      "SHOW_FIELDS" => Array("NAME", "EMAIL"), 
				      "REQUIRED_FIELDS" => Array("NAME", "EMAIL"), 
				      "AUTH" => "Y", 
				      "USE_BACKURL" => "Y", 
				      "SUCCESS_PAGE" => "/", 
				      "SET_TITLE" => "N", 
				      "USER_PROPERTY" => Array() 
				   ) 
				   );?>
				<!-- End | Register Form -->

			</div>
			<!-- End # DIV Form -->
							
		</div>
	</div>
</div>
<!-- END # MODAL LOGIN -->