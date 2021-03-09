<?php 
    if (!isset($_SESSION['sort_price'])) {
        $_SESSION['sort_price'] = 'default';
    }
    if (!isset($_SESSION['sort_num'])) {
        $_SESSION['sort_num'] = 12;
    }
    ///////////////////////////////
    if (!isset($_SESSION['history'])) {
        $_SESSION['history'] = $_GET['page'];
    } else {
        if ($_SESSION['history'] == $_GET['page']) {

        } else {
            $_SESSION['brand'] = "";
            $_SESSION['material'] = "";
            $_SESSION['price']['max'] = "";
            $_SESSION['price_filter'] = "";
            $_SESSION['history'] = $_GET['page'];
        }
    }
?>

<?php 
    $action = new action();
    $action_product = new action_product();                                                                                
    if (isset($_GET['slug']) && $_GET['slug'] != '') {
        $slug = $_GET['slug'];
        $rowCatLang = $action_product->getProductCatLangDetail_byUrl($slug,$lang);
        $rowCat = $action_product->getProductCatDetail_byId($rowCatLang[$nameColIdProductCat_productCatLanguage],$lang);
        $issub = $action_product->getListProductCatSub($slug, $lang);
        // echo $issub;
        if($issub == 0){
            $rows = $action_product->getProductList_byMultiLevel_orderProductId($rowCat[$nameColId_productCat],'desc',$trang,$_SESSION['sort_num'],$slug);
        }else if($issub != 0){
            $rows = $action_product->getProductList_byMultiLevel_orderProductId($rowCat[$nameColId_productCat],'desc',$trang,$_SESSION['sort_num'],$slug);
            $rowListCat = $action_product->getproductCat_byproductCatIdParent($rowCatLang['productcat_id'],'asc');
        }else{
            $rows = $action_product->getproductCat_byproductCatIdParent($rowCatLang['productcat_id'],'asc');
        }
    }else{
        $rows = $action->getList($nameTable_product,'','',$nameColId_product,'desc',$trang,$_SESSION['sort_num'],'san-pham');
        
    }
    $_SESSION['sidebar'] = 'productCat';



    $_SESSION['search_productcat_id'] = $rowCatLang['productcat_id']; 

    // print_r($rows);
?>  
<?php include DIR_BANNER."MS_BANNER_MPTOTO_0005.php";?>
<?php include DIR_BREADCRUMBS."MS_BREADCRUMS_MPTOTO_0001.php";?>
<input type="hidden" name="lang_current" id="lang_current" value="<?php echo $lang;?>">
<input type="hidden" name="url_lang" value="<?php echo $url_lang;?>" id="url_lang">
<?php 
    $action_lang = new action_lang();
    $url_lang = $action_lang->get_url_lang_productcat($slug, $lang);
?>

