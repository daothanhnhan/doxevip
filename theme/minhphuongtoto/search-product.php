<?php
	$limit = 12;
	function search ($lang, $trang, $limit) {
		if (isset($_POST['q'])) {
			$q = $_POST['q'];
			$q = trim($q);
	        $q = vi_en1($q);	        
		} else {
			$q = $_GET['search'];
        	// $q = str_replace('-', ' ', $q);
		}
        $productcat_id = $_SESSION['search_productcat_id'];

		$start = $trang * $limit;
		global $conn_vn;
		$sql = "SELECT * FROM product_languages INNER JOIN product ON product_languages.product_id = product.product_id WHERE product_languages.friendly_url like '%$q%' And product_languages.languages_code = '$lang' AND product.state = 1";//echo $sql;
		$result = mysqli_query($conn_vn, $sql);
		$count = mysqli_num_rows($result);

		$sql = "SELECT * FROM product_languages INNER JOIN product ON product_languages.product_id = product.product_id WHERE product_languages.friendly_url like '%$q%' And product_languages.languages_code = '$lang' AND product.state = 1 LIMIT $start,$limit";
		$result = mysqli_query($conn_vn, $sql);
		$rows = array();
		while ($row = mysqli_fetch_assoc($result)) {
			$rows[] = $row;
		}
		$return = array(
				'data' => $rows,
				'count' => $count,
				'q' => $q
			);
		return $return;
	}
	$rows = search($lang, $trang, $limit);
    // $product_all = $kiotviet->get_product_all_db_state();
?>
<?php include DIR_BREADCRUMBS."MS_BREADCRUMS_MPTOTO_0004.php";?>
<div class="gb-page-sanpham_mptoto gb-page-sanpham_cuanhom" >
    <div class="container">
        <div class="row">
            <div class="col-md-9" id="productContainer">
                <div class="row">
                    <?php 
                        $d = 0;
                        foreach ($rows['data'] as $row) {
                            $d++;
                            // $item = $row;
                            $rowLang1 = $action_product->getProductLangDetail_byId($row['product_id'],$lang);
                            $row1 = $action_product->getProductDetail_byId($row['product_id'],$lang); 
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
                        <div class="col-sm-3 col-xs-6" style="padding-right: 0;padding-left: 0;">
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
                    if ($d%4==0) {
                        echo '<hr style="width:100%;border:0;margin:0;">';
                    }

                    } ?>
                </div>
                <?php //include DIR_PAGINATION."MS_PAGINATION_MPTOTO_0001.php";?>
                <div>
                    <?php 
                        $config = array(
                            'current_page'  => $trang+1, // Trang hiện tại
                            'total_record'  => $rows['count'], // Tổng số record
                            'total_page'    => 1, // Tổng số trang
                            'limit'         => $limit,// limit
                            'start'         => 0, // start
                            'link_full'     => '',// Link full có dạng như sau: domain/com/page/{page}
                            'link_first'    => '',// Link trang đầu tiên
                            'range'         => 5, // Số button trang bạn muốn hiển thị 
                            'min'           => 0, // Tham số min
                            'max'           => 0,  // tham số max, min và max là 2 tham số private
                            'search'        => str_replace(' ', '-', $rows['q'])

                        );

                        $pagination = new Pagination;
                        $pagination->init($config);
                        echo $pagination->htmlPaging1();
                    ?>
                </div>
            </div>
            <div class="col-md-3">
                <?php include DIR_SIDEBAR."MS_SIDEBAR_MPTOTO_0010.php";?>
                <?php //include DIR_SIDEBAR."MS_SIDEBAR_MPTOTO_0005.php";?>
                <?php //include DIR_SIDEBAR."MS_SIDEBAR_MPTOTO_0004.php";?>
                <?php //include DIR_SIDEBAR."MS_SIDEBAR_MPTOTO_0007.php";?>
                <?php //include DIR_SIDEBAR."MS_SIDEBAR_MPTOTO_0005.php";?>
            </div>
        </div>
    </div>
</div>