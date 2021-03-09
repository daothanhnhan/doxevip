<?php 
	$id = $_GET['id'];
	$sql = "DELETE FROM thuoc_tinh_value WHERE id = $id";
	$result = mysqli_query($conn_vn, $sql);
	header('location: index.php?page=thuoc-tinh-value');
?>