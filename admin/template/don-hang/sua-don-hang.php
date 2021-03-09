<?php
if ($acc->checkMod()) {
    $acc->redirect("index.php");
}
if(isset($_GET['id_cart'])){
    $id = $_GET['id_cart'];
}else{
    header("location:index.php?page=don-hang");
}
?>
<form id="updateOrder">
    <input type="hidden" id="parent_id" name="id_cart" value="<?php echo $id;?>"/>
    <input type="hidden" name="action" value="updateOrder">
    <?php

    $order = new action_order();
    $rowOrder = $order->getOrderDetail($id);
    $listOrderDetail =  $order->getlistOrderDetailByCartId($rowOrder['id_cart']);
    $orderStates = $order->getOrderState();
    ?>

    <script type="text/javascript">
        !function ($, window, document, _undefined){

            $('#updateOrder').on('click', '.deleteDetailID', function (e) {
                e.preventDefault()
                if (window.confirm('Bạn chuẩn bị xóa chi tiết đơn hàng, nếu trong đơn hàng chỉ có 1 sản phẩm thì sẽ xóa toàn bộ đơn hàng.\nBấm "OK" để tiếp tục, "Hủy" để dừng lại.')) {
                    var select = $(this), cart_id = select.closest('form').find('#parent_id').val(),
                        detail_id = select.data('id'),
                        submit = function () {
                            $.post('ajax.php', {
                                cart_id: cart_id,
                                detail_id: detail_id,
                                action: 'deleteOrderDetail'
                            }).done(function (data) {
                                console.log(data);
                                alert(data['status_text']);
                                if('true' == data['redirect']) {
                                    window.location.href = "/admin/index.php?page=don-hang";
                                } else {
                                    window.location.reload();
                                }
                            }).fail(function (t) {
                                alert('Lỗi, bạn vui lòng thử lại sau');
                                console.table(t);
                            });
                        };
                    return submit();
                }
                return false;
            });

        }(jQuery, this, document)


    </script>
<style>
    #subinfo1::after {
        content: "";
    }
