<?php 
// echo $_SERVER['SERVER_NAME'];
    $action_product = new action_product(); 

    $slug = isset($_GET['slug']) ? $_GET['slug'] : '';



    $rowLang = $action_product->getProductLangDetail_byUrl($slug,$lang);

    $row = $action_product->getProductDetail_byId($rowLang[$nameColIdProduct_productLanguage],$lang);

    $_SESSION['productcat_id_relate'] = $row[$nameColIdProductCat_product];

    $_SESSION['sidebar'] = 'productDetail';

    $arr_id = $row['productcat_ar'];

    $arr_id = json_decode($arr_id);

    $productcat_id = (int)$arr_id[0];



    

    $product_breadcrumb = $action_product->getProductCatLangDetail_byId($productcat_id, $lang);

    $breadcrumb_url = $product_breadcrumb['friendly_url'];

    $breadcrumb_name = $product_breadcrumb['lang_productcat_name'];

    $use_breadcrumb = true;



    $img_sub = json_decode($row['product_sub_img']);

    //////// kv //



    ///// tag //

    $producttag_arr = json_decode($row['producttag_arr']);
    //////////////////////
    $anh_chinh = json_decode($row['product_des2']);
    $anh_tinh_nang = json_decode($row['product_sub_info1']);
    $gia_tinh_nang = json_decode($row['product_sub_info2']);
    $gia_tinh_nang_giam = json_decode($row['product_content2']);
    $ten_anh = json_decode($row['product_des3']);
    $ten_anh_doi = json_decode($row['ten_anh_doi']);//var_dump($ten_anh);
    $ten_anh_taobao = json_decode($row['anh_taobao_1']);//var_dump($ten_anh_taobao);

    // $sp_link = $anh_chinh[0];
    if (!empty($row['ten_anh_doi'])) {
      $anh_chinh = array();
      foreach ($ten_anh_doi as $item) {
        $anh_chinh[] = 'http://'.$_SERVER['SERVER_NAME'].'/download/images/'.$item;
      }
    }
    $sp_link = $anh_chinh[0];
    ////////////////////
    if (!empty($row['anh_taobao_1'])) {
      $anh_tinh_nang = array();
      foreach ($ten_anh_taobao as $item) {
        $anh_tinh_nang[] = 'http://'.$_SERVER['SERVER_NAME'].'/download/taobao/'.$item;
      }
    }
    ////////////////////
    if (!empty($row['hien_thi_tinh_nang'])) {
      $hien_thi_tinh_nang = json_decode($row['hien_thi_tinh_nang']);//var_dump($hien_thi_tinh_nang);
      foreach ($anh_tinh_nang as $k => $v) {
        // echo $anh_tinh_nang[$k];
        if ($hien_thi_tinh_nang[$k] == 0) {
          unset($anh_tinh_nang[$k]);
          unset($ten_anh[$k]);
          unset($gia_tinh_nang[$k]);
        }
      }
    }
    // var_dump($ten_anh);
    ////////////////////
    // $tinh_nang_1 = json_decode($row['tinh_nang_2'], true);
    
    ////////////////////

    function da_xem ($id) {
      if (!isset($_SESSION['da_xem'])) {
        $_SESSION['da_xem'] = array();
        $_SESSION['da_xem'][] = $id;
      } else {
        if (empty($_SESSION['da_xem'])) {
          $_SESSION['da_xem'][] = $id;
        } else {
          if (!in_array($id, $_SESSION['da_xem'])) {
            array_unshift($_SESSION['da_xem'], $id);
          }
        }
      }
    }
    da_xem($row['product_id']);
?>

<?php 

    $action_lang = new action_lang();

    $url_lang = $action_lang->get_url_lang_productDetail($slug, $lang);
    // var_dump($row['gia_tinh_nang_2']);
?>

