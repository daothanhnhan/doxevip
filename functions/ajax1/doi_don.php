<?php 
	session_start();
	include_once dirname(__FILE__) . "/../database.php";
	include_once dirname(__FILE__) . "/../library.php";
	include_once dirname(__FILE__) . "/../action.php";
	$action = new action();

	$cartdetail_id = $_GET['id'];
	unset($_SESSION['them_don']);
	$_SESSION['doi_don'] = $cartdetail_id;

	$cartdetail = $action->getDetail('cartdetail', 'id_cartDetail', $cartdetail_id);
	$product_id = $cartdetail['id_product'];

	$product = $action->getDetail('product', 'product_id', $product_id);
	$productcat_ar = $product['productcat_ar'];
	$productcat_ar = json_decode($productcat_ar);

	if (empty($productcat_ar)) {
		echo '/';
	} else {
		$productcat_id = $productcat_ar[0];
		$productcat = $action->getDetail('productcat', 'productcat_id', $productcat_id);
		echo '/'.$productcat['friendly_url'];
	}
?>