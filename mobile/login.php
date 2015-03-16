 <?php 
  header('Content-Type: text/javascript');

  require "connect.php";
  if(isset($_GET['e']) && isset($_GET['p'])) {

  $email = $_GET['e']; 
  $password = md5($_GET['p']."kubrv653nerf");
  $SQL="SELECT * FROM signup WHERE emailid='".$email."' AND password='".$password."'";
  $result = mysql_query($SQL); 
  $row = mysql_fetch_assoc($result);
  $key = $row['userid'];
  $count = mysql_num_rows($result);
 
  if($count == 1) {   // Currently allowing not-registered people to also log in
         

         // if($row['verified'] == 1) { 
          echo  $_GET['callback'] . '(' . "{'status' : '0', 'sessionkey' : '" . $key . "'}" . ')'; 
          // }
          // else if ($row['verified'] == 0) {
          // echo $_GET['callback'] .  '(' . "{'status' : 'Account not verified'}" . ')'; 
          // }
  }
  else
    { 
         echo $_GET['callback'] . '(' . "{'status' : '1'}" . ')'; 
    } 
  }
 ?>