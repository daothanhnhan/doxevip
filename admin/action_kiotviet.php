<?php 
include_once("library.php");

class action_kiotviet extends library{

	public function hello () {
		return 'hello world.';
	}

	public function set_token () {
		global $conn_vn;
		$now = date('Y-m-d H:i:s');//echo $now;
		$now = strtotime($now);//echo $now.'<br>';
		$sql = "SELECT * FROM kiotviet_token WHERE id = 1";
		$result = mysqli_query($conn_vn, $sql);
		$row = mysqli_fetch_assoc($result);
		$time = $row['time'];//echo $time.'<br>';
		$check = $time - $now;//echo $check;
		if ($check < 3600) {
			$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => "https://id.kiotviet.vn/connect/token",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "POST",
			  CURLOPT_POSTFIELDS => "scopes=PublicApi.Access&grant_type=client_credentials&client_id=71e187d9-8c95-4e93-b35f-57e713af84a1&client_secret=5FECC90FC967295B25BCCEDA4F828FD9EC5B64F4",
			  CURLOPT_HTTPHEADER => array(
			    "Accept: */*",
			    "Cache-Control: no-cache",
			    "Connection: keep-alive",
			    "Content-Type: application/x-www-form-urlencoded",
			    "Host: id.kiotviet.vn",
			    "Postman-Token: ebe44160-9e3e-47ce-b35d-75ef928eacd6,ec4904b4-62b9-46e0-92e1-e0a29cd82d5a",
			    "User-Agent: PostmanRuntime/7.15.0",
			    "accept-encoding: gzip, deflate",
			    "cache-control: no-cache",
			    "content-length: 155"
			  ),
			));

