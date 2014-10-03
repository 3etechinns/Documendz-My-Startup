
<?php
// ajax for checking that link is valid or expired

$salt = 'change me cause im not secure'; // for security
$path = $_SERVER['HTTP_REFERER']; // getting previous url
parse_str($path, $result); // getting variables from url
$hashGiven = $result['s']; // assigning variable
$timestamp = $result['t'];
$hash = md5($salt . $timestamp); // hashing security and time
if($hashGiven == $hash && $timestamp >= time()) { //if secure key is matched and time is available
	// serve file
	$em=$result['em'];

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
	$result = mysql_query("SELECT emailid, flag FROM signup");
 
	
	//fetch tha data from the database
	while ($row = mysql_fetch_array($result)) {
		
		
		if(md5($row['emailid'])==$em)
		{
			$f=trim($row['flag']);	
		
			if($f==1) // if from forgot password
			{
				echo "allow-change";
			
			}
			else
			{
				echo "disallow-change";
			}
		}
		
} // end while
} else {
	echo "disallow-change";
}

?>
