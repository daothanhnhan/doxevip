<?php 
    function uploadPicture($src, $img_name, $img_temp){

		$src = $src.$img_name;//echo $src;

		if (!@getimagesize($src)){

			if (move_uploaded_file($img_temp, $src)) {

				return true;

			}

		}

	}

	

	function khuyen_mai ($id) {
		global $conn_vn;
		if (isset($_POST['add_sale'])) {
			$src= "../images/";
			// $src = "uploads/";
			$image = '';
			if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){

				uploadPicture($src, $_FILES['image']['name'], $_FILES['image']['tmp_name']);
				$image = $_FILES['image']['name'];

			}

			$link = $_POST['link'];
			
			if ($image == '') {
				$sql = "UPDATE sale_item SET link = '$link' WHERE id = $id";
			} else {
				$sql = "UPDATE sale_item SET link = '$link', image = '$image' WHERE id = $id";
			}

			$result = mysqli_query($conn_vn, $sql);
			if ($result) {
				echo '<script type="text/javascript">alert(\'Bạn đã sửa được một khuyến mãi.\')</script>';
			} else {
				echo '<script type="text/javascript">alert(\'Có lỗi xảy ra.\')</script>';
			}
			
		}
	}

	khuyen_mai($_GET['id']);
	$info = $action->getDetail('sale_item', 'id', $_GET['id']);
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="rowNodeContentPage">
        <div class="leftNCP">
            <span class="titLeftNCP">Nội dung </span>
            <p class="subLeftNCP">Nhập thông tin<br /><br /></p>     
            <p class="subLeftNCP"><a href="index.php?page=khuyen-mai&sale_cat_id=<?= $info['sale_cat_id'] ?>">Quay lại</a><br /><br /></p>     
                    
        </div>
        <div class="boxNodeContentPage">
            <p class="titleRightNCP">Link</p>
            <input type="text" class="txtNCP1" name="link" value="<?= $info['link'] ?>" />
            <p class="titleRightNCP">Ảnh</p>
            <input type="file" class="txtNCP1" name="image" />
            <img src="/images/<?= $info['image'] ?>" width="100">
            
        </div>
    </div><!--end rowNodeContentPage-->
    
    <button class="btn btnSave" type="submit" name="add_sale">Lưu</button>
</form>
            
<p class="footerWeb">Cảm ơn quý khách hàng đã tin dùng dịch vụ của chúng tôi<br />Sản phẩm thuộc Công ty TNHH Truyền Thông Và Công Nghệ Cafelink Việt Nam</p>