</style>
    <div class="rowNodeContentPage">
        <div class="coverContentPage">
            <div class="row">
                <div class="contentPage">
                    <div class="box1">
                        <h2>Chi tiết đơn hàng số #<?php echo $rowOrder['id_cart'];?></h2>
                        <h3><?php echo $rowOrder['name_orderState'];?></h3>
                        <ul class="list_item_order">
                            <?php
                            $totalprice = 0;
                            foreach ($listOrderDetail as $rowOrderDetail) {
                                // $product_kv = $kiotviet->get_product_gb_kv($rowOrderDetail['product_id']);
                                // if ($product_kv['images']) {
                                //     $rowOrderDetail['product_img'] = $product_kv['images'][0];
                                // }
                                ?>
                                <li class="item_order">
                                        <span class="item_image">
                                            <img src="/images/<?php echo $rowOrderDetail['product_img'];?>" alt="">
                                        </span>
                                    <span class="item_name">
                                            <a href="index.php?page=sua-san-pham&id=<?php echo $rowOrderDetail['product_id'];?>"><?php echo $rowOrderDetail['product_name'] ;?></a>
                                        </span>
                                        <span class=" item_name" style="width: 60px;cursor: pointer;" onclick="doi_don(<?= $rowOrderDetail['id_cartDetail'] ?>)">
                                            Đổi
                                        </span>
                                    <span class="item_price">
                                            
                                        <input type="text" name="price_product[<?= $rowOrderDetail['id_cartDetail'] ?>]" onkeyup="money(this)" id="price_product<?= $rowOrderDetail['id_cartDetail'] ?>" value="<?php echo number_format($rowOrderDetail['price_product'],"0",".",",");?>" style="width: 75px;">
                                        </span>
                                    <span class="countwidth">x</span>
                                    <span class="item_quantity">
                                        <input type="number" style="width: 30px;" name="qyt_product[<?= $rowOrderDetail['id_cartDetail'] ?>]" value="<?= $rowOrderDetail['qyt_product'] ?>">
                                    </span>
                                    <span class="item_price" id="subinfo1">
                                            
                                        <!-- <input type="text" name="" value="" style="width: 200px;"> -->
                                        <textarea name="subInfo1[<?= $rowOrderDetail['id_cartDetail'] ?>]"><?php echo $rowOrderDetail['subInfo1'];?></textarea>
                                        </span>
                                    <span class="item_total_price">
                                            <?php echo number_format($rowOrderDetail['totalprice_product'],"0","",".");?>
                                        </span>
                                    <span class="item-delete-detail">
                                        <a href="javascript:;" class="deleteDetailID" data-id="<?= $rowOrderDetail['id_cartDetail'] ?>">Xóa</a>
                                    </span>
                                </li>
                                <?php
                                $totalprice += $rowOrderDetail['totalprice_product'];
                            }
                            ?>
                        </ul>
                        <div class="infor-order">
                            <span style="cursor: pointer;color: blue;" onclick="them_don(<?= $rowOrder['id_cart'] ?>)">Thêm</span>
                        </div>
                        <div class="infor-order">
                            <span>Tổng tiền: </span>
                            <span class="price"><?php echo number_format($totalprice, "0","",".");?> đ</span>
                        </div>
                        <div class="infor-order" style="display: none;">
                            <span>Khuyến mãi: </span>
                            <span class="price"><?php echo number_format($rowOrder['total_price'], "0","",".");?> đ</span>
                        </div>
                        <!-- <a  class="btn btn-warning" onclick="bao_gia(<?= $rowOrder['id_cart'] ?>)"><p>In báo giá</p></a> -->
                    </div>

                    <div class="box2">
                        <h2>Chi tiết đơn hàng</h2>
                        <label for="inputTxtNote">Ghi chú</label>
                        <textarea name="note_cart" id="inputTxtNote" cols="30" class="longtxtNCP2" rows="10" placeholder="Nhập ghi chú về đơn hàng"><?php echo $rowOrder['note_cart'];?></textarea>

                        <label for="name_buyer">Tên: </label>
                        <input type="text" class="form-control" name="name_buyer" value="<?= $rowOrder['name_buyer']; ?>">

                        <label for="phone_buyer">Số điện thoại: </label>
                        <input type="text" class="form-control" name="phone_buyer" value="<?= $rowOrder['phone_buyer']; ?>">

                        <label for="address_buyer">Địa chỉ: </label>
                        <input type="text" class="form-control" name="address_buyer" value="<?= $rowOrder['address_buyer']; ?>">

                        <label for="mail_buyer">Email: </label>
                        <input type="text" class="form-control" name="mail_buyer" value="<?= $rowOrder['mail_buyer']; ?>">

                        <label for="note_buyer">Ghi chú: </label>
                        <input type="text" class="form-control" name="note_buyer" value="<?= $rowOrder['note_buyer']; ?>">

                        <label for="inputSelect">Trạng thái đơn hàng</label>
                        <select name="id_orderState" id="inputSelect" class="form-control">
                            <?php
                            foreach ($orderStates as $orderState) {
                                ?>
                                <option <?php if($orderState['order_state_id'] == $rowOrder['id_orderState']){ echo "selected";}?> value="<?php echo $orderState['order_state_id'];?>"><?php echo $orderState['order_state_name'];?></option>
                                <?php
                            }
                            ?>

                        </select>
                        <label for="note_buyer" style="color:red;">
                            <?php 
                            if ($rowOrder['pay']==1) {
                                echo 'Thanh toán khi nhận hàng';
                            } else {
                                echo 'Thanh toán bằng chuyển khoản';
                            }
                            ?>
                        </label>
                        <label for="note_buyer" style="color:red;">
                            <?php 
                            if ($rowOrder['ship']==1) {
                                echo 'Giao hàng bình thường';
                            } else {
                                echo 'Giao hàng nhanh';
                            }
                            ?>
                        </label>
                        <label for="note_buyer" style="color:red;">
                            <?php 
                            if ($rowOrder['bill']==1) {
                                echo 'Không lấy hóa đơn';
                            } else {
                                echo 'Có lấy hóa đơn';
                            }
                            ?>
                        </label>
                        <label for="note_buyer">Công ty/Tổ chức: </label>
                        <input type="text" class="form-control" name="cong_ty" value="<?= $rowOrder['cong_ty']; ?>">
                        <label for="note_buyer">Địa chỉ công ty: </label>
                        <input type="text" class="form-control" name="dia_chi" value="<?= $rowOrder['dia_chi']; ?>">
                        <label for="note_buyer">Mã số thuế: </label>
                        <input type="text" class="form-control" name="ma_so_thue" value="<?= $rowOrder['ma_so_thue']; ?>">
                    </div>

                </div>
                <div class="sideCusInfo">
                    <h4>Thông tin khách hàng</h4>
                    <hr>

                    <div class="CusInfo">
                        <p><strong>Tên:</strong> <?php echo $rowOrder['name_buyer'];?></p>
                        <p><strong>Số điện thoại:</strong> <?php echo $rowOrder['phone_buyer'];?></p>
                        <p><strong>Địa chỉ:</strong> <?php echo $rowOrder['address_buyer'];?></p>
                        <p><strong>Email:</strong> <?php echo $rowOrder['mail_buyer'];?></p>
                        <p><strong>Ghi chú:</strong> <?php echo $rowOrder['note_buyer'];?></p>
                    </div>
                </div>
            </div>
        </div>
    </div><!--end rowNodeContentPage-->
    <button type="button" class="btn btn-danger pull-right" data-id="<?= $rowOrder['id_cart']; ?>" data-action="deleteOrder" id="deleteOrder">Xóa</button>
    <button class="btn btnSave">Lưu</button>
