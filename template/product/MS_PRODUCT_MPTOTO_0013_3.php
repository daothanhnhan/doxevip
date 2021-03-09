<?php                                                                        
    $product_all = $kiotviet->get_product_all();
    $kiotviet_cat_id = $kiotviet->get_procat_idkv_byurl($_GET['page']);
    $list_idcat = $kiotviet->get_list_idcat_1($all_procat, $kiotviet_cat_id);//var_dump($list_idcat);
    $rows = $kiotviet->list_product_bycat($product_all, $list_idcat, $trang, $_GET['page']);//var_dump($rows);
    // var_dump($rowCatLang);
?>
<?php include DIR_BANNER."MS_BANNER_MPTOTO_0005.php";?>
<?php include DIR_BREADCRUMBS."MS_BREADCRUMS_MPTOTO_0001.php";?>
<input type="hidden" name="lang_current" id="lang_current" value="<?php echo $lang;?>">
<input type="hidden" name="url_lang" value="<?php echo $url_lang;?>" id="url_lang">
<?php 
    $action_lang = new action_lang();
    $url_lang = $action_lang->get_url_lang_productcat($slug, $lang);
?>

<div class="gb-page-sanpham_mptoto gb-page-sanpham_cuanhom" >
    <div class="container">
        <?php if ($rowCatLang['lang_productcat_des'] != '') { ?>
        <div class="mota-danhmuc">
            <?= $rowCatLang['lang_productcat_des'] ?>
        </div>
        <?php } ?>
        <div class="row">
            <div class="col-md-9">
                <?php 
                    $d = 0;
                    foreach ($rows['data'] as $item) {
                        $d++;
                        $row = $kiotviet->product_gb($item['id']);
                ?>
                <div class="col-sm-3 col-xs-6" style="padding-right: 0;padding-left: 0;">
                    <div class="coverBoxPDH">
                        <div class="topBoxPDH">
                            <a href="/<?= $row['friendly_url'] ?>" class="linkBoxPDH">
                                <img src="/images/<?= $row['product_img'] ?>" class="mainImgBoxPDH">
                            </a>
                            <div class="rowTagBoxPDH">
                                <img src="/images/iconProductSub_01.png">
                                <img src="/images/iconProductSub_02.png">
                                <img src="/images/iconProductSub_03.png">
                            </div>
                            <div class="tagSaleBoxPDH">
                                <img src="/images/iconSaleProductHome.png">
                                <p>-12%</p>
                            </div>
                        </div>
                        <div class="bottomBoxPDH">
                            <p class="codeProductBoxPDH">Mã sản phẩm: <?= $item['code'] ?></p>
                            <a href="/<?= $row['friendly_url'] ?>" class="nameProductBoxPDH"><?= $item['name'] ?></a>
                            <p class="priceSaleProductBoxPDH">17.790.000 đ</p>
                            <p class="priceRealProductBoxPDH">19.990.000</p>
                        </div>
                    </div> 
                </div>
                <?php 
                    if ($d%4==0) {
                        echo '<hr style="width:100%;border:0;margin:0;" />';
                    }
                } ?>  
                <div style="clear: both;">
                    <?php include DIR_PAGINATION."MS_PAGINATION_MPTOTO_0001.php";?>
                </div>
            </div>
            <div class="col-md-3">
                <?php include DIR_SIDEBAR."MS_SIDEBAR_MPTOTO_0010.php";?>
                <?php //include DIR_SIDEBAR."MS_SIDEBAR_MPTOTO_0002.php";?>
                <?php //include DIR_SIDEBAR."MS_SIDEBAR_MPTOTO_0005.php";?>
                <?php //include DIR_SIDEBAR."MS_SIDEBAR_MPTOTO_0004.php";?>
                <?php //include DIR_SIDEBAR."MS_SIDEBAR_MPTOTO_0007.php";?>
                <?php //include DIR_SIDEBAR."MS_SIDEBAR_MPTOTO_0005.php";?>
            </div>
        </div>
    </div>
</div>

<style type="text/css" media="screen">
    .loc-tim-kiem{
        font-size: 20px;font-weight: 500;margin-bottom: 15px;
    }
    .filter-header a{color:#333;padding-bottom: 10px;display: block;}
    .filter-header{padding-bottom: 20px;}
</style>