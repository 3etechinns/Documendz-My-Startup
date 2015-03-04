
<?php 

require_once 'functions.php';
session_start();
include 'connect.php';


 
$result = mysqli_query($dbhandle, "SELECT f.fid, f.uniqueFilename, f.filename, f.workgroupid, UNIX_TIMESTAMP(f.uploadtime)*1000 as uploadtime, f.sample , s.username as authname FROM files AS f LEFT JOIN signup AS s ON f.authid = s.userid WHERE f.workgroupid IN (SELECT uniqueId from workgroups where auth_id =".$_SESSION['userid']." OR uniqueId IN (SELECT wkuniqueId FROM collaborators where collabEmail = '".$_SESSION['email']."'))");	
 
 
$data = array();
 
while ($row = mysqli_fetch_assoc($result)) {
  $data[] = $row;
}


print json_encode($data) ;
 ?>