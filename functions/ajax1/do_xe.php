<?php 
	include_once dirname(__FILE__) . "/../database.php";
	include_once dirname(__FILE__) . "/../library.php";
	include_once dirname(__FILE__) . "/../action.php";

	$action = new action();

	$hang = $_GET['hang'];
	$dong = $_GET['dong'];
	
	$procat = $action->getDetail('productcat', 'productcat_id', $dong);
	echo $procat['friendly_url'];
?>