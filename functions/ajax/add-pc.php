<?php 
	session_start();
	$idkv = $_GET['idkv'];
	$idpc = $_GET['idpc'];
	if (empty($_SESSION['pre_cart'])) {
		$_SESSION['pre_cart'][] = array(
			'idpc' => $idpc,
			'idkv' => $idkv
		);
	} else {
		$arr_idpc = array();
		foreach ($_SESSION['pre_cart'] as $k => $item) {
			$arr_idpc[] = $item['idpc'];
			if ($idpc == $item['idpc']) {
				$_SESSION['pre_cart'][$k]['idkv'] = $idkv;
			}
		}
		if (!in_array($idpc, $arr_idpc)) {
			$_SESSION['pre_cart'][] = array(
				'idpc' => $idpc,
				'idkv' => $idkv
			);
		}
	}
	////////////////////
	include_once dirname(__FILE__)."/../database.php";
	include_once dirname(__FILE__)."/../library.php";
	include_once dirname(__FILE__)."/../pagination/Pagination.php";
	// include_once dirname(__FILE__)."/../action_kiotviet.php";
	include_once dirname(__FILE__)."/../action.php";
	$action = new action();
	// $kiotviet = new action_kiotviet();

	
	// echo $idpc.'-'.$idkv;
	// $check = $kiotviet->check_has_product($idkv);
	// if ($check == false) {
	// 	$cau_hinh_pc = $action->getDetail('xay_dung_may_tinh', 'id', $idpc);
	// 	echo '<button type="" style="" class="chon" data-toggle="modal" data-target="#myModal'.$idpc.'"><i class="fa fa-plus"></i> Chọn '.$cau_hinh_pc['name'].'</button>';
	// 	die();
	// }

	$product = $action->getDetail('product', 'product_id', $idkv);
?>
<div style="width: 100%;">
	<div class="row">
		<div class="col-md-2">
			<a href="/<?= $product['friendly_url'] ?>"><img src="/images/<?= $product['product_img'] ?>" alt="" style="width: 100%;"></a>
		</div>
		<div class="col-md-6">
			<p style="font-weight: bold;"><?= $product['product_name'] ?></p>
			<p>Mã sản phẩm: <?= $product['product_code'] ?></p>
			<p>Bảo hành: <?= $product['product_sub_info1'] ?></p>
			<p>Kho hàng: <?= $product['product_sub_info2'] ?></p>
		</div>
		<div class="col-md-2">
			<?php if ($product['product_price_sale'] == 0) { ?>
			<p style="color: red;"><?= number_format($product['product_price']) ?></p>
			<?php } else { ?>
			<p style="color: red;"><del><?= number_format($product['product_price']) ?></del></p>
			<p style="color: red;"><?= number_format($action->percent1($product['product_price'], $product['product_price_sale'])) ?></p>
			<?php } ?>
		</div>
		<div class="col-md-1">
			<i class="fa fa-edit edit-item" data-toggle="modal" data-target="#myModal<?= $idpc ?>"></i>
		</div>
		<div class="col-md-1">
			<i class="fa fa-trash remove-item" onclick="remove_pc(<?= $idpc ?>)"></i>
		</div>
	</div>
</div>