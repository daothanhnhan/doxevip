<div class="uni-checkout-body">
<div class="container">

        <div class="tg-container">

            <div id="primary">

                <div class="entry-thumbnail">

                    <div class="entry-content-text-wrapper clearfix">

                        <div class="entry-content-wrapper">

                            <div class="entry-content">

                                <div class="woocommerce">

                                    <div class="row">

                                        <form action="" method="POST" role="form" id="formPayment">

                                        <div class="vk-checkout-billing-left">

                                            <div class="col-md-3 col-lg-3 hidden-xs hidden-sm">
                                                
                                            </div>

                                            <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">

                                                <div class="woocommerce-billing-fields">

                                                    <h3>

                                                        Thông tin thanh toán và nhận hàng

                                                    </h3>

                                                    <div class="woocommerce-billing-fields__field-wrapper">

                                                        <div class="row">

                                                            <div class="col-md-12">

                                                                <p class="form-row form-row-last" >

                                                                    <label class="">Họ và tên <abbr class="required" title="required">*</abbr></label>



                                                                    <input type="text" class="input-text " name="txtName" id="inputTxtName"  placeholder="Họ và tên" value="<?= $row['user_name']?>" required="" >

                                                                </p>

                                                            </div>

                                                            <div class="col-md-12">

                                                                <p class="form-row form-row-last">

                                                                    <label class="">Số điện thoại <abbr class="required" title="required">*</abbr></label>

                                                                    <input type="tel" class="input-text" name="txtPhone" id="inputTxtPhone" placeholder="Số điện thoại" value="<?= $row['user_phone']?>" required="">

                                                                </p>

                                                            </div>

                                                            <div class="col-md-12">

                                                                <p class="form-row form-row-last">

                                                                    <label class="">Email <abbr class="required" title="required"></abbr></label>

                                                                    <input type="email" class="input-text" name="txtEmail" id="inputTxtEmail" placeholder="Địa chỉ Email" value="<?= $row['user_email']?>">

                                                                </p>

                                                            </div>

                                                        </div>

                                                        <p class="form-row form-row-last">

                                                            <label class="">Địa chỉ <abbr class="required" title="required">*</abbr></label>

                                                            <input type="text" class="input-text" name="txtAddress" id="inputTxtAddress" placeholder="Địa chỉ" value="<?= $row['user_address']?>" required="">

                                                        </p>

                                                        <p class="form-row form-row-last">

                                                            <label class="">Ghi chú </label>

                                                            <textarea class="input-text" name="txtNote" id="inputTxtNote" placeholder="Màu sắc và size nếu cần" ></textarea>

                                                        </p>

                                                        <p class="form-row form-row-last">

                                                            <label class="">Mã khuyến mãi <abbr class="required" title="required"></abbr></label>

                                                            <input type="text" class="input-text" name="sale" id="" placeholder="Nhập mã khuyến mãi" value="">

                                                        </p>

                                                        <div class="form-row place-order">

                                                            <button type="submit" name="send_mail" class="btn btn-primary" id="submitPayment" style="padding:3px 30px; font-weight:bold; font-size:16px; margin-bottom:15px;background-color:#0036ff; border:1px solid #fff;" ><?php if($lang == "vn"){echo "Gửi đơn hàng";}else{echo "Complete Shopping";}?></button>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>


                                            <div class="col-md-3 col-lg-3 hidden-xs hidden-sm">
                                                
                                            </div>
                                            

                                        </div>

                                        </form>

                                        <div class="clearfix"></div>

                                    </div>

                                

                                </div>

                            </div><!-- .entry-content -->

                        </div>

                    </div>

                </div>

            </div> <!-- Primary end -->

        </div>

    </div>

</div>