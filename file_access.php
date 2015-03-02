<?php
require_once 'functions.php';
include 'connect.php';
session_start();

$shared_id = mysql_real_escape_string($_GET['token']);
$row = mysql_fetch_array(mysql_query("SELECT * FROM file_access WHERE shared_id=".$shared_id), MYSQL_ASSOC);

 if($row['access_status'] == 0){
   
   $u = mysql_real_escape_string($_SESSION['userid']);
   
    mysql_query("UPDATE file_access SET access_status=1 WHERE shared_id=".$shared_id);
    mysql_query("UPDATE file_access SET changer_userid=".$u." WHERE shared_id=".$shared_id);
    
     echo "1";  ///// edit mode /////
 }
else {
    echo "0"; //// view mode /////
}

?>