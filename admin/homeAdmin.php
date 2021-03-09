<?php
    $action = new action_admin();
    $news = $action->getList('news','','','news_id','desc','','10','');
?>			
            
            <ul class="listTopDashboard"> 
            	<li class="DB1">
                	<a href="index.php?page=don-hang" class="linkDB">
                        <img src="image/db1.png" class="imgDB" />
                        <p class="numDB"><?php echo $action->countTotalOrderCart();?></p>
                        <p class="nameDB">Đơn hàng</p>
                    </a>                    
                </li>
            	<li class="DB2">
                	<a href="index.php?page=tai-khoan-user" class="linkDB">
                        <img src="image/db2.png" class="imgDB" />
                        <p class="numDB">02</p>
                        <p class="nameDB">Khách hàng</p>
                    </a>                    
                </li>
            	<li class="DB3">
                	<a href="index.php?page=san-pham" class="linkDB">
                        <img src="image/db3.png" class="imgDB" />
                        <p class="numDB"><?php echo $action->countTotalProducts();?></p>
                        <p class="nameDB">Sản phẩm</p>
                    </a>                    
                </li>
            	<li class="DB4">
                	<a href="index.php?page=tin-tuc" class="linkDB">
                        <img src="image/db4.png" class="imgDB" />
                        <p class="numDB"><?php echo $action->countTotalNews();?></p>
                        <p class="nameDB">Bài viết</p>
                    </a>                    
                </li>
            </ul><!--end  listTopDashboard-->       	        	
            <h1 class="titleDB">Hệ thống quản trị website</h1>
            <img src="image/mainDB.png" class="mainDB" />
            <div class="boxLeftDB">
            	<h2 class="titleBoxDB">BÀI VIẾT GẦN NHẤT</h2>
                <ul class="listNewsDB">                
				<?php
					$i = 0;
					foreach ($news as $new) {
						$i++;
				?>   
                	<li>
                    	<p class="sttNewsDB"><?php echo $i; ?></p>
                        <a href="index.php?page=sua-tin-tuc&id=<?php echo $new['news_id']; ?>" class="nameNewsDB"><?php echo $new['news_name']; ?></a>
                        <p class="dateNewsDB"><?= $new['news_update_date'] != '' ? date('d-m-Y', strtotime($new['news_update_date'])) : date('d-m-Y', strtotime($new['news_created_date'])) ?></p>
                    </li>   
                <?php } ?>
                </ul>
            </div>
            
            <p class="footerWeb">Cảm ơn quý khách hàng đã tin dùng dịch vụ của chúng tôi<br />Sản phẩm thuộc Công ty TNHH Phát Triển Thương Hiệu Cafelink Việt Nam</p>