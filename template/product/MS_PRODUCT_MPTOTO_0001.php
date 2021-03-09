<?php
    $product = new action_product();
    $boncau = $product->getProductCatDetail_byId(232,$lang);
    $chauruamat = $product->getProductCatDetail_byId(230,$lang);
    $sentamvoichau = $product->getProductCatDetail_byId(240,$lang);
    $bcnam_vanxatieu = $product->getProductCatDetail_byId(231,$lang);

    $bontam = $product->getProductCatDetail_byId(239,$lang);
    $pkphongtam = $product->getProductCatDetail_byId(237,$lang);
    $binhnonglanh = $product->getProductCatDetail_byId(426,$lang);
    $guongphongtam = $product->getProductCatDetail_byId(238,$lang);
?>
<div class="gb-producttab-home_mptoto" style="padding-bottom: 0;">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="gb-producttab-home_mptoto-title">
                    <img src="/images/<?= $rowConfig['icon_web'] ?>" alt="" class="img-responsive" style="width: 50px;">
                    <h2><a href="">THIẾT BỊ PHÒNG TẮM</a></h2>
                    <div class="underline-product_mptoto"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Bồn cầu -->
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="gb-product-item_mptoto wow slideInUp" data-wow-duration="1s">
                    <div class="gb-product-item-img">
                        <div class="gb-product-item-img-main">
                            <a href="/<?= $boncau['friendly_url'] ?>"><img src="/images/<?= $boncau['productcat_main_img'] ?>" alt="" class="img-responsive"></a>
                        </div>
                    </div>
                    <div class="gb-product-item-img-text">
                        <h2><a href="/<?= $boncau['friendly_url'] ?>"><?= $boncau['productcat_name'] ?></a></h2>
                        <?= $boncau['productcat_des'] ?>
                    </div>
                </div>
            </div>
            <!-- Chậu rửa mặt -->
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="gb-product-item_mptoto wow slideInUp" data-wow-duration="1s">
                    <div class="gb-product-item-img">
                        <div class="gb-product-item-img-main">
                            <a href="/<?= $chauruamat['friendly_url'] ?>"><img src="/images/<?= $chauruamat['productcat_main_img'] ?>" alt="" class="img-responsive"></a>
                        </div>
                    </div>
                    <div class="gb-product-item-img-text">
                        <h2><a href="/<?= $chauruamat['friendly_url'] ?>"><?= $chauruamat['productcat_name'] ?></a></h2>
                        <?= $chauruamat['productcat_des'] ?>
                    </div>
                </div>
            </div>

            <!-- Sen tắm vòi tắm -->
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="gb-product-item_mptoto wow slideInUp" data-wow-duration="1s">
                    <div class="gb-product-item-img">
                        <div class="gb-product-item-img-main">
                            <a href="/<?= $sentamvoichau['friendly_url'] ?>"><img src="/images/<?= $sentamvoichau['productcat_main_img'] ?>" alt="" class="img-responsive"></a>
                        </div>
                    </div>
                    <div class="gb-product-item-img-text">
                        <h2><a href="/<?= $boncau['friendly_url'] ?>"><?= $sentamvoichau['productcat_name'] ?></a></h2>
                        <?= $sentamvoichau['productcat_des'] ?>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="gb-product-item_mptoto wow slideInUp" data-wow-duration="1s">
                    <div class="gb-product-item-img">
                        <div class="gb-product-item-img-main">
                            <a href="/<?= $bcnam_vanxatieu['friendly_url'] ?>"><img src="/images/<?= $bcnam_vanxatieu['productcat_main_img'] ?>" alt="" class="img-responsive"></a>
                        </div>
                    </div>
                    <div class="gb-product-item-img-text">
                        <h2><a href="/<?= $bcnam_vanxatieu['friendly_url'] ?>"><?= $bcnam_vanxatieu['productcat_name'] ?></a></h2>
                        <?= $bcnam_vanxatieu['productcat_des'] ?>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="gb-product-item_mptoto wow slideInUp" data-wow-duration="1s">
                    <div class="gb-product-item-img">
                        <div class="gb-product-item-img-main">
                            <a href="/<?= $bontam['friendly_url'] ?>"><img src="/images/<?= $bontam['productcat_main_img'] ?>" alt="" class="img-responsive"></a>
                        </div>
                    </div>
                    <div class="gb-product-item-img-text">
                        <h2><a href="/<?= $bontam['friendly_url'] ?>"><?= $bontam['productcat_name'] ?></a></h2>
                        <?= $bontam['productcat_des'] ?>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="gb-product-item_mptoto wow slideInUp" data-wow-duration="1s">
                    <div class="gb-product-item-img">
                        <div class="gb-product-item-img-main">
                            <a href="/<?= $pkphongtam['friendly_url'] ?>"><img src="/images/<?= $pkphongtam['productcat_main_img'] ?>" alt="" class="img-responsive"></a>
                        </div>
                    </div>
                    <div class="gb-product-item-img-text">
                        <h2><a href="/<?= $pkphongtam['friendly_url'] ?>"><?= $pkphongtam['productcat_name'] ?></a></h2>
                        <?= $pkphongtam['productcat_des'] ?>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="gb-product-item_mptoto wow slideInUp" data-wow-duration="1s">
                    <div class="gb-product-item-img">
                        <div class="gb-product-item-img-main">
                            <a href="/<?= $binhnonglanh['friendly_url'] ?>"><img src="/images/<?= $binhnonglanh['productcat_main_img'] ?>" alt="" class="img-responsive"></a>
                        </div>
                    </div>
                    <div class="gb-product-item-img-text">
                        <h2><a href="/<?= $binhnonglanh['friendly_url'] ?>"><?= $binhnonglanh['productcat_name'] ?></a></h2>
                        <?= $binhnonglanh['productcat_des'] ?>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="gb-product-item_mptoto wow slideInUp" data-wow-duration="1s">
                    <div class="gb-product-item-img">
                        <div class="gb-product-item-img-main">
                            <a href="/<?= $guongphongtam['friendly_url'] ?>"><img src="/images/<?= $guongphongtam['productcat_main_img'] ?>" alt="" class="img-responsive"></a>
                        </div>
                    </div>
                    <div class="gb-product-item-img-text">
                        <h2><a href="/<?= $guongphongtam['friendly_url'] ?>"><?= $guongphongtam['productcat_name'] ?></a></h2>
                        <?= $guongphongtam['productcat_des'] ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/plugin/waypoint/jquery.waypoints.min.js"></script>
<script src="/plugin/wow/wow.min.js"></script>
<script src="/plugin/animsition/css/animate.css"></script>
<script>
    new WOW().init();
</script>