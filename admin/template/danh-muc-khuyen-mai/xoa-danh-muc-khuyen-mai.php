<?php 
	$id = $_GET['id'];
	$sql = "DELETE FROM sale_cat WHERE id = $id";
	$result = mysqli_query($conn_vn, $sql);
	header('location: index.php?page=danh-muc-khuyen-mai');
?>