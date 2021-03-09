<?php 
    // $item_cat = $action->getDetail('productcat', 'productcat_id', $item_procat_tab['productcat_id']);
    $list_product = $action_product->getProductList_byMultiLevel_orderProductId($item_procat_tab['productcat_id'],'desc',1,10,'');
?>
<div class="lineProductHome">  
    <?php 
    foreach ($list_product['data'] as $row) {
        $anh = json_decode($row['product_des2']);
        $gia = json_decode($row['product_sub_info2']);
    ?>
        <div class="colOption">

            <div class="coverBoxPDH">
                <div class="topBoxPDH">
                    <a href="/<?= $row['friendly_url'] ?>" class="linkBoxPDH">
                        <img src="<?= $anh[0] ?>" class="mainImgBoxPDH">
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

        </div>          
    <?php } ?>
</div>