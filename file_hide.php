<?php

require_once 'functions.php';

session_start();
include 'connect.php';

$id = mysql_real_escape_string($_POST['id']);
$state = mysql_real_escape_string($_POST['hid_state']);

mysql_query("UPDATE shared_files SET hidden_state=".$state." WHERE shared_id=".$id);

echo $state. "and shid ".$id;

mysql_close($dbhandle);

?>