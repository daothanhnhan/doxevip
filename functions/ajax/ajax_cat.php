<?php
	
	if(isset($_POST['category_list'])){

		include_once('../database.php');

		$id_cat = $_POST['category_list'];
		$arr_cat = 	explode(",", $id_cat);
		$where = array();
		foreach ($arr_cat as $item) {
			$where[] = "product_material LIKE '%$item%' ";
		}

		$sql = "SELECT * FROM product";
		if($where){
			$sql .= ' WHERE '.implode(' or ', $where);
		}
		$result = mysqli_query($conn_vn, $sql);
	    if(mysqli_num_rows($result) != 0){
?>
	<div class="row">
		<?php
		    while ($row1 = mysqli_fetch_assoc($result)) {
		?>
            <div class="col-sm-4">
                <div class="gb-product-item_mptoto">
                    <div class="gb-product-item-img">
                        <div class="gb-product-item-img-main">
                            <a href="/<?= $row1['friendly_url'] ?>">
                                <img src="/images/<?= $row1['product_img'] ?>" alt="" class="img-responsive">
                            </a>
                        </div>
                        <div class="gb-product-item-img-replate">
                            <a href="/<?= $row1['friendly_url'] ?>">
                                <img src="/images/<?= $row1['product_img_2'] ?>" alt="" class="img-responsive">
                            </a>
                        </div>
                    </div>
                    <div class="gb-product-item-img-text">
                        <h2>
                            <a href="/<?= $row1['friendly_url'] ?>">
                                <?= $row1['product_name'] ?>
                            </a>
                        </h2>
                        <?= $row1['product_des'] ?>
                    </div>
                </div>
            </div>
    	<?php } ?>
        </div>
<?php } } ?>