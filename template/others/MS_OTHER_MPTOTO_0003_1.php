<?php 
	$xay_dung_may_tinh = $action->getList('xay_dung_may_tinh', '', '', 'id', 'asc', '', '', '');
	$product_all_kv = $kiotviet->get_product_all_db();
	foreach ($xay_dung_may_tinh as $item) {
		$_SESSION['xay_dung_pc_'.$item['id']] = array();
	}
	$_SESSION['pre_cart'] = array();
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
		<a href="" title="" style="" class="lam-moi">Làm mới <i class="fa fa-undo"></i></a>
	</div>
	<div style="clear: both;"></div>
	<hr>
	<div>
		<span>Vui lòng chọn linh kiện bạn cần để xây dựng cấu hình máy tính riêng cho bạn</span>
		<p style="" class="du-tinh">Chi phí dự tính: <span id="phi-pc">0</span> đ</p>
	</div>
	<div>
		<table class="table table-striped">
		    <tbody>
		    <?php 
		    $d = 0;
		    foreach ($xay_dung_may_tinh as $item) { 
		    	$d++;
		    ?>
		      <tr>
		        <td><?= $d ?>. <?= $item['name'] ?></td>
		        <td id="show-pc-<?= $item['id'] ?>"><button type="" style="" class="chon" data-toggle="modal" data-target="#myModal<?= $d ?>"><i class="fa fa-plus"></i> Chọn <?= $item['name'] ?></button></td>
		      </tr>
		    <?php } ?>
		    </tbody>
		</table>
	</div>
	<div>
		<button style="" class="gb-pc-add-cart" onclick="cart()">
			Thêm và giỏ hàng <i class="fa fa-cart-plus"></i>
		</button>
	</div>
</div>

<?php
$d = 0; 
foreach ($xay_dung_may_tinh as $item) { 
	$d++;
	$list_idkv = $kiotviet->get_products_idkv_pc($item['id']);
	$products_pc = $kiotviet->get_products_pc($product_all_kv, $list_idkv);//var_dump($products_pc);
	// $filter = $kiotviet->check_attribute_pc($products_pc);
	$filter = $kiotviet->thuoc_tinh($products_pc);
?>
<!-- Modal -->
<div id="myModal<?= $d ?>" class="modal fade gb-popup-pc" role="dialog">
  <div class="modal-dialog modal-lg gb-body-popup-pc" style="height: 90%;">

    <!-- Modal content-->
    <div class="modal-content" style="height: 100%;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?= $item['name'] ?></h4>
      </div>
      <div class="modal-body" style="height: 85%;">
        <div class="container" style="width: 100%;height: 100%;" id="ajax-pc-<?= $item['id'] ?>">
		  <div class="row" style="height: 100%;">
		    <div class="col-md-3 gb-content-popup-pc" style="background: #f1f1f1;overflow-y: scroll;height: 100%;">
		    	<div style="" class="loc">
		    		Lọc sản phẩm theo
		    	</div>
		    	<?php foreach ($filter as $item_f) { ?>
		    	<div style="" class="gb-loc-item">
			    	<p style="font-weight: bold;"><?= $item_f['name'] ?></p>
			    	<?php foreach ($item_f['value'] as $item_f_v) { ?>
			    	<input type="checkbox" name="" style="" class="gb-chkbox-popup" onclick="filter('<?= $item['id'] ?>', '<?= $item_f['name'] ?>', '<?= $item_f_v ?>')"> <?= $item_f_v ?>	<br>
			    	<?php } ?>
		    	</div>
		    	<?php } ?>
		    	
		    </div>
		    <div class="col-md-9 gb-content-popup-pc" style="overflow-y: scroll;height: 100%;">
		    	<?php 
		    	foreach ($products_pc as $item_p) { 
		    		$row_p = $kiotviet->product_gb($item_p['id']);
		    		if ($item_p['images']) {
                            // var_dump($item['images']);
                            $row_p['product_img'] = $item_p['images'][0];
                        }
		    	?>
		    	<div class="row">
		    		<div class="col-md-2">
		    			<a href="/<?= $row_p['friendly_url'] ?>"><img src="<?= $row_p['product_img'] ?>" alt="" width="100%"></a>
		    		</div>
		    		<div class="col-md-7">
		    			<p style="font-weight: bold;"><?= $item_p['name'] ?></p>
		    			<p><span style="font-weight: bold;">Mã SP</span>: <?= $item_p['code'] ?></p>
		    			<p><span style="font-weight: bold;">Bảo hành</span>: <?= $row_p['product_sub_info1'] ?></p>
		    			<p><span style="font-weight: bold;">Kho hàng</span>: <?= $row_p['product_sub_info2'] ?></p>
		    			<p style="color: red;"><?= number_format($item_p['basePrice']) ?></p>
		    		</div>
		    		<div class="col-md-3">
						<button type="" style="" class="gb-pro-add" data-dismiss="modal" onclick="add_pc(<?= $item_p['id'] ?>, <?= $item['id'] ?>)">Thêm vào cấu hình</button>		    			
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
		var xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
		     document.getElementById("phi-pc").innerHTML = this.responseText;
		    }
		  };
		  xhttp.open("GET", "/functions/ajax/chi-phi-pc.php", true);
		  xhttp.send();
	}
</script>