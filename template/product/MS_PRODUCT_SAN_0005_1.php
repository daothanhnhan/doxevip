<div style="display: flex;flex-wrap: wrap;clear: both;">
                                <?php 
                                $d = 0;
                                $d1 = 0;
                                foreach ($anh_tinh_nang as $item) { 
                                  $d1++;
                                  $cl = 1;
                                  if ($item == 'no-image.jpg') {
                                    $cl = 0;
                                  } else {
                                    $d++;
                                  }
                                  ?>
                                  <div style="width: 150px;display: inline-block;border:1px solid black;margin: 3px;border-radius: 5px;" onclick="anh(<?= $d ?>, <?= $gia_tinh_nang[$d1-1] ?>, <?= $cl ?>)">
                                    <img src="<?= $item ?>" alt="" width="50">
                                    <?= $ten_anh[$d1-1] ?>
                                  </div>
                                  
                                <?php } ?>
                                </div>