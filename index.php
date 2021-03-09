<?php
    session_start();
    ob_start();
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $folder = dirname(__FILE__);
    include_once('config.php');
    include_once('__autoload.php');
    $action = new action();
    include_once dirname(__FILE__).DIR_FUNCTIONS."database.php";  
    include_once dirname(__FILE__).DIR_FUNCTIONS_PAGING."pagination.php";
    include_once 'functions/phpmailer/class.smtp.php';
    include_once 'functions/phpmailer/class.phpmailer.php';
    include_once "functions/vi_en.php";

    // Install MultiLanguage
    include_once dirname(__FILE__).DIR_FUNCTIONS_LANGUAGE."lang_config.php";
    include_once dirname(__FILE__).DIR_FUNCTIONS_LANGUAGE.$lang_file;
    // Install Friendly Url
    include_once dirname(__FILE__).DIR_FUNCTIONS_URL."url_config.php";
    // Configure Website
    include_once dirname(__FILE__).DIR_FUNCTIONS."website_config.php";
    // echo $translate['link_contact'];die;
    $trang = isset($_GET['trang']) ? $_GET['trang'] : '1';
    $action = new action();
    $cart = new action_cart();
    $menu = new action_menu();
    $action_product = new action_product();
    $action_news = new action_news();
    // $kiotviet = new action_kiotviet();
    // $kiotviet->set_token();
// echo phpversion();die;
    $rowConfig = $action->getDetail('config','config_id',1);

    function set_login () {
        global $conn_vn;
        if (!isset($_SESSION['user_id_gbvn'])) {
            if (isset($_COOKIE['user_id_trichdan'])) {
                $arr = explode(':', $_COOKIE['user_id_trichdan']);
                $identify = $arr[0];
                $token = $arr[1];
                $sql = "SELECT * FROM user Where remember_me_identify = '$identify' And remember_me_token = '$token'";
                $result = mysqli_query($conn_vn, $sql);
                $row = mysqli_fetch_assoc($result);
                $_SESSION['user_id_gbvn'] = $row['id'];
                $_SESSION['user_name_gbvn'] = $row['user_name'];
            }
        }
    }
    set_login();
?>

<!doctype html>
<html lang="en">
<head>
    <!-- start - cấu hình cơ bản, dùng chung cho tất cả các website chuẩn seo -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="google-site-verification" content="oghC2h18kmURma91PpnEDtCKWJNYIIfnY4nXH1AQ-vQ" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- cần cấu hình linh hoạt -->
    <meta name="description" content="<?= $meta_des ?>">
    <!-- cần cấu hình linh hoạt -->
    <meta name="keywords" content="<?= $meta_key ?>">
    <!-- <meta id="meta_topic_id" property="og:id" content="1139"> -->
    
    <?php 
    if ($urlAnalytic == 'product_languages' && isset($_GET['page'])) { 
      $slug = isset($_GET['slug']) ? $_GET['slug'] : '';
      $rowLang = $action_product->getProductLangDetail_byUrl($slug,$lang);
      $row = $action_product->getProductDetail_byId($rowLang[$nameColIdProduct_productLanguage],$lang);
    ?>
    <meta property="og:image" content="<?= $action->curPageURL() ?>/images/<?= $row['product_img'] ?>" />
    <?php } ?>
    <?php 
    if ($urlAnalytic == 'news_languages' && isset($_GET['page'])) { 
      $slug = isset($_GET['slug']) ? $_GET['slug'] : '';
      $rowLang = $action_news->getNewsLangDetail_byUrl($slug,$lang);
      $row = $action_news->getNewsDetail_byId($rowLang['news_id'],$lang);
    ?>
    <meta property="og:image" content="<?= $action->curPageURL() ?>/images/<?= $row['news_img'] ?>" />
    <?php } ?>
    <?php if (!isset($_GET['page'])) { ?>
    <meta property="og:image" content="<?= $action->curPageURL() ?>/images/<?= $rowConfig['icon_web'] ?>" alt="logo" />
    <?php } ?>
    <?php 
    if ($urlAnalytic == 'productcat_languages' && isset($_GET['page'])) { 
      $slug = isset($_GET['slug']) ? $_GET['slug'] : '';
      $rowCatLang = $action_product->getProductCatLangDetail_byUrl($slug,$lang);
      $rowCat = $action_product->getProductCatDetail_byId($rowLang['productcat_id'],$lang);
      if ($rowCat['productcat_sub'] != '') { 
    ?>
    <meta property="og:image" content="<?= $action->curPageURL() ?>/images/<?= $rowCat['productcat_sub'] ?>" />
    <?php } } ?>

    <meta property="og:url"                content="<?= $action->curPageURL() ?>" />
    <meta property="og:type"               content="website" />
    <meta property="og:title"              content="<?= $title ?>" />
    <meta property="og:description"        content="<?= $meta_des ?>" />
    <meta property="og:image:alt" content="logo">

    <!-- cần cấu hình linh hoạt -->
    <title><?= $title ?></title>
    <!-- cần cấu hình linh hoạt -->
    <link rel="icon" href="/images/<?= $rowConfig['icon_web'] ?>" type="image/gif" sizes="16x16">

    <link rel="stylesheet" href="/plugin/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/plugin/bootstrap/css/bootstrap-theme.css">
    <link rel="stylesheet" href="/plugin/fonts/font-awesome/css/font-awesome.min.css">
    <script src="/plugin/jquery/jquery-2.0.2.min.js"></script>
    <script src="/plugin/bootstrap/js/bootstrap.js"></script>
    <!-- <link rel="stylesheet" href="/css/style.css"> -->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Paytone+One&family=Righteous&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/style-mptoto.css">
    <link rel="stylesheet" type="text/css" href="/css/responsive.css">    
    <script type='text/javascript' src='//c.trazk.com/c.js' async='async' > </script>
    <!-- end - cấu hình cơ bản, dùng chung cho tất cả các website chuẩn seo -->

    

