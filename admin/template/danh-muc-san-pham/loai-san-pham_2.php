<?php
    $all_procat = $kiotviet->get_all_procat();//var_dump($all_procat);
    // echo count($all_procat);
    $list_procat1 = $kiotviet->get_procat_list($all_procat, null);
    
?>
    <div class="boxPageContent">
        <div class="searchBox">
            <form action="">
                <input type="hidden" name="page" value="danh-muc-san-pham-1">
                <button type="submit" class="btnSearchBox" >Tìm kiếm</button>
                <input type="text" class="txtSearchBox" name="search" />                                    
            </form>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Tiêu đề</th>
                    <th>Người tạo</th>
                    <th>Sắp xếp</th>
                    <th>Hiển thị</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach ($list_procat1 as $item_1) { 
                    $list_procat2 = $kiotviet->get_procat_list($all_procat, $item_1['categoryId']);
                    $trang_thai = $kiotviet->check_has_procat($item_1['categoryId']);
                    if ($trang_thai == false) {
                        $link = "index.php?page=them-danh-muc-san-pham&id_kv=".$item_1['categoryId'];
                    } else {
                        $link = "index.php?page=sua-danh-muc-san-pham&id=".$trang_thai;
                    }
                    $sort_1 = $action->getDetail('productcat', 'productcat_id', $trang_thai);
                ?>
                <tr>
                    <th><a href="<?= $link ?>"><?= $item_1['categoryName'] ?></a></th>
                    <th>Người tạo</th>
                    <th><?= $sort_1['productcat_sort_order'] ?></th>
                    <th><?= $sort_1['state']==1 ? 'Có' : 'Không' ?></th>
                    <th><?= $trang_thai==false ? "Chưa" : "Rồi" ?></th>
                </tr>
                    <?php 
                    foreach ($list_procat2 as $item_2) {
                        $list_procat3 = $kiotviet->get_procat_list($all_procat, $item_2['categoryId']);
                        $trang_thai = $kiotviet->check_has_procat($item_2['categoryId']);
                        if ($trang_thai == false) {
                            $link = "index.php?page=them-danh-muc-san-pham&id_kv=".$item_2['categoryId'];
                        } else {
                            $link = "index.php?page=sua-danh-muc-san-pham&id=".$trang_thai;
                        }
                        $sort_2 = $action->getDetail('productcat', 'productcat_id', $trang_thai);
                    ?>
                    <tr>
                        <th><a href="<?= $link ?>" style="padding-left: 20px;"><?= $item_2['categoryName'] ?></a></th>
                        <th>Người tạo</th>
                        <th><?= $sort_2['productcat_sort_order'] ?></th>
                        <th><?= $sort_2['state']==1 ? 'Có' : 'Không' ?></th>
                        <th><?= $trang_thai==false ? "Chưa" : "Rồi" ?></th>
                    </tr>
                        <?php 
                        foreach ($list_procat3 as $item_3) { 
                            $trang_thai = $kiotviet->check_has_procat($item_3['categoryId']);
                            if ($trang_thai == false) {
                                $link = "index.php?page=them-danh-muc-san-pham&id_kv=".$item_3['categoryId'];
                            } else {
                                $link = "index.php?page=sua-danh-muc-san-pham&id=".$trang_thai;
                            }
                            $sort_3 = $action->getDetail('productcat', 'productcat_id', $trang_thai);
                        ?>
                        <tr>
                            <th><a href="<?= $link ?>" style="padding-left: 40px;"><?= $item_3['categoryName'] ?></a></th>
                            <th>Người tạo</th>
                            <th><?= $sort_3['productcat_sort_order'] ?></th>
                            <th><?= $sort_3['state']==1 ? 'Có' : 'Không' ?></th>
                            <th><?= $trang_thai==false ? "Chưa" : "Rồi" ?></th>
                        </tr>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>

        <div class="paging"><?= $rows['paging']?></div>
    </div>
    <p class="footerWeb">Cảm ơn quý khách hàng đã tin dùng dịch vụ của chúng tôi<br />Sản phẩm thuộc Công ty TNHH Truyền Thông Và Công Nghệ GoldBridge Việt Nam</p>