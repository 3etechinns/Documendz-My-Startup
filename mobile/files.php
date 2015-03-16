 <?php 
  require "connect.php";
  if(isset($_GET['g'])) {

  $gid = $_GET['g'];  
  $SQL="SELECT * FROM files WHERE gid='".$gid."'";
  $result = mysql_query($SQL);
  $files = array();
    while($row = mysql_fetch_assoc($result))
    {
      $files[] = $row;
    }
  
 echo $_GET['callback'] . '('.json_encode($files).')';
}
 ?>