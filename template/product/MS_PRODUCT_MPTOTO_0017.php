<?php 
    $home_list_procat = $action->getList('productcat', 'productcat_parent', '0', 'productcat_sort_order', 'asc', '', '', '');//echo count($home_list_procat);
?>
<style type="text/css">

</style>
<div class="container">
<?php 
    foreach ($home_list_procat as $item_list) { 
        $list_pro = $action_product->getProductList_byMultiLevel_orderProductId($item_list['productcat_id'],'desc',1,10,'');
?>
<div class="gb-maysanxuat_cuanhua">
    <div class="gb-maysanxuat_cuanhom_title">
        <h2><a href="/<?= $item_list['friendly_url'] ?>" title="" style="color: white;"><?= $item_list['productcat_name'] ?></a></h2>
    </div>
    <div class="row">
        <?php 
            $d = 0;
            foreach ($list_pro['data'] as $item) {
                $d++;
                $row = $item;
        ?>
        <div class="col-md-5ths">
            <div class="gb-product-item_cuanhom">
                <div class="gb-product-item_cuanhom-img">
                    <a href="/<?= $item['friendly_url'] ?>"><img src="/images/<?= $item['product_img'] ?>" alt="<?= $item['product_name'] ?>" class="img-responsive"></a>
                    <div class="overlay">
                        <div class="text"><?= $item['product_des'] ?></div>
                    </div>
                </div>
                <div class="gb-product-item_cuanhom-text">
                    <h2><a href="/<?= $item['friendly_url'] ?>"><?= $item['product_name'] ?></a></h2>
                    <p class="prices-news_nuochoa">Giá: <?= number_format($item['product_price']) ?> đ</p>
                    <a href="javascript:void()" class="gb-product-item-order" onclick="load_url('<?= $row['product_id'] ?>', '<?= $row['product_name'] ?>', '<?= $row['product_price'];?>')">Mua ngay</a>
                </div>
            </div>
        </div>
        <?php 
            if ($d%5==0) {
                echo '<hr style="width:100%;border:0;margin:0;" />';
            }
        } ?>  
    </div>
</div>
<?php } ?>
</div>