<?php 
    $row_cat = $kiotviet->get_procat_gb('1383119');
    $list_idcat = $kiotviet->get_list_idcat_1($all_procat, '1383119');
    $list_product = array();
    $d = 0;
    foreach ($product_all as $item_all) {
        if (in_array($item_all['categoryId'], $list_idcat)) {
            $d++;
            $list_product[] = $item_all;
            if ($d == 10) {
                break;
            }
        }
    }
?>
<div class="lineProductHome">  
    <?php 
    foreach ($list_product as $item) {
        $row = $kiotviet->product_gb($item['id']); 
        if ($item['images']) {
            // var_dump($item['images']);
            $row['product_img'] = $item['images'][0];
        }
    ?>
        <div class="colOption">

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

        </div>          
    <?php } ?>
</div>