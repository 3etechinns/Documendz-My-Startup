
<?php
// For changing password in database


	session_start();

	$salt = 'change me cause im not secure';  //for security
$path = $_SERVER['HTTP_REFERER']; // getting previous url
parse_str($path, $result);
	
	$em=$result['em'];
	$pw=md5($_POST['pw']."kubrv653nerf");
	$np=md5($_POST['np']."kubrv653nerf");

	
	
 // getting variables from url
$hashGiven = $result['s']; // assigning variable
$timestamp = $result['t'];
$hash = md5($salt . $timestamp); // hashing security and time
  //if secure key is matched and time is available
	// serve file


$username = "root";
$password = "Zofler6991";
$hostname = "localhost"; 

//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password)
  or die("Unable to connect to MySQL");

//select a database to work with
$selected = mysql_select_db("project",$dbhandle)
or die("Could not select project db");

//execute the SQL query and return records
$result = mysql_query("SELECT userid, emailid, password, flag FROM signup");

$c=0;
//fetch tha data from the database
while ($row = mysql_fetch_array($result)) {
	if(md5($row['emailid'])==$em && $row['password']==$pw)   // if current password matched
	{
		    $uid=trim($row['userid']);   // take UID of password
		    $f=$row['flag'];  // checking that password is changing from session or from forgot password
			mysql_query("UPDATE signup SET password='$np', flag=0 WHERE userid='$uid'");
			$c=1;  // set to 1 if password is changed
			if($f==1)  // password is changing from forgot password
			{
			echo "passwordset";
			
			break;
			}
			
	}
	else 
	{
		
	}
}
if($c==0) // if password not matched it remains 0
{
	echo "wrongpassword";
	
}


	
	

?>
