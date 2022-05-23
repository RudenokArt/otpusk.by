<?php $exchange_rates = new InfoBlock([],['ID'=>$_GET['update']], false, false, [
  'ID',
  'IBLOCK_ID',
  'CODE',
  'CREATED_DATE',
  'PROPERTY_USD',
  'PROPERTY_EUR',
  'PROPERTY_RUB',
  'NAME',
]); ?>

<?php if (isset($_POST['update'])): ?>
  <?php CIBlockElement::SetPropertyValuesEx($_POST['update'],23, [
    'USD'=>$_POST['USD'],
    'EUR'=>$_POST['EUR'],
    'RUB'=>$_POST['RUB'],
  ]); ?>
  <div class="container">
    <div class="alert alert-info" role="alert">
      Данные сохранены в базу.
    </div>
  </div>
  <?php header('Location: ?page_number='.$_GET['page_number']);?>

<?php else: ?>
  <div class="container">
    <div class="row p-5">
      <div class="h1">
        Редактирование курса валют на дату:
        <?php echo $exchange_rates->items_arr[0]['NAME'];  ?>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card">
          <div class="card-body">
            <form action="" method="post">
              <div class="row align-items-center p-1">
                <div class="col-8">
                 <input value="<?php echo $exchange_rates->items_arr[0]['NAME']; ?>" 
                 type="hidden" class="form-control" name="DATE">
               </div>
             </div>

             <div class="row align-items-center p-1">
              <div class="col-4">USD:</div>
              <div class="col-8">
               <input value="<?php echo round($exchange_rates->items_arr[0]['PROPERTY_USD_VALUE'],4); ?>" 
               type="text" class="form-control" name="USD">
             </div>
           </div>

           <div class="row align-items-center p-1">
            <div class="col-4">EUR:</div>
            <div class="col-8">
             <input value="<?php echo round($exchange_rates->items_arr[0]['PROPERTY_EUR_VALUE'],4); ?>" 
             type="text" class="form-control" name="EUR">
           </div>
         </div>

         <div class="row align-items-center p-1">
          <div class="col-4">RUB:</div>
          <div class="col-8">
           <input value="<?php echo round($exchange_rates->items_arr[0]['PROPERTY_RUB_VALUE'],4); ?>" 
           type="text" class="form-control" name="RUB">
         </div>
       </div>

       <div class="row p-1 text-center justify-content-center">
         <div class="col-2">
           <a href="?page_number=<?php echo $_GET['page_number'] ?>" class="btn btn-outline-danger">
             <i class="fa fa-times" aria-hidden="true"></i>
           </a>
         </div>
         <div class="col-2">
           <button value="<?php echo $exchange_rates->items_arr[0]['ID']; ?>"
            class="btn btn-outline-success" name="update" >
            <i class="fa fa-check" aria-hidden="true"></i>
          </button>
        </div>
      </div>
    </form>
  </div>
</div>
</div>
</div>
</div>
<?php endif ?>

