<?php 
    $home_procat_phongtam = $action_product->getProductCat_byProductCatIdParent_Limit(468, 'desc', 3);
?>
<div class="gb-producttab-home_mptoto">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="gb-producttab-home_mptoto-title">
                    <img src="/images/gggggg.png" alt="" class="img-responsive" style="width: 50px;">
                    <h2><a href="/san-pham-noi-bat">SẢN PHẨM NỔI BẬT</a></h2>
                    <div class="underline-product_mptoto"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Bồn cầu -->
            <?php foreach ($home_procat_phongtam as $item) { ?>
            <div class="col-md-4">
                <div class="gb-product-item_mptoto wow slideInUp" data-wow-duration="1s" style="visibility: visible; animation-duration: 1s;">
                    <div class="gb-product-item-img">
                        <div class="gb-product-item-img-main" style="height: auto;">
                            <a href="/<?= $item['friendly_url'] ?>"><img src="/images/<?= $item['productcat_img'] ?>" alt="<?= $item['productcat_name'] ?>" class="img-responsive" style="width: 100%;"></a>
                        </div>
                    </div>
                    <div class="gb-product-item-img-text">
                        <h2><a href="/<?= $item['friendly_url'] ?>"><?= $item['productcat_name'] ?></a></h2>
                                            </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>