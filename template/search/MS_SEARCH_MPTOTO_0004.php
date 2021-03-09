<?php 
	$procat_level_1 = $action->getList('productcat', 'productcat_parent', '0', 'productcat_sort_order', 'desc', '', '', '');//var_dump($procat_level_1);
?>
<div class="container" style="padding-left: 30px;padding-right: 30px;margin-top: 20px; ">
	
	<div class="row" style="background: #fe0002;padding: 10px 20px;border-radius: 5px; text-align: center;">
		<p class="doxe-text">BẠN MUỐN ĐỘ XE GÌ?</p>
		<form class="form-inline" action="/action_page.php">
		
			<div class="form-group" style="display: block;">
			  
			  <select class="form-control" id="sel1" style="width: 40%;" onchange="hang_xe(this.value)">
			    <option value="0">-Chọn hãng xe-</option>
			    <?php 
			    foreach ($procat_level_1 as $item) { 
			    	if ($item['state']==0) {
			    		continue;
			    	}
			    ?>
			    <option value="<?= $item['productcat_id'] ?>"><?= $item['productcat_name'] ?></option>
			    <?php } ?>
			  </select>
  			</div>
			
		<br>
		
			<div class="form-group" style="display: block;">
			  
			  <select class="form-control" id="sel2" style="width: 40%;">
			    <option value="0">-Chọn dòng xe-</option>
			    
			  </select>
  			</div>
			
		<br>
		<div class="">
			<button type="button" class="btn btn-warning" onclick="do_xe()">Độ xe thôi !</button>
		</div>
	</form>
	</div>

</div>

<script>
	function hang_xe (hang) {
		// alert(hang);

		var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        	if (this.readyState == 4 && this.status == 200) {
           		document.getElementById("sel2").innerHTML = this.responseText;
        	}
        };
        xhttp.open("GET", "/functions/ajax1/hang_xe.php?hang="+hang, true);
        xhttp.send();
	}

	function do_xe () {
		var hang = document.getElementById("sel1").value;
		var dong = document.getElementById("sel2").value;
		// alert(hang);

		if (hang == 0 || dong == 0) {
			return false;
		}

		var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        	if (this.readyState == 4 && this.status == 200) {
           		var link = this.responseText;
           		window.location.href = '/'+link;
        	}
        };
        xhttp.open("GET", "/functions/ajax1/do_xe.php?hang="+hang+"&dong="+dong, true);
        xhttp.send();
	}
</script>