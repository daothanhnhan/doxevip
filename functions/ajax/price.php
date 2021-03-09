<?php 
	session_start();
	if ($_SESSION['price_filter']==$_GET['price']) {
		$_SESSION['price_filter'] = '';
	} else {
		$_SESSION['price_filter'] = $_GET['price'];
	}
	
?>