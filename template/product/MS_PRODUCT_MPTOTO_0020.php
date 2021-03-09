<?php                                                                        
    // if (isset($_GET['slug']) && $_GET['slug'] != '') {
    //     $slug = $_GET['slug'];

    //     $rowCatLang = $action_product->getProductCatLangDetail_byUrl($slug,$lang);
    //     $rowCat = $action_product->getProductCatDetail_byId($rowCatLang['productcat_id'],$lang);
    //     $rows = $action_product->getProductList_byMultiLevel_orderProductId($rowCat['productcat_id'],'desc',$trang,20,$slug);//var_dump($rows);
    // }else{
        $rows = $action->getList_prosale('product','','','product_id','desc',$trang,20,'khuyen-mai');
    // }
    
    $_SESSION['sidebar'] = 'productCat';
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
                        $row = $item;
                ?>
                <div class="col-sm-3 col-xs-6" style="padding-right: 0;padding-left: 0;">
                    <div class="gb-product-item_cuanhom">
                        <div class="gb-product-item_cuanhom-img">
                            <a href="/<?= $item['friendly_url'] ?>"><img src="/images/<?= $item['product_img'] ?>" alt="<?= $item['product_name'] ?>" class="img-responsive"></a>
                            <div class="overlay">
                                <div class="text"><?= $item['product_des'] ?></div>
                            </div>
                        </div>
                        <div class="gb-product-item_cuanhom-text">
                            <h2><a href="/<?= $item['friendly_url'] ?>"><?= $item['product_name'] ?></a></h2>
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
                <?php //include DIR_SIDEBAR."MS_SIDEBAR_MPTOTO_0010.php";?>
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