<script type="text/javascript">

   $(document).ready(function(data){  

      $('.btn_addCart').click(function(){  

           var product_id = $('#product_id').val();

           var product_name = $('#product_name').val();  

           var product_price = $('#product_price').val();  

           var product_link = $('#product_link').val();  

           var product_quantity = $('.number_cart').val();  

           var action = "add";

           if(product_quantity > 0)  

           {                  

                 $.ajax({  

                     url:"/functions/ajax.php?action=add_cart",  

                     method:"POST",

                     dataType:"json",  

                     data:{  

                          product_id:product_id,   

                          product_name:product_name,   

                          product_price:product_price,   

                          product_link:product_link,   

                          product_quantity:product_quantity,   

                          action:action  

                     },  

                     success:function(data)  

                     {  

                          // if (confirm('Thêm sản phẩm thành công, bạn có muốn thanh toán luôn không')) {

                              // window.location = '/gio-hang';

                          // }else{

                              location.reload();

                          // }  

                     },

                     error: function () {

                        alert('loi');

                     }  

                });  



           }  

           else  

           {  

                alert("Mời bạn nhập số lượng sản phẩm");

           }  

      });

   });

 </script>

 <script type="text/javascript">

   $(document).ready(function(data){  

      $('.btn_addCart1').click(function(){  

           var product_id = $('#product_id').val();

           var product_name = $('#product_name').val();  

           var product_price = $('#product_price').val();  

           var product_link = $('#product_link').val();

           var product_quantity = $('.number_cart').val();  

           var action = "add";

           if(product_quantity > 0)  

           {                  

                 $.ajax({  

                     url:"/functions/ajax.php?action=add_cart",  

                     method:"POST",

                     dataType:"json",  

                     data:{  

                          product_id:product_id,   

                          product_name:product_name,   

                          product_price:product_price,   

                          product_link:product_link,   

                          product_quantity:product_quantity,   

                          action:action  

                     },  

                     success:function(data)  

                     {  

                          // if (confirm('Thêm sản phẩm thành công, bạn có muốn thanh toán luôn không')) {

                              window.location = '/gio-hang';

                          // }else{

                              // location.reload();

                          // }  

                     },

                     error: function () {

                        alert('loi');

                     }  

                });  



           }  

           else  

           {  

                alert("Mời bạn nhập số lượng sản phẩm");

           }  

      });

   });

 </script>

<link rel="stylesheet" href="/plugin/slickNav/slicknav.css"/>

<link rel="stylesheet" href="/plugin/slick/slick.css"/>

<link rel="stylesheet" href="/plugin/slick/slick-theme.css"/>

<style type="text/css">

.gb-chitiet_sanpham_mptoto-body .slider-nav img {

  /*padding: 0;*/

  /*width: 111px;*/

  /*max-width: none;*/

}

.slider-nav .slick-active {

  /*width: 112px !important;*/

}

#tab_default_32 table tr td {

  border: 1px solid #333;

  padding: 10px 5px;

}

#tab_default_32, #tab_default_33 {

  margin-top: 20px;

  float: left;

  width: 100%;

}

#tab_default_34 {

  float: left;

  width: 100%;

}

#tab_default_33 img {
  display: block;
  margin-left: auto;
  margin-right: auto;
}

</style>

<?php include DIR_BREADCRUMBS."MS_BREADCRUMS_MPTOTO_0003.php";?>

<?php //include DIR_CONTACT."MS_CONTACT_HOME_001.php";?>    

