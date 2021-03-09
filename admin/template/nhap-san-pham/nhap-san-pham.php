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

  function vi_en1($str)
    {
        if (!$str)
            return '';
        $coDau = array("à", "á", "ạ", "ả", "ã", "â", "ầ", "ấ", "ậ", "ẩ", "ẫ", "ă", "ằ",
            "ắ", "ặ", "ẳ", "ẵ", "è", "é", "ẹ", "ẻ", "ẽ", "ê", "ề", "ế", "ệ", "ể", "ễ", "ì",
            "í", "ị", "ỉ", "ĩ", "ò", "ó", "ọ", "ỏ", "õ", "ô", "ồ", "ố", "ộ", "ổ", "ỗ", "ơ",
            "ờ", "ớ", "ợ", "ở", "ỡ", "ù", "ú", "ụ", "ủ", "ũ", "ư", "ừ", "ứ", "ự", "ử", "ữ",
            "ỳ", "ý", "ỵ", "ỷ", "ỹ", "đ", "À", "Á", "Ạ", "Ả", "Ã", "Â", "Ầ", "Ấ", "Ậ", "Ẩ",
            "Ẫ", "Ă", "Ằ", "Ắ", "Ặ", "Ẳ", "Ẵ", "È", "É", "Ẹ", "Ẻ", "Ẽ", "Ê", "Ề", "Ế", "Ệ",
            "Ể", "Ễ", "Ì", "Í", "Ị", "Ỉ", "Ĩ", "Ò", "Ó", "Ọ", "Ỏ", "Õ", "Ô", "Ồ", "Ố", "Ộ",
            "Ổ", "Ỗ", "Ơ", "Ờ", "Ớ", "Ợ", "Ở", "Ỡ", "Ù", "Ú", "Ụ", "Ủ", "Ũ", "Ư", "Ừ", "Ứ",
            "Ự", "Ử", "Ữ", "Ỳ", "Ý", "Ỵ", "Ỷ", "Ỹ", "Đ", "ê", "ù", "à");
        $khongDau = array("a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a",
            "a", "a", "a", "a", "a", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e",
            "i", "i", "i", "i", "i", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o",
            "o", "o", "o", "o", "o", "o", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u",
            "u", "y", "y", "y", "y", "y", "d", "A", "A", "A", "A", "A", "A", "A", "A", "A",
            "A", "A", "A", "A", "A", "A", "A", "A", "E", "E", "E", "E", "E", "E", "E", "E",
            "E", "E", "E", "I", "I", "I", "I", "I", "O", "O", "O", "O", "O", "O", "O", "O",
            "O", "O", "O", "O", "O", "O", "O", "O", "O", "U", "U", "U", "U", "U", "U", "U",
            "U", "U", "U", "U", "Y", "Y", "Y", "Y", "Y", "D", "e", "u", "a");
        $str = str_replace($coDau, $khongDau, $str);
        $str = str_replace(' ', '-', $str);
        $str = preg_replace('/[^a-zA-Z0-9--]/', '', $str);
        //$str = preg_replace('/(---|--)/', '-', $str);
            $str = strtolower($str);
            $str = str_replace(' ', '-', $str);
            while (strpos($str, '--') !== false) {
                $str = str_replace('--', '-', $str);
            }
        return $str;
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
              $gia1[] = $item2*60.75;
            }
          }
        }
        $gia1_sql = json_encode($gia1);
        // var_dump($gia1);

        preg_match_all('~<span>\K.*(?=</span>)~Uis', $matches5[0][0], $ten1);//var_dump($ten1);
        $ten = array();
        foreach ($ten1[0] as $item) {
            $ten[] = mb_convert_encoding($item, "UTF-8", "GBK");
        }
        // var_dump($ten);
        $ten_sql = json_encode($ten);

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
          $ten_sql = mysqli_real_escape_string($conn_vn, $ten_sql);
          set_url('san-pham', 1);
          $sql_1 = "INSERT INTO product (product_name, product_name_1, product_sub_info3, product_sub_info4, product_sub_info5, product_des2, product_sub_info1, product_sub_info2, friendly_url, state, product_des3, product_des) VALUES ('$text', '$text', '$des1', '$html1', '$video', '$anh_arr_sql', '$anh_arr1_sql', '$gia1_sql', '$url2', 1, '$ten_sql', '$link')";
          // echo $sql_1;
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

        
    } elseif (strpos($link, 'taobao.com')) { 
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

        preg_match_all('/<h3 class="tb-main-title" data-title="[^"]*">(.*)<\/h3>/Uis', $html, $matches2);//var_dump($matches2);

        $text = $matches2[1][0];
        if (empty($text)) {
          echo '<h1 style="color:red;">Không lấy được dữ liệu.</h1>';
          return '';
        }
        $text = mb_convert_encoding($text, "UTF-8", "GBK");//echo $text;

        preg_match_all('~<ul id="J_UlThumb" class="tb-thumb tb-clearfix">\K.*(?=</ul>)~Uis', $html, $matches);
        $ul = $matches[0][0];//var_dump($ul);

        preg_match_all('/< *img[^>]*src *= *["\']?([^"\']*)/i', $ul, $ul1);//var_dump($ul1);
        $d = 0;
        $anh_arr = array();
        foreach ($ul1[1] as $element) {
            $anh = str_replace('50x50', '430x430', $element);
            $anh_arr[] = $anh;
            // foreach ($img as $e1) {
                $d++;
            // }
        }
        $anh_arr_sql = json_encode($anh_arr);

        preg_match_all('~<dl class="J_Prop tb-prop tb-clear  J_Prop_Color ">\K.*(?=</dl>)~Uis', $html, $matches5);
        // $ul = $matches[0][0];var_dump($ul);

        preg_match_all('/data-value="([^"]*)"/ism', $matches5[0][0], $so);
        // var_dump($so);

        // preg_match_all('/style="([^"]*)"/ism', $matches5[0][0], $anh1);//
        $anh1 = array();
        $anh4 = explode("<li", $matches5[0][0]);
        unset($anh4[0]);
        foreach ($anh4 as $item) {
          if (strpos($item,'class="tb-txt"')) {
            $anh1[] = 'no-image.jpg';
          } else {
            preg_match_all('/style="([^"]*)"/ism', $item, $anh11);
            $anh1[] = $anh11[1][0];
          }
        }
        // var_dump($anh1);
        $anh_arr1 = array();
        foreach ($anh1 as $item) {
          $anh3 = str_replace('30x30', '430x430', $item);
          $anh3 = str_replace('background:url(', '', $anh3);
          $anh3 = str_replace(') center no-repeat;', '', $anh3);
          $anh_arr1[] = $anh3;
        }
        $anh_arr1_sql = json_encode($anh_arr1);

        preg_match_all('/skuMap(.*):false}}/i', $html, $matches6);//var_dump($matches6[1][0]);
        $gia = explode('skuId":', $matches6[1][0]);//var_dump($gia);

        $gia1 = array();
        foreach ($so[1] as $item) {
          foreach ($gia as $item1) {
            if (strpos($item1, $item)) {
              preg_match_all('/price(.*)stock/i', $item1, $matches8);
              $item2 = $matches8[1][0];
              $item2 = str_replace('":"', "", $item2);
              $item2 = str_replace('","', "", $item2);
              $item2 = str_replace('.', "", $item2);
              $gia1[] = $item2*60.75;
            }
          }
        }
        $gia1_sql = json_encode($gia1);
        // var_dump($gia1);
        $ten = array();
        foreach ($anh4 as $item) {
          preg_match_all('~<span>\K.*(?=</span>)~Uis', $item, $ten1);
          // var_dump($item);
          // var_dump($ten1);
            $ten[] = mb_convert_encoding($ten1[0][0], "UTF-8", "GBK");
        }
        // var_dump($ten);
        $ten_sql = json_encode($ten);


        preg_match_all('~<div id="attributes" class="attributes">\K.*(?=</ul>)~Uis', $html, $matches9);//var_dump($matches9);
        $des1 = mb_convert_encoding($matches9[0][0], "UTF-8", "GBK");//var_dump($des1);
        $des1 = $des1.'</ul>';



        preg_match_all('/\'video\'(.*)"0"}\);/iUs', $html, $matches3);//var_dump($matches3);
        // var_dump($matches3[1]);//echo '<br>';
        // var_dump($matches3[1][0]);//echo '<br>';
        if (empty($matches3[0])) {
          $video = 'mp4';
        } else {
          $video_a = $matches3[1][0];
          preg_match_all('/videoId(.*)autoplay/', $video_a, $video1);
          preg_match_all('/videoOwnerId(.*)videoStatus/', $video_a, $video2);
          $video1 = str_replace('":"', "", $video1[1][0]);
          $video1 = str_replace('","', "", $video1);
          $video2 = str_replace('":"', "", $video2[1][0]);
          $video2 = str_replace('","', "", $video2);
          // $video = str_replace('":"', "", $video);
          // $video = str_replace('p/1/e/1/t/8', "p/1/e/6/t/1", $video);
          // $video = $video."mp4";
          $video = 'https://cloud.video.taobao.com/play/u/'.$video2.'/p/2/e/6/t/1/'.$video1.'.mp4';
        }
        

        preg_match_all('/descUrl(.*)descnew/Uis', $html, $matches4);//var_dump($matches4);
        preg_match_all('/\/\/dscnew.taobao.com(.*):/', $matches4[1][0], $matches4_1);//var_dump($matches4_1);
        $des = str_replace('//', "", $matches4_1[0][0]);
        $des = str_replace('\' :', "", $des);
        // var_dump($des);

        $url1 = $des;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:53.0) Gecko/20100101 Firefox/53.0");
        $html1 = curl_exec($ch);
        curl_close($ch);
        // var_dump($html1);
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
          $ten_sql = mysqli_real_escape_string($conn_vn, $ten_sql);
          set_url('san-pham', 1);
          $sql_1 = "INSERT INTO product (product_name, product_name_1, product_sub_info3, product_sub_info4, product_sub_info5, product_des2, product_sub_info1, product_sub_info2, friendly_url, state, product_des3, product_des) VALUES ('$text', '$text', '$des1', '$html1', '$video', '$anh_arr_sql', '$anh_arr1_sql', '$gia1_sql', '$url2', 1, '$ten_sql', '$link')";
          // echo $sql_1;
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

    } elseif (strpos($link, 'aliexpress.com')) {
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

      preg_match_all('/<title>(.*)<\/title>/Uis', $html, $matches2);
      $text = str_replace('', '', $matches2[1][0]);
      $text = explode("|", $text);
      $text = $text[0];
      if (empty($text)) {
          echo '<h1 style="color:red;">Không lấy được dữ liệu.</h1>';
          return '';
        }
      $text1 = vi_en1($text);

      preg_match_all('/imagePathList(.*)ImageModule/Uis', $html, $matches);
        $ul = $matches[1][0];//var_dump($matches);
        $ul = str_replace('":', "", $ul);
        $ul = str_replace(',"name"', "", $ul);
        // var_dump($ul);
        $ul = json_decode($ul);//var_dump($ul);
        $anh_arr = $ul;
        $anh_arr_sql = json_encode($anh_arr);

      preg_match_all('/skuPriceList(.*)warrantyDetailJson/Uis', $html, $matches_1);
      $ul1 = $matches_1[1][0];
      $ul1 = substr($ul1, 2);
      $ul1 = substr($ul1, 0, -2);
      // var_dump($ul1);
      $gia_tinh_nang_1 = $ul1;
      $ul1 = json_decode($ul1, true);//var_dump($ul1);
      $gia_tinh_nang_2 = array();
      foreach ($ul1 as $item) {
        $gia_tinh_nang_2[] = array(
          'skuPropIds' => $item['skuPropIds'],
          'skuVal' => array(
            'skuMultiCurrencyDisplayPrice' => $item['skuVal']['skuMultiCurrencyDisplayPrice']*1.65*23350,
            'actSkuMultiCurrencyDisplayPrice' => $item['skuVal']['actSkuMultiCurrencyDisplayPrice']*1.65*23350
          )
        );
      }
      $gia_tinh_nang_2 = json_encode($gia_tinh_nang_2);

      preg_match_all('/productSKUPropertyList(.*)skuPriceList/Uis', $html, $matches_2);
      $ul2 = $matches_2[1][0];
      $ul2 = substr($ul2, 2);
      $ul2 = substr($ul2, 0, -2);
      // var_dump($ul2);
      $anh_arr1 = array();
      $tinh_nang_1 = $ul2;
      $tinh_nang_2 = $ul2;
      $ul2 = json_decode($ul2, true);//var_dump($ul2);

      $gia1 = array();
      $gia2 = array();
      $ten = array();
      foreach ($ul2[0]['skuPropertyValues'] as $item) {
        $anh_arr1[] = $item['skuPropertyImagePath'];
        foreach ($ul1 as $item_1) {
          // $name = $item_1['skuAttr'];
          // $name = explode("#", $name);
          // $name = $name[1];
          // $name = explode(";", $name);
          // $name = $name[0];
          $prop_id = $item_1['skuPropIds'];
          if ($item['propertyValueId'] == $prop_id) {
            $gia2[] = $item_1['skuVal']['actSkuCalPrice']*1.65*23350;
            $gia1[] = $item_1['skuVal']['skuMultiCurrencyDisplayPrice']*1.65*23350;
            $ten[] = $item['propertyValueDisplayName'];
          }
        }
      }

      $anh_arr1_sql = json_encode($anh_arr1);
      $gia1_sql = json_encode($gia1);
      $gia2_sql = json_encode($gia2);
      $ten_sql = json_encode($ten);

      preg_match_all('/SpecsModule(.*)storeModule/Uis', $html, $matches9);//var_dump($matches9);
      $des1 = explode('props', $matches9[1][0]);//var_dump($des1);
      $des1 = substr($des1[1], 2);
      $des1 = substr($des1, 0, -3);
      // var_dump($des1);
      $des1 = json_decode($des1, true);//var_dump($des1);
      $des1_1 = '<ul>';
      foreach ($des1 as $item) {
        $des1_1 .= '<li>'.$item['attrName'].':'.$item['attrValue'].'</li>';
      }

      $des1_1 .= '</ul>';
      $des1 = $des1_1;

      preg_match_all('/videoId(.*)videoUid/Uis', $html, $matches10);//var_dump($matches10);
      if (empty($matches10[0])) {
        $video = 'mp4';
      } else {
        preg_match_all('/videoUid(.*)installmentModule/Uis', $html, $matches12);//var_dump($matches12);
        $videou = $matches12[1][0];
        $videou = str_replace('":"', '', $videou);
        $videou = str_replace('"},"', '', $videou);
        $videou = '/'.$videou.'/';
        $video = $matches10[1][0];//var_dump($video);
        $video = str_replace('":', '', $video);
        $video = str_replace(',"', '', $video);
        $video = 'https://cloud.video.taobao.com/play/u/2201940393455/p/1/e/6/t/10301/'.$video.'.mp4';
        $video = str_replace('/2201940393455/', $videou, $video);
      }

      preg_match_all('/descriptionUrl(.*)features/Uis', $html, $matches4);//var_dump($matches4);
        $des = str_replace('":"', "", $matches4[1][0]);
        $des = str_replace('","', "", $des);
        // var_dump($des);

        $url1 = $des;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:53.0) Gecko/20100101 Firefox/53.0");
        $html1 = curl_exec($ch);
        curl_close($ch);

        preg_match_all('/detail-video(.*)data-previewurl/Uis', $html1, $matches11);//var_dump($matches11);
        $video1 = '';
        if (!empty($matches11[0])) {
          $video1 = $matches11[1][0];
          $video1 = str_replace('" id="', '', $video1);
          $video1 = str_replace('" ', '', $video1);//var_dump($video1);
          $video1 = '<video src="https://cloud.video.taobao.com/play/u/2201940393455/p/1/e/6/t/10301/'.$video1.'.mp4" autobuffer autoloop loop controls poster="/images/video.png"></video>';
        }

        $html1 = $video1.$html1;


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
          $gia2_sql = mysqli_real_escape_string($conn_vn, $gia2_sql);
          $ten_sql = mysqli_real_escape_string($conn_vn, $ten_sql);
          $tinh_nang_1 = mysqli_real_escape_string($conn_vn, $tinh_nang_1);
          $gia_tinh_nang_1 = mysqli_real_escape_string($conn_vn, $gia_tinh_nang_1);
          set_url('san-pham', 1);
          $sql_1 = "INSERT INTO product (product_name, product_name_1, product_sub_info3, product_sub_info4, product_sub_info5, product_des2, product_sub_info1, product_sub_info2, friendly_url, state, product_des3, product_content2, product_des, tinh_nang_1, gia_tinh_nang_1, title_seo, tinh_nang_2, gia_tinh_nang_2) VALUES ('$text', '$text', '$des1', '$html1', '$video', '$anh_arr_sql', '$anh_arr1_sql', '$gia1_sql', '$text1', 1, '$ten_sql', '$gia2_sql', '$link', '$tinh_nang_1', '$gia_tinh_nang_1', '$text', '$tinh_nang_2', '$gia_tinh_nang_2')";
          // echo $sql_1;
          mysqli_query($conn_vn, $sql_1);
          // echo mysqli_error($conn_vn);
          $product_id = mysqli_insert_id($conn_vn);

          /////////////////////
          $sql_vn = "INSERT INTO product_languages (lang_product_name, friendly_url, languages_code, product_id, title_seo) VALUES ('$text', '$text1', 'vn', $product_id, '$text')";//echo $sql_vn.'<br>';
          mysqli_query($conn_vn, $sql_vn);
          $sql_en = "INSERT INTO product_languages (lang_product_name, friendly_url, languages_code, product_id, title_seo) VALUES ('$text', '$text1', 'en', $product_id, '$text')";//echo $sql_en.'<br>';
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



