<?php
    $rows = $acc->getList("thuoc_tinh","","","id","asc",$trang, 20, "thuoc-tinh");//var_dump($rows);
?>	
    <div class="boxPageNews">
        <h1><a href="index.php?page=them-thuoc-tinh">Thêm tên thuộc tính</a></h1>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên thuộc tính</th>
                    <th>Hoạt động</th>
                    <th>Giá trị</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $d = 0;
                    foreach ($rows['data'] as $row) {
                        $d++;
                    ?>
                        <tr>
                            <td><?= $d ?></td>
                            <td><?= $row['name']?></td>

                            <td style="float: none;"><a href="index.php?page=xoa-thuoc-tinh&id=<?= $row['id'] ?>" style="float: none;" onclick="return confirm('Bạn có chắc muốn xóa.')">Xóa</a> | <a href="index.php?page=sua-thuoc-tinh&id=<?= $row['id'] ?>" style="float: none;">Sửa</a></td>
                            <td style="float: none;"><a href="index.php?page=thuoc-tinh-value&thuoc_tinh_id=<?= $row['id'] ?>" style="float: none;">Giá trị</a></td>
                        </tr>
                    <?php
                    }
                ?>
            </tbody>
        </table>
    	
        <div class="paging">             
        	<?= $rows['paging'] ?>
		</div>
    </div>
    <p class="footerWeb">Cảm ơn quý khách hàng đã tin dùng dịch vụ của chúng tôi<br />Sản phẩm thuộc Công ty TNHH Truyền Thông Và Công Nghệ Cafelink Việt Nam</p>             