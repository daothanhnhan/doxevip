<?php
    $action_product = new action_product();

    $material = $action_product->getProductList_byMultiLevel_orderProductId_tu($rowCat[$nameColId_productCat],'desc',$trang,32,$slug);

    $arr_material = array();
    foreach ($material as $item) {
        if ($item['product_material'] != "") {
            $arr_material[] = strtoupper(trim($item['product_material'], " "));
        }
    }

    $arr_material = array_count_values($arr_material);


    if (!isset($_SESSION['material'])) {
        $_SESSION['material'] = "";
    }
?>
<div class="gb-danhmuc-sidebar-ruouvang widget-sidebar">
    <aside class="widget">
        <h3 class="widget-title-sidebar-ruouvang">Xuất xứ</h3>
        <div class="widget-content" id="filters">
            <form action="" method="post" accept-charset="utf-8" >
                <?php if ($_SESSION['material'] == "") { ?>
                    <?php foreach ($arr_material as $k => $v) { ?>
                        <div class="checkbox">
                            <label style="width: 100%;">
                                <input type="checkbox" value="<?= $k ?>" onclick="material(this)"><?= $k ?> <span>(<?= $v ?>)</span>
                            </label>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <?php 
                    foreach ($arr_material as $k => $v) {
                        if ($k == $_SESSION['material']) { 
                    ?>
                    <div class="checkbox">
                        <label style="width: 100%;">
                            <input type="checkbox" value="<?= $k ?>" onclick="material(this)" checked ><?= $k ?> <span>(<?= $v ?>)</span>
                        </label>
                    </div>
                    <?php } } ?>
                <?php } ?>
            </form>
        </div>
    </aside>
</div>
<script>
    function material (data) {
        var material = data.value;
        var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var bien = this.responseText;
                // alert(bien);
                location.reload();
            }
          };
          xhttp.open("GET", "/functions/ajax/material.php?material="+material, true);
          xhttp.send();
    }
</script>