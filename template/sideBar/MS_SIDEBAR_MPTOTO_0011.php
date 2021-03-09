<?php 
foreach ($thuoc_tinh_1 as $item_n) {

?>
<div class="gb-danhmuc-sidebar-ruouvang widget-sidebar">
    <aside class="widget">
        <h3 class="widget-title-sidebar-ruouvang"><?= $action->getDetail('thuoc_tinh', 'id',$item_n['name'])['name'] ?></h3>
        <div class="widget-content">
            <form action="" method="post" accept-charset="utf-8">
                <?php 
                foreach ($item_n['value'] as $item_v) { 
                    $checkbox = '';
                    foreach ($_SESSION['attribute'] as $item_s) {
                        if ($item_s == $item_v) {
                            $checkbox = 'checked';
                            // break;
                        }
                    }
                ?>
                    <div class="checkbox">
                        <label style="width: 100%;">
                            <input type="checkbox" value="" onclick="attribute('<?= $item_n['name'] ?>', '<?= $item_v ?>')" <?= $checkbox ?> ><?= $action->getDetail('thuoc_tinh_value', 'id',$item_v)['name'] ?> 
                        </label>
                    </div>
                <?php } ?>    
            </form>
        </div>
    </aside>
</div>
<?php } ?>
<script>
    function attribute (name, value) {
        // alert('attribute');

        var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var bien = this.responseText;
                // alert(bien);
                // location.reload();
                window.location.href = "/<?= $_GET['page'] ?>";
            }
          };
          xhttp.open("GET", "/functions/ajax/attribute.php?name="+name+"&value="+value, true);
          xhttp.send();
    }
</script>