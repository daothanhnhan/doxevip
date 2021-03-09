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
<h2 class="select-pro">
    Chọn loại hàng
</h2>
<div style="clear: both;" class="gb-slideshow_mptoto-slide-tinh-nang owl-carousel owl-theme">
                                <?php 
                                $d = 0;
                                $d1 = 0;
                                foreach ($anh_tinh_nang as $k => $item) { 
                                  $d1++;
                                  $cl = 1;
                                  if ($item == 'no-image.jpg' || empty($item)) {
                                    $cl = 0;
                                  } else {
                                    $d++;
                                  }
                                  ?>
                                  <div class="cis-er <?= $d==1 ? 'active-box' : '' ?>" onclick="anh(<?= $d ?>, <?= $gia_tinh_nang[$d1-1] ?>, <?= $cl ?>, <?= $row['product_id'] ?>)" >
                                    <img src="<?= $item ?>" alt="" width="50">
                                    <?= $ten_anh[$k] ?>
                                  </div>
                                  
                                <?php } ?>
                                </div>

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
// Get all buttons with class="btn" inside the container
var btns = document.getElementsByClassName("cis-er");
// console.log('test');
// console.log(btns.length);
// Loop through the buttons and add the active class to the current/clicked button
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
    // alert(i);
    var current = document.getElementsByClassName("active-box");
    current[0].className = current[0].className.replace(" active-box", "");
    this.className += " active-box";
  });
}
</script>