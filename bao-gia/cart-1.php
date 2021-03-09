<?php 

  session_start();

  include_once dirname(__FILE__) . "/../functions/database.php";

  include_once dirname(__FILE__) . "/../functions/library.php";

  include_once dirname(__FILE__) . "/../functions/action.php";

  $action = new action();



  $id = $_GET['id'];

  $cart = $action->getDetail('cart', 'id_cart', $id);//var_dump($cart);
  $cart_detail = $action->getList('cartdetail', 'id_cart', $id, 'id_cartDetail', 'asc', '', '', '');//var_dump($cart_detail);

?>

<!DOCTYPE html>

<html lang="en">

<head>

  <title>Báo giá</title>

  <meta charset="utf-8">

  <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="/bao-gia/baogia.css">

</head>

<body>
  <div class="header">
    <div class="container-fluid" style="background-image: url(/bao-gia/abcd2.jpg);">
      <div class="row">
        <div class="col-md-4">
        <img src="/images/1808cf3895296c773538 (1).png">
      </div>
      <div class="col-md-8">
        <ul>
          <li class="main">CÔNG TY TNHH ÂM THANH VIỆT NAM</li>
          <li class="main1">Địa chỉ: Showroom 209/29 Tôn Thất Thuyết, Phường 3, Quận 4, Thành phố Hồ Chí Minh.</li>
          <li class="main1">Hotline: 0987.833.140</li>
          <li class="main1">Email: duy.artsound@gmail.com</li>
        </ul>

        
      </div>
      </div>
      
  
    </div>
    
  </div>


<div class="mainmain">
  <div class="container-fluid">
    <p style="margin-bottom: 0;"><b>Kính gửi:</b> <?= $cart['name_buyer'] ?></p>
    <p style="margin-bottom: 0;"><b>Địa chỉ:</b> <?= $cart['address_buyer'] ?></p>
    <p style="margin-bottom: 0;"><b>Fax/Tel:</b> <?= $cart['phone_buyer'] ?></p>
    <p style="margin-bottom: 0;"><b>Mail:</b> <?= $cart['mail_buyer'] ?></p>
  <h2>Báo giá sản phẩm</h2>

  <p style="text-align: right;">Ngày phát hành báo giá: <?= date("d-m-Y"); ?></p>
  <p>Chúng tôi trân trọng gửi đến Quý khách hàng bảng báo giá thiết bị theo yêu cầu sau.</p>


  <table class="table table-striped">

    <thead>

      <tr>

        <th style="vertical-align: middle;">STT</th>

        <th style="vertical-align: middle;">Hình ảnh</th>

        <th style="vertical-align: middle;">Tên sản phẩm</th>

        <th style="vertical-align: middle;">Thông số kỹ thuật</th>

         <th style="vertical-align: middle;">Nhãn hiệu<br>(Xuất xứ)</th>

        <!-- <th>Bảo hành</th> -->

        <th style="vertical-align: middle;">Số lượng</th>

        <th style="vertical-align: middle;">Đơn giá (VNĐ)</th>

        <th style="vertical-align: middle;">Tổng (VNĐ)</th>

      </tr>

    </thead>

    <tbody>
      <?php  
      if(true)  
      {  
           $total = 0;  
           $d = 0;
           foreach($cart_detail as $keys => $values)  
           {                                               
            $d++;
            $product = $action->getDetail('product', 'product_id', $values['id_product']);
      ?>

      <tr>

        <td style="vertical-align: middle;"><?= $d ?></td>

        <td style="vertical-align: middle;"><img src="/images/<?= $product['product_img'] ?>" alt="" style="width: 100px;"></td>

        <td style="vertical-align: middle;"><?= $product['product_name'] ?></td>
        <td><?= str_replace("\r\n", "<br>", $values['subInfo1']) ?></td>

        <td style="vertical-align: middle;"><?= $product['product_expiration'] ?></td>

        

        <td style="vertical-align: middle;"><?= $values['qyt_product'] ?></td>

        <td style="vertical-align: middle;"><?= number_format($values['price_product']) ?></td>

        <td style="vertical-align: middle;"><?= number_format($values['price_product'] * $values["qyt_product"]) ?></td>

      </tr>
      <?php  
          $total = $total + ($values["qyt_product"] * $values["price_product"]);

          } 
           $_SESSION['total'] = $total; 
           $vat = $total * 0.1;
           $ttt = $total + $vat;
      ?>
      <tr>  
           <td colspan="7" align="right">Tổng cộng (VNĐ)</td>  
           <td align="right"><?php echo number_format($total); ?></td>    
      </tr>
      <tr>  
           <td colspan="7" align="right">Thuế VAT 10%</td>  
           <td align="right"><?php echo number_format($vat); ?></td>    
      </tr>
      <tr>  
           <td colspan="7" align="right">Tổng thanh toán (VNĐ)</td>  
           <td align="right"><?php echo number_format($ttt); ?></td>    
      </tr>
      <?php  
      }  
      ?>

    </tbody>

  </table>
  <div class="dieukhoan">
  <h6>ĐIỀU KHOẢN THƯƠNG MẠI</h6>
    <ul>
      <!-- <li>Đơn giá trên chưa bao gồm VAT 10%.</li> -->
      <li>Hình thức thanh toán tiên mặt hoặc chuyển khoản ngay khi xác nhận đơn hàng.</li>
      <li>Thời gian bảo hành theo quy định của sản xuất.</li>
      <li>Báo giá có giá trị 10 ngày, kể từ ngày phát hành báo giá.</li>
    </ul>
    
  </div>
  <div class="thongtin">
    <h6>THÔNG TIN TÀI KHOẢN NGÂN HÀNG </br>CÔNG TY TNHH ÂM THANH VIỆT NAM</h6>
    <p>SỐ TÀI KHOẢN CÁ NHÂN</p>

    LƯƠNG XUÂN DUY<br>

    Tài Khoản : 237750049<br>

    Ngân Hàng ACB Chi Nhánh Sài Gòn<br><br>

    <p>SỐ TÀI KHOẢN CÔNG TY</p>

    CÔNG TY TNHH ÂM THANH VIỆT NAM<br>

    Tài khoản: 060186373718<br>

    Ngân Hàng Sacombank -Chi Nhánh Quận 4
  </div>

</div>
  
</div>




</body>

</html>

