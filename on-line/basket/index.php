<?define("NOT_FLOAT_RIGHT", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("ROBOTS", "noindex, nofollow");
$APPLICATION->SetTitle("Корзина услуг");
?><iframe
src="http://booking2.otpusk.by:8080/mw_search/TourDates.aspx?priceKey=<?echo htmlspecialcharsbx($_GET['priceKey']);?>&sid=<?echo htmlspecialcharsbx($_GET['sid']);?>&date=<?echo htmlspecialcharsbx($_GET['date']);?>" width="100%" scrolling="no" id="frame_block" ></iframe>
<script>
  document.domain = "otpusk.by";
  var sizeFrame = "0px";

 //alert(document.domain );
 //alert("!");

var refresh_iframe = function(){

  //jQuery('#frame_block').attr('height', '0px' );
  var x = document.getElementById("frame_block");
  var y = (x.contentWindow || x.contentDocument);

  if (y.document) y = y.document;

  //y.body.style.height= "0%";
  var size = y.body.clientHeight+ 'px';//scrollHeight

  //alert(sizeFrame + " != " + size + " == " + y.body.scrollHeight);
  if (sizeFrame != size)
  {
     jQuery('#frame_block').attr('height', size );
     sizeFrame = size;
  }
};

/*jQuery(document).ready(function(){
 alert("!");
 setInterval(refresh_iframe, 50);
});
*/

 //alert("!");
 setInterval(refresh_iframe,  50);
</script><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>