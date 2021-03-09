<div class="gb-product-sidebar-ruouvang widget-sidebar">
    <aside class="widget">
        <h3 class="widget-title-sidebar-ruouvang">Sản phẩm mới nhất</h3>
        <div class="widget-content">
            <div class="gb-newlist-details">
                <?php 
                    $action_product = new action_product();
                    $list_product_new = $action_product->getListProductNew_hasLimit(8);
                    foreach ($list_product_new as $item) {
                        $rowLang1 = $action_product->getProductLangDetail_byId($item['product_id'],$lang);
                        $row1 = $action_product->getProductDetail_byId($item['product_id'],$lang); 
                ?>
                    <div class="gb-product-sidebar_mptoto-item">
                        <div class="gb-product-sidebar_mptoto-item-img">
                            <a href="/<?= $rowLang1['friendly_url'] ?>">
                                <img src="/images/<?= $row1['product_img'] ?>" alt="" class="img-responsive">
                            </a>
                        </div>
                        <div class="gb-product-sidebar_mptoto-item-info">
                            <h4>
                                <a href="/<?= $rowLang1['friendly_url'] ?>">
                                    <?= $rowLang1['lang_product_name'] ?>
                                </a>
                            </h4>
                            <!--PRICE-->
                            <?php include DIR_PRODUCT."MS_PRODUCT_MPTOTO_0002.php";?>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </aside>
</div>