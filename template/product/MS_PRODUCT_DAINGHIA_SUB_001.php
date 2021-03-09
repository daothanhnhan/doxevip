<?php 
    $product_hot = $action_product->getListProductHot_hasLimit(4);
?>
<link rel="stylesheet" href="/plugin/owl-carouse/owl.carousel.min.css">
<link rel="stylesheet" href="/plugin/owl-carouse/owl.theme.default.min.css">
<div class="lineProductHome listHomeProductDetail001 owl-carousel owl-theme">  
    <?php 
    foreach ($product_hot as $row) { 
        $anh = json_decode($row['product_des2']);
        if (!empty($row['ten_anh_doi'])) {
            $ten_anh_doi = json_decode($row['ten_anh_doi']);
            $anh[0] = 'http://'.$_SERVER['SERVER_NAME'].'/download/images/'.$ten_anh_doi[0];
        }
        if (!empty($row['product_img'])) {
            $anh[0] = '/images/product/'.$row['product_img'];
        }
        $gia = json_decode($row['product_sub_info2']);
        $gia1 = json_decode($row['product_content2']);
        if (empty($gia1)) {
            $gia_giam = $gia[0]-($gia[0]*($row['product_price_sale']/100));
        } else {
            $gia_giam = $gia1[0];
        }
    ?>
        <!-- <div class="colOption"> -->
     
                <div class="coverBoxPDH">
              
                    <div class="topBoxPDH">
                        <a href="/<?= $row['friendly_url'] ?>" class="linkBoxPDH">
                            <img src="<?= $anh[0] ?>" class="mainImgBoxPDH">
                        </a>
                        <?php include DIR_PRODUCT."MS_PRODUCT_DAINGHIA_TAG_0001.php";?>
                        <?php //include DIR_PRODUCT."MS_PRODUCT_DAINGHIA_ICON_0001.php";?>
                    </div>
                    <div class="bottomBoxPDH">
                        <!-- <p class="codeProductBoxPDH">Mã sp: <?= $item['code'] ?></p> -->
                        <a href="/<?= $row['friendly_url'] ?>" class="nameProductBoxPDH"><?= $row['product_name'] ?></a>
                        <?php include DIR_PRODUCT."MS_PRODUCT_MPTOTO_0002_1.php";?>
                    </div>
                </div>

           

            

        <!-- </div>  -->
    <?php } ?>
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
                    items:2,
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