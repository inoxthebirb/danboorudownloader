<?php

//var_dump($_POST);

foreach($_POST as $key => $link) {
	$filename = "downloads\\" . basename($link);
	file_put_contents($filename, file_get_contents($link));
}

$_POST = array();

?>