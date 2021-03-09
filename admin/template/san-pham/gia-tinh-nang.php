<textarea name="gia_tinh_nang_1" style="display: none"><?= $row['gia_tinh_nang_1'] ?></textarea>
<textarea name="gia_tinh_nang_2" style="display: none"><?= $row['gia_tinh_nang_2'] ?></textarea>
<p class="titleRightNCP">Giá tính năng:</p><br style="clear: both;">
            <!-- <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP1 ckeditor1" id="editor3" name="product_sub_info2"><?php echo $row['product_sub_info2'];?></textarea></p> -->
            <?php if (empty($row['gia_tinh_nang_1'])) { ?>
            <?php 

            $d = -1;
            foreach ($gia as $item) { 
                $d++
            ?>
                <p><?= $d+1 ?></p>
                <input type="text" class="txtNCP1" name="product_des3[]" value="<?= $ten_anh[$d] ?>"><br>
                <input type="number" name="product_sub_info2[]" value="<?= $item ?>"><br>
            <?php } ?>

            <?php } else { 
                $gia_tinh_nang_1_arr = json_decode($row['gia_tinh_nang_2'], true);//var_dump($gia_tinh_nang_1_arr);
                // var_dump($ten_tinh_nang);
            ?>
                <?php 
                foreach ($gia_tinh_nang_1_arr as $item) { 
                    $item_name = explode(',', $item['skuPropIds']);
                ?>

                    <p style="float: none;">
                        <?php foreach ($item_name as $name_key) { ?>
                            <?= $ten_tinh_nang[$name_key]; ?>, 
                        <?php } ?>
                    </p>
                    <p style="float: none;"><input type="hidden" name="gia_ma[]" value="<?= $item['skuPropIds'] ?>"></p>
                    <p style="float: none;"><input type="text" name="gia_chinh[]" value="<?= $item['skuVal']['skuMultiCurrencyDisplayPrice'] ?>"></p>
                    <p style="float: none;"><input type="text" name="gia_phu[]" value="<?= $item['skuVal']['actSkuMultiCurrencyDisplayPrice'] ?>"></p>
                    <hr>
                        
                <?php } ?>
            <?php } ?>