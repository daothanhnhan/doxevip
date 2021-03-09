<?php 
    $list_news_relative = $action_news->getListNewsRelate_byIdCat_hasLimit($row['newscat_id'], 3);//var_dump($list_news_ralative);
?>
<link rel="stylesheet" href="/plugin/owl-carouse/owl.carousel.min.css">
<link rel="stylesheet" href="/plugin/owl-carouse/owl.theme.default.min.css">

<div class="gb-tintuc-lienquan">
    <!--HEADER PRODUICT TOP-->
    <div class="gb-product-top">
        <div class="gb-tintuc-lienquan-title">Tin tức liên quan</div>
    </div>
    <!--SHOW PRODUCT ITEM-->
    <div class="gb-product-show">
        <div class="gb-tintuc-lienquan-three-item owl-carousel owl-theme">
            <?php
                foreach ($list_news_relative as $item) {
            ?>
                <div class="item">
                    <div class="gb-tintuc-item">
                        <div class="item-img">
                            <a href="/<?= $item['friendly_url'] ?>">
                                <img src="/images/<?= $item['news_img'] ?>" alt="" class="img-responsive">
                            </a>
                        </div>
                        <div class="item-text">
                            <h2><a href="/<?= $item['friendly_url'] ?>"><?= $item['news_name'] ?></a></h2>
                            <time> <i class="fa fa-calendar-plus-o" aria-hidden="true"></i> <?= date('d-m-Y', strtotime($item['news_created_date']) ) ?></time>
                            <p><?= $item['news_des'] ?></p>
                           
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<script src="/plugin/owl-carouse/owl.carousel.min.js"></script>
<script>
    $(document).ready(function () {
        $('.gb-tintuc-lienquan-three-item').owlCarousel({
            loop:true,
            autoplay: true,
            responsiveClass:true,
            nav:true,
            navText:[],
            dots:false,
            margin:30,
            responsive:{
                0:{
                    items:1
                },
                768:{
                    items:3
                }
            }
        });
    });
</script>