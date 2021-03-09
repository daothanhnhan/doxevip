<?php
    $rows = $acc->getList("sale_cat","","","id","asc",$trang, 20, "danh-muc-khuyen-mai");//var_dump($rows);
?>	
    <div class="boxPageNews">
        <h1><a href="index.php?page=them-danh-muc-khuyen-mai">Thêm danh mục khuyến mãi</a></h1>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên</th>
                    <th>Link</th>
                    <th>Ảnh</th>
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
                            <td><?= $row['link']?></td>
                            <td>
                                <img src="/images/<?= $row['image'] ?>" width="100">
                            </td>
                            <td style="float: none;"><a href="index.php?page=xoa-danh-muc-khuyen-mai&id=<?= $row['id'] ?>" style="float: none;" onclick="return confirm('Bạn có chắc muốn xóa.')">Xóa</a> | <a href="index.php?page=sua-danh-muc-khuyen-mai&id=<?= $row['id'] ?>" style="float: none;">Sửa</a> | <a href="index.php?page=khuyen-mai&sale_cat_id=<?= $row['id'] ?>" title="" style="float: none;">Khuyến mãi</a></td>
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