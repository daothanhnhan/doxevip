<?php
    $action_product = new action_product();

    $brand = $action_product->getProductList_byMultiLevel_orderProductId_tu($rowCat[$nameColId_productCat],'desc',$trang,32,$slug);
    $arr_brand = array();
    foreach ($brand as $item) {
        if ($item['product_expiration'] != "") {
            $arr_brand[] = strtoupper(trim($item['product_expiration'], " "));
        }
    }

    // print_r($arr_brand);
    $arr_brand_1 = array_count_values($arr_brand);


    if (!isset($_SESSION['brand'])) {
        $_SESSION['brand'] = "";
    }
?>
<div class="gb-danhmuc-sidebar-ruouvang widget-sidebar">
    <aside class="widget">
        <h3 class="widget-title-sidebar-ruouvang">Hãng sản xuất</h3>
        <div class="widget-content">
            <form action="" method="post" accept-charset="utf-8">
                <?php if ($_SESSION['brand'] == "") { ?>
                    <?php foreach ($arr_brand_1 as $k => $v) { ?>
                        <div class="checkbox">
                            <label style="width: 100%;">
                                <input type="checkbox" value="<?= $k ?>" onclick="brand(this)"><?= $k ?> <span>(<?= $v ?>)</span>
                            </label>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <?php 
                    foreach ($arr_brand_1 as $k => $v) { 
                        if ($k == $_SESSION['brand']) { 
                    ?>
                    <div class="checkbox">
                        <label style="width: 100%;">
                            <input type="checkbox" value="<?= $k ?>" onclick="brand(this)" checked ><?= $k ?> <span>(<?= $v ?>)</span>
                        </label>
                    </div>
                    <?php } } ?>
                <?php } ?>
            </form>
        </div>
    </aside>
</div>

<script>
    function brand (data) {
        var brand = data.value;
        var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var bien = this.responseText;
                // alert(bien);
                location.reload();
            }
          };
          xhttp.open("GET", "/functions/ajax/brand.php?brand="+brand, true);
          xhttp.send();
    }
</script>