<?php 
    $ten_tinh_nang = array();
    // var_dump(json_decode($row['product_content'], true));
    $hien_thi_tinh_nang = json_decode($row['hien_thi_tinh_nang']);//var_dump($hien_thi_tinh_nang);
?>
<textarea name="tinh_nang_1" style="display: none"><?= $row['tinh_nang_1'] ?></textarea>
<textarea name="tinh_nang_2" style="display: none"><?= $row['tinh_nang_2'] ?></textarea>
<p class="titleRightNCP" style="color:red;">Ảnh tính năng:</p>
<p>chú ý: mỗi loại tính năng phải có tí nhất một thuộc tính</p>
            <?php if (empty($row['tinh_nang_1'])) { ?>
            <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP1 ckeditor1" id="editor2" name="product_sub_info1" style="display: none;"><?php echo $row['product_sub_info1'];?></textarea></p>
            <?php 
            $d = 0;
            foreach ($anh_tinh_nang as $item) { 
                $d++;
            ?>
                <?php if ($item == 'no-image.jpg' || empty($item)) { ?>
                    <div style="position: relative;display: inline-block;">
                        <img src="/images/logo/no-image.png" alt="" width="200" style="float: none;">
                        <span style="position: absolute;top: 10px;right: 10px;color: red;font-weight: bold;"><?= $d ?></span>
                        <?php if (empty($row['hien_thi_tinh_nang'])) { ?>
                        <select name="hien_thi_tinh_nang[]" >
                            <option value="1"  >Hiện</option>
                            <option value="0"  >Ẩn</option>
                        </select>
                        <?php } else { 
                            // $hien_thi_tinh_nang = json_decode($row['hien_thi_tinh_nang']);
                        ?>
                        <select name="hien_thi_tinh_nang[]" >
                            <option value="1"  >Hiện</option>
                            <option value="0" <?= $hien_thi_tinh_nang[$d]==0 ? 'selected' : '' ?> >Ẩn</option>
                        </select>
                        <?php } ?>
                    </div>
                <?php } else { ?>
                    <div style="position: relative;display: inline-block;">
                        <img src="<?= $item ?>" alt="" width="200" style="float: none;">
                        <span style="position: absolute;top: 10px;right: 10px;color: red;font-weight: bold;"><?= $d ?></span>
                        <?php if (empty($row['hien_thi_tinh_nang'])) { ?>
                        <select name="hien_thi_tinh_nang[]" >
                            <option value="1"  >Hiện</option>
                            <option value="0"  >Ẩn</option>
                        </select>
                        <?php } else { 
                            // var_dump($d);
                        ?>
                        <select name="hien_thi_tinh_nang[]" >
                            <option value="1"  >Hiện</option>
                            <option value="0" <?= $hien_thi_tinh_nang[$d-1]==0 ? 'selected' : '' ?> >Ẩn</option>
                        </select>
                        <?php } ?>
                    </div>
                
                <?php } ?>
            <?php } ?>
            <br style="clear: both;">
            <br style="clear: both;">
            <?php } else { 
                $tinh_nang_1_arr = json_decode($row['tinh_nang_2'], true);
                // var_dump($tinh_nang_1_arr);
                $k = -1;
                foreach ($tinh_nang_1_arr as $tinh_nang_1_loai) {
                    $k++;
                    echo $tinh_nang_1_loai['skuPropertyName'];
                    echo '<input type="hidden" name="tinh_nang_loai[]" value="'.$tinh_nang_1_loai['skuPropertyName'].'">';
                    // var_dump($tinh_nang_1_loai);
                    $d = 0;
                    foreach ($tinh_nang_1_loai['skuPropertyValues'] as $item) { 
                        $d++;
                        $ten_tinh_nang[$item['propertyValueId']] = $item['propertyValueDisplayName'];
            ?>
                <?php if (empty($item['skuPropertyImagePath'])) { ?>
                    <div style="position: relative;display: inline-block;">
                        <img src="/images/logo/no-image.png" alt="" width="200" style="float: none;">
                        <span style="position: absolute;top: 10px;right: 10px;color: red;font-weight: bold;"><?= $d ?></span>
                        <select name="show[<?= $k ?>][]">
                            <option value="1" >Hiện</option>
                            <option value="0" <?= $item['show']==='0' ? 'selected' : '' ?>>Ẩn</option>
                        </select>
                    </div>
                <?php } else { ?>
                    <div style="position: relative;display: inline-block;">
                        <img src="<?= $item['skuPropertyImagePath'] ?>" alt="" width="200" style="float: none;">
                        <span style="position: absolute;top: 10px;right: 10px;color: red;font-weight: bold;"><?= $d ?></span>
                        <select name="show[<?= $k ?>][]">
                            <option value="1" >Hiện</option>
                            <option value="0" <?= $item['show']==='0' ? 'selected' : '' ?> >Ẩn</option>
                        </select>
                    </div>
                    
                <?php } ?>

            <?php } ?>
                <br>
                <?php foreach ($tinh_nang_1_loai['skuPropertyValues'] as $item) { ?>
                    <input type="text" name="tinh_nang_ten[<?= $k ?>][]" value="<?= $item['propertyValueDisplayName'] ?>"><br>
                    <input type="hidden" name="tinh_nang_ma[<?= $k ?>][]" value="<?= $item['propertyValueId'] ?>">
                    <input type="hidden" name="tinh_nang_anh[<?= $k ?>][]" value="<?= $item['skuPropertyImagePath'] ?>">
                    <input type="hidden" name="doxe_anh[<?= $k ?>][]" value="<?= $item['doxe_anh'] ?>">
                <?php } ?>
            <br>
            <?php } ?>
            <?php } ?>