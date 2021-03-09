<?php
    $product = new action_product();
    $product_cat = $product->getProductCatDetail_byId( 425,$lang);
?>
<div class="gb-productgach-home_mptoto">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="gb-producttab-home_mptoto-title">
                    <img src="/images/mem.png" alt="" class="img-responsive">
                    <h2><a href="/<?= $product_cat['friendly_url'] ?>"><?= $product_cat['productcat_name'] ?></a></h2>
                    <div class="underline-product_mptoto"></div>
                    <?= $product_cat['productcat_des'] ?>
                </div>
            </div>
        </div>
        <div class="row">
            <?php 
                $list_product_id = $product->getListProductRelate_byIdCat_hasLimit($product_cat['productcat_id'], 8);
                foreach ($list_product_id as $item) {
            ?>
                <div class="col-md-3 col-sm-6">
                    <div class="gb-product-item_mptoto wow slideInUp" data-wow-duration="1s">
                        <div class="gb-product-item-img">
                            <div class="gb-product-item-img-main">
                                <a href="/<?= $item['friendly_url'] ?>"><img src="/images/<?= $item['product_img'] ?>" alt="" class="img-responsive"></a>
                            </div>
                            <div class="gb-product-item-img-replate">
                                <a href="/<?= $item['friendly_url'] ?>"><img src="/images/<?= $item['product_img_2'] ?>" alt="" class="img-responsive"></a>
                            </div>
                        </div>
                        <div class="gb-product-item-img-text">
                            <h2><a href="/<?= $item['friendly_url'] ?>"><?= $item['product_name'] ?></a></h2>
                            <?= $item['product_des'] ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<script src="/plugin/waypoint/jquery.waypoints.min.js"></script>
<script src="/plugin/wow/wow.min.js"></script>
<script src="/plugin/animsition/css/animate.css"></script>
<script>
    new WOW().init();
</script>