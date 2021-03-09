<?php 
	$id = $_GET['id'];
	$sql = "DELETE FROM code_sale WHERE id = $id";
	$result = mysqli_query($conn_vn, $sql);
	header('location: index.php?page=ma-khuyen-mai');
?>