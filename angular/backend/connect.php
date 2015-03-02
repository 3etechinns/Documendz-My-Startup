<?php

$username = "root";
$password = "Zofler6991";
$hostname = "localhost";
$db = "project"; 

//connection to the database
$dbhandle = mysqli_connect($hostname, $username, $password,$db)
  or die("Unable to connect to MySQL");


?>