<?php 
    include_once dirname(__FILE__) . "/../database.php";
    include_once dirname(__FILE__) . "/../library.php";
    include_once dirname(__FILE__) . "/../action.php";

    $action = new action();

    $pro = $_GET['pro'];
    $anh = $_GET['anh'];

    $product = $action->getDetail('product', 'product_id', $pro);
    $anh_chinh = json_decode($product['product_sub_img']);
    // if (!empty($product['ten_anh_doi'])) {
    //   $anh_chinh = array();
    //   $ten_anh_doi = json_decode($product['ten_anh_doi']);
    //   foreach ($ten_anh_doi as $item) {
    //     $anh_chinh[] = 'http://'.$_SERVER['SERVER_NAME'].'/download/images/'.$item;
    //   }
    // }
?>
<div class="slider slider-for">
        <div class="slide-item">

            <img src="/images/tinh-nang/<?= $anh ?>" alt="" class="img-responsive img1" data-zoom-image="https://ae01.alicdn.com/kf/H88081f80aeab4d5c8f69dcb2fc0cfef4g/H-p-Kim-K-m-Ch-a-Kh-a-XE-T-Da-p-L-ng-D.jpg">

        </div>

        <div class="slide-item">

            <img src="/images/product/<?=  $product['product_img'] ?>" alt="" class="img-responsive img1" data-zoom-image="https://ae01.alicdn.com/kf/H88081f80aeab4d5c8f69dcb2fc0cfef4g/H-p-Kim-K-m-Ch-a-Kh-a-XE-T-Da-p-L-ng-D.jpg">

        </div>
        <?php 

            $d = 0;

            foreach ($anh_chinh as $item) {

                $d++;
                
                $image = json_decode($item, true);
                // if (strpos($item,"http")===false) {
                //   $item = 'http:'.$item;
                // } else {
                  
                // }

        ?>
        <div class="slide-item">
            
            <img src="/images/product/<?= $image['image'] ?>" alt="" class="img-responsive img1" data-zoom-image="<?= $image['image'] ?>">
            
        </div>
        <?php } ?>
</div>

<div class="slider slider-nav">
        <div class="slide-item">

            <img src="/images/tinh-nang/<?= $anh ?>" alt="" class="img-responsive img1" data-zoom-image="https://ae01.alicdn.com/kf/H88081f80aeab4d5c8f69dcb2fc0cfef4g/H-p-Kim-K-m-Ch-a-Kh-a-XE-T-Da-p-L-ng-D.jpg">

        </div>

        <div class="slide-item">

            <img src="/images/product/<?=  $product['product_img'] ?>" alt="" class="img-responsive img1" data-zoom-image="https://ae01.alicdn.com/kf/H88081f80aeab4d5c8f69dcb2fc0cfef4g/H-p-Kim-K-m-Ch-a-Kh-a-XE-T-Da-p-L-ng-D.jpg">

        </div>
        
        <?php 

            $d = 0;

            foreach ($anh_chinh as $item) {

                $d++;
                $image = json_decode($item, true);

        ?>
        <div class="slide-item">
            
            <img src="/images/product/<?= $image['image'] ?>" alt="" class="img-responsive img1" data-zoom-image="https://ae01.alicdn.com/kf/H88081f80aeab4d5c8f69dcb2fc0cfef4g/H-p-Kim-K-m-Ch-a-Kh-a-XE-T-Da-p-L-ng-D.jpg">

        </div>
        <?php } ?>
</div>