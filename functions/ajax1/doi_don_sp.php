<?php 
	session_start();
	include_once dirname(__FILE__) . "/../database.php";
	include_once dirname(__FILE__) . "/../library.php";
	include_once dirname(__FILE__) . "/../action.php";
	$action = new action();

	$product_id = $_GET['id'];
	$cartdetail_id = $_SESSION['doi_don'];

	$cartdetail = $action->getDetail('cartdetail', 'id_cartDetail', $cartdetail_id);
	$cart_id = $cartdetail['id_cart'];

	$has = 0;
	$list_don = $action->getList('cartdetail', 'id_cart', $cart_id, 'id_cartDetail', 'asc', '', '', '');
	foreach ($list_don as $item) {
		if ($item['id_product'] == $product_id) {
			$has++;
		}
	}

	$product = $action->getDetail('product', 'product_id', $product_id);
	$price_product = $product['product_price'];
	$subInfo1 = $product['product_sub_info4'];
	$subInfo1 = strip_tags($subInfo1);
	$subInfo1 = mysqli_real_escape_string($conn_vn, $subInfo1);

	$sql = "UPDATE cartdetail SET id_product = $product_id, price_product = $price_product, qyt_product = 1, totalprice_product = $price_product, subInfo1 = '$subInfo1' WHERE id_cartDetail = $cartdetail_id";

	if ($has == 0) {
		$result = mysqli_query($conn_vn, $sql);
	}

	unset($_SESSION['doi_don']);
	echo $cart_id;
?>