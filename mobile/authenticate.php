 <?php
 header('Content-Type: text/javascript');
if(isset($_GET['e']) && isset($_GET['k'])) {

  require "connect.php";
  $email = $_GET['e']; 
  $key = $_GET['k']; 
  $SQL="SELECT * FROM signup WHERE emailid='".$email."'";
  $result = mysql_query($SQL); 
  $row = mysql_fetch_assoc($result);
  if($row['userid'] == $key)
  	{ 
         echo $_GET['callback'] . '(' . "{'status' : 'success'}" . ')'; 
    } 
  else
  	{ 
         echo $_GET['callback'] . '(' . "{'status' : 'fail'}" . ')'; 
    } 
 }
 ?>

 