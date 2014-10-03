<?php


//////////////////////
//limit_status index//
//////////////////////



if ($_POST['status_check'] == "show_status"){

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
        
        $limit_values = mysql_fetch_array(mysql_query("SELECT file_limit,used FROM features WHERE userid = ".$_SESSION['userid']),MYSQL_ASSOC);

        $remaining_uploads = $limit_values['file_limit'] - $limit_values['used'];
        
        echo $remaining_uploads."#".$limit_values['file_limit']."#".$limit_values['used'];

}

else{
    
}
	

?>