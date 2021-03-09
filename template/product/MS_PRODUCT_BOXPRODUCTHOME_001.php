<?php 
	
	$list_procat1 = $kiotviet->get_procat_list($all_procat, null);
    $product_all = $kiotviet->get_product_all_db();//var_dump($product_all);
    // foreach ($product_all as $item) {
    //     if ($item['hasVariants'] == true) {
    //         echo $item['id'].' <br>';
    //     }
    // }
?>
<link rel="stylesheet" href="/plugin/owl-carouse/owl.carousel.min.css">
<link rel="stylesheet" href="/plugin/owl-carouse/owl.theme.default.min.css">
<div class="coverSlideProductHome">
    <div class="container">
    	<?php 
    	foreach ($list_procat1 as $item_cat1) { 
    		$row_cat1 = $kiotviet->get_procat_gb($item_cat1['categoryId']);
    		$list_procat2 = $kiotviet->get_procat_list($all_procat, $item_cat1['categoryId']);//var_dump($list_procat2);
            $list_idcat = $kiotviet->get_list_idcat_1($all_procat, $item_cat1['categoryId']);//var_dump($list_idcat);
            $list_product = array();
            $d = 0;
            foreach ($product_all as $item_all) {
                if (in_array($item_all['categoryId'], $list_idcat)) {
                    $d++;
                    if ($d == 9) {
                        break;
                    }
                    $list_product[] = $item_all;
                }
            }
    	?>
        <div class="row">
            <div class="col-md-12">
                <div class="lineTitleProductHome">
                    <p class="titleCateBoxPH"><?= $item_cat1['categoryName'] ?></p>
                 	<ul class="listCateBoxPH">
                 		<?php 
                 		$d = 0;
                 		foreach ($list_procat2 as $item_cat2) {
                 			$d++;
                 		 	$row_cat2 = $kiotviet->get_procat_gb($item_cat2['categoryId']);
                 		 	if ($d == 6) {
                 				break;
                 			}
                 		?>
                 		<li><a href="/<?= $row_cat2['friendly_url'] ?>"><?= $item_cat2['categoryName'] ?></a></li>
                 		<?php } ?>
                 	</ul> 
                 	<a href="/<?= $row_cat1['friendly_url'] ?>" class="allCateBoxPH">Xem tất cả >></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
		        <div class="listHomeProductDetail001 owl-carousel owl-theme"> 
                    <?php 
                    foreach ($list_product as $item) {
                        $row = $kiotviet->product_gb($item['id']); 
                    ?>
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
		            			<p>-<?= $row['product_price_sale'] ?>%</p>
		            		</div>
		            	</div>
		            	<div class="bottomBoxPDH">
		            		<p class="codeProductBoxPDH">Mã sản phẩm: <?= $item['code'] ?></p>
		            		<a href="/<?= $row['friendly_url'] ?>" class="nameProductBoxPDH"><?= $item['name'] ?></a>
		            		<?php include DIR_PRODUCT."MS_PRODUCT_MPTOTO_0002_1.php";?>
		            	</div>
		            </div> 
		            <?php } ?>
		        </div>
            </div>
        </div>
    	<?php } ?>
    </div>
</div> 

<script src="/plugin/owl-carouse/owl.carousel.min.js"></script>
<script src="/plugin/waypoint/jquery.waypoints.min.js"></script>
<script src="/plugin/wow/wow.min.js"></script>
<script src="/plugin/animsition/css/animate.css"></script>
<script>
    new WOW().init();
</script>
<script>
    $(document).ready(function (){
        $('.listHomeProductDetail001').owlCarousel({
            loop:true,
            margin:0,
            navSpeed:500,
            dots: false,
            autoplay: true,
            rewind: true,
            navText:[],
            responsive:{
                0:{
                    items:1,
                    nav:false
                },
                767:{
                    items: 5,
                    nav:true
                }
            }
        });
    });
</script>