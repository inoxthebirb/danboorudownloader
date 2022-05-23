<?php

$post_count_url = "https://danbooru.donmai.us/counts/posts.json?tags=" . $tag1;
if($tag2 != "") $post_count_url = $post_count_url . "+" . $tag2;

function getPostCount($post_count_url) {
	$curl = curl_init($post_count_url);
	curl_setopt($curl, CURLOPT_URL, $post_count_url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

	$headers = array(
	   "Accept: application/json",
	);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

	$resp = curl_exec($curl);
	curl_close($curl);

	//var_dump($resp);

	$decodedData = json_decode($resp, true);
	
	//var_dump($decodedData);
	
	return $decodedData["counts"]["posts"] . "<br>";
}

$post_count = getPostCount($post_count_url);
echo $post_count;

?>