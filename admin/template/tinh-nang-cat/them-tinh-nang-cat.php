<?php 
    function uploadPicture($src, $img_name, $img_temp){

		$src = $src.$img_name;//echo $src;

		if (!@getimagesize($src)){

			if (move_uploaded_file($img_temp, $src)) {

				return true;

			}

		}

	}

	

	function tinh_nang_cat () {
		global $conn_vn;
		if (isset($_POST['add_tn_cat'])) {
			$src= "../images/";
			// $src = "uploads/";

			$image = '';
			if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){

				uploadPicture($src, $_FILES['image']['name'], $_FILES['image']['tmp_name']);
				$image = $_FILES['image']['name'];

			}

			$name = mysqli_real_escape_string($conn_vn, $_POST['name']);
			$product_id = mysqli_real_escape_string($conn_vn, $_POST['product_id']);

			$sql = "INSERT INTO tinh_nang_cat (name, product_id) VALUES ('$name', '$product_id')";
			$result = mysqli_query($conn_vn, $sql);
			if ($result) {
				echo '<script type="text/javascript">alert(\'Bạn đã thêm được một loại tính năng.\');window.location.href="index.php?page=tinh-nang-cat&product_id='.$_GET['product_id'].'"</script>';
			} else {
				echo '<script type="text/javascript">alert(\'Có lỗi xảy ra.\')</script>';
			}
			
		}
	}

	tinh_nang_cat();
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="rowNodeContentPage">
        <div class="leftNCP">
            <span class="titLeftNCP">Nội dung </span>
            <p class="subLeftNCP">Nhập thông tin loại tính năng<br /><br /></p>     
            <p class="subLeftNCP"><a href="index.php?page=tinh-nang-cat&product_id=<?= $_GET['product_id'] ?>">Quay lại</a><br /><br /></p>     
                    
        </div>
        <div class="boxNodeContentPage">
            <p class="titleRightNCP">Tên loại tính năng</p>
            <input type="text" class="txtNCP1" name="name" required/>
            <input type="hidden" name="product_id" value="<?= $_GET['product_id'] ?>">
            
        </div>
    </div><!--end rowNodeContentPage-->
    
    <button class="btn btnSave" type="submit" name="add_tn_cat">Lưu</button>
</form>
            
<p class="footerWeb">Cảm ơn quý khách hàng đã tin dùng dịch vụ của chúng tôi<br />Sản phẩm thuộc Công ty TNHH Truyền Thông Và Công Nghệ Cafelink Việt Nam</p>