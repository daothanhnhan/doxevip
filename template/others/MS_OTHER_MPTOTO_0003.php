<?php 
	$xay_dung_may_tinh = $action->getList('xay_dung_may_tinh', '', '', 'id', 'asc', '', '', '');
	// $product_all_kv = $kiotviet->get_product_all_db_state();
	foreach ($xay_dung_may_tinh as $item) {
		// if (!isset($_SESSION['xay_dung_pc_'.$item['id']])) {
			$_SESSION['xay_dung_pc_'.$item['id']] = array();
			$_SESSION['xay_dung_pc_q_'.$item['id']] = '';
		// }
	}
	$total = 0;
	if (!isset($_SESSION['pre_cart'])) {
		$_SESSION['pre_cart'] = array();
	} else {
		$arr_pre_cart = array();
		foreach ($_SESSION['pre_cart'] as $item) {
			$arr_pre_cart[] = $item['idpc'];
			$product_price = $action->getDetail('product', 'product_id', $item['idkv']);
			$total += $action->percent1($product_price['product_price'], $product_price['product_price_sale']);
		}
	}
	
	// var_dump($_SESSION['pre_cart']);
?>
<style type="text/css">
@media (min-width: 992px) {
	.modal-lg {
    	width: 1120px;
	}
}
@media screen and (max-width: 991px) {
	.gb-body-popup-pc {
		height: 180% !important;
	}
	.gb-content-popup-pc {
		height: 50% !important;
	}
}
</style>
<div class="container gb-xay-dung-pc" style="background: white;">
	<div style="margin-top: 40px;">
		<h1 style="">Xây dựng máy tính</h1>	
		<a href="#" title="" style="" class="lam-moi" onclick="reset()">Làm mới <i class="fa fa-undo"></i></a>
	</div>
	<div style="clear: both;"></div>
	<hr>
	<div>
		<span>Vui lòng chọn linh kiện bạn cần để xây dựng cấu hình máy tính riêng cho bạn</span>
		<p style="" class="du-tinh">Chi phí dự tính: <span id="phi-pc"><?= number_format($total) ?></span> đ</p>
	</div>
	<div id="print-pc">
		<table class="table table-striped">
		    <tbody>
		    <?php 
		    $d = 0;
		    foreach ($xay_dung_may_tinh as $item) { 
		    	$d++;
		    ?>
		      <tr>
		        <td><?= $d ?>. <?= $item['name'] ?></td>
		        <?php if (!in_array($item['id'], $arr_pre_cart)) { ?>
		        <td id="show-pc-<?= $item['id'] ?>"><button type="" style="" class="chon" data-toggle="modal" data-target="#myModal<?= $item['id'] ?>"><i class="fa fa-plus"></i> Chọn <?= $item['name'] ?></button></td>
		    	<?php } else { 
		    		$product_idkv = 0;
		    		foreach ($_SESSION['pre_cart'] as $item_precart) {
		    			if ($item_precart['idpc']==$item['id']) {
		    				$product_idkv = $item_precart['idkv'];
		    				break;
		    			}
		    		}
		    		$product = $action->getDetail('product', 'product_id', $product_idkv);
					
		    		?>
		    		<td id="show-pc-<?= $item['id'] ?>">
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
									<i class="fa fa-edit edit-item" data-toggle="modal" data-target="#myModal<?= $item['id'] ?>"></i>
								</div>
								<div class="col-md-1">
									<i class="fa fa-trash remove-item" onclick="remove_pc(<?= $item['id'] ?>)"></i>
								</div>
							</div>
						</div>
					</td>
		    	<?php } ?>
		      </tr>
		    <?php } ?>
		    </tbody>
		</table>
	</div>
	<div style="text-align: right;">
		<button type="" class="gb-pc-add-cart" style="background: #536be8;"><a href="/functions/excel/pc.php" style="color: white;">Tải file excel cấu hình</a></button>
		<button type="" class="gb-pc-add-cart" style="background: #536be8;"><a href="/pc/pc.php" style="color: white;">Xem & In  <i class="fa fa-picture-o"></i></a></button>
		<button style="" class="gb-pc-add-cart" onclick="cart()">
			Thêm và giỏ hàng <i class="fa fa-cart-plus"></i>
		</button>
	</div>
</div>

