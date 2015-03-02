
<?php 

require_once 'functions.php';
session_start();
include 'connect.php';

$w = $_POST['wid'];
 
$result = mysqli_query($dbhandle, "SELECT fid, uniqueFilename, filename, workgroupid, authid, UNIX_TIMESTAMP(uploadtime)*1000 as uploadtime, extension, sample , s.username as authname FROM files AS f LEFT JOIN signup AS s ON f.authid = s.userid WHERE f.workgroupid = '".$w."'");	

  
$data = array();
 
while ($row = mysqli_fetch_assoc($result)) {
  $data[] = $row;
}


print json_encode($data) ;
 ?>