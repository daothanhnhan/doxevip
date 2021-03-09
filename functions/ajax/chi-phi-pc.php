<?php 
	session_start();
	include_once dirname(__FILE__)."/../database.php";
	include_once dirname(__FILE__)."/../library.php";
	include_once dirname(__FILE__)."/../pagination/Pagination.php";
	// include_once dirname(__FILE__)."/../action_kiotviet.php";
	include_once dirname(__FILE__)."/../action.php";
	$action = new action();
	// $kiotviet = new action_kiotviet();
	if (!empty($_SESSION['pre_cart'])) {
		$phi = 0;
		foreach ($_SESSION['pre_cart'] as $item){
			$product = $action->getDetail('product', 'product_id', $item['idkv']);
			$phi += $action->percent1($product['product_price'], $product['product_price_sale']);
		} 
		echo number_format($phi);
		// echo '2';
	} else {
		echo '0';
	}
?>