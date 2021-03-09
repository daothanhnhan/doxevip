<?php 

    $list = $action->getList('productcat','','','productcat_id','desc','','','');
    // $product = $kiotviet->get_product($_GET['id_kv']);//var_dump($product);
    /////////////////////////
    $list_xaydung = $action->getList('xay_dung_may_tinh', '', '', 'id', 'asc', '', '', '');
    $producttag_list = $action->getList('producttag', '', '', 'producttag_id', 'asc', '' ,'', '');
    $attribute_list = $action->getList('thuoc_tinh', '', '', 'id', 'asc', '' ,'', '');
    
?>

<script src="js/previewImage.js"></script>

<script>



    function addMoreSize(self){

        var total = $(self).parents('.colorProduct').data('total');

        $.ajax({

            url: "ajax.php",

            data: {'action': 'addMoreSize', 'total': total },

            type: "post",

            success:function(html){

                $(self).parent('.size_section').append(html);

                //$("#size_section").append(html);

            }

        })

    }



    function deleteColor(val){

        $(val).parent().remove();

    }

    

    $(document).ready(function() {



        $('#addMoreSales').on('click',function(e){

            e.preventDefault();

            var total = $('.salesProduct').length;

            $.ajax({

                url: "ajax.php",

                data: {'action': 'addMoreSales', 'total': total },

                type: "post",

                success:function(html){

                    $("#sales_section").append(html);

                }

            })

        })



        $("#addMoreColor").on("click",function(e){

            e.preventDefault();

            var total = $('.colorProduct').length;

            $.ajax({

                url: "ajax.php",

                data: {'action': 'addMoreColor', 'total': total },

                type: "post",

                success:function(html){

                    $("#color_section").append(html);

                }

            })

        })



        $('#addSalePrice').on('click',function(e){

            e.preventDefault();

        })





        $("input[id=fileUpload2").previewimage({

            div: "#preview2",

            imgwidth: 90,

            imgheight: 90

        });



    });



    

