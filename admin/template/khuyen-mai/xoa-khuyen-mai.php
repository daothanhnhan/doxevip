<?php 
	$id = $_GET['id'];
	$sql = "SELECT * FROM sale_item WHERE id = $id";
	$result = mysqli_query($conn_vn, $sql);
	$row = mysqli_fetch_assoc($result);
	$sale_cat_id = $row['sale_cat_id'];

	$sql = "DELETE FROM sale_item WHERE id = $id";
	$result = mysqli_query($conn_vn, $sql);
	header('location: index.php?page=khuyen-mai&sale_cat_id='.$sale_cat_id);
?>