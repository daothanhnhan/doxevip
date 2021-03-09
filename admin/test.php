<?php

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
  var_dump($res['access_token']);
}