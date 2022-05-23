<?php 
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
global $USER;
// $USER->Authorize(1);
// $USER->Authorize(14116);
$arGroups = CUser::GetUserGroup(14116);
$arGroups[] = 17;
CUser::SetUserGroup(14116, $arGroups);
?>
<!-- BOOTSTRAP -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<!-- FONT AWESSOME -->
<script src="https://use.fontawesome.com/e8a42d7e14.js"></script>

<?php if (in_array(CGroup::GetList(($by="id"), ($order="asc"),['STRING_ID'=>'exchange_rates'])->Fetch()['ID'], 
$USER->GetUserGroupArray())): ?>

<?php if (isset($_GET['update'])): ?>
  <?php include_once ('update_form.php'); ?>
<?php else: ?>
  <?php include_once ('items_list.php'); ?>
<?php endif ?>


<?php else: ?>
  <div class="container">
    <div class="row">
      <div class="col p-5 text-center">
        <div class="alert alert-info" role="alert">
          Не достаточно прав для доступа к разделу.
        </div>
      </div>
    </div>
  </div>
<?php endif ?>