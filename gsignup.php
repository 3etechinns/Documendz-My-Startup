<?php

require_once 'angular/backend/functions.php';
require_once 'unique_random_alphanumeric.php';

  session_start();

include 'angular/backend/connect.php';

$name= $_GET['n'];
$email= $_GET['e'];

$y = mysqli_query($dbhandle,"SELECT * FROM signup WHERE emailid ='".$email."'");
$z = mysqli_fetch_array($y);
$x = mysqli_num_rows($y);

echo "Loading ...";


if($x > 0 ){

        $_SESSION['Username'] = $z['username'];
		$_SESSION['email'] = $email;
		$_SESSION['userid'] = $z['userid'];


		 echo "<script>window.location.href ='angular/#/workgroups'</script>";
}

else if( $x == 0){


		
mysqli_query($dbhandle, "INSERT INTO signup "."(username, password, emailid, gsign, verified, workgroups, files, collaborators) "."VALUES('$name','','$email',1,1,3,10,3)");		
$i = mysqli_fetch_array(mysqli_query($dbhandle,"SELECT userid,username FROM signup WHERE emailid ='".$email."'"));

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
    

	mkdir('uploaded/uploaded_files_'.$i['userid'].'_original');
	mkdir('uploaded/jhg76'.$i['userid'].'kd84');

        $_SESSION['Username'] = $i['username'];
		$_SESSION['email'] = $email;
		$_SESSION['userid'] = $i['userid'];

echo "<script>window.location.href ='https://www.documendz.com/angular/#/workgroups'</script>";

}



?>