<div class="gb-page-sanpham_mptoto" >
    <div class="container">
        <?php if ($rowCatLang['lang_productcat_des'] != '') { ?>
        <div class="mota-danhmuc">
            <?= $rowCatLang['lang_productcat_des'] ?>
        </div>
        <?php } ?>
        <div class="row">
            <?php
                if($issub == 0){
            ?>
                <!-- Hiển thị danh sách sản phẩm -->
                <div class="col-md-9" id="productContainer">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="product-filtertab">
                                <div class="tabbable-panel">
                                    <div class="tabbable-line">
                                        <ul class="nav nav-tabs ">
                                            <li class="active">
                                                <a href="#tab_default_1" data-toggle="tab"><i class="fa fa-th" aria-hidden="true"></i> </a>
                                            </li>
                                            <li>
                                                <a href="#tab_default_2" data-toggle="tab"><i class="fa fa-list" aria-hidden="true"></i> </a>
                                            </li>
                                        </ul>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="product-filtertab">
                                <?php include DIR_SEARCH."MS_SEARCH_MPTOTO_0002.php";?>                        
                            </div>
                        </div>
                    </div>

                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_default_1">
                            <div class="row">
                                <?php 
                                    $d = 0;
                                    foreach ($rows['data'] as $row) {
                                        $d++;
                                        $rowLang1 = $action_product->getProductLangDetail_byId($row['product_id'],$lang);
                                        $row1 = $action_product->getProductDetail_byId($row['product_id'],$lang); 
                                ?>
                                    <div class="col-sm-4 col-xs-6">
                                        <div class="gb-product-item_mptoto">
                                            <div class="gb-product-item-img">
                                                <div class="gb-product-item-img-main">
                                                    <a href="/<?= $rowLang1['friendly_url'] ?>">
                                                        <img src="/images/<?= $row1['product_img'] ?>" alt="" class="img-responsive">
                                                    </a>
                                                </div>
                                                <div class="gb-product-item-img-replate">
                                                    <a href="/<?= $rowLang1['friendly_url'] ?>">
                                                        <?php if (empty($row1['product_img_2'])) { ?>
                                                        <img src="/images/<?= $row1['product_img'] ?>" alt="" class="img-responsive">
                                                        <?php } else { ?>
                                                        <img src="/images/<?= $row1['product_img_2'] ?>" alt="" class="img-responsive">
                                                        <?php } ?>
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
                                                <?php include DIR_PRODUCT."MS_PRODUCT_MPTOTO_0002.php";?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_default_2">
                            <?php 
                                $d = 0;
                                foreach ($rows['data'] as $row) {
                                    $d++;
                                    $rowLang1 = $action_product->getProductLangDetail_byId($row['product_id'],$lang);
                                    $row1 = $action_product->getProductDetail_byId($row['product_id'],$lang); 
                            ?>
                                <div class="gb-product-item_mptoto">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="gb-product-item-img">
                                                <div class="gb-product-item-img-main">
                                                    <a href="/<?= $rowLang1['friendly_url'] ?>">
                                                        <img src="/images/<?= $row1['product_img'] ?>" alt="" class="img-responsive">
                                                    </a>
                                                </div>
                                                <div class="gb-product-item-img-replate">
                                                    <a href="/<?= $rowLang1['friendly_url'] ?>">
                                                        <?php if (empty($row1['product_img_2'])) { ?>
                                                        <img src="/images/<?= $row1['product_img'] ?>" alt="" class="img-responsive">
                                                        <?php } else { ?>
                                                        <img src="/images/<?= $row1['product_img_2'] ?>" alt="" class="img-responsive">
                                                        <?php } ?>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="gb-product-item-img-text">
                                            <h2>
                                                <a href="/<?= $rowLang1['friendly_url'] ?>">
                                                    <?= $rowLang1['lang_product_name'] ?>
                                                </a>
                                            </h2>
                                            <?= $rowLang1['lang_product_des'] ?>
                                            <?php include DIR_PRODUCT."MS_PRODUCT_MPTOTO_0002.php";?>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php include DIR_PAGINATION."MS_PAGINATION_MPTOTO_0001.php";?>
                </div>
            <?php
                // }else if($issub != 0 && $rowCat['productcat_parent'] != 0){
                }else if($issub != 0){
            ?>
                <!-- Hiển thị danh sách sản phẩm và Danh mục sản phẩm Cấp 2 - Có Lọc tìm kiếm-->
                <div class="col-md-9">
                    <div class="filter-header">
                        <h2 class="loc-tim-kiem">LỌC TÌM KIẾM</h2>
                        <div class="row">
                            <?php
                                foreach ($rowListCat as $row) {
                                    $row_product_cat = $action_product->getProductCatDetail_byId($row['productcat_id'], $lang);
                            ?>
                                <div class="col-md-4">
                                    <a href="/<?= $row_product_cat['friendly_url'] ?>" style="color: blue;">
                                        <?= $row_product_cat['productcat_name'] ?>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="product-filtertab">
                                <div class="tabbable-panel">
                                    <div class="tabbable-line">
                                        <ul class="nav nav-tabs ">
                                            <li class="active">
                                                <a href="#tab_default_1" data-toggle="tab"><i class="fa fa-th" aria-hidden="true"></i> </a>
                                            </li>
                                            <li>
                                                <a href="#tab_default_2" data-toggle="tab"><i class="fa fa-list" aria-hidden="true"></i> </a>
                                            </li>
                                        </ul>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="product-filtertab">
                                <?php include DIR_SEARCH."MS_SEARCH_MPTOTO_0002.php";?>                        
                            </div>
                        </div>
                    </div>

                    <div class="tab-content" id="productContainer">
                        <div class="tab-pane active" id="tab_default_1">
                            <div class="row">
                                <?php 
                                    $d = 0;
                                    foreach ($rows['data'] as $row) {
                                        $d++;
                                        $rowLang1 = $action_product->getProductLangDetail_byId($row['product_id'],$lang);
                                        $row1 = $action_product->getProductDetail_byId($row['product_id'],$lang); 
                                ?>
                                    <div class="col-sm-4 col-xs-6">
                                        <div class="gb-product-item_mptoto">
                                            <div class="gb-product-item-img">
                                                <div class="gb-product-item-img-main">
                                                    <a href="/<?= $rowLang1['friendly_url'] ?>">
                                                        <img src="/images/<?= $row1['product_img'] ?>" alt="main" class="img-responsive">
                                                    </a>
                                                </div>
                                                <div class="gb-product-item-img-replate">
                                                    <a href="/<?= $rowLang1['friendly_url'] ?>">
                                                        <?php if (empty($row1['product_img_2'])) { ?>
                                                        <img src="/images/<?= $row1['product_img'] ?>" alt="replate" class="img-responsive">
                                                        <?php } else { ?>
                                                        <img src="/images/<?= $row1['product_img_2'] ?>" alt="replate" class="img-responsive">
                                                        <?php } ?>
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
                                                <?php include DIR_PRODUCT."MS_PRODUCT_MPTOTO_0002.php";?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_default_2">
                            <?php 
                                $d = 0;
                                foreach ($rows['data'] as $row) {
                                    $d++;
                                    $rowLang1 = $action_product->getProductLangDetail_byId($row['product_id'],$lang);
                                    $row1 = $action_product->getProductDetail_byId($row['product_id'],$lang); 
                            ?>
                                <div class="gb-product-item_mptoto">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="gb-product-item-img">
                                                <div class="gb-product-item-img-main">
                                                    <a href="/<?= $rowLang1['friendly_url'] ?>">
                                                        <img src="/images/<?= $row1['product_img'] ?>" alt="" class="img-responsive">
                                                    </a>
                                                </div>
                                                <div class="gb-product-item-img-replate">
                                                    <a href="/<?= $rowLang1['friendly_url'] ?>">
                                                        <?php if (empty($row1['product_img_2'])) { ?>
                                                        <img src="/images/<?= $row1['product_img'] ?>" alt="" class="img-responsive">
                                                        <?php } else { ?>
                                                        <img src="/images/<?= $row1['product_img_2'] ?>" alt="" class="img-responsive">
                                                        <?php } ?>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="gb-product-item-img-text">
                                            <h2>
                                                <a href="/<?= $rowLang1['friendly_url'] ?>">
                                                    <?= $rowLang1['lang_product_name'] ?>
                                                </a>
                                            </h2>
                                            <?= $rowLang1['lang_product_des'] ?>
                                            <?php include DIR_PRODUCT."MS_PRODUCT_MPTOTO_0002.php";?>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php include DIR_PAGINATION."MS_PAGINATION_MPTOTO_0001.php";?>
                </div>
            <?php }else{ ?>
                <!-- Hiển thị danh mục sản phẩm cấp 1 Không có Lọc tìm kiếm -->
                <div class="col-md-9">
                    <?php
                        if($rowCat['productcat_parent'] != 0){
                    ?>
                        <div class="filter-header">
                            <h2 class="loc-tim-kiem">LỌC TÌM KIẾM</h2>
                            <div class="row">
                                <?php
                                    foreach ($rows as $row) {
                                        $row_product_cat = $action_product->getProductCatDetail_byId($row['productcat_id'], $lang);
                                ?>
                                    <div class="col-md-4">
                                        <a href="/<?= $row_product_cat['friendly_url'] ?>">
                                            <?= $row_product_cat['productcat_name'] ?>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="gb-productcat_mptoto-item">
                        <div class="gb-productcat_mptoto-title">
                            <h3><?= $rowCat['productcat_name'] ?></h3>
                            <a href="/<?= $rowCat['friendly_url'] ?>" class="btn_xemthem">Xem thêm</a>
                        </div>
                        <div>
                            <?= $rowCat['productcat_content'] ?>
                        </div>
                        <div class="row">
                            <?php
                                foreach ($rows as $row) {
                                    $row_product_cat = $action_product->getProductCatDetail_byId($row['productcat_id'], $lang);
                            ?>
                            <div class="col-sm-4">
                                <div class="gb-product-item_mptoto">
                                    <div class="gb-product-item-img">
                                        <div class="gb-product-item-img-main">
                                            <a href="/<?= $row_product_cat['friendly_url'] ?>">
                                                <img src="/images/<?= $row_product_cat['productcat_main_img'] ?>" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="gb-product-item-img-replate">
                                            <a href="/<?= $row_product_cat['friendly_url'] ?>">
                                                <img src="/images/<?= $row_product_cat['productcat_sub_img'] ?>" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="gb-product-item-img-text">
                                        <h2>
                                            <a href="/<?= $row_product_cat['friendly_url'] ?>">
                                                <?= $row_product_cat['productcat_name'] ?>
                                            </a>
                                        </h2>
                                        <p><?= $row_product_cat['productcat_des'] ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <?php include DIR_PAGINATION."MS_PAGINATION_MPTOTO_0001.php";?>
                    </div>
                </div>
            <?php } ?>
            <div class="col-md-3">
                <?php include DIR_SIDEBAR."MS_SIDEBAR_MPTOTO_0001.php";?>
                <?php include DIR_SIDEBAR."MS_SIDEBAR_MPTOTO_0006.php";?>
                <?php include DIR_SIDEBAR."MS_SIDEBAR_MPTOTO_0009.php";?>
                <?php include DIR_SIDEBAR."MS_SIDEBAR_MPTOTO_0004.php";?>
                <?php include DIR_SIDEBAR."MS_SIDEBAR_MPTOTO_0007.php";?>
                <?php include DIR_SIDEBAR."MS_SIDEBAR_MPTOTO_0005.php";?>
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


<script>

    // $("#orderby_2").change(function(){
    //     $(this).attr('data-sort',$(this).val());
    //     var number =  $("#orderby").attr('data-number') ?  $("#orderby").attr('data-number') : '';
    //      var sort = $(this).val();
    //      get_product(0,sort,number)
       
        
    // })

    // $("#orderby").change(function(){
    // $(this).attr('data-number',$(this).val());
    // var sort =  $("#orderby_2").attr('data-sort') ?  $("#orderby_2").attr('data-sort') : '';
    // var number = $(this).val();
    //  get_product(0,sort,number)
   
      
    // })
    //   function get_product(limit,sort,number){
    //     $.ajax({
    //         url:"/functions/ajax/show.php",
    //         method:"POST",
    //         data:{
    //            limit : limit,
    //            sort : sort,
    //            number : number,
    //         },
    //         success:function(data){
    //             $("#productContainer").html(data);
    //         }
    //     })
    // }
</script>

<script>
  function sort_price (data) {
    // alert(data.value);
    var sort = data.value;
    var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
         // document.getElementById("demo").innerHTML = this.responseText;
         location.reload();
        }
      };
      xhttp.open("GET", "/functions/ajax/sort_price.php?sort="+sort, true);
      xhttp.send();
    
  }

  function sort_num (data) {
    var sort = data.value;
    var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
         // document.getElementById("demo").innerHTML = this.responseText;
         location.reload();
        }
      };
      xhttp.open("GET", "/functions/ajax/sort_num.php?sort="+sort, true);
      xhttp.send();
  }
</script>
