<?php 
	$id = $_GET['id'];

	$sql = "SELECT * FROM tinh_nang_item WHERE id = $id";
	$result = mysqli_query($conn_vn, $sql);
	$row = mysqli_fetch_assoc($result);
	$tinh_nang_cat_id = $row['tinh_nang_cat_id'];

	$sql = "DELETE FROM tinh_nang_item WHERE id = $id";
	$result = mysqli_query($conn_vn, $sql);
	header('location: index.php?page=tinh-nang-item&tinh_nang_cat_id='.$tinh_nang_cat_id);
?>