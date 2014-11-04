<?php

require_once 'functions.php';
include 'connect.php';
session_start();

$rnd = rand(1,999999);
$shared_id = mysql_real_escape_string($_GET['token']);

$row = mysql_query("UPDATE file_access SET access_status =".$rnd." WHERE shared_id=".$shared_id);


?>