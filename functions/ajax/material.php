<?php 
	session_start();
	$material = $_GET['material'];

	if (!isset($_SESSION['material'])) {
		$_SESSION['material'] = $material;
	} else {
		if ($_SESSION['material'] == "") {
			$_SESSION['material'] = $material;
		} else {
			$_SESSION['material'] = "";
		}
	}
?>