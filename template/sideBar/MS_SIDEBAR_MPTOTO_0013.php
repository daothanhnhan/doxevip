<?php 
$rowCat_filter = $action_product->getProductCatDetail_byId($productcat_id,$lang);
$product_filter = $action_product->getProductList_byMultiLevel_orderProductId($productcat_id,'desc',$trang,'',$slug);
$thuoc_tinh = $action_product->get_list_attribute($product_filter);//var_dump($thuoc_tinh_1);

foreach ($thuoc_tinh as $item_n) {

?>
<div class="gb-danhmuc-sidebar-ruouvang widget-sidebar">
    <aside class="widget">
        <h3 class="widget-title-sidebar-ruouvang"><?= $action->getDetail('thuoc_tinh', 'id', $item_n['name'])['name'] ?></h3>
        <div class="widget-content">
            <form action="" method="post" accept-charset="utf-8">
                <?php 
                foreach ($item_n['value'] as $item_v) { 
                    $checkbox = '';
                    foreach ($_SESSION['attribute'] as $item_s) {
                        if ($item_s['name'] == $item_n['name']) {
                            $checkbox = 'checked';
                            // break;
                        }
                    }
                ?>
                    <div class="checkbox">
                        <label style="width: 100%;">
                            <input type="checkbox" value="" onclick="attribute('<?= $item_n['name'] ?>', '<?= $item_v ?>', '<?= $rowCat_filter['friendly_url'] ?>')" <?= $checkbox ?> ><?= $action->getDetail('thuoc_tinh_value', 'id', $item_v)['name'] ?> 
                        </label>
                    </div>
                <?php } ?>    
            </form>
        </div>
    </aside>
</div>
<?php } ?>
<script>
    function attribute (name, value, url) {
        // alert('attribute');

        // var xhttp = new XMLHttpRequest();
        //   xhttp.onreadystatechange = function() {
        //     if (this.readyState == 4 && this.status == 200) {
        //         var bien = this.responseText;
        //         // alert(bien);
        //         location.reload();
        //     }
        //   };
        //   xhttp.open("GET", "/functions/ajax/attribute.php?name="+name+"&value="+value, true);
        //   xhttp.send();

        window.location.href = "/index.php?page="+url+"&name="+name+"&value="+value;
    }
</script>