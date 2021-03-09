<?php 

    $product_id = isset($_GET['id']) ? $_GET['id'] : '';

    $row = $action->getDetail_New('product',array('product_id'),array(&$product_id),'i');

    if ($row == '') {

        header('location: index.php?page=san-pham');

    }

    $list = $action->getList('productcat','','','productcat_id','desc','','','');

    $languages = $action->getListLanguages();



    $action_showMain = new action_page('VN');

    $lang_showMain = "vn";

    $row_showMain = $action_showMain->getDetail_New('product_languages',array('product_id','languages_code'),array(&$row['product_id'], &$lang_showMain),'is');
    /////////////////////////
    $list_xaydung = $action->getList('xay_dung_may_tinh', '', '', 'id', 'asc', '', '', '');

    $producttag_list = $action->getList('producttag', '', '', 'producttag_id', 'asc', '' ,'', '');

    $attribute_list = $action->getList('thuoc_tinh', '', '', 'id', 'asc', '' ,'', '');

    $thuoc_tinh_arr = json_decode($row['thuoc_tinh']);//var_dump($thuoc_tinh_arr);

     // $product = $kiotviet->get_product($row['kiotviet_id']);

     // $kiotviet->set_product_all_db_state();

    $gia = json_decode($row['product_sub_info2']);
    $anh_chinh = json_decode($row['product_des2']);
    $ten_anh = json_decode($row['product_des3']);//var_dump($ten_anh);
    $anh_tinh_nang = json_decode($row['product_sub_info1']);
    $gia_tinh_nang_giam = json_decode($row['product_content2']);

    $producttag_arr = json_decode($row['producttag_arr']);
?>

<script src="js/previewImage.js"></script>