			$response = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);

			if ($err) {
			  echo "cURL Error #:" . $err;
			} else {
			  // echo $response->access_token;
			  $res = json_decode($response, true);
			  // var_dump($res['access_token']);
			  $token = $res['access_token'];
			  ///////////////
			  $next = $now + 86400;
			  $sql = "UPDATE kiotviet_token SET `time` = $next, token = '$token' WHERE id = 1";
			  $result = mysqli_query($conn_vn, $sql);
			}
			
		}
	}

	public function set_token_1 () {
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://id.kiotviet.vn/connect/token",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "scopes=PublicApi.Access&grant_type=client_credentials&client_id=71e187d9-8c95-4e93-b35f-57e713af84a1&client_secret=5FECC90FC967295B25BCCEDA4F828FD9EC5B64F4",
		  CURLOPT_HTTPHEADER => array(
		    "Accept: */*",
		    "Cache-Control: no-cache",
		    "Connection: keep-alive",
		    "Content-Type: application/x-www-form-urlencoded",
		    "Host: id.kiotviet.vn",
		    "Postman-Token: ebe44160-9e3e-47ce-b35d-75ef928eacd6,ec4904b4-62b9-46e0-92e1-e0a29cd82d5a",
		    "User-Agent: PostmanRuntime/7.15.0",
		    "accept-encoding: gzip, deflate",
		    "cache-control: no-cache",
		    "content-length: 155"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  // echo $response->access_token;
		  $res = json_decode($response, true);
		  // var_dump($res['access_token']);
		  $token = $res['access_token'];
		  return $token;
		}
	}

	public function get_token () {
		global $conn_vn;
		$sql = "SELECT * FROM kiotviet_token WHERE id = 1";
		$result = mysqli_query($conn_vn, $sql);
		$row = mysqli_fetch_assoc($result);
		$token = $row['token'];
		return $token;
	}

	public function get_count_procat () {
		$token = $this->get_token();

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://public.kiotapi.com/categories?pageSize=1",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
		    "Accept: */*",
		    "Authorization: Bearer $token",
		    "Cache-Control: no-cache",
		    "Connection: keep-alive",
		    "Host: public.kiotapi.com",
		    "Postman-Token: e43f8f79-9b6d-47c1-9a60-1723024a048d,3aa4b8ba-e044-4670-a480-a64acaa7a778",
		    "Retailer: dainghiacomputer",
		    "User-Agent: PostmanRuntime/7.15.0",
		    "accept-encoding: gzip, deflate",
		    "cache-control: no-cache",
		    "cookie: ss-pid=JJ6ZQ6BmAcPSgE8daU8a; ss-id=UWgnM2GJDRIyL6ED0npt"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  // echo $response;
		  $res = json_decode($response, true);
		  // var_dump($res['access_token']);
		  $total = $res['total'];
		  return $total;
		}
	}

	public function get_list_procat ($total, $page) {
		$token = $this->get_token();

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://public.kiotapi.com/categories?pageSize=$total&currentItem=$page&orderBy=categoryId&orderDirection=asc",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
		    "Accept: */*",
		    "Authorization: Bearer $token",
		    "Cache-Control: no-cache",
		    "Connection: keep-alive",
		    "Host: public.kiotapi.com",
		    "Postman-Token: e43f8f79-9b6d-47c1-9a60-1723024a048d,3aa4b8ba-e044-4670-a480-a64acaa7a778",
		    "Retailer: dainghiacomputer",
		    "User-Agent: PostmanRuntime/7.15.0",
		    "accept-encoding: gzip, deflate",
		    "cache-control: no-cache",
		    "cookie: ss-pid=JJ6ZQ6BmAcPSgE8daU8a; ss-id=UWgnM2GJDRIyL6ED0npt"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  // echo $response;
		  $res = json_decode($response, true);
		  // var_dump($res['access_token']);
		  $data = $res['data'];
		  return $data;
		}
	}

	public function danh_muc_cap_1 () {
		$limit = 50;
		$total = $this->get_count_procat();//echo $total;
		$count = ceil($total/$limit);
		$return = array();
		for ($i=0;$i<$count;$i++) {
			$page = $i*$limit;
			$list = $this->get_list_procat($limit, $page);
			foreach ($list as $item) {
				if ($item['parentId']==null) {
					// var_dump($item);
					$return[] = $item;
				}				
			}
		}
		return $return;
	}

	public function danh_muc_cap_2 ($procat_id) {
		$limit = 50;
		$total = $this->get_count_procat();//echo $total;
		$count = ceil($total/$limit);
		$return = array();
		for ($i=0;$i<$count;$i++) {
			$page = $i*$limit;
			$list = $this->get_list_procat($limit, $page);
			foreach ($list as $item) {
				if ($item['parentId']==$procat_id) {
					// var_dump($item);
					$return[] = $item;
				}				
			}
		}
		return $return;
	}

	public function danh_muc_cap_3 ($procat_id) {
		$limit = 50;
		$total = $this->get_count_procat();//echo $total;
		$count = ceil($total/$limit);
		$return = array();
		for ($i=0;$i<$count;$i++) {
			$page = $i*$limit;
			$list = $this->get_list_procat($limit, $page);
			foreach ($list as $item) {
				if ($item['parentId']==$procat_id) {
					// var_dump($item);
					$return[] = $item;
				}				
			}
		}
		return $return;
	}

	public function get_all_procat () {
		$limit = 50;
		$total = $this->get_count_procat();//echo $total;
		$count = ceil($total/$limit);
		$return = array();
		for ($i=0;$i<$count;$i++) {
			$page = $i*$limit;
			$list = $this->get_list_procat($limit, $page);
			foreach ($list as $item) {
				$return[] = $item;
			}
		}
		return $return;
	}

	public function get_procat_list ($arr, $parent_id) {
		$return = array();
		foreach ($arr as $item) {
			if ($item['parentId'] == $parent_id) {
				$return[] = $item;
			}
		}
		return $return;
	}

	public function get_detail_procat ($id) {
		$token = $this->get_token();
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://public.kiotapi.com/categories/$id",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
		    "Accept: */*",
		    "Accept-Encoding: gzip, deflate",
		    "Authorization: Bearer $token",
		    "Cache-Control: no-cache",
		    "Connection: keep-alive",
		    "Content-Type: application/json",
		    "Cookie: ss-pid=JJ6ZQ6BmAcPSgE8daU8a; ss-id=UWgnM2GJDRIyL6ED0npt",
		    "Host: public.kiotapi.com",
		    "Postman-Token: 28738c1f-bb58-45d9-83f8-b079e807266b,9db1edda-2ed8-41cd-a53e-7cbf08016ac6",
		    "Retailer: dainghiacomputer",
		    "User-Agent: PostmanRuntime/7.15.2",
		    "cache-control: no-cache"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  // echo $response;
			return json_decode($response, true);
		}
	}

	public function check_has_procat ($id_kv) {
		global $conn_vn;
		$sql = "SELECT * FROM productcat WHERE kiotviet_id = $id_kv";//echo $sql;
		$result = mysqli_query($conn_vn, $sql);
		$num = mysqli_num_rows($result);
		if ($num == 0) {
			return false;
		} else {
			$row = mysqli_fetch_assoc($result);
			return $row['productcat_id'];
		}
	}

	////////// phẩn sản phẩm ////////////

	public function all_product ($trang, $limit) {
		$page = ($trang - 1) * 20;
		$token = $this->get_token();

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://public.kiotapi.com/Products?currentItem=$page&pageSize=$limit&orderBy=id&orderDirection=desc",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
		    "Accept: */*",
		    "Accept-Encoding: gzip, deflate",
		    "Authorization: Bearer $token",
		    "Cache-Control: no-cache",
		    "Connection: keep-alive",
		    "Cookie: ss-pid=JJ6ZQ6BmAcPSgE8daU8a; ss-id=UWgnM2GJDRIyL6ED0npt",
		    "Host: public.kiotapi.com",
		    "Postman-Token: 57fa532d-b36d-4ba8-91a4-7365b880f4bc,99a76101-e6d5-4f60-b00e-af6ab41e0530",
		    "Retailer: dainghiacomputer",
		    "User-Agent: PostmanRuntime/7.15.2",
		    "cache-control: no-cache"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  // echo $response;
		  return json_decode($response, true);
		}
	}

	public function paging ($total_record, $trang, $limit, $page) {
		$slug = '';
		$config = array(

	        'current_page'=> $trang != "" ? $trang : 1,

	        'total_record'=> $total_record,

	        'limit' => $limit,

	        'link_full'=> $slug != '' ? $slug.'/{trang}' : 'index.php?page='.$page.'&trang={trang}',

	        'link_first'=> $slug != '' ? $slug : 'index.php?page='.$page,

	        'range'=> 5

	    );

	    $paging = new Pagination();

	    $paging->init($config);

	    $p = $paging->htmlPaging();

	    return $p;
	}

	public function check_has_product ($id_kv) {
		global $conn_vn;
		$sql = "SELECT * FROM product WHERE kiotviet_id = $id_kv";
		$result = mysqli_query($conn_vn, $sql);
		$num = mysqli_num_rows($result);
		if ($num == 0) {
			return false;
		} else {
			$row = mysqli_fetch_assoc($result);
			return $row['product_id'];
		}
	}

	public function get_product ($id_kv) {
		$token = $this->get_token();
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://public.kiotapi.com/products/$id_kv",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
		    "Accept: */*",
		    "Accept-Encoding: gzip, deflate",
		    "Authorization: Bearer $token",
		    "Cache-Control: no-cache",
		    "Connection: keep-alive",
		    "Cookie: ss-pid=JJ6ZQ6BmAcPSgE8daU8a; ss-id=UWgnM2GJDRIyL6ED0npt",
		    "Host: public.kiotapi.com",
		    "Postman-Token: 1e82bc8e-2895-4d12-ba08-be6a4c0c0421,52aa13f7-0221-425e-bf7f-4b3054cccb52",
		    "Retailer: dainghiacomputer",
		    "User-Agent: PostmanRuntime/7.15.2",
		    "cache-control: no-cache"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  // echo $response;
		  return json_decode($response, true);
		}
	}

	public function get_count_product_all () {
		$token = $this->get_token();

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://public.kiotapi.com/Products?currentItem=1&pageSize=1&orderBy=id&orderDirection=desc",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
		    "Accept: */*",
		    "Accept-Encoding: gzip, deflate",
		    "Authorization: Bearer $token",
		    "Cache-Control: no-cache",
		    "Connection: keep-alive",
		    "Cookie: ss-pid=JJ6ZQ6BmAcPSgE8daU8a; ss-id=UWgnM2GJDRIyL6ED0npt",
		    "Host: public.kiotapi.com",
		    "Postman-Token: f0c0cc5e-87af-440d-8fc3-d79f2c1992ea,8044c062-fece-4756-87b6-7eadbe6f258b",
		    "Retailer: dainghiacomputer",
		    "User-Agent: PostmanRuntime/7.15.2",
		    "cache-control: no-cache"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  // echo $response;
			$res = json_decode($response, true);
			return $res['total'];
		}
	}

	public function get_product_limit ($limit, $trang) {
		// $trang = ($trang - 1) * $limit;
		$token = $this->get_token();

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://public.kiotapi.com/Products?currentItem=$trang&pageSize=$limit&orderBy=id&orderDirection=desc",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
		    "Accept: */*",
		    "Accept-Encoding: gzip, deflate",
		    "Authorization: Bearer $token",
		    "Cache-Control: no-cache",
		    "Connection: keep-alive",
		    "Cookie: ss-pid=JJ6ZQ6BmAcPSgE8daU8a; ss-id=UWgnM2GJDRIyL6ED0npt",
		    "Host: public.kiotapi.com",
		    "Postman-Token: f0c0cc5e-87af-440d-8fc3-d79f2c1992ea,8044c062-fece-4756-87b6-7eadbe6f258b",
		    "Retailer: dainghiacomputer",
		    "User-Agent: PostmanRuntime/7.15.2",
		    "cache-control: no-cache"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  // echo $response;
			$res = json_decode($response, true);//var_dump($res);
			$data = $res['data'];
			return $data;
		}
	}

	public function get_product_all_test () {
		$token = $this->get_token();
		$total = $this->get_count_product_all();//echo $total;
		$limit = 100;
		$count = ceil($total/$limit);//echo $count;
		$return = array();
		for ($i=0;$i<$count;$i++) {
			$trang = $i*$limit;
			$list = $this->get_product_limit($limit, $trang);
			foreach ($list as $item) {
				// $check = $this->check_has_product($item['id']);
				// if ($check != false) {
					$return[] = $item;
				// }
			}
		}
		return $return;
	}

	public function get_product_gb_kv ($id) {
		global $conn_vn;
		$sql = "SELECT * FROM product WHERE product_id = $id";
		$result = mysqli_query($conn_vn, $sql);
		$row = mysqli_fetch_assoc($result);
		$product_id_kv = $row['kiotviet_id'];
		$return = $this->get_product($product_id_kv);
		return $return;
	}

	public function get_product_all_db () {
		global $conn_vn;
		$sql = "SELECT * FROM product_kiotviet WHERE id = 1";
		$result = mysqli_query($conn_vn, $sql);
		$row = mysqli_fetch_assoc($result);
		$list = json_decode($row['data'], true);//var_dump($list);
		$return = array();
		foreach ($list as $item) {
			$check = $this->check_has_product_1($item['id']);
			if ($check != false) {
				$return[] = $item;
			}
		}
		return $return;
	}

	public function check_has_product_1 ($id_kv) {
		global $conn_vn;
		$sql = "SELECT * FROM product WHERE kiotviet_id = $id_kv";
		$result = mysqli_query($conn_vn, $sql);
		$num = mysqli_num_rows($result);
		if ($num == 0) {
			return false;
		} else {
			$row = mysqli_fetch_assoc($result);
			if ($row['state'] == 1) {
				return $row['product_id'];
			} else {
				return false;
			}			
		}
	}

	public function set_product_all_db_state () {
		global $conn_vn;
		$products = $this->get_product_all_db();
		$products = json_encode($products);

		$sql = "UPDATE product_kiotviet SET data = ? WHERE id = 2";
        $stmt = $conn_vn->prepare($sql);
        $stmt->bind_param("s", $products);
        $stmt->execute(); 
	}

	public function get_product_all_db_state () {
		global $conn_vn;
		$sql = "SELECT * FROM product_kiotviet WHERE id = 2";
		$result = mysqli_query($conn_vn, $sql);
		$row = mysqli_fetch_assoc($result);
		$list = json_decode($row['data'], true);
		return $list;
	}
}
?>