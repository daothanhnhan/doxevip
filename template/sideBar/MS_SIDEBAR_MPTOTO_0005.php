<div class="gb-product-sidebar-ruouvang widget-sidebar">
    <aside class="widget">
        <h3 class="widget-title-sidebar-ruouvang">Sản phẩm bán chạy</h3>
        <div class="widget-content">
            <div class="gb-newlist-details">
                <?php 
                    $action_product = new action_product();
                    $list_product_new = $action_product->getListProductHot_hasLimit(3);
                    foreach ($list_product_new as $item) {
                        $rowLang1 = $action_product->getProductLangDetail_byId($item['product_id'],$lang);
                        $row1 = $action_product->getProductDetail_byId($item['product_id'],$lang); 
                ?>
                    <div class="col-sm-12 col-xs-12">
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
                                <a href="javascript:void()" class="gb-product-item-order">Mua ngay</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </aside>
</div>