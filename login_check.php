<?php

require_once 'functions.php';
include 'connect.php';

$Username=$_POST['Username'];
$Password=$_POST['Password'];


$sql="select * from signup where Username='$Username' and Password='$Password'";
$result = mysql_query($sql);
$row = mysql_fetch_array($result,MYSQLI_ASSOC); 

$num_results = mysql_num_rows($result);
if ($num_results == 1) {						// Starting session only if unique username and password
	/* echo "Num_results is 1, yipee !!"; */
	
  
        session_start();		
	$_SESSION['Username'] = $Username;			// Storing the username of the logged in person
	$_SESSION['userid'] =  $row['userid'];              //Will take the userid of the logged in user from registered users db and assign it to SESSION userid
        //redirect_to("profile_page.php");

	redirect_to("http://localhost/local_ang/angular/#/profile");
} 


else {
echo "Username-Password combination incorrect";
}


?>

