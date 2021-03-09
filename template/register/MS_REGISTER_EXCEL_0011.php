<?php
    function bao_hanh () {
        global $conn_vn;
        if (isset($_POST['tim'])) {
            $code = $_POST['code'];
            $sql = "SELECT * FROM bao_hanh WHERE mabaohanh = '$code'";
            $result = mysqli_query($conn_vn, $sql);
            $num = mysqli_num_rows($result);
            $rows = array();
            if ($num > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $rows[] = $row;
                }
            }
            return $rows;
        }
    }
    $baohanh = bao_hanh();
?>
<div class="gb-register1">
     <h1 class="title-khoahoc"><i class="fa fa-bookmark" aria-hidden="true"></i> Thông tin bảo hành</h1>
    <form action="" method="post">
        <div class="form-group">
            <label>Nhập mã bảo hành:</label>
            <input type="number" class="form-control" name="code" placeholder="Nhập mã bảo hành - số điện thoại" value="" required>
        </div>
        
        <div class="form-group">
            <button type="submit" name="tim" class="btn btn-success" style="background: #da251c;">Tìm</button>
            <!-- <a href="/thong-tin-ca-nhan" class="btn btn-danger" role="button">Hủy</a> -->
        </div>
    </form>
    <table class="table table-striped">
    <thead>
      <tr>
        <th>Mã bảo hành</th>
        <th>Sản phẩm</th>
        <th>Ngày mua</th>
        <th>Hết bảo hành</th>
      </tr>
    </thead>
    <tbody>
    <?php 
    foreach ($baohanh as $item) { 
        $product = $action->getDetail('product', 'product_id', $item['product_id']);
        $start = strtotime($item['date_start']);
        $so = $item['so_ngay'] * 86400;
        $end = $start + $so;
    ?>
      <tr>
        <td><?= $item['mabaohanh'] ?></td>
        <td><?= $product['product_name'] ?></td>
        <td><?= date('d-m-Y', strtotime($item['date_start'])); ?></td>
        <td><?= date('d-m-Y', $end); ?></td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
</div>
<style type="text/css" media="screen">
	.gb-register1 label{padding-bottom: 10px;}
    .title-khoahoc{
        font-size: 18px;
        text-transform: uppercase;
        padding-bottom: 15px;
        color: #da251c;
    }
    .ten-khoahoc{color: #207244;}
</style>