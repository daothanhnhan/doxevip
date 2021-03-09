<?php 
    $tinh_nang_1 = json_decode($row['tinh_nang_2'], true);
    $tinh_nang_sp = $action->getList('tinh_nang_cat', 'product_id', $row['product_id'], 'id', 'asc', '', '', '');
    foreach ($tinh_nang_1 as $k => $a_item_tn) {
        // echo $k;
      foreach ($a_item_tn['skuPropertyValues'] as $key => $value) {
        // echo $key;
        if (isset($value['show'])) {
          if (empty($value['show'])) {
            unset($tinh_nang_1[$k]['skuPropertyValues'][$key]);
            // var_dump($tinh_nang_1[$k]['skuPropertyValues'][$key]);
            // echo $key;
          }
        }
        
      }
    }
    // var_dump($tinh_nang_1);
    // $gia_tinh_nang_1 = json_decode($row['gia_tinh_nang_1'], true);var_dump($gia_tinh_nang_1);
?>
<link rel="stylesheet" href="/plugin/owl-carouse/owl.carousel.min.css">
<link rel="stylesheet" href="/plugin/owl-carouse/owl.theme.default.min.css">
<link rel="stylesheet" href="/plugin/animsition/css/animate.css">
<style>
.display-block {
    display: block !important;
}
.gb-slideshow_mptoto-slide-tinh-nang .owl-next {
    position: absolute;
    right: 10px;
    top: 45%;
    background: red !important;
}
.gb-slideshow_mptoto-slide-tinh-nang .owl-prev {
    position: absolute;
    left: 10px;
    top: 45%;
    background: red !important;
}
.active-box {
    border: 3px solid red;
}
</style>
<?php 
$tinh_nang_loai = 0;
foreach ($tinh_nang_sp as $item_loai) { 
    $tinh_nang_loai++;
    $tinh_nang_item = $action->getList('tinh_nang_item', 'tinh_nang_cat_id', $item_loai['id'], 'id', 'asc', '', '', '');
?>
<h2 class="select-pro">
    <?= $item_loai['name'] ?>
    <input type="hidden" name="" id="tinh-nang-loai-<?= $tinh_nang_loai ?>" class="tinh-nang-loai" value="<?= $tinh_nang_item[0]['id'] ?>">
</h2>
<div style="clear: both;" class="gb-slideshow_mptoto-slide-tinh-nang owl-carousel owl-theme">
                                <?php 
                                $d = 0;
                                $d1 = 0;
                                foreach ($tinh_nang_item as $item) { 
                                  $d1++;
                                  $cl = 1;
                                  if ($item == 'no-image.jpg' || empty($item)) {
                                    $cl = 0;
                                  } else {
                                    $d++;
                                  }
                                  ?>
                                  <div class="cis-er box-tn-<?=$tinh_nang_loai ?> <?= $d==1? 'active-box' : '' ?>" onclick="anh_sp(<?= $item['id'] ?>, <?= $tinh_nang_loai ?>, '<?= $item['image'] ?>', <?= $row['product_id'] ?>)" >
                                    <img src="/images/tinh-nang/<?= $item['image'] ?>" alt="" width="50">
                                    <?= $item['name'] ?>
                                  </div>
                                  
                                <?php } ?>
                                </div>
<?php } ?>

<script src="/plugin/owl-carouse/owl.carousel.min.js"></script>
<script>
    $(document).ready(function (){
        $('.gb-slideshow_mptoto-slide-tinh-nang').owlCarousel({
            loop:false,
            margin:0,
            navSpeed:500,
            nav:true,
            dots: false,
            autoplay: false,
            rewind: true,
            navText:["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
            items:4,
            responsive:{
                0:{
                    nav:true
                },
                767:{
                    nav:true
                }
            }
        });
    });
</script>
<script>
    function anh_sp (ma, loai, anh, pro) {
        document.getElementById('tinh-nang-loai-'+loai).value = ma;
        var tinh_nang_loai = document.getElementsByClassName("tinh-nang-loai");
        // alert(anh);
        var lth = tinh_nang_loai.length;

        var arr = [];
        for (var i=0;i<lth;i++) {
            arr[i] = tinh_nang_loai[i].value;
        }
        // alert(arr);

        var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var gia = this.responseText;
                // alert(gia);
                var obj = JSON.parse(gia);
                // alert(obj[0]);
                document.getElementById('gia').innerHTML = obj[0];
                document.getElementById('product_price').value = obj[1];
            }
          };
          xhttp.open("GET", "/functions/ajax1/gia_tinh_nang_sp.php?ma="+arr+"&pro="+pro, true);
          xhttp.send();
          // ///////////////////
          if (anh != '') {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var anh_show = this.responseText;
                // alert(gia);
                // var obj = JSON.parse(gia);
                // alert(obj[0]);
                document.getElementById('anh-show-slide').innerHTML = anh_show;
                // document.getElementById('product_price').value = obj[1];
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
            }
            
          };
          xhttp.open("GET", "/functions/ajax1/anh_show_chinh_sp.php?anh="+anh+"&pro="+pro, true);
          xhttp.send();
          }
        
    }
</script>
<script>
<?php 
$d = 0;
foreach ($tinh_nang_sp as $item_loai) { 
    $d++;
?>
// Get all buttons with class="btn" inside the container
var btns_<?= $d ?> = document.getElementsByClassName("box-tn-<?= $d ?>");

// Loop through the buttons and add the active class to the current/clicked button
for (var i = 0; i < btns_<?= $d ?>.length; i++) {
  btns_<?= $d ?>[i].addEventListener("click", function() {
    for (var j = 0; j < btns_<?= $d ?>.length; j++) {
        btns_<?= $d ?>[j].className = btns_<?= $d ?>[j].className.replace(" active-box", "");
    }
    // alert(i);
    // var current = document.getElementsByClassName("active-box");
    // current[0].className = current[0].className.replace(" active-box", "");
    this.className += " active-box";
  });
}
<?php } ?>
</script>