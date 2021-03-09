<?php 
	session_start();
	include_once dirname(__FILE__) . "/../database.php";
	include_once dirname(__FILE__) . "/../library.php";
	include_once dirname(__FILE__) . "/../action.php";

	$pro_id = $_GET['id'];
	// $position = $_GET['position'];
	$action = new action();

	$_SESSION['doi'] = $pro_id;

	$product = $action->getDetail('product', 'product_id', $pro_id);
	$procat = $product['productcat_ar'];
	$procat = json_decode($procat);

	if (empty($procat)) {
		echo '/san-pham';
		die;
	} else {
		$cat = $procat[0];
	}

	$productcat = $action->getDetail('productcat', 'productcat_id', $cat);
	echo '/'.$productcat['friendly_url'];
?>