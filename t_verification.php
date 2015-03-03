<?php

require_once 'angular/backend/functions.php';
require_once 'unique_random_alphanumeric.php';
include 'angular/backend/connect.php';

session_start();
	

$email = $_GET['email'];
$hashcode = $_GET['hash'];

$secret = "61oeix1=-4#%e03mo";



if (MD5($email.$secret) == $hashcode){
	
	
$email = mysqli_real_escape_string($dbhandle,$email);
	
$check_ver = mysqli_fetch_array(mysqli_query($dbhandle,"SELECT verified FROM signup WHERE emailid = '".$email."'"),MYSQLI_ASSOC);

if ($check_ver['verified'] == 0){
 
	
	

	$vefi_val = mysqli_query( $dbhandle, "UPDATE signup SET verified = 1 WHERE emailid ='".$email."'");

	
$new_register_user_id = mysqli_fetch_array(mysqli_query($dbhandle,"SELECT userid,username FROM signup WHERE emailid ='".$email."'"),MYSQLI_ASSOC);

	// $query_to_take_current_userid = "SELECT userid,username FROM signup WHERE emailid ='".$email."'";
	// $id = mysqli_query($dbhandle,$query_to_take_current_userid);
	// $new_register_user_id = mysqli_fetch_array($id,MYSQLI_ASSOC);

	// mysql_query("UPDATE shared_files SET receiver_id =".$new_register_user_id['userid'].",receiver_name = '".$new_register_user_id['username']."' WHERE receiver_email ='".$email."'");
	
		
	/////  make user folder  ////

	$r1 = getToken(20);
    $r2 = getToken(20);
    

    $s1 = getToken(15);
    $s2 = getToken(15);
    $s3 = getToken(15);
    $s4 = getToken(15);
/// 2 sample wkgroups ///

	mysqli_query($dbhandle,"INSERT INTO workgroups (uniqueId,wname,wdesc,auth_id,auth_name,sample) 
                        VALUES ('".$r1."','Documents (Sample)','This is where you can add a short description for your workgroup to let your collaborators know a few details about the files, deadlines, tasks that you need to complete. ',". $i['userid'].",'".$i['username']."',1),
                               ('".$r2."','Designs (Sample)','Example: Let us get the final draft for these designs by 18th Dec. Add your designs and revisions here.',". $i['userid'].",'".$i['username']."',1)");
	
$my_date = date("Y-m-d H:i:s");

	mysqli_query($dbhandle,"INSERT INTO files VALUES('','".$s1."','Legal document.pdf','".$r1."',".$i['userid'].",'$my_date','pdf',11),
	                                                ('','".$s2."','Research paper.pdf','".$r1."',".$i['userid'].",'$my_date','pdf',12),
						                            ('','".$s3."','Creative design.jpg','".$r2."',".$i['userid'].",'$my_date','pdf',21),
						                            ('','".$s4."','Floor plan.jpg','".$r2."',".$i['userid'].",'$my_date','pdf',22)");
    

	mkdir('uploaded/uploaded_files_'.$new_register_user_id['userid'].'_original');
	mkdir('uploaded/jhg76'.$new_register_user_id['userid'].'kd84');
	

	

	$_SESSION['Username'] = $new_register_user_id['username'];			// Username of the registerd user
	$_SESSION['userid'] =  $new_register_user_id['userid']; // Will take the userid of the registered user
	$_SESSION['email'] = $email;

     echo "<script>window.location.href ='https://www.zofler.com/enterprise/angular/#/workgroups'</script>";
	
	// echo $_SESSION['Username'];
	// echo $_SESSION['userid'];
	
}

else {
	
echo "<script>window.location.href = 'exception_handlers/already_verified.html'</script>";
	
	}

}

else {
	
	echo "There seems to be something wrong with the verification. Please reach out to us on help@documendz.com";
}



?>
