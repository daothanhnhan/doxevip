<?php
    session_start();
    if ($_POST['sort'] == 'menu_order') {
        $_SESSION['sort'] = 'menu_order';
    }
    if ($_POST['sort'] == 'name_asc') {
        $_SESSION['sort'] = 'name_asc';
    }
    if ($_POST['sort'] == 'price_asc') {
        $_SESSION['sort'] = 'price_asc';
    }
    if ($_POST['sort'] == 'price_desc') {
        $_SESSION['sort'] = 'price_desc';
    }
    $order = ' ORDER BY product.product_id asc';
    if(isset( $_POST["sort"])){
        if($_POST["sort"] == 'name_asc') $order = " ORDER BY product_name asc";
        if($_POST["sort"] == 'price_asc') $order = " ORDER BY product_price asc";
        if($_POST["sort"] == 'price_desc') $order = " ORDER BY product_price desc";
         
    }
    include '../database.php';
    $number = $_POST["number"];
    $limit = $_POST["limit"];
    function set_product($limit, $order, $number) {
        global $conn_vn;
        $sql = "SELECT * FROM product_languages INNER JOIN product ON product_languages.product_id = product.product_id Where 1";
        $result = mysqli_query($conn_vn, $sql);
        $count = mysqli_num_rows($result);
        $start =  $limit* $number;
        $sql = $sql.$order." LIMIT $start,$number"; 
        // echo $sql;
        $result = mysqli_query($conn_vn, $sql);
        $rows = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        $return = array(
            'data' => $rows,
            'count' => $count
        );
        return $return;
    }
    $rows = set_product($limit, $order, $number);

    echo '<div class="tab-pane active" id="tab_default_1">
            <div class="row">'; 
            foreach ($rows['data'] as $row) {
             echo '<div class="col-sm-4 col-xs-6">
                        <div class="gb-product-item_mptoto">
                            <div class="gb-product-item-img">
                                <div class="gb-product-item-img-main">
                                    <a href="'.$row["friendly_url"].'">
                                        <img src="/images/'.$row["product_img"].'" alt="" class="img-responsive">
                                    </a>
                                </div>
                                <div class="gb-product-item-img-replate">
                                    <a href="'.$row["friendly_url"].'">
                                        <img src="/images/'.$row["product_img"].'" alt="" class="img-responsive">
                                    </a>
                                </div>
                            </div>
                            <div class="gb-product-item-img-text">
                                <h2>
                                    <a href="'.$row["friendly_url"].'">
                                        '.$row["product_name"].'
                                    </a>
                                </h2>
                                '.$row["product_des"].'
                                <div class="gb-product-item-prices_mptoto">
                                             <p class="gb-prices-news">'.number_format($row1['product_price_sale']).' VNĐ</p>
                                             <p class="gb-prices-old">'.number_format($row1['product_price']).' VNĐ</p>
                                         </div>
                            </div>
                        </div>
                    </div>';
            }
    echo '</div></div>';


    echo '
     <div class="tab-pane" id="tab_default_2">
                            ';
                            foreach ($rows['data'] as $row) {
                            echo '
                                <div class="gb-product-item_mptoto">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="gb-product-item-img">
                                                <div class="gb-product-item-img-main">
                                                    <a href="'.$row["friendly_url"].'">
                                                     <img src="/images/'.$row["product_img"].'" alt="" class="img-responsive">
                                                 </a>
                                                </div>
                                                <div class="gb-product-item-img-replate">
                                                    <a href="'.$row["friendly_url"].'">
                                                     <img src="/images/'.$row["product_img"].'" alt="" class="img-responsive">
                                                 </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="gb-product-item-img-text">
                                            <h2>
                                                <a href="'.$row["friendly_url"].'">
                                                 '.$row["product_name"].'
                                             </a>
                                            </h2>
                                             '.$row["product_des"].'
                                            <div class="gb-product-item-prices_mptoto">
                                             <p class="gb-prices-news">'.number_format($row1['product_price_sale']).' VNĐ</p>
                                             <p class="gb-prices-old">'.number_format($row1['product_price']).' VNĐ</p>
                                         </div>
                                        </div>
                                        </div>
                                    </div>
                                    </div>';
                             }
                    echo '    </div>
    ';

?>
