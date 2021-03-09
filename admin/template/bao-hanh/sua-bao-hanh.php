<?php 
    function uploadPicture($src, $img_name, $img_temp){

		$src = $src.$img_name;//echo $src;

		if (!@getimagesize($src)){

			if (move_uploaded_file($img_temp, $src)) {

				return true;

			}

		}

	}

	

	function bao_hanh ($id) {
		global $conn_vn;
		if (isset($_POST['add_baohanh'])) {
			$src= "../images/";
			// $src = "uploads/";

			if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){

				uploadPicture($src, $_FILES['image']['name'], $_FILES['image']['tmp_name']);

			}

			$mabaohanh = $_POST['mabaohanh'];
			$product_id = $_POST['product_id'];
			$date_start = $_POST['date_start'];
			$so_ngay = $_POST['so_ngay'];

			$sql = "UPDATE bao_hanh SET mabaohanh = '$mabaohanh', product_id = $product_id, date_start = '$date_start', so_ngay = $so_ngay WHERE id = $id";
			$result = mysqli_query($conn_vn, $sql);
			if ($result) {
				echo '<script type="text/javascript">alert(\'Bạn đã sửa được một bảo hành.\')</script>';
			} else {
				echo '<script type="text/javascript">alert(\'Có lỗi xảy ra.\')</script>';
			}
			
		}
	}

	bao_hanh($_GET['id']);
    $info = $action->getDetail('bao_hanh', 'id', $_GET['id']);
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="rowNodeContentPage">
        <div class="leftNCP">
            <span class="titLeftNCP">Nội dung </span>
            <p class="subLeftNCP">Nhập thông tin bảo hành<br /><br /></p>     
            <p class="subLeftNCP"><a href="index.php?page=bao-hanh">Quay lại</a><br /><br /></p>     
                    
        </div>
        <div class="boxNodeContentPage">
            <p class="titleRightNCP">Mã bảo hành (số điện thoại)</p>
            <input type="number" class="txtNCP1" name="mabaohanh" value="<?= $info['mabaohanh'] ?>" required/>
            <p class="titleRightNCP">Mã sản phẩm</p>
            <input type="number" class="txtNCP1" name="product_id" value="<?= $info['product_id'] ?>" required/>
            <p class="titleRightNCP">Ngày mua</p>
            <input type="date" class="txtNCP1" name="date_start" value="<?= $info['date_start'] ?>" required/>
            <p class="titleRightNCP">Số ngày bảo hành</p>
            <input type="number" class="txtNCP1" name="so_ngay" value="<?= $info['so_ngay'] ?>" required/>
            
        </div>
    </div><!--end rowNodeContentPage-->
    
    <button class="btn btnSave" type="submit" name="add_baohanh">Lưu</button>
</form>
            
<?php
    if (isset($_GET['search']) && $_GET['search'] != '') {
        $rows = $action->getSearchAdmin('product',array('product_name','product_code'), $_GET['search'],$trang,20,$_GET['page']);
    }else{
        $rows = $action->getList('product','','','product_id','desc',$trang,20,'sua-bao-hanh');
    }
?>	
<div class="boxPageNews">
	<div class="searchBox">
        <form action="">
            <input type="hidden" name="page" value="sua-bao-hanh">
            <button type="submit" class="btnSearchBox" name="">Tìm kiếm</button>
            <input type="text" class="txtSearchBox" name="search" />                                  
        </form>
    </div>
    <table class="table table-condensed table-hover">
        <thead>
            <tr>
                <th>Tên</th>
                <th>Mã sản phẩm</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach ($rows['data'] as $key => $row) {
                ?>
                    <tr>
                        <td><a href="index.php?page=sua-san-pham&id=<?= $row['product_id']; ?>" title=""><?= $row['product_name']; ?></a></td>
                        <td>
                            <?php 
                            	echo $row['product_id'];
                            ?>
                        </td>
                    </tr>
                <?php
                }
            ?>
        </tbody>
    </table>
	
    <div class="paging">             
    	<?= $rows['paging'] ?>
	</div>
</div>
<?php  ?>
<p class="footerWeb">Cảm ơn quý khách hàng đã tin dùng dịch vụ của chúng tôi<br />Sản phẩm thuộc Công ty TNHH Truyền Thông Và Công Nghệ Cafelink Việt Nam</p>