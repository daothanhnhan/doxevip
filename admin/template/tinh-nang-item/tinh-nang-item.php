<?php
    $rows = $acc->getList("tinh_nang_item","tinh_nang_cat_id",$_GET['tinh_nang_cat_id'],"id","asc",$trang, 20, "tinh-nang-item");//var_dump($rows);
    $tinh_nang_cat = $action->getDetail('tinh_nang_cat', 'id', $_GET['tinh_nang_cat_id']);
?>	
    <div class="boxPageNews">
        <h1><a href="index.php?page=them-tinh-nang-item&tinh_nang_cat_id=<?= $_GET['tinh_nang_cat_id'] ?>">Thêm tính năng</a></h1>
        <h2 style="width: 100%;"><a href="index.php?page=tinh-nang-cat&product_id=<?= $tinh_nang_cat['product_id'] ?>" title="">Quay lại</a></h2>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên</th>
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
                            <td>
                                <img src="/images/tinh-nang/<?= $row['image'] ?>" width="100">
                            </td>
                            <td style="float: none;"><a href="index.php?page=xoa-tinh-nang-item&id=<?= $row['id'] ?>" style="float: none;" onclick="return confirm('Bạn có chắc muốn xóa.')">Xóa</a> | <a href="index.php?page=sua-tinh-nang-item&id=<?= $row['id'] ?>" style="float: none;">Sửa</a></td>
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