
<div class="container">
  <div class="row">
    <div class="col">
      <div class="h1">Курсы валют</div>
    </div>
  </div>
  <!-- <div class="row justify-content-end">
    <div class="col-lg-4 col-md-6 col-sm-12 text-right">
      <a href="?add=Y" class="btn btn-outline-info">
        <i class="fa fa-plus-circle" aria-hidden="true"></i>
        Добавить
      </a>
    </div>
  </div> -->
  <?php foreach ($exchange_rates->items_arr as $key => $value): ?>
    <div class="row border-bottom pt-1 pb-1">
      <div class="col"><?php echo $value['PROPERTY_DATE_VALUE'] ?></div>
      <div class="col">USD: <?php echo round($value['PROPERTY_USD_VALUE'],4); ?></div>
      <div class="col">EUR: <?php echo round($value['PROPERTY_EUR_VALUE'],4); ?></div>
      <div class="col">RUB: <?php echo round($value['PROPERTY_RUB_VALUE'],4); ?></div>
      <div class="col">
        <a href="?page_number=<?php echo $exchange_rates->pagination['page_number'];?>&update=<?php echo $value['ID'];?>"
          class="btn btn-outline-info">
          <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
        </a>
      </div>
    </div>
  <?php endforeach ?>
</div>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-4 col-md-6 col-sm-12">
      <?php if ($exchange_rates->pagination['page_number']>1): ?>
        <a href="?page_number=1">1</a>...
      <?php endif ?>
      <?php if ($exchange_rates->pagination['page_number']>2): ?>
        <a href="?page_number=<?php echo $exchange_rates->pagination['page_number']-1;?>">
          <?php echo $exchange_rates->pagination['page_number']-1;?>
        </a>
      <?php endif ?>
      <?php echo $exchange_rates->pagination['page_number'];?>
      <?php if ($exchange_rates->pagination['page_number']<$exchange_rates->pagination['page_count']): ?>
       <a href="?page_number=<?php echo $exchange_rates->pagination['page_number']+1;?>">
        <?php echo $exchange_rates->pagination['page_number']+1;?>
      </a> 
    <?php endif ?>
    ...
    <a href="?page_number=<?php echo $exchange_rates->pagination['page_count'];?>">
      <?php echo $exchange_rates->pagination['page_count'];?>
    </a>
  </div>
</div>
</div>

