<?php 
	session_start();
	unset($_SESSION['doi_don']);
	$_SESSION['them_don'] = $_GET['id'];
?>