<?php 
    function uploadPicture($src, $img_name, $img_temp){

		$src = $src.$img_name;//echo $src;

		if (!@getimagesize($src)){

			if (move_uploaded_file($img_temp, $src)) {

				return true;

			}

		}

	}

	

	function khuyen_mai () {
		global $conn_vn;
		if (isset($_POST['add_sale'])) {
			$src= "../images/";
			// $src = "uploads/";

			if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){

				uploadPicture($src, $_FILES['image']['name'], $_FILES['image']['tmp_name']);

			}

			$sale_cat_id = $_POST['sale_cat_id'];
			$link = $_POST['link'];
			$image = $_FILES['image']['name'];

			$sql = "INSERT INTO sale_item (sale_cat_id, image, link) VALUES ('$sale_cat_id', '$image', '$link')";//echo $sql;
			$result = mysqli_query($conn_vn, $sql);
			if ($result) {
				echo '<script type="text/javascript">alert(\'Bạn đã thêm được một khuyến mãi.\');window.location.href="index.php?page=khuyen-mai&sale_cat_id='.$sale_cat_id.'"</script>';
			} else {
				echo '<script type="text/javascript">alert(\'Có lỗi xảy ra.\')</script>';
			}
			
		}
	}

	khuyen_mai();
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="rowNodeContentPage">
        <div class="leftNCP">
            <span class="titLeftNCP">Nội dung </span>
            <p class="subLeftNCP">Nhập thông tin<br /><br /></p>     
            <p class="subLeftNCP"><a href="index.php?page=khuyen-mai&sale_cat_id=<?= $_GET['sale_cat_id'] ?>">Quay lại</a><br /><br /></p>
                    
        </div>
        <div class="boxNodeContentPage">
            <input type="hidden" name="sale_cat_id" value="<?= $_GET['sale_cat_id'] ?>">
            <p class="titleRightNCP">Link</p>
            <input type="text" class="txtNCP1" name="link" />
            <p class="titleRightNCP">Ảnh</p>
            <input type="file" class="txtNCP1" name="image" required/>
            
        </div>
    </div><!--end rowNodeContentPage-->
    
    <button class="btn btnSave" type="submit" name="add_sale">Lưu</button>
</form>
            
<p class="footerWeb">Cảm ơn quý khách hàng đã tin dùng dịch vụ của chúng tôi<br />Sản phẩm thuộc Công ty TNHH Truyền Thông Và Công Nghệ Cafelink Việt Nam</p>