<?php
$d = 0; 
foreach ($xay_dung_may_tinh as $item) { 
	$d++;

	$products_pc = $action->getList_pc('product', '', $item['id'], 'product_id', 'desc', '', '', '');
	$filter = $action_product->get_list_attribute($products_pc);
	$products_pc = $action->list_product_paging_pc($products_pc, $item['id'], 1);
?>
<!-- Modal -->
<div id="myModal<?= $item['id'] ?>" class="modal fade gb-popup-pc" role="dialog">
  <div class="modal-dialog modal-lg gb-body-popup-pc" style="height: 90%;">

    <!-- Modal content-->
    <div class="modal-content" style="height: 100%;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?= $item['name'] ?></h4>
        <form class="navbar-form navbar-right" action="/" onsubmit="return search(<?= $item['id'] ?>)" style="float: none !important;text-align: center;">
		  <div class="input-group gb-input-pc">
		    <input type="text" id="q-<?= $item['id'] ?>" class="form-control" placeholder="Search">
		    <div class="input-group-btn">
		      <button class="btn btn-default" type="submit">
		        <i class="glyphicon glyphicon-search"></i>
		      </button>
		    </div>
		  </div>
		</form>
      </div>
      <div class="modal-body" style="height: 80%;">
        <div class="container" style="width: 100%;height: 100%;" id="ajax-pc-<?= $item['id'] ?>">
		  <div class="row" style="height: 100%;">
		    <div class="col-md-3 gb-content-popup-pc" style="background: #f1f1f1;overflow-y: scroll;height: 100%;">
		    	<div style="" class="loc">
		    		Lọc sản phẩm theo
		    	</div>
		    	<?php foreach ($filter as $item_f) { ?>
		    	<div style="" class="gb-loc-item">
			    	<p style="font-weight: bold;"><?= $action->getDetail('thuoc_tinh', 'id', $item_f['name'])['name'] ?></p>
			    	<?php foreach ($item_f['value'] as $item_f_v) { ?>
			    	<input type="checkbox" name="" style="" class="gb-chkbox-popup" onclick="filter('<?= $item['id'] ?>', '<?= $item_f['name'] ?>', '<?= $item_f_v ?>')"> <?= $action->getDetail('thuoc_tinh_value', 'id',$item_f_v)['name'] ?>	<br>
			    	<?php } ?>
		    	</div>
		    	<?php } ?>
		    	
		    </div>
		    <div class="col-md-9 gb-content-popup-pc" style="overflow-y: scroll;height: 100%;">
		    	<div>
		    		<?= $products_pc['paging'] ?>
		    	</div>
		    	<?php 
		    	foreach ($products_pc['data'] as $row_p) { 

		    	?>
		    	<div class="row">
		    		<div class="col-md-2">
		    			<a href="/<?= $row_p['friendly_url'] ?>"><img src="/images/<?= $row_p['product_img'] ?>" alt="" width="100%"></a>
		    		</div>
		    		<div class="col-md-7">
		    			<p style="font-weight: bold;"><?= $row_p['product_name'] ?></p>
		    			<p><span style="font-weight: bold;">Mã SP</span>: <?= $row_p['product_code'] ?></p>
		    			<p><span style="font-weight: bold;">Bảo hành</span>: <?= $row_p['product_sub_info1'] ?></p>
		    			<p><span style="font-weight: bold;">Kho hàng</span>: <?= $row_p['product_sub_info2'] ?></p>
		    			<?php if ($row_p['product_price_sale'] == 0) { ?>
		    			<p style="color: red;"><?= number_format($row_p['product_price']) ?></p>
		    			<?php } else { ?>
		    			<p style="color: red;"><del><?= number_format($row_p['product_price']) ?></del></p>
						<p style="color: red;"><?= number_format($action->percent1($row_p['product_price'], $row_p['product_price_sale'])) ?></p>
						<?php } ?>
		    		</div>
		    		<div class="col-md-3">
						<button type="" style="" class="gb-pro-add" data-dismiss="modal" onclick="add_pc(<?= $row_p['product_id'] ?>, <?= $item['id'] ?>)">Thêm vào cấu hình</button>		    			
		    		</div>
		    	</div>
		    	<?php } ?>
		    </div>
		  </div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<?php } ?>
<script type="text/javascript">
	function filter (pc, name, value) {
		// alert(name);
		var xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
		     document.getElementById("ajax-pc-"+pc).innerHTML = this.responseText;
		    }
		  };
		  xhttp.open("GET", "/functions/ajax/filter-pc.php?pc="+pc+"&name="+name+"&value="+value, true);
		  xhttp.send();
	}

	function add_pc (idkv, idpc) {
		// alert(idkv+'-'+idpc);
		var xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
		     document.getElementById("show-pc-"+idpc).innerHTML = this.responseText;
		     chi_phi_pc();
		    }
		  };
		  xhttp.open("GET", "/functions/ajax/add-pc.php?idkv="+idkv+"&idpc="+idpc, true);
		  xhttp.send();
	}

	function remove_pc (idpc) {
		var xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
		     document.getElementById("show-pc-"+idpc).innerHTML = this.responseText;
		     chi_phi_pc();
		    }
		  };
		  xhttp.open("GET", "/functions/ajax/remove-pc.php?idpc="+idpc, true);
		  xhttp.send();
	}

	function cart () {
		var xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
		     var out = this.responseText;
		     if (out == 'ok') {
		     	window.location.href = "/gio-hang";
		     } else {
		     	alert('Bạn chưa chọn sản phẩm.');
		     }
		    }
		  };
		  xhttp.open("GET", "/functions/ajax/cart-pc.php", true);
		  xhttp.send();
	}

	function chi_phi_pc () {
		// alert('chi phi');
		var xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
		    	// alert('chi phi 1');
		     document.getElementById("phi-pc").innerHTML = this.responseText;
		    }
		  };
		  xhttp.open("GET", "/functions/ajax/chi-phi-pc.php", true);
		  xhttp.send();
	}

	function paging (pc, trang) {
		var xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
		     document.getElementById("ajax-pc-"+pc).innerHTML = this.responseText;
		    }
		  };
		  xhttp.open("GET", "/functions/ajax/paging-pc.php?pc="+pc+"&trang="+trang, true);
		  xhttp.send();
	}

	function search (pc) {
		var q = document.getElementById('q-'+pc).value;
		// alert(q);
		var xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
		     document.getElementById("ajax-pc-"+pc).innerHTML = this.responseText;
		    }
		  };
		  xhttp.open("GET", "/functions/ajax/search-pc.php?pc="+pc+"&q="+q, true);
		  xhttp.send();
		return false;
	}

	function reset () {
		var xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
		     // document.getElementById("ajax-pc-"+pc).innerHTML = this.responseText;
		     location.reload();
		    }
		  };
		  xhttp.open("GET", "/functions/ajax/reset-pc.php?", true);
		  xhttp.send();
	}
</script>
<script>
function In_Content(strid){   
    var prtContent = document.getElementById(strid);
    var WinPrint = window.open('','','letf=0,top=0,width=800,height=800');
    WinPrint.document.write(prtContent.innerHTML);
    WinPrint.document.close();
    WinPrint.focus();
    WinPrint.print();
}
</script>