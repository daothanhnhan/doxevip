<?php 
    $list = $action->getList('productcat','','','productcat_id','desc','','','');

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
<form action="" method="post" accept-charset="utf-8" id="addProductCat">
    <button class="btnAddTop" type="submit" style="position: fixed;top: 0;right: 220px;z-index: 9">Lưu</button>
    <input type="hidden" name="action" value="addProductCat">
    <div class="rowNodeContentPage">
        <div class="leftNCP">
            <span class="titLeftNCP">Nội dung trang</span>
            <p class="subLeftNCP">Nhập tiêu đề và nội dung cho trang</p>      
            <p class="titleRightNCP">Chọn ảnh</p>
            <div id="wrapper">
                <input id="fileUpload" type="file" name="fileUpload1"/>
                <br />
                <div id="image-holder">
                    
                </div>
            </div> 
        </div>
        <div class="boxNodeContentPage">
            <p class="titleRightNCP">Tiêu đề</p>
            <input type="text" class="txtNCP1" id="title" onchange="ChangeToSlug()" value="<?= $row['productcat_name'];?>" name="productcat_name"/>
            <div class="subColContent">
                <p class="titleRightNCP">Danh mục cha</p>
                <select class="sltBV" name="productcat_parent" size="10">
                    <option value="0" selected>Cấp cha</option>
                    <?php $action->showCategoriesSelect($list, 'productcat_parent', 0, '', 'productcat_id', 'productcat_name', 0); ?>
                </select>
            </div>
            <p class="titleRightNCP">Mô tả</p>
            <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP1 ckeditor" id="editor1" name="productcat_des" ><?= $row['productcat_des'];?></textarea></p>
            <p class="titleRightNCP">Chi tiết</p>
            <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP1 ckeditor" id="editor2" name="productcat_content" ><?= $row['productcat_content'];?></textarea></p>


            <div class="leftNCP" style="width: 100%;">
                <p class="titleRightNCP">Chọn ảnh đại diện danh mục</p>
                <div id="wrapper">
                    <input id="fileUpload2" type="file" name="fileUpload2"/>
                </div> 
            </div>
            <br>
            <div class="leftNCP" style="width: 100%;">
                <p class="titleRightNCP">Ảnh chính danh mục</p>
                <div id="wrapper">
                    <input id="fileUpload3" type="file" name="fileUpload3"/>
                </div> 
            </div>
            <br>
            <div class="leftNCP" style="width: 100%;">
                <p class="titleRightNCP">Ảnh phụ danh mục</p>
                <div id="wrapper">
                    <input id="fileUpload4" type="file" name="fileUpload4"/>
                </div> 
            </div>
            <br>
            <div class="leftNCP" style="width: 100%;">
                <p class="titleRightNCP">Chọn ảnh banner danh mục</p>
                <div id="wrapper">
                    <input id="fileUpload3" type="file" name="fileUpload3"/>
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
                <p class="subRightNCP"> <strong class="text-character">0</strong>/70 ký tự</p>
                <input type="text" class="txtNCP1" placeholder="Điều khoản dịch vụ" name="title_seo" id="title_seo" value="<?php echo $row['title_seo'];?>" onkeyup="countChar(this)"/>
            </div>
            <div>
                <p class="titleRightNCP">Thẻ mô tả</p>
                <p class="subRightNCP"><strong class="text-character">0</strong>/160 ký tự</p>
                <textarea class="longtxtNCP2" name="des_seo" onkeyup="countChar(this)"><?php echo $row['des_seo'];?></textarea>
            </div>
            <p class="titleRightNCP">Keyword</p>
            <input type="text" class="txtNCP1"  name="keyword" value="<?php echo $row['keyword']?>"/>
            <p class="titleRightNCP">Đường dẫn</p>
            <div class="coverLinkNCP">
                <div id="slug">
                    <input type="text" id="slug1" class="txtLinkNCP" name="friendly_url" value="<?php echo $row['friendly_url']?>"/> 
                </div>    
            </div>
            <p class="titleRightNCP">Sort</p>
            <input type="text" class="txtNCP1"  name="productcat_sort_order" value="<?php echo $row['productcat_sort_order']?>"/>
        </div>
    </div><!--end rowNodeContentPage-->
    <div class="rowNodeContentPage">
        <div class="leftNCP">
            <span class="titLeftNCP">Trạng thái</span>
            <p class="subLeftNCP">Thiết lập chế độ hiển thị cho trang nội dung</p>                
        </div>
        <div class="boxNodeContentPage">
            <label class="selectCate">
                <input type="checkbox" value="1" name="state" checked>
                Hoạt động
            </label>
        </div>
    </div><!--end rowNodeContentPage-->
    <button type="submit" class="btn btnSave">Lưu</button>

</form>


