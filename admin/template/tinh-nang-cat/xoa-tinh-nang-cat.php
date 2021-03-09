<?php 
	$id = $_GET['id'];

	$sql = "SELECT * FROM tinh_nang_cat WHERE id = $id";
	$result = mysqli_query($conn_vn, $sql);
	$row = mysqli_fetch_assoc($result);
	$product_id = $row['product_id'];

	$sql = "DELETE FROM tinh_nang_cat WHERE id = $id";
	$result = mysqli_query($conn_vn, $sql);
	header('location: index.php?page=tinh-nang-cat&product_id='.$product_id);
?>