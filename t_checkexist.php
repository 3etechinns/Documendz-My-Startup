
<?php
// ajax for checking username or/and email already exist or available


if(isset($_POST['check']) &&($_POST['check'] == "sadh675fdA")){
       

$email=trim($_GET['e']); // get email id

include('connect.php');

//execute the SQL query and return records
$result = mysql_query("SELECT emailid FROM signup") or die(mysql_error());

//fetch tha data from the database
 while ($row = mysql_fetch_array($result)) {
 
	$a = trim($row['emailid']);

	if($a == $email){
		$temp = "found";
		break;
	}
	else {
		$temp = "notfound";
	}
	
} 
 echo $temp;
 mysql_close($dbhandle);
 
}
else{
       
}

?>
