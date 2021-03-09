<?php 
	session_start();
	include_once dirname(__FILE__)."/../database.php";
	include_once dirname(__FILE__)."/../library.php";
	include_once dirname(__FILE__)."/../pagination/Pagination.php";
	// include_once dirname(__FILE__)."/../action_kiotviet.php";
	include_once dirname(__FILE__)."/../action.php";
	$action = new action();
	// $kiotviet = new action_kiotviet();
	
	$ids = array();
	if (!empty($_SESSION['shopping_cart'])) {
		foreach ($_SESSION['shopping_cart'] as $item) {
			$ids[] = $item['product_id'];
		}
	}

	if (empty($_SESSION['pre_cart'])) {
		echo 'false';
	} else {
		foreach ($_SESSION['pre_cart'] as $item) {
			$product = $action->getDetail('product', 'product_id', $item['idkv']);
			
			if (!in_array($product['product_id'], $ids)) {
				$_SESSION['shopping_cart'][] = array(
					'product_id' => $product['product_id'],
					'product_name' => $product['product_name'],
					'product_price' => $action->percent1($product['product_price'], $product['product_price_sale']),
					'product_quantity' => 1
				);
			}
		}
		echo 'ok';
	}
?>