<script src="js/swicht-tab.js" type="text/javascript"></script>


<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v4.0&appId=1607910769483726&autoLogAppEvents=1"></script>

<script type="text/javascript">


    

$(document).ready(function() {
// ===== Scroll to Top ==== 
$(window).scroll(function() {
    if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
        $('#gototop').fadeIn(200);    // Fade in the arrow
    } else {
        $('#gototop').fadeOut(200);   // Else fade out the arrow
    }
});
$('#gototop').click(function() {      // When arrow is clicked
    $('body,html').animate({
        scrollTop : 0                       // Scroll to top of body
    }, 500);
});
});




// ===== LightBox ==== 
$(document).ready(function() {
$(function() {
  
  // contact form animations
  $('#goimg1').click(function() {
    $('#img1').fadeToggle();
  })
  $(document).mouseup(function (e) {
    var container = $("#img1");
    var container001 = $("#coverLightBox001");

    if (!container001.is(e.target) // if the target of the click isn't the container...
        && container001.has(e.target).length === 0) // ... nor a descendant of the container
    {
        container.fadeOut();
    }
  });
  
});
});



$(document).ready(function() {
$(function() {
  $(document).mouseup(function (e) {
    var containerSearch = $("#searchresultdata");



    if (!containerSearch.is(e.target) // if the target of the click isn't the container...
        && containerSearch.has(e.target).length === 0) // ... nor a descendant of the container
    {
        containerSearch.fadeOut();
    }
  });


});
});
// == end Scroll to top === 

</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-141367109-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-141367109-2');
</script>


<!-- <script lang="javascript">var _vc_data = {id : 4074823, secret : '03308e93aeb1816e79710b30baf6cd14'};(function() {var ga = document.createElement('script');ga.type = 'text/javascript';ga.async=true; ga.defer=true;ga.src = '//live.vnpgroup.net/client/tracking.js?id=4074823';var s = document.getElementsByTagName('script');s[0].parentNode.insertBefore(ga, s[0]);})();</script> -->
</head>


<body class="<?php if(!isset($_GET['page'])) {echo "bg-home";} ?>">


