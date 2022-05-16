<?define("NOT_FLOAT_RIGHT", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("On-line бронирование");
?><iframe src="https://booking2.otpusk.by/online/extra/quoteddynamic.aspx" width="100%" height="200px" scrolling="no" id="frame_block"></iframe>
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
  var size = y.body.scrollHeight+ 'px';//scrollHeight
  //console.log(size);
  /*alert(sizeFrame + " != " + size + " == " + y.body.scrollHeight);*/
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