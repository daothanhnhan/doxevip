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

    <button class="btnAddTop" type="submit" style="position: fixed;top: 0;right: 220px;z-index: 9">L??u</button>

    <input type="hidden" name="action" value="addProduct">

    <input type="hidden" name="table" id="table" value="product">

    <div class="rowNodeContentPage">

        <div class="leftNCP">

            <span class="titLeftNCP">Th??ng tin s???n ph???m</span>

            <p class="subLeftNCP">Cung c???p th??ng tin v??? t??n, m?? t??? lo???i s???n ph???m v?? nh?? s???n xu???t ????? ph??n lo???i s???n ph???m</p>   

            <p class="titleRightNCP">Ch???n ???nh ?????i di???n cho s???n ph???m</p>

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



            <p class="titleRightNCP">T??n s???n ph???m</p>

            <input type="text" id="title" onchange="ChangeToSlug()" class="txtNCP1" value="<?= $product['name'] ?>" name="product_name" required/>
            <input type="hidden" name="kiotviet_id" value="<?= $_GET['id_kv'] ?>">

            <!-- <p class="titleRightNCP">Danh m???c</p>
            <select class="sltBV" name="productcat_id" size="10">
                <?php $action->showCategoriesSelect($list, 'productcat_parent', 0, '', 'productcat_id', 'productcat_name', 0); ?>
            </select> -->

            <p class="titleRightNCP">Danh m???c</p>
            <div class="sltBV" name="productcat_id" size="10">
                <?php $action->showProductCategoriesSelect($list, 'productcat_parent', 0, $row['productcat_id'], 'productcat_id', 'productcat_name', 0, $row['productcat_ar']); ?>
                
            </div>


            <!-- <p class="titleRightNCP">T??n r??t g???n</p>

            <input type="text" class="txtNCP1" name="shortName1_service3" value="<?php //echo $rowPro['shortName1_service3'];?>" /> -->

            <p class="titleRightNCP">Th??ng tin khuy???n m??i:</p>

            <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP2 ckeditor" id="editor0" name="product_des"><?php echo $rowPro['product_des'];?></textarea></p>

            

            <p class="titleRightNCP">M?? t??? s???n ph???m:</p>

            <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP1 ckeditor" id="editor1" name="product_content"><?php echo $rowPro['product_content'];?></textarea></p>

            <p class="titleRightNCP">B???o h??nh:</p>
            <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP1 ckeditor1" id="editor2" name="product_sub_info1"></textarea></p>

            <p class="titleRightNCP">Kho h??ng:</p>
            <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP1 ckeditor1" id="editor3" name="product_sub_info2"></textarea></p>

            <p class="titleRightNCP">?????c ??i???m n???i b???t:</p>

            <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP1 ckeditor" id="editor4" name="product_sub_info3"></textarea></p>

            <p class="titleRightNCP">Th??ng s??? k??? thu???t:</p>

            <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP1 ckeditor" id="editor5" name="product_sub_info4"></textarea></p>

            <p class="titleRightNCP">Video:</p>

            <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP1 ckeditor" id="editor6" name="product_sub_info5"></textarea></p>

        </div>

    </div><!--end rowNodeContentPage-->

    <div class="rowNodeContentPage">

        <div class="leftNCP">

            <span class="titLeftNCP">Qu???n l?? thu???c t??nh v?? t??y ch???n</span>

            <p class="subLeftNCP">B???n c?? th??? c???u h??nh v?? qu???n l?? thu???c t??nh cho t???ng lo???i c???a s???n ph???m n??y</p>

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
                        <option value="0">==Ch???n thu???c t??nh==</option>
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

            <span class="titLeftNCP">Tag s???n ph???m</span>

            <p class="subLeftNCP">Thi???t l???p tag cho s???n ph???m</p>

        </div>

        <div class="boxNodeContentPage">

            <h3>Tag s???n ph???m</h3>

            <select name="producttag[]" class="txtNCP1 chosen-select" data-placeholder="Ch???n tag s???n ph???m" multiple>
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

            <span class="titLeftNCP">???nh s???n ph???m</span>

            <p class="subLeftNCP">Thi???t l???p ???nh s???n ph???m</p>

        </div>

        <div class="boxNodeContentPage">

            <h3>???nh ph??? s???n ph???m</h3>

            <input type="file" name="fileUpload2" id="fileUpload2">

            <div class="preview2" id="preview2"> 

            </div>

        </div>

    </div><!--end rowNodeContentPage-->


    <div class="rowNodeContentPage" style="display: none;">

        <div class="leftNCP">

            <span class="titLeftNCP">???nh s???n ph???m</span>

            <p class="subLeftNCP">Thi???t l???p ???nh ?????i di???n s???n ph???m</p>

        </div>

        <div class="boxNodeContentPage">

            <h3>???nh ?????i di???n s???n ph???m</h3>

            <input type="file" name="fileUpload3" id="fileUpload3">

            <div class="preview2" id="preview2"> 

            </div>

        </div>

    </div>



    <!-- <div class="rowNodeContentPage">

        <div class="leftNCP">

            <span class="titLeftNCP">Thi???t l???p k??ch c??? v?? m??u s???c</span>

            <p class="subLeftNCP">Thi???t l???p k??ch c??? v?? m??u s???c</p>

        </div>

        <div class="boxNodeContentPage">

            <div class="rowNCP" id="color_section">

            </div>

            <a href="#" id="addMoreColor" class="addMoreColor">Th??m t??y ch???n m??u</a>

        </div>

    </div> --><!--end rowNodeContentPage-->

    

    <div class="rowNodeContentPage">

        <div class="leftNCP">

            <span class="titLeftNCP">Qu???n l?? kho v?? t??y ch???n</span>

            <p class="subLeftNCP">B???n c?? th??? c???u h??nh v?? qu???n l?? kho cho t???ng lo???i c???a s???n ph???m n??y</p>

        </div>

        <div class="boxNodeContentPage">

            <div class="rowNCP">

                <div class="subColContent">

                    <p class="titleRightNCP">Gi?? g???c (VN??)</p>

                    <input type="number" class="txtNCP1" value="" name="product_price"/>

                </div>                                      

                <div class="subColContent" >

                    <p class="titleRightNCP">Khuy???n m??i (%)</p>

                    <input type="number" class="txtNCP1" value="<?php echo $rowPro['product_price_sale'];?>" name="product_price_sale"/>

                </div>         

                

                

            </div><!--end rowNCP-->

            <div class="rowNCP">

                <div class="subColContent">

                    <p class="titleRightNCP">M?? s???n ph???m</p>

                    <input type="text" class="txtNCP1" value="<?php echo $rowPro['product_code'];?>" name="product_code"/>

                </div>                                      

                <!-- <div class="subColContent" >

                    <p class="titleRightNCP">Xu???t x???</p>

                    <input type="text" class="txtNCP1" value="<?php echo $rowPro['product_original'];?>" name="product_original"/>

                </div> -->           

                <div class="subColContent" >

                    <p class="titleRightNCP">Khuy???n m??i</p>

                    <input type="text" class="txtNCP1" value="<?php echo $rowPro['product_shape'];?>" name="product_shape"/>

                </div>    

            </div><!--end rowNCP-->

            <div class="rowNCP">

                <!-- <div class="subColContent">

                    <p class="titleRightNCP">K??ch c???</p>

                    <input type="text" class="txtNCP1" value="<?php echo $rowPro['product_size'];?>" name="product_size"/>

                </div>                                      

                <div class="subColContent" >

                    <p class="titleRightNCP">????ng g??i</p>

                    <input type="text" class="txtNCP1" value="<?php echo $rowPro['product_package'];?>" name="product_package"/>

                </div>  -->

                <div class="subColContent">

                    <p class="titleRightNCP">H??ng s???n xu???t</p>

                    <input type="text" class="txtNCP1" value="<?php echo $rowPro['product_expiration'];?>" name="product_expiration"/>

                </div>

                <div class="subColContent" >

                    <p class="titleRightNCP">Xu???t x???</p>

                    <input type="text" class="txtNCP1" value="<?php echo $rowPro['product_material'];?>" name="product_material"/>

                </div>                

            </div><!--end rowNCP-->

            <div class="rowNCP">                 

                <div class="subColContent" >

                    <p class="titleRightNCP">X??y d???ng m??y t??nh</p>

                    <select name="xay_dung" class="txtNCP1">
                        <option value="0">==Ch???n x??y d???ng m??y t??nh==</option>
                        <?php foreach ($list_xaydung as $item) { ?>
                        <option value="<?= $item['id'] ?>" ><?= $item['name'] ?></option>
                        <?php } ?>
                    </select>

                </div>            

                <div class="subColContent" >

                    <p class="titleRightNCP">T??nh tr???ng h??ng</p>

                    <select name="has" class="txtNCP1">
                        <option value="1">C??n h??ng</option>
                        <option value="0">H???t h??ng</option>
                    </select>

                </div>  

            </div><!--end rowNCP-->

            <!-- <div class="rowNCP">

                <div class="subColContent">

                    <p class="titleRightNCP">Giao h??ng</p>

                    <input type="text" class="txtNCP1" value="<?php echo $rowPro['product_delivery'];?>" name="product_delivery"/>

                </div>                                      

                <div class="subColContent" >

                    <p class="titleRightNCP">Th???i gian giao h??ng</p>

                    <input type="text" class="txtNCP1" value="<?php echo $rowPro['product_delivery_time'];?>" name="product_delivery_time"/>

                </div>               

            </div> --><!--end rowNCP-->

            <!-- <div class="rowNCP">

                <div class="subColContent">

                    <p class="titleRightNCP">H??nh th???c thanh to??n</p>

                    <input type="text" class="txtNCP1" value="<?php echo $rowPro['product_payment'];?>" name="product_payment"/>

                </div>                                      

                           

            </div> --><!--end rowNCP-->

        </div>

    </div>



    <div class="rowNodeContentPage">

        <div class="leftNCP">

            <span class="titLeftNCP">T???i ??u SEO</span>

            <p class="subLeftNCP">Thi???t l???p th??? ti??u ?????, th??? m?? t???, ???????ng d???n. Nh???ng th??ng tin n??y x??c ?????nh c??ch danh m???c xu???t hi???n tr??n c??ng c??? t??m ki???m.</p>                

        </div>

        <div class="boxNodeContentPage">

            <div>

                <p class="titleRightNCP">Ti??u ????? trang</p>

                <p class="subRightNCP"> <strong class="text-character"></strong>/70 k?? t???</p>

                <input type="text" class="txtNCP1" placeholder="??i???u kho???n d???ch v???" name="title_seo" id="title_seo" value="<?= $product['name'] ?>" onkeyup="countChar(this)"/>

            </div>

            <div>

                <p class="titleRightNCP">Th??? m?? t???</p>

                <p class="subRightNCP"><strong class="text-character"></strong>/160 k?? t???</p>

                <textarea class="longtxtNCP2" name="des_seo" onkeyup="countChar(this)"><?php echo $rowPro['des_seo'];?></textarea>

            </div>

            <p class="titleRightNCP">???????ng d???n</p>

            <div class="coverLinkNCP">

                <p class="nameLinkNCP"><?php echo $_SERVER['SERVER_NAME']?>/</p>

                <div id="slug">

                    <input type="text" id="slug1" class="txtLinkNCP" name="friendly_url" value="<?php echo $action->vi_en1($product['name']);?>" />     

                </div>

            </div>

            <p class="titleRightNCP">Keyword</p>

            <input type="text" class="txtNCP1" placeholder="Nh???p keyword" name="keyword" value="<?php echo $rowPro['keyword'];?>"/>

        </div>

    </div><!--end rowNodeContentPage-->

    <div class="rowNodeContentPage">

        <div class="leftNCP">

            <span class="titLeftNCP">Tr???ng th??i</span>

        </div>

        <div class="boxNodeContentPage">

            <div>

                <label class="selectCate">

                    <input type="checkbox" value="1" name="product_new" <?= $rowPro['product_new'] == 1 ? 'checked' : '' ?>>S???n ph???m m???i

                </label>

            </div>

            <div>

                <label class="selectCate">

                    <input type="checkbox" value="1" name="product_hot" <?= $rowPro['product_hot'] == 1 ? 'product_hot' : '' ?>>S???n ph???m hot

                </label>

            </div>

            <div>

                <label class="selectCate">

                    <input type="checkbox" value="1" name="state" checked>Tr???ng th??i hi???n th???

                </label>

            </div>

            

        </div>

    </div><!--end rowNodeContentPage-->

    

    <button type="submit" class="btn btnSave">L??u</button>

            

</form>
<script src='/css/chosen/chosen.jquery.js'></script>
<script >
document.getElementById('output').innerHTML = location.search;
$(".chosen-select").chosen();
//# sourceURL=pen.js
</script>