</form>
<script type="text/javascript">
  function bao_gia (id) {
    // alert(id);

    var link = '/bao-gia/cart-1.php?id='+id;

    window.open(link, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=500,width=1000,height=400");
  }
</script>
<script>
    function money (data) {
        // alert('phi');
        var so = data.value;
        var rong = data.value;
        so = so.split(",").join("");
        so = so.replace(/[^\d]/,'');
        so = Number(so);

        if (rong === "") {
            document.getElementById(data.id).value = "";
        } else {
            document.getElementById(data.id).value = number_format(so);
        }      
    }

    function number_format (number, decimals, dec_point, thousands_sep) {
        var n = number, prec = decimals;

        var toFixedFix = function (n,prec) {
            var k = Math.pow(10,prec);
            return (Math.round(n*k)/k).toString();
        };

        n = !isFinite(+n) ? 0 : +n;
        prec = !isFinite(+prec) ? 0 : Math.abs(prec);
        var sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep;
        var dec = (typeof dec_point === 'undefined') ? '.' : dec_point;

        var s = (prec > 0) ? toFixedFix(n, prec) : toFixedFix(Math.round(n), prec); 
        //fix for IE parseFloat(0.55).toFixed(0) = 0;

        var abs = toFixedFix(Math.abs(n), prec);
        var _, i;

        if (abs >= 1000) {
            _ = abs.split(/\D/);
            i = _[0].length % 3 || 3;

            _[0] = s.slice(0,i + (n < 0)) +
                   _[0].slice(i).replace(/(\d{3})/g, sep+'$1');
            s = _.join(dec);
        } else {
            s = s.replace('.', dec);
        }

        var decPos = s.indexOf(dec);
        if (prec >= 1 && decPos !== -1 && (s.length-decPos-1) < prec) {
            s += new Array(prec-(s.length-decPos-1)).join(0)+'0';
        }
        else if (prec >= 1 && decPos === -1) {
            s += dec+new Array(prec).join(0)+'0';
        }
        return s; 
        // alert(s);
    }
</script>
<script>
    function them_don (id) {
        // alert(id);
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // document.getElementById("demo").innerHTML = this.responseText;
                window.location.href = "/";
            }
        };
        xhttp.open("GET", "/functions/ajax1/them_don.php?id="+id, true);
        xhttp.send();
    }

    function doi_don (id) {
        var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
             var link = this.responseText;
             window.location.href = link;
            }
          };
          xhttp.open("GET", "/functions/ajax1/doi_don.php?id="+id, true);
          xhttp.send();
    }
</script>