<script>



    function deleteColor(val){

        if (confirm('Xóa màu sản phẩm, sẽ xóa tất cả kích cỡ của màu này')) {

            $(val).parent().remove();

        }

    }



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



    function deleteSales(val){

        if (confirm('Xóa khuyến mãi')) {

            $(val).parent().remove();

        }

    }



    function deleteSize(val){

        if (confirm('Xóa kích cỡ')) {

            $(val).parents().eq(2).remove();

        }

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



        

        $("input[id=fileUpload2").previewimage({

            div: "#preview2",

            imgwidth: 90,

            imgheight: 90

        });



        $("#productOrg").on("keyup",function(){

            $("#box_suggest_productOrg").show();

            var text = $(this).val();

            if (text != "") {

                $.ajax({

                    type: "post",

                    url: "ajax.php?action=getSuggestOrg",

                    data: "keyword="+$(this).val(),

                    success:function(data){

                        $("#box_suggest_productOrg").html(data);

                    }

                })

            }

        })

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

<form action="" id="updateLangProduct">

    <input type="hidden" name="action" value="updateLangProduct">

    <input type="hidden" name="product_id" value="<?= $product_id ?>">

    <div class="modal fade" id="modal-id">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                    <h4 class="modal-title">Chỉnh sửa ngôn ngữ</h4>

                </div>

                <div class="modal-body">

                    <div role="tabpanel">

                        <!-- Nav tabs -->

                        <ul class="nav nav-tabs" role="tablist">

                            <?php 

                                foreach ($languages as $key => $lang) {

                                ?>

                                    <li role="presentation" class="<?= $key == 0 ? 'active' : ''?>">

                                        <a href="#<?= $lang['languages_code']?>" aria-controls="home" role="tab" data-toggle="tab"><?= $lang['languages_name']?></a>

                                    </li>

                                <?php

                                }

                            ?>

                        </ul>

                    

                        <!-- Tab panes -->

                        <div class="tab-content">

                            <?php 

                                foreach ($languages as $key => $lang) {

                                    $action1 = new action_page();

                                    $rowDetailLang = $action1->getDetail_New('product_languages',array('product_id','languages_code'),array(&$row['product_id'], &$lang['languages_code']),'is');

                                    

                                ?>

                                    <div role="tabpanel" class="tab-pane <?= $key == 0 ? 'active' : ''?>" id="<?= $lang['languages_code']?>">

                                        <input type="hidden" name="lang[<?= $lang['languages_code']?>][lang_product_des2]" value="">

                                        <input type="hidden" name="lang[<?= $lang['languages_code']?>][lang_product_des3]" value="">

                                        <input type="hidden" name="lang[<?= $lang['languages_code']?>][lang_product_content2]" value="">

                                        <input type="hidden" name="lang[<?= $lang['languages_code']?>][lang_product_content3]" value="">

                                        <input type="hidden" name="lang[<?= $lang['languages_code']?>][lang_product_payment_type]" value="">

                                        <input type="hidden" name="lang[<?= $lang['languages_code']?>][lang_product_sub_info1]" value="">

                                        <input type="hidden" name="lang[<?= $lang['languages_code']?>][lang_product_sub_info2]" value="">

                                        <input type="hidden" name="lang[<?= $lang['languages_code']?>][lang_product_sub_info3]" value="">

                                        <input type="hidden" name="lang[<?= $lang['languages_code']?>][lang_product_sub_info4]" value="">

                                        <input type="hidden" name="lang[<?= $lang['languages_code']?>][lang_product_sub_info5]" value="">

                                        <p class="titleRightNCP">Tiêu đề</p>

                                        <input type="text" class="txtNCP1" value="<?= $rowDetailLang['lang_product_name'];?>" name="lang[<?= $lang['languages_code']?>][lang_product_name]" id="product_name_<?= $lang['languages_code']?>" onkeyup="pro_<?= $lang['languages_code']?>()"/>

                                        

                                        <p class="titleRightNCP">Mô tả ngắn</p>

                                        <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP1 ckeditor" id="editor<?= $lang['languages_code']?>" name="lang[<?= $lang['languages_code']?>][lang_product_des]" ><?= $rowDetailLang['lang_product_des'];?></textarea></p>

                                        <p class="titleRightNCP">Nội dung</p>

                                        <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP1 ckeditor" id="editor1<?= $lang['languages_code']?>" name="lang[<?= $lang['languages_code']?>][lang_product_content]" ><?= $rowDetailLang['lang_product_content'];?></textarea></p>



                                        <div class="rowNCP">

                                            <div class="subColContent">

                                                <p class="titleRightNCP">Mã sản phẩm</p>

                                                <input type="text" class="txtNCP1" value="<?php echo $rowDetailLang['lang_product_code'];?>" name="lang[<?= $lang['languages_code']?>][lang_product_code]"/>

                                            </div>                                      

                                            <div class="subColContent" >

                                                <p class="titleRightNCP">Xuất xứ</p>

                                                <input type="text" class="txtNCP1" value="<?php echo $rowDetailLang['lang_product_original'];?>" name="lang[<?= $lang['languages_code']?>][lang_product_original]"/>

                                            </div>               

                                        </div><!--end rowNCP-->

                                        <div class="rowNCP">

                                            <div class="subColContent">

                                                <p class="titleRightNCP">Kích cỡ</p>

                                                <input type="text" class="txtNCP1" value="<?php echo $rowDetailLang['lang_product_size'];?>" name="lang[<?= $lang['languages_code']?>][lang_product_size]"/>

                                            </div>                                      

                                            <div class="subColContent" >

                                                <p class="titleRightNCP">Đóng gói</p>

                                                <input type="text" class="txtNCP1" value="<?php echo $rowDetailLang['lang_product_package'];?>" name="lang[<?= $lang['languages_code']?>][lang_product_package]"/>

                                            </div>               

                                        </div><!--end rowNCP-->

                                        <div class="rowNCP">

                                            <div class="subColContent">

                                                <p class="titleRightNCP">Giao hàng</p>

                                                <input type="text" class="txtNCP1" value="<?php echo $rowDetailLang['lang_product_delivery'];?>" name="lang[<?= $lang['languages_code']?>][lang_product_delivery]"/>

                                            </div>                                      

                                            <div class="subColContent" >

                                                <p class="titleRightNCP">Thời gian giao hàng</p>

                                                <input type="text" class="txtNCP1" value="<?php echo $rowDetailLang['lang_product_delivery_time'];?>" name="lang[<?= $lang['languages_code']?>][lang_product_delivery_time]"/>

                                            </div>               

                                        </div><!--end rowNCP-->

                                        <div class="rowNCP">

                                            <div class="subColContent">

                                                <p class="titleRightNCP">Hình thức thanh toán</p>

                                                <input type="text" class="txtNCP1" value="<?php echo $rowDetailLang['lang_product_payment'];?>" name="lang[<?= $lang['languages_code']?>][lang_product_payment]"/>

                                            </div>                                      

                                                       

                                        </div><!--end rowNCP-->

                                         <div class="rowNCP">

                                            <div class="subColContent">

                                                <p class="titleRightNCP">Đường dẫn</p>

                                                <input type="text" class="txtNCP1" value="<?php echo $rowDetailLang['friendly_url'];?>" id="url_<?= $lang['languages_code']?>" name="lang[<?= $lang['languages_code']?>][friendly_url]"/>

                                            </div>                                      

                                        </div><!--end rowNCP-->

                                        <div class="rowNCP">

                                            <div class="subColContent">

                                                <p class="titleRightNCP">Tiêu đề trang</p>

                                                <input type="text" class="txtNCP1" value="<?php echo $rowDetailLang['title_seo'];?>" name="lang[<?= $lang['languages_code']?>][title_seo]"/>

                                            </div>                                      

                                        </div><!--end rowNCP-->


                                        <!-- <div>

                                            <p class="titleRightNCP">Tiêu đề trang</p>

                                            <p class="subRightNCP"> <strong class="text-character"></strong>/70 ký tự</p>

                                            <input type="text" class="txtNCP1" placeholder="Điều khoản dịch vụ" name="title_seo" id="title_seo" value="<?php echo $row_showMain['title_seo'];?>" onkeyup="countChar(this)"/>

                                        </div> -->

                                    </div>

                                <?php

                                }

                            ?>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    <button type="submit" class="btn btn-primary">Save changes</button>

                </div>

            </div>

        </div>

    </div>

</form>

<form action="" method="post" enctype="multipart/form-data" id="updateProduct">

    <button class="btnAddTop" type="submit" style="position: fixed;top: 0;right: 220px;z-index: 9;<?php echo ($_SESSION['admin_role']==2)?'display: none;':'';?>">Lưu</button>

    <a class="btnAddTop" data-toggle="modal" href='#modal-id' style="position: fixed;top: 0;right: 285px;z-index: 9;<?php echo ($hidden_multi_lang=='hidden')?'display: none;':'';?>">Chỉnh sửa ngôn ngữ</a>

    <input type="hidden" name="action" value="updateProduct">

    <input type="hidden" name="product_id" value="<?= $product_id?>">

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

                        if ($row['product_img'] != '') {

                        ?>

                            <img src="/images/product/<?= $row['product_img']?>" class="img-responsive" alt="Image">

                            <input type="hidden" name="product_img" value="<?= $row['product_img'] ?>">

                        <?php

                        }

                    ?>

                </div>

            </div> 

        </div>

        <div class="boxNodeContentPage">



            <p class="titleRightNCP">Tên sản phẩm</p>

            <input type="text" id="title" onchange="ChangeToSlug()" class="txtNCP1" value="<?= $row_showMain['lang_product_name']?>" name="product_name" required/>
            <input type="hidden" name="tuan_idkv" value="<?= $row['kiotviet_id'] ?>">
            <button type="button" onclick="doi_ten_anh(<?= $_GET['id'] ?>)">Đổi tên ảnh</button>
            <p style="width: 100%;">&nbsp;</p>
            <p style="width: 100%;"><a href="index.php?page=tinh-nang-cat&product_id=<?= $_GET['id'] ?>">Tính năng</a></p>
            <p style="width: 100%;">&nbsp;</p>
            <p style="width: 100%;"><a href="index.php?page=tinh-nang-gia&product_id=<?= $_GET['id'] ?>">Giá Tính năng</a></p>
           <!--  <p class="titleRightNCP">Danh mục</p>

            <select class="sltBV" name="productcat_id" size="10">

                <?php $action->showCategoriesSelect($list, 'productcat_parent', 0, $row['productcat_id'], 'productcat_id', 'productcat_name', 0); ?>

            </select> -->


            <!-- test multi Danh mục -->
            <p class="titleRightNCP">Danh mục</p>
            <div class="sltBV" name="productcat_id" size="10">
                <?php $action->showProductCategoriesSelect($list, 'productcat_parent', 0, $row['productcat_id'], 'productcat_id', 'productcat_name', 0, $row['productcat_ar']); ?>
                
            </div>



            <!-- <p class="titleRightNCP">Tên rút gọn</p>
            <input type="text" class="txtNCP1" name="shortName1_service3" value="<?php //echo $row['shortName1_service3'];?>" /> -->


            <p class="titleRightNCP">Link cào sản phẩm:</p>

            <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP2 ckeditor1" id="editor0" name="product_des"><?php echo $row['product_des'];?></textarea></p>

            

            <p class="titleRightNCP">Mô tả sản phẩm:</p>

            <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP1 ckeditor" id="editor1" name="product_content"><?php echo $row['product_content'];?></textarea></p>

            <p class="titleRightNCP" style="color:red;">Ảnh chính:</p>
            <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP1 ckeditor1" id="editor21" name="product_des2" style="display: none;"><?php echo $row['product_des2'];?></textarea></p>
            <?php foreach ($anh_chinh as $item) { ?>
                <img src="<?= $item ?>" alt="" width="200">
            <?php } ?>
            <br style="clear: both;">
            <br style="clear: both;">

            <?php include 'template/san-pham/anh-tinh-nang.php'; ?>

            <?php //include 'template/san-pham/hien-thi-tinh-nang.php'; ?>

            <?php include 'template/san-pham/gia-tinh-nang.php'; ?>

            

            
            <p class="titleRightNCP">Giá tính năng giảm:</p><br style="clear: both;">
            <?php 
            $d = -1;
            foreach ($gia_tinh_nang_giam as $item) { 
                $d++
            ?>
                <p style="width: 100%;"><?= $d+1 ?></p>
                <input type="number" name="product_content2[]" value="<?= $item ?>"><br>
            <?php } ?>
            
            <!-- <p class="titleRightNCP">Tên ảnh:</p><br style="clear: both;"> -->
            <!-- <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP1 ckeditor1" id="editor3" name="product_des3"><?php echo $row['product_des3'];?></textarea></p> -->
            <?php foreach ($ten_anh as $item) { ?>
                <!-- <input type="text" class="txtNCP1" name="product_des3[]" value="<?= $item ?>"><br> -->
            <?php } ?>

            <p class="titleRightNCP">Đặc điểm nổi bật:</p>

            <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP1 ckeditor" id="editor4" name="product_sub_info3"><?php echo $row['product_sub_info3'];?></textarea></p>

            <p class="titleRightNCP">Thông số kỹ thuật:</p>

            <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP1 ckeditor" id="editor5" name="product_sub_info4"><?php echo $row['product_sub_info4'];?></textarea></p>

            <p class="titleRightNCP">Video:</p>

            <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP1 ckeditor1" id="editor6" name="product_sub_info5"><?php echo $row['product_sub_info5'];?></textarea></p>

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

    <script type="text/javascript">
        function add_size () {
            var size = document.getElementById('size').innerHTML;
            document.getElementById('size').innerHTML = size + '<div class="del-input"><input type="text" class="txtNCP1" value="" name="producttag[]" required/><button type="button" onclick="del_size(this)">Xóa</button></div>';
        }

        function del_size (input) {
            document.getElementById('size').removeChild(input.parentNode);
        }
    </script>

    <div class="rowNodeContentPage">

        <div class="leftNCP">

            <span class="titLeftNCP">Tag sản phẩm</span>

            <p class="subLeftNCP">Thiết lập tag cho sản phẩm</p>

        </div>

        <div class="boxNodeContentPage">

            <h3>Tag sản phẩm</h3>

            <!-- <select name="producttag[]" class="txtNCP1 chosen-select" data-placeholder="Chọn tag sản phẩm" multiple >
                <?php 

                foreach ($producttag_list as $item) { 
                    $producttag_arr = json_decode($row['producttag_arr']);
                ?>
                <option value="<?= $item['producttag_id'] ?>" <?= in_array($item['producttag_id'], $producttag_arr) ? 'selected' : '' ?> ><?= $item['producttag_name'] ?></option>
                <?php } ?>
            </select> -->

            <button type="button" onclick="add_size()">Thêm</button>

            <div class="rowNCP">

                <div class="subColContent">

                    <!-- <p class="titleRightNCP">Kích cỡ</p> -->
                    <div id="size">
                        <?php foreach ($producttag_arr as $item) { ?>
                        <div class="del-input">
                            <input type="text" class="txtNCP1" value="<?php echo $item;?>" name="producttag[]"/>
                            <button type="button" onclick="del_size(this)">Xóa</button>
                        </div>
                        <?php } ?>
                    </div>                    

                </div>    

            </div><!--end rowNCP-->

        </div>

    </div><!--end rowNodeContentPage-->

    <div class="rowNodeContentPage">

        <div class="leftNCP">

            <span class="titLeftNCP">Ảnh phụ sản phẩm</span>

            <p class="subLeftNCP">Thiết lập ảnh phụ cho sản phẩm</p>

        </div>

        <div class="boxNodeContentPage">

            <h3>Ảnh phụ sản phẩm</h3>

            

            <input type="file" name="fileUpload2" id="fileUpload2">

            <div class="preview2" id="preview2"> 

                <?php

                    $array = json_decode($row['product_sub_img'], true);

                    foreach ($array as $key => $val) {

                        $img = json_decode($val, true);

                        if ($img != '') {

                            ?>

                                <div class="sub_image_product">

                                    <input type="hidden" name="subImage[]" value="<?= $img['image']?>">

                                    <img src="../images/product/<?= $img['image']?>" alt="">

                                    <p data-upload-preview="fileUpload2[]-0" style="cursor: pointer;">Xóa ảnh</p>

                                </div>

                            <?php                            

                        }

                    }

                ?>

            </div>

        </div>

    </div><!--end rowNodeContentPage-->

    <div class="rowNodeContentPage" style="display: none;">

        <div class="leftNCP">

            <span class="titLeftNCP">Ảnh đại diện sản phẩm</span>

            <p class="subLeftNCP">Thiết lập ảnh đại diện sản phẩm</p>

        </div>

        <div class="boxNodeContentPage">

            <h3>Ảnh đại diện sản phẩm</h3>

            <div id="wrapper">

                <input id="fileUpload" type="file" name="fileUpload3" onchange="showImage(this)" />

                <br />

                <div id="image-holder">

                    <?php 

                        if ($row['product_img_2'] != '') {

                        ?>

                            <img src="../images/<?= $row['product_img_2']?>" class="img-responsive" alt="Image">

                            <input type="hidden" name="product_img_2" value="<?= $row['product_img_2']?>">

                        <?php

                        }

                    ?>

                </div>

            </div>

        </div>

    </div>

    <div class="rowNodeContentPage">

        <!-- <div class="leftNCP">

            <span class="titLeftNCP">Ảnh sản phẩm</span>

            <p class="subLeftNCP">Thiết lập ảnh sản phẩm</p>

        </div> -->

        <!--  <div class="boxNodeContentPage">

            <div class="rowNCP" id="color_section">

                <?php

                    $i = 0;

                    $row1s1 = $action->getList('color','product_id', $row['product_id'],'','','','','');

                    foreach ($row1s1 as $key => $row1) {

                        $i++;

                        //print_r($row1);

                        $a1 = json_decode($row1, true);

                        ?>

                            <div class="row1 colorProduct" id="colorProduct" data-total=<?= $i?> style="position: relative; border-bottom: 1px solid #999; padding-bottom: 10px;">

                                <input type="hidden" name="name[<?= $i?>][color_id]" value="<?= $row1['color_id']?>">

                                <div class="subColContent2">

                                    <p class="titleRightNCP">Tên màu</p>

                                    <input type="text" name="name[<?= $i?>][name]" value="<?= $row1['color_name']?>" placeholder="" class="txtNCP1" required>

                                </div>

                                <div class="subColContent2">

                                <p class="titleRightNCP">Ảnh màu</p>

                                    <input type="file" name="name[<?= $i?>][img]" value="" placeholder="" class="txtNCP1" >

                                </div>

                                <?php 

                                    if ($row1['color_img'] != '') {

                                    ?>

                                        <div class="subColContent3">

                                            <img src="../image/product/<?= $row1['color_img']?>" alt="">

                                            <input type="hidden" name="name[<?= $i?>][color_img]" value="<?= $row1['color_img']?>">

                                        </div>

                                    <?php

                                    }

                                ?>

                                

                                <div class="row1NCP size_section" id="size_section1" >

                                    

                                    <?php 

                                        $rows2 = $action1->getList('size','color_id',$row1['color_id'],'','','','','');

                                        foreach ($rows2 as $key => $value) {

                                            

                                        ?>

                                            <div class="" id="colorProduct">

                                                <input type="hidden" name="b[<?= $i?>][size_id][]" value="<?= $value['size_id']?>">

                                                <div class="subColContent2">

                                                    <p class="titleRightNCP">Kích cỡ</p>

                                                    <input type="text" name="b[<?= $i?>][size][]" value="<?= $value['size_name']?>" placeholder="" class="txtNCP1" required>

                                                </div>

                                                <div class="subColContent2">

                                                    <p class="titleRightNCP">Số lượng</p>

                                                    <input type="text" name="b[<?= $i?>][stock][]" value="<?= $value['size_stock']?>" placeholder="" class="txtNCP1" required>

                                                </div>

                                                <div class="subColContent2" style="position: relative;">

                                                    <div style="position: absolute; top: 40px; left: 10px; cursor: pointer; background-color: #931313; padding: 9px 10px; color: #fff; border:1px solid #931313; border-radius: 5px;" onclick="deleteSize(this)">

                                                        <i class="fa-lg fa fa-trash"></i>

                                                    </div>

                                                </div>

                                            </div>

                                        <?php

                                        }

                                    ?>

                                    <a href="javascript:void(0)" id="addMoreSize" class="addMoreProductPart" onclick="addMoreSize(this)">Thêm kích cỡ 1</a>

                                </div>

                                <div class="" style="position: absolute; top: 40px; right: 10px; cursor: pointer; background-color: #931313; padding: 9px 10px; color: #fff; border:1px solid #931313; border-radius: 5px;" onclick="deleteColor(this)">

                                    <i class="fa-lg fa fa-trash"></i>

                                </div>

                            </div>

                        <?php

                    }

                ?>

            </div>

            <a href="#" id="addMoreColor" class="addMoreColor">Thêm tùy chọn màu</a>

        </div>

    </div> --><!--end rowNodeContentPage

    

    <div class="rowNodeContentPage">

        <!-- <div class="leftNCP">

            <span class="titLeftNCP">Quản lý kho và tùy chọn</span>

            <p class="subLeftNCP">Bạn có thể cấu hình và quản lý kho cho từng loại của sản phẩm này</p>

        </div> -->

        <!-- <div class="boxNodeContentPage">

            <div class="rowNCP">

                <div class="subColContent">

                    <p class="titleRightNCP">Giá</p>

                    <input type="number" class="txtNCP1" value="<?php echo $row['product_price'];?>" name="product_price"/>

                </div>                                      

                <div class="subColContent" >

                    <p class="titleRightNCP">Giá trước khuyến mãi</p>

                    <input type="number" class="txtNCP1" value="<?php echo $row['product_price_sale'];?>" name="product_price_sale"/>

                </div>               

            </div>

            <div class="rowNCP">

                <div class="subColContent">

                    <p class="titleRightNCP">Mã sản phẩm</p>

                    <input type="text" class="txtNCP1" value="<?php echo $row['product_code'];?>" name="product_code"/>

                </div>                                      

                <div class="subColContent" >

                    <p class="titleRightNCP">Xuất xứ</p>

                    <input type="text" class="txtNCP1" value="<?php echo $row['product_original'];?>" name="product_original"/>

                </div>               

            </div>

            <div class="rowNCP">

                <div class="subColContent">

                    <p class="titleRightNCP">Kích cỡ</p>

                    <input type="text" class="txtNCP1" value="<?php echo $row['product_size'];?>" name="product_size"/>

                </div>                                      

                <div class="subColContent" >

                    <p class="titleRightNCP">Đóng gói</p>

                    <input type="text" class="txtNCP1" value="<?php echo $row['product_package'];?>" name="product_package"/>

                </div>               

            </div>

            <div class="rowNCP">

                <div class="subColContent">

                    <p class="titleRightNCP">Giao hàng</p>

                    <input type="text" class="txtNCP1" value="<?php echo $row['product_delivery'];?>" name="product_delivery"/>

                </div>                                      

                <div class="subColContent" >

                    <p class="titleRightNCP">Thời gian giao hàng</p>

                    <input type="text" class="txtNCP1" value="<?php echo $row['product_delivery_time'];?>" name="product_delivery_time"/>

                </div>               

            </div>

            <div class="rowNCP">

                <div class="subColContent">

                    <p class="titleRightNCP">Hình thức thanh toán</p>

                    <input type="text" class="txtNCP1" value="<?php echo $row['product_payment'];?>" name="product_payment"/>

                </div>                                      

                           

            </div>

        </div>

    </div> -->







    <div class="rowNodeContentPage">

        <div class="leftNCP">

            <span class="titLeftNCP">Quản lý kho và tùy chọn</span>

            <p class="subLeftNCP">Bạn có thể cấu hình và quản lý kho cho từng loại của sản phẩm này</p>

        </div>

        <div class="boxNodeContentPage">

            <div class="rowNCP">

                <div class="subColContent">

                    <p class="titleRightNCP">Giá gốc (VNĐ)</p>

                    <input type="number" class="txtNCP1" value="<?php echo $row['product_price'];?>" name="product_price"/>

                </div>                                      

                <div class="subColContent" >

                    <p class="titleRightNCP">khuyến mãi (%)</p>

                    <input type="number" class="txtNCP1" value="<?php echo $row['product_price_sale'];?>" name="product_price_sale"/>

                </div>           

                

            </div><!--end rowNCP-->

            <div class="rowNCP">

                <div class="subColContent">

                    <p class="titleRightNCP">Mã sản phẩm</p>

                    <input type="text" class="txtNCP1" value="<?php echo $row['product_code'];?>" name="product_code"/>

                </div>                                      

                <!-- <div class="subColContent" >

                    <p class="titleRightNCP">Xuất xứ</p>

                    <input type="text" class="txtNCP1" value="<?php echo $rowPro['product_original'];?>" name="product_original"/>

                </div> -->           

                <div class="subColContent" >

                    <p class="titleRightNCP">Khuyến mãi</p>

                    <input type="text" class="txtNCP1" value="<?php echo $row['product_shape'];?>" name="product_shape"/>

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

                    <p class="titleRightNCP">Tình trạng</p>

                    <input type="text" class="txtNCP1" value="<?php echo $row['product_expiration'];?>" name="product_expiration"/>

                </div>  

                <div class="subColContent" >

                    <p class="titleRightNCP">Thời gian hàng về dự kiến</p>

                    <input type="text" class="txtNCP1" value="<?php echo $row['product_material'];?>" name="product_material"/>

                </div>              

            </div><!--end rowNCP-->

            <div class="rowNCP">                 

                <div class="subColContent" >

                    <p class="titleRightNCP">Xây dựng máy tính</p>

                    <select name="xay_dung" class="txtNCP1">
                        <option value="0">==Chọn xây dựng máy tính==</option>
                        <?php foreach ($list_xaydung as $item) { ?>
                        <option value="<?= $item['id'] ?>" <?= $row['xay_dung']==$item['id'] ? 'selected' : '' ?> ><?= $item['name'] ?></option>
                        <?php } ?>
                    </select>

                </div>       

                <div class="subColContent" >

                    <p class="titleRightNCP">Tình trạng hàng</p>

                    <select name="has" class="txtNCP1">
                        <option value="1" <?= $row['has']==1 ? 'selected' : '' ?> >Hàng Quốc Tế</option>
                        <option value="2" <?= $row['has']==2 ? 'selected' : '' ?> >Hàng Nội Địa</option>
                        <option value="3" <?= $row['has']==3 ? 'selected' : '' ?> >Hàng Sẵn Kho</option>
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

                <input type="text" class="txtNCP1" placeholder="Điều khoản dịch vụ" name="title_seo" id="title_seo" value="<?php echo $row['title_seo'];?>" onkeyup="countChar(this)"/>

            </div>

            <div>

                <p class="titleRightNCP">Thẻ mô tả</p>

                <p class="subRightNCP"><strong class="text-character"></strong>/160 ký tự</p>

                <textarea class="longtxtNCP2" name="des_seo" onkeyup="countChar(this)"><?php echo $row_showMain['des_seo'];?></textarea>

            </div>

            <p class="titleRightNCP">Đường dẫn</p>

            <div class="coverLinkNCP">

                <p class="nameLinkNCP"><?php echo $_SERVER['SERVER_NAME']?>/</p>

                <div id="slug">

                    <input type="text" id="slug1" class="txtLinkNCP" name="friendly_url" value="<?php echo $row_showMain['friendly_url'];?>" />     

                </div>

            </div>

            <p class="titleRightNCP">Keyword</p>

            <input type="text" class="txtNCP1" placeholder="Nhập keyword" name="keyword" value="<?php echo $row_showMain['keyword'];?>"/>

            <p class="titleRightNCP">Sort</p>

            <input type="number" class="txtNCP1" placeholder="Nhập sắp xếp" name="product_sort" value="<?php echo $row['product_sort'];?>"/>

        </div>

    </div><!--end rowNodeContentPage-->

    <div class="rowNodeContentPage">

        <div class="leftNCP">

            <span class="titLeftNCP">Trạng thái</span>

        </div>

        <div class="boxNodeContentPage">

            <div>

                <label class="selectCate">

                    <input type="checkbox" value="1" name="product_new" <?= $row['product_new'] == 1 ? 'checked' : '' ?>>Sản phẩm mới

                </label>

            </div>

            <div>

                <label class="selectCate">

                    <input type="checkbox" value="1" name="product_hot" <?= $row['product_hot'] == 1 ? 'checked' : '' ?>>Sản phẩm hot

                </label>

            </div>

            <div>

                <label class="selectCate">

                    <input type="checkbox" value="1" name="state" <?= $row['state'] == 1 ? 'checked' : '' ?>>Trạng thái hiển thị

                </label>

            </div>

            

        </div>

    </div><!--end rowNodeContentPage-->

    

    <button type="submit" class="btn btnSave" <?php echo ($_SESSION['admin_role']==2)?'style="display: none;"':'';?> >Lưu</button>

    <button type="button" class="btn btnDelete" id="deleteProduct" data-id="<?= $product_id?>" data-action="deleteProduct" <?php echo ($_SESSION['admin_role']==2)?'style="display: none;"':'';?> >Xóa</button>

            

</form>
<script type="text/javascript">
    function pro_vn () {
        // alert('vn');
        var title, slug;
        //alert ("a");
        //Lấy text từ thẻ input title 
        title = document.getElementById("product_name_vn").value;
        // document.getElementById('title_seo').value = title;
        //Đổi chữ hoa thành chữ thường
        slug = title.toLowerCase();
     
        //Đổi ký tự có dấu thành không dấu
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        //Xóa các ký tự đặt biệt
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        //Đổi khoảng trắng thành ký tự gạch ngang
        slug = slug.replace(/ /gi, "-");
        //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
        //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        //Xóa các ký tự gạch ngang ở đầu và cuối
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
        //In slug ra textbox có id “slug”
        document.getElementById('url_vn').value = slug;
        // document.getElementById('title_seo').value = title;
    }

    function pro_en () {
        // alert('en');
        var title, slug;
        //alert ("a");
        //Lấy text từ thẻ input title 
        title = document.getElementById("product_name_en").value;
        // document.getElementById('title_seo').value = title;
        //Đổi chữ hoa thành chữ thường
        slug = title.toLowerCase();
     
        //Đổi ký tự có dấu thành không dấu
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        //Xóa các ký tự đặt biệt
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        //Đổi khoảng trắng thành ký tự gạch ngang
        slug = slug.replace(/ /gi, "-");
        //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
        //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        //Xóa các ký tự gạch ngang ở đầu và cuối
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
        //In slug ra textbox có id “slug”
        document.getElementById('url_en').value = slug;
        // document.getElementById('title_seo').value = title;
    }
</script>
<script src='/css/chosen/chosen.jquery.js'></script>
<script >
document.getElementById('output').innerHTML = location.search;
$(".chosen-select").chosen();
//# sourceURL=pen.js
</script>
<script>
    function doi_ten_anh (pro_id) {
        // alert(pro_id);
        var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
             // document.getElementById("demo").innerHTML = this.responseText;
                alert(this.responseText);
                location.reload();
            }
          };
          xhttp.open("GET", "/download/index.php?pro_id="+pro_id, true);
          xhttp.send();
    }
</script>