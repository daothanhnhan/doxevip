<?php 
  function dong_bo () {
    global $conn_vn;
    $kiotviet = new action_kiotviet();
    if (isset($_POST['dong_bo'])) {
      try {
      	$product_all = $kiotviet->get_product_all_test();
      	$product_all = json_encode($product_all);
      	// var_dump($product_all);
        $sql = "UPDATE product_kiotviet SET data = ? WHERE id = 1";
        $stmt = $conn_vn->prepare($sql);
        $stmt->bind_param("s", $product_all);
        $stmt->execute();
        echo 'success';
      } catch(Exception $e) {
        echo 'Message: ' .$e->getMessage();
      }
    }
  }
  dong_bo();
  $data = $action->getDetail('product_kiotviet', 'id', '1');
  // var_dump($data);
?>
<form action="" method="post">
  <button type="submit" name="dong_bo" class="btn btn-default">Đồng bộ sản phẩm</button>
</form>
