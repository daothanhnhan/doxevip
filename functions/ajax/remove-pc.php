<?php 
	session_start();
	$idpc = $_GET['idpc'];
	foreach ($_SESSION['pre_cart'] as $k => $item) {
		if ($idpc == $item['idpc']) {
			unset($_SESSION['pre_cart'][$k]);
		}
	}
	/////////////////////////
	include_once dirname(__FILE__)."/../database.php";
	include_once dirname(__FILE__)."/../library.php";
	include_once dirname(__FILE__)."/../pagination/Pagination.php";
	// include_once dirname(__FILE__)."/../action_kiotviet.php";
	include_once dirname(__FILE__)."/../action.php";
	$action = new action();
	// $kiotviet = new action_kiotviet();

	
	$cau_hinh_pc = $action->getDetail('xay_dung_may_tinh', 'id', $idpc);
	echo '<button type="" style="" class="chon" data-toggle="modal" data-target="#myModal'.$idpc.'"><i class="fa fa-plus"></i> Chọn '.$cau_hinh_pc['name'].'</button>';
?>