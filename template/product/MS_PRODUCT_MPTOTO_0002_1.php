<?php 
	if (!empty($row['tinh_nang_1'])) {
		$tinh_nang_1 = json_decode($row['tinh_nang_2'], true);
		// var_dump($tinh_nang_1);

		$count_loai_tinh_nang = count($tinh_nang_1);
		$text_id_loai = '';
		for ($i=0;$i<$count_loai_tinh_nang;$i++) {
			$text_id_loai .= $tinh_nang_1[$i]['skuPropertyValues'][0]['propertyValueId'].',';
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
	} else {
		if (!empty($row['gia_tinh_nang_2'])) {
			$gia_tinh_nang_2 = json_decode($row['gia_tinh_nang_2'], true);//var_dump($gia_tinh_nang_2);
			$ali_sp_gia = $gia_tinh_nang_2[0]['skuVal']['skuMultiCurrencyDisplayPrice'];//echo $ali_sp_gia;
			$ali_sp_gia_giam = $gia_tinh_nang_2[0]['skuVal']['actSkuMultiCurrencyDisplayPrice'];
		}
	}

	if (!empty($row['tinh_nang_gia_sp'])) {
		$tinh_nang_gia_sp = json_decode($row['tinh_nang_gia_sp'], true);
		if (empty($tinh_nang_gia_sp[0]['price2'])) {
			$gia[0] = $tinh_nang_gia_sp[0]['price1'];
			$gia_giam = $tinh_nang_gia_sp[0]['price1'];
		} else {
			$gia[0] = $tinh_nang_gia_sp[0]['price1'];
			$gia_giam = $tinh_nang_gia_sp[0]['price2'];
		}
		
	}
?>
<?php if ($row['product_price_sale'] != 0 && false) { ?>
<p class="priceSaleProductBoxPDH"><?= number_format($row['product_price']-($row['product_price']*($row['product_price_sale']/100))) ?> đ</p>
<p class="priceRealProductBoxPDH"><?= number_format($row['product_price']) ?> đ</p>
<?php } else { ?>
	<?php if (empty($row['gia_tinh_nang_1'])) { ?>
<p class="priceSaleProductBoxPDH"><?= number_format($gia_giam) ?>đ <del style=""><?= number_format($gia[0]) ?>đ</del></p>
	<?php } else { ?>
		<?php if (empty($ali_sp_gia_giam)) { ?>
		<p class="priceSaleProductBoxPDH"><?= number_format($ali_sp_gia) ?>đ</p>
		<?php } else { ?>
			<p class="priceSaleProductBoxPDH"><?= number_format($ali_sp_gia_giam) ?>đ <del style=""><?= number_format($ali_sp_gia) ?>đ</del></p>
		<?php } ?>
	<?php } ?>
<?php } ?>