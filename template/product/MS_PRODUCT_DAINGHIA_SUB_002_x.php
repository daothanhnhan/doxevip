<?php 
    $product_sale = $action_product->getListProductSaleOff_hasLimit(5);
?> 

<div class="gb-maysanxuat_cuanhom listHomeProductDetail001 owl-carousel owl-theme"> 

    <!-- <div class="row ">  -->
        <?php 
        foreach ($product_sale as $row) { 
            $item = $kiotviet->get_product($row['kiotviet_id']);
                if (empty($row['product_img'])) {
                    // var_dump($item['images']);
                    $row['product_img'] = $item['images'][0];
                } else {
                    $row['product_img'] = "/images/".$row['product_img'];
                }

        ?>

        <!-- <div class="colOption"> -->

            <div class="coverBoxPDH">
                <div class="topBoxPDH">
                    <a href="/<?= $row['friendly_url'] ?>" class="linkBoxPDH">
                        <img src="<?= $row['product_img'] ?>" class="mainImgBoxPDH">
                    </a>
                    <?php include DIR_PRODUCT."MS_PRODUCT_DAINGHIA_TAG_0001.php";?>
                    <?php include DIR_PRODUCT."MS_PRODUCT_DAINGHIA_ICON_0001.php";?>
                </div>
                <div class="bottomBoxPDH">
                    <p class="codeProductBoxPDH">Mã sp: <?= $item['code'] ?></p>
                    <a href="/<?= $row['friendly_url'] ?>" class="nameProductBoxPDH"><?= $item['name'] ?></a>
                    <?php include DIR_PRODUCT."MS_PRODUCT_MPTOTO_0002_1.php";?>
                </div>
            </div>

        <!-- </div>  -->
        <?php } ?>

    <!-- </div> -->

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
        $('.listHomeProductDetail001').owlCarousel({
            loop:true,
            margin:0,
            navSpeed:500,
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
                    items: 5,
                    nav:true
                }
            }
        });
    });
</script>