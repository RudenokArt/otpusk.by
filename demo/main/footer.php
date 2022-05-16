<?
// центрирование контента, боковое меню, хлебные крошки // конец 
//$GLOBALS['NEED_CLOSE_FOOTER_TAGS'] определяется в header.php для закрытия открытых тегов
echo implode("", $GLOBALS['NEED_CLOSE_FOOTER_TAGS']);?>

<?// Боковое меню внутренних страниц
$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"left2", 
	array(
		"ROOT_MENU_TYPE" => "left2",
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"COMPONENT_TEMPLATE" => "left2"
	),
	false
);
	?>

<?// карта для страницы контактов
$APPLICATION->IncludeComponent("bitrix:main.include","",Array(
        "AREA_FILE_SHOW" => "page", 
        "AREA_FILE_SUFFIX" => "map_offices", 
        "AREA_FILE_RECURSIVE" => "N", 
        "EDIT_TEMPLATE" => "" 
    )
);
?>

<?// форма оратной связи для страницы контактов
$APPLICATION->IncludeComponent("bitrix:main.include","",Array(
        "AREA_FILE_SHOW" => "page", 
        "AREA_FILE_SUFFIX" => "feedback", 
        "AREA_FILE_RECURSIVE" => "N", 
        "EDIT_TEMPLATE" => "" 
    )
);
?>
			</div>
