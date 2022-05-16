<?

// телефонный справочник

$o = array('SORT' => "ASC");
$f = array("IBLOCK_ID" => Set::PHONEBOOK_IBLOCK_ID, "ACTIVE" => "Y");
$s = array("NAME", "ID", "PROPERTY_PHONE");

	\Bitrix\Main\Loader::includeModule('iblock');

	$db = CIBlockElement::GetList($o, $f, false, false, $s );

	$els = array();
	while($el = $db->fetch())
		$els[$el['ID']] = $el;

if(!empty($els))
{
	if($_REQUEST['phid'] && isset($els[$_REQUEST['phid']]))
		$_SESSION['phone_number_id'] = $_REQUEST['phid'];

	if(isset($_SESSION['phone_number_id']) && isset($els[$_SESSION['phone_number_id']]))
	{
		$current = $els[$_SESSION['phone_number_id']];
		unset($els[$_SESSION['phone_number_id']]);
	}
	else
		$current = array_shift($els);


?>
<div class="navbar-phone">
	<a id="currncy-dropdown" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
		<?= $current['NAME']?>
		<span class="caret"></span>
	</a>
	<ul class="dropdown-menu" aria-labelledby="language-dropdown" >
		<?foreach($els as $el):?>
		<!--noindex--><li><a rel='nofollow' href="<?= $APPLICATION->GetCurPageParam('phid=' . $el['ID'], array('phid'))?>"><?= $el['NAME']?></a></li><!--/noindex-->
		<?endforeach?>
	</ul>
	<i class="fa fa-phone"></i> <a style="color:#333" href="tel:<?= $current['PROPERTY_PHONE_VALUE']?>"><?= $current['PROPERTY_PHONE_VALUE']?></a>
</div>
<?}?>


