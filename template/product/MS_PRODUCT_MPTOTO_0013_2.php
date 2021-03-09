<?php                                                                        
    $product_all = $kiotviet->get_product_all();
    $kiotviet_cat_id = $kiotviet->get_procat_idkv_byurl($_GET['page']);
    $list_idcat = $kiotviet->get_list_idcat_1($all_procat, $kiotviet_cat_id);//var_dump($list_idcat);
    $rows = $kiotviet->list_product_bycat($product_all, $list_idcat);//var_dump($rows);
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
                    <div class="gb-product-item_cuanhom">
                        <div class="gb-product-item_cuanhom-img">
                            <a href="/<?= $item['friendly_url'] ?>"><img src="/images/<?= $row['product_img'] ?>" alt="<?= $item['product_name'] ?>" class="img-responsive"></a>
                            <div class="overlay">
                                <div class="text"><?= $item['product_des'] ?></div>
                            </div>
                        </div>
                        <div class="gb-product-item_cuanhom-text">
                            <h2><a href="/<?= $item['friendly_url'] ?>"><?= $item['name'] ?></a></h2>
                            <p class="prices-news_nuochoa">Giá: <?= number_format($item['product_price']) ?> đ</p>
                            <a href="javascript:void()" class="gb-product-item-order" onclick="load_url('<?= $row['product_id'] ?>', '<?= $row['product_name'] ?>', '<?= $row['product_price'];?>')">Mua ngay</a>
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
                <?php include DIR_SIDEBAR."MS_SIDEBAR_MPTOTO_0002.php";?>
                <?php include DIR_SIDEBAR."MS_SIDEBAR_MPTOTO_0005.php";?>
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