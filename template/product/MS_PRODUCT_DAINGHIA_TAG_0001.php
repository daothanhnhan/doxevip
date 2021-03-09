<div class="rowTagBoxPDH">
						<?php if ($row['product_price_sale'] != 0) { ?>
                        <!-- <img src="/images/iconProductSub_01.png"> -->
                    	<?php } ?>
                        <?php if ($row['has']==1) { ?>
                        <img src="/images/stick/hang-1.png">
                    	<?php } elseif ($row['has']==2) { ?>
                        <img src="/images/stick/hang-2.png">
                    	<?php } else { ?>
                    	<img src="/images/stick/hang-3.png">
                    	<?php } ?>
                    </div>