<link rel="stylesheet" href="/plugin/owl-carouse/owl.carousel.min.css">
<link rel="stylesheet" href="/plugin/owl-carouse/owl.theme.default.min.css">
<?php
    $product = new action_product();
    $product_cat = $product->getProductCatDetail_byId( 233,$lang);
?>
<div class="gb-productthietbinhabep-home_mptoto gb-productgach-home_mptoto" style="padding-bottom: 0;">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="gb-producttab-home_mptoto-title">
                    <img src="/images/<?= $rowConfig['icon_web'] ?>" alt="" class="img-responsive" style="width: 50px;">
                    <h2><a href="/<?= $product_cat['friendly_url'] ?>"><?= $product_cat['productcat_name'] ?></a></h2>
                    <div class="underline-product_mptoto"></div>
                    <?= $product_cat['productcat_des'] ?>
                </div>
            </div>
        </div>
        <div class="gb-productthietbinhabep-home_mptoto-slide owl-carousel owl-theme">
            <?php 
                $list_product_id = $product->getProductCat_byProductCatIdParent($product_cat['productcat_id'], 'DESC');
                foreach ($list_product_id as $item) {
            ?>
                <div class="item">
                    <div class="gb-product-item_mptoto wow slideInUp" data-wow-duration="1s">
                        <div class="gb-product-item-img">
                            <div class="gb-product-item-img-main">
                                <a href="/<?= $item['friendly_url'] ?>"><img src="/images/<?= $item['productcat_img'] ?>" alt="" class="img-responsive"></a>
                            </div>
                            <!-- <div class="gb-product-item-img-replate">
                                <a href="/<?= $item['friendly_url'] ?>"><img src="/images/<?= $item['product_img_2'] ?>" alt="" class="img-responsive"></a>
                            </div> -->
                        </div>
                        <div class="gb-product-item-img-text">
                            <h2><a href="/<?= $item['friendly_url'] ?>"><?= $item['productcat_name'] ?></a></h2>
                            <?= $item['productcat_des'] ?>
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
        $('.gb-productthietbinhabep-home_mptoto-slide').owlCarousel({
            loop:true,
            margin:30,
            navSpeed:500,
            nav:true,
            dots: false,
            autoplay: true,
            rewind: true,
            navText:[],
            responsive:{
                0:{
                    items:1,
                    nav:false
                },
                767:{
                    items: 3,
                    nav:true
                }
            }
        });
    });
</script>