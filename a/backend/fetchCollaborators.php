
<?php 

require_once 'functions.php';
session_start();
include 'connect.php';

$w = $_POST['wid'];
 
 
$result = mysqli_query($dbhandle, "SELECT c.*,s.userid FROM collaborators as c LEFT JOIN signup as s on c.collabEmail = s.emailid  WHERE c.wkUniqueId = '".$w."'");	
 
 
$data = array();
 
while ($row = mysqli_fetch_assoc($result)) {
  $data[] = $row;
}


print json_encode($data) ;
 ?>