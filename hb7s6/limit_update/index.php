<?php


///////////////////////////////
///////   limit_update ////////
///////////////////////////////





if ($_POST['update_check'] == "update_it"){

    session_start();
    
    
	$username = "root";
	$password = "Zofler6991";
	$hostname = "localhost";		
	//connection to the database
	$dbhandle = mysql_connect($hostname, $username, $password)
	or die("Unable to connect mysql");
	
	//select a database to work with
	$selected = mysql_select_db("project",$dbhandle)
	or die("Could not select examples");
        
       mysql_query("UPDATE features SET used = used + 1 WHERE userid = ".$_SESSION['userid']);
    
}    
 else {
    
 }

?>

