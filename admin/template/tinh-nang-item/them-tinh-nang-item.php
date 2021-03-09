<?php 
    function uploadPicture($src, $img_name, $img_temp){

		$src = $src.$img_name;//echo $src;

		if (!@getimagesize($src)){

			if (move_uploaded_file($img_temp, $src)) {

				return true;

			}

		}

	}

	

	function tinh_nang_item () {
		global $conn_vn;
		if (isset($_POST['add_tinhnang'])) {
			$src= "../images/tinh-nang/";
			// $src = "uploads/";

			$image = '';
			if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){

				uploadPicture($src, $_FILES['image']['name'], $_FILES['image']['tmp_name']);
				$image = $_FILES['image']['name'];

			}

			$name = mysqli_real_escape_string($conn_vn, $_POST['name']);
			$tinh_nang_cat_id = mysqli_real_escape_string($conn_vn, $_POST['tinh_nang_cat_id']);

			$sql = "INSERT INTO tinh_nang_item (name, image, tinh_nang_cat_id) VALUES ('$name', '$image', '$tinh_nang_cat_id')";
			$result = mysqli_query($conn_vn, $sql);
			if ($result) {
				echo '<script type="text/javascript">alert(\'Bạn đã thêm được một tinh năng.\');window.location.href="index.php?page=tinh-nang-item&tinh_nang_cat_id='.$_GET['tinh_nang_cat_id'].'"</script>';
			} else {
				echo '<script type="text/javascript">alert(\'Có lỗi xảy ra.\')</script>';
			}
			
		}
	}

	tinh_nang_item();
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="rowNodeContentPage">
        <div class="leftNCP">
            <span class="titLeftNCP">Nội dung </span>
            <p class="subLeftNCP">Nhập thông tin tính năng<br /><br /></p>     
            <p class="subLeftNCP"><a href="index.php?page=tinh-nang-item&tinh_nang_cat_id=<?= $_GET['tinh_nang_cat_id'] ?>">Quay lại</a><br /><br /></p>     
                    
        </div>
        <div class="boxNodeContentPage">
            <p class="titleRightNCP">Tên tính năng</p>
            <input type="text" class="txtNCP1" name="name" required/>
            <p class="titleRightNCP">Ảnh tính năng</p>
            <input type="file" class="txtNCP1" name="image" />
            <input type="hidden" name="tinh_nang_cat_id" value="<?= $_GET['tinh_nang_cat_id'] ?>">
            
        </div>
    </div><!--end rowNodeContentPage-->
    
    <button class="btn btnSave" type="submit" name="add_tinhnang">Lưu</button>
</form>
            
<p class="footerWeb">Cảm ơn quý khách hàng đã tin dùng dịch vụ của chúng tôi<br />Sản phẩm thuộc Công ty TNHH Truyền Thông Và Công Nghệ Cafelink Việt Nam</p>