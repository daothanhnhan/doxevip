<link rel="stylesheet" href="/plugin/owl-carouse/owl.carousel.min.css">
<link rel="stylesheet" href="/plugin/owl-carouse/owl.theme.default.min.css">
<div class="gb-news-bloghome_mptoto">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="gb-producttab-home_mptoto-title">
                    <img src="/images/<?= $rowConfig['icon_web'] ?>" alt="" class="img-responsive" style="width: 50px;">
                    <h2><a href="">TIN TỨC MỚI NHẤT</a></h2>
                    <div class="underline-product_mptoto"></div>
                    <!-- <p>Tin tức luôn được cập nhật thường xuyên đem đến cho khách hàng những thông tin hữu ích nhất </p> -->
                </div>
            </div>
        </div>
        <div class="gb-news-bloghome_mptoto-slide owl-carousel owl-theme">
            <?php
                $news = new action_news();
                $list_news_new = $news->getListNewsNew_hasLimit(8);
                foreach ($list_news_new as $item) {
            ?>
                <div class="item">
                    <div class="gb-news-blog_mptoto-item wow slideInUp" data-wow-duration="1s">
                        <div class="gb-news-blog_mptoto-item-img">
                            <a href="/<?= $item['friendly_url'] ?>">
                                <img src="/images/<?= $item['news_img'] ?>" class="img-responsive">
                            </a>
                            <!-- <div class="caption caption-large">
                                <time class="the-date"><?= date('d-m-Y', strtotime($item['news_created_date']))  ?></time>
                            </div> -->
                        </div>
                        <div class="gb-news-blog_mptoto-item-text">
                            <div class="gb-news-blog_mptoto-item-title">
                                <h3>
                                    <a href="/<?= $item['friendly_url'] ?>">
                                        <?= $item['news_name'] ?>
                                    </a>
                                </h3>
                            </div>
                            <div class="gb-news-blog_mptoto-item-text-des">
                                <p><?= $item['news_des'] ?></p>
                            </div>
                        </div>
                        <!-- <div class="gb-news-blog_mptoto-item-button">
                            <a href="/<?= $item['friendly_url'] ?>">
                                <button type="button" class="btn gb-btn-readmore">ĐỌC TIẾP</button>
                            </a>
                        </div> -->
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<script src="/plugin/owl-carouse/owl.carousel.min.js"></script>
<script src="/plugin/waypoint/jquery.waypoints.min.js"></script>
<script src="/plugin/wow/wow.min.js"></script>
<script src="/plugin/animsition/css/animate.css"></script>
<script>
    new WOW().init();
</script>
<script>
    $(document).ready(function (){
        $('.gb-news-bloghome_mptoto-slide').owlCarousel({
            loop:true,
            margin:30,
            navSpeed:500,
            dots: true,
            autoplay: true,
            rewind: true,
            navText:[],
            responsive:{
                0:{
                    items:1,
                    nav:false
                },
                767:{
                    items: 3,
                    nav:true
                }
            }
        });
    });
</script>