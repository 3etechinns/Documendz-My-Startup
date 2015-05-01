<?php
require_once 'functions.php';

session_start();
include 'connect.php';


$r =  mysqli_query($dbhandle,"SELECT count(*) as total from files where authid= ".$_SESSION['userid']);
$count = mysqli_fetch_assoc($r);
echo $count['total'];


?>