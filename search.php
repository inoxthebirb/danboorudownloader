<?php

error_reporting(0);

require_once 'setpage.php';

$tag1 = $_GET["tag1"];
$tag2 = $_GET["tag2"];
$page = $_GET["page"];

require 'post_count.php';

echo "THIS IS PAGE $page FOR THE TAG(s) $tag1";

if($tag2 != "") echo " AND $tag2";

echo "!<br>";
echo "CLICK NEXT TO SEE THE NEXT PAGE!<br>";


/////////////////////////////////////////////////
$url = "https://danbooru.donmai.us/posts.json";

$page_url = $url . "?tags=" . $tag1;
if($tag2 != "") $page_url = $page_url . "+" . $tag2;
$page_url = $page_url . "&limit=100&page=" . $page;

echo $page_url . "<br><br>";

$curl = curl_init($page_url);
curl_setopt($curl, CURLOPT_URL, $page_url);
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
$rendered = 0;

echo "<form action='download.php' method='POST' target='_blank'>";

for ($i = 0; $i < 100; $i++) {
	
	if(isset($decodedData[$i])) {
		
		if(isset($decodedData[$i]["preview_file_url"])) {
			//echo $decodedData[$i]["preview_file_url"] . "<br>";
			
			$preview_url = $decodedData[$i]['preview_file_url'];
			$medium_url = $decodedData[$i]['large_file_url'];
			$large_url = $decodedData[$i]['file_url'];
			
			echo "
		
		<div style='width:10%; height:175px; float:left;'>
			<div height='150px'><a href='$medium_url'><img height='95%' src='$preview_url' title='$i'></a></div><br>
			<input type='checkbox' style='margin: 0 auto' value='$large_url' name='img$i'>
		</div>
		
		";
		$rendered = $rendered + 1;
		
			if($rendered == 10) {
				echo "<br><div style='float:clear; margin-bottom:300px;'></div><br>";
				$rendered = 0;
			}
		}
		if(isset($decodedData[$i]["large_file_url"])) $file_url = $decodedData[$i]["large_file_url"];
		
		if(isset($decodedData[$i]["tag_string"])) {
			if (!(str_contains($decodedData[$i]["tag_string"], $tag1) and
				str_contains($decodedData[$i]["tag_string"], $tag2))) {
				continue;
			}
		}
		//$filename = "downloads\\" . basename($file_url);
		
		//file_put_contents($filename, file_get_contents($file_url));
	}
}

echo "<br><div style='float:clear; margin-bottom:-50px;'></div><br>";
echo "<br><input type='submit' value='DOWNLOAD'></form>";

/////////////////////////////////////////////////

$page_inc = $page+1;
$page_dec = $page-1;

echo "<br><br>";
if($page != 1) echo "<a href=\"search.php?tag1=" . $tag1 . "&tag2=" . $tag2 . "&page="
. $page_dec .
"\">PREVIOUS</a>";

echo "<br>";

echo "<a href=\"search.php?tag1=" . $tag1 . "&tag2=" . $tag2 . "&page="
. $page_inc .
"\">NEXT</a>";

?>