<link rel="stylesheet" href="/plugin/owl-carouse/owl.carousel.min.css">
<link rel="stylesheet" href="/plugin/owl-carouse/owl.theme.default.min.css">
<?php
    $product = new action_product();
    $beptu = $product->getProductCatDetail_byId( 234,$lang);
    $bephongngoai = $product->getProductCatDetail_byId( 436,$lang);
    $mayhutmui = $product->getProductCatDetail_byId( 235,$lang);
    $bepga = $product->getProductCatDetail_byId( 437,$lang);
?>
<div class="gb-productthietbinhabep-home_mptoto" style="padding-bottom: 0;">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="gb-producttab-home_mptoto-title">
                    <img src="/images/<?= $rowConfig['icon_web'] ?>" alt="" class="img-responsive" style="width: 50px;">
                    <h2><a href="/<?= $product_cat['friendly_url'] ?>">THIẾT BỊ NHÀ BẾP</a></h2>
                    <div class="underline-product_mptoto"></div>
                </div>
            </div>
        </div>
        <div class="gb-productthietbinhabep-home_mptoto-slide owl-carousel owl-theme">
            <div class="item">
                <div class="gb-product-item_mptoto wow slideInUp" data-wow-duration="1s">
                    <div class="gb-product-item-img">
                        <div class="gb-product-item-img-main">
                            <a href="/<?= $beptu['friendly_url'] ?>"><img src="/images/<?= $beptu['productcat_main_img'] ?>" alt="" class="img-responsive"></a>
                        </div>
                    </div>
                    <div class="gb-product-item-img-text">
                        <h2><a href="/<?= $beptu['friendly_url'] ?>"><?= $beptu['productcat_name'] ?></a></h2>
                        <?= $beptu['productcat_des'] ?>
                    </div>
                </div>
            </div>


            <div class="item">
                <div class="gb-product-item_mptoto wow slideInUp" data-wow-duration="1s">
                    <div class="gb-product-item-img">
                        <div class="gb-product-item-img-main">
                            <a href="/<?= $bephongngoai['friendly_url'] ?>"><img src="/images/<?= $bephongngoai['productcat_main_img'] ?>" alt="" class="img-responsive"></a>
                        </div>
                    </div>
                    <div class="gb-product-item-img-text">
                        <h2><a href="/<?= $bephongngoai['friendly_url'] ?>"><?= $bephongngoai['productcat_name'] ?></a></h2>
                        <?= $bephongngoai['productcat_des'] ?>
                    </div>
                </div>
            </div>

            <div class="item">
                <div class="gb-product-item_mptoto wow slideInUp" data-wow-duration="1s">
                    <div class="gb-product-item-img">
                        <div class="gb-product-item-img-main">
                            <a href="/<?= $mayhutmui['friendly_url'] ?>"><img src="/images/<?= $mayhutmui['productcat_main_img'] ?>" alt="" class="img-responsive"></a>
                        </div>
                    </div>
                    <div class="gb-product-item-img-text">
                        <h2><a href="/<?= $mayhutmui['friendly_url'] ?>"><?= $mayhutmui['productcat_name'] ?></a></h2>
                        <?= $mayhutmui['productcat_des'] ?>
                    </div>
                </div>
            </div>

            <div class="item">
                <div class="gb-product-item_mptoto wow slideInUp" data-wow-duration="1s">
                    <div class="gb-product-item-img">
                        <div class="gb-product-item-img-main">
                            <a href="/<?= $bepga['friendly_url'] ?>"><img src="/images/<?= $bepga['productcat_main_img'] ?>" alt="" class="img-responsive"></a>
                        </div>
                    </div>
                    <div class="gb-product-item-img-text">
                        <h2><a href="/<?= $bepga['friendly_url'] ?>"><?= $bepga['productcat_name'] ?></a></h2>
                        <?= $bepga['productcat_des'] ?>
                    </div>
                </div>
            </div>
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
                    items:2,
                    nav:false
                },
                767:{
                    items: 3
                }
            }
        });
    });
</script>