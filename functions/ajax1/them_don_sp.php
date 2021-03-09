<?php 
	session_start();
	include_once dirname(__FILE__) . "/../database.php";
	include_once dirname(__FILE__) . "/../library.php";
	include_once dirname(__FILE__) . "/../action.php";
	$action = new action();

	$pro_id = $_GET['id'];
	$cart_id = $_SESSION['them_don'];

	$list_don = $action->getList('cartdetail', 'id_cart', $cart_id, 'id_product', 'asc', '', '', '');
	$has = 0;
	foreach ($list_don as $item) {
		if ($item['id_product'] == $pro_id) {
			$has++;
		}
	}

	$product = $action->getDetail('product', 'product_id', $pro_id);
	$price_product = $product['product_price'];
	$subInfo1 = $product['product_sub_info4'];
	$subInfo1 = strip_tags($subInfo1);
	$subInfo1 = mysqli_real_escape_string($conn_vn, $subInfo1);

	$sql = "INSERT INTO cartdetail (id_product, price_product, qyt_product, totalprice_product, subInfo1, id_cart) VALUES ($pro_id, $price_product, 1, $price_product, '$subInfo1', $cart_id)";
	if ($has == 0) {
		$result = mysqli_query($conn_vn, $sql);
	}

	unset($_SESSION['them_don']);
	echo $cart_id;
?>