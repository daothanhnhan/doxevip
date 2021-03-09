<?php
include_once dirname(__FILE__) . "/../functions/database.php";
include_once dirname(__FILE__) . "/../functions/library.php";
include_once dirname(__FILE__) . "/../functions/action.php";

$action = new action();

$pro_id = $_GET['pro_id'];

$product = $action->getDetail('product', 'product_id', $pro_id);

$anh_chinh = json_decode($product['product_des2'], true);//echo $anh_chinh[0];
$link = $product['friendly_url'];//echo $link;

function doi_ten ($link, $ten) {
	// $url = "http://curl.phptrack.com/images/header.jpg";
	// $url = "http://www.w3schools.com/images/w3schoolslogo.gif";
	// $url = "http://sanquocte.cafelinkcustomer.info/images/ion-boxes/banner-right.png";
	$url = 'http://'.$_SERVER['SERVER_NAME'].'/watermark/index.php?anh='.$link;
	$file = explode('.', $url);
	$duoi = end($file);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
	curl_setopt($ch, CURLOPT_URL, $url);
	$result = curl_exec($ch);
	curl_close($ch);
	// Lưu file ảnh
	$fullpath = basename($url);
	if (file_exists($fullpath)) {
	unlink($fullpath);
	}
	$fp = fopen($fullpath, 'x');
	fwrite($fp, $result);
	fclose($fp);

	//Di chuyển file ảnh sang thư mục khác
	rename($fullpath, "images/" . $ten .'.'.$duoi);
	// đóng thành hàng
	// tên sản phẩm lấy từ đâu
}

function doi_file ($file) {
	$file = explode('.', $file);
	$duoi = end($file);
	return $duoi;
}

$anh = array();
$d = 0;
foreach ($anh_chinh as $item) {
	$d++;

	if (strpos($item,"http")===false) {
      	$item = 'http:'.$item;
    }

    $duoi = doi_file($item);

	$ten_anh = $link.'-'.$d;
	$anh[] = $ten_anh.'.'.$duoi;
	doi_ten($item, $ten_anh);
}

$anh = json_encode($anh);
$anh = mysqli_real_escape_string($conn_vn, $anh);
$sql = "UPDATE product SET ten_anh_doi = '$anh' WHERE product_id = $pro_id";
$result = mysqli_query($conn_vn, $sql);

if ($result) {
	echo 'Đổi tên anh thành công';
} else {
	echo 'Có lỗi xảy ra';
}
///////////////////////
function doi_ten_taobao ($link, $ten) {
	// $url = "http://curl.phptrack.com/images/header.jpg";
	// $url = "http://www.w3schools.com/images/w3schoolslogo.gif";
	// $url = "http://sanquocte.cafelinkcustomer.info/images/ion-boxes/banner-right.png";
	$url = 'http://'.$_SERVER['SERVER_NAME'].'/watermark/index.php?anh='.$link;
	$file = explode('.', $url);
	$duoi = end($file);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
	curl_setopt($ch, CURLOPT_URL, $url);
	$result = curl_exec($ch);
	curl_close($ch);
	// Lưu file ảnh
	$fullpath = basename($url);
	if (file_exists($fullpath)) {
	unlink($fullpath);
	}
	$fp = fopen($fullpath, 'x');
	fwrite($fp, $result);
	fclose($fp);

	//Di chuyển file ảnh sang thư mục khác
	rename($fullpath, "taobao/" . $ten .'.'.$duoi);
	// đóng thành hàng
	// tên sản phẩm lấy từ đâu
}
if (!empty($product['product_sub_info1'])) {
	$anh_tinh_nang = json_decode($product['product_sub_info1'], true);//echo $anh_chinh[0];

	$anh_taobao = array();
	$d = 0;
	foreach ($anh_tinh_nang as $item) {
		$d++;

		if (strpos($item,"http")===false) {
	      	$item = 'http:'.$item;
	    }

	    $duoi = doi_file($item);

		$ten_anh = $link.'-'.$d;
		$anh_taobao[] = $ten_anh.'.'.$duoi;
		doi_ten_taobao($item, $ten_anh);
	}

	$anh_taobao = json_encode($anh_taobao);
	$anh_taobao = mysqli_real_escape_string($conn_vn, $anh_taobao);
	$sql = "UPDATE product SET anh_taobao_1 = '$anh_taobao' WHERE product_id = $pro_id";
	$result = mysqli_query($conn_vn, $sql);
}
////////////////////////
function doi_ten_ali ($link, $ten) {
	// $url = "http://curl.phptrack.com/images/header.jpg";
	// $url = "http://www.w3schools.com/images/w3schoolslogo.gif";
	// $url = "http://sanquocte.cafelinkcustomer.info/images/ion-boxes/banner-right.png";
	$url = 'http://'.$_SERVER['SERVER_NAME'].'/watermark/index.php?anh='.$link;
	$file = explode('.', $url);
	$duoi = end($file);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
	curl_setopt($ch, CURLOPT_URL, $url);
	$result = curl_exec($ch);
	curl_close($ch);
	// Lưu file ảnh
	$fullpath = basename($url);
	if (file_exists($fullpath)) {
	unlink($fullpath);
	}
	$fp = fopen($fullpath, 'x');
	fwrite($fp, $result);
	fclose($fp);

	//Di chuyển file ảnh sang thư mục khác
	rename($fullpath, "ali/" . $ten .'.'.$duoi);
	// đóng thành hàng
	// tên sản phẩm lấy từ đâu
}
if (!empty($product['tinh_nang_2'])) {
	$tinh_nang_ali = json_decode($product['tinh_nang_2'], true);
	$doxe = array();
	$d = 0;
	foreach ($tinh_nang_ali as $loai) {
		$doxe_item = array();
		foreach ($loai['skuPropertyValues'] as $item) {
			$d++;
			$duoi = doi_file($item['skuPropertyImagePath']);
			$ten_anh = $link.'-'.$d;
			$anh_ali = $ten_anh.'.'.$duoi;
			doi_ten_ali($item['skuPropertyImagePath'], $ten_anh);
			////////////
			$doxe_item[] = array(
				'propertyValueDisplayName' => $item['propertyValueDisplayName'],	
				'propertyValueId' => $item['propertyValueId'],	
				'skuPropertyImagePath' => $item['skuPropertyImagePath'],	
				'show' => $item['show'],	
				'doxe_anh' => $anh_ali,
			);
		}
		$doxe[] = array(
			'skuPropertyName' => $loai['skuPropertyName'],
			'skuPropertyValues' => $doxe_item
		);
	}

	$doxe_anh = json_encode($doxe);
	$doxe_anh = mysqli_real_escape_string($conn_vn, $doxe_anh);
	$sql = "UPDATE product SET tinh_nang_2 = '$doxe_anh' WHERE product_id = $pro_id";
	$result = mysqli_query($conn_vn, $sql);
}
?>