<!-- <style>.fb-livechat, .fb-widget{display: none}.ctrlq.fb-button, .ctrlq.fb-close{position: fixed; right: 24px; cursor: pointer}.ctrlq.fb-button{z-index: 999; background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjwhRE9DVFlQRSBzdmcgIFBVQkxJQyAnLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4nICAnaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkJz48c3ZnIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDEyOCAxMjgiIGhlaWdodD0iMTI4cHgiIGlkPSJMYXllcl8xIiB2ZXJzaW9uPSIxLjEiIHZpZXdCb3g9IjAgMCAxMjggMTI4IiB3aWR0aD0iMTI4cHgiIHhtbDpzcGFjZT0icHJlc2VydmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPjxnPjxyZWN0IGZpbGw9IiMwMDg0RkYiIGhlaWdodD0iMTI4IiB3aWR0aD0iMTI4Ii8+PC9nPjxwYXRoIGQ9Ik02NCwxNy41MzFjLTI1LjQwNSwwLTQ2LDE5LjI1OS00Niw0My4wMTVjMCwxMy41MTUsNi42NjUsMjUuNTc0LDE3LjA4OSwzMy40NnYxNi40NjIgIGwxNS42OTgtOC43MDdjNC4xODYsMS4xNzEsOC42MjEsMS44LDEzLjIxMywxLjhjMjUuNDA1LDAsNDYtMTkuMjU4LDQ2LTQzLjAxNUMxMTAsMzYuNzksODkuNDA1LDE3LjUzMSw2NCwxNy41MzF6IE02OC44NDUsNzUuMjE0ICBMNTYuOTQ3LDYyLjg1NUwzNC4wMzUsNzUuNTI0bDI1LjEyLTI2LjY1N2wxMS44OTgsMTIuMzU5bDIyLjkxLTEyLjY3TDY4Ljg0NSw3NS4yMTR6IiBmaWxsPSIjRkZGRkZGIiBpZD0iQnViYmxlX1NoYXBlIi8+PC9zdmc+) center no-repeat #0084ff; width: 60px; height: 60px; text-align: center; bottom: 30px; border: 0; outline: 0; border-radius: 60px; -webkit-border-radius: 60px; -moz-border-radius: 60px; -ms-border-radius: 60px; -o-border-radius: 60px; box-shadow: 0 1px 6px rgba(0, 0, 0, .06), 0 2px 32px rgba(0, 0, 0, .16); -webkit-transition: box-shadow .2s ease; background-size: 80%; transition: all .2s ease-in-out}.ctrlq.fb-button:focus, .ctrlq.fb-button:hover{transform: scale(1.1); box-shadow: 0 2px 8px rgba(0, 0, 0, .09), 0 4px 40px rgba(0, 0, 0, .24)}.fb-widget{background: #fff; z-index: 1000; position: fixed; width: 360px; height: 435px; overflow: hidden; opacity: 0; bottom: 0; right: 24px; border-radius: 6px; -o-border-radius: 6px; -webkit-border-radius: 6px; box-shadow: 0 5px 40px rgba(0, 0, 0, .16); -webkit-box-shadow: 0 5px 40px rgba(0, 0, 0, .16); -moz-box-shadow: 0 5px 40px rgba(0, 0, 0, .16); -o-box-shadow: 0 5px 40px rgba(0, 0, 0, .16)}.fb-credit{text-align: center; margin-top: 8px}.fb-credit a{transition: none; color: #bec2c9; font-family: Helvetica, Arial, sans-serif; font-size: 12px; text-decoration: none; border: 0; font-weight: 400}.ctrlq.fb-overlay{z-index: 0; position: fixed; height: 100vh; width: 100vw; -webkit-transition: opacity .4s, visibility .4s; transition: opacity .4s, visibility .4s; top: 0; left: 0; background: rgba(0, 0, 0, .05); display: none}.ctrlq.fb-close{z-index: 4; padding: 0 6px; background: #365899; font-weight: 700; font-size: 11px; color: #fff; margin: 8px; border-radius: 3px}.ctrlq.fb-close::after{content: "X"; font-family: sans-serif}.bubble{width: 20px; height: 20px; background: #c00; color: #fff; position: absolute; z-index: 999999999; text-align: center; vertical-align: middle; top: -2px; left: -5px; border-radius: 50%;}.bubble-msg{width: 120px; left: -140px; top: 5px; position: relative; background: rgba(59, 89, 152, .8); color: #fff; padding: 5px 8px; border-radius: 8px; text-align: center; font-size: 13px;}</style><div class="fb-livechat"> <div class="ctrlq fb-overlay"></div><div class="fb-widget"> <div class="ctrlq fb-close"></div><div class="fb-page" data-href="https://www.facebook.com/maytinhdainghia" data-tabs="messages" data-width="360" data-height="400" data-small-header="true" data-hide-cover="true" data-show-facepile="false"> </div><div class="fb-credit"> <a href="https://thanhtrungmobile.vn" target="_blank">Powered by TT</a> </div><div id="fb-root"></div></div><a href="https://m.me/maytinhdainghia" title="Gửi tin nhắn cho chúng tôi qua Facebook" class="ctrlq fb-button"> <div class="bubble">1</div><div class="bubble-msg">Bạn cần hỗ trợ?</div></a></div><script src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.9"></script><script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script><script>jQuery(document).ready(function($){function detectmob(){if( navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) || navigator.userAgent.match(/Windows Phone/i) ){return true;}else{return false;}}var t={delay: 125, overlay: $(".fb-overlay"), widget: $(".fb-widget"), button: $(".fb-button")}; setTimeout(function(){$("div.fb-livechat").fadeIn()}, 8 * t.delay); if(!detectmob()){$(".ctrlq").on("click", function(e){e.preventDefault(), t.overlay.is(":visible") ? (t.overlay.fadeOut(t.delay), t.widget.stop().animate({bottom: 0, opacity: 0}, 2 * t.delay, function(){$(this).hide("slow"), t.button.show()})) : t.button.fadeOut("medium", function(){t.widget.stop().show().animate({bottom: "30px", opacity: 1}, 2 * t.delay), t.overlay.fadeIn(t.delay)})})}});</script> -->

