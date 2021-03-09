<?php
    $rows = $acc->getList("code_sale","","","id","asc",$trang, 20, "ma-khuyen-mai");//var_dump($rows);
?>	
    <div class="boxPageNews">
        <h1><a href="index.php?page=them-ma-khuyen-mai">Thêm</a></h1>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã</th>
                    <th>Chiêt khấu</th>
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
                            <td><?= $row['code']?></td>
                            <td>
                                <?= number_format($row['money']) ?>
                            </td>
                            <td style="float: none;"><a href="index.php?page=xoa-ma-khuyen-mai&id=<?= $row['id'] ?>" style="float: none;" onclick="return confirm('Bạn có chắc muốn xóa.')">Xóa</a> | <a href="index.php?page=sua-ma-khuyen-mai&id=<?= $row['id'] ?>" style="float: none;">Sửa</a></td>
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