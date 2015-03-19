<?php 
  header('Content-Type: text/javascript');

  require "connect.php";
  require_once '../unique_random_alphanumeric.php';

  if(isset($_GET['e'])) {

  $email = trim($_GET['e']);   //dunno y trim is used 
  $name = trim($_GET['n']);
  $temp = 0;
$skey = '';
$result = mysql_query("SELECT emailid, userid FROM signup") or die(mysql_error());

//fetch that email from the database
 while ($row = mysql_fetch_array($result)) {
 
  $a = trim($row['emailid']);

  if($a == $email){   // if user already found
    $temp = 1;
$skey = $row['userid'];
    break;
  }
  
} 
 
if($temp == 0){  // New user



mysql_query("INSERT INTO signup (username, password, emailid,verified,gsign, workgroups, files, collaborators) VALUES('$name','','$email',1,1,3,10,3)");

 $i = mysql_fetch_assoc(mysql_query("SELECT userid,username FROM signup WHERE emailid ='".$email."'"));
  // Drop an email

  $r1 = getToken(20);
    $r2 = getToken(20);
    

    $s1 = getToken(15);
    $s2 = getToken(15);
    $s3 = getToken(15);
    $s4 = getToken(15);
/// 2 sample wkgroups ///

  mysql_query("INSERT INTO workgroups (uniqueId,wname,wdesc,auth_id,auth_name,sample) 
                        VALUES ('".$r1."','Documents (Sample)','This is where you can add a short description for your workgroup to let your collaborators know a few details about the files, deadlines, tasks that you need to complete. ',". $i['userid'].",'".$i['username']."',1),
                               ('".$r2."','Designs (Sample)','Example: Let us get the final draft for these designs by 18th Dec. Add your designs and revisions here.',". $i['userid'].",'".$i['username']."',1)");
  
$my_date = date("Y-m-d H:i:s");

  mysql_query("INSERT INTO files VALUES('','".$s1."','Legal document.pdf','".$r1."',".$i['userid'].",'$my_date','pdf',11),
                                                  ('','".$s2."','Research paper.pdf','".$r1."',".$i['userid'].",'$my_date','pdf',12),
                                        ('','".$s3."','Creative design.jpg','".$r2."',".$i['userid'].",'$my_date','pdf',21),
                                        ('','".$s4."','Floor plan.jpg','".$r2."',".$i['userid'].",'$my_date','pdf',22)");
    

  mkdir('../uploaded/uploaded_files_'.$i["userid"].'_original');
  mkdir('../uploaded/jhg76'.$i["userid"].'kd84');
  

  // Drop an email

echo  $_GET['callback'] . '(' . "{'status' : '0', 'sessionkey' : '" . $i['userid'] . "'}" . ')'; 


  
  }


   else{
echo  $_GET['callback'] . '(' . "{'status' : '0', 'sessionkey' : '" . $skey . "'}" . ')'; 
  }
}
  
 ?>