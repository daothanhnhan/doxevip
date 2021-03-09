<?php 
	include_once dirname(__FILE__)."/../database.php";
	include_once dirname(__FILE__)."/../library.php";
	include_once dirname(__FILE__)."/../pagination/Pagination.php";
	// include_once dirname(__FILE__)."/../action_kiotviet.php";
	include_once dirname(__FILE__)."/../action.php";
	include_once dirname(__FILE__)."/../action_product.php";
	include_once dirname(__FILE__)."/../vi_en.php";

	session_start();
	$pc = $_GET['pc'];
	$name = $_GET['name'];
	$value = $_GET['value'];
	$_SESSION['xay_dung_pc_'.$pc];
	if (empty($_SESSION['xay_dung_pc_'.$pc])) {
		$_SESSION['xay_dung_pc_'.$pc][] = $value;
		// echo 'moi';
	} else {
		$arr_name = array();
		foreach ($_SESSION['xay_dung_pc_'.$pc] as $k => $v) {
			$arr_name[] = $v;
		}
		if (in_array($value, $arr_name)) {
			foreach ($_SESSION['xay_dung_pc_'.$pc] as $k => $v) {
				if ($value == $v) {
					unset($_SESSION['xay_dung_pc_'.$pc][$k]);
				}
			}
			// echo 'xoa';
		} else {
			$_SESSION['xay_dung_pc_'.$pc][] = $value;
			// echo 'them';
		}
	}
	//////////////
	// $kiotviet = new action_kiotviet();
	$action = new action();
	$action_product = new action_product();

	$products_pc = $action->getList_pc('product', '', $pc, 'product_id', 'desc', '', '' ,'');
	$filter = $action_product->get_list_attribute($products_pc);
	$products_pc = $action->list_product_paging_pc($products_pc, $pc, 1);
	/////////////
	$arr_filter_name = array();
	foreach ($_SESSION['xay_dung_pc_'.$pc] as $item) {
		$arr_filter_name[] = $item;
	}
?>
		  <div class="row" style="height: 100%;">
		    <div class="col-md-3" style="background: #f1f1f1;overflow-y: scroll;height: 100%;">
		    	<div style="" class="loc">
		    		Lọc sản phẩm theo
		    	</div>
		    		<?php foreach ($filter as $item) { ?>
		    		<div style="" class="gb-loc-item">
			    	<p style="font-weight: bold;"><?= $action->getDetail('thuoc_tinh', 'id', $item['name'])['name'] ?></p>
			    		<?php 
			    		$checked = '';
			    		foreach ($item['value'] as $item_v) { 
			    			if (in_array($item_v, $arr_filter_name)) {
			    				$checked = 'checked';
			    			}
			    		?>
			    		<input type="checkbox" name="" style="" class="gb-chkbox-popup" onclick="filter('<?= $pc ?>', '<?= $item['name'] ?>', '<?= $item_v ?>')" <?= $checked ?> > <?= $action->getDetail('thuoc_tinh_value', 'id',$item_v)['name'] ?>	<br>
			    		<?php } ?>
			    	</div>
		    		<?php } ?>
		    	</div>
		    <div class="col-md-9" style="overflow-y: scroll;height: 100%;">
		    	<div>
		    		<?= $products_pc['paging'] ?>
		    	</div>
		    	<?php 
		    	foreach ($products_pc['data'] as $row) { 

		    	?>
		    	<div class="row">
		    		<div class="col-md-2">
		    			<a href="/<?= $row['friendly_url'] ?>"><img src="/images/<?= $row['product_img'] ?>" alt="" width="100%"></a>
		    		</div>
		    		<div class="col-md-7">
		    			<p style="font-weight: bold;"><?= $row['product_name'] ?></p>
		    			<p><span style="font-weight: bold;">Mã SP</span>: <?= $row['product_code'] ?></p>
		    			<p><span style="font-weight: bold;">Bảo hành</span>: <?= $row['product_sub_info1'] ?></p>
		    			<p><span style="font-weight: bold;">Kho hàng</span>: <?= $row['product_sub_info2'] ?></p>
		    			<?php if ($row['product_price_sale'] == 0) { ?>
		    			<p style="color: red;"><?= number_format($row['product_price']) ?></p>
		    			<?php } else { ?>
		    			<p style="color: red;"><del><?= number_format($row['product_price']) ?></del></p>
		    			<p style="color: red;"><?= number_format($action->percent1($row['product_price'], $row['product_price_sale'])) ?></p>
		    			<?php } ?>
		    		</div>
		    		<div class="col-md-3">
						<button type="" style="" class="gb-pro-add" data-dismiss="modal" onclick="add_pc(<?= $row['product_id'] ?>, <?= $pc ?>)">Thêm vào cấu hình</button>		    			
		    		</div>
		    	</div>
		    	<?php } ?>
		    </div>
		  </div>
