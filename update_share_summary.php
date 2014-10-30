<?php

require_once 'functions.php';
require_once 'email.php';
session_start();
include 'connect.php';
include 'unique_random_alphanumeric.php';

$id = $_SESSION['userid'];

$shared_files_info = mysql_query("SELECT * FROM shared_files WHERE sender_id = '$_SESSION[userid]' OR receiver_id ='$_SESSION[userid]' ORDER BY shared_id ASC");
 
$response = array();
while($r = mysql_fetch_assoc($shared_files_info)){


    $r['sess'] = $_SESSION['userid']; //adding session_id to every row

    $response[] = $r;
	
}


echo json_encode($response);

mysql_close($dbhandle);

?>