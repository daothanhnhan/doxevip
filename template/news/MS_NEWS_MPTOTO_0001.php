<?php 
    $home_news = $action->getList('news', '', '', 'news_id', 'desc', '', '3', '');
?> 
<div class="coverBoxNewsHome">
    <div class="container">
        <div class="row"> 
            <div class="col-sm-12">
                <div class="titleBoxNewsHome">
                    <h2>Tin tức cập nhật</h2>
                    <img src="/images/lineNH.png" alt="" class="img-responsive">
                </div>
            </div>
        </div>
        <div class="row"> 
            <?php foreach ($home_news as $item) { ?>
            <div class="col-sm-4">
                <div class="boxNewsHome">
                    <div class="boxNewsHome_top">
                        <a href="/<?= $item['friendly_url'] ?>"><img src="/images/<?= $item['news_img'] ?>" alt="<?= $item['news_name'] ?>"></a>
                        <div class="lineDateBoxNews">
                            <i class="fa fa-calendar"></i><?= date('d/m/Y', strtotime($item['news_created_date'])); ?>
                        </div>
                    </div>
                    <div class="boxNewsHome_bottom">
                        <h3><a href="/<?= $item['friendly_url'] ?>"><?= $item['news_name'] ?></a></h3> 
                        <p><?= $item['news_des'] ?></p>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>