<?php

    $products = $cart->getCart();

    $totalPrice = 0;

    if(isset($_SESSION['user_id_gbvn'])){

        global $conn_vn;

        $user = $_SESSION['user_id_gbvn'];

        $sql = "SELECT * FROM user Where user_id = '$user'";

        $result = mysqli_query($conn_vn, $sql);

        $row = mysqli_fetch_assoc($result);

    }
// var_dump($_SESSION['shopping_cart']);
?>

<?php 

if (isset($_POST['send_mail'])){

    $email = $_POST['txtEmail'];

    $name = $_POST['txtName'];

    $phone = $_POST['txtPhone'];

    $address = $_POST['txtAddress'];

    $infor_cart = "";

    if(isset($_SESSION['shopping_cart'])){

        $total = 0;

        foreach($_SESSION["shopping_cart"] as $keys => $values){

            $name_product = $values['product_name'];

            $qty = $values['product_quantity'];

            $product_price = $values['product_price'];

            $total = $total + ($values["product_quantity"] * $values["product_price"]);

            $infor_cart .= "

                <tr>

                    <th>".$name_product."</th>

                    <th>".number_format($product_price)." VNĐ x ".$qty."</th>

                </tr>

            ";

        }

        $infor_cart1 = "

            <tr>

                <th>Tổng tiền</th>

                <th>".number_format($total)." VNĐ</th>

            </tr>

        ";

    }

    $content = "

    <div class='container'>

        <h2>Thông Tin Đơn Hàng</h2>

        <table class='table table-bordered' border='1'>

            <thead>

                <tr>

                    <th>Tên người đặt hàng</th>

                    <th>".$name."</th>

                </tr>

            </thead>

            <tbody>

                <tr>

                    <td>Số điện thoại</td>

                    <td>".$phone."</td>

                </tr>

                <tr>

                    <td>Email</td>

                    <td>".$email."</td>

                </tr>

                <tr>

                    <td>Địa chỉ</td>

                    <td>".$address."</td>

                </tr>

            </tbody>

        </table>

        <h2>Chi tiết Đơn Hàng</h2>

        <table class='table table-bordered' border='1'>

            <thead>

                <tr>

                    <th>Tên sản phẩm</th>

                    <th>Giá</th>

                </tr>

            </thead>

            <tbody>

                ".$infor_cart."

                ".$infor_cart1."

            </tbody>

        </table>

    </div>

    ";

    $cart->payment1();

    $mail = new action_email();

    // $gui_mail = $mail->email_send($email, "Thông Tin Đặt Hàng Từ Đại Nghĩa",$content);

?>



    <script type="text/javascript">

        // alert('Đặt hàng thành công');

        window.location.href="/thong-ke";

    </script>

<?php } ?>
<div class="uni-cart">

    <div id="wrapper-container" class="site-wrapper-container">

        <div id="main-content" class="site-main-content">

            <div class="site-content-area">

                <main id="main" class="site-main">



                    <?php include DIR_BREADCRUMBS."MS_BREADCRUMS_MPTOTO_0001.php";?>

                    <div class="container">
                      
                    </div>
                    

                    <div class="uni-cart-body">

                        <div id="post" class="container">

                            <div style="margin-top: 40px;" class="entry-content">

                                <p><a href="/san-pham" title="" style="">< Mua thêm sản phẩm khác</a></p>

                                <div class="woocommerce">

                                    <div class="table-responsive" id="order_table" style="width: 100%;">  

                                       <table class="table table-bordered hidden-xs hidden-sm" style="">  

                                            <tr>  

                                                 <th width="10%">Ảnh</th>  

                                                 <th width="40%">Tên sản phẩm</th>  

                                                 <!-- <th width="10%">Đổi sản phẩm</th>   -->

                                                 <th width="10%">Số lượng</th>  

                                                 <th width="20%">Giá</th>  

                                                 <th width="15%">Tổng tiền</th>  

                                                 <th width="5%">Action</th>  

                                            </tr>  

                                            <?php  

                                            if(!empty($_SESSION["shopping_cart"]))  

                                            {  

                                                 $total = 0;  
                                                 $d1 = -1;
                                                 foreach($_SESSION["shopping_cart"] as $keys => $values)  
                                                   
                                                 {                                               
                                                    $d1++;
                                            ?>  

                                            <tr>  

                                                 <td><img src="<?php echo $values["product_link"]; ?>" alt="" width="50"></td>  
                                                 <td><?php echo $values["product_name"]; ?></td>  

                                                 <!-- <td><span class="btn btn-warning" onclick="doi_sp(<?= $values["product_id"] ?>)">Đổi sản phẩm</span></td> -->

                                                 <td><input type="text" name="quantity[]" id="quantity<?php echo $values["product_id"]; ?>" value="<?php echo $values["product_quantity"]; ?>" data-product_id="<?php echo $values["product_id"]; ?>" class="form-control quantity" /></td>  

                                                 <td align="right"><?php echo number_format($values["product_price"]); ?> VNĐ</td>  

                                                 <td align="right"><?php echo number_format($values["product_quantity"] * $values["product_price"], 2); ?> VNĐ</td>  

                                                 <td><button name="delete" class="btn btn-danger btn-xs delete" id="<?php echo $values["product_id"]; ?>" style="margin: 0px;">Xóa sản phẩm</button></td>  

                                            </tr>  

                                            <?php  

                                                $total = $total + ($values["product_quantity"] * $values["product_price"]);



                                                } 

                                                 $_SESSION['total'] = $total; 

                                            ?>  

                                            <tr>  

                                                 <td colspan="4" align="right">Total</td>  

                                                 <td align="right"><?php echo number_format($total, 2); ?> VNĐ</td>  

                                                 <td><a href="/" class="btn btn-warning">Thêm sản phẩm</a></td>  

                                            </tr>  

                                            <!-- <tr>  

                                                 <td colspan="6" align="center">  

                                                      <form method="post" action="/thanh-toan">  

                                                           <input type="submit" name="place_order" class="btn btn-warning" value="Thanh toán" style="width: 15%;" />  

                                                      </form>  

                                                 </td>  
                                                  
                                                 

                                            </tr>   -->

                                            <?php  

                                            }  

                                            ?>  

                                       </table>  

                                       <?php include DIR_CART . "MS_CART_MPTOTO_0008.php"; ?>

                                       <p><i>Ghi chú: Giá về kho tại Hà Nội chưa bao gồm phí Ship</i></p>
                                  </div>   

                                 <!-- <a  class="btn btn-warning" style="float: right;" onclick="bao_gia()"><p>In báo giá</p></a> -->

                                </div>

                            </div>

                        </div>

                    </div>

                </main>



            </div>

        </div>

    </div>

