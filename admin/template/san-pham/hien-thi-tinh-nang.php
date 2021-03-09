<p class="titleRightNCP">Hiển thị tính năng:</p><br style="clear: both;">
<?php 
	$anh_tinh_nang_count = count($anh_tinh_nang);
	if (empty($row['hien_thi_tinh_nang'])) {
		$d = 0;
		for ($i=0;$i<$anh_tinh_nang_count;$i++) {
			$d++;
			echo '<p>'.$d.'</p>';
			echo '<select name="hien_thi_tinh_nang[]" >
					<option value="1">Hiện</option>
					<option value="0">Ẩn</option>
				</select>';
			echo '<br><br>';
		}
	} else {
		$hien_thi_tinh_nang = json_decode($row['hien_thi_tinh_nang']);var_dump($hien_thi_tinh_nang);
		$d = 0;
		foreach ($hien_thi_tinh_nang as $item) {
			$d++;
			if ($item == 1) {
				$selected_1 = 'selected';
				$selected_0 = '';
			} else {
				$selected_1 = '';
				$selected_0 = 'selected';
			}
			echo '<p>'.$d.'</p>';
			echo '<select name="hien_thi_tinh_nang[]" >
					<option value="1" '.$selected_1.' >Hiện</option>
					<option value="0" '.$selected_0.' >Ẩn</option>
				</select>';
			echo '<br><br>';
		}
	}
?>
