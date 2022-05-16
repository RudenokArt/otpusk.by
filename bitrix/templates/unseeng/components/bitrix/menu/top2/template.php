<?$prov=CModule::IncludeModuleEx("simai.special");if($prov==0||$prov==3)return;?><?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();
//dm($arResult);
?>

<?if(!empty($arResult)):?>
<div id="navbar" class="collapse navbar-collapse navbar-arrow">
	<ul class="nav navbar-nav" id="responsive-menu">
	
	<?
	$last_dl = $c_dl = 1;
	$li = $p = "";
	foreach($arResult as $item):
		$c_dl = $item["DEPTH_LEVEL"];
		$p = "<a" . ($item["SELECTED"] ? " class='act'" : "") . " href='" . $item["LINK"] . "'>" . $item["TEXT"] . "</a>";
	?>
		<?if($last_dl == $c_dl):?>
			
			<?= $li?>
			<li><?= $p?>
			
		<?elseif($last_dl < $item["DEPTH_LEVEL"]):?>
			
			<ul>
				<li><?= $p?>	
			
		<?else:?>
				</li>
			</ul>
			<li><?= $p?>

		<?endif;

		$last_dl = $item["DEPTH_LEVEL"];
		$li = "</li>";
		?>
	<?endforeach?>

	<?= str_repeat("</li></ul>", $c_dl)?>

</div><!--/.nav-collapse -->
<?endif;return;?>