<?if ($APPLICATION->GetDirProperty('NOT_SHOW_SUBSCRIBE') != "Y"):?>
<?
// unisender
$APPLICATION->IncludeFile($SERVER["DOCUMENT_ROOT"]."/include/unisender.php", Array(), Array(
"MODE"      => "html",                // будет редактировать в веб-редакторе
"NAME"      => "unisender",      // текст всплывающей подсказки на иконке
));
?>
<?endif?>
<?
// блок с "достоинствами" на главной
$APPLICATION->IncludeComponent("bitrix:main.include","",Array(
        "AREA_FILE_SHOW" => "page", 
        "AREA_FILE_SUFFIX" => "inc2", 
        "AREA_FILE_RECURSIVE" => "N", 
        "EDIT_TEMPLATE" => "" 
    )
);?>
<footer class="footer scrollspy-footer">
			
			<div class="container">
			
				<div class="main-footer">
				
					<div class="row">
				
						<div class="col-xs-12 col-sm-5 col-md-3">
							<h5 class="footer-title">ЦЕНТРКУРОРТ</h5>
							<p class="footer-address"><?
								// адрес	
								$APPLICATION->IncludeFile($SERVER["DOCUMENT_ROOT"]."/include/address.php", Array(), Array(
								    "MODE"      => "html",        // будет редактировать в веб-редакторе
								    "NAME"      => "Адрес",      // текст всплывающей подсказки на иконке
								    ));
								?> <br> <i class="fa fa-phone"></i> <?
								// Телефон	
								$APPLICATION->IncludeFile($SERVER["DOCUMENT_ROOT"]."/include/phone_f1.php", Array(), Array(
								    "MODE"      => "html",        // будет редактировать в веб-редакторе
								    "NAME"      => "Телефон",      // текст всплывающей подсказки на иконке
								    ));
								?> <br> <i class="fa fa-phone"></i> <?
								// Телефон	
								$APPLICATION->IncludeFile($SERVER["DOCUMENT_ROOT"]."/include/phone_f2.php", Array(), Array(
								    "MODE"      => "html",        // будет редактировать в веб-редакторе
								    "NAME"      => "Телефон",      // текст всплывающей подсказки на иконке
								    ));
								?> <br> <i class="fa fa-envelope-o"></i> <?
								// Email	
								$APPLICATION->IncludeFile($SERVER["DOCUMENT_ROOT"]."/include/email.php", Array(), Array(
								    "MODE"      => "html",        // будет редактировать в веб-редакторе
								    "NAME"      => "Email",      // текст всплывающей подсказки на иконке
								    ));
								?></p>
							
							<div class="footer-social">
							
								<?
								// Socservices	
								$APPLICATION->IncludeFile($SERVER["DOCUMENT_ROOT"]."/include/sc.php", Array(), Array(
								    "MODE"      => "html",        // будет редактировать в веб-редакторе
								    "NAME"      => "Соц. сети",      // текст всплывающей подсказки на иконке
								    ));
								?>
							
							</div>

						</div>
						
						<div class="col-xs-12 col-sm-7 col-md-9">

							<div class="row gap-10">
							
								<div class="col-xs-12 col-sm-4 col-md-3  mt-30-xs">
								
									<?
									// menu1	
									$APPLICATION->IncludeFile($SERVER["DOCUMENT_ROOT"]."/include/ft_menu1.php", Array(), Array(
									    "MODE"      => "html",        // будет редактировать в веб-редакторе
									    "NAME"      => "меню 1",      // текст всплывающей подсказки на иконке
									    ));
									?>
									
								</div>
								
								<div class="col-xs-12 col-sm-4 col-md-3 mt-30-xs">

									<?
									// menu2	
									$APPLICATION->IncludeFile($SERVER["DOCUMENT_ROOT"]."/include/ft_menu2.php", Array(), Array(
									    "MODE"      => "html",        // будет редактировать в веб-редакторе
									    "NAME"      => "меню 2",      // текст всплывающей подсказки на иконке
									    ));
									?>

									
								</div>
								
								<div class="col-xs-12 col-sm-4 col-md-3 mt-30-xs">

									<?
									// menu3	
									$APPLICATION->IncludeFile($SERVER["DOCUMENT_ROOT"]."/include/ft_menu3.php", Array(), Array(
									    "MODE"      => "html",        // будет редактировать в веб-редакторе
									    "NAME"      => "меню 3",      // текст всплывающей подсказки на иконке
									    ));
									?>

								</div>
								<div class="col-xs-12 col-sm-4 col-md-3 mt-30-xs">

									
									<?
									// menu4	
									$APPLICATION->IncludeFile($SERVER["DOCUMENT_ROOT"]."/include/ft_menu4.php", Array(), Array(
									    "MODE"      => "html",        // будет редактировать в веб-редакторе
									    "NAME"      => "меню 4",      // текст всплывающей подсказки на иконке
									    ));
									?>

									
								</div>
								
							</div>

						</div>

						<div class="col-xs-12 col-sm-12 col-md-129">
							<div class="row gap-10">
							<?
								// Copyright	
								$APPLICATION->IncludeFile($SERVER["DOCUMENT_ROOT"]."/include/copyright.php", Array(), Array(
								    "MODE"      => "html",        // будет редактировать в веб-редакторе
								    "NAME"      => "Copyright",      // текст всплывающей подсказки на иконке
								    ));
								?>
							</div>
						</div>

					</div>

				</div>
				
			</div>
			
		</footer>
		<div class="post-hero bg-light">
			<div class="container" style="margin-top:-10px">
				<div class="row">
				<?
				// logo_pay	
				$APPLICATION->IncludeFile($SERVER["DOCUMENT_ROOT"]."/include/logo_pay.php", Array(), Array(
				    "MODE"      => "html",        // будет редактировать в веб-редакторе
				    "NAME"      => "Изображение пл. систем",      // текст всплывающей подсказки на иконке
				    ));
				?>
				</div>
			</div>
		</div>
	</div>  <!-- end Container Wrapper -->
 

 
	<!-- start Back To Top -->
	<div id="back-to-top">
		 <a href="#"><i class="fa fa-angle-up"></i></a>
	</div>
	<!-- end Back To Top -->

<!-- BEGIN B24-->
<script data-skip-moving="true">
        (function(w,d,u){
                var s=d.createElement('script');s.async=true;s.src=u+'?'+(Date.now()/60000|0);
                var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
        })(window,document,'https://cdn.bitrix24.by/b6278671/crm/site_button/loader_2_w2m4cj.js');
