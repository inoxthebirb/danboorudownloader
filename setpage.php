<?php

if (!isset($_GET["page"])) $_GET["page"] = 1;

$search_date = date("Y-m-d",strtotime("-1 days"));
$today = date("Y-m-d");

?>