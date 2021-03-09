<?php 
  $tai_khoan = $action->getDetail('page', 'page_id', '72');
  // var_dump($_SESSION['thong_ke']);
?>
<div class="uni-cart">
    <div id="wrapper-container" class="site-wrapper-container">
        <div id="main-content" class="site-main-content">
            <div class="site-content-area">
                <main id="main" class="site-main">

                    <?php include DIR_BREADCRUMBS."MS_BREADCRUMS_MPTOTO_0001.php";?>
                    <h1 style="text-align: center;font-size: 30px;text-transform: uppercase;">Đặt hàng thành công</h1>
                    <p style="text-align: center;">Cám ơn <b><?= $_SESSION['buyer_cart']['name'] ?></b> đã cho Độ Xe Vip cơ hội được phục vụ. Trong 15 phút, nhân viên Độ Xe Vip sẽ <b>Gọi điện hoặc gửi tin nhắn xác nhận giao hàng</b> cho bạn</p>
                    <div class="uni-cart-body">
                        <div id="post" class="container">
                            <div style="margin-top: 40px;" class="entry-content">
                              <p>Đơn hàng: #<?= $_SESSION['cart_id'] ?></p>
                                <div class="woocommerce">
                                    <div class="table-responsive" id="order_table" style="width: 100%;">  
                                       <table class="table table-bordered" style="margin-bottom: 100px;">  
                                            <tr>  
                                                 <th width="5%">STT</th>    
                                                 <th width="40%">Tên sản phẩm</th>  
                                                 <th width="10%">Số lượng</th>  
                                                 <th width="20%">Giá</th>  
                                                 <th width="15%">Tổng tiền</th>  
                                                   
                                            </tr>  
                                            <?php  
                                            if(!empty($_SESSION["thong_ke"]))  
                                            {  
                                                 $total = 0;  
                                                 $d = 0;
                                                 foreach($_SESSION["thong_ke"] as $keys => $values)  
                                                 {                                               
                                                  $d++;
                                            ?>  
                                            <tr>  
                                                 <td><?php echo $d; ?></td>  
                                                 <td><?php echo $values["product_name"]; ?></td>  
                                                 <td><?php echo $values["product_quantity"]; ?></td>  
                                                 <td align="right"><?php echo number_format($values["product_price"]); ?> VNĐ</td>  
                                                 <td align="right"><?php echo number_format($values["product_quantity"] * $values["product_price"], 2); ?> VNĐ</td>  
                                                   
                                            </tr>  
                                            <?php  
                                                $total = $total + ($values["product_quantity"] * $values["product_price"]);

                                                } 
                                                 $_SESSION['total'] = $total; 
                                            ?>  
                                            <tr>  
                                                 <td colspan="4" align="right">Total</td>  
                                                 <td align="right"><?php echo number_format($total, 2); ?> VNĐ</td>  
                                                  
                                            </tr>  
                                             
                                            <?php  
                                            }  
                                            ?>  
                                       </table>  
                                  </div>   
                                </div>
                            </div>
                            <p>Thông tin khách hàng</p>
                            <br>
                            <p>Anh/Chị: <?= $_SESSION['buyer_cart']['name'] ?></p>
                            <p>Số điện thoại: <?= $_SESSION['buyer_cart']['phone'] ?></p>
                            <p>Email: <?= $_SESSION['buyer_cart']['email'] ?></p>
                            <p>Địa chỉ: <?= $_SESSION['buyer_cart']['address'] ?></p>
                            <p>Ghi chú: <?= $_SESSION['buyer_cart']['note'] ?></p>
                            <br>
                            <p>Thông tin chuyển khoản: </p>
                            <div>
                              <?= $tai_khoan['page_content'] ?>                              
                            </div>
                            <p><i>Bộ Phận CSKH của Độ Xe Vip sẽ gọi điện hướng dẫn anh chị thanh toán và xác nhận đặt hàng</i></p>
                        </div>
                    </div>
                </main>

            </div>
        </div>
    </div>
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