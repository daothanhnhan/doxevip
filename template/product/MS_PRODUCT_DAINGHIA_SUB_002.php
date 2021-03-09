<?php 
    $product_sale = $action_product->getListProductSaleOff_hasLimit(5);
?>

<div class="lineProductHome listHomeProductDetail001 owl-carousel owl-theme">  
    <?php 
    foreach ($product_sale as $row) { 

    ?>
        <!-- <div class="colOption"> -->

            <div class="coverBoxPDH">
                <div class="topBoxPDH">
                    <a href="/<?= $row['friendly_url'] ?>" class="linkBoxPDH">
                        <img src="/images/<?= $row['product_img'] ?>" class="mainImgBoxPDH">
                    </a>
                    <?php include DIR_PRODUCT."MS_PRODUCT_DAINGHIA_TAG_0001.php";?>
                    <?php include DIR_PRODUCT."MS_PRODUCT_DAINGHIA_ICON_0001.php";?>
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
