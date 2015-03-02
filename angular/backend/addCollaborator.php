<?php
require_once 'functions.php';

session_start();
include 'connect.php';


$w = $_POST['wgId'];
$e = $_POST['email'];


$x = mysqli_num_rows(mysqli_query($dbhandle,"SELECT * FROM collaborators WHERE wkUniqueId ='".$w."' AND collabEmail = '".$e."'"));




if($e == $_SESSION['email']){
	echo "1"; // Email id entered is of the author himself/herself
}
elseif($x > 0){
   echo "2";   // email-id entered already in the workgroup
}
else{          // on success do the needful

	$r = mysqli_query($dbhandle,"SELECT username FROM signup WHERE emailid ='".$e."'");
	$p = mysqli_fetch_assoc($r);

   		if($p['username'] == ""){

				$n = $e;
   		}

		else{

		$n = $p['username']; 
		
		}

mysqli_query($dbhandle,"INSERT INTO collaborators (wkUniqueId,collabEmail,collabName,authId) 
                        VALUES ('".$w."','".$e."','".$n."',".$_SESSION['userid'].")");

 echo "3";

  exec('/usr/bin/php notifyCollab.php '.$e.'> /dev/null 2>/dev/null &');
}

?>