<?php

session_start();

if((htmlspecialchars($_POST['token']) != $_SESSION['userid']) && $_POST['toki'] == 'kejt568gkjln'){
    
    echo '999';
}
else{

$username = "root";
$password = "Zofler6991";
$hostname = "localhost"; 

//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password)
  or die("Unable to connect to MySQL");

//select a database to work with
$selected = mysql_select_db("project",$dbhandle)
or die("Could not select project db");


$data   =  $_POST["result"];
$data   =  json_decode("$data",true);

$new_username = mysql_real_escape_string($data['new_username']);

    //just echo an item in the array
  
  mysql_query("UPDATE signup SET username='$new_username' WHERE userid=".$_SESSION['userid']);
  $_SESSION['Username'] = $new_username;
  
  echo $new_username;  
    

}
?>