<div class="gb-recenpost-sidebar-ruouvang widget-sidebar">
    <aside class="widget">
        <h3 class="widget-title-sidebar-ruouvang">Hỗ trợ trực tuyến</h3>
        <div class="widget-content">
            <div class="accordion-default">
                <ul class="accordion">
                    <?php
                        $action_news = new action_news();
                        $list_news_parent = $action_news->getNewsCat_byNewsCatIdParent(0, '');
                        foreach ($list_news_parent as $item) {
                    ?>
                        <li class="accordion-toggle">
                            <a href="#">
                                <span class="img-newscat"><img src="/images/<?= $rowConfig['icon_web'] ?>" alt=""></span>
                                <span>Phone City:</span>
                                <span>0987654321</span>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </aside>
</div>

<style>
    .img-newscat img{
        width: 25px;
        height: 25px;
        margin-right: 15px;
    }

</style>