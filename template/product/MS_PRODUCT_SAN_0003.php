<style>
.display-block {
    display: block !important;
}
.gb-owl-nav-arrow .owl-next {
    position: absolute;
    right: 10px;
    top: 45%;
    background: red !important;
}
.gb-owl-nav-arrow .owl-prev {
    position: absolute;
    left: 10px;
    top: 45%;
    background: red !important;
}
</style>
<?php 
// $product_all = $kiotviet->get_product_all_db_state();
    $home_list_procat = $action->getList('productcat', 'productcat_parent', '0', 'productcat_id', 'asc', '', '', '');
    $d = 0;
    foreach ($home_list_procat as $item) {
        
        $d++;
        $procat_home = $action_product->getProductList_byMultiLevel_orderProductId($item['productcat_id'],'desc','','24','');//var_dump($home_list_procat);
?>

<div class="rowProductHome gb-owl-nav-arrow"> 
    <div class="container">

        <div class="row"> 

            <div class="col-md-12">  

                <div class="content_tab">
                    <a href="#">
                        <div class="text-name" style="background: url('/images/logo/danh-muc.jpg');"><span style="color: #fecd07;font-size: 27px;font-weight: bold;position: relative;left: 15px;top: 5px;"><?= $item['productcat_name'] ?></span></div>
                    </a>
                    
                    <div class="span_tab_content<?= $d ?> display-block" id="" style="display: block;">                        
                        <?php include DIR_PRODUCT."MS_PRODUCT_SAN_0004.php";?>
                    </div>
                     
                </div>

            </div> 

        </div>
    </div>

</div>
<?php } ?>