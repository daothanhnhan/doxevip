<?php 
    
?>

<nav class="menu-category_mptoto" id="showMainMenu" >

    <div class="row">

        <div class="col-md-12">

            <div class="menucategory-top_mptoto" style="text-align: center;"> 

                <ul class="mainMenuHeader" style="">

                    <?php 

                    foreach ($list_procat1 as $item_cat1) { 

                        $list_procat2 = $action_product->getProductCat_byProductCatIdParent($item_cat1['productcat_id'], 'desc');

                    ?>

                    <li>

                        <!-- <span class="boxImgMainMenu transition">

                            <img src="/images/iconMainMenu.png" alt="Laptop & LT Gaming"> -->

                            <!-- <img src="/images/<?= $item_cat1['productcat_img'] ?>" alt="Laptop & LT Gaming">

                        </span> -->

                        <a href="/<?= $item_cat1['friendly_url'] ?>" class="linkCate1MainMenu"><?= $item_cat1['productcat_name'] ?></a>            

                        <div class="subBoxMainMenu">     

                            <?php 

                            foreach ($list_procat2 as $item_cat2) {

                                 $list_procat3 = $action_product->getProductCat_byProductCatIdParent($item_cat2['productcat_id'], 'desc');

                            ?>

                            <div class="colSubMainMenu">

                              <a href="/<?= $item_cat2['friendly_url'] ?>" class="mainNameSubCol"><?= $item_cat2['productcat_name'] ?></a> 

                              <ul>

                                <?php 

                                foreach ($list_procat3 as $item_cat3) { 

                                ?>

                                <li>

                                    <a href="/<?= $item_cat3['friendly_url'] ?>" class="subNameSubCol"><?= $item_cat3['productcat_name'] ?></a>

                                </li>

                                <?php } ?>

                              </ul>

                            </div>          

                            <?php } ?>

                        </div>

                    </li>

                    <?php } ?>

                </ul>

            </div>

        </div>   

    </div>

</nav> 