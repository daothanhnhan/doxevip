<?php 

    // $all_procat = $kiotviet->get_all_procat();//var_dump($all_procat);

    // $search_sort = array();

    // foreach ($all_procat as $key => $row) {

    //     $sort_procat = $kiotviet->get_procat_gb($row['categoryId']);//var_dump($sort_procat);

    //     $search_sort[$key] = $sort_procat['productcat_sort_order'];

    // }

    // array_multisort($search_sort, SORT_ASC, $all_procat);//var_dump($search_sort);

    // $list_procat1 = $kiotviet->get_procat_list($all_procat, null);

    $list_procat1 = $action_product->getProductCat_byProductCatIdParent('0', 'desc');

?>

<?php 

    $total_cart = 0;

    if (isset($_SESSION['shopping_cart'])) {

        foreach ($_SESSION['shopping_cart'] as $v) {

            $total_cart++;

        }

    }

?>

<script src="/plugin/sticky/jquery.sticky.js"></script>

<script src="/plugin/owl-carouse/owl.carousel.min.js"></script>



<!-- <script src="/plugin/slick/scripts.js"></script> -->

<script src="/plugin/slick/slick.js"></script>

<script src="/plugin/slickNav/jquery.slicknav.js"></script>

<style type="text/css">

.cart-mobile .badge {
  position: absolute;
  top: -1px;
  right: 1px;
  padding: 5px 8px;
  border-radius: 50%;
  background: #ff9800;
  color: white;
}



</style>



<!--MENU DESTOP-->

<header>

	<!-- <div class="boxBannerTopHeader boxBannerTopHeaderHidden"><a href="/" class="bannerTopHeader" style="background-image: url(/images/bannerTopHeader.jpg);"></a></div> -->

    <!-- <a href="/" class="fixBodyBanner fixBodyBannerLeft boxBannerTopHeaderHidden"><img src="../images/sideBar01.jpg"></a> -->

    <!-- <a href="/" class="fixBodyBanner fixBodyBannerRight boxBannerTopHeaderHidden"><img src="../images/sideBar02.jpg"></a> -->



    <!-- =======Banner left + right================ -->

