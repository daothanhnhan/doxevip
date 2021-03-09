<?php 
    $list_procat2_siderbar = $action_product->getProductCat_byProductCatIdParent($rowCat['productcat_id'], 'desc');
    if (empty($list_procat2_siderbar)) {
        $list_procat2_siderbar = $action_product->getProductCat_byProductCatIdParent($rowCat['productcat_parent'], 'desc');
    }
?>
<div class="gb-menu-category_myichi">
    <div class="title_Module_Bar_5_myichi"> <?= $rowCatLang['lang_productcat_name'] ?></div>
    <div class="cssmenu">
        <ul>
            <?php 
            foreach ($list_procat2_siderbar as $item) { 

            ?>
                <li>
                    <a href="/<?= $item['friendly_url'] ?>" title="name"><i class="fa fa-angle-double-right" aria-hidden="true"></i> <?= $item['productcat_name'] ?></a>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>