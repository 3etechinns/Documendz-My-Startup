<?php 

$servername = "localhost"; $username = "root"; $password = "Zofler6991"; $database = "project"; // Create connection 
$db_handle = mysql_connect($servername, $username, $password); 
$db_found = mysql_select_db($database, $db_handle); 

?>