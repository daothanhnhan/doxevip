<link rel="stylesheet" href="/plugin/owl-carouse/owl.carousel.min.css">
<link rel="stylesheet" href="/plugin/owl-carouse/owl.theme.default.min.css">
<div class="gb-news-bloghome_mptoto gb-maysanxuat_cuanhua">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="gb-producttab-home_mptoto-title">
                    <!-- <img src="/images/<?= $rowConfig['icon_web'] ?>" alt="" class="img-responsive" style="width: 50px;"> -->
                    <h2><a href="">Sản phẩm bán chạy</a></h2>
                    <div class="underline-product_mptoto"></div>
                    <!-- <p>Tin tức luôn được cập nhật thường xuyên đem đến cho khách hàng những thông tin hữu ích nhất </p> -->
                </div>
            </div>
        </div>
        <div class="gb-news-bloghome_mptoto-slide owl-carousel owl-theme">
            <?php
                // $news = new action_news();
                // $list_news_new = $news->getListNewsNew_hasLimit(8);
                $home_pro_hot = $action->getList('product', 'product_hot', '1', 'product_id', 'desc', '', '8', '');
                foreach ($home_pro_hot as $item) {
                    $row = $item;
            ?>
                <div class="">
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
</div>
<script src="/plugin/owl-carouse/owl.carousel.min.js"></script>
<script src="/plugin/waypoint/jquery.waypoints.min.js"></script>
<script src="/plugin/wow/wow.min.js"></script>
<script src="/plugin/animsition/css/animate.css"></script>
<script>
    new WOW().init();
</script>
<script>
    $(document).ready(function (){
        $('.gb-news-bloghome_mptoto-slide').owlCarousel({
            loop:true,
            margin:30,
            navSpeed:500,
            dots: true,
            autoplay: true,
            rewind: true,
            navText:[],
            responsive:{
                0:{
                    items:1,
                    nav:false
                },
                767:{
                    items: 5,
                    nav:true
                }
            }
        });
    });
</script>