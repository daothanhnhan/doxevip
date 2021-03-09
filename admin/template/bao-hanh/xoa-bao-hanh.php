<?php 
	$id = $_GET['id'];
	$sql = "DELETE FROM bao_hanh WHERE id = $id";
	$result = mysqli_query($conn_vn, $sql);
	header('location: index.php?page=bao-hanh');
?>