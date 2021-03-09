<?php 
$rows_nhantin = $action->getList('regMember','','','id','desc',$trang,20,'nhan-tin');//var_dump($rows_lien_he);die();
?>
<div class="container">
  <h2>Bảng nhận tin.</h2>            
  <table class="table">
    <thead>
      <tr>
      	<th>STT</th>
        <th>Số điện thoại</th>
      </tr>
    </thead>
    <tbody>
    <?php 
    $d = 0;
    foreach ($rows_nhantin['data'] as $item) { 
        $d++;
        ?>
      <tr>
        <td><?php echo $d ;?></td>
        <td><?php echo $item['email'];?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
<?php
    echo $rows_nhantin['paging'];
?>
</div>
