<?php 
	$id = $_GET['id'];
	$sql = "DELETE FROM xay_dung_may_tinh WHERE id = $id";
	$result = mysqli_query($conn_vn, $sql);
	header('location: index.php?page=xay-dung-may-tinh');
?>