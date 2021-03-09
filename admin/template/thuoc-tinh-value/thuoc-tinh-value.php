<?php
    $rows = $acc->getList("thuoc_tinh_value","thuoc_tinh_id",$_GET['thuoc_tinh_id'],"id","asc",$trang, 20, "thuoc-tinh-value");//var_dump($rows);
?>	
    <div class="boxPageNews">
        <h1><a href="index.php?page=them-thuoc-tinh-value&thuoc_tinh_id=<?= $_GET['thuoc_tinh_id'] ?>">Thêm giá trị thuộc tính</a></h1>
        <p style="clear: both;"><a href="index.php?page=thuoc-tinh">Quay lại</a></p>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Giá trị thuộc tính</th>
                    <th>Hoạt động</th>
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

                            <td style="float: none;"><a href="index.php?page=xoa-thuoc-tinh-value&thuoc_tinh_id=<?= $_GET['thuoc_tinh_id'] ?>&id=<?= $row['id'] ?>" style="float: none;" onclick="return confirm('Bạn có chắc muốn xóa.')">Xóa</a> | <a href="index.php?page=sua-thuoc-tinh-value&thuoc_tinh_id=<?= $_GET['thuoc_tinh_id'] ?>&id=<?= $row['id'] ?>" style="float: none;">Sửa</a></td>
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