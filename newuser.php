<?php

include 'connect.php';
require_once 'functions.php';

$Emailid = $_POST['Emailid'];
$Username = $_POST['Username'];
$Password = $_POST['Password'];


$sql="INSERT into signup (emailid, username, password) VALUES('$Emailid','$Username','$Password')";
mysql_query($sql);

// To create individual folders for uploaded files and received files 

$query_to_take_current_userid = "SELECT userid FROM signup WHERE username ='".$_POST['Username']."'";
$id = mysql_query($query_to_take_current_userid);
$new_register_user_id = mysql_fetch_array($id,MYSQL_ASSOC);

mkdir('uploaded/uploaded_files_'.$new_register_user_id['userid'].'_original');
mkdir('uploaded/uploaded_files_'.$new_register_user_id['userid'].'_html');
mkdir('received/received_files_'.$new_register_user_id['userid']);

$fp=fopen('uploaded/uploaded_files_'.$new_register_user_id['userid'].'_html/editor_change.php','w');
fwrite($fp, '<?php
$json_path = $_GET["json_path"];
$edited_data = $_POST["edited_data"];
file_put_contents($json_path, $edited_data);
?>');
fclose($fp);
//check if there are pending files tht were shared before the user registered

$sql = mysql_query("SELECT * FROM pending_shared_files where receiver_email_id ='".$_POST['Emailid']."'");

while($row=mysql_fetch_array($sql)) 
{
// copying pending file to received folder of the registered user to whom the file was sent
// Then delete the file from pending folder. 'rename' function does this
    
    rename('pending_shared_files/'.$row['file_name'],'received/received_files_'.$new_register_user_id['userid'].'/'.$row['file_name']);  
    
// updating shared_files tables, values are taken from pending_shared_fiiles table
    
   mysql_query("INSERT INTO shared_files (file_id,sender_id,receiver_id,file_name)"
                    . "VALUES(".$row['file_id'].","
                    .$row['sender_id'].","
                    .$new_register_user_id['userid'].",'"
                    .$row['file_name']."')"); 
    
}

// deleting values from pending_shared_files table
mysql_query("DELETE FROM pending_shared_files WHERE receiver_email_id ='".$_POST['Emailid']."'");

//On registering the user will be sent to his profile page        
 session_start();		
	$_SESSION['Username'] = $Username;			// Username of the registerd user
	$_SESSION['userid'] =  $new_register_user_id['userid']; // Will take the userid of the registered user
        redirect_to("profile_page.php");

        
?>

