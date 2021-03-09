<?php 
	function gia_tinh_nang_sp ($id) {
		global $conn_vn;
		if (isset($_POST['gia-tinh-nang-sp'])) {
			$ma = $_POST['ma'];
			$gia1 = $_POST['gia1'];
			$gia2 = $_POST['gia2'];
			
			$arr_tinh_nang = array();

			foreach ($ma as $k => $item) {
				$arr_tinh_nang[] = array(
					'code' => $item,
					'price1' => $gia1[$k],
					'price2' => $gia2[$k]
				);
			}

			$json = json_encode($arr_tinh_nang);

			$gia_tn_sp = mysqli_real_escape_string($conn_vn, $json);

			$sql = "UPDATE product SET tinh_nang_gia_sp = '$gia_tn_sp' WHERE product_id = $id";
			$result = mysqli_query($conn_vn, $sql);
			if ($result) {
				echo '<script>alert(\'Tạo giá thành công.\');</script>';
			} else {
				echo '<script>alert(\'Có lỗi xảy ra.\');</script>';
			}
		}
	}
	gia_tinh_nang_sp($_GET['product_id']);

	function lam_moi ($id) {
		global $conn_vn;
		if (isset($_POST['lam_moi'])) {
			$sql = "UPDATE product SET tinh_nang_gia_sp = '' WHERE product_id = $id";
			$result = mysqli_query($conn_vn, $sql);
			if ($result) {
				echo '<script>alert(\'Làm mới thành công.\');</script>';
			} else {
				echo '<script>alert(\'Có lỗi xảy ra.\');</script>';
			}
		}
	}
	lam_moi($_GET['product_id']);

	$product = $action->getDetail('product', 'product_id', $_GET['product_id']);
	// var_dump($product['tinh_nang_gia_sp']);

	$sp_gtn = json_decode($product['tinh_nang_gia_sp'], true);
	// var_dump($sp_gtn);
?>

<h2 style="width: 100%;"><a href="index.php?page=sua-san-pham&id=<?= $_GET['product_id'] ?>" title="">Quay lại</a></h2>
<?php 
	$tinh_nang_cat = $action->getList('tinh_nang_cat', 'product_id', $_GET['product_id'], 'id', 'asc', '', '', '');
	$tinh_nang_cat_arr = array();
	$tong = 1;
	foreach ($tinh_nang_cat as $tn_cat) { 
		$tinh_nang_item = $action->getList('tinh_nang_item', 'tinh_nang_cat_id', $tn_cat['id'], 'id', 'asc', '', '', '');
		$tinh_nang_cat_arr[] = $tinh_nang_item;
		$tong_item = count($tinh_nang_item);
		$tong *= $tong_item; 
		foreach ($tinh_nang_item as $tn_item) { 

?>
	
<?php } } ?>

<?php 
// var_dump($)
	$loai = count($tinh_nang_cat_arr);//echo $loai;
	// echo $tong;
	$arr_ma = array();
	$arr_ten = array();
	for ($i=0;$i<$tong;$i++) {
		// echo $i;
		$arr_ma[$i] = '';
		$arr_ten[$i] = '';
		for ($j=0;$j<$loai;$j++) {
			$count = count($tinh_nang_cat_arr[$j]);
			if ($j == 0) {
				$k2 = $tong/$count;
				$k = floor($i/$k2);
				$k1 = $i%$k2;
			} else {
				if ($j < $loai-1) {
					$k2 = $k2/$count;
					$k = floor($k1/$k2);// làm chòn
					$k1 = $k1%$k2;// dư
				} else {
					$k = $k1%$count;
				}
				
			}
			
			$arr_ma[$i] .= $tinh_nang_cat_arr[$j][$k]['id'].',';
			$arr_ten[$i] .= $tinh_nang_cat_arr[$j][$k]['name'].',';
			// echo $j;
		}
		$arr_ma[$i] = substr($arr_ma[$i], 0, -1);
		$arr_ten[$i] = substr($arr_ten[$i], 0, -1);
	}
	// var_dump($arr_ma); 
	// var_dump($arr_ten); 
	// var_dump($tinh_nang_cat_arr);
	
?>
<form action="" method="post" accept-charset="utf-8">
<?php if (empty($product['tinh_nang_gia_sp'])) { ?>
<?php foreach ($arr_ma as $k => $item) { ?>
	<p style="width: 100%;clear: both;"><?= $arr_ten[$k] ?></p>
	<input type="hidden" name="ma[]" value="<?= $item ?>" style="clear: both;">
	<input type="number" name="gia1[]" value="0" style="clear: both;"><br>
	<input type="number" name="gia2[]" value="0" style="clear: both;">
	<br>
<?php } ?>
<?php } else { ?>
<?php foreach ($sp_gtn as $k => $item) { ?>
	<p style="width: 100%;clear: both;"><?= $arr_ten[$k] ?></p>
	<input type="hidden" name="ma[]" value="<?= $item['code'] ?>" style="clear: both;">
	<input type="number" name="gia1[]" value="<?= $item['price1'] ?>" style="clear: both;"><br>
	<input type="number" name="gia2[]" value="<?= $item['price2'] ?>" style="clear: both;">
	<br>
<?php } ?>
<?php } ?>
	<button type="submit" name="gia-tinh-nang-sp">Cập nhật</button>

</form>
<hr>
<form action="" method="post" accept-charset="utf-8">
	<button type="submit" name="lam_moi">Làm mới</button>
</form>
<hr>
<p>Chú ý: sau khi bạn có thay đổi về tính năng bạn lên làm mới lại giá.</p>