<div class="gb-chitiet_sanpham_mptoto">

    <div class="gb-chitiet_sanpham_mptoto-body">

        <div class="container">

            <div class="gb-chitiet_sanpham_mptoto-left"> 

                <div class="row">

                    <div class="col-md-12">

                      <div class="row">

                        <div class="col-md-6">
                          <h1 class="titleProductPPD"><?= $rowLang['lang_product_name'] ?></h1> 

                            <div class="gb-chitiet_sanpham_MPTOTO_left-img">

                                <div class="uni-single-car-gallery-images" id="anh-show-slide">

                                    <div class="slider slider-for">


                                      <?php if (!empty($row['product_img'])) { ?>
                                        <div class="slide-item"><img src="/images/product/<?= $row['product_img'] ?>" alt="" class="img-responsive img1" data-zoom-image="/images/product/<?= $row['product_img'] ?>"></div>
                                      <?php } ?>  

                                      <?php 
                                      $d = 1;
                                      foreach ($img_sub as $item) {
                                          $d++;
                                          $image = json_decode($item, true);?>
                                    <div class="slide-item"><img src="/images/<?= $image['image'] ?>" alt="" class="img-responsive img<?= $d ?>" data-zoom-image="/images/<?= $image['image'] ?>"></div>
                                    <?php } ?>

                                        <?php 

                                            $d = 0;

                                            foreach ($anh_chinh as $item) {

                                                $d++;
                                                
                                                if (strpos($item,"http")===false) {
                                                  $item = 'http:'.$item;
                                                } else {
                                                  
                                                }

                                        ?>

                                            <div class="slide-item">
                                                <?php if (empty($row['ten_anh_doi'])) { ?>
                                                <img src="http://<?= $_SERVER['SERVER_NAME'] ?>/watermark/index.php?anh=<?= $item ?>" alt="" class="img-responsive img1" data-zoom-image="<?= $item ?>">
                                              <?php } else { ?>
                                                <img src="<?= $item ?>" alt="" class="img-responsive img1" data-zoom-image="<?= $item ?>">
                                              <?php } ?>
                                            </div>

                                        <?php } ?>

                                        <?php 

                                            $d = 0;

                                            foreach ($anh_tinh_nang as $item) {
                                              if ($item == 'no-image.jpg' || empty($item)) {
                                                continue;
                                              }
                                                $d++;
                                              if (strpos($item,"http")===false) {
                                                  $item = 'http:'.$item;
                                                }

                                        ?>

                                            <div class="slide-item">
                                                <?php if (empty($row['anh_taobao_1'])) { ?>
                                                <img src="http://<?= $_SERVER['SERVER_NAME'] ?>/watermark/index.php?anh=<?= $item ?>" alt="" class="img-responsive img1" data-zoom-image="<?= $item ?>">
                                                <?php } else { ?>
                                                  <img src="<?= $item ?>" alt="" class="img-responsive img1" data-zoom-image="<?= $item ?>">
                                                <?php } ?>
                                            </div>

                                        <?php } ?>

                                    </div>

                                    <div class="slider slider-nav">

                                        <?php if (!empty($row['product_img'])) { ?>
                                        <div class="slide-item"><img src="/images/product/<?= $row['product_img'] ?>" alt="" class="img-responsive img1" data-zoom-image="/images/product/<?= $row['product_img'] ?>"></div>
                                      <?php } ?>

                                      <?php
                                    $d = 1; 
                                    foreach ($img_sub as $item) {
                                        $d++;
                                        $image = json_decode($item, true);?>
                                    <div class="slide-item"><img src="/images/<?= $image['image'] ?>" alt="<?= $d ?>" class="img-responsive" data-zoom-image="/images/<?= $image['image'] ?>"></div>
                                    <?php } ?>

                                        <?php 

                                            $d = 0;

                                            foreach ($anh_chinh as $item) {

                                                $d++;

                                        ?>

                                            <div class="slide-item">

                                                <img src="<?= $item ?>" alt="" class="img-responsive img1" data-zoom-image="<?= $item ?>">

                                            </div>

                                        <?php } ?>

                                        <?php 

                                            $d = 0;

                                            foreach ($anh_tinh_nang as $item) {
                                              if ($item == 'no-image.jpg' || empty($item)) {
                                                continue;
                                              }
                                                $d++;
                                              
                                        ?>

                                            <div class="slide-item" id="anh-<?= $d ?>" style="display: <?= $item == 'no-image.jpg' ? 'none' : 'block'; ?>;">

                                                <img src="<?= $item ?>" alt="" class="img-responsive img1" data-zoom-image="<?= $item ?>">

                                            </div>

                                        <?php } ?>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- <img src="/images/module led p5 audoor.jpg" alt="" class="img-responsive img1" onclick="anh(2)"> -->

                        <div class="col-md-6">

                            <div class="gb-chitiet_sanpham_MPTOTO_left-info">

                                
                                


                                
                                
                                <div class="kind-pro">
                                  <?php if (!empty($row['tinh_nang_gia_sp'])) { ?>
                                    <?php include DIR_PRODUCT."MS_PRODUCT_SAN_0005_3.php";?>
                                  <?php } elseif (!empty($gia_tinh_nang)) { ?>
                                  <?php include DIR_PRODUCT."MS_PRODUCT_SAN_0005.php";?>
                                  <?php } else { ?>
                                  <?php include DIR_PRODUCT."MS_PRODUCT_SAN_0005_2.php";?>
                                  <?php } ?>
                                </div>
                                <?php include DIR_PRODUCT."MS_PRODUCT_MPTOTO_0002.php";?>
                                <div style="padding: 10px 0;margin-top: 5px;border-radius: 5px;">
                                  <p><b>Mã sản phẩm</b>: <?= $row['product_code'] ?></p>
                                  <p><b>Danh mục:</b> <?= $arr_procat[0]['name'] ?></p>
                                  <p><b>Tình trạng: </b><?= $row['product_expiration'] ?></p>
                                  <p><b>Thời gian hàng về dự kiến: </b><?= $row['product_material'] ?></p>
                                </div>
                                <!-- tags -->

                                

                                <!--CONTACT-->

                                <?php //include DIR_CONTACT."MS_CONTACT_PRODUCT_0001.php";?>  

                                

                                <div class="row">

                                  
                                  
                                  <div class="col-md-12" style="margin: 5px 0;">

                                    

                                    <a href="javascript:void(0)" class="btnBuyPD1 btn_addCart1"><p>Đặt Mua Ngay</p><span>Nhanh chóng, thuận tiện</span></a>
                                  </div>


                                  <div class="col-md-12" style="margin: 5px 0;">

                                    <input type="hidden" class="form-control qty number_cart" id="pwd" min="0" value="1">

                                    <input type="hidden" name="id" id="product_id" value="<?php echo $rowLang['product_id'];?>">

                                    <input type="hidden" name="name" id="product_name" value="<?= $row['product_name'];?>">

                                    <input type="hidden" name="price" id="product_price" value="<?php echo $sp_gia_giam;?>">

                                    <input type="hidden" name="link" id="product_link" value="<?php echo $sp_link;?>">

                                    <a href="javascript:void(0)" class="btnBuyPD2 btn_addCart"><p>Cho Vào Giỏ</p><span>Mua tiếp sản phẩm khác</span></a>

                                  </div>
                                  <!-- <div class="col-md-4">

                                    

                                     <a class="btnBuyPD1 " onclick="bao_gia(<?= $row['product_id'] ?>)"><p>Báo giá</p><span>Sản phẩm chính hãng</span></a>
                                  </div> -->

                                </div>
                                <div class="row" style="margin-top: 10px;display: none;">
                                  <div class="col-md-12">
                                    <?php if (isset($_SESSION['them_don']) && !empty($_SESSION['them_don'])) { ?>
                                      <span class="btn btn-warning" onclick="them_don(<?= $row['product_id'] ?>)">Thêm vào đơn hàng</span>
                                    <?php } ?>

                                    <?php if (isset($_SESSION['doi_don']) && !empty($_SESSION['doi_don'])) { ?>
                                      <span class="btn btn-warning" onclick="doi_don(<?= $row['product_id'] ?>)">Đổi sản phẩm đơn hàng</span>
                                    <?php } ?>
                                  </div>
                                </div>

                            </div>

                        </div>
                      </div>
                    </div>

                    <div class="col-md-12"> 

                      <!--THÔNG SỐ VÀ MÔ TẢ-->

                      <div class="gb-thongso-mota">

                          <h2>Đặc điểm nổi bật</h2>
                      </div>
                      
                      <article class="full-string" style="height: 700px;">
                        <div id="tab_default_31" class="xesse">

                          <h2 style="" class="title-box-scroll">Video</h2>

                          <?php if ($row['product_sub_info5'] == 'mp4' || empty($row['product_sub_info5'])) {} else { ?>
                          <video width="100%" controls autoplay muted>
                            <source src="<?= $row['product_sub_info5'] ?>" type="video/mp4">
                            <source src="mov_bbb.ogg" type="video/ogg">
                            Your browser does not support HTML video.
                          </video>
                          <?php } ?>
                        </div>
                     
                      

                      <div id="tab_default_32" class="xesse">

                        <h2 style="" class="title-box-scroll">Đặc điểm nổi bật</h2>

                        <?= $row['product_sub_info3'] ?>

                      </div>

                      <div id="tab_default_33" class="xesse">

                        <h2 style="" class="title-box-scroll">Thông số kỹ thuật</h2>

                        <?= $row['product_sub_info4'] ?>
                        
                      </div>
                      <div>

                                  <p>

                                    <b class="title-box-scroll">
                                      Tags: 
                                    </b>

                                     <?php 
                                      $d = 0;
                                      
                                      foreach ($producttag_arr as $item) { 
                                        $d++;//echo $d;
                                        if ($d==1) {
                                          echo $item;
                                        } else {
                                          echo ', '.$item;
                                        }
                                      }
                                      ?>

                                  </p>

                                </div>
                      </article>
                      <p class="view-more">Xem Thêm Thông Số Chi Tiết</p>
                      <!--bình luận-->

                      <?php //include DIR_EMAIL."MS_EMAIL_MPTOTO_0002.php";?>

                      <!--realte product-->

                      <?php //include DIR_PRODUCT."MS_PRODUCT_BOXPRODUCTRELATIVE_001.php";?>

                      <!--da xem product-->
                      <div class="hidden-lg row">

                                  
                                  
                                  <div class="col-md-12" style="margin: 5px 0;">

                                    

                                    <a href="javascript:void(0)" class="btnBuyPD1 btn_addCart1"><p>Đặt Mua Ngay</p><span>Nhanh chóng, thuận tiện</span></a>
                                  </div>


                                  <div class="col-md-12" style="margin: 5px 0;">

                                    <input type="hidden" class="form-control qty number_cart" id="pwd" min="0" value="1">

                                    <input type="hidden" name="id" id="product_id" value="<?php echo $rowLang['product_id'];?>">

                                    <input type="hidden" name="name" id="product_name" value="<?= $row['product_name'];?>">

                                    <input type="hidden" name="price" id="product_price" value="<?php echo $sp_gia_giam;?>">

                                    <input type="hidden" name="link" id="product_link" value="<?php echo $sp_link;?>">

                                    <a href="javascript:void(0)" class="btnBuyPD2 btn_addCart"><p>Cho Vào Giỏ</p><span>Mua tiếp sản phẩm khác</span></a>

                                  </div>
                                  <!-- <div class="col-md-4">

                                    

                                     <a class="btnBuyPD1 " onclick="bao_gia(<?= $row['product_id'] ?>)"><p>Báo giá</p><span>Sản phẩm chính hãng</span></a>
                                  </div> -->

                                </div>

                      <?php include DIR_PRODUCT."MS_PRODUCT_BOXPRODUCTRELATIVE_001.php";?>
                      <?php include DIR_PRODUCT."MS_PRODUCT_SAN_0002.php";?>

                    </div>

                </div>

                   

                    <!-- Thanh lọc sản phẩm -->

                    <div class="col-md-3">

                      <?php include DIR_SIDEBAR."MS_SIDEBAR_MPTOTO_0013.php";?>

                    </div>

                



                



            </div>

        </div>

    </div>

