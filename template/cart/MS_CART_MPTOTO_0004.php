<?php 
	$total_cart = 0;
	if (isset($_SESSION['shopping_cart'])) {
		$total = $_SESSION['total'];
		foreach ($_SESSION['shopping_cart'] as $v) {
			$total_cart++;
		}
	}
?>
<div class="cart-mptoto"> <a href="/gio-hang"><i class="fa fa-shopping-bag" aria-hidden="true"></i>(<?= $total_cart ?>) Giỏ hàng</a></div>