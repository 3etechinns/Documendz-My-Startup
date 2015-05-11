
<?php
session_start();
include 'connect.php';

$wid = $_POST['wid'];
$type = $_POST['type'];
$cids = $_POST['cid'];
$name = $_POST['name'];

$my_date = date("Y-m-d H:i:s");

$SQL = "INSERT INTO notification (actor_id, type_id, wkgroup_id,time,name) values ('$_SESSION[userid]', '$type', '$wid','$my_date','$name')";
mysqli_query($dbhandle,$SQL);
$nid = mysqli_insert_id($dbhandle); //The value of the AUTO_INCREMENT field that was updated by the previous query. Returns zero if there was no 
                            //previous query on the connection or if the query did not update an AUTO_INCREMENT value.
$dcids = json_decode($cids);
$SQL2 = "INSERT INTO notification_flag (notification_id, viewer_id) values";

$valuesArr = array();
foreach($dcids as $row){
    $valuesArr[] = "('$nid', '$row')";
}

$SQL2 .= implode(',', $valuesArr);

mysqli_query($dbhandle,$SQL2); 


?>

