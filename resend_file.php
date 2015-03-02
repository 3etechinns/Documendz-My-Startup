<?php
include 'connect.php';
require_once 'functions.php';
session_start();

$shared_id=  mysql_real_escape_string($_GET['shared_id']);
$last_reviewer_id = mysql_real_escape_string($_GET['last_reviewer_id']);
date_default_timezone_set('Asia/Kolkata');
$time = mysql_real_escape_string(time()); // This is in seconds


mysql_query("UPDATE shared_files SET last_edit ='".$time."',review_state=1, hidden_state=0, last_reviewer_id=".$last_reviewer_id." WHERE shared_id=".$shared_id);

mysql_close($mysql_conn);

/* redirect_to('profile_page.php') */
?>
