<?php 
	include_once dirname(__FILE__) . "/../database.php";
	include_once dirname(__FILE__) . "/../library.php";
	include_once dirname(__FILE__) . "/../action.php";

	$action = new action();

	$pro = $_GET['pro'];
	$ma = $_GET['ma'];

	$product = $action->getDetail('product', 'product_id', $pro);
	$gia = $product['tinh_nang_gia_sp'];
	$gia = json_decode($gia, true);
	$show_gia = 0;
	$show_gia_giam = 0;
	foreach ($gia as $item) {
		if ($item['code'] == $ma) {
			$show_gia = $item['price1'];
			$show_gia_giam = $item['price2'];
		}
	}
	// echo $gia[0]['skuPropIds'];
	$gia_arr = array();
	if (empty($show_gia_giam)) {
		$gia_arr[] = number_format($show_gia).' VNĐ';
		$gia_arr[] = $show_gia;
	} else {
		$gia_arr[] = number_format($show_gia_giam).' VNĐ ' . '<del style="color: #ccc;font-size: 20px;">'.number_format($show_gia).' VNĐ</del>';
		$gia_arr[] = $show_gia_giam;
	}
	$json = json_encode($gia_arr);
	echo $json;
?>