<!-- lightbox container hidden with CSS -->

            <div class="lightbox" id="img1">

                <div class="coverLightBox" id="coverLightBox001">

                    <p class="titleLightBox">LIÊN HỆ VỚI CHÚNG TÔI</p>  

                    <form method="post">

                        <div class="form-group ">

                            <div class="input-group">

                                <div class="input-group-addon">

                                    <i class="fa fa-user">

                                    </i>

                                </div>

                                <input class="form-control" id="nameLB" name="nameLB" placeholder="Họ T&ecirc;n Của Bạn (*)" type="text"/>

                            </div>

                        </div>

                        <div class="form-group ">

                            <div class="input-group">

                                <div class="input-group-addon">

                                    <i class="fa fa-inbox">

                                    </i>

                                </div>

                                <input class="form-control" id="mail" name="mail" placeholder="Email" type="text"/>

                            </div>

                        </div>

                        <div class="form-group ">

                            <div class="input-group">

                                <div class="input-group-addon">

                                    <i class="fa fa-phone">

                                    </i>

                                </div>

                                <input class="form-control" id="phoneLB" name="phoneLB" placeholder="Số Điện Thoại (*)" type="text"/>

                            </div>

                        </div>

                        <div class="form-group ">

                            <textarea class="form-control" cols="40" id="messageLB" name="messageLB" placeholder="Th&ocirc;ng tin li&ecirc;n hệ" rows="10"></textarea>

                        </div>

                        <div class="form-group">

                            <div>

                                <button class="btn btn-primary " name="submit" type="submit">

                                    Gửi Thông Tin

                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

    <div class="container fixedSideHidden">

        <div id="banner_left_scroll" class="">



            <div id="icon-fixed-left">

                <?php 

                foreach ($list_procat1 as $item) { 

                    // $row_cat1 = $kiotviet->get_procat_gb($item['categoryId']);

                ?>

                <a href="/<?= $item['friendly_url'] ?>">

                    <img src="/images/<?= $item['productcat_main_img'] ?>" alt="Laptop &amp; LT Gaming">

                    <span><?= $item['productcat_name'] ?></span>

                </a>

                <?php } ?>

            </div>

        </div>

        <div id="banner_right_scroll" class="">

            <div id="icon-fixed-right">

                <a href="#" class="banner_right_scroll_face"><i class="fa fa-facebook"></i></a>

                <a href="#" class="banner_right_scroll_youtu"><i class="fa fa-youtube"></i></a>

                <p id="goimg1" class="banner_right_scroll_mail"><i class="fa fa-envelope"></i></p>

                <a id="gototop" href="javascript:" class="banner_right_scroll_gototop"><i class="fa fa-arrow-up"></i></a>

            </div>

        </div>

    </div>



    <script>  

     //Vị trí các phần 2 bên web

        $(document).ready(function(){

      $(window).scroll(function(){

      t = $(window).scrollTop();

      if(t > 200) {

        $("#nav").addClass("fixed").addClass("active");$("#header").addClass("fixed");$("body").addClass("fixed");

        $("#banner_left_scroll").addClass("fixed");$("#banner_right_scroll").addClass("fixed");

      }

      else {

        $("#nav").removeClass("fixed").removeClass("active");$("#header").removeClass("fixed");$("body").removeClass("fixed");

        $("#banner_left_scroll").removeClass("fixed");$("#banner_right_scroll").removeClass("fixed");

      }

      });

        }); 

  </script>

    <div class="gb-header_mptoto" style="position: relative;z-index: 999; float: left; width: 100%;">

        <div class="gb-topheader-mptoto">

            <div class="container">

                <div class="row">

                    <!--MENU MOBILE-->

                    <?php include_once DIR_MENU."MS_MENU_MPTOTO_0002.php"; ?>

                    <!-- End menu mobile-->



                    <!-- <div class="col-md-9 hidden-sm hidden-xs"> -->

                    <div class="col-md-3 col-sm-2">

                    </div>

                    <div class="col-md-8 col-sm-8 coverMenuDesktop">

                        <!-- <div class="gb-header-top_mptoto-left">

                            <?php

                        $list_menu = $menu->getListMainMenu_byOrderASC();

                        $menu->showMenu_byMultiLevel_mainMenuDaiNghia($list_menu,0,$lang,0);

                    ?>

                        </div> -->

                    </div> 

                    <div class="col-md-1 col-sm-2">

                    </div>

                   

                </div>

            </div>

        </div>

        <div class="gb-header_mptoto-sticky  sticky-menu1">

            <div class="container">

                <div class="row">

                        <div class="col-md-1 col-sm-3 col-xs-3">

                            <div class="logo-mptoto">

                                <a href="/" id="logo-web"><img src="/images/<?= $rowConfig['web_logo'] ?>" alt="logo" class="img-responsive"></a>

                                <div class="title-main-menu" id="toggleMainMenu" style="display: none;margin-top: 11px;"><i class="fa fa-bars"></i> Danh mục sản phẩm</div>

                            </div>

                        </div>
                    	
                    	<div class="col-xs-9 hidden-lg" style="padding-right: 5px">
                    		<div class="hotline-call">
                    			Hotline: <?=$rowConfig['content_home3']?>
                    			<p>DoXeVip.com - Nâng tầm đẳng cấp</p>
	                    	</div>
	                    </div>
                        <div class="col-md-11 col-sm-9 hidden-xs">
                            <div class="">
                                <div class="col-md-12 col-sm-12 hidden-xs">
                                  
                               
                                </div>
                                <div class="col-md-12 col-sm-12 ">
                                    <div class="gb-header-listLinkCenterHeader">
                                        <div class="col-md-4 col-sm-6">
                                                <div class="gb-header_mptoto-search">

                                                <?php include DIR_SEARCH."MS_SEARCH_MPTOTO_0001.php";?>

                                                </div>
                                        </div>
                                        <div class="col-md-8 col-sm-6">
                                            <ul class="listLinkCenterHeader">

                                              <li class="">
                                                    <div class="gb-header-top_mptoto-left">

                                                        <?php

                                                        $list_menu = $menu->getListMainMenu_byOrderASC();

                                                        $menu->showMenu_byMultiLevel_mainMenuDaiNghia($list_menu,0,$lang,0);

                                                        ?>

                                                    </div>
                                              </li> 

                                                <li class="coverLLCH02">

                                                    <p class="titleLLCH"><i class="glyphicon glyphicon-shopping-cart"></i> <a href="/gio-hang">Giỏ Hàng</a></p>

                                                    <!-- <div class="boxLLCH"><a href="/gio-hang" class="linkLLCH">Có <strong><?= $total_cart ?></strong> sản phẩm</a></div> -->

                                                </li>   

                                            </ul>

                                            <div class="coverUserHeaderMB">

                                                <a href="tel:<?= $rowConfig['content_home6'] ?>" title=""><i class="glyphicon glyphicon-earphone"></i></a>

                                            </div>

                                            <div class="coverUserHeaderMB">

                                                <a href="/gio-hang" title=""><i class="glyphicon glyphicon-shopping-cart"></i></a>

                                            </div>

                                            <div class="coverUserHeaderMB">

                                                <a href="/dang-nhap" title=""><i class="glyphicon glyphicon-user"></i></a>

                                            </div>
                                                                                
                                        </div>
                                

                            

                                    </div>
                                </div>

                        
                            </div>
                                
                            
                            
                            

                        </div>
                    

                    

                    


                   

                </div>

            </div>

        </div>

        <div class="gb-header_mptoto-center sticky-menu"> 

            <div class="container">

                <div class="row">

                    <div class="col-md-3 col-sm-3 hidden-xs" style="display: none;">

                    	<div class="title-main-menu" id="toggleMainMenu"><i class="fa fa-bars"></i> Danh mục sản phẩm</div>

                    </div>                    

                    <div class="hidden-lg hidden-md hidden-sm col-xs-2">

                      <div class="title-main-menuMobile" onclick="openNav()"><i class="fa fa-align-justify"></i><p>MENU</p>

                      </div>

                    </div>

                    


                    <div class="hidden-lg hidden-md hidden-sm col-xs-8">

                        <div class="gb-header_mptoto-search">

                            <?php include DIR_SEARCH."MS_SEARCH_MPTOTO_0001.php";?>

                        </div>

                    </div>
                    <div class="hidden-lg hidden-md hidden-sm col-xs-2">

                        <div class="cart-mobile">
                        	<a href="/gio-hang">
	                        	<i class="glyphicon glyphicon-shopping-cart"></i>
                                <?php if ($total_cart != 0 || true) { ?>
                                <span class="badge"><?= $total_cart ?></span>
                                <?php } ?>
	                        </a>
                        </div>

                    </div>

                </div>

            </div> 

        </div>

        <div class="gb-header_mptoto-bottom">

            <div class="container-fluid">

                <div class="gb-header_mptoto-menu">

                    <?php include DIR_MENU."MS_MENU_MPTOTO_0001.php";?>

                </div>

            </div>

        </div> 

    </div>

    <div class="clearfix"></div>