</div>



<!-- <script src="/plugin/slick/scripts.js"></script> -->

<!-- <script src="/plugin/slick/slick.js"></script> -->

<!-- <script src="/plugin/slickNav/jquery.slicknav.js"></script> -->



<div id="fb-root"></div>

<script>(function(d, s, id) {

        var js, fjs = d.getElementsByTagName(s)[0];

        if (d.getElementById(id)) return;

        js = d.createElement(s); js.id = id;

        js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6";

        fjs.parentNode.insertBefore(js, fjs);

    }(document, 'script', 'facebook-jssdk'));</script>



<script type="text/javascript">

    $(document).ready(function() {

        $('.slider-for').slick({

            slidesToShow: 1,

            slidesToScroll: 1,

            speed: 500,

            arrows: false,

            fade: true,

            asNavFor: '.slider-nav'

        });

        $('.slider-nav').slick({

            slidesToShow: 3,

            slidesToScroll: 1,

            speed: 500,

            asNavFor: '.slider-for',

            dots: false,

            focusOnSelect: true,

            slide: 'div'

        });

    });

</script>

<script type="text/javascript">

  function get_height_1 () {

    $([document.documentElement, document.body]).animate({

        scrollTop: $("#tab_default_31").offset().top - 100

    }, 500);

  }



  function get_height_2 () {

    $([document.documentElement, document.body]).animate({

        scrollTop: $("#tab_default_32").offset().top - 150

    }, 500);

  }



  function get_height_3 () {

    $([document.documentElement, document.body]).animate({

        scrollTop: $("#tab_default_33").offset().top - 150

    }, 500);

  }



  function get_height_4 () {

    $([document.documentElement, document.body]).animate({

        scrollTop: $("#tab_default_34").offset().top - 150

    }, 500);

  }



  function get_height_5 () {

    $([document.documentElement, document.body]).animate({

        scrollTop: $("#tab_default_35").offset().top - 150

    }, 500);

  }

