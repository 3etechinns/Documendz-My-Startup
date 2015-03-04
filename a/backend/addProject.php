<?php
require_once 'functions.php';

session_start();
include 'connect.php';


$pName = $_POST['projectName'];
$pDesc = $_POST['projectDesc'];
$u = $_POST['rnd'];



mysqli_query($dbhandle,"INSERT INTO workgroups (uniqueId,wname,wdesc,auth_id,auth_name) 
                        VALUES ('".$u."','".$pName."','".$pDesc."',".$_SESSION['userid'].",'".$_SESSION['Username']."')");


	


?>