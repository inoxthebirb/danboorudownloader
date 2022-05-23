<?php

$url = "https://testbooru.donmai.us/posts/6.json";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Accept: application/json",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$resp = curl_exec($curl);
curl_close($curl);

//var_dump($resp);

$decodedData = json_decode($resp, true);
var_dump($decodedData);

$file_url = $decodedData["large_file_url"];

$filename = basename($file_url);

//file_put_contents($filename, file_get_contents($file_url));

?>

