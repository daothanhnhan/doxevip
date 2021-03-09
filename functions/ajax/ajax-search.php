<?php
include_once('../database.php');
include_once dirname(__FILE__)."/../library.php";
include_once dirname(__FILE__)."/../pagination/Pagination.php";
// include_once dirname(__FILE__)."/../action_kiotviet.php";
include_once dirname(__FILE__)."/../action.php";
// $kiotviet = new action_kiotviet();
$action = new action();
// $product_all = $kiotviet->get_product_all_db_1();

if (isset($_GET['keyword'])) {
    $keyword = trim($_GET['keyword']);
    $keyword = mysqli_real_escape_string($conn_vn, $keyword);
    $query = "SELECT * FROM product WHERE (product_name LIKE '%$keyword%' OR product_des LIKE '%$keyword%') AND state = 1 LIMIT 10 ";
    $result = mysqli_query($conn_vn, $query);
    if ($result) {
        if (mysqli_affected_rows($conn_vn) != 0) {
            while ($row1 = mysqli_fetch_array($result)) {
                $anh = json_decode($row1['product_des2']);
                $gia = json_decode($row1['product_sub_info2']);
                
                echo '<ul>
                            <li>
                                <a href="/' . $row1['friendly_url'] . '" title="">
                                    <div class="product-image">
                                        <img alt="" src="' . $anh[0] . '">
                                    </div>
                                    <div class="product-name">' . $row1['product_name'] . '</div>';
                if ($row1['product_price_sale'] == 0) {
                    echo '<div class="product-price">
                            <span class="price">' . number_format($gia[0]) . ' VNĐ</span>
                        </div>';

                    echo ' </a>
                            </li>
                        </ul>';
                } else {
                    echo '<div class="product-price">
                            <span class="special">' . number_format($row1['product_price']) . ' VNĐ</span>
                            <span class="price">' . number_format($row1['product_price']-($row1['product_price']*($row1['product_price_sale']/100))) . ' VNĐ</span>
                        </div>';
                    echo ' </a>
                            </li>
                        </ul>';
                }



            }
        }
    }
}
?>