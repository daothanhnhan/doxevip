<?php
    $rows = $acc->getList("tinh_nang_cat","product_id",$_GET['product_id'],"id","asc",$trang, 20, "tinh-nang-cat");//var_dump($rows);
?>	
    <div class="boxPageNews">
        <h1><a href="index.php?page=them-tinh-nang-cat&product_id=<?= $_GET['product_id'] ?>">Thêm loại tính năng</a></h1>
        <h2 style="width: 100%;"><a href="index.php?page=sua-san-pham&id=<?= $_GET['product_id'] ?>" title="">Quay lại</a></h2>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên Loại tính năng</th>
                    <!-- <th>Ảnh</th> -->
                    <th>Hoạt động</th>
                    <th>Tính năng con</th>
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
                            <!-- <td>
                                <img src="/images/<?= $row['image'] ?>" width="100">
                            </td> -->
                            <td style="float: none;"><a href="index.php?page=xoa-tinh-nang-cat&id=<?= $row['id'] ?>" style="float: none;" onclick="return confirm('Bạn có chắc muốn xóa.')">Xóa</a> | <a href="index.php?page=sua-tinh-nang-cat&id=<?= $row['id'] ?>" style="float: none;">Sửa</a></td>
                            <td><a href="index.php?page=tinh-nang-item&tinh_nang_cat_id=<?= $row['id'] ?>" title="">Tính năng</a></td>
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