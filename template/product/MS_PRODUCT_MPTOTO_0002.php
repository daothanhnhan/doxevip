<?php 
	if (!empty($gia_tinh_nang)) {
		// giá từ taobao
		// echo $row['product_price_sale'];
		$sp_gia_giam_ko = reset($gia_tinh_nang);//echo $sp_gia_giam_ko;
		$sp_gia_giam = $sp_gia_giam_ko-($sp_gia_giam_ko*($row['product_price_sale']/100));//echo $sp_gia_giam;
	} else {
		// echo $gia_tinh_nang_giam[0];
		// $sp_gia_giam = $gia_tinh_nang_giam[0];
	}

	if (!empty($row['tinh_nang_1'])) {
		// giá từ ali
		// var_dump($tinh_nang_1);
		$count_loai_tinh_nang = count($tinh_nang_1);
		$text_id_loai = '';
		for ($i=0;$i<$count_loai_tinh_nang;$i++) {
			$start_tn = reset($tinh_nang_1[$i]['skuPropertyValues']);
			$text_id_loai .= $start_tn['propertyValueId'].',';
		}
		$text_id_loai = substr($text_id_loai, 0, -1);
		// echo $text_id_loai;
		$gia_tinh_nang_2 = json_decode($row['gia_tinh_nang_2'], true);//var_dump($gia_tinh_nang_2);
		foreach ($gia_tinh_nang_2 as $item) {
			if ($item['skuPropIds'] == $text_id_loai) {
				// var_dump($item);
				$ali_sp_gia = $item['skuVal']['skuMultiCurrencyDisplayPrice'];
				$ali_sp_gia_giam = $item['skuVal']['actSkuMultiCurrencyDisplayPrice'];
			}
		}
		
		if (empty($ali_sp_gia_giam)) {
			$sp_gia_giam = $ali_sp_gia;
		} else {
			$sp_gia_giam = $ali_sp_gia_giam;
		}
	} else {
		// echo 'giá ali không tính năng';
		// var_dump($gia_tinh_nang_giam);
		if (empty($gia_tinh_nang)) {
			// var_dump($)
			// echo 'giá ali không tính năng 1';
			if (!empty($row['gia_tinh_nang_2'])) {
				$gia_tinh_nang_2 = json_decode($row['gia_tinh_nang_2'], true);//var_dump($gia_tinh_nang_2);
				$ali_sp_gia = $gia_tinh_nang_2[0]['skuVal']['skuMultiCurrencyDisplayPrice'];//echo $ali_sp_gia;
				$ali_sp_gia_giam = $gia_tinh_nang_2[0]['skuVal']['actSkuMultiCurrencyDisplayPrice'];
			}
			if (empty($ali_sp_gia_giam)) {
				$sp_gia_giam = $ali_sp_gia;
			} else {
				$sp_gia_giam = $ali_sp_gia_giam;
			}
		}
		
	}

	if (!empty($row['tinh_nang_gia_sp'])) {
		// giá từ tự đăng
		$tinh_nang_gia_sp = json_decode($row['tinh_nang_gia_sp'], true);
		if (empty($tinh_nang_gia_sp[0]['price2'])) {
			$sp_gia_giam_ko = $tinh_nang_gia_sp[0]['price1'];
			$sp_gia_giam = $tinh_nang_gia_sp[0]['price1'];
		} else {
			$sp_gia_giam_ko = $tinh_nang_gia_sp[0]['price1'];
			$sp_gia_giam = $tinh_nang_gia_sp[0]['price2'];
		}
		
	}
?>
<?php
	if($row['product_price'] != 0 && $row['product_price_sale'] != 0 && false){
?>
<div class="gb-product-item-prices_mptoto">
    <p class="gb-prices-news"><?= number_format($row['product_price']-($row['product_price']*($row['product_price_sale']/100))) ?> VNĐ <span class="gb-prices-old"><?= number_format($row['product_price']) ?> VNĐ</span></p>    
</div>
<?php }else if($row['product_price'] != 0 || true){ ?>
	<?php if (empty($row['gia_tinh_nang_1'])) { ?>
<div class="gb-product-item-prices_mptoto">
	<p class="gb-prices-news" id="gia"><?= number_format($sp_gia_giam) ?> VNĐ <del style="color: #ccc;font-size: 20px;"><?= number_format($sp_gia_giam_ko) ?> VNĐ</del></p>
</div>
	<?php } else { ?>
		<div class="gb-product-item-prices_mptoto">
			<?php if (empty($ali_sp_gia_giam)) { ?>
			<p class="gb-prices-news" id="gia"><?= number_format($ali_sp_gia) ?> VNĐ</p>
			<?php } else { ?>
				<p class="gb-prices-news" id="gia"><?= number_format($ali_sp_gia_giam) ?> VNĐ <del style="color: #ccc;font-size: 20px;"><?= number_format($ali_sp_gia) ?> VNĐ</del></p>
			<?php } ?>
		</div>
	<?php } ?>
<?php }else{?>
	<div class="gb-product-item-lienhe_mptoto">
	    <a class="nonePriceDetail" href="tel:<?= $rowConfig['content_home3'] ?>" title="">LIÊN HỆ BÁO GIÁ</a>
	</div>
<?php } ?>


<style type="text/css" media="screen">
	.gb-product-item-lienhe_mptoto a{
		display: inline-block;
		padding: 10px 20px;
		color: #fff;
		background: #f53b3b;
		margin-top: 15px;
	}
</style>