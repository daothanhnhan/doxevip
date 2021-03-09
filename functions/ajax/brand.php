<?php 
	session_start();
	$brand = $_GET['brand'];

	if (!isset($_SESSION['brand'])) {
		$_SESSION['brand'] = $brand;
	} else {
		if ($_SESSION['brand'] == "") {
			$_SESSION['brand'] = $brand;
		} else {
			$_SESSION['brand'] = "";
		}
	}
?>