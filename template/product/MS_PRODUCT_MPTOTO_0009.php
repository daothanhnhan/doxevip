<link rel="stylesheet" href="/plugin/owl-carouse/owl.carousel.min.css">
<link rel="stylesheet" href="/plugin/owl-carouse/owl.theme.default.min.css">
<div class="gb-home-product gb-home-product-relate">
    <div class="titleCategoryProduct_mptoto">SẢN PHẨM LIÊN QUAN</div>
    <div class="gb-home-product-relate-slide owl-carousel owl-theme  gb-page-sanpham_cuanhom">
        <?php
            $action_relative = new action_product();
            $list_pro_relative = $action_relative->getListProductRelate_byIdCat_hasLimit($productcat_id, 8);
            $product_relative = $kiotviet->product_related($product_kv['categoryId']);var_dump($product_relative);
            foreach ($list_pro_relative as $item) {
                $rowLang1 = $action_relative->getProductLangDetail_byId($item['product_id'],$lang);
                $row1 = $action_relative->getProductDetail_byId($item['product_id'],$lang); 
                $item = $row1;
                $row = $item;
        ?>
            <div class="item">
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
        <?php } ?>
    </div>
</div>

<script src="/plugin/owl-carouse/owl.carousel.min.js"></script>
<script>
    $(document).ready(function (){
        var owl = $('.gb-home-product-relate-slide');
        owl.owlCarousel({
            loop:true,
            margin:30,
            navSpeed:500,
            nav:true,
            dots:false,
            autoplay: true,
            rewind: true,
            navText:[],
            responsive:{
                0:{
                    items:1
                },
                767:{
                    items: 2
                },
                992:{
                    items:4
                }
            }
        });
    });
</script>