<!--HEADER-->
<?php include_once dirname(__FILE__).DIR_THEMES."header.php"; ?>

<!--CONTENT-->
<div class="gb-content">
<?php
    
    if (isset($_GET['page'])){
        
        $urlAnalytic = $action->getTypePage_byUrl($_GET['page'],$lang);    
         //echo $urlAnalytic;
        switch ($urlAnalytic) {
          case 'newscat_languages':
                include_once dirname(__FILE__).DIR_THEMES."tintuc.php"; break;
            case 'tin-tuc':
                include_once dirname(__FILE__).DIR_THEMES."tintuc.php"; break;
            case 'news_languages':               
                include_once dirname(__FILE__).DIR_THEMES."chitiettintuc.php"; break;
            case 'servicecat_languages':
                include_once dirname(__FILE__) . DIR_THEMES . "dichvu.php";break;
            case 'service_languages':
                include_once dirname(__FILE__) . DIR_THEMES . "chitiet_dichvu.php";break;
            case 'page_language':
                include_once dirname(__FILE__) . DIR_THEMES . "gioithieu.php";break;
            case 'productcat_languages':              
                include_once dirname(__FILE__).DIR_THEMES."sanpham.php"; break;
            case 'products':              
                include_once dirname(__FILE__).DIR_THEMES."sanpham.php"; break;
            case 'san-pham':              
                include_once dirname(__FILE__).DIR_THEMES."sanpham.php"; break;
            case 'product_languages':
                include_once dirname(__FILE__).DIR_THEMES."chitietsanpham.php"; break;  
            // start - chưa hoàn thiện - url địa chỉ trang website
            case 'gio-hang':               
                include_once dirname(__FILE__).DIR_THEMES."giohang.php"; break;            
            case 'thanh-toan':           
                include_once dirname(__FILE__).DIR_THEMES."thanhtoan.php"; break;
            case 'xac-nhan-don-hang':           
                include_once dirname(__FILE__).DIR_THEMES."xacnhandonhang.php"; break;
            case 'huy-don-hang':           
                include_once dirname(__FILE__).DIR_THEMES."huydonhang.php"; break;
            case 'contact':           
                include_once dirname(__FILE__).DIR_THEMES."lienhe.php"; break;
            case 'lien-he':
                include_once dirname(__FILE__).DIR_THEMES."lienhe.php"; break;
            case 'search-news':
                include_once dirname(__FILE__) . DIR_THEMES . "search-news.php";break;
            case 'search-product':
                include_once dirname(__FILE__) . DIR_THEMES . "search-product.php";break;
            case 'search-service':
                include_once dirname(__FILE__) . DIR_THEMES . "search-service.php";break;
            case 'register':
                include_once dirname(__FILE__) . DIR_THEMES . "dang-ky.php";break;
            case 'login':
                include_once dirname(__FILE__) . DIR_THEMES . "dang-nhap.php";break;
            case 'logout':
                include_once dirname(__FILE__) . DIR_THEMES . "dang-xuat.php";break;
            case 'forget-pass':
                include_once dirname(__FILE__) . DIR_THEMES . "forget-pass.php";break;
            case 'change-password':
                include_once dirname(__FILE__) .DIR_THEMES . "change-password.php";break;
            case 'thong-tin-ca-nhan':
                include_once dirname(__FILE__) .DIR_THEMES . "user-profile.php";break;
            case 'update-infor':
                include_once dirname(__FILE__) .DIR_THEMES . "update-infor.php";break;
            case 'cart-detail':
                include_once dirname(__FILE__) .DIR_THEMES . "cart-detail.php";break;
            case 'price':
                include_once dirname(__FILE__) .DIR_THEMES . "price.php";break;
            case 'danh-muc-san-pham':
                include_once dirname(__FILE__) .DIR_THEMES . "danhmusanpham.php";break;
            case 'set-link':
                include_once dirname(__FILE__) . DIR_THEMES . "set_link.php";break;
            case 'dong-san-pham123':
                include_once dirname(__FILE__) . DIR_THEMES . "dongsanpham.php";break;
            case 'san-pham-moi':
                include_once dirname(__FILE__) . DIR_THEMES . "san-pham-moi.php";break;
            case 'san-pham-hot':
                include_once dirname(__FILE__) . DIR_THEMES . "san-pham-hot.php";break;
            case 'khuyen-mai':
                include_once dirname(__FILE__) . DIR_THEMES . "khuyen-mai.php";break;
            case 'chuong-trinh-khuyen-mai':
                include_once dirname(__FILE__) . DIR_THEMES . "chuong-trinh-khuyen-mai.php";break;
            case 'dang-nhap':
                include_once dirname(__FILE__).DIR_THEMES."dangnhap.php"; break;

            case 'dang-xuat':
                include_once dirname(__FILE__) . DIR_THEMES . "dangxuat.php";break;

            case 'doi-mat-khau':
                include_once dirname(__FILE__) . DIR_THEMES . "doi-mat-khau.php";break;
            case 'thong-tin-tai-khoan':
                include_once dirname(__FILE__) .DIR_THEMES . "user-profile.php";break;
            case 'cap-nhat-tai-khoan':
                include_once dirname(__FILE__) .DIR_THEMES . "update-infor.php";break;
            case 'don-hang':
                include_once dirname(__FILE__) .DIR_THEMES . "cart.php";break;
            case 'chi-tiet-don-hang':
                include_once dirname(__FILE__) .DIR_THEMES . "cart-detail.php";break;
             case 'xay-dung-cau-hinh-pc':
                include_once dirname(__FILE__) .DIR_THEMES . "xay-dung-cau-hinh-pc.php";break;
            case 'thong-tin-bao-hanh':
                include_once dirname(__FILE__) . DIR_THEMES . "thong-tin-bao-hanh.php";break;
            case 'thong-ke':
                include_once dirname(__FILE__) . DIR_THEMES . "thong-ke.php";break;
            case 'tra-cuu-bao-hanh':
                include_once dirname(__FILE__) . DIR_THEMES . "tra-cuu-bao-hanh.php";break;
            case 'producttag_languages':
                include_once dirname(__FILE__) . DIR_THEMES . "tag-san-pham.php";break;

            case 'nhap-san-pham':
                include_once dirname(__FILE__) . DIR_THEMES . "nhap-san-pham.php";break;
            // end - chưa hoàn thiện - url địa chỉ trang website
        }
    }
    else include_once dirname(__FILE__).DIR_THEMES."home.php";
    ?>
