<?php

$url = "https://testbooru.donmai.us/posts";
$tags = "absurdres";
$tags_opt1 = "baba";
$tags_opt2 = "bobo";
$id = "/120.json";

$url_master = "https://testbooru.donmai.us/posts.json?tags=absurdres+date%3A<%3D2022-05-12";

$page_url = $url . "?tags=" . $tags;
$post_url = $url . $id;

$curl = curl_init($url_master);
curl_setopt($curl, CURLOPT_URL, $url_master);
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

for ($i = 0; $i < 20; $i++) {
	echo $decodedData[$i]["large_file_url"] . "<br>";
	$file_url = $decodedData[$i]["large_file_url"];
	
	if (!(str_contains($decodedData[$i]["tag_string"], $tags_opt1) and
		str_contains($decodedData[$i]["tag_string"], $tags_opt2))) {
		continue;
	}
	
	$filename = "downloads\\" . basename($file_url);
	
	//file_put_contents($filename, file_get_contents($file_url));
}

//echo sizeof($decodedData);

?>