</script>
<link rel='stylesheet' href='/css/chosen/chosen.css'>
<style class="cp-pen-styles">
#output {
  padding: 20px;
  background: #dadada;
  display: none;
}
.chosen-results li {
    float: none;
}
</style>
<div id="output"></div>
<form action="" method="post" enctype="multipart/form-data" id="addProduct">

    <button class="btnAddTop" type="submit" style="position: fixed;top: 0;right: 220px;z-index: 9">Lưu</button>

    <input type="hidden" name="action" value="addProduct">

    <input type="hidden" name="table" id="table" value="product">

    <div class="rowNodeContentPage">

        <div class="leftNCP">

            <span class="titLeftNCP">Thông tin sản phẩm</span>

            <p class="subLeftNCP">Cung cấp thông tin về tên, mô tả loại sản phẩm và nhà sản xuất để phân loại sản phẩm</p>   

            <p class="titleRightNCP">Chọn ảnh đại diện cho sản phẩm</p>

            <div id="wrapper">

                <input id="fileUpload" type="file" name="fileUpload1" onchange="showImage(this)" />

                <br />

                <div id="image-holder">
                    <?php 

                        if ($product['images']) {
                            $row['product_img'] = $product['images'][0];
                        ?>

                            <img src="<?= $row['product_img']?>" class="img-responsive" alt="Image">

                            <input type="hidden" name="product_img" value="<?= $row['product_img']?>">

                        <?php

                        }

                    ?>
                 </div>

            </div> 

        </div>

        <div class="boxNodeContentPage">



            <p class="titleRightNCP">Tên sản phẩm</p>

            <input type="text" id="title" onchange="ChangeToSlug()" class="txtNCP1" value="<?= $product['name'] ?>" name="product_name" required/>
            <input type="hidden" name="kiotviet_id" value="<?= $_GET['id_kv'] ?>">

            <!-- <p class="titleRightNCP">Danh mục</p>
            <select class="sltBV" name="productcat_id" size="10">
                <?php $action->showCategoriesSelect($list, 'productcat_parent', 0, '', 'productcat_id', 'productcat_name', 0); ?>
            </select> -->

            <p class="titleRightNCP">Danh mục</p>
            <div class="sltBV" name="productcat_id" size="10">
                <?php $action->showProductCategoriesSelect($list, 'productcat_parent', 0, $row['productcat_id'], 'productcat_id', 'productcat_name', 0, $row['productcat_ar']); ?>
                
            </div>


            <!-- <p class="titleRightNCP">Tên rút gọn</p>

            <input type="text" class="txtNCP1" name="shortName1_service3" value="<?php //echo $rowPro['shortName1_service3'];?>" /> -->

            <p class="titleRightNCP">Thông tin khuyến mãi:</p>

            <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP2 ckeditor" id="editor0" name="product_des"><?php echo $rowPro['product_des'];?></textarea></p>

            

            <p class="titleRightNCP">Mô tả sản phẩm:</p>

            <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP1 ckeditor" id="editor1" name="product_content"><?php echo $rowPro['product_content'];?></textarea></p>

            <p class="titleRightNCP">Bảo hành:</p>
            <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP1 ckeditor1" id="editor2" name="product_sub_info1"></textarea></p>

            <p class="titleRightNCP">Kho hàng:</p>
            <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP1 ckeditor1" id="editor3" name="product_sub_info2"></textarea></p>

            <p class="titleRightNCP">Đặc điểm nổi bật:</p>

            <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP1 ckeditor" id="editor4" name="product_sub_info3"></textarea></p>

            <p class="titleRightNCP">Thông số kỹ thuật:</p>

            <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP1 ckeditor" id="editor5" name="product_sub_info4"></textarea></p>

            <p class="titleRightNCP">Video:</p>

            <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP1 ckeditor" id="editor6" name="product_sub_info5"></textarea></p>

        </div>

    </div><!--end rowNodeContentPage-->

    <div class="rowNodeContentPage">

        <div class="leftNCP">

            <span class="titLeftNCP">Quản lý thuộc tính và tùy chọn</span>

            <p class="subLeftNCP">Bạn có thể cấu hình và quản lý thuộc tính cho từng loại của sản phẩm này</p>

        </div>

        <div class="boxNodeContentPage">

            <div class="rowNCP">

                <?php 
                foreach ($attribute_list as $item_list) { 
                    $list_value_attr = $action->getList('thuoc_tinh_value', 'thuoc_tinh_id', $item_list['id']);
                ?>

                <div class="subColContent">

                    <p class="titleRightNCP"><?= $item_list['name'] ?></p>

                    <select name="thuoc_tinh[]" class="txtNCP1">
                        <option value="0">==Chọn thuộc tính==</option>
                        <?php foreach ($list_value_attr as $item) { ?>
                        <option value="<?= $item['id'] ?>" <?= in_array($item['id'], $thuoc_tinh_arr) ? 'selected' : '' ?> ><?= $item['name'] ?></option>
                        <?php } ?>
                    </select>

                </div>                                      

                <?php } ?>
            </div><!--end rowNCP-->

        </div>

    </div>

    <div class="rowNodeContentPage">

        <div class="leftNCP">

            <span class="titLeftNCP">Tag sản phẩm</span>

            <p class="subLeftNCP">Thiết lập tag cho sản phẩm</p>

        </div>

        <div class="boxNodeContentPage">

            <h3>Tag sản phẩm</h3>

            <select name="producttag[]" class="txtNCP1 chosen-select" data-placeholder="Chọn tag sản phẩm" multiple>
                <?php 

                foreach ($producttag_list as $item) { 
                    $producttag_arr = json_decode($row['producttag_arr']);
                ?>
                <option value="<?= $item['producttag_id'] ?>"><?= $item['producttag_name'] ?></option>
                <?php } ?>
            </select>

        </div>

    </div><!--end rowNodeContentPage-->

    <div class="rowNodeContentPage">

        <div class="leftNCP">

            <span class="titLeftNCP">Ảnh sản phẩm</span>

            <p class="subLeftNCP">Thiết lập ảnh sản phẩm</p>

        </div>

        <div class="boxNodeContentPage">

            <h3>Ảnh phụ sản phẩm</h3>

            <input type="file" name="fileUpload2" id="fileUpload2">

            <div class="preview2" id="preview2"> 

            </div>

        </div>

    </div><!--end rowNodeContentPage-->


    <div class="rowNodeContentPage" style="display: none;">

        <div class="leftNCP">

            <span class="titLeftNCP">Ảnh sản phẩm</span>

            <p class="subLeftNCP">Thiết lập ảnh đại diện sản phẩm</p>

        </div>

        <div class="boxNodeContentPage">

            <h3>Ảnh đại diện sản phẩm</h3>

            <input type="file" name="fileUpload3" id="fileUpload3">

            <div class="preview2" id="preview2"> 

            </div>

        </div>

    </div>



    <!-- <div class="rowNodeContentPage">

        <div class="leftNCP">

            <span class="titLeftNCP">Thiết lập kích cỡ và màu sắc</span>

            <p class="subLeftNCP">Thiết lập kích cỡ và màu sắc</p>

        </div>

        <div class="boxNodeContentPage">

            <div class="rowNCP" id="color_section">

            </div>

            <a href="#" id="addMoreColor" class="addMoreColor">Thêm tùy chọn màu</a>

        </div>

    </div> --><!--end rowNodeContentPage-->

    

    <div class="rowNodeContentPage">

        <div class="leftNCP">

            <span class="titLeftNCP">Quản lý kho và tùy chọn</span>

            <p class="subLeftNCP">Bạn có thể cấu hình và quản lý kho cho từng loại của sản phẩm này</p>

        </div>

        <div class="boxNodeContentPage">

            <div class="rowNCP">

                <div class="subColContent">

                    <p class="titleRightNCP">Giá gốc (VNĐ)</p>

                    <input type="number" class="txtNCP1" value="" name="product_price"/>

                </div>                                      

                <div class="subColContent" >

                    <p class="titleRightNCP">Khuyến mãi (%)</p>

                    <input type="number" class="txtNCP1" value="<?php echo $rowPro['product_price_sale'];?>" name="product_price_sale"/>

                </div>         

                

                

            </div><!--end rowNCP-->

            <div class="rowNCP">

                <div class="subColContent">

                    <p class="titleRightNCP">Mã sản phẩm</p>

                    <input type="text" class="txtNCP1" value="<?php echo $rowPro['product_code'];?>" name="product_code"/>

                </div>                                      

                <!-- <div class="subColContent" >

                    <p class="titleRightNCP">Xuất xứ</p>

                    <input type="text" class="txtNCP1" value="<?php echo $rowPro['product_original'];?>" name="product_original"/>

                </div> -->           

                <div class="subColContent" >

                    <p class="titleRightNCP">Khuyến mãi</p>

                    <input type="text" class="txtNCP1" value="<?php echo $rowPro['product_shape'];?>" name="product_shape"/>

                </div>    

            </div><!--end rowNCP-->

            <div class="rowNCP">

                <!-- <div class="subColContent">

                    <p class="titleRightNCP">Kích cỡ</p>

                    <input type="text" class="txtNCP1" value="<?php echo $rowPro['product_size'];?>" name="product_size"/>

                </div>                                      

                <div class="subColContent" >

                    <p class="titleRightNCP">Đóng gói</p>

                    <input type="text" class="txtNCP1" value="<?php echo $rowPro['product_package'];?>" name="product_package"/>

                </div>  -->

                <div class="subColContent">

                    <p class="titleRightNCP">Hãng sản xuất</p>

                    <input type="text" class="txtNCP1" value="<?php echo $rowPro['product_expiration'];?>" name="product_expiration"/>

                </div>

                <div class="subColContent" >

                    <p class="titleRightNCP">Xuất xứ</p>

                    <input type="text" class="txtNCP1" value="<?php echo $rowPro['product_material'];?>" name="product_material"/>

                </div>                

            </div><!--end rowNCP-->

            <div class="rowNCP">                 

                <div class="subColContent" >

                    <p class="titleRightNCP">Xây dựng máy tính</p>

                    <select name="xay_dung" class="txtNCP1">
                        <option value="0">==Chọn xây dựng máy tính==</option>
                        <?php foreach ($list_xaydung as $item) { ?>
                        <option value="<?= $item['id'] ?>" ><?= $item['name'] ?></option>
                        <?php } ?>
                    </select>

                </div>            

                <div class="subColContent" >

                    <p class="titleRightNCP">Tình trạng hàng</p>

                    <select name="has" class="txtNCP1">
                        <option value="1">Còn hàng</option>
                        <option value="0">Hết hàng</option>
                    </select>

                </div>  

            </div><!--end rowNCP-->

            <!-- <div class="rowNCP">

                <div class="subColContent">

                    <p class="titleRightNCP">Giao hàng</p>

                    <input type="text" class="txtNCP1" value="<?php echo $rowPro['product_delivery'];?>" name="product_delivery"/>

                </div>                                      

                <div class="subColContent" >

                    <p class="titleRightNCP">Thời gian giao hàng</p>

                    <input type="text" class="txtNCP1" value="<?php echo $rowPro['product_delivery_time'];?>" name="product_delivery_time"/>

                </div>               

            </div> --><!--end rowNCP-->

            <!-- <div class="rowNCP">

                <div class="subColContent">

                    <p class="titleRightNCP">Hình thức thanh toán</p>

                    <input type="text" class="txtNCP1" value="<?php echo $rowPro['product_payment'];?>" name="product_payment"/>

                </div>                                      

                           

            </div> --><!--end rowNCP-->

        </div>

    </div>



    <div class="rowNodeContentPage">

        <div class="leftNCP">

            <span class="titLeftNCP">Tối ưu SEO</span>

            <p class="subLeftNCP">Thiết lập thẻ tiêu đề, thẻ mô tả, đường dẫn. Những thông tin này xác định cách danh mục xuất hiện trên công cụ tìm kiếm.</p>                

        </div>

        <div class="boxNodeContentPage">

            <div>

                <p class="titleRightNCP">Tiêu đề trang</p>

                <p class="subRightNCP"> <strong class="text-character"></strong>/70 ký tự</p>

                <input type="text" class="txtNCP1" placeholder="Điều khoản dịch vụ" name="title_seo" id="title_seo" value="<?= $product['name'] ?>" onkeyup="countChar(this)"/>

            </div>

            <div>

                <p class="titleRightNCP">Thẻ mô tả</p>

                <p class="subRightNCP"><strong class="text-character"></strong>/160 ký tự</p>

                <textarea class="longtxtNCP2" name="des_seo" onkeyup="countChar(this)"><?php echo $rowPro['des_seo'];?></textarea>

            </div>

            <p class="titleRightNCP">Đường dẫn</p>

            <div class="coverLinkNCP">

                <p class="nameLinkNCP"><?php echo $_SERVER['SERVER_NAME']?>/</p>

                <div id="slug">

                    <input type="text" id="slug1" class="txtLinkNCP" name="friendly_url" value="<?php echo $action->vi_en1($product['name']);?>" />     

                </div>

            </div>

            <p class="titleRightNCP">Keyword</p>

            <input type="text" class="txtNCP1" placeholder="Nhập keyword" name="keyword" value="<?php echo $rowPro['keyword'];?>"/>

        </div>

    </div><!--end rowNodeContentPage-->

    <div class="rowNodeContentPage">

        <div class="leftNCP">

            <span class="titLeftNCP">Trạng thái</span>

        </div>

        <div class="boxNodeContentPage">

            <div>

                <label class="selectCate">

                    <input type="checkbox" value="1" name="product_new" <?= $rowPro['product_new'] == 1 ? 'checked' : '' ?>>Sản phẩm mới

                </label>

            </div>

            <div>

                <label class="selectCate">

                    <input type="checkbox" value="1" name="product_hot" <?= $rowPro['product_hot'] == 1 ? 'product_hot' : '' ?>>Sản phẩm hot

                </label>

            </div>

            <div>

                <label class="selectCate">

                    <input type="checkbox" value="1" name="state" checked>Trạng thái hiển thị

                </label>

            </div>

            

        </div>

    </div><!--end rowNodeContentPage-->

    

    <button type="submit" class="btn btnSave">Lưu</button>

            

</form>
<script src='/css/chosen/chosen.jquery.js'></script>
<script >
document.getElementById('output').innerHTML = location.search;
$(".chosen-select").chosen();
//# sourceURL=pen.js
</script>