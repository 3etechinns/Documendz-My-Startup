
<?php 

require_once 'functions.php';
session_start();
include 'connect.php';

$w = $_POST['wid'];
 
$result = mysqli_query($dbhandle, "SELECT * FROM collaborators WHERE wkUniqueId = '".$w."'");	
 
 
$data = array();
 
while ($row = mysqli_fetch_assoc($result)) {
  $data[] = $row;
}


print json_encode($data) ;
 ?>