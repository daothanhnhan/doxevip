<?php
	include_once 'admin/action_order.php';
	function get_list_user_1(){
		global $conn_vn;
		$user = $_SESSION['user_name_gbvn'];
		$sql = "SELECT * FROM user Where user_name = '$user'";
        $result = mysqli_query($conn_vn, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row;
	}

	$list_user = get_list_user_1();
	$mail_buyer = $list_user['user_email'];

	function get_cart($mail_buyer){
		global $conn_vn;
		$sql = "SELECT * FROM cart WHERE mail_buyer = '$mail_buyer' ORDER BY id_cart DESC";
	    $result = mysqli_query($conn_vn, $sql);
	    $rows1 = array();
	    while ($row = mysqli_fetch_assoc($result)) {
	        $rows1[] = $row;
	    }
	    $rows = array('data' => $rows1);
	    return $rows;
	}
	
	$list_cart = get_cart($mail_buyer);
	$id_cart = $_GET['trang'];
	$order = new action_order();
    $rowOrder = $order->getOrderDetail($id_cart);
    $listOrderDetail =  $order->getlistOrderDetailByCartId($rowOrder['id_cart']);
    $orderStates = $order->getOrderState();


?>
<div class="gb-tintuc">
	<?php include DIR_BREADCRUMBS."MS_BREADCRUMS_EXCEL_0001.php";?>
	<div class="container">
		<?php include DIR_BREADCRUMBS."MS_BREADCRUMS_EXCEL_0001.php";?>
		<div class="row">
			<div class="col-md-3">
				<?php include DIR_REGISTER."MS_REGISTER_EXCEL_0006.php";?>
			</div>
			<div class="col-md-9">
				<?php include DIR_REGISTER."MS_REGISTER_EXCEL_0008.php";?>
			</div>	
		</div>
	</div>
</div>
