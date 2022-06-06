<form action="" method="post">
  <div class="container pt-5 ">
    <div class="h1">
      Добавление курса валют на дату:
    </div>
    <div class="row justify-content-center">
     <div class="col-lg-4 col-md-6 col-sm-12 p-1">
      <input type="text" class="form-control" name="DATE" placeholder="DATE" required readonly>
    </div>  
  </div>
  <div class="row justify-content-center">
    <div class="col-lg-4 col-md-6 col-sm-12 p-1">
      <input type="text" class="form-control" name="USD" placeholder="USD" required>
    </div> 
  </div>
  <div class="row justify-content-center">
   <div class="col-lg-4 col-md-6 col-sm-12 p-1">
    <input type="text" class="form-control" name="EUR" placeholder="EUR" required>
  </div> 
</div>
<div class="row justify-content-center">
  <div class="col-lg-4 col-md-6 col-sm-12 p-1">
    <input type="text" class="form-control" name="RUB" placeholder="RUB" required>
  </div>
</div>
<div class="row justify-content-center">
  <div class="col-lg-4 col-md-6 col-sm-12 p-1 text-center">
    <button class="btn btn-outline-success" name="exchange_rates_add" value="Y">
      <i class="fa fa-check" aria-hidden="true"></i>
    </button>
    <a href="?page_number=<?php echo $_GET['page_number'] ?>" class="btn btn-outline-danger">
     <i class="fa fa-times" aria-hidden="true"></i>
   </a>
 </div> 
</div>
</div> 
</form>   

<script>
  $( function() {
    $('input[name="DATE"]').datepicker({
      dateFormat: 'dd.mm.yy',
      firstDay: 1,
    });
  } );
</script>