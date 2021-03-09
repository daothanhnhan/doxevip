<?php 
	session_start();
	$sort = $_GET['sort'];
	if ($sort == 'default') {
		$_SESSION['sort_price'] = 'default';
	}
	if ($sort == 'az') {
		$_SESSION['sort_price'] = 'az';
	}
	if ($sort == 'price_asc') {
		$_SESSION['sort_price'] = 'price_asc';
	}
	if ($sort == 'price_desc') {
		$_SESSION['sort_price'] = 'price_desc';
	}
?>