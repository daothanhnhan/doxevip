<?php 
  $khuyen_mai_cat = $action->getList('sale_cat', '', '', 'id', 'asc', '', '', '');
?>
<link rel="stylesheet" type="text/css" href="/css/style-ctkm.css">
<!-- <script type="text/javascript">

$(document).ready(function() {
   menuPageSale();
   tab2();
});
function menuPageSale() {  
    $('.linkMFPS').click(function(){ 
       $('.linkMFPS').removeClass('linkMFPSSlected');
       $(this).addClass('linkMFPSSlected');
       return false;
    });
 
} 
</script> -->

<div class="coverMenuFixedPageSale">
  <ul class="listMFPS">
    <li><a href="#BoxSale001" class="linkMFPS linkMFPSSlected">Chương Trình Ưu Đãi</a></li>
    <?php 
      $d = 0;
      foreach ($khuyen_mai_cat as $item_cat) { 
        $d++;
    ?>
    <li><a href="#BoxSale00<?= $d ?>" class="linkMFPS"><?= $item_cat['name'] ?></a></li>
    <?php } ?>
  </ul>
</div>

<!--PAGE KHUYẾN MÃI-->
<div class="Content-Main_SalePage"> 
    <div class="container">
      <div class="row"> 
          <div class="col-md-12">
              <?php 
              $d = 0;
              foreach ($khuyen_mai_cat as $item_cat) { 
                $d++;
                $list_sale = $action->getList('sale_item', 'sale_cat_id', $item_cat['id'], 'id', 'asc', '', '', '');
                $count = count($list_sale);
              ?>
              <div id="BoxSale00<?= $d ?>" class="BoxSale">
                  <a href="<?= $item_cat['link'] ?>" class="avtBoxSalePage"><img src="/images/<?= $item_cat['image'] ?>"></a>
                  <?php if ($count == 1) { ?>
                  <div class="BoxSale01Col"> 
                      <?php foreach ($list_sale as $item) { ?>
                      <div class="colSale01">
                        <a href="<?= $item['link'] ?>"><img src="/images/<?= $item['image'] ?>"></a>
                      </div> 
                      <?php } ?>
                  </div>
                  <?php } elseif ($count == 2) { ?>
                  <div class="BoxSale02Col">
                      <?php foreach ($list_sale as $item) { ?>
                      <div class="colSale02"> 
                        <a href="<?= $item['link'] ?>"><img src="/images/<?= $item['image'] ?>"></a>
                      </div>
                       <?php } ?>
                  </div>
                  <?php } elseif ($count == 3) { ?>
                  <div class="BoxSale02Col"> 
                      <?php foreach ($list_sale as $item) { ?>
                      <div class="colSale03">
                        <a href="<?= $item['link'] ?>"><img src="/images/<?= $item['image'] ?>"></a>
                      </div>
                      <?php } ?>
                  </div>
                  <?php } else { ?>
                  <div class="BoxSale03Col"> 
                      <?php foreach ($list_sale as $item) { ?>
                      <div class="colSale04">
                        <a href="<?= $item['link'] ?>"><img src="/images/<?= $item['image'] ?>"></a>
                      </div>
                      <?php } ?>
                  </div>
                  <?php } ?>
              </div>
              <?php } ?>
              
          </div>
      </div>
    </div> 
</div>
