
<?php

require_once('functions.php');		
  session_start();
	

$email= $_POST['email'];
$pwd= md5($_POST['pwd']."kubrv653nerf");

if(strlen($email)!=0 && strlen($pwd)!=0){  // user exist or not while login


include('connect.php');

$email = mysql_real_escape_string($email);
$pwd = mysql_real_escape_string($pwd);

//execute the SQL query and return records
$result = mysql_query("SELECT * FROM signup");

$c=0; // variable for setting when user matched
//fetch tha data from the database
while ($row = mysql_fetch_array($result)) {
	
	if($row['emailid']==$email && $row['password']==$pwd) // username and pwd mathed
	{
		$c=1;
		if ($row['verified'] == 1){
		
		$_SESSION['Username'] = $row['username'];
		$_SESSION['email'] = $email;
		$_SESSION['userid'] = $row['userid'];
		
	$m['notif'] = "login-success";
	$m['id'] = $row['userid'];

		 echo json_encode($m);
			//redirect_to("http://localhost/local_ang/angular/#/profile/".$row['userid']);

		}
		else {
			echo "Please verify your account";
			
		}
	}
	/* else 
	{
		continue; // continue till data in database or user not matched
	} */
}
if($c==0) // user not exist
{
	
	echo "Username or Password does not match";
	
}
}
 else echo"<b>This page does not exist</b>";  // submit not set
 mysql_close($dbhandle);
?>
