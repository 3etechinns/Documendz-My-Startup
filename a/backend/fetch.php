
<?php 
//database settings
session_start();

$connect = mysqli_connect("localhost","root", "Zofler6991", "project");
 
$result = mysqli_query($connect, "SELECT userid, emailid, username, password, gsign, subscribed, verified, summary, flag, workgroups, files, collaborators,versions, UNIX_TIMESTAMP(start)*1000 as start from signup where userid = ".$_SESSION['userid']);
 
$data = array();
 
while ($row = mysqli_fetch_assoc($result)) {
  $data[] = $row;
}
    print json_encode($data) ;
 ?>