<?php 

require_once 'functions.php';
session_start();
include 'connect.php';

 
$result = mysqli_query($dbhandle, "SELECT * FROM uploaded_files WHERE user_id =".$_SESSION['userid']);	
 
 
$data = array();
 
while ($row = mysqli_fetch_assoc($result)) {
  $data[] = $row;
}

print json_encode($data) ;

?>