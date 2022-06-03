
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

