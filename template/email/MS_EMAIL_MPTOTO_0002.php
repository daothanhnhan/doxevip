<?php
function curPageURL_mp() {
     $pageURL = 'http';
     if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
     $pageURL .= "://";
     if ($_SERVER["SERVER_PORT"] != "80") {
      $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
     } else {
      $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
     }
     return $pageURL;
}
?>
<div class="gb-nhan-xet-baiviet" id="tab_default_34">

    <!--NHẬN XÉT HEADER-->
    <div class="gb-nhan-xet-baiviet-header">
        <h3>ĐÁNH GIÁ</h3>
        <div class="gb-form-nhan-xet">
            <div class="fb-comments" data-href="<?= curPageURL_mp() ?>" data-width="100%" data-numposts="1"></div>
        </div>
    </div>
</div>

<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>