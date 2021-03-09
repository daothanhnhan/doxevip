<?php 
    $home_news = $action->getList('news', '', '', 'news_id', 'desc', '', '3', '');
?> 
<div class="coverBoxNewsHome">
    <div class="container">
        <div class="row"> 
            <a class="linkBoxPDH" style="margin-bottom: 15px;">
                        <div class="text-name" style="background: url(/images/tintuccapnhat.jpg); margin: 0"></div>
                    </a>
        </div>
        <div class="row"> 
            <?php foreach ($home_news as $item) { ?>
            <div class="col-xs-4" style="padding-right: 0">
                <div class="boxNewsHome">
                    <div class="boxNewsHome_top">
                        <a href="/<?= $item['friendly_url'] ?>"><img src="/images/<?= $item['news_img'] ?>" alt="<?= $item['news_name'] ?>"></a>
                        
                    </div>
                    
                </div>
            </div>
            <div class="col-xs-8">
                <div class="boxNewsHome_bottom">
                    <h3><a href="/<?= $item['friendly_url'] ?>"><?= $item['news_name'] ?></a></h3> 
                    
                </div>
            </div>
            <div style="clear: both;"></div>
            <?php } ?>

        </div>
        <div class="xemthem">
            <a href="/tin-tuc">Xem các tin khác</a>
        </div>
    </div>
</div>