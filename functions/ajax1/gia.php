<?php 
	include_once dirname(__FILE__) . "/../database.php";
	include_once dirname(__FILE__) . "/../library.php";
	include_once dirname(__FILE__) . "/../action.php";

	$action = new action();

	$id = $_GET['id'];
	$so = $_GET['so']-1;
	// echo $id.$so;
	$product = $action->getDetail('product', 'product_id', $id);

	$gia_tinh_nang = json_decode($product['product_sub_info2']);
    $gia_tinh_nang_giam = json_decode($product['product_content2']);

	if (empty($gia_tinh_nang_giam)) {
		// echo $row['product_price_sale'];
		$sp_gia_giam = $gia_tinh_nang[$so]-($gia_tinh_nang[$so]*($product['product_price_sale']/100));
	} else {
		// echo $gia_tinh_nang_giam[0];
		$sp_gia_giam = $gia_tinh_nang_giam[$so];
	}

	// echo $sp_gia_giam;
	$sp_gia = $gia_tinh_nang[$so];
	$gia = array();
	$gia[] = $sp_gia;
	$gia[] = $sp_gia_giam;

	$gia = json_encode($gia);
	echo $gia;
?>