</div>  

<div class="social-button">
    <div class="social-button-content">
       <a href="tel:<?= $rowConfig['content_home3'] ?>" class="call-icon" rel="nofollow">
          <i class="fa fa-whatsapp" aria-hidden="true"></i>
          <div class="animated alo-circle"></div>
          <div class="animated alo-circle-fill  "></div>
           <span>Hotline: <?= $rowConfig['content_home3'] ?></span>
        </a>
    </div>
</div>
<!--FOOTER-->
<div class="gb-footer">
    <?php include_once dirname(__FILE__).DIR_THEMES."footer.php"; ?>

</div> 
<script type="text/javascript" src="/functions/language/lang.js"></script>


  <script>
  $(document).ready(function(){
    $('.user-support').click(function(event) {
      $('.social-button-content').css('display','inline-grid');
    });
    });
</script>
    <!-- <div class="gb-article-share-box">
        <div class="button-container">
            <div class="like-button">
                <iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2F119HoangQuocViet%2F&width=71&layout=box_count&action=like&size=large&show_faces=true&share=true&height=65&appId=220693348668109" width="71" height="95" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>              
            </div>
        </div>

        <div class="button-container">
            <div class="mail-button">
                <a href="mailto:sales@kidoasa.com">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                </a>
            </div>
        </div>      
    </div> -->
</body>

</html>