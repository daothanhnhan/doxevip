<?php 
	session_start();
	$sort = $_GET['sort'];
	if ($sort == 12) {
		$_SESSION['sort_num'] = 12;
	}
	if ($sort == 25) {
		$_SESSION['sort_num'] = 25;
	}
	if ($sort == 50) {
		$_SESSION['sort_num'] = 50;
	}
	if ($sort == 75) {
		$_SESSION['sort_num'] = 75;
	}
	if ($sort == 100) {
		$_SESSION['sort_num'] = 100;
	}
?>