<?php 
	session_start();
	$name = $_GET['name'];
	$value = $_GET['value'];

	// if (empty($_SESSION['attribute'])) {
	// 	$_SESSION['attribute'][] = array(
	// 		'name' => $name,
	// 		'value' => $value
	// 	);
	// 	echo 'moi';
	// } else {
	// 	$arr_name = array();
	// 	foreach ($_SESSION['attribute'] as $k => $v) {
	// 		$arr_name[] = $v['name'];
	// 	}
	// 	if (in_array($name, $arr_name)) {
	// 		foreach ($_SESSION['attribute'] as $k => $v) {
	// 			if ($name == $v['name']) {
	// 				unset($_SESSION['attribute'][$k]);
	// 			}
	// 		}
	// 		echo 'xoa';
	// 	} else {
	// 		$_SESSION['attribute'][] = array(
	// 				'name' => $name,
	// 				'value' => $value
	// 			);
	// 		echo 'them';
	// 	}
	// }

	if (empty($_SESSION['attribute'])) {
		$_SESSION['attribute'][] = $value;
	} else {
		if (!in_array($value, $_SESSION['attribute'])) {
			$_SESSION['attribute'][] = $value;
		} else {
			foreach ($_SESSION['attribute'] as $k => $item) {
				if ($item == $value) {
					unset($_SESSION['attribute'][$k]);
				}
			}
		}
	}
	
?>