<script>

    $(document).ready(function(){



        if($(".title-main-menu").click(function(){

             $("#showMainMenu").slideToggle(500);

        }));                  



    });

</script> 





</header>

<?php include DIR_MENU."MS_MENU_MPTOTO_0003.php";?>

<!-- <script src="/plugin/sticky/jquery.sticky.js"></script> -->

<script>

    $(document).ready(function () {

        $(".sticky-menu").sticky({topSpacing:0});

    });

    

</script>

<!-- <script>

window.addEventListener('scroll', function () {

    var height = $(window).scrollTop()

    if (height > 40) {

      $(".gb-header_mptoto-bottom").addClass("menu-main");

      $("#logo-web").css("display", "none");
      $(".hidden-xs").css("display", "none");
     
      $(".gb-header_mptoto-sticky.sticky-menu").css("background-image", "url(/images/abcd.jpg)");
      $("#toggleMainMenu").css("display", "block");

      $(".logo-mptoto").css("width", "auto");

    } else {

      $(".gb-header_mptoto-bottom").removeClass("menu-main");

      $("#logo-web").css("display", "block");
      $(".hidden-xs").css("display", "block");
      $(".gb-header_mptoto-sticky.sticky-menu").css("background-color", "white");
      

      $("#toggleMainMenu").css("display", "none");

      $(".logo-mptoto").css("width", "160px");

    }

  })

</script> -->

