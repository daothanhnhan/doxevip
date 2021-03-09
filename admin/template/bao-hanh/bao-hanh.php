<?php
    $rows = $acc->getList("bao_hanh","","","id","desc",$trang, 20, "bao-hanh");//var_dump($rows);
?>	
    <div class="boxPageNews">
        <h1><a href="index.php?page=them-bao-hanh">Thêm</a></h1>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã bảo hành</th>
                    <th>Mã sản phẩm</th>
                    <th>Ngày mua</th>
                    <th>Số ngày bảo hành</th>
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
                            <td><?= $row['mabaohanh']?></td>
                            <td><?= $row['product_id']?></td>
                            <td><?= $row['date_start']?></td>
                            <td><?= $row['so_ngay']?></td>

                            <td style="float: none;"><a href="index.php?page=xoa-bao-hanh&id=<?= $row['id'] ?>" style="float: none;" onclick="return confirm('Bạn có chắc muốn xóa.')">Xóa</a> | <a href="index.php?page=sua-bao-hanh&id=<?= $row['id'] ?>" style="float: none;">Sửa</a></td>
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