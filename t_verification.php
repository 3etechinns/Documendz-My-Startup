<?php

$email = $_GET['email'];
$hashcode = $_GET['hash'];

$secret = "61oeix1=-4#%e03mo";



if (MD5($email.$secret) == $hashcode){
	
	$username = "root";
	$password = "Zofler6991";
	$hostname = "localhost";		
	//connection to the database
	$dbhandle = mysql_connect($hostname, $username, $password)
	or die("Unable to connect mysql");
	
	//select a database to work with
	$selected = mysql_select_db("project",$dbhandle)
	or die("Could not select examples");

$email = mysql_real_escape_string($email);
	
$check_ver = mysql_fetch_array(mysql_query("SELECT verified FROM signup WHERE emailid = '".$email."'"),MYSQL_ASSOC);

if ($check_ver['verified'] == 0){
 
	
	$sql_ver = "UPDATE signup SET verified = 1 WHERE emailid ='".$email."'";

	
	

	$vefi_val = mysql_query( $sql_ver, $dbhandle );
	

	$query_to_take_current_userid = "SELECT userid,username FROM signup WHERE emailid ='".$email."'";
	$id = mysql_query($query_to_take_current_userid);
	$new_register_user_id = mysql_fetch_array($id,MYSQL_ASSOC);

	mysql_query("UPDATE shared_files SET receiver_id =".$new_register_user_id['userid'].",receiver_name = '".$new_register_user_id['username']."' WHERE receiver_email ='".$email."'");
	
	
	
	// deleting values from pending_shared_files table
	mysql_query("DELETE FROM pending_shared_files WHERE receiver_email_id ='".$email."'");
	
	/////  make user folder  ////

	mysql_query("INSERT INTO features (userid,used,file_limit) VALUES (".$new_register_user_id['userid'].",0,30)");
	
	mkdir('uploaded/uploaded_files_'.$new_register_user_id['userid'].'_original');
	mkdir('uploaded/jhg76'.$new_register_user_id['userid'].'kd84');
	mkdir('received/received_files_'.$new_register_user_id['userid']);
	
	
	
	$fp=fopen('uploaded/jhg76'.$new_register_user_id['userid'].'kd84/editor_change.php','w');
	fwrite($fp, '<?php
$json_path = $_GET["json_path"];
$edited_data = $_POST["edited_data"];
$result = file_put_contents($json_path, $edited_data);

if($result === false){   // file_put_contents returns boolean
    echo "false";
}
else{
echo "true";
}
?>');
	fclose($fp);
	
	
	session_start();
	$_SESSION['Username'] = $new_register_user_id['username'];			// Username of the registerd user
	$_SESSION['userid'] =  $new_register_user_id['userid']; // Will take the userid of the registered user
	$_SESSION['email'] = $email;
    echo "<script>window.location.href = 'profile_page.php'</script>";
	
	
}

else {
	
echo "<script>window.location.href = 'exception_handlers/already_verified.html'</script>";
	
	}

}

else {
	
	echo "There seems to be something wrong with the verification. Please reach out to us on help@documendz.com";
}



?>
