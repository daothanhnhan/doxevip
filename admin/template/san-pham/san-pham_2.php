<?php
    $product_all = $kiotviet->all_product($trang, 20);//var_dump($product_all);
    $total = $product_all['total'];
?>	
<div class="boxPageNews">
	<div class="searchBox">
        <form action="">
            <input type="hidden" name="page" value="san-pham-1">
            <button type="submit" class="btnSearchBox" name="">Tìm kiếm</button>
            <input type="text" class="txtSearchBox" name="search" />                                  
        </form>
    </div>
    <table class="table table-condensed table-hover">
        <thead>
            <tr>
                <th>Tên</th>
                <th>Danh mục</th>
                <th>Giá</th>
                <th>Trạng thái</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach ($product_all['data'] as $key => $row) {
                    $trang_thai = $kiotviet->check_has_product($row['id']);
                    if ($trang_thai == false) {
                        $link = "index.php?page=them-san-pham&id_kv=".$row['id'];
                    } else {
                        $link = "index.php?page=sua-san-pham&id=".$trang_thai;
                    }
                ?>
                    <tr>
                        <td><a href="<?= $link; ?>" title=""><?= $row['name']; ?></a></td>
                        <td>
                            <?php //echo $kiotviet->get_detail_procat($row['categoryId'])['categoryName'] ?>
                            <?= $row['categoryName'] ?>
                        </td>
                        <td><?= number_format($row['basePrice'],'0','','.')?> đ</td>
                        <td><?= $trang_thai == false ? 'Chưa' : 'Rồi'?></td>
                    </tr>
                <?php
                }
            ?>
        </tbody>
    </table>
	
    <div class="paging">             
    	<?= $kiotviet->paging($total, $trang, 20, 'san-pham') ?>
	</div>
</div>
<?php  ?>
