<?php 
    $_SESSION['attribute'] = array();
    $home_tab = $action->getList('home_tab', '', '', 'id', 'asc', '', '', '');
    $n = 1;
    $k = 0;
    $h = 0;
    $l = 0;
    foreach ($home_tab as $item_tab) { 
        $n++; 
        $procat_tab = $action->getList_tab_1('productcat', 'home_tab', $item_tab['id'], 'productcat_sort_order', 'asc', '', '5', '');
?> 
<div class="rowProductHome"> 
    <div class="container">

        <div class="row"> 

            <div class="col-md-12">  

            	<div class="content_tab">
                    <span class="span-tab<?= $n ?>">
                        <?php 
                        $l = 0;
                        foreach ($procat_tab as $item_procat_tab) { 
                            $l++;
                            $k++;
                        ?>
                        <span class="span_tab<?= $n ?>"><a href="#tab_<?= $k ?>" class="<?= $l==1 ? 'active-span-tab'.$n : '' ?><?= $l!=1 ? 'mobile-hide' : '' ?>"><?= $item_procat_tab['productcat_name'] ?></a></span>
                        <?php } ?>
                        <a href="/<?= $procat_tab[0]['friendly_url'] ?>" class="allCateBoxPH">Xem tất cả >></a>
                    </span>
                    <?php 
                    foreach ($procat_tab as $item_procat_tab) {
                        $h++;
                    ?>
                    <div class="span_tab_content<?= $n ?>" id="tab_<?= $h ?>" style="display: block;">                        
                        <?php include DIR_PRODUCT."MS_PRODUCT_DAINGHIA_SUB_003_a.php";?>
                    </div>
                    <?php } ?>
                </div>

            </div> 

        </div>
    </div>

</div>
<?php } ?>