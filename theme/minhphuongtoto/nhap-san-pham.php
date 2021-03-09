<?php 
  $url2 = '';
  function set_url ($url, $d) {
    global $conn_vn;
    global $url2;
    $url_1 = $url.'-'.$d;
    $sql = "SELECT * FROM product WHERE friendly_url = '$url_1'";//echo $sql;
    $result = mysqli_query($conn_vn, $sql);
    $num = mysqli_num_rows($result);
    //echo $url_1;
    if (empty($num)) {
      // $d++;
      // echo $url_1;
      // return $url_1;
      $url2 = $url_1;
    } else {
      $d++;
      set_url($url, $d);
    }
  }
// $duong_dan = set_url('san-pham', 1);
// echo $url2;
  
  function them_san_pham () {
    global $conn_vn;
    global $url2;
    $link = $_POST['link'];
    if (strpos($link, 'tmall.com')) {
      echo $link;echo '<br>';
      $url = $link;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:53.0) Gecko/20100101 Firefox/53.0");
        $html = curl_exec($ch);
        curl_close($ch);
        // var_dump($html);
        preg_match_all('/<h1 data-spm="\d*">(.*)<\/h1>/Uis', $html, $matches2);//var_dump($matches2);

        $text = str_replace('', '', $matches2[1][0]);
        if (empty($text)) {
          echo '<h1 style="color:red;">Không lấy được dữ liệu.</h1>';
          return '';
        }
        $text = mb_convert_encoding($text, "UTF-8", "GBK");//echo $text;


        preg_match_all('~<div class="attributes-list" id="J_AttrList">\K.*(?=</ul>)~Uis', $html, $matches9);//var_dump($matches9);
        $des1 = mb_convert_encoding($matches9[0][0], "UTF-8", "GBK");
        $des1 = $des1.'</ul>';


        preg_match_all('/imgVedioUrl(.*)swf/iUs', $html, $matches3);

        $video = $matches3[1][0];
        $video = str_replace('":"', "", $video);
        $video = str_replace('p/1/e/1/t/8', "p/1/e/6/t/1", $video);
        $video = $video."mp4";

        preg_match_all('/descUrl(.*)httpsDescUrl/Uis', $html, $matches4);//var_dump($matches4);
        $des = str_replace('":"//', "", $matches4[1][0]);
        $des = str_replace('","', "", $des);
        // var_dump($des);

        preg_match_all('~<ul id="J_UlThumb" class="tb-thumb tm-clear">\K.*(?=</ul>)~Uis', $html, $matches);
        $ul = $matches[0][0];//var_dump($ul);

        preg_match_all('/< *img[^>]*src *= *["\']?([^"\']*)/i', $ul, $ul1);//var_dump($ul1);
        $d = 0;
        $anh_arr = array();
        foreach ($ul1[1] as $element) {
            $anh = str_replace('60x60', '430x430', $element);
            $anh_arr[] = $anh;
        }
        $anh_arr_sql = json_encode($anh_arr);

        preg_match_all('~<dl class="tb-prop tm-sale-prop tm-clear tm-img-prop ">\K.*(?=</dl>)~Uis', $html, $matches5);
        // $ul = $matches[0][0];var_dump($ul);

        preg_match_all('/data-value="([^"]*)"/ism', $matches5[0][0], $so);
        // var_dump($so);

        preg_match_all('/style="([^"]*)"/ism', $matches5[0][0], $anh1);
        // var_dump($anh1);
        $anh_arr1 = array();
        foreach ($anh1[1] as $item) {
          $anh3 = str_replace('40x40', '430x430', $item);
          $anh3 = str_replace('background:url(', '', $anh3);
          $anh3 = str_replace(') center no-repeat;', '', $anh3);
          $anh_arr1[] = $anh3;
        }
        $anh_arr1_sql = json_encode($anh_arr1);

        preg_match_all('/skuMap(.*)salesProp/i', $html, $matches6);//var_dump($matches6[1][0]);
        $gia = explode('skuId":', $matches6[1][0]);//var_dump($gia);

        $gia1 = array();
        foreach ($so[1] as $item) {
          foreach ($gia as $item1) {
            if (strpos($item1, $item)) {
              preg_match_all('/priceCent(.*)price/i', $item1, $matches8);
              $item2 = $matches8[1][0];
              $item2 = str_replace('":', "", $item2);
              $item2 = str_replace(',"', "", $item2);
              $gia1[] = $item2;
            }
          }
        }
        $gia1_sql = json_encode($gia1);
        // var_dump($gia1);

        //end
        $url1 = $des;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:53.0) Gecko/20100101 Firefox/53.0");
        $html1 = curl_exec($ch);
        curl_close($ch);
        $html1 = str_replace("var desc='", "", $html1);
        $html1 = mb_convert_encoding($html1, "UTF-8", "GBK");


        $sql = "SELECT * FROM product WHERE product_name_1 = '$text'";
        $result = mysqli_query($conn_vn, $sql);
        $num = mysqli_num_rows($result);

        if (empty($num)) {
          $text = mysqli_real_escape_string($conn_vn, $text);
          $des1 = mysqli_real_escape_string($conn_vn, $des1);
          $html1 = mysqli_real_escape_string($conn_vn, $html1);
          $video = mysqli_real_escape_string($conn_vn, $video);
          $anh_arr_sql = mysqli_real_escape_string($conn_vn, $anh_arr_sql);
          $anh_arr1_sql = mysqli_real_escape_string($conn_vn, $anh_arr1_sql);
          $gia1_sql = mysqli_real_escape_string($conn_vn, $gia1_sql);
          set_url('san-pham', 1);
          $sql_1 = "INSERT INTO product (product_name, product_name_1, product_sub_info3, product_sub_info4, product_sub_info5, product_des2, product_sub_info1, product_sub_info2, friendly_url, state) VALUES ('$text', '$text', '$des1', '$html1', '$video', '$anh_arr_sql', '$anh_arr1_sql', '$gia1_sql', '$url2', 1)";
          mysqli_query($conn_vn, $sql_1);
          // echo mysqli_error($conn_vn);
          $product_id = mysqli_insert_id($conn_vn);

          /////////////////////
          $sql_vn = "INSERT INTO product_languages (lang_product_name, friendly_url, languages_code, product_id) VALUES ('$text', '$url2', 'vn', $product_id)";//echo $sql_vn.'<br>';
          mysqli_query($conn_vn, $sql_vn);
          $sql_en = "INSERT INTO product_languages (lang_product_name, friendly_url, languages_code, product_id) VALUES ('$text', '$url2', 'en', $product_id)";//echo $sql_en.'<br>';
          mysqli_query($conn_vn, $sql_en);
        } else {
          echo '<h1 style="color:red;">sản phẩm đã nhập.</h1>';
        }

        
    } else {
      echo '<h1 style="color:red;">link không đúng.</h1>';
    }
  }
  them_san_pham();
?>


<div class="container">
  <h2>Nhập link sản phẩm</h2>
  <form action="" method="post">
    <div class="form-group">
      <label for="link">link:</label>
      <input type="text" class="form-control" id="link" placeholder="Enter link" name="link">
    </div>
    
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>



