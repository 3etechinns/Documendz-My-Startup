
<?php 

require_once 'functions.php';
session_start();
include 'connect.php';




$result = mysqli_query($dbhandle, "SELECT wid, uniqueId, wname, wdesc, auth_id, auth_name, UNIX_TIMESTAMP(time)*1000 as time, sample  from workgroups where auth_id =".$_SESSION['userid']." OR uniqueId IN (SELECT wkuniqueId FROM collaborators where collabEmail = '".$_SESSION['email']."')");
$emails = mysqli_query($dbhandle,"SELECT wkUniqueId,collabEmail from collaborators where wkUniqueId IN (SELECT uniqueId from workgroups where auth_id =".$_SESSION['userid']." OR uniqueID IN (SELECT wkuniqueId FROM collaborators where collabEmail = '".$_SESSION['email']."'))"); 
//$files = mysqli_query($dbhandle,"SELECT workgroupid,filename from files where workgroupid IN (SELECT uniqueId from workgroups where auth_id =".$_SESSION['userid']." OR uniqueID IN (SELECT wkuniqueId FROM collaborators where collabEmail = '".$_SESSION['email']."'))");


$data_emails = array();

while ($row_email = mysqli_fetch_assoc($emails)) {
  $data_emails[$row_email['wkUniqueId']][] = $row_email['collabEmail'];
}

//print json_encode($data_emails);

$data = array();

 
while ($row = mysqli_fetch_assoc($result)) {
  $data['wg'][] = $row;
  
 
}
  $data['emails'][] = $data_emails;

print json_encode($data) ;
 ?>