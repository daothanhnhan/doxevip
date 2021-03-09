<?php 
	$limit = 12;
	$trang = $_GET['trang'];
	if (isset($_POST['price'])) {
		$price = explode('-', $_POST['price']);
		$price_start = str_replace('VNĐ','', trim($price[0]));
		$price_end = str_replace('VNĐ','', trim($price[1]));
        $price_start = trim($price_start);
        $price_end = trim($price_end);
		$str = $price_start . '-' . $price_end;
        header('location: /price/0/'.$str);
	} else {
		$price = $_GET['search'];
		$price = explode('-', $price);
		$price_start = $price[0];
		$price_end = $price[1];
		$str = $price_start . '-' . $price_end;
	}
?>
<?php 
	function price ($lang, $start, $end, $trang, $limit) {
		global $conn_vn;
        $productcat_id = $_SESSION['search_productcat_id'];
        
		$sql = "SELECT * FROM product_languages INNER JOIN product ON product_languages.product_id = product.product_id Where product_languages.languages_code = '$lang' AND product.productcat_ar like '%$productcat_id%' And product.product_price BETWEEN $start AND $end";
		$result = mysqli_query($conn_vn, $sql);
		$count = mysqli_num_rows($result);

		$pos = ($trang) * $limit;
		$sql = "SELECT * FROM product_languages INNER JOIN product ON product_languages.product_id = product.product_id Where product_languages.languages_code = '$lang' AND product.productcat_ar like '%$productcat_id%' And product.product_price BETWEEN $start AND $end LIMIT $pos,$limit";
		$result = mysqli_query($conn_vn, $sql);
		$rows = array();
		while ($row = mysqli_fetch_assoc($result)) {
			$rows[] = $row;
		}
		$return = array(
				'data' => $rows,
				'count' => $count
			);
		return $return;
	}

	$rows = price($lang, $price_start, $price_end, $trang, $limit);
?>
<div class="gb-page-sanpham_mptoto">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="row">
                    <?php 
                        $d = 0;
                        foreach ($rows['data'] as $row2) {
                            $d++;
                            $action_product1 = new action_product(); 
                            $rowLang1 = $action_product1->getProductLangDetail_byId($row2['product_id'],$lang);
                            $row1 = $action_product1->getProductDetail_byId($row2['product_id'],$lang);
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
                                <div class="gb-product-item-prices_mptoto text-center">
                                    <p class="gb-prices-news"><?= number_format($row1['product_price']) ?> VNĐ</p>
                                    <p class="gb-prices-old"><?= number_format($row1['product_price']) ?> VNĐ</p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <!--PAGINATION-->
                <nav class="gb-woocommerce-pagination">
                    <?php 
                        $config = array(
                            'current_page'  => $trang+1, // Trang hiện tại
                            'total_record'  => $rows['count'], // Tổng số record
                            'total_page'    => 1, // Tổng số trang
                            'limit'         => $limit,// limit
                            'start'         => 0, // start
                            'link_full'     => '',// Link full có dạng như sau: domain/com/page/{page}
                            'link_first'    => '',// Link trang đầu tiên
                            'range'         => 3, // Số button trang bạn muốn hiển thị 
                            'min'           => 0, // Tham số min
                            'max'           => 0,  // tham số max, min và max là 2 tham số private
                            'search'        => $str

                        );

                        $pagination = new Pagination;
                        $pagination->init($config);
                        echo $pagination->htmlPaging3();
                    ?>
                </nav>
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