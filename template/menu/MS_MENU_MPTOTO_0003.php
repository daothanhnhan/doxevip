<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <?php
        $list_menu = $menu->getListMainMenu_byOrderASC();
        $menu->showMenu_byMultiLevel_mainMenuDN_mb_left($list_menu,0,$lang,0);
    ?>
    <hr style="margin-top: 0;margin-bottom: 0;border-top: 1px solid #d2cbcb;">
    <?php 
    foreach ($list_procat1 as $item_cat1) { 
        
        // $list_procat2 = $kiotviet->get_procat_list($all_procat, $item_cat1['categoryId']);
    ?>
    <a href="/<?= $item_cat1['friendly_url'] ?>" title=""><i class="fa fa-check" aria-hidden="true"></i> <?= $item_cat1['productcat_name'] ?></a>
    <?php } ?>
</div>
<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
</script>