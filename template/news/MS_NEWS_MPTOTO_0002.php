<?php include DIR_BREADCRUMBS."MS_BREADCRUMS_MPTOTO_0002.php";?>
<?php 
    $action_news = new action_news(); 
    $slug = isset($_GET['slug']) ? $_GET['slug'] : '';

    $rowLang = $action_news->getNewsLangDetail_byUrl($slug,$lang);
    $row = $action_news->getNewsDetail_byId($rowLang['news_id'],$lang);
    $_SESSION['sidebar'] = 'newsDetail';
    $news_breadcrumb = $action_news->getNewsCatLangDetail_byId($row['newscat_id'], $lang);
    $breadcrumb_url = $news_breadcrumb['friendly_url'];
    $breadcrumb_name = $news_breadcrumb['lang_newscat_name'];
    $use_breadcrumb = true;
?>
<?php 
    $action_lang = new action_lang();
    $url_lang = $action_lang->get_url_lang_newsDetail($slug, $lang);
?>
<style>
    .gb-single-blog_mptoto-right-text iframe, .gb-single-blog_mptoto-right-text img {
        max-width: 100%;
    }
</style>
<input type="hidden" name="lang_current" id="lang_current" value="<?php echo $lang;?>">
<input type="hidden" name="url_lang" value="<?php echo $url_lang;?>" id="url_lang">

<div class="gb-single-blog_mptoto" style="margin-top: 50px;">
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 gb-single-blog_mptoto-right">
                <div class="gb-single-blog_mptoto-right-img">
                    <img src="/images/<?= $row['news_images'] ?>" alt="" class="img-responsive">
                </div>
                <div class="gb-single-blog_mptoto-right-title">
                    <h1><?= $rowLang['lang_news_name'] ?></h1>
                </div>
                <div class="gb-single-blog_mptoto-right-info">
                    <ul>
                        <li><i class="fa fa-user" aria-hidden="true"></i><a href="#"> Admin</a></li>
                        <li><i class="fa fa-clock-o" aria-hidden="true"></i><a href="#"> <?= date('d-m-Y', strtotime($row['news_update_date']))  ?></a></li>
                        <li><i class="fa fa-folder-open-o" aria-hidden="true"></i><a href="#"> Tin tức</a></li>
                    </ul>
                </div>
                <div class="gb-single-blog_mptoto-right-text">
                    <?= $rowLang['lang_news_content'] ?>
                </div>

                <!--bình luận-->
                <?php //include DIR_EMAIL."MS_EMAIL_MPTOTO_0002.php";?>

                <!--tin tức liên quan-->
                <?php include DIR_NEWS."MS_NEWS_MPTOTO_0003.php";?>

            </div>
             <div class="col-md-2 gb-blog-left">
                <?php //include DIR_SIDEBAR."MS_SIDEBAR_MPTOTO_0001.php";?>
                <?php //include DIR_SIDEBAR."MS_SIDEBAR_MPTOTO_0002_1.php";?>
                <?php //include DIR_SIDEBAR."MS_SIDEBAR_MPTOTO_0003.php";?>
            </div> 
        </div>
    </div>
</div>