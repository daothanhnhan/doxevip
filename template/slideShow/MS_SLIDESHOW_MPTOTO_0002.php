<link rel="stylesheet" href="/plugin/owl-carouse/owl.carousel.min.css">
<link rel="stylesheet" href="/plugin/owl-carouse/owl.theme.default.min.css">
<link rel="stylesheet" href="/plugin/animsition/css/animate.css">
<div class="gb-slideshow_mptoto">
    <div class="gb-slideshow_mptoto-slide owl-carousel owl-theme wow slideInUp" data-wow-duration="1s"> 
        <?php
            $array = json_decode($rowCat['productcat_sub_img1'], true);
            foreach ($array as $key => $val) {
                $img = json_decode($val, true);
                if ($img != '') {
                    ?> 
            <div class="item">
                <img src="/images/<?= $img['image']?>" alt="slideshow" class="img-responsive">
            </div>
            <?php                            
                  }
              }
            ?>  
    </div>
</div>

<script src="/plugin/wow/wow.min.js"></script>
<script>
    $(document).ready(function(){
        new WOW().init();
    })
</script>
<script src="/plugin/owl-carouse/owl.carousel.min.js"></script>
<script>
    $(document).ready(function (){
        $('.gb-slideshow_mptoto-slide').owlCarousel({
            loop:true,
            margin:0,
            navSpeed:500,
            nav:true,
            dots: false,
            autoplay: true,
            rewind: true,
            navText:[],
            items:2,
            responsive:{
                0:{
                    nav:false
                },
                767:{
                    nav:true
                }
            }
        });
    });
</script>