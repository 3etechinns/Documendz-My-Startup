<?php
require_once 'functions.php';
include 'connect.php';
session_start();

$shared_id = mysql_real_escape_string($_GET['token']);
$u = mysql_real_escape_string($_SESSION['userid']);

    mysql_query("UPDATE file_access SET access_status = 0 WHERE (shared_id=".$shared_id." AND changer_userid=".$u.")");

?>