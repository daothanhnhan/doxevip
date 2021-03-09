<?php include DIR_BREADCRUMBS."MS_BREADCRUMS_MPTOTO_0001.php";?>

<?php 
    $action = new action();
    $action_product = new action_product();                                                                                
    if (isset($_GET['slug']) && $_GET['slug'] != '') {
        $slug = $_GET['slug'];
        $rowCatLang = $action_product->getProductCatLangDetail_byUrl($slug,$lang);
        $rowCat = $action_product->getProductCatDetail_byId($rowCatLang[$nameColIdProductCat_productCatLanguage],$lang);
        $rows = $action_product->getProductList_byMultiLevel_orderProductId_brand($rowCat[$nameColId_productCat],'desc',$trang,12,$slug);
    }else{
        $rows = $action->getList($nameTable_product,'','',$nameColId_product,'desc',$trang,12,'san-pham');
        
    }
    $_SESSION['sidebar'] = 'productCat';

    if (!isset($_SESSION['history'])) {
        $_SESSION['history'] = $_GET['page'];
    } else {
        if ($_SESSION['history'] == $_GET['page']) {

        } else {
            $_SESSION['brand'] = "";
            $_SESSION['price']['max'] = "";
            $_SESSION['history'] = $_GET['page'];
        }
    }
?>  
<?php include DIR_BANNER."MS_BANNER_MPTOTO_0005.php";?>
<input type="hidden" name="lang_current" id="lang_current" value="<?php echo $lang;?>">
<input type="hidden" name="url_lang" value="<?php echo $url_lang;?>" id="url_lang">
<?php 
    $action_lang = new action_lang();
    $url_lang = $action_lang->get_url_lang_productcat($slug, $lang);
?>

<div class="gb-page-sanpham_mptoto" >
    <div class="container">
        <div class="row">
            <div class="col-md-9" id="productContainer">
                <div class="row">
                    <?php 
                        $d = 0;
                        foreach ($rows['data'] as $row) {
                            $d++;
                            $rowLang1 = $action_product->getProductLangDetail_byId($row['product_id'],$lang);
                            $row1 = $action_product->getProductDetail_byId($row['product_id'],$lang); 
                    ?>
                        <div class="col-sm-4">
                            <div class="gb-product-item_mptoto">
                                <div class="gb-product-item-img">
                                    <div class="gb-product-item-img-main">
                                        <a href="/<?= $rowLang1['friendly_url'] ?>">
                                            <img src="/images/<?= $row1['product_img'] ?>" alt="" class="img-responsive">
                                        </a>
                                    </div>
                                    <div class="gb-product-item-img-replate">
                                        <a href="/<?= $rowLang1['friendly_url'] ?>">
                                            <img src="/images/<?= $row1['product_img_2'] ?>" alt="" class="img-responsive">
                                        </a>
                                    </div>
                                </div>
                                <div class="gb-product-item-img-text">
                                    <h2>
                                        <a href="/<?= $rowLang1['friendly_url'] ?>">
                                            <?= $rowLang1['lang_product_name'] ?>
                                        </a>
                                    </h2>
                                    <?= $rowLang1['lang_product_des'] ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <?php include DIR_PAGINATION."MS_PAGINATION_MPTOTO_0001.php";?>
            </div>
            <div class="col-md-3">
                <?php include DIR_SIDEBAR."MS_SIDEBAR_MPTOTO_0001.php";?>
                <?php include DIR_SIDEBAR."MS_SIDEBAR_MPTOTO_0006.php";?>
                <?php include DIR_SIDEBAR."MS_SIDEBAR_MPTOTO_0004.php";?>
                <?php include DIR_SIDEBAR."MS_SIDEBAR_MPTOTO_0007.php";?>
                <?php include DIR_SIDEBAR."MS_SIDEBAR_MPTOTO_0005.php";?>
            </div>
        </div>
    </div>
</div>