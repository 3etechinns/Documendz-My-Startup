
<?php 
//database settings
session_start();

$connect = mysqli_connect("localhost","root", "Zofler6991", "project");
 
$result = mysqli_query($connect, "select  userid, emailid, username from signup where userid = ".$_SESSION['userid']);
 
$data = array();
 
while ($row = mysqli_fetch_assoc($result)) {
  $data[] = $row;
}
    print json_encode($data) ;
 ?>