<?php 
	$procat_level_1 = $action->getList('productcat', 'productcat_parent', '0', 'productcat_sort_order', 'desc', '', '', '');
?>
<style>
.cat-mb a {
	background: #e5e5e5;
	text-align: center;
	border-radius: 3px;
	border: 1px solid #148cc5;
	width: 100%;
	padding: 20px 5px;
}
.cat-mb .cat-mb-item {
	width: 24%;
	display: inline-block;
}
.navhome a {
    float: left;
    position: relative;
    width: 23%;
    height: 42px;
    margin: 0 0 5px 1.18%;
    border: 1px solid #148cc5;
    border-radius: 3px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    background: #e5e5e5;
    background: -webkit-gradient(linear,0% 0%,0% 100%,from(#e5e5e5),to(#fff));
    background: -webkit-linear-gradient(top,#fff,#e5e5e5);
    background: -moz-linear-gradient(top,#fff,#e5e5e5);
    background: -ms-linear-gradient(top,#fff,#e5e5e5);
    background: -o-linear-gradient(top,#fff,#e5e5e5);
    text-align: center;
    color: #3a3838;
    font-weight: 700;
    padding-top: 10px;
}
</style>
<div class="navhome hidden-md hidden-lg hidden-sm hidden" style="margin-top: 10px;">
		<?php 
		$d = 0;
		foreach ($procat_level_1 as $item) { 
			$d++;	
		?>
		    <a href="/<?= $item['friendly_url'] ?>" title=""><?= $item['productcat_name'] ?></a>
		<?php } ?>
	</div>
	
</div>