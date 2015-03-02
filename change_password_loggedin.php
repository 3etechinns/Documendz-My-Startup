<?php

if($_POST['toki'] == 'kjh876hgf'){


session_start();

if(htmlspecialchars($_POST['token']) != $_SESSION['userid']){
    
    echo '999';
}
else{

$data   =  $_POST["result"];
$data   =   json_decode("$data",true);
    //just echo an item in the array
   
    
    
$username = "root";
$password = "Zofler6991";
$hostname = "localhost"; 

//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password)
  or die("Unable to connect to MySQL");

//select a database to work with
$selected = mysql_select_db("project",$dbhandle)
or die("Could not select project db");

$stored_pass = mysql_query("SELECT password FROM signup WHERE userid =".$_SESSION['userid']);
$row = mysql_fetch_array($stored_pass);


if(strcmp($row['password'],md5(mysql_real_escape_string($data["curr_pass"])."kubrv653nerf")) == 0){
  
  
  $hash_new_pass = md5(mysql_real_escape_string($data['new_pass'])."kubrv653nerf");
  
  mysql_query("UPDATE signup SET password='$hash_new_pass' WHERE userid=".$_SESSION['userid']);
  
  echo "Password changed succesfully!";  
    
    }

else {
    
    echo "The current password you have entered is wrong !";
    
}

}
}
else{
  
  
}

?>