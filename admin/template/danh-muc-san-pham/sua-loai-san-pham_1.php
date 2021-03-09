
<?php
    $productcat_id = isset($_GET['id']) ? $_GET['id'] : '';
    $row = $action->getDetail_New('productcat', array('productcat_id'), array(&$productcat_id), 'i');
    if ($row == '') {
        header('location: index.php?page=sua-danh-muc-san-pham');
    }
    $list = $action->getList('productcat','','','productcat_id','desc','','','');
    $languages = $action->getListLanguages();

    $action_showMain = new action_page('VN');
    $lang_showMain = "vn";
    $row_showMain = $action_showMain->getDetail_New('productcat_languages',array('productcat_id','languages_code'),array(&$row['productcat_id'], &$lang_showMain),'is');

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



        

        $("input[id=fileUpload21").previewimage({

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
<form action="" id="updateLangProductCat">
    <input type="hidden" name="action" value="updateLangProductCat">
    <input type="hidden" name="productcat_id" value="<?= $row['productcat_id']?>">
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
                                    $action1 = new action_page('VN');
                                    $rowDetailLang = $action1->getDetail_New('productcat_languages',array('productcat_id','languages_code'),array(&$row['productcat_id'], &$lang['languages_code']),'is');
                                    
                                ?>
                                    <div role="tabpanel" class="tab-pane <?= $key == 0 ? 'active' : ''?>" id="<?= $lang['languages_code']?>">
                                        
                                        <input type="hidden" name="lang[<?= $lang['languages_code']?>][lang_productcat_sub_info1]" value="">
                                        <input type="hidden" name="lang[<?= $lang['languages_code']?>][lang_productcat_sub_info2]" value="">
                                        <input type="hidden" name="lang[<?= $lang['languages_code']?>][lang_productcat_sub_info3]" value="">
                                        <input type="hidden" name="lang[<?= $lang['languages_code']?>][lang_productcat_sub_info4]" value="">
                                        <input type="hidden" name="lang[<?= $lang['languages_code']?>][lang_productcat_sub_info5]" value="">
                                        <p class="titleRightNCP">Tiêu đề</p>
                                        <input type="text" class="txtNCP1" value="<?= $rowDetailLang['lang_productcat_name'];?>" name="lang[<?= $lang['languages_code']?>][lang_productcat_name]"/>
                                        <p class="titleRightNCP">Mô tả ngắn</p> 
                                        <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP1 ckeditor" id="editor1" name="lang[<?= $lang['languages_code']?>][lang_productcat_des]" ><?= $rowDetailLang['lang_productcat_des'];?></textarea></p>
                                        <p class="titleRightNCP">Chi tiết</p> 
                                        <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP1 ckeditor" id="editor2" name="lang[<?= $lang['languages_code']?>][lang_productcat_content]" ><?= $rowDetailLang['lang_productcat_content'];?></textarea></p>
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

<form action="" method="post" accept-charset="utf-8" id="updateProductCat">
    <button class="btnAddTop" type="submit" style="position: fixed;top: 0;right: 220px;z-index: 9;<?php echo ($_SESSION['admin_role']==2)?'display: none;':'';?>">Lưu</button>
    <a class="btnAddTop" data-toggle="modal" href='#modal-id' style="position: fixed;top: 0;right: 285px;z-index: 9;<?php echo ($hidden_multi_lang=='hidden')?'display: none;':'';?>">Chỉnh sửa ngôn ngữ</a>
    <input type="hidden" name="productcat_id" value="<?php echo $productcat_id;?>"/>
    <input type="hidden" name="action" value="updateProductCat">
    <div class="rowNodeContentPage">
        <div class="leftNCP">
            <span class="titLeftNCP">Nội dung trang</span>
            <p class="subLeftNCP">Nhập tiêu đề và nội dung cho trang</p>      
            <p class="titleRightNCP">Chọn ảnh</p>
            <div id="wrapper">
                <input id="fileUpload" type="file" name="fileUpload1"/>
                <br />
                <div id="image-holder">
                    <?php 
                        if ($row['productcat_img'] != '') {
                        ?>
                            <img src="../images/<?= $row['productcat_img']?>" class="img-responsive" alt="Image">
                            <input type="hidden" name="productcat_img" value="<?= $row['productcat_img']?>">
                        <?php
                        }
                    ?>
                </div>
            </div> 
        </div>
        
        <div class="boxNodeContentPage">
            <p class="titleRightNCP">Tiêu đề</p>
            <input type="text" class="txtNCP1" id="title" onchange="ChangeToSlug()" value="<?= $row_showMain['lang_productcat_name'];?>" name="productcat_name"/>
            <div class="subColContent">
                <p class="titleRightNCP">Danh mục cha</p>
                <select class="sltBV" name="productcat_parent" size="10">
                    <option value="0" <?= $row['productcat_parent'] == 0 ? 'selected' : ''?>>Cấp cha</option>
                    <?php $action->showCategoriesSelect($list, 'productcat_parent', 0, $row['productcat_parent'], 'productcat_id', 'productcat_name', 0); ?>
                </select>
            </div>
            <p class="titleRightNCP">Mô tả</p>
            <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP1 ckeditor" id="editor1" name="productcat_des" ><?= $row_showMain['lang_productcat_des'];?></textarea></p>
            <!-- <textarea class="longtxtNCP2" name="productcat_des"><?php echo $row_showMain['lang_productcat_des'];?></textarea> -->
            <p class="titleRightNCP">Chi tiết</p>
            <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP1 ckeditor" id="editor2" name="productcat_content" ><?= $row_showMain['lang_productcat_content'];?></textarea></p> 

            <div class="leftNCP" style="width: 100%;">
                <p class="titleRightNCP">Chọn ảnh đại diện danh mục</p>
                <div id="wrapper">
                    <input id="fileUpload2" type="file" name="fileUpload2"/>
                    <br />
                    <div id="image-holder">
                        <?php 
                            if ($row['productcat_sub'] != '') {
                            ?>
                                <img src="../images/<?= $row['productcat_sub']?>" class="img-responsive" alt="Image">
                                <input type="hidden" name="productcat_sub" value="<?= $row['productcat_sub']?>">
                            <?php
                            }
                        ?>
                    </div>
                </div> 
            </div>
            <br>
            <div class="leftNCP" style="width: 100%;">
                <p class="titleRightNCP">Ảnh chính danh mục</p>
                <div id="wrapper">
                    <input id="fileUpload4" type="file" name="fileUpload4"/>
                    <br />
                    <div id="image-holder">
                        <?php 
                            if ($row['productcat_main_img'] != '') {
                            ?>
                                <img src="../images/<?= $row['productcat_main_img']?>" class="img-responsive" alt="Image">
                                <input type="hidden" name="productcat_main_img" value="<?= $row['productcat_main_img']?>">
                            <?php
                            }
                        ?>
                    </div>
                </div> 
            </div>
            <br>
            <div class="leftNCP" style="width: 100%;">
                <p class="titleRightNCP">Ảnh phụ danh mục</p>
                <div id="wrapper">
                    <input id="fileUpload5" type="file" name="fileUpload5"/>
                    <br />
                    <div id="image-holder">
                        <?php 
                            if ($row['productcat_sub_img'] != '') {
                            ?>
                                <img src="../images/<?= $row['productcat_sub_img']?>" class="img-responsive" alt="Image">
                                <input type="hidden" name="productcat_sub_img" value="<?= $row['productcat_sub_img']?>">
                            <?php
                            }
                        ?>
                    </div>
                </div> 
            </div>
            <br>
            <div class="leftNCP" style="width: 100%;">
                <p class="titleRightNCP">Chọn ảnh banner danh mục</p>
                <div id="wrapper">
                    <input id="fileUpload3" type="file" name="fileUpload3"/>
                    <br />
                    <div id="image-holder">
                        <?php 
                            if ($row['productcat_banner_img'] != '') {
                            ?>
                                <img src="../images/<?= $row['productcat_banner_img']?>" class="img-responsive" alt="Image">
                                <input type="hidden" name="productcat_banner_img" value="<?= $row['productcat_banner_img']?>">
                            <?php
                            }
                        ?>
                    </div>
                </div> 
            </div>
        </div>
    </div><!--end rowNodeContentPage-->

    <div class="rowNodeContentPage">

        <div class="leftNCP">

            <span class="titLeftNCP">Ảnh phụ danh mục sản phẩm</span>

            <p class="subLeftNCP">Thiết lập ảnh phụ cho danh mục sản phẩm</p>

        </div>

        <div class="boxNodeContentPage">

            <h3>Ảnh phụ danh mục sản phẩm</h3>

            

            <input type="file" name="fileUpload21" id="fileUpload21">

            <div class="preview2" id="preview2"> 

                <?php

                    $array = json_decode($row['productcat_sub_img1'], true);

                    foreach ($array as $key => $val) {

                        $img = json_decode($val, true);

                        if ($img != '') {

                            ?>

                                <div class="sub_image_product">

                                    <input type="hidden" name="subImage[]" value="<?= $img['image']?>">

                                    <img src="../images/<?= $img['image']?>" alt="">

                                    <p data-upload-preview="fileUpload21[]-0" style="cursor: pointer;">Xóa ảnh</p>

                                </div>

                            <?php                            

                        }

                    }

                ?>

            </div>

        </div>

    </div><!--end rowNodeContentPage-->

    <div class="rowNodeContentPage">
        <div class="leftNCP">
            <span class="titLeftNCP">Tối ưu SEO</span>
            <p class="subLeftNCP">Thiết lập thẻ tiêu đề, thẻ mô tả, đường dẫn. Những thông tin này xác định cách danh mục xuất hiện trên công cụ tìm kiếm.</p>                
        </div>
        <div class="boxNodeContentPage">
            <div>
                <p class="titleRightNCP">Tiêu đề trang</p>
                <p class="subRightNCP">Số ký tự đã dùng: <strong class="text-character">0</strong>/70</p>
                <input type="text" class="txtNCP1" value="<?php echo $row_showMain['title_seo'];?>" id="title_seo" name="title_seo" onkeyup="countChar(this)"/>
            </div>
            <p class="titleRightNCP">Thẻ mô tả</p>
            <p class="subRightNCP">Số ký tự đã dùng: <strong class="text-character">0</strong>/160</p>
            <textarea class="longtxtNCP2" name="des_seo"  onkeyup="countChar(this)"><?php echo $row_showMain['des_seo'];?></textarea>
            <p class="titleRightNCP">Keyword</p>
            <input type="text" class="txtNCP1"  name="keyword" value="<?php echo $row_showMain['keyword']?>"/>
            <p class="titleRightNCP">Đường dẫn</p>
            <div class="coverLinkNCP">
                <div  id="slug">
                    <input type="text" id="slug1" class="txtLinkNCP" name="friendly_url" value="<?php echo $row_showMain['friendly_url']?>"/> 
                </div>    
            </div>
            <p class="titleRightNCP">Sort</p>
            <input type="text" class="txtNCP1"  name="productcat_sort_order" value="<?php echo $row['productcat_sort_order']?>"/>
        </div>
    </div><!--end rowNodeContentPage-->
   
    <div class="rowNodeContentPage">
        <div class="leftNCP">
            <span class="titLeftNCP">Trạng thái</span>
        </div>
        <div class="boxNodeContentPage">
            <div>
                <label class="selectCate">
                    <input type="checkbox" value="1" name="state" <?= $row['state'] == 1 ? 'checked' : '' ?>>Trạng thái hiển thị
                </label>
            </div>
            
        </div>
    </div><!--end rowNodeContentPage-->
    
    <button type="submit" class="btn btnSave" <?php echo ($_SESSION['admin_role']==2)?'style="display: none;"':'';?> >Lưu</button>
    <button type="button" class="btn btnDelete" id="deleteProductCat" data-id="<?= $productcat_id?>" data-action="deleteProductCat" <?php echo ($_SESSION['admin_role']==2)?'style="display: none;"':'';?> >Xóa</button>
</form>


