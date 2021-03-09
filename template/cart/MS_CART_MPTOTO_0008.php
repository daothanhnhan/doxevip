<table class="table hidden-md hidden-lg" id="cart_mb" style="max-width: 100%;">
	<tbody>
		<?php

        if(!empty($_SESSION["shopping_cart"]))

        {

             $total = 0;

             foreach($_SESSION["shopping_cart"] as $keys => $values)
             	
             {
             	$cart_product = $action->getDetail('product', 'product_id', $values['product_id']);
        ?>
		<tr>
			<td style="white-space: normal;">
				<a><?php echo $values["product_name"]; ?></a>
				<div>
					<div style="display: inline-block;width: 49%;">
						<p><?= number_format($values['product_price']) ?> đ</p>
						<!-- <p><del><?= number_format($cart_product['product_price']) ?> đ</del></p> -->
					</div>
					<div style="display: inline-block;width: 49%;float: right;">
						<input type="number" class="form-control" name="" value="<?php echo $values["product_quantity"]; ?>" onchange="soluong_mb(this.value, <?= $values['product_id'] ?>)" >
					</div>
				</div>
				<button name="delete" class="btn btn-danger btn-xs delete-1" id="<?php echo $values["product_id"]; ?>" style="margin: 0px;" onclick="xoa_mb(<?= $values['product_id'] ?>)">Xóa sản phẩm</button>
			</td>
		</tr>
		<?php

            $total = $total + ($values["product_quantity"] * $values["product_price"]);



            }

             $_SESSION['total'] = $total;
}
        ?>
        <tr>
        	<td>Tổng: <?= number_format($total) ?> đ</td>
        </tr>
	</tbody>
</table>
<p style="text-align: center;display: none;">
	<a href="/thanh-toan" title="" class="btn btn-warning hidden-md hidden-lg" style="">Thanh toán</a>
</p>
