
<?php 

require_once 'functions.php';
session_start();
include 'connect.php';

$w = $_POST['w'];
$r2=0;
$r1 = mysqli_num_rows(mysqli_query($dbhandle, "SELECT wid FROM workgroups WHERE auth_id = ".$_SESSION['userid']." AND uniqueId = '".$w."'"));	
 
if($r1 == 0){

	$r2 = mysqli_num_rows(mysqli_query($dbhandle, "SELECT collid FROM collaborators WHERE collabEmail = '".$_SESSION['email']."' AND wkUniqueId = '".$w."'"));
}

if($r1 + $r2 > 0){

	echo '1';
}
else {

	echo ($r1 + $r2);
}
 ?>