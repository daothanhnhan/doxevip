<link rel="stylesheet" href="/plugin/owl-carouse/owl.carousel.min.css">
<link rel="stylesheet" href="/plugin/owl-carouse/owl.theme.default.min.css">
<div class="gb-khachhang_hoanmy">
    <h2>Ý kiến Khách hàng</h2>

    <div class="gb-khachhang_hoanmy-slide owl-carousel owl-theme">
        <?php
            $service = new action_service();
            $list_service = $service->getListServiceRelate_byIdCat_hasLimit(3, 100);
            foreach ($list_service as $item) {
        ?>
            <div class="item">
                <div class="gb-khachhang_hoanmy-item">
                    <div class="cbp-item-wrapper_hoanmy">
                        <div class="customer_hoanmy clearfix">
                            <div class="inner_hoanmy">
                                <div class="image_hoanmy"><img src="/images/<?= $item['service_img'] ?>" alt="" class="img-responsive"></div>
                                <h4 class="name_hoanmy"><?= $item['service_name'] ?></h4>
                                <div class="position_hoanmy"><?= $item['service_des'] ?></div>
                                <blockquote class="whisper_hoanmy">
                                    <?= $item['service_content'] ?>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<script src="/plugin/owl-carouse/owl.carousel.min.js"></script>
<script>
    $(document).ready(function (){
        $('.gb-khachhang_hoanmy-slide').owlCarousel({
            loop:true,
            margin:0,
            navSpeed:500,
            nav:true,
            dots: false,
            autoplay: true,
            rewind: true,
            navText:[],
            items:1
        });
    });
</script>