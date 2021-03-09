<?php 
	include_once dirname(__FILE__) . "/../database.php";
	include_once dirname(__FILE__) . "/../library.php";
	include_once dirname(__FILE__) . "/../action.php";

	$action = new action();

	$hang = $_GET['hang'];
	if ($hang == 0) {
		$procat_level_2 = array();
	} else {
		$procat_level_2 = $action->getList('productcat', 'productcat_parent', $hang, 'productcat_id', 'asc', '', '', '');
	}
?>
<option value="0">-Chọn dòng xe</option>
<?php 
foreach ($procat_level_2 as $item) { 
	if ($item['state']==0) {
		continue;
	}
?>
<option value="<?= $item['productcat_id'] ?>"><?= $item['productcat_name'] ?></option>
<?php } ?>