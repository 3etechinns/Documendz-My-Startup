<?php
require_once 'functions.php';
session_start();
include 'connect.php';


$x = $_POST['old_pass'];
$y = $_POST['new_pass'];


$stored_pass = mysqli_query($dbhandle, "SELECT password FROM signup WHERE userid =".$_SESSION['userid']);
$row = mysqli_fetch_array($stored_pass);


if(strcmp($row['password'],md5($x."kubrv653nerf")) == 0){
  
  
  $hashed_new_pass = md5($y."kubrv653nerf");
  
  mysqli_query($dbhandle, "UPDATE signup SET password='$hashed_new_pass' WHERE userid=".$_SESSION['userid']);
  
  echo "1";  

  // Trigger email if needed
    
    }

else {
    
    echo "0";
    
}

?>