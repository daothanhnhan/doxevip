<?php 
// $product_all = $kiotviet->get_product_all_db_state();
?>
<div class="rowProductHome"> 
    <div class="container">

        <div class="row"> 

            <div class="col-md-12">  

            	<div class="content_tab">
                    <a href="#tab_hot">
                        <div class="text-name" style="background: url('/images/spnoibat.jpg');"></div>
                    </a>
                        <!-- <span class="span_tab"><a href="#tab_sale" class="mobile-hide">Sản Phẩm Khuyến Mãi</a></span>  -->
                        <!-- <a href="/" class="allCateBoxPH">Xem tất cả >></a> -->
                    
                    <div class="span_tab_content" id="tab_hot" style="display: block;">                        
                        <?php include DIR_PRODUCT."MS_PRODUCT_DAINGHIA_SUB_001.php";?>
                    </div>
                    <div class="span_tab_content" id="tab_sale" style="display: block;">                       
                        <?php include DIR_PRODUCT."MS_PRODUCT_DAINGHIA_SUB_002.php";?>
                    </div> 
                </div>

            </div> 

        </div>
    </div>

</div>