</script>

<script type="text/javascript">

  function bao_gia (id) {

    // alert(id);

    var link = '/bao-gia/index.php?id='+id;

    window.open(link, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=500,width=1000,height=400");

  }

</script>

<script>
  function them_don (id) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
       // document.getElementById("demo").innerHTML = this.responseText;
        var cart_id = this.responseText;
        // alert(cart_id);
        window.location.href = "/admin/index.php?page=sua-don-hang&id_cart="+cart_id;
      }
    };
    xhttp.open("GET", "/functions/ajax1/them_don_sp.php?id="+id, true);
    xhttp.send();
  }

  function doi_don (id) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var cart_id = this.responseText;
        window.location.href = "/admin/index.php?page=sua-don-hang&id_cart="+cart_id;
      }
    };
    xhttp.open("GET", "/functions/ajax1/doi_don_sp.php?id="+id, true);
    xhttp.send();
  }
</script>

<script>
  function anh (so, gia, cl, id) {
    // alert(so);
    if (cl == 1) {
      document.getElementById("anh-"+so).click();
    }

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var res = this.responseText;
        var obj = JSON.parse(res);
        // alert(obj[0]);
        document.getElementById("gia").innerHTML = number_format(obj[1])+' VNĐ <del style="color: #ccc;font-size: 20px;">'+number_format(obj[0])+' VNĐ</del>';
        document.getElementById("product_price").value = obj[1];
      }
    };
    xhttp.open("GET", "/functions/ajax1/gia.php?id="+id+"&so="+so, true);
    xhttp.send();
    
    
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
}
</script>
<script>
  $('.view-more').click(function() {
    $('.full-string').css("height","auto");
    $('.view-more').css("display","none");
});
</script>