</div>

<?php include DIR_CART . "MS_CART_MPTOTO_0009.php"; ?>

<div class="container">
  <p><a href="/san-pham" title="" style="">< Mua thêm sản phẩm khác</a></p>
</div>

<script>  

 $(document).ready(function(data){  

      $('.add_to_cart').click(function(){  

           var product_id = $(this).attr("id");  

           var product_name = $('#name'+product_id).val();  

           var product_price = $('#price'+product_id).val();  

           var product_quantity = $('#quantity'+product_id).val();  

           var action = "add";  

           if(product_quantity > 0)  

           {  

                $.ajax({  

                     url:"../functions/action_cart_tmp.php",  

                     method:"POST",  

                     dataType:"json",  

                     data:{  

                          product_id:product_id,   

                          product_name:product_name,   

                          product_price:product_price,   

                          product_quantity:product_quantity,   

                          action:action  

                     },  

                     success:function(data)  

                     {  

                          $('#order_table').html(data.order_table);  

                          $('.badge').text(data.cart_item);  

                          alert("Product has been Added into Cart");  

                     }  

                });  

           }  

           else  

           {  

                alert("Please Enter Number of Quantity")  

           }  

      });  

      $(document).on('click', '.delete', function(){  

           var product_id = $(this).attr("id");  

           var action = "remove";  

           if(confirm("Are you sure you want to remove this product?"))  

           {  

                $.ajax({  

                     url:"../functions/action_cart_tmp.php",  

                     method:"POST",  

                     dataType:"json",  

                     data:{product_id:product_id, action:action},  

                     success:function(data){  

                          $('#order_table').html(data.order_table);  

                          $('.badge').text(data.cart_item);

                          // alert(data.order_table);

                          // alert('success');

                     },

                     error:function(){

                        alert('loi.');

                     }  

                });  





           }  

           else  

           {  

                return false;  

           }  

      });  

      $(document).on('keyup', '.quantity', function(){  

           var product_id = $(this).data("product_id");  

           var quantity = $(this).val();  

           var action = "quantity_change";  

           if(quantity != '')  

           {  

                $.ajax({  

                     url :"../functions/action_cart_tmp.php",  

                     method:"POST",  

                     dataType:"json",  

                     data:{product_id:product_id, quantity:quantity, action:action},  

                     success:function(data){  

                          $('#order_table').html(data.order_table);  

                     }  

                });  





           }  

      });  

 });  

 </script>

 <script type="text/javascript">



  function bao_gia () {



    // alert(id);



    var link = '/bao-gia/cart.php';



    window.open(link, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=500,width=1000,height=400");



  }



</script>

<script>
  function doi_sp (pro_id) {
    // alert(pro_id);
    var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
       // document.getElementById("demo").innerHTML = this.responseText;
          var link = this.responseText;
          // alert(link);
         window.location.href = link;
      }
    };
    xhttp.open("GET", "/functions/ajax/doi_sp.php?id="+pro_id, true);
    xhttp.send();
  }

</script>

<script>
  function soluong_mb (so, id) {
    // alert(so+id);

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
       document.getElementById("cart_mb").innerHTML = this.responseText;
        // alert('aas');
      }
    };
    xhttp.open("GET", "/functions/ajax1/soluong_mb.php?id="+id+"&so="+so, true);
    xhttp.send();

  }

  function xoa_mb (id) {
    // alert(so+id);

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
       document.getElementById("cart_mb").innerHTML = this.responseText;
        // alert('aas');
      }
    };
    xhttp.open("GET", "/functions/ajax1/xoa_mb.php?id="+id, true);
    xhttp.send();

  }
</script>