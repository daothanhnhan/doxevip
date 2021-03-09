<link rel="stylesheet" href="/plugin/owl-carouse/owl.carousel.min.css">
<link rel="stylesheet" href="/plugin/owl-carouse/owl.theme.default.min.css">
<link rel="stylesheet" href="/plugin/animsition/css/animate.css">
<div class="gb-slideshow_mptoto container " style="margin-top: 10px;">
    <div class="row cole" style="">
        <div class="col-md-8 col-xs-12">
            <div class="gb-slideshow_mptoto-slide owl-carousel owl-theme"> 
                <?php
                    $array = json_decode($rowConfig['slideshow_home'], true);
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
        <div class="col-md-4 hidden-xs">
            <?php 
                $home_news = $action->getList('news', '', '', 'news_id', 'desc', '', '4', '');
            ?> 
            <?php foreach ($home_news as $key ) { ?>
                <div class="news-new row">
                <div class="col-md-4" style="padding: 0">
                    <a href="<?=$key['friendly_url']?>"><img src="/images/<?=$key['news_img']?>" alt="" width="100%"></a>
                </div>
                <div class="col-md-8">
                    <a href="<?=$key['friendly_url']?>" class="title-news-new"><?=$key['news_name']?></a>

                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    
</div>
 
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
            items:1,
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