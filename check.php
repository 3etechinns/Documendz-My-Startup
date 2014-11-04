<?php

require_once 'functions.php';
include 'connect.php';
session_start();

$shared_id = mysql_real_escape_string($_GET['token']);

$row = mysql_fetch_array(mysql_query("SELECT access_status FROM file_access WHERE shared_id=".$shared_id),MYSQLI_ASSOC);
echo $row['access_status'];

?>