</script>
<!-- End B24 -->

<!-- Цель метрики онлайн-чата -->
<script type="text/javascript">
(window.BxLiveChatLoader = window.BxLiveChatLoader || []).push(function() {
   BX.LiveChat.addEventListener(window, 'message', function(event){
      if(event && event.origin == BX.LiveChat.sourceDomain)
      {
         var data = {}; try { data = JSON.parse(event.data); } catch (err){} if(!data.action) return;
         if (data.action == 'sendMessage')
         {
            if (typeof(dataLayer) == 'undefined')
            {
               dataLayer = [];
            }
			dataLayer.push({
				"ecommerce": {
					"purchase": {
						"actionField": {
							"id" : "UserChat",
							"goal_id" : "36883271"
						},
						"products": [ {} ]
					}
				}
			});
         }
      }
   });
}); 
</script>
<!-- Конец цели метрики онлайн-чата -->

<script>
   /**
   *  Sidebar Sticky
   */

   !function ($) {

     $(function(){

       var $window = $(window);
       var $body   = $(document.body);

       var navHeight = $('.navbar').outerHeight(true) + 50;




       /*if (typeof $body.scrollspy === 'undefined'){
           $.getScript('/bitrix/templates/main/js/bootstrap.min.js', function(){
               console.log("script loaded");
           });
       }*/

       $body.scrollspy({
         target: '.scrollspy-sidebar',
         offset: navHeight
       });

       $window.on('load', function () {
         $body.scrollspy('refresh')
       });

       $('.scrollspy-container [href=#]').click(function (e) {
         e.preventDefault()
       });

       // back to top
       setTimeout(function () {
         var $sideBar = $('.scrollspy-sidebar');

         $sideBar.affix({
           offset: {
             top: function () {
               var offsetTop      = 150;//;$sideBar.offset().top
               var sideBarMargin  = parseInt($sideBar.children(0).css('margin-top'), 10);
               var navOuterHeight = $('.scrollspy-nav').height();

               return (this.top = offsetTop - navOuterHeight - sideBarMargin)
             }
           , bottom: function () {
               return (this.bottom = $('.scrollspy-footer').outerHeight(true) + 120)
             }
           }
         })
       }, 100)

     })

   }(window.jQuery)

</script>

<script>
	$(document).on('click', '#modal-order-form-wrapper form button[type="submit"]', function(event){
		var name = $('#modal-order-form-wrapper input[name="ORDER[NAME]"]').val();
		var phone = $('#modal-order-form-wrapper input[name="ORDER[PHONE]"]').val();
		var email = $('#modal-order-form-wrapper input[name="ORDER[EMAIL]"]').val();
		var pattern = /^[a-z0-9_-]+@[a-z0-9-]+\.([a-z]{1,6}\.)?[a-z]{2,6}$/i;
        if(name != ''){
            if(phone != ''){
				if(email != ''){
					if(email.search(pattern) == 0){
						ga('send', 'event', 'sendUA', 'clickUA', 'application');
                	}
				}
            }
        }  
	});

	$(document).on('click', '.booking-form button[type="submit"]', function(event){
		var email = $('.booking-form input[name="email"]').val();
		if(email == ''){
			return;
		}
		var pattern_email = /^[a-z0-9_-]+@[a-z0-9-]+\.([a-z]{1,6}\.)?[a-z]{2,6}$/i;
		if(email.search(pattern_email) != 0){
			return;
		}
		var input_req = $('.booking-form input[required]');
		for (var i = 0; i < $(input_req).length; i++) {
			if($(input_req[i]).val() == ''){
				return;
			}
		}
		ga('send', 'event', 'button', 'to_book', 'book_tour');
	});
</script>

</body>

<?$APPLICATION->ShowPanel();?>

</html>