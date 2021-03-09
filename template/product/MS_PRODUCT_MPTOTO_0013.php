<?php                    

    if (!isset($_SESSION['attribute'])) {

        $_SESSION['attribute'] = array();

    } 

    if (isset($_GET['name'])) {

        $_SESSION['attribute'] = array($_GET['value']);

        // $_SESSION['attribute'][] = array(

        //     'name' => $_GET['name'],

        //     'value' => array($_GET['value'])

        // );



    }

    if (!isset($_SESSION['link_kv'])) {

        $_SESSION['link_kv'] = $_GET['page'];

    } else {

        if ($_SESSION['link_kv'] != $_GET['page']) {

            $_SESSION['attribute'] = array();

            $_SESSION['link_kv'] = $_GET['page'];

        }

    }

    // var_dump($_SESSION['attribute']);

?>

<?php 

    $rowCatLang = $action_product->getProductCatLangDetail_byUrl($slug,$lang);

    $rowCat = $action_product->getProductCatDetail_byId($rowCatLang['productcat_id'],$lang);

    $rows = $action_product->getProductList_byMultiLevel_orderProductId($rowCat['productcat_id'],'desc',$trang,'',$slug);//var_dump($rows);

    $thuoc_tinh_1 = $action_product->get_list_attribute($rows);//var_dump($thuoc_tinh_1);

    $rows = $action->list_product_bycat($rows, $trang, $_GET['page']);

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

            

            <div class="col-md-12">

                <?php include DIR_SLIDESHOW."MS_SLIDESHOW_MPTOTO_0002.php";?>

                <?php 

                    $d = 0;

                    foreach ($rows['data'] as $row) {

                        $d++;

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

                <div class="col-md-15 col-sm-3 col-xs-6" style="padding-right: 0;padding-left: 0;">

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

                </div>

                <?php 

                    if ($d%5==0) {

                        echo '<hr style="width:100%;border:0;margin:0;" />';

                    }

                } ?>  

                <div style="clear: both;">

                    <?php include DIR_PAGINATION."MS_PAGINATION_MPTOTO_0001.php";?>

                </div>

            </div>
            <?php include DIR_PRODUCT."MS_PRODUCT_SAN_0002.php";?>
           <!--  <div class="col-md-3">

                <?php //include DIR_SIDEBAR."MS_SIDEBAR_MPTOTO_0012.php";?>

                <?php //include DIR_SIDEBAR."MS_SIDEBAR_MPTOTO_0010.php";?>

                <?php //include DIR_SIDEBAR."MS_SIDEBAR_MPTOTO_0011.php";?>

                <?php //include DIR_SIDEBAR."MS_SIDEBAR_MPTOTO_0002.php";?>

                <?php //include DIR_SIDEBAR."MS_SIDEBAR_MPTOTO_0005.php";?>

                <?php //include DIR_SIDEBAR."MS_SIDEBAR_MPTOTO_0004.php";?>

                <?php //include DIR_SIDEBAR."MS_SIDEBAR_MPTOTO_0007.php";?>

                <?php //include DIR_SIDEBAR."MS_SIDEBAR_MPTOTO_0005.php";?>

            </div> -->

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