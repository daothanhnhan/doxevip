<?php 
// Cấu hình vị trí độ mờ
$horiz_position = 'left'; // center | left | right
$horiz_shift = '20'; //Khoảng cách pixel với tọa độ x
$vert_position = 'top'; // middle | top | bottom
$vert_shift = '20'; //Khoảng cách pixel với tọa độ y
$transparency = '50'; //Tính trong suốt của hình logo mờ
$anh = $_GET['anh'];
$picture = imagecreatefromjpeg($anh); // Hình ảnh cần gắn logo mờ
$logo_watermark = imagecreatefrompng('logo-doxe-1.png'); // Hình logo (chọn file png)
 
$pct = $transparency/100;
$w = imagesx($logo_watermark);
$h = imagesy($logo_watermark);
 
imageAlphaBlending($logo_watermark, false);
// Tìm pixel mờ nhất trong hình ảnh (pixel có giá trị alpha nhỏ nhất)
// $minAlpha = 127;
// for($x = 0; $x < $w; $x++) {
// 	for($y = 0; $y < $h; $y++) {
// 		$alpha = (imagecolorat($logo_watermark, $x, $y) >> 24) & 0xFF;
// 		if($alpha < $minAlpha) {
// 			$minAlpha = $alpha;
// 		}
// 	}
// }
 
// Lặp qua các pixel hình ảnh và sửa đổi alpha cho từng pixel
// for($x = 0; $x < $w; $x++) {
// 	for($y = 0; $y < $h; $y++) {
// 		$colorXY = imagecolorat($logo_watermark, $x, $y);
// 		$alpha = ($colorXY >> 24) & 0xFF;
// 		if($minAlpha !== 127) {
// 			$alpha = 127 + 127 * $pct * ($alpha - 127) / (127 - $minAlpha);
// 		} else {
// 			$alpha += 127 * $pct;
// 		}
// 		$alphaColorXY = imagecolorallocatealpha(
// 			$logo_watermark,
// 			($colorXY >> 16) & 0xFF,
// 			($colorXY >> 8) & 0xFF,
// 			$colorXY & 0xFF,
// 			$alpha
// 		);
// 		if(!imagesetpixel($logo_watermark, $x, $y, $alphaColorXY)) {
// 			return false;
// 		}
// 	}
// }
 
$picture_width=imageSX($picture);
$picture_height=imageSY($picture);
$watermarkfile_width=imageSX($logo_watermark);
$watermarkfile_height=imageSY($logo_watermark);
 
// Lấy vị trí tọa độ x cho hình mờ
switch ($horiz_position) {
case 'center':
	$dest_x = ( $picture_width / 2 ) - ( $watermarkfile_width / 2 );
	break;
case 'left':
	$dest_x = $horiz_shift;
	break;
case 'right':
	$dest_x = $picture_width - $watermarkfile_width - $horiz_shift;
	break;
}
 
// Lấy vị trí tọa độ y cho hình mờ
switch ($vert_position) {
case 'middle':
	$dest_y = ( $picture_height / 2 ) - ( $watermarkfile_height / 2 );
	break;
case 'top':
	$dest_y = $vert_shift;
	break;
case 'bottom':
	$dest_y = $picture_height - $watermarkfile_height - $vert_shift;
	break;
}
 
// Dùng cho hình gif
// if($picture_fileType == 'gif') {
	// $tempimage = imagecreatetruecolor($picture_width, $picture_height);
	// imagecopy($tempimage, $picture, 0, 0, 0, 0, $picture_width, $picture_height);
	// $picture = $tempimage;
// }
 
imagecopy($picture, $logo_watermark, $dest_x, $dest_y, 0, 0, $watermarkfile_width, $watermarkfile_height);
 
header('Content-Type: image/png'); 
imagepng($picture);
?>